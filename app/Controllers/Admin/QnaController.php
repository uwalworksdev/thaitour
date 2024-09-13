<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SessionChk;

class QnaController extends BaseController
{
    private $qna;
    private $code;
    private $db;

    protected $sessionLib;
    protected $sessionChk;

    public function __construct()
    {
        $this->code = model("Code");
        $this->qna = model("Qna");
        helper(['html']);
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('comment_helper');
    }

    public function list()
    {
        $private_key = private_key();
        $deviceType = get_device();
        $currentUri = $this->request->getUri()->getPath();
        $page = $this->request->getVar('page');
        $search_category = $this->request->getVar('search_category');
        $s_txt = $this->request->getVar('s_txt');
        $strSql = "";
        if ($s_txt and ($search_category == "user_name" || $search_category == "user_phone" || $search_category == "user_email")) {
            $strSql = $strSql . " and replace(CONVERT( AES_DECRYPT( UNHEX( FROM_BASE64(" . $search_category . ") ), '" . $private_key . "') using UTF8),'-','') like '%" . str_replace("-", "", $s_txt) . "%' ";
        }
        if ($s_txt and ($search_category == "title")) {
            $strSql = $strSql . " and $search_category like '%" . str_replace("-", "", $s_txt) . "%' ";
        }

        if (!$page) {
            $page = 1;
        }

        $scale = 10;

        $total_sql = " select * from tbl_travel_qna where 1=1 $strSql ";
        $total_cnt = $this->db->query($total_sql)->getNumRows();

        $total_page = ceil($total_cnt / $scale);
        if ($page == "")
            $page = 1;
        $start = ($page - 1) * $scale;

        $total_sqls = "  SELECT A.*, COUNT(B.r_idx) AS cmt_cnt
                                FROM tbl_travel_qna A
                                LEFT JOIN tbl_bbs_cmt B ON A.idx = B.r_idx AND B.r_code = 'qna' AND B.r_status = 'Y' AND B.r_delYN = 'N'
                                WHERE 1=1 $strSql
                                GROUP BY A.idx ";

        $sql    = $total_sqls . " order by idx desc limit $start, $scale ";

        $result = $this->db->query($sql)->getResultArray();
        $num = $total_cnt - $start;
        return view("admin/_qna/list", [
            'list_qna' => $result,
            'num' => $num,
            'pg' => $page,
            'nPage' => $total_page,
            'scale' => $scale,
            'search_category' => $search_category,
            'search_gubun' => '',
            's_txt' => $s_txt,
            'deviceType' => $deviceType,
            'total_cnt' => $total_cnt,
            'currentUri' => $currentUri
        ]);
    }
}
