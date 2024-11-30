<?php
		namespace App\Controllers;

		use App\Controllers\BaseController;

		class NicepayController extends BaseController
		{
			public function request()
			{
				// NICEPAY SDK 로드
				require_once APPPATH . 'ThirdParty/Nicepay/nicepayWEB.php';

				$pay = new \NicepayWEB();
				$pay->merchantKey = 'EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg==';
				$pay->merchantID  = 'nicepay00m';
				$pay->goodsName   = 'Test Product';
				$pay->price       = '1000';  // 상품 가격
				$pay->buyerName   = '홍길동';
				$pay->buyerEmail  = 'test@example.com';
				$pay->returnUrl   = 'https://thetourlab.com/nicepay/return';

				// 결제 요청 URL 생성
				$payRequestURL = $pay->requestAction();

				// 결제 페이지로 리다이렉트
				return redirect()->to($payRequestURL);
			}

			public function return()
			{
				// 결제 결과 확인
				require_once APPPATH . 'ThirdParty/Nicepay/nicepayWEB.php';

				$pay = new \NicepayWEB();
				$pay->merchantKey = 'EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg==';

				// 결제 결과 수신
				$result = $pay->receiveAction();

				if ($result['resultCode'] == '0000') {
					// 성공 처리
					echo '결제가 성공적으로 처리되었습니다.';
				} else {
					// 실패 처리
					echo '결제 실패: ' . $result['resultMsg'];
				}
			}
		}


?>