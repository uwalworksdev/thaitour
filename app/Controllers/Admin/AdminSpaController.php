<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;
use DateTime;
use Exception;

class AdminSpaController extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $productPriceModel;
    protected $productChargeModel;
    protected $tblCode;
    protected $toursMoption;
    protected $toursOption;
    protected $productImg;
    protected $productSpas;
    protected $productSpasInfo;
    protected $spasMoption;
    protected $spasOption;
    protected $spasPrice;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
        $this->productPriceModel = model("ProductPrice");
        $this->productChargeModel = model("ProductCharge");
        $this->tblCode = model("Code");
        $this->toursMoption = model("ToursMoption");
        $this->toursOption = model("ToursOption");
        $this->productImg = model("ProductImg");
        $this->productSpas = model("ProductSpasModel");
        $this->productSpasInfo = model("SpasInfoModel");
        $this->spasMoption = model("SpasMoptionModel");
        $this->spasOption = model("SpasOptionModel");
        $this->spasPrice = model("SpasPrice");
    }

    public function write_new()
    {
        $back_url = updateSQ($_GET["back_url"]);
        $product_idx = updateSQ($_GET["product_idx"]);
        $yoil_idx = updateSQ($_GET["yoil_idx"]);
        $parent_yoil_idx = updateSQ($_GET["parent_yoil_idx"]);
        $pg = updateSQ($_GET["pg"]);
        $search_name = updateSQ($_GET["search_name"]);
        $search_category = updateSQ($_GET["search_category"]);
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"]);
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"]);
        $s_product_code_3 = updateSQ($_GET["s_product_code_3"]);

        $row = $this->productChargeModel->getByYoilAndProduct($yoil_idx, $product_idx);

        $prod_info = $row["prod_info"];
        $deadline_date = explode(",", $row["deadline_date"]);
        $deadline_date = array_filter($deadline_date, function ($value) {
            return $value;
        });

        $row = $this->productModel->getById($product_idx);
        $product_name = viewSQ($row["product_name"]);
        $product_code_1 = $row["product_code_1"];
        $s_station = $row["CodeF"];
        if ($parent_yoil_idx) {
            $row = $this->productPriceModel->getById($parent_yoil_idx);
            $min_date = $row["s_date"];
            $max_date = $row["e_date"];

            $yoil_0 = $row["yoil_0"];
            $yoil_1 = $row["yoil_1"];
            $yoil_2 = $row["yoil_2"];
            $yoil_3 = $row["yoil_3"];
            $yoil_4 = $row["yoil_4"];
            $yoil_5 = $row["yoil_5"];
            $yoil_6 = $row["yoil_6"];

            $m_date = $row["m_date"];
            $r_date = $row["r_date"];

            $yoilStr = "";
            if ($row["yoil_0"] == "Y") {
                $yoilStr = $yoilStr . "일, ";
            }
            if ($row["yoil_1"] == "Y") {
                $yoilStr = $yoilStr . "월, ";
            }
            if ($row["yoil_2"] == "Y") {
                $yoilStr = $yoilStr . "화, ";
            }
            if ($row["yoil_3"] == "Y") {
                $yoilStr = $yoilStr . "수, ";
            }
            if ($row["yoil_4"] == "Y") {
                $yoilStr = $yoilStr . "목, ";
            }
            if ($row["yoil_5"] == "Y") {
                $yoilStr = $yoilStr . "금, ";
            }
            if ($row["yoil_6"] == "Y") {
                $yoilStr = $yoilStr . "토, ";
            }
            $yoilStr = substr($yoilStr, 0, strlen($yoilStr) - 2);
        }

        if ($yoil_idx) {
            $row = $this->productPriceModel->getById($yoil_idx);
            $s_date = $row["s_date"];
            $e_date = $row["e_date"];

            $yoil_0 = $row["yoil_0"];
            $yoil_1 = $row["yoil_1"];
            $yoil_2 = $row["yoil_2"];
            $yoil_3 = $row["yoil_3"];
            $yoil_4 = $row["yoil_4"];
            $yoil_5 = $row["yoil_5"];
            $yoil_6 = $row["yoil_6"];
            $sale = $row["sale"];

            $m_date = $row["m_date"];
            $r_date = $row["r_date"];

        }

        $fresult2 = $this->productChargeModel->getByYoilAndProduct($yoil_idx, $product_idx, 'seq', 'asc');

        $data = [
            "product_idx" => $product_idx ?? '',
            "yoil_idx" => $yoil_idx ?? '',
            "parent_yoil_idx" => $parent_yoil_idx ?? '',
            "pg" => $pg ?? '',
            "search_name" => $search_name ?? '',
            "search_category" => $search_category ?? '',
            "s_product_code_1" => $s_product_code_1 ?? '',
            "s_product_code_2" => $s_product_code_2 ?? '',
            "s_product_code_3" => $s_product_code_3 ?? '',
            "product_name" => $product_name ?? '',
            "product_code_1" => $product_code_1 ?? '',
            "product_code_2" => $product_code_2 ?? '',
            "product_code_3" => $product_code_3 ?? '',
            "product_code_4" => $product_code_4 ?? '',
            "product_code_name_1" => $product_code_name_1 ?? '',
            "product_code_name_2" => $product_code_name_2 ?? '',
            "product_code_name_3" => $product_code_name_3 ?? '',
            "product_code_name_4" => $product_code_name_4 ?? '',
            "product_air" => $product_air ?? '',
            "time_line" => $time_line ?? '',
            "s_station" => $s_station ?? '',
            "product_info" => $product_info ?? '',
            "prod_info" => $prod_info ?? '',
            "yoil_0" => $yoil_0 ?? '',
            "yoil_1" => $yoil_1 ?? '',
            "yoil_2" => $yoil_2 ?? '',
            "yoil_3" => $yoil_3 ?? '',
            "yoil_4" => $yoil_4 ?? '',
            "yoil_5" => $yoil_5 ?? '',
            "yoil_6" => $yoil_6 ?? '',
            "min_date" => $min_date ?? '',
            "max_date" => $max_date ?? '',
            "s_date" => $s_date ?? '',
            "e_date" => $e_date ?? '',
            "m_date" => $m_date ?? '',
            "r_date" => $r_date ?? '',
            "sale" => $sale ?? '',
            "fresult2" => $fresult2 ?? [],
        ];

        return view('admin/_spa/write_new', $data);
    }

    public function write_new_ok()
    {
        try {
            $msg = '';
            $p_idx = $_POST['p_idx'];

            $connect = $this->connect;
            $session = session();

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function write_ok()
    {
        $connect = $this->connect;
        $session = session();
        try {
            $files = $this->request->getFiles();
            $pg = updateSQ($_POST["pg"] ?? '');
            $search_name = updateSQ($_POST["search_name"] ?? '');
            $search_category = updateSQ($_POST["search_category"] ?? '');
            $upload = "../../data/product/";
            $product_idx = updateSQ($_POST["product_idx"] ?? '');
            $product_code = updateSQ($_POST["product_code" ?? '']);
            $product_code_1 = updateSQ($_POST["product_code_1"] ?? '');
            $product_code_2 = updateSQ($_POST["product_code_2"] ?? '');
            $product_code_3 = updateSQ($_POST["product_code_3"] ?? '');
            $product_code_4 = updateSQ($_POST["product_code_4"] ?? '');
            $product_code_name_1 = updateSQ($_POST["product_code_name_1"] ?? '');
            $product_code_name_2 = updateSQ($_POST["product_code_name_2"] ?? '');
            $product_code_name_3 = updateSQ($_POST["product_code_name_3"] ?? '');
            $product_code_name_4 = updateSQ($_POST["product_code_name_4"] ?? '');
            $product_name = updateSQ($_POST["product_name"] ?? '');
            $product_name_en = updateSQ($_POST["product_name_en"] ?? '');
            $product_air = updateSQ($_POST["product_air"] ?? '');
            $product_info = updateSQ($_POST["product_info"] ?? '');
            $product_schedule = updateSQ($_POST["product_schedule"] ?? '');
            $product_country = updateSQ($_POST["product_country"] ?? '');
            $time_line = updateSQ($_POST["time_line"] ?? '');
            $is_view = updateSQ($_POST["is_view"] ?? 'Y');
            $product_period = updateSQ($_POST["product_period"] ?? '');
            $product_manager = updateSQ($_POST["product_manager"] ?? '');
            $product_manager_id = updateSQ($_POST["product_manager_id"] ?? '');
            $original_price = str_replace(",", "", updateSQ($_POST["original_price"]) ?? '');
            $min_price = str_replace(",", "", updateSQ($_POST["min_price"]) ?? 0);
            $max_price = str_replace(",", "", updateSQ($_POST["max_price"]) ?? 0);
            $keyword = $_POST["keyword"];
            $product_price = str_replace(",", "", updateSQ($_POST["product_price"]) ?? '');
            $product_best = updateSQ($_POST["product_best"] ?? '');
            $onum = updateSQ($_POST["onum"] ?? '');

            $product_status = updateSQ($_POST["product_status"] ?? '');

            $product_contents = updateSQ($_POST["product_contents"] ?? '');
            $product_contents_m = updateSQ($_POST["product_contents_m"] ?? '');

            $product_confirm = updateSQ($_POST["product_confirm"] ?? '');
            $product_confirm_m = updateSQ($_POST["product_confirm_m"] ?? '');
            $product_able = updateSQ($_POST["product_able"] ?? '');
            $product_unable = updateSQ($_POST["product_unable"] ?? '');
            $mobile_able = updateSQ($_POST["mobile_able"] ?? '');
            $mobile_unable = updateSQ($_POST["mobile_unable"] ?? '');
            $special_benefit = updateSQ($_POST["special_benefit"] ?? '');
            $special_benefit_m = updateSQ($_POST["special_benefit_m"] ?? '');
            $notice_comment = updateSQ($_POST["notice_comment"] ?? '');
            $notice_comment_m = updateSQ($_POST["notice_comment_m"] ?? '');
            $etc_comment = updateSQ($_POST["etc_comment"] ?? '');
            $etc_comment_m = updateSQ($_POST["etc_comment_m"] ?? '');
            $main_top_best = updateSQ($_POST["main_top_best"] ?? '');
            $main_theme_best = updateSQ($_POST["main_theme_best"] ?? '');

            $benefit = updateSQ($_POST["benefit"] ?? '');
            $local_info = updateSQ($_POST["local_info"] ?? '');
            $phone = updateSQ($_POST["phone"] ?? '');
            $email = updateSQ($_POST["email"] ?? '');
            $phone_2 = updateSQ($_POST["phone_2"] ?? '');
            $email_2 = updateSQ($_POST["email_2"] ?? '');
            $product_route = updateSQ($_POST["product_route"] ?? '');

            $minium_people_cnt = 0;
            $total_people_cnt = 0;

            $stay_list = updateSQ($_POST["stay_list"] ?? '');
            $country_list = updateSQ($_POST["country_list"] ?? '');
            $active_list = updateSQ($_POST["active_list"] ?? '');
            $sight_list = updateSQ($_POST["sight_list"] ?? '');
            $tour_period = updateSQ($_POST["tour_period"] ?? '');
            $tour_info = updateSQ($_POST["tour_info"] ?? '');
            $tour_detail = updateSQ($_POST["tour_detail"] ?? '');
            $product_mileage = updateSQ($_POST["product_mileage"] ?? '');

            $exchange = updateSQ($_POST["exchange"] ?? '');
            $jetlag = 0;
            $capital_city = updateSQ($_POST["capital_city"] ?? '');
            $information = updateSQ($_POST["information"] ?? '');
            $meeting_guide = updateSQ($_POST["meeting_guide"] ?? '');
            $meeting_place = updateSQ($_POST["meeting_place"] ?? '');
            $product_level = updateSQ($_POST["product_level"] ?? '');
            $product_option = updateSQ($_POST["product_option"] ?? '');
            $coupon_y = updateSQ($_POST["coupon_y"] ?? '');
            $special_price = updateSQ($_POST["special_price"] ?? '');

            $adult_text = updateSQ($_POST["adult_text"] ?? '');
            $kids_text = updateSQ($_POST["kids_text"] ?? '');
            $baby_text = updateSQ($_POST["baby_text"] ?? '');

            $addrs = updateSQ($_POST["addrs"] ?? '');

            $latitude = updateSQ($_POST["latitude"] ?? '');
            $longitude = updateSQ($_POST["longitude"] ?? '');

            $product_type = updateSQ($_POST["product_type"] ?? '');

            $code_utilities = updateSQ($_POST["code_utilities"] ?? '');
            $code_services = updateSQ($_POST["code_services"] ?? '');
            $code_best_utilities = updateSQ($_POST["code_best_utilities"] ?? '');
            $code_populars = updateSQ($_POST["code_populars"] ?? '');
            $available_period = updateSQ($_POST["available_period"] ?? '');
            $deadline_time = updateSQ($_POST["deadline_time"] ?? '');

            $mbti = updateSQ($_POST["mbti" ?? '']);
            $note_news = updateSQ($_POST["note_news" ?? '']);

            $company_name = updateSQ($_POST["company_name" ?? '']);
            $company_contact = updateSQ($_POST["company_contact" ?? '']);
            $company_url = updateSQ($_POST["company_url" ?? '']);
            $company_notes = updateSQ($_POST["company_notes" ?? '']);

//            $dataProductMore = new stdClass();

            $dataProductMore = "";

            $meet_out_time = $_POST['meet_out_time'] ?? '';
            $children_policy = $_POST['children_policy'] ?? '';
            $baby_beds = $_POST['baby_beds'] ?? '';
            $deposit_regulations = $_POST['deposit_regulations'] ?? '';
            $pets = $_POST['pets'] ?? '';
            $age_restriction = $_POST['age_restriction'] ?? '';
            $smoking_policy = $_POST['smoking_policy'] ?? '';
            $breakfast = $_POST['breakfast'] ?? '';

            $breakfast_item_name_arr = $_POST['breakfast_item_name_'];
            $breakfast_item_value_arr = $_POST['breakfast_item_value_'];

            $dataBreakfast = "";
            foreach ($breakfast_item_name_arr as $key => $value) {
                $txt = $breakfast_item_name_arr[$key] . "::::" . $breakfast_item_value_arr[$key];
                $dataBreakfast .= $txt . "||||";
            }

            $dataProductMore .= $meet_out_time . '$$$$' . $children_policy;
            $dataProductMore .= '$$$$' . $baby_beds . '$$$$' . $deposit_regulations;
            $dataProductMore .= '$$$$' . $pets . '$$$$' . $age_restriction;
            $dataProductMore .= '$$$$' . $smoking_policy . '$$$$' . $breakfast;
            $dataProductMore .= '$$$$' . $dataBreakfast;

            $data['product_more'] = $dataProductMore;

            $data = [];

            $publicPath = ROOTPATH . '/public/data/product/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;
                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);

                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->productModel->update($product_idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            $product_code_list = $product_code_1 . '|' . $product_code_2 . '|' . $product_code_3 . '|' . $product_code_4;

            $arr_i_idx = $this->request->getPost("i_idx") ?? [];
            $arr_onum = $this->request->getPost("onum_img") ?? [];
            $files = $this->request->getFileMultiple('ufile');

            if ($product_idx) {
                $row = $this->productModel->getById($product_idx);

                $data["ufile1"] = $data["ufile1"] ?? $row['ufile1'];
                $data["rfile1"] = $data["rfile1"] ?? $row['rfile1'];

                $data = [
                    'product_code_1' => updateSQ($product_code_1),
                    'product_code_2' => updateSQ($product_code_2),
                    'product_code_3' => updateSQ($product_code_3),
                    'product_code_4' => updateSQ($product_code_4),
                    'product_code_list' => updateSQ($product_code_list),
                    'product_code_name_1' => updateSQ($product_code_name_1),
                    'product_code_name_2' => updateSQ($product_code_name_2),
                    'product_code_name_3' => updateSQ($product_code_name_3),
                    'product_code_name_4' => updateSQ($product_code_name_4),
                    'product_name' => updateSQ($product_name),
                    'product_name_en' => updateSQ($product_name_en),
                    'product_air' => updateSQ($product_air),
                    'time_line' => updateSQ($time_line),
                    'product_info' => updateSQ($product_info),
                    'product_schedule' => updateSQ($product_schedule),
                    'product_country' => updateSQ($product_country),
                    'is_view' => updateSQ($is_view),
                    'product_period' => updateSQ($product_period),
                    'product_manager' => updateSQ($product_manager),
                    'product_manager_id' => updateSQ($product_manager_id),
                    'original_price' => updateSQ($original_price),
                    'min_price' => updateSQ($min_price),
                    'max_price' => updateSQ($max_price),
                    'keyword' => updateSQ($keyword),
                    'product_price' => updateSQ($product_price),
                    'product_best' => updateSQ($product_best),
                    'onum' => updateSQ($onum),
                    'product_status' => $product_status,
                    'product_contents' => updateSQ($product_contents),
                    'product_contents_m' => updateSQ($product_contents_m),
                    'product_confirm' => updateSQ($product_confirm),
                    'product_confirm_m' => updateSQ($product_confirm_m),
                    'product_able' => updateSQ($product_able),
                    'product_unable' => updateSQ($product_unable),
                    'mobile_able' => updateSQ($mobile_able),
                    'mobile_unable' => updateSQ($mobile_unable),
                    'special_benefit' => updateSQ($special_benefit),
                    'special_benefit_m' => updateSQ($special_benefit_m),
                    'notice_comment' => updateSQ($notice_comment),
                    'notice_comment_m' => updateSQ($notice_comment_m),
                    'etc_comment' => updateSQ($etc_comment),
                    'etc_comment_m' => updateSQ($etc_comment_m),
                    'stay_list' => updateSQ($stay_list),
                    'country_list' => updateSQ($country_list),
                    'active_list' => updateSQ($active_list),
                    'sight_list' => updateSQ($sight_list),
                    'benefit' => updateSQ($benefit),
                    'local_info' => updateSQ($local_info),
                    'phone' => updateSQ($phone),
                    'email' => updateSQ($email),
                    'product_manager_2' => updateSQ($product_manager_2),
                    'phone_2' => updateSQ($phone_2),
                    'email_2' => updateSQ($email_2),
                    'product_route' => updateSQ($product_route),
                    'minium_people_cnt' => updateSQ($minium_people_cnt),
                    'total_people_cnt' => updateSQ($total_people_cnt),
                    'tour_period' => updateSQ($tour_period),
                    'tour_info' => updateSQ($tour_info),
                    'tour_detail' => updateSQ($tour_detail),
                    'product_mileage' => updateSQ($product_mileage),
                    'exchange' => updateSQ($exchange),
                    'jetlag' => updateSQ($jetlag),
                    'main_top_best' => updateSQ($main_top_best),
                    'main_theme_best' => updateSQ($main_theme_best),
                    'capital_city' => updateSQ($capital_city),
                    'information' => updateSQ($information),
                    'meeting_guide' => updateSQ($meeting_guide),
                    'meeting_place' => updateSQ($meeting_place),
                    'product_level' => updateSQ($product_level),
                    'product_option' => updateSQ($product_option),
                    'coupon_y' => updateSQ($coupon_y),
                    'special_price' => updateSQ($special_price),
                    'adult_text' => updateSQ($adult_text),
                    'kids_text' => updateSQ($kids_text),
                    'baby_text' => updateSQ($baby_text),
                    'addrs' => updateSQ($addrs),
                    'longitude' => updateSQ($longitude),
                    'latitude' => updateSQ($latitude),
                    'product_type' => updateSQ($product_type),
                    'code_utilities' => updateSQ($code_utilities),
                    'code_services' => updateSQ($code_services),
                    'code_best_utilities' => updateSQ($code_best_utilities),
                    'code_populars' => updateSQ($code_populars),
                    'available_period' => updateSQ($available_period),
                    'deadline_time' => updateSQ($deadline_time),
                    'note_news' => updateSQ($note_news),
                    'm_date' => 'now()',
                    'ufile1' => updateSQ($data['ufile1']),
                    'rfile1' => updateSQ($data['rfile1']),
                    'company_name' => updateSQ($company_name),
                    'company_contact' => updateSQ($company_contact),
                    'company_url' => updateSQ($company_url),
                    'company_notes' => updateSQ($company_notes)
                ];

                $data['mbti']           = $_POST["mbti"] ?? $mbti;
                $data['direct_payment'] = $_POST["direct"];

                $data['worker_id']   = session()->get('member')['id'];
                $data['worker_name'] = session()->get('member')['name'];

                $this->productModel->updateData($product_idx, $data);

                if (count($files) > 40) {
                    $message = "40개 이미지로 제한이 있습니다.";
                    return "<script>
                        alert('$message');
                        parent.location.reload();
                        </script>";
                }
   
                if (isset($files) && count($files) > 0) {
                    foreach ($files as $key => $file) {
                        $i_idx = $arr_i_idx[$key] ?? null;

                        if (!empty($i_idx)) {
                            $this->productImg->updateData($i_idx, [
                                "onum" => $arr_onum[$key],
                            ]);
                        }

                        if ($file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);
                
                            if (!empty($i_idx)) {
                                $this->productImg->updateData($i_idx, [
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "m_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            } else {
                                $this->productImg->insertData([
                                    "product_idx" => $product_idx,
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "onum" => $arr_onum[$key],
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

                $data = [
                    'product_code' => $product_code ?? '',
                    'product_code_1' => $product_code_1 ?? '',
                    'product_code_2' => $product_code_2 ?? '',
                    'product_code_3' => $product_code_3 ?? '',
                    'product_code_4' => $product_code_4 ?? '',
                    'product_code_list' => $product_code_list ?? '',
                    'product_code_name_1' => $product_code_name_1 ?? '',
                    'product_code_name_2' => $product_code_name_2 ?? '',
                    'product_code_name_3' => $product_code_name_3 ?? '',
                    'product_code_name_4' => $product_code_name_4 ?? '',
                    'product_name' => $product_name ?? '',
                    'product_name_en' => $product_name_en ?? '',
                    'product_air' => $product_air ?? '',
                    'time_line' => $time_line ?? '',
                    'product_info' => $product_info ?? '',
                    'product_status' => $product_status,
                    'product_schedule' => $product_schedule ?? '',
                    'product_country' => $product_country ?? '',
                    'is_view' => $is_view ?? 'Y',
                    'product_period' => $product_period ?? '',
                    'product_manager' => $product_manager ?? '',
                    'product_manager_id' => $product_manager_id ?? '',
                    'original_price' => $original_price ?? '',
                    'keyword' => $keyword ?? '',
                    'product_confirm' => updateSQ($product_confirm) ?? '',
                    'special_benefit' => updateSQ($special_benefit) ?? '',
                    'product_price' => $product_price ?? '',
                    'product_best' => $product_best ?? '',
                    'onum' => $onum ?? '',
                    'product_contents' => $product_contents ?? '',
                    'product_contents_m' => $product_contents_m ?? '',
                    'min_price' => $min_price ?? '',
                    'max_price' => $max_price ?? '',
                    'product_able' => $product_able ?? '',
                    'product_unable' => $product_unable ?? '',
                    'mobile_able' => $mobile_able ?? '',
                    'mobile_unable' => $mobile_unable ?? '',
                    'notice_comment' => $notice_comment ?? '',
                    'notice_comment_m' => $notice_comment_m ?? '',
                    'etc_comment' => $etc_comment ?? '',
                    'etc_comment_m' => $etc_comment_m ?? '',
                    'stay_list' => $stay_list ?? '',
                    'country_list' => $country_list ?? '',
                    'active_list' => $active_list ?? '',
                    'sight_list' => $sight_list ?? '',
                    'tour_period' => $tour_period ?? '',
                    'tour_info' => $tour_info ?? '',
                    'tour_detail' => $tour_detail ?? '',
                    'benefit' => $benefit ?? '',
                    'local_info' => $local_info ?? '',
                    'phone' => $phone ?? '',
                    'email' => $email ?? '',
                    'product_manager_2' => $product_manager_2 ?? '',
                    'phone_2' => $phone_2 ?? '',
                    'email_2' => $email_2 ?? '',
                    'product_route' => $product_route ?? '',
                    'minium_people_cnt' => $minium_people_cnt ?? '',
                    'total_people_cnt' => $total_people_cnt ?? '',
                    'exchange' => $exchange ?? '',
                    'capital_city' => $capital_city ?? '',
                    'user_id' => $_SESSION['member']['id'] ?? '',
                    'user_level' => $_SESSION['member']['level'] ?? '',
                    'information' => $information ?? '',
                    'meeting_guide' => $meeting_guide ?? '',
                    'meeting_place' => $meeting_place ?? '',
                    'product_level' => $product_level ?? '',
                    'product_option' => $product_option ?? '',
                    'coupon_y' => $coupon_y ?? '',
                    'special_price' => $special_price ?? '',
                    'adult_text' => $adult_text ?? '',
                    'kids_text' => $kids_text ?? '',
                    'baby_text' => $baby_text ?? '',
                    'addrs' => $addrs ?? '',
                    'longitude' => $longitude ?? '',
                    'latitude' => $latitude ?? '',
                    'product_type' => $product_type ?? '',
                    'code_utilities' => $code_utilities ?? '',
                    'code_services' => $code_services ?? '',
                    'code_best_utilities' => $code_best_utilities ?? '',
                    'code_populars' => $code_populars ?? '',
                    'available_period' => $available_period ?? '',
                    'deadline_time' => $deadline_time ?? '',
                    'product_more' => $dataProductMore ?? '',
                    'note_news' => $note_news,
                    'm_date' => date('Y-m-d H:i:s') ?? '',
                    'r_date' => date('Y-m-d H:i:s') ?? '',
                    'jetlag' => $jetlag ?? 0,
                    'ufile1' => $data['ufile1'] ?? '',
                    'rfile1' => $data["rfile1"] ?? '',
                    'company_name' => updateSQ($company_name),
                    'company_contact' => updateSQ($company_contact),
                    'company_url' => updateSQ($company_url),
                    'company_notes' => updateSQ($company_notes)
                ];

                $data['mbti']           = $_POST["mbti"] ?? $mbti;
                $data['direct_payment'] = $_POST["direct"];

                $insertId = $this->productModel->insert($data);

                if (count($files) > 40) {
                    $message = "40개 이미지로 제한이 있습니다.";
                    return "<script>
                        alert('$message');
                        parent.location.reload();
                        </script>";
                }

                if (isset($files)) {
                    foreach ($files as $key => $file) {

                        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);

                            $this->productImg->insertData([
                                "product_idx" => $insertId,
                                "ufile" => $ufile,
                                "rfile" => $rfile,
                                "onum" => $arr_onum[$key],
                                "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }
            }

            if ($product_idx) {
                $message = "수정되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.reload();
                    </script>";
            }

            $message = "정상적인 등록되었습니다.";
            return "<script>
                alert('$message');
                    parent.location.href='/AdmMaster/_tourRegist/list_spas';
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
        $productIdx         = $this->request->getPost('product_idx');
        $o_sdate            = $this->request->getPost('o_sdate');
        $o_edate            = $this->request->getPost('o_edate');
        $spas_subject       = $this->request->getPost('spas_subject');
        $spas_subject_eng   = $this->request->getPost('spas_subject_eng') ?? [];
        $spas_price         = $this->request->getPost('spas_price') ?? [];
        $spas_price_kids    = $this->request->getPost('spas_price_kids') ?? [];
        $spas_price_baby    = $this->request->getPost('spas_price_baby') ?? [];
        $status             = $this->request->getPost('status');
        $spas_idx           = $this->request->getPost('spas_idx');
        $info_idx           = $this->request->getPost('info_idx');
        $spas_info_price    = $this->request->getPost('spas_info_price');
        $moption_name       = $this->request->getPost('moption_name');
        $o_name             = $this->request->getPost('o_name');
        $o_name_eng         = $this->request->getPost('o_name_eng');
        $o_price            = $this->request->getPost('o_price');
        $use_yn             = $this->request->getPost('use_yn');
        $op_spa_idx         = $this->request->getPost('op_spa_idx');
        $moption_idx        = $this->request->getPost('moption_idx');
        $o_onum             = $this->request->getPost('o_onum');
        $spa_onum           = $this->request->getPost('spa_onum');
        $moption_onum       = $this->request->getPost('moption_onum');
        $op_spa_onum        = $this->request->getPost('op_spa_onum');
        $info_name          = $this->request->getPost('info_name');
        $is_explain         = $this->request->getPost('is_explain');
        $spas_explain       = $this->request->getPost('spas_explain');



		$setting      = homeSetInfo();
        $baht_thai    = (float)($setting['baht_thai'] ?? 0);

        $arr_week = ['일', '월', '화', '수', '목', '금', '토'];

        foreach ($spas_price as &$price) {
            $price = str_replace(",", "", $price);
        }
        foreach ($spas_price_kids as &$price) {
            $price = str_replace(",", "", $price);
        }
        foreach ($spas_price_baby as &$price) {
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
            $end_date = isset($o_edate[$key]) ? $o_edate[$key] : null;

            if ($info_id) {
                $infoIndex = $this->productSpasInfo->find($info_id);
            } else {
                $infoIndex = $this->productSpasInfo->where('product_idx', $productIdx)
                    ->where('o_sdate', $start_date)
                    ->where('o_edate', $end_date)
                    ->first();
            }

            $infoData = [
                'product_idx' => $productIdx,
                'info_name' => isset($info_name[$key]) ? $info_name[$key] : null,
                'o_sdate' => $start_date,
                'o_edate' => isset($o_edate[$key]) ? $o_edate[$key] : null,
                'yoil_0' => isset($yoil_0[$key]) ? 'Y' : 'N',
                'yoil_1' => isset($yoil_1[$key]) ? 'Y' : 'N',
                'yoil_2' => isset($yoil_2[$key]) ? 'Y' : 'N',
                'yoil_3' => isset($yoil_3[$key]) ? 'Y' : 'N',
                'yoil_4' => isset($yoil_4[$key]) ? 'Y' : 'N',
                'yoil_5' => isset($yoil_5[$key]) ? 'Y' : 'N',
                'yoil_6' => isset($yoil_6[$key]) ? 'Y' : 'N',
                'o_onum' => isset($o_onum[$key]) ? $o_onum[$key] : 0,
                'spas_info_price' => isset($spas_info_price[$key]) ? $spas_info_price[$key] : null,
                'r_date' => date('Y-m-d H:i:s')
            ];

            if ($infoIndex) {
                if ($infoIndex['o_sdate'] !== $start_date) {
                    $infoData['o_sdate'] = $start_date;
                }
                $this->productSpasInfo->update($infoIndex['info_idx'], $infoData);
                $info_ids[$key] = $infoIndex['info_idx'];
            } else {
                $this->productSpasInfo->insert($infoData);
                $info_ids[$key] = $this->productSpasInfo->insertID();
            }
        }

        foreach ($info_ids as $index => $infoId) {
            if (isset($spas_subject[$index])) {
                foreach ($spas_subject[$index] as $i => $subject) {
                    if (!empty($subject)) {
                        $spaIdx = $spas_idx[$index][$i] ?? 'new';

                        $data = [
                            'product_idx'       => $productIdx,
                            'spas_subject'      => $subject,
                            'spas_subject_eng'  => isset($spas_subject_eng[$index][$i]) ? $spas_subject_eng[$index][$i] : '',
                            'is_explain'        => isset($is_explain[$index][$i]) ? $is_explain[$index][$i] : '',
                            'spas_explain'      => isset($spas_explain[$index][$i]) ? $spas_explain[$index][$i] : '',
                            'spas_price'        => isset($spas_price[$index][$i]) ? $spas_price[$index][$i] : '',
                            'spas_price_kids'   => isset($spas_price_kids[$index][$i]) ? $spas_price_kids[$index][$i] : '',
                            'spas_price_baby'   => isset($spas_price_baby[$index][$i]) ? $spas_price_baby[$index][$i] : '',
                            'status'            => isset($status[$index][$i]) ? $status[$index][$i] : '',
                            'spa_onum'          => isset($spa_onum[$index][$i]) ? $spa_onum[$index][$i] : 0,
                            'info_idx'          => $infoId,
                            'r_date'            => date('Y-m-d H:i:s')
                        ];

                        if ($spaIdx == 'new' || empty($spaIdx)) {
                            $this->productSpas->insert($data);
                        } else {
                            $this->productSpas->update($spaIdx, $data);
                        }
                    }
                }
            }
        }

        foreach ($info_ids as $key => $infoId) {
            $s_date = $o_sdate[$key];
            $e_date = $o_edate[$key];
            if(!empty($s_date) && !empty($e_date)){
                $start = new DateTime($s_date);
                $end   = new DateTime($e_date);
                $end->modify('+1 day'); // 종료일까지 포함하기 위해 +1일 추가

                $builder = $this->connect->table('tbl_spas_price');
                $builder->select('MIN(goods_date) AS min_date, MAX(goods_date) AS max_date');
                $builder->where('product_idx', $productIdx);
                $builder->where('info_idx', $infoId);  
                $query = $builder->get();
                $result = $query->getRow();

                $minDate = $result->min_date;
                $maxDate = $result->max_date;

                if ($s_date >= $minDate) {
                    $builder->resetQuery();
                    $builder->where('product_idx', $productIdx)
                            ->where('info_idx', $infoId)
                            ->where('goods_date <', $s_date)
                            ->delete();
                }

                if($maxDate >= $e_date){
                    $builder->resetQuery();
                    $builder->where('product_idx', $productIdx)
                            ->where('info_idx', $infoId)
                            ->where('goods_date >', $e_date)
                            ->delete();
                }

                // 날짜 반복
                while ($start < $end) 
                {
                    $currentDate = $start->format("Y-m-d"); // 현재 날짜 (형식: YYYY-MM-DD)
                    $dayOfWeek = $start->format('w');
                    $yoilKey = "yoil_" . $dayOfWeek;

                    if(isset(${$yoilKey}[$key])){
                        $spas_option = $this->productSpas->where("info_idx", $infoId)->orderBy("spas_idx", "asc")->findAll();
                        foreach($spas_option as $option){
                            $count_op = $this->spasPrice->where("product_idx", $productIdx)
                                                         ->where("info_idx", $infoId)
                                                         ->where("spas_idx", $option["spas_idx"])
                                                         ->where("goods_date", $currentDate)->countAllResults();
                            
                            if($count_op <= 0){
                                $data_price = [
                                    'product_idx'   => $productIdx,
                                    'info_idx'      => $infoId,
                                    'spas_idx'      => $option["spas_idx"],
                                    'goods_date'    => $currentDate,
                                    'dow'           => $arr_week[$dayOfWeek],
                                    'baht_thai'     => $baht_thai,
                                    'goods_price1'  => $option["spas_price"],
                                    'goods_price2'  => $option["spas_price_kids"],
                                    'goods_price3'  => $option["spas_price_baby"],
                                    'use_yn'        => 'Y',
                                    'reg_date'      => date('Y-m-d H:i:s')
                                ];

                                $this->spasPrice->insertData($data_price);
                            }
                        }
                    }


                    $start->modify('+1 day'); // 다음 날짜로 이동
                }
            }
        }

        foreach($info_ids as $index => $infoId){
            foreach ($moption_idx[$index] as $m_index => $code_idx) {
                $data_op = [
                    'moption_name' => $moption_name[$index][$m_index] ?? '',
                    'onum'         => $moption_onum[$index][$m_index] ?? 0,
                    'use_yn' => 'Y'
                ];

                if(!empty($code_idx)){
                    $this->spasMoption->update($code_idx, $data_op);
                    $mop_idx = $code_idx;
                }else{
                    $data_op["product_idx"] = $productIdx;
                    $data_op["info_idx"] = $infoId;
                    $data_op["rdate"] = date('Y-m-d H:i:s');
                    $mop_idx = $this->spasMoption->insert($data_op);
                }

                foreach ($op_spa_idx[$index][$m_index] as $i => $idx) {
                    $data = [
                        'option_name'     => $o_name[$index][$m_index][$i],
                        'option_name_eng' => $o_name_eng[$index][$m_index][$i],
                        'option_price'    => $o_price[$index][$m_index][$i],
                        'onum'            => $op_spa_onum[$index][$m_index][$i] ?? 0,
                        'use_yn'          => isset($use_yn[$index][$m_index][$i]) ? $use_yn[$index][$m_index][$i] : 'N',
                    ];

                    if(!empty($idx)){
                        $this->spasOption->update($idx, $data);
                    }else{
                        $data["code_idx"] = $mop_idx;
                        $data["product_idx"] = $productIdx;
                        $data["rdate"] = date('Y-m-d H:i:s');
                        $this->spasOption->insert($data);
                    }
                }

            }
        }

        return redirect()->to('AdmMaster/_tourRegist/write_spas_info?product_idx=' . $productIdx);
    }

    public function get_code()
    {
        try {
            $depth = $this->request->getVar('depth');
            $parent_code_no = $this->request->getVar('parent_code_no');

            try {
                $results = $this->tblCode->getCodeSpa($depth, $parent_code_no);

                if (count($results) > 0) {
                    return $this->response->setJSON($results);
                }

                return $this->response->setJSON(['message' => '데이터를 찾을 수 없습니다']);
            } catch (\Exception $e) {
                return $this->response->setJSON(['error' => $e->getMessage()]);
            }
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function prod_update()
    {
        try {
            $product_idx = $_POST['product_idx'] ?? '';
            $product_best = $_POST['product_best'] ?? '';
            $special_price = $_POST['special_price'] ?? '';
            $is_view = $_POST['is_view'] ?? '';
            $onum = $_POST['onum'] ?? '';
            $product_status = $_POST['product_status'];

            $data = [
                'product_best' => $product_best,
                'special_price' => $special_price,
                'is_view' => $is_view,
                'product_status' => $product_status,
                'onum' => $onum
            ];

            $result = $this->productModel->updateData($product_idx, $data);

            if ($result) {
                $msg = "수정 되었습니다!";
            } else {
                $msg = "수정 오류!";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function del()
    {
        try {
            if (!isset($_POST['product_idx'])) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON(
                        [
                            'status' => 'error',
                            'error' => '제품 ID가 설정되지 않았습니다!'
                        ]
                    );
            };

            $connect = $this->connect;
            $product_idx = $_POST['product_idx'];
            for ($i = 0; $i < count($product_idx); $i++) {
                $db1 = $this->productModel->delete($product_idx[$i]);

                if (!$db1) {
                    return $this->response
                        ->setStatusCode(400)
                        ->setJSON(
                            [
                                'status' => 'error',
                                'error' => '오류가 발생했습니다. 다시 시도해 주세요!'
                            ]
                        );
                }

                $this->productModel->delProductYoil($product_idx[$i]);
                $this->productModel->delProductAir($product_idx[$i]);
                $this->productModel->delProductDay($product_idx[$i]);
            }
            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => '삭제 성공!'
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function ajax_change()
    {
        try {
            $code_idx = $this->request->getPost('code_idx');
            $onum = $this->request->getPost('onum');
            $is_view = $this->request->getPost('is_view');
            $product_best = $this->request->getPost('product_best');
            $special_price = $this->request->getPost('special_price');
            $product_status = $this->request->getPost('product_status');
            $tot = count($code_idx);
            $updateData = [];
            for ($j = 0; $j < $tot; $j++) {
                $updateData[] = [
                    'is_view' => $is_view[$j],
                    'product_best' => $product_best[$j],
                    'special_price' => $special_price[$j],
                    'product_status' => $product_status[$j],
                    'onum' => $onum[$j],
                    'product_idx' => $code_idx[$j]
                ];
            }

            $result = $this->productModel->batchUpdate($updateData);

            if ($result) {
                $msg = "수정 되었습니다!";
            } else {
                $msg = "순위조정 오류!";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function change_manager()
    {
        try {
            $msg = '';

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function add_moption()
    {
        try {
            $product_idx = $_POST['product_idx'];
            $moption_name = $_POST['moption_name'];

            $data = [
                'product_idx' => $product_idx,
                'moption_name' => $moption_name,
                'use_yn' => 'Y',
                'rdate' => date('Y-m-d H:i:s')
            ];

            $this->toursMoption->insertData($data);

            $msg = "등록 완료.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function upd_moption()
    {
        try {
            $code_idx = $_POST['code_idx'];
            $moption_name = $_POST['moption_name'];

            $data = [
                'moption_name' => $moption_name
            ];

            $this->toursMoption->updateData($data, $code_idx);

            $msg = "등록 완료.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function del_moption()
    {
        try {
            $code_idx = $_POST['code_idx'];

            $this->toursMoption->delete($code_idx);

            $msg = "등록 완료.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function add_option()
    {
        try {
            $code_idx = $_POST['code_idx'];
            $product_idx = $_POST['product_idx'];
            $option_cnt = count($_POST['o_name']);

            $this->toursOption->deleteData($code_idx, $product_idx);

            for ($i = 0; $i < $option_cnt; $i++) {
                $option_name = $_POST['o_name'][$i];
                $option_price = $_POST['o_price'][$i];
                $use_yn = $_POST['use_yn'][$i];
                $onum = $_POST['o_num'][$i];

                if ($option_name && $option_price) {
                    $data = [
                        'code_idx' => $code_idx,
                        'product_idx' => $product_idx,
                        'option_name' => $option_name,
                        'option_price' => $option_price,
                        'use_yn' => $use_yn,
                        'onum' => $onum,
                        'rdate' => date('Y-m-d H:i:s')
                    ];

                    $this->toursOption->insertData($data);
                }
            }

            $msg = "등록 완료.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function del_option()
    {
        try {
            $msg = "등록 완료.";

            $idx = $_POST['idx'];

            $this->toursOption->delete($idx);

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function upd_option()
    {
        try {
            $msg = "등록 완료.";

            $idx = $_POST['idx'];
            $option_name = $_POST['option_name'];
            $option_price = $_POST['option_price'];
            $use_yn = $_POST['use_yn'];
            $onum = $_POST['onum'];

            $data = [
                'option_name' => $option_name,
                'option_price' => $option_price,
                'use_yn' => $use_yn,
                'onum' => $onum,
            ];

            $this->toursOption->updateData($idx, $data);

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function img_remove()
    {
        try {
            $msg = '';

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function save_option_price()
    {
        try {
            $p_idx = $_POST['p_idx'];

            $product_idx = updateSQ($_POST['product_idx']);
            $s_date = updateSQ($_POST['s_date']);
            $e_date = updateSQ($_POST['e_date']);

            $price1 = updateSQ($_POST['price1']);
            $price2 = updateSQ($_POST['price2']);
            $price3 = updateSQ($_POST['price3']);

            $sale = updateSQ($_POST['sale']);

            $yoil_0 = updateSQ($_POST['yoil_0']);
            $yoil_1 = updateSQ($_POST['yoil_1']);
            $yoil_2 = updateSQ($_POST['yoil_2']);
            $yoil_3 = updateSQ($_POST['yoil_3']);
            $yoil_4 = updateSQ($_POST['yoil_4']);
            $yoil_5 = updateSQ($_POST['yoil_5']);
            $yoil_6 = updateSQ($_POST['yoil_6']);

            if ($p_idx) {
                $row = $this->productPriceModel->getById($p_idx);

                $data = [
                    's_date' => $s_date ?? $row['s_date'],
                    'e_date' => $e_date ?? $row['e_date'],
                    'adult_price' => $price1 ?? $row['adult_price'],
                    'kids_price' => $price2 ?? $row['kids_price'],
                    'senior_price' => $price3 ?? $row['senior_price'],
                    'sale' => $sale ?? $row['sale'],
                    'yoil_0' => $yoil_0 ?? $row['yoil_0'],
                    'yoil_1' => $yoil_1 ?? $row['yoil_1'],
                    'yoil_2' => $yoil_2 ?? $row['yoil_2'],
                    'yoil_3' => $yoil_3 ?? $row['yoil_3'],
                    'yoil_4' => $yoil_4 ?? $row['yoil_4'],
                    'yoil_5' => $yoil_5 ?? $row['yoil_5'],
                    'yoil_6' => $yoil_6 ?? $row['yoil_6']
                ];

                $this->productPriceModel->updateData($p_idx, $data);
            } else {
                $data = [
                    'product_idx' => $product_idx,
                    's_date' => $s_date,
                    'e_date' => $e_date,
                    'adult_price' => $price1,
                    'kids_price' => $price2,
                    'senior_price' => $price3,
                    'yoil_0' => $yoil_0,
                    'yoil_1' => $yoil_1,
                    'yoil_2' => $yoil_2,
                    'yoil_3' => $yoil_3,
                    'yoil_4' => $yoil_4,
                    'yoil_5' => $yoil_5,
                    'yoil_6' => $yoil_6,
                    'c_date' => date('Y-m-d H:i:s')
                ];

                $this->productPriceModel->insertData($data);
            }

            if ($product_idx) {
                $message = "수정되었습니다.";

            } else {
                $message = "등록되었습니다.";
            }

            $charge_idx        = $_POST['charge_idx'] ?? [];
            $s_station         = $_POST['s_station'] ?? [];
            $s_station_eng     = $_POST['s_station_eng'] ?? [];
            $tour_price        = $_POST['tour_price'] ?? [];
            $tour_price_kids   = $_POST['tour_price_kids'] ?? [];
            $tour_price_senior = $_POST['tour_price_senior'] ?? [];

            $length = count($charge_idx);

            for ($i = 0; $i < $length; $i++) {
                $item_s_station = $s_station[$i];
                $item_s_station_eng = $s_station_eng[$i];
                $item_tour_price = str_replace(',', '', $tour_price[$i]);
                $item_tour_price_kids = str_replace(',', '', $tour_price_kids[$i]);
                $item_tour_price_senior = str_replace(',', '', $tour_price_senior[$i]);
                $item_charge_idx = $charge_idx[$i];

                $data = [
                    's_station' => $item_s_station,
                    's_station_eng' => $item_s_station_eng,
                    'tour_price' => $item_tour_price,
                    'tour_price_kids' => $item_tour_price_kids,
                    'tour_price_senior' => $item_tour_price_senior,
                    'u_date' => date('Y-m-d H:i:s')
                ];

                $this->productChargeModel->updateData($item_charge_idx, $data);
				
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'message' => $message
                    ]
                );

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function del_option_price()
    {
        try {
            $msg = '삭제 성공.';
            $p_idx = $_POST['p_idx'];

            $this->productPriceModel->delete($p_idx);

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function close_option_price()
    {
        try {
            $msg = '';
            $p_idx = $_POST['p_idx'];

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function charge_dummy()
    {
        try {
            $msg = '';

            $product_idx = $_POST['product_idx'];
            $yoil_idx = $_POST['yoil_idx'];

            $result = $this->productPriceModel->getById($yoil_idx);

            $data = [
                'product_idx' => $product_idx,
                'yoil_idx' => $yoil_idx,
                'tour_price' => $result['adult_price'],
                'tour_price_kids' => $result['kids_price'],
                'tour_price_senior' => $result['senior_price'],
                'r_date' => date('Y-m-d H:i:s'),
                'sale' => 'Y',
                'deadline_date' => date('Y-m-d H:i:s')
            ];

            $this->productChargeModel->insertData($data);

            if ($result) {
                $msg = '등록 성공.';
                return $this->response->setStatusCode(200)
                    ->setJSON([
                        'status' => 'success',
                        'message' => $msg
                    ]);
            }
            $msg = '등록 실패.';
            return $this->response->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $msg
                ]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function charge_update()
    {
        try {
            $charge_idx = $_POST['charge_idx'];
            $s_station = $_POST['s_station'];
            $tour_price = $_POST['tour_price'];
            $tour_price_kids = $_POST['tour_price_kids'];
            $tour_price_senior = $_POST['tour_price_senior'];

            $data = [
                's_station' => $s_station,
                'tour_price' => $tour_price,
                'tour_price_kids' => $tour_price_kids,
                'tour_price_senior' => $tour_price_senior,
                'u_date' => date('Y-m-d H:i:s')
            ];

            $result = $this->productChargeModel->updateData($charge_idx, $data);

            if ($result) {
                $msg = "수정 완료.";
            } else {
                $msg = "수정 오류.";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function charge_delete()
    {
        try {
            $charge_idx = $_POST['charge_idx'];

            $result = $this->productChargeModel->delete($charge_idx);

            if ($result) {
                $msg = "삭제 완료.";
            } else {
                $msg = "삭제 오류.";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function station_seq()
    {
        try {
            $msg = '';

            $id = $_POST['id'];
            $flag = $_POST['flag'];
            $product_idx = $_POST['product_idx'];
            $yoil_idx = $_POST['yoil_idx'];
            $charge_date = $_POST['charge_date'];

            if ($flag == "U") { // 위로
                $result = $this->productChargeModel->updateSeq($id, 'up');
            } else if ($flag == "D") { // 아래로
                $result = $this->productChargeModel->updateSeq($id, 'down');
            }

            // 순서 정의
            $result = $this->productChargeModel->selectSeqByProduct($product_idx);
            $num = 0;
            foreach ($result as $row) {
                $num = $num + 1;
                $this->productChargeModel->updateSeqByProduct($row['charge_idx'], $num);
            }

            $msg = "수정되었습니다.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function del_spas()
    {
        $info_idx = $this->request->getPost('info_idx');
        $spas_idx = $this->request->getPost('spas_idx');
        $db = $this->connect;
        $db->transStart();
        $infoDeleted = $this->productSpasInfo->where('info_idx', $info_idx)->delete();
        $spasDeleted = true;
        foreach ($spas_idx as $spa_idx) {
            if (!$this->productSpas->where('spas_idx', $spa_idx)->delete()) {
                $spasDeleted = false;
                break;
            }
        }

        $moption = $this->spasMoption->where('info_idx', $info_idx)->findAll();

        foreach ($moption as $row) {
            $this->spasOption->where('code_idx', $row['code_idx'])->delete();
        }

        $this->spasMoption->where('info_idx', $info_idx)->delete();

        $this->spasPrice->where("info_idx", $info_idx)->delete();

        $db->transComplete();
        try {

            if ($db->transStatus() === FALSE || !$infoDeleted || !$spasDeleted) {
                $msg = "삭제 오류";
            } else {
                $msg = "삭제 완료";
            }
        } catch (Exception $e) {
            $msg = "삭제 오류: " . $e->getMessage();
        }

        return $this->response->setJSON(['message' => $msg]);
    }

    public function del_spa_option()
    {
        $spas_idx = $this->request->getPost('spas_idx');
        $info_idx = $this->request->getPost('info_idx');
        $product_idx = $this->request->getPost('product_idx');

        if ($spas_idx) {
            $result = $this->productSpas->deleteSpa($spas_idx);
            $this->spasPrice->where('product_idx', $product_idx)
                             ->where('info_idx', $info_idx)
                             ->where('spas_idx', $spas_idx)
                             ->delete();
            if ($result) {
                $msg = "일차전체 삭제 완료";
            } else {
                $msg = "일차전체 삭제 오류";
            }
            return $this->response->setJSON(['message' => $msg]);
        }

        return $this->response->setJSON(['message' => '일차 삭제에 필요한 데이터가 없습니다.']);
    }

    public function del_main_option()
    {
        $code_idx = $this->request->getPost('code_idx');

        if ($code_idx) {

            $this->spasOption->where('code_idx', $code_idx)->delete();
            $result = $this->spasMoption->delete($code_idx);

            if ($result) {
                $msg = "일차전체 삭제 완료";
            } else {
                $msg = "일차전체 삭제 오류";
            }
            return $this->response->setJSON(['message' => $msg]);
        }

        return $this->response->setJSON(['message' => '일차 삭제에 필요한 데이터가 없습니다.']);
    }

    public function del_sub_option()
    {
        $idx = $this->request->getPost('idx');

        if ($idx) {

            $result = $this->spasOption->delete($idx);

            if ($result) {
                $msg = "일차전체 삭제 완료";
            } else {
                $msg = "일차전체 삭제 오류";
            }
            return $this->response->setJSON(['message' => $msg]);
        }

        return $this->response->setJSON(['message' => '일차 삭제에 필요한 데이터가 없습니다.']);
    }

    function copy_last_spa()
    {
        $product_idx = $this->request->getPost('product_idx');

        if ($product_idx) {
            $spa_info = $this->productSpasInfo
                                ->from("tbl_product_spas_info a")
                                ->join("tbl_product_spas b", "a.info_idx = b.info_idx", "left")
                                ->where("b.info_idx IS NOT NULL")
                                ->where("a.product_idx", $product_idx)
                                ->orderBy("a.info_idx", "desc") 
                                ->first();
            if(!empty($spa_info)){
                $new_spa_info = array_merge([], $spa_info);
                $info_idx = $new_spa_info['info_idx'];
                unset($new_spa_info['info_idx']);
                $new_spa_info['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                $spa_id = $this->productSpasInfo->insert($new_spa_info);

                if($spa_id) {
                    $spas_product = $this->productSpas->where("info_idx", $info_idx)->orderBy("spas_idx", "asc")->findAll();
                    if(!empty($spas_product)) {
                        $new_spas_product = array_merge([], $spas_product);
                        foreach ($new_spas_product as $spa) {
                            unset($spa['spas_idx']);
                            $spa['info_idx'] = $spa_id;
                            $spa['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                            $this->productSpas->insert($spa);
                        }
                    }

                    $spas_moption = $this->spasMoption->where("info_idx", $info_idx)->findAll();
                    if(!empty($spas_moption)) {
                        $new_spas_moption = array_merge([], $spas_moption);
                        foreach ($new_spas_moption as $moption) {
                            $code_idx = $moption['code_idx'];
                            unset($moption['code_idx']);
                            $moption['info_idx'] = $spa_id;
                            $moption['rdate'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                            $insert_idx = $this->spasMoption->insert($moption);

                            if($insert_idx){
                                $spas_option = $this->spasOption->where("code_idx", $code_idx)->findAll();
                                if(!empty($spas_option)) {
                                    $new_spas_option = $spas_option;
                                    foreach ($new_spas_option as $option) {
                                        unset($option['idx']);
                                        $option['code_idx'] = $insert_idx;
                                        $option['rdate'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                                        $this->spasOption->insert($option);
                                    }
                                }
                            }
                        }
                    }

                    $spas_price = $this->spasPrice->where("product_idx", $product_idx)
                                                    ->where("info_idx", $info_idx)
                                                    ->groupBy("goods_date")
                                                    ->orderBy("goods_date", "asc")
                                                    ->findAll();
                    $new_spas_option = $this->productSpas->where("info_idx", $spa_id)->findAll();
                    if(!empty($spas_price)) {
                        $new_spas_price = array_merge([], $spas_price);
                        foreach ($new_spas_price as $price) {
                            foreach ($new_spas_option as $new_option) {
                                unset($price['idx']);
                                unset($price['upd_date']);
                                $price['info_idx'] = $spa_id;
                                $price['spas_idx'] = $new_option['spas_idx'];
                                $price['reg_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                                $this->spasPrice->insert($price);
                            }
                        }
                    }
                }else{
                    return $this->response->setJSON([
                        'result'    => false,
                        'message'   => "복사한 제품이 실패했습니다."
                    ]);
                }
            }

            return $this->response->setJSON([
                'result'    => true,
                'message'   => "제품이 성공적으로 복사되었습니다."
            ]);

        }
    }

    public function spas_price_add()
    {
        $product_idx = $this->request->getPost('product_idx');
        $info_idx    = $this->request->getPost('info_idx');
        $days        = $this->request->getPost('days');

        // 방 정보를 가져옵니다.
        $spas_product = $this->productSpas->where("info_idx", $info_idx)
                                            ->where("product_idx", $product_idx)
                                            ->orderBy("spas_idx", "asc")
                                            ->findAll();

        if (count($spas_product) == 0) {
            return $this->response->setJSON([
                'status' => 'fail',
                'message' => '정보를 찾을 수 없습니다'
            ]);
        }

        // 공통 함수 호출
        $baht_thai = $this->setting['baht_thai'];

        $row = $this->spasPrice->where("product_idx", $product_idx)
                                        ->where("info_idx", $info_idx)
                                        ->orderBy("goods_date", "desc")
                                        ->limit(1)
                                        ->get()
                                        ->getRow();
        $from_date = $row->goods_date;

        $from_date    = day_after($from_date, 1);
        $to_date      = day_after($from_date, $days - 1);
        
        $startDate = $from_date; // 시작일
        $endDate   = $to_date;   // 종료일

        // DateTime 객체 생성
        $start = new DateTime($startDate);
        $end   = new DateTime($endDate);
        $end->modify('+1 day'); // 종료일까지 포함하기 위해 +1일 추가

        // 날짜 반복
        while ($start < $end) {
            $currentDate = $start->format("Y-m-d"); // 현재 날짜 (형식: YYYY-MM-DD)

            foreach ($spas_product as $row) {
                $data = [
                    'product_idx'   => $product_idx,
                    'info_idx'      => $info_idx,
                    'spas_idx'      => $row['spas_idx'],
                    'goods_date'    => $currentDate,
                    'dow'           => dateToYoil($currentDate),
                    'baht_thai'     => $baht_thai,
                    'goods_price1'  => 0,
                    'goods_price2'  => 0,
                    'goods_price3'  => 0,
                    'use_yn'        => 'Y',
                    'reg_date'      => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                ];

                $this->spasPrice->insert($data);
            }
        
            // 다음 날짜로 이동
            $start->modify('+1 day');
        }

        //시작일
        $row = $this->spasPrice->where("product_idx", $product_idx)
                                ->where("info_idx", $info_idx)
                                ->orderBy("goods_date", "asc")
                                ->limit(1)
                                ->get()
                                ->getRow();
        $s_date  = $row->goods_date; 

        //종료일
        $row = $this->spasPrice->where("product_idx", $product_idx)
                                ->where("info_idx", $info_idx)
                                ->orderBy("goods_date", "desc")
                                ->limit(1)
                                ->get()
                                ->getRow();
        $e_date  = $row->goods_date; 
        
        $result = $this->productSpasInfo->update($info_idx, [
            'o_sdate' => $s_date,
            'o_edate' => $e_date
        ]);

        if ($result) {
            $msg = "호텔 객실일자 추가완료";
        } else {
            $msg = "호텔 객실일자 추가오류";
        }

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => 'success',
                'message' => $msg,
                's_date'  => $from_date,
                'e_date'  => $to_date
            ]);
    }

    public function update_all_price()   
    {
        $db = \Config\Database::connect();

        // POST 데이터 받아오기
        $s_date        = $_POST['s_date'];
        $e_date        = $_POST['e_date'];  
        $spa_option    = $_POST['spa_option'];
        $dow_val       = $_POST['dow_val'];
        $product_idx   = $_POST['product_idx'];
        $info_idx      = $_POST['info_idx'];
        $goods_price1  = $_POST['goods_price1'] ?? 0;
        $goods_price2  = $_POST['goods_price2'] ?? 0;

        $spa_idx_condition = '';
        if (!empty($spa_option)) {
            $spa_idx_condition = "AND spas_idx IN (". $spa_option .") ";
        }

        // SQL 쿼리 작성
        $sql = "UPDATE tbl_spas_price
                SET goods_price1 = '" . $db->escapeString($goods_price1) . "',
                    goods_price2 = '" . $db->escapeString($goods_price2) . "',
                    upd_date = NOW()
                WHERE dow IN ($dow_val)
                $spa_idx_condition
                AND product_idx = '" . $db->escapeString($product_idx) . "'
                AND info_idx = '" . $db->escapeString($info_idx) . "'
                AND upd_yn != 'Y'
                AND goods_date BETWEEN '" . $db->escapeString($s_date) . "' AND '" . $db->escapeString($e_date) . "'";

        $result = $db->query($sql);

        if($result) {
            $msg = "수정 완료";
        } else {
            $msg = "수정 오류";	
        }   

        return $this->response
                    ->setStatusCode(200)
                    ->setJSON([
                        'status'  => 'success',
                        'message' => $msg
                    ]);
    }

    public function spa_price_update()   
    {
        $idx          = $this->request->getPost('idx');
        $goods_price1 = str_replace(',', '', $this->request->getPost('goods_price1'));
        $goods_price2 = str_replace(',', '', $this->request->getPost('goods_price2'));
        $use_yn       = $this->request->getPost('use_yn');	

        $result = $this->spasPrice->update($idx, [
            "goods_price1" => $goods_price1,
            "goods_price2" => $goods_price2,
            "upd_date"     => Time::now('Asia/Seoul')->format('Y-m-d H:i:s'),
            "use_yn"       => $use_yn
        ]);

        if ($result) {
            $msg = "가격 수정완료";
        } else {
            $msg = "가격 수정오류";
        }

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status' => 'success',
                'message' => $msg
            ]);
    }

    public function spas_all_update()
	{
        $rows     = $this->request->getPost('rows');
        $errors   = [];

        try {
            foreach ($rows as $row) {
                $idx = (int) $row['idx'];
                $goods_price1 = (float) str_replace(',', '', $row['goods_price1']);
                $goods_price2 = (float) str_replace(',', '', $row['goods_price2']);
                $use_yn       = $row['use_yn'];

                $result = $this->spasPrice->update($idx, [
                    "goods_price1" => $goods_price1,
                    "goods_price2" => $goods_price2,
                    "use_yn"       => $use_yn,
                    "upd_date"     => Time::now('Asia/Seoul')->format('Y-m-d H:i:s'),
                ]);

                if (!$result) {
                    $errors[] = "Update failed: " . $this->connect->error();
                }
            }

            if (empty($errors)) {
                return $this->response->setJSON(["status" => "success"]);
            } else {
                return $this->response->setJSON(["status" => "error", "message" => implode(", ", $errors)]);
            }
        } catch (Exception $e) {
            return $this->response->setJSON(["status" => "error", "message" => $e->getMessage()]);
        }
	}
}
