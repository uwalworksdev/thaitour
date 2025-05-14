<?php

// 1. CI4 부트스트랩 (필수)
require_once realpath(__DIR__ . '/../vendor/autoload.php');
require_once realpath(__DIR__ . '/../app/Config/Paths.php');

$paths = new Config\Paths();
require_once realpath($paths->systemDirectory . 'bootstrap.php');

// 2. Common.php 직접 포함
require_once '/home/thaitour/www/app/Common.php';

// 3. 로그 (CI4 방식 사용)
wriote_log('ccc-');  // logs/log-*.php에 기록됨

// 4. 알림톡 함수 호출
$payment_idx = "2097";
alimTalk_depisit_send($payment_idx);

// 5. 결과 출력 (선택사항)
echo "알림톡 호출 완료";
