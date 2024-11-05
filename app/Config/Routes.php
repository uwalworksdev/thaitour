<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group("AdmMaster", static function ($routes) {
    $routes->get("", "AdminLogin::loginView");
    $routes->post("login", "AdminLogin::LoginCheckAjax");
    $routes->get("logout", "AdminLogin::Logout");

    $routes->post("prod_update/(:segment)", "TourRegistController::prod_update/$1", ['as' => "admin._tour.prod_update"]);

    $routes->get("main", "StatisticsController::main");

    $routes->group("_review", static function ($routes) {
        $routes->get("list", "ReviewController::list_admin");
        $routes->get("write", "ReviewController::write_admin");
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
        $routes->get("pre_viw_mail", "Admin\AdminMemberController::pre_viw_mail");
        // $routes->post("del", "TourRegistController::del");
        // $routes->post("ajax_del", "TourRegistController::ajax_del");
    });
    $routes->group("_bbs", static function ($routes) {
        $routes->get("board_list", "BoardController::index");
        $routes->get("board_write", "BoardController::board_write");
        $routes->post("ajax_bbs_proc", "BoardController::write_ok");
        $routes->get("board_list_q", "BoardController::index2");
        $routes->get("form", "BoardController::form");
        $routes->get("view", "BoardController::view");
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
        $routes->get("(:segment)/write", "Admin\ReservationController::write/$1");
        $routes->post("write_ok", "Admin\ReservationController::write_ok");
        $routes->post("delete", "Admin\ReservationController::delete");
        $routes->get("get_code", "Admin\ReservationController::get_code");
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
        $routes->post("del", "CodeController::del");
    });

    $routes->group("_tourRegist", static function ($routes) {
        $routes->get("list_hotel", "TourRegistController::list_hotel");
        $routes->get("list_spas", "TourRegistController::list_spas");
        $routes->get("list_all", "TourRegistController::list_all");
        $routes->get("list_honeymoon", "TourRegistController::list_honeymoon");
        $routes->get("list_tours", "TourRegistController::list_tours");
        $routes->get("list_golf", "TourRegistController::list_golfs");
        $routes->get("write", "TourRegistController::write");
        $routes->get("write_all", "TourRegistController::write_all");
        $routes->get("write_honeymoon", "TourRegistController::write_honeymoon");
        $routes->get("write_golf", "TourRegistController::write_golf");
        $routes->post("write_golf_ok", "TourRegistController::write_golf_ok");
        $routes->post("write_golf_ok/(:segment)", "TourRegistController::write_golf_ok/$1");
        $routes->post("write_golf/add_moption", "TourRegistController::add_moption");
        $routes->put("write_golf/upd_moption/(:segment)", "TourRegistController::upd_moption/$1");
        $routes->delete("write_golf/del_moption/(:segment)", "TourRegistController::del_moption/$1");
        $routes->get("write_spas", "TourRegistController::write_spas");
        $routes->get("write_tours", "TourRegistController::write_tours");
        $routes->get("write_tour_info", "TourRegistController::write_tour_info");
        $routes->post("write_tours/addMoption", "TourRegistController::addMoption");
        $routes->post("write_tours/updMoption", "TourRegistController::updMoption");
        $routes->post("write_tours/delMoption", "TourRegistController::delMoption");
        $routes->post("write_tours/addOption", "TourRegistController::addOption");
        $routes->post("write_tours/updOption", "TourRegistController::updOption");
        $routes->post("write_tours/delOption", "TourRegistController::delOption");
        $routes->get("_tourStay", "TourRegistController::list");
        $routes->group('golf_vehicles', function ($routes) {
            $routes->get('/', 'GolfVehicleController::list');
            $routes->get('write', 'GolfVehicleController::write');
            $routes->get('write/(:num)', 'GolfVehicleController::write/$1');
            $routes->post("write_ok", "GolfVehicleController::write_ok");
            $routes->post('del', 'GolfVehicleController::del');
            $routes->post("change", "GolfVehicleController::change_ajax");
        });
    });

    $routes->group("_hotel", static function ($routes) {
        $routes->get("list", "Admin\AdminHotelController::list");
        $routes->get("write", "Admin\AdminHotelController::write");
        $routes->get("get_room", "Admin\AdminHotelController::get_room", ['as' => "admin._hotel.get_room"]);
        $routes->post("write_ok", "Admin\AdminHotelController::write_ok", ['as' => "admin._hotel.write_ok"]);
        $routes->post("write_ok/(:segment)", "Admin\AdminHotelController::write_ok/$1", ['as' => "admin._hotel.write_ok.id"]);
        $routes->post("change", "Admin\AdminHotelController::change", ['as' => "admin._hotel.change"]);
        $routes->post("del", "Admin\AdminHotelController::del", ['as' => "admin._hotel.del"]);
        $routes->post("search_code", "Admin\AdminHotelController::search_code", ['as' => "admin._hotel.search_code"]);
        $routes->post("del_hotel_option", "Admin\AdminHotelController::del_hotel_option", ['as' => "admin._hotel.del_hotel_option"]);
        $routes->post("del_room_option", "Admin\AdminHotelController::del_room_option", ['as' => "admin._hotel.del_room_option"]);
    });

    $routes->group("_tours", static function ($routes) {
        $routes->post("write_ok", "Admin\AdminTourController::write_ok", ['as' => "admin._tours.write_ok"]);
        $routes->post("write_info_ok", "Admin\AdminTourController::write_info_ok", ['as' => "admin._tours.write_info_ok"]);
        $routes->post("del_tours", "Admin\AdminTourController::del_tours", ['as' => "admin._tours.del_tours"]);
        $routes->post("del", "Admin\AdminTourController::del", ['as' => "admin._tours.del"]);
        $routes->get("detailwrite_new", "Admin\AdminTourController::detailwrite_new", ['as' => "admin._tours.detailwrite_new"]);
        $routes->post("chg_detailwrite", "Admin\AdminTourController::chg_detailwrite", ['as' => "admin._tours.chg_detailwrite"]);
        $routes->post("day_seq_delete", "Admin\AdminTourController::day_seq_delete", ['as' => "admin._tours.day_seq_delete"]);
        $routes->post("del_day", "Admin\AdminTourController::del_day", ['as' => "admin._tours.del_day"]);
        $routes->post("detailwrite_new_ok", "Admin\AdminTourController::detailwrite_new_ok", ['as' => "admin._tours.detailwrite_new_ok"]);
    });

    $routes->group("api", function ($routes) {
        $routes->get("get_code", "Api\AdminTourApi::get_code");
        $routes->post("ajax_change", "Api\AdminTourApi::ajax_change");
        $routes->post("del", "Api\AdminTourApi::del");
        $routes->post("prod_update", "Api\AdminTourApi::prod_update");
        $routes->post("ajax_del", "Api\AdminTourApi::ajax_del");

        // Nested group for 'tour_stay_'
        $routes->group("tour_stay_", function ($routes) {
            $routes->get("get_code", "Api\AdminTourStayApi::get_code", ['as' => "admin.api.tour_stay.get_code"]);
            $routes->post("ajax_change", "Api\AdminTourStayApi::ajax_change", ['as' => "admin.api.tour_stay.ajax_change"]);
            $routes->post("del", "Api\AdminTourStayApi::del", ['as' => "admin.api.tour_stay.del"]);
            $routes->post("prod_update", "Api\AdminTourStayApi::prod_update", ['as' => "admin.api.tour_stay.prod_update"]);
        });

        // Nested group for 'bbs_'
        $routes->group("bbs_", function ($routes) {
            $routes->post("comment_proc", "Api\AdminBbsApi::comment_proc", ['as' => "admin.api.bbs.comment_proc"]);
            $routes->post("bbs_change", "Api\AdminBbsApi::bbs_change", ['as' => "admin.api.bbs.bbs_change"]);
            $routes->post("bbs_del", "Api\AdminBbsApi::bbs_del", ['as' => "admin.api.bbs.bbs_del"]);
        });

        // Nested group for 'code_'
        $routes->group("code_", function ($routes) {
            $routes->post("code_del", "Api\AdminCodeApi::code_del", ['as' => "admin.api.code.code_del"]);
        });

        $routes->group("product_", function ($routes) {
            $routes->post("change_manager", "Api\AdminTourApi::change_manager", ['as' => "admin.api.product_.change_manager"]);
            $routes->post("add_moption", "Api\AdminTourApi::add_moption", ['as' => "admin.api.product_.add_moption"]);
            $routes->post("upd_moption", "Api\AdminTourApi::upd_moption", ['as' => "admin.api.product_.upd_moption"]);
            $routes->post("del_moption", "Api\AdminTourApi::del_moption", ['as' => "admin.api.product_.del_moption"]);
            $routes->post("add_option", "Api\AdminTourApi::add_option", ['as' => "admin.api.product_.add_option"]);
            $routes->post("upd_option", "Api\AdminTourApi::upd_option", ['as' => "admin.api.product_.upd_option"]);
            $routes->post("del_option", "Api\AdminTourApi::del_option", ['as' => "admin.api.product_.del_option"]);
            $routes->post("img_remove", "Api\AdminTourApi::img_remove", ['as' => "admin.api.product_.img_remove"]);
        });

        // Nested group for 'spa_'
        $routes->group("spa_", function ($routes) {
            $routes->post("write_ok", "Admin\AdminSpaController::write_ok", ['as' => "admin.api.spa_.write_ok"]);
            $routes->post("prod_update", "Admin\AdminSpaController::prod_update", ['as' => "admin.api.spa_.prod_update"]);
            $routes->post("ajax_change", "Admin\AdminSpaController::ajax_change", ['as' => "admin.api.spa_.ajax_change"]);
            $routes->post("del", "Admin\AdminSpaController::del", ['as' => "admin.api.spa_.del"]);
            $routes->get("get_code", "Admin\AdminSpaController::get_code", ['as' => "admin.api.spa_.get_code"]);
            $routes->post("change_manager", "Admin\AdminSpaController::change_manager", ['as' => "admin.api.spa_.change_manager"]);
            $routes->post("add_moption", "Admin\AdminSpaController::add_moption", ['as' => "admin.api.spa_.add_moption"]);
            $routes->post("upd_moption", "Admin\AdminSpaController::upd_moption", ['as' => "admin.api.spa_.upd_moption"]);
            $routes->post("del_moption", "Admin\AdminSpaController::del_moption", ['as' => "admin.api.spa_.del_moption"]);
            $routes->post("add_option", "Admin\AdminSpaController::add_option", ['as' => "admin.api.spa_.add_option"]);
            $routes->post("upd_option", "Admin\AdminSpaController::upd_option", ['as' => "admin.api.spa_.upd_option"]);
            $routes->post("del_option", "Admin\AdminSpaController::del_option", ['as' => "admin.api.spa_.del_option"]);
            $routes->post("img_remove", "Admin\AdminSpaController::img_remove", ['as' => "admin.api.spa_.img_remove"]);
        });
    });

    $routes->group("_tourStay", static function ($routes) {
        $routes->get("list", "TourStayController::list");
        $routes->get("write", "TourStayController::write");
        $routes->post("write_ok", "TourStayController::write_ok", ['as' => "admin.tourStay.write_ok"]);
    });

    $routes->group("_room", static function ($routes) {
        $routes->get("list", "Admin\AdminRoomController::list", ['as' => "admin.room.list"]);
        $routes->get("write", "Admin\AdminRoomController::write", ['as' => "admin.room.write"]);
        $routes->post("write_ok", "Admin\AdminRoomController::write_ok", ['as' => "admin.room.write_ok"]);
        $routes->post("del", "Admin\AdminRoomController::del", ['as' => "admin.room.del"]);
    });

    $routes->group("_tourSuggestion", static function ($routes) {
        $routes->get("list", "TourSuggestionSubController::list");
        $routes->get("write", "TourSuggestionController::write");
    });

    $routes->group("_tourSuggestionSub", static function ($routes) {
        $routes->get("list", "TourSuggestionSubController::list");
        $routes->get("write", "TourSuggestionSubController::write");
        $routes->get("prd_list", "TourSuggestionSubController::prd_list");
        $routes->get("goods_find", "TourSuggestionSubController::goods_find");
        $routes->get("item_allfind", "TourSuggestionSubController::item_allfind");
        $routes->post("main_update", "TourSuggestionSubController::main_update");
        $routes->post("seq_upd1", "TourSuggestionSubController::seq_upd1");
        $routes->post("goods_alldel", "TourSuggestionSubController::goods_alldel");
    });

    $routes->group("_tourLevel", static function ($routes) {
        $routes->get("list", "Admin\TourLevelController::list");
        $routes->get("write", "Admin\TourLevelController::write");
    });

    $routes->group("_tourOption", static function ($routes) {
        $routes->get("list", "Admin\TourOptionController::list");
        $routes->get("write", "Admin\TourOptionController::write");
    });

    $routes->group("_inquiry", static function ($routes) {
        $routes->get("list", "Admin\AdminInquiryController::list");
        $routes->get("write", "Admin\AdminInquiryController::write");
    });

    $routes->group("_operator", static function ($routes) {
        $routes->get("coupon_setting", "Admin\AdminOperatorController::coupon_setting");
        $routes->get("coupon_setting_write", "Admin\AdminOperatorController::coupon_setting_write");
        $routes->post("coupon_setting_write_ok", "Admin\AdminOperatorController::coupon_setting_write_ok", ['as' => "admin.operator.coupon_setting_write_ok"]);
        $routes->post("coupon_setting_del", "Admin\AdminOperatorController::coupon_setting_del", ['as' => "admin.operator.coupon_setting_del"]);
        $routes->get("coupon_list", "Admin\AdminOperatorController::coupon_list");
        $routes->get("coupon_write", "Admin\AdminOperatorController::coupon_write");
        $routes->post("coupon_write_ok", "Admin\AdminOperatorController::coupon_write_ok", ['as' => "admin.operator.coupon_write_ok"]);
        $routes->post("coupon_del", "Admin\AdminOperatorController::coupon_del", ['as' => "admin.operator.coupon_del"]);
        $routes->get("find_user", "Admin\AdminOperatorController::find_user");
        $routes->get("send_coupon", "Admin\AdminOperatorController::send_coupon");

    });

    $routes->group("_mileage", static function ($routes) {
        $routes->get("list", "Admin\AdminMileageController::list");
        $routes->get("write", "Admin\AdminMileageController::write");
    });

    $routes->group("_memberBoard", static function ($routes) {
        $routes->get("board_list", "Admin\AdminMemberBoardController::board_list");
        $routes->get("board_write", "Admin\AdminMemberBoardController::board_write");
    });

    $routes->group("_memberBreak", static function ($routes) {
        $routes->get("list", "Admin\AdminMemberBreakController::list");
        $routes->get("write", "Admin\AdminMemberBreakController::write");
    });

    $routes->group("_bbsBanner", static function ($routes) {
        $routes->get("list", "Admin\AdminBbsBannerController::list");
        $routes->get("write", "Admin\AdminBbsBannerController::write");
    });

    $routes->group("_codeBanner", static function ($routes) {
        $routes->get("list", "Admin\AdminCodeBannerController::list");
        $routes->get("write", "Admin\AdminCodeBannerController::write");
    });

    $routes->group("_cateBanner", static function ($routes) {
        $routes->get("list", "Admin\AdminCateBannerController::list");
        $routes->get("write", "Admin\AdminCateBannerController::write");
    });

    $routes->group("_cms", static function ($routes) {
        $routes->get("index", "Admin\AdminCmsController::index");
        $routes->get("write", "Admin\AdminCmsController::write");
        $routes->get("policy_list", "Admin\AdminCmsController::policy_list");
        $routes->get("policy_write", "Admin\AdminCmsController::policy_write");
    });

    $routes->group("_statistics", static function ($routes) {
        $routes->get("statistics01_01", "Admin\AdminStatisticsController::statistics01_01");
        $routes->get("statistics01_02", "Admin\AdminStatisticsController::statistics01_02");
        $routes->get("statistics01_03", "Admin\AdminStatisticsController::statistics01_03");
        $routes->get("statistics01_04", "Admin\AdminStatisticsController::statistics01_04");
        $routes->get("statistics01_05", "Admin\AdminStatisticsController::statistics01_05");
        $routes->get("statistics01_06", "Admin\AdminStatisticsController::statistics01_06");
        $routes->get("statistics01_07", "Admin\AdminStatisticsController::statistics01_07");
        $routes->get("statistics01_08", "Admin\AdminStatisticsController::statistics01_08");
        $routes->get("statistics02_01", "Admin\AdminStatisticsController::statistics02_01");
        $routes->get("statistics03_01", "Admin\AdminStatisticsController::statistics03_01");
        $routes->get("statistics04_01", "Admin\AdminStatisticsController::statistics04_01");
        $routes->get("statistics05_01", "Admin\AdminStatisticsController::statistics05_01");
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

        $routes->group("block_ip", static function ($routes) {
            $routes->get("list", "Popup::ListView");
            $routes->get("write", "Popup::WriteView");
            $routes->get("write/(:segment)", "Popup::WriteView/$1");

            $routes->post("insert", "Popup::WriteInsert");
            $routes->post("update/(:segment)", "Popup::WriteUpdate/$1");
            $routes->get("delete", "Popup::ItemDelete");
            $routes->post("status/change", "Popup::ListStatusChangeAjax");
        });

        $routes->get("policy", "Policy::WriteView");

        $routes->get("store_config_admin", "Admin\AdminController::store_config_admin");
        $routes->get("write", "Admin\AdminController::write");
        $routes->get("search_word", "Admin\AdminController::search_word");
        $routes->get("search_write", "Admin\AdminController::search_write");
        $routes->get("block_ip_list", "Admin\AdminController::block_ip_list");
    });
});

$routes->group("ajax", static function ($routes) {
    $routes->post("uploader", "AjaxController::uploader");
    $routes->post("get_travel_types", "AjaxController::get_travel_types");
    $routes->get("get_code", "CodeController::ajaxGet");
});

$routes->group("api", static function ($routes) {
    $routes->group("products", static function ($routes) {
        $routes->post("roomPhoto", "Api\ProductApi::roomPhoto");
        $routes->post("hotelPhoto", "Api\ProductApi::hotelPhoto");
    });
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
    $routes->get("login_find_id", "Member::LoginFindId");
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
    $routes->post("customer_center/customer_speak_ok", "Community::customer_speak_ok");

    $routes->get("announcement_view", "Community::announcement_view");
});
$routes->group("contact", static function ($routes) {
    $routes->get("main", "Contact::main");
});
$routes->group("cart", static function ($routes) {
    $routes->get("item-list/(:any)", "CartController::itemList/$1");
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
$routes->get('ticket/completed-order', 'Product::ticketCompleted');
$routes->get('ticket/ticket-booking/(:any)', 'Product::ticketBooking/$1');
$routes->get('ticket/ticket-detail/(:any)', 'Product::ticketDetail/$1');
$routes->get('show-ticket/(:any)', 'Product::showTicket/$1');
$routes->get('vehicle-guide/(:segment)', 'Product::vehicleGuide/$1');
$routes->get('product-hotel/list-hotel/(:any)', 'Product::listHotel/$1');
$routes->get('product-hotel/hotel-detail/(:any)', 'Product::hotelDetail/$1');
$routes->get('product-hotel/customer-form/(:any)', 'Product::index7/$1');
$routes->get('product-hotel/reservation-form', 'Product::reservationForm');
$routes->post('product-hotel/reservation-form-insert', 'Product::reservationFormInsert');
$routes->get('product-hotel/(:any)', 'Product::indexHotel/$1');
$routes->get('product-result/(:any)', 'Product::indexResult/$1');
$routes->get('product/completed-order', 'Product::completedOrder/$1');
$routes->get('product-golf/customer-form', 'Product::customerForm');
$routes->get('product-golf/list-golf/(:any)', 'Product::golfList/$1');
$routes->get('product-golf/golf-detail/(:any)', 'Product::golfDetail/$1');
$routes->get('product-golf/option-list/(:any)', 'Product::optionList/$1');
$routes->get('product-golf/(:any)/(:any)', 'Product::index2/$1/$2');
$routes->post('product-golf/customer-form-ok', 'Product::customerFormOk');
$routes->get('product-tours/item_view/(:any)', 'Product::index8/$1');
$routes->get('product-tours/location_info/(:any)', 'Product::tourLocationInfo/$1');
$routes->get('product-tours/order-form/(:any)', 'Product::tourOrderForm/$1');
$routes->get('product-tours/tours-list/(:any)', 'Product::index9/$1');
$routes->get('product-tours/(:any)', 'Product::indexTour/$1');
$routes->get('product-spa/product-booking/(:any)', 'Product::productBooking/$1');
$routes->get('product-spa/completed-order', 'Product::spaCompletedOrder');
$routes->get('product-spa/spa-details/(:any)', 'Product::spaDetail/$1');
$routes->get('product-spa/(:any)', 'Product::indexSpa/$1');
$routes->get('product_view/(:any)', 'Product::view/$1');
$routes->get('product-restaurant/completed-order', 'Product::restaurantCompleted');
$routes->get('product-restaurant/restaurant-booking/(:any)', 'Product::restaurantBooking/$1');
$routes->get('product-restaurant/restaurant-detail/(:any)', 'Product::restaurantDetail/$1');
$routes->get('product-restaurant/(:any)', 'Product::restaurantIndex/$1');
$routes->get('product/get-by-keyword', 'Product::getProductByKeyword');
$routes->get('product/get-by-top', 'Product::getProductByTop');
$routes->get('product/get-by-cheep', 'Product::getProductByCheep');
$routes->get('product/get-by-sub-code', 'Product::getProductBySubCode');
$routes->get('product/get-step2-by-code-no', 'Product::getStep2ByCodeNo');
$routes->get('product/get-by-sub-code-tour', 'Product::getProductBySubCodeTour');

$routes->post('product/sel_moption', 'Product::sel_moption', ['as' => "api.product.sel_moption"]);
$routes->post('product/sel_option', 'Product::sel_option', ['as' => "api.product.sel_option"]);
?>