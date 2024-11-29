<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminProductQnaController extends BaseController
{
    protected $connect;
    protected $productQna;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->productQna = model("ProductQna");
    }

    public function list()
    {
        try {
            return $this->response->setJSON([
                'result' => true,
                'message' => ""
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function listByProduct()
    {
        try {
            return $this->response->setJSON([
                'result' => true,
                'message' => ""
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function detail()
    {
        try {
            return $this->response->setJSON([
                'result' => true,
                'message' => ""
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function write()
    {
        try {
            return $this->response->setJSON([
                'result' => true,
                'message' => ""
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function delete()
    {
        try {
            return $this->response->setJSON([
                'result' => true,
                'message' => ""
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }
}
