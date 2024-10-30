<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;
use CodeIgniter\I18n\Time;
use Exception;

class ReservationController extends BaseController
{
    private $db;

    protected $connect;
    private $orderModel;
    private $orderSubModel;
    private $codeModel;


    public function __construct()
    {
        $this->db = db_connect();
        $this->orderModel = model("OrdersModel");
        $this->orderSubModel = model("OrderSubModel");
        $this->codeModel = model("Code");
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function list()
    {
		$private_key     = private_key();

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
        $strSql = $strSql . " and a.order_status != 'D' ";

		$total_sql = "	select a.product_name as product_name_new  
		                     , AES_DECRYPT(UNHEX(a.order_user_name),   '$private_key') AS user_name
						     , AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS user_mobile
						     , AES_DECRYPT(UNHEX(a.manager_name),      '$private_key') AS man_name
						     , AES_DECRYPT(UNHEX(a.manager_phone),     '$private_key') AS man_phone
						     , AES_DECRYPT(UNHEX(a.manager_email),     '$private_key') AS man_email 
                             , a.*
							 , b.*
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
        $num    = $nTotalCount - $nFrom;

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
            'total_sql'       => $total_sql,
            'nTotalCount'     => $nTotalCount,
            'num'             => $num,
            'result'          => $result,
            'fresult'         => $fresult,
            'fresult2'        => $fresult2,
            'fresult3'        => $fresult3,
            'pg'              => $pg,
            'nPage'           => $nPage,
            'search_category' => $search_category,
            'search_name'     => $search_name,
            'product_code_1'  => $product_code_1,
            'product_code_2'  => $product_code_2,
            'product_code_3'  => $product_code_3,
            's_date'          => $s_date,
            'e_date'          => $e_date,
            'date_chker'      => $date_chker,
            'isDelete'        => $isDelete,
            '_isDelete'       => $isDelete,
            'g_list_rows'     => $g_list_rows,
            'nFrom'           => $nFrom,
            '_pg_Method'      => $_pg_Method,
            '_deli_type'      => $_deli_type,
            'state_chker'     => $state_chker,
            's_time'          => $s_time,
            'e_time'          => $e_time,
            'payment_chker'   => $payment_chker,
            's_status'        => $s_status,
            'arrays_paging'   => $arrays_paging
        ];
        return view('admin/_reservation/list', $data);
    }

    public function write($gubun = null)
    {
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $private_key = private_key();
        $pg = updateSQ($_GET["pg"] ?? '');
        $order_idx = updateSQ($_GET["order_idx"] ?? '');
        $titleStr = "주문 생성";
        if ($order_idx) {
            $total_sql = " select * from tbl_order_mst where order_idx='" . $order_idx . "'";
            $result = $this->connect->query($total_sql);
            $row = $result->getRowArray();

            $sql_d = "SELECT  AES_DECRYPT(UNHEX('{$row['order_user_name']}'),   '$private_key') order_user_name
						    , AES_DECRYPT(UNHEX('{$row['order_user_mobile']}'), '$private_key') order_user_mobile
						    , AES_DECRYPT(UNHEX('{$row['order_user_phone']}'),  '$private_key') order_user_phone
						    , AES_DECRYPT(UNHEX('{$row['order_user_email']}'),  '$private_key') order_user_email
						    , AES_DECRYPT(UNHEX('{$row['manager_name']}'),      '$private_key') manager_name
						    , AES_DECRYPT(UNHEX('{$row['manager_phone']}'),     '$private_key') manager_phone
						    , AES_DECRYPT(UNHEX('{$row['manager_email']}'),     '$private_key') manager_email
							, AES_DECRYPT(UNHEX('{$row['local_phone']}'),     	'$private_key') local_phone ";
            $res_d = $this->connect->query($sql_d);
            $row_d = $res_d->getRowArray();

            $row['order_user_name'] = $row_d['order_user_name'];
            $row['order_user_mobile'] = $row_d['order_user_mobile'];
            $row['order_user_phone'] = $row_d['order_user_phone'];
            $row['order_user_email'] = $row_d['order_user_email'];
            $row['manager_name'] = $row_d['manager_name'];
            $row['manager_phone'] = $row_d['manager_phone'];
            $row['manager_email'] = $row_d['manager_email'];
            $row['local_phone'] = $row_d['local_phone'];

            $m_idx = $row["m_idx"];
            $air_idx = $row["air_idx"];
            $yoil_idx = $row["yoil_idx"];
            $product_idx = $row["product_idx"];
            $product_name = $row["product_name"];
            $tours_subject = $row["tours_subject"];
            $order_gubun = $row["order_gubun"];
            $order_no = $row["order_no"];
            $order_date = $row["order_date"];
            $order_user_name = $row["order_user_name"];
            $order_user_email = $row["order_user_email"];
            $order_user_mobile = $row["order_user_mobile"];
            $order_user_phone = $row["order_user_phone"];
            $order_memo = $row["order_memo"];
            $custom_req = $row["custom_req"];
            $local_phone = $row["local_phone"];
            $start_date = $row["start_date"];
            $end_date = $row["end_date"];
            $product_period = $row["product_period"];
            $tour_period = $row["tour_period"];
            $people_adult_cnt = $row["people_adult_cnt"];
            $people_adult_price = $row["people_adult_price"];
            $people_kids_cnt = $row["people_kids_cnt"];
            $people_kids_price = $row["people_kids_price"];
            $people_baby_cnt = $row["people_baby_cnt"];
            $people_baby_price = $row["people_baby_price"];
            $inital_price = $row["inital_price"];
            $order_price = $row["order_price"];
            $order_room_cnt = $row["order_room_cnt"];
            $order_day_cnt = $row["order_day_cnt"];
            $order_confirm_price = $row["order_confirm_price"];
            $order_method = $row["order_method"];
            $used_coupon_idx = $row["used_coupon_idx"];
            $used_coupon_point = $row["used_coupon_point"];
            $product_mileage = $row["product_mileage"];
            $order_mileage = $row["order_mileage"];
            $used_coupon_money = $row["used_coupon_money"];
            $oil_price = $row["oil_price"];
            $order_status = $row["order_status"];
            $order_r_date = $row["order_r_date"];
            $admin_memo = $row["admin_memo"];
            $paydate = $row["paydate"];
            $deposit_price = $row["deposit_price"];
            $order_confirm_date = $row["order_confirm_date"];
            $used_mileage_money = $row["used_mileage_money"];
            $order_mileage_yn = $row["order_mileage_yn"];

            $ResultCode_1 = $row["ResultCode_1"];
            $ResultMsg_1 = $row["ResultMsg_1"];
            $Amt_1 = $row["Amt_1"];
            $TID_1 = $row["TID_1"];
            $AuthCode_1 = $row["AuthCode_1"];
            $AuthDate_1 = $row["AuthDate_1"];
            $CancelDate_1 = $row["CancelDate_1"];

            $ResultCode_2 = $row["ResultCode_2"];
            $ResultMsg_2 = $row["ResultMsg_2"];
            $Amt_2 = $row["Amt_2"];
            $TID_2 = $row["TID_2"];
            $AuthCode_2 = $row["AuthCode_2"];
            $AuthDate_2 = $row["AuthDate_2"];
            $CancelDate_2 = $row["CancelDate_2"];

            $home_depart_date = $row["home_depart_date"];
            $away_arrive_date = $row["away_arrive_date"];
            $away_depart_date = $row["away_depart_date"];
            $home_arrive_date = $row["home_arrive_date"];

            $titleStr = "일정 및 결제정보";
        }

        $sql_cou = " select * from tbl_coupon_history where order_idx='" . $order_idx . "'";
        $result_cou = $this->connect->query($sql_cou);
        $row_cou = $result_cou->getRowArray();

        $fsql = " SELECT order_gubun, number_room
                                    , AES_DECRYPT(UNHEX(order_name_kor),   '$private_key') AS order_name_kor
                                    , AES_DECRYPT(UNHEX(order_first_name), '$private_key') AS order_first_name
                                    , AES_DECRYPT(UNHEX(order_last_name),  '$private_key') AS order_last_name
                                    , AES_DECRYPT(UNHEX(order_mobile),     '$private_key') AS order_mobile
                                    , AES_DECRYPT(UNHEX(passport_num),     '$private_key') AS passport_num
                                    , AES_DECRYPT(UNHEX(order_email),      '$private_key') AS order_email
                                    , order_birthday
                                    , passport_date
                                    , order_sex
                                    , gl_idx
                                    , ufile
                                    , rfile
                                        FROM tbl_order_list WHERE order_idx = '" . $order_idx . "' ORDER BY gl_idx asc";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $str_guide = '';
        $used_coupon_no = '';
        $data = [
            "search_category" => $search_category ?? '',
            "search_name" => $search_name ?? '',
            "pg" => $pg ?? '',
            "titleStr" => $titleStr,
            "order_idx" => $order_idx ?? '',
            "m_idx" => $m_idx ?? '',
            "air_idx" => $air_idx ?? '',
            "yoil_idx" => $yoil_idx ?? '',
            "product_idx" => $product_idx ?? '',
            "product_name" => $product_name ?? '',
            "tours_subject" => $tours_subject ?? '',
            "order_gubun" => $order_gubun ?? '',
            "order_no" => $order_no ?? '',
            "order_date" => $order_date ?? '',
            "order_user_name" => $order_user_name ?? '',
            "order_user_email" => $order_user_email ?? '',
            "order_user_mobile" => $order_user_mobile ?? '',
            "order_user_phone" => $order_user_phone ?? '',
            "order_memo" => $order_memo ?? '',
            "custom_req" => $custom_req ?? '',
            "local_phone" => $local_phone ?? '',
            "start_date" => $start_date ?? '',
            "end_date" => $end_date ?? '',
            "product_period" => $product_period ?? '',
            "tour_period" => $tour_period ?? '',
            "people_adult_cnt" => $people_adult_cnt ?? '',
            "people_adult_price" => $people_adult_price ?? '',
            "people_kids_cnt" => $people_kids_cnt ?? '',
            "people_kids_price" => $people_kids_price ?? '',
            "people_baby_cnt" => $people_baby_cnt ?? '',
            "people_baby_price" => $people_baby_price ?? '',
            "order_price" => $order_price ?? '',
            "inital_price" => $inital_price ?? '',
            "order_room_cnt" => $order_room_cnt ?? '',
            "order_day_cnt" => $order_day_cnt ?? '',
            "order_confirm_price" => $order_confirm_price ?? '',
            "order_method" => $order_method ?? '',
            "used_coupon_idx" => $used_coupon_idx ?? '',
            "used_coupon_point" => $used_coupon_point ?? '',
            "product_mileage" => $product_mileage ?? '',
            "order_mileage" => $order_mileage ?? '',
            "used_coupon_money" => $used_coupon_money ?? '',
            "oil_price" => $oil_price ?? '',
            "order_status" => $order_status ?? '',
            "order_r_date" => $order_r_date ?? '',
            "admin_memo" => $admin_memo ?? '',
            "paydate" => $paydate ?? '',
            "deposit_price" => $deposit_price ?? '',
            "order_confirm_date" => $order_confirm_date ?? '',
            "used_mileage_money" => $used_mileage_money ?? '',
            "order_mileage_yn" => $order_mileage_yn ?? '',
            "ResultCode_1" => $ResultCode_1 ?? '',
            "ResultMsg_1" => $ResultMsg_1 ?? '',
            "Amt_1" => $Amt_1 ?? '',
            "TID_1" => $TID_1 ?? '',
            "AuthCode_1" => $AuthCode_1 ?? '',
            "AuthDate_1" => $AuthDate_1 ?? '',
            "CancelDate_1" => $CancelDate_1 ?? '',
            "ResultCode_2" => $ResultCode_2 ?? '',
            "ResultMsg_2" => $ResultMsg_2 ?? '',
            "Amt_2" => $Amt_2 ?? '',
            "TID_2" => $TID_2 ?? '',
            "AuthCode_2" => $AuthCode_2 ?? '',
            "AuthDate_2" => $AuthDate_2 ?? '',
            "CancelDate_2" => $CancelDate_2 ?? '',
            "home_depart_date" => $home_depart_date ?? '',
            "away_arrive_date" => $away_arrive_date ?? '',
            "away_depart_date" => $away_depart_date ?? '',
            "home_arrive_date" => $home_arrive_date ?? '',
            "str_guide" => $str_guide,
            "row" => $row  ?? '',
            "row_cou" => $row_cou ?? [
                'used_coupon_no' => '',
                ],
            "fresult" => $fresult ?? '',
            "used_coupon_no" => $used_coupon_no,
            "deposit_date" => $deposit_date ?? '',
        ];

        return view("admin/_reservation/{$gubun}/write", $data);
    }


    public function write_ok() {
        try{
            $product_name			= updateSQ($_POST["product_name"]);
            $order_idx				= updateSQ($_POST["order_idx"]);	
            $deposit_price_change	= number_format($_POST["deposit_price_change"]);	
            $price_confirm_change	= updateSQ($_POST["price_confirm_change"]);	
            $total_price_change		= updateSQ($_POST["total_price_change"]);	
            $order_user_name		= updateSQ($_POST["order_user_name"]);	
            $order_user_email		= updateSQ($_POST["order_user_email"]);	
            $order_user_mobile		= updateSQ($_POST["order_user_mobile"]);	
            $order_user_phone		= updateSQ($_POST["order_user_phone"]);	
            $order_status			= updateSQ($_POST["order_status"]);	
            $manager_name			= updateSQ($_POST["manager_name"]);	
            $manager_phone			= updateSQ($_POST["manager_phone"]);	
            $manager_email			= updateSQ($_POST["manager_email"]);	
            $order_method			= updateSQ($_POST["order_method"]);	
            $order_confirm_price	= str_replace(",","",updateSQ($_POST["order_confirm_price"]));	
            $custom_req				= updateSQ($_POST["custom_req"]);	
            $local_phone			= updateSQ($_POST["local_phone"]);	
            $admin_memo				= updateSQ($_POST["admin_memo"]);	
            $deposit_price			= str_replace(",","",updateSQ($_POST["deposit_price"]));	
                
            $start_date				= updateSQ($_POST['start_date']);  
            $end_date				= updateSQ($_POST['end_date']);  
            $order_price			= str_replace(",","",updateSQ($_POST["order_price"]));	
    
            if($order_idx){
                $data = [
                    "product_name" => $product_name,
                    "order_user_name" => encryptField($order_user_name, "encode"),
                    "order_user_email" => encryptField($order_user_email, "encode"),
                    "order_user_mobile" => encryptField($order_user_mobile, "encode"),
                    "order_user_phone" => encryptField($order_user_phone, "encode"),
                    "local_phone" => encryptField($local_phone, "encode"),
                    "order_status" => $order_status,
                    "order_method" => $order_method,
                    "deposit_price_change" => $deposit_price_change,
                    "price_confirm_change" => $price_confirm_change,
                    "total_price_change" => $total_price_change,
                    "order_confirm_price" => $order_confirm_price,
                    "custom_req" => $custom_req,
                    "admin_memo" => $admin_memo,
                    "manager_name" => encryptField($manager_name, "encode"),
                    "manager_phone" => encryptField($manager_phone, "encode"),
                    "manager_email" => encryptField($manager_email, "encode"),
                    "start_date" => $start_date,
                    "end_date" => $end_date,
                    "order_price" => $order_price,
                    "deposit_price" => $deposit_price,
                    "order_m_date" => Time::now('Asia/Seoul', 'en_US') 
                ];
    
                if($order_status == "R") {
                    $data["order_confirm_date"] = Time::now('Asia/Seoul', 'en_US');
                } else if($order_status == "Y") {
                    $data["order_c_date"] = Time::now('Asia/Seoul', 'en_US');
                }
    
                $this->orderModel->update($order_idx, $data);
    
                $gl_idx = $this->request->getPost('gl_idx');
                $order_name_kor = $this->request->getPost('order_name_kor');
                $order_first_name = $this->request->getPost('order_first_name');
                $order_last_name = $this->request->getPost('order_last_name');
                $passport_num = $this->request->getPost('passport_num');
                $order_email = $this->request->getPost('order_email');
                $order_birthday = $this->request->getPost('order_birthday');
                $order_mobile = $this->request->getPost('order_mobile');
                $passport_date = $this->request->getPost('passport_date');
                $order_sex = $this->request->getPost('order_sex');
    
                for ($i = 0; $i < count($gl_idx) ; $i++)
                {
                    $data_sub = [
                        "order_name_kor" => encryptField($order_name_kor[$i], "encode"),
                        "order_first_name" => encryptField($order_first_name[$i], "encode"),
                        "order_last_name" => encryptField($order_last_name[$i], "encode"),
                        "passport_num" => encryptField($passport_num[$i], "encode"),
                        "order_email" => encryptField($order_email[$i], "encode"),
                        "order_birthday" => $order_birthday[$i],
                        "order_mobile" => encryptField($order_mobile[$i], "encode"),
                        "passport_date" => $passport_date[$i],
                        "order_sex" => $order_sex[$i]
                    ];
    
                    $this->orderSubModel->update($gl_idx[$i], $data_sub);
                }
            }
        }catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }   
    }

    public function delete() {

        try {
            $order_idx = $this->request->getPost('order_idx');
            if(is_array($order_idx)){
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

    function get_code() {
        $parent_code_no = $this->request->getVar('parent_code_no');
        $depth = $this->request->getVar('depth');

        $data = [];
        $codes = $this->codeModel->getByParentCode($parent_code_no)->getResultArray();
        foreach($codes as $code){
            $arr = array(
                "code_no" => $code["code_no"],
                "code_name" => $code["code_name"],
                "status" => $code["status"],
            );

            array_push($data, $arr);
        }

        return $this->response->setJSON($data);
    }
}
