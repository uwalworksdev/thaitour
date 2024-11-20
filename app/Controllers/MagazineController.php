<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class MagazineController extends BaseController
{
    protected $connect;
    protected $magazineModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->magazineModel = model("Magazines");
    }

    public function list()
    {
        try {
            $data = [];

            return $this->renderView('magazines/list', $data);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function detail()
    {
        try {
            $m_idx = $this->request->getVar('m_idx');
            $data = [];
            return $this->renderView('magazines/detail', $data);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }
}
