<?php
$date_check_in = "2025-02-10";
$from_date  = $date_check_in;
$days       = "2";
$startDate  = new DateTime($from_date); // 시작 날짜 설정

// 종료일 계산 
$endDate = new DateTime($from_date);
$endDate = $endDate->modify('+'.$days-1 .'days'); // 3일 포함하기 위해 +2 days
$endDate = $endDate->format('Y-m-d');

echo $date_check_in." - ". $endDate;