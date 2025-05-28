<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;
use CodeIgniter\I18n\Time;

class Contact extends BaseController
{
    protected $bbs;
    protected $db;
    protected $sessionChk;
    protected $sessionLib;
    protected $member;
    protected $product;
    protected $travelContact;
    protected $policy;
    protected $code;
    private $uploadPath = FCPATH . "data/contact/";


    public function __construct()
    {
        $this->bbs = model("Bbs");
        $this->member = model("Member");
        $this->product = model("ProductModel");
        $this->travelContact = model("TravelContactModel");
        $this->code = model("Code");
        $this->policy = model("PolicyModel");

        helper(['html']);
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('comment_helper');
    }
    public function main()
    {
        $deviceType = get_device();
        $currentUri = $this->request->getUri()->getPath();
        $page = $this->request->getVar('page');
        $search_category = $this->request->getVar('search_category');
        $s_txt = $this->request->getVar('s_txt');

        $s_code  =  '116';  
        $visual     = $this->bbs->where("code", "banner")->where("category", $s_code)->first();

        $scale = 10;

        if ($page == ""){ 
            $page = 1;
        }

        $contact = $this->travelContact->getContact($s_txt, $search_category, $page, $scale);

        $result = $contact["travel_contact"];
        $no = $contact["num"];
        $total_page = $contact["nPage"];
        $total_cnt = $contact["nTotalCount"];

        return view("contact/main", [
            'list_contact' => $result,
            'no' => $no,
            'page' => $page,
            'total_page' => $total_page,
            'search_category' => $search_category,
            's_txt' => $s_txt,
            'visual' => $visual,
            'deviceType' => $deviceType,
            'total_cnt' => $total_cnt,
            'currentUri' => $currentUri
        ]);
    }

    public function write($idx = null) {


        $privacy = $this->policy->getByCode("privacy");
        $third_paties = $this->policy->getByCode("third_paties");

        $row_m = $this->member->getByIdx(session()->get("member")["idx"]);

        $list_code = $this->code->getCodesByParentCodeAndStatus(13, 2);

        $types_code = $this->code->getCodesByParentCodeAndStatus(61, 2);

        if(isset($idx)) {
            $row = $this->travelContact->find($idx);
        }

        return view("contact/write", [
            'idx' => $idx,
            'row' => $row,
            'row_m' => $row_m,
            'list_code' => $list_code,
            'privacy' => $privacy,
            'third_paties' => $third_paties,
            'types_code' => $types_code ?? [],
        ]);
    }

    public function view() {
        $idx = $this->request->getVar('idx');
        $builder = $this->db->table('tbl_travel_contact a')
                                ->select('a.*, b.code_name, c.code_name as type_name')
                                ->join('tbl_code b', 'a.travel_type_1 = b.code_no', 'left')
                                ->join('tbl_code c', 'c.code_no = a.type_code', 'left')

                                ->where('a.idx', $idx);
        $contact = $builder->get()->getRowArray();

        $travel_type_1 = $this->code->getByCodeNo($contact['travel_type_1']);
        $travel_type_2 = $this->code->getByCodeNo($contact['travel_type_2']);
        $travel_type_3 = $this->code->getByCodeNo($contact['travel_type_3']);

        return view("contact/view", [
            "idx" => $idx,
            "contact" => $contact,
            "r_code" => "contact",
            "travel_type_1" => $travel_type_1,
            "travel_type_2" => $travel_type_2,
            "travel_type_3" => $travel_type_3
        ]);
    }

    public function write_ok() {

        try {

            $uploadPath = $this->uploadPath;

            $files = $this->request->getFiles();

            $data = $this->request->getPost();

            $idx = $this->request->getPost("idx");
            $user_name = $this->request->getPost("user_name");
            $user_phone = $this->request->getPost("user_phone");
            $mail1 = $this->request->getPost("mail1");
            $mail2 = $this->request->getPost("mail2");

            $user_email = $mail1 . "@" . $mail2;
            $user_email = sqlSecretConver($user_email, "encode");
            $user_name = sqlSecretConver($user_name, "encode");
            $user_phone = sqlSecretConver($user_phone, "encode");

            $type_code = $this->request->getPost("type_code");

            $data["type_code"] = $type_code;
            $data["user_name"] = $user_name;
            $data["user_phone"] = $user_phone;
            $data["user_email"] = $user_email;

            for ($i = 1; $i <= 1; $i++) {
                if ($this->request->getPost("del$i") == "Y") {
                    $data["ufile$i"] = "";
                    $data["rfile$i"] = "";

                } elseif ($files["ufile$i"]) {
                    $file = $files["ufile$i"];

                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = $file->getClientName();
                        $data["rfile$i"] = $fileName;

                        if (no_file_ext($fileName) == "Y") {
                            $microtime = microtime(true);
                            $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                            $date = date('YmdHis');
                            $ext = explode(".", strtolower($fileName));
                            $newName = $date . $timestamp . '.' . $ext[1];
                            $data["ufile$i"] = $newName; 
                            $file->move($uploadPath, $newName);
                        }
                    }
                }
            }

            if($idx){
                $data["m_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                $result = $this->travelContact->updateData($idx, $data);

                if($result){
                    return $this->response->setJSON([
                        'result' => true,
                        'status' => 'update',
                        'message' => "업데이트되었습니다."
                    ], 200);
                }
            }else{
                $data["reg_m_idx"] = session()->get("member")["idx"];
                $data["status"] = "W";
                $data["user_ip"] = $this->request->getIPAddress();
                $data["r_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->travelContact->insertData($data);

                if($insertId){
                    return $this->response->setJSON([
                        'result' => true,
                        'status' => 'insert',
                        'message' => "성공적으로 추가되었습니다"
                    ], 200);
                }
            }

        }catch(\Exception $e){
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    
    }

    public function delete() {

        try {
            $idx = $this->request->getPost("idx");
            if(!empty($idx)){
                $result = $this->travelContact->deleteTravelContact($idx);

                if($result) {
                    return $this->response->setJSON([
                        'result' => true,
                        'message' => "정상적으로 삭제되었습니다."
                    ], 200);
                }else{
                    return $this->response->setJSON([
                        'result' => false,
                        'message' => "오류가 발생하였습니다!!"
                    ], 400);
                }
            }else{
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "오류가 발생하였습니다!!"
                ], 400);
            }

        }catch(\Exception $e){
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}