<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
$connect     = db_connect();
$private_key = private_key();

if ($_SESSION["member"]["mIdx"] == "") {
	alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
	exit();
}

$deli_types = get_deli_type();

?>
<link href="/css/invoice/invoice.css" rel="stylesheet" type="text/css" />
<link href="/css/invoice/invoice_responsive.css" rel="stylesheet" type="text/css" />

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new02.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive.css" rel="stylesheet" type="text/css" />

<style>
	.mypage_container .content .details_table tbody tr .date {
		width: fit-content;
		padding: 0 15px;
	}

	.mypage_container .content .details_table tbody tr .date:after {
		right: -0.9615rem;
	}

	.mypage_container .content .details_table tbody tr .date:nth-child(2) {
		padding: 0 15px;
	}

	.mypage_container .content .details_table tbody tr .ttl {
		padding: 0 15px;
	}

	/* .mypage_container .content .details_table tbody tr .ttl span {
		padding-right: 6.3846rem;
	} */
</style>

<?php
    $authdate   = "";
    if($AuthDate_1) {
		$year   = "20" . substr($AuthDate_1, 0, 2);
		$month  = substr($AuthDate_1, 2, 2);
		$day    = substr($AuthDate_1, 4, 2);
		$hour   = substr($AuthDate_1, 6, 2);
		$minute = substr($AuthDate_1, 8, 2);
		$second = substr($AuthDate_1, 10, 2);

		// 최종 형식
		$authdate = "$year-$month-$day $hour:$minute:$second";
    }	
?>

<section class="invoice_paid">
	<div class="inner">
		<div class="ttl_box">
			<h1>
				<?= (html_entity_decode($product_name)) ?>
			</h1>
			<span class="stt_2">
				<?= $deli_types[$order_status] ?>
			</span>
		</div>
		<p class="ttl_date">
			<?= $row["order_r_date"] ?>
		</p>
		<!-- 웹 -->
		<div class="invoice_table invoice_table_new only_web">
			<div class="flex_b_c invoice_wrap_ttl">
				<h2 style="margin: 0;">예약 정보(투어)</h2>

				<div class="flex invoice_wrap_btn">
					<?php
						if($order_status != "W") {
					?>
						<button type="button" class="btn_invoice info_estimate" data-idx="<?=$order_idx?>">인보이스</button>
                    <?php } ?>
					<?php
						if($order_status == "Z" || $order_status == "E") {
					?>
						<button type="button" class="btn_invoice info_voucher" data-idx="<?=$order_idx?>">바우처</button>
                    <?php } ?>
				</div>
			</div>
			<table>
				<colgroup>
					<col width="20%">
					<col width="*">
					<col width="15%">
					<col width="20%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">예약번호</td>
						<td class="subject">예약일자</td>
						<td class="subject">예약인원</td>
						<td class="subject">투어일자</td>
						<td class="subject">성인</td>
						<td class="subject">아동</td>
						<td class="subject">유아</td>
					</tr>
					<tr>

						<td class="content">
							<span>
								<?= $order_no ?>
							</span>
						</td>

						<td class="content">
							<span>
								<?= $order_date ?>
							</span>
						</td>

						<td class="content">
							<span><?= $people_adult_cnt + $people_kids_cnt + $people_baby_cnt?></span>명  
						</td>

						<td class="content">
							<span><?= $order_day ?></span>
						</td>
						<td class="content">
							<p>
							<span><?= $people_adult_cnt ?>명 <?=number_format($people_adult_price)?>원</span><br>
							</p>
						</td>
						<td class="content">
							<p>
							<span><?= $people_kids_cnt ?>명 <?=number_format($people_kids_price)?>원</span><br>  
							</p>
						</td>
						<td class="content">
							<p>
							<span><?= $people_baby_cnt?>명 <?=number_format($people_baby_price)?>원</span> 
							</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- 예약정보 모바일 -->

		<div class="invoice_table invoice_table_new only_mo">
			<h2>예약 정보</h2>
			<table>
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">예약번호</td>
						<td class="content">
							<span>
								<?= $order_no ?>
							</span>
						</td>
					</tr>
					<tr>
						<td class="subject">여행인원</td>
						<td class="content">
							<span>성인: <span>
									<?= $people_adult_cnt ?>명 <?=number_format($people_adult_price)?>원<br>
								</span></span> 
							<span>아동: <span>
									<?= $people_kids_cnt ?>명 <?=number_format($people_kids_price)?>원<br>
								</span></span> 
							<span>유아: <span>
									<?= $people_baby_cnt ?>명 <?=number_format($people_baby_price)?>원
								</span></span>
						</td>
					</tr>
					<tr>
						<td class="subject">예약일자</td>

						<td class="content">
							<?= $order_date ?>
						</td>
					</tr>
					<tr>
						<td class="subject">투어일자</td>

						<td class="content">
							<span><?= $order_day ?></span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<section class="ord_total_sec reservation">
			<div class="flex_b_c">
				<div class="left flex">
					<strong class="label red">상품 예약금액</strong>
					<div class="detail_money tar flex_e_c">
									
						<?php if ($option_amt > 0) { ?>
							<p><strong>옵션금액 <span id="option_amt">
										<?= number_format($option_amt) ?>원
									</span></strong></p>
						<?php } ?>

						<?php if ($used_coupon_money > 0) { ?>
							<p><strong style="color:red">쿠폰 <span id="coupon_amt">
										<?= number_format($used_coupon_money) ?>원
									</span></strong></p>
						<?php } ?>

						<?php if ($used_mileage_money > 0) { ?>
							<p><strong style="color:red">포인트 <span id="point_amt">
										<?= number_format($used_mileage_money) ?>원
									</span></strong></p>
						<?php } ?>

					</div>
				</div>
				<div class="total_money tar">
					<div class="defen_ttl flex">
						<p><strong><span id="price_tot">
									<?= number_format($order_price) ?></span></strong> 원(<?=number_format($order_price / $baht_thai)?>바트)
								</p>
					</div>
				</div>
			</div>
		</section>
		<!--section class="ord_total_sec reservation">
			<div class="flex_b_c">
				<div class="left flex">
					<strong class="label red">실예약금액</strong>
					<div class="detail_money tar flex_e_c">


					</div>
				</div>
				<div class="total_money tar">
					<div class="defen_ttl flex">
						<p><strong><span id="price_tot">
									<?= number_format($row['deposit_price'] + $row['order_confirm_price']) ?></strong>
							</span> 원</p>
					</div>
				</div>
			</div>
		</section-->
        <div class="invoice_table invoice_table_new reservation only_web">
			<h2>투어 옵션금액</h2>
			<table>
				<colgroup>
					<col width="*">
					<col width="25%">
					<col width="25%">
					<col width="25%">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">옵션구분</td>
						<td class="subject">단가(원)</td>
						<td class="subject">건수</td>
						<td class="subject">옵션금액(원)</td>
					</tr>
					
					<?php
					    foreach ($tour_option as $row)  
						{
							if($row['option_type'] == "main") {
								$option_price = $row['option_tot'] / $row['option_cnt'];
							} else	{
								$option_price = $row['option_price'];
							}	
							
					?>		
							<tr>
								<td class="content"><?=$row['option_name']?></td>
								<td class="content"><?=number_format($option_price)?></td>
								<td class="content"><?=number_format($row['option_cnt'])?></td>
								<td class="content"><?=number_format($row['option_tot'])?></td>
							</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>

		<div class="invoice_table invoice_table_new only_mo">
			<h2>투어 옵션금액</h2>
					<?php
						foreach ($tour_option as $row)  
						{
							 if($row['option_type'] == "main") {
								$option_price = $row['option_tot'] / $row['option_cnt'];
							 } else	{
								$option_price = $row['option_price'];
							 }	
							 
							 $option_price = $option_price * $baht_thai;
					?>
			<table style="margin-top: -1px; border-top: 2px solid rgb(37 37 37 / 46%) !important;">
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">옵션구분</td>
						<td class="content">
							<span>
								<?=$row['option_name']?>
							</span>
						</td>
					</tr>
					<tr>
						<td class="subject">단가(원)</td>
						<td class="content">
							<span>
								<?=number_format($option_price)?>
							</span>
						</td>
					</tr>
					<tr>
						<td class="subject">건수</td>
						<td class="content">
							<span>
								<?=number_format($row['option_cnt'])?>
							</span>
						</td>
					</tr>
					<tr>
						<td class="subject">옵션금액(원)</td>
						<td class="content">
							<span>
								<?=number_format($row['option_tot'])?>
							</span>
						</td>
					</tr>
				</tbody>
			</table>

			<?php } ?>		
		</div>
		
		<?php if ($order_status == "Y" || $order_status == "Z" || $order_status == "E") { ?>
		<div class="invoice_table invoice_table_new reservation only_web">
			<h2>예약금액 결제</h2>
			<table>
				<colgroup>
					<col width="8%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">예약상태</td>
						<td col width="15%" class="subject">결제방법</td>
						<td col width="15%" class="subject">쿠폰</td>
						<td col width="15%" class="subject">포인트</td>
						<td col width="15%" class="subject">결제금액(원)</td>
						<td col width="15%" class="subject">결제일시</td>
					</tr>

					<tr>
						<td col width="8%" class="content"><?= $deli_types[$order_status] ?></td>

						<td class="content"><?= $order_method ?></td>

						<td class="content"><?= number_format($used_coupon_money) ?></td>

						<td class="content"><?= number_format($used_mileage_money) ?></td>

						<td class="content"><?= number_format($order_price) ?></td>

						<td class="content">
							<?php if ($order_method == "신용카드") { ?>
								<?=$authdate?>
							<?php } else { ?>
								<?= date($order_confirm_date); ?>
							<?php } ?>						
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php } ?>

		<?php if ($order_status == "Y" || $order_status == "Z" || $order_status == "E") { ?>
		<div class="invoice_table invoice_table_new only_mo">
			<h2>예약금액 결제</h2>
			<table>
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
						<tr>
							<td class="subject">예약상태</td>

							<td class="content">
								<?= $deli_types[$order_status] ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제방법</td>

							<td class="content">
								<?= $order_method ?>
							</td>
						</tr>
						<tr>
							<td class="subject">쿠폰</td>

							<td class="content">
								<?= number_format($used_coupon_money) ?>
							</td>
						</tr>
						<tr>
							<td class="subject">포인트</td>

							<td class="content">
								<?= number_format($used_mileage_money) ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제금액</td>

							<td class="content">
								<?= number_format($order_price) ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제일</td>

							<td class="content">
							<?php if ($order_method == "신용카드") { ?>
								<?=$authdate?>
							<?php } else { ?>
								<?= date($order_confirm_date); ?>
							<?php } ?>						
								
							</td>
						</tr>
				</tbody>
			</table>
		</div>
        <?php } ?>

		<section class="earn_pops my_pops" style="display:none;">
			<div class="pay_pops_inner pay_count02" style="display:none;">
				<div class="pay_h">
					<h2>무통장입금</h2>
				</div><!-- pay_h -->
				<div class="account">
					<h3>국민은행 예금주(주식회사 블루스카이투어) <br>535501-04-141688</h3>
					<p>
						김철수님! 무통장입금을 신청하셨습니다. <br>
						입금후 담당자에게 연락부탁드립니다. <br>
						감사합니다.
					</p>
				</div>
				<div class="pay_pop_btn">
					<a href="#!" class="btn pops_btn cancel close_btn">닫기</a>
				</div>
			</div><!-- pay_pops_inner  --> <!-- 무통장입금 팝업 종료 -->
		</section>

		<div class="invoice_table invoice_table_new only_web">
			<h2>예약자 정보</h2>
			<table>
				<colgroup>
					<col width="8%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">이름</td>
						<td col width="8%" class="subject">생년월일</td>
						<td col width="12%" class="subject">휴대번호</td>
						<td col width="12%" class="subject">현지전화번호 </td>
						<td col width="12%" class="subject">이메일</td>
						<td col width="15%" class="subject">여권번호</td>
					</tr>
					<tr>

						<td col width="8%" class="content">
							<?= $order_user_name?>
						</td>

						<td class="content">
							<?= $order_birth_date ?>
						</td>

						<td class="content">
							<?= $order_user_mobile ?>
						</td>

						<td class="content">
							<?= $local_phone ?>
						</td>

						<td class="content">
							<?= $order_user_email ?>
						</td>

						<td class="content">
							<?=$order_passport_number ?>
						</td>

				</tbody>
			</table>
		</div>

		<div class="invoice_table invoice_table_new only_mo">
			<h2>예약자 정보</h2>
			<table>
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">이름</td>
						<td class="content">
							<?= $order_user_name?>
						</td>
					</tr>
					<tr>
						<td class="subject">생년월일</td>
						<td class="content">
							<?= $order_birth_date ?>
						</td>
					</tr>
					<tr>
						<td class="subject">휴대번호</td>

						<td class="content">
							<?= $order_user_mobile ?>
						</td>
					</tr>
					<tr>
						<td class="subject">현지전화번호</td>

						<td class="content">
							<?= $local_phone ?>
						</td>
					</tr>
					<tr>
						<td class="subject">이메일</td>

						<td class="content">
							<?= $order_user_email ?>
						</td>
					</tr>
					<tr>
						<td class="subject">여권번호</td>
						<td class="content">
							<?=$order_passport_number ?>
						</td>
					</tr>

				</tbody>
			</table>
		</div>

		<div class="invoice_table">
			<h2>요청사항</h2>
			<table>
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
					<?php if(!empty($pickup_place)):?>
                                        <tr>
                                            <td class="subject">픽업장소</td>
											<td class="content">
												<?= $pickup_place ?>
											</td>
                                        </tr>
                                    <?php endif?>
                                    <?php if(!empty($sanding_place)):?>
                                        <tr>
                                            <td class="subject">샌딩장소</td>
                                            <td class="content">
												<?= $sanding_place ?>
											</td>
                                        </tr>
                                    <?php endif?>
                                    <?php if(!empty($start_place)):?>
                                        <tr>
                                            <td class="subject">미팅장소</td>
                                            <td class="content">
												<?= $start_place ?>
											</td>
                                        </tr>
                                    <?php endif?>
									 <?php if(!empty($end_place)):?>
                                        <tr>
                                            <td class="subject">종료 후 내리실 곳</td>
                                            <td class="content">
												<?= $end_place ?>
											</td>
                                        </tr>
                                    <?php endif?>
									 <?php if(!empty($id_kakao)):?>
                                        <tr>
                                            <td class="subject">카카오톡 아이디</td>
                                            <td class="content">
												<?= $id_kakao ?>
											</td>
                                        </tr>
                                    <?php endif?>
									<?php if(!empty($description)):?>
                                        <tr>
                                            <td class="subject">기타 요청</td>
                                            <td class="content">
												<?= $description ?>
											</td>
                                        </tr>
                                    <?php endif?>
									 <?php if(!empty($custom_req)):?>
                                        <tr>
                                            <td class="subject">요청사항</td>
                                            <td class="content">
												<?= $custom_req ?>
											</td>
                                        </tr>
                                    <?php endif?>
					<!-- <tr>
						<td class="subject">요청사항</td>
						<td class="content">
							<?= $custom_req ?>
						</td>
					</tr>
					<tr>
						<td class="subject">요청사항</td>
						<td class="content">
							<?= $custom_req ?>
						</td>
					</tr> -->
				</tbody>
			</table>
		</div>

		<!-- <div class="invoice_comment">
			<div class="invoice_comment-top">
				<div class="invoice_comment-count">
					<span>댓글</span>
					<span id="comment_count">(0)</span>
				</div>
				<form action="" id="frm" class="frm" name="com_form">
					<input type="hidden" name="code" id="code" value="order">
					<input type="hidden" name="r_code" id="r_code" value="order">
					<input type="hidden" name="r_idx" id="r_idx" value="<?= $order_idx ?>">
					<div class="invoice_comment-input">
						<textarea style="resize:none" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
						<button type="button" onclick="fn_comment(<?=session('member.idx')?>)">등록</button>
					</div>
				</form>
			</div>
			<div class="invoice_comment-details" id="comment_list">
				<?php
				$r_code = "order";
				$r_idx = $order_idx;

				// include $_SERVER['DOCUMENT_ROOT'] . "/include/comment_list.php" 
				?>
			</div>
		</div> -->

		<?php
			// echo view("inc/popup_inc");
		?>

		<div class="invoice_button">
			<button onclick="go_list('<?= $pg ?>');">목록으로</button>
			<?php if($order_status == "W" || $order_status == "C" || $order_status == "N") { ?>
			<button type="button" class="order_del" data-idx="<?=$order_idx?>">예약삭제</button>
			<?php } ?>
			<?php if($order_status == "X") { ?>
			<button class="btn_payment" data-idx="<?=$order_no?>">결제하기</button>
			<?php } ?>
		</div>
	</div>
</section>
<div class="modal_common img_pop">
	<div class="pop_item">
		<div class="pop_top">
			<button type="button" class="btn_close no_txt" onclick="PopCloseBtn('.img_pop')">
				닫기
			</button>
		</div>
		<div class="pop_content">
			<img style="margin:auto;max-height: 100%;" id="img_showing" src="" alt="">
		</div>
	</div>
	<div class="pop_dim" onclick="PopCloseBtn('.img_pop')"></div>
</div>
<?php

$_paymod = "nicepay";    // ini  ,  lg


if ($_paymod == "lg") {
	if (device_chk() == "MO") {
		$urlStr = "travel_cash.m.inc_bak_LG.php";
	} else {
		$urlStr = "travel_cash.inc_bak_LG.php";
	}
} else if ($_paymod == "nicepay") {
	if (device_chk() == "MO") {
		$urlStr = "travel_cash.m.inc_nicepay.php";
	} else {
		$urlStr = "travel_cash.inc_nicepay.php";
	}
} else if ($_paymod == "ini") {
	if (device_chk() == "MO") {
		$urlStr = "travel_cash.m.inc.php";
	} else {
		$urlStr = "travel_cash.inc.php";
	}
}
?>

<form id="checkOut" action="/checkout/confirmMypage" method="post">
<input type="hidden" name="m_idx"      id="m_idx"   value="<?= session("member.idx") ?>" >
<input type="hidden" name="payment_no" id="payment_no" value="" >
<input type="hidden" name="dataValue"  id="dataValue"  value="" >
</form>
<script>
	$(document).on('click', '.info_estimate', function () {

		var idx   = $(this).data('idx');  
		let url   = "/invoice/tour_01/" + idx; 
		
		window.open(url, "popupWindow", "width=1000,height=700,left=100,top=100");

	}); 

	$(document).on('click', '.info_voucher', function () {
		var idx   = $(this).data('idx');  
		let url   = "/voucher/tour/"+idx; 
		
		window.open(url, "popupWindow", "width=1000,height=700,left=100,top=100");
	});
	$(document).on('click', '.order_del', function () {

		var idx = $(this).data('idx'); 

        if (confirm("삭제하시겠습니까?\n삭제 후에는 복구가 불가능합니다.") == false) {
            return;
        }

        if(idx){
			$.ajax({

				url: "/ajax/ajax_booking_delete",
				type: "POST",
				data: {

					"idx": idx 

				},
				dataType: "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					var message = data.message;
					alert(message);
					location.reload();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});
        }		
	});
</script>
<script>
$(document).ready(function () {
    $(".btn_payment").on("click", function () {
        var dataValue = $(this).data("idx"); // 주문번호 가져오기
		$("#dataValue").val(dataValue);
		
		$.ajax({

			url: "/ajax/ajax_payment",
			type: "POST",
			data: {

				"dataValue": dataValue 

			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				var message = data.message;
				var payment_no = data.payment_no;
				$("#dataValue").val(dataValue);
				$("#payment_no").val(payment_no);
                $("#checkOut").submit();
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});
			
		
    });
});
</script>

<script type="text/javascript">
	function handlleShowPassport(img) {
		$("#img_showing").attr("src", img);
		$(".img_pop").show();
	}

	$(document).ready(function () {
		//못알창

		$('.btn_cash').click(function () {

			$.ajax({
				url: "<?= $urlStr ?>",
				type: "POST",
				data: "order_idx=" + $(this).attr("data_order_idx") + "&order_gubun=" + $(this).attr("data_order_gubun"),
				error: function (request, status, error) {
					//통신 에러 발생시 처리
					alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
					$("#ajax_loader").addClass("display-none");
				},
				complete: function (request, status, error) {
					//				$("#ajax_loader").addClass("display-none");
				},
				success: function (response, status, request) {
					$(".earn_pops").html(response);
					$('.my_pops').fadeIn('fast');
				}
			});


		});
		//faq
		$('.faq_box ul li h5 a').click(function () {
			$(this).parent().next('.faq_text').slideToggle();
		});
	});

	function pay_btn() { // 결제하기 작동버튼 임시 작성
		$(".pay_count01").hide();
		$(".pay_count02").fadeIn();
	}

	function search_it() {
		var frm = document.search;
		frm.submit();
	}
</script>

<script>
	$('.show_popup').on('click', function () {
		$('.agree_pop').show();
	});
	$(".popup_wrap .close, .popup_wrap .bg").on("click", function () {
		$(".popup_wrap").hide();
	});
</script>

<script>
	function go_list(pg) {
		location.href = '/mypage/reservation_list?pg=' + pg
	}
	$(".change_passport").change(function (evt) {
		if (evt.target.files?.[0]) {
			if (confirm("정말 업로드하시겠습니까?")) {
				const formData = new FormData();
				formData.append("passport_file", evt.target.files[0]);
				formData.append("gl_idx", $(evt.target).data("gl_idx"))
				$.ajax({
					type: "POST",
					url: "./ajax.change_passport_file.php",
					data: formData,
					contentType: false,
					processData: false,
					success: function (response, textStatus, jqXHR) {
						if (response.trim() == "OK") {
							alert("등록되었습니다");
							location.reload();
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.table(jqXHR)
					}
				});
			}
			evt.target.value = "";
		}
	})
	function handlleDelPassport(gl_idx) {
		if (confirm("정말 삭제하시겠습니까?")) {
			const formData = new FormData();
			formData.append("gl_idx", gl_idx);
			formData.append("del_it", "Y");
			$.ajax({
				type: "POST",
				url: "./ajax.change_passport_file.php",
				data: formData,
				contentType: false,
				processData: false,
				success: function (response, textStatus, jqXHR) {
					if (response.trim() == "OK") {
						alert("삭제되었습니다");
						location.reload();
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.table(jqXHR)
				}
			});
		}
	}
</script>
<script>
	const r_code = "order";
	const r_idx = "<?= $order_idx ?>";
</script>
<script src="/js/comment.js"?></script>
<?php $this->endSection(); ?>
