<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ErrorController extends Controller
{
    public function show404()
    {
        return redirect()->to('/');
    }
}