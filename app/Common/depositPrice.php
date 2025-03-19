<?php

use CodeIgniter\Database\QueryBuilder;
use DateTime;

function depositPrice($db, $rooms_idx, $baht_thai, $product_idx, $g_idx, $o_sdate, $o_edate)
{
		if (!$db) {
			$db = \Config\Database::connect();
		}

		$db      = db_connect();
		$builder = $db->table('tbl_room_price');

		$builder->where('product_idx', $product_idx)
				->where('g_idx', $g_idx)
				->where('rooms_idx', $rooms_idx)
				->where("goods_date BETWEEN '$o_sdate' AND '$o_edate'");

		$query    = $builder->get();
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