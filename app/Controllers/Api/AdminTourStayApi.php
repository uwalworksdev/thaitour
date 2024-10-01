<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminTourStayApi extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function ajax_change()
    {
        try {
            $stay_idx = $this->request->getPost('stay_idx');
            $onum = $this->request->getPost('onum');

            $tot = count($stay_idx);
            for ($j = 0; $j < $tot; $j++) {

                $sql = " update tbl_product_stay set onum='" . $onum[$j] . "' where stay_idx='" . $stay_idx[$j] . "'";
                $result = $this->connect->query($sql);
            }

            if ($result) {
                $msg = "순위수정 되었습니다";
            } else {
                $msg = "순위조정 오류";
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

    public function get_code()
    {
        $depth = $this->request->getVar('depth');
        $parent_code_no = $this->request->getVar('parent_code_no');

        try {
            $sql = "SELECT * FROM tbl_code WHERE depth = ? AND parent_code_no = ? AND status = 'Y'";
            $query = $this->connect->query($sql, [$depth, $parent_code_no]);
            $results = $query->getResultArray();

            if (count($results) > 0) {
                return $this->response->setJSON($results);
            } else {
                return $this->response->setJSON(['message' => 'No data found']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function del()
    {
        try {
            if (!isset($_POST['stay_idx'])) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON(
                        [
                            'status' => 'error',
                            'error' => 'stay_idx is not set!'
                        ]
                    );
            };

            $connect = $this->connect;
            $stay_idx = $_POST['stay_idx'];

            foreach ($stay_idx as $iValue) {
                $sql1 = " delete from tbl_product_stay where stay_idx=" . $iValue . " ";
                $db1 = $connect->query($sql1);
                if (!$db1) {
                    return $this->response
                        ->setStatusCode(400)
                        ->setJSON(
                            [
                                'status' => 'error',
                                'error' => 'Error, please try again!'
                            ]
                        );
                }
            }
            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'Delete success!'
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function prod_update()
    {
        try {
            $stay_idx = $_POST['stay_idx'] ?? '';
            $product_best = $_POST['product_best'] ?? '';
            $special_price = $_POST['special_price'] ?? '';
            $is_view = $_POST['is_view'] ?? '';
            $onum = $_POST['onum'] ?? '';

            $sql = " UPDATE tbl_product_stay SET product_best = '$product_best', special_price = '$special_price', is_view = '$is_view', onum = '$onum' WHERE stay_idx = '$stay_idx' ";
            $result = $this->connect->query($sql);
            if ($result) {
                $msg = "수정 되었습니다";
            } else {
                $msg = "수정 오류";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }
}
