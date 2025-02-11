<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class ProductApi extends BaseController
{
    protected $connect;
    protected $productModel;
    private $codeModel;
    private $hotelOptionModel;
    private $hotelPriceModel;
    private $roomOptionsModel;
    private $roomsModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->productModel = model("ProductModel");
        $this->codeModel = model("Code");
        $this->hotelOptionModel = new \App\Models\HotelOptionModel();
        $this->hotelPriceModel = new \App\Models\HotelPriceModel();
        $this->roomOptionsModel = new \App\Models\RoomOptions();
        $this->roomsModel = new \App\Models\Rooms();
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
                $sql    = " select * from tbl_product_img where product_idx = '" . $idx . "' order by i_idx asc ";
                $result = $this->connect->query($sql);
                $result = $result->getResultArray();
                foreach ($result as $row) {
					    if($row['ufile']) {
                           $html .= "<li><img src='/data/product/" . $row['ufile'] . "' alt='' /></li>";
						}   
                }
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status'  => 'success',
                    'message' => 'success',
                    'data'    => $html
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

            $reject_days = [];
            $enabled_dates = [];

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
                    $reject_days[] = $it['goods_date'];
                }
            }

            $all_dates = $this->createDateRange($min_date_, $max_date_);

            foreach ($data as $period) {
                $exclude_dates = $this->createDateRange($period["start_date"], $period["end_date"]);
                $enabled_dates = array_merge($enabled_dates, $exclude_dates);
                $all_dates = array_diff($all_dates, $exclude_dates);
            }

            $enabled_dates = array_unique($enabled_dates);
            
            $enabled_dates = array_filter($enabled_dates, function ($value) use ($reject_days) {
                return !in_array($value, $reject_days);
            });
            
            $enabled_dates = array_values($enabled_dates);

            $all_dates = array_values($all_dates);
            $all_dates = array_merge($all_dates, $reject_days);
            $date_ranges = $this->groupDatesToRanges($all_dates);

            $res = [
                'data' => $data,
                'min_date' => $min_date_,
                'max_date' => $max_date_,
                'available_dates' => $date_ranges,
                'enabled_dates' => $enabled_dates,
                'reject_days' => $reject_days
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

            $gresult = $this->hotelOptionModel->where([
                'goods_code' => $product_code,
                'option_type' => 'M'
            ])->orderBy('o_room', 'ASC')->findAll();

            $data = [];

            foreach ($gresult as $item) {
                $day = 0;
                $o_idx = $item['idx'];

                $roresult = $this->hotelPriceModel->where([
                    'o_idx' => $o_idx,
                    'goods_date >=' => $start_day,
                    'goods_date <=' => $end_day,
                    'use_yn !=' => 'N'
                ])->orderBy('goods_date', 'ASC')->findAll();

                $price = 0;
                $sale_price = 0;
                $is_disabled = true;

                $lst = [];
                foreach ($roresult as $it) {
                    $price += $it['goods_price1'];
                    $sale_price += $it['goods_price2'];
                    $day++;

                    $vst['date'] = $it['goods_date'];
                    $vst['price'] = $it['goods_price1'];
                    $vst['price_won'] = round($it['goods_price1'] * $this->setting['baht_thai']);
                    $vst['sale_price'] = $it['goods_price2'];
                    $vst['sale_price_won'] = round($it['goods_price2'] * $this->setting['baht_thai']);

                    $lst[] = $vst;

                    if($it['goods_date'] == $start_day) {
                        $is_disabled = false;
                    }
                }

                $room = $this->roomsModel->where([
                    'g_idx' => $item['o_room']
                ])->first();

                $roomOption = $this->roomOptionsModel->where([
                    'h_idx' => $product_idx,
                    'r_idx' => $room['g_idx']
                ]);

                foreach ($roomOption->findAll() as $it) {
                    $r_price = $it['r_price'];
                    $r_sale_price = $it['r_sale_price'];
                    $price += $r_price * $day;
                    $sale_price += $r_sale_price * $day;
                }

                $rs['is_disabled'] = $is_disabled;
                $rs['price'] = $price;
                $rs['price_won'] = round($price * $this->setting['baht_thai']);
                $rs['sale_price'] = $sale_price;
                $rs['sale_price_won'] = round($sale_price * $this->setting['baht_thai']);
                $rs['idx'] = $o_idx;
                $rs['day'] = $day;
                $rs['op_won_bath'] = $item["op_won_bath"];
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

    public function getCode()
    {
        try {
            $code = updateSQ($_GET['code']);

            $sub_codes = $this->codeModel->where('parent_code_no', $code)->orderBy('onum', 'DESC')->findAll();

            $tabLinks = [
                1303 => "/product-hotel/list-hotel?s_code_no=",
                1302 => "/product-golf/list-golf/",
                1301 => "/product-tours/tours-list/",
            ];

            $sub_codes = array_map(function ($item) use ($tabLinks) {
                $rs = (array)$item;

                $code_no = $rs['code_no'];
                $parent_code_no = $rs['parent_code_no'];

                $link = $tabLinks[$parent_code_no] . $code_no ?? "!#";

                $rs['link_'] = $link;

                return $rs;
            }, $sub_codes);

            $res = [
                'data' => $sub_codes
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

    public function ajax_change_golf()
    {
        try {

            $product_idx = $this->request->getPost('code_idx') ?? [];
            $onum = $this->request->getPost('onum') ?? [];
            $product_status = $this->request->getPost('product_status') ?? [];
            $special_price_price = $this->request->getPost('special_price_price') ?? [];

            if (!is_array($product_idx) || !is_array($onum) || count($product_idx) !== count($onum)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => 'Dữ liệu đầu vào không hợp lệ.'
                ]);
            }

            $tot = count($product_idx);

            $builder = $this->connect->table('tbl_product_mst');

            for ($j = 0; $j < $tot; $j++) {
                $data = [
                    'onum' => $onum[$j],
                    'product_status' => $product_status[$j],
                    'special_price' => $special_price_price[$j],
                ];

                $builder->where('product_idx', $product_idx[$j]);
                $result = $builder->update($data);

                if (!$result) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => '수정 중 오류가 발생했습니다!!'
                    ]);
                }
            }

            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => '수정 했습니다.'
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
