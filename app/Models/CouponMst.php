<?php

use CodeIgniter\Model;

class CouponMst extends Model
{
    protected $table = 'tbl_coupon_mst';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "coupon_name", "publish_type", "dc_type", "coupon_pe", "coupon_price", "max_coupon_price"
        , "exp_start_day", "exp_end_day", "etc_memo", "state", "member_grade", "coupon_contents", "regdate"
        , "ufile1", "rfile1", "ufile2", "rfile2", "ufile3", "rfile3", "ufile4", "rfile4", "ufile5", "rfile5", "ufile6", "rfile6", "ufile7", "rfile7"
    ];

    public function getCouponList($s_txt = null, $search_category = null, $pg = 1, $g_list_rows = 10)
    {

        $builder = $this;
        $builder->where('state !=', 'C');

        if ($s_txt && $search_category) {
            $builder->like($search_category, $s_txt);
        }

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('idx', 'desc')
            ->limit($g_list_rows, $nFrom);

        $coupon_list = $builder->get()->getResultArray();

        foreach($coupon_list as $key => $value) {
            $coupon_list[$key]["member_grade_name"] = $this->db->table("tbl_member_grade")
                                                                ->where("g_idx", $value["member_grade"])
                                                                ->get()->getRowArray()["grade_name"];
        }

        $num = $nTotalCount - $nFrom;

        return [
            'coupon_list' => $coupon_list,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
        ];
    }

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && is_string($data[$key]);
            },
            ARRAY_FILTER_USE_KEY
        );

        $this->insert($filteredData);
        return $this->getInsertID();

    }

    public function updateData($id, $data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && is_string($data[$key]);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $this->update($id, $filteredData);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }
}