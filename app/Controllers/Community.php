<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use CodeIgniter\I18n\Time;

use Exception;

class Community extends BaseController
{

    private $comment;
    private $db;
    private $uploadPath = ROOTPATH."public/uploads/qna/";
    protected $bbs;
    protected $qna;
    protected $contact;
    protected $currentTime;

    protected $sessionLib;
    protected $sessionChk;

    private $OrdersModel;

    private $OrdersSub;

    public function __construct()
    {
        $this->bbs = model("Bbs");
        $this->qna = model("Qna");
        $this->contact = model("TravelContactModel");
        helper(['html']);
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('comment_helper');
        $this->OrdersModel = model("OrdersModel");
        $this->OrdersSub = model("OrderSubModel");

        $this->currentTime = Time::now('Asia/Seoul')->toDateTimeString();

    }
    public function main()
    {
        $code_no = 1;
        $private_key = private_key();
        if ($code_no)
            $searchSql = " and a.category = '$code_no' ";
        $sql = "select a.*, b.code_name as code_name from tbl_bbs_list a
                inner join tbl_code b on a.category = b.code_idx
                where a.code = 'faq'  and  a.status = 'Y' order by a.onum desc limit 0,5 ";
        $faq_list = $this->db->query($sql)->getResultArray();
        $sql = "select * from tbl_bbs_list  where code = 'b2b_notice' and status = '' order by notice_yn desc, r_date desc limit 0,4 ";
        $b2b_notice_list = $this->db->query($sql)->getResultArray();
        $toDay = date('Y-m-d');
        $sql = "select * from tbl_bbs_list where code = 'event' and s_date <= '$toDay' and e_date >= '$toDay' order by r_date desc limit 2";
        $event_list = $this->db->query($sql)->getResultArray();
        $sql = "select * from tbl_bbs_list where code = 'winner' order by r_date desc limit 3";
        $winner_list = $this->db->query($sql)->getResultArray();

        $total_sql = "select s1.order_user_name, s1.order_status, s1.m_idx, s1.order_idx, s1.order_r_date, s1.product_idx
                                            from tbl_order_mst s1 where s1.is_modify='N' and s1.isDelete != 'Y' and s1.order_gubun='tour' and s1.order_status != 'D'";
        $total_order = $this->db->query($total_sql)->getNumRows();
        $sql = $total_sql . " order by s1.order_r_date desc, s1.order_idx desc limit 0, 5 ";
        // $order_list = $this->db->query($sql)->getResultArray();

        // foreach ($order_list as $key => $row) {
        //     $sql_d = "SELECT   AES_DECRYPT(UNHEX('{$row['order_user_name']}'),   '$private_key') order_user_name";
        //     $row_d = $this->db->query($sql_d)->getRowArray();
        //     $row['order_user_name'] = $row_d['order_user_name'];

        //     $sql_p = "SELECT s2.code_name from tbl_product_mst s1 inner join tbl_code s2 on s1.product_code_1 = s2.code_no where s1.product_idx = '{$row['product_idx']}' ";
        //     $row_p = $this->db->query($sql_p)->getRowArray();
        //     $row['code_name'] = $row_p['code_name'];

        //     $sql_c = "SELECT count(r_idx) as cmt_cnt from tbl_bbs_cmt where r_idx = '{$row['order_idx']}' and r_code = 'order' ";
        //     $row_c = $this->db->query($sql_c)->getRowArray();
        //     $row['cmt_cnt'] = $row_c['cmt_cnt'];
        //     $order_list[$key] = $row;
        // }
        $pg = $this->request->getVar('pg');
        $s_txt = $this->request->getVar('s_txt');
        $search_category = $this->request->getVar('search_category');
        $ordersObj = $this->OrdersModel->getOrders($s_txt, $search_category, $pg, 5);

        $order_list = $ordersObj['order_list'];
        $nTotalCount = $ordersObj['nTotalCount'];
        $nPage = $ordersObj['nPage'];
        $num = $ordersObj['num'];
        $pg = $ordersObj['pg'];

        foreach ($order_list as $key => $row) {
            $sql_d = "SELECT   AES_DECRYPT(UNHEX('{$row['order_user_name']}'),   '$private_key') order_user_name";
            $row_d = $this->db->query($sql_d)->getRowArray();
            $row['order_user_name'] = $row_d['order_user_name'];
            $row['cnt'] = count($this->OrdersSub->getOrderSub($row['order_idx']));
            $order_list[$key] = $row;
        }

        return view("community/main", [
            'faq_list' => $faq_list,
            'b2b_notice_list' => $b2b_notice_list,
            'event_list' => $event_list,
            'winner_list' => $winner_list,
            'total_order' => $total_order,
            'order_list' => $order_list,
            "num" => $num,
            "nTotalCount" => $nTotalCount,
            "nPage" => $nPage,
            "pg" => $pg,
        ]);

    }
    public function questions()
    {
        $code_no = $this->request->getVar('code_no');
        $sql_c = "select * from tbl_code where code_gubun = 'faq' and depth = '2' order by onum asc ";
        $code_gubun = $this->db->query($sql_c)->getResultArray();
        $searchSql = "";
        if ($code_no)
            $searchSql = " and a.r_category = '$code_no' ";
        $sql = "select r_idx, r_reg_date, r_reg_m_idx, r_mod_date, r_mod_m_idx, r_code, r_order, r_date, r_name, r_view_cnt, r_score, r_category, r_category2, r_title, r_desc, r_content, r_url, r_file_code, r_file_name, r_file_list, r_answer_status, r_answer_date, r_answer_m_idx, r_answer_name, r_answer_content, r_cmt_cnt, r_order, r_flag, code_name
                                    , case a.r_status  when 'Y' then '사용'  when 'N' then '중지'  when 'D' then '삭제'  else '' end as str_status
                                    ,(select ifnull(count(*),0) from tbl_bbs_cmt where tbl_bbs_cmt.r_idx=a.r_idx and tbl_bbs_cmt.r_delYN != 'Y') as r_cmt_cnt
                                        from tbl_bbs a
                                        join tbl_code b on a.r_category = b.code_no and a.r_code = b.code_gubun
                                    where  a.r_code = 'faq'  and  a.r_status != 'D' $searchSql order by r_reg_date desc";
        $question_list = $this->db->query($sql)->getResultArray();
        return view("community/questions", ['code_no' => $code_no, 'code_gubun' => $code_gubun, 'question_list' => $question_list]);
    }
    public function announcement()
    {
        $search_mode = updateSQ($_GET['search_mode']);
        $page = updateSQ($_GET['page']);
        $category = updateSQ($_GET['category']);
        $search_word = trim($_GET['search_word']);
        $search_word = trim($_GET['search_word']);
        $strSql = "";
        if ($search_word != "") {
            if ($search_mode != "") {
                $strSql = " and $search_mode like '%$search_word%' ";
            } else {
                if ($search_mode == "subject" || $search_mode == "contents") {
                    $strSql = $strSql . " and $search_mode like '%" . $search_word . "%'";
                }
            }
        }
        if (!$page) {
            $page = 1;
        }

        $scale = 10;

        $is_best_expect = $category == "best" ? " AND A.is_best = 'Y' " : "";

        $total_sql = "  select * from tbl_bbs_list  where code = 'b2b_notice' $strSql $is_best_expect and status = ''  ";
        $total_cnt = $this->db->query($total_sql)->getNumRows();

        $total_page = ceil($total_cnt / $scale);
        if ($page == "")
            $page = 1;
        $start = ($page - 1) * $scale;

        $sql = $total_sql . " order by notice_yn desc, r_date desc limit $start, $scale ";
        $b2b_notice_list = $this->db->query($sql)->getResultArray();
        $no = $total_cnt - $start;
        return view("community/announcement", ['b2b_notice_list' => $b2b_notice_list, 'total_page' => $total_page, 'page' => $page, 'no' => $no, 'search_mode' => $search_mode, 'search_word' => $search_word, 'category' => $category]);
    }
    public function announcement_view()
    {
        $bbs_idx = updateSQ($_GET['bbs_idx']);
        $announcement = $this->bbs->View($bbs_idx);
        return view("community/announcement_view", ['announcement' => $announcement]);
    }

    public function customer_center()
    {
        $category = updateSQ($this->request->getVar('category')) ?? "";
        $page = updateSQ($this->request->getVar('pg'));
        $sql_c = "select * from tbl_code where code_gubun = 'faq' and depth = '2' order by onum asc ";
        $code_gubun = $this->db->query($sql_c)->getResultArray();
        
        $builder = $this->bbs->ListFaq("faq", $category);

        $scale = 10;

        $total_cnt = $builder->countAllResults(false);

        $total_page = ceil($total_cnt / $scale);
        if ($page == ""){
            $page = 1;
        }
        $start = ($page - 1) * $scale;
        $num = $total_cnt - $start;

        $question_list = $builder->paginate($scale, 'default', $page);
        
        $data["code_gubun"] = $code_gubun;
        $data["question_list"] = $question_list;
        $data["total_cnt"] = $total_cnt;
        $data["total_page"] = $total_page;
        $data["category"] = $category;
        $data["pg"] = $page;
        $data["scale"] = $scale;
        $data["num"] = $num;

        return view("community/customer_center", $data);
    }

    public function customer_center_notify()
    {
        $bbs_idx = updateSQ($this->request->getVar('bbs_idx')) ?? "";
        $sql = " select * from tbl_bbs_list WHERE 1=1 and code='b2b_notice' and bbs_idx = '$bbs_idx' ";
        $view_notice = $this->db->query($sql)->getRowArray();
        $data["subject"] = $view_notice["subject"] ?? "";
        $data["contents"] = $view_notice["contents"] ?? "";
        $data["r_date"] = $view_notice["r_date"] ?? "";

        return view("community/notify", $data);
    }

    public function list_notify()
    {
        $page = updateSQ($this->request->getVar('pg'));

        $total_sql = " select * from tbl_bbs_list WHERE 1=1 and code='b2b_notice' ";

        $scale = 10;

        $total_cnt = $this->db->query($total_sql)->getNumRows();

        $total_page = ceil($total_cnt / $scale);
        if ($page == ""){
            $page = 1;
        }
        $start = ($page - 1) * $scale;
        $num = $total_cnt - $start;

        $sql = $total_sql . "order by notice_yn desc, r_date desc limit $start, $scale";

        $notice = $this->db->query($sql)->getResultArray();

        $data["notice"] = $notice;
        $data["total_cnt"] = $total_cnt;
        $data["total_page"] = $total_page;
        $data["pg"] = $page;
        $data["scale"] = $scale;
        $data["num"] = $num;

        return view("community/list_notify", $data);
    }

    public function notify_table()
    {
        return view("community/notify_table");
    }

    public function notify_table_ok() {
        $title = $this->request->getPost("title");
        $contents = $this->request->getPost("contents");
        $email = $this->request->getPost("email");
        $email_yn = $this->request->getPost("email_yn");
        $ipAddress = $this->request->getIPAddress();
        $r_date = $this->currentTime;
        try {  
            $this->db->transBegin();
            if(!empty($title) && !empty($contents) && !empty($email)){
                $uploadPath = $this->uploadPath;
                if(!is_dir($uploadPath)){
                    mkdir($uploadPath, 0755, true);
                }
    
                $file = $this->request->getFile('ufile1');
                
                $data = [
                    'title' => $title,
                    'contents' => $contents,
                    'user_email' => sqlSecretConver($email, 'encode'),
                    'email_yn' => $email_yn,
                    'user_ip' => $ipAddress,
                    'r_date' => $r_date,
                    'status' => 'W'
                ];

                $idx = $this->qna->insertQna($data);

                if($file->isValid() && !$file->hasMoved()){
                    $newName = $file->getRandomName();
                    $oldName = $file->getClientName();
                    if($newName){
                        $file->move($uploadPath, $newName);
                    }
                    $data_file = [
                        "ufile1" => $newName,
                        "rfile1" => $oldName
                    ];
                    $this->qna->updateQna($idx, $data_file);

                }

                if($idx) {
                    $this->db->transCommit();
                    $resultArr['result'] = true;
                    $resultArr['message'] = "성공적으로 등록되었습니다.";
                }else{
                    $this->db->transCommit();
                    $resultArr['result'] = false;
                    $resultArr['message'] = "새로 추가하지 못했습니다.";
                }
            }else{
                $resultArr['result'] = false;
                $resultArr['message'] = "누락된 데이터.";
            }
        } catch (Exception $err) {
            $this->db->transRollback();
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
        } finally {
            return $this->response->setJSON($resultArr);
        }
    }

    public function customer_speak()
    {
        return view("community/customer_speak");
    }

    public function customer_speak_ok() {
        $user_name = $this->request->getPost("user_name");
        $accuracy = $this->request->getPost("accuracy");
        $speed = $this->request->getPost("speed");
        $star = $this->request->getPost("star");
        $contents = $this->request->getPost("contents");
        $ipAddress = $this->request->getIPAddress();
        $r_date = $this->currentTime;
        try {  
            $this->db->transBegin();
            if(!empty($user_name) && !empty($accuracy) && !empty($speed) && !empty($star) && !empty($contents)){
                
                $data = [
                    'user_name' => sqlSecretConver($user_name, 'encode'),
                    'accuracy' => $accuracy,
                    'speed' => $speed,
                    'star' => $star,
                    'contents' => $contents,
                    'user_ip' => $ipAddress,
                    'r_date' => $r_date,
                    'status' => 'W'
                ];

                $idx = $this->contact->insertContact($data);

                if($idx) {
                    $this->db->transCommit();
                    $resultArr['result'] = true;
                    $resultArr['message'] = "성공적으로 등록되었습니다.";
                }else{
                    $this->db->transCommit();
                    $resultArr['result'] = false;
                    $resultArr['message'] = "새로 추가하지 못했습니다.";
                }
            }else{
                $resultArr['result'] = false;
                $resultArr['message'] = "누락된 데이터.";
            }
        } catch (Exception $err) {
            $this->db->transRollback();
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
        } finally {
            return $this->response->setJSON($resultArr);
        }
    }
}