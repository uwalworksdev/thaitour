<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminTourApi extends BaseController
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
            $code_idx = $this->request->getPost('code_idx');
            $onum = $this->request->getPost('onum');
            $is_view = $this->request->getPost('is_view');
            $product_best = $this->request->getPost('product_best');
            $special_price = $this->request->getPost('special_price');
            $product_status = $this->request->getPost('product_status');
            $tot = count($code_idx);
            $result = null;
            for ($j = 0; $j < $tot; $j++) {
                $sql = " update tbl_product_mst set is_view = '" . $is_view[$j] . "' , product_best = '" . $product_best[$j] . "' , 
                special_price = '" . $special_price[$j] . "' , onum='" . $onum[$j] . "', product_status='" . $product_status[$j] . "' where product_idx='" . $code_idx[$j] . "'";

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

    public function get_code()
    {
        $depth = $this->request->getVar('depth');
        $parent_code_no = $this->request->getVar('parent_code_no');

        try {
            $sql = "SELECT * FROM tbl_code WHERE depth = ? AND parent_code_no = ? AND status = 'Y' ORDER BY onum ASC, code_idx DESC";
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
            if (!isset($_POST['product_idx'])) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON(
                        [
                            'status' => 'error',
                            'error' => 'Product_idx is not set!'
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
                                'error' => 'Error, please try again!'
                            ]
                        );
                }

                $sql1 = $sql . " delete from tbl_product_yoil where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);

                $sql1 = $sql . " delete from tbl_product_air where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);

                $sql1 = $sql . " delete from tbl_product_day_detail where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);
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
            $product_idx = $_POST['product_idx'] ?? '';
            $product_best = $_POST['product_best'] ?? '';
            $special_price = $_POST['special_price'] ?? '';
            $is_view = $_POST['is_view'] ?? '';
            $product_status = $_POST['product_status'];
            $onum = $_POST['onum'] ?? '';

            $sql = " UPDATE tbl_product_mst SET product_best = '$product_best', special_price = '$special_price', is_view = '$is_view', onum = '$onum' WHERE product_idx = '$product_idx' ";
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

    public function ajax_del()
    {
        try {
            $msg = '';

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

    public function change_manager()
    {
        try {
            $msg = '';

            $private_key = private_key();

            $user_id = $_POST['user_id'];

            $sql = " SELECT AES_DECRYPT(UNHEX(user_name), '$private_key') AS user_name
                    ,AES_DECRYPT(UNHEX(user_phone), '$private_key') AS user_phone
                    ,AES_DECRYPT(UNHEX(user_email), '$private_key') AS user_email
            FROM tbl_member WHERE user_id = '$user_id'";

            $result = $this->connect->query($sql);

            $row = $result->getRowArray();

            $resultArr['user_name'] = $row["user_name"];
            $resultArr['user_phone'] = $row["user_phone"];
            $resultArr['user_email'] = $row["user_email"];

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'data' => $row,
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

    public function add_moption()
    {
        try {
            $product_idx = $_POST['product_idx'];
            $moption_name = $_POST['moption_name'];

            $sql = "INSERT INTO tbl_tours_moption SET  product_idx  = '$product_idx'
                                        	 , moption_name = '$moption_name'
                                        	 , use_yn       = 'Y' 
											 , rdate        =  now() ";

            $this->connect->query($sql);

            $msg = "등록 완료.";

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

    public function upd_moption()
    {
        try {
            $code_idx = $_POST['code_idx'];
            $moption_name = $_POST['moption_name'];

            $sql = "UPDATE tbl_tours_moption SET moption_name = '$moption_name' WHERE code_idx = '$code_idx' ";

            $this->connect->query($sql);

            $msg = "등록 완료.";

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

    public function del_moption()
    {
        try {
            $code_idx = $_POST['code_idx'];

            $sql = "DELETE FROM tbl_tours_moption WHERE code_idx = '$code_idx' ";

            $this->connect->query($sql);

            $msg = "등록 완료.";

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

    public function add_option()
    {
        try {
            $code_idx = $_POST['code_idx'];
            $product_idx = $_POST['product_idx'];
            $option_cnt = count($_POST['o_name']);

            $sql = "delete from tbl_tours_option where code_idx = '" . $code_idx . "'  and product_idx = '" . $product_idx . "' ";

            $this->connect->query($sql);

            for ($i = 0; $i < $option_cnt; $i++) {
                $option_name = $_POST['o_name'][$i];
                $option_price = $_POST['o_price'][$i];
                $use_yn = $_POST['use_yn'][$i];
                $onum = $_POST['o_num'][$i];

                if ($option_name && $option_price) {
                    $sql = "insert into tbl_tours_option set   code_idx     = '$code_idx'  
													 , product_idx  = '$product_idx' 
													 , option_name  = '$option_name'
													 , option_price = '$option_price'
													 , use_yn       = '$use_yn'
													 , onum         = '$onum'
													 , rdate        =  now()		  
				   ";

                    $this->connect->query($sql);
                }
            }

            $msg = "등록 완료.";

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

    public function del_option()
    {
        try {
            $msg = "등록 완료.";

            $idx = $_POST['idx'];

            $sql = "DELETE FROM tbl_tours_option  WHERE idx = '$idx' ";

            $this->connect->query($sql);

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

    public function upd_option()
    {
        try {
            $msg = "등록 완료.";

            $idx = $_POST['idx'];
            $option_name = $_POST['option_name'];
            $option_price = $_POST['option_price'];
            $use_yn = $_POST['use_yn'];
            $onum = $_POST['onum'];

            $sql = "UPDATE tbl_tours_option SET   option_name  = '$option_name'
										, option_price = '$option_price'
										, use_yn       = '$use_yn'
	                                    , onum         = '$onum'
	                                    WHERE      idx = '$idx' ";

            $this->connect->query($sql);

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

    public function img_remove()
    {
        try {
            $msg = '';

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
