<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
    $connect = db_connect();

    if ($_SESSION["member"]["mIdx"] == "") {
        alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }

    $coupon_sql = " select c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate, c.status, c.types, s.coupon_name, s.dc_type, s.coupon_pe, s.coupon_price
                        from tbl_coupon c
                        left outer join tbl_coupon_setting s
                        on c.coupon_type = s.idx
                        left outer join tbl_coupon_history h
                        on c.c_idx = h.used_coupon_idx
                        where 1=1 and c.status != 'C' and c.enddate > curdate() and c.usedate = '' and c.get_issued_yn = 'Y' and h.used_coupon_idx is null and c.user_id = '{$_SESSION["member"]["id"]}' 
                        group by c.c_idx ";
    $c_nTotalCount = $connect->query($coupon_sql)->getNumRows();


    $total_sql    = " select * from tbl_member where m_idx = '" . $_SESSION["member"]["mIdx"] . "' ";
    $row        = $connect->query($total_sql)->getRowArray();
    $mileage    = number_format($row["mileage"]);

    $s_date                = updateSQ($_GET["s_date"]);
    $e_date                = updateSQ($_GET["e_date"]);


    $pg = $_GET['pg'];

    $search_val = "";

    if (isset($s_date) && isset($e_date)) {
        $search_val = "AND DATE_FORMAT(ch_r_date, '%Y-%m-%d') >= '$s_date' AND DATE_FORMAT(ch_r_date, '%Y-%m-%d') <= '$e_date'";
    }
?>


<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<!--
<script src="/mypage/mypage.js" type="text/javascript"></script>
-->

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
                                <div class="point_ico"><img src="../assets/img/mypage/mypage_point_ico_w.png" alt="">
                                </div>
                                <div>
                                    <p class="ttl">사용 가능한 포인트</p>
                                    <p class="num"><?= $mileage ?> <span>P</span></p>
                                </div>
                            </div>
                            <div class="discount flex__c">
                                <div class="discount_ico"><img src="../assets/img/mypage/mypage_discount_ico_w.png" alt="">
                                </div>
                                <div>
                                    <p class="ttl">사용 가능한 쿠폰</p>
                                    <p class="num"><?= $c_nTotalCount ?> <span>장</span></p>
                                </div>
                                <a class="discount_detail_ico" href="/mypage/discount.php"><img src="../assets/img/mypage/mypage_discount_detail_ico_w.png" alt=""></a>
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
                            <button class="m_filter active">전체</button>
                            <button class="m_filter">최근 1개월</button>
                            <button class="m_filter">3개월</button>
                            <button class="m_filter">6개월</button>
                        </div>
                        <form name="search" id="search">
                            <input type="hidden" name="pg" id="pg" value="<?= $pg ?>">
                            <div class="right flex__c">
                                <div class="depart flex__c">
                                    <div class="departure_date">
                                        <div class="flex__c">
                                            <input type="text" name="s_date" id="departure_date1" placeholder="" class="date_pic">
                                            <!-- <img class="ui-datepicker-trigger" src="/images/ico/datepicker_ico.png"
                                                alt="..." title="..."> -->
                                        </div>
                                    </div>
                                    <div>
                                        <span>~</span>
                                    </div>
                                    <div class="departure_date">
                                        <div class="flex__c">
                                            <input type="text" name="e_date" id="departure_date2" placeholder="" class="date_pic">
                                            <!-- <img class="ui-datepicker-trigger" src="/images/ico/datepicker_ico.png"
                                                alt="..." title="..."> -->
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

                                $ngayHienTai = date('Y-m-d');

                                // Lấy ngày 1 tháng trước
                                $ngayMotThangTruoc = date('Y-m-d', strtotime($ngayHienTai . ' -1 month'));

                                $g_list_rows = 100;

                                $total_sql = "
                                        select DATE_FORMAT(ch_r_date, '%Y-%m-%d') as ch_r_date_new, a.*, b.*, s.* from tbl_coupon a 
                                            left join tbl_coupon_history b ON a.c_idx = b.used_coupon_idx 
                                            left join tbl_coupon_setting s ON a.coupon_type = s.idx
                                            where m_idx = '" . $_SESSION["member"]["mIdx"] . "' $search_val
                                    ";

                                $nTotalCount = $connect->query($total_sql)->getNumRows();

                                $nPage = ceil($nTotalCount / $g_list_rows);
                                if ($pg == "") $pg = 1;
                                $nFrom = ($pg - 1) * $g_list_rows;

                                $sql    = $total_sql . " order by ch_idx desc limit $nFrom, $g_list_rows ";

                                // echo $sql;

                                $result = $connect->query($sql)->getResultArray();
                                $num = $nTotalCount - $nFrom;
                                if ($nTotalCount == 0) {
                                ?>
                                    <tr>
                                        <td colspan=6 style="text-align:center;height:100px; display: flex; align-items: center;">검색된 결과가 없습니다.</td>
                                    </tr>
                                <?php
                                }

                                $coupon_type_arr = array("percent" => "%", "won" => "원");

                                foreach ($result as $row) {

                                ?>
                                    <tr>
                                        <td class="date_s"><?= date("Y.m.d", strtotime($row['regdate'])) ?></td>
                                        <td class="des"><span><?= $row['coupon_name'] ?></span></td>
                                        <td class="date_e"><?= date("Y.m.d", strtotime($row['enddate'])) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php echo ipageListing2($pg, $nFrom, $g_list_rows, $_SERVER['PHP_SELF'] . "?scategory=$scategory&pg=") ?>
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
    <!-- </div> -->
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

    $(document).ready(function() {
        $('.date_pic').datepicker(datePickerConfig)
        // .datepicker('widget').wrap('<div class="ll-skin-melon"/>');
    });

    function search_it() {
        var frm = document.search;
        // if (frm.search_name.value == "검색어 입력")
        // {
        //     frm.search_name.value = "";
        // }
        frm.submit();
    }

    $('.m_filter').on('click', function() {
        $(this).addClass('active').siblings().removeClass('active')
        let value = $(this).text();

        console.log(value);

        $.ajax({
            url: "ajax.coupon_filter.php",
            type: "POST",
            data: {
                'time': value,
                url: '<?= $_SERVER['PHP_SELF'] ?>'
            },
            success: function(data) {
                // alert(data);
                $(".board_list").html(data);
            }
        })
    })

    $('.show_popup').on('click', function() {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function() {
        $(".popup_wrap").hide();
    });
</script>
<?php $this->endSection(); ?>
