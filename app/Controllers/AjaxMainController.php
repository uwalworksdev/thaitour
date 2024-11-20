<?php

namespace App\Controllers;

class AjaxMainController extends BaseController {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function get_best() 
	{
        $list  = $this->request->getPost('list');
        $code  = $this->request->getPost('code');
        $db    = \Config\Database::connect();
/*
        $sql = "SELECT * FROM tbl_code WHERE parent_code_no = '$code' AND depth = '$depth' order by onum desc";
        $cnt = $db->query($sql)->getNumRows();

        $rows = $db->query($sql)->getResultArray();
        $data = "";
        $data .= "<option value=''>선택</option>";
        foreach ($rows as $row) {
            $data .= "<option value='$row[code_no]'>$row[code_name]</option>";
        }

        $output = [
            "data"  => $data,
            "cnt"   => $cnt
        ];
*/
    $msg = <<<EOD

<a href="/product-hotel/hotel-detail/1912" class="best_list_item">
                            <div class="img_box img_box_3">
                                <img src="/data/hotel/1729498392_26fc8b1964767785461b.png" alt="main">
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb_item">방콕</li>
                                <li class="breadcrumb_item">시암</li>
                            </ul>
                            <div class="prd_name">
                                테스트 상품                            </div>
                            <div class="prd_info">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <div class="prd_price_ko">
                                240,001 <span>원</span>
                            </div>
                            <div class="prd_price_thai">
                                6,000 <span>바트</span>
                            </div>
                        </a>
EOD;

        //$msg = $list ." - ". $code ."작업완료";
        $output = [
            "message"  => $msg
        ];

		return $this->response->setJSON($output);
    }
}