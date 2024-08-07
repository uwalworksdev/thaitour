<?php
helper(['gnb', 'setting']);
$uri = service('uri');
$currentPath = $uri->getPath();
$adminGnb = adminGnb();
$setting = homeSetInfo();
$createAt = session("create_at");
$sessionCreateDate = date('Y-m-d H:i:s', $createAt);
?>
<?php
$code = $_GET['code'];

//if ($_SESSION[member][id] != "admin") {
//if ($_SESSION[member][level] != "1") {
if ($_SESSION['member']['level'] > 2 || $_SESSION['member']['level'] == "") {
    header('Location:/AdmMaster/');
    exit();
}
// 권한 확인하여 링크 표시
function check_perm($r_code, $url, $title)
{
    if ($_SESSION['member']['id'] == "admin" || strrpos($_SESSION['member']['m_auth'], $r_code) !== false)
        $link = "<a href='$url'>$title</a>";
    //else
//	$link = "<a href='#!' style='color:#aaa;'>$title</a>";

    return $link;
}

// $auth_arr = [];

// foreach( $_Adm_grant_top_name as $keys1 => $vals1 ){
// 	foreach($_Adm_grant_code[$keys1] as $keys2 => $vals2 ){
// 		array_push($auth_arr, $vals2);
// 	}
// }


function check_auth($code)
{

    if ($_SESSION['member']['id'] == "admin" || $_SESSION['member']['level'] == 1) {
        return true;
    }

    $count = strlen($code);

    $m_auth_arr = explode("|", $_SESSION['member']['m_auth']);

    if ($count == 1) {
        foreach ($m_auth_arr as $auth) {
            if (strrpos($auth, $code) !== false) {
                return true;
            }
        }
    } else {
        if (in_array($code, $m_auth_arr) !== false) {
            return true;
        }
    }

    return false;
}

// 탑 메뉴
if ($top_menu == "") {
    // 게시판
    if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_bbs/") !== false) {
        // 환경설정
        if ($_SERVER['PHP_SELF'] == "/AdmMaster/_bbs/fair_opt" || $_SERVER['PHP_SELF'] == "/AdmMaster/_bbs/board_write" || $_SERVER['PHP_SELF'] == "/AdmMaster/_bbs/board_view" || $code == "hashtag" || $code == "main_event" || $code == "awards")
            $top_menu = "config";
        // 고객센터
        else if (in_array($r_code, array("qna", "qna_group", "suggest", "faq", "contact")))
            $top_menu = "bbs_1";
        // 커뮤니티
        else if (in_array($r_code, array("review", "knowhow", "gallery")))
            $top_menu = "bbs_2";
        else if (in_array($r_code, array("review", "knowhow", "gallery2")))
            $top_menu = "bbs_2";
        // 기타 게시판
        else if (in_array($r_code, array("free", "press", "fair")))
            $top_menu = "bbs_3";
        // 등록 관리
        else if (in_array($r_code, array("isec", "pickup")))
            $top_menu = "regi";
        else if (in_array($code, array("event")))
            $top_menu = "reserve";
    }
    // CMS2023-11-02
    else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_cms/") !== false) {
        // 기타 게시판
        if (in_array($r_code, array("exibition", "jarubook")))
            $top_menu = "bbs_3";
        else
            $top_menu = "config";
    } else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_inquiry/") !== false) {
        $top_menu = "reserve";
    } else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_qna/") !== false) {
        $top_menu = "reserve";
    } else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_review/") !== false) {
        $top_menu = "_review";
    }
    // 등록관리
    else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_regi/") !== false) {
        $top_menu = "regi";
    } else if (
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_code/") !== false || strpos($_SERVER['PHP_SELF'], "/AdmMaster/_tourStay/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_tourSights/") !== false || strpos($_SERVER['PHP_SELF'], "/AdmMaster/_tourCountry/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_tourGuide/") !== false
    ) {
        $top_menu = "regi";
    } else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_tourRegist/") !== false) {
        $top_menu = "regi";
    }
    // 여행예약관리
    else if (
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_tour/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_reservation/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_guide/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_operator/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_mileage/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_mileageTrans/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_pass/") !== false ||
        strpos($_SERVER['PHP_SELF'], "/AdmMaster/_qna/") !== false
    ) {
        $top_menu = "reserve";
    }
    // 기타상품관리
    else if (
        $_SERVER['PHP_SELF'] == "/AdmMaster/_tourShopping/list" ||
        $_SERVER['PHP_SELF'] == "/AdmMaster/_tourOption/list" ||
        $_SERVER['PHP_SELF'] == "/AdmMaster/_tourSuggestion/list" ||
        $_SERVER['PHP_SELF'] == "/AdmMaster/_tourSuggestionSub/list" ||
        $_SERVER['PHP_SELF'] == "/AdmMaster/_tourSub/list" ||
        $_SERVER['PHP_SELF'] == "/AdmMaster/_tourLevel/list"
    ) {
        $top_menu = "etc";
    }
    // 인트라넷
    else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_memberBoard") !== false || strpos($_SERVER['PHP_SELF'], "/AdmMaster/_schedule/") !== false || strpos($_SERVER['PHP_SELF'], "/AdmMaster/_memberBreak/") !== false) {
        $top_menu = "intra";
        // 회원관리
    } else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_member") !== false) {
        $top_menu = "member";
    }
    // 로그분석기
    else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_logAnalysis") !== false) {
        $top_menu = "analysis";
    }
    // 기존웹사이트
    else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_admold") !== false) {
        $top_menu = "admold";
    }
    // B2B등록
    else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_b2b") !== false) {
        $top_menu = "b2b";
    }
    // 상담관리
    else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_consult/") !== false) {
        $top_menu = "consult";
    }
    // 환경설정
    else if (
        $_SERVER['PHP_SELF'] == "/AdmMaster/_adminrator/adm_setting"
        || $_SERVER['PHP_SELF'] == "/AdmMaster/_adminrator/write"
        || $_SERVER['PHP_SELF'] == "/AdmMaster/_adminrator/store_config_admin"
        || $_SERVER['PHP_SELF'] == "/AdmMaster/_adminrator/setting"
        || strpos($_SERVER['PHP_SELF'], "/AdmMaster/_codeBanner/") !== false
        || strpos($_SERVER['PHP_SELF'], "/AdmMaster/_cateBanner/") !== false
        || $_SERVER['PHP_SELF'] == "/AdmMaster/_bbsBanner/list"
        || $_SERVER['PHP_SELF'] == "/AdmMaster/_adminrator/search_word"
        || $_SERVER['PHP_SELF'] == "/AdmMaster/_adminrator/block_ip_list"
    ) {
        $top_menu = "config";
    }
    // 통계
    else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_statistics/") !== false) {
        $top_menu = "summary";
    } else if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_contact/") !== false) {
        $top_menu = "reserve";
    }
    if ($code == "winner") {
        $top_menu = "bbs_1";
    }

    if ($code == "b2b_notice") {
        $top_menu = "bbs_1";
    }
}
?>
<!--[if lt IE 7]>      <html class="ie6"> <![endif]-->
<!--[if IE 7]>         <html class="ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<!DOCTYPE HTML><!--<![endif]-->
<html lang="ko">

<head>
    <title>
        <?= $setting['site_name'] ?>
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-title" content="">
    <link rel="shortcut icon" type="image/x-icon" href="/uploads/setting/<?= $setting['favico_img'] ?>">
    <link rel="apple-touch-icon" href="" />
    <meta name="Generator" content="">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <link rel="stylesheet" href="/css/admin/import.css" type="text/css" />
    <script type="text/javascript" src="/lib/jquery/jquery-1.8.3.min.js"></script>
    <!--[if lte IE 9]>
    <script src="/js/admin/html5.js"></script>
    <script src="/js/admin/respond.min.js"></script>
    <![endif]-->


    <link rel="stylesheet" href="/lib/jquery/jquery-ui.min.css">
    <script type="text/javascript" src="/lib/jquery/jquery.number.js"></script>
    <script src="/lib/jquery/jquery-ui.min.js"></script>
    <script src="/lib/notifIt/notifIt.js" type="text/javascript"></script>
    <link href="/lib/notifIt/notifIt.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="/lib/colorbox-master/example4/colorbox.css" />
    <script src="/lib/colorbox-master/jquery.colorbox.js"></script>



    <!--notice 스크립트끝-->
    <script src="/js/admin/common.js"></script>
    <script src="/lib/jquery/jquery.form.js"></script>
    <style type="text/css">
        .wrap-loading {
            /*화면 전체를 어둡게 합니다.*/
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            z-index: 999999999;
            background: rgba(0, 0, 0, 0.2);
            /*not in ie */
            filter: progid:DXImageTransform.Microsoft.Gradient(startColorstr='#20000000', endColorstr='#20000000');
            /* ie */
        }

        .wrap-loading div {
            /*로딩 이미지*/
            position: fixed;
            top: 50%;
            left: 50%;
            margin-left: -21px;
            margin-top: -21px;
        }

        .display-none {
            /*감추기*/
            display: none;
        }

        #input_file_ko {
            display: inline-block;
            width: 300px;
        }

        #input_file_ko button {
            margin-right: 5px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
    </style>

    <link rel="stylesheet" href="/css/admin/pop.css" type="text/css" />
    <script>
        //화면의 중앙으로 팝업창 띄우기
        function PopUp(url, wName, width, height) {//화면의 중앙
            var LeftPosition = (screen.width / 2) - (width / 2);
            var TopPosition = (screen.height / 2) - (height / 2);
            var win = window.open(url, wName, "left=" + LeftPosition + ",top=" + TopPosition + ",width=" + width + ",height=" + height);
            if (win == null) {
                alert("팝업차단을 해제해주세요!");
            } else {
                win.focus();
            }
        }

        //화면의 중앙으로 팝업창 띄우기..(스크롤포함)
        function PopUpWithScroll(url, wName, width, height) {//화면의 중앙
            var LeftPosition = (screen.width / 2) - (width / 2);
            var TopPosition = (screen.height / 2) - (height / 2);
            var win = window.open(url, wName, "left=" + LeftPosition + ",top=" + TopPosition + ",width=" + width + ",height=" + height + ",scrollbars=yes");
            if (win == null) {
                alert("팝업차단을 해제해주세요!");
            } else {
                win.focus();
            }
        }
    </script>


    <script language="JavaScript">
        var printpp

        function bp() {
            printpp = document.body.innerHTML;
            document.body.innerHTML = print_this.innerHTML;
        }

        function ap() {
            document.body.innerHTML = printpp;
        }

        function pp() {
            window.print();
        }

        window.onbeforeprint = bp;
        window.onafterprint = ap;
        //-->
    </script>

    <!-- 다음 우편번호 -->
    <?php if ($_IT_TOP_PROTOCOL == "https://") { ?>
        <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <?php } else { ?>
        <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <?php } ?>

</head>

<body>
<div id="ajax_loader" class="wrap-loading display-none">
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" stroke="#fff">
            <g fill="none" fill-rule="evenodd" stroke-width="2">
                <circle cx="22" cy="22" r="1">
                    <animate attributeName="r" begin="0s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1" keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite"/>
                    <animate attributeName="stroke-opacity" begin="0s" dur="1.8s" values="1; 0" calcMode="spline" keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite"/>
                </circle>
                <circle cx="22" cy="22" r="1">
                    <animate attributeName="r" begin="-0.9s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1" keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite"/>
                    <animate attributeName="stroke-opacity" begin="-0.9s" dur="1.8s" values="1; 0" calcMode="spline" keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite"/>
                </circle>
            </g>
        </svg>
    </div>
</div>

<div id="wrap">
    <header id="header">
        <div class="header_top">
            <div class="top_box">
                <!-- <a href="" class="logo"><img src="<?php //=_IT_LOGOS_ADM ?>" alt="로고"></a> -->
                <a href="/" class="txt_admin" target="_blank"></a>
                <a href="/AdmMaster/_main/main" class="logo"><img src="/uploads/setting/<?= $setting['logos'] ?>" alt=""></a>
            </div>
            <div class="info_box">
                <ul class="connect_info">
                    <li>
                        <?= $setting['site_name'] ?> /
                    </li>
                    <li>IP : 220.86.61.165 /</li>
                    <li>최근접속일시 : 2021-12-28 09:34:01 </li>
                </ul>

                <!-- <a href="/AdmMaster/_adminrator/store_config_admin">비밀번호변경</a> -->
                <a href="/AdmMaster/_adminrator/setting">정보수정</a>
                <a class="logout" href="/AdmMaster/logout">로그아웃</a>
            </div>

        </div>

        <div id="gnb" class="gnb_update">
            <ul class="gnb_menu">

                <li <?php if (!check_auth('B')) {
                    echo "style='display: none;'";
                } ?> class="menu11 depth1_ttl
                        <?php if ($top_menu == "_review")
                    echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "_review")
                        echo "on"; ?>"><span class="tit">여행후기
                                관리</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "_review")
                        echo "on"; ?>">
                        <li <?php if (!check_auth('B001')) {
                            echo "style='display: none;'";
                        } ?>
                                class="fir
                                <?= $top_menu == "_review" ? "on" : "" ?>">
                            <?= check_perm('B001', '/AdmMaster/_review/list', '여행후기관리'); ?>
                        </li>
                    </ul>
                </li>


                <li <?php if (!check_auth('C')) {
                    echo "style='display: none;'";
                } ?> class="menu4 depth1_ttl
                        <?php if ($top_menu == "regi")
                    echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "regi")
                        echo "on"; ?>"><span class="tit">상품등록
                                관리</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "regi")
                        echo "on"; ?>">
                        <li <?php if (!check_auth('C001')) {
                            echo "style='display: none;'";
                        } ?>
                                class="fir
                                <?= strpos('/AdmMaster/_code/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('C001', '/AdmMaster/_code/list', '공통코드'); ?>
                        </li>
                        <li <?php if (!check_auth('C002')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourRegist/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('C002', '/AdmMaster/_tourRegist/list', '패키지 상품관리'); ?>
                        </li>
                        <li <?php if (!check_auth('C003')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourRegist/list_honeymoon', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('C003', '/AdmMaster/_tourRegist/list_honeymoon', '허니문 상품관리'); ?>
                        </li>
                        <li <?php if (!check_auth('C004')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourRegist/list_tours', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('C004', '/AdmMaster/_tourRegist/list_tours', '자유여행 상품관리'); ?>
                        </li>
                        <li <?php if (!check_auth('C005')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourRegist/list_golf', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('C005', '/AdmMaster/_tourRegist/list_golf', '골프 상품관리'); ?>
                        </li>
                        <li <?php if (!check_auth('C006')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourStay/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('C006', '/AdmMaster/_tourStay/list', '숙박정보관리(공통)'); ?>
                        </li>
                    </ul>
                </li>

                <li <?php if (!check_auth('D')) {
                    echo "style='display: none;'";
                } ?>
                        class="menu5 depth1_ttl
                        <?php if ($top_menu == "etc")
                            echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "etc")
                        echo "on"; ?>"><span class="tit">기타상품
                                관리</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "etc")
                        echo "on"; ?>">

                        <li <?php if (!check_auth('D001')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourSuggestion/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('D001', '/AdmMaster/_tourSuggestion/list', '메인 추천상품 관리'); ?>
                        </li>
                        <li <?php if (!check_auth('D002')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourSuggestionSub/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('D002', '/AdmMaster/_tourSuggestionSub/list', '서브 추천상품 관리'); ?>
                        </li>
                        <!-- <li
                                <?php if (!check_auth('D005')) {
                            echo "style='display: none;'";
                        } ?>
                                class="<?= strpos('/AdmMaster/_tourSub/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                                <?= check_perm('D005', '/AdmMaster/_tourSub/list', '관심상품 관리'); ?></li> -->
                        <li <?php if (!check_auth('D003')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourLevel/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('D003', '/AdmMaster/_tourLevel/list', '상품등급 관리'); ?>
                        </li>
                        <li <?php if (!check_auth('D004')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_tourOption/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('D004', '/AdmMaster/_tourOption/list', '상품옵션 관리'); ?>
                        </li>
                    </ul>
                </li>
                <li <?php if (!check_auth('A')) {
                    echo "style='display: none;'";
                } ?> class="menu1 depth1_ttl
                        <?php if ($top_menu == "bbs_1" || $top_menu == "_inquiry" || $top_menu == "contact" || $top_menu == "_qna")
                    echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "bbs_1" || $top_menu == "_inquiry" || $top_menu == "contact" || $top_menu == "_qna")
                        echo "on"; ?>"><span class="tit">고객센터
                                관리</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "bbs_1" || $top_menu == "_inquiry" || $top_menu == "contact" || $top_menu == "_qna")
                        echo "on"; ?>">
                        <li <?php if (!check_auth('A001')) {
                            echo "style='display: none;'";
                        } ?> class="fir
                                <?= $code == "b2b_notice" ? "on" : "" ?>">
                            <?= check_perm('A001', '/AdmMaster/_bbs/board_list?code=b2b_notice', '공지사항'); ?>
                        </li>
                        <!-- <li <?php if (!check_auth('A002')) {
                            echo "style='display: none;'";
                        } ?> class="<?= $r_code == "qna_group" ? "on" : "" ?>"><?= check_perm('A002', '/AdmMaster/_bbs/index?r_code=qna_group', '기업/단체여행문의'); ?></li> -->
                        <li <?php if (!check_auth('A003')) {
                            echo "style='display: none;'";
                        } ?> class="
                                <?= $r_code == "faq" ? "on" : "" ?>">
                            <?= check_perm('A003', '/AdmMaster/_bbs/index?r_code=faq', '자주하시는질문'); ?>
                        </li>

                        <li <?php if (!check_auth('A008')) {
                            echo "style='display: none;'";
                        } ?> class="end
                                <?= $code == "winner" ? "on" : "" ?>">
                            <?= check_perm('A008', '/AdmMaster/_bbs/board_list?code=winner', '당첨자 발표'); ?>
                        </li>

                    </ul>
                </li>
                <li <?php if (!check_auth('E')) {
                    echo "style='display: none;'";
                } ?>
                        class="menu6 depth1_ttl
                        <?php if ($top_menu == "reserve")
                            echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "reserve")
                        echo "on"; ?>"><span      class="tit">상품예약</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "reserve")
                        echo "on"; ?>">
                        <li <?php if (!check_auth('E001')) {
                            echo "style='display: none;'";
                        } ?>
                                class="fir
                                <?= strpos($_SERVER["PHP_SELF"], '/AdmMaster/_reservation/') !== false ? "on" : "" ?>">
                            <?= check_perm('E001', '/AdmMaster/_reservation/list', '여행상품예약'); ?>
                        </li>
                        <li <?php if (!check_auth('A004')) {
                            echo "style='display: none;'";
                        } ?> class="
                                <?= strpos($_SERVER["PHP_SELF"], '/AdmMaster/_qna/') !== false ? "on" : "" ?>">
                            <?= check_perm('A004', '/AdmMaster/_qna/list', '1:1 여행상담'); ?>
                        </li>

                        <li <?php if (!check_auth('A005')) {
                            echo "style='display: none;'";
                        } ?> class="
                                <?= strpos($_SERVER["PHP_SELF"], '/AdmMaster/_contact/') !== false ? "on" : "" ?>">
                            <?= check_perm('A005', '/AdmMaster/_contact/list', '여행문의'); ?>
                        </li>
                        <li <?php if (!check_auth('A006')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos($_SERVER["PHP_SELF"], '/AdmMaster/_inquiry') !== false ? "on" : "" ?>">
                            <?= check_perm('A006', '/AdmMaster/_inquiry/list', '맞춤문의'); ?>
                        </li>
                        <li <?php if (!check_auth('A007')) {
                            echo "style='display: none;'";
                        } ?> class="
                                <?= $code == "event" ? "on" : "" ?>">
                            <?= check_perm('A007', '/AdmMaster/_bbs/board_list?code=event', '이벤트관리'); ?>
                        </li>
                        <!--li
                                <?php if (!check_auth('E005')) {
                            echo "style='display: none;'";
                        } ?>
                                class="<?= strpos($_SERVER["PHP_SELF"], '/AdmMaster/_guide/') !== false ? "on" : "" ?>">
                                <?= check_perm('E005', '/AdmMaster/_guide/list', '현지투어예약'); ?></li-->
                        <li <?php if (!check_auth('E002')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_operator/coupon_setting', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('E002', '/AdmMaster/_operator/coupon_setting', '쿠폰생성관리'); ?>
                        </li>
                        <li <?php if (!check_auth('E003')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_operator/coupon_list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('E003', '/AdmMaster/_operator/coupon_list', '쿠폰사용관리'); ?>
                        </li>
                        <li <?php if (!check_auth('E004')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_mileage/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('E004', '/AdmMaster/_mileage/list', '마일리지관리'); ?>
                        </li>

                    </ul>
                </li>
                <li <?php if (!check_auth('F')) {
                    echo "style='display: none;'";
                } ?>
                        class="menu11 depth1_ttl
                        <?php if ($top_menu == "member")
                            echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "member")
                        echo "on"; ?>"><span      class="tit">회원관리</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "member")
                        echo "on"; ?>">
                        <li <?php if (!check_auth('F001')) {
                            echo "style='display: none;'";
                        } ?>
                                class="fir
                                <?= $s_status == "Y" ? "on" : "" ?>">
                            <?= check_perm('F001', '/AdmMaster/_member/list?s_status=Y', '일반회원관리'); ?>
                        </li>
                        <li <?php if (!check_auth('F002')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= $s_status == "N" ? "on" : "" ?>">
                            <?= check_perm('F002', '/AdmMaster/_member/list?s_status=N', '탈퇴회원관리'); ?>
                        </li>
                        <li <?php if (!check_auth('F003')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?php if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_member/email01") !== false || strpos($_SERVER['PHP_SELF'], "/AdmMaster/_member/email01_view") !== false) { ?>on
                                <?php } ?>">
                            <?= check_perm('F003', '/AdmMaster/_member/email01', '이메일 관리'); ?></a>
                        </li>
                        <li <?php if (!check_auth('F004')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?php if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_member/sms01") !== false || strpos($_SERVER['PHP_SELF'], "/AdmMaster/_member/sms01_view") !== false) { ?>on
                                <?php } ?>">
                            <?= check_perm('F004', '/AdmMaster/_member/sms01', 'SMS 관리'); ?></a>
                        </li>
                        <!-- <li
                                <?php if (!check_auth('F005')) {
                            echo "style='display: none;'";
                        } ?>
                                class="<?php if (strpos($_SERVER['PHP_SELF'], "/AdmMaster/_member/user_report_list") !== false) { ?>on<?php } ?>">
                                <?= check_perm('F005', '/AdmMaster/_member/user_report_list', '신고 리스트'); ?></a>
                            </li> -->
                    </ul>
                </li>



                <li <?php if (!check_auth('G')) {
                    echo "style='display: none;'";
                } ?>
                        class="menu7 depth1_ttl
                        <?php if ($top_menu == "intra")
                            echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "intra")
                        echo "on"; ?>"><span      class="tit">인트라넷</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "intra")
                        echo "on"; ?>">
                        <li <?php if (!check_auth('G001')) {
                            echo "style='display: none;'";
                        } ?>
                                class="fir
                                <?= $code == "mem_board" ? "on" : "" ?>">
                            <?= check_perm('G001', '/AdmMaster/_memberBoard/board_list?code=mem_board', '사내게시판'); ?>
                        </li>
                        <li <?php if (!check_auth('G002')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= $code == "mem_pds" ? "on" : "" ?>">
                            <?= check_perm('G002', '/AdmMaster/_memberBoard/board_list?code=mem_pds', '자료실'); ?>
                        </li>
                        <li <?php if (!check_auth('G003')) {
                            echo "style='display: none;'";
                        } ?>
                                class="end
                                <?= strpos('/AdmMaster/_memberBreak/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('G003', '/AdmMaster/_memberBreak/list', '연차관리'); ?>
                        </li>
                    </ul>
                </li>

                <li <?php if (!check_auth('H')) {
                    echo "style='display: none;'";
                } ?>
                        class="menu7 depth1_ttl
                        <?php if ($top_menu == "config")
                            echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "config")
                        echo "on"; ?>"><span
                                class="tit">환경설정</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "config")
                        echo "on"; ?>">
                        <li <?php if (!check_auth('H001')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= $code == "awards" ? "on" : "" ?>">
                            <?= check_perm('H001', '/AdmMaster/_bbs/board_list?code=awards', '인증수상내역'); ?>
                        </li>
                        <!-- <li <?php if (!check_auth('H002')) {
                            echo "style='display: none;'";
                        } ?>
                                class="<?= $code == "banner" ? "on" : "" ?>"><?= check_perm('H002', '/AdmMaster/_bbs/board_list?code=banner', '메인비주얼관리'); ?></li> -->
                        <li <?php if (!check_auth('H002')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= $code == "banner" ? "on" : "" ?>">
                            <?= check_perm('H002', '/AdmMaster/_bbsBanner/list?code=banner', '메인/서브비주얼관리'); ?>
                        </li>
                        <li <?php if (!check_auth('H003')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= $code == "main_event" ? "on" : "" ?>">
                            <?= check_perm('H003', '/AdmMaster/_bbs/board_list?code=main_event', '메인이벤트 관리'); ?>
                        </li>
                        <li <?php if (!check_auth('H004')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= $code == "hashtag" ? "on" : "" ?>">
                            <?= check_perm('H004', '/AdmMaster/_bbs/board_list?code=hashtag', '키워드 링크'); ?>
                        </li>
                        <li <?php if (!check_auth('H005')) {
                            echo "style='display: none;'";
                        } ?>
                                class="fir
                                <?= strpos('/AdmMaster/_codeBanner/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('H005', '/AdmMaster/_codeBanner/list', '서브배너관리'); ?>
                        </li>

                        <li <?php if (!check_auth('H006')) {
                            echo "style='display: none;'";
                        } ?>
                                class="fir
                                <?= strpos('/AdmMaster/_cateBanner/list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('H006', '/AdmMaster/_cateBanner/list', '카테고리배너관리'); ?>
                        </li>

                        <li <?php if (!check_auth('H007')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= $r_code == "popup" ? "on" : "" ?>">
                            <?= check_perm('H007', '/AdmMaster/_cms/index?r_code=popup', '팝업관리'); ?>
                        </li>
                        <!-- <li <?php if (!check_auth('H004')) {
                            echo "style='display: none;'";
                        } ?>
                                class="<?= $r_code == "staff" ? "on" : "" ?>"><?= check_perm('H004', '/AdmMaster/_cms/index?r_code=staff', '운영자관리'); ?></li> -->
                        <li <?php if (!check_auth('H008')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= $r_code == "info" ? "on" : "" ?>">
                            <?= check_perm('H008', '/AdmMaster/_cms/policy_list?r_code=info', '약관및정책관리'); ?>
                        </li>
                        <li <?php if (!check_auth('H009')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_adminrator/setting', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('H009', '/AdmMaster/_adminrator/setting', '쇼핑몰설정관리'); ?>
                        </li>
                        <li <?php if (!check_auth('H010')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_adminrator/store_config_admin', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('H010', '/AdmMaster/_adminrator/store_config_admin', '운영자계정관리'); ?>
                        </li>
                        <li <?php if (!check_auth('H011')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_adminrator/search_word', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('H011', '/AdmMaster/_adminrator/search_word', '추천 검색어'); ?>
                        </li>

                        <li <?php if (!check_auth('H012')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?= strpos('/AdmMaster/_adminrator/block_ip_list', $_SERVER["PHP_SELF"]) !== false ? "on" : "" ?>">
                            <?= check_perm('H012', '/AdmMaster/_adminrator/block_ip_list', '아이피 차단'); ?>
                        </li>

                    </ul>
                </li>

                <li <?php if (!check_auth('I')) {
                    echo "style='display: none;'";
                } ?>
                        class="menu7 depth1_ttl
                        <?php if ($top_menu == "summary")
                            echo "on"; ?>">
                    <a href="#!" class="<?php if ($top_menu == "summary")
                        echo "on"; ?>"><span
                                class="tit">통계관리</span></a>
                    <ul class="smenu_1 depth2 <?php if ($top_menu == "summary")
                        echo "on"; ?>">
                        <li <?php if (!check_auth('I001')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?php if (strpos($_SERVER['PHP_SELF'], "statistics01_") !== false) { ?>on
                                <?php } ?>">
                            <?= check_perm('I001', '/AdmMaster/_statistics/statistics01_01', '예약분석'); ?>
                        </li>
                        <li <?php if (!check_auth('I002')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?php if (strpos($_SERVER['PHP_SELF'], "statistics02_") !== false) { ?>on
                                <?php } ?>">
                            <?= check_perm('I002', '/AdmMaster/_statistics/statistics02_01', '매출분석'); ?>
                        </li>
                        <li <?php if (!check_auth('I003')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?php if (strpos($_SERVER['PHP_SELF'], "statistics03_") !== false) { ?>on
                                <?php } ?>">
                            <?= check_perm('I003', '/AdmMaster/_statistics/statistics03_01', '방문분석'); ?>
                        </li>
                        <li <?php if (!check_auth('I004')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?php if (strpos($_SERVER['PHP_SELF'], "statistics04_") !== false) { ?>on
                                <?php } ?>">
                            <?= check_perm('I004', '/AdmMaster/_statistics/statistics04_01', '상품분석'); ?>
                        </li>
                        <li <?php if (!check_auth('I005')) {
                            echo "style='display: none;'";
                        } ?>
                                class="
                                <?php if (strpos($_SERVER['PHP_SELF'], "statistics05_") !== false) { ?>on
                                <?php } ?>">
                            <?= check_perm('I005', '/AdmMaster/_statistics/statistics05_01', '회원분석'); ?>
                        </li>
                    </ul>
                </li>

            </ul>
        </div><!-- // gnb -->

    </header>
    <!-- // header -->
    <script>
        $(document).ready(function () {
            $('.depth1_ttl > a').on('click', function () {
                $(this).next('.depth2').toggleClass('on');
                // $(this).next('.depth2').children('.depth2 li').toggleClass('on');
                $(this).toggleClass('on');

                if ($('.depth2').hasClass('on')) {
                    // $('.depth2 li') addClass('on');
                    $('.depth2').removeClass('on');
                    $('.depth1_ttl > a').removeClass('on');

                    $(this).next('.depth2').toggleClass('on');
                    $(this).toggleClass('on');
                } else { return; }
            });


        });

        // 좌측 메뉴

    </script>