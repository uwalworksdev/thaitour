<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;
use CodeIgniter\I18n\Time;

class CouponController extends BaseController
{
    public function __construct()
    {
        helper('my_helper');
        helper('comment_helper');
    }

    public function list() {
        return view('coupon/list');
    }

}