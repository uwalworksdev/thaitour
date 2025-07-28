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
		
		//write_log($msg);

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
		
		//write_log($msg);
    }
	
	public function hotel_price() {
		$db = \Config\Database::connect();
		$today = date('Y-m-d');

		$sql   = "UPDATE tbl_room_price 
                  SET upd_yn = 'Y' 
                  WHERE goods_date < CURDATE() ";
		$db->query($sql);	
		
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

	public function auto_cancel_orders()
	{
		$db = \Config\Database::connect();

		// 1시간이 지난 예약 상태 "X"인 주문을 "C"로 변경하고 취소일자 세팅
		$updateSql = "
			UPDATE tbl_order_mst
			SET 
				order_status = 'C',
				order_c_date = NOW()
			WHERE 
				order_status = 'X'
				AND confirmed_datetime IS NOT NULL
				AND confirmed_datetime <= DATE_SUB(NOW(), INTERVAL 1 HOUR)
		";
		$db->query($updateSql);
		$cancelRows = $db->affectedRows();

		// 29일 이상 지난 취소 예약 대상 order_idx 목록 확보
		$orderIdxQuery = "
			SELECT order_idx 
			FROM tbl_order_mst
			WHERE order_status = 'C'
			  AND order_c_date != '0000-00-00 00:00:00'
			  AND order_c_date < DATE_SUB(NOW(), INTERVAL 29 DAY)
		";
		$orderIdxResult = $db->query($orderIdxQuery)->getResultArray();

		if (!empty($orderIdxResult)) {
			$orderIdxList = array_column($orderIdxResult, 'order_idx');

			// tbl_order_list 관련 row 삭제
			$db->table('tbl_order_list')
				->whereIn('order_idx', $orderIdxList)
				->delete();

			// tbl_order_mst row 삭제
			$db->table('tbl_order_mst')
				->whereIn('order_idx', $orderIdxList)
				->delete();

			$deleteRows = count($orderIdxList);
		} else {
			$deleteRows = 0;
		}

		// 로그 기록
		if (!function_exists('write_log')) {
			function write_log($message, $level = 'info')
			{
				log_message($level, $message);
			}
		}

		//write_log('[CRON] 예약확인 1시간 경과 자동취소 처리 건수: ' . $cancelRows, 'info');
		//write_log('[CRON] 예약취소 30일 경과 자동삭제 처리 건수: ' . $deleteRows, 'info');
	}


}	