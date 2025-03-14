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
        , "order_gubun", "order_no", "order_date", "order_user_name", "order_user_email", "order_user_mobile", "order_user_phone"
        , "order_memo", "admin_memo", "manager_name", "manager_phone", "manager_email", "start_date", "end_date"
        , "product_period", "tour_period", "people_adult_cnt", "people_adult_price", "people_kids_cnt", "people_kids_price"
        , "people_baby_cnt", "people_baby_price", "oil_price", "inital_price", "order_price", "option_amt", "extra_cost", "order_confirm_price"
	    , "price", "price_won", "room", "room_type", "bed_type", "date_price", "adult", "kids", "last_price" 				
        , "order_confirm_date", "confirm_method", "deposit_price", "deposit_date", "deposit_method", "order_method", "used_op_type", "room_op_price_sale"
        , "used_coupon_idx", "used_coupon_no", "used_coupon_point", "used_coupon_money", "product_mileage", "used_mileage_money"
        , "order_mileage", "order_status", "order_m_date", "order_r_date", "order_d_date", "order_c_date", "is_modify"
        , "paydate", "erp_seq", "ResultCode_1", "ResultMsg_1", "Amt_1", "TID_1", "AuthCode_1", "AuthDate_1", "CancelDate_1"
        , "VbankBankCode_1", "VbankBankName_1", "VbankNum_1", "VbankExpDate_1", "VbankExpTime_1", "additional_request"
        , "ResultCode_2", "ResultMsg_2", "Amt_2", "TID_2", "AuthCode_2", "AuthDate_2", "CancelDate_2", "VbankBankCode_2"
        , "VbankBankName_2", "VbankNum_2", "VbankExpDate_2", "VbankExpTime_2", "depositor_1", "bank_1", "depositor_2"
        , "bank_2", "isDelete", "delDate", "encode", "custom_req", "local_phone", "order_zip", "order_addr1", "order_addr2"
        , "deposit_price_change", "price_confirm_change", "total_price_change", "bbs_no", "transfer_date", "user_id"
        , "kakao_id", "order_name_kor_list", "order_name_eng_list", "order_mobile_list", "order_email_list", "device_type", "ip"
        , "room_op_idx", "order_room_cnt", "order_day_cnt", "order_user_first_name_en", "order_user_last_name_en", "order_user_gender", "order_gender_list"
        , "order_passport_number", "order_passport_expiry_date", "order_birth_date"
        , "vehicle_time", "departure_point", "order_day", "departure_area", "destination_area", "meeting_date", "return_date", "departure_hotel"
        , "destination_hotel", "ca_depth_idx", "cp_idx", "time_line", "ho_idx", "baht_thai", "breakfast", "group_no"
    ];
    protected $encryptedField = ["order_user_name", "order_user_email", "order_user_mobile", "order_user_phone", "local_phone", "order_user_first_name_en", "order_user_last_name_en", "manager_name", "manager_phone", "manager_email",];

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

public function getOrdersGroup($pg = 1, $g_list_rows = 10, $dateType, $checkInDate, $checkOutDate, $payType, $prodType, $searchType, $search_word)
{
    $private_key = private_key();
    
    // 각 행에 그룹 건수를 추가하는 서브쿼리
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

if ($dateType == "1" && $checkInDate && $checkOutDate) {
    $builder->where("DATE(order_date) BETWEEN '$checkInDate' AND '$checkOutDate'");
}

if ($dateType == "2" && $checkInDate && $checkOutDate) {
    $builder->where("DATE(order_r_date) BETWEEN '$checkInDate' AND '$checkOutDate'");
}

// 결제 상태 조건 추가
$payStatusMap = [
    "1" => ['W', 'Y', 'G', 'R', 'J'],
    "2" => ['Z'],
    "3" => ['E'],
    "4" => ['C'],
    "5" => ['N'],
];

if (!empty($payType) && isset($payStatusMap[$payType])) {
    $builder->whereIn('order_status', $payStatusMap[$payType]);
}

// 상품 유형 조건 추가
if (!empty($prodType)) {
    $builder->where('order_gubun', $prodType);
}

// 검색 조건 추가
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

// 결과 가져오기
$query  = $builder->get();
$result = $query->getResultArray();

    
    // 페이징 전 총 건수
    $nTotalCount = $builder->countAllResults(false);
    
    $nPage = ceil($nTotalCount / $g_list_rows);
    $pg = ($pg) ? $pg : 1;
    $nFrom = ($pg - 1) * $g_list_rows;
    
    // 원하는 정렬 조건 적용
    $builder->orderBy('group_no', 'DESC')
            ->orderBy('order_idx', 'DESC');
    // (만약 그룹 건수 기준 정렬을 원하면 아래처럼 추가)
    // ->orderBy('group_count', 'DESC')
    
    $builder->limit($g_list_rows, $nFrom);
    
    $order_list = $builder->get()->getResultArray();
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

public function getGroupCounts($dateType, $checkInDate, $checkOutDate, $payType, $prodType, $searchType, $search_word)
{
    $builder = $this->db->table('tbl_order_mst')
        ->select('group_no, COUNT(*) as group_count');
    
$builder->where('m_idx', $_SESSION["member"]["mIdx"]);

if ($dateType == "1" && $checkInDate && $checkOutDate) {
    $builder->where("DATE(order_date) BETWEEN '$checkInDate' AND '$checkOutDate'");
}

if ($dateType == "2" && $checkInDate && $checkOutDate) {
    $builder->where("DATE(order_r_date) BETWEEN '$checkInDate' AND '$checkOutDate'");
}

// 결제 상태 조건 추가
$payStatusMap = [
    "1" => ['W', 'Y', 'G', 'R', 'J'],
    "2" => ['Z'],
    "3" => ['E'],
    "4" => ['C'],
    "5" => ['N'],
];

if (!empty($payType) && isset($payStatusMap[$payType])) {
    $builder->whereIn('order_status', $payStatusMap[$payType]);
}

// 상품 유형 조건 추가
if (!empty($prodType)) {
    $builder->where('order_gubun', $prodType);
}

// 검색 조건 추가
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
    
    $builder->groupBy('group_no')
            ->orderBy('group_no', 'DESC');
    
    return $builder->get()->getResultArray();
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
        FROM tbl_order_mst where order_idx='" . $order_idx . "' ";
        return $this->db->query($sql_d)->getRowArray();
    }
}