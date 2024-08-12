<? include "../_include/_header.php"; ?>
<?

	$g_list_rows		= 10;
	$pg					= updateSQ($_GET["pg"]);
	if($pg == "")       $pg = 1;
	$search_name		= updateSQ($_GET["search_name"]);
	$search_category	= updateSQ($_GET["search_category"]);
	$product_code_1	    = "1320";
	$product_code_2	    = updateSQ($_GET["product_code_2"]);
	$product_code_3	    = updateSQ($_GET["product_code_3"]);
	$s_product_code_1	= updateSQ($_GET["s_product_code_1"]);
	$s_product_code_2	= updateSQ($_GET["s_product_code_2"]);
	$s_product_code_3	= updateSQ($_GET["s_product_code_3"]);
	$date_chker			= updateSQ($_GET["date_chker"]);
	$s_date				= updateSQ($_GET["s_date"]);
	$e_date				= updateSQ($_GET["e_date"]);
	$s_time				= updateSQ($_GET["s_time"]);
	$e_time				= updateSQ($_GET["e_time"]);
	$is_view_y			= $_GET["is_view_y"];
	$is_view_n			= $_GET["is_view_n"];
	$best	    		= $_GET["best"];
    $orderBy            = $_GET["orderBy"];
	if($orderBy == "")  $orderBy = 1;

    $search_val  = "?product_code_1=". $product_code_1;
    $search_val .= "&product_code_2=". $product_code_2;
    $search_val .= "&product_code_3=". $product_code_3;
	$search_val .= "&product_code=". $product_code;
    $search_val .= "&is_view_y=". $is_view_y; 
    $search_val .= "&is_view_n=". $is_view_n; 
    $search_val .= "&best=". $best;
    $search_val .= "&s_date=". $s_date;
    $search_val .= "&e_date=". $e_date;
    $search_val .= "&s_time=". $s_time;
    $search_val .= "&e_time=". $e_time;
    $search_val .= "&search_category=". $search_category;
    $search_val .= "&search_name=". $search_name;
    $search_val .= "&orderBy=". $orderBy;
    
	$strSql = "";

    if($is_view_y == "Y") {
		$strSql = $strSql." and is_view = 'Y' ";
    }

    if($is_view_n == "Y") {
		$strSql = $strSql." and is_view = 'N' ";
    }

    if($best == "Y") {
		$strSql = $strSql." and product_best = 'Y' ";
    }
    
	if ($search_name)
	{
		$strSql = $strSql." and replace(".$search_category.",'-','') like '%".str_replace("-","",$search_name)."%' ";
	}
	if ($product_code_1)
	{
		$strSql = $strSql." and product_code_1 = '".$product_code_1."' ";
	}
	if ($product_code_2)
	{
		$strSql = $strSql." and product_code_2 = '".$product_code_2."' ";
	}
	if ($product_code_3)
	{
		$strSql = $strSql." and product_code_3 = '".$product_code_3."' ";
	}
    
	//echo $strSql;
	//$strSql = $strSql." and substring(product_code_1,1,2) = '13' ";
	//$strSql = $strSql." and substring(product_code_1,1,4) != '1308' ";
	// $total_sql = " select *		
	// 					,(select code_name from tbl_code where tbl_code.code_no=tbl_product_mst.product_code_1) as product_code_name_1
	// 					,(select code_name from tbl_code where tbl_code.code_no=tbl_product_mst.product_code_2) as product_code_name_2
	// 					from tbl_product_mst where 1=1 $strSql ";
	$total_sql = " 
			SELECT p1.*, c1.code_name AS product_code_name_1, c2.code_name AS product_code_name_2 FROM tbl_product_mst AS p1 
						LEFT JOIN tbl_code AS c1 ON p1.product_code_1 = c1.code_no
						LEFT JOIN tbl_code AS c2 ON c2.code_no = p1.product_code_2  where 1=1 $strSql group by p1.product_idx ";
    //echo "<pre>";
    //write_log($total_sql);
    //echo "</pre>";
	
	$result = mysqli_query($connect, $total_sql) or die (mysqli_error($connect));
	$nTotalCount = mysqli_num_rows($result);
?>
		<div id="container">
		<span id="print_this"><!-- 인쇄영역 시작 //-->

			<header id="headerContainer">
				
				<div class="inner">
					<h2>허니문 상품관리</h2>
					<div class="menus">
						<ul class="first">
						</ul>

						<ul class="last">
							<li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
							<li><a href="write_honeymoon.php" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> <span class="txt">상품 등록</span></a></li>
						</ul>
						
					</div>

				</div><!-- // inner -->

			</header><!-- // headerContainer -->
			<!-- <style>
				.listTable01 tr td:first-child {
					font-size: 14px;
					font-weight: 800;
					background: #fafafa;
					border-right: solid 1px #ddd;
				}
				.listTable01 td {
					padding: 10px;
					font-size: 12px;
					border: 1px solid #dddddd !important;
				}	
				.listTable01 td p {
					/* display: inline-block; */
					float: left;
					width: 150px;
				}
				.listTable01 select {
					width: 146px;
					height: 30px;
					line-height: 27px;
					padding: 1px;
					border: 1px solid #ccc;
					font-size: 12px;
					color: #000;
					margin: 0;
					vertical-align: middle;
				}
				.listTable01 .contact_btn_box {
					margin: 0;
					padding: 0;
					background: 0 none;
				}
				.listTable01 .contact_btn_box > div {
					padding: 0;
					margin-left: 4px;
					float: left;
				}
				.listTable01 .contact_btn_box .contact_btn:first-child {
					margin-left: 0;
				}
				.contact_btn_box .contact_btn {
					display: inline-block;
					float: left;
					margin-right: 10px;
					width: 60px;
					height: 30px;
					border: solid 1px #cdcdcd;
					background-color: #ffffff;
					outline: none;
					line-height: 30px;
					color: #555555;
					font-size: 13px;
				}
				.contact_btn_box:after {
					content: "";
					display: block;
					clear: both;
				}
				.contact_btn_box input[type="text"] {
					float: left;
					padding: 0 10px;
					width: 116px;
					margin: 0 5px;
					background-color: #fff;
					box-sizing: border-box;
				}
				.contact_btn_box span {
					float: left;
					line-height: 30px;
				}
				.listTable01 input[type=text] {
					border-radius: 0;
				}
				.ui-datepicker-trigger {
					display: none;
				}
			</style> -->
			<div id="contents">
				<form name="search" id="search">
				<input type="hidden" name="orderBy"     id="orderBy"     value="<?=$orderBy?>">
				<input type="hidden" name="pg"          id="pg"          value="<?=$pg?>">
				<input type="hidden" name="product_idx" id="product_idx" value="">

					<table cellpadding="0" cellspacing="0" summary="" class="listTable01" style="table-layout:fixed;">
						<colgroup>
							<col width="150">
							<col width="*">
						</colgroup>
						<thead>
							<tr>
								<th colspan="2"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="label">카테고리</td>
							<td>
									<select id="product_code_1" name="product_code_1" class="input_select" onchange="javascript:get_code(this.value, 3)">
										<option value="">1차분류</option>
										<?
											$fsql    = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1320'  and status='Y' order by onum desc, code_idx desc";
											$fresult = mysqli_query($connect, $fsql) or die (mysqli_error($connect));
											while($frow=mysqli_fetch_array($fresult)){
												$status_txt = "";
												if ($frow["status"] == "Y")
												{ 
													$status_txt = "";
												} elseif ($frow["status"] == "N") {
													$status_txt = "[삭제]";
												} elseif ($frow["status"] == "C") {
													$status_txt = "[마감]";
												}

										?>
										<option value="<?=$frow["code_no"]?>" <? if ($frow["code_no"] == $product_code_1) {echo "selected"; } ?>><?=$frow["code_name"]?> <?=$status_txt?></option>
										<? } ?>
										
									</select> 
									<select id="product_code_2" name="product_code_2" class="input_select" onchange="javascript:get_code(this.value, 4)">
										<option value="">2차분류</option>
										<?
											$fsql    = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='".$product_code_1."' and status='Y'  order by onum desc, code_idx desc";
											echo $fsql;
											$fresult = mysqli_query($connect, $fsql) or die (mysqli_error($connect));
											while($frow=mysqli_fetch_array($fresult)){
												$status_txt = "";
												if ($frow["status"] == "Y")
												{ 
													$status_txt = "";
												} elseif ($frow["status"] == "N") {
													$status_txt = "[삭제]";
												} elseif ($frow["status"] == "C") {
													$status_txt = "[마감]";
												}

										?>
										<option value="<?=$frow["code_no"]?>" <? if ($frow["code_no"] == $product_code_2) {echo "selected"; } ?>><?=$frow["code_name"]?> <?=$status_txt?></option>
										<? } ?>
									</select> 
									<select id="product_code_3" name="product_code_3" class="input_select">
										<option value="">3차분류</option>
										<?
											$fsql    = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='".$product_code_2."' and status='Y'  order by onum desc, code_idx desc";
											$fresult = mysqli_query($connect, $fsql) or die (mysqli_error($connect));
											while($frow=mysqli_fetch_array($fresult)){
												$status_txt = "";
												if ($frow["status"] == "Y")
												{ 
													$status_txt = "";
												} elseif ($frow["status"] == "N") {
													$status_txt = "[삭제]";
												} elseif ($frow["status"] == "C") {
													$status_txt = "[마감]";
												}

										?>
										<option value="<?=$frow["code_no"]?>" <? if ($frow["code_no"] == $product_code_3) {echo "selected"; } ?>><?=$frow["code_name"]?> <?=$status_txt?></option>
										<? } ?>
									</select> 
                                </td>
							</tr> 	

							<tr>
								<td class="label">상태</td>
								<td class="inbox">
									<p> <input name="is_view_y" class="type_chker" id="is_view_y" type="checkbox" value="Y" <?if($is_view_y == "Y")echo"checked";?>> <label for="state_chker_1">사용</label></p>
									<p> <input name="is_view_n" class="type_chker" id="is_view_n" type="checkbox" value="Y" <?if($is_view_n == "Y")echo"checked";?>> <label for="state_chker_2">사용안함</label></p>
									<p> <input name="best"      class="type_chker" id="best"      type="checkbox" value="Y" <?if($best      == "Y")echo"checked";?>> <label for="state_chker_3">베스트</label></p>
								</td>
							</tr>
							<!--tr>
								<td class="label">기간검색</td>
								<td class="inbox">
									<!--p>
										<select name="date_chker" id="date_chker" class="select_02" >
											<option value="regdate" <?if($date_chker=="regdate")echo"selected";?> >주문일</option>
											<option value="applDate" <?if($date_chker=="applDate")echo"selected";?> >결제일</option>
											<option value="return_date" <?if($date_chker=="return_date")echo"selected";?> >반품접수일</option>
											<option value="complete_date" <?if($date_chker=="complete_date")echo"selected";?> >배송완료일</option>
										</select>&nbsp;	
									</p-->
									<!--div class="contact_btn_box">
										<div>
											<button type="button" rel="<?=date('Y-m-d')?>" class="contact_btn" title="today">오늘</button>
											<button type="button" rel="<?=date('Y-m-d', strtotime('-1 week'));?>" class="contact_btn" title="week">1주일</button>
											<button type="button" rel="<?=date('Y-m-d', strtotime('-1 month'));?>" class="contact_btn" title="1month">1개월</button>
											<button type="button" rel="<?=date('Y-m-d', strtotime('-6 month'));?>" class="contact_btn" title="6month">6개월</button>
											<button type="button" rel="<?=date('Y-m-d', strtotime('-1 year'));?>" class="contact_btn" title="year">1년</button>
											<input type="text" name="s_date" id="s_date" value="<?=$s_date?>" class="date_form" ><span>~</span><input type="text" name="e_date" id="e_date" value="<?=$e_date?>" class="date_form" >
											<div id="time_layer" style="float: left; display: <?= (trim($s_time) == "" && trim($e_time) == "" ? "none" : "") ?>;">
												<select id="s_time" name="s_time">
													<option value="">선택</option>
													<?php for($t=1; $t<=23; $t++) { ?>
														<option value="<?=$t?>" <?=((int)($s_time) == $t ? "selected" : "")?> ><?=((int)($t) < 10 ? "0" . (int)($t) : (int)($t))?></option>
													<?php } ?>
												</select> ~
												<select id="e_time" name="e_time">
													<option value="">선택</option>
													<?php for($t=1; $t<=23; $t++) { ?>
														<option value="<?=$t?>" <?=((int)($e_time) == $t ? "selected" : "")?> ><?=((int)($t) < 10 ? "0" . (int)($t) : (int)($t))?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</td>
							</tr-->
							<tr>
								<td class="label">검색어</td>
								<td class="inbox">
									<div class="r_box">
										<select id="" name="search_category" class="input_select" style="width:112px">
											<option value="product_name" <? if ($search_category == "product_name") {echo "selected"; } ?>>상품명</option>
											<option value="product_air" <? if ($search_category == "product_air") {echo "selected"; } ?>>이용항공</option>
											<option value="phone" <? if ($search_category == "phone") {echo "selected"; } ?>>담당자 전화번호</option>
											<option value="product_code" <? if ($search_category == "product_code") {echo "selected"; } ?>>상품코드</option>
										</select>
										<input type="text" id="search_name" name="search_name" value="<?=$search_name?>" class="input_txt placeHolder" placeholder="검색어 입력" style="width:240px" onkeydown="if(event.keyCode==13)search_it();">
										<a href="javascript:search_it()" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> <span class="txt">검색</span></a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
				
				<script>
				function search_it()
				{
					var frm = document.search;
					if (frm.search_name.value == "검색어 입력")
					{
						frm.search_name.value = "";
					}
					frm.submit();
				}
				$(function() {
					$.datepicker.regional['ko'] = {
					showButtonPanel: true,   
					beforeShow: function( input ) {   
						setTimeout(function() {   
							var buttonPane = $( input )   
							.datepicker( "widget" )   
							.find( ".ui-datepicker-buttonpane" );   
							var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');   
							btn .unbind("click").bind("click", function () {   
								$.datepicker._clearDate( input );   
							});   
							btn.appendTo( buttonPane );   
						}, 1 );   
					}   ,
					closeText: '닫기',
					prevText: '이전',
					nextText: '다음',
					monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
					monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
					dayNames: ['일','월','화','수','목','금','토'],
					dayNamesShort: ['일','월','화','수','목','금','토'],
					dayNamesMin: ['일','월','화','수','목','금','토'],
					weekHeader: 'Wk',
					dateFormat: 'yy-mm-dd',
					firstDay: 0,
					isRTL: false,
					showMonthAfterYear: true,
					changeMonth: true,
					changeYear: true,
					showMonthAfterYear: true,
					closeText: '닫기',  // 닫기 버튼 패널
					yearSuffix: ''};
					$.datepicker.setDefaults($.datepicker.regional['ko']);

					$( ".date_form" ).datepicker({ 
						showButtonPanel: true
						,beforeShow: function( input ) {   
							setTimeout(function() {   
								var buttonPane = $( input )   
								.datepicker( "widget" )   
								.find( ".ui-datepicker-buttonpane" );   
								var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');   
								btn .unbind("click").bind("click", function () {   
									$.datepicker._clearDate( input );   
								});   
								btn.appendTo( buttonPane );   
							}, 1 );   
						}
						,dateFormat: 'yy-mm-dd'
						,showOn: "both"
						,yearRange: "c-100:c+10"
						,buttonImage: "/AdmMaster/_images/common/date.png"
						,buttonImageOnly: true
						,closeText: '닫기'
						,prevText: '이전'
						,nextText: '다음'
				
					});
				});
				$(".contact_btn_box .contact_btn").click(function(){
					resetClass();
					$(this).addClass("active");

					
					var date1 = $(this).attr("rel");
					var date2 = $.datepicker.formatDate('yy-mm-dd',new Date());

					$("#s_date").val(date1);
					$("#e_date").val(date2);

				});

				function resetClass(){
					$(".contact_btn_box .contact_btn").each(function(){
						$(this).removeClass("active");
					});
				}
				</script>

                <script>
				function change_it()
				{
					/*
					   $.ajax({
							url: "change.php",
							type: "POST",
							data: $("#frm").serialize(),
							error : function(request, status, error) {
							 //통신 에러 발생시 처리
								alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
								$("#ajax_loader").addClass("display-none");
							}
							,complete: function(request, status, error) {
				//				$("#ajax_loader").addClass("display-none");
							}
							, success : function(response, status, request) {
								if (response == "OK")
								{
									alert_("정상적으로 변경되었습니다.");
										location.reload();
									return;
								} else {
									alert(response);
									alert_("오류가 발생하였습니다!!");
									return;
								}
							}
						});
                    */
						var f = document.frm;

						var prod_data = $(f).serialize();
						var save_result = "";
						$.ajax({
							type  : "POST",
							data  : prod_data,
							url   :  "ajax_change.php",
							cache : false,
							async : false,
							success: function(data, textStatus) {
								save_result = data;
								//alert('save_result- '+save_result);
								var obj = jQuery.parseJSON(save_result);
								var message = obj.message;
								alert(message);  
								location.reload();
							},
							error:function(request,status,error){
								alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
							}
						});
				 }

				</script>

				<div class="listWrap">
					<!-- 안내 문구 필요시 구성 //-->

				
				
		

					
					<div class="listTop flex_b_c">
						<div class="left">
							<p class="schTxt">■ 총 <?=$nTotalCount?>개의 목록이 있습니다.</p>
						</div>
						<div class="right_btn">
							<button type="button" class="btn_filter" onclick="orderBy_set('1');"><img src="../_images/common/filter.png" alt="">순위순</button>
							<button type="button" class="btn_filter" onclick="orderBy_set('2');"><img src="../_images/common/filter.png" alt="">최신순</button>
							<button type="button" class="btn_filter" onclick="orderBy_set('3');"><img src="../_images/common/filter.png" alt="">예약순</button>
						</div>

					</div><!-- // listTop -->
					
					
					



					<form name="frm" id="frm">				
					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" class="listTable">
						<caption></caption>
						<colgroup>
						<col width="50px" />
						<col width="200px" />
						<col width="100px" />
						<col width="120px" />						
						<col width="*" />
						<!-- <col width="120px" /> -->
						<col width="100px" />
						<col width="100px" />
						<col width="80px" />
						<col width="80px" />
						<col width="100px" />
						<col width="80px" />
						<col width="150px" />
						<col width="100px" />
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>메인/상품분류</th>
								<th>상품코드/지역</th>	
								<th>썸네일이미지</th>
								<th>타이틀</th>
								<!-- <th>이용항공</th> -->
								<th>상품담당자</th>
								<th>사용유무</th>
								<th>베스트</th>
								<th>특가여부</th>
								<th>순위</th>
								<th>예약건수</th>
								<th>등록일</th>
								<th>관리</th>
							</tr>
						</thead>	
						<tbody>
							<?
							    $order = " onum desc ";
							    if($orderBy == "1") $order = " onum desc ";
							    if($orderBy == "2") $order = " r_date desc ";
							    if($orderBy == "3") {
                                   order_summary();
								   $order = " deposit_cnt desc ";
                                }

								$nPage = ceil($nTotalCount / $g_list_rows);
								if ($pg == "") $pg = 1;
								$nFrom = ($pg - 1) * $g_list_rows;

								$sql    = $total_sql . " order by $order limit $nFrom, $g_list_rows ";
								//echo "<pre>";
								//echo $orderBy;
								//echo "</pre>";
								//exit;
								$result = mysqli_query($connect, $sql) or die (mysqli_error($connect));
								$num = $nTotalCount - $nFrom;
								if ($nTotalCount == 0) {
							?>
							<tr>
								<td colspan=13 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
							</tr>
							<?
								}
								while($row=mysqli_fetch_array($result))
								{
								      $sql_l    = "select * from tbl_product_level where idx = '{$row['product_level']}' ";
								      $result_l = mysqli_query($connect, $sql_l) or die (mysqli_error($connect));
									  $row_l    = mysqli_fetch_array($result_l);

							?>
							<tr style="height:50px">
								<td rowspan="2"><?=$num--?></td>
								<td rowspan="2" class="tac">
									<a href="#!" onclick="go_write('<?=$row["product_idx"]?>');"><?=$row["product_code_name_1"]?> / <?=$row["product_code_name_2"]?></a>
									<br>
									<a href="<? echo '/t-honeymoon/item_view.php?product_idx=' . $row['product_idx']?>" class="product_view" target="_blank">[<span>상품상세</span>]</a>
								</td>
								<td rowspan="2" class="tac"><?=$row["product_code"]?></td>
								<td class="tac">
									<? if ($row["ufile1"] != "") { ?>
									<a href="/data/product/<?=$row["ufile1"]?>" class="imgpop"><img src="/data/product/<?=$row["ufile1"]?>" style="max-width:150px;max-height:100px"></a>
									<? } ?>
								</td>
								<td class="tal" style="font-weight:bold">
									<a href="write_honeymoon.php?s_product_code_1=<?=$s_product_code_1?>&s_product_code_2=<?=$s_product_code_2?>&s_product_code_2=<?=$s_product_code_3?>&search_category=<?=$search_category?>&search_name=<?=$search_name?>&pg=<?=$pg?>&product_idx=<?=$row["product_idx"]?>">
									<?=viewSQ($row["product_name"])?>
									</a><br>최저가 : <?=number_format($row['product_price'])?>원<!-- <br>상품등급: <?=$row_l['level_name']?> -->
									<br>여행기간 : <?=$row["tour_period"]?>일

								</td>
								<!-- <td class="tac"><?=$row["product_air"]?></td> -->
								<td class="tac"><?=$row["product_manager"]?></td>
								<td class="tac">
								    <select name="is_view[]" id="is_view_<?=$row["product_idx"]?>">
									 <option value="Y" <?php if($row["is_view"] == "Y") echo "selected";?> >사용</option>
									 <option value="N" <?php if($row["is_view"] != "Y") echo "selected";?> >사용안함</option>
									</select>
								</td>
								<td class="tac">
								<input name="is_best" name="product_best_best" class="type_chker" id="product_best_best_<?=$row["product_idx"]?>" type="checkbox" onchange="check_best(<?=$row['product_idx']?>)" value="Y" <?if($row["product_best"] == "Y") echo "checked";?> >
									<?
									/*
										if ($row["product_best"] == "Y") {
											echo "<font color='blue'>베스트</font>";
										} elseif ($row["product_best"] == "01") {
											echo "<font color='red'>BEST 상품</font>";
										} elseif ($row["product_best"] == "02") {
											echo "<font color='red'>유럽 추천상품</font>";
										} elseif ($row["product_best"] == "03") {
											echo "<font color='red'>미주 추천상품</font>";
										} elseif ($row["product_best"] == "04") {
											echo "<font color='red'>일본 추천상품</font>";
										} elseif ($row["product_best"] == "05") {
											echo "<font color='red'>중국(홍콩/대만) 추천상품</font>";
										} elseif ($row["product_best"] == "06") {
											echo "<font color='red'>동남아추천상품</font>";
										}
                                     */
									?>
								</td>
								<td class="tac">
									<input name="special_price_price" class="type_chker" id="special_price_price_<?=$row["product_idx"]?>" type="checkbox" onchange="check_sale(<?=$row['product_idx']?>)" <?if($row["special_price"] == "Y") echo "checked";?> >	
								</td>
								<td>
								<input type="text" name="onum[]" id="onum_<?=$row["product_idx"]?>" value="<?=$row['onum']?>" style="width:66px;">
								<input type="hidden" name="product_best[]" id="product_best_<?=$row["product_idx"]?>" value="<?=$row["product_best"]?>" style="width:66px;">
								<input type="hidden" name="special_price[]" id="special_price_<?=$row["product_idx"]?>" value="<?=$row["special_price"]?>" style="width:66px;">
								<input type="hidden" name="code_idx[]" value="<?=$row["product_idx"]?>" class="input_txt"/>
								</td>
								<td>
									<?=$row["deposit_cnt"]?>
								</td>
								<td>
									<?=$row["r_date"]?>
								</td>
								<td>
									<a href="#!" onclick="prod_update('<?=$row['product_idx']?>');"><img src="/AdmMaster/_images/common/ico_setting2.png"></a>&nbsp;
									<a href="javascript:del_it('<?=$row['product_idx']?>');"><img src="/AdmMaster/_images/common/ico_error.png" alt="삭제" /></a>
								</td>
							</tr>
							<tr style="height:45px">
								<th style="background:#fafafa;border:1px solid #dddddd;padding:10px 0;font-size:14px;font-weight:bold;color:#464646;text-align:center;">
									간략일정
								</th>
								<td colspan="12" style="background:#fafafa;;text-align:left;padding-left:15px;font-weight:bold">
									<?=$row["product_schedule"]?>
								</td>
							</tr>
							<?  } ?>




							
						</tbody>
						</table>
					</div><!-- // listBottom -->
					</form>

					<?echo ipageListing($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]. $search_val ."&pg=")?>


					<div id="headerContainer">
						
						<div class="inner">
							<div class="menus">
								<ul class="first">
								</ul>

								<ul class="last">
							        <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
									<li><a href="write_honeymoon.php" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> <span class="txt">상품 등록</span></a></li>
								</ul>
								
							</div>

						</div><!-- // inner -->

					</div><!-- // headerContainer -->
				</div><!-- // listWrap -->

			</div><!-- // contents -->





		</span><!-- 인쇄 영역 끝 //-->
		</div><!-- // container -->

<script>
function check_best(idx){
	if ($("#product_best_best_"+idx).is(":checked")) {
		$("#product_best_"+idx).val('Y');
	} else {
		$("#product_best_"+idx).val('N');
		
	}
}

function check_sale(idx){
	if ($("#special_price_price_"+idx).is(":checked")) {
		$("#special_price_"+idx).val('Y');
	} else {
		$("#special_price_"+idx).val('N');
		
	}
}

function prod_update(idx)
{
			var is_view = $("#is_view_"+idx).val(); 
			var onum    = $("#onum_"+idx).val(); 

			if ($("#product_best_best_"+idx).is(":checked")) {
				var product_best = "Y";
			} else {
				var product_best = "N";
			}

			if ($("#special_price_price_"+idx).is(":checked")) {
				var special_price = "Y";
			} else {
				var special_price = "N";
			}

            if (!confirm("선택한 상품의 정보를 변경 하시겠습니까?"))
                return false;

			var message = "";
			$.ajax({

				url: "/ajax/ajax.prod_update.php",
				type: "POST",
				data: {
					"product_idx"  : idx,
					"product_best" : product_best,
					"special_price" : special_price,
					"is_view"      : is_view,
					"onum"         : onum
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function(data, textStatus) {
					message = data.message;
					alert(message);
					// location.href='/AdmMaster/_tourRegist/list_honeymoon.php?pg='+$("#pg").val();
					location.reload();
				},
				error:function(request,status,error){
					alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});
}
</script>

<script>
function go_write(idx)
{
      $("#product_idx").val(idx);
	  $("#search").attr("action", "./write_honeymoon.php").submit();   
}
</script>

<script>
function orderBy_set(seq)
{
		 $("#orderBy").val(seq);
		 search_it();
}
</script>

<script>
 function CheckAll(checkBoxes,checked){
    var i;
    if(checkBoxes.length){
        for(i=0;i<checkBoxes.length;i++){
            checkBoxes[i].checked=checked;
        }
    }else{
        checkBoxes.checked=checked;
   }

}

function SELECT_DELETE() {
		if ($(".product_idx").is(":checked") == false)
		{
			alert_("삭제할 내용을 선택하셔야 합니다.");
			return;
		}
		if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false)
		{
			return;
		}

		$("#ajax_loader").removeClass("display-none");

        $.ajax({
			url: "del.php",
			type: "POST",
			data: $("#frm").serialize(),
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
//				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				if (response == "OK")
				{
					alert_("정상적으로 삭제되었습니다.");
						location.reload();
					return;
				} else {
					alert(response);
					alert_("오류가 발생하였습니다!!");
					return;
				}
			}
        });
 
}

function del_it(product_idx) {

		if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false)
		{
			return;
		}
		$("#ajax_loader").removeClass("display-none");
        $.ajax({
			url: "del.php",
			type: "POST",
			data: "product_idx[]="+product_idx,
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
//				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				//if (response == "OK")
				//{
					alert_("정상적으로 삭제되었습니다.");
					location.reload();
					return;
				//} else {
				//	alert(response);
				//	alert_("오류가 발생하였습니다!!");
				//	return;
				//}
			}
        });
 
}

function get_code(strs, depth)
{
		$.ajax({
			type:"GET"
			, url:"get_code.ajax.php"
			, dataType : "html" //전송받을 데이터의 타입
			, timeout : 30000 //제한시간 지정
			, cache : false  //true, false
			, data : "parent_code_no="+ encodeURI(strs) +"&depth="+depth //서버에 보낼 파라메터
			,error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
			}
			, success:function(json){
				//alert(json);
				if (depth <= 3)
				{
					$("#product_code_2").find('option').each(function() {
						$(this).remove();
					});
					$("#product_code_2").append("<option value=''>2차분류</option>");
				}
				if (depth <= 4)
				{
					$("#product_code_3").find('option').each(function() {
						$(this).remove();
					});
					$("#product_code_3").append("<option value=''>3차분류</option>");
				}
				if (depth <= 4)
				{
					$("#product_code_4").find('option').each(function() {
						$(this).remove();
					});
					$("#product_code_4").append("<option value=''>4차분류</option>");
				}
				var list = $.parseJSON(json);
				var listLen = list.length;
				var contentStr = "";
				for(var i=0; i<listLen; i++)
				{
					contentStr = "";
					if (list[i].code_status == "C")
					{
						contentStr = "[마감]";
					} else if (list[i].code_status == "N") {
						contentStr = "[사용안함]";
					}
					$("#product_code_"+(parseInt(depth)-1)).append("<option value='"+list[i].code_no+"'>"+list[i].code_name+""+contentStr+"</option>");
				}
			}
		});
}
</script>


<? include "../_include/_footer.php"; ?>