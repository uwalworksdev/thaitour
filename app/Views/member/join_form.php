<?php
$this->extend('inc/layout_index');
$this->section('content');

$sns = session('sns') ?? [];
$naver = session('naver') ?? [];
$google = session('google') ?? [];
$facebook = session('facebook') ?? [];
$kakao = session('kakao') ?? [];
$member = session('member') ?? [];
$sns_gubun = $sns['gubun'] ?? '';
$user_name = '';

if ($sns_gubun == "naver") {
    $gubun = $sns_gubun;
    $userEmail = $naver['userEmail'];
    $userId = $naver['user_id'];
    $sns_key = $naver['sns_key'];
} else if ($sns_gubun == "google") {
    $gubun = $sns_gubun;
    $userEmail = $google['userEmail'];
    $userId = $google['user_id'];
    $sns_key = $google['sns_key'];
} else if ($sns_gubun == "facebook") {
    $gubun = $sns_gubun;
    $userEmail = $facebook['userEmail'];
    $userId = $facebook['user_id'];
    $sns_key = $facebook['sns_key'];
} else if ($sns_gubun == "kakao") {
    $gubun = $sns_gubun;
    $userEmail = updateSQ($_POST["userEmail"] ?? "");
    $userId = "kakao_" . updateSQ($_POST["sns_key"] ?? "");
    $sns_key = $kakao['sns_key'];
} else {
    $gubun = "";
    $userEmail = updateSQ($_POST["userEmail"] ?? "");
    $userId = "";
    $sns_key = "";
}

$email = explode("@", $userEmail);

// 실명인증 확인
$real_code = $_REQUEST['real_code'] ?? "";
$real_info = session('REAL_' . $real_code);
// CMS 클래스
// require_once ($_SERVER['DOCUMENT_ROOT'] . "/class/JkCms.php");
// $Cms = new JkCms("info");
// $info_arr = $Cms->get_arr(array("key" => "r_type"));

/*
   if($real_code == "" || $real_info['user_name'] == ""){
       echo "<script> alert('먼저 실명인증을 하셔야 합니다.'); document.location.href = '/member/certify.php'; </script>";
       exit;
   }
   */
$mIdx = $_REQUEST['mIdx'] ?? "";
if ($mIdx != "") {
    echo "<script> document.location.href = '/'; </script>";
    exit;
}

?>

<style>
    .bs-textarea {
        padding: 14px;
    }
</style>

<main id="container" class="sub join_form member pt100" data-step-page="step02">
    <div class="inner_620" class="member-container member-form">

        <div class="sub_sec_ttl tac ">
            <h2 class="ttl">회원가입</h2>
        </div>

         <?php echo view('member/join_step_inc'); ?>
        <div class="login_find form_cont">
            <div class="find_id" id="id_find">
                <!-- find_radio -->
                <div class="find_radio flex">
                    <div class="bs-input-radio">
                        <input type="radio" name="find_id" id="find_id_phone" value="0" checked>
                        <label for="find_id_phone">휴대전화로 인증하기</label>
                    </div>
                    <div class="bs-input-radio">
                        <input type="radio" name="find_id" id="find_id_email" value="1">
                        <label for="find_id_email">이메일로 인증하기</label>
                    </div>
                </div>
                <!-- //find_radio -->
                <form> <!--  -->
                    <fieldset>
                        <legend class="blind">아이디 찾기</legend>
                        <div class="find_id_box">
                            <!-- login_form -->
                            <div class="login_form on" id="info_mobile">
                                <div class="input-group">
                                    <div class="input-wrap">
                                        <label class="label">휴대번호*</label>
                                        <div class="input-row">
                                            <div class="button-row">
                                                <div class="tel_row">
                                                    <select id="mobile_1_1" class="s_input" name="mobile_1_1">
                                                        <option value="" selected="">선택</option>
                                                        <option value="010">010</option>
                                                        <option value="011">011</option>
                                                        <option value="013">013</option>
                                                        <option value="016">016</option>
                                                        <option value="017">017</option>
                                                        <option value="018">018</option>
                                                        <option value="019">019</option>
                                                    </select>
                                                    <span>-</span>
                                                    <input type="tel" id="mobile_1_2" onkeyup="" class="s_input"
                                                        name="mobile_1_2" maxlength="4" numberonly="true">
                                                    <span>-</span>
                                                    <input type="tel" id="mobile_1_3" onkeyup="" class="s_input"
                                                        name="mobile_1_3" maxlength="4" numberonly="true">
                                                </div>
                                                <button type="button" class="btn cling-btn btn-outline-dark"
                                                    onclick='certi_send_1();'>인증번호</button>

                                            </div>
                                            <div class="button-row">
                                                <input type="text" id="certi_num_1" name="certi_num_1" class="bs-input"
                                                    placeholder="">
                                                <button type="button" class="btn cling-btn btn-outline-dark"
                                                    onclick="certi_chk_1()">인증확인</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-wrap">
                                        <label class="label">이메일 *</label>
                                        <div class="input-row">
                                            <div class="email_row">
                                                <input name="user_email_1_1" id="user_email_1_1" type="text"
                                                    class="bs-input" size="30" value="<?= $email[0] ?? "" ?>">
                                                <span>@</span>
                                                <input type="email" name="user_email_1_2" id="user_email_1_2"
                                                    class="email02 bs-input domain_input" value="<?= $email[1] ?? "" ?>"
                                                    disabled>
                                                <select name="res_email_sel" class="bs-select domain_list">
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
                                </div>
                                <!-- <p class="red">인증번호가 일치하지 않습니다.</p> -->
                            </div>

                            <!-- // login_form -->
                            <!-- login_form -->
                            <div class="login_form" id="info_email" style="display:none;">
                                <div class="input-group">
                                    <div class="input-wrap">
                                        <label class="label">이메일*</label>
                                        <div class="input-row">
                                            <div class="email_row">
                                                <input type="text" name="user_email_2_1" class="bs-input"
                                                    id="user_email_2_1" value="" required>
                                                <span>@</span>
                                                <input type="email" name="user_email_2_2" id="user_email_2_2"
                                                    class="bs-input">
                                                <select name="res_email_sel2" class="bs-select"
                                                    onchange="email_sel(this.value);">
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
                                            <button type="button" onclick="javascript:certi_send_2();"
                                                class="btn btn-outline-dark">인증번호 전송받기</button>
                                            <div class="button-row">
                                                <input type="text" id="certi_num_2" name="certi_num_2" class="bs-input"
                                                    placeholder="">
                                                <button type="button" class="btn cling-btn btn-outline-dark"
                                                    onclick='certi_chk_2()'>인증확인</button>
                                            </div>

                                        </div>


                                        <!-- <p class="red">인증번호가 일치하지 않습니다.</p> -->
                                    </div>
                                    <div class="input-wrap">
                                        <label class="label">휴대번호*</label>
                                        <div class="tel_row">
                                            <!--input type="tel" id="mobile_2_1" onkeyup="" class="bs-input" name="mobile_2_1" size="20" maxlength="20" numberonly="true"-->
                                            <select id="mobile_2_1" class="bs-input" name="mobile_2_1">
                                                <option value="" selected="">선택</option>
                                                <option value="010">010</option>
                                                <option value="011">011</option>
                                                <option value="013">013</option>
                                                <option value="016">016</option>
                                                <option value="017">017</option>
                                                <option value="018">018</option>
                                                <option value="019">019</option>
                                            </select>
                                            <span>-</span>
                                            <input type="tel" id="mobile_2_2" onkeyup="" class="bs-input"
                                                name="mobile_2_2" maxlength="4" numberonly="true">
                                            <span>-</span>
                                            <input type="tel" id="mobile_2_3" onkeyup="" class="bs-input"
                                                name="mobile_2_3" maxlength="4" numberonly="true" -->
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- // login_form -->
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <form name="reg_mem_fm" id="reg_mem_fm" action="member_reg_ok" method="post"
            onsubmit="return fn_submit(this);" enctype="multipart/form-data"> <!--  -->
            <input type="hidden" name="cert_type" id="cert_type" value="mobile">
            <input type="hidden" name="cert_yn_1" id="cert_yn_1" value="">
            <input type="hidden" name="cert_yn_2" id="cert_yn_2" value="">
            <?php if ($gubun != "" || $sns_key != "") { ?>
                <input type="hidden" name="user_id" id="user_id" value="<?= $userId ?>">
            <?php } ?>
            <input type="hidden" name="gubun" id="gubun" value="<?= $gubun ?>">
            <input type="hidden" name="sns_key" id="sns_key" value="<?= $sns_key ?>">
            <input type="hidden" name="id_chk" id="id_chk" value="">
            <input type="hidden" name="userNameChk" id="userNameChk" value="" />
            <input type="hidden" name="sms_chk" id="sms_chk" value="Y">
            <input type="hidden" name="mem_level" id="mem_level" value="">
            <input type="hidden" name="sms_yn" id="sms_yn" value="">
            <input type="hidden" name="user_email_yn" id="user_email_yn" value="">
            <input type="hidden" name="etc" id="etc" value="">
            <input type="hidden" name="member_payment" id="member_payment" value="">
            <input type="hidden" name="user_email" id="user_email" value="">
            <input type="hidden" name="user_mobile" id="user_mobile" value="">
            <input type="hidden" name="visit_route" id="visit_route" value="">
            <input type="hidden" id="hidden_input" name="hidden_input" value="">

            <h3 class="mem_ttl">기본 정보입력</h3>
            <div class="input-group">
                <!-- 아이디 -->
                <?php if ($gubun == "" || $sns_key == "") { ?>
                    <div class="input-wrap">
                        <label class="label">아이디*</label>
                        <div class="input-row">
                            <div class="button-row">
                                <input type="text" name="user_id" id="user_id" class="bs-input">
                                <button type="button" class="btn cling-btn btn-outline-dark" onclick="chk_id();">아이디
                                    중복체크</button>
                            </div>
                        </div>
                        <p class="caption idWarning1 gray">아이디를 입력해 주세요.(영문소문자/숫자, 4~16자)</p>
                        <p class="caption idWarning1 red">공백/특수문자가 포함되었거나, 숫자로 시작 또는 숫자로만 이루어진 아이디는 사용할 수
                            없습니다.(영문소문자/숫자, 4~16자)</p>
                        <p class="caption idWarning1 red">사용 불가한 아이디입니다.</p>
                        <p class="caption idSuccess1 blue">사용 가능한 아이디입니다.</p>
                    </div>
                    <div class="input-wrap">
                        <label class="label">비밀번호*</label>
                        <div class="input-row">
                            <input type="password" name="user_pw" id="user_pw" class="bs-input" autocomplete="new-password">
                        </div>
                        <p class="caption passwdWarning1 gray">6 ~ 15자의 영문 대/소문자, 숫자, 특수문자를 사용하세요.</p>
                        <p class="caption passwdWarning1 red">비밀번호는 8~20자의 영문 대/소문자, 숫자, 특수문자 등 3종류 이상으로 조합해주세요.</p>
                        <p class="caption passwdSuccess1 blue">사용 가능한 비밀번호입니다.</p>
                    </div>
                    <div class="input-wrap">
                        <label class="label">비밀번호 확인*</label>
                        <div class="input-row">
                            <input type="password" name="user_pw2" id="user_pw2" class="bs-input">
                        </div>
                        <p class="caption gray">필수 입력 정보입니다</p>
                        <p class="caption passwdWarning2 red">비밀번호가 일치하지 않습니다.</p>
                    </div>
                <?php } ?>

                <div class="input-wrap">
                    <label class="label">한국이름*</label>
                    <div class="input-row">
                        <input type="text" name="user_name" id="user_name" value="<?= $user_name ?>" class="bs-input">
                    </div>
                </div>

                <div class="input-wrap">
                    <label class="label">영문 이름*</label>
                    <div class="input-row">
                        <input type="text" name="user_name" id="user_name" value="<?= $user_name ?>" class="bs-input">
                    </div>
                </div>

                <div class="input-wrap">
                    <label class="label">생년월일*</label>
                    <div class="input-row ">
                        <div class="datepick"><input type="text" name="birth_day" id="birth_day" onfocus="this.blur()"
                                class="bs-input"></div>
                    </div>
                </div>
                <div class="input-wrap">
                    <label class="label">주소</label>
                    <div class="input-row">
                        <div class="button-row">
                            <input type="text" name="zip" id="sample2_postcode" placeholder="" class="bs-input">
                            <button type="button" onclick="openPostCode()"
                                class="btn cling-btn btn-outline-dark">우편번호</button>
                        </div>
                        <input type="text" name="addr1" id="sample2_address" placeholder="" class="bs-input">
                        <input type="text" name="addr2" id="sample2_detailAddress" placeholder="" class="bs-input">
                    </div>

                    <label style="margin-top: 20px" for="MBTI">추천 MBTI</label>
                    <select name="mbti" id="MBTI" class="bs-select domain_list">
                        <option value="">선택</option>
                        <?php foreach ($mcodes as $code): ?>
                            <option value="<?= $code['code_no'] ?>"><?= $code['code_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-wrap d-none">
                    <label class="label">방문경로</label>
                    <div class="input-row">
                        <div class="check flex col_3 mo_col_2"
                            style="--mg-t: 10px; --mg-x: 10px; --mo-mg-t: 1rem;--mo-mg-x:0.3333rem">
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree1" class="agree" name="_visit_route" value="네이버">
                                <label for="agree1">네이버 검색</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree2" class="agree" name="_visit_route" value="구글">
                                <label for="agree2">구글 검색</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree3" class="agree" name="_visit_route" value="다음">
                                <label for="agree3">다음 검색</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree4" class="agree" name="_visit_route" value="페이스북">
                                <label for="agree4">페이스북</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree5" class="agree" name="_visit_route" value="인스타그램">
                                <label for="agree5">인스타그램</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree6" class="agree" name="_visit_route" value="배너광고">
                                <label for="agree6">배너광고</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree7" class="agree" name="_visit_route" value="더투어랩블로그">
                                <label for="agree7">더투어랩블로그</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree8" class="agree" name="_visit_route" value="뉴스기사">
                                <label for="agree8">뉴스기사</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree9" class="agree" name="_visit_route" value="지인소개">
                                <label for="agree9">지인소개</label>
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="agree10" class="agree" name="_visit_route" value="기타">
                                <label for="agree10">기타</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-wrap">
                    <label class="label">기타사항</label>
                    <div class="textarea_wrap">
                        <textarea  name="recommender" id="" class="bs-textarea" placeholder=""></textarea>
                    </div>
                </div>
                <div class="input-wrap">
                    <label class="label">마케팅수신동의</label>
                    <div class="input-row">
                        <div class="bs-input-check">
                            <input type="checkbox" name="yn_sms" id="agree_sms" class="agree" checked>
                            <label for="agree_sms">SMS 수신동의</label>
                        </div>
                        <div class="bs-input-check">
                            <input type="checkbox" name="yn_user_email" id="agree_email" class="agree" checked>
                            <label for="agree_email">이메일 수신동의</label>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="btn-wrap">
                <button type="submit" class="btn btn-lg btn-point">다음</button>
            </div>



        </form>


    </div>

    <?php  echo view("member/postcode_inc") ?>
</main>

<script>
    function email_sel(host) {
        if (host == "1") {
            alert('메일서버를 입력하세요.');
            $("#user_email_2_2").val('');
            $("#user_email_2_2").focus();
            return false;
        }
        $("#user_email_2_2").val(host);
    }
</script>

<script>
    $(document).ready(function () {
        $("input:radio[name=find_id]").click(function () {
            var type = $('input[name=find_id]:checked').val();
            if (type == "0") {
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


    $(document).ready(function () {

    })

    var num = 60 * 3;
    var myVar;

    function time() {
        myVar = setInterval(alertFunc, 1000);
    }

    function alertFunc() {
        var min = num / 60;
        min = Math.floor(min);
        var sec = num - (60 * min);

        $('.timer_numb').text(min + ':' + sec);

        if (num == 0) {
            clearInterval(myVar)
        }
        num--;
    }




    var num_em = 60 * 3;
    var myVar_em;

    function time_em() {
        myVar_em = setInterval(alertFunc_em, 1000);
    }

    function alertFunc_em() {
        var min = num_em / 60;
        min = Math.floor(min);
        var sec = num_em - (60 * min);

        $('.timer_numb_email').text(min + ':' + sec);

        if (num_em == 0) {
            clearInterval(myVar_em)
        }
        num_em--;
    }



    function certi_send_1() {

        if ($("#mobile_1_1").val() == "") {
            alert("전화번호를 입력해주세요.");
            $("#mobile_1_1").focus();
            return false;
        }

        if ($("#mobile_1_2").val() == "") {
            alert("전화번호를 입력해주세요.");
            $("#mobile_1_2").focus();
            return false;
        }

        if ($("#mobile_1_3").val() == "") {
            alert("전화번호를 입력해주세요.");
            $("#mobile_1_3").focus();
            return false;
        }

        var tophone = $("#mobile_1_1").val() + "-" + $("#mobile_1_2").val() + "-" + $("#mobile_1_3").val();
        //ifm_chks.location.href="phone_chk_ajax.php?tophone="+tophone;


        $.ajax({
            url: "phone_chk_ajax",
            type: "POST",
            data: "tophone=" + tophone,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            }
            , complete: function (request, status, error) {

            }
            , success: function (response, status, request) {
                response = response.trim();

                if (response == "Y") {
                    console.log(response, '=============')
                    alert("문자가 발송되었습니다.");
                    return false;
                } else {
                    alert(response);
                    $("#certi_num_1").focus();
                    return false;
                }
            }
        });
    }


    function certi_chk_1() {

        var chkNum = $("#certi_num_1").val();
        document.getElementById("hidden_input").value = chkNum;
        if (chkNum == "") {
            alert('인증번호를 입력하세요.');
            $("#certi_num_1").focus();
            return false;
        }

        $.ajax({
            url: "num_chk_ajax",
            type: "POST",
            data: "chkNum=" + chkNum,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            }
            , complete: function (request, status, error) {

            }
            , success: function (response, status, request) {
                response = response.trim();

                if (response == "Y") {
                    $("#cert_yn_1").val("Y");
                    alert("인증되었습니다.");
                    return false;
                } else {
                    alert("인증에 실패하셨습니다.");
                    return false;
                }
            }
        });
    }

    function certi_send_2() {

        if ($("#user_email_2_1").val() == "") {
            alert("이메일을 입력해주세요.");
            $("#user_email_2_1").focus();
            return false;
        }

        if ($("#user_email_2_2").val() == "") {
            alert("이메일을 입력해주세요.");
            $("#user_email_2_2").focus();
            return false;
        }

        var email = $("#user_email_2_1").val() + '@' + $("#user_email_2_2").val();

        $.ajax({
            url: "email_chk_ajax",
            type: "POST",
            data: "email=" + email,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            }
            , complete: function (request, status, error) {

            }
            , success: function (response, status, request) {
                response = response.trim();

                if (response == "Y") {
                    alert("인증문자가 이메일로 발송되었습니다.");
                    return false;
                } else {
                    alert(response);
                    $("#certi_num_2").focus();
                    return false;
                }
            }
        });
    }

    function certi_chk_2() {

        if ($('#certi_num_2').val() == "") {
            alert("인증번호를 입력하세요.");
            $('#certi_num_2').focus();
            return false;
        }

        $.ajax({
            url: "num_chk2_ajax",
            data: "chkNum=" + $('#certi_num_2').val(),
            type: "POST",
            error: function (request, status, error) {
                alert("CODE : " + request.status + "\r\nmessage : " + request.reponseText);
                return false;
            },
            success: function (response, status, request) {
                response = response.trim();
                if (response == "Y") {
                    $("#cert_yn_2").val("Y");
                    alert("인증되었습니다.");
                } else {
                    $("#cert_yn_2").val("N");
                    alert("인증에 실패하셨습니다.");
                }
            }
        });
    }

    function cert_it_1() {
        var frm = document.frm1;

        if (frm.user_name.value.length < 2) {
            alert("이름을 입력해주셔야 합니다.");
            frm.user_name.focus();
            return;
        }
        if (frm.user_mobile_1.value == "") {
            frm.user_mobile_1.focus();
            alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
            return;
        }
        if (frm.user_mobile_2.value == "") {
            frm.user_mobile_2.focus();
            alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
            return;
        }
        if (frm.user_mobile_3.value == "") {
            frm.user_mobile_3.focus();
            alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
            return;
        }



        var mobile = frm.user_mobile_1.value + frm.user_mobile_2.value + frm.user_mobile_3.value;
        //alert(mobile);

        hiddenFrame22.location.href = "cert1.ajax.php?cert_num=" + frm.cert_num_1.value + "&mobile=" + mobile +
            "&user_name=" + frm.user_name.value + "&gubun=A1";
    }

    function cert_it_2() {
        var frm = document.frm1;


        if (frm.user_name_2.value.length < 2) {
            alert("이름을 입력해주셔야 합니다.");
            frm.user_name_2.focus();
            return;
        }

        var user_email = frm.user_email.value + "@" + frm.user_email2.value;

        if (mail_chk(user_email) == false) {
            frm.user_email.focus();
            alert("이메일을 바르게 입력해주셔야 합니다.");
            return;
        }
        $.ajax({
            url: "cert2.ajax.php",
            type: "POST",
            data: "user_email=" + user_email + "&user_name=" + frm.user_name_2.value + "&gubun=A2",
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            complete: function (request, status, error) {

            },
            success: function (response, status, request) {

                if (response == "OK") {
                    alert("인증번호가 발송되었습니다.");
                    frm.cert_yn_2.value = "Y";
                    time_em();
                } else if (response == "NI") {
                    frm.cert_yn_2.value = "N";
                    alert("일치하는 정보가 없습니다.");
                } else {
                    frm.cert_yn_2.value = "N";
                    alert(response);
                }
            }
        });


    }


    // 휴대전화로 찾기 최종 확인

    function confirm_it_1() {
        var frm = document.frm1;

        var gubun = "";
        var user_name = "";


        if ($("#find_id_phone").prop("checked") == true) {
            gubun = "A1";
            user_name = frm.user_name.value;
            if (frm.user_name.value.length < 2) {
                alert("이름을 입력해주셔야 합니다.");
                frm.user_name.focus();
                return;
            }
            if (frm.cert_yn_1.value == "N") {
                alert("인증번호를 발급받으셔야 합니다.");
                return;
            }
            if (frm.mobile_1.value == "") {
                frm.mobile_1.focus();
                alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
                return;
            }
            if (frm.mobile_2.value == "") {
                frm.mobile_2.focus();
                alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
                return;
            }
            if (frm.mobile_3.value == "") {
                frm.mobile_3.focus();
                alert("휴대전화번호를 바르게 입력해주셔야 합니다.");
                return;
            }



            var mobile = frm.mobile_1.value + frm.mobile_2.value + frm.mobile_3.value;
            hiddenFrame22.location.href = "find_id_ok.php?mobile=" + mobile + "&user_name=" + frm.user_name.value +
                "&gubun=" + gubun;

        } else {
            gubun = "A2";

            user_name = frm.user_name_2.value;
            if (frm.user_name_2.value.length < 2) {
                alert("이름을 입력해주셔야 합니다.");
                frm.user_name_2.focus();
                return;
            }
            if (frm.cert_yn_2.value == "N") {
                alert("인증번호를 발급받으셔야 합니다.");
                return;
            }

            var user_email = frm.user_email.value + "@" + frm.user_email2.value;

            if (mail_chk(user_email) == false) {
                frm.user_email.focus();
                alert("이메일을 바르게 입력해주셔야 합니다.");
                return;
            }

            $.ajax({
                url: "find_id_email2.php",
                type: "POST",
                data: "user_email=" + user_email + "&user_name=" + frm
                    .user_name_2.value + "&gubun=" + gubun,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                },
                complete: function (request, status, error) {

                },
                success: function (response, status, request) {

                    if (response == "OK") {
                        alert("가입하신 이메일로 아이디가 발송되었습니다.");
                        location.reload();
                    } else if (response == "NI") {
                        alert("일치하는 정보가 없습니다.");
                    } else if (response == "NC") {
                        alert("인증번호가 일치하지 않습니다.");
                    } else {
                        alert(response);
                    }
                }
            });

        }

        return;
    }

    $('.find_radio input[type="radio"]').on('change', function () {
        var idx = $(this).parent().index();
        $('.login_find .login_form').removeClass('on');
        $('.login_find .login_form').eq(idx).addClass('on');
    })

    function fn_submit() {
        var frm = document.reg_mem_fm;

        if ($("#cert_type").val() == "mobile") {

            if ($("#mobile_1_1").val() == "") {
                alert("휴대폰 입력해주세요.");
                $("#mobile_1_1").focus();
                return false;
            }

            if ($("#mobile_1_2").val() == "") {
                alert("휴대폰 입력해주세요.");
                $("#mobile_1_2").focus();
                return false;
            }

            if ($("#mobile_1_3").val() == "") {
                alert("휴대폰 입력해주세요.");
                $("#mobile_1_3").focus();
                return false;
            }

            if ($("#cert_yn_1").val() != "Y") {
                alert("휴대폰 인증을 해주세요.");
                $("#certi_num_1").focus();
                return false;
            }

            var mobile = $("#mobile_1_1").val() + '-' + $("#mobile_1_2").val() + '-' + $("#mobile_1_3").val();

            if ($("#user_email_1_1").val() == "") {
                alert("이메일을 입력해 주세요.");
                $("#user_email_1_1").focus();
                return false;
            }

            if ($("#user_email_1_2").val() == "") {
                alert("이메일을 입력해 주세요.");
                $("#user_email_1_2").focus();
                return false;
            }

            var email = $("#user_email_1_1").val() + '@' + $("#user_email_1_2").val();

            $("#user_mobile").val(mobile);
            $("#user_email").val(email);

        } else {
            if ($("#cert_yn_2").val() != "Y") {
                alert("이메일 인증을 해주세요.");
                return false;
            }

            if ($("#mobile_2").val() == "") {
                alert("전화번호를 입력해주세요.");
                $("#mobile_2").focus();
                return false;
            }

            if ($("#mobile_2_1").val() == "") {
                alert("전화번호를 입력해주세요.");
                $("#mobile_2_1").focus();
                return false;
            }

            if ($("#mobile_2_2").val() == "") {
                alert("전화번호를 입력해주세요.");
                $("#mobile_2_2").focus();
                return false;
            }

            if ($("#mobile_2_3").val() == "") {
                alert("전화번호를 입력해주세요.");
                $("#mobile_2_3").focus();
                return false;
            }

            var mobile = $("#mobile_2_1").val() + '-' + $("#mobile_2_2").val() + '-' + $("#mobile_2_3").val();

            var email = $("#user_email_2_1").val() + '@' + $("#user_email_2_2").val();

            $("#user_mobile").val(mobile);
            $("#user_email").val(email);
        }
        var user_email_yn = "";
        if ($("#_user_email_yn").is(":checked")) {
            user_email_yn = "Y";
        }
        $("#user_email_yn").val(user_email_yn);


        if ($("#user_email11").val() == "") {
            alert("이메일을 입력해주세요.");
            $("#user_email11").focus();
            return false;
        }

        if ($("#user_email12").val() == "") {
            alert("이메일을 입력해주세요.");
            $("#user_email12").focus();
            return false;
        }

        if (frm.user_id.value == "") {
            alert("아이디를 입력해주세요.");
            frm.user_id.focus();
            return false;
        }

        if ($("#gubun").val() == "" || $("#sns_key").val() == "") {
            if (frm.id_chk.value == "") {
                alert("아이디 중복체크를 해주세요.");
                $("#user_id").focus();
                return false;
            }

            if (frm.user_pw.value == "") {
                alert("비밀번호를 입력해주세요.");
                frm.user_pw.focus();
                return false;
            }

            if (frm.user_pw2.value == "") {
                alert("비밀번호를 입력해주세요.");
                frm.user_pw2.focus();
                return false;
            }

            // 문자 길이
            var pwnum = frm.user_pw.value;
            if (pwnum.length < 6 || pwnum.length > 15) {
                alert("비밀번호는 6 ~ 15자 이내로 작성하셔야합니다.");
                return false;
            }

            if (frm.user_pw.value != frm.user_pw2.value) {
                alert("비밀번호가 일치하지 않습니다.");
                frm.user_pw.focus();
                $("#pass_n").show();
                return false;
            }
        }

        if (frm.user_name.value == "") {
            alert("이름을 입력해주세요.");
            frm.user_name.focus();
            return false;
        }

        if (frm.birth_day.value == "") {
            alert("생년월일을 입력해주세요.");
            frm.birth_day.focus();
            return false;
        }
        // if (userInputCaptcha !== captchaValue) {
        //     alert("보안문자 일치지않습니다.");
        //     $("#captcha_input").focus();
        //     reloadCaptcha();
        //     return false;
        // }

        // var work_field = "";
        // 	$("input[name=yn_sms]:checked").each(function() {
        // 	   work_field += $(this).val() +',';
        // 	})


        // 	$("#sms_yn").val(work_field);
        var work_field = $("input[name=yn_sms]:checked").length > 0 ? 'Y' : 'N';
        $("#sms_yn").val(work_field);

        var work_fields = $("input[name=yn_user_email]:checked").length > 0 ? 'Y' : 'N';
        $("#user_email_yn").val(work_fields);


        var visit_route = $('input:checkbox[name="_visit_route"]').filter(':checked').map(function () {
            return $(this).val();
        }).get().join(', ');

        $("#visit_route").val(visit_route);

        /*
                if( frm.user_addr1.value == ""){
                    alert("주소를 입력해주세요.");
                    frm.user_addr1.focus();
                    return false;
                }
        */
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
            }
           },
           error: function (data) {
               console.log(data);
               alert(data.responseJSON.message || "error");
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
        /*
            var min = 1;
            var sec = min * 60;
            var minCon, secCon;
            var conTime = setInterval(function() {

                minCon = Math.floor(sec / 60);
                secCon = sec % 60;

                if(secCon < 10) {
                    secCon = '0' + secCon;
                }

                if(sec == 0) {
                    clearInterval(conTime);
                    console.log("end test")
                    certi_chkEnd()
                }

                $('.certi_time span').text(minCon + ":" + secCon);
                sec--

            },1000)
        */

    });

    function chk_id() {
        var tmp_id = $("#user_id").val();
        tmp_id = tmp_id.trim();

        if (tmp_id == "") {
            $("#user_id").focus();
            alert("아이디를 입력해주세요.");
        } else {


            $.ajax({
                url: "/member/id_chk_ajax",
                type: "GET",
                data: "userid=" + tmp_id,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , complete: function (request, status, error) {

                }
                , success: function (response, status, request) {
                    response = response.trim();
                    if (parseInt(response) > 0) {
                        alert("이미 사용중인 아이디입니다.");
                        $("#user_id").focus();
                        return false;
                    } else {
                        $("#id_chk").val("Y");
                        $("#user_id").val(tmp_id);
                        $("#id_yes").show();
                        $("#id_no").hide();
                        alert("사용가능한 아이디입니다.");
                    }
                }
            });



        }
    }
</script>
<?php $this->endSection(); ?>