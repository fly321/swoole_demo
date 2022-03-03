<?php
/**
 * curl.php
 * 文件描述
 * created on 22:12 2022/3/3 22:12
 * create by xiflys
 */
echo date("Y-m-d H:i:s").PHP_EOL;
$workers = [];
$urls  = [
    "http://sina.com.com/",
    "http://baidu.com",
    "http://qq.com",
    "http://baidu.com/?search=qq",
    "http://baidu.com/?search=qq1",
    "http://baidu.com/?search=qq21",
];

$c = count($urls);
for($i = 0;$i<$c;$i++){
    $process = new \Swoole\Process(function(\Swoole\Process $pro) use($i,$urls){
        $connect = curl_test($urls[$i]);
        echo $connect.PHP_EOL;
    },true);

    $pid = $process->start();
    $workers[$pid] = $process;
}

foreach ($workers as $pro){
    echo $pro->read();
}

function curl_test($url){
    sleep(1);
    return $url."SUCCESS".PHP_EOL;
}

echo date("Y-m-d H:i:s").PHP_EOL;