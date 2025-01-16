<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SaveUrlFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 제외할 URL 목록
        $excludedUrls = [
            '/member/login',       // 로그인 페이지
            '/member/logout',      // 로그아웃 페이지
            '/member/join_choice', // 회원가입 페이지
			'/member/join_agree',  // 회원가입 페이지
			'/member/join_form',   // 회원가입 페이지
        ];

        // 현재 URL 가져오기
        $currentUrl = current_url();

        // 제외할 URL에 포함되지 않으면 세션에 저장
        if (!in_array(parse_url($currentUrl, PHP_URL_PATH), $excludedUrls)) {
            session()->set('last_visited_url', $currentUrl);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 아무 작업도 필요 없음
    }
}
