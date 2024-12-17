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
        $guides = $this->guideModel->getList();
        $data = [
            'guides' => $guides,
        ];
        return view('admin/_tourGuides/list', $data);
    }

    public function write()
    {
        $g_idx = $this->request->getVar('guide_idx');
        $guide = $this->guideModel->selectById($g_idx);
        $data = [
            'guide' => $guide,
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
            $g_idx = $this->request->getPost('guide_idx');

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
}
