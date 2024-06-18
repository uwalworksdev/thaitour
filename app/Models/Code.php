<?php

use CodeIgniter\Model;

class Code extends Model
{
    protected $table = 'tbl_code';

    protected $primaryKey = 'code_idx';

    protected $allowedFields = [
        "code_gubun",
        "code_no",
        "code_name",
        "code_memo",
        "ufile1",
        "rfile1",
        "code_url",
        "parent_code_no",
        "depth",
        "rolling_yn",
        "status",
        "onum",
        "init_oil_price",
        "ref_product_code_idx"
    ];

    public function getByParentAndDepth($parent_code_no, $depth)
    {
        return $this->select('*')
            ->where('parent_code_no', $parent_code_no)
            ->where('depth', $depth)
            ->orderBy('onum', 'DESC')
            ->get();
    }
    public function getByCodeNo($code_no) {
        return $this->where('code_no', $code_no)->first();
    }
}