<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class TourStayController extends BaseController
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
        $data = $this->get_list_('');
        return view("admin/_tourRegist/list", $data);
    }

    private function get_list_($product_code_1)
    {


        $data = [];

        return $data;
    }

    public function write()
    {

        return view("admin/_tourRegist/write", );
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