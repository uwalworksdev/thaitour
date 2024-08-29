<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductAirModel extends Model
{
    protected $table = 'tbl_product_air';
    protected $primaryKey = 'air_idx';
    protected $allowedFields = ['air_name_1', 'air_no_1', 's_air_port_1', 'e_air_port_1', 
    's_air_time_1', 'e_air_time_1', 'e_date_change_1', 'fly_time_1', 'air_name_2', 'air_no_2', 
    's_air_port_2', 'e_air_port_2', 's_air_time_2', 'e_air_time_2', 'e_date_change_2', 'fly_time_2', 
    'product_idx', 'prod_info', 'yoil_idx', 'air_code_1', 'air_code_2', 'tour_price', 'tour_price_kids', 
    'tour_price_baby', 'tour_price_max', 'tour_price_kids_max', 'tour_price_baby_max', 'oil_price_max', 
    'oil_price', 'r_date', 'sale', 'deadline_date'];

    public function getProductAir()
    {
        return $this->first();
    }
}
