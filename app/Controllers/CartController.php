<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Config\View;
use Exception;

class CartController extends BaseController
{
    public function __construct()
    {
    }
    public function itemList($code_no)
    {
		$db     = \Config\Database::connect(); // 데이터베이스 연결
		$m_idx  = session("member.idx");
        
		// 골프
		$sql    = "SELECT a.*, b.*, c.* FROM tbl_order_mst a
		                                LEFT JOIN tbl_product_mst b  ON a.product_idx = b.product_idx 
										LEFT JOIN tbl_order_option c ON a.order_idx   = c.order_idx   
										WHERE a.product_code_1 = '1302' AND a.m_idx = '$m_idx' AND a.order_status = 'B' ORDER BY order_idx ";
		write_log($sql);
		$query  = $db->query($sql);
		$result = $query->getResultArray();

        return view("cart/item-list", [
            'result' => $result
        ]);

    }
}