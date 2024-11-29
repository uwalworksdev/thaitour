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
        
    }

    public function write() {
        
    }

    public function write_ok() {

    }
    public function delete() {
        
    }
    
}
