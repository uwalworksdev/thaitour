<?php
$app_path = dirname($_SERVER['DOCUMENT_ROOT']) . '/app';

if (is_dir($app_path)) {
    echo "✅ app 폴더가 존재합니다: " . realpath($app_path);
} else {
    echo "❌ app 폴더가 존재하지 않습니다. 확인된 경로: " . $app_path;
}
?>
		 
		
