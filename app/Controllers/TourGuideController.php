<?php

namespace App\Controllers;

use Config\CustomConstants as ConfigCustomConstants;

class TourGuideController extends BaseController
{
    private $db;
    private $bannerModel;
    private $productModel;
    private $codeModel;
    private $reviewModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->bannerModel = model("Banner_model");
        $this->productModel = model("ProductModel");
        $this->codeModel = model("Code");
        $this->reviewModel = model("ReviewModel");
        helper(['my_helper']);
        $constants = new ConfigCustomConstants();
    }

    public function index($code_no)
    {
        try {
            $code_no = 1325;
            $data = $this->viewData($code_no);
            $data['bannerTop'] = $this->bannerModel->getBanners($code_no, "top")[0];

            return $this->renderView('guides/index', $data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function detail($product_idx)
    {
        $data = $this->getDataDetail($product_idx, '1326');

        return $this->renderView('guides/detail', $data);
    }

    public function guideView()
    {
        return $this->renderView('guides/guides_view');
    }
    
    private function viewData($code_no)
    {
        $search_product_name = $this->request->getVar('keyword') ?? "";
        $product_code_2 = $this->request->getVar('product_code_2') ?? "";

        $products = $this->productModel->findProductPaging([
            'product_code_1' => $code_no,
            'is_view' => 'Y',
        ], 10, 1, ['onum' => 'DESC'])['items'];

        $productResults = $this->productModel->findProductPaging([
            'product_code_1' => $code_no,
            'is_view' => 'Y',
            'product_code_2' => $product_code_2,
            'search_category' => "product_name",
            'search_txt' => $search_product_name
        ], 1000, 1, ['onum' => 'DESC', 'product_idx' => 'DESC'])['items'];

        $baht_thai = $this->setting['baht_thai'];

        foreach ($productResults as $key => $product) {
            $hotel_codes = explode("|", $product['product_code_list']);
            $hotel_codes = array_values(array_filter($hotel_codes));

            $codeTree = $this->codeModel->getCodeTree($hotel_codes['0']);

            $productResults[$key]['codeTree'] = $codeTree;

            $productReview = $this->reviewModel->getProductReview($product['product_idx']);

            $productResults[$key]['total_review'] = $productReview['total_review'];
            $productResults[$key]['review_average'] = $productReview['avg'];

            $productResults[$key]['product_price_won'] = $product['product_price'] * $baht_thai;
        }

        $codes = $this->codeModel->getByParentCode($code_no)->getResultArray();

        foreach ($codes as $key => $code) {
            $sProducts = $this->productModel->findProductPaging([
                'product_code_2' => $code['code_no'],
                'is_view' => 'Y',
                'search_category' => "product_name",
                'search_txt' => $search_product_name
            ], 1000, 1)['nTotalCount'];

            $codes[$key]['count'] = $sProducts;
        }

        $data = [
            "products" => $products,
            "productResults" => $productResults,
            "search_product_name" => $search_product_name,
            "product_code_2" => $product_code_2,
            "baht_thai" => $baht_thai,
            "codes" => $codes,
        ];

        return $data;
    }

    private function getDataDetail($product_idx, $product_code)
    {
        $baht_thai = $this->setting['baht_thai'];
        $rowData = $this->productModel->find($product_idx);
        if (!$rowData) {
            throw new \Exception('존재하지 않는 상품입니다.');
        }

        $hotel_codes = explode("|", $rowData['product_code_list']);
        $hotel_codes = array_values(array_filter($hotel_codes));

        $codeTree = $this->codeModel->getCodeTree($hotel_codes['0']);

        $rowData['codeTree'] = $codeTree;

        $productReview = $this->reviewModel->getProductReview($rowData['product_idx']);

        $rowData['total_review'] = $productReview['total_review'];
        $rowData['review_average'] = $productReview['avg'];

        $product['total_review'] = $productReview['total_review'];
        $product['review_average'] = $productReview['avg'];

        $product['product_price_won'] = $product['product_price'] * $baht_thai;

        $code_utilities = $rowData['code_utilities'];
        $_arr_utilities = explode("|", $code_utilities);
        $_arr_utilities = array_filter($_arr_utilities);

        $code_services = $rowData['code_services'];
        $_arr_services = explode("|", $code_services);
        $_arr_services = array_filter($_arr_services);

        $code_best_utilities = $rowData['code_best_utilities'];
        $_arr_best_utilities = explode("|", $code_best_utilities);
        $_arr_best_utilities = array_filter($_arr_best_utilities);

        $code_populars = $rowData['code_populars'];
        $_arr_populars = explode("|", $code_populars);;
        $_arr_populars = array_filter($_arr_populars);

        $list__utilities = rtrim(implode(',', $_arr_utilities), ',');
        $list__best_utilities = rtrim(implode(',', $_arr_best_utilities), ',');
        $list__services = rtrim(implode(',', $_arr_services), ',');
        $list__populars = rtrim(implode(',', $_arr_populars), ',');

        if (!empty($list__utilities)) {
            $fsql = "SELECT * FROM tbl_code WHERE code_no IN ($list__utilities) ORDER BY onum DESC, code_idx DESC";

            $fresult4 = $this->db->query($fsql);
            $fresult4 = $fresult4->getResultArray();
        }

        if (!empty($list__best_utilities)) {
            $fsql = "SELECT * FROM tbl_code WHERE code_no IN ($list__best_utilities) ORDER BY onum DESC, code_idx DESC";
            $bresult4 = $this->db->query($fsql);
            $bresult4 = $bresult4->getResultArray();
        }

        if (!empty($list__services)) {
            $fsql = "SELECT * FROM tbl_code WHERE parent_code_no='4404' ORDER BY onum DESC, code_idx DESC";
            $fresult5 = $this->db->query($fsql);
            $fresult5 = $fresult5->getResultArray();

            $fresult5 = array_map(function ($item) use ($list__services) {
                $rs = (array)$item;

                $code_no = $rs['code_no'];
                $fsql = "SELECT * FROM tbl_code WHERE parent_code_no='$code_no' and code_no IN ($list__services) ORDER BY onum DESC, code_idx DESC";

                $rs_child = $this->db->query($fsql)->getResultArray();

                $rs['child'] = $rs_child;

                return $rs;
            }, $fresult5);
        }

        if (!empty($list__populars)) {
            $fsql = "SELECT * FROM tbl_code WHERE code_no IN ($list__populars) ORDER BY onum DESC, code_idx DESC";
            $fresult8 = $this->db->query($fsql);
            $fresult8 = $fresult8->getResultArray();
        }

        $suggestSpas = $this->getSuggestedHotels($rowData['product_idx'], $rowData['array_hotel_code'][0] ?? '', $product_code);

        $builder = $this->db->table('tbl_tours_moption');
        $builder->where('product_idx', $product_idx);
        $builder->where('use_yn', 'Y');
        $builder->orderBy('onum', 'desc');
        $query = $builder->get();
        $moption = $query->getResultArray();

        $data = [
            'data_' => $rowData,
            'suggestSpas' => $suggestSpas,
            'moption' => $moption,
            'fresult4' => $fresult4,
            'bresult4' => $bresult4,
            'fresult5' => $fresult5,
            'fresult8' => $fresult8,
            'product' => $product,
            'baht_thai' => $baht_thai,
        ];


        $data_reviews = $this->getReviewProduct($product_idx) ?? [];
        $data = array_merge($data, $data_reviews);
        $data['reviewCategories'] = $this->getReviewCategories($product_idx) ?? [];

        return $data;
    }

    private function getSuggestedHotels($currentHotelId, $currentHotelCode, $productCode1 = null)
    {
        if (!$productCode1) {
            $productCode1 = 1303;
        }
        $suggestHotels = $this->productModel
            ->where('product_idx !=', $currentHotelId)
            ->where('product_code_1', $productCode1)
            ->limit(10)
            ->get()
            ->getResultArray();

        return array_map(function ($hotel) use ($currentHotelCode) {
            $hotel['array_hotel_code'] = $this->explodeAndTrim($hotel['product_code'], '|');
            $hotel['array_goods_code'] = $this->explodeAndTrim($hotel['product_code'], ',');

            $hotel['array_hotel_code_name'] = $this->getHotelCodeNames($hotel['array_hotel_code']);

            list($totalReview, $reviewAverage) = $this->getReviewSummary($hotel['product_idx'], $currentHotelCode);
            $hotel['total_review'] = $totalReview;
            $hotel['review_average'] = $reviewAverage;

            $hotel['product_price_won'] = $hotel['product_price'] * $this->setting['baht_thai'];

            return $hotel;
        }, $suggestHotels);
    }

    private function getReviewSummary($product_idx, $code)
    {
        $sql = "SELECT number_stars FROM tbl_travel_review WHERE product_idx = ?";
        $reviews = $this->db->query($sql, [$product_idx])->getResultArray();

        $totalReview = count($reviews);

        if ($totalReview === 0) {
            return [0, 0];
        }

        $total = 0;
        foreach ($reviews as $review) {
            $total += (int)$review['number_stars'];
        }

        $reviewAverage = $total / $totalReview;

        return [$totalReview, round($reviewAverage, 1)];
    }


    private function getHotelCodeNames(array $hotelCodes)
    {
        if (empty($hotelCodes)) {
            return [];
        }

        $list = implode(',', $hotelCodes);

        $sql = "SELECT code_no, code_name FROM tbl_code WHERE code_no IN (?)";
        $items = $this->db->query($sql, [$list])->getResultArray();

        $hotelCodeNames = [];
        foreach ($items as $item) {
            if (!empty($item['code_name'])) {
                $hotelCodeNames[] = $item['code_name'];
            }
        }

        return $hotelCodeNames;
    }

    private function explodeAndTrim($string, $delimiter)
    {
        return array_filter(array_map('trim', explode($delimiter, $string)));
    }

    private function getReviewProduct($idx)
    {
        $sql = "SELECT a.*, b.ufile1 as avt
                    FROM tbl_travel_review a 
                    INNER JOIN tbl_member b ON a.user_id = b.m_idx 
                    WHERE a.product_idx = " . $idx . " AND a.is_best = 'Y' ORDER BY a.onum DESC, a.idx DESC";

        $reviews = $this->db->query($sql) or die($this->db->error);
        $reviewCount = $reviews->getNumRows();
        $reviews = $reviews->getResultArray();
        return ['reviews' => $reviews, 'reviewCount' => $reviewCount];
    }

    private function getReviewCategories($idx)
    {
        $sql = "SELECT * FROM tbl_code WHERE parent_code_no=42 ORDER BY onum ";
        $reviewCategories = $this->db->query($sql) or die($this->db->error);
        $reviewCategories = $reviewCategories->getResultArray();

        $reviewCategories = array_map(function ($item) use ($idx) {
            $reviewCategory = (array)$item;

            $sql = "SELECT * FROM tbl_travel_review WHERE product_idx = " . $this->db->escape($idx) .
                " AND review_type LIKE '%" . $this->db->escapeLikeString($item['code_no']) . "%'";
            $results = $this->db->query($sql);
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
}
