<?php

use CodeIgniter\Model;

class TravelContactModel extends Model
{
    protected $table = 'tbl_travel_contact';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "reg_m_idx", "user_name", "user_phone", "user_email", "departure_date", "arrival_date", "type_code"
        , "accuracy", "speed", "travel_type_1", "travel_type_2", "travel_type_3", "consultation_time"
        , "product_name", "title", "contents", "rfile1", "ufile1", "status", "passwd_yn", "passwd"
        , "r_date", "m_date", "star", "product_idx", "isViewAdmin", "user_ip"
    ];

    public function getContact($s_txt = null, $search_category = null, $pg = 1, $g_list_rows = 10, $where = [])
    {
        $private_key = private_key();

        $builder = $this->db->table('tbl_travel_contact as A')
                            ->select('A.*, COUNT(B.r_idx) AS cmt_cnt, C.code_name')
                            ->join('tbl_bbs_cmt B', "A.idx = B.r_idx AND B.r_code = 'contact' AND B.r_status = 'Y' AND B.r_delYN = 'N'", 'left')
                            ->join('tbl_code C', "C.code_no = A.type_code", 'left');

        if ($where) {
            $builder->where($where);
        }

        if (!empty($s_txt)) {
            if ($search_category === 'user_name') {
                $builder->where("REPLACE(CONVERT(AES_DECRYPT(UNHEX(FROM_BASE64($search_category)), '$private_key') USING UTF8), '-', '') LIKE", '%' . str_replace("-", "", $s_txt) . '%');
            } elseif (in_array($search_category, ['title', 'contents'])) {
                $builder->like($search_category, str_replace("-", "", $s_txt));
            }
        }

        $builder->groupBy('A.idx');

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('A.r_date', 'desc')
            ->orderBy('A.idx', 'desc')
            ->limit($g_list_rows, $nFrom);

        $travel_contact = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
            'travel_contact' => $travel_contact,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
        ];
    }

    function getContactAndCode($m_idx, $pg = 1, $g_list_rows = 10) {
        $builder = $this->db->table('tbl_travel_contact t')
                            ->select('t.idx, c.code_name, c.code_no, t.product_name, t.title, t.status, t.r_date')
                            ->join('tbl_code c', 't.travel_type_1 = c.code_no', 'left')
                            ->where('t.reg_m_idx', $_SESSION['member']['mIdx']);

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('t.r_date', 'desc')
                ->groupBy('t.idx')
                ->limit($g_list_rows, $nFrom);

        $travel_contact = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
            'travel_contact' => $travel_contact,
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

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        return $this->insert($filteredData);
    }

    public function updateData($id, $data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        return $this->update($id, $filteredData);
    }
}