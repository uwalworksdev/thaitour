<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<?php

$titleStr = "생성";
if ($s_parent_code_no == "") {
    $parent_code_no = "0";
} else {
    $parent_code_no = $s_parent_code_no;
}
if ($code_idx) {
    $code_no = $row["code_no"];
    $code_name = $row["code_name"];
    $status = $row["status"];
    $onum = $row["onum"];
    $rolling_yn = $row["rolling_yn"];
    $titleStr = "수정";
} else {
    $depth = $row["depth"] + 1;
    $code_gubun = $row["code_gubun"];

    $code_no = $row2["code_no"];
    $onum = 0;
}
?>
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
            var frm = document.frm;
            frm.submit();
        }
    </script>


    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2>카테고리 배너관리 </h2>
                    <div class="menus">
                        <ul>
                            <li><a href="javascript:history.back();" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($code_idx) { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                            <?php } else { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
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
                    <form name=frm action="write_ok.php" method=post enctype="multipart/form-data" target="hiddenFrame">
                        <input type=hidden name="code_no" value='<?= $code_no ?>'>
                        <input type=hidden name="code_idx" value='<?= $code_idx ?>'>
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>

                                <tr>
                                    <th>코드NO</th>
                                    <td>
                                        <?= $code_no ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>코드명</th>
                                    <td>
                                        <?= $code_name ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>롤링현황</th>
                                    <td>
                                        <input type="radio" name="rolling_yn" value="Y" <?php if ($rolling_yn == "Y") {
                                            echo "checked";
                                        } ?>> 사용&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="rolling_yn" value="N" <?php if ($rolling_yn == "N") {
                                            echo "checked";
                                        } ?>> 미사용&nbsp;&nbsp;&nbsp;
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <!-- // listBottom -->


                        <div class="tail_menu">
                            <ul>
                                <li class="left"></li>
                                <li class="right_sub">

                                    <a href="javascript:history.back();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                    <?php if ($code_idx == "") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <?php } else { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <!--
                                        <a href="javascript:del_it()" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                        -->
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </form>


                    <form name="frm1" action="file_ok.php" method=post enctype="multipart/form-data"
                          target="hiddenFrame">
                        <input type=hidden name="code_no" value='<?= $code_no ?>'>
                        <input type=hidden name="code_idx" value='<?= $code_idx ?>'>
                        <h3>배너이미지 </h3>
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>파일첨부</th>
                                    <td>
                                        <input type="text" name="onum" class="bbs_inputbox_pixel" style="width:50px"
                                               value="0"/>
                                        (우선순위)
                                    </td>
                                    <td>
                                        <input type="text" name="url" class="bbs_inputbox_pixel" style="width:400px"
                                               value=""
                                               placeholder="URL을 입력하셔야 합니다."/>
                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                               style="width:400px"/>
                                        <a href="javascript:file_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">이미지첨부</span></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="70px"/>
                                <col width="*"/>
                                <col width="350px"/>
                                <col width="100px"/>
                                <col width="100px"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>이미지</th>
                                <th>파일첨부</th>
                                <th>우선순위</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <?php
                            $i = 1;
                            foreach ($row3 as $row) {
                                ?>
                                <form name="frm_<?= $i ?>" action="file_update.php" method=post
                                      enctype="multipart/form-data" target="hiddenFrame">
                                    <input type=hidden name="code_no" value='<?= $code_no ?>'>
                                    <input type=hidden name="cb_idx" value='<?= $row["cb_idx"] ?>'>
                                    <tbody>
                                    <tr style="height:45px;padding:5px">
                                        <td><?= $i ?></td>
                                        <td><a href="/data/catebanner/<?= $row["ufile1"] ?>" class="imgpop"><img
                                                        src="/data/catebanner/<?= $row["ufile1"] ?>"
                                                        style="max-height:200px"></a></td>
                                        <td>
                                            <input type="text" name="url" class="bbs_inputbox_pixel" style="width:300px"
                                                   value="<?= $row["url"] ?>" placeholder="URL을 입력하셔야 합니다."/><br><br>
                                            <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                                   style="width:300px"/></td>
                                        <td><input type="text" name="onum" class="bbs_inputbox_pixel" style="width:50px"
                                                   value="<?= $row["onum"] ?>"/></td>
                                        <td>
                                            <a href="javascript:document.frm_<?= $i ?>.submit();"
                                               class="btn btn-default"><span
                                                        class="glyphicon glyphicon-cog"></span><span
                                                        class="txt">수정</span></a>
                                            <a href="javascript:file_del_it('<?= $row["cb_idx"] ?>')"
                                               class="btn btn-default"><span
                                                        class="glyphicon glyphicon-cog"></span><span
                                                        class="txt">삭제</span></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </form>
                                <?php
                                $i = $i + 1;
                            } ?>
                        </table>


                    </div>
                    <!-- // listWrap -->

                </div>
                <!-- // contents -->
            </div><!-- 인쇄 영역 끝 //-->
        </div>
        <!-- // container -->
        <script>
            function file_it() {
                var frm = document.frm1;
                if (frm.ufile1.value == "") {
                    alert("파일을 첨부해주셔야 합니다.");
                    return;
                }
                frm.submit();
            }

            function del_it() {
                if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
                    hiddenFrame.location.href = "del.php?code_idx[]=<?=$code_idx?>&mode=view&s_ca_idx=<?=$ca_idx?>";
                }

            }

            function file_del_it(cb_idx) {
                if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
                    hiddenFrame.location.href = "file_del.php?cb_idx=" + cb_idx;
                }

            }
        </script>
        <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>