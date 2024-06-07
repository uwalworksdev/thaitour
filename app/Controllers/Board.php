<?php

namespace App\Controllers;

use App\Libraries\EditorLib;
use CodeIgniter\Files\File;
use Config\Validation;
use Exception;
use App\Libraries\SessionChk;

class Board extends BaseController {

    public $codeTemplateArray;
    public $adminBoardArray;
    /**
     * * WRITEPATH."uploads/board/"
     * @var string
     */
    public $uploadPath;

    protected $db;
    protected $board;
    protected $sessionLib;
    protected $sessionChk;

    protected $boardCategory;
    protected $editor;
    
    public function __construct()
    {
        helper(['gnb', 'html', 'url', 'download', 'remove', 'alert']);

        // 리스트 템플릿
        // $this->codeTemplateArray['list'] = ['default'];
        // 갤러리 템플릿
        // $this->codeTemplateArray['gallery'] = ['gallery'];

        $this->adminBoardArray = adminGnbBoard();
        foreach($this->adminBoardArray AS $board){
            $this->codeTemplateArray[$board['template']][] = $board['code'];
        }

        $this->db = db_connect();
        $this->board = model("Board");
        $this->boardCategory = model("BoardCategory");
        $this->editor = new EditorLib();
        $this->uploadPath = WRITEPATH."uploads/board/";

        $this->sessionLib = new SessionChk();
        $this->sessionChk = $this->sessionLib->infoChk();
    }

    public function ListView($code = null){

        try {

            if ($this->sessionChk != "Y") {
                throw new Exception();
            }

            $page = $this->request->getGet('page');
            $scripts = [];
            array_push($scripts, script_tag(["src" => "js/admin/board.js", "defer" => false]));

            if ($page < 0 || !is_numeric($page)) {
                $page = 1;
            }

            $whereArr = $this->request->getGet();
            $whereArr['lang'] = session("lang") ?? "kr";
            $totalCount = count($this->board->List($code, $whereArr)->findAll()) ?? 0;


            switch ($code){
                // 리스트
                case in_array($code, $this->codeTemplateArray['list']):
                    // array_push($scripts, '');
                    $listRows = 10;
                    $offset = ($page - 1) * $listRows;
                    $nums = $totalCount - $offset;
                    $data = $this->board->List($code, $whereArr)->paginate($listRows);
                    $template = view("/admin/board/template/list",[
                        'data' => $data, 
                        'code' => $code,
                        "nums" => $nums,
                    ]);
                    $pager = $this->board->pager->links('default','admin_list');
                    break;
                // 갤러리
                case in_array($code, $this->codeTemplateArray['gallery']):
                    $listRows = 9;
                    $offset = ($page - 1) * $listRows;
                    $nums = $totalCount - $offset;
                    $data = $this->board->List($code, $whereArr)->paginate($listRows);
                    $categoryData = $this->boardCategory->List($code)->findAll();
                    // array_push($scripts, '');
                    $template = view("/admin/board/template/gallery",[
                        'data'          => $data, 
                        'categoryData'  => $categoryData, 
                        'code'          => $code,
                        "nums"          => $nums,
                    ]);
                    $pager = $this->board->pager->links('default','admin_list');
                    break;
                default:
                    $template = "";
                    break;
            }



            return view("admin/board/list",[
                "headers"   => [...$scripts],
                "code"      => $code,
                "adminBoard"=> $this->adminBoardArray,
                "template"  => $template,
                "totalCount"=> $totalCount,
                "pager"     => $pager,
            ]);
        }catch (Exception $err) {
            return alert_msg("비정상적인 접근 입니다.", '/adm');
        }
    }
    public function WriteView($code, $idx = null){

        try {

            if ($this->sessionChk != "Y") {
                throw new Exception();
            }

            $scripts = [];
            $data = "";

            array_push($scripts, script_tag(["src" => "js/admin/board.js", "defer" => false]));

            $templateData = [];

            if (!$idx) {
                // 신규 등록
                // return view("",[
                // "headers"=>[...$scripts],
                
                // ]);
                $templateData['idx'] = $idx;
            }

            $categoryData = $this->boardCategory->List($code)->findAll();
            if($idx) {
                $data     = $this->board->View($idx);
                $filedata = $this->board->fileInfo($idx);
            }
            
            switch ($code) {
                case in_array($code, $this->codeTemplateArray['list']):
                    if($code == 'notice'){
                        // 에디터가 submit 보다 먼저 실행되어야 됩니다.
                        array_unshift($scripts, script_tag(["src"=>"js/admin/boardEditor.js", "type"=>"module"]));
                    }
                    $template = view("admin/board/template/listWrite",[
                        "templateData" => $templateData,
                        "code" => $code,
                        "data" => $data,
                        "filedata" => isset($filedata) ? $filedata : []
                    ]);
                    break;
                case in_array($code, $this->codeTemplateArray['gallery']):


                    $template = view("admin/board/template/galleryWrite",[
                        "templateData" => $templateData,
                        "categoryData" => $categoryData ?? [],
                        "code" => $code,
                        "data" => $data
                    ]);
                    break;
                default:
                    $template = "";
                    break;
        }


            // 수정
            return view("admin/board/write", [
                "headers" => [...$scripts],
                "code" => $code,
                "adminBoard" => $this->adminBoardArray,
                "template" => $template,
                "idx" => $idx,
            ]);

        } catch (Exception $err) {
            return alert_msg("비정상적인 접근 입니다.", '/adm');
        }
    }
    /**
     * 관리자 게시글 등록
     * @param string $code 게시글 코드
     * @return json
     */
    // public function WriteInsert($code){

    //     $title    = $this->request->getPost('title');
    //     $topic1   = $this->request->getPost('topic1');
    //     $topic2   = $this->request->getPost('topic2');
    //     $topic3   = $this->request->getPost('topic3');
    //     $content  = $this->request->getPost('content');
    //     $category = $this->request->getPost('category');
    //     $url      = $this->request->getPost('url');
    //     $reg_date = $this->request->getPost('reg_date');
    //     $ufile    = $this->request->getFile('ufile');
    //     $efile    = $this->request->getFile('efile');
    //     $writer   = session('member_id');
    //     $lan      = $this->request->getPost('lan');


    //     try {

    //         if ($this->sessionChk != "Y") {
    //             throw new Exception('비정상적인 접근 입니다.', 302);
    //         }


    //         switch($code) {
    //             case in_array($code, ['license', 'certified']):
    //                 $popupGalleryValidate = Validation::$license;
    //                 $popupGalleryValidate['ufile']['rules'] = "uploaded[ufile]|mime_in[ufile,image/jpeg,image/png,image/gif]";
    //                 $popupGalleryValidate['ufile']['errors']['uploaded'] = "파일은 필수입니다.";
    //                 $popupGalleryValidate['ufile']['errors']['mime_in'] = "이미지 파일만 업로드 가능합니다.";

    //                 if(!$this->validate($popupGalleryValidate)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }
                    
    //                 $data['board_code'] = $code;
    //                 $data['title'] = $title;
    //                 $data['category'] = $category;
    //                 $data['lan'] = $lan;
                    
    //                 $insertResult = $this->board->InfoInsert($code, $data);
    //                 if(!$insertResult['result']){
    //                     throw new Exception($insertResult['message']);
    //                 }
    //                 $insertId = $insertResult['insertId'];

    //                 // 파일 업로드
    //                 $uploadPath = $this->uploadPath.$insertId;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }
    //                 if ($ufile) {
    //                     if ($ufile->isValid() && ! $ufile->hasMoved()) {
    //                         $newName = $ufile->getRandomName();
                
    //                         $fileUpdateData['b_idx'] = $insertId;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] =$ufile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')->insert($fileUpdateData);
    //                         if($fileResult){
    //                             $ufile->move($uploadPath, $newName);
    //                         }
    //                     }else{
    //                         $errorMessage = "파일은 필수 항목 입니다.";
    //                         throw new Exception($errorMessage);
    //                     }
    //                 }
    //                 break;
    //             case in_array($code, ['ultrapure', 'waterTreatment', 'wasteWater', 'seaWater']):
    //                 $boardValidate = Validation::$ultrapure;
                   

    //                 if(!$this->validate($boardValidate)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }

    //                 $data = [
    //                     'board_code' => $code,
    //                     'topic1'     => $topic1,
    //                     'topic2'     => $topic2,
    //                     'topic3'     => $topic3,
    //                     'content'    => $content,
    //                     'title'      => $title,
    //                     'writer'     => $writer,
    //                     'lan'        => $lan

    //                 ];
    
    //                 $insertResult = $this->board->InfoInsert($code, $data);
    //                 if(!$insertResult['result']){
    //                     throw new Exception($insertResult['message']);
    //                 }
    //                 break;

    //             case 'brochure' :

    //                 $popupGalleryValidate = Validation::$license;
    //                 unset($popupGalleryValidate['category']);
    //                 $popupGalleryValidate['ufile']['rules'] = "uploaded[ufile]|mime_in[ufile,image/jpeg,image/png,image/gif]";
    //                 $popupGalleryValidate['ufile']['errors']['uploaded'] = "이미지 파일은 필수입니다.";
    //                 $popupGalleryValidate['ufile']['errors']['mime_in'] = "이미지 파일만 업로드 가능합니다.";
    //                 $popupGalleryValidate['efile']['rules'] = "uploaded[efile]";
    //                 $popupGalleryValidate['efile']['errors']['uploaded'] = "파일은 필수입니다.";

    //                 if(!$this->validate($popupGalleryValidate)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }

    //                 $data['board_code'] = $code;
    //                 $data['title']      = $title;
    //                 $data['lan']        = $lan;

    //                 $insertResult = $this->board->InfoInsert($code, $data);
    //                 if(!$insertResult['result']){
    //                     throw new Exception($insertResult['message']);
    //                 }
    //                 $insertId = $insertResult['insertId'];

    //                 // 파일 업로드
    //                 $uploadPath = $this->uploadPath.$insertId;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }
    //                 if ($ufile) {
    //                     if ($ufile->isValid() && ! $ufile->hasMoved()) {
    //                         $newName = $ufile->getRandomName();

    //                         $fileUpdateData['b_idx'] = $insertId;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] = $ufile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')->insert($fileUpdateData);
    //                         if($fileResult){
    //                             $ufile->move($uploadPath, $newName);
    //                         }
    //                     }else{
    //                         $errorMessage = "파일은 필수 항목 입니다.";
    //                         throw new Exception($errorMessage);
    //                     }
    //                 }

    //                 if ($efile) {
    //                     if ($efile->isValid() && ! $efile->hasMoved()) {
    //                         $newName = $efile->getRandomName();

    //                         $fileUpdateData['b_idx'] = $insertId;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] =$efile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')->insert($fileUpdateData);
    //                         if($fileResult){
    //                             $efile->move($uploadPath, $newName);
    //                         }
    //                     }else{
    //                         $errorMessage = "파일은 필수 항목 입니다.";
    //                         throw new Exception($errorMessage);
    //                     }
    //                 }
    //                 break;


    //             case in_array($code, ['notice', 'publicNotice']) :
    //                 $data = [
    //                     'board_code' => $code,
    //                     'content'    => $content,
    //                     'title'      => $title,
    //                     'writer'     => $writer,
    //                     'lan'        => $lan
    //                 ];
    //                 // 투자정보-전자정보에서 내용 제거 및 첨부파일 필수값 추가
    //                 if($code == 'publicNotice'){
    //                     unset($data['content']);
    //                     $validateRule = Validation::$publicNotice;
    //                     $validateRule['efile']['rules'] = "uploaded[efile]";
    //                     $validateRule['efile']['errors']['uploaded'] = "파일은 필수입니다.";
    //                 }else{
    //                     $validateRule = $code;
    //                 }

    //                 if(!$this->validate($validateRule)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }

    //                 $insertResult = $this->board->InfoInsert($code, $data);
    //                 if(!$insertResult['result']){
    //                     throw new Exception($insertResult['message']);
    //                 }
    //                 $insertId = $insertResult['insertId'];
    //                 // 파일 업로드
    //                 $uploadPath = $this->uploadPath.$insertId;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }
    //                 $replaceUploadPath = "uploads/board/{$insertId}";
    //                 // 임시폴더에 있는 에디터 신규생성된 경로로 설정
    //                 $replacedContent = $this->editor->editorMove($content, $replaceUploadPath);
    //                 $newUpdateData['content'] = $replacedContent;
    //                 // 주소 변경된 에디터 이미지 업데이트
    //                 $this->board->InfoContentUpdate($insertId, $code, $newUpdateData);

    //                 // 첨부파일
    //                 if ($efile) {
    //                     if ($efile->isValid() && ! $efile->hasMoved()) {
    //                         $newName = $efile->getRandomName();

    //                         $fileUpdateData['b_idx'] = $insertId;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] =$efile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')->insert($fileUpdateData);
    //                         if($fileResult){
    //                             $efile->move($uploadPath, $newName);
    //                         }
    //                     }
    //                     // else{
    //                     //     $errorMessage = "파일은 필수 항목 입니다.";
    //                     //     throw new Exception($errorMessage);
    //                     // }
    //                 }
    //                 break;

    //             case 'report' :

    //                 $data = [
    //                     'board_code' => $code,
    //                     'content'    => $content,
    //                     'title'      => $title,
    //                     'topic1'     => $topic1,
    //                     'url'        => $url,
    //                     'reg_date'   => $reg_date,
    //                     'lan'        => $lan
    //                 ];

    //                 if(!$this->validate($code)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }

    //                 $insertResult = $this->board->InfoInsert($code, $data);
    //                 if(!$insertResult['result']){
    //                     throw new Exception($insertResult['message']);
    //                 }
    //                 $insertId = $insertResult['insertId'];

    //                 $uploadPath = $this->uploadPath.$insertId;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }

    //                 if ($ufile) {
    //                     if ($ufile->isValid() && ! $ufile->hasMoved()) {
    //                         $newName = $ufile->getRandomName();

    //                         $fileUpdateData['b_idx'] = $insertId;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] =$ufile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')->insert($fileUpdateData);
    //                         if($fileResult){
    //                             $ufile->move($uploadPath, $newName);
    //                         }
    //                     }else{
    //                         $errorMessage = "파일은 필수 항목 입니다.";
    //                         throw new Exception($errorMessage);
    //                     }
    //                 }
    //                 break;


    //             case 'announcements':
    //                 $data = [
    //                     'board_code' => $code,
    //                     'title'      => $title,
    //                     'topic1'     => $topic1,
    //                     'url'        => $url,
    //                     'writer'     => $writer,
    //                 ];
    //                 break;
    //             default:
    //                 throw new Exception("없는 코드 입니다.");
    //                 break;
    //         }

    //         $resultArr['result'] = true;
    //         $resultArr['message'] = "등록 했습니다.";
    //         $resultArr['location'] = $lan == "en" ? "/adm/en/board/{$code}/list" : "/adm/board/{$code}/list";

    //     } catch (Exception $err) {

    //         $resultArr['result'] = false;
    //         $resultArr['message'] = $err->getMessage();

    //         if ($err->getCode() == 302) {
    //             $resultArr['location'] = "/adm";
    //         }
    //     } finally{
    //         return $this->response->setJSON($resultArr);
    //     }
    // }
    /**
     * 관리자 게시글 수정 
     * @param string $code 게시글 코드
     * @param int $idx 게시글 식별번호
     * @return json
     */
    // public function WriteUpdate($code, $idx){
    //     try {

    //         if ($this->sessionChk != "Y") {
    //             throw new Exception('비정상적인 접근 입니다.', 302);
    //         }

    //         $title      = $this->request->getPost('title');
    //         $topic1     = $this->request->getPost('topic1');
    //         $topic2     = $this->request->getPost('topic2');
    //         $topic3     = $this->request->getPost('topic3');
    //         $content    = $this->request->getPost('content');
    //         $url        = $this->request->getPost('url');
    //         $category   = $this->request->getPost('category');
    //         $reg_date   = $this->request->getPost('reg_date');
    //         $lan        = $this->request->getPost('lan');
    //         $ufile      = $this->request->getFile('ufile');
    //         $efile      = $this->request->getFile('efile');

    //         switch ($code){
    //             case in_array($code, ['license', 'certified']):

    //                 $popupGalleryValidate = Validation::$license;
    //                 $popupGalleryValidate['ufile']['rules'] = "mime_in[ufile,image/jpeg,image/png,image/gif]";
    //                 // $popupGalleryValidate['ufile']['errors']['uploaded'] = "잘못된 파일을 업로드하셨습니다.";
    //                 $popupGalleryValidate['ufile']['errors']['mime_in'] = "이미지 파일만 업로드 가능합니다.";

    //                 if(!$this->validate($popupGalleryValidate)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }

    //                 $data['title']      = $title;
    //                 $data['category']   = $category;
    //                 $data['lan']        = $lan;

    //                 $updateResult = $this->board->InfoUpdate($idx, $code, $data);
    //                 if(!$updateResult['result']){
    //                     throw new Exception($updateResult['message']);
    //                 }

    //                 // 파일 업로드
    //                 $uploadPath = $this->uploadPath.$idx;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }
    //                 if ($ufile) {
    //                     if ($ufile->isValid() && ! $ufile->hasMoved()) {
    //                         // 이전 파일 데이터 조회
    //                         $oldFileData = $this->db->table("tbl_file")
    //                                     ->where("b_idx", $idx)
    //                                     ->get()->getFirstRow();
    //                         $newName = $ufile->getRandomName();
                
    //                         $fileUpdateData['b_idx'] = $idx;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] =$ufile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')
    //                                             ->where("b_idx", $idx)
    //                                             ->update($fileUpdateData);
    //                         if($fileResult){
    //                             $ufile->move($uploadPath, $newName);
    //                             if(isset($oldFileData->ufile)){
    //                                 // 이전 파일 삭제
    //                                 unlink($uploadPath."/{$oldFileData->ufile}");
    //                             }
    //                         }
    //                     }
    //                     // else{
    //                     //     $errorMessage = "파일은 필수 항목 입니다.";
    //                     //     throw new Exception($errorMessage);
    //                     // }
    //                 }

    //                 break;
    //             case in_array($code, ['ultrapure', 'waterTreatment', 'wasteWater', 'seaWater']):
    //                 // 공통 검증키
    //                 $businessValidate = Validation::$ultrapure;
    //                 $data = [
    //                     'board_code' => $code,
    //                     'topic1'     => $topic1,
    //                     'topic2'     => $topic2,
    //                     'topic3'     => $topic3,
    //                     'content'    => $content,
    //                     'title'      => $title,
    //                     'lan'        => $lan,
    //                     // 'writer'     => $writer
    
    //                 ];

    //                 if(!$this->validate($businessValidate)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }

    //                 $updateResult = $this->board->InfoUpdate($idx, $code, $data);
    //                 if(!$updateResult['result']){
    //                     throw new Exception($updateResult['message']);
    //                 }
    
    //                 // 파일 업로드
    //                 $uploadPath = $this->uploadPath.$idx;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }
    //                 if ($ufile) {
    //                     if ($ufile->isValid() && ! $ufile->hasMoved()) {
    //                         // 이전 파일 데이터 조회
    //                         $oldFileData = $this->db->table("tbl_file")
    //                                     ->where("b_idx", $idx)
    //                                     ->get()->getFirstRow();
    //                         $newName = $ufile->getRandomName();
                
    //                         $fileUpdateData['b_idx'] = $idx;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] =$ufile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')
    //                                             ->where("b_idx", $idx)
    //                                             ->update($fileUpdateData);
    //                         if($fileResult){
    //                             $ufile->move($uploadPath, $newName);
    //                             if(isset($oldFileData->ufile)){
    //                                 // 이전 파일 삭제
    //                                 unlink($uploadPath."/{$oldFileData->ufile}");
    //                             }
    //                         }
    //                     }
    //                 }
    //                 break;

    //             case 'report' :

    //                 $data = [
    //                     'board_code' => $code,
    //                     'topic1'     => $topic1,
    //                     'topic2'     => $topic2,
    //                     'topic3'     => $topic3,
    //                     'content'    => $content,
    //                     'title'      => $title,
    //                     'url'        => $url,
    //                     'lan'        => $lan,
    //                     'reg_date'   => $reg_date,

    //                 ];

    //                 if(!$this->validate($code)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }

    //                 $updateResult = $this->board->InfoUpdate($idx, $code, $data);
    //                 if(!$updateResult['result']){
    //                     throw new Exception($updateResult['message']);
    //                 }

    //                 // 파일 업로드
    //                 $uploadPath = $this->uploadPath.$idx;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }
    //                 if ($ufile) {
    //                     if ($ufile->isValid() && ! $ufile->hasMoved()) {
    //                         // 이전 파일 데이터 조회
    //                         $oldFileData = $this->db->table("tbl_file")
    //                             ->where("b_idx", $idx)
    //                             ->get()->getFirstRow();
    //                         $newName = $ufile->getRandomName();

    //                         $fileUpdateData['b_idx'] = $idx;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] =$ufile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')
    //                             ->where("b_idx", $idx)
    //                             ->update($fileUpdateData);
    //                         if($fileResult){
    //                             $ufile->move($uploadPath, $newName);
    //                             if(isset($oldFileData->ufile)){
    //                                 // 이전 파일 삭제
    //                                 unlink($uploadPath."/{$oldFileData->ufile}");
    //                             }
    //                         }
    //                     }
    //                 }
    //                 break;



    //             case in_array($code, ['notice', 'publicNotice']):
    //                 $data = [
    //                     'content'    => $content,
    //                     'title'      => $title,
    //                     'lan'        => $lan,
    //                 ];
    //                 if($code == 'publicNotice'){
    //                     unset($data['content']);
    //                     $validateRule = Validation::$publicNotice;
    //                 }else{
    //                     $validateRule = $code;
    //                 }
    //                 if(!$this->validate($validateRule)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }
    //                 // 업데이트 전 내용에 있는 에디터 이미지
    //                 $prevData = $this->board->View($idx);
    //                 $this->editor->oldEditor($prevData['content']);
    //                 $updateResult = $this->board->InfoUpdate($idx, $code, $data);
    //                 if(!$updateResult['result']){
    //                     throw new Exception($updateResult['message']);
    //                 }

    //                 // 파일 업로드
    //                 $uploadPath = $this->uploadPath.$idx;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }
    //                 $replaceUploadPath = "uploads/board/{$idx}";
    //                 if($code != 'publicNotice'){
    //                     // 임시폴더에 있는 에디터 신규생성된 경로로 설정
    //                     $replaceContent = $this->editor->editorMove($data['content'], $replaceUploadPath);
    //                     $newUpdateData['content'] = $replaceContent;
    //                     // 주소 변경된 에디터 이미지 업데이트
    //                     $this->board->InfoContentUpdate($idx, $code, $newUpdateData);
    //                     // 이전 에디터 이미지 삭제처리
    //                     $this->editor->oldEditorImageDelete();
    //                 }
    //                 // 첨부파일
    //                 if ($efile) {
    //                     if ($efile->isValid() && ! $efile->hasMoved()) {
    //                         // 이전 파일 데이터 조회
    //                         $oldFileData = $this->db->table("tbl_file")
    //                             ->where("b_idx", $idx)
    //                             ->get()->getFirstRow();
    //                         $newName = $efile->getRandomName();

    //                         $fileUpdateData['b_idx'] = $idx;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] = $efile->getClientName();
    //                         $fileResult = $this->db->table('tbl_file')
    //                             ->where("b_idx", $idx)
    //                             ->update($fileUpdateData);
    //                         if($fileResult){
    //                             $efile->move($uploadPath, $newName);
    //                             if(isset($oldFileData->ufile)){
    //                                 // 이전 파일 삭제
    //                                 unlink($uploadPath."/{$oldFileData->ufile}");
    //                             }
    //                         }
    //                     }
    //                 }
    //                 break;

    //             case 'brochure' :

    //                 $popupGalleryValidate = Validation::$license;
    //                 unset($popupGalleryValidate['category']);

    //                 if(!$this->validate($popupGalleryValidate)) {
    //                     $errors = $this->validator->getErrors();
    //                     $errorMessage = array_values($errors)[0];
    //                     throw new Exception($errorMessage);
    //                 }

    //                 $data['board_code'] = $code;
    //                 $data['title']      = $title;
    //                 $data['lan']        = $lan;

    //                 $updateResult = $this->board->InfoUpdate($idx, $code, $data);
    //                 if(!$updateResult['result']){
    //                     throw new Exception($updateResult['message']);
    //                 }

    //                 // 파일 업로드
    //                 $uploadPath = $this->uploadPath.$idx;
    //                 if(!is_dir($uploadPath)){
    //                     mkdir($uploadPath, 0755, true);
    //                 }

    //                 if ($ufile) {
    //                     if ($ufile->isValid() && ! $ufile->hasMoved()) {

    //                         // 이전 파일 데이터 조회
    //                         $oldFileData = $this->db->table("tbl_file")
    //                                                 ->where("b_idx", $idx)
    //                                                 ->get()
    //                                                 ->getFirstRow();

    //                         $old_ufile_idx  = $oldFileData->idx;

    //                         $newName = $ufile->getRandomName();

    //                         $fileUpdateData['b_idx'] = $idx;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] = $ufile->getClientName();

    //                         $fileResult = $this->db->table('tbl_file')
    //                                                 ->where("b_idx", $idx)
    //                                                 ->where("idx", $old_ufile_idx)
    //                                                 ->update($fileUpdateData);
    //                         if($fileResult){
    //                             $ufile->move($uploadPath, $newName);
    //                             if(isset($oldFileData->ufile)){
    //                                 // 이전 파일 삭제
    //                                 unlink($uploadPath."/{$oldFileData->ufile}");
    //                             }
    //                         }
    //                     }
    //                 }


    //                 if ($efile) {
    //                     if ($efile->isValid() && ! $efile->hasMoved()) {

    //                         // 이전 파일 데이터 조회
    //                         $oldFileData = $this->db->table("tbl_file")
    //                                                 ->where("b_idx", $idx)
    //                                                 ->get()
    //                                                 ->getLastRow();

    //                         $old_ufile_idx = $oldFileData->idx;

    //                         $newName = $efile->getRandomName();

    //                         $fileUpdateData['b_idx'] = $idx;
    //                         $fileUpdateData['ufile'] = $newName;
    //                         $fileUpdateData['rfile'] = $efile->getClientName();

    //                         $fileResult = $this->db->table('tbl_file')
    //                             ->where("b_idx", $idx)
    //                             ->where("idx", $old_ufile_idx)
    //                             ->update($fileUpdateData);
    //                         if($fileResult){
    //                             $efile->move($uploadPath, $newName);
    //                             if(isset($oldFileData->efile)){
    //                                 // 이전 파일 삭제
    //                                 unlink($uploadPath."/{$oldFileData->efile}");
    //                             }
    //                         }
    //                     }
    //                 }





    //                 break;



    //             default:
    //                 throw new Exception("없는 코드 입니다.");
    //                 break;
    //         }

    //         $resultArr['result'] = true;
    //         $resultArr['message'] = "수정 했습니다.";
    //         $resultArr['reload'] = true;

    //     } catch (Exception $err) {

    //         $resultArr['result'] = false;
    //         $resultArr['message'] = $err->getMessage();

    //         if ($err->getCode() == 302) {
    //             $resultArr['location'] = "/adm";
    //         }

    //     } finally{
    //         return $this->response->setJSON($resultArr);
    //     }
    // }

    // public function delPost($code)
    // {
    //     $jsonData = $this->request->getJSON();
    //     $sessionLang = session("lang") ?? "kr";

    //     try {

    //         if ($this->sessionChk != "Y") {
    //             throw new Exception('비정상적인 접근 입니다.', 302);
    //         }

    //         $builder = $this->db->table('tbl_board');
    //         $builder->whereIn('idx', $jsonData)->delete();

    //         foreach($jsonData AS $idx){
    //             if(empty($idx)){
    //                 continue;
    //             }
    //             $deletePath = $this->uploadPath.$idx;
    //             // 폴더삭제
    //             rmdir_all($deletePath);
    //         }

    //         $resultArr['result'] = true;
    //         $resultArr['message'] = "삭제 했습니다.";
    //         $resultArr['location'] = $sessionLang == 'kr' ? "/adm/board/{$code}/list" : "/adm/en/board/{$code}/list";

    //     }catch (Exception $err){

    //         $resultArr['result'] = false;
    //         $resultArr['message'] = $err->getMessage();

    //         if ($err->getCode() == 302) {
    //             $resultArr['location'] = "/adm";
    //         }

    //     } finally {
    //         return $this->response->setJSON($resultArr);
    //     }
    // }
    /**
     * 우선순위 변경
     */
    public function OnumChange($code){
        $post = $this->request->getPost();
        
        try {
            if ($this->sessionChk != "Y") {
                throw new Exception('비정상적인 접근 입니다.', 302);
            }
            $bbsIdx = $post['idx'];
            $onum   = $post['onum'];
            for($i=0; $i<count($bbsIdx); $i++){
                $data['onum'] = $onum[$i];
                $this->board->OnumUpdate($bbsIdx[$i], $code, $data);
            }

            $resultArr['result'] = true;
            $resultArr['message'] = "수정했습니다.";
        } catch (Exception $err) {
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
            if ($err->getCode() == 302) {
                $resultArr['location'] = "/adm";
            }
        } finally {
            return $this->response->setJSON($resultArr);
        }
    }
}