<?php
$common_path = $_SERVER['DOCUMENT_ROOT'] . '/app/Common.php';
if (!file_exists($common_path)) {
    die("Common.php 파일이 존재하지 않습니다: " . realpath($common_path));
}
include_once $common_path;
		
?>		