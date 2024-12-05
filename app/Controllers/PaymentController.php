<?php
namespace App\Controllers;

class PaymentController extends BaseController
{
    private $apiUrl;
    private $merchantId;
    private $merchantKey;
    private $returnUrl;

    public function __construct()
    {
        $this->apiUrl      = getenv('NICEPAY_API_URL');
        $this->merchantId  = getenv('NICEPAY_MERCHANT_ID');
        $this->merchantKey = getenv('NICEPAY_MERCHANT_KEY');
        $this->returnUrl   = getenv('NICEPAY_RETURN_URL');
    }

    // 결제 요청
    public function requestPayment()
    {
        // 상품 정보 (테스트용 데이터)
        $orderId   = uniqid('ORDER_'); // 주문번호는 고유해야 함
        $amount    = 10000;            // 결제 금액
        $orderName = "테스트 상품";

        $data = [
            "merchantId" => $this->merchantId,
            "orderId"    => $orderId,
            "amount"     => $amount,
            "orderName"  => $orderName,
            "returnUrl"  => $this->returnUrl,
        ];

        // API 요청
        $response = $this->sendRequest($data);
        log_message('debug', '나이스페이 요청 데이터: ' . json_encode($data));

        if (isset($response['status']) && $response['status'] === 'SUCCESS') {
            // 결제 페이지로 리다이렉트
            return redirect()->to($response['nextRedirectUrl']);
        }
        
		log_message('debug', '나이스페이 응답 데이터: ' . json_encode($response));
        return view('payment_failed', ['message' => $response['message'] ?? '결제 요청 실패']);
    }

    // 결제 완료 처리
    public function completePayment()
    {
        $transactionId = $this->request->getGet('transactionId'); // 나이스페이로부터 전달받은 거래 ID

        $data = [
            "merchantId" => $this->merchantId,
            "transactionId" => $transactionId,
        ];

        // API 승인 요청
        $response = $this->sendRequest($data, '/approve');

        if (isset($response['status']) && $response['status'] === 'APPROVED') {
            return view('payment_success', ['response' => $response]);
        }

        return view('payment_failed', ['message' => $response['message'] ?? '결제 실패']);
    }

    // 공통 API 요청 처리 메서드
    private function sendRequest($data, $endpoint = '')
    {
        $url = $this->apiUrl . $endpoint;
        $headers = [
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($this->merchantKey . ":"),
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
