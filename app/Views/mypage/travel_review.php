<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
$connect = db_connect();

if ($_SESSION["member"]["mIdx"] == "") {
    alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

$page = $_GET['pg'];

?>


<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css"/>
<!--
<script src="/mypage/mypage.js" type="text/javascript"></script>
-->

<style>
    @media screen and (max-width: 850px) {
        .now_tab_text {
            width: 100%;
            height: 7.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2.2534rem;
            font-weight: 700;
            background: var(--bs-point) url(/images/btn/arrow_down_m.png) no-repeat right 1.7316rem center / auto;
            background-size: 2.4001rem 1.6999rem;
        }

        .gnb_menu_list {
            display: block;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 1.3684rem 0;
            display: none;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            z-index: 10;
            margin-top: 0;
            padding: 0 2.9999rem 2.6rem;
        }

        .mypage_container .gnb_menu {
            position: relative;
            overflow-y: visible;
        }

        .mypage_container .mypage_wrap .gnb_menu {
            flex-basis: 0 !important;
            flex-shrink: 0;;
        }

        .mypage_container .gnb_menu_list > li .menu_level_1 {
            height: 7.3666rem;
            border-bottom: none;
            justify-content: center;
        }

        .gnb_menu_list > li .menu_level_2 {
            flex-direction: column !important;
            border-bottom: none !important;
            padding: 2.9999rem 0 !important;
            color: #656565 !important;
            gap: 2.9999rem !important;
            background-color: #fafafa !important;
            border-top: 0.1999rem solid #dbdbdb !important;
            align-items: center;
        }

        .mypage_container .gnb_menu_list > li .menu_level_1 .btn_togle {
            display: none;
        }

        .gnb_menu_list li {
            width: 100%;
            height: 100%;
            border: none;
            text-align: center;
            color: #000;
            font-size: 2.2534rem;
            font-weight: 400;
            background-color: transparent;
            border-bottom: 0.1999rem solid #dbdbdb !important;
        }

        .mypage_container .gnb_menu li .menu_level_1 a {
            font-size: 2.6rem;
            font-family: "Noto Sans KR";
            font-weight: 400;
            color: #252525;
        }

        li.skip.backward a {
            background-image: url(/images/btn/first_svg.svg);
            background-repeat: no-repeat;
            background-size: 3.15rem 3.15rem;
            font-size: 0;
        }

        .paging .page li.preview a {
            font-size: 0;
            background-image: url(/images/btn/prev_svg.svg);
            background-size: 3.15rem 3.15rem;
        }

        .paging .page li a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3.0769rem;
            height: 3.0769rem;
            line-height: 3.0769rem;
            font-weight: 500;
            border: 0.0769rem solid transparent;
            color: #666666;
            background-position: center center;
            background-repeat: no-repeat;
            border-radius: 50%;
            box-sizing: border-box;
            font-size: 4rem;
        }

        .paging .page li.next a {
            font-size: 0;
            background-image: url(/images/btn/prev_svg.svg);
            background-size: 3.15rem 3.15rem;
        }

        li.skip.forward a {
            background-image: url(/images/btn/last_svg.svg);
            background-size: 3.15rem 3.15rem;
            background-repeat: no-repeat;
            font-size: 0;
        }

        .paging ul.page {
            transform: scale(0.7);
            transform-origin: unset;
            width: unset;
            gap: 4rem;
        }
    }
</style>

<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_3" => "on"]);
            ?>
            <div class="content">
                <h1 class="ttl_table">여행후기</h1>
                <p class="count">전체 <span><?= $total_cnt ?></span>개</p>
                <table class="travel_review_table">
                    <colgroup>
                        <col width="10%">
                        <col width="10%">
                        <col width="*">
                        <col width="10%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>구분</th>
                        <th>제목</th>
                        <th>등록일</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $j = $totalCount;
                    $num = 0;
                    $index = 0;
                    foreach ($review_list as $frow) {
                        $index++;
                        $num++;
                        ?>
                        <tr>
                            <td class="no"><span><?= $num ?></span></td>
                            <td class="num">
                                <span style="text-wrap: nowrap">
                                    <?= $frow['travel_type'] == '1324' ? $frow['travel_type_name2'] : $frow['travel_type_name'] ?>
                                    (<?= $frow['number_stars'] ?> <img style="object-fit: cover" src="/img/ico/star_yellow_full.png" alt="">)
                                </span>
                            </td>
                            <td class="des">
                                <a href="/review/review_detail?idx=<?= $frow['idx'] ?>">
                                    <?= $frow['title'] ?>
                                </a>
                            </td>
                            <td class="date"><?= date("Y.m.d", strtotime($frow['r_date'])) ?></td>
                        </tr>

                        <?php $j--;
                    } ?>
                    <?php if ($index == 0) { ?>
                        <tr style="text-align: center; vertical-align: middle">
                            <td colspan="6" class="none_data">작성한 후기가 없습니다.</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="travel_review_bottom">
                    <?php echo ipageListing2($pg, $total_page, $g_list_rows, $_SERVER['PHP_SELF'] . "?scategory=$scategory&pg=") ?>
                    <a href="../review/review_write" class="sub_write">글쓰기</a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="popup_wrap agree_pop">
    <div class="popup">
        <div class="top">
            <button type="button" class="close">
                <img src="/assets/img/btn/ico_closed.png" alt="닫기 아이콘">
            </button>
        </div>
        <div class="content">
            <div class="padding">
                <h1 class="title">현금 영수증 발급안내 내용</h1>
                <p class="content_1">- 현금으로 여행상품 결제 시 출발 다음 날부터 30일 이내에 담당자에게 요청하
                    시면 즉시 발급해 드립니다.<br>
                    - 다녀오신 당해 년도의 여행에 한해서만 발행이 가능합니다.
                </p>
                <p class="content_2">※ 여행취소수수료는 조세특례제한법 126조 3의 ④에 의해 현금영수증은
                    재화와 용역을 공급받은 자에게 그 대금을 현금으로 받는 경우 현금영수증을
                    발급할 수 있고, 부가가치세 기본통칙 제4조 4-0-1 공급받을 자의 해약으로
                    인하여 공급할 자가 재화 또는 용역의 공급 없이 받는 위약금의경우 과세대상
                    이 되지 아니한다고 명시되어 있음에 따라 현금영수증을 발급 받을실 수
                    없습니다.
                </p>
            </div>
        </div>
    </div>
    <div class="bg"></div>
    <!-- </div> -->
</div>
<script>
    $('.show_popup').on('click', function () {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function () {
        $(".popup_wrap").hide();
    });
</script>
<?php $this->endSection(); ?>
