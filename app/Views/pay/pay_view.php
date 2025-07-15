<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>카드결제 - 결제하기</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin: 0;
      padding: 20px;
      box-sizing: border-box;
      background-color: #f9f9f9;
    }

    h2 {
      margin-bottom: 10px;
      color: #333;
    }

    /* 단계 스텝 바 */
	.step div {
	  padding: 10px 20px;
	  border-radius: 20px;
	  background-color: #e0e0e0;     /* 비활성 단계 색상 */
	  color: #666;
	  margin: 5px;
	  font-weight: 500;
	  transition: background-color 0.3s, color 0.3s;
	}

	.step .active {
	  background-color: #2d3e9b;     /* 활성 단계 색상 */
	  color: #fff;
	  font-weight: 700;
	  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
	}

    .active {
      background-color: #2d3e9b;
      color: white;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    h1 {
      font-size: 1.2rem;
      margin: 20px 0 10px;
      padding: 0 10px;
      color: #444;
    }

    p {
      font-size: 1rem;
      margin-bottom: 20px;
      padding: 0 10px;
      color: #666;
    }

    .info-box {
      margin-top: 40px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: left;
    }

    .info-box p {
      margin: 5px 0;
      font-size: 0.95rem;
    }

    button {
      padding: 12px 30px;
      background-color: #2d3e9b;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 30px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #1a256a;
    }

    @media (max-width: 480px) {
      .step {
        flex-direction: column;
        align-items: center;
      }

      h1 {
        font-size: 1rem;
      }

      p, .info-box p {
        font-size: 0.9rem;
      }
    }
	
.info-box p {
  display: flex;
  justify-content: space-between;
  margin: 5px 0;
}

.info-box .label {
  font-weight: bold;
}

.info-box .value {
  text-align: right;
}
  </style>

</head>
<body>

  <h2>카드결제</h2>
  <div class="step">
    <div>01 결제 로그인 인증</div>
    <div class="active">02 카드결제</div>
    <div>03 결제완료</div>
  </div>

  <h1><?= esc($product_title) ?></h1>

<div class="info-box">
  <h3>결제정보</h3>
  <p>
    <span class="label">예약자명</span>
    <span class="value"><?= esc($reservation_name) ?></span>
  </p>
  <p>
    <span class="label">이메일</span>
    <span class="value"><?= esc($email) ?></span>
  </p>
  <p>
    <span class="label">예약번호</span>
    <span class="value"><?= esc($order_number) ?></span>
  </p>
  <p>
    <span class="label">결제금액</span>
    <span class="value"><?= number_format($amount) ?>원</span>
  </p>
</div>


  <form method="post">
    <button type="button" onClick="nicepayStart();">결제하기</button>
  </form>


</body>
</html>

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
$MID         = $setting['nicepay_mid'];  //"nicepay00m"; // 상점아이디
$goodsName   = esc($product_title); // 결제상품명
$price       = $amount; // 결제상품금액
$buyerName   = esc($reservation_name); // 구매자명 
$buyerTel	 = esc($mobile); // 구매자연락처
$buyerEmail  = esc($email); // 구매자메일주소        
$moid        = esc($order_number); // 상품주문번호                     
$returnURL	 = "https://". $_SERVER['HTTP_HOST'] ."/payment/nicepay_result"; // 결과페이지(절대경로) - 모바일 결제창 전용

/*
*******************************************************
* <해쉬암호화> (수정하지 마세요)
* SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다. 
*******************************************************
*/ 
$ediDate    = date("YmdHis");
$hashString = bin2hex(hash('sha256', $ediDate.$MID.$price.$merchantKey, true));
?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(EUC-KR)..</title>
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
	alert("결제가 취소 되었습니다..");
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
			<td><input type="text" name="PayMethod" id="PayMethod" value="CARD"></td>
		</tr>
		<tr>
			<th>결제 상품명</th>
			<td><input type="text" name="GoodsName" value="<?=esc($product_title)?>"></td>
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