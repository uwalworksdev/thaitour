<?php
		$start_date = "2025-02-01";
		$end_date   = "2025-02-10";

		$period = new DatePeriod(
			new DateTime($start_date),
			new DateInterval('P1D'), // 하루씩 증가
			(new DateTime($end_date))->modify('+1 day') // 종료일 포함
		);

		$date_list = [];
		foreach ($period as $date) {
			echo $date->format("Y-m-d") ."<br>";
		}

		// 출력 확인
		//print_r($date_list);

?>
