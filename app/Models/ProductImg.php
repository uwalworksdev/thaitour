<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImg extends Model
{
    protected $table = 'tbl_product_img';

    protected $primaryKey = 'i_idx';

    protected $allowedFields = [
        "product_idx", "ufile", "rfile", "onum", "m_date", "r_date"
    ];

    protected function initialize()
    {
    }

    public function getImg($product_idx)
    {
		return $this->where('product_idx', $product_idx)
                    ->where('ufile !=', '') // ufile이 공란이 아닌 경우
                    ->orderBy("onum", "asc")
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

    public function copyImage($product_idx, $new_product_idx)
    {
        $info = $this->where("product_idx", $product_idx)->get()->getResultArray();

        $data = [];

        foreach($info as $row) {
            unset($row['i_idx']);
            $row['product_idx'] = $new_product_idx;
            $row['r_date'] = date("Y-m-d H:i:s");
            $data[] = $row;
        }

        if (!empty($data)) {
            $this->insertBatch($data);
        }

    }
}