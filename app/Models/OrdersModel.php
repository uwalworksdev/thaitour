<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table      = "tbl_order_mst";
    protected $primaryKey = "order_idx";
    protected $allowedFields = [
          "m_idx", "air_idx", "yoil_idx", "home_depart_date", "away_arrive_date"
        , "away_depart_date", "home_arrive_date", "product_idx", "product_cnt", "product_code_1", "product_code_2", "product_code_3"
        , "product_code_4", "product_code_list", "code_name", "product_name", "tours_subject", "order_mileage_yn"
        , "order_gubun", "order_no", "order_date", "confirmed_datetime", "order_user_name", "order_user_email", "order_user_mobile", "order_user_phone"
        , "order_memo", "admin_memo", "manager_name", "manager_phone", "manager_email", "start_date", "end_date"
        , "product_period", "tour_period", "people_adult_cnt", "people_adult_price", "people_kids_cnt", "people_kids_price"
        , "people_baby_cnt", "people_baby_price", "oil_price", "inital_price", "order_price", "order_price_bath", "option_amt", "extra_cost", "order_confirm_price"
		, "real_price_bath", "real_price_won", "voucher_price_bath", "voucher_price_won"
	    , "price", "price_won", "extra_won", "extra_bath","room", "room_type", "bed_type", "date_price", "adult", "kids", "last_price" , "rooms_idx", "room_g_idx", "bed_idx"		
        , "order_confirm_date", "confirm_method", "deposit_price", "deposit_date", "deposit_method", "order_pg", "order_method", "used_op_type", "room_op_price_sale"
        , "used_coupon_idx", "used_coupon_no", "used_coupon_point", "used_coupon_money", "product_mileage", "used_mileage_money"
        , "order_mileage", "order_status", "order_m_date", "order_r_date", "order_d_date", "order_c_date", "is_modify"
        , "paydate", "erp_seq", "ResultCode_1", "ResultMsg_1", "Amt_1", "TID_1", "AuthCode_1", "AuthDate_1", "CancelDate_1"
        , "VbankBankCode_1", "VbankBankName_1", "VbankNum_1", "VbankExpDate_1", "VbankExpTime_1", "additional_request"
        , "ResultCode_2", "ResultMsg_2", "Amt_2", "TID_2", "AuthCode_2", "AuthDate_2", "CancelDate_2", "VbankBankCode_2"
        , "VbankBankName_2", "VbankNum_2", "VbankExpDate_2", "VbankExpTime_2", "depositor_1", "bank_1", "depositor_2"
        , "bank_2", "isDelete", "delDate", "encode", "custom_req", "custom_req_eng", "local_phone", "order_zip", "order_addr1", "order_addr2"
        , "deposit_price_change", "price_confirm_change", "total_price_change", "bbs_no", "transfer_date", "user_id"
        , "kakao_id", "order_name_kor_list", "order_name_eng_list", "order_mobile_list", "order_email_list", "device_type", "ip"
        , "room_op_idx", "order_room_cnt", "order_day_cnt", "order_user_first_name_en", "order_user_last_name_en", "order_user_gender", "order_gender_list"
        , "order_passport_number", "order_passport_expiry_date", "order_birth_date", "breakfast_order_new"
        , "vehicle_time", "departure_point", "order_day", "departure_area", "destination_area", "departure_name_", "destination_name_", "meeting_date", "return_date", "departure_hotel"
        , "destination_hotel", "ca_depth_idx", "code_parent_category", "cp_idx", "time_line", "ho_idx", "baht_thai", "breakfast", "group_no", "payment_no", "pickup_place", "sanding_place"
		, "category_code_name", "start_place", "end_place", "id_kakao", "description", "order_user_mobile_new", "order_date_new", "room_type_new", "bed_type_new"
		, "order_user_name_new", "order_room_cnt_new", "order_people_new", "order_memo_new", "order_user_name_en_new", "child_age_new"
		, "breakfast_new", "guest_request_new", "order_remark_new", "order_option_new", "t_times_en", "hole_en", "fee_en", "start_place_en", "pick_time_en"
		, "id_kakao_en", "time_line_en", "tours_idx", "tour_type_en", "number_staff", "number_luggage", "cus_cnt", "metting_date", "special_request", "notes_invoice", "chk_notes_invoice"
    ];
    protected $encryptedField = [ "order_user_name", 
	                              "order_user_name_new",
								  "order_user_name_en_new",
	                              "order_user_email", 
	                              "order_user_mobile",
								  "order_user_mobile_new", 
	                              "order_user_phone", 
	                              "local_phone", 
	                              "order_user_first_name_en", 
	                              "order_user_last_name_en", 
		                          "order_passport_number",
	                              "manager_name", 
	                              "manager_phone", 
	                              "manager_email",];

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
            if (in_array($key, $this->encryptedField)) {
                $filteredData[$key] = encryptField($value, "encode");
            }
        }

        return $this->insert($filteredData);
    }

    public function updateData($id, $data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
            if (in_array($key, $this->encryptedField)) {
                $filteredData[$key] = encryptField($value, "encode");
            }
        }

        return $this->update($id, $filteredData);
    }

    public function getOrders($s_txt = null, $search_category = null, $pg = 1, $g_list_rows = 10, $where = [])
    {
        $private_key = private_key();

        $builder = $this->db->table('tbl_order_mst as s1')
            ->select('s1.*, s3.code_name')
            ->join('tbl_product_mst as s2', 's1.product_idx = s2.product_idx', 'left')
            ->join('tbl_code as s3', 's1.product_code_1 = s3.code_no', 'left')
            ->where('s1.order_status !=', 'B')
            ->where('s1.is_modify', 'N')
            ->where('s1.isDelete !=', 'Y')
            ->where('s1.order_status !=', 'D');

        if ($where) {
            $builder->where($where);
        }

        if ($s_txt && $search_category == 'order_user_name') {
            $builder->like("CONVERT(AES_DECRYPT(UNHEX($search_category),'$private_key') USING utf8)", $s_txt);
        }

        if ($s_txt && $search_category == 'product_name') {
            $builder->like("s2.product_name", $s_txt);
        }

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('s1.order_r_date', 'desc')
            ->orderBy('s1.order_idx', 'desc')
            ->limit($g_list_rows, $nFrom);

        $order_list = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
            'order_list' => $order_list,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
        ];
    }

	public function getOrdersGroup($pg = 1, $g_list_rows = 10, $dateType, $procType, $checkInDate, $checkOutDate, $payType, $prodType, $searchType, $search_word)
	{
		$private_key = private_key();
		
		// 기본 쿼리
		$builder = $this->db->table('tbl_order_mst')
			->select("
				tbl_order_mst.*, 
				(SELECT COUNT(*) FROM tbl_order_mst AS t2 WHERE t2.group_no = tbl_order_mst.group_no) as group_count,
				AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
				AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
				AES_DECRYPT(UNHEX(order_user_phone), '$private_key') AS order_user_phone,
				AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS order_user_email,
				AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name,
				AES_DECRYPT(UNHEX(manager_phone), '$private_key') AS manager_phone,
				AES_DECRYPT(UNHEX(manager_email), '$private_key') AS manager_email,
				AES_DECRYPT(UNHEX(local_phone), '$private_key') AS local_phone,
				AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS order_user_first_name_en,
				AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS order_user_last_name_en
			");

		$builder->where('m_idx', $_SESSION["member"]["mIdx"]);
        $builder->whereNotIn('order_status', ['B', 'D']);

		// 날짜 필터 적용
		if ($dateType == "1" && $checkInDate && $checkOutDate) {
			$builder->where("DATE(order_day) BETWEEN '$checkInDate' AND '$checkOutDate'");
		}
		if ($dateType == "2" && $checkInDate && $checkOutDate) {
			$builder->where("DATE(order_date) BETWEEN '$checkInDate' AND '$checkOutDate'");
		}

		// 결제 상태 필터
		$payStatusMap = [
			"1" => ['W', 'Y', 'G', 'R', 'J'],
			"2" => ['Z'],
			"3" => ['E'],
			"4" => ['C'],
			"5" => ['N'],
		];
		if (!empty($procType) && isset($payStatusMap[$procType])) {
			$builder->whereIn('order_status', $payStatusMap[$procType]);
		}

		// 상품 유형 필터
		if (!empty($prodType)) {
			$builder->where('order_gubun', $prodType);
		}

		// 검색 필터
		if (!empty($search_word)) {
			switch ($searchType) {
				case "1":
					$builder->like('product_name', $search_word);
					break;
				case "2":
					$builder->where("CONVERT(AES_DECRYPT(UNHEX(order_user_name), '$private_key') USING utf8) LIKE '%$search_word%'");
					break;
				case "3":
					$builder->where('order_no', $search_word);
					break;
				case "4":
					$builder->where('group_no', $search_word);
					break;
			}
		}

		// 🔹 총 개수 조회용 클론
		$countBuilder = clone $builder;
		$nTotalCount  = $countBuilder->countAllResults();

		// 🔹 페이징 계산
		$nPage = ceil($nTotalCount / $g_list_rows);
		$pg    = max(1, $pg); // 최소 페이지 1
		$nFrom = ($pg - 1) * $g_list_rows;

		// 🔹 정렬 및 페이징 적용
		$builder->orderBy('group_no', 'DESC')
				->orderBy('order_idx', 'DESC')
				->limit($g_list_rows, $nFrom);

		// 🔹 최종 데이터 조회
		$order_list = $builder->get()->getResultArray();
		write_log("last query getOrdersGroup - ". $this->db->getLastQuery());
		$num = $nTotalCount - $nFrom;

		return [
			'order_list'  => $order_list,
			'nTotalCount' => $nTotalCount,
			'pg'          => $pg,
			'nPage'       => $nPage,
			'g_list_rows' => $g_list_rows,
			'num'         => $num,
		];
	}

	public function getGroupCounts($dateType, $procType, $checkInDate, $checkOutDate, $payType, $prodType, $searchType, $search_word)
	{
		$private_key = private_key(); // 🔹 private_key() 호출하여 키 가져오기

		$builder = $this->db->table('tbl_order_mst')
			->select('group_no, SUM(real_price_won) as real_price_won, COUNT(*) as group_count');

		$builder->where('m_idx', $_SESSION["member"]["mIdx"]);
        $builder->whereNotIn('order_status', ['B', 'D']);

		// 날짜 필터 적용
		if ($dateType == "1" && $checkInDate && $checkOutDate) {
			$builder->where("DATE(order_day) BETWEEN '$checkInDate' AND '$checkOutDate'");
		}
		if ($dateType == "2" && $checkInDate && $checkOutDate) {
			$builder->where("DATE(order_date) BETWEEN '$checkInDate' AND '$checkOutDate'");
		}

		// 결제 상태 필터
		$payStatusMap = [
			"1" => ['W', 'Y', 'G', 'R', 'J'],
			"2" => ['Z'],
			"3" => ['E'],
			"4" => ['C'],
			"5" => ['N'],
		];
		if (!empty($procType) && isset($payStatusMap[$procType])) {
			$builder->whereIn('order_status', $payStatusMap[$procType]);
		}

		// 상품 유형 필터
		if (!empty($prodType)) {
			$builder->where('order_gubun', $prodType);
		}

		// 검색 필터
		if (!empty($search_word)) {
			switch ($searchType) {
				case "1":
					$builder->like('product_name', $search_word);
					break;
				case "2":
					$builder->where("CONVERT(AES_DECRYPT(UNHEX(order_user_name), '$private_key') USING utf8) LIKE '%$search_word%'");
					break;
				case "3":
					$builder->where('order_no', $search_word);
					break;
				case "4":
					$builder->where('group_no', $search_word);
					break;
			}
		}

		// 그룹 및 정렬 적용
		$builder->groupBy('group_no')
				->orderBy('group_no', 'DESC');
		
        $result = $builder->get()->getResultArray();
		write_log("last query getGroupCounts - ". $this->db->getLastQuery());
	
		return $result;
	}


	
    public function makeOrderNo()
    {
//        $todayOrder = $this->select()->where('order_r_date', date('Y-m-d'))->get()->getResultArray();
        $todayOrder = $this->select()->where('date(order_r_date)', date('Y-m-d'))->get()->getResultArray();
        $maxOrderNo = 0;
        foreach ($todayOrder as $key => $value) {
            $no = (int)substr($value['order_no'], -3);
            if ($no > $maxOrderNo) {
                $maxOrderNo = $no;
            }
        }
        $order_no = str_pad($maxOrderNo + 1, 3, "0", STR_PAD_LEFT);
        return "S" . date('Ymd') . $order_no;
    }

    public function getOrderInfo($order_idx)
    {
        $private_key = private_key();
        $sql_d = " SELECT *
        , AES_DECRYPT(UNHEX(order_user_name),           '$private_key') order_user_name
        , AES_DECRYPT(UNHEX(order_user_mobile),         '$private_key') order_user_mobile
        , AES_DECRYPT(UNHEX(order_user_phone),          '$private_key') order_user_phone
        , AES_DECRYPT(UNHEX(order_user_email),          '$private_key') order_user_email
        , AES_DECRYPT(UNHEX(manager_name),              '$private_key') manager_name
        , AES_DECRYPT(UNHEX(manager_phone),             '$private_key') manager_phone
        , AES_DECRYPT(UNHEX(manager_email),             '$private_key') manager_email
        , AES_DECRYPT(UNHEX(local_phone),     	        '$private_key') local_phone 
        , AES_DECRYPT(UNHEX(order_user_first_name_en),  '$private_key') order_user_first_name_en 
        , AES_DECRYPT(UNHEX(order_user_last_name_en),   '$private_key') order_user_last_name_en 
		, AES_DECRYPT(UNHEX(order_passport_number),     '$private_key') order_passport_number 
        FROM tbl_order_mst where order_idx='" . $order_idx . "' ";
        return $this->db->query($sql_d)->getRowArray();
    }
}