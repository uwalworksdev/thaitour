<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
    <link rel="stylesheet" href="/AdmMaster/_common/css/popup.css" type="text/css"/>
    <style>
        #input_file_ko {
            display: inline-block;
            width: 300px;
        }

        #input_file_ko button {
            margin-right: 5px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
    </style>

    <div id="container">
    <span id="print_this">
        <!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2><?= $board_name ?></h2>
                <div class="menus">
                    <ul class="last">
                        <!-- <li><a href="board_list.php?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $bbs_idx ?>&pg=<?= $pg ?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li> -->
                        <li><a href="javascript:history.back();" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
                        <?php if ($bbs_idx) { ?>
                            <li><a href="javascript:send_it();" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
                            <li><a href="javascript:del_chk('<?= $bbs_idx ?>');" class="btn btn-default"><span
                                            class="glyphicon glyphicon-trash"></span><span
                                            class="txt">삭제</span></a></li>
                        <?php } else { ?>
                            <li><a href="javascript:send_it();" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a></li>
                        <?php } ?>
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">
            <div class="listWrap_noline">
                <form name=frm id=frm action="bbs_proc.ajax.php" method=post enctype="multipart/form-data">
                    <input type=hidden name="bbs_idx" value='<?= $bbs_idx ?>'>
                    <input type=hidden name="article_num" value='<?= $cnt ?>'>
                    <input type=hidden name="search_mode" value='<?= $search_mode ?>'>
                    <input type=hidden name="search_word" value='<?= $search_word ?>'>
                    <input type=hidden name="scategory" value='<?= $scategory ?>'>
                    <input type=hidden name="code" id="code" value='<?= $code ?>'>
                    <input type=hidden name="b_step" value='<?= $b_step ?>'>
                    <input type=hidden name="b_level" value='<?= $b_level ?>'>
                    <input type=hidden name="b_ref" value='<?= $b_ref ?>'>
                    <input type=hidden name="pg" value='<?= $pg ?>'>
                    <input type=hidden name="mode" value='<?= $mode ?>'>
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <caption></caption>
                            <colgroup>
                                <col width="150px"/>
                                <col width="*"/>
                            </colgroup>

                            <tbody>
                                <tr <?php if (
                                    $skin == "faq" || $skin == "gallery" || $skin == "media" || $skin == "event" ||
                                    $skin == "winner" || $code == "main_event" || $code == "hashtag"
                                    ) { ?>style="display:none" <?php } ?>>
                                    <th>작성자</th>
                                    <td>
                                        <input type="text" id="" name="writer" value='<?= $writer ?>'
                                               class="input_txt placeHolder" rel="" style="width:150px"/>
                                    </td>
                                </tr>

                                <tr <?php if (
                                    $code == "faq" || $code == "as" || $code == "notice" || $skin == "gallery" ||
                                    $skin == "media" || $skin == "event" || $skin == "winner" || $code == "main_event" || $code == "hashtag"
                                ) { ?> style="display:none" <?php } ?>>
                                    <th>이메일</th>
                                    <td><input type="text" id="" name="email" value='<?= $email ?>'
                                               class="input_txt placeHolder" rel="" style="width:250px"/></td>
                                </tr>


                                <?php if ($isCategory == "Y") { ?>
                                    <tr style="height:40px">
                                        <th>구분</th>
                                        <td>
                                            <select name="category" class="input_select"
                                                    onchange="go_write(this.value);">
                                                <option value="">선택</option>
                                                <?php
                                                foreach ($list_category as $frow) {
                                                    ?>
                                                    <option value="<?= $frow["tbc_idx"] ?>" <?php if ($frow["tbc_idx"] == $scategory) {
                                                        echo "selected";
                                                    } ?>>
                                                        <?= $frow["subject"] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php if ($scategory == "42") { ?>
                                                <select name="category1" class="input_select">
                                                    <option value="">서브페이지</option>
                                                    <?php
                                                    foreach ($list_code as $frow_1) {
                                                        ?>
                                                        <option value="<?= $frow_1["code_no"] ?>" <?php if ($frow_1["code_no"] == $scategory1) {
                                                            echo "selected";
                                                        } ?>>
                                                            <?= $frow_1["code_name"] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>


                                <?php if ($isNotice == "Y" || $isSecure == "Y") { ?>
                                    <tr height="45" <?php if (
                                    $skin == "faq" || $skin == "gallery" || $skin == "media" ||
                                    $skin == "event"
                                    ) { ?>style="display:none" <?php } ?>>
                                        <th>구분</th>
                                        <td>
                                            <?php if ($isNotice == "Y") { ?>
                                                <input type="checkbox" id="notice_yn" name="notice_yn" value="Y"
                                                       class="input_check" <?php if ($notice_yn == "Y") {
                                                    echo "checked";
                                                } ?> /> 공지글
                                                &nbsp;&nbsp;&nbsp;
                                            <?php } ?>
                                            <?php if ($isSecure == "Y") { ?>
                                                <input type="checkbox" id="secure_yn" name="secure_yn" value="Y"
                                                       class="input_check" <?php if ($secure_yn == "Y") {
                                                    echo "checked";
                                                } ?> />비밀글
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr <?php if (
                                    $skin == "faq" || $skin == "gallery" || $skin == "media" || $skin == "event" ||
                                    $skin == "winner" || $code == "main_event" || $code == "hashtag"
                                    ) { ?>style="display:none" <?php } ?>>
                                    <th>등록일</th>
                                    <td><input type="text" id="" name="wdate" value='<?= $wDate ?>'
                                               class="input_txt placeHolder" rel="2015-06-22 12:15:59"
                                               style="width:200px"/></td>
                                </tr>
                                <?php if ($code != "banner") { ?>
                                    <tr <?php if ($skin == "faq" || $skin == "gallery" || $code == "main_event" || $code == "hashtag") { ?> style="display:none" <?php } ?>>
                                        <th>조회</th>
                                        <td><input type="text" id="" name="hit" value='<?= $hit ?>'
                                                   class="input_txt placeHolder" rel="145" style="width:60px"
                                                   numberOnly/>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <input type="hidden" id="" name="hit" value='<?= $hit ?>'
                                           class="input_txt placeHolder"
                                           rel="145" style="width:60px" numberOnly/>

                                <?php } ?>

                                <tr>
                                    <th>제목</th>
                                    <td><input type="text" id="" name="subject" value='<?= $subject ?>'
                                               class="input_txt placeHolder" rel="" style="width:98%"/></td>
                                </tr>

                                <?php if ($code == "event") { ?>
                                    <tr>
                                        <th>이벤트 기간</th>
                                        <td>
                                            <input type="text" id="s_date" name="s_date" value='<?= $s_date ?>'
                                                   class="datepicker input_txt" style="width:7%;" rel=""
                                                   style="width:98%"/> ~
                                            <input type="text" id="e_date" name="e_date" value='<?= $e_date ?>'
                                                   class="datepicker input_txt" style="width:7%" rel=""
                                                   style="width:98%"/>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if ($scategory == "1") { ?>
                                    <tr>
                                        <th>설명</th>
                                        <td><input type="text" id="" name="subject_e" value='<?= $subject_e ?>'
                                                   class="input_txt placeHolder" rel="" style="width:98%"/></td>
                                    </tr>
                                <?php } ?>

                                <?php if ($scategory == "40") { ?>
                                    <tr>
                                        <th>제목(영문)</th>
                                        <td><input type="text" id="" name="subject_e" value='<?= $subject_e ?>'
                                                   class="input_txt placeHolder" rel="" style="width:98%"/></td>
                                    </tr>
                                    <tr>
                                        <th>순위</th>
                                        <td><input type="text" id="" name="seq" value='<?= $seq ?>'
                                                   class="input_txt placeHolder" rel="" style="width:98%"/></td>
                                    </tr>
                                <?php } ?>

                                <?php if (($code == "banner") || $code == "hashtag" || $code == "main_event") { ?>
                                    <tr>
                                        <th>링크</th>
                                        <td><input type="text" id="" name="url" value='<?= $url ?>'
                                                   class="input_txt placeHolder" rel="" style="width:98%"/></td>
                                    </tr>
                                <?php } ?>

                                <?php if ($code != "banner" && $code != "hashtag" && $code != "main_event") { ?>
                                    <tr>
                                        <th>내용</th>
                                        <td>
                                            <textarea name="contents" id="contents_" rows="10" cols="100"
                                                      class="input_txt"
                                                      style="width:100%; height:412px; display:none;"><?= $contents ?></textarea>
                                            <script type="text/javascript">
                                                var oEditors = [];

                                                // 추가 글꼴 목록
                                                //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                                nhn.husky.EZCreator.createInIFrame({
                                                    oAppRef: oEditors,
                                                    elPlaceHolder: "contents_",
                                                    sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
                                                    htParams: {
                                                        bUseToolbar: true, // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                        bUseVerticalResizer: true, // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                        bUseModeChanger: true, // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                        //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                        fOnBeforeUnload: function () {
                                                            //alert("완료!");
                                                        }
                                                    }, //boolean
                                                    fOnAppLoad: function () {
                                                        //예제 코드
                                                        //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                    },
                                                    fCreator: "createSEditor2"
                                                });
                                            </script>
                                        </td>
                                    </tr>

                                    <?php if ($isReply == "Y") { ?>
                                        <tr>
                                            <th>답변</th>
                                            <td>
                                                <textarea name="reply" id="reply" rows="10" cols="150"
                                                          class=""><?= $reply ?></textarea>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                <?php } ?>
                                <?php if ($skin == "gallery" || $skin == "media" || $skin == "event" || $code == "main_event") { ?>
                                    <tr>
                                        <?php if ($scategory == "41") { ?>
                                            <th>썸네일 이미지첨부</th>
                                        <?php } else { ?>
                                            <?php if ($code == "banner") { ?>
                                                <th>PC 이미지(1200)</th>
                                            <?php } elseif ($code != "main_event") { ?>
                                                <th>이미지첨부</th>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($code != "main_event") { ?>
                                            <td>
                                                <?php for ($i = 6; $i <= 6; $i++) { ?>
                                                    <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                           style="width:500px;"/>
                                                    <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                         name="del_<?= $i ?>"
                                                                                                         value='Y'><a
                                                            href="/include/dn.php?mode=bbs&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if ($code == "banner") { ?>
                                                    <!--갤러리 이미지 사이즈-->


                                                <?php } else if ($skin == "gallery") { ?>
                                                    <!--갤러리 이미지 사이즈-->
                                                    <span class="img_size_noti">* 이미지 사이즈: 310px * 211px</span>
                                                <?php } else if ($skin == "media") { ?>
                                                    <!--미디어 이미지 사이즈-->
                                                    <span class="img_size_noti">* 이미지 사이즈: 150px * 103px</span>
                                                <?php } else if ($skin == "event") { ?>
                                                    <!--이벤트 이미지 사이즈-->
                                                    <span class="img_size_noti">* 이미지 사이즈: 413px * 207px</span>


                                                <?php } ?>


                                                <?php if ($code == "banner") {
                                                    $_banner_size["16"] = "450px * 310px";
                                                    $_banner_size["1"] = "585px * 340px";
                                                    $_banner_size["14"] = "1180px * 105px";
                                                    $_banner_size["15"] = "1180px * 105px";
                                                    $_banner_size["2"] = "340px * 370px";
                                                    $_banner_size["10"] = "561px * 312px";
                                                    $_banner_size["11"] = "132px * 32px";
                                                    $_banner_size["12"] = "132px * 32px";
                                                    $_banner_size["13"] = "132px * 32px";
                                                    $_banner_size["25"] = "132px * 32px";
                                                    $_banner_size["18"] = "680px * 340px";
                                                    $_banner_size["20"] = "980px * 175px";
                                                    $_banner_size["21"] = "980px * 175px";
                                                    $_banner_size["22"] = "980px * 175px";
                                                    $_banner_size["23"] = "980px * 175px";
                                                    $_banner_size["24"] = "980px * 175px";

                                                    $_banner_size["17"] = "450px * ";
                                                    $_banner_size["19"] = "1920px * 50px";
                                                    ?>
                                                    <!--배너 이미지 사이즈-->

                                                    <span class="img_size_noti">* 이미지 사이즈: <?= $_banner_size[$scategory] ?></span>

                                                <?php } ?>

                                            </td>
                                        <?php } ?>
                                        <?php if ($code == "main_event") { ?>
                                            <table cellpadding="0" cellspacing="0" summary="" class="listTable"
                                                   style="width: 100%">
                                                <caption></caption>
                                                <colgroup>
                                                    <col width="*"/>
                                                    <col width="50px"/>
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th>이미지첨부</th>
                                                        <th>파일첨부</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="height:45px;padding:5px">
                                                        <td id="imagePreview">
                                                            <?php for ($i = 6; $i <= 6; $i++) { ?>
                                                                <?php if (${"ufile" . $i} != "") { ?>
                                                                    <img src="/data/bbs/<?= ${"ufile" . $i} ?>"
                                                                         style="max-height:200px">
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="text-align: left !important; padding-left: 30px">
                                                            <?php for ($i = 6; $i <= 6; $i++) { ?>
                                                                <input type="file" name="ufile<?= $i ?>"
                                                                       class="bbs_inputbox_pixel"
                                                                       style="width:300px;"
                                                                       onchange="previewImage(event, <?= $i ?>)"
                                                                       accept="ko"/>
                                                                <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input
                                                                        type=checkbox
                                                                        name="del_<?= $i ?>" value='Y'><a
                                                                        href="/include/dn.php?mode=bbs&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <script>
                                                    function previewImage(event, index) {
                                                        var input = event.target;
                                                        var reader = new FileReader();
                                                        reader.onload = function () {
                                                            var imgPreview = document.getElementById('imagePreview');
                                                            while (imgPreview.firstChild) {
                                                                imgPreview.removeChild(imgPreview.firstChild);
                                                            }
                                                            var img = document.createElement('img');
                                                            img.src = reader.result;
                                                            img.style.maxHeight = '200px';
                                                            imgPreview.appendChild(img);
                                                        };
                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                </script>
                                            </table>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>


                                <?php if ($code == "event") { ?>
                                    <input type="hidden" name="bbs_idx" id="bbs_idx" value="<?= $bbs_idx ?>">
                                    <tr>
                                        <th>관련상품</th>
                                        <td>
                                            <div class="list_up" style="margin: 10px 0">
                                                <div>
                                                    <button type="button" class="btn btn-list">상품등록</button>
                                                </div>
                                            </div>
                                            <!-- <input type="text" disabled> -->
                                            <div id="pick_select_layer"
                                                 style="display:flex; gap: 10px; flex-wrap: wrap">
                                                <?php
                                                foreach ($event_list as $row) {
                                                    ?>
                                                    <div class="event_list"
                                                         style="display: flex; gap: 5px; border: 1px solid #dbdbdb; padding: 10px">
                                                        <?= $row['product_code'] ?>
                                                        <a href="javascript:goods_del('<?= $row['code_idx'] ?>');"><img
                                                                    src="/AdmMaster/_images/common/ico_error.png"
                                                                    alt="삭제"></a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>


                                <?php } ?>



                                <?php if ($code == "banner") { ?>
                                    <tr>
                                        <th>모바일 이미지(660)</th>
                                        <td>
                                            <?php for ($i = 5; $i <= 5; $i++) { ?>
                                                <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                       style="width:500px;"/>
                                                <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                     name="del_<?= $i ?>"
                                                                                                     value='Y'><a
                                                        href="/include/dn.php?mode=bbs&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a>
                                                <?php } ?>
                                            <?php } ?>

                                            <?php if ($code == "banner") { ?>
                                                <!--갤러리 이미지 사이즈-->


                                            <?php } else if ($skin == "gallery") { ?>
                                                <!--갤러리 이미지 사이즈-->
                                                <span class="img_size_noti">* 이미지 사이즈: 310px * 211px</span>
                                            <?php } else if ($skin == "media") { ?>
                                                <!--미디어 이미지 사이즈-->
                                                <span class="img_size_noti">* 이미지 사이즈: 150px * 103px</span>
                                            <?php } else if ($skin == "event") { ?>
                                                <!--이벤트 이미지 사이즈-->
                                                <span class="img_size_noti">* 이미지 사이즈: 413px * 207px</span>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if ($code == "news" || $code == "ad" || $code == "hashtag") { ?>
                                    <tr>
                                        <th>썸네일 이미지</th>
                                        <td>
                                            <?php for ($i = 1; $i <= 1; $i++) { ?>
                                                <div class="layerA ">
                                                    <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                           style="width:500px;"/>
                                                    <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                         name="del_<?= $i ?>"
                                                                                                         value='Y'><a
                                                            href="/include/dn.php?mode=bbs&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                    </tr>

                                    <?php if ($code == "hashtag") { ?>
                                        <th>썸네일 이미지 mobile</th>
                                        <td>
                                            <?php for ($i = 2; $i <= 2; $i++) { ?>
                                                <div class="layerA ">
                                                    <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                           style="width:500px;"/>
                                                    <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                         name="del_<?= $i ?>"
                                                                                                         value='Y'><a
                                                            href="/include/dn.php?mode=bbs&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                    <?php } ?>
                                    <?php if ($code != "hashtag") { ?>
                                        <th>파일첨부</th>
                                        <td>
                                            <?php for ($i = 2; $i <= 6; $i++) { ?>
                                                <div class="layerA ">
                                                    <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                           style="width:500px;"/>
                                                    <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                         name="del_<?= $i ?>"
                                                                                                         value='Y'><a
                                                            href="/include/dn.php?mode=bbs&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                        </tr>
                                    <?php }
                                } ?>


                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="last">
                                <!-- <li><a href="board_list.php?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $bbs_idx ?>&pg=<?= $pg ?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li> -->
                                <li><a href="javascript:history.back();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                </li>
                                <?php if ($bbs_idx) { ?>
                                    <?php if ($mode != "reply" && $skin != "gallery") { ?>
                                        <!--
                                    <li><a href="board_write.php?mode=reply&scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $bbs_idx ?>&pg=<?= $pg ?>" class="btn btn-default"><span class="glyphicon
                                    glyphicon-cog"></span><span class="txt">답글</span></a></li>
                                    -->

                                        <li><a href="javascript:send_it();" class="btn btn-default"><span
                                                        class="glyphicon glyphicon-cog"></span><span
                                                        class="txt">수정</span></a></li>
                                    <?php } else { ?>
                                        <li><a href="javascript:send_it();" class="btn btn-default"><span
                                                        class="glyphicon glyphicon-cog"></span><span
                                                        class="txt">수정</span></a></li>
                                    <?php } ?>
                                    <?php if ($mode != "reply") { ?>
                                        <li><a href="javascript:del_chk('<?= $bbs_idx ?>');"
                                               class="btn btn-default"><span
                                                        class="glyphicon glyphicon-trash"></span><span
                                                        class="txt">삭제</span></a>
                                        </li>
                                    <?php } ?>
                                <?php } else { ?>
                                    <li><a href="javascript:send_it();" class="btn btn-primary"><span
                                                    class="glyphicon glyphicon-pencil"></span> <span
                                                    class="txt">글 등록</span></a>
                                    </li>
                                <?php } ?>
                            </ul>

                        </div>

                    </div><!-- // inner -->

                </div><!-- // headerContainer -->
            </div><!-- // listWrap -->

        </div><!-- // contents -->
        <div class="pick_item_pop02" id="item_pop" style="display:none;">
            <div>
                <h2>이벤트 상품등록</h2>
                <div class="search_box">

                    <form name="pick_item_search" id="pick_item_search">
                        <input type="hidden" name="upd_code" id="upd_code" value="<?= $code ?>">
                        <select id="product_code_1" name="product_code_1" class="input_select"
                                onchange="javascript:get_code(this.value, 3)">
                            <option value="">1차분류</option>
                            <?php
                            foreach ($list_code2_exclude as $frow) {
                                $status_txt = "";
                                if ($frow["status"] == "Y") {
                                    $status_txt = "";
                                } elseif ($frow["status"] == "N") {
                                    $status_txt = "[삭제]";
                                } elseif ($frow["status"] == "C") {
                                    $status_txt = "[마감]";
                                }

                                ?>
                                <option value="<?= $frow["code_no"] ?>" <?php if ($product_code_1 == $frow["code_no"]) {
                                    echo "selected";
                                } ?>><?= $frow["code_name"] ?>     <?= $status_txt ?></option>
                            <?php } ?>

                        </select>
                        <select id="product_code_2" name="product_code_2" class="input_select"
                                onchange="javascript:get_code(this.value, 4)">
                            <option value="">2차분류</option>
                            <?php
                            foreach ($list_code3 as $frow) {
                                $status_txt = "";
                                if ($frow["status"] == "Y") {
                                    $status_txt = "";
                                } elseif ($frow["status"] == "N") {
                                    $status_txt = "[삭제]";
                                } elseif ($frow["status"] == "C") {
                                    $status_txt = "[마감]";
                                }

                                ?>
                                <option value="<?= $frow["code_no"] ?>" <?php if ($product_code_2 == $frow["code_no"]) {
                                    echo "selected";
                                } ?>><?= $frow["code_name"] ?>     <?= $status_txt ?></option>
                            <?php } ?>
                        </select>
                        <select id="product_code_3" name="product_code_3" class="input_select">
                            <option value="">3차분류</option>
                            <?php
                            foreach ($list_code4 as $frow) {
                                $status_txt = "";
                                if ($frow["status"] == "Y") {
                                    $status_txt = "";
                                } elseif ($frow["status"] == "N") {
                                    $status_txt = "[삭제]";
                                } elseif ($frow["status"] == "C") {
                                    $status_txt = "[마감]";
                                }

                                ?>
                                <option value="<?= $frow["code_no"] ?>" <?php if ($product_code_3 == $frow["code_no"]) {
                                    echo "selected";
                                } ?>><?= $frow["code_name"] ?>     <?= $status_txt ?></option>
                            <?php } ?>
                        </select>
                        <select id="search_category" name="search_category" class="input_select" style="width:112px">
                            <!-- <option value="goods_name_front">상품명</option> -->
                            <option value="product_name">상품명</option>
                            <option value="product_code">상품코드</option>
                            <!-- <option value="goods_code">상품코드</option> -->
                        </select>
                        <input type="text" id="search_txt" name="search_txt" value="" class="input_txt placeHolder"
                               placeholder="검색어 입력" style="width:240px">
                        <a href="javascript:search_it()" class="btn btn-default"><span
                                    class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                    </form>
                </div>
                <div class="table_box">
                    <form method="post" name="select_pick_frm" id="select_pick_frm">
                        <input type="hidden" name="isrt_code" id="isrt_code" value="<?= $bbs_idx ?>">
                        <table>
                            <caption>상품찾기</caption>
                            <colgroup>
                                <col style="width: 5%;">
                                <col>
                                <col style="width: 20%;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>상품명</th>
                                    <th>코드</th>
                                </tr>
                            </thead>
                            <tbody id="id_contents">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="sel_box">
                    <button type="button" class="close">닫기</button>
                    <button type="button" class="select_all">전체선택</button>
                    <button type="button" onclick="fn_pick_update();" class="search">등록</button>
                </div>
                </form>
            </div>
        </div>
        <!-- <div class="inner cmt_area" style="">
            <form action="" id="frm" name="com_form" class="com_form">
                <input type="hidden" name="code" id="code" value="<?= $code ?>">
                <input type="hidden" name="r_code" id="r_code" value="<?= $code ?>">
                <input type="hidden" name="r_idx" id="r_idx" value="<?= $bbs_idx ?>">
                <div class="comment_box-input flex">
                    <textarea class="cmt_input" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
                    <button type="button" class="btn btn-point comment_btn" onclick="fn_comment()">등록</button>
                </div>
            </form>
            <div id="comment_list"></div>
        </div> -->
        <div class="inner cmt_area">
            <form name="com_form" id="com_form" method="post" onsubmit="return false" class="com_form">
                <input type="hidden" name="code" id="code" value="<?= $code ?>">
                <input type="hidden" name="bbs_idx" id="bbs_idx" value="<?= $bbs_idx ?>">
                <input type="hidden" name="tbc_idx" id="tbc_idx" value="">
                <div class="comment_box-input flex">
                    <textarea style="resize:none" name="comment" class="cmt_input" id="contents"
                              placeholder="댓글을 입력해주세요."></textarea>
                    <button type="button" onclick="fn_comment();" class="btn btn-point comment_btn">등록</button>
                </div>
            </form>
            <div id="comment_list">
                <table class="comment">
                    <colgroup>
                        <col width='20%'>
                        <col width='70%'>
                        <col width='10%'>
                    </colgroup>
                    <tbody>
                        <?php
                        foreach ($list_comment as $row_c) {
                            $is_reported = !!$row_c['report_idx'];
                            $should_show = $row_c['report_state'] == '2';
                            ?>
                            <input type="hidden" name="comment_<?= $row_c['tbc_idx'] ?>"
                                   id="comment_<?= $row_c['tbc_idx'] ?>" value="<?= $row_c['comment'] ?>">
                            <tr class="<?= ($is_reported && !$should_show ? "reported" : "") ?>"
                                style="position: relative;">
                                <td>
                                    <?php
                                    if ($row_c['user_level'] == 1) {
                                        $avt_img = "/img/ico/hi_avatar.jpg";
                                    } else if ($row_c['avt_new'] != '' && $row_c['user_level'] == 2) {
                                        $avt_img = '/data/member/' . $row_c['avt_new'];
                                    } else {
                                        $avt_img = '/assets/img/event/user_2.png';
                                    }
                                    ?>
                                    <div class="user_info">
                                        <img src="<?= $avt_img ?>" class="user_avatar" width="100px" height="100px"
                                             alt="">
                                        <div class="user_info_1">
                                            <p class="user-name">
                                                <?= $row_c['user_name'] ?>
                                            </p>
                                            <p>
                                                <?= $row_c['user_phone'] ?>
                                            </p>
                                            <p>
                                                <?= $row_c['user_email'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-comment" id="rrp_content_<?= $row_c['tbc_idx'] ?>">
                                        <?= nl2br($row_c['comment']) ?>
                                    </div>

                                    <div class="comment-input write_box flex" id="rrp_edit_<?= $row_c['tbc_idx'] ?>"
                                         style="display: none;" tabindex="0"
                                         onblur="handleBlurEdit('<?= $row_c['tbc_idx'] ?>')">
                                        <input type="hidden" value="<?= $row_c['tbc_idx'] ?>">
                                        <textarea onblur="handleBlurEdit1('<?= $row_c['tbc_idx'] ?>')" class="cmt_input"
                                                  style="width:1100px;" tabindex="0" name="comment" id="contents"
                                                  placeholder="댓글을 입력해주세요."><?= viewSQ($row_c['comment']) ?></textarea>
                                        <button type="button" class="btn btn-point btn-lg comment_btn"
                                                onclick="handleCmtEditSubmit(event, <?= $row_c['tbc_idx'] ?>)">수정</button>
                                    </div>
                                    <p class="cmt_date">
                                        <?= date("Y.m.d H:i", strtotime($row_c['r_date'])) ?>
                                    </p>
                                </td>
                                <td class="user-operation">
                                    <?php if ($is_reported) { ?>
                                        <select name="report_state" id="report_state"
                                                onchange="handleUpdateReportState('<?= $row_c['report_idx'] ?>', this.value)">
                                            <option value="0" <?= ($row_c['report_state'] == "0" ? "selected" : "") ?>>신고접수</option>
                                            <option value="1" <?= ($row_c['report_state'] == "1" ? "selected" : "") ?>>비노출</option>
                                            <option value="2" <?= ($row_c['report_state'] == "2" ? "selected" : "") ?>>계속노출</option>
                                        </select>
                                    <?php } ?>
                                    <?php if ((session('member.idx') == $row_c['m_idx'])) { ?>
                                        <button type="button"
                                                onclick="handleCmtEdit('<?= $row_c['tbc_idx'] ?>')">수정</button>
                                    <?php } ?>
                                    <?php if ((session('member.idx') == $row_c['m_idx']) || session('member.id') == "admin") { ?>
                                        <button type="button"
                                                onclick="commentDelete(<?= $row_c['tbc_idx'] ?>)">삭제</button>
                                    <?php } ?>
                                    <?php if ($is_reported && !$should_show) { ?>
                                        <div class="report_area">
                                            이 댓글이 신고된 댓글입니다. <br>
                                            신고사유 : <?= $row_c['report_reason'] ?>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>




    </span><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->


    <script type="text/javascript">
        function checkForNumber(str) {
            var key = event.keyCode;
            var frm = document.frm1;
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }


        $(function () {
            $.datepicker.regional['ko'] = {
                showButtonPanel: true,
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $(
                            '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                        );
                        btn.unbind("click").bind("click", function () {
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
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $(
                            '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                        );
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                },
                dateFormat: 'yy-mm-dd',
                showOn: "both",
                yearRange: "c-100:c+10",
                buttonImage: "/AdmMaster/_images/common/date.png",
                buttonImageOnly: true,
                closeText: '닫기',
                prevText: '이전',
                nextText: '다음'

            });
            $('img.ui-datepicker-trigger').css({
                'cursor': 'pointer'
            });
            $('input.hasDatepicker').css({
                'cursor': 'pointer'
            });
        });
    </script>


    <script>
        function ShowArticleAdd(str) {
            var cnt = document.frm.article_num.value;
            if (str == "+") {

                if (cnt < 5) {
                    var row_num = parseInt(cnt) + 1;
                    document.frm.article_num.value = row_num;
                    for (i = 0; i < row_num; i++) {
                        $(".layerA:eq(" + i + ")").show();
                    }
                }
            } else if (str == "-") {
                if (cnt != 0) {
                    $(".layerA:eq(" + cnt + ")").hide();
                    var row_num = parseInt(cnt) - 1;
                    document.frm.article_num.value = row_num;
                }
            }
        }

        for (i = 0; i < document.frm.article_num.value; i++) {
            //$(".layerA:eq("+i+")").show();
            $(".layerA:eq(" + i + ")").show();
            //document.all.layerA[i].style.display="";
        }


        function send_it() {
            var frm = document.frm; <?php
            if ($isCategory == "Y") {
            ?>
            /*
        if (frm.category.value == "")
        {
            frm.category.focus();
            alert_("구분을 선택해주세요.");
            return;

        }
            */
            <?php
            }


            if ($code != "banner" && $code != "hashtag" && $code != "main_event") {
            ?>
            if (frm.subject.value == "") {
                frm.subject.focus();
                alert_("제목을 입력해주세요.");
                return;

            }
            if (frm.writer.value == "") {
                frm.writer.focus();
                alert_("작성자를 입력해주세요.");
                return;

            }

            oEditors.getById["contents_"].exec("UPDATE_CONTENTS_FIELD", []);
            if (frm.contents.length < 2) {
                frm.contents.focus();
                alert_("내용을 입력하셔야 합니다.");
                return;
            }

            <?php
            } ?>

            /*
                    var f = document.frm;

                    var bbs_data = $(f).serialize();
                    var save_result = "";
                    $.ajax({
                        type  : "POST",
                        data  : bbs_data,
                        url   :  "./ajax_bbs_proc.php",
                        cache : false,
                        async : false,
                        success: function(data, textStatus) {
                            save_result = data;
                            alert('save_result- '+save_result);
                            var obj = jQuery.parseJSON(save_result);
                            var message = obj.message;
                            alert(message);
                        },
                        error:function(request,status,error){
                            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                        }
                    });
            */
            var image_form = document.getElementById('frm');
            formData = new FormData(image_form);
            $.ajax({
                url: "ajax_bbs_proc",
                type: "post",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
            }).done(function (data) {
                //document.getElementById('image-url').innerHTML = data;
                save_result = data;
                //alert('save_result- '+save_result);
                var obj = jQuery.parseJSON(save_result);
                var message = obj.message;
                alert(message);
                // location.reload();
                window.history.back();
            });

        }

        function del_chk(bbs_idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            var code = $("#code").val();

            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "bbs_del.ajax.php",
                type: "POST",
                data: "bbs_idx[]=" + bbs_idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                },
                complete: function (request, status, error) {
                    $("#ajax_loader").addClass("display-none");
                },
                success: function (response, status, request) {
                    if (response == "OK") {
                        alert("정상적으로 삭제되었습니다.");
                        setTimeout(function () {
                            if (code == "banner") {
                                location.href = "/AdmMaster/_bbsBanner/list.php?code=banner";
                            } else {
                                location.href = "board_list.php?code=<?= $code ?>&scategory=<?= $scategory ?>";
                            }
                        }, 1000);
                        return;
                    } else {
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });


        }
    </script>

    <script>
        function go_write(cate) {
            var code = '<?= $code ?>';
            location.href = '/AdmMaster/_bbs/board_write.php?code=' + code + '&scategory=' + cate
        }
    </script>
    <script>
        let first_select_all = true;
        $(".select_all").click(function () {
            if ($("#select_pick_frm .idx").is(":checked") && !first_select_all) {
                $("#select_pick_frm .idx").prop('checked', false);
                $(this).text("전체선택")
            } else {
                $("#select_pick_frm .idx").prop('checked', true);
                $(this).text("선택해체")
            }
            first_select_all = false;
        })

        function get_code(strs, depth) {
            $.ajax({
                type: "GET"
                , url: "/AdmMaster/_tourRegist/get_code.ajax.php"
                , dataType: "html" //전송받을 데이터의 타입
                , timeout: 30000 //제한시간 지정
                , cache: false  //true, false
                , data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth //서버에 보낼 파라메터
                , error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (json) {
                    //alert(json);
                    if (depth <= 3) {
                        $("#product_code_2").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_2").append("<option value=''>2차분류</option>");
                    }
                    if (depth <= 4) {
                        $("#product_code_3").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_3").append("<option value=''>3차분류</option>");
                    }
                    if (depth <= 4) {
                        $("#product_code_4").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_4").append("<option value=''>4차분류</option>");
                    }
                    var list = $.parseJSON(json);
                    var listLen = list.length;
                    var contentStr = "";
                    for (var i = 0; i < listLen; i++) {
                        contentStr = "";
                        if (list[i].code_status == "C") {
                            contentStr = "[마감]";
                        } else if (list[i].code_status == "N") {
                            contentStr = "[사용안함]";
                        }
                        $("#product_code_" + (parseInt(depth) - 1)).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                    }
                }
            });
        }
    </script>
    <script>
        $(function () {

            $('.list_up .btn-list').on('click', function () {

                //$("#pick_select_layer tbody").html('');

                // $('.pick_item_pop02').show();

                let code = $("#bbs_idx").val();
                var inq_sw = "fst";
                const product_code_no = '<?= $product_code_no ?>';

                $.ajax({

                    url: "./goods_find.php",
                    type: "POST",
                    data: {
                        "code_no": code,
                        "inq_sw": inq_sw
                    },
                    error: function (request, status, error) {
                        //통신 에러 발생시 처리
                        alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        $("#ajax_loader").addClass("display-none");
                    }
                    , complete: function (request, status, error) {

                    }
                    , success: function (response, status, request) {
                        if (product_code_no) {
                            $("#pick_item_search").html(`
                            <h1><?= $product_code_name ?></h1>
                        `);
                        }
                        $("#id_contents").empty();
                        $("#id_contents").append(response);
                        $('.pick_item_pop02').show();


                    }
                });


            })


            $('.pick_item_pop02 .sel_box .close').on('click', function () {
                $('.pick_item_pop02').hide()
            })

        });

        function fn_pick_update() {

            var f = document.select_pick_frm;

            var pick_data = $(f).serialize();
            var save_result = "";
            $.ajax({
                type: "POST",
                data: pick_data,
                url: "./event_update.ajax.php",
                cache: false,
                async: false,
                success: function (data, textStatus) {
                    save_result = data;
                    //alert('save_result- '+save_result);
                    var obj = jQuery.parseJSON(save_result);
                    var message = obj.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        // function fn_pick_select() {

        // if($(".idx").is(":checked") == false) {
        //     alert("상품을 선택해 주세요.");
        //     return;
        // }


        // $.ajax({

        //     url: "./pick_select.ajax.php",
        //     type: "POST",
        //     dataType: "html",
        //     data: $("#select_pick_frm").serialize(),
        //     error : function(request, status, error) {
        //         //통신 에러 발생시 처리
        //         alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
        //         $("#ajax_loader").addClass("display-none");
        //     }
        //     ,complete: function(request, status, error) {
        //         $("#ajax_loader").addClass("display-none");
        //     }
        //     , success : function(response, status, request) {
        //         let tmpHtml = $("#pick_select_layer tbody").html();
        //         tmpHtml += response;
        //         $("#pick_select_layer tbody").html(tmpHtml);
        //         $("#item_pop").hide();

        //     }
        // });

        // }


        function search_it() {


            let code = $("#code_").val();
            let product_code_1 = $("#product_code_1").val();
            let product_code_2 = $("#product_code_2").val();
            let product_code_3 = $("#product_code_3").val();
            let search_category = $("#search_category").val();
            let search_txt = $("#search_txt").val();

            $.ajax({

                url: "./item_allfind.php",
                type: "POST",
                data: {
                    "code": code,
                    "product_code_1": product_code_1,
                    "product_code_2": product_code_2,
                    "product_code_3": product_code_3,
                    "search_category": search_category,
                    "search_txt": search_txt,

                },
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {

                }
                , success: function (response, status, request) {

                    $("#id_contents").empty();
                    $("#id_contents").append(response);
                    $('.pick_item_pop02').show();
                }
            });
        }

        function goods_del(idx) {
            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?"))
                return false;

            var message = "";
            $.ajax({

                url: "./ajax.product_del.php",
                type: "POST",
                data: {
                    "idx": idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }

            });
        }

        function fn_comment() {

            <?php
            if ($_SESSION["member"]["id"] != "") {
            ?>
            if ($("#comment").val() == "") {
                alert("댓글을 입력해주세요.");
                $("#comment").focus()
                return;
            }

            var queryString = $("form[name=com_form]").serialize();
            var message = "";
            $.ajax({

                url: "<?= route_to('admin.api.bbs.comment_proc')?>",
                type: "POST",
                data: queryString,
                async: true,
                cache: false,
                success: function (data, textStatus) {
                    // message = data.message;
                    // alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    console.log(request)
                    alert("code = " + request.status + " \n message = " + request.responseText + " \n error = " +
                        error); // 실패 시 처리
                }
            });
            <?php
            } else {
            ?>
            alert("로그인을 해주세요."); <?php
            } ?>
        }
    </script>
    <script src="./comment.js"></script>
<?php
if ($is_comment == "Y" && $bbs_idx != "") {
    //		include "./notice_comment.inc.php";
}
?>

<?= $this->endSection() ?>