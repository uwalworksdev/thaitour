<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class AdminMenus extends BaseConfig
{
    public $menus = [
        [
            'name' => '여행후기 관리',
            'code' => 'A',
            'submenus' => [
                [
                    'name' => '여행후기관리',
                    'code' => 'A1',
                    'url' => '/AdmMaster/_review/list',
                    'alias' => ['ReviewController::list_admin', 'ReviewController::write_admin']
                ],
            ]
        ],
        [
            'name' => '상품등록 관리',
            'code' => 'B',
            'submenus' => [
                [
                    'name' => '공통코드',
                    'code' => 'B1',
                    'url' => '/AdmMaster/_code/list',
                    'alias' => ['CodeController::list_admin', 'CodeController::write_admin']
                ],
                [
                    'name' => '호텔 상품관리',
                    'code' => 'B2',
                    'url' => '/AdmMaster/_hotel/list',
                    'alias' => ['AdminHotelController::list', 'AdminHotelController::write', 'AdminHotelController::write_options',  'AdminHotelController::write_price']
                ],
                [
                    'name' => '골프 상품관리',
                    'code' => 'B5',
                    'url' => '/AdmMaster/_tourRegist/list_golf',
                    'alias' => ['TourRegistController::list_golfs', 'TourRegistController::write_golf']
                ],
                [
                    'name' => '투어 상품관리',
                    'code' => 'B4',
                    'url' => '/AdmMaster/_tourRegist/list_tours',
                    'alias' => ['TourRegistController::list_tours', 'TourRegistController::write_tours']
                ],
                [
                    'name' => '스파/쇼·입장권/레스토',
                    'code' => 'B3',
                    'url' => '/AdmMaster/_tourRegist/list_spas',
                    'alias' => ['TourRegistController::list_spas', 'TourRegistController::write_spas']
                ],
                [
                    'name' => '차량 상품관리',
                    'code' => 'B7',
                    'url' => '/AdmMaster/_cars_category/list',
                    'alias' => ['AdminCarsCategoryController::list', 'AdminCarsCategoryController::write']
                ],
//                [
//                    'name' => '가이드 소개',
//                    'code' => 'B12',
//                    'url' => '/AdmMaster/_guides/list',
//                    'alias' => ['AdminGuideController::list', 'AdminGuideController::write']
//                ],
                [
                    'name' => '가이드 상품',
                    'code' => 'B13',
                    'url' => '/AdmMaster/_tour_guides/list',
                    'alias' => ['AdminTourGuideController::list', 'AdminTourGuideController::write', 'AdminTourGuideController::write_info']
                ],
//                [
//                    'name' => '호텔정보관리(공통)',
//                    'code' => 'B6',
//                    'url' => '/AdmMaster/_tourStay/list',
//                    'alias' => ['TourStayController::list', 'TourStayController::write']
//                ],
                [
                    'name' => '차량 정보관리',
                    'code' => 'B8',
                    'url' => '/AdmMaster/_cars/list',
                    'alias' => ['AdminCarsController::list', 'AdminCarsController::write']
                ],
                [
                    'name' => '기사님 소개관리',
                    'code' => 'B14',
                    'url' => '/AdmMaster/_drivers/list',
                    'alias' => ['AdminDriverController::list', 'AdminDriverController::write']
                ],
//                [
//                    'name' => '룸관리',
//                    'code' => 'B9',
//                    'url' => '/AdmMaster/_room/list',
//                    'alias' => ['AdminRoomController::list', 'AdminRoomController::write']
//                ],
                [
                    'name' => '골프 픽업차량',
                    'code' => 'B10',
                    'url' => '/AdmMaster/_tourRegist/golf_vehicles',
                    'alias' => ['GolfVehicleController::list', 'GolfVehicleController::write']
                ],
                [
                    'name' => '쿠폰상품등록',
                    'code' => 'B11',
                    'url' => '/AdmMaster/_coupon/list',
                    'alias' => ['AdminCouponController::list', 'AdminCouponController::write']
                ],
            ]
        ],
        [
            'name' => '기타상품 관리',
            'code' => 'C',
            'submenus' => [
                [
                    'name' => '메인 추천상품 관리',
                    'code' => 'C1',
                    'url' => '/AdmMaster/_tourSuggestion/list',
                    'alias' => ['TourSuggestionController::list', 'TourSuggestionController::write']
                ],
                [
                    'name' => '서브 추천상품 관리',
                    'code' => 'C2',
                    'url' => '/AdmMaster/_tourSuggestionSub/list',
                    'alias' => ['TourSuggestionSubController::list', 'TourSuggestionSubController::write']
                ],
                [
                    'name' => '상품등급 관리',
                    'code' => 'C3',
                    'url' => '/AdmMaster/_tourLevel/list',
                    'alias' => ['TourLevelController::list', 'TourLevelController::write']
                ],
                // [
                //     'name' => '상품옵션 관리',
                //     'code' => 'C4',
                //     'url' => '/AdmMaster/_tourOption/list',
                //     'alias' => ['TourOptionController::list', 'TourOptionController::write']
                // ],
            ]
        ],
        [
            'name' => '게시판관리',
            'code' => 'D',
            'submenus' => [
                [
                    'name' => '공지사항',
                    'code' => 'D1',
                    'url' => '/AdmMaster/_bbs/board_list?code=b2b_notice',
                    'alias' => ['BoardController::index', 'BoardController::board_write']
                ],
                [
                    'name' => '자주하시는질문',
                    'code' => 'D2',
                    'url' => '/AdmMaster/_bbs/board_list?code=faq',
                    'alias' => ['BoardController::index', 'BoardController::board_write']
                ],
                [
                    'name' => '당첨자 발표',
                    'code' => 'D3',
                    'url' => '/AdmMaster/_bbs/board_list?code=winner',
                    'alias' => ['BoardController::index', 'BoardController::board_write']
                ],
                [
                    'name' => '이벤트관리',
                    'code' => 'D4',
                    'url' => '/AdmMaster/_bbs/board_list?code=event',
                    'alias' => ['BoardController::index', 'BoardController::board_write']
                ],
                [
                    'name' => '매거진 관리',
                    'code' => 'D5',
                    'url' => '/AdmMaster/_bbs/board_list?code=magazines',
                    'alias' => ['BoardController::index', 'BoardController::board_write']
                ],
                [
                    'name' => '타임세일 관리',
                    'code' => 'D6',
                    'url' => '/AdmMaster/_bbs/board_list?code=time_sale',
                    'alias' => ['BoardController::index', 'BoardController::board_write']
                ],
            ]
        ],
        [
            'name' => '상품예약',
            'code' => 'E',
            'submenus' => [
                [
                    'name' => '상품결제내역',
                    'code' => 'E6',
                    'url' => '/AdmMaster/_reservation/list_payment',
                    'alias' => ['ReservationController::list_payment', 'ReservationController::write']
                ],
                [
                    'name' => '여행상품예약',
                    'code' => 'E1',
                    'url' => '/AdmMaster/_reservation/list',
                    'alias' => ['ReservationController::list', 'ReservationController::write']
                ],
                // [
                //     'name' => '차량ㆍ가이드',
                //     'code' => 'E2',
                //     'url' => '/AdmMaster/_reservationCar/list',
                //     'alias' => ['ReservationController::list_car', 'ReservationController::write_car']
                // ],
                [
                    'name' => '상품 Q&A',
                    'code' => 'E2',
                    'url' => '/AdmMaster/_product_qna/list',
                    'alias' => ['AdminProductQnaController::list', 'AdminProductQnaController::write']
                ],
                [
                    'name' => '1:1 여행상담',
                    'code' => 'E3',
                    'url' => '/AdmMaster/_qna/list',
                    'alias' => ['QnaController::list', 'QnaController::write']
                ],
                [
                    'name' => '고객의 소리',
                    'code' => 'E4',
                    'url' => '/AdmMaster/_contact/list',
                    'alias' => ['ContactController::list', 'ContactController::write']
                ],
                [
                    'name' => '맞춤문의',
                    'code' => 'E5',
                    'url' => '/AdmMaster/_inquiry/list',
                    'alias' => ['AdminInquiryController::list', 'AdminInquiryController::write']
                ],
                // [
                //     'name' => '쿠폰생성관리',
                //     'code' => 'E7',
                //     'url' => '/AdmMaster/_operator/coupon_setting',
                //     'alias' => ['AdminOperatorController::coupon_setting', 'AdminOperatorController::coupon_setting_write']
                // ],
                [
                    'name' => '쿠폰사용관리',
                    'code' => 'E8',
                    'url' => '/AdmMaster/_operator/coupon_list',
                    'alias' => ['AdminOperatorController::coupon_list', 'AdminOperatorController::coupon_write']
                ],
                [
                    'name' => '마일리지관리',
                    'code' => 'E9',
                    'url' => '/AdmMaster/_mileage/list',
                    'alias' => ['AdminMileageController::list', 'AdminMileageController::write']
                ],

            ]
        ],
        [
            'name' => '회원관리',
            'code' => 'F',
            'submenus' => [
                [
                    'name' => '일반회원관리',
                    'code' => 'F1',
                    'url' => '/AdmMaster/_member/list?s_status=Y',
                    'alias' => ['Member::list_member', 'Member::detail']
                ],
                [
                    'name' => '탈퇴회원관리',
                    'code' => 'F2',
                    'url' => '/AdmMaster/_member/list?s_status=N',
                    'alias' => ['Member::list_member', 'Member::detail']
                ],
                [
                    'name' => '이메일 관리',
                    'code' => 'F3',
                    'url' => '/AdmMaster/_member/email',
                    'alias' => ['AutoMailController::index', 'AutoMailController::email_view']
                ],
                [
                    'name' => 'SMS 관리',
                    'code' => 'F4',
                    'url' => '/AdmMaster/_member/sms',
                    'alias' => ['SmsSettings::index', 'SmsSettings::sms_view']
                ],
            ]
        ],
        // [
        //     'name' => '인트라넷',
        //     'code' => 'G',
        //     'submenus' => [
        //         [
        //             'name' => '사내게시판',
        //             'code' => 'G1',
        //             'url' => '/AdmMaster/_bbs/board_list?code=mem_board',
        //             'alias' => ['BoardController::index', 'BoardController::board_write']
        //         ],
        //         [
        //             'name' => '자료실',
        //             'code' => 'G2',
        //             'url' => '/AdmMaster/_bbs/board_list?code=mem_pds',
        //             'alias' => ['BoardController::index', 'BoardController::board_write']
        //         ],
        //         [
        //             'name' => '연차관리',
        //             'code' => 'G3',
        //             'url' => '/AdmMaster/_memberBreak/list',
        //             'alias' => ['AdminMemberBreakController::list', 'AdminMemberBreakController::write']
        //         ],
        //     ]
        // ],
        [
            'name' => '환경설정',
            'code' => 'H',
            'submenus' => [
//                [
//                    'name' => '인증수상내역',
//                    'code' => 'H1',
//                    'url' => '/AdmMaster/_bbs/board_list?code=awards',
//                    'alias' => ['BoardController::index', 'BoardController::board_write']
//                ],
                [
                    'name' => '메인/서브비주얼관리',
                    'code' => 'H2',
                    'url' => '/AdmMaster/_bbs/board_list?code=banner',
                    'alias' => ['BoardController::index', 'BoardController::board_write']
                ],
                // [
                //     'name' => '메인이벤트 관리',
                //     'code' => 'H3',
                //     'url' => '/AdmMaster/_bbs/board_list?code=main_event',
                //     'alias' => ['BoardController::index', 'BoardController::board_write']
                // ],
                // [
                //     'name' => '키워드 링크',
                //     'code' => 'H4',
                //     'url' => '/AdmMaster/_bbs/board_list?code=hashtag',
                //     'alias' => ['BoardController::index', 'BoardController::board_write']
                // ],
                [
                    'name' => '카테고리배너관리',
                    'code' => 'H6',
                    'url' => '/AdmMaster/_cateBanner/list',
                    'alias' => ['AdminCateBannerController::list', 'AdminCateBannerController::write']
                ],
                [
                    'name' => '팝업관리',
                    'code' => 'H7',
                    'url' => '/AdmMaster/_cms/index?r_code=popup',
                    'alias' => ['AdminCmsController::index', 'AdminCmsController::write']
                ],
                [
                    'name' => '약관및정책관리',
                    'code' => 'H8',
                    'url' => '/AdmMaster/_cms/policy_list?r_code=info',
                    'alias' => ['AdminCmsController::policy_list', 'AdminCmsController::policy_write']
                ],
                [
                    'name' => '쇼핑몰설정관리',
                    'code' => 'H9',
                    'url' => '/AdmMaster/_adminrator/setting',
                    'alias' => ['Setting::writeView']
                ],
                [
                    'name' => '운영자계정관리',
                    'code' => 'H10',
                    'url' => '/AdmMaster/_adminrator/store_config_admin',
                    'alias' => ['AdminController::store_config_admin', 'AdminController::write']
                ],
                [
                    'name' => '추천 검색어',
                    'code' => 'H11',
                    'url' => '/AdmMaster/_adminrator/search_word',
                    'alias' => ['AdminController::search_word', 'AdminController::search_write']
                ],
                [
                    'name' => '아이피 차단',
                    'code' => 'H12',
                    'url' => '/AdmMaster/_adminrator/block_ip_list',
                    'alias' => ['AdminController::block_ip_list']
                ],
            ]
        ],
        [
            'name' => '통계관리',
            'code' => 'I',
            'submenus' => [
                [
                    'name' => '예약분석',
                    'code' => 'I1',
                    'url' => '/AdmMaster/_statistics/statistics01_01',
                    'alias' => ['AdminStatisticsController::statistics01_01']
                ],
                [
                    'name' => '매출분석',
                    'code' => 'I2',
                    'url' => '/AdmMaster/_statistics/statistics02_01',
                    'alias' => ['AdminStatisticsController::statistics02_01']
                ],
                [
                    'name' => '방문분석',
                    'code' => 'I3',
                    'url' => '/AdmMaster/_statistics/statistics03_01',
                    'alias' => ['AdminStatisticsController::statistics03_01']
                ],
                [
                    'name' => '상품분석',
                    'code' => 'I4',
                    'url' => '/AdmMaster/_statistics/statistics04_01',
                    'alias' => ['AdminStatisticsController::statistics04_01']
                ],
                [
                    'name' => '회원분석',
                    'code' => 'I5',
                    'url' => '/AdmMaster/_statistics/statistics05_01',
                    'alias' => ['AdminStatisticsController::statistics05_01']
                ],
            ]
        ]
    ];
}
