<?php

if (!function_exists('private_key')) {
    function private_key() {
        return "gkdlghwn!@12";
    }
}

if (!function_exists('isDateInRange')) {
    function isDateInRange($date, $deadline_date) {
        $deadline_date_array = explode(",", $deadline_date);
        $deadline_date_array = array_filter($deadline_date_array, function($value) { return $value; });
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
	$yoil = array("일","월","화","수","목","금","토");
	$date= $strdate;

    $dow = $yoil[date('w',strtotime($date))];
    return $dow;
}
function viewSQ($textToFilter)
{		
		$textToFilter = str_replace('ins&#101rt','insert',$textToFilter);
		$textToFilter = str_replace('s&#101lect','select',$textToFilter);
		$textToFilter = str_replace('valu&#101s','values',$textToFilter);
		$textToFilter = str_replace('wher&#101','where',$textToFilter);
		$textToFilter = str_replace('ord&#101r','order',$textToFilter);
		$textToFilter = str_replace('int&#111','into',$textToFilter);
		$textToFilter = str_replace('dr&#111p','drop',$textToFilter);
		$textToFilter = str_replace('delet&#101','delete',$textToFilter);
		$textToFilter = str_replace('updat&#101','update',$textToFilter);
		$textToFilter = str_replace('s&#101t','set',$textToFilter);
		$textToFilter = str_replace('fl&#117sh','flush',$textToFilter);
		$textToFilter = str_replace('&amp;',"&",$textToFilter);
		$textToFilter = str_replace('&#59',";",$textToFilter);
		$textToFilter = str_replace('&gt;',">",$textToFilter);
		$textToFilter = str_replace('&lt;',"<",$textToFilter);
		$textToFilter = str_replace('&#34',"\"",$textToFilter);
		$textToFilter = str_replace('&amp;',"&",$textToFilter);
		$textToFilter = str_replace('&amp;',"&",$textToFilter);
		$textToFilter = str_replace('scr&#105pt'," ",$textToFilter);

		return $textToFilter;
}



function get_device() {
    // 모바일 기종(배열 순서 중요, 대소문자 구분 안함)
    $ary_m = array("iPhone","iPod","IPad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini","Windows CE","Nokia","Sony","Samsung","LGTelecom","SKT","Mobile","Phone");
	$str = "P";
    for($i=0; $i<count($ary_m); $i++){
        if(preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            //return $ary_m[$i];
			$str = "M";
            break;
        }
    }
    return $str;
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
    if ($textToFilter != null)
	{
		$textToFilter = str_replace('insert','ins&#101rt',$textToFilter);
		$textToFilter = str_replace('select','s&#101lect',$textToFilter);
		$textToFilter = str_replace('values','valu&#101s',$textToFilter);
		$textToFilter = str_replace('where','wher&#101',$textToFilter);
		$textToFilter = str_replace('order','ord&#101r',$textToFilter);
		$textToFilter = str_replace('into','int&#111',$textToFilter);
		$textToFilter = str_replace('drop','dr&#111p',$textToFilter);
		$textToFilter = str_replace('delete','delet&#101',$textToFilter);
		$textToFilter = str_replace('update','updat&#101',$textToFilter);
		$textToFilter = str_replace('set','s&#101t',$textToFilter);
		$textToFilter = str_replace('flush','fl&#117sh',$textToFilter);
		$textToFilter = str_replace("'","''",$textToFilter);
		$textToFilter = str_replace('"',"&#34",$textToFilter);
		$textToFilter = str_replace('>',"&gt;",$textToFilter);
		$textToFilter = str_replace('<',"&lt;",$textToFilter);
		$textToFilter = str_replace('script','scr&#105pt',$textToFilter);
	//	$textToFilter = nl2br($textToFilter);
		$filterInputOutput = $textToFilter;
		return trim($filterInputOutput);  
	}
	 
}
function sql_password($value)
{
	$row = db_connect()->query(" select SHA1(MD5('".$value."')) as pass ")->getRowArray();
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

function getLoginDeviceUserChk($user_id){
	
	$device_type = get_device();
	$gTime = time() + 86400; //하루 24시간 	
	$cookieValue = "user_id_".$user_id;
		
	if($user_id != ""){
		
		$cookieVal = cookie($cookieValue);

		if($cookieVal == ""){
			$sql = " select * from tbl_login_device where DATE(regdate) = DATE(now())";			
			$row = db_connect()->query($sql)->getRowArray();
			$login_type_P = $row['login_type_P'];
			$login_type_M = $row['login_type_M'];

			if($login_type_P == ""){

				if($device_type == "P"){
					$login_type_P = 1;
					$login_type_M = 0;
				}else if($device_type == "M"){
					$login_type_P = 0;
					$login_type_M = 1;
				}
									
				$sql = " insert into tbl_login_device set regdate = now()
					, login_type_P = ".$login_type_P."
					, login_type_M = ".$login_type_M."
					, itemCnt_P = 0
					, itemCnt_M = 0
					";						 
					
				db_connect()->query($sql);				
			}else{

				if($device_type == "P"){
					$login_type_P = $login_type_P + 1;	
					$sSQl = " login_type_P = ".$login_type_P;
				}else if($device_type == "M"){					
					$login_type_M = $login_type_M + 1;
					$sSQl = " login_type_M = ".$login_type_M;
				}

				$sql = " update tbl_login_device set ".$sSQl." where DATE(regdate) = DATE(now())";
				db_connect()->query($sql);
			}	
		}
		
		setcookie($cookieValue, $cookieValue, $gTime);	
	}

	$out_text = "";
			
	return $out_text;
}

function getLoginIPChk(){
	$REMOTE_ADDR = request()->getIPAddress();
	
	$gTime = time() + 86400; //하루 24시간 	
	$cookieValue = "user_ip_".str_replace(".","", $REMOTE_ADDR);

	$cookieVal = $_COOKIE[$cookieValue];
	
	if($cookieVal == ""){

		$sql = " select * from tbl_login_ip where loginIP = '".$REMOTE_ADDR."' ";

		$row = db_connect()->query($sql)->getRowArray();
		$loginIP = $row['loginIP'];
		$loginCnt = $row['loginCnt'];	
	
		if($loginIP == ""){
			$sql = " insert into tbl_login_ip set loginIP = '".$REMOTE_ADDR."', loginCnt = 1";						 
			db_connect()->query($sql);
		}else{				
				$loginCnt = $loginCnt + 1;
				$sql = "
					update tbl_login_ip set loginCnt = ".$loginCnt." where loginIP = '".$REMOTE_ADDR."'
				";
				db_connect()->query($sql);			
		}
	}

	setcookie($cookieValue, $cookieValue, $gTime);	

	$out_text = "";			
	return $out_text;
}

function ipagelisting2($cur_page, $total_page, $n, $url, $deviceType='P', $focus_element_id="") {
	if($focus_element_id) {
		$focus_element_id = "#" . $focus_element_id;
	}
    $page_range = $deviceType === 'M' ? 5 : 10;

    if ($total_page < 2) {
        $hide = "style='display:none;'";
    } else {
        $hide = "";
    }
    
    $retValue = "<div class='paging' $hide><ul class='page'>";

    // Nút chuyển về trang đầu "<<"
    if ($cur_page > 1) {
        $retValue .= "<li class='skip backward'><a href='" . $url . "1$focus_element_id' title='Go to first page'></a></li>";
    } else {
        $retValue .= "<li class='skip backward'><a href='javascript:;' title='Go to first page'></a></li>";
    }

    // Nút lùi về trang trước "<"
    if ($cur_page > ($deviceType === 'M' ? 5 :10)) {
        $retValue .= "<li class='preview one'><a href='" . $url . ($cur_page - ($deviceType === 'M' ? 5 :10)) . "$focus_element_id' title='Go to previous page'></a></li>";
    } else {
        $retValue .= "<li class='preview one'><a href='javascript:;' title='Go to previous page'></a></li>";
    }

    // Hiển thị các trang
    $start_page = ((int)(($cur_page - 1) / $page_range)) * $page_range + 1;
    $end_page = min($start_page + $page_range - 1, $total_page);

    for ($k = $start_page; $k <= $end_page; $k++) {
        if ($cur_page != $k) {
            $retValue .= "<li><a href='$url$k$focus_element_id' title='Go to page $k'>$k</a></li>";
        } else {
            $retValue .= "<li class='active'><a href='javascript:;' title='Go to page $k'><strong>$k</strong></a></li>";
        }
    }

    // Nút tiến đến trang sau ">"
    if ($cur_page < $total_page-($deviceType === 'M' ? 5 :10)) {
        $retValue .= "<li class='next one'><a href='$url" . ($cur_page + ($deviceType === 'M' ? 5 :10)) . "$focus_element_id' title='Go to next page'></a></li>";
    } else {
        $retValue .= "<li class='next one'><a href='javascript:;' title='Go to next page'></a></li>";
    }

    // Nút chuyển đến trang cuối ">>"
    if ($cur_page < $total_page) {
        $retValue .= "<li class='skip forward'><a href='" . $url . $total_page . "$focus_element_id' title='Go to last page'></a></li>";
    } else {
        $retValue .= "<li class='skip forward'><a href='javascript:;' title='Go to last page'></a></li>";
    }

    $retValue .= "</ul></div>";
    return $retValue;
}

function device_chk() {
    // 모바일 기종(배열 순서 중요, 대소문자 구분 안함)
    $ary_m = array("iPhone","iPod","IPad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini","Windows CE","Nokia","Sony","Samsung","LGTelecom","SKT","Mobile","Phone");
	$str = "PC";
    for($i=0; $i<count($ary_m); $i++){
        if(preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            //return $ary_m[$i];
			$str = "MO";
            break;
        }
    }
    return $str;
}

function sqlSecretConver($value, $way)
{
	$connect = db_connect();
	$private_key = private_key();

	$outText = "";

	if( $way == "encode"){

		$sql	= " SELECT CONVERT( TO_BASE64(hex(AES_ENCRYPT('".$value."', '".$private_key."') ) ) using UTF8) as pass FROM dual ";
		$row	= $connect->query($sql)->getRowArray();

		$outText = $row['pass'];

	} else if( $way == "decode"){

		$sql	= " SELECT CONVERT( AES_DECRYPT( UNHEX( FROM_BASE64('".$value."') ), '".$private_key."') using UTF8) as pass FROM dual ";
		$row	= $connect->query($sql)->getRowArray();

		$outText = $row['pass'];
	}


    return $outText;
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
};
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

	$fsql		= " select count(*) cnts from tbl_member where user_id = '".$userid."'";
	$frow		= $connect->query($fsql)->getRowArray();

	return $frow['cnts'];
}
function chk_member_col($userid, $cols)
{
    $connect = db_connect();
	if( chk_member_id($userid) < 1){

		return "error";

	} else {
		$fsql		= " select ".$cols." as outcol from tbl_member where user_id = '".$userid."'";
		$frow		= $connect->query($fsql)->getRowArray();

		return $frow['outcol'];
	}
}
function DateAdd($interval, $number, $date) {

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
              $year +=$number; 
              break; 

          case "q":
              $year +=($number*3);
              break;

          case "m":
              $month +=$number;
              break;

          case "y":
          case "d":
          case "w":
              $day+=$number;
              break;

          case "ww":
              $day+=($number*7);
              break;

          case "h":
              $hours+=$number;
              break;

          case "n":
              $minutes+=$number;
              break;

          case "s":
              $seconds+=$number;
              break;

     }


    $timestamp = date("Y-m-d",mktime($hours ,$minutes, $seconds, $month, $day, $year));
	return $timestamp;
}
?>