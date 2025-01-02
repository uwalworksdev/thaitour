<?php

namespace App\Controllers;

use App\Models\Code;
use App\Models\GuideOptions;
use App\Models\Guides;
use App\Models\GuideSupOptions;
use App\Models\OrderGuideModel;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;
use Config\Services;

class TourGuideController extends BaseController
{
    protected $connect;
    protected $guideModel;
    protected $productModel;
    protected $codeModel;
    protected $guideOptionModel;
    protected $guideSupOptionModel;
    protected $orderGuideModel;
    protected $reviewModel;
    protected $orderModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->guideModel = new Guides();
        $this->productModel = new ProductModel();
        $this->codeModel = new Code();
        $this->guideOptionModel = new GuideOptions();
        $this->orderModel = new OrdersModel();
        $this->guideSupOptionModel = new GuideSupOptions();
        $this->orderGuideModel = new OrderGuideModel();
        $this->reviewModel = model("ReviewModel");
    }

    public function index()
    {
        try {
            $g_list_rows = 10;
            $pg = updateSQ($this->request->getVar("pg") ?? '');
            $data = $this->productModel->findProductPaging(['product_code_2' => '132403', 'guide_type' => 'P'], $g_list_rows, $pg, ['onum' => 'desc']);

            $guides = $this->productModel->findProductPaging(['product_code_2' => '132403', 'guide_type' => 'I'], $g_list_rows, $pg, ['onum' => 'desc']);

            $product_guides = array_map(function ($item) {
                $review = $this->getNoBestReviewProduct($item['product_idx']);
                $item['reviews'] = $review['reviews'];
                $item['countReviews'] = $review['reviewCount'];

                return $item;
            }, $guides['items']);

            $res = [
                'products' => $data['items'],
                'guides' => $product_guides,
            ];

            return $this->renderView('guides/index', $res);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'data' => null,
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function detail($product_idx)
    {
        try {
            $data = [];
            return $this->renderView('guides/detail', $data);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'data' => null,
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function guideView()
    {
        try {
            $product_idx = $this->request->getVar('g_idx');
            $guide = $this->productModel->getById($product_idx);

            if (!$guide) {
                return $this->renderView('errors/404');
            }

            $mcode = $this->codeModel->getByCodeNo($guide['mbti']);

            $productReview = $this->reviewModel->getProductReview($product_idx);

            $guide['total_review'] = $productReview['total_review'];
            $guide['review_average'] = $productReview['avg'];

            $data_reviews = $this->getReviewProduct($product_idx) ?? [];

            $options = $this->guideOptionModel->getListByProductId($product_idx);

            $options = array_map(function ($item) {
                $option = (array)$item;

                $option['sup_options'] = $this->guideSupOptionModel->getListByOptionId($item['o_idx']);

                return $option;
            }, $options);

            $data = [
                "guide" => $guide,
                "mcode" => $mcode,
                "options" => $options,
            ];

            for ($i = 1; $i <= 6; $i++) {
                $file = "ufile" . $i;
                if (is_file(ROOTPATH . "public/uploads/guides/" . $guide[$file])) {
                    $data['imgs'][] = "/uploads/guides/" . $guide[$file];
                    $data['img_names'][] = $guide["rfile" . $i];
                } else {
                    $data['imgs'][] = "/images/product/noimg.png";
                    $data['img_names'][] = "";
                }
            }

            $data = array_merge($data, $data_reviews);
            return $this->renderView('guides/guides_view', $data);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'data' => null,
                    'message' => $e->getMessage()
                ]);
        }
    }

    function processBooking()
    {
        try {
            $session = Services::session();

            $product_idx = $_POST['product_idx'];
            $o_idx = $_POST['o_idx'];

            $start_day_ = $_POST['start_day'];
            $end_day_ = $_POST['end_day'];

            $people_cnt = $_POST['people_cnt'];

            $member_idx = $_SESSION['member']['idx'];

            if (!$member_idx) {
                $message = "로그인해주세요!";
                return $this->response->setJSON([
                    'result' => false,
                    'message' => $message
                ])->setStatusCode(400);
            }

            if ($people_cnt == 0 || !$start_day_ || !$end_day_) {
                $message = "유효한 일수를 선택하세요!";
                return $this->response->setJSON([
                    'result' => false,
                    'message' => $message
                ])->setStatusCode(400);
            }

            if (!$product_idx) {
                $message = "제품을 선택해주세요!";
                return $this->response->setJSON([
                    'result' => false,
                    'message' => $message
                ])->setStatusCode(400);
            }

            $data = [
                'product_idx' => $product_idx,
                'o_idx' => $o_idx,
                'start_day' => $start_day_,
                'end_day' => $end_day_,
                'people_cnt' => $people_cnt,
            ];

            $session->set('guide_cart', $data);

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'data' => $data,
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'data' => null,
                    'message' => $e->getMessage()
                ]);
        }
    }

    function guideBooking()
    {
        $session = Services::session();
        $data = $session->get('guide_cart');

        if (empty($data)) {
            return redirect()->back();
        }

        $product_idx = $data['product_idx'];
        $o_idx = $data['o_idx'];
        $start_day = $data['start_day'];
        $end_day = $data['end_day'];
        $people_cnt = $data['people_cnt'];

        $product = $this->productModel->getById($product_idx);

        $option = $this->guideOptionModel->getById($o_idx);
        $sup_options = $this->guideSupOptionModel->getListByOptionId($o_idx);

        $start_timestamp = strtotime($start_day);
        $end_timestamp = strtotime($end_day);

        $days_difference = ($end_timestamp - $start_timestamp) / (60 * 60 * 24);

        $totalPrice = 0;

        $totalPrice += floatval($option['o_sale_price']);

        foreach ($sup_options as $item) {
            $totalPrice += floatval($item['s_price']);
        }

        $totalPrice_won = $totalPrice * $this->setting['baht_thai'];

        $res = [
            'product' => $product,
            'option' => $option,
            'totalPrice' => $totalPrice,
            'totalPrice_won' => $totalPrice_won,
            'sup_options' => $sup_options,
            'days_difference' => $days_difference,
            'o_idx' => $o_idx,
            'start_day' => $start_day,
            'end_day' => $end_day,
            'people_cnt' => $people_cnt,
        ];

        return view('guides/guide_booking', $res);
    }

    public function handeBooking()
    {
        try {
            $session = Services::session();
            $memberIdx = $session->get('member')['idx'] ?? null;

            if (!$memberIdx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "로그인해주세요!"
                ], 400);
            }

            $dataCart = $session->get('guide_cart');
            if (empty($dataCart)) {
                return redirect()->to('/');
            }

            $postData = $this->request->getPost();

            $productIdx = $postData['product_idx'] ?? null;
            $orderStatus = $postData['order_status'] ?? 'W';
            $orderUserEmail = ($postData['email_1'] ?? '') . '@' . ($postData['email_2'] ?? '');

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
                'order_user_name' => encryptField($postData['order_user_name'], 'encode') ?? $postData['order_user_name'],
                'order_user_first_name_en' => encryptField($postData['order_user_first_name_en'], 'encode') ?? $postData['order_user_first_name_en'],
                'order_user_last_name_en' => encryptField($postData['order_user_last_name_en'], 'encode') ?? $postData['order_user_last_name_en'],
                'order_user_email' => encryptField($orderUserEmail, 'encode') ?? $orderUserEmail,
                'order_gender_list' => $postData['companion_gender'] ?? '',
                'product_idx' => $productIdx,
                'order_user_mobile' => $phone_thai ?? $payment_user_mobile,
                'order_user_phone' => $phone_thai ?? $payment_user_mobile,
                'local_phone' => $local_phone ?? '',
                'user_id' => $memberIdx,
                'm_idx' => $memberIdx,
                'yoil_idx' => $postData['option_idx'] ?? 0,
                'inital_price' => $postData['totalPrice'] ?? 0,
                'people_adult_cnt' => $postData['people_cnt'] ?? 0,
                'order_price' => $postData['lastPrice'] ?? $postData['totalPrice'],
                'order_memo' => $postData['order_memo'] ?? '',
                'start_date' => $postData['start_date'] ?? '',
                'end_date' => $postData['end_date'] ?? '',
                'order_r_date' => Time::now('Asia/Seoul', 'en_US'),
                'order_date' => Time::now('Asia/Seoul', 'en_US'),
                'used_coupon_idx' => $postData['c_idx'] ?? 0,
                'used_coupon_no' => $postData['coupon_no'] ?? 0,
                'used_coupon_money' => $postData['discountPrice'] ?? 0,
                'used_coupon_point' => $postData['pointPrice'] ?? 0,
                'order_no' => $this->orderModel->makeOrderNo(),
                'order_status' => $orderStatus,
                'ip' => $this->request->getIPAddress(),
                'order_gubun' => $postData['order_gubun'] ?? 'guide',
            ];

            $product = $this->productModel->find($productIdx);
            if ($product) {
                $orderData['product_name'] = $product['product_name'] ?? '';
                foreach (range(1, 4) as $i) {
                    $key = "product_code_$i";
                    $orderData[$key] = $product[$key] ?? '';
                }
                $orderData['code_name'] = $this->codeModel->getByCodeNo($product['product_code_1'])['code_name'] ?? '';
            }

            $this->orderModel->insert($orderData);
            $orderIdx = $this->orderModel->getInsertID();

            $this->handleSubOrders($postData, $orderIdx, $productIdx);

            $session->remove('guide_cart');

            if ($orderStatus === "W") {
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "예약 되었습니다."
                ], 200);
            }

            return $this->response->setJSON([
                'result' => true,
                'message' => "장바구니에 담겼습니다."
            ], 200);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    private function handleSubOrders(array $postData, int $orderIdx, ?int $productIdx)
    {
        $guide_meeting_hour_arr = $postData['guideMeetingHour'] ?? [];
        $guide_meeting_min_arr = $postData['guideMeetingMin'] ?? [];
        $guide_meeting_place_arr = $postData['guideMeetingPlace'] ?? [];
        $guide_schedule_arr = $postData['guideSchedule'] ?? [];
        $request_memo_arr = $postData['requestMemo'] ?? [];

        $len = count($guide_meeting_hour_arr);

        for ($i = 0; $i < $len; $i++) {
            $this->orderGuideModel->insert([
                'order_idx' => $orderIdx,
                'guide_meeting_hour' => $guide_meeting_hour_arr[$i],
                'guide_meeting_min' => $guide_meeting_min_arr[$i],
                'guide_meeting_place' => $guide_meeting_place_arr[$i],
                'guide_schedule' => $guide_schedule_arr[$i],
                'request_memo' => $request_memo_arr[$i],
                'created_at' => Time::now('Asia/Seoul', 'en_US'),
                'product_idx' => $productIdx,
            ]);
        }
    }

    public function completeBooking()
    {
        return view('guides/booking-complete');
    }

    public function getReviews()
    {
        try {
            $idx = $this->request->getVar('idx');

            $data = $this->getNoBestReviewProduct($idx);

            return $this->response->setJSON([
                'result' => true,
                'status' => 'success',
                'data' => $data,
                'message' => "평가 데이터를 성공적으로 가져왔습니다."
            ], 200);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    private function getReviewCategories($idx)
    {
        $sql = "SELECT * FROM tbl_code WHERE parent_code_no=42 ORDER BY onum ";
        $reviewCategories = $this->connect->query($sql) or die($this->db->error);
        $reviewCategories = $reviewCategories->getResultArray();

        $reviewCategories = array_map(function ($item) use ($idx) {
            $reviewCategory = (array)$item;

            $sql = "SELECT * FROM tbl_travel_review WHERE product_idx = " . $this->connect->escape($idx) .
                " AND review_type LIKE '%" . $this->connect->escapeLikeString($item['code_no']) . "%'";
            $results = $this->connect->query($sql);
            $count = $results->getNumRows();
            $results = $results->getResultArray();

            if ($count == 0) {
                $average = 0;
            } else {
                $total = 0;
                foreach ($results as $item2) {
                    $total += (int)$item2['number_stars'];
                }

                $average = number_format($total / $count, 1);
            }

            $reviewCategory['average'] = $average;
            $reviewCategory['total'] = $count;

            return $reviewCategory;
        }, $reviewCategories);

        return $reviewCategories;
    }

    private function getReviewProduct($idx)
    {
        $sql = "SELECT a.*, b.ufile1 as avt
                    FROM tbl_travel_review a 
                    INNER JOIN tbl_member b ON a.user_id = b.m_idx 
                    WHERE a.product_idx = " . $idx . " AND a.is_best = 'Y' ORDER BY a.onum DESC, a.idx DESC";

        $reviews = $this->connect->query($sql) or die($this->connect->error);
        $reviewCount = $reviews->getNumRows();
        $reviews = $reviews->getResultArray();
        return ['reviews' => $reviews, 'reviewCount' => $reviewCount];
    }

    private function getNoBestReviewProduct($idx)
    {
        $sql = "SELECT a.*, b.ufile1 as avt
                    FROM tbl_travel_review a 
                    INNER JOIN tbl_member b ON a.user_id = b.m_idx 
                    WHERE a.product_idx = " . $idx . " ORDER BY a.onum DESC, a.idx DESC";

        $reviews = $this->connect->query($sql) or die($this->connect->error);
        $reviewCount = $reviews->getNumRows();
        $reviews = $reviews->getResultArray();
        return ['reviews' => $reviews, 'reviewCount' => $reviewCount];
    }
}
