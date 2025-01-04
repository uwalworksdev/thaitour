<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class TourRegistController extends BaseController
{
    private $tourRegistModel;
    private $Bbs;
    private $tours;
    private $db;
    private $golfOptionModel;
    protected $connect;
    protected $productModel;
    protected $golfInfoModel;
    protected $golfVehicleModel;
    protected $moptionModel;
    protected $optionTourModel;
    protected $tourProducts;
    protected $infoProducts;
    protected $codeModel;
    private $memberModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->connect = Config::connect();
        $this->tourRegistModel = model("ReviewModel");
        $this->Bbs = model("Bbs");
        $this->golfOptionModel = model("GolfOptionModel");
        $this->productModel = model("ProductModel");
        $this->golfInfoModel = model("GolfInfoModel");
        $this->golfVehicleModel = model("GolfVehicleModel");
        $this->moptionModel = model("MoptionModel");
        $this->optionTourModel = model("OptionTourModel");
        $this->tourProducts = model("ProductTourModel");
        $this->infoProducts = model("TourInfoModel");
        $this->codeModel = model("Code");
        $this->memberModel = new \App\Models\Member();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    }

    public function list_hotel()
    {
        $data = $this->get_list_('1303', '', '', '', '');
        return view("admin/_tourRegist/list", $data);
    }

    public function list_all()
    {
        $data = $this->get_list_('', '', '', '', '');
        return view("admin/_tourRegist/list_all", $data);
    }

    public function list_honeymoon()
    {
        $data = $this->get_list_('1320', '', '', '', '');
        return view("admin/_tourRegist/list_honeymoon", $data);
    }

    public function list_spas()
    {
        $data = $this->get_list_('1317', '1325', '1320', '', '');
        return view("admin/_tourRegist/list_spas", $data);
    }

    public function list_tours()
    {
        $data = $this->get_list_('1301', '', '', '', '');
        return view("admin/_tourRegist/list_tours", $data);
    }

    public function list_golfs()
    {
        $data = $this->get_list_('1302', '', '', '', '');
        return view("admin/_tourRegist/list_golfs", $data);
    }

    private function get_list_($hotel_code, $spa_code, $tour_code, $golf_code, $stay_code)
    {

        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? "");
        if ($pg == "") $pg = 1;
        $search_name = updateSQ($_GET["search_name"] ?? "");
        $search_category = updateSQ($_GET["search_category"] ?? "");

        $product_code_1 = updateSQ($_GET["product_code_1"] ?? "");
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

        if ($is_view_y == "Y") {
            $strSql = $strSql . " and is_view = 'Y' ";
        }

        if ($is_view_n == "Y") {
            $strSql = $strSql . " and is_view = 'N' ";
        }

        if ($best == "Y") {
            $strSql = $strSql . " and product_best = 'Y' ";
        }

        if ($search_name) {
            $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
        }

        $strSql = $strSql . " and (product_code_1 = '$hotel_code' 
                      or product_code_1 = '$spa_code' 
                      or product_code_1 = '$tour_code' 
                      or product_code_1 = '$golf_code' 
                      or product_code_1 = '$stay_code') ";

        if ($product_code_1) {
            $strSql = $strSql . " and product_code_1 = '" . $product_code_1 . "' ";
        }
        if ($product_code_2) {
            $strSql = $strSql . " and product_code_2 = '" . $product_code_2 . "' ";
        }
        if ($product_code_3) {
            $strSql = $strSql . " and product_code_3 = '" . $product_code_3 . "' ";
        }

        $total_sql = " 
					SELECT p1.*, c1.code_name AS product_code_name_1, c2.code_name AS product_code_name_2 FROM tbl_product_mst AS p1 
						LEFT JOIN tbl_code AS c1 ON p1.product_code_1 = c1.code_no
						LEFT JOIN tbl_code AS c2 ON c2.code_no = p1.product_code_2  where 1=1 and p1.product_status != 'D' $strSql group by p1.product_idx ";


        $result = $this->connect->query($total_sql) or die ($this->connect->error);
        $nTotalCount = $result->getNumRows();

        $fsql = "select * from tbl_code where depth='2' and code_no = '" . $s_product_code_1 . "' and status='Y' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where depth='3' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where depth='4' and parent_code_no='" . $product_code_3 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult3 = $fresult3->getResultArray();

        $order = " onum desc ";
        if ($orderBy == "1") $order = " onum desc ";
        if ($orderBy == "2") $order = " r_date desc ";
        if ($orderBy == "3") {
            $order = " deposit_cnt desc ";
        }

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by $order limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql) or die ($this->connect->error);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

        $data = [
            "fresult" => $fresult,
            "fresult2" => $fresult2,
            "fresult3" => $fresult3,
            "num" => $num,
            "nPage" => $nPage,
            "pg" => $pg,
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

    public function write_all()
    {
        $data = $this->getWrite();
        return view("admin/_tourRegist/write_all", $data);
    }

    public function write_honeymoon()
    {
        $data = $this->getWrite();
        return view("admin/_tourRegist/write_honeymoon", $data);
    }

    public function write_golf()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $data = $this->getWrite('', '', '', '1302', '', "G");
        $db = $this->connect;

        $sql_c = " select * from tbl_code where parent_code_no = '26' and depth = '2' and status != 'N' order by onum desc ";
        $result_c = $db->query($sql_c) or die ($db->error);
        $fresult_c = $result_c->getResultArray();

        $options = $this->golfOptionModel->getOptions($product_idx);

        $vehicles = $this->golfVehicleModel->getByParentAndDepth(0, 1)->getResultArray();

        $sql = "SELECT * FROM tbl_product_mst WHERE product_idx = '" . $product_idx . "' ";
        $query = $db->query($sql);
        $product = $query->getRowArray();

        $sql = "SELECT COUNT(*) as cnt FROM tbl_product_tours WHERE product_idx = ?";
        $query = $db->query($sql, [$product_idx]);
        $result = $query->getRowArray();
        $data['tourCount'] = $result['cnt'];

        $sql = "SELECT * FROM tbl_product_tours WHERE product_idx = ? ORDER BY tours_idx ASC";
        $query = $db->query($sql, [$product_idx]);
        $data['tours'] = $query->getResultArray();

        $sql = "SELECT IFNULL(total_day, 0) as cnt FROM tbl_product_day_detail WHERE air_code = '0000' AND product_idx = ?";
        $query = $db->query($sql, [$product_idx]);
        $data['dayDetails'] = $query->getResultArray();

        $filters = $this->codeModel->getByParentAndDepth(45, 2)->getResultArray();

        foreach ($filters as $key => $filter) {
            $filters[$key]['children'] = $this->codeModel->getByParentAndDepth($filter['code_no'], 3)->getResultArray();
            if ($filter['code_no'] == 4501) $filters[$key]['filter_name'] = "green_peas";
            if ($filter['code_no'] == 4502) $filters[$key]['filter_name'] = "sports_days";
            if ($filter['code_no'] == 4503) $filters[$key]['filter_name'] = "slots";
            if ($filter['code_no'] == 4504) $filters[$key]['filter_name'] = "golf_course_odd_numbers";
            if ($filter['code_no'] == 4505) $filters[$key]['filter_name'] = "travel_times";
            if ($filter['code_no'] == 4506) $filters[$key]['filter_name'] = "carts";
            if ($filter['code_no'] == 4507) $filters[$key]['filter_name'] = "facilities";
        }

        $mcodes = $this->codeModel->getByParentCode('56')->getResultArray();

        $new_data = [
            'product_idx' => $product_idx,
            'product' => $product,
            'codes' => $fresult_c,
            'options' => $options,
            "golf_info" => $this->golfInfoModel->getGolfInfo($product_idx),
            'vehicles' => $vehicles,
            'filters' => $filters,
            'mcodes' => $mcodes,
        ];

        $data = array_merge($data, $new_data);

        return view("admin/_tourRegist/write_golf", $data);
    }

    public function write_golf_ok($product_idx = null)
    {
        $data = $this->request->getPost();
        //print_r($data); exit;
        $data['mbti'] = $_POST["mbti"] ?? '';

        $data['is_best_value'] = $data['is_best_value'] ?? "N";
        $data['special_price'] = $data['special_price'] ?? "N";
        $data['md_recommendation_yn'] = $data['md_recommendation_yn'] ?? "N";
        $data['hot_deal_yn'] = $data['hot_deal_yn'] ?? "N";
        $data['original_price'] = str_replace(",", "", $data['original_price']);
        $data['product_price'] = str_replace(",", "", $data['product_price']);
        $data['golf_vehicle'] = "|" . implode("|", $data['vehicle_arr']) . "|";

        $data['green_peas'] = "|" . implode("|", $data['green_peas'] ?? []) . "|";
        $data['sports_days'] = "|" . implode("|", $data['sports_days'] ?? []) . "|";
        $data['slots'] = "|" . implode("|", $data['slots'] ?? []) . "|";
        $data['golf_course_odd_numbers'] = "|" . implode("|", $data['golf_course_odd_numbers'] ?? []) . "|";
        $data['travel_times'] = "|" . implode("|", $data['travel_times'] ?? []) . "|";
        $data['carts'] = "|" . implode("|", $data['carts'] ?? []) . "|";
        $data['facilities'] = "|" . implode("|", $data['facilities'] ?? []) . "|";

        $data['deadline_date'] = implode(",", $data['deadline_date'] ?? []);
        $files = $this->request->getFiles();

        $o_name = $data['o_name'];
        $o_price1 = $data['o_price1'];
        $o_price2 = $data['o_price2'];
        $o_price3 = $data['o_price3'];
        $o_price4 = $data['o_price4'];
        $o_price5 = $data['o_price5'];
        $o_price6 = $data['o_price6'];
        $o_price7 = $data['o_price7'];
        $o_day_price = $data['o_day_price'];
        $o_night_price = $data['o_night_price'];
        $o_day_yn = $data['o_day_yn'];
        $o_night_yn = $data['night_yn'];
        $o_sdate = $data['o_sdate'];
        $o_edate = $data['o_edate'];
        $o_golf = $data['o_golf'];
        $option_type = $data['option_type'];
        $o_soldout = $data['o_soldout'];
        $data['direct_payment'] = updateSQ($_POST["direct_payment"] ?? 'N');

        $night_y = explode(",", $data['night_y']);
        $night_n = explode(",", $data['night_n']);

        for ($i = 1; $i <= 7; $i++) {
            ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);

            if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                $this->productModel->update($product_idx, ['ufile' . $i => '', 'rfile' . $i => '']);
            }

            $file = $files['ufile' . $i];
            if ($file->isValid() && !$file->hasMoved()) {
                $name = $file->getClientName();
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/data/product', $newName);
                $data['ufile' . $i] = $newName;
                $data['rfile' . $i] = $name;
            }
        }
        if ($product_idx) {
            $data['m_date'] = date("Y-m-d H:i:s");
            // $data['product_code'] = 'T' . str_pad($product_idx, 5, "0", STR_PAD_LEFT);
            $this->productModel->updateData($product_idx, $data);

            if (!$this->golfInfoModel->getGolfInfo($product_idx)) {
                $this->golfInfoModel->insertData(array_merge($data, ['product_idx' => $product_idx]));
            } else {
                $this->golfInfoModel->updateData($product_idx, $data);
            }

            $html = '<script>alert("수정되었습니다(Golf).");</script>';
            $html .= '<script>parent.location.reload();</script>';
        } else {
            $data['r_date'] = date("Y-m-d H:i:s");
            $count_product_code = $this->productModel->where("product_code", $data['product_code'])->countAllResults();

            if ($count_product_code > 0) {
                $message = "이미 있는 상품코드입니다. \n 다시 확인해주시기바랍니다.";
                return "<script>
                            alert('$message');
                            parent.location.reload();
                        </script>";
            }

            $this->productModel->insertData($data);
            $this->golfInfoModel->insertData(array_merge($data, ['product_idx' => $this->db->insertID()]));
            $html = '<script>alert("정상적인 등록되었습니다(Golf).");</script>';
            $html .= '<script>parent.location.href = "/AdmMaster/_tourRegist/list_golf";</script>';
        }

        for ($i = 0; $i < count($night_y); $i++) {
            $sql = "UPDATE tbl_golf_option  SET o_night_yn = 'Y' WHERE idx  = '" . $night_y[$i] . "' ";
            $result = $this->connect->query($sql);
        }

        for ($i = 0; $i < count($night_n); $i++) {
            $sql = "UPDATE tbl_golf_option  SET o_night_yn = '' WHERE idx  = '" . $night_n[$i] . "' ";
            $result = $this->connect->query($sql);
        }

        $o_idx = $data['o_idx'] ?? [];
        $len = count($o_idx);
        for ($i = 0; $i < $len; $i++) {
            if ($o_idx[$i]) {
                $sql = "UPDATE  tbl_golf_option  SET 
													 goods_name		= '" . $o_name[$i] . "'
													,goods_price1	= '" . $o_price1[$i] . "'
													,goods_price2	= '" . $o_price2[$i] . "'
													,goods_price3	= '" . $o_price3[$i] . "'
													,goods_price4	= '" . $o_price4[$i] . "'
													,goods_price5	= '" . $o_price5[$i] . "'
													,goods_price6	= '" . $o_price6[$i] . "'
													,goods_price7	= '" . $o_price7[$i] . "'
													,o_day_price	= '" . $o_day_price[$i] . "'
													,o_night_price	= '" . $o_night_price[$i] . "'
													,o_day_yn		= 'Y'
													,o_sdate		= '" . $o_sdate[$i] . "'
													,o_edate		= '" . $o_edate[$i] . "'
													,o_golf			= '" . $o_golf[$i] . "'
													,option_type	= '" . $option_type[$i] . "'
													,o_soldout		= '" . $o_soldout[$i] . "'
												WHERE idx	        = '" . $o_idx[$i] . "' ";
                write_log("tbl_golf_option -  " . $sql);
                $result = $this->connect->query($sql);
            } else {
                $sql = "INSERT INTO tbl_golf_option SET 
													 product_idx	= '" . $product_idx . "'
													,goods_name		= '" . $o_name[$i] . "'
													,goods_price1	= '" . $o_price1[$i] . "'
													,goods_price2	= '" . $o_price2[$i] . "'
													,goods_price3	= '" . $o_price3[$i] . "'
													,goods_price4	= '" . $o_price4[$i] . "'
													,goods_price5	= '" . $o_price5[$i] . "'
													,goods_price6	= '" . $o_price6[$i] . "'
													,goods_price7	= '" . $o_price7[$i] . "'
													,o_day_price	= '" . $o_day_price[$i] . "'
													,o_night_price	= '" . $o_night_price[$i] . "'
													,o_day_yn		= 'Y'
													,o_sdate		= '" . $o_sdate[$i] . "'
													,o_edate		= '" . $o_edate[$i] . "'
													,o_golf			= '" . $o_golf[$i] . "'
													,option_type	= '" . $option_type[$i] . "'
													,o_soldout		= '" . $o_soldout[$i] . "' ";
                write_log("tbl_golf_option -  " . $sql);
                $result = $this->connect->query($sql);
            }
        }

        // 골프 옵션 -> 일자별 가격 설정

        $sql_o = " select * from tbl_golf_option where product_idx = '" . $product_idx . "' AND option_type = 'M' ";
        write_log("1- " . $sql_o);
        $result_o = $this->connect->query($sql_o);
        $golfOoption = $result_o->getResultArray();

        foreach ($golfOoption as $row_o) {

            $ii = -1;
            $dateRange = getDateRange($row_o['o_sdate'], $row_o['o_edate']);
            foreach ($dateRange as $date) {

                $ii++;
                $golf_date = $dateRange[$ii];
                $dow = dateToYoil($golf_date);

                if ($dow == "일") $price = $row_o['goods_price1'];
                if ($dow == "월") $price = $row_o['goods_price2'];
                if ($dow == "화") $price = $row_o['goods_price3'];
                if ($dow == "수") $price = $row_o['goods_price4'];
                if ($dow == "목") $price = $row_o['goods_price5'];
                if ($dow == "금") $price = $row_o['goods_price6'];
                if ($dow == "토") $price = $row_o['goods_price7'];

                $sql_opt = "SELECT count(*) AS cnt FROM tbl_golf_price WHERE o_idx = '" . $row_o['idx'] . "' AND goods_name = '" . $row_o['goods_name'] . "' AND goods_date = '" . $golf_date . "' ";
                write_log("2- " . $sql_opt);
                $option = $this->connect->query($sql_opt)->getRowArray();
                if ($option['cnt'] == 0) {
                    $sql_c = "INSERT INTO tbl_golf_price  SET  
															  o_idx	      = '" . $row_o['idx'] . "'	
															, goods_date  = '" . $golf_date . "'	
															, dow	      = '" . $dow . "'	
															, product_idx = '" . $product_idx . "'	
															, goods_name  = '" . $row_o['goods_name'] . "'	
															, price	      = '" . $price . "'	
															, day_yn	  = 'Y'	
															, day_price	  = '" . $row_o['o_day_price'] . "'	
															, night_yn	  = '" . $row_o['o_night_yn'] . "'	
															, night_price = '" . $row_o['o_night_price'] . "'	
															, use_yn	  = ''	
															, reg_date    = now() ";
                    write_log("가격정보-1 : " . $sql_c);
                    $this->connect->query($sql_c);
                }
            }

        }

        return $this->response->setBody($html);
    }

    public function add_moption()
    {
        $product_idx = updateSQ($this->request->getPost('product_idx'));
        $moption_hole = $this->request->getPost('moption_hole');
        $moption_hour = $this->request->getPost('moption_hour');
        $moption_minute = $this->request->getPost('moption_minute');

        $optionExist = $this->golfOptionModel->checkOptionExist($product_idx, $moption_hole, $moption_hour, $moption_minute);
        if ($optionExist) {
            $html = '<script>alert("이미 등록된 옵션입니다.");</script>';
            return $this->response->setBody($html);
        }

        $newData = [
            'product_idx' => $product_idx,
            'hole_cnt' => $moption_hole,
            'hour' => $moption_hour,
            'minute' => $moption_minute,
            'option_price' => 0,
            'option_cnt' => 0,
            'use_yn' => 'Y',
            'option_type' => 'M',
            'caddy_fee' => '그린피에 포함',
            'cart_pie_fee' => '피지에 포함',
            'rdate' => date('Y-m-d H:i:s')
        ];
        $this->golfOptionModel->insert($newData);
        $insertId = $this->db->insertID();

        $html = '<tr id="moption_' . $insertId . '">';
        $html .= "<td><span>{$moption_hole}홀</span>&nbsp;/&nbsp;<span>{$moption_hour}시</span>&nbsp;&nbsp;<span>{$moption_minute}분</span></td>";
        $html .= '<input type="hidden" name="option_idx[]" id="option_idx_' . $insertId . '" value=' . $insertId . '>
                  <td>
					<input type="text" numberonly="true" name="option_price1[]" style="text-align:right;" id="option_price1_' . $insertId . '" value="0">
                  </td>
                  <td>
					<input type="text" numberonly="true" name="option_price2[]" style="text-align:right;" id="option_price2_' . $insertId . '" value="0">
                  </td>
                  <td>
					<input type="text" numberonly="true" name="option_price3[]" style="text-align:right;" id="option_price3_' . $insertId . '" value="0">
                  </td>
                  <td>
					<input type="text" numberonly="true" name="option_price4[]" style="text-align:right;" id="option_price4_' . $insertId . '" value="0">
                  </td>
                  <td>
					<input type="text" numberonly="true" name="option_price5[]" style="text-align:right;" id="option_price5_' . $insertId . '" value="0">
                  </td>
                  <td>
					<input type="text" numberonly="true" name="option_price6[]" style="text-align:right;" id="option_price6_' . $insertId . '" value="0">
                  </td>
                  <td>
					<input type="text" numberonly="true" name="option_price7[]" style="text-align:right;" id="option_price7_' . $insertId . '" value="0">
                  </td>';
        $html .= '<td>
                    <div class="flex_c_c">
                        <input type="text" name="caddy_fee[]" id="caddy_fee_' . $insertId . '" value="그린피에 포함">
                    </div>
                </td>';
        $html .= '<td>
                    <div class="flex_c_c">
                        <input type="text" name="cart_pie_fee[]" id="cart_pie_fee_' . $insertId . '" value="그린피에 포함">
                    </div>
                </td>';
        $html .= '<td class="tac">&nbsp;<button style="margin: 0;" type="button" class="btn_01" onclick="upd_moption(' . $insertId . ');">수정</button>';
        $html .= '&nbsp;<button style="margin: 0;" type="button" class="btn_02" onclick="del_moption(' . $insertId . ');">삭제</button></td>';
        $html .= '</tr>';

        return $this->response->setBody($html);
    }

    public function upd_moption($idx)
    {
        $this->golfOptionModel->update($idx, $this->request->getRawInputVar());
        return $this->response->setJSON(['message' => '수정되었습니다']);
    }

    public function list_golf_price()
    {

        $g_list_rows = 20;
        $pg = $this->request->getVar("pg");
        if ($pg == "") $pg = 1;

        $product_idx = $this->request->getVar("product_idx");
        $o_idx = $this->request->getVar("o_idx");
        $s_date = $this->request->getVar("s_date");
        $e_date = $this->request->getVar("e_date");

        $row = $this->productModel->getById($product_idx);
        $product_name = viewSQ($row["product_name"]);

        if ($o_idx) {
            $search = " AND o_idx = '$o_idx' ";
        } else {
            $search = "";
        }

        if ($s_date && $e_date) {
            $sql = "SELECT MIN(goods_date) AS s_date, MAX(goods_date) AS e_date FROM tbl_golf_price WHERE product_idx = '" . $product_idx . "' $search AND goods_date BETWEEN '$s_date' AND '$e_date' ";
        } else {
            $sql = "SELECT MIN(goods_date) AS s_date, MAX(goods_date) AS e_date FROM tbl_golf_price WHERE product_idx = '" . $product_idx . "' $search ";
        }
        write_log($sql);
        $result = $this->connect->query($sql);
        $row = $result->getRowArray();
        $o_sdate = $row['s_date'];
        $o_edate = $row['e_date'];

        if ($s_date) $o_sdate = $s_date;
        if ($e_date) $o_edate = $e_date;

        if ($s_date && $e_date) {
            $sql = "SELECT * FROM tbl_golf_price WHERE product_idx = '" . $product_idx . "' $search AND goods_date BETWEEN '$s_date' AND '$e_date' ";
        } else {
            $sql = "SELECT * FROM tbl_golf_price WHERE product_idx = '" . $product_idx . "' $search ";
        }
        $result = $this->connect->query($sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $fsql = $sql . " order by goods_date, goods_name asc limit $nFrom, $g_list_rows";
        write_log($fsql);
        $fresult = $this->connect->query($fsql);
        $roresult = $fresult->getResultArray();


        // 첫 번째 값
        $firstValue = reset($result); // 배열의 첫 번째 값
        // 마지막 값
        $lastValue = end($result);   // 배열의 마지막 값

        $data = [
            "num" => $num,
            "nPage" => $nPage,
            "pg" => $pg,
            "g_list_rows" => $g_list_rows,
            "search_val" => $search_val,
            "nTotalCount" => $nTotalCount,
            'roresult' => $roresult,
            'product_idx' => $product_idx,
            'o_idx' => $o_idx,
            'product_name' => $product_name,
            's_date' => $o_sdate,
            'e_date' => $o_edate,
        ];

        return view("admin/_tourRegist/list_golf_price", $data);
    }

    public function del_moption($idx)
    {
        $this->golfOptionModel->delete($idx);

        $db = $this->connect;
        $sql_p = "DELETE FROM tbl_golf_price WHERE o_idx = '$idx' ";
        write_log($sql_p);
        $result_p = $db->query($sql_p) or die ($db->error);

        return $this->response->setJSON(['message' => '삭체되었습니다']);
    }

    public function write_spas()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');

        $data = $this->getWrite('', '1317', '1320', '1325', '', "S");

        $db = $this->connect;

        $sql_c = "SELECT * FROM tbl_code WHERE code_gubun='tour' AND parent_code_no='" . $data["product_code_3"] . "' AND depth = '5' AND status != 'N' ORDER BY onum DESC";
        $result_c = $db->query($sql_c) or die ($db->error);
        $fresult_c = $result_c->getResultArray();

        $sql = "SELECT * FROM tbl_product_mst WHERE product_idx = '" . $product_idx . "' ";
        $query = $db->query($sql);
        $product = $query->getRowArray();
		
        $builder = $db->table('tbl_tours_moption');
        $builder->where('product_idx', $product_idx);
        $builder->where('use_yn', 'Y');
        $builder->orderBy('onum', 'desc');
        $query = $builder->get();
        $options = $query->getResultArray();

        foreach ($options as &$option) {
            $optionBuilder = $db->table('tbl_tours_option');
            $optionBuilder->where('product_idx', $product_idx);
            $optionBuilder->where('code_idx', $option['code_idx']);
            $optionBuilder->orderBy('onum', 'desc');
            $optionQuery = $optionBuilder->get();
            $option['additional_options'] = $optionQuery->getResultArray();
        }

        $sql = "SELECT COUNT(*) as cnt FROM tbl_product_tours WHERE product_idx = ?";
        $query = $db->query($sql, [$product_idx]);
        $result = $query->getRowArray();
        $data['tourCount'] = $result['cnt'];

        $sql = "SELECT * FROM tbl_product_tours WHERE product_idx = ? ORDER BY tours_idx ASC";
        $query = $db->query($sql, [$product_idx]);
        $data['tours'] = $query->getResultArray();

        $sql = "SELECT IFNULL(total_day, 0) as cnt FROM tbl_product_day_detail WHERE air_code = '0000' AND product_idx = ?";
        $query = $db->query($sql, [$product_idx]);
        $data['dayDetails'] = $query->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='spa_' and parent_code_no='4402' order by onum desc, code_idx desc";
        $fresult6 = $this->connect->query($fsql);
        $fresult6 = $fresult6->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='spa_' and parent_code_no='4404' order by onum desc, code_idx desc";
        $fresult5 = $this->connect->query($fsql);
        $fresult5 = $fresult5->getResultArray();

        $fresult5 = array_map(function ($item) {
            $rs = (array)$item;

            $code_no = $rs['code_no'];

            $fsql = "select * from tbl_code where code_gubun='spa_' and parent_code_no='$code_no' order by onum desc, code_idx desc";

            $rs_child = $this->connect->query($fsql)->getResultArray();

            $rs['child'] = $rs_child;

            return $rs;
        }, $fresult5);

        $fsql = "select * from tbl_code where code_gubun='spa_' and parent_code_no='4403' order by onum desc, code_idx desc";
        $fresult8 = $this->connect->query($fsql);
        $fresult8 = $fresult8->getResultArray();

        $data['fresult6'] = $fresult6;

        $data['fresult5'] = $fresult5;

        $data['fresult8'] = $fresult8;

        $fresult9 = [];
        if ($product_idx) {
            $sql = "SELECT * FROM tbl_product_price WHERE product_idx = $product_idx ORDER BY p_idx DESC";
            $fresult9 = $this->connect->query($sql);
            $fresult9 = $fresult9->getResultArray();
        }

        $mcodes = $this->codeModel->getByParentCode('56')->getResultArray();

        $new_data = [
            'product_idx' => $product_idx,
            'codes' => $fresult_c,
            'options' => $options,
            'fresult9' => $fresult9,
		    'dirfect_payment' => $product['dirfect_payment'],	
            'mcodes'     => $mcodes,
        ];

        $data = array_merge($data, $new_data);
        return view("admin/_tourRegist/write_spas", $data);
    }

    public function write_tours()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $data = $this->getWrite('', '', '1301', '', '', "T");

        $db = $this->connect;

        $sql_c = "SELECT * FROM tbl_code WHERE code_gubun='tour' AND parent_code_no='" . $data["product_code_3"] . "' AND depth = '5' AND status != 'N' ORDER BY onum DESC";
        $result_c = $db->query($sql_c) or die ($db->error);
        $fresult_c = $result_c->getResultArray();

        $builder = $db->table('tbl_tours_moption');
        $builder->where('product_idx', $product_idx);
        $builder->where('use_yn', 'Y');
        $builder->orderBy('onum', 'desc');
        $query = $builder->get();
        $options = $query->getResultArray();

        $sql = "SELECT * FROM tbl_product_mst WHERE product_idx = '" . $product_idx . "' ";
        $query = $db->query($sql);
        $product = $query->getRowArray();

        foreach ($options as &$option) {
            $optionBuilder = $db->table('tbl_tours_option');
            $optionBuilder->where('product_idx', $product_idx);
            $optionBuilder->where('code_idx', $option['code_idx']);
            $optionBuilder->orderBy('onum', 'desc');
            $optionQuery = $optionBuilder->get();
            $option['additional_options'] = $optionQuery->getResultArray();
        }

        $sql = "SELECT COUNT(*) as cnt FROM tbl_product_tours WHERE product_idx = ?";
        $query = $db->query($sql, [$product_idx]);
        $result = $query->getRowArray();
        $data['tourCount'] = $result['cnt'];

        $sql = "SELECT * FROM tbl_product_tours WHERE product_idx = ? ORDER BY tours_idx ASC";
        $query = $db->query($sql, [$product_idx]);
        $data['tours'] = $query->getResultArray();

        $sql = "SELECT IFNULL(total_day, 0) as cnt FROM tbl_product_day_detail WHERE air_code = '0000' AND product_idx = ?";
        $query = $db->query($sql, [$product_idx]);
        $data['dayDetails'] = $query->getResultArray();

        $sql_info = "
            SELECT pt.*, pti.*
            FROM tbl_product_tours pt
            LEFT JOIN tbl_product_tour_info pti ON pt.info_idx = pti.info_idx
            WHERE pt.product_idx = ? ORDER BY pt.info_idx ASC, pt.tours_idx ASC
        ";

        $query_info = $db->query($sql_info, [$product_idx]);
        $data['productTourInfo'] = $query_info->getResultArray();

        $mcodes = $this->codeModel->getByParentCode('56')->getResultArray();

        $new_data = [
            'product_idx'     => $product_idx,
			'tour_price'      => $data['tours'],
            'codes'           => $fresult_c,
            'options'         => $options,
            'productTourInfo' => $data['productTourInfo'],
            'dirfect_payment' => $product['dirfect_payment'],
            'mcodes'          => $mcodes,
        ];

        $conditions = [
            "parent_code_no" => '55',
        ];
        $product_themes = $this->codeModel->getCodesByConditions($conditions);

        $data['pthemes'] = $product_themes;
        $data['product'] = $product;

        $data = array_merge($data, $new_data);
        return view("admin/_tourRegist/write_tours", $data);
    }

    private function getWrite($hotel_code, $spa_code, $tour_code, $golf_code, $stay_code, $type = "")
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $product_code_2 = updateSQ($_GET["product_code_2"] ?? "");
        $product_code = updateSQ($_GET["product_code"] ?? "");
        $product_code_3 = updateSQ($_GET["product_code_3"] ?? "");
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? "");
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? "");
        $s_product_code_3 = updateSQ($_GET["s_product_code_3"] ?? "");
        $titleStr = '';
        $orderBy = $_GET["orderBy"] ?? "";
        if ($orderBy == "") $orderBy = 1;

        $fsql = "SELECT * FROM tbl_code 
                 WHERE depth='2' 
                 AND (code_no = '$hotel_code' 
                      OR code_no = '$spa_code' 
                      OR code_no = '$tour_code' 
                      OR code_no = '$golf_code' 
                      OR code_no = '$stay_code') 
                 AND status='Y' 
                 ORDER BY onum DESC, code_idx DESC";
        $fresult = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where depth='3'  
                        AND (parent_code_no = '$hotel_code' 
                        OR parent_code_no = '$spa_code' 
                        OR parent_code_no = '$tour_code' 
                        OR parent_code_no = '$golf_code' 
                        OR parent_code_no = '$stay_code') 
                        AND status='Y'  order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult3 = $fresult3->getResultArray();

        $row = null;

        $product_code_1 = '';

        $product_code_no = $this->productModel->createProductCode($type);

        if ($product_idx) {
            $sql = " select * from tbl_product_mst where product_idx = '" . $product_idx . "'";
            $row = $this->connect->query("$sql")->getResultArray()[0];

            $fsql = "select * from tbl_code where depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
            $fresult3 = $this->connect->query($fsql) or die ($this->connect->error);
            $fresult3 = $fresult3->getResultArray();
        }


        $mresult = $this->memberModel->getMembersPaging([
            'user_level' => 2
        ], 1, 1000)['items'];

        $sql_o = " select * from tbl_product_option where status != 'N' ";
        $oresult = $this->connect->query($sql_o)->getResultArray();

        $sql_l = " select * from tbl_product_level where status != 'N' ";
        $lresult = $this->connect->query($sql_l)->getResultArray();

        $sql_m = " select * from tbl_homeset where idx='1' ";
        $mresult2 = $this->connect->query($sql_m)->getResultArray();

        $yoil_html = $this->get_yoil($product_idx);

        $fsql = "select ifnull(total_day,0)  as cnt from tbl_product_day_detail where tbl_product_day_detail.air_code='0000' and product_idx = '" . $product_idx . "'";
        $fresult4 = $this->connect->query($fsql)->getResultArray();
        $fTotalresult4 = count($fresult4);

        $data = [
            "product_idx" => $product_idx,
            "product_code" => $product_code,
            "product_code_no" => $product_code_no,
            "row" => $row,
            "titleStr" => $titleStr,
            "pg" => $pg,
            "orderBy" => $orderBy,
            "s_date" => '',
            "e_date" => '',
            "s_time" => '',
            "e_time" => '',
            "fTotalresult4" => $fTotalresult4,
            "search_name" => $search_name,
            "search_category" => $search_category,
            "product_code_1" => $product_code_1,
            "product_code_2" => $product_code_2,
            "product_code_3" => $product_code_3,
            "s_product_code_1" => $s_product_code_1,
            "s_product_code_2" => $s_product_code_2,
            "s_product_code_3" => $s_product_code_3,
            "fresult" => $fresult,
            "fresult2" => $fresult2,
            "fresult3" => $fresult3,
            "fresult4" => $fresult4,
            "yoil_html" => $yoil_html,
            "member_list" => $mresult,
            "oresult" => $oresult,
            "lresult" => $lresult,
            "mresult2" => $mresult2,
        ];

        $data_2 = [];
        if ($row) {
            foreach ($row as $key => $value) {
                $data_2[$key] = $value;
            }
        }

        $data = array_merge($data_2, $data);

        return $data;
    }

    public function get_yoil($product_idx)
    {
        $db = $this->connect;

        $fsql = "SELECT * FROM tbl_product_yoil WHERE product_idx = ? AND depth = '1' ORDER BY r_date DESC";
        $fresult4 = $db->query($fsql, [$product_idx])->getResultArray();

        $html = '<tbody>';

        $i = 1;
        foreach ($fresult4 as $frow) {
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
            $html .= "</td><td class='tac'>
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

    public function prod_update($product_idx)
    {
        try {
            $db = $this->productModel->update($product_idx, $_POST);

            if (!$db) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON(
                        [
                            'status' => 'error',
                            'message' => '수정 중 오류가 발생했습니다!!'
                        ]
                    );
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'message' => '수정 했습니다.'
                    ]
                );
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function addMoption()
    {
        $product_idx = $this->request->getPost('product_idx');
        $moption_name = $this->request->getPost('moption_name');

        $data = [
            'product_idx' => $product_idx,
            'moption_name' => $moption_name,
            'use_yn' => 'Y',
            'rdate' => date('Y-m-d H:i:s')
        ];

        if ($this->moptionModel->insert($data)) {
            $response = ['message' => '등록 완료'];
        } else {
            $response = ['message' => '등록 오류'];
        }

        return $this->response->setJSON($response);
    }

    public function updMoption()
    {
        $code_idx = $this->request->getPost('code_idx');
        $moption_name = $this->request->getPost('moption_name');


        if ($code_idx && $moption_name) {
            $data = [
                'moption_name' => $moption_name
            ];

            if ($this->moptionModel->update($code_idx, $data)) {
                $response = ['message' => '수정 완료'];
            } else {
                $response = ['message' => '수정 오류'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function delMoption()
    {
        $code_idx = $this->request->getPost('code_idx');

        try {
            if ($this->moptionModel->where('code_idx', $code_idx)->delete()) {
                $msg = "삭제 완료";
            } else {
                $msg = "삭제 오류";
            }
        } catch (\Exception $e) {
            $msg = "삭제 오류: " . $e->getMessage();
        }

        return $this->response->setJSON(['message' => $msg]);
    }

    public function addOption()
    {
        $code_idx = $this->request->getPost('code_idx');
        $product_idx = $this->request->getPost('product_idx');
        $options = $this->request->getPost('o_name');

        $this->optionTourModel->where('code_idx', $code_idx)
            ->where('product_idx', $product_idx)
            ->delete();

        $result = true;
        foreach ($options as $i => $option_name) {
            if ($option_name && isset($_POST['o_price'][$i])) {
                $data = [
                    'code_idx' => $code_idx,
                    'product_idx' => $product_idx,
                    'option_name' => $option_name,
                    'option_price' => $_POST['o_price'][$i],
                    'use_yn' => isset($_POST['use_yn'][$i]) ? $_POST['use_yn'][$i] : 'N',
                    'onum' => $_POST['o_num'][$i],
                    'rdate' => date('Y-m-d H:i:s')
                ];

                if (!$this->optionTourModel->insert($data)) {
                    $result = false;
                }
            }
        }
        if ($result) {
            $msg = "등록 완료";
        } else {
            $msg = "등록 오류";
        }

        return $this->response->setJSON(['message' => $msg]);
    }

    public function updOption()
    {
        $idx = $this->request->getPost('idx');
        $option_name = $this->request->getPost('option_name');
        $option_price = $this->request->getPost('option_price');
        $use_yn = $this->request->getPost('use_yn');
        $onum = $this->request->getPost('onum');

        $data = [
            'option_name' => $option_name,
            'option_price' => $option_price,
            'use_yn' => $use_yn,
            'onum' => $onum,
        ];

        $result = $this->optionTourModel->update($idx, $data);

        $msg = $result ? "수정 완료" : "수정 오류";
        return $this->response->setJSON(['message' => $msg]);
    }

    public function delOption()
    {
        $idx = $this->request->getPost('idx');

        try {
            if ($this->optionTourModel->where('idx', $idx)->delete()) {
                $msg = "삭제 완료";
            } else {
                $msg = "삭제 오류";
            }
        } catch (\Exception $e) {
            $msg = "삭제 오류: " . $e->getMessage();
        }

        return $this->response->setJSON(['message' => $msg]);
    }

    public function write_tour_info()
    {
        $tours_idx = $this->request->getPost('tours_idx');
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $db = $this->connect;

        $sql_info = "
            SELECT pt.*, pti.* 
            FROM tbl_product_tours pt 
            LEFT JOIN tbl_product_tour_info pti ON pt.info_idx = pti.info_idx 
            WHERE pt.product_idx = ? ORDER BY pt.tours_idx ASC
        ";

        $query_info = $db->query($sql_info, [$product_idx]);
        $results = $query_info->getResultArray();

        $groupedData = [];
        $toursIdxMap = [];
        foreach ($results as $row) {
            $infoIndex = $row['info_idx'];

            if (!isset($groupedData[$infoIndex])) {
                $groupedData[$infoIndex] = [
                    'info' => $row,
                    'tours' => [],
                    'tours_idx_json' => ''
                ];
            }

            $groupedData[$infoIndex]['tours'][] = [
                'tours_idx' => $row['tours_idx'],
                'tours_subject' => $row['tours_subject'],
                'tour_price' => $row['tour_price'],
                'tour_price_kids' => $row['tour_price_kids'],
                'tour_price_baby' => $row['tour_price_baby'],
                'status' => $row['status'],
            ];
            if (!isset($toursIdxMap[$infoIndex])) {
                $toursIdxMap[$infoIndex] = [];
            }

            if ($row['tours_idx'] !== null && !in_array($row['tours_idx'], $toursIdxMap[$infoIndex])) {
                $toursIdxMap[$infoIndex][] = $row['tours_idx'];
            }

            $groupedData[$infoIndex]['tours_idx_json'] = htmlspecialchars(json_encode($toursIdxMap[$infoIndex]), ENT_QUOTES, 'UTF-8');
        }


        $data = [
            'tours_idx' => $tours_idx,
            'product_idx' => $product_idx,
            'productTourInfo' => $groupedData,
            'infoIndex' => $infoIndex,
            'groupedData' => $groupedData,
        ];

        return view('admin/_tourRegist/write_tour_info', $data);
    }

    public function delProduct()
    {
        $product_idx = $this->request->getRawInput()['product_idx'];
        if (is_array($product_idx)) {
            $result = $this->productModel->where('product_idx', $product_idx)->set('product_status', 'D')->update();
        }
        if ($result) {
            $msg = "삭제 완료";
        } else {
            $msg = "삭제 오류";
        }
        return $this->response->setJSON(['message' => $msg]);
    }

    public function copyProduct()
    {
        $product_idx = $this->request->getPost("product_idx");

        $result = $this->productModel->copyProduct($product_idx);

        $newProductIdx = $result['insert_id'];

        $info = $result['info'];

        if ($info['product_code_1'] == 1302) {

            $this->golfInfoModel->copyInfo($product_idx, $newProductIdx);

            $this->golfOptionModel->copyOption($product_idx, $newProductIdx);

        }

        return $this->response->setJSON([
            "status" => "success",
            'message' => "제품복사 완료",
            'newProductIdx' => $newProductIdx
        ]);

    }
}