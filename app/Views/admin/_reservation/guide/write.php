<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <script type="text/javascript">
        function checkForNumber(str) {
            let key = event.keyCode;
            let frm = document.frm1;
            send_it_mess();
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }

        function send_it() {
            let frm = document.frm;
            $(".price").each(function () {
                let val = $(this).val().replace(/,/g, '');
                $(this).val(val);
            });
            document.getElementById('action_type').value = 'save';
            document.frm.submit();
            frm.submit();
        }

        function send_it_mess() {
            let frm = document.frm;
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

            <form name=frm action="/AdmMaster/_reservation/write_ok/<?= $order_idx ?>" method=post
                  enctype="multipart/form-data" target="hiddenFrame">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type="hidden" id="action_type" name="action_type" value="">

                <input type=hidden name="m_idx" value='<?= $m_idx ?>'>

                <input type=hidden name="product_idx" value='<?= $product_idx ?>'>
                <input type=hidden name="baht_thai" id="baht_thai" value='<?= $bath_thai_price ?>'>
                <!--                <input type=hidden name="people_adult_cnt" value='-->
                <?php //= $people_adult_cnt ?><!--'>-->
                <input type=hidden name="people_adult_price" value='<?= $people_adult_price ?>'>

                <!--                <input type=hidden name="people_kids_cnt" value='-->
                <?php //= $people_kids_cnt ?><!--'>-->
                <input type=hidden name="people_kids_price" value='<?= $people_kids_price ?>'>

                <input type=hidden name="people_baby_cnt" value='<?= $people_baby_cnt ?>'>
                <input type=hidden name="people_baby_price" value='<?= $people_baby_price ?>'>

                <input type=hidden name="oil_price" value='<?= $oil_price ?>'>
                <input type=hidden name="order_price" value='<?= $order_price ?>'>
                <input type=hidden name="used_coupon_no" value='<?= $used_coupon_no ?>'>
                <input type=hidden name="used_coupon_point" value='<?= $used_coupon_point ?>'>
                <input type=hidden name="used_coupon_idx" value='<?= $used_coupon_idx ?>'>
                <input type=hidden name="used_coupon_money" value='<?= $used_coupon_money ?>'>
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
                            <div style="font-size:12pt;margin-bottom:10px">■ 예약정보(차량 가이드)</div>
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
                                    <th>주문자이메일</th>
                                    <td>
                                        <input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>영문 이름(First Name)</th>
                                    <td colspan="3">
                                        <input type="text" id="order_user_first_name_en" name="order_user_first_name_en" placeholder="First Name"
                                               value="<?= $order_user_first_name_en ?>" class="input_txt" style="width:45%"/>
											   <input type="text" id="order_user_last_name_en" name="order_user_last_name_en" placeholder="Last Name"
                                               value="<?= $order_user_last_name_en ?>" class="input_txt" style="width:45%"/>
                                    </td>
                                    <!-- <th>예약기능여부</th>
                                    <td>
                                        <?= $option['o_availability'] ?>
                                    </td> -->
                                </tr>
                                <tr>
                                    <th>휴대전화</th>
                                    <td>
                                        <input type="text" id="order_user_mobile" name="order_user_mobile"
                                               value="<?= $order_user_mobile ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                    <th>여행시 현지 연락처</th>
                                    <td>
                                        <input type="text" id="local_phone" name="local_phone"
                                               value="<?= $local_phone ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
								<th>성인</th>
                                    <td>
                                        <input type="text" name="people_adult_cnt" value="<?= $people_adult_cnt ?>" class="input_txt number-only" style="width:50px;" maxlength="3"/>명 
                                    </td>
                                    <th>일정</th>
                                    <td>
                                        <input type="text" id="start_date" name="start_date" value="<?= date("Y-m-d", strtotime($start_date)) ?>" class="input_txt datepicker" style="width:20%" readonly/>
                                        ~
                                        <input type="text" id="end_date" name="end_date" value="<?= date("Y-m-d", strtotime($end_date)) ?>" class="input_txt datepicker" style="width:20%" readonly/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>주문일</th>
                                    <td colspan="3">
                                        <input type="text" id="order_r_date" name="order_r_date" value="<?= date("Y-m-d", strtotime($order_r_date)) ?>" class="input_txt datepicker" readonly/>
                                    </td>
                                    <!-- <th>예약기능여부</th>
                                    <td>
                                        <?php foreach ($sup_options as $item): ?>
                                            <p class="title-sub-r text-gray" style="margin-bottom: 10px;">
                                                - <?= $item['s_name'] ?>
                                            </p>
                                        <?php endforeach; ?>
                                    </td> -->
                                </tr>

                                <tr>
                                    <th>예약 상품정보</th>
                                    <td colspan="3">
                                        <table>
                                            <colgroup>
                                                <col width="10%">
                                                <col width="*">
                                                <col width="30%">
                                                <col width="30%">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th class="subject">가이드미팅시간</th>
                                                <th class="subject">미팅 장소</th>
                                                <th class="subject">예상일정</th>
                                                <th class="subject">기타 요청</th>
                                            </tr>

                                            <?php foreach ($order_subs as $item): ?>
                                                <tr>
                                                    <td class="content">
                                                        <input type="hidden" name="op_guide_idx[]" value="<?=$item["idx"]?>">
                                                        <div class="flex_c_c" style="gap: 5px;">
                                                            <input type="text" name="guide_meeting_hour[]" value="<?=$item["guide_meeting_hour"]?>" style="width:50px"> : 
                                                            <input type="text" name="guide_meeting_min[]" value="<?=$item["guide_meeting_min"]?>" style="width:50px">  
                                                        </div>
                                                    </td>

                                                    <td class="content">
                                                        <input type="text" name="guide_meeting_place[]" value="<?=$item["guide_meeting_place"]?>">
                                                    </td>
                                                    <td class="content">
                                                        <textarea name="guide_schedule[]" style="width: 100%; height: 100px;"><?= nl2br($item["guide_schedule"]) ?></textarea>
                                                    </td>
                                                    <td class="content">
                                                        <textarea name="request_memo[]" style="width: 100%; height: 100px;"><?= nl2br($item["request_memo"]) ?></textarea>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>


                                <tr style="height:100px">
                                    <th>요청사항</th>
                                    <td colspan="3">
                                        <textarea id="custom_req" name="custom_req" class="input_txt"
                                                  style="width:90%;height:80px"><?php echo $custom_req ?: $order_memo ?></textarea>
                                    </td>
                                </tr>
                                <tr style="height:100px">
                                    <th>관리자 메모</th>
                                    <td colspan="3">
                                        <textarea id="admin_memo" name="admin_memo" class="input_txt"
                                                  style="width:90%;height:80px"><?= $admin_memo ?></textarea>
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
                                                    value="<?= number_format( $order_price) ?>" class="input_txt price">원        
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

										<?php if($order_status == "X") { ?>
                                        <button type="button" class="btn btn-primary" style="width: unset;" onclick="send_payment('<?=$order_idx?>');">결제발송</button>
										<?php } ?>

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
                                        </select>
                                       <a href="javascript:set_status('<?= $order_idx ?>')" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">상태저장</span></a>
										&emsp;<?=$order_r_date?>
										
                                    </td>
                                    <th>상품금액</th>
                                    <td>
										원화계산 : <?php
                                        $total_price = $order_price * homeSetInfo()['baht_thai'];
                                        $discounted_price = $total_price - $used_coupon_money * homeSetInfo()['baht_thai'] - $used_mileage_money * homeSetInfo()['baht_thai'];
                                        ?>
                                        <?= number_format($total_price) ?>원 | 5,000바트
										
                                    </td>
                                </tr>
								
								<tr>
                                        <th>예약 문자발송(알림톡)</th>
                                        <td colspan="3">
                                         <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','UA_5373');">예약접수</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk('<?=$order_no?>','UA_5319');">예약가능</button>
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
									 	</td>                                  
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
										<button class="btn btn-primary" type="button" style="width: unset;" onclick="window.open('/invoice/guide_01/<?=$order_idx?>', 'window_name', 'width=900, height=700, location=no, status=no, scrollbars=yes');">인보이스 보기</button>&emsp;

										<a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
										&emsp;2025-02-08 00:00 &emsp;<BR>
										 <input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:35%" placeholder="이메일"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="invoiceGuide('<?=$order_no?>');">고객 메일발송</button><BR>
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
										<button class="btn btn-primary" type="button" style="width: unset;" onclick="window.open('/voucher/guide/<?=$order_idx?>?type=admin', 'window_name', 'width=900, height=700, location=no, status=no, scrollbars=yes');">바우처 보기</button>&emsp;
										
										<a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
										&emsp;2025-02-08 00:00 &emsp;<BR>
										<input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:35%" placeholder="고객 이메일"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="voucherGuide('<?=$order_no?>');">고객 메일발송</button><BR>
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
										<div class="flex" style="flex-direction: column;">
                                            <?php
                                                foreach ($history_order_list as $history_item) {
                                            ?>
                                                <div class="flex" style="gap: 10px;">
                                                    <p><?=$history_item['user_name']?>(<?=$history_item['user_id']?>) 님이 <?=$history_item['updated_date']?> 수정을 하셨습니다. (아이피: <?=$history_item['ip_address']?>)</p>
                                                    <?php
                                                        if(session()->get("member")["id"] == "admin"){
                                                    ?>
                                                        <a href="javascript:del_history('<?= $history_item['h_idx'] ?>');"><img
                                                            src="/images/admin/common/ico_error.png" alt="에러"/></a>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
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



            <div class="inner cmt_area">
                <form action="" id="frm" name="com_form" class="com_form">
                    <input type="hidden" name="code" id="code" value="order">
                    <input type="hidden" name="r_code" id="r_code" value="order">
                    <input type="hidden" name="r_idx" id="r_idx" value="<?= $order_idx ?>">
                    <div class="comment_box-input flex">
                        <textarea class="cmt_input" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
                        <button type="button" class="btn btn-point btn-lg comment_btn" onclick="fn_comment()">등록
                        </button>
                    </div>
                </form>
                <div id="comment_list"></div>
            </div>
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
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function del_history(h_idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "/AdmMaster/_reservation/del_history",
                type: "POST",
                data: "h_idx[]=" + h_idx,
                error: function (request, status, error) {
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response.result == true) {
                        alert("정상적으로 삭제되었습니다.");
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        return;
                    }
                }
            });
        }
    </script>
	<script>
	function send_payment(order_idx) {
	  if (!order_idx) {
		alert('유효하지 않은 주문 번호입니다.');
		return;
	  }

	  if (!confirm('문자를 발송하시겠습니까?')) {
		return;
	  }

	  $.ajax({
		url: '/ajax/send_payment_sms',
		type: 'POST',
		dataType: 'json',
		data: { order_idx: order_idx },
		success: function(res) {
		  if (res.result === 'OK') {
			alert('문자가 성공적으로 발송되었습니다.');
		  } else {
			alert('발송 실패: ' + (res.message || '알 수 없는 오류'));
		  }
		},
		error: function(xhr, status, error) {
		  console.error('AJAX 오류', error);
		  alert('서버 통신 오류가 발생했습니다.');
		}
	  });
	}
	</script>
	
    <script>
        $(document).on('input', '.number-only', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        function invoiceGuide(order_no)
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
        
        function voucherGuide(order_no)
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
    </script>
	<script>
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
			$("#voucher_price_won").val(won.toLocaleString('en-US'));
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

        function calculateTotal() {
            var depositPrice = document.getElementById('deposit_price').value;
            var confirmPrice = document.getElementById('order_confirm_price').value;

            depositPrice = parseFloat(depositPrice.replace(/,/g, '')) || 0;
            confirmPrice = parseFloat(confirmPrice.replace(/,/g, '')) || 0;

            if (depositPrice > 0 || confirmPrice > 0) {
                var totalPrice = depositPrice + confirmPrice;

                document.getElementById('total_price').value = totalPrice.toLocaleString();
            } else {
                document.getElementById('total_price').value = '';
            }
        }

        document.getElementById('deposit_price').addEventListener('keyup', calculateTotal);
        document.getElementById('deposit_price').addEventListener('change', calculateTotal);
        document.getElementById('order_confirm_price').addEventListener('keyup', calculateTotal);
        document.getElementById('order_confirm_price').addEventListener('change', calculateTotal);

        document.addEventListener('DOMContentLoaded', calculateTotal);


        function del_it() {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "delete",
                type: "POST",
                data: "order_idx[]=<?=$order_idx?>",
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response.result == true) {
                        alert("정상적으로 삭제되었습니다.");
                        location.href = "list";
                        return;
                    } else {
                        alert(response);
                        return;
                    }
                }
            });
        }

        function fn_comment() {

            <? if ($_SESSION["member"]["id"] != "") { ?>
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
            <? } else { ?>
            alert("로그인을 해주세요.");
            <? } ?>
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