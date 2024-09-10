<?php

namespace App\Libraries;

// 지역/언어 설정 : 한글 UTF-8
setlocale(LC_ALL, "ko_KR.UTF-8");

// 이 파일을 include/require 하는 파일에서 미리 $_SERVER 변수를 정의한다.
/*if($_SERVER['SERVER_PROTOCOL'] != ""){
       // 세션 시작
       session_start();
   }*/

/*******************************************
 * 기본 환경변수 설정 파일
 *
 *******************************************/
class Config
{

    public $SERVER, $COOKIE_TAIL, $input;
    public $is_system = "Y";
    public $table;
    public $log_table;
    // 생성자 함수
    function __construct()
    {

        $this->SERVER = $_SERVER;

        // 쿠키 식별 코드 (하위 도메인의 쿠키와 충돌 회피)
        $this->COOKIE_TAIL = "__" . str_replace(".", "_", $this->SERVER['SERVER_NAME']);

        // 파라메터 입력값
        $this->input = array();
        foreach ($_GET as $key => $value)
            $this->input["$key"] = $value;
        foreach ($_POST as $key => $value)
            $this->input["$key"] = $value;
    }
}
?>