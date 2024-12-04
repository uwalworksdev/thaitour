<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\I18n\Time;

class UserAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->has('member') || empty($session->get('member.idx'))) {

            $currentUrl = urlencode($request->getUri());

            return redirect()->to('/member/login?returnUrl=' . $currentUrl)->with('error', '로그인 필요합니다....');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
