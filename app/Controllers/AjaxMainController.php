<?php

namespace App\Controllers;

class AjaxMainController extends BaseController {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function get_best() 
	{
        $list  = $this->request->getPost('list');
        $code  = $this->request->getPost('code');
        $db    = \Config\Database::connect();
/*
        $sql = "SELECT * FROM tbl_code WHERE parent_code_no = '$code' AND depth = '$depth' order by onum desc";
        $cnt = $db->query($sql)->getNumRows();

        $rows = $db->query($sql)->getResultArray();
        $data = "";
        $data .= "<option value=''>선택</option>";
        foreach ($rows as $row) {
            $data .= "<option value='$row[code_no]'>$row[code_name]</option>";
        }

        $output = [
            "data"  => $data,
            "cnt"   => $cnt
        ];
*/
        $msg = $list ." - ". $code ."작업완료";
        $output = [
            "message"  => $msg
        ];

        return $this->response->setJSON($output);
    }
}