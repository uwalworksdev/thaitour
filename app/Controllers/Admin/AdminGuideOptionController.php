<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuideOptions;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;

class AdminGuideOptionController extends BaseController
{
    protected $connect;
    protected $guideOptionModel;
    protected $productModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->guideOptionModel = new GuideOptions();
        $this->productModel = new ProductModel();
    }

    public function list()
    {
        try {
            $product_idx = $this->request->getVar('product_idx');
            $options = $this->guideOptionModel->getListByProductId($product_idx);
            $product = $this->productModel->getById($product_idx);

            $res = [
                "product" => $product,
                "options" => $options,
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

    public function detail()
    {
        try {
            $o_idx = $this->request->getPost('o_idx');
            $option = $this->guideOptionModel->getById($o_idx);

            $res = [
                "option" => $option,
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

    public function write()
    {
        try {
            $o_idx = $this->request->getPost('o_idx');
            $product_idx = $this->request->getPost('product_idx');

            $fields = [
                'o_idx', 'o_name', 'o_price', 'o_sale_price', 'o_people_cnt', 'o_availability', 'o_onum',
            ];
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = updateSQ($this->request->getPost($field)) ?? '';
            }

            if ($o_idx) {
                $data['m_date'] = date('Y-m-d H:i:s');
                $this->guideOptionModel->updateData($o_idx, $data);
            } else {
                $data['r_date'] = date('Y-m-d H:i:s');
                $data['product_idx'] = $product_idx;
                $this->guideOptionModel->insertData($data);
                $o_idx = $this->guideOptionModel->getInsertID();
            }

            $option = $this->guideOptionModel->getById($o_idx);

            $res = [
                "option" => $option,
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
            $o_idx = $this->request->getPost('o_idx');
            $this->guideOptionModel->deleteData($o_idx);

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => ''
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
