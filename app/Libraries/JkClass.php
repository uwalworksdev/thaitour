<?php

namespace App\Libraries;

class JkClass
{

    public $Config, $Lib, $Db; // 기본 클래스

    public $is_admin; // 관리자 여부 (Y)

    public $table; // 테이블 명 목록
    public $log_table; // 로그 테이블 명 목록

    public $table_name; // 기본 테이블 명
    public $log_table_name; // 로그 테이블 명
    public $idx_name; // 기본 식별자 필드 명

    public $input; // 입력값 ($_GET + $_POST + 추가변수)
    public $conf; // 클래스 자체 설정

    public $r_idx; // 식별자 값
    public $form_data; // 대상 정보
    public $file_path; // 파일 저장 위치 (시스템 절대 경로)

    public $sch_item_arr, $sch_arr, $sch_param, $sch_query; // 검색 정보
    public $sort_param, $sort_query; // 정렬 정보

    public $list_field_arr; // 목록에서 전달할 항목
    public $list_sub_sql; // get_list 함수의 추가 쿼리
    public $list_join_sql; // get_list 함수의 join 쿼리

    public $form_sub_sql; // get_form_data 함수의 추가 쿼리
    public $form_join_sql; // get_form_data 함수의 join 쿼리

    public $new_field_arr; // 신규 대상 항목
    public $new_except_arr; // 신규 예외 항목
    public $new_default_arr; // 신규 기본 설정

    public $mod_field_arr; // 수정 대상 항목
    public $mod_except_arr; // 수정 예외 항목

    public $item_arr; // 입력값 검사 항목

    public $where; // 고정 식별 정보

    public $category_arr;
    public $Auth;
    public $r_code;
    public $code_info ;

    /*******************************************
     * 생성자 함수
     *******************************************/
    function __construct()
    {

        global $_SERVER; // global 처리가 불필요하지만, 웹이 아닌 환경을 위해 적용한다.
        $this->SERVER = $_SERVER;

        // 기본 클래스 (링크)
        // global $Config, $Db, $Lib, $Auth;
        $this->Config = new Config();
        $this->Db = new Db();
        $this->Lib = new Lib();
        $this->Auth = new Auth();

        // 관리자 여부
        $this->is_admin = ($this->Auth->auth_level == "1") ? "Y" : "N";
        //$this->is_admin = "Y"; // 테스트 용

        // 시스템 작업 -> 관리자 권한 부여
        if ($this->Config->is_system == "Y")
            $this->is_admin = "Y";

        // DB 테이블 설정
        $this->table = $this->Config->table;
        $this->log_table = $this->Config->log_table;

        // 기본 설정
        $this->table_name = ""; // 테이블 명
        $this->idx_name = ""; // PK 필드 명

        // 삭제 조건
        //$this->status_field = "r_status";
        //$this->status_del = "D";


        // 입력값 (참조)
        $this->input = &$this->Config->input;

        // 목록 페이지 파라미터 정리 (page -> start)
        if (isset($this->input['scale'])){
            if ($this->input['scale'] > 0) {
                if ($this->input['page'] > 0)
                    $this->input['start'] = ($this->input['page'] - 1) * $this->input['scale'];

                if ($this->input['start'] == "")
                    $this->input['start'] = 0;
            }
        }

        // 첨부파일 저장 위치
        //$this->data_path = $this->Config->DATA;


        // 검색조건
        $this->sch_item_arr = array();

        // 정렬조건
        $this->sort_query = "";
        $this->sort_param = "";

        // 기본 정보 항목
        $this->info_field_arr = array();

        // 목록에서 전달할 항목
        $this->list_field_arr = array();

        // 목록에서 join할 테이블 쿼리
        //$this->list_join_sql = " left join ".$this->table['member']." M on(M.r_m_idx=T.r_m_idx) ";

        // get_form_data 에서 join할 테이블 쿼리
        //$this->form_join_sql = " left join ".$this->table['member']." M on(M.r_m_idx=T.r_m_idx) ";

        // 신규 대상 항목
        $this->new_field_arr = array();

        // 신규 기본 설정
        $this->new_default_arr = array(
            //"r_ver"=>1
            //,"r_status"=>"Y"
        );

        // 수정 대상 항목
        $this->mod_field_arr = array();


        // 입력값 검사 항목
        $this->item_arr = array();
        /*$this->item_arr[] = array(
            "field"=>"", // 필드명
            "name"=>"", // 이름
            ,"type"=>"" // text, number, date, time, datetime, email, phone ...
            "min_len"=>"", // 문자열 최소 길이
            "max_len"=>"", // 문자열 최대 길이
            "min_val"=>"", // 숫자 최소 값
            "max_val"=>"", // 숫자 최대 값
            "required"=>"", // Y:필수 항목
            "pass_check"=>"" // Y:검사 예외 (pass_check_item = 'Y'인 경우)
        );*/

        $this->r_code = '';
        $this->code_info = '';
    }

    /*******************************************
     * 테이블 설정 가져오기
     *******************************************/
    function get_table_info($table, $arr = "")
    {

        if ($table == "")
            return;
        if ($arr == "")
            $arr = array();

        // DB 테이블의 설정을 읽어온다.
        $sql = " show full columns from " . $table;
        $result = $this->Db->sqlSelect($sql);
        $cnt = count($result);
        for ($i = 0; $i < $cnt; $i++) {
            $row = $result[$i];

            // 필드명
            $item = $row['Field'];
            if (!isset($arr[$item]))
                $arr[$item] = array();

            // 제목
            if (!isset($arr[$item]['name']))
                $arr[$item]['name'] = $row['Comment'];

            // 타입
            if ($pos = strpos($row['Type'], '(')) {
                $type = substr($row['Type'], 0, $pos);
                $max_len = substr($row['Type'], $pos, strpos($row['Type'], ')'));

                // 최대 길이
                if (!isset($arr[$item]['max_len']))
                    $arr[$item]['max_len'] = $max_len;
            } else {
                $type = $row['Type'];
            }

            if (!isset($arr[$item]['type'])) {
                if ($type == "char" || $type == "varchar" || $type == "text")
                    $arr[$item]['type'] = "text";
                else if ($type == "int" || $type == "tinyint" || $type == "bigint")
                    $arr[$item]['type'] = "number";
            }
        }

        return $arr;
    }

    /*******************************************
     * 상품 정보
     *******************************************/
    function get_product_info($r_product_idx)
    {

        $sql = "
            select * from tbl_product_mst
            where product_idx = '" . $r_product_idx . "'
        ";
        $row = $this->Db->sqlSelectOne($sql);

        return $row;
    }

    /*******************************************
     * 나의 구매 정보
     *******************************************/
    function get_my_order_arr($r_m_idx)
    {

        if ($r_m_idx == "" || $this->Auth->is_admin != "Y")
            $r_m_idx = $this->Auth->auth_idx;

        $sql = "
            select * from tbl_order_mst
            where m_idx = '" . $r_m_idx . "'
        ";
        $arr = $this->Db->sqlSelect($sql);

        return $arr;
    }

    /*******************************************
     * 나의 구매 정보
     *******************************************/
    function get_my_order_info($order_idx, $product_idx = "")
    {

        $sql = "
            select * from tbl_order_mst
            where m_idx = '" . $this->Auth->auth_idx . "'
        ";

        if ($order_idx != "")
            $sql .= " and order_idx='" . $order_idx . "' ";

        if ($product_idx != "")
            $sql .= " and product_idx='" . $product_idx . "' ";

        $row = $this->Db->sqlSelectOne($sql);

        return $row;
    }

    /*******************************************
     * 변경 내역 기록
     *******************************************/
    function add_log($r_idx)
    {

        if ($r_idx == "")
            return;
        if ($this->idx_name == "")
            return;
        if ($this->table_name == "")
            return;
        if ($this->log_table_name == "")
            return;

        if ($this->where != "")
            $where = $this->where . " and T." . $this->idx_name . " = '" . $r_idx . "' ";
        else
            $where = " where T." . $this->idx_name . " = '" . $r_idx . "' ";

        $query = "
            insert into " . $this->log_table_name . "
            select * from " . $this->table_name . " T " . $where . "
        ";
        $this->Db->sqlQuery($query);
    }

    /*******************************************
     * 권한 검사
     *******************************************/
    function check_perm($r_idx, $r_act)
    {

        // 개별 클래스에서 이 메소드를 재 작성하여 사용해야 함.
        // 관리자
        if ($this->is_admin == "Y")
            return array("status" => "Y");

        // 대상이 지정된 경우
        if ($r_idx != "") {
            // 대상 정보
            $info_data = $this->get_info_data($r_idx);

            // 작성자
            if ($info_data['r_reg_m_idx'] == $this->Auth->auth_idx)
                return array("status" => "Y");
        }

        // 요청 작업에 대한 권한 검사

        // 기본 정책에 따라 허용/불허
        //return array("msg"=>"권한이 없습니다.");
        return array("status" => "Y");
    }

    /*******************************************
     * 목록에 해당하는 총 갯수 반환
     *******************************************/
    function get_total_cnt()
    {

        $sql = "
            select count(*) cnt
            from " . $this->table_name . " T
            " . $this->list_join_sql . "
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

        // 목록에서 전달할 항목
        if ($this->list_field_arr != "")
            $item_list = implode(", ", $this->list_field_arr);
        if ($item_list == "")
            $item_list = "T.*";

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
            if ($start == "" || $start < 0)
                $start = 0;
            $sql .= " limit $start, $scale ";
        }

        $this->Lib->log_input("************** sqlQuery : " . $sql);
        $rows = $this->Db->sqlSelect($sql);
        return $rows;
    }

    /*******************************************
    * 목록 정보를 ajax로 전달하기
    $field_arr : 전달할 항목 지정 (지정하지 않으면, 전체 전달)
    *******************************************/
    function ajax_get_list($field_arr = "")
    {

        // 목록 정보 가져오기
        $start = $this->input['start'];
        $scale = $this->input['scale'];
        $list = $this->get_list($start, $scale);

        // ajax 형식으로 변환
        $list_data = $this->Lib->get_ajax_list($field_arr, $list);
        $ext = "";
        // 추가로 전달할 내용 (목록 자료)
        $ext .= ",\"list_data\":" . $list_data;

        $total_cnt = $this->get_total_cnt(); // 전체 목록 수
        $total_page = @ceil($total_cnt / $scale); // 전체 페이지 수
        $page = $this->input['page']; // 현재 페이지 수
        if ($page == "")
            $page = @floor(($start + 1) / $scale) + 1; // start 에서 page 산출

        $ext .= ",\"total_cnt\":\"" . $total_cnt . "\"";
        $ext .= ",\"total_page\":\"" . $total_page . "\"";
        $ext .= ",\"page\":\"" . $page . "\"";

        $this->Lib->ajax_return("", "Y", "", "", $ext);
    }

    /*******************************************
     * 대상의 기본 정보 가져오기
     *******************************************/
    function get_info_data($r_idx, $ext_arr = "")
    {
        $sub_sql = "";
        if ($r_idx != "") {
            // 기존 정보 재사용
            if ($r_idx == $this->form_data[$this->idx_name])
                return $this->form_data;

            if ($r_idx == $this->info_data[$this->idx_name])
                return $this->info_data;

            if ($this->where != "")
                $where = $this->where . " and T." . $this->idx_name . " = '" . $r_idx . "' ";
            else
                $where = " where T." . $this->idx_name . " = '" . $r_idx . "' ";

            // 대상 항목
            $arr = $this->info_field_arr;
            if (!@in_array($this->idx_name, $arr))
                $arr[] = $this->idx_name;
            if (isset($this->status_field) && !@in_array($this->status_field, $arr))
                $arr[] = $this->status_field;
            if (isset($this->lock_field) && !@in_array($this->lock_field, $arr))
                $arr[] = $this->lock_field;
            if (!@in_array("r_reg_m_idx", $arr))
                $arr[] = "r_reg_m_idx";

            // 추가 항목
            if (is_array($ext_arr)) {
                $cnt = count($ext_arr);
                for ($i = 0; $i < $cnt; $i++)
                    $arr[] = $ext_arr[$i];
            }

            // 기본 정보 가져오기
            $sql = "
                select
                    " . @implode(", T.", $arr) . "
                    " . $sub_sql . "
                from " . $this->table_name . " T
                " . $where . "
            ";
            if ($form_data = $this->Db->sqlSelectOne($sql))
                return $form_data;
        }
    }

    /*******************************************
     * 대상의 기존 정보 가져오기
     *******************************************/
    function get_form_data($r_idx = "")
    {

        if ($r_idx == "")
            $r_idx = $this->{$this->idx_name};
        if ($r_idx == "")
            $r_idx = $this->input[$this->idx_name];

        $form_data = array();

        if ($r_idx != "") {
            // 기존 정보 재사용
            if ($r_idx == $this->form_data[$this->idx_name])
                return $this->form_data;

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

            // 상태 검사
            //if($form_data[$this->status_field] == $this->status_del)
            //	$this->Lib->alert_return("", "삭제된 정보입니다.", "EXIT");
        }

        $this->{$this->idx_name} = $r_idx;
        $this->form_data = $form_data;
        return $form_data;
    }

    /*******************************************
     * 대상의 정보를 ajax로 전달하기
     *******************************************/
    function ajax_form_data($r_idx = "")
    {

        // 대상 지정
        if ($r_idx == "")
            $r_idx = $this->{$this->idx_name};
        if ($r_idx == "")
            $r_idx = $this->input[$this->idx_name];
        if ($r_idx == "")
            return;

        $ext_data = "";

        // 정보
        $form_data = $this->get_form_data($r_idx);
        $ext_data .= ",\"form_data\":" . $this->Lib->get_ajax_data("", $form_data);

        // Ajax 호출에 대한 결과 리턴
        $this->Lib->ajax_return("", "Y", "", "", $ext_data);
    }

    /*******************************************
     * 대상의 추가 정보 가져오기
     *******************************************/
    function get_extra_data($r_idx = "")
    {
        return array();
    }

    /*******************************************
     * 대상의 기존 정보 가져오기
     *******************************************/
    function get_view_data($r_idx = "", $hit_yn = "")
    {

        if ($r_idx == "")
            $r_idx = $this->{$this->idx_name};
        if ($r_idx == "")
            $r_idx = $this->input[$this->idx_name];
        if ($view_data = $this->get_form_data($r_idx)) {
            // 조회 수 증가
            if ($hit_yn == "") {
                $sql = "
                    update " . $this->table_name . " set
                        r_view_cnt = r_view_cnt + 1
                    where " . $this->idx_name . "='" . $r_idx . "'
                ";
                $this->Db->sqlQuery($sql);
            }
            // 추가정보
            $extra = $this->get_extra_data($r_idx);
            foreach ($extra as $key => $val)
                $view_data[$key] = $val;
        }

        return $view_data;
    }

    /*******************************************
     * 대상의 정보를 ajax로 전달하기
     *******************************************/
    function ajax_view_data($r_idx = "")
    {

        // 대상 지정
        if ($r_idx == "")
            $r_idx = $this->{$this->idx_name};
        if ($r_idx == "")
            $r_idx = $this->input[$this->idx_name];
        if ($r_idx == "")
            return;

        $ext_data = "";

        // 정보
        $view_data = $this->get_view_data($r_idx);
        $ext_data .= ",\"view_data\":" . $this->Lib->get_ajax_data("", $view_data);

        // Ajax 호출에 대한 결과 리턴
        $this->Lib->ajax_return("", "Y", "", "", $ext_data);
    }

    /*******************************************
     * 입력값 검사 (정리한 값을 반영하기 위해 Call by Reference 적용)
     *******************************************/
    function check_items($cmd, &$param, $field_arr, $check_arr = "")
    {

        // 입력값 꺼내기
        foreach ($param as $key => $val)
            ${$key} = $val;

        // 관리자가 아닌 경우 -> pass 불가
        if ($this->is_admin != "Y")
            $pass_check_item = "";

        // 기본 입력값 검사
        if ($check_arr == "")
            $check_arr = $this->item_arr;
        foreach ($check_arr as $_field => $_item) {
            //$_field = $_item['field']; // 필드명 (r_item)
            $_val = ${$_field}; // 입력 값

            if (@in_array($_field, $field_arr)) {
                $check = $this->Lib->check_item($_field, $_item, $_val);
                if ($check != "OK")
                    return $check;
            }
        }

        // 입력값 담기
        foreach ($param as $key => $val)
            $param["$key"] = ${$key};

        return "OK";
    }

    /*******************************************
     * 신규 등록
     *******************************************/
    function new_ok($param = "")
    {

        // 입력 정보
        if ($param == "")
            $param = $this->input;

        // 권한 검사
        $check = $this->check_perm("", "new");
        if ($check['status'] != "Y")
            return $check;

        // 대상 항목 및 값
        if ($this->new_field_arr)
            $field_arr = $this->new_field_arr;
        else
            $field_arr = $this->Db->sqlFieldArr($this->table_name); // 테이블의 필드명 배열

        // 비대상 항목 제외
        $except_arr = $this->new_except_arr;
        $field_arr = $this->Lib->array_diff($field_arr, $except_arr);

        // 기본 설정
        foreach ($this->new_default_arr as $key => $val) {
            $param[$key] = $val;
        }

        // 입력값 검사
        $check = $this->check_items("new_ok", $param, $field_arr);
        if ($check != "OK")
            return $check;

        // 현재 시간
        $now = date("Y-m-d H:i:s");

        // 추가 항목
        //$param['r_reg_date'] = $now;
        //$param['r_reg_m_idx'] = $this->Auth->auth_idx;

        //$param['r_mod_date'] = $now;
        //$param['r_mod_m_idx'] = $this->Auth->auth_idx;

        // 대상 설정 및 쿼리 생성
        $arr = $this->Lib->array_filter($field_arr, $param); // 입력값에서 지정한 필드만 선별
        $query = $this->Db->sqlInsertQuery($this->table_name, $arr); // Insert 쿼리 생성

        // 쿼리 실행
        $this->Db->sqlQuery($query);
        //$this->Lib->log_input("************** sqlQuery (".$this->Db->error().") : ".$query);

        // 등록된 식별 번호
        $r_idx = $this->Db->sqlLastId();
        $this->{$this->idx_name} = $r_idx;

        // 변경 내역 기록
        $this->add_log($r_idx);

        return array("status" => "Y", "msg" => "등록되었습니다.", $this->idx_name => $r_idx);
    }

    /*******************************************
     * 수정
     *******************************************/
    function mod_ok($param = "")
    {

        // 입력값
        if ($param == "")
            $param = $this->input;

        // 대상 식별자
        $r_idx = $param[$this->idx_name];
        if ($r_idx == "")
            return array("msg" => "대상이 지정되지 않았습니다.");

        if (!$form_data = $this->get_form_data($r_idx))
            return array("msg" => "정보를 읽을 수 없습니다.");

        // 권한 검사
        $check = $this->check_perm($r_idx, "mod");
        if ($check['status'] != "Y")
            return $check;

        // 상태 검사
        if (isset($this->status_field) && isset($this->status_del)) {
            if ($form_data[$this->status_field] == $this->status_del)
                return array("msg" => "삭제된 정보입니다.");
        }

        // 대상 항목
        $field_arr = $this->mod_field_arr;

        // 수정불가 항목 제외
        $except_arr = $this->mod_except_arr;

        // 대상 항목
        if (!$field_arr)
            $field_arr = $this->Db->sqlFieldArr($this->table_name); // 테이블의 필드 배열
        if ($except_arr)
            $field_arr = $this->Lib->array_diff($field_arr, $except_arr); // 수정불가 항목 제외

        // 입력값 검사
        $check = $this->check_items("mod_ok", $param, $field_arr);
        if ($check != "OK")
            return $check;

        // 현재 시간
        $now = date("Y-m-d H:i:s");

        // 추가 항목
        //$param['r_mod_date'] = $now;
        //$param['r_mod_m_idx'] = $this->Auth->auth_idx;

        // 대상 설정 및 쿼리 생성
        if ($this->where != "")
            $where = $this->where . " and T." . $this->idx_name . " = '" . $r_idx . "' ";
        else
            $where = " where T." . $this->idx_name . " = '" . $r_idx . "' ";

        $arr = $this->Lib->array_filter($field_arr, $param); // 입력값에서 지정한 필드만 선별
        $query = $this->Db->sqlUpdateQuery($this->table_name . " T", $arr, $where); // Update 쿼리 생성

        // 쿼리 실행
        $this->Db->sqlQuery($query);

        // 변경 내역 기록
        $this->add_log($r_idx);


        return array("status" => "Y", "msg" => "저장되었습니다.", $this->idx_name => $r_idx);
    }

    /*******************************************
     * 삭제하기 (상태 변경)
     *******************************************/
    function del_ok($r_idx = "", $_delete = "")
    {

        // 실제 삭제 여부 (Y)
        if ($_delete == "")
            $_delete = $this->input['_delete'];

        // 대상 식별자
        if ($r_idx == "")
            $r_idx = $this->input[$this->idx_name];
        if ($r_idx == "")
            return array("msg" => "대상이 지정되지 않았습니다.");

        $idx_arr = (is_array($r_idx)) ? $r_idx : explode(",", $r_idx);
        $idx_cnt = count($idx_arr);
        for ($i = 0; $i < $idx_cnt; $i++) {
            // 권한 검사
            $check = $this->check_perm($idx_arr[$i], "del");
            if ($check['status'] != "Y")
                return $check;
        }

        for ($i = 0; $i < $idx_cnt; $i++) {
            $r_idx = $idx_arr[$i];

            // 기존 정보
            if (!$info_data = $this->get_info_data($r_idx))
                return array("msg" => "정보를 읽을 수 없습니다.");

            // 권한 검사
            $check = $this->check_perm($r_idx, "del");
            if ($check['status'] != "Y")
                return $check;

            // 잠금 검사
            if (isset($this->lock_field) && isset($this->lock_on)) {
                if ($info_data[$this->lock_field] == $this->lock_on)
                    return array("msg" => "잠겨있는 정보입니다.");
            }

            // 상태 검사
            if (isset($this->status_field) && isset($this->status_del)) {
                if ($info_data[$this->status_field] == $this->status_del)
                    return array("msg" => "삭제된 정보입니다.");
            }

            // 삭제 전 작업
            $check = $this->pre_del_ok($r_idx);
            if ($check['status'] != "Y")
                return $check;

            // 삭제 후 작업
            $check = $this->post_del_ok($r_idx);
            if ($check['status'] != "Y")
                return $check;


            // 대상 식별
            if ($this->where != "")
                $where = $this->where . " and " . $this->idx_name . " = '" . $r_idx . "' ";
            else
                $where = " where " . $this->idx_name . " = '" . $r_idx . "' ";

            // 삭제 표시하기
            if (isset($this->status_field) && isset($this->status_del)) {
                $sql = "
                    update " . $this->table_name . " T set
                        " . $this->status_field . "='" . $this->status_del . "'
                    " . $where . "
                ";
                $this->Db->sqlQuery($sql);
                //$this->Lib->log_input("************** sqlQuery (".$this->Db->error().") : ".$sql);

                // 변경 내역 기록
                $this->add_log($r_idx);
            } else
                $_delete = "Y";

            // 실제 삭제하기
            if ($_delete == "Y") {

                // 폴더 내의 모든 파일 삭제
                if ($this->data_path != "") {
                    $file_path = $this->data_path . "/" . $r_idx;

                    // 파일인 경우
                    if (is_file($file_path)) {
                        unlink($file_path); // 기본 파일 삭제

                        if ($this->img_conf) { // 추가 이미지 삭제
                            foreach ($this->img_conf as $key => $conf) {
                                $file = $file_path;
                                if ($key != "default")
                                    $file .= "_" . $key;
                                if (file_exists($file))
                                    unlink($file);
                            }
                        }
                    }
                    // 폴더인 경우
                    else if (is_dir($file_path)) {
                        if ($dh = opendir($file_path)) {
                            while (($file = readdir($dh)) !== false) {
                                if ($file == "." || $file == "..")
                                    continue;
                                unlink($file_path . "/" . $file);
                            }
                            closedir($dh);
                            rmdir($file_path); // 폴더 삭제
                        }
                    }
                }

                // DB 에서 삭제
                $where = str_replace("T.", "", $where); // 검색조건의 'T.'을 제거한다.
                $sql = " delete from " . $this->table_name . " " . $where;
                $this->Db->sqlQuery($sql);
            }
        }

        return array("status" => "Y", "msg" => "삭제되었습니다.", $this->idx_name => $r_idx);
    }

    /*******************************************
     * 삭제 전 작업
     *******************************************/
    function pre_del_ok($r_idx)
    {

        return array("status" => "Y");
    }

    /*******************************************
     * 삭제 후 작업
     *******************************************/
    function post_del_ok($r_idx)
    {

        return array("status" => "Y");
    }

    /*******************************************
     * 삭제하기 (실제 삭제)
     *******************************************/
    function delete_ok($r_idx = "")
    {

        return $this->del_ok($r_idx, "Y");
    }


    /*******************************************
     * 저장하기 (new_ok + mod_ok)
     *******************************************/
    function regist($param = "")
    {

        // 입력 정보
        if ($param == "")
            $param = $this->input;
        $r_idx = $param[$this->idx_name];

        // 정보 저장
        if ($r_idx == "") { // 신규 등록
            $return = $this->new_ok($param);
            if ($return['status'] != "Y")
                return $return;

            $r_idx = $return[$this->idx_name];
        } else {
            $return = $this->mod_ok($param);
            if ($return['status'] != "Y")
                return $return;
        }

        // 식별자 정보 추가
        if (!array_key_exists($this->idx_name, $return))
            $return[$this->idx_name] = $r_idx;

        return $return;
    }


    /*******************************************
     * 파일 다운로드 (mode : preview, download)
     *******************************************/
    function get_file($param)
    {

        if (is_object($param)) {
            $file = $param->file;
            $name = $param->name;
            $type = $param->type;
            $mode = $param->mode;
        } else {
            $file = $param['file'];
            $name = $param['name'];
            $type = $param['type'];
            $mode = $param['mode'];
        }
        $size = filesize($file);

        if (!file_exists($file))
            return array("msg" => "File not exists ($file)");

        $disposition = ($mode == "download") ? "attachment" : "inline";
        $name = urlencode($name);

        // 파일을 전송하기위해 헤더를 전송하자
        header("Content-Type: $type; charset=UTF-8");
        header("Content-Disposition: " . $disposition . "; filename=\"" . $name . "\"");
        header("Content-Transfer-Encoding: binary\n");
        header("Content-length: " . $size);
        header("Cache-Control: private\n");
        header("Expires: 0\n");

        $is_IE = isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false;
        if ($is_IE) {
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header("Pragma: public");
        } else {
            header("Pragma: no-cache");
        }

        readfile($file);

        return array("status" => "Y");
    }

}