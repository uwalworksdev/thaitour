<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<?php
	$session = session();

    foreach ($data as $key => $value) {
        ${$key} = $value;
    }
?>

<div id="container"> 
    <span id="print_this"><!-- 인쇄영역 시작 //-->
		<header id="headerContainer">
			<div class="inner">
				<h2>상품 Q&A</h2>
				<div class="menus">
					<ul>
						<li><a href="/AdmMaster/_product_qna/list" class="btn btn-default"><span
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
                                    <th>상품</th>
                                    <td colspan="3"><?= $product_name ?></td>    
                                </tr>
                                <tr>
									<th>제목</th>
									<td colspan="3">
                                        <input type="text" name="title" id="title" value="<?= $title ?>">
                                    </td>
								</tr>
								<tr>
									<th>상태설정</th>
									<td colspan="3">
										<select name="status">
											<option value="Y" <?php if ($status == "Y" || empty($status)) {
												echo "selected";
											} ?>>사용</option>
											<option value="N" <?php if ($status == "N") {
												echo "selected";
											} ?>>중지</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>피드백</th>
									<td colspan="3">
                                        <textarea name="reply_content" id="reply_content"
											rows="8" style="width: 100%;"><?= $reply_content ?></textarea>
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

							<a href="/AdmMaster/_product_qna/list" class="btn btn-default"><span
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
	</span><!-- 인쇄 영역 끝 //-->
</div>
<!-- // container -->

<script>
    function send_it() {
		const formData = new FormData($('#frm')[0]);
		$.ajax({
			url: "write_ok",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: (data, textStatus) => {
				message = data.message;
				alert(message);
                if(data.result == true){
                    location.reload();
                }
			}
		})
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
				// location.reload();
				window.history.back();
			},
			error: function(request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});

	}

	function fn_comment() {
		<?php if ($session->get('member')["id"]) { ?>
			if ($("#comment").val() == "") {
				alert("댓글을 입력해주세요.");
				return;
			}
			var queryString = $("form[name=com_form]").serialize();
			$.ajax({
				type: "POST",
				url: "/comment/comment",
				data: queryString,
				cache: false,
				success: function (ret) {
					console.log(ret);
					if (ret.trim() == "OK") {
						fn_comment_list();
						$("#comment").val("");
					} else {
						alert("등록 오류입니다." + ret);
					}
				}
			});
		<?php } else { ?>
			alert("로그인을 해주세요.");
		<?php } ?>
	}

	function fn_comment_list() {

		$.ajax({
			type: "GET",
			url: "/comment/comment_list",
			data: {
				"r_code": "qna",
				"r_idx": "<?= $idx ?>",
				"role": "admin"
			},
			cache: false,
			success: function (ret) {
				$("#comment_list").html(ret);
			}
		});

	}

	function handleCmtDelete(idx) {
		if (confirm("삭제하시겠습니까?") == false) {
			return;
		}

		$.ajax({
			url: "/comment/cmtDel",
			data: { r_cmt_idx: idx },
			dataType: "JSON",
			type: "POST",
			cache: false,
			error: function (req, status, err) {
				alert("CODE: " + req.status + "\r\nmessage: " + req.responseTxt + "\r\nerror: " + err);
				return;
			},
			success: function (res, status, req) {
				alert(res.msg)
				if (res.result == 'OK') {
					fn_comment_list();
				} else {
					return;
				}
			}
		})
	}
	function handleCmtEdit(idx) {
		const displayChk = document.querySelector("#rrp_edit_" + idx).style.display;
		if (displayChk == '') {
			document.querySelector("#rrp_edit_" + idx).style.display = 'none';
			document.querySelector("#rrp_content_" + idx).style.display = '';
			
		} else {
			document.querySelector("#rrp_edit_" + idx).style.display = '';
			document.querySelector("#rrp_edit_" + idx + " textarea").focus();
			document.querySelector("#rrp_content_" + idx).style.display = 'none';
		}
	}

	function handleCmtEditSubmit(e, idx) {
		const comment = e.target.closest(".write_box").querySelector("textarea").value;
		$.ajax({
			url: "/comment/cmtEdit",
			data: { r_cmt_idx: idx, r_content: comment },
			dataType: "JSON",
			type: "POST",
			cache: false,
			error: function (req, status, err) {
				alert("CODE: " + req.status + "\r\nmessage: " + req.responseTxt + "\r\nerror: " + err);
				return;
			},
			success: function (res, status, req) {
				if (res.result == 'OK') {
					fn_comment_list();
				} else {
					return;
				}
			}
		})
	}

	function handleBlurEdit(idx) {
		document.querySelector("#rrp_edit_" + idx).style.display = 'none';
		document.querySelector("#rrp_content_" + idx).style.display = '';
	}

	function handleBlurEdit1(idx) {
		document.querySelector("#rrp_edit_" + idx).focus();
	}

	fn_comment_list();
</script>
<?= $this->endSection() ?>