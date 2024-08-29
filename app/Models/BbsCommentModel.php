<?php

namespace App\Models;

use CodeIgniter\Model;

class BbsCommentModel extends Model
{
    protected $table = 'tbl_bbs_comment';

    protected $primaryKey = 'tbc_idx';

    protected $skipValidation = true;
    public function getCommentsWithMemberDetails($bbs_idx, $code, $private_key)
    {
        $sql = "SELECT s1.*, 
                    s2.user_id, 
                    s2.ufile1 AS avt_new, 
                    s2.rfile1 AS avt_old,
                    CONVERT(AES_DECRYPT(UNHEX(s2.user_name), ?) USING utf8) AS user_name,
                    CONVERT(AES_DECRYPT(UNHEX(s2.user_email), ?) USING utf8) AS user_email,
                    CONVERT(AES_DECRYPT(UNHEX(s2.user_phone), ?) USING utf8) AS user_phone,
                    s2.user_level, 
                    s3.state AS report_state, 
                    s3.report_reason, 
                    s3.idx AS report_idx
                FROM tbl_bbs_comment AS s1 
                LEFT JOIN tbl_member AS s2 ON s1.m_idx = s2.m_idx  
                LEFT JOIN tbl_bad_list AS s3 ON CONCAT(s1.code, '_cmt') = s3.code AND s1.tbc_idx = s3.cmt_idx
                WHERE s1.bbs_idx = ? AND s1.code = ?  order by r_date desc";

        return $this->db->query($sql, [
            $private_key,
            $private_key,
            $private_key,
            $bbs_idx,
            $code
        ])->getResultArray();
    }
}
