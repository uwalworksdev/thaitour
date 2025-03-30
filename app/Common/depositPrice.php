<?php

use CodeIgniter\Database\BaseConnection;

function depositPrice(BaseConnection $db, int $rooms_idx, int $baht_thai, int $product_idx, int $g_idx, string $o_sdate, string $o_edate)
{
    // DB 연결 확인 후 연결
    if (!$db) {
        $db = \Config\Database::connect();
    }

    // Query Builder 생성
    $builder = $db->table('tbl_room_price');

    // 안전한 SQL 쿼리 작성 (SQL Injection 방지)
    $builder->where('product_idx', $product_idx)
            ->where('g_idx', $g_idx)
            ->where('rooms_idx', $rooms_idx)
            ->where('goods_date >=', $o_sdate)
            ->where('goods_date <=', $o_edate);

    // 쿼리 실행
    $query = $builder->get();
    $priceRows = $query->getResult(); // 여러 개의 행이 나올 수도 있음

    // 가격 변수 초기화
    $goods_price1 = $goods_price2 = $goods_price3 = $goods_price4 = $goods_price5 = 0;

    // 가격 합산 (기간 내 모든 가격 합산 가능)
    foreach ($priceRows as $row) {
        $goods_price1 += $row->goods_price1 ?? 0;
        $goods_price2 += $row->goods_price2 ?? 0;
        $goods_price3 += $row->goods_price3 ?? 0;
        $goods_price4 += $row->goods_price4 ?? 0;
        $goods_price5 += $row->goods_price5 ?? 0;
    }

    $result =  $goods_price1 ."|". $goods_price2 ."|". $goods_price3 ."|". $goods_price4 ."|". $goods_price5;
    
	// 결과 문자열 생성
    return $result;
}


?>