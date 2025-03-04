<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SessionChk;
use Exception;

class QnaController extends BaseController
{
    private $qna;
    private $code;
    private $db;

    protected $sessionLib;
    protected $sessionChk;
    private $uploadPath = ROOTPATH."public/uploads/qna/";


    public function __construct()
    {
        $this->code = model("Code");
        $this->qna = model("Qna");
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
        $page = $this->request->getVar('pg');
        $search_category = $this->request->getVar('search_category');
        $s_txt = $this->request->getVar('s_txt');
        $strSql = "";
        if ($s_txt and ($search_category == "user_name" || $search_category == "user_phone" || $search_category == "user_email")) {
            $strSql = $strSql . " and replace(CONVERT( AES_DECRYPT( UNHEX( FROM_BASE64(" . $search_category . ") ), '" . $private_key . "') using UTF8),'-','') like '%" . str_replace("-", "", $s_txt) . "%' ";
        }
        if ($s_txt and ($search_category == "title")) {
            $strSql = $strSql . " and $search_category like '%" . str_replace("-", "", $s_txt) . "%' ";
        }

        if (!$page) {
            $page = 1;
        }

        // $scale = 10;
        $scale = !empty($_GET["scale"]) ? intval($_GET["scale"]) : 10;

        $total_sql = " select * from tbl_travel_qna where 1=1 $strSql ";
        $total_cnt = $this->db->query($total_sql)->getNumRows();

        $total_page = ceil($total_cnt / $scale);
        if ($page == "")
            $page = 1;
        $start = ($page - 1) * $scale;

        $total_sqls = "  SELECT A.*, COUNT(B.r_idx) AS cmt_cnt
                                FROM tbl_travel_qna A
                                LEFT JOIN tbl_bbs_cmt B ON A.idx = B.r_idx AND B.r_code = 'qna' AND B.r_status = 'Y' AND B.r_delYN = 'N'
                                WHERE 1=1 $strSql
                                GROUP BY A.idx ";

        $sql    = $total_sqls . " order by idx desc limit $start, $scale ";

        $result = $this->db->query($sql)->getResultArray();
        $num = $total_cnt - $start;
        return view("admin/_qna/list", [
            'list_qna' => $result,
            'num' => $num,
            'pg' => $page,
            'nPage' => $total_page,
            'scale' => $scale,
            'search_category' => $search_category,
            'search_gubun' => '',
            's_txt' => $s_txt,
            'deviceType' => $deviceType,
            'total_cnt' => $total_cnt,
            'currentUri' => $currentUri
        ]);
    }

    public function write() {
        $search_mode	= updateSQ($this->request->getVar('search_mode'));
        $search_word	= updateSQ($this->request->getVar('search_word'));
        $scode			= updateSQ($this->request->getVar('scode'));
        $pg				= updateSQ($this->request->getVar('pg'));
        $idx			= updateSQ($this->request->getVar('idx'));
        if ($idx) {

            $updateViewSql = "update tbl_travel_qna set isViewQna = 'Y' where idx = '". $idx ."'";
            $this->db->query($updateViewSql);

            $total_sql		= " select a.* from tbl_travel_qna a where a.idx='".$idx."'";
            $row			= $this->db->query($total_sql)->getRowArray();

            $user_name			= sqlSecretConver($row["user_name"], 'decode');
            $user_phone			= sqlSecretConver($row["user_phone"], 'decode');
            $user_email			= sqlSecretConver($row["user_email"], 'decode');

            $travel_type_1     	= $row["travel_type_1"];
            $travel_type_2     	= $row["travel_type_2"];
            $travel_type_3     	= $row["travel_type_3"];
            $departure_date		= $row["departure_date"];	
            $arrival_date		= $row["arrival_date"];	
            $status				= $row["status"];	
            $ufile1				= $row["ufile1"];	
            $rfile1				= $row["rfile1"];	
            $r_date				= $row["r_date"];	
            
            $consultation_time	= $row['consultation_time'];
            $product_name       = $row['product_name'];
            $title 	            = $row['title'];
            $contents	        = $row["contents"];	 
            $email_yn	        = $row["email_yn"];	 
        }

        $sql0 = "SELECT * FROM tbl_code WHERE parent_code_no = 13 AND depth = '2' order by onum";
		$row0 = $this->db->query($sql0)->getResultArray();

        $sql1 = "SELECT * FROM tbl_code WHERE parent_code_no = '$travel_type_1' AND depth = '3' ";
		$row1 = $this->db->query($sql1)->getResultArray();

        $sql2 = "SELECT * FROM tbl_code WHERE parent_code_no = '$travel_type_2' AND depth = '4' ";
        $row2 = $this->db->query($sql2)->getResultArray();

        $data["arr_type_0"] = $row0;
        $data["arr_type_1"] = $row1;
        $data["arr_type_2"] = $row2;

        $data["search_mode"] = $search_mode ?? "";
        $data["search_word"] = $search_word ?? "";
        $data["scode"] = $scode ?? "";
        $data["pg"] = $pg ?? "";
        $data["idx"] = $idx ?? "";
        $data["user_name"] = $user_name ?? "";
        $data["user_phone"] = $user_phone ?? "";
        $data["user_email"] = $user_email ?? "";
        $data["travel_type_1"] = $travel_type_1 ?? "";
        $data["travel_type_2"] = $travel_type_2 ?? "";
        $data["travel_type_3"] = $travel_type_3 ?? "";
        $data["departure_date"] = $departure_date ?? "";
        $data["arrival_date"] = $arrival_date ?? "";
        $data["status"] = $status ?? "";
        $data["ufile1"] = $ufile1 ?? "";
        $data["rfile1"] = $rfile1 ?? "";
        $data["r_date"] = $r_date ?? "";
        $data["consultation_time"] = $consultation_time ?? "";
        $data["product_name"] = $product_name ?? "";
        $data["title"] = $title ?? "";
        $data["contents"] = $contents ?? "";
        $data["email_yn"] = $email_yn ?? "";

        return view('admin/_qna/write', $data);
    }

    public function write_ok() {
        $idx    			    = updateSQ($this->request->getPost('idx'));
        $user_name    			= updateSQ($this->request->getPost('user_name'));
        $user_phone       		= updateSQ($this->request->getPost('user_phone'));
        $user_email       		= updateSQ($this->request->getPost('user_email'));
        $departure_date   		= updateSQ($this->request->getPost('departure_date'));
        $arrival_date     		= updateSQ($this->request->getPost('arrival_date'));
        $travel_type_1   	  	= updateSQ($this->request->getPost('travel_type_1'));
        $travel_type_2   	  	= updateSQ($this->request->getPost('travel_type_2'));
        $travel_type_3   	  	= updateSQ($this->request->getPost('travel_type_3'));
        $consultation_time      = updateSQ($this->request->getPost('consultation_time'));
        $product_name       	= updateSQ($this->request->getPost('product_name'));
        $title  				= updateSQ($this->request->getPost('title'));
        $contents  				= updateSQ($this->request->getPost('contents'));
        $status					= updateSQ($this->request->getPost('status'));
        $email_yn					= updateSQ($this->request->getPost('email_yn'));
        $file                   = $this->request->getFile("ufile1");
        
        $ufile1 = "";
        $rfile1 = "";

        $uploadPath = $this->uploadPath;

        if ($this->request->getPost("del_1") == "Y")
        {
            $sql = "
                UPDATE tbl_travel_qna SET
                ufile1='',
                rfile1=''
                WHERE idx='$idx'
            ";
            $this->db->query($sql);
        } elseif($file)
        {
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getClientName();
                $rfile1 = $fileName;
                if (no_file_ext($fileName) == "Y") {
                    $microtime = microtime(true);
                    $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                    $date = date('YmdHis');
                    $ext = explode(".", strtolower($fileName));
                    $newName = $date . $timestamp . '.' . $ext[1];
                    $ufile1 = $newName;

                    $file->move($uploadPath, $newName);
                }
            }

            if ($idx) {
                $sql = "
                    UPDATE tbl_travel_qna SET
                    ufile1='".$ufile1."',
                    rfile1='".$rfile1."'
                    WHERE idx='$idx';
                ";
                $this->db->query($sql);
            }
        }
        
        $sql = "
                    update tbl_travel_qna SET 
                    user_name    		    = '" . sqlSecretConver($user_name, 'encode') . "'
                    ,user_phone       		= '" . sqlSecretConver($user_phone, 'encode') . "'
                    ,user_email       		= '" . sqlSecretConver($user_email, 'encode') . "'
                    ,departure_date   		= '$departure_date'
                    ,arrival_date     		= '$arrival_date'
                    ,travel_type_1   		= '$travel_type_1'
                    ,travel_type_2   		= '$travel_type_2'
                    ,travel_type_3   		= '$travel_type_3'
                    ,consultation_time      = '$consultation_time'
                    ,product_name        	= '$product_name'
                    ,title        	        = '$title'
                    ,contents        	    = '$contents'
                    ,status        	    	= '$status'
                    ,email_yn        	    = '$email_yn'
                    ,m_date	    	  		= now()
                    where idx		 	 	= '".$idx."'
                ";
        $this->db->query($sql);

    }
    public function delete() {
        $arr_idx = $this->request->getPost('idx');
        try {
            if(is_array($arr_idx)){
                $this->db->transBegin();
                $uploadPath = $this->uploadPath;

                foreach ($arr_idx as $idx) {
                    $sql		= " select * from tbl_travel_qna where idx='".$idx."'";
                    $row		= $this->db->query($sql)->getRowArray();
                    if($row["ufile1"]){
                        $filePath = $uploadPath . $row["ufile1"];
                        if(file_exists($filePath)){
                            unlink($filePath);
                        }
                    }
                    $sql_del = " delete from tbl_travel_qna where idx='".$idx."'";
                    $this->db->query($sql_del);
                }

                $this->db->transCommit();
                $resultArr['result'] = true;
                $resultArr['message'] = "정상적으로 삭제되었습니다.";
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
