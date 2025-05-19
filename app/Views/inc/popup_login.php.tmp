<style>

</style>

<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript" src="/js/kakao.js"></script>

<div class="popup_" id="popupLogin_">
    <div class="popup_area_">
        <div class="popup_top_">
            <p>
                로그인 또는 회원가입
            </p>
            <p>
                <button type="button" class="btn_close_"
                        onclick="showOrHideLoginItem();">
                    <img src="/images/ico/close_icon_popup.png" alt="" style="width: 20px; height: 20px">
                </button>
            </p>
        </div>
        <div class="popup_content_">
            <main class="sub login member pt100">
                <div class="inner_620">

                    <div class="flex_c_c logo_box">
                        <picture>
                            <source media="(max-width: 768px)" srcset="/images/sub/logo_w.png">
                            <img src="/images/sub/logo_w.png" alt="더투어랩 로고">
                        </picture>
                    </div>
                    <!--                    <div class="login_tab">-->
                    <!--                        <button type="button" class="on">회원 로그인</button>-->
                    <!--                        <button type="button">비회원 예약확인</button>-->
                    <!--                    </div>-->

                    <section class="login_cont">

                        <!-- 회원 -->
                        <div class="login_box on">
                            <form action="/member/login_check" method="post" name="loginForm2" id="loginFrm2"
                                  class="login_form01">
                                <input type="hidden" name="mode" id="mode" value="true">
                                <input type="hidden" name="sType" id="sType" value="login">
                                <input type="hidden" name="sns_key" id="sns_key" value="">
                                <input type="hidden" name="user_name" id="user_name" value="">
                                <input type="hidden" name="userEmail" id="userEmail" value="">
                                <input type="hidden" name="gubun" id="gubun" value="">
                                <input type="hidden" name="returnUrl" id="returnUrl" value="">

                                <div class="input-group show_" id="inputMainGroup">
                                    <div class="input-row">
                                        <input type="text" name="user_id" class="bs-input" onkeyup="press_it2()"
                                               placeholder="아이디를 입력하세요." value="">
                                    </div>
                                    <div class="input-row">
                                        <input type="password" name="user_pw" class="bs-input"
                                               onkeyup="press_it2(event)"
                                               placeholder="비밀번호를 입력하세요.">
                                    </div>
                                    <div class="input-row save_id flex_b_c">
                                        <div class="bs-input-check">
                                        </div>
                                        <div class="btn_link">
                                            <a href="/member/login_find_id">아이디/비밀번호 찾기</a>
                                            <a href="/member/join_choice"><span>회원가입</span></a>
                                        </div><!-- .btn_link -->
                                    </div>

                                </div>


                                <div class="btn-wrap">
                                    <button type="button" id="btnLoginMain" class="show_ btn btn-lg btn-point"
                                            onclick="login_it2();">
                                        로그인
                                    </button>

                                    <button type="button" id="btnLoginSupMain" class="btn btn-lg btn-point"
                                            onclick="openLogin();">
                                        로그인
                                    </button>

                                </div>

                                <div class="item_login_" style="margin-top: 20px; margin-bottom: 20px"
                                     id="loginNoAreaMember">
                                    <!--                                <div class="box_login">-->
                                    <!--                                    <h4>비회원 예약 조회 및 로그인</h4>-->
                                    <!--                                    <form name="frmLogin_nomember" method="post" action="#">-->
                                    <!--                                        <div class="input_group_">-->
                                    <!--                                            <label class="label_inp_">이메일 주소</label>-->
                                    <!--                                            <div class="layout_input_">-->
                                    <!--                                                <input type="text" name="member/email" data-validate="required,email"-->
                                    <!--                                                       title="예약시 입력한 이메일 주소" placeholder="예약시 입력한 이메일 주소를 입력해 주세요">-->
                                    <!--                                            </div>-->
                                    <!--                                            <label class="label_inp_">예약번호</label>-->
                                    <!--                                            <div class="layout_input_">-->
                                    <!--                                                <input type="text" name="grpno" id="grpno" maxlength="50"-->
                                    <!--                                                       data-validate="required,minlength[4]" title="9자리 숫자"-->
                                    <!--                                                       placeholder="9자리 숫자로 된 예약번호를 입력해 주세요">-->
                                    <!--                                            </div>-->
                                    <!--                                        </div>-->
                                    <!--                                        <p>※ 비회원 로그인 후 추가 예약이 가능해요.</p>-->
                                    <!--                                        <div class="btn_login">-->
                                    <!--                                            <button type="button" class="btnNoLogin" onclick="login_nomember_login();">-->
                                    <!--                                                로그인-->
                                    <!--                                            </button>-->
                                    <!--                                        </div>-->
                                    <!--                                    </form>-->
                                    <!--                                </div>-->
                                    <!---->
                                    <!--                                <div class="nomember_wrap">-->
                                    <!--                                    <p>비회원은 포인트 적립, 크레이지 세일 예약, 이벤트 참여, 쿠폰 사용이 불가능해요.</p>-->
                                    <!--                                    <a href="#" onclick="submitNoMember();" class="btn_nomember">비회원으로 예약하기</a>-->
                                    <!--                                </div>-->
                                    <div class="input-group">
                                        <form action="/mypage/trabel_goods_non.php" id="resulrForm" name="frm2"
                                              method="post" class="login_form02">
                                            <div class="input-row">
                                                <input type="text" name="order_no" id="order_no" class="bs-input"
                                                       placeholder="예약번호를 입력하세요.">
                                            </div>
                                            <div class="input-row">
                                                <input type="text" name="order_user_name" id="order_user_name"
                                                       class="bs-input" placeholder="이름을 입력하세요.">
                                            </div>
                                            <div class="input-row">
                                                <div class="tel_row">
                                                    <select name="order_user_mobile1" id="order_user_mobile1"
                                                            class="bs-select">
                                                        <option value="010">010</option>
                                                        <option value="011">011</option>
                                                        <option value="016">016</option>
                                                        <option value="017">017</option>
                                                        <option value="018">018</option>
                                                        <option value="019">019</option>
                                                    </select>
                                                    <span>-</span>
                                                    <input type="tel" name="order_user_mobile2" id="order_user_mobile2"
                                                           class="bs-input">
                                                    <span>-</span>
                                                    <input type="tel" name="order_user_mobile3" id="order_user_mobile3"
                                                           class="bs-input">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <form id="check_pass_form" name="check_pass_form" method="post">
                                        <input type="hidden" value="" name="check_pass" id="check_pass_input">
                                    </form>
                                </div>

                                <div class="btn-wrap">
                                    <button type="button" class="show_ sup_button" onclick="openSupLogin(this);"
                                            id="btnLogin01">
                                        비회원 예약확인
                                    </button>

                                    <button type="button" class="btn btn-lg btn-point" id="btnLoginMain01"
                                            onclick="go_result2();">
                                        비회원 예약확인
                                    </button>

                                    <button type="button" class="sup_button" id="btnLogin02">
                                        비회원 예약하기
                                    </button>
                                </div>
                            </form>

                            <div class="sns_login_ttl">
                                <span>SNS 로그인</span>
                            </div>

                            <script>
                                // jQuery click event
                                $("#btnLogin02").click(function () {

                                    $.ajax({
                                        url: "/ajax/memberSession",
                                        type: "POST",
                                        data: {},
                                        dataType: "json",
                                        success: function (res) {
                                            var message = res.message;
                                            //alert(message);
                                            location.reload();
                                        },
                                        error: function (xhr, status, error) {
                                            console.error(xhr.responseText); // 서버 응답 내용 확인
                                            alert('Error: ' + error);
                                        }
                                    });
                                });
                            </script>
                            <?php
                                // 구글
                                $client_id = env('GOOGLE_LOGIN_CLIENT_ID');
                                $redirection_url = ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . env("GOOGLE_REDIRECT_URI");
                                $scope = urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email');
                                $response_type = "code";

                                $_url = "https://accounts.google.com/o/oauth2/v2/auth";
                                $_url .= "?client_id=" . $client_id;
                                $_url .= "&redirect_uri=" . urlencode($redirection_url);
                                $_url .= "&scope=" . $scope;
                                $_url .= "&response_type=" . $response_type;
                                $_url .= "&state=OK";
								
								// 네이버 로그인 접근토큰 요청 예제
								$client_id = env('NAVER_CLIENT_ID'); // 네이버 클라이언트 ID
								$redirectURI = urlencode("https://" . $_SERVER["HTTP_HOST"] . "/naver/callback"); // 동적으로 리디렉션 URL 생성
								$state = md5(microtime() . mt_rand()) . "log";
								$_SESSION['naver_state'] = $state; // 세션에 상태 저장

								$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=" . $client_id . "&redirect_uri=" . $redirectURI . "&state=" . $state;
                            ?>
                            <script>
                                //네이버 로그인
                                function fnNaverLogin2() {
                                    location.href = '<?=$apiURL?>';
                                }
                            </script>

                            <div class="another_login">
                                <button type="button" class="another_btn naver" onclick="fnNaverLogin2();">
                                    네이버로그인
                                </button>
                                <button type="button" class="another_btn kakao" onclick="loginWithKakao()">
                                    카카오로그인
                                </button>
                                <button type="button" id="customBtn" class="another_btn google"
                                        onclick="location.href='<?=$_url?>'">
                                    구글로그인
                                </button>
                            </div>

                        </div>
                        <!-- // 회원 // -->
                    </section>
                </div>
            </main>
        </div>
    </div>
</div>

<script>
    function showOrHideLoginItem() {
        $("#popupLogin_").toggleClass('show_');
        let current_url = window.location.href;
        $('#returnUrl').val(current_url)
    }

    function openLogin() {
        handleLogin();
    }

    function handleLogin() {
        $("#inputMainGroup").addClass('show_');
        $("#btnLoginMain").addClass('show_');
        $("#btnLogin01").addClass('show_');
        $("#loginNoAreaMember").removeClass('show_');
        $("#btnLoginSupMain").removeClass('show_');
        $("#btnLoginMain01").removeClass('show_');
    }

    function handleSupLogin() {
        $("#inputMainGroup").removeClass('show_');
        $("#btnLoginMain").removeClass('show_');
        $("#btnLogin01").removeClass('show_');
        $("#loginNoAreaMember").addClass('show_');
        $("#btnLoginSupMain").addClass('show_');
        $("#btnLoginMain01").addClass('show_');
    }

    function openSupLogin(el) {
        let loginNoAreaMember = $("#loginNoAreaMember");
        if (loginNoAreaMember.hasClass('show_')) {
            handleLogin();
        } else {
            handleSupLogin();
        }
    }

    function submitNoMember() {

    }

    function login_nomember_login() {

    }

    function login_it2() {
        if (loginForm2.user_id.value == false) {
            loginForm2.user_id.focus();
            alert("아이디을 바르게 입력하셔야 합니다.");
            return;
        }

        if (loginForm2.user_pw.value == "") {
            loginForm2.user_pw.focus();
            alert("패스워드를 입력하셔야 합니다.");
            return;
        }

        $("#loginFrm2").submit();
    }

    function press_it2() {
        if (event.keyCode == 13) {
            login_it2();
        }
    }

    function go_result2() {
        if ($("#order_no").val() == "") {
            $("#order_no").focus();
            alert("예약번호를 입력하셔야 합니다.");
            return;
        }

        if ($("#order_user_name").val() == "") {
            $("#order_user_name").focus();
            alert("이름을 입력하셔야 합니다.");
            return;
        }

        if ($("#order_user_mobile2").val() == "") {
            $("#order_user_mobile2").focus();
            alert("전화번호를 입력하셔야 합니다.");
            return;
        }

        if ($("#order_user_mobile3").val() == "") {
            $("#order_user_mobile3").focus();
            alert("전화번호를 입력하셔야 합니다.");
            return;
        }

        var order_no = $("#order_no").val();
        var url = "";

        // Điều kiện để kiểm tra tiền tố và chọn file PHP phù hợp
        if (order_no.startsWith("S")) {
            url = "/ajax/ajax.order_inq.php";
        } else if (order_no.startsWith("R")) {
            url = "/ajax/id_checking.php";
        } else {
            alert("예약번호가 일치하지 않습니다.");
            return;
        }

        var message = "";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                "order_no": $("#order_no").val(),
                "order_user_name": $("#order_user_name").val(),
                "order_user_mobile1": $("#order_user_mobile1").val(),
                "order_user_mobile2": $("#order_user_mobile2").val(),
                "order_user_mobile3": $("#order_user_mobile3").val(),
                "pass_check": "Y",
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data, textStatus) {
                message = data.message;
                if (message == "0") {
                    alert('예약정보를 확인하세요');
                    $("#order_no").focus();

                } else {
                    if (order_no.startsWith("S")) {
                        $("#resulrForm").submit();
                    } else if (order_no.startsWith("R")) {
                        $("#check_pass_form").attr('action', '/mypage/custom_travel_view?idx=' + data.idx)
                        $("#check_pass_input").val('Y')
                        $("#check_pass_form").submit()
                    } else {
                        alert("예약번호가 일치하지 않습니다.");
                    }

                }
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });

    }
</script>