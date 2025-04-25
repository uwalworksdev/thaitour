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
	
	public function golf_01($idx)
	{
		$private_key = private_key();
		$db = db_connect(); // DB 연결

		$builder = $db->table('tbl_order_mst');
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

		$query  = $builder->where('order_idx', $idx)->get();
		$result = $query->getResultArray();
		$row    = $result[0]; // ✅ 배열에서 첫 row만 추출

		// 메인 옵션
		$query1     = $db->query("SELECT * FROM tbl_order_option WHERE order_idx = '". $idx ."' AND option_type = 'main' ");
		$order_info = $query1->getRowArray();

		// 기타 옵션
		$query2      = $db->query("SELECT * FROM tbl_order_option WHERE order_idx = '". $idx ."' AND option_type != 'main' ");
		$golf_option = $query2->getResultArray();

		$product_idx = $row["product_idx"];

		$builder = $db->table('tbl_product_mst');
		$builder->select("notice_comment");
		$query  = $builder->where('product_idx', $product_idx)->get();
		$result = $query->getRowArray();
		$notice_contents = $result["notice_comment"];

		$builder = $db->table('tbl_policy_cancel');
		$builder->select("policy_contents");
		$query  = $builder->where('product_idx', $product_idx)->get();
		$result = $query->getRowArray();
		$cancle_contents = $result["policy_contents"];

		return view("invoice/invoice_golf_01", [
			'row'         => $row,
			'golf_info'   => $order_info,
			'golf_option' => $golf_option,
			'notice_contents' => $notice_contents,
			'cancle_contents' => $cancle_contents,
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
       
        $builder = $db->table('tbl_policy_info');
		$policy = $builder->whereIn('p_idx', [24, 26])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

        return view("invoice/invoice_hotel_01", [ 
			'result' 	=> $result, 
			'policy_1' 	=> $policy[0],
			'policy_2' 	=> $policy[1],
		]);
    }

    public function ticket_01($idx)
    {
				$private_key = private_key();

				$db = db_connect(); // DB 연결

				// 주문 정보 가져오기
				$builder = $db->table('tbl_order_mst');
				$builder->select("
					*,
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
				$query = $builder->where('order_idx', $idx)->get();
				//write_log("last query- " . $db->getLastQuery());
				$orderResult = $query->getResult(); // 주문 데이터 (객체 배열)

				// 옵션 정보 가져오기
				$builder = $db->table('tbl_order_option');
				$builder->select("option_name, option_tot, option_cnt, option_date, option_qty, baht_thai");
				$query = $builder->where('order_idx', $idx)->get();
				$optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

				// 주문 객체에 옵션 정보 추가
				foreach ($orderResult as $order) {
					$order->options = $optionResult; // options 키에 옵션 배열 추가
				}

				$firstRow = $orderResult[0] ?? null;

				$product_idx = $firstRow->product_idx;
		
				$builder = $db->table('tbl_product_mst');
				$builder->select("notice_comment");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$notice_contents = $result["notice_comment"];
		
				$builder = $db->table('tbl_policy_cancel');
				$builder->select("policy_contents");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$cancle_contents = $result["policy_contents"];

				return view("invoice/invoice_ticket_01", [
					'result' => $orderResult,
					'notice_contents' => $notice_contents,
					'cancle_contents' => $cancle_contents
				]);

    }

    public function ticket_02()
    {
       
        return view("invoice/invoice_ticket_02", [
        ]);
    }

    public function tour_01($idx)
    {
				$private_key = private_key();

				$db = db_connect(); // DB 연결

				// 주문 정보 가져오기
				$builder = $db->table('tbl_order_mst');
				$builder->select("
					*,
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
				$query = $builder->where('order_idx', $idx)->get();
				//write_log("last query- " . $db->getLastQuery());
				$orderResult = $query->getResult(); // 주문 데이터 (객체 배열)

				// 옵션 정보 가져오기
				$builder = $db->table('tbl_order_option');
				$builder->select("option_name, option_tot, option_cnt, option_date, option_qty, baht_thai");
				$query = $builder->where('order_idx', $idx)->get();
				$optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

				// 주문 객체에 옵션 정보 추가
				foreach ($orderResult as $order) {
					$order->options = $optionResult; // options 키에 옵션 배열 추가
				}

				$firstRow = $orderResult[0] ?? null;

				$product_idx = $firstRow->product_idx;

				$builder = $db->table('tbl_product_mst');
				$builder->select("notice_comment");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$notice_contents = $result["notice_comment"];
		
				$builder = $db->table('tbl_policy_cancel');
				$builder->select("policy_contents");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$cancle_contents = $result["policy_contents"];

				return view("invoice/invoice_tour_01", [
					'result' => $orderResult,
					'notice_contents' => $notice_contents,
					'cancle_contents' => $cancle_contents
				]);
				
	}
	
    public function car_01($idx)
    {
				$private_key = private_key();

				$db = db_connect(); // DB 연결

				// 주문 정보 가져오기
				$builder = $db->table('tbl_order_mst');
				$builder->select("
					*,
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
				$query = $builder->where('order_idx', $idx)->get();
				//write_log("last query- " . $db->getLastQuery());
				$orderResult = $query->getResult(); // 주문 데이터 (객체 배열)

				// 옵션 정보 가져오기
				$builder = $db->table('tbl_order_option');
				$builder->select("option_name, option_tot, option_cnt, option_date, option_qty, baht_thai");
				$query = $builder->where('order_idx', $idx)->get();
				$optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

				// 주문 객체에 옵션 정보 추가
				foreach ($orderResult as $order) {
					$order->options = $optionResult; // options 키에 옵션 배열 추가
				}

				$firstRow = $orderResult[0] ?? null;

				$product_idx = $firstRow->product_idx;
		
				$builder = $db->table('tbl_product_mst');
				$builder->select("product_info");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$notice_contents = $result["product_info"];
		
				$builder = $db->table('tbl_policy_cancel');
				$builder->select("policy_contents");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$cancle_contents = $result["policy_contents"];

				return view("invoice/invoice_car_01", [
					'result' => $orderResult,
					'notice_contents' => $notice_contents,
					'cancle_contents' => $cancle_contents,
				]);
				
	}
	
    public function guide_01($idx)
    {
				$private_key = private_key();

				$db = db_connect(); // DB 연결

				// 주문 정보 가져오기
				$builder = $db->table('tbl_order_mst');
				$builder->select("
					*,
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
				$query = $builder->where('order_idx', $idx)->get();
				//write_log("last query- " . $db->getLastQuery());
				$orderResult = $query->getResult(); // 주문 데이터 (객체 배열)

				// 옵션 정보 가져오기
				$builder = $db->table('tbl_order_option');
				$builder->select("option_name, option_tot, option_cnt, option_date, option_qty, baht_thai");
				$query = $builder->where('order_idx', $idx)->get();
				$optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

				// 주문 객체에 옵션 정보 추가
				foreach ($orderResult as $order) {
					$order->options = $optionResult; // options 키에 옵션 배열 추가
				}

				$firstRow = $orderResult[0] ?? null;

				$product_idx = $firstRow->product_idx;
		
				$builder = $db->table('tbl_product_mst');
				$builder->select("product_info");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$notice_contents = $result["product_info"];
		
				$builder = $db->table('tbl_policy_cancel');
				$builder->select("policy_contents");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$cancle_contents = $result["policy_contents"];

				return view("invoice/invoice_guide_01", [
					'result' => $orderResult,
					'notice_contents' => $notice_contents,
					'cancle_contents' => $cancle_contents,
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