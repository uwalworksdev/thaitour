<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Code;
use App\Models\Drivers;
use App\Models\ProductModel;
use CodeIgniter\Database\Config;

class AdminDriverController extends BaseController
{
    protected $connect;
    protected $driver;
    protected $productModel;
    protected $codeModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->driver = new Drivers();
        $this->productModel = new ProductModel();
        $this->codeModel = new Code();
    }

    public function list()
    {
        try {
            $g_list_rows = 10;
            $pg = updateSQ($_GET["pg"] ?? '');
            $search_name = updateSQ($_GET["search_name"] ?? '');

            $data = $this->driver->getListPaging([], $g_list_rows, $pg, []);

            $res = [
                'drivers' => $data['items'],
                'search_name' => $search_name,
            ];

            $res = array_merge($data, $res);
            return view('admin/_drivers/list', $res);

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
            $d_idx = $this->request->getVar('d_idx');

            $driver = $this->driver->getById($d_idx);

            $fresult = $this->codeModel->getListByParentCode(["4605"]);

            $data = [
                'driver_idx' => $d_idx,
                'driver' => $driver,
                'fresult' => $fresult,
            ];
            return view('admin/_drivers/write', $data);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function write_ok()
    {
        try {
            $d_idx = $this->request->getVar('d_idx');

            $driver = $this->driver->getById($d_idx);

            $files = $this->request->getFiles();

            $fields = [
                'full_name', 'special_name', 'phone', 'email', 'exp', 'vehicle_type',
                'exp', 'onum', 'vehicle_idx', 'is_show', 'vehicle_name',
            ];
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = updateSQ($this->request->getPost($field) ?? '');
            }

            $vehicle_image = $this->request->getFile('vehicle_image');
            $vehicle_image2 = $this->request->getFile('vehicle_image2');
            $avatar = $this->request->getFile('avatar');

            if (isset($vehicle_image) && $vehicle_image->isValid() && !$vehicle_image->hasMoved()) {
                $vehicle_imageName = $vehicle_image->getName();
                $vehicle_imageNewName = $vehicle_image->getRandomName();
                $publicPath = ROOTPATH . 'public/uploads/drivers';
                $vehicle_image->move($publicPath, $vehicle_imageNewName);
                $data["r_vehicle_image"] = $vehicle_imageName;
                $data["vehicle_image"] = $vehicle_imageNewName;
            }

            if (isset($vehicle_image2) && $vehicle_image2->isValid() && !$vehicle_image2->hasMoved()) {
                $vehicle_image2Name = $vehicle_image2->getName();
                $vehicle_image2NewName = $vehicle_image2->getRandomName();
                $publicPath = ROOTPATH . 'public/uploads/drivers';
                $vehicle_image2->move($publicPath, $vehicle_image2NewName);
                $data["r_vehicle_image2"] = $vehicle_image2Name;
                $data["vehicle_image2"] = $vehicle_image2NewName;
            }

            if (isset($avatar) && $avatar->isValid() && !$avatar->hasMoved()) {
                $avatarName = $avatar->getName();
                $avatarNewName = $avatar->getRandomName();
                $publicPath = ROOTPATH . 'public/uploads/drivers';
                $avatar->move($publicPath, $avatarNewName);
                $data["r_avatar"] = $avatarName;
                $data["avatar"] = $avatarNewName;
            }

            if ($d_idx && $driver) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $this->driver->updateData($d_idx, $data);
                $message = '새 드라이버를 성공적으로 추가했습니다.';
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
                $this->driver->insertData($data);
                $message = '운전을 성공적으로 편집했습니다.';
            }

            return $this->response->setJSON([
                'result' => true,
                'message' => $message,
                'data' => $data,
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function change()
    {
        try {
            $d_idx = $this->request->getVar('d_idx');
            $is_show = $this->request->getPost('is_show');
            $onum = $this->request->getPost('onum');

            $len = count($d_idx);
            for ($i = 0; $i < $len; $i++) {

                $driver = $this->driver->getById($d_idx[$i]);

                if ($driver){
                    $data = [
                        'is_show' => $is_show[$i],
                        'onum' => $onum[$i],
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    $this->driver->updateData($d_idx[$i], $data);
                }
            }

            $message = '운전을 성공적으로 저장했습니다.';

            return $this->response->setJSON([
                'result' => true,
                'message' => $message,
                'data' => '',
            ])->setStatusCode(200);
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
            $d_idx = $this->request->getVar('d_idx');

            $this->driver->deleteData($d_idx);

            return $this->response->setJSON([
                'result' => true,
                'message' => '드라이버를 성공적으로 삭제했습니다.',
                'data' => '',
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }
}
