<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<!-- 구글로그인버튼 -->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<script src="https://accounts.google.com/gsi/client" async defer></script>
<!-- 구글로그인버튼 -->

<!-- <style>
  #container.sub {
    padding: 4.5rem 0 9.3rem !important;
  }
</style> -->

<?php if (session()->getFlashdata('error')) : ?>
    <script>
        alert('<?= session()->getFlashdata('error') ?>');
    </script>
<?php endif; ?>

<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript" src="/js/kakao.js"></script>

<main id="container" class="sub login member pt100">
    <div class="inner_620">

        <div class="flex_c_c logo_box">
            <picture>
                <source media="(max-width: 768px)" srcset="/images/sub/logo_w.png">
                <img src="/images/sub/logo_w.png" alt="더투어랩 로고">
            </picture>
        </div>
        <!-- <div class="alert_box">
            <p>기존 회원분들은 비밀번호 찾기로 비밀번호를 재발급 받으셔야 합니다. <br>재발급후 로그인이 안되시는 분들은 고객센터로 연락부탁드립니다.</p>
        </div> -->
        <div class="login_tab">
            <button type="button" class="on">회원 로그인</button>
            <button type="button">비회원 예약확인</button>
        </div>

        <section class="login_cont">

            <!-- 회원 -->
            <div class="login_box on">
                <form action="login_check" method="post" name="loginForm" id="loginFrm" class="login_form01">
                    <input type="hidden" name="returnUrl" id="returnUrl" value="<?= session('_ci_previous_url') ?>">
                    <input type="hidden" name="mode" id="mode" value="true"/>
                    <input type="hidden" name="sType" id="sType" value="login">
                    <input type="hidden" name="sns_key" id="sns_key" value=""/>
                    <input type="hidden" name="user_name" id="user_name" value=""/>
                    <input type="hidden" name="userEmail" id="userEmail" value=""/>
                    <input type="hidden" name="gubun" id="gubun" value=""/>

                    <div class="input-group">
                        <div class="input-row">
                            <input type="text" name="user_id" class="bs-input" onkeyup="press_it()"
                                   placeholder="아이디를 입력하세요." value="<?= $_COOKIE['c_userId'] ?>">
                        </div>
                        <div class="input-row">
                            <input type="password" name="user_pw" class="bs-input" onkeyup="press_it(event)"
                                   placeholder="비밀번호를 입력하세요.">
                        </div>
                        <div class="input-row save_id flex_b_c">
                            <div class="bs-input-check">
                                <input type="checkbox" id="save_id" name="save_id"
                                       value="Y" <?php if ($_COOKIE['c_userId'] != "") {
                                    echo "checked";
                                } ?>>
                                <label for="save_id"> 아이디 저장</label>
                            </div>
                            <div class="btn_link">
                                <a href="/member/login_find_id">아이디/비밀번호 찾기</a>
                                <a href="/member/join_choice"><span>회원가입</span></a>
                            </div><!-- .btn_link -->
                        </div>


                    </div>
                    <div class="btn-wrap">
                        <button type="button" class="btn btn-lg btn-point" onclick="login_it();">로그인</button>
                    </div>
                </form>

                <div class="sns_login_ttl">
                    <span>SNS 로그인</span>
                </div>

                <?php
                // 구글
                $client_id = env('GOOGLE_LOGIN_CLIENT_ID');
                //$redirection_url = ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . env("GOOGLE_REDIRECT_URI");
                // $previousUrl = session('_ci_previous_url') ?? '/'; // 기본값으로 '/' 사용
				$previousUrl = env("GOOGLE_REDIRECT_URI");
				$redirection_url = $previousUrl;
                $scope = urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email');
                $response_type = "code";

                $_url  = "https://accounts.google.com/o/oauth2/v2/auth";
                $_url .= "?client_id=" . $client_id;
                $_url .= "&redirect_uri=" . urlencode($redirection_url);
                $_url .= "&scope=" . $scope;
                $_url .= "&response_type=" . $response_type;
                $_url .= "&state=OK";
				
                // 네이버 로그인 접근토큰 요청 예제
                $client_id   = "thHkJbn94PdAfE38YW5r";
                // $client_id   = "ikuc9S8jLfOESEsjf5vR";
                $redirectURI = "https://thetourlab.com/naver/callback";
                //$redirectURI = $previousUrl;
                $state       = md5(microtime() . mt_rand()) . "log";
                session()->set('naver_state', $state);
                $apiURL      = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=" . $client_id . "&redirect_uri=" . $redirectURI . "&state=" . $state;
                ?>

                <script>
                    //네이버 로그인
                    function fnNaverLogin() {
                        location.href = '<?php echo $apiURL ?>';
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
                            onclick="location.href='<?= $_url ?>'">
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
                                <input type="tel" name="order_user_mobile2" id="order_user_mobile2" class="bs-input">
                                <span>-</span>
                                <input type="tel" name="order_user_mobile3" id="order_user_mobile3" class="bs-input">
                            </div>
                        </div>
                </div>
                <div class="btn-wrap">
                    <button type="button" class="btn btn-lg btn-point tab_2" onclick="go_result();">예약확인</button>
                </div>
                </form>

                <form id="check_pass_form" name="check_pass_form" method="post">
                    <input type="hidden" value="" name="check_pass" id="check_pass_input">
                </form>
            </div>
        </section>
    </div>
</main>


<script>
    function go_result() {
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
            url = "/ajax/order_inq";
        } else if (order_no.startsWith("R")) {
            url = "/ajax/id_checking";
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

    function login_it() {
        if (loginForm.user_id.value == false) {
            loginForm.user_id.focus();
            alert("아이디을 바르게 입력하셔야 합니다.");
            return;
        }

        if (loginForm.user_pw.value == "") {
            loginForm.user_pw.focus();
            alert("패스워드를 입력하셔야 합니다.");
            return;
        }

        $("#loginFrm").submit();
    }

    function press_it() {
        if (event.keyCode == 13) {
            login_it();
        }
    }
</script>


<script>

    // var googleUser = {};
    // var startApp = function() {
    //     google.accounts.id.initialize({
    //         client_id: '201811301708-psla2uvr74i6mrt01a45379omt5inbdn.apps.googleusercontent.com',
    //         cookiepolicy: 'single_host_origin',
    //         callback:attachSignin
    //         // Request scopes in addition to 'profile' and 'email'
    //         //scope: 'additional_scope'
    //     });
    // };

    // function attachSignin(element) {
    //     console.log(element.id);
    //     auth2.attachClickHandler(element, {},
    //         function(googleUser) {
    //             // document.getElementById('name').innerText = "Signed in: " + googleUser.getBasicProfile().getName();
    //             const userId = googleUser.getBasicProfile().getId();
    //             console.log(userId);
    //             const userName = googleUser.getBasicProfile().getName();
    //             const userEmail = googleUser.getBasicProfile().getEmail();
    //             let userArr = [
    //                 {key:"userKey", val: userId}, 
    //                 {key:"userName", val: userName}, 
    //                 {key:"userEmail", val: userEmail},
    //                 {key:"gubun", val: "google"}
    //             ]
    //             const frm   = document.createElement("form");
    //             frm.method  = 'POST';
    //             frm.action  = "/include/google.php";
    //             for(let i=0; i < userArr.length; i++){
    //                 let input   = document.createElement("input");
    //                 input.name  = userArr[i].key;
    //                 input.value = userArr[i].val;
    //                 input.type  = "hidden";
    //                 frm.appendChild(input);
    //             }
    //             document.body.appendChild(frm);
    //             frm.submit();
    //         }, function(error) {
    //         console.log(JSON.stringify(error, undefined, 2));
    //         });
    // }

    // startApp();
</script>
<?php $this->endSection(); ?>
