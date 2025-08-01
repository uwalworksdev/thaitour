<?php
// mibkorea.com/nicepay/nicepay_m/payRequest_utf.php
//header("Content-Type:text/html; charset=utf-8;");
/*
*******************************************************
* <결제요청 파라미터>
* 결제시 Form 에 보내는 결제요청 파라미터입니다.
* 샘플페이지에서는 기본(필수) 파라미터만 예시되어 있으며, 
* 추가 가능한 옵션 파라미터는 연동메뉴얼을 참고하세요.
*******************************************************
*/
$merchantKey      = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg==";   // 상점키
$merchantID       = "nicepay00m";                                                       // 상점아이디
$goodsCnt         = "1";                                                                // 결제상품개수
$goodsName        = "나이스페이";                                                        // 결제상품명
$price            = "1004";                                                             // 결제상품금액	
$buyerName        = "나이스";                                                           // 구매자명
$buyerTel         = "01000000000";                                                      // 구매자연락처
$buyerEmail       = "happy@day.co.kr";                                                  // 구매자메일주소
$moid             = "mnoid1234567890";                                                  // 상품주문번호
$ReturnURL        = "https://". $_SERVER['HTTP_HOST'] ."/payment/nicepay_result";       // Return URL
$CharSet          = "utf-8";                                                            // 결과값 인코딩 설정
/*
*******************************************************
* <해쉬암호화> (수정하지 마세요)
* SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다. 
*******************************************************
*/ 
$ediDate = date("YmdHis");
$hashString = bin2hex(hash('sha256', $ediDate.$merchantID.$price.$merchantKey, true));

?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(UTF-8)</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi"/>
<link rel="stylesheet" type="text/css" href="./css/import.css"/>
<script type="text/javascript">
//스마트폰 결제 요청
function nicepayStart(){
    goPay(form)
}

function nicepayStart(form) {
    document.getElementById("vExp").value = getTomorrow();   
    document.tranMgr.submit();
    document.charset = "euc-kr";
}
//가상계좌 입금만료일 설정 (today +1)
function getTomorrow(){
    var today = new Date();
    var yyyy = today.getFullYear().toString();
    var mm = (today.getMonth()+1).toString();
    var dd = (today.getDate()+1).toString();
    if(mm.length < 2){mm = '0' + mm;}
    if(dd.length < 2){dd = '0' + dd;}
    return (yyyy + mm + dd);
}
</script>
</head>
<body>
<form name="tranMgr" method="post" target="_self" action="https://web.nicepay.co.kr/v3/smart/smartPayment.jsp" accept-charset="euc-kr">
  <div class="payfin_area">
    <div class="top">NICEPAY PAY REQUEST(UTF-8)</div>
    <div class="conwrap">
      <div class="con">
        <div class="tabletypea">
          <table>
            <colgroup><col width="30%"/><col width="*"/></colgroup>
              <tr>
                <th><span>결제 수단(M)</span></th>
                <td><input type="text" name="PayMethod" id="PayMethod" value="">
                  <!--select name="PayMethod">
                    <option value="CARD">신용카드</option>
                    <option value="BANK">계좌이체</option>
                    <option value="CELLPHONE">휴대폰결제</option>
                    <option value="VBANK" selected>가상계좌</option>
                  </select-->
                </td>
              </tr>
              <tr>
                <th><span>결제 상품명</span></th>
                <td><input type="text" name="GoodsName" value="<?=$goodsName?>"></td>
              </tr>			  
              <tr>
                <th><span>결제 상품개수</span></th>
                <td><input type="text" name="GoodsCnt" value="<?=$goodsCnt?>"></td>
              </tr>	  
              <tr>
                <th><span>결제 상품금액</span></th>
                <td><input type="text" name="Amt" id="Amt" value="<?=$price?>"></td>
              </tr>	  
              <tr>
                <th><span>구매자명</span></th>
                <td><input type="text" name="BuyerName" id="BuyerName" value="<?=$buyerName?>"></td>
              </tr>	  
              <tr>
                <th><span>구매자 연락처</span></th>
                <td><input type="text" name="BuyerTel" id="BuyerTel" value="<?=$buyerTel?>"></td>
              </tr>    
              <tr>
                <th><span>상품 주문번호</span></th>
                <td><input type="text" name="Moid" id="Moid" value="<?=$moid?>"></td>
              </tr>
              <tr>
                <th><span>상점 아이디</span></th>
                <td><input type="text" name="MID" value="<?=$merchantID?>"></td>
              </tr>              
              
              <!-- 옵션 -->
              <input type="hidden" name="ReturnURL" value="<?=$ReturnURL?>"/>       <!-- Return URL -->		     
              <input type="hidden" name="CharSet" value="<?=$CharSet?>"/>           <!-- 인코딩 설정 -->              
              <input type="hidden" name="GoodsCl" value="1"/>                       <!-- 상품구분 실물(1), 컨텐츠(0) -->
              <input type="hidden" name="VbankExpDate" id="vExp"/>                  <!-- 가상계좌입금만료일 -->                        
              <input type="hidden" name="BuyerEmail" value="<?=$buyerEmail?>"/>     <!-- 구매자 이메일 -->             				  
               
              <!-- 변경 불가능 -->
              <input type="hidden" name="EncryptData" id="SignData" value="<?=$hashString?>"/>    <!-- 해쉬값 -->
              <input type="hidden" name="ediDate" id="EdiDate" value="<?=$ediDate?>"/>           <!-- 전문 생성일시 --> 
			  <input type="hidden" name="AcsNoIframe" value="Y"/>					<!-- 나이스페이 결제창 프레임 옵션 (변경불가) -->				
			  
          </table>
        </div>
      </div>
      <div class="btngroup">
        <a href="#" class="btn_blue" onClick="goPay();">요 청</a>
      </div>
    </div>
  </div>
</form>
