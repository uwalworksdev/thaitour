<?php

	namespace App\Models;

	use CodeIgniter\Model;

	class PaymentModel extends Model
	{
		protected $table      = 'tbl_mayment_mst'; // 테이블명
		protected $primaryKey = 'payment_idx';            // 기본 키

		protected $allowedFields = [

						'm_idx', 	
						'payment_no', 	
						'order_no', 
						'product_name', 	
						'payment_date', 	
						'payment_user_name', 
						'payment_user_first_name_en', 	
						'payment_user_last_name_en', 	
						'payment_user_email', 	
						'payment_user_mobile', 	
						'payment_user_phone', 
						'local_phone',	
						'phone_thai',
						'payment_user_gender',	
						'pay_name',	
						'pay_email',	
						'pay_hp',	
						'payment_memo',	
						'payment_tot',	
						'payment_pg',	
						'payment_account',	
						'payment_price',	
						'payment_confirm_price',	
						'payment_confirm_date',	
						'confirm_method',	
						'deposit_price',
						'deposit_date',	
						'deposit_method',	
						'payment_method',	
						'used_coupon_idx',	
						'used_coupon_num',	
						'used_coupon_name',	
						'used_coupon_pe',	
						'used_coupon_price',	
						'used_coupon_money',	
						'used_point',	
						'payment_status',	
						'payment_m_date',	
						'payment_r_date',	
						'payment_d_date',	
						'payment_c_date',	
						'is_modify',	
						'paydate',	
						'erp_seq',	
						'ResultCode_1',	
						'ResultMsg_1',	
						'Amt_1',	
						'TID_1',	
						'AuthCode_1',	
						'AuthDate_1',	
						'CancelDate_1',	
						'VbankBankCode_1',	
						'VbankBankName_1',	
						'VbankNum_1',	
						'VbankExpDate_1',	
						'VbankExpTime_1',
						'depositor_1',	
						'bank_1',	
						'isDelete',	
						'encode'
		];
	}

?>