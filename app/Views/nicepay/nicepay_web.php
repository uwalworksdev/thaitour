<?php
//header("Content-Type:text/html; charset=utf-8;"); 
/*
*******************************************************
* <결제요청 파라미터>
* 결제시 Form 에 보내는 결제요청 파라미터입니다.
* 샘플페이지에서는 기본(필수) 파라미터만 예시되어 있으며, 
* 추가 가능한 옵션 파라미터는 연동메뉴얼을 참고하세요.
*******************************************************
*/  
$setting     = homeSetInfo();

$merchantKey = $setting['nicepay_key'] ; //"EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // 상점키
$MID         = $setting['nicepay_midx'];  //"nicepay00m"; // 상점아이디
$goodsName   = "나이스페이"; // 결제상품명
//$price       = "1004"; // 결제상품금액
$buyerName   = "나이스"; // 구매자명 
$buyerTel	 = "01000000000"; // 구매자연락처
$buyerEmail  = "happy@day.co.kr"; // 구매자메일주소        
$moid        =  time(); // 상품주문번호                     
$returnURL	 = "https://". $_SERVER['HTTP_HOST'] ."/payment/nicepay_result"; // 결과페이지(절대경로) - 모바일 결제창 전용

/*
*******************************************************
* <해쉬암호화> (수정하지 마세요)
* SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다. 
*******************************************************
*/ 
//$ediDate    = date("YmdHis");
//$hashString = bin2hex(hash('sha256', $ediDate.$MID.$price.$merchantKey, true));
?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(EUC-KR)</title>
<meta charset="utf-8">
<!--style>
	html,body {height: 100%;}
	form {overflow: hidden;}
</style-->
<script src="https://pg-web.nicepay.co.kr/v3/common/js/nicepay-pgweb.js" type="text/javascript"></script>
<script type="text/javascript">
//결제창 최초 요청시 실행됩니다.
function nicepayStart(){
	if(checkPlatform(window.navigator.userAgent) == "mobile"){//모바일 결제창 진입
		document.payForm.action = "https://web.nicepay.co.kr/v3/v3Payment.jsp";
		document.payForm.acceptCharset="euc-kr";
		document.payForm.submit();
	}else{//PC 결제창 진입
		goPay(document.payForm);
	}
}

//[PC 결제창 전용]결제 최종 요청시 실행됩니다. <<'nicepaySubmit()' 이름 수정 불가능>>
function nicepaySubmit(){
	document.payForm.submit();
}

//[PC 결제창 전용]결제창 종료 함수 <<'nicepayClose()' 이름 수정 불가능>>
function nicepayClose(){
	alert("결제가 취소 되었습니다");
}

//pc, mobile 구분(가이드를 위한 샘플 함수입니다.)
function checkPlatform(ua) {
	if(ua === undefined) {
		ua = window.navigator.userAgent;
	}
	
	ua = ua.toLowerCase();
	var platform = {};
	var matched = {};
	var userPlatform = "pc";
	var platform_match = /(ipad)/.exec(ua) || /(ipod)/.exec(ua) 
		|| /(windows phone)/.exec(ua) || /(iphone)/.exec(ua) 
		|| /(kindle)/.exec(ua) || /(silk)/.exec(ua) || /(android)/.exec(ua) 
		|| /(win)/.exec(ua) || /(mac)/.exec(ua) || /(linux)/.exec(ua)
		|| /(cros)/.exec(ua) || /(playbook)/.exec(ua)
		|| /(bb)/.exec(ua) || /(blackberry)/.exec(ua)
		|| [];
	
	matched.platform = platform_match[0] || "";
	
	if(matched.platform) {
		platform[matched.platform] = true;
	}
	
	if(platform.android || platform.bb || platform.blackberry
			|| platform.ipad || platform.iphone 
			|| platform.ipod || platform.kindle 
			|| platform.playbook || platform.silk
			|| platform["windows phone"]) {
		userPlatform = "mobile";
	}
	
	if(platform.cros || platform.mac || platform.linux || platform.win) {
		userPlatform = "pc";
	}
	
	return userPlatform;
}
</script>

</head>
<body>
<form name="payForm" method="post" action="<?=$returnURL?>" style="display:none;">
	<table>
		<tr>
			<th>결제 수단</th>
			<td><input type="text" name="PayMethod" id="PayMethod" value=""></td>
		</tr>
		<tr>
			<th>결제 상품명</th>
			<td><input type="text" name="GoodsName" value="<?=$product_name?>"></td>
		</tr>
		<tr>
			<th>결제 상품금액</th>
			<td><input type="text" name="Amt" id="Amt" value="<?php echo($price)?>"></td>
		</tr>				
		<tr>
			<th>상점 아이디</th>
			<td><input type="text" name="MID" value="<?php echo($MID)?>"></td>
		</tr>	
		<tr>
			<th>상품 주문번호</th>
			<td><input type="text" name="Moid" id="Moid" value="<?php echo($moid)?>"></td>
		</tr> 
		<tr>
			<th>구매자명</th>
			<td><input type="text" name="BuyerName" id="BuyerName" value="<?php echo($buyerName)?>"></td>
		</tr>
		<tr>
			<th>구매자명 이메일</th>
			<td><input type="text" name="BuyerEmail" id="BuyerEmail" value="<?php echo($buyerEmail)?>"></td>
		</tr>		
		<tr>
			<th>구매자 연락처</th>
			<td><input type="text" name="BuyerTel" id="BuyerTel" value="<?php echo($buyerTel)?>"></td>
		</tr>	 
		<tr>
			<th>인증완료 결과처리 URL<!-- (모바일 결제창 전용)PC 결제창 사용시 필요 없음 --></th>
			<td><input type="text" name="ReturnURL" value="<?php echo($returnURL)?>"></td>
		</tr>
		<tr>
			<th>가상계좌입금만료일(YYYYMMDD)</th>
			<td><input type="text" name="VbankExpDate" value=""></td>
		</tr>		
					
		<!-- 옵션 -->	 
		<input type="hidden" name="GoodsCl"     value="1"/>				    <!-- 상품구분(실물(1),컨텐츠(0)) -->
		<input type="hidden" name="TransType"   value="0"/>					<!-- 일반(0)/에스크로(1) --> 
		<input type="hidden" name="CharSet"     value="utf-8"/>				<!-- 응답 파라미터 인코딩 방식 -->
		<input type="hidden" name="ReqReserved" value=""/>					<!-- 상점 예약필드 -->
					
		<!-- 변경 불가능 -->
		<input type="hidden" name="EdiDate"  id="EdiDate" value="<?php echo($ediDate)?>"/>			<!-- 전문 생성일시 -->
		<input type="hidden" name="SignData" id="SignData" value="<?php echo($hashString)?>"/>	<!-- 해쉬값 -->
	</table>
	<!--a href="#" class="btn_blue" onClick="nicepayStart();">요 청</a-->
</form>

<?php
      $deviceType = get_device();
?>

<?php if($deviceType == "P") { ?>

<?php

// 이니시스(PC) 결제부분
//$setting    = homeSetInfo();    

$mid 		=  $setting['inicis_mid'];  				// 상점아이디			
$signKey 	=  $setting['inicis_signkey'];   			// 웹 결제 signkey

?>
        <!--link rel="stylesheet" href="/inicis/css/style.css">
		<link rel="stylesheet" href="/inicis/css/bootstrap.min.css"-->
		
		<!--테스트 JS--><!--<script language="javascript" type="text/javascript" src="https://stgstdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script-->
		<!--운영 JS--> <script language="javascript" type="text/javascript" src="https://stdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script>
        <script type="text/javascript">
            function paybtn() {
                INIStdPay.pay('SendPayForm_id');
            }
        </script>

		<!-- 본문 -->
		<form name="" id="SendPayForm_id" method="post" class="mt-5" style="display:none;">
				<input type="hidden" name="version" value="1.0">
		<tr>
			<th>결제 수단</th>
			<td>
				<input type="text" name="gopaymethod" id="gopaymethod" value="Card:Directbank:vbank">
            </td> 
			<th>상점아이디</th>
			<td>
				<input type="text" name="mid" value="<?php echo $mid ?>">
            </td> 
			<th>주문번호</th>
			<td>
				<input type="text" name="oid" id="oid" value="<?php echo $orderNumber ?>">
            </td>
			<th>주문금액</th>
			<td>
				<input type="text" name="price" id="price" value="<?php echo $price ?>">
            </td> 
				<input type="hidden" name="timestamp" id="timestamp" value="<?php echo $timestamp ?>">
				<input type="hidden" name="use_chkfake" value="<?php echo $use_chkfake ?>">
				<input type="hidden" name="signature"    id="signature" value="<?php echo $sign ?>">
				<input type="hidden" name="verification" id="verification" value="<?php echo $sign2 ?>">
				<input type="hidden" name="mKey"         id="mKey" value="<?php echo $mKey ?>">
				<input type="hidden" name="currency" value="WON">
			<th>상품명</th>
			<td>
				<input type="text" name="goodname" value="<?=$product_name?>">
            </td>
			<th>예약자 성명</th>
			<td>
				<input type="text" name="buyername" id="buyername" value="테스터">
            </td>
			<th>예약자 연락처</th>
			<td>
				<input type="text" name="buyertel" id="buyertel" value="01012345678">
            </td>
			<th>예약자 이메일</th>
			<td>
				<input type="text" name="buyeremail" id="buyeremail" value="test@test.com">
            </td> 
				<input type="hidden" name="returnUrl" value="https://thetourlab.com/inicis/result">
				<input type="hidden" name="closeUrl"  value="https://thetourlab.com/inicis/close">
				<input type="hidden" name="acceptmethod" value="HPP(1):below1000:centerCd(Y)">
		</form>
		
<?php } ?>

<?php if($deviceType == "M") { ?>

	<script> 
		function paybtn() { 
			myform = document.mobileweb; 
			myform.action = "https://mobile.inicis.com/smart/payment/";
			myform.target = "_self";
			myform.submit(); 
		}
	</script> 

	<?php

	// 이니시스(Mobile) 결제부분
	$setting    = homeSetInfo();    

	$mid 		=  $setting['inicis_mid'];  				// 상점아이디			
	$signKey 	=  $setting['inicis_signkey'];   			// 웹 결제 signkey

	?>

                    <form name="mobileweb" id="" method="post" class="mt-5" accept-charset="euc-kr">
                        <div class="row g-3 justify-content-between" style="--bs-gutter-x:0rem;">
				    
                            <label class="col-10 col-sm-2 input param" style="border:none;">P_INI_PAYMENT</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_INI_PAYMENT" value="CARD">
                            </label>
				    		
				    		<label class="col-10 col-sm-2 input param" style="border:none;">P_MID</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_MID" value="<?php echo $mid ?>">
                            </label>
				    
                            <label class="col-10 col-sm-2 input param" style="border:none;">P_OID</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_OID"  id="oid" value="<?php echo $orderNumber ?>">
                            </label>
				    		
				    		<label class="col-10 col-sm-2 input param" style="border:none;">P_AMT</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_AMT" id="price" value="1000">
                            </label>
				    		
				    		<label class="col-10 col-sm-2 input param" style="border:none;">P_GOODS</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_GOODS" value="<?=$product_name?>">
                            </label>
				    		
				    		<label class="col-10 col-sm-2 input param" style="border:none;">P_UNAME</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_UNAME" id="buyername" value="테스터">
                            </label>
				    		
				    		<label class="col-10 col-sm-2 input param" style="border:none;">P_MOBILE</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_MOBILE" id="buyertel" value="01012345678">
                            </label>
				    		
				    		<label class="col-10 col-sm-2 input param" style="border:none;">P_EMAIL</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_EMAIL" id="buyeremail" value="test@test.com">
                            </label>
				    		
				    		<input type="hidden" name="P_NEXT_URL" value="https://thetourlab.com/inicis/result_m">
							
                            <input type="hidden" name="P_CHARSET" value="utf8">
                            
				    		<label class="col-10 col-sm-2 input param" style="border:none;">P_RESERVED</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_RESERVED" value="below1000=Y&vbank_receipt=Y&centerCd=Y">
                            </label>
							
                        </div>
                    </form>    
	
<?php } ?>	
