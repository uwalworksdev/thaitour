<?php

// /app/Common/insertRoomPrice.php
use CodeIgniter\Database\BaseConnection;

function todayHotelPrice(BaseConnection $db, $product_idx)
{
    $date = (new DateTime())->format('Y-m-d'); // 오늘 날짜 가져오기

    $sql = "SELECT t.*
            FROM tbl_room_price t
            JOIN (
                SELECT product_idx, MIN(goods_price2 + goods_price3) AS min_price
                FROM tbl_room_price
                WHERE goods_date = ? AND product_idx = ? AND goods_price1 > 0
                  AND bed_idx > 0
                GROUP BY product_idx
            ) min_prices
            ON t.product_idx = min_prices.product_idx 
            AND (t.goods_price2 + t.goods_price3) = min_prices.min_price
            WHERE t.goods_date = ? AND t.bed_idx > 0";

    // SQL 실행
    $query = $db->query($sql, [$date, $product_idx, $date]);

    // 결과 반환
    return $query->getResultArray(); // 배열 형태로 결과 반환
}


?>