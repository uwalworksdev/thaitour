<?php

use CodeIgniter\Model;

class CarsCategory extends Model
{
    protected $table = 'tbl_cars_category';
    protected $primaryKey = 'ca_idx';
    protected $allowedFields = [
        "code_no", "parent_ca_idx", "depth", "status", "is_two_date", "onum"
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
                            ->select('a.ca_idx, a.code_no as departure_code, b.code_no as destination_code')
                            ->join('tbl_cars_category b', 'a.ca_idx = b.parent_ca_idx', 'left')
                            ->where('a.parent_ca_idx', 0);


        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('a.ca_idx', 'desc')
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

    public function getDepthCategory($parent_ca_idx): array
    {
        $descendants = [];

        $children = $this->where('parent_ca_idx', $parent_ca_idx)->findAll();

        foreach ($children as $child) {
            $category = [];
            $category = $child;

            $category['children'] = $this->getDepthCategory($child['ca_idx']);

            array_push($descendants, $category);
        }

        return $descendants;
    }

    public function getByParentCode($parent_ca_idx)
    {
        return $this->db->table('tbl_cars_category a')
            ->select('a.*, b.code_name')
            ->join('tbl_code b', 'a.code_no = b.code_no', 'left')
            ->where('a.parent_ca_idx', $parent_ca_idx)
            ->where('a.status', 'Y')
            ->groupBy('a.code_no')
            ->orderBy('a.onum', 'ASC')
            ->orderBy('a.ca_idx', 'ASC')
            ->get();
    }

    public function getById($ca_idx)
    {
        return $this->db->table('tbl_cars_category a')
            ->select('a.*, b.code_name')
            ->join('tbl_code b', 'a.code_no = b.code_no', 'left')
            ->where('a.ca_idx', $ca_idx)
            ->get()->getRowArray();
    }


    public function getByCodeNo($code_no)
    {
        return $this->where("code_no", $code_no)->where("status", "Y")
                                            ->orderBy("onum", "DESC")
                                            ->orderBy('ca_idx', 'ASC')
                                            ->get();
    }

    public function getByParentAndCodeNo($parent_ca_idx, $code_no)
    {
        $parent_list = $this->getByCodeNo($code_no)->getResultArray();

        $arr_sub = [];

        foreach($parent_list as $category){
            $sub = $this->getByParentCode($category["ca_idx"])->getRowArray();
            array_push($arr_sub, $sub);
        }

        return $arr_sub;
    }

    public function getCategoryTree($ca_idx)
    {
        $category_arr = [];
        $category = $this->getById($ca_idx);
        while ($category && $category["depth"] > 2) {
            $category_arr[] = $category;
            $category = $this->getById($category['parent_ca_idx']);
        }
        return array_reverse($category_arr);
    }
}