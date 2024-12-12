<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>


<script type="text/javascript" src="/js/naverLogin_implicit-1.0.2.js" charset="utf-8"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>


<!-- 네이버아이디로로그인 버튼 노출 영역 -->
<div id="naver_id_login" style="display:none"></div>
<!-- //네이버아이디로로그인 버튼 노출 영역 -->


<!-- 네이버아디디로로그인 초기화 Script -->
<script type="text/javascript">
	var naver_id_login = new naver_id_login("DILc4YMWO0DHFqB0fsgn", "<?=$_IT_TOP_PROTOCOL?><?=$_SERVER['HTTP_HOST']?><?=$_SERVER['PHP_SELF']?>");
	var state = naver_id_login.getUniqState();
	naver_id_login.setButton("white", 2,40);
	naver_id_login.setDomain("<?=$_SERVER['HTTP_HOST']?>");
	naver_id_login.setState(state);
	naver_id_login.setPopup();
	naver_id_login.init_naver_id_login();
</script>
<!-- //네이버아디디로로그인 초기화 Script -->


	<form name="lfrm" id="lfrm" action="/member/join_form" method="POST">
		<input type=hidden name="userId" id="userId" value="">
		<input type=hidden name="userEmail" id="userEmail" value="">
		<input type=hidden name="userName" id="userName" value="">
		<input type=hidden name="userSex" id="userSex" value="">
		<input type=hidden name="gubun" id="gubun" value="naver">
		<input type=hidden name="mode" id="mode" value="">
	</form>



	
<!-- 네이버아디디로로그인 Callback페이지 처리 Script -->
<script type="text/javascript">
	var mode = opener.document.getElementById("mode").value;
	
	document.getElementById("mode").value = mode;

	// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
	function naverSignInCallback() {
		// naver_id_login.getProfileData('프로필항목명');
		// 프로필 항목은 개발가이드를 참고하시기 바랍니다.
//		alert(naver_id_login.getProfileData('email'));
//		alert(naver_id_login.getProfileData('nickname'));
//		alert(naver_id_login.getProfileData('age'));
		document.lfrm.userId.value = naver_id_login.getProfileData('id');
		document.lfrm.userEmail.value = naver_id_login.getProfileData('email');
		document.lfrm.userName.value = naver_id_login.getProfileData('name');
		document.lfrm.userSex.value = naver_id_login.getProfileData('gender');
		document.lfrm.gubun.value = "naver";
		
		window.opener.name = "parentPage"; // 부모창의 이름 설정
		document.lfrm.target = "parentPage"; // 타켓을 부모창으로 설정
		document.lfrm.action = "/member/sns_naver_login.php";
		document.lfrm.submit();
		self.close();

	}

	// 네이버 사용자 프로필 조회
	naver_id_login.get_naver_userprofile("naverSignInCallback()");
</script>
<!-- //네이버아디디로로그인 Callback페이지 처리 Script -->
