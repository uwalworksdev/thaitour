<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminController extends BaseController
{
    protected $connect;
    private $memberModel;
    private $memberAdminratorModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->memberModel = new \App\Models\Member();
        $this->memberAdminratorModel = new \App\Models\MemberAdminratorModel();
        helper('my_helper');
        helper('alert_helper');
    }

    public function store_config_admin()
    {
        $search_name = $_GET['search_name'] ?? '';
        $search_category = $_GET['search_category'] ?? '';
        $pg = $_GET['pg'] ?? '';

        $g_list_rows = 20;

        $result = $this->memberModel->getMembersPaging([
            'search_name' => $search_name,
            'search_category' => $search_category,
            'user_level' => 2
        ],$pg, $g_list_rows);

        return view('admin/_home/store_config_admin', $result);
    }

    public function write()
    {
        $m_idx = $_GET['m_idx'] ?? '';
        $adminMenus = new \Config\AdminMenus();

        $data = $this->memberModel->getByIdx($m_idx) ?? [];

        $data['adminMenus'] = $adminMenus->menus;

        return view('admin/_home/write', $data);
    }

    public function write_admin_ok()
    {
        $data = $this->request->getPost();

        $ufile1 = $this->request->getFile('ufile1');

        if ($ufile1->isValid()) {

            $newName = $ufile1->getRandomName();

            $ufile1->move('./data/member', $newName);

            $data['ufile1'] = $newName;
            $data['rfile1'] = $ufile1->getClientName();
        }


        $data['auth'] = implode(',', $data['auth'] ?? []);

        if($data['m_idx']) {
            $data['m_date'] = date('Y-m-d H:i:s');
        } else {
            $data['r_date'] = date('Y-m-d H:i:s');
            $data['user_ip'] = $_SERVER['REMOTE_ADDR'];
            $data['encode'] = "Y";
            $data['user_level'] = "2";
        }

        if (!empty($data['user_pw'])) {
            $data['user_pw'] = password_hash($data['user_pw'], PASSWORD_BCRYPT);
        }

        $data['user_name'] = encryptField($data['user_name'], "encode");
        $data['user_email'] = encryptField($data['user_email'], "encode");
        $data['user_mobile'] = encryptField($data['user_mobile'] ?? "", "encode");
        $data['user_phone'] = encryptField($data['user_phone'] ?? "", "encode");

        if($data['m_idx']) {
            $m_idx = $data['m_idx'];
            unset($data['m_idx']);
            $this->memberModel->update($m_idx, $data);
            $this->memberAdminratorModel->where('user_m_idx', $m_idx)->set($data)->update();
            return redirect()->to('/AdmMaster/_adminrator/write?m_idx=' . $m_idx)->with('success', '수정되었습니다.');
        } else {
            unset($data['m_idx']);
            $m_idx = $this->memberModel->insert($data);
            $data['user_m_idx'] = $m_idx;
            $this->memberAdminratorModel->insert($data);
            return redirect()->to('/AdmMaster/_adminrator/store_config_admin')->with('success', '등록되었습니다.');
        }

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

        $sql = $total_sql . " order by onum asc limit $nFrom, $g_list_rows ";
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

        $sql = $total_sql . " order by onum asc limit $nFrom, $g_list_rows ";
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

    public function del()
    {
        $m_idx = $this->request->getPost('m_idx');
        $this->memberModel->delete($m_idx);
        return $this->response->setBody("OK");
    }

}
