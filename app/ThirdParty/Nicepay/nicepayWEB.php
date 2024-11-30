<?php

class NicepayWEB
{
    // 주요 속성
    public $merchantKey;     // 상점 키
    public $merchantID;      // 상점 ID
    public $goodsName;       // 상품명
    public $price;           // 결제 금액
    public $buyerName;       // 구매자 이름
    public $buyerEmail;      // 구매자 이메일
    public $returnUrl;       // 결제 결과 리턴 URL
    public $serverHost = "https://sandbox.nicepay.co.kr"; // 기본 테스트 URL

    // 결제 요청 생성
    public function requestAction()
    {
        $params = [
            'merchantID' => $this->merchantID,
            'goodsName'  => $this->goodsName,
            'price'      => $this->price,
            'buyerName'  => $this->buyerName,
            'buyerEmail' => $this->buyerEmail,
            'returnUrl'  => $this->returnUrl,
        ];

        // 파라미터를 URL 쿼리로 변환
        $queryString = http_build_query($params);

        // 결제 요청 URL 반환
        return $this->serverHost . '/webapi/Pay.jsp?' . $queryString;
    }

    // 결제 결과 수신
    public function receiveAction()
    {
        // POST 데이터를 받아서 처리
        $result = $_POST;

        // 응답 검증 (예: 결과 코드 확인)
        if (isset($result['resultCode']) && $result['resultCode'] == '0000') {
            // 성공적인 결제 처리
            return [
                'resultCode' => $result['resultCode'],
                'resultMsg'  => $result['resultMsg'],
                'tid'        => $result['TID'], // 거래 ID
            ];
        } else {
            // 실패 처리
            return [
                'resultCode' => $result['resultCode'] ?? '9999',
                'resultMsg'  => $result['resultMsg'] ?? 'Unknown Error',
            ];
        }
    }
}
