<?php

namespace App\Models;
use CodeIgniter\Model;

class CmsModel extends Model
{
    protected $table = 'tbl_cms';
    protected $primaryKey = 'r_idx';
    protected $allowedFields = [ "r_status", "r_reg_date", "r_reg_m_idx", "r_mod_date", "r_mod_m_idx", "r_code", "r_type",
            "r_s_date", "r_e_date", "r_order", "r_flag", "r_template", "r_name", "r_date", "r_view_cnt", "r_title", "r_desc",
            "r_content", "r_html", "r_extra", "r_product_idx", "r_product_name", "r_product_area", "r_product_term",
            "r_url", "r_open", "r_close", "r_thumb", "r_file_code", "r_file_name", "r_file_list" ];

    public function getPaging($where, $g_list_rows = 10, $pg = 1)
    {
        $builder = $this->db->table($this->table);

        $builder->where('r_code', $where['r_code']);

        if($where['sch_status']) {
            $builder->where('r_status', $where['sch_status']);
        }

        if($where['sch_item']) {
            $builder->like($where['sch_item'], $where['sch_value']);
        }

        $builder->where('r_status !=', 'D');

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        if ($pg > $nPage && $nPage != 0) {
            $pg = $nPage;
        }

        $start = ($pg - 1) * $g_list_rows;
        $builder->limit($g_list_rows, $start);

        return [
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => $pg,
            'items' => $builder->get()->getResultArray(),
            'num' => $nTotalCount - $start
        ];
    }

}