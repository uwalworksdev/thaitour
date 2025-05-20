<?php

namespace App\Controllers;

use App\Libraries\SessionChk;

class CustomerCenterController extends BaseController
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

    public function insurance()
    {
        return view("center/insurance");
    }

    public function tourterms()
    {
        return view("center/tourterms");
    }

    public function map()
    {
        return view("center/map");
    }

     public function about()
    {
        return view("center/about");
    }

    public function terms()
    {
        $policy = $this->policy->getByIdx("5");
        return view("center/terms", ['policy' => $policy]);
    }

    public function safetyTip()
    {
        $policy = $this->policy->getByIdx('31');
        return view("center/safety_tip" , ["policy"=> $policy]);
    }
    public function privacy()
    {
        $policy = $this->policy->getByCode("privacy");
        return view("center/privacy", ["policy" => $policy]);
    }

    public function reservation()
    {
        $policy = $this->policy->getByIdx("38");
        return view("center/reservation", ["policy" => $policy]);
    }
}