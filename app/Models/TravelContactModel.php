<?php

use CodeIgniter\Model;

class TravelContactModel extends Model
{
    protected $table = 'tbl_travel_contact';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "reg_m_idx", "user_name", "user_phone", "user_email", "departure_date", "arrival_date"
        , "accuracy", "speed", "travel_type_1", "travel_type_2", "travel_type_3", "consultation_time"
        , "product_name", "title", "contents", "rfile1", "ufile1", "status", "passwd_yn", "passwd"
        , "r_date", "m_date", "star", "product_idx", "isViewAdmin", "user_ip"
    ];

    public function getContact($s_txt = null, $search_category = null, $pg = 1, $g_list_rows = 10, $where = [])
    {
        $private_key = private_key();

        $builder = $this->db->table('tbl_travel_contact as A')
                            ->select('A.*, COUNT(B.r_idx) AS cmt_cnt')
                            ->join('tbl_bbs_cmt B', "A.idx = B.r_idx", 'left')
                            ->where('B.r_code =', 'contact')
                            ->where('B.r_status =', 'Y')
                            ->where('B.r_delYN !=', 'N');

        if ($where) {
            $builder->where($where);
        }

        if ($s_txt) {
            if ($search_category === 'user_name') {
                $builder->where("REPLACE(CONVERT(AES_DECRYPT(UNHEX(FROM_BASE64($search_category)), '$private_key') USING UTF8), '-', '') LIKE", '%' . str_replace("-", "", $s_txt) . '%');
            } elseif (in_array($search_category, ['title', 'contents'])) {
                $builder->like($search_category, str_replace("-", "", $s_txt));
            }
        }

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('A.r_date desc', 'desc')
            ->orderBy('A.idx desc', 'desc')
            ->limit($g_list_rows, $nFrom);

        $order_list = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
            'order_list' => $order_list,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
        ];
    }


    public function deleteTravelContact($idx)
    {
        return $this->delete($idx);
    }

    public function updateContact($id, $data)
    {
        return $this->update($id, $data);
    }

    public function insertContact($data)
    {
        return $this->insert($data);
    }
}