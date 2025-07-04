<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;
use Config\Services;

class SpaController extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $productPrice;
    protected $productCharge;
    protected $codeModel;
    protected $orderModel;
    protected $orderOptionModel;
    protected $orderSubModel;
    private $coupon;
    private $couponHistory;
    protected $spasMoption;
    protected $spasOption;
    private $spasPrice;

     private $db;


    public function __construct()
    {
        $this->db = db_connect();
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
        $this->productPrice = model("ProductPrice");
        $this->productCharge = model("ProductCharge");
        $this->codeModel = model("Code");
        $this->orderModel = model("OrdersModel");
        $this->orderOptionModel = model("OrderOptionModel");
        $this->orderSubModel = model("OrderSubModel");
        $this->coupon = model("Coupon");
        $this->couponHistory = model("CouponHistory");
        $this->spasMoption = model("SpasMoptionModel");
        $this->spasOption = model("SpasOptionModel");
        $this->spasPrice = model("SpasPrice");

    }

    public function charge_list()
    {
        $product_idx = $_GET['product_idx'];
        $day_ = $_GET['day_'];
        $yoil = $_GET['yoil'];
        try {
            $results = $this->productPrice->selectYoilByProductIdx($yoil, $day_, $product_idx);

            if ($results && count($results) > 0) {
                $results = array_map(function ($it) use ($product_idx) {
                    $result = (array)$it;
                    $yoil_idx = $result['p_idx'];

                    $fresult2 = $this->productCharge->selectByProductAndYoil($product_idx, $yoil_idx);

                    $fresult2 = array_map(function ($item) {
                        $rs = (array)$item;

                        $tour_price = $rs['tour_price'];
                        $tour_price_baht = convertToWon($tour_price);
                        $rs['tour_price_baht'] = $tour_price_baht;

                        $tour_price_kids = $rs['tour_price_kids'];
                        $tour_price_kids_baht = convertToWon($tour_price_kids);
                        $rs['tour_price_kids_baht'] = $tour_price_kids_baht;

                        $tour_price_senior = $rs['tour_price_senior'];
                        $tour_price_senior_baht = convertToWon($tour_price_senior);
                        $rs['tour_price_senior_baht'] = $tour_price_senior_baht;

                        return $rs;
                    }, $fresult2);

                    $t = true;
                    for ($i = 0; $i < 7; $i++) {
                        if ($result['yoil_' . $t] !== 'Y') {
                            $t = false;
                            break;
                        }
                    }

                    $result['full_'] = $t;
                    $result['data'] = $fresult2;

                    return $result;
                }, $results);

                return $this->response->setStatusCode(200)
                    ->setJSON([
                        'status' => 'success',
                        'day' => $day_,
                        'data' => $results
                    ]);
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'data' => []
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

    public function handleBooking()
    {
        try {
            $session   = Services::session();
            $memberIdx = $session->get('member')['idx'] ?? null;

 			$private_key = private_key();

            if (!$memberIdx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "로그인해주세요!"
                ], 400);
            }

            // $dataCart = $session->get('data_cart');
            // if (empty($dataCart)) {
            //     return redirect()->to('/');
            // }

            $postData         = $this->request->getPost();

            $productIdx       = $postData['product_idx'] ?? null;
            $orderStatus      = $postData['order_status'] ?? 'W';
            $orderUserEmail   = ($postData['email_1'] ?? '') . '@' . ($postData['email_2'] ?? '');

            if (is_array($postData['adultQty'])) {
                $postData['adultQty'] = implode(',', $postData['adultQty']);
            } 

            if (is_array($postData['childrenQty'])) {
                $postData['childrenQty'] = implode(',', $postData['childrenQty']);
            } 

            if (is_array($postData['adultPrice'])) {
                $postData['adultPrice'] = implode(',', $postData['adultPrice']);
            } 

            if (is_array($postData['childrenPrice'])) {
                $postData['childrenPrice'] = implode(',', $postData['childrenPrice']);
            } 

            $adultQtySum      = array_sum(array_map('intval', explode(',', $postData['adultQty'] ?? '')));
            $childrenQtySum   = array_sum(array_map('intval', explode(',', $postData['childrenQty'] ?? '')));

            // $adultPriceSum    = array_sum(array_map('intval', explode(',', $postData['adultPrice'] ?? '')));
            // $childrenPriceSum = array_sum(array_map('intval', explode(',', $postData['childrenPrice'] ?? '')));

            $adultQtyArray = array_map('intval', explode(',', $postData['adultQty'] ?? ''));
            $childrenQtyArray = array_map('intval', explode(',', $postData['childrenQty'] ?? ''));

            $adultPriceArray = array_map('intval', explode(',', $postData['adultPrice'] ?? ''));
            $childrenPriceArray = array_map('intval', explode(',', $postData['childrenPrice'] ?? ''));

            $adultPriceSum = array_sum(array_map(fn($qty, $price) => $qty * $price, $adultQtyArray, $adultPriceArray));

            $childrenPriceSum = array_sum(array_map(fn($qty, $price) => $qty * $price, $childrenQtyArray, $childrenPriceArray));
            $baht_thai        = $this->setting['baht_thai'];
			
            $phone_1 = updateSQ($this->request->getPost('phone_1') ?? "");
            $phone_2 = updateSQ($this->request->getPost('phone_2') ?? "");
            $phone_3 = updateSQ($this->request->getPost('phone_3') ?? "");
            $payment_user_mobile = $phone_1 . "-" . $phone_2 . "-" . $phone_3;
            $p_user_mobile = encryptField($payment_user_mobile, "encode");

            $phone_thai = updateSQ($this->request->getPost('phone_thai') ?? "");
            $p_phonethai = encryptField($phone_thai, "encode");

            if(!empty($phone_thai)){
                $user_mobile = $p_phonethai;
            }else{
                $user_mobile = $p_user_mobile;
            }

            $local_phone = updateSQ($this->request->getPost('local_phone') ?? "");
            $local_phone = encryptField($local_phone, "encode");

            $time_line      = $postData['time_line'] ?? "";

            if($orderStatus == "W") {
                $group_no  = date('YmdHis'); 
			} else {
                $group_no  = ""; 
            }

            // $data['real_price_bath']   =  (int)($data['order_price'] / $data['baht_thai']);
            // $data['real_price_won']    =  $data['order_price'];

            $postData['lastPrice'] = !empty($postData['lastPrice']) ? $postData['lastPrice'] : $postData['totalPrice'];

            $real_price_bath   =  (int)($postData['lastPrice'] / $baht_thai);
            $real_price_won    =  $postData['lastPrice'];
            $order_price_won   =  $postData['lastPrice'];
			
            $order_price_bath  =  (int)($postData['lastPrice'] / $baht_thai);

			$orderData = [
                'order_user_name'               => encryptField($postData['order_user_name'] ?? "", 'encode') ?? $postData['order_user_name'],
                'order_user_email'              => encryptField($orderUserEmail, 'encode') ?? $orderUserEmail,
                'order_user_first_name_en'      => encryptField($postData['order_user_first_name_en'] ?? "", 'encode') ?? $postData['order_user_first_name_en'],
                'order_user_last_name_en'       => encryptField($postData['order_user_last_name_en'] ?? "", 'encode') ?? $postData['order_user_last_name_en'],
				
			    "order_passport_number"         => encryptField($postData['order_passport_number'] ?? "", 'encode'),
			    "order_passport_expiry_date"    => $postData['order_passport_expiry_date'] ?? "",
			    "order_birth_date"              => $postData['order_birth_date'] ?? "",
				
                'order_gender_list'             => $postData['companion_gender'] ?? "",
                'product_idx'                   => $productIdx,
                'user_id'                       => $memberIdx,
                'm_idx'                         => $memberIdx,
                'order_day'                     => $postData['day_'] ?? "",
                'order_user_mobile'             => $user_mobile,
                'order_user_phone'              => $user_mobile,
                'local_phone'                   => $local_phone ?? "",
                'people_adult_cnt'              => $adultQtySum,
                'people_kids_cnt'               => $childrenQtySum,
                'inital_price'                  => $postData['totalPrice'] ?? 0,
                'order_price'                   => $postData['lastPrice'] ?? 0,
				'order_price_bath'              => $order_price_bath,	
                'real_price_bath'               => $order_price_bath,
                'real_price_won'                => $order_price_won,
                'order_memo'                    => $postData['order_memo'] ?? '',
                'order_r_date'                  => Time::now('Asia/Seoul', 'en_US'),
                'order_date'                    => Time::now('Asia/Seoul', 'en_US'),
                'used_coupon_idx'               => $postData['c_idx'] ?? '',
                'used_coupon_no'                => $postData['coupon_no'] ?? '',
                'used_coupon_money'             => $postData['discountPrice'] ?? 0,
                'used_coupon_point'             => $postData['pointPrice'] ?? 0,
                'people_adult_price'            => $adultPriceSum,
                'people_kids_price'             => $childrenPriceSum,
                'order_no'                      => $this->orderModel->makeOrderNo(),
                'order_status'                  => $orderStatus,
                'ip'                            => $this->request->getIPAddress(),
				"device_type"                   =>  get_device(),
				"baht_thai"	                    => $baht_thai,
                'time_line'                     => $time_line,
				'group_no'                      => $group_no,	
                'order_gubun'                   => $postData['order_gubun'] ?? 'spa',
            ];

            $product = $this->productModel->find($productIdx);
            if ($product) {
                $orderData['product_name'] = $product['product_name'] ?? '';
                foreach (range(1, 4) as $i) {
                    $key             = "product_code_$i";
                    $orderData[$key] = $product[$key] ?? '';
                }
                $orderData['code_name'] = $this->codeModel->getByCodeNo($product['product_code_1'])['code_name'] ?? '';
            }

            $this->orderModel->insert($orderData);
            $orderIdx = $this->orderModel->getInsertID();

            if($orderData['code_name']) $alarm_text = $orderData['code_name'] . '예약접수가 되었습니다.';
            else $alarm_text = '스파예약접수가 되었습니다.';
            $sql_alarm    = "INSERT tbl_alarm SET m_idx = '$memberIdx', contents = '$alarm_text', r_date = now()";
            $this->db->query($sql_alarm);

            $this->handleSubOrders($postData, $orderIdx, $productIdx);
            $this->handleOrderOptions($postData, $orderIdx, $productIdx);


            // tbl_order_option(성인) 추가
			$feeVal = explode("|", $postData['feeVal']);
			usort($feeVal, function($a, $b) {
				return $a[0] <=> $b[0]; // 첫 번째 값 비교
			});

			for($i=0;$i<count($feeVal);$i++)
            {
				    $_val         = explode(":", $feeVal[$i]);
                    if($_val[0] == "adults") {
                        $group = "성인";
                        $group_en = "Adults";
                    }
                    if($_val[0] == "kids") {
                         $group = "아동";
                         $group_en = "Kids";
                    };
                    if($_val[0] == "option") {
                        $group = "옵션";
                        $group_en = "Options";
                    };
					$option_type  = "spa";
					$order_idx	  =  $orderIdx;
					$product_idx  =  $productIdx;
					$option_name  =  $group .": ". $_val[3];
                    $option_name_eng  =  $group_en .": ". $_val[6];
					$option_tot   =  $_val[5] * $_val[2];
					$option_cnt   =  $_val[5];
					$option_date  =  Time::now('Asia/Seoul', 'en_US');
					$option_price =	 $_val[2];
					$option_qty   =  $_val[5];

					$orderOption = [
						'option_type'  => $option_type,
						'order_idx'    => $order_idx,
						'product_idx'  => $product_idx,
						'option_name'  => $option_name,
                        'option_name_eng'  => $option_name_eng,
						'option_tot'   => $option_tot,
						'option_cnt'   => $option_cnt,
						'option_date'  => $option_date,
						'option_price' => $option_price,
						'option_qty'   => $option_qty,
					];

                    $this->orderOptionModel->insert($orderOption);
					

            }

            if (!empty($postData['c_idx'])) {
                $this->updateCouponUsage($postData, $orderIdx, $productIdx, $memberIdx);
            }

            // $session->remove('data_cart');

            if($orderStatus == "W") {
				
                $sql = "SELECT a.order_no, a.order_price, a.*, b.product_name_en
                                , AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS user_name
                                , AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS user_email
                                FROM tbl_order_mst a
                                LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx WHERE order_idx = '". $orderIdx ."' ";

			    $row = $this->connect->query($sql)->getRow();
                
                $product_code_1 = $row->product_code_1;
                $product_code_2 = $row->product_code_2;
                $count = (int)$row->people_adult_cnt + (int)$row->people_kids_cnt;
                if($product_code_1 == '1303') {
                    $product_type = '호텔';
                } else if ($product_code_1 == '1302') {
                    $product_type = '골프';
                } else if ($product_code_1 == '1301') {
                    $product_type = '투어';
                } else if ($product_code_1 == '1325') {
                    $product_type = '스파';
                } else if ($product_code_1 == '1317') {
                    $product_type = '쇼ㆍ입장권';
                } else if ($product_code_1 == '1320') {
                    $product_type = '레스토랑';
                } else if ($product_code_2 == '132404') {
                    $product_type = '차량';
                } else if ($product_code_2 == '132403') {
                    $product_type = '가이드';
                }
				$code = "A14";
				$_tmp_fir_array = [
					'RECEIVE_NAME'=> $row->user_name,
					'PROD_NAME'   => $row->product_name,
					'ORDER_NO'    => $row->order_no,
                    'PROD_TYPE'   => $product_type,
                    'ORDER_DATE'   => $row->order_r_date,
                    'ORDER_NAME'   => $row->user_name,
					'ORDER_NUM_PEOPLE'   => $count,
				];
		
				autoEmail($code, $row->user_email, $_tmp_fir_array);

			    $allim_replace = [
									"#{고객명}" => $postData['order_user_name'],
									"phone"     => $phone_1 . "-" . $phone_2 . "-" . $phone_3
							     ];
			    
				alimTalkSend("TY_1652", $allim_replace);
				
				return $this->response->setJSON([
					'result' => true,
					'message' => "예약 되었습니다."
				], 200);
            } else {
				return $this->response->setJSON([
					'result' => true,
					'message' => "장바구니에 담겼습니다."
				], 200);
            }

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function handlePayment()
    {
		
        $db         = \Config\Database::connect();
		
        $session    =  Services::session();
        $memberIdx  =  $session->get('member')['idx'] ?? null;

        $m_idx      =  $memberIdx;

        try {
            $session   = Services::session();
            $memberIdx = $session->get('member')['idx'] ?? null;

            if (!$memberIdx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "로그인해주세요!"
                ], 400);
            }

            $postData         = $this->request->getPost();

            $productIdx       = $postData['product_idx'] ?? null;
            $orderStatus      = $postData['order_status'] ?? 'B';
            $orderUserEmail   = ($postData['email_1'] ?? '') . '@' . ($postData['email_2'] ?? '');

            $adultQtySum      = array_sum(array_map('intval', explode(',', $postData['adultQty'] ?? '')));
            $childrenQtySum   = array_sum(array_map('intval', explode(',', $postData['childrenQty'] ?? '')));

            // $adultPriceSum    = array_sum(array_map('intval', explode(',', $postData['adultPrice'] ?? '')));
            // $childrenPriceSum = array_sum(array_map('intval', explode(',', $postData['childrenPrice'] ?? '')));

            $adultQtyArray = array_map('intval', explode(',', $postData['adultQty'] ?? ''));
            $childrenQtyArray = array_map('intval', explode(',', $postData['childrenQty'] ?? ''));

            $adultPriceArray = array_map('intval', explode(',', $postData['adultPrice'] ?? ''));
            $childrenPriceArray = array_map('intval', explode(',', $postData['childrenPrice'] ?? ''));

            $adultPriceSum = array_sum(array_map(fn($qty, $price) => $qty * $price, $adultQtyArray, $adultPriceArray));

            $childrenPriceSum = array_sum(array_map(fn($qty, $price) => $qty * $price, $childrenQtyArray, $childrenPriceArray));

            $phone_1 = updateSQ($this->request->getPost('phone_1'));
            $phone_2 = updateSQ($this->request->getPost('phone_2'));
            $phone_3 = updateSQ($this->request->getPost('phone_3'));
            $payment_user_mobile = $phone_1 . "-" . $phone_2 . "-" . $phone_3;
            $payment_user_mobile = encryptField($payment_user_mobile, "encode");

            $phone_thai = updateSQ($this->request->getPost('phone_thai'));
            $phone_thai = encryptField($phone_thai, "encode");

            $local_phone = updateSQ($this->request->getPost('local_phone'));
            $local_phone = encryptField($local_phone, "encode");

            $order_user_name               = encryptField($postData['order_user_name'], 'encode');
            $order_user_email              = encryptField($orderUserEmail, 'encode');
            $order_user_first_name_en      = encryptField($postData['order_user_first_name_en'], 'encode');
            $order_user_last_name_en       = encryptField($postData['order_user_last_name_en'], 'encode');

            $order_no                      = $this->orderModel->makeOrderNo();

            $time_line      = $postData['time_line'] ?? '';
			
			$orderData = [
                'order_user_name'               => encryptField($postData['order_user_name'], 'encode') ?? $postData['order_user_name'],
                'order_user_email'              => encryptField($orderUserEmail, 'encode') ?? $orderUserEmail,
                'order_user_first_name_en'      => encryptField($postData['order_user_first_name_en'], 'encode') ?? $postData['order_user_first_name_en'],
                'order_user_last_name_en'       => encryptField($postData['order_user_last_name_en'], 'encode') ?? $postData['order_user_last_name_en'],
                'order_gender_list'             => $postData['companion_gender'] ?? '',
                'product_idx'                   => $productIdx,
                'user_id'                       => $memberIdx,
                'm_idx'                         => $memberIdx,
                'order_day'                     => $postData['day_'] ?? '',
                'order_user_mobile'             => $phone_thai ?? $payment_user_mobile,
                'order_user_phone'              => $phone_thai ?? $payment_user_mobile,
                'local_phone'                   => $local_phone ?? '',
                'people_adult_cnt'              => $adultQtySum,
                'people_kids_cnt'               => $childrenQtySum,
                'inital_price'                  => $postData['totalPrice'] ?? 0,
                'order_price'                   => $postData['lastPrice'] ?? 0,
                'order_memo'                    => $postData['order_memo'] ?? '',
                'order_r_date'                  => Time::now('Asia/Seoul', 'en_US'),
                'order_date'                    => Time::now('Asia/Seoul', 'en_US'),
                'used_coupon_idx'               => $postData['c_idx'] ?? null,
                'used_coupon_no'                => $postData['coupon_no'] ?? null,
                'used_coupon_money'             => $postData['discountPrice'] ?? 0,
                'used_coupon_point'             => $postData['pointPrice'] ?? 0,
                'people_adult_price'            => $adultPriceSum,
                'people_kids_price'             => $childrenPriceSum,
                'order_no'                      => $this->orderModel->makeOrderNo(),
                'order_status'                  => $orderStatus,
                'time_line'                     => $time_line,
                'ip'                            => $this->request->getIPAddress(),
                'order_gubun'                   => $postData['order_gubun'] ?? 'spa',
            ];

            $product = $this->productModel->find($productIdx);
            if ($product) {
                $orderData['product_name'] = $product['product_name'] ?? '';
                foreach (range(1, 4) as $i) {
                    $key             = "product_code_$i";
                    $orderData[$key] = $product[$key] ?? '';
                }
                $orderData['code_name'] = $this->codeModel->getByCodeNo($product['product_code_1'])['code_name'] ?? '';
            }

            $this->orderModel->insert($orderData);
            $orderIdx = $this->orderModel->getInsertID();

            // CREATE ALARM
            $sql_alarm    = "INSERT tbl_alarm SET m_idx = '$m_idx', contents = '레스토랑예약접수가 되었습니다.', r_date = now()";
            $this->db->query($sql_alarm);
            // END

            $this->handleSubOrders($postData, $orderIdx, $productIdx);
            $this->handleOrderOptions($postData, $orderIdx, $productIdx);


            // tbl_order_option(성인) 추가
			$feeVal = explode("|", $postData['feeVal']);
			usort($feeVal, function($a, $b) {
				return $a[0] <=> $b[0]; // 첫 번째 값 비교
			});

			for($i=0;$i<count($feeVal);$i++)
            {
				    $_val         = explode(":", $feeVal[$i]);
                    if($_val[0] == "adults") $group = "성인";
                    if($_val[0] == "kids")   $group = "아동";
					$option_type  = "spa";
					$order_idx	  =  $orderIdx;
					$product_idx  =  $productIdx;
					$option_name  =  $group .": ". $_val[3];
					$option_tot   =  $_val[5] * $_val[2];
					$option_cnt   =  $_val[5];
					$option_date  =  Time::now('Asia/Seoul', 'en_US');
					$option_price =	 $_val[2];
					$option_qty   =  $_val[5];

					$sql = "INSERT INTO tbl_order_option SET  option_type  =  '$option_type' 
															, order_idx    =  '$order_idx' 
															, product_idx  =  '$product_idx' 
															, option_name  =  '$option_name' 
															, option_tot   =  '$option_tot' 
															, option_cnt   =  '$option_cnt' 
															, option_date  =  '$option_date' 
															, option_price =  '$option_price' 
															, option_qty   =  '$option_qty' ";
					$this->connect->query($sql);

            }

            if (!empty($postData['c_idx'])) {
                $this->updateCouponUsage($postData, $orderIdx, $productIdx, $memberIdx);
            }


			$payment_no = "P_". date('YmdHis') . rand(100, 999); 				// 가맹점 결제번호

			$sql = " SELECT COUNT(payment_idx) AS cnt from tbl_payment_mst WHERE payment_no = '" . $payment_no . "'";
			//write_log($sql);
			$row = $db->query($sql)->getRowArray();

			if($row['cnt'] == 0) {
                    $device_type = get_device();
					$sql = "INSERT INTO tbl_payment_mst SET m_idx                      = '". $m_idx ."'
														   ,payment_no                 = '". $payment_no ."'
														   ,order_no                   = '". $order_no ."'
														   ,product_name               = '". $product_name ."'
														   ,payment_date               = '". $data['order_r_date'] ."'
														   ,payment_tot                = '". $postData['totalPrice'] ."'
														   ,payment_price              = '". $postData['totalPrice'] ."'
														   ,payment_user_name          = '". $order_user_name ."'
														   ,payment_user_first_name_en = '". $order_user_first_name_en ."'	
														   ,payment_user_last_name_en  = '". $order_user_last_name_en ."'	
														   ,payment_user_email         = '". $payment_user_email ."'
														   ,payment_user_mobile        = '". $payment_user_mobile ."'
														   ,payment_user_phone         = '". $payment_user_phone ."'
														   ,local_phone                = '". $local_phone ."'	
														   ,payment_user_gender        = '". $payment_user_gender ."'
														   ,phone_thai                 = '". $phone_thai ."'
														   ,payment_memo               = '". $payment_memo ."' 
                                                           ,ip                         = '". $_SERVER['REMOTE_ADDR'] ."' 				
                                                           ,device_type                = '". $device_type ."' 					
														   ,baht_thai                  = '". $this->setting['baht_thai'] ."'" ;
			        //write_log("handlePayment - ". $sql);
					$result = $db->query($sql);
			}

			if ($m_idx)
			{
				$sql_m	  = " SELECT * from tbl_member WHERE m_idx = '". $m_idx ."' ";
				$row_m    = $db->query($sql_m)->getRowArray();
				$mileage  = $row_m["mileage"];
				if ($mileage == "") {
					$mileage = 0;
				}

			}

			// DB 및 세션 초기화
			$session = \Config\Services::session();

			// 빌더 설정
			$builder = $db->table('tbl_coupon c');

			// SELECT 및 JOIN 처리
			$builder->select('c.c_idx, c.coupon_num, s.coupon_name, s.coupon_pe, s.coupon_price, s.dex_price_pe');
			$builder->join('tbl_coupon_setting s', 'c.coupon_type = s.idx', 'left');
			$builder->join('tbl_coupon_history h', 'c.c_idx = h.used_coupon_idx', 'left');

			// 조건 처리
			$builder->where('c.status', 'N');
			$builder->where('c.enddate >', 'CURDATE()', false); // SQL 함수 그대로 사용
			$builder->where('c.usedate', '');
			$builder->where('c.user_id', $session->get('member')['id'] ?? ''); // 키 검증
			$builder->where('h.used_coupon_idx IS NULL', null, false); // SQL 구문 그대로 처리

			// GROUP BY 처리
			$builder->groupBy('c.c_idx');

			// 쿼리 실행 및 결과 확인
			$query  = $builder->get();
			$result = $query->getResultArray(); // 결과 배열 반환
		
			$data = [
				'product_name' => $data['product_name'],
				'payment_no'   => $payment_no,
				'dataValue'    => $data['order_no'],
				'resultCoupon' => $result,
				'point'        => $mileage
			];			
			return view('checkout/confirm', $data);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }
	
    private function handleSubOrders(array $postData, int $orderIdx, ?int $productIdx)
    {
        $types = ['adult' => 'order_a', 'kids' => 'order_c'];
        foreach ($types as $type => $prefix) {
            $firstNames = $postData["{$prefix}_first_name"] ?? [];
            $lastNames = $postData["{$prefix}_last_name"] ?? [];
            foreach ($firstNames as $i => $firstName) {
                $this->orderSubModel->insert([
                    'order_gubun'      => $type,
                    'order_idx'        => $orderIdx,
                    'product_idx'      => $productIdx,
                    'order_first_name' => encryptField($firstName, 'encode'),
                    'order_last_name'  => encryptField($lastNames[$i] ?? '', 'encode'),
                ]);
            }
        }
    }

    private function handleOrderOptions(array $postData, int $orderIdx, ?int $productIdx)
    {
        $optionKeys = ['option_idx', 'option_name', 'option_cnt', 'option_price', 'option_qty', 'option_tot'];
        $options = array_map(fn($key) => $postData[$key] ?? [], $optionKeys);
        foreach ($options['option_idx'] as $i => $idx) {
            $this->orderOptionModel->insert([
                'option_type'  => $postData['order_gubun'] ?? 'spa',
                'order_idx'    => $orderIdx,
                'product_idx'  => $productIdx,
                'option_idx'   => $idx ?? 0,
                'option_name'  => $options['option_name'][$i] ?? '',
                'option_cnt'   => $options['option_cnt'][$i] ?? 0,
                'option_price' => $options['option_price'][$i] ?? 0,
                'option_qty'   => $options['option_qty'][$i] ?? 0,
                'option_tot'   => $options['option_tot'][$i] ?? 0,
                'option_date'  => $postData['day_'] ?? '',
            ]);
        }
    }

    private function updateCouponUsage(array $postData, int $orderIdx, ?int $productIdx, int $memberIdx)
    {
        $this->coupon->update($postData['c_idx'], ['status' => 'E']);
        $this->couponHistory->insert([
            'order_idx'         => $orderIdx,
            'product_idx'       => $productIdx,
            'used_coupon_no'    => $postData['coupon_no'] ?? '',
            'used_coupon_idx'   => $postData['c_idx'] ?? null,
            'used_coupon_money' => $postData['discountPrice'] ?? 0,
            'ch_r_date'         => Time::now('Asia/Seoul', 'en_US'),
            'm_idx'             => $memberIdx,
        ]);
    }

    public function get_spa_options() {
        $db         = \Config\Database::connect();
        $baht_thai = $this->setting['baht_thai'] ?? 0;

        $product_idx = $this->request->getVar('product_idx');
        $date = $this->request->getVar('date');

        $builder = $db->table('tbl_spas_price p');

        $builder->select('p.*, s.spas_subject, s.spas_subject_eng, s.is_explain, s.spas_explain, si.info_name');
        $builder->join('tbl_product_spas s', 'p.spas_idx = s.spas_idx', 'left');
        $builder->join('tbl_product_spas_info si', 'si.info_idx = s.info_idx', 'left');
        $builder->where("p.product_idx =", $product_idx);
        $builder->where("p.goods_date =", $date);
        $builder->where("s.status !=", 'N');
        $builder->where("p.use_yn !=", 'N');
        $builder->where("si.o_sdate !=", '0000-00-00 00:00:00');
        $builder->where("si.o_sdate IS NOT NULL", null, false);
        $builder->where("si.o_edate !=", '0000-00-00 00:00:00');
        $builder->where("si.o_edate IS NOT NULL", null, false);

        $builder->orderBy("si.o_onum", 'asc');
        $builder->orderBy("si.info_idx", 'asc');
        $builder->orderBy("s.spa_onum", 'asc');
        $builder->orderBy("s.spas_idx", 'asc');

        $options_list = $builder->get()->getResultArray();

        foreach($options_list as $key => $day) {
            $options_list[$key]['goods_price1_won'] = round($day['goods_price1'] * $baht_thai);
            $options_list[$key]['goods_price2_won'] = round($day['goods_price2'] * $baht_thai);
            $query = $db->table('tbl_spas_price p')->selectCount('p.goods_date', 'cnt')
                        ->join('tbl_product_spas s', 'p.spas_idx = s.spas_idx', 'left')
                        ->where("p.product_idx =", $day["product_idx"])
                        ->where("p.goods_date =", $day["goods_date"])
                        ->where("p.info_idx =", $day["info_idx"])
                        ->where("s.status !=", 'N')
                        ->where("p.use_yn !=", 'N')
                        ->groupBy("goods_date")->get()->getRow();
            $options_list[$key]['count_options'] = $query->cnt;
        }

        return $this->response->setJSON($options_list);
    }

    public function get_mOption() {
        $info_idx = $this->request->getVar('info_idx');
        $product_idx = $this->request->getVar('product_idx');
        $m_option = $this->spasMoption->where("info_idx", $info_idx)
                                        ->where("product_idx", $product_idx)
                                        ->where("moption_name != ", "")
                                        ->where("use_yn =", "Y")
                                        ->orderBy("onum", "asc")
                                        ->get()->getResultArray();
        return $this->response->setJSON($m_option);
        
    }  


    public function sel_moption()
    {
        $db = \Config\Database::connect();

        try {
            $product_idx = $this->request->getPost('product_idx');
            $code_idx = $this->request->getPost('code_idx');
            $info_idx = $this->request->getPost('info_idx');

            $msg = "";
            $msg .= "<select name='option' id='option_" . $code_idx . "' onchange='sel_option(this.value, ". $info_idx .");'>";
            $msg .= "<option value=''>옵션 선택</option>";

            $sql = "SELECT * FROM tbl_spas_option WHERE product_idx = '$product_idx' AND code_idx = '$code_idx' ORDER BY onum ASC";
            $result = $db->query($sql);
            $result = $result->getResultArray();
            foreach ($result as $row) {
                $msg .= "<option value='" . $row['idx'] . "|" . $row['option_price'] * $this->setting['baht_thai'] . "'>" . $row['option_name'] . " +" . number_format($row['option_price'] * $this->setting['baht_thai']) . "원" . "(" . number_format($row['option_price']) . "바트)" . "</option>";
            }

            $msg .= "</select>";

            return $msg;
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function sel_option()
    {
        $db = \Config\Database::connect();

        try {
            $idx = $this->request->getPost('idx');

            $sql = "SELECT a.*, b.moption_name as parent_name FROM tbl_spas_option a LEFT JOIN tbl_spas_moption b ON a.code_idx = b.code_idx WHERE a.idx = '$idx' ";
            $result = $db->query($sql)->getRowArray();
     
            $result['option_price_won'] = round($result['option_price'] * $this->setting['baht_thai']);

            return $this->response->setJSON($result, 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
