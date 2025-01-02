<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class Qna extends BaseController
{
    private $qna;
    protected $product;
    private $code;
    private $db;
    protected $sessionLib;
    protected $sessionChk;
    public function __construct()
    {
        $this->code = model("Code");
        $this->qna = model("Qna");
        $this->product = model("ProductModel");
        helper(['html']);
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('comment_helper');
    }
    public function list()
    {
        $private_key = private_key();
        $deviceType = get_device();
        $currentUri = $this->request->getUri()->getPath();
        $page = $this->request->getVar('page');
        $search_category = $this->request->getVar('search_category');
        $s_txt = $this->request->getVar('s_txt');
        $strSql = "";
        if ($s_txt and ($search_category == "user_name")) {
            $strSql = $strSql . " and replace(CONVERT( AES_DECRYPT( UNHEX( FROM_BASE64(" . $search_category . ") ), '" . $private_key . "') using UTF8),'-','') like '%" . str_replace("-", "", $s_txt) . "%' ";
        }
        if ($s_txt and ($search_category == "title" || $search_category == "contents")) {
            $strSql = $strSql . " and $search_category like '%" . str_replace("-", "", $s_txt) . "%' ";
        }
        $s_code = '109';
        $sql_s = "select * from tbl_bbs_list where code = 'banner' and category = '$s_code' ";
        $visual = $this->db->query($sql_s)->getRowArray();
        if (!$page) {
            $page = 1;
        }

        $scale = 10;

        $total_sql = " SELECT A.*, COUNT(B.r_idx) AS cmt_cnt
                        FROM tbl_travel_qna A
                        LEFT JOIN tbl_bbs_cmt B ON A.idx = B.r_idx AND B.r_code = 'qna' AND B.r_status = 'Y' AND B.r_delYN = 'N'
                        WHERE 1=1 $strSql 
                        GROUP BY A.idx
                        ";
        $total_cnt = $this->db->query($total_sql)->getNumRows();

        $total_page = ceil($total_cnt / $scale);
        if ($page == "")
            $page = 1;
        $start = ($page - 1) * $scale;

        $sql = $total_sql . " order by A.idx desc limit $start, $scale ";
        $result = $this->db->query($sql)->getResultArray();
        $no = $total_cnt - $start;
        return view("qna/list", [
            'list_qna' => $result,
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
    public function view() {
        $idx = $this->request->getVar('idx');
        $total_sql = " select a.*, b.code_name from tbl_travel_qna a left outer join tbl_code b on 
        a.travel_type_1 = b.code_no
        where idx='" . $idx . "'";
        $qna = $this->db->query($total_sql)->getRowArray();

        $travel_type_1 = $this->code->getByCodeNo($qna['travel_type_1']);
        $travel_type_2 = $this->code->getByCodeNo($qna['travel_type_2']);
        $travel_type_3 = $this->code->getByCodeNo($qna['travel_type_3']);

        return view("qna/view", [
            "idx" => $idx,
            "qna" => $qna,
            "r_code" => "qna",
            "travel_type_1" => $travel_type_1,
            "travel_type_2" => $travel_type_2,
            "travel_type_3" => $travel_type_3
        ]);
    }
    public function write()
    {
        $private_key = private_key();
        $member_Id = session('member.idx');

        if (!$member_Id) {
            echo "<script>
                        alert('로그인 필요합니다.');
                        location.href = '/member/login';
                    </script>";
            die();
        }

        $sql_m = "SELECT     birthday
                    , AES_DECRYPT(UNHEX(user_name),   '$private_key') AS user_name
                    , AES_DECRYPT(UNHEX(user_mobile), '$private_key') AS user_mobile
                    , AES_DECRYPT(UNHEX(user_email),  '$private_key') AS user_email
                    , AES_DECRYPT(UNHEX(zip),         '$private_key') AS zip
                    , AES_DECRYPT(UNHEX(addr1),       '$private_key') AS addr1
                    , AES_DECRYPT(UNHEX(addr2),       '$private_key') AS addr2
                        FROM tbl_member WHERE m_Idx = '$member_Id' ";
        $row_m = $this->db->query($sql_m)->getRowArray();

        $idx = updateSQ($_GET["idx"]);

        $sql0 = "SELECT * FROM tbl_code WHERE parent_code_no = 13 AND depth = '2' order by onum";
        $result0 = $this->db->query($sql0)->getResultArray();

        if(!empty($idx)){
            $sql = "select * from tbl_travel_qna where idx = '$idx'";
            $qna_item = $this->db->query($sql)->getRowArray();
            $travel_type_1 = $qna_item["travel_type_1"];
            $travel_type_2 = $qna_item["travel_type_2"];
            $travel_type_3 = $qna_item["travel_type_3"];
    
            $sql = "SELECT * FROM tbl_code WHERE parent_code_no = '$travel_type_1' AND depth = '3' ";
            $result1 = $this->db->query($sql)->getResultArray();
    
            $sql = "SELECT * FROM tbl_code WHERE parent_code_no = '$travel_type_2' AND depth = '4' ";
            $result2 = $this->db->query($sql)->getResultArray();
    
            $products = $this->product->getAllProductsBySubCode("product_code_3", $travel_type_3);
        }

        $sql = "SELECT * FROM tbl_policy_info WHERE policy_code = 'privacy'";
        $privacy = $this->db->query($sql)->getRowArray();

        $sql = "SELECT * FROM tbl_policy_info WHERE policy_code = 'third_paties'";
        $third_paties = $this->db->query($sql)->getRowArray();

        return view("qna/write", [
            "idx" => $idx,
            'qna_item' => $qna_item,
            'row_m' => $row_m,
            'result0' => $result0,
            'result1' => $result1,
            'result2' => $result2,
            'products' => $products,
            'privacy' => $privacy,
            'third_paties' => $third_paties
        ]);
    }
    public function write_ok()
    {
        $uploadPath         = ROOTPATH . 'public/uploads/qna/';
        $idx                = $this->request->getPost('idx');
        $user_name          = updateSQText($this->request->getPost('user_name'));
        $user_phone         = updateSQText($this->request->getPost('user_phone'));
        $user_email         = updateSQText($this->request->getPost('mail1')) . '@' . updateSQText($this->request->getPost('mail2'));
        $departure_date     = updateSQText($this->request->getPost('departure_date'));
        $arrival_date       = updateSQText($this->request->getPost('arrival_date'));
        $travel_type_1      = updateSQText($this->request->getPost('travel_type_1'));
        $travel_type_2      = updateSQText($this->request->getPost('travel_type_2'));
        $travel_type_3      = updateSQText($this->request->getPost('travel_type_3'));
        $consultation_time  = updateSQText($this->request->getPost('consultation_time'));
        $product_name       = updateSQText($this->request->getPost('product_name'));
        $title              = updateSQText($this->request->getPost('title'));
        $contents           = updateSQText($this->request->getPost('contents'));
        $user_phone_string  = implode(explode('-', $user_phone));
        $pass               = substr($user_phone_string, -4);
        $data = [
            'user_name' => sqlSecretConver($user_name, 'encode'),
            'user_phone' => sqlSecretConver($user_phone, 'encode'),
            'user_email' => sqlSecretConver($user_email, 'encode'),
            'departure_date' => $departure_date,
            'arrival_date' => $arrival_date,
            'travel_type_1' => $travel_type_1,
            'travel_type_2' => $travel_type_2,
            'travel_type_3' => $travel_type_3,
            'consultation_time' => $consultation_time,
            'product_name' => $product_name,
            'title' => $title,
            'contents' => $contents,
            'm_date' => date('Y-m-d H:i:s'),
        ];
        if ($file = $this->request->getFile('ufile1')) {
            if ($file->isValid() && !$file->hasMoved()) {
                if (!noFileExt($file->getName())) {
                    echo "NF";
                    exit();
                }

                $rfile_1 = $file->getName();
                $file->move($uploadPath);
                $data['ufile1'] = $file->getName();
                $data['rfile1'] = $rfile_1;
            }
        }
        if ($idx) {
            $this->qna->updateQna($idx, $data);
        } else {
            $data['reg_m_idx'] = session('member.idx');
            $data['status'] = 'W';
            $data['r_date'] = date('Y-m-d H:i:s');
            $data['passwd'] = $pass;
            $data['user_ip'] = $this->request->getIPAddress();
            $this->qna->insertQna($data);
        }

        return "OK";
    }

    public function delete() {

        try {
            $idx = $this->request->getPost("idx");
            if(!empty($idx)){
                $result = $this->qna->deleteQna($idx);

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