<?php
namespace App\Controllers\Api;

use App\Controllers\BaseController;
use Config\Database; // ✅ 올바른 네임스페이스
use CodeIgniter\I18n\Time;

class InvoiceController extends BaseController
{
	protected $connect;

	public function __construct()
    {
        $this->connect = Database::connect(); // ✅ 올바른 데이터베이스 연결
        helper('my_helper');
    }

    public function hotel()
    {
       
        return view("invoice/invoice_hotel", [
        ]);
    }

    public function hotel_01($idx)
    {
		//$sql    = "SELECT * FROM tbl_order_mst WHERE order_idx = '". $idx ."' ";
		//$result = $this->connect->query($sql);
		//$result = $result->getRowArray();
       
        return view("invoice/invoice_hotel_01", [
          //  "result" => $result
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