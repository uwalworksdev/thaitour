<?php

// /app/Common/insertRoomPrice.php

use CodeIgniter\Database\QueryBuilder;
use DateTime;

function roomPrice($db, $rooms_idx, $baht_thai, $product_idx, $g_idx, $o_sdate, $days)
{
	
	if (!$db) {
		$db = \Config\Database::connect();
	}	

	// 방 정보 가져오기
	$bed_type = $bed_price = "";
    $sql   = "SELECT * FROM tbl_room_beds WHERE rooms_idx = ? ORDER BY bed_seq";
    $query = $db->query($sql, [$rooms_idx]);
    $rows  = $query->getResultArray(); // 연관 배열 반환

    foreach ($rows as $row) {
		
		     if($bed_type == "") {
                $bed_type .= $row['bed_type'];
			 } else {
                $bed_type .= ",". $row['bed_type']; 
			 }	

			 $sql     = "SELECT * FROM tbl_room_price WHERE product_idx = '". $product_idx ."'   AND 
			                                                g_idx       = '". $g_idx ."'         AND 
															rooms_idx   = '". $rooms_idx ."'     AND 
															bed_idx     = '". $row['bed_idx'] ."'  AND 
															goods_date  = '". $o_sdate ."' ";
		 	 write_log("roomPrice- ". $sql); 												
             $row        = $db->query($sql)->getRow();
			 $price_won  = ($row->goods_price1 + $row->goods_price2 + $row->goods_price3) * $row->baht_thai; 
			 $price_baht =  $row->goods_price1 + $row->goods_price2 + $row->goods_price3;

			 if($bed_price == "") {
                $bed_price .= $price_won;
			 } else {
                $bed_price .= ",". $price_won;
			 }	
			 
			 $result = $bed_type ."|". $bed_price ."|". $row->goods_price1;

    }

    return $result; // 성공적으로 처리된 경우
}

?>