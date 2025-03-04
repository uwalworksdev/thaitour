<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<style>
    .btn_fil {
        border: 1px solid #000000;
        font-weight: 500;
    }

    .btn_fil.active {
        background-color: #000000;
        color: #fff;
    }
</style>
<div id="container">
	<span id="print_this"><!-- 인쇄영역 시작 //-->

		<header id="headerContainer">

			<div class="inner">
				<h2>상품 Q&A</h2>
				<div class="menus">
					<ul class="first">
						<li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)" class="btn btn-success">전체선택</a></li>
						<li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)" class="btn btn-success">선택해체</a></li>
						<li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
					</ul>

					<ul class="last">
					</ul>

				</div>

			</div><!-- // inner -->

		</header><!-- // headerContainer -->

		<div id="contents">
			<form name="search" id="search">
				<input type="hidden" name="gubun" value="<?= $gubun ?? ""?>">
				<header id="headerContents">
					<select id="" name="search_category" class="input_select" style="width:112px">
						<option value="title" <?php if ($search_category == "title") {
													echo "selected";
												} ?>>제목</option>
						<option value="product_code" <?php if ($search_category == "product_code") {
														echo "selected";
													} ?>>상품코드</option>
						<option value="product_name" <?php if ($search_category == "product_name") {
														echo "selected";
													} ?>>제품명</option>
					</select>


					<input type="text" id="" name="search_txt" value="<?= $search_txt ?>" class="input_txt placeHolder" rel="검색어 입력" style="width:240px" />

					<a href="javascript:search_it()" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
				</header><!-- // headerContents -->
			</form>
			<script>
				function search_it() {
					var frm = document.search;
					if (frm.search_txt.value == "검색어 입력") {
						frm.search_txt.value = "";
					}
					frm.submit();
				}
			</script>
			<style>
				div.listBottom table.listTable tbody td:nth-child(3) {
					text-align: left !important;
					padding-left: 10px;
					max-width: 300px;
					word-wrap: break-word;
					padding-right: 10px;
				}

				div.listBottom table.listTable tbody td:nth-child(3) .new_ic {
					display: inline-block;
					width: 10px;
					height: 9px;
					margin: -1px 5px;
					background: no-repeat center;
					background-image: url("/images/btn/icon_new.gif");
				}

				div.listBottom table.listTable tbody td:nth-child(5) a {
					display: -webkit-box;
					-webkit-line-clamp: 1;
					overflow: hidden;
					text-overflow: ellipsis;
					-webkit-box-orient: vertical;
				}

				div.listBottom table.listTable tbody td.tac a {
					text-overflow: ellipsis;
					white-space: nowrap;
					overflow: hidden;
					max-width: 640px;
					display: inline-flex;
				}
			</style>
			<div class="listWrap">
				<!-- 안내 문구 필요시 구성 //-->
				<!-- // listTop -->
				<form name="frm" id="frm" method="GET">
					<div class="listTop" style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
						<div class="left">
							<div class="filter_product flex" style="gap: 10px;">
								<a href="/AdmMaster/_product_qna/list?gubun=hotel&search_category<?=$search_category?>=&search_txt=<?=$search_txt?>&pg=<?=$pg?>" 
									class="btn btn_fil <?php if($gubun == "hotel"){ echo "active"; }?>">호텔</a>
								<a href="/AdmMaster/_product_qna/list?gubun=golf&search_category<?=$search_category?>=&search_txt=<?=$search_txt?>&pg=<?=$pg?>" 
									class="btn btn_fil <?php if($gubun == "golf"){ echo "active"; }?>">골프</a>
								<a href="/AdmMaster/_product_qna/list?gubun=tour&search_category<?=$search_category?>=&search_txt=<?=$search_txt?>&pg=<?=$pg?>" 
									class="btn btn_fil <?php if($gubun == "tour"){ echo "active"; }?>">투어</a>
								<a href="/AdmMaster/_product_qna/list?gubun=spa&search_category<?=$search_category?>=&search_txt=<?=$search_txt?>&pg=<?=$pg?>" 
									class="btn btn_fil <?php if($gubun == "spa"){ echo "active"; }?>">스파</a>
								<a href="/AdmMaster/_product_qna/list?gubun=ticket&search_category<?=$search_category?>=&search_txt=<?=$search_txt?>&pg=<?=$pg?>" 
									class="btn btn_fil <?php if($gubun == "ticket"){ echo "active"; }?>">쇼ㆍ입장권</a>
								<a href="/AdmMaster/_product_qna/list?gubun=restaurant&search_category<?=$search_category?>=&search_txt=<?=$search_txt?>&pg=<?=$pg?>" 
									class="btn btn_fil <?php if($gubun == "restaurant"){ echo "active"; }?>">레스토랑</a>
								<a href="/AdmMaster/_product_qna/list?gubun=guide&search_category<?=$search_category?>=&search_txt=<?=$search_txt?>&pg=<?=$pg?>" 
									class="btn btn_fil <?php if($gubun == "guide"){ echo "active"; }?>">가이드</a>
							</div>
							<p class="schTxt" style="margin-top: 15px;">■ 총 <?= $total_cnt ?>개의 목록이 있습니다.</p>
						</div>
						<div class="right">
							<select id="g_list_rows" name="g_list_rows" class="input_select" style="width: 80px" onchange="updateListRows();">
								<option value="30" <?= ($g_list_rows == 30) ? 'selected' : '' ?>>30개</option>
								<option value="50" <?= ($g_list_rows == 50) ? 'selected' : '' ?>>50개</option>
								<option value="100" <?= ($g_list_rows == 100) ? 'selected' : '' ?>>100개</option>
								<option value="200" <?= ($g_list_rows == 200) ? 'selected' : '' ?>>200개</option>
							</select>
						</div>

					</div>
					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" class="listTable">
							<caption></caption>
							<colgroup>
								<col width="4%" />
								<col width="4%" />
								<col width="*%" />
								<col width="25%" />
								<col width="10%" />
								<col width="15%" />
								<col width="7%" />
							</colgroup>
							<thead>
								<tr>
									<th>선택</th>
									<th>번호</th>
									<th>제목</th>
									<th>제품명</th>
                                    <th>등록일</th>
                                    <th>IP</th>
									<th>관리</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if ($total_cnt == 0) {
								?>
									<tr>
										<td colspan="7" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
									</tr>
								<?php
									}
									foreach($list_qna as $row) {

										if($row['is_view'] == 'N'){ 
											$color = "#FED4D6"; 
										}else{
											$color = "#fff"; 
										}

								?>
									<tr style="height:50px; background-color: <?=$color?>;">
										<td><input type="checkbox" name="idx[]" class="idx" value="<?= $row["idx"] ?>" class="input_check" /></a></td>
										<td><?= $num-- ?></td>
										<td class="tac">
											<a href="write?idx=<?= $row["idx"] ?>"><p><?= $row['title'] ?></p></a>
										</td>
										<td class="tac"><?= $row['product_name'] ?></td>
										<td class="tac"><?= $row["r_date"] ?></td>
										<td class="tac"><?= $row["user_ip"] ?></td>
										<td>
											<a href="write?idx=<?= $row["idx"] ?>"><img src="/images/admin/common/ico_setting2.png"></a>
											<a href="javascript:del_it('<?= $row["idx"] ?>');"><img src="/images/admin/common/ico_error.png" alt="삭제" /></a>
										</td>
									</tr>
								<?php  } ?>

							</tbody>
						</table>
					</div><!-- // listBottom -->
				</form>

				<?php echo ipageListing($pg, $nPage, $g_list_rows, current_url() . "?search_category=$search_category&search_txt=$search_txt&pg=") ?>

				<div id="headerContainer">

					<div class="inner">
						<div class="menus">
							<ul class="first">
								<li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)" class="btn btn-success">전체선택</a></li>
								<li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)" class="btn btn-success">선택해체</a></li>
								<li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
							</ul>

						</div>

					</div><!-- // inner -->

				</div><!-- // headerContainer -->
			</div><!-- // listWrap -->

		</div><!-- // contents -->

	</span><!-- 인쇄 영역 끝 //-->
</div><!-- // container -->

<script>
	function CheckAll(checkBoxes, checked) {
		var i;
		if (checkBoxes.length) {
			for (i = 0; i < checkBoxes.length; i++) {
				checkBoxes[i].checked = checked;
			}
		} else {
			checkBoxes.checked = checked;
		}

	}

	function SELECT_DELETE() {
		if ($(".idx").is(":checked") == false) {
			alert("삭제할 내용을 선택하셔야 합니다.");
			return;
		}
		if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
			return;
		}

		$.ajax({
			url: "delete",
			type: "POST",
			data: $("#frm").serialize(),
			async: false,
			cache: false,
			error: function(request, status, error) {
				alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
			},
			success: function(data, status, request) {
				message = data.message;
				alert(message);
				location.reload();
			}
		});

	}

	function del_it(idx) {

		if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
			return;
		}
		var message = "";
		$.ajax({

			url: "delete",
			type: "POST",
			data: "idx[]=" + idx,
			async: false,
			cache: false,
			success: function(data, textStatus) {
				message = data.message;
				alert(message);
				location.reload();
			},
			error: function(request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});

	}
</script>
<script>
	function updateListRows() {
		let selectedValue = document.getElementById("g_list_rows").value;
		let params = new URLSearchParams(window.location.search);

		params.set("g_list_rows", selectedValue);

		window.location.search = params.toString();
	}
</script>

<?= $this->endSection() ?>