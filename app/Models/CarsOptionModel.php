<?php

use CodeIgniter\Model;

class CarsOptionModel extends Model
{
    protected $table = 'tbl_cars_option';
    protected $primaryKey = 'idx';
    protected $allowedFields = ["product_code", "c_op_name", "c_op_type"];

    public function findOption($product_code)
    {
        return $this->where('product_code', $product_code)->findAll();
    }

}