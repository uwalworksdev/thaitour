<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php $setting = homeSetInfo(); ?>
<?php
$connect = db_connect();
$private_key = private_key();

if ($_SESSION["member"]["mIdx"] == "") {
	alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
	exit();
}

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

<section class="invoice_paid">
	<div class="inner">
		<div class="ttl_box">
			<h1>
				<?= (html_entity_decode($product_name)) ?>
			</h1>
			<span class="stt_2">
				<?= get_status_name($order_status) ?>
			</span>
		</div>
		<p class="ttl_date">
			<?= $order_r_date ?>
		</p>
		<!-- 웹 -->
		<div class="invoice_table invoice_table_new only_web">
			<h2>예약 정보</h2>
			<table>
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">예약번호</td>
						<td col width="10%" class="subject">일정</td>
						<td col width="25%" class="subject">전체 옵션...</td>
						<td col width="25%" class="subject">총 결제금액</td>
						<td col width="15%" class="subject">상품 예약금액</td>
						<td col width="10%" class="subject">실예약금액</td>

					</tr>
					<tr>

						<td col width="15%" class="content">
							<span>
								<?= $order_no ?>
							</span>
						</td>

						<td class="content">
							<p>
								<?php 
									if(!empty($order_date)){
								?>
									<?= str_replace("-", ".", $order_date) ?>
									<input type=hidden name="order_date" value='<?= $order_date ?>'>
								<?php 
									}
								?>
							</p>
						</td>

						<td class="content">
							<?php if (!empty($tour_option)): ?>
								<?php 
								$first = true; 
								foreach ($tour_option as $option): ?>
									<?php if (!$first): ?> + <?php endif; ?>
									<?= $option['option_name']?>: <?= number_format($option['option_price_bath'] * $setting['baht_thai']) ?> 바트<br>
									<?php $first = false; ?>
								<?php endforeach; ?>
								<!--= <?= number_format($total_price * $setting['baht_thai']) ?> 바트-->
							<?php endif; ?>
						</td>

						<td class="content">
							<p>
								<?= number_format($people_adult_price) ?> 바트(성인)<br>
								+
								<?= number_format($people_kids_price) ?> 바트(아동)<br>
								+
								<?= number_format($people_baby_price) ?> 바트(유아)<br>
								+
								<?= number_format($option_amt) ?>
								옵션
								- 
                                <?= number_format($row_cou['used_coupon_money'])?> 바트(할인쿠폰)
								= <?= number_format( ($people_adult_price) +
														($people_kids_price) +
														($people_baby_price) + ($option_amt) - $row_cou['used_coupon_money'] ) ?>
								바트
							</p>
						</td>
						<td class="content">
							<p><strong><span id="price_tot">
									<?= number_format($order_price) ?>
								</span></strong> 바트</p>
						</td>
						<td class="content">
							<?php if ($used_coupon_money > 0) { ?>
								<p><strong style="color:red">쿠폰 <span id="coupon_amt">
											<?= number_format($used_coupon_money) ?> 바트
										</span></strong></p>
							<?php } ?>

							<?php if ($used_mileage_money > 0) { ?>
								<p><strong style="color:red">포인트 <span id="point_amt">
											<?= number_format($used_mileage_money) ?> 바트
										</span></strong></p>
							<?php } ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

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
                    <td class="subject">일정</td>
                    <td class="content">
						<p>
							<?php 
								if(!empty($order_date)){
							?>
								<?= str_replace("-", ".", $order_date) ?>
								<input type=hidden name="order_date" value='<?= $order_date ?>'>
							<?php 
								}
							?>
						</p>
                    </td>
                </tr>
                <tr>
                    <td class="subject">전체 옵션...</td>
                    <td class="content">
						<?php if (!empty($tour_option)): ?>
							<?php 
							$first = true; 
							foreach ($tour_option as $option): ?>
								<?php if (!$first): ?> + <?php endif; ?>
								<?= $option['option_name']?>: <?= number_format($option['option_price_bath'] * $setting['baht_thai']) ?> 바트<br>
								<?php $first = false; ?>
							<?php endforeach; ?>
							<!--= <?= number_format($total_price * $setting['baht_thai']) ?> 바트-->
						<?php endif; ?>
                    </td>
                </tr>
                    <td class="subject">총 결제금액</td>

                    <td class="content">
						<p>
							<?= number_format($people_adult_price) ?> 바트(성인)<br>
							+
							<?= number_format($people_kids_price) ?> 바트(아동)<br>
							+
							<?= number_format($people_baby_price) ?> 바트(유아)<br>
							+
							<?= number_format($option_amt) ?>
							옵션
							- 
							<?= number_format($row_cou['used_coupon_money'])?> 바트(할인쿠폰)
							= <?= number_format( ($people_adult_price) +
													($people_kids_price) +
													($people_baby_price) + ($option_amt) - $row_cou['used_coupon_money'] ) ?>
							바트
						</p>
                    </td>
                </tr>
                <tr>
                    <td class="subject">상품 예약금액</td>

                    <td class="content">
						<p><strong><span id="price_tot">
							<?= number_format($order_price) ?>
						</span></strong> 바트</p>
                    </td>
                </tr>
                <tr>
                    <td class="subject">실예약금액</td>

                    <td class="content">
                    	<?php if ($used_coupon_money > 0) { ?>
							<p><strong style="color:red">쿠폰 <span id="coupon_amt">
										<?= number_format($used_coupon_money) ?> 바트
									</span></strong></p>
						<?php } ?>

						<?php if ($used_mileage_money > 0) { ?>
							<p><strong style="color:red">포인트 <span id="point_amt">
										<?= number_format($used_mileage_money) ?> 바트
									</span></strong></p>
						<?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

		<div class="invoice_table invoice_table_new only_web">
			<h2>기타 정보</h2>
			<table>
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">미팅장소</td>
						<!-- <td col width="*%" class="subject">미팅 시간</td> -->
						<td col width="15%" class="subject">종료 후 내리실 곳</td>
						<td col width="15%" class="subject">카카오톡 아이디</td>
						<td col width="15%" class="subject">기타 요청</td>

					</tr>
					<tr>

						<td col width="15%" class="content">
							<span>
								<?= $tour_orders['start_place'] ?>
							</span>
						</td>

						<!-- <td class="content">
							<?= $tour_orders['metting_time'] ?>
						</td> -->

						<td class="content">
							<?= $tour_orders['end_place'] ?>
						</td>

						<td class="content">
							<p>
								<?= $tour_orders['id_kakao'] ?>
							</p>
						</td>
						<td class="content">
							<p><?= $tour_orders['description']?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="invoice_table invoice_table_new only_mo">
            <h2>기타 정보</h2>
            <table>
                <colgroup>
                    <col width="15%">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <td class="subject">미팅장소</td>
                    <td class="content">
						<span>
							<?= $tour_orders['start_place'] ?>
						</span>
                    </td>
                </tr>
                <tr>
                    <td class="subject">종료 후 내리실 곳</td>
                    <td class="content">
						<p>
							<?= $tour_orders['end_place'] ?>
						</p>
                    </td>
                </tr>
                <tr>
                    <td class="subject">카카오톡 아이디</td>
                    <td class="content">
						<p><?= $tour_orders['id_kakao'] ?></p>
                    </td>
                </tr>
                    <td class="subject">기타 요청</td>

                    <td class="content">
						<p><?= $tour_orders['description']?></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

		<!-- 예약정보 모바일 -->

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
						<td col width="8%" class="subject">결제상태</td>
						<td col width="12%" class="subject">결제방법</td>
						<td col width="12%" class="subject">결제금액 </td>
						<td col width="20%" class="subject">결제</td>
						<td col width="20%" class="subject">결제일</td>
					</tr>

					<?php if ($order_status == "W") { ?>
						<tr>
							<td class="content" colspan="7">예약 준비중</td>
						</tr>
					<?php } ?>

					<?php if ($order_status == "C") { ?>
						<tr>
							<td class="content" colspan="6">예약 취소</td>
						</tr>
					<?php } ?>

					<?php if ($order_status == "G" || $order_status == "J") { ?>
						<tr>
							<td col width="8%" class="content">
								선금
							</td>

							<td class="content">
								선금 입금대기
							</td>

							<td class="content">
								<?= $deposit_method ?>
							</td>

							<td class="content">
								<?= number_format($deposit_price) ?>
							</td>

							<td class="content">
							</td>
						</tr>
						<tr>
							<td class="content ">
								<?php if ($deposit_method == "") { ?>
									잔금
								<?php } ?>
							</td>
							<td class="content link">
								<?php if ($deposit_method == "") { ?>
									준비중
								<?php } ?>
							</td>
						</tr>

					<?php } ?>

					<?php if ($order_status == "R") { ?>
						<tr>
							<td col width="8%" class="content">
								선금
							</td>

							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									결제완료
								<?php } else { ?>
									<?= $ResultMsg_1 ?>
								<?php } ?>
							</td>

							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= $deposit_method ?>
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>

							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= number_format($deposit_price) ?> 바트
								<?php } else { ?>
									<?= number_format($deposit_price) ?> 바트
								<?php }
								?>
							</td>

							<td class="content link">
							</td>

							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= $deposit_date ?>
								<?php } else { ?>
									<?= date($order_confirm_date); ?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td col width="8%" class="content">
								잔금
							</td>

							<td class="content">
								잔금 입금 대기
							</td>

							<td class="content">
								<?= $confirm_method ?>
							</td>

							<td class="content">
								<?= number_format($order_confirm_price) ?> 바트
							</td>

							<td class="content">
							</td>
						</tr>
					<?php } ?>

					<?php if ($order_status == "Y") { ?>
						<tr>
							<td col width="8%" class="content">
								선금
							</td>
							<td class="content">
								결제완료
							</td>

							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									결제완료
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= number_format($deposit_price) ?> 바트
								<?php } else { ?>
									<!-- <?= number_format($Amt_1) ?> 바트 -->
									<?= number_format($order_price) ?> 바트
								<?php } ?>
							</td>

							<td class="content link">
							</td>

							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= date($order_confirm_date); ?>
								<?php } else { ?>
									<?= date($order_confirm_date); ?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td col width="8%" class="content">
								잔금
							</td>
							<td class="content">
								잔금입금완료
							</td>

							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= $deposit_method ?>
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>

							<td class="content">
								<?php if ($confirm_method == "무통장입금") { ?>
									<?= number_format($order_confirm_price) ?> 바트
								<?php } else { ?>
									<!-- <?= number_format($Amt_2) ?> 바트 -->
									<?= number_format($order_confirm_price) ?> 바트
								<?php } ?>
							</td>

							<td class="content link">
							</td>

							<td class="content">

								<?php if ($confirm_method == "무통장입금") { ?>
									<!-- <?= $order_confirm_date ?> -->
									<?= date($order_c_date); ?>
								<?php } else { ?>
									<!-- <?= date("Y-m-d", strtotime("20" . $AuthDate_2)); ?> -->
									<?= date($order_c_date); ?>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>

		<div class="invoice_table invoice_table_new only_mo">
			<h2>예약금액 결제</h2>
			<table>
				<colgroup>
					<col width="10%">
					<col width="*">
				</colgroup>
				<tbody>

					<?php if ($order_status == "W") { ?>
						<tr>
							<td class="content" colspan="2" style="text-align: center;">예약 준비중</td>
						</tr>
					<?php } ?>

					<?php if ($order_status == "C") { ?>
						<tr>
							<td class="content" colspan="2" style="text-align: center;">예약 취소</td>
						</tr>
					<?php } ?>

					<?php if ($order_status == "G" || $order_status == "J") { ?>
						<tr>
							<td class="subject">예약상태</td>
							<td class="content">
								선금
							</td>
						</tr>
						<tr>
						<td>
							<td class="subject">결제상태</td>
							<td class="content">
								선금 입금대기
							</td>
						</tr>
						<tr>
							<td class="subject">결제방법</td>
							<td class="content">
								<?= $deposit_method ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제금액</td>
							<td class="content">
								<?= number_format($deposit_price) ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제</td>
							<td class="content">
							</td>
						</tr>
						<tr>
							<td class="subject">결제일</td>
							<td class="content ">
								<?php if ($deposit_method == "") { ?>
									잔금
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="subject"></td>
							<td class="content link">
								<?php if ($deposit_method == "") { ?>
									준비중
								<?php } ?>
							</td>
						</tr>

					<?php } ?>

					<?php if ($order_status == "R") { ?>
						<tr>
							<td class="subject">예약상태</td>
							<td col class="content">
								선금
							</td>
						</tr>
						<tr>
							<td class="subject">결제상태</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									결제완료
								<?php } else { ?>
									<?= $ResultMsg_1 ?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제방법</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= $deposit_method ?>
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제금액</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= number_format($deposit_price) ?> 바트
								<?php } else { ?>
									<?= number_format($deposit_price) ?> 바트
								<?php }
								?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제</td>
							<td class="content link">
							</td>
						</tr>
						<tr>
							<td class="subject">결제일</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= $deposit_date ?>
								<?php } else { ?>
									<?= date($order_confirm_date); ?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="subject">예약상태</td>
							<td class="content">
								잔금
							</td>
						</tr>
						<tr>
							<td class="subject">결제상태</td>
							<td class="content">
								잔금 입금 대기
							</td>
						</tr>
						<tr>
							<td class="subject">결제방법</td>
							<td class="content">
								<?= $confirm_method ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제금액</td>
							<td class="content">
								<?= number_format($order_confirm_price) ?> 바트
							</td>
						</tr>
						<tr>
							<td class="subject">결제</td>
							<td class="content">
							</td>
						</tr>
					<?php } ?>

					<?php if ($order_status == "Y") { ?>
						<tr>
							<td class="subject">예약상태</td>
							<td class="content">
								선금
							</td>
						</tr>
						<tr>
							<td class="subject">결제상태</td>
							<td class="content">
								결제완료
							</td>
						</tr>
						<tr>
							<td class="subject">결제방법</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									결제완료
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제금액</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= number_format($deposit_price) ?> 바트
								<?php } else { ?>
									<!-- <?= number_format($Amt_1) ?> 바트 -->
									<?= number_format($order_price) ?> 바트
								<?php } ?>
							</td>
						</tr>
						<tr>

							<td class="subject">결제</td>
							<td class="content link">
							</td>
						</tr>
						<tr>
							<td class="subject">결제일</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= date($order_confirm_date); ?>
								<?php } else { ?>
									<?= date($order_confirm_date); ?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="subject">예약상태</td>
							<td col class="content">
								잔금
							</td>
						</tr>
						<tr>
							<td class="content">
								잔금입금완료
							</td>
						</tr>
						<tr>
							<td class="subject">결제상태</td>
							<td class="content">
								<?php if ($deposit_method == "무통장입금") { ?>
									<?= $deposit_method ?>
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제방법</td>
							<td class="content">
								<?php if ($confirm_method == "무통장입금") { ?>
									<?= number_format($order_confirm_price) ?> 바트
								<?php } else { ?>
									<!-- <?= number_format($Amt_2) ?> 바트 -->
									<?= number_format($order_confirm_price) ?> 바트
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="subject">결제금액</td>
							<td class="content link">
							</td>
						</tr>
						<tr>
							<td class="subject">결제</td>
							<td class="content">

								<?php if ($confirm_method == "무통장입금") { ?>
									<!-- <?= $order_confirm_date ?> -->
									<?= date($order_c_date); ?>
								<?php } else { ?>
									<!-- <?= date("Y-m-d", strtotime("20" . $AuthDate_2)); ?> -->
									<?= date($order_c_date); ?>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>

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

		<!-- 예약자 정보 웹 -->
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
                    <td col width="8%" class="subject">영문 이름(First Name)</td>
                    <td col width="8%" class="subject">영문 성(Last Name)</td>
                    <td col width="12%" class="subject">휴대번호</td>
                    <td col width="12%" class="subject">이메일</td>
                    <td col width="12%" class="subject">여행시 현지 연락처</td>

                </tr>
                <tr>
                        <td col width="8%" class="content">
							<?= $row_d['order_user_name'] ?>
						</td>

						<td class="content">
							<?= $row_d['order_user_first_name_en'] ?>
						</td>

						<td class="content">
							<?= $row_d['order_user_last_name_en'] ?>
						</td>

						<td class="content">
							<?= $row_d['order_user_mobile'] ?>
						</td>

						<td class="content">
							<?= $row_d['order_user_email'] ?>
						</td>

						<td class="content">
							<?= $local_phone ?>
						</td>

                </tbody>
            </table>
        </div>

		<!-- 예약자 정보 모바일 -->

		<div class="invoice_table invoice_table_new only_mo">
			<h2>예약자 정보</h2>
			<table>
				<colgroup>
					<col width="10%">
					<col width="*">
				</colgroup>
				<tbody>

					<tr>
						<td class="subject">이름</td>
						<td class="content">
							<?= $row_d['order_user_name'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">영문 이름(First Name)</td>
						<td class="content">
							<?= $row_d['order_user_first_name_en'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">영문 성(Last Name)</td>
						<td class="content">
							<?= $row_d['order_user_last_name_en'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">휴대번호</td>
						<td class="content">
							<?= $row_d['order_user_mobile'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">이메일</td>
						<td class="content">
							<?= $row_d['order_user_email'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">여행시 현지 연락처</td>
						<td class="content">
							<?= $local_phone ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="invoice_table invoice_table_new only_web">
			<h2>
				여행정보
			</h2>
			<table>
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td width="*%" class="subject" style="font-weight: bold;">인원정보</td>
						<td class="subject" style="font-weight: bold;">
							여행자
						</td>
                        <td class="subject" style="font-weight: bold;">
                            이메일 주소
						</td>
                        <td class="subject" style="font-weight: bold;">
                            한국번호
						</td>
                        <td class="subject" style="font-weight: bold;">
                            생년월일
						</td>
						<td class="subject" style="font-weight: bold;">성별</td>
					</tr>
					<?php
						foreach ($listSub as $key => $sub){
                        ?>
                            <tr>
                                <td class="content" style="border-right: 1px solid #dbdbdb;" >
									인원<?= $key + 1 ?>
                                </td>
                                <td class="content">
                                    <?= $sub['order_full_name'] ?>
                                </td>
                                <td class="content">
                                    <?= $sub['order_email'] ?>
                                </td>
                                <td class="content">
                                    <?= $sub['order_mobile'] ?>
                                </td>
                                <td class="content">
                                    <?= $sub['order_birthday'] ?>
                                </td>
								<td class="content">
									<?= $sub['order_sex'] == "M" ? "남성" : "여성" ?>
								</td>
                            </tr>
                        <?php	
						}
					?>
				</tbody>
			</table>
		</div>

		<div class="invoice_table invoice_table_new only_mo">
			<h2>여행정보</h2>
			<?php
			foreach ($listSub as $key => $sub){
			?>
			<table>
				<colgroup>
					<col width="10%">
					<col width="*">
				</colgroup>
				<tbody>

					<tr>
						<td class="subject">인원정보</td>
						<td class="content">
							인원<?= $key + 1 ?>
						</td>
					</tr>

					<tr>
						<td class="subject">여행자</td>
						<td class="content">
							<?= $sub['order_full_name'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">이메일 주소</td>
						<td class="content">
							<?= $sub['order_email'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">한국번호</td>
						<td class="content">
							<?= $sub['order_mobile'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">생년월일</td>
						<td class="content">
							<?= $sub['order_birthday'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">성별</td>
						<td class="content">
							<?= $sub['order_sex'] == "M" ? "남성" : "여성" ?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php	
				}
			?>
		</div>
		<!-- <div class="invoice_table">
			<h2>요청사항</h2>
			<table>
				<colgroup>
					<col width="15%">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<td class="subject">요청사항</td>
						<td class="content">
							<?= $info['order_memo'] ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div> -->

		<div class="invoice_comment">
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
		</div>

		<?php
			// echo view("inc/popup_inc");
		?>

		<div class="invoice_button">
			<button onclick="go_list('<?= $pg ?>');">목록으로</button>
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
		location.href = '/mypage/details?pg=' + pg
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
