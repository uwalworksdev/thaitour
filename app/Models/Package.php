<?php

use CodeIgniter\Model;

class Setting extends Model {
    // Tên của bảng mà model này liên kết tới
    protected $table = "tbl_homeset";

    // Khóa chính của bảng
    protected $primaryKey = "idx";

    // Các trường cho phép được cập nhật trong bảng
    protected $allowedFields = [];

    // Hàm khởi tạo, thiết lập các trường cho phép cập nhật
    protected function initialize() {
        $this->allowedFields = [
            'site_name', 'domain_url', 'browser_title', 'meta_tag', 'meta_keyword', 'og_title', 
            'og_des', 'og_url', 'og_site', 'buytext', 'trantext', 'naver_verfct', 
            'google_verfct', 'home_name', 'home_name_en', 'store_service01', 'store_service02',
            'zip', 'addr1', 'addr2', 'comnum', 'mall_order', 'com_owner', 
            'info_owner', 'custom_phone', 'fax', 'counsel1', 'counsel2',
        ];
    }

    // Hàm để lấy thông tin theo ID
    public function info($idx) {
        return $this->find($idx);
    }

    /**
     * Cập nhật dữ liệu trang web
     * * Các tập tin được xử lý riêng
     * @param int $idx Số nhận diện trang web (cố định là 1)
     * @param array|object $post Thông tin cần cập nhật
     * @return bool
     */
    public function infoUpdate($idx, $post) {
        return $this->update($idx, $post);
    }

    /**
     * Cập nhật dữ liệu tập tin của trang web
     * @param int $idx Số nhận diện trang web (cố định là 1)
     * @param string $fieldName Tên cột cần cập nhật
     * @param array $fileName Tên tập tin đã được tải lên (ufile)
     * @return bool
     */
    public function infoUpdateFile($idx, $fieldName, $fileName) {
        $this->allowedFields = [$fieldName];
        return $this->update($idx, $fileName);
    }
}