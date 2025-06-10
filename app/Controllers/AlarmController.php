<?php

namespace App\Controllers;
use Exception;

class AlarmController extends BaseController
{

    private $Alarm;
    protected $db;

    public function __construct()
    {
        $this->Alarm = model("AlarmModel");
        $this->db = db_connect();
    }
   
    public function markRead()
    {
        $ids = $this->request->getPost('data');
        if (!is_array($ids) || empty($ids)) {
            return $this->response->setJSON([
                'success' => false
            ]);
        }
        $updated = $this->Alarm->whereIn('idx', $ids)->set(['status' => '1'])->update();

        if ($updated) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function delAll(){
        $m_idx = $this->session->get('member')['idx'];
        $delete = $this->Alarm->where('m_idx', $m_idx)->delete();
        if ($delete) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function delSelect(){
        $ids = $this->request->getPost('data');
        if (!is_array($ids) || empty($ids)) {
            return $this->response->setJSON([
                'success' => false
            ]);
        }
        $delete = $this->Alarm->whereIn('idx', $ids)->delete();

        if ($delete) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }


    public function delReaden(){
        $m_idx = $this->session->get('member')['idx'];
        $delete = $this->Alarm->where('status', '1')->where('m_idx', $m_idx)->delete();
        if ($delete) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}