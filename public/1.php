<?php
            $from_date = "2024-12-01";
            $days = "10";
			$date = new DateTime($from_date);

			// 일 추가
			$date->modify('+'. $days .'days');

			// 결과 출력
			$to_date   = $date->format('Y-m-d'); // 2024-12-10
            echo $to_date;
?>