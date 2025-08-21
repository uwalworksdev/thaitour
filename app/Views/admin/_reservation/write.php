<?php
    if(session()->get('member')['id'] != 'admin') {
        exit;
    }
?>
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
                <input type=hidden name="order_date" value='<?= $order_date ?>'>
                <input type=hidden name="people_adult_cnt" value='<?= $people_adult_cnt ?>'>
                <input type=hidden name="people_adult_price" value='<?= $people_adult_price ?>'>

                <input type=hidden name="people_kids_cnt" value='<?= $people_kids_cnt ?>'>
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
                <input type=hidden name="order_no" value='<?= $order_no ?>'>
                <input type=hidden name="order_r_date" value='<?= $order_r_date ?>'>
                <input type=hidden name="deposit_date" value='<?= $deposit_date ?>'>
                <input type=hidden name="order_confirm_date" value='<?= $order_confirm_date ?>'>
                <input type=hidden name="paydate" value='<?= $paydate ?>'>


                <div id="contents">
                    <div class="listWrap_noline">
                        <div class="listBottom">
						<!-- 주문자 기본정보 -->
                            <div style="font-size:12pt;margin-bottom:10px">■ 주문정보</div>
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
                                        <?= $product_name ?><br><?= $tours_subject ?>
                                        <input type=hidden name="product_name" value='<?= $product_name ?>'>
                                    </td>
                                    <th>주문번호</th>
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
                                    <th>영문 성(Last Name)</th>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>휴대전화</th>
                                    <td>
                                        <input type="text" id="order_user_mobile" name="order_user_mobile"
                                               value="<?= $order_user_mobile ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                    <th>여행시 현지 연락처(TH)</th>
                                    <td>
                                        <input type="text" id="local_phone" name="local_phone"
                                               value="<?= $local_phone ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
								<tr>
                                    <th>룸타입/프로모션	</th>
                                    <td>
                                          디럭스 Deluxe

                                    </td>
                                    <th>식사</th>
                                    <td>
                                         조식포함 / 조식미포함  
                                    </td>
                                </tr>
								<tr>
                                    <th>체크인/체크아웃</th>
                                    <td>
                                          <?=$start_date?>(<?=get_korean_day($start_date);?>) ~ <?=$end_date?>(<?=get_korean_day($end_date);?>) / <?= $order_day_cnt ?>일
										  &emsp; (객실수 : <?= $order_room_cnt ?> Room)
                                    </td>
                                    <th>객실수/총인원</th>
                                    <td>
                                         2 룸 / 성인 2명 아동 1명
                                    </td>
                                </tr>
                                <tr>
                                    <th>침대구성</th>
                                    <td>
                                          더블베드
                                    </td>
                                    <th>포함사항</th>
                                    <td>
                                         포함사항 내용
                                    </td>
                                </tr>
								
                                <tr >
                                    <th>별도 요청</th>
                                    <td >
                                        <?php
                                        $codes = array_map(fn($code) => "<span>{$code['code_name']}</span>", $fcodes);
                                        echo implode(', ', $codes);
                                        ?>
                                    </td>
									 <th>상품 담당자</th>
                                    <td>
                                        <input type="text" id="manager_name" name="manager_name" placeholder="이름"
                                               value="<?= $row['manager_name'] ?>" class="input_txt" style="width:20%"/>
                                        <input type="text" id="manager_phone" name="manager_phone" placeholder="휴대폰"
                                               value="<?= $row['manager_phone'] ?>" class="input_txt"
                                               style="width:20%"/>
                                        <input type="text" id="manager_email" name="manager_email" placeholder="이메일"
                                               value="<?= $row['manager_email'] ?>" class="input_txt"
                                               style="width:20%"/>
                                    </td> 
                                </tr>
                                <tr style="height:100px">
                                    <th>별도 요청(입력)</th>
                                    <td colspan="3">
                                        <textarea id="custom_req" name="custom_req" class="input_txt"
                                                  style="width:90%;height:80px"><?php echo $custom_req ? $custom_req : $order_memo ?></textarea>
                                    </td>
                                </tr>
								<tr style="height:100px">
                                    <th>중요안내</th>
                                    <td colspan="3">
                                        <textarea id="custom_req" name="custom_req" class="input_txt"
                                                  style="width:90%;height:80px"><?php echo $custom_req ? $custom_req : $order_memo ?></textarea>
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
							
							<!-- 결제 금액 및 상태값 수정 -->
							<br>
							<div style="font-size:12pt;margin-bottom:10px">■ 결제정보</div>
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
                                            $setting    = homeSetInfo();
                                            $extra_cost = 0;
                                
                                            $type_extra_cost = $setting["type_extra_cost"];
                                            
                                            $total_price = 0;
                                            $total_price = $room_op_price_sale + $inital_price * $order_room_cnt;
                                            $total_last_price = $total_price - $used_coupon_money - $used_mileage_money;
                                            if (!empty($setting["extra_cost"])) {
                                                if ($type_extra_cost == "P") {
                                                    $extra_cost = round(intval($total_last_price) * floatval($setting["extra_cost"]) / 100);
                                                } else {
                                                    $extra_cost = $setting["extra_cost"];
                                                }
                                            }

                                        ?>   
                                        <?php
                                            if($price_secret == "Y"){
                                        ?>
                                            0원(<span style="color: red;">비밀특가</span>)
                                        <?php
                                            }else{
                                        ?>
                                        <?= number_format( $room_op_price_sale + $inital_price * $order_room_cnt) ?>원    
                                        -
                                        <?= number_format($used_coupon_money) ?>원(할인쿠폰)
                                        -
                                        <?= number_format($used_mileage_money) ?>원(마일리지사용)
                                        +
                                        <?= number_format( $extra_cost) ?>원
                                        = <?= number_format( $total_price - $used_coupon_money - $used_mileage_money + $extra_cost) ?>
                                        원
                                        <?php } ?> <br>
										바트계산 : 5,891 TH - 0 TH(할인쿠폰) - 0 TH(마일리지사용) + 589원 = 5,980 원
                                    </td>
                                    <th>결제금액</th>
                                    <td>
										<input type="text" id="order_confirm_price" name="order_confirm_price"
                                               value="<?= $order_confirm_price ?>" class="input_txt price"
                                               style="width:150px"/> TH
                                        <input type="text" id="order_confirm_price" name="order_confirm_price"
                                               value="<?= $order_confirm_price ?>" class="input_txt price"
                                               style="width:150px"/> 원
                                        <?php
                                        if ($ResultCode_2 == "3001" && $AuthCode_2 && $CancelDate_2 == "") {
                                            echo "결제완료 ";
                                            echo "<button type='button' onclick='payment_cancel(2);'>결제취소</button>";
                                        }

                                       
                                        ?>&emsp;
										
                                       <a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">금액수정</span></a>
										&emsp;2025-02-08 00:00 
                                    </td>
                                </tr>
                                <tr>
                                    <th>예약현황</th>
                                    <td colspan="3">
                                        <input type="hidden" name="o_order_status" value="<?= $order_status ?>">
                                        <select name="order_status" class="select_txt">
                                            <option value="">결제현황</option>
                                            <option value="W" <?php if ($order_status == "W") {
                                                echo "selected";
                                            } ?>>예약접수
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
                                            </option>
                                        </select>
                                       <a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">상태수정</span></a>
										&emsp;<?=$order_m_date?>
                                    </td>

                                    <!--th>결제금액 취소</th>
                                        <td>
                                            <?= $row_cou['used_coupon_no'] ?> / <?= number_format($used_coupon_money) ?>원 &emsp;
											<a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">카드결제 취소</span></a>
										&emsp;2025-02-08 00:00
                                        </td>
									</tr>
								    <?php if ($used_coupon_idx != "" && isset($order_idx) && $order_idx != "") { ?>
                                    <tr>
                                        <th>쿠폰번호/할인금액</th>
                                        <td>
                                            <?= $row_cou['used_coupon_no'] ?> / <?= number_format($used_coupon_money) ?>원
                                        </td>
                                        <th>사용 포인트</th>
                                        <td>
                                            <?= number_format($used_mileage_money) ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
								    -->
								    <tr>
                                        <th>예약상태 문자발송(알림톡)</th>
                                        <td colspan="3">
                                         <button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">예약접수</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">예약가능</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">예약확정</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">결제대기</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">결제완료</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">예약취소</button>
                                        </td>
                                    </tr>


                                <script>
                                    function payment_send(type) {
                                        var arr = type.split(":");
                                        var order_idx = arr[0];
                                        var type = arr[1];

                                        var amt_type = "";
                                        if (type == "1") amt_type = "선금";
                                        if (type == "2") amt_type = "잔금";

                                        if (!confirm(amt_type + ' 을 결제발송 하시겠습니까?'))
                                            return false;

                                        var message = "";
                                        $.ajax({
                                            url: "/nicepay/ajax.payment_send.php",
                                            type: "POST",
                                            data: {
                                                "order_idx": order_idx,
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

                                
                                <?php if ($order_status == "Y") { ?>
                                    <tr>
                                        <th>부여된마일리지</th>
                                        <td>
                                            <?= $order_mileage ?>P
                                        </td>
                                        <th>결제일시</th>
                                        <td>
                                            <?= $paydate ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                
                                
                                </tbody>

                            </table>
							
							<br>
							<div style="font-size:12pt;margin-bottom:10px">■ 바우처/인보이스xxxxxxxxxxxxx</div>    
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
                                    <th>인보이스 발송xxx</th>
                                    <td>
                                       <select name="order_status" class="select_txt">
                                            <option value="W" <?php if ($order_status == "W") { echo "selected";
                                            } ?>>인보이스 준비
                                            </option>
                                            <option value="G" <?php if ($order_status == "G") { echo "selected";
                                            } ?>>인보이스 발송
                                            </option>
                                        </select>
										<button class="btn btn-primary" style="width: unset;" onclick="window.open('/invoice/hotel_01', 'window_name', 'width=900, height=700, location=no, status=no, scrollbars=yes');">인보이스 보기</button>&emsp;

										<a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
										&emsp;2025-02-08 00:00 &emsp;<BR>
										 <input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:35%" placeholder="이메일"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="">고객 메일발송</button><BR>
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
										<button type="button" class="btn btn-primary" style="width: unset;" onclick="window.open('/voucher/hotel', 'window_name', 'width=900, height=700, location=no, status=no, scrollbars=yes');">바우처 보기</button>&emsp;
										
										<a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
										&emsp;2025-02-08 00:00 &emsp;<BR>
										<input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:35%" placeholder="고객 이메일"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="">고객 메일발송</button><BR>
											   <input type="text" id="order_user_mobile" name="order_user_mobile"
                                               value="<?= $order_user_mobile ?>" class="input_txt" style="width:35%" placeholder="휴대전화"/>
											   <button type="button" class="btn btn-primary" style="width: unset;" onclick="">고객 문자발송</button><BR>
											   <input type="text" id="order_user_email" name="order_user_email"
                                               value="<?= $order_user_email ?>" class="input_txt" style="width:35%" placeholder="고객 이메일"/>
											   <button type="button" class="btn btn btn-danger" style="width: unset;" onclick="">호텔 메일발송</button><BR>
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>

                           
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
                                        <a href="javascript:send_it()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
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