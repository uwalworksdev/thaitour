<?php

namespace App\Controllers;

use Config\Validation;
use Exception;

class Setting extends BaseController {

    private $db;
    private $Setting;
    private $uploadPath = WRITEPATH."uploads/setting/";
    /**
     * 고정된 식별번호 IDX
     */
    private $fixIdx = 1;

    public function __construct()
    {
        helper(["html", "alert"]);
        $this->db = db_connect();
        $this->Setting = model("Setting");
    }
    /**
     * 사이트 기본설정 작성 컨트롤러
     */
    public function writeView(){
        $scripts = [];

        try {
            $data = $this->Setting->info($this->fixIdx);
            if(!$data){
                throw new Exception("잘못된 정보입니다.");
            }

            array_push($scripts, script_tag(["src"=>"js/admin/settingWrite.js", "defer"=>false]));
    
            return view("admin/setting/siteWrite",[
                "headers"   => [...$scripts],
                "data"      => $data,
            ]);
        } catch (Exception $error) {
            $resultArr['result'] = false;
            $resultArr['message'] = $error->getMessage();
            return alert_msg($error->getMessage());
        }

    }
    /**
     * 기본설정 업데이트
     */
    public function writeUpdate(){
        $post = $this->request->getPost();
        $file = $this->request->getFiles();
        // $ogImg = $this->request->getFile('og_img');
        $files = $this->request->getFiles();

        $filesName = ['og_img', 'favico_img', 'logos', 'logo_footer'];
        
        try {
            $changeValidate = Validation::$settingRule;
            if(!$this->validate($changeValidate)){
                foreach($this->validator->getErrors() AS $errorMsg){
                    throw new Exception($errorMsg);
                }
            }
            $this->db->transBegin();
            // 업데이트 전 이전 데이터 조회
            $prevInfoData = $this->Setting->info($this->fixIdx);
            $updateResult = $this->Setting->infoUpdate($this->fixIdx, $post);
            if(!$updateResult){
                throw new Exception("수정 과정 중 오류가 발생했습니다.");
            }
            // 파일 업로드
            $uploadPath = $this->uploadPath;
            if(!is_dir($uploadPath)){
                // 업로드 경로 없으면 폴더 생성
                mkdir($uploadPath, 0755, true);
            }
            // 파일 컬럼명으로 파일이 존재하면 이전데이터 삭제 및 수정 작업
            foreach($filesName AS $fileKey){
                $file = $files[$fileKey];

                if($file->isValid()){
                    if(!$file->hasMoved()){
                        $newName = $file->getRandomName();
                        $fileUpdateData[$fileKey] = $newName;
                        // $fileUpdateData['rfile'] = $file->getClientName();
                        
                        $fileResult = $this->Setting->infoUpdateFile($this->fixIdx, $fileKey, $fileUpdateData);
                        if($fileResult){
                            $file->move($uploadPath, $newName);
                            if($prevInfoData[$fileKey]){
                                unlink($uploadPath.$prevInfoData[$fileKey]);
                            }
                        }
                    }
                }
            }

            $this->db->transCommit();
            $resultArr['result'] = true;
            $resultArr['message'] = "수정했습니다.";
        } catch (Exception $err) {
            $this->db->transRollback();
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
        } finally {
            return $this->response->setJSON($resultArr);
        }
    }
}