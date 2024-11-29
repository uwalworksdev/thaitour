<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Exception;

class AdminCouponController extends BaseController
{
    private $couponMst;
    private $db;

    public function __construct()
    {
        $this->couponMst = model("CouponMst");
        helper(['html']);
        $this->db = db_connect();
        helper('my_helper');
        helper('comment_helper');
    }

    public function list(){
        $g_list_rows = 100;
        $strSql = '';
        $pg = updateSQ($_GET["pg"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');

        $total_sql = " select *	from tbl_coupon_setting where state != 'C' $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;
        $data = [
            'pg' => $pg,
            'g_list_rows' => $g_list_rows,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'ca_idx' => $ca_idx,
            'nTotalCount' => $nTotalCount,
            'result' => $result,
            'num' => $num,
            'nPage' => $nPage
        ];
        return view('admin/_operator/coupon_setting', $data);
    }

    public function write() {
        
    }

    public function write_ok() {

    }
    public function delete() {
        
    }
    
}
