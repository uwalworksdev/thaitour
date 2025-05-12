<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
	<div id="container">
		<span id="print_this"><!-- 인쇄영역 시작 //-->

			<header id="headerContainer">

				<div class="inner">
					<h2>자동SMS설정</h2>
					<div class="menus">
						<ul class="last">
							<li><a href="javascript:history.back();" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>

							<li><a href="javascript:send_it();" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
						</ul>
				</div>
			</div>
			<!-- // inner -->

	</header>
	<!-- // headerContainer -->
	<div id="contents">

		<div class="listWrap email_container email_container01">

			<form name="frm" id="frm" action="sms_mod_ok" method="post" enctype="multipart/form-data" target="hiddenFrame22" >
				<input type="hidden" name="idx" id="idx" value="<?=$sms['idx'] ?? ""?>" />
				<div class="listBottom">
					<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
						<caption></caption>
						<colgroup>
							<col width="150px">
							<col width="*">
						</colgroup>

						<tbody>
							<tr style="height:45px;">
								<th>코드</th>
								<td><input type="text" name="code" id="code" value="<?=$sms['code'] ?? ""?>" style="width:100px;"></td>
							</tr>

							<tr style="height:45px;">
								<th>항목</th>
								<td><input type="text" name="code" id="code" value="<?=$sms['title'] ?? ""?>" style="width:90%;"></td>
							</tr>

							<tr style="height:45px;">
								<th>구분</th>
								<td>
									<input type="radio" name="autosend" id="autosend" value="Y" <?php if(isset($sms['autosend']) && $sms['autosend'] == "Y")echo "checked";?> >사용	
									<input type="radio" name="autosend" id="autosend" value="N" <?php if(isset($sms['autosend']) && $sms['autosend'] == "N")echo "checked";?> >사용안함
								</td>
							</tr>
							<tr style="height:45px;">
								<th>문자내역</th>
								<td><input type="text" name="content" id="content" value="<?=$sms['content'] ?? ""?>" style="width:90%;" ></td>
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
							<li><a href="javascript:history.back();" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
							<li><a href="javascript:send_it();" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
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

<iframe width="300" height="300" name="hiddenFrame22" id="hiddenFrame22" style="display:block;position: absolute; top: 50%; left:50%; transform: translate(-50%, -50%);"></iframe>

<script type="text/javascript">
	function send_it() {
		var frm = document.frm;
		
		if (frm.content.value == "")
		{
			alert_("내용을 입력해주세요.");
			frm.content.focus();
			return;
		}

		frm.submit();
	}
</script>
<?= $this->endSection() ?>
