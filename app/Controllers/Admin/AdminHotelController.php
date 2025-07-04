<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminHotelController extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $productStay;
    protected $hotelOptionModel;
    private   $memberModel;
    private   $CodeModel;
    protected $productPlace;
    protected $productImg;
    protected $roomImg;


    public function __construct()
    {
        $this->connect          = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel     = model("ProductModel");
        $this->productStay      = model("ProductStay");
        $this->hotelOptionModel = model("HotelOptionModel");
        $this->memberModel      = new \App\Models\Member();
        $this->CodeModel        = model("Code");
        $this->productPlace     = model("ProductPlace");
        $this->productImg       = model("ProductImg");
        $this->roomImg          = model("RoomImg");
    }

    public function list()
    {
        //$g_list_rows     = 10;
        $g_list_rows     = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
		//write_log("g_list_rows- ". $g_list_rows);
        $pg              = updateSQ($_GET["pg"] ?? '1');
        $search_txt      = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy         = $_GET["orderBy"] ?? "1";
        $product_code_1  = 1303;
        $product_code_2  = updateSQ($_GET["product_code_2"] ?? '');
        $product_code_3  = updateSQ($_GET["product_code_3"] ?? '');
        $special_price   = updateSQ($_GET["special_price"] ?? '');

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

        $result   = $this->productModel->findProductPagingAdmin($where, $g_list_rows, $pg, $orderByArr);
        //write_log("last query- ". $this->connect->getLastQuery());

        $fsql     = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no in ('1303')  and status='Y' order by code_no asc";
        $fresult  = $this->connect->query($fsql);
        $fresult  = $fresult->getResultArray();

        $fsql     = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $product_code_1 . "' and status='Y'  order by code_no asc";
        $fresult2 = $this->connect->query($fsql);
        $fresult2 = $fresult2->getResultArray();

        $fsql     = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by code_no asc";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

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
            'fresult'         => $fresult,
            'fresult2'        => $fresult2,
            'fresult3'        => $fresult3,
            'product_code_1'  => $product_code_1,
            'product_code_2'  => $product_code_2,
            'product_code_3'  => $product_code_3,
            'special_price'   => $special_price,

        ];
        return view("admin/_hotel/list", $data);
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

        $img_list = $this->productImg->getImg($product_idx);

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
        return view("admin/_hotel/write", $data);
    }

    public function write_price()
    {
        $product_idx      = updateSQ($_GET["product_idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? '');
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? '');

        if ($product_idx) {
            $row             = $this->productModel->find($product_idx);
            $product_code_no = $row["product_code"];
            $stay_idx        = $row['stay_idx'];
            $hsql            = "SELECT * FROM tbl_product_stay WHERE stay_idx = '" . $stay_idx . "'";
            $hresult         = $this->connect->query($hsql);
            $hresult         = $hresult->getResultArray();

            $room_list       = $hresult[0]['room_list'];
            // 	$room_list 가 공백일때 SELECT distinct(g_idx) AS room_list FROM `tbl_hotel_rooms` WHERE `goods_code` LIKE '2223'  		
            $room_list       = trim($room_list, '|');
            $room_array      = explode('|', $room_list);

            if (!empty($room_array)) {
                $room_array_str = implode(',', array_map('intval', $room_array));

                $sql    = "SELECT * FROM tbl_room WHERE g_idx IN ($room_array_str) ORDER BY g_idx ASC ";
                $result = $this->connect->query($sql);
                $rooms  = $result->getResultArray();

                foreach ($rooms as $room) {
                    $dataRoom[] = [
                        'g_idx'    => $room['g_idx'],
                        'roomName' => $room['roomName']
                    ];
                }
            }
            $rresult = $dataRoom;
        }

        $fsql     = "select * from tbl_room_options where h_idx='" . $product_idx . "' order by r_idx desc, rop_idx desc";
        $roresult = $this->connect->query($fsql);
        $roresult = $roresult->getResultArray();

		$rsql = "SELECT rt.g_idx AS roomType_idx, rt.roomName, r.* FROM tbl_room rt
              				      LEFT JOIN tbl_hotel_rooms r ON rt.g_idx = r.g_idx
				                  WHERE rt.hotel_code = '". $product_idx ."'	
				                  ORDER BY rt.g_idx ASC, r.rooms_idx ASC";
        //write_log($rsql);
        $roomresult = $this->connect->query($rsql);
        $roomresult = $roomresult->getResultArray();

        $conditions = [
						"code_gubun" => 'Room facil',
						"depth"      => '2',
        ];

        $fresult10 = $this->CodeModel->getCodesByConditions($conditions);

        $conditions = [
						"code_gubun" => 'hotel_cate',
						"depth"      => '2',
        ];
        $fresult11 = $this->CodeModel->getCodesByConditions($conditions);

		$sql       = "select * from tbl_room where hotel_code ='". $product_idx ."' order by g_idx asc";
		$roomTypes = $this->connect->query($sql);
		$roomTypes = $roomTypes->getResultArray();

		//$sql           = "select * from tbl_hotel_rooms where goods_code ='". $product_idx ."' order by rooms_idx desc";
		//$roomsByType   = $this->connect->query($sql);
		//$roomsByType   = $roomsByType->getResultArray();

		$sql = "SELECT * FROM tbl_hotel_rooms WHERE goods_code = ? ORDER BY rooms_idx ASC";
		$roomsByType = $this->connect->query($sql, [$product_idx])->getResultArray();

		$allBeds = []; // 모든 침대 데이터를 저장할 배열

		foreach ($roomsByType as $room) {
			$rooms_idx = $room['rooms_idx']; 
			$sql_bed   = "SELECT * FROM tbl_room_beds WHERE rooms_idx = ? ORDER BY bed_seq ASC";
			$bedByType = $this->connect->query($sql_bed, [$rooms_idx])->getResultArray();
			$allBeds[$rooms_idx] = $bedByType; // 각 방의 침대 데이터를 저장
		}
        
        $data = [
					'product_idx'      => $product_idx,
					'product_code_no'  => $product_code_no,
					'pg'               => $pg,
					'search_name'      => $search_name,
					'search_category'  => $search_category,
					's_product_code_1' => $s_product_code_1,
					's_product_code_2' => $s_product_code_2,
					'row'              => $row ?? '',
					'roresult'         => $roresult,
					'hresult'          => $hresult,
					'rresult'          => $rresult,
					'fresult10'        => $fresult10,
					'fresult11'        => $fresult11,
					'roomresult'       => $roomresult,
					'roomTypes'        => $roomTypes,
					'roomsByType'      => $roomsByType,
			        'allBeds'          => $allBeds,
			
        ];
        return view("admin/_hotel/write_price", $data);
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

    private function write_stay_ok()
    {
        $files = $this->request->getFiles();

        $stay_idx = updateSQ($_POST["stay_idx"] ?? '');
        $stay_code = updateSQ($_POST["stay_code"] ?? '');

        $country_code_1 = updateSQ($_POST["country_code_1"] ?? $_POST["product_code_1"]);
        $country_code_2 = updateSQ($_POST["country_code_2"] ?? $_POST["product_code_1"]);
        $country_code_3 = updateSQ($_POST["country_code_3"] ?? $_POST["product_code_1"]);

        $stay_city = updateSQ($_POST["stay_city"] ?? '');
        $stay_user_name = updateSQ($_POST["stay_user_name"] ?? '');
        $stay_name_eng = updateSQ($_POST["stay_name_eng"] ?? $_POST["product_name"]);
        $stay_name_kor = updateSQ($_POST["stay_name_kor"] ?? $_POST["product_name"]);
        $stay_address = updateSQ($_POST["stay_address"] ?? '');
        $stay_level = updateSQ($_POST["stay_level"] ?? '');
        $stay_check_in = updateSQ($_POST["stay_check_in"] ?? '');
        $stay_check_in_ampm = updateSQ($_POST["stay_check_in_ampm"] ?? '');
        $stay_check_in_hour = updateSQ($_POST["stay_check_in_hour"] ?? '');
        $stay_check_in_min = updateSQ($_POST["stay_check_in_min"] ?? '');

        $stay_check_out = updateSQ($_POST["stay_check_out"] ?? '');
        $stay_check_out_ampm = updateSQ($_POST["stay_check_out_ampm"] ?? '');
        $stay_check_out_hour = updateSQ($_POST["stay_check_out_hour"] ?? '');
        $stay_check_out_min = updateSQ($_POST["stay_check_out_min"] ?? '');

        $stay_service = updateSQ($_POST["stay_service"] ?? '');
        $stay_parking = updateSQ($_POST["stay_parking"] ?? '');
        $stay_room = updateSQ($_POST["stay_room"] ?? '');
        $stay_homepage = updateSQ($_POST["stay_homepage"] ?? '');
        $stay_contents = updateSQ($_POST["stay_contents"] ?? '');

        $facilities = updateSQ($_POST["facilities"] ?? '');
        $room_facil = updateSQ($_POST["room_facil"] ?? '');
        $room_list = updateSQ($_POST["room_list"] ?? '');

        $tel_no = updateSQ($_POST["tel_no"] ?? '');
        $note = updateSQ($_POST["note"] ?? '');
        $stay_onum = updateSQ($_POST["stay_onum"] ?? '');

        $code_utilities = updateSQ($_POST["code_utilities"] ?? '');
        $code_services = updateSQ($_POST["code_services"] ?? '');
        $code_best_utilities = updateSQ($_POST["code_best_utilities"] ?? '');
        $code_populars = updateSQ($_POST["code_populars"] ?? '');
        $latitude = updateSQ($_POST["latitude"] ?? '');
        $longitude = updateSQ($_POST["longitude"] ?? '');

        for ($i = 1; $i <= 5; $i++) {
            $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;
            ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);

            if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                $sql = "UPDATE tbl_product_stay SET 
                            ufile" . $i . "='',
                            rfile" . $i . "=''
                            WHERE stay_idx='$stay_idx'
                        ";
                $this->connect->query($sql);
            } elseif (isset($file) && $file->isValid() && !$file->hasMoved()) {
                ${"rfile_" . $i} = $file->getName();
                ${"ufile_" . $i} = $file->getRandomName();
                $publicPath = ROOTPATH . 'public/uploads/products/';
                $file->move($publicPath, ${"ufile_" . $i});

                if ($stay_idx) {
                    $sql = "UPDATE tbl_product_stay SET 
                                ufile" . $i . "='" . ${"ufile_" . $i} . "',
                                rfile" . $i . "='" . ${"rfile_" . $i} . "'
                                WHERE stay_idx='$stay_idx';
                            ";
                    $this->connect->query($sql);
                }
            } else {
                ${"rfile_" . $i} = '';
                ${"ufile_" . $i} = '';
            }
        }

        if ($stay_idx) {
            $sql = "update tbl_product_stay SET 
                            stay_code				= '" . $stay_code . "'
                            ,country_code_1			= '" . $country_code_1 . "'
                            ,country_code_2			= '" . $country_code_2 . "'
                            ,country_code_3			= '" . $country_code_3 . "'
                            ,stay_city				= '" . $stay_city . "'
                            ,stay_user_name			= '" . $stay_user_name . "'
                            ,stay_name_eng			= '" . $stay_name_eng . "'
                            ,stay_name_kor			= '" . $stay_name_kor . "'
                            ,stay_address			= '" . $stay_address . "'
                            ,stay_level				= '" . $stay_level . "'
                            ,stay_check_in			= '" . $stay_check_in . "'
                            ,stay_check_in_ampm		= '" . $stay_check_in_ampm . "'
                            ,stay_check_in_hour		= '" . $stay_check_in_hour . "'
                            ,stay_check_in_min		= '" . $stay_check_in_min . "'
                            ,stay_check_out			= '" . $stay_check_out . "'
                            ,stay_check_out_ampm	= '" . $stay_check_out_ampm . "'
                            ,stay_check_out_hour	= '" . $stay_check_out_hour . "'
                            ,stay_check_out_min		= '" . $stay_check_out_min . "'
                            ,stay_service			= '" . $stay_service . "'
                            ,stay_parking			= '" . $stay_parking . "'
                            ,stay_room				= '" . $stay_room . "'
                            ,facilities			    = '" . $facilities . "'
                            ,room_facil			    = '" . $room_facil . "'
                            ,room_list			    = '" . $room_list . "'
                            ,stay_homepage			= '" . $stay_homepage . "'
                            ,stay_contents			= '" . $stay_contents . "'
                            ,tel_no			        = '" . $tel_no . "'
                            ,note			   	 	= '" . $note . "'
                            ,stay_onum				= '" . $stay_onum . "'
                            ,code_utilities			= '" . $code_utilities . "'
                            ,code_services			= '" . $code_services . "'
                            ,code_best_utilities	= '" . $code_best_utilities . "'
                            ,code_populars			= '" . $code_populars . "'
                            ,latitude			    = '" . $latitude . "'
                            ,longitude			    = '" . $longitude . "'
                            ,stay_m_date			= now()
                        where stay_idx				= '" . $stay_idx . "'
                    ";

            $db = $this->connect->query($sql);
            $message = "수정되었습니다.";

        } else {
            $sql = "insert into tbl_product_stay SET 
                            stay_code				= '" . $stay_code . "'
                            ,country_code_1			= '" . $country_code_1 . "'
                            ,country_code_2			= '" . $country_code_2 . "'
                            ,country_code_3			= '" . $country_code_3 . "'
                            ,stay_city				= '" . $stay_city . "'
                            ,stay_user_name			= '" . $stay_user_name . "'
                            ,stay_name_eng			= '" . $stay_name_eng . "'
                            ,stay_name_kor			= '" . $stay_name_kor . "'
                            ,stay_address			= '" . $stay_address . "'
                            ,stay_level				= '" . $stay_level . "'
                            ,stay_check_in			= '" . $stay_check_in . "'
                            ,stay_check_in_ampm		= '" . $stay_check_in_ampm . "'
                            ,stay_check_in_hour		= '" . $stay_check_in_hour . "'
                            ,stay_check_in_min		= '" . $stay_check_in_min . "'
                            ,stay_check_out			= '" . $stay_check_out . "'
                            ,stay_check_out_ampm	= '" . $stay_check_out_ampm . "'
                            ,stay_check_out_hour	= '" . $stay_check_out_hour . "'
                            ,stay_check_out_min		= '" . $stay_check_out_min . "'
                            ,stay_service			= '" . $stay_service . "'
                            ,stay_parking			= '" . $stay_parking . "'
                            ,stay_room				= '" . $stay_room . "'
                            ,facilities			    = '" . $facilities . "'
                            ,room_facil			    = '" . $room_facil . "'
                            ,room_list			    = '" . $room_list . "'
                            ,stay_homepage			= '" . $stay_homepage . "'
                            ,stay_contents			= '" . $stay_contents . "'
                            ,tel_no			        = '" . $tel_no . "'
                            ,stay_onum				= '" . $stay_onum . "'
                            ,rfile1					= '" . $rfile_1 . "'
                            ,rfile2					= '" . $rfile_2 . "'
                            ,rfile3					= '" . $rfile_3 . "'
                            ,rfile4					= '" . $rfile_4 . "'
                            ,rfile5					= '" . $rfile_5 . "'
                            ,ufile1					= '" . $ufile_1 . "'
                            ,ufile2					= '" . $ufile_2 . "'
                            ,ufile3					= '" . $ufile_3 . "'
                            ,ufile4					= '" . $ufile_4 . "'
                            ,ufile5					= '" . $ufile_5 . "'
                            ,code_utilities			= '" . $code_utilities . "'
                            ,code_services			= '" . $code_services . "'
                            ,code_best_utilities	= '" . $code_best_utilities . "'
                            ,code_populars			= '" . $code_populars . "'
                            ,latitude			    = '" . $latitude . "'
                            ,longitude			    = '" . $longitude . "'
                            ,stay_m_date			= now()
                            ,stay_r_date			= now()
                    ";
            $db = $this->connect->query($sql);

            $stay_idx = $this->connect->insertID();
            $sql = "update tbl_product_stay SET 
                            code_no = 'H" . str_pad($stay_idx, 4, "0", STR_PAD_LEFT) . "'
                            where stay_idx = '" . $stay_idx . "'
                    ";

            $db = $this->connect->query($sql);

            $message = "등록되었습니다.";
        }

        return $stay_idx;
    }

    private function write_stay_ok2()
    {
        $files = $this->request->getFiles();
        $stay_idx = updateSQ($this->request->getPost("stay_idx"));
        $stay_code = updateSQ($this->request->getPost("stay_code"));

        $fields = [
            'country_code_1', 'country_code_2', 'country_code_3', 'stay_city', 'stay_user_name',
            'stay_address', 'stay_level', 'stay_check_in', 'stay_check_in_ampm', 'stay_check_in_hour',
            'stay_check_in_min', 'stay_check_out', 'stay_check_out_ampm', 'stay_check_out_hour',
            'stay_check_out_min', 'stay_service', 'stay_parking', 'stay_room', 'stay_homepage', 'stay_contents',
            'facilities', 'room_facil', 'room_list', 'tel_no', 'note', 'stay_onum', 'code_utilities',
            'code_services', 'code_best_utilities', 'code_populars', 'latitude', 'longitude'
        ];

        foreach ($fields as $field) {
            $data[$field] = updateSQ($this->request->getPost($field) ?? '');
        }

        $data['stay_code'] = $stay_code ?? '';
        $data['country_code_1'] = $this->request->getPost('country_code_1') ?? $this->request->getPost('product_code_1');
        $data['country_code_2'] = $this->request->getPost('country_code_1') ?? $this->request->getPost('product_code_2');
        $data['country_code_3'] = $this->request->getPost('country_code_1') ?? $this->request->getPost('product_code_3');

        $data['stay_name_eng'] = $this->request->getPost('product_name');
        $data['stay_name_kor'] = $this->request->getPost('product_name');
        $data['stay_level'] = $this->request->getPost('stay_level') ?? 1;

        // Handle file uploads
        $uploadPath = ROOTPATH . 'public/uploads/products/';
        for ($i = 1; $i <= 5; $i++) {
            $file = $files["ufile$i"] ?? null;
            $checkImg = $this->request->getPost("checkImg_$i");

            if ($checkImg === "N") {
                $this->connect->query("UPDATE tbl_product_stay SET ufile$i='', rfile$i='' WHERE stay_idx='$stay_idx'");
            } elseif ($file && $file->isValid() && !$file->hasMoved()) {
                $randomName = $file->getRandomName();
                $file->move($uploadPath, $randomName);

                $data["rfile$i"] = $file->getClientName();
                $data["ufile$i"] = $randomName;
            }
        }

        if ($stay_idx) {
            $this->productStay->update($stay_idx, $data);
        } else {
            $this->productStay->insert($data);
            $stay_idx = $this->connect->insertID();

            $code_no = "H" . str_pad($stay_idx, 4, "0", STR_PAD_LEFT);
            $this->productStay->update($stay_idx, ['code_no' => $code_no]);
        }

        return $data;
    }

    public function change()
    {
        try {
            $product_idx = $this->request->getPost('code_idx') ?? [];
            $onum = $this->request->getPost('onum') ?? [];
            $product_status = $this->request->getPost('product_status') ?? [];
            $special_price = $this->request->getPost('special_price') ?? [];
            $product_best = $this->request->getPost('product_best') ?? [];

            if (!is_array($product_idx) || !is_array($onum) || count($product_idx) !== count($onum)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => '입력 데이터가 잘못되었습니다.'
                ]);
            }

            $tot = count($product_idx);

            $builder = $this->connect->table('tbl_product_mst');

            for ($j = 0; $j < $tot; $j++) {
                $data = [
                    'onum' => $onum[$j],
                    'product_status' => $product_status[$j],
                    'special_price' => $special_price[$j],
                    'product_best' => $product_best[$j],
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

    public function del_image()
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

            $result = $this->productImg->updateData($i_idx, [
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

    public function del_all_image()
    {
        try {
            $request = service('request');
            $imgData = $request->getJSON();
    
            if (!empty($imgData->arr_img)) {
                foreach ($imgData->arr_img as $item) {
                    $i_idx = $item->i_idx;

                    $result = $this->productImg->updateData($i_idx, [
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
        
                }
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

                $sql = "SELECT * FROM tbl_room WHERE g_idx IN ($room_array_str) ORDER BY onum ASC, g_idx DESC";
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
                 ORDER BY o_room DESC, o_sdate DESC
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
                  ORDER BY o_room DESC, o_sdate DESC
            ";

        return $this->connect->query($fsql3)->getResultArray();
    }

    public function getListOptionType($goods_code)
    {
        if (!isset($goods_code)) {
            return [];
        }

        $fsql3 = "select * from tbl_hotel_option where option_type = 'S' and  goods_code='" . $goods_code . "' order by idx DESC ";

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

    public function updateData()
    {
        try {
            $sql = "SELECT * FROM tbl_product_mst WHERE product_code_1 = '1303'";
            $result = $this->connect->query($sql)->getResultArray();

            $cnt = count($result);

            for ($i = 0; $i < $cnt; $i++) {
                $product_idx = $result[$i]['product_idx'];

                $product_code_list = $result[$i]['product_code_list'];

                $arr_product_code_list = explode('|', $product_code_list);

                $cnt2 = count($arr_product_code_list);

                $product_code_ = null;
                for ($j = 0; $j < $cnt2; $j++) {
                    $length = strlen($arr_product_code_list[$j]);

                    if ($arr_product_code_list[$j] != '' && $length > 4) {
                        $product_code_ = $arr_product_code_list[$j];
                        break;
                    }
                }

                if ($product_code_) {
                    $product_code_2 = '';
                    $product_code_3 = '';

                    $length = strlen($product_code_);

                    if ($length == 8) {
                        $product_code_2 = substr($product_code_, 0, 6);
                        $product_code_3 = $product_code_;
                    } elseif ($length == 6) {
                        $product_code_2 = $product_code_;
                    }

                    $data = [
                        'product_code_2' => $product_code_2,
                        'product_code_3' => $product_code_3
                    ];
                    $this->connect->table('tbl_product_mst')
                        ->set($data)
                        ->where('product_idx', $product_idx)
                        ->update();
                }
            }

            $sql = "SELECT product_idx,product_code_1,product_code_2,product_code_3,product_code_list  FROM tbl_product_mst WHERE product_code_1 = '1303'";
            $result = $this->connect->query($sql)->getResultArray();

            return $this->response->setJSON([
                'status' => 'success',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    function update_room_order() {
        $request = service('request');
        $orderData = $request->getJSON();

        if (!empty($orderData->order)) {
            foreach ($orderData->order as $item) {
                $sql = "UPDATE tbl_room SET onum = {$item->position} WHERE g_idx = {$item->g_idx}";
                $result = $this->connect->query($sql);
            }
        }

    }
}
