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
		$db = \Config\Database::connect(); // 데이터베이스 연결
		$m_idx  = session("member.idx");
		$sql    = "SELECT * FROM tbl_order_mst WHERE m_idx = '$m_idx' AND order_status = 'B' ";
		write_log($sql);
		$query  = $db->query($sql);
		$result = $query->getResultArray();

        return view("cart/item-list", [
            'result' => $result
        ]);

    }
}