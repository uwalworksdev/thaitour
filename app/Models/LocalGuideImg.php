<?php

namespace App\Models;

use CodeIgniter\Model;

class LocalGuideImg extends Model
{
    protected $table = 'tbl_local_guide_img';

    protected $primaryKey = 'i_idx';

    protected $allowedFields = [
        "lg_idx", "ufile", "rfile", "onum", "m_date", "r_date"
    ];

    protected function initialize()
    {
    }

    public function getImg($idx)
    {
		return $this->where('lg_idx', $idx)
                    ->where('ufile !=', '')
                    ->orderBy("onum", "asc")
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