<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;
use TravelContactModel;

class MyPage extends BaseController
{
    private $db;
    private $member;
    private $travel_contact;
    private $travel_qna;
    private $sessionLib;
    private $sessionChk;
    public function __construct()
    {
        helper(['html']);
        $this->db = db_connect();
        $this->member = model('Member');
        $this->travel_contact = model('TravelContactModel');
        $this->travel_qna = model('TravelQnaModel');
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('alert_helper');
    }
    public function details()
    {
        $clientIP = $this->request->getIPAddress();
        $is_allow_payment = $clientIP == "220.86.61.165" || $clientIP == "113.160.96.156" || $clientIP == "58.150.52.107" || $clientIP == "14.137.74.11";
        $pg = "";
        $search_word = trim($this->request->getVar('search_word'));
        $s_status = $this->request->getVar('s_status');
        $g_list_rows = 10;
        $strSql = "";
        if ($search_word) {
            $strSql = $strSql . " and a.product_name like '%" . $search_word . "%' ";
        }

        if ($s_status) {
            $strSql = $strSql . " and a.order_status = '" . $s_status . "' ";
        }
        // $strSql = $strSql . " and a.order_gubun='hotel' ";
        $strSql = $strSql . " and a.m_idx='" . $_SESSION["member"]["mIdx"] . "' ";
        $strSql = $strSql . " and a.order_status != 'D' ";
        $total_sql = "	SELECT a.*, b.ufile1, IFNULL(COUNT(c.order_idx), 0) AS cnt
                                FROM tbl_order_mst a
                                LEFT JOIN tbl_product_mst b
                                    ON b.product_idx = a.product_idx
                                LEFT JOIN tbl_order_list c
                                    ON c.order_idx = a.order_idx WHERE 1 = 1 $strSql 
                                    GROUP BY a.order_idx ";
        $nTotalCount = $this->db->query($total_sql)->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == ""){
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by a.order_idx desc limit $nFrom, $g_list_rows ";
        $result = $this->db->query($sql)->getResultArray();
        $num = $nTotalCount - $nFrom;

        $data = [
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'pg' => $pg,
            'num' => $num,
            'result' => $result,
            'is_allow_payment' => $is_allow_payment,
            'search_word' => $search_word,
            's_status' => $s_status,
        ];

        return view('mypage/details', $data);
    }
    public function custom_travel()
    {
        return view('mypage/custom_travel');
    }
    public function custom_travel_view()
    {
        return view('mypage/custom_travel_view');
    }
    public function contact()
    {
        return view('mypage/contact');
    }
    public function contactDel()
    {
        $data = $_POST['data'];
        if ($data && count($data) > 0) {
            foreach ($data as $value) {
                $this->travel_contact->deleteTravelContact($value);
            }
        }
    }
    public function consultation()
    {
        return view('mypage/consultation');
    }
    public function qnaDel()
    {

        $del_idxs = $_POST['del_idxs'];

        $idxs = array_map('trim', explode(',', $del_idxs));

        if ($this->travel_qna->deleteTravelQna($idxs)) {
            return "OK";
        } else {
            return "ERROR";
        }
    }
    public function fav_list()
    {
        return view('mypage/fav_list');
    }
    public function travel_review()
    {
        return view('mypage/travel_review');
    }
    public function point()
    {
        return view('mypage/point');
    }
    public function coupon()
    {
        return view('mypage/coupon');
    }
    public function discount()
    {
        return view('mypage/discount');
    }
    public function discount_owned()
    {
        return view('mypage/discount_owned');
    }
    public function discount_download()
    {
        return view('mypage/discount_download');
    }
    public function info_option()
    {
        return view('mypage/info_option');
    }
    public function info_change()
    {
        if ($_SESSION["member"]["mIdx"] == "") {
            return alert_msg("", "/");
        }
        $member = $this->member->getByIdx($_SESSION["member"]["mIdx"]);
        if ($member["user_id"] == "" || $_SESSION["member"]["mIdx"] == "") {
            return alert_msg("", "/");
        }
        return view('mypage/info_change', ["member" => $member]);
    }
    public function user_mange()
    {
        return view('mypage/user_mange');
    }
    public function money()
    {
        return view('mypage/money');
    }
    public function invoice_view_item()
    {
        $private_key = private_key();

        $gubun = updateSQ($_GET["gubun"]);
        $order_idx = updateSQ($_GET["order_idx"]);
        $pg = updateSQ($_GET["pg"]);

        $sql = "select * from tbl_order_mst a
	                           left join tbl_member b on a.m_idx = b.m_idx 
							   where a.order_idx = '$order_idx' and a.m_idx = '" . $_SESSION["member"]["mIdx"] . "' ";

        $row = $this->db->query($sql)->getRowArray();

        $sql_d = "SELECT AES_DECRYPT(UNHEX('{$row['local_phone']}'), '$private_key') local_phone ";

        $row_d = $this->db->query($sql_d)->getRowArray();

        $row['local_phone'] = $row_d['local_phone'];
        $data = [
            "row" => $row,
            "order_idx" => $order_idx,
            "pg" => $pg
        ];

        if(!empty($gubun)){
            return view("mypage/invoice_view_item_{$gubun}");
        }else{
            return view('mypage/invoice_view_item');
        }

    }
    public function info_option_ok()
    {
        $user_id = updateSQ($_POST["user_id"]);
        $user_pw = updateSQ($_POST["user_pw"]);

        $total_sql = " select *, SHA1(MD5('" . $user_pw . "')) as user_pw2 from tbl_member where user_id = '" . $user_id . "' ";
        $row = $this->db->query($total_sql)->getRowArray();

        if ($_SESSION["member"]["mIdx"] == "") {
            return "";
        }
        if ($row["user_id"] == "") {
            return "NOUSER";
        } else if ($row["user_pw2"] != $row["user_pw"]) {
            return "NOPASS";
        }

        return "OK";
    }
    public function info_change_ok()
    {
        $private_key = private_key();
        $user_id = updateSQ($_POST["user_id"]);
        $user_pw = updateSQ($_POST["user_pw"]);
        $user_name = updateSQ($_POST["user_name"]);
        $gender = updateSQ($_POST["gender"]);
        $user_email = updateSQ($_POST["email1"]) . "@" . updateSQ($_POST["email2"]);
        $user_email_yn = updateSQ($_POST["user_email_yn"]);
        $sms_yn = updateSQ($_POST["sms_yn"]);
        $user_phone = updateSQ($_POST["phone1"]) . "-" . updateSQ($_POST["phone2"]) . "-" . updateSQ($_POST["phone3"]);
        $user_mobile = updateSQ($_POST["mobile1"]) . "-" . updateSQ($_POST["mobile2"]) . "-" . updateSQ($_POST["mobile3"]);
        $zip = updateSQ($_POST["zip"]);
        $addr1 = updateSQ($_POST["addr1"]);
        $addr2 = updateSQ($_POST["addr2"]);
        $job = updateSQ($_POST["job"]);
        $birthday = updateSQ($_POST["birthday"]);
        $marriage = updateSQ($_POST["marriage"]);
        $user_level = updateSQ($_POST["user_level"]);

        $ip_address = $_SERVER['REMOTE_ADDR'];
        if ($_SESSION["member"]["mIdx"] == "") {
            exit();
        }
        if (strlen($user_mobile) < 5) {
            echo "NI";
            exit();
        }


        if ($user_pw != "") {
            $sql = " update tbl_member set 
                    user_pw			= SHA1(MD5('" . $user_pw . "'))
                    where m_idx  = '" . $_SESSION["member"]["mIdx"] . "'
                ";
            $this->db->query($sql);
            // write_log("본인패스워드수정:".$sql);
        }
        $sql = " update tbl_member set 
                    birthday	   = '" . $birthday . "' 
                    ,zip		   = HEX(AES_ENCRYPT('" . $zip . "' , '" . $private_key . "')) 
                    ,addr1		   = HEX(AES_ENCRYPT('" . $addr1 . "' , '" . $private_key . "'))
                    ,addr2		   = HEX(AES_ENCRYPT('" . $addr2 . "' , '" . $private_key . "'))
                    ,user_mobile   = HEX(AES_ENCRYPT('" . $user_mobile . "' , '" . $private_key . "'))
                    ,user_name     = HEX(AES_ENCRYPT('" . $user_name . "' , '" . $private_key . "'))
                    ,sms_yn        = '" . $sms_yn . "'
                    ,user_email_yn = '" . $user_email_yn . "'
                    ,m_date		   = now()
                    where m_idx    = '" . $_SESSION["member"]["mIdx"] . "'
                ";
        // write_log("본인정보수정:".$sql);
        $this->db->query($sql);

        $member = $this->member->getByIdx($_SESSION["member"]["idx"]);

        session()->remove("member");

        $data = [];

        $data['id'] = $member['user_id'];
        $data['idx'] = $member['m_idx'];
        $data["mIdx"] = $member['m_idx'];
        $data['name'] = $member['user_name'];
        $data['email'] = $member['user_email'];
        $data['level'] = $member['user_level'];

        session()->set("member", $data);
        echo "정보수정되었습니다.";
    }
}