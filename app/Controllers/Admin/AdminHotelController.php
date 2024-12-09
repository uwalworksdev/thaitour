<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminHotelController extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $hotelOptionModel;
    private $memberModel;


    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
        $this->hotelOptionModel = model("HotelOptionModel");
        $this->memberModel = new \App\Models\Member();
    }

    public function list()
    {
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_txt = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy = $_GET["orderBy"] ?? "";

        $where = [
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'orderBy' => $orderBy,
            'product_code_1' => 1303,
        ];

        $orderByArr = [];

        if ($orderBy == 1) {
            $orderByArr['onum'] = "DESC";
        } elseif ($orderBy == 2) {
            $orderByArr['r_date'] = "DESC";
        } else {
            $orderByArr['onum'] = "DESC";
        }

        $result = $this->productModel->findProductPaging($where, $g_list_rows, $pg, $orderByArr);

        $data = [
            'result' => $result['items'],
            'orderBy' => $orderBy,
            'num' => $result['num'],
            'nTotalCount' => $result['nTotalCount'],
            'nPage' => $result['nPage'],
            'pg' => $pg,
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'g_list_rows' => $g_list_rows,
        ];
        return view("admin/_hotel/list", $data);
    }

    public function write()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? '');
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? '');

        $fsql = "select * from tbl_code where code_gubun = 'tour' and code_no = '1303'";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $fsql = " select *
						, (select code_name from tbl_code where code_gubun = 'stay' and depth='2' and tbl_code.code_no=tbl_product_stay.stay_code) as stay_gubun
						, (select code_name from tbl_code where code_gubun = 'country' and depth='2' and tbl_code.code_no=tbl_product_stay.country_code_1) as country_name_1
						, (select code_name from tbl_code where code_gubun = 'country' and depth='3' and tbl_code.code_no=tbl_product_stay.country_code_2) as country_name_2
						from tbl_product_stay where 1=1";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        $product_code_no = $this->productModel->createProductCode("H");

        if ($product_idx) {
            $row = $this->productModel->find($product_idx);
            $product_code_no = $row["product_code"];
            $stay_idx = $row['stay_idx'];
            $hsql = "SELECT * FROM tbl_product_stay WHERE stay_idx = '" . $stay_idx . "'";
            $hresult = $this->connect->query($hsql);
            $hresult = $hresult->getResultArray();
        }


        $fsql9 = "select * from tbl_code where parent_code_no='30' order by onum desc, code_idx desc";
        $fresult9 = $this->connect->query($fsql9);
        $fresult9 = $fresult9->getResultArray();

        $fsql = "select * from tbl_room_options where h_idx='" . $product_idx . "' order by rop_idx desc";
        $roresult = $this->connect->query($fsql);
        $roresult = $roresult->getResultArray();

        $sql = "select * from tbl_code where parent_code_no='38' order by onum desc, code_idx desc";
        $product_themes = $this->connect->query($sql);
        $product_themes = $product_themes->getResultArray();

        $sql = "select * from tbl_code where parent_code_no='39' order by onum desc, code_idx desc";
        $product_bedrooms = $this->connect->query($sql);
        $product_bedrooms = $product_bedrooms->getResultArray();

        $sql = "select * from tbl_code where parent_code_no='40' order by onum desc, code_idx desc";
        $product_types = $this->connect->query($sql);
        $product_types = $product_types->getResultArray();

        $sql = "select * from tbl_code where parent_code_no='41' order by onum desc, code_idx desc";
        $product_promotions = $this->connect->query($sql);
        $product_promotions = $product_promotions->getResultArray();

        $mresult = $this->memberModel->getMembersPaging(['user_level' => 2], 1, 1000)['items'];

        $data = [
            'product_idx' => $product_idx,
            'product_code_no' => $product_code_no,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            'row' => $row ?? '',
            'fresult' => $fresult,
            'fresult3' => $fresult3,
            'fresult9' => $fresult9,
            'roresult' => $roresult,
            'pthemes' => $product_themes,
            'pbedrooms' => $product_bedrooms,
            'ptypes' => $product_types,
            'ppromotions' => $product_promotions,
            'hresult' => $hresult,
            'member_list' => $mresult
        ];
        return view("admin/_hotel/write", $data);
    }

    public function write_options()
    {
        $o_idx = $this->request->getVar("o_idx");
        $product_idx = $this->request->getVar("product_idx");
        $s_date = $this->request->getVar("s_date");
        $e_date = $this->request->getVar("e_date");

        $row = $this->productModel->getById($product_idx);
        $product_name = viewSQ($row["product_name"]);

        $option = $this->hotelOptionModel->getByIdx($o_idx);
        $o_sdate = $option["o_sdate"];
        $o_edate = $option["o_edate"];

        if ($s_date) $o_sdate = $s_date;
        if ($e_date) $o_edate = $e_date;

        if ($s_date && $e_date) {
            $fsql = "SELECT * FROM tbl_hotel_price WHERE o_idx = '" . $o_idx . "' AND goods_date BETWEEN '$s_date' AND '$e_date' order by goods_date asc";
        } else {
            $fsql = "SELECT * FROM tbl_hotel_price WHERE o_idx = '" . $o_idx . "' order by goods_date asc";
        }
        $roresult = $this->connect->query($fsql);
        $roresult = $roresult->getResultArray();

        $data = [
            'roresult' => $roresult,
            'o_idx' => $o_idx,
            'product_idx' => $product_idx,
            'product_name' => $product_name,
            'o_sdate' => $o_sdate,
            'o_edate' => $o_edate,
        ];

        return view("admin/_hotel/write_options", $data);
    }

    public function write_ok($product_idx = null)
    {
        $connect = $this->connect;
        try {
            $files = $this->request->getFiles();

            $latitude = updateSQ($_POST["latitude"] ?? '');
            $longitude = updateSQ($_POST["longitude"] ?? '');
            $onum = updateSQ($_POST["onum"] ?? '');

            $data['product_code_list'] = updateSQ($_POST["product_code_list"] ?? '');
            $data['product_code'] = updateSQ($_POST["product_code"] ?? '');
            $data['product_name'] = updateSQ($_POST["product_name"] ?? '');
            $data['keyword'] = updateSQ($_POST["keyword"] ?? '');
            $data['product_status'] = updateSQ($_POST["product_status"] ?? '');
            $data['original_price'] = updateSQ($_POST["original_price"] ?? '');
            $data['product_price'] = updateSQ($_POST["product_price"] ?? '');

            $data['latitude'] = updateSQ($latitude ?? '');
            $data['longitude'] = updateSQ($longitude ?? '');

            $data['onum'] = updateSQ($onum ?? '');

            $data['product_level'] = updateSQ($_POST["product_level"] ?? '');
            $data['addrs'] = updateSQ($_POST["addrs"] ?? '');
            $data['room_cnt'] = updateSQ($_POST["room_cnt"] ?? '');
            $data['product_info'] = updateSQ($_POST["product_info"] ?? '');
            $data['product_best'] = updateSQ($_POST["product_best"] ?? 'N');
            $data['special_price'] = updateSQ($_POST["special_price"] ?? 'N');
            $data['is_view'] = updateSQ($_POST["is_view"] ?? 'Y');

            $data['product_theme'] = updateSQ($_POST["product_theme"] ?? ''); // code=38 호텔 테마
            $data['product_bedrooms'] = updateSQ($_POST["product_bedrooms"] ?? ''); // code=39 호텔 침실수
            $data['product_type'] = updateSQ($_POST["product_type"] ?? ''); // code=40 호텔타입
            $data['product_promotions'] = updateSQ($_POST["product_promotions"] ?? '');// code=41 호텔 프로모션

            $data['product_important_notice'] = updateSQ($_POST["product_important_notice"] ?? '');
            $data['product_important_notice_m'] = updateSQ($_POST["product_important_notice_m"] ?? '');
            $data['product_notes'] = updateSQ($_POST["product_notes"] ?? '');
            $data['product_notes_m'] = updateSQ($_POST["product_notes_m"] ?? '');

            $data['product_video'] = updateSQ($_POST["product_video"] ?? '');
            $data['stay_idx'] = $_POST["stay_idx"] ?? '';

            $phone = updateSQ($_POST["phone"] ?? '');
            $email = updateSQ($_POST["email"] ?? '');
            $product_manager = updateSQ($_POST["product_manager"] ?? '');


            $data['product_manager'] = updateSQ($product_manager);

            $data['phone'] = updateSQ($phone);
            $data['email'] = updateSQ($email);

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

//            $dataProductMore->meet_out_time = $meet_out_time;
//            $dataProductMore->children_policy = $children_policy;
//            $dataProductMore->baby_beds = $baby_beds;
//            $dataProductMore->deposit_regulations = $deposit_regulations;
//            $dataProductMore->pets = $pets;
//            $dataProductMore->age_restriction = $age_restriction;
//            $dataProductMore->smoking_policy = $smoking_policy;
//            $dataProductMore->breakfast = $breakfast;
//            $dataProductMore->breakfast_data = $dataBreakfast;

//            $dataProductMore = json_encode($dataProductMore);

            $data['product_more'] = $dataProductMore;

            $o_idx = $_POST["o_idx"] ?? [];
            $o_name = $_POST["o_name"] ?? [];
            $o_price1 = $_POST["o_price1"] ?? [];
            $o_price2 = $_POST["o_price2"] ?? [];
            $o_sdate = $_POST["o_sdate"] ?? [];
            $o_edate = $_POST["o_edate"] ?? [];
            $o_room = $_POST["o_room"] ?? [];
            $option_type = $_POST["option_type"] ?? [];
            $o_soldout = $_POST["o_soldout"] ?? [];

            $rop_idx = $_POST["rop_idx"] ?? [];
            $sup_room__idx = $_POST["sup_room__idx"] ?? [];
            $sup_room__name = $_POST["sup_room__name"] ?? [];
            $sup__key = $_POST["sup__key"] ?? [];
            $sup__name = $_POST["sup__name"] ?? [];
            $sup__price = $_POST["sup__price"] ?? [];
            $sup__price_sale = $_POST["sup__price_sale"] ?? [];

            for ($i = 1; $i <= 7; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                // if (isset(${"del_" . $i}) && ${"del_" . $i} === "Y") {
                //     $this->productModel->update($product_idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                // }
                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->productModel->update($product_idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $publicPath = ROOTPATH . '/public/data/product/';
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            $min_date = date('Y-m-d');
            $max_date = date('Y-m-d');

            if ($product_idx) {

                foreach ($o_idx as $key => $val) {
                    $sql_chk = "
					select count(*) as cnts
					  from tbl_hotel_option
					 where idx	= '" . $val . "'
					";
                    $result_chk = $this->connect->query($sql_chk);
                    $row_chk = $result_chk->getRowArray();

                    if ($row_chk) {
                        // 이미 등록된 옵션이 아니라면...
                        $item_name = $o_name[$key] ?? '';
                        $item_price1 = $o_price1[$key] ?? '';
                        $item_price2 = $o_price2[$key] ?? '';
                        $item_sdate = $o_sdate[$key] ?? '';
                        $item_edate = $o_edate[$key] ?? '';
                        $item_room = $o_room[$key] ?? '';
                        $item_type = $option_type[$key] ?? '';
                        $item_soldout = $o_soldout[$key] ?? '';

                        if ($item_sdate <= $min_date) {
                            $min_date = $item_sdate;
                        }
                        if ($max_date <= $item_edate) {
                            $max_date = $item_edate;
                        }

                        if ($row_chk['cnts'] < 1) {
                            $sql_su = "insert into tbl_hotel_option SET
                                         goods_code		= '" . $data['product_code'] . "'
                                        ,goods_name		= '" . $item_name . "'
                                        ,goods_price1	= '" . $item_price1 . "'
                                        ,goods_price2	= '" . $item_price2 . "'
                                        ,o_sdate		= '" . $item_sdate . "'
                                        ,o_edate		= '" . $item_edate . "'
                                        ,o_room			= '" . $item_room . "'
                                        ,option_type	= '" . $item_type . "'
                                        ,o_soldout		= '" . $item_soldout . "'
                                ";
                            write_log("1- " . $sql_su);
                            $this->connect->query($sql_su);

                            $sql_opt = "SELECT LAST_INSERT_ID() AS last_id";
                            $option = $this->connect->query($sql_opt)->getRowArray();
                            $option_idx = $option['last_id'];

                            $dateRange = getDateRange($item_sdate, $item_edate);

                            $ii = -1;
                            foreach ($dateRange as $date) {
                                $ii++;

                                $goods_date = $dateRange[$ii];
                                $dow = dateToYoil($goods_date);

                                $sql_c = "INSERT INTO tbl_hotel_price  SET  
																	  o_idx        = '" . $option_idx . "' 	
																	 ,goods_code   = '" . $data['product_code'] . "' 	
																	 ,goods_name   = '" . $item_name . "'
																	 ,goods_date   = '" . $goods_date . "'
																	 ,dow 	       = '" . $dow . "'
																	 ,goods_price1 = '" . $item_price1 . "' 
																	 ,goods_price2 = '" . $item_price2 . "'
																	 ,use_yn       = ''
																	 ,o_sdate 	   = '" . $item_sdate . "'
																	 ,o_edate      = '" . $item_edate . "'
																	 ,reg_date     = now() ";
                                write_log("가격정보-1 : " . $sql_c);
                                $this->connect->query($sql_c);
                            }
                        } else {
                            $sql_su = "update tbl_hotel_option SET 
                                         goods_name		= '" . $item_name . "'
                                        ,goods_price1	= '" . $item_price1 . "'
                                        ,goods_price2	= '" . $item_price2 . "'
                                        ,o_sdate		= '" . $item_sdate . "'
                                        ,o_edate		= '" . $item_edate . "'
                                        ,o_room			= '" . $item_room . "'
                                        ,option_type	= '" . $item_type . "'
                                        ,o_soldout		= '" . $item_soldout . "'
                                    where idx	= '" . $val . "'
                                ";

                            $this->connect->query($sql_su);
                        }
                    }
                }

                foreach ($rop_idx as $key => $val) {
                    $sql_chk = "
					select count(*) as cnts
					    from tbl_room_options
					    where rop_idx	= '" . $val . "'
					";
                    $result_chk = $this->connect->query($sql_chk);
                    $row_chk = $result_chk->getRowArray();

                    if ($row_chk) {
                        // 이미 등록된 옵션이 아니라면...
                        $r_key = $sup__key[$key] ?? '';
                        $r_name = $sup_room__name[$key] ?? '';
                        $r_val = $sup__name[$key] ?? '';
                        $r_price = $sup__price[$key] ?? '';
                        $r_sale_price = $sup__price_sale[$key] ?? '';

                        $r_idx = $sup_room__idx[$key] ?? '';

                        if ($row_chk['cnts'] < 1) {
                            $sql_su = "insert into tbl_room_options SET
                                         r_key		= '" . $r_key . "'
                                        ,r_val		= '" . $r_val . "'
                                        ,r_price	= '" . $r_price . "'
                                        ,r_sale_price		= '" . $r_sale_price . "'
                                        ,r_created_at		= '" . date('Y-m-d H:i:s') . "'
                                        ,h_idx			= '" . $product_idx . "'
                                        ,r_idx	= '" . $r_idx . "'
                                        ,r_name		= '" . $r_name . "'
                                ";

                            $this->connect->query($sql_su);


                        } else {
                            $sql_su = "update tbl_room_options SET 
                                         r_key		    = '" . $r_key . "'
                                        ,r_val	        = '" . $r_val . "'
                                        ,r_price		= '" . $r_price . "'
                                        ,r_sale_price	= '" . $r_sale_price . "'
                                        ,h_idx			= '" . $product_idx . "'
                                        ,r_idx	        = '" . $r_idx . "'
                                        ,r_name		    = '" . $r_name . "'
                                    where rop_idx	    = '" . $val . "'
                                ";

                            $this->connect->query($sql_su);
                        }
                    }
                }

                $data['min_date'] = strval($min_date);
                $data['max_date'] = strval($max_date);
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

//                var_dump($min_date);
//                die();

                // 상품 테이블 변경
                $this->productModel->update($product_idx, $data);
                //write_log("호텔상품수정 : " . $product_idx);

                // $db = $this->connect->query($sql);
            } else {
                // 옵션 등록
                foreach ($o_idx as $key => $val) {
                    $item_name = $o_name[$key] ?? '';
                    $item_price1 = $o_price1[$key] ?? '';
                    $item_price2 = $o_price2[$key] ?? '';
                    $item_sdate = $o_sdate[$key] ?? '';
                    $item_edate = $o_edate[$key] ?? '';
                    $item_room = $o_room[$key] ?? '';
                    $item_type = $option_type[$key] ?? '';
                    $item_soldout = $o_soldout[$key] ?? '';

                    $sql_su = "insert into tbl_hotel_option SET
                                     goods_code		= '" . $data['product_code'] . "'
                                    ,goods_name		= '" . $item_name . "'
                                    ,goods_price1	= '" . $item_price1 . "'
                                    ,goods_price2	= '" . $item_price2 . "'
                                    ,o_sdate		= '" . $item_sdate . "'
                                    ,o_edate		= '" . $item_edate . "'
                                    ,o_room			= '" . $item_room . "'
                                    ,option_type	= '" . $item_type . "'
                                    ,o_soldout		= '" . $item_soldout . "'
                            ";
                    write_log("2- " . $sql_su);

                    $files = $this->request->getFiles();

                    $this->connect->query($sql_su);

                    $sql_opt = "SELECT LAST_INSERT_ID() AS last_id";
                    $option = $this->connect->query($sql_opt)->getRowArray();
                    $option_idx = $option['last_id'];

                    $dateRange = getDateRange($item_sdate, $item_edate);

                    $ii = -1;
                    foreach ($dateRange as $date) {
                        $ii++;

                        $goods_date = $dateRange[$ii];
                        $dow = dateToYoil($goods_date);

                        $sql_c = "INSERT INTO tbl_hotel_price  SET  
															  o_idx        = '" . $option_idx . "' 	
															 ,goods_code   = '" . $data['product_code'] . "' 	
															 ,goods_name   = '" . $item_name . "'
															 ,goods_date   = '" . $goods_date . "'
															 ,dow 	       = '" . $dow . "'
															 ,goods_price1 = '" . $item_price1 . "' 
															 ,goods_price2 = '" . $item_price2 . "'
															 ,use_yn       = ''
															 ,o_sdate 	   = '" . $item_sdate . "'
															 ,o_edate      = '" . $item_edate . "'
															 ,reg_date     = now() ";
                        write_log("가격정보-2 : " . $sql_c);
                        $this->connect->query($sql_c);
                    }

                }

                $data['min_date'] = $min_date;
                $data['max_date'] = $max_date;

                $data['product_code_1'] = '1303';
                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $count_product_code = $this->productModel->where("product_code", $data['product_code'])->countAllResults();

                if ($count_product_code > 0) {
                    $message = "이미 있는 상품코드입니다. \n 다시 확인해주시기바랍니다.";

                }

                $this->productModel->insertData($data);

                $sql = 'SELECT product_idx FROM tbl_product_mst WHERE product_code = "' . $data['product_code'] . '"';
                $hotel = $this->connect->query($sql)->getRowArray();
                $new_product_idx = $hotel['product_idx'];

                foreach ($o_idx as $key => $val) {
                    $r_key = $sup__key[$key] ?? '';
                    $r_name = $sup_room__name[$key] ?? '';
                    $r_val = $sup__name[$key] ?? '';
                    $r_price = $sup__price[$key] ?? '';
                    $r_sale_price = $sup__price_sale[$key] ?? '';

                    $r_idx = $sup_room__idx[$key] ?? '';

                    $sql_su = "insert into tbl_room_options SET
                                         r_key		= '" . $r_key . "'
                                        ,r_val		= '" . $r_val . "'
                                        ,r_price	= '" . $r_price . "'
                                        ,r_sale_price		= '" . $r_sale_price . "'
                                        ,r_created_at		= '" . date('Y-m-d H:i:s') . "'
                                        ,h_idx			= '" . $new_product_idx . "'
                                        ,r_idx	= '" . $r_idx . "'
                                        ,r_name		= '" . $r_name . "'
                                ";

                    $this->connect->query($sql_su);
                }
            }

            if ($product_idx) {
                $message = "수정되었습니다(Hotel).";
                return "<script>
                    alert('$message');
                    parent.location.reload();
                    </script>";
            }

            $message = "정상적인 등록되었습니다(Hotel).";
            return "<script>
                alert('$message');
                    parent.location.href='/AdmMaster/_hotel/list';
                </script>";


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function change()
    {
        try {
            $product_idx = $this->request->getPost('code_idx') ?? [];
            $onum = $this->request->getPost('onum') ?? [];
            $product_status = $this->request->getPost('product_status') ?? [];

            if (!is_array($product_idx) || !is_array($onum) || count($product_idx) !== count($onum)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => 'Dữ liệu đầu vào không hợp lệ.'
                ]);
            }

            $tot = count($product_idx);

            $builder = $this->connect->table('tbl_product_mst');

            for ($j = 0; $j < $tot; $j++) {
                $data = [
                    'onum' => $onum[$j],
                    'product_status' => $product_status[$j],
                ];

                $builder->where('product_idx', $product_idx[$j]);
                $result = $builder->update($data);

                if (!$result) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => '수정 중 오류가 발생했습니다!!'
                    ]);
                }
            }

            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => '수정 했습니다.'
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function del()
    {
        try {
            $idx = $_POST['product_idx'] ?? '';
            if (!isset($idx)) {
                $data = [
                    'status' => 'error',
                    'error' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            foreach ($idx as $iValue) {
                $sql1 = " update tbl_product_mst set product_status = 'D' where product_idx = '" . $iValue . "' ";
                $db1 = $this->connect->query($sql1);
                if (!$db1) {
                    $data = [
                        'status' => 'error',
                        'error' => 'error!'
                    ];
                    return $this->response->setJSON($data, 400);
                }
            }

            $data = [
                'status' => 'success',
                'message' => 'delete success!'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function get_room()
    {
        $data = [];
        $gidx = $_GET['gidx'] ?? '';

        $_sql = "SELECT * FROM tbl_product_stay WHERE code_no = ?";
        $result = $this->connect->query($_sql, [$gidx]);
        $result = $result->getRowArray();

        if ($result) {
            $room_list = $result['room_list'];
            $room_list = trim($room_list, '|');
            $room_array = explode('|', $room_list);

            if (!empty($room_array)) {
                $room_array_str = implode(',', array_map('intval', $room_array));

                $sql = "SELECT * FROM tbl_room WHERE g_idx IN ($room_array_str)";
                $result = $this->connect->query($sql);
                $rooms = $result->getResultArray();

                foreach ($rooms as $room) {
                    $data[] = [
                        'g_idx' => $room['g_idx'],
                        'roomName' => $room['roomName']
                    ];
                }
            }
        }

        return $this->response->setJSON($data);
    }

    public function getListOption($goods_code)
    {
        if (!isset($goods_code)) {
            return [];
        }
        $gsql = "SELECT * 
                 FROM tbl_hotel_option 
                 WHERE option_type = 'M' 
                 AND goods_code='" . $goods_code . "' 
                 ORDER BY o_room ASC 
            ";

        return $this->connect->query($gsql)->getResultArray();
    }

    public function getListOptionRoom($goods_code, $o_room)
    {
        if (!isset($goods_code)) {
            return [];
        }

        $fsql3 = "SELECT * 
                  FROM tbl_hotel_option 
                  WHERE option_type = 'M' 
                  AND goods_code='" . $goods_code . "' 
                  AND o_room = '" . $o_room . "'
                  ORDER BY o_sdate ASC
            ";

        return $this->connect->query($fsql3)->getResultArray();
    }

    public function getListOptionType($goods_code)
    {
        if (!isset($goods_code)) {
            return [];
        }

        $fsql3 = "select * from tbl_hotel_option where option_type = 'S' and  goods_code='" . $goods_code . "' order by idx asc ";

        return $this->connect->query($fsql3)->getResultArray();
    }

    public function search_code()
    {
        try {
            $codeType = $_POST['codeType'] ?? '';
            $searchCode = $_POST['searchCode'] ?? '';


            if ($codeType === "code") {
                $sql_re = " product_code = '" . $searchCode . "' ";
            }

            $sql_c2 = " SELECT count(*) as cnts FROM tbl_product_mst WHERE " . $sql_re;
            $result_c2 = $this->connect->query($sql_c2);
            $row_c2 = $result_c2->getRowArray();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => $row_c2['cnts']
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del_hotel_option()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'idx가 없습니다.'
                ], 400);
            }

            $sql = "DELETE FROM tbl_hotel_option WHERE idx = " . $idx;
            $this->connect->query($sql);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => '삭제되었습니다.'
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del_room_option()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'idx가 없습니다.'
                ], 400);
            }

            $sql = "DELETE FROM tbl_room_options WHERE rop_idx = " . $idx;
            $this->connect->query($sql);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => '삭제되었습니다.'
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
