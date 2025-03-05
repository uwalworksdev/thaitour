<?php

use CodeIgniter\Model;

class Coupon extends Model
{
    protected $table = 'tbl_coupon';
    protected $primaryKey = 'c_idx';
    protected $allowedFields = ["coupon_num", "coupon_type", "coupon_mst_idx", "types", "user_id", "status", "order_memo", "last_idx", "regdate", "enddate", "usedate", "get_issued_yn"];

    public function getCouponList($user_id)
    {
        $c_sql = "SELECT c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate
                            , c.status, c.types, s.coupon_name, s.dc_type, s.coupon_pe, s.coupon_price 
                                FROM tbl_coupon c LEFT JOIN tbl_coupon_setting s ON c.coupon_type = s.idx WHERE user_id = '" . $user_id . "' 
                                AND status = 'N' AND STR_TO_DATE(enddate, '%Y-%m-%d') >= CURDATE()";

        $c_result = $this->db->query($c_sql)->getResultArray();

        return $c_result;
    }

    public function getCouponInfo($c_idx)
    {
        $c_sql = "SELECT c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate
                            , c.status, c.types, s.coupon_name, s.dc_type, s.coupon_pe, s.coupon_price 
                                FROM tbl_coupon c LEFT JOIN tbl_coupon_setting s ON c.coupon_type = s.idx WHERE c.c_idx = '" . $c_idx . "' 
                                AND status = 'N' AND STR_TO_DATE(enddate, '%Y-%m-%d') >= CURDATE()";

        $c_result = $this->db->query($c_sql)->getRowArray();

        return $c_result;
    }
    public function getCountCouponMember() {
        $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
        $koreaDate = $date->format('Y-m-d');
        $builder = $this->db->table('tbl_coupon c');
        $builder->select('
                        c.c_idx, 
                        c.coupon_num, 
                        c.user_id, 
                        c.regdate, 
                        c.enddate, 
                        c.usedate, 
                        c.status, 
                        c.types, 
                        s.coupon_name, 
                        s.dc_type, 
                        s.coupon_pe, 
                        s.coupon_price
                    ');
        $builder->join('tbl_coupon_setting s', 'c.coupon_type = s.idx', 'left');
        $builder->join('tbl_coupon_history h', 'c.c_idx = h.used_coupon_idx', 'left');
        $builder->where('c.status !=', 'C');
        $builder->where('c.enddate >', $koreaDate);
        $builder->where('c.usedate', '');
        $builder->where('h.used_coupon_idx', null);
        $builder->where('c.user_id', $_SESSION['member']['id']);
        $builder->groupBy('c.c_idx');

        $result = $builder->get()->getResultArray();
        return $result;
    }
    
    public function getUseCouponMember($m_idx, $s_date = null, $e_date = null, $pg = 1, $g_list_rows = 10) {
        $builder = $this->db->table('tbl_coupon a')
                            ->select("DATE_FORMAT(ch_r_date, '%Y-%m-%d') as ch_r_date_new")
                            ->select('a.*, b.*, s.*')
                            ->join('tbl_coupon_history b', 'a.c_idx = b.used_coupon_idx', 'left')
                            ->join('tbl_coupon_setting s', 'a.coupon_type = s.idx', 'left')
                            ->where('m_idx', $_SESSION['member']['mIdx']);

        if(!empty($s_date) && !empty($e_date)){
            $builder->where("DATE_FORMAT(ch_r_date, '%Y-%m-%d') >=", $s_date);
            $builder->where("DATE_FORMAT(ch_r_date, '%Y-%m-%d') <=", $e_date);
        }

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('ch_idx', 'desc')
            ->limit($g_list_rows, $nFrom);

        $coupon_list = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
            'coupon_list' => $coupon_list,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
        ];
    }

    public function getUseCouponMemberPop($m_idx, $s_date = null, $e_date = null, $pg = 1, $g_list_rows = 10) {
        $builder = $this->db->table('tbl_coupon a')
                            ->select("DATE_FORMAT(ch_r_date, '%Y-%m-%d') as ch_r_date_new")
                            ->select('a.*, b.*, s.*')
                            ->join('tbl_coupon_history b', 'a.c_idx = b.used_coupon_idx', 'left')
                            ->join('tbl_coupon_setting s', 'a.coupon_type = s.idx', 'left')
                            ->where('m_idx', $m_idx);

        if(!empty($s_date) && !empty($e_date)){
            $builder->where("DATE_FORMAT(ch_r_date, '%Y-%m-%d') >=", $s_date);
            $builder->where("DATE_FORMAT(ch_r_date, '%Y-%m-%d') <=", $e_date);
        }

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('ch_idx', 'desc')
            ->limit($g_list_rows, $nFrom);

        $coupon_list = $builder->get()->getResultArray();

        $num = $nTotalCount - $nFrom;

        return [
            'coupon_list' => $coupon_list,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
        ];
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

    public function deleteData($id)
    {
        return $this->delete($id);
    }
}