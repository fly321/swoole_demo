<?php
/**
 * demo.php
 * 文件描述
 * created on 22:04 2022/3/2 22:04
 * create by xiflys
 */
$process = new \Swoole\Process(function(\Swoole\Process $pro){
    $pro->write("xixiahjh");
},true);
# 线程id
$pid = $process->start();
# 31
echo $pid.PHP_EOL;