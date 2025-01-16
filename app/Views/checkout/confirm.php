<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php $setting = homeSetInfo();?>

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
            <form action="#" class="formOrder" name="formOrder" id="formOrder">
            <input type="hidden" name="product_name"      id="product_name"      value="<?=$product_name?>" >
            <input type="hidden" name="payment_no"        id="payment_no"        value="<?=$payment_no?>" >
            <input type="hidden" name="dataValue"         id="dataValue"         value="<?=$dataValue?>" >
            <input type="hidden" name="user_id"           id="user_id"           value="<?=session("member.id")?>" >
            <input type="hidden" name="user_name"         id="user_name"         value="<?=session("member.name")?>" >
            <input type="hidden" name="my_point"            id="my_point" min="0" class="item_number_" value="<?=$point?>" >
            <input type="hidden" name="payment_tot"         id="payment_tot"       value="" >
            <input type="hidden" name="payment_price"       id="payment_price"     value="" >
            <input type="hidden" name="coupon_idx"          id="coupon_idx"    value="" >
	        <input type="hidden" name="coupon_num"          id="coupon_num"    value="" >	
	        <input type="hidden" name="coupon_name"         id="coupon_name"   value="" >	
	        <input type="hidden" name="coupon_pe"           id="coupon_pe"     value="0" >
	        <input type="hidden" name="coupon_price"        id="coupon_price"  value="0" >
	        <input type="hidden" name="used_point"          id="used_point"    value="0" >
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
                                                <input type="radio" name="inp_radio" value="vbank" id="vbank1">
                                                <label for="vbank1">나이스페이</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content_">실시간 계좌이체</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="bank" id="bank11">
                                                <label for="bank11">나이스페이</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content_">무통장 입금</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="deposit" id="deposit">
                                                <label for="deposit" style="margin-right: 30px">지정계좌 입금</label>

                                                <button class="btn_ open_popup" type="button">한국계좌번호 보기</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="subject_">신용카드</td>
                                            <td class="content_">신용카드 - 일반</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="cardNicepay" id="cardNicepay1" checked>
                                                <label for="cardNicepay1" style="margin-right: 30px">나이스페이</label>

                                                <input type="radio" name="inp_radio" value="cardInicis" id="cardInicis1">
                                                <label for="cardInicis1">이니시스</label>
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
                                                <input type="radio" name="inp_radio" value="vbank" id="vbank2">
                                                <label for="vbank2">나이스페이</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content_">실시간 계좌이체</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="bank" id="bank2">
                                                <label for="bank2">나이스페이</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content_">무통장 입금</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="deposit" id="deposit">
                                                <label for="deposit" style="margin-right: 30px">지정계좌 입금</label>

                                                <button class="btn_ open_popup" type="button">한국계좌번호 보기</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="subject_" colspan="2">신용카드</td>
                                        </tr>
                                        <tr>
                                            <td class="content_">신용카드 - 일반</td>
                                            <td class="normal_">
                                                <input type="radio" name="inp_radio" value="cardNicepay" id="cardNicepay2" >
                                                <label for="cardNicepay2" style="margin-right: 30px">NICEPAY</label>

                                                <input type="radio" name="inp_radio" value="cardInicis" id="cardInicis2">
                                                <label for="cardInicis2">이니시스</label>
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
                                            <p class="price_ paySum"></p>
                                        </td>
                                    </tr>
									<?php 
									   $coupon_cnt = 0;
									   foreach ($resultCoupon as $row): 
										  $coupon_cnt++;
									   endforeach; 
									?>

                                    <tr class="">
                                        <td class="subject_">쿠폰 사용</td>
                                        <td class="nomal_">
                                            <div class="item_number_area_">
                                                <input type="number" name="used_coupon_money" id="used_coupon_money" value="0" min="0" class="item_number_">
                                                <button type="button" class="coupon_open" onclick="showCouponPop();">쿠폰조회</button>
                                                <p class="item_title_">
                                                    사용 (사용가능 쿠폰 : <?=$coupon_cnt?> 장)
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="subject_">포인트</td>
                                        <td class="normal_">
                                            <div class="item_number_area_">
                                                <input type="number" value="0" name="use_point" id="use_point" min="0" class="item_number_">
                                                <p class="item_title_">
                                                    포인트 (사용가능 포인트 : <?=number_format($point)?> 포인트)
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
                                                <span id="use_point_txt">0</span> 원
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
                                                <input type="text" value="<?=session("member.name")?>" id="pay_name" name="pay_name" class="item_number__">
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
                                                <input type="email" value="<?=$_POST['email_1']?>@<?=$_POST['email_2']?>" id="pay_email" name="pay_email" class="item_number__">
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
                                                <input type="text" value="<?=$_POST['phone_1']?>-<?=$_POST['phone_2']?>-<?=$_POST['phone_3']?>" id="pay_hp" name="pay_hp" class="item_number__">
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
                            <span>상품총액</span>
                            <span>
                                <span class="textPrice_ " id="product_sum">0</span> 원
                            </span>
                        </div>

                        <!--div class="item-info-r">
                            <span>세금&서비스비용</span>
                            <span>
                                <span class="textPrice_ ">0</span> 원
                            </span>
                        </div-->

                        <div class="item-info-r">
                            <span>포인트</span>
                            <span>
                                -<span class="textPrice_ " id="minus_point">-0</span> 원
                            </span>
                        </div>

                        <div class="item-info-r item-info-r-border-b">
                            <span>쿠폰할인</span>
                            <span>
                                -<span class="textPrice_ " id="minus_coupon">-0</span> 원
                            </span>
                        </div>

                        <div class="item-info-r">
                            <span class="mainPrice_">총 결제금액 </span>
                            <span>
                                <span class="textPrice_ lastPrice paySum" id="lastPrice"></span>
                            </span>
                        </div>

                        <p class="below-des-price">
                            · 체크인하시려면 3일 전에 숙소로 연락해 주세요 <br>
                            · 선택하신 객실 유형의 체크인 시간은 14:00~24:00 사이,
                            체크아웃 시간은 06:00~12:00입니다. <br>
                            · 온수 (지정시간 제공)
                        </p>
                        <button class="btn-order btnOrder" onclick="reqPG();" type="button">
                            결제하기
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

<!-- popup -->
<div class="popup_wraps popup_wrap_cus_1 send_mail_pop" id="send_mail_pop" style="display: none;">
    <div class="pop_box">
        <div class="pop_head flex_c_c">
            <p class = "text">한국계좌은행번호</p>
            <button type="button" class="close">
                <img src="/img/btn/close_ic.png" alt=""></button>
        </div>
        <div class="pop_body">
            
                <div class="main_content_">
                    <div class="title_">우리은행</div>

                    <div class="number_">
                        838689-79-686868
                    </div>

                    <div class="sup_title_">
                        (더투어랩)
                    </div>

                    <div class="content_">
                        ※ 예약 신청자와 결제자 이름이 다른 경우 1:1 게시판으로 결제 확인 요청을 꼭 해주세요.
                    </div>
                </div>
            
        </div>
    </div>
    <div class="dim"></div>
</div>

<div id="popup_coupon" class="popup_coupon" data-price="">
    <div class="popups">
        <div class="popup-content">
            <img src="/images/ico/close_icon_popup.png" alt="close_icon" class="close-btn"></img>
            <h2 class="title-popup">적용가능한 쿠폰 확인</h2>
            <div class="order-popup">

                <p class="count-info">사용 가능 쿠폰 <span><?=$coupon_cnt?> 장</span></p>
                <div class="description-above">

                    <?php foreach ($resultCoupon as $row): ?>
                    <div class="item-price-popup couponSel" style="cursor: pointer;" 
					     data-idx="<?=$row['c_idx']?>" 
						 data-num="<?=$row['coupon_num']?>" 
						 data-name="<?=$row['coupon_name']?>"
						 data-pe="<?=$row['coupon_pe']?>"
						 data-price="<?=$row['coupon_price']?>" >
                        <div class="img-container">
                            <img src="/images/sub/popup_cash_icon.png" alt="popup_cash_icon">
                        </div>
                        <div class="text-con">
                            <span class="item_coupon_name"></span>
                            <span class="text-gray"> <?=$row['coupon_name']?></span>
                        </div>
                        <span class="date-sub">~</span>
                    </div>
                    <?php endforeach; ?>

                    <div class="item-price-popup item-price-popup--button couponApply"
                        data-idx="" data-type="" data-discount="0" data-discount_baht="0">
                        <span>적용안함</span>
                    </div>
                </div>
                <div class="line-gray"></div>
                <div class="footer-popup">
                    <div class="des-above">
                        <div class="item">
                            <span class="text-gray">총 주문금액</span>
                            <span class="text-gray total_price" id="total_price_popup" data-price="">0원</span>
                        </div>
                        <div class="item">
                            <span class="text-gray">할인금액</span>
                            <span class="text-gray discount" data-price="" id="coupon_discount">0원</span>
                        </div>
                    </div>
                    <div class="des-below">
                        <div class="price-below">
                            <span>최종결제금액</span>
                            <p class="price-popup">
                                <span id="last_price_popup" class="lastPrice">0</span><span
                                        class="text-gray">원</span>
                            </p>
                        </div>
                    </div>
                    <button type="button" class="btn_accept_popup btn_accept_coupon">
                        쿠폰적용
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="bg"></div>
</div>
<style>
    .popup_wraps.popup_wrap_cus_1 {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Dark background */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .padding {
        padding-inline: 60px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .form_input {
        margin-top: 30px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .form_input label {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 13px;
        color: #252525;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .form_input input {
        border-style: solid;
        border-width: 1px;
        border-color: rgb(229, 229, 229);
        border-radius: 2px;
        background-color: rgb(255, 255, 255);
        width: 100%;
        height: 50px;
        margin-top: 20px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_head {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 55px;
        background-color: #2a459f!important;
        border-radius: 5px 5px 0 0;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_head .text {
        color: #fff;
        text-align: left;
        width: 100%;
        padding: 0 22px;
        font-size: 20px;
        font-weight: 500;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_ttl {
        font-size: 20px;
        font-weight: bold;
        color: #fff;
        text-align: center;
        line-height: 68px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_box .close {
        top: 50%;
        transform: translateY(-50%);
        right: 25px;
        background: none;
        position: absolute;
        opacity: 1;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_box .pop_input {
        margin-top: 98px;
        display: block;
        height: unset;
        background-color: #fff;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_footer {
        margin-top: 40px;
        display: flex;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .policy {
        border-style: solid;
        border-width: 1px;
        border-color: rgb(229, 229, 229);
        border-radius: 2px;
        background-color: rgb(255, 255, 255);
        width: 100%;
        height: 142px;
        overflow: auto;
        padding: 5px;
    }

    .popup_wraps.popup_wrap_cus_1 .pop_box .pop_footer button {
        border-radius: 4px;
        color: #454545;
        font-size: 18px;
        height: 62px;
        background-color: rgb(242, 242, 242);
        color: #252525;
        font-weight: 500;
        margin-left: 12px;
    }

    .popup_wraps.popup_wrap_cus_1 .pop_box .pop_footer button:first-child {
        background-color: #209e80 !important;
        box-shadow: 0px 16px 15.04px 0.96px rgba(46, 62, 146, 0.28);
        color: #fff;
        margin-left: 0;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_box {
        width: 600px;
        position: relative;
        background: white;
        border-radius: 5px;
    }

    .popup_wraps.popup_wrap_cus_1.send_mail_pop .padding {
        padding-inline: 0;
    }
     .main_content_ {
        border-radius: 20px;
        margin-top: 50px;
        padding: 30px;
        width: 100%;
        background-color: rgba(219, 219, 219, 0.25);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 20px;
    }

     .main_content_ .title_ {
        font-size: 24px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

     .main_content_ .number_ {
        background-color: #FFFFFF;
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 32px;
        letter-spacing: 2px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

     .main_content_ .sup_title_ {
        font-size: 24px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

     .main_content_ .content_ {
        font-size: 16px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #2a459f;
    }
</style>

<script>
$('.couponSel').click(function () {
		 $('.couponSel').removeClass('active'); // 모든 버튼에서 'active' 제거
		 $(this).addClass('active');     // 클릭한 버튼에만 'active' 추가
		 $('.couponApply').removeClass('active'); // 모든 버튼에서 'active' 제거

		 var payment_tot  = $("#payment_tot").val()*1;
		 var coupon_idx   = $(this).data('idx');
		 var coupon_num   = $(this).data('num');	
		 var coupon_name  = $(this).data('name');	
		 var coupon_pe    = $(this).data('pe')*1;
		 var coupon_price = $(this).data('price')*1;

		 $("#coupon_idx").val(coupon_idx);
		 $("#coupon_num").val(coupon_num);	
		 $("#coupon_name").val(coupon_name);	
		 $("#coupon_pe").val(coupon_pe);
		 $("#coupon_price").val(coupon_price);

		 payment_acnt(); 
});

$('.couponApply').click(function () {
		 $('.couponSel').removeClass('active'); // 모든 버튼에서 'active' 제거
		 $(this).toggleClass('active'); // 클래스 추가/제거	 

		 $("#coupon_idx").val('');
		 $("#coupon_num").val('');	
		 $("#coupon_name").val('');	
		 $("#coupon_pe").val('0');
		 $("#coupon_price").val('0');

		 $("#used_coupon_money").val('0');
		 $("#coupon_discount").text('0') +' 원';

		 payment_acnt(); 

});
</script>

<script>
	$('#use_point').blur(function () {
		var point = $(this).val();
		$('#used_point').val(point);
    	$("#use_point_txt").text(point.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		payment_acnt(); 
	});
</script>

<script>
function payment_acnt()
{
		 var coupon_idx   = $("#coupon_idx").val();
		 var coupon_num   = $("#coupon_num").val();	
		 var coupon_name  = $("#coupon_name").val();	
		 var payment_tot  = $("#payment_tot").val()*1;
		 var coupon_pe    = $("#coupon_pe").val()*1;
		 var coupon_price = $("#coupon_price").val()*1;
		 var used_point   = $("#used_point").val()*1;

		 if(coupon_pe > 0) {
			var used_coupon_money = parseInt(payment_tot * coupon_pe / 100);
		 } else {  
			var used_coupon_money = coupon_price;
		 }
		 $("#used_coupon_money").val(used_coupon_money);
		 $("#coupon_discount").text(used_coupon_money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +' 원');

		 var payment_price = payment_tot - used_coupon_money - used_point;
		 //alert(payment_price);
		 $("#payment_price").val(payment_price);
		 $("#minus_point").text(used_point.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		 $("#minus_coupon").text(used_coupon_money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		 $(".lastPrice").text(payment_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		 
		 $("#Amt").val(payment_price);
		 $("#price").val(payment_price);

         var f = document.formOrder;
		 var order_data = $(f).serialize();
		 $.ajax({
				url: "/ajax/get_last_sum",
				type: "POST",
				data: order_data,
				dataType: 'json',
				success: function (res) {
					var EdiDate     =  res.EdiDate;
					var hashString  =  res.hashString;
					var timestamp   =  res.timestamp;
					var mKey        =  res.mKey;
					var sign        =  res.sign;
					var sign2       =  res.sign2;
					$("#EdiDate").val(EdiDate);
					$("#SignData").val(hashString);
					$("#signature").val(sign);
					$("#verification").val(sign2);
					$("#mKey").val(mKey);
					$("#timestamp").val(timestamp);
					$("#Moid").val(orderNumber);
					$("#oid").val(orderNumber);
					$("#Amt").val(sum);
					$("#price").val(sum);
				}
         })
}
</script>

<script>
$(window).on("load", function() {

		$.ajax({
            url: "/ajax/get_cart_sum",
            type: "POST",
            data: {
                    "payment_no" : $("#payment_no").val() 
            },
            dataType: 'json',
            success: function (res) {
				var sum         =  res.sum;
				var lastPrice   =  res.lastPrice;
				var EdiDate     =  res.EdiDate;
				var hashString  =  res.hashString;
				var timestamp   =  res.timestamp;
				var mKey        =  res.mKey;
                var sign        =  res.sign;
                var sign2       =  res.sign2;
                var orderNumber =  res.orderNumber;
				$("#EdiDate").val(EdiDate);
				$("#SignData").val(hashString);
                $("#signature").val(sign);
                $("#verification").val(sign2);
				$("#mKey").val(mKey);
				$("#timestamp").val(timestamp);
                $("#Moid").val(orderNumber);
	            $("#oid").val(orderNumber);
				$("#Amt").val(lastPrice);
				$("#price").val(lastPrice);
				$("#payment_price").val(sum);
				$("#product_sum").text(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
				$("#payment_tot").val(sum);
				$(".paySum").text(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +' 원');
				$("#minus_coupon").text(coupon_money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +' 원');
				$("#minus_point").text(point.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +' 원');
				$(".lastPrice").text(lastPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +' 원');

				$("#total_price_popup").text(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +' 원');
            }
        })
});
</script>

<script>
function reqPG()
{
        const selectedValue = $('input[name="inp_radio"]:checked').val();

		if($("#pay_name").val() == "") {
		   alert('결제자 성명을 입력하세요');
		   $("#pay_name").focus();
		   return false;
        }

		if($("#pay_email").val() == "") {
		   alert('결제자 이메일을 입력하세요');
		   $("#pay_email").focus();
		   return false;
        }

		if($("#pay_hp").val() == "") {
		   alert('결제자 연락처를 입력하세요');
		   $("#pay_hp").focus();
		   return false;
        }

        payInfo_update();

		$("#BuyerName").val($("#pay_name").val());
		$("#BuyerEmail").val($("#pay_email").val());
		$("#BuyerTel").val($("#pay_hp").val());

		$("#buyername").val($("#pay_name").val());
		$("#buyeremail").val($("#pay_email").val());
		$("#buyertel").val($("#pay_hp").val());
		
		if(selectedValue == "vbank" || selectedValue == "bank" || selectedValue == "cardNicepay") {
		   if(selectedValue == "vbank")       $("#PayMethod").val('VBANK');
		   if(selectedValue == "bank")        $("#PayMethod").val('BANK');
		   if(selectedValue == "cardNicepay") $("#PayMethod").val('CARD');
		   nicepayStart();
        } else if(selectedValue == "cardInicis") {
		   if(selectedValue == "cardInicis")  $("#gopaymethod").val('Card');
		   paybtn();
         } else {
		   depositBtn();
        }       
}

function depositBtn()
{
		$("#paymentNo").val($("#payment_no").val());
		$("#depositForm").submit();
}

function payInfo_update()
{
		$.ajax({
            url: window.location.protocol + "//" + window.location.host + "/ajax/payInfo_update",
            type: "POST",
            data: {
                    "payment_no" : $("#payment_no").val(), 
                    "pay_name"   : $("#pay_name").val(), 
                    "pay_email"  : $("#pay_email").val(), 
                    "pay_hp"     : $("#pay_hp").val() 
            },
            dataType: 'json',
            success: function (res) {
				var message  =  res.message;
				//alert(message);
			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText); // 서버 응답 내용 확인
				alert('Error: ' + error);
			}

        })
}
</script>

<form id="depositForm" method="post" action="/checkout/deposit_result">
<input type="hidden" name="payment_no" id="paymentNo" value="" >
</form>

<script>
    $(document).ready(function() {
        $(".open_popup").click ( function() {
            $(".popup_wraps").show()
            console.log("kkk")
        })
        $(".popup_wraps.popup_wrap_cus_1.send_mail_pop .pop_box .close").click(function() {
            $(".popup_wraps").hide()
        })
    })
    
</script>

<script>
    $(document).ready(function() {

        $("#save_id").click(function() {
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

        $(".phone").on("input", function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        });

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

        $("input[name='radio_phone'").change(function() {
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

    $("#policy_show").on("click", function() {
        $(".policy_pop, .policy_pop .dim").show();
    });

    $('.item_check_term_').click(function() {
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

        $('.item_check_term_').each(function() {
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

    $('.item_check_term_all_').click(function() {
        $(this).toggleClass('checked_');
        let allChecked = $(this).hasClass('checked_');
        let value = allChecked ? 'Y' : 'N';
        $(this).find('input').val(value);

        $('.item_check_term_').each(function() {
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

    function showCouponPop() {
        $("#popup_coupon").css('display', 'flex');
    }

    const $closePopupBtn = $('.close-btn');
    $closePopupBtn.on('click', function() {
        $("#popup_coupon").css('display', 'none');
    });

</script>

<?= $this->include('/nicepay/nicepay_web') ?>

<?php $this->endSection(); ?>