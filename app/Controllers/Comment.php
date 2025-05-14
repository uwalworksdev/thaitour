<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class Comment extends BaseController
{

    private $comment;
    private $point;
    private $member;
    private $orderMileage;
    protected $sessionLib;
    protected $sessionChk;
    protected $db;

    public function __construct()
    {
        $this->comment = model("CommentModel");
        $this->point = model("Point");
        $this->orderMileage = model("OrderMileage");
        $this->member = model("Member");

        helper(['html']);
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('comment_helper');
    }
    public function listComment()
    {
        $r_code = $this->request->getVar("r_code");
        $r_idx = updateSQ($this->request->getVar("r_idx"));
        $role = updateSQ($this->request->getVar("role"));
        $commentsArray = $this->comment->getComments($r_code, $r_idx, private_key());
        if ($role == "admin") {
            $commentsArray = $this->comment->getComments($r_code, $r_idx, private_key(), "admin");

            $list = generateCommentsAdminHTML($commentsArray, $r_code, $r_idx);
        } else {
            if($r_code == "time_sale"){
                $list = getCommentTimeSale($commentsArray, $r_code, $r_idx);
            }else{
                $list = getComment($commentsArray, $r_code, $r_idx);
            }
        }
        return $list;
    }
    
    public function addComment()
    {
        $r_idx = updateSQ($this->request->getPost('r_idx') ?? '0');
        $r_code = $this->request->getPost('r_code' ?? '');
        $r_content = updateSQ($this->request->getPost('comment'));
        $user_id = session('member.id');
        $r_m_idx = session('member.idx');
        $r_name = session('member.name');

        if (empty($user_id)) {
            return $this->response->setJSON("");
        }

        $data = [
            'r_idx' => $r_idx,
            'r_code' => $r_code,
            'r_m_idx' => $r_m_idx,
            'r_name' => $r_name ?? "",
            'r_content' => $r_content,
            'r_reg_date' => date('Y-m-d H:i:s'),
            'r_level' => 1,
            'r_step' => 1,
            'r_delYN' => 'N',
            'r_status' => 'Y'
        ];

        $result = $this->comment->addComment($data);

        if($r_code == "qna" && $user_id == "admin"){
            $this->db->table("tbl_travel_qna")
                ->where('idx', $r_idx)
                ->update(['status' => 'Y']);
        }

        if($r_code == "contact" && $user_id == "admin"){
            $this->db->table("tbl_travel_contact")
                ->where('idx', $r_idx)
                ->update(['status' => 'Y']);
        }

        $comment_point = $this->point->getPoint()["comment_point"] ?? 0;

        $memberData = $this->member->find($r_m_idx);

        $isset_point = $this->orderMileage->getPointByType($r_idx, $r_code, "comment");

        if(!empty($memberData) && empty($isset_point)) {
            $currentMileage = $memberData['mileage'] ?? 0;
            $newMileage = $currentMileage + intval($comment_point);
    
            $this->member->update($r_m_idx, ['mileage' => $newMileage]);
    
            $currentRemaining = $memberData['mileage'] ?? 0;
            $newRemaining = $currentRemaining + intval($comment_point);
            if(!empty($comment_point)) {
                $this->orderMileage->insert([
                    'm_idx'             => $r_m_idx,
                    'mi_title'          => '게시물에 댓글 달기',
                    'order_gubun'       => '게시물에 댓글 달기',
                    'order_idx'         => 0,
                    'order_mileage'     => intval($comment_point),
                    'mi_r_date'         => date('Y-m-d H:i:s'),
                    'product_idx'       => 0,
                    'bbs_idx'           => $r_idx,
                    'code'              => $r_code,
                    'point_type'        => "comment",
                    'remaining_mileage' => $newRemaining,
                ]);
            }
        }

        return $result;
    }
    public function replyComment()
    {
        $r_ref = updateSQ($this->request->getPost('r_ref'));
        $r_idx = updateSQ($this->request->getPost('r_idx'));
        $r_level = updateSQ($this->request->getPost('r_level'));
        $r_content = updateSQ($this->request->getPost('r_content'));
        $r_code = $this->request->getPost('r_code');
        $r_m_idx = session('member.idx');
        $r_name = session('member.name');

        $data = [
            'r_ref' => $r_ref,
            'r_idx' => $r_idx,
            'r_level' => $r_level,
            'r_content' => $r_content,
            'r_code' => $r_code,
            'r_m_idx' => $r_m_idx,
            'r_name' => $r_name,
            'r_reg_date' => date('Y-m-d H:i:s')
        ];

        $result = $this->comment->replyComment($data);

        return $this->response->setJSON($result);
    }
    public function deleteComment()
    {
        $r_cmt_idx = updateSQ($this->request->getPost("r_cmt_idx"));

        $userId = session('member.idx');
        $userIdx = session('member.idx');
        $userLevel = session('member.level');

        $result = $this->comment->softDeleteComment($r_cmt_idx, $userIdx, $userId, $userLevel);

        return $this->response->setJSON($result);
    }
    public function updateComment()
    {
        $r_cmt_idx  = updateSQ($this->request->getPost('r_cmt_idx'));
        $r_content  = updateSQ($this->request->getPost('r_content'));
        $user_idx   = session('member.idx');
        $user_id    = session('member.id');
        $user_level = session('member.level');
    
        $result = $this->comment->updateComment($r_cmt_idx, $r_content, $user_idx, $user_id, $user_level);
    
        return $this->response->setJSON($result);
    }

    public function updateReportState(){
        $r_cmt_idx  = updateSQ($this->request->getPost('r_cmt_idx'));
        $r_idx  = updateSQ($this->request->getPost('r_idx'));
        $state  = updateSQ($this->request->getPost('state'));

        $db = db_connect();
        $builder = $db->table('tbl_bad_list');
        $builder->where('cmt_idx', $r_cmt_idx);
        $builder->where('bbs_idx', $r_idx);
        $result = $builder->update(['state' => $state]);

        return $this->response->setJSON($result);
    }

    public function reportComment()
    {
        $code = updateSQ($this->request->getPost('code'));
        $r_idx = updateSQ($this->request->getPost('r_idx'));
        $r_cmt_idx = updateSQ($this->request->getPost('r_cmt_idx'));
        $report_reason = updateSQ($this->request->getPost('report_reason'));

        $m_idx = session('member.idx');

        if (!$m_idx) {
            return $this->response->setJSON(['result' => 'NO', 'msg' => '로그인을 해주세요.']);
        }

        $result = $this->comment->reportComment($code, $r_idx, $r_cmt_idx, $report_reason, $m_idx);

        return $this->response->setJSON($result);
    }
}