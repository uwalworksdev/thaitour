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
