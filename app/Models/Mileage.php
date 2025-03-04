<?php

namespace App\Models;

use CodeIgniter\Model;

class Mileage extends Model
{
    protected $table = 'tbl_order_mileage';

    protected $primaryKey = 'mi_idx';

    protected $allowedFields = [
        "mi_title", "order_idx", "order_mileage", "order_gubun", "m_idx", "product_idx", "mi_r_date", "remaining_mileage",
    ];

}