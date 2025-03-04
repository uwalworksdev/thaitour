<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>맞춤문의</h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)"
                                   class="btn btn-success">전체선택</a></li>
                            <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)"
                                   class="btn btn-success">선택해체</a></li>
                            <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                        </ul>

                        <ul class="last">
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">
                <form name="search" id="search">
                    <input type="hidden" name="gubun" value="<?= $gubun ?>">
                    <header id="headerContents">
                        <select id="" name="search_category" class="input_select" style="width:112px">
                            <option value="user_name_kor" <?php if ($search_category == "user_name_kor") {
                                echo "selected";
                            } ?>>국문이름
                            </option>
                            <option value="user_email" <?php if ($search_category == "user_name_eng") {
                                echo "selected";
                            } ?>>영문이름
                            </option>
                            <option value="user_phone" <?php if ($search_category == "user_phone") {
                                echo "selected";
                            } ?>>핸드폰
                            </option>
                            <option value="user_phone" <?php if ($search_category == "user_phone") {
                                echo "selected";
                            } ?>>이메일
                            </option>
                            <option value="user_phone" <?php if ($search_category == "user_phone") {
                                echo "selected";
                            } ?>>일행영문명
                            </option>
                        </select>


                        <input type="text" id="" name="search_name" value="<?= $search_name ?>"
                               class="input_txt placeHolder" rel="검색어 입력" style="width:240px"/>

                        <a href="javascript:search_it()" class="btn btn-default"><span
                                    class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                    </header><!-- // headerContents -->
                </form>
                <script>
                    function search_it() {
                        var frm = document.search;
                        if (frm.search_name.value == "검색어 입력") {
                            frm.search_name.value = "";
                        }
                        frm.submit();
                    }
                </script>

                <div class="listWrap">
                    <!-- 안내 문구 필요시 구성 //-->


                    <!-- <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                        </div>

                    </div> -->
                    <!-- // listTop -->

                    <form name="frm" id="frm" method="GET">
                        <div class="listTop" style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="left">
                                <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                            </div>

                            <div class="right">
                                <select id="g_list_rows" name="g_list_rows" class="input_select" style="width: 80px" onchange="submitForm();">
                                    <option value="20" <?= ($g_list_rows == 20) ? 'selected' : '' ?>>20개</option>
                                    <option value="50" <?= ($g_list_rows == 50) ? 'selected' : '' ?>>50개</option>
                                    <option value="100" <?= ($g_list_rows == 100) ? 'selected' : '' ?>>100개</option>
                                    <option value="200" <?= ($g_list_rows == 200) ? 'selected' : '' ?>>200개</option>
                                </select>
                            </div>

                        </div>
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="5%"/>
                                    <col width="5%"/>
                                    <col width="8%"/>
                                    <col width="8%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="8%"/>
                                    <!--col width="200px" /-->
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="5%"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>번호</th>
                                    <th>예약번호</th>
                                    <th>국문이름</th>
                                    <th>영문이름</th>
                                    <th>연락처</th>
                                    <th>이메일</th>
                                    <th>성인/소아/유아</th>
                                    <!--th>담당자</th-->
                                    <th>여행기간</th>
                                    <!-- <th>진행상태</th> -->
                                    <th>신청일시</th>
                                    <th>ip</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if ($nTotalCount == 0) {
                                    ?>
                                    <tr>
                                        <td colspan=13 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php
                                }
                                foreach ($result as $row) {
                                    $statusStr = "";
                                    if ($row["status"] == "Y") {
                                        $statusStr = "상담완료";
                                    } elseif ($row["status"] == "C") {
                                        $statusStr = "상담취소";
                                    } elseif ($row["status"] == "W") {
                                        $statusStr = "문의접수";
                                    }

                                    if ($row['isViewInquiry'] == 'N') {
                                        $color = "#FED4D6";
                                    } else {
                                        $color = "#fff";
                                    }
                                    ?>
                                    <tr style="height:50px; background-color: <?= $color ?>;">
                                        <td><input type="checkbox" name="idx[]" value="<?= $row['idx'] ?>"
                                                   class="input_check"/></a></td>
                                        <td><?= $num-- ?></td>
                                        <td class="tac"><?= $row["id_checking"] ?></td>
                                        <td class="tac"><a
                                                    href="write?idx=<?= $row['idx'] ?>"><?= sqlSecretConver($row["user_name_kor"], 'decode') ?>
                                        </td>
                                        <td class="tac"><?= sqlSecretConver($row["user_name_eng"], 'decode') ?></td>
                                        <td class="tac"><?= sqlSecretConver($row["user_phone"], 'decode') ?></td>
                                        <td class="tac"><?= sqlSecretConver($row["user_email"], 'decode') ?></td>
                                        <td class="tac"><?= $row["travel_person1"] ?>/<?= $row["travel_person2"] ?>/<?= $row["travel_person3"] ?></td>
                                        <td class="tac"><?= str_replace("-", ".", $row["departure_date"]) ?>
                                            ~ <?= str_replace("-", ".", $row["arrival_date"]) ?></td>
                                        <td class="tac"><?= $row["r_date"] ?></td>
                                        <td class="tac"><?= $row["user_ip"] ?></td>
                                        <td>
                                            <a href="write.php?idx=<?= $row['idx'] ?>"><img
                                                        src="/images/admin/common/ico_setting2.png"></a>
                                            <a href="javascript:del_it('<?= $row['idx'] ?>');"><img
                                                        src="/images/admin/common/ico_error.png" alt="삭제"/></a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <?php echo ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_inquiry/list') . "?s_status=&search_category=$search_category&g_list_rows=$g_list_rows&search_name=$search_name&pg=") ?>


                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                    <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)"
                                           class="btn btn-success">전체선택</a></li>
                                    <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)"
                                           class="btn btn-success">선택해체</a></li>
                                    <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
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

        function SELECT_DELETE() {
            if ($(".idx").is(":checked") == false) {
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
                dataType: "json",
                async: false,
                cache: false,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                    location.reload();
                },
                success: function (data, status, request) {
                    message = data.message;
                    alert_(message);
                    location.reload();
                }
            });

        }

        function del_it(idx) {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            var message = "";
            $.ajax({

                url: "./ajax.del.php",
                type: "POST",
                data: "idx[]=" + idx,
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert_(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }


    </script>

    <script>
        function submitForm() {
            document.getElementById("frm").submit();
        }
    </script>

<?= $this->endSection() ?>