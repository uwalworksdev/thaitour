<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group("AdmMaster", static function ($routes) {

    $routes->get("", "AdminLogin::loginView");
    $routes->post("login", "AdminLogin::LoginCheckAjax");
    $routes->get("logout", "AdminLogin::Logout");

    $routes->get("main", "StatisticsController::main");

    $routes->group("_review", static function ($routes) {
        $routes->get("list", "ReviewController::list_admin");
        $routes->get("write", "ReviewController::write_admin");
        $routes->get("detail", "ReviewController::detail_admin");
        $routes->post("change_ajax", "ReviewController::change_ajax");

        $routes->post("del", "ReviewController::del");
        $routes->post("ajax_del", "ReviewController::ajax_del");
    });

    $routes->group("_member", static function ($routes) {
        $routes->get("list", "Member::list_member");
        $routes->post("del", "Member::del");
        $routes->get("email", "AutoMailController::index");
        $routes->get("sms", "SmsSettings::index");
        $routes->get("write", "Member::detail");
        $routes->get("sms_view", "SmsSettings::sms_view");
        $routes->post("sms_mod_ok", "SmsSettings::sms_mod_ok");
        $routes->get("email_view", "AutoMailController::email_view");
        $routes->post("email_mod_ok", "AutoMailController::email_mod_ok");
        // $routes->post("del", "TourRegistController::del");
        // $routes->post("ajax_del", "TourRegistController::ajax_del");
    });
    $routes->group("_bbs", static function ($routes) {
        $routes->get("board_list", "BoardController::index");
        $routes->get("board_write", "BoardController::board_write");
        $routes->post("ajax_bbs_proc", "BoardController::write_ok");
        $routes->get("board_list_q", "BoardController::index2");
        $routes->get("form", "BoardController::form");
        $routes->post("form_ok", "BoardController::form_ok");
        // $routes->get("email", "AutoMailController::index");
        // $routes->get("sms", "SmsSettings::index");
        // $routes->get("list_honeymoon", "TourRegistController::list_honeymoon");
        // $routes->get("list_tours", "TourRegistController::list_admin");
        // $routes->get("list_golf", "TourRegistController::list_admin");
        // $routes->get("_tourStay", "TourRegistController::list_admin");
        // $routes->post("del", "TourRegistController::del");
        // $routes->post("ajax_del", "TourRegistController::ajax_del");
    });

    $routes->group("_reservation", static function ($routes) {
        $routes->get("list", "Admin\ReservationController::list");
    });

    $routes->group("_qna", static function ($routes) {
        $routes->get("list", "Admin\QnaController::list");
        $routes->get("write", "Admin\QnaController::write");
        $routes->post("write_ok", "Admin\QnaController::write_ok");
        $routes->post("delete", "Admin\QnaController::delete");
    });

    $routes->group("_contact", static function ($routes) {
        $routes->get("list", "Admin\ContactController::list");
        $routes->get("write", "Admin\ContactController::write");
        $routes->post("write_ok", "Admin\ContactController::write_ok");
        $routes->post("delete", "Admin\ContactController::delete");
    });

    $routes->group("_code", static function ($routes) {
        $routes->get("list", "CodeController::list_admin");
        $routes->get("write", "CodeController::write_admin");
        $routes->post("write_ok", "CodeController::write_ok");
        $routes->post("change", "CodeController::change_ajax");
        $routes->post("del", "CodeController::del");
    });

    $routes->group("_tourRegist", static function ($routes) {
        $routes->get("list_all", "TourRegistController::list_admin");
        $routes->get("list_honeymoon", "TourRegistController::list_honeymoon");
        $routes->get("list_tours", "TourRegistController::list_admin");
        $routes->get("list_golf", "TourRegistController::list_admin");
        $routes->get("_tourStay", "TourRegistController::list_admin");
        $routes->post("del", "TourRegistController::del");
        $routes->post("ajax_del", "TourRegistController::ajax_del");
    });

    $routes->group("_tourSuggestion", static function ($routes) {
        $routes->get("list", "TourSuggestionController::list_admin");
        $routes->get("list_honeymoon", "TourSuggestionController::list_honeymoon");
        $routes->get("list_tours", "TourSuggestionController::list_admin");
        $routes->get("list_golf", "TourSuggestionController::list_admin");
        $routes->get("_tourStay", "TourSuggestionController::list_admin");
        $routes->post("del", "TourSuggestionController::del");
        $routes->post("ajax_del", "TourSuggestionController::ajax_del");
    });

    $routes->group("_tourSuggestionSub", static function ($routes) {
        $routes->get("list", "TourSuggestionController::list_admin");
        $routes->get("list_honeymoon", "TourSuggestionController::list_honeymoon");
        $routes->get("list_tours", "TourSuggestionController::list_admin");
        $routes->get("list_golf", "TourSuggestionController::list_admin");
        $routes->get("_tourStay", "TourSuggestionController::list_admin");
        $routes->post("del", "TourSuggestionController::del");
        $routes->post("ajax_del", "TourSuggestionController::ajax_del");
    });

    $routes->group("_tourLevel", static function ($routes) {
        $routes->get("list", "TourSuggestionController::list_admin");
        $routes->get("list_honeymoon", "TourSuggestionController::list_honeymoon");
        $routes->get("list_tours", "TourSuggestionController::list_admin");
        $routes->get("list_golf", "TourSuggestionController::list_admin");
        $routes->get("_tourStay", "TourSuggestionController::list_admin");
        $routes->post("del", "TourSuggestionController::del");
        $routes->post("ajax_del", "TourSuggestionController::ajax_del");
    });

    $routes->group("_tourOption", static function ($routes) {
        $routes->get("list", "TourSuggestionController::list_admin");
        $routes->get("list_honeymoon", "TourSuggestionController::list_honeymoon");
        $routes->get("list_tours", "TourSuggestionController::list_admin");
        $routes->get("list_golf", "TourSuggestionController::list_admin");
        $routes->get("_tourStay", "TourSuggestionController::list_admin");
        $routes->post("del", "TourSuggestionController::del");
        $routes->post("ajax_del", "TourSuggestionController::ajax_del");
    });

    $routes->group("_tourStay", static function ($routes) {
        $routes->get("list", "TourSuggestionController::list_admin");
        $routes->get("list_honeymoon", "TourSuggestionController::list_honeymoon");
        $routes->get("list_tours", "TourSuggestionController::list_admin");
        $routes->get("list_golf", "TourSuggestionController::list_admin");
        $routes->get("_tourStay", "TourSuggestionController::list_admin");
        $routes->post("del", "TourSuggestionController::del");
        $routes->post("ajax_del", "TourSuggestionController::ajax_del");
    });

    $routes->group("_adminrator", static function ($routes) {
        // 사이트 기본설정
        $routes->get("setting", "Setting::writeView");
        $routes->post("update", "Setting::writeUpdate");
        // 팝업
        $routes->group("popup", static function ($routes) {
            $routes->get("list", "Popup::ListView");
            $routes->get("write", "Popup::WriteView");
            $routes->get("write/(:segment)", "Popup::WriteView/$1");

            $routes->post("insert", "Popup::WriteInsert");
            $routes->post("update/(:segment)", "Popup::WriteUpdate/$1");
            $routes->get("delete", "Popup::ItemDelete");
            $routes->post("status/change", "Popup::ListStatusChangeAjax");
        });
        $routes->get("policy", "Policy::WriteView");
    });
});

$routes->group("ajax", static function ($routes) {
    $routes->post("uploader", "AjaxController::uploader");
    $routes->post("get_travel_types", "AjaxController::get_travel_types");
});

$routes->get('image/(:segment)/(:segment)', 'ImageController::show/$1/$2');

$routes->get('/', 'Home::index');
$routes->post('/file_uploader', 'FileUpload::file_uploader');
$routes->group("tools", static function ($routes) {
    $routes->get('generate_captcha', 'Tools::generate_captcha');
    $routes->post('get_travel_types', 'Tools::get_travel_types');
    $routes->post('get_list_product', 'Tools::get_list_product');
    $routes->post('wish_set', 'Tools::wish_set');
    $routes->post('del_wish', 'Tools::del_wish');
});
$routes->group("member", static function ($routes) {
    $routes->get("login", "Member::LoginForm");
    $routes->post("login_check", "Member::LoginCheck");
    $routes->get("join_choice", "Member::JoinChoice");
    $routes->get("join_agree", "Member::JoinAgree");
    $routes->post("join_form", "Member::JoinForm");
    $routes->get("join_complete", "Member::JoinComplete");
    $routes->post("member_reg_ok", "Member::RegOk");
    $routes->get("id_chk_ajax", "Member::IdCheck");
    $routes->get("logout", "Member::Logout");
    $routes->post("phone_chk_ajax", "Member::phone_chk_ajax");
    $routes->post("email_chk_ajax", "Member::email_chk_ajax");
    $routes->post("num_chk_ajax", "Member::num_chk_ajax");
    $routes->post("num_chk2_ajax", "Member::num_chk2_ajax");
    $routes->post("sns_kakao_login", "Member::sns_kakao_login");
    $routes->get("google_login", "Member::google_login");
    $routes->post("join_form_sns", "Member::join_form_sns");
    $routes->post("update/(:segment)", "Member::update_member/$1");
});
$routes->group("mypage", static function ($routes) {
    $routes->get("details", "MyPage::details");
    $routes->get("custom_travel", "MyPage::custom_travel");
    $routes->get("custom_travel_view", "MyPage::custom_travel_view");
    $routes->get("contact", "MyPage::contact");
    $routes->get("consultation", "MyPage::consultation");
    $routes->get("fav_list", "MyPage::fav_list");
    $routes->get("travel_review", "MyPage::travel_review");
    $routes->get("point", "MyPage::point");
    $routes->get("coupon", "MyPage::coupon");
    $routes->get("discount", "MyPage::discount");
    $routes->get("discount_owned", "MyPage::discount_owned");
    $routes->get("discount_download", "MyPage::discount_download");
    $routes->get("info_option", "MyPage::info_option");
    $routes->get("info_change", "MyPage::info_change");
    $routes->get("user_mange", "MyPage::user_mange");
    $routes->get("money", "MyPage::money");
    $routes->get("invoice_view_item", "MyPage::invoice_view_item");
    $routes->post("info_option_ok", "MyPage::info_option_ok");
    $routes->post("info_change_ok", "MyPage::info_change_ok");
    $routes->post("contactDel", "MyPage::contactDel");
    $routes->post("qnaDel", "MyPage::qnaDel");
});
$routes->group("comment", static function ($routes) {
    $routes->get("comment_list", "Comment::listComment");
    $routes->post("comment", "Comment::addComment");
    $routes->post("cmtRep", "Comment::replyComment");
    $routes->post("cmtDel", "Comment::deleteComment");
    $routes->post("cmtEdit", "Comment::updateComment");
    $routes->post("cmtReport", "Comment::reportComment");
});
$routes->group("community", static function ($routes) {
    $routes->get("main", "Community::main");
    $routes->get("questions", "Community::questions");
    $routes->get("announcement", "Community::announcement");
    $routes->get("customer_center", "Community::customer_center");

    $routes->get("customer_center/notify", "Community::customer_center_notify");
    $routes->get("customer_center/list_notify", "Community::list_notify");

    $routes->get("customer_center/notify_table", "Community::notify_table");
    $routes->post("customer_center/notify_table_ok", "Community::notify_table_ok");

    $routes->get("customer_center/customer_speak", "Community::customer_speak");
    $routes->get("announcement_view", "Community::announcement_view");
});
$routes->group("contact", static function ($routes) {
    $routes->get("main", "Contact::main");
});
$routes->group("qna", static function ($routes) {
    $routes->get("list", "Qna::list");
    $routes->get("view", "Qna::view");
    $routes->get("write", "Qna::write");
    $routes->post("write_ok", "Qna::write_ok");
});
$routes->group("invoice", static function ($routes) {
    $routes->get("list", "Orders::list_invoice");
    $routes->get("view_paid", "Orders::invoice_view_paid");
});
$routes->group("review", static function ($routes) {
    $routes->get("review_list", "ReviewController::list_review");
    $routes->get("review_detail", "ReviewController::detail_review");
    $routes->get("review_write", "ReviewController::write_review");
    $routes->post("review_write_ok", "ReviewController::save_review");
    $routes->post("review_delete", "ReviewController::review_delete");
});
$routes->group("event", static function ($routes) {
    $routes->get("event_list", "EventController::event_list");
    $routes->get("winning_list", "EventController::winning_list");
    $routes->get("event_view", "EventController::event_view");
});
$routes->group("center", static function ($routes) {
    $routes->get("insurance", "CustomerCenterController::insurance");
    $routes->get("tourterms", "CustomerCenterController::tourterms");
    $routes->get("terms", "CustomerCenterController::terms");
    $routes->get("privacy", "CustomerCenterController::privacy");
});
$routes->group("custom_travel", static function ($routes) {
    $routes->get("item_list", "CustomTravelController::item_list");
    $routes->get("item_write", "CustomTravelController::item_write");
    $routes->post("inquiry_ok", "CustomTravelController::inquiry_ok");
});

// $routes->group("/package", static function($routes){
//     $routes->get("", "Package::Main");
//     // $routes->get("(:segment)/view/(:segment)", "Promotion::View/$1/$2");

//     // $routes->get("dnload/(:segment)/(:segment)", "Filedown::brochureDownload/$1/$2");
// });

$routes->get('product/(:any)/(:any)', 'Product::index/$1/$2');
$routes->get('show-ticket', 'Product::showTicket');
$routes->get('vehicle-guide', 'Product::vehicleGuide');
$routes->get('product-tours/(:any)', 'Product::index/$1');
$routes->get('product-list/(:any)', 'Product::index3/$1');
$routes->get('product-hotel/list-hotel/(:any)', 'Product::index5/$1');
$routes->get('product-hotel/hotel-detail/(:any)', 'Product::index6/$1');
$routes->get('product-hotel/(:any)', 'Product::indexHotel/$1');
$routes->get('product-result/(:any)', 'Product::indexResult/$1');
$routes->get('product-golf/list-golf/(:any)', 'Product::golfList/$1');
$routes->get('product-golf/golf-detail/(:any)', 'Product::golfDetail/$1');
$routes->get('product-golf/(:any)/(:any)', 'Product::index2/$1/$2');
$routes->get('tours/item_view/(:any)', 'Product::index7/$1');
$routes->get('product-spa/(:any)/(:any)', 'Product::index4/$1/$2');
$routes->get('product_view/(:any)', 'Product::view/$1');


