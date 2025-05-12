<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<!-- 에디터 사용에 필요한 js 인크루드 -->
<script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>

<div id="container">
	<span id="print_this"><!-- 인쇄영역 시작 //-->

		<header id="headerContainer">

			<div class="inner">
				<h2>자동메일설정</h2>
				<div class="menus">
					<ul class="last">
						<li><a href="javascript:history.back();" class="btn btn-default"><span
									class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>

						<li><a href="javascript:send_it();" class="btn btn-default"><span
									class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
					</ul>
				</div>
			</div>
			<!-- // inner -->

		</header>
		<!-- // headerContainer -->

		<div id="contents">

			<div class="listWrap email_container email_container01">

				<form name="frm" id="frm" action="email_mod_ok" method="post" enctype="multipart/form-data"
					target="hiddenFrame22">
					<input type="hidden" name="idx" id="idx" value="<?= $email['idx'] ?? "" ?>" />
					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
							<caption></caption>
							<colgroup>
								<col width="150px">
								<col width="*">
							</colgroup>

							<tbody>
								<tr style="height:45px;">
									<th>메일코드</th>
									<td><input type="text" name="code" id="code" value="<?=$email['code'] ?? ""?>" style="width:100px;"></td>
								</tr>
								<tr style="height:45px;">
									<th>메일항목</th>
									<td>
										<input type="text" name="title" id="title" value="<?= $email['title'] ?? "" ?>" style="width:90%;">
									</td>
								</tr>

								<tr style="height:45px;">
									<th>구분</th>
									<td>
										<input type="radio" name="autosend" id="autosend" value="Y"
											<?php if (isset($email['autosend']) && $email['autosend'] == "Y")
												echo "checked"; ?>>자동발송
										<input type="radio" name="autosend" id="autosend" value="N"
											<?php if (isset($email['autosend']) && $email['autosend'] == "N")
												echo "checked"; ?>>자동발송안함
									</td>
								</tr>
								<tr style="height:45px;">
									<th>발송자이름</th>
									<td><input type="text" name="send_name" id="send_name"
											value="<?= $email['send_name'] ?? "" ?>"></td>
								</tr>
								<tr style="height:45px;">
									<th>발송자E-mail</th>
									<td><input type="text" name="send_email" id="send_email"
											value="<?= $email['send_email'] ?? "" ?>"></td>
								</tr>
								<tr style="height:45px;">
									<th>메일제목</th>
									<td><input type="text" name="mail_title" id="mail_title"
											value="<?= $email['mail_title'] ?? "" ?>"></td>
								</tr>
								<tr>
									<th colspan="2">
										<textarea name="content" id="content_" rows="10" cols="100" class="input_txt"
											style="width:100%; height:400px; display:none;"><?= $email['content'] ?? "" ?></textarea>

										<script type="text/javascript">
											var oEditors1 = [];

											// 추가 글꼴 목록
											//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

											nhn.husky.EZCreator.createInIFrame({
												oAppRef: oEditors1,
												elPlaceHolder: "content_",
												sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
												htParams: {
													bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
													bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
													bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
													//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
													fOnBeforeUnload: function () {
														//alert("완료!");
													}
												}, //boolean
												fOnAppLoad: function () {
													var oEditorFrame = document.getElementById('content___Frame');
													var oEditorDocument = oEditorFrame.contentDocument || oEditorFrame.contentWindow.document;

													var oStyle = oEditorDocument.createElement('style');
													oStyle.type = 'text/css';
													oStyle.innerHTML = `table.__se_tbl_ext tbody tr { border-top: 1px dashed #000; }`;
													oEditorDocument.head.appendChild(oStyle);
												},
												fCreator: "createSEditor2"
											});

										</script>
									</th>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- // listBottom -->
				</form>

				<div id="headerContainer">

					<div class="inner">
						<div class="menus">
							<ul class="last">
								<li><a href="javascript:history.back();" class="btn btn-default"><span
											class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
								</li>
								<li><a href="javascript:send_it();" class="btn btn-default"><span
											class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
							</ul>

						</div>

					</div>
					<!-- // inner -->

				</div>
				<!-- // headerContainer -->
			</div>
			<!-- // listWrap -->

		</div>
		<!-- // contents -->

	</span>
	<!-- 인쇄 영역 끝 //-->
</div>

<iframe width="300" height="300" name="hiddenFrame22" id="hiddenFrame22"
	style="display:block;position: absolute; top: 50%; left:50%; transform: translate(-50%, -50%);"></iframe>

<script type="text/javascript">
	function send_it() {
		var frm = document.frm;
		
		if (frm.code.value == "") {
			alert_("메일코드 등록해주세요.");
			frm.send_name.focus();
			return;
		}

		if (frm.title.value == "") {
			alert_("메일항목 등록해주세요.");
			frm.title.focus();
			return;
		}

		if (frm.send_name.value == "") {
			alert_("발송자 이름을 등록해주세요.");
			frm.send_name.focus();
			return;
		}

		if (frm.send_email.value == "") {
			alert_("발송자E-mail을 입력해주세요.");
			frm.send_email.focus();
			return;
		}

		if (frm.mail_title.value == "") {
			alert_("메일제목을 입력해주세요.");
			frm.mail_title.focus();
			return;
		}

		oEditors1.getById["content_"].exec("UPDATE_CONTENTS_FIELD", []);

		if (frm.content.value.length < 14) {
			frm.content.focus();
			alert_("내용을 입력하셔야 합니다.");
			return;
		}

		frm.submit();
	}
</script>
<?= $this->endSection() ?>
