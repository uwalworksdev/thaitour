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
		$user_mobile      = encryptField($payment_user_email, "decode");
		write_log("user_mobile- ". $user_mobile);
		$user_mobile_last = substr($user_mobile, -4);
        if ($result && $user_mobile_last === $input_phone_last4) {
            // 일치 → view 페이지로
            return redirect()->to("/pay/view?idx={$payment_idx}");
        } else {
            // 불일치 → alert
            return $this->response->setBody("<script>alert('전화번호를 확인하세요');location.href='/pay?idx={$payment_idx}&tel={$user_mobile_last}';</script>");
        }
    }

    public function pay_view()
    {
        $payment_idx = $this->request->getGet("idx");

        // 실제 데이터 조회 예제
        $builder = $this->db->table('tbl_payment_mst');
        $builder->where('payment_idx', $payment_idx);
        $row = $builder->get()->getRow();

        if (!$row) {
            return $this->response->setBody("<script>alert('결제 정보를 찾을 수 없습니다.');history.back();</script>");
        }

        $data = [
            'reservation_name' => $row->reservation_name,
            'email'            => $row->email,
            'order_number'     => $row->order_number,
            'amount'           => $row->amount,
            'product_title'    => $row->product_title,
        ];

        return view('pay/pay_view', $data);
    }
}

