<?php
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
        $this->ws = new \Swoole\WebSocket\Server(static::HOST,static::PORT);
        $this->ws->set([
            'enable_static_handler'=>true,
            'document_root'=>'/www/wwwroot/swoole_demo/data'
        ]);
        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('close',[$this,'onClose']);
        $this->ws->start();
    }

    /**
     * Notes:监听ws连接事件
     * User: Fly
     * DateTime: 2022/2/25 0:13
     * @param \Swoole\WebSocket\Server $ws
     * @param \Swoole\Http\Request $request
     */
    public function onOpen(\Swoole\WebSocket\Server $ws,Swoole\Http\Request $request){
        print_r($request->fd."hello 连接成功");
    }

    public function onMessage(Swoole\WebSocket\Server $ws, Swoole\WebSocket\Frame $frame){
        print_r(['fd'=>$frame->fd,'data'=>$frame->data,'code'=>$frame->opcode]);
        $ws->push($frame->fd,$frame->data);
    }


    public function onClose(Swoole\WebSocket\Server $ws,$fd){
        print_r('client close:'.$fd);
    }

}
new ws();