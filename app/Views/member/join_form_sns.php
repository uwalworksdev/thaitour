<?php
$this->extend('inc/layout_index');
$this->section('content');
?>

<main id="container" class="sub join_form member pt100" data-step-page="step02">
    <div class="inner_620" id="container" class="member-container member-form">

        <div class="sub_sec_ttl tac ">
            <h2 class="ttl">회원가입</h2>
        </div>

        <?php echo view('member/join_step_inc'); ?>

		<form name="reg_mem_fm" id="reg_mem_fm" action="member_reg_ok" method="post" enctype="multipart/form-data"> <!--  -->
			<input type="hidden" name="cert_type" id="cert_type" value="mobile">
			<input type="hidden" name="cert_yn_1" id="cert_yn_1" value="N">
			<input type="hidden" name="cert_yn_2" id="cert_yn_2" value="N">
			<?php if($gubun != "" || $sns_key != "") { ?>
			<input type="hidden" name="user_id" id="user_id" value="<?=$userId?>">
			<?php } ?>
			<input type="hidden" name="gubun"          id="gubun" value="<?=$gubun?>">
			<input type="hidden" name="sns_key"        id="sns_key" value="<?=$sns_key?>">
			<input type="hidden" name="id_chk"         id="id_chk" value="">
			<input type="hidden" name="userNameChk"    id="userNameChk" value="" />
			<input type="hidden" name="sms_chk"        id="sms_chk" value="">
			<input type="hidden" name="mem_level"      id="mem_level" value="">
			<input type="hidden" name="sms_yn"         id="sms_yn" value="">
			<input type="hidden" name="user_email_yn"  id="user_email_yn" value="">
			<input type="hidden" name="etc"            id="etc" value="">
			<input type="hidden" name="member_payment" id="member_payment" value="">
			<input type="hidden" name="user_email"     id="user_email" value="">
			<input type="hidden" name="user_mobile"    id="user_mobile" value="">
			<input type="hidden" name="visit_route"    id="visit_route" value="">

            <h3 class="mem_ttl">기본 정보입력</h3>
            <ul class="form_list col_list">

                <li class="input-wrap">
                    <label class="label">이름*</label>
                    <div class="val input-row">
                        <input type="text" name="user_name" id="user_name" value="<?=$user_name?>" class="bs-input">
                    </div>
                </li>

				<li class="input-wrap">
					<label class="label">이메일*</label>
					<div class="val email_row">
						<input name="user_email_1" id="user_email_1" value="<?=$email_arr[0]?>" style="width: 50%;" type="text" class="bs-input" size="30" <?=$gubun != 'kakao' ? "disabled" : null?> />
						<span>@</span>
						<input type="email" name="user_email_2" id="user_email_2" style="width: 50%;" value="<?=$email_arr[1]?>" class="email02 bs-input domain_input" <?=$gubun != 'kakao' ? "disabled" : null?> >
						<!-- <select name="res_email_sel" class="bs-select domain_list">
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
						</select> -->
					</div>
				</li>
            </ul>
			<!-- <div class="flex_box_cap">
                <img src="" alt="captcha" id="cap_re" loading="lazy">
                <div class="spinner" id="spinner_load"></div>

                <input type="hidden" value="" id="hidden_captcha" />


                <button class="re_btn" type="button" onclick="reloadCaptcha()">
                    <img class="re_cap" src="../assets/img/reload.png" alt="">
                    <p>새로고침</p>
                </button>

                <div class="input-wrapper">
                    <input class="captcha_input" id="captcha_input" type="text" name="captcha">
                    <label for="captcha_input" class="placeholder-text">보안 문자 입력</label>
                </div>
            </div>
            <br><br> -->
            <div class="bot_btn">
                <a href="#!" onclick="fn_submit();" class="cta_btn btn-point">다음</a>
            </div>



        </form>


    </div>

    <? include $_SERVER['DOCUMENT_ROOT'] . "/inc/postcode.php"; ?>
</main>

<script>
    var input = document.getElementById('captcha_input');
    var placeholder = document.querySelector('.placeholder-text');

    input && input.addEventListener('input', function () {
        if (input.value) {
            placeholder.classList.add('hide-placeholder');
        } else {
            placeholder.classList.remove('hide-placeholder');
        }
    });

    if (input && input.value) {
        placeholder.classList.add('hide-placeholder');
    }
</script>
<script>

    $("#cap_re").css("opacity", "0");
    function reloadCaptcha() {
        $.ajax({
            url: '/tools/generate_captcha',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                document.getElementById('cap_re').src = data.captcha_image;
                document.getElementById('hidden_captcha').value = data.captcha_value;
                document.getElementById('spinner_load').style.display = "none"
				$("#cap_re").css("opacity", "1");
            }
        })
    }

    // reloadCaptcha(); 
</script>

<script>
$(document).ready(function()
{
    $("input:radio[name=find_id]").click(function()
    {
	   var type = $('input[name=find_id]:checked').val();
	   if(type == "0") {
          $("#cert_type").val('mobile');
		  $("#info_mobile").show();
		  $("#info_email").hide();
       } else {
          $("#cert_type").val('email');
		  $("#info_mobile").hide();
		  $("#info_email").show();
       } 

    })
});
</script>

<script>
		
    $(function () {
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

        $('.email_row .domain_list2').change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).val() == '1') { //직접입력일 경우
                    $(this).parent().siblings(".domain_input2").val('');                        //값 초기화
                    $(this).parent().siblings(".domain_input2").attr("disabled", false); //활성화
                } else { //직접입력이 아닐경우
                    $(this).parent().siblings(".domain_input2").val($(this).text());      //선택값 입력
                    $(this).parent().siblings(".domain_input2").attr("disabled", true); //비활성화
                }
            });
        });

    })

	function fn_submit() {
			
			var frm = document.reg_mem_fm;
			var captchaValue = $("#hidden_captcha").val();
            var userInputCaptcha = $("#captcha_input").val();
			if (frm.user_name.value == "") {
				alert("이름을 입력해주세요.");
				frm.user_name.focus();
				return false;
			}


			if($("#user_email_1").val() == "") {
			   alert("이메일을 입력해 주세요.");
			   $("#user_email_1").focus();
			   return false;
			}

			if($("#user_email_2").val() == "") {
			   alert("이메일을 입력해 주세요.");
			   $("#user_email_2").focus();
			   return false;
			}
			if (userInputCaptcha !== captchaValue) {
            alert("보안문자 일치지않습니다.");
            $("#captcha_input").focus();
            reloadCaptcha();
            return false;
        }

		var email =  $("#user_email_1").val() +'@'+ $("#user_email_2").val();

		frm.user_email.value = email;
		$.ajax({
			type: "POST",
			url: $(frm).attr("action"),
			data: $(frm).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.message == "success") {
					location.replace("/member/join_complete")
				} else {
					alert(data.message);
					location.replace("/")
				}
			},
			error: function (data) {
				console.log(data);
				alert(data.responseJSON?.message || "error");
			}
		})
		return false;
	}

	let idReg = /^(?=.*[a-zA-Z])(?=.*[0-9]).{4,16}$/; //대/소문자 + 숫자 + 특수문자
	let passwdReg = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{6,15}$/; //대/소문자 + 숫자 + 특수문자
	let reg_name = /^[가-힣a-zA-Z]+$/; // 한글 + 영문만
	let regEmail = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/; //이메일 유효성검사
	let nickNameChk = false;

	$(document).ready(function () {

		$('.red').hide();
		$('.blue').hide();

		$("#user_id").keyup(function () {

			var id = $("#user_id").val();

			if (idReg.test(id)) {
				$(".idWarning1").hide();
				$(".idSuccess1").show();
			} else {
				$(".idWarning1").show();
				$(".idSuccess1").hide();
			}

		});

		$("#user_pw, #user_pw2").keyup(function () {

			var ps1 = $("#user_pw").val();
			var ps2 = $("#user_pw2").val();

			if (passwdReg.test(ps1)) {
				$(".passwdWarning1").hide();
				$(".passwdSuccess1").show();
			} else {
				$(".passwdWarning1").show();
				$(".passwdSuccess1").hide();
			}

			if (ps1 == ps2) {
				$(".red_txt").hide();
				$(".passwdWarning2").hide();
			} else {
				//$(".red_txt").show();
				$(".passwdWarning2").show();
			}

		});

		$('.agree_more').click(function () {
			var ykNum = $(this).data('yk');

			$('#' + ykNum).show();
		})

		$('.pp_pop .close').click(function () {
			$('.pp_pop').hide();
		})


		// 아이디 생성
		$("#user_email1, #user_email2, #user_email2_d").change(function () {
			set_user_id();
		});

		// 닉네임 변경시 재중복확인
		$("#user_nickname").on("change, keydown", function () {
			nickNameChk = false;
			$(".unicknameSuccess").hide();
		})


		//이름유효성검사
		$("#user_name").change(function () {
			if (reg_name.test($(this).val())) {
				$(".unameSuccess").show();
				$(".unameWarning").hide();
				$("#userNameChk").val("Y");
			} else {
				$(".unameSuccess").hide();
				$(".unameWarning").show();
				$("#userNameChk").val("N");
			}
		})


		// 이메일 직접입력
		$('.email_box select').on('change', function () {
			if ($(this).val() == 'direct_email') {
				$(this).next('input').prop('readonly', false).focus();
			} else {
				$(this).next('input').prop('readonly', true);
			}
		})

		// 전체클릭
		$('#agree_all').on('change', function () {
			if ($(this).is(':checked')) {
				$('.agree_list input[type="checkbox"]').prop('checked', true);
			} else {
				$('.agree_list input[type="checkbox"]').prop('checked', false);
			}
		})
		$('.agree_list input[type="checkbox"]').on('change', function () {
			var checkLength = $('.agree_list input[type="checkbox"]').length;
			var checkTotal = $('.agree_list input[type="checkbox"]:checked').length;
			if (checkLength <= checkTotal) {
				$('#agree_all').prop('checked', true);
			} else {
				$('#agree_all').prop('checked', false);
			}
		})
		$('.certi_time').hide();
		$('.certChkBox').hide();
	});
</script>

<?php $this->endSection(); ?>
