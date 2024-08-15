<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\JkBbs; 


class BoardController extends BaseController
{

    public function isBoardCategory($code)
    {    $this->db = db_connect();
        $builder = $this->db->table('tbl_bbs_config');
        $builder->select('is_category');
        $builder->where('board_code', $code);
        $result = $builder->get()->getRowArray();

        if (!$result || $result['is_category'] === '') {
            throw new \Exception("정상적으로 이용바랍니다."); // Thay bằng xử lý lỗi tùy chỉnh
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
            'scale' => $scale,
            'page' => $page,
            'Bbs' => $Bbs
        ];

        return view('admin/_board/list_rcode', $data); // Replace 'board_view' with the appropriate view file
    }


    public function check_auth($auth)
    {
        $session = session();
        return $session->has('member');
    }

    public function getBoardName($code)
    {
        $builder = $this->db->table('tbl_bbs_config');
        $builder->select('board_name');
        $builder->where('board_code', $code);
        $result = $builder->get()->getRowArray();

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
    
    }
