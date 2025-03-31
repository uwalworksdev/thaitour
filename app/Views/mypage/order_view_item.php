<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
$connect = db_connect();
$private_key = private_key();

if ($_SESSION["member"]["mIdx"] == "") {
	alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
	exit();
}

$sql = "select * from tbl_order_mst a
	                           left join tbl_member b on a.m_idx = b.m_idx 
							   where a.order_idx = '$order_idx' and a.m_idx = '" . $_SESSION["member"]["mIdx"] . "' ";
$row = $connect->query($sql)->getRowArray();

$sql_d = "SELECT AES_DECRYPT(UNHEX('{$row['local_phone']}'),       '$private_key') local_phone ";

$row_d = $connect->query($sql_d)->getRowArray();

$row['local_phone'] = $row_d['local_phone'];

$tour_period = $row["tour_period"];
$custom_req = $row['custom_req'];

$home_depart_date = $row['home_depart_date'];
$away_arrive_date = $row['away_arrive_date'];
$away_depart_date = $row['away_depart_date'];
$home_arrive_date = $row['home_arrive_date'];

$start_date = $row['start_date'];

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
				<?= (html_entity_decode($row['product_name'])) ?>
			</h1>
			<span class="stt_2">
				<?= get_status_name($row["order_status"]) ?>
			</span>
		</div>
		<p class="ttl_date">
			<?= $row["order_r_date"] ?>
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
						<td col width="15%" class="subject">여행인원</td>
						<td col width="15%" class="subject">여행기간</td>
						<td col width="30%" class="subject">항공일정</td>
					</tr>
					<tr>

						<td col width="15%" class="content">
							<span>
								<?= $row["order_no"] ?>
							</span>
						</td>

						<td class="content">
							<span>성인: <span>
									<?= $row["people_adult_cnt"] ?>
								</span></span> <span>소아: <span>
									<?= $row["people_kids_cnt"] ?>
								</span></span> <span>유아: <span>
									<?= $row["people_baby_cnt"] ?>
								</span></span>
						</td>

						<td class="content">
							<p>
								<?= $row['start_date'] . "(" . dowYoil($row['start_date']) . ") ~ " . $row['end_date'] . "(" . dowYoil($row['end_date']) . ")"; ?>
								<em>
									<?= $product_period ?>
								</em>
								</span>
							</p>
						</td>
						<td class="content">
							<p>
								<span>한국출발
									<?= $home_depart_date . "(" . dowYoil($home_depart_date) . ")" ?>
								</span>
								<span>현지도착
									<?= $away_arrive_date . "(" . dowYoil($away_arrive_date) . ")" ?>
								</span>
							</p>
							<p>
								<span>현지출발
									<?= $away_depart_date . "(" . dowYoil($away_depart_date) . ")" ?>
								</span>
								<span>한국도착
									<?= $home_arrive_date . "(" . dowYoil($home_arrive_date) . ")" ?>
								</span>
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
								<?= $row["order_no"] ?>
							</span>
						</td>
					</tr>
					<tr>
						<td class="subject">여행인원</td>
						<td class="content">
							<span>성인: <span>
									<?= $row["people_adult_cnt"] ?>
								</span></span> <span>소아: <span>
									<?= $row["people_kids_cnt"] ?>
								</span></span> <span>유아: <span>
									<?= $row["people_baby_cnt"] ?>
								</span></span>
						</td>
					</tr>
					<tr>
						<td class="subject">여행기간</td>


						<td class="content">
							<p>
								<?= $start_date . "(" . dowYoil($start_date) . ") ~ " . DateAdd("d", ($tour_period - 1), strtotime($start_date)) . "(" . dowYoil(DateAdd("d", ($tour_period - 1), strtotime($start_date))) . ")"; ?>
								<em>
									<?= $product_period ?>
								</em>
								</span>
							</p>
						</td>
					</tr>
					<tr>
						<td class="subject">일정</td>


						<td class="content">
							<p>
								<span>한국출발
									<?= $start_date . "(" . dowYoil($start_date) . ")" ?>
								</span>
								<span>현지도착
									<?= $start_date . "(" . dowYoil($start_date) . ")" ?>
								</span>
							</p>
							<p>
								<span>현지출발
									<?= DateAdd("d", ($tour_period - 1), strtotime($start_date)) . "(" . dowYoil(DateAdd("d", ($tour_period - 1), strtotime($start_date))) . ")"; ?>
								</span>
								<span>한국도착
									<?= DateAdd("d", ($tour_period - 1), strtotime($start_date)) . "(" . dowYoil(DateAdd("d", ($tour_period - 1), strtotime($start_date))) . ")"; ?>
								</span>
							</p>
						</td>
					</tr>
					<tr>


				</tbody>
			</table>
		</div>

		<section class="ord_total_sec reservation">
			<div class="flex_b_c">
				<div class="left flex">
					<strong class="label red">상품 예약금액</strong>
					<div class="detail_money tar flex_e_c">
						<div class="defen_ttl">
							<p><strong>성인 <span id="adult_amt">
										<?= number_format(($row['people_adult_price'] + $row['oil_price']) * $row['people_adult_cnt']) ?>
									</span></strong> 원</p>
							<?php if ($row['product_code_1'] != "1325" || $row['product_code_1'] != "1317") { ?>
								<span class="text_defen">(유류포함)</span>
							<?php } ?>
						</div>
						<?php if ($row['product_code_1'] != "1320") { ?>
							<p>/</p>
							<div class="defen_ttl">
								<p><strong>소아 <span id="kids_amt">
											<?= number_format(($row['people_kids_price'] + $row['oil_price']) * $row['people_kids_cnt']) ?>
										</span></strong> 원</p>
								<?php if ($row['product_code_1'] != "1325" || $row['product_code_1'] != "1317") { ?>
									<span class="text_defen">(유류포함)</span>
								<?php } ?>
							</div>
							<p>/</p>
							<div class="defen_ttl">
								<p><strong>유아 <span id="baby_amt">
											<?= number_format($row['people_baby_price'] * $row['people_baby_cnt']) ?>
										</span></strong> 원</p>
								<?php if ($row['product_code_1'] != "1325" || $row['product_code_1'] != "1317") { ?>
									<span class="text_defen">(유류미포함)</span>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if ($row['used_coupon_money'] > 0) { ?>
							<p><strong style="color:red">쿠폰 <span id="coupon_amt">
										<?= number_format($row['used_coupon_money']) ?>원
									</span></strong></p>
						<?php } ?>

						<?php if ($row['used_mileage_money'] > 0) { ?>
							<p><strong style="color:red">포인트 <span id="point_amt">
										<?= number_format($row['used_mileage_money']) ?>원
									</span></strong></p>
						<?php } ?>

					</div>
				</div>
				<div class="total_money tar">
					<div class="defen_ttl flex">
						<p><strong><span id="price_tot">
									<?= number_format($row['order_price']) ?>
								</span></strong> 원</p>
						<?php if ($row['product_code_1'] != "1325" || $row['product_code_1'] != "1317") { ?>
							<span class="text_defen">(유류포함)</span>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
		<section class="ord_total_sec reservation">
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
						<?php if ($row['product_code_1'] != "1325" || $row['product_code_1'] != "1317") { ?>
							<span class="text_defen">(유류포함)</span>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

		<div class="invoice_table invoice_table_new reservation">
			<h2>예약금액 결제..</h2>
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

					<?php if ($row["order_status"] == "W") { ?>
						<tr>
							<td class="content" colspan="7">예약 준비중</td>
						</tr>
					<?php } ?>

					<?php if ($row["order_status"] == "C") { ?>
						<tr>
							<td class="content" colspan="6">예약 취소</td>
						</tr>
					<?php } ?>

					<?php if ($row["order_status"] == "G" || $row["order_status"] == "J") { ?>
						<tr>
							<td col width="8%" class="content">
								선금
							</td>

							<td class="content">
								선금 입금대기
							</td>

							<td class="content">
								<?= $row['deposit_method'] ?>
							</td>

							<td class="content">
								<?= number_format($row['deposit_price']) ?>
							</td>

							<td class="content">
							</td>
						</tr>
						<tr>
							<td class="content ">
								<?php if ($row['deposit_method'] == "") { ?>
									잔금
								<?php } ?>
							</td>
							<td class="content link">
								<?php if ($row['deposit_method'] == "") { ?>
									준비중
								<?php } ?>
							</td>
						</tr>

					<?php } ?>

					<?php if ($row["order_status"] == "R") { ?>
						<tr>
							<td col width="8%" class="content">
								선금
							</td>

							<td class="content">
								<?php if ($row['deposit_method'] == "무통장입금") { ?>
									결제완료
								<?php } else { ?>
									<?= $row['ResultMsg_1'] ?>
								<?php } ?>
							</td>

							<td class="content">
								<?php if ($row['deposit_method'] == "무통장입금") { ?>
									<?= $row['deposit_method'] ?>
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>

							<td class="content">
								<?php if ($row['deposit_method'] == "무통장입금") { ?>
									<?= number_format($row['deposit_price']) ?>원
								<?php } else { ?>
									<?= number_format($row['deposit_price']) ?>원
								<?php }
								?>
							</td>

							<td class="content link">
							</td>

							<td class="content">
								<?php if ($row['deposit_method'] == "무통장입금") { ?>
									<?= $row['deposit_date'] ?>
								<?php } else { ?>
									<?= date($row['order_confirm_date']); ?>
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
								<?= $row['confirm_method'] ?>
							</td>

							<td class="content">
								<?= number_format($row['order_confirm_price']) ?>원
							</td>

							<td class="content">
							</td>
						</tr>
					<?php } ?>

					<?php if ($row["order_status"] == "Y") { ?>
						<tr>
							<td col width="8%" class="content">
								잔금
							</td>
							<td class="content">
								결제완료
							</td>

							<td class="content">
								<?php if ($row['deposit_method'] == "무통장입금") { ?>
									결제완료
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>
							<td class="content">
								<?php if ($row['deposit_method'] == "무통장입금") { ?>
									<?= number_format($row['deposit_price']) ?>원
								<?php } else { ?>
									<!-- <?= number_format($row['Amt_1']) ?>원 -->
									<?= number_format($row['order_price']) ?>원
								<?php } ?>
							</td>

							<td class="content link">
							</td>

							<td class="content">
								<?php if ($row['deposit_method'] == "무통장입금") { ?>
									<?= date($row['order_confirm_date']); ?>
								<?php } else { ?>
									<?= date($row['order_confirm_date']); ?>
								<?php } ?>
							</td>
						</tr>
						<!--tr>
							<td col width="8%" class="content">
								잔금
							</td>
							<td class="content">
								잔금입금완료
							</td>

							<td class="content">
								<?php if ($row['deposit_method'] == "무통장입금") { ?>
									<?= $row['deposit_method'] ?>
								<?php } else { ?>
									신용카드
								<?php } ?>
							</td>

							<td class="content">
								<?php if ($row['confirm_method'] == "무통장입금") { ?>
									<?= number_format($row['order_confirm_price']) ?>원
								<?php } else { ?>
									<!-- <?= number_format($row['Amt_2']) ?>원 -->
									<!--<?= number_format($row['order_confirm_price']) ?>원
								<?php } ?>
							</td>

							<td class="content link">
							</td>

							<td class="content">

								<?php if ($row['confirm_method'] == "무통장입금") { ?>
									<!-- <?= $row['order_confirm_date'] ?> -->
									<!--<?= date($row['order_c_date']); ?>
								<?php } else { ?>
									<!-- <?= date("Y-m-d", strtotime("20" . $row['AuthDate_2'])); ?> -->
									<!--<?= date($row['order_c_date']); ?>
								<?php } ?>
							</td>
						</tr-->
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
		<?php
		$sql_d = "SELECT   AES_DECRYPT(UNHEX('{$row['user_name']}'),    '$private_key') AS user_name 
									   , AES_DECRYPT(UNHEX('{$row['order_user_email']}'),   '$private_key') AS order_user_email 
									   , AES_DECRYPT(UNHEX('{$row['order_user_mobile']}'),  '$private_key') AS order_user_mobile 
									   , AES_DECRYPT(UNHEX('{$row['order_zip']}'),          '$private_key') AS order_zip 
									   , AES_DECRYPT(UNHEX('{$row['order_addr1']}'),        '$private_key') AS order_addr1 
									   , AES_DECRYPT(UNHEX('{$row['order_addr2']}'),        '$private_key') AS order_addr2 ";
		$row_d = $connect->query($sql_d)->getRowArray();
		?>
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
						<td col width="12%" class="subject">호주/해외 전화번호 </td>
						<td col width="12%" class="subject">이메일</td>
						<td col width="15%" class="subject">주소</td>

					</tr>
					<tr>

						<td col width="8%" class="content">
							<?= $row_d['user_name'] ?>
						</td>

						<td class="content">
							<?= $row['birthday'] ?>
						</td>

						<td class="content">
							<?= $row_d['order_user_mobile'] ?>
						</td>

						<td class="content">
							<?= ($row['local_phone']) ?>원
						</td>

						<td class="content">
							<?= $row_d['order_user_email'] ?>
						</td>


						<td class="content">
							[
							<?= $row_d['order_zip'] ?>]
							<?= $row_d['order_addr1'] ?>
							<?= $row_d['order_addr2'] ?>
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
							<?= $row_d['user_name'] ?>
						</td>
					</tr>

					<tr>
						<td class="subject">생년월일</td>

						<td class="content">
							<?= $row['birthday'] ?>
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
						<td class="subject">주소</td>
						<td class="content">
							[
							<?= $row_d['order_zip'] ?>]
							<?= $row_d['order_addr1'] ?>
							<?= $row_d['order_addr2'] ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>


		<?php
		$seq = 0;
		$sql = "select * from tbl_order_list where order_idx = '$order_idx' and m_idx = '" . $row["m_idx"] . "' ";
		$result = $connect->query($sql)->getResultArray();
		foreach ($result as $row) {
			$seq++;

			$order_birthday = date("Y.m.d", strtotime($row["order_birthday"]));


			$sql_d = "SELECT   AES_DECRYPT(UNHEX('{$row['order_name_kor']}'),   '$private_key') order_name_kor
									  , AES_DECRYPT(UNHEX('{$row['order_first_name']}'), '$private_key') order_first_name
									  , AES_DECRYPT(UNHEX('{$row['order_last_name']}'),  '$private_key') order_last_name
									  , AES_DECRYPT(UNHEX('{$row['passport_num']}'),     '$private_key') passport_num
									  , AES_DECRYPT(UNHEX('{$row['order_mobile']}'),     '$private_key') order_mobile 
									  , AES_DECRYPT(UNHEX('{$row['order_email']}'),      '$private_key') order_email ";
			$row_d = $connect->query($sql_d)->getRowArray();

			$row['order_name_kor'] = $row_d['order_name_kor'];
			$row['order_first_name'] = $row_d['order_first_name'];
			$row['order_last_name'] = $row_d['order_last_name'];
			$row['passport_num'] = $row_d['passport_num'];
			$row['order_mobile'] = $row_d['order_mobile'];
			$row['order_email'] = $row_d['order_email'];

			?>
			<!-- 여행자 웹 -->
			<div class="invoice_table invoice_table_new only_web">
				<h2>여행자
					<?= $seq ?>
				</h2>
				<table>
					<colgroup>
						<col width="15%">
						<col width="*">
					</colgroup>
					<tbody>
						<tr>
							<td class="subject">여행자
								<?= $seq ?>
							</td>
							<td width="25%" class="subject">여권파일</td>
							<!-- <td width="15%" class="subject">여권만료일</td> -->
							<td width="15%" class="subject">생년월일</td>
							<td class="subject">이메일</td>
							<td class="subject">전화번호</td>
						</tr>
						<tr>
							<td class="content">
								<?= $row['order_name_kor'] ?> /
								<?= $row['order_first_name'] ?>
								<?= $row['order_last_name'] ?>
							</td>

							<td class="content">
								<?
								if ($row['ufile']) {
									?>
									<a class="btn_download_passport"
										href="javascript:handlleShowPassport(`/data/tour/<?= $row['ufile'] ?>`)">보기</a>
									<a class="btn_download_passport btn_del_passport"
										href="javascript:handlleDelPassport(`<?= $row['gl_idx'] ?>`)">삭제</a>
									<?
								}
								?>
								<input type="file" hidden data-gl_idx="<?= $row['gl_idx'] ?>" class="change_passport"
									id="change_passport_<?= $row['gl_idx'] ?>">
								<label class="btn_upload_passport" for="change_passport_<?= $row['gl_idx'] ?>">첨부파일</label>
							</td>

							<!-- <td class="content">
								<?= date("Y.m.d", strtotime($row["passport_date"])) ?>
							</td> -->

							<td class="content">
								<?= $order_birthday . " (" . dowYoil($order_birthday) . ")" ?>
							</td>


							<td class="content">
								<?= $row['order_email'] ?>
							</td>

							<td class="content">
								<?= $row['order_mobile'] ?>
							</td>
						</tr>


					</tbody>
				</table>
			</div>

			<!-- 여행자 모바일 -->
			<div class="invoice_table invoice_table_new only_mo">
				<h2>여행자
					<?= $seq ?>
				</h2>
				<table>
					<colgroup>
						<col width="5%">
						<col width="*">
					</colgroup>
					<tbody>
						<tr>
							<td class="subject">여행자
								<?= $seq ?>
							</td>
							<td class="content">
								<?= $row['order_name_kor'] ?> /
								<?= $row['order_first_name'] ?>
								<?= $row['order_last_name'] ?>
							</td>
						</tr>
						<tr>
							<td class="subject">여권번호</td>
							<td class="content">
								<?= $row['passport_num'] ?>
							</td>
						</tr>
						<tr>
							<td class="subject">여권만료일</td>
							<td class="content">
								<?= date("Y.m.d", strtotime($row["passport_date"])) ?>
							</td>
						</tr>
						<tr>
							<td class="subject">생년월일</td>
							<td class="content">
								<?= $order_birthday . " (" . dowYoil($order_birthday) . ")" ?>
							</td>
						</tr>
						<tr>
							<td class="subject">이메일</td>
							<td class="content">
								<?= $row['order_email'] ?>
							</td>
						</tr>
						<tr>
							<td class="subject">전화번호</td>
							<td class="content">
								<?= $row['order_mobile'] ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>


			<?php
		}
		?>

		<?php
		$seq = 0;
		$sql = "select * from tbl_order_list where order_idx = '$order_idx' and m_idx = '" . $row["m_idx"] . "' ";
		$result = $connect->query($sql)->getResultArray();
		foreach ($result as $row) {
			$seq++;

			$order_birthday = date("Y.m.d", strtotime($row["order_birthday"]));


			$sql_d = "SELECT   AES_DECRYPT(UNHEX('{$row['order_name_kor']}'),   '$private_key') order_name_kor
									  , AES_DECRYPT(UNHEX('{$row['order_first_name']}'), '$private_key') order_first_name
									  , AES_DECRYPT(UNHEX('{$row['order_last_name']}'),  '$private_key') order_last_name
									  , AES_DECRYPT(UNHEX('{$row['passport_num']}'),     '$private_key') passport_num
									  , AES_DECRYPT(UNHEX('{$row['order_mobile']}'),     '$private_key') order_mobile 
									  , AES_DECRYPT(UNHEX('{$row['order_email']}'),      '$private_key') order_email ";
			$row_d = $connect->query($sql_d)->getRowArray();

			$row['order_name_kor'] = $row_d['order_name_kor'];
			$row['order_first_name'] = $row_d['order_first_name'];
			$row['order_last_name'] = $row_d['order_last_name'];
			$row['passport_num'] = $row_d['passport_num'];
			$row['order_mobile'] = $row_d['order_mobile'];
			$row['order_email'] = $row_d['order_email'];

			?>
			<!-- 여행자 2 웹 -->
			<div class="invoice_table invoice_table_new only_web">
				<h2>여행자
					<?= $seq ?>
				</h2>
				<table>
					<colgroup>
						<col width="15%">
						<col width="*">
					</colgroup>
					<tbody>
						<tr>
							<td class="subject">여행자
								<?= $seq ?>
							</td>
							<td width="15%" class="subject">여권번호</td>
							<td width="15%" class="subject">여권만료일</td>
							<td width="15%" class="subject">생년월일</td>
							<td class="subject">이메일</td>
							<td class="subject">전화번호</td>
						</tr>
						<tr>
							<td class="content">
								<?= $row['order_name_kor'] ?> /
								<?= $row['order_first_name'] ?>
								<?= $row['order_last_name'] ?>
							</td>

							<td class="content">
								<?= $row['passport_num'] ?>
							</td>

							<td class="content">
								<?= date("Y.m.d", strtotime($row["passport_date"])) ?>
							</td>

							<td class="content">
								<?= $order_birthday . " (" . dowYoil($order_birthday) . ")" ?>
							</td>


							<td class="content">
								<?= $row['order_email'] ?>
							</td>

							<td class="content">
								<?= $row['order_mobile'] ?>
							</td>
						</tr>


					</tbody>
				</table>
			</div>



			<!-- 여행자 2 모바일 -->
			<div class="invoice_table invoice_table_new only_mo">
				<h2>여행자
					<?= $seq ?>
				</h2>
				<table>
					<colgroup>
						<col width="15%">
						<col width="*">
					</colgroup>
					<tbody>
						<tr>
							<td class="subject">여행자
								<?= $seq ?>
							</td>
							<td class="content">
								<?= $row['order_name_kor'] ?> /
								<?= $row['order_first_name'] ?>
								<?= $row['order_last_name'] ?>
							</td>
						</tr>
						<tr>
							<td class="subject">여권번호</td>

							<td class="content">
								<?= $row['passport_num'] ?>
							</td>
						</tr>
						<tr>
							<td class="subject">여권만료일</td>
							<td class="content">
								<?= date("Y.m.d", strtotime($row["passport_date"])) ?>
							</td>
						</tr>
						<tr>
							<td class="subject">생년월일</td>

							<td class="content">
								<?= $order_birthday . " (" . dowYoil($order_birthday) . ")" ?>
							</td>
						</tr>
						<tr>
							<td class="subject">이메일</td>
							<td class="content">
								<?= $row['order_email'] ?>
							</td>
						</tr>
						<tr>
							<td class="subject">전화번호</td>
							<td class="content">
								<?= $row['order_mobile'] ?>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
			<?php
		}
		?>

		<div class="invoice_table">
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
							<?= $custom_req ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

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
