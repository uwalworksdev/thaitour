<?php

namespace App\Models;

use CodeIgniter\Model;

class CouponImg extends Model
{
    protected $table = 'tbl_coupon_img';

    protected $primaryKey = 'i_idx';

    protected $allowedFields = [
        "c_idx", "ufile", "rfile", "m_date", "r_date"
    ];

    protected function initialize()
    {
    }

    public function getImg($c_idx)
    {
		return $this->where('c_idx', $c_idx)
                    ->where('ufile !=', '') // ufile이 공란이 아닌 경우
                    ->orderBy("i_idx", "asc")
                    ->findAll();
    }

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter($data, function ($key) use ($allowedFields, $data) {
            return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
        },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

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

        foreach ($filteredData as $key => $value) {	
            $filteredData[$key] = updateSQ($value);
        }

		return $this->update($id, $filteredData);
    }
}