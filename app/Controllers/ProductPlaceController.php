<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class ProductPlaceController extends BaseController
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
}
