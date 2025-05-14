<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function ajax_temp()
    {
        $db          = \Config\Database::connect();
        $private_key = private_key();

        // 알림톡 함수 호출
        $payment_idx = "2097";
        alimTalk_deposit_send($payment_idx);

        $sql             = "	select AES_DECRYPT(UNHEX(pay_name),  '$private_key') AS user_name
                                 	 , AES_DECRYPT(UNHEX(pay_email), '$private_key') AS user_email
									 , Amt_1 
									 , payment_no 
									 , product_name
									 , paydate
									 , payment_method
									from tbl_payment_mst
									where payment_idx = '" . $payment_idx . "'";
		write_log($sql);				
        $result = $db->query($sql);
        $row    = $result->getRowArray();
		
        $code       = "A17";
        $user_email =  $row['user_email'];
		
        $_tmp_fir_array = [
            'RECEIVE_NAME'   => $row['user_name'],
            'PROD_NAME'      => $row['product_name'],
            'ORDER_NO'       => $row['payment_no'],
            'ORDER_DAY'      => $row['paydate'],
            'ORDER_PRICE'    => $row['Amt_1'],
			'PAYMENT_METHOD' => $row['payment_method'],
            'ORDER_DATE'     => $row['paydate']
        ];
        autoEmail($code, $user_email, $_tmp_fir_array);
		
        echo "ajax_temp end";
    }
}
