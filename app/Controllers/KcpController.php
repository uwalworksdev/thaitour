<?php

namespace App\Controllers;

use Config\Inicis;

class PaymentController extends BaseController
{
    public function requestPayment()
    {
        $config = new Inicis();

        $data = [
            'mid' => $config->mid,
            'price' => '1000', // 결제 금액
            'buyer' => '홍길동', // 구매자 이름
            'timestamp' => time(),
            'returnUrl' => $config->returnUrl,
            'cancelUrl' => $config->cancelUrl,
        ];

        return view('payment_request', $data);
    }

    public function handleResponse()
    {
        $response = $this->request->getPost();

        if ($response['resultCode'] === '0000') {
            return '결제 성공: ' . $response['resultMsg'];
        } else {
            return '결제 실패: ' . $response['resultMsg'];
        }
    }
}
