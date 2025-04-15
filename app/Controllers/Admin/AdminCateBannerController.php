<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminCateBannerController extends BaseController
{
    protected $connect;
    protected $cateBannerModel;
    protected $codeModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->cateBannerModel = model("Banner_model");
        $this->codeModel = model("Code");
        helper('my_helper');
        helper('alert_helper');
    }

    public function list()
    {
        $pg = $this->request->getGet('pg') ?? 1;
        $g_list_rows = 10;
        $s_parent_code_no = updateSQ($_GET["s_parent_code_no"] ?? '');
        $code_no = updateSQ($_GET["code_no"] ?? '');

        if(($code_no == 59 || $code_no == 1324) && empty($s_parent_code_no)) {
            $result = $this->cateBannerModel->getList([
                's_parent_code_no' => $code_no
            ], $g_list_rows, $pg);
        }else{
            $result = $this->cateBannerModel->getList([
                'code_no' => $code_no,
                's_parent_code_no' => $s_parent_code_no
            ], $g_list_rows, $pg);
        }

        $data = [
            'items' => $result['items'],
            'num' => $result['num'],
            'pg' => $pg,
            'nTotalCount' => $result['nTotalCount'],
            'nPage' => $result['nPage'],
            's_parent_code_no' => $s_parent_code_no,
            'code_no' => $code_no,
            'g_list_rows' => $g_list_rows,
            'ca_idx' => $ca_idx ?? '',
            'search_category' => $search_category ?? '',
            'search_name' => $search_name ?? '',
        ];

        return view('admin/_cateBanner/list', $data);
    }

    public function write()
    {
        $code_idx = updateSQ($_GET["code_idx"] ?? '');
        $s_parent_code_no = updateSQ($_GET["s_parent_code_no"] ?? '');
        $parent_code_no = updateSQ($_GET["parent_code_no"] ?? '');

        if ($s_parent_code_no == "") {
            $parent_code_no = "0";
        } else {
            $parent_code_no = $s_parent_code_no;
        }

        $data = [
            'row'   => $this->codeModel->getCodeByIdx($code_idx),
            'row3' => $this->cateBannerModel->getByCodeIdx($code_idx),
            's_parent_code_no' => $s_parent_code_no,
            'parent_code_no' => $parent_code_no,
            'code_idx' => $code_idx,
            'search_category' => $search_category ?? '',
            'search_name' => $search_name ?? '',
        ];

        return view('admin/_cateBanner/write', $data);
    }

    public function write_ok($cb_idx = null)
    {

        $data = $this->request->getPost();

        $data['use_yn'] = $data['use_yn'] ? $data['use_yn'] : "N";

        $files = $this->request->getFiles();
        for ($i = 1; $i <= 2; $i++) {
            $file = $files["ufile$i"];
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $name = $file->getClientName();
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/data/cate_banner', $newName);
                $data["ufile$i"] = $newName;
                $data["rfile$i"] = $name;
            }
        }

        if($cb_idx) {
            $this->cateBannerModel->updateBanner($cb_idx, $data);
        } else {
            $this->cateBannerModel->insertBanner($data);
        }

        return $this->response->setBody("
            <script>
                parent.location.reload();
            </script>
        ");
    }

    public function file_del() {
        $cb_idx = $this->request->getVar("cb_idx");
        $this->cateBannerModel->delete($cb_idx);
        return $this->response->setBody("
            <script>
                parent.location.reload();
            </script>
        ");
    }
}
