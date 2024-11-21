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
                        $tour_price_baht = convertToBath($tour_price);
                        $rs['tour_price_baht'] = $tour_price_baht;

                        $tour_price_kids = $rs['tour_price_kids'];
                        $tour_price_kids_baht = convertToBath($tour_price_kids);
                        $rs['tour_price_kids_baht'] = $tour_price_kids_baht;

                        $tour_price_senior = $rs['tour_price_senior'];
                        $tour_price_senior_baht = convertToBath($tour_price_senior);
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
            $session = Services::session();
            $member_idx = $_SESSION['member']['idx'];

            if (!$member_idx) {
                $message = "로그인해주세요!";
                return $this->response->setJSON([
                    'result' => false,
                    'message' => $message
                ], 400);
            }

            $dataCart = $session->get('data_cart');

            if (empty($dataCart)) {
                return redirect()->to('/');
            }

            $dataPost = $this->request->getPost();

            $order_user_name = $this->request->getPost('order_user_name');
            $email_name = $this->request->getPost('email_name');
            $email_host = $this->request->getPost('email_host');
            $order_user_mobile = $this->request->getPost('order_user_mobile');

            $product_idx = $this->request->getPost('product_idx');

            $order_a_first_name = $this->request->getPost('order_a_first_name');
            $order_a_last_name = $this->request->getPost('order_a_last_name');

            $order_c_first_name = $this->request->getPost('order_c_first_name');
            $order_c_last_name = $this->request->getPost('order_c_last_name');

            $order_memo = $this->request->getPost('order_memo');

            $day_ = $this->request->getPost('day_');
            $adultQty = $this->request->getPost('adultQty');
            $childrenQty = $this->request->getPost('childrenQty');
            $totalPrice = $this->request->getPost('totalPrice');

            $option_idx = $this->request->getPost('option_idx');
            $option_qty = $this->request->getPost('option_qty');
            $option_tot = $this->request->getPost('option_tot');
            $option_cnt = $this->request->getPost('option_cnt');
            $option_price = $this->request->getPost('option_price');
            $option_name = $this->request->getPost('option_name');

            $order_user_email = $email_name . '@' . $email_host;

            $product = $this->productModel->find($product_idx);

            $order_gubun = $this->request->getPost('order_gubun') ?? 'spa';

            $discountPrice = $this->request->getPost('discountPrice');
            $pointPrice = $this->request->getPost('pointPrice');
            $lastPrice = $this->request->getPost('lastPrice');
            $c_idx = $this->request->getPost('c_idx');
            $coupon_no = $this->request->getPost('coupon_no');

            $people_adult_cnt = 0;

            foreach ($adultQty as $key => $value) {
                $people_adult_cnt += intval($value);
            }

            $people_kids_cnt = 0;
            foreach ($childrenQty as $key => $value) {
                $people_kids_cnt += intval($value);
            }

            $data = [
                'order_user_name' => $order_user_name,
                'order_user_email' => encryptField($order_user_email, 'encode'),
                'order_user_phone' => encryptField($order_user_mobile, 'encode'),
                'product_idx' => $product_idx,
                'user_id' => $member_idx,
                'm_idx' => $member_idx,
                'order_day' => $day_,
                'people_adult_cnt' => $people_adult_cnt,
                'people_kids_cnt' => $people_kids_cnt,
                'inital_price' => $totalPrice,
                'order_price' => $lastPrice,
                'order_memo' => $order_memo,
                'order_date' => Time::now('Asia/Seoul', 'en_US'),
            ];

            $data['used_coupon_idx'] = $c_idx;
            $data['used_coupon_no'] = $coupon_no;
            $data['used_coupon_money'] = $discountPrice;
            $data['used_coupon_point'] = $pointPrice;

            $data['order_no'] = $this->orderModel->makeOrderNo();

            $data['order_r_date'] = date('Y-m-d H:i:s');
            $data['order_status'] = "W";

            $data['product_name'] = $product['product_name'];
            $data['product_code_1'] = $product['product_code_1'];
            $data['product_code_2'] = $product['product_code_2'];
            $data['product_code_3'] = $product['product_code_3'];
            $data['product_code_4'] = $product['product_code_4'];

            $data['ip'] = $this->request->getIPAddress();
            $data['order_gubun'] = $order_gubun;
            $data['code_name'] = $this->codeModel->getByCodeNo($data['product_code_1'])['code_name'];
            $data['order_user_name'] = encryptField($dataPost['order_user_name'] ?? '', 'encode');
            $data['order_user_first_name_en'] = encryptField($dataPost['order_user_first_name_en'] ?? '', 'encode');
            $data['order_user_last_name_en'] = encryptField($dataPost['order_user_last_name_en'] ?? '', 'encode');

            $data['local_phone'] = encryptField($dataPost['local_phone'] ?? '', 'encode');

            if ($dataPost['radio_phone'] === "kor") {
                $order_user_mobile = $dataPost['phone_1'] . "-" . $dataPost['phone_2'] . "-" . $dataPost['phone_3'];
            } else {
                $order_user_mobile = $dataPost['phone_thai'] ?? $order_user_mobile;
            }

            $data['order_user_mobile'] = encryptField($order_user_mobile, 'encode');

            $this->orderModel->save($data);

            $order_idx = $this->orderModel->getInsertID();

            $countA = count($order_a_first_name);
            for ($i = 0; $i < $countA; $i++) {
                $this->orderSubModel->insert([
                    'order_gubun' => 'adult',
                    'order_idx' => $order_idx,
                    'product_idx' => $data['product_idx'],
                    'order_first_name' => encryptField($order_a_first_name[$i], 'encode'),
                    'order_last_name' => $order_a_last_name[$i],
                ]);
            }

            $countC = count($order_c_first_name);
            for ($i = 0; $i < $countC; $i++) {
                $this->orderSubModel->insert([
                    'order_gubun' => 'kids',
                    'order_idx' => $order_idx,
                    'product_idx' => $data['product_idx'],
                    'order_first_name' => encryptField($order_c_first_name[$i], 'encode'),
                    'order_last_name' => encryptField($order_c_last_name[$i], 'encode'),
                ]);
            }

            if (isset($option_idx)) {
                $countO = count($option_idx);
                for ($i = 0; $i < $countO; $i++) {
                    $this->orderOptionModel->insert([
                        'option_type' => $order_gubun,
                        'order_idx' => $order_idx,
                        'product_idx' => $data['product_idx'],
                        'option_idx' => $option_idx[$i],
                        'option_name' => $option_name[$i],
                        'option_cnt' => $option_cnt[$i],
                        'option_price' => $option_price[$i],
                        'option_qty' => $option_qty[$i],
                        'option_tot' => $option_tot[$i],
                        'option_date' => $day_,
                    ]);
                }
            }

            $use_coupon_idx = $c_idx;
            $used_coupon_money = $discountPrice;
            $m_idx = $member_idx;
            if (!empty($use_coupon_idx)) {
                $this->coupon->update($use_coupon_idx, ["status" => "E"]);

                $cou_his = [
                    "order_idx" => $order_idx,
                    "product_idx" => $product_idx,
                    "used_coupon_no" => $coupon["coupon_num"] ?? "",
                    "used_coupon_idx" => $use_coupon_idx,
                    "used_coupon_money" => $used_coupon_money,
                    "ch_r_date" => Time::now('Asia/Seoul', 'en_US'),
                    "m_idx" => $m_idx
                ];

                $this->couponHistory->insert($cou_his);
            }

            $session->set('data_cart', null);

            return $this->response->setJSON([
                'result' => true,
                'message' => "주문되었습니다."
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
