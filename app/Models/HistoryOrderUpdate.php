<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryOrderUpdate extends Model
{
    protected $table = 'tbl_history_order_update';
    protected $primaryKey = 'h_idx';
    protected $allowedFields = [ "m_idx", "order_idx", "ip_address", "updated_date"];

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

        $this->insert($filteredData);
        return $this->getInsertID();

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
}