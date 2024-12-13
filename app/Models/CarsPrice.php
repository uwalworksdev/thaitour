<?php

use CodeIgniter\Model;

class CarsPrice extends Model
{
    protected $table = 'tbl_cars_price';
    protected $primaryKey = 'cp_idx';
    protected $allowedFields = [
        "ca_idx", "product_idx", "init_price", "sale_price"
    ];


    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
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
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        return $this->update($id, $filteredData);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }

    public function getData($ca_idx){
        return $this->where("ca_idx", $ca_idx)->orderBy("cp_idx", "asc")->findAll();
    }

}