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

    public function __construct()
    {
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

            if (!$memberIdx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "로그인해주세요!"
                ], 400);
            }

            $dataCart = $session->get('data_cart');
            if (empty($dataCart)) {
                return redirect()->to('/');
            }

            $postData         = $this->request->getPost();

            $productIdx       = $postData['product_idx'] ?? null;
            $orderStatus      = $postData['order_status'] ?? 'W';
            $orderUserEmail   = ($postData['email_1'] ?? '') . '@' . ($postData['email_2'] ?? '');

            $adultQtySum      = array_sum(array_map('intval', explode(',', $postData['adultQty'] ?? '')));
            $childrenQtySum   = array_sum(array_map('intval', explode(',', $postData['childrenQty'] ?? '')));

            $adultPriceSum    = array_sum(array_map('intval', explode(',', $postData['adultPrice'] ?? '')));
            $childrenPriceSum = array_sum(array_map('intval', explode(',', $postData['childrenPrice'] ?? '')));

            $phone_1 = updateSQ($this->request->getPost('phone_1'));
            $phone_2 = updateSQ($this->request->getPost('phone_2'));
            $phone_3 = updateSQ($this->request->getPost('phone_3'));
            $payment_user_mobile = $phone_1 . "-" . $phone_2 . "-" . $phone_3;
            $payment_user_mobile = encryptField($payment_user_mobile, "encode");

            $phone_thai = updateSQ($this->request->getPost('phone_thai'));
            $phone_thai = encryptField($phone_thai, "encode");

            $local_phone = updateSQ($this->request->getPost('local_phone'));
            $local_phone = encryptField($local_phone, "encode");

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

            $session->remove('data_cart');

            if($orderStatus == "W") {
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

    private function handleSubOrders(array $postData, int $orderIdx, ?int $productIdx)
    {
        $types = ['adult' => 'order_a', 'kids' => 'order_c'];
        foreach ($types as $type => $prefix) {
            $firstNames = $postData["{$prefix}_first_name"] ?? [];
            $lastNames = $postData["{$prefix}_last_name"] ?? [];
            foreach ($firstNames as $i => $firstName) {
                $this->orderSubModel->insert([
                    'order_gubun' => $type,
                    'order_idx' => $orderIdx,
                    'product_idx' => $productIdx,
                    'order_first_name' => encryptField($firstName, 'encode'),
                    'order_last_name' => encryptField($lastNames[$i] ?? '', 'encode'),
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
                'option_type' => $postData['order_gubun'] ?? 'spa',
                'order_idx' => $orderIdx,
                'product_idx' => $productIdx,
                'option_idx' => $idx ?? 0,
                'option_name' => $options['option_name'][$i] ?? '',
                'option_cnt' => $options['option_cnt'][$i] ?? 0,
                'option_price' => $options['option_price'][$i] ?? 0,
                'option_qty' => $options['option_qty'][$i] ?? 0,
                'option_tot' => $options['option_tot'][$i] ?? 0,
                'option_date' => $postData['day_'] ?? '',
            ]);
        }
    }

    private function updateCouponUsage(array $postData, int $orderIdx, ?int $productIdx, int $memberIdx)
    {
        $this->coupon->update($postData['c_idx'], ['status' => 'E']);
        $this->couponHistory->insert([
            'order_idx' => $orderIdx,
            'product_idx' => $productIdx,
            'used_coupon_no' => $postData['coupon_no'] ?? '',
            'used_coupon_idx' => $postData['c_idx'] ?? null,
            'used_coupon_money' => $postData['discountPrice'] ?? 0,
            'ch_r_date' => Time::now('Asia/Seoul', 'en_US'),
            'm_idx' => $memberIdx,
        ]);
    }
}
