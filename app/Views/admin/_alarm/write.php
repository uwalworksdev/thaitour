<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<?php
	$session = session();
?>

<script type="text/javascript">

	function send_it() {
		const formData = new FormData($('#frm')[0]);
		$.ajax({
			url: "write_ok",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: () => {
				window.location.reload();
			}
		})
	}
</script>


<div id="container"> <span id="print_this"><!-- 인쇄영역 시작 //-->

		<header id="headerContainer">
			<div class="inner">
				<h2>알림</h2>
				<div class="menus">
					<ul>
						<li><a href="/AdmMaster/_alarm/list" class="btn btn-default"><span
									class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
						<?php if ($idx != "") { ?>
							<li><a href="javascript:send_it()" class="btn btn-default"><span
										class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
							<li><a href="javascript:del_it(<?=$idx?>)" class="btn btn-default"><span
										class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a></li>
						<?php } else { ?>
							<li><a href="javascript:send_it()" class="btn btn-default"><span
										class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a></li>
						<?php } ?>

					</ul>
				</div>
			</div>
			<!-- // inner -->

		</header>
		<!-- // headerContainer -->
		<form name="frm" id="frm" class="form_contact" action="write_ok" method=post target="hiddenFrame">

			<input type=hidden name="idx" value='<?= $idx ?>'>

			<div id="contents">
				<div class="listWrap_noline">

					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" id="table_form_online_quote"
							class="listTable mem_detail">
							<caption>
							</caption>
							<colgroup>
								<col width="10%" />
								<col width="40%" />
								<col width="10%" />
								<col width="40%" />
							</colgroup>
							<tbody>
								<tr>
									<th>현황</th>
									<td>
										<select name="status" id="qna_status">
											<option value="N" <?php if ($status == "N") {
																	echo "selected";
																} ?>>문의접수</option>
											<option value="Y" <?php if ($status == "Y") {
																	echo "selected";
																} ?>>답변완료</option>
										</select>
									</td>
									<th>여행자 성함</th>
									<td>
                                        <div style="display: flex; gap: 10px;">
                                            <div class="tra_name flex">
                                                <input type="text" value="<?= $user_name ?>" name="user_name" id="user_name" style="width: 250px;"
                                                    placeholder="한글이름">
                                            </div>
                                            <!-- <div class="tra_name flex">
                                                <input type="text" value="<?= $user_id ?>" name="user_id" id="user_id" style="width: 250px;" disabled>
                                            </div> -->
                                        </div>
									</td>
								</tr>
								<!-- <tr>
									<th>정확성</th>
									<td>
										<select class="form_input_" name="accuracy" id="accuracy">
											<option value="">선택해주세요.</option>
											<option <?= $accuracy == "test1" ? "selected" : ""?> value="test1">test1</option>
											<option <?= $accuracy == "test2" ? "selected" : ""?> value="test2">test2</option>
										</select>
									</td>
									<th>신속성</th>
									<td>
										<select class="form_input_" name="speed" id="speed">
											<option value="">선택해주세요.</option>
											<option <?= $speed == "test1" ? "selected" : ""?> value="test1">test1</option>
											<option <?= $speed == "test2" ? "selected" : ""?> value="test2">test2</option>
										</select>
									</td>
								</tr> -->

								<tr>
									<th>이메일</th>
									<td>
										<div class="email flex__c">
											<input type="text" name="user_email" id="user_email"
												value="<?= $user_email ?>">
										</div>
									</td>
									<th>전화번호</th>
									<td>
										<div class="phone flex gap-1">
											<input value="<?= $user_phone ?>" type="text" id="user_phone"
												oninput="this.value = formatPhoneNumber(this.value.replace(/[^0-9]/g, ''))"
												class="s_input" name="user_phone" maxlength="13" numberonly="true">
										</div>
									</td>
								</tr>
								<tr>
									<!-- <th>여행형태</th>
									<td>
										<div class="email flex__c">
											<div class="flex__c" style="flex-wrap: wrap">
												<select name="travel_type_1" id="travel_type_1">
													<option value="">선택</option>
													<?php
														foreach ($arr_type_0 as $row0) {
													?>
														<option value="<?= $row0['code_no'] ?>"
															<?= ($row0['code_no'] == $travel_type_1 ? "selected" : "") ?>>
															<?= $row0['code_name'] ?>
														</option>
													<?php
														}
													?>
												</select>

												<select name="travel_type_2" id="travel_type_2"
													style="margin-left: 5px;<?= ((!$travel_type_3 || !$travel_type_2) ? "display: none;" : "") ?>">
													<option value="">선택</option>
													<?php
														foreach ($arr_type_1 as $row1) {
													?>
														<option value="<?= $row1['code_no'] ?>"
															<?= ($row1['code_no'] == $travel_type_2 ? "selected" : "") ?>>
															<?= $row1['code_name'] ?>
														</option>
													<?php
														}
													?>
												</select>

												<select name="travel_type_3" id="travel_type_3"
													style="margin-left: 5px;<?= (!$travel_type_3 ? "display: none;" : "") ?>">
													<option value="">선택</option>
													<?php
														foreach ($arr_type_2 as $row2) {
													?>
														<option value="<?= $row2['code_no'] ?>"
															<?= ($row2['code_no'] == $travel_type_3 ? "selected" : "") ?>>
															<?= $row2['code_name'] ?>
														</option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
									</td> -->
									<th>상담가능시간</th>
									<td colspan="3">
										<div class="phone flex gap-1">
											<input value="<?= $consultation_time ?>" type="text" id="consultation_time"
												class="s_input" name="consultation_time">
										</div>
									</td>
								</tr>
								<!-- <tr>
									<th>상품명</th>
									<td>
										<div class="depart flex__c gap-1">
											<input value="<?= $product_name ?>" type="text" id="product_name"
												class="s_input" name="product_name">
										</div>
									</td>
									<th>희망 출발일~ 귀국일</th>
									<td>
										<div class="depart flex__c gap-1" style="gap: 5px;">
											<div class="departure_date">
												<div class="flex__c gap-1" style="gap: 5px;">
													<input type="text" value="<?= $departure_date ?>"
														id="departure_date" name="departure_date"
														placeholder="0000-00-00" class="datepicker" readonly>
												</div>
											</div>
											<div>
												<span> ~ </span>
											</div>
											<div class="departure_date">
												<div class="flex__c gap-1" style="gap: 5px;"><input type="text"
														value="<?= $arrival_date ?>" id="arrival_date"
														name="arrival_date" placeholder="0000-00-00" class="datepicker"
														readonly></div>
											</div>
										</div>
									</td>
								</tr> -->
								<tr>
									<th>제목</th>
									<td colspan="3"><input style="width: 100%;" type="text" name="title" id="title"
											value="<?= $title ?>" /></td>
								</tr>
								<!-- <tr>
									<th>친절도</th>
									<td colspan="3">
										<select name="star" id="star">
											<option value="1" <?= $star == 1 ? "selected" : "" ?>>
												&#9733;
											</option>
											<option value="2" <?= $star == 2 ? "selected" : "" ?>>
												&#9733;&#9733;
											</option>
											<option value="3" <?= $star == 3 ? "selected" : "" ?>>
												&#9733;&#9733;&#9733;
											</option>
											<option value="4" <?= $star == 4 ? "selected" : "" ?>>
												&#9733;&#9733;&#9733;&#9733;
											</option>
											<option value="5" <?= $star == 5 ? "selected" : "" ?>>
												&#9733;&#9733;&#9733;&#9733;&#9733;
											</option>
										</select>
									</td>
								</tr> -->
								<tr>
									<th>내용</th>
									<td colspan="3"><textarea name="contents" id="contents"
											rows="8" style="width: 100%;"><?= $contents ?></textarea></td>
								</tr>
								<tr>
									<th>첨부파일</th>
									<td colspan="3">
										<input type="file" name="ufile1">
										<a href="<?= base_url('public/uploads/contact/' . $ufile1) ?>" download="<?= $rfile1 ?>"><?= $rfile1 ?></a>
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

							<a href="/AdmMaster/_qna/list" class="btn btn-default"><span
									class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
							<?php if ($idx == "") { ?>
								<a href="javascript:send_it()" class="btn btn-default"><span
										class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
							<?php } else { ?>
								<a href="javascript:send_it()" class="btn btn-default"><span
										class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
								<a href="javascript:del_it(<?=$idx?>)" class="btn btn-default"><span
										class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
							<?php } ?>
						</li>
					</ul>
				</div>

			</div>
			<!-- // contents -->
		</form>
		<div class="inner cmt_area">
			<form action="" id="frm" name="com_form" class="com_form">
				<input type="hidden" name="code" id="code" value="contact">
				<input type="hidden" name="r_code" id="r_code" value="contact">
				<input type="hidden" name="r_idx" id="r_idx" value="<?= $idx ?>">
				<div class="comment_box-input flex">
					<textarea class="cmt_input" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
					<button type="button" class="btn btn-point comment_btn"
						onclick="fn_comment('<?= session('member.idx') ?>')">등록</button>
				</div>
			</form>
			<div id="comment_list"></div>
		</div>
	</span><!-- 인쇄 영역 끝 //-->
</div>
<!-- // container -->
<script>
	function del_it() {
		// if(confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
		// 	hiddenFrame.location.href = "del.php?idx[]=<?= $idx ?>&mode=view";
		// }

	}
</script>
<script>
	 document.addEventListener('DOMContentLoaded', function () {
		var selected = document.querySelector('.select-selected');
		var items = document.querySelector('.select-items');
		var options = items.querySelectorAll('div');
		var star = document.querySelector('#star');

		selected.addEventListener('click', function () {
			items.classList.toggle('select-hide');
		});

		options.forEach(function (option) {
			option.addEventListener('click', function () {
				var value = this.getAttribute('data-value');
				star.value = value;
				selected.innerHTML = this.innerHTML;
				items.classList.add('select-hide');
			});
		});

		document.addEventListener('click', function (event) {
			if (!event.target.matches('.select-selected')) {
				var openDropdowns = document.querySelectorAll('.select-items');
				openDropdowns.forEach(function (dropdown) {
					dropdown.classList.add('select-hide');
				});
			}
		});
	});

	$('.tick_ch input[type="radio"]').on('change', function () {
		var idx = $(this).parent().index();
		$('.tic_form').hide();
		$('.tic_form').eq(idx).show();
	})

	$("#travel_type_1").on("change", function (event) {
		$.ajax({
			url: "/ajax/get_travel_types",
			type: "POST",
			data: {
				code: event.target.value,
				depth: 3
			},
			dataType: "json",
			success: function (res) {
				if (res.cnt == 0) {
					$("#travel_type_2").hide().html("");
					$("#travel_type_3").hide().html("");
				} else {
					$("#travel_type_2").show().html(res.data);
					$("#travel_type_3").show()
				}
			}
		})
	})


	$("#travel_type_2").on("change", function (event) {
		$.ajax({
			url: "/ajax/get_travel_types",
			type: "POST",
			data: {
				code: event.target.value,
				depth: 4
			},
			dataType: "json",
			success: function (res) {
				if (res.cnt == 0) {
					$("#travel_type_3").hide().html("");
				} else {
					$("#travel_type_3").show().html(res.data)
				}
			}
		})
	})

	function formatPhoneNumber(input) {
		const numericString = input.replace(/\D/g, '');
		if (numericString.length >= 8) {
			const a = numericString.substring(0, 3);
			const b = numericString.substring(3, 7);
			const c = numericString.substring(7);
			return `${a}-${b}-${c}`;
		} else if (numericString.length >= 4) {
			const a = numericString.substring(0, 3);
			const b = numericString.substring(3);
			return `${a}-${b}`;
		} else {
			return input;
		}
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
	const r_code = "contact";
	const r_idx = "<?= $idx ?>";
	const role = "admin";
</script>
<script src="/js/comment.js"></script>
<?= $this->endSection() ?>