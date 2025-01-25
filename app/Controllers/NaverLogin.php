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
        $naver = new NaverOAuth();

        $code  = $this->request->getGet('code');
        $state = $this->request->getGet('state');

        try {
            $tokenData = $naver->getAccessToken($code, $state);
            $userInfo = $naver->getUserInfo($tokenData['access_token']);

            if ($userInfo['response']) {
                // 사용자 정보 저장 또는 세션 설정
                session()->set('user', $userInfo['response']);
                return redirect()->to('/dashboard');
            }

            return redirect()->to('/login')->with('error', '네이버 로그인에 실패했습니다.');
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', $e->getMessage());
        }
    }
}
