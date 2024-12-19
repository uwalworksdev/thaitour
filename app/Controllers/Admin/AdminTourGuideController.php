<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Code;
use App\Models\GuideOptions;
use App\Models\Guides;
use App\Models\GuideSupOptions;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;

class AdminTourGuideController extends BaseController
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

    public function list()
    {
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');

        $data = $this->productModel->findProductPaging(['product_code_1' => '1326'], $g_list_rows, $pg, ['onum' => 'desc']);

        $res = [
            'products' => $data['items'],
            'search_name' => $search_name,
        ];

        $res = array_merge($data, $res);

        return view('admin/_tourGuides/list', $res);
    }

    public function write()
    {
        $product_code = $this->productModel->createProductCode("PG");

        $product_idx = $this->request->getVar('product_idx');
        $product = $this->productModel->getById($product_idx);

        $fresult = $this->codeModel->getByCodeNos(["1326"]);

        $options = $this->guideOptionModel->getListByProductId($product_idx);

        $options = array_map(function ($item) {
            $option = (array)$item;

            $option['sup_options'] = $this->guideSupOptionModel->getListByOptionId($item['o_idx']);

            return $option;
        }, $options);


        if ($product_idx && $product['product_code']) {
            $product_code = $product['product_code'];
        }

        $data = [
            'product' => $product,
            'fresult' => $fresult,
            'product_idx' => $product_idx,
            'options' => $options,
            'product_code' => $product_code,
        ];
        return view('admin/_tourGuides/write', $data);
    }

    public function write_ok()
    {
        try {
            $product_idx = $this->request->getPost('product_idx');
            $files = $this->request->getFiles();

            $fields = [
                'product_name', 'keyword', 'original_price', 'product_price',
                'product_code', 'product_code_1', 'product_code_2', 'product_code_3',
                'product_info', 'phone', 'product_country', 'product_status', 'onum', 'product_code_list',
            ];
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = updateSQ($this->request->getPost($field) ?? '');
            }

            if ($product_idx) {
                $data['m_date'] = date('Y-m-d H:i:s');
            } else {
                $data['r_date'] = date('Y-m-d H:i:s');
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

            if ($product_idx) {
                $message = '수정되었습니다.';
                $this->productModel->updateData($product_idx, $data);
            } else {
                $message = '성공적으로 생성되었습니다.';
                $this->productModel->insertData($data);
                $product_idx = $this->productModel->getInsertID();
            }

            $product = $this->productModel->getById($product_idx);

            if (!$product['product_code']) {
                $product_code = $this->productModel->createProductCode("PG");
                $newData = [
                    "product_code" => $product_code
                ];

                $this->productModel->updateData($product_idx, $newData);
            }

            $arr_in_arr = [
                'o_idx', 'o_name', 'o_price', 'o_sale_price', 'o_people_cnt', 'o_availability', 'o_onum',
            ];
            $newData = [];
            foreach ($arr_in_arr as $field) {
                $newData[$field] = $this->request->getPost($field) ?? [];
            }

            $o_idx_arr_ = $newData ? $newData['o_idx'] : [];

            $len = count($o_idx_arr_);

            $sup_o_idx = $this->request->getPost('sup_o_idx') ?? [];
            $sup_o_name = $this->request->getPost('sup_o_name') ?? [];
            $sup_o_price = $this->request->getPost('sup_o_price') ?? [];

            for ($j = 0; $j < $len; $j++) {
                $dataOption = [
                    'o_name' => $newData['o_name'][$j],
                    'o_price' => $newData['o_price'][$j],
                    'o_sale_price' => $newData['o_sale_price'][$j],
                    'o_people_cnt' => $newData['o_people_cnt'][$j],
                    'o_availability' => $newData['o_availability'][$j],
                    'onum' => $newData['o_onum'][$j],
                ];

                if ($o_idx_arr_[$j] != '') {
                    $guideOptionIdx = $o_idx_arr_[$j];
                    $dataOption['m_date'] = date('Y-m-d H:i:s');
                    $this->guideOptionModel->updateData($o_idx_arr_[$j], $dataOption);
                } else {
                    $dataOption['r_date'] = date('Y-m-d H:i:s');
                    $dataOption['product_idx'] = $product_idx;

                    $this->guideOptionModel->insertData($dataOption);

                    $guideOptionIdx = $this->guideOptionModel->getInsertID();
                }

                $dataSupOption = [
                    's_name' => $sup_o_name[$j],
                    's_price' => $sup_o_price[$j],
                    'o_idx' => $guideOptionIdx,
                ];

                if ($sup_o_idx[$j] != '') {
                    $dataSupOption['updated_at'] = date('Y-m-d H:i:s');
                    $this->guideSupOptionModel->updateData($sup_o_idx[$j], $dataSupOption);
                } else {
                    $dataSupOption['created_at'] = date('Y-m-d H:i:s');
                    $this->guideSupOptionModel->insertData($dataSupOption);
                }
            }

            $res = [
                "product" => $product
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
            $product_idx = $this->request->getPost('product_idx');
            $status = $this->request->getPost('product_status');
            $onum = $this->request->getPost('onum');

            $len = count($product_idx);
            for ($i = 0; $i < $len; $i++) {
                $data = [
                    'product_status' => $status[$i],
                    'onum' => $onum[$i],
                    'm_date' => date('Y-m-d H:i:s')
                ];

                $this->productModel->updateData($product_idx[$i], $data);
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

    public function update()
    {
        try {
            $product_idx = $this->request->getPost('product_idx');
            $status = $this->request->getPost('product_status');
            $onum = $this->request->getPost('onum');

            $data = [
                'product_status' => $status,
                'onum' => $onum,
                'm_date' => date('Y-m-d H:i:s')
            ];

            $this->productModel->updateData($product_idx, $data);

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
            $product_idx = $this->request->getPost('product_idx');

            $data = [
                'product_status' => 'D',
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
