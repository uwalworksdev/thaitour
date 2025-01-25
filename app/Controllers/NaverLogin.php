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
		$naver = new \App\Libraries\NaverOAuth();

		$code = $this->request->getGet('code');
		$state = $this->request->getGet('state');

		try {
			// Access token 요청
			$tokenData = $naver->getAccessToken($code, $state);

			// Access token이 없거나 오류 발생
			if (!isset($tokenData['access_token'])) {
				return redirect()->to('/login')->with(
					'error',
					'더투어랩 서비스 설정에 오류가 있어 네이버 아이디로 로그인할 수 없습니다. 같은 문제가 계속 발생하면 더투어랩 서비스의 관리자에게 문의해 주세요.'
				);
			}

			// 사용자 정보 요청
			$userInfo = $naver->getUserInfo($tokenData['access_token']);

			// 사용자 정보가 없을 경우
			if (!isset($userInfo['response'])) {
				return redirect()->to('/login')->with(
					'error',
					'더투어랩 서비스 설정에 오류가 있어 네이버 아이디로 로그인할 수 없습니다. 같은 문제가 계속 발생하면 더투어랩 서비스의 관리자에게 문의해 주세요.'
				);
			}

			// 로그인 성공 처리
			session()->set('user', $userInfo['response']);
			return redirect()->to('/dashboard');
		} catch (\Exception $e) {
			// 예외 발생 시 처리
			return redirect()->to('/login')->with(
				'error',
				'더투어랩 서비스 설정에 오류가 있어 네이버 아이디로 로그인할 수 없습니다. 같은 문제가 계속 발생하면 더투어랩 서비스의 관리자에게 문의해 주세요.'
			);
		}
	}

}
