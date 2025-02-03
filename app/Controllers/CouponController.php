<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;
use CodeIgniter\I18n\Time;

class CouponController extends BaseController
{
    private $couponMst;
    private $coupon;
    private $memberGrade;
    private $code;
    private $product;
    private $couponProduct;
    public function __construct()
    {
        helper('my_helper');
        helper('comment_helper');
        helper('coupon_helper');

        $this->couponMst = model("CouponMst");
        $this->coupon = model("Coupon");
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
        $page = $this->request->getVar("page");

        $coupon_list = $this->couponMst->getCouponListAjax($code, $child_code, $page, 8);

        return $this->response->setJSON($coupon_list);
    }

    public function coupon_view() {
        $idx = $this->request->getVar("idx");

        $user_id = session()->get("member")["id"];

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


        $is_use = 'N';

        if(createCouponMemberExpDays($idx) < 1){
            $is_use = 'D';
        }else{
            if(!empty($user_id)){
                if(createCouponMemberChk($idx, $user_id) >= 1){
                    $is_use = 'Y';
                }
            }
        }

        $coupon["is_use"] = $is_use;

        return $this->response->setJSON($coupon);
    }

    public function add_coupon_member() {

        try{
            $coupon_idx = $this->request->getPost("coupon_idx");

            $user_id = session()->get("member")["id"];

            if(empty($user_id)){
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "쿠폰을 적용하려면 로그인하세요."
                ]);
            }
            
            if(empty($coupon_idx)){
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "제품을 찾을 수 없습니다."
                ]);
            }

            if(createCouponMemberExpDays($coupon_idx) < 1){
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "쿠폰이 만료되었습니다."
                ]);
            }

            if(createCouponMemberChk($coupon_idx, $user_id) >= 1){
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "이 쿠폰을 이미 다운받았습니다."
                ]);
            }

            $coupon = $this->couponMst->find($coupon_idx);

            $_couponNum = createCouponNum();
    
            while (createCouponChk($_couponNum) >= 1) {
                $_couponNum = createCouponNum();
            }
    
            $last_idx = createLastIdx();

            $insertId = $this->coupon->insertData([
                "coupon_num" => $_couponNum,
                "coupon_mst_idx" => $coupon_idx,
                "types" => "N",
                "user_id" => $user_id,
                "status" => "N",
                "last_idx" => $last_idx,
                "regdate" => Time::now('Asia/Seoul', 'en_US')->toDateTimeString(),
                "enddate" => date("Y-m-d", strtotime($coupon["exp_end_day"]))
            ]);

            if($insertId){
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "쿠폰이 추가되었습니다."
                ]);
            }else{
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "쿠폰이 아직 추가되지 않았습니다."
                ]);
            }

        }catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ]);
        }
        
    }
}