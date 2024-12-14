<?php

namespace App\Controllers;

class CarsCategoryController extends BaseController {
    private $db;
    private $productModel;
    protected $carsCategory;
    protected $carsPrice;

    public function __construct() {
        $this->db = db_connect();
        $this->productModel = model("ProductModel");
        $this->carsCategory = model("CarsCategory");
        $this->carsPrice = model("CarsPrice");
    }

	public function get_child_category() {
		$ca_idx = $this->request->getVar("ca_idx");

		$category_list = $this->carsCategory->getByParentCode($ca_idx) ?? [];

		return $this->response->setJSON($category_list);
	}
	
}