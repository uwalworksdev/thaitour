<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelPriceModel extends Model
{
    protected $table = 'tbl_hotel_price';
    protected $primaryKey = 'idx';
    protected $allowedFields = [ "o_idx", "goods_code", "goods_name", "goods_date", "dow", "goods_price1",
                                "goods_price2", "use_yn", "o_sdate", "o_edate", "reg_date", "upd_date"];
}