<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Guides;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;

class AdminTourGuideController extends BaseController
{
    protected $connect;
    protected $guideModel;
    protected $productModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->guideModel = new Guides();
        $this->productModel = new ProductModel();
    }

    public function list()
    {
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');

        $data = $this->productModel->findProductPaging([], $g_list_rows, $pg, ['onum' => 'desc']);

        $res = [
            'products' => $data['items'],
            'search_name' => $search_name,
        ];

        $res = array_merge($data, $res);

        return view('admin/_tourGuides/list', $res);
    }

    public function write()
    {
        $product_idx = $this->request->getVar('product_idx');
        $product = $this->productModel->getById($product_idx);
        $data = [
            'product' => $product,
        ];
        return view('admin/_tourGuides/write', $data);
    }

    public function write_ok()
    {
        try {

            $res = [

            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $res
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

    public function delete()
    {
        try {
            $product_idx = $this->request->getPost('product_idx');

            $data = [
                'status' => 'D',
                'm_date' => date('Y-m-d H:i:s')
            ];

            $this->productModel->updateData($product_idx, $data);
            $product = $this->productModel->getById($product_idx);
            $res = [
                'product' => $product,
            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => '삭제되었습니다.',
                    'data' => $res
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
}
