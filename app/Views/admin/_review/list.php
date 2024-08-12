<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<div id="container">
	<span id="print_this"><!-- 인쇄영역 시작 //-->

		<header id="headerContainer">

			<div class="inner">
				<h2>여행후기 관리</h2>
				<div class="menus">
					<ul class="first">
						<li><a href="javascript:change_it()" class="btn btn-primary">순위변경</a></li>
						<li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)" class="btn btn-success">전체선택</a></li>
						<li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)" class="btn btn-success">선택해체</a></li>
						<li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
						<li><a href="write" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a></li>
					</ul>

					<ul class="last">
					</ul>

				</div>

			</div><!-- // inner -->

		</header><!-- // headerContainer -->

		<div id="contents">
			<form name="search" id="search">
				<input type="hidden" name="gubun" value="<?= isset($gubun) ? $gubun : '' ?>">
				<header id="headerContents">
               
				<select id="search_gubun" name="search_gubun" class="input_select" style="width:112px">
						<option value="" <?php if ($search_gubun == "") {
													echo "selected";
												} ?>>전체</option>
						<option value="is_best" <?php if ($search_gubun == "is_best") {
														echo "selected";
													} ?>>베스트</option>
						<option value="display" <?php if ($search_gubun == "display") {
														echo "selected";
													} ?>>메인노출</option>
					</select>

					<select id="" name="search_category" class="input_select" style="width:112px">
						<option value="title" <?php if ($search_category == "title") {
													echo "selected";
												} ?>>제목</option>
						<option value="user_name" <?php if ($search_category == "user_name") {
														echo "selected";
													} ?>>국문이름</option>
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
				div.listBottom table.listTable tbody td:nth-child(5) {
					text-align: left !important;
					padding-left: 10px;
					max-width: 500px;
					word-wrap: break-word;
					padding-right: 10px;
				}

				div.listBottom table.listTable tbody td:nth-child(5) a {
					display: -webkit-box;
					-webkit-line-clamp: 1;
					overflow: hidden;
					text-overflow: ellipsis;
					-webkit-box-orient: vertical;
				}
			</style>
			<div class="listWrap">
				<!-- 안내 문구 필요시 구성 //-->
				<div class="listTop">
					<div class="left">
						<p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
					</div>

				</div><!-- // listTop -->
				<form name="frm" id="frm">
					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" class="listTable">
							<caption></caption>
							<colgroup>
								<col width="5%" />
								<col width="5%" />
								<col width="25%" />
								<col width="10%" />
								<col width="15%" />
								<col width="12%" />
								<col width="12%" />
								<col width="5%" />
								<col width="5%" />
								<col width="15%" />
							</colgroup>
							<thead>
								<tr>
									<th>선택</th>
									<th>순위</th>
									<th>제목</th>
									<th>이름</th>
									<th>이메일</th>
									<th>게시날짜</th>
									<th>노출여부</th>
									<th>베스트</th>
									<th>메인노출</th>
									<th>관리</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($nTotalCount == 0) {
								?>
									<tr>
										<td colspan=9 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
									</tr>
								<?php
								}
								foreach($review_list as $row) {
									$statusStr = "";
									// if ($row["status"] == "Y")
									// {
									// 	$statusStr = "상담완료";
									// } elseif ($row["status"] == "C") {
									// 	$statusStr = "상담취소";
									// } elseif ($row["status"] == "W") {
									// 	$statusStr = "문의접수";
									// }

									if ($row["status"] == "Y") {
										$statusStr = "노출";
									} elseif ($row["status"] == "N") {
										$statusStr = "노출해제";
									}


								?>
									<tr style="height:50px;">
										<input type="hidden" name="idx_change[]" value="<?= $row['idx'] ?>">
										<td><input type="checkbox" name="idx[]" class="idx" value="<?= $row['idx'] ?>" class="input_check" /></a></td>
										<td><input type="text" name="onum[]" value="<?= $row['onum'] ?>" style="max-width: 50px;text-align: center;padding: 3px;"></td>
									
										<td class="tac"><a href="detail?idx=<?= $row['idx'] ?>"><?= $row['title'] ?></a></td>
										<td class="tac"><?= sqlSecretConver($row["user_name"], 'decode') ?></td>
										<td class="tac"><?= sqlSecretConver($row["user_email"], 'decode') ?></td>
										<td class="tac"><?= $row["r_date"] ?></td>
										<td class="tac"><?= $statusStr ?></td>
										<td>
											<input type="checkbox" <?php if($row['is_best'] == "Y") echo "checked";?> class="input_check">
											<input hidden type="text" name="is_best[]" value= <?=$row['is_best'] == "Y" ?  "Y" :"N" ?> >
									</td>
										<!-- <td>
											<input type="checkbox" <?php if($row['display'] == "Y") echo "checked";?> class="input_check">
											<input hidden type="text" name="display[]" value= <?=$row['display'] == "Y" ?  "Y" :"N" ?> >
										</td> -->
										<td>
											<input type="checkbox" <?php if($row['display'] == "Y") echo "checked";?> class="input_check">
											<input hidden type="text" name="display[]" value= <?=$row['display'] == "Y" ?  "Y" :"N" ?> >
										</td>
										<td>
											<a href="write?idx=<?= $row['idx'] ?>"><img src="/images/admin/common/ico_setting2.png"></a>
											<a href="javascript:del_it('<?= $row['idx'] ?>');"><img src="/images/admin/common/ico_error.png" alt="삭제" /></a>
										</td>
									</tr>
								<?php  } ?>





							</tbody>
						</table>
					</div><!-- // listBottom -->
				</form>

				<?php echo ipageListing($pg, $nPage, $g_list_rows, $currentUri . "?&search_gubun=$search_gubun&search_category=$search_category&s_txt=$s_txt&pg=") ?>


				<div id="headerContainer">

					<div class="inner">
						<div class="menus">
							<ul class="first">
								<li><a href="javascript:change_it()" class="btn btn-primary">순위변경</a></li>
								<li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)" class="btn btn-success">전체선택</a></li>
								<li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)" class="btn btn-success">선택해체</a></li>
								<li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
							</ul>

							<ul class="last">
							</ul>

						</div>

					</div><!-- // inner -->

				</div><!-- // headerContainer -->
			</div><!-- // listWrap -->

		</div><!-- // contents -->





	</span><!-- 인쇄 영역 끝 //-->
</div><!-- // container -->


<script>
  $(".input_check").change(function(evt){
	if ($(evt.target).is(":checked")) {
		$(evt.target).siblings("input[type=text]").val("Y");
	}else {
		$(evt.target).siblings("input[type=text]").val("N");
	}
  })

</script>


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
			alert_("삭제할 내용을 선택하셔야 합니다.");
			return;
		}
		if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
			return;
		}

		$("#ajax_loader").removeClass("display-none");

		$.ajax({
			url: "del",
			type: "POST",
			data: $("#frm").serialize(),
			error: function(request, status, error) {
				//통신 에러 발생시 처리
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			},
			complete: function(request, status, error) {
				//				$("#ajax_loader").addClass("display-none");
			},
			success: function(response, status, request) {
				if (response == "OK") {
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

	function del_it(idx) {

		if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
			return;
		}
		var message = "";
		$.ajax({

			url: "./ajax_del",
			type: "POST",
			data: {
				"idx": idx
			},
			dataType: "json",
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

	function change_it() {
		$("#ajax_loader").removeClass("display-none");
		$.ajax({
			url: "./change_ajax",
			type: "POST",
			data: $("#frm").serialize(),
			dataType: "json",
			async: false,
			cache: false,
			complete: function(request, status, error) {
				$("#ajax_loader").addClass("display-none");
			},
			success: function(data, textStatus) {
				message = data.message;
				alert(message);
				location.reload();
			}
		})
	}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('search_gubun').addEventListener('change', function() {
        document.getElementById('search').submit();
    });
});
</script>

<?= $this->endSection() ?>