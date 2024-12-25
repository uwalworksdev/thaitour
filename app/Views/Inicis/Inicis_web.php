<?php

// 이니시스 결제부분
$setting    = homeSetInfo();    

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
	
		<!--button onclick="paybtn()" class="btn_solid_pri col-6 mx-auto btn_lg" style="margin-top:50px">결제 요청</button-->