<?php

use CodeIgniter\Model;

class Setting extends Model{
    protected $table = "tbl_homeset";

    protected $primaryKey = "idx";

    protected $allowedFields = [];

    protected function initialize()
    {
        $this->allowedFields = [
            'site_name', 'domain_url', 'browser_title', 'meta_tag', 'meta_keyword', 'og_title', 
            'og_des', 'og_url', 'og_site', 'buytext', 'trantext', 'naver_verfct', 
            'google_verfct', 'home_name', 'home_name_en', 'store_service01', 'store_service02',
            'zip', 'addr1', 'addr2', 'comnum', 'mall_order', 'com_owner', 
            'info_owner', 'custom_phone', 'fax', 'counsel1', 'counsel2',
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