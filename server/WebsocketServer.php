<?php
/**
 * WebsocketServer.php
 * 文件描述
 * created on 23:46 2022/2/23 23:46
 * create by xiflys
 */

class WebsocketServer
{
    public function onOpen(Swoole\WebSocket\Server $ws,Swoole\Http\Request $request){
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

$obj = new WebsocketServer();
$ws = new Swoole\WebSocket\Server("0.0.0.0",9501);
$ws->set([
    'enable_static_handler'=>true,
    'document_root'=>'/www/wwwroot/swoole_demo/data'
]);
$ws->on('open',array($obj,'onOpen'));
$ws->on('message',array($obj,'onMessage'));
$ws->on('close',array($obj,'onClose'));
$ws->start();
