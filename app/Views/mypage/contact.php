<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
if ($_SESSION["member"]["mIdx"] == "") {
    alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}
?>
<style>
    .cancel .btn.btn-lg {
        height: 45px;
        font-size: 16px;
    }

    .cancel a.btn.btn-lg {
        line-height: 45px;
    }

    @media screen and (max-width: 850px) {

        .cancel .btn.btn-lg {
            height: 2.4615rem;
            font-size: 0.6667rem;
        }

        .cancel a.btn.btn-lg {
            line-height: 2.4615rem;
            margin: 0;
            width: 14.3333rem;
            height: 5rem;
            line-height: 5rem;
            font-size: 2.6667rem;
            margin-right: 1.2rem;
        }
    }

    @media screen and (max-width: 850px) {

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

        .ch_visit input[type="radio"]+label::after, .ch_visit input[type="checkbox"]+label::after {
        content: "";
        position: absolute;
        background-color: #fff;
        background-position: center;
        background-repeat: no-repeat;
        border: 0.0769rem solid var(--bs-gray-200);
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 0.0769rem;
    }

    .ch_visit input[type="radio"]+label::before, .ch_visit input[type="checkbox"]+label::before {
        content: "";
        width: 1.41rem;
        height: 2.1rem;
        position: absolute;
        left: 0.2308rem;
        top: calc(50% - 0.5692rem);
        border-radius: 0.0769rem;
        border: 0.538rem solid transparent;
        transform: rotate(45deg) translateY(-50%);
        border-top: none;
        opacity: 0;
        border-left: none;
        z-index: 10;
    }
    }
</style>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<!--<script src="/mypage/mypage.js" type="text/javascript"></script>-->

<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_6" => "on", "tab_6_2" => "on"]);
            ?>
            <div class="content">
                <h1 class="ttl_table">문의하기</h1>
                <p class="count">전체 <span>
                        <?= $nTotalCount ?>
                    </span>개</p>
                <table class="details_table mo">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="15%">
                        <col width="*">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                <div class="ch_visit">
                                    <input type="checkbox" id="agree1" class="agree1" name="agree">
                                    <label for="agree1"></label>
                                </div>
                            </th>
                            <th>번호</th>
                            <th>구분</th>
                            <th>제목</th>
                            <th>상태</th>
                            <th>등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 0;
                        $stt = 1;
                        foreach ($fresult as $row) {
                            $index++
                        ?>
                            <tr>
                                <td class="check">
                                    <div class="ch_visit">
                                        <!-- <input type="checkbox" id="<?= $row['idx'] ?>" class="agree" name="agree" onclick="change_stt(this)"> -->
                                        <input type="checkbox" id="<?= $row['idx'] ?>" class="agree" name="agree">
                                        <label for="<?= $row['idx'] ?>"></label>
                                    </div>
                                </td>
                                <td class="no">
                                    <span>
                                        <?php echo $stt++ ?>
                                    </span>
                                </td>
                                <td class="num">
                                    <?php echo $row['code_name'] ?>
                                </td>
                                <td class="des">
                                    <a href="/contact/view?idx=<?= $row['idx'] ?>">
                                        <?php echo $row['title'] ?>
                                    </a>
                                </td>
                                <td class="stt">
                                    <?php
                                    if ($row['status'] == 'W') {
                                    ?>
                                        <span style="color: #e5001a">답변대기</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span>답변완료</span>
                                </td>
                            <?php } ?>
                            <td class="date spe">
                                <?php
                                // $date = explode(" ", $row['r_date']);
                                $date = $row['r_date'];
                                echo $date;
                                ?>
                            </td>
                            </tr>
                        <?php
                        }
                        ?>

                        <?php if ($index == 0) { ?>
                            <tr style="text-align: center; vertical-align: middle">
                                <td colspan="6" class="none_data">문의 내역이 없습니다.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="cancel flex_b_c">
                    <!-- <div class="ch_visit">
                        <input type="checkbox" id="agree10" class="agree" name="agree">
                        <label for="agree10"></label>
                    </div> -->
                    <button id="delete">선택삭제</button>
                    <a href="/contact/write" class="btn btn-lg btn-point contact_btn"
                        style="position: relative">문의하기</a>
                </div>
                <?php echo ipageListing2($page, $nPage, $g_list_rows, $_SERVER['PHP_SELF'] . "?pg=") ?>
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
    $('#agree1').click(function() {
        var x = [];
        x = document.getElementsByClassName("agree");
        var y = document.getElementById("agree1");
        if (y.checked == true) {
            for (let i = 0; i < x.length; i++) {
                x[i].checked = true;
            }
        } else {
            for (let i = 0; i < x.length; i++) {
                x[i].checked = false;
            }
        }
    });

    $('#delete').click(function() {
        var x = [],
            y = [];
        x = document.getElementsByClassName("agree");
        a = document.getElementById("agree1");
        for (let i = 0; i < x.length; i++) {
            if (x[i].checked == true) {
                y.push(x[i].id);
            }
        }
        if (!confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            return;
        }
        $.ajax({
            type: 'POST',
            url: './contactDel',
            data: {
                data: y
            },
            success: function(response) {
                alert("삭제되었습니다!");
                location.reload();
            },
            error: function(error) {
                alert("삭제에 실패했습니다!");
            }
        });
    })
</script>
<?php $this->endSection(); ?>