<?php
// 설정값
$mid       = 'thaitour37';                    // 상점 ID
$key       = 'cjAo6CD95LpJS0S4';              // 상점 KEY
$type      = 'partialRefund';
$timestamp = date("YmdHis");
$clientIp  = $_SERVER['REMOTE_ADDR'];         // 또는 고정 IP

// 요청 데이터 구성
$detail = [
    "tid"          => "StdpayCARDthaitour3720250526131151226019",
    "msg"          => "테스트취소",
    "price"        => 4241,     // 전체 결제금액
    "confirmPrice" => 1000,     // 이번 취소 금액
    "currency"     => "WON",
    "tax"          => 0,
    "taxfree"      => 0
];

// hashData 생성
$detailsJson = json_encode($detail, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$plainText   = $key . $mid . $type . $timestamp . $detailsJson;
$hashData    = hash("sha512", $plainText);

// 최종 postdata
$postdata = [
    "mid"       => $mid,
    "type"      => $type,
    "timestamp" => $timestamp,
    "clientIp"  => $clientIp,
    "data"      => $detail,
    "hashData"  => $hashData
];

// 전송
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://iniapi.inicis.com/v2/pg/partialRefund");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json;charset=utf-8"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata, JSON_UNESCAPED_UNICODE));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 테스트 환경에서만 false

$response = curl_exec($ch);
curl_close($ch);

// 응답 출력
$responseData = json_decode($response, true);
print_r($responseData);
?>
