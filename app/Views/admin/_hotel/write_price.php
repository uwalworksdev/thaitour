<?php

use App\Controllers\Admin\AdminHotelController;
include_once APPPATH . 'Common/hotelPrice.php';

?>

<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
    <style>
        .btn_01 {
            height: 30px !important;
            padding: 0px 10px 0px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img_add #input_file_ko {
            display: none;
        }

        .head_table {
            display: flex;
            justify-content: space-between;
        }
        .btns_setting {
            display: inline-block;
            float: right;
            margin-top: 6px;
        } 

        button {
            height: 31px;
        }

		.extent_wrap .unit {
			position: relative;
		}

		.extent_wrap .unit::before {
			content: '2';
			position: absolute;
			top: -3px;
			right: -6px;
			font-size: 10px;
			line-height: 1;
		} 

    </style>
	
    <style>
        .tab_title {
            font-size: 16px;
            color: #333333;
            font-weight: bold;
            height: 28px;
            line-height: 28px;
            background: url('/img/ico/deco_tab_title.png') left center no-repeat;
            padding-left: 43px;
            margin-left: 7px;
            margin-bottom: 26px;
        }

        #input_file_ko {
            display: inline-block;
            width: 500px;
        }

        .table_border_ {
            border: 2px solid #dbdbdb;
        }

        .table_border_ th,
        .table_border_ td {
            border: 1px solid #dbdbdb;
            padding: 10px 20px;
        }

        .table_border_ th {
            background-color: rgba(220, 220, 220, 0.5);
        }

        .table_border_ td.list_g_idx_ {
            vertical-align: middle;
            text-align: center;
        }

        .btn_select_room_list {
            background-color: #17469E;
            color: #FFFFFF;
            width: 80px !important;
            height: 35px !important;
            margin: 10px 0 !important;
        }

        .room_list_render_ .item_ {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 20px;
            margin-bottom: 10px;
        }

        .room_list_render_ input:not('type=checkbox') {
            width: 25%;
            cursor: not-allowed;
        }

        .room_list_render_ button.delete_ {
            margin: 0 !important;
            background-color: #EA353D;
            color: #FFFFFF;
            height: 30px;
        }

        .room_list_render_ button.update_ {
            margin: 0 !important;
            background-color: rgba(23, 70, 158, 0.75);
            color: #FFFFFF;
            height: 30px;
        }

        .btn_add {
            background-color: #17469E;
            color: #FFFFFF;
            margin: 0 0 !important;
            width: 80px !important;
            height: 35px !important;
        }

        .justify-between {
            align-items: center;
            justify-content: space-between;
        }

        .img_add #input_file_ko {
            display: none;
        }

		.img_add.img_add_group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .img_add .file_input + .file_input {
            margin-left: 0;
        }
    </style>
	
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="/js/admin/tours/write.js"></script>

<?php
if (isset($product_idx) && isset($row)) {
    foreach ($row as $keys => $vals) {
        ${$keys} = $vals;
    }
}

$titleStr = "호텔정보 수정";
$links = "list";
?>
<?php echo view("/admin/_hotel/inc/map/js_map.php", ['fresult10' => $fresult10, 'fresult11' => $fresult11]); ?>

<div id="container">
	<div id="print_this"><!-- 인쇄영역 시작 //-->
		<header id="headerContainer">
			<div class="inner">
				<h2>호텔가격 상세정보</h2>
				<div class="menus">
					<ul>
     					<li><a href="/product-hotel/hotel-detail/<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">상품미리보기</span></a></li>
						<li><a href="/AdmMaster/_hotel/list" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
						<!--li><a href="javascript:send_it_price()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a></li-->
					</ul>
				</div>
			</div>
			<!-- // inner -->

		</header>
		<!-- // headerContainer -->

		<div id="contents">
			<div class="listWrap_noline">
				<!--  target="hiddenFrame22"  -->
				<form name="frm" id="frm" action="<?= route_to('admin.api.hotel_.write_price_ok') ?>" method="post" enctype="multipart/form-data" target="hiddenFrame22">
					<!-- 상품 고유 번호 -->
					<input type="hidden" name="code_populars" id="code_populars"
						   value='<?= $code_populars ?? "" ?>'/>

					<!-- db에 있는 product_code -->
					<input type="hidden" name="old_goods_code" id="old_goods_code"  value='<?= $product_code ?? "" ?>'>
					<input type="hidden" name="product_code_list" id="product_code_list" value='<?= $product_code_list ?? "" ?>'>

					<input type="hidden" name="product_theme" id="product_theme"  value='<?= $product_theme ?? "" ?>'>
					<input type="hidden" name="product_bedrooms" id="product_bedrooms" value='<?= $product_bedrooms ?? "" ?>'>
					<input type="hidden" name="product_type" id="product_type"  value='<?= $product_type ?? "" ?>'>
					<input type="hidden" name="product_promotions" id="product_promotions" value='<?= $product_promotions ?? "" ?>'>

					<input type="hidden" name="product_more" id="product_more"  value='<?= $product_more ?? "" ?>'>

					<input type="hidden" name="stay_idx" id="stay_idx" value='<?= $stay_idx ?>'>
					<input type="hidden" name="product_idx" id="product_idx" value='<?= $product_idx ?>'>

					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="table-layout:fixed;">
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
								<td colspan="3">
									<input type="text" name="product_name" readonly="readonly"
										   value="<?= $product_name ?? "" ?>"
										   class="text" style="width:100%" maxlength="100"/>
								</td>
							</tr>

							<tr>
								<th>상품코드</th>
								<td colspan="3">
									<input type="text" name="product_code" id="product_code"
										   value="<?= $product_code_no ?? "" ?>"
										   readonly="readonly" class="text" style="width:200px">
								</td>
							</tr>

							</tbody>
						</table>

						<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:50px;">
							<caption>
							</caption>
							<colgroup>
								<col width="10%">
								<col width="40%">
								<col width="10%">
								<col width="40%">
							</colgroup>
							<tbody>
							<tr>
								<th>룸정보</th>

								<td colspan="3">
									<button type="button" class="btn_select_room_list" onclick="showOrHide();" style="width : 90px ;background-color : #4f728a; color : #fff">룸타입 추가</button>
									<button type="button" class="btn_select_room_list" onclick="allUpdate();"  style="width : 90px ;background-color : #4f728a; color : #fff">전체저장</button>
								</td>
							</tr>

							<tr>
								<th>룸타입 등록</th>
								<td colspan="3">
								<div class="room_list">
									<?php foreach ($rresult as $row) : ?>
										<div class="item_" data-id="<?=$row['g_idx']?>" style="margin-bottom: 10px;">
											<input readonly="" type="text" value="<?=$row['roomName']?>" style="width:50%">
											<button class="btn_del" onclick="removeRoomSelect(this, <?=$row['g_idx']?>)" type="button" style="width: 100px; background-color: #d03a3e; color : #fff;">룸타입 삭제</button>
											<button class="btn_set" onclick="updateRoomSelect(this, <?=$row['g_idx']?>)" type="button" style="width: 50px ; background-color: #4f728a; color : #fff;">수정</button>
											<button class="btn_move up" onclick="moveUpRoom(this)" type="button" style="width: 30px; height: 30px;">▲</button>
											<button class="btn_move down" onclick="moveDownRoom(this)" type="button" style="width: 30px; height: 30px;">▼</button>
										</div>
									<?php endforeach; ?>
								</div>
								
								</td>
							</tr>
							</tbody>
						</table>


							<?php $mainIdx = $roomIdx = 0; ?>
							<?php $comIdx  = ""; ?>
							<?php foreach ($roomTypes as $type): ?>
							<?php $mainIdx = $mainIdx + 1;?>	
							
							<!-- 룸 가격 설정 -->
							<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:50px;">
								<caption>
								</caption>
								<colgroup>
									<col width="10%"/>
									<col width="90%"/>
								</colgroup>
								<tbody>
								
								<tr>
									<th><?=$type['roomName']?></th>
									<td>

										<?php
											$target_g_idx  = $type['g_idx']; // 원하는 g_idx 값 (예: 1번 그룹만 표시)
											$filteredRooms = array_filter($roomsByType, function($room) use ($target_g_idx) {
												return $room['g_idx'] == $target_g_idx;
											});
										?>						
										
										<div class="head_table">
											<div class="btn_more">
												<button type="button" class="addTableBtn" value="<?=$mainIdx?>" data-prod="<?=$product_idx?>" data-roomtype="<?=$type['g_idx']?>" style="width:70px;background-color:#4f728a;color:#fff">룸 추가</button>
												<!--span style="color : red" class="note">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다</span-->
											</div>
										</div>

										<?php foreach ($filteredRooms as $row): ?>
										<?php $roomIdx++; ?>

										


										<div id="table_child_<?=$roomIdx?>">
											
											<table data-roomId="<?=$roomIdx?>">
												<tbody>
													<tr>
														<input type="hidden" name="product_idx[<?=$roomIdx?>]"  value="<?=$product_idx?>" /> 
														<input type="hidden" name="g_idx[<?=$roomIdx?>]"        value="<?=$type['g_idx']?>" /> 
														<input type="hidden" name="rooms_idx[<?=$roomIdx?>]" class="rooms_idx" value="<?=$row['rooms_idx']?>" /> 
														<input type="hidden" class="r_contents1" name="r_contents1[<?=$roomIdx?>]"    value="<?=$row['r_contents1']?>" /> 
														<input type="hidden" class="r_contents2" name="r_contents2[<?=$roomIdx?>]"    value="<?=$row['r_contents2']?>" /> 
														<input type="hidden" class="r_contents3" name="r_contents3[<?=$roomIdx?>]"    value="<?=$row['r_contents3']?>" /> 

														<td style="background-color: #eee;">
															<span>프로모션 명칭</span>
															<input style="width: 30%;" type="text" name="room_name[<?=$roomIdx?>]" value="<?=$row['room_name']?>" id="room_name_<?=$row['rooms_idx']?>" >
															<input style="width: 10%;" type="text" name="o_sdate[<?=$roomIdx?>]" id="o_sdate_<?=$row['rooms_idx']?>" value="<?=$row['o_sdate']?>" class="s_date datepicker" >
															<span>~</span> 
															<input style="width: 10%;" type="text" name="o_edate[<?=$roomIdx?>]" id="o_edate_<?=$row['rooms_idx']?>" value="<?=$row['o_edate']?>" class="s_date datepicker">
															
															<?php if($row['o_sdate'] && $row['o_edate']) { ?>
															<button type="button" style="width: 100px; background-color : #4f728a; color : #fff;" class="btn_edit" onclick="updRoom('<?=$type['g_idx']?>','<?=$row['rooms_idx']?>',this)">일자별 수정.</button>
															<?php } ?>
															
															<?php if($row['o_sdate'] == "" || $row['o_edate'] == "" ) { ?>
															   <?php if($row['copy_row'] == "Y") { ?>	
															   <button type="button" style="width: 100px; background-color : #4f728a; color : #fff;" class="cpyDatePrice" value="<?=$row['rooms_idx']?>" >일자별 생성</button>
															   <?php } else { ?>
															   <button type="button" style="width: 100px; background-color : #4f728a; color : #fff;" class="creDatePrice" value="<?=$row['rooms_idx']?>" >일자별 생성</button>
															   <?php } ?>
															<?php } ?>
															
															<!--input type="checkbox">사용-->
															<!--input type="checkbox" id="use_yn_<?=$row['rooms_idx']?>" value="N">마감-->
															<div class="btns_setting">
																<!--button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">저장</button-->
																<button type="button" style="width: 80px ; background-color: #4f728a; color : #fff;" class="btn_copy room_copy"  data-idx="<?=$type['g_idx']?>" value="<?=$row['rooms_idx']?>">복사생성</button>
																<button type="button" style="width: 70px ; background-color: #d03a3e; color : #fff;" class="btn_del room_delete" data-idx="<?=$type['g_idx']?>" value="<?=$row['rooms_idx']?>">룸 삭제</button>
															</div>
														</td>
													</tr>
													
													<?php $goods_price = $row['goods_price2'] + $row['goods_price3'];?>
													<tr class="product-row">
														<td>
														<!--
															<span>기본가</span>
															<input style="width: 100px;" type="text" id="goods_price1_<?=$row['rooms_idx']?>" name="goods_price1[<?=$roomIdx?>]" value="<?=$row['goods_price1']?>" class="numberOnly">
															<span>컨택가</span>
															<input style="width: 100px;" type="text" id="goods_price2_<?=$row['rooms_idx']?>" name="goods_price2[<?=$roomIdx?>]" value="<?=$row['goods_price2']?>" class="numberOnly cost">
															<span>+수익</span>
															<input style="width: 100px;" type="text" id="goods_price3_<?=$row['rooms_idx']?>" name="goods_price3[<?=$roomIdx?>]" value="<?=$row['goods_price3']?>" class="numberOnly profit">
															<span>=판매가</span>
															<input style="width: 100px;text-align:right" type="text" name="goods_price[<?=$roomIdx?>]"  class="price" value="<?=number_format($goods_price)?>" readonly>
															<span>Extra 베드</span>
															<input style="width: 100px;" type="text" id="goods_price4_<?=$row['rooms_idx']?>" name="goods_price4[<?=$roomIdx?>]" value="<?=$row['goods_price4']?>" class="numberOnly">
															<button type="button" style="width: 100px; background-color : #4f728a; color : #fff;" class="btn_edit" onclick="allUpdRoom('<?=$type['g_idx']?>','<?=$row['rooms_idx']?>',this)">가격 일괄수정</button>
															<!--select>
																<option value="">현재 가격</option>
																<option value="">현재 가격</option>
															</select-->
															<input type="radio" name="breakfast[<?=$roomIdx?>]" value=""  <?php if($row['breakfast'] != "N") echo "checked";?> >
															<span>조식 포함</span>
															<input type="radio" name="breakfast[<?=$roomIdx?>]" value="N" <?php if($row['breakfast'] == "N") echo "checked";?> >
															<span>조식 미포함</span>
															<button type="button" onclick="InitTypePopup(this, 1)" style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">설명</button>
															<span style="margin-left:50px;">숙박인원 성인</span>
															<input style="width: 50px;" type="text" name="adult[<?=$roomIdx?>]" value="<?=$row['adult']?>" class="numberOnly" id="adult_<?=$row['rooms_idx']?>" >명
															<span style="margin-left:30px;">아동</span>
															<input style="width: 50px;" type="text" name="kids[<?=$roomIdx?>]" value="<?=$row['kids']?>"   class="numberOnly" id="kids_<?=$row['rooms_idx']?>">명
															&ensp;<button type="button" onclick="InitTypePopup(this, 2)" style="width: 90px; background-color: #4f728a; color : #fff;" class="btn_set">프로모션 내용</button>
															
															<label style="margin-left: 20px;" for="check_bx_001">비밀특가</label>
															<input id="check_bx_001" name="secret_price[<?=$roomIdx?>]" value="Y" <?php if($row['secret_price'] == "Y") echo "checked"; ?> type="checkbox">
															
															<label style="margin-left: 20px;" for="check_bx_001">특별할인</label>
															<input id="check_bx_002" name="special_discount[<?=$roomIdx?>]" value="Y" <?php if($row['special_discount'] == "Y") echo "checked"; ?> type="checkbox">
															<input style="width: 60px;" type="text" name="discount_rate[<?=$roomIdx?>]" value="<?=$row['discount_rate']?>" class="numberOnly">%
															
															<span style="margin-left: 20px;">가격표시</span>
															<input type="radio" name="price_view[<?=$roomIdx?>]" id="is_won_bath" value="" <?php if (empty($row['price_view'])) { echo "checked"; } ?> />
															<label for="is_won_bath">원화+바트</label>
															<input type="radio" name="price_view[<?=$roomIdx?>]" id="is_won"      value="W" <?php if ($row['price_view'] == "W") { echo "checked"; } ?> />
															<label for="is_won">원화</label>
															<input type="radio" name="price_view[<?=$roomIdx?>]" id="is_bath"      value="B" <?php if ($row['price_view'] == "B") { echo "checked"; } ?> />
															<label for="is_bath">바트</label>

															<label style="margin-left: 20px;" for="check_bx_promotion">프로모션</label>
															<input id="check_bx_promotion" name="is_view_promotion[<?=$roomIdx?>]" value="Y" <?php if($row['is_view_promotion'] == "Y") echo "checked"; ?> type="checkbox">
														</td>
													</tr>
													
													<!--tr>
														<td>
															<input type="radio" name="breakfast[<?=$roomIdx?>]" value=""  <?php if($row['breakfast'] != "N") echo "checked";?> >
															<span>조식 포함</span>
															<input type="radio" name="breakfast[<?=$roomIdx?>]" value="N" <?php if($row['breakfast'] == "N") echo "checked";?> >
															<span>조식 미포함</span>
															<button type="button" onclick="InitTypePopup(this, 1)" style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">참고</button>
															<span style="margin-left:50px;">성인</span>
															<input style="width: 50px;" type="text" name="adult[<?=$roomIdx?>]" value="<?=$row['adult']?>" class="numberOnly">명
															<span style="margin-left:30px;">아동</span>
															<input style="width: 50px;" type="text" name="kids[<?=$roomIdx?>]" value="<?=$row['kids']?>"   class="numberOnly">명
															&ensp;<button type="button" onclick="InitTypePopup(this, 2)" style="width: 80px; background-color: #4f728a; color : #fff;" class="btn_set">혜택보기</button>
														</td>
													</tr-->
													<tr class="bed_child_<?=$roomIdx?>" data-bed-idx="<?=$bed['bed_idx']?>" data-bed-seq="<?=$bed['bed_seq']?>" >
														<td>
															<p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (침대명/금액))
															   <button type="button" onclick="InitTypePopup(this, 3)" style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">설명</button>
															   <button type="button" class="bedAddBtn" data-product-idx="<?=$product_idx?>" data-g-idx="<?=$type['g_idx']?>" data-rooms-idx="<?=$row['rooms_idx']?>" style="width: 100px; background-color: #4f728a; color : #fff;" >침대타입추가</button>
															</p>
                                                        </td>
													</tr>													
													<?php 
														 $bedType_arr  = explode(",", $row['bed_type']);
														 $bedPrice_arr = explode(",", $row['bed_price']);
														 $i = 0;
														 
														 $rooms_idx = $row['rooms_idx'];
													?>	
													<?php foreach ($allBeds[$rooms_idx] as $bed) { ?>
													<?php $i++;?>
													<tr class="bed_child_<?=$roomIdx?>" data-bed-idx="<?=$bed['bed_idx']?>" data-bed-seq="<?=$bed['bed_seq']?>" >
														<td>
															<?php if($i==9999) { ?>
															<p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (제목/금액))
															   <button type="button" onclick="InitTypePopup(this, 3)" style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">설명</button>
															   <button type="button" class="bedAddBtn" data-product-idx="<?=$product_idx?>" data-g-idx="<?=$type['g_idx']?>" data-rooms-idx="<?=$rooms_idx?>" style="width: 50px; background-color: #4f728a; color : #fff;" >추가</button>
															</p>
															<?php } ?>
															<!--input style="width: 18%;" type="text">
															<input style="width: 8%;" type="text">
															<input style="width: 18%; margin-left: 20px;" type="text">
															<input style="width: 8%;" type="text"-->
															
															<input type="hidden" name="bed_num[<?=$roomIdx?>][]"  value="<?=$i?>" >
															<input type="hidden" name="bed_idx[<?=$roomIdx?>][]"  value="<?=$bed['bed_idx']?>" >
															<input style="width:10%;" type="text" name="bed_type[<?=$roomIdx?>][]"      value="<?=$bed['bed_type']?>" placeholder="한글">
															<input style="width:18%;" type="text" name="bed_type_eng[<?=$roomIdx?>][]"  value="<?=$bed['bed_type_eng']?>" placeholder="영문">

															기본가   <input style="width:10%;text-align:right;" type="text" name="price1[<?=$roomIdx?>][]" value="<?=$bed['goods_price1']?>" class="numberOnly">
															컨택가   <input style="width:10%;text-align:right;" type="text" name="price2[<?=$roomIdx?>][]" value="<?=$bed['goods_price2']?>" class="numberOnly">+
															수익     <input style="width:10%;text-align:right;" type="text" name="price3[<?=$roomIdx?>][]" value="<?=$bed['goods_price3']?>" class="numberOnly">=
															판매가   <input style="width:10%;text-align:right;" type="text" name="price4[<?=$roomIdx?>][]" value="<?=$bed['goods_price4']?>" class="numberOnly" readonly>
															Extra베드<input style="width:8%;text-align:right;" type="text" name="price5[<?=$roomIdx?>][]" value="<?=$bed['goods_price5']?>" class="numberOnly">
																
															<?php if($i==0) { ?>
															<button type="button" style="width: 31px; height : 31px" value="<?=$roomIdx?>" class="addBedBtn" >+</button>
															<?php } else { ?>
															<button type="button" style="width: 31px; height: 31px;" class="deleteBedBtn" data-idx="<?=$row['rooms_idx']?>" value="<?=$bed['bed_idx']?>">-</button>																
															<?php } ?>
															<input style="width: 50px;" type="hidden" name="bed_seq[<?=$roomIdx?>][]" value="<?=$bed['bed_seq']?>" class="numberOnly">
															<button class="btn_move btn-up"   type="button" style="width: 30px; height: 30px;">▲</button>															
															<button class="btn_move btn-down" type="button" style="width: 30px; height: 30px;">▼</button>
                                                        </td>
													</tr>
													<?php } ?>


													<?php 
														 $option_arr  = explode(",", $row['option_val']);
													?>	
													<?php for($i=0;$i<count($option_arr);$i++) { ?>
													<tr class="option_child_<?=$roomIdx?>">
														<td>
															<?php if($i==0) { ?>
															<p style="margin-bottom: 3px;">옵션 내용을 추가 합니다. (html 태그 사용가능)</p> 
															<?php } ?>
															<input style="width: 20%;" type="text" name="option_val[<?=$roomIdx?>][]" value="<?=htmlspecialchars_decode($option_arr[$i], ENT_QUOTES);?>">

															<?php if($i==0) { ?>
															<button type="button" style="width: 31px; height : 31px" value="<?=$roomIdx?>" class="addOptionBtn">+</button>
															<?php } else { ?>
															<button type="button" style="width: 31px; height: 31px;" class="removeBedBtn">-</button>
															<?php }?>
														</td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
											<?php //} ?>
										</div>
										<?php endforeach; ?>
					
									</td>
								</tr>
								</tbody>
							</table>
						<?php endforeach; ?>
						
					</div>
					<input type="hidden" name="roomIdx" id="roomIdx" value="<?=$roomIdx?>" />
				</form>
			  
				<div class="tail_menu">
					<ul>
						<li class="left"></li>
						<li class="right_sub">
					        <a href="/product-hotel/hotel-detail/<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">상품미리보기</span></a>
							<a href="/AdmMaster/_hotel/list" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
							<!--a href="javascript:send_it_price()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a-->
						</li>
					</ul>
				</div>

			</div>
			<!-- // listWrap -->

		</div>
		<!-- // contents -->

	</div><!-- 인쇄 영역 끝 //-->
</div>

<div class="popup_" id="popupDesc_" data-roomId="" data-type="">
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

<div class="popup_" id="popupItem_">
	<div class="popup_area_ popup_area_xl_">
		<div class="popup_top_">
			<p>
				룸목록 관리
			</p>
			<p>
				<button type="button" class="btn_close_" onclick="showOrHide();">X</button>
			</p>
		</div>
		<div class="popup_content_">
			<form name="formRoom" id="formRoom" action="#" method="post" enctype="multipart/form-data" target="hiddenFrame">
				<input type="hidden" name="g_idx"         id="g_idx"         value=""/>
				<input type="hidden" name="room_facil"    id="room_facil"    value="">
				<input type="hidden" name="room_category" id="room_category" value="">
				<input type="hidden" name="product_idx"   id="product_idx"   value='<?= $product_idx ?>'>

				<div class="listBottom" style="margin-bottom: 20px">
					<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
						   style="table-layout:fixed;">
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
							<td colspan="4">
								기본정보
							</td>
						</tr>
						<tr>
							<th>룸 이름(한글)</th>
							<td colspan="3">
								<input type="text" name="roomName" value="<?= $roomName ?? '' ?>" class="text"
									   style="width:300px" maxlength="100" id="roomName"/>&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						
						<tr>
							<th>룸 이름(영문)</th>
							<td colspan="3">
								<input type="text" name="roomName_eng" value="<?= $roomName_eng ?? '' ?>" class="text"
									   style="width:300px" maxlength="100" id="roomName_eng"/>
							</td>
						</tr>
						

						<tr>
							<th>객실뷰</th>
							<td colspan="3">
								<input type="text" name="scenery" value="<?= $scenery ?? '' ?>" class="text"
									   id="scenery" style="width:300px" maxlength="50"/>
							</td>
						</tr>

						<tr>
							<th>
								<label for="all_room_category">모두 선택</label>
								<input type="checkbox" id="all_room_category" class="all_input" onclick="toggleRoomCategory()">
							</th>
							<td colspan="3">
								<?php
								$_arr = explode("|", $category);
								foreach ($fresult11 as $row_r) :
									$find = "";
									for ($i = 0; $i < count($_arr); $i++) {
										if ($_arr[$i]) {
											if ($_arr[$i] == $row_r['code_no']) $find = "Y";
										}
									}
									?>
									<input type="checkbox" class="room_category" id="room_category_<?= $row_r['code_no'] ?>"
										   name="_room_category"
										   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
									<label for="room_category_<?= $row_r['code_no'] ?>"><?= $row_r['code_name'] ?></label>
								<?php endforeach; ?>
							</td>
						</tr>

						<tr>
							<!-- <th>식사</th>
							<td colspan="3">
								<input type="checkbox" id="rbreakfast" name="breakfast"
									   value="Y" <?php if ($breakfast == "Y") echo "checked"; ?> />
								<label for="rbreakfast">조식 </label>

								<input type="checkbox" id="lunch" name="lunch"
									   value="Y" <?php if ($lunch == "Y") echo "checked"; ?> />
								<label for="lunch">중식</label>

								<input type="checkbox" id="dinner" name="dinner"
									   value="Y" <?php if ($dinner == "Y") echo "checked"; ?> />
								<label for="dinner">석식</label>
							</td> -->
							<th>객실 크기</th>
							<td colspan="3">
								<div class="extent_wrap">
									<input type="text" name="extent" value="<?= $extent ?? '' ?>" class="text"
										id="extent" style="width:300px" maxlength="50"/>
									<span class="unit">m</span>
								</div>
							</td>
						</tr>

						<tr>
							<th>객실 층수</th>
							<td colspan="3">
								<input type="text" name="floor" value="<?= $floor ?? '' ?>" class="text"
									id="floor" style="width:300px" maxlength="50"/>
							</td>
						</tr>

						<tr>
							<th>투숙객 규정</th>
							<td colspan="3">
								<textarea name="policy_customer" id="policy_customer" style="width: 100%; height: 150px; resize: none;"><?= $policy_customer ?? "" ?></textarea>
							</td>
						</tr>

						<tr>
							<th>
								<label for="all_room_facil">
									객실시설
								</label>
								<input type="checkbox" id="all_room_facil" class="all_input" value=""/>
							</th>
							<td colspan="3">
								<?php
								$_arr = explode("|", $room_facil);
								foreach ($fresult10 as $row_r) :
									$find = "";
									for ($i = 0; $i < count($_arr); $i++) {
										if ($_arr[$i]) {
											if ($_arr[$i] == $row_r['code_no']) $find = "Y";
										}
									}
									?>
									<input type="checkbox" id="room_facil_<?= $row_r['code_no'] ?>"
										   name="_room_facil" class="_room_facil"
										   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
									<label for="room_facil_<?= $row_r['code_no'] ?>"><?= $row_r['code_name'] ?></label>
								<?php endforeach; ?>
							</td>
						</tr>
						
						<!-- <tr>
							<th>총인원</th>
							<td colspan="3">
								<input type="text" name="max_num_people" value="<?= $max_num_people ?? 1 ?>"
									   id="max_num_people" class="number" min="1" style="width:100px"/>
							</td>
						</tr> -->
						</tbody>
					</table>

					<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
						   style="margin-top:50px;">
						<caption>
						</caption>
						<colgroup>
							<col width="10%"/>
							<col width="90%"/>
						</colgroup>
						<tbody>

						<tr>
							<td colspan="2">
								이미지 등록
							</td>
						</tr>

                        <?php
						/*
						     foreach ($roomTypes as $room_row) {
							 
							     $ufile1 = $room_row['ufile1'];
							     $ufile2 = $room_row['ufile2'];
							     $ufile3 = $room_row['ufile3'];
							     $ufile4 = $room_row['ufile4'];
							     $ufile5 = $room_row['ufile5'];
							     $ufile6 = $room_row['ufile6'];
						     }
						*/	 
						?>
						<tr>
							<th>
								서브이미지(600X400)
								<button type="button" class="btn_01" onclick="add_sub_image();">추가</button>
								<button type="button" class="btn_02" style="margin-top: 10px;" onclick="delete_all_image();">전체 삭제</button>
							</th>
							<td colspan="3">
								<div class="img_add img_add_group" id="img_add">
									<?php
									// for ($i = 1; $i <= 5; $i++) :
									//      $room_img =  ${"ufile" . $i};
										// $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
										//$img = "/uploads/rooms/" . ${"ufile" . $i};
										?>
										<!-- <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>"><?=${"ufile" . $i}?>
											<input type="file" name='room_ufile<?= $i ?>' id="room_ufile<?= $i ?>" onchange="productImagePreview2(this, '<?= $i ?>')">
											<label for="room_ufile<?= $i ?>" <?= !empty(${"room_ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
											<input type="hidden" name="checkImg_<?= $i ?>">
											
											<button type="button" class="remove_btn" onclick="productImagePreviewRemove(this)"></button>
											<a class="img_txt imgpop_p" href="<?= $img ?>" id="text_room_ufile<?= $i ?>">미리보기</a>
												
										</div> -->
									<?php
									// endfor;
									?>
								</div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<!-- // listBottom -->

				<!-- // listWrap -->
			</form>
		</div>
		<div class="popup_bottom_">
			<button type="button" class="" onclick="showOrHide();">취소</button>
			<button type="button" class="" onclick="saveValueRoom(event);">확인</button>
		</div>
	</div>
</div>

			<style>
				#loading {
					display: none; /* 처음에는 숨김 */
					position: fixed;
					top: 50%;
					left: 50%;
					transform: translate(-50%, -50%);
					font-size: 20px;
					color: white;
					padding: 10px;
					border-radius: 5px;
					background-color: rgba(0, 0, 0, 0.7);
					text-align: center;
				}

				.spinner {
					display: inline-block;
					width: 20px;
					height: 20px;
					border: 3px solid rgba(255, 255, 255, 0.3);
					border-radius: 50%;
					border-top-color: #fff;
					animation: spin 1s linear infinite; /* 회전 애니메이션 */
				}

				@keyframes spin {
					0% {
						transform: rotate(0deg);
					}
					100% {
						transform: rotate(360deg);
					}
				}
			</style>

			<div id="loading">
				<div class="spinner"></div> <!-- 로딩 스피너 -->
				<div>Loading...</div>
			</div>
<script>
$(document).ready(function () {
    $("#all_room_category").on("change", function () {
        $(".room_category").prop("checked", $(this).is(":checked"));
    });

    $(".room_category").on("change", function () {
        checkRoomCategory();
    });

    checkRoomCategory();
});

function checkRoomCategory() {
    let total = $(".room_category").length;
    let checked = $(".room_category:checked").length;

    $("#all_room_category").prop("checked", total > 0 && total === checked);
}


</script>
<script>
	function TogglePopup() {
        // resetRoom();
        $("#popupDesc_").toggleClass('show_');
    }

	function resetContent() {
		$("#popupDesc_").find(".text_desc").val("");
	}

	function InitTypePopup(element, type) {
		resetContent();

		let content = "";

		if(type == 1){
			content = $(element).closest("table").find(".r_contents1").val();
		}else if(type == 2){
			content = $(element).closest("table").find(".r_contents2").val();
		}else{
			content = $(element).closest("table").find(".r_contents3").val();
		}

		let roomId = $(element).closest("table").attr("data-roomId");

		$("#popupDesc_").attr("data-roomId", roomId);
		$("#popupDesc_").attr("data-type", type);

		$("#popupDesc_").find(".text_desc").val(content);

		TogglePopup();
	}

	function UpdateDesc() {
		let roomId = $("#popupDesc_").attr("data-roomId");
		let table = $(`table[data-roomId='${roomId}']`);
		let type = $("#popupDesc_").attr("data-type");
		let content = $("#popupDesc_").find(".text_desc").val();
		let rooms_idx = table.find(".rooms_idx").val();
		if(type == 1){
			table.find(".r_contents1").val(content);
		}else if(type == 2){
			table.find(".r_contents2").val(content);
		}else{
			table.find(".r_contents3").val(content);
		}

		$.ajax({
			url: '<?= route_to('admin.api.hotel_.update_content') ?>',
			type: "POST",
			data: {
				"rooms_idx" : rooms_idx,
				"content" 	: content,
				"type" 		: type
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				message = data.message;
				alert(message);
				if(data.result == true){
					$("#popupDesc_").removeClass("show_");			
				}
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});

	}
	
</script>

<script>
$(document).ready(function () {
    // price2 또는 price3 입력 시 자동 계산
    $("input[name^='price2']").add("input[name^='price3']").on("input", function () {
        // 현재 행(row)을 찾기
        let row = $(this).closest("tr");
        
        // price2, price3 값 가져오기
        let price2 = parseFloat(row.find("input[name^='price2']").val().replace(/,/g, "")) || 0;
        let price3 = parseFloat(row.find("input[name^='price3']").val().replace(/,/g, "")) || 0;

        // price2 + price3 계산
        let total = price2 + price3;

        // 계산된 값 price4에 표시
        row.find("input[name^='price4']").val(total.toLocaleString());
    });
});
</script>

<script>
    $(document).ready(function(){
        $('.product-row').on('input', '.cost, .profit, .bed', function() {
            let row = $(this).closest('.product-row'); // 현재 입력된 행(row) 찾기
            let cost = Number(row.find('.cost').val()) || 0;
            let profit = Number(row.find('.profit').val()) || 0;
            let bed = Number(row.find('.bed').val()) || 0;
            row.find('.price').val(cost + profit + bed); // 판매가 자동 계산
        });
    });
</script>

<script>
	$(document).ready(function(){
		$(".cpyDatePrice").click(function(){

			if (confirm("일자별 생성은 상품가격이 초기화 되므로\n복구가 불가능합니다.\n반드시 침대타입 생성 후 처리해 주세요.") == false) {
				return;
			}

		    let rooms_idx = $(this).val();
			let	from_date = $("#o_sdate_"+rooms_idx).val();
			let	to_date   = $("#o_edate_"+rooms_idx).val();		

			if(from_date == "") {
			   alert('가격적용 기간을 입력하세요.');
			   $("#o_sdate_"+rooms_idx).val();
			   return false;
			}   
				   
			if(to_date == "") {
			   alert('가격적용 기간을 입력하세요.');
			   $("#o_edate_"+rooms_idx).val();
			   return false;
			}   
 				   
			var message = "";
			$.ajax({
				url: "/ajax/ajax_bedPrice_insert",
				type: "POST",
				data: {
					"rooms_idx"  : rooms_idx,
					"from_date"  : $("#o_sdate_"+rooms_idx).val(),
					"to_date"    : $("#o_edate_"+rooms_idx).val()
						
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
 			
     	});
	});
</script>

<script>
	$(document).ready(function(){
		$(".creDatePrice").click(function(){

			if (confirm("일자별 생성은 상품가격이 초기화 되므로\n복구가 불가능합니다.\n반드시 침대타입 생성 후 처리해 주세요.") == false) {
				return;
			}
		
		    allUpdate();
/*			
		    let rooms_idx = $(this).val();
			
			var message = "";
			$.ajax({
				url: "/ajax/ajax_bedPrice_insert",
				type: "POST",
				data: {
					"rooms_idx"  : rooms_idx,
					"from_date"  : $("#o_sdate_"+rooms_idx).val(),
					"to_date"    : $("#o_edate_"+rooms_idx).val()
						
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
*/			
     	});
	});
</script>

<script>
	$(document).ready(function(){
		$(".room_copy").click(function(){

			if (!confirm('선택한 상품을 복사 하시겠습니까?'))
				return false;

			var message = "";

			let apiUrl = '<?= route_to('admin.api.hotel_.copy_room') ?>';

			$.ajax({
				url: apiUrl,
				type: "POST",
				data: {
					"g_idx"  : $(this).data('idx'),
					"rooms_idx"  : $(this).val()
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
		});

		$(".room_delete").click(function(){

			if (!confirm('룸을 삭제 하시겠습니까?'))
				return false;

			var message = "";
			$.ajax({
				url: "/ajax/ajax_room_delete",
				type: "POST",
				data: {
					"g_idx"  : $(this).data('idx'),
					"rooms_idx"  : $(this).val()
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
		});
	});
</script>

<script>
$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("body").css("cursor", "wait"); // 모래시계 커서 적용
    });

    $(document).ajaxStop(function () {
        $("body").css("cursor", "default"); // 원래 커서로 복귀
    });
});
</script>

<script>
	function updRoom(g_idx,roomIdx) {
		location.href = '/AdmMaster/_tourRegist/list_room_price?g_idx=' + g_idx + '&roomIdx=' + roomIdx +'&product_idx=' + $("#product_idx").val();
	}
</script>

<script>
	function allUpdRoom(g_idx, rooms_idx)
	{
		
		if (confirm("가격을 일괄 수정하시겠습니까?\n수정후에는 기간동안 동일한 가격으로 업데이트 됩니다.") == false) {
			return;
		}

		//$('#loading').show();
		$("#ajax_loader").removeClass("display-none");
		setTimeout(function () {
			let url = '/ajax/hotel_allUpdRoom_price'
			$.ajax({
				type: "POST",
				data: {
					    "product_idx"  :  $("#product_idx").val(),
						"g_idx"        :  g_idx,
						"rooms_idx"    :  rooms_idx,
						"o_sdate"      :  $("#o_sdate_"+rooms_idx).val(), 
						"o_edate"      :  $("#o_edate_"+rooms_idx).val(), 
						"goods_price1" :  $("#goods_price1_"+rooms_idx).val(), 
						"goods_price2" :  $("#goods_price2_"+rooms_idx).val(), 
						"goods_price3" :  $("#goods_price3_"+rooms_idx).val(),
						"goods_price4" :  $("#goods_price4_"+rooms_idx).val(),  
					},
				url: url,
				cache: false,
				async: true,
				success: function (data, textStatus) {
					let message = data.message;
					$("#ajax_loader").addClass("display-none");
					alert(message);
					location.reload();
				},
				error: function (request, status, error) {
					$("#ajax_loader").addClass("display-none");
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				} 
					
			});
		}, 50);				
	}	
</script>

<script>
	function allUpdate()
	{
		let f = document.frm;

		$("#ajax_loader").removeClass("display-none");
		setTimeout(function () {
			let url = '/ajax/hotel_room_allupdate'
			let prod_data = $(f).serialize();
			$.ajax({
				type: "POST",
				data: prod_data,
				url: url,
				cache: false,
				async: true,
				success: function (data, textStatus) {
					let message = data.message;
					$("#ajax_loader").addClass("display-none");
					//alert(message);
					location.reload();
				},
				error: function (request, status, error) {
					$("#ajax_loader").addClass("display-none");
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});
		}, 50);
	} 	
</script>

<script>
$(document).ready(function () {
    $(".bedAddBtn").click(function () {
        		
        var product_idx = $(this).data('product-idx');
        var g_idx       = $(this).data('g-idx');
        var rooms_idx   = $(this).data('rooms-idx');
        var room_name   = $("#room_name_"+rooms_idx).val();
		var o_sdate     = $("#o_sdate_"+rooms_idx).val();
		var o_edate     = $("#o_edate_"+rooms_idx).val();
        var adult       = $("#adult_"+rooms_idx).val();
        var kids        = $("#kids_"+rooms_idx).val();

		if(o_sdate == "" || o_edate == "") {
		   alert('침대 타입을 추가하시려면 적용 기간을 등록하셔야 합니다.');
		   return false;
		}
		
		allUpdate();
		
		$.ajax({
			url: "/ajax/ajax_bed_add",
			type: "POST",
			data: {
				room_name   : room_name,
				o_sdate     : o_sdate,	
				o_edate     : o_edate,	
				adult       : adult,
				kids        : kids,
                product_idx : product_idx,
                g_idx       : g_idx,
				rooms_idx   : rooms_idx
			},
			dataType: "json",
			success: function(res) {
				var message = res.message;
				//alert(message);
				location.reload();
			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText); // 서버 응답 내용 확인
				alert('Error: ' + error);
			}
		});	
 		
    });

    // 추가된 침대를 삭제하는 이벤트 (동적 요소 이벤트 바인딩)
    $(document).on("click", ".removeBedBtn", function () {
        $(this).closest("tr").remove();
    });
	
    $(document).on("click", ".deleteBedBtn", function () {
			let bed_idx   = $(this).val();
            var rooms_idx = $(this).data('idx'); 
			var room_name = $("#room_name_"+rooms_idx).val();
			var o_sdate   = $("#o_sdate_"+rooms_idx).val();
			var o_edate   = $("#o_edate_"+rooms_idx).val();
			var adult     = $("#adult_"+rooms_idx).val();
			var kids      = $("#kids_"+rooms_idx).val();
		
			$.ajax({
                url: "/ajax/ajax_bed_delete",
                type: "POST",
                data: {
                    bed_idx   : bed_idx,
					rooms_idx : rooms_idx,
					room_name : room_name,
					o_sdate   : o_sdate,	
					o_edate   : o_edate,	
					adult     : adult,
					kids      : kids
                },
                dataType: "json",
                success: function(res) {
                    var message = res.message;
                    //alert(message);
					location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // 서버 응답 내용 확인
                    alert('Error: ' + error);
                }
            });			
    });
	
	
});
</script>

<script>
let room_Idx = '<?=$roomIdx?>';
</script>

<script>
	function check_room_facil() {
		let count_room_facil = 0;

		$("._room_facil").each(function () {
			if ($(this).is(":checked")) {
				count_room_facil++;
			}
		});

		if (count_room_facil == $("._room_facil").length) {
			$("#all_room_facil").prop("checked", true);
		} else {
			$("#all_room_facil").prop("checked", false);
		}
	}

	check_room_facil();

	$("._room_facil").on("change", function () {
		check_room_facil();
	});

	$('#all_room_facil').change(function () {
		if ($('#all_room_facil').is(':checked')) {
			$('._room_facil').prop('checked', true)
		} else {
			$('._room_facil').prop('checked', false)
		}
	});
</script>

<script>
	$(document).ready(function() {
		$('.numberOnly').on('input', function() {
			// 입력값에서 숫자가 아닌 문자를 제거
			$(this).val($(this).val().replace(/[^0-9]/g, ''));
		});
	});
</script>

<script>
function saveValueRoom(e) {
	e.preventDefault();

	$(".img_add_group .file_input").each(function (index) { 
        $(this).find(".onum_img").val(index + 1);        
    });

	let formData = new FormData($('#formRoom')[0]);

	let room_facil = $("input[name=_room_facil]:checked").map(function () {
		return $(this).val();
	}).get().join('|');
	formData.append("room_facil", room_facil);

	let room_category = $("input[name=_room_category]:checked").map(function () {
		return $(this).val();
	}).get().join('|');
	formData.append("room_category", room_category);

	let apiUrl = `<?= route_to('admin.api.hotel_.write_room_ok') ?>`;



	$("#ajax_loader").removeClass("display-none");

	$.ajax(apiUrl, {
		type: 'POST',
		data: formData,
		contentType: false,
		processData: false,
		success: function (response) {
			console.log(response);
			alert(response.message);
			$("#ajax_loader").addClass("display-none");
			showOrHide();
			location.reload();
		},
		error: function (request, status, error) {
			alert("Error " + request.status + ": " + request.responseText);
			$("#ajax_loader").addClass("display-none");
		}
	});
}
</script>

<script>
$(".addTableBtn").on("click", function () {

			if (!confirm("룸을 추가 하시겠습니까?"))
			return false;

			var prod_idx = $(this).data('prod');
			var g_idx    = $(this).data('roomtype');
			
            $.ajax({
                url: "/ajax/ajax_room_add",
                type: "POST",
                data: {
                    prod_idx : prod_idx,
                    g_idx    : g_idx
                },
                dataType: "json",
                success: function(res) {
                    var message = res.message;
                    alert(message);
					location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // 서버 응답 내용 확인
                    alert('Error: ' + error);
                }
            });			
	
});
</script>

<script>
	$(document).ready(function () {

		// 클릭 이벤트 핸들러
		$(".addTableBtnx").on("click", function () {
			// 새로운 테이블 HTML 생성
			var mainIdx  = $(this).val();
			var prod_idx = $(this).data('prod');
			var roomtype = $(this).data('roomtype');

			var room_Idx = parseInt($("#roomIdx").val());
			room_Idx = room_Idx + 1;
			$("#roomIdx").val(room_Idx);
			
			const newTable = `
				  <table data-roomId="${room_Idx}">
					<tbody>
						<tr>
							<input type="hidden" name="product_idx[${room_Idx}]" value="${prod_idx}" /> 
							<input type="hidden" name="g_idx[${room_Idx}]"       value="${roomtype}" /> 
							<input type="hidden" name="rooms_idx[${room_Idx}]"   value="" /> 
							<input type="hidden" class="r_contents1" name="r_contents1[${room_Idx}]"    value="" /> 
							<input type="hidden" class="r_contents2" name="r_contents2[${room_Idx}]"    value="" /> 
							<input type="hidden" class="r_contents3" name="r_contents3[${room_Idx}]"    value="" /> 

						
							<td style="background-color: #eee;">
								<span>룸 명칭</span>
								<input style="width: 30%;" type="text" name="room_name[${room_Idx}]">
								<input style="width: 10%;" type="text" name="o_sdate[${room_Idx}]" id="" class="s_date datepicker">
								<span>~</span> 
								<input style="width: 10%;" type="text" name="o_edate[${room_Idx}]" id="" class="s_date datepicker">
								<!--button type="button" style="width: 50px; background-color : #4f728a; color : #fff;" class="btn_edit">수정</button-->
								<input type="checkbox">사용
								<input type="checkbox">미사용
								<div class="btns_setting">
									<!--button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">저장</button-->
									<button style="width: 50px ; background-color: #d03a3e; color : #fff;" class="deleteRowBtn btn_del">삭제</button>
								</div>
							</td>
						</tr>
						<tr class="product-row">
							<td>
								<span>기본가</span>
								<input style="width: 100px;" type="text" name="goods_price1[${room_Idx}]" class="numberOnly" onkeyup="chkNum(this)">
								<span>컨택가</span>
								<input style="width: 100px;" type="text" name="goods_price2[${room_Idx}]" class="numberOnly cost">
								<span>+수익</span>
								<input style="width: 100px;" type="text" name="goods_price3[${room_Idx}]" class="numberOnly profit">
								<span>=판매가</span>
								<input style="width: 100px;" type="text" name="goods_price[${room_Idx}]"  class="numberOnly price" readonly>
								<span>Extra 베드</span>
								<input style="width: 100px;" type="text" name="goods_price4[${room_Idx}]" class="numberOnly bed">
								<!--select>
									<option value="">현재 가격</option>
									<option value="">현재 가격</option>
								</select-->
								<label style="margin-left: 30px;" for="check_bx_001">비밀특가</label>
								<input id="check_bx_001" name="secret_price[${room_Idx}]" value="Y" type="checkbox">

								<label style="margin-left: 20px;" for="check_bx_001">특별할인</label>
								<input id="check_bx_002" name="special_discount[${room_Idx}]" value="Y" type="checkbox">
								<input style="width: 60px;" type="text" name="discount_rate[${room_Idx}]" value="" class="numberOnly" onkeyup="chkNum(this)">%
								
								<span style="margin-left: 30px;">가격표시</span>
								<input type="radio" name="price_view[${room_Idx}]" id="is_won_bath" value="" checked />
								<label for="is_won_bath">원화+바트</label>
								<input type="radio" name="price_view[${room_Idx}]" id="is_won" value="W" />
								<label for="is_won">원화</label>
								<input type="radio" name="price_view[${room_Idx}]" id="is_bath" value="B" />
								<label for="is_bath">바트</label>	
								
								<label style="margin-left: 20px;" for="check_bx_promotion">프로모션</label>
								<input id="check_bx_promotion" name="is_view_promotion[${room_Idx}]" value="Y" type="checkbox">
							</td>
						</tr>
						<tr>
							<td>
								<input type="radio" name="breakfast[${room_Idx}]" value="" checked >
								<span>조식 포함</span>
								<input type="radio" name="breakfast[${room_Idx}]" value="N" >
								<span>조식 미포함</span>
								<span style="margin-left:50px;">성인</span>
								<input style="width: 50px;" type="text" name="adult[${room_Idx}]" value="1" class="numberOnly" onkeyup="chkNum(this)">명
								<span style="margin-left:30px;">아동</span>
								<input style="width: 50px;" type="text" name="kids[${room_Idx}]" value="0"   class="numberOnly" onkeyup="chkNum(this)">명
							</td>
						</tr>
						
						<tr class="bed_child_${room_Idx}"> 
							<td>
								<p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (제목/금액))
								</p>
								<input style="width: 10%;" type="text" name="bed_type[${room_Idx}][]" placeholder="한글">
								<input style="width: 18%;" type="text" name="bed_type_eng[${room_Idx}][]" placeholder="영문">
								<input style="width: 8%;"  type="text" name="bed_price[${room_Idx}][]" onkeyup="chkNum(this)">
								<button type="button" style="width: 31px; height : 31px" value="${room_Idx}" class="addBedBtn" >+</button>
							</td>
						</tr>
						<tr class="option_child_${room_Idx}">
							<td>
								<p style="margin-bottom: 3px;">옵션 내용을 추가 합니다. (html 태그 사용가능)</p>
								<input style="width: 20%;" type="text" name="option_val[${room_Idx}][]">
								<button type="button" style="width: 31px; height : 31px" value="${room_Idx}" class="addOptionBtn" >+</button>
							</td>
						</tr>
					</tbody>
				</table>`;

			// 입력값이 변경될 때 판매가 자동 계산 (이벤트 위임)
			$(document).on('input', '.cost, .profit, .bed', function() {
				let row = $(this).closest('.product-row'); // 현재 행 찾기
				let cost = Number(row.find('.cost').val()) || 0;
				let profit = Number(row.find('.profit').val()) || 0;
				let bed = Number(row.find('.bed').val()) || 0;
				row.find('.price').val(cost + profit + bed); // 판매가 자동 계산
			});			

			// 새 테이블을 .table-container에 추가
			// $("#table_child_"+ mainIdx).append(newTable);
			// $("#table_child_" + mainIdx + " .datepicker").datepicker();				
			$(this).closest("table").find("table").first().before(newTable);
			
			$("table[data-roomid=" + room_Idx + "] .datepicker").datepicker();
		});

		// 삭제 버튼 동작
		$(document).on("click", ".deleteRowBtn", function () {
			$(this).closest("table").remove();
		});

	});
</script>	

<script>
$(document).ready(function () {
	// Add a new bed type row
	$(document).on('click', '.addOptionBtn', function () {
		// Extract the roomIdx from the button's value
		const roomIdx = $(this).val();
		const currentRow = $(this).closest('tr');  
		let lastRow = $(".option_child_" + roomIdx + ":last").clone(); // 문자열 연결 방식으로 선택자 생성

		// Define the new bed type row
		const newOptRow = `
			<tr class="optionRow_${roomIdx}">
				<td>
					<input style="width: 20%;" type="text" name="option_val[${roomIdx}][]">
					<button type="button" style="width: 31px; height: 31px;" class="removeBedBtn">-</button>
				</td>
			</tr>`;
		// Append the new row to the bed_child_<roomIdx> section
		//currentRow.after(newOptRow);
		$(".option_child_" + roomIdx + ":last").after(newOptRow);
	});

	// Remove a bed type row
	$(document).on('click', '.removeBedBtn', function () {
		// Remove the parent row of the clicked button
		$(this).closest('tr').remove();
	});
});
</script>


<script>
$(document).ready(function () {
	// Add a new bed type row
	$(document).on('click', '.addBedBtn', function () {
		// Extract the roomIdx from the button's value
		const roomIdx    = $(this).val();
		const currentRow = $(this).closest('tr');
		let lastRow = $(".bed_child_" + roomIdx + ":last").clone(); // 문자열 연결 방식으로 선택자 생성

		// Define the new bed type row
		const newBedRow = `
			<tr class="bedRow_${roomIdx}">
				<td>
					<input style="width: 18%;" type="text" placeholder="Bed Type" name="bed_type[${roomIdx}][]">
					<input style="width: 18%;" type="text" placeholder="Bed Type_eng" name="bed_type_eng[${roomIdx}][]">
					<input style="width: 8%;"  type="text" placeholder="Price"    name="bed_price[${roomIdx}][]" onkeyup="chkNum(this)">
					<button type="button" style="width: 31px; height: 31px;" class="removeBedBtn">-</button>
				</td>
			</tr>`;
		// Append the new row to the bed_child_<roomIdx> section
		//currentRow.after(newBedRow);
		$(".bed_child_" + roomIdx + ":last").after(newBedRow);
	});

	// Remove a bed type row
	$(document).on('click', '.removeBedBtn', function () {
		// Remove the parent row of the clicked button
		$(this).closest('tr').remove();
	});
});
</script>

<script>
	$("#mainRoom").on('change', '.chk_price_secret', function () {
		let check = "";
		if ($(this).is(":checked")) {
			check = "Y";
		}
		$(this).closest(".chk_price_wrap").find(".price_secret").val(check);
	});
</script>
<script>
	function add_sub_image() {        

		let i = Date.now();

		let html = `
			<div class="file_input_wrap">
                <div class="file_input">
                    <input type="hidden" name="i_idx[]" value="">
                    <input type="hidden" class="onum_img" name="onum_img[]" value="">
                    <input type="file" name='ufile[]' id="ufile${i}" multiple
                            onchange="productImagePreview(this, '${i}')">
                    <label for="ufile${i}"></label>
                    <input type="hidden" name="checkImg_${i}" class="checkImg">
                    <button type="button" class="remove_btn"
                            onclick="productImagePreviewRemove(this)"></button>
                </div>
            </div>
		`;

		$(".img_add_group").append(html);

	}

	function delete_all_image() {
        if (!confirm("이미지를 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다.")) {
            return false;
        }

        let arr_img = [];

		$(".img_add_group .file_input").each(function() {
            let id = $(this).find("input[name='i_idx[]']").val();
            if(id){
                arr_img.push({
                    i_idx: id,
                });
            }
		});

        if(arr_img.length > 0){
            $.ajax({
                url: "<?= route_to('admin.api.hotel_.delete_all_room_img') ?>",
                type: "POST",
                data: JSON.stringify({ arr_img: arr_img }),
                contentType: "application/json",
                success: function(response) {
                    alert(response.message);
                    if(response.result == true){
                        $(".img_add_group").html("");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("error:", error);
                }
            });
        }else{
            $(".img_add_group").html("");
        }
    }

	function productImagePreview(inputFile, onum) {
        if (inputFile.files.length <= 40 && inputFile.files.length > 0) {
            
            $(inputFile).closest('.file_input').addClass('applied');
            $(inputFile).closest('.file_input').find('.checkImg').val('Y');

            let lastElement = $(inputFile).closest('.file_input_wrap');
            let files = Array.from(inputFile.files);

            let imageReader = new FileReader();
            imageReader.onload = function () {
                $('label[for="ufile' + onum + '"]').css("background-image", "url(" + imageReader.result + ")");
            };
            imageReader.readAsDataURL(files[0]);

            if (files.length > 1) {
                files.slice(1).forEach((file, index) => {
                    let newReader = new FileReader();
                    let i = Date.now();

                    newReader.onload = function () {
                        let imagePreview = `
                            <div class="file_input_wrap">
                                <div class="file_input applied">
                                    <input type="hidden" name="i_idx[]" value="">
                                    <input type="hidden" class="onum_img" name="onum_img[]" value="">
                                    <input type="file" id="ufile${i}_${index}" 
                                        onchange="productImagePreview(this, '${i}_${index}')" disabled>
                                    <label for="ufile${i}_${index}" style='background-image:url(${newReader.result})'></label>
                                    <input type="hidden" name="checkImg_${i}_${index}" class="checkImg">
                                    <button type="button" class="remove_btn" onclick="productImagePreviewRemove(this)"></button>
                                </div>
                            </div>`;

                        lastElement.after(imagePreview);
                        lastElement = lastElement.next();
                    };

                    newReader.readAsDataURL(file);
                });
            }
        }else{
            alert('40개 이미지로 제한이 있습니다.');
        }
    }

	function productImagePreviewRemove(element) {
        let parent = $(element).closest('.file_input_wrap');
        if(parent.find('input[name="ufile[]"]').length > 0){
            let inputFile = parent.find('input[type="file"][multiple]')[0] 
                            || parent.prevAll().find('input[type="file"][multiple]')[0];
            let labelImg = parent.find('label');
            let i_idx = parent.find('input[name="i_idx[]"]').val();
    
            let dt = new DataTransfer();
            let fileArray = Array.from(inputFile.files);
            let imageUrl = labelImg.css('background-image').replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
            
            fileArray.forEach((file) => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    if (e.target.result !== imageUrl) {      
                        dt.items.add(file);
                    }
                };
                reader.readAsDataURL(file);
            });
    
            setTimeout(() => {
                inputFile.files = dt.files;
                if(parent.find('input[type="file"][multiple]')[0]){
                    parent.css("display", "none");
                }else{
                    parent.remove();
                }
            }, 100);
    
            if (i_idx) {
                if (!confirm("이미지를 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다.")) {
                    return false;
                }
    
                $.ajax({
                    url: "<?= route_to('admin.api.hotel_.delete_room_img') ?>",
                    type: "POST",
                    data: { "i_idx": i_idx },
                    success: function (data) {
                        alert(data.message);
                        if (data.result) {
                            parent.css("display", "none");
                        }
                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                    }
                });
            }
        }else{            
            parent.find('input[type="file"]').val("");
            parent.find('label').css("background-image", "");
            parent.find('.file_input').removeClass('applied');
            parent.find('.checkImg').val('N');
            parent.find('.imgpop').attr("href", "");
            parent.find('.imgpop').remove();
        }
    }

	function sizeAndExtCheck(input) {
		let fileSize = input.files[0].size;
		let fileName = input.files[0].name;

		// 20MB
		let megaBite = 20;
		let maxSize = 1024 * 1024 * megaBite;

		if (fileSize > maxSize) {
			alert("파일용량이 " + megaBite + "MB를 초과할 수 없습니다.");
			return false;
		}

		let fileNameLength = fileName.length;
		let findExtension = fileName.lastIndexOf('.');
		let fileExt = fileName.substring(findExtension, fileNameLength).toLowerCase();

		if (fileExt != ".jpg" && fileExt != ".jpeg" && fileExt != ".png" && fileExt != ".gif" && fileExt != ".bmp" && fileExt != ".ico") {
			alert("이미지 파일 확장자만 업로드 할 수 있습니다.");
			return false;
		}

		return true;
	}
</script>

<script>
	function moveUpRoom(btn) {
		let current = $(btn).closest(".item_");
		let prev = current.prev(".item_");

		if (prev.length) {
			current.insertBefore(prev);
			saveNewOrder();
		}
	}

	function moveDownRoom(btn) {
		let current = $(btn).closest(".item_");
		let next = current.next(".item_");

		if (next.length) {
			current.insertAfter(next);
			saveNewOrder();
		}
	}

	function saveNewOrder() {
		let items = document.querySelectorAll(".room_list .item_");
		let order = [];

		$(".room_list .item_").each(function(index) {
			order.push({
				g_idx: $(this).data("id"),
				position: index + 1
			});
		});

		$.ajax({
			url: "update_room_order",
			type: "POST",
			data: JSON.stringify({ order: order }),
			contentType: "application/json",
			success: function(response) {
				location.reload();
			},
			error: function(xhr, status, error) {
				console.error("error:", error);
			}
		});
	}
</script>

<script>
$(document).ready(function () {
    $(".btn-up, .btn-down").click(function () {
        let row     = $(this).closest("tr"); // 현재 클릭한 행
        let moveUp  = $(this).hasClass("btn-up"); // ▲ 버튼인지 ▼ 버튼인지 확인
        let swapRow = moveUp ? row.prev() : row.next(); // 변경 대상 행

        if (swapRow.length === 0) return; // 더 이상 이동할 수 없으면 종료

        let currentBedIdx = row.attr("data-bed-idx");
        let swapBedIdx    = swapRow.attr("data-bed-idx");
        let currentBedSeq = row.attr("data-bed-seq");
        let swapBedSeq    = swapRow.attr("data-bed-seq");

        //alert(currentBedIdx+'-'+currentBedSeq+'-'+swapBedIdx+'-'+swapBedSeq);
        if (typeof swapBedIdx === "undefined" || typeof swapBedSeq === "undefined") return; // 더 이상 이동할 수 없으면 종료

		// Ajax 요청
        $.ajax({
            url: "/ajax/ajax_bed_rank",
            type: "POST",
            data: {
					current_bed_idx : currentBedIdx,
					swap_bed_idx    : swapBedIdx,
					current_bed_seq : currentBedSeq,
					swap_bed_seq    : swapBedSeq
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data, textStatus) {
                var message = data.message;
                //alert(message);
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });		
    });
});
</script>

<iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>