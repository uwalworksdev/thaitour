<?php

use CodeIgniter\Model;

class CouponProduct extends Model
{
    protected $table = 'tbl_coupon_product';
    protected $primaryKey = 'cp_idx';
    protected $allowedFields = [
        "coupon_idx", "product_idx", "product_code_1", "product_code_2"
    ];


    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && is_string($data[$key]);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $this->insert($filteredData);
    }

    public function updateData($id, $data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && is_string($data[$key]);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $this->update($id, $filteredData);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }
}