<?php

namespace App\Controllers;

use App\Libraries\Nicepay;

class PaymentController extends BaseController
{
    private $nicepay;

    public function __construct()
    {
        $this->nicepay = new Nicepay();
    }

    // 결제 요청
    public function requestPayment()
    {
/*
        $orderId   = uniqid('ORDER_'); // 주문 번호 (고유해야 함)
        $amount    = 10000;            // 결제 금액
        $orderName = "테스트 상품";   // 상품 이름

        $response = $this->nicepay->requestPayment($orderId, $amount, $orderName);

        if ($response['statusCode'] === 200 && isset($response['response']['nextRedirectUrl'])) {
            // 결제 페이지로 리다이렉트
            return redirect()->to($response['response']['nextRedirectUrl']);
        }

		if ($response['statusCode'] !== 200) {
			log_message('error', '결제 요청 실패: ' . json_encode($response));
			return view('payment_failed', [
				'message'   => $response['response']['message'] ?? '결제 요청 실패',
				'errorCode' => $response['response']['errorCode'] ?? '알 수 없는 오류',
			]);
		}

		log_message('debug', '나이스페이 요청 데이터: ' . $orderId ." - ". $amount ." - ". $orderName);
		log_message('debug', '나이스페이 응답 데이터: ' . json_encode($response));
*/
        // 오류 처리
        //return view('payment_request');
        $data = "";

		return $this->renderView('payment_request', $data);
    }

    // 결제 완료
    public function completePayment()
    {
        $transactionId = $this->request->getGet('transactionId'); // 나이스페이로부터 전달된 거래 ID

        $response = $this->nicepay->approvePayment($transactionId);

        if ($response['statusCode'] === 200 && isset($response['response']['status']) && $response['response']['status'] === 'APPROVED') {
            return view('payment_success', ['response' => $response['response']]);
        }

        // 오류 처리
        return view('payment_failed', [
            'message' => $response['response']['message'] ?? '결제 승인 실패',
        ]);
    }
}

?>