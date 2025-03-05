<?php
helper(['gnb', 'setting']);
$uri = service('uri');
$currentPath = $uri->getPath();
$adminGnb = adminGnb();
$setting = homeSetInfo();
$createAt = session("create_at");
$sessionCreateDate = date('Y-m-d H:i:s', $createAt);
$top_menu = isset($top_menu) ? $top_menu : "";
$r_code = isset($r_code) ? $r_code : '';
$s_status = isset($s_status) ? $s_status : '';

$menuAuth = new \App\Libraries\MenuAuth();

if (session()->has('member') && isset(session('member')['m_auth'])) {
    $userPermissions = session()->get('member')['m_auth'] ?? "";
    $menus = $menuAuth->getUserMenus($userPermissions);
}

?>
<?php
$code = isset($_GET['code']) ? $_GET['code'] : null;
?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <title>
        <?= $setting['site_name'] ?>
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="apple-mobile-web-app-title" content="">
    <link rel="shortcut icon" type="image/x-icon" href="/uploads/setting/<?= $setting['favico'] ?>">
    <link rel="apple-touch-icon" href=""/>
    <meta name="Generator" content="">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <link rel="stylesheet" href="/css/admin/import.css" type="text/css"/>
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

    <link rel="stylesheet" href="/lib/colorbox-master/example4/colorbox.css"/>
    <script src="/lib/colorbox-master/jquery.colorbox.js"></script>


    <!--notice 스크립트끝-->
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
        #debug-bar {
            z-index: 999999999 !important;
        }
        .show-view .debug-view-path {
            position: relative;
            z-index: 999999999 !important;
        }
    </style>

    <link rel="stylesheet" href="/css/admin/pop.css" type="text/css"/>
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
    <?php //if ($_IT_TOP_PROTOCOL == "https://") { ?>
    <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <?php //} else { ?>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <?php //} ?>

</head>

<body>
<div id="ajax_loader" class="wrap-loading display-none">
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" stroke="#fff">
            <g fill="none" fill-rule="evenodd" stroke-width="2">
                <circle cx="22" cy="22" r="1">
                    <animate attributeName="r" begin="0s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1"
                             keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite"/>
                    <animate attributeName="stroke-opacity" begin="0s" dur="1.8s" values="1; 0" calcMode="spline"
                             keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite"/>
                </circle>
                <circle cx="22" cy="22" r="1">
                    <animate attributeName="r" begin="-0.9s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1"
                             keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite"/>
                    <animate attributeName="stroke-opacity" begin="-0.9s" dur="1.8s" values="1; 0" calcMode="spline"
                             keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite"/>
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
                <a href="/AdmMaster/main" class="logo">
                    <!--                    <img src="/uploads/setting/--><?php //= $setting['logos'] ?><!--" alt="">-->
                    <img src="/images/sub/logo_w.png" alt="" style="height: 30px;">
                </a>
            </div>
            <div class="info_box">
                <ul class="connect_info">
                    <li>
                        <?= $setting['site_name'] ?> /
                    </li>
                    <li>IP : <?= $_SERVER['REMOTE_ADDR'] ?> /</li>
                    <li>최근접속일시 : <span id="time"></span></li>
                    <li>작업자 : <span id=""><?=session()->get('member')['id']?>[<?=session()->get('member')['name']?>]</span></li>
                </ul>

                <script>
                    var serverTime = new Date('<?=$sessionCreateDate?>');

                    var clientTimezoneOffset = new Date().getTimezoneOffset() * 60000;

                    var clientTime = new Date(serverTime.getTime() - clientTimezoneOffset);
                    var year = clientTime.getFullYear();
                    var month = String(clientTime.getMonth() + 1).padStart(2, '0');
                    var day = String(clientTime.getDate()).padStart(2, '0');
                    var hours = String(clientTime.getHours()).padStart(2, '0');
                    var minutes = String(clientTime.getMinutes()).padStart(2, '0');
                    var seconds = String(clientTime.getSeconds()).padStart(2, '0');
                    var formattedClientTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
                    $("#time").text(formattedClientTime);
                </script>

                <!-- <a href="/AdmMaster/_adminrator/store_config_admin">비밀번호변경</a> -->
                <a href="/AdmMaster/_adminrator/setting">정보수정</a>
                <a class="logout" href="/AdmMaster/logout">로그아웃</a>
            </div>

        </div>

        <div id="gnb" class="gnb_update">
            <ul class="gnb_menu">

            <?php
            $mi = 1;

            foreach ($menus as $menu):
                ?>
                <li class="menu<?= $mi ?> depth1_ttl">
                    <a href="#!"><span class="tit"><?= $menu['name'] ?></span></a>
                    <ul class="smenu_<?=$mi?> depth2 <?=$menu['active']?>">
                        <?php foreach ($menu['submenus'] as $submenu):
                            $submenu_url = site_url($submenu['url']);
                            ?>
                            <li class="fir <?= $submenu['active'] ?>">
                                <a href="<?= $submenu_url ?>"><?= $submenu['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php
                $mi++;
            endforeach;
            ?>
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
                } else {
                    return;
                }
            });


        });

        // 좌측 메뉴

    </script>