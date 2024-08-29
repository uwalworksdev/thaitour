<?php

namespace App\Controllers;

use Config\CustomConstants as ConfigCustomConstants;

class TourSuggestionController extends BaseController
{
    private $ReviewModel;
    private $Bbs;
    public function __construct()
    {
        $this->db = db_connect();
        $this->ReviewModel = model("ReviewModel");
        $this->Bbs = model("Bbs");
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }
    public function list_review()
    {
        $deviceType = get_device();
        $page = $this->request->getVar('page');
        $s_txt = $this->request->getVar('s_txt');
        $search_category = $this->request->getVar('search_category');
        $currentUri = $this->request->getUri()->getPath();

        $category = $_GET['category'];

        $visual = $this->Bbs->List("banner", ['category' => '117'])->get()->getRowArray();

        $best_review = $this->ReviewModel->getBestReviews($s_txt, $search_category);

        $resultObj = $this->ReviewModel->getReviews($s_txt, $search_category, $category, $page, 10);

        return view("review/review_list", [
            "best_review" => $best_review,
            "visual" => $visual,
            "review_list" => $resultObj['review_list'],
            "total_cnt" => $resultObj['total_cnt'],
            "page" => $resultObj['page'],
            "total_page" => $resultObj['total_page'],
            "no" => $resultObj['no'],
            "s_txt" => $s_txt,
            "search_category" => $search_category,
            "currentUri" => $currentUri,
            "deviceType" => $deviceType,
            "category" => $category
        ]);
    }
    public function list_admin()
    {
        $deviceType = get_device();
        $page = $this->request->getVar('page');
        $s_txt = $this->request->getVar('s_txt');
        $search_category = $this->request->getVar('search_category');
        $search_gubun = $this->request->getVar('search_gubun');
        $currentUri = $this->request->getUri()->getPath();
        $g_list_rows = 10;

        $category = $_GET['category'] ?? null;

        $visual = $this->Bbs->List("banner", ['category' => '117'])->get()->getRowArray();

        $best_review = $this->ReviewModel->getBestReviews($s_txt, $search_category);

        $resultObj = $this->ReviewModel->getReviews($s_txt, $search_category, $category, $page, $g_list_rows);

        return view("admin/_review/list", [
            "best_review" => $best_review,
            "visual" => $visual,
            "review_list" => $resultObj['review_list'],
            "nTotalCount" => $resultObj['total_cnt'],
            "pg" => $resultObj['page'],
            "nPage" => $resultObj['total_page'],
            "num" => $resultObj['no'],
            "s_txt" => $s_txt,
            "search_category" => $search_category,
            "currentUri" => $currentUri,
            "deviceType" => $deviceType,
            "category" => $category,
            'search_gubun' => $search_gubun,
            'g_list_rows' => $g_list_rows
        ]);
    }

    public function list_honeymoon()
    {
        $deviceType = get_device();
        $page = $this->request->getVar('page');
        $s_txt = $this->request->getVar('s_txt');
        $search_category = $this->request->getVar('search_category');
        $search_gubun = $this->request->getVar('search_gubun');
        $currentUri = $this->request->getUri()->getPath();
        $g_list_rows = 10;

        $category = $_GET['category'] ?? null;

        $visual = $this->Bbs->List("banner", ['category' => '117'])->get()->getRowArray();

        $best_review = $this->ReviewModel->getBestReviews($s_txt, $search_category);

        $resultObj = $this->ReviewModel->getReviews($s_txt, $search_category, $category, $page, $g_list_rows);

        return view("admin/_review/list", [
            "best_review" => $best_review,
            "visual" => $visual,
            "review_list" => $resultObj['review_list'],
            "nTotalCount" => $resultObj['total_cnt'],
            "pg" => $resultObj['page'],
            "nPage" => $resultObj['total_page'],
            "num" => $resultObj['no'],
            "s_txt" => $s_txt,
            "search_category" => $search_category,
            "currentUri" => $currentUri,
            "deviceType" => $deviceType,
            "category" => $category,
            'search_gubun' => $search_gubun,
            'g_list_rows' => $g_list_rows
        ]);
    }

    public function write_admin() {
        $idx			= updateSQ($_GET['idx']);
        $row			= null;
        if ($idx) {
            $row = $this->ReviewModel->find($idx);
        }
        return view("admin/_review/write", [
            "row" => $row,
        ]);
    }
    public function detail_admin() {
        $idx = updateSQ($_GET['idx']);
        $row = $this->ReviewModel->getReview($idx);
        return view("admin/_review/detail", [
            "row" => $row
        ]);
    }
    public function change_ajax() {
        $idx = $this->request->getPost('idx_change');
        $onum = $this->request->getPost('onum');
        $display = $this->request->getPost('display');
        $is_best = $this->request->getPost('is_best');

        $success = true;

        foreach ($idx as $i => $id) {
            $data = [
                'onum' => $onum[$i],
                'display' => $display[$i],
                'is_best' => $is_best[$i]
            ];

            if (!$this->ReviewModel->update($id, $data)) {
                $success = false;
                break;
            }
        }

        $msg = $success ? "순위변경되었습니다." : "순위변경실패!!!";

        return $this->response->setJSON(['message' => $msg]);
    }
    public function del() {
        $idx = $this->request->getPost('idx');
        $mode = $this->request->getPost('mode');

        foreach ($idx as $id) {
            $this->ReviewModel->delete($id);
        }

        if ($mode == "view") {
            return $this->response->setBody("<script>
                    alert('삭제처리되었습니다.');
                    parent.history.back();
                  </script>");
        } else {
            return $this->response->setBody('OK');
        }
    }
    public function ajax_del() {
        $idx = $this->request->getPost('idx');

        if ($this->ReviewModel->delete($idx)) {
            $msg = "삭제 성공.";
        } else {
            $msg = "삭제 오류.";
        }

        return $this->response->setJSON(['message' => $msg]);
    }
    public function detail_review()
    {
        $idx = updateSQ($_GET["idx"]);

        if ($idx) {
            $total_sql = " select a.*, b.product_name, c.code_name
                        from tbl_travel_review a 
                        LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx 
                        LEFT JOIN tbl_code c ON a.travel_type = c.code_no 
                        where a.idx='" . $idx . "'";
            $review = $this->db->query($total_sql)->getRowArray();
            if ($review) {
                return view("review/review_detail", ["review" => $review, "idx" => $idx]);
            } else {
                return view("errors/html/error_404", ["message" => "<a href='/'>마이페이지에 접속된 것가 없는 모든 것이 있습니다. </a>"]);
            }
        } else {
            return view("errors/html/error_404");
        }
    }
    public function write_review()
    {
        $member_Id = $_SESSION['member']['idx'];
        $private_key = private_key();
        if (!$member_Id) {
            return "
            <script>
                alert('로그인 필요합니다.');
                location.href = '/member/login.php';
            </script>
        ";
        }
        $sql = "SELECT * FROM tbl_policy_info WHERE policy_code = 'privacy'";
        $privacy = $this->db->query($sql)->getRowArray();

        $sql = "SELECT * FROM tbl_policy_info WHERE policy_code = 'third_paties'";
        $third_paties = $this->db->query($sql)->getRowArray();

        $sql0 = "SELECT * FROM tbl_code WHERE code_no IN('1300', '1320', '1324', '1317', '1325', '1326') AND depth = '2' ORDER BY onum ";
        $list_code = $this->db->query($sql0)->getResultArray();

        $sql_m = "SELECT     birthday
                        , AES_DECRYPT(UNHEX(user_name),   '$private_key') AS user_name
                        , AES_DECRYPT(UNHEX(user_mobile), '$private_key') AS user_mobile
                        , AES_DECRYPT(UNHEX(user_email),  '$private_key') AS user_email
                        , AES_DECRYPT(UNHEX(zip),         '$private_key') AS zip
                        , AES_DECRYPT(UNHEX(addr1),       '$private_key') AS addr1
                        , AES_DECRYPT(UNHEX(addr2),       '$private_key') AS addr2
                            FROM tbl_member WHERE m_Idx = '$member_Id' ";
        $row_m = $this->db->query($sql_m)->getRowArray();

        $email = explode("@", $row_m['user_email']);

        $user_name = $row_m["user_name"];

        $idx = updateSQ($_GET["idx"]);
        $product_idx = updateSQ($_GET["product_idx"]);
        if ($idx) {
            $sql_info = "select t1.*, t2.code_no as travel_type, t3.code_no as travel_type_2, t4.code_no as travel_type_3,
                t2.code_name as travel_type_name, t3.code_name as travel_type_name_2, t4.code_name as travel_type_name_3, t5.product_name
                from tbl_travel_review t1
                left join tbl_code t2 on t1.travel_type = t2.code_no
                left join tbl_code t3 on t1.travel_type_2 = t3.code_no
                left join tbl_code t4 on t1.travel_type_3 = t4.code_no
                left join tbl_product_mst t5 on t1.product_idx = t5.product_idx
                where t1.idx = '$idx'
                ";

            $info = $this->db->query($sql_info)->getRowArray();

            $user_name = sqlSecretConver($info["user_name"], 'decode');
            $user_email = sqlSecretConver($info["user_email"], 'decode');

            $email = explode("@", $user_email);

            $status = $info["status"];
            $is_best = $info["is_best"];
            $ufile1 = $info["ufile1"];
            $rfile1 = $info["rfile1"];
            $ufile2 = $info["ufile2"];
            $rfile2 = $info["rfile2"];
            $r_date = $info["r_date"];
            $travel_type = $info["travel_type"];
            $travel_type_2 = $info['travel_type_2'];
            $travel_type_3 = $info['travel_type_3'];
            $product_idx = $info['product_idx'];
            $title = $info['title'];
            $contents = $info["contents"];
            $travel_type_name = $info['travel_type_name'];
            $travel_type_name_2 = $info['travel_type_name_2'];
            $travel_type_name_3 = $info['travel_type_name_3'];
            $product_name = $info['product_name'];
        } else if ($product_idx) {
            $sql_r = "select a.product_idx,a.product_name, b.code_no as travel_type, c.code_no as travel_type_2, d.code_no as travel_type_3, 
            b.code_name as travel_type_name, c.code_name as travel_type_name_2, d.code_name as travel_type_name_3 
            from tbl_product_mst a
            left join tbl_code b on a.product_code_1 = b.code_no
            left join tbl_code c on a.product_code_2 = c.code_no
            left join tbl_code d on a.product_code_3 = d.code_no
            where b.code_gubun = 'tour' and a.product_idx = '{$product_idx}' ";
            $row_r = $this->db->query($sql_r)->getRowArray();
            $travel_type = $row_r["travel_type"];
            $travel_type_2 = $row_r["travel_type_2"];
            $travel_type_3 = $row_r["travel_type_3"];
            $travel_type_name = $row_r['travel_type_name'];
            $travel_type_name_2 = $row_r['travel_type_name_2'];
            $travel_type_name_3 = $row_r['travel_type_name_3'];
            $product_name = $row_r['product_name'];
        }

        $data = [
            "idx" => $idx,
            "user_name" => $user_name,
            "email" => $email,
            "product_idx" => $product_idx,
            "travel_type" => $travel_type,
            "travel_type_2" => $travel_type_2,
            "travel_type_3" => $travel_type_3,
            "travel_type_name" => $travel_type_name,
            "travel_type_name_2" => $travel_type_name_2,
            "travel_type_name_3" => $travel_type_name_3,
            "product_name" => $product_name,
            "status" => $status,
            "is_best" => $is_best,
            "ufile1" => $ufile1,
            "rfile1" => $rfile1,
            "ufile2" => $ufile2,
            "rfile2" => $rfile2,
            "r_date" => $r_date,
            "title" => $title,
            "contents" => $contents,
            "privacy" => $privacy,
            "third_paties" => $third_paties,
            "list_code" => $list_code
        ];

        return view("review/review_write", $data);
    }
    public function save_review()
    {
        $data = $this->request->getPost();
        $files = [
            "ufile1" => $this->request->getFile("ufile1"),
            "ufile2" => $this->request->getFile("ufile2"),
        ];
        $session = session();
        $role = updateSQText($data['role']);

        $idx = updateSQText($data['idx']);
        $travel_type_2 = updateSQText($data['travel_type_2']);
        $travel_type_3 = updateSQText($data['travel_type_3']);
        $travel_type = updateSQText($data['travel_type']);
        $user_name = updateSQText($data['user_name']);
        $title = updateSQText($data['title']);
        $contents = updateSQ($data['contents']);
        $product_idx = updateSQText($data['product_idx']);
        $user_phone       		= updateSQ($_POST["user_phone"]);

        if ($role == "admin") {
            $user_email       		= updateSQ($_POST["user_email"]);
            $status					= updateSQ($_POST["status"]);
            $is_best				= updateSQ($_POST["is_best"]);
            $display				= updateSQ($_POST["display"]);
            $r_date				    = updateSQ($_POST["r_date"]);
        } else {
            $mail_name = updateSQText($data['mail_name']);
            $mail_host = updateSQText($data['mail_host']);
            $user_email = $mail_name . '@' . $mail_host;
            $status = "Y";
            $is_best = "N";
            $display = "Y";
            $r_date = date("Y-m-d H:i:s");
        }

        $user_phone_string = implode(explode("-", $user_phone));
        $pass = substr($user_phone_string, -4);

        $upload = WRITEPATH . 'uploads/review/';

        $r_file_name1 = $r_file_code1 = $r_file_name2 = $r_file_code2 = null;

        if (isset($files['ufile1']) && $files['ufile1']->isValid()) {
            if (!noFileExt($files['ufile1']->getName())) {
                return 'NF';
            }

            $r_file_name1 = $files['ufile1']->getName();
            $r_file_code1 = $files['ufile1']->getRandomName();
            $files['ufile1']->move($upload, $r_file_code1);
        }

        if (isset($files['ufile2']) && $files['ufile2']->isValid()) {
            if (!noFileExt($files['ufile2']->getName())) {
                return 'NF';
            }

            $r_file_name2 = $files['ufile2']->getName();
            $r_file_code2 = $files['ufile2']->getRandomName();
            $files['ufile2']->move($upload, $r_file_code2);
        }

        if ($idx) {
            $dataToUpdate = [
                'user_name' => sqlSecretConver($user_name, 'encode'),
                'user_email' => sqlSecretConver($user_email, 'encode'),
                'title' => $title,
                'contents' => $contents
            ];

            if ($role == "admin") {
                $dataToUpdate['status'] = $status;
                $dataToUpdate['is_best'] = $is_best;
                $dataToUpdate['display'] = $display;
                $dataToUpdate['r_date'] = $r_date;
                $dataToUpdate['user_phone'] = $user_phone;
            }

            if ($r_file_name1) {
                $dataToUpdate['rfile1'] = $r_file_name1;
                $dataToUpdate['ufile1'] = $r_file_code1;
            }

            if ($r_file_name2) {
                $dataToUpdate['rfile2'] = $r_file_name2;
                $dataToUpdate['ufile2'] = $r_file_code2;
            }

            $this->ReviewModel->update($idx, $dataToUpdate);
            return alert_msg("정상적으로 수정되었습니다.", "/review/review_list");
        } else {
            $dataToInsert = [
                'user_name' => sqlSecretConver($user_name, 'encode'),
                'user_email' => sqlSecretConver($user_email, 'encode'),
                'reg_m_idx' => $session->get('member.idx'),
                'rfile1' => $r_file_name1,
                'ufile1' => $r_file_code1,
                'rfile2' => $r_file_name2,
                'ufile2' => $r_file_code2,
                'product_idx' => $product_idx,
                'travel_type' => $travel_type,
                'travel_type_2' => $travel_type_2,
                'travel_type_3' => $travel_type_3,
                'title' => $title,
                'contents' => $contents,
                'r_date' => $r_date,
                'passwd' => $pass,
                'user_ip' => $_SERVER['REMOTE_ADDR']
            ];

            if ($role == "admin") {
                $dataToInsert['status'] = $status;
                $dataToInsert['is_best'] = $is_best;
                $dataToInsert['display'] = $display;
                $dataToInsert['user_phone'] = $user_phone;
            }

            $this->ReviewModel->insert($dataToInsert);
            return alert_msg("정상적으로 등록되었습니다.", "/review/review_list");
        }
    }
    public function review_delete()
    {
        $idx = $_POST['idx'];

        $db1 = $this->ReviewModel->delete($idx);
        if (!$db1) {
            return "NO";
        }
        return "OK";
    }
}