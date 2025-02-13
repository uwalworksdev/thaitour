<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

function private_key()
{
    return env("PRIVATE_KEY");
}

function checkLikeTimeSale($bbs_idx){
    $wishModel = model("WishModel");
    $m_idx = session()->get("member")["idx"] ?? 0;   
    return $wishModel->getWishCntFromBbs($m_idx, $bbs_idx);
}

function getTimeSale() {
    $bbs = model("Bbs");
    try {
        $infoData = $bbs->list_time_sale();
        if (!$infoData) {
            throw new Exception("");
        }
        $resultArr = $infoData;
    } catch (Exception $err) {
        $resultArr = [];
    } finally {
        return $resultArr;
    }
}

function getHotelOption($idx){
    $connect = db_connect();
    $query = $connect->query("SELECT * FROM tbl_hotel_option WHERE idx = '$idx'");
    $result = $query->getRowArray();

    return $result ?? [];
}

function getViewProduct($product_idx){
    $product = model("ProductModel");
    try {
        $infoData = $product->getById($product_idx);
        if (!$infoData) {
            throw new Exception("");
        }
        $resultArr = $infoData;
    } catch (Exception $err) {
        $resultArr = [];
    } finally {
        return $resultArr;
    }
}

function getProductIdFromUrl($url) {
    $path = parse_url($url, PHP_URL_PATH);
    
    if (!$path) {
        return null;
    }

    $segments = explode("/", $path);

    $id = end($segments);

    return is_numeric($id) ? $id : null;
}

function getPolicy($p_idx)
{
    $policy = model("PolicyModel");
    try {
        $infoData = $policy->where("p_idx", $p_idx)->first();
        if (!$infoData) {
            throw new Exception("");
        }
        $resultArr = $infoData["policy_contents"];
    } catch (Exception $err) {
        $resultArr = "";
    } finally {
        return $resultArr;
    }
}

function get_deli_type()
{
    $_deli_type['W'] = "예약접수";
    $_deli_type['Y'] = "결제완료";
    $_deli_type['G'] = "결제대기";
    $_deli_type['J'] = "입금대기";
    $_deli_type['C'] = "예약취소";
    return $_deli_type;
}

function homeSetInfo()
{
    $Setting = model("Setting");
    try {
        $infoData = $Setting->info(1);
        if (!$infoData) {
            throw new Exception("");
        }
        $resultArr = $infoData;
    } catch (Exception $err) {

        $resultArr = [];
    } finally {
        return $resultArr;
    }
}

function convertToBath($product_price): float
{
    $setting = homeSetInfo();
    $product_price = (float)$product_price;
    $baht_thai = (float)($setting['baht_thai'] ?? 0);
    $product_price_baht = $product_price / $baht_thai;
    return round($product_price_baht, 2);
}

function convertToWon($product_price): float
{
    $setting = homeSetInfo();
    $product_price = (float)$product_price;
    $baht_thai = (float)($setting['baht_thai'] ?? 0);
    $product_price_won = $product_price * $baht_thai;
    return round($product_price_won, 2);
}

function no_file_ext($filename)
{

    $ext = explode(".", strtolower($filename));
    $cnt = count($ext) - 1;
    $extend = $ext[$cnt];
    $_ext = explode("|", "php|php3|php4|htm|inc|html|xls|exe");
    $chk = "Y";

    for ($i = 0; $i < count($_ext); $i++) {
        if ($extend == $_ext[$i])
            $chk = "N";
    }

    return $chk;
}

function ipagelisting($cur_page, $total_page, $n, $url)
{

    $retValue = "<div class='paging mt30'><ul>";
    if ($cur_page > 1) {
        $retValue .= "<li class='first'><a href='" . $url . "1' title='Go to next page'>&lt;&lt;  처음</a></li>";
        $retValue .= "<li class='prev'><a href='" . $url . ($cur_page - 1) . "' title='Go to first page'>&lt; 이전</a></li>";
    } else {
        $retValue .= "<li class='first'><a href='javascript:;' title='Go to next page'>&lt;&lt; 처음</a></li>";
        $retValue .= "<li class='prev'><a href='javascript:;' title='Go to first page'>&lt; 이전</a></li>";
    }
    $retValue .= "";
    $start_page = (((int)(($cur_page - 1) / 10)) * 10) + 1;
    $end_page = $start_page + 9;
    if ($end_page >= $total_page)
        $end_page = $total_page;
    if ($total_page == 0) {
        $retValue .= "<li class='active'><a href='javascript:;' title='Go to 0 page'><strong>1</strong></a></li>";
    } elseif ($total_page >= 1) {
        for ($k = $start_page; $k <= $end_page; $k++) {
            if ($cur_page != $k) {
                $retValue .= "<li><a href='$url$k' title='Go to page $k'>$k</a></li>";
            } else {
                $retValue .= "<li class='active'><a href='javascript:;' title='Go to $k page'><strong>$k</strong></a></li>";
            }
        }
    }
    $retValue .= "";
    if ($cur_page < $total_page) {
        $retValue .= "<li class='next'><a href='$url" . ($cur_page + 1) . "' title='Go to next page'>다음 &gt;</a></li>";
        $retValue .= "<li class='last'><a href='$url$total_page' title='Go to last page'>맨끝 &gt;&gt;</a></li>";
    } else {
        $retValue .= "<li class='next'><a href='javascript:;' title='Go to next page'>다음 &gt;</a></li>";
        $retValue .= "<li class='last'><a href='javascript:;' title='Go to last page'>맨끝 &gt;&gt;</a></li>";
    }
    $retValue .= "</ul></div>";
    return $retValue;
}

function fileCheckImgUpload($m_idx, $ufile, $rfile, $path, $fileType)
{
    if ($ufile == "" || $rfile == "") {
        return false;
    } else {
        //한글파일 파일명 대체
        $download = $path;
        $aa = date('YmdHms');

        $ext = substr(strrchr($ufile, "."), 1);     //확장자앞 .을 제거하기 위하여 substr()함수를 이용
        $ext = strtolower($ext);             //확장자를 소문자로 변환

        $check1 = $aa;
        $check2 = strtolower($ext);

        $ufile = $check1 . "_" . $m_idx . "_" . rand(0, 1000) . "." . $ext;
        $attached = $ufile;

        if ($fileType == "I") {
            if ($check2 != "gif" && $check2 != "jpg" && $check2 != "jpeg" && $check2 != "bmp" && $check2 != "ico") {
                echo "<script>
					alert('이미지 파일만 업로드할수있습니다.');
					history.back(1);
				</script>";
                exit;
            }
        } else {
            $attached = $ufile;
            $ufile = $download . $ufile;
        }
        if (file_exists($ufile)) {    // 같은 파일 존재
            $file_splited = explode(".", $attached);
            $i = 0;
            do {
                $tmp_filename = $file_splited[0] . $i . "." . $file_splited[1];
                $tmp_filelocation = $download . $tmp_filename;
                $i++;
            } while (file_exists($tmp_filelocation));
            $ufile = $tmp_filelocation;
            $attached = $tmp_filename;
        }

        if ($check2 == "png") {
            copy($rfile, $ufile);
        } else {
            copy($rfile, $ufile);
        }

        unlink($rfile);

        return $attached;
    }
}

function write_log($message)
{
    $dir = WRITEPATH . "logs/";

    if (!file_exists($dir)) {
        mkdir($dir);
    }

    $myfile = fopen($dir . date("Ymd") . ".txt", "a") or die("Unable to open file!");
    $txt = chr(13) . chr(10) . date("Y.m.d G:i:s") . "(" . $_SERVER['REMOTE_ADDR'] . ") : " . chr(13) . chr(10) . $message . chr(13) . chr(10);
    fwrite($myfile, chr(13) . chr(10) . $txt . chr(13) . chr(10));
    fclose($myfile);

}

function replacePatternsSms($input, $replacementValues)
{
    $replaceCallback = function ($matches) use ($replacementValues) {
        $key = $matches[1];
        return isset($replacementValues[$key]) ? $replacementValues[$key] : $matches[0];
    };

    return preg_replace_callback('/\{{(.*?)\}}/', $replaceCallback, $input);
}

function replacePatternsEmail($input, $replacementValues)
{
    $replaceCallback = function ($matches) use ($replacementValues) {
        $key = $matches[1];
        return isset($replacementValues[$key]) ? $replacementValues[$key] : $matches[0];
    };

    return preg_replace_callback('/\[(.*?)\]/', $replaceCallback, $input);
}

function autoSms($code, $to_phone, $_tmp_fir_array)
{

    $smsModel = model("SmsModel");

    $row = $smsModel->where('code', $code)->first();

    // 해당 코드가 자동 발송이 가능한가?
    if ($row['autosend'] != "Y") {
        return false;
        exit;
    }

    // 문자 보낼 내역이 없다면
    if ($row['content'] == "") {
        return false;
        exit;
    }

    // 문자 보낼 내역
    $_tmp_content = viewSQ($row['content']);

    $_tmp_content = replacePatternsSms($_tmp_content, $_tmp_fir_array);

    return send_aligo($_tmp_content, $to_phone, "");

}


function send_aligo($msg, $to_phone, $title = "")
{

    $setting = homeSetInfo();

    $to_phone = str_replace("-", "", $to_phone);

    /****************** 인증정보 시작 ******************/
    $sms_url = "https://apis.aligo.in/send/"; // 전송요청 URL
    $sms['user_id'] = $setting['allim_userid']; // SMS 아이디
    $sms['key'] = $setting['allim_apikey']; // 인증키

    $_POST['msg'] = $msg; // 메세지 내용 : euc-kr로 치환이 가능한 문자열만 사용하실 수 있습니다. (이모지 사용불가능)
    $_POST['receiver'] = $to_phone; // 수신번호  01111111111, 01111111112
    $_POST['destination'] = ''; // 수신인 %고객명% 치환  01111111111|담당자,01111111112|홍길동
    $_POST['sender'] = $setting['sms_phone']; // 발신번호
    $_POST['rdate'] = ''; // 예약일자 - 20161004 : 2016-10-04일기준
    $_POST['rtime'] = ''; // 예약시간 - 1930 : 오후 7시30분
    $_POST['testmode_yn'] = 'Y'; // Y 인경우 실제문자 전송X , 자동취소(환불) 처리
    $_POST['subject'] = $setting['site_name'] . '입니다.'; //  LMS, MMS 제목 (미입력시 본문중 44Byte 또는 엔터 구분자 첫라인)
    //$_POST['image']        = '../data/brand/20210314140356.png'; // MMS 이미지 파일 위치 (저장된 경로)
    $_POST['msg_type'] = 'LMS'; //  SMS, LMS, MMS등 메세지 타입을 지정
    // ※ msg_type 미지정시 글자수/그림유무가 판단되어 자동변환됩니다. 단, 개행문자/특수문자등이 2Byte로 처리되어 SMS 가 LMS로 처리될 가능성이 존재하므로 반드시 msg_type을 지정하여 사용하시기 바랍니다.

    /****************** 전송정보 설정끝 ***************/
    $sms['msg'] = stripslashes($_POST['msg']);
    $sms['receiver'] = $_POST['receiver'];
    $sms['destination'] = $_POST['destination'];
    $sms['sender'] = $_POST['sender'];
    $sms['rdate'] = $_POST['rdate'];
    $sms['rtime'] = $_POST['rtime'];
    //$sms['testmode_yn']	= empty($_POST['testmode_yn']) ? '' : $_POST['testmode_yn'];
    $sms['testmode_yn'] = '';
    $sms['title'] = $_POST['subject'];
    $sms['msg_type'] = $_POST['msg_type'];


    $oCurl = curl_init();
    // 이미지 전송 설정
    if (!empty($_POST['image'])) {
        if (file_exists($_POST['image'])) {
            $tmpFile = explode('/', $_POST['image']);
            $str_filename = $tmpFile[sizeof($tmpFile) - 1];
            $tmp_filetype = mime_content_type($_POST['image']);
            if ((version_compare(PHP_VERSION, '5.5') >= 0)) { // PHP 5.5버전 이상부터 적용
                $sms['image'] = new CURLFile($_POST['image'], $tmp_filetype, $str_filename);
                curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, true);
            } else {
                $sms['image'] = '@' . $_POST['image'] . ';filename=' . $str_filename . ';type=' . $tmp_filetype;
            }
        }
    }

    $host_info = explode("/", $sms_url);
    $port = $host_info[0] == 'https:' ? 443 : 80;

    $oCurl = curl_init();
    curl_setopt($oCurl, CURLOPT_PORT, $port);
    curl_setopt($oCurl, CURLOPT_URL, $sms_url);
    curl_setopt($oCurl, CURLOPT_POST, 1);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
    $ret = curl_exec($oCurl);
    curl_close($oCurl);

    //echo $ret;
    $retArr = json_decode($ret); // 결과배열
    //print_r($retArr); // Response 출력 (연동작업시 확인용)
    return true;
}

function phone_chk($to_phone)
{

    $_chk_no = mt_rand(100000, 999999);

    $member = session()->get('member');
    $member['phone_chk'] = $_chk_no;

    session()->set("member", $member);

    $code = "S07";
    $_tmp_fir_array = ['NO' => $_chk_no];
    autoSms($code, $to_phone, $_tmp_fir_array);

    return true;
}

// 결제방법
$_pg_Method = array();
$_pg_Method['Card'] = "신용/체크카드";
$_pg_Method['Rbank'] = "실시간계좌이체";
$_pg_Method['Vbank'] = "가상계좌";
$_pg_Method['Dbank'] = "무통장";
$_pg_Method['Cash'] = "포인트";

function getPgMethod($method)
{
    global $_pg_Method;
    return $_pg_Method[$method] ?? "";
}

function getPgMethods()
{
    global $_pg_Method;
    return $_pg_Method;
}

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

function email_chk($email)
{

    $_chk_no = mt_rand(100000, 999999);

    $member = session("member");
    $member['email_chk'] = $_chk_no;
    session()->set("member", $member);

    $code = "A13";
    $user_mail = $email;
    $_tmp_fir_array = [
        'cert_num' => $_chk_no
    ];
    autoEmail($code, $user_mail, $_tmp_fir_array);
    return true;
}

function phone_chk_ok($chkNum)
{
    $phone_chk = session('member.phone_chk');
    if ($phone_chk == "") {
        return "인증 시간이 만료되었거나, 발급되지 않았습니다. 다시 발급해주세요.";
    }

    if ($chkNum == $phone_chk) {
        return "Y";
    } else {
        return "인증에 실패하셨습니다.";
    }
}

function email_chk_ok($chkNum)
{
    $email_chk = session('member.email_chk');

    if ($email_chk == "") {
        return "인증 시간이 만료되었거나, 발급되지 않았습니다. 다시 발급해주세요.";
    }

    if ($chkNum == $email_chk) {
        return "Y";
    } else {
        return "인증에 실패하셨습니다.";
    }
}

function updateSQ($textToFilter)
{
    //a = &#97;
    //e = &#101;
    //i = &#105;
    //o = &#111;
    //u  = &#117;

    //A = &#65;
    //E = &#69;
    //I = &#73;
    //O = &#79;
    //U = &#85;
    if ($textToFilter != null) {
        $textToFilter = str_replace('insert', 'ins&#101rt', $textToFilter);
        $textToFilter = str_replace('select', 's&#101lect', $textToFilter);
        $textToFilter = str_replace('values', 'valu&#101s', $textToFilter);
        $textToFilter = str_replace('where', 'wher&#101', $textToFilter);
        $textToFilter = str_replace('order', 'ord&#101r', $textToFilter);
        $textToFilter = str_replace('into', 'int&#111', $textToFilter);
        $textToFilter = str_replace('drop', 'dr&#111p', $textToFilter);
        $textToFilter = str_replace('delete', 'delet&#101', $textToFilter);
        $textToFilter = str_replace('update', 'updat&#101', $textToFilter);
        $textToFilter = str_replace('set', 's&#101t', $textToFilter);
        $textToFilter = str_replace('flush', 'fl&#117sh', $textToFilter);
        $textToFilter = str_replace("'", "''", $textToFilter);
        $textToFilter = str_replace('"', "&#34", $textToFilter);
        $textToFilter = str_replace('>', "&gt;", $textToFilter);
        $textToFilter = str_replace('<', "&lt;", $textToFilter);
        $textToFilter = str_replace('script', 'scr&#105pt', $textToFilter);
        //	$textToFilter = nl2br($textToFilter);
        $filterInputOutput = $textToFilter;
        return trim($filterInputOutput);
    }

}

function viewSQ($textToFilter)
{
    $textToFilter = str_replace('ins&#101rt', 'insert', $textToFilter);
    $textToFilter = str_replace('s&#101lect', 'select', $textToFilter);
    $textToFilter = str_replace('valu&#101s', 'values', $textToFilter);
    $textToFilter = str_replace('wher&#101', 'where', $textToFilter);
    $textToFilter = str_replace('ord&#101r', 'order', $textToFilter);
    $textToFilter = str_replace('int&#111', 'into', $textToFilter);
    $textToFilter = str_replace('dr&#111p', 'drop', $textToFilter);
    $textToFilter = str_replace('delet&#101', 'delete', $textToFilter);
    $textToFilter = str_replace('updat&#101', 'update', $textToFilter);
    $textToFilter = str_replace('s&#101t', 'set', $textToFilter);
    $textToFilter = str_replace('fl&#117sh', 'flush', $textToFilter);
    $textToFilter = str_replace('&amp;', "&", $textToFilter);
    $textToFilter = str_replace('&#59', ";", $textToFilter);
    $textToFilter = str_replace('&gt;', ">", $textToFilter);
    $textToFilter = str_replace('&lt;', "<", $textToFilter);
    $textToFilter = str_replace('&#34', "\"", $textToFilter);
    $textToFilter = str_replace('&amp;', "&", $textToFilter);
    $textToFilter = str_replace('&amp;', "&", $textToFilter);
    $textToFilter = str_replace('scr&#105pt', " ", $textToFilter);

    return $textToFilter;
}

function updateSQText($textToFilter)
{
    //a = &#97;
    //e = &#101;
    //i = &#105;
    //o = &#111;
    //u  = &#117;

    //A = &#65;
    //E = &#69;
    //I = &#73;
    //O = &#79;
    //U = &#85;
    if ($textToFilter != null) {
        $textToFilter = str_replace('insert', 'ins&#101rt', $textToFilter);
        $textToFilter = str_replace('select', 's&#101lect', $textToFilter);
        $textToFilter = str_replace('values', 'valu&#101s', $textToFilter);
        $textToFilter = str_replace('where', 'wher&#101', $textToFilter);
        $textToFilter = str_replace('order', 'ord&#101r', $textToFilter);
        $textToFilter = str_replace('into', 'int&#111', $textToFilter);
        $textToFilter = str_replace('drop', 'dr&#111p', $textToFilter);
        $textToFilter = str_replace('delete', 'delet&#101', $textToFilter);
        $textToFilter = str_replace('update', 'updat&#101', $textToFilter);
        $textToFilter = str_replace('set', 's&#101t', $textToFilter);
        $textToFilter = str_replace('flush', 'fl&#117sh', $textToFilter);
        $textToFilter = str_replace("'", "''", $textToFilter);
        $textToFilter = str_replace('"', "&#34", $textToFilter);
        $textToFilter = str_replace('>', "&gt;", $textToFilter);
        $textToFilter = str_replace('<', "&lt;", $textToFilter);
        $textToFilter = str_replace('script', 'scr&#105pt', $textToFilter);
        $textToFilter = strip_tags($textToFilter);
        //	$textToFilter = nl2br($textToFilter);
        $filterInputOutput = $textToFilter;
        return trim($filterInputOutput);
    }

}

function sqlSecretConver($value, $way)
{
    $connect = db_connect();
    $private_key = private_key();

    $outText = "";

    if ($way == "encode") {

        $sql = " SELECT CONVERT( TO_BASE64(hex(AES_ENCRYPT('" . $value . "', '" . $private_key . "') ) ) using UTF8) as pass FROM dual ";
        $row = $connect->query($sql)->getRowArray();

        $outText = $row['pass'];

    } else if ($way == "decode") {

        $sql = " SELECT CONVERT( AES_DECRYPT( UNHEX( FROM_BASE64('" . $value . "') ), '" . $private_key . "') using UTF8) as pass FROM dual ";
		write_log($sql);
        $row = $connect->query($sql)->getRowArray();

        $outText = $row['pass'];
    }


    return $outText;
}

function encryptField($value, $way)
{
    $connect = db_connect();
    $private_key = private_key();

    if ($way == "encode") {

        $query = $connect->query("SELECT HEX(AES_ENCRYPT(?, ?)) AS encrypted_name", [$value, $private_key]);
        $result = $query->getRow();

        $outText = $result->encrypted_name;

    } else if ($way == "decode") {

        $query = $connect->query("SELECT HEX(AES_ENCRYPT(?, ?)) AS encrypted_name", [$value, $private_key]);
        $result = $query->getRow();

        $outText = $result->encrypted_name;
    }


    return $outText ?? null;

}

function getImage($path)
{
    if (!is_file($_SERVER["DOCUMENT_ROOT"] . "/{$path}")) return "/images/product/noimg.png";
    return $path;
}

function get_rand($size)
{
    $feed = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $rand_str = "";
    for ($i = 0; $i < $size; $i++) {
        $rand_str .= substr($feed, rand(0, strlen($feed) - 1), 1);
    }
    return $rand_str;
}

function get_rand_num($size)
{
    $feed = "0123456789";
    $rand_str = "";
    for ($i = 0; $i < $size; $i++) {
        $rand_str .= substr($feed, rand(0, strlen($feed) - 1), 1);
    }
    return $rand_str;
}

function img_link($code)
{
	if($code == "1303") $link = "product";
	if($code == "1325") $link = "hotel";
	if($code == "1317") $link = "hotel";
	if($code == "1320") $link = "hotel";
	if($code == "1301") $link = "product";
	if($code == "1302") $link = "product";
    return $link;

}

function prog_link($code)
{
	if($code == "1303") $link = "/product-hotel/hotel-detail/";
	if($code == "1325") $link = "/product-spa/spa-details/";
	if($code == "1317") $link = "/ticket/ticket-detail/";
	if($code == "1320") $link = "/product-restaurant/restaurant-detail/";
	if($code == "1301") $link = "/product-tours/item_view/";
	if($code == "1302") $link = "/product-golf/golf-detail/";
    return $link;

}

function getDateRange($startDate, $endDate) {
    $dateList = []; // 날짜를 저장할 배열
    $start    = new DateTime($startDate); // 시작 날짜
    $end      = new DateTime($endDate); // 종료 날짜
    $end->modify('+1 day'); // 종료일 포함

    $interval   = new DateInterval('P1D'); // 하루 간격
    $datePeriod = new DatePeriod($start, $interval, $end);

    foreach ($datePeriod as $date) {
        $dateList[] = $date->format('Y-m-d'); // 원하는 형식으로 저장
    }

    return $dateList;
}

function dateToYoil($strdate)
{
	$yoil = array("일", "월", "화", "수", "목", "금", "토");
	$date = $strdate;

	return $yoil[date('w', strtotime($date))];
}

function day_after($from_date, $days)
{
	$date = new DateTime($from_date);

	// 종료일 생성
	$date->modify('+'. $days .'days');

	// 결과 출력
	$to_date   = $date->format('Y-m-d'); // 2024-12-10

	return $to_date;
}

// API CALL foreach 예시
function jsonRespDump($resp){
	//global $mid, $merchantKey;
	$respArr = json_decode($resp);
	foreach ( $respArr as $key => $value ){
		/*if($key == "Amt" || $key == "CancelAmt"){
			$payAmt = $value;
		}
		*if($key == "TID"){
			$tid = $value;
		}
		// 승인 응답으로 받은 Signature 검증을 통해 무결성 검증을 진행하여야 합니다.
		if($key == "Signature"){
			$paySignature = bin2hex(hash('sha256', $tid. $mid. $payAmt. $merchantKey, true));
			if($value != $paySignature){
				echo '비정상 거래! 취소 요청이 필요합니다.</br>';
				echo '승인 응답 Signature : '. $value. '</br>';
				echo '승인 생성 Signature : '. $paySignature. '</br>';
			}
		}*/
		echo "$key=". $value."<br />";
	}
}

//Post api call
function reqPost(Array $data, $url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);					//connection timeout 15 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));	//POST data
	curl_setopt($ch, CURLOPT_POST, true);
	$response = curl_exec($ch);
	curl_close($ch);	 
	return $response;
}

function set_all_mileage($m_idx)
{
    $connect = db_connect();

	$sql		 = " select ifnull(sum(order_mileage),0) as sum_mileage from tbl_order_mileage where m_idx = '". $m_idx ."' ";
    $row         = $connect->query($sql)->getRowArray();
	$sum_mileage = $row["sum_mileage"];

	$fsql = "
				update tbl_member SET 
					mileage	  = '". $sum_mileage ."'
				 where m_idx  = '". $m_idx ."' 
			";
	$db4 = $connect->query($fsql);
}


function get_korean_day($date)
{
		 $weekdays  = ['일', '월', '화', '수', '목', '금', '토'];
		 $dowIndex  = date('w', strtotime($date));									
		 $dateDow   = $weekdays[$dowIndex];								
		 
		 return $dateDow;
}	

function product_price($idx)
{
	 
	     $setting   = homeSetInfo();
         $baht_thai = (float)($setting['baht_thai'] ?? 0);
		 $connect   = db_connect();

		 $sql       = "SELECT * FROM tbl_room_price WHERE product_idx = '". $idx ."' AND goods_date = '". date('Y-m-d') ."' ";
		 write_log($sql);
         $row       = $connect->query($sql)->getRowArray();
		 $price     = $row['goods_price2'] + $row['goods_price2'];

		 $sql       = "SELECT GROUP_CONCAT(bed_price ORDER BY bed_price ASC) AS price_list FROM tbl_hotel_rooms WHERE goods_code = '". $idx ."'";
		 write_log($sql);
         $row       = $connect->query($sql)->getRowArray();
         $arr       = explode(",", $row['bed_price']); 
	     $price1    = $arr[0];
		 
		 $price     = $price + $price1;
	     $price_won = (int)($price * $baht_thai);
		 
		 $product_price = $price_won ."|". $price;
		 
		 return $product_price;
	 	 
}
?>