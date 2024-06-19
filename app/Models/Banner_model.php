<?php

use CodeIgniter\Model;

class Banner_model extends Model {
    protected $table = 'tbl_cate_banner';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'code_no', 'ufile1', 'onum'
    ];

    protected function initialize() {
        // Nếu cần thiết có thể khởi tạo các giá trị mặc định ở đây
    }

    public function getBanners($code_no) {
        return $this->where('code_no', $code_no)
                    ->orderBy('onum', 'ASC')
                    ->findAll(2);
    }
    public function getLineBanners($category = '123')
    {
        return $this->where('category', $category)->first();
    }

    public function getCodeBanners($code_no) {
        return $this->db->table('tbl_code_banner a')
                        ->select('a.ufile1 as ufile, a.*, b.*')
                        ->join('tbl_code b', 'a.code_idx = b.code_idx', 'left')
                        ->where('b.code_no', $code_no)
                        ->orderBy('a.onum', 'DESC')
                        ->get()
                        ->getResultArray();
    }
}
?>
