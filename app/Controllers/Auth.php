<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class Auth extends Controller
{
    private $clientId     = "ikuc9S8jLfOESEsjf5vR";
    private $clientSecret = "258hGtXyrB";
    private $redirectUri  = "http://localhost:8080/auth/naverCallback";

    // 네이버 로그인 URL 생성
    public function naverLogin()
    {
        $state = bin2hex(random_bytes(16)); // CSRF 방지를 위한 상태 값
        session()->set('naver_state', $state);

        $naverAuthUrl = "https://nid.naver.com/oauth2.0/authorize?"
            . "response_type=code"
            . "&client_id={$this->clientId}"
            . "&state={$state}"
            . "&redirect_uri=" . urlencode($this->redirectUri);

        return redirect()->to($naverAuthUrl);
    }

    // 네이버 로그인 콜백 처리
    public function naverCallback()
    {
        $code = $this->request->getGet('code');
        $state = $this->request->getGet('state');

        if (!$code || !$state || $state !== session()->get('naver_state')) {
            return "잘못된 접근입니다.";
        }

        // 액세스 토큰 요청
        $tokenUrl = "https://nid.naver.com/oauth2.0/token?"
            . "grant_type=authorization_code"
            . "&client_id={$this->clientId}"
            . "&client_secret={$this->clientSecret}"
            . "&code={$code}"
            . "&state={$state}";

        $response = file_get_contents($tokenUrl);
        $tokenData = json_decode($response, true);

        if (!isset($tokenData['access_token'])) {
            return "토큰 발급 실패";
        }

        // 사용자 정보 요청
        $userInfo = $this->getUserProfile($tokenData['access_token']);

        if (!$userInfo) {
            return "네이버 로그인 실패";
        }

        // 로그인 세션 저장
        session()->set('user', $userInfo);

        return redirect()->to('/'); // 로그인 후 메인 페이지로 이동
    }

    // 네이버 사용자 정보 가져오기
    private function getUserProfile($accessToken)
    {
        $url = "https://openapi.naver.com/v1/nid/me";
        $headers = ["Authorization: Bearer $accessToken"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        return $data['response'] ?? null;
    }

    // 로그아웃
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
