<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/contents/confirm.css">

<div class="customer-form-page">
    <div class="navigation-section">
        <div class="body_inner">
            <div class="content-main">
                <div class="item-n">
                    <span class="number-n">
                        1
                    </span>
                    <span class="label-n">상품선택</span>
                    <img src="/uploads/icons/arrow_right_nav.png" alt="">
                </div>
                <div class="item-n">
                    <span class="number-n">
                        2
                    </span>
                    <span class="label-n">예약정보</span>
                    <img src="/uploads/icons/arrow_right_nav.png" alt="">
                </div>
                <div class="item-n">
                    <span class="number-n">
                        3
                    </span>
                    <span class="label-n">결제</span>
                </div>
            </div>
        </div>
    </div>
    <div class="main-section ">
        <div class="body_inner">
            <form action="#" class="formOrder " id="formOrder">
            <input type="hidden" name="dataValue" id="dataValue" value="<?=$_REQUEST['dataValue']?>" >
                <div class="container-card cus_item_spa_">
                    <div class="form_booking_spa_">
                        <div class="card-left2">
                            <h3 class="title-main-c">
                                결제하기
                            </h3>

                            <div class="only_w">
                                <table class="table_container_">
                                    <colgroup>
                                        <col width="20%">
                                        <col width="20%">
                                        <col width="60%">
                                    </colgroup>
                                    <tbody>
                                        <tr class="">
                                            <td class="subject_" rowspan="3">계좌이체 (원화)</td>
                                            <td class="content_">가상계좌</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="inicis" id="inicis">
                                                <label for="inicis">이니시스</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content_">실시간 계좌이체</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="inicis1" id="inicis1">
                                                <label for="inicis1">이니시스</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content_">무통장 입금</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="deposit" id="deposit">
                                                <label for="deposit" style="margin-right: 30px">지정계좌 입금</label>

                                                <button class="btn_ open_popup" type="button">한국계좌번호 보기</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="subject_">신용카드</td>
                                            <td class="content_">신용카드 - 일반</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="KCP" id="KCP">
                                                <label for="KCP" style="margin-right: 30px">KCP</label>

                                                <input type="radio" name="inp_radio" value="inicis2" id="inicis2">
                                                <label for="inicis2">이니시스</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="only_m">
                                <table class="table_container_">
                                    <colgroup>
                                        <col width="30%">
                                        <col width="70%">
                                    </colgroup>
                                    <tbody>
                                        <tr class="">
                                            <td class="subject_" colspan="2">계좌이체 (원화)</td>
                                        </tr>
                                        <tr>
                                            <td class="content_">가상계좌</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="inicis" id="inicis">
                                                <label for="inicis">이니시스</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content_">실시간 계좌이체</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="inicis1" id="inicis1">
                                                <label for="inicis1">이니시스</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content_">무통장 입금</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="deposit" id="deposit">
                                                <label for="deposit" style="margin-right: 30px">지정계좌 입금</label>

                                                <button class="btn_ open_popup" type="button">한국계좌번호 보기</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="subject_" colspan="2">신용카드</td>
                                        </tr>
                                        <tr>
                                            <td class="content_">신용카드 - 일반</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="KCP" id="KCP">
                                                <label for="KCP" style="margin-right: 30px">KCP</label>

                                                <input type="radio" name="inp_radio" value="inicis2" id="inicis2">
                                                <label for="inicis2">이니시스</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="payment_info_">
                                <div class="payment_first_">
                                    <img src="/img/sub/warning_icon_.png" alt="" class="warning_icon_">
                                    <p>결제안내</p>
                                </div>
                                <div class="payment_second_">
                                    <p>
                                        원하시는 은행의 가상계좌번호를 발급해드리며, 해당 계좌로 최종결제금액을 입금해주세요.
                                    </p>
                                    <p>
                                        발급된 가상 계좌번호로 입금이 되면 자동 입금 확인처리됩니다.
                                    </p>
                                    <p>
                                        가상계좌번호를 분실하신 경우 다시 발급을 신청하셔서, 가장 최근의 계좌번호로 입금하시기 바랍니다.
                                    </p>
                                </div>
                            </div>

                            <div class="payment_info_desc_">
                                ※ 크롬이나 사파리를 이용하여 결제 시 쿠키 또는 세션에 대한 경고 메시지가 나오는 경우, 브라우저 설정에서 쿠키 <br>
                                사용을 허용하시고 타사 쿠키 차단 옵션을 비활성화 시켜주세요..
                            </div>

                            <h3 class="title-main-c">
                                결제금액
                            </h3>

                            <table class="table_container_">
                                <colgroup>
                                    <col width="20%">
                                    <col width="80%">
                                </colgroup>
                                <tbody>
                                    <tr class="">
                                        <td class="subject_">총 결제금액</td>
                                        <td class="normal_">
                                            <p class="price_">
                                                432,100원
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="subject_">쿠폰 사용</td>
                                        <td class="nomal_">
                                            <div class="item_number_area_">
                                                <input type="number" value="0" min="0" class="item_number_">
                                                <button type="button" class="coupon_open" onclick="showCouponPop();">쿠폰조회</button>
                                                <p class="item_title_">
                                                    사용 (사용가능 쿠폰 : 0 장)
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="subject_">포인트</td>
                                        <td class="normal_">
                                            <div class="item_number_area_">
                                                <input type="number" value="0" min="0" class="item_number_">
                                                <p class="item_title_">
                                                    포인트 (사용가능 포인트 : 0포인트)
                                                </p>
                                            </div>
                                            <div class="sup_area_">
                                                ※ 포인트는 최소결제금액이 10,000원 이상일 경우에만 사용이 가능합니다. <br>
                                                ※ 포인트는 현지 통화 제외 모든 결제 수단 사용 가능합니다.
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="subject_">포인트</td>
                                        <td class="normal_">
                                            <p class="price_">
                                                432,100원
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h3 class="title-main-c main_cus_">
                                결제자정보
                            </h3>

                            <table class="table_container_">
                                <colgroup>
                                    <col width="20%">
                                    <col width="80%">
                                </colgroup>
                                <tbody>
                                    <tr class="">
                                        <td class="subject_">성명(한글)</td>
                                        <td class="normal_">
                                            <div class="item_number_area_">
                                                <input type="text" value="퐁" class="item_number__">
                                                <p class="item_title__">
                                                    * 무통장입금의 경우 실제 입금자명을 입력해주세요.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="subject_">이메일</td>
                                        <td class="normal_">
                                            <div class="item_number_area_">
                                                <input type="email" value="vnuwalworks@gmail.com" class="item_number__">
                                                <p class="item_title__">
                                                    * 결제완료시 결제 확인 메일이 발송됩니다.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="subject_">휴대폰 번호</td>
                                        <td class="normal_">
                                            <div class="item_number_area_">
                                                <input type="text" value="0.12124" class="item_number__">
                                                <p class="item_title__">
                                                    * 숫자와 - 만 입력해 주세요. 예) 010-1234-5678
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-right2 spa-detail">
                        <h3 class="title-r">
                            예약 정보
                        </h3>

                        <div class="item-info-r">
                            <span>객실 9개 X 1박</span>
                            <span>
                                <span class="textPrice_ ">1,085400</span> 원
                            </span>
                        </div>

                        <div class="item-info-r">
                            <span>세금&서비스비용</span>
                            <span>
                                <span class="textPrice_ ">102,600</span> 원
                            </span>
                        </div>

                        <div class="item-info-r">
                            <span>포인트</span>
                            <span>
                                <span class="textPrice_ ">-2,600</span> 원
                            </span>
                        </div>

                        <div class="item-info-r item-info-r-border-b">
                            <span>쿠폰할인</span>
                            <span>
                                <span class="textPrice_ ">-2,600</span> 원
                            </span>
                        </div>

                        <div class="item-info-r">
                            <span class="mainPrice_">총 결제금액 </span>
                            <span>
                                <span class="textPrice_ lastPrice">1,085400</span> 원
                            </span>
                        </div>

                        <p class="below-des-price">
                            · 체크인하시려면 3일 전에 숙소로 연락해 주세요 <br>
                            · 선택하신 객실 유형의 체크인 시간은 14:00~24:00 사이,
                            체크아웃 시간은 06:00~12:00입니다. <br>
                            · 온수 (지정시간 제공)
                        </p>
                        <button class="btn-order btnOrder" onclick="nicepayStart();" type="button">
                            예약하기
                        </button>
                        <button class="btn-cancel btnCancel" onclick="cancelOrder();" type="button">
                            취소하기
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="popup_wrap place_pop policy_pop">
        <div class="pop_box">
            <button type="button" class="close" onclick="closePopup();"></button>
            <div class="pop_body">
                <div class="padding">
                    <div class="popup_place__head">
                        <div class="popup_place__head__ttl">
                            <h2>취소 규정</h2>
                        </div>
                    </div>
                    <div class="popup_place__body">
                        <?= viewSQ(getPolicy(19)) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>
</div>

<!-- popup -->
<div class="popup_wraps popup_wrap_cus_1 send_mail_pop" id="send_mail_pop" style="display: none;">
    <div class="pop_box">
        <div class="pop_head flex_c_c">
            <p class = "text">한국계좌은행번호</p>
            <button type="button" class="close">
                <img src="/img/btn/close_ic.png" alt=""></button>
        </div>
        <div class="pop_body">
            
                <div class="main_content_">
                    <div class="title_">우리은행</div>

                    <div class="number_">
                        838689-79-686868
                    </div>

                    <div class="sup_title_">
                        (더투어랩)
                    </div>

                    <div class="content_">
                        ※ 예약 신청자와 결제자 이름이 다른 경우 1:1 게시판으로 결제 확인 요청을 꼭 해주세요.
                    </div>
                </div>
            
        </div>
    </div>
    <div class="dim"></div>
</div>
<div id="popup_coupon" class="popup_coupon" data-price="">
    <div class="popups">
        <div class="popup-content">
            <img src="/images/ico/close_icon_popup.png" alt="close_icon" class="close-btn"></img>
            <h2 class="title-popup">적용가능한 쿠폰 확인</h2>
            <div class="order-popup">

                <p class="count-info">사용 가능 쿠폰 <span>1장</span></p>
                <div class="description-above">

                    <div class="item-price-popup" style="cursor: pointer;">
                        <div class="img-container">
                            <img src="/images/sub/popup_cash_icon.png" alt="popup_cash_icon">
                        </div>
                        <div class="text-con">
                            <span class="item_coupon_name"></span>
                            <span class="text-gray"> 할인쿠폰</span>
                        </div>
                        <span class="date-sub">~</span>
                    </div>

                    <div class="item-price-popup item-price-popup--button active"
                        data-idx="" data-type="" data-discount="0" data-discount_baht="0">
                        <span>적용안함</span>
                    </div>
                </div>
                <div class="line-gray"></div>
                <div class="footer-popup">
                    <div class="des-above">
                        <div class="item">
                            <span class="text-gray">총 주문금액</span>
                            <span class="text-gray total_price" id="total_price_popup" data-price="">0원</span>
                        </div>
                        <div class="item">
                            <span class="text-gray">할인금액</span>
                            <span class="text-gray discount" data-price="">0원</span>
                        </div>
                    </div>
                    <div class="des-below">
                        <div class="price-below">
                            <span>최종결제금액</span>
                            <p class="price-popup">
                                <span id="last_price_popup">0</span><span
                                        class="text-gray">원</span>
                            </p>
                        </div>
                    </div>
                    <button type="button" class="btn_accept_popup btn_accept_coupon">
                        쿠폰적용
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="bg"></div>
</div>
<style>
    .popup_wraps.popup_wrap_cus_1 {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Dark background */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .padding {
        padding-inline: 60px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .form_input {
        margin-top: 30px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .form_input label {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 13px;
        color: #252525;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .form_input input {
        border-style: solid;
        border-width: 1px;
        border-color: rgb(229, 229, 229);
        border-radius: 2px;
        background-color: rgb(255, 255, 255);
        width: 100%;
        height: 50px;
        margin-top: 20px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_head {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 55px;
        background-color: #2a459f!important;
        border-radius: 5px 5px 0 0;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_head .text {
        color: #fff;
        text-align: left;
        width: 100%;
        padding: 0 22px;
        font-size: 20px;
        font-weight: 500;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_ttl {
        font-size: 20px;
        font-weight: bold;
        color: #fff;
        text-align: center;
        line-height: 68px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_box .close {
        top: 50%;
        transform: translateY(-50%);
        right: 25px;
        background: none;
        position: absolute;
        opacity: 1;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_box .pop_input {
        margin-top: 98px;
        display: block;
        height: unset;
        background-color: #fff;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_footer {
        margin-top: 40px;
        display: flex;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .policy {
        border-style: solid;
        border-width: 1px;
        border-color: rgb(229, 229, 229);
        border-radius: 2px;
        background-color: rgb(255, 255, 255);
        width: 100%;
        height: 142px;
        overflow: auto;
        padding: 5px;
    }

    .popup_wraps.popup_wrap_cus_1 .pop_box .pop_footer button {
        border-radius: 4px;
        color: #454545;
        font-size: 18px;
        height: 62px;
        background-color: rgb(242, 242, 242);
        color: #252525;
        font-weight: 500;
        margin-left: 12px;
    }

    .popup_wraps.popup_wrap_cus_1 .pop_box .pop_footer button:first-child {
        background-color: #209e80 !important;
        box-shadow: 0px 16px 15.04px 0.96px rgba(46, 62, 146, 0.28);
        color: #fff;
        margin-left: 0;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_box {
        width: 600px;
        position: relative;
        background: white;
        border-radius: 5px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .padding {
        padding-inline: 0;
    }
     .main_content_ {
        border-radius: 20px;
        margin-top: 50px;
        padding: 30px;
        width: 100%;
        background-color: rgba(219, 219, 219, 0.25);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 20px;
    }

     .main_content_ .title_ {
        font-size: 24px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

     .main_content_ .number_ {
        background-color: #FFFFFF;
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 32px;
        letter-spacing: 2px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

     .main_content_ .sup_title_ {
        font-size: 24px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

     .main_content_ .content_ {
        font-size: 16px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #2a459f;
    }
</style>

<script>
    $(document).ready(function() {
        $(".open_popup").click ( function() {
            $(".popup_wraps").show()
            console.log("kkk")
        })
        $(".popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_box .close").click(function() {
            $(".popup_wraps").hide()
        })
    })
    
</script>

<script>
    $(document).ready(function() {

        $("#save_id").click(function() {
            if ($(this).is(":checked")) {
                $("#order_user_name").val(`<?= session("member.name") ?>`);
                const email = `<?= session("member.email") ?>`;
                const emailArr = email.split("@");
                $("#email_1").val(emailArr[0] ?? "");
                $("#email_2").val(emailArr[1] ?? "");
                const phone = `<?= session("member.phone") ?>`;
                const phoneArr = phone.split("-");
                $("#phone_1").val(phoneArr[0] ?? "");
                $("#phone_2").val(phoneArr[1] ?? "");
                $("#phone_3").val(phoneArr[2] ?? "");
            } else {
                $("#order_user_name").val("");
                $("#email_1").val("");
                $("#email_2").val("");
                $("#phone_1").val("");
                $("#phone_2").val("");
                $("#phone_3").val("");
            }
        });

        $(".phone").on("input", function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        });

        $('.tab_box_element_').on('click', function() {
            $('.tab_box_element_').removeClass('tab_active_');

            $(this).addClass('tab_active_');

            const tabId = $(this).attr('rel');
            $('.tab_content').hide();
            $('#' + tabId).show();
        });

        $(".item-clause-all").click(function() {
            if ($(this).hasClass("click")) {
                $(this).removeClass("click");
                $('.item-clause-item').each(function() {
                    $(this).removeClass("acti");
                    $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
                })
            } else {
                $(this).addClass("click");
                $('.item-clause-item').each(function() {
                    $(this).addClass("acti");
                    $(this).find("img").attr("src", "/images/btn/clause-check-black.png");
                })
            }
        });

        $(".item-clause-item").click(function() {
            if ($(this).hasClass("acti")) {
                $(this).removeClass("acti");
                $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
            } else {
                $(this).addClass("acti");
                $(this).find("img").attr("src", "/images/btn/clause-check-black.png");
            }

            var allHaveActi = true;

            $('.item-clause-item').each(function() {
                if (!$(this).hasClass('acti')) {
                    allHaveActi = false;
                    return false;
                }
            });
            if (allHaveActi) {
                $(".item-clause-all").addClass("click")
            } else {
                $(".item-clause-all").removeClass("click")
            }
        });

        $("input[name='radio_phone'").change(function() {
            if ($(this).val() == 'kor') {
                $(".phone_kor").attr("disabled", false).eq(0).focus();
                $(".phone_thai").attr("disabled", true);
            } else {
                $(".phone_thai").attr("disabled", false).focus();
                $(".phone_kor").attr("disabled", true);
            }
        })
    });

    function handleEmail(email) {
        if (email == '1') {
            $("#email_2").val('').prop('readonly', false).focus();
        } else {
            $("#email_2").val(email).prop('readonly', true);
        }
    }

    function closePopup() {
        $(".popup_wrap").hide();
        $(".dim").hide();
    }

    $("#policy_show").on("click", function() {
        $(".policy_pop, .policy_pop .dim").show();
    });

    $('.item_check_term_').click(function() {
        $(this).toggleClass('checked_');
        let input = $(this).find('input');
        input.val($(this).hasClass('checked_') ? 'Y' : 'N');

        checkOrUncheckAll();
    });

    function fn_show_bank() {
        window.location.href = "/checkout/bank";
    }

    function checkOrUncheckAll() {
        let allChecked = true;

        $('.item_check_term_').each(function() {
            let input = $(this).find('input');
            if (input.val() !== 'Y') {
                allChecked = false;
                return false;
            }
        });

        let allCheckbox = $('.item_check_term_all_');
        let allInput = allCheckbox.find('input');
        allCheckbox.toggleClass('checked_', allChecked);
        allInput.val(allChecked ? 'Y' : 'N');
    }

    $('.item_check_term_all_').click(function() {
        $(this).toggleClass('checked_');
        let allChecked = $(this).hasClass('checked_');
        let value = allChecked ? 'Y' : 'N';
        $(this).find('input').val(value);

        $('.item_check_term_').each(function() {
            $(this).toggleClass('checked_', allChecked);
            $(this).find('input').val(value);
        });
    });

    function number_format(number, decimals = 0, dec_point = '.', thousands_sep = ',') {
        number = parseFloat(number).toFixed(decimals);
        number = number.toString().replace('.', dec_point);
        let parts = number.split(dec_point);
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
        return parts.join(dec_point);
    }

    function showCouponPop() {
        $("#popup_coupon").css('display', 'flex');
    }

    const $closePopupBtn = $('.close-btn');
    $closePopupBtn.on('click', function() {
        $("#popup_coupon").css('display', 'none');
    });

</script>


<?php
//header("Content-Type:text/html; charset=utf-8;"); 
/*
*******************************************************
* <결제요청 파라미터>
* 결제시 Form 에 보내는 결제요청 파라미터입니다.
* 샘플페이지에서는 기본(필수) 파라미터만 예시되어 있으며, 
* 추가 가능한 옵션 파라미터는 연동메뉴얼을 참고하세요.
*******************************************************
*/  

$merchantKey = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // 상점키
$MID         = "nicepay00m"; // 상점아이디
$goodsName   = "나이스페이"; // 결제상품명
$price       = "1004"; // 결제상품금액
$buyerName   = "나이스"; // 구매자명 
$buyerTel	 = "01000000000"; // 구매자연락처
$buyerEmail  = "happy@day.co.kr"; // 구매자메일주소        
$moid        =  time(); // 상품주문번호                     
$returnURL	 = "https://thetourlab.com/payment/result"; // 결과페이지(절대경로) - 모바일 결제창 전용

/*
*******************************************************
* <해쉬암호화> (수정하지 마세요)
* SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다. 
*******************************************************
*/ 
$ediDate    = date("YmdHis");
$hashString = bin2hex(hash('sha256', $ediDate.$MID.$price.$merchantKey, true));
?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(EUC-KR)</title>
<meta charset="utf-8">
<style>
	html,body {height: 100%;}
	form {overflow: hidden;}
</style>
<script src="https://pg-web.nicepay.co.kr/v3/common/js/nicepay-pgweb.js" type="text/javascript"></script>
<script type="text/javascript">
//결제창 최초 요청시 실행됩니다.
function nicepayStart(){
	goPay(document.payForm);
}

//[PC 결제창 전용]결제 최종 요청시 실행됩니다. <<'nicepaySubmit()' 이름 수정 불가능>>
function nicepaySubmit(){
	document.payForm.submit();
}

//[PC 결제창 전용]결제창 종료 함수 <<'nicepayClose()' 이름 수정 불가능>>
function nicepayClose(){
	alert("결제가 취소 되었습니다");
}
</script>
</head>
<body>
<form name="payForm" method="post" action="/payment/result">
	<table>
		<tr>
			<th>결제 수단</th>
			<td><input type="text" name="PayMethod" value=""></td>
		</tr>
		<tr>
			<th>결제 상품명</th>
			<td><input type="text" name="GoodsName" value="<?php echo($goodsName)?>"></td>
		</tr>
		<tr>
			<th>결제 상품금액</th>
			<td><input type="text" name="Amt" value="<?php echo($price)?>"></td>
		</tr>				
		<tr>
			<th>상점 아이디</th>
			<td><input type="text" name="MID" value="<?php echo($MID)?>"></td>
		</tr>	
		<tr>
			<th>상품 주문번호</th>
			<td><input type="text" name="Moid" value="<?php echo($moid)?>"></td>
		</tr> 
		<tr>
			<th>구매자명</th>
			<td><input type="text" name="BuyerName" value="<?php echo($buyerName)?>"></td>
		</tr>
		<tr>
			<th>구매자명 이메일</th>
			<td><input type="text" name="BuyerEmail" value="<?php echo($buyerEmail)?>"></td>
		</tr>		
		<tr>
			<th>구매자 연락처</th>
			<td><input type="text" name="BuyerTel" value="<?php echo($buyerTel)?>"></td>
		</tr>	 
		<tr>
			<th>인증완료 결과처리 URL<!-- (모바일 결제창 전용)PC 결제창 사용시 필요 없음 --></th>
			<td><input type="text" name="ReturnURL" value="<?php echo($returnURL)?>"></td>
		</tr>
		<tr>
			<th>가상계좌입금만료일(YYYYMMDD)</th>
			<td><input type="text" name="VbankExpDate" value=""></td>
		</tr>		
					
		<!-- 옵션 -->	 
		<input type="hidden" name="GoodsCl" value="1"/>						<!-- 상품구분(실물(1),컨텐츠(0)) -->
		<input type="hidden" name="TransType" value="0"/>					<!-- 일반(0)/에스크로(1) --> 
		<input type="hidden" name="CharSet" value="utf-8"/>				<!-- 응답 파라미터 인코딩 방식 -->
		<input type="hidden" name="ReqReserved" value=""/>					<!-- 상점 예약필드 -->
					
		<!-- 변경 불가능 -->
		<input type="hidden" name="EdiDate" value="<?php echo($ediDate)?>"/>			<!-- 전문 생성일시 -->
		<input type="hidden" name="SignData" value="<?php echo($hashString)?>"/>	<!-- 해쉬값 -->
	</table>
	<!--a href="#" class="btn_blue" onClick="nicepayStart();">요 청</a-->
</form>

<?php $this->endSection(); ?>