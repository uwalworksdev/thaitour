<?php

namespace App\Controllers;

use Exception;

class AdminLogin extends BaseController {

    protected $db;
    protected $session;
    protected $member;


    public function __construct()
    {
        helper("html");
        $this->db = db_connect();
        $this->member = model("Member");

        $this->session = \Config\Services::session();


    }

    public function LoginView(){
        $scripts = [];
        array_push($scripts, script_tag(["src"=>"js/admin/login.js?version=1", "defer"=>false]));

        
        return view("admin/login",[
            "headers"=>[...$scripts],
        ]);
    }

    public function LoginCheckAjax(){

        $user_id = $this->request->getPost('user_id');
        $user_pw = $this->request->getPost('user_pw');

        $row = $this->member->getAdminLogin($user_id);

        $resultArr = [];

        if (!$row) {
            $resultArr['result'] = false;
            $resultArr['message'] = '존재하지 않는 아이디입니다.';
            return $this->response->setJSON($resultArr);
        }

        if ($row["user_pw"] != $this->member->sql_password($user_pw)) {
            $resultArr['result'] = false;
            $resultArr['message'] = '패스워드가 일치하지 않습니다.';
            return $this->response->setJSON($resultArr);
        }

        if ($row['status'] == 'N') {
            $resultArr['result'] = false;
            $resultArr['message'] = '현재 인증대기중입니다.';
            return $this->response->setJSON($resultArr);
        }

        if ($row['user_level'] > 2) {
            $resultArr['result'] = false;
            $resultArr['message'] = '로그인 하실 권한이 없으십니다.';
            return $this->response->setJSON($resultArr);
        }

        $this->session->set('member', [
            'id'    => $row['user_id'],
            'idx'   => $row['m_idx'],
            'mIdx'  => $row['m_idx'],
            'name'  => $row['user_name'],
            'level' => $row['user_level'],
            'm_auth'=> $row['auth']
        ]);

        $this->session->set('create_at', time());

        $resultArr['result'] = true;
        $resultArr['location'] = '/AdmMaster/main';

        return $this->response->setJSON($resultArr);
    }

    public function LogoutAjax(){
        // ajax 처리인지, 페이지 이동인지는 미정
    }

    public function Logout()
    {
        $this->session->destroy();
        return redirect()->to('/AdmMaster');
    }
}