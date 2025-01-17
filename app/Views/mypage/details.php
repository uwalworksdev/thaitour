<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<?php
if (empty(session()->get("member")["mIdx"])) {
    alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}
?>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new02.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive.css" rel="stylesheet" type="text/css"/>
<link href="/css/community/community.css" rel="stylesheet" type="text/css"/>

<style>
    .mypage_container .content .details_table tbody tr .date {
        padding: 0 15px;
    }

    .mypage_container .content .details_table tbody tr .date:after {
        right: -0.9615rem;
    }

    .mypage_container .content .details_table tbody tr .date:nth-child(2) {
        padding: 0 15px;
    }

    .mypage_container .content .details_table tbody tr .ttl {
        padding: 0 15px;
    }

    /* .mypage_container .content .details_table tbody tr .ttl span {
        padding-right: 6.3846rem;
    } */
</style>
<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_1" => "on"]);
            ?>
            <div class="content">
                <h1 class="ttl_table">예약내역.</h1>
                <form name="search" id="search">
                    <input type="hidden" name="s_status" value="<?= $s_status ?>">
                    <input type="hidden" name="pg" value="<?= $pg ?>">
                    <div class="details_search flex_e_c">
                        <select name="" class="details_filter_selection only_mo">
                            <option value="">전체</option>
                            <option value="W">예약 준비중</option>
                            <option value="G">예약금</option>
                            <option value="R">중도금</option>
                            <option value="Y">후기쓰기</option>
                        </select>
                        <input type="text" name="search_word" value="<?= $search_word ?>">
                        <button class="search_button" type="button" onclick="search_it()">검색</button>
                    </div>
                </form>
                <div class="section_details">
                    <div class="details_wrap flex_b_c">
                        <p class="count">전체 <span><?= $nTotalCount ?></span>개</p>
                        <div class="details_filter">
                            <a href="/mypage/details?s_status=&search_word=<?= $search_word ?>&pg=<?= $pg ?>" class="filter_btn flex__c
                                <?php if (empty($s_status)) {
                                echo "active";
                            } ?>"><i></i>전체</a>
                            <a href="/mypage/details?s_status=W&search_word=<?= $search_word ?>&pg=<?= $pg ?>" class="filter_btn flex__c
                                <?php if ($s_status == "W") {
                                echo "active";
                            } ?>"><i></i>예약 준비중</a>
                            <a href="/mypage/details?s_status=G&search_word=<?= $search_word ?>&pg=<?= $pg ?>" class="filter_btn flex__c
                                <?php if ($s_status == "G") {
                                echo "active";
                            } ?>"><i></i>예약금</a>
                            <a href="/mypage/details?s_status=R&search_word=<?= $search_word ?>&pg=<?= $pg ?>" class="filter_btn flex__c
                                <?php if ($s_status == "R") {
                                echo "active";
                            } ?>"><i></i>중도금</a>
                            <a href="/mypage/details?s_status=Y&search_word=<?= $search_word ?>&pg=<?= $pg ?>" class="filter_btn flex__c
                                <?php if ($s_status == "Y") {
                                echo "active";
                            } ?>"><i></i>후기쓰기</a>
                            <a href="/mypage/details?s_status=C&search_word=<?= $search_word ?>&pg=<?= $pg ?>" class="filter_btn flex__c
                                <?php if ($s_status == "C") {
                                echo "active";
                            } ?>"><i></i>예약취소</a>
                        </div>
                    </div>
                    <table class="details_table">
                        <colgroup class="only_web">
                            <col width="110px">
                            <col width="110px">
                            <col width="*">
                            <col width="110px">
                            <col width="110px">
                            <?= ($is_allow_payment ? "<col width='120px'>" : "") ?>
                        </colgroup>
                        <thead>
                        <tr>
                            <th>예약일</th>
                            <th>구분</th>
                            <th>상품</th>
                            <th>상세보기</th>
                            <th>상태</th>
                            <?= ($is_allow_payment ? "<th>결제</th>" : "") ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($nTotalCount == 0) {
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">검색된 결과가 없습니다.</td>
                            </tr>
                            <?php
                        } else {
                            foreach ($order_list as $row) {
                                ?>
                                <tr>
                                    <td class="date date_1">
                                        <?= $row["order_r_date"] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $code_name = $row['code_name'];
                                        if ($row['order_gubun'] == 'guide' || $row['order_gubun'] == 'vehicle') {
                                            $code = getCodeFromCodeNo($row['product_code_2']);
                                            $code_name = $code['code_name'];
                                        }
                                        ?>
                                        <?= $code_name ?>
                                    </td>
                                    <td class="des"><span>
                                                <?= (html_entity_decode($row["product_name"])) ?>
                                            </span></td>
                                    <td class="schedule"><a
                                                href="../mypage/<?= $row['order_gubun'] ?>/invoice_view_item?order_idx=<?= $row['order_idx'] ?>&pg=<?= $pg ?>"><i></i>보기</a>
                                    </td>
                                    <?php if ($row["order_status"] == "W") {
                                        $color = '#e5001a';
                                    } else if ($row["order_status"] == "G" || $row["order_status"] == "R" || $row["order_status"] == "C") {
                                        $color = '#454545';
                                    } else if ($row["order_status"] == "Y") {
                                        $color = '#999999';
                                    }
                                    ?>
                                    <td class="status" style="color: <?= $color ?>">
                                        <?= get_status_name($row["order_status"]) ?>
                                    <td class="pay_btn pay_btn_1"
                                        style="<?= ($is_allow_payment ? "" : "display: none;") ?>">
                                        <?php
                                        if ($row["order_status"] == "W") { ?>
                                            <span class="no_click" data_order_idx="">결제준비중</span>
                                        <?php } else if ($row["order_status"] == "G") { ?>
                                            <a href="#!" class="btn deposit" data_order_no="<?= $row["order_no"] ?>" >결제하기</a>
                                        <?php } elseif ($row["order_status"] == "R") { ?>
                                            <a href="#!" class="btn pops_btn btn_cash"
                                               data_order_idx="<?= $row["order_idx"] ?>"
                                               data_order_gubun="balance">결제하기</a>
                                        <?php } elseif ($row["order_status"] == "Y") { ?>
                                            <a href="/review/review_write?product_idx=<?= $row["product_idx"] ?>"
                                               class="btn pops_btn review_write" data_order_idx="">후기쓰기</a>
                                        <?php } elseif ($row["order_status"] == "C") { ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="customer-center-page">
                        <?php
                        echo ipagelistingSub($pg, $nPage, $g_list_rows, current_url() . "?s_status=$s_status&search_word=$search_word&pg=")
                        ?>
                    </div>
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
                    <section class="earn_pops my_pops" style="display:none;">

                        <div class="pay_pops_inner pay_count02" style="display:none;">
                            <div class="pay_h">
                                <h2>무통장입금</h2>
                            </div><!-- pay_h -->
                            <div class="account">
                                <h3>국민은행 예금주(주식회사 블루스카이투어) <br>535501-04-141688</h3>
                                <p>
                                    김철수님! 무통장입금을 신청하셨습니다. <br>
                                    입금후 담당자에게 연락부탁드립니다. <br>
                                    감사합니다.
                                </p>
                            </div>
                            <div class="pay_pop_btn">
                                <a href="#!" class="btn pops_btn cancel close_btn">닫기</a>
                            </div>
                        </div><!-- pay_pops_inner  --> <!-- 무통장입금 팝업 종료 -->


                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$_paymod = "nicepay";    // ini  ,  lg


if ($_paymod == "lg") {
    if (device_chk() == "MO") {
        $urlStr = "travel_cash.m.inc_bak_LG.php";
    } else {
        $urlStr = "travel_cash.inc_bak_LG.php";
    }
} else if ($_paymod == "nicepay") {
    if (device_chk() == "MO") {
        $urlStr = "travel_cash.m.inc_nicepay.php";
    } else {
        $urlStr = "travel_cash.inc_nicepay.php";
    }
} else if ($_paymod == "ini") {
    if (device_chk() == "MO") {
        $urlStr = "travel_cash.m.inc.php";
    } else {
        $urlStr = "travel_cash.inc.php";
    }
}
?>

<form id="checkOut" action="/checkout/show" method="post">
<input type="hidden" name="dataValue" id="dataValue" value="" >
</form>

<style>
.my-button {
    background-color: #007BFF; /* Button background color */
    color: white; /* Text color */
    border: none; /* Remove border */
    padding: 10px 20px; /* Add padding */
    font-size: 16px; /* Text size */
    font-weight: bold; /* Text weight */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth hover effect */
}
</style>

<script>
$(document).ready(function() {
    $('#deposit').click(function() {
		$("#dataValue").val($(this).val());
	    $("#checkOut").submit();
    });
});
</script>

<script type="text/javascript">

    $('.details_filter_selection').on('change', function () {
        let status = $(this).val();
        window.location.href = "/mypage/details?s_status=" + status + "&search_word=<?=$search_word?>&pg=<?=$pg?>";
    })

    $(document).ready(function () {
        //못알창

        $('.btn_cash').click(function () {

            //$.ajax({
            //    url: "<?php //= $urlStr ?>//",
            //    type: "POST",
            //    data: "order_idx=" + $(this).attr("data_order_idx") + "&order_gubun=" + $(this).attr("data_order_gubun"),
            //    error: function(request, status, error) {
            //        //통신 에러 발생시 처리
            //        alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            //        $("#ajax_loader").addClass("display-none");
            //    },
            //    success: function(response, status, request) {
            //        $(".earn_pops").html(response);
            //        $('.my_pops').fadeIn('fast');
            //    }
            //});


        });
        //faq
        $('.faq_box ul li h5 a').click(function () {
            $(this).parent().next('.faq_text').slideToggle();
        });
    });

    function pay_btn() { // 결제하기 작동버튼 임시 작성
        $(".pay_count01").hide();
        $(".pay_count02").fadeIn();
    }

    function search_it() {
        var frm = document.search;
        frm.submit();
    }
</script>

<script>
    $('.show_popup').on('click', function () {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function () {
        $(".popup_wrap").hide();
    });
</script>
<?php $this->endSection(); ?>
