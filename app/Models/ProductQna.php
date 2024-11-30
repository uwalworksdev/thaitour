<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductQna extends Model
{
    protected $table = 'tbl_product_qna';
    protected $primaryKey = 'idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'title', 'parent_idx', 'user_name', 'user_email', 'user_id', 'product_idx',
        'status', 'is_best', 'user_ip', 'r_date', 'm_date'
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

    public function getList()
    {
        $sql = " select * from tbl_product_qna where status = 'Y' and parent_idx = null order by idx desc";
        write_log($sql);
        return $this->db->query($sql)->getResultArray();
    }

    public function getListChild($parent_idx)
    {
        $sql = " select * from tbl_product_qna where status = 'Y' and parent_idx = $parent_idx order by idx desc";
        write_log($sql);
        return $this->db->query($sql)->getResultArray();
    }

    public function getById($idx)
    {
        $sql = " select * from tbl_product_qna where idx = '" . $idx . "'";
        write_log($sql);
        return $this->db->query($sql)->getRowArray();
    }

    public function insertData($data)
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

    public function updateData($id, $data)
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

    public function getAllByProduct($product_idx)
    {
        $sql = " select * from tbl_product_qna where product_idx = '" . $product_idx . "' and status = 'Y' and parent_idx = null order by idx desc";
        write_log($sql);
        $questions = $this->db->query($sql)->getResultArray();

        $questions = array_map(function ($item) use ($product_idx) {
            $rs = (array)$item;

            $parent_idx = $item['idx'];

            $sql = " select * from tbl_product_qna where product_idx = '" . $product_idx . "' and status = 'Y' and parent_idx = $parent_idx order by idx desc";
            write_log($sql);
            $answers = $this->db->query($sql)->getResultArray();

            $rs['answers'] = $answers;

            return $rs;
        }, $questions);

        return $questions;
    }
}
