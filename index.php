<?php


$text = $_GET['text'];
$role = $_GET['role'];
$speed= floatval($_GET['speed']);


// 如果没有文本，则退出
if (!$text) {
    die('');
}

if (!$role) {
    die('');
}

if (!$speed) {
    $speed = 1;
}



// 定义要提交的 POST 数据
// 设置请求参数
$data = array(
        "data" => array(
                    "$text",
                    "$role",
                    0.5,
                    0.6,
                    0.9,
                    $speed,
                    "ZH",
                    true,
                    1,
                    0.2,
                    null,
                    "Happy",
                    "",
                    0.7),
        "event_data" => null,
        "fn_index" => 0
        );



// 将 post 数据编码为 JSON 格式
$json_data = json_encode($data);

// 设置请求选项
$options = array(
    'http' => array(
        'header' => 'Content-Type: application/json',
        'method' => 'POST',
        'content' => $json_data,
    ),
);

// 创建上下文
$context = stream_context_create($options);

// 提交 post 请求并获取返回信息
$result = file_get_contents('https://v2.genshinvoice.top/run/predict', false, $context);

// 解析返回信息
$response = json_decode($result, true);

// 打印返回信息

//print_r($response);



$vits = $response['data'][1]['name'];

//print_r($vits);

$audioFile = 'https://v2.genshinvoice.top/file=' . $vits;

// 设置响应头
header("Content-type: audio/mpeg");

readfile($audioFile);
?>


