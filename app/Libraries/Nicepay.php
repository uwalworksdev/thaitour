<?php

namespace App\Libraries;

class Nicepay
{
    private $apiUrl;
    private $merchantId;
    private $merchantKey;
    private $returnUrl;

    public function __construct()
    {
        $this->apiUrl      = "https://api.test.nicepay.co.kr/v1/payments";
        $this->merchantId  = "nicepay00m";
        $this->merchantKey = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg==";
        $this->returnUrl   = "https://thetourlab.com/payment/complete";

    }

    public function requestPayment($orderId, $amount, $orderName)
    {
        $data = [
            'merchantId' => $this->merchantId,
            'orderId'    => $orderId,
            'amount'     => $amount,
            'orderName'  => $orderName,
            'returnUrl'  => $this->returnUrl,
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($this->merchantKey . ":"),
        ];

        return $this->sendRequest($this->apiUrl, $data, $headers);
    }

    public function approvePayment($transactionId)
    {
        $url = $this->apiUrl . '/approve';

        $data = [
            'merchantId' => $this->merchantId,
            'transactionId' => $transactionId,
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($this->merchantKey . ":"),
        ];

        return $this->sendRequest($url, $data, $headers);
    }

    private function sendRequest($url, $data, $headers)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 테스트 환경에서는 SSL 검증을 비활성화
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 타임아웃 30초 설정

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return [
            'statusCode' => $httpCode,
            'response' => json_decode($response, true),
        ];
    }
}

?>