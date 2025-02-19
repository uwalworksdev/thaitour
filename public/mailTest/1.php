<?php
        include_once $_SERVER['DOCUMENT_ROOT'] . '/app/Common.php';

		$code = "A01";
        $user_mail = "diana001@naver.com";
        $user_name = "김태균";
        $_tmp_fir_array = [
            'name' => $user_name
        ];
		
        autoEmail($code, $user_mail, $_tmp_fir_array);
		
?>		