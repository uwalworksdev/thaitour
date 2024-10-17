<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class Tools extends BaseController
{
    protected $Code;
    protected $WishModel;
    protected $ProductModel;
    protected $sessionLib;
    protected $sessionChk;
    public function __construct()
    {
        helper(['html']);
        $this->Code = model("Code");
        $this->WishModel = model("WishModel");
        $this->ProductModel = model("ProductModel");
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
    }
    public function generate_captcha()
    {
        header('Content-Type: application/json');
        $captcha_info = createAndUpdateCaptcha();
        return json_encode($captcha_info);
    }
    public function get_travel_types()
    {
        $code = $_POST['code'];
        $depth = $_POST['depth'];
        $result = $this->Code->getByParentAndDepth($code, $depth);
        $cnt = $result->getNumRows();
        $data = "";
        $data .= "<option value=''>선택</option>";
        foreach ($result->getResultArray() as $row) {
            $data .= "<option value='$row[code_no]'>$row[code_name]</option>";
        }
        return json_encode([
            "data" => $data,
            "cnt" => $cnt
        ]);
    }
    public function get_list_product()
    {
        $product_code = $_POST['product_code'];

        $result = $this->ProductModel->where('product_code_3', $product_code)->findAll();
        $cnt = count($result);
        $data = "";
        if ($cnt == 0) {
            $data .= "<option value=''>선택</option>";
        }

        foreach ($result as $row) {
            $data .= "<option value='" . $row["product_idx"] . "'>" . viewSQ($row["product_name"]) . "</option>";
        }

        return json_encode([
            "data" => $data,
            "cnt" => $cnt
        ]);
    }
    public function wish_set()
    {
        $product_idx = $_POST["product_idx"];
        if ($_SESSION["member"]["idx"] == "") {
            $msg = "로그인 하셔야 합니다.";
            return "{\"message\":\"$msg\"}";
        }
        $cnt = $this->WishModel->getWishCnt($_SESSION["member"]["idx"], $product_idx);
        if ($cnt > 0) {
            $cnt = $this->WishModel->deleteWish([
                "m_idx" => $_SESSION["member"]["idx"],
                "product_idx" => $product_idx
            ]);
            $msg = "찜하기 삭제 하셨습니다.";
            return "{\"message\":\"$msg\"}";
        }

        $result = $this->WishModel->insertWish([
            "m_idx" => $_SESSION["member"]["idx"],
            "product_idx" => $product_idx,
            "wish_r_date" => date("Y-m-d H:i:s")
        ]);

        if ($result) {
            $msg = "찜하기 추가되었습니다.";
        } else {
            $msg = "오류발생.";
        }

        return "{\"message\":\"$msg\"}";
    }
    public function del_wish() {
        $idx = $_POST["idx"];
        if (is_array($idx)) {
            $this->WishModel->deleteWish($idx);
        }
        return "OK";
    }
}