<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<?php
$connect = db_connect();
$private_key = private_key();

if ($_SESSION["member"]["mIdx"] == "") {
	alert_msg("", "/");
	exit();
}
?>


<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/gnb_menu_reponsive.css" rel="stylesheet" type="text/css"/>


<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript" src="/member/kakao.js"></script>
<style>
	.mypage_container .slide_tab .slide_tab_btn {
		height: 3.0769rem;
		width: 8.4615rem;
		flex-basis: unset;
		flex-shrink: 1;
	}

	.sub_wrap .sub_content h4.imfor_tit {
		font-size: 1.3077rem;
	}

	.mypage_container .ttl_table_discount {
		margin-bottom: 2.3077rem;
	}

	@media screen and (max-width : 850px) {
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
<form action="/member/login_check" method="post" name="loginForm" id="loginFrm" class="login_form01">
	<input type="hidden" name="returnUrl" value="<?= urlencode($returnUrl) ?>">
	<input type="hidden" name="mode" id="mode" value="mypage" />
	<input type="hidden" name="sType" id="sType" value="login">
	<input type="hidden" name="sns_key" id="sns_key" value="" />
	<input type="hidden" name="user_name" id="user_name" value="" />
	<input type="hidden" name="userEmail" id="userEmail" value="" />
	<input type="hidden" name="gubun" id="gubun" value="" />
</form>

<section class="mypage_container">
	<div class="inner">
		<div class="mypage_wrap">
			<?php
				echo view("/mypage/mypage_gnb_menu_inc", ["tab_9" => "on", "tab_9_1" => "on"]);
			?>
			<?php
			$total_sql = " select *,  CONVERT(AES_DECRYPT(UNHEX(user_name),'$private_key') USING utf8) as user_name_new,  CONVERT(AES_DECRYPT(UNHEX(user_mobile),'$private_key') USING utf8) as user_mobile_new from tbl_member where m_idx = '" . $_SESSION["member"]["mIdx"] . "' ";
			$row = $connect->query($total_sql)->getRowArray();
			if ($row["user_id"] == "" || $_SESSION["member"]["mIdx"] == "") {
				?>
				<script>
					location.href = "/";
				</script>
				<?php

				exit();
			}
			?>
			<div class="sub_wrap sub_wrap_padding">

				<div class="sub_content imfor_change">
					<h1 class="ttl_table_discount">정보수정</h1>
					<div class="slide_tab discount flex">
						<a class="slide_tab_btn active" href="./info_change">내 정보 수정</a>
						<a class="slide_tab_btn" href="./user_mange">계좌정보</a>
						<?php if ($gubun !== "kakao" && $gubun !== 'google') {
							echo '<a class="slide_tab_btn" href="./money">회원탈퇴</a>';
						} else {
							echo "";
						}
						?>
					</div>
					<div class="imfor_tb">
						<h4 class="imfor_tit">내 정보수정</h4>
						<form method="post" onsubmit="return send_it(this);" name="frm" id="frm">
							<input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
							<input type="hidden" name="mode" id="mode" value="mypage" />
							<input type="hidden" name="sns_key" id="sns_key" value="" />

							<?php
							$gubun = chk_member_col(session('member.id'), "gubun");
							if ($gubun == "naver") {
								// 네이버 로그인 접근토큰 요청 예제
								$client_id = env('NAVER_CLIENT_ID');;
								$redirectURI = urlencode("https://" . $_SERVER["HTTP_HOST"] . "/naver/callback");
								$state = md5(microtime() . mt_rand()) . "myp";
								$_SESSION['naver_state'] = $state;
								$apiURL = "https://nid.naver.com/oauth2.0/authorize?mode=mypage&response_type=code&client_id=" . $client_id . "&redirect_uri=" . $redirectURI . "&state=" . $state;
								?>
								<a href="<?php echo $apiURL ?>">
									<button type="button" id="naver_id_login_anchor" class="naver_login">
										<img src="/img/login/new_naver_btn.png" alt="네이버로그인" class="only_web">
									</button>
								</a>
								<?php
							} else if ($gubun == "kakao") {
								?>
									<div class='another_login' style="margin:0;justify-content:unset;">
										<button type="button" id="naver_id_login_anchor" class="naver_login"
											onclick="loginWithKakao()">
											<img src="/img/login/new_kakao_btn.png" alt="카카오로그인" class="only_web">
										</button>
									<?php if ($gubun == "kakao" || $gubun == 'google')
										echo "연결해제를 원하실경우 SNS 해당 계정에서 연결해제를 하시면 됩니다." ?>
										</div>
								<?php
							} else if ($gubun == 'google') {
								// 구글
								$client_id = "201811301708-psla2uvr74i6mrt01a45379omt5inbdn.apps.googleusercontent.com";
								$redirection_url = "https://{$_SERVER['HTTP_HOST']}/include/google.php";
								$scope = "https://www.googleapis.com/auth/userinfo.email ";
								$response_type = "code";

								$_url = "https://accounts.google.com/o/oauth2/v2/auth";
								$_url .= "?client_id=" . $client_id;
								$_url .= "&redirect_uri=" . urlencode($redirection_url);
								$_url .= "&scope=" . $scope;
								$_url .= "&response_type=" . $response_type;
								$_url .= "&mode=mypage";
								$_url .= "&state=mypage";
								?>
										<div class='another_login' style="margin:0;justify-content:unset;">
											<button type="button" id="customBtn" class="another_btn google"
												onclick="location.href='<?= $_url ?>'">
												구글로그인
											</button>

									<?php if ($gubun == "kakao" || $gubun == 'google')
										echo "연결해제를 원하실경우 SNS 해당 계정에서 연결해제를 하시면 됩니다." ?>
											</div>


								<?php
							} else {
								?>
										<fieldset>
											<legend>회원 정보 수정</legend>
											<table>
												<caption>회원 정보 수정 작성 표</caption>
												<colgroup>
													<col width="15%">
													<col width="*">
												</colgroup>
												<tbody>
													<tr <?php if ($row["gubun"] == "naver") {
														echo "style='display:none'";
													} ?>>
														<th>
															<p>아이디</p>
														</th>
														<td colspan="3">
															<p class="no_write"><?= $row["user_id"] ?></p>
														</td>
													</tr>
													<tr <?php if ($row["gubun"] == "naver") {
														echo "style='display:none'";
													} ?>>
														<th>
															<p>비밀번호</p>
														</th>
														<td colspan="3" class="wrap_pass">
															<input type="password" class="pass_input" name="user_pw" maxlength="20">
															<!-- <p class="sm_text sm_text1">
												<span>영문 (소/대문자), 숫자, 특수문자 중 3종류를 조합하여 8~16.</span>
												<span>자리로 사용하시기 바랍니다 비밀번호는 특수문자를 반드시 포함하여 안전한 비밀번호를 사용하시기 바랍니다.</span>
											</p> -->
														</td>
													</tr>

												</tbody>
											</table>
											<div class="color_btn_box flex">
												<button type="button" class="gray_btn"
													onclick="javascript:location.href='/'">취소</button>
												<button type="button" class="btn_submit mar_r"
													onclick="javascript:send_it()">확인</button>
											</div><!-- color_btn_box -->
										</fieldset>
								<?php
							}
							?>
						</form>

					</div>
				</div><!-- sub_content -->

			</div><!-- sub_wrap -->

</section><!-- //sub_container End -->

<script>
	function send_it() {
		var frm = document.frm;
		if (frm.user_pw.value == "") {

			alert("패스워드가 일치하지 않습니다.");
			return;
		}

		var f = document.frm;
		var mem_data = $(f).serialize();
		console.log(mem_data);
		var save_result = "";
		$.ajax({
			url: "./info_option_ok",
			type: "POST",
			data: mem_data,
			// cache : false,
			// async : false,
			success: function (response, textStatus) {
				if (response == "OK") {
					// alert("정상적으로 탈퇴 신청이 되었습니다.");
					location.href = "/mypage/info_change";
					return;
				} else if (response == "NOUSER") {
					alert("일치하는 아이디가 없습니다.");
					return;
				} else if (response == "NOPASS") {
					alert("패스워드가 일치하지 않습니다.");
					return;
				} else if (response == "NOMOBILE") {
					alert("휴대폰번호가 일치하지 않습니다.");
					return;
				} else if (response == "NOMATCH") {
					alert("로그인정보와 아이디가 일치하지 않습니다.");
					return;
				} else {
					alert(response);
					alert("오류가 발생하였습니다!!");
					return;
				}
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});

	}
</script>
<?php $this->endSection(); ?>