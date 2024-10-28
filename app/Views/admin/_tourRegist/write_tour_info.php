<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

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
							<th>상품정보 [단위 : 호주달러(AUD)]</th>
							<td>
								<div style="margin:10px">
								<? if ($tours_idx == "") { ?>
								<a href="javascript:add_it();" class="btn btn-primary">추가</a>
								<a href="javascript:remove_it();" class="btn btn-primary">삭제</a>
								<? } ?>
								</div>
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
												소아가격(AUD)
											</td>
											<td style="width:15%;text-align:center">
												유아가격(AUD)
											</td>
											<td style="width:15%;text-align:center">
												판매상태
											</td>
										</tr>
									</thead>
									<tbody class="air_main">
									<?php if ($tours_idx): ?>
                                        <?php foreach ($tour as $frow2): ?>
                                            <tr style="height:40px" class="air_list_1">
                                                <td style="width:100px;text-align:center">
                                                    <input type="hidden" name="tours_idx[]" class="tours_idx" value="<?= ($frow2["tours_idx"]) ?>">
                                                    <input type="text" name="tours_subject[]" value="<?= ($frow2["tours_subject"]) ?>" class="tours_subject input_txt" style="width:100%" />
                                                </td>
                                                <td style="text-align:center">
                                                    <input type="text" name="tour_price[]" value="<?= ($frow2["tour_price"]) ?>" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
                                                    <input type="hidden" name="tour_price_ori[]" value="<?= ($frow2["tour_price_ori"]) ?>" class="price tour_price_ori input_txt" style="width:100%" numberOnly=true/>
                                                </td>
                                                <td style="text-align:center">
                                                    <input type="text" name="tour_price_kids[]" value="<?= ($frow2["tour_price_kids"]) ?>" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
                                                    <input type="hidden" name="tour_price_kids_ori[]" value="<?= ($frow2["tour_price_kids_ori"]) ?>" class="price tour_price_kids_ori input_txt" style="width:90%" numberOnly=true/>
                                                </td>
                                                <td style="text-align:center">
                                                    <input type="text" name="tour_price_baby[]" value="<?= ($frow2["tour_price_baby"]) ?>" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
                                                    <input type="hidden" name="tour_price_baby_ori[]" value="<?= ($frow2["tour_price_baby_ori"]) ?>" class="price tour_price_baby_ori input_txt" style="width:90%" numberOnly=true/>
                                                </td>
                                                <td style="text-align:center">
                                                    <select name="status">
                                                        <option value="Y" <?= $frow2['status'] == "Y" ? "selected" : "" ?>>판매중</option>
                                                        <option value="N" <?= $frow2['status'] != "Y" ? "selected" : "" ?>>중지</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr style="height:40px" class="air_list_1">
                                            <td style="width:100px;text-align:center">
                                                <input type="hidden" name="tours_idx[]" class="tours_idx" value="">
                                                <input type="text" name="tours_subject[]" value="" class="tours_subject input_txt" style="width:100%" />
                                            </td>
                                            <td style="text-align:center">
                                                <input type="text" name="tour_price[]" value="" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
                                                <input type="hidden" name="tour_price_ori[]" value="" class="price tour_price input_txt" style="width:100%" numberOnly=true/>
                                            </td>
                                            <td style="text-align:center">
                                                <input type="text" name="tour_price_kids[]" value="" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
                                                <input type="hidden" name="tour_price_kids_ori[]" value="" class="price tour_price_kids input_txt" style="width:90%" numberOnly=true/>
                                            </td>
                                            <td style="text-align:center">
                                                <input type="text" name="tour_price_baby[]" value="" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
                                                <input type="hidden" name="tour_price_baby_ori[]" value="" class="price tour_price_baby input_txt" style="width:90%" numberOnly=true/>
                                            </td>
                                            <td style="text-align:center">
                                                <select name="status">
                                                    <option value="Y" selected>판매중</option>
                                                    <option value="N">중지</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
									</tbody>
								</table>
							</td>
						</tr>
						
					</tbody>
					
				</table>
			</div>
			<script>
				function add_it()
				{
					var cnt = parseInt($(".air_list_1").length);
					$(".air_main").append($(".air_list_1:eq("+(parseInt(cnt)-1)+")").clone());
					$(".air_main").append($(".air_list_2:eq("+(parseInt(cnt)-1)+")").clone());
					$(".air_name_1:eq("+cnt+")").val("");
					$(".s_air_time_1:eq("+cnt+")").val("");
					$(".e_air_time_1:eq("+cnt+")").val("");
					$(".air_name_2:eq("+cnt+")").val("");
					$(".s_air_time_2:eq("+cnt+")").val("");
					$(".e_air_time_2:eq("+cnt+")").val("");
					$(".tour_price:eq("+cnt+")").val("");
					$(".tour_price_kids:eq("+cnt+")").val("");
					$(".tour_price_baby:eq("+cnt+")").val("");
					$(".oil_price:eq("+cnt+")").val("");
					$(".tour_price_max:eq("+cnt+")").val("");
					$(".tour_price_kids_max:eq("+cnt+")").val("");
					$(".tour_price_baby_max:eq("+cnt+")").val("");
					$(".oil_price_max:eq("+cnt+")").val("");
					$(".air_idx:eq("+cnt+")").val("");
//					$(".air_code:eq("+cnt+") option:eq(0)").attr("selected", "selected");
					$(".air_code_1:eq("+cnt+")").val("").attr("selected", "selected");
					$(".air_code_2:eq("+cnt+")").val("").attr("selected", "selected");
				}
				function remove_it()
				{
					var cnt = parseInt($(".air_list_1").length);
					if (cnt > 1)
					{
						$(".air_list_1:eq("+(parseInt(cnt)-1)+")").remove();
						$(".air_list_2:eq("+(parseInt(cnt)-1)+")").remove();
					}
				}
				$(window).load(function(){
					$("#datepicker1").datepicker("setDate", '<?=$s_date?>');
					$("#datepicker2").datepicker("setDate", '<?=$e_date?>');

				}); 				
			</script>



				<div class="tail_menu">
					<ul>
						<li class="left"></li>
						<li class="right_sub">

							<a href="javascript:history.back();" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
							<? if ($tours_idx == "") { ?>	
							<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
							<? } else { ?>
							<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
							<? } ?>
						</li>
					</ul>
				</div>





			
		</div>
		
	</div>
	<!-- // contents --> 
	</form>
	</span><!-- 인쇄 영역 끝 //--> 
</div>

<? include "../_include/_footer.php"; ?>
<?= $this->endSection() ?>