<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SessionChk;
use Exception;

class AlarmController extends BaseController
{
    
    private $db;

    public function __construct()
    {
        $this->code = model("Code");
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
        if ($s_txt and ($search_category == "user_name" )) {
            $strSql .= " AND REPLACE(
                CONVERT(
                    AES_DECRYPT(
                        UNHEX(FROM_BASE64(m.user_name)),
                        '{$private_key}'
                    ) USING UTF8
                ), '-', ''
            ) LIKE '%" . str_replace("-", "", $s_txt) . "%' ";
        }
        if ($s_txt and ($search_category == "contents")) {
            $strSql = $strSql . " and $search_category like '%" . str_replace("-", "", $s_txt) . "%' ";
        }

        if (!$page) {
            $page = 1;
        }

        $scale = !empty($_GET["scale"]) ? intval($_GET["scale"]) : 10;

        $total_sql = " select a.*, m.user_id from tbl_alarm a JOIN tbl_member m ON a.m_idx = m.m_idx  where 1=1 $strSql ";
        $total_cnt = $this->db->query($total_sql)->getNumRows();

        $total_page = ceil($total_cnt / $scale);
        if ($page == "")
            $page = 1;
        $start = ($page - 1) * $scale;

        $sql    = $total_sql . " order by r_date desc, idx desc limit $start, $scale ";

        $result = $this->db->query($sql)->getResultArray();

        $num = $total_cnt - $start;
        return view("admin/_alarm/list", [
            'list' => $result,
            'num' => $num,
            'pg' => $page,
            'nPage' => $total_page,
            'scale' => $scale,
            'search_category' => $search_category,
            's_txt' => $s_txt,
            'deviceType' => $deviceType,
            'total_cnt' => $total_cnt,
            'currentUri' => $currentUri
        ]);
    }

    public function write() {
        $idx			= updateSQ($this->request->getVar('idx'));
        $data = [];
        if ($idx) {
            $sql = "select * tbl_alarm where idx = '". $idx ."'";
            $data			= $this->db->query($sql)->getRowArray();
        }

        $sql_m = "SELECT m_idx, user_id FROM tbl_member";
        $member_list = $this->db->query($sql)->getResultArray();
        $data['member_list'] =  $member_list;
        return view('admin/_alarm/write', $data);
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
        $accuracy				= updateSQ($this->request->getPost('accuracy'));
        $speed					= updateSQ($this->request->getPost('speed'));
        $star					= updateSQ($this->request->getPost('star'));
        $file                   = $this->request->getFile("ufile1");
        
        $ufile1 = "";
        $rfile1 = "";

        $uploadPath = $this->uploadPath;

        if ($this->request->getPost("del_1") == "Y")
        {
            $sql = "
                UPDATE tbl_travel_contact SET
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

                    $sql = "
                        UPDATE tbl_travel_contact SET
                        ufile1='".$ufile1."',
                        rfile1='".$rfile1."'
                        WHERE idx='$idx';
                    ";
                    $this->db->query($sql);
                }
            }

        }
        
        $sql = "
                    update tbl_travel_contact SET 
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
                    ,accuracy        	    = '$accuracy'
                    ,speed        	    	= '$speed'
                    ,star        	    	= '$star'
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
                    $sql		= " select * from tbl_travel_contact where idx='".$idx."'";
                    $row		= $this->db->query($sql)->getRowArray();
                    if($row["ufile1"]){
                        $filePath = $uploadPath . $row["ufile1"];
                        if(file_exists($filePath)){
                            unlink($filePath);
                        }
                    }
                    $sql_del = " delete from tbl_travel_contact where idx='".$idx."'";
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
