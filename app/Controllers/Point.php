<?php

namespace App\Controllers;
use Exception;

class Point extends BaseController
{
    private $bannerModel;
    private $bbsModel;
    private $codeModel;
    private $localGuide;
    private $localGuideImg;
    private $localProduct;
    private $hotelArea;
    private $hotelThemeSub;
    private $hotelTheme;

    public function __construct()
    {
        helper('my_helper');
        helper('comment_helper');
        helper('coupon_helper');

        $this->bannerModel = model("Banner_model");
        $this->bbsModel = model("Bbs");
        $this->codeModel = model("Code");
        $this->localGuide       = model("LocalGuideModel");
        $this->localGuideImg    = model("LocalGuideImg");
        $this->localProduct     = model("LocalProductModel");
        $this->hotelThemeSub    = model("HotelThemeSub");
        $this->hotelArea        = model("HotelAreaTheme");
        $this->hotelTheme       = model("HotelThemeModel");
    }

    public function index() {
        return view('point-system/index');
    }
    public function TravelTips() {

        $tour_list = $this->bbsModel->ListByCode("tour")->limit(3)->get()->getResultArray();
        $infographics_list = $this->bbsModel->ListByCode("infographics")->limit(5)->get()->getResultArray();
        $magazines = $this->bbsModel->List("magazines", [])->findAll();

        $local_product_list = $this->localProduct->get_list();

        $hotel_theme_list = $this->hotelTheme->get_list([], 2, 1, ['idx' => 'DESC'])['items'];
        
        return view('travel/travel-tips',[
            'tour_list' => $tour_list,
            'infographics_list' => $infographics_list,
            'bannerTop' => $this->bannerModel->getBanners("5902", "top")[0],
            'bannerMiddle' => $this->bannerModel->getBanners("5902", "middle"),
            'magazines' => $magazines,
            'local_product_list' => $local_product_list,
            'hotel_theme_list' => $hotel_theme_list,
        ]);
    }

    public function ThemeMain() {

        $g_list_rows = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 12; 
        $pg = updateSQ($_GET["pg"] ?? '1');

        $hotel_theme_list = $this->hotelTheme->get_list([], $g_list_rows, $pg, ['idx' => 'DESC']);

        return view('travel/theme_main', [
            "hotel_theme_list" => $hotel_theme_list
        ]);
    }

    public function ThemeView() {
        $theme_idx = updateSQ($_GET["theme_idx"]);
        $theme = $this->hotelTheme->find($theme_idx);

        $area_list = $this->hotelArea->where("theme_idx", $theme["idx"])->findAll();

        foreach ($area_list as $key => $item) {
            $area_list[$key]['category_name'] = $this->codeModel->getCodeName($item['category_code']);
            $area_list[$key]['product_list'] = $this->hotelThemeSub->where("ha_idx", $item['ha_idx'])
                                                                    ->orderBy("step", "ASC")
                                                                    ->orderBy("s_idx", "ASC")
                                                                    ->findAll();
        }

        return view('travel/theme_view_area', [
            "theme" => $theme,
            "area_list" => $area_list
        ]);
    }

    public function ThemeTravel() {
        $g_list_rows        = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg                 = updateSQ($_GET["pg"] ?? '1');
        $city_code          = updateSQ($_GET["city_code"] ?? '');
        $category_code      = updateSQ($_GET["category_code"] ?? '');
        $town_code          = updateSQ($_GET["town_code"] ?? '');
        $subcategory_code   = updateSQ($_GET["subcategory_code"] ?? '');
        $search_txt         = updateSQ($_GET["search_txt"] ?? '');

        $category_code_list = $this->codeModel->getListByParentCode("6004") ?? [];
        $city_code_list = $this->codeModel->getListByParentCode("6003") ?? [];

        $code_active_name = $city_code_list[0]['code_name'];
        $code_no_active = $city_code_list[0]['code_no'];

        $town_code_list = $this->codeModel->getListByParentCode($code_no_active) ?? [];

        if(!empty($city_code)) {
            $code_no_active = $city_code;
            $town_code_list = $this->codeModel->getListByParentCode($city_code) ?? [];
            $code_active_name = $this->codeModel->getCodeName($city_code);
        }

        if(!empty($category_code)) {
            $subcategory_code_list = $this->codeModel->getListByParentCode($category_code) ?? [];
        }

        $where = [
            'search_txt'        => $search_txt,
            'city_code'         => $code_no_active,
            'category_code'     => $category_code,
            'town_code'         => $town_code,
            'subcategory_code'  => $subcategory_code,
        ];

        $local_guide_list = $this->localGuide->get_list($where, $g_list_rows, $pg);

        $data = [
            'category_code_list' => $category_code_list,
            'city_code_list' => $city_code_list,
            'town_code_list' => $town_code_list,
            'subcategory_code_list' => $subcategory_code_list,
            'local_guide_list' => $local_guide_list,
            'code_active_name' => $code_active_name,
        ];

        $merged = array_merge($data, $where);

        return view('travel/theme_travel', $merged);
    }
    public function locguideThemeList() {

        $category_code = updateSQ($_GET["category_code"] ?? '');
        $category_list = $this->codeModel->getListByParentCode("6004") ?? [];

        $where = [
            'category_code' => $category_code,
        ];

        $local_product_list = $this->localProduct->get_list($where);

        return view('travel/locguide_theme_list', [
            'category_list' => $category_list,
            'local_product_list' => $local_product_list,
            'category_code' => $category_code,
        ]);
    }

    public function HotPlace() {
        $g_list_rows        = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg                 = updateSQ($_GET["pg"] ?? '1');
        $city_code          = updateSQ($_GET["city_code"] ?? '');
        $search_txt         = updateSQ($_GET["search_txt"] ?? '');
        $lp_idx             = updateSQ($_GET["lp_idx"] ?? '');

        $city_code_list = $this->codeModel->getListByParentCode("6003") ?? [];

        $code_active_name = $city_code_list[0]['code_name'];
        $code_no_active = $city_code_list[0]['code_no'];

        if(!empty($city_code)) {
            $code_no_active = $city_code;
            $code_active_name = $this->codeModel->getCodeName($city_code);
        }

        $where = [
            'search_txt'        => $search_txt,
            'city_code'         => $code_no_active,
        ];

        $local_prod = $this->localProduct->find($lp_idx);

        $local_guide_list = $this->localGuide->get_list($where, $g_list_rows, $pg);

        $data = [
            'city_code_list' => $city_code_list,
            'local_guide_list' => $local_guide_list,
            'code_active_name' => $code_active_name,
            'lp_idx' => $lp_idx,
            'local_prod' => $local_prod,
        ];

        $merged = array_merge($data, $where);

        return view('travel/hot-place', $merged);
    }

    public function viewDetail() {
        $lg_idx = updateSQ($this->request->getGet('lg_idx') ?? '');

        $local_detail = $this->localGuide->find($lg_idx);

        $local_prd = $this->localProduct->find($local_detail['lp_idx']);

        $city_name = $this->codeModel->getCodeName($local_prd['city_code']);
        $town_name = $this->codeModel->getCodeName($local_detail['town_code']);

        $img_list  = $this->localGuideImg->getImg($lg_idx);

        $data = [
            "city_name" => $city_name,
            "town_name" => $town_name,
            "local_detail" => $local_detail,
            "img_list" => $img_list
        ];

        return view('travel/view_detail', $data);
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

        $travel_before = $this->bbsModel->View($bbs_idx);

        $hit = $travel_before["hit"] ?? 0;
        $hit = $hit + 1;
        $this->bbsModel->InfoUpdate($bbs_idx, [
            "hit" => $hit
        ]);

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
