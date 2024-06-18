<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Exception;

class Tools extends BaseController
{
    protected $Code;
    protected $sessionLib;
    protected $sessionChk;
    public function __construct()
    {
        helper(['html']);
        $this->Code = model("Code");
        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
        helper('my_helper');
    }
    public function generate_captcha()
    {
        header('Content-Type: application/json');
        $captcha_info = createAndUpdateCaptcha();
        return json_encode($captcha_info);
    }
    public function get_travel_types()
    {
        $code = $_POST['code'];
        $depth = $_POST['depth'];
        $result = $this->Code->getByParentAndDepth($code, $depth);
        $cnt = $result->getNumRows();
        $data = "";
        $data .= "<option value=''>선택</option>";
        foreach ($result->getResultArray() as $row) {
            $data .= "<option value='$row[code_no]'>$row[code_name]</option>";
        }
        return json_encode([
            "data"  => $data,
            "cnt"   => $cnt
        ]);
    }
}