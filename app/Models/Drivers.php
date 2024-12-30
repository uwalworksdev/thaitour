<?php

namespace App\Models;

use CodeIgniter\Model;

class Drivers extends Model
{
    protected $table = 'tbl_driver_mst';
    protected $primaryKey = 'd_idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "full_name", "special_name", "phone", "email", "vehicle_type", "vehicle_image", "vehicle_image2",
        "vehicle_idx", "is_show", "avatar", "exp", "onum", "created_at", "updated_at",
        "r_avatar", "r_vehicle_image", "r_vehicle_image2", "vehicle_name",
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

    public function getById($d_idx)
    {
        $sql = " select * from tbl_driver_mst where d_idx = '" . $d_idx . "'";
        write_log($sql);
        return $this->db->query($sql)->getRowArray();
    }

    public function getByProductId($vehicle_idx)
    {
        $sql = " select * from tbl_driver_mst where vehicle_idx = '" . $vehicle_idx . "' order by onum desc, d_idx desc";
        write_log($sql);
        return $this->db->query($sql)->getResultArray();
    }

    public function listAll()
    {
        $sql = " select * from tbl_driver_mst order by onum desc, d_idx desc";
        write_log($sql);
        return $this->db->query($sql)->getResultArray();
    }

    public function getListPaging($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->builder();

        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = [
                'onum' => 'DESC',
                'd_idx' => 'DESC',
            ];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }
        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        $data = [
            'items' => $items,
            'setting' => $setting,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'search_category' => $where['search_category'],
            'status' => $where['status'],
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
        return $data;
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

    public function getByConditions(array $conditions)
    {
        $builder = $this;

        foreach ($conditions as $field => $value) {
            $builder = $builder->where($field, $value);
        }

        $builder = $builder->orderBy('onum', 'DESC')
            ->orderBy('d_idx', 'DESC');

        return $builder->findAll();
    }
}
