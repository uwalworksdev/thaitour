<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;
use CodeIgniter\I18n\Time;

class ProductQnaController extends BaseController
{
    protected $connect;
    protected $productQna;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->productQna = model("ProductQna");
    }

    public function list()
    {
        try {


            return $this->response->setJSON([
                'result' => true,
                'message' => ""
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }


    public function insert()
    {
        try {

            $data = $this->request->getPost();
            $m_idx = session()->get("member")["idx"];

            $data["m_idx"] = $m_idx;
            $data["user_ip"] = $this->request->getIPAddress();;
            $data["r_date"] = Time::now('Asia/Seoul', 'en_US')->format('Y-m-d H:i:s');
            
            $result = $this->productQna->insertData($data);

            if($result){
                return $this->response->setJSON([
                    'result' => true,
                    'message' => "성공적으로 게시했습니다."
                ], 200);
            }else{
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "오류가 발생했습니다."
                ])->setStatusCode(400);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

}
