<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2><?= $boardName ?></h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                        </ul>
                        <ul class="last">
                            <li><a href="board_write?code=<?= $code ?>" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a>
                            </li>
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">

                <FORM NAME="frmSearch" Method="GET">
                    <INPUT TYPE="hidden" NAME="code" VALUE="<?= $code ?>">
                    <INPUT TYPE="hidden" NAME="scategory" VALUE="<?= $scategory ?>">
                    <header id="headerContents">
                        <p>
                            <input type="radio" name="search_mode" value="" <?php if ($search_mode == "") {
                                echo "checked";
                            } ?>> 전체 &nbsp; &nbsp;
                            <input type="radio" name="search_mode" value="subject" <?php if ($search_mode == "subject") {
                                echo "checked";
                            } ?>> 제목 &nbsp; &nbsp;
                            <input type="radio" name="search_mode" value="contents" <?php if ($search_mode == "contents") {
                                echo "checked";
                            } ?>> 내용 &nbsp; &nbsp;
                            <input type="radio" name="search_mode" value="writer" <?php if ($search_mode == "writer") {
                                echo "checked";
                            } ?>> 작성자 &nbsp; &nbsp;
                            <input type="text" id="" name="search_word" value='<?= $search_word ?>'
                                   class="input_txt placeHolder" rel="검색어 입력" style="width:240px"/>
                            <a href="javascript:document.frmSearch.submit();" class="btn btn-default"><span
                                        class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                        </p>
                    </header><!-- // headerContents -->
                </form>
                <script>
                    function search_it() {
                        var frm = document.frmSearch;
                        if (frm.search_word.value == "검색어 입력") {
                            frm.search_word.value = "";
                        }
                        frm.submit();
                    }
                </script>


                <div class="listWrap">


                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                        </div>


                    </div><!-- // listTop -->


                    <?php
                    if ($skin == "gallery") {
                        $this->include('admin/_memberBoard/photo_inc');
                    } else if ($skin == "pds") {
                        $this->include('admin/_memberBoard/pds_inc');
                    } else {
                        $this->include('admin/_memberBoard/list_inc');
                    }
                    ?>

                    <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_memberBoard/board_list') . "?scategory=$scategory&search_mode=" . $search_mode . "&search_word=" . $search_word . "&code=" . $code . "&pg=") ?>

                    <div id="headerContainer">
                        <div class="inner">
                            <h2><?= $boardName ?></h2>
                            <div class="menus">
                                <ul class="first">
                                    <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                                </ul>
                                <ul class="last">
                                    <?php
                                    if ($code == "mem_board") {
                                        ?>
                                        <li><a href="board_write?code=<?= $code ?>" class="btn btn-primary"><span
                                                        class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li><a href="board_write?code=<?= $code ?>" class="btn btn-primary"><span
                                                        class="glyphicon glyphicon-pencil"></span> <span class="txt">자료 등록</span></a>
                                        </li>
                                        <?php
                                    }
                                    ?>

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
            if ($(".bbs_idx").is(":checked") == false) {
                alert_("삭제할 게시물을 선택하셔야 합니다.");
                return;
            }
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "bbs_del.ajax",
                type: "POST",
                data: $("#lfrm").serialize(),
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
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });
        }


        function del_chk(bbs_idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "bbs_del.ajax",
                type: "POST",
                data: "bbs_idx[]=" + bbs_idx,
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
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
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