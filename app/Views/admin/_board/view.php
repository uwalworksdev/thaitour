<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script>
        var r_code = "<?= $r_code; ?>"; // 게시판 코드

        var total_cnt = 0; // 검색된 전체 갯수
        var page = <?= $page * 1; ?>; // 현재 페이지 번호
        var sch_param = "<?= $Bbs->sch_param; ?>"; // 검색 조건
        var sort_param = "<?= $Bbs->sort_param; ?>"; // 정렬 조건
    </script>
    <script src="view.js"></script>


    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <script>
        // HTML 에디터 사용여부(Y)
        var use_editor = "<?= $code_info['r_use_content_editor']; ?>";

        // 스마트 에디터
        var oEditors = [];

        // 스마트 에디터 옵션
        var editor_option = {
            oAppRef: oEditors,
            elPlaceHolder: "",
            sSkinURI: "/smarteditor/SmartEditor2Skin.html",
            htParams: {
                bUseToolbar: true, // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseVerticalResizer: true, // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseModeChanger: true, // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                //aAdditionalFontList : [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]],		// 추가 글꼴 목록
                fOnBeforeUnload: function () {
                    //alert("완료!");
                }
            }, //boolean
            fOnAppLoad: function () {
                //예제 코드
                //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
            },
            fCreator: "createSEditor2"
        };
    </script>


    <style>
        .btn_mod,
        .btn_del {
            margin: 5px;
            cursor: pointer;
        }

        .div_notice {
            padding: 30px 50px;
            text-align: center;
            font-size: 20px;
            line-height: 30px;
            font-weight: bold;
            color: #888;
        }

        /* 레이어폼 기본 */
        .layer_bg {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background: url("/adm/img/common/layer_bg.png") repeat;
            z-index: 98;
            display: none;
        }

        /* 팝업 레이어
        .div_pop { position:absolute; min-width:150px; min-height:100px; z-index:100; display:none; background:#fff; border:3px solid green; border-radius:10px; box-shadow:3px 5px 10px; }
        */
        .div_pop .div_title {
            display: none;
            background: green;
            height: 35px;
            border-radius: 5px 5px 0 0;
            padding: 0 5px;
            cursor: pointer;
        }

        .div_pop .div_title .str_title {
            float: left;
            color: #ffffff;
            font-size: 15px;
            line-height: 25px;
            font-weight: bold;
        }

        .div_pop .div_title .btn_close {
            float: right;
            margin: 7px;
            width: 15px;
            height: 15px;
            font-size: 17px;
            line-height: 15px;
            text-align: center;
            font-weight: bold;
            background: #fff;
            border-radius: 3px;
            cursor: pointer;
        }

        .div_pop .div_content {
            padding: 0;
            font-size: 13px;
            line-height: 20px;
        }

        #div_form {
            top: 100px;
            left: 200px;
            width: /* 1000px */ 100%;
        }

        #div_form .div_content {
            clear: both;
            width: 96.30208333333333%;
            margin: 0 auto;
            padding-top: 15px;
        }

        #div_form .div_content table {
            margin-bottom: 10px;
            padding-bottom: 10px;
            width: 100%;
        }

        #div_form .div_content th {
            padding: 5px 10px;
            width: 80px;
            background: #fafafa;
            border-left: 1px solid #dddddd;
            border-top: 1px solid #dddddd;
            border-bottom: 1px solid #dddddd;
        }

        #div_form .div_content td {
            padding: 5px 10px;
            border: 1px solid #dddddd;
            padding: 5px 10px;
            font-size: 12px;
            color: #7d7d7d;
            /* text-align:center; */
        }

        #div_form .div_content select {
            min-width: 200px;
        }

        #div_form .div_content input[type='text'] {
            width: 95%;
            padding: 0px 5px;
            box-sizing: border-box;
        }

        #div_form .div_content input[type='text'].date_pic {
            width: 100px;
            text-align: center;
        }

        #div_form .div_content input[type='text'].w200 {
            width: 200px;
        }

        #div_form .div_content input[type='text'].num {
            width: 100px;
            text-align: right;
        }

        #div_form .div_content textarea {
            width: 95%;
            height: 200px;
            padding: 5px;
            resize: none;
        }

        #div_form .div_content table td {
            word-break: break-all;
        }
    </style>


    <div id="container">
	<span id="print_this"><!-- 인쇄영역 시작 //-->

		<header id="headerContainer">

			<div class="inner">
				<h2><?= $code_info['r_title']; ?></h2>
				<div class="menus">
					<ul>
						<li>
							<a href="#!" class="btn btn-default" onClick="go_list();"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
							<?php if ($Auth->is_admin == "Y" || $Auth->auth_idx == $view_data['r_reg_m_idx']) { ?>
                                <a href="#!" class="btn btn-success" onClick="go_form('<?= $r_idx; ?>');"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                <a href="#!" class="btn btn-danger" onClick="go_del_ok('<?= $r_idx; ?>');"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                            <?php } ?>
						</li>
					</ul>
				</div>
				<div class="codes">
					<ul class="first">
					</ul>

					<ul class="last">
					</ul>

				</div>

			</div><!-- // inner -->

		</header><!-- // headerContainer -->

		<div id="div_form" class="div_pop resizable">
			<div class="div_title">
				<div class="str_title">제목</div>
				<div class="btn_close" onClick="hide_pop('div_form');">×</div>
			</div>
			<div class="div_content">

				<form name="frm_form" id="frm_form" onSubmit="return false;" method="post"
                      enctype="multipart/form-data">
					<input type="hidden" name="call_type" value="ajax">
					<input type="hidden" name="data_type" value="json">
					<input type="hidden" name="r_code" value="<?= $r_code; ?>">
					<input type="hidden" name="r_idx" value="<?= $r_idx; ?>">
					<input type="hidden" name="cmd" value="regist">

					<table>
						<colgroup>
							<col width="120px">
							<col width="400px">
							<col width="120px">
							<col width="*">
						</colgroup>
						<tr>
							<th>상태</th>
							<td>
								<?= $Bbs->status_arr[$view_data['r_status']]; ?>
							</td>
							<th>베스트</th>
							<td>
								<input type="checkbox" disabled id="r_flag"
                                       name="r_flag" <?= $view_data['r_flag'] == 1 ? 'checked' : ''; ?>>
							</td>
						</tr>
						<?php if ($code_info['r_use_order'] == "Y") { ?>
                            <tr>
								<th>순서</th>
								<td colspan="3">
								<?= $view_data['r_order']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_date'] == "Y") { ?>
                            <tr>
								<th>날짜</th>
								<td colspan="3">
									<?= $view_data['r_date']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_view_cnt'] == "Y") { ?>
                            <tr>
								<th>조회수</th>
								<td colspan="3">
									<?= $view_data['r_view_cnt']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_product'] == "Y") { ?>
                            <tr>
								<th>상품</th>
								<td colspan="3">
									<?= $view_data['r_product_name']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_reserve'] == "Y") { ?>
                            <tr>
								<th>예약번호</th>
								<td colspan="3">
									<?= $view_data['r_reserve_code']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_score'] == "Y") { ?>
                            <tr>
								<th>점수</th>
								<td colspan="3">
									<?= $view_data['r_score']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_name'] == "Y") { ?>
                            <tr>
								<th>이름</th>
								<td colspan="3">
									<?= $view_data['r_name']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_passwd'] == "Y") { ?>
                            <tr>
								<th>비밀 글</th>
								<td colspan="3">
									<input type="checkbox" name="r_private"
                                           value="Y" <?php if ($view_data['r_private'] == "Y") echo "checked"; ?> onClick="frm_form.r_passwd.disabled = !this.checked;">
									이 게시물을 [비밀] 게시물로 지정합니다.
								</td>
							</tr>
                            <tr>
								<th>비밀번호</th>
								<td colspan="3">
									<?= ($view_data['r_passwd'] != "") ? "******" : "&nbsp;"; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_company'] == "Y") { ?>
                            <tr>
								<th>회사</th>
								<td colspan="3">
									<?= $view_data['r_company']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_part'] == "Y") { ?>
                            <tr>
								<th>소속</th>
								<td colspan="3">
									<?= $view_data['r_part']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_position'] == "Y") { ?>
                            <tr>
								<th>직위</th>
								<td colspan="3">
									<?= $view_data['r_position']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_email'] == "Y") { ?>
                            <tr>
								<th>이메일</th>
								<td colspan="3">
									<?= $view_data['r_email']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_phone'] == "Y") { ?>
                            <tr>
								<th>전화번호</th>
								<td colspan="3">
									<?= $view_data['r_phone']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_mobile'] == "Y") { ?>
                            <tr>
								<th>휴대전화</th>
								<td colspan="3">
									<?= $view_data['r_mobile']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_category'] == "Y") { ?>
                            <tr>
								<th>분류</th>
								<td colspan="3">
									<?php
                                    echo $row_c['code_name'];
                                    ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_notice'] == "Y") { ?>
                            <tr>
								<th>공지</th>
								<td colspan="3">
									<input type="checkbox" name="r_notice"
                                           value="1" <?php if ($view_data['r_notice'] > 0) echo "checked"; ?>>
									이 게시물을 [공지] 게시물로 지정합니다.
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_title'] == "Y") { ?>
                            <tr>
								<th>제목</th>
								<td colspan="3">
									<?= $view_data['r_title']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_period'] == "Y") { ?>
                            <tr>
								<th>여행예정일</th>
								<td colspan="3">
									<?= $view_data['r_s_date']; ?> ~ <?= $view_data['r_e_date']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_desc'] == "Y") { ?>
                            <tr>
								<th>요약정보</th>
								<td colspan="3">
									<?= nl2br($view_data['r_desc']); ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_content'] == "Y") { ?>
                            <tr>
								<th>상세정보</th>
								<td colspan="3">
									<?php
                                    if ($code_info['r_content_view'] != "") {
                                        include($_SERVER['DOCUMENT_ROOT'] . $code_info['r_content_view']);
                                    } else {
                                        echo $view_data['r_content'];
                                    }
                                    ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_url'] == "Y") { ?>
                            <tr>
								<th>URL</th>
								<td colspan="3">
									<?= $view_data['r_url']; ?>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_file'] == "Y") { ?>
                            <tr>
								<th>파일</th>
								<td colspan="3">
									<style>
										.ul_file li {
                                            padding: 3px;
                                            padding: 10px;
                                            margin-bottom: 10px;
                                            background: #fff;
                                        }
									</style>

									<ul id="ul_file" class="ul_file">
										<?php for ($i = 0; $i < $file_cnt; $i++) {
                                            $tmp = $file_arr[$i]; ?>
                                            <li>
												제목 : <?= $tmp['title']; ?>
												&nbsp;
												URL : <?= $tmp['url']; ?>
												&nbsp;
												<a href="/ok.php?cmd=get_file&r_code=<?= $r_code; ?>&r_idx=<?= $r_idx; ?>&file_code=<?= $tmp['code']; ?>"><?= $tmp['name']; ?></a>
												<br>
												내용 : <?= $tmp['desc']; ?>
											</li>
                                        <?php } ?>
									</ul>
								</td>
							</tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_answer'] == "Y") { ?>
                            <tr>
								<th>답변자 이름</th>
								<td colspan="3">
									<input type="text" name="r_answer_name"
                                           value="<?= ($view_data['r_answer_name'] != "") ? $view_data['r_answer_name'] : $Auth->auth_name; ?>"
                                           class="w200">
								</td>
							</tr>
                            <tr>
								<th>답변내용</th>
								<td colspan="3">
									<textarea name="r_answer_content" id="r_answer_content"
                                              style="height:200px"><?= $view_data['r_answer_content']; ?></textarea>
									<script type="text/javascript">
										// 스마트 에디터 적용
                                        if (use_editor == "Y") {
                                            editor_option.elPlaceHolder = "r_answer_content";
                                            nhn.husky.EZCreator.createInIFrame(editor_option);
                                        }
									</script>
									<?php if ($Auth->is_admin == "Y") { ?>
                                        <a href="#!" class="btn btn-success" onClick="go_answer_regist();"><span
                                                    class="glyphicon glyphicon-cog"></span><span class="txt">답변등록</span></a>
										<?php if ($view_data['r_answer_status'] == "Y") { ?>
                                            <a href="#!" class="btn btn-danger"
                                               onClick="go_answer_del_ok('<?= $r_idx; ?>');"><span
                                                        class="glyphicon glyphicon-trash"></span><span
                                                        class="txt">답변삭제</span></a>
                                        <?php } ?>
                                    <?php } ?>
								</td>
							</tr>
                        <?php } ?>
					</table>
				</form>
				<?php
                if ($code_info['r_use_cmt'] == "Y") {
                    ?>
                    <form name="cfrm" action="" method="post">
						<input type="hidden" name="r_idx" value="<?= $r_idx ?>">
						<input type="hidden" name="cm_idx" value="<?= $view_data["r_reg_m_idx"] ?>">
						<input type="hidden" name="r_code" value="<?= $r_code ?>">
						<table border=1 style="width:831px">
							<colgroup>
								<col width="101px">
								<col width="730px">
							</colgroup>
							<tr>
								<td style="text-align:center">
									내용
								</td>
								<td style="text-align:center">
									<textarea name="comment"
                                              style="width:600px;height:100px; border:1px solid #ddd; float:left; box-sizing:border-box;"></textarea>
									<input type="button" value="등록" onclick="javascript:comment_it();"
                                           style="float:left; height:100px; box-sizing:border-box; width:90px; font-weight:bold; margin-left:15px;">
								</td>
							</tr>
                            <!-- <tr>
                            <td colspan="2" style="text-align:center;height:30px">

                            </td>
                        </tr> -->
						</table>
						<?php

                        if (count($fresult2) > 0) {
                            ?>
                            <table border=1 style="width:700px">
								<?php
                                foreach ($fresult2 as $frow2) {
                                    ?>
                                    <tr>
										<td>
											<?= nl2br($frow2["r_content"]) ?>
											<br>
											<?= $frow2["r_name"] ?>
											(<?= date("Y.m.d", strtotime($frow2["r_reg_date"])) ?>)
											<a href="javascript:del_it('<?= $frow2["r_cmt_idx"] ?>')">[삭제]</a>

										</td>
									</tr>
                                <?php } ?>
							</table>
                        <?php } ?>
						<script>
							function del_it(num) {
                                if (confirm("삭제하시겠습니까?")) {
                                    location.href = "comment_del.php?r_cmt_idx=" + num;
                                }
                            }

                            function comment_it() {
                                var frm = document.cfrm;
                                if (frm.comment.value == "") {
                                    frm.comment.focus();
                                    alert("내용을 입력하셔야 합니다.");
                                    return;
                                }
                                frm.action = "comment_ok.php";
                                frm.submit();
                            }
						</script>
                    </form>
                <?php } ?>

                <div class="tail_menu">
                    <ul>
                        <li class="left"></li>
                        <li class="right_sub">
                            <a href="#!" class="btn btn-default" onClick="go_list();"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            <?php if ($Auth->is_admin == "Y" || $Auth->auth_idx == $view_data['r_reg_m_idx']) { ?>
                                <a href="#!" class="btn btn-success" onClick="go_form('<?= $r_idx; ?>');"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                <a href="#!" class="btn btn-danger" onClick="go_del_ok('<?= $r_idx; ?>');"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
			</div>
		</div>

	</span><!-- print_this -->
    </div><!-- container -->

<?= $this->endSection() ?>