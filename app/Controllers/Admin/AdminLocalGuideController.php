<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminLocalGuideController extends BaseController
{
    protected $connect;
    protected $localGuide;
    protected $productStay;
    protected $hotelOptionModel;
    private   $memberModel;
    private   $CodeModel;
    protected $productPlace;
    protected $localGuideImg;
    protected $roomImg;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->localGuide       = model("LocalGuideModel");
        $this->memberModel      = new \App\Models\Member();
        $this->CodeModel        = model("Code");
        $this->localGuideImg    = model("LocalGuideImg");
    }

    public function list()
    {
        //$g_list_rows     = 10;
        $g_list_rows     = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg              = updateSQ($_GET["pg"] ?? '1');
        $search_txt      = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy         = $_GET["orderBy"] ?? "1";
        $product_code_1  = 1303;
        $product_code_2  = updateSQ($_GET["product_code_2"] ?? '');
        $product_code_3  = updateSQ($_GET["product_code_3"] ?? '');

        $where = [
            'search_txt'      => $search_txt,
            'search_category' => $search_category,
            'orderBy'         => $orderBy,
            'product_code_1'  => $product_code_1,
            'product_code_2'  => $product_code_2,
            'product_code_3'  => $product_code_3,
        ];

        if (!empty($special_price)) {
            $where['special_price'] = $special_price;
        }

        $orderByArr = [];

        if ($orderBy == 1) {
			$orderByArr = [
				'onum'   => 'ASC',
				'r_date' => 'DESC'
			];			
        } elseif ($orderBy == 2) {
            $orderByArr['r_date'] = "DESC";
        } else {
            $orderByArr['r_date'] = "DESC";
        }

        $result = $this->localGuide->get_list($where, $g_list_rows, $pg, $orderByArr);

        $data = [
            'result'          => $result['items'],
            'orderBy'         => $orderBy,
            'num'             => $result['num'],
            'nTotalCount'     => $result['nTotalCount'],
            'nPage'           => $result['nPage'],
            'pg'              => $pg,
            'g_list_rows'     => $g_list_rows,
            'search_txt'      => $search_txt,
            'search_category' => $search_category,
            'product_code_1'  => $product_code_1,
            'product_code_2'  => $product_code_2,
            'product_code_3'  => $product_code_3,

        ];
        return view("admin/_local_guide/list", $data);
    }

    public function write()
    {
        $product_idx      = updateSQ($_GET["product_idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? '');
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? '');
        $s_product_code_3 = updateSQ($_GET["s_product_code_3"] ?? '');

        $conditions = [
            "code_gubun" => 'tour',
            "code_no"    => '1303',
        ];
        $fresult = $this->CodeModel->getCodesByConditions($conditions);

        $fsql = " select *
						, (select code_name from tbl_code where code_gubun = 'stay' and depth='2' and tbl_code.code_no=tbl_product_stay.stay_code) as stay_gubun
						, (select code_name from tbl_code where code_gubun = 'country' and depth='2' and tbl_code.code_no=tbl_product_stay.country_code_1) as country_name_1
						, (select code_name from tbl_code where code_gubun = 'country' and depth='3' and tbl_code.code_no=tbl_product_stay.country_code_2) as country_name_2
						from tbl_product_stay where 1=1";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        $product_code_no = $this->productModel->createProductCode("H");

        $stay_item = [];

        $mcodes = $this->CodeModel->getByParentCode('56')->getResultArray();

        if ($product_idx) {
            $row = $this->productModel->find($product_idx);
            $product_code_no = $row["product_code"];
            $stay_idx = $row['stay_idx'];
            $hsql = "SELECT * FROM tbl_product_stay WHERE stay_idx = '" . $stay_idx . "'";
            $hresult = $this->connect->query($hsql);
            $hresult = $hresult->getResultArray();

            $room_list = $hresult[0]['room_list'];
            $room_list = trim($room_list, '|');
            $room_array = explode('|', $room_list);

            if (!empty($room_array)) {
                $room_array_str = implode(',', array_map('intval', $room_array));

                $sql = "SELECT * FROM tbl_room WHERE g_idx IN ($room_array_str) ORDER BY onum ASC, g_idx DESC";
                $result = $this->connect->query($sql);
                $rooms = $result->getResultArray();

                foreach ($rooms as $room) {
                    $dataRoom[] = [
                        'g_idx' => $room['g_idx'],
                        'roomName' => $room['roomName']
                    ];
                }
            }
            $rresult = $dataRoom;

            $stay_item = $hresult[0];
        }

        $conditions = [
            "parent_code_no" => '30',
        ];
        $fresult9 = $this->CodeModel->getCodesByConditions($conditions);

        $fsql = "select * from tbl_room_options where h_idx='" . $product_idx . "' order by rop_idx desc";
        $roresult = $this->connect->query($fsql);
        $roresult = $roresult->getResultArray();

        $conditions = [
            "parent_code_no" => '38',
        ];
        $product_themes = $this->CodeModel->getCodesByConditions($conditions);

        $conditions = [
            "code_gubun"      => 'tour',
            "parent_code_no"  =>  $row['product_code_2'],
        ];
        $category3 = $this->CodeModel->getCodesByConditions($conditions);

        $conditions = [
            "parent_code_no" => '39',
        ];
        $product_bedrooms = $this->CodeModel->getCodesByConditions($conditions);

        $conditions = [
            "parent_code_no" => '40',
        ];
        $product_types = $this->CodeModel->getCodesByConditions($conditions);

        $conditions = [
            "parent_code_no" => '41',
        ];
        $product_promotions = $this->CodeModel->getCodesByConditions($conditions);

        $mresult = $this->memberModel->getMembersPaging(['user_level' => 2], 1, 1000)['items'];

        $conditions = [
            "code_gubun" => 'tour',
            "parent_code_no" => '33',
        ];
        $fresult6 = $this->CodeModel->getCodesByConditions($conditions);

        $conditions = [
            "code_gubun" => 'tour',
            "parent_code_no" => '34',
        ];
        $fresult5 = $this->CodeModel->getCodesByConditions($conditions);

        $fresult5 = array_map(function ($item) {
            $rs = (array)$item;

            $code_no = $rs['code_no'];

            $conditions = [
                "code_gubun" => 'tour',
                "parent_code_no" => $code_no,
            ];
            $rs_child = $this->CodeModel->getCodesByConditions($conditions);

            $rs['child'] = $rs_child;

            return $rs;
        }, $fresult5);

        $conditions = [
            "code_gubun" => 'tour',
            "parent_code_no" => '35',
        ];
        $fresult8 = $this->CodeModel->getCodesByConditions($conditions);

        $conditions = [
            "code_gubun" => 'Room facil',
            "depth" => '2',
        ];
        $fresult10 = $this->CodeModel->getCodesByConditions($conditions);

        $conditions = [
            "code_gubun" => 'hotel_cate',
            "depth" => '2',
        ];
        $fresult11 = $this->CodeModel->getCodesByConditions($conditions);

        $img_list = $this->localGuideImg->getImg($product_idx);

        $fsql = "select * from tbl_code where depth='3'  
                        AND parent_code_no = '" . $row['product_code_1'] . "'
                        AND status='Y'  order by onum asc, code_idx desc";
        $fresult_c_1 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult_c_1 = $fresult_c_1->getResultArray();

        $fsql = "select * from tbl_code where depth='4' and parent_code_no='" . $row['product_code_2'] . "' and status='Y'  order by onum asc, code_idx desc";
        $fresult_c_2 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult_c_2 = $fresult_c_2->getResultArray();

        $data = [
            'product_idx' => $product_idx,
            'product_code_1' => $row['product_code_1'],
            'product_code_2' => $row['product_code_2'],
            'product_code_3' => $row['product_code_3'],
            'product_code_no' => $product_code_no,
            'fresult_c_1' => $fresult_c_1,
            'fresult_c_2' => $fresult_c_2,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            's_product_code_3' => $s_product_code_3,
			'category3'     => $category3,
            'row' => $row ?? '',
            'img_list' => $img_list,
            'fresult' => $fresult,
            'fresult3' => $fresult3,
            'fresult9' => $fresult9,
            'roresult' => $roresult,
            'pthemes' => $product_themes,
            'pbedrooms' => $product_bedrooms,
            'ptypes' => $product_types,
            'ppromotions' => $product_promotions,
            'hresult' => $hresult,
            'rresult' => $rresult,
            'member_list' => $mresult,
            'fresult6' => $fresult6,
            'fresult5' => $fresult5,
            'fresult8' => $fresult8,
            'fresult10' => $fresult10,
            'fresult11' => $fresult11,
            'stay_item' => $stay_item,
            'mcodes' => $mcodes,
        ];
        return view("admin/_local_guide/write", $data);
    }

    public function write_ok($product_idx = null)
    {
		
        $connect = $this->connect;
        try {
            $files = $this->request->getFiles();

            $onum = updateSQ($_POST["onum"] ?? '');
            if (isset($_POST['select_product'])) {
                $selected_products = $_POST['select_product'];
                if (is_array($selected_products)) {
                    $product_theme = implode('|', $selected_products) . '|';
                }
            } else {
                $product_theme = '';
            }

            if (isset($_POST['product_bedrooms'])) {
                $selected_product_bedrooms = $_POST['product_bedrooms'];
                if (is_array($selected_product_bedrooms)) {
                    $product_bedroom = implode('|', $selected_product_bedrooms) . '|';
                }
            } else {
                $product_bedroom = '';
            }

            if (isset($_POST['product_type'])) {
                $selected_product_type = $_POST['product_type'];
                if (is_array($selected_product_type)) {
                    $product_type = implode('|', $selected_product_type) . '|';
                }
            } else {
                $product_type = '';
            }

            if (isset($_POST['product_promotions'])) {
                $selected_promotions = $_POST['product_promotions'];
                if (is_array($selected_promotions)) {
                    $product__promotions = implode('|', $selected_promotions) . '|';
                }
            } else {
                $product__promotions = '';
            }

            $data['product_code_list']  = updateSQ($_POST["product_code_list"] ?? '');
            $data['product_code']       = updateSQ($_POST["product_code"] ?? '');
            $data['product_code_2']     = updateSQ($_POST["product_code_2"] ?? '');
            $data['product_code_3']     = updateSQ($_POST["product_code_3"] ?? '');
            $data['product_name']       = updateSQ($_POST["product_name"] ?? '');
            $data['product_name_en']    = updateSQ($_POST["product_name_en"] ?? '');
            $data['keyword']            = updateSQ($_POST["keyword"] ?? '');
            $data['product_status']     = updateSQ($_POST["product_status"] ?? '');

            $data['onum']               = updateSQ($onum ?? '');

            $data['product_level']      = updateSQ($_POST["product_level"] ?? '');
            $data['addrs']              = updateSQ($_POST["addrs"] ?? '');
            $data['room_cnt']           = updateSQ($_POST["room_cnt"] ?? '');
            $data['product_info']       = updateSQ($_POST["product_info"] ?? '');
            $data['product_intro']      = updateSQ($_POST["product_intro"] ?? '');
            $data['product_best']       = updateSQ($_POST["product_best"] ?? 'N');
            $data['special_price']      = updateSQ($_POST["special_price"] ?? 'N');
            $data['direct_payment']     = updateSQ($_POST["direct_payment"] ?? 'N');
            $data['is_view']            = updateSQ($_POST["is_view"] ?? 'Y');

            $data['product_theme']      = updateSQ($product_theme);
            $data['product_bedrooms']   = updateSQ($product_bedroom); // code=39 호텔 침실수
            $data['product_type']       = updateSQ($product_type); // code=40 호텔타입
            $data['product_promotions'] = updateSQ($product__promotions);// code=41 호텔 프로모션

            $data['product_important_notice']   = updateSQ($_POST["product_important_notice"] ?? '');
            $data['product_important_notice_m'] = updateSQ($_POST["product_important_notice_m"] ?? '');
            $data['product_notes']      = updateSQ($_POST["product_notes"] ?? '');
            $data['product_notes_m']    = updateSQ($_POST["product_notes_m"] ?? '');
            $data['room_guides']        = updateSQ($_POST["room_guides"] ?? '');
            $data['important_notes']    = updateSQ($_POST["important_notes"] ?? '');


            $data['product_video']      = updateSQ($_POST["product_video"] ?? '');
            $data['stay_idx']           = $_POST["stay_idx"] ?? '';

            $data['mbti']               = $_POST["mbti"] ?? '';

            $phone                      = updateSQ($_POST["phone"] ?? '');
            $email                      = updateSQ($_POST["email"] ?? '');
            $product_manager            = updateSQ($_POST["product_manager"] ?? '');

            $data['product_manager']    = updateSQ($product_manager);
            $data['product_manager_id'] = updateSQ($_POST["product_manager_id"] ?? '');

            $data['phone']              = updateSQ($phone);
            $data['email']              = updateSQ($email);

            $dataProductMore            = "";

            $meet_out_time              = $_POST['meet_out_time'] ?? '';
            $children_policy            = $_POST['children_policy'] ?? '';
            $baby_beds                  = $_POST['baby_beds'] ?? '';
            $deposit_regulations        = $_POST['deposit_regulations'] ?? '';
            $pets                       = $_POST['pets'] ?? '';
            $age_restriction            = $_POST['age_restriction'] ?? '';
            $smoking_policy             = $_POST['smoking_policy'] ?? '';
            $breakfast                  = $_POST['breakfast'] ?? '';

            $breakfast_item_name_arr    = $_POST['breakfast_item_name_'];
            $breakfast_item_value_arr   = $_POST['breakfast_item_value_'];

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

            $min_date = date('Y-m-d');
            $max_date = date('Y-m-d');

            /* Update or Create product stay */
            $stay_idx = $this->write_stay_ok();

            $data['stay_idx'] = $stay_idx;

            $arr_i_idx = $this->request->getPost("i_idx") ?? [];
            $arr_onum = $this->request->getPost("onum_img") ?? [];

            $files = $this->request->getFileMultiple('ufile') ?? [];

            if ($product_idx) {
                $data['min_date']    = strval($min_date);
                $data['max_date']    = strval($max_date);
                $data['m_date']      = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                $data['worker_id']   = session()->get('member')['id'];
                $data['worker_name'] = session()->get('member')['name'];

                $this->productModel->update($product_idx, $data);

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
                            $this->localGuideImg->updateData($i_idx, [
                                "onum" => $arr_onum[$key],
                            ]);
                        }

                        if ($file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);
                
                            if (!empty($i_idx)) {
                                $this->localGuideImg->updateData($i_idx, [
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "m_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            } else {
                                $this->localGuideImg->insertData([
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
                $data['min_date'] = $min_date;
                $data['max_date'] = $max_date;

                $data['product_code_1'] = '1303';
                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->productModel->insertData($data);

                $room_list = $_POST["room_list"] ?? '';

                $place_list = $_POST["place_list"] ?? '';

                $place_arr_ = array_unique(explode('|', $place_list));

                $updateQuery = "UPDATE tbl_product_stay SET room_list = ? WHERE stay_idx = ?";
                $this->connect->query($updateQuery, [$room_list, $stay_idx]);

                $placeData = [
                    'product_idx' => $stay_idx,
                ];

                foreach ($place_arr_ as $place_idx) {
                    $this->productPlace->update($place_idx, $placeData);
                }

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

                            $this->localGuideImg->insertData([
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
                $message = "수정되었습니다(Hotelx).";
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
}
