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

    public function payment_golf()
    {
       
        return view("invoice/payment_golf", [
        ]);
    }
}