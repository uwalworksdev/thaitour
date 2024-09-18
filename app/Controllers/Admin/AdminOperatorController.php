<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminOperatorController extends BaseController
{

    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function coupon_setting()
    {
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

    public function coupon_setting_write()
    {
        $idx = updateSQ($_GET["idx"] ?? '');

        $row = null;
        if ($idx) {
            $total_sql = " select * from tbl_coupon_setting where idx='" . $idx . "'";
            $result = $this->connect->query($total_sql);
            $row = $result->getRowArray();
        }
        $data = [
            'row' => $row,
            'idx' => $idx
        ];
        return view('admin/_operator/coupon_setting_write', $data);
    }

    public function coupon_list()
    {
        $g_list_rows = 100;
        $strSql = '';
        $pg = updateSQ($_GET["pg"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');

        $total_sql = " select c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate, c.status, c.types, s.coupon_name, s.dc_type, s.coupon_pe, s.coupon_price
					from tbl_coupon c
					left outer join tbl_coupon_setting s
					  on c.coupon_type = s.idx
				   where 1=1 and c.status != 'C'  $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by c_idx desc limit $nFrom, $g_list_rows ";
        //echo $sql;
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
        return view('admin/_operator/coupon_list', $data);
    }

    public function coupon_write()
    {
        $idx = updateSQ($_GET["idx"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');

        $sql_c = " select *	from tbl_coupon_setting where state = 'Y' order by idx desc ";
        $result_c = $this->connect->query($sql_c);
        $result_c = $result_c->getResultArray();

        $data = [
            'idx' => $idx,
            'ca_idx' => $ca_idx,
            'result_c' => $result_c
        ];
        return view('admin/_operator/coupon_write', $data);
    }
}
