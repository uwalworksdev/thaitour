<?php

use CodeIgniter\Database\QueryBuilder;
use DateTime;

function getMinPriceRoom(BaseConnection $db, $product_idx, $g_idx, $rooms_idx, $goods_date)
{
    $sql = "SELECT * 
            FROM tbl_room_price 
            WHERE product_idx = ? 
            AND g_idx = ? 
            AND rooms_idx = ? 
            AND goods_date = ? 
            AND (goods_price2 + goods_price3) = (
                SELECT MIN(goods_price2 + goods_price3) 
                FROM tbl_room_price 
                WHERE product_idx = ? 
                AND g_idx = ? 
                AND rooms_idx = ? 
                AND goods_date = ?
            )";

    $query = $db->query($sql, [$product_idx, $g_idx, $rooms_idx, $goods_date, 
                               $product_idx, $g_idx, $rooms_idx, $goods_date]);

    return $query->getRowArray(); // 단일 행 반환
}

?>