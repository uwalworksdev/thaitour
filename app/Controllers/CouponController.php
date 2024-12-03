<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;
use CodeIgniter\I18n\Time;

class CouponController extends BaseController
{
    private $couponMst;
    private $memberGrade;
    private $code;
    private $product;
    private $couponProduct;
    public function __construct()
    {
        helper('my_helper');
        helper('comment_helper');

        $this->couponMst = model("CouponMst");
        $this->couponProduct = model("CouponProduct");
        $this->memberGrade = model("MemberGrade");
        $this->code = model("Code");
        $this->product = model("ProductModel");
    }

    public function list() {

        $code_list = $this->code->getByParentCode("13")->getResultArray();

        return view('coupon/list',[
            "code_list" => $code_list
        ]);
    }

    public function get_coupon_list() {
        $code = $this->request->getVar("code");
        $child_code = $this->request->getVar("child_code");

        $coupon_list = $this->couponMst->getCouponListAjax($code, $child_code, 1, 8);

        return $this->response->setJSON($coupon_list);
    }

    public function coupon_view() {
        $idx = $this->request->getVar("idx");

        $coupon = $this->couponMst->find($idx);
        $coupon_product = $this->couponProduct->where("coupon_idx", $idx)->findAll();
        $coupon["coupon_product_cnt"] = count($coupon_product);
        $arr_location = [];
        foreach($coupon_product as $row){
            $product_name = $this->product->getById($row["product_idx"])["product_name"];

            if(!empty($product_name)){
                array_push($arr_location, $product_name);
            }
        }

        $cnt_img = 0;

        for($i = 2; $i <= 7; $i++){
            if(!empty($coupon["ufile" . $i])){
                $cnt_img++;
            }
        }
        $coupon["cnt_img"] = $cnt_img;
        $coupon["location"] = implode(", ", $arr_location);

        $coupon["member_grade_name"] = $this->memberGrade->where("g_idx", $coupon["member_grade"])->first()["grade_name"];
        $coupon["coupon_contents"] = viewSQ($coupon["coupon_contents"]);
        return $this->response->setJSON($coupon);

    }
}