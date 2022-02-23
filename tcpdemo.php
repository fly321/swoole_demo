<?php
//创建Server对象，监听 127.0.0.1:9501 端口
$server = new Swoole\Server('127.0.0.1', 9501);
$server->set([
    'worker_num'=>8, // worker进程数
    'max_request'=>10000,
]);

//监听连接进入事件
/**
 * $fd 客户端连接唯一标识
 * $reactor_id 线程id
 */
$server->on('Connect', function ($server, $fd,$reactor_id) {
    // echo "Client: Connect.\n";
    var_dump(['客户端唯一标识'=>$fd,"线程id"=>$reactor_id]);
});

//监听数据（客户端发送）接收事件
$server->on('Receive', function ($server, $fd, $reactor_id, $data) {

    $server->send($fd, "Server: {$data}--{$reactor_id}");
});

//监听连接关闭事件
$server->on('Close', function ($server, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$server->start();