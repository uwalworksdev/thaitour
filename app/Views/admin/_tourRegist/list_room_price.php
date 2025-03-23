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
						<!--
                        <?php if ($product_idxx) { ?>
                            <li><a href="javascript:all_update()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            </li>
                        <?php } else { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            </li>
                        <?php } ?>
                        -->
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
											기본가: <input type="text" name="dowPrice1" id="dowPrice1" value="0" numberonly="true" style="text-align:right;background: white; width: 130px;">
											컨택가: <input type="text" name="dowPrice2" id="dowPrice2" class="cost"   value="0" numberonly="true" style="text-align:right;background: white; width: 130px;">
											수익가: <input type="text" name="dowPrice3" id="dowPrice3" class="profit" value="0" numberonly="true" style="text-align:right;background: white; width: 130px;">
											판매가: <input type="text" name="dowPrice4" id="dowPrice4" class="price " value="0" numberonly="true" style="text-align:right;background: white; width: 130px;" readonly>
											Extra베드: <input type="text" name="dowPrice5" id="dowPrice5" class="bed" value="0" numberonly="true" style="text-align:right;background: white; width: 130px;">
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="dowCharge" class="btn btn-primary">날짜별 일괄 적용</a>  
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <p><span style="font-weight: bold; color: red;">※</span> 수정되는 것은 자동으로 체크됩니다. 마감, 지난 날짜, 수정된 것도 체크됩니다. <span style="color:red;">체크를 풀고 저장하면, 전체 저장 시 수정됩니다.</span>
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
					
					</p>
                    <div class="listBottom">
         				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
									<colgroup>
									<!--col width="5%"-->
									<col width="5%">
									<col width="*">
									<col width="9%">
									<col width="9%">
									<col width="9%">
									<col width="8%">
									<col width="9%">
									<col width="9%">
									<col width="8%">
									<col width="10%">
									<col width="10%">
									<col width="6%">
									</colgroup>
					                <tbody id="charge">
										<tr style="height:40px">
											<td style="text-align:center">
												<input type="checkbox" name="upd_all" class="upd_all" value="Y"  >
											</td>
											<!--td style="text-align:center">
												수정불가
											</td-->
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
												판매가
											</td>
											<td style="text-align:center">
												Extra베드
												<input type="checkbox" name="" id="price5_all">전체
											</td>
											<td style="text-align:center">
												마감
                                                <input type="checkbox" name="" id="end_all">전체											
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
													<!--td>
														<label class="center-checkbox">
														    <?php if($item['upd_yn'] == "Y") { ?> 
															<input type="checkbox" name="upd_yn" class="upd_yn" data-idx="<?= $item['idx'] ?>" value="Y" checked >
															<?php } else { ?>
															<input type="checkbox" name="upd_yn" class="upd_yn" data-idx="<?= $item['idx'] ?>" value="<?=$item['idx']?>" >
															<?php } ?>
														</label>
													</td-->
													<td style="text-align:center"><?=$item['bed_type']?></td>
													
													<?php if($com_date != $item['goods_date']) { ?>
													<?php $com_date = $item['goods_date']?>
													<td style="text-align:center"><?=$item['goods_date']?> [<?=$item['dow']?>]</td>
													<?php } else { ?>
													<td></td>	
													<?php } ?>
													<td style="text-align:center">
														<input type="hidden" name="idx[]" id="idx_<?=$item['idx']?>" value="<?=$item['idx']?>">
														<input type="hidden" name="goods_date[]" id="goods_date_<?=$item['idx']?>" value="<?=$item['goods_date']?>">
														<input type="text" name="goods_price1[]" id="price1_<?=$item['idx']?>" value="<?=number_format($item['goods_price1'])?>" class="price price1 goods_price input_txt" numberonly="true" style="text-align:right;">
													</td>
													<td style="text-align:center">
														<input type="text" name="goods_price2[]" id="price2_<?=$item['idx']?>" value="<?=number_format($item['goods_price2'])?>" class="price price2 goods_price input_txt" numberonly="true" style="text-align:right;">
													</td>
													<td style="text-align:center">
														<input type="text" name="goods_price3[]" id="price3_<?=$item['idx']?>" value="<?=number_format($item['goods_price3'])?>" class="price price3 goods_price input_txt" numberonly="true" style="text-align:right;">
													</td>
													<td style="text-align:center">
														<input type="text" name="goods_price4[]" id="price4_<?=$item['idx']?>" value="<?=number_format($item['goods_price4'])?>" class="price price4 goods_price input_txt" numberonly="true" style="text-align:right;" readonly>
													</td>
													<td style="text-align:center">
														<input type="text" name="goods_price5[]" id="price5_<?=$item['idx']?>" value="<?=number_format($item['goods_price5'])?>" class="price price5 goods_price input_txt" numberonly="true" style="text-align:right;">
													</td>
													<td style="text-align:center;">
														<input type="checkbox" class="use_yn" name="use_yn[]" id="use_yn_<?=$item['idx']?>" data-idx= "<?=$item['idx']?>" value="Y" <?php if($item['use_yn'] == "N") echo "checked";?> >
													</td> 
													<td style="text-align:center;"><?=$item['reg_date']?></td> 
													<td style="text-align:center;"><?=$item['upd_date']?></td> 
													<td style="text-align:center;">
													    <?php if($item['upd_yn'] != "Y") { ?>
														<button type="button" class="chargeUpdate" value="<?=$item['idx']?>">수정</button>
														<?php } else { ?>								
														 <span style="color:red">수정불가</span>
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
							
								// Ajax 요청
								$.ajax({
									url: "/ajax/update_upd_y",
									type: "POST",
									data: {
											idx    : idxArray,  // 배열을 보냄
											upd_yn : value
										  },
									dataType: "json",
									async: false,
									cache: false,
									success: function (data, textStatus) {
										var message = data.message;
										alert(message);
										location.reload();
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
							// 화요일 체크
							$(".priceDowx").click(function () {
								let day = $(this).val();
								if ($(this).prop("checked")) {  // 체크박스가 체크된 경우
									$(`.upd_chk.${day}`).prop("checked", true);  // 해당 요일 체크박스를 체크
								} else {  // 체크박스가 해제된 경우
									$(`.upd_chk.${day}`).prop("checked", false);  // 해당 요일 체크박스를 해제
								}
							});
							
							$(".priceAllx").click(function () {
								if ($(this).prop("checked")) {  // 체크박스가 체크된 경우
									$(`.upd_chk`).prop("checked", true);  // 해당 요일 체크박스를 체크
								} else {  // 체크박스가 해제된 경우
									location.reload();
								}
							});

						});
					</script>

					<script>
					$(document).ready(function () {
						$(".price2, .price3").on("input", function () {
							let row = $(this).closest("tr"); // 현재 입력 필드가 속한 행 찾기
							let price2 = parseFloat(row.find(".price2").val().replace(/,/g, "")) || 0;
							let price3 = parseFloat(row.find(".price3").val().replace(/,/g, "")) || 0;

							let total = price2 + price3;

							// 자동 계산된 값 설정
							row.find(".price4").val(total.toLocaleString());
						});
					});
					</script>
					
                    <script>
					$(document).ready(function() {
						$(".yes").css("background-color", "#e9f2f4"); // 연한 빨간색
					});
                    </script>
					
					<script>
					$(document).ready(function () {
						$(".allUpdate").on("click", function () {
							let selectedRows = [];

							// 체크된 .upd_chk을 가진 행의 데이터 수집
							$("input.upd_chk:checked").each(function () {
								let row = $(this).closest("tr"); // 현재 체크된 체크박스가 속한 행
								let idx = row.find("input[name='idx[]']").val();
								let goods_price1 = row.find("input[name='goods_price1[]']").val().replace(/,/g, ""); // 숫자에서 , 제거
								let goods_price2 = row.find("input[name='goods_price2[]']").val().replace(/,/g, "");
								let goods_price3 = row.find("input[name='goods_price3[]']").val().replace(/,/g, "");
								let goods_price5 = row.find("input[name='goods_price5[]']").val().replace(/,/g, "");

								// 객체 형태로 저장
								selectedRows.push({
									idx: idx,
									goods_price1: goods_price1,
									goods_price2: goods_price2,
									goods_price3: goods_price3,
									goods_price5: goods_price5,
								});
							});

							// 선택된 행이 없으면 종료
							if (selectedRows.length === 0) {
								alert("업데이트할 행을 선택하세요.");
								return;
							}

							// AJAX 요청 보내기
							$.ajax({
								url: "/ajax/all_price_update", // 서버에서 데이터를 처리할 PHP 파일
								type: "POST",
								data: { rows: selectedRows },
								dataType: "json",
								success: function (response) {
									if (response.status === "success") {
										alert("업데이트 성공!");
										location.reload(); // 성공 시 페이지 새로고침
									} else {
										alert("업데이트 실패: " + response.message);
									}
								},
								error: function (xhr, status, error) {
									alert("에러 발생: " + error);
								}
							});
						});
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
								// 첫 번째 `price1[]` 값 가져오기
								var price = $('input[name="goods_price1[]"]').first().val();
								
								if (price !== undefined) {
									$('.price1').val(price);
								} else {
									alert("가격을 찾을 수 없습니다.");
								}
							} else {
								location.reload(); // 체크 해제 시 새로고침
							}
						});

						$('#price1_all').on('click', function() {
							if ($(this).is(':checked')) {
								// 첫 번째 `price1[]` 값 가져오기
								var price = $('input[name="goods_price1[]"]').first().val();
								
								if (price !== undefined) {
									$('.price1').val(price);
								} else {
									alert("가격을 찾을 수 없습니다.");
								}
							} else {
								location.reload(); // 체크 해제 시 새로고침
							}
						});

						$('#price2_all').on('click', function() {
							if ($(this).is(':checked')) {
								// 첫 번째 `price1[]` 값 가져오기
								var price = $('input[name="goods_price2[]"]').first().val();
								
								if (price !== undefined) {
									$('.price2').val(price);
								} else {
									alert("가격을 찾을 수 없습니다.");
								}
							} else {
								location.reload(); // 체크 해제 시 새로고침
							}
						});

						$('#price3_all').on('click', function() {
							if ($(this).is(':checked')) {
								// 첫 번째 `price1[]` 값 가져오기
								var price = $('input[name="goods_price3[]"]').first().val();
								
								if (price !== undefined) {
									$('.price3').val(price);
								} else {
									alert("가격을 찾을 수 없습니다.");
								}
							} else {
								location.reload(); // 체크 해제 시 새로고침
							}
						});

						$('#price5_all').on('click', function() {
							if ($(this).is(':checked')) {
								// 첫 번째 `price1[]` 값 가져오기
								var price = $('input[name="goods_price5[]"]').first().val();
								
								if (price !== undefined) {
									$('.price5').val(price);
								} else {
									alert("가격을 찾을 수 없습니다.");
								}
							} else {
								location.reload(); // 체크 해제 시 새로고침
							}
						});
						</script>

					<script>
					$(document).ready(function(){
						// 전체 선택/해제
						$("#end_all").on("change", function(){
							$(".use_yn").prop("checked", $(this).prop("checked"));
						});

						// 개별 체크 시 전체 체크박스 상태 변경
						$(".use_yn").on("change", function(){
							let total = $(".use_yn").length;
							let checked = $(".use_yn:checked").length;
							$("#end_all").prop("checked", total === checked);
						});
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
/*
								var checkedIdx = [];
								var uncheckedIdx = [];

								// 모든 .upd_chk 체크박스를 순회
								$(".upd_chk").each(function() {
									// data-idx 값을 가져옵니다.
									var idx = $(this).data("idx");
									// 체크 여부에 따라 배열에 추가
									if ($(this).is(":checked")) {
										checkedIdx.push(idx);
									} else {
										uncheckedIdx.push(idx);
									}
								});
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
*/
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
											
								<!--
								<?php if ($product_idxx) { ?>
									<li><a href="javascript:all_update()" class="btn btn-default"><span
													class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
									</li>
								<?php } else { ?>
									<li><a href="javascript:send_it()" class="btn btn-default"><span
													class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
									</li>
								<?php } ?>
								-->
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- // listWrap -->

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_tourRegist/list_room_price?product_idx='.$product_idx.'&g_idx='.$g_idx.'&roomIdx='.$roomIdx .'&s_date='.$s_date.'&e_date='.$e_date.'&g_list_rows='.$g_list_rows) . $search_val . "&pg=") ?>

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
								"goods_price5"  : $("#price5_"+idx).val(),
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
				
				// 배열 초기화
				var checkedIdx = [];
				var uncheckedIdx = [];

				// 모든 .upd_chk 체크박스를 순회
				$(".upd_chk").each(function() {
					// data-idx 값을 가져옵니다.
					var idx = $(this).data("idx");
					// 체크 여부에 따라 배열에 추가
					if ($(this).is(":checked")) {
						checkedIdx.push(idx);
					} else {
						uncheckedIdx.push(idx);
					}
				});

				// 결과 확인 (콘솔 출력)
				console.log("Checked idx: ", checkedIdx);
				console.log("Unchecked idx: ", uncheckedIdx);

 				
						let idx_val = "";
						$(".upd_chk:checked").each(function() {
							if(idx_val == "") {
							   idx_val += $(this).val(); 
							} else {   
							   idx_val += '|'+$(this).val(); 
							}   
						});		

						let rows = [];

						$("tr:has(.upd_chk:checked)").each(function () {
							let row = {
								idx: $(this).find(".upd_chk").data("idx"),
								goods_price1: $(this).find("[name='goods_price1[]']").val().replace(/,/g, ""),
								goods_price2: $(this).find("[name='goods_price2[]']").val().replace(/,/g, ""),
								goods_price3: $(this).find("[name='goods_price3[]']").val().replace(/,/g, ""),
								goods_price4: $(this).find("[name='goods_price4[]']").val().replace(/,/g, ""),
								goods_price5: $(this).find("[name='goods_price5[]']").val().replace(/,/g, ""),
								use_yn: $(this).find(".use_yn").is(":checked") ? "N" : "Y" // 체크되었으면 "N", 해제되었으면 "Y"			
							};
							rows.push(row);
						});

						if (rows.length > 0) {
							$.ajax({
								url: "/ajax/all_price_update", // 실제 업데이트할 API URL
								type: "POST",
								data: { 
									      uncheck : uncheckedIdx,
										  rows    : rows 
									  },
								dataType: "json",
								success: function (response) {
									if (response.status === "success") {
										alert("업데이트 완료!");
										location.reload();
									} else {
										alert("업데이트 실패: " + response.message);
									}
								},
								error: function () {
									alert("서버 오류가 발생했습니다.");
								}
							});
						} else {
							alert("수정할 항목이 없습니다.");
						}
 			
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
					window.location.href = "AdmMaster/_hotel/write?search_category=&search_txt=&pg=&product_idx=<?=$product_idx?>";
				}
			</script>

        <form name="priceForm" id="priceForm" method="get" action="/AdmMaster/_tourRegist/list_room_price">
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