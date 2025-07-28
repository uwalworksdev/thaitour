<?php

namespace App\Controllers;
use CodeIgniter\Database\Config;

class PromotionController extends BaseController
{
    protected $connect;
    protected $cateBannerModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->cateBannerModel = model("Banner_model");
        helper('my_helper');
        helper('alert_helper');
    }
    public function index() {
        $banner_promotion = $this->cateBannerModel->getBanners("5904");
        
        return view('event/promotion',[
            'banner_promotion' => $banner_promotion
        ]);
    }
}