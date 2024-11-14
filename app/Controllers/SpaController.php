<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;

class SpaController extends BaseController
{
    protected $connect;
    protected $productModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
    }

    public function charge_list()
    {
        $product_idx = $_GET['product_idx'];
        $day_ = $_GET['day_'];
        $yoil = $_GET['yoil'];
        try {
            switch ($yoil) {
                case 'yoil_0':
                    $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_0 = 'Y' AND product_idx = ?";
                    break;
                case 'yoil_1':
                    $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_1 = 'Y' AND product_idx = ?";
                    break;
                case 'yoil_2':
                    $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_2 = 'Y' AND product_idx = ?";
                    break;
                case 'yoil_3':
                    $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_3 = 'Y' AND product_idx = ?";
                    break;
                case 'yoil_4':
                    $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_4 = 'Y' AND product_idx = ?";
                    break;
                case 'yoil_5':
                    $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_5 = 'Y' AND product_idx = ?";
                    break;
                default:
                    $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_6 = 'Y' AND product_idx = ?";
                    break;
            }
            $query = $this->connect->query($sql, [$day_, $day_, $product_idx]);
            $result = $query->getRowArray();

            if ($result) {
                $yoil_idx = $result['p_idx'];

                $fsql2 = "select * from tbl_product_charge where product_idx = '" . $product_idx . "' and yoil_idx = '" . $yoil_idx . "' order by seq asc";
                $fresult2 = $this->connect->query($fsql2);
                $fresult2 = $fresult2->getResultArray();

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

                return $this->response->setStatusCode(200)
                    ->setJSON([
                        'status' => 'success',
                        'result' => $result,
                        'full_' => $t,
                        'day' => $day_,
                        'data' => $fresult2
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
