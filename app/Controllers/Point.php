<?php

namespace App\Controllers;
use Exception;

class Point extends BaseController
{
    private $bannerModel;
    private $bbsModel;
    private $codeModel;

    public function __construct()
    {
        helper('my_helper');
        helper('comment_helper');
        helper('coupon_helper');

        $this->bannerModel = model("Banner_model");
        $this->bbsModel = model("Bbs");
        $this->codeModel = model("Code");
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
        $category = $this->request->getGet('category');
        $search_word = $this->request->getGet('search_word');
        $search_mode = $this->request->getGet('search_mode');
        $pg = $this->request->getGet('pg') ?? 1;
        $g_list_rows = 5;
        $code = "tour";
        
        $builder = $this->bbsModel->ListByCode($code, ['search_word' => $search_word, 'search_mode' => $search_mode, 'category' => $category]);

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);

        $nFrom = ($pg - 1) * $g_list_rows;

        $rows = $builder->paginate($g_list_rows, 'default', $pg);

        $data = [
            'category' => $category,
            'search_mode' => $search_mode,
            'search_word' => $search_word,
            'nTotalCount' => $nTotalCount,
            'g_list_rows' => $g_list_rows,
            'pg' => $pg,
            'nPage' => $nPage,
            'nFrom' => $nFrom,
            'rows' => $rows,
            'code_list' => $this->codeModel->getByParentCode(6001)->getResultArray()
        ];

        return view('travel/travel-info', $data);
    }
    public function Infographic() {

        $category = $this->request->getGet('category');
        $search_word = $this->request->getGet('search_word');
        $search_mode = $this->request->getGet('search_mode');
        $pg = $this->request->getGet('pg') ?? 1;
        $g_list_rows = 8;
        $code = "infographics";
        
        $builder = $this->bbsModel->ListByCode($code, ['search_word' => $search_word, 'search_mode' => $search_mode, 'category' => $category]);

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);

        $nFrom = ($pg - 1) * $g_list_rows;

        $rows = $builder->paginate($g_list_rows, 'default', $pg);

        $data = [
            'category' => $category,
            'search_mode' => $search_mode,
            'search_word' => $search_word,
            'nTotalCount' => $nTotalCount,
            'g_list_rows' => $g_list_rows,
            'pg' => $pg,
            'nPage' => $nPage,
            'nFrom' => $nFrom,
            'rows' => $rows,
            'code_list' => $this->codeModel->getByParentCode(6002)->getResultArray()
        ];

        return view('travel/infographic', $data);
    }

    public function TravelView() {
        $bbs_idx = $_GET['bbs_idx'];

        $travel = $this->bbsModel->View($bbs_idx);

        return view('travel/travel_view', [
            'travel' => $travel
        ]);
    }
    public function InfographicView() {
        $bbs_idx = $_GET['bbs_idx'];

        $infographic = $this->bbsModel->View($bbs_idx);

        return view('travel/infographic_view', [
            'infographic' => $infographic
        ]);
    }
}
