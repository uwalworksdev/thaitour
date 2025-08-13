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
                <h2>스파/쇼·입장권/레스토랑 상품정보입력</h2>
                <div class="menus">
                    <ul >
                        <li><a href="/AdmMaster/_tourRegist/write_spas?search_category=&search_name=&pg=&product_idx=<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">상품상세</span></a></li>
                        <li><a href="/AdmMaster/_tourRegist/list_spas" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
                        <?php if (!empty($productSpasInfo)) { ?>	
                            <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">저장</span></a>
                        <?php } else { ?>
                                <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!-- // inner --> 
            
        </header>
        <!-- // headerContainer -->
        
        <form name=frm action="<?= route_to('admin.api.spa_.write_info_ok') ?>"  method=post >
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
                                        <a href="javascript:copy_last_spa(<?=$product_idx?>);" class="btn btn-success">복사하기</a>
                                    </div>
                                    <?php
                                        $i = 0;
                                    ?>
                                    <?php if ($productSpasInfo): ?>
                                        <?php foreach ($productSpasInfo as $info): 
                                        ?>
                                            <div class="table_list" data-index="<?= $i ?>" style="width: 100%; margin-bottom: 20px;">
                                                <table style="width: 100%">
													<colgroup>
														<col width="20%">
														<col width="*">
														<col width="11%">
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
																		<a href="javascript:add_spa(<?= $i ?>, '<?= $info['info']['info_idx']?>');" class="btn btn-primary">추가</a>
																		<a href="javascript:del_spas('<?= $info['info']['info_idx']?>', '<?= $info['spas_idx_json'] ?>');" class="btn btn-danger">삭제</a>
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
																	<input type="text" name="spas_info_price[<?=$i?>]" class="price" placeholder="기존상품가" value="<?= number_format($info['info']['spas_info_price']) ?>" numberOnly=true>
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
																		<col width="10%">
																	</colgroup>
                                                                    <!-- <thead>
                                                                        <tr style="height:40px">
                                                                            <td style="width:*;text-align:center">
                                                                                상품타입(국문/영문)
                                                                            </td>
                                                                            <td style="width:15%;text-align:center">
                                                                                성인가격(단위: 바트)
                                                                            </td>
                                                                            <td style="width:15%;text-align:center">
                                                                                소아가격(단위: 바트)
                                                                            </td>
                                                                            <td style="width:15%;text-align:center">
                                                                                판매상태
                                                                            </td>
                                                                        </tr>
                                                                    </thead> -->
                                                                    <tbody class="air_main" data-info-idx="<?= $i ?>">
																		<?php if(count($info['spas']) > 0): ?>
																			<?php foreach ($info['spas'] as $spa): ?>
																				<tr class="air_list_1" style="height:40px">
																					<td>
																						<input type="hidden" name="spas_idx[<?=$i?>][]" class="spas_idx" value="<?= $spa['spas_idx'] ?>">
																						<input type="hidden" name="spa_onum[<?=$i?>][]" class="spa_onum" value="<?= $spa['spa_onum'] ?>">
																						<input type="hidden" name="spas_explain[<?=$i?>][]" class="spas_explain" value="<?= $spa['spas_explain'] ?>">
																						<input type="hidden" name="is_explain[<?=$i?>][]" class="hidden_is_explain" value="<?= $spa['is_explain'] ?>">

																						<div style="display: flex; gap: 5px; align-items: center;">
																							<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																							<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																							<input type="text" name="spas_subject[<?=$i?>][]" value="<?= $spa['spas_subject'] ?>" placeholder="상품타입 국문글씨 입력해주세요" class="spas_subject input_txt" style="width:50%" />
																							<input type="text" name="spas_subject_eng[<?=$i?>][]" value="<?= $spa['spas_subject_eng'] ?>" placeholder="상품타입 영문글씨 입력해주세요"  class="spas_subject_eng input_txt" style="width:50%;" />
																							<input type="checkbox" onchange="InitPopup(event, this);" class="is_explain" value="Y" <?= ($spa['is_explain'] == 'Y') ? 'checked' : '' ?>>
																							<label class="explain_label" onclick="InitPopup(event, this);" style="flex: 0 0 auto;">설명</label>
																						</div>
																					</td>
																					<td>
																						<input type="text" name="spas_price[<?=$i?>][]" value="<?= number_format($spa['price_today']['goods_price1'] ?? 0) ?>" placeholder="성인가격(단위: 바트)" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
																					</td>
																					<td>
																						<input type="text" name="spas_price_kids[<?=$i?>][]" value="<?= number_format($spa['price_today']['goods_price2'] ?? 0) ?>" placeholder="소아가격(단위: 바트)" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
																					</td>
			
																					<td>
																						<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
																							<select name="status[<?=$i?>][]">
																								<option value="Y" <?= ($spa['status'] == 'Y') ? 'selected' : '' ?>>판매중</option>
																								<option value="N" <?= ($spa['status'] == 'N') ? 'selected' : '' ?>>중지</option>
																							</select>
																							<a href="javascript:delete_spa('<?= $spa['spas_idx']?>', '<?= $info['info']['info_idx']?>', '<?=$product_idx?>');" class="btn btn-danger">삭제</a>
																						</div>
																					</td>
																				</tr>
																			<?php endforeach ?>
                                    									<?php else: ?>
																			<tr class="air_list_1" style="height:40px">
                                                                                <td>
                                                                                	<input type="hidden" name="spas_idx[<?=$i?>][]" class="spas_idx" value="">
																					<input type="hidden" name="spa_onum[<?=$i?>][]" class="spa_onum" value="">
																					<input type="hidden" name="spas_explain[<?=$i?>][]" class="spas_explain" value="">
																					<input type="hidden" name="is_explain[<?=$i?>][]" class="hidden_is_explain" value="">

																					<div style="display: flex; gap: 5px; align-items: center;">
																						<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																						<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																						<input type="text" name="spas_subject[<?=$i?>][]" value="" placeholder="상품타입 국문글씨 입력해주세요" class="spas_subject input_txt" style="width:50%" />
																						<input type="text" name="spas_subject_eng[<?=$i?>][]" value="" placeholder="상품타입 영문글씨 입력해주세요"  class="spas_subject_eng input_txt" style="width:50%;" />
																						<input type="checkbox" onchange="InitPopup(event, this);" class="is_explain" value="Y">
																						<label class="explain_label" onclick="InitPopup(event, this);" style="flex: 0 0 auto;">설명</label>
																					</div>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="spas_price[<?=$i?>][]" value="0" placeholder="성인가격(단위: 바트)" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="spas_price_kids[<?=$i?>][]" value="0" placeholder="소아가격(단위: 바트)" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
                                                                                </td>
         
                                                                                <td>
                                                                                    <div style="display: flex; gap: 10px; align-items: center; justify-content: center">
                                                                                        <select name="status[<?=$i?>][]">
                                                                                            <option value="Y" selected>판매중</option>
                                                                                            <option value="N">중지</option>
                                                                                        </select>
                                                                                        <a href="javascript:remove_spas(0, 0);" class="btn btn-danger">삭제</a>
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
																											<!-- <thead>
																											<tr>
																												<th>옵션명 한글/영문</th>
																												<th>가격(단위: 바트)</th>
																												<th>적용</th>
																												<th>순서</th>
																												<th>삭제</th>
																											</tr>
																											</thead> -->
																											<tbody>
																												<?php if(count($moption['option_spas']) > 0) : ?>
																													<?php foreach ($moption['option_spas'] as $option_spa): ?>
																														<tr class="option_detail">
																															<td>
																																<div style="display: flex; gap: 5px;">
																																	<input type="hidden" name="op_spa_idx[<?=$i?>][<?= $j ?>][]" class="op_spa_idx" value="<?=$option_spa["idx"]?>">
																																	<input type="hidden" name="op_spa_onum[<?=$i?>][<?= $j ?>][]" class="op_spa_onum" value="<?=$option_spa["onum"]?>">
																																	<input type='text' name='o_name[<?=$i?>][<?= $j ?>][]' value="<?=$option_spa["option_name"]?>" placeholder="옵션타입 국문글씨로 입력해주세요"/>
																																	<input type='text' name='o_name_eng[<?=$i?>][<?= $j ?>][]' value="<?=$option_spa["option_name_eng"]?>" placeholder="옵션타입 영문글씨로 입력해주세요"/>
																																</div>
																															</td>
																															<td>
																																<input type='text'
																																		name='o_price[<?=$i?>][<?= $j ?>][]' placeholder="가격(단위: 바트)" value="<?=$option_spa["option_price"]?>" numberOnly=true/>
																															</td>
																															<td>
																																<select name="use_yn[<?=$i?>][<?= $j ?>][]" style="width:100%">
																																	<option value="Y" <?php if($option_spa["use_yn"] == "Y"){ echo "selected"; }?>>
																																		판매중
																																	</option>
																																	<option value="N" <?php if($option_spa["use_yn"] == "N"){ echo "selected"; }?>>
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
																															<!-- <td>
																																<input type='text' name='o_num[<?=$i?>][<?= $j ?>][]' value="<?=$option_spa["onum"]?>" numberOnly=true/>
																															</td> -->
																															<td>
																																<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																																	<button type="button" class="btn btn-danger"
																																			onclick="delOption('<?=$option_spa['idx']?>', this)">삭제
																																	</button>
																																</div>
																															</td>
																														</tr>
																													<?php endforeach ?>
																												<?php else: ?>
																													<tr class="option_detail">
																														<td>
																															<div style="display: flex; gap: 5px;">
																																<input type="hidden" name="op_spa_idx[<?=$i?>][<?= $j ?>][]" class="op_spa_idx" value="">
																																<input type="hidden" name="op_spa_onum[<?=$i?>][<?= $j ?>][]" class="op_spa_onum" value="">
																																<input type='text' name='o_name[<?=$i?>][<?= $j ?>][]' value="" placeholder="옵션타입 국문글씨로 입력해주세요"/>
																																<input type='text' name='o_name_eng[<?=$i?>][<?= $j ?>][]' value="" placeholder="옵션타입 영문글씨로 입력해주세요"/>
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

                                                                                                        <tbody>
																											<tr class="option_detail">
																												<td>
																													<div style="display: flex; gap: 5px;">
																														<input type="hidden" name="op_spa_idx[<?=$i?>][<?= $j ?>][]" class="op_spa_idx" value="">
																														<input type="hidden" name="op_spa_onum[<?=$i?>][<?= $j ?>][]" class="op_spa_onum" value="">
																														<input type='text' name='o_name[<?=$i?>][<?= $j ?>][]' value="" placeholder="옵션타입 국문글씨로 입력해주세요"/>
																														<input type='text' name='o_name_eng[<?=$i?>][<?= $j ?>][]' value="" placeholder="옵션타입 영문글씨로 입력해주세요"/>
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
                                        <!-- <div class="table_list" data-index="0" style="width: 100%; margin-bottom: 20px;">
                                            <table style="width: 100%">
                                                <colgroup>
													<col width="20%">
													<col width="*">
													<col width="11%">
                                                </colgroup>

                                                <tbody>
                                                    <tr>
														<td>
															<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
																<div style="display: flex; justify-content: center; gap: 5px;">
																	<input type="hidden" name="o_onum[0]" class="o_onum" value="">
																	<input type="text" name="info_name[0]" placeholder="상품요금명" style="width: 250px;" value="">
																	<a href="javascript:add_spas(0);" class="btn btn-primary">추가</a>
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
																<input type="text" name="spas_info_price[0]" class="price" numberOnly=true>
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
																	<col width="10%">
																</colgroup>
                                                                
                                                                <tbody class="air_main">
                                                                    <tr class="air_list_1" style="height:40px" >
                                                                        <td style="width:100px;text-align:center">
                                                                            <input type="hidden" name="spas_idx[0][]" class="spas_idx" value="">
																			<input type="hidden" name="spa_onum[0][]" class="spa_onum" value="">
																			<input type="hidden" name="spas_explain[0][]" class="spas_explain" value="">
																			<input type="hidden" name="is_explain[0][]" class="hidden_is_explain" value="">

																			<div style="display: flex; gap: 5px; align-items: center;">
																				<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
																				<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
																				<input type="text" name="spas_subject[0][]" value="" class="spas_subject input_txt" placeholder="국문글씨 입력해주세요" style="width:50%" />
																				<input type="text" name="spas_subject_eng[0][]" value="" class="spas_subject_eng input_txt" placeholder="영문글씨 입력해주세요" style="width:50%;" />
																				<input type="checkbox" onchange="InitPopup(event, this);" class="is_explain" value="Y">
																				<label class="explain_label" onclick="InitPopup(event, this);" style="flex: 0 0 auto;">설명</label>
																			</div>
                                                                        </td>
                                                                        <td style="text-align:center">
                                                                            <input type="text" name="spas_price[0][]" placeholder="성인가격(단위: 바트)" value="" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
                                                                        </td>
                                                                        <td style="text-align:center">
                                                                            <input type="text" name="spas_price_kids[0][]" placeholder="소아가격(단위: 바트)" value="" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
                                                                        </td>
                                                                        <td>
                                                                            <div style="display: flex; gap: 10px; align-items: center; justify-content: center">
                                                                                <select name="status[0][]">
                                                                                    <option value="Y" selected>판매중</option>
                                                                                    <option value="N">중지</option>
                                                                                </select>
                                                                                <a href="javascript:remove_spas(0,0);" class="btn btn-danger">삭제</a>
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
																												<input type="hidden" name="op_spa_idx[0][0][]" class="op_spa_idx" value="">
																												<input type="hidden" name="op_spa_onum[0][0][]" class="op_spa_onum" value="">
																												<input type='text' name='o_name[0][0][]' value="" placeholder="옵션타입 국문글씨로 입력해주세요"/>
																												<input type='text' name='o_name_eng[0][0][]' placeholder="옵션타입 영문글씨로 입력해주세요"/>
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
                                        </div> -->
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

                        <a href="/AdmMaster/_tourRegist/write_spas?search_category=&search_txt=&pg=&product_idx=<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">상품상세</span></a>
                        <a href="/AdmMaster/_tourRegist/list_spas" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        <?php if (!empty($productSpasInfo)) { ?>	
                            <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">저장</span></a>
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

<div class="popup_" id="popupDesc_" data-element="">
	<div class="popup_area_ popup_area_xl_">
		<div class="popup_top_">
			<p></p>
			<p>
				<button type="button" class="btn_close_" onclick="TogglePopup();">X</button>
			</p>
		</div>
		<div class="popup_content_">
			<textarea class="text_desc" style="width: 100%; height: 150px; resize: none;"></textarea>
		</div>
		<div class="popup_bottom_">
			<button type="button" class="" onclick="TogglePopup();">취소</button>
			<button type="button" class="" onclick="UpdateDesc();">확인</button>
		</div>
	</div>
</div>

<script>
	var tableCount = <?= (isset($productSpasInfo) && count($productSpasInfo) > 0) ? (count($productSpasInfo) - 1) : 0 ?>;
	var arr_count = [];

	function TogglePopup() {
        $("#popupDesc_").toggleClass('show_');
    }

	function resetContent() {
		$("#popupDesc_").find(".text_desc").val("");
	}

	function InitPopup(e, el){
		resetContent();
		e.stopPropagation();
		let content = $(el).closest("td").find(".spas_explain").val();
		const checkbox = $(el).closest("div").find(".is_explain");
		
		if ($(el).hasClass('is_explain')) {
			if(checkbox.is(":checked")){
				$(el).closest("td").find(".hidden_is_explain").val('Y');
			}else{
				$(el).closest("td").find(".hidden_is_explain").val('');
			}
		}
		else if($(el).hasClass('explain_label')){
			$("#popupDesc_").data("element", $(el));
			$("#popupDesc_").find(".text_desc").val(content);
			TogglePopup();
		}

	}

	function UpdateDesc() {
		const originalElement = $("#popupDesc_").data("element");
		let content = $("#popupDesc_").find(".text_desc").val();

		originalElement.closest("td").find(".spas_explain").val(content);
		TogglePopup();
	}

	$(document).on("click", ".explain_label", function() {
		const checkbox = $(this).closest("div").find(".is_explain");

		if (checkbox.length) {
			checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
			if(!checkbox.is(":checked")){
				$(this).closest("td").find(".hidden_is_explain").val('Y');
				$("#popupDesc_").data("element", $(this));
			}else{
				$(this).closest("td").find(".hidden_is_explain").val('');
			}
			TogglePopup();
		}
	});

	$(document).on("change", ".check_change_price", function() {
		if ($(this).is(":checked")) {
			$(this).closest("div").find(".is_change_price").val("Y");
		} else {
			$(this).closest("div").find(".is_change_price").val("");
		}
	});

	$(document).on("change", ".all_yoil", function() {
		if ($(this).is(":checked")) {
			$(this).closest(".table_list").find(".yoil").prop("checked", true);
		} else {
			$(this).closest(".table_list").find(".yoil").prop("checked", false);
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

		if (!confirm("추가 하시겠습니까?")) {
			return false;
		}
		$.ajax({
			url: "<?= route_to('admin.api.spa_.add_spa_product_info') ?>",
			type: "POST",
			data: {
				"product_idx": <?= $product_idx ?>,
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				if(data.result){
					location.reload();
				}else{
					alert(data.message);
				}
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
			}
		});

		// tableCount++;
		// var newTable = `
		// 	<div class="table_list" data-index="${tableCount}" style="width: 100%; margin-bottom: 20px;">
		// 		<table style="width: 100%">
		// 			<colgroup>
		// 				<col width="20%">
		// 				<col width="*">
		// 				<col width="15%">
		// 			</colgroup>
		// 			<tbody>
		// 				<tr>
		// 					<td>
		// 						<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
		// 							<div style="display: flex; justify-content: center; gap: 5px;">
		// 								<input type="hidden" name="o_onum[${tableCount}]" class="o_onum" value="">
		// 								<input type="text" name="info_name[${tableCount}]" placeholder="상품요금명" style="width: 250px;" value="">
		// 								<a href="javascript:add_spas(${tableCount});" class="btn btn-primary">추가</a>
		// 								<a href="javascript:remove_table(${tableCount});" class="btn btn-danger">삭제</a>
		// 							</div>
									
		// 						</div>
		// 					</td>
		// 					<td>
		// 						<div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: center;">
		// 							<div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
		// 								<input type="text" readonly="" class="datepicker s_date" name="o_sdate[${tableCount}]" placeholder="시작기간" style="width: 120px; cursor: pointer;" value="" id=""> ~
		// 								<input type="text" readonly="" class="datepicker e_date" name="o_edate[${tableCount}]" placeholder="종료기간" style="width: 120px; cursor: pointer;" value="" id="">

		// 								<input type="checkbox" class="check_change_price">수정선택
		// 								<input type="hidden" name="is_change_price[${tableCount}]" class="is_change_price">
		// 							</div>
		// 							<div style="display: flex; align-items: center; gap: 5px;">
		// 								<input type="checkbox" class="all_yoil">전체&nbsp;&nbsp;
		// 								<input type="checkbox" name="yoil_0[${tableCount}]" value="일요일" class="yoil"> 일요일&nbsp;&nbsp;
		// 								<input type="checkbox" name="yoil_1[${tableCount}]" value="월요일" class="yoil"> 월요일&nbsp;&nbsp;
		// 								<input type="checkbox" name="yoil_2[${tableCount}]" value="화요일" class="yoil"> 화요일&nbsp;&nbsp;
		// 								<input type="checkbox" name="yoil_3[${tableCount}]" value="수요일" class="yoil"> 수요일&nbsp;&nbsp;
		// 								<input type="checkbox" name="yoil_4[${tableCount}]" value="목요일" class="yoil"> 목요일&nbsp;&nbsp;
		// 								<input type="checkbox" name="yoil_5[${tableCount}]" value="금요일" class="yoil"> 금요일&nbsp;&nbsp;
		// 								<input type="checkbox" name="yoil_6[${tableCount}]" value="토요일" class="yoil"> 토요일&nbsp;&nbsp;
		// 							</div>
		// 						</div>
		// 					</td>
		// 					<td>
		// 						<div style="display: flex; gap: 5px;">
		// 							<input type="text" name="spas_info_price[${tableCount}]" class="price" numberOnly=true>
		// 							<button class="btn_move up" onclick="moveUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
		// 							<button class="btn_move down" onclick="moveDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
		// 						</div>
		// 					</td>

		// 				</tr>
		// 				<tr>
		// 					<td colspan="3">
		// 						<table style="width:100%">
		// 							<colgroup>
		// 								<col width="*">
		// 								<col width="12%">
		// 								<col width="12%">
		// 								<col width="10%">
		// 							</colgroup>
									
		// 							<tbody class="air_main">
		// 								<tr class="air_list_1" style="height:40px">
		// 									<td style="width:100px;text-align:center">
		// 										<input type="hidden" name="spa_onum[${tableCount}][]" class="spa_onum" value="">
		// 										<input type="hidden" name="spas_idx[${tableCount}][]" class="spas_idx" value="">
		// 										<input type="hidden" name="spas_explain[${tableCount}][]" class="spas_explain" value="">
		// 										<input type="hidden" name="is_explain[${tableCount}][]" class="hidden_is_explain" value="">

		// 										<div class="flex" style="gap: 5px; align-items: center;">
		// 											<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
		// 											<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
		// 											<input type="text" name="spas_subject[${tableCount}][]" value="" class="spas_subject input_txt" placeholder="상품타입 국문글씨로 입력해주세요" style="width: 50%" />
		// 											<input type="text" name="spas_subject_eng[${tableCount}][]" value="" class="spas_subject_eng input_txt" placeholder="상품타입 영문글씨로 입력해주세요" style="width: 50%;" />	
		// 											<input type="checkbox" onchange="InitPopup(event, this);" class="is_explain" value="Y">
		// 											<label class="explain_label" onclick="InitPopup(event, this);" style="flex: 0 0 auto;">설명</label>			
		// 										</div>
		// 									</td>
		// 									<td style="text-align:center">
		// 										<input type="text" name="spas_price[${tableCount}][]" value="" class="price spas_price input_txt" placeholder="성인가격(단위: 바트)" style="width:100%" numberOnly=true/>
		// 									</td>
		// 									<td style="text-align:center">
		// 										<input type="text" name="spas_price_kids[${tableCount}][]" value="" class="price spas_price_kids input_txt" placeholder="소아가격(단위: 바트)" style="width:90%" numberOnly=true/>
		// 									</td>
		// 									<td>
		// 										<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
		// 											<select name="status[${tableCount}][]">
		// 												<option value="Y" selected>판매중</option>
		// 												<option value="N">중지</option>
		// 											</select>
		// 											<a href="javascript:delete_spa(${tableCount}, 0);" class="btn btn-danger">삭제</a>
		// 										</div>
		// 									</td>
		// 								</tr>
		// 							</tbody>
		// 						</table>
		// 					</td>
		// 				</tr>
		// 				<tr>
		// 					<td colspan="3">
		// 						<table style="width: 100%">
		// 							<colgroup>
		// 								<col width="7%">
		// 								<col width="*">
		// 							</colgroup>
									
		// 							<tbody>
		// 								<tr>
		// 									<th>
		// 										옵션추가
		// 										<button type="button" class="btn btn-primary" onclick="add_main_option(this, ${tableCount});">추가</button>	
		// 									</th>
		// 									<td>
		// 										<div class="option_area">
		// 											<input type="hidden" name="moption_onum[${tableCount}][0]" class="moption_onum" value="">	
		// 											<input type="hidden" name="moption_idx[${tableCount}][0]" class="moption_idx" value="">
		// 											<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
		// 												<colgroup>
		// 													<col width="10%">
		// 													<col width="90%">
		// 												</colgroup>
		// 												<tbody>
		// 												<tr height="45">
		// 													<th colspan="5">
		// 														<div class="flex__c" style="gap: 5px;">
		// 															옵션 <input type='text' name='moption_name[${tableCount}][0]'
		// 																		placeholder="옵션명"			
		// 																		value="" style="width:550px"/>
		// 															<button type="button" class="btn btn-danger"
		// 																	onclick="del_main_option('', this);">삭제
		// 															</button>
		// 															<button class="btn_move up" onclick="moveMOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
		// 															<button class="btn_move down" onclick="moveMOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
		// 														</div>
		// 													</th>
		// 												</tr>
		// 												<tr height="45">
		// 													<th>
		// 														추가 옵션등록
		// 														<div class="flex" style="margin-top:10px; gap: 5px;">
		// 															<button type="button"
		// 																	onclick="add_sub_option(this, ${tableCount}, 0);"
		// 																	class="btn btn-primary">추가
		// 															</button>
		// 														</div>
		// 													</th>
		// 													<td>
		// 														<table>
		// 															<colgroup>
		// 																<col width="*"></col>
		// 																<col width="15%"></col>
		// 																<col width="10%"></col>
		// 																<col width="10%"></col>
		// 																<col width="8%"></col>
		// 															</colgroup>
		// 															<tbody>
		// 																<tr class="option_detail">
		// 																	<td>
		// 																		<div style="display: flex; gap: 5px;">
		// 																			<input type="hidden" name="op_spa_onum[[${tableCount}][0][]" class="op_spa_onum" value="">
		// 																			<input type="hidden" name="op_spa_idx[${tableCount}][0][]" class="op_spa_idx" value="">
		// 																			<input type='text' name='o_name[${tableCount}][0][]' placeholder="옵션타입 국문글씨로 입력해주세요" value="" />
		// 																			<input type='text' name='o_name_eng[${tableCount}][0][]' placeholder="옵션타입 영문글씨로 입력해주세요" value="" />	
		// 																		</div>
		// 																	</td>
		// 																	<td>
		// 																		<input type='text'
		// 																				name='o_price[${tableCount}][0][]' value="" placeholder="가격(단위: 바트)" numberOnly=true/>
		// 																	</td>
		// 																	<td>
		// 																		<select name="use_yn[${tableCount}][0][]" style="width:100%">
		// 																			<option value="Y">
		// 																				판매중
		// 																			</option>
		// 																			<option value="N">
		// 																				중지
		// 																			</option>
		// 																		</select>
		// 																	</td>
		// 																	<td>
		// 																		<div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
		// 																			<button class="btn_move up" onclick="moveOptionUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
		// 																			<button class="btn_move down" onclick="moveOptionDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
		// 																		</div>
		// 																	</td>
		// 																	<td>
		// 																		<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
		// 																			<button type="button" class="btn btn-danger"
		// 																					onclick="delOption('', this)">삭제
		// 																			</button>
		// 																		</div>
		// 																	</td>
		// 																</tr>
		// 															</tbody>
		// 														</table>
		// 													</td>
		// 												</tr>
		// 												</tbody>
		// 											</table>
		// 										</div>
		// 									</td>
		// 								</tr>
		// 							</tbody>
		// 						</table>
		// 					</td>
		// 				</tr>
		// 			</tbody>
		// 		</table>
		// 	</div>
		// `;
		// $(".table_list:last").after(newTable);
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

	function add_spas(tableListIndex) {
		var targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
		var rowIndex = targetTable.find(".air_list_1").length;

		var newRow = `
			<tr class="air_list_1" style="height:40px">
				<td style="text-align:center">
					<input type="hidden" name="spas_idx[${tableListIndex}][]" class="spas_idx" value="">
					<input type="hidden" name="spa_onum[${tableListIndex}][]" class="spa_onum" value="">
					<input type="hidden" name="spas_explain[${tableListIndex}][]" class="spas_explain" value="">
					<input type="hidden" name="is_explain[${tableListIndex}][]" class="hidden_is_explain" value="">

					<div style="display: flex; gap: 5px; align-items: center;">
						<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
						<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
						<input type="text" name="spas_subject[${tableListIndex}][]" value="" class="spas_subject input_txt" placeholder="상품타입 국문글씨 입력해주세요" style="width:50%" />
						<input type="text" name="spas_subject_eng[${tableListIndex}][]" value="" class="spas_subject_eng input_txt" placeholder="상품타입 영문글씨 입력해주세요" style="width: 50%;" />
						<input type="checkbox" class="is_explain" onchange="InitPopup(event, this);" value="Y">
						<label class="explain_label" onclick="InitPopup(event, this);" style="flex: 0 0 auto;">설명</label>
					</div>
				</td>
				<td style="text-align:center">
					<input type="text" name="spas_price[${tableListIndex}][]" placeholder="성인가격(단위: 바트)" value="" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
				</td>
				<td style="text-align:center">
					<input type="text" name="spas_price_kids[${tableListIndex}][]" placeholder="소아가격(단위: 바트)" value="" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
				</td>
				<td>
					<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
						<select name="status[${tableListIndex}][]">
							<option value="Y" selected>판매중</option>
							<option value="N">중지</option>
						</select>
						<a href="javascript:remove_spas(${tableListIndex}, ${rowIndex});" class="btn btn-danger">삭제</a>
					</div>
				</td>
			</tr>
		`;

		targetTable.append(newRow);
		$(".price").number(true);
	}

	function remove_spas(tableListIndex, rowIndex) {
		let targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
    
		if (targetTable.find(".air_list_1").length > 1) {
			targetTable.find(".air_list_1").eq(rowIndex).remove();
		} else {
			alert("최소 하나의 투어는 유지해야 합니다."); 
		}
	}

	function add_spa(infoIdx, idx) {
		var targetTable = $(".table_list[data-index='" + infoIdx + "']").find(".air_main");
		var rowIndex = targetTable.find(".air_list_1").length;

		// var newRow = `
		// 	<tr class="air_list_1" style="height:40px">
		// 		<td>
		// 			<input type="hidden" name="spa_onum[${infoIdx}][]" class="spa_onum" value="">
		// 			<input type="hidden" name="spas_idx[${infoIdx}][]" class="spas_idx" value="new">
		// 			<input type="hidden" name="spas_explain[${infoIdx}][]" class="spas_explain" value="">
		// 			<input type="hidden" name="is_explain[${infoIdx}][]" class="hidden_is_explain" value="">

		// 			<div style="display: flex; gap: 5px; align-items: center;">
		// 				<button class="btn_move up" onclick="moveTourUp(this)" type="button" style="width: 30px; height: 30px;">▲</button>
		// 				<button class="btn_move down" onclick="moveTourDown(this)" type="button" style="width: 30px; height: 30px;">▼</button>
		// 				<input type="text" name="spas_subject[${infoIdx}][]" value="" class="spas_subject input_txt" placeholder="상품타입 국문글씨 입력해주세요" style="width:50%" />
		// 				<input type="text" name="spas_subject_eng[${infoIdx}][]" value="" class="spas_subject_eng input_txt" placeholder="상품타입 영문글씨 입력해주세요" style="width: 50%;" />
		// 				<input type="checkbox" class="is_explain" onchange="InitPopup(event, this);" value="Y">
		// 				<label class="explain_label" onclick="InitPopup(event, this);" style="flex: 0 0 auto;">설명</label>
		// 			</div>
		// 		</td>
		// 		<td>
		// 			<input type="text" name="spas_price[${infoIdx}][]" placeholder="성인가격(단위: 바트)" value="" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
		// 		</td>
		// 		<td>
		// 			<input type="text" name="spas_price_kids[${infoIdx}][]" placeholder="소아가격(단위: 바트)" value="" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
		// 		</td>
		// 		<td>
		// 			<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
		// 				<select name="status[${infoIdx}][]">
		// 					<option value="Y" selected>판매중</option>
		// 					<option value="N">중지</option>
		// 				</select>
		// 				<a href="javascript:remove_spas(${infoIdx}, ${rowIndex});" class="btn btn-danger">삭제</a>
		// 			</div>
		// 		</td>
		// 	</tr>
		// `;

		// targetTable.append(newRow);
		// $(".price").number(true);

		if (!confirm("추가 하시겠습니까?")) {
			return false;
		}
		$.ajax({
			url: "<?= route_to('admin.api.spa_.add_spa_product') ?>",
			type: "POST",
			data: {
				"info_idx": idx,
				"product_idx": <?= $product_idx ?>,
				"spa_onum": rowIndex,
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				if(data.result){
					location.reload();
				}else{
					alert(data.message);
				}
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
			}
		});
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
												<input type="hidden" name="op_spa_onum[${idx}][${arr_count[idx]}][]" class="op_spa_onum" value="">
												<input type="hidden" name="op_spa_idx[${idx}][${arr_count[idx]}][]" class="op_spa_idx" value="">
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
						<input type="hidden" name="op_spa_onum[${info_idx}][${op_idx}][]" class="op_spa_onum" value="">
						<input type="hidden" name="op_spa_idx[${info_idx}][${op_idx}][]" class="op_spa_idx" value="">
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

	function copy_last_spa(product_idx) {
		if (!confirm("이 제품을 복사하시겠습니까?")) {
			return false;
		}
		$.ajax({
			url: "<?= route_to('admin.api.spa_.copy_last_spa') ?>",
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

	function delete_spa(spas_idx, info_idx, product_idx) {
		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		$.ajax({
			url: "<?= route_to('admin.api.spa_.del_spa_option') ?>",
			type: "POST",
			data: {
				"spas_idx": spas_idx,
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
				url: "<?= route_to('admin.api.spa_.del_main_option') ?>",
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
				url: "<?= route_to('admin.api.spa_.del_sub_option') ?>",
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

	function del_spas(info_idx, spas_idx_json) {	
		var spas_idx_array = JSON.parse(spas_idx_json);

		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		$.ajax({
			url: "<?= route_to('admin.api.spa_.del_spas') ?>",
			type: "POST",
			data: {
				"info_idx": info_idx,
				"spas_idx": spas_idx_array
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
		location.href = "/AdmMaster/_tourRegist/list_spas_price?info_idx="+info_idx+"&product_idx="+product_idx;
	}
</script>

<script>
	function send_it(){
		var frm = document.frm;

		for (i = 0; i < $(".spas_idx").length; i++)
		{
			console.log($(".spas_subject:eq("+i+")").val());
			
			if ($(".spas_subject:eq("+i+")").val() == "")
			{
				$(".spas_subject:eq("+i+")").focus();
				alert("상품명을 입력해주셔야 합니다.");
				return;
			}

			if ($(".spas_subject_eng:eq("+i+")").val() == "")
			{
				$(".spas_subject_eng:eq("+i+")").focus();
				alert("영어 제품명을 입력해야 합니다.");
				return;
			}
		}

		for (i = 0; i < $(".spas_idx").length; i++)
		{
			if ($(".spas_price:eq("+i+")").val() == "")
			{
				$(".spas_price:eq("+i+")").focus();
				alert("가격을 입력해주셔야 합니다.");
				return;
			}

			if ($(".spas_price_kids:eq("+i+")").val() == "")
			{
				$(".spas_price_kids:eq("+i+")").focus();
				alert("가격을 입력해주셔야 합니다.");
				return;
			}
			
			// if ($(".spas_price_baby:eq("+i+")").val() == "")
			// {
			// 	$(".spas_price_baby:eq("+i+")").focus();
			// 	alert("가격을 입력해주셔야 합니다.");
			// 	return;
			// }

		}

		$(".table_list").each(function() {
			let o_onum = $(this).index();
			$(this).find(".o_onum").val(o_onum);
			$(this).find(".air_list_1").each(function() {
				let spa_onum = $(this).index();
				$(this).find(".spa_onum").val(spa_onum);
			});

			$(this).find(".option_area").each(function() {
				let moption_onum = $(this).index();
				$(this).find(".moption_onum").val(moption_onum);
				$(this).find(".option_detail").each(function() {
					let op_spa_onum = $(this).index();
					$(this).find(".op_spa_onum").val(op_spa_onum);
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