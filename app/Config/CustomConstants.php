<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class CustomConstants extends BaseConfig
{
    public function __construct()
    {
        parent::__construct();

        $use_skin = "sample1";

        // Định nghĩa các hằng số
        define("_PRIVATE_KEY", "Hihojoo9P7i4x8d23XQ3");

        define("_IT_SKIN_ROOT", $_SERVER['DOCUMENT_ROOT']."/skin/".$use_skin."/");
        define("_IT_SKIN_ROOT2", "/skin/".$use_skin."/");

        define("_IT_SKIN_INC", _IT_SKIN_ROOT."inc/");
        define("_IT_SKIN_CSS", _IT_SKIN_ROOT2."css/");
        define("_IT_SKIN_IMG", _IT_SKIN_ROOT2."img/");
        define("_IT_SKIN_JS",  _IT_SKIN_ROOT2."js/");

        // Kết nối cơ sở dữ liệu và lấy thông tin cấu hình
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM tbl_homeset WHERE idx='1'");
        $row_home_info = $query->getRowArray();

        define("_IT_SITE_NAME", $row_home_info['site_name']);
        define("_IT_BROWSER_TITLE", $row_home_info['browser_title']);
        define("_IT_FAVICO", $row_home_info['favico']);
        define("_IT_HOME_NAME", $row_home_info['home_name']);
        define("_IT_BRAND_NAME", $row_home_info['brand_name']);
        // define("_IT_ADDRESS", $row_home_info['address']);
        define("_IT_TOURNUM", $row_home_info['tournum']);
        define("_IT_PHONE_ADMIN", $row_home_info['admin_mobile_list']);
        define("_IT_COMNUM", $row_home_info['comnum']);
        define("_IT_TOUR_NO", $row_home_info['tournum']);
        define("_IT_MALL_ORDER", $row_home_info['mallOrder']);
        define("_IT_CUSTOM_PHONE", $row_home_info['custom_phone']);
        define("_IT_SMS_PHONE", $row_home_info['sms_phone']);
        define("_IT_EMAIL", $row_home_info['email']);
        define("_IT_MUNNOTE_CODE", $row_home_info['munnote_code']);
        define("_IT_LOGOS", "/data/home/".$row_home_info['logos']);
        define("_IT_COM_OWNER", $row_home_info['com_owner']);
        define("_SITE_INFORM", $row_home_info['trantext']);
        define("_IT_ADDR1", $row_home_info['addr1']);
        define("_IT_ADDR2", $row_home_info['addr2']);
        define("_SYDNEY_ADDR", $row_home_info['sydney_addr']);
        define("_CUSTOM_SERVICE_PHONE_SYDNEY", $row_home_info['custom_service_phone_sydney']);
        define("_CUSTOM_SERVICE_PHONE_SYDNEY_CALL_FROM_AUSTRALIA", $row_home_info['custom_service_phone_sydney_call_from_australia']);
        // define("_IT_MAIN_COUNTRY", $row_home_info['main_country']);
        // define("_IT_MAIN_MEMBER", $row_home_info['main_member']);
        define("_IT_BANKS", $row_home_info['banks']);
        define("_IT_FAX", $row_home_info['fax']);
        define("_ALLIM_APIKEY", $row_home_info['allim_apikey']);
        define("_ALLIM_USERID", $row_home_info['allim_userid']);
        define("_ALLIM_SENDERKEY", $row_home_info['allim_senderkey']);
        define("_SMTP_HOST", $row_home_info['smtp_host']);
        define("_SMTP_ID", $row_home_info['smtp_id']);
        define("_SMTP_PASS", $row_home_info['smtp_pass']);
        define("_IT_TRAN_TEXT", $row_home_info['trantext']);
        define("_NICEPAY_PASS", $row_home_info['nicepay_pass']);
        define("_NICEPAY_MID", $row_home_info['nicepay_mid']);
        define("_NICEPAY_KEY", $row_home_info['nicepay_key']);
        define("_NICEPAY_MID_B", $row_home_info['nicepay_mid_b']);
        define("_NICEPAY_KEY_B", $row_home_info['nicepay_key_b']);
        define("_NICEPAY_MID_M", $row_home_info['nicepay_mid_m']);
        define("_NICEPAY_KEY_M", $row_home_info['nicepay_key_m']);
        define("_MILEEAGE_MIN", $row_home_info['mileage_min']);
        define("_MILEEAGE_MAX", $row_home_info['mileage_max']);
        define("_BANK_OWNER", $row_home_info['bank_owner']);
        define("_BANK_NAME", $row_home_info['bank_name']);
        define("_BANK_NO", $row_home_info['bank_no']);
        define("_PAYMETHOD", $row_home_info['paymethod']);
        define("_US_DOLLAR", $row_home_info['us_dollar']);
        define("_SEARCH_WORD", $row_home_info['search_word']);
        // define("_ADULT_TEXT", $row_home_info['adult_text']);
        // define("_KIDS_TEXT", $row_home_info['kids_text']);
        // define("_BABY_TEXT", $row_home_info['baby_text']);
        define("_BROWSER_TITLE", $row_home_info['browser_title']);
        define("_META_TAG", $row_home_info['meta_tag']);
        define("_META_KEYWORD", $row_home_info['meta_keyword']);
        define("_OG_TITLE", $row_home_info['og_title']);
        define("_OG_DES", $row_home_info['og_des']);
        define("_OG_URL", $row_home_info['og_url']);
        define("_OG_SITE", $row_home_info['og_site']);
        define("_OG_IMG", "/data/home/". $row_home_info['og_img']);
        define("_BUYTEXT", $row_home_info['buytext']);
        define("_OVEREA_PURCHASE", $row_home_info['oversea_purchase']);
    }
}
