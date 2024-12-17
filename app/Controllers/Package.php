<?php

namespace App\Controllers;
use Exception;

class Package extends BaseController
{

    private $db;
    private $Setting;
    private $uploadPath = ROOTPATH."public/uploads/setting/";
    /**
     * 고정된 식별번호 IDX
     */
    private $fixIdx = 1;

    public function __construct()
    {
        helper(["html", "alert"]);
        $this->db = db_connect();
        $this->Setting = model("Setting");
    }
    public function Main(): string
    {
        return view('package/main');
    }
}
