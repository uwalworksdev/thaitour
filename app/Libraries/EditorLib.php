<?php

namespace App\Libraries;

class EditorLib {
    /**
     * 에디터 경로
     * * 신규 주소에 추가 string
     * @var string
    */
    private $editorPath = "/editor";
    
    public $reg;
    /**
     * 업데이트 전 에디터 내용
     */
    private $oldEdtiorImageArray = array();
    private $newPath = "";

    public function __construct()
    {
        $this->reg = new Regex;
    }

    /**
     * 이전 에디터 이미지 배열화
     * @param string 업데이트 전 에디터 내용
     * @return void
     */
    public function oldEditor($prevEditor){
        $imageSrcArray = $this->reg->imgSrcReg($prevEditor);
        foreach($imageSrcArray AS $img){
            $file = new \CodeIgniter\Files\File($img);
            array_push($this->oldEdtiorImageArray, $file->getBasename());
        }
    }

    /**
    * 에디터 내용 신규이동경로에 맞춰 경로치환 + 해당 경로로 파일 이동
    * * $newPath로 받은 폴더경로가 없다면 폴더를 생성합니다.
    * * 클래스로
    * @param string $editorContent 업데이트할 에디터 내용
    * @param string $newPath 신규 이동 경로, 마지막은 /editor를 붙이지 마세요.
    * @example string $newPath = "uploads/board/{$idx}"
    * @return string 에디터 변경 내용
    */
    public function editorMove($editorContent, $newPath){
        $srcImageArray = $this->reg->imgSrcReg($editorContent);
        // 하위 폴더까지 생성
        if(!is_dir(WRITEPATH.$newPath.$this->editorPath)){
            mkdir(WRITEPATH.$newPath.$this->editorPath, 0775, TRUE);
        }
        $returnReplaceContent = $editorContent;
        foreach($srcImageArray AS $img){
            // 임시 파일이 존재할 경우에만 경로 치환
            $image_replace = str_replace('/uploads/tmp', "/".$newPath.$this->editorPath, $img);
            $file = new \CodeIgniter\Files\File($img);
            // 신규 이미지가 존재하는지 확인
            if(file_exists(WRITEPATH."uploads/tmp/".$file->getBasename())){
                rename(WRITEPATH."uploads/tmp/".$file->getBasename(), WRITEPATH.$newPath.$this->editorPath."/{$file->getBasename()}");
            }
            $returnReplaceContent = str_replace($img, $image_replace, $returnReplaceContent);

            // oldEditorImageArray 배열에 기존 등록된 이미지가 있는지 확인 합니다.
            if( ($key = array_search($file->getBasename(), $this->oldEdtiorImageArray)) !== false){
                // 존재하면 oldEditorImageArray 배열에서 해당 이미지명을 제거합니다.
                unset($this->oldEdtiorImageArray[$key]);
            }
        }
        /**
         * 신규 경로를 받아옵니다.
         */
        $this->newPath = $newPath;
       
        return $returnReplaceContent;
    }

    /**
     * 이전 이미지 삭제
     * * 삭제할 이미지배열은 초기화
     * @return void
     */
    public function oldEditorImageDelete(){
        // 삭제할 배열이 존재하는지 확인
        if(count($this->oldEdtiorImageArray)){
            foreach($this->oldEdtiorImageArray AS $delImage){
                // 파일이 존재하는지 확인 후 삭제처리 합니다.
                if(file_exists(WRITEPATH.$this->newPath.$this->editorPath."/".$delImage)){
                    unlink(WRITEPATH.$this->newPath.$this->editorPath."/".$delImage);

                }
            }
        }
        // 삭제 여부 상관없이 초기화 합니다.
        $this->oldEdtiorImageArray = array();
        // 삭제 여부 상관없이 신규 경로도 초기화 합니다.
        $this->newPath;
    }
}