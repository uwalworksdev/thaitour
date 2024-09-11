<?php
namespace App\Controllers;

use App\Libraries\JkBbs;
use CodeIgniter\Controller;



class BoardController extends BaseController
{
    private $bbsConfigModel;
    private $bbsModel;
    private $bbsCategoryModel;
    private $codeModel;
    private $Product_model;
    private $bbsCommentModel;
    public function __construct()
    {
        $this->bbsConfigModel = model("BbsConfigModel");
        $this->bbsModel = model("Bbs");
        $this->bbsCategoryModel = model("BbsCategoryModel");
        $this->codeModel = model("Code");
        $this->Product_model = model("Product_model");
        $this->bbsCommentModel = model("BbsCommentModel");
        error_reporting(1);
    }

    public function isBoardCategory($code)
    {
        $result = $this->bbsConfigModel->where('board_code', $code)->first();

        if (!$result || $result['is_category'] === '') {
            throw new \Exception("정상적으로 이용바랍니다.");
        }

        return $result['is_category'];
    }


    public function index2()
    {
        // Load common functions
        helper('common'); // Assuming common functions are in a helper

        $r_code = $this->request->getGet('r_code') ?? 'notice';
        $page = $this->request->getGet('page') ?? 1;

        // Initialize JkBbs class
        $Bbs = new JkBbs($r_code);

        $code_info = $Bbs->get_code_info();
        $category_arr = $Bbs->category_arr;

        $scale = 20; // Number of items per page
        $page_cnt = 10; // Number of pages to display

        $total_cnt = $Bbs->get_total_cnt();
        $total_page = ceil($total_cnt / $scale);

        if ($page > $total_page) $page = $total_page;
        if ($page < 1) $page = 1;

        $start = ($page - 1) * $scale;
        $Bbs->input['start'] = $start;
        $Bbs->input['scale'] = $scale;
        array_push($Bbs->list_field_arr, "r_order", "r_flag");
        if ($r_code == "review") {
            $Bbs->sort_query = 'ORDER BY T.r_flag DESC, T.r_order DESC, r_reg_date DESC';
        }
        $list_arr = $Bbs->get_list();
        $list_cnt = count($list_arr);

        // Check user authentication
        $auth = null;
        if ($r_code == 'faq') {
            $auth = 'A003';
        }

        if ($auth && !$this->check_auth($auth)) {
            return redirect()->to('/AdmMaster/_main/main.php')->with('error', '당신은 접근 권한이 없습니다');
        }

        $data = [
            'r_code' => $r_code,
            'code_info' => $code_info,
            'list_arr' => $list_arr,
            'list_cnt' => $list_cnt,
            'total_cnt' => $total_cnt,
            'total_page' => $total_page,
            'scale' => $scale,
            'page' => $page,
            'Bbs' => $Bbs,
            'db' => \Config\Database::connect(),
            'page_cnt' => $page_cnt,
            'num'=> $total_cnt - $start
        ];

        return view('admin/_board/list_rcode', $data); // Replace 'board_view' with the appropriate view file
    }
    public function form() {
        $r_code = $this->request->getGet('r_code');

        // 클래스
        $Bbs = new JkBbs($r_code);

        $code_info = $Bbs->get_code_info($r_code);

        $r_idx = $_GET['r_idx'];
        if ($r_idx != "") {
            array_push($Bbs->list_field_arr, "r_flag");
            $form_data = $Bbs->get_form_data($r_idx);
            $file_arr = json_decode($form_data['r_file_list'], true);
            $file_cnt = count($file_arr);
        } else {
            $form_data = array();
            foreach ($Bbs->new_default_arr as $key => $val)
                $form_data[$key] = $val;
        }

        $product_code_arr = $Bbs->get_child_product_code_arr();
        $product_arr = $Bbs->get_product_arr();
        $code_arr = $this->codeModel->where([
            'code_gubun' => $r_code,
            'depth' => 2
            ])->orderBy('onum', 'desc')->get()->getResultArray();
        return view('admin/_board/form', [
            'r_code' => $r_code,
            'code_info' => $code_info,
            'form_data' => $form_data,
            'product_code_arr' => $product_code_arr,
            'product_arr' => $product_arr,
            'Bbs' => $Bbs,
            'file_cnt' => $file_cnt,
            'file_arr' => $file_arr,
            'code_arr' => $code_arr
        ]);
    }
    public function form_ok() {
       
    }

    public function check_auth($auth)
    {
        $session = session();
        return $session->has('member');
    }

    public function getBoardName($code)
    {
        $result = $this->bbsConfigModel->find($code);

        if ($result && isset($result['board_name'])) {
            return $result['board_name'];
        } else {
            return 'Unknown Board';
        }
    }
    public function listNew($term, $reg_date1)
    {
        $sub_date = date("Y-m-d H:i:s", mktime(date('H') - $term, date('i'), date('s'), date('m'), date('d'), date('Y')));

        if ($reg_date1 < $sub_date) {
            $show = 1;
        } else {
            $show = 0;
        }

        return $show;
    }
    public function index()
    {
        $code = $this->request->getGet('code');
        $scategory = $this->request->getGet('scategory');
        $search_word = $this->request->getGet('search_word');
        $search_mode = $this->request->getGet('search_mode');
        $g_list_rows = 20;
        $is_category = $this->isBoardCategory($code);

        // Default page number
        $pg = $this->request->getGet('pg') ?? 1;

        $skin = '';
        if ($code === "gallery") {
            $skin = "gallery";
        } elseif ($code === "media") {
            $skin = "media";
        } elseif ($code === "event") {
            $skin = "event";
        } elseif ($code === "main_event") {
            $skin = "main_event";
        }

        if ($code == "b2b_notice") {
            $auth = 'A001';
        } elseif ($code == "event") {
            $auth = 'A007';
        } elseif ($code == "winner") {
            $auth = 'A008';
        }

        if (isset($auth) && !$this->check_auth($auth)) {
            return redirect()->to('/AdmMaster/_main/main.php')->with('error', '당신은 접근 권한이 없습니다');
        }

        $strSql = '';
        if (!empty($search_word)) {
            if (!empty($search_mode)) {
                $strSql .= " AND $search_mode LIKE '%$search_word%'";
            } else {
                $strSql .= " AND (subject LIKE '%$search_word%' OR contents LIKE '%$search_word%')";
            }
        }
        if (!empty($scategory)) {
            $strSql .= " AND category = '$scategory'";
        }
        $strSql .= " AND code = '$code'";

        $db = \Config\Database::connect();
        $total_sql = "SELECT *, (SELECT subject FROM tbl_bbs_category WHERE tbl_bbs_category.tbc_idx = tbl_bbs_list.category) AS scategory,
                      (SELECT COUNT(*) FROM tbl_bbs_comment WHERE tbl_bbs_comment.bbs_idx = tbl_bbs_list.bbs_idx) AS comment_cnt
                      FROM tbl_bbs_list WHERE 1=1 $strSql";
        write_log($total_sql);

        // Execute the query to get the total count
        $query = $db->query($total_sql);
        $nTotalCount = $query->getNumRows();

        // Calculate the number of pages
        $nPage = ceil($nTotalCount / $g_list_rows);

        $sel_cates = '';
        if ($is_category == "Y" && !empty($scategory)) {
            $fsql_c = "SELECT subject FROM tbl_bbs_category WHERE code='$code' AND tbc_idx = '$scategory'";
            $query_c = $db->query($fsql_c);
            $frow_c = $query_c->getRowArray();
            $sel_cates = " - " . $frow_c['subject'];
        }

        $nFrom = ($pg - 1) * $g_list_rows;

        // Query to get the specific records for the current page
        $list_sql = $total_sql . " ORDER BY notice_yn DESC, r_date DESC, b_ref DESC, b_step ASC LIMIT $nFrom, $g_list_rows";
        $list_query = $db->query($list_sql);
        $rows = $list_query->getResultArray(); // Fetch the rows as an associative array

        // Sử dụng hàm listNew để xác định bài viết mới
        foreach ($rows as &$row) {
            $row['is_new'] = $this->listNew(24, $row['r_date']);
        }

        $data = [
            'code' => $code,
            'scategory' => $scategory,
            'search_mode' => $search_mode,
            'search_word' => $search_word,
            'nTotalCount' => $nTotalCount,
            'g_list_rows' => $g_list_rows,
            'sel_cates' => $sel_cates,
            'pg' => $pg,
            'nPage' => $nPage,
            'is_category' => $is_category,
            'nFrom' => $nFrom,
            'skin' => $skin,
            'rows' => $rows // Add the rows to the data array, now with 'is_new' field
        ];

        // Load the view with the data
        echo view('admin/_board/list', $data);
    }
    public function board_write()
    {
        $code = $_GET['code'];
        $search_mode = updateSQ($this->request->getVar('search_mode'));
        $search_word = updateSQ($this->request->getVar('search_word'));
        $pg = updateSQ($this->request->getVar('pg'));
        $bbs_idx = updateSQ($this->request->getVar('bbs_idx'));
        $scategory = updateSQ($this->request->getVar('scategory'));
        $mode = updateSQ($this->request->getVar('mode'));
        $member = session('member') ?? [];
        $codeInfo = $this->bbsConfigModel->codeInfo($code);
        $writer = sqlSecretConver($member['name'] ?? '', 'decode');
        $email = $member['email'] ?? '';
        $wDate = date("Y-m-d H:i:s", time());
        $hit = 0;
        $data = $codeInfo;
        $data['code'] = $code;
        $data['search_mode'] = $search_mode;
        $data['search_word'] = $search_word;
        $data['pg'] = $pg;
        $data['bbs_idx'] = $bbs_idx;
        $data['scategory'] = $scategory;
        $data['email'] = $email;
        $data['wDate'] = $wDate;
        $data['hit'] = $hit;
        $data['titleStr'] = "등록";
        $cnt = 0;
        if ($mode == "reply") {
            $row = $this->bbsModel->View($bbs_idx);
            $subject = "[re]" . $row['subject'];
            $contents = "-------------------- 원본글 -------------------- <br>" . $row[contents];
            $b_step = $row['b_step'];
            $b_level = $row['b_level'];
            $b_ref = $row['b_ref'];
            $secure_yn = $row['secure_yn'];
            $mode = "reply";
            $product_code_1 = $row['product_code_1'];
            $product_code_2 = $row['product_code_2'];
            $product_code_3 = $row['product_code_3'];
            $reply = $row['reply'];
        } elseif ($bbs_idx) {
            $row = $this->bbsModel->View($bbs_idx);
            $writer = $row['writer'];
            $email = $row['email'];
            $hit = $row['hit'];
            $subject = $row['subject'];
            $subject_e = $row['subject_e'];
            $seq = $row['seq'];
            $simple = $row['simple'];
            $s_date = $row['s_date'];
            $e_date = $row['e_date'];
            $notice_yn = $row['notice_yn'];
            $secure_yn = $row['secure_yn'];
            $recomm_yn = $row['recomm_yn'];
            $contents = $row['contents'];
            $category = $row['category'];
            $url = $row['url'];
            $cnt = 0;
            $ufile1 = $row['ufile1'];
            $rfile1 = $row['rfile1'];

            $ufile2 = $row['ufile2'];
            $rfile2 = $row['rfile2'];

            $ufile3 = $row['ufile3'];
            $rfile3 = $row['rfile3'];

            $ufile4 = $row['ufile4'];
            $rfile4 = $row['rfile4'];

            $ufile5 = $row['ufile5'];
            $rfile5 = $row['rfile5'];

            $ufile6 = $row['ufile6'];
            $rfile6 = $row['rfile6'];
            $wDate = $row['r_date'];
            $product_code_1 = $row['product_code_1'];
            $product_code_2 = $row['product_code_2'];
            $product_code_3 = $row['product_code_3'];
            $reply = $row['reply'];


            if ($ufile1 != "") {
                $cnt = $cnt + 1;
            }
            if ($ufile2 != "") {
                $cnt = $cnt + 1;
            }
            if ($ufile3 != "") {
                $cnt = $cnt + 1;
            }
            if ($ufile4 != "") {
                $cnt = $cnt + 1;
            }
            if ($ufile5 != "") {
                $cnt = $cnt + 1;
            }
            if ($cnt < 1) {
                $cnt = 1;
            }
        } else {
            $cnt = 1;
        }

        if ($code == "b2b_notice") {
            if ($writer == "") {
                $writer = "하이호주";
            }
        }

        if ($writer == "") {
            $writer = "관리자";
        }
        $data['cnt'] = $cnt;
        $data['mode'] = $mode;
        $data['writer'] = $writer;
        $data['subject'] = $subject ?? "";
        $data['contents'] = $contents ?? "";
        $data['b_step'] = $b_step ?? "";
        $data['b_level'] = $b_level ?? "";
        $data['b_ref'] = $b_ref ?? "";
        $data['secure_yn'] = $secure_yn ?? "";
        $data['subject_e'] = $subject_e ?? "";
        $data['seq'] = $seq ?? "";
        $data['simple'] = $simple ?? "";
        $data['s_date'] = $s_date ?? "";
        $data['e_date'] = $e_date ?? "";
        $data['notice_yn'] = $notice_yn ?? "";
        $data['secure_yn'] = $secure_yn ?? "";
        $data['contents'] = $contents ?? "";
        $data['category'] = $category ?? "";
        $data['url'] = $url ?? "";
        $data['ufile1'] = $ufile1 ?? "";
        $data['rfile1'] = $rfile1 ?? "";
        $data['ufile2'] = $ufile2 ?? "";
        $data['rfile2'] = $rfile2 ?? "";
        $data['ufile3'] = $ufile3 ?? "";
        $data['rfile3'] = $rfile3 ?? "";
        $data['ufile4'] = $ufile4 ?? "";
        $data['rfile4'] = $rfile4 ?? "";
        $data['ufile5'] = $ufile5 ?? "";
        $data['rfile5'] = $rfile5 ?? "";
        $data['ufile6'] = $ufile6 ?? "";
        $data['rfile6'] = $rfile6 ?? "";
        $data['wDate'] = $wDate ?? "";
        $data['product_code_1'] = $product_code_1 ?? "";
        $data['product_code_2'] = $product_code_2 ?? "";
        $data['product_code_3'] = $product_code_3 ?? "";
        $data['board_name'] = $this->getBoardName($code);
        $data['list_category'] = $this->bbsCategoryModel->getCategoriesByCodeAndStatus($code);
        $data['list_code'] = $this->codeModel->getCodesByGubunDepthAndStatus('tour', '2');
        $data['list_code2_exclude'] = $this->codeModel->getCodesByGubunDepthAndStatusExclude('tour', '2', ['1308','1309']);
        $data['list_code3'] = $this->codeModel->getByParentAndDepth($data['product_code_1'], '3')->getResultArray();
        $data['list_code4'] = $this->codeModel->getByParentAndDepth($data['product_code_2'], '4')->getResultArray();
        $data['event_list'] = $this->Product_model->getProductsByEvent($bbs_idx);
        $data['reply'] = $reply ?? "";
        $data['list_comment'] = $this->bbsCommentModel->getCommentsWithMemberDetails($bbs_idx, $code, private_key());
        $data['product_code_no'] = "";
        $data['product_code_name'] = "";
        return view('admin/_board/write', $data);
    }
}
