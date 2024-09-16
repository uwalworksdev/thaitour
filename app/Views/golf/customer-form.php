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
    <div class="main-section">
        <div class="body_inner">
            <div class="container-card">
                <div class="">
                    <div class="card-left">
                        <h3 class="title-main-c">
                            여행자 정보 입력
                        </h3>
                        <h3 class="title-sub-c">인원1</h3>
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

                            <h3 class="title-sub-c">인원2</h3>
                            <div class="con-form cus-border-bottom">
                                <div class="form-group">
                                    <label for="passport-name2">여권 영문명(성명)</label>
                                    <input type="text" id="passport-name2" placeholder="영어로 작성해주세요." />
                                </div>
                                <div class="form-group">
                                    <label for="gender2">성별(MR/MS)*</label>
                                    <input type="text" id="gender2" placeholder="성별(MR/MS)" />
                                </div>
                            </div>


                            <h3 class="form-title title-sub-c">골프장 왕복 픽업 차량 승용차: 2대</h3>
                            <div class="con-form-select form-group mb-30">
                                <label for="car-time-hour">차량 미팅 시간</label>
                                <div class="form-group time-group">
                                    <div class="form-group-second">
                                        <select id="car-time-hour" class="select-width">
                                            <option value="01">01</option>
                                            <option value="02">02</option>

                                        </select>
                                        <span>시</span>
                                    </div>
                                    <div class="form-group-second">
                                        <select id="car-time-minute" class="select-width">
                                            <option value="">선택</option>

                                        </select>
                                        <span>분</span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mb-30">
                                <label for="pickup-location">출발지(필요호텔)</label>
                                <input class="mb-10" type="text" id="pickup-location"
                                    placeholder="호텔명을 영어로 적어주세요(주소불가)" />
                                <span class="text-gray">※일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨줴요.</span>
                            </div>


                            <div class="form-group mb-30">
                                <label for="golf-club">목적지(골프장명)</label>
                                <input type="text" id="golf-club" value="Nikanti Golf Club" readonly />
                            </div>


                            <div class="form-group cus-form-group">
                                <label for="extra-requests">기타요청</label>
                                <textarea id="extra-requests" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 
중요한 요청 및 한글 요청 사항은 1:1게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="card-left2">
                        <h3 class="title-main-c">
                            예약확정서 정보 입력
                        </h3>
                        <h3 class="title-sub-c">예약확정서 이름</h3>
                        <div class="form-group mb-30">
                            <label for="passport-name2">한국이름</label>
                            <input type="text" id="" value="박지애" />
                        </div>
                        <div class="con-form mb-40">
                            <div class="form-group">
                                <label for="passport-name2">영문 이름(First Name) *</label>
                                <input type="text" id="" placeholder="영어로 작성해주세요." />
                            </div>
                            <div class="form-group">
                                <label for="passport-name2">영문 성(Last Name) *</label>
                                <input type="text" id="" placeholder="영어로 작성해주세요." />
                            </div>
                        </div>
                        <h3 class="title-sub-c">연락처</h3>
                        <div class="form-group form-cus-select">
                            <label for="passport-name2">이메일 주소*</label>
                            <div class="cus-select-group">
                                <input type="text" id="" placeholder="이메일" />
                                <span>@</span>
                                <select id="" class="select-width">
                                    <option value="01">선택해주세요.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-radio">
                            <p>
                                <input type="radio" id="test1" name="radio-group" checked>
                                <label for="test1">한국번호*</label>
                            </p>
                            <p>
                                <input type="radio" id="test2" name="radio-group">
                                <label for="test2">태국번호 *</label>
                            </p>
                        </div>
                        <div class="form-group form-group-cus-4input">
                            <input type="text" id="" placeholder="010" />
                            <span> - </span>
                            <input type="text" id="" />
                            <span> - </span>
                            <input type="text" id="" />
                            <input type="text" id="" />
                        </div>
                        <div class="form-group">
                            <label for="passport-name2">여행시 현지 연락처</label>
                            <div class="form-group-flex">
                                <select id="car-time-hour" class="select-width">
                                    <option value="01">TH</option>
                                </select>
                                <input type="text" id="" placeholder="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="card-right">
                        <img src="/uploads/sub/customer-form.png" alt="customer-form.png">
                        <div class="below-right">
                            <h3 class="title-r">피닉스 골드 골프 방콕 (구. 수완나품 컨트리클럽)</h3>
                            <p class="title-sub-r text-gray">19 Moo.14, Bang Krasan, Bangpain,Phra Nak
                                hon Si Ayutthaya 13160</p>
                            <h3 class="title-r">18홀 프로모션 오전</h3>
                            <div class="item-info">
                                <span>일정</span>
                                <span>2024.09.05(목)</span>
                            </div>
                            <div class="item-info">
                                <span>홀수</span>
                                <span>티오프시간</span>
                            </div>
                            <div class="item-info">
                                <span>티오프시간</span>
                                <span>06시 30분</span>
                            </div>
                            <div class="item-info">
                                <span>인원</span>
                                <span>2명</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-right2">
                        <h3 class="title-r">
                            요금정보
                        </h3>
                        <div class="item-info-r">
                            <span>그린피</span>
                            <span>107,197원 (2,600바트)</span>
                        </div>
                        <div class="item-info-r">
                            <span>캐디피</span>
                            <span>그린피에 포함</span>
                        </div>
                        <div class="item-info-r item-info-r-border-b">
                            <span>카트피</span>
                            <span>그린피에 포함</span>
                        </div>
                        <div class="item-info-r item-info-r-border-b">
                            <span>골프장 왕복 픽업 차량 승용차 x 2대</span>
                            <span>131,977원 (3,201바트)</span>
                        </div>
                        <div class="item-info-r">
                            <span>할인금액</span>
                            <span>- 131,977원 (3,201바트)</span>
                        </div>
                        <div class="item-info-r font-bold-cus">
                            <span>합계</span>
                            <span>1,085400원</span>
                        </div>
                        <p class="below-des-price">
                            · 견적서를 받으신 후 결제해 주시면 결제 확인 후 해당
                            업체에 확정 요청을 합니다. 즉시 확정 상품은 결제해
                            주시면 확정 처리됩니다.
                        </p>
                        <div class="below-title-image">
                            <img src="/uploads/icons/block_icon.png" alt="block_icon">
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
                        <button class="btn-order">예약하기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
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
        });
    </script>

    <?php $this->endSection(); ?>