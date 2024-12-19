<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Code;
use App\Models\Guides;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;

class AdminGuideController extends BaseController
{
    protected $connect;
    protected $guideModel;
    protected $productModel;
    protected $codeModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->guideModel = new Guides();
        $this->productModel = new ProductModel();
        $this->codeModel = new Code();
    }

    public function list()
    {
        try {
            $g_list_rows = 10;
            $pg = updateSQ($_GET["pg"] ?? '');
            $search_name = updateSQ($_GET["search_name"] ?? '');

            $data = $this->guideModel->getListPaging([], $g_list_rows, $pg, []);

            $res = [
                'guides' => $data['items'],
                'search_name' => $search_name,
            ];

            $res = array_merge($data, $res);
            return view('admin/_guides/list', $res);

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
            $product_code = $this->productModel->createProductCode("G");

            $g_idx = $this->request->getVar('guide_idx');
            $guide = $this->guideModel->selectById($g_idx);

            $fresult = $this->codeModel->getByCodeNos(["1324"]);

            if ($g_idx && $guide['product_code']) {
                $product_code = $guide['product_code'];
            }

            $data = [
                'guide_idx' => $g_idx,
                'fresult' => $fresult,
                'guide' => $guide,
                'product_code' => $product_code,
            ];
            return view('admin/_guides/write', $data);

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

    public function write_ok()
    {
        try {
            $g_idx = $this->request->getPost('guide_idx');
            $files = $this->request->getFiles();

            $fields = [
                'guide_name', 'special_name', 'slogan', 'age', 'exp', 'language',
                'product_code', 'product_code_1', 'product_code_2', 'product_code_3',
                'guide_description', 'phone', 'email', 'status', 'onum', 'product_code_list',
            ];
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = updateSQ($this->request->getPost($field) ?? '');
            }

            if ($g_idx) {
                $data['updated_at'] = date('Y-m-d H:i:s');
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
            }

            for ($i = 1; $i <= 6; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;
                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $fileName = $file->getName();
                    $fileNewName = $file->getRandomName();
                    $publicPath = ROOTPATH . 'public/uploads/guides';
                    $file->move($publicPath, $fileNewName);
                    $data["rfile" . $i] = $fileName;
                    $data["ufile" . $i] = $fileNewName;
                }
            }

            if ($g_idx) {
                $message = '수정되었습니다.';
                $this->guideModel->updateData($g_idx, $data);
            } else {
                $message = '성공적으로 생성되었습니다.';
                $this->guideModel->insertData($data);
                $g_idx = $this->guideModel->getInsertID();
            }

            $guide = $this->guideModel->selectById($g_idx);

            if (!$guide['product_code']) {
                $product_code = $this->productModel->createProductCode("G");
                $newData = [
                    "product_code" => $product_code
                ];

                $this->guideModel->updateData($g_idx, $newData);
            }

            $res = [
                'guide' => $guide,
            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $message,
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

    public function change()
    {
        try {
            $g_idx = $this->request->getPost('guide_idx');
            $status = $this->request->getPost('status');
            $onum = $this->request->getPost('onum');

            $len = count($g_idx);
            for ($i = 0; $i < $len; $i++) {
                $data = [
                    'status' => $status[$i],
                    'onum' => $onum[$i],
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->guideModel->updateData($g_idx[$i], $data);
            }

            $res = [];

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

    public function delete()
    {
        try {
            $g_idx = $this->request->getPost('guide_idx');

            $data = [
                'status' => 'D',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->guideModel->updateData($g_idx, $data);
            $guide = $this->guideModel->selectById($g_idx);
            $res = [
                'guide' => $guide,
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
