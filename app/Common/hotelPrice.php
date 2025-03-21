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

function roomPrice($db, $rooms_idx, $baht_thai, $product_idx, $g_idx, $o_sdate, $days)
{
    if (!$db) {
        $db = \Config\Database::connect();
    }

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
        $query = $db->query($sql, [$product_idx, $g_idx, $rooms_idx, $row['bed_idx'], $o_sdate]);
        $priceRow = $query->getRow();

        if ($priceRow) {
            $price_won    = ($priceRow->goods_price2 + $priceRow->goods_price3) * $priceRow->baht_thai;
            $price_baht   =  $priceRow->goods_price2 + $priceRow->goods_price3;
            $extra_bed    =  $priceRow->goods_price4;
            $price1       =  $priceRow->goods_price1;
        } else {
            $price_won    = 0;
            $price_baht   = 0;
            $goods_price1 = 0;
        }

        // bed_price 문자열 조합
        $bed_price .= ($bed_price === "") ? $price_baht : "," . $price_baht;
        $extra_bed .= ($extra_bed === "") ? $extra_bed : ","  . $extra_bed;
        $price1    .= ($price1    === "") ? $price1 : ","  . $price1;
    }

    $result = $bed_type . "|" . $bed_price . "|" . $extra_bed . "|" . $price1;
    return $result; // 성공적으로 처리된 경우
}

?>