<?php

use CodeIgniter\Model;

class TourInfoModel extends Model
{
    protected $table = 'tbl_product_tour_info';
    protected $primaryKey = 'info_idx';
    protected $allowedFields = [
        'product_idx', 
        'group', 
        'o_sdate', 
        'o_edate',
        'tour_info_price',
        'yoil_0', 
        'yoil_1', 
        'yoil_2', 
        'yoil_3', 
        'yoil_4', 
        'yoil_5', 
        'yoil_6', 
        'o_onum', 
        'r_date'
    ];

    public function getInfoById($info_idx)
    {
        return $this->where('info_idx', $info_idx)->findAll();
    }

    public function deleteTour($info_idx)
    {
        return $this->where('info_idx', $info_idx)->delete();
    }
}