<?= $this->extend("inc/layout_index") ?>
<?= $this->section('content') ?>
<main id="container" class="sub find member pt100">
	<div class="inner_620">

		<div class="sub_sec_ttl tac ">
			<h2 class="ttl">아이디/비밀번호 찾기</h2>
		</div>

		<div class="login_tab">
			<button type="button" onClick="location.href='./login_find_id'">아이디 찾기</button>
			<button type="button" class="on" onClick="location.href='./login_find_pw'">비밀번호 찾기</button>
		</div>

		<section class="login_cont">

			<!-- find_radio -->
			<div class="find_radio flex">
				<div class="bs-input-radio">
					<input type="radio" name="find_id" id="find_id_phone" value="sms" checked>
					<label for="find_id_phone">휴대전화로 찾기</label>
				</div>
				<div class="bs-input-radio">
					<input type="radio" name="find_id" id="find_id_email" value="email">
					<label for="find_id_email">이메일로 찾기</label>
				</div>
			</div>
			<!-- //find_radio -->

			<!-- 휴대전화로 찾기 -->
			<div class="login_box on ph_box">
				<div class="input-group">
					<div class="input-row">
						<input type="text" name="user_id" id="user_id" class="bs-input" placeholder="아이디를 입력하세요.">
					</div>
					<div class="input-row">
						<input type="text" name="user_name" id="user_name" class="bs-input" placeholder="이름을 입력하세요.">
					</div>
					<div class="input-row">
						<div class="tel_row">
							<select name="tel1" id="tel1" class="bs-select">
								<option value="010">010</option>
								<option value="011">011</option>
								<option value="016">016</option>
								<option value="017">017</option>
								<option value="018">018</option>
								<option value="019">019</option>
							</select>
							<span>-</span>
							<input type="tel" name="tel2" id="tel2" class="bs-input">
							<span>-</span>
							<input type="tel" name="tel3" id="tel3" class="bs-input">
						</div>
					</div>
					<div class="input-row"><button type="button " class="btn btn-outline-dark"
							onclick="cert_it_1();">인증번호</button></div>

					<div class="input-row">
						<input type="number" name="confirm_num" id="confirm_num" class="bs-input"
							placeholder="인증번호를 입력하세요.">
					</div>

				</div>
			</div>
			<!-- // 휴대전화로 찾기 // -->

			<!-- 이메일로 찾기 -->
			<div class="login_box email_box">
				<div class="input-group">
					<div class="input-row">
						<input type="text" name="user_id2" id="user_id2" class="bs-input" placeholder="아이디를 입력하세요.">
					</div>
					<div class="input-row">
						<input type="text" name="user_name2" id="user_name2" class="bs-input" placeholder="이름을 입력하세요.">
					</div>
					<div class="input-row ">
						<div class="email_row">
							<input name="email_1" id="email_1" type="text" class="bs-input" size="30">
							<span>@</span>
							<input type="email" name="email_2" id="email_2" class="email02 bs-input domain_input"
								disabled>
							<select name="email_sel" class="bs-select domain_list">
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
					<div class="input-row"><button type="button " class="btn btn-outline-dark"
							onclick="cert_it_2();">인증번호</button></div>

					<div class="input-row">
						<input type="number" name="confirm_num2" id="confirm_num2" class="bs-input"
							placeholder="인증번호를 입력하세요.">
					</div>
				</div>
			</div>
			<!-- //  이메일로 찾기  // -->
			<button type="submit" class="btn btn-lg find_btn btn-point" onclick="confirm_it();">확인</button>
		</section>
	</div>

</main>
<script>
	function cert_it_1() {
		if ($("#user_id").val() == "") {
			alert("아이디를 입력해주셔야 합니다.");
			$("#user_id").focus();
			return;
		}
		if ($("#user_name").val() == "") {
			alert("이름을 입력해주셔야 합니다.");
			$("#user_name").focus();
			return;
		}
		if ($("#tel1").val() == "") {
			$("#tel1").focus();
			alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
			return;
		}
		if ($("#tel2").val() == "") {
			$("#tel2").focus();
			alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
			return;
		}
		if ($("#tel3").val() == "") {
			$("#tel3").focus();
			alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
			return;
		}

		var mobile = $("#tel1").val() + "-" + $("#tel2").val() + "-" + $("#tel3").val();

		$.ajax({
			url: "cert_pw_send_sms",
			type: "POST",
			data: {
				mobile: mobile,
				user_name: $("#user_name").val(),
				user_id: $("#user_id").val(),
			},
			error: function (request, status, error) {
				//통신 에러 발생시 처리
			},
			success: function (response) {
				alert(response);
			}
		});
	}

	function cert_it_2() {
		if ($("#user_id2").val().length < 2) {
			alert("아이디를 입력해주셔야 합니다.");
			$("#user_id2").focus();
			return;
		}
		if ($("#user_name2").val().length < 2) {
			alert("이름을 입력해주셔야 합니다.");
			$("#user_name2").focus();
			return;
		}
		if ($("#email_1").val() == "" || $("#email_2").val() == "") {
			$("#email_1").focus();
			alert("이메일을 바르게 입력해주셔야 합니다.");
			return;
		}
		$.ajax({
			url: "cert_pw_send_email",
			type: "POST",
			data: {
				user_email: $("#email_1").val() + "@" + $("#email_2").val(),
				user_name: $("#user_name2").val(),
				user_id: $("#user_id2").val(),
			},
			error: function (request, status, error) {
				//통신 에러 발생시 처리
				alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
			}
			, complete: function (request, status, error) {

			}
			, success: function (response, status, request) {
				alert(response);
			}
		});


	}


	function confirm_it() {

		let user_name;
		let user_id;
		let cert_num;

		if ($("input:radio[name=find_id]:checked").val() == "sms") {

			if ($("#user_id").val() == "") {
				alert("아이디를 입력해주셔야 합니다.");
				$("#user_id").focus();
				return;
			}
			if ($("#user_name").val() == "") {
				alert("이름을 입력해주셔야 합니다.");
				$("#user_name").focus();
				return;
			}
			if ($("#tel1").val() == "") {
				$("#tel1").focus();
				alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
				return;
			}
			if ($("#tel2").val() == "") {
				$("#tel2").focus();
				alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
				return;
			}
			if ($("#tel3").val() == "") {
				$("#tel3").focus();
				alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
				return;
			}

			if ($("#confirm_num").val().length == 0) {
				$("#confirm_num").focus();
				alert("인증번호를 바르게 입력해주셔야 합니다.");
				return;
			}

			user_id = $("#user_id").val();
			user_name = $("#user_name").val();
			cert_num = $("#confirm_num").val();

		} else if ($("input:radio[name=find_id]:checked").val() == "email") {
			if ($("#user_id2").val().length < 2) {
				alert("아이디를 입력해주셔야 합니다.");
				$("#user_id2").focus();
				return;
			}
			if ($("#user_name2").val().length < 2) {
				alert("이름을 입력해주셔야 합니다.");
				$("#user_name2").focus();
				return;
			}
			if ($("#email_1").val() == "" || $("#email_2").val() == "") {
				$("#email_1").focus();
				alert("이메일을 바르게 입력해주셔야 합니다.");
				return;
			}

			if ($("#confirm_num2").val().length == 0) {
				$("#confirm_num2").focus();
				alert("인증번호를 바르게 입력해주셔야 합니다.");
				return;
			}

			user_id = $("#user_id2").val();
			user_name = $("#user_name2").val();
			cert_num = $("#confirm_num2").val();
		}

		var mobile = $("#tel1").val() + "-" + $("#tel2").val() + "-" + $("#tel3").val();
		var user_email = $("#email_1").val() + "@" + $("#email_2").val();

		$.ajax({
			url: "find_pw_ok",
			type: "POST",
			data: {
				mobile: mobile,
				user_name: user_name,
				user_email: user_email,
				user_id: user_id,
				cert_num: cert_num,
				gubun: $("input:radio[name=find_id]:checked").val(),
			},
			error: function (request, status, error) {
				//통신 에러 발생시 처리
			}
			, complete: function (request, status, error) {

			}
			, success: function (response, status, request) {
				alert(response.msg);
			}
		});
	}

	$('.email_row .domain_list').change(function () {
		$(this).find("option:selected").each(function () {
			if ($(this).val() == '1') { //직접입력일 경우
				$(this).parent().siblings(".domain_input").val('');                        //값 초기화
				$(this).parent().siblings(".domain_input").attr("disabled", false); //활성화
			} else { //직접입력이 아닐경우
				$(this).parent().siblings(".domain_input").val($(this).text());      //선택값 입력
				$(this).parent().siblings(".domain_input").attr("disabled", true); //비활성화
			}
		});
	});

	$("input:radio[name=find_id]").click(function () {
		let ChkVal = $("input:radio[name=find_id]:checked").val();

		if (ChkVal == 'sms') {
			$('.ph_box').show()
			$('.email_box').hide()
		} else {
			$('.ph_box').hide()
			$('.email_box').show()
		}


	});
</script>
<iframe width="500" height="500" name="hiddenFrame22" id="hiddenFrame22"
	style="display:none;border:solid 1px;"></iframe>
<?= $this->endSection() ?>