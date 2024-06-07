<?php

namespace App\Controllers;

use App\Models\Banner_model;
use App\Models\Product_model;
use CodeIgniter\Controller;
use Exception;

class Product extends BaseController {

    private $bannerModel;
    private $productModel;
    private $db;

    public function __construct() {
        $this->db = db_connect();
        $this->bannerModel = model("Banner_model");
        $this->productModel = model("Product_model");
    }

    public function index($code_no, $s = "1") {
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
            ];

            return view('product/index', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function view($product_idx) {

        $data['product'] = $this->productModel->getProductDetails($product_idx);

        if (!$data['product']) {
            return redirect()->to('/')->with('error', '상품이 없거나 판매중이 아닙니다.');
        }

        $data['product_level'] = $this->productModel->getProductLevel($data['product']['product_level']);
        $data['img_1'] = $this->getImage($data['product']['ufile1']);
        $data['img_2'] = $this->getImage($data['product']['ufile2']);
        $data['img_3'] = $this->getImage($data['product']['ufile3']);
        $data['img_4'] = $this->getImage($data['product']['ufile4']);
        $data['img_5'] = $this->getImage($data['product']['ufile5']);
        $data['img_6'] = $this->getImage($data['product']['ufile6']);
        
        return view('product/product_view', $data);
    }

    private function getImage($fileName) {
        if ($fileName) {
            return "/images/slider_product/" . $fileName;
        }
        return null;
    }

}
?>
