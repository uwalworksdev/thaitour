<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminCarsCategoryController extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $carsOptionModel;
    protected $carsSubModel;

    protected $codeModel;


    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        $this->productModel = model("ProductModel");
        $this->carsOptionModel = model("CarsOptionModel");
        $this->carsSubModel = model("CarsSubModel");
        $this->codeModel = model("Code");
    }

    public function list()
    {
        return view("admin/_cars/list");
    }


    public function write()
    {
        
    }

    public function write_ok($product_idx = null)
    {
        try {
    

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function delete()
    {
        try {
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

}
