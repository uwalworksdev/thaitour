<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberAdminratorModel extends Model
{
    protected $table = 'tbl_member_adminrator';
    protected $primaryKey = 'm_idx';
    protected $allowedFields = [ "user_id", "user_m_idx", "user_pw", "user_name", "user_phone",
        "user_mobile", "user_email", "user_level", "user_depart", "auth", "status", "user_ip", 
        "login_date", "m_date", "r_date", "d_date", "encode"];
}