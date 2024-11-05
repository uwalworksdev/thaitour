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
        'option_date'
    ];
}
