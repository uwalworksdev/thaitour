<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
    $connect = db_connect();

    if ($_SESSION["member"]["mIdx"] == "") {
        alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }
?>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/gnb_menu_reponsive.css" rel="stylesheet" type="text/css"/>

<!--
<script src="/mypage/mypage.js" type="text/javascript"></script>
-->


<style>
    .paging {
        margin-top: 4rem;
    }
    .paging ul.page {
        /* transform: scale(2); */
        transform-origin: unset;
        width: unset;
    }

    .paging .page li a {
        font-size: 1.5rem;
    }
</style>
<?php

    $g_list_rows = 10;

    $total_sql = " select c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate, c.status, c.types
                        , COALESCE(s.coupon_name, m.coupon_name) AS coupon_name
                        , COALESCE(s.dc_type, m.dc_type) AS dc_type
                        , COALESCE(s.coupon_pe, m.coupon_pe) AS coupon_pe
                        , COALESCE(s.coupon_price, m.coupon_price) AS coupon_price
                        , COALESCE(s.etc_memo, m.etc_memo) AS etc_memo
                        from tbl_coupon c
                        left outer join tbl_coupon_setting s
                        on c.coupon_type = s.idx
                        left outer join tbl_coupon_mst m
					    on c.coupon_mst_idx = m.idx
                    where 1=1 and c.status != 'C' and c.enddate > curdate() and c.get_issued_yn != 'Y' ";
    $nTotalCount = $connect->query($total_sql)->getNumRows();

?>
<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
                echo view("/mypage/mypage_gnb_menu_inc", ["tab_5" => "on", "tab_5_3" => "on"]);
            ?>
            <div class="content">
                <h1 class="ttl_table_discount">쿠폰함</h1>
                <div class="slide_tab discount flex">
                    <a class="slide_tab_btn" href="../mypage/discount">사용 가능한 쿠폰</a>
                    <a class="slide_tab_btn" href="../mypage/discount_owned">지난 쿠폰</a>
                    <a class="slide_tab_btn active" href="../mypage/discount_download">쿠폰 다운로드</a>
                    <div></div>
                </div>
                <p class="count">전체 <span><?= $nTotalCount ?></span>개</p>
                <table class="coupon_table">
                    <colgroup class="">
                        <col width="20%">
                        <col width="*">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>쿠폰종류</th>
                        <th class="des" style="text-align: center;">쿠폰정보</th>
                        <th>사용기간</th>
                        <th>발급받기</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $nPage = ceil($nTotalCount / $g_list_rows);
                        if ($pg == "") $pg = 1;
                        $nFrom = ($pg - 1) * $g_list_rows;

                        $sql = $total_sql . " order by c_idx desc limit $nFrom, $g_list_rows ";
                        //echo $sql;
                        $result = $connect->query($sql)->getResultArray();
                        $num = $nTotalCount - $nFrom;
                        if ($nTotalCount == 0) {
                    ?>
                        <tr style="text-align: center; vertical-align: middle">
                            <td colspan="4">검색된 결과가 없습니다.</td>
                        </tr>
                    <?php
                        }
                        foreach ($result as $row) {
                    ?>
                        <tr>
                            <td class="coupon">
                                <div class="flex_c_c">
                                    <p class="cp_logo">coupon</p>
                                    <p class="price">
                                        <?php
                                            if ($row['dc_type'] == "P") {
                                                echo "{$row['coupon_pe']}<span>% 할인</span>";
                                            } else if ($row['dc_type'] == "D") {
                                                echo number_format($row["coupon_price"]) . "<span>원</span>";
                                            }
                                        ?>
                                    </p>
                                </div>
                            </td>
                            <td class="des">
                                <p><?= $row['coupon_name'] ?><br>
                                    <?= nl2br($row['etc_memo']) ?></p>
                                <p class="note">
                                    <?php
                                        if ($row['dc_type'] == "P") {
                                            echo "할인율 {$row['coupon_pe']}%";
                                        } else if ($row['dc_type'] == "D") {
                                            echo "할인가격 " . number_format($row["coupon_price"]) . "원";
                                        }
                                    ?>
                                    </p>
                            </td>
                            <td class="date"><span><?= (date("Y.m.d", strtotime($row['enddate']))) ?></span></td>
                            <td class="down">
                                <button onclick="handle_get_coupon('<?= $row['c_idx'] ?>')">발급받기</button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php echo ipageListing2($pg, $nPage, 10, $_SERVER['PHP_SELF'] . "?pg=") ?>
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
    $('.show_popup').on('click', function () {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function () {
        $(".popup_wrap").hide();
    });

    function handle_get_coupon(c_idx) {
        $.ajax({
            url: "ajax.get_coupon.php",
            type: "POST",
            data: {
                c_idx
            },
            success: () => {
                alert("쿠폰이 성공적으로 다운로드되었습니다!");
                location.reload();
            }
        })
    }
</script>
<?php $this->endSection(); ?>
