<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<?php


$titleStr = "등록";
$cnt = 0;
if ($mode == "reply") {
    $subject = "[re]" . $row['subject'];
    $contents = "-------------------- 원본글 -------------------- <br>" . $row['contents'];
    $b_step = $row['b_step'];
    $b_level = $row['b_level'];
    $b_ref = $row['b_ref'];
    $secure_yn = $row['secure_yn'];
    $mode = "reply";
} elseif ($bbs_idx) {
    $writer = $row['writer'];
    $hit = $row['hit'];
    $subject = $row['subject'];
    $simple = $row['simple'];
    $notice_yn = $row['notice_yn'];
    $secure_yn = $row['secure_yn'];
    $recomm_yn = $row['recomm_yn'];
    $contents = $row['contents'];
    $category = $row['category'];
    $url = $row['url'];
    $cnt = 0;
    $ufile1 = $row['ufile1'];
    $rfile1 = $row['rfile1'];

    $ufile2 = $row['ufile2'];
    $rfile2 = $row['rfile2'];

    $ufile3 = $row['ufile3'];
    $rfile3 = $row['rfile3'];

    $ufile4 = $row['ufile4'];
    $rfile4 = $row['rfile4'];

    $ufile5 = $row['ufile5'];
    $rfile5 = $row['rfile5'];

    $ufile6 = $row['ufile6'];
    $rfile6 = $row['rfile6'];
    $wDate = $row['r_date'];


    if ($ufile1 != "") {
        $cnt = $cnt + 1;
    }
    if ($ufile2 != "") {
        $cnt = $cnt + 1;
    }
    if ($ufile3 != "") {
        $cnt = $cnt + 1;
    }
    if ($ufile4 != "") {
        $cnt = $cnt + 1;
    }
    if ($ufile5 != "") {
        $cnt = $cnt + 1;
    }
    if ($cnt < 1) {
        $cnt = 1;
    }
} else {
    $cnt = 1;
}

if ($writer == "") {
    $writer = "관리자";
}
?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2><?= $boardName ?></h2>
                    <div class="menus">
                        <ul class="last">
                            <li>
                                <a href="board_list.php?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $bbs_idx ?>&pg=<?= $pg ?>"
                                   class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                            class="txt">리스트</span></a></li>
                            <?php if ($bbs_idx) { ?>
                                <li><a href="javascript:send_it();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">수정</span></a></li>
                            <?php } else { ?>
                                <li><a href="javascript:send_it();" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a>
                                </li>
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
                        <input type=hidden name="code" value='<?= $code ?>'>
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
                                <tr <?php if ($skin == "faq" || $skin == "gallery" || $skin == "pds") { ?>style="display:none"<?php } ?>>
                                    <th>작성자</th>
                                    <td><input type="text" id="" name="writer" value='<?= $writer ?>'
                                               class="input_txt placeHolder" rel="" style="width:150px"/></td>
                                </tr>

                                <?php if ($_SESSION['member']['id'] == "admin" && $skin != "pds") { ?>
                                    <tr <?php if ($skin == "faq" || $skin == "gallery") { ?>style="display:none"<?php } ?>>
                                        <th>구분</th>
                                        <td>
                                            <?php if ($isNotice == "Y" && $_SESSION['member']['id'] == "admin") { ?>
                                                <input type="checkbox" id="notice_yn" name="notice_yn" value="Y"
                                                       class="input_check" <?php if ($notice_yn == "Y") {
                                                    echo "checked";
                                                } ?>/> 공지글 &nbsp;&nbsp;&nbsp;
                                            <?php } ?>
                                            <?php if ($isSecure == "Y") { ?>
                                                <input type="checkbox" id="secure_yn" name="secure_yn" value="Y"
                                                       class="input_check" <?php if ($secure_yn == "Y") {
                                                    echo "checked";
                                                } ?>/ >비밀글
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr style="display:none">
                                    <th>등록일</th>
                                    <td><input type="text" id="" name="wdate" value='<?= $wDate ?>'
                                               class="input_txt placeHolder" rel="2015-06-22 12:15:59"
                                               style="width:150px"/></td>
                                </tr>
                                <tr style="display:none">
                                    <th>조회</th>
                                    <td><input type="text" id="" name="hit" value='<?= $hit ?>'
                                               class="input_txt placeHolder" rel="145" style="width:60px" numberOnly/>
                                    </td>
                                </tr>
                                <tr <?php if ($skin == "pds") { ?>style="display:none"<?php } ?>>
                                    <th>제목</th>
                                    <td><input type="text" id="" name="subject" value='<?= $subject ?>'
                                               class="input_txt placeHolder" rel="" style="width:98%"/></td>
                                </tr>
                                <tr <?php if ($skin == "pds") { ?>style="display:none"<?php } ?>>
                                    <th>내용</th>
                                    <td>
									<textarea name="contents" id="contents_" rows="10" cols="100"
                                              style="width:100%; height:412px; display:none;"><?= $contents ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors,
                                                elPlaceHolder: "contents_",
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
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                </tr>
                                <?php if ($skin == "gallery") { ?>
                                    <tr>
                                        <th>썸네일첨부</th>
                                        <td colspan="3">
                                            <?php for ($i = 6; $i <= 6; $i++) { ?>
                                                <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                       style="width:500px;"/>
                                                <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                     name="del_<?= $i ?>"
                                                                                                     value='Y'><a
                                                    href="/include/dn.php?mode=bbs&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a><?php } ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr <?php if ($skin == "faq" || $skin == "gallery") { ?>style="display:none"<?php } ?>>
                                    <th>파일첨부</th>
                                    <td>
                                        <?php for ($i = 1; $i <= 1; $i++) { ?>
                                            <div class="layerA "
                                                 style="display:<?php if (${"ufile" . $i} == "") { ?>none<?php } ?>">
                                                <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                       style="width:500px;"/>
                                                <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                     name="del_<?= $i ?>"
                                                                                                     value='Y'><a
                                                    href="/include/dn.php?mode=bbs&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a><?php } ?>
                                            </div>
                                        <?php } ?>
                                        &nbsp;&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <?php if ($skin == "gallery") { ?>
                                    <tr>
                                        <th>유투브</th>
                                        <td><input type="text" id="url" name="url" value="<?= $url ?>"
                                                   class="input_txt placeHolder" rel="http://" style="width:98%"/><br>
                                            (예 : https://www.youtube.com/watch?v=pLFqeXm_5X4)
                                        </td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="last">
                                    <li>
                                        <a href="board_list.php?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $bbs_idx ?>&pg=<?= $pg ?>"
                                           class="btn btn-default"><span
                                                    class="glyphicon glyphicon-th-list"></span><span
                                                    class="txt">리스트</span></a></li>
                                    <?php if ($bbs_idx) { ?>
                                        <?php if ($mode != "reply" && $skin != "gallery") { ?>
                                            <li>
                                                <a href="board_write.php?mode=reply&scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $bbs_idx ?>&pg=<?= $pg ?>"
                                                   class="btn btn-default"><span class="glyphicon
									glyphicon-cog"></span><span class="txt">답글</span></a></li>
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
                                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                            </li>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <li><a href="javascript:send_it();" class="btn btn-primary"><span
                                                        class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a>
                                        </li>
                                    <?php } ?>
                                </ul>

                            </div>

                        </div><!-- // inner -->

                    </div><!-- // headerContainer -->
                </div><!-- // listWrap -->

            </div><!-- // contents -->


        </div><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->

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

        $(function () {
            $("#frm").ajaxForm({
                url: "bbs_proc.ajax.php",
                type: "POST",
                data: $("#frm").serialize(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response == "OK") {
                        <?php
                        if ($mode == "reply")
                        {
                        ?>
                        alert_("정상적으로 등록되었습니다.");
                        setTimeout(function () {
                            location.href = "board_list.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&bbs_idx=<?=$bbs_idx?>&pg=<?=$pg?>";
                        }, 1000);
                        <?php
                        } else if (isset($_GET['bbs_idx']) && $_GET['bbs_idx'] == "") {
                        ?>
                        alert_("정상적으로 등록되었습니다.");
                        setTimeout(function () {
                            location.href = "board_list.php?code=<?=$code?>";
                        }, 1000);
                        <?php } else { ?>
                        alert_("정상적으로 수정되었습니다.");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                        <?php } ?>
                        return;
                    } else if (response == "NF") {
                        alert_("업로드 금지 파일입니다.");
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });
        });

        function send_it() {
            var frm = document.frm;
            <?php
            if ($isCategory == "Y") {
            ?>
            <?php
            }
            ?>
            <?php if ($skin == "pds" ) {?>
            if (frm.ufile1.value == "") {
                alert("파일을 첨부해주셔야 합니다.");
                return;
            }
            <?php } else { ?>
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
            $("#ajax_loader").removeClass("display-none");
            <?php } ?>
            $("#frm").submit();
        }

        function del_chk(bbs_idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "bbs_del.ajax.php",
                type: "POST",
                data: "bbs_idx[]=" + bbs_idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
                    $("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response == "OK") {
                        alert_("정상적으로 삭제되었습니다.");
                        setTimeout(function () {
                            location.href = "board_list.php?code=<?=$code?>";
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

<?= $this->endSection() ?>