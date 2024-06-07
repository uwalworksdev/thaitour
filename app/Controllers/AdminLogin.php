<?php

namespace App\Controllers;

use Exception;

class AdminLogin extends BaseController {

    protected $db;
    protected $session;


    public function __construct()
    {
        helper("html");
        $this->db = db_connect();

        $this->session = \Config\Services::session();


    }

    public function LoginView(){
        $scripts = [];
        array_push($scripts, script_tag(["src"=>"js/admin/login.js", "defer"=>false]));

        
        return view("admin/login",[
            "headers"=>[...$scripts],
        ]);
    }

    public function LoginCheckAjax(){

        $ajax = $this->request->isAJAX();
        $userId = $this->request->getPost('user_id');
        $userPw = $this->request->getPost('user_pw');

        try{

            if(!$this->validate('login')) {
                $errors = $this->validator->getErrors();
                $errorMessage = array_values($errors)[0];
                throw new Exception($errorMessage);
            }

            $builder = $this->db->table('tbl_member');
            $builder->where('user_id', $userId);
            $query = $builder->get();
            $result = $query->getRow();

            if ($result) {

                if ($result->user_level != '1') {
                    throw new Exception("탙퇴한 회원 입니다.");
                }

                // if ($result->member_grade != '1') {
                //     throw new Exception("권한이 없습니다.");
                // }

                // if (!password_verify($userPw, $result->member_pw)) {
                //     throw new Exception("패스워드를 확인 하세요.");
                // }

            }else{
                throw new Exception("존재 하지 않는 아이디 입니다.");
            }
            
            $this->session->set('user_id', $userId);
            $this->session->set('user_name', $result->user_name);
            $this->session->set('create_at', time());

            $resultArr['result'] = true;
            $resultArr['location'] = url_to('Setting::writeView');

        }catch(Exception $err){

            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();

        } finally {

            return $this->response->setJSON($resultArr);

        }
    }

    public function LogoutAjax(){
        // ajax 처리인지, 페이지 이동인지는 미정
    }

    public function Logout()
    {
        $this->session->destroy();
        return redirect()->to('/adm');
    }
}