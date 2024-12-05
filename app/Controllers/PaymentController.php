<?php
// controller PaymentController.php
namespace App\Controllers;

class PaymentController extends BaseController
{
    private $apiUrl;      // API URL
    private $merchantKey; // 상점 키
    private $merchantId;  // 상점 ID

    public function __construct()
    {
        $this->apiUrl      = "https://api.test.nicepay.co.kr/v1/payments"; // 테스트 환경
        $this->merchantKey = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // 나이스페이에서 발급받은 키
        $this->merchantId  = "nicepay00m";  // 나이스페이 상점 ID
    }

    public function requestPayment()
    {
        $data = [
            "amount" => 10000,               // 결제 금액
            "orderId" => "ORDER123456",      // 주문번호 (고유해야 함)
            "orderName" => "Sample Product", // 상품명
            "customerName" => "John Doe",    // 고객명
            "returnUrl" => base_url('/payment/complete'), // 결제 결과 URL
            "merchantId" => $this->merchantId,
        ];

        $response = $this->sendApiRequest($data);

        if ($response['status'] === 'SUCCESS') {
            return redirect()->to($response['redirectUrl']); // 나이스페이 결제 페이지로 이동
        }

        return redirect()->back()->with('error', $response['message']);
    }

    public function completePayment()
    {
        $transactionId = $this->request->getGet('transactionId'); // 나이스페이에서 전달된 거래 ID

        $response = $this->sendApiRequest([
            'transactionId' => $transactionId,
        ], '/approve'); // 결제 승인 요청

        if ($response['status'] === 'APPROVED') {
            // 결제 성공 처리
            return view('payment_success', ['response' => $response]);
        }

        // 결제 실패 처리
        return view('payment_failed', ['response' => $response]);
    }

    private function sendApiRequest($data, $endpoint = '')
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

?>