<?php

namespace App\Controllers;

use App\Models\Banner_model;
use CodeIgniter\Controller;
use Exception;

class Banner extends BaseController {

    private $bannerModel;

    public function __construct() {
        $this->bannerModel = model("Banner_model");
    }

    public function index($code_no) {
        try {
            // Lấy dữ liệu banner
            $banners = $this->bannerModel->getBanners($code_no);
            $codeBanners = $this->bannerModel->getCodeBanners($code_no);

            // Truyền dữ liệu sang view
            $data = [
                'banners' => $banners,
                'codeBanners' => $codeBanners,
                'code_no' => $code_no,
            ];

            return view('banner/index', $data);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
?>
