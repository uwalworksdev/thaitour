<?php

namespace App\Controllers;

use Config\CustomConstants as ConfigCustomConstants;

class EventController extends BaseController
{
    private $ReviewModel;
    private $Bbs;
    public function __construct()
    {
        $this->db = db_connect();
        $this->ReviewModel = model("ReviewModel");
        $this->Bbs = model("Bbs");
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }
    public function event_list()
    {
        $page = $this->request->getVar('page');
        $total_cnt = $this->Bbs->List("event")->countAllResults();
        $scale = 9; // 목록에 표시되는 정보의 수
        $total_page = ceil($total_cnt / $scale);

        if ($page > $total_page)
            $page = $total_page;
        if ($page < 1)
            $page = 1;

        $start = ($page - 1) * $scale;
        $event_list = $this->Bbs->List("event")->orderBy("r_date", "desc")->limit($scale, $start)->get()->getResultArray();

        return view("event/event_list", [
            "event_list" => $event_list,
            "page" => $page,
            "total_page" => $total_page,
            "total_cnt" => $total_cnt,
            "scale" => $scale,
            "currentUri" => $this->request->getUri()->getPath(),
        ]);
    }
    public function event_view()
    {

        $code = $_GET['code'];
        $bbs_idx = $_GET['bbs_idx'];
        $this->Bbs->Hit("event", $bbs_idx);

        $event = $this->Bbs->View($bbs_idx);


        $sql_s = "
        select  a.*, b.onum, b.code_idx
                from tbl_product_mst a, tbl_event_disp b
                where a.product_idx    =  b.product_idx
                and b.code_no    = '" . $bbs_idx . "' 
                order by b.onum asc
        ";

        $related_products = $this->db->query($sql_s)->getResultArray();

        return view("event/event_view", [
            "event" => $event,
            "related_products" => $related_products,
            "currentUri" => $this->request->getUri()->getPath(),
        ]);
    }
    public function winning_list()
    {
        $g_list_rows = 10;
        $pg = $this->request->getVar("pg");

        $nTotalCount = $this->Bbs->List("winner")->countAllResults();
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "")
            $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;
        $winning_list = $this->Bbs->List("winner")
            ->orderBy("r_date", "desc")
            ->orderBy("notice_yn", "desc")
            ->orderBy("b_ref", "desc")
            ->orderBy("b_step", "asc")
            ->limit($g_list_rows, $nFrom)
            ->get()
            ->getResultArray();
        $num = $nTotalCount - $nFrom;

        return view("event/winning_list", [
            "winning_list" => $winning_list,
            "num" => $num,
            "pg" => $pg,
            "nPage" => $nPage,
            "nTotalCount" => $nTotalCount,
            "currentUri" => $this->request->getUri()->getPath(),
            "g_list_rows" => $g_list_rows
        ]);
    }
    public function event_delete()
    {
        $idx = $_POST['idx'];

        $db1 = $this->Bbs->delete($idx);
        if (!$db1) {
            return "NO";
        }
        return "OK";
    }

    public function travelInsurance()
    {
        return $this->renderView('travel-insurance/index');
    }
}
