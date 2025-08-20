<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use App\Models\Drivers;
use App\Models\Guides;

class Tools extends BaseController
{
    protected $Code;
    protected $WishModel;
    protected $ProductModel;
    protected $driverModel;
    protected $sessionLib;
    protected $sessionChk;
    protected $guideModel;
    protected $reviewModel;
    protected $db;
    protected $member;


    public function __construct()
    {
        helper(['html']);
        $this->Code = model("Code");
        $this->WishModel = model("WishModel");
        $this->ProductModel = model("ProductModel");
        $this->driverModel = new Drivers();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        $this->guideModel = new Guides();
        $this->reviewModel = model('ReviewModel');
        $this->member = model("Member");

        $this->db = db_connect();

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

    public function get_review_code()
    {
        $member_Id = session('member.idx');

        $row_member = $this->member->getByIdx($member_Id);

        $str_query = "";

        if($row_member["is_review"] != "Y"){
            $str_query = " AND t3.m_idx = '$member_Id' AND t3.order_status = 'E' ";
        }

        $code = $_POST['code'];
        $depth = $_POST['depth'];
        $sql = "
            SELECT t1.*, t2.product_name, t3.order_idx FROM tbl_code as t1 
            LEFT JOIN tbl_product_mst as t2 ON t1.code_no = t2.product_code_2
            LEFT JOIN tbl_order_mst as t3 ON t3.product_idx = t2.product_idx
            LEFT JOIN tbl_member as t4 ON t4.m_idx = t3.m_idx  
            WHERE t1.parent_code_no = '$code' AND t1.depth = '$depth' AND t1.status = 'Y' $str_query
            GROUP BY t1.code_no ORDER BY t1.onum ASC, t1.code_idx ASC
        ";

        $result = $this->db->query($sql);

        // $result = $this->Code->getByParentAndDepth($code, $depth);
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
        $s_code = $_POST['s_code'];

        if ($product_code == "132404" && $s_code == "D") {
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

        foreach ($result as $row) {
            $data .= "<option value='" . $row["product_idx"] . "'>" . viewSQ($row["product_name"] != '' ? $row["product_name"] : $row["special_name"]) . "</option>";
        }

        return json_encode([
            "data" => $data,
            "cnt" => $cnt
        ], JSON_THROW_ON_ERROR);
    }

    public function get_list_product_review() {
        $product_code = $_POST['product_code'];
        $s_code = $_POST['s_code'];
        $member_Id = session('member.idx');

        $row_member = $this->member->getByIdx($member_Id);

        if ($product_code == "132404" && $s_code == "D") {
            $result = $this->driverModel->listAll();
        } else {
            $builder = $this->ProductModel
                ->select('t1.*')
                ->join('tbl_order_mst as t2', 't1.product_idx = t2.product_idx', 'left')
                ->groupStart()
                ->where('t1.product_status !=', 'D')
                ->where('t1.product_status !=', 'S')
                ->where('t1.product_status !=', 'stop')
                ->groupEnd()
                ->groupStart()
                ->where('t1.product_code_2', $product_code)
                ->orLike('t1.product_code_list', '|' . $product_code)
                ->groupEnd();
            if($row_member["is_review"] != "Y") {
                $builder->groupStart()
                        ->where('t2.m_idx', $member_Id)
                        ->where('t2.order_status', 'E')
                        ->groupEnd();
            }

            $builder->groupBy('t1.product_idx')
                    ->findAll();

            echo $this->db->getLastQuery();
        }

        $cnt = count($result);
        $data = "";
        if ($cnt == 0) {
            $data .= "<option value=''>선택</option>";
        }

        foreach ($result as $row) {
            $data .= "<option value='" . $row["product_idx"] . "'>" . viewSQ($row["product_name"] != '' ? $row["product_name"] : $row["special_name"]) . "</option>";
        }

        return json_encode([
            "data" => $data,
            "cnt" => $cnt
        ], JSON_THROW_ON_ERROR);
    }

    public function get_list_code_type_review()
    {
        try {
            $res = [];

            $product_idx = $this->request->getVar("product_idx");
            $idx = $this->request->getVar("idx");
            $review_type = $this->request->getVar('review_type');
            if ($idx) {
                $review = $this->reviewModel->find($idx);
                $product_code_1 = $review['travel_type'];
                $product_code_2 = $review['travel_type_2'];
                $product_code_3 = $review['travel_type_3'];

                $type = 2;

                if ($product_code_1 == '1324' && $product_code_2 == '132404') {
                    $type = 3;

                    $review_type = $review['review_type'];
                    $review_type_arr = explode('|', $review_type);

                    $product_code_3 = 'D';

                    $code_no = $review_type_arr[0] == '' ? $review_type_arr[1] : $review_type_arr[0];

                    if (strpos($code_no, '4202') === 0) {
                        $product_code_3 = 'C';
                    } elseif (strpos($code_no, '4209') === 0) {
                        $product_code_3 = 'D';
                    }
                }

                $list_code_type = $this->check_list_code_type($type, $product_code_1, $product_code_2, $product_code_3);
            } else {
                if (!$product_idx) {
                    $product_code_1 = $this->request->getVar('product_code_1');
                    $product_code_2 = $this->request->getVar('product_code_2');
                    $product_code_3 = $this->request->getVar('product_code_3');
                    $type = $this->request->getVar('type');

                    $list_code_type = $this->check_list_code_type($type, $product_code_1, $product_code_2, $product_code_3);
                } else {
                    $product = $this->ProductModel->find($product_idx);
                    $product_code_1 = $product['product_code_1'];
                    $product_code_2 = $product['product_code_2'];
                    $product_code_3 = $product['product_code_3'];

                    $list_code_type = $this->check_list_code_type(2, $product_code_1, $product_code_2, $product_code_3);
                }
            }

            $review_type_arr = explode('|', $review_type);

            foreach ($list_code_type as &$item) {
                $item['checked'] = in_array($item['code_no'], $review_type_arr) ? 'checked' : '';
            }

            $res['codes'] = $list_code_type;
            return $this->response->setJSON([
                'result' => true,
                'status' => 'success',
                'data' => $res,
                'message' => ''
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    private function check_list_code_type($type, $product_code_1, $product_code_2, $product_code_3)
    {
        $db = \Config\Database::connect();
        $list_code_type = [];
        if ($type == 2) {
            if ($product_code_1 == 1303) {
                $sql = "SELECT * FROM tbl_code WHERE parent_code_no='4203' ORDER BY onum ";
                $list_code_type = $db->query($sql)->getResultArray();
            } elseif ($product_code_1 == 1302) {
                $sql = "SELECT * FROM tbl_code WHERE parent_code_no='4204' ORDER BY onum ";
                $list_code_type = $db->query($sql)->getResultArray();
            } elseif ($product_code_1 == 1301) {
                $sql = "SELECT * FROM tbl_code WHERE parent_code_no='4205' ORDER BY onum ";
                $list_code_type = $db->query($sql)->getResultArray();
            } elseif ($product_code_1 == 1325) {
                $sql = "SELECT * FROM tbl_code WHERE parent_code_no='4206' ORDER BY onum ";
                $list_code_type = $db->query($sql)->getResultArray();
            } elseif ($product_code_1 == 1317) {
                $sql = "SELECT * FROM tbl_code WHERE parent_code_no='4207' ORDER BY onum ";
                $list_code_type = $db->query($sql)->getResultArray();
            } elseif ($product_code_1 == 1320) {
                $sql = "SELECT * FROM tbl_code WHERE parent_code_no='4208' ORDER BY onum ";
                $list_code_type = $db->query($sql)->getResultArray();
            }
        } elseif ($type == 3) {
            if ($product_code_2 == 132404 && $product_code_3 == 'D') {
                $sql = "SELECT * FROM tbl_code WHERE parent_code_no='4209' ORDER BY onum ";
                $list_code_type = $db->query($sql)->getResultArray();
            } elseif ($product_code_2 == 132404 && $product_code_3 == 'C') {
                $sql = "SELECT * FROM tbl_code WHERE parent_code_no='4202' ORDER BY onum ";
                $list_code_type = $db->query($sql)->getResultArray();
            }
        }

        return $list_code_type;
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