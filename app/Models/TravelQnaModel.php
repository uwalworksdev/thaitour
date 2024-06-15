<?php

use CodeIgniter\Model;

class TravelQnaModel extends Model
{
    protected $table = 'tbl_travel_qna';
    protected $primaryKey = 'idx';
    protected $allowedFields = ["reg_m_idx", "user_name", "user_phone", "user_email", "departure_date", "arrival_date", "travel_type_1", "travel_type_2", "travel_type_3", "consultation_time", "product_name", "title", "contents", "rfile1", "ufile1", "status", "passwd_yn", "passwd", "isViewQna", "r_date", "m_date", "user_ip"];

    public function deleteTravelQna(array $idxs)
    {
        return $this->whereIn('idx', $idxs)->delete();
    }
}