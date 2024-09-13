<?php

namespace App\Libraries;

/*******************************************
 * 사용자 인증 클래스
 *
 *******************************************/
class Auth
{

	public $Config, $Db, $Lib;
	public $input, $auth_idx, $auth_id, $auth_level, $auth_name, $is_admin;
	/*******************************************
	 * 생성자 함수
	 *******************************************/
	function __construct()
	{

		$this->Config = new Config();
		$this->Db = new Db();
		$this->Lib = new Lib();

		$this->input = $this->Config->input;

		// 사용자 인증 확인
		$this->check();
	}

	/*******************************************
	 * 사용자 인증 확인
	 *******************************************/
	function check()
	{
		if (session('member.mIdx') > 0) {
			// 사용자 인증 정보 설정
			$this->auth_idx = session('member.mIdx');
			$this->auth_id = session('member.userId');
			$this->auth_level = session('member.userLevel');
			$this->auth_name = session('member.userName');

			// 관리자 여부
			$this->is_admin = ($this->auth_level == "1") ? "Y" : "N";

			return "PASS";
		} else {
			return "";
		}
	}

	/*******************************************
	 * 비밀번호 생성
	 *******************************************/
	function passwd($r_passwd)
	{

		$hash = hash("sha256", $r_passwd); // 64byte
		return $hash;
	}

	/*******************************************
		  * 사용자 로그인
		  function login(){

			  $r_id = $this->input['r_id'];
			  $r_passwd = $this->input['r_passwd'];

			  $r_id = $this->Db->escape_str($r_id);
			  if($r_id == "")
				  return "아이디를 입력하세요.";

			  if($r_passwd == "")
				  return "비밀번호를 입력하세요.";

			  $sql = "
				  select * from jk_member
				  where r_id='".$r_id."'
			  ";
			  if(!$row = $this->Db->sqlSelectOne($sql))
				  return "사용자 정보를 확인할 수 없습니다.";

			  if($row['r_status'] == 'D')
				  return "삭제된 계정 입니다.";

			  if(strlen($row['r_passwd']) == 64){
				  if($row['r_passwd'] != $this->passwd($r_passwd))
					  return "비밀번호가 일치하지 않습니다.";
			  }
			  else{
				  if($row['r_passwd'] != $r_passwd)
					  return "비밀번호가 일치하지 않습니다.";

				  $sql = "
					  update jk_member set
						  r_passwd = '".$this->passwd($r_passwd)."'
					  where r_id='".$r_id."'
				  ";
				  $this->Db->sqlQuery($sql);
			  }

			  // 사용자 인증정보 기록
			  $this->save($row); // 세션에 등록
			  $this->check(); // Auth 클래스에 등록

			  return "PASS";
		  }
		  *******************************************/

	/*******************************************
		  * 사용자 로그아웃
		  function logout(){

			  // 사용자 인증정보 삭제
			  $this->clear();
		  }
		  *******************************************/

	/*******************************************
		  * 사용자 인증정보 기록
		  function save($param){

			  $_SESSION['member'] = array();
			  session('member.idx') = $param['r_m_idx'];
			  session('member.id') = $param['r_id'];
			  session('member.name') = $param['r_name'];
			  session('member.level') = $param['r_level'];
		  }
		  *******************************************/

	/*******************************************
		  * 사용자 인증정보 삭제
		  function clear(){

			  // 세션 초기화
			  unset($_SESSION["member"]);

			  // 사용자 인증 정보
			  $this->auth_idx = "";
			  $this->auth_id = "";
			  $this->auth_name = "";
			  $this->auth_level = "";

			  // 관리자 여부
			  $this->is_admin = "N";
		  }
		  *******************************************/
}
?>