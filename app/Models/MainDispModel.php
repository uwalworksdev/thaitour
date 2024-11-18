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
    public function goods_find(int $code_no, $g_list_rows = 1000, $pg = 1): array
    {
        helper(['setting']);
        $setting = homeSetInfo();

        $builder = $this->db->table($this->table);
        $builder->select('tbl_main_disp.*, tbl_product_mst.*');
        $builder->join('tbl_product_mst', 'tbl_main_disp.product_idx = tbl_product_mst.product_idx', 'inner');
        $builder->where('tbl_main_disp.code_no', $code_no);
        $builder->where('tbl_product_mst.is_view', 'Y');

        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('tbl_main_disp.onum', 'DESC');
        $builder->limit($g_list_rows, ($pg - 1) * $g_list_rows);

        $items = $builder->get()->getResultArray();
        
        foreach ($items as $key => $value) {
            $product_price = (float) $value['product_price'];
            $baht_thai = (float) ($setting['baht_thai'] ?? 0);
            $product_price_baht = $product_price / $baht_thai;
            $items[$key]['product_price_baht'] = $product_price_baht;
        }
        
        $data = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => $pg,
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
        return $data;
    }
    public function itemCntByProductAndCode(int $product_idx, int $code_no)
    {
        return $this->where('product_idx', $product_idx)
                    ->where('code_no', $code_no)
                    ->countAllResults();
    }

    public function List($code, $whereArr = [])
    {
        $builder = $this;
        $builder->select("{$this->table}.*  ");
        $builder->where('code', $code);
        $builder->orderBy("{$this->table}.code_no", "desc");

        return $builder;
    }
}
