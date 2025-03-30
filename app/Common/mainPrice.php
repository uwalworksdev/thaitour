<?php

use CodeIgniter\Database\QueryBuilder;
use DateTime;

function mainPrice($db, $rooms_idx, $baht_thai, $product_idx, $g_idx, $o_sdate, $days)
{
		if (!$db) {
			$db = \Config\Database::connect();
		}

        $o_sdate   = date('Y-m-d', strtotime('+1 day'));
        $o_sdate   = date('Y-m-d');

        $sql = "SELECT * FROM tbl_room_price WHERE product_idx = ? AND 
                                                   g_idx       = ? AND 
                                                   rooms_idx   = ? AND 
                                                   goods_date  = ?";
        $query    = $db->query($sql, [$product_idx, $g_idx, $rooms_idx, $o_sdate]);
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

?>