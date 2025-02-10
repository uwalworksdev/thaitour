<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuideOptions;
use App\Models\GuideSupOptions;
use App\Models\OrderGuideModel;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;
use Config\CustomConstants as ConfigCustomConstants;
use Exception;

class ReservationController extends BaseController
{
    private $db;
    protected $connect;
    private $productModel;

    private $orderModel;
    private $orderSubModel;
    private $codeModel;
    private $paymentHistModel;
    private $orderOptionModel;
    private $orderTours;
    private $optionTours;
    private $carsCategory;
    private $carsPrice;
    private $ordersCars;
    private $orderGuide;
    protected $guideOptionModel;
    protected $guideSupOptionModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->orderModel = model("OrdersModel");
        $this->orderSubModel = model("OrderSubModel");
        $this->orderOptionModel = model("OrderOptionModel");
        $this->codeModel = model("Code");
        $this->paymentHistModel = model("PaymentHist");
        $this->orderTours = model("OrderTourModel");
        $this->optionTours = model("OptionTourModel");
        $this->productModel = model("ProductModel");
        $this->carsCategory = model("CarsCategory");
        $this->carsPrice = model("CarsPrice");
        $this->ordersCars = model("OrdersCarsModel");

        $this->orderGuide = new OrderGuideModel();
        $this->guideOptionModel = new GuideOptions();
        $this->guideSupOptionModel = new GuideSupOptions();

        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function list_payment()
    {
        $private_key = private_key();

        $product_code_1  = !empty($_GET["product_code_1"]) ? $_GET['product_code_1'] : "";
        $product_code_2  = !empty($_GET["product_code_2"]) ? $_GET['product_code_2'] : "";
        $product_code_3  = !empty($_GET["product_code_3"]) ? $_GET['product_code_3'] : "";
        $pg              = !empty($_GET["pg"]) ? $_GET['pg'] : "";
        $isDelete        = !empty($_GET["is_delete"]) ? $_GET['is_delete'] : "";
        $s_date          = !empty($_GET["s_date"]) ? $_GET['s_date'] : "";
        $e_date          = !empty($_GET["e_date"]) ? $_GET['e_date'] : "";
        $date_chker      = !empty($_GET["date_chker"]) ? $_GET['date_chker'] : "";
        $search_name     = !empty($_GET["search_name"]) ? $_GET['search_name'] : "";
        $search_category = !empty($_GET["search_category"]) ? $_GET['search_category'] : "";
        $arrays_paging   = "";
        $strSql          = "";

        $payment_chker   = !empty($_GET["payment_chker"]) ? $_GET['payment_chker'] : array();
        $state_chker     = !empty($_GET["state_chker"]) ? $_GET['state_chker'] : array();

        if (sizeof($payment_chker) > 0) {

            $strSql = $strSql . " and a.deposit_method in (";
            $_tmp_cnt = 0;
            foreach ($payment_chker as $vals) {
                if ($_tmp_cnt > 0) {
                    $strSql = $strSql . ",";
                }

                if ($vals == "CARD")  $vals = "신용카드";
                if ($vals == "Dbank") $vals = "무통장입금";

                $strSql = $strSql . " '" . $vals . "' ";
                $_tmp_cnt++;
                $arrays_paging .= "&payment_chker[]=" . $vals;
            }

            $strSql = $strSql . " ) ";
        }

        if (sizeof($state_chkerx) > 0) {

            $strSql = $strSql . " and a.order_status in (";
            $_tmp_cnt = 0;
            foreach ($state_chker as $vals) {
                if ($_tmp_cnt > 0) {
                    $strSql = $strSql . ",";
                }
                $strSql = $strSql . " '" . $vals . "' ";
                $_tmp_cnt++;
                $arrays_paging .= "&state_chker[]=" . $vals;
            }

            $strSql = $strSql . " ) ";
        }

        if ($product_code_1) $strSql = $strSql . " and b.product_code_1 = '$product_code_1' ";
        if ($product_code_2) $strSql = $strSql . " and b.product_code_list like '%|$product_code_2%'";
        if ($product_code_3) $strSql = $strSql . " and b.product_code_list like '%|$product_code_3%'";

        if ($isDelete == "Y") $strSql = $strSql . " and a.isDelete = 'Y' ";

        if ($s_date != "" && $e_date != "") {
            if ($date_chker == "order_r_date") $strSql = $strSql . " AND (DATE(a.order_r_date) >= '" . $s_date . "'       AND DATE(order_r_date) <= '" . $e_date . "')";
            if ($date_chker == "deposit_date") $strSql = $strSql . " AND (DATE(a.deposit_date) >= '" . $s_date . "'       AND DATE(deposit_date) <= '" . $e_date . "')";
            if ($date_chker == "confirm_date") $strSql = $strSql . " AND (DATE(a.order_confirm_date) >= '" . $s_date . "' AND DATE(order_confirm_date) <= '" . $e_date . "')";
            if ($date_chker == "order_c_date") $strSql = $strSql . " AND (DATE(a.order_c_date) >= '" . $s_date . "'       AND DATE(order_c_date) <= '" . $e_date . "')";
        }

        $g_list_rows = 30;
        if ($search_name) {
            if ($search_category == "a.order_user_name" || $search_category == "a.order_user_mobile" || $search_category == "a.order_user_email" || $search_category == "a.manager_name") {
                $strSql = $strSql . " and CONVERT(AES_DECRYPT(UNHEX($search_category),'$private_key') USING utf8)  LIKE '%" . $this->db->escapeString($search_name) . "%' ";
            } else {
                $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
            }
        }
        //$strSql = $strSql . " and a.order_status != 'D' ";

/*
        $total_sql = "	select a.product_name as product_name_new  
		                     , AES_DECRYPT(UNHEX(a.order_user_name),   '$private_key') AS user_name
						     , AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS user_mobile
						     , AES_DECRYPT(UNHEX(a.manager_name),      '$private_key') AS man_name
						     , AES_DECRYPT(UNHEX(a.manager_phone),     '$private_key') AS man_phone
						     , AES_DECRYPT(UNHEX(a.manager_email),     '$private_key') AS man_email 
                             , a.*
                             , count(c.order_idx) as cnt_number_person
						from tbl_order_mst a 
						left join tbl_product_mst b on a.product_idx = b.product_idx
                        left join tbl_order_list c on c.order_idx = a.order_idx
						where a.is_modify='N' $strSql group by a.order_idx";
*/						
         $total_sql = "	select a.product_name as product_name_new  
		                     , AES_DECRYPT(UNHEX(a.payment_user_name),   'gkdlghwn!@12') AS user_name
						     , AES_DECRYPT(UNHEX(a.payment_user_mobile), 'gkdlghwn!@12') AS user_mobile
						     , AES_DECRYPT(UNHEX(a.payment_user_email),  'gkdlghwn!@12') AS user_email
                             , a.*
                             , count(c.order_idx) as cnt_number_person
						from tbl_payment_mst a 
                        left join tbl_order_list c on c.order_idx = a.payment_idx
						where a.is_modify='N' $strSql group by a.payment_idx";
						
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no not in ('1308','1309')  and status='Y' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $product_code_1 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by payment_r_date desc, payment_idx desc limit $nFrom, $g_list_rows ";
		write_log($sql);				

        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;

        /*
		$sql_d = "SELECT   AES_DECRYPT(UNHEX('{$result['order_user_name']}'),   '$private_key') order_user_name
						 , AES_DECRYPT(UNHEX('{$result['order_user_mobile']}'), '$private_key') order_user_mobile
						 , AES_DECRYPT(UNHEX('{$result['manager_name']}'),      '$private_key') manager_name
						 , AES_DECRYPT(UNHEX('{$result['manager_phone']}'),     '$private_key') manager_phone
						 , AES_DECRYPT(UNHEX('{$result['manager_email']}'),     '$private_key') manager_email ";

		$res_d = $this->connect->query($sql_d);
		$row_d = $res_d->getResultArray();

		$result['order_user_name']   = $row_d['order_user_name'];
		$result['order_user_mobile'] = $row_d['order_user_mobile'];
		$result['manager_name']      = $row_d['manager_name'];
		$result['manager_phone']     = $row_d['manager_phone'];
		$result['manager_email']     = $row_d['manager_email'];
        */
        $_pg_Method = getPgMethods();
        $_deli_type = get_deli_type();
        $s_time = '';
        $e_time = '';
        $s_status = '';
        $arrays_paging = '';
        $data = [
            'total_sql' => $total_sql,
            'nTotalCount' => $nTotalCount,
            'num' => $num,
            'result' => $result,
            'fresult' => $fresult,
            'fresult2' => $fresult2,
            'fresult3' => $fresult3,
            'pg' => $pg,
            'nPage' => $nPage,
            'search_category' => $search_category,
            'search_name' => $search_name,
            'product_code_1' => $product_code_1,
            'product_code_2' => $product_code_2,
            'product_code_3' => $product_code_3,
            's_date' => $s_date,
            'e_date' => $e_date,
            'date_chker' => $date_chker,
            'isDelete' => $isDelete,
            '_isDelete' => $isDelete,
            'g_list_rows' => $g_list_rows,
            'nFrom' => $nFrom,
            '_pg_Method' => $_pg_Method,
            '_deli_type' => $_deli_type,
            'state_chker' => $state_chker,
            's_time' => $s_time,
            'e_time' => $e_time,
            'payment_chker' => $payment_chker,
            's_status' => $s_status,
            'arrays_paging' => $arrays_paging
        ];
        return view('admin/_reservation/list_payment', $data);
    }
	
    public function list()
    {
        $private_key = private_key();

        $product_code_1 = !empty($_GET["product_code_1"]) ? $_GET['product_code_1'] : "";
        $product_code_2 = !empty($_GET["product_code_2"]) ? $_GET['product_code_2'] : "";
        $product_code_3 = !empty($_GET["product_code_3"]) ? $_GET['product_code_3'] : "";
        $pg = !empty($_GET["pg"]) ? $_GET['pg'] : "";
        $isDelete = !empty($_GET["is_delete"]) ? $_GET['is_delete'] : "";
        $s_date = !empty($_GET["s_date"]) ? $_GET['s_date'] : "";
        $e_date = !empty($_GET["e_date"]) ? $_GET['e_date'] : "";
        $date_chker = !empty($_GET["date_chker"]) ? $_GET['date_chker'] : "";
        $search_name = !empty($_GET["search_name"]) ? $_GET['search_name'] : "";
        $search_category = !empty($_GET["search_category"]) ? $_GET['search_category'] : "";
        $arrays_paging = "";
        $strSql = "";

        $payment_chker = !empty($_GET["payment_chker"]) ? $_GET['payment_chker'] : array();
        $state_chker = !empty($_GET["state_chker"]) ? $_GET['state_chker'] : array();

        if (sizeof($payment_chker) > 0) {

            $strSql = $strSql . " and a.deposit_method in (";
            $_tmp_cnt = 0;
            foreach ($payment_chker as $vals) {
                if ($_tmp_cnt > 0) {
                    $strSql = $strSql . ",";
                }

                if ($vals == "CARD") $vals = "신용카드";
                if ($vals == "Dbank") $vals = "무통장입금";

                $strSql = $strSql . " '" . $vals . "' ";
                $_tmp_cnt++;
                $arrays_paging .= "&payment_chker[]=" . $vals;
            }

            $strSql = $strSql . " ) ";
        }

        if (sizeof($state_chker) > 0) {

            $strSql = $strSql . " and a.order_status in (";
            $_tmp_cnt = 0;
            foreach ($state_chker as $vals) {
                if ($_tmp_cnt > 0) {
                    $strSql = $strSql . ",";
                }
                $strSql = $strSql . " '" . $vals . "' ";
                $_tmp_cnt++;
                $arrays_paging .= "&state_chker[]=" . $vals;
            }

            $strSql = $strSql . " ) ";
        }

        if ($product_code_1) $strSql = $strSql . " and b.product_code_1 = '$product_code_1' ";
        if ($product_code_2) $strSql = $strSql . " and b.product_code_list like '%|$product_code_2%'";
        if ($product_code_3) $strSql = $strSql . " and b.product_code_list like '%|$product_code_3%'";

        if ($isDelete == "Y") $strSql = $strSql . " and a.isDelete = 'Y' ";

        if ($s_date != "" && $e_date != "") {
            if ($date_chker == "order_r_date") $strSql = $strSql . " AND (DATE(a.order_r_date) >= '" . $s_date . "'       AND DATE(order_r_date) <= '" . $e_date . "')";
            if ($date_chker == "deposit_date") $strSql = $strSql . " AND (DATE(a.deposit_date) >= '" . $s_date . "'       AND DATE(deposit_date) <= '" . $e_date . "')";
            if ($date_chker == "confirm_date") $strSql = $strSql . " AND (DATE(a.order_confirm_date) >= '" . $s_date . "' AND DATE(order_confirm_date) <= '" . $e_date . "')";
            if ($date_chker == "order_c_date") $strSql = $strSql . " AND (DATE(a.order_c_date) >= '" . $s_date . "'       AND DATE(order_c_date) <= '" . $e_date . "')";
        }

        $g_list_rows = 30;
        if ($search_name) {
            if ($search_category == "a.order_user_name" || $search_category == "a.order_user_mobile" || $search_category == "a.order_user_email" || $search_category == "a.manager_name") {
                $strSql = $strSql . " and CONVERT(AES_DECRYPT(UNHEX($search_category),'$private_key') USING utf8)  LIKE '%" . $this->db->escapeString($search_name) . "%' ";
            } else {
                $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
            }
        }
        $strSql = $strSql . " and a.order_status != 'D' ";

        $total_sql = "	select a.product_name as product_name_new  
		                     , AES_DECRYPT(UNHEX(a.order_user_name),   '$private_key') AS user_name
						     , AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS user_mobile
						     , AES_DECRYPT(UNHEX(a.manager_name),      '$private_key') AS man_name
						     , AES_DECRYPT(UNHEX(a.manager_phone),     '$private_key') AS man_phone
						     , AES_DECRYPT(UNHEX(a.manager_email),     '$private_key') AS man_email 
                             , a.*
                             , count(c.order_idx) as cnt_number_person
						from tbl_order_mst a 
						left join tbl_product_mst b on a.product_idx = b.product_idx
                        left join tbl_order_list c on c.order_idx = a.order_idx
						where a.is_modify='N' $strSql group by a.order_idx";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no not in ('1308','1309')  and status='Y' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $product_code_1 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by order_r_date desc, order_idx desc limit $nFrom, $g_list_rows ";

        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;

        /*
		$sql_d = "SELECT   AES_DECRYPT(UNHEX('{$result['order_user_name']}'),   '$private_key') order_user_name
						 , AES_DECRYPT(UNHEX('{$result['order_user_mobile']}'), '$private_key') order_user_mobile
						 , AES_DECRYPT(UNHEX('{$result['manager_name']}'),      '$private_key') manager_name
						 , AES_DECRYPT(UNHEX('{$result['manager_phone']}'),     '$private_key') manager_phone
						 , AES_DECRYPT(UNHEX('{$result['manager_email']}'),     '$private_key') manager_email ";

		$res_d = $this->connect->query($sql_d);
		$row_d = $res_d->getResultArray();

		$result['order_user_name']   = $row_d['order_user_name'];
		$result['order_user_mobile'] = $row_d['order_user_mobile'];
		$result['manager_name']      = $row_d['manager_name'];
		$result['manager_phone']     = $row_d['manager_phone'];
		$result['manager_email']     = $row_d['manager_email'];
        */
        $_pg_Method = getPgMethods();
        $_deli_type = get_deli_type();
        $s_time = '';
        $e_time = '';
        $s_status = '';
        $arrays_paging = '';
        $data = [
            'total_sql' => $total_sql,
            'nTotalCount' => $nTotalCount,
            'num' => $num,
            'result' => $result,
            'fresult' => $fresult,
            'fresult2' => $fresult2,
            'fresult3' => $fresult3,
            'pg' => $pg,
            'nPage' => $nPage,
            'search_category' => $search_category,
            'search_name' => $search_name,
            'product_code_1' => $product_code_1,
            'product_code_2' => $product_code_2,
            'product_code_3' => $product_code_3,
            's_date' => $s_date,
            'e_date' => $e_date,
            'date_chker' => $date_chker,
            'isDelete' => $isDelete,
            '_isDelete' => $isDelete,
            'g_list_rows' => $g_list_rows,
            'nFrom' => $nFrom,
            '_pg_Method' => $_pg_Method,
            '_deli_type' => $_deli_type,
            'state_chker' => $state_chker,
            's_time' => $s_time,
            'e_time' => $e_time,
            'payment_chker' => $payment_chker,
            's_status' => $s_status,
            'arrays_paging' => $arrays_paging
        ];
        return view('admin/_reservation/list', $data);
    }

    public function write_payment()
    {
        $private_key = private_key();

		$search_category = $_GET["search_category"];
		$search_name     = $_GET["search_name"];
        $pg              = $_GET["pg"];
        $payment_idx     = $_GET["payment_idx"];

        $sql = "	select AES_DECRYPT(UNHEX(payment_user_name),   '$private_key') AS user_name
						 , AES_DECRYPT(UNHEX(payment_user_mobile), '$private_key') AS user_mobile
						 , AES_DECRYPT(UNHEX(payment_user_email),  '$private_key') AS user_email
						 , * 
						from tbl_order_mst 
						where payment_idx = '" . $payment_idx . "'";
        $result     = $this->connect->query($sql);
        $row        = $result->getRowArray();
		
		$data = [
			      'payment_row' => $row
			    ];
        return view('admin/_reservation/write_payment', $data);
		
	}
	
    public function write($gubun = null)
    {
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $order_idx = updateSQ($_GET["order_idx"] ?? '');
        $titleStr = "주문 생성";
        if ($order_idx) {
            $row = $this->orderModel->getOrderInfo($order_idx);

            $titleStr = "일정 및 결제정보";
        }

        $sql_cou = " select * from tbl_coupon_history where order_idx='" . $order_idx . "'";
        $result_cou = $this->connect->query($sql_cou);
        $row_cou = $result_cou->getRowArray();

        $fresult = $this->orderSubModel->getOrderSub($order_idx);

        $additional_request = $row['additional_request'] ?? '';
        $_arr_additional_request = explode("|", $additional_request);
        $list__additional_request = rtrim(implode(',', $_arr_additional_request), ',');

        if($list__additional_request == "") {
           $sql = "select * from tbl_code WHERE parent_code_no='53' AND status = 'Y' order by onum desc, code_idx desc";
        } else {
           $sql = "select * from tbl_code WHERE parent_code_no='53' AND status = 'Y' and code_no IN ($list__additional_request) order by onum desc, code_idx desc";
        }

		$fcodes = $this->db->query($sql)->getResultArray();

        $data['fcodes'] = $fcodes;

        $str_guide = '';
        $used_coupon_no = '';
        $data = [
            "search_category" => $search_category ?? '',
            "fcodes" => $fcodes ?? [],
            "search_name" => $search_name ?? '',
            "pg" => $pg ?? '',
            "titleStr" => $titleStr,
            "str_guide" => $str_guide,
            "row_cou" => $row_cou ?? [
                    'used_coupon_no' => '',
                ],
            "fresult" => $fresult ?? '',
            "used_coupon_no" => $used_coupon_no,
        ];

        if ($gubun == 'hotel') {
            $data['price_secret'] = getHotelOption($row['ho_idx'])["price_secret"];
        }

        if ($gubun == 'golf') {
            $data['option'] = $this->orderOptionModel->getOption($order_idx, 'main')[0];
            $data['vehicle'] = $this->orderOptionModel->getOption($order_idx, 'vehicle');
        }

        if ($gubun == 'tour') {
            $data['tour_orders'] = $this->orderTours->findByOrderIdx($order_idx)[0];
            $optionsIdx = $data['tour_orders']['options_idx'];

            $options_idx = explode(',', $optionsIdx);

            $data['tour_option'] = [];
            $data['total_price'] = 0;
            foreach ($options_idx as $idx) {
                $optionDetail = $this->optionTours->find($idx);
                if ($optionDetail) {
                    $data['tour_option'][] = $optionDetail;
                    $data['total_price'] += $optionDetail['option_price'];
                }
            }
        }

        if ($gubun == 'spa') {
            $data['option_order'] = $this->orderOptionModel->getOption($order_idx, 'spa');
        }

        if ($gubun == 'vehicle') {
            $departure_area = $row["departure_area"] ?? 0;
            $destination_area = $row["destination_area"] ?? 0;
            $cp_idx = $row["cp_idx"] ?? 0;
            $ca_depth_idx = $row["ca_depth_idx"] ?? 0;
            $ca_last_idx = $this->carsPrice->find($cp_idx)["ca_idx"] ?? "0";
            $order_idx = $row["order_idx"] ?? 0;

            $data['departure_name'] = $this->carsCategory->getById($departure_area)["code_name"];
            $data['destination_name'] = $this->carsCategory->getById($destination_area)["code_name"];
            $data['code_no_first'] = $this->carsCategory->getById($ca_depth_idx)["code_no"];
            $data['category_arr'] = $this->carsCategory->getCategoryTree($ca_last_idx);
            $data['order_cars_detail'] = $this->ordersCars->getByOrder($order_idx);
        }

        if ($gubun == 'guide'){
            $order_idx = $row["order_idx"] ?? 0;
            $o_idx = $row["yoil_idx"] ?? 0;
            $order_subs = $this->orderGuide->getListByOrderIdx($order_idx);
            $data['order_subs'] = $order_subs;

            $option = $this->guideOptionModel->getById($o_idx);
            $sup_options = $this->guideSupOptionModel->getListByOptionId($o_idx);

            $data['option'] = $option;
            $data['sup_options'] = $sup_options;
        }

        return view("admin/_reservation/{$gubun}/write", array_merge($data, $row));
    }


    public function write_ok($order_idx = null)
    {
        try {
            $data = $this->request->getPost();

            $data['order_price'] = str_replace(",", "", $data['order_price']);
            $data['order_confirm_price'] = str_replace(",", "", $data['order_confirm_price']);
            $data['deposit_price'] = str_replace(",", "", $data['deposit_price']);

            $order_status = $data['order_status'];
            $order_no = $data['order_no'];


            $data['order_m_date'] = (string)Time::now('Asia/Seoul', 'en_US');

            if ($order_status == "R") {
                $data["order_confirm_date"] = (string)Time::now('Asia/Seoul', 'en_US');
            } else if ($order_status == "Y") {
                $data["order_c_date"] = (string)Time::now('Asia/Seoul', 'en_US');
            }

            $this->orderModel->updateData($order_idx, $data);

            $gl_idx = $data['gl_idx'] ?? [];
            $order_name_kor = $data['order_name_kor'] ?? "";
            $order_first_name = $data['order_first_name'] ?? "";
            $order_last_name = $data['order_last_name'] ?? "";
            $order_full_name = $data['order_full_name'] ?? "";
            $passport_num = $data['passport_num'] ?? "";
            $order_email = $data['order_email'] ?? "";
            $order_birthday = $data['order_birthday'] ?? "";
            $order_mobile = $data['order_mobile'] ?? "";
            $passport_date = $data['passport_date'] ?? "";
            $order_sex = $data['order_sex'] ?? "";

            for ($i = 0; $i < count($gl_idx); $i++) {
                $data_sub = [
                    "order_name_kor" => encryptField($order_name_kor[$i], "encode"),
                    "order_first_name" => encryptField($order_first_name[$i], "encode"),
                    "order_last_name" => encryptField($order_last_name[$i], "encode"),
                    "order_full_name" => encryptField($order_full_name[$i], "encode"),
                    "passport_num" => encryptField($passport_num[$i], "encode"),
                    "order_email" => encryptField($order_email[$i], "encode"),
                    "order_birthday" => $order_birthday[$i],
                    "order_mobile" => encryptField($order_mobile[$i], "encode"),
                    "passport_date" => $passport_date[$i],
                    "order_sex" => $order_sex[$i]
                ];

                $this->orderSubModel->update($gl_idx[$i], $data_sub);
            }

            $idx = $data['idx_tour'] ?? "";
            $start_place = $data['start_place'] ?? "";
            $metting_time = $data['metting_time'] ?? "";
            $id_kakao = $data['id_kakao'] ?? "";
            $description = $data['description'] ?? "";
            $end_place = $data['end_place'] ?? "";

            if (!empty($idx)) {
                $data_tour = [
                    "start_place" => $start_place,
                    "metting_time" => $metting_time,
                    "id_kakao" => $id_kakao,
                    "description" => $description,
                    "end_place" => $end_place,
                ];

                $this->orderTours->update($idx, $data_tour);
            }

            if ($order_status == "G" || $order_status == "J") {

                $this->paymentHistModel->where('order_no', $order_no)->delete();

                $this->paymentHistModel->insert([
                    "order_no" => $order_no,
                    "order_gubun" => "1",
                    "order_price" => $data['deposit_price'],
                    "regDate" => Time::now('Asia/Seoul', 'en_US')
                ]);

                $this->paymentHistModel->insert([
                    "order_no" => $order_no,
                    "order_gubun" => "2",
                    "order_price" => $data['order_confirm_price'],
                    "regDate" => Time::now('Asia/Seoul', 'en_US')
                ]);

            } else if ($order_status == "R") {
                $this->paymentHistModel->where('order_no', $order_no)
                    ->where('order_gubun', "1")
                    ->update(["order_status" => "Y"]);
            } else if ($order_status == "Y") {
                $this->paymentHistModel->where('order_no', $order_no)
                    ->where('order_gubun', "2")
                    ->update(["order_status" => "Y"]);
            }
            $message = "수정되었습니다.";
            return "<script>
                alert('$message');
                    parent.location.reload();
                </script>";
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete()
    {

        try {
            $order_idx = $this->request->getPost('order_idx');
            if (is_array($order_idx)) {
                $this->db->transBegin();

                foreach ($order_idx as $idx) {
                    $this->orderModel->update($idx, [
                        "order_status" => "D",
                        "order_d_date" => Time::now('Asia/Seoul', 'en_US')
                    ]);
                }

                $this->db->transCommit();
                $resultArr['result'] = true;
                $resultArr['message'] = "정상적으로 삭제되었습니다.";
            }
        } catch (Exception $err) {
            $this->db->transRollback();
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
        } finally {
            return $this->response->setJSON($resultArr);
        }
    }

    function get_code()
    {
        $parent_code_no = $this->request->getVar('parent_code_no');
        $depth = $this->request->getVar('depth');

        $data = [];
        $codes = $this->codeModel->getByParentCode($parent_code_no)->getResultArray();
        foreach ($codes as $code) {
            $arr = array(
                "code_no" => $code["code_no"],
                "code_name" => $code["code_name"],
                "status" => $code["status"],
            );

            array_push($data, $arr);
        }

        return $this->response->setJSON($data);
    }

    public function list_car()
    {
        $private_key = private_key();

        $product_code_1 = !empty($_GET["product_code_1"]) ? $_GET['product_code_1'] : "";
        $product_code_2 = !empty($_GET["product_code_2"]) ? $_GET['product_code_2'] : "";
        $product_code_3 = !empty($_GET["product_code_3"]) ? $_GET['product_code_3'] : "";
        $pg = !empty($_GET["pg"]) ? $_GET['pg'] : "";
        $isDelete = !empty($_GET["is_delete"]) ? $_GET['is_delete'] : "";
        $s_date = !empty($_GET["s_date"]) ? $_GET['s_date'] : "";
        $e_date = !empty($_GET["e_date"]) ? $_GET['e_date'] : "";
        $date_chker = !empty($_GET["date_chker"]) ? $_GET['date_chker'] : "";
        $search_name = !empty($_GET["search_name"]) ? $_GET['search_name'] : "";
        $search_category = !empty($_GET["search_category"]) ? $_GET['search_category'] : "";
        $arrays_paging = "";
        $strSql = "";

        $payment_chker = !empty($_GET["payment_chker"]) ? $_GET['payment_chker'] : array();
        $state_chker = !empty($_GET["state_chker"]) ? $_GET['state_chker'] : array();

        if (sizeof($payment_chker) > 0) {

            $strSql = $strSql . " and a.deposit_method in (";
            $_tmp_cnt = 0;
            foreach ($payment_chker as $vals) {
                if ($_tmp_cnt > 0) {
                    $strSql = $strSql . ",";
                }

                if ($vals == "CARD") $vals = "신용카드";
                if ($vals == "Dbank") $vals = "무통장입금";

                $strSql = $strSql . " '" . $vals . "' ";
                $_tmp_cnt++;
                $arrays_paging .= "&payment_chker[]=" . $vals;
            }

            $strSql = $strSql . " ) ";
        }

        if (sizeof($state_chker) > 0) {

            $strSql = $strSql . " and a.order_status in (";
            $_tmp_cnt = 0;
            foreach ($state_chker as $vals) {
                if ($_tmp_cnt > 0) {
                    $strSql = $strSql . ",";
                }
                $strSql = $strSql . " '" . $vals . "' ";
                $_tmp_cnt++;
                $arrays_paging .= "&state_chker[]=" . $vals;
            }

            $strSql = $strSql . " ) ";
        }

        if ($product_code_1) $strSql = $strSql . " and b.product_code_1 = '$product_code_1' ";
        if ($product_code_2) $strSql = $strSql . " and b.product_code_list like %|'$product_code_2'%";
        if ($product_code_3) $strSql = $strSql . " and b.product_code_list like %|'$product_code_3'%";

        if ($isDelete == "Y") $strSql = $strSql . " and a.isDelete = 'Y' ";

        if ($s_date != "" && $e_date != "") {
            if ($date_chker == "order_r_date") $strSql = $strSql . " AND (DATE(a.order_r_date) >= '" . $s_date . "'       AND DATE(order_r_date) <= '" . $e_date . "')";
            if ($date_chker == "deposit_date") $strSql = $strSql . " AND (DATE(a.deposit_date) >= '" . $s_date . "'       AND DATE(deposit_date) <= '" . $e_date . "')";
            if ($date_chker == "confirm_date") $strSql = $strSql . " AND (DATE(a.order_confirm_date) >= '" . $s_date . "' AND DATE(order_confirm_date) <= '" . $e_date . "')";
            if ($date_chker == "order_c_date") $strSql = $strSql . " AND (DATE(a.order_c_date) >= '" . $s_date . "'       AND DATE(order_c_date) <= '" . $e_date . "')";
        }

        $g_list_rows = 30;
        if ($search_name) {
            if ($search_category == "a.order_user_name" || $search_category == "a.order_user_mobile" || $search_category == "a.order_user_email" || $search_category == "a.manager_name") {
                $strSql = $strSql . " and CONVERT(AES_DECRYPT(UNHEX($search_category),'$private_key') USING utf8)  LIKE '%" . $this->db->escapeString($search_name) . "%' ";
            } else {
                $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
            }
        }
        $strSql = $strSql . " and a.order_status != 'D' and a.order_gubun = 'vehicle' ";

        $total_sql = "	select a.product_name as product_name_new  
		                     , AES_DECRYPT(UNHEX(a.order_user_name),   '$private_key') AS user_name
						     , AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS user_mobile
						     , AES_DECRYPT(UNHEX(a.manager_name),      '$private_key') AS man_name
						     , AES_DECRYPT(UNHEX(a.manager_phone),     '$private_key') AS man_phone
						     , AES_DECRYPT(UNHEX(a.manager_email),     '$private_key') AS man_email 
                             , a.*
							 , b.*
						from tbl_order_mst a 
                        left join tbl_order_option b on b.order_idx = a.order_idx
						left join tbl_product_mst c on c.product_idx = b.product_idx
						where a.is_modify='N' $strSql group by a.order_idx";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1324'  and status='Y' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $product_code_1 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by a.order_r_date desc, a.order_idx desc limit $nFrom, $g_list_rows ";

        $result = $this->connect->query($sql);
        $result = $result->getResultArray();

        foreach($result as $key => $value) {
            $options = $this->orderOptionModel->getOption($result[$key]["order_idx"], "vehicle");
            foreach($options as $o_key => $o_value) {
                $op_product_name = $this->productModel->getById($options[$o_key]["product_idx"])["product_name"];
                $options[$o_key]["op_product_name"] = $op_product_name;
            }
            $result[$key]["options"] = $options;
        }

        $num = $nTotalCount - $nFrom;

        $_pg_Method = getPgMethods();
        $_deli_type = get_deli_type();
        $s_time = '';
        $e_time = '';
        $s_status = '';
        $arrays_paging = '';
        $data = [
            'total_sql' => $total_sql,
            'nTotalCount' => $nTotalCount,
            'num' => $num,
            'result' => $result,
            'fresult' => $fresult,
            'fresult2' => $fresult2,
            'fresult3' => $fresult3,
            'pg' => $pg,
            'nPage' => $nPage,
            'search_category' => $search_category,
            'search_name' => $search_name,
            'product_code_1' => $product_code_1,
            'product_code_2' => $product_code_2,
            'product_code_3' => $product_code_3,
            's_date' => $s_date,
            'e_date' => $e_date,
            'date_chker' => $date_chker,
            'isDelete' => $isDelete,
            '_isDelete' => $isDelete,
            'g_list_rows' => $g_list_rows,
            'nFrom' => $nFrom,
            '_pg_Method' => $_pg_Method,
            '_deli_type' => $_deli_type,
            'state_chker' => $state_chker,
            's_time' => $s_time,
            'e_time' => $e_time,
            'payment_chker' => $payment_chker,
            's_status' => $s_status,
            'arrays_paging' => $arrays_paging
        ];
        return view('admin/_reservationCar/list', $data);
    }

    public function write_car()
    {
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $order_idx = updateSQ($_GET["order_idx"] ?? '');
        $titleStr = "주문 생성";
        if ($order_idx) {
            $row = $this->orderModel->getOrderInfo($order_idx);
            $options = $this->orderOptionModel->getOption($order_idx, "vehicle");
            foreach($options as $o_key => $o_value) {
                $op_product_name = $this->productModel->getById($options[$o_key]["product_idx"])["product_name"];
                $options[$o_key]["op_product_name"] = $op_product_name;
            }
            $titleStr = "일정 및 결제정보";
        }

        $sql_cou = " select * from tbl_coupon_history where order_idx='" . $order_idx . "'";
        $result_cou = $this->connect->query($sql_cou);
        $row_cou = $result_cou->getRowArray();

        $fresult = $this->orderSubModel->getOrderSub($order_idx);

        $str_guide = '';
        $used_coupon_no = '';
        $data = [
            "search_category" => $search_category ?? '',
            "search_name" => $search_name ?? '',
            "pg" => $pg ?? '',
            "titleStr" => $titleStr,
            "str_guide" => $str_guide,
            "row_cou" => $row_cou ?? [
                    'used_coupon_no' => '',
                ],
            "fresult" => $fresult ?? '',
            "options" => $options ?? [],
            "used_coupon_no" => $used_coupon_no,
        ];

        return view("admin/_reservationCar/write", array_merge($data, $row));
    }
}
