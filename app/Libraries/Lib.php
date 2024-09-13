<?php

namespace App\Libraries;

/*******************************************************************
 * 기본 라이브러리 클래스
 * 1. 기타 유용한 메소드
 * 2. 자바 스크립트 관련 유용한 함수 모음
 *******************************************************************/
class Lib
{
	public $Config; // 환경 설정

	// 생성자 함수
	function __construct()
	{

		$this->Config = new Config();
		$this->input = $this->Config->input;

		// 서버 환경 변수
		$this->SERVER = $this->Config->SERVER;

		//외부에 디비컨넥트가 있는경우 여기에서 같이 할당한다.
		global $connect;
		if ($connect)
			$this->connect = $connect;
	}

	// 기본 헤더 (한글깨짐 방지용)
	function msgheader()
	{

		if (!defined('_head__'))
			echo "<!DOCTYPE html><html lang='ko'><head><meta charset='utf-8'></head><body>";
	}

	//--메세지 를 보여준다.--//
	function alert($ment = "")
	{
		$this->msgheader(); // 기본 헤더
		if ($ment != "")
			echo "<script>alert(\"$ment\");</script>";
	}

	//--get 방식으로 이동(이때 메세지를 뿌려준다.)
	function alert_go($ment, $url, $parent = "", $opt = "")
	{
		$this->alert($ment);
		$this->go_url($url, $parent, $opt);
		exit;
	}

	//--get 방식으로 이동
	function go_url($url, $parent = "", $opt = "")
	{
		$url = htmlspecialchars_decode($url);
		$url = str_replace(" ", "%20", $url);
		$an = (strpos($url, "?") !== false) ? "&" : "?";

		if ($parent == "opener")
			$close = "top.close();";

		if ($parent != "")
			$parent .= ".";

		//echo $this->v_mhead();  //-- charset=utf-8  기본 설정 표시
		echo "<script>" . $parent . "location.href=\"" . $url . $an . "\"+new Date().getTime();" . $opt . $close . "</script>\n";
		//echo $this->v_m_tail();
		exit;
	}

	//--메세지 를 보여주고 창을 닫는다.--//
	function alert_close($ment = "")
	{
		$this->alert($ment);
		echo "<script>self.close();</script>";
		exit;
	}

	//--메세지 를 보여주고 종료한다.--//
	function alert_exit($ment = "")
	{
		$this->alert($ment);
		exit;
	}

	//--메세지 를 보여주고 뒤로 이동하기--//
	function alert_back($ment = "")
	{
		$this->alert($ment);
		echo "<script>history.back();</script>";
		exit;
	}

	// 2byte 문자를 포함하고 있는지 검사
	function check_2byte_char($str)
	{
		$len = strlen($str);

		for ($i = 0; $i < $len; $i++) {
			if (ord($str[$i]) > 127)
				return true;
		}

		return;
	}

	// 멀티바이트 문자를(한글) 포함한 문자열을 주어진 길이만큼 잘라낸다.
	function mb_cut_str($str, $length, $tail = "", $encoding = "")
	{
		if ($encoding == "")
			$encoding = "UTF-8";

		$len = mb_strlen($str, $encoding);
		if ($length < 0)
			$length = $len + $length;
		if ($length < 0 || $len <= $length)
			return $str;

		$return = mb_substr($str, 0, $length, $encoding);
		if ($return != $str)
			$return .= $tail;

		return $return;
	}
	function cut_str($str, $length, $tail = "", $encoding = "")
	{
		return $this->mb_cut_str($str, $length, $tail, $encoding);
	}

	// 멀티바이트 문자열을 byte 길이로 잘라낸다 (2~3바이트 글자의 길이를 2로 계산)
	function byte_cut_str($str, $length, $tail = "", $encoding = "")
	{
		if ($encoding == "")
			$encoding = "UTF-8";

		$mb_len = mb_strlen($str, $encoding);
		$return = "";
		for ($i = 0; $i < $mb_len; $i++) {
			$ch = mb_substr($str, $i, 1, $encoding);
			$len += (strlen($ch) > 1) ? 2 : 1;
			if ($len <= $length)
				$return .= $ch;
			if ($len >= $length)
				break;
		}
		if ($return != $str)
			$return .= $tail;

		return $return;
	}

	// 문자셋 변환 (UTF-8 -> EUC-KR)
	function utf2euc($msg)
	{
		$msg = iconv("UTF-8", "euc-kr//IGNORE", $msg);
		return $msg;
	}
	// 문자셋 변환 (EUC-KR -> UTF-8)
	function euc2utf($msg)
	{
		$msg = iconv("euc-kr", "UTF-8//IGNORE", $msg);
		return $msg;
	}

	// 문자열을 감싸고 있는 ", ', <> 를 제거한다.
	// $quote 에 지정한 문자열을 제거한다. (앞/뒤 다른 경우 ,로 구분)
	function strip_quote($str, $quote = "", $encoding = "")
	{

		return $this->mb_strip_quote($str, $quote, $encoding);
	}
	function mb_strip_quote($str, $quote = "", $encoding = "")
	{

		if ($encoding == "")
			$encoding = "UTF-8";

		$str = trim($str);
		if (mb_substr($str, 0, 1, $encoding) == '"' && mb_substr($str, -1, 1, $encoding) == '"')
			$str = mb_substr($str, 1, -1, $encoding);
		if (mb_substr($str, 0, 1, $encoding) == "'" && mb_substr($str, -1, 1, $encoding) == "'")
			$str = mb_substr($str, 1, -1, $encoding);
		if (mb_substr($str, 0, 1, $encoding) == '<' && mb_substr($str, -1, 1, $encoding) == '>')
			$str = mb_substr($str, 1, -1, $encoding);
		if ($quote != "") {
			$tmp = explode(",", $quote);
			if (count($tmp) == 1)
				$tmp[1] = $tmp[0];

			$s = $tmp[0];
			$s_len = mb_strlen($tmp[0], $encoding);

			$e = $tmp[0];
			$e_len = mb_strlen($tmp[1], $encoding);

			if (mb_substr($str, 0, $s_len, $encoding) == $s && mb_substr($str, -1 * $e_len, $e_len, $encoding) == $e)
				$str = mb_substr($str, $s_len, -1 * $e_len, $encoding);
		}

		return $str;
	}


	/************************************************************
	 * 기타 함수
	 ************************************************************/

	// 영문자와 숫자, $add 만으로 이루어져있는지 검사
	function check_alpha_num($str, $add = "")
	{
		return preg_match("/[a-zA-Z0-9$add]{" . strlen($str) . "}/", $str);
	}

	/*******************************************
	 * 특정 IP 목록에 포함되는지 여부
	 *******************************************/
	function in_ip_array($ip, $ip_array)
	{

		if (!$ip || !$ip_array)
			return false;

		$array = explode(".", $ip);
		$count = count($array);
		$tmp = $array[0];
		for ($i = 1; $i <= $count; $i++) {
			if (in_array($tmp, $ip_array))
				return true;

			$tmp .= "." . $array[$i];
		}

		return false;
	}

	// data_arr 배열에서 except 배열의 항목을 제외한다
	// PHP의 array_diff 함수와 동일한 기능
	function array_diff($data_arr, $except)
	{
		$arr = array();
		$cnt = count($data_arr);
		for ($i = 0; $i < $cnt; $i++) {
			if (!in_array($data_arr[$i], $except))
				$arr[] = $data_arr[$i];
		}
		return $arr;
	}
	function getArrDiff($data_arr, $except)
	{
		return $this->array_diff($data_arr, $except);
	}

	// data_arr 배열에서 except 배열의 항목을 제외한다
	// PHP의 array_diff_key 함수와 동일한 기능
	function array_diff_key($data_arr, $except)
	{
		$arr = array();
		foreach ($data_arr as $key => $val) {
			if (!array_key_exists($key, $except))
				$arr[$key] = $val;
		}
		return $arr;
	}
	function getArrDiffKey($data_arr, $except)
	{
		return $this->array_diff_key($data_arr, $except);
	}

	// 주어진 필드의 값을 값 배열에서 찾아서 이름=값 배열을 반환한다.
	// 특정 항목의 값을 지우려면, value_arr 에 필드명만 추가하고 값을 비워둔다.
	// $only_exists="Y" -> value_arr 에 존재하지 않는 필드는 수정하지 않는다. -> checkbox 의 값 해제 불가
	// $only_exists="N" -> value_arr 에 존재하지 않는 필드는 공백으로 처리한다. -> 비 대상 항목의 예외처리 필요
	function array_filter($field_arr, $value_arr, $only_exists = "N")
	{
		$arr = array();
		$cnt = count($field_arr);
		for ($i = 0; $i < $cnt; $i++) {
			$field = $field_arr[$i];
			if (array_key_exists($field, $value_arr))  // 변수가 존재하는 경우에만 값 적용
				$arr[$field] = $value_arr[$field];
			else if ($only_exists != "Y") // 변수가 존재하지 않는 경우 빈 값 적용
				$arr[$field] = "";
		}
		return $arr;
	}
	function getArrFilter($field_arr, $value_arr, $only_exists = "N")
	{
		return $this->array_filter($field_arr, $value_arr, $only_exists);
	}

	// 일반 배열을 지정된 키의 연관배열로 변환
	function arr2arr($from_arr, $key, $val = "")
	{
		$cnt = count($from_arr);
		$to_arr = array();
		for ($i = 0; $i < $cnt; $i++) {
			$row = $from_arr[$i];
			$to_arr[$row[$key]] = ($val != "") ? $row[$val] : $row;
		}
		return $to_arr;
	}

	/*******************************************
	 * 배열에서 선택된 필드만 필터링하는 함수 (특정 항목 선별)
	 *******************************************/
	function filter_array($filter_arr, $data_arr)
	{

		if (!$data_arr)
			return;
		if (!is_array($filter_arr))
			return $data_arr;

		$tmp = array();
		foreach ($data_arr as $key => $val) {
			if (in_array($key, $filter_arr))
				$tmp[$key] = $val;
		}

		return $tmp;
	}

	/*******************************************
	 * DB 결과를 Ajax 전달용으로 변환 (list)
	 *******************************************/
	function get_ajax_list($item_arr, $result)
	{

		$cnt = count($result);
		$arr = array();
		for ($i = 0; $i < $cnt; $i++) {
			$row = $result[$i];
			$arr[] = $this->filter_array($item_arr, $row);
		}

		$json = json_encode($arr);
		return $json;
	}

	/*******************************************
		* DB 결과를 Ajax 전달용으로 변환 (form_data)
		   $type : 1 -> val
		   $type : 2 -> key:val
		*******************************************/
	function get_ajax_data($item_arr, $arr, $type = "2")
	{

		// 지정된 항목만 선별
		$arr = $this->filter_array($item_arr, $arr);

		// 값만 추출
		if ($type == "1")
			$arr = array_values($arr);

		// JSON 형식으로 전달
		$json = json_encode($arr);
		return $json;
	}


	/*******************************************
		* Ajax 호출에 대한 결과 리턴
		   - $return : 전달할 객체를 미리 만들어서 넘어 오는 경우
		   - $satatus : 전달할 상태 (Y, N)
		   - $item : 특정 아이템을 지정 (focus 용도)
		   - $msg : 메시지 내용
		   - $ext : 추가 항목들 (전달되는 자료들)
		*******************************************/
	function ajax_return($return, $status = "", $item = "", $msg = "", $ext = "", $data_type = "")
	{
		if ($data_type == "")
			$data_type = $_GET["data_type"];
		if ($data_type == "")
			$data_type = $_POST["data_type"];

		// 전달 객체는 없지만 상태가 있는 경우, 전달 객체를 생성하여 전달한다.
		if ($return == "" && $status != "") {
			if ($data_type == "text")
				$return = "var re_data = "; // Javascript 객체 형식으로 전달 -> 받는쪽에서 eval 처리하여 사용

			$return .= "{"; // JSON 방식으로 전달할 경우 -> 바로 적용됨 (eval 불필요)

			$return .= "\"status\":\"" . $status . "\"";
			$return .= ",\"item\":\"" . $item . "\"";
			$return .= ",\"msg\":\"" . $msg . "\"";
			if ($ext != "")
				$return .= $ext; // 추가 항목

			$return .= "}";
		}

		// \n -> \\n
		//$conf_data = str_replace("\n", "\\\n", $conf_data);
		$return = str_replace("\r\n", "\n", $return);
		$return = str_replace("\r", "\n", $return);
		$return = str_replace("\n", "\\n", $return);
		//$this->log_input("************** after : ".$return);


		// HTTP 헤더 출력 (Ajax 응답)
		header("Content-Type: text/plain; charset=UTF-8");
		// Date in the past
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		// always modified
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		// HTTP/1.1
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		// HTTP/1.0
		header("Pragma: no-cache");

		echo $return;

		exit;
	}

	// Ajax 방식의 호출을 고려하여 alert_back / alert_exit / alert_go 처리
	function alert_return($call_type, $msg, $url = "EXIT", $target = "")
	{

		/*
				  // 로그 기록
				  $log = "** alert_return **\n";
				  $log .= "call_type : ".$call_type."\n";
				  $log .= "msg : ".$msg."\n";
				  $log .= "url : ".$url."\n";
				  $log .= "target : ".$target."\n";
				  $this->log_input($log);
				  */

		if (is_array($msg)) {
			//$status = $msg['status'];
			//$item = $msg[item];
			//$msg = $msg[msg];

			$arr = array("status", "item", "msg");
			$ext = "";
			foreach ($msg as $key => $val) {
				if (!in_array($key, $arr))
					$ext .= ", \"" . $key . "\" : \"" . $val . "\"";
			}
			foreach ($arr as $key) {
				${$key} = $msg[$key];
			}
		}

		if ($status == "")
			$status = "N";

		if ($call_type == "")
			global $call_type;
		if ($call_type == "")
			$call_type = $_GET['call_type'];
		if ($call_type == "")
			$call_type = $_POST['call_type'];

		if ($call_type == "ajax") {

			// Ajax 호출에 대한 결과 리턴 (실패로 처리하고 alert 만 실행)
			$msg = str_replace("\"", "'", $msg);
			//$this->log_input("alert_return:".$msg);

			if (!in_array($url, array("BACK", "EXIT", "CLOSE", "")))
				$ext .= ", \"url\": \"$url\"";

			// [참고] status가 Y인 경우는, alert_return 대신 ajax_return을 직접 호출해야 한다.
			$this->ajax_return("", $status, $item, $msg, $ext);
		} else { // call_type == form

			$call_back = $this->input['call_back'];
			if ($call_back != "") {
				echo "<script>" . $this->input['call_back'] . "(\"" . addslashes($msg) . "\");</script>";
				exit;
			}

			$_url = strtoupper($url);
			if ($_url == "BACK")
				$this->alert_back($msg);
			else if ($_url == "EXIT")
				$this->alert_exit($msg);
			else if ($_url == "CLOSE")
				$this->alert_close($msg);
			else if ($url != "")
				$this->alert_go($url, $msg, $target);
		}

		exit;
	}

	// 현재 페이지의 URL정보를 가지고 로그인페이지로 이동
	function go_login()
	{
		// ajax 호출인 경우...
		global $call_type;
		if ($call_type == "ajax")
			$this->ajax_return("", "N", "", "로그인하셔야 합니다.");

		// 로그인 페이지 경로
		$login_path = "/adm/login.php";
		if ($_COOKIE[check_https] == "Y")
			$login_url = $this->Config->HTTPS_URL . $login_path;
		else
			$login_url = $this->Config->HTTP_URL . $login_path;


		// 현재 페이지 호출 정보
		if ($this->SERVER['PHP_SELF'] != $login_path) {
			$url = $this->get_url();
			//$url_encode = base64_encode($url);
			$go_url = urlencode($url);
		}

		echo "<script>\n";
		echo "top.document.location.href=\"" . $login_url . "?go_url=" . $go_url . "\";\n";
		echo "</script>\n";
		exit;
	}

	// 현재 사이트의 URL
	function get_site_url()
	{

		$site_url = ($this->SERVER[HTTPS] != "") ? $this->Config->HTTPS_URL : $this->Config->HTTP_URL;

		if ($site_url == "") {
			$site_url = ($this->SERVER[HTTPS] != "") ? "https://" : "http://";
			$site_url .= (SERVER_NAME != "") ? SERVER_NAME : $this->Config->SITE_URL;
			if ($this->SERVER[SERVER_PORT] != "")
				$site_url .= ":" . $this->SERVER[SERVER_PORT];
		}

		return $site_url;
	}

	function get_url($ext_param = "")
	{

		// 입력값
		$input = array();
		if (get_magic_quotes_gpc())
			foreach ($_GET as $key => $value)
				$input["$key"] = stripslashes($value);
		else
			foreach ($_GET as $key => $value)
				$input["$key"] = $value;

		if (get_magic_quotes_gpc())
			foreach ($_POST as $key => $value)
				$input["$key"] = stripslashes($value);
		else
			foreach ($_POST as $key => $value)
				$input["$key"] = $value;

		$param_arr = array();
		foreach ($input as $key => $value)
			$param_arr[] = $key . "=" . $value;

		if ($ext_param != "") {
			$arr = explode("&", $ext_param);
			$cnt = count($arr);
			for ($i = 0; $i < $cnt; $i++) {
				$param = trim($arr[$i]);
				if ($param != "")
					$param_arr[] = $param;
			}
		}

		$url = $this->SERVER['PHP_SELF'] . "?" . implode("&", $param_arr);

		return $url;
	}

	// 배열을 CSV형식의 파일로 내보낸다.
	function download_csv_array($array, $key_array = "", $field_array = "", $name = "")
	{
		if (!$array)
			return;

		if ($key_array == "") {
			foreach ($array[0] as $key => $val) {
				$key_array[] = $key;
			}
		}

		if ($field_array == "")
			$field_array = $key_array;

		$data = implode(",", $field_array) . "\n";

		$key_count = count($key_array);
		$count = count($array);
		for ($i = 0; $i < $count; $i++) {
			$row = $array[$i];

			for ($j = 0; $j < $key_count; $j++) {
				$key = $key_array[$j];
				if ($j > 0)
					$data .= ",";

				$tmp = str_replace("\"", "˝", $row[$key]);

				if (ereg("[,'\"\n]", $tmp))
					$data .= "\"" . $tmp . "\"";
				else
					$data .= $tmp;
			}
			$data .= "\n";
		}

		$data_size = strlen($data);

		if ($name == "")
			$name = date("%Y%m%d%H%i%s") . ".csv";

		// 파일을 전송하기위해 헤더를 전송하자
		header("Content-type: application/octet-stream\n");
		//header("Content-Type: text/plain; charset=UTF-8");
		header("Content-charset=utf-8");
		header("Content-length: $data_size\n");
		header("Content-Disposition: attachment; filename=$name\n");
		header("Content-Transfer-Encoding: binary\n");
		//header("Pragma: no-cache\n");
		header("Pragma: dummy=jnkmw\n");
		header("Cache-Control: private\n");
		header("Expires: 0\n");

		echo "\xEF\xBB\xBF"; // utf-8 BOM 정보를 추가해야 엑셀에서 잘 읽는다
		echo $data;
		exit;
	}


	/* 페이지 정보
			   total_cnt : 전체 갯수
			   list_scale : 한 페이지에 표시할 목록 수
			   page_scale : 한번에 표시할 페이지 수
			   page : 현재 페이지
		   */
	function page_info($total_cnt, $list_scale, $page_scale, $page = 1)
	{

		if ($total_cnt < 1)
			return; // 전체 갯수
		if ($list_scale < 1)
			$list_scale = 10; // 한 페이지에 표시할 목록 수
		if ($page_scale < 1)
			$page_scale = 10; // 한번에 표시할 페이지 수
		if ($page < 1)
			$page = 1; // 현재 페이지

		$total_page = ceil($total_cnt / $list_scale); // 전체 페이지 수 (= 마지막 페이지)
		if ($total_page < 1)
			$total_page = 1;

		if ($page > $total_page)
			$page = $total_page;

		// 페이지 목록 정보
		$page_start = (floor(($page - 1) / $page_scale) * $page_scale) + 1; // 시작 페이지
		$page_last = $page_start + $page_scale - 1; // 마지막 페이지
		if ($page_last > $total_page)
			$page_last = $total_page;

		// 목록 시작 줄 (0부터 시작)
		$list_start = (($page - 1) * $list_scale);

		// 결과 리턴
		$page_info = array();
		$page_info[total_cnt] = $total_cnt;
		$page_info[list_scale] = $list_scale;
		$page_info[page_scale] = $page_scale;
		$page_info[page] = $page;
		$page_info[total_page] = $total_page;
		$page_info[page_start] = $page_start;
		$page_info[page_last] = $page_last;
		$page_info[list_start] = $list_start;

		return $page_info;
	}

	/*
		   // 입력값 검사
		   */
	function check_item($_field, $_item, $_val)
	{
		//$_field = $_item['field']; // 필드명 (r_item)
		$_name = $_item['name']; // 이름 (아이템)
		$_len = strlen(iconv("UTF-8", "euc-kr//IGNORE", $_val)); // 문자열 길이 (문자셋을 UTF-8 -> EUC-KR 변환하여 검사 )
		$_num = floatval($_val); // 입력 값 (숫자)

		// 필수 항목
		if ($_item['required'] == "Y" && $_val == "")
			return array("item" => $_field, "msg" => "'" . $_name . "' 항목의 정보를 입력해 주세요.");

		// 값이 입력된 경우...검사 실행
		if ($_val != "") {
			// 문자열 최소 길이
			if ($_item['min_len'] > 0 && $_len < $_item['min_len'])
				return array("item" => $_field, "msg" => "'" . $_name . "' 항목은 " . $_item['min_len'] . " Byte 이상이어야 합니다.(" . $_len . ")");

			// 문자열 최대 길이
			if ($_item['max_len'] > 0 && $_len > $_item['max_len'])
				return array("item" => $_field, "msg" => "'" . $_name . "' 항목은 " . $_item['max_len'] . " Byte 이내여야 합니다.(" . $_len . ")");

			// 숫자 최소 값
			if ($_item['min_val'] > 0 && $_num < $_item['min_val'])
				return array("item" => $_field, "msg" => "'" . $_name . "' 항목은 " . $_item['min_val'] . " 이상이어야 합니다.(" . $_num . ")");

			// 숫자 최대 값
			if ($_item['max_val'] > 0 && $_num > $_item['max_val'])
				return array("item" => $_field, "msg" => "'" . $_name . "' 항목은 " . $_item['max_val'] . " 이내여야 합니다.(" . $_num . ")");

			// 특정 값 목록
			if (is_array($_item['value_arr'])) {
				if ($this->is_assoc($_item['value_arr'])) {
					if (!@in_array($_val, array_keys($_item['value_arr'])))
						return array("item" => $_field, "msg" => "'" . $_name . "' 항목의 값이 올바르지 않습니다.(key:" . $_val . ")");
				} else {
					if (!@in_array($_val, array_keys($_item['value_arr']))) {
						if (!@in_array($_val, $_item['value_arr']))
							return array("item" => $_field, "msg" => "'" . $_name . "' 항목의 값이 올바르지 않습니다.(val:" . $_val . ")");
					}
				}
			}
		}

		return "OK";
	}

	// 로그파일에 기록 (TEST 사이트에서만 적용)
	function log_input($str, $code = "")
	{
		return;

		if ($this->Config->DEBUG_MODE != "Y")
			return;

		$log_path = dirname($this->SERVER['DOCUMENT_ROOT']) . "/debug";
		$log_file = ($code != "") ? "log_" . $code . ".txt" : "input_log.txt";

		if ($fp = @fopen($log_path . "/" . $log_file, "a")) {
			fwrite($fp, "[" . date("Y-m-d H:i:s") . "]");
			fwrite($fp, $str);
			fwrite($fp, "\n\r");
			fclose($fp);
		}
	}


	/************************************************************
	 * 이미지 함수
	 ************************************************************/

	// 이미지에 기록된 사진정보(Exif)를 통해 회전해야할 각도 구하기
	function exif_rotate($file_path)
	{
		$rotate = "";
		if (function_exists('exif_read_data')) {
			$exif = @exif_read_data($file_path);
			if ($exif !== false) {
				$orientation = intval(@$exif['Orientation']);
				if (in_array($orientation, array(3, 6, 8))) {
					if ($orientation == 3)
						$rotate = 180;
					else if ($orientation == 6)
						$rotate = 270;
					else if ($orientation == 8)
						$rotate = 90;

					// PHP의 imagerotate는 반시계 방향값인데, 이를 시계방향으로 전환한다.
					$rotate = 360 - ($rotate % 360);
				}
			}
		}

		return $rotate;
	}

	// 이미지를 제한된 크기 이내로 줄이기 (비율 유지)
	function image_scale($src_w, $src_h, $des_w, $des_h)
	{
		if ($src_w < 1 || $src_h < 1)
			return false;

		if ($des_w < 1 || $des_h < 1)
			return false;

		// 가로 : 세로 비율
		$src_r = $src_w / $src_h;
		$des_r = $des_w / $des_h;

		// 같은 크기
		if ($src_w == $des_w && $src_h == $des_h) {
			$return['w'] = $des_w;
			$return['h'] = $des_h;
		}
		// 회전
		/*else if($src_w == $des_h && $src_h == $des_w)
				  {
					  $return['w'] = $des_w;
					  $return['h'] = $des_h;
				  }*/
		// 작은 이미지
		else if ($src_w <= $des_w && $src_h <= $des_h) {
			$return['w'] = $src_w;
			$return['h'] = $src_h;
		}
		// 가로폭 맞춤
		else if ($src_w >= $des_w && $src_h <= $des_h) {
			$return['w'] = $des_w;
			$return['h'] = $return['w'] * ($src_h / $src_w);
		}
		// 세로폭 맞춤
		else if ($src_w <= $des_w && $src_h >= $des_h) {
			$return['h'] = $des_h;
			$return['w'] = $return['h'] * ($src_w / $src_h);
		}
		// 가로폭 맞춤
		else if ($src_w / $src_h >= $des_w / $des_h) {
			$return['w'] = $des_w;
			$return['h'] = $return['w'] * ($src_h / $src_w);
		}
		// 세로폭 맞춤
		else {
			$return['h'] = $des_h;
			$return['w'] = $return['h'] * ($src_w / $src_h);
		}

		$return['str'] = "width='" . $return['w'] . "' height='" . $return['h'] . "'";
		return $return;
	}

	// src_file 이미지파일을 설정된 크기로 변경해서 des_file 이미지파일로 저장한다.
	// des_file = "" 인 경우, 파일을 출력한다.
	// width * height 이내의 크기로 변경한다.
	// rotate : h (좌우반전), v(상하반전), 90, 180, 270
	function image_resize($src_file, $des_file, $width = "", $height = "", $rotate = "")
	{
		// 원본이 없는 경우
		if ($src_file == "" || !file_exists($src_file))
			return;

		// 지정된 대상 파일이 원본이 아니면서 이미 존재하는 경우
		//if($des_file != "" && $des_file != $src_file && file_exists($des_file))
		//	return;

		if (!$src_info = getimagesize($src_file))
			return;

		$src_width = $src_info[0];
		$src_height = $src_info[1];
		$src_type = $src_info[2];

		// 이미지 편집을 위해 일시적으로 메모리제한 상향 조정
		$memory_usage = memory_get_usage(); // 현재 사용량, bytes -> 최대 사용량 memory_get_peak_usage()
		$memory_require = $memory_usage + (($src_width * $src_height * 3) * 3); // w * h * 3(24bit색상) * 3(원본, 대상, 기타)
		$memory_require /= 1024 * 1024; // bytes -> MB
		$memory_limit = (int) ini_get('memory_limit'); // ex: 128M -> 128
		if ($memory_limit < $memory_require)
			ini_set('memory_limit', $memory_require . 'M');

		if ($src_type == "1") // GIF
			$src = ImageCreateFromGif($src_file);
		else if ($src_type == "2") // JPG
			$src = ImageCreateFromJpeg($src_file);
		else if ($src_type == "3") // PNG
			$src = ImageCreateFromPng($src_file);

		if (!$src)
			return;

		if ($rotate != "") {
			// 가로 <-> 세로 변경 (결과물)
			if (abs($rotate % 180) == "90") {
				$w = $src_height;
				$h = $src_width;
			} else {
				$w = $src_width;
				$h = $src_height;
			}

			// 원본과 동일한 크기의 이미지 생성
			if ($src_type != "1" && function_exists("imagecreatetruecolor")) // None GIF
				$tmp = imagecreatetruecolor($w, $h);
			else // GIF
				$tmp = imagecreate($w, $h);

			if ($rotate != "v" && $rotate != "h" && function_exists("imagerotate")) {
				// PHP 4.3.0 이상 (반시계 방향) -> 3배 정도 빠름
				$_rotate = 360 - ($rotate % 360);
				$tmp = imagerotate($src, $_rotate, -1);
			} else {
				if ($rotate == 90) {
					for ($x = 0; $x < $src_width; $x++) {
						for ($y = 0; $y < $src_height; $y++) {
							$_x = $src_height - 1 - $y;
							$_y = $x;

							$rgb = imagecolorat($src, $x, $y);
							imagesetpixel($tmp, $_x, $_y, $rgb);
						}
					}
				} else if ($rotate == 180) {
					for ($x = 0; $x < $src_width; $x++) {
						for ($y = 0; $y < $src_height; $y++) {
							$_x = $src_width - 1 - $x;
							$_y = $src_height - 1 - $y;

							$rgb = imagecolorat($src, $x, $y);
							imagesetpixel($tmp, $_x, $_y, $rgb);
						}
					}
				} else if ($rotate == 270) {
					for ($x = 0; $x < $src_width; $x++) {
						for ($y = 0; $y < $src_height; $y++) {
							$_x = $y;
							$_y = $src_width - 1 - $x;

							$rgb = imagecolorat($src, $x, $y);
							imagesetpixel($tmp, $_x, $_y, $rgb);
						}
					}
				} else if ($rotate == "v") // 상하 반전 (vertical)
				{
					for ($x = 0; $x < $src_width; $x++) {
						for ($y = 0; $y < $src_height; $y++) {
							$_x = $x;
							$_y = $src_height - 1 - $y;

							$rgb = imagecolorat($src, $x, $y);
							imagesetpixel($tmp, $_x, $_y, $rgb);
						}
					}
				} else if ($rotate == "h") // 좌우 반전 (horizontal)
				{
					for ($x = 0; $x < $src_width; $x++) {
						for ($y = 0; $y < $src_height; $y++) {
							$_x = $src_width - 1 - $x;
							$_y = $y;

							$rgb = imagecolorat($src, $x, $y);
							imagesetpixel($tmp, $_x, $_y, $rgb);
						}
					}
				} else // 그대로 유지
				{
					$tmp = $src;
					$w = $src_width;
					$h = $src_height;
				}
			}

			$src_width = $w;
			$src_height = $h;

			imagedestroy($src);
		}


		// 이미지 크기 제한
		if ($width == "")
			$width = $src_width;
		if ($height == "")
			$height = $src_height;

		// 비율에 맞추어 크기 조정
		if (!$des_info = $this->image_scale($src_width, $src_height, $width, $height))
			return;

		if ($src_type != "1" && function_exists("imagecreatetruecolor")) // None GIF
			$des = imagecreatetruecolor($des_info['w'], $des_info['h']);
		else // GIF
			$des = imagecreate($des_info['w'], $des_info['h']);

		if ($tmp) {
			imagecopyresampled($des, $tmp, 0, 0, 0, 0, $des_info['w'], $des_info['h'], $src_width, $src_height);
			imagedestroy($tmp);
		} else {
			imagecopyresampled($des, $src, 0, 0, 0, 0, $des_info['w'], $des_info['h'], $src_width, $src_height);
			imagedestroy($src);
		}

		if ($des_file != "" && file_exists($des_file))
			unlink($des_file);

		if ($src_type == "1") // GIF
			imagegif($des, $des_file);
		else if ($src_type == "2") // JPG
			imagejpeg($des, $des_file);
		else if ($src_type == "3") // PNG
			imagepng($des, $des_file);

		imagedestroy($des);

		$res = array();
		$res['w'] = $des_info['w'];
		$res['h'] = $des_info['h'];
		$res['size'] = ($des_file != "") ? filesize($des_file) : 0;

		return $res;
	}

	// 썸네일 만들기 (꽉찬 이미지로)
	// src_file 이미지파일을 설정된 크기로 변경해서 des_file 이미지파일로 저장한다.
	// des_file = "" 인 경우, 파일을 출력한다.
	// width * height 이내의 크기로 변경한다.
	function thumb_resize($src_file, $des_file, $des_w, $des_h)
	{
		if ($src_file == "" || !file_exists($src_file))
			return;

		//if($des_file == "" || $des_file == $src_file || file_exists($des_file))
		//	return;

		if (!$src_info = getimagesize($src_file))
			return;

		$src_w = $src_info[0];
		$src_h = $src_info[1];
		$src_type = $src_info[2];

		if ($src_w < 1 || $src_h < 1)
			return false;

		if ($des_w < 1 || $des_h < 1)
			return false;

		// 가로 : 세로 비율
		$src_r = $src_w / $src_h;
		$des_r = $des_w / $des_h;

		if ($src_r == $des_r) { // 같은 비율
			$x = 0;
			$y = 0;
			$w = $src_w;
			$h = $src_h;
		} else if ($src_r > $des_r) { // 가로 비율이 큰 경우, 높이를 기준으로
			$y = 0;
			$h = $src_h;

			$w = $src_h * ($des_w / $des_h);
			$x = ($src_w - $w) / 2;
		} else if ($src_r < $des_r) { // 세로 비율이 큰 경우, 넓이를 기준으로
			$x = 0;
			$w = $src_w;

			$h = $src_w * ($des_h / $des_w);
			//$y = ($src_h - $h) / 2;
			$y = 0; // 맨 위에서 시작 (아래쪽을 버린다.)
		}

		// 이미지 편집을 위해 일시적으로 메모리제한 상향 조정
		$memory_usage = memory_get_usage(); // 현재 사용량, bytes -> 최대 사용량 memory_get_peak_usage()
		$memory_require = $memory_usage + (($src_width * $src_height * 3) * 3); // w * h * 3(24bit색상) * 3(원본, 대상, 기타)
		$memory_require /= 1024 * 1024; // bytes -> MB
		$memory_limit = (int) ini_get('memory_limit'); // ex: 128M -> 128
		if ($memory_limit < $memory_require)
			ini_set('memory_limit', $memory_require . 'M');

		if ($src_type == "1") // GIF
			$src = ImageCreateFromGif($src_file);
		else if ($src_type == "2") // JPG
			$src = ImageCreateFromJpeg($src_file);
		else if ($src_type == "3") // PNG
			$src = ImageCreateFromPng($src_file);

		if (!$src)
			return;

		if ($src_type != "1" && function_exists("imagecreatetruecolor")) // None GIF
			$des = imagecreatetruecolor($des_w, $des_h);
		else // GIF
			$des = imagecreate($des_w, $des_h);

		imagecopyresampled($des, $src, 0, 0, $x, $y, $des_w, $des_h, $w, $h);
		imagedestroy($src);

		if ($des_file != "" && file_exists($des_file))
			unlink($des_file);

		if ($src_type == "1") // GIF
			imagegif($des, $des_file);
		else if ($src_type == "2") // JPG
			imagejpeg($des, $des_file);
		else if ($src_type == "3") // PNG
			imagepng($des, $des_file);

		imagedestroy($des);

		return true;
	}

	// 이미지 파일 회전 및 썸네일 생성
	/*
			   [req]
				   file_path : 원본 파일
				   rotate : 회전 여부 (Y)
				   arr : 추가 이미지 크기(연관 배열)
					   path : 결과 파일 경로
					   mode : 이미지 축소 방식 (thumb, image)
					   max_w : 최대 넓이
					   max_h : 최대 높이
			   [res]
				   r_size : 파일 크기
				   rotate : 회전 각도 (90, 180, 270)
				   r_width : 변경 후 넓이
				   r_height : 변경 후 높이
				   status : 결과 상태 (OK)
		   */
	function save_image($req, $file_path = "")
	{
		if ($file_path == "")
			$file_path = $req['file_path'];

		if (!file_exists($file_path))
			return "파일이 존재하지 않습니다.";

		// 방향 전환 설정
		if ($req['rotate'] == "Y")
			$rotate = $this->exif_rotate($file_path);

		// 이미지 새로 저장 (+뱡향 전환 적용)
		$this->image_resize($file_path, $file_path, "", "", $rotate);

		// 지정된 규격의 이미지 파일 생성
		$arr = $req['arr'];
		$cnt = count($arr);
		for ($i = 0; $i < $cnt; $i++) {
			$img = $arr[$i];

			// 저장될 파일경로
			$path = ($img['path'] != "") ? $img['path'] : $file_path . "_" . $img['code'];

			if ($img['mode'] == "thumb") // 종이 크기에 맞게 자르기 (페이퍼 풀)
				$this->thumb_resize($file_path, $path, $img['w'], $img['h']);
			else //if($img['mode'] == "image") // 종이 안에 모든 이미지가 들어가도록 (이미지 풀)
				$this->image_resize($file_path, $path, $img['w'], $img['h']);
		}

		return "OK";
	}

	// 이미지를 패턴 파일에 맞추어 투명하게 만들기
	// src_file : 원본 이미지 파일
	// cur_file : 패턴 이미지 (투명 바탕에 불투명 색상으로 패턴이 그려지 png 파일
	// des_file : 원본을 패턴처리하여 저장할 파일 (미 지정시 이미지 출력)
	function cut_image($src_file, $cut_file, $des_file = "")
	{

		// --------------------------------------------
		// 원본 이미지 정보
		if (!$src_info = getimagesize($src_file))
			return;

		$src_w = $src_info[0];
		$src_h = $src_info[1];
		$src_type = $src_info[2];

		// 원본 이미지 가져오기
		if ($src_type == "1") // GIF
			$src = imagecreatefromgif($src_file);
		else if ($src_type == "2") // JPG
			$src = imagecreatefromjpeg($src_file);
		else if ($src_type == "3") // PNG
			$src = imagecreatefrompng($src_file);


		// --------------------------------------------
		// 패턴 이미지 정보 (png)
		/*
				  // 생성할 이미지 크기
				  $img_w = 54;
				  $img_h = 54;

				  // 원의 중심점 좌표
				  $arc_x = floor($img_w / 2);
				  $arc_y = floor($img_h / 2);

				  // 원의 크기
				  $arc_w = ($arc_x * 2) - 1;
				  $arc_h = ($arc_y * 2) - 1;

				  // 빈 이미지 생성 (black)
				  $des = imagecreatetruecolor($img_w, $img_h);

				  // black -> 투명 처리
				  $black = imagecolorallocate($des, 0, 0, 0);
				  imagecolortransparent($des, $black);

				  // red 원 추가
				  $red = imagecolorallocate($des, 255, 0, 0);
				  imagefilledarc($des, $arc_x, $arc_y, $arc_w, $arc_h, 0, 360, $red, IMG_ARC_PIE);
			  */
		if (!$cut_info = getimagesize($cut_file))
			return;

		$cut_w = $cut_info[0];
		$cut_h = $cut_info[1];

		// 패턴 이미지 가져오기
		$cut = imagecreatefrompng($cut_file);


		// --------------------------------------------
		// 원본 이미지를 패턴 이미지 크기로 복사(크기 조정)
		$tmp = imagecreatetruecolor($cut_w, $cut_h);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $cut_w, $cut_h, $src_w, $src_h);
		imagedestroy($src); // 원본 이미지 제거


		// --------------------------------------------
		// 픽셀단위로 비교하여 red 픽셀을 원본 픽셀로 덮어쓰기
		for ($x = 0; $x < $cut_w; $x++) {
			for ($y = 0; $y < $cut_h; $y++) {
				if (imagecolorat($cut, $x, $y) != 0) { // 투명이 아닌 경우, 복사
					imagesetpixel($cut, $x, $y, imagecolorat($tmp, $x, $y));
				}
			}
		}
		imagedestroy($tmp); // 임시 이미지 제거

		if ($des_file != "") { // 대상 파일로 저장
			if (file_exists($des_file))
				unlink($des_file);

			imagepng($cut, $des_file); // png 파일로 저장
			imagedestroy($cut); // 대상 이미지 제거
			return "OK";
		} else { // png 파일로 직접 출력
			header('Content-type: image/png');
			imagepng($cut);
			imagedestroy($cut); // 대상 이미지 제거
		}
	}


	// SMTP 서버에 E-mail 발송을 요청하는 함수
	/*
			   [hosting@totoro hosting]$ telnet localhost 25
			   Trying 127.0.0.1...
			   Connected to localhost.
			   Escape character is '^]'.
			   220 totoro.jnkmw.com ESMTP
			   helo totoro
			   250 totoro.jnkmw.com
			   mail from:<asdf@jnkmw.com>
			   250 ok
			   rcpt to:<guinee@jnkmw.com>
			   250 ok
			   rcpt to:<guinee@medicus.co.kr>
			   250 ok
			   data
			   354 go ahead
			   Subject: mail test
			   From: asdf@jnkmw.com
			   To: guinee@jnkmw.com
			   Cc: guinee@medicus.co.kr, guinee72@hanmail.net, 123@jnkmw.com
			   Bcc: root@jnkmw.com

			   ^^
			   .
			   250 ok 1178157248 qp 26390
			   quit
			   221 totoro.jnkmw.com
			   Connection closed by foreign host.
			   [hosting@totoro hosting]$ 
		   */
	function smtp_email($from_email, $to_email, $mail_data)
	{
		$from_email = trim($from_email);
		$to_email = trim($to_email);

		// 메일 발송 설정
		$conf = $this->Config->SMTP_CONNECT;
		$host = $conf[HOST];
		$port = $conf[PORT];
		$limit = $conf[LIMIT];
		$id = $conf[ID];
		$pw = $conf[PW];

		if ($host == "")
			$host = "localhost";
		if ($port == "")
			$port = 25;
		if ($limit == "")
			$limit = 30;

		if (!$socket = @fsockopen($host, $port, $errno, $errstr, $limit))
			return "Error:fsockopen ($errno : $errstr)";

		// SMTP 연결 확인
		$response = fgets($socket, 1024);
		if (substr($response, 0, 4) != "220 ")
			return "Error:connect - " . $response;

		// helo xxxx
		fwrite($socket, "helo " . $host . "\r\n");
		$response = fgets($socket, 1024);
		if (substr($response, 0, 3) != "250")
			return "Error:helo - " . $response;

		// 사용자 인증
		if ($id != "" && $pw != "") {
			// auth login
			fwrite($socket, "auth login \r\n");
			//$response = fgets($socket, 1024);
			$response = fread($socket, 1024);
			if (substr($response, 0, 3) != "250")
				return "Error:auth login - " . $response;

			// id xxxx
			fwrite($socket, base64_encode($id) . "\r\n");
			$response = fgets($socket, 1024);
			if (substr($response, 0, 3) != "334")
				return "Error:id - " . $response;

			// pw xxxx
			fwrite($socket, base64_encode($pw) . "\r\n");
			$response = fgets($socket, 1024);
			if (substr($response, 0, 3) != "235")
				return "Error:pw - " . $response;
		}

		// mail from:<nobody@jnkmw.com>
		fwrite($socket, "mail from:<" . $from_email . ">\r\n");
		$response = fgets($socket, 1024);
		if (substr($response, 0, 4) != "250 ")
			return "Error:mail from - " . $response;

		// rcpt to:<user1@jnkmw.com>
		fwrite($socket, "rcpt to:<" . $to_email . ">\r\n");
		$response = fgets($socket, 1024);
		if (substr($response, 0, 4) != "250 ")
			return "Error:rcpt to - " . $response;

		// data
		fwrite($socket, "data\r\n");
		$response = fgets($socket, 1024);
		if (substr($response, 0, 4) != "354 ")
			return "Error:data - " . $response;

		// escape Ending '.'
		$mail_data = str_replace("\r\n.\r\n", "\r\n . \r\n", $mail_data);
		$mail_data = str_replace("\r\n.\r\n", "\r\n . \r\n", $mail_data);

		// 메일내용 (메일헤더 + '\n' + 내용 + '\n.')
		fwrite($socket, $mail_data . "\r\n" . ".\r\n");
		$response = fgets($socket, 1024);
		if (substr($response, 0, 4) != "250 ")
			return "Error:mail_data - " . $response;

		return "";
	}

	// 메일 발송 (DB 접근이 안되므로....로그 및 수신확인 불가)
	function send_mail($from_name, $from_email, $to_name, $to_email, $subject, $message, $extheader = "", $file_arr = "")
	{
		// 추가 설정
		if ($extheader != "") {
			$arr = explode("\n", $extheader);
			$cnt = count($arr);
			$param_arr = array();
			$item = "";
			for ($i = 0; $i < $cnt; $i++) {
				$str = $arr[$i];
				if (substr($str, 0, 1) == "	") { // TAB -> 이전 항목에 연결
					if ($item != "")
						$param_arr[$item] .= $str;
					continue;
				} else {
					if (!$pos = strpos($str, ":")) {
						if ($item != "")
							$param_arr[$item] .= $str;
						continue;
					}

					$item = "";
					$_item = trim(substr($str, 0, $pos));
					$_value = trim(substr($str, $pos + 1));
					if ($_item != "" && $_value != "") {
						$param_arr[$_item] = $_value;
						$item = $_item;
					}
				}
			}

			// 보내는 사람 = 답변 받을 사람
			if ($param_arr["Reply-To"] != "" && $param_arr["Sender"] == "")
				$param_arr["Sender"] = $param_arr["Reply-To"];
			else if ($param_arr["Sender"] != "" && $param_arr["Reply-To"] == "")
				$param_arr["Reply-To"] = $param_arr["Sender"];
		}

		$from_name = trim($from_name);
		$from_email = trim($from_email);

		$to_name = trim($to_name);
		$to_email = trim($to_email);

		$subject = trim($subject);
		$message = trim($message);

		if ($from_email == "")
			return;
		if ($to_email == "")
			return;
		if ($subject == "")
			return;
		if ($message == "")
			return;

		// from
		$from_name = "=?UTF-8?B?" . base64_encode($from_name) . "?=";
		$from = "\"" . $from_name . "\" <" . $from_email . ">";

		// to
		$to_name = "=?UTF-8?B?" . base64_encode($to_name) . "?=";
		$to = "\"" . $to_name . "\" <" . $to_email . ">";

		// subject
		$subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";

		global $Auth;
		$auth_id = $Auth->auth_id;

		// --------------------------------------------
		// 1차 발송....SMTP 서버 지정 발송

		// 메일 헤더
		$header = "";
		$header .= "Message-ID: <" . microtime(true) . "_" . uniqid() . "@" . $this->SERVER['SERVER_NAME'] . ">\n";
		$header .= "Date: " . date("D, j M Y H:i:s +0900") . "\n";
		$header .= "From: " . $from . "\n";
		$header .= "To: " . $to . "\n";
		$header .= "Subject: " . $subject . "\n";
		$header .= "Organization: " . (($param_arr["Organization"] != "") ? $param_arr["Organization"] : $this->SERVER['SERVER_NAME']) . "\n";
		if ($param_arr["Sender"] != "")
			$header .= "Sender: " . $param_arr["Sender"] . "\n";
		if ($param_arr["Reply-To"] != "")
			$header .= "Reply-To: " . $param_arr["Reply-To"] . "\n";
		if ($param_arr["Errors-To"] != "")
			$header .= "Errors-To: " . $param_arr["Errors-To"] . "\n";
		if ($param_arr["X-Priority"] != "")
			$header .= "X-Priority: " . $param_arr["X-Priority"] . "\n";
		$header .= "X-Originating-IP: " . $this->SERVER['REMOTE_ADDR'] . "\n";
		$header .= "X-Sender-IP: " . $this->SERVER['REMOTE_ADDR'] . "\n";
		$header .= "X-Sender-ID: " . $auth_id . " [" . $this->SERVER['SERVER_NAME'] . "]\n";
		$header .= "X-Mailer: JNKMW-Mailer\n";
		$header .= "MIME-Version: 1.0\n";

		$body = "";

		// 첨부파일이 있는 경우...
		if ($file_arr != "") {
			// 바운더리 지정
			$boundary = microtime(true) . "_" . uniqid() . ".JNKMW-Mailer";
			$header .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\n";

			// 메시지 추가
			$body .= "\n\nThis is MIME Preamble\n\n";
			$body .= "--" . $boundary . "\n";
			$body .= "Content-Type: TEXT/HTML; charset=UTF-8\n";
			$body .= "Content-Transfer-Encoding: base64\n";
			$body .= "\n";
			$body .= chunk_split(base64_encode($message), 72, "\n") . "\n"; // base64로 인코딩 (폭 제한 적용)
			$body .= "\n";

			// 파일 추가
			$file_cnt = count($file_arr);
			for ($i = 0; $i < $file_cnt; $i++) {
				$file = $file_arr[$i];

				// 파일 정보
				$file_path = $file[path];
				if ($file_path == "")
					continue;
				if (!file_exists($file_path))
					continue;

				$file_data = file_get_contents($file_path);
				$file_name = "=?UTF-8?B?" . base64_encode($file[name]) . "?=";

				$body .= "--" . $boundary . "\n";
				$body .= "Content-Type: " . $file[type] . "; name=\"" . $file_name . "\"\n";
				$body .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"\n";
				$body .= "Content-Transfer-Encoding: base64\n";
				$body .= "\n";
				$body .= chunk_split(base64_encode($file_data), 72, "\n") . "\n"; // base64로 인코딩 (폭 제한 적용)
				$body .= "\n";
			}

			// 바운더리 마감
			$body .= "\n";
			$body .= "--" . $boundary . "--\n";
			$body .= "\n\nThis is MIME Epilogue\n\n";
		} else {
			$header .= "Content-Type: TEXT/HTML; charset=UTF-8\n";
			//$header .= "Content-Transfer-Encoding: 8BIT\n";
			$header .= "Content-Transfer-Encoding: base64\n";

			//$body = $message;
			$body .= chunk_split(base64_encode($message), 72, "\n") . "\n"; // base64로 인코딩 (폭 제한 적용)
		}

		$mail_data = $header . "\n\n" . $body;
		$mail_data = str_replace("\r\n", "\n", $mail_data); // 1. \r\n -> \n
		$mail_data = str_replace("\r", "\n", $mail_data);   // 2. \r   -> \n
		$mail_data = str_replace("\n", "\r\n", $mail_data); // 3. \n   -> \r\n

		// 메일 발송
		$err = $this->smtp_email($from_email, $to_email, $mail_data);
		//$this->log_input("******************* smtp_email (err) : ".$err, "guinee");

		// --------------------------------------------
		// 1차 발송 실패시....자체 발송 (localhost)
		if ($err != "") {
			// extheader
			if ($extheader == "")
				$extheader = "From: " . $from . "\nX-Mailer: JNKMW-Mailer\nContent-Type: text/html; charset=UTF-8";
			else
				$extheader = "From: " . $from . "\n" . $extheader;

			// 메일 발송
			$err = !mail($to, $subject, $message, $extheader);
			//$this->log_input("******************* mail (err) : ".$err, "guinee");
		}

		// 메일 발송 결과
		if (!$err)
			return true;
	}

	/*******************************************
	 * 연관배열인지 검사
	 *******************************************/
	function is_assoc($arr)
	{
		return is_array($arr) && array_diff_key($arr, array_keys(array_keys($arr)));
	}

	/*******************************************
	 * 파일 크기
	 *******************************************/
	function str_filesize($size, $precision = 1)
	{
		if ($size < 1024)
			$str = number_format($size) . "B";
		else if ($size < 1024 * 1024)
			$str = number_format(round($size / 1024, $precision), $precision) . "KB";
		else if ($size < 1024 * 1024 * 1024)
			$str = number_format(round($size / (1024 * 1024), $precision), $precision) . "MB";
		else //if($size < 1024 * 1024 * 1024 * 1024)
			$str = number_format(round($size / (1024 * 1024 * 1024), $precision), $precision) . "GB";

		return $str;
	}

	/*******************************************
	 * 비주얼 정보
	 *******************************************/
	function get_visual($param)
	{

		global $Db;

		$sql = "
				select
					r_visual_idx,
					r_file_code,
					r_file_list
				from jk_visual
				where r_status != 'D'
			";
		foreach ($param as $key => $val)
			$sql .= " and " . $key . "='" . $val . "' ";

		$sql .= " order by r_visual_idx desc limit 1 ";

		$row = $Db->sqlSelectOne($sql);
		$row['path'] = "/data/visual/" . $row['r_visual_idx'];
		$row['file'] = $row['path'] . "/" . $row['r_file_code'];

		$arr = json_decode($row['r_file_list'], true);
		$cnt = count($arr);
		for ($i = 0; $i < $cnt; $i++) {
			$tmp = $arr[$i];

			$row['code_arr'][] = $tmp['code'];
			$row['file_arr'][] = $row['path'] . "/" . $tmp['code'];
		}
		$row['file_cnt'] = count($row['file_arr']);

		return $row;
	}
}
