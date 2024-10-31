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
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    }

    public function list_hotel()
    {
        $data = $this->get_list_('1303');
        return view("admin/_tourRegist/list", $data);
    }

    public function list_all()
    {
        $data = $this->get_list_('');
        return view("admin/_tourRegist/list_all", $data);
    }

    public function list_honeymoon()
    {
        $data = $this->get_list_('1320');
        return view("admin/_tourRegist/list_honeymoon", $data);
    }

    public function list_spas()
    {
        $data = $this->get_list_('1317');
        $data2 = $this->get_list_('1320');
        $data3 = $this->get_list_('1324');

        $data = array_merge($data, $data2);
        $data = array_merge($data, $data3);
        return view("admin/_tourRegist/list_spas", $data);
    }

    public function list_tours()
    {
        $data = $this->get_list_('1301');
        return view("admin/_tourRegist/list_tours", $data);
    }

    public function list_golfs()
    {
        $data = $this->get_list_('1302');
        return view("admin/_tourRegist/list_golfs", $data);
    }

    private function get_list_($product_code_1)
    {

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
						LEFT JOIN tbl_code AS c2 ON c2.code_no = p1.product_code_2  where 1=1 $strSql group by p1.product_idx ";


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
        $data = $this->getWrite('', '', '', '1302', '');
        $db = $this->connect;

        $sql_c = " select * from tbl_code where parent_code_no = '26' and depth = '2' and status != 'N' order by onum desc ";
        $result_c = $db->query($sql_c) or die ($db->error);
        $fresult_c = $result_c->getResultArray();

        $options = $this->golfOptionModel->getOptions($product_idx);

        $vehicles = $this->golfVehicleModel->getByParentAndDepth(0, 1)->getResultArray();

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

        $new_data = [
            'product_idx' => $product_idx,
            'codes' => $fresult_c,
            'options' => $options,
            "golf_info" => $this->golfInfoModel->getGolfInfo($product_idx),
            'vehicles' => $vehicles
        ];

        $data = array_merge($data, $new_data);

        return view("admin/_tourRegist/write_golf", $data);
    }

    public function write_golf_ok($product_idx = null)
    {

        $data = $this->request->getPost();
        $data['is_best_value'] = $data['is_best_value'] ?? "N";
        $data['special_price'] = $data['special_price'] ?? "N";
        $data['original_price'] = str_replace(",", "", $data['original_price']);
        $data['product_price'] = str_replace(",", "", $data['product_price']);
        $data['golf_vehicle'] = "|" . implode("|", $data['vehicle_arr']) . "|";

        $files = $this->request->getFiles();
        for ($i = 1; $i <= 7; $i++) {
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
            $this->productModel->updateData($product_idx, $data);

            if (!$this->golfInfoModel->getGolfInfo($product_idx)) {
                $this->golfInfoModel->insertData(array_merge($data, ['product_idx' => $product_idx]));
            } else {
                $this->golfInfoModel->updateData($product_idx, $data);
            }

            $html = '<script>alert("수정되었습니다.");</script>';
            $html .= '<script>parent.location.reload();</script>';
        } else {
            $data['r_date'] = date("Y-m-d H:i:s");
            $data['m_date'] = date("Y-m-d H:i:s");
            $this->productModel->insertData($data);
            $this->golfInfoModel->insertData(array_merge($data, ['product_idx' => $this->db->insertID()]));
            $html = '<script>alert("등록되었습니다.");</script>';
            $html .= '<script>parent.location.href = "/AdmMaster/_tourRegist/list_golf";</script>';
        }

        if ($data['option_idx']) {
            foreach ($data['option_idx'] as $key => $value) {
                $this->golfOptionModel->update($value, [
                    'option_price' => $data['option_price'][$key],
                    'caddy_fee' => $data['caddy_fee'][$key],
                    'cart_pie_fee' => $data['cart_pie_fee'][$key],
                ]);
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
        $html .= "<td><span>{$moption_hole}홀</span>&nbsp;/&nbsp;<span>{$moption_hour}시</span>&nbsp;/&nbsp;<span>{$moption_minute}분</span></td>";
        $html .= '<td>
                    <div class="flex_c_c">
                        <input type="hidden" name="option_idx[]" id="option_idx_' . $insertId . '" value=' . $insertId . '>
                        <input type="text" name="option_price[]" id="option_price_' . $insertId . '" value="0">원
                    </div>
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
        $option_price = $this->request->getRawInputVar('option_price') ?? 0;
        $this->golfOptionModel->update($idx, ['option_price' => $option_price]);
        return $this->response->setJSON(['message' => '수정되었습니다']);
    }

    public function del_moption($idx)
    {
        $this->golfOptionModel->delete($idx);
        return $this->response->setJSON(['message' => '삭체되었습니다']);
    }

    public function write_spas()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');

        $data = $this->getWrite('', '1317', '1320', '1325', '');

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

        $new_data = [
            'product_idx' => $product_idx,
            'codes' => $fresult_c,
            'options' => $options,
        ];

        $data = array_merge($data, $new_data);
        return view("admin/_tourRegist/write_spas", $data);
    }

    public function write_tours()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $data = $this->getWrite('', '', '1301', '', '');

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
            WHERE pt.product_idx = ? ORDER BY pt.tours_idx ASC
        ";

        $query_info = $db->query($sql_info, [$product_idx]);
        $data['productTourInfo'] = $query_info->getResultArray();

        $new_data = [
            'product_idx' => $product_idx,
            'codes' => $fresult_c,
            'options' => $options,
            'productTourInfo' => $data['productTourInfo'],
        ];

        $data = array_merge($data, $new_data);
        return view("admin/_tourRegist/write_tours", $data);
    }

    private function getWrite($hotel_code, $spa_code, $tour_code, $golf_code, $stay_code)
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
        if ($product_idx) {
            $sql = " select * from tbl_product_mst where product_idx = '" . $product_idx . "'";
            $row = $this->connect->query("$sql")->getResultArray()[0];
            $product_code_1 = $row["product_code_1"];
            $product_code_2 = $row["product_code_2"];
            $product_code_3 = $row["product_code_3"];
            $product_code_4 = $row["product_code_4"];
            $product_code_name_1 = $row["product_code_name_1"];
            $product_code_name_2 = $row["product_code_name_2"];
            $product_code_name_3 = $row["product_code_name_3"];
            $product_code_name_4 = $row["product_code_name_4"];
            $min_price = $row["min_price"];
            $max_price = $row["max_price"];
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
            $ufile6 = $row["ufile6"];
            $rfile6 = $row["rfile6"];
            $ufile7 = $row["ufile7"];
            $rfile7 = $row["rfile7"];
            $tours_ufile1 = $row["tours_ufile1"];
            $tours_ufile2 = $row["tours_ufile2"];
            $tours_ufile3 = $row["tours_ufile3"];
            $tours_ufile4 = $row["tours_ufile4"];
            $tours_ufile5 = $row["tours_ufile5"];
            $tours_ufile6 = $row["tours_ufile6"];
            $product_name = $row["product_name"];
            $product_air = $row["product_air"];
            $product_info = $row["product_info"];
            $product_schedule = $row["product_schedule"];
            $product_country = $row["product_country"];
            $is_view = $row["is_view"];
            $product_period = $row["product_period"];
            $product_manager = $row["product_manager"];
            $product_manager_2 = $row["product_manager_2"];
            $original_price = $row["original_price"];
            $keyword = $row["keyword"];
            $product_price = $row["product_price"];
            $product_best = $row["product_best"];
            $onum = $row["onum"];
            $product_contents = $row["product_contents"];
            $product_confirm = $row["product_confirm"];
            $product_confirm_m = $row["product_confirm_m"];
            $product_able = $row["product_able"];
            $product_unable = $row["product_unable"];
            $mobile_able = $row["mobile_able"];
            $mobile_unable = $row["mobile_unable"];
            $special_benefit = $row["special_benefit"];
            $special_benefit_m = $row["special_benefit_m"];
            $notice_comment = $row["notice_comment"];
            $notice_comment_m = $row["notice_comment_m"];
            $etc_comment = $row["etc_comment"];
            $etc_comment_m = $row["etc_comment_m"];

            $tour_info = $row["tour_info"];
            $tour_detail = $row["tour_detail"];

            $benefit = $row["benefit"];
            $local_info = $row["local_info"];
            $phone = $row["phone"];
            $email = $row["email"];
            $phone_2 = $row["phone_2"];
            $email_2 = $row["email_2"];
            $product_route = $row["product_route"];
            $minium_people_cnt = $row["minium_people_cnt"];
            $total_people_cnt = $row["total_people_cnt"];
            $stay_list = $row["stay_list"];
            $country_list = $row["country_list"];
            $active_list = $row["active_list"];
            $sight_list = $row["sight_list"];
            $tour_period = $row["tour_period"];
            $product_mileage = $row["product_mileage"];
            $exchange = $row["exchange"];
            $jetlag = $row["jetlag"];
            $capital_city = $row["capital_city"];
            $information = $row["information"];
            $meeting_guide = $row["meeting_guide"];
            $meeting_place = $row["meeting_place"];
            $product_option = $row["product_option"];
            $coupon_y = $row["coupon_y"];
            $product_manager_id = $row["product_manager_id"];

            $m_date = $row["m_date"];
            $r_date = $row["r_date"];
            $tours_cate = $row["tours_cate"];
            $tour_transport = $row["tour_transport"];

            $yoil_0 = $row["yoil_0"];
            $yoil_1 = $row["yoil_1"];
            $yoil_2 = $row["yoil_2"];
            $yoil_3 = $row["yoil_3"];
            $yoil_4 = $row["yoil_4"];
            $yoil_5 = $row["yoil_5"];
            $yoil_6 = $row["yoil_6"];
            $guide_lang = $row["guide_lang"];

            $addrs = $row["addrs"];
            $latitude = $row["latitude"];
            $longitude = $row["longitude"];
            $product_points = $row["product_points"];
            $tours_guide = $row["tours_guide"];
            $tours_ko = $row["tours_ko"];
            $tours_join = $row["tours_join"];
            $tours_hour = $row["tours_hour"];
            $tours_total_hour = $row["tours_total_hour"];

            $product_type = $row["product_type"];

            $code_utilities = $row["code_utilities"];
            $code_services = $row["code_services"];
            $code_best_utilities = $row["code_best_utilities"];
            $code_populars = $row["code_populars"];
            $available_period = $row["available_period"];
            $deadline_time = $row["deadline_time"];

            $fsql = "select * from tbl_code where depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
            $fresult3 = $this->connect->query($fsql) or die ($this->connect->error);
            $fresult3 = $fresult3->getResultArray();
        }


        $private_key = '';
        $sql = "select user_id, AES_DECRYPT(UNHEX(user_name), '$private_key') AS user_name from tbl_member where user_level = '2'";
        $mresult = $this->connect->query($sql)->getResultArray();

        $sql_o = " select * from tbl_product_option where status != 'N' ";
        $oresult = $this->connect->query($sql_o)->getResultArray();

        $sql_l = " select * from tbl_product_level where status != 'N' ";
        $lresult = $this->connect->query($sql_l)->getResultArray();

        $sql_m = " select * from tbl_homeset where idx='1' ";
        $mresult2 = $this->connect->query($sql_m)->getResultArray();

        $yoil_html = $this->get_yoil($product_idx);

        $fsql = "select air_code_1, air_code_2, code_name
											, (select ifnull(total_day,0)  as cnt from tbl_product_day_detail where tbl_product_day_detail.air_code=a.air_code_1 and product_idx = '" . $product_idx . "') as cnt
											from tbl_product_air a, tbl_code b, tbl_product_yoil c 
											where a.air_code_1 = b.code_no and a.product_idx = '" . $product_idx . "' 
											and a.yoil_idx=c.yoil_idx
										group by 	air_code_1, code_name
										order by 	c.r_date desc
										";
        $fresult4 = $this->connect->query($fsql)->getResultArray();
        $fTotalresult4 = count($fresult4);

        $data = [
            "product_idx" => $product_idx,
            "product_code" => $product_code,
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
            "tours_ufile1" => $tours_ufile1 ?? '',
            "tours_ufile2" => $tours_ufile2 ?? '',
            "tours_ufile3" => $tours_ufile3 ?? '',
            "tours_ufile4" => $tours_ufile4 ?? '',
            "tours_ufile5" => $tours_ufile5 ?? '',
            "tours_ufile6" => $tours_ufile6 ?? '',
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
            "tours_cate" => $tours_cate ?? '',
            "tour_transport" => $tour_transport ?? '',
            "yoil_0" => $yoil_0 ?? '',
            "yoil_1" => $yoil_1 ?? '',
            "yoil_2" => $yoil_2 ?? '',
            "yoil_3" => $yoil_3 ?? '',
            "yoil_4" => $yoil_4 ?? '',
            "yoil_5" => $yoil_5 ?? '',
            "yoil_6" => $yoil_6 ?? '',
            "guide_lang" => $guide_lang ?? '',
            "addrs" => $addrs ?? '',
            "latitude" => $latitude ?? '',
            "longitude" => $longitude ?? '',
            "tours_guide" => $tours_guide ?? '',
            "tours_ko" => $tours_ko ?? '',
            "tours_join" => $tours_join ?? '',
            "tours_hour" => $tours_hour ?? '',
            "tours_total_hour" => $tours_total_hour ?? '',
            "product_points" => $product_points ?? '',
            "product_type" => $product_type ?? '',
            "code_utilities" => $code_utilities ?? '',
            "code_services" => $code_services ?? '',
            "code_best_utilities" => $code_best_utilities ?? '',
            "code_populars" => $code_populars ?? '',
            "available_period" => $available_period ?? '',
            "deadline_time" => $deadline_time ?? '',
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
        $info_idx = updateSQ($_GET["info_idx"] ?? '');
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
        foreach ($results as $row) {
            $infoIndex = $row['info_idx'];

            if (!isset($groupedData[$infoIndex])) {
                $groupedData[$infoIndex] = [
                    'info' => $row,
                    'tours' => [] 
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
        }

        $data = [
            'tours_idx' => $tours_idx,
            'product_idx' => $product_idx,
            'info_idx' => $info_idx,
            'productTourInfo' => $groupedData,
        ];
    
        return view('admin/_tourRegist/write_tour_info', $data);
    }
    
}