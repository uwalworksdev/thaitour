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
        } else {
            return $this->response->setJSON(
                $data = [
                    'result' => 'fail',
                    'msg' => 'fail',
                    'data' => '',
                    'code' => 400
                ], 400
            );
        }
    }
}
