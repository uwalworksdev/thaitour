<?php

namespace App\Models;

use CodeIgniter\Model;

class Guides extends Model
{
    protected $table = 'tbl_guide_mst';
    protected $primaryKey = 'guide_idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "guide_name", "special_name", "slogan", "age", "exp", "language",
        'product_code', 'product_code_1', 'product_code_2', 'product_code_3',
        "rfile1", "ufile1", "rfile2", "ufile2", "rfile3", "ufile3", 'product_code_list',
        "rfile4", "ufile4", "rfile5", "ufile5", "rfile6", "ufile6", "onum",
        "guide_description", "phone", "email", "status", "created_at", "updated_at",
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
        $sql = " select * from tbl_guide_mst where status != 'D' order by onum asc, guide_idx desc";
        write_log($sql);
        return $this->db->query($sql)->getResultArray();
    }

    public function getListByStatus()
    {
        $sql = "SELECT guide_idx AS product_idx, special_name AS product_name, onum, guide_idx, status 
            FROM tbl_guide_mst 
            WHERE status != 'D' AND status != 'S' 
            ORDER BY onum ASC, guide_idx DESC";
        write_log($sql);
        return $this->db->query($sql)->getResultArray();
    }


    public function getListPaging($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->builder();

        $builder->where("status !=", "D");
        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = [
                'onum' => 'DESC',
                'guide_idx' => 'DESC',
            ];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }
        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        $data = [
            'items' => $items,
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

    public function selectById($idx)
    {
        $sql = " select * from tbl_guide_mst where guide_idx = '" . $idx . "'";
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

    public function getDataByConditions(array $conditions)
    {
        $builder = $this;

        foreach ($conditions as $field => $value) {
            $builder = $builder->where($field, $value);
        }

        $builder = $builder->orderBy('onum', 'ASC')
            ->orderBy('guide_idx', 'DESC');

        return $builder->findAll();
    }
}
