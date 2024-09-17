<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>상품옵션정보 리스트</h2>
                    <div class="menus">
                        <ul class="first">
                        </ul>

                        <ul class="last">
                            <li><a href="write" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span
                                            class="txt">상품옵션정보 등록</span></a></li>
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">
                <form name="search" id="search">
                    <header id="headerContents">
                        <input type="text" id="" name="search_name" value="<?= $search_name ?>"
                               class="input_txt placeHolder" placeholder="검색어 입력" style="width:240px"/>
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
                                    <col width="10%"/>
                                    <col width="20%"/>
                                    <col width="*"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>상품옵션명</th>
                                    <th>썸네일이미지</th>
                                    <th>사용유무</th>
                                    <th>등록일</th>
                                    <th>수정일</th>
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
                                    if ($row['status'] != "N") {
                                        $status = "사용";
                                    } else {
                                        $status = "중지";
                                    }
                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $num-- ?></td>
                                        <td class="tac"><a
                                                    href="write?idx=<?= $row['idx'] ?>"><?= $row["option_name"] ?></a>
                                        </td>
                                        <td class="tac">
                                            <?php if ($row["ufile1"] != "") { ?>
                                                <a href="/data/option/<?= $row["ufile1"] ?>" class="imgpop"><img
                                                            src="/data/option/<?= $row["ufile1"] ?>"
                                                            style="max-width:150px"></a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?= $status ?>
                                        </td>
                                        <td>
                                            <?= $row["r_date"] ?>
                                        </td>
                                        <td>
                                            <?= $row["m_date"] ?>
                                        </td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_tourOption/list') . "?s_country_code_1=" . $s_country_code_1 . "&s_country_code_2=" . $s_country_code_2 . "&s_country_code_2=" . $s_country_code_3 . "&search_category=" . $search_category . "&search_name=" . $search_name . "&pg=") ?>


                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                </ul>

                                <ul class="last">
                                    <li><a href="write" class="btn btn-primary"><span
                                                    class="glyphicon glyphicon-pencil"></span> <span class="txt">상품등급정보 등록</span></a>
                                    </li>
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
            if ($(".country_idx").is(":checked") == false) {
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

        function del_it(idx) {


            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "del.php",
                type: "POST",
                data: "idx[]=" + idx,
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

        function get_code(strs, depth) {
            $.ajax({
                type: "GET"
                , url: "get_code.ajax.php"
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
                        $("#country_code_2").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#country_code_2").append("<option value=''>2차분류</option>");
                    }
                    if (depth <= 4) {
                        $("#country_code_3").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#country_code_3").append("<option value=''>3차분류</option>");
                    }
                    if (depth <= 4) {
                        $("#country_code_4").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#country_code_4").append("<option value=''>4차분류</option>");
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
                        $("#country_code_" + (parseInt(depth) - 1)).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                    }
                }
            });
        }
    </script>


<?= $this->endSection() ?>