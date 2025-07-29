<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use App\Models\GuideOptions;
use App\Models\GuideSupOptions;
use App\Models\OrdersModel;
use CodeIgniter\I18n\Time;
use Config\CustomConstants as ConfigCustomConstants;


class MyPage extends BaseController
{
    private $db;
    private $member;
    private $travel_contact;
    private $travel_qna;
    private $sessionLib;
    private $sessionChk;
    private $ordersModel;
    private $orderSubModel;
    private $golfOptionModel;
    private $orderOptionModel;
    private $orderTours;
    private $optionTours;
    private $memberBank;
    private $code;
    private $coupon;
    private $orderMileage;
    private $carsCategory;
    private $carsPrice;
    private $ordersCars;
    private $orderGuide;
    protected $guideOptionModel;
    protected $guideSupOptionModel;
    private $ReviewModel;
    private $Bbs;
    private $policyModel;
    protected $policyCancel;

    public function __construct()
    {
        helper(['html']);
        $this->db = db_connect();
        $this->member = model('Member');
        $this->travel_contact = model('TravelContactModel');
        $this->travel_qna = model('TravelQnaModel');
        $this->orderTours = model("OrderTourModel");
        $this->optionTours = model("OptionTourModel");
        $this->memberBank = model("MemberBank");
        $this->coupon = model("Coupon");
        $this->code = model("Code");
        $this->orderMileage = model("OrderMileage");
        $this->carsCategory = model("CarsCategory");
        $this->carsPrice = model("CarsPrice");
        $this->ordersCars = model("OrdersCarsModel");
        $this->ReviewModel = model("ReviewModel");
        $this->policyCancel = model("PolicyCancel");
        $this->Bbs = model("Bbs");
        $this->policyModel = model("PolicyModel");

        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        $this->ordersModel = new \App\Models\OrdersModel();
        $this->orderSubModel = new \App\Models\OrderSubModel();
        $this->golfOptionModel = new \App\Models\GolfOptionModel();
        $this->orderOptionModel = new \App\Models\OrderOptionModel();
        $this->orderGuide = new \App\Models\OrderGuideModel();
        helper('my_helper');
        $constants = new ConfigCustomConstants();
        helper('alert_helper');

        $this->guideOptionModel = new GuideOptions();
        $this->guideSupOptionModel = new GuideSupOptions();
    }

    public function booklist() {

        $dateType     = $this->request->getGet("dateType");           // 날짜기준
		$procType     = $this->request->getGet("procType");           // 진행상태
        $checkInDate  = $this->request->getGet("checkInDatex");       // 시작일
        $checkOutDate = $this->request->getGet("checkOutDatex");      // 종료일
		
		//write_log("booklist()- ". $checkInDate ." - ". $checkOutDate);
        $payType      = $this->request->getGet("payType");           // 결제상태
        $prodType     = $this->request->getGet("prodType");          // 상품종류
        $searchType   = $this->request->getGet("searchType");        // 검색구분
        $search_word  = trim($this->request->getGet('search_word')); // 검색어
		
        $pg           = $this->request->getGet("pg");
        $g_list_rows  = 10;
        if ($pg == "") {
            $pg = 1;
        }

		$result      = $this->ordersModel->getOrdersGroup($pg, $g_list_rows,  $dateType, $procType, $checkInDate, $checkOutDate, $payType, $prodType, $searchType, $search_word);
		$groupCounts = $this->ordersModel->getGroupCounts($dateType, $procType, $checkInDate, $checkOutDate, $payType, $prodType, $searchType, $search_word);
		
        $policy_1 = $this->policyModel->getByIdx("33");
        $policy_2 = $this->policyModel->getByIdx("34");
        $policy_3 = $this->policyModel->getByIdx("35");
        $policy_4 = $this->policyModel->getByIdx("36");
        $policy_5 = $this->policyModel->getByIdx("37");

		$data = [
					'nTotalCount'      => $result['nTotalCount'],
					'nPage'            => $result['nPage'],
					'g_list_rows'      => $g_list_rows,
					'pg'               => $pg,
					'num'              => $result['num'],
					'order_list'       => $result['order_list'],
					'groupCounts'      => $groupCounts,   
					'dateType'         => $dateType, 
			        'procType'         => $procType,
					'checkInDate'      => $checkInDate,       
					'checkOutDate'     => $checkOutDate,       
					'payType'          => $payType,           
					'prodType'         => $prodType,          
					'searchType'       => $searchType,       
					'search_word'      => $search_word,
					'policy_1'         => $policy_1,  
					'policy_2'         => $policy_2,  
					'policy_3'         => $policy_3,  
					'policy_4'         => $policy_4,  
					'policy_5'         => $policy_5
		        ];
		
        return view('mypage/booklist', $data);
    }

public function reservationList() {
    $db = \Config\Database::connect();
    $private_key = private_key();

    // 요청 파라미터
    $procType     = $this->request->getGet("procType");
    $dateType     = $this->request->getGet("dateType");
    $checkInDate  = $this->request->getGet("checkInDatex");
    $checkOutDate = $this->request->getGet("checkOutDatex");
    $productType  = $this->request->getGet("productType");
    $productName  = $this->request->getGet("productName");
    $searchType   = $this->request->getGet("searchType");
    $search_word  = trim($this->request->getGet('search_word'));

    $pg = (int) ($this->request->getGet('pg') ?? 1);
    $perPage = 10;
    $offset = ($pg - 1) * $perPage;

    // 공통 조건 함수
    $applyConditions = function ($builder) use (
        $procType, $dateType, $checkInDate, $checkOutDate,
        $productType, $productName, $searchType, $search_word, $private_key
    ) {
        $builder->where('m_idx', $_SESSION['member']['mIdx']);
        $builder->whereNotIn('order_status', ['B', 'D']);

        if ($dateType == "1" && $checkInDate && $checkOutDate) {
            $builder->where("DATE(order_day) BETWEEN '$checkInDate' AND '$checkOutDate'");
        } elseif ($dateType == "2" && $checkInDate && $checkOutDate) {
            $builder->where("DATE(order_date) BETWEEN '$checkInDate' AND '$checkOutDate'");
        }

        if ($productType) $builder->where('product_type', $productType);
        if ($productName) $builder->like('product_name', $productName);

        if (!empty($search_word)) {
            switch ($searchType) {
                case "1": $builder->like('product_name', $search_word); break;
                case "2": $builder->where("CONVERT(AES_DECRYPT(UNHEX(order_user_name), '$private_key') USING utf8) LIKE '%$search_word%'"); break;
                case "3": $builder->where('order_no', $search_word); break;
                case "4": $builder->where('group_no', $search_word); break;
            }
        }

        switch ($procType) {
            case '1': $builder->whereIn('order_status', ['W', 'X']); break;
            case '2': $builder->where('order_status', 'Y'); break;
            case '3': $builder->where('order_status', 'Z'); break;
            case '4': $builder->where('order_status', 'E'); break;
            case '5': $builder->whereIn('order_status', ['C', 'N']); break;
        }
    };

    // 1. 전체 group_no 목록을 조건별로 가져옴
    $groupNoBuilder = $db->table('tbl_order_mst')->select('group_no')->distinct();
    $applyConditions($groupNoBuilder);
    $groupNoBuilder->orderBy('group_no', 'DESC');
    $allGroupNos = $groupNoBuilder->get()->getResultArray();

    $totalGroups = count($allGroupNos);
    $nPage = ceil($totalGroups / $perPage);
    $currentGroupNos = array_slice(array_column($allGroupNos, 'group_no'), $offset, $perPage);

    if (empty($currentGroupNos)) {
        $groupedOrders = [];
        $groupTotals   = [];
    } else {
        // 2. 선택된 group_no 들에 대한 예약 목록
        $orderBuilder = $db->table('tbl_order_mst')->select("
            tbl_order_mst.*, 
            AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
            AES_DECRYPT(UNHEX(order_user_first_name_en),  '$private_key') AS order_user_first_name_en, 
            AES_DECRYPT(UNHEX(order_user_last_name_en),   '$private_key') AS order_user_last_name_en, 
            AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
            AES_DECRYPT(UNHEX(order_user_phone),  '$private_key') AS order_user_phone,
            AES_DECRYPT(UNHEX(order_user_email),  '$private_key') AS order_user_email
        ");
        $orderBuilder->whereIn('group_no', $currentGroupNos);
        $applyConditions($orderBuilder);
        $orderBuilder->orderBy('group_no', 'DESC')->orderBy('order_no', 'ASC');
        $orders = $orderBuilder->get()->getResult();

        // 3. group_no 별로 정리
        $groupedOrders = [];
        foreach ($orders as $order) {
            $groupedOrders[$order->group_no][] = $order;
        }

        // 4. group_total 정보
        $totalBuilder = $db->table('tbl_order_mst')
            ->select('group_no, COUNT(*) as group_count, SUM(real_price_won) as group_total')
            ->whereIn('group_no', $currentGroupNos);
        $applyConditions($totalBuilder);
        $totalBuilder->orderBy('group_no', 'DESC');
        $totalBuilder->groupBy('group_no');
        $groupTotals = [];
        foreach ($totalBuilder->get()->getResult() as $total) {
            $groupTotals[$total->group_no] = $total;
        }
    }

    // ===== view 전달 =====
    return view('mypage/reservation_list', [
        'pg'            => $pg,
        'nTotalCount'   => $totalGroups,
        'nPage'         => $nPage,
        'g_list_rows'   => $perPage,
        'groupedOrders' => $groupedOrders,
        'groupTotals'   => $groupTotals,
        'procType'      => $procType,
        'policy_1'      => $this->policyModel->getByIdx("33"),
        'policy_2'      => $this->policyModel->getByIdx("34"),
        'policy_3'      => $this->policyModel->getByIdx("35"),
        'policy_4'      => $this->policyModel->getByIdx("36"),
        'policy_5'      => $this->policyModel->getByIdx("37"),
        'policy_6'      => $this->policyModel->getByIdx("39"),
    ]);
}


	
    public function getPolicyContents($product_idx)
        {
            $policy = $this->policyCancel->where('product_code', $product_idx)->first();

            if ($policy) {
                return $this->response->setJSON([
                    'success' => true,
                    'policy_contents' => viewSQ($policy['policy_contents']),
                    'policy_contents_m' => viewSQ($policy['policy_contents_m']),
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => ''
                ]);
            }
        }

    public function details()
    {
        $clientIP = $this->request->getIPAddress();
        $is_allow_payment = $clientIP == "220.86.61.165" || $clientIP == "113.160.96.156" || $clientIP == "58.150.52.107" || $clientIP == "14.137.74.11";
        $pg = $this->request->getGet("pg");
        $search_word = trim($this->request->getGet('search_word'));
        $s_status = $this->request->getGet('s_status');
        $g_list_rows = 10;
        if ($pg == "") {
            $pg = 1;
        }

        $where = ['m_idx' => $_SESSION["member"]["mIdx"]];

        if ($s_status) {
            $where['order_status'] = $s_status;
        }

        $result = $this->ordersModel->getOrders($search_word, 'product_name', $pg, $g_list_rows, $where);
        $nTotalCount = $result['nTotalCount'];
        $nPage = $result['nPage'];
        $num = $result['num'];

        $data = [
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'pg' => $pg,
            'num' => $num,
            'order_list' => $result['order_list'],
            'is_allow_payment' => "Y",
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
        $page = $this->request->getVar('page');

        $contact = $this->travel_contact->getContactAndCode(session()->get("member")["idx"], $page, 10);

        return view('mypage/contact', [
            "fresult" => $contact["travel_contact"],
            "nTotalCount" => $contact["nTotalCount"],
            "page" => $page,
            "nPage" => $contact["nPage"],
            "g_list_rows" => $contact["g_list_rows"]
        ]);
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

    public function alarm()
    {
        return view('mypage/alarm');
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

        $page = $this->request->getVar('page');
        $s_txt = $this->request->getVar('s_txt');
        $search_category = $this->request->getVar('scategory');

        $category = $_GET['category'];

        $resultObj = $this->ReviewModel->getMyReviews($s_txt, $search_category, $category, $page, 10);

        $resultObj['review_list'] = array_map(function ($item) {
            $code = $this->code->getByCodeNo($item['travel_type']);
            $item['travel_type_name'] = $code['code_name'];
            $code = $this->code->getByCodeNo($item['travel_type_2']);
            $item['travel_type_name2'] = $code['code_name'];
            $code = $this->code->getByCodeNo($item['travel_type_3']);
            $item['travel_type_name3'] = $code['code_name'];

            return $item;
        }, $resultObj['review_list']);

        $data = [
            'total_cnt' => $resultObj['total_cnt'],
            'total_page' => $resultObj['total_page'],
            'page' => $resultObj['page'],
            'no' => $resultObj['no'],
            'review_list' => $resultObj['review_list'],
        ];

        return view('mypage/travel_review', $data);
    }

    public function point()
    {
        $pg = $this->request->getVar("pg") ?? 1;
        $s_date = $this->request->getVar("s_date") ?? "";
        $e_date = $this->request->getVar("e_date") ?? "";

        $c_nTotalCount = count($this->coupon->getCountCouponMember());
        $mileage = $this->member->getByIdx(session()->get("member")["idx"])["mileage"];

        $point = $this->orderMileage->getPoint($s_date, $e_date, $pg, 100);

        return view('mypage/point',
            [
                "c_nTotalCount" => $c_nTotalCount,
                "mileage" => $mileage,
                "point_list" => $point["point_list"],
                "nTotalCount" => $point["nTotalCount"],
                "pg" => $pg,
                "nPage" => $point["nPage"],
                "g_list_rows" => $point["g_list_rows"],
                "num" => $point["num"],
                "s_date" => $s_date,
                "e_date" => $e_date
            ]);
    }

    public function coupon()
    {
        $pg = $this->request->getVar("pg") ?? 1;
        $s_date = $this->request->getVar("s_date") ?? "";
        $e_date = $this->request->getVar("e_date") ?? "";

        $c_nTotalCount = count($this->coupon->getCountCouponMember());
        $mileage = $this->member->getByIdx(session()->get("member")["idx"])["mileage"];

        $coupon = $this->coupon->getUseCouponMember($s_date, $e_date, $pg, 100);

        return view('mypage/coupon', [
            "c_nTotalCount" => $c_nTotalCount,
            "mileage" => $mileage,
            "coupon_list" => $coupon["coupon_list"],
            "nTotalCount" => $coupon["nTotalCount"],
            "pg" => $pg,
            "nPage" => $coupon["nPage"],
            "g_list_rows" => $coupon["g_list_rows"],
            "num" => $coupon["num"],
            "s_date" => $s_date,
            "e_date" => $e_date
        ]);
    }

    public function discount()
    {
        return view('mypage/discount');
    }

    public function couponChk($keyword) {
        $fsql = "select * from tbl_coupon where keyword = '" . $keyword . "' and user_id = '' ";
        return $this->db->query($fsql)->getNumRows();
    }

    public function get_coupon_discount() {
        try {
            $keyword = updateSQ($this->request->getPost('keyword'));
            $user_id = session()->get("member")["id"];
            if( $this->couponChk($keyword) < 1 ){
        
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "해당 쿠폰 정보가 없습니다."
                ], 400);
        
            }else{
                // 쿠폰 내역 조회
                $fresult = $this->db->table('tbl_coupon')
                         ->where('keyword', $keyword)
                         ->where('user_id = ', '')
                         ->get();
                $frow    = $fresult->getResultArray();
        
                $coupon_num = $frow[0]['coupon_num'];

                if( $frow[0]['status'] != "D" ){
                    $message = "이미 발급되었거나 사용된 쿠폰입니다";
        
                    return $this->response->setJSON([
                        'result' => false,
                        'message' => $message
                    ], 400);
                }
        
                if( $frow[0]['user_id'] != "" ){
                    $message = "이미 발급된 쿠폰입니다";

                    return $this->response->setJSON([
                        'result' => false,
                        'message' => $message
                    ], 400);
                }
        
                if( $frow[0]['enddate'] <= date('Y-m-d') ){
                    $message = "사용기한이 지난 쿠폰입니다";

                    return $this->response->setJSON([
                        'result' => false,
                        'message' => $message
                    ], 400);
                }
        
        
                $fsql = " update tbl_coupon set
                                    user_id	= '".$user_id."'
                                    ,status	= 'N'
                                    where coupon_num = '".$coupon_num."'
                        ";
        
                $message = "쿠폰이 발행되었습니다.";
        
                $fresult    = $this->db->query($fsql);

                return $this->response->setJSON([
                    'result' => true,
                    'message' => $message
                ], 200);
        
            }

        }catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
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
        $mcodes = $this->code->getByParentCode('56')->getResultArray();
        $member = $this->member->getByIdx($_SESSION["member"]["mIdx"]);
        if ($member["user_id"] == "" || $_SESSION["member"]["mIdx"] == "") {
            return alert_msg("", "/");
        }
        return view('mypage/info_change', ["member" => $member, "mcodes" => $mcodes]);
    }

    public function user_mange()
    {
        $m_idx = session()->get("member")["idx"];
        $row_bank = $this->memberBank->where("m_idx", $m_idx)->first();
        $bank_list = $this->code->getCodesByGubunDepthAndStatus("bank", 2);
        return view('mypage/user_mange', [
            "row_bank" => $row_bank,
            "bank_list" => $bank_list
        ]);
    }

    public function user_mange_ok()
    {
        $data = $this->request->getPost();
        $mb_idx = $this->request->getPost("mb_idx");
        $data["ip_address"] = $this->request->getIPAddress();
        $data["m_idx"] = session()->get("member")["idx"];

        if (!empty($mb_idx)) {
            $data["m_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
            $result = $this->memberBank->updateData($mb_idx, $data);

            if ($result) {
                $message = "수정되었습니다.";
                return "<script>
                            alert('$message');
                            location.href='/mypage/user_mange';
                        </script>";
            }
        } else {
            $data["r_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

            $isertId = $this->memberBank->insertData($data);
            if ($isertId) {
                $message = "등록되었습니다.";
                return "<script>
                            alert('$message');
                            location.href='/mypage/user_mange';
                        </script>";
            }
        }
    }

    public function money()
    {
        return view('mypage/money');
    }

    public function money_ok()
    {
        try {
            $msg = '';
            $private_key = private_key();

            $m_idx = updateSQ($_SESSION["member"]["mIdx"]);
            $user_pw = updateSQ($_POST["user_pw"]);
            $user_mobile = updateSQ($_POST["mobile1"]) . "-" . updateSQ($_POST["mobile2"]) . "-" . updateSQ($_POST["mobile3"]);
            $out_etc = updateSQ($_POST["out_etc"]);
            $out_reason = updateSQ($_POST["out_reason"]);

            $total_sql = " select *, AES_DECRYPT(UNHEX(user_name), '$private_key') AS user_name,
                                    AES_DECRYPT(UNHEX(user_mobile), '$private_key') user_mobile, 
                                    AES_DECRYPT(UNHEX(user_email), '$private_key') user_email,
             from tbl_member where m_idx = '" . $m_idx . "' ";
            $result = $this->db->query($total_sql);
            $row = $result->getRowArray();
            $user_name = $row["user_name"];
            $user_phone = $row['user_mobile'];
            $user_email = $row['user_email'];
            $user_id = $row['user_id'];

            if ($_SESSION["member"]["mIdx"] == "") {
                $msg = "";
                return $this->response->setStatusCode(200)
                    ->setJSON([
                        'status' => 'success',
                        'message' => $msg
                    ]);
            }

            if ($row["user_id"] == "") {
                $msg = "NOUSER";
                return $this->response->setStatusCode(200)
                    ->setJSON([
                        'status' => 'success',
                        'message' => $msg
                    ]);
            }

            if (!password_verify($user_pw, $row["user_pw"])) {
                $msg = "NOPASS";
                return $this->response->setStatusCode(200)
                    ->setJSON([
                        'status' => 'success',
                        'message' => $msg
                    ]);
            }

            $sql = " update tbl_member set 
				out_etc				= '" . $out_etc . "' 
				,out_reason			= '" . $out_reason . "' 
				,out_date			= now()
				,m_date				= now()
				,status				= 'O'
				where m_idx = '" . $_SESSION["member"]["mIdx"] . "'
			";
            //write_log("탈퇴신청:" . $sql);
            $result = $this->db->query($sql);
            $_SESSION["member"]["userId"] = "";
            $_SESSION["member"]["mIdx"] = "";
            $_SESSION["member"]["userLevel"] = "";
            $_SESSION["member"]["userName"] = "";
            setcookie("c_mIdx", "", time() - 86000 * 365, '/');

            $code     = "S05";
            $to_phone = $user_phone;
            $_tmp_fir_array = [
                'MEMBER_NAME' => $user_name
            ];
            autoSms($code, $to_phone, $_tmp_fir_array);

            $code = "A02";
            $_tmp_fir_array = [
                'member_id'   => $user_id,
            ];
            autoEmail($code, $user_email, $_tmp_fir_array);

            $msg = "OK";

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

    public function member_out()
    {
        return view('mypage/member_out');
    }

    public function invoice_view_item($gubun)
    {

        $data = $this->request->getVar();
        $order_idx = $data["order_idx"];

        $info = $this->ordersModel->getOrderInfo($order_idx);

        $data = array_merge($data, $info);

        $data['listSub'] = $this->orderSubModel->getOrderSub($order_idx);

        $connect = db_connect();
        $private_key = private_key();

        if ($_SESSION["member"]["mIdx"] == "") {
            alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
            exit();
        }

        $order_idx = updateSQ($_GET["order_idx"]);
        $pg = updateSQ($_GET["pg"]);

        $sql = "select * from  tbl_order_mst a
	                           left join tbl_member b on a.m_idx = b.m_idx 
							   where a.order_idx = '$order_idx' and a.m_idx = '" . $_SESSION["member"]["mIdx"] . "' ";

        $row = $connect->query($sql)->getRowArray();

        $sql_d = "SELECT AES_DECRYPT(UNHEX('{$row['local_phone']}'),       '$private_key') local_phone ";

        $row_d = $connect->query($sql_d)->getRowArray();

        $row['local_phone'] = $row_d['local_phone'];

        $tour_period = $row["tour_period"];
        $order_memo = $row['order_memo'];
        $custom_req = $row['custom_req'];

        $home_depart_date = $row['home_depart_date'];
        $away_arrive_date = $row['away_arrive_date'];
        $away_depart_date = $row['away_depart_date'];
        $home_arrive_date = $row['home_arrive_date'];

        $start_date = $row['start_date'];

        $order_user_name         = $row['order_user_name'];
        $order_user_email        = $row['order_user_email'];
        $order_user_first_name   = $row['order_user_first_name_en'];
        $order_user_last_name    = $row['order_user_last_name_en'];
        $order_user_mobile       = $row['order_user_mobile'];
        $order_user_phone        = $row['order_user_phone'];
        $local_phone             = $row['local_phone'];
        $order_zip               = $row['order_zip'];
        $order_addr1             = $row['order_addr1'];
        $order_addr2             = $row['order_addr2'];
        $order_birth_date        = $row['order_birth_date'];

        $sql_d = "
            SELECT  
                AES_DECRYPT(UNHEX('$order_user_name'), '$private_key') AS order_user_name,
                AES_DECRYPT(UNHEX('$order_user_email'), '$private_key') AS order_user_email,
                AES_DECRYPT(UNHEX('$order_user_first_name'), '$private_key') AS order_user_first_name_en,
                AES_DECRYPT(UNHEX('$order_user_last_name'), '$private_key') AS order_user_last_name_en,
                AES_DECRYPT(UNHEX('$order_user_mobile'), '$private_key') AS order_user_mobile,
                AES_DECRYPT(UNHEX('$order_user_phone'), '$private_key') AS order_user_phone,
                AES_DECRYPT(UNHEX('$local_phone'), '$private_key') AS local_phone,
                AES_DECRYPT(UNHEX('$order_zip'), '$private_key') AS order_zip,
                AES_DECRYPT(UNHEX('$order_addr1'), '$private_key') AS order_addr1,
                AES_DECRYPT(UNHEX('$order_addr2'), '$private_key') AS order_addr2,
                '$order_birth_date' AS order_birth_date
        ";
        $row_d = $connect->query($sql_d)->getRowArray();

        $data['row'] = $row;

        $data['tour_period'] = $tour_period;
        $data['order_memo'] = $order_memo;
        $data['custom_req'] = $custom_req;
        $data['home_depart_date'] = $home_depart_date;
        $data['away_arrive_date'] = $away_arrive_date;
        $data['away_depart_date'] = $away_depart_date;
        $data['home_arrive_date'] = $home_arrive_date;
        $data['start_date'] = $start_date;
        $data['row_d'] = $row_d;
        $data['local_phone'] = $row['local_phone'];

        $data['pg'] = $pg;

        $data['listSub'] = $this->orderSubModel->getOrderSub($order_idx);

        $additional_request = $row['additional_request'];
        $_arr_additional_request = explode("|", $additional_request);
        $list__additional_request = rtrim(implode(',', $_arr_additional_request), ',');

        $fcodes = [];
        if ($row['additional_request']) {
            $sql = "select * from tbl_code WHERE parent_code_no='53' AND status = 'Y' and code_no IN ($list__additional_request) order by onum asc, code_idx desc";
//        $sql = "select * from tbl_code WHERE parent_code_no='53' AND status = 'Y'  order by onum asc, code_idx desc";
            //write_log($sql);
            $fcodes = $this->db->query($sql)->getResultArray();
        }

        $data['fcodes'] = $fcodes;

        if (!empty($gubun)) {

            if ($gubun == "hotel") {
                $sql_ = "SELECT * FROM tbl_hotel_rooms WHERE rooms_idx = " . $row["room_op_idx"];
                $room_ = $this->db->query($sql_)->getRowArray();
                $data['price_secret'] = $room_["secret_price"];

            }

            if ($gubun == "golf") {
                //$option_idx = $this->orderOptionModel->getOption($order_idx, "main")[0]["option_idx"];
                //$data['option'] = $this->golfOptionModel->getByIdx($option_idx);

                $sql_golf = " select * from tbl_order_option where order_idx = '" . $order_idx . "' and option_type = 'main' ";
                $data['option'] = $this->db->query($sql_golf)->getRowArray();

                $sql_golf = " select * from tbl_order_option where order_idx = '" . $order_idx . "' and option_type in('main', 'vehicle', 'option') order by  option_type asc ";
                $data['vehicle'] = $this->db->query($sql_golf)->getResultArray();

            }

            if ($gubun == "spa" || $gubun == "ticket" || $gubun == "restaurant") {
                $data['option_order'] = $this->orderOptionModel->getOption($order_idx, "spa");
            }

            if ($gubun == "tour") {

                $sql_tour = " select * from tbl_order_option where order_idx = '" . $order_idx . "' and option_type in('tour') order by opt_idx asc ";
                //write_log($sql_tour);
                $data['tour_option'] = $this->db->query($sql_tour)->getResultArray();
                $data['tour_orders'] = $this->orderTours->findByOrderIdx($order_idx)[0];
                $optionsIdx = $data['tour_orders']['options_idx'];

                $options_idx = explode(',', $optionsIdx);

                $data['tour_option'] = [];
                $data['total_price'] = 0;
                foreach ($options_idx as $idx) {
                    $optionDetail = $this->optionTours->find($idx);
                    if ($optionDetail) {
                        $data['tour_option'][] = $optionDetail;
                        $data['total_price'] += $optionDetail['option_price_bath'];
                    }
                }
                $sql_cou = " select * from tbl_coupon_history where order_idx='" . $order_idx . "'";
                $result_cou = $connect->query($sql_cou);
                $row_cou = $result_cou->getRowArray();
                $data['row_cou'] = $row_cou;
            }

            if ($gubun == 'vehicle') {
                $departure_area = $row["departure_area"] ?? 0;
                $destination_area = $row["destination_area"] ?? 0;
                $cp_idx = $row["cp_idx"] ?? 0;
                $ca_depth_idx = $row["ca_depth_idx"] ?? 0;
                $ca_last_idx = $this->carsPrice->find($cp_idx)["ca_idx"] ?? "0";
                $order_idx = $row["order_idx"] ?? 0;

                $data['departure_name'] = $this->carsCategory->getById($departure_area)["code_name"];
                $data['destination_name'] = $this->carsCategory->getById($destination_area)["code_name"];
                $data['code_no_first'] = $this->carsCategory->getById($ca_depth_idx)["code_no"];
                $data['category_arr'] = $this->carsCategory->getCategoryTree($ca_last_idx);
                $data['order_cars_detail'] = $this->ordersCars->getByOrder($order_idx);
            }

            if ($gubun == 'guide') {
                $order_idx = $row["order_idx"] ?? 0;
                $o_idx = $row["yoil_idx"] ?? 0;
                $order_subs = $this->orderGuide->getListByOrderIdx($order_idx);
                $data['order_subs'] = $order_subs;

                $option = $this->guideOptionModel->getById($o_idx);
                $sup_options = $this->guideSupOptionModel->getListByOptionId($o_idx);

                $data['option'] = $option;
                $data['sup_options'] = $sup_options;
            }

            return view("mypage/invoice_view_item_{$gubun}", $data);
        }

        return view('mypage/invoice_view_item');

    }

    public function order_view_item($gubun)
    {

        $data = $this->request->getVar();
        $order_idx = $data["order_idx"];

        $info = $this->ordersModel->getOrderInfo($order_idx);

        $data = array_merge($data, $info);

        $data['listSub'] = $this->orderSubModel->getOrderSub($order_idx);

        $connect = db_connect();
        $private_key = private_key();

        if ($_SESSION["member"]["mIdx"] == "") {
            alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
            exit();
        }

        $order_idx = updateSQ($_GET["order_idx"]);
        $pg = updateSQ($_GET["pg"]);

        $sql = "select * from  tbl_order_mst a
	                           left join tbl_member b on a.m_idx = b.m_idx 
							   where a.order_idx = '$order_idx' and a.m_idx = '" . $_SESSION["member"]["mIdx"] . "' ";

        $row = $connect->query($sql)->getRowArray();
        //write_log("order_view_item- ". $order_idx."-".$row['order_gubun']);
        $sql_d = "SELECT AES_DECRYPT(UNHEX('{$row['local_phone']}'),       '$private_key') local_phone ";
        
        $row_d = $connect->query($sql_d)->getRowArray();

        $row['local_phone'] = $row_d['local_phone'];

        $tour_period = $row["tour_period"];
        $order_memo  = $row['order_memo'];

        $home_depart_date = $row['home_depart_date'];
        $away_arrive_date = $row['away_arrive_date'];
        $away_depart_date = $row['away_depart_date'];
        $home_arrive_date = $row['home_arrive_date'];

        $start_date = $row['start_date'];

        $sql_d = "SELECT  AES_DECRYPT(UNHEX('{$row['order_user_name']}'),    '$private_key') AS order_user_name 
                        , AES_DECRYPT(UNHEX('{$row['order_user_email']}'),   '$private_key') AS order_user_email 
                        , AES_DECRYPT(UNHEX('{$row['order_user_first_name_en']}'),   '$private_key') AS order_user_first_name_en 
                        , AES_DECRYPT(UNHEX('{$row['order_user_last_name_en']}'),   '$private_key') AS order_user_last_name_en 
						, AES_DECRYPT(UNHEX('{$row['order_passport_number']}'),    '$private_key') AS order_passport_number 
                        , AES_DECRYPT(UNHEX('{$row['order_user_mobile']}'),  '$private_key') AS order_user_mobile 
                        , AES_DECRYPT(UNHEX('{$row['order_user_phone']}'),   '$private_key') AS order_user_phone 
                        , AES_DECRYPT(UNHEX('{$row['local_phone']}'),  		 '$private_key') AS local_phone 
                        , AES_DECRYPT(UNHEX('{$row['order_zip']}'),          '$private_key') AS order_zip 
                        , AES_DECRYPT(UNHEX('{$row['order_addr1']}'),        '$private_key') AS order_addr1 
                        , AES_DECRYPT(UNHEX('{$row['order_addr2']}'),        '$private_key') AS order_addr2 ";
        $row_d = $connect->query($sql_d)->getRowArray();

        $data['row'] = array_merge($row, $row_d);

        $data['tour_period']      = $tour_period;
        $data['order_memo']       = $order_memo;
        $data['home_depart_date'] = $home_depart_date;
        $data['away_arrive_date'] = $away_arrive_date;
        $data['away_depart_date'] = $away_depart_date;
        $data['home_arrive_date'] = $home_arrive_date;
        $data['start_date']       = $start_date;
        $data['row_d']            = $row_d;
        $data['local_phone']      = $row['local_phone'];

        $data['pg'] = $pg;

        $data['listSub'] = $this->orderSubModel->getOrderSub($order_idx);

        $additional_request = $row['additional_request'];
        $_arr_additional_request = explode("|", $additional_request);
        $list__additional_request = rtrim(implode(',', $_arr_additional_request), ',');

        $fcodes = [];
        if ($row['additional_request']) {
            $sql = "select * from tbl_code WHERE parent_code_no='53' AND status = 'Y' and code_no IN ($list__additional_request) order by onum asc, code_idx desc";
//        $sql = "select * from tbl_code WHERE parent_code_no='53' AND status = 'Y'  order by onum asc, code_idx desc";
            //write_log($sql);
            $fcodes = $this->db->query($sql)->getResultArray();
        }

        $data['fcodes'] = $fcodes;
        $gubun          = $row['order_gubun'];
		
        if (!empty($gubun)) {

            if ($gubun == "hotel") {
                $sql_  = "SELECT * FROM tbl_hotel_rooms WHERE rooms_idx = " . $row["room_op_idx"];
                $room_ = $this->db->query($sql_)->getRowArray();
                $data['price_secret'] = $room_["secret_price"];

            }

            if ($gubun == "golf") {
                //$option_idx = $this->orderOptionModel->getOption($order_idx, "main")[0]["option_idx"];
                //$data['option'] = $this->golfOptionModel->getByIdx($option_idx);

                $sql_golf = " select * from tbl_order_option where order_idx = '" . $order_idx . "' and option_type = 'main' ";
                $data['option'] = $this->db->query($sql_golf)->getRowArray();

                $sql_golf = " select * from tbl_order_option where order_idx = '" . $order_idx . "' and option_type in('main', 'vehicle', 'option') order by  option_type asc ";
                $data['vehicle'] = $this->db->query($sql_golf)->getResultArray();

            }

            if ($gubun == "spa" || $gubun == "ticket" || $gubun == "restaurant") {
                $data['option_order'] = $this->orderOptionModel->getOption($order_idx, "spa");
            }

            if ($gubun == "tour") {

                $sql_tour = " select * from tbl_order_option where order_idx = '" . $order_idx . "' and option_type in('tour') order by opt_idx asc ";
                //write_log("sql_tour- ". $sql_tour);
                $data['tour_option'] = $this->db->query($sql_tour)->getResultArray();
                $data['tour_orders'] = $this->orderTours->findByOrderIdx($order_idx)[0];
                $optionsIdx = $data['tour_orders']['options_idx'];

                $options_idx = explode(',', $optionsIdx);
/*
                $data['tour_option'] = [];
                $data['total_price'] = 0;
                foreach ($options_idx as $idx) {
                    $optionDetail = $this->optionTours->find($idx);
                    if ($optionDetail) {
                        $data['tour_option'][] = $optionDetail;
                        $data['total_price'] += $optionDetail['option_price_bath'];
                    }
                }
*/				
                $sql_cou = " select * from tbl_coupon_history where order_idx='" . $order_idx . "'";
                $result_cou = $connect->query($sql_cou);
                $row_cou = $result_cou->getRowArray();
                $data['row_cou'] = $row_cou;
            }

            if ($gubun == 'vehicle') {
                $departure_area = $row["departure_area"] ?? 0;
                $destination_area = $row["destination_area"] ?? 0;
                $cp_idx = $row["cp_idx"] ?? 0;
                $ca_depth_idx = $row["ca_depth_idx"] ?? 0;
                $ca_last_idx = $this->carsPrice->find($cp_idx)["ca_idx"] ?? "0";
                $order_idx = $row["order_idx"] ?? 0;

                $data['departure_name'] = $this->carsCategory->getById($departure_area)["code_name"];
                $data['destination_name'] = $this->carsCategory->getById($destination_area)["code_name"];
                $data['code_no_first'] = $this->carsCategory->getById($ca_depth_idx)["code_no"];
                $data['category_arr'] = $this->carsCategory->getCategoryTree($ca_last_idx);
                $data['order_cars_detail'] = $this->ordersCars->getByOrder($order_idx);
            }

            if ($gubun == 'guide') {
                $order_idx = $row["order_idx"] ?? 0;
                $o_idx = $row["yoil_idx"] ?? 0;
                $order_subs = $this->orderGuide->getListByOrderIdx($order_idx);
                $data['order_subs'] = $order_subs;

                $option = $this->guideOptionModel->getById($o_idx);
                $sup_options = $this->guideSupOptionModel->getListByOptionId($o_idx);

                $data['option'] = $option;
                $data['sup_options'] = $sup_options;
            }

            return view("mypage/order_view_item_{$gubun}", $data);
        }

        return view('mypage/order_view_item');

    }


    public function info_option_ok()
    {
        $user_id = updateSQ($_POST["user_id"]);
        $user_pw = updateSQ($_POST["user_pw"]);

        $total_sql = " select * from tbl_member where user_id = '" . $user_id . "' ";
        $row = $this->db->query($total_sql)->getRowArray();

        if ($_SESSION["member"]["mIdx"] == "") {
            return "";
        }
        if ($row["user_id"] == "") {
            return "NOUSER";
        } else if (!password_verify($user_pw, $row["user_pw"])) {
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
        $user_email = updateSQ($_POST["user_email"]);
        $user_email_yn = updateSQ($_POST["user_email_yn"]);
        $sms_yn = updateSQ($_POST["sms_yn"]);
        $user_phone = updateSQ($_POST["phone1"]) . "-" . updateSQ($_POST["phone2"]) . "-" . updateSQ($_POST["phone3"]);
        $user_mobile = updateSQ($_POST["mobile1"]) . "-" . updateSQ($_POST["mobile2"]) . "-" . updateSQ($_POST["mobile3"]);
        $zip = updateSQ($_POST["zip"] ?? "");
        $addr1 = updateSQ($_POST["addr1"] ?? "");
        $addr2 = updateSQ($_POST["addr2"] ?? "");
        $job = updateSQ($_POST["job"]);
        $birthday = updateSQ($_POST["birthday"]);
        $marriage = updateSQ($_POST["marriage"]);
        $user_level = updateSQ($_POST["user_level"]);
        
        $mbti   = updateSQ($_POST["mbti"] ?? "");
        $user_first_name_en   = updateSQ($_POST["user_first_name_en"] ?? "");
        $user_last_name_en   = updateSQ($_POST["user_last_name_en"] ?? "");
        $passport_number   = updateSQ($_POST["passport_number"] ?? "");
        $passport_expiry_date   = updateSQ($_POST["passport_expiry_date"] ?? "");
        $recommender   = updateSQ($_POST["recommender"] ?? "");

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
                    user_pw			= '" . password_hash($user_pw, PASSWORD_BCRYPT) . "'
                    where m_idx  = '" . $_SESSION["member"]["mIdx"] . "'
                ";
            $this->db->query($sql);
        }
        $sql = " update tbl_member set 
                    birthday	   = '" . $birthday . "' 
                    ,zip		   = HEX(AES_ENCRYPT('" . $zip . "' , '" . $private_key . "')) 
                    ,addr1		   = HEX(AES_ENCRYPT('" . $addr1 . "' , '" . $private_key . "'))
                    ,addr2		   = HEX(AES_ENCRYPT('" . $addr2 . "' , '" . $private_key . "'))
                    ,user_mobile   = HEX(AES_ENCRYPT('" . $user_mobile . "' , '" . $private_key . "'))
                    ,user_name     = HEX(AES_ENCRYPT('" . $user_name . "' , '" . $private_key . "'))
                    ,user_email     = HEX(AES_ENCRYPT('" . $user_email . "' , '" . $private_key . "'))
                    ,user_first_name_en        = HEX(AES_ENCRYPT('" . $user_first_name_en . "' , '" . $private_key . "'))
                    ,user_last_name_en        = HEX(AES_ENCRYPT('" . $user_last_name_en . "' , '" . $private_key . "'))
                    ,passport_number        = HEX(AES_ENCRYPT('" . $passport_number . "' , '" . $private_key . "'))
                    ,passport_expiry_date        = '" . $passport_expiry_date . "'
                    ,mbti        = '" . $mbti . "'
                    ,gender        = '" . $gender . "'
                    ,recommender        = '" . $recommender . "'
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

        $data['id']    = $member['user_id'];
        $data['idx']   = $member['m_idx'];
        $data["mIdx"]  = $member['m_idx'];
        $data['name']  = $member['user_name'];
        $data['email'] = $member['user_email'];
        $data['level'] = $member['user_level'];
        $data['phone'] = $member['user_mobile'];

        session()->set("member", $data);
        echo "정보수정되었습니다.";
    }
	
}