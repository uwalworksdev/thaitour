<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminMagazineController extends BaseController
{
    protected $connect;
    protected $magazineModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->magazineModel = model("Magazines.php");
    }

    public function list()
    {
        return view('admin/magazines/list');
    }

    public function write()
    {
        return view('admin/magazines/list');
    }
}
