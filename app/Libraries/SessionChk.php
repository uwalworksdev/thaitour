<?php

namespace App\Libraries;

class SessionChk
{
    public function infoChk()
    {
        if (session('member_id') == "admin") {
            return "Y";
        }else{
            return "N";
        }
    }
}