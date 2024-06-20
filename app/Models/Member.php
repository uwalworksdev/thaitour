<?php

use CodeIgniter\Model;

class Member extends Model
{
    protected $table = 'tbl_member';

    protected $primaryKey = 'm_idx';

    protected $allowedFields = ["user_id", "user_pw", "user_name", "gender", "part", "position", "user_email", "user_email_yn", "sms_yn", "kakao_yn", "user_phone", "user_mobile", "zip", "addr1", "addr2", "job", "status", "birthday", "manager", "marriage_yn", "out_code", "out_etc", "out_reason", "out_date", "user_level", "visit_route", "mileage", "ip_address", "gubun", "sns_key", "m_auth", "m_date", "r_date", "company", "comnum", "fax", "user_ip", "recommender", "ufile1", "rfile1", "login_count", "login_date", "auth", "user_post", "encode"];

    public function getByIdx($m_idx)
    {
        $private_key = private_key();
        return $this->select("* , AES_DECRYPT(UNHEX(user_name),     '$private_key') AS user_name
                                , AES_DECRYPT(UNHEX(user_email),    '$private_key') AS user_email
                                , AES_DECRYPT(UNHEX(user_email),    '$private_key') AS user_email
                                , AES_DECRYPT(UNHEX(user_mobile),   '$private_key') AS user_mobile
                                , AES_DECRYPT(UNHEX(zip),           '$private_key') AS zip
                                , AES_DECRYPT(UNHEX(addr1),         '$private_key') AS addr1 
                                , AES_DECRYPT(UNHEX(addr2),         '$private_key') AS addr2")
            ->where('m_idx', $m_idx)
            ->get()
            ->getRowArray();
    }
    public function AdminPrevPassword(){
        $builder = $this;
        $builder->where("member_id", 'admin');
        return $builder->findColumn('member_pw');
    }

    public function AdminInfo($id){
        $builder = $this;
        $builder->where("member_id", $id);
        return $builder->find();
    }

    public function AdminPasswordChange($idx, $data){
        $builder = $this;
        $this->allowedFields = ['member_pw'];
        return $builder->update($idx, $data);
    }
}