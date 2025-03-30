<?php

namespace App\Models;

use CodeIgniter\Model;

class ToursPrice extends Model
{
    protected $table = 'tbl_tours_price';

    protected $primaryKey = 'idx';

    protected $allowedFields = [
        "product_idx", "info_idx", "tours_idx", "goods_date", "dow", "baht_thai"
        , "goods_price1", "goods_price2", "goods_price3", "use_yn", "upd_yn", "reg_date", "upd_date"
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
