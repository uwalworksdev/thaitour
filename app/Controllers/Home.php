<?php

namespace App\Controllers;

use Config\CustomConstants as ConfigCustomConstants;

class Home extends BaseController
{
    private $CodeModel;
    private $cmsModel;
    protected $bbsModel;
    private $reviewModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->CodeModel = model("Code");
        $this->cmsModel = model("CmsModel");
        $this->reviewModel = model("ReviewModel");
        helper('my_helper');
        $this->bbsModel = new \App\Models\Bbs();
        $constants = new ConfigCustomConstants();
    }

    public function index(): string
    {
        $codes = $this->CodeModel->getByParentCode('50')->getResultArray();
        $codeBanners = $this->CodeModel->getByParentCode('51')->getResultArray();

        $magazines = $this->bbsModel->List("magazines", [])->findAll();

        $search_category = $this->request->getVar('search_category');
        $s_txt = $this->request->getVar('s_txt');

        $best_reviews = $this->reviewModel->getBestReviews($s_txt, $search_category);

        $best_reviews = array_map(function ($review) {
            $review_type = $review['review_type'];

            $_arr_review_types = explode("|", $review_type);

            $list__review_types = rtrim(implode(',', $_arr_review_types), ',');

            $list_code_type = [];
            if (count($_arr_review_types) > 0) {
                if ($list__review_types && $list__review_types != "") {
                    $sql = "SELECT * FROM tbl_code WHERE parent_code_no=42 AND code_no IN ($list__review_types) ORDER BY onum ";
                    $list_code_type = $this->db->query($sql)->getResultArray();
                }
            }

            $review['list_code_type'] = $list_code_type;

            $sql = "SELECT * FROM tbl_code WHERE code_no = '" . $review['travel_type'] . "' ORDER BY onum ";
            $code = $this->db->query($sql)->getRowArray();

            $review['code_name'] = $code['code_name'] ?? '가지고 있지 않다';

            return $review;
        }, $best_reviews);

$MainDisp = model("MainDispModel"); // 방콕

// 취향저격 더투어랩 Best
$list1_1 = $MainDisp->List("290401");

// 파타야
$list1_2 = $MainDisp->List("290402");

// 푸켓
$list1_3 = $MainDisp->List("290403");

// 치앙마이
$list1_4 = $MainDisp->List("290404");

// 1주일간 예약순위 : 호텔
$list2 = $MainDisp->List("290201");

        $data = [
            'codes'        => $codes,
            'best_reviews' => $best_reviews,
            'codeBanners'  => $codeBanners,
            'popups'       => $this->cmsModel->getPaging(['r_code' => 'popup', 'sch_status' => 'Y'], 5, 1)['items'],
            'list1_1'      => $list1_1,
            'list1_2'      => $list1_2,
            'list1_3'      => $list1_3,
            'list1_4'      => $list1_4,
            'list2'        => $list2,
        ];

        $data['magazines'] = $magazines;

        return $this->renderView('main/main', $data);
    }
}
