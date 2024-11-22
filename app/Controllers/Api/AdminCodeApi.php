<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminCodeApi extends BaseController
{
    protected $connect;
    protected $codeModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->codeModel = model("Code");
        helper('my_helper');
        helper('alert_helper');
    }

    public function comment_proc()
    {
        $r_idx = updateSQ($_POST["r_idx"] ?? '');
        $r_content = updateSQ($_POST["comment"] ?? '');
        $r_code = $_POST["r_code"] ?? '';
        $user_id = $_SESSION['member']['id'] ?? '';
        $r_m_idx = $_SESSION['member']['idx'] ?? '';
        $r_name = $_SESSION['member']['name'] ?? '';
        $r_level = $_SESSION['member']['level'] ?? '';

        var_dump($user_id);
        die();
        if ($user_id == "") {
            echo "";
            exit;
        }

        $sql = "
                insert into tbl_bbs_cmt SET 
                    r_idx		    = '" . $r_idx . "'	
                    ,r_code			= '" . $r_code . "'	
                    ,r_m_idx		= '" . $r_m_idx . "'
                    ,r_name		    = '" . $r_name . "'		
                    ,r_content		= '" . $r_content . "'	
                    ,r_reg_date       = NOW()
                    ,r_level        = '1'
                    ,r_step         = '1'        
                    ,r_delYN        = 'N'
                    ,r_status       = 'Y'
            ";
        $result = $this->connect->query($sql);

// 알림등록
        if ($result) {
            return $this->response->setJSON(
                $data = [
                    'result' => 'success',
                    'msg' => 'success',
                    'data' => '',
                    'code' => 200
                ], 200
            );
        }

        return $this->response->setJSON(
            $data = [
                'result' => 'fail',
                'msg' => 'fail',
                'data' => '',
                'code' => 400
            ], 400
        );
    }

    public function bbs_change()
    {
        try {
            $bbs_idx = $_POST['bbs_idx'] ?? [];
            $onum = $_POST['onum'] ?? [];

            if (empty($bbs_idx)) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status' => 'error',
                        'message' => 'No bbs_idx provided'
                    ]);
            }

            $tot = count($bbs_idx);
            for ($j = 0; $j < $tot; $j++) {

                $sql = " update tbl_bbs_list set onum='" . $onum[$j] . "' where bbs_idx='" . $bbs_idx[$j] . "'";
                $result = $this->connect->query($sql);
            }

            if (isset($result) && $result) {
                $msg = "순위변경 완료";
            } else {
                $msg = "순위변경 오류";
            }

            return $this->response
                ->setStatusCode(200)
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

    public function code_del()
    {
        try {
            $code_idx = $_POST['code_idx'];

            $childCnt = $this->codeModel->getTotalCount($code_idx);

			if ($childCnt == 0) {
                $this->codeModel->delete($code_idx);
			}

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => '삭제완료'
                ]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'An error occurred during deletion'
                ]);
        }
    }

    public function code_change()
    {
        try {
            $code_idx = $_POST['code_idx'] ?? [];
            $onum     = $_POST['onum'] ?? [];

            if (empty($code_idx)) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'No code_idx provided'
                    ]);
            }

            $tot = count($code_idx);
            for ($j = 0; $j < $tot; $j++) {

                $sql    = " update tbl_code set onum='" . $onum[$j] . "' where code_idx='" . $code_idx[$j] . "'";
                $result = $this->connect->query($sql);
            }

            if (isset($result) && $result) {
                $msg = "순위변경 완료";
            } else {
                $msg = "순위변경 오류";
            }

            return $this->response
                ->setStatusCode(200)
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


    public function search_change()
    {
        try {
            $tbc_idx  = $_POST['tbc_idx'] ?? [];
            $onum     = $_POST['onum'] ?? [];

            if (empty($tbc_idx)) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'No code_idx provided'
                    ]);
            }

            $tot = count($tbc_idx);
            for ($j = 0; $j < $tot; $j++) {

                $sql    = " update tbl_search set onum='" . $onum[$j] . "' where tbc_idx='" . $tbc_idx[$j] . "'";
                $result = $this->connect->query($sql);
            }

            if (isset($result) && $result) {
                $msg = "순위변경 완료";
            } else {
                $msg = "순위변경 오류";
            }

            return $this->response
                ->setStatusCode(200)
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
