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
     * 이전 이미지 삭제
     * * 삭제할 이미지배열은 초기화
     * @return void
     */
    public function oldEditorImageDelete(){
        // 삭제할 배열이 존재하는지 확인
        if(count($this->oldEdtiorImageArray)){
            foreach($this->oldEdtiorImageArray AS $delImage){
                // 파일이 존재하는지 확인 후 삭제처리 합니다.
                if(file_exists(ROOTPATH."public/".$this->newPath.$this->editorPath."/".$delImage)){
                    unlink(ROOTPATH."public/".$this->newPath.$this->editorPath."/".$delImage);

                }
            }
        }
        // 삭제 여부 상관없이 초기화 합니다.
        $this->oldEdtiorImageArray = array();
        // 삭제 여부 상관없이 신규 경로도 초기화 합니다.
        $this->newPath;
    }
}