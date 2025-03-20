<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<link rel="stylesheet" type="text/css" href="/css/admin/popup.css">

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<div id="datepicker"></div>
<script type="text/javascript">
    function checkForNumber(str) {
        var key = event.keyCode;
        var frm = document.frm1;
        if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
            (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
            event.returnValue = false;
        }
    }
</script>

<style>
    .container_date {
        display: flex; /* 가로 정렬 */
    }

    .order_btn {
        cursor: pointer;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

	.center-checkbox {
		display: flex;
		flex-direction: row;  /* 가로 방향 정렬 */
		justify-content: center; /* 수평 중앙 정렬 */
		align-items: center; /* 수직 중앙 정렬 */
		gap: 5px; /* 체크박스 간 간격 조정 (필요에 따라 변경) */
	}
</style>

<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>호텔객실 요금정보 </h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_hotel/write_price?product_idx=<?=$product_idx?>" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                        </li>
                        <?php if ($product_idx) { ?>
                            <li><a href="javascript:all_update()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            </li>
                        <?php } else { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
            <!-- // inner -->

        </header>
        <!-- // headerContainer -->

        <form name="chargeForm" id="chargeForm" method="post">
            <input type=hidden name="product_idx" id="product_idx" value="<?= $product_idx ?>">
            <input type=hidden name="g_idx"       id="g_idx"       value="<?= $g_idx ?>">
            <input type=hidden name="roomIdx"     id="roomIdx"     value="<?= $roomIdx ?>">
			
            <input type=hidden name="o_soldout" value="" id="o_soldout">
            <input type=hidden name="chk_idx"   value="" id="chk_idx">
            <input type=hidden name="updateData"   value="" id="updateData">

			<div id="contents">
                <div class="listWrap_noline">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="10%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                            <tr>
                                <th>호텔명</th>
                                <td>
                                    <?= $product_name ?>
                                </td>
                            </tr>
                            <tr>
                                <th>룸타입(룸명칭)</th>
                                <td>
                                    <?= $room_type ?>(<?= $room_name ?>)
                                </td>
                            </tr>
                            <tr>
                                <th>날짜지정</th>
                                <td>
                                    <div class="container_date flex__c" style="margin: 0">
                                        <div style="text-align:left;margin-right:20px;">  
                                            <?= $s_date ?> ~ <?= $e_date ?>
                                        </div>

										<div style="text-align:left;">
											<input type="text" name="s_date" id="s_date" value="<?=$s_date?>" style="text-align: center;background: white; width: 120px;" readonly> ~
											<input type="text" name="e_date" id="e_date" value="<?=$e_date?>" style="text-align: center;background: white; width: 120px;" readonly>
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="inqCharge" class="btn btn-primary">조회</a>
                                        </div>

                                        <div style="text-align:left;">
											<input type="text" name="days" id="days" value="" numberonly="true" style="text-align:center;background: white; width: 70px;">일
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="addCharge" class="btn btn-primary">추가</a>  
                                        </div>

                                        <!--div style="text-align:left;">
											<input type="checkbox" class="end_yn" value="일" >일
											<input type="checkbox" class="end_yn" value="월" >월
											<input type="checkbox" class="end_yn" value="화" >화
											<input type="checkbox" class="end_yn" value="수" >수
											<input type="checkbox" class="end_yn" value="목" >목
											<input type="checkbox" class="end_yn" value="금" >금
											<input type="checkbox" class="end_yn" value="토" >토
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="endCharge" class="btn btn-primary">마감</a>  
                                        </div-->
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>일괄적용(단위: 바트)</th>
                                <td>
                                    <div class="container_date flex__c" style="margin: 0">
                                        <div style="text-align:left;">
											<input type="checkbox" class="priceAll" id="checkAll" >전체선택
											<input type="checkbox" class="priceDow" value="일" >일
											<input type="checkbox" class="priceDow" value="월" >월
											<input type="checkbox" class="priceDow" value="화" >화
											<input type="checkbox" class="priceDow" value="수" >수
											<input type="checkbox" class="priceDow" value="목" >목
											<input type="checkbox" class="priceDow" value="금" >금
											<input type="checkbox" class="priceDow" value="토" >토
										</div>
                                        <div style="margin:10px;text-align:left;" class="product-row">
											기본가: <input type="text" name="dowPrice1" id="dowPrice1" value="0" numberonly="true" style="text-align:right;background: white; width: 150px;">
											컨택가: <input type="text" name="dowPrice2" id="dowPrice2" class="cost"   value="0" numberonly="true" style="text-align:right;background: white; width: 150px;">
											수익가: <input type="text" name="dowPrice3" id="dowPrice3" class="profit" value="0" numberonly="true" style="text-align:right;background: white; width: 150px;">
											상춤가: <input type="text" name="dowPrice4" id="dowPrice4" class="price " value="0" numberonly="true" style="text-align:right;background: white; width: 150px;" readonly>
											Extra베드: <input type="text" name="dowPrice5" id="dowPrice5" class="bed" value="0" numberonly="true" style="text-align:right;background: white; width: 150px;">
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="dowCharge" class="btn btn-primary">적용</a>  
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <p><span style="font-weight: bold; color: red;">※</span> 수정되는 것은 자동으로 체크됩니다. 마감, 지난 날짜, 수정된 것도 체크됩니다. <span style="color:red;">체크를 풀고 저장하면, 전체 저장 시 수정됩니다.</span></p>
                    <div class="listBottom">
         				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
									<colgroup>
									<col width="5%">
									<col width="5%">
									<col width="*">
									<col width="9%">
									<col width="9%">
									<col width="9%">
									<col width="8%">
									<col width="9%">
									<col width="9%">
									<col width="4%">
									<col width="10%">
									<col width="10%">
									<col width="8%">
									</colgroup>
					                <tbody id="charge">
										<tr style="height:40px">
											<td style="text-align:center">
												선택<input type="checkbox" name="upd_chk" class="upd_yn" value="Y"  >
											</td>
											<td style="text-align:center">
												수정불가
											</td>
											<td style="text-align:center">
												베드타입
											</td>
											<td style="text-align:center">
												일자
											</td>
 											
											<td style="text-align:center">
												기본가
												<input type="checkbox" name="" id="price1_all">전체
											</td>
											<td style="text-align:center">
												컨택가
												<input type="checkbox" name="" id="price2_all">전체
											</td>
											<td style="text-align:center">
												수익가
												<input type="checkbox" name="" id="price3_all">전체
											</td>
											<td style="text-align:center">
												상품가
											</td>
											<td style="text-align:center">
												Extra베드
												<input type="checkbox" name="" id="price4_all">전체
											</td>
											<td style="text-align:center">
												마감
											</td>
											<td style="text-align:center">
												등록일
											</td>
											<td style="text-align:center">
												수정일
											</td>
											<td style="text-align:center">
												처리
											</td>
										</tr>
                                        <?php $com_date = ''; // 이전 날짜 저장 변수 ?>
										<?php foreach ($roresult as $item): ?>
												<tr style="height:40px">
<td>
    <label class="center-checkbox">
        <input type="checkbox" name="upd_chk" class="upd_chk" value="Y">
    </label>
</td>
<td>
    <label class="center-checkbox">
        <input type="checkbox" name="upd_yn" class="upd_yn" data-idx="<?= $item['idx'] ?>" value="Y" 
            <?php if($item['upd_yn'] == "Y") echo "checked";?> >
    </label>
</td>
													<td style="text-align:center"><?=$item['bed_type']?></td>
													
													<?php if($com_date != $item['goods_date']) { ?>
													<?php $com_date = $item['goods_date']?>
													<td style="text-align:center"><?=$item['goods_date']?> [<?=$item['dow']?>]</td>
													<?php } else { ?>
													<td></td>	
													<?php } ?>
													<td style="text-align:center">
														<input type="hidden" name="idx[]" id="idx" value="<?=$item['idx']?>">
														<input type="hidden" name="goods_date[]" id="goods_date_<?=$item['idx']?>" value="<?=$item['goods_date']?>">
														<input type="text" name="goods_price1[]" id="price1_<?=$item['idx']?>" value="<?=number_format($item['goods_price1'])?>" class="price goods_price input_txt" numberonly="true" style="text-align:right;">
													</td>
													<td style="text-align:center">
														<input type="text" name="goods_price2[]" id="price2_<?=$item['idx']?>" value="<?=number_format($item['goods_price2'])?>" class="price goods_price input_txt" numberonly="true" style="text-align:right;">
													</td>
													<td style="text-align:center">
														<input type="text" name="goods_price3[]" id="price3_<?=$item['idx']?>" value="<?=number_format($item['goods_price3'])?>" class="price goods_price input_txt" numberonly="true" style="text-align:right;">
													</td>
													<td style="text-align:center">
													    <?=number_format($item['goods_price2'] + $item['goods_price3'])?>
													</td>
													<td style="text-align:center">
														<input type="text" name="goods_price5[]" id="price5_<?=$item['idx']?>" value="<?=number_format($item['goods_price5'])?>" class="price goods_price input_txt" numberonly="true" style="text-align:right;">
													</td>
													<td style="text-align:center;">
														<input type="checkbox" class="use_yn" name="use_yn[]" id="use_yn_<?=$item['idx']?>" data-idx= "<?=$item['idx']?>" value="<?=$item['goods_date']?>" <?php if($item['use_yn'] == "N") echo "checked";?> >
													</td> 
													<td style="text-align:center;"><?=$item['reg_date']?></td> 
													<td style="text-align:center;"><?=$item['upd_date']?></td> 
													<td style="text-align:center;">
													    <?php if($item['upd_yn'] != "Y") { ?>
														<button type="button" class="chargeUpdate" value="<?=$item['idx']?>">수정</button>
														<?php } ?>
														<!--button type="button" class="chargeDelete" value="<?=$item['idx']?>">삭제</button-->
													</td> 
												</tr>
					                    <?php endforeach; ?>

									</tbody>
								</table>
			        </div>
                    <!-- // listBottom -->
					<script>
					$(document).ready(function () {
						$(".upd_yn").change(function () {
							let isChecked = $(this).prop("checked") ? "Y" : "N"; // 체크 여부 확인
							let idx = $(this).data("idx"); // 해당 행의 ID 가져오기

							if (!idx) {
								alert("idx 값이 없습니다!");
								return;
							}

							$.ajax({
								url: "/ajax/update_upd_yn",
								type: "POST",
								data: { 
									     idx    : idx, 
										 upd_yn : isChecked 
									  },
								dataType: "json",
								async: false,
								cache: false,
								success: function(data, textStatus) {
									var message  = data.message;
									alert(message);
									location.reload();
								},
								error:function(request,status,error){
									alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
								}
							});							
						});
					});
					</script>

					<script>
						$(document).ready(function () {
							// 전체 선택 체크박스 클릭 이벤트
							$('#checkAll').on('change', function () {
								$('.priceDow').prop('checked', $(this).prop('checked'));
							});

							// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
							$('.priceDow').on('change', function () {
								$('#checkAll').prop('checked', $('.priceDow:checked').length === $('.priceDow').length);
							});
						});
					</script>

                    <script>
						// 입력값이 변경될 때 판매가 자동 계산 (이벤트 위임)
						$(document).on('input', '.cost, .profit, .bed', function() {
							let row = $(this).closest('.product-row'); // 현재 행 찾기
							let cost = Number(row.find('.cost').val()) || 0;
							let profit = Number(row.find('.profit').val()) || 0;
							let bed = Number(row.find('.bed').val()) || 0;
							row.find('.price').val(cost + profit + bed); // 판매가 자동 계산
						});
		            </script>
					
					<script>
						$("#inqCharge").one("click", function () {
							$("#in_s_date").val($("#s_date").val());
							$("#in_e_date").val($("#e_date").val());
							$("#priceForm").submit();
						});

						$('#price_all').on('click', function() {
							if ($(this).is(':checked')) {
								var price = $('input[name="price[]"]').first().val();
								$('.price').val(price);
							} else {
								location.reload();
                            }
						});

						$('#price1_all').on('click', function() {
							if ($(this).is(':checked')) {
								var price = $('input[name="caddy_fee[]"]').first().val();
								$('.goods_caddy').val(price);
							} else {
								location.reload();
                            }
						});

						$('#price2_all').on('click', function() {
							if ($(this).is(':checked')) {
								var price = $('input[name="cart_pie_fee[]"]').first().val();
								$('.goods_cart').val(price);
							} else {
								location.reload();
                            }
						});

					</script>

					<script>
						$("#allCharge").one("click", function () {
							location.href='/AdmMaster/_tourRegist/list_room_price?product_idx='+$("#product_idx").val();
						});
					</script>

					<script>
						$("#addCharge").one("click", function () {
								if (!confirm("일자를 추가 하시겠습니까?"))
									return false;

								var product_idx = $("#product_idx").val(); 
								var g_idx       = $("#g_idx").val(); 
								var rooms_idx   = $("#roomIdx").val();	
								var days        = $("#days").val();
								//alert(product_idx+'-'+g_idx+'-'+rooms_idx+'-'+days);
								
								$.ajax({

									url: "/ajax/hotel_price_add",
									type: "POST",
									data: {

											"product_idx" : product_idx,
											"g_idx"       : g_idx, 
											"rooms_idx"   : rooms_idx,	
											"days"        : days 
									      },
									dataType: "json",
									async: false,
									cache: false,
									success: function(data, textStatus) {
										var message = data.message;
										var s_date  = data.s_date;
										var e_date  = data.e_date;
										alert(message);
										location.href='/AdmMaster/_tourRegist/list_room_price?product_idx='+$("#product_idx").val()+'&g_idx='+$("#g_idx").val()+'&roomIdx='+$("#roomIdx").val();
									},
									error:function(request,status,error){
										alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
									}
								});
						});

						$("#endCharge").one("click", function () {
								if (!confirm("요일 마감을 처리 하시겠습니까?"))
									return false;

							    // 체크된 값 가져오기
							    var dow_val = "";

								const checkedValues = $('.end_yn:checked') // 체크된 요소만 선택
								  .map(function () {
								    return "'"+$(this).val()+"'"; // 각 체크박스의 value 값 반환
								 })
								.get(); // 결과를 배열로 변환

								// 결과 출력
							    if(checkedValues) dow_val = checkedValues.join(', ');
								
								$.ajax({

									url: "/ajax/golf_dow_update",
									type: "POST",
									data: {
											"g_idx"   : $("#g_idx").val(),
											"dow_val" : dow_val 
										  },
									dataType: "json",
									async: false,
									cache: false,
									success: function(data, textStatus) {
										var message = data.message;
										alert(message);
										location.reload();
									},
									error:function(request,status,error){
										alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
									}
								});

						});
					</script>

					<script>
                    $(document).ready(function () {
                        $('#dowCharge').click(function () {
								if (!confirm("금액 일괄적용을 처리 하시겠습니까?"))
									return false;

							    // 체크된 값 가져오기
							    var dow_val = "";

								const checkedValues = $('.priceDow:checked') // 체크된 요소만 선택
								  .map(function () {
								    return "'"+$(this).val()+"'"; // 각 체크박스의 value 값 반환
								 })
								.get(); // 결과를 배열로 변환

								// 결과 출력
							    if(checkedValues) {
								     dow_val = checkedValues.join(', ');
                                }

                                if(dow_val == "") {
								     alert('적용할 요일을 선택하세요.');
									 return false;
                                }

							    if($("#dowPrice1").val() < "1") {
								     alert('기본가를 입력하세요.');
									 $("#dowPrice1").focus();
									 return false;
                                }

							    if($("#dowPrice2").val() < "1") {
								     alert('컨택가를 입력하세요.');
									 $("#dowPrice2").focus();
									 return false;
                                }

							    if($("#dowPrice3").val() < "1") {
								     alert('수익가를 입력하세요.');
									 $("#dowPrice3").focus();
									 return false;
                                }

								if($("#dowPrice5").val() < "1") {
								     alert('Extra베드가를 입력하세요.');
									 $("#dowPrice5").focus();
									 return false;
                                }

								$.ajax({

									url: "/ajax/hotel_dow_charge",
									type: "POST",
									data: {
										     "s_date"       : $("#s_date").val(),
										     "e_date"       : $("#e_date").val(),	
											 "dow_val"      : dow_val,
											 "product_idx"  : $("#product_idx").val(),
											 "g_idx"        : $("#g_idx").val(),
											 "roomIdx"      : $("#roomIdx").val(),
											 "goods_price1" : $("#dowPrice1").val(),
											 "goods_price2" : $("#dowPrice2").val(),
											 "goods_price3" : $("#dowPrice3").val(),
											 "goods_price4" : $("#dowPrice4").val(),
											 "goods_price5" : $("#dowPrice5").val()
										  },
									dataType: "json",
									async: false,
									cache: false,
									success: function(data, textStatus) {
										var message = data.message;
										alert(message);
										location.reload();
									},
									error:function(request,status,error){
										alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
									}
								});

						});
                    });
					</script>

					<script>
                        $(function () {

                            $("#s_date").datepicker({
                                dateFormat: 'yy-mm-dd',
                                showOn: "both",
                                buttonImage: "/images/admin/common/date.png",
                                buttonImageOnly: true,
                                closeText: '닫기',
                                currentText: '오늘',
                                prevText: '이전',
                                nextText: '다음',
                                yearRange: "c:c+10",
                                minDate: new Date(),
                                maxDate: "+99Y",
                                onClose: function (selectedDate) {
                                    $("#e_date").datepicker("option", "minDate", selectedDate);
                                },
                                beforeShow: function (input) {
                                    setTimeout(function () {
                                        var buttonPane = $(input)
                                            .datepicker("widget")
                                            .find(".ui-datepicker-buttonpane");
                                        var btn = $('<button class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                                        btn.unbind("click").bind("click", function () {
                                            $.datepicker._clearDate(input);
                                        });
                                        btn.appendTo(buttonPane);
                                    }, 1);
                                }
                            });


                            $("#e_date").datepicker({
                                showButtonPanel: true
                                , onClose: function (selectedDate) {
                                    // To 날짜 선택기의 최소 날짜를 설정
                                    $("#s_date").datepicker("option", "maxDate", selectedDate);
                                }
                                , beforeShow: function (input) {
                                    setTimeout(function () {
                                        var buttonPane = $(input)
                                            .datepicker("widget")
                                            .find(".ui-datepicker-buttonpane");
                                        //var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                        btn.unbind("click").bind("click", function () {
                                            $.datepicker._clearDate(input);
                                        });
                                        btn.appendTo(buttonPane);
                                    }, 1);
                                }
                                , dateFormat: 'yy-mm-dd'
                                , showOn: "both"
                                , yearRange: "c:c+30"
                                , buttonImage: "/images/admin/common/date.png"
                                , buttonImageOnly: true
                                , closeText: '닫기'
                                , currentText: '오늘' // 오늘 버튼 텍스트 설정
                                , prevText: '이전'
                                , nextText: '다음'
                                , minDate: new Date() 
                                , maxDate: "+99Y"
                            });
                        });
                        
                    </script>

                    <script>
                        // 동적으로 추가된 input 요소에 콤마 적용 - 이벤트 위임 사용
                        $(document).on('input', '.input_txt', function () {
                            var value = $(this).val().replace(/,/g, ''); // 기존 콤마 제거

                            if (!isNaN(value) && value !== '') {  // 숫자인 경우에만 처리
                                var formattedValue = Number(value).toLocaleString('en');  // 콤마 추가
                                $(this).val(formattedValue);  // 값 업데이트
                            }
                        });

                        $(document).on('input', '.only_number', function () {
                            var value = $(this).val();
                            $(this).val(value.replace(/[^0-9]/g, '')); 
                        });
                    </script>

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">

                                <a href="/AdmMaster/_hotel/write_price?product_idx=<?=$product_idx?>" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                                <?php if ($product_idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:all_update();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">수정</span></a>
                                    <!--a href="#" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a-->
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- // listWrap -->

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_tourRegist/list_room_price?product_idx='.$product_idx.'&g_idx='.$g_idx.'&roomIdx='.$roomIdx .'&s_date='.$s_date.'&e_date='.$e_date) . $search_val . "&pg=") ?>

            </div>
            <!-- // contents -->
        </form>
    </div><!-- 인쇄 영역 끝 //-->
</div>
<!-- // container -->

			<script>
			$(document).ready(function() {
				// 차량정보 확인버튼 클릭 이벤트
                $(".chargeUpdate").click(function() {

					if (!confirm("가격정보를 수정 하시겠습니까?"))
						 return false;

					var idx      = $(this).val();
                    var use_yn   = ""; 
					if ($("#use_yn_"+idx).prop('checked')) {
						var use_yn = "N";
                    }

					$.ajax({

						url: "/ajax/room_price_update",
						type: "POST",
						data: {

								"idx"           : idx,
								"goods_price1"  : $("#price1_"+idx).val(),
								"goods_price2"  : $("#price2_"+idx).val(),
								"goods_price3"  : $("#price3_"+idx).val(),
								"goods_price4"  : $("#price4_"+idx).val(),
								"use_yn"        : use_yn 

						},
						dataType: "json",
						async: false,
						cache: false,
						success: function(data, textStatus) {
							var message  = data.message;
							alert(message);
							location.reload();
						},
						error:function(request,status,error){
							alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
						}
					});
				});

                $(".chargeOpen").click(function() {

					if (!confirm("가격정보를 오픈 하시겠습니까?"))
						 return false;

					var idx      = $(this).val();
					var message  = "";
					$.ajax({

						url: "/ajax/ajax.open_update.php",
						type: "POST",
						data: {

								"charge_idx" : idx 

						},
						dataType: "json",
						async: false,
						cache: false,
						success: function(data, textStatus) {
							message  = data.message;
							alert(message);
							location.reload();
						},
						error:function(request,status,error){
							alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
						}
					});
				});

                $(".chargeClose").click(function() {

					if (!confirm("가격정보를 마감 하시겠습니까?"))
						 return false;

					var idx      = $(this).val();
					var message  = "";
					$.ajax({

						url: "/ajax/ajax.close_update.php",
						type: "POST",
						data: {

								"charge_idx" : idx 

						},
						dataType: "json",
						async: false,
						cache: false,
						success: function(data, textStatus) {
							message  = data.message;
							alert(message);
							location.reload();
						},
						error:function(request,status,error){
							alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
						}
					});
				});
			});			
            </script>

			<script>
			$(document).ready(function() {
				// 차량정보 삭제버튼 클릭 이벤트
                $(".chargeDelete").click(function() {

					if (!confirm("가격정보를 삭제 하시겠습니까?"))
						 return false;

					var idx      = $(this).val();
					var message  = "";
					$.ajax({

						url: "/ajax/golf_price_delete",
						type: "POST",
						data: {

								"idx" : idx

						},
						dataType: "json",
						async: false,
						cache: false,
						success: function(data, textStatus) {
							message  = data.message;
							location.reload();
						},
						error:function(request,status,error){
							alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
						}
					});
				});
			});			
            </script>

            <script>
            function all_update()
			{
				
						let updateData = "";

						$(".use_yn").each(function() {
							let idx;  // 블록 바깥에서 선언
							
							if ($(this).is(":checked")) {
								idx = $(this).data("idx") + ':N'; // data-idx 값 가져오기
							} else {
								idx = $(this).data("idx") + ':'; // data-idx 값 가져오기
							}

							if (updateData === "") {
								updateData += idx;
							} else {   
								updateData += '|' + idx;	
							}   
						});

						$("#updateData").val(updateData);
						
  						let f = document.chargeForm;

						let url        = "/ajax/hotel_price_pageupdate"
						let price_data = $(f).serialize();
						$.ajax({
							type: "POST",
							data: price_data,
							url: url,
							cache: false,
							async: false,
							success: function (data, textStatus) {
								let message = data.message;
								alert(message);
								location.reload();
							},
							error: function (request, status, error) {
								alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
							}
						});				
			}
			
			function send_it(idx)
			{
						var o_soldout = [];
						var chk_idx   = "";

						// 선택된 체크박스의 값을 배열에 추가
						$(".use_yn:checked").each(function () {
							o_soldout.push($(this).val());
							chk_idx += $(this).data("idx")+':'+'N,';
						});
 
                        $('.use_yn:not(:checked)').each(function () {
							chk_idx += $(this).data("idx")+':'+'Y,';
						});

                        $("#o_soldout").val(o_soldout.join("||"));
                        $("#chk_idx").val(chk_idx);
 
  						let f = document.chargeForm;

						let url = "/ajax/golf_price_allupdate"
						let price_data = $(f).serialize();
						$.ajax({
							type: "POST",
							data: price_data,
							url: url,
							cache: false,
							async: false,
							success: function (data, textStatus) {
								let message = data.message;
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
				function go_list() {
					window.location.href = "AdmMaster/_hotel/write?search_category=&search_txt=&pg=&product_idx=<?=$product_idx?>";
				}
			</script>

        <form name="priceForm" id="priceForm" method="get" action="/AdmMaster/_tourRegist/list_room_price">
            <input type="hidden" name="product_idx" value='<?= $product_idx ?>' >
            <input type="hidden" name="g_idx"       value="<?= $g_idx ?>" >
            <input type="hidden" name="roomIdx"     value="<?= $roomIdx ?>">
			<input type="hidden" name="s_date"      value="" id="in_s_date" >
			<input type="hidden" name="e_date"      value="" id="in_e_date" >
        </form>

<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>