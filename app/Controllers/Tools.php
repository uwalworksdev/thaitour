<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use App\Models\Drivers;

class Tools extends BaseController
{
    protected $Code;
    protected $WishModel;
    protected $ProductModel;
    protected $driverModel;
    protected $sessionLib;
    protected $sessionChk;

    public function __construct()
    {
        helper(['html']);
        $this->Code = model("Code");
        $this->WishModel = model("WishModel");
        $this->ProductModel = model("ProductModel");
        $this->driverModel = new Drivers();
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

        if ($product_code == "132403") {
            $result = $this->driverModel->listAll();
        } else {
            $result = $this->ProductModel
                ->groupStart()
                ->where('product_status !=', 'D')
                ->where('product_status !=', 'S')
                ->where('product_status !=', 'stop')
                ->groupEnd()
                ->groupStart()
                ->where('product_code_2', $product_code)
                ->orLike('product_code_list', '|' . $product_code)
                ->groupEnd()
                ->findAll();
        }

        $cnt = count($result);
        $data = "";
        if ($cnt == 0) {
            $data .= "<option value=''>선택</option>";
        }

        if ($product_code == "132403") {
            foreach ($result as $row) {
                $data .= "<option value='" . $row["d_idx"] . "'>" . viewSQ($row["special_name"]) . "</option>";
            }
        } else {
            foreach ($result as $row) {
                $data .= "<option value='" . $row["product_idx"] . "'>" . viewSQ($row["product_name"]) . "</option>";
            }
        }

        return json_encode([
            "data" => $data,
            "cnt" => $cnt
        ], JSON_THROW_ON_ERROR);
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

    public function del_wish()
    {
        $idx = $_POST["idx"];
        if (is_array($idx)) {
            $this->WishModel->deleteWish($idx);
        }
        return "OK";
    }
}