<?php

use CodeIgniter\Model;

class PolicyModel extends Model
{
    protected $table = 'tbl_policy_info';

    protected $primaryKey = 'p_idx';

    protected $allowedFields = ["policy_code", "policy_type", "policy_contents", "onum"];

    public function getByCode($code)
    {
        return $this->select("*")->where("policy_code", $code)->get()->getRowArray();
    }

    public function getByIdx($p_idx)
    {
        return $this->select("*")->where("p_idx", $p_idx)->get()->getRowArray();
    }
}