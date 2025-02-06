<?php
// 특정 시작일 설정
$from_date  = "2025-02-10";
$days       = "2";
$startDate  = new DateTime($from_date); // 시작 날짜 설정

// 종료일 계산 
$endDate = new DateTime($from_date);
$endDate->modify('+'.$days-1 .'days'); // 3일 포함하기 위해 +2 days

echo $from_date ." - ". $endDate;
?>

