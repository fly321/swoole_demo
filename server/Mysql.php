<?php
/**
 * AysMysql.php
 * 文件描述
 * created on 23:26 2022/2/27 23:26
 * create by xiflys
 */
use Swoole\Coroutine\MySQL;
use function Swoole\Coroutine\run;

run(function () {
    $swoole_mysql = new MySQL();
    $swoole_mysql->connect([
        'host'     => '127.0.0.1',
        'port'     => 3306,
        'user'     => 'sina',
        'password' => 'ApwMZZs7xwJBe7Mb',
        'database' => 'sina',
    ]);
    $res = $swoole_mysql->query('select * from sinapid where id = 13');
    var_dump($res);
    var_dump($swoole_mysql->error);
});