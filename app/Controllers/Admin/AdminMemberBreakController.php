<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminMemberBreakController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function list()
    {
        $g_list_rows = 10;
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');
        $s_parent_code_no = updateSQ($_GET["s_parent_code_no"] ?? '');
        $strSql = '';
        if ($search_name != "") {
            if ($search_category == "user_name") {
                $strSql = $strSql . " and (select user_name from tbl_member where tbl_member.m_idx=tbl_break_list.m_idx) like '%" . $search_name . "%' ";
            } else {
                $strSql = $strSql . " and " . $search_category . " like '%" . $search_name . "%' ";
            }
        }
        $total_sql = " select *	
						,(select user_name from tbl_member where tbl_member.m_idx=tbl_break_list.m_idx) as user_name
						from tbl_break_list where 1=1 $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by bl_idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

        $data = [
            'num' => $num,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'result' => $result,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'pg' => $pg,
            'g_list_rows' => $g_list_rows,
            'ca_idx' => $ca_idx,
            's_parent_code_no' => $s_parent_code_no
        ];
        return view('admin/_memberBreak/list', $data);
    }

    public function write()
    {
        $search_category	= updateSQ($_GET["search_category"] ?? '');
        $search_name		= updateSQ($_GET["search_name"]?? '');
        $pg					= updateSQ($_GET["pg"]?? '');
        $bl_idx				= updateSQ($_GET["bl_idx"]?? '');

        $total_sql = " select * from tbl_break_list where bl_idx='" . $bl_idx . "'";
        $result = $this->connect->query($total_sql);
        $row = $result->getRowArray();

        $data = [
            'row' => $row,
            'search_category' => $search_category,
            'search_name' => $search_name,
            'pg' => $pg,
            'bl_idx' => $bl_idx
        ];

        return view('admin/_memberBreak/write', $data);
    }
}
