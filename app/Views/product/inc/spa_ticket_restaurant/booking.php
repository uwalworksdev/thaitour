<link rel="stylesheet" href="/css/tour/spa.css">
<link rel="stylesheet" href="/css/tour/booking_spa.css">
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

                            $numAdultQty = 0;
                            foreach ($adultQty as $num) {
                                $numAdultQty += intval($num);
                            }

                            for ($i = 1; $i <= $numAdultQty; $i++) {
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

                            $numChildrenQty = 0;
                            foreach ($childrenQty as $num) {
                                $numChildrenQty += intval($num);
                            }

                            for ($i = 1; $i <= $numChildrenQty; $i++) {
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

                        <div class="card-left card-left-2 coupon_area_">
                            <h3 class="label">할인혜택</h3>

                            <div class="use_coupon flex__c">
                                <p class="ttl">쿠폰 사용</p>
                                <div class="val input-row">
                                    <input type="text" name="coupon" id="coupon_price" class="bs-input" readonly="">
                                </div>
                                <div class="flex__c">
                                    <button type="button" onclick="openCouPon();">쿠폰조회</button>
                                    <p class="note">사용 (사용가능 쿠폰 : 0 장)</p>
                                </div>
                            </div>

                            <div class="use_point flex__c">
                                <p class="ttl">포인트 사용</p>
                                <div class="val input-row">
                                    <input type="text" name="point" id="point_price" class="bs-input"
                                           onkeyup="point_acnt();">
                                </div>
                                <div class="flex__c">
                                    <button type="button" onclick="point_all();">모두사용</button>
                                    <p class="note">(사용가능 포인트 : 0 점 / 5,000 포인트 이상부터 사용가능)</p>
                                </div>
                            </div>
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
                                <?php foreach ($adultQty as $key => $val) { ?>
                                    <div class="schedule">
                                        <div class="wrap-text">
                                            <p>성인<?= $key + 1 ?> x <?= $val ?></p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span><?= number_format($adultPrice[$key] * $val) ?></span>
                                            <span>원</span>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php foreach ($childrenQty as $key => $val) { ?>
                                    <div class="schedule">
                                        <div class="wrap-text">
                                            <p>아동<?= $key + 1 ?> x <?= $val ?></p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span><?= number_format($childrenPrice[$key] * $val) ?></span>
                                            <span>원</span>
                                        </div>
                                    </div>
                                <?php } ?>
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
                                                       class="form-control input_qty" name="option_qty[]"
                                                       data-price="<?= $data['option_price'][$i] ?>"
                                                       id="input_qty" readonly value="<?= $data['option_qty'][$i] ?>">
                                                </span>
                                                <img onclick="plusQty(this)" class="plusQty"
                                                     src="/images/sub/plus-ic.png"
                                                     alt="">
                                            </div>
                                            <div class="" style="display: none">
                                                <input type="hidden" name="option_idx[]" value="<?= $item ?>">
                                                <input type="hidden" name="option_name[]"
                                                       value="<?= $data['option_name'][$i] ?>">
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

                            <div class="item-info-r font-bold-cus" style="color: rgba(255,0,0,0.75)">
                                <span>쿠폰 </span>
                                <span>0원</span>
                            </div>
                            <div class="item-info-r font-bold-cus" style="color: rgba(255,0,0,0.75)">
                                <span>포인트 </span>
                                <span>0원</span>
                            </div>
                            <div class="item-info-r font-bold-cus">
                                <span>합계</span>
                                <span><span class="textTotalPrice"><?= number_format($totalPrice) ?></span>원</span>
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
                    <input type="hidden" name="order_gubun" id="order_gubun" value="<?= $order_gubun ?>">

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
<div class="couponplus_pop">
    <div class="coupon_popup">
        <form name="discountForm" id="discountForm">
            <input type="hidden" name="c_idx" id="c_idx" value="">
            <input type="hidden" name="ori_total" id="ori_total" value="730000">
            <input type="hidden" name="dis_coupon" id="dis_coupon" value="0">
            <input type="hidden" name="last_coupon" id="last_coupon" value="0">
            <input type="hidden" name="all_point" id="all_point" value="0">
            <input type="hidden" name="dis_point" id="dis_point" value="0">

            <div class="pop_boxs">
                <div class="cu_head">
                    <h2>쿠폰할인 적용</h2>
                    <button type="button" onclick="cuPopupClose()">
                        <img src="/images/ico/close_icon_popup.png" alt="닫기 버튼">
                    </button>
                </div>
                <div class="cu_body">
                    <div class="cu_item_wrap">
                        <div class="item_info">
                            <div class="info_wrap">
                                <div class="thumb">
                                    <span>
                                        <img alt="" src="/data/hotel/<?= $prod['ufile1'] ?>">
                                    </span>
                                </div>
                                <div class="info_box">
                                    <div class="subject">
                                        <?= $prod['product_name'] ?>
                                    </div>
                                    <div class="otp">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="cal_box">
                            <li>
                                <div class="label">
                                    상품 판매가
                                </div>
                                <div class="price">
                                    <strong>
                                        <span class="total_product_price textTotalPrice"><?= number_format($totalPrice) ?></span>원
                                    </strong>
                                </div>
                            </li>
                            <li>
                                <div class="label">
                                    할인 금액
                                </div>
                                <div class="price">
                                    <b><span id="_coupon_amt">원</span></b>
                                </div>
                            </li>
                            <li>
                                <div class="label">
                                    쿠폰 적용가
                                </div>
                                <div class="price">
                                    <b><span id="coupon_last">원</span></b>
                                </div>
                            </li>
                        </ul>
                        <div class="culi_tit">
                            적용가능 쿠폰
                        </div>
                        <div class="culi_wrap">
                            <select name="coupon_grp" class="cpselect" onchange="sel_coupon(this.value);">
                                <option value="">적용 안함</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="cal_it();" class="cu_btn">적용하기</button>
            </div>
        </form>
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
                                            <input style="text-align: center" data-price="${option_price}" readonly type="text" class="form-control input_qty"
                                                    name="option_qty[]" id="input_qty" value="1">
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
        $('.textTotalPrice').html(total);
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

        let mainTotal = $('.textTotalPrice').html();
        mainTotal = mainTotal.replaceAll(',', '');
        realTotal = mainTotal - optionTotal;

        $('#realTotal').val(realTotal);
    }

    function price_account() {

    }

    function sel_coupon(idx) {
        $("#c_idx").val(idx);
        $("#dis_point").val($("#used_mileage_money").val());

        let f = document.discountForm;

        let dis_coupon = "";
        let dis_point = "";
        let coupon_last = "";

        let real_price = "";

        let url = ``;

        let dis_data = $(f).serialize();
        let save_result = "";
        $.ajax({
            type: "POST",
            data: dis_data,
            url: url,
            cache: false,
            async: false,
            success: function (data, textStatus) {
                save_result = data;
                let obj = jQuery.parseJSON(save_result);
                let dis_coupon = obj.dis_coupon;
                let dis_point = obj.dis_point;
                let coupon_last = obj.coupon_last;
                let coupon_num = obj.coupon_num;

                real_price = parseInt($("#order_price").val()) - parseInt(dis_coupon);

                if (parseInt(dis_coupon) > parseInt(real_price)) {
                    $("#coupon_idx").val('');
                    alert("ê²°ì œ ê¸ˆì•¡ ë³´ë‹¤ ì¿ í° í• ì¸ì•¡ì´ í´ ê²½ìš° ì¿ í°ì„ ì‚¬ìš©í•  ìˆ˜ ì—†ìŠµë‹ˆë‹¤.");
                } else {
                    $("#coupon_idx").val(idx);
                    $("#dis_coupon").val(dis_coupon);
                    $("#dis_point").val(dis_point);
                    $("#last_coupon").val(coupon_last);
                    $("#used_coupon_no").val(coupon_num);
                    $("#used_coupon_money").val(dis_coupon);

                    $("#_coupon_amt").text(number_format(dis_coupon) + 'ì›');
                    $("#coupon_last").text(number_format(coupon_last) + 'ì›');
                    $("#total_point").text(number_format(dis_coupon + dis_point));
                    $("#order_price").val(coupon_last);
                    $("#price_tot").text(number_format(coupon_last));
                    $("#coupon_price").val(number_format(dis_coupon));
                }
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // ì‹¤íŒ¨ ì‹œ ì²˜ë¦¬
            }
        });

        price_account();

    }

    function number_format(number, decimals = 0, dec_point = '.', thousands_sep = ',') {
        number = parseFloat(number).toFixed(decimals);
        number = number.toString().replace('.', dec_point);
        let parts = number.split(dec_point);
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
        return parts.join(dec_point);
    }

    function cal_it() {
        cuPopupClose();
    }

    function cuPopupClose() {
        $('.couponplus_pop').hide();
    }

    function openCouPon() {
        $('.couponplus_pop').show();
    }

    function point_acnt() {

    }

    function point_all() {
        alert('point_acnt all');
    }
</script>