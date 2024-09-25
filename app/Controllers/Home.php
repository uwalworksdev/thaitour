<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return $this->renderView('main/main');
    }
}
