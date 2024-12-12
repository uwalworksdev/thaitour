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
    protected $carsCategory;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        $this->productModel = model("ProductModel");
        $this->carsOptionModel = model("CarsOptionModel");
        $this->carsSubModel = model("CarsSubModel");
        $this->codeModel = model("Code");
        $this->carsCategory = model("CarsCategory");
    }

    public function list()
    {
        $g_list_rows = 10;
        $pg = updateSQ($this->request->getVar("pg") ?? 1);
        $search_txt = updateSQ($this->request->getVar("search_txt") ?? '');
        $search_category = updateSQ($this->request->getVar("search_category") ?? '');

        $cars_category = $this->carsCategory->getCategoryList($search_txt, $search_category, $pg, $g_list_rows);

        $data = [
            'nTotalCount' => $cars_category["nTotalCount"],
            'pg' => $pg,
            'nPage' => $cars_category["nPage"],
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

        $category_options = $this->codeModel->getByParentCode(54)->getResultArray();

        $tree_codes = $this->codeModel->getAllDescendants(54);

        return view("admin/_cars_category/write", [
            "ca_idx" => $ca_idx,
            "place_start_list" => $place_start_list,
            "place_end_list" => $place_end_list,
            "category_options" => $category_options,
            "tree_codes" => $tree_codes
        ]);
    }

    public function write_ok($ca_idx = null)
    {
        // $category_data = $this->request->getPost("category_data");

        // $categories = json_decode($category_data, true);

        // var_dump($categories);

        try {
            $departure_name = $this->request->getPost("departure_name");
            $destination_name = $this->request->getPost("destination_name");
            $category_data = $this->request->getPost("category_data");
            $categories = json_decode($category_data, true);

            if(!empty($departure_name) && !empty($destination_name)){

                $depth_1 = $this->carsCategory->insertData([
                    "ca_name" => $departure_name,
                    "parent_ca_idx" => 0,
                    "depth" => 1,
                ]);

                if($depth_1){
                    $depth_2 = $this->carsCategory->insertData([
                        "ca_name" => $destination_name,
                        "parent_ca_idx" => $depth_1,
                        "depth" => 2,
                    ]);

                    if($depth_2){
                        $builder = $this->carsCategory;
                        $this->saveCategoryTree($categories, $depth_2, 3, $builder);
                    }
                }

                return $this->response->setJSON([
                    'result' => true,
                    'message' => "정상적인 등록되었습니다."
                ], 200);
            }

            return $this->response->setJSON([
                'result' => false,
                'message' => "누락된 데이터."
            ], 400);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function saveCategoryTree(array $categories, int $parentId, int $depth, $builder)
    {
        foreach ($categories as $category) {
            $currentId = $builder->insertData([
                'ca_name' => $category['ca_name'],
                'parent_ca_idx' => $parentId,
                'depth' => $depth
            ]);

            if (!empty($category['children'])) {
                $this->saveCategoryTree($category['children'], $currentId, $depth + 1, $builder);
            }
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
