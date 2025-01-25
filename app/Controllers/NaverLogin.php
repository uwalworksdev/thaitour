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
			$naver = new NaverOAuth();
			$code = $this->request->getGet('code');
			$state = $this->request->getGet('state');

			$tokenData = $naver->getAccessToken($code, $state);

			if (!isset($tokenData['access_token'])) {
				throw new \Exception('Access token을 가져올 수 없습니다.');
			}

			$userInfo = $naver->getUserInfo($tokenData['access_token']);

			if (!isset($userInfo['response'])) {
				throw new \Exception('사용자 정보를 가져올 수 없습니다.');
			}

			// 로그인 성공
			session()->set('user', $userInfo['response']);
			return redirect()->to('/dashboard');
		} catch (\Exception $e) {
			log_message('error', '네이버 로그인 오류: ' . $e->getMessage());
			return redirect()->to('/login')->with(
				'error',
				'더투어랩 서비스 설정에 오류가 있어 네이버 아이디로 로그인할 수 없습니다. 같은 문제가 계속 발생하면 관리자에게 문의해 주세요.'
			);
		}
	}


}
