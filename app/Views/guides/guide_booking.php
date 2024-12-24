<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
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
			<input type="hidden" name="order_status" id="order_status" value="W">
			<input type="hidden" name="feeVal" id="feeVal" value="adults:45:59374:스팀 사우나 + 스크럽 (90분):59374:01">
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
                                    <input type="text" id="order_user_name" name="order_user_name" required="" data-label="한국이름" placeholder="한국이름 작성해주세요.">
                                </div>
                                <div class="form-group" style="width: 50%">
                                    <label for="gender1">성별(남성/여성)*</label>
                                    <select name="companion_gender" id="gender1" style="width: 100%" required="" data-label="성별" class="select-width">
                                        <option value="M">남성</option>
                                        <option value="F">여성</option>
                                    </select>
                                </div>
                            </div>
                            <div class="con-form mb-40">
                                <div class="form-group">
                                    <label for="order_user_first_name_en">영문 이름(First Name) *</label>
                                    <input type="text" id="order_user_first_name_en" name="order_user_first_name_en" required="" data-label="영문 이름" placeholder="영어로 작성해주세요.">
                                </div>
                                <div class="form-group">
                                    <label for="order_user_last_name_en">영문 성(Last Name) *</label>
                                    <input type="text" id="order_user_last_name_en" name="order_user_last_name_en" required="" data-label="영문 성" placeholder="영어로 작성해주세요.">
                                </div>
                            </div>
                            <h3 class="title-sub-c">연락처</h3>
                            <div class="form-group form-cus-select">
                                <label for="passport-name2">이메일 주소*</label>
                                <div class="cus-select-group">
                                    <input type="text" id="email_1" name="email_1" required="" data-label="이메일" placeholder="이메일">
                                    <span>@</span>
                                    <div class="email-group">
                                        <input type="text" name="email_2" id="email_2" required="" data-label="이메일" placeholder="" readonly="">
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
                                        <input name="phone_1" maxlength="3" class="phone_kor phone" type="text" id="phone_1" required="" data-label="한국번호">
                                        <span> - </span>
                                        <input name="phone_2" maxlength="4" class="phone_kor phone" type="text" id="phone_2" required="" data-label="한국번호">
                                        <span> - </span>
                                        <input name="phone_3" maxlength="4" class="phone_kor phone" type="text" id="phone_3" required="" data-label="한국번호">
                                    </div>
                                </div>
                                <div class="phone_wrap_item form-group">
                                    <p>
                                        <input type="radio" id="test2" name="radio_phone" value="thai">
                                        <label for="test2">태국번호 *</label>
                                    </p>
                                    <div class="form-group">
                                        <input name="phone_thai" maxlength="10" class="phone_thai phone" type="text" id="phone_thai" disabled="" required="" data-label="한국번호">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mo_mt-30">
                                <label for="passport-name2">여행시 현지 연락처</label>
                                <div class="form-group-flex" style="display: flex; align-items: center; gap: 20px">
                                    <select id="car-time-hour" class="select-width" style="width: 200px">
                                        <option value="01">TH</option>
                                    </select>
                                    <input name="local_phone" class="phone" maxlength="10" type="text" id="local_phone" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="card-left card-left-2" style="display:  none">
                            <div class="" style="display:  none">
                                                                    <h3 class="title-sub-c mt-30">성인1 <span class="text_divider"></span> 스팀 사우나 + 스크럽 (90분)</h3>
                                    <div class="form-container" data-group="group1">
                                        <div class="con-form mb-40">
                                            <div class="parent-form-group">
                                                <div class="form-group">
                                                    <label for="first-a-name-1">영문 이름(First Name) *</label>
                                                    <input type="text" id="first-a-name-1" name="order_a_first_name[]" placeholder="영어로 작성해주세요.">
                                                </div>
                                                <div class="form-group">
                                                    <label for="last-a-name-1">영문 성(Last Name) *</label>
                                                    <input type="text" id="last-a-name-1" name="order_a_last_name[]" placeholder="영어로 작성해주세요.">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                    <!--                        <p class="title-sub-below">투숙객 이름은 체크인 시 제시할 유효한 신분증 이름과 정확히 일치해야 합니다.</p>-->
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
                                    <input type="text" name="point" id="point_price" class="bs-input" onkeyup="point_acnt();">
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
                                <textarea id="extra-requests" name="order_memo" placeholder="여기에 요청 사항을 입력하세요(선택사항)"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="">
                        <div class="card-right">
                            <img src="../images/sub/guide_booking.png" alt="customer-form.png">
                            <div class="below-right">
                                <h3 class="title-r">에이 타이 &amp; 마사지(by aspa) AThai&amp;massage(by aspa)</h3>
                                <p class="title-sub-r text-gray">
                                    카오락                                </p>
                                <h3 class="title-r">예약안내</h3>
                                <div class="item-info" style="gap: 10px;">
                                    <span>일정: </span>
                                    <span>2024-12-30(<span id="day_">월</span>)</span>
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
                                            <p>성인1 x 01</p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span>59,374</span>
                                            <span> 원</span>
                                        </div>
                                    </div>
                                
                                                                    <div class="schedule">
                                        <div class="wrap-text">
                                            <p>아동1 x 0</p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span>0</span>
                                            <span> 원</span>
                                        </div>
                                    </div>
                                                            </div>

                            <div style="display: none">
                                <h3 class="title-r">
                                    옵션선택
                                </h3>
                                <div class="select-wrap">
                                    <select name="moption" id="moption" onchange="sel_moption(this.value);">
                                        <option value="">옵션선택</option>
                                                                                    <option value="111">옵션 1</option>
                                                                                    <option value="164">옵션 2</option>
                                                                            </select>
                                    <div class="opt_select disabled sel_option" id="sel_option">
                                        <select name="option" id="option" onchange="sel_option(this.value);">";
                                            <option value="">옵션 선택</option>
                                        </select>
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
                                <span><span class="textTotalPrice lastPrice">59,374</span> 원</span>
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

                            <button class="btn-order btnOrder" onclick="completeOrder('W');" type="button">예약하기</button>
                            <button class="btn-order btnOrder" onclick="completeOrder('B');" type="button">장바구니 담기</button>
                            <button class="btn-cancel btnCancel" onclick="cancelOrder();" type="button">취소하기</button>
                        </div>
                    </div>
                </div>
                <div class="" style="display: none;">
                    <input type="hidden" name="realTotal" id="realTotal" value="59374">

                    <input type="hidden" name="product_idx" id="product_idx" value="1900">
                    <input type="hidden" name="day_" id="day_" value="2024-12-30">
                    <input type="hidden" name="adultQty" id="adultQty" value="01">
                    <input type="hidden" name="adultPrice" id="adultPrice" value="59374">

                    <input type="hidden" name="childrenQty" id="childrenQty" value="0">
                    <input type="hidden" name="childrenPrice" id="childrenPrice" value="">

                    <input type="hidden" name="totalPrice" id="totalPrice" value="59374">
                    <input type="hidden" name="order_gubun" id="order_gubun" value="spa">

                    <input type="hidden" name="discountPrice" id="discountPrice" value="0">
                    <input type="hidden" name="pointPrice" id="pointPrice" value="0">
                    <input type="hidden" name="lastPrice" id="lastPrice" value="59374">

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
                        <div class="policy_top" style="box-sizing: border-box; margin: 30px 0px 0px; padding: 0px; border: 0px; color: rgb(85, 85, 85); font-family: Pretendard; font-size: 16px; letter-spacing: -0.64px; line-height: 26px; background-color: rgb(255, 255, 255);"><div class="policy_top" style="box-sizing: border-box; margin: 30px 0px 0px; padding: 0px; border: 0px; letter-spacing: -0.64px; line-height: 26px;"><div class="policy_top" style="box-sizing: border-box; margin: 30px 0px 0px; padding: 0px; border: 0px; letter-spacing: -0.64px; line-height: 26px;"><div class="policy_top" style="box-sizing: border-box; margin: 30px 0px 0px; padding: 0px; border: 0px; letter-spacing: -0.64px; line-height: 26px;">몽키에서는 마음대로 예약하세요~~ test&nbsp;<br style="box-sizing: border-box; font-family: sans-serif;">호텔,골프,투어,차량..취소/변경수수료가 전~혀 없어요.<br style="box-sizing: border-box; font-family: sans-serif;">단,호텔이나 업체에서 매기는 수수료는 어쩔 수 없지만 최대한 가볍게 해드려요~~</div><div class="policy_center" style="box-sizing: border-box; margin: 40px 0px 0px; padding: 0px; border: 0px; color: rgb(37, 37, 37); font-family: " noto="" sans="" kr";="" letter-spacing:="" -0.64px;="" display:="" flex;"=""><div class="left" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: inherit; font-family: inherit; font-size: inherit; letter-spacing: -0.04em; width: 391px;"><p style="box-sizing: border-box; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">24년 11월 10일(일) 18시 이전:</p><p style="box-sizing: border-box; margin-top: 10px; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">24년 11월 10일(일) 18시 ~ 24년 11월 11일(일) 18시:</p><p style="box-sizing: border-box; margin-top: 10px; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">24년 11월 10일(일) 18시 이후 쥐소 또는 노쇼(No Show):</p></div><div class="right" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: inherit; font-family: inherit; font-size: inherit; letter-spacing: -0.04em; width: 391px;"><p style="box-sizing: border-box; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">취소/변경 수수류 전혀 없이&nbsp;<span class="color" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: rgb(255, 136, 39); font-family: inherit; font-size: inherit; letter-spacing: -0.04em;">취소/변경 가능</span></p><p style="box-sizing: border-box; margin-top: 10px; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">결제하신 금액의&nbsp;<span class="color" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: rgb(255, 136, 39); font-family: inherit; font-size: inherit; letter-spacing: -0.04em;">50% 요금이 자지</span>로 발생</p><p style="box-sizing: border-box; margin-top: 10px; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">결제하신 금액&nbsp;<span class="color" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: rgb(255, 136, 39); font-family: inherit; font-size: inherit; letter-spacing: -0.04em;">전액이 자지</span>로 발생</p></div></div><div class="policy_bottom" style="box-sizing: border-box; margin: 40px 0px 0px; padding: 0px; border: 0px; color: rgb(172, 172, 172); letter-spacing: -0.64px; line-height: 26px;">* 정확한 저리를 위해서 쥐소변경온 전화로는 눌가하고, 반드시 사이트에 글로 남겨주셔야 합니다.<br style="box-sizing: border-box; font-family: sans-serif;">* 위의 취소요청 시간은 한국시간을 기준으로 됩니다.<br style="box-sizing: border-box; font-family: sans-serif;">* 노 쇼(No-Show): 여악올 했지만 쥐소 연락 없이 예약장소에 나타나지 않는 경우를 말합니다.</div></div></div></div>                    </div>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>
</div>



   
<?php $this->endSection(); ?>