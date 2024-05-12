<?php
$candidateNumber = $_GET['candidateNumber'];
$projectId = $_GET['projectId'];

// 如果没有文本，则退出
if (!$candidateNumber) {
    die('');
}

if (!$projectId) {
    die('');
}

// 定义要提交的 POST 数据
// 设置请求参数
$data = array(
        "projectId" => $projectId,
        "candidateNumber" => "$candidateNumber",
        "historyRangeId" => 0,
        "type" => 0,
        "className" => "",
        "needInfoFalg" => 2
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

//print_r($json_data);

// 创建上下文
$context = stream_context_create($options);

// 提交 post 请求并获取返回信息
$result = file_get_contents('http://score.tydlk.com/scorequery/goldentouch/api/QueryScoreOnlie/ScoreQuery', false, $context);

// 解析返回信息
//print_r($result);

$response = json_decode($result, true);

// 打印返回信息

//print_r($response);



$mame = $response['data']['xingMing'];
$fenShu = $response['data']['scoreSortList'][0]['fenShu'];

print_r("$mame<pre>");
print_r("总分:");
print_r($fenShu);

//$audioFile = 'https://v2.genshinvoice.top/file=' . $vits;

// 设置响应头
//header("Content-type: audio/mpeg");

//readfile($audioFile);
?>