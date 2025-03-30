<?php

namespace App\Controllers;

use Config\Validation;
use Exception;

class Setting extends BaseController {

    private $db;
    private $Setting;
    private $Member;
    private $uploadPath = ROOTPATH . "public/uploads/setting/";
    /**
     * 고정된 식별번호 IDX
     */
    private $fixIdx = 1;

    public function __construct()
    {
        helper(["html", "alert", "my"]);
        $this->db = db_connect();
        $this->Setting = model("Setting");
        $this->Member = model("Member");
    }
    /**
     * 사이트 기본설정 작성 컨트롤러
     */
    public function writeView(){
        try {
            $data = $this->Setting->info($this->fixIdx);
            if(!$data){
                throw new Exception("잘못된 정보입니다.");
            }

            return view("admin/setting/siteWrite",[
                "row"      => $data,
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
        {
            $uploadPath = $this->uploadPath;
            $dels = $this->request->getPost('dels');
            $dels_f = $this->request->getPost('dels_f');

            $data = $this->request->getPost();

            $row = $this->Setting->find(1);

            if ($dels === 'y') {
                if ($row) {
                    if (is_file($uploadPath . $row['logos'])) {
                        unlink($uploadPath . $row['logos']);
                    }

                    $this->Setting->update(1, ['logos' => '']);
                }
            }

            if ($dels_f === 'y') {
                if ($row) {
                    if (is_file($uploadPath . $row['logos_footer'])) {
                        unlink($uploadPath . $row['logos_footer']);
                    }

                    $this->Setting->update(1, ['logos_footer' => '']);
                }
            }

            if ($file = $this->request->getFile('favico_img1')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $fileName = $file->getClientName();
                    if (no_file_ext($fileName) == "Y") {
                        $microtime = microtime(true);
                        $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                        $date = date('YmdHis');
                        $ext = explode(".", strtolower($fileName));
                        $newName = $date . $timestamp . '.' . $ext[1];
                        $file->move($uploadPath, $newName);
                        $this->Setting->update(1, ['favico_img' => $newName]);
                    }
                }
            }

            for ($i=1;$i<=1;$i++)
            {
                if ($file = $this->request->getFile("ufile".$i)) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = $file->getClientName();
                        if (no_file_ext($fileName) != "Y") {
                            continue;
                        }
                        $microtime = microtime(true);
                        $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                        $date = date('YmdHis');
                        $ext = explode(".", strtolower($fileName));
                        $newName = $date . $timestamp . '.' . $ext[1];
                        $file->move($uploadPath, $newName);
                        $this->Setting->infoUpdate(1, ['logos' => $newName]);
                    }
                }
            }

            for ($i=2;$i<=2;$i++)
            {
                if ($file = $this->request->getFile("ufile".$i)) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = $file->getClientName();
                        if (no_file_ext($fileName) != "Y") {
                            continue;
                        }
                        $microtime = microtime(true);
                        $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                        $date = date('YmdHis');
                        $ext = explode(".", strtolower($fileName));
                        $newName = $date . $timestamp . '.' . $ext[1];
                        $file->move($uploadPath, $newName);
                        $this->Setting->update(1, ['og_img' => $newName]);
                    }
                }
            }

            for ($i=3;$i<=3;$i++)
            {
                if ($file = $this->request->getFile("ufile".$i)) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = $file->getClientName();
                        if (no_file_ext($fileName) != "Y") {
                            continue;
                        }
                        $microtime = microtime(true);
                        $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                        $date = date('YmdHis');
                        $ext = explode(".", strtolower($fileName));
                        $newName = $date . $timestamp . '.' . $ext[1];
                        $file->move($uploadPath, $newName);
                        $this->Setting->update(1, ['favico' => $newName]);
                    }
                }
            }

            for ($i=4;$i<=4;$i++)
            {
                if ($file = $this->request->getFile("ufile".$i)) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = $file->getClientName();
                        if (no_file_ext($fileName) != "Y") {
                            continue;
                        }
                        $microtime = microtime(true);
                        $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                        $date = date('YmdHis');
                        $ext = explode(".", strtolower($fileName));
                        $newName = $date . $timestamp . '.' . $ext[1];
                        $file->move($uploadPath, $newName);
                        $this->Setting->update(1, ['logos_footer' => $newName]);
                    }
                }
            }

            for ($i=5;$i<=5;$i++)
            {
                if ($file = $this->request->getFile("ufile".$i)) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = $file->getClientName();
                        if (no_file_ext($fileName) != "Y") {
                            continue;
                        }
                        $microtime = microtime(true);
                        $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                        $date = date('YmdHis');
                        $ext = explode(".", strtolower($fileName));
                        $newName = $date . $timestamp . '.' . $ext[1];
                        $file->move($uploadPath, $newName);
                        $this->Setting->update(1, ['logos_consult' => $newName]);
                    }
                }
            }
            
            $this->Setting->infoUpdate(1, $data);
            return redirect()->to('AdmMaster/_adminrator/setting')->with('success', '수정되었습니다.');
        }
    }

    public function passwordUpdate() {
        $user_pw = $this->request->getPost('admin_pass');

        if(!empty($user_pw)) {
            $id = session()->get('member')["id"];

            if(empty($id)) {
                return json_encode([
                    "result" => false,
                    "msg" => "로그인이 필요합니다."
                ]);
            }else{
                $result = $this->Member->where('user_id', $id)->set([
                    'user_pw' => password_hash($user_pw, PASSWORD_DEFAULT)
                ])->update();

                if($result) {
                    return json_encode([
                        "result" => true,
                        "msg" => "관리자 비번이 수정 되었습니다."
                    ]);
                }else{
                    return json_encode([
                        "result" => false,
                        "msg" => "시스템 오류."
                    ]);
                }
            }

            
        }else{
            return json_encode([
                "result" => false,
                "msg" => "비번을 입력하세요"
            ]);
        }
    }
}