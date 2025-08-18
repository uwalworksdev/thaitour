<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<div id="container">
	<span id="print_this"><!-- 인쇄영역 시작 //-->

		<header id="headerContainer">

			<div class="inner">
				<h2>1:1 여행상담</h2>
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
						<option value="user_name" <?php if ($search_category == "user_name") {
														echo "selected";
													} ?>>국문이름</option>
						<option value="user_phone" <?php if ($search_category == "user_phone") {
														echo "selected";
													} ?>>핸드폰</option>
						<option value="user_email" <?php if ($search_category == "user_email") {
														echo "selected";
													} ?>>이메일</option>
					</select>


					<input type="text" id="" name="s_txt" value="<?= $s_txt ?>" class="input_txt placeHolder" rel="검색어 입력" style="width:240px" />

					<a href="javascript:search_it()" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
				</header><!-- // headerContents -->
			</form>
			<script>
				function search_it() {
					var frm = document.search;
					if (frm.s_txt.value == "검색어 입력") {
						frm.s_txt.value = "";
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
				<!-- <div class="listTop">
					<div class="left">
						<p class="schTxt">■ 총 <?= $total_cnt ?>개의 목록이 있습니다.</p>
					</div>

				</div> -->
				<form name="frm" id="frm" method="GET">
					<div class="listTop" style="display: flex; justify-content: space-between; align-items: center;">
						<div class="left">
							<p class="schTxt">■ 총 <?= $total_cnt ?>개의 목록이 있습니다.</p>
						</div>

						<div class="right">
							<select id="scale" name="scale" class="input_select" style="width: 80px" onchange="submitForm();">
								<option value="10" <?= ($scale == 10) ? 'selected' : '' ?>>10개</option>
								<option value="50" <?= ($scale == 50) ? 'selected' : '' ?>>50개</option>
								<option value="100" <?= ($scale == 100) ? 'selected' : '' ?>>100개</option>
								<option value="200" <?= ($scale == 200) ? 'selected' : '' ?>>200개</option>
							</select>
						</div>

					</div>
					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" class="listTable">
							<caption></caption>
							<colgroup>
								<col width="4%" />
								<col width="4%" />
								<col width="34%" />
								<col width="9%" />
								<col width="9%" />
								<col width="7%" />
								<col width="7%" />
								<col width="9%" />
							</colgroup>
							<thead>
								<tr>
									<th>선택</th>
									<th>번호</th>
									<th>제목</th>
									<th>이메일</th>
									<th>신청일시</th>
                                    <th>ip</th>
                                    <th>진행상태</th>
									<th>관리</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$now = strtotime(date("Y-m-d H:i:s"));

									if ($total_cnt == 0) {
								?>
									<tr>
										<td colspan=10 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
									</tr>
								<?php
									}
									foreach($list_qna as $row) {
										$time = strtotime($row['r_date']);
										$diff_time = $now - $time;
										$is_new = $diff_time < (24 * 60 * 60) ? "<i class='new_ic'></i>" : "";
										$r_date = $row['r_date'];

										$statusStr = "";
										if ($row["status"] == "Y") {
											$statusStr = "답변완료";
										} else {
											$statusStr = "문의접수";
										}

										if($row['isViewQna'] == 'N'){ 
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
											<span style="margin-left: 10px"><img src="/images/btn/icon_comm.gif" alt=""> </span>
											<span class="red">(<?= $row['cmt_cnt'] ?>)</span><?= $is_new ?>
										</td>
										<td class="tac"><?= sqlSecretConver($row["user_email"], 'decode') ?></td>
										<td class="tac"><?= $row["r_date"] ?></td>
										<td class="tac"><?= $row["user_ip"] ?></td>
										<td class="tac"><?= $statusStr ?></td>
										<td>
                                            <div class="flex_button">
                                                <button onclick="window.location.href='write?idx=<?= $row["idx"] ?>'"
                                                        type="button" class="btn_default btn btn-primary">
                                                    수정
                                                </button>
                                                <button onclick="del_it('<?= $row["idx"] ?>');" type="button"
                                                        class="btn_default btn btn-danger">
                                                    삭제
                                                </button>
                                            </div>
										</td>
									</tr>
								<?php  } ?>

							</tbody>
						</table>
					</div><!-- // listBottom -->
				</form>

				<?php echo ipageListing($pg, $nPage, $scale, current_url() . "?search_category=$search_category&s_txt=$s_txt&scale=$scale&pg=") ?>

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
	function submitForm() {
		document.getElementById("frm").submit();
	}
</script>
<?= $this->endSection() ?>