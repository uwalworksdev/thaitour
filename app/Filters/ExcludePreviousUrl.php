<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ExcludePreviousUrl implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $excludedUrls = [
            '/member/login',
            '/member/join_agree',
        ];

        $currentUrl = current_url(true)->getPath();

        // 현재 URL이 제외 목록에 있는 경우 _ci_previous_url 설정 제거
        if (in_array($currentUrl, $excludedUrls)) {
            session()->remove('_ci_previous_url');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
