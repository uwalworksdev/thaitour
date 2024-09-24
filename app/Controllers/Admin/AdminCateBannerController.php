<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminCateBannerController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function list()
    {
        $pg = !empty($_GET["pg"]) ? $_GET['pg'] : "";
        $strSql = "";
        $g_list_rows = 100;
        $s_parent_code_no = updateSQ($_GET["s_parent_code_no"] ?? '');
        if ($s_parent_code_no) {
            $strSql = $strSql . " and parent_code_no = '" . $s_parent_code_no . "' ";
        } else {
            $strSql = $strSql . " and parent_code_no = '13' ";
        }
        $total_sql = " select *	
						, (select ifnull(count(*),0) as cnt from tbl_cate_banner where a.code_idx=tbl_cate_banner.code_idx) as cnt
						, (select ufile1  from tbl_cate_banner where a.code_idx=tbl_cate_banner.code_idx order by onum asc limit 0, 1 ) as img
						from tbl_code a where 1=1 and code_gubun != 'bank' $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by onum desc, code_idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

        $data = [
            'result' => $result,
            'num' => $num,
            'pg' => $pg,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            's_parent_code_no' => $s_parent_code_no,
            'g_list_rows' => $g_list_rows,
            'ca_idx' => $ca_idx ?? '',
            'search_category' => $search_category ?? '',
            'search_name' => $search_name ?? '',
        ];

        return view('admin/_cateBanner/list', $data);
    }

    public function write()
    {
        $code_idx = updateSQ($_GET["code_idx"] ?? '');
        $s_parent_code_no = updateSQ($_GET["s_parent_code_no"] ?? '');
        $parent_code_no = updateSQ($_GET["parent_code_no"] ?? '');

        if ($s_parent_code_no == "") {
            $parent_code_no = "0";
        } else {
            $parent_code_no = $s_parent_code_no;
        }

        if ($code_idx) {
            $total_sql = " select * from tbl_code where code_idx='" . $code_idx . "'";
            $result = $this->connect->query($total_sql);
            $row = $result->getRowArray();
        } else {
            $total_sql = "select * from tbl_code where code_no='" . $parent_code_no . "'";
            $result = $this->connect->query($total_sql);
            $row = $result->getRowArray();

            $total_sql = " select ifnull(max(code_no),'" . $s_parent_code_no . "00')+1 as code_no from tbl_code where parent_code_no='" . $parent_code_no . "'";
            $result = $this->connect->query($total_sql);
            $row2 = $result->getRowArray();
        }

        $sql = "select * from tbl_cate_banner where code_idx = '" . $code_idx . "' order by onum desc, cb_idx desc ";
        $result = $this->connect->query($sql);
        $row3 = $result->getResultArray();

        $data = [
            'row' => $row,
            'row2' => $row2 ?? '',
            'row3' => $row3,
            's_parent_code_no' => $s_parent_code_no,
            'parent_code_no' => $parent_code_no,
            'code_idx' => $code_idx ?? '',
            'ca_idx' => $ca_idx ?? '',
            'search_category' => $search_category ?? '',
            'search_name' => $search_name ?? '',
        ];

        return view('admin/_cateBanner/write', $data);
    }
}
