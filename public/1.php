<?php
// 특정 시작일 설정
$from_date = "2025-02-06";
$startDate = new DateTime($from_date); // 원하는 날짜로 변경

// 3일간 날짜 출력
echo $from_date ."~". $startDate->modify('+3 day'); // 하루씩 증가

?>
