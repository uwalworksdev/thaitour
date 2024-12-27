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
        
		// 호텔
		$sql = "SELECT 
				a.*, c.ufile1,
				GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options
				FROM tbl_order_mst a
				LEFT JOIN tbl_order_option b ON   a.order_idx = b.order_idx
				LEFT JOIN tbl_product_mst c ON a.product_idx = c.product_idx
				WHERE a.product_code_1 = '1303' AND a.m_idx = '$m_idx' AND a.order_status = 'B'  
				GROUP BY a.order_no ";

		$query       = $db->query($sql);
		$hotel_result = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_1 = '1303' AND m_idx = '$m_idx' AND order_status = 'B' ";
		$query     = $db->query($sql);
		$row       = $query->getResultArray();
        $hotel_cnt = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;

        
		// 골프
		$sql = "SELECT 
				a.*, c.ufile1,
				GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options
				FROM tbl_order_mst a
				LEFT JOIN tbl_order_option b ON   a.order_idx = b.order_idx
				LEFT JOIN tbl_product_mst c ON a.product_idx = c.product_idx
				WHERE a.product_code_1 = '1302' AND a.m_idx = '$m_idx' AND a.order_status = 'B'  
				GROUP BY a.order_no ";

		$query       = $db->query($sql);
		$golf_result = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_1 = '1302' AND m_idx = '$m_idx' AND order_status = 'B' ";
		$query    = $db->query($sql);
		$row      = $query->getResultArray();
        $golf_cnt = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;

        
		// 투어
		$sql = "SELECT 
				a.*, c.ufile1,
				GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options
				FROM tbl_order_mst a
				LEFT JOIN tbl_order_option b ON a.order_idx = b.order_idx
				LEFT JOIN tbl_product_mst c ON a.product_idx = c.product_idx
				WHERE a.product_code_1 = '1301' AND a.m_idx = '$m_idx' AND a.order_status = 'B'  
				GROUP BY a.order_no ";
		$query        = $db->query($sql);
		$tours_result = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_1 = '1301' AND m_idx = '$m_idx' AND order_status = 'B' ";
		$query     = $db->query($sql);
		$row       = $query->getResultArray();
        $tours_cnt = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;
        
		// 스파
		$sql = "SELECT 
				a.*, c.ufile1,
				GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options
				FROM tbl_order_mst a
				LEFT JOIN tbl_order_option b ON a.order_idx = b.order_idx
				LEFT JOIN tbl_product_mst c ON a.product_idx = c.product_idx
				WHERE a.product_code_1 = '1325' AND a.m_idx = '$m_idx' AND a.order_status = 'B'  
				GROUP BY a.order_no ";
		$query        = $db->query($sql);
		$spa_result   = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_1 = '1325' AND m_idx = '$m_idx' AND order_status = 'B' ";
		$query     = $db->query($sql);
		$row       = $query->getResultArray();
        $spa_cnt   = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;

		// 쇼ㆍ입장권
		$sql = "SELECT 
				a.*, c.ufile1,
				GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options
				FROM tbl_order_mst a
				LEFT JOIN tbl_order_option b ON   a.order_idx = b.order_idx
				LEFT JOIN tbl_product_mst c ON a.product_idx = c.product_idx
				WHERE a.product_code_1 = '1317' AND a.m_idx = '$m_idx' AND a.order_status = 'B'  
				GROUP BY a.order_no ";
		$query         = $db->query($sql);
		$ticket_result = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_1 = '1317' AND m_idx = '$m_idx' AND order_status = 'B' ";
		$query      = $db->query($sql);
		$row        = $query->getResultArray();
        $ticket_cnt = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;

		// 차량
		$sql = "SELECT 
				a.*, c.ufile1,
				GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options
				FROM tbl_order_mst a
				LEFT JOIN tbl_order_option b ON   a.order_idx = b.order_idx
				LEFT JOIN tbl_product_mst c ON a.product_idx = c.product_idx
				WHERE a.product_code_1 = '1324' AND a.m_idx = '$m_idx' AND a.order_status = 'B'  
				GROUP BY a.order_no ";
		$query         = $db->query($sql);
		$car_result = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_1 = '1324' AND m_idx = '$m_idx' AND order_status = 'B' ";
		$query      = $db->query($sql);
		$row        = $query->getResultArray();
        $car_cnt = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;

		// 가이드
		$sql = "SELECT 
				a.*, c.ufile1,
				GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options
				FROM tbl_order_mst a
				LEFT JOIN tbl_order_option b ON   a.order_idx = b.order_idx
				LEFT JOIN tbl_product_mst c ON a.product_idx = c.product_idx
				WHERE a.product_code_2 = '132403' AND a.m_idx = '$m_idx' AND a.order_status = 'B'  
				GROUP BY a.order_no ";
		$query         = $db->query($sql);
		$guides_result = $query->getResultArray();

		$sql    = "SELECT COUNT(*) AS order_cnt FROM tbl_order_mst
										        WHERE product_code_2 = '132403' AND m_idx = '$m_idx' AND order_status = 'B' ";
		$query      = $db->query($sql);
		$row        = $query->getResultArray();
        $guides_cnt = isset($row[0]['order_cnt']) ? $row[0]['order_cnt'] : 0;


        return view("cart/item-list", [

            'hotel_result'  => $hotel_result,
            'hotel_cnt'     => $hotel_cnt,

            'golf_result'   => $golf_result,
            'golf_cnt'      => $golf_cnt,

            'tours_result'  => $tours_result,
            'tours_cnt'     => $tours_cnt,

            'spa_result'    => $spa_result,
            'spa_cnt'       => $spa_cnt,

            'ticket_result' => $ticket_result,
            'ticket_cnt'    => $ticket_cnt,

            'car_result'    => $car_result,
            'car_cnt'       => $car_cnt, 

            'guides_result' => $guides_result,
            'guides_cnt'    => $guides_cnt 
        
		]);

    }
}