<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class Member extends BaseController {

    private $member;
    
    protected $sessionLib;
    protected $sessionChk;

    public function __construct()
    {
        $this->member = model("Member");
        helper(['html']);

        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
    }
    public function LoginForm(){
        return view("member/member_login");
    }

    public function AdminPasswordChange(){
        $scripts = [];
        array_push($scripts,script_tag(["src"=>"js/admin/member/adminChange.js", "defer"=>false]));
        return view("admin/member/adminPasswordChange",[
            "headers" => [...$scripts],
        ]);
    }
    /**
     * 관리자 비밀번호 변경
     */
    public function AdminPasswordUpdate(){
        $post = $this->request->getPost();

        $prevPwd = !empty($post['prev_pwd']) ? $post['prev_pwd'] : null;
        $pwd = !empty($post['pwd']) ? $post['pwd'] : null;
        $pwdCheck = !empty($post['pwd_check']) ? $post['pwd_check'] : null;
        $memberId = $this->session->get('member_id');

        $validateRule = [
            "prev_pwd"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"이전 비밀번호는 필수 값 입니다.",
                ],
            ],
            "pwd" => [
                "rules"=>"required",
                "errors"=> [
                    "required" => "비밀번호는 필수 값 입니다.",
                ],
            ],
            "pwd_check" => [
                "rules"=>"required|matches[pwd]",
                "errors"=> [
                    "required" => "비밀번호 확인은 필수 값 입니다.",
                    "matches" => "비밀번호와 다릅니다. 다시 확인해주세요.",
                ],
            ],
        ];
        try {
            if ($this->sessionChk != "Y") {
                throw new Exception('비정상적인 접근 입니다.', 302);
            }
            if(!$this->validate($validateRule)){
                $errors = $this->validator->getErrors();
                $errorMessage = array_values($errors)[0];
                throw new Exception($errorMessage);
            }
            $passwordHash = password_hash($pwd, PASSWORD_BCRYPT);
            $adminPrevPassword = $this->member->AdminPrevPassword()[0];
            if(!password_verify($prevPwd , $adminPrevPassword)){
                throw new Exception("이전 비밀번호가 다릅니다.");
            }
            $adminInfo = $this->member->AdminInfo($memberId);
            $idx = $adminInfo[0]['idx'];
            $data['member_pw'] = $passwordHash;
            
            $updateResult = $this->member->AdminPasswordChange($idx, $data);
            
            if(!$updateResult){
                throw new Exception("비밀번호 변경 과정 중 오류가 발생했습니다.");
            }

            $resultArr['result'] = true;
            $resultArr['message'] = "변경했습니다.";
        } catch (Exception $err) {
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
            if ($err->getCode() == 302) {
                $resultArr['location'] = "/adm";
            }
        } finally {
            return $this->response->setJSON($resultArr);
        }
    }
}