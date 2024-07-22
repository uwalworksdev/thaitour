<?php

namespace App\Controllers;

use App\Models\Banner_model;
use App\Models\Bbs_list_model;
use App\Models\Product_model;
use CodeIgniter\Controller;
use App\Config\CustomConstants;
use Config\CustomConstants as ConfigCustomConstants;
use Exception;

class Product extends BaseController
{
    private $bannerModel;
    private $productModel;
    private $bbsListModel;
    private $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->bannerModel = model("Banner_model");
        $this->productModel = model("Product_model");
        $this->bbsListModel = model("Bbs_list_model");
        helper('my_helper');
        $constants = new ConfigCustomConstants();
    }


    public function showTicket()
    {
        try {
            $data = [
                'tab_active' => '5',
            ];
            return view('product/show-ticket', $data);
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function index($code_no)
    {
        try {
            $s = $this->request->getVar('s') ? $this->request->getVar('s') : 1;
            $perPage = 5;

            $banners = $this->bannerModel->getBanners($code_no);
            $codeBanners = $this->bannerModel->getCodeBanners($code_no);

            $suggestedProducts = $this->productModel->getSuggestedProducts($code_no);

            $products = $this->productModel->getProducts($code_no, $s, $perPage);

            $totalProducts = $this->productModel->where($this->productModel->getCodeColumn($code_no), $code_no)->where('is_view', 'Y')->countAllResults();

            $pager = \Config\Services::pager();

            $code_name = $this->db->table('tbl_code')
                ->select('code_name')
                ->where('code_gubun', 'tour')
                ->where('code_no', $code_no)
                ->get()
                ->getRow()
                ->code_name;

            if (strlen($code_no) == 4) {
                $codes = $this->db->table('tbl_code')
                    ->where('parent_code_no', $code_no)
                    ->get()
                    ->getResult();
            } else {
                $codes = $this->db->table('tbl_code')
                    ->where('code_gubun', 'tour')
                    ->where('parent_code_no', substr($code_no, 0, 6))
                    ->orderBy('onum', 'DESC')
                    ->get()
                    ->getResult();
            }

            $data = [
                'banners' => $banners,
                'codeBanners' => $codeBanners,
                'suggestedProducts' => $suggestedProducts,
                'products' => $products,
                'code_no' => $code_no,
                's' => $s,
                'codes' => $codes,
                'code_name' => $code_name,
                'pager' => $pager,
                'perPage' => $perPage,
                'totalProducts' => $totalProducts,
                'tab_active' => '3',
            ];

            return view('product/index', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function indexHotel($code_no)
    {
        try {
            $s = $this->request->getVar('s') ? $this->request->getVar('s') : 1;
            $perPage = 5;

            $banners = $this->bannerModel->getBanners($code_no);
            $codeBanners = $this->bannerModel->getCodeBanners($code_no);

            $suggestedProducts = $this->productModel->getSuggestedProducts($code_no);

            $products = $this->productModel->getProducts($code_no, $s, $perPage);

            $totalProducts = $this->productModel->where($this->productModel->getCodeColumn($code_no), $code_no)->where('is_view', 'Y')->countAllResults();

            $pager = \Config\Services::pager();

            $code_name = $this->db->table('tbl_code')
                ->select('code_name')
                ->where('code_gubun', 'tour')
                ->where('code_no', $code_no)
                ->get()
                ->getRow()
                ->code_name;

            if (strlen($code_no) == 4) {
                $codes = $this->db->table('tbl_code')
                    ->where('parent_code_no', $code_no)
                    ->get()
                    ->getResult();
            } else {
                $codes = $this->db->table('tbl_code')
                    ->where('code_gubun', 'tour')
                    ->where('parent_code_no', substr($code_no, 0, 6))
                    ->orderBy('onum', 'DESC')
                    ->get()
                    ->getResult();
            }

            $data = [
                'banners' => $banners,
                'codeBanners' => $codeBanners,
                'suggestedProducts' => $suggestedProducts,
                'products' => $products,
                'code_no' => $code_no,
                's' => $s,
                'codes' => $codes,
                'code_name' => $code_name,
                'pager' => $pager,
                'perPage' => $perPage,
                'totalProducts' => $totalProducts,
                'tab_active' => '1',
            ];

            return view('product/product-hotel', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index2($code_no, $s = "1")
    {
        try {
            $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
            $perPage = 16;

            $banners = $this->bannerModel->getBanners($code_no);
            $codeBanners = $this->bannerModel->getCodeBanners($code_no);

            $suggestedProducts = $this->productModel->getSuggestedProducts($code_no);

            $products = $this->productModel->getProducts($code_no, $s, $perPage, $page);

            $totalProducts = $this->productModel->where($this->productModel->getCodeColumn($code_no), $code_no)->where('is_view', 'Y')->countAllResults();

            $pager = \Config\Services::pager();

            $code_name = $this->db->table('tbl_code')
                ->select('code_name')
                ->where('code_gubun', 'tour')
                ->where('code_no', $code_no)
                ->get()
                ->getRow()
                ->code_name;

            if (strlen($code_no) == 4) {
                $codes = $this->db->table('tbl_code')
                    ->where('parent_code_no', $code_no)
                    ->get()
                    ->getResult();
            } else {
                $codes = $this->db->table('tbl_code')
                    ->where('code_gubun', 'tour')
                    ->where('parent_code_no', substr($code_no, 0, 6))
                    ->orderBy('onum', 'DESC')
                    ->get()
                    ->getResult();
            }

            // Truyền dữ liệu sang view
            $data = [
                'banners' => $banners,
                'codeBanners' => $codeBanners,
                'suggestedProducts' => $suggestedProducts,
                'products' => $products,
                'code_no' => $code_no,
                's' => $s,
                'codes' => $codes,
                'code_name' => $code_name,
                'pager' => $pager,
                'page' => $page,
                'perPage' => $perPage,
                'totalProducts' => $totalProducts,
                'tab_active' => '2',
            ];

            return view('product/product-golf', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index3($code_no, $s = "1")
    {
        try {
            $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
            $perPage = 10;
            $perCnt = $perPage;
            $banners = $this->bannerModel->getBanners($code_no);
            $lineBanners = $this->bbsListModel->getLineBanners('123');
            $codeBanners = $this->bannerModel->getCodeBanners($code_no);

            $suggestedProducts = $this->productModel->getSuggestedProducts($code_no);
            $suggestedProducts2 = $this->productModel->getSuggestedProducts('232802');

            $products = $this->productModel->getProducts($code_no, $s, $perPage, $page);

            $totalProducts = $this->productModel->where($this->productModel->getCodeColumn($code_no), $code_no)
                ->where('is_view', 'Y')
                ->countAllResults();

            $pager = \Config\Services::pager();

            $code_name = $this->db->table('tbl_code')
                ->select('code_name')
                ->where('code_gubun', 'tour')
                ->where('code_no', $code_no)
                ->get()
                ->getRow()
                ->code_name;

            if (strlen($code_no) == 4) {
                $codes = $this->db->table('tbl_code')
                    ->where('parent_code_no', $code_no)
                    ->get()
                    ->getResult();
            } else {
                $codes = $this->db->table('tbl_code')
                    ->where('code_gubun', 'tour')
                    ->where('parent_code_no', substr($code_no, 0, 6))
                    ->orderBy('onum', 'DESC')
                    ->get()
                    ->getResult();
            }

            // Dữ liệu cho sub_visual
            $len = strlen($code_no);
            $code_name1 = $code_name2 = $code_name3 = '';

            if ($len == 8) {
                $code_1 = substr($code_no, 0, 4);
                $code_2 = substr($code_no, 0, 6);
                $code_3 = $code_no;
            } elseif ($len == 6) {
                $code_1 = substr($code_no, 0, 4);
                $code_2 = $code_no;
            } else {
                $code_1 = $code_no;
            }

            $result1 = $this->productModel->getCodeName($code_1);
            $code_name1 = $result1 ? $result1['code_name'] : '';

            if (isset($code_2)) {
                $result2 = $this->productModel->getCodeName($code_2);
                $code_name2 = $result2 ? ', ' . $result2['code_name'] : '';
            }

            if (isset($code_3)) {
                $result3 = $this->productModel->getCodeName($code_3);
                $code_name3 = $result3 ? ', ' . $result3['code_name'] : '';
            }

            $sub_banners = $this->bannerModel->getBanners('1317');

            // Xử lý biến yoil cho mỗi sản phẩm
            foreach ($products as &$product) {
                $product['yoil_values'] = explode('|', $product['yoil_0'] . "|" . $product['yoil_1'] . "|" . $product['yoil_2'] . "|" . $product['yoil_3'] . "|" . $product['yoil_4'] . "|" . $product['yoil_5'] . "|" . $product['yoil_6']);
            }

            // Get codes for day tour section
            $dayTourCodes = $this->productModel->getCodes('2329');
            $suggest_code = $this->request->getVar('suggest_code') ?: $dayTourCodes[0]['code_no'];
            $dayTourProducts = $this->productModel->getProductsByCode([$suggest_code], $perPage);
            $totalDayTourProducts = $this->productModel->getTotalProducts([$suggest_code]);

            $data = [
                'banners' => $banners,
                'codeBanners' => $codeBanners,
                'suggestedProducts' => $suggestedProducts,
                'suggestedProducts2' => $suggestedProducts2,
                'products' => $products,
                'code_no' => $code_no,
                'lineBanners' => $lineBanners,
                's' => $s,
                'codes' => $codes,
                'code_name' => $code_name,
                'pager' => $pager,
                'page' => $page,
                'perPage' => $perPage,
                'totalProducts' => $totalProducts,
                'sub_banners' => $sub_banners,
                'code_name1' => $code_name1,
                'code_name2' => $code_name2,
                'code_name3' => $code_name3,
                'dayTourCodes' => $dayTourCodes,
                'dayTourProducts' => $dayTourProducts,
                'totalDayTourProducts' => $totalDayTourProducts,
                'suggest_code' => $suggest_code,
                'perCnt' => $perCnt,
                'tab_active' => '6',
            ];

            return view('product/product-tours', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index4($code_no, $s = "1")
    {
        try {
            $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
            $perPage = 5;

            $banners = $this->bannerModel->getBanners($code_no);
            $codeBanners = $this->bannerModel->getCodeBanners($code_no);

            $suggestedProducts = $this->productModel->getSuggestedProducts($code_no);

            $products = $this->productModel->getProducts($code_no, $s, $perPage, $page);

            $totalProducts = $this->productModel->where($this->productModel->getCodeColumn($code_no), $code_no)->where('is_view', 'Y')->countAllResults();

            $pager = \Config\Services::pager();

            $code_name = $this->db->table('tbl_code')
                ->select('code_name')
                ->where('code_gubun', 'tour')
                ->where('code_no', $code_no)
                ->get()
                ->getRow()
                ->code_name;

            if (strlen($code_no) == 4) {
                $codes = $this->db->table('tbl_code')
                    ->where('parent_code_no', $code_no)
                    ->get()
                    ->getResult();
            } else {
                $codes = $this->db->table('tbl_code')
                    ->where('code_gubun', 'tour')
                    ->where('parent_code_no', substr($code_no, 0, 6))
                    ->orderBy('onum', 'DESC')
                    ->get()
                    ->getResult();
            }

            // Truyền dữ liệu sang view
            $data = [
                'banners' => $banners,
                'codeBanners' => $codeBanners,
                'suggestedProducts' => $suggestedProducts,
                'products' => $products,
                'code_no' => $code_no,
                's' => $s,
                'codes' => $codes,
                'code_name' => $code_name,
                'pager' => $pager,
                'page' => $page,
                'perPage' => $perPage,
                'totalProducts' => $totalProducts,
                'tab_active' => '4',
            ];

            return view('product/product-spa', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function vehicleGuide()
    {
        try {
            $data = [
                'tab_active' => '7',
            ];

            return view('product/vehicle-guide', $data);
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function view($product_idx)
    {
        // Lấy các chi tiết sản phẩm hiện tại
        $data['product'] = $this->productModel->getProductDetails($product_idx);

        if (!$data['product']) {
            return redirect()->to('/')->with('error', '상품이 없거나 판매중이 아닙니다.');
        }

        // Bổ sung đoạn mã mới
        $start_date_in = $this->request->getVar('start_date_in') ?: date("Y-m-d");
        $product_info = $this->productModel->get_product_info($product_idx, $start_date_in);
        $air_info = $this->productModel->get_air_info($product_idx, $start_date_in);
        $day_details = $this->productModel->getDayDetails($product_idx); // Lấy dữ liệu từ tbl_product_day_detail

        // Tính giá trị min_amt
        $min_amt = $this->calculateMinAmt($air_info);

        // Lấy ngày bắt đầu (_start_dd)
        $_start_dd = date('d', strtotime($start_date_in));

        // Lấy giá trị tour_price và các biến liên quan từ $air_info
        $tour_price = $air_info[0]['tour_price'] ?? 0; // Nếu không có giá trị, đặt mặc định là 0
        $oil_price = $air_info[0]['oil_price'] ?? 0;
        $tour_price_kids = $air_info[0]['tour_price_kids'] ?? 0;
        $tour_price_baby = $air_info[0]['tour_price_baby'] ?? 0;

        // Chuẩn bị giá trị sel_date và sel_price
        $seq = time();
        $sDate = date('Y-m-01');
        $today = date('Y-m-d');
        $priceData = $this->productModel->getPriceData($seq, $product_idx, $sDate);
        $first_date = $this->productModel->getFirstDate($seq, $product_idx, $today);
        $this->productModel->deletePriceVal($seq);

        $sel_date = '';
        $sel_price = '';
        foreach ($priceData as $row) {
            $cal_amt = $row['price'] / 10000;
            $sel_date .= $row['get_date'] . "|";
            $sel_price .= $cal_amt . "|";
        }

        // Debug các giá trị
        // echo "sel_date: " . $sel_date . "===========";
        // echo "sel_price: " . $sel_price . "===========";
        // echo "first_date: " . ($first_date['get_date'] ?? '') . "===========";

        // Thêm vào mảng dữ liệu
        $data['start_date_in'] = $start_date_in;
        $data['product_info'] = $product_info;
        $data['air_info'] = $air_info;
        $data['min_amt'] = $min_amt;
        $data['_start_dd'] = $_start_dd;
        $data['tour_price'] = $tour_price;
        $data['oil_price'] = $oil_price;
        $data['tour_price_kids'] = $tour_price_kids;
        $data['tour_price_baby'] = $tour_price_baby;
        $data['product_idx'] = $product_idx;
        $data['product_confirm'] = $data['product']['product_confirm'];
        $data['product_able'] = $data['product']['product_able'];
        $data['product_unable'] = $data['product']['product_unable'];
        $data['tour_info'] = $data['product']['tour_info'];
        $data['special_benefit'] = $data['product']['special_benefit'];
        $data['day_details'] = $day_details; // Truyền dữ liệu từ tbl_product_day_detail sang view
        $data['sel_date'] = $sel_date;
        $data['sel_price'] = $sel_price;
        $data['first_date'] = $first_date['get_date'] ?? '';

        // if (!$data['product_info']) {
        //     return redirect()->to('/')->with('error', '상품이 없거나 판매중이 아닙니다.');
        // }

        // Tiếp tục với các chi tiết sản phẩm hiện tại
        $data['product_level'] = $this->productModel->getProductLevel($data['product']['product_level']);
        $data['img_1'] = $this->getImage($data['product']['ufile1']);
        $data['img_2'] = $this->getImage($data['product']['ufile2']);
        $data['img_3'] = $this->getImage($data['product']['ufile3']);
        $data['img_4'] = $this->getImage($data['product']['ufile4']);
        $data['img_5'] = $this->getImage($data['product']['ufile5']);
        $data['img_6'] = $this->getImage($data['product']['ufile6']);

        return view('product/product_view', $data);
    }


    private function calculateMinAmt($air_info)
    {
        $min_amt = 9999999999;
        foreach ($air_info as $info) {
            $tour_price = $info['tour_price'] / 10000;
            if ($tour_price < $min_amt && $tour_price > 0) {
                $min_amt = $tour_price;
            }
        }
        return $min_amt;
    }

    private function getImage($file)
    {
        // return base_url("images/{$file}");
        return "https://hihojoonew.cafe24.com/data/product/thum_798_463/{$file}";
    }
}

?>