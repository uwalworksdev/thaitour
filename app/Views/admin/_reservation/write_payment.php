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
                    <h2>결제정보</h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="/AdmMaster/_reservation/list_payment?search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>"
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

                <input type=hidden name="payment_idx" id="payment_idx" value='<?= $payment_row['payment_idx'] ?>'>
                <input type=hidden name="order_no" id="order_no" value='<?= $payment_row['order_no'] ?>'>
                <input type=hidden name="partial_cancel_amt" id="partial_cancel_amt" value='0'>
                <input type=hidden name="add_mileage" id="add_mileage" value='<?=$add_mileage?>'>

                <div id="contents">
                    <div class="listWrap_noline">


                        <div class="listBottom">
                            <div style="font-size:12pt;margin-bottom:10px">■ 결제정보<?=$payment_row['product_name']?></div>
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="8%"/>
                                    <col width="10%"/>
                                    <col width="8%"/>
                                    <col width="*"/>
									<!--col width="10%"/-->
                                    <col width="8%"/>
                                    <col width="8%"/>
                                    <col width="8%"/>
                                    <col width="8%"/>
                                    <col width="5%"/>
                                    <col width="8%"/>
                                </colgroup>
                                <tbody>
								<tr>
									<th style="line-height:40px; text-align:center;">결제번호</th>
									<th style="line-height:40px; text-align:center;">예약번호</th>
									<th style="line-height:40px; text-align:center;">예약일자</th>
									<th style="line-height:40px; text-align:center;">취소일자</th>
									<th style="text-align:center;">상품명</th>
									<th style="text-align:center;">결제금액(원)</th>
									<th style="text-align:center;">결제금액(바트)</th>
									<th style="text-align:center;">실결제금액(원)</th>
									<th style="text-align:center;">실결제금액(바트)</th>
									<th style="text-align:center;">결제취소</th>
									<th style="text-align:center;">예약정보</th>
								</tr>

								
                                <?php foreach ($order_row as $order) { ?>								
                                <tr>
                                    <td><?=$payment_row['payment_no']?></td>
                                    <td><?=$order['order_no']?></td>
                                    <td><?=$order['order_date']?></td>
                                    <td><?=$order['CancelDate_1']?></td>
                                    <td><?=$order['product_name']?></td>
									<td style="text-align:right;"><?=number_format($order['order_price'])?></td>
									<td style="text-align:right;"><?=number_format($order['order_price_bath'])?></td>
									<td style="text-align:right;"><?=number_format($order['real_price_won'])?></td>
									<td style="text-align:right;"><?=number_format($order['real_price_bath'])?></td>
									<!--td>-</td-->
									<td style="text-align: center;">
									    <input type="checkbox" class="part_cancel" data-order_no="<?=$order['order_no']?>" data-amt="<?=$order['real_price_won']?>" > 
									    <!--input type="checkbox" class="part_cancel" data-order_no="<?=$order['order_no']?>" data-amt="1000" --> 
									</td>
									<td style="text-align: center;">
									    <button type="button" class="btn" style="width: unset;" onclick="orderView('<?=$order['order_idx']?>');">예약보기</button>
									</td>
                                </tr>
                                <?php } ?>

                                <tr id="part" style="display:none;">
									<td colspan="8" style="text-align:right;">부분취소 금액</td>
									<td colspan="2" style="text-align:right;"><span id="part_amt_txt"></span>원</td>
									<td style="text-align: center;">
									    <button type="button" class="btn" style="width: unset;" onclick="payment_partial_cancel('<?=$payment_row['payment_no']?>','<?=$payment_row['payment_pg']?>');">부분취소</button>
									</td>
                                </tr>								
                                </tbody>

                            </table>
							
							
							
							<!-- 예약금액 및 상태설정 수정 -->
							<br>
							<div style="font-size:12pt;margin-bottom:10px">■ 예약금액 및 상태설정</div>
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
                                        <?=number_format($payment_row['payment_tot'])?>원 | <?=number_format($payment_row['payment_tot']/$order['baht_thai'])?> TH
                                    </td>
                                    <th>결제방법</th>
                                    <td>
										<?=$payment_row['payment_method']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>사용 쿠폰금액</th>
                                    <td>
                                        <?=number_format($payment_row['used_coupon_money'])?> 
                                    </td>
                                    <th>사용 포인트</th>
                                    <td>
										<?=number_format($payment_row['used_point'])?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>실 결제금액</th>
                                    <td>
                                        <?=number_format($payment_row['payment_price'])?>원 
                                    </td>
                                    <th>적립 포인트</th>
                                    <td>
										<?=number_format($add_mileage)?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>예약현황</th>
                                    <td>
                                        <input type="hidden" name="o_order_status" value="<?= $order_status ?>">
                                        <select name="order_status" id="order_status" class="select_txt">
                                            <option value="">주문현황</option>
                                            <option value="W" <?php if ($payment_row['payment_status'] == "W") echo "selected";?> >예약접수</option>
                                            <option value="G" <?php if ($payment_row['payment_status'] == "G" || $payment_row['payment_status'] == "R") echo "selected";?> >결제대기</option>
                                            <option value="Y" <?php if ($payment_row['payment_status'] == "Y") echo "selected";?> >결제완료</option>
                                            <option value="C" <?php if ($payment_row['payment_status'] == "C") echo "selected";?> >주문취소</option>
                                        </select>
                                       <a href="javascript:status_upd()" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt" >상태수정</span></a>
										<?=$payment_row['payment_m_date']?>

										<?php if($payment_row['payment_status'] == "Y") { ?>
                                        <a href="javascript:info_receipt('<?=$payment_row['payment_pg']?>','<?=$payment_row['TID_1']?>')" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt" >영수증</span></a>
										<?php } ?>
										
                                    </td>

                                    <th>결제취소</th>
                                        <td>
										    <input type="hidden" id="cancel_amt_tot" value="<?=$payment_row['payment_price']?>" >
                                            <?=number_format($payment_row['payment_price'])?>원 &emsp;
											<a href="javascript:payment_cancel('<?=$payment_row['payment_no']?>','<?=$payment_row['payment_pg']?>')" class="btn btn-default">
										<span class="glyphicon glyphicon-cog"></span><span class="txt">카드결제 취소</span></a>
										&emsp;<?=$payment_row['payment_c_date']?>
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

								<tr>
                                        <th>주문 문자발송(알림톡)</th>
                                        <td colspan="3">
                                         <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk1('<?= $payment_row['payment_idx'] ?>','TY_1652');">예약접수</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk1('<?= $payment_row['payment_idx'] ?>','TY_2397');">결제대기</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk1('<?= $payment_row['payment_idx'] ?>','TY_1654');">결제완료</button>
										 <button type="button" class="btn btn-primary" style="width: unset;" onclick="allimtalk1('<?= $payment_row['payment_idx'] ?>','TY_1657');">주문취소</button>
                                        </td>
                                    </tr>

    <script>
	function allimtalk1(payment_idx, alimCode)
	{
			if (!confirm('알림톡을 전송 하시겠습니까?'))
				return false;

			var message = "";
			$.ajax({
				url  : "/ajax/ajax_allimtalk_send1",
				type : "POST",
				data : {
					"payment_idx"  : payment_idx,
					"alimCode"     : alimCode
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
function info_receipt(pg, tid) 
{
        let receiptUrl = '';

        switch (pg) {
            case 'INICIS':
            case 'inicis':
                receiptUrl = `https://iniweb.inicis.com/app/publication/apReceipt.jsp?noTid=${tid}`;
                break;
            case 'NICEPAY':
            case 'nicepay':
                receiptUrl = `https://npg.nicepay.co.kr/issue/IssueLoader.do?type=0&TID=${tid}`;
                break;
            default:
                alert('지원하지 않는 PG사입니다.');
                return;
        }

        window.open(receiptUrl, 'receiptPopup', 'width=500,height=700,scrollbars=yes');
}
</script>

                                <script>
								function orderView(idx)
								{
                                         location.href='/AdmMaster/_reservation/write/hotel?search_category=&search_name=&pg=1&order_idx='+idx;									
								}	
								</script>
								
								<script>
								$(document).ready(function () {
									$('.part_cancel').on('change', function () {
										let total = 0;
										$('.part_cancel:checked').each(function () {
											total += parseFloat($(this).data('amt'));
										});

										let limit = parseFloat($('#cancel_amt_tot').val());

										if (total > limit || total == limit) {
											alert('선택한 취소 금액이 결제 금액을 초과했습니다.');
											$(this).prop('checked', false); // 방금 체크한 항목 해제

											// 다시 합계 재계산
											total = 0;
											$('.part_cancel:checked').each(function () {
												total += parseFloat($(this).data('amt'));
											});
										}

										// 금액 텍스트 및 숨은 필드 값 업데이트
										$("#partial_cancel_amt").val(total);
										$("#part_amt_txt").text(total.toLocaleString()); // 천 단위 쉼표 포함

										// 금액이 0이면 숨김
										if (total > 0) {
											$("#part").show();
										} else {
											$("#part").hide();
										}
									});
								});
								</script>

                                <script>
								function status_upd()
								{
									
                                        if (!confirm('상태수정을 하시겠습니까?'))
                                            return false;

                                        var message = "";
                                        $.ajax({
                                            url: "/ajax/ajax_status_upd",
                                            type: "POST",
                                            data: {
                                                "payment_idx"  : $("#payment_idx").val(),
                                                "order_no"     : $("#order_no").val(),
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
										<input type="text" id="order_user_name"   name="order_user_name"   value="<?= $payment_row['user_name'] ?>"   class="input_txt" style="width:15%" placeholder="결제자명"/>(무통장 입금명)
										<input type="text" id="order_user_mobile" name="order_user_mobile" value="<?= $payment_row['user_mobile'] ?>" class="input_txt" style="width:20%" placeholder="휴대전화"/>
										<input type="text" id="order_user_email"  name="order_user_email"  value="<?= $payment_row['user_email'] ?>"  class="input_txt" style="width:20%" placeholder="이메일"/> 
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
							
							
                                
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
            <!--div class="inner cmt_area">
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
                <div id="comment_list"></div-->
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
        function payment_cancel(no, pg) {

			if (!confirm('결제 전체취소를 하시겠습니까?\n\n한번 취소한 자료는 복구할 수 없습니다.'))
                return false;

            let url = "";
            if(pg == "NICEPAY") url = "/nicepay_refund";	
            if(pg == "INICIS")  url = "/inicis_refund";	
            var message = "";
            $.ajax({

                url: url,
                type: "POST",
                data: {
                    "payment_no" : no 
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
		
		function payment_partial_cancel(no, pg) {
			if (!confirm('부분 취소를 하시겠습니까?\n\n한번 취소한 자료는 복구할 수 없습니다.'))
				return false;

			let order_no_arr = [];
			let amt_arr      = [];
			let cancel_amt   = 0;

			$('.part_cancel:checked').each(function () {
				const order_no = $(this).data('order_no');
				const amt = parseFloat($(this).data('amt'));
				cancel_amt += amt;

				order_no_arr.push(order_no);
				amt_arr.push(amt);
			});

			if (order_no_arr.length === 0) {
				alert("부분취소할 항목을 선택하세요.");
				return false;
			}

			let url = "";
			if (pg === "NICEPAY") url = "/nicepay_partial_refund";
			if (pg === "INICIS")  url = "/inicis_partial_refund";

			$.ajax({
				url: url,
				type: "POST",
				data: {
					"payment_no"   : no,
					"cancel_amt"   : cancel_amt,
					"order_no"     : order_no_arr,
					"amt"          : amt_arr,
					"add_mileage"  : $("#add_mileage").val()	
				},
				dataType: "json",
				success: function (data) {
					alert(data.message);
					location.reload();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + "\nmessage = " + request.responseText + "\nerror = " + error);
				}
			});
		}
    </script>

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