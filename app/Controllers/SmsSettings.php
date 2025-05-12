<?php
namespace App\Controllers;

use App\Models\SmsModel;
use Exception;

class SmsSettings extends BaseController
{
    private $SmsModel;

    public function __construct()
    {
        $this->SmsModel = new SmsModel();
    }
    public function index()
    {
        $model = new SmsModel();

        $g_list_rows = 15;
        $pg = $this->request->getGet('pg') ?? 1;
        $nFrom = ($pg - 1) * $g_list_rows;
        $total_count = $model->countAll();
        $nPage = ceil($total_count / $g_list_rows);

        $data = [
            'total_count' => $total_count,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'sms_list' => $model->getSms($nFrom, $g_list_rows),
            'pg' => $pg,
        ];

        return view('admin/_member/sms_settings', $data);
    }

    public function sms_view()
    {
        $idx = $this->request->getVar('idx');
        
        $sms = $this->SmsModel->find($idx);
        return view('admin/_member/sms_view', ['sms' => $sms]);
    }
    public function sms_mod_ok()
    {
        $idx		= updateSQ($this->request->getPost("idx"));
        $code       = updateSQ($this->request->getPost("code"));
        $title      = updateSQ($this->request->getPost("title"));
        $autosend	= updateSQ($this->request->getPost("autosend"));
        $content	= updateSQ($this->request->getPost("content"));

        $data = [
            'title'     => $title,
            'code'      => $code,
            'autosend'  => $autosend,
            'content'	=> $content,
        ];

        
        if ($idx) {
            $this->SmsModel->update($idx, $data);
            return $this->response->setBody('<script>alert("수정되었습니다.");parent.location.reload();</script>');
        } else {
            $row = $this->SmsModel->where('code', $code)->first();

            if(!empty($row)) {
                return $this->response->setBody('<script>alert("코드가 중복된 코드입니다.");</script>');
            }

            $this->SmsModel->insert($data);
            return $this->response->setBody('<script>alert("등록되었습니다.");parent.location.reload();</script>');
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
                $this->SmsModel->delete($idx[$i]);
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
