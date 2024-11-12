<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\I18n\Time;

class AdminAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->has('member')) {

            $currentUrl = $request->getUri();
            $currentPath = $currentUrl->getPath();

            if ($currentPath === '/AdmMaster/login') {
                return;
            }

            return redirect()->to('/AdmMaster?returnUrl=' . $currentUrl);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
