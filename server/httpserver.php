<?php
/**
 * httpserver.php
 * 文件描述
 * created on 23:06 2022/2/23 23:06
 * create by xiflys
 */
$server = new \Swoole\Http\Server("0.0.0.0",9501);
$server->set([
    'enable_static_handler'=>true,
    'document_root'=>'/www/wwwroot/swoole_demo/data',
    'worker_num'=>8
]);
$server->on("request", function($request,$response){
    $response->cookie("textsss","flyber",time()+60);
    $response->end("hahah");
});
$server->start();