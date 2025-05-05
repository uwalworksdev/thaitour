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
        $affectedRows = $db->affectedRows();

		if ($result) {
			$msg = $today . " 이용완료(". $affectedRows .")건 처리완료";
		} else {
			$msg = $today . " 이용완료 오류";
		} 
		
		write_log($msg);

    }
	
    public function service_cancel() {
        
		// 취소는 예약확인 상태에서 10일동안 결제가 없을시 자동으로 취소 
		
	    $db = \Config\Database::connect(); // 데이터베이스 연결
		
        $sql = "
            UPDATE tbl_order_mst 
            SET order_status = 'C' 
            WHERE order_status = 'X' 
              AND order_r_date < DATE_SUB(NOW(), INTERVAL 10 DAY)
        ";

        $result       = $db->query($sql);
        $affectedRows = $db->affectedRows();

        if ($result) {
            $msg = "10일 지난 예약(". $affectedRows .")건 취소 처리 완료.";
        } else {
            $msg = "예약건 취소 처리 중 오류 발생.";
        }
		
		write_log($msg);
    }
	
}	