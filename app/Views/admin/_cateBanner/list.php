<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2>
                        카테고리 배너관리
                    </h2>
                    <div class="menus">
                        <ul class="first">
                        </ul>

                        <ul class="last">
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
                                    <col width="500px"/>
                                    <col width="*"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="130px"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>이미지</th>
                                    <th>코드명</th>
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
                                foreach ($items as $row) {
                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $num-- ?></td>
                                        <td class="tac">
                                            <?php if ($row["img"]) { ?>
                                                <img src="/data/cate_banner/<?= $row["img"] ?>" style="height:100px">
                                            <?php } ?>
                                        </td>
                                        <td class="tal">
                                            <a href="write?code_idx=<?= $row["code_idx"] ?>&s_parent_code_no=<?= $s_parent_code_no ?>">
                                                <?= $row["code_name"] ?>
                                            </a>
                                        </td>
                                        <td class="tac"><?= $row["cnt"] ?></td>
                                        <td class="tac">
                                            <?php
                                            if ($row["rolling_yn"] == "Y") {
                                                echo "사용";
                                            } elseif ($row["rolling_yn"] == "N") {
                                                echo "사용안함";
                                            }
                                            ?></td>
                                        <td>
                                            <a href="list?s_parent_code_no=<?= $row["code_no"] ?>"
                                               class="btn btn-default">하위</a>
                                            <a href="write?code_idx=<?= $row["code_idx"] ?>&s_parent_code_no=<?= $s_parent_code_no ?>"
                                               class="btn btn-default">수정</a>
                                        </td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <?php echo ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_cateBanner/list') . "?ca_idx=$ca_idx&search_category=$search_category&search_name=$search_name&pg=") ?>

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
    </div>

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