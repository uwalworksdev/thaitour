<?php

namespace App\Controllers;

use Config\CustomConstants as ConfigCustomConstants;

class Home extends BaseController
{
    private $CodeModel;
    private $cmsModel;
    protected $bbsModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->CodeModel = model("Code");
        $this->cmsModel = model("CmsModel");
        helper('my_helper');
        $this->bbsModel = new \App\Models\Bbs();
        $constants = new ConfigCustomConstants();
    }

    public function index(): string
    {
        $codes = $this->CodeModel->getByParentCode('50')->getResultArray();
        $codeBanners = $this->CodeModel->getByParentCode('51')->getResultArray();

        $magazines = $this->bbsModel->List("magazines", [])->limit(5)->get()->getResultArray();

        $data = [
            'codes' => $codes,
            'codeBanners' => $codeBanners,
            'popups' => $this->cmsModel->getPaging(['r_code' => 'popup', 'sch_status' => 'Y'], 5, 1)['items'],
        ];

        $data['magazines'] = $magazines;

        return $this->renderView('main/main', $data);
    }
}
