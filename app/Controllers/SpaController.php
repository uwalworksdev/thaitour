<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;

class SpaController extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $productPrice;
    protected $productCharge;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
        $this->productPrice = model("ProductPrice");
        $this->productCharge = model("ProductCharge");
    }

    public function charge_list()
    {
        $product_idx = $_GET['product_idx'];
        $day_ = $_GET['day_'];
        $yoil = $_GET['yoil'];
        try {
            $results = $this->productPrice->selectYoilByProductIdx($yoil, $day_, $product_idx);

            if ($results && count($results) > 0) {
                $results = array_map(function ($it) use ($product_idx) {
                    $result = (array)$it;
                    $yoil_idx = $result['p_idx'];

                    $fresult2 = $this->productCharge->selectByProductAndYoil($product_idx, $yoil_idx);

                    $fresult2 = array_map(function ($item) {
                        $rs = (array)$item;

                        $tour_price = $rs['tour_price'];
                        $tour_price_baht = convertToBath($tour_price);
                        $rs['tour_price_baht'] = $tour_price_baht;

                        $tour_price_kids = $rs['tour_price_kids'];
                        $tour_price_kids_baht = convertToBath($tour_price_kids);
                        $rs['tour_price_kids_baht'] = $tour_price_kids_baht;

                        $tour_price_senior = $rs['tour_price_senior'];
                        $tour_price_senior_baht = convertToBath($tour_price_senior);
                        $rs['tour_price_senior_baht'] = $tour_price_senior_baht;

                        return $rs;
                    }, $fresult2);

                    $t = true;
                    for ($i = 0; $i < 7; $i++) {
                        if ($result['yoil_' . $t] !== 'Y') {
                            $t = false;
                            break;
                        }
                    }

                    $result['full_'] = $t;
                    $result['data'] = $fresult2;

                    return $result;
                }, $results);

                return $this->response->setStatusCode(200)
                    ->setJSON([
                        'status' => 'success',
                        'day' => $day_,
                        'data' => $results
                    ]);
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'data' => []
                ]);
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
