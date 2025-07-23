<?php

use CodeIgniter\Model;

class PolicyCancel extends Model
{
    protected $table = 'tbl_policy_cancel';

    protected $primaryKey = 'p_idx';

    protected $allowedFields = ["product_idx", "product_code", "product_code_2", "product_code_3", "policy_type", "subtitle", "policy_contents", "policy_contents_m", "r_date"];

    public function getByIdx($p_idx)
    {
        return $this->select("*")->where("p_idx", $p_idx)->get()->getRowArray();
    }

    public function getByProductIdx($product_idx)
    {
        return $this->select("policy_contents")
                    ->where("product_idx", $product_idx)
                    ->get()
                    ->getRowArray();
    }

}