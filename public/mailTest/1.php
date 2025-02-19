<?php
$common_path = $_SERVER['DOCUMENT_ROOT'] . '/app/Common.php';

if (file_exists($common_path)) {
    echo "✅ Common.php 파일이 존재합니다: " . realpath($common_path);
} else {
    echo "❌ Common.php 파일이 존재하지 않습니다. 현재 DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'];
}
?>

