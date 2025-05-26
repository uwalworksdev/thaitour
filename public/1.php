<?php

    header('Content-Type:text/html; charset=utf-8');

    //step1. 요청을 위한 파라미터 설정
	$key                   = "cjAo6CD95LpJS0S4";
	$mid                   = $setting['inicis_mid'];
	$type                  = "partialRefund";
	$timestamp             = date("YmdHis");
	$clientIp              = $_SERVER["REMOTE_ADDR"];
	
	$postdata = array();
	$postdata["mid"]       = "thaitour37";
	$postdata["type"]      = $type;
    $postdata["timestamp"] = $timestamp;
	$postdata["clientIp"]  = $clientIp;
	
	$mid                   = "thaitour37";
	$type                  = "partialRefund";
	$timestamp             = date("YmdHis");
	$clientIp              = $_SERVER["REMOTE_ADDR"];
	$key                   = "cjAo6CD95LpJS0S4"; // 이니시스 제공 키

	$detail = [
		"tid"          => "StdpayCARDthaitour3720250526095858348462",
		"msg"          => "관리자 결제취소",
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
	
	
	//step2. 요청전문 POST 전송
	
	$url = "https://iniapi.inicis.com/v2/pg/partialRefund";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     
    $response = curl_exec($ch);
    curl_close($ch);
	
	
    //step3. 결과출력
	
	echo "**** 응답전문 **** <br/>" ;
	echo str_replace(',', ',<br>', $response)."<br><br>";
    
?>