<?php
/**
 * table.php
 * 文件描述
 * created on 23:33 2022/3/3 23:33
 * create by xiflys
 */
// 创建内存表
use Swoole\Table as TableAlias;

$table = new TableAlias(1024);


# 内存表增加列

$table->column('id',TableAlias::TYPE_INT,4);
$table->column('money',TableAlias::TYPE_FLOAT,4);
$table->column('name',TableAlias::TYPE_STRING,64);

$table->create();

$table->set("hello_fly",array('id'=>1,'money'=>10.1,'name'=>'fly'));

// $table['hello_fly2'] = array('id'=>2,'money'=>10.2,'name'=>'fly2');

# 加 2
$table->incr('hello_fly','money',2);

var_dump($table->get('hello_fly'));
$table->del("hello_fly");
var_dump($table->get('hello_fly'));


