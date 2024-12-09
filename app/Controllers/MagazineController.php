<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class MagazineController extends BaseController
{
    protected $connect;
    protected $bbsModel;
    protected $bbsCommentModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
        $this->bbsModel = new \App\Models\Bbs();
        $this->bbsCommentModel = new \App\Models\BbsCommentModel();
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

    public function listComment()
    {
        try {
            $bbs_idx = $this->request->getVar('bbs_idx');

            $data = $this->bbsCommentModel->getList($bbs_idx);

            foreach ($data as $key => $value) {
                $sql = "SELECT * FROM tbl_member WHERE m_idx = " . $value['m_idx'];
                $member = $this->connect->query($sql)->getRowArray();
                $data[$key]['user_name'] = $member['user_name'];
                $data[$key]['user_email'] = $member['user_email'];
                $data[$key]['avatar'] = $member['ufile1'];
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'data' => $data,
                        'message' => '모든 댓글을 성공적으로 검색했습니다.'
                    ]
                );
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

    public function createComment()
    {
        try {
            $r_idx = $this->request->getPost('r_idx');
            $code = $this->request->getPost('code');
            $r_code = $this->request->getPost('r_code');
            $comment = $this->request->getPost('comment');

            $ip_address = $this->request->getIPAddress();
            $r_date = date('Y-m-d H:i:s');
            $displays = 'Y';
            $writer = $_SESSION['member']['user_name'];
            $m_idx = $_SESSION['member']['idx'];

            $data = [
                'bbs_idx' => $r_idx,
                'code_no' => $code,
                'code' => $r_code,
                'comment' => $comment,
                'ip_address' => $ip_address,
                'r_date' => $r_date,
                'displays' => $displays,
                'writer' => $writer ?? '알 수 없는 사용자',
                'm_idx' => $m_idx
            ];

            $result = $this->bbsCommentModel->insert($data);

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'data' => $result,
                        'message' => '댓글이 등록되었습니다.'
                    ]
                );
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

    public function updateComment()
    {
        try {
            $tbc_idx = $this->request->getPost('tbc_idx');
            $comment = $this->request->getPost('comment');

            $data = [
                'comment' => $comment,
            ];

            $result = $this->bbsCommentModel->update($tbc_idx, $data);

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'data' => $result,
                        'message' => '댓글이 수정되었습니다.'
                    ]
                );
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

    public function deleteComment()
    {
        try {
            $tbc_idx = $this->request->getPost('tbc_idx');

            $result = $this->bbsCommentModel->delete($tbc_idx);

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'data' => $result,
                        'message' => '댓글이 성공적으로 삭제되었습니다.'
                    ]
                );
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
