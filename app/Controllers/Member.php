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
        helper('form'); 
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
    }
    public function list_member()
    {
        $model = $this->member;
        $private_key = private_key();
        
        $search_name = $this->request->getGet('search_name');
        $search_category = $this->request->getGet('search_category');
        $s_status = $this->request->getGet('s_status') ?? 'Y';
        $pg = $this->request->getGet('pg') ?? 1;
    
        // Khởi tạo câu truy vấn
        $strSql = "WHERE 1=1";
        
        if ($search_name) {
            if ($search_category == "user_id") {
                $strSql .= " AND user_id = '" . $this->db->escapeString($search_name) . "'";
            } else {
                $strSql .= " AND CONVERT(AES_DECRYPT(UNHEX($search_category), '$private_key') USING utf8) LIKE '%" . $this->db->escapeString($search_name) . "%'";
            }
        }
    
        if ($s_status == "Y") {
            $strTitle = "(일반)";
            $strSql .= " AND status != 'O'";
        } else {
            $strTitle = "(탈퇴)";
            $strSql .= " AND status = 'O'";
        }
    
        $strSql .= " AND user_level = 10";
    
        // Phân trang
        $g_list_rows = 20;
        $nFrom = ($pg - 1) * $g_list_rows;
    
        // Lấy tổng số bản ghi
        $total_count = $model->getMemberCount($strSql);
        $nPage = ceil($total_count / $g_list_rows);
    
        // Lấy danh sách thành viên
        $members = $model->getMembers($strSql, $private_key, $nFrom, $g_list_rows);
    
        // Load view
        return view('admin/_member/list', [
            'strTitle' => $strTitle,
            'nTotalCount' => $total_count,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'members' => $members,
            's_status' => $s_status,
            'pg' => $pg,
            'g_list_rows' => $g_list_rows,
            'nPage' => $nPage,
        ]);
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
        $returnUrl  = updateSQ($this->request->getPost("returnUrl"));
        $user_id    = updateSQ($this->request->getPost("user_id"));
        $user_pw    = updateSQ($this->request->getPost("user_pw"));
        $save_id    = updateSQ($this->request->getPost("save_id"));

        $row = $this->member->getLogin($user_id);
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

        $private_key = private_key();

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
                'birth_day' => $birthday,
            ]);

        }
        $fsql = " select count(*) cnts from tbl_member where user_id = '" . $user_id . "'";
        $frow = $this->db->query($fsql)->getRowArray();
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
        $data['level'] = 10;
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

    public function detail()
    {
        // Lấy giá trị của query string 'idx'
        $m_idx = $this->request->getGet('idx');
        $titleStr = '회원정보';
        // Kiểm tra nếu 'idx' tồn tại
        if ($m_idx) {
            $private_key = private_key(); // Lấy khóa mã hóa

            // Lấy thông tin thành viên từ cơ sở dữ liệu
            $member = $this->member->find($m_idx);

            if (!$member) {
                throw new Exception("Thành viên không tồn tại");
            }

            // Giải mã thông tin nếu cần thiết
            if ($member['encode'] == 'Y') {
                $member['user_name'] = $this->decrypt($member['user_name'], $private_key);
                $member['user_email'] = $this->decrypt($member['user_email'], $private_key);
                $member['user_phone'] = $this->decrypt($member['user_phone'], $private_key);
                $member['user_mobile'] = $this->decrypt($member['user_mobile'], $private_key);
                $member['zip'] = $this->decrypt($member['zip'], $private_key);
                $member['addr1'] = $this->decrypt($member['addr1'], $private_key);
                $member['addr2'] = $this->decrypt($member['addr2'], $private_key);
            }
            $status = $member['status'] ?? 'Y';  
            $gubun = $member['gubun'] ?? null;
            list($email1, $email2) = explode('@', $member['user_email']);

            // Hiển thị thông tin trong view
            return view('admin/_member/write', [
                'member' => $member,
                'titleStr'  => $titleStr,
                'status'    => $status, 
                'gubun'     => $gubun, 
                'email1'    => $email1,
                'email2'    => $email2,
            ]);
        } else {
            // Xử lý trường hợp không có 'idx'
            return redirect()->to('/some-default-page')->with('error', 'Không có ID thành viên được cung cấp.');
        }
    }

    // Cập nhật thông tin thành viên
    public function update_member($m_idx)
    {
        $request = $this->request;
        $private_key = private_key();

        // Lấy dữ liệu từ POST và xử lý
        $data = [
            'user_id'       => updateSQ($request->getPost("user_id")),
            'user_pw'       => updateSQ($request->getPost("user_pw")),
            'user_name'     => updateSQ($request->getPost("user_name")),
            'gender'        => updateSQ($request->getPost("gender")),
            'user_email'    => updateSQ($request->getPost("email1")) . "@" . updateSQ($request->getPost("email2")),
            'user_email_yn' => updateSQ($request->getPost("user_email_yn")),
            'user_phone'    => updateSQ($request->getPost("phone1")) . "-" . updateSQ($request->getPost("phone2")) . "-" . updateSQ($request->getPost("phone3")),
            'user_mobile'   => updateSQ($request->getPost("mobile1")) . "-" . updateSQ($request->getPost("mobile2")) . "-" . updateSQ($request->getPost("mobile3")),
            'zip'           => updateSQ($request->getPost("zip")),
            'addr1'         => updateSQ($request->getPost("addr1")),
            'addr2'         => updateSQ($request->getPost("addr2")),
            'job'           => updateSQ($request->getPost("job")),
            'birthday'      => updateSQ($request->getPost("byy")) . "-" . updateSQ($request->getPost("bmm")) . "-" . updateSQ($request->getPost("bdd")),
            'marriage_yn'   => updateSQ($request->getPost("marriage")),
            'user_level'    => updateSQ($request->getPost("user_level")),
            'sms_yn'        => updateSQ($request->getPost("sms_yn")),
            'kakao_yn'      => updateSQ($request->getPost("kakao_yn")),
            'ip_address'    => $request->getIPAddress(),
        ];

        // Cập nhật mật khẩu nếu có
        if (!empty($data['user_pw'])) {
            $passwordSql = [
                'user_pw' => sha1(md5($data['user_pw'])),
            ];
            $this->member->update($m_idx, $passwordSql);
            write_log("Cập nhật mật khẩu: " . json_encode($passwordSql));
        }

        // Mã hóa và cập nhật các trường còn lại
        $updateData = [
            'gender'        => $data['gender'],
            'user_email'    => $this->encrypt($data['user_email'], $private_key),
            'user_phone'    => $this->encrypt($data['user_phone'], $private_key),
            'user_mobile'   => $this->encrypt($data['user_mobile'], $private_key),
            'user_email_yn' => $data['user_email_yn'],
            'zip'           => $this->encrypt($data['zip'], $private_key),
            'addr1'         => $this->encrypt($data['addr1'], $private_key),
            'addr2'         => $this->encrypt($data['addr2'], $private_key),
            'job'           => $data['job'],
            'birthday'      => $data['birthday'],
            'marriage_yn'   => $data['marriage_yn'],
            'user_level'    => $data['user_level'],
            'sms_yn'        => $data['sms_yn'],
            'kakao_yn'      => $data['kakao_yn'],
            'm_date'        => date('Y-m-d H:i:s'),
            'encode'        => 'Y',
        ];

        $this->member->update($m_idx, $updateData);
        write_log("Cập nhật thông tin thành viên: " . json_encode($updateData));

        return redirect()->back()->with('message', 'Thông tin đã được cập nhật thành công.');
    }

    // Hàm mã hóa dữ liệu
    private function encrypt($data, $key)
    {
        return "HEX(AES_ENCRYPT('$data', '$key'))";
    }

    // Hàm giải mã dữ liệu
    private function decrypt($data, $key)
    {
        return $this->db->query("SELECT AES_DECRYPT(UNHEX('$data'), '$key') AS decrypted")->getRow()->decrypted;
    }
}