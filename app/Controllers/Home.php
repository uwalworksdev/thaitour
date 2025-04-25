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
 		
		$builder = $this->db->table('tbl_product_mst');
		$builder->select('product_idx');
		$builder->where('product_code_1', '1302');
		$query = $builder->get();
		$golf_result = $query->getResultArray();

		foreach ($golf_result as $golf_row):
			$productIdx = $golf_row['product_idx'];

			// 당일 최저가 조회
			$builder = $this->db->table('tbl_golf_price');
			$builder->selectMin('price_1');
			$builder->where('product_idx', $productIdx);
			$builder->where('goods_date', date('Y-m-d'));
			$builder->where('price_1 >', 0);
			$query = $builder->get();
			$row = $query->getRow();

			if ($row && $row->price_1 > 0) {
				$price = $row->price_1;
			} else {
				// 다음 날짜 최저가 조회
				$builder = $this->db->table('tbl_golf_price');
				$builder->select('price_1');
				$builder->where('product_idx', $productIdx);
				$builder->where('goods_date >', date('Y-m-d'));
				$builder->where('price_1 >', 0);
				$builder->orderBy('goods_date', 'ASC');
				$builder->limit(1);
				$query = $builder->get();
				$nextRow = $query->getRow();

				$price = $nextRow ? $nextRow->price_1 : 0;
			}

			// 가격 업데이트
			$updateBuilder = $this->db->table('tbl_product_mst');
			$updateBuilder->where('product_idx', $productIdx);
			$updateBuilder->update(['product_price' => $price]);
            write_log("last- ". $this->db->getLastQuery());
		endforeach;

 		
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

		// 1주일간 예약순위 : 골프
		$list3 = $MainDisp->List("290101");

		// 태국에서 즐기는 5성급 호텔의 특별함
		$list4 = $MainDisp->List("2903");

		// 태국에서 즐기는 골프의 특별함
		$list5 = $MainDisp->List("2905");

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
            'list3'        => $list3,
            'list4'        => $list4,
            'list5'        => $list5,
            "main"         => true,
        ];

        $data['magazines'] = $magazines;

        return $this->renderView('main/main', $data);
    }
}
