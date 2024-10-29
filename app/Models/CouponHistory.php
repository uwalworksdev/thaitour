<?php

use CodeIgniter\Model;

class CouponHistory extends Model
{
    protected $table = 'tbl_coupon_history';
    protected $primaryKey = 'ch_idx';
    protected $allowedFields = ["order_idx", "product_idx", "used_coupon_idx", "used_coupon_no", "m_idx", "used_coupon_money", "ch_r_date"];

}