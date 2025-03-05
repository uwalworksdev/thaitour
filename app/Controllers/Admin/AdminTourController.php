<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminTourController extends BaseController
{
    protected $connect;
    protected $tourProducts;
    protected $infoProducts;
    protected $productModel;
    protected $dayModel;
    protected $subSchedule;
    protected $mainSchedule;
    protected $code;
    protected $productImg;
    protected $tourImg;


    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->tourProducts = model("ProductTourModel");
        $this->infoProducts = model("TourInfoModel");
        $this->productModel = model("ProductModel");
        $this->dayModel     = model("DayModel");
        $this->subSchedule  = model("SubScheduleModel");
        $this->mainSchedule = model("MainScheduleModel");
        $this->code         = model("Code");
        $this->productImg = model("ProductImg");
        $this->tourImg = model("TourImg");
    }

    public function write_ok()
    {
        $connect = $this->connect;
        $session = session();

        try {
            $files = $this->request->getFiles();

            $upload = "../../data/product/";
            $product_idx         = updateSQ($_POST["product_idx" ?? '']);
            $product_code        = updateSQ($_POST["product_code" ?? '']);
            $product_code_1      = updateSQ($_POST["product_code_1" ?? '']);
            $product_code_2      = updateSQ($_POST["product_code_2" ?? '']);
            $product_code_3      = updateSQ($_POST["product_code_3" ?? '']);
            $product_code_4      = updateSQ($_POST["product_code_4" ?? '']);
            $product_code_name_1 = updateSQ($_POST["product_code_name_1" ?? '']);
            $product_code_name_2 = updateSQ($_POST["product_code_name_2" ?? '']);
            $product_code_name_3 = updateSQ($_POST["product_code_name_3" ?? '']);
            $product_code_name_4 = updateSQ($_POST["product_code_name_4" ?? '']);
            $product_name        = updateSQ($_POST["product_name" ?? '']);
            $product_name_en     = updateSQ($_POST["product_name_en" ?? '']);
            $product_air         = updateSQ($_POST["product_air" ?? '']);
            $product_info        = updateSQ($_POST["product_info" ?? '']);
            $product_schedule    = updateSQ($_POST["product_schedule" ?? '']);
            $product_country     = updateSQ($_POST["product_country" ?? '']);
            $is_view             = updateSQ($_POST["is_view" ?? '']);
            $product_status      = updateSQ($_POST["product_status" ?? '']);
            $product_period      = updateSQ($_POST["product_period" ?? '']);
            $product_manager     = updateSQ($_POST["product_manager" ?? '']);
            $product_manager_id  = updateSQ($_POST["product_manager_id" ?? '']);
            $direct_payment      = updateSQ($_POST["direct_payment" ?? 'N']);

            $original_price      = str_replace(",", "", updateSQ($_POST["original_price"] ?? ''));
            $min_price           = str_replace(",", "", updateSQ($_POST["min_price"] ?? ''));
            $max_price           = str_replace(",", "", updateSQ($_POST["max_price"] ?? ''));
            $keyword             = $_POST["keyword"] ?? '';
            $product_price       = str_replace(",", "", updateSQ($_POST["product_price"] ?? ''));
            $product_best        = updateSQ($_POST["product_best" ?? '']);
            if (isset($_POST['select_product'])) {
                $selected_products = $_POST['select_product'];
                if (is_array($selected_products)) {
                    $product_theme = implode('|', $selected_products) . '|';
                }
            } else {
                $product_theme = '';
            }

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

            $product_points = updateSQ($_POST["product_points" ?? '']);
            $addrs = updateSQ($_POST["addrs" ?? '']);
            $latitude = updateSQ($_POST["latitude" ?? '']);
            $longitude = updateSQ($_POST["longitude" ?? '']);
            $tours_guide = updateSQ($_POST["tours_guide" ?? '']);
            $tours_ko = updateSQ($_POST["tours_ko" ?? '']);
            $tours_join = updateSQ($_POST["tours_join" ?? '']);
            $tours_hour = updateSQ($_POST["tours_hour" ?? '']);
            $tours_total_hour = updateSQ($_POST["tours_total_hour" ?? '']);
            $time_line = updateSQ($_POST["time_line" ?? '']);
            $arr = $_POST["deadline_date"] ?? '';

            $mbti = updateSQ($_POST["mbti" ?? '']);

            if (!is_array($arr)) {
                $arr = [];
            }

            $deadline_date = "";
            for ($i = 0; $i < count($arr); $i++) {
                if ($i == 0) {
                    $deadline_date .= $arr[$i];
                } else {
                    $deadline_date .= "," . $arr[$i];
                }
            }

            $publicPath = ROOTPATH . '/public/data/product/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;
                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);

                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
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
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            $arr_i_idx = $this->request->getPost("i_idx") ?? [];
            $arr_tour_i_idx = $this->request->getPost("tour_i_idx") ?? [];

            if ($product_idx) {
                $sql = " select * from tbl_product_mst where product_idx = '" . $product_idx . "'";
                $row = $this->connect->query("$sql")->getRowArray();

                $data["ufile1"] = $data["ufile1"] ?? $row['ufile1'];
                $data["rfile1"] = $data["rfile1"] ?? $row['rfile1'];


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
                            ,product_name_en		= '" . $product_name_en . "'
                            ,product_air			= '" . $product_air . "'
                            ,product_info			= '" . $product_info . "'
                            ,product_schedule		= '" . $product_schedule . "'
                            ,product_country		= '" . $product_country . "'
                            ,is_view				= '" . $is_view . "'
                            ,product_status			= '" . $product_status . "'
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
							,product_theme          = '" . $product_theme . "'
                
                            ,stay_list				= '" . $stay_list . "'
                            ,country_list			= '" . $country_list . "'
                            ,active_list			= '" . $active_list . "'
                            ,sight_list				= '" . $sight_list . "'
                            
                            ,ufile1				    = '" . $data['ufile1'] . "'
                            ,rfile1				    = '" . $data['rfile1'] . "'
                
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
                            ,product_points         = '" . $product_points . "'
                            ,addrs                  = '" . $addrs . "'
                            ,latitude               = '" . $latitude . "'
                            ,longitude              = '" . $longitude . "'
                            ,tours_guide            = '" . $tours_guide . "'
                            ,tours_ko               = '" . $tours_ko . "'
                            ,tours_join             = '" . $tours_join . "'
                            ,tours_hour             = '" . $tours_hour . "'
                            ,tours_total_hour       = '" . $tours_total_hour . "'
                            ,time_line              = '" . $time_line . "'
							,deadline_date          = '" . $deadline_date . "'
							,direct_payment         = '" . $direct_payment . "'
							
							,mbti                   = '" . $mbti . "'
							
                            ,m_date					= now()
                        where product_idx = '" . $product_idx . "'
                    ";
                write_log($sql);
                $connect->query($sql);

                if (isset($files['tours_ufile'])) {
                    foreach ($arr_tour_i_idx as $key => $value) {
                        $file = $files['tours_ufile'][$key] ?? null;

                        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);

                        
                            if(!empty($value)){
                                $this->tourImg->updateData($value, [
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "m_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            }else{
                                $this->tourImg->insertData([
                                    "product_idx" => $product_idx,
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            }
                        }
                    }
                }

                if (isset($files['ufile'])) {
                    foreach ($arr_i_idx as $key => $value) {
                        $file = $files['ufile'][$key] ?? null;

                        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);

                        
                            if(!empty($value)){
                                $this->productImg->updateData($value, [
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "m_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            }else{
                                $this->productImg->insertData([
                                    "product_idx" => $product_idx,
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            }
                        }
                    }
                }

            } else {

                $count_product_code = $this->productModel->where("product_code", $product_code)->countAllResults();

                if ($count_product_code > 0) {
                    $message = "이미 있는 상품코드입니다. \n 다시 확인해주시기바랍니다.";
                    return "<script>
                                alert('$message');
                                parent.location.reload();
                            </script>";
                }

                $sql = "insert into tbl_product_mst SET 
                            product_idx				= '" . $product_idx . "'
                            ,product_code		    = '" . $product_code . "'
                            ,product_code_1			= '" . $product_code_1 . "'
                            ,product_code_2			= '" . $product_code_2 . "'
                            ,product_code_3			= '" . $product_code_3 . "'
                            ,product_code_4			= '" . $product_code_4 . "'
                            ,product_code_name_1	= '" . $product_code_name_1 . "'
                            ,product_code_name_2	= '" . $product_code_name_2 . "'
                            ,product_code_name_3	= '" . $product_code_name_3 . "'
                            ,product_code_name_4	= '" . $product_code_name_4 . "'
                            ,product_name			= '" . $product_name . "'
                            ,product_name_en		= '" . $product_name_en . "'
                            ,product_air			= '" . $product_air . "'
                            ,product_info			= '" . $product_info . "'
                            ,product_schedule		= '" . $product_schedule . "'
                            ,product_country		= '" . $product_country . "'
                            
                            ,ufile1				    = '" . $data["ufile1"] . "'               
                            ,rfile1				    = '" . $data["rfile1"] . "'
                            
                            ,is_view				= '" . $is_view . "'
                            ,product_status			= '" . $product_status . "'
                            ,product_period			= '" . $product_period . "'
                            ,product_manager		= '" . $product_manager . "'
                            ,product_manager_id		= '" . $product_manager_id . "'		
                            ,original_price			= '" . $original_price . "'
                            ,keyword				= '" . $keyword . "'
                            ,product_price			= '" . $product_price . "'
                            ,product_best			= '" . $product_best . "'
                            ,special_price			= '" . $special_price . "'
                            ,onum					= '" . $onum . "'
                            ,product_mileage		= '" . $product_mileage . "'
                            ,product_contents		= '" . $product_contents . "'
                            ,product_confirm		= '" . $product_confirm . "'
                            ,product_confirm_m		= '" . $product_confirm_m . "'
                            ,min_price				= '" . $min_price . "'
                            ,max_price				= '" . $max_price . "'
                            ,product_able			= '" . $product_able . "'
                            ,product_unable			= '" . $product_unable . "'
                            ,mobile_able			= '" . $mobile_able . "'
                            ,mobile_unable			= '" . $mobile_unable . "'
							,product_theme          = '" . $product_theme . "'
                
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
                            ,product_points         = '" . $product_points . "'
                            ,addrs                  = '" . $addrs . "'
                            ,latitude               = '" . $latitude . "'
                            ,longitude              = '" . $longitude . "'
                            ,tours_guide            = '" . $tours_guide . "'
                            ,tours_ko               = '" . $tours_ko . "'
                            ,tours_join             = '" . $tours_join . "'
                            ,tours_hour             = '" . $tours_hour . "'
                            ,tours_total_hour       = '" . $tours_total_hour . "'
                            ,time_line              = '" . $time_line . "'
							,direct_payment         = '" . $direct_payment . "'
                            
                            ,mbti                   = '" . $mbti . "'
                            
                            ,m_date					= now()
                            ,r_date					= now()
                    ";

                $connect->query($sql);

                $product_idx = $connect->insert_id;

                if (isset($files['tours_ufile'])) {
                    foreach ($arr_tour_i_idx as $key => $value) {
                        $file = $files['tours_ufile'][$key] ?? null;

                        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);

                            $this->tourImg->insertData([
                                "product_idx" => $product_idx,
                                "ufile" => $ufile,
                                "rfile" => $rfile,
                                "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }

                if (isset($files['ufile'])) {
                    foreach ($arr_i_idx as $key => $value) {
                        $file = $files['ufile'][$key] ?? null;

                        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);

                            $this->productImg->insertData([
                                "product_idx" => $product_idx,
                                "ufile" => $ufile,
                                "rfile" => $rfile,
                                "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }

                // $sql_pro = "UPDATE tbl_product_mst SET 
                //             product_code = 'T" . str_pad($product_idx, 5, "0", STR_PAD_LEFT) . "'
                //             where product_idx = '" . $product_idx . "'
                //             ";

                // $connect->query($sql_pro);
            }


            if ($product_idx) {
                $message = "수정되었습니다(Tour).";
                return "<script>
                    alert('$message');
                        parent.location.reload();
                    </script>";
            }

            $message = "정상적인 등록되었습니다(Tour).";
            return "<script>
                alert('$message');
                    parent.location.href='/AdmMaster/_tourRegist/list_tours';
                </script>";

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function write_info_ok()
    {
        $productIdx = $this->request->getPost('product_idx');
        $o_sdate = $this->request->getPost('o_sdate');
        $o_edate = $this->request->getPost('o_edate');
        $tours_subject = $this->request->getPost('tours_subject');
        $tour_price = $this->request->getPost('tour_price') ?? [];
        $tour_price_kids = $this->request->getPost('tour_price_kids') ?? [];
        $tour_price_baby = $this->request->getPost('tour_price_baby') ?? [];
        $status = $this->request->getPost('status');
        $tours_idx = $this->request->getPost('tours_idx');
        $info_idx = $this->request->getPost('info_idx');
        $tour_info_price = $this->request->getPost('tour_info_price');

        foreach ($tour_price as &$price) {
            $price = str_replace(",", "", $price);
        }
        foreach ($tour_price_kids as &$price) {
            $price = str_replace(",", "", $price);
        }
        foreach ($tour_price_baby as &$price) {
            $price = str_replace(",", "", $price);
        }

        $yoil_0 = $this->request->getPost('yoil_0');
        $yoil_1 = $this->request->getPost('yoil_1');
        $yoil_2 = $this->request->getPost('yoil_2');
        $yoil_3 = $this->request->getPost('yoil_3');
        $yoil_4 = $this->request->getPost('yoil_4');
        $yoil_5 = $this->request->getPost('yoil_5');
        $yoil_6 = $this->request->getPost('yoil_6');
        $info_ids = [];

        foreach ($o_sdate as $key => $start_date) {
            $info_id = isset($info_idx[$key]) ? $info_idx[$key] : null;

            var_dump($key);
            var_dump($info_idx);

            if ($info_id) {
                $infoIndex = $this->infoProducts->find($info_id);
            } else {
                $infoIndex = $this->infoProducts->where('product_idx', $productIdx)
                    ->where('o_sdate', $start_date)
                    ->first();
            }

            $infoData = [
                'product_idx' => $productIdx,
                'o_sdate' => $start_date,
                'o_edate' => isset($o_edate[$key]) ? $o_edate[$key] : null,
                'yoil_0' => isset($yoil_0[$key]) ? 'Y' : 'N',
                'yoil_1' => isset($yoil_1[$key]) ? 'Y' : 'N',
                'yoil_2' => isset($yoil_2[$key]) ? 'Y' : 'N',
                'yoil_3' => isset($yoil_3[$key]) ? 'Y' : 'N',
                'yoil_4' => isset($yoil_4[$key]) ? 'Y' : 'N',
                'yoil_5' => isset($yoil_5[$key]) ? 'Y' : 'N',
                'yoil_6' => isset($yoil_6[$key]) ? 'Y' : 'N',
                'tour_info_price' => isset($tour_info_price[$key]) ? $tour_info_price[$key] : null,
                'r_date' => date('Y-m-d H:i:s')
            ];

            if ($infoIndex) {
                if ($infoIndex['o_sdate'] !== $start_date) {
                    $infoData['o_sdate'] = $start_date;
                }
                $this->infoProducts->update($infoIndex['info_idx'], $infoData);
                $info_ids[] = $infoIndex['info_idx'];
            } else {
                $this->infoProducts->insert($infoData);
                $info_ids[] = $this->infoProducts->insertID();
            }
        }

        foreach ($info_ids as $index => $infoId) {
            if (isset($tours_subject[$index])) {
                foreach ($tours_subject[$index] as $i => $subject) {
                    if (!empty($subject)) {
                        $tourIdx = $tours_idx[$index][$i] ?? 'new';

                        $data = [
                            'product_idx'     => $productIdx,
                            'tours_subject'   => $subject,
                            'tour_price'      => isset($tour_price[$index][$i]) ? $tour_price[$index][$i] : null,
                            'tour_price_kids' => isset($tour_price_kids[$index][$i]) ? $tour_price_kids[$index][$i] : null,
                            'tour_price_baby' => isset($tour_price_baby[$index][$i]) ? $tour_price_baby[$index][$i] : null,
                            'status'          => isset($status[$index][$i]) ? $status[$index][$i] : null,
                            'info_idx'        => $infoId,
                            'r_date'          => date('Y-m-d H:i:s')
                        ];

                        if ($tourIdx == 'new' || empty($tourIdx)) {
                            $this->tourProducts->insert($data);
                        } else {
                            $this->tourProducts->update($tourIdx, $data);
                        }
                    }
                }
            }
        }

        foreach ($tours_idx as $index => $tourIds) {
            foreach ($tourIds as $i => $tourId) {
                $data = [
                    'tours_subject'   => $tours_subject[$index][$i] ?? null,
                    'tour_price'      => $tour_price[$index][$i] ?? null,
                    'tour_price_kids' => $tour_price_kids[$index][$i] ?? null,
                    'tour_price_baby' => $tour_price_baby[$index][$i] ?? null,
                    'status'          => $status[$index][$i] ?? null,
                    'r_date'          => date('Y-m-d H:i:s')
                ];

                if ($tourId && $tourId != 'new') {
                    $this->tourProducts->update($tourId, $data);
                } else {
                    $data['product_idx'] = $productIdx;
                    $data['info_idx']    = $infoId;
                    $this->tourProducts->insert($data);
                }
            }
        }

        return redirect()->to('AdmMaster/_tourRegist/write_tour_info?product_idx=' . $productIdx);
    }

    public function del_tours()
    {
        $info_idx = $this->request->getPost('info_idx');
        $tours_idx = $this->request->getPost('tours_idx');
        $db = $this->connect;
        $db->transStart();
        $infoDeleted = $this->infoProducts->where('info_idx', $info_idx)->delete();
        $tourDeleted = true;
        foreach ($tours_idx as $tours_idx) {
            if (!$this->tourProducts->where('tours_idx', $tours_idx)->delete()) {
                $tourDeleted = false;
                break;
            }
        }
        $db->transComplete();
        try {

            if ($db->transStatus() === FALSE || !$infoDeleted || !$tourDeleted) {
                $msg = "삭제 완료";
            } else {
                $msg = "삭제 오류";
            }
        } catch (\Exception $e) {
            $msg = "삭제 오류: " . $e->getMessage();
        }

        return $this->response->setJSON(['message' => $msg]);
    }

    public function del()
    {
        $product_idx = $this->request->getPost('product_idx');

        try {
            if ($this->productModel->where('product_idx', $product_idx)->set('product_status', 'D')->update()) {
                $msg = "정상적으로 삭제되었습니다.";
            } else {
                $msg = "오류가 발생하였습니다!";
            }
        } catch (\Exception $e) {
            $msg = "오류가 발생하였습니다!: " . $e->getMessage();
        }

        return $this->response->setJSON(['message' => $msg]);
    }

    public function detailwrite_new()
    {
        $productIdx = $this->request->getGet('product_idx');
        $airCode = $this->request->getGet('air_code') ?? '0000';

        $productDetail = $this->dayModel->getProductDetail($productIdx, $airCode);
        if (!$productDetail) {
            $this->dayModel->createProductDetail([
                'product_idx' => $productIdx,
                'air_code' => $airCode,
                'total_day' => 0
            ]);
            $productDetail = $this->dayModel->getProductDetail($productIdx, $airCode);
        }
        $detailIdx = $productDetail['idx'];

        $product = $this->productModel->find($productIdx);
        $airline = $this->code->where([
            'code_gubun' => 'air',
            'code_no' => $airCode,
            'status' => 'Y'
        ])->first();

        $scheduleDetails = $this->dayModel->where([
            'product_idx' => $productIdx,
            'air_code' => $airCode
        ])->findAll();

        $totalDays = $productDetail['total_day'];
        $schedules = [];

        for ($dd = 1; $dd <= $totalDays; $dd++) {
            $schedule = $this->mainSchedule->getByDetailAndDay($detailIdx, $dd);
            $schedules[$dd] = $schedule ?? [];
        }

        $maxGroup = $this->subSchedule->select('IFNULL(MAX(groups), 0) as new_group')
            ->where('detail_idx', $detailIdx)
            ->first()['new_group'] ?? 0;

        $maxOnum = $this->subSchedule->select('IFNULL(MAX(onum), 0) as new_onum')
            ->where('detail_idx', $detailIdx)
            ->first()['new_onum'] ?? 0;

        $subSchedules = [];
        foreach ($schedules as $day => $schedule) {
            if (!empty($schedule)) {
                $subScheduleDetails = $this->subSchedule
                    ->where('detail_idx', $detailIdx)
                    ->where('day_idx', $day)
                    ->findAll();

                foreach ($subScheduleDetails as $subSchedule) {
                    $subSchedules[$day][$subSchedule['groups']][] = $subSchedule;
                }
            } else {
                $subSchedules[$day] = [];
            }
        }

        $data = [
            'product_idx' => $productIdx,
            'air_code' => $airCode,
            'product' => $product,
            'airline' => $airline,
            'scheduleDetails' => $scheduleDetails,
            'maxGroup' => $maxGroup,
            'maxOnum' => $maxOnum,
            'schedules' => $schedules,
            'totalDays' => $totalDays,
            'subSchedules' => $subSchedules,
            'productDetail' => $productDetail,
            'idx' => $detailIdx
        ];
        return view("admin/_tourRegist/detailwrite_new", $data);
    }


    public function chg_detailwrite()
    {
        $product_idx = $this->request->getPost('product_idx');
        $air_code = $this->request->getPost('air_code');
        $sdate = $this->request->getPost('sdate');

        if (empty($product_idx) || empty($air_code)) {
            return $this->response->setStatusCode(400)->setBody("잘못된 페이지 접근입니다. 다시 접속해주세요.");
        }


        $result = $this->dayModel->updateSchedule($product_idx, $air_code, $sdate);

        if ($result) {
            return $this->response->setBody("OK");
        } else {
            return $this->response->setStatusCode(500)->setBody("오류 발생");
        }
    }

    public function day_seq_delete()
    {
        $daySeq = $this->request->getPost('idx');

        if ($daySeq) {
            $result = $this->dayModel->day_delete($daySeq);

            if ($result) {
                $msg = "일차전체 삭제 완료";
            } else {
                $msg = "일차전체 삭제 오류";
            }
            return $this->response->setJSON(['message' => $msg]);
        }

        return $this->response->setJSON(['message' => '일차 삭제에 필요한 데이터가 없습니다.']);
    }

    public function del_day()
    {
        $idx = $this->request->getPost('idx');
        if ($idx) {
            $ids = explode(",", $idx);
            $detail_idx = $ids[0];
            $dayIdx = $ids[1];
            $group = $ids[2];

            $isDeleted = $this->subSchedule->deleteDaySchedule($detail_idx, $dayIdx, $group);

            if ($isDeleted) {
                $msg = "일정전체 삭제 완료";
            } else {
                $msg = "일정전체 삭제 오류";
            }

            return $this->response->setJSON(['message' => $msg]);
        }

        return $this->response->setJSON(['message' => '잘못된 요청입니다.']);
    }


    public function detailwrite_new_ok()
    {
        $productIdx = $this->request->getPost('product_idx');
        $airCode = $this->request->getPost('air_code');
        $shopping = $this->request->getPost('shopping');
        $detailDesc = $this->request->getPost('detail_desc');
        $scheduleDate = $this->request->getPost('schedule_date');
        $detailTitle = $this->request->getPost('detail_title');
        $detailExperience1 = $this->request->getPost('detail_experience1');
        $detailExperience2 = $this->request->getPost('detail_experience2');
        $detailExperience3 = $this->request->getPost('detail_experience3');
        $hotelText = $this->request->getPost('hotel_text');
        $hotelList = $this->request->getPost('hotel_list');
        $breakfast = $this->request->getPost('breakfast');
        $lunch = $this->request->getPost('lunch');
        $dinner = $this->request->getPost('dinner');
        $detailSummary = $this->request->getPost('detail_summary');
        $detail_hour = $this->request->getPost('detail_hour');

        $productDetail = $this->dayModel->getProductDetail($productIdx, $airCode);

        if (!$productDetail) {
            return redirect()->back()->with('error', 'Product detail not found');
        }

        $detailIdx = $productDetail['idx'];
        $totalDay = $productDetail['total_day'];

        $this->dayModel->deleteMainScheduleByDetailIdx($detailIdx);

        for ($dd = 1; $dd <= $totalDay; $dd++) {
            $mainScheduleData = [
                'detail_idx' => $detailIdx,
                'day_idx' => $dd,
                'schedule_date' => $scheduleDate[$dd] ?? null,
                'detail_title' => $detailTitle[$dd] ?? '',
                'detail_experience1' => $detailExperience1[$dd] ?? '',
                'detail_experience2' => $detailExperience2[$dd] ?? '',
                'detail_experience3' => $detailExperience3[$dd] ?? '',
                'hotel_text' => $hotelText[$dd] ?? '',
                'hotel' => $hotelList[$dd] ?? '',
                'shopping' => $shopping ?? '',
                'meal1' => $breakfast[$dd] ?? '',
                'meal2' => $lunch[$dd] ?? '',
                'meal3' => $dinner[$dd] ?? '',
            ];
            $this->dayModel->insertMainSchedule($mainScheduleData);

            foreach ($detailSummary[$dd] as $group => $groupData) {
                foreach ($groupData as $orderNum => $summary) {
                    $subScheduleData = [
                        'detail_idx' => $detailIdx,
                        'day_idx' => $dd,
                        'groups' => $group,
                        'onum' => $orderNum,
                        'detail_desc' => $detailDesc[$dd][$group][$orderNum] ?? '',
                        'detail_summary' => updateSQ($summary) ?? '',
                        'detail_hour' => $detail_hour[$dd][$group][$orderNum] ?? '',
                    ];

                    if ($this->dayModel->subScheduleExists($detailIdx, $dd, $group, $orderNum)) {
                        $this->dayModel->updateSubSchedule($subScheduleData, $detailIdx, $dd, $group, $orderNum);
                    } else {
                        $this->dayModel->insertSubSchedule($subScheduleData);
                    }
                }
            }
        }

        return redirect()->to("AdmMaster/_tours/detailwrite_new?product_idx={$productIdx}&air_code={$airCode}")
            ->with('success', '등록 완료');
    }

    public function del_tour_option()
    {
        $tours_idx = $this->request->getPost('tours_idx');

        if ($tours_idx) {
            $result = $this->tourProducts->deleteTour($tours_idx);

            if ($result) {
                $msg = "일차전체 삭제 완료";
            } else {
                $msg = "일차전체 삭제 오류";
            }
            return $this->response->setJSON(['message' => $msg]);
        }

        return $this->response->setJSON(['message' => '일차 삭제에 필요한 데이터가 없습니다.']);
    }

    public function del_tour_img()
    {
        try {
            $i_idx = $_POST['i_idx'] ?? '';
            if (!isset($i_idx)) {
                $data = [
                    'result' => false,
                    'message' => 'idx가 설정되지 않았습니다!'
                ];
                return $this->response->setJSON($data, 400);
            }

            $result = $this->tourImg->updateData($i_idx, [
                'ufile' => '',
                'rfile' => ''
            ]);
            if (!$result) {
                $data = [
                    'result' => false,
                    'message' => '이미지 삭제 실패'
                ];
                return $this->response->setJSON($data, 400);
            }

            $data = [
                'result' => true,
                'message' => '사진을 삭제했습니다.'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

}
