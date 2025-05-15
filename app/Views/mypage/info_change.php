<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />

<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
				echo view("/mypage/mypage_gnb_menu_inc", ["tab_9" => "on", "tab_9_1" => "on"]);
				echo view("member/postcode_inc")
            ?>
		<div class="sub_wrap sub_wrap_padding">
			<div class="sub_content imfor_change">
				<h1 class="ttl_table_discount">정보수정</h1>
                <div class="slide_tab discount flex">
                    <a class="slide_tab_btn active" href="./info_option">내 정보 수정</a>
                    <a class="slide_tab_btn" href="./user_mange">계좌정보</a>
                    <a class="slide_tab_btn" href="./money">회원탈퇴</a>
					<div></div>
                </div>
				<div class="imfor_tb">
					<h4 class="imfor_tit">내 정보수정</h4>
					<form action="imfor_change_ok" method="post" name="frm" id="frm">
                        <input type="hidden" name="mode"    id="mode"    value="mypage" />
                        <input type="hidden" name="sns_key" id="sns_key" value="" />
                        <?php
                        $gubun = chk_member_col(session('member.id'),"gubun");
                        if($gubun == "kakao" && $mode = ""){
                        ?>
                            <button type="button" id="naver_id_login_anchor" class="naver_login" onclick="loginWithKakao()">
                                <img src="/img/login/new_kakao_btn.png" alt="카카오로그인" class="only_web">
                            </button>
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
									<tr <?php if ($member["gubun"] == "naver" || $member["gubun"] == "kakao" || $member["gubun"] == "google") {echo "style='display:none'";} ?>>
										<th><p>아이디</p></th>
										<td colspan="3"><p class="no_write"><?=$member["user_id"]?></p></td>
									</tr>
									<tr>
										<th><p>이메일</p></th>
										<td colspan="3">
											<p class="no_write"><?=$member['user_email']?></p>
										</td>
									</tr>
									<tr>
										<th><p>이름</p></th>
										<td colspan="3">
											<!-- <p class="no_write"><?=$member["user_name"]?></p> -->
											<input type="text" name="user_name" id="user_name" value="<?=$member["user_name"]?>" placeholder="" class="bs-input">
										</td>
									</tr>
									<tr>
										<th><p>생년월일</p></th>
										<td>
										<div class="input-row ">
											<div class="datepick"><input type="text" name="birthday" id="birthday" value="<?=$member["birthday"]?>" onfocus="this.blur()" class="bs-input"></div>
										</div>
										</td>
									</tr>
									<tr <?php if ($member["gubun"] == "naver" || $member["gubun"] == "kakao" || $member["gubun"] == "google") {echo "style='display:none'";} ?>>
										<th><p>신규 비밀번호</p></th>
										<td colspan="3" class="wrap_pass">
											<input type="password" class="pass_input" name="user_pw" maxlength="20">
											<!-- <p class="sm_text sm_text1">
												<span>영문 (소/대문자), 숫자, 특수문자 중 3종류를 조합하여 8~16.</span>
												<span>자리로 사용하시기 바랍니다 비밀번호는 특수문자를 반드시 포함하여 안전한 비밀번호를 사용하시기 바랍니다.</span>
											</p> -->
										</td>
									</tr>
									<tr <?php if ($member["gubun"] == "naver" || $member["gubun"] == "kakao" || $member["gubun"] == "google") {echo "style='display:none'";} ?>>
										<th><p class="pass_confirm">신규 비밀번호 확인</p></th>
										<td colspan="3">
											<input type="password" class="pass_input" name="user_pw2" maxlength="20">
											<!-- <p class="sm_text sm_text2">
												<span>재확인을 위해서 입력하신 비밀번호를 다시 한번 입력해주세요</span>
											</p> -->
										</td>
									</tr>
									
									<!-- <tr>	
										<th class="gender_th"><p>성별</p></th>
										<td class="gender_td">
											<label for="imfor_r01">
												<input type="radio" id="imfor_r01" name="gender" value="M" <? if ($member["gender"] == "M") {echo "checked"; } ?>><span></span>남성
											</label>
											<label for="imfor_r02">
											<input type="radio" id="imfor_r02" name="gender" value="F" <? if ($member["gender"] == "F") {echo "checked"; } ?>class="mar_l"><span></span>여성
											</label>
										</td>
									</tr> -->
									<?php
										// $arr_email	= explode("@",$member["user_email_new"]);
										// $email1		= $arr_email[0];
										// $email2		= $arr_email[1];
										$arr_mobile	= explode("-",$member["user_mobile"]);
										$mobile1	= $arr_mobile[0];
										$mobile2	= $arr_mobile[1];
										$mobile3	= $arr_mobile[2];
										$arr_phone	= explode("-",$member["user_phone"]);
										$phone1		= $arr_phone[0];
										$phone2		= $arr_phone[1];
										$phone3		= $arr_phone[2];
										$arr_birthday= explode("-",$member["birthday"]);		
										$byy		= $arr_birthday[0];		
										$bmm		= $arr_birthday[1];		
										$bdd		= $arr_birthday[2];		
									?>
									<tr>
										<th><p>휴대전화</p></th>
										<td colspan="3" class="wrap_element flex__c">
											<select class="wd_sel" name="mobile1" id="mobile1">
												<option value="">선택</option>
												<option value="010" <?php if ($mobile1 == "010") {echo "selected"; } ?>>010</option>							
												<option value="011" <?php if ($mobile1 == "011") {echo "selected"; } ?>>011</option>							
												<option value="016" <?php if ($mobile1 == "016") {echo "selected"; } ?>>016</option>							
												<option value="017" <?php if ($mobile1 == "017") {echo "selected"; } ?>>017</option>
												<option value="018" <?php if ($mobile1 == "018") {echo "selected"; } ?>>018</option>
												<option value="019" <?php if ($mobile1 == "019") {echo "selected"; } ?>>019</option>	
											</select>
											<input type="text" class="wd_md" value="<?=$mobile2?>" name="mobile2" id="mobile2">
											<input type="text" class="wd_md" value="<?=$mobile3?>" name="mobile3" id="mobile3">
										</td>
									</tr>
									<!-- <tr>
										<th><p>주소</p></th>
										<td>
											<div class="input-row">
												<div class="button-row">
													<input type="text" name="zip" id="sample2_postcode" value="<?=$member['zip']?>" placeholder="" class="bs-input">
													<button type="button" onclick="openPostCode()" class="btn cling-btn btn-outline-dark">우편번호</button>
												</div>
												<input type="text" name="addr1" id="sample2_address" value="<?=$member['addr1']?>" placeholder="" class="bs-input">
												<input type="text" name="addr2" id="sample2_detailAddress" value="<?=$member['addr2']?>" placeholder="" class="bs-input">
											</div>
										</td>
									</tr> -->

                                    <tr>
                                        <th>
                                        
                                           <p>마케팅수신동의</p>
                   
                                        </th>
                                        <td>
											<div class="input-row">
												<div class="bs-input-check">
													<input type="checkbox" name="sms_yn" id="agree_sms" class="agree" value="Y" <?php if($member["sms_yn"] == "Y") echo "checked";?> >
													<label for="agree_sms">SMS 수신동의</label>
												</div>
												<div class="bs-input-check">
													<input type="checkbox" name="user_email_yn" id="agree_email" class="agree" value="Y" <?php if($member["user_email_yn"] == "Y") echo "checked";?> >
													<label for="agree_email">이메일 수신동의</label>
												</div>
											</div>
										</div>
                                        </td>
                                    </tr>
								</tbody>
							</table>
                            
                        
							<div class="color_btn_box flex">
								<button type="button" class="gray_btn" onclick="javascript:location.href='/'">취소</button>
								<button type="button" class="btn_submit mar_r" onclick="javascript:send_it()">확인</button>
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

        // datepick
        $(".datepick input").datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "both",
            buttonImage: '/images/ico/datepicker_ico.png',
            showMonthAfterYear: true,
            buttonImageOnly: true,
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            changeMonth: true, // month 셀렉트박스 사용
            changeYear: true, // year 셀렉트박스 사용
            yearRange: 'c-100:c+0', // 년도 선택 셀렉트박스를 현재 년도에서 이전, 이후로 얼마의 범위를 표시할것인가.
        });

        // $('.datepick input').datepicker('setDate', 'today');

    })
	</script>

	<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
	<script>
    function execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }
                // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                if(fullRoadAddr !== ''){
                    fullRoadAddr += extraRoadAddr;
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('zip').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('addr1').value = fullRoadAddr;
                document.getElementById('addr2').focus();

            }
        }).open();
    }
function send_it()
{
	var frm = document.frm;
	// if (frm.user_pw.value != "")
	// {
	// 	// if (chkPwd(frm.user_pw.value) == false)
	// 	// {
	// 	// 	return;
	// 	// }
	// 	if (frm.user_pw.value != frm.user_pw2.value )
	// 	{
	// 		alert("패스워드가 일치하지 않습니다.");
	// 		return;
	// 	}
	// }
	// if (frm.gender[0].checked == false && frm.gender[1].checked == false )
	// {
	// 	frm.gender[0].focus();
	// 	alert("성별을 선택하셔야 합니다.");
	// 	return;
	// }
	// if (mail_chk(frm.email1.value+"@"+frm.email2.value) == false)
	// {
	// 	frm.email1.focus();
	// 	alert("이메일을 입력해주셔야 합니다.");
	// 	return;
	// }
	if (frm.mobile1.value == "")
	{
		frm.mobile1.focus();
		alert("휴대전화 첫자리를 선택해주셔야 합니다.");
		return;
	}
	if (frm.mobile2.value == "")
	{
		frm.mobile2.focus();
		alert("휴대전화 중간자리를 입력해주셔야 합니다.");
		return;
	}
	if (frm.mobile3.value == "")
	{
		frm.mobile3.focus();
		alert("휴대전화 끝자리를 입력해주셔야 합니다.");
		return;
	}
	// if (frm.phone1.value == "")
	// {
	// 	frm.phone1.focus();
	// 	alert("자택전화 첫자리를 선택해주셔야 합니다.");
	// 	return;
	// }

	// if (frm.phone2.value == "")
	// {
	// 	frm.phone2.focus();
	// 	alert("자택전화 중간자리를 선택해주셔야 합니다.");
	// 	return;
	// }
	// if (frm.phone3.value == "")
	// {
	// 	frm.phone3.focus();
	// 	alert("자택전화 끝자리를 선택해주셔야 합니다.");
	// 	return;
	// }
	// if (frm.phone3.value == "")
	// {
	// 	frm.phone3.focus();
	// 	alert("휴대전화 끝자리를 선택해주셔야 합니다.");
	// 	return;
	// }
	// if (frm.zip.value == "")
	// {
	// 	frm.zip.focus();
	// 	alert("우편번호를 입력하셔야 합니다.");
	// 	return;
	// }
	// if (frm.addr1.value == "")
	// {
	// 	frm.addr1.focus();
	// 	alert("주소를 입력하셔야 합니다.");
	// 	return;
	// }
	// if (frm.addr2.value == "")
	// {
	// 	frm.addr2.focus();
	// 	alert("주소를 입력하셔야 합니다.");
	// 	return;
	// }
	/*
	if (frm.job.value == "")
	{
		frm.job.focus();
		alert("직업을 입력하셔야 합니다.");
		return;
	}
	if (frm.byy.value == "")
	{
		frm.byy.focus();
		alert("년도를 선택하셔야 합니다.");
		return;
	}
	if (frm.bmm.value == "")
	{
		frm.bmm.focus();
		alert("년도를 선택하셔야 합니다.");
		return;
	}

	if (frm.marriage_yn[0].checked == false && frm.marriage_yn[1].checked == false )
	{
		frm.marriage_yn[0].focus();
		alert("결혼 여부를 선택하셔야 합니다.");
		return;
	}
*/
/*
        $.ajax({
			url: "info_change_ok",
			type: "POST",
			data: $("#frm").serialize(),
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
			}
			,complete: function(request, status, error) {
 				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				if (response == "OK") {
					alert("정상적으로 변경되었습니다.");
					location.reload();
					return;
				} else {
					alert(response);
					alert("오류가 발생하였습니다!!");
					return;
				}
			}
        });
*/
        var f = document.frm;
		var mem_data = $(f).serialize();
		$.ajax({
			type  : "POST",
			data  : mem_data,
			url   :  "./info_change_ok",
			cache : false,
			async : false,
			success: function(data, textStatus) {
				alert(data);
				// var obj = jQuery.parseJSON(data);
                // var message = obj.message;
                // alert(message);
				location.reload();
			},
			error:function(request,status,error){
				alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});

}

function chkPwd(str)
{

	var pw = str;
	var num = pw.search(/[0-9]/g);
	var eng = pw.search(/[a-z]/ig);
	var spe = pw.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
	if(pw.length < 6 || pw.length > 20){
		alert("6자리 ~ 20자리 이내로 입력해주세요.");
		return false;
	}

	if(pw.search(/₩s/) != -1){
		alert("비밀번호는 공백없이 입력해주세요.");
		return false;
	}

	if( (num < 0 || eng < 0 || spe < 0) )
	{
		alert("패스워드는 영문,숫자, 특수문자 3가지를 혼합하여 입력해주세요.");
		return false;
	}

	return true;

}
</script>
<?php $this->endSection(); ?>
