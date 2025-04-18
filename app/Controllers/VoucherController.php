<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class VoucherController extends BaseController
{
    private $db;
    private $productModel;
    private $ordersModel;
    private $roomImg;
    private $CodeModel;


    public function __construct() {
        $this->db           = db_connect();
        $this->productModel = model("ProductModel");
        $this->ordersModel  = model("OrdersModel");
        $this->roomImg      = model("RoomImg");
        $this->CodeModel    = model("Code");
    }
	
    public function hotel(idx)
    {
		
		$private_key = private_key();
		
		$db      = db_connect(); // DB 연결
		$builder = $db->table('tbl_order_mst'); // 테이블 지정
		$builder->select(" *,
			AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
			AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS order_user_email,
			AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS order_user_first_name_en,
			AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS order_user_last_name_en,
			AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
			AES_DECRYPT(UNHEX(local_phone), '$private_key') AS local_phone,
			AES_DECRYPT(UNHEX(order_zip), '$private_key') AS order_zip,
			AES_DECRYPT(UNHEX(order_addr1), '$private_key') AS order_addr1,
			AES_DECRYPT(UNHEX(order_addr2), '$private_key') AS order_addr2,
			AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name
		");		
		$query   = $builder->where('order_idx', $idx)->get(); // 조건 추가 후 실행
        //write_log("last query- ". $db->getLastQuery());

		$result  = $query->getResult(); // 결과 가져오기 (객체 배열)
       
        return view("voucher/voucher_hotel", [ 'result'  => $result ]);        
    }

    public function tour()
    {
       
        return view("voucher/voucher_tour", [
        ]);
    }

    public function show()
    {
       
        return view("voucher/voucher_show", [
        ]);
    }
    public function golf()
    {
       
        return view("voucher/voucher_golf", [
        ]);
    }

    public function ticket()
    {
       
        return view("voucher/voucher_ticket", [
        ]);
    }
}