<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function ajax_temp()
    {
        $db = \Config\Database::connect();

        // 로그 남기기
        write_log("ajax_temp");

        // 알림톡 함수 호출
        $payment_idx = "2097";
        alimTalk_deposit_send($payment_idx);

        echo "ajax_temp end";
    }
}
