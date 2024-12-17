<?php

namespace App\Controllers;

class CheckoutController extends BaseController
{
    private $db;
    private $productModel;

    public function __construct() {
        $this->db = db_connect();
        $this->orderModel = model("orderModel");

    }

    public function show()
    {
        $db         = \Config\Database::connect();

		$array = explode(",", $_POST['dataValue']);

		// 각 요소에 작은따옴표 추가
		$quotedArray = array_map(function($item) {
			return "'" . $item . "'";
		}, $array);

		// 배열을 다시 문자열로 변환
		$output = implode(',', $quotedArray);
write_log($output);
		$sql = "SELECT 
				tbl_order_mst.order_idx,
				tbl_order_mst.product_name,
				tbl_order_mst.order_price,
				GROUP_CONCAT(CONCAT(tbl_order_option.option_name, ':', tbl_order_option.option_cnt) SEPARATOR '|') as options
				FROM 
					tbl_order_mst
				LEFT JOIN 
					tbl_order_option 
				ON 
					tbl_order_mst.order_idx = tbl_order_option.order_idx
				WHERE tbl_order_mst.order_no IN('111111') AND order_no != '' 
				GROUP BY 
					tbl_order_mst.order_no ";
        write_log($sql); 
        //$result = $db->connect->query($sql);
        //$row    = $result->getRowArray();

        return view("checkout/show", [
            "row" => $row 
        ]);
    }

    public function confirm()
    {
        return view('checkout/confirm');
    }

    public function bank()
    {
        return view('checkout/bank');
    }
}
