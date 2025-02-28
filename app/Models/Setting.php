<?php

namespace App\Models;

use CodeIgniter\Model;

class Setting extends Model{
    protected $table = "tbl_homeset";

    protected $primaryKey = "idx";

    protected $allowedFields = [];

    protected function initialize()
    {
        $this->allowedFields = [
            "site_name", "domain_url", "admin_name", "admin_email", "browser_title",
            "meta_tag", "meta_keyword", "home_name", "brand_name", "home_name_en", "store_service01",
            "store_service02", "qna_email", "service_item", "zip", "addr1", "addr2", "sydney_addr",
            "comnum", "tournum", "mallOrder", "tour_no", "com_owner", "info_owner", "custom_phone",
            "fax", "sms_phone", "email", "munnote_code", "logos", "banks", "bank_account", "ssl_chk",
            "language", "buytext", "trantext", "oversea_purchase", "og_title", "og_des", "og_url",
            "og_site", "og_img", "allim_apikey", "allim_userid", "allim_senderkey", "smtp_host",
            "smtp_id", "smtp_pass", "nicepay_pass", "nicepay_mid", "nicepay_key", "nicepay_mid_b",
            "nicepay_key_b", "nicepay_mid_m", "nicepay_key_m", "inicis_mid", "inicis_signkey", "copyright", 
		    "mileage_min", "mileage_max", "mileage_review", "mileage_cash",
            "bank_owner", "bank_name", "bank_no", "paymethod", "us_dollar", "aud_dollar", "search_word",
            "custom_service_phone_seoul", "custom_service_phone_sydney", "custom_service_phone_sydney_call_from_australia",
            "bank_no1", "bank_owner_australia", "bank_name_australia", "bank_no_australia", "bank_no_australia1", "favico", 
            "admin_mobile_list", "admin_email_list", "baht_thai", "type_extra_cost", "extra_cost","logos_footer", "logos_consult",
            "comnum_thai", "custom_service_phone_thai", "custom_service_phone_thai2", "hour_open", "time_work", "time_reservation"
        ];
    }

    public function info($idx){
        return $this->find($idx);
    }
    /**
     * 홈페이지 데이터 수정
     * * 파일은 따로 수정
     * @param int $idx 홈페이지 식별번호 (1 로 고정)
     * @param array|object $post 업데이트 할 정보
     * @return bool
     */
    public function infoUpdate($idx, $post){
        return $this->update($idx, $post);
    }

    public function updateSettings($data)
    {
        return $this->update(1, $data);
    }
    /**
     * 홈페이지 파일 데이터 수정
     * @param int $idx 홈페이지 식별번호 (1 로 고정)
     * @param string $fieldName 업데이트할 컬럼명
     * @param array $fileName 업로드 된 파일명 (ufile)
     * @return bool
     */
    public function infoUpdateFile($idx, $fieldName, $fileName){
        $this->allowedFields = [$fieldName];
        return $this->update($idx, $fileName);
    }
}