<?php

namespace App\Controllers;

class CarsCategoryController extends BaseController {
    private $db;
    private $productModel;
    protected $carsCategory;
    protected $carsPrice;
    protected $carsOptionModel;
    protected $codeModel;
    protected $categoryFlight;

    public function __construct() {
        $this->db = db_connect();
        $this->productModel = model("ProductModel");
        $this->carsCategory = model("CarsCategory");
        $this->carsPrice = model("CarsPrice");
        $this->carsOptionModel = model("CarsOptionModel");
        $this->codeModel = model("Code");
        $this->categoryFlight = model("CategoryFlight");
    }

	public function get_child_category() {
		$ca_idx = $this->request->getVar("ca_idx");

		$category_list = $this->carsCategory->getByParentCode($ca_idx)->getResultArray() ?? [];

        $first_category = !empty($category_list) ? $category_list[0] : null;

        $count_child = 0;

        if($first_category){
            $child_list = $this->carsCategory->getByParentCode($first_category["ca_idx"])->getResultArray() ?? [];
            $count_child = count($child_list);
        }

		return $this->response->setJSON([
            "category_list" => $category_list,
            "count_child" => $count_child
        ]);
	}

	public function get_destination() {
		$ca_idx = $this->request->getVar("ca_idx");
		$code_no = $this->request->getVar("code_no");

		$destination_list = $this->carsCategory->getByParentAndCodeNo($ca_idx, $code_no) ?? [];

		return $this->response->setJSON($destination_list);
	}

    public function get_cars_product() {
        $ca_idx = $this->request->getVar("ca_idx");

        $products = $this->productModel->findProductCarPrice($ca_idx);

        foreach ($products as $key => $value) {
            $options = $this->carsOptionModel->findOption($products[$key]["product_code"]);
            foreach ($options as $key2 => $value2) {
                $types = $this->codeModel->getByCodeNos(array_map("trim", explode(",", $value2["c_op_type"])));
                $options[$key2]["icons"] = array_column($types, "ufile1");
            }
            $products[$key]["options"] = $options;
        }

		return $this->response->setJSON($products);

    }   

    public function get_flight() {
		$ca_idx = $this->request->getVar("ca_idx");

		$flight_list = $this->categoryFlight->getAllFlightFromCaIdx($ca_idx) ?? [];

		return $this->response->setJSON([
            "flight_list" => $flight_list
        ]);
	}
}