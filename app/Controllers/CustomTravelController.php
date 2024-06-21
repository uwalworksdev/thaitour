<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class CustomTravelController extends BaseController
{
    private $db;
    private $policy;
    protected $sessionLib;
    protected $sessionChk;
    public function __construct()
    {
        $this->db = db_connect();
        $this->policy = model("PolicyModel");
        helper(['html']);
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('comment_helper');
        helper('mail_helper');
    }
    public function item_list()
    {
        $currentUri = $this->request->getUri()->getPath();
        $private_key = private_key();
        $page = $this->request->getVar('page');
        $s_txt = $this->request->getVar('s_txt');
        $search_mode = $this->request->getVar('search_mode');
        $strSql = "";
        if (!$page) {
            $page = 1;
        }
        $scale = 10;

        if ($s_txt and ($search_mode == "user_name")) {
            $strSql = $strSql . " and (CONVERT( AES_DECRYPT( UNHEX( FROM_BASE64(t1.user_name_kor) ), '" . $private_key . "') using UTF8) like '%" . $s_txt . "%'
                                        or CONVERT( AES_DECRYPT( UNHEX( FROM_BASE64(t1.user_name_eng) ), '" . $private_key . "') using UTF8) like '%" . $s_txt . "%'
                                        or AES_DECRYPT( UNHEX(t2.user_name), '$private_key') like '%$s_txt%') ";
        }

        $total_sql = "SELECT t1.*,t2.m_idx FROM tbl_inquiry t1 left join tbl_member t2 on t1.user_id = t2.m_idx WHERE 1=1 $strSql";

        // $result = mysqli_query($connect, $total_sql) or die(mysqli_error($connect));
        $total_cnt = $this->db->query($total_sql)->getNumRows();



        $total_page = ceil($total_cnt / $scale);
        if ($page == "")
            $page = 1;
        $start = ($page - 1) * $scale;

        $sql = $total_sql . " order by t1.r_date desc limit $start, $scale ";
        $result = $this->db->query($sql)->getResultArray();
        $num = $total_cnt - $start;
        $no = $total_cnt - $start;
        return view("custom_travel/item_list", [
            "result" => $result,
            "page" => $page,
            "s_txt" => $s_txt,
            "search_mode" => $search_mode,
            "no" => $no,
            "num" => $num,
            "total_page" => $total_page,
            "total_cnt" => $total_cnt,
            "currentUri" => $currentUri
        ]);
    }
    public function item_write()
    {
        return view("custom_travel/item_write");
    }
    public function inquiry_ok()
    {
        $upload = "../data/inquiry/";

        $idx = updateSQText($_POST["idx"]);
        $user_name_kor = updateSQText($_POST["user_name_kor"]);
        $user_name_eng = updateSQText($_POST["user_name_eng"]);
        $user_phone = updateSQText($_POST["user_phone"]);
        $user_email = updateSQText($_POST["user_email"]);
        $departure_date = updateSQText($_POST["departure_date"]);
        $arrival_date = updateSQText($_POST["arrival_date"]);
        $travel_person1 = updateSQText($_POST["travel_person1"]);
        $travel_person2 = updateSQText($_POST["travel_person2"]);
        $travel_person3 = updateSQText($_POST["travel_person3"]);
        $travel_purpose = updateSQText($_POST["travel_purpose"]);
        $travel_type = updateSQText($_POST["travel_type"]);
        $one_charge = updateSQText($_POST["one_charge"]);
        $hotel = updateSQText($_POST["hotel"]);
        $sel_hotel = updateSQText($_POST["sel_hotel"]);
        $birthday = updateSQText($_POST["birthday"]);
        $air_yn = updateSQText($_POST["air_yn"]);
        $planned_travel_area = updateSQText($_POST["planned_travel_area"]);
        $flight_schedule = updateSQText($_POST["flight_schedule"]);
        $hope_air_type = updateSQText($_POST["hope_air_type"]);
        $hope_air_class = updateSQText($_POST["hope_air_class"]);
        $air_other_matters = updateSQText($_POST["air_other_matters"]);
        $accom_other_master = updateSQText($_POST["accom_other_master"]);
        $other_requests = updateSQText($_POST["other_requests"]);
        $visit_routes = updateSQText($_POST["visit_routes"]);
        $passwd = updateSQText($_POST["passwd"]);

        $id_checking = 'R' . sprintf('%08d', rand(0, 99999999));
        $user_phone_string = implode(explode("-", $user_phone));
        if (!$passwd) {
            $passwd = substr($user_phone_string, -4);
        }
        $user_id = updateSQText($_POST["user_id"]);

        $user_name_kor_accom = $_POST["user_name_kor_accom"];
        $user_name_eng_accom = $_POST["user_name_eng_accom"];
        $birthday_accom = $_POST["birthday_accom"];

        if ($idx) {
            $sql = "
			update tbl_inquiry SET 
						user_name_kor    		= '" . sqlSecretConver($user_name_kor, 'encode') . "'
						,user_name_eng    		= '" . sqlSecretConver($user_name_eng, 'encode') . "'
						,user_phone       		= '" . sqlSecretConver($user_phone, 'encode') . "'
						,user_email       		= '" . sqlSecretConver($user_email, 'encode') . "'
						,departure_date   		= '$departure_date'
						,arrival_date     		= '$arrival_date'
						,travel_person1   		= '$travel_person1'  
						,travel_person2   		= '$travel_person2' 
						,travel_person3   		= '$travel_person3'
						,travel_purpose   		= '$travel_purpose'
						,travel_type   			= '$travel_type'
						,one_charge       		= '$one_charge'
						,hotel            		= '$hotel'
						,sel_hotel        		= '$sel_hotel'
						,birthday        		= '$birthday'
						,air_yn        			= '$air_yn'
						,planned_travel_area    = '$planned_travel_area'
						,flight_schedule        = '$flight_schedule'
						,hope_air_type        	= '$hope_air_type'
						,hope_air_class        	= '$hope_air_class'
						,air_other_matters      = '$air_other_matters'
						,accom_other_master     = '$accom_other_master'
						,other_requests        	= '$other_requests'
						,visit_routes        	= '$visit_routes'
						,m_date	    	  		= now()
						,user_id        		= '$user_id'
						,id_checking 			= '$id_checking'
						where idx		 	 	= '" . $idx . "'
						
		";
            // write_log("온라인견적서 수정 : " . $sql);
        } else {
            $sql = "
			insert into tbl_inquiry SET 
						user_name_kor    		= '" . sqlSecretConver($user_name_kor, 'encode') . "'
						,user_name_eng    		= '" . sqlSecretConver($user_name_eng, 'encode') . "'
						,user_phone       		= '" . sqlSecretConver($user_phone, 'encode') . "'
						,user_email       		= '" . sqlSecretConver($user_email, 'encode') . "'
						,departure_date   		= '$departure_date'
						,arrival_date     		= '$arrival_date'
						,travel_person1   		= '$travel_person1'  
						,travel_person2   		= '$travel_person2' 
						,travel_person3   		= '$travel_person3'
						,travel_purpose   		= '$travel_purpose'
						,travel_type   			= '$travel_type'
						,one_charge       		= '$one_charge'
						,hotel           		= '$hotel'
						,sel_hotel        		= '$sel_hotel'
						,birthday        		= '$birthday'
						,air_yn        			= '$air_yn'
						,planned_travel_area    = '$planned_travel_area'
						,flight_schedule        = '$flight_schedule'
						,hope_air_type        	= '$hope_air_type'
						,hope_air_class        	= '$hope_air_class'
						,air_other_matters      = '$air_other_matters'
						,accom_other_master     = '$accom_other_master'
						,other_requests        	= '$other_requests'
						,visit_routes        	= '$visit_routes'
						,status			  		= 'W'
				        ,r_date			  		= now()
						,passwd			  		= '$passwd'
						,user_id			  	= '$user_id'
						,id_checking 			= '$id_checking'
						,user_ip                = '" . $_SERVER['REMOTE_ADDR'] . "'
		";
            // write_log("온라인견적서 등록 : " . $sql);
        }
        $result = $this->db->query($sql);

        if ($result) {
            $sql_get_new_idx = "SELECT MAX(idx) AS idx from tbl_inquiry;";
            // $idx = mysqli_fetch_array(mysqli_query($connect, $sql_get_new_idx))['idx'];
            $idx = $this->db->query($sql_get_new_idx)->getRowArray()['idx'];
            for ($i = 0; $i < count($user_name_kor_accom); $i++) {
                $user_name_kor_1 = $user_name_kor_accom[$i];
                $user_name_eng_1 = $user_name_eng_accom[$i];
                $birthday_1 = $birthday_accom[$i];

                $sql = "
			INSERT INTO tbl_inquiry_companion SET 
			user_name_kor= '" . sqlSecretConver($user_name_kor_1, 'encode') . "'
			,inquiry_idx = '$idx'
			,user_name_eng= '" . sqlSecretConver($user_name_eng_1, 'encode') . "'
			,birthday     = '$birthday_1'
			";

                $this->db->query($sql);
            }

            $code = "A16";
            $user_mail = $user_email;
            $replace_text = "";
            $replace_text .= "|||[name]:::" . $user_name_kor;
            $replace_text .= "|||[passport_name]:::" . $user_name_eng;
            $replace_text .= "|||[tel]:::" . $user_phone;
            $replace_text .= "|||[email]:::" . $user_email;
            $replace_text .= "|||[person_cnt]:::" . "성인: $travel_person1" . "명/어린이: $travel_person1" . "명/유아: $travel_person1" . "명";
            $replace_text .= "|||[concept_name]:::" . $travel_purpose;
            $replace_text .= "|||[booking_date1]:::" . $departure_date;
            $replace_text .= "|||[booking_date2]:::" . $arrival_date;
            $replace_text .= "|||[city_name_sel]:::" . $planned_travel_area;
            $replace_text .= "|||[city_name_txt]:::";
            $replace_text .= "|||[stay_type]:::" . $sel_hotel;
            $replace_text .= "|||[one_charge]:::" . $one_charge;
            $replace_text .= "|||[memo]:::" . $other_requests;
            $replace_text .= "|||[path]:::" . $visit_routes;
            // autoEmail($code, $user_mail, $replace_text);

            $code = "S16";
            $to_phone = $user_phone;
            $replace_text = "|||{{ORDER_NAME}}:::" . $user_name_kor;
            $replace_text .= "|||{{ORDER_ID}}:::" . $id_checking;
            // autoSms($code, $to_phone, $replace_text);
        }
    }
}