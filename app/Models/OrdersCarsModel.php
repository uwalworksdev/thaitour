<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersCarsModel extends Model
{
    protected $table = 'tbl_order_cars';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "order_idx", "air_code", "departure_name", "destination_name", "rest_name", "date_trip", "hours", "minutes", "order_memo", "schedule_content"
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

    public function getByOrder($order_idx)
    {
        return $this->where("order_idx", $order_idx)
                    ->orderBy('idx', 'ASC')
                    ->get()->getResultArray();
    }
}