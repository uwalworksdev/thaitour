<?php

namespace App\Models;

use CodeIgniter\Model;

class TourImg extends Model
{
    protected $table = 'tbl_tour_img';

    protected $primaryKey = 'i_idx';

    protected $allowedFields = [
        "product_idx", "ufile", "rfile", "m_date", "r_date"
    ];

    protected function initialize()
    {
    }

    public function getImg($product_idx)
    {
		return $this->where('product_idx', $product_idx)
                    ->where('ufile !=', '') // ufile이 공란이 아닌 경우
                    ->orderBy("i_idx", "asc")
                    ->findAll();

        //return $this->where('product_idx', $product_idx)->orderBy("i_idx", "asc")->findAll();
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