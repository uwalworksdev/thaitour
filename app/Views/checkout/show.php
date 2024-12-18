<?php $this->extend('inc/layout_index'); ?>
<?php $setting = homeSetInfo(); ?>

<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/contents/checkout.css">
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
    <div class="main-section ">
        <div class="body_inner">
            <form action="#" class="formOrder " id="formOrder">
                <div class="container-card cus_item_spa_">
                    <div class="form_booking_spa_">
                        <div class="card-left2">
                            <h3 class="title-main-c">
                                예약상세내역
                            </h3>

                            <table class="table-container only_web">
                                <colgroup>
                                    <col width="*">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="17%">
                                </colgroup>
                                <thead>
                                <tr class="table-header">
                                    <th>상품</th>
                                    <th>금액</th>
                                    <th>할인금액</th>
                                    <th>결제예정금액</th>
                                </tr>
                                </thead>
                                <tbody>

								<?php $payment_tot = $payment_cnt = 0; ?>
								<?php if (!empty($result)) : ?>
									<?php foreach ($result as $order) : ?>
									<?php $payment_tot = $payment_tot + $order['order_price']; ?>
									<?php $payment_cnt = $payment_cnt + 1; ?>
									<tr>
										<td class="custom-td-product-info">
											<div class="product-info">
												<div class="product-details">
													<div class="product-name"><?=$order['product_name']?></div>
													<p class="product-desc text-gray">
														<?=$order['order_date']?><br> 
														<?php 
															if (!empty($order['options'])) {
																$options = explode('|', $order['options']);
																foreach ($options as $option) {
																	echo esc($option) . '<br>';
																}
															}
														?>
													</p>
												</div>
											</div>
										</td>
										<td class="price" style="color: #333; font-weight: bold;">
											<?=number_format($order['order_price'])?> 원<br>
											(<?=number_format($order['order_price'] / $setting['baht_thai'])?> 바트)
										</td>
										<td class="discount">
											<div class="product-discount">
												<p style="color: #333; font-weight: bold;">0원</p>
												<p class="text-primary">실버회원 회원 할인</p>
											</div>
										</td>
										<td class="total" style="color: #333; font-weight: bold;"><?=number_format($order['order_price'])?> 원</td>
									</tr>
				                    <?php endforeach; ?>
                                <?php endif; ?>

                                <!--tr>
                                    <td class="custom-td-product-info">
                                        <div class="product-info">
                                            <div class="product-details">
                                                <div class="product-name">[투어] 아난타라 시암 방콕 호텔</div>
                                                <p class="product-desc text-gray">
                                                    2025-01-04(토) | 14:30~20:30 | [프로모션] 아유타야 | 오후 성인 1
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" style="color: #333; font-weight: bold;">
                                        345,600원
                                        (8,000바트)
                                    </td>
                                    <td class="discount">
                                        <div class="product-discount">
                                            <p style="color: #333; font-weight: bold;">0원</p>
                                            <p class="text-primary">실버회원 회원 할인</p>
                                        </div>
                                    </td>
                                    <td class="total" style="color: #333; font-weight: bold;">1,230,000 원</td>
                                </tr-->

                                </tbody>
                            </table>

                            <div class="table-container custom-mo only_mo">
							<?php if (!empty($result)) : ?>
								<?php foreach ($result as $order) : ?>
                                <div class="item">
                                    <div class="con-up">
                                        <div class="text-right-p">
                                            <h3 class="title-p">
                                                <?=$order['product_name']?>
                                            </h3>
                                            <div class="time-date-p">
                                                <?=$order['order_date']?>
                                            </div>
                                            <p class="des-p">
											<?php 
												if (!empty($order['options'])) {
													$options = explode('|', $order['options']);
													foreach ($options as $option) {
														echo esc($option) . '<br>';
													}
												}
											?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="des-space-p">
                                        <div class="des-item">
                                            <span class="space-left">금액</span>
                                            <span><?=number_format($payment_tot)?> 원</span>
                                        </div>
                                        <div class="des-item">
                                            <span class="space-left">할인금액</span>
                                            <span>0원</span>
                                        </div>
                                        <div class="des-item">
                                            <span class="space-left">결제예정금액</span>
                                            <span><?=number_format($payment_tot)?> 원</span>
                                        </div>
                                    </div>
                                </div>
				                <?php endforeach; ?>
							<?php endif; ?>

                                <!--div class="item">
                                    <div class="con-up">
                                        <div class="text-right-p">
                                            <h3 class="title-p">
                                                아난타라 시암 방콕 호텔
                                            </h3>
                                            <div class="time-date-p">
                                                2024.08.10(토)
                                            </div>
                                            <p class="des-p">
                                                54홀 골프 패키지1(54 홀 라운딩 + 갤러리아12 2인 1실 + 전일차량 성인 4 / 아동 2
                                            </p>
                                        </div>
                                    </div>
                                    <div class="des-space-p">
                                        <div class="des-item">
                                            <span class="space-left">금액</span>
                                            <span>1,467,360 원</span>
                                        </div>
                                        <div class="des-item">
                                            <span class="space-left">할인금액</span>
                                            <span>0원</span>
                                        </div>
                                        <div class="des-item">
                                            <span class="space-left">결제예정금액</span>
                                            <span>1,230,000 원</span>
                                        </div>
                                    </div>
                                </div-->
                            </div>
                        </div>

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

                    <div class="card-right2 spa-detail">
                        <h3 class="title-r">
                            선택상품 : <?=$payment_cnt?> 건
                        </h3>

                        <div class="item-info-r">
                            <span>예상 합계금액</span>
                            <span style="color: #333; font-weight: bold;">
                                <span class="textTotalPrice lastPrice"><?=number_format($payment_tot)?></span> 원
                            </span>
                        </div>

                        <div class="item-info-r item-info-r-border-b">
                            <span>할인금액</span>
                            <span style="color: #333; font-weight: bold;">
                                <span class="textTotalPrice lastPrice"> </span> 
                            </span>
                        </div>

                        <div class="item-info-r">
                            <span style="color: #333; font-weight: bold;">총 결제금액</span>
                            <span style="color: #333; font-weight: bold;">
                                <span class="textTotalPrice lastPrice"><?=number_format($payment_tot)?></span> 원
                            </span>
                        </div>

                        <p class="below-des-price">
                            · 상품을 장바구니에 넣은 것만으로는 가능여부<br>
                            확인이나 예약이 되지 않으며 고객님의<br>
                            장바구니에 담긴 내용은 관리자도 알 수 없습니다.<br>
                            · 예약을 접수해주시면<br>
                            "마이페이지 → 나의 예약현황" 메뉴에서<br>
                            확인하실 수 있습니다.
                        </p>

                        <h3 class="title-r label">약관동의</h3>
                        <div class="item-info-check item_check_term_all_">
                            <label for="fullagreement">전체동의</label>
                            <input type="hidden" value="N" id="fullagreement">
                        </div>
                        <div class="item-info-check item_check_term_">
                            <label for="">이용약관 동의(필수)</label>
                            <input type="hidden" value="N" id="terms" class="agree">
                        </div>
                        <div class="item-info-check item_check_term_">
                            <label for="">개인정보 처리방침(필수)</label>
                            <input type="hidden" value="N" id="policy" class="agree">
                        </div>
                        <div class="item-info-check item_check_term_">
                            <label for="">개인정보 제3자 제공 및 국외 이전 동의(필수)</label>
                            <input type="hidden" value="N" id="information" class="agree">
                        </div>
                        <div class="item-info-check item_check_term_">
                            <label for="guidelines">여행안전수칙 동의(필수)</label>
                            <input type="hidden" value="N" id="guidelines" class="agree">
                        </div>

                        <button class="btn-order btnOrder" onclick="completeOrder();" type="button">결제하기</button>
                        <!--button class="btn-order btnOrder" onclick="nicepayStart();" type="button">결제하기</button-->
                        <button class="btn-cancel btnCancel" onclick="cancelOrder();" type="button">취소하기</button>
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


<form id="paymentForm" action="/checkout/confirm" method="post">
<input type="hidden" name="dataValue" id="dataValue" value="<?=$_REQUEST['dataValue']?>" >
</form>

<script>
var count = $(".agree").filter(function () {
    return $(this).val() === "Y";
}).length;

if(count < 4) {
	alert('약관에 동의를 하셔야 에약이 가능합니다.');
	return false;
}
</script>

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

    function number_format(number, decimals = 0, dec_point = '.', thousands_sep = ',') {
        number = parseFloat(number).toFixed(decimals);
        number = number.toString().replace('.', dec_point);
        let parts = number.split(dec_point);
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
        return parts.join(dec_point);
    }
</script>
<script>
    function completeOrder() {
        //window.location.href = "/checkout/confirm";
		$("#paymentForm").submit();
    }
</script>


<?php
header("Content-Type:text/html; charset=utf-8;"); 
/*
*******************************************************
* <결제요청 파라미터>
* 결제시 Form 에 보내는 결제요청 파라미터입니다.
* 샘플페이지에서는 기본(필수) 파라미터만 예시되어 있으며, 
* 추가 가능한 옵션 파라미터는 연동메뉴얼을 참고하세요.
*******************************************************
*/  

$merchantKey = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // 상점키
$MID         = "nicepay00m"; // 상점아이디
$goodsName   = "나이스페이"; // 결제상품명
$price       = "1004"; // 결제상품금액
$buyerName   = "나이스"; // 구매자명 
$buyerTel	 = "01000000000"; // 구매자연락처
$buyerEmail  = "happy@day.co.kr"; // 구매자메일주소        
$moid        =  time(); // 상품주문번호                     
$returnURL	 = "https://thetourlab.com/payment/result"; // 결과페이지(절대경로) - 모바일 결제창 전용

/*
*******************************************************
* <해쉬암호화> (수정하지 마세요)
* SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다. 
*******************************************************
*/ 
$ediDate    = date("YmdHis");
$hashString = bin2hex(hash('sha256', $ediDate.$MID.$price.$merchantKey, true));
?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(EUC-KR)</title>
<meta charset="utf-8">
<style>
	html,body {height: 100%;}
	form {overflow: hidden;}
</style>
<script src="https://pg-web.nicepay.co.kr/v3/common/js/nicepay-pgweb.js" type="text/javascript"></script>
<script type="text/javascript">
//결제창 최초 요청시 실행됩니다.
function nicepayStart(){
	goPay(document.payForm);
}

//[PC 결제창 전용]결제 최종 요청시 실행됩니다. <<'nicepaySubmit()' 이름 수정 불가능>>
function nicepaySubmit(){
	document.payForm.submit();
}

//[PC 결제창 전용]결제창 종료 함수 <<'nicepayClose()' 이름 수정 불가능>>
function nicepayClose(){
	alert("결제가 취소 되었습니다");
}
</script>
</head>
<body>
<form name="payForm" method="post" action="/payment/result">
	<table>
		<tr>
			<th>결제 수단</th>
			<td><input type="text" name="PayMethod" value=""></td>
		</tr>
		<tr>
			<th>결제 상품명</th>
			<td><input type="text" name="GoodsName" value="<?php echo($goodsName)?>"></td>
		</tr>
		<tr>
			<th>결제 상품금액</th>
			<td><input type="text" name="Amt" value="<?php echo($price)?>"></td>
		</tr>				
		<tr>
			<th>상점 아이디</th>
			<td><input type="text" name="MID" value="<?php echo($MID)?>"></td>
		</tr>	
		<tr>
			<th>상품 주문번호</th>
			<td><input type="text" name="Moid" value="<?php echo($moid)?>"></td>
		</tr> 
		<tr>
			<th>구매자명</th>
			<td><input type="text" name="BuyerName" value="<?php echo($buyerName)?>"></td>
		</tr>
		<tr>
			<th>구매자명 이메일</th>
			<td><input type="text" name="BuyerEmail" value="<?php echo($buyerEmail)?>"></td>
		</tr>		
		<tr>
			<th>구매자 연락처</th>
			<td><input type="text" name="BuyerTel" value="<?php echo($buyerTel)?>"></td>
		</tr>	 
		<tr>
			<th>인증완료 결과처리 URL<!-- (모바일 결제창 전용)PC 결제창 사용시 필요 없음 --></th>
			<td><input type="text" name="ReturnURL" value="<?php echo($returnURL)?>"></td>
		</tr>
		<tr>
			<th>가상계좌입금만료일(YYYYMMDD)</th>
			<td><input type="text" name="VbankExpDate" value=""></td>
		</tr>		
					
		<!-- 옵션 -->	 
		<input type="hidden" name="GoodsCl" value="1"/>						<!-- 상품구분(실물(1),컨텐츠(0)) -->
		<input type="hidden" name="TransType" value="0"/>					<!-- 일반(0)/에스크로(1) --> 
		<input type="hidden" name="CharSet" value="utf-8"/>				<!-- 응답 파라미터 인코딩 방식 -->
		<input type="hidden" name="ReqReserved" value=""/>					<!-- 상점 예약필드 -->
					
		<!-- 변경 불가능 -->
		<input type="hidden" name="EdiDate" value="<?php echo($ediDate)?>"/>			<!-- 전문 생성일시 -->
		<input type="hidden" name="SignData" value="<?php echo($hashString)?>"/>	<!-- 해쉬값 -->
	</table>
	<!--a href="#" class="btn_blue" onClick="nicepayStart();">요 청</a-->
</form>

<?php $this->endSection(); ?>
