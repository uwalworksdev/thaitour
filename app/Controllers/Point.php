<?php

namespace App\Controllers;
use Exception;

class Point extends BaseController
{

    public function index() {
        return view('point-system/index');
    }
    public function TravelTips() {
        return view('travel/travel-tips');
    }
}
