<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeContents extends Model
{
    protected $table = 'tbl_code_contents';

    protected $primaryKey = 'idx';

    protected $allowedFields = [
        "code_idx", "contents", "r_date", "m_date"
    ];

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