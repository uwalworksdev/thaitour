<?php

namespace App\Controllers;

use App\Libraries\NaverOAuth;

class NaverLogin extends BaseController
{
    public function login()
    {
        $naver = new NaverOAuth();
        return redirect()->to($naver->getLoginUrl());
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
		  $client_id     = "thHkJbn94PdAfE38YW5r";
		  $client_secret = "Y5V6L6ryPj";
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
					echo "status_code:".$status_code ." mb_uid- ". $mb_uid ." email- ".$me_responseArr['response']['email'] ." nickname- ".$me_responseArr['response']['nickname']; 
					echo " gender- ".$me_responseArr['response']['gender']; 
				}
				
		  } else {
			    echo "Error 내용:".$response;
		  }		
    }


}
