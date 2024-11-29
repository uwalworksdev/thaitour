<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Exception;

class AdminCouponController extends BaseController
{
    private $couponMst;
    private $db;

    public function __construct()
    {
        $this->couponMst = model("CouponMst");
        helper(['html']);
        $this->db = db_connect();
        helper('my_helper');
        helper('comment_helper');
    }

    public function list(){
        $coupon = $this->couponMst->getCouponList();
        return view('admin/_coupon/list', [
            "coupon_list" => $coupon["coupon_list"],
            "nTotalCount" => $coupon["nTotalCount"],
            "pg" => $coupon["pg"],
            "nPage" => $coupon["nPage"],
            "g_list_rows" => $coupon["g_list_rows"],
            "num" => $coupon["num"]
        ]);
    }

    public function write() {
        
    }

    public function write_ok() {

    }
    public function delete() {
        
    }
    
}
