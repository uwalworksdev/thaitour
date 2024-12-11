<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;

class TimeSaleController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
    }

    public function list()
    {
        return $this->renderView('time_sale/list');
    }
}
