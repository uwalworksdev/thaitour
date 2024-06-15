<?php

use CodeIgniter\Model;

class TravelContactModel extends Model
{
    protected $table = 'tbl_travel_contact';
    protected $primaryKey = 'idx';
    protected $allowedFields = ["reg_m_idx", "user_name", "user_phone", "user_email", "departure_date", "arrival_date", "travel_type_1", "travel_type_2", "travel_type_3", "consultation_time", "product_name", "title", "contents", "rfile1", "ufile1", "status", "passwd_yn", "passwd", "r_date", "m_date", "product_idx", "isViewAdmin", "user_ip"];

    public function deleteTravelContact($idx)
    {
        return $this->delete($idx);
    }
}