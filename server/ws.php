<?php

use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

/**
 * ws.php
 * 文件描述
 * created on 0:10 2022/2/25 0:10
 * create by xiflys
 */

class ws
{
    const HOST = "0.0.0.0";
    const PORT = 9501;

    public $ws = 8812;

    public function __construct()
    {
        $this->ws = new Server(static::HOST,static::PORT);
        $this->ws->set([
            'enable_static_handler'=>true,
            'document_root'=>'/www/wwwroot/swoole_demo/data',
            'worker_num'=>2,
            'task_worker_num'=>2
        ]);
        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('task',[$this,"onTask"]);;
        $this->ws->on('finish',[$this,"onFinish"]);;
        $this->ws->on('close',[$this,'onClose']);
        $this->ws->start();
    }

    /**
     * Notes:监听ws连接事件
     * User: Fly
     * DateTime: 2022/2/25 0:13
     * @param Server $ws
     * @param Request $request
     */
    public function onOpen(Server $ws, Swoole\Http\Request $request){
        print_r($request->fd."hello 连接成功");
        if($request->fd == 1){
            swoole_timer_tick(2000,function($time_id){
               echo "2s:".$time_id."\n";
            });
        }
    }

    /**
     * Notes:
     * User: Fly
     * DateTime: 2022/2/25 22:36
     * @param Server $ws
     * @param Frame $frame
     */
    public function onMessage(Swoole\WebSocket\Server $ws, Swoole\WebSocket\Frame $frame){
        print_r(['fd'=>$frame->fd,'data'=>$frame->data,'code'=>$frame->opcode]);

        // $ws->task(['task'=>1,"fd"=>$frame->fd]);
        swoole_timer_after(5000,function () use($ws,$frame){
            echo "5s-after\r";
            $ws->push($frame->fd,"server-time-after");
        });

        $ws->push($frame->fd,$frame->data);
    }

    /**
     * Notes:task提交过来会执行
     * User: Fly
     * DateTime: 2022/2/25 22:33
     * @param Server $serv
     * @param int $taskId
     * @param int $src_worker_id
     * @param mixed $data
     */
    public function onTask(Server $serv, int $taskId, int $src_worker_id, $data){
        print_r($data);
        // 模拟耗时
        sleep(10);
        // 告诉worker
        return "on task finish";

    }

    /**
     * Notes:
     * User: Fly
     * DateTime: 2022/2/25 22:39
     * @param Server $server
     * @param int $task_id
     * @param mixed $data 是task return的值
     */
    public function onFinish(Server $server, int $task_id,$data){
        echo "taskId:".$task_id."\n";
        echo "finished success:".$data."\n";
    }

    public function onClose(Swoole\WebSocket\Server $ws,$fd){
        print_r('client close:'.$fd);
    }

}
new ws();