<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminCarsController extends BaseController
{
    protected $connect;
    protected $productModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
    }

    public function list()
    {
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? 1);
        $search_txt = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy = $_GET["orderBy"] ?? "";

        $where = [
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'orderBy' => $orderBy,
            'product_code_1' => 1324,
        ];

        $orderByArr = [];

        if ($orderBy == 1) {
            $orderByArr['onum'] = "DESC";
        } elseif ($orderBy == 2) {
            $orderByArr['r_date'] = "DESC";
        }

        $result = $this->productModel->findProductPaging($where, $g_list_rows, $pg, $orderByArr);

        $data = [
            'result' => $result['items'],
            'orderBy' => $orderBy,
            'num' => $result['num'],
            'nTotalCount' => $result['nTotalCount'],
            'nPage' => $result['nPage'],
            'pg' => $pg,
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'g_list_rows' => $g_list_rows,
        ];
        return view("admin/_cars/list", $data);
    }

    public function write()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? '');
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? '');

        $fsql = "select * from tbl_code where code_gubun = 'tour' and code_no = '1324'";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $csql = "select * from tbl_code where parent_code_no = '47'";
        $cfresult = $this->connect->query($csql);
        $cfresult = $cfresult->getResultArray();

        if ($product_idx) {
            $row = $this->productModel->find($product_idx);
        }
        
        $osql = "select * from tbl_cars_option where product_code = '" . $row["product_code"] . "'";
        $oresult = $this->connect->query($osql);
        $oresult = $oresult->getResultArray();

        $data = [
            'product_idx' => $product_idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            'row' => $row ?? '',
            'fresult' => $fresult,
            'cfresult' => $cfresult,
            'options' => $oresult
        ];
        return view("admin/_cars/write", $data);
    }

    public function write_ok($product_idx = null)
    {
        try {
            $files = $this->request->getFiles();
            $data['product_code_list'] = updateSQ($_POST["product_code_list"] ?? '');
            $data['product_code'] = updateSQ($_POST["product_code"] ?? '');
            $data['product_name'] = updateSQ($_POST["product_name"] ?? '');
            $data['keyword'] = updateSQ($_POST["keyword"] ?? '');
            $data['product_status'] = updateSQ($_POST["product_status"] ?? '');
            $data['original_price'] = updateSQ($_POST["original_price"] ?? 0);
            $data['product_price'] = updateSQ($_POST["product_price"] ?? 0);
            $data['product_info'] = updateSQ($_POST["product_info"] ?? '');
            $data['product_best'] = updateSQ($_POST["product_best"] ?? 'N');
            $data['special_price'] = updateSQ($_POST["special_price"] ?? 'N');
            $data['is_view'] = "Y";

            $o_idx = $_POST["option_idx"] ?? [];
            $c_op_type = $_POST["c_op_type"] ?? [];
            $c_op_name = $_POST["c_op_name"] ?? [];

            for ($i = 1; $i <= 7; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                if (isset(${"del_" . $i}) && ${"del_" . $i} === "Y") {
                    $this->productModel->update($product_idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $publicPath = ROOTPATH . '/public/data/cars/';
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }


            if ($product_idx) {

                foreach ($o_idx as $key => $val) {
                    $sql_chk = " select count(*) as cnts from tbl_cars_option where idx = '" . $val . "'";
                    $result_chk = $this->connect->query($sql_chk);
                    $row_chk = $result_chk->getRowArray();

                    if ($row_chk) {

                        if ($row_chk['cnts'] < 1) {
                            $sql_su = "insert into tbl_cars_option SET
                                         product_code	= '" . $data['product_code'] . "'
                                        ,c_op_name		= '" . $c_op_name[$key] . "'
                                        ,c_op_type	    = '" . $c_op_type[$key] . "'
                                ";

                            $this->connect->query($sql_su);

                        } else {
                            $sql_su = "update tbl_cars_option SET 
                                         c_op_name		= '" . $c_op_name[$key] . "'
                                        ,c_op_type	    = '" . $c_op_type[$key] . "'
                                    where idx	= '" . $val . "'
                                ";

                            $this->connect->query($sql_su);
                        }
                    }
                }

                // 상품 테이블 변경
                $this->productModel->update($product_idx, $data);

            } else {
                // 옵션 등록
                foreach ($o_idx as $key => $val) {

                    $sql_su = "insert into tbl_cars_option SET
                                     product_code	= '" . $data['product_code'] . "'
                                    ,c_op_name		= '" . $c_op_name[$key] . "'
                                    ,c_op_type	    = '" . $c_op_type[$key] . "'
                            ";

                    $this->connect->query($sql_su);

                }

                $data['product_code_1'] = '1324';

                $this->productModel->insert($data);

            }

            if ($product_idx) {
                $message = "수정되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.reload();
                    </script>";
            } else {
                $message = "등록되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.href='/AdmMaster/_cars/list';
                    </script>";
            }


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function change()
    {
        try {
            $product_idx = $_POST['code_idx'] ?? '';
            $onum = $_POST['onum'] ?? '';

            $tot = count($product_idx);
            for ($j = 0; $j < $tot; $j++) {
                $sql = " update tbl_product_mst set onum='" . $onum[$j] . "' where product_idx='" . $product_idx[$j] . "'";
                $db = $this->connect->query($sql);
                if (!$db) {
                    return $this->response
                        ->setStatusCode(400)
                        ->setJSON(
                            [
                                'status' => 'error',
                                'message' => '수정 중 오류가 발생했습니다!!'
                            ]
                        );
                }
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'message' => '수정 했습니다.'
                    ]
                );

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function delete()
    {
        try {
            $idx = $_POST['product_idx'] ?? '';
            if (!isset($idx)) {
                $data = [
                    'status' => 'error',
                    'error' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            foreach ($idx as $iValue) {
                $sql1 = " update tbl_product_mst set product_status = 'D' where product_idx = '" . $iValue . "' ";
                $db1 = $this->connect->query($sql1);
                if (!$db1) {
                    $data = [
                        'status' => 'error',
                        'error' => 'error!'
                    ];
                    return $this->response->setJSON($data, 400);
                }
            }

            $data = [
                'status' => 'success',
                'message' => 'delete success!'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del_cars_option()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'idx가 없습니다.'
                ], 400);
            }

            $sql = "DELETE FROM tbl_cars_option WHERE idx = " . $idx;
            $this->connect->query($sql);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => '삭제되었습니다.'
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

}
