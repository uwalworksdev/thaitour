<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class VoucherController extends BaseController
{

    public function hotel()
    {
       
        return view("voucher/voucher_hotel", [
        ]);
    }
}