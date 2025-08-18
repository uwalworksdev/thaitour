<?php

use CodeIgniter\Model;

class SpasInfoModel extends Model
{
    protected $table = 'tbl_product_spas_info';
    protected $primaryKey = 'info_idx';
    protected $allowedFields = [
        'product_idx', 
        'group', 
        'info_name', 
        'o_sdate', 
        'o_edate',
        'spas_info_price',
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

    protected $productSpas;
    protected $spasMoption;
    protected $spasOption;
    protected $spasPrice;

    public function __construct()
    {
        parent::__construct();
        $this->productSpas = model("ProductSpasModel");
        $this->spasMoption = model("SpasMoptionModel");
        $this->spasOption = model("SpasOptionModel");
        $this->spasPrice = model("SpasPrice");
    }

    public function getInfoById($info_idx)
    {
        return $this->where('info_idx', $info_idx)->findAll();
    }

    public function deleteInfo($info_idx)
    {
        return $this->where('info_idx', $info_idx)->delete();
    }

    public function copySpa($product_idx, $new_product_idx)
    {
        if ($product_idx) {
            $spa_info_list = $this->db->table("tbl_product_spas_info a")
                                ->join("tbl_product_spas b", "a.info_idx = b.info_idx", "left")
                                ->where("b.info_idx IS NOT NULL")
                                ->where("a.product_idx", $product_idx)
                                ->get()
                                ->getResultArray();
            foreach($spa_info_list as $spa_info){
                if(!empty($spa_info)){
                    $new_spa_info = array_merge([], $spa_info);
                    $info_idx = $new_spa_info['info_idx'];
                    unset($new_spa_info['info_idx']);
                    $new_spa_info['product_idx'] = $new_product_idx;
                    $new_spa_info['r_date'] = date("Y-m-d H:i:s");
                    $spa_id = $this->insert($new_spa_info);
    
                    if($spa_id) {
                        $spas_product = $this->productSpas->where("info_idx", $info_idx)->orderBy("spas_idx", "asc")->findAll();
                        if(!empty($spas_product)) {
                            $new_spas_product = array_merge([], $spas_product);
                            foreach ($new_spas_product as $spa) {
                                unset($spa['spas_idx']);
                                $spa['info_idx'] = $spa_id;
                                $spa['product_idx'] = $new_product_idx;
                                $spa['r_date'] = date("Y-m-d H:i:s");
                                $this->productSpas->insert($spa);
                            }
                        }
    
                        $spas_moption = $this->spasMoption->where("info_idx", $info_idx)->findAll();
                        if(!empty($spas_moption)) {
                            $new_spas_moption = array_merge([], $spas_moption);
                            foreach ($new_spas_moption as $moption) {
                                $code_idx = $moption['code_idx'];
                                unset($moption['code_idx']);
                                $moption['info_idx'] = $spa_id;
                                $moption['product_idx'] = $new_product_idx;
                                $moption['rdate'] = date("Y-m-d H:i:s");
                                $insert_idx = $this->spasMoption->insert($moption);
    
                                if($insert_idx){
                                    $spas_option = $this->spasOption->where("code_idx", $code_idx)->findAll();
                                    if(!empty($spas_option)) {
                                        $new_spas_option = $spas_option;
                                        foreach ($new_spas_option as $option) {
                                            unset($option['idx']);
                                            $option['code_idx'] = $insert_idx;
                                            $option['product_idx'] = $new_product_idx;
                                            $option['rdate'] = date("Y-m-d H:i:s");
                                            $this->spasOption->insert($option);
                                        }
                                    }
                                }
                            }
                        }
    
                        $spas_price = $this->spasPrice->where("product_idx", $product_idx)
                                                        ->where("info_idx", $info_idx)
                                                        ->orderBy("goods_date", "asc")
                                                        ->findAll();
                        $old_options = $this->productSpas->where("info_idx", $info_idx)->orderBy("spas_idx", "asc")->findAll();
                        $new_options = $this->productSpas->where("info_idx", $spa_id)->orderBy("spas_idx", "asc")->findAll();
    
                        $option_map = [];
                        foreach ($old_options as $k => $old) {
                            if (isset($new_options[$k])) {
                                $option_map[$old['spas_idx']] = $new_options[$k]['spas_idx'];
                            }
                        }
    
                        if (!empty($spas_price)) {
                            foreach ($spas_price as $price) {
                                $old_spas_idx = $price['spas_idx'];
    
                                if (!isset($option_map[$old_spas_idx])) {
                                    continue;
                                }
    
                                unset($price['idx'], $price['upd_date']);
                                $price['info_idx'] = $spa_id;
                                $price['product_idx'] = $new_product_idx;
                                $price['spas_idx'] = $option_map[$old_spas_idx];
                                $price['reg_date'] = date("Y-m-d H:i:s");
    
                                $this->spasPrice->insert($price);
                            }
                        }
                    }
                }
            }

        }
    }
}