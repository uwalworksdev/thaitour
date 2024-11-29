<?php

use CodeIgniter\Model;

class CouponMst extends Model
{
    protected $table = 'tbl_coupon_mst';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "coupon_name", "publish_type", "dc_type", "coupon_pe", "coupon_price"
        , "exp_start_day", "exp_end_day", "etc_memo", "state", "regdate"
    ];

    public function getCouponList($s_txt = null, $search_category = null, $pg = 1, $g_list_rows = 10, $where = [])
    {

        $builder = $this;
        $builder->where('state !=', 'C')
            ->where('s1.isDelete !=', 'Y')
            ->where('s1.order_status !=', 'D');

        if ($where) {
            $builder->where($where);
        }

        if ($s_txt && $search_category == 'product_name') {
            $builder->like("s2.product_name", $s_txt);
        }

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('s1.order_r_date', 'desc')
            ->orderBy('s1.order_idx', 'desc')
            ->limit($g_list_rows, $nFrom);

        $order_list = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
            'order_list' => $order_list,
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

        return $this->insert($filteredData);
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
}