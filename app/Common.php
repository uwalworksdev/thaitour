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