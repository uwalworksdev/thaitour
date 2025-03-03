<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <div id="container">
    <span id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>
                    <?= $code_name ?> 코드 리스트
                </h2>
                <div class="menus">
                    <ul class="first">
                    </ul>

                    <ul class="last">
                        <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                        <li><a href="/AdmMaster/_tourRegist/golf_vehicles/write?s_parent_code_no=<?= $s_parent_code_no ?>"
                               class="btn btn-primary"><span
                                        class="glyphicon glyphicon-pencil"></span> <span
                                        class="txt">신규등록</span></a></li>
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
                                <col width="120px"/>
                                <col width="*"/>
                                <col width="120px"/>
                                <col width="120px"/>
                                <col width="120px"/>
                                <col width="120px"/>
                                <col width="260px"/>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>코드번호</th>
                                    <th>코드명</th>
                                    <th>이미지</th>
                                    <th>DEPTH</th>
                                    <!-- <th>하위갯수</th> -->
                                    <th>현황</th>
                                    <th>우선순위</th>
                                    <th>관리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($nTotalCount == 0) {
                                    ?>
                                    <tr>
                                        <td colspan="9" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php
                                }
                                foreach ($result as $row) {
                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $num-- ?></td>
                                        <td class="tac"><?= $row["code_no"] ?></td>
                                        <td class="tal">
                                            <a
                                                    href="/AdmMaster/_tourRegist/golf_vehicles/write/<?= $row["code_idx"] ?>?s_parent_code_no=<?= $s_parent_code_no ?>"><?= $row["code_name"] ?></a>
                                        </td>
                                        <td class="tac">
                                            <?php if ($row['ufile1'] && $row['rfile1'])
                                                echo "<img src='/data/code/" . $row['ufile1'] . "'>"; ?>
                                        </td>
                                        <td class="tac"><?= $row["depth"] ?></td>
                                        <!-- <td class="tac"><?= $row["cnt"] ?></td> -->
                                        <td class="tac">
                                            <?php
                                            if ($row["status"] == "Y") {
                                                echo "사용";
                                            } elseif ($row["status"] == "N") {
                                                echo "삭제";
                                            } elseif ($row["status"] == "C") {
                                                echo "마감";
                                            }
                                            ?>
                                        </td>
                                        <td class="tac">
                                            <input type="text" name="onum[]" value="<?= $row["onum"] ?>"
                                                   class="input_txt"
                                                   style="width:50px"/>
                                            <input type="hidden" name="code_idx[]" value="<?= $row["code_idx"] ?>"
                                                   class="input_txt"/>
                                        </td>
                                        <td>
                                            <!-- <a href="/AdmMaster/_tourRegist/golf_vehicles/write/<?= $row["code_idx"] ?>?s_parent_code_no=<?= $s_parent_code_no ?>"><img
                                                        src="/images/admin/common/ico_setting2.png"></a> -->
                                            <a href="/AdmMaster/_tourRegist/golf_vehicles/write/<?= $row["code_idx"] ?>?s_parent_code_no=<?= $s_parent_code_no ?>"
                                                        class="btn btn-default">상세수정</a>
                                            <?php if ($row["cnt"] == 0) { ?>
                                                <a href="#!" onclick="code_delete('<?= $row['code_idx'] ?>');"
                                                   class="btn btn-default">코드삭제</a>
                                            <?php } ?>
                                            <!-- <a href="/AdmMaster/_tourRegist/golf_vehicles/write?s_parent_code_no=<?= $row["code_no"] ?>"
                                                class="btn btn-default">추가등록</a>
                                            &nbsp;&nbsp; -->
                                            <!-- <a href="/AdmMaster/_tourRegist/golf_vehicles?s_parent_code_no=<?= $row["code_no"] ?>"
                                                class="btn btn-default">하위리스트</a> -->
                                        </td>
                                    </tr>
                                <?php } ?>





                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <? echo ipageListing($pg, $nPage, $g_list_rows, $currentUri . "?pg=") ?>


                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first">
                            </ul>

                            <ul class="last">
                                <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                                <li><a href="/AdmMaster/_tourRegist/golf_vehicles/write?s_parent_code_no=<?= $s_parent_code_no ?>"
                                       class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> <span
                                                class="txt">신규 등록</span></a></li>
                            </ul>

                        </div>

                    </div><!-- // inner -->

                </div><!-- // headerContainer -->
            </div><!-- // listWrap -->

        </div><!-- // contents -->





    </span><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->


    <script>
        function code_delete(idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            var message = "";
            $.ajax({

                url: "/AdmMaster/_tourRegist/golf_vehicles/del",
                type: "POST",
                data: {
                    "code_idx[]": idx
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
                url: "/AdmMaster/_tourRegist/golf_vehicles/change",
                type: "POST",
                data: $("#frm").serialize(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
                    //				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response == "OK") {
                        alert("정상적으로 변경되었습니다.");
                        window.location.reload();
                    } else {
                        // alert(response);
                        alert("오류가 발생하였습니다!!");
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
                url: "/AdmMaster/_tourRegist/golf_vehicles/del",
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

    </script>

<?= $this->endSection() ?>