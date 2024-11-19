<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderOptionModel extends Model
{
    protected $table = 'tbl_order_option';
    protected $primaryKey = 'opt_idx';

    protected $allowedFields = [
        'option_type',
        'order_idx',
        'product_idx',
        'option_name',
        'option_idx',
        'option_tot',
        'option_cnt',
        'option_price',
        'option_qty',
        'option_date',
    ];

    public function getOption($order_idx, $option_type)
    {
        return $this->where('order_idx', $order_idx)->where('option_type', $option_type)->findAll();
    }
}
