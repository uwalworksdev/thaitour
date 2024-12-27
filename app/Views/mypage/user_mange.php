<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
$connect = db_connect();

if ($_SESSION["member"]["mIdx"] == "") {
	alert_msg("", "/");
	exit();
}
?>


<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/gnb_menu_reponsive.css" rel="stylesheet" type="text/css" />
<style>
	.mypage_container .slide_tab .slide_tab_btn {
		height: 3.0769rem;
		width: 8.4615rem;
		flex-basis: unset;
		flex-shrink: 1;
	}

	.sub_wrap .sub_content h3 {
		font-size: 1.3077rem;
	}

	.mypage_container .ttl_table_discount {
		margin-bottom: 2.3077rem;
	}

	@media screen and (max-width : 850px) {

		.sub_wrap .sub_content h3 {
			font-size: 3.4rem;
		}
		.mypage_container .slide_tab.discount .slide_tab_btn {
        flex-basis: 33.33%;
    }

	.mypage_container .slide_tab .slide_tab_btn {
        flex-shrink: 0;
        height: 8.3rem;
        width: 100%;
        flex-basis: 50%;
        border: 0.1999rem solid #dbdbdb;
        border-bottom: 0.1999rem solid;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #757575;
    }
	.sub_wrap .sub_content h4.imfor_tit {
		font-size: 3.4rem;
		margin-bottom: 0;
	}
	}
</style>
<section class="mypage_container">
	<div class="inner">
		<div class="mypage_wrap">
			<?php
				echo view("/mypage/mypage_gnb_menu_inc", ["tab_9" => "on", "tab_9_2" => "on"]);
			?>
			<div class="sub_wrap sub_wrap_padding">
				<div class="sub_content user_mange">
					<h1 class="ttl_table_discount">정보수정</h1>
					<div class="slide_tab discount flex">
						<a class="slide_tab_btn" href="./info_option">내 정보 수정</a>
						<a class="slide_tab_btn active" href="./user_mange">계좌정보</a>
						<?php if ($gubun !== "kakao" && $gubun !== 'google') {
							echo '<a class="slide_tab_btn" href="./money">회원탈퇴</a>';
						} else {
							echo "";
						}
						?>

						<!-- <div></div> -->
					</div>
					<h3>계좌정보</h3>
					<!-- <div class="sub_tit">
						<p>- 해당계좌는 여행계약 해제, 유류할증료 변경 등에 따른 차액 발생 시 환불계좌로 사용됩니다.</p>
						<p>- 회원명과 동일 예금주명의 계좌로만 인증이 가능합니다.</p>
					</div> -->
					<div class="imfor_tb">
						<form action="/mypage/user_mange_ok" name="frm" method="post">
							<input type="hidden" name="mb_idx" value="<?= $row_bank["mb_idx"] ?>">
							<fieldset>
								<legend>환불 정보 관리</legend>
								<table>
									<caption>환불 정보 관리</caption>
									<colgroup>
										<col width="15%">
										<col width="*">
									</colgroup>
									<tbody>
										<tr>
											<th><!-- style="text-align:center" -->
												<label for="mange_la01">은행명</label>
											</th>
											<td>
												<select id="mange_la01" name="bank_code"><!-- style="width:200px" -->
													<option value="">은행선택</option>
													<?php
														foreach ($bank_list as $frow) {
													?>
														<option value="<?= $frow["code_no"] ?>" <?php if ($row_bank["bank_code"] == $frow["code_no"]) {
															  echo "selected";
														  } ?>><?= $frow["code_name"] ?></option>
													<?php
														}
													?>
												</select>
											</td>
										<tr>
										</tr>
										<th>
											<label for="mange_la02">계좌번호</label>
										</th>
										<td>
											<input type="text" name="bank_num" value="<?= $row_bank["bank_num"] ?>"
												class="account_write" placeholder="‘ - ’ 없이 숫자만 입력 하세요"
												onfocus="this.placeholder=''"
												onblur="this.placeholder='- 없이 숫자로만 입력하세요'" id="mange_la02"
												maxlength="20">
										</td>
										</tr>
										<tr>
											<th>
												<span class="linefeed"></span>
												<label for="mange_la03">예금주</label>
											</th>
											<td>
												<input type="text" name="bank_user" placeholder="예금주명"
													class="holder_write" value="<?= $row_bank["bank_user"] ?>"
													id="mange_la03" maxlength="10">
											</td>
										</tr>
									</tbody>
								</table>
							</fieldset>
						</form>
						<div class="color_btn_box flex">
							<button type="button" class="gray_btn"
								onclick="javascript:location.href='/'">취소</button>
							<?php if ($row_bank["mb_idx"] != "") { ?>
								<button type="button" class="btn_submit mar_r" onclick="javascript:send_it()">확인</button>
							<?php } else { ?>
								<button type="button" class="btn_submit mar_r" onclick="javascript:send_it()">등록하기</button>
								<!-- <button type="button" onclick="javascript:send_it()" class="blue_btn">등록하기</button> -->
							<?php } ?>
						</div><!-- color_btn_box -->
					</div><!-- imfor_tb -->
				</div><!-- sub_content -->
			</div>
		</div>
	</div>
</section>

<script>
	function send_it() {
		var frm = document.frm;
		if (frm.bank_code.value == "") {
			frm.bank_code.focus();
			alert("은행을 선택하셔야 합니다.");
			return;
		}
		if (frm.bank_num.value == "") {
			frm.bank_num.focus();
			alert("계좌번호를 입력하셔야 합니다.");
			return;
		}
		if (frm.bank_user.value == "") {
			frm.bank_user.focus();
			alert("예금주를 입력하셔야 합니다.");
			return;
		}
		frm.submit();
	}
</script>
<?php $this->endSection(); ?>
