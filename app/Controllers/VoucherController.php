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
    private $orderOptionModel;


    public function __construct() {
        $this->db           = db_connect();
        $this->productModel = model("ProductModel");
        $this->ordersModel  = model("OrdersModel");
        $this->roomImg      = model("RoomImg");
        $this->CodeModel    = model("Code");
        $this->orderOptionModel = model("OrderOptionModel");

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
			$room_type = $result->room_type;
			$bed_type = $result->bed_type;
			$order_room_cnt = $result->order_room_cnt;
			$order_people = ($result->adult + $result->kids)  . "Adult(s)";
			$order_memo = $result->order_memo;
			$breakfast = $result->breakfast == "N" ? "Include (No) Adult Breakfast" : "Include (Yes) Adult Breakfast";
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

			if(!empty($result->order_user_mobile_new)){
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
				$room_type = $result->room_type;
			}

			if(!empty($result->bed_type_new)){
				$bed_type = $result->bed_type_new;
			}else{
				$bed_type = $result->bed_type;
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

			if(!empty($result->child_age_new)){
				$child_age = $result->child_age_new;
			}

			if(!empty($result->breakfast_new)){
				$breakfast = $result->breakfast_new;
			}else{
				$breakfast = $result->breakfast == "N" ? "Include (No) Adult Breakfast" : "Include (Yes) Adult Breakfast";
			}

			if(!empty($result->guest_request_new)){
				$guest_request = $result->guest_request_new;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}

			if(!empty($result->order_option_new)){
				$order_option = $result->order_option_new;
			}
		}

        return view("voucher/voucher_hotel", [
            'result'  => $result,
            'policy'  => $policy[0],
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
			'child_age' => $child_age,
			'breakfast' => $breakfast,
			'guest_request' => $guest_request,
			'order_remark' => $order_remark,
			'order_option' => $order_option
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

		if($type == "admin"){
			$user_name = $result->order_user_name;
			$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_mobile = $result->order_user_mobile;
			$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)" . ($result->people_child_cnt ?? 0) . " Child(s)" . ($result->people_baby_cnt ?? 0) . " Baby(s)"; 
			$order_memo = $result->order_memo;
			$order_date = $result->order_day;
			$time_line = $result->time_line;
			$start_place = $result->start_place;
			$pick_time = $result->description;
			$id_kakao = $result->id_kakao;
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

			if(!empty($result->order_user_mobile_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$order_date = $result->order_day;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)" . ($result->people_child_cnt ?? 0) . " Child(s)" . ($result->people_baby_cnt ?? 0) . " Baby(s)"; 
			}

			if(!empty($result->time_line_en)){
				$time_line = $result->time_line_en;
			}else{
				$time_line = $result->time_line;
			}

			if(!empty($result->start_place_en)){
				$start_place = $result->start_place_en;
			}else{
				$start_place = $result->start_place;
			}

			if(!empty($result->id_kakao_en)){
				$id_kakao = $result->id_kakao_en;
			}else{
				$id_kakao = $result->id_kakao;
			}

			if(!empty($result->pick_time_en)){
				$pick_time = $result->pick_time_en;
			}else{
				$pick_time = $result->description;
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
				$order_memo = $result->order_memo;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}

			if(!empty($result->order_option_new)){
				$order_option = $result->order_option_new;
			}
		}

        return view("voucher/voucher_tour", [
            'result' => $result,
			'type' => $type,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
			'order_remark' => $order_remark,
			'order_option' => $order_option,
			'start_place' => $start_place,
			'pick_time' => $pick_time,
			'id_kakao' => $id_kakao,
			'time_line' => $time_line,
        ]);
    }

    public function show($idx)
    {
       
        return view("voucher/voucher_show", [
        ]);
    }
    public function golf($idx)
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
		$main_op = $this->orderOptionModel->getOption($result->order_idx, 'main')[0];

		$main    = explode("|", $main_op["option_name"]);
		// var_dump($this->orderOptionModel->getOption($result->order_idx, 'main'));
		// die();
        $option  = $this->orderOptionModel->getOption($result->order_idx, 'option');
        $vehicle = $this->orderOptionModel->getOption($result->order_idx, 'vehicle');

		foreach ($vehicle as $key => $item): 
			if($item['option_name'] == "카트")   $cart  = $item['option_cnt'];
			if($item['option_name'] == "캐디피") $caddy = $item['option_cnt'];
		endforeach; 

		$fee = "인원 :". $main_op["option_cnt"] . "명" . " / 캐디: " . $cart . "명" . " / 카트: " . $caddy . "명";

		$hole = trim(explode(":", $main[0])[1]);
		$date = trim(explode(":", $main[1])[1]);
		$day_time = trim(explode(":", $main[1])[0]);
		$parts = explode(":", $main[2]);
		$tee_time = "";
		if(!empty($parts[1]) && !empty($parts[2])){
			$minute = str_pad(trim($parts[1]), 2, "0", STR_PAD_LEFT);
			$second = str_pad(trim($parts[2]), 2, "0", STR_PAD_LEFT);
			$tee_time = $minute . " : " . $second;
		}
		if($type == "admin"){
			$user_name = $result->order_user_name;
			$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_mobile = $result->order_user_mobile;
			$order_date = $date;
			$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)";
			$order_memo = $result->order_memo;
			$order_tee_time = $tee_time;
			$order_hole = $hole . " " . $day_time;
			$order_fee = $fee;
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

			if(!empty($result->order_user_mobile_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$order_date = $date;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->people_adult_cnt ?? 0) . " Adult(s)";
			}

			if(!empty($result->t_times_en)){
				$order_tee_time = $result->t_times_en;
			}else{
				$order_tee_time = $tee_time;
			}

			if(!empty($result->hole_en)){
				$order_hole = $result->hole_en;
			}else{
				$order_hole = $hole . " " . $day_time;
			}

			if(!empty($result->fee_en)){
				$order_fee = $result->fee_en;
			}else{
				$order_fee = $fee;
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
				$order_memo = $result->order_memo;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}

			if(!empty($result->order_option_new)){
				$order_option = $result->order_option_new;
			}
		}

        $builder1 = $db->table('tbl_policy_info');
		$policy = $builder1->whereIn('p_idx', [28])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();
       
        return view("voucher/voucher_golf", [
            'policy_1' => $policy[0],
            'result' => $result,
			'type' => $type,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
			'order_remark' => $order_remark,
			'order_option' => $order_option,
			'order_hole' => $order_hole,
			'order_tee_time' => $order_tee_time,
			'order_fee' => $order_fee,
			'option' => $option,
        ]);
    }

	public function golf_save()
	{
		try {
            $order_idx = updateSQ($this->request->getPost('order_idx'));
            $order_user_name_new = updateSQ($this->request->getPost('order_user_name_new') ?? "");
            $order_user_mobile_new = updateSQ($this->request->getPost('order_user_mobile_new') ?? "");
            $order_date_new = updateSQ($this->request->getPost('order_date_new') ?? "");
            $t_times_en = updateSQ($this->request->getPost('t_times_en') ?? "");
            $hole_en = updateSQ($this->request->getPost('hole_en') ?? "");
            $fee_en = updateSQ($this->request->getPost('fee_en') ?? "");
            $order_people_new = updateSQ($this->request->getPost('order_people_new') ?? "");
            $order_memo_new = updateSQ($this->request->getPost('order_memo_new') ?? "");
            $order_user_name_en_new = updateSQ($this->request->getPost('order_user_name_en_new') ?? "");
            $order_remark_new = updateSQ($this->request->getPost('order_remark_new') ?? "");
            $order_option_new = updateSQ($this->request->getPost('order_option_new') ?? "");


			if(!empty($order_idx)) {
				$data = [
					'order_user_mobile_new' => $order_user_mobile_new,
					'order_date_new' => $order_date_new,
					'order_user_name_new' => $order_user_name_new,
					'order_people_new' => $order_people_new,
					'order_memo_new' => $order_memo_new,
					'order_user_name_en_new' => $order_user_name_en_new,
					'order_remark_new' => $order_remark_new,
					'order_option_new' => $order_option_new,
					't_times_en' => $t_times_en,
					'hole_en' => $hole_en,
					'fee_en' => $fee_en,
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