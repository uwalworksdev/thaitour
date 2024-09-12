<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<script>
    var r_code = "<?= $r_code; ?>"; // 게시판 코드

    var total_cnt = 0; // 검색된 전체 갯수
    var page = <?= $page * 1; ?>; // 현재 페이지 번호
    var sch_param = "<?= $Bbs->sch_param; ?>"; // 검색 조건
    var sort_param = "<?= $Bbs->sort_param; ?>"; // 정렬 조건
</script>
<script src="/js/admin/bbs_form.js"></script>


<!-- <script type="text/javascript" src="/ckeditor/ckeditor.js"></script> -->
<script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
<script>
    // HTML 에디터 사용여부(Y)
    var use_editor = "<?= $code_info['r_use_content_editor']; ?>";

    // 스마트 에디터
    var oEditors = [];

    // 스마트 에디터 옵션
    var editor_option = {
        oAppRef: oEditors,
        elPlaceHolder: "",
        sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
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
        width:
            /* 1000px */
            100%;
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
                            <?php if ($r_idx == "") { ?>
                                <a href="#!" class="btn btn-success" onClick="go_regist('new_ok');"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            <?php } else { ?>
                                <a href="#!" class="btn btn-primary" onClick="go_regist('mod_ok');"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                <!-- <a href="#!" class="btn btn-danger" onClick="go_regist('del_ok');"><span class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a> -->
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                <div class="codes">
                    <ul class="first">
                        <!-- 
                    <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), true)" class="btn btn-success">전체선택</a></li>
                    <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), false)" class="btn btn-success">선택해체</a></li>
                    <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                    <li><a href="javascript:go_list('');" class="btn btn-success">목록</a></li>
                    -->
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

                <form name="frm_form" id="frm_form" action="form_ok" method="post" enctype="multipart/form-data">
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
                        <!-- <tr>
                            <th>베스트</th>
                            <td>
                                <input type="checkbox" id="r_flag" name="r_flag" <?= $form_data['r_flag'] == 1 ? 'checked' : ''; ?>>
                            </td>
                        </tr> -->
                        <tr>
                            <th>상태</th>
                            <td>
                                <select name="r_status">
                                    <option value="">선택</option>
                                    <?php foreach ($Bbs->status_arr as $key => $val) {
                                        if ($key == $Bbs->status_del)
                                            continue; ?>
                                        <option <?php if ($form_data['r_status'] == $key)
                                            echo "selected"; ?> value="<?= $key; ?>">
                                            <?= $val; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <th>베스트</th>
                            <td>
                                <input type="checkbox" id="r_flag" name="r_flag" <?= $form_data['r_flag'] == 1 ? 'checked' : ''; ?>>
                            </td>
                        </tr>
                        <?php if ($code_info['r_use_order'] == "Y") { ?>
                            <tr>
                                <th>순서</th>
                                <td colspan="3">
                                    <input type="text" name="r_order" value="<?= $form_data['r_order']; ?>" class="date_pic">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_date'] == "Y") { ?>
                            <tr>
                                <th>날짜</th>
                                <td colspan="3">
                                    <input type="hidden" name="r_date" value="<?= $form_data['r_date']; ?>">
                                    <input type="text" name="r_date_d" value="<?= substr($form_data['r_date'], 0, 10); ?>"
                                        class="date_pic">
                                    <?php if ($code_info['r_use_time'] == "Y") { ?>
                                        &nbsp;
                                        <input type="text" name="r_date_h" value="<?= substr($form_data['r_date'], 11, 2); ?>"
                                            style="width:30px; text-align:center;"> :
                                        <input type="text" name="r_date_i" value="<?= substr($form_data['r_date'], 14, 2); ?>"
                                            style="width:30px; text-align:center;"> :
                                        <input type="text" name="r_date_s" value="<?= substr($form_data['r_date'], 17, 2); ?>"
                                            style="width:30px; text-align:center;">
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_view_cnt'] == "Y") { ?>
                            <tr>
                                <th>조회수</th>
                                <td colspan="3">
                                    <input type="text" name="r_view_cnt" value="<?= $form_data['r_view_cnt']; ?>" class="num">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_product'] == "Y") { ?>
                            <tr>
                                <th>상품</th>
                                <td colspan="3">
                                    <?php
                                    if ($r_code == "review") {
                                        echo $product_arr[$form_data['r_product_idx']]['product_name'];
                                    } else {
                                        ?>
                                        <select name="r_product_idx">
                                            <option value=""></option>
                                            <?php foreach ($product_arr as $key => $tmp) { ?>
                                                <option value="<?= $key; ?>" <?php if ($key == $form_data['r_product_idx'])
                                                    echo "selected"; ?>><?= $tmp['product_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_reserve'] == "Y") { ?>
                            <tr>
                                <th>예약번호</th>
                                <td colspan="3">
                                    <input type="text" name="r_reserve_code" value="<?= $form_data['r_reserve_code']; ?>"
                                        class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_score'] == "Y") { ?>
                            <tr>
                                <th>점수</th>
                                <td colspan="3">
                                    <?php if ($code_info['r_score_list'] != "") { ?>
                                        <select name="r_score">
                                            <option value="">선택</option>
                                            <?php foreach ($Bbs->score_arr as $key => $val) { ?>
                                                <option <?php if ($form_data['r_score'] == $key)
                                                    echo "selected"; ?> value="<?= $key; ?>">
                                                    <?= $val; ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <input type="text" name="r_score" value="<?= $form_data['r_score']; ?>" class="num">
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_name'] == "Y") { ?>
                            <tr>
                                <th>이름</th>
                                <td colspan="3">
                                    <input type="text" name="r_name" value="<?= $form_data['r_name']; ?>" class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_passwd'] == "Y") { ?>
                            <tr>
                                <th>비밀 글</th>
                                <td colspan="3">
                                    <input type="checkbox" name="r_private" value="Y" <?php if ($form_data['r_private'] == "Y")
                                        echo "checked"; ?> onClick="frm_form.r_passwd.disabled = !this.checked;">
                                    이 게시물을 [비밀] 게시물로 지정합니다.
                                </td>
                            </tr>
                            <tr>
                                <th>비밀번호</th>
                                <td colspan="3">
                                    <input type="password" name="r_passwd" value="<?= $form_data['r_passwd']; ?>" <?php if ($form_data['r_private'] != "Y")
                                        echo "disabled"; ?> class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_company'] == "Y") { ?>
                            <tr>
                                <th>회사</th>
                                <td colspan="3">
                                    <input type="text" name="r_company" value="<?= $form_data['r_company']; ?>" class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_part'] == "Y") { ?>
                            <tr>
                                <th>소속</th>
                                <td colspan="3">
                                    <input type="text" name="r_part" value="<?= $form_data['r_part']; ?>" class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_position'] == "Y") { ?>
                            <tr>
                                <th>직위</th>
                                <td colspan="3">
                                    <input type="text" name="r_position" value="<?= $form_data['r_position']; ?>"
                                        class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_email'] == "Y") { ?>
                            <tr>
                                <th>이메일</th>
                                <td colspan="3">
                                    <input type="text" name="r_email" value="<?= $form_data['r_email']; ?>" class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_phone'] == "Y") { ?>
                            <tr>
                                <th>전화번호</th>
                                <td colspan="3">
                                    <input type="text" name="r_phone" value="<?= $form_data['r_phone']; ?>" class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_mobile'] == "Y") { ?>
                            <tr>
                                <th>휴대전화</th>
                                <td colspan="3">
                                    <input type="text" name="r_mobile" value="<?= $form_data['r_mobile']; ?>" class="w200">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_category'] == "Y") { ?>
                            <tr>
                                <th>분류</th>
                                <td colspan="3">
                                    <select name="r_category">
                                        <option value="">*선택*</option>
                                        <?php
                                        foreach ($code_arr as $row_c) {
                                            if ($sch_category == $row_c['code_no'] || $form_data['r_category'] == $row_c['code_no']) {
                                                echo "<option value='" . $row_c['code_no'] . "' selected>" . $row_c['code_name'] . "</option>";
                                            } else {
                                                echo "<option value='" . $row_c['code_no'] . "'>" . $row_c['code_name'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php if ($code_info['r_use_category2'] == "Y") { ?>
                                        <select name="r_category2">
                                            <option value="">*선택*</option>
                                            <?php
                                            foreach ($Bbs->category2_arr as $category => $arr) {
                                                $is_assoc = $Lib->is_assoc($arr); // 연관 배열 여부 (bool)
                                                foreach ($arr as $key => $val) {
                                                    if (!$is_assoc)
                                                        $key = $val;
                                                    ?>
                                                    <option value="<?= $key; ?>" data-category="<?= $category; ?>" <?php if ($key == $form_data['r_category2'])
                                                        echo "selected"; ?>><?= $val; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                        <script>
                                            // 1분류 변경 -> 2차 분류 목록 재설정
                                            $("select[name='r_category']").change(function () {
                                                var old = $("select[name='r_category2']").val();

                                                $("select[name='r_category2'] option").hide();
                                                $("select[name='r_category2'] option[value='']").show();
                                                $("select[name='r_category2'] option[data-category='" + $("select[name='r_category']").val() + "']").show();

                                                if ($("select[name='r_category2'] option[value='" + old + "']").css("display") == "none")
                                                    $("select[name='r_category2']").val("");
                                            }).trigger("change");
                                        </script>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php //if($code_info['r_use_notice'] == "Y"){ ?>
                        <tr>
                            <th>공지</th>
                            <td colspan="3">
                                <input type="checkbox" name="r_notice" value="1" <?php if ($form_data['r_notice'] > 0)
                                    echo "checked"; ?>>
                                이 게시물을 [공지] 게시물로 지정합니다.
                            </td>
                        </tr>
                        <?php //} ?>
                        <?php if ($code_info['r_use_title'] == "Y") { ?>
                            <tr>
                                <th>제목</th>
                                <td colspan="3">
                                    <input type="text" name="r_title" value="<?= $form_data['r_title']; ?>">
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_desc'] == "Y") { ?>
                            <tr>
                                <th>요약정보</th>
                                <td colspan="3">
                                    <textarea name="r_desc" id="r_desc"
                                        style="height:50px"><?= $form_data['r_desc']; ?></textarea>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_content'] == "Y") { ?>
                            <tr>
                                <th>상세정보</th>
                                <td colspan="3">
                                    <?php
                                    if ($code_info['r_content_form'] != "") {
                                        include($_SERVER['DOCUMENT_ROOT'] . $code_info['r_content_form']);
                                    } else {
                                        ?>
                                        <textarea class="input-xlarge" style="width:100%;height:200px" name="r_content"
                                            id="r_content" value=""><?= $form_data['r_content']; ?></textarea>
                                    </td>
                                    <script>
                                    </script>
                                    <script type="text/javascript">
                                        // 스마트 에디터 적용
                                        if (use_editor == "Y") {
                                            editor_option.elPlaceHolder = "r_content";
                                            nhn.husky.EZCreator.createInIFrame(editor_option);

                                        }
                                    </script>
                                <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($code_info['r_use_url'] == "Y") { ?>
                            <tr>
                                <th>URL</th>
                                <td colspan="3">
                                    <input type="text" name="r_url" value="<?= $form_data['r_url']; ?>">
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
                                            border: 1px solid #ccc;
                                            padding: 10px;
                                            margin-bottom: 10px;
                                            background: #fff;
                                        }
                                    </style>

                                    <span style="color:blue; font-size:12px;">* 첨부파일의 순서는 Drag & Drop 방식으로 변경할 수 있으며, 각 파일의
                                        입력 항목은 필요에 따라 입력하시면 됩니다.</span>
                                    <ul id="ul_file" class="ul_file">
                                        <!-- 기존 파일 -->
                                        <?php 
                                            for ($i = 0; $i < $file_cnt; $i++) {
                                            $tmp = $file_arr[$i]; 
                                            $writablePath = WRITEPATH . 'uploads/';
                                        ?>
                                            <li>
                                                <input type="hidden" name="file_ord[]" value="<?= $tmp['code']; ?>">
                                                제목 : <input type="text" name="file_title_<?= $tmp['code']; ?>"
                                                    value="<?= $tmp['title']; ?>" class="title" style="width:300px;">
                                                &nbsp;
                                                URL : <input type="text" name="file_url_<?= $tmp['code']; ?>"
                                                    value="<?= $tmp['url']; ?>" class="url" style="width:300px;">
                                                &nbsp;
                                                <input type="file" name="file_<?= $tmp['code']; ?>">
                                                &nbsp;
                                                <a
                                                    href="<?=$writablePath . "bbs/" . $r_code . "/" . $r_idx . "/" . $tmp['code']?>"><?= $tmp['name']; ?></a>
                                                (<input type="checkbox" name="file_del[]" class="file_del"
                                                    value="<?= $tmp['code']; ?>">삭제)
                                                <br>
                                                내용 : <textarea name="file_desc_<?= $tmp['code']; ?>"
                                                    style="width:80%; height:60px;margin-top: 10px;"><?= $tmp['desc']; ?></textarea>
                                                <?php if (strtolower(substr($tmp['type'], 0, 6)) == "image/") { ?>
                                                    <img src="<?=$writablePath . "bbs/" . $r_code . "/" . $r_idx . "/" . $tmp['code']?>"
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
                                            <input type="file" name="files[]">
                                            <?php if ($code_info['r_use_file_list'] == "Y") { ?>
                                                <input type="button" class="btn_file_add" value="+">
                                                <input type="button" class="btn_file_del" value="-">
                                            <?php } ?>
                                            <br>
                                            내용 : <textarea name="file_desc[]"
                                                style="width:80%; height:60px;margin-top: 10px;"></textarea>
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
                                <a href="#!" class="btn btn-default" onClick="go_list();"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($r_idx == "") { ?>
                                    <a href="#!" class="btn btn-success" onClick="go_regist('new_ok');"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="#!" class="btn btn-primary" onClick="go_regist('mod_ok');"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <!-- <a href="#!" class="btn btn-danger" onClick="go_regist('del_ok');"><span class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a> -->
                                <?php } ?>
                            </li>
                        </ul>
                    </div>

                </form>

            </div>
        </div>

    </span><!-- print_this -->
</div><!-- container -->

<script>
    function send_it(type) {
        oEditors.getById["r_content"].exec("UPDATE_CONTENTS_FIELD", []);

        $("#frm_form").submit();
    }
</script>

<?= $this->endSection() ?>