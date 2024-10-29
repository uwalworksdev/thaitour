<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminSpaController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function write_ok()
    {
        try {

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function get_code()
    {
        try {
            $depth = $this->request->getVar('depth');
            $parent_code_no = $this->request->getVar('parent_code_no');

            try {
                $sql = "SELECT * FROM tbl_code WHERE depth = ? AND parent_code_no = ? AND status = 'Y'";
                $query = $this->connect->query($sql, [$depth, $parent_code_no]);
                $results = $query->getResultArray();

                if (count($results) > 0) {
                    return $this->response->setJSON($results);
                }

                return $this->response->setJSON(['message' => '데이터를 찾을 수 없습니다']);
            } catch (\Exception $e) {
                return $this->response->setJSON(['error' => $e->getMessage()]);
            }
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function prod_update()
    {
        try {
            $product_idx = $_POST['product_idx'] ?? '';
            $product_best = $_POST['product_best'] ?? '';
            $special_price = $_POST['special_price'] ?? '';
            $is_view = $_POST['is_view'] ?? '';
            $onum = $_POST['onum'] ?? '';

            $sql = " UPDATE tbl_product_mst SET product_best = '$product_best', special_price = '$special_price', is_view = '$is_view', onum = '$onum' WHERE product_idx = '$product_idx' ";

            $result = $this->connect->query($sql);
            if ($result) {
                $msg = "수정 되었습니다!";
            } else {
                $msg = "수정 오류!";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function del()
    {
        try {
            if (!isset($_POST['product_idx'])) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON(
                        [
                            'status' => 'error',
                            'error' => '제품 ID가 설정되지 않았습니다!'
                        ]
                    );
            };

            $sql = '';
            $connect = $this->connect;
            $product_idx = $_POST['product_idx'];
            for ($i = 0; $i < count($product_idx); $i++) {
                $sql1 = $sql . " delete from tbl_product_mst where product_idx=" . $product_idx[$i] . " ";
                $db1 = $connect->query($sql1);
                if (!$db1) {
                    return $this->response
                        ->setStatusCode(400)
                        ->setJSON(
                            [
                                'status' => 'error',
                                'error' => '오류가 발생했습니다. 다시 시도해 주세요!'
                            ]
                        );
                }

                $sql1 = $sql .   " delete from tbl_product_yoil where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);

                $sql1 = $sql . " delete from tbl_product_air where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);

                $sql1 = $sql . " delete from tbl_product_day_detail where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);
            }
            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => '삭제 성공!'
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function ajax_change()
    {
        try {
            $code_idx = $this->request->getPost('code_idx');
            $onum = $this->request->getPost('onum');
            $is_view = $this->request->getPost('is_view');
            $product_best = $this->request->getPost('product_best');
            $special_price = $this->request->getPost('special_price');
            $tot = count($code_idx);
            $result = null;
            for ($j = 0; $j < $tot; $j++) {
                $sql = " update tbl_product_mst set is_view = '" . $is_view[$j] . "' , product_best = '" . $product_best[$j] . "' , special_price = '" . $special_price[$j] . "' , onum='" . $onum[$j] . "' where product_idx='" . $code_idx[$j] . "'";

                $result = $this->connect->query($sql);
            }

            if ($result) {
                $msg = "수정 되었습니다!";
            } else {
                $msg = "순위조정 오류!";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }
}
