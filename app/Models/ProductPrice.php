<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductPrice extends Model
{
    protected $table = 'tbl_product_price';
    protected $primaryKey = 'p_idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'product_idx', 's_date', 'e_date', 'adult_price', 'kids_price', 'senior_price',
        'yoil_0', 'yoil_1', 'yoil_2', 'yoil_3', 'yoil_4', 'yoil_5', 'yoil_6', 'c_date',
        'sale', 'status', 'column_name',
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    protected function getById($p_idx)
    {
        try {
            $sql = " select * from tbl_product_price where p_idx = '" . $p_idx . "'";
            write_log($sql);
            return $this->db->query($sql)->getRowArray();
        } catch (\Exception $e) {
            write_log($e->getMessage());
            return false;
        }
    }

    protected function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields);
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

        return $this->insert($filteredData);
    }

    protected function updateData($id, $data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields);
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

        return $this->update($id, $filteredData);
    }
}
