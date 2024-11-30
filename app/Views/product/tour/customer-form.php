<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
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
    <form action="/product-tours/customer-form-ok" name="order_frm" id="order_frm" method="post" target="hiddenFrame">
        <input type="hidden" name="product_idx" value="<?=$product_idx?>">
        <input type="hidden" name="people_adult_cnt" value="<?=$people_adult_cnt?>">
        <input type="hidden" name="people_kids_cnt" value="<?=$people_kids_cnt?>">
        <input type="hidden" name="people_baby_cnt" value="<?=$people_baby_cnt?>">
        <input type="hidden" name="people_adult_price" value="<?=$adult_price_total?>">
        <input type="hidden" name="people_kids_price" value="<?=$kids_price_total?>">
        <input type="hidden" name="people_baby_price" value="<?=$baby_price_total?>">
        <input type="hidden" name="order_date" id="order_date" value="<?=$order_date?>">
        <input type="hidden" name="tours_idx" id="tours_idx" value="<?=$tours_idx?>">
        <?php foreach ($tour_option as $option): ?>
            <input type="hidden" name="option_idx[]" id="option_idx[]" value="<?= htmlspecialchars($option['idx']) ?>">
        <?php endforeach; ?>
        <input type="hidden" name="start_place" id="start_place" value="<?=$start_place?>">
        <input type="hidden" name="metting_time" id="metting_time" value="<?=$metting_time?>">
        <input type="hidden" name="id_kakao" id="id_kakao" value="<?=$id_kakao?>">
        <input type="hidden" name="description" id="description" value="<?=$description?>">
        <input type="hidden" name="end_place" id="end_place" value="<?=$end_place?>">
        <input type="hidden" name="final_price" id="final_price" value="<?=$final_price?>">
        <input type="hidden" name="inital_price" id="inital_price" value="<?=$inital_price?>">
        <input type="hidden" name="time_line" id="time_line" value="<?=$time_line?>">
        <input type="hidden" name="use_coupon_idx" id="use_coupon_idx" value="<?=$use_coupon_idx?>">
        <input type="hidden" name="final_discount" id="final_discount" value="<?=$final_discount?>">
        <div class="main-section tour">
            <div class="body_inner">
                <div class="container-card">
                    <div class="">
                        <div class="card-left">
                            <div class="flex" style="gap: 20px">
                                <h3 class="title-main-c">
                                    여행자 정보 입력
                                </h3>
                                <div class="bs-input-check">
                                    <input type="checkbox" id="save_id" name="save_id" value="Y">
                                    <label for="save_id"> 회원정보와 동일</label>
                                </div>
                            </div>
                            <div class="form-container">
                                <?php for($i = 1; $i <= $people_adult_cnt; $i++) { ?>
                                    <h3 class="title-sub-c">성인<?= $i ?></h3>
                                    <div class="con-form mb-40">
                                        <div class="form-group">
                                            <label for="passport-name<?=$i?>">여권 영문명(성명)*</label>
                                            <input type="text" name="companion_name[]" id="passport-name<?=$i?>" data-label="인원성명" required placeholder="영어로 작성해주세요." />
                                        </div>
                                        <div class="form-group">
                                            <label for="order_birthday<?=$i?>">생년월일</label>
                                            <div class="datepick"><input type="text" name="order_birthday[]" id="order_birthday<?=$i?>" onfocus="this.blur()" class="bs-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="con-form mb-40">
                                        <div class="form-group">
                                            <label for="한국번호">한국번호*</label>
                                            <div class="form-group-cus-4input tour_input">
                                                <input name="phone_1[]" maxlength="3" class="phone_kor phone" type="text" id="phone_1<?=$i?>" required data-label="한국번호" />
                                                <span> - </span>
                                                <input name="phone_2[]" maxlength="4" class="phone_kor phone" type="text" id="phone_2<?=$i?>" required data-label="한국번호" />
                                                <span> - </span>
                                                <input name="phone_3[]" maxlength="4" class="phone_kor phone" type="text" id="phone_3<?=$i?>" required data-label="한국번호" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender<?=$i?>">성별(남성/여성)*</label>
                                            <select name="companion_gender[]" id="gender<?=$i?>" required data-label="성별" class="select-width" id="">
                                                <option value="M">남성</option>
                                                <option value="F">여성</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="con-form mb-40">
                                    <div class="form-group form-cus-select">
                                            <label for="passport-name2">이메일 주소*</label>
                                            <div class="cus-select-group tour">
                                                <input type="text" id="email_1" name="email_1[]" required data-label="이메일" placeholder="이메일" />
                                                <span>@</span>
                                                <div class="email-group">
                                                    <select id="" name="email_2[]" id="email_2" class="select-width" onchange="handleEmail(this.value)">
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
                                    </div>
                                <?php } ?>
                                <?php for($i = 1; $i <= $people_kids_cnt; $i++) { ?>
                                    <h3 class="title-sub-c">아동<?= $i ?></h3>
                                    <div class="con-form mb-40">
                                        <div class="form-group">
                                            <label for="passport-name<?=$i?>">여권 영문명(성명)*</label>
                                            <input type="text" name="companion_name[]" id="passport-name<?=$i?>" data-label="인원성명" required placeholder="영어로 작성해주세요." />
                                        </div>
                                        <div class="form-group">
                                            <label for="order_birthday_kids<?=$i?>">생년월일</label>
                                            <div class="datepick"><input type="text" name="order_birthday[]" id="order_birthday_kids<?=$i?>" onfocus="this.blur()" class="bs-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="con-form mb-40">
                                        <div class="form-group">
                                            <label for="gender<?=$i?>">성별(남성/여성)*</label>
                                            <select name="companion_gender[]" id="gender<?=$i?>" required data-label="성별" class="select-width" id="">
                                                <option value="M">남성</option>
                                                <option value="F">여성</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php for($i = 1; $i <= $people_baby_cnt; $i++) { ?>
                                    <h3 class="title-sub-c">유아<?= $i ?></h3>
                                    <div class="con-form mb-40">
                                        <div class="form-group">
                                            <label for="passport-name<?=$i?>">여권 영문명(성명)*</label>
                                            <input type="text" name="companion_name[]" id="passport-name<?=$i?>" data-label="인원성명" required placeholder="영어로 작성해주세요." />
                                        </div>
                                        <div class="form-group">
                                            <label for="order_birthdays<?=$i?>">생년월일</label>
                                            <div class="datepick"><input type="text" name="order_birthday[]" id="order_birthdays<?=$i?>" onfocus="this.blur()" class="bs-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="con-form mb-40">
                                        <div class="form-group">
                                            <label for="gender<?=$i?>">성별(남성/여성)*</label>
                                            <select name="companion_gender[]" id="gender<?=$i?>" required data-label="성별" class="select-width" id="">
                                                <option value="M">남성</option>
                                                <option value="F">여성</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-left2">
                            <h3 class="title-main-c">
                                예약정보
                            </h3>
                            <table class="tbl_form">
                                <colgroup>
                                    <col width="30%">
                                    <col width="70%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>회원등급 할인</th>
                                        <td>없음</td>
                                    </tr>
                                    <tr>
                                        <th>미팅장소</th>
                                        <td><?= $start_place?></td>
                                    </tr>
                                    <tr>
                                        <th>미팅 시간</th>
                                        <td><?= $metting_time?></td>
                                    </tr>
                                    <tr>
                                        <th>종료 후 내리실 곳</th>
                                        <td><?= $end_place?></td>
                                    </tr>
                                    <tr>
                                        <th>카카오톡 아이디</th>
                                        <td><?= $id_kakao?></td>
                                    </tr>
                                    <tr>
                                        <th>기타 요청</th>
                                        <td><?= $description?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="">
                        <div class="card-right">
                            <img src="/data/product/<?= $product['ufile1'] ?>" alt="">
                            <div class="below-right">
                                <h3 class="title-r"><?= $product['product_name'] ?></h3>
                                <p class="title-sub-r text-gray"><?= $product['addrs'] ?></p>
                                <h3 class="title-r"><?= $tour_product['tours_subject']?></h3>
                                <div class="item-info">
                                    <span>선택기간</span>
                                    <span><?= substr($tour_info['o_sdate'],0,10)?> ~ <?= substr($tour_info['o_edate'],0,10)?></span>
                                </div>
                                <div class="item-info">
                                    <span>선택날짜</span>
                                    <span><?= $order_date?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-right2">
                            <h3 class="title-r">
                                요금정보
                            </h3>
                            <div class="item-info-r">
                                <span>성인 X<?=$people_adult_cnt?></span>
                                <span><?=number_format($people_adult_price)?>원 (<?=number_format($adult_price_bath)?>바트)</span>
                            </div>
                            <div class="item-info-r">
                                <span>아동 X<?=$people_kids_cnt?></span>
                                <span><?=number_format($people_kids_price)?>원 (<?=number_format($kids_price_bath)?>바트)</span>
                            </div>
                            <div class="item-info-r">
                                <span>유아 X<?=$people_baby_cnt?></span>
                                <span><?=number_format($people_baby_price)?>원 (<?=number_format($baby_price_bath)?>바트)</span>
                            </div>
                            <div class="item-info-r-line"></div>
                            <?php foreach ($tour_option as $key => $option): ?>
                                <div class="item-info-r">
                                    <span><?=$option['option_name']?></span>
                                    <span><?=number_format($option_price[$key])?>원 (<?=number_format($option_price_bath[$key])?>바트)</span>
                                </div>
                            <?php endforeach; ?>
                            <div class="item-info-r-line"></div>
                            <div class="item-info-r red">
                                <span>쿠폰할인</span>
                                <span>- <?=number_format($final_discount)?>원 (<?=number_format($final_discount_bath)?>바트)</span>
                            </div>
                            <div class="item-info-r red">
                                <span>포인트</span>
                                <span>- 0원 (0바트)</span>
                            </div>
                            <div class="item-info-r font-bold-cus">
                                <span>합계</span>
                                <span><?=number_format($final_price)?>원 (<?= number_format($final_price_bath)?>바트)</span>
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
                            <p class="below-sub-des"><span class="color-blue">무료취소</span> / 결제 후 2024.09.01(일) 18시(한국시간) 이전
                            </p>
                            <span class="cus-label-r" id="policy_show">본 예약건 취소규정</span>
                            <h3 class="title-r">약관동의</h3>
                            <div class="item-info-check-first item-clause-all">
                                <span>전체동의</span>
                                <!-- <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon"> -->
                                <i></i>
                            </div>
                            <div class="item-info-check item-clause-item">
                                <span>이용약관 동의(필수)</span>
                                <!-- <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon"> -->
                                <i></i>
                            </div>
                            <div class="item-info-check item-clause-item">
                                <span>개인정보 처리방침(필수)</span>
                                <!-- <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon"> -->
                                <i></i>
                            </div>
                            <div class="item-info-check item-clause-item">
                                <span>개인정보 제3자 제공 및 국외 이전 동의(필수)</span>
                                <!-- <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon"> -->
                                <i></i>
                            </div>
                            <div class="item-info-check item-clause-item">
                                <span>여행안전수칙 동의(필수)</span>
                                <!-- <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon"> -->
                                <i></i>
                            </div>
                            <button class="btn-order" type="button" onclick="handleSubmit()">예약하기</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
                        <?=viewSQ(getPolicy(19))?>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>
    <iframe src="" id="hiddenFrame" name="hiddenFrame" style="display: none;" frameborder="0"></iframe>
    <script>
        function closePopup() {
            $(".popup_wrap").hide();
            $(".dim").hide();
        }

        $("#policy_show").on("click", function() {
            $(".policy_pop, .policy_pop .dim").show();
        });
    </script>
    <script>
        $(document).ready(function() {

            $(".datepick input").datepicker({
                dateFormat: 'yy-mm-dd',
                showOn: "both",
                buttonImage: '/images/ico/datepicker_ico.png',
                showMonthAfterYear: true,
                buttonImageOnly: true,
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                changeMonth: true, // month 셀렉트박스 사용
                changeYear: true, // year 셀렉트박스 사용
                yearRange: "1910:2024", // 년도 선택 셀렉트박스를 현재 년도에서 이전, 이후로 얼마의 범위를 표시할것인가.
            });

            $(".phone").on("input", function() {
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
                onSelect: function(dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    $(this).val(formatDate(date));
                }
            });

            $('#checkin').val(formatDate('2024/07/09'));
            $('#checkout').val(formatDate('2024/07/10'));


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
        function handleSubmit() {
            const frm = document.order_frm;
            let flag = true;

            $("input[required]:not(:disabled)").each(function() {
                if ($(this).val().trim() == "") {
                    alert($(this).attr("data-label") + "를 입력하십시오.");
                    $(this).focus();
                    flag = false;
                    return false;
                }
            });

            if (!flag) {
                return false;
            }

            if (!($(".item-clause-all").hasClass("click"))) {
                alert("이용약관 동의(필수)를 선택하십시오.");
                return false;
            }
            frm.submit();
        }
    </script>
    <?php $this->endSection(); ?>