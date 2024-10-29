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
					<li><a href="javascript:history.back();" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
				</ul>
			</div>
		</div>
		<!-- // inner --> 
		
	</header>
	<!-- // headerContainer -->
	
	<form name=frm action="<?= route_to('admin._tours.write_info_ok') ?>"  method=post >
	<input type=hidden name="product_idx" value='<?=$product_idx?>'> 
	<input type=hidden name="info_idx" value='<?=$info_idx?>'> 
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
							<th>상품정보 [단위 : 호주달러]</th>
							<td>
								<div style="margin:10px; display: flex; gap: 5px">
									<a href="javascript:add_table();" class="btn btn-primary">추가</a>
									<a href="javascript:remove_table();" class="btn btn-primary">삭제</a>
								</div>
								<?php if ($productTourInfo): ?>
									<?php foreach ($productTourInfo as $info): ?>
										<div class="table_list" data-index="0" style="width: 100%; margin-bottom: 20px;">
											<table style="width: 100%">
												<colgroup>
													<col width="35%">
													<col width="*">
													<col width="15%">
												</colgroup>
												<thead>
													<tr>
														<th>기간</th>
														<th>출발요일</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<input type="text" readonly class="datepicker" name="o_sdate[<?= $infoIndex ?>]" style="width: 150px; cursor: pointer;" 
																value="<?= substr($info['info']['o_sdate'],0,10)?>" id=""> ~
															<input type="text" readonly class="datepicker" name="o_edate[<?= $infoIndex ?>]" style="width: 150px; cursor: pointer;" 
																value="<?= substr($info['info']['o_edate'],0,10)?>" id="">
														</td>
														<td>
															<input type="checkbox" name="yoil_0[<?= $infoIndex ?>]" value="1" class="yoil" 
																<?= isset($info['info']['yoil_0']) && $info['info']['yoil_0'] ? 'checked' : '' ?>>
																일요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_1[<?= $infoIndex ?>]" value="1" class="yoil" 
																<?= isset($info['info']['yoil_1']) && $info['info']['yoil_1'] ? 'checked' : '' ?>>
																월요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_2[<?= $infoIndex ?>]" value="1" class="yoil" 
																<?= isset($info['info']['yoil_2']) && $info['info']['yoil_2'] ? 'checked' : '' ?>>
																화요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_3[<?= $infoIndex ?>]" value="1" class="yoil" 
																<?= isset($info['info']['yoil_3']) && $info['info']['yoil_3'] ? 'checked' : '' ?>>
																수요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_4[<?= $infoIndex ?>]" value="1" class="yoil" 
																<?= isset($info['info']['yoil_4']) && $info['info']['yoil_4'] ? 'checked' : '' ?>>
																목요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_5[<?= $infoIndex ?>]" value="1" class="yoil" 
																<?= isset($info['info']['yoil_5']) && $info['info']['yoil_5'] ? 'checked' : '' ?>>
																금요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_6[<?= $infoIndex ?>]" value="1" class="yoil" 
																<?= isset($info['info']['yoil_6']) && $info['info']['yoil_6'] ? 'checked' : '' ?>>
																토요일&nbsp;&nbsp;&nbsp;
														</td>
														<td>
															<div style="margin:10px; display: flex; justify-content: center; gap: 5px">
																<a href="javascript:add_it(0);" class="btn btn-primary">추가</a>
																<a href="javascript:remove_it(0);" class="btn btn-primary">삭제</a>
															</div>
														</td>
													</tr>
													<tr>
														<td colspan="3">
															<table style="width:100%">
																<thead>
																	<tr style="height:40px">
																		<td style="width:*;text-align:center">
																			상품명
																		</td>
																		<td style="width:15%;text-align:center">
																			성인가격
																		</td>
																		<td style="width:15%;text-align:center">
																			소아가격
																		</td>
																		<td style="width:15%;text-align:center">
																			유아가격
																		</td>
																		<td style="width:15%;text-align:center">
																			판매상태
																		</td>
																	</tr>
																</thead>
																<tbody class="air_main">
																	<?php foreach ($info['tours'] as $tour): ?>
																		<tr class="air_list_1" style="height:40px">
																			<td style="width:100px;text-align:center">
																				<input type="hidden" name="tours_idx[<?= $info['info']['info_idx'] ?>][]" class="tours_idx" value="<?= $tour['tours_idx']?>">
																				<input type="text" name="tours_subject[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tours_subject'] ?>" class="tours_subject input_txt" style="width:100%" />
																			</td>
																			<td style="text-align:center">
																				<input type="text" name="tour_price[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tour_price'] ?>" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
																			</td>
																			<td style="text-align:center">
																				<input type="text" name="tour_price_kids[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tour_price_kids'] ?>" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
																			</td>
																			<td style="text-align:center">
																				<input type="text" name="tour_price_baby[<?= $info['info']['info_idx'] ?>][]" value="<?= $tour['tour_price_baby'] ?>" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
																			</td>
																			<td style="text-align:center">
																				<select name="status[<?= $info['info']['info_idx'] ?>][]">
																					<option value="Y" <?= ($tour['status'] == 'Y') ? 'selected' : '' ?>>판매중</option>
																					<option value="N" <?= ($tour['status'] == 'N') ? 'selected' : '' ?>>중지</option>
																				</select>
																			</td>
																		</tr>
																	<?php endforeach?>
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
												<col width="15%">
											</colgroup>
											<thead>
												<tr>
													<th>기간</th>
													<th>출발요일</th>
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
														<input type="checkbox" name="yoil_0" value="" class="yoil">
														일요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_1" value="" class="yoil">
														월요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_2" value="" class="yoil">
														화요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_3" value="" class="yoil">
														수요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_4" value="" class="yoil">
														목요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_5" value="" class="yoil">
														금요일&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="yoil_6" value="" class="yoil">
														토요일&nbsp;&nbsp;&nbsp;
													</td>
													<td>
														<div style="margin:10px; display: flex; justify-content: center; gap: 5px">
															<a href="javascript:add_it(0);" class="btn btn-primary">추가</a>
															<a href="javascript:remove_it(0);" class="btn btn-primary">삭제</a>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="3">
														<table style="width:100%">
															<thead>
																<tr style="height:40px">
																	<td style="width:*;text-align:center">
																		상품명
																	</td>
																	<td style="width:15%;text-align:center">
																		성인가격
																	</td>
																	<td style="width:15%;text-align:center">
																		소아가격
																	</td>
																	<td style="width:15%;text-align:center">
																		유아가격
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
																			<input type="text" name="tour_price[0][]" value="" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
																		</td>
																		<td style="text-align:center">
																			<input type="text" name="tour_price_kids[0][]" value="" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
																		</td>
																		<td style="text-align:center">
																			<input type="text" name="tour_price_baby[0][]" value="" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
																		</td>
																		<td style="text-align:center">
																			<select name="status[0][]">
																				<option value="Y" selected>판매중</option>
																				<option value="N">중지</option>
																			</select>
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

							<a href="javascript:history.back();" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
							<?php if ($productTourInfo == "") { ?>	
								<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
							<?php } else { ?>
								<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
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
							<col width="15%">
						</colgroup>
						<thead>
							<tr>
								<th>기간</th>
								<th>출발요일</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input type="text" readonly class="datepicker" name="o_sdate[]" style="width: 150px; cursor: pointer;" value=""> ~
									<input type="text" readonly class="datepicker" name="o_edate[]" style="width: 150px; cursor: pointer;" value="">
								</td>
								<td>
									<input type="checkbox" name="yoil_0[${tableCount}]" value="Y" class="yoil"> 일요일&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="yoil_1[${tableCount}]" value="Y" class="yoil"> 월요일&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="yoil_2[${tableCount}]" value="Y" class="yoil"> 화요일&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="yoil_3[${tableCount}]" value="Y" class="yoil"> 수요일&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="yoil_4[${tableCount}]" value="Y" class="yoil"> 목요일&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="yoil_5[${tableCount}]" value="Y" class="yoil"> 금요일&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="yoil_6[${tableCount}]" value="Y" class="yoil"> 토요일&nbsp;&nbsp;&nbsp;
								</td>
								<td>
									<div style="margin:10px; display: flex; justify-content: center; gap: 5px">
										<a href="javascript:add_it(${tableCount});" class="btn btn-primary">추가</a>
										<a href="javascript:remove_it(${tableCount});" class="btn btn-primary">삭제</a>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<table style="width:100%">
										<thead>
											<tr style="height:40px">
												<td style="width:*;text-align:center">상품명</td>
												<td style="width:15%;text-align:center">성인가격</td>
												<td style="width:15%;text-align:center">소아가격</td>
												<td style="width:15%;text-align:center">유아가격</td>
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
												<td style="text-align:center">
													<select name="status[${tableCount}][]">
														<option value="Y" selected>판매중</option>
														<option value="N">중지</option>
													</select>
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
		}

		function remove_table() {
			if ($(".table_list").length > 1) {
				$(".table_list").last().remove();
			}
		}

		function add_it(tableListIndex) {
			var targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
			var newRow = `
				<tr class="air_list_1" style="height:40px">
					<td style="width:100px;text-align:center">
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
					<td style="text-align:center">
						<select name="status[${tableListIndex}][]">
							<option value="Y" selected>판매중</option>
							<option value="N">중지</option>
						</select>
					</td>
				</tr>
			`;
			targetTable.append(newRow);
		}

		function remove_it(tableListIndex) {
			var targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
			if (targetTable.find(".air_list_1").length > 1) {
				targetTable.find(".air_list_1").last().remove();
			}
		}

		$(window).load(function(){
			$("#datepicker1").datepicker("setDate", '<?=$s_date?>');
			$("#datepicker2").datepicker("setDate", '<?=$e_date?>');
		});



				$(window).load(function(){
					$("#datepicker1").datepicker("setDate", '<?=$s_date?>');
					$("#datepicker2").datepicker("setDate", '<?=$e_date?>');

				}); 				
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