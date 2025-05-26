<?php
$mid       = "thaitour37";
$type      = "partialRefund";
$timestamp = date("YmdHis");
$clientIp  = $_SERVER["REMOTE_ADDR"];
$key       = "cjAo6CD95LpJS0S4"; // 이니시스 제공 키

$detail = [
    "tid"          => "StdpayCARDthaitour3720250526095858348462",
    "msg"          => "테스트취소",
    "price"        => 8482,    // ✅ 숫자형
    "confirmPrice" => 5000,    // ✅ 숫자형
    "currency"     => "WON",
    "tax"          => 0,
    "taxfree"      => 0
];

$details = json_encode($detail, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); // ✅ 중요

$plainTxt = $key . $mid . $type . $timestamp . $details;
$hashData = hash("sha512", $plainTxt);

$postdata = [
    "mid"       => $mid,
    "type"      => $type,
    "timestamp" => $timestamp,
    "clientIp"  => $clientIp,
    "data"      => $detail,
    "hashData"  => $hashData
];

$post_data = json_encode($postdata, JSON_UNESCAPED_UNICODE);

echo "plainTxt : {$plainTxt}<br><br>";
echo "hashData : {$hashData}<br><br>";
echo "**** 요청전문 **** <br>" . str_replace(',', ',<br>', $post_data) . "<br><br>";

    
?>