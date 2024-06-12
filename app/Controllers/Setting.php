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
        {
          
    
            // Validation can be added here
    
            $data = [
                'site_name' => $this->request->getPost('site_name'),
                'domain_url' => $this->request->getPost('domain_url'),
                'admin_name' => $this->request->getPost('admin_name'),
                'admin_email' => $this->request->getPost('admin_email'),
                'browser_title' => $this->request->getPost('browser_title'),
                'meta_tag' => $this->request->getPost('meta_tag'),
                'meta_keyword' => $this->request->getPost('meta_keyword'),
                'admin_mobile_list' => $this->request->getPost('admin_mobile_list'),
                'og_title' => $this->request->getPost('og_title'),
                'og_des' => $this->request->getPost('og_des'),
                'og_url' => $this->request->getPost('og_url'),
                'og_site' => $this->request->getPost('og_site'),
                'buytext' => $this->request->getPost('buytext'),
                'trantext' => $this->request->getPost('trantext'),
                'oversea_purchase' => $this->request->getPost('oversea_purchase'),
                'home_name' => $this->request->getPost('home_name'),
                'brand_name' => $this->request->getPost('brand_name'),
                'home_name_en' => $this->request->getPost('home_name_en'),
                'store_service01' => $this->request->getPost('store_service01'),
                'store_service02' => $this->request->getPost('store_service02'),
                'tour_no' => $this->request->getPost('tour_no'),
                'qna_email' => $this->request->getPost('qna_email'),
                'service_item' => $this->request->getPost('service_item'),
                'zip' => $this->request->getPost('zip'),
                'addr1' => $this->request->getPost('addr1'),
                'addr2' => $this->request->getPost('addr2'),
                'sydney_addr' => $this->request->getPost('sydney_addr'),
                'custom_service_phone_sydney' => $this->request->getPost('custom_service_phone_sydney'),
                'comnum' => $this->request->getPost('comnum'),
                'tournum' => $this->request->getPost('tournum'),
                'mallOrder' => $this->request->getPost('mallOrder'),
                'com_owner' => $this->request->getPost('com_owner'),
                'info_owner' => $this->request->getPost('info_owner'),
                'custom_phone' => $this->request->getPost('custom_phone'),
                'fax' => $this->request->getPost('fax'),
                'allim_apikey' => $this->request->getPost('allim_apikey'),
                'allim_userid' => $this->request->getPost('allim_userid'),
                'allim_senderkey' => $this->request->getPost('allim_senderkey'),
                'smtp_host' => $this->request->getPost('smtp_host'),
                'smtp_id' => $this->request->getPost('smtp_id'),
                'smtp_pass' => $this->request->getPost('smtp_pass'),
                'nicepay_pass' => $this->request->getPost('nicepay_pass'),
                'nicepay_mid' => $this->request->getPost('nicepay_mid'),
                'nicepay_key' => $this->request->getPost('nicepay_key'),
                'nicepay_mid_b' => $this->request->getPost('nicepay_mid_b'),
                'nicepay_key_b' => $this->request->getPost('nicepay_key_b'),
                'nicepay_mid_m' => $this->request->getPost('nicepay_mid_m'),
                'nicepay_key_m' => $this->request->getPost('nicepay_key_m'),
                'copyright' => $this->request->getPost('copyright'),
                'mileage_min' => $this->request->getPost('mileage_min'),
                'mileage_max' => $this->request->getPost('mileage_max'),
                'bank_owner' => $this->request->getPost('bank_owner'),
                'bank_owner_australia' => $this->request->getPost('bank_owner_australia'),
                'bank_name' => $this->request->getPost('bank_name'),
                'bank_name_australia' => $this->request->getPost('bank_name_australia'),
                'bank_no' => $this->request->getPost('bank_no'),
                'bank_no1' => $this->request->getPost('bank_no1'),
                'bank_no_australia' => $this->request->getPost('bank_no_australia'),
                'bank_no_australia1' => $this->request->getPost('bank_no_australia1'),
                'paymethod' => $this->request->getPost('paymethod'),
                'us_dollar' => $this->request->getPost('us_dollar'),
                'search_word' => $this->request->getPost('search_word'),
                'sms_phone' => $this->request->getPost('sms_phone'),
                'email' => $this->request->getPost('email'),
                'munnote_code' => $this->request->getPost('munnote_code'),
                'language' => $this->request->getPost('language'),
                'ssl_chk' => $this->request->getPost('ssl_chk'),
                'banks' => $this->request->getPost('banks')
            ];
    
            // if ($this->request->getPost('dels') == 'y') {
            //     $settings = $this->Setting->getSettings();
            //     unlink($settings['logos']);
            //     $data['logos'] = '';
            // }
    
            // if ($this->request->getFile('ufile1')->isValid()) {
            //     $file = $this->request->getFile('ufile1');
            //     $file->move('uploads/setting');
            //     $data['logos'] = $file->getName();
            // }
    
            // if ($this->request->getFile('ufile2')->isValid()) {
            //     $file = $this->request->getFile('ufile2');
            //     $file->move('uploads/setting');
            //     $data['og_img'] = $file->getName();
            // }
    
            // if ($this->request->getFile('ufile3')->isValid()) {
            //     $file = $this->request->getFile('ufile3');
            //     $file->move('uploads/setting');
            //     $data['favico'] = $file->getName();
            // }
    
            $this->Setting->updateSettings($data);
            session()->setFlashdata('message', '수정하였습니다.');
            return redirect()->to('adm/setting/site')->with('message', '수정하였습니다.');
        }
    }
}