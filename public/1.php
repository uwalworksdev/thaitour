<?php
// 특정 시작일 설정
$from_date  = "2025-02-10";
$days       = "2";
$startDate  = new DateTime($from_date); // 시작 날짜 설정

// 종료일 계산 
$endDate = new DateTime($from_date);
$endDate = $endDate->modify('+'.$days-1 .'days'); // 3일 포함하기 위해 +2 days
$endDate = $endDate->format('Y-m-d');
echo $from_date ." - ". $endDate;
?>

<?php
/*
// 특정 시작일 설정
$from_date = "2025-02-06";
$startDate = new DateTime($from_date); // 시작 날짜 설정

// 종료일 계산 (+2 days 해야 정확히 3일 포함됨)
$endDate = new DateTime($from_date);
$endDate->modify('+2 days'); // 3일 포함하기 위해 +2 days

// 날짜 출력
echo $from_date . " ~ " . $endDate->format('Y-m-d');
?>