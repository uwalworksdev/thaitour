<?php

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'tbl_order_mst';
    protected $primaryKey = 'order_idx';
    protected $allowedFields = ["order_idx", "m_idx", "air_idx", "yoil_idx", "home_depart_date", "away_arrive_date"
    , "away_depart_date", "home_arrive_date", "product_idx", "product_code_1", "product_code_2", "product_code_3"
    , "product_code_4", "code_name", "product_name", "tours_subject", "order_mileage_yn"
    , "order_gubun", "order_no", "order_date", "order_user_name", "order_user_email", "order_user_mobile", "order_user_phone"
    , "order_memo", "admin_memo", "manager_name", "manager_phone", "manager_email", "start_date", "end_date"
    , "product_period", "tour_period", "people_adult_cnt", "people_adult_price", "people_kids_cnt", "people_kids_price"
    , "people_baby_cnt", "people_baby_price", "oil_price", "inital_price", "order_price", "option_amt", "order_confirm_price"
    , "order_confirm_date", "confirm_method", "deposit_price", "deposit_date", "deposit_method", "order_method"
    , "used_coupon_idx", "used_coupon_no", "used_coupon_point", "used_coupon_money", "product_mileage", "used_mileage_money"
    , "order_mileage", "order_status", "order_m_date", "order_r_date", "order_d_date", "order_c_date", "is_modify"
    , "paydate", "erp_seq", "ResultCode_1", "ResultMsg_1", "Amt_1", "TID_1", "AuthCode_1", "AuthDate_1", "CancelDate_1"
    , "VbankBankCode_1", "VbankBankName_1", "VbankNum_1", "VbankExpDate_1", "VbankExpTime_1"
    , "ResultCode_2", "ResultMsg_2", "Amt_2", "TID_2", "AuthCode_2", "AuthDate_2", "CancelDate_2", "VbankBankCode_2"
    , "VbankBankName_2", "VbankNum_2", "VbankExpDate_2", "VbankExpTime_2", "depositor_1", "bank_1", "depositor_2"
    , "bank_2", "isDelete", "delDate", "encode", "custom_req", "local_phone", "order_zip", "order_addr1", "order_addr2"
    , "deposit_price_change", "price_confirm_change", "total_price_change", "bbs_no", "transfer_date", "user_id"
    , "kakao_id", "order_name_kor_list", "order_name_eng_list", "order_mobile_list", "order_email_list", "device_type", "ip"
    , "room_op_idx", "order_room_cnt", "order_day_cnt", "order_user_first_name_en", "order_user_last_name_en", "order_gender_list"
    , "vehicle_time"];
    public function getOrders($s_txt = null, $search_category = null, $pg = 1, $g_list_rows = 10)
    {
        $private_key = private_key();

        $builder = $this->db->table('tbl_order_mst as s1')
            ->select('s1.*, s3.code_name')
            ->join('tbl_product_mst as s2', 's1.product_idx = s2.product_idx', 'left')
            ->join('tbl_code as s3', 's1.product_code_1 = s3.code_no', 'left')
            ->where('s1.is_modify', 'N')
            ->where('s1.isDelete !=', 'Y')
            ->where('s1.order_gubun', 'tour')
            ->where('s1.order_status !=', 'D');

        if ($s_txt && $search_category == 'order_user_name') {
            $builder->like("CONVERT(AES_DECRYPT(UNHEX($search_category),'$private_key') USING utf8)", $s_txt);
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
    public function makeOrderNo() {
        $todayOrder = $this->select()->where('order_date', date('Y-m-d'))->orderBy('order_no', 'desc')->limit(1)->get()->getRowArray();
        if ($todayOrder) {
            return $todayOrder['order_no'] + 1;
        } else {
            return 1;
        }
    }
}