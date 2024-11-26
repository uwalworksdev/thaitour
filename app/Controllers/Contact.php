<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class Contact extends BaseController
{
    private $comment;

    protected $sessionLib;
    protected $sessionChk;
    public function __construct()
    {
        $this->bbs = model("Bbs");
        helper(['html']);
        $this->db = db_connect();
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('comment_helper');
    }
    public function main()
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
        $s_code  =  '116';  
        $sql_s     = "select * from tbl_bbs_list where code = 'banner' and category = '$s_code' ";
        $visual     = $this->db->query($sql_s)->getRowArray();
        $scale = 10;
    

        $total_sql = " SELECT A.*, COUNT(B.r_idx) AS cmt_cnt
                        FROM tbl_travel_contact A
                        LEFT JOIN tbl_bbs_cmt B ON A.idx = B.r_idx AND B.r_code = 'contact' AND B.r_status = 'Y' AND B.r_delYN = 'N'
                        WHERE 1=1 $strSql 
                        GROUP BY A.idx
                        ";
        $total_cnt = $this->db->query($total_sql)->getNumRows();

        $total_page = ceil($total_cnt / $scale);
        if ($page == "") $page = 1;
        $start = ($page - 1) * $scale;

        $sql    = $total_sql . " order by A.r_date desc,  A.idx desc limit $start, $scale ";
        $result = $this->db->query($sql)->getResultArray();
        $no=$total_cnt - $start;
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

    // public function write() {
    //     $private_key = private_key();

    //     $sql_m = "SELECT birthday
    //                 , AES_DECRYPT(UNHEX(user_name),   '$private_key') AS user_name
    //                 , AES_DECRYPT(UNHEX(user_mobile), '$private_key') AS user_mobile
    //                 , AES_DECRYPT(UNHEX(user_email),  '$private_key') AS user_email
    //                 , AES_DECRYPT(UNHEX(zip),         '$private_key') AS zip
    //                 , AES_DECRYPT(UNHEX(addr1),       '$private_key') AS addr1
    //                 , AES_DECRYPT(UNHEX(addr2),       '$private_key') AS addr2
    //       FROM tbl_member 
    //       WHERE m_Idx = '$member_Id' 
    //     ";
    //     $row_m = $this->db->query($sql_m)->getRowArray();

    //     $email  = explode("@", $row_m['user_email']);
    //     $idx = $_GET['idx'];
    //     $product_idx = updateSQ($_GET["product_idx"]);

    //     if(isset($idx)) {

    //         $sql = "select * from tbl_travel_contact where idx = '$idx'";
    //         $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    //         $row = mysqli_fetch_array($result);
    //         $user_email = sqlSecretConver($row["user_email"], 'decode');
    //         $travel_type_1     	= $row["travel_type_1"];
    //         $travel_type_2     	= $row["travel_type_2"];
    //         $travel_type_3     	= $row["travel_type_3"];
    //         $departure_date		= $row["departure_date"];	
    //         $arrival_date		= $row["arrival_date"];	
    //         $status				= $row["status"];	
    //         $ufile1				= $row["ufile1"];	
    //         $rfile1				= $row["rfile1"];	
    //         $r_date				= $row["r_date"];	
            
    //         $consultation_time		= $row['consultation_time'];
    //         $product_name = $row['product_name'];
    //         $title 	= $row['title'];
    //         $contents	= $row["contents"];	
    //     }

    //     if ($product_idx) {

    //         $sql_r		= " select  a.product_idx,
    //                                 a.product_name, 
    //                                 b.code_no as travel_type, 
    //                                 c.code_no as travel_type_2, 
    //                                 d.code_no as travel_type_3, 
    //                                 b.code_name as travel_type_name, 
    //                                 c.code_name as travel_type_name_2, 
    //                                 d.code_name as travel_type_name_3
    //                         from tbl_product_mst a
    //                         left join tbl_code b on a.product_code_1 = b.code_no
    //                         left join tbl_code c on a.product_code_2 = c.code_no
    //                         left join tbl_code d on a.product_code_3 = d.code_no
    //                         where a.product_idx = '{$product_idx}' 
    //         ";

    //         $result_r			= mysqli_query($connect, $sql_r) or die (mysqli_error($connect));
    //         $row_r			    = mysqli_fetch_array($result_r);
    //         $travel_type        = $row_r["travel_type"];
    //         $travel_type_2      = $row_r["travel_type_2"];
    //         $travel_type_3      = $row_r["travel_type_3"];
    //         $travel_type_name   = $row_r['travel_type_name'];
    //         $travel_type_name_2 = $row_r['travel_type_name_2'];
    //         $travel_type_name_3 = $row_r['travel_type_name_3'];
    //         $product_name       = $row_r['product_name'];
    //     }
    // }
}