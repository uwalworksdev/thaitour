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

<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_3" => "on"]);
            ?>
            <div class="content">
                <h1 class="ttl_table">여행후기</h1>

                <?php
                $sql = "SELECT A.*, COUNT(B.r_idx) AS cmt_cnt, C.code_name
                            FROM tbl_travel_review A
                            LEFT JOIN tbl_bbs_cmt B ON A.idx = B.r_idx AND B.r_code = 'review'
                            LEFT JOIN tbl_code C ON A.travel_type = C.code_no
                            WHERE reg_m_idx = '" . $_SESSION["member"]["idx"] . "' GROUP BY A.idx ";

                // echo $sql;

                $g_list_rows = 10;
                $page_cnt = 10; // 페이지 목록에 표시되는 페이지의 수
                $total_cnt = $connect->query($sql)->getNumRows();
                $total_page = ceil($total_cnt / $g_list_rows);

                ?>

                <p class="count">전체 <span><?= $totalCount ?></span>개</p>
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
                    $nPage = ceil($totalCount / $g_list_rows);
                    if ($page == "") $page = 1;
                    $nFrom = ($page - 1) * $g_list_rows;
                    $fsql = $sql . " order by r_date desc, A.onum desc limit $nFrom, $g_list_rows ";

                    // echo $fsql;

                    $fresult = $connect->query($fsql)->getResultArray();
                    $index = 0;
                    $num = $totalCount - $nFrom;
                    $j = $totalCount;
                    foreach ($fresult as $frow) {
                        $index++;
                        ?>
                        <tr>
                            <td class="no"><span><?= $j ?></span></td>
                            <td class="num"><?= $frow['code_name'] ?></td>
                            <td class="des"><a
                                        href="../review/review_detail?idx=<?= $frow['idx'] ?>"><?= $frow['title'] ?></a>
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
                    <?php echo ipageListing2($pg, $nPage, $g_list_rows, $_SERVER['PHP_SELF'] . "?scategory=$scategory&pg=") ?>
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
