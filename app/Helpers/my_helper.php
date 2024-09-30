<?php

if (!function_exists('private_key')) {
    function private_key()
    {
        return "gkdlghwn!@12";
    }
}

if (!function_exists('isDateInRange')) {
    function isDateInRange($date, $deadline_date)
    {
        $deadline_date_array = explode(",", $deadline_date);
        $deadline_date_array = array_filter($deadline_date_array, function ($value) {
            return $value;
        });
        $is_date_in_range = false;

        foreach ($deadline_date_array as $value) {
            $date_array = explode("~", $value);
            $dateObj = new DateTime($date);
            $startObj = new DateTime($date_array[0]);
            $endObj = new DateTime($date_array[1]);

            if ($dateObj >= $startObj && $dateObj <= $endObj) {
                $is_date_in_range = true;
            }
        }

        return $is_date_in_range;
    }
}


function dowYoil($strdate)
{
    $yoil = array("일", "월", "화", "수", "목", "금", "토");
    $date = $strdate;

    $dow = $yoil[date('w', strtotime($date))];
    return $dow;
}


function get_device()
{
    // 모바일 기종(배열 순서 중요, 대소문자 구분 안함)
    $ary_m = array("iPhone", "iPod", "IPad", "Android", "Blackberry", "SymbianOS|SCH-M\d+", "Opera Mini", "Windows CE", "Nokia", "Sony", "Samsung", "LGTelecom", "SKT", "Mobile", "Phone");
    $str = "P";
    for ($i = 0; $i < count($ary_m); $i++) {
        if (preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            //return $ary_m[$i];
            $str = "M";
            break;
        }
    }
    return $str;
}


function sql_password($value)
{
    $row = db_connect()->query(" select SHA1(MD5('" . $value . "')) as pass ")->getRowArray();
    return $row['pass'];
}

function goUrl($url = "", $msg = "")
{
    echo "<script type='text/javascript'>";
    if ($msg) {
        echo "	alert('" . $msg . "');";
    }
    if ($url) {

        echo "setTimeout( function() {	";
        echo "	location.href='" . $url . "';";
        echo "}, 1000);					";

        //echo "	location.href='".$url."';";
    }
    echo "</script>";
}

function getLoginDeviceUserChk($user_id)
{

    $device_type = get_device();
    $gTime = time() + 86400; //하루 24시간
    $cookieValue = "user_id_" . $user_id;

    if ($user_id != "") {

        $cookieVal = cookie($cookieValue);

        if ($cookieVal == "") {
            $sql = " select * from tbl_login_device where DATE(regdate) = DATE(now())";
            $row = db_connect()->query($sql)->getRowArray();
            $login_type_P = $row['login_type_P'];
            $login_type_M = $row['login_type_M'];

            if ($login_type_P == "") {

                if ($device_type == "P") {
                    $login_type_P = 1;
                    $login_type_M = 0;
                } else if ($device_type == "M") {
                    $login_type_P = 0;
                    $login_type_M = 1;
                }

                $sql = " insert into tbl_login_device set regdate = now()
					, login_type_P = " . $login_type_P . "
					, login_type_M = " . $login_type_M . "
					, itemCnt_P = 0
					, itemCnt_M = 0
					";

                db_connect()->query($sql);
            } else {

                if ($device_type == "P") {
                    $login_type_P = $login_type_P + 1;
                    $sSQl = " login_type_P = " . $login_type_P;
                } else if ($device_type == "M") {
                    $login_type_M = $login_type_M + 1;
                    $sSQl = " login_type_M = " . $login_type_M;
                }

                $sql = " update tbl_login_device set " . $sSQl . " where DATE(regdate) = DATE(now())";
                db_connect()->query($sql);
            }
        }

        setcookie($cookieValue, $cookieValue, $gTime);
    }

    $out_text = "";

    return $out_text;
}

function getLoginIPChk()
{
    $REMOTE_ADDR = request()->getIPAddress();

    $gTime = time() + 86400; //하루 24시간
    $cookieValue = "user_ip_" . str_replace(".", "", $REMOTE_ADDR);

    $cookieVal = $_COOKIE[$cookieValue] ?? "";

    if ($cookieVal == "") {

        $sql = " select * from tbl_login_ip where loginIP = '" . $REMOTE_ADDR . "' ";

        $row = db_connect()->query($sql)->getRowArray();
        $loginIP = $row['loginIP'];
        $loginCnt = $row['loginCnt'];

        if ($loginIP == "") {
            $sql = " insert into tbl_login_ip set loginIP = '" . $REMOTE_ADDR . "', loginCnt = 1";
            db_connect()->query($sql);
        } else {
            $loginCnt = $loginCnt + 1;
            $sql = "
					update tbl_login_ip set loginCnt = " . $loginCnt . " where loginIP = '" . $REMOTE_ADDR . "'
				";
            db_connect()->query($sql);
        }
    }

    setcookie($cookieValue, $cookieValue, $gTime);

    $out_text = "";
    return $out_text;
}

function ipagelisting2($cur_page, $total_page, $n, $url, $deviceType = 'P', $focus_element_id = "")
{
    if ($focus_element_id) {
        $focus_element_id = "#" . $focus_element_id;
    }
    $page_range = $deviceType === 'M' ? 5 : 10;

    if ($total_page < 2) {
        $hide = "style='display:none;'";
    } else {
        $hide = "";
    }

    $retValue = "<div class='paging' $hide><ul class='page'>";

    if ($cur_page > 1) {
        $retValue .= "<li class='skip backward'><a href='" . $url . "1$focus_element_id' title='Go to first page'></a></li>";
    } else {
        $retValue .= "<li class='skip backward'><a href='javascript:;' title='Go to first page'></a></li>";
    }

    if ($cur_page > ($deviceType === 'M' ? 5 : 10)) {
        $retValue .= "<li class='preview one'><a href='" . $url . ($cur_page - ($deviceType === 'M' ? 5 : 10)) . "$focus_element_id' title='Go to previous page'></a></li>";
    } else {
        $retValue .= "<li class='preview one'><a href='javascript:;' title='Go to previous page'></a></li>";
    }

    $start_page = ((int)(($cur_page - 1) / $page_range)) * $page_range + 1;
    $end_page = min($start_page + $page_range - 1, $total_page);

    for ($k = $start_page; $k <= $end_page; $k++) {
        if ($cur_page != $k) {
            $retValue .= "<li><a href='$url$k$focus_element_id' title='Go to page $k'>$k</a></li>";
        } else {
            $retValue .= "<li class='active'><a href='javascript:;' title='Go to page $k'><strong>$k</strong></a></li>";
        }
    }

    if ($cur_page < $total_page - ($deviceType === 'M' ? 5 : 10)) {
        $retValue .= "<li class='next one'><a href='$url" . ($cur_page + ($deviceType === 'M' ? 5 : 10)) . "$focus_element_id' title='Go to next page'></a></li>";
    } else {
        $retValue .= "<li class='next one'><a href='javascript:;' title='Go to next page'></a></li>";
    }

    if ($cur_page < $total_page) {
        $retValue .= "<li class='skip forward'><a href='" . $url . $total_page . "$focus_element_id' title='Go to last page'></a></li>";
    } else {
        $retValue .= "<li class='skip forward'><a href='javascript:;' title='Go to last page'></a></li>";
    }

    $retValue .= "</ul></div>";
    return $retValue;
}

function ipagelistingSub($cur_page, $total_page, $n, $url, $deviceType = 'P', $focus_element_id = "")
{
    if ($focus_element_id) {
        $focus_element_id = "#" . $focus_element_id;
    }
    $page_range = $deviceType === 'M' ? 5 : 10;

    $retValue = "<div class='pagination'>";

    if ($cur_page > 1) {
        $retValue .= "<a class='page-link' href='" . $url . "1$focus_element_id' title='Go to first page'>
						<img src='/images/community/pagination_prev.png' alt='pagination_prev'>
					</a>";
    } else {
        $retValue .= "<a class='page-link' href='javascript:;'  title='Go to first page'>
						<img src='/images/community/pagination_prev.png' alt='pagination_prev'>
					</a>";
    }

    if ($cur_page > 1) {
        $retValue .= "<a class='page-link' style='margin-right: 24px;' href='" . $url . ($cur_page - 1) . "$focus_element_id' title='Go to previous page'>
						<img src='/images/community/pagination_prev_s.png' alt='pagination_prev'>
					</a>";
    } else {
        $retValue .= "<a class='page-link' style='margin-right: 24px;' href='javascript:;' title='Go to previous page'>
						<img src='/images/community/pagination_prev_s.png' alt='pagination_prev'>
					</a>";
    }

    $start_page = ((int)(($cur_page - 1) / $page_range)) * $page_range + 1;
    $end_page = min($start_page + $page_range - 1, $total_page);

    for ($k = $start_page; $k <= $end_page; $k++) {
        if ($cur_page != $k) {
            $retValue .= "<a class='page-link' href='$url$k$focus_element_id' title='Go to page $k'>$k</a>";
        } else {
            $retValue .= "<a class='page-link active' href='javascript:;' title='Go to page $k'><strong>$k</strong></a>";
        }
    }

    if ($cur_page < $total_page) {
        $retValue .= "<a class='page-link' style='margin-left: 24px;' href='$url" . ($cur_page + 1) . "$focus_element_id' title='Go to next page'>
						<img src='/images/community/pagination_next_s.png' alt='pagination_next'>
					</a>";
    } else {
        $retValue .= "<a class='page-link' style='margin-left: 24px;' href='javascript:;' title='Go to next page'>
						<img src='/images/community/pagination_next_s.png' alt='pagination_next'>
					</a>";
    }

    if ($cur_page < $total_page) {
        $retValue .= "<a class='page-link'  href='" . $url . $total_page . "$focus_element_id' title='Go to last page'>
						<img src='/images/community/pagination_next.png' alt='pagination_next'>
					</a>";
    } else {
        $retValue .= "<a class='page-link' href='javascript:;' title='Go to last page'>
						<img src='/images/community/pagination_next.png' alt='pagination_next'>
					</a>";
    }

    $retValue .= "</div>";
    return $retValue;
}

function device_chk()
{
    // 모바일 기종(배열 순서 중요, 대소문자 구분 안함)
    $ary_m = array("iPhone", "iPod", "IPad", "Android", "Blackberry", "SymbianOS|SCH-M\d+", "Opera Mini", "Windows CE", "Nokia", "Sony", "Samsung", "LGTelecom", "SKT", "Mobile", "Phone");
    $str = "PC";
    for ($i = 0; $i < count($ary_m); $i++) {
        if (preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            //return $ary_m[$i];
            $str = "MO";
            break;
        }
    }
    return $str;
}

function get_status_name($status)
{
    $str = "";
    if ($status == "W") {
        $str = "예약접수";
    } elseif ($status == "Y") {
        $str = "결제완료";
    } elseif ($status == "G") {
        $str = "예약금대기";
    } elseif ($status == "J") {
        $str = "예약금입금대기";
    } elseif ($status == "C") {
        $str = "예약취소";
    } elseif ($status == "R") {
        $str = "잔금대기";
    }
    return $str;
}

;
function get_mileage_name($code)
{
    $str = "";
    if ($code == "tour") {
        $str = "여행";
    } elseif ($code == "guide") {
        $str = "가이드";
    } elseif ($code == "trans") {
        $str = "마일리지양도";
    } elseif ($code == "trans_del") {
        $str = "마일리지양도거절";
    } elseif ($code == "receive") {
        $str = "마일리지양도";
    } elseif ($code == "admin") {
        $str = "관리자부여";
    }
    return $str;
}

function chk_member_id($userid)
{
    $connect = db_connect();

    $fsql = " select count(*) cnts from tbl_member where user_id = '" . $userid . "'";
    $frow = $connect->query($fsql)->getRowArray();

    return $frow['cnts'];
}

function chk_member_col($userid, $cols)
{
    $connect = db_connect();
    if (chk_member_id($userid) < 1) {

        return "error";

    } else {
        $fsql = " select " . $cols . " as outcol from tbl_member where user_id = '" . $userid . "'";
        $frow = $connect->query($fsql)->getRowArray();

        return $frow['outcol'];
    }
}

function DateAdd($interval, $number, $date)
{

    //getdate()함수를 통해 얻은 배열값을 각각의 변수에 지정합니다.

    $date_time_array = getdate($date);
    $hours = $date_time_array["hours"];
    $minutes = $date_time_array["minutes"];
    $seconds = $date_time_array["seconds"];
    $month = $date_time_array["mon"];
    $day = $date_time_array["mday"];
    $year = $date_time_array["year"];


    //switch()구문을 사용해서 interval에 따라 적용합니다.

    switch ($interval) {
        case "yyyy":
            $year += $number;
            break;

        case "q":
            $year += ($number * 3);
            break;

        case "m":
            $month += $number;
            break;

        case "y":
        case "d":
        case "w":
            $day += $number;
            break;

        case "ww":
            $day += ($number * 7);
            break;

        case "h":
            $hours += $number;
            break;

        case "n":
            $minutes += $number;
            break;

        case "s":
            $seconds += $number;
            break;

    }


    $timestamp = date("Y-m-d", mktime($hours, $minutes, $seconds, $month, $day, $year));
    return $timestamp;
}

function strAsterisk($string)
{

    $string = trim($string);
    $length = mb_strlen($string, 'utf-8');
    $string_changed = $string;
    if ($length <= 2) {
        // 한두 글자면 그냥 뒤에 별표 붙여서 내보낸다.
        $string_changed = mb_substr($string, 0, 1, 'utf-8') . '*';
    }
    if ($length >= 3) {
        // 3으로 나눠서 앞뒤.
        $leave_length = floor($length / 3); // 남겨 둘 길이. 반올림하니 너무 많이 남기게 돼, 내림으로 해서 남기는 걸 줄였다.
        $asterisk_length = $length - ($leave_length * 2);
        $offset = $leave_length + $asterisk_length;
        $head = mb_substr($string, 0, $leave_length, 'utf-8');
        $tail = mb_substr($string, $offset, $leave_length, 'utf-8');
        $string_changed = $head . implode('', array_fill(0, $asterisk_length, '*')) . $tail;
    }
    return $string_changed;
}

function createAndUpdateCaptcha()
{
    $session = session();
    $image = imagecreatetruecolor(200, 50);

    $background = imagecolorallocate($image, 22, 86, 165);
    $text_color = imagecolorallocate($image, 255, 255, 255);
    $noise_color = imagecolorallocate($image, 200, 200, 200);

    imagefill($image, 0, 0, $background);

    for ($i = 0; $i < 1000; $i++) {
        imagesetpixel($image, rand(0, 200), rand(0, 50), $noise_color);
    }

    for ($i = 0; $i < 10; $i++) {
        imageline($image, rand(0, 200), rand(0, 50), rand(0, 200), rand(0, 50), $noise_color);
    }

    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $rand_str = '';
    for ($i = 0; $i < 6; $i++) {
        $rand_str .= $chars[rand(0, strlen($chars) - 1)];
    }

    $session->set('captcha', $rand_str);
    $font_size = 18;
    $font_path = FCPATH . 'fonts/ONE-Mobile-Regular.ttf';
    $char_width = 8;
    $char_height = 16;

    $string_length = strlen($rand_str);
    $string_width = $string_length * $char_width;

    $x = (170 - $string_width) / 2;
    $y = (80 - $char_height) / 2;

    imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_path, $rand_str);

    ob_start();
    imagejpeg($image);
    $image_data = ob_get_clean();
    imagedestroy($image);

    $captcha_image = 'data:image/jpeg;base64,' . base64_encode($image_data);

    return array('captcha_image' => $captcha_image, 'captcha_value' => $rand_str);
}

function noFileExt($fileName)
{
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    return in_array(strtolower($extension), $allowedExtensions);
}

function yoil_convert($day)
{
    $yoil = array("일", "월", "화", "수", "목", "금", "토");
    $yoil = $yoil[date('w', strtotime($day))];
    return $yoil;
}

function GD2_make_thumb($source, $destination, $width, $height)
{
    if (file_exists($source)) {
        $image = imagecreatefromjpeg($source);

        list($original_width, $original_height) = getimagesize($source);

        if ($original_width > 0 && $original_height > 0) {
            $ratio = $original_width / $original_height;
            if ($width / $height > $ratio) {
                $width = $height * $ratio;
            } else {
                $height = $width / $ratio;
            }

            $thumb = imagecreatetruecolor($width, $height);

            imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $original_width, $original_height);

            imagejpeg($thumb, $destination);

            imagedestroy($image);
            imagedestroy($thumb);
        }
    }
}

function get_img($img, $path, $width, $height, $water = "")
{
    $file_dir = "";
    $thumb_img_path = $_SERVER["DOCUMENT_ROOT"] . $path . "/thum_" . $width . "_$height/";
    if (!is_dir($thumb_img_path)) {
        @mkdir($thumb_img_path, 0777);
    }
    $thumb_img = $thumb_img_path . $img;
    if (!file_exists($thumb_img)) {
        @GD2_make_thumb($width, $height, $thumb_img, $_SERVER["DOCUMENT_ROOT"] . "/" . $path . "/" . $img);
    }
    return $path . "/thum_" . $width . "_" . $height . "/" . $img;
}

function getConImg($con)
{
    $cnt = preg_match_all('@<img\s[^>]*src\s*=\s*(["\'])?([^\s>]+?)\1@i', stripslashes($con), $output);
    $j = 0;
    $img = '';
    for ($i = 0; $i < $cnt; $i++) {
        $cols[$j][] = str_replace('""', '"', ($output[2][$i] != '') ? $output[2][$i] : $output[4][$i]);

        if ($output[6][$i] != '')
            $j++;

        $img = $cols[0][$i];
    }
    return $img;
}

function file_check($ok_filename, $ok_file, $path, $ftype)
{
    if ($ok_filename == "" || $ok_file == "") {
        return false;
    } else {
        //한글파일 파일명 대체

        $download = $path;
        $aa = date('YmdHms');
        //	$check=explode(".",$ok_filename);

        $ext = substr(strrchr($ok_filename, "."), 1);     //확장자앞 .을 제거하기 위하여 substr()함수를 이용
        $ext = strtolower($ext);             //확장자를 소문자로 변환

        $check1 = $aa;
        $check2 = strtolower($ext);

        $ok_filename = $check1 . "." . $check2;
        $attached = $ok_filename;
        if ($ftype == "I") {
            if ($check2 != "gif" && $check2 != "jpg" && $check2 != "jpeg" && $check2 != "bmp") {
                echo "<script>alert('이미지 파일만 업로드할수있습니다.');
				  history.back(1);</script>";
                exit;
            }
        } else
            $attached = $ok_filename;
        $ok_filename = $download . $ok_filename;
        if (file_exists($ok_filename)) {    // 같은 파일 존재
            //$file_splited = explode("\.", $attached, 2);
            $file_splited = explode(".", $attached);
            $i = 0;
            do {
                $tmp_filename = $file_splited[0] . $i . "." . $file_splited[1];
                $tmp_filelocation = $download . $tmp_filename;
                $i++;
            } while (file_exists($tmp_filelocation));
            $ok_filename = $tmp_filelocation;
            $attached = $tmp_filename;
        }

        if ($check2 == "png") {
            /*
                           $wfp = fopen($ok_filename, "wb");

                           if ($fp = fopen($ok_file, 'r')) {
                              $contents = '';
                              // 전부 읽을때까지 계속 읽음
                              while ($line = fgets($fp, 1024)) {
                                 $contents .= $line;
                              }
                           }

                           //echo $contents;

                           fwrite($wfp,$contents);
                           fclose($rfp);
                           fclose($wfp);
                           */

            copy($ok_file, $ok_filename);
        } else {
            copy($ok_file, $ok_filename);
        }


        //copy($ok_file, $ok_filename[background="255 128 128"]);
        unlink($ok_file);
        //GD2_make_thumb(20000,20000,str_replace("img_","thumb_",$path.$attached),$path.$attached);

        return $attached;
    }
}