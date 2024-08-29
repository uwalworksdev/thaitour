<?php
namespace App\Controllers;

use App\Models\SmsModel;

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
        $idx				= updateSQ($this->request->getPost("idx"));
        $autosend			= updateSQ($this->request->getPost("autosend"));
        $content			= updateSQ($this->request->getPost("content"));

        $data = [
            'autosend'		=> $autosend,
            'content'		=> $content,
        ];

        
        if ($idx) {
            $this->SmsModel->update($idx, $data);
            return $this->response->setBody('<script>alert("수정되었습니다.");parent.location.reload();</script>');
        } else {
            $this->SmsModel->insert($data);
            return $this->response->setBody('<script>alert("등록되었습니다.");parent.location.reload();</script>');
        }
    }
}
