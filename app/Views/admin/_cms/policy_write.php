<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <link rel="stylesheet" href="/AdmMaster/_common/css/sms_contents.css" type="text/css"/>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <style type="text/css">
        .radio_sel span {
            margin-right: 15px;
        }
    </style>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2>약관 및 정책</h2>
                    <div class="menus">
                        <ul>
                            <li><a href="./policy_list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($p_idx) { ?>
                                <li><a href="javascript:send_its()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                            <?php } else { ?>
                                <li><a href="javascript:send_its()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">신규등록</span></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <div id="contents">
                <div class="listWrap_noline">
                    <form name="frm" id="frm" action="policy_ok" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idx" value="<?=$p_idx?>">

                        <div class="listBottom">
                            <?php if (!empty($related_policies)) { ?>
                                <?php foreach ($related_policies as $index => $item) { ?>
                                    <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="95%">
                                        </colgroup>
                                        <caption>정책 <?= $item['p_idx'] ?></caption>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="hidden" name="p_idx[]" value="<?= $item['p_idx'] ?>">
                                                    <input type="text" name="policy_type[]" class="input_txt"
                                                        value="<?= $item['policy_type'] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>PC</th>
                                                <td>
                                                <textarea name="policy_contents[]" id="policy_contents_<?= $index ?>" rows="10" cols="100"
                                                    class="input_txt"
                                                    style="width:100%; height:400px; display:none;"><?= isset($item) ? viewSQ($item['policy_contents']) : '' ?></textarea>

                                                    <script type="text/javascript">
                                                        var oEditors<?= $index ?> = [];

                                                        // 추가 글꼴 목록
                                                        //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                                        nhn.husky.EZCreator.createInIFrame({
                                                            oAppRef: oEditors<?= $index ?>,
                                                            elPlaceHolder: "policy_contents_<?= $index ?>",
                                                            sSkinURI: "/smarteditor/SmartEditor2Skin.html",
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
                                                                //예제 코드
                                                                //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                                let editor = oEditors<?= $index ?>.getById["policy_contents_<?= $index ?>"];

                                                                let initContent = $("#policy_contents_<?= $index ?>").val().trim();

                                                                if (initContent === "" || initContent === "<p><br></p>" || initContent === "<p>&nbsp;</p>") {
                                                                    editor.setIR("");
                                                                }
                                                            },
                                                            fCreator: "createSEditor2"
                                                        });
                                                    </script>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>모바일</th>
                                                <td>
                                                <textarea name="policy_contents_m[]" id="policy_contents_m_<?= $index ?>" rows="10" cols="100"
                                                    class="input_txt"
                                                    style="width:100%; height:400px; display:none;"><?= isset($item) ? viewSQ($item['policy_contents_m']) : '' ?></textarea>

                                                    <script type="text/javascript">
                                                        var oEditors_m<?= $index ?> = [];

                                                        // 추가 글꼴 목록
                                                        //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                                        nhn.husky.EZCreator.createInIFrame({
                                                            oAppRef: oEditors_m<?= $index ?>,
                                                            elPlaceHolder: "policy_contents_m_<?= $index ?>",
                                                            sSkinURI: "/smarteditor/SmartEditor2Skin.html",
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
                                                                //예제 코드
                                                                //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                                let editor = oEditors_m<?= $index ?>.getById["policy_contents_m_<?= $index ?>"];

                                                                let initContent = $("#policy_contents_m_<?= $index ?>").val().trim();

                                                                if (initContent === "" || initContent === "<p><br></p>" || initContent === "<p>&nbsp;</p>") {
                                                                    editor.setIR("");
                                                                }
                                                            },
                                                            fCreator: "createSEditor3"
                                                        });
                                                    </script>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>

                            <?php } else {?>
                                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                    <input type="hidden" name="p_idx[]" value="<?= $p_idx ?>">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="95%">
                                        </colgroup>
                                    <caption>
                                    </caption>

                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="policy_type[]" id="policy_type" class="input_txt"
                                                style="width:400px;height:30px;"
                                                value="<?= isset($row) ? $row['policy_type'] : '' ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PC</th>
                                        <td>
                                    <textarea name="policy_contents[]" id="policy_contents" rows="10" cols="100"
                                            class="input_txt"
                                            style="width:100%; height:400px; display:none;"><?= isset($row) ? viewSQ($row['policy_contents']) : '' ?></textarea>

                                            <script type="text/javascript">
                                                var oEditors1 = [];

                                                // 추가 글꼴 목록
                                                //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                                nhn.husky.EZCreator.createInIFrame({
                                                    oAppRef: oEditors1,
                                                    elPlaceHolder: "policy_contents",
                                                    sSkinURI: "/smarteditor/SmartEditor2Skin.html",
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
                                                        //예제 코드
                                                        //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                        let editor = oEditors1.getById["policy_contents"];

                                                        let initContent = $("#policy_contents").val().trim();

                                                        if (initContent === "" || initContent === "<p><br></p>" || initContent === "<p>&nbsp;</p>") {
                                                            editor.setIR("");
                                                        }
                                                    },
                                                    fCreator: "createSEditor2"
                                                });
                                            </script>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>모바일</th>
                                    <td>
                                    <textarea name="policy_contents_m[]" id="policy_contents_m" rows="10" cols="100"
                                            class="input_txt"
                                            style="width:100%; height:400px; display:none;"><?= isset($row) ? viewSQ($row['policy_contents_m']) : '' ?></textarea>

                                            <script type="text/javascript">
                                                var oEditors3 = [];

                                                // 추가 글꼴 목록
                                                //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                                nhn.husky.EZCreator.createInIFrame({
                                                    oAppRef: oEditors3,
                                                    elPlaceHolder: "policy_contents_m",
                                                    sSkinURI: "/smarteditor/SmartEditor2Skin.html",
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
                                                        //예제 코드
                                                        //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                        let editor = oEditors3.getById["policy_contents_m"];

                                                        let initContent = $("#policy_contents_m").val().trim();

                                                        if (initContent === "" || initContent === "<p><br></p>" || initContent === "<p>&nbsp;</p>") {
                                                            editor.setIR("");
                                                        }
                                                    },
                                                    fCreator: "createSEditor3"
                                                });
                                            </script>
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </form>
                </div>
                <!-- // contents -->

            </div><!-- 인쇄 영역 끝 //-->
        </div>
        <!-- // container -->
    </div>
    <script>
        function send_its() {
            <?php if (!empty($related_policies)) { ?>
                var totalEditors = <?= count($related_policies) ?>;
                for (var i = 0; i < totalEditors; i++) {
                    if (window['oEditors' + i][0] && window['oEditors' + i][0]) {
                        window['oEditors' + i][0].exec("UPDATE_CONTENTS_FIELD", []);
                    }
                    if (window['oEditors_m' + i][0] && window['oEditors_m' + i][0]) {
                        window['oEditors_m' + i][0].exec("UPDATE_CONTENTS_FIELD", []);
                    }
                }
            <?php } else { ?>
                if (oEditors1 && oEditors1.getById["policy_contents"]) {
                    oEditors1.getById["policy_contents"].exec("UPDATE_CONTENTS_FIELD", []);
                }
                if (oEditors3 && oEditors3.getById["policy_contents_m"]) {
                    oEditors3.getById["policy_contents_m"].exec("UPDATE_CONTENTS_FIELD", []);
                }
            <?php } ?>

            $("#frm").submit();
        }


    </script>

<?= $this->endSection() ?>