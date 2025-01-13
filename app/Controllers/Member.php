<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use App\Models\Code;
use Exception;

class Member extends BaseController
{

    private $member;
    protected $sessionLib;
    protected $db;
    protected $sessionChk;
    protected $code;
    private $ordersModel;

    public function __construct()
    {
        $this->member = model("Member");
        helper(['html']);
        helper('form');
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        $this->code = new Code();
        $this->ordersModel = new \App\Models\OrdersModel();
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    }

    public function list_member()
    {
        $model = $this->member;
        $private_key = private_key();

        $search_name = $this->request->getGet('search_name');
        $search_category = $this->request->getGet('search_category');
        $s_status = $this->request->getGet('s_status') ?? 'Y';
        $pg = $this->request->getGet('pg') ?? 1;

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

        $strSql .= " AND user_level > 5";

        $g_list_rows = 20;
        $nFrom = ($pg - 1) * $g_list_rows;

        $total_count = $model->getMemberCount($strSql);
 
        $nPage = ceil($total_count / $g_list_rows);

        $members = $model->getMembers($strSql, $private_key, $nFrom, $g_list_rows);
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

    public function del()
    {
        $m_idx = $this->request->getPost('m_idx');
        $tot = count($m_idx);
        for ($j = 0; $j < $tot; $j++) {
            $this->member->delete($m_idx[$j]);
        }
        return "OK";
    }

    public function LoginForm()
    {
        return view("member/member_login", ['returnUrl' => urldecode($this->request->getGet('returnUrl'))]);
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
        $mcodes = $this->code->getByParentCode('56')->getResultArray();;
        return view("member/join_form", ['mcodes' => $mcodes]);
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
        $returnUrl = urldecode($this->request->getPost("returnUrl"));
        $user_id = updateSQ($this->request->getPost("user_id"));
        $user_pw = updateSQ($this->request->getPost("user_pw"));
        $save_id = updateSQ($this->request->getPost("save_id"));

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
        } else if (!password_verify($user_pw, $row["user_pw"])) {
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
        $data['phone'] = $row['user_mobile'];

        session()->set("member", $data);

        if ($save_id == "Y") {
            setcookie("c_userId", $row["user_id"], time() + 86000 * 365, '/');
        } else {
            setcookie("c_userId", "", time() - 86000 * 365, '/');
        }

        return redirect()->to($returnUrl ?? "/");
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

        $phone_sms = updateSQ($this->request->getPost("hidden_input"));

        if (($member['phone_chk'] ?? "") != $phone_sms) {
            die("Error: The field 'SMS'.");
        }

        $user_id = updateSQ($this->request->getPost("user_id"));
        $user_pw = updateSQ($this->request->getPost("user_pw"));
        $user_name = updateSQ($this->request->getPost("user_name"));
        $user_email = updateSQ($this->request->getPost("user_email"));
        $user_mobile = updateSQ($this->request->getPost("user_mobile"));
        $gubun = updateSQ($this->request->getPost("gubun"));
        $sns_key = updateSQ($this->request->getPost("sns_key"));

        $mbti = updateSQ($this->request->getPost("mbti"));

        $sms_yn = updateSQ($this->request->getPost("sms_yn"));
        $user_email_yn = updateSQ($this->request->getPost("user_email_yn"));
        $birthday = updateSQ($this->request->getPost("birth_day"));

        $zip = updateSQ($this->request->getPost("zip"));
        $addr1 = updateSQ($this->request->getPost("addr1"));
        $addr2 = updateSQ($this->request->getPost("addr2"));
        $visit_route = updateSQ($this->request->getPost("visit_route"));
        $recommender = updateSQ($this->request->getPost("recommender"));

        if ($gubun == "") {
            $fields = [
                'user_id' => $user_id,
                'user_pw' => $user_pw,
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_mobile' => $user_mobile,
                'birth_day' => $birthday,
                'mbti' => $mbti,
            ];
            for ($idx = 0; $idx < count($fields); $idx++) {
                $field = array_keys($fields)[$idx];
                $value = array_values($fields)[$idx];
                if (empty($value)) {
                    return $this->response->setJSON(['message' => "Error: The field '$field' cannot be empty."])->setStatusCode(400);
                }
            }
        }

        $cnt = $this->member->getMemberCount("where user_id = '" . $user_id . "'");
        if ($cnt > 0) {
            $member = $this->member->getMembers("where user_id = '" . $user_id . "'", $private_key, 0, 1)[0];
            $data['id'] = $user_id;
            $data['shop'] = $user_id;
            $data['idx'] = $member['m_idx'];
            $data["mIdx"] = $member['m_idx'];
            $data['name'] = $member['user_name'];
            $data['email'] = $member['user_email'];
            $data['level'] = 10;
            $data['gubun'] = $member['gubun'];
            session()->set("member", $data);
            return $this->response->setJSON(['message' => "이미 가입된 아이디입니다."])->setStatusCode(200);
        }

        if ($gubun == "kakao")
            $user_id = "kakao_" . $sns_key;
        if ($gubun == "google")
            $user_id = "google_" . $sns_key;
        if ($gubun == "naver")
            $user_id = "naver_" . $sns_key;

        if ($gubun != "") {
            $this->member->insertMember([
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_mobile' => $user_mobile,
                'gubun' => $gubun,
                'sns_key' => $sns_key,
            ]);
        } else {
            $this->member->insertMember([
                'user_id' => $user_id,
                'user_pw' => $user_pw,
                'user_name' => $user_name,
                'birthday' => $birthday,
                'user_email' => $user_email,
                'user_email_yn' => $user_email_yn,
                'user_mobile' => $user_mobile,
                'sms_yn' => $sms_yn,
                'gubun' => "",
                'sns_key' => "",
                'zip' => $zip,
                'addr1' => $addr1,
                'addr2' => $addr2,
                'visit_route' => $visit_route ?? "",
                'recommender' => $recommender ?? "",
                'mbti' => $mbti,
            ]);
        }

        write_log("회원가입 : " . $user_id);
        $m_idx = $this->db->insertID();

        $code = "A01";
        $user_mail = $user_email;
        $_tmp_fir_array = [
            'name' => $user_name
        ];
        autoEmail($code, $user_mail, $_tmp_fir_array);

        if ($user_mobile) {
            $code = "S04";
            $to_phone = $user_mobile;
            $_tmp_fir_array = [
                'MEMBER_NAME' => $user_name
            ];
            autoSms($code, $to_phone, $_tmp_fir_array);
        }

        // 로그인 처리 부분
        $row = $this->member->where(['user_id' => $user_id])->first();

        if (!$row || $row['user_id'] == "") {
            return $this->response->setJSON(['message' => "존재하지 않는 아이디입니다"])->setStatusCode(404);
        }


        write_log("회원로그인 : " . $user_id);

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

        $this->member->set('login_count', 'login_count + 1', false);
        $this->member->set('login_date', 'NOW()', false);
        $this->member->where('user_id', $user_id);
        $this->member->update();
        return $this->response->setJSON(['message' => "success"]);
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
            $data['user_pw'] = $passwordHash;

            $updateResult = $this->member->AdminPasswordChange($idx, $data);

            if (!$updateResult) {
                throw new Exception("비밀번호 변경 과정 중 오류가 발생했습니다.");
            }

            $resultArr['result'] = true;
            $resultArr['message'] = "변경했습니다.";
            return $this->response->setJSON($resultArr);
        } catch (Exception $err) {
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
            if ($err->getCode() == 302) {
                $resultArr['location'] = "/adm";
            }
            return $this->response->setJSON($resultArr);
        }
    }

    public function detail()
    {
        $m_idx = $this->request->getGet('idx');
        $titleStr = '회원정보';
        if ($m_idx) {
            $private_key = private_key();

            $member = $this->member->find($m_idx);

            if (!$member) {
                throw new Exception("이전 회원가 없습니다.", 404);
            }

            if ($member['encode'] == 'Y') {
                $member['user_name'] = $this->decrypt($member['user_name'], $private_key);
                $member['user_email'] = $this->decrypt($member['user_email'], $private_key);
                $member['user_phone'] = $this->decrypt($member['user_phone'], $private_key);
                $member['user_mobile'] = $this->decrypt($member['user_mobile'], $private_key);
                $member['zip'] = $this->decrypt($member['zip'], $private_key);
                $member['addr1'] = $this->decrypt($member['addr1'], $private_key);
                $member['addr2'] = $this->decrypt($member['addr2'], $private_key);
            }

			$user_email_yn = $member['user_email_yn'];
			$status = $member['status'] ?? 'Y';
            $gubun = $member['gubun'] ?? null;
            [$email1, $email2] = explode('@', $member['user_email']);
            [$mobile1, $mobile2, $mobile3] = explode('-', $member['user_mobile']);
            [$phone1, $phone2, $phone3] = explode('-', $member['user_phone']);

            $mcodes = $this->code->getByParentCode('56')->getResultArray();

            //$result = $this->ordersModel->getOrders('', 'product_name', 1, 10000, []);

            //$total = 0;

            //foreach ($result['order_list'] as $item){
            //    $total += floatval($item['order_price']);
            //}

			return view('admin/_member/write', [
                'member' => $member,
                'mcodes' => $mcodes,
                'titleStr' => $titleStr,
                'user_email_yn' => $user_email_yn,
                'status' => $status,
                'gubun' => $gubun,
                'email1' => $email1,
                'email2' => $email2,
                'mobile1' => $mobile1,
                'mobile2' => $mobile2,
                'mobile3' => $mobile3,
                'phone1' => $phone1,
                'phone2' => $phone2,
                'phone3' => $phone3,
                'total' => $total,
                'visit_route' => $member['visit_route'],
                'recommender' => $member['recommender'],
            ]);
        } else {
            return "Thwarted.";
        }
    }

    public function update_member($m_idx) 
    {
        $request = $this->request;
        $private_key = private_key();

        $data = [
            'user_id' => updateSQ($request->getPost("user_id")),
            'user_pw' => updateSQ($request->getPost("user_pw")),
            'user_name' => updateSQ($request->getPost("user_name")),
            'gender' => updateSQ($request->getPost("gender")),
            'user_email' => updateSQ($request->getPost("email1")) . "@" . updateSQ($request->getPost("email2")),
            'user_email_yn' => updateSQ($request->getPost("user_email_yn")),
            'user_phone' => updateSQ($request->getPost("phone1")) . "-" . updateSQ($request->getPost("phone2")) . "-" . updateSQ($request->getPost("phone3")),
            'user_mobile' => updateSQ($request->getPost("mobile1")) . "-" . updateSQ($request->getPost("mobile2")) . "-" . updateSQ($request->getPost("mobile3")),
            'zip' => updateSQ($request->getPost("zip")),
            'addr1' => updateSQ($request->getPost("addr1")),
            'addr2' => updateSQ($request->getPost("addr2")),
            'job' => updateSQ($request->getPost("job")),
            'birthday' => updateSQ($request->getPost("byy")) . "-" . updateSQ($request->getPost("bmm")) . "-" . updateSQ($request->getPost("bdd")),
            'marriage_yn' => updateSQ($request->getPost("marriage")),
            'user_level' => updateSQ($request->getPost("user_level")),
            'sms_yn' => updateSQ($request->getPost("sms_yn")),
            'kakao_yn' => updateSQ($request->getPost("kakao_yn")),
            'ip_address' => $request->getIPAddress(),
            'status' => updateSQ($request->getPost("status")),
            'mbti' => updateSQ($request->getPost("mbti")),
        ];

		if (!empty($data['user_pw'])) {
            $passwordSql = [
                'user_pw' => password_hash($data['user_pw'], PASSWORD_BCRYPT)
            ];
            $this->member->update($m_idx, $passwordSql);
            write_log("password update: " . json_encode($passwordSql));
        }

        $updateData = [
            'gender' => $data['gender'],
            'user_name' => $this->encrypt($data['user_name'], $private_key),
            'user_email' => $this->encrypt($data['user_email'], $private_key),
            'user_phone' => $this->encrypt($data['user_phone'], $private_key),
            'user_mobile' => $this->encrypt($data['user_mobile'], $private_key),
            'user_email_yn' => $data['user_email_yn'],
            'zip' => $this->encrypt($data['zip'], $private_key),
            'addr1' => $this->encrypt($data['addr1'], $private_key),
            'addr2' => $this->encrypt($data['addr2'], $private_key),
            'job' => $data['job'],
            'birthday' => $data['birthday'],
            'marriage_yn' => $data['marriage_yn'],
            'user_level' => $data['user_level'],
            'sms_yn' => $data['sms_yn'],
            'kakao_yn' => $data['kakao_yn'],
            'm_date' => date('Y-m-d H:i:s'),
            'encode' => 'Y',
            'status' => $data['status'],
            'mbti' => $data['mbti'],
        ];

        $this->member->update($m_idx, $updateData, false);
        write_log("Update member: " . json_encode($updateData));

        return $this->response->setBody("<script>
                function success() {
                    alert('수정되었습니다.');
                    parent.location.reload();
                }
                
                success();
        </script>");
    }

    private function encrypt($data, $key)
    {
        return $this->db->query("SELECT HEX(AES_ENCRYPT(?, ?)) AS encrypted", [$data, $key])->getRow()->encrypted;
    }

    private function decrypt($data, $key)
    {
        return $this->db->query("SELECT AES_DECRYPT(UNHEX(?), ?) AS decrypted", [$data, $key])->getRow()->decrypted;
    }

    public function phone_chk_ajax()
    {
        $request = $this->request;
        $tophone = $request->getPost("tophone");

        if (empty($tophone)) {
            return "전화번호를 입력해주세요";
        } else {
            $isExist = $this->member->checkPhone($tophone);

            if ($isExist) {
                return "이미 가입된 전화번호입니다.";

            } elseif (phone_chk($tophone)) {
                return "Y";

            } else {
                return "오류가 발생하였습니다.";

            }
        }
    }

    public function email_chk_ajax()
    {
        $request = $this->request;
        $email = $request->getPost("email");

        if (empty($email)) {
            return "N";
        } else {
            if (email_chk($email)) {
                return "Y";
            } else {
                return "N";
            }
        }
    }

    public function num_chk_ajax()
    {
        $request = $this->request;

        $chkNum = $request->getPost("chkNum");

        return phone_chk_ok($chkNum);
    }

    public function num_chk2_ajax()
    {
        $request = $this->request;

        $chkNum = $request->getPost("chkNum");

        return email_chk_ok($chkNum);
    }

    public function sns_kakao_login()
    {
        helper(['form', 'url']);
        $session = session();

        $mode = updateSQ($this->request->getPost('mode'));
        $sns_key = updateSQ($this->request->getPost('sns_key'));
        $num = 0;

        $session->set('sns.gubun', 'kakao');

        if ($mode == "false" || $mode == "mypage") {
            $existingMember = $this->member->getBySns($sns_key);
            if ($existingMember) {
                $num = 2;
            }
        } else {
            $existingMember = $this->member->getBySns($sns_key);
            if ($existingMember) {
                $data['id'] = $existingMember['user_id'];
                $data['idx'] = $existingMember['m_idx'];
                $data["mIdx"] = $existingMember['m_idx'];
                $data['name'] = $existingMember['user_name'];
                $data['email'] = $existingMember['user_email'];
                $data['level'] = $existingMember['user_level'];
                $data['phone'] = $existingMember['user_mobile'];

                $session->set("member", $data);

                if (!empty($existingMember['sns_key'])) {
                    $data['sns_login'] = 'Y';
                    $session->set("member", $data);
                }

                $num = 2;
            }
        }

        return strval($num);
    }

    public function join_form_sns()
    {
        $gubun = $this->request->getPost('gubun');
        $sns_key = $this->request->getPost('sns_key');
        $user_name = $this->request->getPost('user_name');
        $user_email = $this->request->getPost('userEmail');
        $email_arr = explode("@", $user_email);
        return view('member/join_form_sns', [
            'gubun' => $gubun,
            'sns_key' => $sns_key,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'email_arr' => $email_arr
        ]);
    }

    public function google_login()
    {
        $session = session();
        $code = $this->request->getVar('code');
        $client_id = env('GOOGLE_LOGIN_CLIENT_ID');
        $client_secret = env('GOOGLE_LOGIN_SECRET');
        $redirect_uri = ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . env("GOOGLE_REDIRECT_URI");
        $url = 'https://oauth2.googleapis.com/token';
        $data = [
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code'
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $token = json_decode($response, true);
        if (isset($token['access_token'])) {
            $accessToken = $token['access_token'];

            $userInfo = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $accessToken);
            $user = json_decode($userInfo, true);
            $id = $user['id'];
            $email = $user['email'];
            $name = $user['name'];
            $db = \Config\Database::connect();
            $builder = $db->table('tbl_member');
            $builder->where('status', 'Y');
            $builder->where('sns_key', $id);
            $row = $builder->get()->getRowArray();
            if (!$row) {
                $session->set('sns.gubun', 'google');
                $session->set('google.userEmail', $email);
                $session->set('google.userName', $name);
                $session->set('google.user_id', 'google_' . $id);
                $session->set('google.sns_key', $id);

                return $this->redirectForm('/member/join_form_sns', [
                    'gubun' => 'google',
                    'sns_key' => $id,
                    'userEmail' => $email,
                    'user_name' => $name
                ]);
            } else {
                $session->set('member', [
                    'id' => $row['user_id'],
                    'idx' => $row['m_idx'],
                    'mIdx' => $row['m_idx'],
                    'name' => $row['user_name'],
                    'email' => $row['user_email'],
                    'level' => $row['user_level'],
                    'gubun' => $row['gubun'],
                    'sns_key' => $row['sns_key'],
                    'mlevel' => $row['mem_level']
                ]);

                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
    }

    private function redirectForm($url, $data)
    {

        $form = '<form id="redirectForm" action="' . $url . '" method="POST">';

        foreach ($data as $key => $value) {
            $form .= '<input type="hidden" name="' . esc($key) . '" value="' . esc($value) . '">';
        }

        $form .= '</form>';
        $form .= '<script type="text/javascript">document.getElementById("redirectForm").submit();</script>';

        return $form;
    }

    public function LoginFindId()
    {
        return $this->renderView('member/login_find_id');
    }

    public function LoginFindPw()
    {
        return view('member/login_find_pw');
    }

    public function cert_id_send_sms()
    {
        $mobile = updateSQ($this->request->getPost('mobile'));
        $user_name = updateSQ($this->request->getPost('user_name'));

        $mobile_sec = encryptField($mobile, "encode");
        $user_name_sec = encryptField($user_name, "encode");

        $row = $this->member->where(['user_mobile' => $mobile_sec, 'user_name' => $user_name_sec])->first();
        if (!$row) {
            return "일치하는 정보가 없습니다.";
        }

        if ($mobile) {
            $result = phone_chk($mobile);
        }

        return $this->response->setBody('인증번호가 발송되었습니다.');
    }

    public function cert_pw_send_sms()
    {
        $mobile = updateSQ($this->request->getPost('mobile'));
        $user_name = updateSQ($this->request->getPost('user_name'));
        $user_id = updateSQ($this->request->getPost('user_id'));

        $mobile_sec = encryptField($mobile, "encode");
        $user_name_sec = encryptField($user_name, "encode");

        $row = $this->member->where(['user_mobile' => $mobile_sec, 'user_name' => $user_name_sec, 'user_id' => $user_id])->first();
        if (!$row) {
            return "일치하는 정보가 없습니다.";
        }

        if ($mobile) {
            $result = phone_chk($mobile);
        }

        return $this->response->setBody('인증번호가 발송되었습니다.');
    }

    public function cert_id_send_email()
    {
        $user_email = updateSQ($this->request->getPost('user_email'));
        $user_name = updateSQ($this->request->getPost('user_name'));

        $user_email_sec = encryptField($user_email, "encode");
        $user_name_sec = encryptField($user_name, "encode");

        $row = $this->member->where(['user_email' => $user_email_sec, 'user_name' => $user_name_sec])->first();
        if (!$row) {
            return "일치하는 정보가 없습니다.";
        }

        $to_email = $user_email;

        if ($to_email) {
            $result = email_chk($to_email);
        }

        return $this->response->setBody('인증번호가 발송되었습니다.');
    }

    public function cert_pw_send_email()
    {
        $user_email = updateSQ($this->request->getPost('user_email'));
        $user_name = updateSQ($this->request->getPost('user_name'));
        $user_id = updateSQ($this->request->getPost('user_id'));

        $user_email_sec = encryptField($user_email, "encode");
        $user_name_sec = encryptField($user_name, "encode");

        $row = $this->member->where(['user_email' => $user_email_sec, 'user_name' => $user_name_sec, 'user_id' => $user_id])->first();
        if (!$row) {
            return "일치하는 정보가 없습니다.";
        }

        if ($user_email) {
            $result = email_chk($user_email);
        }

        return $this->response->setBody('인증번호가 발송되었습니다.');
    }

    public function find_id_ok()
    {
        $mobile = updateSQ($this->request->getPost('mobile'));
        $user_name = updateSQ($this->request->getPost('user_name'));
        $user_email = updateSQ($this->request->getPost('user_email'));
        $cert_num = updateSQ($this->request->getPost('cert_num'));
        $gubun = updateSQ($this->request->getPost('gubun'));

        $user_name_sec = encryptField($user_name, "encode");

        $mobile_sec = encryptField($mobile, "encode");

        $user_email_sec = encryptField($user_email, "encode");

        if ($gubun == "email") {
            $row = $this->member->where(['user_email' => $user_email_sec, 'user_name' => $user_name_sec])->first();
        } else {
            $row = $this->member->where(['user_mobile' => $mobile_sec, 'user_name' => $user_name_sec])->first();
        }

        if (!$row) {
            return $this->response->setJSON([
                'result' => 'NO',
                'msg' => '일치하는 정보가 없습니다.'
            ]);
        }

        $user_id = $row["user_id"];

        if ($gubun == "email") {
            if (email_chk_ok($cert_num) != "Y") {
                return $this->response->setJSON([
                        'result' => 'NO',
                        'msg' => "인증번호가 일치하지 않습니다."]
                );
            }
            $code = "A11";
            $user_mail = $user_email;
            $_tmp_fir_array = [
                'member_id' => $user_id
            ];
            autoEmail($code, $user_mail, $_tmp_fir_array);

            return $this->response->setJSON([
                'result' => 'OK',
                'msg' => '가입하신 이메일으로 아이디가 발송되었습니다.'
            ]);
        } else {
            if (phone_chk_ok($cert_num) != "Y") {
                return $this->response->setJSON([
                        'result' => 'NO',
                        'msg' => "인증번호가 일치하지 않습니다."]
                );
            }
            if (str_replace("-", "", $mobile)) {
                $code = "S11";
                $to_phone = $mobile;
                $_tmp_fir_array = [
                    'MEMBER_NAME' => $user_name,
                    'MEMBER_ID' => $user_id
                ];
                autoSms($code, $to_phone, $_tmp_fir_array);

                return $this->response->setJSON([
                    'result' => 'OK',
                    'msg' => '가입하신 휴대폰으로 아이디가 발송되었습니다.'
                ]);

            }
        }
    }

    public function find_pw_ok()
    {
        $mobile = updateSQ($this->request->getPost('mobile'));
        $user_name = updateSQ($this->request->getPost('user_name'));
        $user_email = updateSQ($this->request->getPost('user_email'));
        $cert_num = updateSQ($this->request->getPost('cert_num'));
        $gubun = updateSQ($this->request->getPost('gubun'));
        $user_id = updateSQ($this->request->getPost('user_id'));

        $mobile_sec = encryptField($mobile, "encode");
        $user_email_sec = encryptField($user_email, "encode");
        $user_name_sec = encryptField($user_name, "encode");

        if ($gubun == "email") {
            $row = $this->member->where(['user_email' => $user_email_sec, 'user_name' => $user_name_sec, 'user_id' => $user_id])->first();
        } else {
            $row = $this->member->where(['user_mobile' => $mobile_sec, 'user_name' => $user_name_sec, 'user_id' => $user_id])->first();
        }


        if (!$row) {
            return $this->response->setJSON([
                'result' => 'NO',
                'msg' => "일치하는 정보가 없습니다."
            ]);
        }

        if ($gubun == "email") {
            if (email_chk_ok($cert_num) != "Y") {
                return $this->response->setJSON([
                    'result' => 'NO',
                    'msg' => "인증번호가 일치하지 않습니다."
                ]);
            }
        } else {
            if (phone_chk_ok($cert_num) != "Y") {
                return $this->response->setJSON([
                    'result' => 'NO',
                    'msg' => "인증번호가 일치하지 않습니다."
                ]);
            }
        }

        $user_id = $row["user_id"];
        $passwd = get_rand(8);

        $this->member->where(['user_id' => $user_id])->set(['user_pw' => password_hash($passwd, PASSWORD_BCRYPT)])->update();

        if ($gubun == "email") {
            $code = "A12";
            $user_mail = $user_email;
            $_tmp_fir_array = [
                'user_pw' => $passwd
            ];
            autoEmail($code, $user_mail, $_tmp_fir_array);
            return $this->response->setJSON([
                'result' => 'OK',
                'msg' => '가입하신 임메일으로 임시패스워드가 발송되었습니다.'
            ]);
        } else {
            $code = "S12";
            $to_phone = $mobile;
            $_tmp_fir_array = [
                'MEMBER_PW' => $passwd
            ];
            autoSms($code, $to_phone, $_tmp_fir_array);
            return $this->response->setJSON([
                'result' => 'OK',
                'msg' => '가입하신 휴대폰으로 임시패스워드가 발송되었습니다.'
            ]);
        }
    }

    public function mem_detail()
    {
        $user_id = updateSQ($this->request->getVar('user_id'));
        $row = $this->member->getByUserId($user_id);
        return $this->response->setJSON($row);
    }

    public function memberOrder()
    {
        try {
            $memberIdx = updateSQ($this->request->getVar('member'));

            $pg = $this->request->getVar("pg");
            $g_list_rows = 10;
            if ($pg == "") {
                $pg = 1;
            }

            $where = ['m_idx' => $memberIdx];

            $result = $this->ordersModel->getOrders('', 'product_name', $pg, $g_list_rows, $where);
            $nTotalCount = $result['nTotalCount'];
            $nPage = $result['nPage'];
            $num = $result['num'];

            $member = $this->member->getByIdx($memberIdx);

            $data = [
                'nTotalCount' => $nTotalCount,
                'nPage' => $nPage,
                'g_list_rows' => $g_list_rows,
                'pg' => $pg,
                'num' => $num,
                'member' => $member,
                'order_list' => $result['order_list'],
            ];

            return view('admin/_member/member_order', $data);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'data' => null,
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function memberCoupon()
    {
        return view('admin/_member/member_coupon');
    }

    public function memberReserve()
    {
        return view('admin/_member/member_reserve');
    }
}