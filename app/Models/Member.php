<?php

namespace App\Models;
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
                                , AES_DECRYPT(UNHEX(user_mobile),   '$private_key') AS user_mobile
                                , AES_DECRYPT(UNHEX(zip),           '$private_key') AS zip
                                , AES_DECRYPT(UNHEX(addr1),         '$private_key') AS addr1 
                                , AES_DECRYPT(UNHEX(addr2),         '$private_key') AS addr2")
            ->where('m_idx', $m_idx)
            ->get()
            ->getRowArray();
    }
    public function getLogin($user_id)
    {
        $private_key = private_key();
        $builder = $this;
        $builder->select("*, AES_DECRYPT(UNHEX(user_name),      '$private_key') AS user_name 
				, AES_DECRYPT(UNHEX(user_email),                '$private_key') AS user_email
                , AES_DECRYPT(UNHEX(user_mobile),               '$private_key') AS user_mobile
                , AES_DECRYPT(UNHEX(zip),                       '$private_key') AS zip
                , AES_DECRYPT(UNHEX(addr1),                     '$private_key') AS addr1 
                , AES_DECRYPT(UNHEX(addr2),                     '$private_key') AS addr2");
        $builder->where("user_id", $user_id);
        $builder->where("user_level > ", "2");
        return $builder->get()->getRowArray();
    }
    public function getAdminLogin($user_id)
    {
        $private_key = private_key();
        $builder = $this;
        $builder->select("*, AES_DECRYPT(UNHEX(user_name),    '$private_key') AS user_name 
				, AES_DECRYPT(UNHEX(user_email),   '$private_key') AS user_email");
        $builder->where("user_id", $user_id);
        return $builder->get()->getRowArray();
    }
    public function AdminPrevPassword()
    {
        $builder = $this;
        $builder->where("member_id", 'admin');
        return $builder->findColumn('user_pw');
    }

    public function AdminInfo($id)
    {
        $builder = $this;
        $builder->where("member_id", $id);
        return $builder->find();
    }

    public function AdminPasswordChange($idx, $data)
    {
        $builder = $this;
        $this->allowedFields = ['user_pw'];
        return $builder->update($idx, $data);
    }
    public function getMemberCount($strSql)
    {
        $query = $this->db->query("SELECT COUNT(*) as count FROM {$this->table} {$strSql}");
        return $query->getRow()->count;
    }

    public function getMembers($strSql, $private_key, $nFrom, $g_list_rows)
    {
        $sql = "SELECT * FROM {$this->table} {$strSql} ORDER BY r_date DESC LIMIT $nFrom, $g_list_rows";
        $query = $this->db->query($sql);
        $members = $query->getResultArray();

        foreach ($members as &$row) {
            if ($row['encode'] == 'Y') {
                $sql_d = "SELECT
                            AES_DECRYPT(UNHEX(?), ?) AS user_name,
                            AES_DECRYPT(UNHEX(?), ?) AS user_email,
                            AES_DECRYPT(UNHEX(?), ?) AS user_mobile,
                            AES_DECRYPT(UNHEX(?), ?) AS user_phone";

                $result_d = $this->db->query($sql_d, [
                    $row['user_name'], $private_key,
                    $row['user_email'], $private_key,
                    $row['user_mobile'], $private_key,
                    $row['user_phone'], $private_key]);

                $row_d = $result_d->getRowArray();

                $row['user_name'] = $row_d['user_name'];
                $row['user_email'] = $row_d['user_email'];
                $row['user_mobile'] = $row_d['user_mobile'];
                $row['user_phone'] = $row_d['user_phone'];
            }
        }

        return $members;
    }
    public function insertMember($data)
    {
        $data['user_name'] = encryptField($data['user_name'], "encode");
        $data['user_email'] = encryptField($data['user_email'], "encode");
        $data['user_mobile'] = encryptField($data['user_mobile'] ?? "", "encode");

        if (!empty($data['zip'])) {
            $data['zip'] = encryptField($data['zip'], "encode");
        }
        if (!empty($data['addr1'])) {
            $data['addr1'] = encryptField($data['addr1'], "encode");
        }
        if (!empty($data['addr2'])) {
            $data['addr2'] = encryptField($data['addr2'], "encode");
        }

        $data['user_level'] = '10';
        $data['status'] = 'Y';
        $data['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['r_date'] = date('Y-m-d H:i:s');
        $data['encode'] = 'Y';

        if (!empty($data['user_pw'])) {
            $data['user_pw'] = password_hash($data['user_pw'], PASSWORD_BCRYPT);
        }

        return $this->insert($data);
    }
    public function checkPhone($phone)
    {
        $private_key = private_key();
        $builder = $this->builder();
        $builder->where("(AES_DECRYPT(UNHEX(user_mobile), '$private_key'))", $phone);
        return $builder->get()->getNumRows() > 0;
    }
}