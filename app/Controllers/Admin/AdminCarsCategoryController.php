<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminCarsCategoryController extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $codeModel;
    protected $carsCategory;
    protected $carsPrice;
    protected $flightModel;
    protected $categoryFlight;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        $this->productModel = model("ProductModel");
        $this->codeModel = model("Code");
        $this->carsCategory = model("CarsCategory");
        $this->carsPrice = model("CarsPrice");
        $this->flightModel = model("FlightModel");
        $this->categoryFlight = model("CategoryFlight");
    }

    public function list()
    {
        //$g_list_rows = 10;
        $g_list_rows     = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 10; 
        $pg = updateSQ($this->request->getVar("pg") ?? 1);
        $search_txt = updateSQ($this->request->getVar("search_txt") ?? '');
        $search_category = updateSQ($this->request->getVar("search_category") ?? '');

        $cars_category = $this->carsCategory->getCategoryList($search_txt, $search_category, $pg, $g_list_rows);

        $data = [
            'nTotalCount' => $cars_category["nTotalCount"],
            'category_list' => $cars_category["category_list"],
            'pg' => $pg,
            'nPage' => $cars_category["nPage"],
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'g_list_rows' => $g_list_rows,
            'num' => $cars_category["num"]
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

        $airline_list = $this->codeModel->getByParentCode(14)->getResultArray();

        foreach($airline_list as $key => $value){
            $airline_list[$key]["flights"] = $this->flightModel->getAllData($value["code_idx"]);
        }

        $where = [
            'product_code_1' => 1324,
            'product_code_list' => 132404,
        ];

        $products = $this->productModel->findProductPaging($where, 10000, 1, [])["items"];

        if(!empty($ca_idx)){
            $departure = $this->carsCategory->find($ca_idx);
            $departure_code = $departure["code_no"];
            $destination =  $this->carsCategory->where("parent_ca_idx", $departure["ca_idx"])->first();
            $destination_code = $destination["code_no"];
            $depth_2 = $destination["ca_idx"];
            $categories = $this->carsCategory->getDepthCategory($destination["ca_idx"]);
        }

        return view("admin/_cars_category/write", [
            "ca_idx" => $ca_idx,
            "place_start_list" => $place_start_list ?? [],
            "place_end_list" => $place_end_list ?? [],
            "category_options" => $category_options ?? [],
            "tree_codes" => $tree_codes ?? [],
            "products" => $products ?? [],
            "departure_code" => $departure_code ?? "",
            "destination_code" => $destination_code ?? "",
            "categories" => $categories ?? [],
            "depth_2" => $depth_2 ?? 0,
            "airline_list" => $airline_list ?? []
        ]);
    }

    public function write_ok($ca_idx = null)
    {
        try {
            $departure_code = $this->request->getPost("departure_code");
            $destination_code = $this->request->getPost("destination_code");
            $category_data = $this->request->getPost("category_data");
            $categories = json_decode($category_data, true);

            if(!empty($departure_code) && !empty($destination_code)){

                if(!empty($ca_idx)){
                    $exec = "update";
                    $depth_2 = $this->request->getPost("depth_2");

                    if(!empty($depth_2)){
                        $builder = $this->carsCategory;
                        $this->saveCategoryTree($categories, $depth_2, 3, $builder);
                    }
                }else{
                    $exec = "insert";

                    $depth_1 = $this->carsCategory->insertData([
                        "code_no" => $departure_code,
                        "parent_ca_idx" => 0,
                        "depth" => 1,
                    ]);
    
                    if($depth_1){
                        $depth_2 = $this->carsCategory->insertData([
                            "code_no" => $destination_code,
                            "parent_ca_idx" => $depth_1,
                            "depth" => 2,
                        ]);
    
                        if($depth_2){
                            $builder = $this->carsCategory;
                            $this->saveCategoryTree($categories, $depth_2, 3, $builder);
                        }
                    }
                }

                if($exec == "update"){
                    $message = "수정되었습니다.";
                }else{
                    $message = "정상적인 등록되었습니다.";
                }
                
                return $this->response->setJSON([
                    'result' => true,
                    'exec' => $exec,
                    'message' => $message
                ], 200);
            }else{
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "누락된 데이터."
                ], 400);
            }



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

            if(empty($category['ca_idx'])){
                
                $currentId = $builder->insertData([
                    'code_no' => $category['code_no'],
                    'parent_ca_idx' => $parentId,
                    'depth' => $depth
                ]);

                if(count($category['airline_arr']) > 0){
                    foreach($category['airline_arr'] as $airline){
                        if(count($airline["flights"]) > 0) {
                            foreach($airline["flights"] as $flight){
                                $this->categoryFlight->insertData([
                                    'ca_idx' => $currentId,
                                    'air_idx' => $airline["airline_idx"],
                                    'f_idx' => $flight["f_idx"]
                                ]);
                            }
                        }
                    }
                }

                if (count($category['product_arr']) > 0) {
    
                    foreach($category['product_arr'] as $product){
                        $product_idx = $product["product_idx"] ?? 0;
                        $init_price = $product["init_price"] ?? 0;
                        $sale_price = $product["sale_price"] ?? 0;
    
                        $this->carsPrice->insertData([
                            'ca_idx' => $currentId,
                            'product_idx' => $product_idx,
                            'init_price' => $init_price,
                            'sale_price' => $sale_price
                        ]);
                    }
                }
    
                if (!empty($category['children'])) {
                    $this->saveCategoryTree($category['children'], $currentId, $depth + 1, $builder);
                }
            }else{
                if(count($category['airline_arr']) > 0){
                    foreach($category['airline_arr'] as $airline){
                        if(count($airline["flights"]) > 0) {
                            foreach($airline["flights"] as $flight){
                                if(empty($flight["cf_idx"])){
                                    $this->categoryFlight->insertData([
                                        'ca_idx' => $category['ca_idx'],
                                        'air_idx' => $airline["airline_idx"],
                                        'f_idx' => $flight["f_idx"]
                                    ]);
                                }
                            }
                        }
                    }
                }

                if (count($category['product_arr']) > 0) {
    
                    foreach($category['product_arr'] as $product){
                        $cp_idx = $product["cp_idx"];
                        $product_idx = $product["product_idx"] ?? 0;
                        $init_price = $product["init_price"] ?? 0;
                        $sale_price = $product["sale_price"] ?? 0;

                        if(!empty($cp_idx)){
                            $this->carsPrice->updateData($cp_idx, [
                                'init_price' => $init_price,
                                'sale_price' => $sale_price
                            ]); 
                        }else{
                            $this->carsPrice->insertData([
                                'ca_idx' => $category['ca_idx'],
                                'product_idx' => $product_idx,
                                'init_price' => $init_price,
                                'sale_price' => $sale_price
                            ]);
                        }
                    }
                }
    
                if (!empty($category['children'])) {
                    $this->saveCategoryTree($category['children'], $category['ca_idx'], $depth + 1, $builder);
                }
            }

        }
    }

    public function delete()
    {
        try {
            $ca_idx = $this->request->getPost("ca_idx");

            $this->deleteDepthCategory($ca_idx);

            return $this->response->setJSON([
                'result' => true,
                'message' => "성공적으로 삭제되었습니다."
            ], 200);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function delete_category()
    {
        try {
            
            $ca_idx = $this->request->getPost("ca_idx");

            $this->deleteDepthCategory($ca_idx);

            return $this->response->setJSON([
                'result' => true,
                'message' => "성공적으로 삭제되었습니다."
            ], 200);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function deleteDepthCategory($parent_ca_idx)
    {

        $children = $this->carsCategory->where('parent_ca_idx', $parent_ca_idx)->findAll();

        foreach ($children as $child) {
            $this->deleteDepthCategory($child['ca_idx']);
        }

        $this->carsPrice->where("ca_idx", $parent_ca_idx)->delete();
        $this->carsCategory->deleteData($parent_ca_idx);

    }

    public function delete_cars_price()
    {
        try {
            
            $cp_idx = $this->request->getPost("cp_idx");

            $result = $this->carsPrice->deleteData($cp_idx);

            if($result){
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "성공적으로 삭제되었습니다."
                ], 200);
            }else{
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "오류가 발생했습니다."
                ], 200);
            }

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function delete_airline()
    {
        try {
            
            $air_idx = $this->request->getPost("air_idx");

            $result = $this->categoryFlight->where("air_idx", $air_idx)->delete();

            if($result){
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "성공적으로 삭제되었습니다."
                ], 200);
            }else{
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "오류가 발생했습니다."
                ], 200);
            }

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function delete_flight()
    {
        try {
            
            $cf_idx = $this->request->getPost("cf_idx");

            $result = $this->categoryFlight->deleteData($cf_idx);

            if($result){
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "성공적으로 삭제되었습니다."
                ], 200);
            }else{
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "오류가 발생했습니다."
                ], 200);
            }

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
