<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class InvoiceController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
        helper('my_helper');
    }
    public function golf()
    {
       
        return view("invoice/invoice_golf", [
        ]);
    }

    public function hotel()
    {
       
        return view("invoice/invoice_hotel", [
        ]);
    }

    public function hotel_01($idx)
    {
		$private_key = private_key();
		
		$db      = db_connect(); // DB 연결
		$builder = $db->table('tbl_order_mst'); // 테이블 지정
		$builder->select(" *,
			AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name
		");		
		$query   = $builder->where('order_idx', $idx)->get(); // 조건 추가 후 실행

		$result  = $query->getResult(); // 결과 가져오기 (객체 배열)
       
        return view("invoice/invoice_hotel_01", [ 'result'  => $result
        ]);
    }

    public function ticket_01()
    {
       
        return view("invoice/invoice_ticket_01", [
        ]);
    }

    public function ticket_02()
    {
       
        return view("invoice/invoice_ticket_02", [
        ]);
    }

    public function payment_golf()
    {
       
        return view("invoice/payment_golf", [
        ]);
    }

    public function bank_info()
    {
       
        return view("invoice/bank_info_view", [
        ]);
    }

    public function bank_info_account()
    {
       
        return view("invoice/bank_info_account", [
        ]);
    }
}