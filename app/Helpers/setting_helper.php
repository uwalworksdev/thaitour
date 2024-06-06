<?php

function homeSetInfo(){
    $Setting = model("Setting");
    try {
        $infoData = $Setting->info(1);
        if(!$infoData){
            throw new Exception("");
        }
        $resultArr = $infoData;
    } catch (Exception $err) {
        
        $resultArr = [];
    } finally {
        return $resultArr;
    }
}