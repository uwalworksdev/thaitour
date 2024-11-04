<?php

use CodeIgniter\Model;

class Coupon extends Model
{
    protected $table = 'tbl_coupon';
    protected $primaryKey = 'c_idx';
    protected $allowedFields = ["coupon_num", "coupon_type", "types", "user_id", "status", "order_memo", "last_idx", "regdate", "enddate", "usedate", "get_issued_yn"];

    public function getCouponList($user_id)
    {
        $c_sql = "SELECT c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate
                            , c.status, c.types, s.coupon_name, s.dc_type, s.coupon_pe, s.coupon_price 
                                FROM tbl_coupon c LEFT JOIN tbl_coupon_setting s ON c.coupon_type = s.idx WHERE user_id = '" . $user_id . "' 
                                AND status = 'N' AND STR_TO_DATE(enddate, '%Y-%m-%d') >= CURDATE()";

        $c_result = $this->db->query($c_sql)->getResultArray();

        return $c_result;
    }

    public function getCouponInfo($c_idx)
    {
        $c_sql = "SELECT c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate
                            , c.status, c.types, s.coupon_name, s.dc_type, s.coupon_pe, s.coupon_price 
                                FROM tbl_coupon c LEFT JOIN tbl_coupon_setting s ON c.coupon_type = s.idx WHERE c.c_idx = '" . $c_idx . "' 
                                AND status = 'N' AND STR_TO_DATE(enddate, '%Y-%m-%d') >= CURDATE()";

        $c_result = $this->db->query($c_sql)->getRowArray();

        return $c_result;
    }

}