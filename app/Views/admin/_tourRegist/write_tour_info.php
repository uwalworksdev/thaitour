<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div id="container"> <span id="print_this">
	
	<header id="headerContainer">
		<div class="inner">
			<h2>상품요금정보 <?=$titleStr?> </h2>
			<div class="menus">
				<ul >
					<li><a href="/AdmMaster/_tourRegist/write_tours?product_idx=<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
				</ul>
			</div>
		</div>
		<!-- // inner --> 
		
	</header>
	<!-- // headerContainer -->
	
	<form name=frm action="<?= route_to('admin._tours.write_info_ok') ?>"  method=post >
	<input type=hidden name="product_idx" value='<?=$product_idx?>'> 
	<?php foreach ($groupedData as $info_idx => $data): ?>
		<input type="hidden" name="info_idx[]" value="<?= $info_idx ?>">
	<?php endforeach; ?>
	<input type=hidden name="s_product_code_1" value='<?=$s_product_code_1?>'> 
	<input type=hidden name="s_product_code_2" value='<?=$s_product_code_2?>'> 
	<input type=hidden name="s_product_code_3" value='<?=$s_product_code_3?>'> 
	<div id="contents">
		<div class="listWrap_noline">
			<div class="listBottom">
				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
					<caption>
					</caption>
					<colgroup>
					<col width="15%" />
					<col width="85%" />
					</colgroup>
					<tbody>
						<tr height=45>
							<th>상품정보 [단위 : 바트]</th>
							<td>
								<div style="margin:10px; display: flex; gap: 5px">
									<a href="javascript:add_table();" class="btn btn-primary">추가</a>
								</div>
								<?php if ($productTourInfo): ?>
                                    <?php foreach ($productTourInfo as $info): 
									?>
                                        <div class="table_list"  data-info-idx="<?= $info['info']['info_idx'] ?>" style="width: 100%; margin-bottom: 20px;">
                                            <table style="width: 100%">
												<colgroup>
													<col width="35%">
													<col width="*">
													<col width="10%">
													<col width="15%">
												</colgroup>
												<thead>
													<tr>
														<th>기간</th>
														<th>출발요일</th>
														<th>기존상품가</th>
														<th></th>
													</tr>
												</thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
															<div style="display: flex; justify-content: center">
																<input type="text" readonly class="datepicker" name="o_sdate[<?= $info['info']['info_idx'] ?>]" style="width: 150px; cursor: pointer;" 
																	value="<?= substr($info['info']['o_sdate'], 0, 10) ?>"> ~
																<input type="text" readonly class="datepicker" name="o_edate[<?= $info['info']['info_idx'] ?>]" style="width: 150px; cursor: pointer;" 
																	value="<?= substr($info['info']['o_edate'], 0, 10) ?>">
															</div>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="yoil_0[<?= $info['info']['info_idx'] ?>]" class="yoil" 
                                                                <?= $info['info']['yoil_0'] == 'Y' ? 'checked' : '' ?>> 일요일
                                                            <input type="checkbox" name="yoil_1[<?= $info['info']['info_idx'] ?>]" class="yoil" 
                                                                <?= $info['info']['yoil_1'] == 'Y' ? 'checked' : '' ?>> 월요일
                                                            <input type="checkbox" name="yoil_2[<?= $info['info']['info_idx'] ?>]" class="yoil" 
                                                                <?= $info['info']['yoil_2'] == 'Y' ? 'checked' : '' ?>> 화요일
                                                            <input type="checkbox" name="yoil_3[<?= $info['info']['info_idx'] ?>]" class="yoil" 
                                                                <?= $info['info']['yoil_3'] == 'Y' ? 'checked' : '' ?>> 수요일
                                                            <input type="checkbox" name="yoil_4[<?= $info['info']['info_idx'] ?>]" class="yoil" 
                                                                <?= $info['info']['yoil_4'] == 'Y' ? 'checked' : '' ?>> 목요일
                                                            <input type="checkbox" name="yoil_5[<?= $info['info']['info_idx'] ?>]" class="yoil" 
                                                                <?= $info['info']['yoil_5'] == 'Y' ? 'checked' : '' ?>> 금요일
                                                            <input type="checkbox" name="yoil_6[<?= $info['info']['info_idx'] ?>]" class="yoil" 
                                                                <?= $info['info']['yoil_6'] == 'Y' ? 'checked' : '' ?>> 토요일
                                                        </td>
														<td>
															<input type="text" name="tour_info_price[<?= $info['info']['info_idx'] ?>]" value="<?= $info['info']['tour_info_price'] ?>">
														</td>
														<td>
															<div style="margin:10px; display: flex; justify-content: center; gap: 5px">
																<a href="javascript:add_tour(<?= $info['info']['info_idx'] ?>);" class="btn btn-primary">추가</a>
																<a href="javascript:del_tours('<?= $info['info']['info_idx']?>', '<?= $info['tours_idx_json'] ?>');" class="btn btn-primary">삭제</a>
															</div>
														</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <table style="width:100%">
																<thead>
																	<tr style="height:40px">
																		<td style="width:*;text-align:center">
																			상품명(국문/영문)
																		</td>
																		<td style="width:15%;text-align:center">
																			성인가격(단위: 바트)
																		</td>
																		<td style="width:15%;text-align:center">
																			소아가격(단위: 바트)
																		</td>
																		<td style="width:15%;text-align:center">
																			유아가격(단위: 바트)
																		</td>
																		<td style="width:15%;text-align:center">
																			판매상태
																		</td>
																	</tr>
																</thead>
                                                                <tbody class="air_main" data-info-idx="<?= $info['info']['info_idx'] ?>">
                                                                    <?php foreach ($info['tours'] as $tour): ?>
                                                                        <tr class="air_list_1" style="height:40px">
                                                                            <td>
																			<input type="hidden" name="tours_idx[<?= $info['info']['info_idx'] ?>][]" class="tours_idx" value="<?= $tour['tours_idx'] ?>">
                                                                                <input type="text" name="tours_subject[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tours_subject'] ?>" class="tours_subject input_txt" style="width:100%" />
                                                                                <input type="text" name="tours_subject_eng[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tours_subject_eng'] ?>" class="tours_subject input_txt" style="width:100%" />
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="tour_price[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tour_price'] ?>" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="tour_price_kids[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tour_price_kids'] ?>" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="tour_price_baby[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tour_price_baby'] ?>" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
                                                                            </td>
                                                                            <td>
																				<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
																					<select name="status[<?= $info['info']['info_idx'] ?>][]">
																						<option value="Y" <?= ($tour['status'] == 'Y') ? 'selected' : '' ?>>판매중</option>
																						<option value="N" <?= ($tour['status'] == 'N') ? 'selected' : '' ?>>중지</option>
																					</select>
																					<a href="javascript:delete_tour(<?= $tour['tours_idx']?>);" class="btn btn-primary">삭제</a>
																				</div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach ?>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
									<div class="table_list" data-index="0" style="width: 100%; margin-bottom: 20px;">
										<table style="width: 100%">
											<colgroup>
												<col width="35%">
												<col width="*">
												<col width="10%">
												<col width="15%">
											</colgroup>
											<thead>
												<tr>
													<th>기간</th>
													<th>출발요일</th>
													<th>기존상품가</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<input type="text" readonly="" class="datepicker" name="o_sdate[]" style="width: 150px; cursor: pointer;" value="" id=""> ~
														<input type="text" readonly="" class="datepicker" name="o_edate[]" style="width: 150px; cursor: pointer;" value="" id="">
													</td>
													<td>
														<input type="checkbox" name="yoil_0[0][]" value="" class="yoil">
														일요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_1[0][]" value="" class="yoil">
														월요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_2[0][]" value="" class="yoil">
														화요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_3[0][]" value="" class="yoil">
														수요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_4[0][]" value="" class="yoil">
														목요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_5[0][]" value="" class="yoil">
														금요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_6[0][]" value="" class="yoil">
														토요일&nbsp;&nbsp;&nbsp;
													</td>
													<td>
														<input type="text" name="tour_info_price[0][]">
													</td>
													<td>
														<div style="margin:10px; display: flex; justify-content: center; gap: 5px">
															<a href="javascript:add_tours(0);" class="btn btn-primary">추가</a>
															<a href="javascript:remove_table(0);" class="btn btn-primary">삭제</a>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="4">
														<table style="width:100%">
															<thead>
																<tr style="height:40px">
																	<td style="width:*;text-align:center">
																		상품명
																	</td>
																	<td style="width:15%;text-align:center">
																		성인가격(단위: 바트)
																	</td>
																	<td style="width:15%;text-align:center">
																		소아가격(단위: 바트)
																	</td>
																	<td style="width:15%;text-align:center">
																		유아가격(단위: 바트)
																	</td>
																	<td style="width:15%;text-align:center">
																		판매상태
																	</td>
																</tr>
															</thead>
															<tbody class="air_main">
																	<tr class="air_list_1" style="height:40px" >
																		<td style="width:100px;text-align:center">
																			<input type="hidden" name="tours_idx[]" class="tours_idx" value="">
																			<input type="text" name="tours_subject[0][]" value="" class="tours_subject input_txt" style="width:100%" />
																		</td>
																		<td style="text-align:center">
																			<input type="text" name="tour_price[0][]" value="" class="price tour_price input_txt" style="width:100%" />
																		</td>
																		<td style="text-align:center">
																			<input type="text" name="tour_price_kids[0][]" value="" class="price tour_price_kids input_txt" style="width:90%" />
																		</td>
																		<td style="text-align:center">
																			<input type="text" name="tour_price_baby[0][]" value="" class="price tour_price_baby input_txt" style="width:90%" />
																		</td>
																		<td style="display: flex; gap: 10px; align-items: center; justify-content: center">
																			<select name="status[0][]">
																				<option value="Y" selected>판매중</option>
																				<option value="N">중지</option>
																			</select>
																			<a href="javascript:remove_tours(0,0);" class="btn btn-primary">삭제</a>
																		</td>
																	</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php endif ?>
							</td>
						</tr>
						
					</tbody>
					
				</table>
			</div>	
		</div>
		<div class="tail_menu">
			<ul>
				<li class="left"></li>
				<li class="right_sub">

					<a href="/AdmMaster/_tourRegist/write_tours?product_idx=<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
					<?php if (!empty($productTourInfo)) { ?>	
						<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
						<?php } else { ?>
							<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
					<?php } ?>
				</li>
			</ul>
		</div>
	</div>
	<!-- // contents --> 
	</form>
	</span><!-- 인쇄 영역 끝 //--> 
</div>
<script>
	var tableCount = <?= isset($productTourInfo) ? count($productTourInfo) : 0 ?>;

	function add_table() {
    tableCount++;
    var newTable = `
        <div class="table_list" data-index="${tableCount}" style="width: 100%; margin-bottom: 20px;">
            <table style="width: 100%">
                <colgroup>
                    <col width="35%">
                    <col width="*">
                    <col width="10%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th>기간</th>
                        <th>출발요일</th>
                        <th>기존상품가</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="display: flex; justify-content: center">
                                <input type="text" readonly class="datepicker" name="o_sdate[${tableCount}][]" style="width: 150px; cursor: pointer;" value=""> ~
                                <input type="text" readonly class="datepicker" name="o_edate[${tableCount}][]" style="width: 150px; cursor: pointer;" value="">
                            </div>
                        </td>
                        <td>
                            <input type="checkbox" name="yoil_0[${tableCount}][]" value="일요일" class="yoil"> 일요일&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="yoil_1[${tableCount}][]" value="월요일" class="yoil"> 월요일&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="yoil_2[${tableCount}][]" value="화요일" class="yoil"> 화요일&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="yoil_3[${tableCount}][]" value="수요일" class="yoil"> 수요일&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="yoil_4[${tableCount}][]" value="목요일" class="yoil"> 목요일&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="yoil_5[${tableCount}][]" value="금요일" class="yoil"> 금요일&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="yoil_6[${tableCount}][]" value="토요일" class="yoil"> 토요일&nbsp;&nbsp;&nbsp;
                        </td>
                        <td>
                            <input type="text" name="tour_info_price[${tableCount}][]">
                        </td>
                        <td>
                            <div style="margin:10px; display: flex; justify-content: center; gap: 5px">
                                <a href="javascript:add_tours(${tableCount});" class="btn btn-primary">추가</a>
                                <a href="javascript:remove_table(${tableCount});" class="btn btn-primary">삭제</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table style="width:100%">
                                <thead>
                                    <tr style="height:40px">
                                        <td style="width:*;text-align:center">상품명</td>
                                        <td style="width:15%;text-align:center">성인가격(단위: 바트)</td>
                                        <td style="width:15%;text-align:center">소아가격(단위: 바트)</td>
                                        <td style="width:15%;text-align:center">유아가격(단위: 바트)</td>
                                        <td style="width:15%;text-align:center">판매상태</td>
                                    </tr>
                                </thead>
                                <tbody class="air_main">
                                    <tr class="air_list_1" style="height:40px">
                                        <td style="width:100px;text-align:center">
                                            <input type="hidden" name="tours_idx[${tableCount}][]" class="tours_idx" value="">
                                            <input type="text" name="tours_subject[${tableCount}][]" value="" class="tours_subject input_txt" style="width:100%" />
                                        </td>
                                        <td style="text-align:center">
                                            <input type="text" name="tour_price[${tableCount}][]" value="" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
                                        </td>
                                        <td style="text-align:center">
                                            <input type="text" name="tour_price_kids[${tableCount}][]" value="" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
                                        </td>
                                        <td style="text-align:center">
                                            <input type="text" name="tour_price_baby[${tableCount}][]" value="" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 10px; align-items: center; justify-content: center">
                                                <select name="status[${tableCount}][]">
                                                    <option value="Y" selected>판매중</option>
                                                    <option value="N">중지</option>
                                                </select>
                                                <a href="javascript:remove_tours(${tableCount}, 0);" class="btn btn-primary">삭제</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    `;
    $(".table_list:last").after(newTable);
    $(".datepicker").datepicker();
    $(".price").number(true);
}


	function remove_table(tableIndex) {
    var targetTable = $(".table_list[data-index='" + tableIndex + "']");
    if (targetTable.length > 0) {
        targetTable.remove();
    } else {
        alert("최소 하나의 투어는 유지해야 합니다.");
    }
}

	function add_tours(tableListIndex) {
		var targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
		var rowIndex = targetTable.find(".air_list_1").length;

		var newRow = `
			<tr class="air_list_1" style="height:40px">
				<td style="text-align:center">
					<input type="hidden" name="tours_idx[${tableListIndex}][]" class="tours_idx" value="">
					<input type="text" name="tours_subject[${tableListIndex}][]" value="" class="tours_subject input_txt" style="width:100%" />
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price[${tableListIndex}][]" value="" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price_kids[${tableListIndex}][]" value="" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price_baby[${tableListIndex}][]" value="" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
				</td>
				<td>
					<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
						<select name="status[${tableListIndex}][]">
							<option value="Y" selected>판매중</option>
							<option value="N">중지</option>
						</select>
						<a href="javascript:remove_tours(${tableListIndex}, ${rowIndex});" class="btn btn-primary">삭제</a>
					</div>
				</td>
			</tr>
		`;

		targetTable.append(newRow);
		$(".price").number(true);
	}

	function remove_tours(tableListIndex, rowIndex) {
		var targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
    
		if (targetTable.find(".air_list_1").length > 1) {
			targetTable.find(".air_list_1").eq(rowIndex).remove();
		} else {
			alert("최소 하나의 투어는 유지해야 합니다."); 
		}
	}

	function add_tour(infoIdx) {
		var targetTable = $(".table_list[data-info-idx='" + infoIdx + "']").find(".air_main");
		var rowIndex = targetTable.find(".air_list_1").length;

		var newRow = `
			<tr class="air_list_1" style="height:40px">
				<td style="text-align:center">
					<input type="hidden" name="tours_idx[${infoIdx}][]" class="tours_idx" value="new">
					<input type="text" name="tours_subject[${infoIdx}][]" value="" class="tours_subject input_txt" style="width:100%" />
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price[${infoIdx}][]" value="" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price_kids[${infoIdx}][]" value="" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price_baby[${infoIdx}][]" value="" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
				</td>
				<td>
					<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
						<select name="status[${infoIdx}][]">
							<option value="Y" selected>판매중</option>
							<option value="N">중지</option>
						</select>
						<a href="javascript:remove_tours(${infoIdx}, ${rowIndex});" class="btn btn-primary">삭제</a>
					</div>
				</td>
			</tr>
		`;

		targetTable.append(newRow);
		$(".price").number(true);
	}


	function remove_tour(infoIdx) {
		var targetTable = $(".table_list[data-index='0']").find(".air_main[data-info-idx='" + infoIdx + "']");
		var rows = targetTable.find('tr');

		if (rows.length > 1) {
			rows.last().remove();
		}
	}


	$(window).load(function(){
		$("#datepicker1").datepicker("setDate", '<?=$s_date?>');
		$("#datepicker2").datepicker("setDate", '<?=$e_date?>');
	});

	function delete_tour(tours_idx) {
		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		$.ajax({
			url: "/AdmMaster/_tours/del_tour_option",
			type: "POST",
			data: {
				"tours_idx": tours_idx,
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				alert(data.message);
				location.reload();
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
			}
		});
	}

	function del_tours(info_idx, tours_idx_json) {	
		var tours_idx_array = JSON.parse(tours_idx_json);

		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		$.ajax({
			url: "/AdmMaster/_tours/del_tours",
			type: "POST",
			data: {
				"info_idx": info_idx,
				"tours_idx": tours_idx_array
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				alert(data.message);
				location.reload();
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
			}
		});
	}


			
	</script>	
	<script>
		function send_it()
		{
			var frm = document.frm;

			for (i=0; i< $(".tours_idx").length; i++)
			{
				if ($(".tours_subject:eq("+i+")").val() == "")
				{
					$(".tours_subject:eq("+i+")").focus();
					alert("상품명을 입력해주셔야 합니다.");
					return;
				}
			}

			for (i=0; i< $(".tours_idx").length; i++)
			{
				if ($(".tour_price:eq("+i+")").val() == "")
				{
					$(".tour_price:eq("+i+")").focus();
					alert("가격을 입력해주셔야 합니다.");
					return;
				}

				if ($(".tour_price_kids:eq("+i+")").val() == "")
				{
					$(".tour_price_kids:eq("+i+")").focus();
					alert("가격을 입력해주셔야 합니다.");
					return;
				}
				
				if ($(".tour_price_baby:eq("+i+")").val() == "")
				{
					$(".tour_price_baby:eq("+i+")").focus();
					alert("가격을 입력해주셔야 합니다.");
					return;
				}

			}
			frm.submit();
		}
	</script>
<? include "../_include/_footer.php"; ?>
<?= $this->endSection() ?>