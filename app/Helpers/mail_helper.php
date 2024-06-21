<?php
function autoEmail($code, $user_mail, $replace_text)
{

    $connect = db_connect();

    $is_ssl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    $protocol = $is_ssl ? 'https://' : 'http://';
    $domain = $_SERVER['HTTP_HOST'];
    $http_domain_url = $protocol . $domain;

    $infoSql = " SELECT * FROM tbl_homeset WHERE idx = 1 ";
    $infoRow = $connect->query($infoSql)->getRowArray();

    $replace_text .= "|||[home_name]:::" . $infoRow['home_name'];
    $replace_text .= "|||[addr1]:::" . $infoRow['addr1'];
    $replace_text .= "|||[addr2]:::" . $infoRow['addr2'];
    $replace_text .= "|||[com_owner]:::" . $infoRow['com_owner'];
    $replace_text .= "|||[comnum]:::" . $infoRow['comnum'];
    $replace_text .= "|||[tour_no]:::" . $infoRow['tournum'];
    $replace_text .= "|||[mallOrder]:::" . $infoRow['mallOrder'];
    $replace_text .= "|||[custom_phone]:::" . $infoRow['custom_phone'];
    $replace_text .= "|||[qna_email]:::" . $infoRow['qna_email'];
    $replace_text .= "|||[http_domain_url]:::" . $http_domain_url;

    $total_sql = " select * from tbl_auto_mail_skin where code = '" . $code . "'  ";
    $row = $connect->query($total_sql)->getRowArray();

    // 해당 코드가 자동 발송이 가능한가?
    if ($row['autosend'] != "Y") {
        return false;
    }

    // 메일 보낼 내역이 없다면 
    if ($row['content'] == "") {
        return false;
    }

    // 메일 보낼 내역
    $_tmp_content = viewSQ($row['content']);
    $subject = $row['mail_title'];

    //$_tmp_content = "[[name]] 고객님 안녕하세요. 가입하신 아이디는 [[id]] 입니다.[[name]] 고객님 안녕하세요. 가입하신 아이디는 [[id]] 입니다.";


    $_tmp_fir_array = explode("|||", $replace_text);

    for ($i = 1; $i < sizeof($_tmp_fir_array); $i++) {
        $_tmp_sec_array = explode(":::", $_tmp_fir_array[$i]);

        $_f_txt = $_tmp_sec_array[0];
        $_s_txt = $_tmp_sec_array[1];

        $_tmp_content = str_replace($_f_txt, $_s_txt, $_tmp_content);
    }

    //mailer($nameFrom, $mailFrom, $mailTo, $subject, $_tmp_content);
    $nameFrom = "하이호주";
    $mailFrom = "info@hihojoo.com";
    $to_name = $user_mail;
    $to_email = $user_mail;


    $err = send_mail($nameFrom, $mailFrom, $to_name, $to_email, $subject, $_tmp_content);
    return $err;
}
function send_mail($from_name, $from_email, $to_name, $to_email, $subject, $message, $ext_header = "")
{
    $auth_id = "";
    // 추가 설정
    if ($ext_header != "") {
        $arr = explode("\n", $ext_header);
        $cnt = count($arr);
        $param_arr = array();
        $item = "";
        for ($i = 0; $i < $cnt; $i++) {
            $str = $arr[$i];
            if (substr($str, 0, 1) == " ") { // TAB -> 이전 항목에 연결
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

    // --------------------------------------------
    // 1차 발송....SMTP 서버 지정 발송

    // 메일 헤더
    $header = "";
    $header .= "Message-ID: <" . microtime(true) . "_" . uniqid() . "@" . $_SERVER['SERVER_NAME'] . ">\n";
    $header .= "Date: " . date("D, j M Y H:i:s +0900") . "\n";
    $header .= "From: " . $from . "\n";
    $header .= "To: " . $to . "\n";
    $header .= "Subject: " . $subject . "\n";
    $header .= "Organization: " . (($param_arr["Organization"] != "") ? $param_arr["Organization"] : $_SERVER['SERVER_NAME']) . "\n";
    if ($param_arr["Sender"] != "")
        $header .= "Sender: " . $param_arr["Sender"] . "\n";
    if ($param_arr["Reply-To"] != "")
        $header .= "Reply-To: " . $param_arr["Reply-To"] . "\n";
    if ($param_arr["Errors-To"] != "")
        $header .= "Errors-To: " . $param_arr["Errors-To"] . "\n";
    if ($param_arr["X-Priority"] != "")
        $header .= "X-Priority: " . $param_arr["X-Priority"] . "\n";
    $header .= "X-Originating-IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $header .= "X-Sender-IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $header .= "X-Sender-ID: " . $auth_id . " [" . $_SERVER['SERVER_NAME'] . "]\n";
    $header .= "X-Mailer: Excom21-Mailer\n";
    $header .= "MIME-Version: 1.0\n";
    $header .= "Content-Type: TEXT/HTML; charset=UTF-8\n";
    $header .= "Content-Transfer-Encoding: 8BIT\n";

    $mail_data = $header . "\n\n" . $message;
    $mail_data = str_replace("\r\n", "\n", $mail_data); // 1. \r\n -> \n
    $mail_data = str_replace("\r", "\n", $mail_data); // 2. \r   -> \n
    $mail_data = str_replace("\n", "\r\n", $mail_data); // 3. \n   -> \r\n

    // 메일 발송
    $err = smtp_email($from_email, $to_email, $mail_data);
    //$this->log_input("******************* smtp_email (err) : ".$err, "guinee");
    return $err;

    // --------------------------------------------
    // 1차 발송 실패시....자체 발송 (localhost)
    /*if($err != "")
             {
             // ext_header
             if($ext_header == "")
             $ext_header = "From: ".$from."\nX-Mailer: JK-Mailer2\nContent-Type: text/html; charset=UTF-8";
             else
             $ext_header = "From: ".$from."\n".$ext_header;

             // 메일 발송
             $err = !mail($to, $subject, $message, $ext_header);
             //$this->log_input("******************* mail (err) : ".$err, "guinee");
             }*/

    // 메일 발송 결과
    if (!$err)
        return true;
}
function smtp_email($from_email, $to_email, $mail_data)
{
    global $SMTP_CONNECT;
    $host = $SMTP_CONNECT["HOST"];
    $id = $SMTP_CONNECT["ID"];
    $pw = $SMTP_CONNECT["PW"];
    $port = $SMTP_CONNECT["PORT"];
    $limit = $SMTP_CONNECT["LIMIT"];


    //var_dump($SMTP_CONNECT);

    $from_email = trim($from_email);
    $to_email = trim($to_email);

    //if($host == "") return "Error:NO host";

    if ($host == "")
        $host = "localhost";
    if ($port == "")
        $port = 587; // 기본이 25 업체 SMTP PORT 설정에 따라서 변경
    if ($limit == "")
        $limit = 30;


    if (!$socket = @fsockopen($host, $port, $errno, $errstr, $limit))
        return "Error:fsockopen ($errno : $errstr)";


    // SMTP 연결 확인
    $response = fgets($socket, 1024);
    //echo $response."<br>";
    if (substr($response, 0, 4) != "220 ")
        return "Error:connect - " . $response;

    // helo xxxx
    fwrite($socket, "ehlo " . $host . "\r\n");
    $response = fgets($socket, 1024);
    //echo $response."<br>";
    if (substr($response, 0, 3) != "250")
        return "Error:ehlo - " . $response;

    if ($id != "" && $pw != "") {
        // auth login
        fwrite($socket, "auth login \r\n");
        //$response = fgets($socket, 1024);
        $response = fread($socket, 1024);
        //echo $response."<br>";
        if (substr($response, 0, 3) != "250")
            return "Error:auth login - " . $response;

        // id xxxx
        fwrite($socket, $id . "\r\n");
        $response = fgets($socket, 1024);
        //echo $response."<br>";
        if (substr($response, 0, 3) != "334")
            return "Error:id - " . $response;

        // pw xxxx
        fwrite($socket, $pw . "\r\n");
        $response = fgets($socket, 1024);
        //echo $response."<br>";
        if (substr($response, 0, 3) != "235")
            return "Error:pw - " . $response;
    }

    // mail from:<nobody@jnkmw.com>
    fwrite($socket, "mail from:<" . $from_email . ">\r\n");
    $response = fgets($socket, 1024);
    //echo $response."<br>";
    if (substr($response, 0, 3) != "250")
        return "Error:mail from - " . $response;

    // rcpt to:<user1@jnkmw.com>
    fwrite($socket, "rcpt to:<" . $to_email . ">\r\n");
    $response = fgets($socket, 1024);
    //echo $response."<br>";
    if (substr($response, 0, 3) != "250")
        return "Error:rcpt to - " . $response;

    // data
    fwrite($socket, "data\r\n");
    $response = fgets($socket, 1024);
    //echo $response."<br>";
    if (substr($response, 0, 3) != "354")
        return "Error:data - " . $response;

    // escape Ending '.'
    $mail_data = str_replace("\r\n.\r\n", "\r\n . \r\n", $mail_data);
    $mail_data = str_replace("\r\n.\r\n", "\r\n . \r\n", $mail_data);

    // 메일내용 (메일헤더 + '\n' + 내용 + '\n.')
    fwrite($socket, $mail_data . "\r\n" . ".\r\n");
    $response = fgets($socket, 1024);
    //echo $response."<br>";
    if (substr($response, 0, 3) != "250")
        return "Error:mail_data - " . $response;

    return "";
}
function autoSms($code, $to_phone, $replace_text){

	$connect = db_connect();

	$total_sql = " select * from tbl_auto_sms_skin where code = '".$code."'  ";
	$row = $connect->query($total_sql)->getRowArray();

	// 해당 코드가 자동 발송이 가능한가?
	if($row['autosend'] != "Y"){
		return false;
		exit;
	}

	// 문자 보낼 내역이 없다면 
	if($row['content'] == ""){
		return false;
		exit;
	}

	// 문자 보낼 내역
	$_tmp_content = viewSQ($row['content']);

	//$_tmp_content = "[[name]] 고객님 안녕하세요. 가입하신 아이디는 [[id]] 입니다.[[name]] 고객님 안녕하세요. 가입하신 아이디는 [[id]] 입니다.";


	$_tmp_fir_array = explode("|||", $replace_text);

	for($i=1; $i<sizeof($_tmp_fir_array); $i++){
		$_tmp_sec_array = explode(":::", $_tmp_fir_array[$i]);

		$_f_txt = $_tmp_sec_array[0];
		$_s_txt = $_tmp_sec_array[1];

		$_tmp_content = str_replace($_f_txt,$_s_txt,$_tmp_content);
	}
	
	$send = _IT_SMS_PHONE;
	
	//echo ($to_phone .", ". $send .", ". $_tmp_content);
	//sms_send($to_phone, $send, $_tmp_content);
	//return send_sms(_SendSmsPhone, $_tmp_content, $to_phone, $title );
	return send_aligo($send, $_tmp_content , $to_phone, "");

}


function send_aligo($send , $msg, $rphone, $title = "")
{
	$connect = db_connect();

	$sql    = " select * from tbl_homeset where idx='1' ";
	// $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));
	$row    = $connect->query($sql)->getRowArray();

	$user_mobile = str_replace("-", "", $rphone);

    /****************** 인증정보 시작 ******************/
	$sms_url               = "https://apis.aligo.in/send/"; // 전송요청 URL
	$sms['user_id']        =  $row['allim_userid']; // SMS 아이디
	$sms['key']            =  $row['allim_apikey']; // 인증키

	$_POST['msg']          = $msg; // 메세지 내용 : euc-kr로 치환이 가능한 문자열만 사용하실 수 있습니다. (이모지 사용불가능)
	$_POST['receiver']     = $user_mobile; // 수신번호  01111111111, 01111111112
	$_POST['destination']  = ''; // 수신인 %고객명% 치환  01111111111|담당자,01111111112|홍길동
	$_POST['sender']       = $row['sms_phone']; // 발신번호
	$_POST['rdate']        = ''; // 예약일자 - 20161004 : 2016-10-04일기준
	$_POST['rtime']        = ''; // 예약시간 - 1930 : 오후 7시30분
	$_POST['testmode_yn']  = 'Y'; // Y 인경우 실제문자 전송X , 자동취소(환불) 처리
	$_POST['subject']      = '하이호주입니다.'; //  LMS, MMS 제목 (미입력시 본문중 44Byte 또는 엔터 구분자 첫라인)
	//$_POST['image']        = '../data/brand/20210314140356.png'; // MMS 이미지 파일 위치 (저장된 경로)
	$_POST['msg_type']     = 'LMS'; //  SMS, LMS, MMS등 메세지 타입을 지정
	// ※ msg_type 미지정시 글자수/그림유무가 판단되어 자동변환됩니다. 단, 개행문자/특수문자등이 2Byte로 처리되어 SMS 가 LMS로 처리될 가능성이 존재하므로 반드시 msg_type을 지정하여 사용하시기 바랍니다.

	/****************** 전송정보 설정끝 ***************/
	$sms['msg']			   = stripslashes($_POST['msg']);
	$sms['receiver']	   = $_POST['receiver'];
	$sms['destination']	   = $_POST['destination'];
	$sms['sender']		   = $_POST['sender'];
	$sms['rdate']		   = $_POST['rdate'];
	$sms['rtime']		   = $_POST['rtime'];
	//$sms['testmode_yn']	= empty($_POST['testmode_yn']) ? '' : $_POST['testmode_yn'];
	$sms['testmode_yn']	   = '';
	$sms['title']		   = $_POST['subject'];
	$sms['msg_type']	   = $_POST['msg_type'];


	$oCurl        = curl_init();
	// 이미지 전송 설정
	if(!empty($_POST['image'])) {
		if(file_exists($_POST['image'])) {
			$tmpFile = explode('/',$_POST['image']);
			$str_filename = $tmpFile[sizeof($tmpFile)-1];
			$tmp_filetype = mime_content_type($_POST['image']);
			if ((version_compare(PHP_VERSION, '5.5') >= 0)) { // PHP 5.5버전 이상부터 적용
				$sms['image'] = new CURLFile($_POST['image'], $tmp_filetype, $str_filename);
				curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, true);
			} else {
				$sms['image'] = '@'.$_POST['image'].';filename='.$str_filename. ';type='.$tmp_filetype;
			}
		}
	}

	$host_info    = explode("/", $sms_url);
	$port         = $host_info[0] == 'https:' ? 443 : 80;

	$oCurl        = curl_init();
	curl_setopt($oCurl, CURLOPT_PORT, $port);
	curl_setopt($oCurl, CURLOPT_URL, $sms_url);
	curl_setopt($oCurl, CURLOPT_POST, 1);
	curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
	curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
	$ret = curl_exec($oCurl);
	curl_close($oCurl);

	//echo $ret;
	$retArr   = json_decode($ret); // 결과배열
	//print_r($retArr); // Response 출력 (연동작업시 확인용)
	//return $alert;
}