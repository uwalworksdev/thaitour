<?php

namespace App\Controllers;

use App\Libraries\NaverOAuth;

class NaverLogin extends BaseController
{
    private $member;
    protected $db;

	public function __construct()
    {
        $this->db = db_connect();
        $this->member = model("Member");
        helper('my_helper');

    }

    public function login()
    {
        $naver = new NaverOAuth();
        return redirect()->to($naver->getLoginUrl());
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

public function callback()
{
    // 네이버 로그인 콜백 예제
    $client_id     = env('NAVER_CLIENT_ID');
    $client_secret = env('NAVER_CLIENT_SECRET');
    $code          = $_GET["code"];
    $state         = $_GET["state"];
	write_log("callback- ". $state);
    $redirectURI   = urlencode("https://" . $_SERVER["HTTP_HOST"] . "/naver/callback");
    
    // 1. Validate the state parameter to prevent CSRF
    if ($state !== $_SESSION['naver_state']) {
        die("Invalid state parameter!");
    }

    // 네이버 토큰 요청 URL
    $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=" . $client_id . "&client_secret=" . $client_secret . "&redirect_uri=" . $redirectURI . "&code=" . $code . "&state=" . $state;
    
    // cURL 요청
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status_code == 200) {
        $responseArr = json_decode($response, true);
        // 토큰값을 세션에 저장
        $_SESSION['naver_access_token']  = $responseArr['access_token'];
        $_SESSION['naver_refresh_token'] = $responseArr['refresh_token'];

        // 2. 네이버 회원정보 가져오기
        $me_headers = array(
            'Content-Type: application/json',
            sprintf('Authorization: Bearer %s', $responseArr['access_token'])
        );

        $me_ch = curl_init();
        curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me");
        curl_setopt($me_ch, CURLOPT_HTTPHEADER, $me_headers);
        curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true);
        $me_response = curl_exec($me_ch);
        $me_status_code = curl_getinfo($me_ch, CURLINFO_HTTP_CODE);
        curl_close($me_ch);

        if ($me_status_code == 200) {
            $me_responseArr = json_decode($me_response, true);
            if (isset($me_responseArr['response']['id'])) {
                $mb_uid = 'naver_' . $me_responseArr['response']['id'];

                // 회원 정보 조회
                $sql = "SELECT   user_id
				               , m_idx
							   , user_level
							   , gubun
							   , sns_key
							   , mem_level
				               , AES_DECRYPT(UNHEX('{$row['user_name']}'),  '$private_key') AS user_name 
       				           , AES_DECRYPT(UNHEX('{$row['user_email']}'), '$private_key') AS user_email 
				        FROM tbl_member WHERE user_id = '" . $mb_uid . "'";
				write_log("NaverlOGIN- ". $sql);
                $row = $this->db->query($sql)->getRowArray();
                $session = session();

                if (count($row) > 0) {
						// 멤버 DB에 토큰값 업데이트 $responseArr['access_token']
						$asql_s = "update tbl_member set sns_key = '" . $responseArr['access_token'] . "' where user_id = '" . $mb_uid . "' ";
						$this->db->query($asql_s);

						//접속 카운트 
						getLoginDeviceUserChk($row["user_id"]);
		
						//접속 아이피 카운트
						getLoginIPChk();
		
						//write_log("회원로그인 : ".$fsql_s);
		
						// 로그인 횟수를 증가시키고 마지막 접속 일자 변경
						$total_sql = " update tbl_member
									  set login_count =  login_count+1
										, login_date  =  now()
									where user_id     =  '" . $mb_uid . "'
								 ";
						$this->db->query($total_sql);
		
						$session->set('member', [
							'id'      => $row['user_id'],
							'idx'     => $row['m_idx'],
							'mIdx'    => $row['m_idx'],
							'name'    => $row['user_name'],
							'email'   => $row['user_email'],
							'level'   => $row['user_level'],
							'gubun'   => $row['gubun'],
							'sns_key' => $row['sns_key'],
							'mlevel'  => $row['mem_level']
						]);

                    // 로그인 성공 후 리디렉션
					$gubun = substr($state, -3);
					
					if($gubun == "myp") {
                       return redirect()->to('/mypage/info_change');
					} else {
                       return redirect()->to('/');
					}   

				} else {
					// 회원아이디 $mb_uid
					$userName    = $me_responseArr['response']['nickname']; // 이메일 
					$userEmail   = $me_responseArr['response']['email'];    // 이메일 
					$gender      = $me_responseArr['response']['gender'];   // 성별 F: 여성, M: 남성, U: 확인불가 
					$mb_age      = $me_responseArr['response']['age'];      // 연령대 
					$mb_birthday = $me_responseArr['response']['birthday']; // 생일(MM-DD 형식) 
					$sns_key     = $me_responseArr['response']['id'];
		
					$data['id']      = $mb_uid;
					$data['sns_key'] = $sns_key;
					$data['name']    = $userName;
					$data['email']   = $userEmail;

					return $this->redirectForm('/member/join_form_sns', [
						'gubun'     => 'naver',
						'sns_key'   => $sns_key,
						'userEmail' => $userEmail,
						'user_name' => $userName
					]);

                    // 리디렉션
                    return redirect()->to('/');
                }
            }
        } else {
            echo "Error fetching user info: " . $me_response;
        }
    } else {
        echo "Error fetching access token: " . $response;
    }
}



}
