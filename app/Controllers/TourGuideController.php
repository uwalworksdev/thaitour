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
}
