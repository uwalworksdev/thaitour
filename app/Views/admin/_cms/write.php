<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <script>
        var use_editor = "<?=$code_info['r_use_content_editor'];?>"; // 상세정보 에디터 사용여부(Y)


        // 스마트 에디터
        var oEditors = [];

        // 스마트 에디터 옵션
        var editor_option = {
            oAppRef: oEditors,
            elPlaceHolder: "",
            sSkinURI: "/smarteditor/SmartEditor2Skin.html",
            htParams: {
                bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
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

    <script>
	$(function () {
		var startDate, endDate;
		$("#startDate").datepicker({
			dateFormat: "yy-mm-dd",
			onSelect: function (selectedDate) {
				endDate.datepicker("option", "minDate", selectedDate);
			}
		});
		endDate = $("#endDate").datepicker({
			dateFormat: "yy-mm-dd",
			onSelect: function (selectedDate) {
				startDate.datepicker("option", "maxDate", selectedDate);
			}
		});
	});
    </script>

	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>


    <style>
        .btn_mod, .btn_del {
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
            color: #7d7d7d; /* text-align:center; */
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

        #div_form .ul_template > li {
            display: inline-block;
            padding: 3px 5px;
            margin-right: 10px;
        }

    </style>


    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2><?= $code_info['r_title']; ?></h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="/AdmMaster/_cms/index?r_code=<?= $code_info['r_code']; ?>" class="btn btn-default" onClick="go_list();"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($r_idx == "") { ?>
                                    <a href="#!" class="btn btn-success" onClick="send_it();"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="#!" class="btn btn-success" onClick="send_it();"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <a href="#!" class="btn btn-danger" onClick="send_it();"><span class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
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

                    <form name="frm_form" id="frm_form" action="/AdmMaster/_cms/write_ok<?= $r_idx ? "/$r_idx" : ""?>" onSubmit="return false;" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="r_code" value="<?= $r_code; ?>">

                        <table>
                            <tr>
                                <th>상태</th>
                                <td>
                                    <select name="r_status">
                                        <option value="">선택</option>
                                        <?php foreach ($status_arr as $key => $val) {
                                            if ($key == "D") continue; ?>
                                            <option <?php if ($form_data['r_status'] == $key) echo "selected"; ?>
                                                    value="<?= $key; ?>"><?= $val; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <?php if ($code_info['r_use_order'] == "Y") { ?>
                                <tr>
                                    <th>순서</th>
                                    <td>
                                        <input type="text" name="r_order" value="<?= $form_data['r_order']; ?>" style="width:50px;">
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_s_date'] == "Y") { ?>
                                <tr>
                                    <th>시작일시</th>
                                    <td>
                                        <input type="hidden" name="r_s_date" value="<?= $form_data['r_s_date']; ?>">
                                        <input type="text" name="r_s_date_d" id="startDate"
                                               value="<?= substr($form_data['r_s_date'], 0, 10); ?>"
                                               class="date_pic">
                                        &nbsp;
                                        <input type="text" name="r_s_date_h"
                                               value="<?= substr($form_data['r_s_date'], 11, 2); ?>"
                                               style="width:30px; text-align:center;"> :
                                        <input type="text" name="r_s_date_i"
                                               value="<?= substr($form_data['r_s_date'], 14, 2); ?>"
                                               style="width:30px; text-align:center;"> :
                                        <input type="text" name="r_s_date_s"
                                               value="<?= substr($form_data['r_s_date'], 17, 2); ?>"
                                               style="width:30px; text-align:center;">
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_e_date'] == "Y") { ?>
                                <tr>
                                    <th>종료일시</th>
                                    <td>
                                        <input type="hidden" name="r_e_date" value="<?= $form_data['r_e_date']; ?>">
                                        <input type="text" name="r_e_date_d" id="endDate"
                                               value="<?= substr($form_data['r_e_date'], 0, 10); ?>"
                                               class="date_pic">
                                        &nbsp;
                                        <input type="text" name="r_e_date_h"
                                               value="<?= substr($form_data['r_e_date'], 11, 2); ?>"
                                               style="width:30px; text-align:center;"> :
                                        <input type="text" name="r_e_date_i"
                                               value="<?= substr($form_data['r_e_date'], 14, 2); ?>"
                                               style="width:30px; text-align:center;"> :
                                        <input type="text" name="r_e_date_s"
                                               value="<?= substr($form_data['r_e_date'], 17, 2); ?>"
                                               style="width:30px; text-align:center;">
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_open'] == "Y") { ?>
                                <tr>
                                    <th>열기 옵션</th>
                                    <td>
                                        <?php $tmp = json_decode($form_data['r_open'], true); ?>
                                        <input type="hidden" name="r_open" value="">
                                        <select class="open" data-item="type">
                                            <option value="popup" <?php if ($tmp['type'] == "popup") echo "selected"; ?> >
                                                팝업
                                            </option>
                                            <option value="layer" <?php if ($tmp['type'] == "layer") echo "selected"; ?> >
                                                레이어
                                            </option>
                                        </select>
                                        Top : <input type="text" class="open" data-item="top"
                                                     value="<?= $tmp['top']; ?>"
                                                     style="width:50px;">px &nbsp;
                                        Left : <input type="text" class="open" data-item="left"
                                                      value="<?= $tmp['left']; ?>"
                                                      style="width:50px;">px &nbsp;
                                        Width : <input type="text" class="open" data-item="width"
                                                       value="<?= $tmp['width']; ?>"
                                                       style="width:50px;">px &nbsp;
                                        Height : <input type="text" class="open" data-item="height"
                                                        value="<?= $tmp['height']; ?>"
                                                        style="width:50px;">px &nbsp;
                                        추가 : <input type="text" class="open" data-item="etc" value="<?= $tmp['etc']; ?>"
                                                    style="width:300px;">
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_close'] == "Y") { ?>
                                <tr>
                                    <th>닫기 옵션</th>
                                    <td>
                                        <select name="r_close">
                                            <option value="">선택</option>
                                            <?php foreach ($close_arr as $key => $val) { ?>
                                                <option value="<?= $key; ?>" <?php if ($form_data['r_close'] == $key) echo "selected"; ?> ><?= $val; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_date'] == "Y") { ?>
                                <tr>
                                    <th>날짜</th>
                                    <td>
                                        <input type="hidden" name="r_date" value="<?= $form_data['r_date']; ?>">
                                        <input type="text" name="r_date_d"
                                               value="<?= substr($form_data['r_date'], 0, 10); ?>"
                                               class="date_pic">
                                        &nbsp;
                                        <input type="text" name="r_date_h"
                                               value="<?= substr($form_data['r_date'], 11, 2); ?>"
                                               style="width:30px; text-align:center;"> :
                                        <input type="text" name="r_date_i"
                                               value="<?= substr($form_data['r_date'], 14, 2); ?>"
                                               style="width:30px; text-align:center;"> :
                                        <input type="text" name="r_date_s"
                                               value="<?= substr($form_data['r_date'], 17, 2); ?>"
                                               style="width:30px; text-align:center;">
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_product'] == "Y") { ?>
                                <tr>
                                    <th>상품</th>
                                    <td>
                                        <input type=hidden name="r_product_idx" id="r_product_idx"
                                               value="<?= $form_data['r_product_idx'] ?>">
                                        <div id="div_product">
                                            <button class="btn_sel_product">상품 선택</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_name'] == "Y") { ?>
                                <tr>
                                    <th>이름</th>
                                    <td>
                                        <input type="text" name="r_name" value="<?= $form_data['r_name']; ?>"
                                               class="w200">
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_type'] == "Y") { ?>
                                <tr>
                                    <th>구분</th>
                                    <td>
                                        <select name="r_type">
                                            <option value="">*선택*</option>
                                            <?php foreach ($type_arr as $key => $val) { ?>
                                                <option value="<?= $key; ?>" <?php if ($key == $form_data['r_type']) echo "selected"; ?>>
                                                    [<?= $key; ?>] <?= $val; ?></option>
                                            <?php } ?>
                                            <option value="add_new_type">*새로운 구분 추가*</option>
                                        </select>
                                        <span id="div_new_type" style="display:none; padding-left:30px;">
							코드 : <input type="text" name="new_type_key" value="" style="width:100px;">
							제목 : <input type="text" name="new_type_val" value="" style="width:200px;">
						</span>
                                        <span>(※ TOP DESTINATIONS 분류는 앞에 'TOP_'을 붙여주세요 ex) TOP_b1 )</span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_template'] == "Y") { ?>
                                <tr>
                                    <th>템플릿</th>
                                    <td>
                                        <ul class="ul_template">
                                            <?php foreach ($template_arr as $key => $val) { ?>
                                                <li><label><input type="radio" name="r_template"
                                                                  value="<?= $val; ?>" <?php if ($form_data['r_template'] == $val) echo "checked"; ?>><?= $key; ?>
                                                    </label></li>
                                            <?php } ?>
                                            <li><label><input type="radio" name="r_template"
                                                              value="" <?php if ($form_data['r_template'] == "") echo "checked"; ?>>적용하지
                                                    않음</label></li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_title'] == "Y") { ?>
                                <tr>
                                    <th>제목</th>
                                    <td>
                                        <input type="text" name="r_title" value="<?= $form_data['r_title']; ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_desc'] == "Y") { ?>
                                <tr>
                                    <th>요약정보</th>
                                    <td>
                                        <textarea name="r_desc" id="r_desc"
                                                  style="height:150px"><?= $form_data['r_desc']; ?></textarea>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_content'] == "Y") { ?>
                                <tr>
                                    <th>상세정보</th>
                                    <td>
						<textarea class="input-xlarge" style="width:100%;height:200px" name="r_content" id="r_content"
                                  value=""><?= $form_data['r_content']; ?></textarea></td>
                                    <script type="text/javascript">
                                        // 스마트 에디터 적용
                                        if (use_editor == "Y") {
                                            editor_option.elPlaceHolder = "r_content";
                                            nhn.husky.EZCreator.createInIFrame(editor_option);

                                        }
                                    </script>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_url'] == "Y") { ?>
                                <tr>
                                    <th>URL</th>
                                    <td>
                                        <input type="text" name="r_url" value="<?= $form_data['r_url']; ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_thumb'] != "") { ?>
                                <tr>
                                    <th>썸네일</th>
                                    <td>
                                        <input type="file" name="file_thumb"> (<?= $code_info['r_use_thumb']; ?>)
                                        <?php if ($form_data['r_thumb'] != "") {
                                            $tmp = explode("x", $code_info['r_use_thumb']); ?>
                                            <br>
                                            <a href="/data/cms/<?= $r_code; ?>/<?= $r_idx; ?>/<?= $form_data['r_thumb']; ?>">
                                                <img src="/data/cms/<?= $r_code; ?>/<?= $r_idx; ?>/<?= $form_data['r_thumb']; ?>"
                                                     style="width:<?= $tmp[0]; ?>px; height:<?= $tmp[1]; ?>px;">
                                            </a>
                                            (<input type="checkbox" name="thumb_del" value="Y">삭제)
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($code_info['r_use_file'] == "Y") { ?>
                                <tr>
                                    <th>파일</th>
                                    <td>
                                        <style>
                                            .ul_file li {
                                                padding: 3px;
                                                border: 1px solid #ccc;
                                                padding: 10px;
                                                margin-bottom: 10px;
                                                background: #fff;
                                            }
                                        </style>

                                        <span style="color:blue; font-size:12px;">* 첨부파일의 순서는 Drag & Drop 방식으로 변경할 수 있으며, 각 파일의 입력 항목은 필요에 따라 입력하시면 됩니다.</span>
                                        <ul id="ul_file" class="ul_file">
                                            <!-- 기존 파일 -->
                                            <?php for ($i = 0; $i < $file_cnt; $i++) {
                                                $tmp = $file_arr[$i]; ?>
                                                <li>
                                                    <input type="hidden" name="file_ord[]" value="<?= $tmp['code']; ?>">
                                                    제목 : <input type="text" name="file_title_<?= $tmp['code']; ?>"
                                                                value="<?= $tmp['title']; ?>" class="title"
                                                                style="width:300px;">
                                                    &nbsp;
                                                    URL : <input type="text" name="file_url_<?= $tmp['code']; ?>"
                                                                 value="<?= $tmp['url']; ?>" class="url"
                                                                 style="width:300px;">
                                                    &nbsp;
                                                    식별자 : <input type="text" name="file_id_<?= $tmp['code']; ?>"
                                                                 value="<?= $tmp['id']; ?>"
                                                                 class="id" style="width:100px;">
                                                    &nbsp;
                                                    <input type="file" name="file_<?= $tmp['code']; ?>">
                                                    &nbsp;
                                                    <a href="/data/cms/<?= $r_code; ?>/<?= $r_idx; ?>/<?= $tmp['code']; ?>"><?= $tmp['name']; ?></a>
                                                    (<input type="checkbox" name="file_del[]" class="file_del"
                                                            value="<?= $tmp['code']; ?>">삭제)
                                                    <br>
                                                    내용 : <textarea name="file_desc_<?= $tmp['code']; ?>"
                                                                   style="width:80%; height:60px;"><?= $tmp['desc']; ?></textarea>
                                                    <?php if (strtolower(substr($tmp['type'], 0, 6)) == "image/") { ?>
                                                        <img src="/data/cms/<?= $r_code; ?>/<?= $r_idx; ?>/<?= $tmp['code']; ?>"
                                                             style="width:15%; max-width:150px; max-height:60px;">
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                            <!-- 새 파일 -->
                                        </ul>

                                        <xmp id="tmp_file" style="display:none;">
                                            <li>
                                                <input type="hidden" name="file_ord[]" value="new">
                                                제목 : <input type="text" name="file_title[]" style="width:300px;">
                                                &nbsp;
                                                URL : <input type="text" name="file_url[]" style="width:300px;">
                                                &nbsp;
                                                식별자 : <input type="text" name="file_id[]" style="width:100px;">
                                                &nbsp;
                                                <input type="file" name="files[]">
                                                <?php if ($code_info['r_use_file_list'] == "Y") { ?>
                                                    <input type="button" class="btn_file_add" value="+">
                                                    <input type="button" class="btn_file_del" value="-">
                                                <?php } ?>
                                                <br>
                                                내용 : <textarea name="file_desc[]"
                                                               style="width:80%; height:60px;"></textarea>
                                            </li>
                                        </xmp>
                                        <script>
                                            $(function () {
                                                $("#ul_file").delegate(".btn_file_add", "click", function () {
                                                    $(this).closest("li").after($("#tmp_file").html());
                                                });

                                                $("#ul_file").delegate(".btn_file_del", "click", function () {
                                                    $(this).closest("li").remove();
                                                    if ($("#ul_file li").length < 1)
                                                        $("#ul_file").append($("#tmp_file").html());
                                                });

                                                // 기본 1개 추가
                                                $("#ul_file").append($("#tmp_file").html());

                                                // 순서 변경 가능
                                                $(".ul_file").sortable();
                                            });
                                        </script>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>

                        <div class="tail_menu">
                            <ul>
                                <li class="left"></li>
                                <li class="right_sub">
                                    <a href="/AdmMaster/_cms/index?r_code=<?= $code_info['r_code']; ?>" class="btn btn-default" onClick="go_list();"><span
                                                class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                    <?php if ($r_idx == "") { ?>
                                        <a href="#!" class="btn btn-success" onClick="send_it();"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <?php } else { ?>
                                        <a href="#!" class="btn btn-success" onClick="send_it();"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <a href="#!" class="btn btn-danger" onClick="send_it();"><span class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>

                    </form>

                </div>
            </div>

        </div><!-- print_this -->
    </div><!-- container -->


    <script>

        // 상품 검색
        function search_product() {
            // 입력된 검색어
            var word = $("#pop_product .sch_word").val();
            var w_arr = word.split(" "); // 공백으로 구분

            var op = $("#pop_product .sch_op").val();

            // 빈 값 -> 전체 표시
            if (word == "") {
                $("#pop_product .ul_product li").show();
            } else if (op == "MATCH") {
                $("#pop_product .ul_product li").each(function () {
                    var name = $(this).attr("data-name");
                    if (name.indexOf(word) >= 0)
                        $(this).show();
                    else
                        $(this).hide();
                });
            } else if (op == "OR") {
                $("#pop_product .ul_product li").each(function () {
                    var name = $(this).attr("data-name");
                    var chk = false;
                    for (var i = 0; i < w_arr.length; i++) {
                        if (w_arr[i] == "") continue;
                        if (name.indexOf(w_arr[i]) >= 0) {
                            chk = true;
                            break;
                        }
                    }

                    if (chk)
                        $(this).show();
                    else
                        $(this).hide();
                });
            } else if (op == "AND") {
                $("#pop_product .ul_product li").each(function () {
                    var name = $(this).attr("data-name");
                    var chk = true;
                    for (var i = 0; i < w_arr.length; i++) {
                        if (w_arr[i] == "") continue;
                        if (name.indexOf(w_arr[i]) < 0) {
                            chk = false;
                            break;
                        }
                    }

                    if (chk)
                        $(this).show();
                    else
                        $(this).hide();
                });
            }
        }

        // 상품 추가
        function add_product(idx, name) {
            console.log("add_product : " + idx + ", " + name);

            if (idx == "" || idx == undefined)
                return;

            if (name == "" || name == undefined)
                name = $("#pop_product .ul_product li[data-idx='" + idx + "']").attr("data-name");

            // 중복 검사
            if ($("#div_product .product[data-idx='" + idx + "']").length > 0)
                return;

            // 목록에 추가
            var html = "<div class='product' data-idx='" + idx + "'>" + name + "<span class='btn_del'>X</span></div>";
            $("#div_product").append(html);
            set_product_idx();

            // 선택 설정
            $("#pop_product .ul_product li[data-idx='" + idx + "']").addClass("sel");
        }

        // 상품 제외
        function del_product(idx) {
            console.log("del_product : " + idx);
            $("#div_product .product[data-idx='" + idx + "']").remove();
            set_product_idx();

            // 선택 해제
            $("#pop_product .ul_product li[data-idx='" + idx + "']").removeClass("sel");
        }

        // 상품 목록 취합
        function set_product_idx() {
            var arr = new Array();
            $("#div_product .product").each(function () {
                arr.push($(this).attr("data-idx"));
            });

            var list = arr.join("||");
            if (list != "") list = "||" + list;

            $("#r_product_idx").val(list);
        }

        // 상품 선택 초기화
        function init_product(idx_list) {
            if (idx_list == "" || idx_list == undefined)
                idx_list = $("#r_product_idx").val();

            if (idx_list == "" || idx_list == undefined)
                return;

            var idx_arr = idx_list.split("||");
            for (var i = 0; i < idx_arr.length; i++) {
                add_product(idx_arr[i], "");
                //$("#pop_product .ul_product > li[data-idx='"+idx_arr[i]+"']").addClass("sel");
            }
        }

        $(function () {
            // 상품 선택 초기화
            init_product();

            // 상품 선택창 이동
            $("#pop_product").draggable({
                //handle: ".str_title"
            });

            // 상품 선택창 열기 버튼
            $(".btn_sel_product").click(function () {
                $("#pop_product").show();
            });

            // 상품 선택창 닫기 버튼
            $("#pop_product .btn_close").click(function () {
                $("#pop_product").hide();
            });

            // 상품 검색
            $("#pop_product .sch_word").keyup(function () {
                search_product();
            });

            $("#pop_product .sch_op").keyup(function () {
                search_product();
            });

            // 상품 추가 / 해제
            $("#pop_product .ul_product > li").click(function () {
                var idx = $(this).attr("data-idx");
                var name = $(this).attr("data-name");

                if ($(this).hasClass("sel"))
                    del_product(idx);
                else
                    add_product(idx, name);
            });

            // 상품 삭제
            $("#div_product").delegate(".product .btn_del", "click", function () {
                var idx = $(this).closest(".product").attr("data-idx");
                del_product(idx);
            });
        });
    
        function send_it() {

            // 열기 옵션 취합
            var open = {};
            $(".open").each(function(){
                open[$(this).attr("data-item")] = $(this).val();
            });
            $("#frm_form input[name='r_open']").val(JSON.stringify(open));

            var form = document.frm_form;
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: "json",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function (res) {
                    if (res.result == "success") {
                        <?php if($r_idx): ?>
                            location.reload();
                        <?php else: ?>
                            location.href = "/AdmMaster/_cms/index?r_code=<?=$r_code?>";
                        <?php endif; ?>
                    }
                }
            })
        }
        
    </script>


    <style>
        .btn_sel_product {
            padding: 5px 10px;
        }

        #pop_product {
            width: 400px;
            height: 500px;
            position: absolute;
            top: 100px;
            left: 300px;
            border: 2px solid #999999;
            background: #ffffff;
            padding: 0;
            display: none;
            z-index: 999;
        }

        #pop_product .div_head {
            padding: 5px;
            background: #999999;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
        }

        #pop_product .div_head .str_title {
        }

        #pop_product .div_head .btn_close {
            float: right;
            margin-right: 5px;
        }

        #pop_product .div_body {
            padding: 5px;
        }

        #pop_product .div_item {
            padding: 5px;
        }

        #pop_product .sch_word {
            padding: 2px 5px;
            width: 300px;
        }

        #pop_product .sch_op {
            height: 33px;
            width: 60px;
        }

        #pop_product .ul_product {
            height: 400px;
            overflow-y: auto;
        }

        #pop_product .ul_product li {
            padding: 5px;
            cursor: pointer;
        }

        #pop_product .ul_product li:hover {
            background: #dddddd;
        }

        #pop_product .ul_product li.sel {
            color: blue;
            font-weight: bold;
        }

        #pop_product .ul_product li.sel:hover {
            background: #eeeeee;
        }

        #div_product {
        }

        #div_product .product {
            padding-top: 5px;
        }

        #div_product .product .btn_del {
            padding-left: 10px;
            color: red;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

    <div id="pop_product">
        <div class="div_head">
            <span class="str_title">상품 선택</span>
            <span class="btn_close">X</span>
        </div>
        <div class="div_body">
            <div class="div_item">
                <input type="text" class="sch_word">
                <select class="sch_op">
                    <option value="OR">OR</option>
                    <option value="AND">AND</option>
                    <option value="MATCH">일치</option>
                </select>
            </div>
            <div class="div_item">
                <ul class="ul_product">
                    <?php foreach ($product_arr as $key => $tmp) { ?>
                        <li data-idx="<?= $key; ?>"
                            data-name="<?= $tmp['product_name']; ?>"><?= $tmp['product_name']; ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>