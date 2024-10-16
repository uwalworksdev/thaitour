<?php

namespace App\Models;

use CodeIgniter\Model;

class MainDispModel extends Model
{
    protected $table      = 'tbl_main_disp';
    protected $primaryKey = 'code_idx';

    protected $allowedFields = [
        'code_no', 
        'product_idx', 
        'status', 
        'onum', 
        'p_idx'
    ];
    public function goods_find(int $code_no): array
    {
        return $this->select('tbl_main_disp.*, tbl_product_mst.*')
                    ->join('tbl_product_mst', 'tbl_main_disp.product_idx = tbl_product_mst.product_idx', 'left')
                    ->where('tbl_main_disp.code_no', $code_no)
                    ->where('tbl_product_mst.is_view', 'Y')
                    ->orderBy('tbl_main_disp.onum', 'DESC')
                    ->findAll();
    }
    public function itemCntByProductAndCode(int $product_idx, int $code_no)
    {
        return $this->where('product_idx', $product_idx)
                    ->where('code_no', $code_no)
                    ->countAllResults();
    }
}
