<?php

use CodeIgniter\Model;

class CarsCategory extends Model
{
    protected $table = 'tbl_cars_category';
    protected $primaryKey = 'ca_idx';
    protected $allowedFields = [
        "ca_name", "parent_ca_idx", "depth", "status", "is_two_date", "onum"
    ];


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

        return $this->update($id, $filteredData);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }

    public function getCategoryList($search_txt = null, $search_category = null, $pg = 1, $g_list_rows = 10) {
        $builder = $this->db->table('tbl_cars_category a')
                            ->select('a.ca_idx, a.ca_name as departure_name, b.ca_name as destination_name')
                            ->join('tbl_cars_category b', 'a.ca_idx = b.parent_ca_idx', 'left')
                            ->where('a.parent_ca_idx', 0);


        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('a.ca_idx', 'asc')
                ->limit($g_list_rows, $nFrom);

        $category_list = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
            'category_list' => $category_list,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
        ];
    }
}