<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript">
        function checkForNumber(str) {
            var key = event.keyCode;
            var frm = document.frm1;
            send_it_mess();
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }

        function send_it() {
            var frm = document.frm;
            $(".price").each(function () {
                let val = $(this).val().replace(/,/g, '');
                $(this).val(val);
            });
            document.getElementById('action_type').value = 'save';
            document.frm.submit();
            frm.submit();
        }

        function send_it_mess() {
            var frm = document.frm;
            document.getElementById('action_type').value = 'send_message';
            document.frm.submit();
            frm.submit();
        }
    </script>


    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="/AdmMaster/_reservation/list?search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>"
                                   class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                            class="txt">리스트</span></a></li>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            </li>
                            <li><a href="javascript:del_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- // inner -->
            </header>
            <!-- // headerContainer -->

            <form name=frm action="/AdmMaster/_reservation/write_ok/<?= $order_idx ?>" method=post enctype="multipart/form-data" target="hiddenFrame">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type="hidden" id="action_type" name="action_type" value="">

                <input type=hidden name="m_idx" value='<?= $m_idx ?>'>

                <input type=hidden name="product_idx" value='<?= $product_idx ?>'>
                <input type=hidden name="baht_thai" id="baht_thai" value='<?= $bath_thai_price ?>'>
                <input type=hidden name="people_adult_cnt" value='<?= $people_adult_cnt ?>'>
                <input type=hidden name="people_adult_price" value='<?= $people_adult_price ?>'>

                <input type=hidden name="people_kids_cnt" value='<?= $people_kids_cnt ?>'>
                <input type=hidden name="people_kids_price" value='<?= $people_kids_price ?>'>

                <input type=hidden name="people_baby_cnt" value='<?= $people_baby_cnt ?>'>
                <input type=hidden name="people_baby_price" value='<?= $people_baby_price ?>'>

                <input type=hidden name="oil_price" value='<?= $oil_price ?>'>
                <input type=hidden name="used_coupon_no" value='<?= $used_coupon_no ?>'>
                <input type=hidden name="used_coupon_point" value='<?= $used_coupon_point ?>'>
                <input type=hidden name="used_coupon_idx" value='<?= $used_coupon_idx ?>'>
                <input type=hidden name="used_coupon_money" value='<?= $row_cou['used_coupon_money'] ?>'>
                <input type=hidden name="product_mileage" value='<?= $product_mileage ?>'>
                <input type=hidden name="order_mileage" value='<?= $order_mileage ?>'>

                <input type=hidden name="product_period" value='<?= $product_period ?>'>
                <input type=hidden name="tour_period" value='<?= $tour_period ?>'>
                <input type=hidden name="used_mileage_money" value='<?= $used_mileage_money ?>'>
                <input type=hidden name="air_idx" value='<?= $air_idx ?>'>
                <input type=hidden name="yoil_idx" value='<?= $yoil_idx ?>'>
                <input type=hidden name="order_no" id="order_no" value='<?= $order_no ?>'>
                <input type=hidden name="order_r_date" value='<?= $order_r_date ?>'>
                <input type=hidden name="deposit_date" value='<?= $deposit_date ?>'>
                <input type=hidden name="order_confirm_date" value='<?= $order_confirm_date ?>'>
                <input type=hidden name="paydate" value='<?= $paydate ?>'>
                <input type=hidden name="gubun" value='<?= $gubun ?>'>

                <div id="contents">
                    <div class="listWrap_noline">
                        <div class="listBottom">
                            <div style="font-size:12pt;margin-bottom:10px">■ 예약정보(골프)</div>   
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>상품명</th>
                                    <td>
                                        <input type="text" name="product_name" value='<?= $product_name ?>'>

                                    </td>
                                    <th>예약번호</th>
                                    <td>
                                        <?= $order_no ?>
                                    </td>
                                </tr>                                
                                
                                <tr>
                                    <th>주문자명</th>
                                    <td>
                                        <input type="text" id="order_user_name" name="order_user_name"
                                               value="<?= $order_user_name ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                    <th>주문자 이메일</th>
                                    <td>
                                        <input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>영문 이름(First/Last)</th>
                                    <td>
                                        <input type="text" id="order_user_first_name_en" name="order_user_first_name_en" placeholder="First Name"
                                               value="<?= $order_user_first_name_en ?>" class="input_txt" style="width:45%"/>
											   <input type="text" id="order_user_last_name_en" name="order_user_last_name_en" placeholder="Last Name"
                                               value="<?= $order_user_last_name_en ?>" class="input_txt" style="width:45%"/>
                                    </td>
                                    <th>여권정보</th>
                                    <td>
										<select name="order_gender_list" class="select_txt">
                                            <option value="M" <?php if($order_gender_list == "M") echo "selected";?> >남자</option>  
                                            <option value="F" <?php if($order_gender_list == "F") echo "selected";?> >여자</option>
                                        </select>
                                         <input type="text" id="order_passport_number" name="order_passport_number" placeholder="여권번호"
                                               value="<?= $order_passport_number ?>" class="input_txt" style="width:40.5%" />
											   <input type="text" id="order_passport_expiry_date" name="order_passport_expiry_date" placeholder="만료일(2025-08-08)"
                                               value="<?= $order_passport_expiry_date ?>" class="input_txt datepicker" style="width:40.5%" readonly/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>생년월일</th>
                                    <td>
                                        <input type="text" id="order_birth_date" name="order_birth_date" placeholder="First Name"
                                               value="<?= $order_birth_date ?>" class="input_txt datepicker" style="width:20%" readonly/>
                                    </td>
                                    <th>그린피</th>
                                    <td>
                                         <div class="price_wrapper"><span>그린피 : </span>
                                            <input type="text" id="main_option_tot" name="main_option_tot"
                                               value="<?=number_format($main[0]["option_tot"])?>" class="input_txt number-only price price_won" style="width:100px;"/> 원
                                            <input type="text" id="main_option_tot_bath" name="main_option_tot_bath"
                                               value="<?=number_format($main[0]["option_tot_bath"])?>" class="input_txt number-only price price_bath" style="width:100px;"/>
                                            바트 X <input type="text" id="main_option_cnt" name="main_option_cnt"
                                               value="<?=number_format($main[0]["option_cnt"])?>" class="input_txt number-only" style="width:50px;" maxlength="3"/>인</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>휴대전화</th>
                                    <td>
                                        <input type="text" id="order_user_mobile" name="order_user_mobile"
                                               value="<?= $order_user_mobile ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                    <th>담당자</th>
                                    <td>
                                        <input type="text" id="manager_name" name="manager_name" value="<?= $manager_name ?>" class="input_txt" style="width:20%"/>
                                        <input type="text" id="manager_phone" name="manager_phone" value="<?= $manager_phone ?>" class="input_txt" style="width:20%"/>
                                        <input type="text" id="manager_email" name="manager_email" value="<?= $manager_email ?>" class="input_txt" style="width:20%"/>
                                    </td>
                                </tr>
                                <?php 
								    foreach ($vehicle as $key => $item): 
                                        if($item['option_name'] == "카트") {
                                            $cart  = $item['option_cnt'];
                                            $op_cart_idx  = $item['opt_idx'];
                                        }

									    if($item['option_name'] == "캐디피") {
                                            $caddy = $item['option_cnt'];  
                                            $op_caddy_idx  = $item['opt_idx'];
                                        } 
                                    endforeach; 
                                ?> 
                                <tr>
                                    <th>홀/날짜/시간</th>
									<?php foreach ($main as $key => $item): ?>
                                    <td>
                                        <input type="text" id="main_option_name" name="main_option_name"
                                               value="<?=$item['option_name']?>" class="input_txt"/>
                                    </td>
                                    <th>인원/캐디/카트</th>
                                    <td>라운딩 인원 : 
                                        <?= $item['option_cnt'] ?>명 
                                        &emsp;|&emsp; 캐디피 : 
                                        <!-- <input type="hidden" id="caddy_option_idx" name="caddy_option_idx" value="<?=$op_caddy_idx?>"> -->
                                        <!-- <input type="text" id="caddy_option_cnt" name="caddy_option_cnt"
                                            value="<?=$caddy ?? 0?>" class="input_txt number-only" style="width:50px;" maxlength="3"/>명  -->
                                        <?=$caddy ?? 0?>명
                                        &emsp;|&emsp; 카트 : 
                                        <!-- <input type="hidden" id="cart_option_idx" name="cart_option_idx" value="<?=$op_cart_idx?>"> -->
                                        <!-- <input type="text" id="cart_option_cnt" name="cart_option_cnt"
                                               value="<?=$cart ?? 0?>" class="input_txt number-only" style="width:50px;" maxlength="3"/>대 -->
                                        <?=$cart ?? 0?>대</td>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>예약일시</th>
                                    <td>
                                        <input type="text" id="order_date" name="order_date"
                                               value="<?= $order_date ?>" class="input_txt" style="width:40%"/>
                                    </td>
                                    <th>차량 미팅 시간</th>
                                    <td>
                                        <input type="text" id="vehicle_time" name="vehicle_time"
                                               value="<?= $vehicle_time ?>" class="input_txt" style="width:40%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>골프장 왕복 픽업 차량</th>
                                    <td>
                                        <div class="flex" style="flex-direction: column; gap: 5px;">
                                            <?php foreach ($vehicle as $key => $item): ?>
                                                <span class="price_wrapper">골프장 왕복 픽업 차량: 
                                                    <input type="hidden" name="ve_op_idx[]" value="<?= $item['opt_idx'] ?>"/> 
                                                    <input type="text" name="ve_op_name[]" value="<?= !empty($item['option_name_new']) ? $item['option_name_new'] : $item['option_name'] ?>" class="input_txt" style="width:150px;"/> 
                                                    x <input type="text" name="ve_op_cnt[]" value="<?= $item['option_cnt'] ?>" class="input_txt number-only" style="width:50px;" maxlength="3"/>대 = 
                                                금액 <input type="text" name="ve_op_tot[]" value="<?= number_format($item['option_tot'])?>" class="input_txt number-only price price_won" style="width:100px;"/>원 / 
                                                <input type="text" name="ve_op_tot_bath[]" value="<?= number_format($item['option_tot'] / $item['baht_thai'])?>" class="input_txt number-only price price_bath" style="width:100px;"/>TH</span>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                    <th>선택옵션</th>
                                    <td>
                                        <div class="flex" style="flex-direction: column; gap: 5px;">
                                            <?php foreach ($option as $key => $item): ?>
                                                <div class="price_wrapper">
                                                    <input type="hidden" name="op_idx[]" value="<?= $item['opt_idx'] ?>"/> 
                                                    <input type="text" name="op_name[]" value="<?= $item['option_name'] ?>" class="input_txt" style="width:200px;"/> 
                                                    x <input type="text" name="op_cnt[]" value="<?= $item['option_cnt'] ?>" class="input_txt number-only" style="width:50px;" maxlength="3"/>대 = 
                                                    금액 <input type="text" name="op_tot[]" value="<?= number_format($item['option_tot'])?>" class="input_txt number-only price price_won" style="width:100px;"/>원 / 
                                                    <input type="text" name="op_tot_bath[]" value="<?= number_format($item['option_tot'] / $item['baht_thai'])?>" class="input_txt number-only price price_bath" style="width:100px;"/>TH</span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>여행시 현지 연락처</th>
                                    <td><input type="text" id="local_phone" name="local_phone" value="<?= $local_phone ?>" class="input_txt" style="width:40%"/></td>
                                    <th>출발지(필요호텔)</th>
                                    <td><input type="text" id="departure_point" name="departure_point" value="<?= $departure_point ?>" class="input_txt" style="width:40%"/></td>
                                </tr>
                                <?php if ($order_status == "Y") { ?>
                                    <tr>
                                        <th>부여된마일리지</th>
                                        <td>
                                            <input type="text" id="order_mileage" name="order_mileage" value="<?= $order_mileage ?>" class="input_txt" style="width:40%"/>P
                                        </td>
                                        <th>결제일시</th>
                                        <td>
                                            <input type="text" id="paydate" name="paydate" value="<?= $paydate ?>" class="input_txt" style="width:40%"/>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr style="height:100px">
                                    <th>요청사항</th>
                                    <td colspan="3">
                                        <textarea id="custom_req" name="custom_req" class="input_txt" style="width:90%;height:80px"><?php echo $custom_req ? $custom_req : $order_memo ?></textarea>
                                    </td>
                                </tr>
                                <tr style="height:100px">
                                    <th>관리자 메모</th>
                                    <td colspan="3">
                                        <textarea id="admin_memo" name="admin_memo" class="input_txt"  style="width:90%;height:80px"><?= $admin_memo ?></textarea>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
							
							<!-- 예약금액 및 상태설정 수정 -->
							<br>
							<div style="font-size:12pt;margin-bottom:10px">■ 상품금액 및 예약설정</div>
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>총 결제금액</th>
                                    <td>
                                        원화계산 : <?php
                                            // $setting    = homeSetInfo();
                                            // $extra_cost = 0;
                                
                                            // $type_extra_cost = $setting["type_extra_cost"];
                                            
                                            // $total_price = 0;
                                            // $total_price = $room_op_price_sale + $inital_price * $order_room_cnt;
                                            // $total_last_price = $total_price - $used_coupon_money - $used_mileage_money;
                                            // if (!empty($setting["extra_cost"])) {
                                            //     if ($type_extra_cost == "P") {
                                            //         $extra_cost = round(intval($total_last_price) * floatval($setting["extra_cost"]) / 100);
                                            //     } else {
                                            //         $extra_cost = $setting["extra_cost"];
                                            //     }
                                            // }

                                        ?>   
                                        <?php
                                            if($price_secret == "Y"){
                                        ?>
                                            0원(<span style="color: red;">비밀특가</span>)
                                        <?php
                                            }else{
                                        ?>
                                        <input type="text" style="width: 100px;" id="order_price" name="order_price"
                                                    value="<?= number_format( $order_price) ?>" class="input_txt price" readonly>원        
                                        -
                                         <input type="text" style="width: 100px;" id="used_coupon_money" name="used_coupon_money"
                                                    value="<?= number_format($used_coupon_money) ?>" class="input_txt price">원(할인쿠폰) 
                                        -
                                        <input type="text" style="width: 100px;" id="used_mileage_money" name="used_mileage_money"
                                                    value="<?= number_format($used_mileage_money) ?>" class="input_txt price">원(마일리지사용)
                                        <div style="margin-left: 43px; margin-top: 5px;">
                                            +
                                            <input type="text" style="width: 100px;" id="extra_cost" name="extra_cost"
                                                        value="<?= number_format($extra_cost) ?>" class="input_txt price">원
                                            = <?= number_format( $order_price - $used_coupon_money - $used_mileage_money + $extra_cost) ?>
                                            원
                                        </div>
                                        <?php } ?> <br>
                                        <?php

                                            $used_coupon_money_bath = (int) round($used_coupon_money / $bath_thai_price);
                                            $used_mileage_money_bath = (int) round($used_mileage_money / $bath_thai_price);
                                            $extra_cost_bath = (int) round($extra_cost / $bath_thai_price);
                                            
                                        ?>
										바트계산 : <?=number_format($order_price_bath)?>  TH - <?=number_format($used_coupon_money_bath)?> TH(할인쿠폰) 
                                                - <?=number_format($used_mileage_money_bath)?> TH(마일리지사용) + <?=$extra_cost_bath?> TH 
                                                = <?=number_format($order_price_bath - $used_coupon_money_bath - $used_mileage_money_bath + $extra_cost_bath)?> TH
                                    </td>
                                    <th>실 결제금액</th>
                                    <td>
                                       
										<input type="text" id="real_price_bath" name="real_price_bath"
                                               value="<?= number_format($real_price_bath)?>" class="input_txt price"
                                               style="width:150px;text-align:right;" <?php if($order_status != "W") echo "readonly";?> /> TH
                                        <input type="text" id="real_price_won" name="real_price_won"
                                               value="<?= number_format($real_price_won) ?>" class="input_txt price"
                                               style="width:150px;text-align:right;" readonly/> 원
                                        <?php
                                        if ($ResultCode_2 == "3001" && $AuthCode_2 && $CancelDate_2 == "") {
                                            echo "결제완료 ";
                                            echo "<button type='button' onclick='payment_cancel(2);'>결제취소</button>";
                                        }

                                       
                                        ?>&emsp;
                                        <button class="btn btn-default">결제발송</button>
										
										<?php if($order_status == "W") { ?>
                                        <a href="#!" class="btn btn-default" id="price_update" >
										<span class="glyphicon glyphicon-cog"></span><span class="txt">금액수정</span></a>
										&emsp;<?=$order_r_date?> <br>
										<span style="color:red;" >* 바트를 넣으면 원화가 계산됩니다.</span>
										<?php } ?>
                                    </td>
                                </tr>									
                                <tr>
                                    <th>예약현황</th>
                                    <td>
                                       <input type="hidden" name="o_order_status" value="<?= $order_status ?>">
                                        <select name="order_status" id="order_status" class="select_txt">
                                            <option value="">결제현황</option>
											
											<?php
												$_deli_type = get_deli_type();
												foreach ($_deli_type as $key => $value) 
												{
											?>
                                                  <option value="<?= $key ?>" <?php if ($key == $order_status) echo "selected"; ?> > <?= $value ?></option>
											<?php
												} 
											?>
											
                                            <!--option value="W" <?php if ($order_status == "W") {
                                                echo "selected";
                                            } ?>>예약접수
                                            </option>
											 <option value="W" <?php if ($order_status == "W") {
                                                echo "selected";
                                            } ?>>예약확인
                                            </option>
											 <option value="W" <?php if ($order_status == "W") {
                                                echo "selected";
                                            } ?>>예약확정
                                            </option>
                                            <option value="G" <?php if ($order_status == "G") {
                                                echo "selected";
                                            } ?>>결제대기
                                            </option>
                                            <option value="Y" <?php if ($order_status == "Y") {
                                                echo "selected";
                                            } ?>>결제완료
                                            </option>
                                            <option value="C" <?php if ($order_status == "C") {
                                                echo "selected";
                                            } ?>>예약취소
                                            </option-->
                                        </select>
                                       <a href="javascript:set_status('<?= $order_idx ?>')" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">상태저장</span></a>
										&emsp;<?=$order_r_date?>
                                    </td>
                                    <th>상품금액</th>
                                    <td>
										원화계산 : <?= number_format($order_price) ?>원  | <?= number_format($order_price / 	$baht_thai) ?> 바트
										
                                    </td>
                                </tr>
								
                                <tr>
                                        <th>예약 문자발송(알림톡)</th>
                                        <td colspan="3">
                                         <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','UA_5373');">예약접수</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','UA_5319');">예약확인</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','UA_5325');">예약불가능</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','TY_2397');">결제대기</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','UA_5328');">결제완료</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','UA_5331');">예약확정</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','UA_5348');">예약취소</button>
                                        </td>
										<!--th>바우쳐 금액</th>
										<td>
											<input type="text" id="voucher_price_bath" name="voucher_price_bath"
												   value="<?= number_format($voucher_price_bath)?>" class="input_txt price"
												   style="width:150px;text-align:right;" /> TH
											<input type="text" id="voucher_price_won" name="voucher_price_won"
												   value="<?= number_format($voucher_price_won) ?>" class="input_txt price"
												   style="width:150px;text-align:right;" readonly /> 원 
												   
                                            <a href="#!" class="btn btn-default" id="voucher_update" >
										    <span class="glyphicon glyphicon-cog"></span><span class="txt">금액수정</span></a><br>
										    <span style="color:red;" >* 바트를 넣으면 원화가 계산됩니다.</span>
									 	</td-->
										
                                  </tr>                                
                                </tbody>

                            </table>
							<br>

                           <!-- 결제자 정보 -->
							<div style="font-size:12pt;margin-bottom:10px">■ 결제자 정보</div>
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>이름/연락처/이메일</th>
                                    <td colspan="3">
										<input type="text" id="order_user_name" name="order_user_name" value="<?= $order_user_name ?>" class="input_txt" style="width:15%" placeholder="결제자명"/>(무통장 입금명)
										<input type="text" id="order_user_mobile" name="order_user_mobile"  value="<?= $order_user_mobile ?>" class="input_txt" style="width:20%" placeholder="휴대전화"/>
										<input type="text" id="order_user_email" name="order_user_email"  value="<?= $order_user_email ?>" class="input_txt" style="width:20%" placeholder="이메일"/> 
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
							
							<br>
							<div style="font-size:12pt;margin-bottom:10px">■ 바우처/인보이스</div>
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>인보이스 발송</th>
                                    <td>
                                       <select name="order_status" class="select_txt">
                                            <option value="W" <?php if ($order_status == "W") { echo "selected";
                                            } ?>>인보이스 준비
                                            </option>
                                            <option value="G" <?php if ($order_status == "G") { echo "selected";
                                            } ?>>인보이스 발송
                                            </option>
                                        </select>
										<button class="btn btn-primary" type="button" style="width: unset;" onclick="window.open('/invoice/golf_01/<?=$order_idx?>', 'window_name', 'width=900, height=700, location=no, status=no, scrollbars=yes');">인보이스 보기</button>&emsp;

										<a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
										&emsp;2025-02-08 00:00 &emsp;<BR>
										 <input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:35%" placeholder="이메일"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="invoiceGolf('<?=$order_no?>');">고객 메일발송</button><BR>
											   <input type="text" id="order_user_mobile" name="order_user_mobile"
                                               value="<?= $order_user_mobile ?>" class="input_txt" style="width:35%" placeholder="휴대전화"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="">고객 문자발송</button>
                                    </td>
                                    <th>바우처 발송</th>
                                    <td>
                                        <select name="order_status" class="select_txt">
                                            <option value="W" <?php if ($order_status == "W") { echo "selected";
                                            } ?>>바우처 준비
                                            </option>
                                            <option value="G" <?php if ($order_status == "G") { echo "selected";
                                            } ?>>바우처 발송
                                            </option>
                                        </select>
										<button class="btn btn-primary" style="width: unset;" type="button" onclick="window.open('/voucher/golf/<?=$order_idx?>?type=admin', 'window_name', 'width=900, height=700, location=no, status=no, scrollbars=yes');">바우처 보기</button>&emsp;
										
										<a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
										&emsp;2025-02-08 00:00 &emsp;<BR>
										<input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:35%" placeholder="고객 이메일"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="voucherGolf('<?=$order_no?>');">고객 메일발송</button><BR>
											   <input type="text" id="order_user_mobile" name="order_user_mobile"
                                               value="<?= $order_user_mobile ?>" class="input_txt" style="width:35%" placeholder="휴대전화"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="">고객 문자발송</button><BR>
											   <input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:35%" placeholder="고객 이메일"/>
											   <button type="button" class="btn btn btn-danger" style="width: unset;" onclick="" placeholder="골프 이메일">골프 메일발송</button><BR>
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
							
                            <br>                
                            <div style="font-size:12pt;margin-bottom:10px">■ 관리 히스토리</div>
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>수정일자</th>
                                    <td>
										<div>
                                            <?php
                                                foreach ($history_order_list as $history_item) {
                                            ?>
                                                <p><?=$history_item['user_name']?>(<?=$history_item['user_id']?>) 님이 <?=$history_item['updated_date']?> 수정을 하셨습니다. (아이피: <?=$history_item['ip_address']?>)</p>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                        <!-- // listBottom -->

                        <div class="tail_menu">
                            <ul>
                                <li class="left"></li>
                                <li class="right_sub">

                                    <a href="/AdmMaster/_reservation/list?search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>"
                                       class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                                class="txt">리스트</span></a>
                                    <?php if ($order_idx == "") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <?php } else { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <a href="javascript:del_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- // listWrap -->

                </div>
                <!-- // contents -->
            </form>
        </div><!-- 인쇄 영역 끝 //-->
    </div>

    <div class="pop_common img_pop">
        <div class="pop_item" style="max-width: 600px;">
            <div class="pop_top" style="border-radius: 0px;">
                <button
                        type="button"
                        class="btn_close no_txt"
                        onclick="PopCloseBtn('.img_pop')">
                    닫기
                </button>
            </div>
            <div style="width: 600px;height: 848px;display: flex;background-color: #252525;max-height: 100%;">
                <img style="margin:auto;max-height: 100%;" id="img_showing" src="" alt="">
            </div>
        </div>
        <div class="pop_dim" onclick="PopCloseBtn('.img_pop')"></div>
    </div>

	<script>
    $(document).ready(function () {
		// 환율 값 가져오기
		var baht_thai = parseFloat($("#baht_thai").val());

		// .exp_amt 클래스의 input 값이 변경될 때
		$(".price_bath").on('input', function () {
			
			// 현재 입력된 baht 필드의 ID에서 인덱스 추출
			// 입력된 값 가져오기
            let bath = parseFloat($(this).val().replace(/,/g, '')) || 0 ;

			// 환산된 원화 계산
			let won = Math.round(bath * baht_thai);

			// 해당 인덱스의 원화 input에 값 넣기
			$(this).closest(".price_wrapper").find(".price_won").val(won.toLocaleString('en-US'));
		});

        $(".price_won").on('input', function () {
			
			// 현재 입력된 baht 필드의 ID에서 인덱스 추출
			// 입력된 값 가져오기
            let won = parseFloat($(this).val().replace(/,/g, '')) || 0 ;

			// 환산된 원화 계산
			let bath = Math.round(won / baht_thai);

			// 해당 인덱스의 원화 input에 값 넣기
			$(this).closest(".price_wrapper").find(".price_bath").val(bath.toLocaleString('en-US'));
		});
	});

    $(document).on('input', '.number-only', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function invoiceGolf(order_no)
    {
        if (!confirm('인보이스를 전송 하시겠습니까?'))
            return false;

        var message = "";
        $.ajax({
            url  : "/ajax/ajax_incoiceHotel_send",
            type : "POST",
            data : {
                "order_no"  : order_no 
            },
            dataType : "json",
            async: false,
            cache: false,
            success: function (data, textStatus) {
                message = data.message;
                alert(message);
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });		
    }

    function voucherGolf(order_no)
	{
			if (!confirm('바우쳐를 전송 하시겠습니까?'))
				return false;

			var message = "";
			$.ajax({
				url  : "/ajax/ajax_voucherHotel_send",
				type : "POST",
				data : {
					"order_no"  : order_no 
				},
				dataType : "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					message = data.message;
					alert(message);
					location.reload();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});		
		
	}

	$(document).ready(function () {
		$('#price_update').on('click', function (e) {
			e.preventDefault(); // 앵커 링크 방지 (href="#!" 이므로 필수)

			if (!confirm('결제금액을 수정 하시겠습니까?'))
				return false;

			var message = "";
			$.ajax({
				url  : "/ajax/ajax_price_update",
				type : "POST",
				data : {
					"order_no"        : $("#order_no").val(),
					"real_price_bath" : Number($("#real_price_bath").val().replace(/,/g, '')),
					"real_price_won"  : Number($("#real_price_won").val().replace(/,/g, ''))
				},
				dataType : "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					message = data.message;
					alert(message);
					location.reload();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});
			
		});
	});
    </script>

	<script>  
	$(document).ready(function () {
		// 환율 값 가져오기
		var baht_thai = parseFloat($("#baht_thai").val());

		// .exp_amt 클래스의 input 값이 변경될 때
		$("#voucher_price_bath").on('input', function () {
			
			// 현재 입력된 baht 필드의 ID에서 인덱스 추출
			// 입력된 값 가져오기
			var bath = parseFloat($("#voucher_price_bath").val().replace(/,/g, '')) || 0;

			// 환산된 원화 계산
			var won = Math.round(bath * baht_thai);

			// 해당 인덱스의 원화 input에 값 넣기
			$("#voucher_price_won").val(won.toLocaleString());
		});
	});
	</script>
	
	<script>
	$(document).ready(function () {
		$('#voucher_update').on('click', function (e) {
			e.preventDefault(); // 앵커 링크 방지 (href="#!" 이므로 필수)

			if (!confirm('바우처금액을 수정 하시겠습니까?'))
				return false;

			var message = "";
			$.ajax({
				url  : "/ajax/ajax_voucher_update",
				type : "POST",
				data : {
					"order_no"        : $("#order_no").val(),
					"voucher_price_bath" : $("#voucher_price_bath").val(),
					"voucher_price_won"  : $("#voucher_price_won").val()
				},
				dataType : "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					message = data.message;
					alert(message);
					location.reload();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});
			
		});
	});
    </script>
	
	<script>  
	$(document).ready(function () {
		// 환율 값 가져오기
		var baht_thai = parseFloat($("#baht_thai").val());

		// .exp_amt 클래스의 input 값이 변경될 때
		$("#real_price_bath").on('input', function () {
			
			// 현재 입력된 baht 필드의 ID에서 인덱스 추출
			// 입력된 값 가져오기
			var bath = parseFloat($("#real_price_bath").val().replace(/,/g, '')) || 0;

			// 환산된 원화 계산
			var won = Math.round(bath * baht_thai);

			// 해당 인덱스의 원화 input에 값 넣기
			$("#real_price_won").val(won.toLocaleString('en-US'));
		});
	});
	</script>
	
    <script>
	function allimtalk(order_no, alimCode)
	{
			if (!confirm('알림톡을 전송 하시겠습니까?'))
				return false;

			var message = "";
			$.ajax({
				url  : "/ajax/ajax_allimtalk_send",
				type : "POST",
				data : {
					"order_no"  : order_no,
					"alimCode"  : alimCode
				},
				dataType : "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					message = data.message;
					alert(message);
					location.reload();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});		
	}	
	
									
	function set_status(idx)
	{
		if (!confirm('예약현황을 변경 하시겠습니까?'))
			return false;

        if($("#order_status").val() == "") {
		   alert('예약상태를 선택하세요');
		   return false;
		}
		
		var message = "";
		$.ajax({
			url: "/ajax/ajax_set_status",
			type: "POST",
			data: {
				"order_idx"    : idx,
				"order_status" : $("#order_status").val()
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				message = data.message;
				alert(message);
				location.reload();
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});
		
	}	
	</script>
	
    <script>

        function handleShowImgPop(img) {
            $("#img_showing").attr("src", img);
            $(".img_pop").show();
        }

    </script>

    <script>
        function payment_cancel(type) {
            var amt_type = "";
            if (type == "1") amt_type = "선금";
            if (type == "2") amt_type = "잔금";

            if (!confirm(amt_type + ' 을 결제취소 하시겠습니까?\n\n한번 취소한 자료는 복구할 수 없습니다.'))
                return false;

            var message = "";
            $.ajax({

                url: "/nicepay/ajax.cancelResult.php",
                type: "POST",
                data: {
                    "order_idx": $("#order_idx").val(),
                    "type": type
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }
    </script>

        <script>
	    function del_it() {
			if (!confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
				return;
		    }

			var message = "";
			$.ajax({
				url  : "/ajax/ajax_order_del",
				type : "POST",
				data : {
					"order_idx" : '<?=$order_idx?>'
				},
				dataType : "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					message = data.message;
					alert(message);
					location.href='/AdmMaster/_reservation/list';
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});			
		}
/*		
        function fn_comment() {

            <?php if ($_SESSION["member"]["id"] != "") { ?>
            if ($("#comment").val() == "") {
                alert("댓글을 입력해주세요.");
                return;
            }
            var queryString = $("form[name=com_form]").serialize();
            $.ajax({
                type: "POST",
                url: "/AdmMaster/_include/comment_proc.php",
                data: queryString,
                cache: false,
                success: function (ret) {
                    if (ret.trim() == "OK") {
                        fn_comment_list();
                        $("#comment").val("");
                    } else {
                        alert("등록 오류입니다." + ret);
                    }
                }
            });
            <?php } else { ?>
            alert("로그인을 해주세요.");
            <?php } ?>
        }
 
        function fn_comment_list() {

            $.ajax({
                type: "POST",
                url: "/AdmMaster/_include/comment_list.ajax.php",
                data: {
                    "r_code": "order",
                    "r_idx": "<?=$order_idx?>"
                },
                cache: false,
                success: function (ret) {
                    $("#comment_list").html(ret);
                }
            });

        }

        fn_comment_list();
*/		
    </script>
    <script src="/AdmMaster/_include/comment.js"></script>   
    <script>
        $(function () {
            $.datepicker.regional['ko'] = {
                showButtonPanel: true,
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                },
                closeText: '닫기',
                prevText: '이전',
                nextText: '다음',
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                weekHeader: 'Wk',
                dateFormat: 'yy-mm-dd',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: true,
                changeMonth: true,
                changeYear: true,
                showMonthAfterYear: true,
                closeText: '닫기', // 닫기 버튼 패널
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['ko']);

            $(".datepicker").datepicker({
                showButtonPanel: true,
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                },
                dateFormat: 'yy-mm-dd',
                showOn: "both",
                yearRange: "c-100:c+10",
                buttonImage: "/img/ico/date_ico.png",
                buttonImageOnly: true,
                closeText: '닫기',
                prevText: '이전',
                nextText: '다음'
                // ,minDate: 1
                <?php if ($str_guide != "") { ?>,
                    beforeShowDay: function (date) {
                        var day = date.getDay();
                        return [(<?= $str_guide ?>)];
                    }
                <?php } ?>
            });

            $('img.ui-datepicker-trigger').css({
                'display': 'none'
            });
            $('input.hasDatepicker').css({
                'cursor': 'pointer'
            });
        });
    </script>
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none;"></iframe>

<?= $this->endSection() ?>