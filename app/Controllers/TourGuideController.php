<?php

namespace App\Controllers;

use App\Models\Code;
use App\Models\GuideOptions;
use App\Models\Guides;
use App\Models\GuideSupOptions;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;

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
            $data = $this->productModel->findProductPaging(['product_code_1' => '1326'], $g_list_rows, $pg, ['onum' => 'desc']);

            $guides = $this->guideModel->getListByStatus();

            $res = [
                'products' => $data['items'],
                'guides' => $guides,
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
