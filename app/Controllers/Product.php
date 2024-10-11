<?php

namespace App\Controllers;

use App\Models\Banner_model;
use App\Models\Product_model;
use CodeIgniter\Controller;
use App\Config\CustomConstants;
use Config\CustomConstants as ConfigCustomConstants;
use Exception;
use http\Client\Request;
use App\Models\Hotel;

class Product extends BaseController
{
    private $bannerModel;
    private $productModel;
    private $bbsListModel;
    private $db;
    private $hotel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->bannerModel = model("Banner_model");
        $this->productModel = model("Product_model");
        $this->hotel = model(Hotel::class);
        $this->bbsListModel = model("Bbs");
        helper('my_helper');
        $constants = new ConfigCustomConstants();
    }

    public function showTicket()
    {
        try {
            $data = [
                'tab_active' => '5',
            ];
            return $this->renderView('product/show-ticket', $data);
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

            return $this->renderView('product/product-tours', $data);

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

            $products = $this->db->query("SELECT * FROM tbl_hotel WHERE item_state != 'dele' ORDER BY onum DESC")->getResultArray();

            $products = array_map(function ($item) use ($code_no) {
                $product = (array)$item;
                $g_idx = $product['g_idx'];
                ##############################################
                $goods_code = $product['goods_code'];
                $goods_code = explode(",", $goods_code);
                ##############################################
                $hotel_code = $product['product_code'];
//                $hotel_code = trim('|', $hotel_code);
                $hotel_code = explode("|", $hotel_code);
                ##############################################
                $product['array_hotel_code'] = $hotel_code;
                $product['array_goods_code'] = $goods_code;
                ##############################################
                $hotel_code_name = [];
                foreach ($hotel_code as $code) {
                    $item = $this->db->query("SELECT * FROM tbl_code WHERE code_no = '$code'")->getRowArray();

                    if ($item && $item['code_name'] !== '') {
                        $hotel_code_name[] = $item['code_name'];
                    }
                }
                $product['array_hotel_code_name'] = $hotel_code_name;
                ##############################################
                $sql = "SELECT * FROM tbl_travel_review WHERE travel_type = ? AND product_idx = ?";
                $reviews = $this->db->query($sql, [$code_no, $g_idx])->getResultArray();
                $total_review = count($reviews);
                if ($total_review > 0) {
                    $review_average = 0;
                    foreach ($reviews as $itemReview) {
                        $review_average += $itemReview['number_stars'];
                    }
                    $review_average /= $total_review;
                    $review_average = round($review_average, 1);
                } else {
                    $review_average = 0;
                }

                $product['total_review'] = $total_review;
                $product['review_average'] = $review_average;

                return $product;
            }, $products);

            $totalProducts = count($products);

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

            $sql = 'SELECT * FROM tbl_code WHERE parent_code_no = 1303 ORDER BY onum DESC, code_idx DESC';
            $sub_codes = $this->db->query($sql);

            $sub_codes = $sub_codes->getResultArray();

            $theme_products = $this->db->query("SELECT * FROM tbl_hotel WHERE item_state != 'dele' AND goods_dis4 = 'Y' ORDER BY onum DESC")->getResultArray();

            $data = [
                'banners' => $banners,
                'codeBanners' => $codeBanners,
                'theme_products' => $theme_products,
                'products' => $products,
                'code_no' => $code_no,
                'sub_codes' => $sub_codes,
                's' => $s,
                'codes' => $codes,
                'code_name' => $code_name,
                'pager' => $pager,
                'perPage' => $perPage,
                'totalProducts' => $totalProducts,
                'tab_active' => '1',
            ];

            return $this->renderView('product/product-hotel', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function indexResult($code_no)
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
            ];

            return $this->renderView('product/product-result', $data);

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
                'categories' => [],
            ];

            return $this->renderView('product/product-golf', $data);

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

            return $this->renderView('product/product-list', $data);

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

            return $this->renderView('product/product-spa', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function listHotel($code_no)
    {
        try {
            $s = $this->request->getVar('s') ? $this->request->getVar('s') : 1;
            $perPage = 5;

            $banners = $this->bannerModel->getBanners($code_no);
            $codeBanners = $this->bannerModel->getCodeBanners($code_no);

            $products = $this->db->query("SELECT * FROM tbl_hotel WHERE item_state != 'dele' ORDER BY onum DESC")->getResultArray();

            $products = array_map(function ($item) use ($code_no) {
                $product = (array)$item;
                $g_idx = $product['g_idx'];
                ##############################################
                $goods_code = $product['goods_code'];
                $goods_code = explode(",", $goods_code);
                ##############################################
                $hotel_code = $product['product_code'];
//                $hotel_code = trim('|', $hotel_code);
                $hotel_code = explode("|", $hotel_code);
                ##############################################
                $product['array_hotel_code'] = $hotel_code;
                $product['array_goods_code'] = $goods_code;
                ##############################################
                $hotel_code_name = [];
                foreach ($hotel_code as $code) {
                    $item = $this->db->query("SELECT * FROM tbl_code WHERE code_no = '$code'")->getRowArray();

                    if ($item && $item['code_name'] !== '') {
                        $hotel_code_name[] = $item['code_name'];
                    }
                }
                $product['array_hotel_code_name'] = $hotel_code_name;
                ##############################################
                $sql = "SELECT * FROM tbl_travel_review WHERE travel_type = ? AND product_idx = ?";
                $reviews = $this->db->query($sql, [$code_no, $g_idx])->getResultArray();
                $total_review = count($reviews);
                if ($total_review > 0) {
                    $review_average = 0;
                    foreach ($reviews as $itemReview) {
                        $review_average += $itemReview['number_stars'];
                    }
                    $review_average /= $total_review;
                    $review_average = round($review_average, 1);
                } else {
                    $review_average = 0;
                }

                $product['total_review'] = $total_review;
                $product['review_average'] = $review_average;

                return $product;
            }, $products);

            $totalProducts = count($products);
            $pager = \Config\Services::pager();

            $theme_products = $this->db->query("SELECT * FROM tbl_hotel WHERE item_state != 'dele' AND goods_dis4 = 'Y' ORDER BY onum DESC")->getResultArray();

            $data = [
                'banners' => $banners,
                'codeBanners' => $codeBanners,
                'products' => $products,
                'theme_products' => $theme_products,
                'code_no' => $code_no,
                's' => $s,
                'pager' => $pager,
                'perPage' => $perPage,
                'totalProducts' => $totalProducts,
                'tab_active' => '1',
            ];

            return $this->renderView('product/hotel/list-hotel', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function hotelDetail($idx)
    {
        try {
            $s_category_room = $_GET['s_category_room'] ?? '';
            $subSql = '';

            if (isset($s_category_room) && $s_category_room !== '') {
                $subSql .= " AND r.category LIKE '%" . $s_category_room . "|%'";
            }

            $hotel = $this->db->query('SELECT * FROM tbl_hotel WHERE g_idx = ?', [$idx])->getRowArray();
            if (!$hotel) {
                throw new Exception('존재하지 않는 상품입니다.');
            }

            $hotel['array_hotel_code'] = $this->explodeAndTrim($hotel['product_code'], '|');
            $hotel['array_goods_code'] = $this->explodeAndTrim($hotel['goods_code'], ',');

            $hotel['array_hotel_code_name'] = $this->getHotelCodeNames($hotel['array_hotel_code']);

            list($totalReview, $reviewAverage) = $this->getReviewSummary($hotel['g_idx'], $hotel['array_hotel_code'][0] ?? '');
            $hotel['total_review'] = $totalReview;
            $hotel['review_average'] = $reviewAverage;

            $suggestHotels = $this->getSuggestedHotels($hotel['g_idx'], $hotel['array_hotel_code'][0] ?? '');

            $fsql = 'SELECT * FROM tbl_hotel_option WHERE goods_code = ? and o_room != 0 ORDER BY idx DESC';
            $hotel_options = $this->db->query($fsql, [$hotel['goods_code']])->getResultArray();
            $_arr_utilities = $_arr_best_utilities = $_arr_services = $_arr_populars = [];
            if (count($hotel_options) > 0) {
                $hotel_option = $hotel_options[0];
                $room_idx = $hotel_option['o_room'];

                $rsql = "SELECT * FROM tbl_product_stay WHERE room_list LIKE '%" . $this->db->escapeLikeString($room_idx) . "|%'";
                $stay_hotel = $this->db->query($rsql)->getRowArray();

                if ($stay_hotel) {
                    $code_utilities = $stay_hotel['code_utilities'];
                    $_arr_utilities = explode("|", $code_utilities);

                    $code_services = $stay_hotel['code_services'];
                    $_arr_services = explode("|", $code_services);

                    $code_best_utilities = $stay_hotel['code_best_utilities'];
                    $_arr_best_utilities = explode("|", $code_best_utilities);

                    $code_populars = $stay_hotel['code_populars'];
                    $_arr_populars = explode("|", $code_populars);;
                }
            }

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
                $fsql = "SELECT * FROM tbl_code WHERE parent_code_no='34' ORDER BY onum DESC, code_idx DESC";
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

            /* get options */
//            $sql = "SELECT * FROM tbl_hotel_option o WHERE o.goods_code = " . $hotel['goods_code'] . " and o.o_room != 0
//                        JOIN tbl_room r ON r.g_idx = o.o_room ORDER BY o.idx DESC";

//            $sql = "SELECT * FROM tbl_code WHERE code_gubun = 'hotel_cate' and parent_code_no = 36 ORDER BY onum DESC, code_idx DESC";
//            $room_categories = $this->db->query($sql)->getResultArray();
//
//            $room_categories_convert = [];
//            foreach ($room_categories as $category) {
//                $sql_count = "SELECT * FROM tbl_room WHERE category LIKE '%" . $this->db->escapeLikeString($category['code_no']) . "|%'";
//                $count = $this->db->query($sql_count)->getNumRows();
//                $category['count'] = $count;
//                $room_categories_convert[] = $category;
//            }
            $categories = '';

            $sql = "SELECT * 
                    FROM tbl_hotel_option o
                    JOIN tbl_room r ON r.g_idx = o.o_room
                    WHERE o.goods_code = " . $hotel['goods_code'] . " 
                    AND o.o_room != 0 
                    ORDER BY o.idx DESC";

            $hotel_options = $this->db->query($sql)->getResultArray();

            $hotel_option_convert = [];

            $list__gix = "";
            foreach ($hotel_options as $option) {
                $sql_count = "SELECT * FROM tbl_room WHERE g_idx = " . $option['o_room'];

                $room = $this->db->query($sql_count)->getRowArray();

                $list__gix .= $option['o_room'] . ',';
                $room_option = [];
                if ($room) {
                    $categories .= $room['category'];

                    $sql = "SELECT * FROM tbl_room_options WHERE h_idx = " . $idx . " AND r_idx = " . $room['g_idx'];
                    $room_option = $this->db->query($sql)->getResultArray();
                }

                $room['room_option'] = $room_option;
                $option['room'] = $room ?? '';
                $hotel_option_convert[] = $option;
            }

            $_arr_categories = explode("|", $categories);
            $_arr_categories = array_unique($_arr_categories);
            $list__categories = rtrim(implode(',', $_arr_categories), ',');

            $insql = "";
            if (count($_arr_categories) > 0 && $list__categories !== '') {
                $insql = " AND code_no IN ($list__categories)";
            }

            $_arr_gix = explode(",", $list__gix);
            $list__gix = rtrim(implode(',', $_arr_gix), ',');
            $insql2 = "";
            if (count($_arr_gix) > 0 && $list__gix !== '') {
                $insql2 = " AND g_idx IN ($list__gix)";
            }

            $sql = "SELECT * FROM tbl_code WHERE code_gubun = 'hotel_cate' and parent_code_no = 36 " . $insql . " ORDER BY onum DESC, code_idx DESC";

            $room_categories = $this->db->query($sql)->getResultArray();

            $room_categories_convert = [];
            foreach ($room_categories as $category) {
                $sql_count = "SELECT * FROM tbl_room WHERE category LIKE '%" . $this->db->escapeLikeString($category['code_no']) . "|%'" . $insql2;
                $count = $this->db->query($sql_count)->getNumRows();
                $category['count'] = $count;
                $room_categories_convert[] = $category;
            }

            $fsql = "select * from tbl_code where code_gubun='Room facil' and depth='2' order by onum desc, code_idx desc";
            $rresult = $this->db->query($fsql) or die ($this->db->error);
            $rresult = $rresult->getResultArray();

            $data = [
                'hotel' => $hotel,
                's_category_room' => $s_category_room,
                'fresult4' => $fresult4 ?? [],
                'bresult4' => $bresult4 ?? [],
                'fresult5' => $fresult5 ?? [],
                'fresult8' => $fresult8 ?? [],
                'rresult' => $rresult ?? [],
                'room_categories' => $room_categories_convert,
                'hotel_options' => $hotel_option_convert,
                'suggestHotel' => $suggestHotels,
            ];

            return $this->renderView('product/hotel/hotel-details', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index7($code_no)
    {
        return $this->renderView('product/hotel/customer-form');
    }

    public function completedOrder($code_no)
    {
        return $this->renderView('product/golf/completed-order');
    }

    public function golfList($code_no)
    {
        return $this->renderView('product/golf/list-golf');
    }

    public function golfDetail($code_no)
    {
        return $this->renderView('product/golf/golf-details');
    }

    public function customerForm($code_no)
    {
        return $this->renderView('product/golf/customer-form');
    }

    public function index8($code_no)
    {
        return $this->renderView('tours/tour-details');
    }

    public function index9($code_no)
    {
        return $this->renderView('tours/list-tour');
    }

    public function tourLocationInfo($code_no)
    {
        return $this->renderView('tours/location-info');
    }

    public function tourOrderForm($code_no)
    {
        return $this->renderView('tours/order-form');
    }

    public function vehicleGuide()
    {
        try {
            $data = [
                'tab_active' => '7',
            ];

            return $this->renderView('product/vehicle-guide', $data);
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function view($product_idx)
    {

        $data['product'] = $this->productModel->getProductDetails($product_idx);

        if (!$data['product']) {
            return redirect()->to('/')->with('error', '상품이 없거나 판매중이 아닙니다.');
        }


        $start_date_in = $this->request->getVar('start_date_in') ?: date("Y-m-d");
        $product_info = $this->productModel->get_product_info($product_idx, $start_date_in);
        $air_info = $this->productModel->get_air_info($product_idx, $start_date_in);
        $day_details = $this->productModel->getDayDetails($product_idx);


        $min_amt = $this->calculateMinAmt($air_info);


        $_start_dd = date('d', strtotime($start_date_in));


        $tour_price = $air_info[0]['tour_price'] ?? 0;
        $oil_price = $air_info[0]['oil_price'] ?? 0;
        $tour_price_kids = $air_info[0]['tour_price_kids'] ?? 0;
        $tour_price_baby = $air_info[0]['tour_price_baby'] ?? 0;


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
        $data['day_details'] = $day_details;
        $data['sel_date'] = $sel_date;
        $data['sel_price'] = $sel_price;
        $data['first_date'] = $first_date['get_date'] ?? '';


        $data['product_level'] = $this->productModel->getProductLevel($data['product']['product_level']);
        $data['img_1'] = $this->getImage($data['product']['ufile1']);
        $data['img_2'] = $this->getImage($data['product']['ufile2']);
        $data['img_3'] = $this->getImage($data['product']['ufile3']);
        $data['img_4'] = $this->getImage($data['product']['ufile4']);
        $data['img_5'] = $this->getImage($data['product']['ufile5']);
        $data['img_6'] = $this->getImage($data['product']['ufile6']);

        return $this->renderView('product/product_view', $data);
    }

    private function explodeAndTrim($string, $delimiter)
    {
        return array_filter(array_map('trim', explode($delimiter, $string)));
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

    private function getReviewSummary($g_idx, $code)
    {
        $sql = "SELECT number_stars FROM tbl_travel_review WHERE product_idx = ?";
        $reviews = $this->db->query($sql, [$g_idx])->getResultArray();

        $totalReview = count($reviews);

        if ($totalReview === 0) {
            return [0, 0];
        }

        $reviewAverage = array_sum(array_column($reviews, 'number_stars')) / $totalReview;

        return [$totalReview, round($reviewAverage, 1)];
    }

    private function getSuggestedHotels($currentHotelId, $currentHotelCode)
    {
        $suggestHotels = $this->db->table('tbl_hotel')
            ->where('item_state !=', 'dele')
            ->where('g_idx !=', $currentHotelId)
            ->get()
            ->getResultArray();

        return array_map(function ($hotel) use ($currentHotelCode) {
            $hotel['array_hotel_code'] = $this->explodeAndTrim($hotel['product_code'], '|');
            $hotel['array_goods_code'] = $this->explodeAndTrim($hotel['goods_code'], ',');

            $hotel['array_hotel_code_name'] = $this->getHotelCodeNames($hotel['array_hotel_code']);

            list($totalReview, $reviewAverage) = $this->getReviewSummary($hotel['g_idx'], $currentHotelCode);
            $hotel['total_review'] = $totalReview;
            $hotel['review_average'] = $reviewAverage;

            return $hotel;
        }, $suggestHotels);
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