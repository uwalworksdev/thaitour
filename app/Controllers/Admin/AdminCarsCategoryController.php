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
        $g_list_rows = 10;
        $pg = updateSQ($this->request->getVar("pg") ?? 1);
        $search_txt = updateSQ($this->request->getVar("search_txt") ?? '');
        $search_category = updateSQ($this->request->getVar("search_category") ?? '');
        $orderBy = $_GET["orderBy"] ?? "";

        $data = [
            'orderBy' => $orderBy,
            'nTotalCount' => 0,
            'pg' => $pg,
            'nPage' => 1,
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'g_list_rows' => $g_list_rows,
        ];

        return view("admin/_cars_category/list", $data);
    }


    public function write()
    {
        $ca_idx = updateSQ($this->request->getVar("ca_idx") ?? "");

        $place_start_list = $this->codeModel->getByParentCode(48)->getResultArray();

        $place_end_list = $this->codeModel->getByParentCode(49)->getResultArray();

        return view("admin/_cars_category/write", [
            "ca_idx" => $ca_idx,
            "place_start_list" => $place_start_list,
            "place_end_list" => $place_end_list
        ]);
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

    public function change()
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
