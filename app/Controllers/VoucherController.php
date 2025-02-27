<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class VoucherController extends BaseController
{

    public function hotel()
    {
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name     = updateSQ($_GET["search_name"] ?? '');
        $pg              = updateSQ($_GET["pg"] ?? '');
        $order_idx       = updateSQ($_GET["order_idx"] ?? '');
        $titleStr        = "예약관리";
        if ($order_idx) {
            $row = $this->orderModel->getOrderInfo($order_idx);

            $titleStr = "일정 및 결제정보";
        }

        $sql_cou    = " select * from tbl_coupon_history where order_idx='" . $order_idx . "'";
        $result_cou = $this->connect->query($sql_cou);
        $row_cou    = $result_cou->getRowArray();

        $fresult    = $this->orderSubModel->getOrderSub($order_idx);

        $additional_request       = $row['additional_request'] ?? '';
        $_arr_additional_request  = explode("|", $additional_request);
        $list__additional_request = rtrim(implode(',', $_arr_additional_request), ',');

        if($list__additional_request == "") {
           $sql = "select * from tbl_code WHERE parent_code_no='53' AND status = 'Y' order by onum asc, code_idx desc";
        } else {
           $sql = "select * from tbl_code WHERE parent_code_no='53' AND status = 'Y' and code_no IN ($list__additional_request) order by onum asc, code_idx desc";
        }

		$fcodes = $this->db->query($sql)->getResultArray();

        $data['fcodes'] = $fcodes;

        $str_guide = '';
        $used_coupon_no = '';
        $data = [
            "search_category" => $search_category ?? '',
            "fcodes"          => $fcodes ?? [],
            "search_name"     => $search_name ?? '',
            "pg"              => $pg ?? '',
            "titleStr"        => $titleStr,
            "str_guide"       => $str_guide,
            "row_cou"         => $row_cou ?? [
            'used_coupon_no'  => '',
                ],
            "fresult" => $fresult ?? '',
            "used_coupon_no" => $used_coupon_no,
        ];

        if ($gubun == 'hotel') {
            $sql_  = "SELECT * FROM tbl_hotel_rooms WHERE rooms_idx = " . $row["room_op_idx"];
            $room_ = $this->db->query($sql_)->getRowArray();
            $data['price_secret'] = $room_["secret_price"];
        }

        if ($gubun == 'golf') {
            $data['main']    = $this->orderOptionModel->getOption($order_idx, 'main');
            $data['option']  = $this->orderOptionModel->getOption($order_idx, 'option');
            $data['vehicle'] = $this->orderOptionModel->getOption($order_idx, 'vehicle');
        }

        if ($gubun == 'tour') {
            $data['tour_orders'] = $this->orderTours->findByOrderIdx($order_idx)[0];
            $optionsIdx  = $data['tour_orders']['options_idx'];

            $options_idx = explode(',', $optionsIdx);

            $data['tour_option'] = [];
            $data['total_price'] = 0;
            foreach ($options_idx as $idx) {
                $optionDetail = $this->optionTours->find($idx);
                if ($optionDetail) {
                    $data['tour_option'][] = $optionDetail;
                    $data['total_price'] += $optionDetail['option_price'];
                }
            }
        }

        if ($gubun == 'spa') {
            $data['option_order'] = $this->orderOptionModel->getOption($order_idx, 'spa');
        }

        if ($gubun == 'vehicle') {
            $departure_area   = $row["departure_area"] ?? 0;
            $destination_area = $row["destination_area"] ?? 0;
            $cp_idx           = $row["cp_idx"] ?? 0;
            $ca_depth_idx     = $row["ca_depth_idx"] ?? 0;
            $ca_last_idx      = $this->carsPrice->find($cp_idx)["ca_idx"] ?? "0";
            $order_idx        = $row["order_idx"] ?? 0;

            $data['departure_name']    = $this->carsCategory->getById($departure_area)["code_name"];
            $data['destination_name']  = $this->carsCategory->getById($destination_area)["code_name"];
            $data['code_no_first']     = $this->carsCategory->getById($ca_depth_idx)["code_no"];
            $data['category_arr']      = $this->carsCategory->getCategoryTree($ca_last_idx);
            $data['order_cars_detail'] = $this->ordersCars->getByOrder($order_idx);
        }

        if ($gubun == 'guide'){
            $order_idx = $row["order_idx"] ?? 0;
            $o_idx = $row["yoil_idx"] ?? 0;
            $order_subs = $this->orderGuide->getListByOrderIdx($order_idx);
            $data['order_subs'] = $order_subs;

            $option = $this->guideOptionModel->getById($o_idx);
            $sup_options = $this->guideSupOptionModel->getListByOptionId($o_idx);

            $data['option'] = $option;
            $data['sup_options'] = $sup_options;
        }		

		return view("voucher/voucher_hotel", array_merge($data, $row));
    }

    public function tour()
    {
       
        return view("voucher/voucher_tour", [
        ]);
    }

    public function show()
    {
       
        return view("voucher/voucher_show", [
        ]);
    }
    public function golf()
    {
       
        return view("voucher/voucher_golf", [
        ]);
    }

    public function ticket()
    {
       
        return view("voucher/voucher_ticket", [
        ]);
    }
}