<?php
// 특정 시작일 설정
$startDate = new DateTime('2025-02-06'); // 원하는 날짜로 변경

// 3일간 날짜 출력
for ($i = 0; $i < 3; $i++) {
    echo $startDate->format('Y-m-d') . "<br>";
    $startDate->modify('+1 day'); // 하루씩 증가
}
?>
