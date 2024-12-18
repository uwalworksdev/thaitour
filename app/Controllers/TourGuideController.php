<?php

namespace App\Controllers;

use App\Models\Code;
use App\Models\GuideOptions;
use App\Models\Guides;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;

class TourGuideController extends BaseController
{
    protected $connect;
    protected $guideModel;
    protected $productModel;
    protected $codeModel;
    protected $guideOptionModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->guideModel = new Guides();
        $this->productModel = new ProductModel();
        $this->codeModel = new Code();
        $this->guideOptionModel = new GuideOptions();
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
            return $this->renderView('guides/guides_view');

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
}
