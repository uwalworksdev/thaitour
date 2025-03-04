<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminInquiryController extends BaseController
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
        $search_name = !empty($_GET["search_name"]) ? $_GET['search_name'] : "";
        $search_category = !empty($_GET["search_category"]) ? $_GET['search_category'] : "";
        $strSql = "";
        $gubun = "";
        // $g_list_rows = 20;
        $g_list_rows = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 20;
        if ($search_name) {
            $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
        }
        $total_sql = " select *		
						from tbl_inquiry where 1=1 $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        };
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;

        $data = [
            'result' => $result,
            'num' => $num,
            'pg' => $pg,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'gubun' => $gubun,
            'g_list_rows' => $g_list_rows,
        ];
        return view('admin/_inquiry/list', $data);
    }

    public function write()
    {
        $search_mode = updateSQ($_GET['search_mode'] ?? '');
        $search_word = updateSQ($_GET['search_word'] ?? '');
        $scode = updateSQ($_GET['scode'] ?? '');
        $pg = updateSQ($_GET['pg'] ?? '');
        $idx = updateSQ($_GET['idx'] ?? '');
        $titleStr = "맞춤문의";
        $str_guide = "";
        $guide_e_date = "";

        $row = [];
        $result_mem = null;
        if ($idx) {
            $updateViewSql = "update tbl_inquiry set isViewInquiry = 'Y' where idx = '" . $idx . "'";
            $this->connect->query($updateViewSql);

            $total_sql = " select * from tbl_inquiry where idx='" . $idx . "'";
            $result = $this->connect->query($total_sql);
            $row = $result->getRowArray();

            $sql_mem = "select * from tbl_inquiry_companion where inquiry_idx = $idx";
            $result_mem = $this->connect->query($sql_mem);
            $result_mem = $result_mem->getResultArray();
        }

        $data = [
            'search_mode' => $search_mode,
            'search_word' => $search_word,
            'scode' => $scode,
            'pg' => $pg,
            'idx' => $idx,
            'titleStr' => $titleStr,
            'str_guide' => $str_guide,
            'guide_e_date' => $guide_e_date,
            'row' => $row,
            'result_mem' => $result_mem
        ];
        return view('admin/_inquiry/write', $data);
    }
}
