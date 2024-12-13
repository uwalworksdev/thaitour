<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminProductApi extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $hotelOptionModel;
    private $memberModel;
    private $CodeModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
        $this->hotelOptionModel = model("HotelOptionModel");
        $this->memberModel = new \App\Models\Member();
        $this->CodeModel = model("Code");
    }

    public function write_price_ok()
    {
        try {
            $product_idx = $_POST["product_idx"];

            if (!$product_idx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => '제품을 찾을 수 없습니다!!'
                ])->setStatusCode(400);
            }

            $data['original_price'] = updateSQ($_POST["original_price"] ?? '');
            $data['product_price'] = updateSQ($_POST["product_price"] ?? '');
            $data['product_code'] = updateSQ($_POST["product_code"] ?? '');

            $o_idx = $_POST["o_idx"] ?? [];
            $o_name = $_POST["o_name"] ?? [];
            $o_price1 = $_POST["o_price1"] ?? [];
            $o_price2 = $_POST["o_price2"] ?? [];
            $o_sdate = $_POST["o_sdate"] ?? [];
            $o_edate = $_POST["o_edate"] ?? [];
            $o_room = $_POST["o_room"] ?? [];
            $option_type = $_POST["option_type"] ?? [];
            $o_soldout = $_POST["o_soldout"] ?? [];

            $rop_idx = $_POST["rop_idx"] ?? [];
            $sup_room__idx = $_POST["sup_room__idx"] ?? [];
            $sup_room__name = $_POST["sup_room__name"] ?? [];
            $sup__key = $_POST["sup__key"] ?? [];
            $sup__name = $_POST["sup__name"] ?? [];
            $sup__price = $_POST["sup__price"] ?? [];
            $sup__price_sale = $_POST["sup__price_sale"] ?? [];

            $min_date = date('Y-m-d');
            $max_date = date('Y-m-d');

            foreach ($o_idx as $key => $val) {
                $sql_chk = "
					select count(*) as cnts
					  from tbl_hotel_option
					 where idx	= '" . $val . "'
					";
                $result_chk = $this->connect->query($sql_chk);
                $row_chk = $result_chk->getRowArray();

                if ($row_chk) {
                    // 이미 등록된 옵션이 아니라면...
                    $item_name = $o_name[$key] ?? '';
                    $item_price1 = $o_price1[$key] ?? '';
                    $item_price2 = $o_price2[$key] ?? '';
                    $item_sdate = $o_sdate[$key] ?? '';
                    $item_edate = $o_edate[$key] ?? '';
                    $item_room = $o_room[$key] ?? '';
                    $item_type = $option_type[$key] ?? '';
                    $item_soldout = $o_soldout[$key] ?? '';

                    if ($item_sdate <= $min_date) {
                        $min_date = $item_sdate;
                    }
                    if ($max_date <= $item_edate) {
                        $max_date = $item_edate;
                    }

                    if ($row_chk['cnts'] < 1) {
                        $sql_su = "insert into tbl_hotel_option SET
                                         goods_code		= '" . $data['product_code'] . "'
                                        ,goods_name		= '" . $item_name . "'
                                        ,goods_price1	= '" . $item_price1 . "'
                                        ,goods_price2	= '" . $item_price2 . "'
                                        ,o_sdate		= '" . $item_sdate . "'
                                        ,o_edate		= '" . $item_edate . "'
                                        ,o_room			= '" . $item_room . "'
                                        ,option_type	= '" . $item_type . "'
                                        ,o_soldout		= '" . $item_soldout . "'
                                ";
                        write_log("1- " . $sql_su);
                        $this->connect->query($sql_su);

                        $sql_opt = "SELECT LAST_INSERT_ID() AS last_id";
                        $option = $this->connect->query($sql_opt)->getRowArray();
                        $option_idx = $option['last_id'];

                        $dateRange = getDateRange($item_sdate, $item_edate);

                        $ii = -1;
                        foreach ($dateRange as $date) {
                            $ii++;

                            $goods_date = $dateRange[$ii];
                            $dow = dateToYoil($goods_date);

                            $sql_c = "INSERT INTO tbl_hotel_price  SET  
																	  o_idx        = '" . $option_idx . "' 	
																	 ,goods_code   = '" . $data['product_code'] . "' 	
																	 ,goods_name   = '" . $item_name . "'
																	 ,goods_date   = '" . $goods_date . "'
																	 ,dow 	       = '" . $dow . "'
																	 ,goods_price1 = '" . $item_price1 . "' 
																	 ,goods_price2 = '" . $item_price2 . "'
																	 ,use_yn       = ''
																	 ,o_sdate 	   = '" . $item_sdate . "'
																	 ,o_edate      = '" . $item_edate . "'
																	 ,reg_date     = now() ";
                            write_log("가격정보-1 : " . $sql_c);
                            $this->connect->query($sql_c);
                        }
                    } else {
                        $sql_su = "update tbl_hotel_option SET 
                                         goods_name		= '" . $item_name . "'
                                        ,goods_price1	= '" . $item_price1 . "'
                                        ,goods_price2	= '" . $item_price2 . "'
                                        ,o_sdate		= '" . $item_sdate . "'
                                        ,o_edate		= '" . $item_edate . "'
                                        ,o_room			= '" . $item_room . "'
                                        ,option_type	= '" . $item_type . "'
                                        ,o_soldout		= '" . $item_soldout . "'
                                    where idx	= '" . $val . "'
                                ";

                        $this->connect->query($sql_su);
                    }
                }
            }

            foreach ($rop_idx as $key => $val) {
                $sql_chk = "
					select count(*) as cnts
					    from tbl_room_options
					    where rop_idx	= '" . $val . "'
					";
                $result_chk = $this->connect->query($sql_chk);
                $row_chk = $result_chk->getRowArray();

                if ($row_chk) {
                    // 이미 등록된 옵션이 아니라면...
                    $r_key = $sup__key[$key] ?? '';
                    $r_name = $sup_room__name[$key] ?? '';
                    $r_val = $sup__name[$key] ?? '';
                    $r_price = $sup__price[$key] ?? '';
                    $r_sale_price = $sup__price_sale[$key] ?? '';

                    $r_idx = $sup_room__idx[$key] ?? '';

                    if ($row_chk['cnts'] < 1) {
                        $sql_su = "insert into tbl_room_options SET
                                         r_key		= '" . $r_key . "'
                                        ,r_val		= '" . $r_val . "'
                                        ,r_price	= '" . $r_price . "'
                                        ,r_sale_price		= '" . $r_sale_price . "'
                                        ,r_created_at		= '" . date('Y-m-d H:i:s') . "'
                                        ,h_idx			= '" . $product_idx . "'
                                        ,r_idx	= '" . $r_idx . "'
                                        ,r_name		= '" . $r_name . "'
                                ";

                        $this->connect->query($sql_su);


                    } else {
                        $sql_su = "update tbl_room_options SET 
                                         r_key		    = '" . $r_key . "'
                                        ,r_val	        = '" . $r_val . "'
                                        ,r_price		= '" . $r_price . "'
                                        ,r_sale_price	= '" . $r_sale_price . "'
                                        ,h_idx			= '" . $product_idx . "'
                                        ,r_idx	        = '" . $r_idx . "'
                                        ,r_name		    = '" . $r_name . "'
                                    where rop_idx	    = '" . $val . "'
                                ";

                        $this->connect->query($sql_su);
                    }
                }
            }

            $data['min_date'] = strval($min_date);
            $data['max_date'] = strval($max_date);
            $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

            $this->productModel->update($product_idx, $data);

            $message = "수정되었습니다(Hotel).";
            return "<script>
                    alert('$message');
                    parent.location.reload();
                    </script>";


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }
}
