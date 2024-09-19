<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminCodeBannerController extends BaseController
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
        $g_list_rows = 100;
        $pg = $_GET["pg"] ?? 1;
        $strSql = "";
        $s_parent_code_no = updateSQ($_GET["s_parent_code_no"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_category"] ?? '');
        if ($s_parent_code_no) {
            $strSql = $strSql . " and parent_code_no = '" . $s_parent_code_no . "' ";
        } else {
            $strSql = $strSql . " and parent_code_no = '13' ";
        }
        $total_sql = " select *	
						, (select ifnull(count(*),0) as cnt from tbl_code_banner where a.code_idx=tbl_code_banner.code_idx) as cnt
						, (select ufile1  from tbl_code_banner where a.code_idx=tbl_code_banner.code_idx order by onum desc limit 0, 1 ) as img
						from tbl_code a where 1=1 and code_gubun != 'bank' $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by onum desc, code_idx desc limit $nFrom, $g_list_rows ";
        write_log($sql);
        $result = $this->connect->query($sql);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

        $data = [
            'result' => $result,
            'num' => $num,
            'pg' => $pg,
            'nPage' => $nPage,
            's_parent_code_no' => $s_parent_code_no,
            'nTotalCount' => $nTotalCount,
            'g_list_rows' => $g_list_rows,
            'ca_idx' => $ca_idx,
            'search_category' => $search_category,
            'search_name' => $search_name,
        ];

        return view('admin/_codeBanner/list', $data);
    }


    public function write()
    {
        $code_idx = updateSQ($_GET["code_idx"] ?? '');
        $s_parent_code_no = updateSQ($_GET["s_parent_code_no"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');

        if ($s_parent_code_no == "")
        {
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

        $sql = "select * from tbl_code_banner where code_idx = '" . $code_idx . "' order by onum desc, cb_idx desc ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();

        $data = [
            'row' => $row,
            'row2' => $row2 ?? '',
            'result' => $result,
            's_parent_code_no' => $s_parent_code_no,
            'code_idx' => $code_idx,
            'parent_code_no' => $parent_code_no,
            'ca_idx' => $ca_idx
        ];

        return view('admin/_codeBanner/write', $data);
    }
}
