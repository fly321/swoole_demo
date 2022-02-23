<?php
$client = new \Swoole\Client(SWOOLE_SOCK_TCP);
if(!$client->connect("127.0.0.1",9501)){
    echo "连接失败";
    exit;
}
// php cli常量
fwrite(STDOUT,"请输入消息");
$msg = trim(fgets(STDIN));
// 发送消息给tcp server
$client->send($msg);
// 接收来自server的数据
$res = $client->recv();
var_dump($res);
$client->close();