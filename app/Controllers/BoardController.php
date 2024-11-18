<?php

namespace App\Controllers;

use App\Libraries\JkBbs;
use App\Libraries\Lib;

use CodeIgniter\Controller;
use Config\Database;


class BoardController extends BaseController
{
    private $bbsConfigModel;
    private $bbsModel;
    private $bbsCategoryModel;
    private $codeModel;
    private $ProductModel;
    private $bbsCommentModel;
    private $uploadPath = WRITEPATH . "uploads/bbs/";

    public function __construct()
    {
        $this->bbsConfigModel = model("BbsConfigModel");
        $this->bbsModel = model("Bbs");
        $this->bbsCategoryModel = model("BbsCategoryModel");
        $this->codeModel = model("Code");
        $this->ProductModel = model("ProductModel");
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

        $r_code = $this->request->getGet('r_code') ?? 'notice';
        $page = $this->request->getGet('page') ?? 1;

        $Bbs = new JkBbs($r_code);

        $code_info = $Bbs->get_code_info();
        $category_arr = $Bbs->category_arr;

        $scale = 20;
        $page_cnt = 10;

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

        $auth = null;
        if ($r_code == 'faq') {
            $auth = 'A003';
        }

        if ($auth && !$this->check_auth($auth)) {
            return redirect()->to('/AdmMaster/main')->with('error', '당신은 접근 권한이 없습니다');
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
            'num' => $total_cnt - $start
        ];

        return view('admin/_board/list_rcode', $data);
    }

    public function form()
    {
        $r_code = $this->request->getGet('r_code');

        // 클래스
        $Bbs = new JkBbs($r_code);

        $code_info = $Bbs->get_code_info($r_code);

        $r_idx = $this->request->getGet('r_idx');
        if ($r_idx != "") {
            array_push($Bbs->list_field_arr, "r_flag");
            $form_data = $Bbs->get_form_data($r_idx);
            $file_arr = json_decode($form_data['r_file_list'], true) ?? [];
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
            'r_idx' => $r_idx,
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

    public function form_ok()
    {
        $Lib = new Lib();
        $cmd = $this->request->getPost('cmd');
        $r_code = $this->request->getPost('r_code');
        $r_idx = $this->request->getPost('r_idx');
        $call_type = $this->request->getPost('call_type');
        $data_type = $this->request->getPost('data_type');
        if ($cmd == "") {
            $Lib->alert_return($call_type, "실행할 명령이 지정되지 않았습니다.");
        }

        $db = \Config\Database::connect();

        if ($cmd == "del_ok") {
            $idx = explode(",", $r_idx);
            if (count($idx) == 0) {
                $sql = "delete from tbl_bbs where r_idx = '$idx'";
                $db->query($sql);
            } else {
                for ($i = 0; $i < count($idx); $i++) {
                    $sql = "delete from tbl_bbs where r_idx = " . $idx[$i];
                    $db->query($sql);
                }
            }
        }

        $Bbs = new JkBbs($r_code);
        $return = $Bbs->$cmd();

        // 실행 결과 전달
        $Lib->alert_return($call_type, $return);
    }

    public function check_auth($auth)
    {
        $session = session();
        return $session->has('member');
    }

    public function getBoardName($code)
    {
        $result = $this->bbsConfigModel->where("board_code", $code)->first();

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

        $list_sql = $total_sql . " ORDER BY notice_yn DESC, r_date DESC, onum DESC, b_ref DESC, b_step ASC LIMIT $nFrom, $g_list_rows";
        $list_query = $db->query($list_sql);
        $rows = $list_query->getResultArray();

        foreach ($rows as &$row) {
            $row['is_new'] = $this->listNew(24, $row['r_date']);
        }

        $board_name = $this->getBoardName($code);


        // if (in_array($skin, ['gallery', 'media', 'event']) || $code == 'main_event' || $code == "awards") {
        //     $orderStr = '';
        //     $nPage = ceil($nTotalCount / $g_list_rows);
        //     if ($pg == "") $pg = 1;
        //     $nFrom = ($pg - 1) * $g_list_rows;

        //     $sql = $total_sql . " order by $orderStr onum desc limit $nFrom, $g_list_rows ";
        //     $result = $db->query($sql);
        //     $result = $result->getResultArray();
        // }

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
            'board_name' => $board_name,
            // 'result' => $result ?? '',
            'rows' => $rows // Add the rows to the data array, now with 'is_new' field
        ];

        // Load the view with the data
        return view('admin/_board/list', $data);
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
            $contents = "-------------------- 원본글 -------------------- <br>" . $row["contents"];
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
                $writer = "더투어랩";
            }
        }

        if ($writer == "") {
            $writer = "관리자";
        }
        $data['cnt'] = $cnt;
        $data['mode'] = $mode;
        $data['writer'] = $writer;
        $data['email'] = $email ?? "";
        $data['hit'] = $hit ?? 0;
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
        $data['list_code2_exclude'] = $this->codeModel->getCodesByGubunDepthAndStatusExclude('tour', '2', ['1308', '1309']);
        $data['list_code3'] = $this->codeModel->getByParentAndDepth($data['product_code_1'], '3')->getResultArray();
        $data['list_code4'] = $this->codeModel->getByParentAndDepth($data['product_code_2'], '4')->getResultArray();
        $data['event_list'] = $this->ProductModel->getProductsByEvent($bbs_idx);
        $data['reply'] = $reply ?? "";
        $data['list_comment'] = $this->bbsCommentModel->getCommentsWithMemberDetails($bbs_idx, $code, private_key());
        $data['product_code_no'] = "";
        $data['product_code_name'] = "";
        return view('admin/_board/write', $data);
    }

    public function write_ok()
    {
        //$upload = ROOTPATH . 'public/data/bbs/';

        $bbs_idx = updateSQ($this->request->getPost('bbs_idx'));
        $category = updateSQ($this->request->getPost('category'));
        $category1 = updateSQ($this->request->getPost('category1'));
        $search_mode = updateSQ($this->request->getPost('search_mode'));
        $search_word = updateSQ($this->request->getPost('search_word'));
        $scategory = updateSQ($this->request->getPost('scategory'));
        $pg = updateSQ($this->request->getPost('pg'));
        $subject = updateSQ($this->request->getPost('subject'));
        $subject_e = updateSQ($this->request->getPost('subject_e'));
        $seq = updateSQ($this->request->getPost('seq'));
        $simple = updateSQ($this->request->getPost('simple'));
        $code = updateSQ($this->request->getPost('code'));
        $writer = updateSQ($this->request->getPost('writer'));
        $email = updateSQ($this->request->getPost('email'));
        $contents = updateSQ($this->request->getPost('contents'));
        $url = updateSQ($this->request->getPost('url'));
        $hit = updateSQ($this->request->getPost('hit'));
        $mode = updateSQ($this->request->getPost('mode'));
        $reply = updateSQ($this->request->getPost('reply'));
        $notice_yn = updateSQ($this->request->getPost('notice_yn'));
        $secure_yn = updateSQ($this->request->getPost('secure_yn'));

        $b_ref = updateSQ($this->request->getPost('b_ref'));
        $b_step = updateSQ($this->request->getPost('b_step'));
        $recomm_yn = updateSQ($this->request->getPost('recomm_yn'));
        $b_level = updateSQ($this->request->getPost('b_level'));
        $wdate = updateSQ($this->request->getPost('wdate'));
        $files = $this->request->getFiles();

        $member = session('member') ?? [];

        $user_id = $member["id"];

        if ($writer == "") {
            $writer = $member["name"];
        }

        if ($wdate) {
            $r_date = "'" . $wdate . "'";
        } else {
            $r_date = "now()";
        }


        $uploadPath = ROOTPATH . '/public/uploads/bbs/';

        $db = \Config\Database::connect();

        for ($i = 1; $i <= 6; $i++) {
            ${"rfile_" . $i} = "";
            ${"ufile_" . $i} = "";

            if ($this->request->getPost("del_" . $i) == "Y") {
                $sql = "
                    UPDATE tbl_bbs_list SET
                    ufile" . $i . "='',
                    rfile" . $i . "=''
                    WHERE bbs_idx='$bbs_idx'
                ";
                $db->query($sql);
            } elseif ($files["ufile" . $i]) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $publicPath = ROOTPATH . '/public/uploads/bbs/';
                    $file->move($publicPath, $data["ufile$i"]);
                }

                if ($bbs_idx) {
                    $sql = "
                        UPDATE tbl_bbs_list SET
                        ufile" . $i . "='" . ${"ufile_" . $i} . "',
                        rfile" . $i . "='" . ${"rfile_" . $i} . "'
                        WHERE bbs_idx='$bbs_idx';
                    ";
					write_log("upload- ". $sql);
                    $db->query($sql);
                }
            }
        }
        if ($mode == "reply") {
            $sql = "update tbl_bbs_list set b_step = b_step + 1 where b_ref = '$b_ref' and b_step > $b_step";
            $db->query($sql);
            $b_step = $b_step + 1;
            $b_level = $b_level + 1;

            $sql = "INSERT INTO tbl_bbs_list (subject, code, category, simple, writer, notice_yn, secure_yn, contents, hit, user_id, url, ufile1, rfile1, ufile2, rfile2, ufile3, rfile3, ufile4, rfile4, ufile5, rfile5, ufile6, rfile6, ip_address, onum, b_ref, b_step, b_level, recomm_yn, r_date)
                    VALUES ('$subject', '$code', '$category', '$simple', '$writer', '$notice_yn', '$secure_yn', '$contents', 0, '$user_id', '$url', '$ufile_1', '$rfile_1', '$ufile_2', '$rfile_2', '$ufile_3', '$rfile_3', '$ufile_4', '$rfile_4', '$ufile_5', '$rfile_5','$ufile_6', '$rfile_6', '" . $_SERVER["REMOTE_ADDR"] . "', '$b_ref', '$b_ref', '$b_step', '$b_level', '$recomm_yn', $r_date);";
            $query = $db->query($sql);

        } else if ($bbs_idx) {

            if ($reply != "") {
                $sql_s = " select l.user_id, m.user_email, m.user_name, l.r_date, l.contents, l.reply
                            from tbl_bbs_list l 
                            left outer join tbl_member m 
                            on l.user_id = m.user_id
                            where bbs_idx='$bbs_idx'";
                $list_query = $db->query($sql_s);
                $row_s = $list_query->getResultArray();

                if ($row_s['reply'] == "") {
                    if ($row_s['user_email'] != "") {

                        $code = "A03";
                        $user_mail = $row_s['user_email'];
                        $replace_text = "|||{{receive_name}}:::" . $row_s['user_name'] . "|||[date]:::" . $row_s['r_date'] . "|||[contents]:::" . nl2br(viewSQ($row_s['contents'])) . "|||[reply]:::" . nl2br(viewSQ($reply));
                        autoEmail($code, $user_mail, $replace_text);
                    }

                }

            }

            $sql = "update tbl_bbs_list set subject='$subject', subject_e='$subject_e', writer='$writer', seq='$seq', hit='$hit', simple='$simple', s_date='$s_date', email='$email', e_date='$e_date', secure_yn='$secure_yn', category='$category', category1='$category1', contents='$contents', notice_yn = '$notice_yn', reply = '$reply'";
			write_log("bbs_list update - ". $sql);
            if ($wdate) {
                $sql = $sql . ",  r_date = $r_date ";
            }
            $sql = $sql . ",  recomm_yn = '$recomm_yn', url='$url' where bbs_idx='$bbs_idx'";
            $query = $db->query($sql);

        } else {
            $total_sql = " select ifnull(max(bbs_idx),0)+1 as maxbbs_idx from tbl_bbs_list";
            $list_query = $db->query($total_sql);
            $row = $list_query->getResultArray();
            $b_ref = $row["maxbbs_idx"];

            $sql = "INSERT INTO tbl_bbs_list (subject, subject_e, seq, simple, s_date, e_date, code, category, category1, country_code, writer, notice_yn, secure_yn, contents, hit, user_id, url, ufile1, rfile1, ufile2, rfile2, ufile3, rfile3, ufile4, rfile4, ufile5, rfile5, ufile6, rfile6, ip_address, onum, b_ref, b_step, b_level, recomm_yn, email, r_date) VALUES ('$subject','$subject_e', '$seq', '$simple', '$s_date', '$e_date', '$code', '$category', '$category1',  '', '$writer', '$notice_yn', '$secure_yn', '$contents', $hit, '$user_id', '$url', '$ufile_1', '$rfile_1', '$ufile_2', '$rfile_2', '$ufile_3', '$rfile_3', '$ufile_4', '$rfile_4', '$ufile_5', '$rfile_5', '$ufile_6', '$rfile_6',  '" . $_SERVER["REMOTE_ADDR"] . "', '$b_ref', '$b_ref', 0, 0, '$recomm_yn', '$email', $r_date);";
            $query = $db->query($sql);
        }

        if ($db) {
            if ($bbs_idx) {
                $msg = "수정완료";
            } else {
                $msg = "등록완료";
            }
        } else {
            $msg = "등록오류";
        }

        die("{\"message\":\"$msg\"}");

    }

    public function view()
    {

        $r_code = $_GET['r_code'] ?? "";
        $Bbs = new JkBbs($r_code);

        $code_info = $Bbs->get_code_info($r_code);
        $category_arr = $Bbs->category_arr;

        $r_idx = $_GET['r_idx'] ?? "";
        if ($r_idx != "") {
            array_push($Bbs->list_field_arr, "r_flag");
            $view_data = $Bbs->get_view_data($r_idx);
            $file_arr = json_decode($view_data['r_file_list'], true);
            if (isset($file_arr)) {
                $file_cnt = count($file_arr);
            }
        } else {
            $view_data = array();
            foreach ($Bbs->new_default_arr as $key => $val)
                $view_data[$key] = $val;
        }

        $product_arr = $Bbs->get_product_arr();

        $sql_c = "select * from tbl_code where code_no = '{$view_data['r_category']}'  ";
        $db = Database::connect();
        $result_c = $db->query($sql_c);
        $row_c = $result_c->getRowArray();

        $fsql2 = "select * from tbl_bbs_cmt where r_idx = '" . $r_idx . "' order by r_cmt_idx desc";
        $fresult2 = $db->query($fsql2);
        $fresult2 = $fresult2->getRowArray();

        $data = [
            'code_info' => $code_info,
            'category_arr' => $category_arr,
            'view_data' => $view_data,
            'file_cnt' => $file_cnt ?? '',
            'file_arr' => $file_arr ?? [],
            'product_arr' => $product_arr,
            'fresult2' => $fresult2,
            'row_c' => $row_c
        ];
        return view('admin/_board/view', $data);
    }
}
