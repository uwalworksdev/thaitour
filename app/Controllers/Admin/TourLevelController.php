<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class TourLevelController extends BaseController
{
    private $tourRegistModel;
    private $Bbs;
    private $tours;
    private $db;

    protected $connect;

    public function __construct()
    {
        $this->db = db_connect();
        $this->connect = Config::connect();
        $this->tourRegistModel = model("ReviewModel");
        $this->Bbs = model("Bbs");
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function list()
    {
        $g_list_rows = 10;
        $s_country_code_1 = updateSQ($_GET["s_country_code_1"] ?? '');
        $s_country_code_2 = updateSQ($_GET["s_country_code_2"] ?? '');
        $s_country_code_3 = updateSQ($_GET["s_country_code_3"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $strSql = '';

        if ($search_name) {
            $strSql = $strSql . " and level_name like '%" . str_replace("-", "", $search_name) . "%' ";
        }

        $total_sql = " select * from tbl_product_level where 1=1 $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;

        $data = [
            "pg" => $pg,
            "g_list_rows" => $g_list_rows,
            "search_name" => $search_name,
            "nTotalCount" => $nTotalCount,
            "nPage" => $nPage,
            "num" => $num,
            "result" => $result,
            "s_country_code_1" => $s_country_code_1,
            "s_country_code_2" => $s_country_code_2,
            "s_country_code_3" => $s_country_code_3,
            "search_category" => $search_category
        ];
        return view('admin/_tourLevel/list', $data);
    }

    public function write()
    {
        $onum = 0;
        $idx = updateSQ($_GET["idx"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');

        $titleStr = "상품등급정보 생성";
        if ($idx) {
            $total_sql = " select * from tbl_product_level where idx='" . $idx . "'";
            $result = $this->connect->query($total_sql);
//            $row = $result->getResultArray()[0];
            $row = $result->getRowArray();

            $level_name = $row["level_name"];
            $status = $row["status"];
            $r_date = $row["r_date"];

            $titleStr = "상품등급정보 수정";
        }

        $data = [
            "idx" => $idx,
            "pg" => $pg,
            "onum" => $onum,
            "search_name" => $search_name,
            "titleStr" => $titleStr,
            "level_name" => $level_name ?? '',
            "status" => $status ?? '',
            "r_date" => $r_date ?? '',
            "row" => $row ?? [],
        ];

        return view('admin/_tourLevel/write', $data);
    }
}
