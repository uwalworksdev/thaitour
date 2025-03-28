<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminProductPlaceController extends BaseController
{
    protected $connect;
    protected $productPlace;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->productPlace = model("ProductPlace");
    }

    public function list()
    {
        try {
            $product_idx = updateSQ($_GET['product_idx']);

            $data = $this->productPlace->getByProductId($product_idx);

            return $this->response->setJSON([
                'result' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function listByIdx()
    {
        try {
            $place_ids = updateSQ($_GET['place_ids']);

            $data = $this->productPlace->getByListIdx($place_ids);

            return $this->response->setJSON([
                'result' => true,
                'data' => $data
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
            $idx = updateSQ($_GET['idx']);
            $data = $this->productPlace->getById($idx);

            return $this->response->setJSON([
                'result' => true,
                'data' => $data
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
            $message = "성공적으로 생성되었습니다.";

            $name = $_POST['name'];
            $product_idx = updateSQ($_POST['product_idx']) ?? 0;
            $type = $_POST['type'];
            $distance = $_POST['distance'];
            $onum = $_POST['onum'];
            $r_date = date('Y-m-d H:i:s');
            $idx = updateSQ($_POST['idx']);
            $url = updateSQ($_POST['url']);

            $file = $this->request->getFile('ufile1');
            $upload = ROOTPATH . 'public/data/code/';

            if ($idx) {
                $place = $this->productPlace->getById($idx);

                if ($place) {
                    $data = [
                        'name' => $name ?? $place['name'],
                        'product_idx' => $product_idx ?? $place['product_idx'],
                        'type' => $type ?? $place['type'],
                        'distance' => $distance ?? $place['distance'],
                        'onum' => $onum ?? $place['onum'],
                        'url' => $url,
                    ];

                    if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move($upload, $newName);

                        $data['ufile'] = $newName;
                        $data['rfile'] = $file->getClientName();
                    }

                    $this->productPlace->update($idx, $data);
                }
            } else {
                $data = [
                    'name' => $name,
                    'product_idx' => $product_idx,
                    'type' => $type,
                    'distance' => $distance,
                    'onum' => $onum,
                    'url' => $url,
                    'r_date' => $r_date
                ];

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move($upload, $newName);

                    $data['ufile'] = $newName;
                    $data['rfile'] = $file->getClientName();
                }

                $this->productPlace->insert($data);

                $idx = $this->productPlace->getInsertID();
                $message = "업데이트가 성공적으로 완료되었습니다.";
            }


            $place = $this->productPlace->getById($idx);

            return $this->response->setJSON([
                'result' => true,
                'data' => $place ?? [],
                'message' => $message
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
            $idx = updateSQ($_POST['idx']);

            $del = $this->productPlace->deleteData($idx);

            return $this->response->setJSON([
                'result' => true,
                'message' => "성공적으로 삭제되었습니다."
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }
}
