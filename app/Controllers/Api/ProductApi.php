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

            $product = $this->productModel->find($product_idx);

            $product_code = $product['product_code'];

            $gsql = "SELECT * 
                 FROM tbl_hotel_option 
                 WHERE option_type = 'M' 
                 AND goods_code='" . $product_code . "' 
                 ORDER BY o_room ASC 
            ";
            $gresult = $this->connect->query($gsql)->getResultArray();

            $min_date_ = null;
            $max_date_ = null;
            $data = [];

            $reject_day = [];

            foreach ($gresult as $item) {
                $o_idx = $item['idx'];

                $rs = [];

                $day = $item['o_sdate'] . '||' . $item['o_edate'];

                $min_date_ = $min_date_ === null || $item['o_sdate'] < $min_date_ ? $item['o_sdate'] : $min_date_;
                $max_date_ = $max_date_ === null || $item['o_edate'] > $max_date_ ? $item['o_edate'] : $max_date_;

                $rs['price'] = $item['goods_price1'];
                $rs['sale_price'] = $item['goods_price2'];
                $rs['start_date'] = $item['o_sdate'];
                $rs['end_date'] = $item['o_edate'];

                $rs['day'] = $day;

                $data[] = $rs;

                $fsql = "select * from tbl_hotel_price where o_idx = '" . $o_idx . "' and use_yn = 'N' order by goods_date asc";

                $roresult = $this->connect->query($fsql);
                $roresult = $roresult->getResultArray();

                foreach ($roresult as $it) {
                    $reject_day[] = $it['goods_date'];
                }
            }

            $all_dates = $this->createDateRange($min_date_, $max_date_);

            foreach ($data as $period) {
                $exclude_dates = $this->createDateRange($period["start_date"], $period["end_date"]);
                $all_dates = array_diff($all_dates, $exclude_dates);
            }

            $all_dates = array_values($all_dates);
            $all_dates = array_merge($all_dates, $reject_day);
            $date_ranges = $this->groupDatesToRanges($all_dates);

            $res = [
                'data' => $data,
                'min_date' => $min_date_,
                'max_date' => $max_date_,
                'available_dates' => $date_ranges,
            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $res
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

    public function getPriceByDate()
    {
        try {
            $product_idx = updateSQ($_GET['product_idx']);
            $start_day = $_GET['start_day'];
            $end_day = $_GET['end_day'];

            $product = $this->productModel->find($product_idx);

            $product_code = $product['product_code'];

            $gsql = "SELECT * 
                 FROM tbl_hotel_option 
                 WHERE option_type = 'M' 
                 AND goods_code='" . $product_code . "' 
                 ORDER BY o_room ASC 
            ";
            $gresult = $this->connect->query($gsql)->getResultArray();

            $data = [];

            $day = 0;

            foreach ($gresult as $item) {
                $o_idx = $item['idx'];

                $fsql = "select * from tbl_hotel_price where o_idx = '" . $o_idx . "' and use_yn != 'N' and goods_date between '" . $start_day . "' and '" . $end_day . "' order by goods_date asc";

                $roresult = $this->connect->query($fsql);
                $roresult = $roresult->getResultArray();

                $price = 0;
                $sale_price = 0;

                $lst = [];
                foreach ($roresult as $it) {
                    $price += $it['goods_price1'];
                    $sale_price += $it['goods_price2'];
                    $day++;

                    $vst['date'] = $it['goods_date'];
                    $vst['price'] = $it['goods_price1'];
                    $vst['sale_price'] = $it['goods_price2'];

                    $lst[] = $vst;
                }

                $rs['price'] = $price;
                $rs['sale_price'] = $sale_price;
                $rs['idx'] = $o_idx;
                $rs['day'] = $day;
                $rs['items'] = $lst;

                $data[] = $rs;
            }

            $res = [
                'data' => $data
            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $res
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

    public function getDataOption()
    {
        try {
            $option_type = updateSQ($_GET['option_type']);
            $o_idx = updateSQ($_GET['o_idx']);

            $day = $_GET['day'];

            $fsql = "SELECT * FROM tbl_hotel_price WHERE o_idx = '" . $o_idx . "' ";

            if ($option_type == 'N') {
                $fsql .= "AND use_yn = 'N' ";
            } elseif ($option_type == 'Y') {
                $fsql .= "AND use_yn != 'N' ";
            }

            if ($day) {
                $fsql .= "AND goods_date = '" . $day . "' ";
            }

            $fsql .= "ORDER BY goods_date ASC";

            $roresult = $this->connect->query($fsql);
            $roresult = $roresult->getResultArray();

            $res = [
                'data' => $roresult
            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $res
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

    private function getDateRange($data, $min_date_, $max_date_)
    {
        $excluded_ranges = [];
        foreach ($data as $item) {
            $excluded_ranges[] = [
                'start' => $item['start_date'],
                'end' => $item['end_date']
            ];
        }

        $available_ranges = [];
        $current_start = $min_date_;

        foreach ($excluded_ranges as $range) {
            $range_start = $range['start'];
            $range_end = $range['end'];

            if ($current_start < $range_start) {
                $available_ranges[] = [
                    'start' => $current_start,
                    'end' => date('Y-m-d', strtotime('-1 day', strtotime($range_start)))
                ];
            }

            $current_start = date('Y-m-d', strtotime('+1 day', strtotime($range_end)));
        }

        if ($current_start <= $max_date_) {
            $available_ranges[] = [
                'start' => $current_start,
                'end' => $max_date_
            ];
        }

        return $available_ranges;
    }

    private function createDateRange($start, $end)
    {
        $range = [];
        $current = strtotime($start);
        $end = strtotime($end);
        while ($current <= $end) {
            $range[] = date("Y-m-d", $current);
            $current = strtotime("+1 day", $current);
        }
        return $range;
    }

    private function groupDatesToRanges($dates)
    {
        sort($dates);
        $ranges = [];
        $start = $dates[0];
        $end = $dates[0];

        for ($i = 1; $i < count($dates); $i++) {
            $current = $dates[$i];
            if (strtotime($current) == strtotime($end) + 86400) {
                $end = $current;
            } else {
                $ranges[] = $start . "||" . $end;
                $start = $current;
                $end = $current;
            }
        }

        $ranges[] = $start . "||" . $end;
        return $ranges;
    }
}
