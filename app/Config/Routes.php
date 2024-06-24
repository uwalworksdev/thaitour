<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



$routes->group("/adm", static function ($routes) {

    $routes->get("", "AdminLogin::loginView");
    $routes->post("login", "AdminLogin::LoginCheckAjax");
    $routes->get("logout", "AdminLogin::Logout");

    // 게시판
    $routes->group("board", static function ($routes) {
        $routes->get("(:segment)/list", "Board::ListView/$1");
        $routes->get("(:segment)/write", "Board::WriteView/$1");
        $routes->get("(:segment)/write/(:segment)", "Board::WriteView/$1/$2");
        // $routes->get("(:segment)/view", "");
        $routes->post("(:segment)/insert", "Board::WriteInsert/$1");
        $routes->post("(:segment)/update/(:segment)", "Board::WriteUpdate/$1/$2");
        $routes->get('dnload/(:segment)', "Filedown::dnload/$1");
        $routes->post('(:segment)/delete', "Board::delPost/$1");

        $routes->post("(:segment)/onum", "Board::OnumChange/$1");
    });
    $routes->group("{locale}/board", static function ($routes) {
        $routes->get("(:segment)/list", "Board::ListView/$1");
        $routes->get("(:segment)/write", "Board::WriteView/$1");
        $routes->get("(:segment)/write/(:segment)", "Board::WriteView/$1/$2");
        // $routes->get("(:segment)/view", "");
        $routes->post("(:segment)/insert", "Board::WriteInsert/$1");
        $routes->post("(:segment)/update/(:segment)", "Board::WriteUpdate/$1/$2");
        $routes->get('dnload/(:segment)', "Filedown::dnload/$1");
        $routes->post('(:segment)/delete', "Board::delPost/$1");

        $routes->post("(:segment)/onum", "Board::OnumChange/$1");
    });

    // 회원(서브관리자,관리자)
    $routes->group("member", static function ($routes) {
        $routes->get("admin/change", "Member::AdminPasswordChange");
        $routes->post("admin/change", "Member::AdminPasswordUpdate");
        // $routes->get("(:segment)/list", "");
        // $routes->get("(:segment)/write", "");
        // $routes->get("(:segment)/view", "");
        // $routes->post("(:segment)/insert", "");
        // $routes->post("(:segment)/update/(:segment)", "");
    });
    // 다운로드 파일
    // 메인페이지,회사소개(CI)
    // $routes->group("download", static function($routes){
    //     $routes->get("(:segment)", "");
    //     // $routes->get("(:segment)/write", "");
    //     // $routes->get("(:segment)/view", "");
    //     $routes->post("(:segment)/insert", "");
    //     $routes->post("(:segment)/update", "");
    // });

    $routes->group("setting", static function ($routes) {
        // 사이트 기본설정
        $routes->group("site", static function ($routes) {
            $routes->get("", "Setting::writeView");
            $routes->post("update", "Setting::writeUpdate");
        });
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
$routes->get('/', 'Home::index');
$routes->group("tools", static function ($routes) {
    $routes->get('generate_captcha'     , 'Tools::generate_captcha');
    $routes->post('get_travel_types'    , 'Tools::get_travel_types');
    $routes->post('get_list_product'    , 'Tools::get_list_product');
    $routes->post('wish_set'            , 'Tools::wish_set');
    $routes->post('del_wish'            , 'Tools::del_wish');
});
$routes->group("member", static function ($routes) {
    $routes->get("login"                , "Member::LoginForm");
    $routes->post("login_check"         , "Member::LoginCheck");
    $routes->get("join_choice"          , "Member::JoinChoice");
    $routes->get("join_agree"           , "Member::JoinAgree");
    $routes->post("join_form"           , "Member::JoinForm");
    $routes->get("join_complete"        , "Member::JoinComplete");
    $routes->post("member_reg_ok"       , "Member::RegOk");
    $routes->get("id_chk_ajax"          , "Member::IdCheck");
    $routes->get("logout"               , "Member::Logout");
});
$routes->group("mypage", static function ($routes) {
    $routes->get("details"              , "MyPage::details");
    $routes->get("custom_travel"        , "MyPage::custom_travel");
    $routes->get("custom_travel_view"   , "MyPage::custom_travel_view");
    $routes->get("contact"              , "MyPage::contact");
    $routes->get("consultation"         , "MyPage::consultation");
    $routes->get("fav_list"             , "MyPage::fav_list");
    $routes->get("travel_review"        , "MyPage::travel_review");
    $routes->get("point"                , "MyPage::point");
    $routes->get("coupon"               , "MyPage::coupon");
    $routes->get("discount"             , "MyPage::discount");
    $routes->get("discount_owned"       , "MyPage::discount_owned");
    $routes->get("discount_download"    , "MyPage::discount_download");
    $routes->get("info_option"          , "MyPage::info_option");
    $routes->get("info_change"          , "MyPage::info_change");
    $routes->get("user_mange"           , "MyPage::user_mange");
    $routes->get("money"                , "MyPage::money");
    $routes->get("invoice_view_item"    , "MyPage::invoice_view_item");
    $routes->post("info_option_ok"      , "MyPage::info_option_ok");
    $routes->post("info_change_ok"      , "MyPage::info_change_ok");
    $routes->post("contactDel"          , "MyPage::contactDel");
    $routes->post("qnaDel"              , "MyPage::qnaDel");
});
$routes->group("comment", static function ($routes) {
    $routes->get("comment_list"         , "Comment::listComment");
    $routes->post("comment"             , "Comment::addComment");
    $routes->post("cmtRep"              , "Comment::replyComment");
    $routes->post("cmtDel"              , "Comment::deleteComment");
    $routes->post("cmtEdit"             , "Comment::updateComment");
    $routes->post("cmtReport"           , "Comment::reportComment");
});
$routes->group("community", static function ($routes) {
    $routes->get("main"                 , "Community::main");
    $routes->get("questions"            , "Community::questions");
    $routes->get("announcement"         , "Community::announcement");
    $routes->get("announcement_view"    , "Community::announcement_view");
});
$routes->group("contact", static function ($routes) {
    $routes->get("main"                 , "Contact::main");
});
$routes->group("qna", static function ($routes) {
    $routes->get("list"                 , "Qna::list");
    $routes->get("view"                 , "Qna::view");
    $routes->get("write"                , "Qna::write");
    $routes->post("write_ok"            , "Qna::write_ok");
});
$routes->group("invoice", static function ($routes) {
    $routes->get("list"                 , "Orders::list_invoice");
    $routes->get("view_paid"            , "Orders::invoice_view_paid");
});
$routes->group("review", static function ($routes) {
    $routes->get("review_list"          , "ReviewController::list_review");
    $routes->get("review_detail"        , "ReviewController::detail_review");
    $routes->get("review_write"         , "ReviewController::write_review");
    $routes->post("review_write_ok"     , "ReviewController::save_review");
    $routes->post("review_delete"       , "ReviewController::review_delete");
});
$routes->group("event", static function ($routes) {
    $routes->get("event_list"           , "EventController::event_list");
    $routes->get("winning_list"         , "EventController::winning_list");
    $routes->get("event_view"           , "EventController::event_view");
});
$routes->group("center", static function ($routes) {
    $routes->get("insurance"            , "CustomerCenterController::insurance");
    $routes->get("tourterms"            , "CustomerCenterController::tourterms");
    $routes->get("terms"                , "CustomerCenterController::terms");
    $routes->get("privacy"              , "CustomerCenterController::privacy");
});
$routes->group("custom_travel", static function ($routes) {
    $routes->get("item_list"           , "CustomTravelController::item_list");
    $routes->get("item_write"           , "CustomTravelController::item_write");
    $routes->post("inquiry_ok"          , "CustomTravelController::inquiry_ok");
});










// $routes->group("/package", static function($routes){
//     $routes->get("", "Package::Main");
//     // $routes->get("(:segment)/view/(:segment)", "Promotion::View/$1/$2");

//     // $routes->get("dnload/(:segment)/(:segment)", "Filedown::brochureDownload/$1/$2");
// });

$routes->get('product/(:any)/(:any)', 'Product::index/$1/$2');
$routes->get('show-ticket', 'Product::showTicket');
$routes->get('product-list/(:any)', 'Product::index/$1');
$routes->get('product-golf/(:any)/(:any)', 'Product::index2/$1/$2');
$routes->get('product-tours/(:any)/(:any)', 'Product::index3/$1/$2');
$routes->get('product-spa/(:any)/(:any)', 'Product::index4/$1/$2');
$routes->get('product_view/(:any)', 'Product::view/$1');


