<?php

function alert_msg($msg, $location=null){
    $script = "";
    $script .= "<script>";
    $script .= "alert(`{$msg}`);";
    if($location){
        $script .= "location.href=`{$location}`;";
    }else{
        $script .= "history.back();";
    }
    $script .= "</script>";

    return $script;
}