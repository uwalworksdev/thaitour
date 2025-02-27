<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuideOptions;
use App\Models\GuideSupOptions;
use App\Models\OrderGuideModel;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;
use Config\CustomConstants as ConfigCustomConstants;
use Exception;

class VoucherController extends BaseController
{
    private $db;
    protected $connect;
    private $productModel;

    private $orderModel;
    private $orderSubModel;
    private $codeModel;
    private $paymentHistModel;
    private $orderOptionModel;
    private $orderTours;
    private $optionTours;
    private $carsCategory;
    private $carsPrice;
    private $ordersCars;
    private $orderGuide;
    protected $guideOptionModel;
    protected $guideSupOptionModel;
	
    public function __construct()
    {
        $this->db = db_connect();
        $this->orderModel = model("OrdersModel");
        $this->orderSubModel = model("OrderSubModel");
        $this->orderOptionModel = model("OrderOptionModel");
        $this->codeModel = model("Code");
        $this->paymentHistModel = model("PaymentHist");
        $this->orderTours = model("OrderTourModel");
        $this->optionTours = model("OptionTourModel");
        $this->productModel = model("ProductModel");
        $this->carsCategory = model("CarsCategory");
        $this->carsPrice = model("CarsPrice");
        $this->ordersCars = model("OrdersCarsModel");

        $this->orderGuide = new OrderGuideModel();
        $this->guideOptionModel = new GuideOptions();
        $this->guideSupOptionModel = new GuideSupOptions();

        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }
	
    public function hotel($order_idx)
    {
/*		
        $order_idx       = updateSQ($_GET["order_idx"] ?? '');
        $titleStr        = "호텔 바우처관리";
        if ($order_idx) {
            $row = $this->orderModel->getOrderInfo($order_idx);
            write_log("호텔 바우처정보- ". $this->getLastQuery());
            $titleStr = "호텔 바우처정보";
        }

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

		if (!is_array($data)) {
			$data = []; // $data가 null이면 빈 배열로 설정
		}

		if (!is_array($row)) {
			$row = []; // $row가 null이면 빈 배열로 설정
		}
*/
		return view("voucher/voucher_hotel");
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