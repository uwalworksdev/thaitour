<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
	div.listBottom table.listTable tbody td button {
		width: fit-content;
		border: none;
		margin: unset;
	}

	div.listBottom table.listTable .td_wrap{
		padding: 0 !important;
		border: none !important;
	}
</style>

<div id="container"> 
	<span id="print_this">
		<header id="headerContainer">
			<div class="inner">
				<h2>상품요금정보</h2>
				<div class="menus">
					<ul >
						<li><a href="/AdmMaster/_tourRegist/write_tours?search_category=&search_txt=&pg=&product_idx=<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">상품상세</span></a></li>
						<li><a href="/AdmMaster/_tourRegist/list_tours" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
						<?php if (!empty($productTourInfo)) { ?>	
							<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
						<?php } else { ?>
								<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
						<?php } ?>
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
						<!-- <col width="10%" />
						<col width="85%" /> -->
						</colgroup>
						<tbody>
							<tr height=45>
								<!-- <th>상품정보 [단위 : 바트]</th> -->
								<td class="td_wrap">
									<div style="display: flex; gap: 5px; margin-top: 5px;">
										<a href="javascript:add_table();" class="btn btn-primary">추가</a>
										<a href="javascript:copy_last_tour(<?=$product_idx?>);" class="btn btn-success">복사하기</a>
									</div>
									<?php
										$i = 0;
									?>
									<?php if ($productTourInfo): ?>
										<?php foreach ($productTourInfo as $info): 
										?>
											<div class="table_list" data-index="<?= $i ?>" style="width: 100%; margin-bottom: 20px;">
												<table style="width: 100%">
													<colgroup>
														<col width="20%">
														<col width="*">
														<col width="8%">
													</colgroup>
													<!-- <thead>
														<tr>
															<th>기간</th>
															<th>출발요일</th>
															<th>기존상품가</th>
															<th></th>
														</tr>
													</thead> -->
													<tbody>
														<tr>
															<td>
																<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
																	<div style="display: flex; justify-content: center; gap: 5px;">
																		<input type="text" name="info_name[<?=$i?>]" placeholder="상품요금명" style="width: 250px;" value="<?= $info['info']['info_name'] ?>">
																		<a href="javascript:add_tour(<?= $i ?>);" class="btn btn-primary">추가</a>
																		<a href="javascript:del_tours('<?= $info['info']['info_idx']?>', '<?= $info['tours_idx_json'] ?>');" class="btn btn-danger">삭제</a>
																	</div>
																</div>
															</td>
															<td>
																<div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: center;">

																	<div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
																		<input type="hidden" name="o_onum[<?=$i?>]" class="o_onum" value="<?=$info['info']['o_onum']?>">
																		<input type="text" readonly class="datepicker s_date" name="o_sdate[<?=$i?>]" placeholder="시작기간" style="width: 120px; cursor: pointer;" 
																			value="<?= substr($info['info']['o_sdate'], 0, 10) ?>"> ~
																		<input type="text" readonly class="datepicker e_date" placeholder="종료기간" name="o_edate[<?=$i?>]" style="width: 120px; cursor: pointer;" 
																			value="<?= substr($info['info']['o_edate'], 0, 10) ?>">
																	
																		<button class="btn btn-primary" type="button" onclick="write_day_price('<?= $info['info']['info_idx']?>', '<?=$product_idx?>')">날짜별 수정</button>

																		<input type="checkbox" class="check_change_price">수정선택
																		<input type="hidden" name="is_change_price[<?=$i?>]" class="is_change_price">
																	</div>
																	<?php
																		$count_yoil = 0;
																		for($_y = 0; $_y <= 6; $_y++) {
																			if($info['info']['yoil_'.$_y] == 'Y') {
																				$count_yoil++;
																			}
																		}

																	?>
																	<div style="display: flex; align-items: center; gap: 5px;">
																		<input type="checkbox" class="all_yoil" <?= $count_yoil == 7 ? 'checked' : '' ?>>
																		전체&nbsp;&nbsp;
																		<input type="checkbox" name="yoil_0[<?=$i?>]" class="yoil" 
																			<?= $info['info']['yoil_0'] == 'Y' ? 'checked' : '' ?>> 일요일&nbsp;&nbsp;
																		<input type="checkbox" name="yoil_1[<?=$i?>]" class="yoil" 
																			<?= $info['info']['yoil_1'] == 'Y' ? 'checked' : '' ?>> 월요일&nbsp;&nbsp;
																		<input type="checkbox" name="yoil_2[<?=$i?>]" class="yoil" 
																			<?= $info['info']['yoil_2'] == 'Y' ? 'checked' : '' ?>> 화요일&nbsp;&nbsp;
																		<input type="checkbox" name="yoil_3[<?=$i?>]" class="yoil" 
																			<?= $info['info']['yoil_3'] == 'Y' ? 'checked' : '' ?>> 수요일&nbsp;&nbsp;
																		<input type="checkbox" name="yoil_4[<?=$i?>]" class="yoil" 
																			<?= $info['info']['yoil_4'] == 'Y' ? 'checked' : '' ?>> 목요일&nbsp;&nbsp;
																		<input type="checkbox" name="yoil_5[<?=$i?>]" class="yoil" 
																			<?= $info['info']['yoil_5'] == 'Y' ? 'checked' : '' ?>> 금요일&nbsp;&nbsp;
																		<input type="checkbox" name="yoil_6[<?=$i?>]" class="yoil" 
																			<?= $info['info']['yoil_6'] == 'Y' ? 'checked' : '' ?>> 토요일&nbsp;&nbsp;
																	</div>
																</div>
															</td>
															<td>
																<div style="display: flex; gap: 5px;">
																	<input type="text" name="tour_info_price[<?=$i?>]" class="price" value="<?= number_format($info['info']['tour_info_price'] ?? 0) ?>" numberOnly=true>
																	<button class="btn_move up" onclick="moveUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																	<button class="btn_move down" onclick="moveDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																</div>
															</td>
														</tr>
														<tr>
															<td colspan="3">
																<table style="width:100%">
																	<colgroup>
																		<col width="*">
																		<col width="12%">
																		<col width="12%">
																		<col width="12%">
																		<col width="10%">
																	</colgroup>
																	<!-- <thead>
																		<tr style="height:40px">
																			<td style="width:*;text-align:center">
																				상품타입(국문/영문)
																			</td>
																			<td style="width:10%;text-align:center">
																				성인가격(단위: 바트)
																			</td>
																			<td style="width:10%;text-align:center">
																				소아가격(단위: 바트)
																			</td>
																			<td style="width:10%;text-align:center">
																				유아가격(단위: 바트)
																			</td>
																			<td style="width:10%;text-align:center">
																				판매상태
																			</td>
																		</tr>
																	</thead> -->
																	<tbody class="air_main" data-info-idx="<?= $i ?>">
																		<?php if(count($info['tours']) > 0): ?>																		
																			<?php foreach ($info['tours'] as $tour): ?>
																				<tr class="air_list_1" style="height:40px">
																					<td>
																						<input type="hidden" name="tours_idx[<?=$i?>][]" class="tours_idx" value="<?= $tour['tours_idx'] ?>">
																						<input type="hidden" name="tour_onum[<?=$i?>][]" class="tour_onum" value="<?= $tour['tour_onum'] ?>">
																						<div class="flex" style="gap: 5px;">
																							<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																							<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																							<input type="text" name="tours_subject[<?=$i?>][]" value="<?= $tour['tours_subject'] ?>" placeholder="상품타입 국문글씨로 입력해주세요" class="tours_subject input_txt" style="width:50%" />
																							<input type="text" name="tours_subject_eng[<?=$i?>][]" value="<?= $tour['tours_subject_eng'] ?>" placeholder="상품타입 영문글씨로 입력해주세요"  class="tours_subject input_txt" style="width:50%;" />
																						</div>
																					</td>
																					<td>
																						<input type="text" name="tour_price[<?=$i?>][]" value="<?= number_format($tour['price_today']['goods_price1'] ?? 0) ?>" placeholder="성인가격(단위: 바트)" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
																					</td>
																					<td>
																						<input type="text" name="tour_price_kids[<?=$i?>][]" value="<?= number_format($tour['price_today']['goods_price2'] ?? 0) ?>" placeholder="소아가격(단위: 바트)" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
																					</td>
																					<td>
																						<input type="text" name="tour_price_baby[<?=$i?>][]" value="<?= number_format($tour['price_today']['goods_price3'] ?? 0) ?>" placeholder="유아가격(단위: 바트)" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
																					</td>
																					<td>
																						<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
																							<select name="status[<?=$i?>][]">
																								<option value="Y" <?= ($tour['status'] == 'Y') ? 'selected' : '' ?>>판매중</option>
																								<option value="N" <?= ($tour['status'] == 'N') ? 'selected' : '' ?>>중지</option>
																							</select>
																							<a href="javascript:delete_tour('<?= $tour['tours_idx']?>', '<?= $info['info']['info_idx']?>', '<?=$product_idx?>');" class="btn btn-danger">삭제</a>
																						</div>
																					</td>
																				</tr>
																			<?php endforeach ?>
                                    									<?php else: ?>
																			<tr class="air_list_1" style="height:40px">
																				<td>
																					<input type="hidden" name="tours_idx[<?=$i?>][]" class="tours_idx" value="">
																					<input type="hidden" name="tour_onum[<?=$i?>][]" class="tour_onum" value="">
																					<div class="flex" style="gap: 5px;">
																						<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																						<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																						<input type="text" name="tours_subject[<?=$i?>][]" value="" placeholder="상품타입 국문글씨로 입력해주세요" class="tours_subject input_txt" style="width:50%" />
																						<input type="text" name="tours_subject_eng[<?=$i?>][]" value="" placeholder="상품타입 영문글씨로 입력해주세요"  class="tours_subject input_txt" style="width:50%;" />
																					</div>
																				</td>
																				<td>
																					<input type="text" name="tour_price[<?=$i?>][]" value="0" placeholder="성인가격(단위: 바트)" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
																				</td>
																				<td>
																					<input type="text" name="tour_price_kids[<?=$i?>][]" value="0" placeholder="소아가격(단위: 바트)" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
																				</td>
																				<td>
																					<input type="text" name="tour_price_baby[<?=$i?>][]" value="0" placeholder="유아가격(단위: 바트)" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
																				</td>
																				<td>
																					<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
																						<select name="status[<?=$i?>][]">
																							<option value="Y" selected>판매중</option>
																							<option value="N">중지</option>
																						</select>
																						<a href="javascript:remove_tours(0, 0);" class="btn btn-danger">삭제</a>
																					</div>
																				</td>
																			</tr>
                                    									<?php endif ?>

																	</tbody>
																</table>
															</td>
														</tr>
														<tr>
															<td colspan="3">
																<table style="width: 100%">
																	<colgroup>
																		<col width="7%">
																		<col width="*">
																	</colgroup>
																	
																	<tbody>
																		<tr>
																			<th>
																				옵션추가
																				<button type="button" class="btn btn-primary" onclick="add_main_option(this, <?= $i ?>);">추가</button>	
																			</th>
																			<td>
																				<input type="hidden" class="count_moption" value="<?=count($info['options'])?>">
																				<?php $j = 0;?>
																				<?php if(count($info['options']) > 0) : ?>
																					<?php foreach ($info['options'] as $moption): ?>
																						<div class="option_area">
																							<input type="hidden" name="moption_idx[<?=$i?>][<?=$j?>]" class="moption_idx" value="<?=$moption["code_idx"]?>">
																							<input type="hidden" name="moption_onum[<?=$i?>][<?=$j?>]" class="moption_onum" value="<?=$moption["onum"]?>">
																							<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
																								<colgroup>
																									<col width="10%">
																									<col width="90%">
																								</colgroup>
																								<tbody>
																								<tr height="45">
																									<th colspan="5">
																										<div class="flex__c" style="gap: 5px;">
																											옵션 <input type='text' name='moption_name[<?=$i?>][<?=$j?>]' class="moption_name"
																														placeholder="옵션명"
																														value="<?=$moption["moption_name"]?>" style="width:550px"/>
																											<!-- <button type="button" class="btn btn-primary"
																													onclick="upd_main_option('');">수정
																											</button> -->
																											<button type="button" class="btn btn-danger"
																													onclick="del_main_option('<?=$moption['code_idx']?>', this);">삭제
																											</button>
																											<button class="btn_move up" onclick="moveMOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																											<button class="btn_move down" onclick="moveMOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																										</div>
																									</th>
																								</tr>
																								<tr height="45">
																									<th>
																										추가 옵션등록
																										<div class="flex" style="margin-top:10px; gap: 5px;">
																											<button type="button"
																													onclick="add_sub_option(this, <?= $i ?>, <?=$j?>);"
																													class="btn btn-primary">추가
																											</button>
																											<!-- <button type="button"
																													onclick="upd_sub_option('');"
																													class="btn btn-success">등록
																											</button> -->
																										</div>
																									</th>
																									<td>
																										<table>
																											<colgroup>
																												<col width="*"></col>
																												<col width="15%"></col>
																												<col width="10%"></col>
																												<col width="10%"></col>
																												<col width="8%"></col>
																											</colgroup>
																											<thead>
																											<!-- <tr>
																												<th>옵션명 한글/영문</th>
																												<th>가격(단위: 바트)</th>
																												<th>적용</th>
																												<th>순서</th>
																												<th>삭제</th>
																											</tr> -->
																											</thead>
																											<tbody>
																												<?php if(count($moption['option_tours']) > 0) : ?>
																													<?php foreach ($moption['option_tours'] as $option_tour): ?>
																														<tr class="option_detail">
																															<td>
																																<div style="display: flex; gap: 5px;">
																																	<input type="hidden" name="op_tour_idx[<?=$i?>][<?= $j ?>][]" class="op_tour_idx" value="<?=$option_tour["idx"]?>">
																																	<input type="hidden" name="op_tour_onum[<?=$i?>][<?= $j ?>][]" class="op_tour_onum" value="<?=$option_tour["onum"]?>">
																																	<input type='text' name='o_name[<?=$i?>][<?= $j ?>][]' value="<?=$option_tour["option_name"]?>" 
																																			placeholder="옵션타입 국문글씨로 입력해주세요"/>
																																	<input type='text' name='o_name_eng[<?=$i?>][<?= $j ?>][]' value="<?=$option_tour["option_name_eng"]?>" 
																																			placeholder="옵션타입 영문글씨로 입력해주세요"/>
																																</div>
																															</td>
																															<td>
																																<input type='text'
																																		name='o_price[<?=$i?>][<?= $j ?>][]' placeholder="가격(단위: 바트)" value="<?=$option_tour["option_price"]?>" numberOnly=true/>
																															</td>
																															<td>
																																<select name="use_yn[<?=$i?>][<?= $j ?>][]" style="width:100%">
																																	<option value="Y" <?php if($option_tour["use_yn"] == "Y"){ echo "selected"; }?>>
																																		판매중
																																	</option>
																																	<option value="N" <?php if($option_tour["use_yn"] == "N"){ echo "selected"; }?>>
																																		중지
																																	</option>
																																</select>
																															</td>
																															<td>
																																<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																																	<button class="btn_move up" onclick="moveOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																																	<button class="btn_move down" onclick="moveOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																																</div>
																															</td>
																															<td>
																																<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																																	<!-- <button type="button" class="btn btn-primary"
																																			onclick="updOption('')">수정
																																	</button> -->
																																	<button type="button" class="btn btn-danger"
																																			onclick="delOption('<?=$option_tour['idx']?>', this)">삭제
																																	</button>
																																</div>
																															</td>
																														</tr>
																													<?php endforeach ?>
																												<?php else: ?>
																													<tr class="option_detail">
																														<td>
																															<div style="display: flex; gap: 5px;">
																																<input type="hidden" name="op_tour_idx[<?=$i?>][<?= $j ?>][]" class="op_tour_idx" value="">
																																<input type="hidden" name="op_tour_onum[<?=$i?>][<?= $j ?>][]" class="op_tour_onum" value="">
																																<input type='text' name='o_name[<?=$i?>][<?= $j ?>][]' value="" 
																																		placeholder="옵션타입 국문글씨로 입력해주세요"/>
																																<input type='text' name='o_name_eng[<?=$i?>][<?= $j ?>][]' value="" 
																																		placeholder="옵션타입 영문글씨로 입력해주세요"/>
																															</div>
																														</td>
																														<td>
																															<input type='text'
																																	name='o_price[<?=$i?>][<?= $j ?>][]' placeholder="가격(단위: 바트)" value="" numberOnly=true/>
																														</td>
																														<td>
																															<select name="use_yn[<?=$i?>][<?= $j ?>][]" style="width:100%">
																																<option value="Y" selected>
																																	판매중
																																</option>
																																<option value="N">
																																	중지
																																</option>
																															</select>
																														</td>
																														<td>
																															<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																																<button class="btn_move up" onclick="moveOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																																<button class="btn_move down" onclick="moveOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																															</div>
																														</td>
																														<td>
																															<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																								
																																<button type="button" class="btn btn-danger"
																																		onclick="delOption('', this)">삭제
																																</button>
																															</div>
																														</td>
																													</tr>
																												<?php endif ?>
																											</tbody>
																										</table>
																									</td>
																								</tr>
																								</tbody>
																							</table>
																						</div>
																					<?php $j++;?>
																					<?php endforeach ?>
																				<?php else :?>
																					<div class="option_area">
																						<input type="hidden" name="moption_idx[<?=$i?>][<?=$j?>]" class="moption_idx" value="">
																						<input type="hidden" name="moption_onum[<?=$i?>][<?=$j?>]" class="moption_onum" value="">
																						<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
																							<colgroup>
																								<col width="10%">
																								<col width="90%">
																							</colgroup>
																							<tbody>
																							<tr height="45">
																								<th colspan="5">
																									<div class="flex__c" style="gap: 5px;">
																										옵션 <input type='text' name='moption_name[<?=$i?>][<?=$j?>]' class="moption_name"
																													placeholder="옵션명"
																													value="" style="width:550px"/>
																										<!-- <button type="button" class="btn btn-primary"
																												onclick="upd_main_option('');">수정
																										</button> -->
																										<button type="button" class="btn btn-danger"
																												onclick="del_main_option('', this);">삭제
																										</button>
																										<button class="btn_move up" onclick="moveMOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																										<button class="btn_move down" onclick="moveMOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																									</div>
																								</th>
																							</tr>
																							<tr height="45">
																								<th>
																									추가 옵션등록
																									<div class="flex" style="margin-top:10px; gap: 5px;">
																										<button type="button"
																												onclick="add_sub_option(this, <?= $i ?>, <?=$j?>);"
																												class="btn btn-primary">추가
																										</button>
																									</div>
																								</th>
																								<td>
																									<table>
																										<colgroup>
																											<col width="*"></col>
																											<col width="15%"></col>
																											<col width="10%"></col>
																											<col width="10%"></col>
																											<col width="8%"></col>
																										</colgroup>
																										<thead>
																										
																										</thead>
																										<tbody>
																											<tr class="option_detail">
																												<td>
																													<div style="display: flex; gap: 5px;">
																														<input type="hidden" name="op_tour_idx[<?=$i?>][<?= $j ?>][]" class="op_tour_idx" value="">
																														<input type="hidden" name="op_tour_onum[<?=$i?>][<?= $j ?>][]" class="op_tour_onum" value="">
																														<input type='text' name='o_name[<?=$i?>][<?= $j ?>][]' value="" 
																																placeholder="옵션타입 국문글씨로 입력해주세요"/>
																														<input type='text' name='o_name_eng[<?=$i?>][<?= $j ?>][]' value="" 
																																placeholder="옵션타입 영문글씨로 입력해주세요"/>
																													</div>
																												</td>
																												<td>
																													<input type='text'
																															name='o_price[<?=$i?>][<?= $j ?>][]' placeholder="가격(단위: 바트)" value="" numberOnly=true/>
																												</td>
																												<td>
																													<select name="use_yn[<?=$i?>][<?= $j ?>][]" style="width:100%">
																														<option value="Y" selected>
																															판매중
																														</option>
																														<option value="N">
																															중지
																														</option>
																													</select>
																												</td>
																												<td>
																													<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																														<button class="btn_move up" onclick="moveOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																														<button class="btn_move down" onclick="moveOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																													</div>
																												</td>
																												<td>
																													<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																														<button type="button" class="btn btn-danger"
																																onclick="delOption('', this)">삭제
																														</button>
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
																				<?php endif ?>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<?php $i++; ?>
										<?php endforeach; ?>
									<?php else: ?>
										<div class="table_list" data-index="0" style="width: 100%; margin-bottom: 20px;">
											<table style="width: 100%">
												<colgroup>
													<col width="20%">
													<col width="*">
													<col width="8%">
												</colgroup>
									
												<tbody>
													<tr>
														<td>
														<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
															<div style="display: flex; justify-content: center; gap: 5px;">
																<input type="hidden" name="o_onum[0]" class="o_onum" value="">
																<input type="text" name="info_name[0]" placeholder="상품요금명" style="width: 250px;" value="">
																<a href="javascript:add_tours(0);" class="btn btn-primary">추가</a>
																<a href="javascript:remove_table(0);" class="btn btn-danger">삭제</a>
															</div>
															
														</div>
														</td>
														<td>
															<div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: center;">
																<div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
																	<input type="text" readonly="" class="datepicker s_date" name="o_sdate[0]" placeholder="시작기간" style="width: 120px; cursor: pointer;" value="" id=""> ~
																	<input type="text" readonly="" class="datepicker e_date" name="o_edate[0]" placeholder="종료기간" style="width: 120px; cursor: pointer;" value="" id="">

																	<input type="checkbox" class="check_change_price">수정선택
																	<input type="hidden" name="is_change_price[0]" class="is_change_price">
																</div>
																<div style="display: flex; align-items: center; gap: 5px;">
																	<input type="checkbox" class="all_yoil">
																	전체&nbsp;&nbsp;
																	<input type="checkbox" name="yoil_0[0]" value="" class="yoil">
																	일요일&nbsp;&nbsp;
																	<input type="checkbox" name="yoil_1[0]" value="" class="yoil">
																	월요일&nbsp;&nbsp;
																	<input type="checkbox" name="yoil_2[0]" value="" class="yoil">
																	화요일&nbsp;&nbsp;
																	<input type="checkbox" name="yoil_3[0]" value="" class="yoil">
																	수요일&nbsp;&nbsp;
																	<input type="checkbox" name="yoil_4[0]" value="" class="yoil">
																	목요일&nbsp;&nbsp;
																	<input type="checkbox" name="yoil_5[0]" value="" class="yoil">
																	금요일&nbsp;&nbsp;
																	<input type="checkbox" name="yoil_6[0]" value="" class="yoil">
																	토요일&nbsp;&nbsp;
																</div>
															</div>
														</td>
														<td>
															<div style="display: flex; gap: 5px;">
																<input type="text" name="tour_info_price[0]" class="price" value="0" numberOnly=true>
																<button class="btn_move up" onclick="moveUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																<button class="btn_move down" onclick="moveDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
															</div>
														</td>
													</tr>
													<tr>
														<td colspan="3">
															<table style="width:100%">
																<colgroup>
																	<col width="*">
																	<col width="12%">
																	<col width="12%">
																	<col width="12%">
																	<col width="10%">
																</colgroup>
																<tbody class="air_main">
																	<tr class="air_list_1" style="height:40px" >
																		<td style="width:100px;text-align:center">
																			<input type="hidden" name="tours_idx[0][]" class="tours_idx" value="">
																			<input type="hidden" name="tour_onum[0][]" class="tour_onum" value="">
																			<div class="flex" style="gap: 5px;">
																				<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																				<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																				<input type="text" name="tours_subject[0][]" value="" class="tours_subject input_txt" placeholder="상품타입 국문글씨로 입력해주세요" style="width:50%" />
																				<input type="text" name="tours_subject_eng[0][]" value="" class="tours_subject input_txt" placeholder="상품타입 영문글씨로 입력해주세요" style="width:50%;" />
																			</div>
																		</td>
																		<td style="text-align:center">
																			<input type="text" name="tour_price[0][]" value="" class="price tour_price input_txt" style="width:100%" placeholder="성인가격(단위: 바트)" numberOnly=true/>
																		</td>
																		<td style="text-align:center">
																			<input type="text" name="tour_price_kids[0][]" value="" class="price tour_price_kids input_txt" style="width:90%" placeholder="소아가격(단위: 바트)" numberOnly=true/>
																		</td>
																		<td style="text-align:center">
																			<input type="text" name="tour_price_baby[0][]" value="" class="price tour_price_baby input_txt" style="width:90%" placeholder="유아가격(단위: 바트)" numberOnly=true/>
																		</td>
																		<td>
																			<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
																				<select name="status[0][]">
																					<option value="Y" selected>판매중</option>
																					<option value="N">중지</option>
																				</select>
																				<a href="javascript:remove_tours(0,0);" class="btn btn-danger">삭제</a>
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="3">
															<table style="width: 100%">
																<colgroup>
																	<col width="7%">
																	<col width="*">
																</colgroup>
																
																<tbody>
																	<tr>
																		<th>
																			옵션추가
																			<button type="button" class="btn btn-primary" onclick="add_main_option(this, 0);">추가</button>	
																		</th>
																		<td>
																			<div class="option_area">
																				<input type="hidden" name="moption_idx[0][0]" class="moption_idx" value="">
																				<input type="hidden" name="moption_onum[0][0]" class="moption_onum" value="">
																				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
																					<colgroup>
																						<col width="10%">
																						<col width="90%">
																					</colgroup>
																					<tbody>
																					<tr height="45">
																						<th colspan="5">
																							<div class="flex__c" style="gap: 5px;">
																								옵션 <input type='text' name='moption_name[0][0]'
																											placeholder="옵션명"
																											value="" style="width:550px"/>
																								<!-- <button type="button" class="btn btn-primary"
																										onclick="upd_main_option('');">수정
																								</button> -->
																								<button type="button" class="btn btn-danger"
																										onclick="del_main_option('', this);">삭제
																								</button>
																								<button class="btn_move up" onclick="moveMOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																								<button class="btn_move down" onclick="moveMOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																							</div>
																						</th>
																					</tr>
																					<tr height="45">
																						<th>
																							추가 옵션등록
																							<div class="flex" style="margin-top:10px; gap: 5px;">
																								<button type="button"
																										onclick="add_sub_option(this, 0, 0);"
																										class="btn btn-primary">추가
																								</button>
																								<!-- <button type="button"
																										onclick="upd_sub_option('');"
																										class="btn btn-success">등록
																								</button> -->
																							</div>
																						</th>
																						<td>
																							<table>
																								<colgroup>
																									<col width="*"></col>
																									<col width="15%"></col>
																									<col width="10%"></col>
																									<col width="10%"></col>
																									<col width="8%"></col>
																								</colgroup>
																								<tbody>
																									<tr class="option_detail">
																										<td>
																											<div style="display: flex; gap: 5px;">
																												<input type="hidden" name="op_tour_idx[0][0][]" class="op_tour_idx" value="">
																												<input type="hidden" name="op_tour_onum[0][0][]" class="op_tour_onum" value="">
																												<input type='text' name='o_name[0][0][]' value="" placeholder="옵션타입 국문글씨로 입력해주세요" />
																												<input type='text' name='o_name_eng[0][0][]' placeholder="옵션타입 영문글씨로 입력해주세요" value="" />
																											</div>
																										</td>
																										<td>
																											<input type='text'
																													name='o_price[0][0][]' placeholder="가격(단위: 바트)" value="" numberOnly=true/>
																										</td>
																										<td>
																											<select name="use_yn[0][0][]" style="width:100%">
																												<option value="Y">
																													판매중
																												</option>
																												<option value="N">
																													중지
																												</option>
																											</select>
																										</td>
																										<td>
																										<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																											<button class="btn_move up" onclick="moveOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																											<button class="btn_move down" onclick="moveOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																										</div>
																										</td>
																										<td>
																											<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																												<button type="button" class="btn btn-danger"
																														onclick="delOption('', this)">삭제
																												</button>
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

						<a href="/AdmMaster/_tourRegist/write_tours?search_category=&search_txt=&pg=&product_idx=<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">상품상세</span></a>
						<a href="/AdmMaster/_tourRegist/list_tours" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
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
	var tableCount = <?= (isset($productTourInfo) && count($productTourInfo) > 0) ? (count($productTourInfo) - 1) : 0 ?>;
	var arr_count = [];

	$(document).on("change", ".all_yoil", function() {
		if ($(this).is(":checked")) {
			$(this).closest(".table_list").find(".yoil").prop("checked", true);
		} else {
			$(this).closest(".table_list").find(".yoil").prop("checked", false);
		}
	});

	$(document).on("change", ".check_change_price", function() {
		if ($(this).is(":checked")) {
			$(this).closest("div").find(".is_change_price").val("Y");
		} else {
			$(this).closest("div").find(".is_change_price").val("");
		}
	});

	$(document).on("change", ".yoil", function() {
		$(this).closest("td").find(".all_yoil").prop('checked', $(this).closest("td").find(".yoil:checked").length === $(this).closest("td").find(".yoil").length);
	});

	$(document).ready(function () {

		// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
		$('.priceDow').on('change', function () {
			$('#checkAll').prop('checked', $('.priceDow:checked').length === $('.priceDow').length);
		});

		initDatePicker();

	});

	function moveUp(button) {
		let current = $(button).closest(".table_list");
		let prev = current.prev(".table_list");
		if (prev.length) {
			current.insertBefore(prev);
		}
	}

	function moveDown(button) {
		let current = $(button).closest(".table_list");
		let next = current.next(".table_list");
		if (next.length) {
			current.insertAfter(next);
		}
	}

	function moveTourUp(button) {
		let current = $(button).closest("tr");
		let prev = current.prev("tr");
		if (prev.length) {
			current.insertBefore(prev);
		}
		}

	function moveTourDown(button) {
		let current = $(button).closest("tr");
		let next = current.next("tr");
		if (next.length) {
			current.insertAfter(next);
		}
	}

	function moveMOptionUp(button) {
		let current = $(button).closest(".option_area");
		let prev = current.prev(".option_area");
		if (prev.length) {
			current.insertBefore(prev);
		}
		}

	function moveMOptionDown(button) {
		let current = $(button).closest(".option_area");
		let next = current.next(".option_area");
		if (next.length) {
			current.insertAfter(next);
		}
	}

	function moveOptionUp(button) {
		let current = $(button).closest("tr");
		let prev = current.prev("tr");
		if (prev.length) {
			current.insertBefore(prev);
		}
	}

	function moveOptionDown(button) {
		let current = $(button).closest("tr");
		let next = current.next("tr");
		if (next.length) {
			current.insertAfter(next);
		}
	}

	function add_table() {
		tableCount++;
		var newTable = `
			<div class="table_list" data-index="${tableCount}" style="width: 100%; margin-bottom: 20px;">
				<table style="width: 100%">
					<colgroup>
						<col width="20%">
						<col width="*">
						<col width="8%">
					</colgroup>
					<tbody>
						<tr>
							<td>
								<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
									<div style="display: flex; justify-content: center; gap: 5px;">
										<input type="hidden" name="o_onum[${tableCount}]" class="o_onum" value="">
										<input type="text" name="info_name[${tableCount}]" placeholder="상품요금명" style="width: 250px;" value="">
										<a href="javascript:add_tours(${tableCount});" class="btn btn-primary">추가</a>
										<a href="javascript:remove_table(${tableCount});" class="btn btn-danger">삭제</a>
									</div>
									
								</div>
							</td>
							<td>
								<div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: center;">
									<div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
										<input type="text" readonly="" class="datepicker s_date" name="o_sdate[${tableCount}]" placeholder="시작기간" style="width: 120px; cursor: pointer;" value="" id=""> ~
										<input type="text" readonly="" class="datepicker e_date" name="o_edate[${tableCount}]" placeholder="종료기간" style="width: 120px; cursor: pointer;" value="" id="">

										<input type="checkbox" class="check_change_price">수정선택
										<input type="hidden" name="is_change_price[${tableCount}]" class="is_change_price">
									</div>
									<div style="display: flex; align-items: center; gap: 5px;">
										<input type="checkbox" class="all_yoil">전체&nbsp;&nbsp;
										<input type="checkbox" name="yoil_0[${tableCount}]" value="일요일" class="yoil"> 일요일&nbsp;&nbsp;
										<input type="checkbox" name="yoil_1[${tableCount}]" value="월요일" class="yoil"> 월요일&nbsp;&nbsp;
										<input type="checkbox" name="yoil_2[${tableCount}]" value="화요일" class="yoil"> 화요일&nbsp;&nbsp;
										<input type="checkbox" name="yoil_3[${tableCount}]" value="수요일" class="yoil"> 수요일&nbsp;&nbsp;
										<input type="checkbox" name="yoil_4[${tableCount}]" value="목요일" class="yoil"> 목요일&nbsp;&nbsp;
										<input type="checkbox" name="yoil_5[${tableCount}]" value="금요일" class="yoil"> 금요일&nbsp;&nbsp;
										<input type="checkbox" name="yoil_6[${tableCount}]" value="토요일" class="yoil"> 토요일&nbsp;&nbsp;
									</div>
								</div>
							</td>
							<td>
								<div style="display: flex; gap: 5px;">
									<input type="text" name="tour_info_price[${tableCount}]" class="price" value="0" numberOnly=true>
									<button class="btn_move up" onclick="moveUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
									<button class="btn_move down" onclick="moveDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
								</div>
							</td>

						</tr>
						<tr>
							<td colspan="3">
								<table style="width:100%">
									<colgroup>
										<col width="*">
										<col width="12%">
										<col width="12%">
										<col width="12%">
										<col width="10%">
									</colgroup>
									
									<tbody class="air_main">
										<tr class="air_list_1" style="height:40px">
											<td style="width:100px;text-align:center">
												<input type="hidden" name="tour_onum[${tableCount}][]" class="tour_onum" value="">
												<input type="hidden" name="tours_idx[${tableCount}][]" class="tours_idx" value="">
												<div class="flex" style="gap: 5px;">
													<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
													<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
													<input type="text" name="tours_subject[${tableCount}][]" value="" class="tours_subject input_txt" placeholder="상품타입 국문글씨로 입력해주세요" style="width: 50%" />
													<input type="text" name="tours_subject_eng[${tableCount}][]" value="" class="tours_subject input_txt" placeholder="상품타입 영문글씨로 입력해주세요" style="width: 50%;" />				
												</div>
											</td>
											<td style="text-align:center">
												<input type="text" name="tour_price[${tableCount}][]" value="" class="price tour_price input_txt" placeholder="성인가격(단위: 바트)" style="width:100%" numberOnly=true/>
											</td>
											<td style="text-align:center">
												<input type="text" name="tour_price_kids[${tableCount}][]" value="" class="price tour_price_kids input_txt" placeholder="소아가격(단위: 바트)" style="width:90%" numberOnly=true/>
											</td>
											<td style="text-align:center">
												<input type="text" name="tour_price_baby[${tableCount}][]" value="" class="price tour_price_baby input_txt" placeholder="유아가격(단위: 바트)" style="width:90%" numberOnly=true/>
											</td>
											<td>
												<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
													<select name="status[${tableCount}][]">
														<option value="Y" selected>판매중</option>
														<option value="N">중지</option>
													</select>
													<a href="javascript:remove_tours(${tableCount}, 0);" class="btn btn-danger">삭제</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<table style="width: 100%">
									<colgroup>
										<col width="7%">
										<col width="*">
									</colgroup>
									
									<tbody>
										<tr>
											<th>
												옵션추가
												<button type="button" class="btn btn-primary" onclick="add_main_option(this, ${tableCount});">추가</button>	
											</th>
											<td>
												<div class="option_area">
													<input type="hidden" name="moption_onum[${tableCount}][0]" class="moption_onum" value="">	
													<input type="hidden" name="moption_idx[${tableCount}][0]" class="moption_idx" value="">
													<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
														<colgroup>
															<col width="10%">
															<col width="90%">
														</colgroup>
														<tbody>
														<tr height="45">
															<th colspan="5">
																<div class="flex__c" style="gap: 5px;">
																	옵션 <input type='text' name='moption_name[${tableCount}][0]'
																				placeholder="옵션명"			
																				value="" style="width:550px"/>
																	<button type="button" class="btn btn-danger"
																			onclick="del_main_option('', this);">삭제
																	</button>
																	<button class="btn_move up" onclick="moveMOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																	<button class="btn_move down" onclick="moveMOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																</div>
															</th>
														</tr>
														<tr height="45">
															<th>
																추가 옵션등록
																<div class="flex" style="margin-top:10px; gap: 5px;">
																	<button type="button"
																			onclick="add_sub_option(this, ${tableCount}, 0);"
																			class="btn btn-primary">추가
																	</button>
																</div>
															</th>
															<td>
																<table>
																	<colgroup>
																		<col width="*"></col>
																		<col width="15%"></col>
																		<col width="10%"></col>
																		<col width="10%"></col>
																		<col width="8%"></col>
																	</colgroup>
																	<tbody>
																		<tr class="option_detail">
																			<td>
																				<div style="display: flex; gap: 5px;">
																					<input type="hidden" name="op_tour_onum[[${tableCount}][0][]" class="op_tour_onum" value="">
																					<input type="hidden" name="op_tour_idx[${tableCount}][0][]" class="op_tour_idx" value="">
																					<input type='text' name='o_name[${tableCount}][0][]' placeholder="옵션타입 국문글씨로 입력해주세요" value="" />
																					<input type='text' name='o_name_eng[${tableCount}][0][]' placeholder="옵션타입 영문글씨로 입력해주세요" value="" />	
																				</div>
																			</td>
																			<td>
																				<input type='text'
																						name='o_price[${tableCount}][0][]' value="" placeholder="가격(단위: 바트)" numberOnly=true/>
																			</td>
																			<td>
																				<select name="use_yn[${tableCount}][0][]" style="width:100%">
																					<option value="Y">
																						판매중
																					</option>
																					<option value="N">
																						중지
																					</option>
																				</select>
																			</td>
																			<td>
																				<div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
																					<button class="btn_move up" onclick="moveOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																					<button class="btn_move down" onclick="moveOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																				</div>
																			</td>
																			<td>
																				<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																					<button type="button" class="btn btn-danger"
																							onclick="delOption('', this)">삭제
																					</button>
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
		// $(".datepicker").datepicker();
		initDatePicker();
		$(".price").number(true);
	}

	function initDatePicker() {
		$(".s_date").datepicker({
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
				$(this).closest("td").find(".e_date").datepicker("option", "minDate", selectedDate);
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


		$(".e_date").datepicker({
			showButtonPanel: true
			, onClose: function (selectedDate) {
				// To 날짜 선택기의 최소 날짜를 설정
				$(this).closest("td").find(".s_date").datepicker("option", "maxDate", selectedDate);
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
	}

	function remove_table(tableIndex) {
		var targetTable = $(".table_list[data-index='" + tableIndex + "']");
		if ($(".table_list").length > 1) {
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
					<input type="hidden" name="tour_onum[${tableListIndex}][]" class="tour_onum" value="">

					<div class="flex" style="gap: 5px;">
						<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
						<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
						<input type="text" name="tours_subject[${tableListIndex}][]" value="" class="tours_subject input_txt" placeholder="상품타입 국문글씨로 입력해주세요" style="width:50%" />
						<input type="text" name="tours_subject_eng[${tableListIndex}][]" value="" class="tours_subject input_txt" placeholder="상품타입 영문글씨로 입력해주세요" style="width: 50%;" />
					</div>	
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price[${tableListIndex}][]" value="" class="price tour_price input_txt" style="width:100%" placeholder="성인가격(단위: 바트)" numberOnly=true/>
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price_kids[${tableListIndex}][]" value="" class="price tour_price_kids input_txt" style="width:90%" placeholder="소아가격(단위: 바트)" numberOnly=true/>
				</td>
				<td style="text-align:center">
					<input type="text" name="tour_price_baby[${tableListIndex}][]" value="" class="price tour_price_baby input_txt" style="width:90%" placeholder="유아가격(단위: 바트)" numberOnly=true/>
				</td>
				<td>
					<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
						<select name="status[${tableListIndex}][]">
							<option value="Y" selected>판매중</option>
							<option value="N">중지</option>
						</select>
						<a href="javascript:remove_tours(${tableListIndex}, ${rowIndex});" class="btn btn-danger">삭제</a>
					</div>
				</td>
			</tr>
		`;

		targetTable.append(newRow);
		$(".price").number(true);
	}

	function remove_tours(tableListIndex, rowIndex) {
		let targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
    
		if (targetTable.find(".air_list_1").length > 1) {
			targetTable.find(".air_list_1").eq(rowIndex).remove();
		} else {
			alert("최소 하나의 투어는 유지해야 합니다."); 
		}
	}

	function add_tour(infoIdx) {
		var targetTable = $(".table_list[data-index='" + infoIdx + "']").find(".air_main");
		var rowIndex = targetTable.find(".air_list_1").length;

		var newRow = `
			<tr class="air_list_1" style="height:40px">
				<td>
					<input type="hidden" name="tour_onum[${infoIdx}][]" class="tour_onum" value="">
					<input type="hidden" name="tours_idx[${infoIdx}][]" class="tours_idx" value="new">
					<div class="flex" style="gap: 5px;">
						<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
						<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
						<input type="text" name="tours_subject[${infoIdx}][]" value="" class="tours_subject input_txt" placeholder="상품타입 국문글씨로 입력해주세요" style="width:50%" />
						<input type="text" name="tours_subject_eng[${infoIdx}][]" value="" class="tours_subject input_txt" placeholder="상품타입 영문글씨로 입력해주세요" style="width: 50%;" />
					</div>
				</td>
				<td>
					<input type="text" name="tour_price[${infoIdx}][]" value="" class="price tour_price input_txt" style="width:100%" placeholder="성인가격(단위: 바트)" numberOnly=true/>
				</td>
				<td>
					<input type="text" name="tour_price_kids[${infoIdx}][]" value="" class="price tour_price_kids input_txt" style="width:90%" placeholder="소아가격(단위: 바트)" numberOnly=true/>
				</td>
				<td>
					<input type="text" name="tour_price_baby[${infoIdx}][]" value="" class="price tour_price_baby input_txt" style="width:90%" placeholder="유아가격(단위: 바트)" numberOnly=true/>
				</td>
				<td>
					<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
						<select name="status[${infoIdx}][]">
							<option value="Y" selected>판매중</option>
							<option value="N">중지</option>
						</select>
						<a href="javascript:remove_tours(${infoIdx}, ${rowIndex});" class="btn btn-danger">삭제</a>
					</div>
				</td>
			</tr>
		`;

		targetTable.append(newRow);
		$(".price").number(true);
	}

	function add_main_option(button, idx) {

		let count_moption = Number($(button).closest("tr").find("> td").find(".count_moption").val() ?? 0)
		let count = count_moption > 0 ? (count_moption - 1) : 0;
		
		if(!arr_count[idx] && arr_count[idx] != 0){
			arr_count[idx] = count;			
		}
		arr_count[idx]++;

		let html = `
			<div class="option_area">
				<input type="hidden" name="moption_idx[${idx}][${arr_count[idx]}]" class="moption_idx" value="">
				<input type="hidden" name="moption_onum[${idx}][${arr_count[idx]}]" class="moption_onum" value="">

				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<tbody>
					<tr height="45">
						<th colspan="5">
							<div class="flex__c" style="gap: 5px;">
								옵션 <input type='text' name='moption_name[${idx}][${arr_count[idx]}]'
										placeholder="옵션명"	
										value="" style="width:550px"/>
								<button type="button" class="btn btn-danger"
										onclick="del_main_option('', this);">삭제
								</button>
								<button class="btn_move up" onclick="moveMOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
								<button class="btn_move down" onclick="moveMOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
							</div>
						</th>
					</tr>
					<tr height="45">
						<th>
							추가 옵션등록
							<div class="flex" style="margin-top:10px; gap: 5px;">
								<button type="button"
										onclick="add_sub_option(this, ${idx}, ${arr_count[idx]});"
										class="btn btn-primary">추가
								</button>
							</div>
						</th>
						<td>
							<table>
								<colgroup>
									<col width="*"></col>
									<col width="15%"></col>
									<col width="10%"></col>
									<col width="10%"></col>
									<col width="8%"></col>
								</colgroup>
								<tbody>
									<tr class="option_detail">
										<td>
											<div style="display: flex; gap: 5px;">
												<input type="hidden" name="op_tour_onum[${idx}][${arr_count[idx]}][]" class="op_tour_onum" value="">
												<input type="hidden" name="op_tour_idx[${idx}][${arr_count[idx]}][]" class="op_tour_idx" value="">
												<input type='text' name='o_name[${idx}][${arr_count[idx]}][]' placeholder="옵션타입 국문글씨로 입력해주세요" value=""/>
												<input type='text' name='o_name_eng[${idx}][${arr_count[idx]}][]' placeholder="옵션타입 영문글씨로 입력해주세요" value=""/>
											</div>
										</td>
										<td>
											<input type='text'
													name='o_price[${idx}][${arr_count[idx]}][]' placeholder="가격(단위: 바트)" numberOnly=true/>
										</td>
										<td>
											<select name="use_yn[${idx}][${arr_count[idx]}][]" style="width:100%">
												<option value="Y">
													판매중
												</option>
												<option value="N">
													중지
												</option>
											</select>
										</td>
										<td>
											<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
												<button class="btn_move up" onclick="moveOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
												<button class="btn_move down" onclick="moveOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
											</div

										</td>
										<td>
											<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
												<button type="button" class="btn btn-danger"
														onclick="delOption('', this)">삭제
												</button>
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

		$(button).closest("tr").find("> td").append(html);
	}

	function add_sub_option(button, info_idx, op_idx) {
		let html = `
			<tr class="option_detail">
				<td>
					<div style="display: flex; gap: 5px;">
						<input type="hidden" name="op_tour_onum[${info_idx}][${op_idx}][]" class="op_tour_onum" value="">
						<input type="hidden" name="op_tour_idx[${info_idx}][${op_idx}][]" class="op_tour_idx" value="">
						<input type='text' name='o_name[${info_idx}][${op_idx}][]' placeholder="옵션타입 국문글씨로 입력해주세요" value=""/>
						<input type='text' name='o_name_eng[${info_idx}][${op_idx}][]' placeholder="옵션타입 영문글씨로 입력해주세요" value=""/>
					</div>
				</td>
				<td>
					<input type='text'
							name='o_price[${info_idx}][${op_idx}][]' placeholder="가격(단위: 바트)" numberOnly=true/>
				</td>
				<td>
					<select name="use_yn[${info_idx}][${op_idx}][]" style="width:100%">
						<option value="Y">
							판매중
						</option>
						<option value="N">
							중지
						</option>
					</select>
				</td>
				<td>
					<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
						<button class="btn_move up" onclick="moveOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
						<button class="btn_move down" onclick="moveOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
					</div>
				</td>
				<td>
					<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
						<button type="button" class="btn btn-danger"
								onclick="delOption('', this)">삭제
						</button>
					</div>
				</td>
			</tr>
		`;

		$(button).closest("tr").find("table tbody").append(html);
	}

	$(window).load(function(){
		$("#datepicker1").datepicker("setDate", '<?=$s_date?>');
		$("#datepicker2").datepicker("setDate", '<?=$e_date?>');
	});

	function copy_last_tour(product_idx) {
		if (!confirm("이 제품을 복사하시겠습니까?")) {
			return false;
		}
		$.ajax({
			url: "/AdmMaster/_tours/copy_last_tour",
			type: "POST",
			data: {
				"product_idx": product_idx,
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				alert(data.message);
				if(data.result){
					location.reload();
				}
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
			}
		});
	}

	function delete_tour(tours_idx, info_idx, product_idx) {
		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		$.ajax({
			url: "/AdmMaster/_tours/del_tour_option",
			type: "POST",
			data: {
				"tours_idx": tours_idx,
				"info_idx": info_idx,
				"product_idx": product_idx
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

	function del_main_option(idx, button){

		if(!idx){
			let el = $(button).closest("td");
			if(el.find(".option_area").length <= 1){
				alert("최소 하나의 투어는 유지해야 합니다.");
				return false;
			}
		}

		if(idx){
			if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
				return false;
			}

			$.ajax({
				url: "/AdmMaster/_tours/del_main_option",
				type: "POST",
				data: {
					"code_idx": idx,
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					alert(data.message);
					// $(button).closest(".option_area").remove();
					location.reload();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
				}
			});
		}else{
			$(button).closest(".option_area").remove();
		}
	}

	function delOption(idx, button){

		if(!idx){
			let el = $(button).closest("table");
			if(el.find(".option_detail").length <= 1){
				alert("최소 하나의 투어는 유지해야 합니다.");
				return false;
			}
		}

		if(idx){
			if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
				return false;
			}

			$.ajax({
				url: "/AdmMaster/_tours/del_sub_option",
				type: "POST",
				data: {
					"idx": idx,
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					alert(data.message);
					// $(button).closest("tr").remove();
					location.reload();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
				}
			});
		}else{
			$(button).closest("tr").remove();
		}

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

	function write_day_price(info_idx, product_idx){
		location.href = "/AdmMaster/_tourRegist/list_tours_price?info_idx="+info_idx+"&product_idx="+product_idx;
	}


</script>

<script>
	function send_it(){
		var frm = document.frm;

		for (i = 0; i < $(".tours_idx").length; i++)
		{
			if ($(".tours_subject:eq("+i+")").val() == "")
			{
				$(".tours_subject:eq("+i+")").focus();
				alert("상품명을 입력해주셔야 합니다.");
				return;
			}
		}

		for (i = 0; i < $(".tours_idx").length; i++)
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

		$(".table_list").each(function() {
			let o_onum = $(this).index();
			$(this).find(".o_onum").val(o_onum);
			$(this).find(".air_list_1").each(function() {
				let tour_onum = $(this).index();
				$(this).find(".tour_onum").val(tour_onum);
			});

			$(this).find(".option_area").each(function() {
				let moption_onum = $(this).index();
				$(this).find(".moption_onum").val(moption_onum);
				$(this).find(".option_detail").each(function() {
					let op_tour_onum = $(this).index();
					$(this).find(".op_tour_onum").val(op_tour_onum);
				});
			});
		});

		$(".price").each(function () {
			let val = $(this).val();
			if (val) {
				$(this).val(val.replace(/,/g, ''));
			}
		});

		frm.submit();
	}
</script>

<? include "../_include/_footer.php"; ?>
<?= $this->endSection() ?>