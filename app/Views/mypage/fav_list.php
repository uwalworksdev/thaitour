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


<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<!--
<script src="/mypage/mypage.js" type="text/javascript"></script>
-->
<style>
    @media screen and (max-width: 850px) {
        .mypage_container .content .fav_list_table colgroup {
            display: none;
        }

        .mypage_container .mypage_wrap .gnb_menu {
            flex-basis: 0 !important;
            flex-shrink: 0;
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

        .now_tab_text {
            width: 100%;
            height: 7.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            /* background-color: #000; */
            font-size: 2.2534rem;
            font-weight: 700;
            background: var(--bs-point) url(/images/btn/arrow_down_m.png) no-repeat right 1.7316rem center/ auto;
            background-size: 2.4001rem 1.6999rem;
        }


        .gnb_menu_list li {
            width: 100%;
            height: 100%;
            border: none;
            /* display: flex;
        align-items: center;
        justify-content: center; */
            text-align: center;
            color: #000;
            font-size: 2.2534rem;
            font-weight: 400;
            background-color: transparent;
            border-bottom: 0.1999rem solid #dbdbdb !important;
        }

        .gnb_menu_list li:last-child {
            border-bottom: none;
        }

        .mypage_container .gnb_menu {
            position: relative;
            overflow-y: visible;
        }

        .mypage_container .gnb_menu_list>li .menu_level_1 {
            height: 7.3666rem;
            border-bottom: none;
            justify-content: center;
        }

        .mypage_container .gnb_menu_list>li .menu_level_1.has_submenu {
            background: url(../assets/img/ico/gnb_menu_list_w.png) no-repeat right 1.7316rem center/ auto;
            background-size: 1.9999rem 1rem;
        }

        .mypage_container .gnb_menu_list>li .menu_level_1 .btn_togle {
            display: none;
        }

        .mypage_container .gnb_menu li .menu_level_1 a {
            font-size: 2.6rem;
            font-family: "Noto Sans KR";
            font-weight: 400;
            color: #252525;
        }

        .mypage_container .gnb_menu li .menu_level_2 a {
            font-size: 2.6rem;
            font-family: "Noto Sans KR";
            font-weight: 400;
            color: #656565;
        }

        .gnb_menu_list>li .menu_level_2 {
            flex-direction: column !important;
            border-bottom: none !important;
            padding: 2.9999rem 0 !important;
            color: #656565 !important;
            gap: 2.9999rem !important;
            background-color: #fafafa !important;
            border-top: 0.1999rem solid #dbdbdb !important;
        }

        .mypage_container .content .details_table.mo colgroup {
            display: none;
        }

        .mypage_container .content .details_table.mo tbody tr .check {
            width: 4.0001rem;
        }

        .mypage_container .content .details_table.mo tbody tr .des {
            order: 0;
            flex-basis: 93%;
            padding-left: 2.4001rem;
        }

        .mypage_container .content .details_table.mo tbody tr .des a {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            word-break: break-all;
            height: 3.8399rem;
            line-height: 1.5;
            text-align: left;
        }

        .mypage_container .content .details_table.mo tbody tr .stt {
            text-align: center;
            color: #999999;
            font-size: 2.4001rem;
            font-weight: 500;
        }

        .mypage_container .content .details_table.mo tbody tr .no {
            display: none;
        }

        .mypage_container .content .details_table.mo tbody tr .num {
            text-align: center;
            color: #454545;
            order: 2;
            padding-right: 2.3rem;
            position: relative;
        }

        .mypage_container .content .details_table.mo tbody tr .num::before {
            content: '구분: ';
            font-size: 2.6rem;
            color: #454545;
        }

        .mypage_container .content .details_table.mo tbody tr .num::after {
            width: 0.1999rem;
            height: 2.08rem;
            background-color: #757575;
            content: '';
            position: absolute;
            right: 0.9799rem;
            top: 0.3754rem;
        }

        .mypage_container .content .details_table.mo tbody tr .stt {
            text-align: center;
            color: #454545;
            order: 3;
            padding-right: 2.3rem;
            position: relative;
        }


        .mypage_container .content .point_table tbody tr .history span {
            height: 100% !important;
        }


        .mypage_container .content .details_table.mo tbody tr .stt::before {
            content: '상태: ';
            font-size: 2.6rem;
            color: #454545;
            font-weight: 400;
        }

        .mypage_container .content .details_table.mo tbody tr .stt::after {
            width: 0.1999rem;
            height: 2.08rem;
            background-color: #757575;
            content: '';
            position: absolute;
            right: 0.9799rem;
            top: 0.22rem;
        }

        .mypage_container .content .details_table.mo tbody tr .date {
            text-align: left;
            color: #454545;
            order: 4;
            padding-right: 2.3rem;
            width: 35.4rem;
            padding: 0 !important;
        }

        .mypage_container .content .details_table.mo tbody tr .date.spe {
            padding: 0 !important;
            text-align: left;
            width: fit-content;
        }

        .mypage_container .content .details_table.mo tbody tr .date::before {
            content: '등록일: ';
            font-size: 2.6rem;
            color: #454545;
        }

        .mypage_container .content .details_table.mo tbody tr .date.spe::before {
            content: unset;
            font-size: 2.6rem;
            color: #454545;
        }

        .mypage_container .content .details_table.mo tbody tr .date::after {
            display: none;
        }
    }
</style>
<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_2" => "on"]);

            $sql_wish = " select a.*, b.* from tbl_wish_list a
                                                left join tbl_product_mst b on a.product_idx = b.product_idx 
                                                where m_idx = '" . $_SESSION["member"]["idx"] . "'   ";

            $g_list_rows = 10;
            $page_cnt = 10; // 페이지 목록에 표시되는 페이지의 수
            $total_cnt = $connect->query($sql_wish)->getNumRows();
            $total_page = ceil($total_cnt / $g_list_rows);
            ?>
            <div class="content">
                <h1 class="ttl_table">찜한 상품</h1>
                <p class="count">전체 <span><?= $total_cnt ?></span>개</p>
                <form name="frm" id="frm">
                    <table class="fav_list_table">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="10%">
                            <col width="*">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>
                                    <div class="ch_visit">
                                        <input type="checkbox" id="agree1" class="idx_checkbox_all" name="agree"
                                            onclick="checkBoxSwitchAll()">
                                        <label for="agree1"></label>
                                    </div>
                                </th>
                                <th>번호</th>
                                <th>상품번호</th>
                                <th>상품</th>
                                <th>상세보기</th>
                                <th>등록일</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $nPage = ceil($total_cnt / $g_list_rows);
                            if ($page == "") $page = 1;
                            $nFrom = ($page - 1) * $g_list_rows;
                            $fsql = $sql_wish . " order by wish_r_date asc  limit $nFrom, $g_list_rows ";

                            // echo $fsql;

                            $fresult = $connect->query($fsql)->getResultArray();
                            $index = 0;
                            $num = $total_cnt - $nFrom;
                            foreach ($fresult as $frow) {
                                $index++;
                            ?>
                                <tr>
                                    <td class="check">
                                        <div class="ch_visit">
                                            <input type="checkbox" id="agree<?= $frow['wish_idx'] ?>"
                                                class="idx_checkbox input_check" name="idx[]"
                                                value="<?= $frow['wish_idx'] ?>">
                                            <label for="agree<?= $frow['wish_idx'] ?>"></label>
                                        </div>
                                    </td>
                                    <td class="no"><span><?= $num-- ?></span></td>
                                    <td class="num"><?= $frow['product_code'] ?></td>
                                    <td class="des"><span><?= viewSQ($frow['product_name']) ?></span></td>

                                    <?php
                                    if ($frow['product_code_1'] == "1317") {
                                        $product = "t-tours";
                                    } else if ($frow['product_code_1'] == "1320") {
                                        $product = "t-honeymoon";
                                    } else if ($frow['product_code_1'] == "1324") {
                                        $product = "t-package";
                                    } else if ($frow['product_code_1'] == "1325") {
                                        $product = "t-trip";
                                    }
                                    ?>

                                    <td class="schedule"><a
                                            href="/<?= $product ?>/item_view?product_idx=<?= $frow['product_idx'] ?>">상세보기</a>
                                    </td>
                                    <td class="date"><?= date("Y.m.d", strtotime($frow['wish_r_date'])) ?></td>
                                </tr>

                            <?php
                            }
                            ?>

                            <?php if ($index == 0) { ?>
                                <tr style="text-align: center; vertical-align: middle;">
                                    <td colspan="6" class="none_data" style="width: 100%;">찜한 상품이 없습니다.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="cancel flex__c">
                        <!-- <div class="ch_visit">
                            <input type="checkbox" id="agree10" class="agree" name="agree">
                            <label for="agree10"></label>
                        </div> -->
                        <button type="button" onclick="SELECT_DELETE()">선택삭제</button>
                    </div>

                </form>
                <?php echo ipageListing2($page, $nPage, $g_list_rows, $_SERVER['PHP_SELF'] . "?scategory=$scategory&pg=") ?>
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
    $('.show_popup').on('click', function() {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function() {
        $(".popup_wrap").hide();
    });

    function checkBoxSwitchAll() {
        let checkboxAll = document.querySelector('.idx_checkbox_all');
        let checkboxEach = document.querySelectorAll('.idx_checkbox');

        checkboxEach.forEach(function(element) {
            element.checked = checkboxAll.checked
        });
    }

    function SELECT_DELETE() {
        if ($(".input_check").is(":checked") == false) {
            alert("삭제할 내용을 선택하셔야 합니다.");
            return;
        }
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        // console.log($("#frm").serialize());

        $.ajax({
            url: "/tools/del_wish",
            type: "POST",
            data: $("#frm").serialize(),
            error: function(request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            },
            success: function(data, status, request) {
                alert("정상적으로 삭제되었습니다.");
                location.reload();
            }
        });

    }
</script>
<?php $this->endSection(); ?>