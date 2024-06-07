<?php

use CodeIgniter\Model;

class Product_model extends Model {
    protected $table = 'tbl_product_mst';

    protected $primaryKey = 'product_idx';

    protected $allowedFields = [
        'tour_period', 'product_code', 'product_code_1', 'product_code_2', 
        'product_code_3', 'product_code_4', 'product_code_name_1', 
        'product_code_name_2', 'product_code_name_3', 'product_code_name_4',
        'ufile1', 'rfile1', 'ufile2', 'rfile2', 'ufile3', 'rfile3',
        'ufile4', 'rfile4', 'ufile5', 'rfile5', 'ufile6', 'rfile6',
        'ufile7', 'rfile7', 'jetlag', 'exchange', 'capital_city', 'information',
        'product_level', 'product_option', 'cancel_policy', 'adult_text', 'kids_text', 'baby_text'
    ];

    protected function initialize() {
    }

    public function getSuggestedProducts($code_no) {
        $suggest_code_no = '';
        switch ($code_no) {
            case '132401':
                $suggest_code_no = '233201';
                break;
            case '132404':
                $suggest_code_no = '233202';
                break;
            case '1324':
                $suggest_code_no = '2332';
                break;
        }

        if ($suggest_code_no) {
            return $this->db->table('tbl_product_mst a')
                            ->select('a.*, b.onum, b.code_idx')
                            ->join('tbl_main_disp b', 'a.product_idx = b.product_idx')
                            ->where('b.code_no', $suggest_code_no)
                            ->orderBy('b.onum', 'DESC')
                            ->orderBy('b.code_idx', 'DESC')
                            ->get()
                            ->getResultArray();
        }

        return [];
    }

    public function getProductDetails($product_idx) {
        return $this->where('product_idx', $product_idx)->first();
    }

    public function getProductLevel($product_level) {
        $query = $this->db->query("SELECT * FROM tbl_product_level WHERE idx = ?", [$product_level]);
        return $query->getRowArray();
    }

    public function getProducts($code_no, $s, $perPage = 10, $page = 1) {
        $order_by = $this->getOrderBy($s);
        $code_col = $this->getCodeColumn($code_no);

        $offset = ($page - 1) * $perPage;

        return $this->where($code_col, $code_no)
                    ->where('is_view', 'Y')
                    ->orderBy($order_by)
                    ->findAll($perPage, $offset);
    }

    private function getOrderBy($s) {
        switch ($s) {
            case "1": return "onum DESC";
            case "2": return "wish_cnt DESC";
            case "3": return "order_cnt DESC";
            case "4": return "point DESC";
            case "5": return "product_price DESC";
            case "6": return "product_price ASC";
            default: return "onum DESC";
        }
    }

    public function getCodeColumn($code_no) {
        $length = strlen($code_no);
        if ($length == 4) return 'product_code_1';
        if ($length == 6) return 'product_code_2';
        if ($length == 8) return 'product_code_3';
        return '';
    }
}
?>
