<?php

use CodeIgniter\Model;

class PolicyCancel extends Model
{
    protected $table = 'tbl_policy_cancel';

    protected $primaryKey = 'p_idx';

    protected $allowedFields = ["product_idx", "product_code", "product_code_2", "product_code_3", "policy_type", "policy_contents", "r_date"];

    public function getByIdx($p_idx)
    {
        return $this->select("*")->where("p_idx", $p_idx)->get()->getRowArray();
    }
}