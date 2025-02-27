<?php

use CodeIgniter\Model;

class Banner_model extends Model
{
    protected $table = 'tbl_cate_banner';

    protected $primaryKey = 'cb_idx';

    protected $allowedFields = [ 
        "code_idx", "code_no", "ufile1", "rfile1", "ufile2", "rfile2", "url", "onum", "use_yn", "category",
        "title", "subtitle"
    ];

    public function getBanners($code_no, $category = null)
    {

        if($category){
            $this->where('category', $category);
        }

        return $this->where('code_no', $code_no)
            ->orderBy('onum', 'ASC')
            ->findAll();
    }
    public function getList($where = [], $g_list_rows = 10, $pg = 1)
    {
        $builder = $this->db->table('tbl_code a');

        $builder->where('code_gubun !=', 'bank');

        if ($where['s_parent_code_no'] != "") {
            $builder->where('parent_code_no', $where['s_parent_code_no']);
        } else {
            $builder->where('parent_code_no', '13');
        }

        $builder->select("
                    *,
                    (SELECT IFNULL(COUNT(*), 0) 
                    FROM tbl_cate_banner 
                    WHERE a.code_idx = tbl_cate_banner.code_idx) AS cnt,
                    (SELECT ufile1 as img_banner 
                    FROM tbl_cate_banner 
                    WHERE a.code_idx = tbl_cate_banner.code_idx 
                    ORDER BY onum ASC 
                    LIMIT 0, 1) AS img
                ");

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);

        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->limit($g_list_rows, $nFrom);

        $items = $builder->get()->getResultArray();
        return [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => $pg,
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
    }

    public function getOne($id) {
        return $this->where('id', $id)->first();
    }

    public function getByCodeIdx($code_idx) {
        return $this->where('code_idx', $code_idx)->findAll();
    }

    public function getLineBanners($category = '123')
    {
        return $this->where('category', $category)->first();
    }

    public function getCodeBanners($code_no)
    {
        return $this->db->table('tbl_code_banner a')
            ->select('a.ufile1 as ufile, a.*, b.*')
            ->join('tbl_code b', 'a.code_idx = b.code_idx', 'left')
            ->where('b.code_no', $code_no)
            ->orderBy('a.onum', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insertBanner($data) {
        return $this->insert($data);
    }

    public function updateBanner($cb_idx, $data) {
        return $this->update($cb_idx, $data);
    }
}
?>