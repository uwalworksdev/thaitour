<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelThemeModel extends Model
{
    protected $table = 'tbl_hotel_theme';

    protected $primaryKey = 'idx';

    protected $allowedFields = [
        "title", "subtitle", "type", "recommend_text", "url", "ufile1", "rfile1", "onum", "r_date", "m_date"
    ];
    protected $codeModel;
    protected $hotelArea;

    public function __construct()
    {
        parent::__construct();
        $this->codeModel = new Code();
        $this->hotelArea = new HotelAreaTheme();

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

        if(!empty($where['type'])) {
            $builder->where("type", $where['type']);
        }
	
        if ($where['search_txt'] != "") {
            if ($where['search_category'] != "") {
                $builder->like($where['search_category'], $where['search_txt']);
            } else {
                $builder->groupStart();
                $builder->like('title', $where['search_txt']);
                $builder->orLike('subtitle', $where['search_txt']);
                $builder->groupEnd();
            }
        }

        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = ['onum' => 'DESC'];
            $orderBy = ['idx' => 'DESC'];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }

        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();
		
        foreach ($items as $key => $value) {
            $result = $this->hotelArea->where("theme_idx", $value['idx'])->findAll();

            foreach ($result as $row) {
                $arr_code_name[] = $this->codeModel->getCodeName($row['category_code']);
            }
            $items[$key]['category_name'] = implode(',', $arr_code_name);
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