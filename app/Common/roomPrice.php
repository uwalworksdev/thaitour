<?php

use CodeIgniter\Database\QueryBuilder;
use DateTime;

function roomPrice($db, $rooms_idx, $baht_thai, $product_idx, $g_idx, $o_sdate, $days)
{
    if (!$db) {
        $db = \Config\Database::connect();
    }

    // 방 정보 가져오기
    $bed_type  = "";
    $bed_price = "";
    $result    = "";

    $sql = "SELECT * FROM tbl_room_beds WHERE rooms_idx = ? ORDER BY bed_seq";
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
            $price_won    = ($priceRow->goods_price1 + $priceRow->goods_price2 + $priceRow->goods_price3) * $priceRow->baht_thai;
            $price_baht   =  $priceRow->goods_price1 + $priceRow->goods_price2 + $priceRow->goods_price3;
            $goods_price1 =  $priceRow->goods_price1;
        } else {
            $price_won    = 0;
            $price_baht   = 0;
            $goods_price1 = 0;
        }

        // bed_price 문자열 조합
        $bed_price .= ($bed_price === "") ? $price_baht : "," . $price_baht;
    }

    $result = $bed_type . "|" . $bed_price . "|" . $goods_price1;
	write_log("result- ". $rooms_idx.":".$result);
    return $result; // 성공적으로 처리된 경우
}

?>