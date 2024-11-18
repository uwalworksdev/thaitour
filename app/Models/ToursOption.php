<?php

namespace App\Models;

use CodeIgniter\Model;

class ToursOption extends Model
{
    protected $table = 'tbl_tours_option';
    protected $primaryKey = 'idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'code_idx', 'product_idx', 'option_name', 'option_price', 'option_cnt',
        'use_yn', 'afile', 'bfile', 'option_type', 'onum', 'rdate',
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

    protected function getById($product_idx)
    {
        $sql = " select * from tbl_tours_option where product_idx = '" . $product_idx . "'";
        write_log($sql);
        return $this->db->query($sql)->getRowArray();
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

    protected function deleteData($code_idx, $product_idx)
    {
        $sql = "delete from tbl_tours_option where code_idx = '" . $code_idx . "'  and product_idx = '" . $product_idx . "' ";
        $this->db->query($sql);
    }
}
