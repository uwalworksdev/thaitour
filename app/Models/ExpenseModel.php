<?php

		namespace App\Models;

		use CodeIgniter\Model;

		class ExpenseModel extends Model
		{
			protected $table      = 'tbl_expense_hist';
			protected $primaryKey = 'idx';
			protected $allowedFields = [
							  'order_idx',
							  'order_no',
							  'exp_id',
							  'exp_date',
							  'exp_amt',
							  'exp_payment',
							  'exp_comp',
							  'exp_sheet',
							  'exp_remark',
							  'reg_date',
							  'upd_date',
							  'del_date',
							  'del_yn',
							  'rfile',
							  'ufile'		
			];
		}

?>