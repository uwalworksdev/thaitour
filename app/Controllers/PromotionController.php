<?php

namespace App\Controllers;
use CodeIgniter\Database\Config;

class PromotionController extends BaseController
{
    protected $connect;
    protected $cateBannerModel;
    protected $areaPromotion;
    protected $productPromotion;
    protected $promotionList;
    protected $codeModel;
    protected $promotionImg;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->cateBannerModel = model("Banner_model");
        $this->areaPromotion = model("AreaPromotion");
        $this->codeModel = model("Code");
        $this->productPromotion = model("ProductPromotion");
        $this->promotionImg     = model("PromotionImg");
        $this->promotionList    = model("PromotionList");
        
        helper('my_helper');
        helper('alert_helper');
    }
    public function index() {
        $idx = updateSQ($_GET["idx"] ?? '');
        // $banner_promotion = $this->cateBannerModel->getBanners("5904");
        
        $code_list = $this->codeModel->whereIn('code_no', ['6201', '6202', '6203'])
                            ->where('status', 'Y')
                            ->orderBy('onum', 'ASC')
                            ->orderBy('code_idx', 'ASC')->findAll();

        foreach($code_list as $key => $code) {
            $code_list[$key]['code_child_list'] = $this->codeModel->getByParentCode($code['code_no'])->getResultArray();
        }

        if ($idx) {
            $row = $this->promotionList->find($idx);

            $this->promotionList->update($idx, ['hit' => $row['hit'] + 1]);

            $banner_promotion = $this->promotionImg->getImg($idx, 'P');
            $banner_promotion_mo = $this->promotionImg->getImg($idx, 'M');

            $area_list = $this->areaPromotion->where("promotion_idx", $idx)->orderBy("onum", "ASC")->orderBy("idx", "ASC")->findAll();
            $product_list = $this->productPromotion->where("promotion_idx", $idx)->orderBy("onum", "ASC")->orderBy("idx", "ASC")->findAll();
        }

        $code_1 = $this->codeModel->getByCodeNo('6204');
        $code_2 = $this->codeModel->getByCodeNo('6205');

        return view('event/promotion',[
            'banner_promotion' => $banner_promotion ?? [],
            'banner_promotion_mo' => $banner_promotion_mo ?? [],
            'area_list' => $area_list,
            'code_list' => $code_list,
            'product_list' => $product_list ?? [],
            'row' => $row ?? [],
            'code_2' => $code_2,
            'code_1' => $code_1
        ]);
    }
}