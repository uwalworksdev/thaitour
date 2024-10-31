<?php

use CodeIgniter\Model;

class PaymentHist extends Model
{
    protected $table = 'tbl_payment_hist';

    protected $primaryKey = 'idx';

    protected $allowedFields = [
        "order_no",
        "order_gubun",
        "order_method",
        "order_price",
        "order_status",
        "ResultCode",
        "ResultMsg",
        "Amt",
        "TID",
        "AuthCode",
        "AuthDate",
        "CancelDate",
        "VbankBankCode",
        "VbankBankName",
        "VbankNum",
        "VbankExpDate",
        "VbankExpTime",
        "encode",
        "regDate"
    ];
}