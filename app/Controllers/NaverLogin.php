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
            }

            $userInfo = $naverOAuth->getUserInfo($tokenData['access_token']);
            if (!isset($userInfo['response'])) {
                throw new \Exception('사용자 정보를 가져올 수 없습니다.');
            }

            session()->set('user', $userInfo['response']);
            return redirect()->to('/dashboard');
        } catch (\Exception $e) {
            log_message('error', '네이버 로그인 콜백 오류: ' . $e->getMessage());
            return redirect()->to('/login')->with('error', '로그인 중 문제가 발생했습니다.');
        }
    }


}
