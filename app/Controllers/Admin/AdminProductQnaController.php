<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminProductQnaController extends BaseController
{
    protected $connect;
    protected $productQna;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->productQna = model("ProductQna");
    }

    public function list()
    {
        try {
            $g_list_rows = 10;
            $pg = updateSQ($this->request->getVar("pg") ?? 1);
            $search_txt = updateSQ($this->request->getVar("search_txt") ?? '');
            $search_category = updateSQ($this->request->getVar("search_category") ?? '');
            $gubun = updateSQ($this->request->getVar("gubun"));

            if(empty($gubun)) {
                $gubun = "hotel";
            }

            $where = [
                'search_txt' => $search_txt,
                'search_category' => $search_category
            ];

            $qna = $this->productQna->getList($gubun, $where, $g_list_rows, $pg);

            return view('admin/_product_qna/list', [
                'list_qna' => $qna["items"],
                'search_category' => $search_category,
                'search_txt' => $search_txt,
                'pg' => $pg,
                'g_list_rows' => $g_list_rows,
                'nPage' => $qna["nPage"],
                'gubun' => $gubun
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function write()
    {
        try {
            $idx = $this->request->getVar('idx');
            $data = $this->productQna->getById($idx);

            if (empty($data)) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "상세정보를 찾을 수 없습니다."
                ])->setStatusCode(404);
            }

            return view('', [
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function write_ok()
    {
        try {
            $idx = $this->request->getPost('idx');
            $title = $this->request->getPost('title');
            $parent_idx = $this->request->getPost('parent_idx') ?? null;
            $product_idx = $this->request->getPost('product_idx');
            $user_name = $_SESSION['member']['name'];
            $user_id = $_SESSION['member']['idx'];
            $ipAddress = $this->request->getIPAddress();
            $status = 'Y';
            $r_date = date('Y-m-d H:i:s');
            $m_date = date('Y-m-d H:i:s');

            $data = [
                'title' => $title,
                'parent_idx' => $parent_idx,
                'product_idx' => $product_idx,
                'user_name' => $user_name,
                'user_id' => $user_id,
                'user_ip' => $ipAddress,
                'status' => $status,
            ];

            if (!empty($idx)) {
                $data['idx'] = $idx;
                $data['m_date'] = $m_date;
                $this->productQna->updateData($idx, $data);
            } else {
                $data['r_date'] = $r_date;
                $this->productQna->insertData($data);
            }

            return $this->response->setJSON([
                'result' => true,
                'message' => ""
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function delete()
    {
        try {
            $idx = $this->request->getVar('idx');
            $data = $this->productQna->getById($idx);

            if (empty($data)) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "상세정보를 찾을 수 없습니다."
                ])->setStatusCode(404);
            }

            $this->productQna->updateData($idx, ['status' => 'N']);

            return $this->response->setJSON([
                'result' => true,
                'message' => "성공적으로 삭제되었습니다.",
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }
}
