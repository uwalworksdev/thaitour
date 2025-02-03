<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use Exception;

class AdminCouponController extends BaseController
{
    private $couponMst;
    private $memberGrade;
    private $code;
    private $product;
    private $couponProduct;
    private $db;
    private $uploadPath = FCPATH . "data/coupon/";

    public function __construct()
    {
        $this->couponMst = model("CouponMst");
        $this->couponProduct = model("CouponProduct");
        $this->memberGrade = model("MemberGrade");
        $this->code = model("Code");
        $this->product = model("ProductModel");
        helper(['html']);
        $this->db = db_connect();
        helper('my_helper');
        helper('comment_helper');
    }

    public function list(){
        $g_list_rows = 10;
        $pg = updateSQ($this->request->getVar("pg") ?? '');
        $search_category = updateSQ($this->request->getVar("search_category") ?? '');
        $search_name = updateSQ($this->request->getVar("search_name") ?? '');

        $coupon = $this->couponMst->getCouponList($search_name, $search_category, $pg, $g_list_rows);

        return view('admin/_coupon/list', [
            "coupon_list" => $coupon["coupon_list"],
            "nTotalCount" => $coupon["nTotalCount"],
            "pg" => $coupon["pg"],
            "nPage" => $coupon["nPage"],
            "g_list_rows" => $coupon["g_list_rows"],
            "num" => $coupon["num"]
        ]);
    }

    public function write() {
        $idx = updateSQ($this->request->getVar("idx") ?? '');
        $row = null;
        $grade_list = $this->memberGrade->where("status", "Y")
                                        ->orderBy("onum", "desc")
                                        ->orderBy("g_idx", "asc")->findAll();
        $code_list = $this->code->getByParentCode("13")->getResultArray();
        $product_code_list = "";

        if ($idx) {
            $row = $this->couponMst->find($idx);
            $coupon_category_list = $this->couponProduct->where("coupon_idx", $idx)->findAll();
            foreach($coupon_category_list as $key => $value){
                $coupon_category_list[$key]["product_code_name_1"] = $this->code->getCodeName($value["product_code_1"]);
                $coupon_category_list[$key]["product_code_name_2"] = $this->code->getCodeName($value["product_code_2"]);
                $coupon_category_list[$key]["product_name"] = $this->product->getById($value["product_idx"])["product_name"];
                $product_code_list .= "|";
                $product_code_list .= $value["product_code_1"] . ",";
                $product_code_list .= $value["product_code_2"] . ",";
                $product_code_list .= $value["product_idx"] . "|";
            }
        }
        return view('admin/_coupon/write', [
            "row" => $row,
            "idx" => $idx,
            "grade_list" => $grade_list,
            "code_list" => $code_list,
            "coupon_category_list" => $coupon_category_list,
            "product_code_list" => $product_code_list
        ]);
    }

    public function write_ok() {
        try {
            $idx = updateSQ($this->request->getPost("idx"));
            $product_code_list = $this->request->getPost("product_code_list");
            $data = $this->request->getPost();
            $uploadPath = $this->uploadPath;

            $arr_type = $this->request->getPost("type_select") ?? [];
            $type_select = implode(",", $arr_type);
            $data["type_select"] = $type_select;    
            $files = $this->request->getFiles();

            for ($i = 1; $i <= 7; $i++) {
                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);

                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $data["ufile$i"] = "";
                    $data["rfile$i"] = "";

                } elseif ($files["ufile$i"]) {
                    $file = $files["ufile$i"];

                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = $file->getClientName();
                        $data["rfile$i"] = $fileName;

                        if (no_file_ext($fileName) == "Y") {
                            $microtime = microtime(true);
                            $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                            $date = date('YmdHis');
                            $ext = explode(".", strtolower($fileName));
                            $newName = $date . $timestamp . uniqid() . '.' . $ext[1];
                            $data["ufile$i"] = $newName; 
                            $file->move($uploadPath, $newName);
                        }
                    }
                }
            }

            if ($idx) {
                $result = $this->couponMst->updateData($idx, $data);

                $this->couponProduct->where("coupon_idx", $idx)->delete();

                if(!empty($product_code_list)){
                    $str_code = substr($product_code_list, 1, strlen($product_code_list) - 2);
                    $arr_code = explode("||", $str_code);
                    foreach($arr_code as $code){
                        if(!empty($code)){
                            $arr = explode(",", $code);
                            $product_code_1 = $arr[0];
                            $product_code_2 = $arr[1];
                            $product_idx = $arr[2];
                            $this->couponProduct->insertData([
                                "coupon_idx" => $idx,
                                "product_idx" => $product_idx,
                                "product_code_1" => $product_code_1,
                                "product_code_2" => $product_code_2,
                            ]);
                        }
                    }
                }

                if($result) {
                    $message = "수정되었습니다.";
                    return "<script>
                                alert('$message');
                                parent.location.reload();
                            </script>";
                }
            } else {
                $data["regdate"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                $insertId = $this->couponMst->insertData($data);
                if(!empty($insertId)){
                    if(!empty($product_code_list)){
                        $str_code = substr($product_code_list, 1, strlen($product_code_list) - 2);
                        $arr_code = explode("||", $str_code);
                        foreach($arr_code as $code){
                            if(!empty($code)){
                                $arr = explode(",", $code);
                                $product_code_1 = $arr[0];
                                $product_code_2 = $arr[1];
                                $product_idx = $arr[2];
                                
                                $this->couponProduct->insertData([
                                    "coupon_idx" => $insertId,
                                    "product_idx" => $product_idx,
                                    "product_code_1" => $product_code_1,
                                    "product_code_2" => $product_code_2,
                                ]);
                            }
                        }

                    }

                    $message = "정상적인 등록되었습니다.";
                    return "<script>
                                alert('$message');
                                parent.location.href='/AdmMaster/_coupon/list';
                            </script>";
                }
            }
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function delete() {
        try {
            $idx = $this->request->getPost("idx") ?? [];
            if (!$idx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => 'idx가 존재하지 않습니다'
                ], 400);
            }

            for ($i = 0; $i < count($idx); $i++) {
                $this->couponMst->updateData($idx[$i], ["state" => "C"]);
            }

            $message = "삭제 성공.";
            return $this->response->setJSON([
                'result' => true,
                'message' => $message
            ], 200);
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    
}
