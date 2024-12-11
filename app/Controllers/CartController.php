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
										WHERE a.product_code_1 = '1302' AND a.m_idx = '$m_idx' AND a.order_status = 'B' ORDER BY a.order_idx ASC, c.option_type ASC ";
		write_log($sql);
		$query  = $db->query($sql);
		$result_golf = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_1 = '1302' AND m_idx = '$m_idx' AND order_status = 'B' ";
		write_log($sql);
		$query    = $db->query($sql);
		$row      = $query->getResultArray();
        $golf_cnt = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;

        
		// 투어
		$sql    = "SELECT a.*, b.*, c.* FROM tbl_order_mst a
		                                LEFT JOIN tbl_product_mst b  ON a.product_idx = b.product_idx 
										LEFT JOIN tbl_order_option c ON a.order_idx   = c.order_idx   
										WHERE a.product_code_1 = '1301' AND a.m_idx = '$m_idx' AND a.order_status = 'B' ORDER BY a.order_idx ASC, c.option_type ASC ";
		write_log($sql);
		$query  = $db->query($sql);
		$result_tour = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_1 = '1301' AND m_idx = '$m_idx' AND order_status = 'B' ";
		write_log($sql);
		$query    = $db->query($sql);
		$row      = $query->getResultArray();
        $tous_cnt = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;

        return view("cart/item-list", [

            'golf_result' => $result_golf,
            'golf_cnt'    => $golf_cnt
            'tour_result' => $result_tour,
            'tour_cnt'    => $tour_cnt
        
		]);

    }
}