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