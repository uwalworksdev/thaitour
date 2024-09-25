<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminMemberController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function pre_viw_mail()
    {
        $idx = updateSQ($_GET["idx"] ?? '');

        $total_sql = " select *
	                 from tbl_auto_mail_skin
					where idx = '" . $idx . "'  ";
        $result = $this->connect->query($total_sql);
        $row = $result->getRowArray();

        return viewSQ($row["content"]);
    }
}
