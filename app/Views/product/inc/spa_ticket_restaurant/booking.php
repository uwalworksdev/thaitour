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
            <form action="#" class="formOrder" id="formOrder" method="post" >
			<input type="hidden" name="order_status" id="order_status" value="W" >
			<input type="hidden" name="feeVal" id="feeVal" value="<?=$_SESSION['data_cart']['feeVal']?>" >
            <input type="hidden" name="time_line" id="time_line" value="<?= $data["time_line"] ?>">
                <div class="container-card">
                    <div class="form_booking_spa_">
                        <div class="card-left2">
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
                                            data-label="성별"
                                            class="select-width">
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
                                    <input name="local_phone" class="phone" maxlength="10" type="text" id="local_phone"
                                           placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="card-left card-left-2" style="display:  none">
                            <div class="" style="display:  none">
                                <?php

                                $numAdultQty = 0;
                                $s_station_arr = [];
                                foreach ($adultQty as $key => $num) {
                                    $numAdultQty += intval($num);
                                    for ($i = 1; $i <= intval($num); $i++) {
                                        $s_station_arr[] = $s_station[$key];
                                    }
                                }

                                for ($i = 1; $i <= $numAdultQty; $i++) {
                                    ?>
                                    <h3 class="title-sub-c mt-30">성인<?= $i ?> <span
                                                class="text_divider"></span> <?= $s_station_arr[$i - 1] ?></h3>
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
                        </div>

                        <div class="card-left card-left-2 coupon_area_" style="display:  none">
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
                            <img src="/data/product/<?= $prod['ufile1'] ?>" alt="customer-form.png">
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
                                <?php
                                    if($prod["product_code_1"] == "1325" || $prod["product_code_1"] == "1320"){
                                ?>
                                    <div class="item-info" style="gap: 10px;">
                                        <span>예약시간: </span>
                                        <span><?= $data["time_line"] ?></span>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="card-right2 spa-detail">
                            <h3 class="title-r">
                                여행인원 및 예약금액
                            </h3>
                            <div class="list_schedule_">
                                <?php foreach ($adultQty as $key => $val) { ?>
                                    <div class="schedule schedule_booking">
                                        <div class="wrap-text">
                                            <p>성인<?= $key + 1 ?> x <?= $val ?></p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span><?= number_format((int)$adultPrice[$key] * (int)$val) ?></span>
                                            <span> 원</span>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php foreach ($childrenQty as $key => $val) { ?>
                                    <div class="schedule">
                                        <div class="wrap-text">
                                            <p>아동<?= $key + 1 ?> x <?= $val ?></p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span><?= number_format((int)$childrenPrice[$key] * (int)$val) ?></span>
                                            <span> 원</span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <div style="display: none">
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
                                <span><span class="textTotalPrice lastPrice"><?= number_format($totalPrice) ?></span> 원</span>
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

                            <?php if($prod['direct_payment'] == "Y") { ?>
							<span style="color:red;">※ 예약확정 상품입니다.</span>
                            <button class="btn-order btnOrder" onclick="completePayment('B');" type="button">결제하기</button>
							<?php } else { ?>
                            <button class="btn-order btnOrder" onclick="completeOrder('W');" type="button">예약하기</button>
							<?php } ?>
                            <button class="btn-order btnOrder" onclick="completeOrder('B');" type="button">장바구니 담기</button>
                            <button class="btn-cancel btnCancel" onclick="cancelOrder();" type="button">취소하기</button>
                        </div>
                    </div>
                </div>
                <div class="" style="display: none;">
                    <input type="hidden" name="realTotal" id="realTotal" value="">

                    <input type="hidden" name="product_idx" id="product_idx" value="<?= $data['product_idx'] ?>">
                    <input type="hidden" name="day_" id="day_" value="<?= $day_ ?>">
                    <input type="hidden" name="adultQty" id="adultQty" value="<?= implode(',', $adultQty ?? []) ?>">
                    <input type="hidden" name="adultPrice" id="adultPrice" value="<?= implode(',', $adultPrice ?? []) ?>">

                    <input type="hidden" name="childrenQty" id="childrenQty" value="<?= implode(',', $childrenQty ?? []) ?>">
                    <input type="hidden" name="childrenPrice" id="childrenPrice" value="<?= implode(',', $childrenPrice ?? []) ?>">

                    <input type="hidden" name="totalPrice" id="totalPrice" value="<?= $totalPrice ?>">
                    <input type="hidden" name="order_gubun" id="order_gubun" value="<?= $order_gubun ?>">

                    <input type="hidden" name="discountPrice" id="discountPrice" value="0">
                    <input type="hidden" name="pointPrice" id="pointPrice" value="0">
                    <input type="hidden" name="lastPrice" id="lastPrice" value="<?= $totalPrice ?>">

                    <input type="hidden" name="c_idx" id="c_idx" value="">
                    <input type="hidden" name="all_point" id="all_point" value="0">

                    <input type="hidden" name="coupon_no" id="coupon_no" value="">
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
                                        <img alt="" src="/data/product/<?= $prod['ufile1'] ?>">
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
                                        <span class="total_product_price textTotalPrice"><?= number_format($totalPrice) ?></span> 원
                                    </strong>
                                </div>
                            </li>
                            <li>
                                <div class="label">
                                    할인 금액
                                </div>
                                <div class="price">
                                    <b><span id="_coupon_amt">0</span> 원</b>
                                </div>
                            </li>
                            <li>
                                <div class="label">
                                    쿠폰 적용가
                                </div>
                                <div class="price">
                                    <b><span id="coupon_last">0</span> 원</b>
                                </div>
                            </li>
                        </ul>
                        <div class="culi_tit">
                            적용가능 쿠폰
                        </div>
                        <div class="culi_wrap">
                            <select name="coupon_grp" class="cpselect" onchange="sel_coupon(this.value);">
                                <option value="">적용 안함</option>
                                <?php
                                foreach ($coupons as $coupon) {
                                    if ($coupon["dc_type"] == "P") {
                                        $discount = $coupon["coupon_pe"] . "%";
                                        $dis = $coupon["coupon_pe"];
                                    } else if ($coupon["dc_type"] == "D") {
                                        $discount = number_format($coupon["coupon_price"]) . " 원";
                                        $dis = $coupon["coupon_price"];
                                    } else {
                                        $discount = "회원등급에 따름";
                                        $dis = 0;
                                    }
                                    ?>
                                    <option value="<?= $coupon['c_idx'] ?>"><?= $coupon['coupon_name'] ?></option>
                                <?php } ?>
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

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('/');
        }

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
</script>
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
        $('#lastPrice').val(total);

        let discountPrice = $('#discountPrice').val();
        let pointPrice = $('#pointPrice').val();

        total = Number(total) - Number(discountPrice) - Number(pointPrice);

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
        let discountPrice = $('#discountPrice').val();
        let pointPrice = $('#pointPrice').val();
        let lastPrice = $('#lastPrice').val();

        $('.discountPrice').html(number_format(discountPrice));
        $('.pointPrice').html(number_format(pointPrice));
        $('.lastPrice').html(number_format(lastPrice));
    }

    async function sel_coupon(idx) {
        let url = `<?= route_to('api.product.sel_coupon') ?>`;

        let dis_data = {
            "idx": idx,
        };

        await $.ajax({
            type: "POST",
            data: dis_data,
            url: url,
            cache: false,
            async: false,
            success: function (data, textStatus) {
                console.log(data)
                let totalPrice = $('#totalPrice').val();
                let discountPrice = 0;
                let name = '';
                let coupon_no = '';
                let c_idx = '';
                if (data) {
                    if (data.coupon_pe && data.coupon_pe !== '') {
                        discountPrice = Number(totalPrice) * Number(data.coupon_pe) / 100;
                    } else if (data.coupon_price && data.coupon_price !== '') {
                        discountPrice = Number(data.coupon_price);
                    }

                    name = data.coupon_name;
                    coupon_no = data.coupon_num;
                    c_idx = data.c_idx;
                }

                let lastPrice = Number(totalPrice) - Number(discountPrice);

                $('#_coupon_amt').html(number_format(discountPrice));
                $('#coupon_last').html(number_format(lastPrice));

                $('#discountPrice').val(discountPrice);
                $('#pointPrice').val(0);
                $('#lastPrice').val(lastPrice);

                $('#coupon_price').val(name);
                $('#coupon_no').val(coupon_no);
                $('#c_idx').val(c_idx);
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
            }
        });
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
        price_account();
    }

    function cuPopupClose() {
        $('.couponplus_pop').hide();
    }

    function openCouPon() {
        $('.couponplus_pop').show();
    }

    function point_acnt() {

    }

    function cancelOrder() {
        window.history.back();
    }

    function point_all() {
        alert('point_acnt all');
    }
</script>