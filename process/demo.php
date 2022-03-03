<?php
/**
 * demo.php
 * 文件描述
 * created on 22:04 2022/3/2 22:04
 * create by xiflys
 */
$process = new \Swoole\Process(function(\Swoole\Process $pro){
    // $pro->write("xixiahjh");

    $pro->exec("/www/usr/bin/php/php8.0.16/bin/php",[__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'server'.DIRECTORY_SEPARATOR.'httpserver.php']);

},true);
# 线程id
$pid = $process->start();
# 31
echo $pid.PHP_EOL;
\Swoole\Process::wait();