<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class ProductPlaceController extends BaseController
{
    protected $connect;
    protected $productPlase;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->productPlase = model("ProductPlace");
    }

    public function index()
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
