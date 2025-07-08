<?php

namespace App\Models;

use CodeIgniter\Model;

class LocalGuideModel extends Model
{
    protected $table = 'tbl_local_guide';

    protected $primaryKey = 'idx';

    protected $allowedFields = [
        "product_code", "product_code_1", "product_code_2", "product_code_3", "product_code_4", "ufile1", "rfile1",
        "product_name", "product_name_en", "onum", "product_contents", "m_date", "r_date",
        "addrs", "latitude", "longitude", "time_line", "r_date"
    ];

    protected function initialize()
    {

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

        $builder = $this;
	
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