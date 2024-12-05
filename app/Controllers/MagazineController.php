<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class MagazineController extends BaseController
{
    protected $connect;
    protected $bbsModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->bbsModel = new \App\Models\Bbs();
    }

    public function list()
    {

        $search_mode = $this->request->getVar('search_mode');
        $search_word = $this->request->getVar('search_word');

        try {
            $data = [];

            $data['search_mode'] = $search_mode;
            $data['search_word'] = $search_word;

            $magazines = $this->bbsModel->List("magazines", [
                'search_word' => $search_word,
                'search_mode' => $search_mode
            ]);

            $data['nTotalCount'] = $magazines->countAllResults(false);

            $data['magazines'] = $magazines->paginate(10);

            $data['pager'] = $this->bbsModel->pager->makeLinks(1, 10, $data['nTotalCount'], "custom1");

            return $this->renderView('magazines/list', $data);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function detail()
    {
        try {
            $m_idx = $this->request->getVar('m_idx');
            $data = [];
            $data['magazine'] = $this->bbsModel->View($m_idx);
            return $this->renderView('magazines/detail', $data);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }
}
