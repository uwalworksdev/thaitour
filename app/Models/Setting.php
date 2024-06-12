<?php

use CodeIgniter\Model;

class Setting extends Model{
    protected $table = "tbl_homeset";

    protected $primaryKey = "idx";

    protected $allowedFields = [];

    protected function initialize()
    {
        $this->allowedFields = [
            'site_name', 'domain_url', 'admin_name', 'admin_email', 'browser_title', 'meta_tag', 'meta_keyword', 'admin_mobile_list',
            'og_title', 'og_des', 'og_url', 'og_site', 'buytext', 'trantext', 'oversea_purchase', 'home_name', 'brand_name',
            'home_name_en', 'store_service01', 'store_service02', 'tour_no', 'qna_email', 'service_item', 'zip', 'addr1', 'addr2',
            'sydney_addr', 'custom_service_phone_sydney', 'comnum', 'tournum', 'mallOrder', 'com_owner', 'info_owner', 'custom_phone',
            'fax', 'allim_apikey', 'allim_userid', 'allim_senderkey', 'smtp_host', 'smtp_id', 'smtp_pass', 'nicepay_pass', 'nicepay_mid',
            'nicepay_key', 'nicepay_mid_b', 'nicepay_key_b', 'nicepay_mid_m', 'nicepay_key_m', 'copyright', 'mileage_min', 'mileage_max',
            'bank_owner', 'bank_owner_australia', 'bank_name', 'bank_name_australia', 'bank_no', 'bank_no1', 'bank_no_australia',
            'bank_no_australia1', 'paymethod', 'us_dollar', 'search_word', 'sms_phone', 'email', 'munnote_code', 'language', 'ssl_chk', 'banks'
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
        // $this->allowedFields = [''];
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