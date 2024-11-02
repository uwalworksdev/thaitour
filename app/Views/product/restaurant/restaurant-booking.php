<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<style>
    .customer-form-page .con-form .form-group .mo-cus-in-3 {
        width: 120px;
    }

    .customer-form-page .con-form .form-group select {
        width: 130px;
    }

    .customer-form-page .con-form.group-phone {
        justify-content: flex-start;
        gap: 20px;
    }

    .customer-form-page .form-group-cus-4input {
        margin-bottom: 0;
    }

    .customer-form-page .form-group-cus-4input input:nth-child(1) {
        width: 84px;
    }

    .customer-form-page .form-group.group-payment {
        display: flex;
        justify-content: space-between;
        gap: 30px;
    }

    .customer-form-page .form-group.group-payment .payment-item {
        flex: 1;
    }

    .customer-form-page .form-group.group-payment .payment-input-wrap {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .customer-form-page .form-group-radio {
        margin-bottom: 20px;
    }

    .card-right2 .select-wrap {
        padding-bottom: 30px;
        border-bottom: 1px dotted #dbdbdb;
        margin-bottom: 30px;
    }

    .card-right2 select {
        margin-bottom: 10px;
    }

    .customer-form-page .container-card .btn-cancle {
        font-size: 22px;
        background-color: #fff;
        color: #2a459f;
        border-radius: 5px;
        padding: 12px 50px;
        width: 100%;
        margin-top: 25px;
        font-weight: bold;
        height: 66px;
        border: 1px solid currentColor;
    }

    .customer-form-page .container-card .card-left .more {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 10px;
    }

    .customer-form-page .container-card .card-left .more p {
        color: #004ce7;
        font-weight: 500;
    }

    .customer-form-page .container-card .card-right2 {
        margin-bottom: 190px;
    }

    .customer-form-page .container-card .card-right2 .schedule {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 22px;
        border-bottom: 1px solid #dbdbdb;
        margin-bottom: 54px;
    }

    .card-right2 .schedule .wrap-text span {
        color: #ccc;
        font-size: 16px;

    }

    .card-right2 .schedule .wrap-text p {
        color: #252525;
        font-size: 16px;
        margin-top: 10px;
    }


    .card-right2 .schedule .wrap-btn {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .card-right2 .schedule .wrap-btn img {
        width: 32px;
    }

    @media screen and (max-width : 850px) {
        .customer-form-page .con-form .form-group .mo-cus-in-3 {
            width: 18rem;
        }

        .customer-form-page .form-group-cus-4input input:nth-child(1) {
            width: 16rem;
        }

        .customer-form-page .form-group-cus-4input input:nth-child(1) {
            width: 17.5rem;
        }

        .customer-form-page .con-form .form-group select {
            width: 25rem;
        }


        .customer-form-page .cus-select-group input,
        .customer-form-page .cus-select-group select {
            width: 0;
            flex: 1;
        }

        .form-group.group-payment .payment-item {
            width: 100%;

        }

        .form-group.group-payment .payment-item input {
            flex: 1;
            width: 0;
        }

        .card-right2 .select-wrap select {
            width: 100%;
        }

        .customer-form-page .container-card .btn-cancle {
            font-size: 3.2rem;
            border-radius: 0.6rem;
            padding: 1.2rem 5rem;
            width: 100%;
            font-weight: bold;
            height: 10rem;
        }

        .mb-40 {
            margin-bottom: 2.5385rem;
        }

        .card-right2 .select-wrap {
            padding-bottom: 1.5385rem;
            border-bottom: 1px dotted #dbdbdb;
            margin-bottom: 2.5385rem;
        }

        .customer-form-page .container-card .card-right2 {
            margin-bottom: 7.3077rem;
        }

        .main-section {
            margin-bottom: 14.6923rem;
        }

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
                                    <input type="text" id="passport-name1" placeholder="영어로 작성해주세요." />
                                </div>
                                <div class="form-group">
                                    <label for="gender1">성별(MR/MS)*</label>
                                    <input type="text" id="gender1" placeholder="성별(MR/MS)" />
                                </div>
                            </div>
                            <div class="con-form mb-40 group-phone">
                                <div class="form-group">
                                    <label for="passport-name2">한국번호</label>
                                    <div class="form-group form-group-cus-4input">
                                        <input type="text" id="passport-name2" placeholder="010" />
                                        <span> - </span>
                                        <input type="text" id="" />
                                        <span> - </span>
                                        <input class="mo-cus-in-3" type="text" id="" />
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
                                <input type="text" id="passport-name_02" placeholder="이메일" />
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
                                    <option value="">신용/체크카드 </option>
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
                        <img src="/images/sub/form-spa-booking.png" alt="customer-form.png">
                        <div class="below-right">
                            <h3 class="title-r">방콕 막카 스파 & 마사지 (아속점)</h3>
                            <p class="title-sub-r text-gray">425 Sukhumvit Rd, Khlong Tan Nuea, Watthana 10110,방콕,태국</p>
                            <h3 class="title-r">예약안내</h3>
                            <div class="item-info">
                                <span>일정</span>
                                <span>2024.09.05(목)</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-right2">
                        <h3 class="title-r">
                            여행인원 및 예약금액
                        </h3>
                        <div class="schedule">
                            <div class="wrap-text">
                                <span>일정</span>
                                <p>담당자에게 문의해주세요</p>
                            </div>
                            <div class="wrap-btn">
                                <img src="/images/sub/minus-ic.png" alt="">
                                <span>2</span>
                                <img src="/images/sub/plus-ic.png" alt="">
                            </div>
                        </div>

                        <h3 class="title-r">
                            옵션선택
                        </h3>
                        <div class="select-wrap">
                            <select>
                                <option>선택</option>
                            </select>
                            <select>
                                <option>옵션선택</option>
                            </select>
                        </div>

                        <div class="item-info-r font-bold-cus">
                            <span>합계</span>
                            <span>0원</span>
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
                        <button class="btn-order" onclick="location.href='/product-restaurant/completed-order'">예약하기</button>
                        <button class="btn-cancle" onclick="location.href='/product/completed-order'">취소하기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
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
        });
    </script>

    <?php $this->endSection(); ?>