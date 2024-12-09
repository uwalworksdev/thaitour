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

                                            <button class="btn_" type="button" onclick="fn_show_bank();">한국계좌번호 보기</button>
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

                                            <button class="btn_" type="button" onclick="fn_show_bank();">한국계좌번호 보기</button>
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
                        <button class="btn-order btnOrder" onclick="completeOrder();" type="button">
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

<script>
    $(document).ready(function () {

        $("#save_id").click(function () {
            if ($(this).is(":checked")) {
                $("#order_user_name").val(`<?=session("member.name")?>`);
                const email = `<?=session("member.email")?>`;
                const emailArr = email.split("@");
                $("#email_1").val(emailArr[0] ?? "");
                $("#email_2").val(emailArr[1] ?? "");
                const phone = `<?=session("member.phone")?>`;
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

        $(".phone").on("input", function () {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        });

        $('.tab_box_element_').on('click', function () {
            $('.tab_box_element_').removeClass('tab_active_');

            $(this).addClass('tab_active_');

            const tabId = $(this).attr('rel');
            $('.tab_content').hide();
            $('#' + tabId).show();
        });

        $(".item-clause-all").click(function () {
            if ($(this).hasClass("click")) {
                $(this).removeClass("click");
                $('.item-clause-item').each(function () {
                    $(this).removeClass("acti");
                    $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
                })
            } else {
                $(this).addClass("click");
                $('.item-clause-item').each(function () {
                    $(this).addClass("acti");
                    $(this).find("img").attr("src", "/images/btn/clause-check-black.png");
                })
            }
        });

        $(".item-clause-item").click(function () {
            if ($(this).hasClass("acti")) {
                $(this).removeClass("acti");
                $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
            } else {
                $(this).addClass("acti");
                $(this).find("img").attr("src", "/images/btn/clause-check-black.png");
            }

            var allHaveActi = true;

            $('.item-clause-item').each(function () {
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

        $("input[name='radio_phone'").change(function () {
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

    $("#policy_show").on("click", function () {
        $(".policy_pop, .policy_pop .dim").show();
    });

    $('.item_check_term_').click(function () {
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

        $('.item_check_term_').each(function () {
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

    $('.item_check_term_all_').click(function () {
        $(this).toggleClass('checked_');
        let allChecked = $(this).hasClass('checked_');
        let value = allChecked ? 'Y' : 'N';
        $(this).find('input').val(value);

        $('.item_check_term_').each(function () {
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
</script>
<?php $this->endSection(); ?>
