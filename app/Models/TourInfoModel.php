<?php

use CodeIgniter\Model;

class TourInfoModel extends Model
{
    protected $table = 'tbl_product_tour_info';
    protected $primaryKey = 'info_idx';
    protected $allowedFields = [
        'product_idx', 
        'group', 
        'info_name',
        'o_sdate', 
        'o_edate',
        'tour_info_price',
        'yoil_0', 
        'yoil_1', 
        'yoil_2', 
        'yoil_3', 
        'yoil_4', 
        'yoil_5', 
        'yoil_6', 
        'o_onum', 
        'r_date'
    ];

    private $tourProducts;
    private $moptionModel;
    private $optionTourModel;
    private $toursPrice;

    public function __construct()
    {
        parent::__construct();
        $this->tourProducts = model("ProductTourModel");
        $this->moptionModel = model("MoptionModel");
        $this->optionTourModel = model("OptionTourModel");
        $this->toursPrice = model("ToursPrice");
    }


    public function getInfoById($info_idx)
    {
        return $this->where('info_idx', $info_idx)->findAll();
    }

    public function deleteTour($info_idx)
    {
        return $this->where('info_idx', $info_idx)->delete();
    }

    public function copyTour($product_idx, $new_product_idx)
    {
        if ($product_idx) {
            $tour_info_list = $this->db->table("tbl_product_tour_info a")
                                    ->where("a.product_idx", $product_idx)
                                    ->get()
                                    ->getResultArray();
            foreach($tour_info_list as $tour_info){
                if(!empty($tour_info)){
                    $new_tour_info = array_merge([], $tour_info);
                    $info_idx = $new_tour_info['info_idx'];
                    unset($new_tour_info['info_idx']);
                    $new_tour_info['product_idx'] = $new_product_idx;
                    $new_tour_info['r_date'] = date("Y-m-d H:i:s");
                    $tour_id = $this->insert($new_tour_info);
    
                    if($tour_id) {
                        $tours_product = $this->tourProducts->where("info_idx", $info_idx)->orderBy("tours_idx", "asc")->findAll();
                        if(!empty($tours_product)) {
                            $new_tours_product = array_merge([], $tours_product);
                            foreach ($new_tours_product as $tour) {
                                unset($tour['tours_idx']);
                                $tour['info_idx'] = $tour_id;
                                $tour['product_idx'] = $new_product_idx;
                                $tour['r_date'] = date("Y-m-d H:i:s");
                                $this->tourProducts->insert($tour);
                            }
                        }
    
                        $tours_moption = $this->moptionModel->where("info_idx", $info_idx)->findAll();
                        if(!empty($tours_moption)) {
                            $new_tours_moption = array_merge([], $tours_moption);
                            foreach ($new_tours_moption as $moption) {
                                $code_idx = $moption['code_idx'];
                                unset($moption['code_idx']);
                                $moption['info_idx'] = $tour_id;
                                $moption['product_idx'] = $new_product_idx;
                                $moption['rdate'] = date("Y-m-d H:i:s");
                                $insert_idx = $this->moptionModel->insert($moption);
    
                                if($insert_idx){
                                    $tours_option = $this->optionTourModel->where("code_idx", $code_idx)->findAll();
                                    if(!empty($tours_option)) {
                                        $new_tours_option = $tours_option;
                                        foreach ($new_tours_option as $option) {
                                            unset($option['idx']);
                                            $option['code_idx'] = $insert_idx;
                                            $option['product_idx'] = $new_product_idx;
                                            $option['rdate'] = date("Y-m-d H:i:s");
                                            $this->optionTourModel->insert($option);
                                        }
                                    }
                                }
                            }
                        }
    
                        $tours_price = $this->toursPrice->where("product_idx", $product_idx)
                                                        ->where("info_idx", $info_idx)
                                                        ->orderBy("goods_date", "asc")
                                                        ->findAll();
                        
                        $old_options = $this->tourProducts->where("info_idx", $info_idx)->orderBy("tours_idx", "asc")->findAll();
                        $new_options = $this->tourProducts->where("info_idx", $tour_id)->orderBy("tours_idx", "asc")->findAll();
    
                        $option_map = [];
                        foreach ($old_options as $k => $old) {
                            if (isset($new_options[$k])) {
                                $option_map[$old['tours_idx']] = $new_options[$k]['tours_idx'];
                            }
                        }
    
                        if (!empty($tours_price)) {
                            foreach ($tours_price as $price) {
                                $old_tour_idx = $price['tours_idx'];
    
                                if (!isset($option_map[$old_tour_idx])) {
                                    continue;
                                }
    
                                unset($price['idx'], $price['upd_date']);
                                $price['info_idx'] = $tour_id;
                                $price['product_idx'] = $new_product_idx;
                                $price['tours_idx'] = $option_map[$old_tour_idx];
                                $price['reg_date'] = date("Y-m-d H:i:s");
    
                                $this->toursPrice->insert($price);
                            }
                        }  
                    }
                }
            }
        }
    }
}