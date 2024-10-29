<?php

use CodeIgniter\Model;

class Coupon extends Model
{
    protected $table = 'tbl_coupon';
    protected $primaryKey = 'c_idx';
    protected $allowedFields = ["coupon_num", "coupon_type", "types", "user_id", "status", "order_memo", "last_idx", "regdate", "enddate", "usedate", "get_issued_yn"];

}