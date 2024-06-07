<?php

/**
 * 해당 경로에 하위 파일들을 전부 삭제 후 마지막 폴더삭제
 * @param string $delete_path 삭제할 경로
 */
function rmdir_all($delete_path) {
    if(is_dir($delete_path)){
        $dirs = dir($delete_path);

        while(false !== ($entry = $dirs->read())) {
            // 디렉토리의 내용을 하나씩 읽는다.
            if(($entry != '.') && ($entry != '..')) {
                // 디렉토리의 내용중 현재폴더, 상위폴더가 아니면 (즉 파일 및 디렉토리)            
                if(is_dir($delete_path.'/'.$entry)) {
                    //디렉토리이면 재귀호출로 다시 삭제 시작.
                    rmdir_all($delete_path.'/'.$entry);
                } else {
                    //해당 파일 삭제
                    @unlink($delete_path.'/'.$entry);
                }
            }
        }

        $dirs->close();

        // 최종 디렉토리 삭제
        @rmdir($delete_path);
    }
}