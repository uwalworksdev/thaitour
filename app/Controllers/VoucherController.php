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

    public function tour()
    {
       
        return view("voucher/voucher_tour", [
        ]);
    }

    public function show()
    {
       
        return view("voucher/voucher_show", [
        ]);
    }
    public function golf()
    {
       
        return view("voucher/voucher_golf", [
        ]);
    }

    public function ticket()
    {
       
        return view("voucher/voucher_ticket", [
        ]);
    }
}