<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'tbl_flight';
    protected $primaryKey = 'f_idx';
    protected $allowedFields = [
        "code_idx", "code_flight", "f_depature_name", "f_destination_name", "f_depature_time", "f_destination_time"
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

    public function getAllData($code_idx) 
    {
        return $this->where("code_idx", $code_idx)->orderBy("f_idx", "ASC")->get()->getResultArray();
    }
}