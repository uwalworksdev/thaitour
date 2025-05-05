<?php

namespace App\Controllers;
use DateTime;

class DailyController extends BaseController {
    private $db;
    private $productModel;
    private $roomImg;
    private $CodeModel;

    public function __construct() {
        $this->db           = db_connect();
        $this->productModel = model("ProductModel");
        $this->roomImg      = model("RoomImg");
        $this->CodeModel    = model("Code");
    }
	
    public function service_end() {

		// 이용완료 : 사용날짜가 지나면 자동으로 이용완료 UPDATE

		$this->db = db_connect();

		write_log("service_end");
    }
	
    public function service_cancel() {
        
		// 취소는 예약확인 상태에서 10일동안 결제가 없을시 자동으로 취소 
		
		$this->db = db_connect();
		
		write_log("service_cancel");
    }
	
}	