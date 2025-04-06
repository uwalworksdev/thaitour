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

</style>

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
	
	.allUpdate {
		border: 2px solid red;  /* 빨간 테두리 */
		background-color: white; /* 배경 흰색 */
		color: red; /* 글자색 빨강 */
		padding: 8px 16px; /* 내부 여백 */
		font-size: 14px; /* 글자 크기 */
		font-weight: bold; /* 글자 굵기 */
		border-radius: 5px; /* 모서리 둥글게 */
		cursor: pointer; /* 마우스 오버 시 손 모양 */
		transition: all 0.3s ease; /* 부드러운 애니메이션 */
	}

	.allUpdate:hover {
		background-color: red; /* 마우스 오버 시 배경 빨강 */
		color: white; /* 글자색 흰색 */
	}

	div.listBottom table.mem_detail tbody td {
		padding: 5px 15px !important;
	}
</style>

<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>골프 요금정보 </h2>
                <div class="menus">
                    <ul>
                        <li><a href="write_golf_price?product_idx=<?=$product_idx?>" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                        </li>
                        <?php if ($product_idx) { ?>
                            <li><a href="javascript:send_it('<?=$o_idx?>')" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            </li>
                            <!--li><a href="#" class="btn btn-default"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                            </li-->
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
            <input type=hidden name="product_idx" value='<?= $product_idx ?>' id="product_idx">
            <input type=hidden name="o_idx" value='<?= $o_idx ?>' id='o_idx'>
            <input type=hidden name="o_soldout" value='' id='o_soldout'>
            <input type=hidden name="chk_idx"   value='' id='chk_idx'>

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
                                <th>상품명</th>
                                <td>
                                    <?= $product_name ?>
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
											<input type="text" name="s_date" id="s_date" value="" style="text-align: center;background: white; width: 120px;" readonly> ~
											<input type="text" name="e_date" id="e_date" value="" style="text-align: center;background: white; width: 120px;" readonly>
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="inqCharge" class="btn btn-primary">조회</a>
                                        </div>

                                        <!--div style="text-align:left;">
											<input type="text" name="a_date" id="a_date" value="" style="text-align: center;background: white; width: 120px;" readonly>일 까지
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="addCharge" class="btn btn-primary">추가</a>  
                                        </div-->

                                        <div style="text-align:left;">
											<input type="checkbox" class="end_all" value="" >전체
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
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>일괄적용</th>
                                <td>
                                    <div class="container_date flex__c" style="margin: 0">
                                        <div style="text-align:left;">
											<input type="checkbox" class="priceAll" value="" >전체
											<input type="checkbox" class="priceDow" value="일" >일
											<input type="checkbox" class="priceDow" value="월" >월
											<input type="checkbox" class="priceDow" value="화" >화
											<input type="checkbox" class="priceDow" value="수" >수
											<input type="checkbox" class="priceDow" value="목" >목
											<input type="checkbox" class="priceDow" value="금" >금
											<input type="checkbox" class="priceDow" value="토" >토
										</div>
                                        <div style="margin:10px;text-align:left;">
											주간 <input type="text" name="dowPrice_1" id="dowPrice_1" value="0" numberonly="true" style="text-align:right;background: white; width: 100px;"> 
											오후 <input type="text" name="dowPrice_2" id="dowPrice_2" value="0" numberonly="true" style="text-align:right;background: white; width: 100px;"> 
											야간 <input type="text" name="dowPrice_3" id="dowPrice_3" value="0" numberonly="true" style="text-align:right;background: white; width: 100px;"> 단위(바트)
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

                    <p><span style="font-weight: bold; color: red;">※</span> 수정불가로 설정되면 가격적용시 수정 되지않습니다. <span style="color:red;">수정가능으로 저장하면, 가격 적용시 수정됩니다.</span>
					<!--button type="button" class="allUpdate" >일괄수정</button-->

						<select id="list_rows" name="list_rows" id="list_rows" class="input_select" style="width: 80px" onchange="submitForm();">
							<option value="30"  <?= ($g_list_rows == 30)  ? 'selected' : '' ?>>30개</option>
							<option value="50"  <?= ($g_list_rows == 50)  ? 'selected' : '' ?>>50개</option>
							<option value="100" <?= ($g_list_rows == 100) ? 'selected' : '' ?>>100개</option>
							<option value="200" <?= ($g_list_rows == 200) ? 'selected' : '' ?>>200개</option>
							<option value="500" <?= ($g_list_rows == 500) ? 'selected' : '' ?>>500개</option>
							<option value="900" <?= ($g_list_rows == 900) ? 'selected' : '' ?>>900개</option>
						</select>
                        <a href="#!" id="changeN" class="btn btn-primary1" style="margin-left:20px">수정불가 설정</a>  
                        <a href="#!" id="changeY" class="btn btn-primary"  style="margin-left:10px">수정가능 설정</a>  
                        <a href="#!" id="changeE" class="btn btn-primary"  style="margin-left:10px">일괄 마감처리</a>  
					
					</p>
				
                    <div class="listBottom">
         				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
									<colgroup>
									<col width="5%">
									<col width="*">
									<col width="10%">
									<col width="20%">
									<!--col width="15%">
									<col width="15%"-->
									<col width="10%">
									<col width="10%">
									<col width="10%">
									<col width="20%">
									</colgroup>
					                <tbody id="charge">
										<tr style="height:40px">
											<td style="text-align:center">
												<input type="checkbox" name="upd_all" class="upd_all" value="Y"  >
											</td>
											<td style="text-align:center">
												일자
											</td>
											<td style="text-align:center">
												홀수
											</td>
											<td style="text-align:center">
												주간/오후/야간
											</td>
											<!--td style="text-align:center">
												주간가격(원)
											</td>
											<td style="text-align:center">
												야간가격(원)
											</td-->
											<td style="text-align:center">
												마감
												<input type="checkbox" name="" id="use_all">전체 
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

										<?php foreach ($roresult as $item): ?>
										        <?php if($item['upd_yn'] == "Y") { ?>
												<tr class="yes" style="height:40px">
												<?php } else { ?>
												<tr class="no" style="height:40px"-->
												<?php } ?>
													<td>
														<label class="center-checkbox">
															<!--input type="checkbox" name="upd_chk" class="upd_chk <?=$item['dow']?>" data-idx="<?= $item['idx'] ?>" <?php if($item['upd_yn'] == "Y") echo "checked";?> value="Y"-->
															<input type="checkbox" name="upd_chk" class="upd_chk <?=$item['dow']?>" data-idx="<?= $item['idx'] ?>"  value="Y">
														</label>
													</td>
												
													<td style="text-align:center"><?=$item['goods_date']?> [<?=$item['dow']?>]</td>
													<td style="text-align:center"><?=$item['goods_name']?></td>
													<td style="text-align:center">
														<input type="hidden" name="idx[]" id="idx" value="<?=$item['idx']?>">
														<input type="hidden" name="goods_date[]" id="goods_date_<?=$item['idx']?>" value="<?=$item['goods_date']?>">
														<input type="text" name="price_1[]" id="price_1_<?=$item['idx']?>" value="<?=number_format($item['price_1'])?>" class="price goods_price input_txt" numberonly="true" style="text-align:right;width:30%;">
														<input type="text" name="price_2[]" id="price_2_<?=$item['idx']?>" value="<?=number_format($item['price_2'])?>" class="price goods_price input_txt" numberonly="true" style="text-align:right;width:30%;">
														<input type="text" name="price_3[]" id="price_3_<?=$item['idx']?>" value="<?=number_format($item['price_3'])?>" class="price goods_price input_txt" numberonly="true" style="text-align:right;width:30%;">
													</td>
													<!--td style="text-align:center">
														<input type="checkbox" class="day_yn" name="day_yn[]" id="day_yn_<?=$item['idx']?>" data-idx= "<?=$item['idx']?>" value="N" <?php if($item['day_yn'] == "N") echo "checked";?> >
														<input type="text" name="day_price[]" id="day_price_<?=$item['idx']?>" value="<?=number_format($item['day_price'])?>" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right;width:80%;">
													</td>
													<td style="text-align:center">
														<input type="checkbox" class="night_yn" name="night_yn[]" id="night_yn_<?=$item['idx']?>" data-idx= "<?=$item['idx']?>" value="N" <?php if($item['night_yn'] == "N") echo "checked";?> >
														<input type="text" name="night_price[]" id="night_price_<?=$item['idx']?>" value="<?=number_format($item['night_price'])?>" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right;width:80%;">
													</td-->
													<td style="text-align:center;">
														<input type="checkbox" class="use_yn" name="use_yn[]" id="use_yn_<?=$item['idx']?>" data-idx= "<?=$item['idx']?>" value="<?=$item['goods_date']?>" <?php if($item['use_yn'] == "N") echo "checked";?> >
													</td> 
													<td style="text-align:center;"><?=$item['reg_date']?></td> 
													<td style="text-align:center;"><?=$item['upd_date']?></td> 
													<td style="text-align:center;">
														<button type="button" class="chargeUpdate" value="<?=$item['idx']?>">수정</button>
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
						// 수정불가 설정 클릭
						$("#changeN").click(function () {
							if (!confirm("수정불가 설정을 하시겠습니까?")) return false;
							
							let use_yn = "Y";
							let checkedIdx = $("input[name='upd_chk']:checked").map(function () {
								return $(this).data("idx");  // data-idx 값 가져오기
							}).get();  // 배열로 변환

							updateUpdY(checkedIdx, use_yn);
						});


						// 수정가능 설정 클릭
						$("#changeY").click(function () {
							if (!confirm("수정가능 설정을 하시겠습니까?")) return false;

							let use_yn = "";
							let checkedIdx = $("input[name='upd_chk']:checked").map(function () {
								return $(this).data("idx");  // data-idx 값 가져오기
							}).get();  // 배열로 변환

							updateUpdY(checkedIdx, use_yn);

						});

						// Ajax로 `upd_y` 값 업데이트 (배열 전송 가능)
						function updateUpdY(idxArray, value) {

							    // 체크된 요일 가져오기
								
								var selectedDays = [];
								$('.priceDow:checked').each(function() {
									selectedDays.push($(this).val());
								});								
								console.log("선택된 요일:", selectedDays);
 								
								// Ajax 요청
								$.ajax({
									url: "/ajax/ajax_golf_upd_y",
									type: "POST",
									data: {
											product_idx :  $("#product_idx").val(),	
											o_idx 	    :  $("#o_idx").val(),
										    s_date      :  $("#s_date").val(),
											e_date      :  $("#e_date").val(),
										    dow_val     :  selectedDays.join(','),
											idx         :  idxArray,  
											upd_yn      :  value
										  },
									dataType: "json",
									async: false,
									cache: false,
									success: function (data, textStatus) {
										var message = data.message;
										alert(message);
										location.href='list_golf_price?product_idx='+$("#product_idx").val()+'&s_date='+$("#s_date").val()+'&e_date='+$("#e_date").val();
									},
									error: function (request, status, error) {
										alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
									}
								});
 								
						}

					});
					</script>
					
                    <script>
					$(document).ready(function () {
						// 전체 선택 체크박스 클릭
						$(".end_all").click(function () {
							// 전체 선택 체크박스가 선택되었으면
							if ($(this).prop("checked")) {
								// 모든 요일 체크박스를 선택
								$(".end_yn").prop("checked", true);
							} else {
								// 전체 선택 체크박스가 해제되면 모든 요일 체크박스를 해제
								$(".end_yn").prop("checked", false);
							}
						});

						// 개별 요일 선택 체크박스 클릭
						$(".end_yn").click(function () {
							// 개별 요일 체크박스 중 하나라도 선택되지 않으면 전체 선택 체크박스를 해제
							if ($(".end_yn:checked").length === $(".end_yn").length) {
								$(".end_all").prop("checked", true); // 모든 요일이 선택되면 전체 선택 체크박스를 체크
							} else {
								$(".end_all").prop("checked", false); // 하나라도 해제되면 전체 선택 체크박스를 해제
							}
						});
					});
										
					$(document).ready(function () {
						// 전체 선택 체크박스 클릭
						$(".priceAll").click(function () {
							// 전체 선택 체크박스가 선택되었으면
							if ($(this).prop("checked")) {
								// 모든 요일 체크박스를 선택
								$(".priceDow").prop("checked", true);
							} else {
								// 전체 선택 체크박스가 해제되면 모든 요일 체크박스를 해제
								$(".priceDow").prop("checked", false);
							}
						});

						// 개별 요일 선택 체크박스 클릭
						$(".priceDow").click(function () {
							// 개별 요일 체크박스 중 하나라도 선택되지 않으면 전체 선택 체크박스를 해제
							if ($(".priceDow:checked").length === $(".priceDow").length) {
								$(".priceAll").prop("checked", true); // 모든 요일이 선택되면 전체 선택 체크박스를 체크
							} else {
								$(".priceAll").prop("checked", false); // 하나라도 해제되면 전체 선택 체크박스를 해제
							}
						});
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

						$('#use_all').on('click', function() {
								$(".use_yn").prop("checked", $(this).prop("checked"));
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
					$(document).ready(function () {
						$(".upd_all").on("change", function () {
							// 체크 여부 확인
							let isChecked = $(this).prop("checked");

							// row 클래스가 "yes"인 경우만 체크박스 변경
							$("tr").find("input.upd_chk").prop("checked", isChecked);
						});
					});
					</script>
					
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
						$(document).ready(function () {
							// 전체 선택 체크박스 클릭 이벤트
							$('#bedAll').on('change', function () {
								$('.bed_type').prop('checked', $(this).prop('checked'));
							});

							// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
							$('.bed_type').on('change', function () {
								$('#bedAll').prop('checked', $('.bed_type:checked').length === $('.bed_type').length);
							});
						});
					</script>
					
					<script>
						$("#allCharge").one("click", function () {
							location.href='/AdmMaster/_tourRegist/list_golf_price?product_idx='+$("#product_idx").val();
						});
					</script>

					<script>
						$("#addCharge").one("click", function () {
								if (!confirm("일정을 추가 하시겠습니까?"))
									return false;
                                
								if($("#a_date").val()  == "") { 
								   alert('추가할 일자를 선택하세요.');	
								   $("#a_date").focus();
								   return false;
								}
								
								//var days = $("#days").val();
								$.ajax({

									url: "/ajax/golf_price_add",
									type: "POST",
									data: {

											"product_idx" : $("#product_idx").val(), 
											"a_date"      : $("#a_date").val(), 
											"o_idx"       : $("#o_idx").val()
									      },
									dataType: "json",
									async: false,
									cache: false,
									success: function(data, textStatus) {
										var message = data.message;
										var s_date  = data.s_date;
										var e_date  = data.e_date;
										alert(message);
										//location.reload();
										//https://thetourlab.com/AdmMaster/_tourRegist/list_golf_price?o_idx=156&product_idx=2096
										location.href='/AdmMaster/_tourRegist/list_golf_price?product_idx='+$("#product_idx").val()+'&o_idx='+$("#o_idx").val();
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
											"product_idx" : $("#product_idx").val(),
											"dow_val"     : dow_val 
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

                                if($("#s_date").val() == "" || $("#e_date").val() == "") {
								     alert('적용할 일자를 선택하세요.');
									 $("#s_date").focus();
									 return false;
                                }

								if(dow_val == "") {
								     alert('적용할 요일을 선택하세요.');
									 return false;
                                }

							    if($("#dowPrice_1").val() < "1") {
								     alert('적용할 금액을 입력하세요.');
									 $("#dowPrice_1").focus();
									 return false;
                                }

							    if($("#dowPrice_2").val() < "1") {
								     alert('적용할 금액을 입력하세요.');
									 $("#dowPrice_2").focus();
									 return false;
                                }

							    if($("#dowPrice_3").val() < "1") {
								     alert('적용할 금액을 입력하세요.');
									 $("#dowPrice_3").focus();
									 return false;
                                }

								$.ajax({

									url: "/ajax/golf_dow_charge",
									type: "POST",
									data: {
										    "s_date"      : $("#s_date").val(),
											"e_date"      : $("#e_date").val(),
											"product_idx" : $("#product_idx").val(),
											"dow_val"     : dow_val, 
											"price_1"     : $("#dowPrice_1").val(),
											"price_2"     : $("#dowPrice_2").val(),
											"price_3"     : $("#dowPrice_3").val()
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
					$(document).ready(function () {
						$.ajax({
							url: '/ajax/ajax_getMinDate',  // CI4 라우팅에 맞게 설정
							type: 'POST',
							data: { "o_idx" : $("#o_idx").val() },

							dataType: 'json',
							async: false,
							cache: false,
								
							success: function (data, textStatus) {
								if (data.status === 'success') {
									var minDate = new Date(data.min_date);  // DB에서 가져온 날짜
									$("#a_date").datepicker({
										dateFormat: 'yy-mm-dd',
										minDate: minDate,  // 동적으로 설정된 최소 날짜
										maxDate: "+99Y",
										showButtonPanel: true,
										closeText: '닫기',
										currentText: '오늘',
										prevText: '이전',
										nextText: '다음',
										showOn: "both",
										yearRange: "c:c+30",
										buttonImage: "/images/admin/common/date.png",
										buttonImageOnly: true
									});
								} else {
									alert('날짜를 불러오는 데 실패했습니다.');
								}
							},
							error: function () {
								alert('서버와의 통신 오류');
							}
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

                                <a href="write_golf_price?product_idx=<?=$product_idx?>" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                                <?php if ($product_idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it('<?=$o_idx?>')" class="btn btn-default"><span
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

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_tourRegist/list_golf_price?product_idx='.$product_idx.'&o_idx='.$o_idx.'&s_date='.$s_date.'&e_date='.$e_date) . $search_val . "&pg=") ?>

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

						url: "/ajax/golf_price_update",
						type: "POST",
						data: {

								"product_idx"   : $("#product_idx").val(),
								"idx"           : idx,
								"price_1"       : $("#price_1_"+idx).val(),
								"price_2"       : $("#price_2_"+idx).val(),
								"price_3"       : $("#price_3_"+idx).val(),
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

			<script>
				function submitForm() {
					$("#g_list_rows").val($("#list_rows").val());
					$("#pg").val('1');
					document.getElementById("priceForm").submit();
					/*
					var product_code_1  = '<?=$product_code_1?>';
					var product_code_2  = '<?=$product_code_2?>';
					var product_code_3  = '<?=$product_code_3?>';
					var special_price   = '<?=$special_price?>';
					var s_status        = '<?=$s_status?>';
					var search_category = '<?=$search_category?>';
					var product_name    = '<?=$product_name?>';
					var g_list_rows     =  $("#g_list_rows").val();
					var search_name     = '<?=$search_name?>';
					var pg              = '<?=$pg?>';
					location.href='/AdmMaster/_hotel/list?product_code_1='+product_code_1+'&product_code_2='+product_code_2+'&product_code_3='+product_code_3+'&special_price='+special_price+'&s_status='+s_status+'&search_category='+search_category+'&product_name='+product_name+'&g_list_rows='+g_list_rows+'&search_name='+search_name+'&pg='+pg;
					*/
				}
			</script>

			<script>
				function go_list() {
                    window.location.href = "AdmMaster/_tourRegist/list_golf_price?product_idx=<?=$product_idx?>&o_idx=&s_date=<?=$s_date?>&e_date=<?=$e_date?>&pg=7					
				}
			</script>
			
        <form name="priceForm" id="priceForm" method="get" action="/AdmMaster/_tourRegist/list_golf_price">
            <input type="hidden" name="product_idx"  value='<?=$product_idx?>' >
            <input type="hidden" name="g_idx"        value="<?=$g_idx?>" >
            <input type="hidden" name="roomIdx"      value="<?=$roomIdx?>">
			<input type="hidden" name="s_date"       value="<?=$s_date?>" id="in_s_date" >
			<input type="hidden" name="e_date"       value="<?=$e_date?>" id="in_e_date" >
			<input type="hidden" name="g_list_rows"  value="<?=$g_list_rows?>" id="g_list_rows">
			<input type="hidden" name="pg"           value="<?=$pg?>" id="pg">
			
        </form>

<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>