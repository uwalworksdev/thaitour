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
		  $redirectURI   = urlencode("https://thetourlab.com/naver/callback");
		  $url           = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
		  $is_post       = false;
		  $ch            = curl_init();
		  curl_setopt($ch, CURLOPT_URL, $url);
		  curl_setopt($ch, CURLOPT_POST, $is_post);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  $headers     = array();
		  $response    = curl_exec ($ch);
		  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		  echo "status_code:".$status_code."";
		  curl_close ($ch);
		  if($status_code == 200) {
			echo $response;
		  } else {
			echo "Error 내용:".$response;
		  }		
    }


}
