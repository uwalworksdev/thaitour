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
    public function getLogin($user_id)
    {
        $private_key = private_key();
        $builder = $this;
        $builder->select("*, AES_DECRYPT(UNHEX(user_name),    '$private_key') AS user_name 
				, AES_DECRYPT(UNHEX(user_email),   '$private_key') AS user_email");
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
    public function insertMember($data, $privateKey)
    {
        $builder = $this->db->table($this->table);
        
        $data['user_name'] = "HEX(AES_ENCRYPT('{$data['user_name']}', '$privateKey'))";
        $data['user_email'] = "HEX(AES_ENCRYPT('{$data['user_email']}', '$privateKey'))";
        $data['user_mobile'] = "HEX(AES_ENCRYPT('{$data['user_mobile']}', '$privateKey'))";

        $builder->set('user_id', $data['user_id'], true);
        $builder->set('user_name', $data['user_name'], false);
        $builder->set('user_email', $data['user_email'], false);
        $builder->set('user_mobile', $data['user_mobile'], false);

        if (!empty($data['zip'])) {
            $data['zip'] = "HEX(AES_ENCRYPT('{$data['zip']}', '$privateKey'))";
            $builder ->set('zip', $data['zip'], false);
        }
        if (!empty($data['addr1'])) {
            $data['addr1'] = "HEX(AES_ENCRYPT('{$data['addr1']}', '$privateKey'))";
            $builder ->set('addr1', $data['addr1'], false);
        }
        if (!empty($data['addr2'])) {
            $data['addr2'] = "HEX(AES_ENCRYPT('{$data['addr2']}', '$privateKey'))";
            $builder ->set('addr2', $data['addr2'], false);
        }

        $data['user_level'] = '10';
        $data['status'] = '1';
        $data['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['r_date'] = date('Y-m-d H:i:s');
        $data['encode'] = 'Y';

        $builder->set('user_level', $data['user_level'], true);
        $builder->set('status', $data['status'], true);
        $builder->set('user_ip', $data['user_ip'], true);
        $builder->set('r_date', $data['r_date'], true);
        $builder->set('encode', $data['encode'], true);

        if (!empty($data['user_pw'])) {
            $data['user_pw'] = password_hash($data['user_pw'], PASSWORD_DEFAULT);
            $builder->set('user_pw', $data['user_pw'], true);
        }

        return $builder->insert();
    }
}