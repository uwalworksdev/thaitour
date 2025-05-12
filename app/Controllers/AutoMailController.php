<?php

namespace App\Controllers;

use App\Models\AutoMailModel;
use Exception;

class AutoMailController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AutoMailModel();
    }
    public function index()
    {
        $g_list_rows = 40;
        $pg = $this->request->getGet('pg') ?? 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $total_count = $this->model->getTotalCount();
        $nPage = ceil($total_count / $g_list_rows);

        $emails = $this->model->getEmails($nFrom, $g_list_rows);

        $data = [
            'emails' => $emails,
            'total_count' => $total_count,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
        ];

        return view('admin/_member/auto_mail_list', $data);
    }
    public function email_view()
    {
        $idx = $this->request->getGet('idx');
        $email = $this->model->find($idx);
        return view('admin/_member/email_view', ['email' => $email]);
    }
    public function email_mod_ok()
    {
        $idx        = updateSQ($this->request->getPost("idx"));
        $title      = updateSQ($this->request->getPost("title"));
        $code       = updateSQ($this->request->getPost("code"));
        $autosend   = updateSQ($this->request->getPost("autosend"));
        $send_name  = updateSQ($this->request->getPost("send_name"));
        $send_email = updateSQ($this->request->getPost("send_email"));
        $mail_title = updateSQ($this->request->getPost("mail_title"));
        $content    = updateSQ($this->request->getPost("content"));


        $data = [
            'title' => $title,
            'code' => $code,
            'autosend' => $autosend,
            'send_name' => $send_name,
            'send_email' => $send_email,
            'mail_title' => $mail_title,
            'content' => $content,
        ];

        
        if ($idx) {
            $this->model->update($idx, $data);
            return $this->response->setBody('<script>alert("수정되었습니다."); parent.location.reload();</script>');
        } else {
            $row = $this->model->where('code', $code)->first();

            if(!empty($row)) {
                return $this->response->setBody('<script>alert("코드가 중복된 코드입니다.");</script>');
            }
            $this->model->insert($data);
            return $this->response->setBody('<script>alert("등록되었습니다."); parent.location.reload();</script>');
        }
    }

    public function sms_delete() {
        try {
            $idx = $this->request->getPost("idx") ?? [];
            if (!$idx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => 'idx가 존재하지 않습니다'
                ], 400);
            }

            for ($i = 0; $i < count($idx); $i++) {
                $this->model->delete($idx[$i]);
            }

            $message = "삭제 성공.";
            return $this->response->setJSON([
                'result' => true,
                'message' => $message
            ], 200);
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
