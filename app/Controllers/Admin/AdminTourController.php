<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminTourController extends BaseController
{
    protected $connect;
    protected $tourProducts;
    protected $infoProducts;
    protected $productModel;


    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->tourProducts = model("ProductTourModel");
        $this->infoProducts = model("TourInfoModel");
        $this->productModel = model("ProductModel");
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

            $product_points = updateSQ($_POST["product_points" ?? '']);
            $addrs = updateSQ($_POST["addrs" ?? '']);
            $latitude = updateSQ($_POST["latitude" ?? '']);
            $longitude = updateSQ($_POST["longitude" ?? '']);
            $tours_guide = updateSQ($_POST["tours_guide" ?? '']);
            $tours_ko = updateSQ($_POST["tours_ko" ?? '']);
            $tours_join = updateSQ($_POST["tours_join" ?? '']);
            $tours_hour = updateSQ($_POST["tours_hour" ?? '']);
            $tours_total_hour = updateSQ($_POST["tours_total_hour" ?? '']);

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

            for ($i = 1; $i <= 6; $i++) {
                $file = isset($files["tours_ufile" . $i]) ? $files["tours_ufile" . $i] : null;

                if (isset(${"del_" . $i}) && ${"del_" . $i} === "Y") {
                    $sql = "UPDATE tbl_product_mst SET 
                            tours_ufile" . $i . "=''
                            WHERE product_idx='$product_idx'
                        ";

                    $connect->query($sql);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["tours_ufile$i"] = $file->getRandomName();
                    $publicPath = ROOTPATH . '/public/data/product/';
                    $file->move($publicPath, $data["tours_ufile$i"]);
                }
            }

            if ($product_idx) {
                $sql = " select * from tbl_product_mst where product_idx = '" . $product_idx . "'";
                $row = $this->connect->query("$sql")->getRowArray();

                $data["ufile1"] = $data["ufile1"] ?? $row['ufile1'];
                $data["ufile2"] = $data["ufile2"] ?? $row['ufile2'];
                $data["ufile3"] = $data["ufile3"] ?? $row['ufile3'];
                $data["ufile4"] = $data["ufile4"] ?? $row['ufile4'];
                $data["ufile5"] = $data["ufile5"] ?? $row['ufile5'];
                $data["ufile6"] = $data["ufile6"] ?? $row['ufile6'];
                $data["ufile7"] = $data["ufile7"] ?? $row['ufile7'];

                $data["rfile1"] = $data["rfile1"] ?? $row['rfile1'];
                $data["rfile2"] = $data["rfile2"] ?? $row['rfile2'];
                $data["rfile3"] = $data["rfile3"] ?? $row['rfile3'];
                $data["rfile4"] = $data["rfile4"] ?? $row['rfile4'];
                $data["rfile5"] = $data["rfile5"] ?? $row['rfile5'];
                $data["rfile6"] = $data["rfile6"] ?? $row['rfile6'];
                $data["rfile7"] = $data["rfile7"] ?? $row['rfile7'];

                $data["tours_ufile1"] = $data["tours_ufile1"] ?? $row['tours_ufile1'];
                $data["tours_ufile2"] = $data["tours_ufile2"] ?? $row['tours_ufile2'];
                $data["tours_ufile3"] = $data["tours_ufile3"] ?? $row['tours_ufile3'];
                $data["tours_ufile4"] = $data["tours_ufile4"] ?? $row['tours_ufile4'];
                $data["tours_ufile5"] = $data["tours_ufile5"] ?? $row['tours_ufile5'];
                $data["tours_ufile6"] = $data["tours_ufile6"] ?? $row['tours_ufile6'];

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
                            
                            ,ufile1				    = '" . $data["ufile1"] . "'
                            ,ufile2			        = '" . $data["ufile2"] . "'
                            ,ufile3			        = '" . $data["ufile3"] . "'
                            ,ufile4				    = '" . $data["ufile4"] . "'
                            ,ufile5				    = '" . $data["ufile5"] . "'
                            ,ufile6				    = '" . $data["ufile6"] . "'
                            ,ufile7				    = '" . $data["ufile7"] . "'
                            
                            ,rfile1				    = '" . $data["rfile1"] . "'
                            ,rfile2			        = '" . $data["rfile2"] . "'
                            ,rfile3			        = '" . $data["rfile3"] . "'
                            ,rfile4				    = '" . $data["rfile4"] . "'
                            ,rfile5				    = '" . $data["rfile5"] . "'
                            ,rfile6				    = '" . $data["rfile6"] . "'
                            ,rfile7				    = '" . $data["rfile7"] . "'


                            ,tours_ufile1		    = '" . $data["tours_ufile1"] . "'
                            ,tours_ufile2			= '" . $data["tours_ufile2"] . "'
                            ,tours_ufile3			= '" . $data["tours_ufile3"] . "'
                            ,tours_ufile4		    = '" . $data["tours_ufile4"] . "'
                            ,tours_ufile5		    = '" . $data["tours_ufile5"] . "'
                            ,tours_ufile6		    = '" . $data["tours_ufile6"] . "'
                
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
                            ,m_date					= now()
                        where product_idx = '" . $product_idx . "'
                    ";

                $connect->query($sql);

            } else {

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
                            
                            ,ufile1				    = '" . $data["ufile1"] . "'
                            ,ufile2			        = '" . $data["ufile2"] . "'
                            ,ufile3			        = '" . $data["ufile3"] . "'
                            ,ufile4				    = '" . $data["ufile4"] . "'
                            ,ufile5				    = '" . $data["ufile5"] . "'
                            ,ufile6				    = '" . $data["ufile6"] . "'
                            ,ufile7				    = '" . $data["ufile7"] . "'
                            
                            ,rfile1				    = '" . $data["rfile1"] . "'
                            ,rfile2			        = '" . $data["rfile2"] . "'
                            ,rfile3			        = '" . $data["rfile3"] . "'
                            ,rfile4				    = '" . $data["rfile4"] . "'
                            ,rfile5				    = '" . $data["rfile5"] . "'
                            ,rfile6				    = '" . $data["rfile6"] . "'
                            ,rfile7				    = '" . $data["rfile7"] . "'

                            ,tours_ufile1		    = '" . $data["tours_ufile1"] . "'
                            ,tours_ufile2			= '" . $data["tours_ufile2"] . "'
                            ,tours_ufile3			= '" . $data["tours_ufile3"] . "'
                            ,tours_ufile4		    = '" . $data["tours_ufile4"] . "'
                            ,tours_ufile5		    = '" . $data["tours_ufile5"] . "'
                            ,tours_ufile6		    = '" . $data["tours_ufile6"] . "'
                            
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
            }


            if ($product_idx) {
                $message = "수정되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.reload();
                    </script>";
            }

            $message = "등록되었습니다.";
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
        $tour_price = $this->request->getPost('tour_price'); 
        $tour_price_kids = $this->request->getPost('tour_price_kids'); 
        $tour_price_baby = $this->request->getPost('tour_price_baby'); 
        $status = $this->request->getPost('status');
        
        $yoil_0 = $this->request->getPost('yoil_0');
        $yoil_1 = $this->request->getPost('yoil_1');
        $yoil_2 = $this->request->getPost('yoil_2');
        $yoil_3 = $this->request->getPost('yoil_3');
        $yoil_4 = $this->request->getPost('yoil_4');
        $yoil_5 = $this->request->getPost('yoil_5');
        $yoil_6 = $this->request->getPost('yoil_6');
    
        $info_ids = [];
        foreach ($o_sdate as $key => $start_date) {
            $infoIndex = $this->infoProducts->where('product_idx', $productIdx)
                ->where('o_sdate', $start_date)
                ->first();
            
            $infoData = [
                'product_idx' => $productIdx,
                'o_sdate' => $start_date,
                'o_edate' => $o_edate[$key],
                'yoil_0' => isset($yoil_0) ? 'Y' : 'N',
                'yoil_1' => isset($yoil_1) ? 'Y' : 'N',
                'yoil_2' => isset($yoil_2) ? 'Y' : 'N',
                'yoil_3' => isset($yoil_3) ? 'Y' : 'N',
                'yoil_4' => isset($yoil_4) ? 'Y' : 'N',
                'yoil_5' => isset($yoil_5) ? 'Y' : 'N',
                'yoil_6' => isset($yoil_6) ? 'Y' : 'N',
                'r_date' => date('Y-m-d H:i:s')
            ];
    
            if ($infoIndex) {
                $this->infoProducts->update($infoIndex['info_idx'], $infoData);
                $info_ids[] = $infoIndex['info_idx'];
            } else {
                $this->infoProducts->insert($infoData);
                $info_ids[] = $this->infoProducts->insertID();
            }
        }
    
        foreach ($info_ids as $index => $info_idx) {
            foreach ($tours_subject[$index] as $i => $subject) {
                $tourIndex = $this->tourProducts->where('info_idx', $info_idx)
                    ->where('tours_subject', $subject)
                    ->first();
    
                $toursData = [
                    'product_idx' => $productIdx,
                    'info_idx' => $info_idx,
                    'tours_subject' => $subject,
                    'tour_price' => $tour_price[$index][$i],
                    'tour_price_kids' => $tour_price_kids[$index][$i],
                    'tour_price_baby' => $tour_price_baby[$index][$i],
                    'status' => isset($status[$index][$i]) ? $status[$index][$i] : 'Y', 
                    'r_date' => date('Y-m-d H:i:s')
                ];
    
                if ($tourIndex) {
                    $this->tourProducts->update($tourIndex['tour_idx'], $toursData);
                } else {
                    $this->tourProducts->insert($toursData);
                }
            }
        }


    return redirect()->to('AdmMaster/_tourRegist/write_tours?product_idx=' . $productIdx);
      
    }

    public function del_tours() {
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

    public function del() {
        $product_idx = $this->request->getPost('product_idx');

        try {
            if ($this->productModel->where('product_idx', $product_idx)->delete()) {
                $msg = "정상적으로 삭제되었습니다.";
            } else {
                $msg = "오류가 발생하였습니다!";
            }
        } catch (\Exception $e) {
            $msg = "오류가 발생하였습니다!: " . $e->getMessage();
        }

        return $this->response->setJSON(['message' => $msg]);
    }
}
