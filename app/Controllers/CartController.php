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
		// 첫 번째 쿼리
		$builder = $db->table('tbl_order_mst a');

		// JOIN
		$builder->join('tbl_order_option b', 'a.order_idx = b.order_idx', 'left');
		$builder->join('tbl_product_mst c', 'a.product_idx = c.product_idx', 'left');

		// SELECT
		$builder->select('a.*, c.ufile1');
		$builder->select("GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options");

		// WHERE 조건
		$builder->where('a.order_gubun', 'tour');
		$builder->where('a.m_idx', $m_idx);
		$builder->where('a.order_status', 'B');

		// GROUP BY
		$builder->groupBy('a.order_no');

		// 실행 및 결과 반환
		$query         = $builder->get();
		$tours_result  = $query->getResultArray();

		// 두 번째 쿼리
		$builder = $db->table('tbl_order_mst');

		// SELECT COUNT
		$builder->selectCount('*', 'order_cnt'); // COUNT(*) AS order_cnt

		// WHERE 조건
		$builder->where('order_gubun', 'tour');
		$builder->where('m_idx', $m_idx);
		$builder->where('order_status', 'B');

		// 실행 및 결과 반환
		$query      = $builder->get();
		$row        = $query->getRowArray(); // 단일 행 결과
		$tours_cnt  = isset($row['order_cnt']) ? $row['order_cnt'] : 0;
        
		// 스파
		// 첫 번째 쿼리
		$builder = $db->table('tbl_order_mst a');

		// JOIN
		$builder->join('tbl_order_option b', 'a.order_idx = b.order_idx', 'left');
		$builder->join('tbl_product_mst c', 'a.product_idx = c.product_idx', 'left');

		// SELECT
		$builder->select('a.*, c.ufile1');
		$builder->select("GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options");

		// WHERE 조건
		$builder->where('a.order_gubun', 'spa');
		$builder->where('a.m_idx', $m_idx);
		$builder->where('a.order_status', 'B');

		// GROUP BY
		$builder->groupBy('a.order_no');

		// 실행 및 결과 반환
		$query         = $builder->get();
		$spa_result = $query->getResultArray();

		// 두 번째 쿼리
		$builder = $db->table('tbl_order_mst');

		// SELECT COUNT
		$builder->selectCount('*', 'order_cnt'); // COUNT(*) AS order_cnt

		// WHERE 조건
		$builder->where('order_gubun', 'spa');
		$builder->where('m_idx', $m_idx);
		$builder->where('order_status', 'B');

		// 실행 및 결과 반환
		$query      = $builder->get();
		$row        = $query->getRowArray(); // 단일 행 결과
		$spa_cnt    = isset($row['order_cnt']) ? $row['order_cnt'] : 0;

		// 쇼ㆍ입장권
		// 첫 번째 쿼리
		$builder = $db->table('tbl_order_mst a');

		// JOIN
		$builder->join('tbl_order_option b', 'a.order_idx = b.order_idx', 'left');
		$builder->join('tbl_product_mst c', 'a.product_idx = c.product_idx', 'left');

		// SELECT
		$builder->select('a.*, c.ufile1');
		$builder->select("GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options");

		// WHERE 조건
		$builder->where('a.order_gubun', 'ticket');
		$builder->where('a.m_idx', $m_idx);
		$builder->where('a.order_status', 'B');

		// GROUP BY
		$builder->groupBy('a.order_no');

		// 실행 및 결과 반환
		$query         = $builder->get();
		$ticket_result = $query->getResultArray();

		// 두 번째 쿼리
		$builder = $db->table('tbl_order_mst');

		// SELECT COUNT
		$builder->selectCount('*', 'order_cnt'); // COUNT(*) AS order_cnt

		// WHERE 조건
		$builder->where('order_gubun', 'ticket');
		$builder->where('m_idx', $m_idx);
		$builder->where('order_status', 'B');

		// 실행 및 결과 반환
		$query      = $builder->get();
		$row        = $query->getRowArray(); // 단일 행 결과
		$ticket_cnt = isset($row['order_cnt']) ? $row['order_cnt'] : 0;


		// 차량
		// 첫 번째 쿼리
		$builder = $db->table('tbl_order_mst a');

		// JOIN
		$builder->join('tbl_order_option b', 'a.order_idx = b.order_idx', 'left');
		$builder->join('tbl_product_mst c', 'a.product_idx = c.product_idx', 'left');

		// SELECT
		$builder->select('a.*, c.ufile1');
		$builder->select("GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options");

		// WHERE 조건
		$builder->where('a.order_gubun', 'vehicle');
		$builder->where('a.m_idx', $m_idx);
		$builder->where('a.order_status', 'B');

		// GROUP BY
		$builder->groupBy('a.order_no');

		// 실행 및 결과 반환
		$query         = $builder->get();
		$car_result = $query->getResultArray();

		// 두 번째 쿼리
		$builder = $db->table('tbl_order_mst');

		// SELECT COUNT
		$builder->selectCount('*', 'order_cnt'); // COUNT(*) AS order_cnt

		// WHERE 조건
		$builder->where('order_gubun', 'vehicle');
		$builder->where('m_idx', $m_idx);
		$builder->where('order_status', 'B');

		// 실행 및 결과 반환
		$query      = $builder->get();
		$row        = $query->getRowArray(); // 단일 행 결과
		$car_cnt    = isset($row['order_cnt']) ? $row['order_cnt'] : 0;

		// 가이드
		// 첫 번째 쿼리
		$builder = $db->table('tbl_order_mst a');

		// JOIN
		$builder->join('tbl_order_option b', 'a.order_idx = b.order_idx', 'left');
		$builder->join('tbl_product_mst c', 'a.product_idx = c.product_idx', 'left');

		// SELECT
		$builder->select('a.*, c.ufile1');
		$builder->select("GROUP_CONCAT(CONCAT(b.option_name, ':', b.option_cnt, ':', b.option_tot) SEPARATOR '|') as options");

		// WHERE 조건
		$builder->where('a.order_gubun', 'guide');
		$builder->where('a.m_idx', $m_idx);
		$builder->where('a.order_status', 'B');

		// GROUP BY
		$builder->groupBy('a.order_no');

		// 실행 및 결과 반환
		$query         = $builder->get();
		$guides_result = $query->getResultArray();

		// 두 번째 쿼리
		$builder = $db->table('tbl_order_mst');

		// SELECT COUNT
		$builder->selectCount('*', 'order_cnt'); // COUNT(*) AS order_cnt

		// WHERE 조건
		$builder->where('order_gubun', 'guide');
		$builder->where('m_idx', $m_idx);
		$builder->where('order_status', 'B');

		// 실행 및 결과 반환
		$query      = $builder->get();
		$row        = $query->getRowArray(); // 단일 행 결과
		$guides_cnt = isset($row['order_cnt']) ? $row['order_cnt'] : 0;


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