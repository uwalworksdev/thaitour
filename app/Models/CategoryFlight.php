<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryFlight extends Model
{
    protected $table = 'tbl_category_flight';
    protected $primaryKey = 'cf_idx';
    protected $allowedFields = [
        "ca_idx", "air_idx", "f_idx", "onum"
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

    public function getAllAirlines($ca_idx) {
        return $this->db->table('tbl_category_flight c1')
                    ->select('c2.*, c1.air_idx, c1.ca_idx, c1.f_idx')
                    ->join('tbl_code c2', 'c1.air_idx = c2.code_idx', 'left')
                    ->where("c1.ca_idx", $ca_idx)
                    ->groupBy("c1.air_idx")
                    ->orderBy("c1.onum", "desc")
                    ->orderBy("c1.cf_idx", "asc")
                    ->get()->getResultArray();
    }

    public function getAllFlight($ca_idx, $air_idx) {
        return $this->db->table('tbl_category_flight c1')
                    ->select('f1.*, c1.air_idx, c1.ca_idx, c1.cf_idx')
                    ->join('tbl_code c2', 'c1.air_idx = c2.code_idx', 'left')
                    ->join('tbl_flight f1', 'f1.f_idx = c1.f_idx', 'left')
                    ->where("c1.ca_idx", $ca_idx)
                    ->where("c1.air_idx", $air_idx)
                    ->orderBy("c1.onum", "desc")
                    ->orderBy("c1.cf_idx", "asc")
                    ->get()->getResultArray();
    }
}