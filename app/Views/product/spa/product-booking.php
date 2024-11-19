<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <link rel="stylesheet" href="/css/tour/spa.css">
    <style>
        .input_qty {
            width: 50px !important;
            height: 40px;
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            padding: 10px !important;
        }

        .schedule .wrap-text {
            width: 50%;
        }

        .schedule .wrap-btn {
            width: 50%;
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
                    <div class="container-card">
                        <div class="form_booking_spa_">
                            <div class="card-left">
                                <h3 class="title-main-c title-main-2">
                                    예약확정서 정보 입력
                                </h3>
                                <h3 class="title-sub-c">예약확정서 이름</h3>
                                <div class="form-group mb-30">
                                    <label for="order_user_name">이름</label>
                                    <input type="text" id="order_user_name" name="order_user_name"/>
                                </div>
                                <h3 class="title-sub-c">연락처</h3>
                                <div class="form-group form-cus-select mb-30">
                                    <label for="email_name">이메일 주소*</label>
                                    <div class="cus-select-group">
                                        <input type="text" id="email_name" name="email_name" placeholder="이메일">
                                        <span>@</span>
                                        <select id="email_host" name="email_host" class="select-width">
                                            <option value="">선택해주세요.</option>
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
                                        </select>
                                    </div>
                                </div>
                                <div class="con-form mb-40">
                                    <div class="parent-form-group">
                                        <div class="form-group">
                                            <label for="order_user_mobile">휴대폰번호</label>
                                            <input type="text" id="order_user_mobile" name="order_user_mobile"
                                                   placeholder="번호를 입력해주세요."/>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('order_user_mobile').addEventListener('input', function (e) {
                                        let phone = e.target.value.replace(/\D/g, '');

                                        if (phone.length <= 3) {
                                            e.target.value = phone;
                                        } else if (phone.length <= 7) {
                                            e.target.value = `${phone.slice(0, 3)}-${phone.slice(3)}`;
                                        } else {
                                            e.target.value = `${phone.slice(0, 3)}-${phone.slice(3, 7)}-${phone.slice(7, 11)}`;
                                        }
                                    });
                                </script>
                            </div>

                            <div class="card-left card-left-2">
                                <h3 class="title-main-c">
                                    고객정보
                                </h3>
                                <!--                        <p class="title-sub-below">투숙객 이름은 체크인 시 제시할 유효한 신분증 이름과 정확히 일치해야 합니다.</p>-->
                                <?php
                                $adultQty = intval($adultQty);
                                for ($i = 1; $i <= $adultQty; $i++) {
                                    ?>
                                    <h3 class="title-sub-c mt-30">성인<?= $i ?></h3>
                                    <div class="form-container" data-group="group<?= $i ?>">
                                        <div class="con-form mb-40">
                                            <div class="parent-form-group">
                                                <div class="form-group">
                                                    <label for="first-a-name-<?= $i ?>">영문 이름(First Name) *</label>
                                                    <input type="text" id="first-a-name-<?= $i ?>"
                                                           name="order_a_first_name[]"
                                                           placeholder="영어로 작성해주세요."/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="last-a-name-<?= $i ?>">영문 성(Last Name) *</label>
                                                    <input type="text" id="last-a-name-<?= $i ?>"
                                                           name="order_a_last_name[]"
                                                           placeholder="영어로 작성해주세요."/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <!--                        <p class="title-sub-below">투숙객 이름은 체크인 시 제시할 유효한 신분증 이름과 정확히 일치해야 합니다.</p>-->
                                <?php
                                $childrenQty = intval($childrenQty);
                                for ($i = 1; $i <= $childrenQty; $i++) {
                                    ?>
                                    <h3 class="title-sub-c mt-30">아동<?= $i ?></h3>
                                    <div class="form-container" data-group="group<?= $i ?>">
                                        <div class="con-form mb-40">
                                            <div class="parent-form-group">
                                                <div class="form-group">
                                                    <label for="first-c-name-<?= $i ?>">영문 이름(First Name) *</label>
                                                    <input type="text" id="first-c-name-<?= $i ?>>"
                                                           name="order_c_first_name[]"
                                                           placeholder="영어로 작성해주세요."/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="last-c-name-<?= $i ?>">영문 성(Last Name) *</label>
                                                    <input type="text" id="last-c-name-<?= $i ?>"
                                                           name="order_c_last_name[]"
                                                           placeholder="영어로 작성해주세요."/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

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

                            <!--                    <div class="card-left2 card_left_bottom_">-->
                            <!--                        <h3 class="title-main-c">-->
                            <!--                            결제방법 선택-->
                            <!--                        </h3>-->
                            <!--                        <div class="form-group form-group-radio mb-40">-->
                            <!--                            <p>-->
                            <!--                                <input type="radio" id="test1" name="radio-group" checked>-->
                            <!--                                <label for="test1">신용카드/체크카드 결제</label>-->
                            <!--                            </p>-->
                            <!--                            <p class="">-->
                            <!--                                <input type="radio" id="test2" name="radio-group">-->
                            <!--                                <label for="test2">무통장 입금</label>-->
                            <!--                            </p>-->
                            <!--                        </div>-->
                            <!--                        <div class="form-group group-payment">-->
                            <!--                            <div class="payment-item only_web">-->
                            <!--                                <label for="">결제(입금)정보</label>-->
                            <!--                                <select name="" id="">-->
                            <!--                                    <option value="">신용/체크카드</option>-->
                            <!--                                </select>-->
                            <!--                            </div>-->
                            <!--                            <div class="payment-item">-->
                            <!--                                <label for="">결제(입금)정보</label>-->
                            <!--                                <div class="payment-input-wrap">-->
                            <!--                                    <input type="text" placeholder="입금자명">-->
                            <!--                                    <input type="text" placeholder="(주)마인갤러리">-->
                            <!--                                </div>-->
                            <!--                                <div class="payment-input-wrap">-->
                            <!--                                    <input type="text" placeholder="신한은행">-->
                            <!--                                    <input type="text" placeholder="100-036-005729">-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                        </div>-->
                            <!--                    </div>-->
                        </div>
                        <div class="">
                            <div class="card-right">
                                <img src="/data/hotel/<?= $prod['ufile1'] ?>" alt="customer-form.png">
                                <div class="below-right">
                                    <h3 class="title-r"><?= $prod['product_name'] ?></h3>
                                    <p class="title-sub-r text-gray">
                                        <?= $prod['addrs'] ?>
                                    </p>
                                    <h3 class="title-r">예약안내</h3>
                                    <div class="item-info" style="gap: 10px;">
                                        <span>일정: </span>
                                        <span><?= $day_ ?>(<span id="day_"></span>)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-right2 spa-detail">
                                <h3 class="title-r">
                                    여행인원 및 예약금액
                                </h3>
                                <div class="list_schedule_">
                                    <div class="schedule">
                                        <div class="wrap-text">
                                            <p>성인</p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span><?= $adultQty ?></span>
                                            <span>명</span>
                                        </div>
                                    </div>
                                    <div class="schedule">
                                        <div class="wrap-text">
                                            <p>아동</p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span><?= $childrenQty ?></span>
                                            <span>명</span>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="title-r">
                                    옵션선택
                                </h3>
                                <div class="select-wrap">
                                    <select name="moption" id="moption" onchange="sel_moption(this.value);">
                                        <option value="">옵션선택</option>
                                        <?php foreach ($moption as $op) { ?>
                                            <option value="<?= $op['code_idx'] ?>"><?= $op['moption_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="opt_select disabled sel_option" id="sel_option">
                                        <select name="option" id="option" onchange="sel_option(this.value);">";
                                            <option value="">옵션 선택</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="list_schedule_" id="option_list_">
                                    <?php
                                    if (isset($data['option_idx'])) {
                                        $num = count($data['option_idx']);
                                        for ($i = 0; $i < $num; $i++) {
                                            $item = $data['option_idx'][$i];
                                            ?>
                                            <div class="schedule" id="schedule_<?= $item ?>">
                                                <div class="wrap-text">
                                                    <span>옵션</span>
                                                    <p><?= $data['option_name'][$i] ?></p>
                                                </div>
                                                <div class="wrap-btn">
                                                    <img onclick="minusQty(this)" class="minusQty"
                                                         src="/images/sub/minus-ic.png"
                                                         alt="">
                                                    <span>
                                                <input style="text-align: center;" type="text"
                                                       class="form-control input_qty"
                                                       data-price="<?= $data['option_price'][$i] ?>"
                                                       id="input_qty[]" readonly value="<?= $data['option_qty'][$i] ?>">
                                                </span>
                                                    <img onclick="plusQty(this)" class="plusQty"
                                                         src="/images/sub/plus-ic.png"
                                                         alt="">
                                                </div>
                                                <div class="" style="display: none">
                                                    <input type="hidden" name="option_idx[]" value="<?= $item ?>">
                                                    <input type="hidden" name="option_price[]"
                                                           value="<?= $data['option_price'][$i] ?>">
                                                    <input type="hidden" name="option_tot[]" value="0">
                                                    <input type="hidden" name="option_cnt[]" value="0">
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="item-info-r font-bold-cus">
                                    <span>합계</span>
                                    <span><span id="textTotalPrice"><?= number_format($totalPrice) ?></span>원</span>
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
                                <p class="below-sub-des"><span class="color-blue">무료취소</span> / 결제 후 2024.09.01(일)
                                    18시(한국시간)
                                    이전
                                </p>
                                <span class="cus-label-r" id="policy_show" style="cursor: pointer">본 예약건 취소규정</span>
                                <h3 class="title-r">약관동의</h3>
                                <div class="item-info-check item_check_term_all_">
                                    <label for="fullagreement">전체동의</label>
                                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                                    <input type="hidden" value="N" id="fullagreement">
                                </div>
                                <div class="item-info-check item_check_term_">
                                    <label for="">이용약관 동의(필수)</label>
                                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                                    <input type="hidden" value="N" id="terms">
                                </div>
                                <div class="item-info-check item_check_term_">
                                    <label for="">개인정보 처리방침(필수)</label>
                                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                                    <input type="hidden" value="N" id="policy">
                                </div>
                                <div class="item-info-check item_check_term_">
                                    <label for="">개인정보 제3자 제공 및 국외 이전 동의(필수)</label>
                                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                                    <input type="hidden" value="N" id="information">
                                </div>
                                <div class="item-info-check item_check_term_">
                                    <label for="guidelines">여행안전수칙 동의(필수)</label>
                                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                                    <input type="hidden" value="N" id="guidelines">
                                </div>
                                <button class="btn-order btnOrder" onclick="completeOrder();" type="button">
                                    예약하기
                                </button>
                                <button class="btn-cancel btnCancel" type="button">취소하기</button>
                            </div>
                        </div>
                    </div>
                    <div class="" style="display: none;">
                        <input type="hidden" name="realTotal" id="realTotal" value="">

                        <input type="hidden" name="product_idx" id="product_idx" value="<?= $data['product_idx'] ?>">
                        <input type="hidden" name="day_" id="day_" value="<?= $day_ ?>">
                        <input type="hidden" name="adultQty" id="adultQty" value="<?= $adultQty ?>">
                        <input type="hidden" name="childrenQty" id="childrenQty" value="<?= $childrenQty ?>">
                        <input type="hidden" name="totalPrice" id="totalPrice" value="<?= $totalPrice ?>">

                        <!--                        <input type="hidden" name="realTotal" id="realTotal" value="">-->
                        <!--                        <input type="hidden" name="realTotal" id="realTotal" value="">-->
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

        $(document).ready(function () {
            let date = new Date('<?= $day_ ?>');
            let daysOfWeek = ['일', '월', '화', '수', '목', '금', '토'];
            let dayOfWeek = daysOfWeek[date.getUTCDay()];
            $('#day_').text(dayOfWeek);
        })

        $(document).ready(function () {
            $("#checkin, #checkout").datepicker({
                dateFormat: 'yy/mm/dd',
                onSelect: function (dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    $(this).val(formatDate(date));
                }
            });

            $('#checkin').val(formatDate('2024/07/09'));
            $('#checkout').val(formatDate('2024/07/10'));


            $('.tab_box_element_').on('click', function () {

                $('.tab_box_element_').removeClass('tab_active_');


                $(this).addClass('tab_active_');


                const tabId = $(this).attr('rel');
                $('.tab_content').hide();
                $('#' + tabId).show();
            });
        });

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('/');
        }

        function sel_moption(code_idx) {
            let url = `<?= route_to('api.product.sel_moption') ?>`;

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "product_idx": '<?= $prod['product_idx'] ?>',
                    "code_idx": code_idx
                },
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    $("#sel_option").html(data);
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        function sel_option(code_idx) {
            let url = `<?= route_to('api.product.sel_option') ?>`;
            let idx = code_idx.split("|")[0];

            let moption = $("#moption").val();

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "idx": idx,
                    "moption": moption
                },
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    let parent_name = data.parent_name;

                    let option_name = data.option_name;
                    let option_price = data.option_price;
                    let idx = data.idx;
                    let option_tot = data.option_tot ?? 0;
                    let option_cnt = data.option_cnt;

                    let htm_ = `<div class="schedule" id="schedule_${idx}">
                                    <div class="wrap-text">
                                        <span>${parent_name}</span>
                                        <p>${option_name}</p>
                                    </div>
                                    <div class="wrap-btn">
                                        <img onclick="minusQty(this)" class="minusQty" src="/images/sub/minus-ic.png" alt="">
                                        <span>
                                            <input style="text-align: center" data-price="${option_price}" readonly type="text" class="form-control input_qty" id="input_qty[]" value="1">
                                        </span>
                                        <img onclick="plusQty(this)" class="plusQty" src="/images/sub/plus-ic.png" alt="">
                                    </div>
                                </div>

                            <div class="" style="display: none">
                                       <input type="hidden" name="option_name[]" value="${option_name}">
                                       <input type="hidden" name="option_idx[]" value="${idx}">
                                       <input type="hidden" name="option_tot[]" value="${option_tot}">
                                       <input type="hidden" name="option_price[]" value="${option_price}">
                                       <input type="hidden" name="option_cnt[]" value="${option_cnt}">
                            </div>
                        </li>`;

                    let sel_option_ = $('#schedule_' + idx);
                    if (!sel_option_.length > 0) {
                        $("#option_list_").append(htm_);
                        calcTotal();
                    }
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }


        function minusQty(el) {
            let inp = $(el).parent().find('input.input_qty');

            let num = inp.val();
            if (Number(num) > 1) {
                num = Number(num) - 1;
                inp.val(num);
            } else {
                if (confirm('선택 항목을 지우시겠습니까?')) {
                    $(el).closest('.schedule').remove();
                }
            }
            calcTotal();
        }

        function plusQty(el) {
            let inp = $(el).parent().find('input.input_qty');
            let num = inp.val();
            num = Number(num) + 1;
            inp.val(num);
            calcTotal();
        }

        function calcTotal() {
            let realTotal = $('#realTotal').val();
            let optionTotal = 0;

            $('.input_qty').each(function () {
                let qty = $(this).val();
                let price = $(this).data('price');

                let total = Number(qty) * Number(price);

                optionTotal += total;
            })

            let total = Number(realTotal) + Number(optionTotal);

            $('#totalPrice').val(total);

            total = convertNum(total);
            $('#textTotalPrice').text(total);
        }

        getMainTotal();

        function getMainTotal() {
            let realTotal = 0;
            let optionTotal = 0;

            $('.input_qty').each(function () {
                let qty = $(this).val();
                let price = $(this).data('price');

                let total = Number(qty) * Number(price);

                optionTotal += total;
            })

            let mainTotal = $('#textTotalPrice').text();
            mainTotal = mainTotal.replaceAll(',', '');
            realTotal = mainTotal - optionTotal;

            $('#realTotal').val(realTotal);
        }

        function completeOrder() {
            $("#ajax_loader").removeClass("display-none");

            let fullagreement = $("#fullagreement").val().trim();
            let terms = $("#terms").val().trim();
            let policy = $("#policy").val().trim();
            let information = $("#information").val().trim();
            let guidelines = $("#guidelines").val().trim();

            if ([fullagreement, terms, policy, information, guidelines].includes("N")) {
                alert("모든 약관에 동의해야 합니다.");
                return false;
            }

            let formData = new FormData($('#formOrder')[0]);

            let url = `<?= route_to('api.spa_.handleBooking') ?>`;

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data, textStatus) {
                    console.log(data);
                    alert(data.message);
                    window.location.href = "/product-spa/completed-order";
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        }
    </script>

<?php $this->endSection(); ?>