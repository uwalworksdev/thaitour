<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function store_config_admin()
    {
        $search_name = $_GET['search_name'] ?? '';
        $search_category = $_GET['search_category'] ?? '';
        $s_status = $_GET['s_status'] ?? '';
        $private_key = private_key();
        $pg = $_GET['pg'] ?? '';
        $strSql = '';

        $g_list_rows = 20;
        if ($search_name) {
            $strSql = $strSql . " and CONVERT(AES_DECRYPT(UNHEX($search_category),'$private_key') USING utf8)  LIKE '%$search_name%' ";

        }

        $total_sql = " select *	from tbl_member where user_level = '2' AND status = 'Y' $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by m_idx desc limit $nFrom, $g_list_rows ";

        $result = $this->connect->query($sql);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();
        $data = [
            'result' => $result,
            'num' => $num,
            'search_name' => $search_name,
            'nFrom' => $nFrom,
            'pg' => $pg,
            'nPage' => $nPage,
            'nTotalCount' => $nTotalCount,
            'search_category' => $search_category,
            'private_key' => $private_key,
            'g_list_rows' => $g_list_rows,
            's_status' => $s_status,
        ];
        return view('admin/_home/store_config_admin', $data);
    }

    public function write()
    {
        $private_key = private_key();
        $m_idx = $_GET['m_idx'] ?? '';
        $code = $_GET['code'] ?? '';
        $scategory = $_GET['scategory'] ?? '';
        $_Adm_grant_top_name = [];

        if ($m_idx) {
            $sql = "select * from tbl_member where m_idx = '{$m_idx}' ";
            $result = $this->connect->query($sql);
            $row = $result->getRowArray();

            if ($row["encode"] == "Y") {
                $row_d = $this->getData($row, $private_key);

                $row["user_name"] = $row_d['user_name'];
                $row["user_email"] = $row_d['user_email'];
                $row["user_phone"] = $row_d['user_phone'];
                $row["user_mobile"] = $row_d['user_mobile'];
                $row["zip"] = $row_d['zip'];
                $row["addr1"] = $row_d['addr1'];
                $row["addr2"] = $row_d['addr2'];
                $ufile1 = $row["ufile1"];
                $rfile1 = $row["rfile1"];
            }

        }

        $data = [
            'row' => $row ?? null,
            'private_key' => $private_key,
            'm_idx' => $m_idx,
            'ufile1' => $ufile1 ?? '',
            'rfile1' => $rfile1 ?? '',
            'code' => $code,
            '_Adm_grant_top_name' => $_Adm_grant_top_name,
            'scategory' => $scategory
        ];

        return view('admin/_home/write', $data);
    }

    public function search_word()
    {
        $private_key = private_key();
        $g_list_rows = 100;
        $ca_idx = $_GET['ca_idx'] ?? '';
        $search_category = $_GET['search_category'] ?? '';
        $search_name = $_GET['search_name'] ?? '';
        $pg = $_GET['pg'] ?? '';

        $total_sql = " select *	from tbl_search where 1=1 ";
        $result = $this->connect->query($total_sql);
        $row = $result->getRowArray();
        $nTotalCount = $result->getNumRows();
        $tbc_idx = $row['tbc_idx'];

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by onum desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;

        $data = [
            'nTotalCount' => $nTotalCount,
            'tbc_idx' => $tbc_idx,
            'private_key' => $private_key,
            'g_list_rows' => $g_list_rows,
            'row' => $row,
            'num' => $num,
            'pg' => $pg,
            'nPage' => $nPage,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'ca_idx' => $ca_idx,
            'result' => $result
        ];

        return view('admin/_home/search_word', $data);
    }


    public function search_list()
    {
        $g_list_rows = 100;
        $ca_idx = $_GET['ca_idx'] ?? '';
        $search_category = $_GET['search_category'] ?? '';
        $search_name = $_GET['search_name'] ?? '';
        $pg = $_GET['pg'] ?? '';

        $total_sql = " select *	from tbl_search where 1=1 ";
        $result = $this->connect->query($total_sql);
        $row = $result->getRowArray();
        $nTotalCount = $result->getNumRows();
        $tbc_idx = $row['tbc_idx'];

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by onum desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;

        $data = [
            'nTotalCount' => $nTotalCount,
            'tbc_idx' => $tbc_idx,
            'private_key' => $private_key,
            'g_list_rows' => $g_list_rows,
            'row' => $row,
            'num' => $num,
            'pg' => $pg,
            'nPage' => $nPage,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'ca_idx' => $ca_idx,
            'result' => $result
        ];

        return view('admin/_home/search_word', $data);
    }

    public function search_write()
    {
        $tbc_idx = updateSQ($_GET["tbc_idx"] ?? '');
        if ($tbc_idx) {
            $total_sql = " select * from tbl_search where tbc_idx='" . $tbc_idx . "'";
            $result = $this->connect->query($total_sql);
            $row = $result->getRowArray();
            $subject = $row["subject"];
            $onum = $row["onum"];
            $status = $row["status"];
            $url = $row["url"];
        }

        $data = [
            'tbc_idx' => $tbc_idx,
            'row' => $row ?? null,
            'depth' => $depth ?? '',
            'subject' => $subject ?? '',
            'onum' => $onum ?? '',
            'status' => $status ?? '',
            'url' => $url ?? ''
        ];
        return view('admin/_home/search_write', $data);
    }

    public function block_ip_list()
    {
        $g_list_rows = 20;

        $strSql = "";

        if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET["ip"])) {
            $strSql = " and ip = '" . $_GET["ip"] . "' ";
        }

        $total_sql = " select * from tbl_block_ip where 1 = 1 $strSql ";

        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $pg = $_GET['pg'] ?? '';
        $s_status = $_GET['s_status'] ?? '';
        $search_category = $_GET['search_category'] ?? '';
        $search_name = $_GET['search_name'] ?? '';

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by m_idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;

        $data = [
            'nTotalCount' => $nTotalCount,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
            'pg' => $pg,
            'nPage' => $nPage,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_status' => $s_status,
            'result' => $result
        ];

        return view('admin/_home/block_ip_list', $data);
    }

    public function getData($private_key)
    {
        $sql_d = "SELECT   AES_DECRYPT(UNHEX('{$row['user_name']}'),    '$private_key') AS user_name 
														   , AES_DECRYPT(UNHEX('{$row['user_email']}'),   '$private_key') AS user_email 
														   , AES_DECRYPT(UNHEX('{$row['user_mobile']}'),  '$private_key') AS user_mobile 
														   , AES_DECRYPT(UNHEX('{$row['user_phone']}'),   '$private_key') AS user_phone 
														   , AES_DECRYPT(UNHEX('{$row['zip']}'),          '$private_key') AS zip
														   , AES_DECRYPT(UNHEX('{$row['addr1']}'),        '$private_key') AS addr1
														   , AES_DECRYPT(UNHEX('{$row['addr2']}'),        '$private_key') AS addr2 ";
        $result_d = $this->connect->query($sql_d);
        $row_d = $result_d->getRowArray();
        return $row_d;
    }

	public function fnAddIp_insert()
    {
        $db    = \Config\Database::connect();

        try {
            $blockip = $_GET["ip"];

            if (empty($blockip)) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'No code_idx provided'
                    ]);
            }

            $sql = "insert into tbl_block_ip(ip) values (?) on duplicate key update cnt = cnt + 1";
			$result = $this->connect->query($sql);

            if (isset($result) && $result) {
                $msg = "아이피 등록완료";
            } else {
                $msg = "아이피 등록오류";
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }
}
