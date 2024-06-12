<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class Member extends BaseController
{

    private $member;

    protected $sessionLib;
    protected $sessionChk;

    public function __construct()
    {
        $this->member = model("Member");
        helper(['html']);
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
    }
    public function LoginForm()
    {
        return view("member/member_login");
    }

    public function JoinChoice()
    {
        return view("member/join_choice");
    }

    public function JoinAgree()
    {
        $policy = $this->db->query(" select * from tbl_policy_info where p_idx = '5' ")->getRowArray();
        $policy1 = $this->db->query(" select * from tbl_policy_info where p_idx = '2' ")->getRowArray();
        $policy2 = $this->db->query(" select * from tbl_policy_info where p_idx = '15' ")->getRowArray();
        return view("member/join_agree", ["policy" => $policy, "policy1" => $policy1, "policy2" => $policy2]);
    }

    public function JoinForm()
    {
        return view("member/join_form");
    }

    public function IdCheck()
    {
        $userid = updateSQ($this->request->getVar("userid"));
        $fsql = " select count(*) cnts from tbl_member where user_id = '" . $userid . "'";
        $frow = $this->db->query($fsql)->getRowArray();
        return $frow["cnts"];
    }

    public function LoginCheck()
    {
        $private_key = "";
        $returnUrl  = updateSQ($this->request->getPost("returnUrl"));
        $user_id    = updateSQ($this->request->getPost("user_id"));
        $user_pw    = updateSQ($this->request->getPost("user_pw"));
        $save_id    = updateSQ($this->request->getPost("save_id"));

        $total_sql = " select * from tbl_member where user_id = '" . $user_id . "' AND user_level > 2 ";
        // write_log($total_sql);
        $row = $this->db->query($total_sql)->getRowArray();
        if ($row["user_id"] == "") {
            return '<script>
                        alert("아이디가 없거나, 패스워드가 일치하지 않습니다.");
                        history.back();
                    </script>';
        } else if ($row["status"] == "O") {
            return '<script>
                        alert("회원탈퇴 되었습니다.");
                        history.back();
                    </script>';
        } else if (hash("sha1", md5($user_pw)) != $row["user_pw"]) {
            return '<script>
                        alert("패스워드가 일치하지 않습니다.");
                        history.back();
                    </script>';
        }

        getLoginDeviceUserChk($row['user_id']);

        getLoginIPChk();

        $sql_d = "SELECT   AES_DECRYPT(UNHEX('{$row['user_name']}'),    '$private_key') AS user_name 
				, AES_DECRYPT(UNHEX('{$row['user_email']}'),   '$private_key') AS user_email ";
        $row_d = $this->db->query($sql_d)->getRowArray();

        $row['user_name'] = $row_d['user_name'];
        $row['user_email'] = $row_d['user_email'];

        session()->remove("member");

        $data = [];

        $data['id'] = $row['user_id'];
        $data['idx'] = $row['m_idx'];
        $data["mIdx"] = $row['m_idx'];
        $data['name'] = $row['user_name'];
        $data['email'] = $row['user_email'];
        $data['level'] = $row['user_level'];

        session()->set("member", $data);

        if ($save_id == "Y") {
            setcookie("c_userId", $row["user_id"], time() + 86000 * 365, '/');
        } else {
            setcookie("c_userId", "", time() - 86000 * 365, '/');
        }

        return redirect()->to(base_url($returnUrl ?? "/"));
    }

    public function Logout()
    {
        $this->session->remove("member");
        return redirect()->to(base_url("/"));
    }

    public function RegOk()
    {
        $member = session("member");

        $private_key = "";

        function validate_required_fields($fields)
        {
            foreach ($fields as $field => $value) {
                if (empty($value)) {
                    die("Error: The field '$field' cannot be empty.");
                }
            }
        }

        $phone_sms = updateSQ($this->request->getPost("hidden_input"));

        // echo $phone_sms."==========";
        // echo $member['phone_chk']."++++++++++";
        if ($member['phone_chk'] != $phone_sms) {
            die("Error: The field 'SMS'.");
        }


        $user_id = updateSQ($this->request->getPost("user_id"));
        $user_pw = updateSQ($this->request->getPost("user_pw"));
        $user_name = updateSQ($this->request->getPost("user_name"));
        $user_email = updateSQ($this->request->getPost("user_email"));
        $user_mobile = updateSQ($this->request->getPost("user_mobile"));
        $gubun = updateSQ($this->request->getPost("gubun"));
        $sns_key = updateSQ($this->request->getPost("sns_key"));

        $sms_yn = updateSQ($this->request->getPost("sms_yn"));
        $user_email_yn = updateSQ($this->request->getPost("user_email_yn"));
        $birthday = updateSQ($this->request->getPost("birth_day"));

        $zip = updateSQ($this->request->getPost("zip"));
        $addr1 = updateSQ($this->request->getPost("addr1"));
        $addr2 = updateSQ($this->request->getPost("addr2"));
        $visit_route = updateSQ($this->request->getPost("visit_route"));

        if ($gubun == "") {
            validate_required_fields([
                'user_id' => $user_id,
                'user_pw' => $user_pw,
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_mobile' => $user_mobile,
                // 'gubun' => $gubun,
                // 'sns_key' => $sns_key,
                'birth_day' => $birthday,
                // 'zip' => $zip,
                // 'addr1' => $addr1,
                // 'addr2' => $addr2,
                // 'visit_route' => $visit_route,
            ]);

        }
        $fsql = " select count(*) cnts from tbl_member where user_id = '" . $user_id . "'";
        $frow = $this->db->query($fsql)->getRowArray();
        //$recommender        = !empty($_POST["recommender"]) ? updateSQ($_POST["recommender"]) : '';
        if ($frow['cnts'] > 0) {
            goUrl("/", "이미 가입된 아이디입니다.");
            echo $user_id;
        }

        if ($gubun == "kakao")
            $user_id = "kakao_" . $sns_key;
        if ($gubun == "google")
            $user_id = "google_" . $sns_key;
        if ($gubun == "naver")
            $user_id = "naver_" . $sns_key;

        if ($gubun != "") {
            $sql_su = "
                insert into tbl_member SET 
                     user_id		= '" . $user_id . "'
                    ,user_name      = HEX(AES_ENCRYPT('$user_name',   '$private_key'))   
                    ,user_email		= HEX(AES_ENCRYPT('$user_email',  '$private_key'))   
                    ,user_mobile	= HEX(AES_ENCRYPT('$user_mobile', '$private_key'))   
                    ,user_level		= '10'
                    ,status			= '1'
                    ,gubun			= '" . $gubun . "'
                    ,sns_key		= '" . $sns_key . "'
                    ,user_ip		= '" . $_SERVER['REMOTE_ADDR'] . "'
                    ,r_date			= now()
                    ,encode      	= 'Y'
            ";
        } else {
            $sql_su = "
                insert into tbl_member SET 
                     user_id		= '" . $user_id . "'
                    ,user_pw		= '" . sql_password($user_pw) . "'
                    ,user_name      = HEX(AES_ENCRYPT('$user_name',   '$private_key'))   
                    ,birthday		= '" . $birthday . "'
                    ,user_email		= HEX(AES_ENCRYPT('$user_email',  '$private_key'))   
                    ,user_email_yn	= '" . $user_email_yn . "'
                    ,user_mobile	= HEX(AES_ENCRYPT('$user_mobile', '$private_key'))   
                    ,sms_yn         = '" . $sms_yn . "'
                    ,user_level		= '10'
                    ,status			= '1'
                    ,gubun			= '" . $gubun . "'
                    ,sns_key		= '" . $sns_key . "'
                    ,user_ip		= '" . $_SERVER['REMOTE_ADDR'] . "'
                    ,r_date			= now()
                    ,zip	        = HEX(AES_ENCRYPT('$zip',    '$private_key'))   
                    ,addr1	        = HEX(AES_ENCRYPT('$addr1',  '$private_key'))   
                    ,addr2	        = HEX(AES_ENCRYPT('$addr2',  '$private_key'))   
                    ,visit_route	= '" . $visit_route . "'
                    ,encode      	= 'Y'
            ";
        }

        // write_log("회원가입 : " . $sql_su);
        $this->db->query($sql_su);
        $m_idx = $this->db->insertID();

        $code = "A01";
        $user_mail = $user_email;
        $replace_text = "|||[name]:::" . $user_name;
        // autoEmail($code,$user_mail,$replace_text);

        // $_IT_SITE_NAME = _IT_SITE_NAME;
        // $_IT_CUSTOM_PHONE = _IT_CUSTOM_PHONE;

        $code = "S04";
        $to_phone = $user_mobile;
        $replace_text = "|||{{MEMBER_NAME}}:::" . $user_name;
        // autoSms($code, $to_phone, $replace_text);

        // 로그인 처리 부분
        $total_sql = " select * from tbl_member where user_id='" . $user_id . "'";
        $row = $this->db->query($total_sql)->getRowArray();

        if ($row['user_id'] == "") {
            //아이디가 없습니다.
            // alert_msg("존재하지 않는 아이디입니다.");
            return;
        }


        // write_log("회원로그인 : ".$total_sql);

        $data = [];

        $data['id'] = $user_id;
        $data['shop'] = $user_id;
        $data['idx'] = $m_idx;
        $data["mIdx"] = $m_idx;
        $data['name'] = $user_name;
        $data['email'] = $user_email;
        // $data['level'] = $user_level;
        $data['gubun'] = $gubun;

        session()->set("member", $data);

        // 로그인 횟수를 증가시키고 마지막 접속 일자 변경
        $total_sql = " update tbl_member
                          set login_count = login_count+1
                            , login_date = now()
                        where user_id='" . $user_id . "'";
        // write_log("2- ". $total_sql);
        $this->db->query($total_sql);
        return redirect()->to(base_url("/"));
    }

    public function JoinComplete()
    {
        return view("member/join_complete");
    }

    public function AdminPasswordChange()
    {
        $scripts = [];
        array_push($scripts, script_tag(["src" => "js/admin/member/adminChange.js", "defer" => false]));
        return view("admin/member/adminPasswordChange", [
            "headers" => [...$scripts],
        ]);
    }
    /**
     * 관리자 비밀번호 변경
     */
    public function AdminPasswordUpdate()
    {
        $post = $this->request->getPost();

        $prevPwd = !empty($post['prev_pwd']) ? $post['prev_pwd'] : null;
        $pwd = !empty($post['pwd']) ? $post['pwd'] : null;
        $pwdCheck = !empty($post['pwd_check']) ? $post['pwd_check'] : null;
        $memberId = $this->session->get('member_id');

        $validateRule = [
            "prev_pwd" => [
                "rules" => "required",
                "errors" => [
                    "required" => "이전 비밀번호는 필수 값 입니다.",
                ],
            ],
            "pwd" => [
                "rules" => "required",
                "errors" => [
                    "required" => "비밀번호는 필수 값 입니다.",
                ],
            ],
            "pwd_check" => [
                "rules" => "required|matches[pwd]",
                "errors" => [
                    "required" => "비밀번호 확인은 필수 값 입니다.",
                    "matches" => "비밀번호와 다릅니다. 다시 확인해주세요.",
                ],
            ],
        ];
        try {
            if ($this->sessionChk != "Y") {
                throw new Exception('비정상적인 접근 입니다.', 302);
            }
            if (!$this->validate($validateRule)) {
                $errors = $this->validator->getErrors();
                $errorMessage = array_values($errors)[0];
                throw new Exception($errorMessage);
            }
            $passwordHash = password_hash($pwd, PASSWORD_BCRYPT);
            $adminPrevPassword = $this->member->AdminPrevPassword()[0];
            if (!password_verify($prevPwd, $adminPrevPassword)) {
                throw new Exception("이전 비밀번호가 다릅니다.");
            }
            $adminInfo = $this->member->AdminInfo($memberId);
            $idx = $adminInfo[0]['idx'];
            $data['member_pw'] = $passwordHash;

            $updateResult = $this->member->AdminPasswordChange($idx, $data);

            if (!$updateResult) {
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