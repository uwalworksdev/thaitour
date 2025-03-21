<?php

use CodeIgniter\Database\QueryBuilder;
use DateTime;

function mainPrice($db, $product_idx, $g_idx, $rooms_idx)
{
		if (!$db) {
			$db = \Config\Database::connect();
		}
		
        $baht_thai   = (float)($setting['baht_thai'] ?? 0);
        $goods_date  = date('Y-m-d', strtotime('+1 day'));
        $goods_date  = date('Y-m-d');

        $sql = "SELECT *
				FROM  tbl_room_price
				WHERE product_idx   = ?
				AND   g_idx         = ?
				AND   rooms_idx     = ?
				AND   goods_date    = ?
				ORDER BY (goods_price2 + goods_price3) ASC
				LIMIT 1 ";

        $query    = $db->query($sql, [$product_idx, $g_idx, $rooms_idx, $goods_date]);
        $priceRow = $query->getRow();

        if ($priceRow) {
            $goods_price1  = $priceRow->goods_price1;
            $goods_price2  = $priceRow->goods_price2;
            $goods_price3  = $priceRow->goods_price3;
            $goods_price4  = $priceRow->goods_price4;
            $goods_price5  = $priceRow->goods_price5;
        } else {
            $goods_price1  = 0;
            $goods_price2  = 0;
            $goods_price3  = 0;
            $goods_price4  = 0;
            $goods_price5  = 0;
        }

        $result = $goods_price1 . "|" . $goods_price2 . "|" . $goods_price3 . "|" . $goods_price4 . "|" . $goods_price5;
	
        return $result; // 성공적으로 처리된 경우
}

function roomPrice($db, $product_idx, $g_idx, $rooms_idx)
{
		if (!$db) {
			$db = \Config\Database::connect();
		}

        $goods_date  = date('Y-m-d');

		// 방 정보 가져오기
		$bed_type  = "";
		$bed_price = "";
		$extra_bed = "";
		$price1    = "";
		$result    = "";

		$sql   = "SELECT * FROM tbl_room_beds WHERE rooms_idx = ? ORDER BY bed_seq";
		$query = $db->query($sql, [$rooms_idx]);
		$rows  = $query->getResultArray(); // 연관 배열 반환

		foreach ($rows as $row) {
			// bed_type 문자열 조합
			$bed_type .= ($bed_type === "") ? $row['bed_type'] : "," . $row['bed_type'];

			$sql = "SELECT * FROM tbl_room_price WHERE product_idx = ? AND 
													   g_idx       = ? AND 
													   rooms_idx   = ? AND 
													   bed_idx     = ? AND 
													   goods_date  = ?";
			$query    = $db->query($sql, [$product_idx, $g_idx, $rooms_idx, $row['bed_idx'], $goods_date]);
			$priceRow = $query->getRow();

			if ($priceRow) {
				$price        =  $priceRow->goods_price2 + $priceRow->goods_price3;
				$extra_price  =  $priceRow->goods_price5;
			} else {
				$price        = 0;
				$extra_price    = 0;
			}

			// bed_price 문자열 조합
			$bed_price .= ($bed_price === "") ? $price : "," . $price;
			$extra_bed .= ($extra_bed === "") ? $extra_price : ","  . $extra_price;
		}

		$result = $bed_type . "|" . $bed_price . "|" . $extra_bed;
		return $result; // 성공적으로 처리된 경우
}

use CodeIgniter\Database\ConnectionInterface; // DB 인터페이스 추가

function depositPrice(BaseConnection $db, int $product_idx, int $g_idx, int $rooms_idx, string $o_sdate, string $o_edate)
{
		// DB 연결 확인 후 연결
		if (!$db) {
			$db = \Config\Database::connect();
		}

		// Query Builder 생성
		$builder = $db->table('tbl_room_price');

		// 안전한 SQL 쿼리 작성 (SQL Injection 방지)
		$builder->where('product_idx',   $product_idx)
				->where('g_idx',         $g_idx)
				->where('rooms_idx',     $rooms_idx)
				->where('goods_date >=', $o_sdate)
				->where('goods_date <=', $o_edate);

		// 쿼리 실행
		$query     = $builder->get();
		$priceRows = $query->getResultArray(); // 여러 개의 행이 나올 수도 있음

		// 실행된 쿼리 확인 (디버깅 용도)
		write_log("depositPrice - " . $db->getLastQuery());

		// 가격 변수 초기화
		$goods_price1 = $goods_price2 = $goods_price3 = $goods_price4 = $goods_price5 = 0;

		// 가격 합산 (기간 내 모든 가격 합산 가능)
		foreach ($priceRows as $row) {
			$goods_price1 += $row['goods_price1'] ?? 0;
			$goods_price2 += $row['goods_price2'] ?? 0;
			$goods_price3 += $row['goods_price3'] ?? 0;
			$goods_price4 += $row['goods_price4'] ?? 0;
			$goods_price5 += $row['goods_price5'] ?? 0;
		}

		// 결과 문자열 생성
		return "{$goods_price1}|{$goods_price2}|{$goods_price3}|{$goods_price4}|{$goods_price5}";
}


?>