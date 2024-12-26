	<script> 
		function paybtn() { 
			myform = document.mobileweb; 
			myform.action = "https://mobile.inicis.com/smart/payment/";
			myform.target = "_self";
			myform.submit(); 
		}
	</script> 

	<?php

	// 이니시스 결제부분
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
				    		
				    		<input type="hidden" name="P_NEXT_URL" value="https://{가맹점도메인}/INImobile_mo_return.php">
							
                            <input type="hidden" name="P_CHARSET" value="utf8">
                            
				    		<label class="col-10 col-sm-2 input param" style="border:none;">P_RESERVED</label>
                            <label class="col-10 col-sm-9 input">
                                <input type="text" name="P_RESERVED" value="below1000=Y&vbank_receipt=Y&centerCd=Y">
                            </label>
							
                        </div>
                    </form>    
