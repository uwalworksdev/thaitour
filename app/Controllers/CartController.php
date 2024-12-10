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
		$m_idx  = session("member.idx");
		$query  = $this->db->query("SELECT * FROM tbl_order_mst WHERE m_idx = '$m_idx' AND order_status = 'B' " );
		$result = $query->getResult();

        return view("cart/item-list", [
            'result' => $result
        ]);

    }
}