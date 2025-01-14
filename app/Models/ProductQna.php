<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductQna extends Model
{
    protected $table = 'tbl_product_qna';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'title', 'reply_content', 'm_idx', 'user_name', 'product_idx', 
        'product_gubun', 'status', 'is_view', 'user_ip', 'r_date', 'm_date'
    ];

    public function getList($gubun, $where = [], $g_list_rows = 1000, $pg = 1)
    {
        $builder = $this->db->table('tbl_product_qna p1');
        $builder->select('p1.*, p2.product_name');
        $builder->join('tbl_product_mst p2', 'p1.product_idx = p2.product_idx', 'left');

        if (!empty($where['product_idx'])) {
            $builder->where('p1.product_idx', $where['product_idx']);
        }

        if (!empty($where['search_txt'])) {
            $builder->groupStart();
            if (!empty($where['search_category'])) {
                $builder->like($where['search_category'], $where['search_txt']);
            } else {
                $builder->like('product_name', $where['search_txt']);
            }
            $builder->groupEnd();
        }

        $builder->where('product_gubun', $gubun);
        $builder->where('status', 'Y');

        $builder->orderBy("r_date", "DESC");
        $builder->orderBy("idx", "DESC");

        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        $nFrom = ($pg - 1) * $g_list_rows;

        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        $arr_ = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom,
        ];

        return array_merge($arr_, $where);
    }

    function getByIdx($idx) {
        $builder = $this->db->table('tbl_product_qna p1');
        $builder->select('p1.*, p2.product_name');
        $builder->join('tbl_product_mst p2', 'p1.product_idx = p2.product_idx', 'left');
        $builder->where('p1.idx', $idx);
        $builder->where('status', 'Y');
        return $builder->get()->getRowArray();
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

}
