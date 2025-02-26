<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="/js/kakao.js"></script>

<script>
var id = "<?=session('member.id')?>";
if(id) location.href='/';
</script>

<?php

// 네이버 로그인 접근토큰 요청 예제
$client_id = env('NAVER_CLIENT_ID');
$redirectURI = urlencode("https://thetourlab.com/naver/callback");
$state = md5(microtime() . mt_rand()) . "log";
// $_SESSION['naver_state'] = $state;
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=" . $client_id . "&redirect_uri=" . $redirectURI . "&state=" . $state;

// 구글
$client_id = env('GOOGLE_LOGIN_CLIENT_ID');
$redirection_url = env("GOOGLE_REDIRECT_URI");
$scope = urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email');
$response_type = "code";

$_url = "https://accounts.google.com/o/oauth2/v2/auth";
$_url .= "?client_id=" . $client_id;
$_url .= "&redirect_uri=" . urlencode($redirection_url);
$_url .= "&scope=" . $scope;
$_url .= "&response_type=" . $response_type;
$_url .= "&state=OK";

$returnUrl = "";
?>

<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript" src="/member/kakao.js"></script>

<script>
    //네이버 로그인
    function fnNaverLogin() {
        location.href = '<?php echo $apiURL ?>';
    }
</script>

<!-- 구글로그인버튼 -->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<script src="https://apis.google.com/js/api:client.js"></script>
<!-- 구글로그인버튼 -->

<form action="login_check.php" method="post" name="loginForm" id="loginFrm" class="login_form01">
    <input type="hidden" name="returnUrl" value="<?= urlencode($returnUrl) ?>">
    <input type="hidden" name="mode" id="mode" value="true"/>
    <input type="hidden" name="sType" id="sType" value="login">
    <input type="hidden" name="sns_key" id="sns_key" value=""/>
    <input type="hidden" name="user_name" id="user_name" value=""/>
    <input type="hidden" name="userEmail" id="userEmail" value=""/>
    <input type="hidden" name="gubun" id="gubun" value=""/>
</form>

<main id="container" class="sub join member pt100">
    <div class="inner_620">

        <div class="sub_sec_ttl tac ">
            <h2 class="ttl">반가워요! <span class="font_emoji">👋</span> <br> 더투어랩에는 처음 오셨나요?</h2>
        </div>

        <ul class="join_list">
            <li>
                <a href="./join_agree" class="btn-default">ID/PW 회원 가입하기</a>
            </li>
            <li class="naver">
                <a href="#!" onclick="fnNaverLogin();"> <i></i> 네이버 회원가입 </a>
            </li>
            <li class="kakao">
                <a href="#!" onclick="loginWithKakao();"><i></i> 카카오톡 회원가입 </a>
            </li>
            <li class="google">
                <a href="<?= $_url ?>" id="customBtn" class="btn-default"><i></i> 구글 가입하기</a>
            </li>
        </ul>
    </div>
</main>

<?php $this->endSection(); ?>
