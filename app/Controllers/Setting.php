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


            $uploadPath = WRITEPATH . 'uploads/home/';

            $site_name = $this->request->getPost('site_name');
            $domain_url = $this->request->getPost('domain_url');
            $admin_name = $this->request->getPost('admin_name');
            $admin_email = $this->request->getPost('admin_email');
            $browser_title = $this->request->getPost('browser_title');
            $meta_tag = $this->request->getPost('meta_tag');
            $meta_keyword = $this->request->getPost('meta_keyword');

            $og_title = $this->request->getPost('og_title');
            $og_des = $this->request->getPost('og_des');
            $og_url = $this->request->getPost('og_url');
            $og_site = $this->request->getPost('og_site');

            $buytext = $this->request->getPost('buytext');
            $trantext = $this->request->getPost('trantext');

            $home_name = $this->request->getPost('home_name');
            $home_name_en = $this->request->getPost('home_name_en');
            $store_service01 = $this->request->getPost('store_service01');
            $store_service02 = $this->request->getPost('store_service02');
            $zip = $this->request->getPost('zip');
            $addr1 = $this->request->getPost('addr1');
            $addr2 = $this->request->getPost('addr2');

            $comnum = $this->request->getPost('comnum');
            $mall_order = $this->request->getPost('mall_order');
            $com_owner = $this->request->getPost('com_owner');
            $info_owner = $this->request->getPost('info_owner');
            $custom_phone = $this->request->getPost('custom_phone');
            $fax = $this->request->getPost('fax');

            $sms_phone = $this->request->getPost('sms_phone');
            $email = $this->request->getPost('email');
            $munnote_code = $this->request->getPost('munnote_code');
            $dels = $this->request->getPost('dels');
            $dels_f = $this->request->getPost('dels_f');
            $main_country = $this->request->getPost('main_country');
            $main_member = $this->request->getPost('main_member');
            $banks = $this->request->getPost('banks');
            $bank_account = $this->request->getPost('bank_account');
            $bank_user = $this->request->getPost('bank_user');
            $ssl_chk = $this->request->getPost('ssl_chk');

            $naver_verfct = $this->request->getPost('naver_verfct');
            $google_verfct = $this->request->getPost('google_verfct');

            $allatpay_shop_id = $this->request->getPost('allatpay_shop_id');
            $allatpay_cross_key = $this->request->getPost('allatpay_cross_key');

            $sms_id = $this->request->getPost('sms_id');
            $sms_key = $this->request->getPost('sms_key');
            $npay_but_key = $this->request->getPost('npay_but_key');
            $npay_shop_id = $this->request->getPost('npay_shop_id');
            $npay_certikey = $this->request->getPost('npay_certikey');

            $counsel1 = $this->request->getPost('counsel1');
            $counsel2 = $this->request->getPost('counsel2');

            $purchase_limit_0 = $this->request->getPost('purchase_limit_0');
            $purchase_limit_1 = $this->request->getPost('purchase_limit_1');

            $language = $this->request->getPost('language') ? implode('||', $this->request->getPost('language')) : '';
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
                    if (is_file($uploadPath . $row['logo_footer'])) {
                        unlink($uploadPath . $row['logo_footer']);
                    }

                    $this->Setting->update(1, ['logo_footer' => '']);
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
                        $this->Setting->update(1, ['logo_footer' => $newName]);
                    }
                }
            }


            $dataToUpdate = [
                'site_name' => $site_name,
                'domain_url' => $domain_url,
                'admin_name' => $admin_name,
                'admin_email' => $admin_email,
                'browser_title' => $browser_title,
                'meta_tag' => $meta_tag,
                'meta_keyword' => $meta_keyword,
                'og_title' => $og_title,
                'og_des' => $og_des,
                'og_url' => $og_url,
                'og_site' => $og_site,
                'buytext' => $buytext,
                'trantext' => $trantext,
                'home_name' => $home_name,
                'home_name_en' => $home_name_en,
                'store_service01' => $store_service01,
                'store_service02' => $store_service02,
                'zip' => $zip,
                'addr1' => $addr1,
                'addr2' => $addr2,
                'comnum' => $comnum,
                'mall_order' => $mall_order,
                'com_owner' => $com_owner,
                'info_owner' => $info_owner,
                'custom_phone' => $custom_phone,
                'fax' => $fax,
                'sms_phone' => $sms_phone,
                'email' => $email,
                'munnote_code' => $munnote_code,
                'language' => $language,
                'ssl_chk' => $ssl_chk,
                'bank_user' => $bank_user,
                'banks' => $banks,
                'bank_account' => $bank_account,
                'allatpay_shop_id' => $allatpay_shop_id,
                'allatpay_cross_key' => $allatpay_cross_key,
                'naver_verfct' => $naver_verfct,
                'google_verfct' => $google_verfct,
                'sms_id' => $sms_id,
                'sms_key' => $sms_key,
                'npay_but_key' => $npay_but_key,
                'npay_shop_id' => $npay_shop_id,
                'npay_certikey' => $npay_certikey,
                'counsel1' => $counsel1,
                'counsel2' => $counsel2,
                'purchase_limit_0' => $purchase_limit_0,
                'purchase_limit_1' => $purchase_limit_1,
            ];
            $this->Setting->infoUpdate(1, $dataToUpdate);
            return redirect()->to('AdmMaster/setting/site');
        }
    }
}