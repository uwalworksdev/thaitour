<?php

use App\Libraries\JkClass;

class JkCms extends JkClass
{

    public $table_name; // 기본 테이블 명
    public $idx_name; // 기본 식별자 필드 명

    public $input; // 입력값 ($_GET + $_POST + 추가변수)
    public $conf; // 클래스 자체 설정
    public $having_query;
    public $product_arr;

    public $sch_item_arr, $sch_arr, $sch_param, $sch_query; // 검색 정보
    public $sort_param, $sort_query; // 정렬 정보


    /*******************************************
     * 생성자 함수
     *******************************************/
    function __construct($r_code = "")
    {

        // 부모 클래스에서 기본 설정 실행
        parent::__construct();

        // 부모 클래스에서 사용할 기본 테이블 및 식별자 이름
        $this->table_name = "tbl_cms";
        //$this->log_table_name = "tbl_cms_log";
        $this->idx_name = "r_idx";

        // 삭제 조건
        $this->status_field = "r_status";
        $this->status_del = "D";
        $this->status_open = "Y";
        $this->status_close = "N";

        // 상태
        $this->status_arr = array();
        $this->status_arr['Y'] = "사용";
        $this->status_arr['N'] = "중지";
        $this->status_arr['D'] = "삭제";

        // 닫기 옵션
        $this->close_arr = array(
            "today" => "오늘 그만보기",
            "never" => "더이상 보이지 않기"
        );

        // 메뉴 지정
        if ($r_code == "") $r_code = $this->input['r_code'];
        if ($r_code == "") {
            echo "[CMS] 대상 게시판이 지정되지 않았습니다.";
            exit;
        }

        // 메뉴 설정
        $this->set_code($r_code);

        // 검색조건
        $this->sch_item_arr = array(
            "r_code", "mode",
            "sch_my", "sch_status", "sch_type",
            "sch_item", "sch_value"
        );
        $this->set_sch_info();

        // 정렬조건
        if (isset($this->input['sort_multi']) && $this->input['sort_multi'] != "") {
            $this->sort_query = " order by " . $this->input['sort_multi'];
            $this->sort_param = "sort_multi=" . $this->input['sort_multi'];
        } else if (isset($this->input['sort_item']) && $this->input['sort_item'] != "") {
            $this->sort_query = " order by " . $this->input['sort_item'] . " " . $this->input['sort_dir'];
            $this->sort_param = "sort_item=" . $this->input['sort_item'] . "&sort_dir=" . $this->input['sort_dir'];
        } else { // 기본 정렬 조건
            $this->sort_query = " order by r_idx desc ";
            $this->sort_param = "";
        }

        // 목록에서 전달할 항목
        $this->list_field_arr = array(
            "r_idx", //"r_status",
            "r_reg_date", "r_reg_m_idx",
            "r_mod_date", "r_mod_m_idx",
            "r_code", "r_order",
            "r_s_date", "r_e_date", "r_date", "r_name",
            "r_type", "r_title", "r_desc", "r_content",
            "r_url", "r_thumb", "r_file_code", "r_file_name", "r_file_list", "r_product_idx"
        );

        // 목록에서 join할 테이블 쿼리
        //$this->list_join_sql = " left join tbl_product_mst P on(P.r_product_idx=T.r_product_idx) ";

        // get_form_data 에서 join할 테이블 쿼리
        //$this->form_join_sql = " left join tbl_product_mst P on(P.r_product_idx=T.r_product_idx) ";

        // 신규 대상 항목
        /*$this->new_field_arr = array(
            //"r_status",
            "r_reg_date", "r_reg_m_idx",
            //"r_mod_date", "r_mod_m_idx",
            "r_booth", "r_title", "r_url", "r_cms"
        );*/

        // 신규 기본 설정
        $this->new_default_arr = array(
            "r_status" => "Y",
            "r_date" => date("Y-m-d H:i:s")
        );

        // 수정 대상 항목
        /*$this->mod_field_arr = array(
            //"r_status",
            //"r_reg_date", "r_reg_m_idx",
            "r_mod_date", "r_mod_m_idx",
            "r_booth", "r_title", "r_url", "r_cms"
        );*/


        // 입력값 검사 항목 (check_items() 와 form.js 에서 사용)
        $this->item_arr = array();

        /*$this->item_arr['field'] = array(
            "name"=>"" // 이름
            ,"type"=>"" // text, number, date, time, datetime, email, phone ...
            ,"min_len"=>"" // 문자열 최소 길이
            //,"max_len"=>"" // 문자열 최대 길이
            ,"min_val"=>"" // 숫자 최소 값
            ,"max_val"=>"" // 숫자 최대 값
            ,"required"=>"" // Y:필수 항목
            ,"pass_check"=>"" // Y:검사 예외 (pass_check_item = 'Y'인 경우)
        );*/

        $this->item_arr['r_code'] = array(
            "required" => "Y"
        );

        /*$this->item_arr['r_title'] = array(
            "required"=>"Y"
        );*/

        // DB 테이블에 설정된 내용을 item_arr 배열에 추가로 적용
        $this->item_arr = parent::get_table_info($this->table_name, $this->item_arr);
    }

    /*******************************************
     * 게시판 목록
     *******************************************/
    function get_code_arr()
    {

        if (!$this->code_arr) {
            $sql = "
					select r_code, r_title from tbl_cms_conf
					where r_status != 'D'
				";
            $this->code_arr = $this->Db->sqlSelectArray($sql, "r_code");
        }

        return $this->code_arr;
    }

    /*******************************************
     * 게시판 정보
     *******************************************/
    function get_code_info($r_code = "")
    {
        if ($r_code == "") $r_code = $this->r_code;

        if (!$this->code_info || $r_code != $this->code_info['r_code']) {
            if ($r_code != "") {
                $sql = "
						select * from tbl_cms_conf
						where r_status != 'D'
							and r_code='" . $r_code . "'
					";
                $this->code_info = $this->Db->sqlSelectOne($sql);
            }
        }

        return $this->code_info;
    }

    /*******************************************
     * 게시판 지정
     *******************************************/
    function set_code($r_code)
    {
        if ($r_code == "") {
            echo "[CMS] 대상 게시판이 지정되지 않았습니다.";
            exit;
        }

        if ($this->r_code != $r_code) {
            $this->r_code = $r_code;
            $this->input['r_code'] = $r_code;

            // 메뉴 정보
            if (!$this->code_info = $this->get_code_info($r_code)) {
                echo "[CMS] 대상 게시판의 정보를 읽을 수 없습니다22.";
                exit;
            }

            // 카테고리 목록
            $this->type_arr = json_decode($this->code_info['r_type_list'], true);

            // 템플릿 목록
            $this->template_arr = json_decode($this->code_info['r_template_list'], true);

            // 폴더 생성 위치
//            $this->data_path = $_SERVER['DOCUMENT_ROOT'] . "/data/cms/" . $r_code;
//            if (!is_dir($this->data_path))
//                mkdir($this->data_path, 0777);

            $this->set_sch_info();
        }

        return array("status" => "Y", "r_code" => $r_code, "this_code" => $this->r_code);
    }

    /*******************************************
     * 새로운 구분 추가
     *******************************************/
    function add_type_arr($new_key, $new_val)
    {
        $new_key = trim($new_key);
        $new_val = trim($new_val);

        if ($new_key == "")
            return array("msg" => "새로 추가하는 구분의 코드를 입력해 주세요.");

        if ($new_val == "")
            return array("msg" => "새로 추가하는 구분의 제목을 입력해 주세요.");

        foreach ($this->type_arr as $key => $val) {
            if ($key == $new_key)
                return array("msg" => "새로 추가하는 구분의 코드와 동일한 코드가 있습니다. 다른 값을 입력해 주세요.");

            if ($val == $new_val)
                return array("msg" => "새로 추가하는 구분의 제목과 동일한 제목이 있습니다. 다른 값을 입력해 주세요.");
        }

        $this->type_arr[$new_key] = $new_val;
        ksort($this->type_arr);
        $r_type_list = json_encode($this->type_arr);

        $sql = "
				update tbl_cms_conf set
					r_type_list = \"" . $this->Db->escape_str($r_type_list) . "\"
				where r_code='" . $this->r_code . "'
			";
        $this->Db->sqlQuery($sql);

        return "OK";
    }


    /*******************************************
     * 상품 목록
     *******************************************/
    function get_product_arr()
    {

        if (!$this->product_arr) {
            $sql = "
					select
						product_idx,
						product_name,
						is_view
					from tbl_product_mst
				";
            $this->product_arr = $this->Db->sqlSelectArray($sql, "product_idx");
        }

        return $this->product_arr;
    }

    /*******************************************
     * 권한 검사
     *******************************************/
    function check_perm($r_idx, $r_act)
    {

        // 관리자
        if ($this->is_admin == "Y" || $_SESSION['member']['level'] = "1")
            return array("status" => "Y");

        // 대상이 지정된 경우
        if ($r_idx != "") {
            // 대상 정보
            $info_data = $this->get_info_data($r_idx);

            // 작성자
            //if($info_data['r_reg_m_idx'] != "" && $info_data['r_reg_m_idx'] == $this->Auth->auth_idx)
            //	return array("status"=>"Y");
        }

        // 요청 작업에 대한 권한 검사

        // 기본 정책에 따라 허용/불허
        return array("msg" => "권한이 없습니다.-" . $this->is_admin);
    }

    /*******************************************
     * 검색조건 설정
     *******************************************/
    function set_sch_info($sch_item_arr = "")
    {

        if ($sch_item_arr == "") $sch_item_arr = $this->sch_item_arr;
        $cnt = count($sch_item_arr);

        $this->sch_arr = array();
        $this->sch_param = "";
        $param_arr = array();
        for ($i = 0; $i < $cnt; $i++) {
            $item = $sch_item_arr[$i];
            $val = trim($this->input[$item] ?? '');
            if ($val == "")
                continue;

            $this->sch_arr[$item] = $val;
            $param_arr[] = $item . "=" . $val;
        }
        if (@count($param_arr) > 0)
            $this->sch_param = implode("&", $param_arr);

        // 검색 쿼리
        $where_arr = array();
        $having_arr = array();

        // 콘텐츠 지정
        $where_arr[] = " T.r_code = '" . $this->r_code . "' ";

        // 삭제된 대상 제외
        if (isset($this->status_field) && isset($this->status_del))
            $where_arr[] = " T." . $this->status_field . " != '" . $this->status_del . "' ";

        if (isset($this->input['mode']) && $this->input['mode'] == "open")
            $where_arr[] = " T.r_s_date <= now() and T.r_e_date >= now() ";
        else if (isset($this->input['mode']) && $this->input['mode'] == "close")
            $where_arr[] = " T.r_e_date < now() ";

        if (isset($this->input['sch_my']) && $this->sch_arr["sch_my"] == "Y")
            $where_arr[] = " T.r_reg_m_idx = '" . $this->Auth->auth_idx . "' ";

        if (isset($this->input['sch_status']) && $this->sch_arr["sch_status"] != "")
            $where_arr[] = " T.r_status = '" . $this->sch_arr["sch_status"] . "' ";

        if (isset($this->input['sch_type']) && $this->sch_arr["sch_type"] != "")
            $where_arr[] = " T.r_type = '" . $this->sch_arr["sch_type"] . "' ";

        if (isset($this->input['sch_value']) && $this->sch_arr["sch_value"] != "") {
            // 단일 항목 검색 (select)
            if ($this->sch_arr["sch_item"] != "") {
                if ($this->sch_arr["sch_item"] == "all") {
                    $where_arr[] = "
							(
								T.r_name like '%" . $this->sch_arr["sch_value"] . "%'
								or T.r_title like '%" . $this->sch_arr["sch_value"] . "%'
								or T.r_desc like '%" . $this->sch_arr["sch_value"] . "%'
								or T.r_content like '%" . $this->sch_arr["sch_value"] . "%'
							)
						";
                } else {
                    $where_arr[] = $this->sch_arr["sch_item"] . " like '%" . $this->sch_arr["sch_value"] . "%' ";
                }
            }

            /*
            // 복수 항목 검색 (checkbox)
            $tmp = array();
            if($this->sch_arr["sch_title"] == "Y")
                $tmp[] = " T.r_title like '%".$this->sch_arr["sch_value"]."%' ";

            if(count($tmp) > 0)
                $where_arr[] = "( ".implode(" or ", $tmp)." )";
            */
        }

        // 검색 쿼리
        if (@count($where_arr) > 0) {
            $this->where_query = " where " . implode(" and ", $where_arr);
        }

        if (@count($having_arr) > 0)
            $this->having_query = " having " . implode(" and ", $having_arr);

        $this->sch_query = $this->where_query . $this->having_query;
    }

    /*******************************************
     * 변경 내역 기록
     *******************************************/
    function add_log($r_idx)
    {

        //return parent::add_log($r_idx);
    }

    /*******************************************
     * 조건에 해당하는 목록
     *******************************************/
    function get_arr($param)
    {
        $sql = "
				select
					*
				from " . $this->table_name . "
				where r_code='" . $this->r_code . "'
					and r_status = 'Y'
			";

        if ($param['where'] != "")
            $sql .= " and " . $param['where'] . " ";

        if ($param['order'] != "")
            $sql .= " " . $param['order'] . " ";

        $arr = $this->Db->sqlSelect($sql);

        if ($param['key'] != "")
            $arr = $this->Lib->arr2arr($arr, $param['key']);

        return $arr;
    }

    /*******************************************
     * 목록에 해당하는 총 갯수 반환
     *******************************************/
    function get_total_cnt()
    {
        $sql = "
				select
					count(*) cnt
				from " . $this->table_name . " T
			";
        $sql .= $this->sch_query;

        $row = $this->Db->sqlSelectOne($sql);
        return $row['cnt'];
    }

    /*******************************************
     * 목록에 해당하는 rows 결과 반환
     *******************************************/
    function get_list($start = "", $scale = "")
    {

        // 대상 범위
        if ($start == "") $start = $this->input['start'];
        if ($scale == "") $scale = $this->input['scale'];

        // 추가 항목
        $sub_sql = "";

        // 상태
        $sub_sql .= ", case T.r_status ";
        foreach ($this->status_arr as $key => $val)
            $sub_sql .= " when '" . $key . "' then '" . $val . "' ";
        $sub_sql .= " else '' end as str_status ";

        $this->list_sub_sql = $sub_sql;

        // 목록에서 전달할 항목
        if ($this->list_field_arr != "") $item_list = implode(", ", $this->list_field_arr);
        if ($item_list == "") $item_list = "T.*";

        // 목록 가져오기
        $sql = "
				select
					" . $item_list . "
					" . $this->list_sub_sql . "
				from " . $this->table_name . " T
				" . $this->list_join_sql . "
			";
        $sql .= $this->sch_query;
        $sql .= $this->sort_query;

        // 페이지 당 건수
        if ($scale > 0) {
            if ($start == "" || $start < 0) $start = 0;
            $sql .= " limit $start, $scale ";
        }

        $this->Lib->log_input("************** sqlQuery : " . $sql);
        $rows = $this->Db->sqlSelect($sql);
        return $rows;
    }

    /*******************************************
     * 목록 정보를 ajax로 전달하기
     * $field_arr : get_list() 결과에서 항목을 전달할 지정하는 경우 설정
     *******************************************/
    function ajax_get_list($field_arr = "")
    {

        return parent::ajax_get_list($field_arr);
    }

    /*******************************************
     * 대상의 기존 정보 가져오기
     *******************************************/
    function get_form_data($r_idx = "")
    {

        // 추가 항목
        $sub_sql = "";

        // 상태
        $sub_sql .= ", case T.r_status ";
        foreach ($this->status_arr as $key => $val)
            $sub_sql .= " when '" . $key . "' then '" . $val . "' ";
        $sub_sql .= " else '' end as str_status ";

        $this->form_sub_sql = $sub_sql;

        // 목록 가져오기
        $form_data = array();

        if ($r_idx != "") {
            // 기존 정보 재사용
            if (isset($this->form_data[$this->idx_name])){
                if ($r_idx == $this->form_data[$this->idx_name])
                    return $this->form_data;
            }

            if ($this->where != "")
                $where = $this->where . " and T." . $this->idx_name . " = '" . $r_idx . "' ";
            else
                $where = " where T." . $this->idx_name . " = '" . $r_idx . "' ";

            // 기존 정보 가져오기
            $sql = "
					select
						T.*
						" . $this->form_sub_sql . "
					from " . $this->table_name . " T
					" . $this->form_join_sql . "
					" . $where . "
				";
            if (!$form_data = $this->Db->sqlSelectOne($sql))
                $this->Lib->alert_return("", "기존 정보를 읽을 수 없습니다.", "EXIT");
        }

        $this->{$this->idx_name} = $r_idx;
        $this->form_data = $form_data;


        // 상태 검사
        if (isset($this->status_field)) {
            if ($form_data[$this->status_field] == $this->status_del)
                $this->Lib->alert_return("", "삭제된 대상입니다.", "EXIT");
        }

        return $form_data;
    }

    /*******************************************
     * 대상의 정보를 ajax로 전달하기
     *******************************************/
    function ajax_form_data($r_idx = "")
    {

        return parent::ajax_form_data($r_idx);
    }

    /*******************************************
     * 대상의 추가 정보 가져오기
     *******************************************/
    function get_extra_data($r_idx = "")
    {

        /*
        // 댓글 목록
        $sql = "
            select
                *
            from tbl_cms_cmt
            where r_status != 'D'
                and r_idx='".$r_idx."'
            order by r_cmt_idx desc
        ";
        $cmt_arr = $this->Db->sqlSelect($sql);

        return array("cmt_arr"=>$cmt_arr);
        */
    }

    /*******************************************
     * 대상의 기존 정보 가져오기
     ******************************************
     * @param string $r_idx
     * @param string $hit_yn
     */
    function get_view_data($r_idx = "", $hit_yn = "")
    {

        return parent::get_view_data($r_idx);
    }

    /*******************************************
     * 대상의 정보를 ajax로 전달하기
     *******************************************/
    function ajax_view_data($r_idx = "")
    {

        return parent::ajax_view_data($r_idx);
    }


    /*******************************************
     * 입력값 검사 (정리한 값을 반영하기 위해 Call by Reference 적용)
     *******************************************/
    function check_items($cmd, &$param, $field_arr, $check_arr = "")
    {

        $check = parent::check_items($cmd, $param, $field_arr, $check_arr);
        if ($check != "OK") return $check;

        return "OK";
    }

    /*******************************************
     * 신규 등록
     *******************************************/
    function new_ok($param = "")
    {

        // 입력 정보
        if ($param == "") $param = $this->input;

        // 권한 검사
        //$check = $this->check_perm("", "new");
        //if($check['status'] != "Y") return $check;

        // 대상 항목 및 값
        if ($this->new_field_arr)
            $field_arr = $this->new_field_arr;
        else
            $field_arr = $this->Db->sqlFieldArr($this->table_name); // 테이블의 필드명 배열

        // 비대상 항목 제외
        $except_arr = array();
        //$except_arr[] = "";
        if ($except_arr) $field_arr = $this->Lib->array_diff($field_arr, $except_arr); // 비대상 필드 제외

        // 기본 설정
        foreach ($this->new_default_arr as $key => $val) {
            $param[$key] = $val;
        }

        // 입력값 검사
        $check = $this->check_items("new_ok", $param, $field_arr);
        if ($check != "OK") return $check;

        // 새로운 구분 추가
        if ($param['r_type'] == "add_new_type") {
            $check = $this->add_type_arr($param['new_type_key'], $param['new_type_val']);
            if ($check != "OK") return $check;

            $param['r_type'] = $param['new_type_key'];
        }

        // 날짜 및 시간 지정
        if ($param['r_s_date_d'] == "")
            $param['r_s_date'] = "";
        else
            $param['r_s_date'] = $param['r_s_date_d'] . " " . sprintf("%02d:%02d:%02d", $param['r_s_date_h'], $param['r_s_date_i'], $param['r_s_date_s']);

        if ($param['r_e_date_d'] == "") {
            $param['r_e_date'] = "";
        } else {
            if ($param['r_e_date_h'] == "" && $param['r_e_date_i'] == "" && $param['r_e_date_s'] == "")
                $param['r_e_date'] = $param['r_e_date_d'] . " 23:59:59";
            else
                $param['r_e_date'] = $param['r_e_date_d'] . " " . sprintf("%02d:%02d:%02d", $param['r_e_date_h'], $param['r_e_date_i'], $param['r_e_date_s']);
        }

        if ($param['r_date_d'] != "")
            $param['r_date'] = $param['r_date_d'] . " " . sprintf("%02d:%02d:%02d", $param['r_date_h'], $param['r_date_i'], $param['r_date_s']);
        else
            $param['r_date'] = date("Y-m-d H:i:s");


        // 썸네일
        if ($_FILES['file_thumb']['name'] != "") {
            $mt = explode(" ", microtime());
            $param['r_thumb'] = date("YmdHis") . "_" . substr($mt[0], 2);
        }


        // 파일 목록
        $new_arr = array();

        // 새 파일 추가
        $new_file_cnt = count($_FILES['files']['name']);
        for ($i = 0; $i < $new_file_cnt; $i++) {
            if ($_FILES['files']['name'][$i] == "") continue;

            $tmp = array();
            $tmp['name'] = $_FILES['files']['name'][$i];
            $tmp['type'] = $_FILES['files']['type'][$i];
            $tmp['size'] = $_FILES['files']['size'][$i];

            $tmp['title'] = $_POST['file_title'][$i];
            $tmp['url'] = $_POST['file_url'][$i];
            $tmp['id'] = $_POST['file_id'][$i];
            $tmp['desc'] = $_POST['file_desc'][$i];

            $mt = explode(" ", microtime());
            $tmp['code'] = date("YmdHis") . "_" . substr($mt[0], 2);
            $new_arr[] = $tmp;
        }

        $param['r_file_code'] = $new_arr[0]['code'];
        $param['r_file_name'] = $new_arr[0]['name'];
        $param['r_file_list'] = json_encode($new_arr);

        // 컨텐츠의 첫번째 이미지 사용
        if ($this->code_info['r_use_content_img'] == "Y") {

            // 새 파일 복사
            $str_s = "/data/editor/";
            $pos_s = strpos($param['r_content'], $str_s);
            if ($pos_s >= 0) {
                $pos_s += strlen($str_s);
                $str_e = "\"";
                $pos_e = strpos($param['r_content'], $str_e, $pos_s);
                $param['r_file_name'] = urldecode(substr($param['r_content'], $pos_s, $pos_e - $pos_s));

                if ($param['r_file_name'] != "") {
                    $mt = explode(" ", microtime());
                    $param['r_file_code'] = date("YmdHis") . "_" . substr($mt[0], 2);

                    // 에디터 폴더에서 게시판 폴더로 복사
                    //copy($_SERVER['DOCUMENT_ROOT']."/data/editor/".$param['r_file_name'], $data_path."/".$param['r_file_code']);
                }
            }
        }

        // 추가 항목
        //$param['r_status'] = "Y";
        $param['r_reg_date'] = date("Y-m-d H:i:s");
        $param['r_reg_m_idx'] = $this->Auth->auth_idx;


        // 대상 설정 및 쿼리 생성
        $arr = $this->Lib->array_filter($field_arr, $param); // 입력값에서 지정한 필드만 선별
        $query = $this->Db->sqlInsertQuery($this->table_name, $arr); // Insert 쿼리 생성

        // 쿼리 실행
        $this->Db->sqlQuery($query);
        $this->Lib->log_input("************** sqlQuery (" . $this->Db->error() . ") : " . $query);

        // 등록된 식별 번호
        $r_idx = $this->Db->sqlLastId();
        $this->{$this->idx_name} = $r_idx;

        // 폴더 생성
        $data_path = $this->data_path . "/" . $r_idx;
        if (!file_exists($data_path)) mkdir($data_path, 0755);

        // 썸네일 저장
        if ($_FILES['file_thumb']['name'] != "" && $param['r_thumb'] != "") {
            //move_uploaded_file($_FILES['file_thumb']['tmp_name'], $data_path."/".$param['r_thumb']);

            $tmp = explode("x", $this->code_info['r_use_thumb']);
            $this->Lib->thumb_resize($_FILES['file_thumb']['tmp_name'], $data_path . "/" . $param['r_thumb'], $tmp[0], $tmp[1]);
        }

        // 파일 저장
        $new_cnt = count($new_arr);
        for ($i = 0; $i < $new_cnt; $i++) {
            move_uploaded_file($_FILES['files']['tmp_name'][$i], $data_path . "/" . $new_arr[$i]['code']);
        }

        // 컨텐츠의 첫번째 이미지 사용
        if ($this->code_info['r_use_content_img'] == "Y") {
            // 에디터 폴더에서 게시판 폴더로 복사
            if ($param['r_file_name'] != "" && $param['r_file_code'] != "")
                copy($_SERVER['DOCUMENT_ROOT'] . "/data/editor/" . $param['r_file_name'], $data_path . "/" . $param['r_file_code']);
        }

        // 변경 내역 기록
        $this->add_log($r_idx);

        // 저장된 정보 전송
        unset($this->form_data); // 새로 가져오기 위해 리셋
        $form_data = $this->get_form_data($r_idx);

        $return = array("status" => "Y", "msg" => "등록되었습니다.", $this->idx_name => $r_idx, "form_data" => $form_data);
        $return = json_encode($return);
        $this->Lib->ajax_return($return);
    }

    /*******************************************
     * 수정
     *******************************************/
    function mod_ok($param = "")
    {

        // 입력값
        if ($param == "") $param = $this->input;

        // 대상 식별자
        $r_idx = $param[$this->idx_name];
        if ($r_idx == "")
            return array("msg" => "대상이 지정되지 않았습니다.");

        if (!$form_data = $this->get_form_data($r_idx))
            return array("msg" => "대상 정보를 읽을 수 없습니다.");

        // 권한 검사
        //$check = $this->check_perm($r_idx, "mod");
        //if($check['status'] != "Y") return $check;

        // 상태 검사
        if (isset($this->status_field) && isset($this->status_del)) {
            if ($form_data[$this->status_field] == $this->status_del)
                return array("msg" => "삭제된 대상입니다.");
        }

        // 대상 항목 선정
        $field_arr = $this->mod_field_arr;
        if (!$field_arr) $field_arr = $this->Db->sqlFieldArr($this->table_name); // 테이블의 필드 배열

        // 비대상 항목 제외
        $except_arr = array(
            "r_idx",
            "r_reg_date", "r_reg_m_idx", "r_view_cnt"
        );

        if ($param['r_status'] == "") $except_arr[] = "r_status";

        if ($except_arr) $field_arr = $this->Lib->array_diff($field_arr, $except_arr); // 수정불가 항목 제외

        // 새로운 구분 추가
        if ($param['r_type'] == "add_new_type") {
            $check = $this->add_type_arr($param['new_type_key'], $param['new_type_val']);
            if ($check != "OK") return $check;

            $param['r_type'] = $param['new_type_key'];
        }

        // 입력값 검사
        $check = $this->check_items("mod_ok", $param, $field_arr);
        if ($check != "OK")
            return $check;

        // 날짜 및 시간 지정
        if ($param['r_s_date_d'] == "")
            $param['r_s_date'] = "";
        else
            $param['r_s_date'] = $param['r_s_date_d'] . " " . sprintf("%02d:%02d:%02d", $param['r_s_date_h'], $param['r_s_date_i'], $param['r_s_date_s']);

        if ($param['r_e_date_d'] == "") {
            $param['r_e_date'] = "";
        } else {
            if ($param['r_e_date_h'] == "" && $param['r_e_date_i'] == "" && $param['r_e_date_s'] == "")
                $param['r_e_date'] = $param['r_e_date_d'] . " 23:59:59";
            else
                $param['r_e_date'] = $param['r_e_date_d'] . " " . sprintf("%02d:%02d:%02d", $param['r_e_date_h'], $param['r_e_date_i'], $param['r_e_date_s']);
        }

        if ($param['r_date_d'] != "")
            $param['r_date'] = $param['r_date_d'] . " " . sprintf("%02d:%02d:%02d", $param['r_date_h'], $param['r_date_i'], $param['r_date_s']);
        else
            $param['r_date'] = $form_data['r_reg_date'];

        // 폴더 생성
        $data_path = $this->data_path . "/" . $r_idx;
        if (!file_exists($data_path)) mkdir($data_path, 0755);

        // 기존 썸네일 삭제
        if ($form_data['r_thumb'] != "") {
            $param['r_thumb'] = $form_data['r_thumb'];
            if ($param['thumb_del'] == "Y") {
                $param['r_thumb'] = "";
                if (file_exists($data_path . "/" . $form_data['r_thumb']))
                    unlink($data_path . "/" . $form_data['r_thumb']);
            }
        }

        // 새 썸네일 등록
        if ($_FILES['file_thumb']['name'] != "") {
            // 기존 썸네일 삭제
            if ($form_data['r_thumb'] != "") {
                if (file_exists($data_path . "/" . $form_data['r_thumb']))
                    unlink($data_path . "/" . $form_data['r_thumb']);
            }

            $mt = explode(" ", microtime());
            $param['r_thumb'] = date("YmdHis") . "_" . substr($mt[0], 2);
            //move_uploaded_file($_FILES['file_thumb']['tmp_name'], $data_path."/".$param['r_thumb']);

            $tmp = explode("x", $this->code_info['r_use_thumb']);
            $this->Lib->thumb_resize($_FILES['file_thumb']['tmp_name'], $data_path . "/" . $param['r_thumb'], $tmp[0], $tmp[1]);
        }

        // 파일 목록
        $tmp_arr = array();

        // 기존 파일
        if ($form_data['r_file_list'] != "") {
            $old_arr = json_decode($form_data['r_file_list'], true);
            $old_cnt = count($old_arr);

            $del_arr = $_POST['file_del'];
            for ($i = 0; $i < $old_cnt; $i++) {
                $tmp = $old_arr[$i];
                $old_code = $tmp['code'];

                $tmp['title'] = $_POST['file_title_' . $old_code];
                $tmp['url'] = $_POST['file_url_' . $old_code];
                $tmp['id'] = $_POST['file_id_' . $old_code];
                $tmp['desc'] = $_POST['file_desc_' . $old_code];

                // 새 파일로 변경
                if ($_FILES['file_' . $old_code]['name'] != "") {
                    $tmp['name'] = $_FILES['file_' . $old_code]['name'];
                    $tmp['type'] = $_FILES['file_' . $old_code]['type'];
                    $tmp['size'] = $_FILES['file_' . $old_code]['size'];

                    if (file_exists($data_path . "/" . $old_code))
                        unlink($data_path . "/" . $old_code);

                    // 새 이름으로 파일 저장
                    $mt = explode(" ", microtime());
                    $new_code = date("YmdHis") . "_" . substr($mt[0], 2);
                    move_uploaded_file($_FILES['file_' . $old_code]['tmp_name'], $data_path . "/" . $new_code);
                    $tmp['code'] = $new_code;
                } // 파일 삭제
                else if (@in_array($old_code, $del_arr)) {
                    if (file_exists($data_path . "/" . $old_code))
                        unlink($data_path . "/" . $old_code);

                    continue;
                }

                $tmp_arr[$old_code] = $tmp;
            }
        }

        // 새 파일 추가
        $new_file_cnt = count($_FILES['files']['name']);
        for ($i = 0; $i < $new_file_cnt; $i++) {
            if ($_FILES['files']['name'][$i] == "") continue;

            $tmp = array();
            $tmp['name'] = $_FILES['files']['name'][$i];
            $tmp['type'] = $_FILES['files']['type'][$i];
            $tmp['size'] = $_FILES['files']['size'][$i];

            $tmp['title'] = $_POST['file_title'][$i];
            $tmp['url'] = $_POST['file_url'][$i];
            $tmp['id'] = $_POST['file_id'][$i];
            $tmp['desc'] = $_POST['file_desc'][$i];

            $mt = explode(" ", microtime());
            $tmp['code'] = date("YmdHis") . "_" . substr($mt[0], 2);

            // 파일 저장
            move_uploaded_file($_FILES['files']['tmp_name'][$i], $data_path . "/" . $tmp['code']);
            $tmp_arr["new_" . $i] = $tmp;
        }

        // 순서 정리
        $ord_arr = $_POST['file_ord'];
        $ord_cnt = count($ord_arr);

        $new_arr = array();
        if ($ord_cnt >= count($tmp_arr)) {
            for ($i = 0, $new = 0; $i < $ord_cnt; $i++) {
                $ord = $ord_arr[$i];
                if ($ord == "new") {
                    if ($tmp_arr["new_" . $new])
                        $new_arr[] = $tmp_arr["new_" . $new]; // 새 파일

                    $new++;
                } else {
                    if ($tmp_arr[$ord])
                        $new_arr[] = $tmp_arr[$ord]; // 삭제되지 않은 기존 파일
                }
            }
        } else {
            foreach ($tmp_arr as $key => $tmp)
                $new_arr[] = $tmp;
        }

        $param['r_file_code'] = $new_arr[0]['code'];
        $param['r_file_name'] = $new_arr[0]['name'];
        $param['r_file_list'] = json_encode($new_arr);

        // 컨텐츠의 첫번째 이미지 사용
        if ($this->code_info['r_use_content_img'] == "Y") {

            // 기존 파일 삭제
            if ($form_data['r_file_code'] != "")
                unlink($data_path . "/" . $form_data['r_file_code']);

            // 새 파일 복사
            $str_s = "/data/editor/";
            $pos_s = strpos($param['r_content'], $str_s);
            if ($pos_s >= 0) {
                $pos_s += strlen($str_s);
                $str_e = "\"";
                $pos_e = strpos($param['r_content'], $str_e, $pos_s);
                $param['r_file_name'] = urldecode(substr($param['r_content'], $pos_s, $pos_e - $pos_s));

                if ($param['r_file_name'] != "") {
                    $mt = explode(" ", microtime());
                    $param['r_file_code'] = date("YmdHis") . "_" . substr($mt[0], 2);

                    // 에디터 폴더에서 게시판 폴더로 복사
                    copy($_SERVER['DOCUMENT_ROOT'] . "/data/editor/" . $param['r_file_name'], $data_path . "/" . $param['r_file_code']);
                }
            }
        }

        // 현재 시간
        $now = date("Y-m-d H:i:s");

        // 추가 항목
        $param['r_mod_date'] = date("Y-m-d H:i:s");
        $param['r_mod_m_idx'] = $this->Auth->auth_idx;

        // 대상 설정 및 쿼리 생성
        $arr = $this->Lib->array_filter($field_arr, $param); // 입력값에서 지정한 필드만 선별
        $query = $this->Db->sqlUpdateQuery($this->table_name, $arr, " where " . $this->idx_name . "='$r_idx' ", $extra); // Update 쿼리 생성

        // 쿼리 실행
        $this->Db->sqlQuery($query);

        // 변경 내역 기록
        $this->add_log($r_idx);

        // 저장된 정보
        unset($this->form_data); // 새로 가져오기 위해 리셋
        $form_data = $this->get_form_data($r_idx);

        // 결과 전송
        $return = array("status" => "Y", "msg" => "저장되었습니다.", $this->idx_name => $r_idx, "form_data" => $form_data);
        $return = json_encode($return);
        $this->Lib->ajax_return($return);
    }

    /*******************************************
     * 삭제하기
     *******************************************/
    function del_ok($r_idx = "", $_delete = "")
    {

        return parent::del_ok($r_idx, $_delete);
    }

    /*******************************************
     * 저장하기
     *******************************************/
    function regist($param = "")
    {
        // 입력 정보
        if ($param == "") $param = $this->input;
        $r_idx = $param[$this->idx_name];
        $cmd = $param['cmd'];

        // 사용자 정보 저장
        if ($r_idx == "" || $cmd == "new_ok") { // 신규 등록
            $return = $this->new_ok($param);
            if ($return['status'] != "Y")
                return $return;

            $r_idx = $this->{$this->idx_name};
        } else {
            $return = $this->mod_ok($param);
            if ($return['status'] != "Y")
                return $return;
        }

        return array("status" => "Y", "msg" => "저장되었습니다.", $this->idx_name => $r_idx);
    }

    /*******************************************
     * 첨부파일 다운로드
     *******************************************/
    function get_file($param = "")
    {
        if ($param == "") $param = $this->input;

        if (!$r_idx = $param['r_idx'])
            return array("msg" => "대상 콘텐츠가 지정되지 않았습니다.");

        if (!$form_data = $this->get_form_data($r_idx))
            return array("msg" => "콘텐츠 정보를 읽을 수 없습니다.");

        if (!$file_code = $param['file_code'])
            return array("msg" => "대상 파일이 지정되지 않았습니다.");

        $file_arr = json_decode($form_data['r_file_list'], true);
        $file_cnt = count($file_arr);
        for ($i = 0; $i < $file_cnt; $i++) {
            $tmp = $file_arr[$i];
            if ($tmp['code'] == $file_code) {
                $param = array();
                $param['file'] = $this->data_path . "/" . $r_idx . "/" . $tmp['code'];
                $param['name'] = $tmp['name'];
                $param['type'] = $tmp['type'];
                $param['mode'] = "download";
                return parent::get_file($param);
            }
        }

        return array("msg" => "대상 파일이 올바르지 않습니다.");
    }

    /*******************************************
     * 이전 콘텐츠
     *******************************************/
    function get_prev_data($r_idx)
    {

        // 목록에서 전달할 항목
        if ($this->list_field_arr != "") $item_list = implode(", ", $this->list_field_arr);
        if ($item_list == "") $item_list = "T.*";

        // 목록 가져오기
        $sql = "
				select
					" . $item_list . "
					" . $this->list_sub_sql . "
				from " . $this->table_name . " T
				" . $this->list_join_sql . "
			";
        $sql .= $this->sch_query;
        $sql .= " and T." . $this->idx_name . " > '" . $r_idx . "' ";
        $sql .= " order by " . $this->idx_name . " asc limit 1 ";

        $prev = $this->Db->sqlSelectOne($sql);
        return $prev;
    }

    /*******************************************
     * 다음 콘텐츠
     *******************************************/
    function get_next_data($r_idx)
    {

        // 목록에서 전달할 항목
        if ($this->list_field_arr != "") $item_list = implode(", ", $this->list_field_arr);
        if ($item_list == "") $item_list = "T.*";

        // 목록 가져오기
        $sql = "
				select
					" . $item_list . "
					" . $this->list_sub_sql . "
				from " . $this->table_name . " T
				" . $this->list_join_sql . "
			";
        $sql .= $this->sch_query;
        $sql .= " and T." . $this->idx_name . " < '" . $r_idx . "' ";
        $sql .= " order by " . $this->idx_name . " desc limit 1 ";

        $prev = $this->Db->sqlSelectOne($sql);
        return $prev;
    }

}