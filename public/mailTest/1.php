<?php

		$code = "A01";
        $user_mail = "diana001@naver.com";
        $user_name = "김태균";
        $_tmp_fir_array = [
            'name' => $user_name
        ];
		
		autoEmail($code, $user_mail, $_tmp_fir_array);


function autoEmail($code, $user_mail, $_tmp_fir_array)
{


    $is_ssl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    $protocol = $is_ssl ? 'https://' : 'http://';
    $domain = $_SERVER['HTTP_HOST'];
    $http_domain_url = $protocol . $domain;

    $infoRow = homeSetInfo();

    $_tmp_fir_array['home_name'] = $infoRow['home_name'];
    $_tmp_fir_array['addr1'] = $infoRow['addr1'];
    $_tmp_fir_array['addr2'] = $infoRow['addr2'];
    $_tmp_fir_array['com_owner'] = $infoRow['com_owner'];
    $_tmp_fir_array['comnum'] = $infoRow['comnum'];
    $_tmp_fir_array['tour_no'] = $infoRow['tour_no'];
    $_tmp_fir_array['mallOrder'] = $infoRow['mallOrder'];
    $_tmp_fir_array['custom_phone'] = $infoRow['custom_phone'];
    $_tmp_fir_array['qna_email'] = $infoRow['qna_email'];
    $_tmp_fir_array['site_name'] = $infoRow['site_name'];
    $_tmp_fir_array['admin_email'] = $infoRow['admin_email'];
    $_tmp_fir_array['info_owner'] = $infoRow['info_owner'];
    $_tmp_fir_array['http_domain_url'] = $http_domain_url;

    $emailModel = model("AutoMailModel");
    $row = $emailModel->where('code', $code)->first();

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


    // $_tmp_fir_array = explode("|||", $replace_text);

    // for ($i = 1; $i < sizeof($_tmp_fir_array); $i++) {
    //     $_tmp_sec_array = explode(":::", $_tmp_fir_array[$i]);

    //     $_f_txt = $_tmp_sec_array[0];
    //     $_s_txt = $_tmp_sec_array[1];

    //     $_tmp_content = str_replace($_f_txt, $_s_txt, $_tmp_content);
    // }

    //mailer($nameFrom, $mailFrom, $mailTo, $subject, $_tmp_content);

    $nameFrom = $infoRow['site_name'];
    $mailFrom = $infoRow['smtp_id'];
    $to_name = $user_mail;
    $to_email = $user_mail;

    $_tmp_content = replacePatternsEmail($_tmp_content, $_tmp_fir_array);


    $err = send_mail($nameFrom, $mailFrom, $to_name, $to_email, $subject, $_tmp_content);
    return $err;
}

function send_mail($from_name, $from_email, $to_name, $to_email, $subject, $message, $ext_header = "")
{
    $auth_id = "";
    $param_arr = array();
    // 추가 설정
    if ($ext_header != "") {
        $arr = explode("\n", $ext_header);
        $cnt = count($arr);
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
    $header .= "Organization: " . ((isset($param_arr["Organization"]) && $param_arr["Organization"] != "") ? $param_arr["Organization"] : $_SERVER['SERVER_NAME']) . "\n";
    if (isset($param_arr["Sender"]) && $param_arr["Sender"] != "")
        $header .= "Sender: " . $param_arr["Sender"] . "\n";
    if (isset($param_arr["Reply-To"]) && (string)$param_arr["Reply-To"] != "")
        $header .= "Reply-To: " . $param_arr["Reply-To"] . "\n";
    if (isset($param_arr["Errors-To"]) && (string)$param_arr["Errors-To"] != "")
        $header .= "Errors-To: " . $param_arr["Errors-To"] . "\n";
    if (isset($param_arr["X-Priority"]) && (string)$param_arr["X-Priority"] != "")
        $header .= "X-Priority: " . (isset($param_arr["X-Priority"]) && (string)$param_arr["X-Priority"]) . "\n";
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
    $infoData = homeSetInfo();
    if (!$infoData) {
        return "Error:data - No Setting input";
    }

    $host = $infoData['smtp_host'];
    $id = base64_encode($infoData['smtp_id']);
    $pw = base64_encode($infoData['smtp_pass']);

    $from_email = trim($from_email);
    $to_email = trim($to_email);

    //if($host == "") return "Error:NO host";

    if ($host == "")
        $host = "localhost";
    $port = 587; // 기본이 25 업체 SMTP PORT 설정에 따라서 변경
    $limit = 30;

    if (!$socket = fsockopen($host, $port, $errno, $errstr, $limit))
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
		
		
?>		