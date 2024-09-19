<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminBbsBannerController extends BaseController
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
        $scategory = updateSQ($_GET['scategory'] ?? '');
        $search_mode  = updateSQ($_GET['search_mode'] ?? '');
        $search_word  = updateSQ($_GET['search_word'] ?? '');
        $search_category  = updateSQ($_GET['search_category'] ?? '');
        $search_name  = updateSQ($_GET['search_name'] ?? '');
        $ca_idx = updateSQ($_GET['ca_idx'] ?? '');
        $pg = updateSQ($_GET['pg'] ?? '');

        if ($scategory) {
            $sql = " select * from tbl_bbs_category where tbc_idx = '$scategory' ";
            $result = $this->connect->query($sql);
            $row = $result->getRowArray();
            $tit = "[" . $row['subject'] . "]";
        } else {
            $tit = "";
        }
        $strSql = '';
        $code = 'banner';
        $g_list_rows = 10;
        $strSql = $strSql . " and code = '$code' ";
        if ($scategory)
            $strSql = $strSql . " and category = '$scategory' ";
        $total_sql = " select *, (select subject from tbl_bbs_category 
												 where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as scategory, 
												 (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt  from tbl_bbs_list where 1=1 " . $strSql;

        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "")
            $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by onum desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

        $fsql = " select * from tbl_bbs_category where code='$code' and status = 'Y' order by onum asc";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $data = [
            'fresult' => $fresult,
            'result' => $result,
            'num' => $num,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => $pg,
            'scategory' => $scategory,
            'tit' => $tit,
            'code' => $code,
            'g_list_rows' => $g_list_rows,
            'ca_idx' => $ca_idx,
            'search_mode' => $search_mode,
            'search_word' => $search_word,
            'search_category' => $search_category,
            'search_name' => $search_name
        ];
        return view('admin/_bbsBanner/list', $data);
    }

    public function getBbsCategory($category)
    {
        $sql_cate = "select * from tbl_bbs_category where tbc_idx = '" . $category . "' ";
        $result_cate = $this->connect->query($sql_cate);
        $row_cate = $result_cate->getRowArray();
        return $row_cate;
    }
}
