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
<?php

$g_list_rows = 10;


$total_sql = " select c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate, c.status, c.types
                    , COALESCE(s.coupon_name, m.coupon_name) AS coupon_name
                    , COALESCE(s.dc_type, m.dc_type) AS dc_type
                    , COALESCE(s.coupon_pe, m.coupon_pe) AS coupon_pe
                    , COALESCE(s.coupon_price, m.coupon_price) AS coupon_price
                    from tbl_coupon c
                    left outer join tbl_coupon_setting s
                    on c.coupon_type = s.idx
                    left outer join tbl_coupon_mst m
					on c.coupon_mst_idx = m.idx
                where 1=1 and c.status != 'C' and c.get_issued_yn = 'Y' and c.user_id = '{$_SESSION["member"]["id"]}' ";
$nTotalCount = $connect->query($total_sql)->getNumRows();

?>
<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc", ["tab_5" => "on", "tab_5_2" => "on"]);
            ?>
            <div class="content">
                <h1 class="ttl_table_discount">쿠폰함</h1>
                <div class="slide_tab discount flex">
                    <a class="slide_tab_btn" href="../mypage/discount">사용 가능한 쿠폰</a>
                    <a class="slide_tab_btn active" href="../mypage/discount_owned">지난 쿠폰</a>
                    <!-- <a class="slide_tab_btn" href="../mypage/discount_download">쿠폰 다운로드</a> -->
                    <div></div>
                </div>
                <p class="count">전체 <span><?= $nTotalCount ?></span>개</p>
                <table class="details_table" style="display: table;">
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
                            <td colspan="3" style="">검색된 결과가 없습니다.</td>
                        </tr>
                        <?php
                    }
                    foreach ($result as $row) {
                        ?>
                        <tr>
                            <td class="date_s">
                                <span><?= (date("Y.m.d", strtotime($row["regdate"]))) ?></span>
                            </td>
                            <td class="des">
                                    <span>
                                        <?php
                                        if ($row['types'] == "N") {
                                            echo $row["coupon_name"];
                                        } else {
                                            echo $_set_coupon_type[$row['types']];
                                        }
                                        ?>
                                    </span>
                            </td>
                            <td class="date_e">
                                <span><?= (date("Y.m.d", strtotime($row["enddate"]))) ?></span>
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
