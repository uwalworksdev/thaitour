<style>
    .popup_ {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: rgba(0, 0, 0, 0.2);
        display: none;
        align-items: center;
        justify-content: center;
    }

    .popup_.show_ {
        display: flex;
    }

    .popup_area_ {
        height: auto;
        max-height: 80vh;
        overflow: auto;
        background-color: #FFFFFF;
        width: 100%;
        min-width: 800px;
        max-width: 80vw;
        padding: 10px 40px 30px;
        font-size: 14px;
    }

    .popup_top_ {
        width: 100%;
        height: 50px;
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 18px;
        font-weight: bold;
        border-bottom: 1px solid #dbdbdb;
    }

    .popup_content_ {
        margin-top: 20px;
    }

    .popup_bottom_ {
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        padding-top: 20px;
        width: 100%;
        border-top: 1px solid #dbdbdb;
    }

    .popup_bottom_ button {
        display: inline-block;
        width: 100px;
        height: 40px;
        border: 1px solid rgb(204, 204, 204);
    }
</style>

<div class="popup_" id="popupLogin_">
    <div class="popup_area_">
        <div class="popup_top_">
            <p>
                로그인
            </p>
            <p>
                <button type="button" class="btn_close_"
                        onclick="showOrHideLoginItem();">X
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
                    <div class="login_tab">
                        <button type="button" class="on">회원 로그인</button>
                        <button type="button">비회원 예약확인</button>
                    </div>

                    <section class="login_cont">

                        <!-- 회원 -->
                        <div class="login_box on">
                            <form action="/member/login_check" method="post" name="loginForm2" id="loginFrm2"
                                  class="login_form01">
                                <input type="hidden" name="returnUrl" value="">
                                <input type="hidden" name="mode" id="mode" value="true">
                                <input type="hidden" name="sType" id="sType" value="login">
                                <input type="hidden" name="sns_key" id="sns_key" value="">
                                <input type="hidden" name="user_name" id="user_name" value="">
                                <input type="hidden" name="userEmail" id="userEmail" value="">
                                <input type="hidden" name="gubun" id="gubun" value="">

                                <div class="input-group">
                                    <div class="input-row">
                                        <input type="text" name="user_id" class="bs-input" onkeyup="press_it2()"
                                               placeholder="아이디를 입력하세요." value="">
                                    </div>
                                    <div class="input-row">
                                        <input type="password" name="user_pw" class="bs-input" onkeyup="press_it2(event)"
                                               placeholder="비밀번호를 입력하세요.">
                                    </div>
                                    <div class="input-row save_id flex_b_c">
                                        <div class="bs-input-check">
                                            <input type="checkbox" id="save_id" name="save_id" value="Y">
                                            <label for="save_id"> 아이디 저장</label>
                                        </div>
                                        <div class="btn_link">
                                            <a href="/member/login_find_id">아이디/비밀번호 찾기</a>
                                            <a href="/member/join_choice"><span>회원가입</span></a>
                                        </div><!-- .btn_link -->
                                    </div>


                                </div>
                                <div class="btn-wrap">
                                    <button type="button" class="btn btn-lg btn-point" onclick="login_it2();">로그인
                                    </button>
                                </div>
                            </form>

                            <div class="sns_login_ttl">
                                <span>SNS 로그인</span>
                            </div>

                            <script>
                                //네이버 로그인
                                function fnNaverLogin() {
                                    location.href = 'https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fmember%2Flogin_naver&state=b4ed7a3e894112a5e45c4befa418c6edlog';
                                }
                            </script>

                            <div class="another_login">
                                <button type="button" class="another_btn naver" onclick="fnNaverLogin();">
                                    네이버로그인
                                </button>
                                <button type="button" class="another_btn kakao" onclick="loginWithKakao()">
                                    카카오로그인
                                </button>
                                <button type="button" id="customBtn" class="another_btn google"
                                        onclick="location.href='https://accounts.google.com/o/oauth2/v2/auth?client_id=453994188031-gfbrsmekigdkn78g2r4voi28rrns7nr1.apps.googleusercontent.com&amp;redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fmember%2Fgoogle_login&amp;scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&amp;response_type=code&amp;state=OK'">
                                    구글로그인
                                </button>
                            </div>

                        </div>
                        <!-- // 회원 // -->

                        <!-- 비회원 -->
                        <div class="login_box">
                            <div class="input-group">


                                <form action="/mypage/trabel_goods_non.php" id="resulrForm" name="frm2" method="post"
                                      class="login_form02">
                                    <div class="input-row">
                                        <input type="text" name="order_no" id="order_no" class="bs-input"
                                               placeholder="예약번호를 입력하세요.">
                                    </div>
                                    <div class="input-row">
                                        <input type="text" name="order_user_name" id="order_user_name" class="bs-input"
                                               placeholder="이름을 입력하세요.">
                                    </div>
                                    <div class="input-row">
                                        <div class="tel_row">
                                            <select name="order_user_mobile1" id="order_user_mobile1" class="bs-select">
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
                            <div class="btn-wrap">
                                <button type="button" class="btn btn-lg btn-point tab_2" onclick="go_result2();">예약확인
                                </button>
                            </div>


                            <form id="check_pass_form" name="check_pass_form" method="post">
                                <input type="hidden" value="" name="check_pass" id="check_pass_input">
                            </form>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>
</div>

<script>
    function showOrHideLoginItem() {
        $("#popupLogin_").toggleClass('show_');
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
</script>