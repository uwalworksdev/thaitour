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
		$type = $this->request->getVar('type'); 
		$private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_name_new), '$private_key') AS order_user_name_new,
					AES_DECRYPT(UNHEX(a.order_user_name_en_new), '$private_key') AS order_user_name_en_new,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.order_user_mobile_new), '$private_key') AS order_user_mobile_new,
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

		if($type == "admin"){
			$user_name = $result->order_user_name;
			$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_mobile = $result->order_user_mobile;
			$order_date = date('d-M-Y(D)', strtotime($result->start_date)) 
						. " " .date('d-M-Y(D)', strtotime($result->end_date))
						. " / ".$result->order_day_cnt." night";
			$room_type = $result->room_type_eng;
			$bed_type = $result->bed_type_eng;
			$order_room_cnt = $result->order_room_cnt;
			$order_people = ($result->adult + $result->kids)  . "Adult(s)";
			$order_memo = $result->order_memo;

		}else{
			if(!empty($result->order_user_name_new)){
				$user_name = $result->order_user_name_new;
			}else{
				$user_name = $result->order_user_name;
			}

			if(!empty($result->order_user_name_en_new)){
				$user_name_en = $result->order_user_name_en_new;
			}else{
				$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_name_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$order_date = date('d-M-Y(D)', strtotime($result->start_date)) 
						. " " .date('d-M-Y(D)', strtotime($result->end_date))
						. " / ".$result->order_day_cnt." night";
			}

			if(!empty($result->room_type_new)){
				$room_type = $result->room_type_new;
			}else{
				$room_type = $result->room_type_eng;
			}

			if(!empty($result->bed_type_new)){
				$bed_type = $result->bed_type_new;
			}else{
				$bed_type = $result->bed_type_eng;
			}

			if(!empty($result->order_room_cnt_new)){
				$order_room_cnt = $result->order_room_cnt_new;
			}else{
				$order_room_cnt = $result->order_room_cnt;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->adult + $result->kids) . "Adult(s)";
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
				$order_memo = $result->order_memo;
			}
		}

        return view("voucher/voucher_hotel", [
            'result'  => $result,
            'type' => $type,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'room_type' => $room_type,
            'bed_type' => $bed_type,
            'order_room_cnt' => $order_room_cnt,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
        ]);        
    }

	public function hotel_save()
	{
		try {
            $order_idx = updateSQ($this->request->getPost('order_idx'));
            $order_user_name_new = updateSQ($this->request->getPost('order_user_name_new') ?? "");
            $order_user_mobile_new = updateSQ($this->request->getPost('order_user_mobile_new') ?? "");
            $order_date_new = updateSQ($this->request->getPost('order_date_new') ?? "");
            $room_type_new = updateSQ($this->request->getPost('room_type_new') ?? "");
            $bed_type_new = updateSQ($this->request->getPost('bed_type_new') ?? "");
            $order_room_cnt_new = updateSQ($this->request->getPost('order_room_cnt_new') ?? "");
            $order_people_new = updateSQ($this->request->getPost('order_people_new') ?? "");
            $order_memo_new = updateSQ($this->request->getPost('order_memo_new') ?? "");
            $order_user_name_en_new = updateSQ($this->request->getPost('order_user_name_en_new') ?? "");
            $child_age_new = updateSQ($this->request->getPost('child_age_new') ?? "");
            $breakfast_new = updateSQ($this->request->getPost('breakfast_new') ?? "");
            $guest_request_new = updateSQ($this->request->getPost('guest_request_new') ?? "");
            $order_remark_new = updateSQ($this->request->getPost('order_remark_new') ?? "");
            $order_option_new = updateSQ($this->request->getPost('order_option_new') ?? "");


			if(!empty($order_idx)) {
				$data = [
					'order_user_mobile_new' => $order_user_mobile_new,
					'order_date_new' => $order_date_new,
					'room_type_new' => $room_type_new,
					'bed_type_new' => $bed_type_new,
					'order_user_name_new' => $order_user_name_new,
					'order_room_cnt_new' => $order_room_cnt_new,
					'order_people_new' => $order_people_new,
					'order_memo_new' => $order_memo_new,
					'order_user_name_en_new' => $order_user_name_en_new,
					'child_age_new' => $child_age_new,
					'breakfast_new' => $breakfast_new,
					'guest_request_new' => $guest_request_new,
					'order_remark_new' => $order_remark_new,
					'order_option_new' => $order_option_new
				];

				$result = $this->ordersModel->updateData($order_idx, $data);

				if($result){
					return $this->response->setJSON([
						'result' => true,
						'message' => "수정되었습니다.",
					]);
				}else {
					return $this->response->setJSON([
						'result' => false,
						'message' => "오류가 발생했습니다!",
					]);
				}
			}else {
				return $this->response->setJSON([
					'result' => false,
					'message' => "order_idx가 존재하지 않습니다!",
				]);
			}

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
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