<?php

namespace App\Controllers;
use Exception;

class Point extends BaseController
{
    private $bannerModel;
    private $bbsModel;

    public function __construct()
    {
        helper('my_helper');
        helper('comment_helper');
        helper('coupon_helper');

        $this->bannerModel = model("Banner_model");
        $this->bbsModel = model("Bbs");
    }

    public function index() {
        return view('point-system/index');
    }
    public function TravelTips() {

        $tour_list = $this->bbsModel->ListByCode("tour")->limit(3)->get()->getResultArray();
        $infographics_list = $this->bbsModel->ListByCode("infographics")->limit(5)->get()->getResultArray();

        return view('travel/travel-tips',[
            'tour_list' => $tour_list,
            'infographics_list' => $infographics_list,
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
