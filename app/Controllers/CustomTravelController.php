<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class CustomTravelController extends BaseController
{
    private $policy;
    protected $sessionLib;
    protected $sessionChk;
    public function __construct()
    {
        $this->policy = model("PolicyModel");
        helper(['html']);
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
        helper('comment_helper');
    }
    public function item_write()
    {
        return view("custom_travel/item_write");
    }
    public function inquiry_ok()
    {
        return "OK";
    }
}