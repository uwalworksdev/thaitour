<?php

namespace App\Controllers;
use Exception;

class Point extends BaseController
{

    private $bannerModel;

    public function __construct()
    {
        helper('my_helper');
        helper('comment_helper');
        helper('coupon_helper');

        $this->bannerModel = model("Banner_model");
    }

    public function index() {
        return view('point-system/index');
    }
    public function TravelTips() {
        return view('travel/travel-tips',[
            'bannerTop' => $this->bannerModel->getBanners("5902", "top")[0],
            'bannerMiddle' => $this->bannerModel->getBanners("5902", "middle"),
        ]);
    }

    public function HotPlace() {
        return view('travel/hot-place');
    }
    public function TravelInfo() {
        return view('travel/travel-info');
    }
    public function Infographic() {
        return view('travel/infographic');
    }

    
}
