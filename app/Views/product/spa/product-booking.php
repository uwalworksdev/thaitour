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
            <div class="container-card">
                <div class="">
                    <div class="card-left">
                        <h3 class="title-main-c">
                            여행자 정보 입력
                        </h3>
                        <h3 class="title-sub-c">예약자 정보</h3>
                        <div class="form-container">
                            <div class="con-form mb-40">
                                <div class="form-group">
                                    <label for="passport-name1">여권 영문명(성명)*</label>
                                    <input type="text" id="passport-name1" placeholder="영어로 작성해주세요."/>
                                </div>
                                <div class="form-group">
                                    <label for="gender1">성별(MR/MS)*</label>
                                    <input type="text" id="gender1" placeholder="성별(MR/MS)"/>
                                </div>
                            </div>

                            <div class="con-form mb-40 group-phone">
                                <div class="form-group">
                                    <label for="passport-name2">한국번호</label>
                                    <div class="form-group form-group-cus-4input">
                                        <input type="text" id="passport-name2" placeholder="010"/>
                                        <span> - </span>
                                        <input type="text" id=""/>
                                        <span> - </span>
                                        <input class="mo-cus-in-3" type="text" id=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender2">성별</label>
                                    <select name="" id="">
                                        <option value="">남</option>
                                        <option value="">남</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-cus-select">
                            <label for="passport-name_02">이메일 주소*</label>
                            <div class="cus-select-group">
                                <input type="text" id="passport-name_02" placeholder="이메일"/>
                                <span>@</span>
                                <select id="" class="select-width">
                                    <option value="01">이메일 주소*</option>
                                </select>
                            </div>
                        </div>
                        <div class="more">
                            <img src="/images/sub/plus-ic-blue.png" alt="">
                            <p>투숙객 추가</p>
                        </div>
                    </div>
                    <div class="card-left2">
                        <h3 class="title-main-c">
                            결제방법 선택
                        </h3>
                        <div class="form-group form-group-radio mb-40">
                            <p>
                                <input type="radio" id="test1" name="radio-group" checked>
                                <label for="test1">신용카드/체크카드 결제</label>
                            </p>
                            <p class="">
                                <input type="radio" id="test2" name="radio-group">
                                <label for="test2">무통장 입금</label>
                            </p>
                        </div>
                        <div class="form-group group-payment">
                            <div class="payment-item only_web">
                                <label for="">결제(입금)정보</label>
                                <select name="" id="">
                                    <option value="">신용/체크카드</option>
                                </select>
                            </div>
                            <div class="payment-item">
                                <label for="">결제(입금)정보</label>
                                <div class="payment-input-wrap">
                                    <input type="text" placeholder="입금자명">
                                    <input type="text" placeholder="(주)마인갤러리">
                                </div>
                                <div class="payment-input-wrap">
                                    <input type="text" placeholder="신한은행">
                                    <input type="text" placeholder="100-036-005729">
                                </div>
                            </div>
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
                    <div class="card-right2">
                        <h3 class="title-r">
                            여행인원 및 예약금액
                        </h3>
                        <div class="list_schedule_">
                            <div class="schedule">
                                <div class="wrap-text">
                                    <p>성인</p>
                                </div>
                                <div class="wrap-btn">
                                    <img src="/images/sub/minus-ic.png" alt="">
                                    <span><?= $adultQty ?></span>
                                    <img src="/images/sub/plus-ic.png" alt="">
                                </div>
                            </div>
                            <div class="schedule">
                                <div class="wrap-text">
                                    <p>아동</p>
                                </div>
                                <div class="wrap-btn">
                                    <img src="/images/sub/minus-ic.png" alt="">
                                    <span><?= $childrenQty ?></span>
                                    <img src="/images/sub/plus-ic.png" alt="">
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
                            $num = count($data['option_idx']);
                            for ($i = 0; $i < $num; $i++) {
                                $item = $data['option_idx'][$i];
                                ?>
                                <div class="schedule" id="schedule_<?= $item ?>">
                                    <div class="wrap-text">
                                        <span>일정</span>
                                        <p><?= $data['option_name'][$i] ?></p>
                                    </div>
                                    <div class="wrap-btn">
                                        <img src="/images/sub/minus-ic.png" alt="">
                                        <span>
                                        <input type="text" class="form-control input_qty" id="input_qty[]"
                                               readonly value="<?= $data['option_qty'][$i] ?>">
                                        </span>
                                        <img src="/images/sub/plus-ic.png" alt="">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="item-info-r font-bold-cus">
                            <span>합계</span>
                            <span><?= number_format($totalPrice) ?>원</span>
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
                        <p class="below-sub-des"><span class="color-blue">무료취소</span> / 결제 후 2024.09.01(일) 18시(한국시간)
                            이전
                        </p>
                        <span class="cus-label-r">본 예약건 취소규정</span>
                        <h3 class="title-r">약관동의</h3>
                        <div class="item-info-check-first">
                            <span>전체동의</span>
                            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                        </div>
                        <div class="item-info-check">
                            <span>이용약관 동의(필수)</span>
                            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                        </div>
                        <div class="item-info-check">
                            <span>개인정보 처리방침(필수)</span>
                            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                        </div>
                        <div class="item-info-check">
                            <span>개인정보 제3자 제공 및 국외 이전 동의(필수)</span>
                            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                        </div>
                        <div class="item-info-check">
                            <span>여행안전수칙 동의(필수)</span>
                            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                        </div>
                        <button class="btn-order" onclick="location.href='/product-spa/completed-order'">예약하기
                        </button>
                        <button class="btn-cancle" onclick="location.href='/product/completed-order'">취소하기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
                                        <img src="/images/sub/minus-ic.png" alt="">
                                        <span>
                                            <input data-price="${option_price}" readonly type="text" class="form-control input_qty" id="input_qty[]" value="1">
                                        </span>
                                        <img src="/images/sub/plus-ic.png" alt="">
                                    </div>
                                </div>

                            <div class="" style="display: none">
                                       <input type="hidden" name="option_name[]" value="${option_name}">
                                       <input type="hidden" name="option_idx[]" value="${idx}">
                                       <input type="hidden" name="option_tot[]" value="${option_tot}">
                                       <input type="hidden" name="option_cnt[]" value="${option_cnt}">
                            </div>
                        </li>`;

                    let sel_option_ = $('#schedule_' + idx);
                    if (!sel_option_.length > 0) {
                        $("#option_list_").append(htm_);
                        calcTotalSup();
                    }
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }
    </script>

<?php $this->endSection(); ?>