<?php

namespace App\Controllers;

class AjaxMainController extends BaseController {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function get_best()  
	{
		helper(['setting']);
        $setting = homeSetInfo();

        $list  = $this->request->getPost('list');
        $code  = $this->request->getPost('code');
        $db    = \Config\Database::connect();
 
        if($list == "1") $code_no = "290401";  
        if($list == "2") $code_no = "290402";  
        if($list == "3") $code_no = "290403";  
        if($list == "4") $code_no = "290404";  
 
        if($code == "1") $product_code_1 = "1303";  
        if($code == "2") $product_code_1 = "1302";  
        if($code == "3") $product_code_1 = "1301";  
        if($code == "4") $product_code_1 = "1325";  

		$sql   = "SELECT a.*, b.* FROM tbl_main_disp a
		                          LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx 
								  WHERE 1=1 AND b.product_status != 'stop' ";
        if($code_no)        $sql .= " AND a.code_no        = '$code_no' "; 
		if($product_code_1) $sql .= " AND b.product_code_1 = '$product_code_1' ";

		$sql  .= "ORDER BY a.onum ASC ";
        write_log("AjaxMainController- ". $sql);
 
        $rows  = $db->query($sql)->getResultArray();

		foreach ($rows as $key => $value) {
            $product_price = (float)$value['product_price'];
            $baht_thai = (float)($setting['baht_thai'] ?? 0);
            $product_price_won = $product_price * $baht_thai;
            $rows[$key]['product_price_won'] = $product_price_won;
        }

        $msg   = "";
		foreach ($rows as $item): 
			     $img_dir   = img_link($item['product_code_1']);  
			     $prog_link = prog_link($item['product_code_1']);  
			     $msg .= '<a href="'. $prog_link . $item['product_idx'] .'" class="best_list_item">';
				 $msg .= '<div class="img_box img_box_3">';
				 $msg .= '<img src="/data/'. $img_dir .'/'. $item['ufile1'] .'" alt="main">';
				 $msg .= '</div>';
				 $msg .= '<ul class="breadcrumb">';
				 $msg .= '<li class="breadcrumb_item">방콕</li>';
				 $msg .= '<li><img src="/img/ico/ico_next_grey_.png" alt=""></li>';
				 $msg .= '<li class="breadcrumb_item">시암</li>';
				 $msg .= '</ul>';
				 $msg .= '<div class="prd_name" style="margin-top: 14px;">'. $item['product_name'] .'</div>';
				 $msg .= '<div class="prd_info">';
				 $msg .= '<img class="ico_star" src="/images/ico/ico_star.svg" alt="">';
				 $msg .= '<span class="star_avg">4.7</span>';
				 $msg .= '<span class="star_review_cnt">(954)</span></div>';
				 $msg .= '<div class="d_flex justify_content_start align_items_end gap_10">';
                 $msg .= '<div class="prd_price_ko">'. number_format($item['product_price_won']) .'<span> 원</span></div>';
				 $msg .= '<div class="prd_price_thai">'. number_format($item['product_price']) .'<span>바트</span></div>';
			     $msg .= '</div></a>';
		endforeach;
 
        $output = [
            "message"  => $msg
        ];

		return $this->response->setJSON($output);
    }


    public function set_seq()  
	{
		helper(['setting']);
        $setting = homeSetInfo();

        $type     = $this->request->getPost('type');
        $code_no  = $this->request->getPost('local');
        $db    = \Config\Database::connect();
 
		$sql   = "SELECT a.*, b.* FROM tbl_main_disp a
		                          LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx 
								  WHERE a.code_no = '$code_no' AND b.product_status != 'stop' ORDER BY a.onum ASC ";
        write_log("AjaxMainController- ". $sql);
 
        $rows  = $db->query($sql)->getResultArray();

		foreach ($rows as $key => $value) {
            $product_price = (float)$value['product_price'];
            $baht_thai = (float)($setting['baht_thai'] ?? 0);
            $product_price_won = $product_price * $baht_thai;
            $rows[$key]['product_price_won'] = $product_price_won;
        }

        $msg   = "";
		$seq   = 0;
		foreach ($rows as $item3):
			$seq++;
			$img_dir = img_link($item3['product_code_1']);
			$msg .= '<div class="swiper-slide">';
			$msg .= '<a href="'. getUrlFromProduct($item3) .'" class="hot_product_list__item">';
			$msg .= '<div class="img_box img_box_2">';
			$msg .= '<img src="/data/'. $img_dir .'/'. $item3['ufile1'] .'" alt="main">';
			$msg .= '</div>';
			$msg .= '<div class="prd_name">'. $item3['product_name'] .'</div>';
			$msg .= '<div class="d_flex justify_content_start align_items_end gap_10">';
			$msg .= '<div class="prd_price_ko">'. number_format($item3['product_price_won']) .'<span> 원</span></div>';
			$msg .= '<div class="prd_price_thai">'. number_format($item3['product_price']) .'<span> 바트</span></div>';
			$msg .= '</div></a>';
			$msg .= '</div>';
		endforeach;

        $output = [
            "message"  => $msg
        ];

		return $this->response->setJSON($output);
    }

    public function set_search_txt()  
	{
        $db    = \Config\Database::connect();
 
		$sql   = "SELECT * FROM tbl_search ORDER BY onum ASC ";
        write_log("AjaxMainController- ". $sql);
        $rows  = $db->query($sql)->getResultArray();

        $msg   = "";
		foreach ($rows as $item):
			$msg .= '<a href="#!" class="words_list_item ">#'. $item['subject'] .'</a>';
		endforeach;
 
        $output = [
            "message"  => $msg
        ];

		return $this->response->setJSON($output);
    }
}