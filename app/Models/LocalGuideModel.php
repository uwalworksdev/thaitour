<?php

namespace App\Models;

use CodeIgniter\Model;

class LocalGuideModel extends Model
{
    protected $table = 'tbl_local_guide';

    protected $primaryKey = 'idx';

    protected $allowedFields = [
        "lp_idx", "town_code", "subcategory_code", "ufile1", "rfile1",
        "product_name", "product_name_en", "onum", "product_contents", "m_date", "r_date",
        "addrs", "latitude", "longitude", "time_line", "contact", "url", "r_date", "m_date"
    ];

    protected $codeModel;
    protected $localProduct;

    public function __construct()
    {
        parent::__construct();
        $this->codeModel = new Code();
        $this->localProduct = new LocalProductModel();
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

    public function get_list($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {

        $builder = $this->db->table('tbl_local_guide AS g');
        $builder->select('g.*');
        $builder->join('tbl_local_product AS p', 'g.lp_idx = p.idx', 'left');

        if(!empty($where['city_code'])){
            $builder->where('city_code =', $where['city_code']);
    
            if(!empty($where['town_code'])){
                $builder->where('town_code =', $where['town_code']);
            }
        }

        if(!empty($where['category_code'])){
            $builder->where('category_code =', $where['category_code']);
    
            if(!empty($where['subcategory_code'])){
                $builder->where('subcategory_code =', $where['subcategory_code']);
            }
        }
	
        if ($where['search_txt'] != "") {
            if ($where['search_category'] != "") {
                $builder->like($where['search_category'], $where['search_txt']);
            } else {
                $builder->groupStart();
                $builder->like('product_name', $where['search_txt']);
                $builder->groupEnd();
            }
        }

        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = ['idx' => 'DESC'];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }

        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();
        		
        foreach ($items as $key => $value) {
            $local_product = $this->localProduct->find($value['lp_idx']);
            $items[$key]['city_code'] = $local_product['city_code'];
            $items[$key]['city_code_name'] = $this->codeModel->getCodeName($local_product['city_code']);
            $items[$key]['category_code'] = $local_product['category_code'];
            $items[$key]['category_code_name'] = $this->codeModel->getCodeName($local_product['category_code']);
            $items[$key]['town_code_name'] = $this->codeModel->getCodeName($local_product['town_code']);
            $items[$key]['subcategory_code_name'] = $this->codeModel->getCodeName($local_product['subcategory_code']);

            $items[$key]['local_product_title'] = $local_product['title'];
        }


        $data = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'search_txt' => $where['search_txt'],
            'search_category' => $where['search_category'],
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];

        return $data;
    }
}