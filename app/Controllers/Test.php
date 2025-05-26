<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function ajax_temp()
    {

        // 알림톡 함수 호출
        $payment_idx = "2097";
        completePayment($payment_idx);
    }
}
