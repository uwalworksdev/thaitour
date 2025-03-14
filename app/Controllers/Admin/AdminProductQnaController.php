<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;
use CodeIgniter\I18n\Time;

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
            // $g_list_rows = 10;
            $g_list_rows = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 10;
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
                'total_cnt' => $qna["nTotalCount"],
                'num' => $qna["num"],
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
            $data = $this->productQna->getByIdx($idx);

            if (empty($data)) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "상세정보를 찾을 수 없습니다."
                ])->setStatusCode(404);
            }

            if($data["is_view"] == "N"){
                $this->productQna->updateData($idx, ["is_view" => "Y"]);
            }

            return view('/admin/_product_qna/write', [
                'data' => $data,
                'idx' => $idx
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
            $title = $this->request->getPost('title') ?? "";
            $status = $this->request->getPost('status') ?? "";
            $reply_content = $this->request->getPost('reply_content') ?? "";
            $m_date = Time::now('Asia/Seoul', 'en_US')->format('Y-m-d H:i:s');
            $r_date = Time::now('Asia/Seoul', 'en_US')->format('Y-m-d H:i:s');

            $data = [
                'title' => $title,
                'status' => $status,
                'reply_content' => $reply_content
            ];

            if (!empty($idx)) {
                $data['m_date'] = $m_date;
                $result = $this->productQna->updateData($idx, $data);
                if($result){
                    return $this->response->setJSON([
                        'result' => true,
                        'message' => "수정되었습니다."
                    ], 200);
                }
            } else {
                $data['r_date'] = $r_date;
                $result = $this->productQna->insertData($data);
                if($result){
                    return $this->response->setJSON([
                        'result' => true,
                        'message' => "성공적으로 추가되었습니다."
                    ], 200);
                }
            }

            return $this->response->setJSON([
                'result' => true,
                'message' => "오류가 발생했습니다."
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    // public function delete()
    // {
    //     try {
    //         $idx = $this->request->getVar('idx');
    //         $data = $this->productQna->getByIdx($idx);

    //         if (empty($data)) {
    //             return $this->response->setJSON([
    //                 'result' => false,
    //                 'message' => "상세정보를 찾을 수 없습니다."
    //             ])->setStatusCode(404);
    //         }

    //         $this->productQna->updateData($idx, ['status' => 'N']);

    //         return $this->response->setJSON([
    //             'result' => true,
    //             'message' => "성공적으로 삭제되었습니다.",
    //             'data' => $data
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return $this->response->setJSON([
    //             'result' => false,
    //             'message' => $e->getMessage()
    //         ])->setStatusCode(400);
    //     }
    // }

    public function delete()
    {
        try {
            $idxArray = $this->request->getVar('idx');

            if (!is_array($idxArray) || empty($idxArray)) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "삭제할 내용을 선택하셔야 합니다." 
                ])->setStatusCode(400);
            }

            $idxArray = array_map('intval', $idxArray);

            $data = $this->productQna->getByIdxAray($idxArray);

            if (empty($data)) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "상세정보를 찾을 수 없습니다."
                ])->setStatusCode(404);
            }

            $this->productQna->updateData($idxArray, ['status' => 'N']);

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
