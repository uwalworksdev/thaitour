<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
<?php
	// $code_idx				= updateSQ($_GET["code_idx"]);
	// $s_parent_code_no		= updateSQ($_GET["s_parent_code_no"]);
	// $product_idx			= updateSQ($_GET["product_idx"]);
	// $yoil_idx				= updateSQ($_GET["yoil_idx"]);

	// $sql_ds					= " select * from tbl_product_air ";
	// $result_ds					= mysqli_query($connect, $sql_ds) or die (mysqli_error($connect));
	// $row_ds					= mysqli_fetch_array($result_ds);

	// $titleStr = "생성";
	// if ($s_parent_code_no == "")
	// {
	// 	$parent_code_no = "0";
	// } else {
	// 	$parent_code_no = $s_parent_code_no;
	// }
	// if ($code_idx) {
	// 	$total_sql			= " select * from tbl_code where code_idx='".$code_idx."'";
	// 	$result				= mysqli_query($connect, $total_sql) or die (mysqli_error($connect));
	// 	$row				= mysqli_fetch_array($result);
	// 	$code_no			= $row["code_no"];
	// 	$code_name			= $row["code_name"];	
	// 	$init_oil_price		= $row["init_oil_price"];	
	// 	$ufile1			    = $row["ufile1"];	
	// 	$rfile1			    = $row["rfile1"];	
	// 	$status				= $row["status"];	
	// 	$onum				= $row["onum"];	
	// 	$titleStr = "수정";

	// 	$sql_c			    = " select count(*) as cnt from tbl_code where parent_code_no ='".$row['code_no']."'";
	// 	$result_c			= mysqli_query($connect, $sql_c) or die (mysqli_error($connect));
	// 	$row_c				= mysqli_fetch_array($result_c);
	// 	$depth              = $row_c['cnt'];


	// } else {
	// 	$total_sql			= "select * from tbl_code where code_no='".$parent_code_no."'";
	// 	$result				= mysqli_query($connect, $total_sql) or die (mysqli_error($connect));
	// 	$row				= mysqli_fetch_array($result);
	// 	$depth				= $row["depth"]+1;
	// 	$code_gubun			= $row["code_gubun"];


	// 	$total_sql			= " select ifnull(max(code_no),'".$s_parent_code_no."00')+1 as code_no from tbl_code where parent_code_no='".$parent_code_no."'";
	// 	//echo $total_sql;
	// 	$result				= mysqli_query($connect, $total_sql) or die (mysqli_error($connect));
	// 	$row				= mysqli_fetch_array($result);
	// 	$code_no			= $row["code_no"];

		
	// 	if($code_no == "1308"){	// 예약된 코드(현지투어)로 사용할 수 없습니다.
	// 		$total_sql			= " select ifnull(max(code_no),'".$s_parent_code_no."00')+2 as code_no from tbl_code where parent_code_no='".$parent_code_no."'";
	// 		//echo $total_sql;
	// 		$result				= mysqli_query($connect, $total_sql) or die (mysqli_error($connect));
	// 		$row				= mysqli_fetch_array($result);
	// 		$code_no			= $row["code_no"];
	// 	}


	// 	$onum				= 0;



	// }
?>
<script type="text/javascript">
function checkForNumber(str) {
	var key = event.keyCode;
	var frm = document.frm1;
	if(!(key==8||key==9||key==13||key==46||key==144||
	(key>=48&&key<=57)||(key>=96&&key<=105)||key==110||key==190)) {
		event.returnValue = false;
	}
}
	function send_it()
	{
		var frm = document.frm;
		if (frm.code_name.value == "")
		{
			frm.code_name.focus();
			alert("코드명을 입력하셔야 합니다.");
			return;
		}

		frm.submit();
	}
</script>


<div id="container"> <span id="print_this"><!-- 인쇄영역 시작 //-->
	
	<header id="headerContainer">
		<div class="inner">
			<h2>코드 <?=$titleStr?><?=$parent_code_no?></h2>
			<div class="menus">
				<ul >
					<li><a href="javascript:history.back();" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
					<?php if ($code_idx) { ?>
					<li><a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
						<?php if($depth == 0) { ?> 
						<li><a href="javascript:del_it('<?=$code_idx?>')" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a></li>
						<?php } ?>
					<?php } else { ?>
					<li><a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a></li>
					<?php } ?>
					
				</ul>
			</div>
		</div>
		<!-- // inner --> 
		
	</header>
	<!-- // headerContainer -->
	
	<form name=frm action="write_ok"  method=post enctype="multipart/form-data"  target="hiddenFrame" >
	<input type=hidden name="code_idx" value='<?=$code_idx?>'> 
	<input type=hidden name="code_no" value='<?=$code_no?>'> 
	<input type=hidden name="depth" value='<?=$depth?>'> 
	<input type=hidden name="parent_code_no" value='<?=$parent_code_no?>'> 
	<input type=hidden name="product_idx" value='<?=$product_idx?>'> 
	<input type=hidden name="yoil_idx" value='<?=$yoil_idx?>'> 
	<div id="contents">
		<div class="listWrap_noline">
			<div class="listBottom">
				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
					<caption>
					</caption>
					<colgroup>
					<col width="10%" />
					<col width="90%" />
					</colgroup>
					<tbody>
						
						<tr height=45>
							<th>코드NO</th>
							<td>
								<?=$code_no?>
							</td>
						</tr>
						<?php if ($parent_code_no == "0" && $code_idx == "" ) { ?>
						<tr height=45>
							<th>코드구분</th>
							<td>
								<input type="text" id="code_gubun" name="code_gubun" value="<?=$code_gubun?>" class="input_txt" style="width:100px;ime-mode:disabled" /> (영문으로만)
							</td>
						</tr>
						<?php } else { ?>
							<input type="hidden" id="code_gubun" name="code_gubun" value="<?=$code_gubun?>" class="input_txt" style="width:100px;ime-mode:disabled" />
						<?php } ?>
						<tr height=45>
							<th>코드명</th>
							<td>
								<input type="text" id="code_name" name="code_name" value="<?=$code_name?>" class="input_txt" style="width:90%" />
							</td>
						</tr>
						<tr height=45>
							<th>이미지</th>
							<td>
								<input type="file" id="ufile1" name="ufile1" class="input_txt" style="width:20%" />
								
								<?php if($ufile1 && $rfile1) { ?>
								<img src="/data/code/<?=$ufile1?>">
                                <input type="checkbox" name="del_1" value="Y">
								<a href="/data/code/<?=$ufile1?>" class="imgpop cboxElement"><?=$rfile1?></a>
								<?php } ?>

							</td>
						</tr>
						<?php
						if ($parent_code_no == 14) {
							?>
							<tr height=45>
								<th>유류할증료</th>
								<td>
									<input type="text" id="init_oil_price" name="init_oil_price" value="<?=$init_oil_price?>" class="input_txt" style="width:100px" numberOnly=true/>
								</td>
							</tr>
							<?php
						}
						?>
						<tr height=45>
							<th>현황</th>
							<td>
								<input type="radio" name="status" value="Y" <?php if ($status == "Y" || $status == "") {echo "checked"; } ?>> 사용&nbsp;&nbsp;&nbsp;
								<input type="radio" name="status" value="C" <?php if ($status == "C") {echo "checked"; } ?>> 마감&nbsp;&nbsp;&nbsp;
								<!--input type="radio" name="status" value="N" <?php if ($status == "N") {echo "checked"; } ?>> 삭제-->
							</td>
						</tr>
						
						<tr height=45>
							<th>우선순위</th>
							<td>
								<input type="text" id="onum" name="onum" value="<?=$onum?>" class="input_txt" style="width:100px" /> (숫자가 높을수록 상위에 노출됩니다.)
							</td>
						</tr>
					</tbody>
					
				</table>
			</div>
			<!-- // listBottom --> 




				<div class="tail_menu">
					<ul>
						<li class="left"></li>
						<li class="right_sub">

							<a href="javascript:history.back();" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
							<?php if ($code_idx == "") { ?>	
							<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
							<?php } else { ?>
							<a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
								<?php if($depth == 0) { ?> 
								<a href="javascript:del_it('<?=$code_idx?>')" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
								<?php } ?>
							<?php } ?>
						</li>
					</ul>
				</div>





			
		</div>
		<!-- // listWrap --> 
		
	</div>
	<!-- // contents --> 
	</form>
	</span><!-- 인쇄 영역 끝 //--> 
</div>
<!-- // container --> 
<script>
function del_it(idx) {

			if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
				return false;

			var message = "";
			$.ajax({

				url: "del",
				type: "POST",
				data: {
					"code_idx" : idx
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function(data, textStatus) {
					message = data.message;
					alert(message);
					location.href='/AdmMaster/_code/list';
				},
				error:function(request,status,error){
					alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});
		 
}
</script> 
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>

