<?php

function cancelMileage($payment_no, $cancelAmt) {
    
	$db = db_connect();

    //$payment_no = "P_20250429140807658"; 
    //$cancelAmt  = 1000;

    $sql = "SELECT a.payment_price, b.* 
            FROM tbl_payment_mst a
            LEFT JOIN tbl_order_mileage b ON a.payment_no = b.payment_no
            WHERE a.payment_no = ? AND b.order_gubun = '포인트적립'";
    
    $query = $db->query($sql, [$payment_no]);
    $row   = $query->getRowArray();

    if (!$row) return;

    $payment_price = $row['payment_price'];
    $add_mileage   = $row['order_mileage'];

    // 1. 포인트 차감
    $mi_title = "예약결제 후 포인트차감($payment_no)";
    $order_mileage = -1 * $add_mileage;

    $db->query("INSERT INTO tbl_order_mileage SET  
                                              mi_title      = ?, 
											  order_idx     = ?, 
											  order_no      = ?, 
											  order_mileage = ?, 
											  order_gubun   = '포인트차감',
                                              m_idx         = ?, 
											  product_idx   = ?, 
											  mi_r_date     = NOW(), 
											  payment_no    = ?",
                                             [$mi_title, 
											  $row['order_idx'], 
											  $row['order_no'], 
											  $order_mileage,
                                              $row['m_idx'], 
											  $row['product_idx'], 
											  $payment_no]);

    $insertId = $db->insertID();
    updateMileageSum($db, $row['m_idx'], $insertId);

    // 2. 결제금액 일부 유지 → 포인트 비율 지급
    $rate = ($payment_price - $cancelAmt) / $payment_price;
    $adjusted_mileage = (int)($add_mileage * $rate);

    $mi_title = "예약결제 후 포인트지급($payment_no)";
    $order_mileage = $adjusted_mileage;

    $db->query("INSERT INTO tbl_order_mileage SET  
                                              mi_title      = ?, 
											  order_idx     = ?, 
											  order_no      = ?, 
											  order_mileage = ?, 
											  order_gubun   = '포인트지급',
                                              m_idx         = ?, 
											  product_idx   = ?, 
											  mi_r_date     = NOW(), 
											  payment_no = ?",
                                             [$mi_title, 
											  $row['order_idx'], 
											  $row['order_no'], 
											  $order_mileage,
                                              $row['m_idx'], 
											  $row['product_idx'], 
											  $payment_no]);

    $insertId = $db->insertID();
    updateMileageSum($db, $row['m_idx'], $insertId);
}

function updateMileageSum($db, $m_idx, $mi_idx) {
    $sql = "SELECT IFNULL(SUM(order_mileage),0) AS sum_mileage FROM tbl_order_mileage WHERE m_idx = ?";
    $row = $db->query($sql, [$m_idx])->getRowArray();
    $sum_mileage = $row['sum_mileage'];

    $db->query("UPDATE tbl_member SET mileage = ? WHERE m_idx = ?", [$sum_mileage, $m_idx]);
    $db->query("UPDATE tbl_order_mileage SET remaining_mileage = ? WHERE mi_idx = ?", [$sum_mileage, $mi_idx]);
}
