<?php

namespace App\Controllers;
use CodeIgniter\Database\Config;

class PromotionController extends BaseController
{
    protected $connect;
    protected $cateBannerModel;
    protected $areaPromotion;
    protected $productPromotion;
    protected $codeModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->cateBannerModel = model("Banner_model");
        $this->areaPromotion = model("AreaPromotion");
        $this->codeModel = model("Code");
        $this->productPromotion = model("ProductPromotion");
        
        helper('my_helper');
        helper('alert_helper');
    }
    public function index() {
        $banner_promotion = $this->cateBannerModel->getBanners("5904");
        $area_list = $this->areaPromotion->get_list();
        
        $code_list = $this->codeModel->whereIn('code_no', ['6201', '6202', '6203'])
                            ->where('status', 'Y')
                            ->orderBy('onum', 'ASC')
                            ->orderBy('code_idx', 'ASC')->findAll();

        foreach($code_list as $key => $code) {
            $code_list[$key]['code_child_list'] = $this->codeModel->getByParentCode($code['code_no'])->getResultArray();
        }

        $product_list = $this->productPromotion->get_list();

        return view('event/promotion',[
            'banner_promotion' => $banner_promotion,
            'area_list' => $area_list,
            'code_list' => $code_list,
            'product_list' => $product_list,
        ]);
    }
}