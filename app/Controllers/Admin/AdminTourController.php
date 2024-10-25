<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminTourController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function write_ok()
    {
        $connect = $this->connect;
        $session = session();

        try {
            $files = $this->request->getFiles();

            $upload = "../../data/product/";
            $product_idx = updateSQ($_POST["product_idx" ?? '']);
            $product_code_1 = updateSQ($_POST["product_code_1" ?? '']);
            $product_code_2 = updateSQ($_POST["product_code_2" ?? '']);
            $product_code_3 = updateSQ($_POST["product_code_3" ?? '']);
            $product_code_4 = updateSQ($_POST["product_code_4" ?? '']);
            $product_code_name_1 = updateSQ($_POST["product_code_name_1" ?? '']);
            $product_code_name_2 = updateSQ($_POST["product_code_name_2" ?? '']);
            $product_code_name_3 = updateSQ($_POST["product_code_name_3" ?? '']);
            $product_code_name_4 = updateSQ($_POST["product_code_name_4" ?? '']);
            $product_name = updateSQ($_POST["product_name" ?? '']);
            $product_air = updateSQ($_POST["product_air" ?? '']);
            $product_info = updateSQ($_POST["product_info" ?? '']);
            $product_schedule = updateSQ($_POST["product_schedule" ?? '']);
            $product_country = updateSQ($_POST["product_country" ?? '']);
            $is_view = updateSQ($_POST["is_view" ?? '']);
            $product_period = updateSQ($_POST["product_period" ?? '']);
            $product_manager = updateSQ($_POST["product_manager" ?? '']);
            $product_manager_id = updateSQ($_POST["product_manager_id" ?? '']);

            $original_price = str_replace(",", "", updateSQ($_POST["original_price"] ?? ''));
            $min_price = str_replace(",", "", updateSQ($_POST["min_price"] ?? ''));
            $max_price = str_replace(",", "", updateSQ($_POST["max_price"] ?? ''));
            $keyword = $_POST["keyword"] ?? '';
            $product_price = str_replace(",", "", updateSQ($_POST["product_price"] ?? ''));
            $product_best = updateSQ($_POST["product_best" ?? '']);

            $special_price = updateSQ($_POST["special_price" ?? '']);
            $onum = updateSQ($_POST["onum" ?? '']);
            $product_contents = updateSQ($_POST["product_contents" ?? '']);
            $product_confirm = updateSQ($_POST["product_confirm" ?? '']);
            $product_confirm_m = updateSQ($_POST["product_confirm_m" ?? '']);
            $product_able = updateSQ($_POST["product_able" ?? '']);
            $product_unable = updateSQ($_POST["product_unable" ?? '']);
            $mobile_able = updateSQ($_POST["mobile_able" ?? '']);
            $mobile_unable = updateSQ($_POST["mobile_unable" ?? '']);
            $special_benefit = updateSQ($_POST["special_benefit" ?? '']);
            $special_benefit_m = updateSQ($_POST["special_benefit_m" ?? '']);
            $notice_comment = updateSQ($_POST["notice_comment" ?? '']);
            $notice_comment_m = updateSQ($_POST["notice_comment_m" ?? '']);
            $etc_comment = updateSQ($_POST["etc_comment" ?? '']);
            $etc_comment_m = updateSQ($_POST["etc_comment_m" ?? '']);
            $main_top_best = updateSQ($_POST["main_top_best" ?? '']);
            $main_theme_best = updateSQ($_POST["main_theme_best" ?? '']);

            $benefit = updateSQ($_POST["benefit" ?? '']);
            $local_info = updateSQ($_POST["local_info" ?? '']);
            $phone = updateSQ($_POST["phone" ?? '']);
            $email = updateSQ($_POST["email" ?? '']);
            $phone_2 = updateSQ($_POST["phone_2" ?? '']);
            $email_2 = updateSQ($_POST["email_2" ?? '']);
            $product_route = updateSQ($_POST["product_route" ?? '']);

            $minium_people_cnt = updateSQ($_POST["minium_people_cnt" ?? '']);
            $total_people_cnt = updateSQ($_POST["total_people_cnt" ?? '']);

            $stay_list = updateSQ($_POST["stay_list" ?? '']);
            $country_list = updateSQ($_POST["country_list" ?? '']);
            $active_list = updateSQ($_POST["active_list" ?? '']);
            $sight_list = updateSQ($_POST["sight_list" ?? '']);
            $tour_period = updateSQ($_POST["tour_period" ?? '']);
            $tour_info = updateSQ($_POST["tour_info" ?? '']);
            $product_mileage = updateSQ($_POST["product_mileage" ?? '']);

            $exchange = updateSQ($_POST["exchange" ?? '']);
            $jetlag = updateSQ($_POST["jetlag" ?? '']);
            $capital_city = updateSQ($_POST["capital_city" ?? '']);
            $information = updateSQ($_POST["information" ?? '']);
            $meeting_guide = updateSQ($_POST["meeting_guide" ?? '']);
            $meeting_place = updateSQ($_POST["meeting_place" ?? '']);
            $product_level = updateSQ($_POST["product_level" ?? '']);
            $product_option = updateSQ($_POST["product_option" ?? '']);
            $tours_cate = updateSQ($_POST["tours_cate" ?? '']);

            $yoil_0 = updateSQ($_POST["yoil_0" ?? '']);
            $yoil_1 = updateSQ($_POST["yoil_1" ?? '']);
            $yoil_2 = updateSQ($_POST["yoil_2" ?? '']);
            $yoil_3 = updateSQ($_POST["yoil_3" ?? '']);
            $yoil_4 = updateSQ($_POST["yoil_4" ?? '']);
            $yoil_5 = updateSQ($_POST["yoil_5" ?? '']);
            $yoil_6 = updateSQ($_POST["yoil_6" ?? '']);
            $guide_lang = updateSQ($_POST["guide_lang" ?? '']);
            $tour_transport = updateSQ($_POST["tour_transport" ?? '']);

            $adult_text = updateSQ($_POST["adult_text" ?? '']);
            $kids_text = updateSQ($_POST["kids_text" ?? '']);
            $baby_text = updateSQ($_POST["baby_text" ?? '']);

            for ($i = 1; $i <= 7; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                if (isset(${"del_" . $i}) && ${"del_" . $i} === "Y") {
                    $sql = "UPDATE tbl_product_mst SET 
                            ufile" . $i . "='',
                            rfile" . $i . "=''
                            WHERE product_idx='$product_idx'
                        ";

                    $connect->query($sql);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $publicPath = ROOTPATH . '/public/data/product/';
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            if ($product_idx) {
//                $data = [
//                    'product_code_1' => $product_code_1,
//                    'product_code_2' => $product_code_2,
//                    'product_code_3' => $product_code_3,
//                    'product_code_4' => $product_code_4,
//                    'product_code_name_1' => $product_code_name_1,
//                    'product_code_name_2' => $product_code_name_2,
//                    'product_code_name_3' => $product_code_name_3,
//                    'product_code_name_4' => $product_code_name_4,
//                    'product_name' => $product_name,
//                    'product_air' => $product_air,
//                    'product_info' => $product_info,
//                    'product_schedule' => $product_schedule,
//                    'product_country' => $product_country,
//                    'is_view' => $is_view,
//                    'product_period' => $product_period,
//                    'product_manager' => $product_manager,
//                    'product_manager_id' => $product_manager_id,
//                    'original_price' => $original_price,
//                    'min_price' => $min_price,
//                    'max_price' => $max_price,
//                    'keyword' => $keyword,
//                    'product_price' => $product_price,
//                    'product_best' => $product_best,
//                    'special_price' => $special_price,
//                    'onum' => $onum,
//                    'product_contents' => $product_contents,
//                    'product_confirm' => $product_confirm,
//                    'product_confirm_m' => $product_confirm_m,
//                    'product_able' => $product_able,
//                    'product_unable' => $product_unable,
//                    'mobile_able' => $mobile_able,
//                    'mobile_unable' => $mobile_unable,
//                    'special_benefit' => $special_benefit,
//                    'special_benefit_m' => $special_benefit_m,
//                    'notice_comment' => $notice_comment,
//                    'notice_comment_m' => $notice_comment_m,
//                    'etc_comment' => $etc_comment,
//                    'etc_comment_m' => $etc_comment_m,
//                    'stay_list' => $stay_list,
//                    'country_list' => $country_list,
//                    'active_list' => $active_list,
//                    'sight_list' => $sight_list,
//                    'benefit' => $benefit,
//                    'local_info' => $local_info,
//                    'phone' => $phone,
//                    'email' => $email,
//                    'product_manager_2' => $product_manager_2,
//                    'phone_2' => $phone_2,
//                    'email_2' => $email_2,
//                    'product_route' => $product_route,
//                    'minium_people_cnt' => $minium_people_cnt,
//                    'total_people_cnt' => $total_people_cnt,
//                    'tour_period' => $tour_period,
//                    'tour_info' => $tour_info,
//                    'product_mileage' => $product_mileage,
//                    'exchange' => $exchange,
//                    'jetlag' => $jetlag,
//                    'main_top_best' => $main_top_best,
//                    'main_theme_best' => $main_theme_best,
//                    'capital_city' => $capital_city,
//                    'information' => $information,
//                    'meeting_guide' => $meeting_guide,
//                    'meeting_place' => $meeting_place,
//                    'product_level' => $product_level,
//                    'product_option' => $product_option,
//                    'tours_cate' => $tours_cate,
//                    'yoil_0' => $yoil_0,
//                    'yoil_1' => $yoil_1,
//                    'yoil_2' => $yoil_2,
//                    'yoil_3' => $yoil_3,
//                    'yoil_4' => $yoil_4,
//                    'yoil_5' => $yoil_5,
//                    'yoil_6' => $yoil_6,
//                    'guide_lang' => $guide_lang,
//                    'tour_transport' => $tour_transport,
//                    'adult_text' => $adult_text,
//                    'kids_text' => $kids_text,
//                    'baby_text' => $baby_text,
//                    'm_date' => date('Y-m-d H:i:s'),
//                ];
//
//                $connect->table('tbl_product_mst')->where('product_idx', $product_idx)->update($data);
//
//                $cityModel = $connect->table('tbl_product_city');
//                foreach ($city_idx as $i => $cityId) {
//                    $cityData = [
//                        'product_idx' => $product_idx,
//                        'city_name' => $city_name[$i],
//                        'city_lat' => $city_lat[$i],
//                        'city_lng' => $city_lng[$i],
//                        'r_date' => date('Y-m-d H:i:s'),
//                    ];
//
//                    if ($cityId) {
//                        $cityModel->where('city_idx', $cityId)->update($cityData);
//                    } else {
//                        $cityModel->insert($cityData);
//                    }
//                }

                $sql = "update tbl_product_mst SET 
                            product_idx				= '" . $product_idx . "'
                            ,product_code_1			= '" . $product_code_1 . "'
                            ,product_code_2			= '" . $product_code_2 . "'
                            ,product_code_3			= '" . $product_code_3 . "'
                            ,product_code_4			= '" . $product_code_4 . "'
                            ,product_code_name_1	= '" . $product_code_name_1 . "'
                            ,product_code_name_2	= '" . $product_code_name_2 . "'
                            ,product_code_name_3	= '" . $product_code_name_3 . "'
                            ,product_code_name_4	= '" . $product_code_name_4 . "'
                            ,product_name			= '" . $product_name . "'
                            ,product_air			= '" . $product_air . "'
                            ,product_info			= '" . $product_info . "'
                            ,product_schedule		= '" . $product_schedule . "'
                            ,product_country		= '" . $product_country . "'
                            ,is_view				= '" . $is_view . "'
                            ,product_period			= '" . $product_period . "'
                            ,product_manager		= '" . $product_manager . "'
                            ,product_manager_id		= '" . $product_manager_id . "'		
                            ,original_price			= '" . $original_price . "'
                            ,min_price				= '" . $min_price . "'
                            ,max_price				= '" . $max_price . "'
                            ,keyword				= '" . $keyword . "'
                            ,product_price			= '" . $product_price . "'
                            ,product_best			= '" . $product_best . "'
                            ,special_price			= '" . $special_price . "'
                            ,onum					= '" . $onum . "'
                            ,product_contents		= '" . $product_contents . "'
                            ,product_confirm		= '" . $product_confirm . "'
                            ,product_confirm_m		= '" . $product_confirm_m . "'
                            ,product_able			= '" . $product_able . "'
                            ,product_unable			= '" . $product_unable . "'
                            ,mobile_able			= '" . $mobile_able . "'
                            ,mobile_unable			= '" . $mobile_unable . "'
                            ,special_benefit        = '" . $special_benefit . "'
                            ,special_benefit_m      = '" . $special_benefit_m . "'
                            ,notice_comment         = '" . $notice_comment . "'
                            ,notice_comment_m       = '" . $notice_comment_m . "'
                            ,etc_comment            = '" . $etc_comment . "'
                            ,etc_comment_m          = '" . $etc_comment_m . "'
                
                            ,stay_list				= '" . $stay_list . "'
                            ,country_list			= '" . $country_list . "'
                            ,active_list			= '" . $active_list . "'
                            ,sight_list				= '" . $sight_list . "'
                
                            ,benefit				= '" . $benefit . "'
                            ,local_info				= '" . $local_info . "'
                            ,phone					= '" . $phone . "'
                            ,email 					= '" . $email . "'
                            ,product_manager_2		= '" . $product_manager_2 . "'	
                            ,phone_2				= '" . $phone_2 . "'
                            ,email_2				= '" . $email_2 . "'
                
                            ,product_route			= '" . $product_route . "'
                            ,minium_people_cnt		= '" . $minium_people_cnt . "'
                            ,total_people_cnt		= '" . $total_people_cnt . "'
                            ,tour_period			= '" . $tour_period . "'
                            ,tour_info				= '" . $tour_info . "'
                            ,product_mileage		= '" . $product_mileage . "'
                            ,exchange				= '" . $exchange . "'
                            ,jetlag					= '" . $jetlag . "'
                            ,main_top_best			= '" . $main_top_best . "'
                            ,main_theme_best		= '" . $main_theme_best . "'
                            ,capital_city			= '" . $capital_city . "'
                            ,information			= '" . $information . "'
                            ,meeting_guide          = '" . $meeting_guide . "'
                            ,meeting_place          = '" . $meeting_place . "'
                            ,product_level			= '" . $product_level . "'
                            ,product_option         = '" . $product_option . "'
                            ,tours_cate             = '" . $tours_cate . "'
                            ,yoil_0                 = '" . $yoil_0 . "'
                            ,yoil_1                 = '" . $yoil_1 . "'
                            ,yoil_2                 = '" . $yoil_2 . "'
                            ,yoil_3                 = '" . $yoil_3 . "'
                            ,yoil_4                 = '" . $yoil_4 . "'
                            ,yoil_5                 = '" . $yoil_5 . "'
                            ,yoil_6                 = '" . $yoil_6 . "'
                            ,guide_lang             = '" . $guide_lang . "'
                            ,tour_transport         = '" . $tour_transport . "'
                            ,adult_text             = '" . $adult_text . "'
                            ,kids_text              = '" . $kids_text . "'
                            ,baby_text              = '" . $baby_text . "'
                            ,m_date					= now()
                        where product_idx = '" . $product_idx . "'
                    ";

                $connect->query($sql);

//                $city_idx_str = "";
//                for ($i = 0; $i < count($city_idx); $i++) {
//                    if ($city_idx[$i] != "") {
//                        $city_idx_str = $city_idx_str . $city_idx[$i] . ",";
//                    }
//                }
//                if (strlen($city_idx_str) > 0) {
//                    $city_idx_str = substr($city_idx_str, 0, strlen($city_idx_str) - 1);
//                    $sql = "delete from tbl_product_city
//                            where city_idx not in (" . $city_idx_str . ") and product_idx = '" . $product_idx . "'
//                        ";
//
//                    $connect->query($sql);
//                }
//                for ($i = 0; $i < count($city_idx); $i++) {
//                    if ($city_idx[$i] == "") {
//                        $sql = "insert into tbl_product_city SET
//                                    product_idx		= '" . $product_idx . "'
//                                    ,city_name		= '" . $city_name[$i] . "'
//                                    ,city_lat		= '" . $city_lat[$i] . "'
//                                    ,city_lng		= '" . $city_lng[$i] . "'
//                                    ,r_date			= now()
//                            ";
//
//                        $connect->query($sql);
//                    } else {
//                        $sql = "update tbl_product_city SET
//                                    product_idx		= '" . $product_idx . "'
//                                    ,city_name		= '" . $city_name[$i] . "'
//                                    ,city_lat		= '" . $city_lat[$i] . "'
//                                    ,city_lng		= '" . $city_lng[$i] . "'
//                                    where city_idx	= '" . $city_idx[$i] . "'
//                            ";
//
//                        $connect->query($sql);
//                    }
//                }

            } else {
//                $dataProduct = [
//                    'product_idx' => $product_idx,
//                    'product_code_1' => $product_code_1,
//                    'product_code_2' => $product_code_2,
//                    'product_code_3' => $product_code_3,
//                    'product_code_4' => $product_code_4,
//                    'product_code_name_1' => $product_code_name_1,
//                    'product_code_name_2' => $product_code_name_2,
//                    'product_code_name_3' => $product_code_name_3,
//                    'product_code_name_4' => $product_code_name_4,
//                    'product_name' => $product_name,
//                    'product_air' => $product_air,
//                    'product_info' => $product_info,
//                    'product_schedule' => $product_schedule,
//                    'product_country' => $product_country,
//                    'rfile1' => $rfile_1,
//                    'rfile2' => $rfile_2,
//                    'rfile3' => $rfile_3,
//                    'rfile4' => $rfile_4,
//                    'rfile5' => $rfile_5,
//                    'rfile6' => $rfile_6,
//                    'ufile1' => $ufile_1,
//                    'ufile2' => $ufile_2,
//                    'ufile3' => $ufile_3,
//                    'ufile4' => $ufile_4,
//                    'ufile5' => $ufile_5,
//                    'ufile6' => $ufile_6,
//                    'ufile7' => $ufile_7,
//                    'is_view' => $is_view,
//                    'product_period' => $product_period,
//                    'product_manager' => $product_manager,
//                    'product_manager_id' => $product_manager_id,
//                    'original_price' => $original_price,
//                    'keyword' => $keyword,
//                    'product_price' => $product_price,
//                    'product_best' => $product_best,
//                    'special_price' => $special_price,
//                    'onum' => $onum,
//                    'product_contents' => $product_contents,
//                    'product_confirm' => $product_confirm,
//                    'product_confirm_m' => $product_confirm_m,
//                    'min_price' => $min_price,
//                    'max_price' => $max_price,
//                    'product_able' => $product_able,
//                    'product_unable' => $product_unable,
//                    'mobile_able' => $mobile_able,
//                    'mobile_unable' => $mobile_unable,
//                    'stay_list' => $stay_list,
//                    'country_list' => $country_list,
//                    'active_list' => $active_list,
//                    'sight_list' => $sight_list,
//                    'tour_period' => $tour_period,
//                    'tour_info' => $tour_info,
//                    'benefit' => $benefit,
//                    'local_info' => $local_info,
//                    'phone' => $phone,
//                    'email' => $email,
//                    'product_manager_2' => $product_manager_2,
//                    'phone_2' => $phone_2,
//                    'email_2' => $email_2,
//                    'product_route' => $product_route,
//                    'minium_people_cnt' => $minium_people_cnt,
//                    'total_people_cnt' => $total_people_cnt,
//                    'exchange' => $exchange,
//                    'jetlag' => $jetlag,
//                    'capital_city' => $capital_city,
//                    'user_id' => $session->get('member.id'),
//                    'user_level' => $session->get('member.level'),
//                    'information' => $information,
//                    'meeting_guide' => $meeting_guide,
//                    'meeting_place' => $meeting_place,
//                    'product_level' => $product_level,
//                    'product_option' => $product_option,
//                    'tours_cate' => $tours_cate,
//                    'yoil_0' => $yoil_0,
//                    'yoil_1' => $yoil_1,
//                    'yoil_2' => $yoil_2,
//                    'yoil_3' => $yoil_3,
//                    'yoil_4' => $yoil_4,
//                    'yoil_5' => $yoil_5,
//                    'yoil_6' => $yoil_6,
//                    'guide_lang' => $guide_lang,
//                    'tour_transport' => $tour_transport,
//                    'adult_text' => $adult_text,
//                    'kids_text' => $kids_text,
//                    'baby_text' => $baby_text,
//                    'm_date' => date('Y-m-d H:i:s'),
//                    'r_date' => date('Y-m-d H:i:s')
//                ];
//
//
//                $connect->table('tbl_product_mst')->insert($dataProduct);
//
//
//                $product_idx = $connect->insertID();
//
//                $connect->table('tbl_product_mst')
//                    ->set('product_code', 'T' . str_pad($product_idx, 5, "0", STR_PAD_LEFT))
//                    ->where('product_idx', $product_idx)
//                    ->update();
//
//                for ($i = 0; $i < count($city_name); $i++) {
//                    $dataCity = [
//                        'product_idx' => $product_idx,
//                        'city_name' => $city_name[$i],
//                        'city_lat' => $city_lat[$i],
//                        'city_lng' => $city_lng[$i],
//                        'r_date' => date('Y-m-d H:i:s')
//                    ];
//
//                    $connect->table('tbl_product_city')->insert($dataCity);
//                }

                $sql = "insert into tbl_product_mst SET 
                            product_idx				= '" . $product_idx . "'
                            ,product_code_1			= '" . $product_code_1 . "'
                            ,product_code_2			= '" . $product_code_2 . "'
                            ,product_code_3			= '" . $product_code_3 . "'
                            ,product_code_4			= '" . $product_code_4 . "'
                            ,product_code_name_1	= '" . $product_code_name_1 . "'
                            ,product_code_name_2	= '" . $product_code_name_2 . "'
                            ,product_code_name_3	= '" . $product_code_name_3 . "'
                            ,product_code_name_4	= '" . $product_code_name_4 . "'
                            ,product_name			= '" . $product_name . "'
                            ,product_air			= '" . $product_air . "'
                            ,product_info			= '" . $product_info . "'
                            ,product_schedule		= '" . $product_schedule . "'
                            ,product_country		= '" . $product_country . "'
                            ,rfile1					= '" . $rfile_1 . "'
                            ,rfile2					= '" . $rfile_2 . "'
                            ,rfile3					= '" . $rfile_3 . "'
                            ,rfile4					= '" . $rfile_4 . "'
                            ,rfile5					= '" . $rfile_5 . "'
                            ,rfile6					= '" . $rfile_6 . "'
                            ,ufile1					= '" . $ufile_1 . "'
                            ,ufile2					= '" . $ufile_2 . "'
                            ,ufile3					= '" . $ufile_3 . "'
                            ,ufile4					= '" . $ufile_4 . "'
                            ,ufile5					= '" . $ufile_5 . "'
                            ,ufile6					= '" . $ufile_6 . "'
                            ,ufile7					= '" . $ufile_7 . "'
                            ,is_view				= '" . $is_view . "'
                            ,product_period			= '" . $product_period . "'
                            ,product_manager		= '" . $product_manager . "'
                            ,product_manager_id		= '" . $product_manager_id . "'		
                            ,original_price			= '" . $original_price . "'
                            ,keyword				= '" . $keyword . "'
                            ,product_price			= '" . $product_price . "'
                            ,product_best			= '" . $product_best . "'
                            ,special_price			= '" . $special_price . "'
                            ,onum					= '" . $onum . "'
                            ,product_contents		= '" . $product_contents . "'
                            ,product_confirm		= '" . $product_confirm . "'
                            ,product_confirm_m		= '" . $product_confirm_m . "'
                            ,min_price				= '" . $min_price . "'
                            ,max_price				= '" . $max_price . "'
                            ,product_able			= '" . $product_able . "'
                            ,product_unable			= '" . $product_unable . "'
                            ,mobile_able			= '" . $mobile_able . "'
                            ,mobile_unable			= '" . $mobile_unable . "'
                
                            ,stay_list				= '" . $stay_list . "'
                            ,country_list			= '" . $country_list . "'
                            ,active_list			= '" . $active_list . "'
                            ,sight_list				= '" . $sight_list . "'
                            ,tour_period			= '" . $tour_period . "'
                            ,tour_info				= '" . $tour_info . "'
                
                            ,benefit				= '" . $benefit . "'
                            ,local_info				= '" . $local_info . "'
                            ,phone					= '" . $phone . "'
                            ,email 					= '" . $email . "'
                            ,product_manager_2		= '" . $product_manager_2 . "'	
                            ,phone_2				= '" . $phone_2 . "'
                            ,email_2				= '" . $email_2 . "'
                            ,product_route			= '" . $product_route . "'
                            ,minium_people_cnt		= '" . $minium_people_cnt . "'
                            ,total_people_cnt		= '" . $total_people_cnt . "'
                
                            ,exchange				= '" . $exchange . "'
                            ,jetlag					= '" . $jetlag . "'
                            ,capital_city			= '" . $capital_city . "'
                
                            ,user_id				= '" . $_SESSION['member']['id'] . "'
                            ,user_level				= '" . $_SESSION['member']['level'] . "'
                            ,information			= '" . $information . "'
                            ,meeting_guide          = '" . $meeting_guide . "'
                            ,meeting_place          = '" . $meeting_place . "'
                            ,product_level			= '" . $product_level . "'
                            ,product_option         = '" . $product_option . "'
                            ,tours_cate             = '" . $tours_cate . "'
                            ,yoil_0                 = '" . $yoil_0 . "'
                            ,yoil_1                 = '" . $yoil_1 . "'
                            ,yoil_2                 = '" . $yoil_2 . "'
                            ,yoil_3                 = '" . $yoil_3 . "'
                            ,yoil_4                 = '" . $yoil_4 . "'
                            ,yoil_5                 = '" . $yoil_5 . "'
                            ,yoil_6                 = '" . $yoil_6 . "'
                            ,guide_lang             = '" . $guide_lang . "'
                            ,tour_transport         = '" . $tour_transport . "'
                            ,adult_text             = '" . $adult_text . "'
                            ,kids_text              = '" . $kids_text . "'
                            ,baby_text              = '" . $baby_text . "'
                
                            ,m_date					= now()
                            ,r_date					= now()
                    ";

                $connect->query($sql);

                $product_idx = $connect->insert_id;

                $sql = "update tbl_product_mst SET 
                            product_code = 'T" . str_pad($product_idx, 5, "0", STR_PAD_LEFT) . "'
                            where product_idx = '" . $product_idx . "'
                    ";

                $connect->query($sql);

//                for ($i = 0; $i < count($city_name); $i++) {
//                    $sql = "insert into tbl_product_city SET
//                                product_idx		= '" . $product_idx . "'
//                                ,city_name		= '" . $city_name[$i] . "'
//                                ,city_lat		= '" . $city_lat[$i] . "'
//                                ,city_lng		= '" . $city_lng[$i] . "'
//                                ,r_date			= now()
//                        ";
//
//                    $connect->query($sql);
//                }
            }


            if ($product_idx) {
                $res = [
                    'message' => '상품정보 수정완료.',
                    'url' => ''
                ];
            } else {
                $res = [
                    'message' => '새 제품을 성공적으로 만들었습니다.',
                    'url' => ''
                ];
            }

            return $this->response->setStatusCode(200)->setJSON($res);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }
}
