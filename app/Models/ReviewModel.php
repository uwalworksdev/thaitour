<?php

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'tbl_travel_review';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "reg_m_idx", "user_name", "user_email", "travel_type",
        "travel_type_2", "travel_type_3", "product_idx", "title", "contents",
        "rfile1", "ufile1", "rfile2", "ufile2", "status", "passwd_yn", "passwd",
        "r_date", "m_date", "is_best", "onum", "display", "bbs_no", "user_ip",
        "number_stars", "review_type", "user_id"
    ];

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->db->query("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
    }

    public function getBestReviews($s_txt = null, $search_category = null)
    {
        $private_key = private_key();

        $builder = $this->db->table($this->table . ' a')
            ->select('a.*, b.product_name, b.ufile1 as product_img')
            ->join('tbl_product_mst as b', 'a.product_idx = b.product_idx', 'left')
            ->where('a.is_best', 'Y')
            ->where('a.status', 'Y');

        if ($s_txt && $search_category == "user_name") {
            $builder->where("REPLACE(CONVERT(AES_DECRYPT(UNHEX(FROM_BASE64($search_category)), '$private_key') USING UTF8), '-', '') LIKE", '%' . str_replace("-", "", $s_txt) . '%');
        }

        if ($s_txt && ($search_category == "title" || $search_category == "contents")) {
            $builder->like($search_category, str_replace("-", "", $s_txt));
        }

        $builder->orderBy('a.onum', 'desc');

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getReviews($s_txt = null, $search_category = null, $category = null, $page = 1, $scale = 10)
    {
        $private_key = private_key();

        $builder = $this->db->table('tbl_travel_review as A')
            ->select('A.*, COUNT(B.r_idx) AS cmt_cnt, C.code_name')
            ->join('tbl_bbs_cmt as B', 'A.idx = B.r_idx AND B.r_code = \'review\' AND B.r_status = \'Y\' AND B.r_delYN = \'N\'', 'left')
            ->join('tbl_code as C', 'A.travel_type = C.code_no', 'left')
            ->where('A.status', 'Y')
            ->groupBy('A.idx');

        if ($category == "best") {
            $builder->where('A.is_best', 'Y');
        }

        if ($s_txt && $search_category == "user_name") {
            $builder->where("REPLACE(CONVERT(AES_DECRYPT(UNHEX(FROM_BASE64($search_category)), '$private_key') USING UTF8), '-', '') LIKE", '%' . str_replace("-", "", $s_txt) . '%');
        }

        if ($s_txt && ($search_category == "title" || $search_category == "contents")) {
            $builder->like($search_category, str_replace("-", "", $s_txt));
        }

        $total_cnt = $builder->countAllResults(false);

        $total_page = ceil($total_cnt / $scale);
        if (empty($page)) {
            $page = 1;
        }
        $start = ($page - 1) * $scale;

        $builder->orderBy('A.onum', 'desc')
            ->orderBy('A.r_date', 'desc')
            ->limit($scale, $start);
        $query = $builder->get();
        $review_list = $query->getResultArray();

        $no = $total_cnt - $start;

        return [
            'review_list' => $review_list,
            'total_cnt' => $total_cnt,
            'page' => $page,
            'total_page' => $total_page,
            'no' => $no,
        ];
    }

    public function getReview($idx)
    {
        $builder = $this->db->table($this->table . ' a');

        $builder->select('a.*, b.product_name, c.code_name');
        $builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
        $builder->join('tbl_code c', 'a.travel_type = c.code_no', 'left');

        $builder->where('a.idx', $idx);

        $query = $builder->get();
        $result = $query->getRowArray();

        return $result;
    }

    public function getLastReview($product_idx)
    {
        $sql = 'select * from tbl_travel_review where product_idx = ? order by onum desc limit 2';
        return $this->db->query($sql, [$product_idx])->getResultArray();
    }

    public function getProductReview($product_idx)
    {
        $builder = $this->builder();
        $builder->where('product_idx', $product_idx);
        $total_review = $builder->countAllResults(false);
        $avg = 0;

        if ($total_review > 0) {
            $result = $builder->get()->getResultArray();

            $sum = 0;
            foreach ($result as $key => $value) {
                $sum += $value['number_stars'];
            }
            $avg = $sum / $total_review;
            $avg = round($avg, 1);
        }
        return [
            'total_review' => $total_review,
            'avg' => $avg
        ];
    }
}