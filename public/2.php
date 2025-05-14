<?php
// Common.php 불러오기
require_once realpath(__DIR__ . '/../app/Common.php');

// 로그 찍기
write_log('ccc-');  // CI4 방식 로그

// 함수 호출
$payment_idx = "2097";
alimTalk_depisit_send($payment_idx);
 
?>