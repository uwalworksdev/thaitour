<?php

use CodeIgniter\Model;

class CouponMst extends Model
{
    protected $table = 'tbl_coupon_mst';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "coupon_name", "publish_type", "dc_type", "coupon_pe", "coupon_price"
        , "exp_start_day", "exp_end_day", "etc_memo", "state", "regdate"
    ];


}