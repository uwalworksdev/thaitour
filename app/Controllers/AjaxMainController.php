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
								  WHERE 1=1 ";
        if($code_no)        $sql .= " AND a.code_no        = '$code_no' "; 
		if($product_code_1) $sql .= " AND b.product_code_1 = '$product_code_1' ";

		$sql  .= "ORDER BY a.onum DESC ";
        write_log("AjaxMainController- ". $sql);
 
        $rows  = $db->query($sql)->getResultArray();

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
				 $msg .= '<li class="breadcrumb_item">시암</li>';
				 $msg .= '</ul>';
				 $msg .= '<div class="prd_name">'. $item['product_name'] .'</div>';
				 $msg .= '<div class="prd_info">';
				 $msg .= '<img class="ico_star" src="/images/ico/ico_star.svg" alt="">';
				 $msg .= '<span class="star_avg">4.7</span>';
				 $msg .= '<span class="star_review_cnt">(954)</span></div>';
				 $msg .= '<div class="prd_price_ko">'. number_format($item['original_price']) .'<span>원</span></div>';
				 $msg .= '<div class="prd_price_thai">6,000 <span>바트</span></div>';
			     $msg .= '</a>';
		endforeach;
 
        $output = [
            "message"  => $msg
        ];

		return $this->response->setJSON($output);
    }


    public function set_seq()  
	{
        $type     = $this->request->getPost('type');
        $code_no  = $this->request->getPost('local');
        $db    = \Config\Database::connect();
 
		$sql   = "SELECT a.*, b.* FROM tbl_main_disp a
		                          LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx 
								  WHERE a.code_no = '$code_no' ORDER BY a.onum DESC ";
        write_log("AjaxMainController- ". $sql);
 
        $rows  = $db->query($sql)->getResultArray();

        $msg   = "";
		$seq   = 0;
		foreach ($rows as $item3):
			$seq++;
			$msg .= '<div class="swiper-slide">';
			$msg .= '<a href="'. getUrlFromProduct($item3) .'" class="hot_product_list__item">';
			$msg .= '<div class="img_box img_box_2">';
			$msg .= '<img src="/data/product/'. $item3['ufile1'] .'" alt="main">';
			$msg .= '</div>';
			$msg .= '<div class="prd_name">'. $item3['product_name'] .'</div>';
			$msg .= '<div class="prd_price_ko">'. number_format($item3['original_price']) .'<span>원</span></div>';
			$msg .= '<div class="prd_price_thai">6,000 <span>바트</span></div>';
			$msg .= '<span class="number_item_label number_one">'. $seq .'</span>';
			$msg .= '</a>';
			$msg .= '</div>';
		endforeach;
 
        $output = [
            "message"  => $msg
        ];

		return $this->response->setJSON($output);
    }
}