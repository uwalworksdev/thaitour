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
        helper('my_helper');

    }
	
    public function hotel($idx)
    {
		
		$private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $idx);

		$query  = $builder->get();
		$result = $query->getRow();

        $builder = $db->table('tbl_policy_info');
		$policy = $builder->whereIn('p_idx', [23])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

        return view("voucher/voucher_hotel", [
            'result'  => $result,
            'policy_1' => $policy[0]
        ]);        
    }

    public function tour($idx)
    {
       	$private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $idx);

		$query  = $builder->get();
		$result = $query->getRow();

        return view("voucher/voucher_tour", [
            'result'  => $result,
        ]);
    }

    public function show($idx)
    {
       
        return view("voucher/voucher_show", [
        ]);
    }
    public function golf($idx)
    {
        $db = db_connect();

       	$private_key = private_key(); // 복호화 키

        $builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $idx);

		$query  = $builder->get();
		$result = $query->getRow();

        $builder1 = $db->table('tbl_policy_info');
		$policy = $builder1->whereIn('p_idx', [28])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();
       
        return view("voucher/voucher_golf", [
            'policy_1' => $policy[0],
            'result' => $result
        ]);
    }

    public function ticket($idx)
    {
		$db = db_connect();

        $private_key = private_key(); // 복호화 키

        $builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $idx);

		$query  = $builder->get();
		$result = $query->getRow();

        $builder1 = $db->table('tbl_policy_info');
		$policy = $builder1->whereIn('p_idx', [25])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

        return view("voucher/voucher_ticket", [
            'policy_1' => $policy[0],
            'result' => $result
        ]);
    }
}