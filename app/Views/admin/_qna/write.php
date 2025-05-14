<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<?php
$session = session();
?>
<script>
	$(function() {
		$.datepicker.regional['ko'] = {
			showButtonPanel: true,
			beforeShow: function(input) {
				setTimeout(function() {
					var buttonPane = $(input)
						.datepicker("widget")
						.find(".ui-datepicker-buttonpane");
					var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
					btn.unbind("click").bind("click", function() {
						$.datepicker._clearDate(input);
					});
					btn.appendTo(buttonPane);
				}, 1);
			},
			closeText: '닫기',
			prevText: '이전',
			nextText: '다음',
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
			dayNames: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			weekHeader: 'Wk',
			dateFormat: 'yy-mm-dd',
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: true,
			changeMonth: true,
			changeYear: true,
			showMonthAfterYear: true,
			closeText: '닫기', // 닫기 버튼 패널
			yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['ko']);

		$(".datepicker").datepicker({
			showButtonPanel: true,
			beforeShow: function(input) {
				setTimeout(function() {
					var buttonPane = $(input)
						.datepicker("widget")
						.find(".ui-datepicker-buttonpane");
					var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
					btn.unbind("click").bind("click", function() {
						$.datepicker._clearDate(input);
					});
					btn.appendTo(buttonPane);
				}, 1);
			},
			dateFormat: 'yy-mm-dd',
			showOn: "both",
			yearRange: "c-100:c+10",
			buttonImage: "/images/ico/date_ico.png",
			buttonImageOnly: true,
			closeText: '닫기',
			prevText: '이전',
			nextText: '다음'
			// ,minDate: 1

		});
		$('img.ui-datepicker-trigger').css({
			'cursor': 'pointer'
		});
		$('input.hasDatepicker').css({
			'cursor': 'pointer'
		});
	});
</script>

<script type="text/javascript">
	function checkForNumber(str) {
		var key = event.keyCode;
		var frm = document.frm1;
		if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
				(key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
			event.returnValue = false;
		}
	}

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


<div id="container">
	<span id="print_this"><!-- 인쇄영역 시작 //-->

		<header id="headerContainer">
			<div class="inner">
				<h2>1:1 여행상담</h2>
				<div class="menus">
					<ul>
						<li><a href="/AdmMaster/_qna/list" class="btn btn-default"><span
									class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
						<?php if ($idx != "") { ?>
							<li><a href="javascript:send_it()" class="btn btn-default"><span
										class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
							<li><a href="javascript:del_it(<?= $idx ?>)" class="btn btn-default"><span
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
		<form name=frm id="frm" action="write_ok" method=post target="hiddenFrame">

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
										<select name="status">
											<option value="N" <?php if ($status == "N") {
																	echo "selected";
																} ?>>문의접수</option>
											<option value="Y" <?php if ($status == "Y") {
																	echo "selected";
																} ?>>답변완료</option>
										</select>
									</td>
									<th>이메일</th>
									<td>
										<div class="email flex__c">
											<input type="text" name="user_email" id="user_email"
												value="<?= $user_email ?>">
										</div>
									</td>

								</tr>
								<tr>
									<th>여행자 성함</th>
									<td>
										<div class="tra_name flex">
											<input type="text" value="<?= $user_name ?>" name="user_name" id="user_name"
												placeholder="한글이름">
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
									<th>여행형태</th>
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
									</td>
									<th>상담가능시간</th>
									<td>
										<div class="phone flex gap-1">
											<input value="<?= $consultation_time ?>" type="text" id="consultation_time"
												class="s_input" name="consultation_time">
										</div>
									</td>
								</tr>
								<tr>
									<th>상품명</th>
									<td>
										<!-- <div class="depart flex__c gap-1">
											<input value="<?= $product_name ?>" type="text" id="product_name"
												class="s_input" name="product_name">
										</div> -->

										 <?php
											if(!empty($idx)){
										?>
											<select name="product_name" id="product_name" class="bs-select mx-sm">
												<option value="">선택</option>
												<?php
													foreach($products as $product){
												?>
													<option value="<?=$product["product_name"]?>" 
														<?php if($product["product_name"] == $product_name){ echo "selected"; }?>>
														<?=$product["product_name"]?>
													</option>
												<?php 
													}
												?>
											</select>
										<?php 
											}else{
										?>
											<select name="product_name" id="product_name" class="bs-select mx-sm">
												<option value="">선택</option>
											</select>
										<?php 
											}
										?>
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
								</tr>
								<tr>
									<th>제목</th>
									<td colspan="3"><input style="width: 100%;" type="text" name="title" id="title"
											value="<?= $title ?>" /></td>
								</tr>
								<tr>
									<th>내용</th>
									<td colspan="3"><textarea name="contents" id="contents"
											rows="8" style="width: 100%;"><?= $contents ?></textarea></td>
								</tr>
								<tr>
									<th>첨부파일</th>
									<td colspan="3">
										<input type="file" name="ufile1">
										<a href="<?= base_url('public/uploads/qna/' . $ufile1) ?>" download="<?= $rfile1 ?>"><?= $rfile1 ?></a>
									</td>
								</tr>
								<tr>
									<th>답변여부를 메일로 받으시겠습니까?</th>
									<td colspan="3">
										<input type="radio" id="yes" name="email_yn" value="Y" <?= ($email_yn == "Y" ? "checked" : "") ?>>
										<label class="form_label_" for="yes">예</label>
										<input type="radio" id="no" name="email_yn" value="N" <?= ($email_yn == "N" ? "checked" : "") ?>>
										<label class="form_label_" for="no">아니오</label>
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
								<a href="javascript:del_it(<?= $idx ?>)" class="btn btn-default"><span
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
				<input type="hidden" name="code" id="code" value="qna">
				<input type="hidden" name="r_code" id="r_code" value="qna">
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
	$('.tick_ch input[type="radio"]').on('change', function() {
		var idx = $(this).parent().index();
		$('.tic_form').hide();
		$('.tic_form').eq(idx).show();
	})

	$("#travel_type_1").on("change", function(event) {
		$.ajax({
			url: "/ajax/get_travel_types",
			type: "POST",
			data: {
				code: event.target.value,
				depth: 3
			},
			dataType: "json",
			success: function(res) {
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


	$("#travel_type_2").on("change", function(event) {
		$.ajax({
			url: "/ajax/get_travel_types",
			type: "POST",
			data: {
				code: event.target.value,
				depth: 4
			},
			dataType: "json",
			success: function(res) {
				if (res.cnt == 0) {
					$("#travel_type_3").hide().html("");
				} else {
					$("#travel_type_3").show().html(res.data)
				}
			}
		})
	});

	$("#travel_type_3").on("change", function(event) {
        $.ajax({
            url: "/ajax/get_list_product",
            type: "GET",
            data: {
                field: "product_code_3",
                product_code: event.target.value
            },
            success: function(res) {
                let data = res.results;
                let html = `<option value=''>선택</option>`;
                data.forEach(element => {
                    html += `<option value='${element["product_name"]}'>${element["product_name"]}</option>`;
                });
                $("#product_name").html(html);
            }
        })
    });

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

	const r_code = "qna";
	const r_idx = "<?= $idx ?>";
	const role = "admin";
</script>

<script src="/js/comment.js"></script>

<?= $this->endSection() ?>