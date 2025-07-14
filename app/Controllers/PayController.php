<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pay extends BaseController
{
    public function pay()
    {
        return view('pay/pay');
    }

    public function pay_view()
    {
        // 실제라면 DB에서 주문정보를 가져오거나 세션에 저장된 인증 정보를 사용
        $data = [
            'reservation_name' => '관리자test',
            'email'            => 'lifeess@naver.com',
            'order_number'     => 'S2507148149',
            'amount'           => 2000,
            'product_title'    => '⭐ 반짝 이벤트 ⭐ [한국인가이드] 시티 야경투어 + 시드니워킹투어★'
        ];

        return view('pay/pay_view', $data);
    }
}
