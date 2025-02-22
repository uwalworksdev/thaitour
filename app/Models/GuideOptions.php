<?php

namespace App\Models;

use CodeIgniter\Model;

class GuideOptions extends Model
{
    protected $table = 'tbl_guide_options';
    protected $primaryKey = 'o_idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "o_name", "o_price", "o_sale_price", "o_people_cnt",
        "o_availability", "product_idx", "onum", "r_date", "m_date",
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

    public function getDataByConditions(array $conditions)
    {
        $builder = $this;

        foreach ($conditions as $field => $value) {
            $builder = $builder->where($field, $value);
        }

        $builder = $builder->orderBy('onum', 'ASC')
            ->orderBy('o_idx', 'DESC');

        return $builder->findAll();
    }

    public function getListByProductId($product_idx)
    {
        $sql = " select * from tbl_guide_options where product_idx = '$product_idx' order by onum asc, o_idx desc";
        write_log($sql);
        return $this->db->query($sql)->getResultArray();
    }

    public function getById($idx)
    {
        $sql = " select * from tbl_guide_options where o_idx = '" . $idx . "'";
        write_log($sql);
        return $this->db->query($sql)->getRowArray();
    }

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

    public function deleteData($idx)
    {
        $this->delete($idx);
    }
}
