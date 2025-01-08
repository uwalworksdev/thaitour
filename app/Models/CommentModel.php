<?php

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'tbl_bbs_cmt';
    protected $primaryKey = 'r_cmt_idx';
    protected $allowedFields = ["r_idx", "r_status", "r_reg_date", "r_reg_m_idx", "r_mod_date", "r_mod_m_idx", "r_step", "r_level", "r_ref", "r_date", "r_name", "r_private", "r_passwd", "r_category", "r_title", "r_html", "r_content", "r_url", "r_file_code", "r_file_name", "r_file_list", "r_code", "r_m_idx", "r_delYN"];

    public function getComments($r_code, $r_idx, $private_key)
    {
        $builder = $this->db->table($this->table);
        $builder->select("tbl_bbs_cmt.*, tbl_member.user_id, tbl_member.ufile1 as avt_new, tbl_member.rfile1 as avt_old, 
                         CONVERT(AES_DECRYPT(UNHEX(tbl_member.user_name), '$private_key') USING utf8) as user_name, 
                         CONVERT(AES_DECRYPT(UNHEX(tbl_member.user_email), '$private_key') USING utf8) as user_email, 
                         CONVERT(AES_DECRYPT(UNHEX(tbl_member.user_phone), '$private_key') USING utf8) as user_phone, 
                         tbl_member.user_level");
        $builder->join("tbl_member", "tbl_member.m_idx = tbl_bbs_cmt.r_m_idx", "inner");
        $builder->join("tbl_bad_list", "tbl_bbs_cmt.r_code = tbl_bad_list.code AND tbl_bbs_cmt.r_cmt_idx = tbl_bad_list.cmt_idx", "left");
        $builder->where("tbl_bbs_cmt.r_code", $r_code);
        $builder->where("tbl_bbs_cmt.r_idx", $r_idx);
        $builder->where("tbl_bbs_cmt.r_status", 'Y');
        $builder->where("tbl_bbs_cmt.r_delYN", 'N');
        $builder->groupStart()
            ->where("tbl_bad_list.idx IS NULL")
            ->orWhere("tbl_bad_list.state", 0)
            ->orWhere("tbl_bad_list.state", 2)
            ->groupEnd();
        $builder->orderBy("tbl_bbs_cmt.r_reg_date", "DESC");
        $builder->orderBy("tbl_bbs_cmt.r_level", "ASC");

        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addComment($data)
    {
        if ($this->insert($data)) {
            return 'OK';
        } else {
            return 'ERROR2';
        }
    }
    public function replyComment($data)
    {
        if ($this->insert($data)) {
            return ['result' => 'OK', 'msg' => '등록했습니다.'];
        } else {
            return ['result' => 'NO', 'msg' => '오류가 발생하였습니다.'];
        }
    }
    public function softDeleteComment($r_cmt_idx, $userIdx, $userId, $userLevel)
    {
        $comment = $this->find($r_cmt_idx);

        if (!$comment) {
            return ['result' => 'NO', 'msg' => '작성자가 아닙니다.'];
        }

        if ($comment['r_m_idx'] == $userIdx || $userId == 'admin' || $userLevel <= 2) {
            $del = ($userId == 'admin') ? 'A' : 'Y';
            $this->deleteDepthComment($r_cmt_idx, ['r_delYN' => $del]);

            return ['result' => 'OK', 'msg' => '삭제되었습니다.'];
        } else {
            return ['result' => 'NO', 'msg' => '작성자가 아닙니다.'];
        }
    }

    public function deleteDepthComment($r_cmt_idx, $del) {
        $comment_child = $this->where("r_ref", $r_cmt_idx)->findAll();
        foreach($comment_child as $cmt){
            $this->deleteDepthComment($cmt["r_cmt_idx"], $del);
        }

        $this->update($r_cmt_idx, ['r_delYN' => $del]);
    }
    public function updateComment($r_cmt_idx, $r_content, $userIdx, $userId, $userLevel)
    {
        $comment = $this->find($r_cmt_idx);

        if (!$comment) {
            return ['result' => 'NO', 'msg' => 'Comment not found.'];
        }

        if ($comment['r_m_idx'] == $userIdx || $userId == 'admin' || $userLevel <= 2) {
            $data = ['r_content' => $r_content];
            $this->update($r_cmt_idx, $data);

            return ['result' => 'OK', 'msg' => '댓글이 수정되었습니다.'];
        } else {
            return ['result' => 'NO', 'msg' => '작성자가 아닙니다.'];
        }
    }
    public function reportComment($code, $r_idx, $r_cmt_idx, $report_reason, $m_idx)
    {
        $db = db_connect();
        $builder = $db->table('tbl_bad_list');

        $builder->select('count(idx) as cnt')
            ->where('m_idx', $m_idx)
            ->where('code', $code)
            ->where('bbs_idx', $r_idx)
            ->where('is_user_report', '');

        $query = $builder->get();
        $row = $query->getRow();

        if ($row->cnt > 0) {
            return ['result' => 'NO', 'msg' => '이미 신고한 댓글입니다.'];
        }

        $data = [
            'm_idx' => $m_idx,
            'report_reason' => $report_reason,
            'code' => $code,
            'bbs_idx' => $r_idx,
            'cmt_idx' => $r_cmt_idx,
            'state' => 1,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'r_date' => date('Y-m-d H:i:s')
        ];

        if ($builder->insert($data)) {
            return ['result' => 'OK', 'msg' => '댓글이 신고되었습니다.'];
        } else {
            return ['result' => 'NO', 'msg' => '신고에 실패했습니다.'];
        }
    }
}