<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/app/Common.php';
		
	alimTalk_send("S20250210003","TY_1655");
	/*
    $connect     = db_connect();
    $private_key = private_key();

    $sql	     = " SELECT * FROM tbl_order_mst WHERE order_no = '$order_no' ";
    $row         = $connect->query($sql)->getRowArray();
	
	$sql_d       = "SELECT  AES_DECRYPT(UNHEX('{$row['order_user_name']}'),    '$private_key') AS order_user_name
	                       ,AES_DECRYPT(UNHEX('{$row['order_user_mobile']}'),  '$private_key') AS order_user_mobile ";
    $row_d       = $connect->query($sql_d)->getRowArray();

	$order_user_name   = $row_d['order_user_name'];
	$order_user_mobile = $row_d['order_user_mobile'];	
	
	echo $order_user_name ." - ". $order_user_mobile;
	*/	
?>		