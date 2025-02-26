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
/*		
        try {
            $code  = $this->request->getGet('code');
            $state = $this->request->getGet('state');

			if (!$code || !$state) {
                throw new \Exception('코드 또는 상태 값이 없습니다.');
            }

            $naverOAuth = new \App\Libraries\NaverOAuth();
            $tokenData = $naverOAuth->getAccessToken($code, $state);

            if (!isset($tokenData['access_token'])) {
                throw new \Exception('Access token을 가져올 수 없습니다.');
				write_log('error', 'Access token을 가져올 수 없습니다.');
            }

            $userInfo = $naverOAuth->getUserInfo($tokenData['access_token']);
            if (!isset($userInfo['response'])) {
                throw new \Exception('사용자 정보를 가져올 수 없습니다.');
				write_log('error', '사용자 정보를 가져올 수 없습니다.');
            }

            session()->set('user', $userInfo['response']);
            return redirect()->to('/dashboard');
        } catch (\Exception $e) {
			log_message('debug', 'OAuth 요청 state: ' . session()->get('naver_oauth_state'));
			log_message('debug', '콜백 state: ' . $this->request->getGet('state'));
			log_message('debug', 'Access Token 데이터: ' . json_encode($tokenData));			
            log_message('error', '네이버 로그인 콜백 오류: ' . $e->getMessage());
            return redirect()->to('/login')->with('error', '로그인 중 문제가 발생했습니다.');
        }
*/		
		  // 네이버 로그인 콜백 예제
		//   $client_id     = "thHkJbn94PdAfE38YW5r";
		//   $client_secret = "Y5V6L6ryPj";
		  $client_id     = "88iJ2d8Q8uhaY9JGQkGZ";
		  $client_secret = "QeTEe2b_V5";
		  $code          = $_GET["code"];
		  $state         = $_GET["state"];
		  $redirectURI   = urlencode("https://thetourlab.com/member/login_check");
		  $url           = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
		  $is_post       = false;
		  $ch            = curl_init();
		  curl_setopt($ch, CURLOPT_URL, $url);
		  curl_setopt($ch, CURLOPT_POST, $is_post);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  $headers     = array();
		  $response    = curl_exec ($ch);
		  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		  curl_close ($ch);
		  if($status_code == 200) {
				$responseArr = json_decode($response, true);
				$_SESSION['naver_access_token']  = $responseArr['access_token']; 
				$_SESSION['naver_refresh_token'] = $responseArr['refresh_token'];
				
				// 토큰값으로 네이버 회원정보 가져오기 
				$me_headers = array( 
					'Content-Type: application/json', 
					 sprintf('Authorization: Bearer %s', $responseArr['access_token']) 
				); 
				$me_is_post = false;
				$me_ch = curl_init();
				curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me"); 
				curl_setopt($me_ch, CURLOPT_POST, $me_is_post); 
				curl_setopt($me_ch, CURLOPT_HTTPHEADER, $me_headers); 
				curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true); 
				$me_response = curl_exec ($me_ch); 
				$me_status_code = curl_getinfo($me_ch, CURLINFO_HTTP_CODE); 
				curl_close ($me_ch); 
				$me_responseArr = json_decode($me_response, true);
				//echo $me_responseArr['response']['id'];
				if ($me_responseArr['response']['id']) { 
					// 회원아이디(naver_ 접두사에 네이버 아이디를 붙여줌) 
					$mb_uid = 'naver_'.$me_responseArr['response']['id']; 

					$sql = " select * from tbl_member where user_id = '" . $mb_uid . "'";
					$row = $this->db->query($sql)->getRowArray();
					$session = session();
					$session->set('sns.gubun', 'naver');

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
									  set login_count = login_count+1
										, login_date = now()
									where user_id='" . $mb_uid . "'
								 ";
						$this->db->query($total_sql);
		
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
					// 회원정보가 없다면 회원가입 
					else {
						// 회원아이디 $mb_uid
						$userName = $me_responseArr['response']['nickname']; // 이메일 
						$userEmail = $me_responseArr['response']['email']; // 이메일 
						$gender = $me_responseArr['response']['gender']; // 성별 F: 여성, M: 남성, U: 확인불가 
						$mb_age = $me_responseArr['response']['age']; // 연령대 
						$mb_birthday = $me_responseArr['response']['birthday']; // 생일(MM-DD 형식) 
						$sns_key = $responseArr['access_token'];
			
						$data['id'] = $mb_uid;
						$data['sns_key'] = $sns_key;
						$data['name'] = $userName;
						$data['email'] = $userEmail;

						return $this->redirectForm('/member/join_form_sns', [
							'gubun' => 'naver',
							'sns_key' => $sns_key,
							'userEmail' => $userEmail,
							'user_name' => $userName
						]);
					}

					// echo "status_code:".$status_code ." mb_uid- ". $mb_uid ." email- ".$me_responseArr['response']['email'] ." nickname- ".$me_responseArr['response']['nickname']; 
					// echo " gender- ".$me_responseArr['response']['gender'] ." age- ".$me_responseArr['response']['age'] ." birthday- ".$me_responseArr['response']['birthday']; 
					// echo " birthyear- ".$me_responseArr['response']['birthyear'] ." mobile- ".$me_responseArr['response']['mobile']; 
				}
				
		  } else {
			    echo "Error 내용:".$response;
		  }		
    }


}
