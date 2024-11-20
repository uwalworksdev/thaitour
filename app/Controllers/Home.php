<?php

namespace App\Controllers;

use Config\CustomConstants as ConfigCustomConstants;

class Home extends BaseController
{
    private $CodeModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->CodeModel = model("Code");
        helper('my_helper');
        $constants = new ConfigCustomConstants();
    }

    public function index(): string
    {
        $codes = $this->CodeModel->getByParentCode('50')->getResultArray();
        $codeBanners = $this->CodeModel->getByParentCode('51')->getResultArray();

        $data = [
            'codes' => $codes,
            'codeBanners' => $codeBanners,
        ];

        return $this->renderView('main/main', $data);
    }
}
