<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\BaseBuilder;

class PayController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function pay()
    {
        $payment_idx = $this->request->getGet('idx');
        return view('pay/pay', ['idx' => $payment_idx]);
    }

    public function pay_check()
    {
        $payment_idx = $this->request->getPost('idx');
        $input_phone_last4 = $this->request->getPost('phone_last4');

        if (!$payment_idx || !$input_phone_last4) {
            return $this->response->setBody("<script>alert('잘못된 요청입니다.');location.href='/pay?idx={$payment_idx}';</script>");
        }

        // DB에서 phone_last4 가져오기
        $builder = $this->db->table('tbl_payment_mst');
        $builder->select('payment_user_mobile');
        $builder->where('payment_idx', $payment_idx);
        $result           = $builder->get()->getRow();
        $user_mobile      = $result->payment_user_mobile;
		$user_mobile      = encryptField($user_mobile, "decode");
		$user_mobile_last = substr($user_mobile, -4);
        if ($result && $user_mobile_last === $input_phone_last4) {
            // 일치 → view 페이지로
            return redirect()->to("/pay/view?idx={$payment_idx}");
        } else {
            // 불일치 → alert
            return $this->response->setBody("<script>alert('전화번호를 확인하세요');location.href='/pay?idx={$payment_idx}';</script>");
        }
    }

    public function pay_view()
    {
        $payment_idx = $this->request->getGet("idx");

        // 실제 데이터 조회 예제
        $builder = $this->db->table('tbl_payment_mst');
        $builder->where('payment_idx', $payment_idx);
        $row = $builder->get()->getRow();

        $payment_user_name   = encryptField($row->payment_user_name, "decode");
        $payment_user_mobile = encryptField($row->payment_user_mobile, "decode");
        $payment_user_email  = encryptField($row->payment_user_email, "decode");
		
        if (!$row) {
            return $this->response->setBody("<script>alert('결제 정보를 찾을 수 없습니다.');history.back();</script>");
        }

        $data = [
            'payment_idx'      => $row->payment_idx,
            'reservation_name' => $payment_user_name,
            'mobile'           => $payment_user_mobile,
            'email'            => $payment_user_email,
            'order_number'     => $row->payment_no,
            'amount'           => $row->payment_price,
            'product_title'    => $row->product_name,
        ];

        return view('pay/pay_view', $data);
    }
	
	public function pay_ready()
	{
		$request = \Config\Services::request();
		$payment_idx = $request->getPost('idx');

		// DB에서 주문정보 조회 (예시)
		$builder = $this->db->table('tbl_payment_mst');
		$builder->where('idx', $payment_idx);
		$result = $builder->get()->getRow();

		if (!$result) {
			return $this->response->setJSON(['result' => 'FAIL', 'message' => '결제 정보를 찾을 수 없습니다.']);
		}

		// 나이스페이 ready 요청 예제
		$mchtId     = 'YOUR_MERCHANT_ID';
		$clientKey  = 'YOUR_CLIENT_KEY';
		$orderId    = $result->order_number;
		$amount     = $result->amount;
		$goodsName  = $result->product_title;
		$buyerName  = $result->reservation_name;
		$buyerEmail = $result->email;

		// ✅ 나이스페이 API 요청 준비
		// → 실제로는 curl 등으로 나이스페이 서버에 결제 요청(ready)을 보내야 함
		// → 여기서는 예제용으로 'next_redirect_pc_url'을 가짜로 만듭니다

		$paymentUrl = "https://testpay.nicepay.co.kr/v3/redirect/$orderId";

		return $this->response->setJSON([
			'result' => 'OK',
			'next_redirect_pc_url' => $paymentUrl
		]);
	}
	
}

