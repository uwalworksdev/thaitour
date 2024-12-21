<?php

namespace App\Controllers;

class CheckoutController extends BaseController
{
    private $db;
    private $productModel;

    public function __construct() {
        $this->db = db_connect();
        $this->orderModel = model("productModel");

    }

    public function show()
    {
        $db         = \Config\Database::connect();

		$array = explode(",", $_POST['dataValue']);

		// 각 요소에 작은따옴표 추가
		$quotedArray = array_map(function($item) {
			return "'" . $item . "'";
		}, $array);

		// 배열을 다시 문자열로 변환
		$output = implode(',', $quotedArray);
 
		$sql = "SELECT 
				tbl_order_mst.*,
				GROUP_CONCAT(CONCAT(tbl_order_option.option_name, ':', tbl_order_option.option_cnt) SEPARATOR '|') as options
				FROM 
					tbl_order_mst
				LEFT JOIN 
					tbl_order_option 
				ON 
					tbl_order_mst.order_idx = tbl_order_option.order_idx
				WHERE tbl_order_mst.order_no IN(". $output .") AND order_no != '' 
				GROUP BY 
					tbl_order_mst.order_no ";
		$result = $db->query($sql)->getResultArray();

		$payment_no           = "P_". date('YmdHis') . rand(100, 999); 				// 가맹점 결제번호
        $resulr['payment_no'] = $payment_no; 

        return view("checkout/show", [
            "result" => $result 
        ]);
    }

    public function confirm()
    {
        $db     = \Config\Database::connect();

        $session   = Services::session();
        $memberIdx = $session->get('member')['idx'] ?? null;

        $m_idx = $memberIdx,
        $payment_no =  updateSQ($this->request->getPost('payment_no'));				// 가맹점 결제번호
		$ordert_no 	=  updateSQ($this->request->getPost('dataValue'));				// 가맹점 주문번호

        $payment_user_name  = updateSQ($this->request->getPost('order_user_name'));
        $payment_user_name  = encryptField($payment_user_name, "encode");

        $companion_gender = updateSQ($this->request->getPost('companion_gender'));

        $payment_user_first_name_en = updateSQ($this->request->getPost('order_user_first_name_en'));
        $payment_user_first_name_en = encryptField($payment_user_first_name_en, "encode");

		$payment_user_last_name_en  = updateSQ($this->request->getPost('order_user_last_name_en'));
        $payment_user_last_name_en  = encryptField($payment_user_last_name_en, "encode");

        $email_1     = updateSQ($this->request->getPost('email_1'));
        $email_2     = updateSQ($this->request->getPost('email_2'));
		$payment_user_email = $email_1 ."@". $email_2
        $payment_user_email = encryptField($payment_user_email, "encode");

		$phone_1     = updateSQ($this->request->getPost('phone_1'));
        $phone_2     = updateSQ($this->request->getPost('phone_2'));	
        $phone_3     = updateSQ($this->request->getPost('phone_3'));
		$payment_user_mobile = $phone_1 ."-". $phone_2 ."-". $phone_3;
        $payment_user_mobile  = encryptField($payment_user_mobile, "encode");

		$payment_user_gender= updateSQ($this->request->getPost('companion_gender'));
        $phone_thai  = updateSQ($this->request->getPost('phone_thai'));
        $phone_thai  = encryptField($phone_thai, "encode");

        $payment_date = Time::now('Asia/Seoul', 'en_US');

		$result = $db->query($sql);

        return view('checkout/confirm', $data);
    }

    public function bank()
    {
        return view('checkout/bank');
    }

    public function confirm_order()
    {
        return view('checkout/confirm_order', ['return_url' => '/']) ;
    }
}
