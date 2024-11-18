<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<?php
$youtube_code = '';
?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>
                        메인/서브비주얼관리 <?= $tit ?><?=$total_sql?>
                    </h2>
                    <div class="menus">
                        <ul class="first">
                        </ul>

                        <ul class="last">
                            <li>
                                <select name="scategory" class="input_select" onchange="go_list(this.value);">
                                    <option value="">선택</option>
                                    <?php

                                    foreach ($fresult as $frow) {
                                        ?>
                                        <option value="<?= $frow["tbc_idx"] ?>" <?php if ($frow["tbc_idx"] == $scategory)
                                            echo "selected"; ?>><?= $frow["subject"] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </li>
                        </ul>
                        <ul class="last">
                            <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                            <li><a href="/AdmMaster/_bbs/board_write?code=<?= $code ?>&scategory=<?= $scategory ?>"
                                   class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> <span
                                            class="txt">글 등록</span></a></li>
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">

                <div class="listWrap">
                    <!-- 안내 문구 필요시 구성 //-->

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                        </div>

                    </div><!-- // listTop -->

                    <form name="frm" id="frm">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="70px"/>
                                    <col width="70px"/>
                                    <col width="500px"/>
                                    <col width="*"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="130px"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>순위</th>
                                    <th>이미지</th>
                                    <th>코드명</th>
                                    <th>타이틀</th>
                                    <th>이미지갯수</th>
                                    <th>롤링현황</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($nTotalCount == 0) {

                                    ?>
                                    <tr>
                                        <td colspan=10 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php
                                }
                                foreach ($result as $row) {

                                    $controller = new \App\Controllers\Admin\AdminBbsBannerController();
                                    $row_cate = $controller->getBbsCategory($row['category']);

                                    $img = "";
                                    $row['subject'] = str_replace('&lt;br class=&#34only_mo&#34&gt;', '', $row['subject']);
                                    $scategory = $row['category'];
                                    if ($row["ufile6"]) {
                                        if (substr(strtolower($row["ufile6"]), -3) == "jpg" || substr(strtolower($row["ufile6"]), -3) == "png" || substr(strtolower($row["ufile6"]), -3) == "gif") {
                                            //$img = get_img($row["ufile6"], ROOTPATH . "/public/upload/bbs/", 390, 220);
                                            $img = "/uploads/bbs/". $row["ufile6"];
                                        }
                                    } elseif ($youtube_code != "") {
                                        $img = "http://img.youtube.com/vi/" . $youtube_code . "/hqdefault.jpg";
                                    } elseif ($row["ufile5"]) {
                                        if (substr(strtolower($row["ufile5"]), -3) == "jpg" || substr(strtolower($row["ufile5"]), -3) == "png" || substr(strtolower($row["ufile5"]), -3) == "gif") {
                                            //$img = get_img($row["ufile5"], ROOTPATH . "/public/upload/bbs/", 390, 220);
                                            $img = "/uploads/bbs/". $row["ufile5"];
                                        }
                                    } else {
                                        $img = getConImg(str_replace("", "", viewSQ($row["contents"])));
                                    }
                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $num-- ?></td>
                                        <td>
                                            <input type="hidden" name="idx[]" value="<?= $row['bbs_idx'] ?>">
                                            <input type="text" name="onum[]" value="<?= $row['onum'] ?>"
                                                   style="max-width: 50px;text-align: center;padding: 3px;">
                                        </td>
                                        <td class="tac">
                                            <?php if ($img != '') { ?>
                                                <img src="<?= $img ?>" style="width:280px; height:100px;">
                                            <?php } else { ?>
                                                <p>No Image</p>
                                            <?php } ?>
                                        </td>
                                        <td class="tal"><?= $row_cate['subject'] ?></td>
                                        <td class="tal"><?= $row['subject'] ?></td>
                                        <td class="tac">1</td>
                                        <td class="tac">사용</td>
                                        <td>
                                            <a href="/AdmMaster/_bbs/board_write?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $row['bbs_idx'] ?>&pg=<?= $pg ?>"
                                               class="btn btn-default">수정</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <?php echo ipageListing($pg, $nPage, $g_list_rows, $_SERVER['PHP_SELF'] . "?ca_idx=$ca_idx&search_category=$search_category&search_name=$search_name&pg=") ?>


                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                </ul>

                                <ul class="last">
                                </ul>

                            </div>

                        </div><!-- // inner -->

                    </div><!-- // headerContainer -->
                </div><!-- // listWrap -->

            </div><!-- // contents -->


        </div><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->


    <script>
        function go_list(cate) {
            location.href = '/AdmMaster/_bbsBanner/list?code=banner&scategory=' + cate
        }
    </script>


    <script>
        function CheckAll(checkBoxes, checked) {
            var i;
            if (checkBoxes.length) {
                for (i = 0; i < checkBoxes.length; i++) {
                    checkBoxes[i].checked = checked;
                }
            } else {
                checkBoxes.checked = checked;
            }

        }

        function change_it() {
            $.ajax({
                url: "change.php",
                type: "POST",
                data: $("#frm").serialize(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
                    //				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response == "OK") {
                        alert_("정상적으로 변경되었습니다.");
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });
        }

        function SELECT_DELETE() {
            if ($(".code_idx").is(":checked") == false) {
                alert_("삭제할 내용을 선택하셔야 합니다.");
                return;
            }
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            $("#ajax_loader").removeClass("display-none");

            $.ajax({
                url: "del.php",
                type: "POST",
                data: $("#frm").serialize(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
                    //				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response == "OK") {
                        alert_("정상적으로 삭제되었습니다.");
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }

        function del_it(code_idx) {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "del.php",
                type: "POST",
                data: "code_idx[]=" + code_idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
                    //				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response == "OK") {
                        alert_("정상적으로 삭제되었습니다.");
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }


    </script>

<?= $this->endSection() ?>