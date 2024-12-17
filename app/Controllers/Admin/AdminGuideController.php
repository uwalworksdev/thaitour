<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Guides;
use CodeIgniter\Database\Config;

class AdminGuideController extends BaseController
{
    protected $connect;
    protected $guideModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->guideModel = new Guides();
    }

    public function list()
    {
        try {
            $guides = $this->guideModel->getList();
            $data = [
                'guides' => $guides,
            ];
            return view('admin/_guides/list', $data);

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
            $g_idx = $this->request->getVar('guide_idx');
            $guide = $this->guideModel->selectById($g_idx);
            $data = [
                'guide' => $guide,
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

            $fields = [
                'guide_name', 'special_name', 'slogan', 'age', 'exp', 'language',
                'guide_description', 'phone', 'email', 'status', 'onum',
            ];
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = updateSQ($this->request->getPost($field) ?? '');
            }

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
