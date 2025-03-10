<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php

    if ($_SESSION["member"]["mIdx"] == "") {
        alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }
?>


<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css"/>
<!--
<script src="/mypage/mypage.js" type="text/javascript"></script>
-->

<style>
    @media screen and (max-width  : 850px) {
        .now_tab_text {
        width: 100%;
        height: 9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 3.2534rem;
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
        flex-shrink: 0;
        ;
    }

    .mypage_container .gnb_menu_list>li .menu_level_1 {
        height: 7.3666rem;
        border-bottom: none;
        justify-content: center;
    }

    .gnb_menu_list>li .menu_level_2 {
        flex-direction: column !important;
        border-bottom: none !important;
        padding: 2.9999rem 0 !important;
        color: #656565 !important;
        gap: 2.9999rem !important;
        background-color: #fafafa !important;
        border-top: 0.1999rem solid #dbdbdb !important;
        align-items: center;
    }
    .mypage_container .gnb_menu_list>li .menu_level_1 .btn_togle {
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


    .mypage_container .content .point_table tbody {
        width   : 100%;
        display : block;
    }
    .mypage_container .content .point_table tbody tr .des {
        width: 100%;
        text-align: left !important;
        font-size: 2.9rem;
    }

    .mypage_container .content .point_table tbody tr .date_s {
        position: relative;
        min-width: 21rem;
        text-align: left;
    }
    .mypage_container .content .point_table tbody tr .date_s::after {
        content: "|";
        position: absolute;
        right  : 0;
        top    : 50%;
        transform: translateY(-50%);
        color : #dbdbdb;
    }
    }
</style>


<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
                echo view("/mypage/mypage_gnb_menu_inc", ["tab_4" => "on", "tab_4_2" => "on"]);
            ?>
            <div class="content">
                <div class="top_content">
                    <h1 class="benefit_ttl">나의 혜택</h1>
                    <div class="benefit_info_cover">
                        <div class="benefit_info flex__c">
                            <div class="point flex__c">
                                <div class="point_ico"><img src="/images/mypage/mypage_point_ico_w.png" alt="">
                                </div>
                                <div>
                                    <p class="ttl">사용 가능한 포인트</p>
                                    <p class="num"><?= number_format($mileage) ?> <span>P</span></p>
                                </div>
                            </div>
                            <div class="discount flex__c">
                                <div class="discount_ico">
                                    <img src="/images/mypage/mypage_discount_ico_w.png" alt="">
                                </div>
                                <div>
                                    <p class="ttl">사용 가능한 쿠폰</p>
                                    <p class="num"><?= $c_nTotalCount ?> <span>장</span></p>
                                </div>
                                <a class="discount_detail_ico" href="/mypage/discount.php"><img
                                            src="/images/mypage/mypage_discount_detail_ico_w.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <p class="note">* 마일리지 유효기간은 5년입니다.</p>
                </div>
                <div class="bot_content">
                    <div class="slide_tab flex">
                        <a class="slide_tab_btn" href="/mypage/point">포인트 사용내역</a>
                        <a class="slide_tab_btn active" href="/mypage/coupon">쿠폰 사용내역</a>
                        <div></div>
                    </div>
                    <div class="filter flex_b_c">
                        <div class="left flex__c">
                            <button rel="<?=date('Y-m-d')?>" class="m_filter active">전체</button>
                            <button rel="<?=date('Y-m-d', strtotime('-1 month'));?>" class="m_filter">최근 1개월</button>
                            <button rel="<?=date('Y-m-d', strtotime('-3 month'));?>" class="m_filter">3개월</button>
                            <button rel="<?=date('Y-m-d', strtotime('-6 month'));?>" class="m_filter">6개월</button>
                        </div>
                        <form name="search" id="search">
                            <input type="hidden" name="pg" id="pg" value="<?= $pg ?>">
                            <div class="right flex__c">
                                <div class="depart flex__c">
                                    <div class="departure_date">
                                        <div class="flex__c">
                                            <input type="text" name="s_date" id="s_date" value="<?=$s_date?>"
                                                   class="date_pic">
                                        </div>
                                    </div>
                                    <div>
                                        <span>~</span>
                                    </div>
                                    <div class="departure_date">
                                        <div class="flex__c">
                                            <input type="text" name="e_date" id="e_date" value="<?=$e_date?>"
                                                   class="date_pic">
                                        </div>
                                    </div>
                                </div>
                                <button class="check_btn" onclick="search_it()">조회</button>
                            </div>
                        </form>
                    </div>
                    <div class="board_list">
                        <table class="point_table">
                            <colgroup class="only_web">
                                <col width="15%">
                                <col width="*">
                                <col width="15%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>발행일</th>
                                <th>쿠폰명</th>
                                <th>사용일자</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                                $index = 0;

                                if ($nTotalCount == 0) {
                            ?>
                                <tr style="text-align: center; vertical-align: middle">
                                    <td colspan=6
                                        style="text-align:center;height:100px; display: flex; align-items: center;">검색된
                                        결과가 없습니다.
                                    </td>
                                </tr>
                            <?php
                                }

                                foreach ($coupon_list as $row) {
                                    $index++;
                            ?>
                                <tr>
                                    <td class="date_s"><?= date("Y.m.d", strtotime($row['regdate'])) ?></td>
                                    <td class="des" style="text-align: center;"><span><?= $row['coupon_name'] ?></span></td>
                                    <td class="date_e"><?= date("Y.m.d", strtotime($row['enddate'])) ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php echo ipageListing2($pg, $nFrom, $g_list_rows, $_SERVER['PHP_SELF'] . "?s_date=$s_date&e_date=$e_date&pg=") ?>
                    </div>
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
</div>
<script>
    const currentYear = (new Date()).getFullYear();
    const datePickerConfig = {
        closeText: '닫기',
        prevText: '이전달',
        nextText: '다음달',
        currentText: '오늘',
        monthNames: ['1월(JAN)', '2월(FEB)', '3월(MAR)', '4월(APR)', '5월(MAY)', '6월(JUN)',
            '7월(JUL)', '8월(AUG)', '9월(SEP)', '10월(OCT)', '11월(NOV)', '12월(DEC)'
        ],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월',
            '7월', '8월', '9월', '10월', '11월', '12월'
        ],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        weekHeader: 'Wk',
        dateFormat: 'yy-mm-dd',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        showButtonPanel: true,
        showOn: 'button',
        buttonImageOnly: true,
        buttonImage: '/images/ico/datepicker_ico.png',
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:" + currentYear,
        yearSuffix: ''
    }

    $(document).ready(function () {
        $('.date_pic').datepicker(datePickerConfig)
    });

    $(".m_filter").click(function() {
        $(this).addClass('active').siblings().removeClass('active');
        let date1 = $(this).attr("rel");
        let date2 = $.datepicker.formatDate('yy-mm-dd',new Date());

        $("#s_date").val(date1);
        $("#e_date").val(date2);
    });

    function search_it() {
        var frm = document.search;
        frm.submit();
    }

    // $('.m_filter').on('click', function () {
    //     $(this).addClass('active').siblings().removeClass('active')
    //     let value = $(this).text();

    //     console.log(value);

    //     $.ajax({
    //         url: "ajax.coupon_filter.php",
    //         type: "POST",
    //         data: {
    //             'time': value,
    //             url: '<?= $_SERVER['PHP_SELF'] ?>'
    //         },
    //         success: function (data) {
    //             $(".board_list").html(data);
    //         }
    //     });
    // });

    $('.show_popup').on('click', function () {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function () {
        $(".popup_wrap").hide();
    });
</script>
<?php $this->endSection(); ?>
