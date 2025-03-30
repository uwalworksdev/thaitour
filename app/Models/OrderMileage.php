<?php

use CodeIgniter\Model;

class OrderMileage extends Model
{
    protected $table = 'tbl_order_mileage';

    protected $primaryKey = 'mi_idx';

    protected $allowedFields = ["mi_title", "order_idx", "order_mileage", "order_gubun", "m_idx", "product_idx", "mi_r_date", "remaining_mileage"];

    public function getPoint($s_date = null, $e_date = null, $pg = 1, $g_list_rows = 10)
    {
        $builder = $this;
        $builder = $this->where('m_idx', $_SESSION['member']['mIdx']);

        if(!empty($s_date) && !empty($e_date)){
            $builder->where("DATE_FORMAT(mi_r_date, '%Y-%m-%d') >=", $s_date);
            $builder->where("DATE_FORMAT(mi_r_date, '%Y-%m-%d') <=", $e_date);
        }

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('mi_idx', 'desc')
        ->limit($g_list_rows, $nFrom);

        $point_list = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
                'point_list' => $point_list,
                'nTotalCount' => $nTotalCount,
                'pg' => $pg,
                'nPage' => $nPage,
                'g_list_rows' => $g_list_rows,
                'num' => $num,
            ];
    }

    public function getPointMem($m_idx, $s_date = null, $e_date = null, $pg = 1, $g_list_rows = 10)
{
    $builder = $this->where('m_idx', $m_idx); // Lọc theo m_idx

    if (!empty($s_date) && !empty($e_date)) {
        $builder->where("DATE_FORMAT(mi_r_date, '%Y-%m-%d') >=", $s_date);
        $builder->where("DATE_FORMAT(mi_r_date, '%Y-%m-%d') <=", $e_date);
    }

    $nTotalCount = $builder->countAllResults(false);
    $nPage = ceil($nTotalCount / $g_list_rows);
    if ($pg == "") {
        $pg = 1;
    }
    $nFrom = ($pg - 1) * $g_list_rows;

    $builder->orderBy('mi_idx', 'desc')
            ->limit($g_list_rows, $nFrom);

    $point_list = $builder->get()->getResultArray();
    $num = $nTotalCount - $nFrom;

    return [
        'point_list'   => $point_list,
        'nTotalCount'  => $nTotalCount,
        'pg'           => $pg,
        'nPage'        => $nPage,
        'g_list_rows'  => $g_list_rows,
        'num'          => $num,
    ];
}

   
}