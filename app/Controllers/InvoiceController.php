<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class InvoiceController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
        helper('my_helper');
    }
    public function golf()
    {
       
        return view("invoice/invoice_golf", [
        ]);
    }

    public function hotel()
    {
       
        return view("invoice/invoice_hotel", [
        ]);
    }

    public function hotel_01($idx)
    {
       
        return view("invoice/invoice_hotel_01", [
            "idx" => $idx
        ]);		
    }

    public function ticket_01()
    {
        return view("invoice/invoice_ticket_01", [
        ]);
    }

    public function ticket_02()
    {
       
        return view("invoice/invoice_ticket_02", [
        ]);
    }

    public function payment_golf()
    {
       
        return view("invoice/payment_golf", [
        ]);
    }

    public function bank_info()
    {
       
        return view("invoice/bank_info_view", [
        ]);
    }

    public function bank_info_account()
    {
       
        return view("invoice/bank_info_account", [
        ]);
    }
}