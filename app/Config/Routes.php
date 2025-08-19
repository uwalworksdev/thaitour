<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->set404Override('App\Controllers\ErrorController::show404');

$routes->get('pdf', 'PdfTestController::generatePdf');

$routes->get('promotion', 'PromotionController::index');

$routes->group("AdmMaster", static function ($routes) {
    $routes->get("", "AdminLogin::loginView");
    $routes->post("login", "AdminLogin::LoginCheckAjax");
    $routes->get("logout", "AdminLogin::Logout");

    $routes->post("prod_update/(:segment)", "TourRegistController::prod_update/$1", ['as' => "admin._tour.prod_update"]);

    $routes->get("main", "StatisticsController::main");
    $routes->get("main_backup", "StatisticsController::main_backup");

    $routes->group("_theme", static function ($routes) {
        $routes->get("list", "ThemeController::list");
    });

    $routes->group("_review", static function ($routes) {
        $routes->get("list", "ReviewController::list_admin");
        $routes->get("write", "ReviewController::write_admin");
        $routes->post("change_ajax", "ReviewController::change_ajax");
        $routes->post("del", "ReviewController::del");
        $routes->post("ajax_del", "ReviewController::ajax_del");
        $routes->post("updateReportState", "ReviewController::updateReportState");
    });

    $routes->group("_member", static function ($routes) {
        $routes->get("list", "Member::list_member");
        $routes->get("list_grade", "Member::list_grade");
        $routes->post("del", "Member::del");
        $routes->post("member_out", "Member::member_out");
        $routes->get("email", "AutoMailController::index");
        $routes->get("sms", "SmsSettings::index");
        $routes->get("write", "Member::detail");
        $routes->get("write", "Member::detailGrade");
        $routes->get("sms_view", "SmsSettings::sms_view");
        $routes->post("sms_delete", "SmsSettings::sms_delete");
        $routes->post("sms_mod_ok", "SmsSettings::sms_mod_ok");
        $routes->post("sms_change", "SmsSettings::sms_change");

        $routes->post("email_delete", "AutoMailController::email_delete");
        $routes->post("email_change", "AutoMailController::email_change");
        $routes->get("email_view", "AutoMailController::email_view");
        $routes->post("email_mod_ok", "AutoMailController::email_mod_ok");
        $routes->get("pre_viw_mail", "Admin\AdminMemberController::pre_viw_mail");
        $routes->get("adminrator_id_chk_ajax", "Admin\AdminMemberController::adminrator_id_chk_ajax");
        $routes->get("member_order", "Member::memberOrder");
        $routes->get("member_coupon", "Member::memberCoupon");
        $routes->get("member_reserve", "Member::memberReserve");
        $routes->post("deleteReserve", "Member::deleteReserve");
        $routes->post("deleteCoupon", "Member::deleteCoupon");
        // $routes->post("del", "TourRegistController::del");
        // $routes->post("ajax_del", "TourRegistController::ajax_del");
    });
    $routes->group("_bbs", static function ($routes) {
        $routes->get("board_list", "BoardController::index");
        $routes->get("board_write/(:segment)", "BoardController::board_write/$1");
        $routes->get("board_write", "BoardController::board_write");
        $routes->get("goods_find", "BoardController::goods_find");
        $routes->get("item_allfind", "BoardController::item_allfind");
        $routes->post("write_ok/(:segment)", "BoardController::write_ok/$1");
        $routes->post("write_ok", "BoardController::write_ok");
        $routes->get("view", "BoardController::view");
        $routes->delete("bbs_del", "BoardController::bbs_del");
    });

    $routes->group("_reservation", static function ($routes) {
        $routes->get("list_payment", "Admin\ReservationController::list_payment");
        $routes->get("write_payment", "Admin\ReservationController::write_payment");
        $routes->get("list", "Admin\ReservationController::list");
        $routes->get("write/(:segment)", "Admin\ReservationController::write/$1");
        $routes->post("write_ok/(:segment)", "Admin\ReservationController::write_ok/$1");
        $routes->post("delete", "Admin\ReservationController::delete");
        $routes->get("get_code", "Admin\ReservationController::get_code");
        $routes->post("del_history", "Admin\ReservationController::del_history");
    });

    $routes->group("_settlement", static function ($routes) {
        $routes->get("list", "Admin\SettlementController::list");
        $routes->get("list_backup", "Admin\SettlementController::list_backup");
        $routes->get("write", "Admin\SettlementController::write/$1");
        $routes->post("write_ok/(:segment)", "Admin\SettlementController::write_ok/$1");
        $routes->post("delete", "Admin\SettlementController::delete");
        $routes->get("get_code", "Admin\SettlementController::get_code");
    });

    $routes->group("_reservationCar", static function ($routes) {
        $routes->get("list", "Admin\ReservationController::list_car");
        $routes->get("write", "Admin\ReservationController::write_car");
    });

    $routes->group("_product_qna", static function ($routes) {
        $routes->get("list", "Admin\AdminProductQnaController::list");
        $routes->get("write", "Admin\AdminProductQnaController::write");
        $routes->post("write_ok", "Admin\AdminProductQnaController::write_ok");
        $routes->post("delete", "Admin\AdminProductQnaController::delete");
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

    $routes->group("_alarm", static function ($routes) {
        $routes->get("list", "Admin\AlarmController::list");
        $routes->get("write", "Admin\AlarmController::write");
        $routes->post("write_ok", "Admin\AlarmController::write_ok");
        $routes->post("delete", "Admin\AlarmController::delete");
    });

    $routes->group("_code", static function ($routes) {
        $routes->get("list", "CodeController::list_admin");
        $routes->get("write", "CodeController::write_admin");
        $routes->post("write_ok", "CodeController::write_ok");
        $routes->post("del", "CodeController::del");
        $routes->post("add_contents", "CodeController::add_contents");
        $routes->post("del_contents", "CodeController::del_contents");
    });

    $routes->group("_cars_category", static function ($routes) {
        $routes->get("list", "Admin\AdminCarsCategoryController::list", ['as' => "admin._cars_category.list"]);
        $routes->get("write", "Admin\AdminCarsCategoryController::write", ['as' => "admin._cars_category.write"]);
        $routes->post("write_ok", "Admin\AdminCarsCategoryController::write_ok", ['as' => "admin._cars_category.write_ok"]);
        $routes->post("write_ok/(:segment)", "Admin\AdminCarsCategoryController::write_ok/$1", ['as' => "admin._cars_category.write_ok_id"]);
        $routes->post("delete", "Admin\AdminCarsCategoryController::delete", ['as' => "admin._cars_category.delete"]);
        $routes->post("change", "Admin\AdminCarsCategoryController::change", ['as' => "admin._cars_category.change"]);
        $routes->post("delete_category", "Admin\AdminCarsCategoryController::delete_category", ['as' => "admin._cars_category.delete_category"]);
        $routes->post("delete_cars_price", "Admin\AdminCarsCategoryController::delete_cars_price", ['as' => "admin._cars_category.delete_cars_price"]);
        $routes->post("delete_airline", "Admin\AdminCarsCategoryController::delete_airline", ['as' => "admin._cars_category.delete_airline"]);
        $routes->post("delete_flight", "Admin\AdminCarsCategoryController::delete_flight", ['as' => "admin._cars_category.delete_flight"]);
    });

    $routes->group("_tourRegist", static function ($routes) {
        $routes->get("list_hotel", "TourRegistController::list_hotel");
        $routes->get("(:segment)/list", "TourRegistController::list_spas/$1");
        $routes->get("list_all", "TourRegistController::list_all");
        $routes->get("list_honeymoon", "TourRegistController::list_honeymoon");
        $routes->get("list_tours", "TourRegistController::list_tours");
        $routes->get("list_golf", "TourRegistController::list_golfs");
        $routes->get("list_golf_price", "TourRegistController::list_golf_price");
        $routes->get("list_room_price", "TourRegistController::list_room_price");
        $routes->get("write", "TourRegistController::write");
        $routes->delete("del_product", "TourRegistController::delProduct");
        $routes->get("write_all", "TourRegistController::write_all");
        $routes->get("write_honeymoon", "TourRegistController::write_honeymoon");
        $routes->get("write_golf", "TourRegistController::write_golf");
        $routes->post("write_golf_ok", "TourRegistController::write_golf_ok");
        $routes->post("write_golf_ok/(:segment)", "TourRegistController::write_golf_ok/$1");
        $routes->get("write_golf_price", "TourRegistController::write_golf_price");
        $routes->post("write_golf_price_ok", "TourRegistController::write_golf_price_ok", ['as' => "admin._tourRegist.write_golf_price_ok"]);
        $routes->post("write_golf_allupdate", "TourRegistController::write_golf_allupdate", ['as' => "admin._tourRegist.write_golf_allupdate"]);
        $routes->post("write_golf/add_moption", "TourRegistController::add_moption");
        $routes->put("write_golf/upd_moption/(:segment)", "TourRegistController::upd_moption/$1");
        $routes->delete("write_golf/del_moption/(:segment)", "TourRegistController::del_moption/$1");
        $routes->get("(:segment)/write", "TourRegistController::write_spas/$1");
        $routes->get("(:segment)/write_info", "TourRegistController::write_spas_info/$1");
        $routes->get("(:segment)/write_price", "TourRegistController::write_spas_price/$1");
        $routes->get("(:segment)/list_price", "TourRegistController::list_spas_price/$1");
        $routes->get("write_tours", "TourRegistController::write_tours");
        $routes->get("write_tours_price", "TourRegistController::write_tours_price");
        $routes->get("write_tour_info", "TourRegistController::write_tour_info");
        $routes->get("list_tours_price", "TourRegistController::list_tours_price");
        $routes->post("write_tours/addMoption", "TourRegistController::addMoption");
        $routes->post("write_tours/updMoption", "TourRegistController::updMoption");
        $routes->post("write_tours/delMoption", "TourRegistController::delMoption");
        $routes->post("write_tours/addOption", "TourRegistController::addOption");
        $routes->post("write_tours/updOption", "TourRegistController::updOption");
        $routes->post("write_tours/delOption", "TourRegistController::delOption");
        $routes->get("_tourStay", "TourRegistController::list");
        $routes->post("prod_copy", "TourRegistController::copyProduct");
        $routes->group('golf_vehicles', function ($routes) {
		$routes->get('/', 'GolfVehicleController::list');
		$routes->get('write', 'GolfVehicleController::write');
		$routes->get('write/(:num)', 'GolfVehicleController::write/$1');
		$routes->post("write_ok", "GolfVehicleController::write_ok");
		$routes->post('del', 'GolfVehicleController::del');
		$routes->post("change", "GolfVehicleController::change_ajax");
        });
    });

    $routes->group("_product_place", static function ($routes) {
        $routes->get("list", "Admin\AdminProductPlaceController::list", ['as' => "admin._product_place.list"]);
        $routes->get("list-by-idx", "Admin\AdminProductPlaceController::listByIdx", ['as' => "admin._product_place.list.idx"]);
        $routes->get("detail", "Admin\AdminProductPlaceController::detail", ['as' => "admin._product_place.detail"]);
        $routes->post("write_ok", "Admin\AdminProductPlaceController::write", ['as' => "admin._product_place.write_ok"]);
        $routes->post("delete", "Admin\AdminProductPlaceController::delete", ['as' => "admin._product_place.delete"]);
    });

    $routes->group("_local_product", static function ($routes) {
        $routes->get("list", "Admin\AdminLocalProductController::list");
        $routes->get("write", "Admin\AdminLocalProductController::write");
        $routes->post("write_ok", "Admin\AdminLocalProductController::write_ok", ['as' => "admin._local_product.write_ok"]);
        $routes->post("write_ok/(:segment)", "Admin\AdminLocalProductController::write_ok/$1", ['as' => "admin._local_product.write_ok.id"]);
        $routes->post("del", "Admin\AdminLocalProductController::del", ['as' => "admin._local_product.del"]);
        $routes->post("del_image", "Admin\AdminLocalProductController::del_image", ['as' => "admin._local_product.del_image"]);
    });

    $routes->group("_local_guide", static function ($routes) {
        $routes->get("list", "Admin\AdminLocalGuideController::list");
        $routes->get("write", "Admin\AdminLocalGuideController::write");
        $routes->post("write_ok", "Admin\AdminLocalGuideController::write_ok", ['as' => "admin._local_guide.write_ok"]);
        $routes->post("write_ok/(:segment)", "Admin\AdminLocalGuideController::write_ok/$1", ['as' => "admin._local_guide.write_ok.id"]);
        $routes->post("del", "Admin\AdminLocalGuideController::del", ['as' => "admin._local_guide.del"]);
        $routes->post("del_image", "Admin\AdminLocalGuideController::del_image", ['as' => "admin._local_guide.del_image"]);
        $routes->post("del_all_image", "Admin\AdminLocalGuideController::del_all_image", ['as' => "admin._local_guide.del_all_image"]);
        $routes->post("change", "Admin\AdminLocalGuideController::change", ['as' => "admin._local_guide.change"]);
        $routes->get("get_category", "Admin\AdminLocalGuideController::get_category", ['as' => "admin._local_guide.get_category"]);
    });

    $routes->group("_hotel_theme", static function ($routes) {
        $routes->get("list", "Admin\AdminHotelThemeController::list");
        $routes->get("write_month", "Admin\AdminHotelThemeController::write_month");
        $routes->get("write_area", "Admin\AdminHotelThemeController::write_area");
        $routes->post("get_products", "Admin\AdminHotelThemeController::get_products");
        $routes->post("write_ok", "Admin\AdminHotelThemeController::write_ok", ['as' => "admin._hotel_theme.write_ok"]);
        $routes->post("write_ok/(:segment)", "Admin\AdminHotelThemeController::write_ok/$1", ['as' => "admin._hotel_theme.write_ok.id"]);
        $routes->post("del", "Admin\AdminHotelThemeController::del", ['as' => "admin._hotel_theme.del"]);
        $routes->post("change", "Admin\AdminHotelThemeController::change", ['as' => "admin._hotel_theme.change"]);
        $routes->post("del_area", "Admin\AdminHotelThemeController::del_area", ['as' => "admin._hotel_theme.del_area"]);
        $routes->post("del_product", "Admin\AdminHotelThemeController::del_product", ['as' => "admin._hotel_theme.del_product"]);
    });

    $routes->group("_promotion", static function ($routes) {
        $routes->get("list", "Admin\AdminPromotionController::list");
        $routes->get("write", "Admin\AdminPromotionController::write");
        $routes->post("write_ok", "Admin\AdminPromotionController::write_ok", ['as' => "admin._promotion.write_ok"]);
        $routes->post("write_ok/(:segment)", "Admin\AdminPromotionController::write_ok/$1", ['as' => "admin._promotion.write_ok.id"]);
        $routes->post("del", "Admin\AdminPromotionController::del", ['as' => "admin._promotion.del"]);
        $routes->post("del_image", "Admin\AdminPromotionController::del_image", ['as' => "admin._promotion.del_image"]);
        $routes->post("del_all_image", "Admin\AdminPromotionController::del_all_image", ['as' => "admin._promotion.del_all_image"]);
        $routes->post("change", "Admin\AdminPromotionController::change", ['as' => "admin._promotion.change"]);
        $routes->post("prod_update", "Admin\AdminPromotionController::prod_update", ['as' => "admin._promotion.prod_update"]);
    });

    $routes->group("_hotel", static function ($routes) {
        $routes->get("list", "Admin\AdminHotelController::list");
        $routes->get("write", "Admin\AdminHotelController::write");
        $routes->get("write_price", "Admin\AdminHotelController::write_price");
        $routes->post("update_room_order", "Admin\AdminHotelController::update_room_order");
        $routes->get("write_options", "Admin\AdminHotelController::write_options");
        $routes->get("get_room", "Admin\AdminHotelController::get_room", ['as' => "admin._hotel.get_room"]);
        $routes->post("write_ok", "Admin\AdminHotelController::write_ok", ['as' => "admin._hotel.write_ok"]);
        $routes->post("write_ok/(:segment)", "Admin\AdminHotelController::write_ok/$1", ['as' => "admin._hotel.write_ok.id"]);
        $routes->post("change", "Admin\AdminHotelController::change", ['as' => "admin._hotel.change"]);
        $routes->post("del", "Admin\AdminHotelController::del", ['as' => "admin._hotel.del"]);
        $routes->post("search_code", "Admin\AdminHotelController::search_code", ['as' => "admin._hotel.search_code"]);
        $routes->post("del_hotel_option", "Admin\AdminHotelController::del_hotel_option", ['as' => "admin._hotel.del_hotel_option"]);
        $routes->post("del_room_option", "Admin\AdminHotelController::del_room_option", ['as' => "admin._hotel.del_room_option"]);
        $routes->post("del_image", "Admin\AdminHotelController::del_image", ['as' => "admin._hotel.del_image"]);
        $routes->post("del_all_image", "Admin\AdminHotelController::del_all_image", ['as' => "admin._hotel.del_all_image"]);
    });

    $routes->group("_cars", static function ($routes) {
        $routes->get("list", "Admin\AdminCarsController::list");
        $routes->get("write", "Admin\AdminCarsController::write");
        $routes->post("write_ok", "Admin\AdminCarsController::write_ok", ['as' => "admin._cars.write_ok"]);
        $routes->post("write_ok/(:segment)", "Admin\AdminCarsController::write_ok/$1", ['as' => "admin._cars.write_ok.id"]);
        $routes->post("change", "Admin\AdminCarsController::change", ['as' => "admin._cars.change"]);
        $routes->post("delete", "Admin\AdminCarsController::delete", ['as' => "admin._cars.del"]);
        $routes->post("del_cars_option", "Admin\AdminCarsController::del_cars_option", ['as' => "admin._cars.del_cars_option"]);
        $routes->post("cars_sub_ok", "Admin\AdminCarsController::cars_sub_ok");
        $routes->post("cars_sub_del", "Admin\AdminCarsController::cars_sub_del");
    });

    $routes->group("_drivers", static function ($routes) {
        $routes->get("list", "Admin\AdminDriverController::list", ['as' => "admin._drivers.list"]);
        $routes->get("write", "Admin\AdminDriverController::write", ['as' => "admin._drivers.write"]);
        $routes->post("write_ok", "Admin\AdminDriverController::write_ok", ['as' => "admin._drivers.write_ok"]);
        $routes->post("change", "Admin\AdminDriverController::change", ['as' => "admin._drivers.change"]);
        $routes->post("delete", "Admin\AdminDriverController::delete", ['as' => "admin._drivers.delete"]);
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
        $routes->post("copy_last_tour", "Admin\AdminTourController::copy_last_tour", ['as' => "admin._tours.copy_last_tour"]);
        $routes->post("add_tour_product", "Admin\AdminTourController::add_tour_product", ['as' => "admin._tours.add_tour_product"]);
        $routes->post("add_tour_product_info", "Admin\AdminTourController::add_tour_product_info", ['as' => "admin._tours.add_tour_product_info"]);
        $routes->post("tours_price_add", "Admin\AdminTourController::tours_price_add", ['as' => "admin._tours.tours_price_add"]);
        $routes->post("tour_price_update", "Admin\AdminTourController::tour_price_update", ['as' => "admin._tours.tour_price_update"]);
        $routes->post("tours_all_update", "Admin\AdminTourController::tours_all_update", ['as' => "admin._tours.tours_all_update"]);
        $routes->post("update_all_price", "Admin\AdminTourController::update_all_price", ['as' => "admin._tours.update_all_price"]);
        $routes->post("del_tour_option", "Admin\AdminTourController::del_tour_option", ['as' => "admin._tours.del_tour_option"]);
        $routes->post("del_main_option", "Admin\AdminTourController::del_main_option", ['as' => "admin._tours.del_main_option"]);
        $routes->post("del_sub_option", "Admin\AdminTourController::del_sub_option", ['as' => "admin._tours.del_sub_option"]);
        $routes->post("del_tour_product", "Admin\AdminTourController::del_tour_product", ['as' => "admin._tours.del_tour_product"]);
    });

    $routes->group("_guides", static function ($routes) {
        $routes->get("list", "Admin\AdminGuideController::list", ['as' => "admin._guides.list"]);
        $routes->get("write", "Admin\AdminGuideController::write", ['as' => "admin._guides.write"]);
        $routes->post("write_ok", "Admin\AdminGuideController::write_ok", ['as' => "admin._guides.write_ok"]);
        $routes->post("delete", "Admin\AdminGuideController::delete", ['as' => "admin._guides.delete"]);
        $routes->post("change", "Admin\AdminGuideController::change", ['as' => "admin._guides.change"]);
    });

    $routes->group("_tour_guides", static function ($routes) {
        $routes->get("list", "Admin\AdminTourGuideController::list", ['as' => "admin._tour_guides.list"]);
        $routes->get("write", "Admin\AdminTourGuideController::write", ['as' => "admin._tour_guides.write"]);
        $routes->get("write_info", "Admin\AdminTourGuideController::write_info", ['as' => "admin._tour_guides.write_info"]);
        $routes->post("write_ok", "Admin\AdminTourGuideController::write_ok", ['as' => "admin._tour_guides.write_ok"]);
        $routes->post("delete", "Admin\AdminTourGuideController::delete", ['as' => "admin._tour_guides.delete"]);
        $routes->post("change", "Admin\AdminTourGuideController::change", ['as' => "admin._tour_guides.change"]);
        $routes->post("update", "Admin\AdminTourGuideController::update", ['as' => "admin._tour_guides.update"]);
    });

    $routes->group("_option_guides", static function ($routes) {
        $routes->get("list", "Admin\AdminGuideOptionController::list", ['as' => "admin._option_guides.list"]);
        $routes->get("detail", "Admin\AdminGuideOptionController::detail", ['as' => "admin._option_guides.detail"]);
        $routes->post("write", "Admin\AdminGuideOptionController::write", ['as' => "admin._option_guides.write"]);
        $routes->post("delete", "Admin\AdminGuideOptionController::delete", ['as' => "admin._option_guides.delete"]);
    });

    $routes->group("_sup_option_guides", static function ($routes) {
        $routes->post("delete", "Admin\AdminSupGuideOptionController::delete", ['as' => "admin._sup_option_guides.delete"]);
    });

    $routes->group("_productPrice", static function ($routes) {
        $routes->get("write_new", "Admin\AdminSpaController::write_new", ['as' => "admin._product.price.write_new"]);
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

        // Nested group for 'hotel_'
        $routes->group("hotel_", function ($routes) {
            $routes->post("write_price_ok", "Api\AdminProductApi::write_price_ok", ['as' => "admin.api.hotel_.write_price_ok"]);
            $routes->get("list_room", "Api\AdminProductApi::getListRoomHotel", ['as' => "admin.api.hotel_.list_room"]);
            $routes->get("list_room_by_idx", "Api\AdminProductApi::getListRoomHotelByIdx", ['as' => "admin.api.hotel_.list_room.by.idx"]);
            $routes->post("write_room_ok", "Api\AdminProductApi::write_room_ok", ['as' => "admin.api.hotel_.write_room_ok"]);
            $routes->get("detail_room", "Api\AdminProductApi::selectRoomById", ['as' => "admin.api.hotel_.detail_room"]);
            $routes->post("copy_room", "Api\AdminProductApi::copyRoom", ['as' => "admin.api.hotel_.copy_room"]);
            $routes->post("update_content", "Api\AdminProductApi::updateContent", ['as' => "admin.api.hotel_.update_content"]);
            $routes->post("delete_room", "Api\AdminProductApi::deleteRoomById", ['as' => "admin.api.hotel_.delete_room"]);
            $routes->post("delete_room_img", "Api\AdminProductApi::deleteRoomImgById", ['as' => "admin.api.hotel_.delete_room_img"]);
            $routes->post("delete_all_room_img", "Api\AdminProductApi::deleteAllRoomImg", ['as' => "admin.api.hotel_.delete_all_room_img"]);
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
            $routes->post("code_change", "Api\AdminCodeApi::code_change", ['as' => "admin.api.code.code_change"]);
            $routes->post("search_change", "Api\AdminCodeApi::search_change", ['as' => "admin.api.search.search_change"]);
            $routes->post("search_delete", "Api\AdminCodeApi::search_delete", ['as' => "admin.api.search.search_delete"]);
            $routes->post("search_insert", "Api\AdminCodeApi::search_insert", ['as' => "admin.api.search.search_insert"]);
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
            $routes->post("write_info_ok", "Admin\AdminSpaController::write_info_ok", ['as' => "admin.api.spa_.write_info_ok"]);
            $routes->post("spas_price_add", "Admin\AdminSpaController::spas_price_add", ['as' => "admin.api.spa_.spas_price_add"]);
            $routes->post("update_all_price", "Admin\AdminSpaController::update_all_price", ['as' => "admin.api.spa_.update_all_price"]);
            $routes->post("spa_price_update", "Admin\AdminSpaController::spa_price_update", ['as' => "admin.api.spa_.spa_price_update"]);
            $routes->post("spas_all_update", "Admin\AdminSpaController::spas_all_update", ['as' => "admin.api.spa_.spas_all_update"]);
            $routes->post("copy_last_spa", "Admin\AdminSpaController::copy_last_spa", ['as' => "admin.api.spa_.copy_last_spa"]);
            $routes->post("add_spa_product", "Admin\AdminSpaController::add_spa_product", ['as' => "admin.api.spa_.add_spa_product"]);
            $routes->post("add_spa_product_info", "Admin\AdminSpaController::add_spa_product_info", ['as' => "admin.api.spa_.add_spa_product_info"]);
            $routes->post("del_spas", "Admin\AdminSpaController::del_spas", ['as' => "admin.api.spa_.del_spas"]);
            $routes->post("del_spa_option", "Admin\AdminSpaController::del_spa_option", ['as' => "admin.api.spa_.del_spa_option"]);
            $routes->post("del_main_option", "Admin\AdminSpaController::del_main_option", ['as' => "admin.api.spa_.del_main_option"]);
            $routes->post("del_sub_option", "Admin\AdminSpaController::del_sub_option", ['as' => "admin.api.spa_.del_sub_option"]);
            $routes->post("del_spas", "Admin\AdminSpaController::del_spas", ['as' => "admin.api.spa_.del_spas"]);
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
            $routes->post("save_option_price", "Admin\AdminSpaController::save_option_price", ['as' => "admin.api.spa_.save_option_price"]);
            $routes->post("del_option_price", "Admin\AdminSpaController::del_option_price", ['as' => "admin.api.spa_.del_option_price"]);
            $routes->post("close_option_price", "Admin\AdminSpaController::close_option_price", ['as' => "admin.api.spa_.close_option_price"]);
            $routes->post("charge_dummy", "Admin\AdminSpaController::charge_dummy", ['as' => "admin.api.spa_.charge_dummy"]);
            $routes->post("charge_delete", "Admin\AdminSpaController::charge_delete", ['as' => "admin.api.spa_.charge_delete"]);
            $routes->post("charge_update", "Admin\AdminSpaController::charge_update", ['as' => "admin.api.spa_.charge_update"]);
            $routes->post("station_seq", "Admin\AdminSpaController::station_seq", ['as' => "admin.api.spa_.station_seq"]);
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

    // 2024-11-17 수정  
    //$routes->group("_tourSuggestion", static function ($routes) {
    //    $routes->get("list", "TourSuggestionSubController::list");
    //    $routes->get("write", "TourSuggestionController::write");
    //});

    $routes->group("_tourSuggestion", static function ($routes) {
        $routes->get("list", "TourSuggestionController::list");
        $routes->get("list_hotel", "TourSuggestionController::list_hotel");
        $routes->get("list_golf", "TourSuggestionController::list_golf");
        $routes->get("list_tour", "TourSuggestionController::list_tour");
        $routes->get("list_spa", "TourSuggestionController::list_spa");
        $routes->get("list_ticket", "TourSuggestionController::list_ticket");
        $routes->get("list_restaurant", "TourSuggestionController::list_restaurant");

        $routes->get("write", "TourSuggestionController::write");
        $routes->get("prd_list", "TourSuggestionController::prd_list");
        $routes->get("goods_find", "TourSuggestionController::goods_find");
        $routes->get("item_allfind", "TourSuggestionController::item_allfind");
        $routes->post("main_update", "TourSuggestionController::main_update");
        $routes->post("seq_upd1", "TourSuggestionController::seq_upd1");
        $routes->post("goods_alldel", "TourSuggestionController::goods_alldel");
        $routes->post("updateStatus", "TourSuggestionController::updateStatus");
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
        $routes->post("updateStatus", "TourSuggestionController::updateStatus");
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

    $routes->group("_coupon", static function ($routes) {
        $routes->get("list", "Admin\AdminCouponController::list", ['as' => "admin.coupon.list"]);
        $routes->get("write", "Admin\AdminCouponController::write", ['as' => "admin.coupon.write"]);
        $routes->post("write_ok", "Admin\AdminCouponController::write_ok", ['as' => "admin.coupon.write_ok"]);
        $routes->post("delete", "Admin\AdminCouponController::delete", ['as' => "admin.coupon.delete"]);
        $routes->post("del_image", "Admin\AdminCouponController::del_image", ['as' => "admin.coupon.del_image"]);
        $routes->post("del_all_image", "Admin\AdminCouponController::del_all_image", ['as' => "admin.coupon.del_all_image"]);
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
        $routes->post("write_ok", "Admin\AdminMileageController::write_ok");
        $routes->get("write_point", "Admin\AdminMileageController::write_point");
        $routes->post("write_point_ok", "Admin\AdminMileageController::write_point_ok");
        $routes->post("delete", "Admin\AdminMileageController::delete");
    });

    $routes->group("_memberBreak", static function ($routes) {
        $routes->get("list", "Admin\AdminMemberBreakController::list");
        $routes->get("write", "Admin\AdminMemberBreakController::write");
    });

    $routes->group("_cateBanner", static function ($routes) {
        $routes->get("list", "Admin\AdminCateBannerController::list");
        $routes->get("write", "Admin\AdminCateBannerController::write");
        $routes->post("write_ok/(:segment)", "Admin\AdminCateBannerController::write_ok/$1");
        $routes->post("write_ok", "Admin\AdminCateBannerController::write_ok");
        $routes->delete("file_del", "Admin\AdminCateBannerController::file_del");
    });

    $routes->group("_cms", static function ($routes) {
        $routes->get("index", "Admin\AdminCmsController::index");
        $routes->get("write", "Admin\AdminCmsController::write");
        $routes->post("write_ok/(:segment)", "Admin\AdminCmsController::write_ok/$1");
        $routes->post("write_ok", "Admin\AdminCmsController::write_ok");
        $routes->delete("del_ok", "Admin\AdminCmsController::del_ok");
        $routes->get("policy_list", "Admin\AdminCmsController::policy_list");
        $routes->get("policy_write", "Admin\AdminCmsController::policy_write");
        $routes->post("policy_ok", "Admin\AdminCmsController::policy_ok");
        $routes->post("policy_delete", "Admin\AdminCmsController::policy_delete");
        $routes->post("policy_change", "Admin\AdminCmsController::policy_change");
        $routes->get("policy_cancel_list", "Admin\AdminCmsController::policy_cancel_list");
        $routes->get("policy_cancel_write", "Admin\AdminCmsController::policy_cancel_write");
        $routes->post("policy_cancel_ok", "Admin\AdminCmsController::policy_cancel_ok");
        $routes->post("check_product_exists", "Admin\AdminCmsController::check_product_exists");
        $routes->post("delete", "Admin\AdminCmsController::del");
    });

    $routes->group("_statistics", static function ($routes) {
        $routes->get("statistics_sale_yoil",  "Admin\AdminStatisticsController::statistics_sale_yoil");
        $routes->get("statistics_sale_day",   "Admin\AdminStatisticsController::statistics_sale_day");
        $routes->get("statistics_sale_month", "Admin\AdminStatisticsController::statistics_sale_month");
        $routes->get("statistics_sale_year",  "Admin\AdminStatisticsController::statistics_sale_year");

        $routes->get("statistics_sale_sales", "Admin\AdminStatisticsController::statistics_sale_sales");

        $routes->get("statistics_sale_type", "Admin\AdminStatisticsController::statistics_sale_type");
        $routes->get("statistics_sale_type_day", "Admin\AdminStatisticsController::statistics_sale_type_day");
        $routes->get("statistics_sale_type_week", "Admin\AdminStatisticsController::statistics_sale_type_week");
        $routes->get("statistics_sale_type_month", "Admin\AdminStatisticsController::statistics_sale_type_month");
        $routes->get("statistics_sale_type_year", "Admin\AdminStatisticsController::statistics_sale_type_year");

        $routes->get("statistics_sale_type2", "Admin\AdminStatisticsController::statistics_sale_type2");

        $routes->get("statistics_sale_type3", "Admin\AdminStatisticsController::statistics_sale_type3");
        $routes->get("statistics_sale_type3_day", "Admin\AdminStatisticsController::statistics_sale_type3_day");
        $routes->get("statistics_sale_type3_week", "Admin\AdminStatisticsController::statistics_sale_type3_week");
        $routes->get("statistics_sale_type3_month", "Admin\AdminStatisticsController::statistics_sale_type3_month");
        $routes->get("statistics_sale_type3_year", "Admin\AdminStatisticsController::statistics_sale_type3_year");

        $routes->get("statistics_sale_list", "Admin\AdminStatisticsController::statistics_sale_list");

        $routes->get("member_statistics", "Admin\AdminStatisticsController::member_statistics");
        $routes->get("member_statistics_yoil", "Admin\AdminStatisticsController::member_statistics_yoil");
        $routes->get("member_statistics_day", "Admin\AdminStatisticsController::member_statistics_day");
        $routes->get("member_statistics_month", "Admin\AdminStatisticsController::member_statistics_month");
        $routes->get("member_statistics_year", "Admin\AdminStatisticsController::member_statistics_year");

        $routes->get("member_statistics", "Admin\AdminStatisticsController::member_statistics");

        $routes->get("member_statistics3", "Admin\AdminStatisticsController::member_statistics3");
        $routes->get("member_statistics3_day", "Admin\AdminStatisticsController::member_statistics3_day");
        $routes->get("member_statistics3_month", "Admin\AdminStatisticsController::member_statistics3_month");
        $routes->get("member_statistics3_year", "Admin\AdminStatisticsController::member_statistics3_year");

        $routes->get("member_statistics4", "Admin\AdminStatisticsController::member_statistics4");
        $routes->get("member_statistics4_day", "Admin\AdminStatisticsController::member_statistics4_day");
        $routes->get("member_statistics4_week", "Admin\AdminStatisticsController::member_statistics4_week");
        $routes->get("member_statistics4_month", "Admin\AdminStatisticsController::member_statistics4_month");
        $routes->get("member_statistics4_year", "Admin\AdminStatisticsController::member_statistics4_year");

        $routes->get("member_statistics5", "Admin\AdminStatisticsController::member_statistics5");

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
        $routes->post("password_update", "Setting::passwordUpdate");

        $routes->get("policy", "Policy::WriteView");

        $routes->get("store_config_admin", "Admin\AdminController::store_config_admin");
        $routes->get("write", "Admin\AdminController::write");
        $routes->post("password_change_user", "Admin\AdminController::passChangeUser");
        $routes->post("write_admin_ok", "Admin\AdminController::write_admin_ok");
        $routes->post("del", "Admin\AdminController::del");
        $routes->get("search_word", "Admin\AdminController::search_word");
        $routes->get("search_write", "Admin\AdminController::search_write");
        $routes->get("block_ip_list", "Admin\AdminController::block_ip_list");

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
    });

    // Nested group for '_magazine'
    $routes->group("_magazines", function ($routes) {
        $routes->get("list", "Admin\AdminMagazineController::list", ['as' => "admin._magazines.list"]);
        $routes->get("write", "Admin\AdminMagazineController::write", ['as' => "admin._magazines.write"]);
    });
});

$routes->group("ajax", static function ($routes) {
    $routes->post("uploader", "AjaxController::uploader");
    $routes->post("get_travel_types", "AjaxController::get_travel_types");
    $routes->post("get_golf_option", "AjaxController::get_golf_option");
    $routes->post("get_best", "AjaxMainController::get_best");
    $routes->post("set_seq", "AjaxMainController::set_seq");
    $routes->post("set_seq_hotel", "AjaxMainController::set_seq_hotel");
    $routes->post("set_search_txt", "AjaxMainController::set_search_txt");
    $routes->get("get_code", "CodeController::ajaxGet");
    $routes->get("get_sub_code", "CodeController::get_sub_code");
    $routes->get("get_list_product", "CodeController::get_list_product");
    $routes->post("fnAddIp_insert", "AjaxController::fnAddIp_insert");
    $routes->post("fnAddIp_delete", "AjaxController::fnAddIp_delete");
    $routes->post("fnAddIp_sel_delete", "AjaxController::fnAddIp_sel_delete");
    $routes->post("popup_update", "AjaxController::popup_update");
    $routes->post("room_price_update", "AjaxController::room_price_update");
    $routes->post("hotel_price_update", "AjaxController::hotel_price_update");
    $routes->post("hotel_price_delete", "AjaxController::hotel_price_delete");
    $routes->post("hotel_price_allupdate", "AjaxController::hotel_price_allupdate");
    $routes->post("hotel_room_allupdate", "AjaxController::hotel_room_allupdate");
    $routes->post("hotel_room_search", "AjaxController::hotel_room_search");
    $routes->post("hotel_price_add", "AjaxController::hotel_price_add");
    $routes->post("hotel_price_pageupdate", "AjaxController::hotel_price_pageupdate");
    $routes->post("hotel_allUpdRoom_price", "AjaxController::hotel_allUpdRoom_price");
	
    $routes->post("golf_price_add", "AjaxController::golf_price_add");
    $routes->post("golf_price_update", "AjaxController::golf_price_update");
    $routes->post("golf_price_delete", "AjaxController::golf_price_delete");
    $routes->post("golf_option_delete", "AjaxController::golf_option_delete");
    $routes->post("golf_price_allupdate", "AjaxController::golf_price_allupdate");
    $routes->post("golf_dow_charge", "AjaxController::golf_dow_charge");
    $routes->post("hotel_dow_charge", "AjaxController::hotel_dow_charge");
    $routes->post("golf_dow_update", "AjaxController::golf_dow_update");
    $routes->get("get_coupon_list", "CouponController::get_coupon_list");
    $routes->get("coupon_view", "CouponController::coupon_view");
    $routes->post("memberSession", "AjaxController::memberSession");
    $routes->post("check_product_code", "AjaxController::check_product_code");
    $routes->get("get_child_category", "CarsCategoryController::get_child_category");
    $routes->get("get_products_by_golf_code", "CarsCategoryController::getProductsByGolfCode");
    $routes->get("get_flight", "CarsCategoryController::get_flight");
    $routes->get("get_destination", "CarsCategoryController::get_destination");
    $routes->get("get_cars_product", "CarsCategoryController::get_cars_product");
    $routes->post("cart_payment", "AjaxController::cart_payment");
    $routes->post("get_cart_sum", "AjaxController::get_cart_sum");
    $routes->post("get_last_sum", "AjaxController::get_last_sum");
    $routes->post("payInfo_update", "AjaxController::payInfo_update");
    $routes->post("id_check", "AjaxController::id_check");
    $routes->post("order_inq", "AjaxController::order_inq");
    $routes->post("delete-carts", "AjaxController::deleteCart");
    $routes->get("get_child_code", "CodeController::get_child_code");
    $routes->post("ajax_status_upd", "AjaxController::ajax_status_upd");
    $routes->get("ajax_room_detail", "AjaxController::ajax_room_detail");
    $routes->post("ajax_room_delete", "AjaxController::ajax_room_delete");
    $routes->post("ajax_allimtalk_send", "AjaxController::ajax_allimtalk_send");
    $routes->post("ajax_allimtalk_send1", "AjaxController::ajax_allimtalk_send1");
    $routes->post("ajax_incoiceHotel_send", "AjaxController::ajax_incoiceHotel_send");
    $routes->post("ajax_voucherHotel_send", "AjaxController::ajax_voucherHotel_send");
    $routes->post("ajax_open_yoil", "AjaxController::ajax_open_yoil");
    $routes->post("ajax_close_yoil", "AjaxController::ajax_close_yoil");
	$routes->post("ajax_set_status", "AjaxController::ajax_set_status");
    $routes->post("ajax_bank_deposit", "AjaxController::ajax_bank_deposit");
	$routes->post("ajax_booking_delete", "AjaxController::ajax_booking_delete");
	$routes->post("ajax_room_add", "AjaxController::ajax_room_add");
	$routes->post("ajax_bed_rank", "AjaxController::ajax_bed_rank");
	$routes->post("ajax_bed_add", "AjaxController::ajax_bed_add");
	$routes->post("ajax_bed_delete", "AjaxController::ajax_bed_delete");
	$routes->post("ajax_bedPrice_insert", "AjaxController::ajax_bedPrice_insert");
	$routes->post("update_upd_yn", "AjaxController::update_upd_yn");
	$routes->post("all_price_update", "AjaxController::all_price_update");
	$routes->post("update_upd_y", "AjaxController::update_upd_y");
	$routes->post("ajax_check_end", "AjaxController::ajax_check_end");
	$routes->post("ajax_trip_change", "AjaxController::ajax_trip_change");
	$routes->post("ajax_getMinDate", "AjaxController::ajax_getMinDate");
	$routes->post("ajax_golfPrice_add", "AjaxController::ajax_golfPrice_add");
	$routes->post("ajax_golfHole_add", "AjaxController::ajax_golfHole_add");
	$routes->post("ajax_golfGroup_del", "AjaxController::ajax_golfGroup_del");
	$routes->post("ajax_golfGroup_copy", "AjaxController::ajax_golfGroup_copy");
	$routes->post("get_start_date", "AjaxController::get_start_date");
	$routes->post("ajax_golfDay_update", "AjaxController::ajax_golfDay_update");
	$routes->post("ajax_golfOpt_ranks", "AjaxController::ajax_golfOpt_ranks");
	$routes->post("ajax_golf_upd_y", "AjaxController::ajax_golf_upd_y");
	$routes->post("ajax_golf_end", "AjaxController::ajax_golf_end");
	$routes->post("ajax_golfPrice_all", "AjaxController::ajax_golfPrice_all");
	$routes->post("ajax_payment", "AjaxController::ajax_payment");
	$routes->post("ajax_mainDisp_ranks", "AjaxController::ajax_mainDisp_ranks");
	$routes->post("ajax_calc_set", "AjaxController::ajax_calc_set");
	$routes->post("ajax_price_update", "AjaxController::ajax_price_update");
	$routes->post("ajax_voucher_update", "AjaxController::ajax_voucher_update");
	$routes->post("ajax_group_movement", "AjaxController::ajax_group_movement");
	$routes->post("ajax_group_change", "AjaxController::ajax_group_change");
	$routes->post("ajax_group_estimate", "AjaxController::ajax_group_estimate");
	$routes->post("ajax_grade_update", "AjaxController::ajax_grade_update");
	$routes->post("ajax_estimate_mailsend", "AjaxController::ajax_estimate_mailsend");
	$routes->post("ajax_nicepay_cancelResult", "AjaxController::ajax_nicepay_cancelResult");
	$routes->post("ajax_order_del", "AjaxController::ajax_order_del");
	$routes->post("ajax_order_cancel", "AjaxController::ajax_order_cancel");
	$routes->post("ajax_order_delete", "AjaxController::ajax_order_delete");
	$routes->post("send_payment_sms", "AjaxController::send_payment_sms");
	
});

$routes->group("api", static function ($routes) {
    $routes->group("products", static function ($routes) {
        $routes->post("roomPhoto", "Api\ProductApi::roomPhoto");
        $routes->post("hotelPhoto", "Api\ProductApi::hotelPhoto");
        $routes->post("localGuidePhoto", "Api\ProductApi::localGuidePhoto");
        $routes->post("sel_coupon", "Product::sel_coupon", ['as' => "api.product.sel_coupon"]);
        $routes->get("get_search_products", "Product::get_search_products", ['as' => "api.product.get_search_products"]);
        $routes->get("get_hotel_rooms", "Product::get_hotel_rooms", ['as' => "api.product.get_hotel_rooms"]);
        $routes->get("get_tours_price", "Api\ProductApi::get_tours_price", ['as' => "api.product.get_tours_price"]);
        $routes->get("get_spas_price", "Api\ProductApi::get_spas_price", ['as' => "api.product.get_spas_price"]);
    });

    $routes->group("spa_", function ($routes) {
        $routes->get("get_spa_options", "SpaController::get_spa_options", ['as' => "api.spa_.get_spa_options"]);
        $routes->get("get_mOption", "SpaController::get_mOption", ['as' => "api.spa_.get_mOption"]);
        $routes->post("sel_moption", "SpaController::sel_moption", ['as' => "api.spa_.sel_moption"]);
        $routes->post("sel_option", "SpaController::sel_option", ['as' => "api.spa_.sel_option"]);
        $routes->get("charge_list", "SpaController::charge_list", ['as' => "api.spa_.charge_list"]);
        $routes->post("handleBooking", "SpaController::handleBooking", ['as' => "api.spa_.handleBooking"]);
    });

    $routes->group("hotel_", function ($routes) {
        $routes->get("get_data", "Api\ProductApi::getDataHotel", ['as' => "api.hotel_.get_data"]);
        $routes->get("get_option", "Api\ProductApi::getDataOption", ['as' => "api.hotel_.get_option"]);
        $routes->get("get_price", "Api\ProductApi::getPriceByDate", ['as' => "api.hotel_.get_price"]);
        $routes->get("get_code", "Api\ProductApi::getCode", ['as' => "api.hotel_.get_code"]);
    });

    $routes->group("alarm", function ($routes) {
        $routes->post("mark-read", "AlarmController::markRead");
        $routes->post("del-all", "AlarmController::delAll");
        $routes->post("del-select", "AlarmController::delSelect");
        $routes->post("del-readen", "AlarmController::delReaden");
        
    });

    

    $routes->group("golf_", function ($routes) {
        $routes->post("ajax_change_golf", "Api\ProductApi::ajax_change_golf", ['as' => "api.golf_.ajax_change_golf"]);
    });
});

$routes->get('image/(:segment)/(:segment)', 'ImageController::show/$1/$2');

$routes->get('/', 'Home::index');
$routes->post('/file_uploader', 'FileUpload::file_uploader');
$routes->group("tools", static function ($routes) {
    $routes->get('generate_captcha', 'Tools::generate_captcha');
    $routes->get('get_list_code_type_review', 'Tools::get_list_code_type_review', ['as' => "tools.get_list_code_type_review"]);
    $routes->post('get_travel_types', 'Tools::get_travel_types');
    $routes->post('get_review_code', 'Tools::get_review_code');

    $routes->post('get_list_product', 'Tools::get_list_product');
    $routes->post('get_list_product_review', 'Tools::get_list_product_review');

    $routes->post('wish_set', 'Tools::wish_set');
    $routes->post('del_wish', 'Tools::del_wish');
});
$routes->group("member", static function ($routes) {
    $routes->get("login", "Member::LoginForm");
    $routes->get("login_naver", "SocialLoginController::naverLogin");
    $routes->get("callback_login_naver", "SocialLoginController::naverCallback");
    $routes->post("login_check", "Member::LoginCheck");
    $routes->get("login_find_id", "Member::LoginFindId");
    $routes->get("login_find_pw", "Member::LoginFindPw");
    $routes->post('cert_id_send_sms', 'Member::cert_id_send_sms');
    $routes->post('cert_pw_send_sms', 'Member::cert_pw_send_sms');
    $routes->post('cert_id_send_email', 'Member::cert_id_send_email');
    $routes->post('cert_pw_send_email', 'Member::cert_pw_send_email');
    $routes->post('find_id_ok', 'Member::find_id_ok');
    $routes->post('find_pw_ok', 'Member::find_pw_ok');
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
    $routes->post("apple_login", "Member::apple_login");
    $routes->post("join_form_sns", "Member::join_form_sns");
    $routes->post("update/(:segment)", "Member::update_member/$1");
    $routes->get("admin_password_change", "Member::AdminPasswordChange");
    $routes->post("mem_detail", "Member::mem_detail");
    $routes->post("callback", "Member::callback");
});
$routes->group("mypage", static function ($routes) {
    $routes->get("details", "MyPage::details");
    $routes->get("booklist", "MyPage::booklist");
    $routes->get("reservation_list", "MyPage::reservationList");
    $routes->get("getPolicyContents/(:num)", "MyPage::getPolicyContents/$1");
    $routes->get("pop_estimate", "MyPage::pop_estimate");
    $routes->get("custom_travel", "MyPage::custom_travel");
    $routes->get("custom_travel_view", "MyPage::custom_travel_view");
    $routes->get("contact", "MyPage::contact");
    $routes->get("consultation", "MyPage::consultation");
    $routes->get("alarm", "MyPage::alarm");
    $routes->get("fav_list", "MyPage::fav_list");
    $routes->get("travel_review", "MyPage::travel_review");
    $routes->get("point", "MyPage::point");
    $routes->get("coupon", "MyPage::coupon");
    $routes->get("discount", "MyPage::discount");
    $routes->post("get_coupon_discount", "MyPage::get_coupon_discount");
    $routes->get("discount_owned", "MyPage::discount_owned");
    $routes->get("discount_download", "MyPage::discount_download");
    $routes->get("info_option", "MyPage::info_option");
    $routes->get("info_change", "MyPage::info_change");
    $routes->get("user_mange", "MyPage::user_mange");
    $routes->post("user_mange_ok", "MyPage::user_mange_ok");
    $routes->get("money", "MyPage::money");
    $routes->get("(:segment)/invoice_view_item", "MyPage::invoice_view_item/$1");
    $routes->get("(:segment)/order_view_item", "MyPage::order_view_item/$1");
    $routes->post("money_ok", "MyPage::money_ok");
    $routes->get("member_out", "MyPage::member_out");
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
    $routes->post("updateReportState", "Comment::updateReportState");
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
    $routes->get("view", "Contact::view");
    $routes->get("write", "Contact::write");
    $routes->get("write/(:segment)", "Contact::write/$1");
    $routes->post("write_ok", "Contact::write_ok");
    $routes->post("delete", "Contact::delete");
});
$routes->group("cart", static function ($routes) {
    $routes->get("item-list/(:any)", "CartController::itemList/$1");
});
$routes->group("checkout", static function ($routes) {
    $routes->post("show", "CheckoutController::show");
    $routes->post("payment", "CheckoutController::payment");
    $routes->post("confirm", "CheckoutController::confirm");
    $routes->post("confirmMypage", "CheckoutController::confirmMypage");
    $routes->post("reservation_request", "CheckoutController::reservation_request");
    $routes->get("bank", "CheckoutController::bank");
    $routes->get("confirm_order", "CheckoutController::confirm_order");
    $routes->post('deposit_result', 'CheckoutController::deposit_result');

});
$routes->group("qna", static function ($routes) {
    $routes->get("list", "Qna::list");
    $routes->get("view", "Qna::view");
    $routes->get("write", "Qna::write");
    $routes->post("write_ok", "Qna::write_ok");
    $routes->post("delete", "Qna::delete");
});

$routes->group("travel-insurance", static function ($routes) {
    $routes->get("/", "EventController::travelInsurance");
});
$routes->group("invoice", static function ($routes) {
    $routes->get("list", "Orders::list_invoice");
    $routes->get("view_paid", "Orders::invoice_view_paid");
    $routes->get("golf_01/(:any)", "InvoiceController::golf_01/$1");
    $routes->get("car_01/(:any)", "InvoiceController::car_01/$1");
    $routes->get("guide_01/(:any)", "InvoiceController::guide_01/$1");
    $routes->get("hotel", "InvoiceController::hotel");
    $routes->get("hotel_01/(:any)", "InvoiceController::hotel_01/$1");
    $routes->get("ticket_01/(:any)", "InvoiceController::ticket_01/$1");
    $routes->get("ticket_02/(:any)", "InvoiceController::ticket_02/$1");
    $routes->get("tour_01/(:any)", "InvoiceController::tour_01/$1");
    $routes->get("payment_golf", "InvoiceController::payment_golf");
    $routes->get("bank_info", "InvoiceController::bank_info");
    $routes->get("bank_info_account", "InvoiceController::bank_info_account");
});

$routes->group("voucher", static function ($routes) {
    $routes->get("hotel/(:num)", "VoucherController::hotel/$1"); 
    $routes->post("hotel/save", "VoucherController::hotel_save"); 
    $routes->get("tour/(:num)", "VoucherController::tour/$1");
    $routes->post("tour/save", "VoucherController::tour_save"); 
    $routes->get("show/(:num)", "VoucherController::show/$1");
    $routes->get("golf/(:num)", "VoucherController::golf/$1");
    $routes->post("golf/save", "VoucherController::golf_save"); 
    $routes->get("ticket/(:num)", "VoucherController::ticket/$1");
    $routes->post("ticket/save", "VoucherController::ticket_save"); 
    $routes->get("car/(:num)", "VoucherController::car/$1");
    $routes->post("car/save", "VoucherController::car_save");
    $routes->get("guide/(:num)", "VoucherController::guide/$1"); 
    $routes->post("guide/save", "VoucherController::guide_save");     
});
$routes->group("review", static function ($routes) {
    $routes->get("review_list", "ReviewController::list_review");
    $routes->get("review_detail", "ReviewController::detail_review");
    $routes->get("review_write", "ReviewController::write_review");
    $routes->post("review_write_ok", "ReviewController::save_review");
    $routes->post("review_delete", "ReviewController::review_delete");
    $routes->post("review_report", "ReviewController::review_report");

});
$routes->group("event", static function ($routes) {
    $routes->get("event_list", "EventController::event_list");
    $routes->get("winning_list", "EventController::winning_list");
    $routes->get("event_view", "EventController::event_view");
    $routes->get("promotion_list", "EventController::promotion_list");
});
$routes->group("center", static function ($routes) {
    $routes->get("insurance", "CustomerCenterController::insurance");
    $routes->get("tourterms", "CustomerCenterController::tourterms");
    $routes->get("terms", "CustomerCenterController::terms");
    $routes->get("safety_tip", "CustomerCenterController::safetyTip");
    $routes->get("privacy", "CustomerCenterController::privacy");
    $routes->get("reservation", "CustomerCenterController::reservation");
    $routes->get("map", "CustomerCenterController::map");
    $routes->get("about", "CustomerCenterController::about");
    $routes->get("point", "CustomerCenterController::point");
    $routes->get("mem_vip", "CustomerCenterController::mem_vip");
    $routes->get("payment_guide", "CustomerCenterController::payment_guide");
    $routes->get("reservation_procedure", "CustomerCenterController::reservation_procedure");
});
$routes->group("custom_travel", static function ($routes) {
    $routes->get("item_list", "CustomTravelController::item_list");
    $routes->get("item_write", "CustomTravelController::item_write");
    $routes->post("inquiry_ok", "CustomTravelController::inquiry_ok");
});

$routes->group("magazines", static function ($routes) {
    $routes->get("list", "MagazineController::list", ['as' => "api.magazines.list"]);
    $routes->get("detail", "MagazineController::detail", ['as' => "api.magazines.detail"]);
    $routes->get("comment", "MagazineController::listComment", ['as' => "api.magazines.list.comment"]);
    $routes->post("create-comment", "MagazineController::createComment", ['as' => "api.magazines.create.comment"]);
    $routes->post("update-comment", "MagazineController::updateComment", ['as' => "api.magazines.update.comment"]);
    $routes->post("delete-comment", "MagazineController::deleteComment", ['as' => "api.magazines.delete.comment"]);
});

$routes->group("time_sale", static function ($routes) {
    $routes->get("list", "TimeSaleController::list", ['as' => "api.time_sale.list"]);
    $routes->post("view", "TimeSaleController::view", ['as' => "api.time_sale.view"]);
    $routes->post("like", "TimeSaleController::like", ['as' => "api.time_sale.like"]);
});

$routes->group("coupon", static function ($routes) {
    $routes->get("list", "CouponController::list");
    $routes->post("add_coupon_member", "CouponController::add_coupon_member");
});

// $routes->group("/package", static function($routes){
//     $routes->get("", "Package::Main");
//     // $routes->get("(:segment)/view/(:segment)", "Promotion::View/$1/$2");

//     // $routes->get("dnload/(:segment)/(:segment)", "Filedown::brochureDownload/$1/$2");
// });

$routes->group("product_qna", static function ($routes) {
    $routes->post("insert", "ProductQnaController::insert");
});

$routes->get('product/(:any)/(:any)', 'Product::index/$1/$2');
$routes->get('product_search', 'Product::productSearch');
$routes->get('mice-page', 'Product::micePage');
$routes->get('ticket/completed-order', 'Product::ticketCompleted');
$routes->get('ticket/completed-cart', 'Product::ticketCarted');
$routes->get('ticket/ticket-booking', 'Product::ticketBooking');
$routes->get('ticket/ticket-detail/(:any)', 'Product::ticketDetail/$1');
// $routes->get('show-ticket/(:any)', 'Product::showTicket/$1');
$routes->get('show-ticket', 'Product::showTicket');
// $routes->get('vehicle-guide/(:segment)', 'Product::vehicleGuide/$1');
$routes->get('vehicle-guide', 'Product::vehicleGuide');
$routes->post('vehicle/confirm-info', 'Product::vehicleConfirm');
$routes->post('vehicle-guide/vehicle-order', 'Product::vehicleOrder/$1');
$routes->get('driver/get-reviews', 'Product::getDriverReviews', ['as' => "api.driver.getDriverReviews"]);
$routes->post('filter-vehicle', 'Product::filterVehicle');
$routes->post('filter-child-vehicle', 'Product::filterChildVehicle');
$routes->get('product-hotel/list-hotel', 'Product::listHotel');
$routes->get('product-hotel/hotel-detail/(:any)', 'Product::hotelDetail/$1');
$routes->get('product-hotel/customer-form/(:any)', 'Product::index7/$1');
$routes->get('product-hotel/reservation-form', 'Product::reservationForm');
$routes->post('product-hotel/reservation-form-insert', 'Product::reservationFormInsert');
$routes->post('product-hotel/custhotel-payment-ok', 'Product::custHotelPaymentOk');
$routes->get('product-hotel', 'Product::indexHotel');
$routes->get('product-result/(:any)', 'Product::indexResult/$1');
$routes->get('product/completed-order', 'Product::completedOrder/$1');
$routes->get('product/completed-cart', 'Product::completedCart/$1');
$routes->get('product-golf/customer-form', 'Product::customerForm');
$routes->get('product-golf/list-golf/(:any)', 'Product::golfList/$1');
$routes->get('product-golf/golf-detail/(:any)', 'Product::golfDetail/$1');
$routes->get('product-golf/option-list/(:any)', 'Product::optionList/$1');
$routes->get('product-golf/option-price/(:any)', 'Product::optionPrice/$1');
$routes->get('product-golf/completed-order', 'Product::golfCompletedOrder/$1');
$routes->get('product-golf/completed-cart', 'Product::golfCompletedCart/$1');
// $routes->get('product-golf/(:any)/(:any)', 'Product::index2/$1/$2');
$routes->get('product-golf', 'Product::index2');
$routes->post('product-golf/customer-form-ok', 'Product::customerFormOk');
$routes->post('product-golf/customer-payment-ok', 'Product::customerPaymentOk');
$routes->post("product/golf_direct_payment", "Product::golf_direct_payment");
$routes->get('product-tours/item_view/(:any)', 'Product::index8/$1');
$routes->get('product-tours/location_info/(:any)', 'Product::tourLocationInfo/$1');
$routes->get('product-tours/order-form/(:any)', 'Product::tourOrderForm/$1');
$routes->get('product-tours/customer-form', 'Product::tourCustomerForm');
$routes->post('product-tours/customer-form-ok', 'Product::tourFormOk');
$routes->post('product-tours/tours-payment-ok', 'Product::tourPaymentOk');
$routes->get('product-tours/completed-order', 'Product::tourCompletedOrder/$1');
$routes->get('product-tours/completed-cart', 'Product::tourCompletedCart/$1');
$routes->get('product-tours/tours-list/(:any)', 'Product::index9/$1');
$routes->get('product-tours/confirm-info', 'Product::confirmInfo');
// $routes->get('product-tours/(:any)', 'Product::indexTour/$1');
$routes->get('product-tours', 'Product::indexTour');
$routes->get('product-spa/product-booking', 'Product::productBooking');
$routes->get('product-spa/completed-order', 'Product::spaCompletedOrder');
$routes->get('product-spa/completed-cart', 'Product::spaCompletedCart');
$routes->post('product-spa/spa-payment-ok', 'SpaController::handlePayment');
$routes->get('product-spa/spa-details/(:any)', 'Product::spaDetail/$1');
// $routes->get('product-spa/(:any)', 'Product::indexSpa/$1');
$routes->get('product-spa', 'Product::indexSpa');
$routes->get('product_view/(:any)', 'Product::view/$1');
$routes->get('product-restaurant/completed-order', 'Product::restaurantCompleted');
$routes->get('product-restaurant/completed-cart', 'Product::restaurantCarted');
$routes->get('product-restaurant/restaurant-booking', 'Product::restaurantBooking');
$routes->get('product-restaurant/restaurant-detail/(:any)', 'Product::restaurantDetail/$1');
// $routes->get('product-restaurant/(:any)', 'Product::restaurantIndex/$1');
$routes->get('product-restaurant', 'Product::restaurantIndex');
$routes->get('product/get-by-keyword', 'Product::getProductByKeyword');
$routes->get('product/get-by-top', 'Product::getProductByTop');
$routes->get('product/get-by-cheep', 'Product::getProductByCheep');
$routes->get('product/get-by-sub-code', 'Product::getProductBySubCode');
$routes->get('product/get-step2-by-code-no', 'Product::getStep2ByCodeNo');
$routes->get('product/get-by-sub-code-tour', 'Product::getProductBySubCodeTour');
$routes->post('product/like', 'Product::like');

$routes->post('product/sel_moption', 'Product::sel_moption', ['as' => "api.product.sel_moption"]);
$routes->post('product/sel_option', 'Product::sel_option', ['as' => "api.product.sel_option"]);
$routes->post('product/processBooking', 'Product::processBooking', ['as' => "api.product.processBooking"]);

// $routes->get('tour-guide/(:any)', 'TourGuideController::index/$1');
$routes->get('tour-guide', 'TourGuideController::index');
$routes->get('guide_view', 'TourGuideController::guideView');
$routes->get('guide_booking', 'TourGuideController::guideBooking');
$routes->get('guide/complete-booking', 'TourGuideController::completeBooking');
$routes->get('guide/get-reviews', 'TourGuideController::getReviews', ['as' => "api.guide.getReviews"]);
$routes->post('product/guide_booking', 'TourGuideController::processBooking', ['as' => "api.guide.processBooking"]);
$routes->post('guide/hande-booking', 'TourGuideController::handeBooking', ['as' => "api.guide.handeBooking"]);
$routes->post('guide/cart-booking', 'TourGuideController::guideCartBooking', ['as' => "api.guide.cartBooking"]);

// Nicepay route
$routes->get('/payment/request', 'PaymentController::requestPayment');
$routes->get('/payment/complete', 'PaymentController::completePayment');
$routes->post('/payment/nicepay_result', 'PaymentController::nicepay_result');
$routes->post('nicepay_refund', 'PaymentController::nicepay_refund');
$routes->post('nicepay_partial_refund', 'PaymentController::nicepay_partial_refund');

$routes->get('fake-login', 'FakeLogin::index');  // 가상 로그인
$routes->get('fake-logout', 'FakeLogin::logout'); // 로그아웃

// Inicis route
$routes->get('inicis/request', 'InicisController::request');
$routes->get('inicis/close', 'InicisController::close');
$routes->post('inicis/result', 'InicisController::inicisResult');
$routes->post('inicis/result_m', 'InicisController::inicisResult_m');
$routes->post('inicis_refund', 'InicisController::inicisRefund');
$routes->post('inicis_partial_refund', 'InicisController::inicisPartialRefund');
$routes->get('travel_insurance', 'TravelController::index');

$routes->get('kcp/request', 'KcpController::requestPayment');
$routes->post('kcp/response', 'KcpController::handleResponse');

// Excel dowmload
$routes->get('excel/download', 'ExcelController::downloadExcel');
$routes->get('/excel/get_excel', 'ExcelController::get_excel');
$routes->get('/excel/get_excel_main', 'ExcelController::get_excel_main');

// Point
$routes->get('point-system', 'Point::index');
$routes->get("api/update_data", "Admin\AdminHotelController::updateData");

$routes->get('/naver/login', 'NaverLogin::login');
$routes->get('/naver/callback', 'NaverLogin::callback');     

$routes->get('/birthdaychecker', 'BirthdayChecker::index');

$routes->group("pdf", static function ($routes) {
    $routes->get('quotation', 'PdfController::generateQuotation');
    $routes->get('invoice_hotel', 'PdfController::invoiceHotel');    
    $routes->get('invoice_golf', 'PdfController::invoiceGolf');
    $routes->get('invoice_tour', 'PdfController::invoiceTour');
    $routes->get('invoice_ticket', 'PdfController::invoiceTicket');
    $routes->get('invoice_car', 'PdfController::invoiceCar');
    $routes->get('invoice_guide', 'PdfController::invoiceGuide');

    $routes->get('voucher_hotel', 'PdfController::voucherHotel');
    $routes->get('voucher_golf', 'PdfController::voucherGolf');
    $routes->get('voucher_tour', 'PdfController::voucherTour');
    $routes->get('voucher_ticket', 'PdfController::voucherTicket');
    $routes->get('voucher_car', 'PdfController::voucherCar');
    $routes->get('voucher_guide', 'PdfController::voucherGuide');    
});

$routes->group("travel-tips", static function ($routes) {
    $routes->get("/", 'Point::TravelTips'); 
    $routes->get("hot-place", 'Point::HotPlace'); 
    $routes->get("travel-info", 'Point::TravelInfo');
    $routes->get("travel-info/view", 'Point::TravelView'); 
    $routes->get("infographic", 'Point::Infographic'); 
    $routes->get("infographic/view", 'Point::InfographicView'); 
    $routes->get("theme_main", 'Point::ThemeMain'); 
    $routes->get("theme_view", 'Point::ThemeView'); 
    $routes->get("theme_travel", 'Point::ThemeTravel'); 
    $routes->get("locguide_theme_list", 'Point::locguideThemeList'); 
    $routes->get("view_detail", 'Point::viewDetail'); 

    
});

$routes->group("daily", static function ($routes) {
    $routes->get("service_end",        "DailyController::service_end");
    $routes->get("service_cancel",     "DailyController::service_cancel");
    $routes->get("golf_price",         "DailyController::golf_price");
    $routes->get("hotel_price",        "DailyController::hotel_price");
    $routes->get("auto_cancel_orders", "DailyController::auto_cancel_orders");
});

$routes->get('group-move-popup', 'ReservationController::groupMoveView');
$routes->get('test/ajax_temp', 'Test::ajax_temp');
$routes->post('pay/ready', 'PayController::pay_ready');

$routes->group('pay', static function ($routes) {
    $routes->get('/', 'PayController::pay');             // /pay?idx=123
    $routes->post('check', 'PayController::pay_check');  // /pay/check
    $routes->get('view', 'PayController::pay_view');     // /pay/view?idx=123
});

?>
