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
});
// $routes->group("/package", static function($routes){
//     $routes->get("", "Package::Main");
//     // $routes->get("(:segment)/view/(:segment)", "Promotion::View/$1/$2");

//     // $routes->get("dnload/(:segment)/(:segment)", "Filedown::brochureDownload/$1/$2");
// });

$routes->get('product/(:any)/(:any)', 'Product::index/$1/$2');
$routes->get('product-golf/(:any)/(:any)', 'Product::index2/$1/$2');
$routes->get('product-trip/(:any)/(:any)', 'Product::index3/$1/$2');
$routes->get('product-honey/(:any)/(:any)', 'Product::index4/$1/$2');
$routes->get('product_view/(:any)', 'Product::view/$1');


