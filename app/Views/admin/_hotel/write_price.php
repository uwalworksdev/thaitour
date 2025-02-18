<?php

use App\Controllers\Admin\AdminHotelController;

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

        .popup_ {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.2); 
            display: none;
            align-items: center;
            justify-content: center;
        }

        .popup_.show_ {
            display: flex;
        }

        .popup_area_ {
            height: auto;
            /*min-height: 50vh;*/
            max-height: 60vh;
            overflow: auto;
            background-color: #FFFFFF;
            width: 100%;
            max-width: 800px;
            padding: 10px 40px 30px;
            font-size: 14px;
        }

        .popup_area_xl_ {
            max-width: 60vw;
        }

        .popup_top_ {
            width: 100%;
            height: 50px;
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #dbdbdb;
        }

        .popup_content_ {
            margin-top: 20px;
        }

        .popup_bottom_ {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding-top: 20px;
            width: 100%;
            border-top: 1px solid #dbdbdb;
        }

        .popup_bottom_ button {
            display: inline-block;
            width: 100px;
            height: 40px;
            border: 1px solid rgb(204, 204, 204);
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
								<td colspan="4">
									룸정보
									<button type="button" class="btn_select_room_list" onclick="showOrHide();" style="width : 90px ;background-color : #4f728a; color : #fff">룸타입 추가</button>
									<button type="button" class="btn_select_room_list" onclick="allUpdate();"  style="width : 90px ;background-color : #4f728a; color : #fff">전체저장</button>
								</td>
							</tr>

							<tr>
								<th>룸타입 등록</th>
								<td colspan="3">
								
								<?php foreach ($rresult as $row) : ?>
									<div class="item_" style="margin-bottom: 10px;">
										<input readonly="" type="text" value="<?=$row['roomName']?>" style="width:50%">
										<button class="btn_del" onclick="removeRoomSelect(this, <?=$row['g_idx']?>)" type="button" style="width: 50px; background-color: #4f728a; color : #fff;">삭제</button>
										<button class="btn_set" onclick="updateRoomSelect(this, <?=$row['g_idx']?>)" type="button" style="width: 50px ; background-color: #d03a3e; color : #fff;">수정</button>
									</div>
								<?php endforeach; ?>
								
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
										
										<?php foreach ($filteredRooms as $row): ?>
										<?php $roomIdx++; ?>

										<div class="head_table">
											<div class="btn_more">
												<button type="button" class="addTableBtn" value="<?=$roomIdx?>" data-prod="<?=$product_idx?>" data-roomtype="<?=$type['g_idx']?>" style="width:70px;background-color:#4f728a;color:#fff">룸 추가</button>
												<!--span style="color : red" class="note">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다</span-->
											</div>
										</div>


										<div id="table_child_<?=$roomIdx?>">
											
											<table>
												<tbody>
													<tr>
														<input type="hidden" name="product_idx[<?=$roomIdx?>]"  value="<?=$product_idx?>" /> 
														<input type="hidden" name="g_idx[<?=$roomIdx?>]"        value="<?=$type['g_idx']?>" /> 
														<input type="hidden" name="rooms_idx[<?=$roomIdx?>]"    value="<?=$row['rooms_idx']?>" /> 
														<td style="background-color: #eee;">
															<span>룸 명칭</span>
															<input style="width: 30%;" type="text" name="room_name[<?=$roomIdx?>]" value="<?=$row['room_name']?>">
															<input style="width: 10%;" type="text" name="o_sdate[<?=$roomIdx?>]" value="<?=$row['o_sdate']?>" id="" class="s_date datepicker">
															<span>~</span> 
															<input style="width: 10%;" type="text" name="o_edate[<?=$roomIdx?>]" value="<?=$row['o_edate']?>" id="" class="s_date datepicker">
															<button type="button" style="width: 100px; background-color : #4f728a; color : #fff;" class="btn_edit" onclick="updRoom('<?=$type['g_idx']?>','<?=$row['rooms_idx']?>',this)">일자별 수정</button>
															<!--input type="checkbox">사용-->
															<input type="checkbox">마감
															<div class="btns_setting">
																<!--button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">저장</button-->
																<button type="button" style="width: 50px ; background-color: #d03a3e; color : #fff;" class="btn_del room_delete" data-idx="<?=$type['g_idx']?>" value="<?=$row['rooms_idx']?>">삭제</button>
															</div>
														</td>
													</tr>
													
													<?php $goods_price = $row['goods_price2'] + $row['goods_price3']; ?>
													<tr class="product-row">
														<td>
															<span>기본가</span>
															<input style="width: 100px;" type="text" name="goods_price1[<?=$roomIdx?>]" value="<?=$row['goods_price1']?>" class="numberOnly">
															<span>컨택가</span>
															<input style="width: 100px;" type="text" name="goods_price2[<?=$roomIdx?>]" value="<?=$row['goods_price2']?>" class="numberOnly cost">
															<span>+수익</span>
															<input style="width: 100px;" type="text" name="goods_price3[<?=$roomIdx?>]" value="<?=$row['goods_price3']?>" class="numberOnly profit">
															<span>=상품가</span>
															<input style="width: 100px;text-align:right" type="text" name="goods_price[<?=$roomIdx?>]"  class="price" value="<?=number_format($goods_price)?>" readonly>
															<!--select>
																<option value="">현재 가격</option>
																<option value="">현재 가격</option>
															</select-->
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
															
														</td>
													</tr>
													
													<tr>
														<td>
															<input type="radio" name="breakfast[<?=$roomIdx?>]" value=""  <?php if($row['breakfast'] != "N") echo "checked";?> >
															<span>조식 포함</span>
															<input type="radio" name="breakfast[<?=$roomIdx?>]" value="N" <?php if($row['breakfast'] == "N") echo "checked";?> >
															<span>조식 미포함</span>
															<button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">참고</button>
															<span style="margin-left:50px;">성인</span>
															<input style="width: 50px;" type="text" name="adult[<?=$roomIdx?>]" value="<?=$row['adult']?>" class="numberOnly">명
															<span style="margin-left:30px;">아동</span>
															<input style="width: 50px;" type="text" name="kids[<?=$roomIdx?>]" value="<?=$row['kids']?>"   class="numberOnly">명
															&ensp;<button style="width: 80px; background-color: #4f728a; color : #fff;" class="btn_set">혜택보기</button>
														</td>
													</tr>
													
													<?php 
														 $bedType_arr  = explode(",", $row['bed_type']);
														 $bedPrice_arr = explode(",", $row['bed_price']);
													?>	
													
													<?php for($i=0;$i<count($bedType_arr);$i++) { ?>
													<tr class="bed_child_<?=$roomIdx?>">
														<td>
															<?php if($i==0) { ?>
															<p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (제목/금액))
															   <button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">참고</button>
															</p>
															<?php } ?>
															<!--input style="width: 18%;" type="text">
															<input style="width: 8%;" type="text">
															<input style="width: 18%; margin-left: 20px;" type="text">
															<input style="width: 8%;" type="text"-->
															<input style="width:18%;" type="text" name="bed_type[<?=$roomIdx?>][]"  value="<?=$bedType_arr[$i]?>" >
															<input style="width: 8%;" type="text" name="bed_price[<?=$roomIdx?>][]" value="<?=$bedPrice_arr[$i]?>" class="numberOnly">
																
															<?php if($i==0) { ?>
															<button type="button" style="width: 31px; height : 31px" value="<?=$roomIdx?>" class="addBedBtn" >+</button>
															<?php } else { ?>
															<button type="button" style="width: 31px; height: 31px;" class="removeBedBtn">-</button>																
															<?php } ?>
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
							<th>룸 이름</th>
							<td colspan="3">
								<input type="text" name="roomName" value="<?= $roomName ?? '' ?>" class="text"
									   style="width:300px" maxlength="50" id="roomName"/>
							</td>
						</tr>
						<tr>
							<th>객실시설</th>
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
										   name="_room_facil"
										   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
									<label for="room_facil_<?= $row_r['code_no'] ?>"><?= $row_r['code_name'] ?></label>
								<?php endforeach; ?>
							</td>
						</tr>

						<tr>
							<th>장면</th>
							<td colspan="3">
								<input type="text" name="scenery" value="<?= $scenery ?? '' ?>" class="text"
									   id="scenery" style="width:300px" maxlength="50"/>
							</td>
						</tr>

						<tr>
							<th>범주</th>
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
									<input type="checkbox" id="room_category_<?= $row_r['code_no'] ?>"
										   name="_room_category"
										   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
									<label for="room_category_<?= $row_r['code_no'] ?>"><?= $row_r['code_name'] ?></label>
								<?php endforeach; ?>
							</td>
						</tr>

						<tr>
							<th>식사</th>
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
							</td>
						</tr>

						<tr>
							<th>총인원</th>
							<td colspan="3">
								<input type="text" name="max_num_people" value="<?= $max_num_people ?? 1 ?>"
									   id="max_num_people" class="number" min="1" style="width:100px"/>
							</td>
						</tr>
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
<script>
    $(document).ready(function(){
        $('.product-row').on('input', '.cost, .profit', function() {
            let row = $(this).closest('.product-row'); // 현재 입력된 행(row) 찾기
            let cost = Number(row.find('.cost').val()) || 0;
            let profit = Number(row.find('.profit').val()) || 0;
            row.find('.price').val(cost + profit); // 판매가 자동 계산
        });
    });
</script>

<script>
	$(document).ready(function(){
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
	function updRoom(g_idx,roomIdx) {
		location.href = '/AdmMaster/_tourRegist/list_room_price?g_idx=' + g_idx + '&roomIdx=' + roomIdx +'&product_idx=' + $("#product_idx").val();
	}
</script>
	
<script>
	function allUpdate()
	{
		let f = document.frm;

		let url = '/ajax/hotel_room_allupdate'
		let prod_data = $(f).serialize();
		$.ajax({
			type: "POST",
			data: prod_data,
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
let room_Idx = '<?=$roomIdx?>';
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
	$(document).ready(function () {

		// 클릭 이벤트 핸들러
		$(".addTableBtn").on("click", function () {
			// 새로운 테이블 HTML 생성
			var mainIdx  = $(this).val();
			var prod_idx = $(this).data('prod');
			var roomtype = $(this).data('roomtype');

			var room_Idx = parseInt($("#roomIdx").val());
			room_Idx = room_Idx + 1;
			$("#roomIdx").val(room_Idx);
			
			const newTable = `
				  <table>
					<tbody>
						<tr>
							<input type="hidden" name="product_idx[${room_Idx}]" value="${prod_idx}" /> 
							<input type="hidden" name="g_idx[${room_Idx}]"       value="${roomtype}" /> 
							<input type="hidden" name="rooms_idx[${room_Idx}]"   value="" /> 
						
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
								<span>=상품가</span>
								<input style="width: 100px;" type="text" name="goods_price[${room_Idx}]"  class="numberOnly price" readonly>
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
							</td>
						</tr>
						<tr>
							<td>
								<input type="radio" name="breakfast[${room_Idx}]" value="" checked >
								<span>조식 포함</span>
								<input type="radio" name="breakfast[${room_Idx}]" value="N" >
								<span>조식 미포함</span>
								<button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">참고</button>
								<span style="margin-left:50px;">성인</span>
								<input style="width: 50px;" type="text" name="adult[${room_Idx}]" value="1" class="numberOnly" onkeyup="chkNum(this)">명
								<span style="margin-left:30px;">아동</span>
								<input style="width: 50px;" type="text" name="kids[${room_Idx}]" value="0"   class="numberOnly" onkeyup="chkNum(this)">명
							</td>
						</tr>
						
						<tr class="bed_child_${room_Idx}"> 
							<td>
								<p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (제목/금액))
								   <button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">참고</button>
								</p>
								<input style="width: 18%;" type="text" name="bed_type[${room_Idx}][]">
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
			$(document).on('input', '.cost, .profit', function() {
				let row = $(this).closest('.product-row'); // 현재 행 찾기
				let cost = Number(row.find('.cost').val()) || 0;
				let profit = Number(row.find('.profit').val()) || 0;
				row.find('.price').val(cost + profit); // 판매가 자동 계산
			});			

			// 새 테이블을 .table-container에 추가
			$("#table_child_"+ mainIdx).append(newTable);
			$("#table_child_" + mainIdx + " .datepicker").datepicker();				
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
			<div class="file_input">
				<input type="hidden" name="i_idx[]" value="">
				<input type="file" name='ufile[]' id="ufile${i}"
						onchange="productImagePreview(this, '${i}')">
				<label for="ufile${i}"></label>
				<input type="hidden" name="checkImg_${i}" class="checkImg">
				<button type="button" class="remove_btn"
						onclick="productImagePreviewRemove(this)"></button>

			</div>
		`;

		$(".img_add_group").append(html);

	}

	function productImagePreview(inputFile, onum) {
		if (!sizeAndExtCheck(inputFile)) {
			$(inputFile).val("");
			return false;
		}

		let imageTag = $('label[for="ufile' + onum + '"]');

		if (inputFile.files.length > 0) {
			let imageReader = new FileReader();

			imageReader.onload = function () {
				imageTag.css("background-image", "url(" + imageReader.result + ")");
				$(inputFile).closest('.file_input').addClass('applied');
				$(inputFile).closest('.file_input').find('.checkImg').val('Y');
			};
			
			imageReader.readAsDataURL(inputFile.files[0]);
		}
	}

	function productImagePreviewRemove(element) {
		let parent = $(element).closest('.file_input');
		let inputFile = parent.find('input[type="file"]');
		let labelImg = parent.find('label');
		let i_idx = parent.find('input[name="i_idx[]"]').val();

		if(parent.find('input[name="i_idx[]"]').length > 0){
			if(i_idx){
				if(!confirm("이미지를 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다.")){
                    return false;
                }

				$.ajax({

					url: "<?= route_to('admin.api.hotel_.delete_room_img') ?>",
					type: "POST",
					data: {
						"i_idx"   : i_idx,
					},
					success: function (data, textStatus) {
						message = data.message;
						alert(message);
						if(data.result){
							parent.closest('.file_input_wrap').remove();
						}
					},
					error: function (request, status, error) {
						alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
					}
				});
			}else{
				parent.remove();
			}
		}else{
			inputFile.val("");
			labelImg.css("background-image", "");
			parent.removeClass('applied');
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
<iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>