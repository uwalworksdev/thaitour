<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelOptionModel extends Model
{
    protected $table = 'tbl_hotel_option';
    protected $primaryKey = 'idx';

    protected $allowedFields = [
        'goods_code',
        'goods_name',
        'goods_price1',
        'use_yn',
        'option_type',
        'o_sdate',
        'o_edate',
        'o_soldout',
        'o_room',
        'stay_idx',
        'price_secret',
        'op_won_bath'
    ];

    public function getByIdx($idx)
    {
        return $this->where("idx", $idx)->first();
    }
}
