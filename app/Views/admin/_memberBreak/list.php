<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>
                        연/월차 리스트
                    </h2>
                    <div class="menus">
                        <ul class="first">
                        </ul>

                        <ul class="last">
                            <li><a href="write" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span class="txt">휴가등록</span></a>
                            </li>
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


                    <form name="search" id="search">
                        <header id="headerContents">
                            <select id="" name="search_category" class="input_select" style="width:112px">
                                <option value="bl_memo" <?php if ($search_category == "bl_memo") {
                                    echo "selected";
                                } ?>>휴가사유
                                </option>
                                <option value="user_name" <?php if ($search_category == "user_name") {
                                    echo "selected";
                                } ?>>직원명
                                </option>
                                <option value="bl_gubun" <?php if ($search_category == "bl_gubun") {
                                    echo "selected";
                                } ?>>구분
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
                    <form name="frm" id="frm">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="70px"/>
                                    <col width="120px"/>
                                    <col width="*"/>
                                    <col width="200px"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>구분</th>
                                    <th>휴가사유</th>
                                    <th>날짜</th>
                                    <th>기간</th>
                                    <th>직원명</th>
                                    <th>현황</th>
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
                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $num-- ?></td>
                                        <td class="tac"><?= $row["bl_gubun"] ?></td>
                                        <td class="tal"><a
                                                    href="write?bl_idx=<?= $row["bl_idx"] ?>&search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>"><?= $row["bl_memo"] ?></a>
                                        </td>
                                        <td class="tac"><?= $row["bl_date"] ?></td>
                                        <td class="tac"><?= $row["bl_cnt"] ?>일</td>
                                        <td class="tac"><?= $row["user_name"] ?></td>
                                        <td class="tac">
                                            <?php
                                            if ($row["status"] == "N") {
                                                echo "대기";
                                            } elseif ($row["status"] == "Y") {
                                                echo "승인";
                                            } elseif ($row["status"] == "C") {
                                                echo "반려";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($row["m_idx"] == $_SESSION['member']['idx'] || $_SESSION['member']['id'] == "admin") { ?>
                                                <a href="write?bl_idx=<?= $row["bl_idx"] ?>&search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>"><img
                                                            src="/images/admin/common/ico_setting2.png" alt="설정"/></a>
                                                <a href="javascript:del_it('<?= $row["bl_idx"] ?>');"><img
                                                            src="/images/admin/common/ico_error.png" alt="에러"/></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_memberBreak/list') . "?ca_idx=$ca_idx&search_category=$search_category&search_name=$search_name&pg=") ?>


                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                </ul>

                                <ul class="last">
                                    <li><a href="write?s_parent_code_no=<?= $s_parent_code_no ?>"
                                           class="btn btn-primary"><span
                                                    class="glyphicon glyphicon-pencil"></span> <span
                                                    class="txt">연차 등록</span></a></li>
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

        function del_it(bl_idx) {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "del",
                type: "POST",
                data: "bl_idx[]=" + bl_idx,
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