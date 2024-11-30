<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use Exception;

class AdminCouponController extends BaseController
{
    private $couponMst;
    private $db;

    public function __construct()
    {
        $this->couponMst = model("CouponMst");
        helper(['html']);
        $this->db = db_connect();
        helper('my_helper');
        helper('comment_helper');
    }

    public function list(){
        $g_list_rows = 10;
        $pg = updateSQ($this->request->getVar("pg") ?? '');
        $search_category = updateSQ($this->request->getVar("search_category") ?? '');
        $search_name = updateSQ($this->request->getVar("search_name") ?? '');

        $coupon = $this->couponMst->getCouponList($search_name, $search_category, $pg, $g_list_rows);

        return view('admin/_coupon/list', [
            "coupon_list" => $coupon["coupon_list"],
            "nTotalCount" => $coupon["nTotalCount"],
            "pg" => $coupon["pg"],
            "nPage" => $coupon["nPage"],
            "g_list_rows" => $coupon["g_list_rows"],
            "num" => $coupon["num"]
        ]);
    }

    public function write() {
        $idx = updateSQ($this->request->getVar("idx") ?? '');
        $row = null;

        if ($idx) {
            $row = $this->couponMst->find($idx);
        }
        return view('admin/_coupon/write', [
            "row" => $row,
            "idx" => $idx
        ]);
    }

    public function write_ok() {
        try {
            $idx = updateSQ($this->request->getPost("idx"));
            $data = $this->request->getPost();

            if ($idx) {
                $result = $this->couponMst->updateData($idx, $data);
                if($result) {
                    $message = "수정되었습니다.";
                    return "<script>
                                alert('$message');
                                parent.location.reload();
                            </script>";
                }
            } else {
                $data["regdate"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                $insertId = $this->couponMst->insertData($data);
                if($insertId){
                    $message = "등록되었습니다.";
                    return "<script>
                                alert('$message');
                                parent.location.href='/AdmMaster/_coupon/list';
                            </script>";
                }
            }
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function delete() {
        try {
            $idx = $this->request->getPost("idx") ?? [];
            if (!$idx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => 'idx가 존재하지 않습니다'
                ], 400);
            }

            for ($i = 0; $i < count($idx); $i++) {
                $this->couponMst->updateData($idx[$i], ["state" => "C"]);
            }

            $message = "삭제 성공.";
            return $this->response->setJSON([
                'result' => true,
                'message' => $message
            ], 200);
        } catch (Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    
}
