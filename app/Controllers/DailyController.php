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
		
		$db     =  \Config\Database::connect();
		$today  =  date('Y-m-d'); // 오늘 날짜
		$sql    = "UPDATE tbl_order_mst SET order_status = 'E' WHERE order_day < ? AND order_status != 'E'";
		$result = $db->query($sql, [$today]);

		if ($result) {
			$msg = $today . " 이용완료 처리완료";
		} else {
			$msg = $today . " 이용완료 오류";
		} 
		
		write_log($msg);

    }
	
    public function service_cancel() {
        
		// 취소는 예약확인 상태에서 10일동안 결제가 없을시 자동으로 취소 
		
	    $db = \Config\Database::connect(); // 데이터베이스 연결
		
		write_log("service_cancel");
    }
	
}	