<?php

namespace App\Controllers;

use App\Models\Code;
use App\Models\GuideOptions;
use App\Models\Guides;
use App\Models\GuideSupOptions;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;
use Config\Services;

class TourGuideController extends BaseController
{
    protected $connect;
    protected $guideModel;
    protected $productModel;
    protected $codeModel;
    protected $guideOptionModel;
    protected $guideSupOptionModel;
    protected $reviewModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->guideModel = new Guides();
        $this->productModel = new ProductModel();
        $this->codeModel = new Code();
        $this->guideOptionModel = new GuideOptions();
        $this->guideSupOptionModel = new GuideSupOptions();
        $this->reviewModel = model("ReviewModel");
    }

    public function index()
    {
        try {
            $g_list_rows = 10;
            $pg = updateSQ($this->request->getVar("pg") ?? '');
            $data = $this->productModel->findProductPaging(['product_code_2' => '132403', 'guide_type' => 'P'], $g_list_rows, $pg, ['onum' => 'desc']);

            $guides = $this->productModel->findProductPaging(['product_code_2' => '132403', 'guide_type' => 'I'], $g_list_rows, $pg, ['onum' => 'desc']);

            $res = [
                'products' => $data['items'],
                'guides' => $guides['items'],
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

            $data['reviewCategories'] = $this->getReviewCategories($product_idx) ?? [];
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

    }

    public function completeBooking()
    {
        return view('guides/booking-complete');
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
}
