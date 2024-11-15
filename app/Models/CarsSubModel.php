<?php

use CodeIgniter\Model;

class CarsSubModel extends Model
{
    protected $table = 'tbl_cars_sub';
    protected $primaryKey = 'idx';
    protected $allowedFields = ["product_idx", "departure_code", "destination_code", "car_price"];

    public function findSub($product_idx)
    {
        return $this->where('product_idx', $product_idx)->findAll();
    }
}