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

function private_key() {
    return "gkdlghwn!@12";
}

function no_file_ext($filename)
{

    $ext  = explode(".", strtolower($filename));
    $cnt  = count($ext)-1;
    $extend = $ext[$cnt];
    $_ext = explode("|", "php|php3|php4|htm|inc|html|xls|exe");
    $chk  = "Y";

    for($i=0;$i<count($_ext);$i++)
    {
        if($extend == $_ext[$i]) $chk = "N";
    }

    return $chk;
}

function ipagelisting($cur_page, $total_page, $n, $url) {

	$retValue = "<div class='paging mt30'><ul>";
	if ($cur_page > 1) {
		$retValue .= "<li class='first'><a href='" . $url . "1' title='Go to next page'>&lt;&lt;  처음</a></li>";
		$retValue .= "<li class='prev'><a href='" . $url . ($cur_page-1) . "' title='Go to first page'>&lt; 이전</a></li>";
	} else {	
		$retValue .= "<li class='first'><a href='javascript:;' title='Go to next page'>&lt;&lt; 처음</a></li>";
		$retValue .= "<li class='prev'><a href='javascript:;' title='Go to first page'>&lt; 이전</a></li>";
	}
	$retValue .= "";
	$start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
	$end_page = $start_page + 9;
	if ($end_page >= $total_page) $end_page = $total_page;
	if ($total_page == 0)
	{
		$retValue .= "<li class='active'><a href='javascript:;' title='Go to 0 page'><strong>1</strong></a></li>";
	} elseif ($total_page >= 1)
	{
		for ($k=$start_page;$k<=$end_page;$k++)
		{
			if ($cur_page != $k) 
			{
				$retValue .= "<li><a href='$url$k' title='Go to page $k'>$k</a></li>";
			} else { 
				$retValue .= "<li class='active'><a href='javascript:;' title='Go to $k page'><strong>$k</strong></a></li>";
			}
		}
	}
	$retValue .= "";
	if ($cur_page < $total_page) {
		$retValue .= "<li class='next'><a href='$url" . ($cur_page+1) . "' title='Go to next page'>다음 &gt;</a></li>";
		$retValue .= "<li class='last'><a href='$url$total_page' title='Go to last page'>맨끝 &gt;&gt;</a></li>";
	} else {
		$retValue .= "<li class='next'><a href='javascript:;' title='Go to next page'>다음 &gt;</a></li>";
		$retValue .= "<li class='last'><a href='javascript:;' title='Go to last page'>맨끝 &gt;&gt;</a></li>";
	}
	$retValue .= "</ul></div>";
	return $retValue;
}

function fileCheckImgUpload($m_idx, $ufile, $rfile, $path, $fileType){
	if($ufile=="" || $rfile=="") {
		return false;
	} else {
	//한글파일 파일명 대체
    $download	= $path;
	$aa			= date('YmdHms');

	$ext 		= substr(strrchr($ufile,"."),1);	 //확장자앞 .을 제거하기 위하여 substr()함수를 이용
	$ext 		= strtolower($ext);			 //확장자를 소문자로 변환

	$check1		= $aa;
	$check2		= strtolower($ext);

	$ufile		= $check1."_".$m_idx."_".rand(0, 1000).".".$ext;
	$attached	=$ufile;

	if ($fileType == "I") {
		if($check2 !="gif" &&  $check2!="jpg" && $check2!="jpeg" && $check2 !="bmp" && $check2 !="ico") {
			echo"<script>
					alert('이미지 파일만 업로드할수있습니다.');
					history.back(1);
				</script>";
			exit;
		}
	} else {
		$attached 	= $ufile;
		$ufile 		= $download.$ufile;
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

	if($check2 == "png"){
		copy($rfile, $ufile);
	}else{
		copy($rfile, $ufile);
	}

	unlink($rfile);

	return $attached;
	}
}

function write_log($message){
	$dir = WRITEPATH . "logs/";

	if(!file_exists($dir)){
		mkdir($dir);
	}

   $myfile = fopen($dir.date("Ymd").".txt", "a") or die("Unable to open file!");
   $txt = chr(13).chr(10).date("Y.m.d G:i:s")."(".$_SERVER['REMOTE_ADDR'].") : ".chr(13).chr(10).$message.chr(13).chr(10);
   fwrite($myfile, chr(13).chr(10). $txt .chr(13).chr(10));
   fclose($myfile);

}  