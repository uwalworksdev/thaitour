<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class ProductApi extends BaseController
{
    protected $connect;
    protected $productModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->productModel = model("ProductModel");
        helper('my_helper');
        helper('alert_helper');
    }

    public function roomPhoto()
    {
        try {
            $ridx = updateSQ($_POST['ridx']);

            $html = '';

            if ($ridx) {
                $sql = " select * from tbl_room where g_idx = '" . $ridx . "'";
                $result = $this->connect->query($sql);
                $row = $result->getRowArray();

                foreach ($row as $keys => $vals) {
                    ${$keys} = $vals;
                }

                for ($i = 1; $i <= 10; $i++) {

                    if (isset(${"ufile" . $i}) && ${"ufile" . $i} != "") {

                        $html .= "<li><img src='/uploads/rooms/" . ${"ufile" . $i} . "' alt='' /></li>";
                    }
                }
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $html
                ]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function hotelPhoto()
    {
        try {
            $idx = updateSQ($_POST['idx']);

            $html = '';

            if ($idx) {
                $sql = " select * from tbl_product_mst where product_idx = '" . $idx . "'";
                $result = $this->connect->query($sql);
                $row = $result->getRowArray();

                foreach ($row as $keys => $vals) {
                    ${$keys} = $vals;
                }

                for ($i = 1; $i <= 10; $i++) {

                    if (isset(${"ufile" . $i}) && ${"ufile" . $i} != "") {

                        $html .= "<li><img src='/data/product/" . ${"ufile" . $i} . "' alt='' /></li>";
                    }
                }
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $html
                ]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function getDataHotel()
    {
        try {
            $product_idx = updateSQ($_GET['product_idx']);

            $data = null;

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $data
                ]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'data' => null,
                    'message' => $e->getMessage()
                ]);
        }
    }
}
