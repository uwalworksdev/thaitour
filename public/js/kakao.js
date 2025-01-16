Kakao.init(kakao_key); // JavaScript 키
Kakao.isInitialized();


function loginWithKakao() {
    Kakao.Auth.login({
        success: function (response) {
            Kakao.API.request({
                url: '/v2/user/me',
                success: function (res) {

                    var tmp_date = JSON.stringify(res);
                    var list = $.parseJSON(tmp_date);
                    var gubun = "kakao";
                    var sns_key = list['id'];
                    var email      = list['kakao_account']['email'];
                    // alert('email- '+email);
                    var name = list['properties']?.['nickname'] ?? null;
                    var mode = document.getElementById("mode").value;
                    $.ajax({
                        url: "/member/sns_kakao_login",
                        type: "POST",
                        data: "sns_key=" + sns_key + "&mode=" + mode,
                        error: function (request, status, error) {
                            //통신 에러 발생시 처리
                            alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                            $("#ajax_loader").addClass("display-none");
                        }
                        , complete: function (request, status, error) {

                            //				$("#ajax_loader").addClass("display-none");
                        }
                        , success: function (response, status, request) {
alert(mode);
                            //회원가입 프로세스 절차 
                            if (mode == "false") {
                                if (response.trim() == "2") {
                                    alert("이미 가입된 회원입니다.");
                                    location.href = "/member/login_form";
                                } else {
                                    document.getElementById("sns_key").value = sns_key;
                                    document.getElementById("user_name").value = name;
                                    document.getElementById("userEmail").value = email;
                                    document.getElementById("gubun").value = 'kakao';
                                    var form = document.loginForm;
                                    form.action = "/member/join_form";
                                    form.submit();
                                }
                            } else if (mode == "mypage") {
                                if (response.trim() == "2") {
                                    location.href = "/mypage/info_change";
                                    document.getElementById("sns_key").value = sns_key;
                                    //var form=document.loginForm;
                                    //form.action="/mypage/mypage_user_info.php";
                                    $("#loginForm").submit();

                                } else {

                                    document.getElementById("sns_key").value = sns_key;
                                    document.getElementById("user_name").value = name;
                                    document.getElementById("userEmail").value = email;
                                    document.getElementById("gubun").value = 'kakao';
                                    var form = document.loginForm;
                                    form.action = "/member/join_form";
                                    form.submit();
                                }
                            } else {
                                //카카오 로그인 접근 시 
								var returnUrl = $("#returnUrl").val();
								alert(returnUrl);
                                if (response.trim() == "2") {
                                    location.href = returnUrl;
                                } else {
                                    document.getElementById("sns_key").value = sns_key;
                                    document.getElementById("user_name").value = name;
                                    document.getElementById("userEmail").value = email ?? "";
                                    document.getElementById("gubun").value = 'kakao';
                                    $("#loginFrm").attr("action", "/member/join_form_sns").submit();
                                }

                            }
                        }
                    });



                },
                fail: function (error) {
                    alert(JSON.stringify(error));
                    console.log('카카오톡과 연결이 완료되지 않았습니다. \n다시 시도해주시기 바랍니다.');
                }
            })
        },
        fail: function (error) {
            alert(JSON.stringify(err));
            console.log('카카오톡과 연결 실패하였습니다. \n다시 시도해주시기 바랍니다.');
        },
    })
}





// 카카오 로그인 버튼을 생성합니다.
Kakao.Auth.createLoginButton({
    container: '#kakao-login-btn',
    success: function (authObj) {
        // 로그인 성공시, API를 호출합니다.
        Kakao.API.request({
            url: '/v2/user/me',
            success: function (res) {






            },
            fail: function (error) {
                alert(JSON.stringify(error));
            }
        });
    },
    fail: function (err) {
        alert(JSON.stringify(err));
    }
});

