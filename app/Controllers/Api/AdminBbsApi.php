<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminBbsApi extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
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
            $bbs_idx = $_POST['idx'] ?? [];
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

    public function bbs_del()
    {
        try {
            $upload = "../data/bbs/";
            $bbs_idx = $_POST['bbs_idx'] ?? [];

            if (empty($bbs_idx)) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status' => 'error',
                        'message' => 'No bbs_idx provided'
                    ]);
            }

            foreach ($bbs_idx as $jValue) {
                $total_sql = "SELECT * FROM tbl_bbs_list WHERE bbs_idx = ?";
                $result = $this->connect->query($total_sql, [$jValue]);

                if ($row = $result->getRowArray()) {
                    for ($a = 1; $a <= 5; $a++) {
                        $rfile = $row["rfile$a"];
                        if (!empty($rfile) && file_exists($upload . $rfile)) {
                            @unlink($upload . $rfile);
                        }
                    }

                    $sql = "DELETE FROM tbl_bbs_list WHERE bbs_idx = ?";
                    $this->connect->query($sql, [$jValue]);
                }
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => 'delete success'
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
}
