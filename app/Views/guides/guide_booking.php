<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <link rel="stylesheet" href="/css/tour/spa.css">
    <link rel="stylesheet" href="/css/tour/booking_spa.css">
    <style>
        .arrow_menu {
            cursor: pointer;
            transform: rotate(0deg);
        }

        .arrow_menu.open_ {
            transform: rotate(180deg);
        }

        .form-container {
            display: none;
        }

        .form-container.show_ {
            display: block;
        }

        .customer-form-page .day_activity_ .title-sub-c {
            margin-bottom: 0;
        }
    </style>
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
                    <div class="item-n inactive">
                    <span class="number-n">
                        3
                    </span>
                        <span class="label-n">결제</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-section">
            <div class="body_inner">
                <form action="#" class="formOrder" id="formOrder">
                    <input type="hidden" name="order_status" id="order_status" value="W">
                    <div class="container-card">
                        <div class="form_booking_spa_">
                            <div class="card-left2 ">
                                <div class="flex" style="gap: 20px">
                                    <h3 class="title-main-c">
                                        예약확정서 정보 입력
                                    </h3>
                                    <div class="bs-input-check">
                                        <input type="checkbox" id="save_id" name="save_id" value="Y">
                                        <label for="save_id"> 회원정보와 동일</label>
                                    </div>
                                </div>
                                <h3 class="title-sub-c">예약확정서 이름</h3>
                                <div class="con-form mb-40">
                                    <div class="form-group">
                                        <label for="order_user_name">한국이름</label>
                                        <input type="text" id="order_user_name" name="order_user_name" required=""
                                               data-label="한국이름" placeholder="한국이름 작성해주세요.">
                                    </div>
                                    <div class="form-group" style="width: 50%">
                                        <label for="gender1">성별(남성/여성)*</label>
                                        <select name="companion_gender" id="gender1" style="width: 100%" required=""
                                                data-label="성별" class="select-width">
                                            <option value="M">남성</option>
                                            <option value="F">여성</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="con-form mb-40">
                                    <div class="form-group">
                                        <label for="order_user_first_name_en">영문 이름(First Name) *</label>
                                        <input type="text" id="order_user_first_name_en" name="order_user_first_name_en"
                                               required="" data-label="영문 이름" placeholder="영어로 작성해주세요.">
                                    </div>
                                    <div class="form-group">
                                        <label for="order_user_last_name_en">영문 성(Last Name) *</label>
                                        <input type="text" id="order_user_last_name_en" name="order_user_last_name_en"
                                               required="" data-label="영문 성" placeholder="영어로 작성해주세요.">
                                    </div>
                                </div>
                                <h3 class="title-sub-c">연락처</h3>
                                <div class="form-group form-cus-select">
                                    <label for="passport-name2">이메일 주소*</label>
                                    <div class="cus-select-group">
                                        <input type="text" id="email_1" name="email_1" required="" data-label="이메일"
                                               placeholder="이메일">
                                        <span>@</span>
                                        <div class="email-group">
                                            <input type="text" name="email_2" id="email_2" required="" data-label="이메일"
                                                   placeholder="" readonly="">
                                            <select id="" class="select-width" onchange="handleEmail(this.value)">
                                                <option value="">선택</option>
                                                <option value="naver.com">naver.com</option>
                                                <option value="hanmail.net">hanmail.net</option>
                                                <option value="hotmail.com">hotmail.com</option>
                                                <option value="nate.com">nate.com</option>
                                                <option value="yahoo.co.kr">yahoo.co.kr</option>
                                                <option value="empas.com">empas.com</option>
                                                <option value="dreamwiz.com">dreamwiz.com</option>
                                                <option value="freechal.com">freechal.com</option>
                                                <option value="lycos.co.kr">lycos.co.kr</option>
                                                <option value="korea.com">korea.com</option>
                                                <option value="gmail.com">gmail.com</option>
                                                <option value="hanmir.com">hanmir.com</option>
                                                <option value="paran.com">paran.com</option>
                                                <option value="1">직접입력</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone_wrap mb-30">
                                    <div class="phone_wrap_item form-group">
                                        <p>
                                            <input type="radio" id="test1" name="radio_phone" value="kor" checked="">
                                            <label for="test1">한국번호*</label>
                                        </p>
                                        <div class="form-group form-group-cus-4input">
                                            <input name="phone_1" maxlength="3" class="phone_kor phone" type="text"
                                                   id="phone_1" required="" data-label="한국번호">
                                            <span> - </span>
                                            <input name="phone_2" maxlength="4" class="phone_kor phone" type="text"
                                                   id="phone_2" required="" data-label="한국번호">
                                            <span> - </span>
                                            <input name="phone_3" maxlength="4" class="phone_kor phone" type="text"
                                                   id="phone_3" required="" data-label="한국번호">
                                        </div>
                                    </div>
                                    <div class="phone_wrap_item form-group">
                                        <p>
                                            <input type="radio" id="test2" name="radio_phone" value="thai">
                                            <label for="test2">태국번호 *</label>
                                        </p>
                                        <div class="form-group">
                                            <input name="phone_thai" maxlength="10" class="phone_thai phone" type="text"
                                                   id="phone_thai" disabled="" required="" data-label="한국번호">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mo_mt-30">
                                    <label for="passport-name2">여행시 현지 연락처</label>
                                    <div class="form-group-flex" style="display: flex; align-items: center; gap: 20px">
                                        <select id="car-time-hour" class="select-width" style="width: 200px">
                                            <option value="01">TH</option>
                                        </select>
                                        <input name="local_phone" class="phone" maxlength="10" type="text"
                                               id="local_phone"
                                               placeholder="">
                                    </div>
                                </div>
                            </div>

                            <?php for ($i = 0; $i < $days_difference; $i++) { ?>
                                <div class="card-left card-left-2" style="">
                                    <div class="" style="">
                                        <div class="day_activity_ w_100 d_flex justify_content_between align_items_center">
                                            <h3 class="title-sub-c">
                                                <?= $i + 1 ?> 일차 일정을 입력해주세요
                                            </h3>
                                            <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu open_"
                                                 alt="arrow_up" style="">
                                        </div>
                                        <div class="form-container show_ mt--30">
                                            <div class="con-form">
                                                <div class="parent-form-group mb--25">
                                                    <div class="form-group">
                                                        <label for="first-a-name-1">가이드미팅시간</label>
                                                        <div class="d_flex justify_content_between align_items_center gap_10">
                                                            <div class="fl mr5">
                                                                <select class="selectric"
                                                                        name="guideMeetingHour[]"
                                                                        id="guideMeetingHour<?= $i + 1 ?>">
                                                                    <option value="00" selected="selected">00 AM
                                                                    </option>
                                                                    <option value="01">01 AM</option>
                                                                    <option value="02">02 AM</option>
                                                                    <option value="03">03 AM</option>
                                                                    <option value="04">04 AM</option>
                                                                    <option value="05">05 AM</option>
                                                                    <option value="06">06 AM</option>
                                                                    <option value="07">07 AM</option>
                                                                    <option value="08">08 AM</option>
                                                                    <option value="09">09 AM</option>
                                                                    <option value="10">10 AM</option>
                                                                    <option value="11">11 AM</option>
                                                                    <option value="12">12 PM</option>
                                                                    <option value="13">13 PM</option>
                                                                    <option value="14">14 PM</option>
                                                                    <option value="15">15 PM</option>
                                                                    <option value="16">16 PM</option>
                                                                    <option value="17">17 PM</option>
                                                                    <option value="18">18 PM</option>
                                                                    <option value="19">19 PM</option>
                                                                    <option value="20">20 PM</option>
                                                                    <option value="21">21 PM</option>
                                                                    <option value="22">22 PM</option>
                                                                    <option value="23">23 PM</option>
                                                                </select>
                                                            </div>
                                                            <span class="p_txt01 mr10">시</span>
                                                            <div class="fl mr5">
                                                                <select class="selectric"
                                                                        name="guideMeetingMin[]"
                                                                        id="guideMeetingMin<?= $i + 1 ?>">
                                                                    <option value="00" selected="selected">00</option>
                                                                    <option value="10">10</option>
                                                                    <option value="20">20</option>
                                                                    <option value="30">30</option>
                                                                    <option value="40">40</option>
                                                                    <option value="50">50</option>
                                                                </select>
                                                            </div>
                                                            <span class="p_txt01 mr10">분</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group w_100 mb--25">
                                                    <label for="guideMeetingPlace<?= $i + 1 ?>">미팅 장소</label>
                                                    <input type="text" id="guideMeetingPlace<?= $i + 1 ?>" class="w_100"
                                                           name="guideMeetingPlace[]" style="width: 100%;"
                                                           placeholder="영어로 작성해주세요.">
                                                </div>
                                                <div class="form-group w_100 mb--25">
                                                    <label for="guideSchedule<?= $i + 1 ?>">예상일정</label>
                                                    <textarea name="guideSchedule[]"
                                                              class="w_100" id="guideSchedule<?= $i + 1 ?>"
                                                              style="padding: 5px; height: 100px"></textarea>
                                                </div>
                                                <div class="form-group w_100 mb--25">
                                                    <label for="requestMemo<?= $i + 1 ?>">기타 요청</label>
                                                    <textarea class="w_100" name="requestMemo[]"
                                                              style="padding: 5px; height: 100px"
                                                              id="requestMemo<?= $i + 1 ?>"
                                                              placeholder=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <script>
                                $('.arrow_menu').click(function () {
                                    $(this).toggleClass('open_');

                                    let container = $(this).parent().next();
                                    container.toggleClass('show_')
                                })
                            </script>

                            <div class="card-left2 card_left_bottom_">
                                <h3 class="title-main-c">
                                    별도 요청
                                </h3>
                                <p class="title-sub-below">숙소는 최선을 다해 요청 사항을 제공해 드릴 수 있도록 최선을 다하겠습니다. 다만, 사정에 따라 제공 여부가
                                    보장되지
                                    않을 수 있습니다.</p>
                                <div class="form-group cus-form-group">
                                    <textarea id="extra-requests" name="order_memo"
                                              placeholder="여기에 요청 사항을 입력하세요(선택사항)"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="">
                            <div class="card-right">
                                <img src="/uploads/guides/<?= $product['ufile1'] ?>" alt="customer-form.png">
                                <div class="below-right">
                                    <h3 class="title-r">
                                        <?= $product['product_name'] ?>
                                    </h3>
                                    <p class="title-sub-r text-gray" style="margin-bottom: 10px;">
                                        <?= $option['o_availability'] ?>
                                    </p>
                                    <?php foreach ($sup_options as $item): ?>
                                        <p class="title-sub-r text-gray" style="margin-bottom: 10px;">
                                            <?= $item['s_name'] ?>
                                        </p>
                                    <?php endforeach; ?>
                                    <h3 class="title-r" style="margin-top: 30px">예약안내</h3>
                                    <div class="item-info" style="gap: 10px;width: 100%;">
                                        <span>기간: </span>
                                        <span id="start_date"></span> ~
                                        <span <span id="end_date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-right2 spa-detail">
                                <h3 class="title-r">
                                    여행인원 및 예약금액
                                </h3>
                                <div class="list_schedule_">
                                    <div class="schedule schedule_booking">
                                        <div class="wrap-text">
                                            <p>성인 x <?= $people_cnt ?></p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span> <?= number_format($totalPrice_won) ?> </span>
                                            <span> 원</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="list_schedule_" id="option_list_">
                                </div>

                                <div class="item-info-r font-bold-cus" style="color: rgba(255,0,0,0.75); display: none">
                                    <span>쿠폰 </span>
                                    <span>- <span class="discountPrice">0</span> 원</span>
                                </div>
                                <div class="item-info-r font-bold-cus" style="color: rgba(255,0,0,0.75); display: none">
                                    <span>포인트 </span>
                                    <span>- <span class="pointPrice">0</span> 원</span>
                                </div>
                                <div class="item-info-r font-bold-cus">
                                    <span>합계</span>
                                    <span><span class="textTotalPrice lastPrice"><?= number_format($totalPrice_won) ?> </span> 원</span>
                                </div>
                                <p class="below-des-price">
                                    · 견적서를 받으신 후 결제해 주시면 결제 확인 후 해당
                                    업체에 확정 요청을 합니다. 즉시 확정 상품은 결제해
                                    주시면 확정 처리됩니다.
                                </p>
                                <div class="below-title-image">
                                    <img class="only_web" src="/uploads/icons/block_icon.png" alt="block_icon">
                                    <img class="only_mo" src="/uploads/icons/block_icon_mo.png" alt="block_icon">
                                    <span>취소규정</span>
                                </div>
                                <p class="below-sub-des">
                                    <span class="color-blue" id="policy_show"
                                          style="cursor: pointer">무료취소</span> / 결제 후 2024.09.01(일)
                                    18시(한국시간) 이전
                                </p>

                                <button class="btn-order btnOrder" onclick="completeOrder('W');" type="button">예약하기
                                </button>
                                <button class="btn-order btnOrder" onclick="completeOrder('B');" type="button">장바구니 담기
                                </button>
                                <button class="btn-cancel btnCancel" onclick="cancelOrder();" type="button">취소하기
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="" style="display: none;">
                        <input type="hidden" name="product_idx" id="product_idx" value="<?= $product['product_idx'] ?>">
                        <input type="hidden" name="totalPrice" id="totalPrice" value="<?= $totalPrice ?>">
                        <input type="hidden" name="order_gubun" id="order_gubun" value="guide">
                        <input type="hidden" name="start_date" id="start_date" value="<?= $start_day ?>">
                        <input type="hidden" name="end_date" id="end_date" value="<?= $end_day ?>">
                        <input type="hidden" name="people_cnt" id="people_cnt" value="<?= $people_cnt ?>">
                        <input type="hidden" name="option_idx" id="option_idx" value="<?= $o_idx ?>">
                    </div>
                </form>
            </div>
        </div>

        <div class="popup_wrap place_pop policy_pop">
            <div class="pop_box">
                <button type="button" class="close" onclick="closePopup()"></button>
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
        function closePopup() {
            $(".popup_wrap").hide();
            $(".dim").hide();
        }

        $("#policy_show").on("click", function () {
            $(".policy_pop, .policy_pop .dim").show();
        });

        $(document).ready(function () {
            $("#save_id").click(function () {
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

            $("input[name='radio_phone'").change(function () {
                if ($(this).val() == 'kor') {
                    $(".phone_kor").attr("disabled", false).eq(0).focus();
                    $(".phone_thai").attr("disabled", true);
                } else {
                    $(".phone_thai").attr("disabled", false).focus();
                    $(".phone_kor").attr("disabled", true);
                }
            })
        })

        function changeStartDate() {
            let date = `<?= $start_day ?>`;
            date = formatDateWithKoreanWeekday(date);
            $('#start_date').text(date);
        }

        function changeEndDate() {
            let date = `<?= $end_day ?>`;
            date = formatDateWithKoreanWeekday(date);
            $('#end_date').text(date);
        }

        document.addEventListener("DOMContentLoaded", function (event) {
            changeStartDate();
            changeEndDate();
        });

        function formatDateWithKoreanWeekday(dateString) {
            const date = new Date(dateString);
            const options = {
                weekday: 'short'
            };
            const koreanWeekday = new Intl.DateTimeFormat('ko-KR', options).format(date);
            return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}(${koreanWeekday})`;
        }

        function handleEmail(email) {
            if (email == '1') {
                $("#email_2").val('').prop('readonly', false).focus();
            } else {
                $("#email_2").val(email).prop('readonly', true);
            }
        }

        function completeOrder(status) {
            let apiUrl = `<?= route_to('api.guide.handeBooking') ?>`;

            $('#order_status').val(status);

            let formData = new FormData($('#formOrder')[0])

            $.ajax(apiUrl, {
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    alert(response.message);
                    $("#ajax_loader").addClass("display-none");
                    window.location.href = 'guide/complete-booking';
                },
                error: function (request, status, error) {
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
            })
        }
    </script>
<?php $this->endSection(); ?>