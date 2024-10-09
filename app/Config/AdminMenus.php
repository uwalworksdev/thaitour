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
                    'alias' => ['AdmMember::list', 'AdmMember::detail']
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
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '호텔 상품관리',
                    'code' => 'B2',
                    'url' => '/AdmMaster/_hotel/list',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '스파/쇼·입장권/레스토',
                    'code' => 'B3',
                    'url' => '/AdmMaster/_tourRegist/list_spas',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '투어 상품관리',
                    'code' => 'B4',
                    'url' => '/AdmMaster/_tourRegist/list_tours',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '골프 상품관리',
                    'code' => 'B5',
                    'url' => '/AdmMaster/_tourRegist/list_golf',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '숙박정보관리(공통)',
                    'code' => 'B6',
                    'url' => '/AdmMaster/_tourStay/list',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '룸관리',
                    'code' => 'B7',
                    'url' => '/AdmMaster/_room/list',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '픽업 차량',
                    'code' => 'B8',
                    'url' => '/AdmMaster/_tourRegist/golf_vehicles',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
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
                    'alias' => ['AdminCodeController::getCategoryList', 'AdminCodeController::getCategoryWrite']
                ],
                [
                    'name' => '서브 추천상품 관리',
                    'code' => 'C2',
                    'url' => '/AdmMaster/_tourSuggestionSub/list',
                    'alias' => ['AdminCodeController::getCategoryList', 'AdminCodeController::getCategoryWrite']
                ],
                [
                    'name' => '상품등급 관리',
                    'code' => 'C3',
                    'url' => '/AdmMaster/_tourLevel/list',
                    'alias' => ['AdminCodeController::getCategoryList', 'AdminCodeController::getCategoryWrite']
                ],
                [
                    'name' => '상품옵션 관리',
                    'code' => 'C4',
                    'url' => '/AdmMaster/_tourOption/list',
                    'alias' => ['AdminCodeController::getCategoryList', 'AdminCodeController::getCategoryWrite']
                ],
            ]
        ],
        [
            'name' => '고객센터 관리',
            'code' => 'D',
            'submenus' => [
                [
                    'name' => '공지사항',
                    'code' => 'D1',
                    'url' => '/AdmMaster/_bbs/board_list?code=b2b_notice',
                    'alias' => ['AdminOrderController::getPurchaseList']
                ],
                [
                    'name' => '자주하시는질문',
                    'code' => 'D2',
                    'url' => '/AdmMaster/_bbs/board_list_q?r_code=faq',
                    'alias' => ['AdminOrderController::getPurchaseList']
                ],
                [
                    'name' => '당첨자 발표',
                    'code' => 'D3',
                    'url' => '/AdmMaster/_bbs/board_list?code=winner',
                    'alias' => ['AdminOrderController::getPurchaseList']
                ],
            ]
        ],
        [
            'name' => '상품예약',
            'code' => 'E',
            'submenus' => [
                [
                    'name' => '여행상품예약',
                    'code' => 'E1',
                    'url' => '/AdmMaster/_reservation/list',
                    'alias' => ['AdminOperatorController::getRaceList']
                ],
                [
                    'name' => '1:1 여행상담',
                    'code' => 'E2',
                    'url' => '/AdmMaster/_qna/list',
                    'alias' => ['AdminOperatorController::getPredictionList']
                ],
                [
                    'name' => '고객의 소리',
                    'code' => 'E3',
                    'url' => '/AdmMaster/_contact/list',
                    'alias' => ['AdminOperatorController::getReturnList']
                ],
                [
                    'name' => '맞춤문의',
                    'code' => 'E4',
                    'url' => '/AdmMaster/_inquiry/list',
                    'alias' => ['AdminOperatorController::getUploadList']
                ],
                [
                    'name' => '이벤트관리',
                    'code' => 'E5',
                    'url' => '/AdmMaster/_bbs/board_list?code=event',
                    'alias' => ['AdminOperatorController::getUploadList']
                ],
                [
                    'name' => '쿠폰생성관리',
                    'code' => 'E6',
                    'url' => '/AdmMaster/_operator/coupon_setting',
                    'alias' => ['AdminOperatorController::getUploadList']
                ],
                [
                    'name' => '쿠폰사용관리',
                    'code' => 'E7',
                    'url' => '/AdmMaster/_operator/coupon_list',
                    'alias' => ['AdminOperatorController::getUploadList']
                ],
                [
                    'name' => '마일리지관리',
                    'code' => 'E8',
                    'url' => '/AdmMaster/_mileage/list',
                    'alias' => ['AdminOperatorController::getUploadList']
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
                    'url' => 'href="/AdmMaster/_member/list?s_status=Y',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '탈퇴회원관리',
                    'code' => 'F2',
                    'url' => 'href="/AdmMaster/_member/list?s_status=N',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => '이메일 관리',
                    'code' => 'F3',
                    'url' => 'href="/AdmMaster/_member/email',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
                [
                    'name' => 'SMS 관리',
                    'code' => 'F4',
                    'url' => 'href="/AdmMaster/_member/sms',
                    'alias' => ['AdminBbsController::boardList', 'AdminBbsController::boardWrite', 'AdminBbsController::boardView']
                ],
            ]
        ],
        [
            'name' => '인트라넷',
            'code' => 'G',
            'submenus' => [
                [
                    'name' => '사내게시판',
                    'code' => 'G1',
                    'url' => '/AdmMaster/_memberBoard/board_list?code=mem_board',
                    'alias' => ['AdministratorController::index']
                ],
                [
                    'name' => '자료실',
                    'code' => 'G2',
                    'url' => '/AdmMaster/_memberBoard/board_list?code=mem_pds',
                    'alias' => ['AdministratorController::storeEmp', 'AdministratorController::storeEmpWrite']
                ],
                [
                    'name' => '연차관리',
                    'code' => 'G3',
                    'url' => '/AdmMaster/_memberBreak/list',
                    'alias' => ['AdministratorController::admin_ip', 'AdministratorController::admin_ip_write']
                ],
            ]
        ],
        [
            'name' => '환경설정',
            'code' => 'H',
            'submenus' => [
                [
                    'name' => '인증수상내역',
                    'code' => 'H1',
                    'url' => '/AdmMaster/_bbs/board_list?code=awards',
                    'alias' => ['StatisticsController::statistics03_01', 'StatisticsController::statistics03_02', 'StatisticsController::statistics03_04', 'StatisticsController::statistics03_05']
                ],
                [
                    'name' => '메인/서브비주얼관리',
                    'code' => 'H2',
                    'url' => '/AdmMaster/_bbsBanner/list?code=banner',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '메인이벤트 관리',
                    'code' => 'H3',
                    'url' => '/AdmMaster/_bbs/board_list?code=main_event',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '키워드 링크',
                    'code' => 'H4',
                    'url' => '/AdmMaster/_bbs/board_list?code=hashtag',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '서브배너관리',
                    'code' => 'H5',
                    'url' => '/AdmMaster/_codeBanner/list',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '카테고리배너관리',
                    'code' => 'H6',
                    'url' => '/AdmMaster/_cateBanner/list',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '팝업관리',
                    'code' => 'H7',
                    'url' => '/AdmMaster/_cms/index?r_code=popup',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '약관및정책관리',
                    'code' => 'H8',
                    'url' => '/AdmMaster/_cms/policy_list?r_code=info',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '쇼핑몰설정관리',
                    'code' => 'H9',
                    'url' => '/AdmMaster/_adminrator/setting',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '운영자계정관리',
                    'code' => 'H10',
                    'url' => '/AdmMaster/_adminrator/store_config_admin',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '추천 검색어',
                    'code' => 'H11',
                    'url' => '/AdmMaster/_adminrator/search_word',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
                ],
                [
                    'name' => '아이피 차단',
                    'code' => 'H12',
                    'url' => '/AdmMaster/_adminrator/block_ip_list',
                    'alias' => ['StatisticsController::statistics05_01', 'StatisticsController::statistics05_02']
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
                    'alias' => ['AdminOperatorController::ticket_list', 'AdminOperatorController::ticket_write']
                ],
                [
                    'name' => '매출분석',
                    'code' => 'I2',
                    'url' => '/AdmMaster/_statistics/statistics02_01',
                    'alias' => ['AdminOperatorController::coupon_list', 'AdminOperatorController::coupon_write']
                ],
                [
                    'name' => '방문분석',
                    'code' => 'I3',
                    'url' => '/AdmMaster/_statistics/statistics03_01',
                    'alias' => ['AdminOperatorController::coupon_setting', 'AdminOperatorController::couponSettingWrite']
                ],
                [
                    'name' => '상품분석',
                    'code' => 'I4',
                    'url' => '/AdmMaster/_statistics/statistics04_01',
                    'alias' => ['AdminOperatorController::popup_list', 'AdminOperatorController::popup_write']
                ],
                [
                    'name' => '회원분석',
                    'code' => 'I5',
                    'url' => '/AdmMaster/_statistics/statistics05_01',
                    'alias' => ['AdminOperatorController::popup_list', 'AdminOperatorController::popup_write']
                ],
            ]
        ]
    ];
}
