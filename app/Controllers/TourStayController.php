<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class TourStayController extends BaseController
{
    private $model;
    private $Bbs;
    private $tours;
    private $db;

    protected $connect;

    public function __construct()
    {
        $this->db = db_connect();
        $this->connect = Config::connect();
        $this->model = model("ReviewModel");
        $this->Bbs = model("Bbs");
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function list()
    {
        $data = $this->get_list_('');
        return view("admin/_tourStay/list", $data);
    }

    private function get_list_($product_code_1)
    {
        $s_country_code_1 = updateSQ($_GET["s_country_code_1"] ?? '');
        $s_country_code_2 = updateSQ($_GET["s_country_code_2"] ?? '');
        $s_country_code_3 = updateSQ($_GET["s_country_code_3"] ?? '');
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? "");
        if ($pg == "") $pg = 1;
        $search_name = updateSQ($_GET["search_name"] ?? "");
        $search_category = updateSQ($_GET["search_category"] ?? "");

        $product_code_2 = updateSQ($_GET["product_code_2"] ?? "");
        $product_code = updateSQ($_GET["product_code"] ?? "");
        $product_code_3 = updateSQ($_GET["product_code_3"] ?? "");
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? "");
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? "");
        $s_product_code_3 = updateSQ($_GET["s_product_code_3"] ?? "");
        $date_chker = updateSQ($_GET["date_chker"] ?? "");
        $s_date = updateSQ($_GET["s_date"] ?? "");
        $e_date = updateSQ($_GET["e_date"] ?? "");
        $s_time = updateSQ($_GET["s_time"] ?? "");
        $e_time = updateSQ($_GET["e_time"] ?? "");
        $is_view_y = $_GET["is_view_y"] ?? "";
        $is_view_n = $_GET["is_view_n"] ?? "";
        $best = $_GET["best"] ?? "";
        $orderBy = $_GET["orderBy"] ?? "";
        if ($orderBy == "") $orderBy = 1;

        $search_val = "?product_code_1=" . $product_code_1;
        $search_val .= "&product_code=" . $product_code;
        $search_val .= "&product_code_2=" . $product_code_2;
        $search_val .= "&product_code_3=" . $product_code_3;
        $search_val .= "&is_view_y=" . $is_view_y;
        $search_val .= "&is_view_n=" . $is_view_n;
        $search_val .= "&best=" . $best;
        $search_val .= "&s_date=" . $s_date;
        $search_val .= "&e_date=" . $e_date;
        $search_val .= "&s_time=" . $s_time;
        $search_val .= "&e_time=" . $e_time;
        $search_val .= "&search_category=" . $search_category;
        $search_val .= "&search_name=" . $search_name;
        $search_val .= "&orderBy=" . $orderBy;

        $strSql = "";

        if ($search_name) {
            $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
        }
        if ($s_country_code_1) {
            $strSql = $strSql . " and country_code_1 = '" . $s_country_code_1 . "' ";
        }
        if ($s_country_code_2) {
            $strSql = $strSql . " and country_code_2 = '" . $s_country_code_2 . "' ";
        }
        if ($s_country_code_3) {
            $strSql = $strSql . " and country_code_3 = '" . $s_country_code_3 . "' ";
        }
        $total_sql = " select *
						, (select code_name from tbl_code where code_gubun = 'stay' and depth='2' and tbl_code.code_no=tbl_product_stay.stay_code) as stay_gubun
						, (select code_name from tbl_code where code_gubun = 'country' and depth='2' and tbl_code.code_no=tbl_product_stay.country_code_1) as country_name_1
						, (select code_name from tbl_code where code_gubun = 'country' and depth='3' and tbl_code.code_no=tbl_product_stay.country_code_2) as country_name_2
						from tbl_product_stay where 1=1 $strSql ";
        $result = $this->connect->query($total_sql) or die ($this->connect->error);
        $nTotalCount = $result->getNumRows();

        $fsql = "select * from tbl_code where code_gubun='country' and depth='2' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult = $fresult->getResultArray();

        $fsql2 = "select * from tbl_code where code_gubun='country' and depth='3' and parent_code_no='" . $s_country_code_1 . "' order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql2) or die ($this->connect->error);
        $fresult2 = $fresult2->getResultArray();


        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by onum desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql) or die ($this->connect->error);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

        $data = [
            "fresult" => $fresult,
            "fresult2" => $fresult2,
            "num" => $num,
            "nPage" => $nPage,
            "pg" => $pg,
            "s_country_code_1" => $s_country_code_1,
            "s_country_code_2" => $s_country_code_2,
            "s_country_code_3" => $s_country_code_3,
            "g_list_rows" => $g_list_rows,
            "search_val" => $search_val,
            "nTotalCount" => $nTotalCount,
            "result" => $result,
            "orderBy" => $orderBy,
            "best" => $best,
            "is_view_n" => $is_view_n,
            "search_name" => $search_name,
            "product_code_1" => $product_code_1,
            "product_code_2" => $product_code_2,
            "product_code_3" => $product_code_3,
            "s_product_code_1" => $s_product_code_1,
            "s_product_code_2" => $s_product_code_2,
            "s_product_code_3" => $s_product_code_3,
            "is_view_y" => $is_view_y,
            "search_category" => $search_category,
        ];

        return $data;
    }

    public function write()
    {
        $data = $this->getWrite();
        return view("admin/_tourStay/write", $data);
    }

    private function getWrite()
    {
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $product_code_1 = "1324";
        $product_code_2 = updateSQ($_GET["product_code_2"] ?? "");
        $product_code = updateSQ($_GET["product_code"] ?? "");
        $product_code_3 = updateSQ($_GET["product_code_3"] ?? "");
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? "");
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? "");
        $s_product_code_3 = updateSQ($_GET["s_product_code_3"] ?? "");

        $onum = 0;

        $stay_idx = updateSQ($_GET["stay_idx"] ?? '');

        $s_country_code_1 = updateSQ($_GET["s_country_code_1"] ?? '');
        $s_country_code_2 = updateSQ($_GET["s_country_code_2"] ?? '');
        $s_country_code_3 = updateSQ($_GET["s_country_code_3"] ?? '');

        $titleStr = "숙소정보 생성";
        $row = [];
        if ($stay_idx) {
            $total_sql = " select * from tbl_product_stay where stay_idx='" . $stay_idx . "'";
            $result = $this->connect->query($total_sql) or die ($this->connect->error);
            $row = $result->getResultArray()[0];

            $agency_name = '';
            $stay_idx = $row["stay_idx"];
            $code_no = $row["code_no"];
            $country_code_1 = $row["country_code_1"];
            $country_code_2 = $row["country_code_2"];
            $country_code_3 = $row["country_code_3"];
            $stay_code = $row["stay_code"];
            $stay_city = $row["stay_city"];
            $stay_user_name = $row["stay_user_name"];
            $stay_address = $row["stay_address"];
            $stay_name_eng = $row["stay_name_eng"];
            $stay_name_kor = $row["stay_name_kor"];
            $stay_internet = $row["stay_internet"];
            $stay_level = $row["stay_level"];
            $stay_check_in = $row["stay_check_in"];
            $stay_check_in_ampm = $row["stay_check_in_ampm"];
            $stay_check_in_hour = $row["stay_check_in_hour"];
            $stay_check_in_min = $row["stay_check_in_min"];

            $stay_check_out = $row["stay_check_out"];
            $stay_check_out_ampm = $row["stay_check_out_ampm"];
            $stay_check_out_hour = $row["stay_check_out_hour"];
            $stay_check_out_min = $row["stay_check_out_min"];

            $stay_service = $row["stay_service"];
            $stay_parking = $row["stay_parking"];
            $stay_room = $row["stay_room"];
            $stay_homepage = $row["stay_homepage"];
            $stay_contents = $row["stay_contents"];
            $ufile1 = $row["ufile1"];
            $rfile1 = $row["rfile1"];

            $ufile2 = $row["ufile2"];
            $rfile2 = $row["rfile2"];

            $ufile3 = $row["ufile3"];
            $rfile3 = $row["rfile3"];

            $ufile4 = $row["ufile4"];
            $rfile4 = $row["rfile4"];

            $ufile5 = $row["ufile5"];
            $rfile5 = $row["rfile5"];

            $tel_no = $row["tel_no"];
            $mobile_no = $row["mobile_no"];

            $facilities = $row["facilities"];
            $room_facil = $row["room_facil"];

            $note = $row["note"];

            $stay_onum = $row["stay_onum"];
            $stay_m_date = $row["stay_m_date"];
            $stay_r_date = $row["stay_r_date"];

            $titleStr = "숙소정보 수정";
        }

        $pq = $country_code_1 ?? '';

        $fsql = "select * from tbl_code where code_gubun='Room facil' and depth='2' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='country' and depth='3' and parent_code_no='" . $pq . "' order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='stay' and depth='2' order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult3 = $fresult3->getResultArray();

        $sql_f = "select * from tbl_code where parent_code_no = '24' and depth = '2' and status = 'Y' order by onum desc ";
        $result_f = $this->connect->query($sql_f) or die ($this->connect->error);
        $fresult4 = $result_f->getResultArray();

        $data = [
            "row" => $row,
            "fresult" => $fresult,
            "fresult2" => $fresult2,
            "fresult3" => $fresult3,
            "fresult4" => $fresult4,
            "titleStr" => $titleStr,
            "stay_idx" => $stay_idx ?? '',
            "agency_name" => $agency_name ?? '',
            "s_country_code_1" => $s_country_code_1 ?? '',
            "s_country_code_2" => $s_country_code_2 ?? '',
            "s_country_code_3" => $s_country_code_3 ?? '',
            "product_code_4" => $product_code_4 ?? '',
            "product_code_name_1" => $product_code_name_1 ?? '',
            "product_code_name_2" => $product_code_name_2 ?? '',
            "product_code_name_3" => $product_code_name_3 ?? '',
            "product_code_name_4" => $product_code_name_4 ?? '',
            "min_price" => $min_price ?? '',
            "max_price" => $max_price ?? '',
            "ufile1" => $ufile1 ?? '',
            "rfile1" => $rfile1 ?? '',
            "ufile2" => $ufile2 ?? '',
            "rfile2" => $rfile2 ?? '',
            "ufile3" => $ufile3 ?? '',
            "rfile3" => $rfile3 ?? '',
            "ufile4" => $ufile4 ?? '',
            "rfile4" => $rfile4 ?? '',
            "ufile5" => $ufile5 ?? '',
            "rfile5" => $rfile5 ?? '',
            "ufile6" => $ufile6 ?? '',
            "rfile6" => $rfile6 ?? '',
            "ufile7" => $ufile7 ?? '',
            "rfile7" => $rfile7 ?? '',
            "ufile18" => $ufile18 ?? '',
            "rfile18" => $rfile18 ?? '',
            "product_name" => $product_name ?? '',
            "product_air" => $product_air ?? '',
            "product_info" => $product_info ?? '',
            "product_schedule" => $product_schedule ?? '',
            "product_country" => $product_country ?? '',
            "is_view" => $is_view ?? '',
            "product_period" => $product_period ?? '',
            "product_manager" => $product_manager ?? '',
            "product_manager_2" => $product_manager_2 ?? '',
            "original_price" => $original_price ?? '',
            "keyword" => $keyword ?? '',
            "product_price" => $product_price ?? '',
            "product_best" => $product_best ?? '',
            "onum" => $onum ?? '',
            "product_contents" => $product_contents ?? '',
            "product_confirm" => $product_confirm ?? '',
            "product_confirm_m" => $product_confirm_m ?? '',
            "product_able" => $product_able ?? '',
            "product_unable" => $product_unable ?? '',
            "mobile_able" => $mobile_able ?? '',
            "mobile_unable" => $mobile_unable ?? '',
            "special_benefit" => $special_benefit ?? '',
            "special_benefit_m" => $special_benefit_m ?? '',
            "notice_comment" => $notice_comment ?? '',
            "notice_comment_m" => $notice_comment_m ?? '',
            "etc_comment" => $etc_comment ?? '',
            "etc_comment_m" => $etc_comment_m ?? '',
            "tour_info" => $tour_info ?? '',
            "tour_detail" => $tour_detail ?? '',
            "benefit" => $benefit ?? '',
            "local_info" => $local_info ?? '',
            "phone" => $phone ?? '',
            "email" => $email ?? '',
            "phone_2" => $phone_2 ?? '',
            "email_2" => $email_2 ?? '',
            "product_route" => $product_route ?? '',
            "minium_people_cnt" => $minium_people_cnt ?? '',
            "total_people_cnt" => $total_people_cnt ?? '',
            "stay_list" => $stay_list ?? '',
            "country_list" => $country_list ?? '',
            "active_list" => $active_list ?? '',
            "sight_list" => $sight_list ?? '',
            "tour_period" => $tour_period ?? '',
            "product_mileage" => $product_mileage ?? '',
            "exchange" => $exchange ?? '',
            "jetlag" => $jetlag ?? '',
            "capital_city" => $capital_city ?? '',
            "information" => $information ?? '',
            "meeting_guide" => $meeting_guide ?? '',
            "meeting_place" => $meeting_place ?? '',
            "product_option" => $product_option ?? '',
            "coupon_y" => $coupon_y ?? '',
            "product_manager_id" => $product_manager_id ?? '',
            "m_date" => $m_date ?? '',
            "r_date" => $r_date ?? '',
            "pg" => updateSQ($_GET["pg"] ?? ''),
            "search_name" => updateSQ($_GET["search_name"] ?? ''),
            "search_category" => updateSQ($_GET["search_category"] ?? ''),
            "product_code_2" => updateSQ($_GET["product_code_2"] ?? ''),
            "product_code" => updateSQ($_GET["product_code"] ?? ''),
            "product_code_3" => updateSQ($_GET["product_code_3"] ?? ''),
            "s_product_code_1" => updateSQ($_GET["s_product_code_1"] ?? ''),
            "s_product_code_2" => updateSQ($_GET["s_product_code_2"] ?? ''),
            "s_product_code_3" => updateSQ($_GET["s_product_code_3"] ?? ''),
            "tel_no" => $tel_no ?? '',
            "mobile_no" => $mobile_no ?? '',
            "facilities" => $facilities ?? '',
            "room_facil" => $room_facil ?? '',
            "note" => $note ?? '',
            "stay_onum" => $stay_onum ?? '',
            "stay_m_date" => $stay_m_date ?? '',
            "stay_r_date" => $stay_r_date ?? '',
            "code_no" => $code_no ?? '',
            "country_code_1" => $country_code_1 ?? '',
            "country_code_2" => $country_code_2 ?? '',
            "country_code_3" => $country_code_3 ?? '',
            "stay_code" => $stay_code ?? '',
            "stay_city" => $stay_city ?? '',
            "stay_user_name" => $stay_user_name ?? '',
            "stay_address" => $stay_address ?? '',
            "stay_name_eng" => $stay_name_eng ?? '',
            "stay_name_kor" => $stay_name_kor ?? '',
            "stay_internet" => $stay_internet ?? '',
            "stay_level" => $stay_level ?? '',
            "stay_check_in" => $stay_check_in ?? '',
            "stay_check_in_ampm" => $stay_check_in_ampm ?? '',
            "stay_check_in_hour" => $stay_check_in_hour ?? '',
            "stay_check_in_min" => $stay_check_in_min ?? '',
            "stay_check_out" => $stay_check_out ?? '',
            "stay_check_out_ampm" => $stay_check_out_ampm ?? '',
            "stay_check_out_hour" => $stay_check_out_hour ?? '',
            "stay_check_out_min" => $stay_check_out_min ?? '',
            "stay_service" => $stay_service ?? '',
            "stay_parking" => $stay_parking ?? '',
            "stay_room" => $stay_room ?? '',
            "stay_homepage" => $stay_homepage ?? '',
            "stay_contents" => $stay_contents ?? '',
        ];

        return $data;
    }


    public function get_yoil($product_idx)
    {
        $db = $this->connect;

        $fsql = "SELECT * FROM tbl_product_yoil WHERE product_idx = ? AND depth = '1' ORDER BY r_date DESC";
        $fresult4 = $db->query($fsql, [$product_idx])->getResultArray();

        $html = '<tbody>';

        $i = 1;
        foreach ($fresult4

                 as $frow) {
            $yoilStr = $this->getYoilString($frow);

            $fsql2 = "SELECT a.*, b.* 
                      FROM tbl_product_air a 
                      LEFT JOIN tbl_code b ON a.air_code_1 = b.code_no 
                      LEFT JOIN tbl_code c ON a.air_code_2 = c.code_no 
                      WHERE b.code_gubun = 'air' 
                      AND product_idx = ? 
                      AND yoil_idx = ? 
                      ORDER BY air_idx ASC";
            $fresult2 = $db->query($fsql2, [$product_idx, $frow['yoil_idx']])->getResultArray();

            $i++;
            $html .= "<tr style='height:50px'>
                        <td>{$i}</td>
                        <td class='tac'>{$frow['s_date']}</td>
                        <td class='tac'>{$frow['e_date']}</td>
                        <td class='tac'>
                            <table cellpadding='0' cellspacing='0' class='listTable' style='width:100%' align=center>
                                <colgroup>
                                    <col width='10%'/><col width='10%'/><col width='10%'/><col width='20%'/>
                                    <col width='10%'/><col width='10%'/><col width='10%'/><col width='10%'/><col width='10%'/>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>항공사</th>
                                        <th>항공편</th>
                                        <th>출발시간</th>
                                        <th>도착시간</th>
                                        <th>비행시간</th>
                                        <th>성인가격</th>
                                        <th>아동가격</th>
                                        <th>유아가격</th>
                                        <th>유류할증료</th>
                                    </tr>";
            foreach ($fresult2 as $frow2) {

//                var_dump($frow2);
//                die();
                $html .= "<tr style='height:40px'>
                            <td>{$frow2['code_name']}</td>
                            <td>{$frow2['air_name_1']}</td>
                            <td>{$frow2['s_air_port_1']} {$frow2['s_air_time_1']}</td>
                            <td>{$frow2['e_air_port_1']} {$frow2['e_air_time_1']}</td>
                            <td>{$frow2['fly_time_1']}</td>
                            <td rowspan='2'>" . number_format($frow2['tour_price'], 0) . "원</td>
                            <td rowspan='2'>" . number_format($frow2['tour_price_kids'], 0) . "원</td>
                            <td rowspan='2'>" . number_format($frow2['tour_price_baby'], 0) . "원</td>
                            <td rowspan='2'>" . number_format($frow2['oil_price'], 0) . "원</td>
                          </tr>";
            }
            $html .= "</thead></table></td><td class='tac'>";

            $sale = '';
            $product_code_1 = '';
            $s_product_code_1 = '';
            $s_product_code_2 = '';
            $s_product_code_3 = '';
            $search_name = '';
            $search_category = '';
            $pg = '';
            $back_url = '';

            if ($product_code_1 == "1301") {
                $html .= getYoil($frow["s_date"]);
            } else {
                $html .= $yoilStr;
            };

            if ($sale == "N") {
                $html .= "<span style='font-weight:bold;color:red;'><br>[예약마감]</span>";
            };


            $html .= "</td><td class='tac'>";

            $html .= $frow["r_date"];
            $html .= "</td><td class='tacTourStayController'>
                 <a href='" . "../_tourPrice/write?s_product_code_1=" . $s_product_code_1 .
                "&s_product_code_2=" . $s_product_code_2 .
                "&s_product_code_2=" . $s_product_code_3 .
                "&search_name=" . $search_name .
                "&search_category=" . $search_category .
                "&pg=" . $pg .
                "&product_idx=" . $product_idx .
                "&back_url=" . $back_url .
                "&yoil_idx=" . $frow["yoil_idx"] .
                "' class='btn btn-default'>수정하기</a>";
            $html .= "<a href='javascript:del_yoil(" . $frow["yoil_idx"] . ");' class='btn btn -default'>삭제하기</a>";
            $html .= "</td></tr>";
        }

        $html .= ' </tbody > ';

        return $html;
    }


    private function getYoilString($frow)
    {
        $yoilStr = "";
        if ($frow["yoil_0"] == "Y") $yoilStr .= "일, ";
        if ($frow["yoil_1"] == "Y") $yoilStr .= "월, ";
        if ($frow["yoil_2"] == "Y") $yoilStr .= "화, ";
        if ($frow["yoil_3"] == "Y") $yoilStr .= "수, ";
        if ($frow["yoil_4"] == "Y") $yoilStr .= "목, ";
        if ($frow["yoil_5"] == "Y") $yoilStr .= "금, ";
        if ($frow["yoil_6"] == "Y") $yoilStr .= "토, ";
        return rtrim($yoilStr, ", ");
    }
}