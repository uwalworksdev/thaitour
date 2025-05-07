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
		$sql    = "UPDATE tbl_order_mst 
		           SET order_status = 'E', order_r_date = now() 
				   WHERE order_day < ? AND order_status != 'E'";
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
		
        $sql = "UPDATE tbl_order_mst 
                SET order_status = 'C', order_r_date = now() 
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
	
	public function hotel_price() {
		$db = \Config\Database::connect();
		$today = date('Y-m-d');

		// 판매 중인 호텔 상품 목록
		$productQuery = "
			SELECT product_idx 
			FROM tbl_product_mst  
			WHERE product_code_1 = '1303' AND product_status = 'sale'
		";
		$products = $db->query($productQuery)->getResultArray();

		foreach ($products as $product) {
			$product_idx = $product['product_idx'];

			// 오늘 날짜의 가격 (goods_price2 + goods_price3 > 0)
			$priceQueryToday = "
				SELECT (goods_price2 + goods_price3) AS price_1 
				FROM tbl_room_price 
				WHERE product_idx = ? AND goods_date = ? AND (goods_price2 + goods_price3) > 0
				ORDER BY (goods_price2 + goods_price3) ASC
				LIMIT 1
			";
            $row = $db->query($priceQueryToday, [$product_idx, $today])->getRowArray();

			if (!empty($row['price_1']) && $row['price_1'] > 0) {
				$price = $row['price_1'];
			} else {
				// 미래 가격 중 가장 빠른 날짜의 가격
				$priceQueryFuture = "
					SELECT (goods_price2 + goods_price3) AS price_1 
					FROM tbl_room_price 
					WHERE product_idx = ? AND goods_date > ? AND (goods_price2 + goods_price3) > 0
					ORDER BY (goods_price2 + goods_price3) ASC
					LIMIT 1
				";
				$row = $db->query($priceQueryFuture, [$product_idx, $today])->getRowArray();
				$price = !empty($row['price_1']) ? $row['price_1'] : 0;
			}

			// 상품 마스터 가격 업데이트
			$updateSql = "UPDATE tbl_product_mst SET product_price = ? WHERE product_idx = ?";
			$db->query($updateSql, [$price, $product_idx]);
		}
	}

	
}	