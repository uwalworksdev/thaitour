<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>룸정보 리스트</h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)"
                                   class="btn btn-success">전체선택</a></li>
                            <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)"
                                   class="btn btn-success">선택해체</a></li>
                            <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                        </ul>

                        <ul class="last">
                            <li><a href="write" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span
                                            class="txt">상품 등록</span></a></li>
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">
                <form name="search" id="search">
                    <header id="headerContents">
<!--                        <select id="hotel_code" name="hotel_code" class="input_select"-->
<!--                                onchange="javascript:document.search.submit();">-->
<!--                            <option value="">전체</option>-->
<!--                            --><?php
//                            foreach ($fresult as $frow) {
//                                ?>
<!--                                <option value="--><?php //= $frow["code_no"] ?><!--" --><?php //if ($hotel_code == $frow["code_no"]) {
//                                    echo "selected";
//                                } ?><!-->--><?php //= $frow["code_name"] ?><!--</option>-->
<!--                            --><?php //} ?>
<!---->
<!--                        </select>-->

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
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable"
                                   style="table-layout:fixed;">
                                <caption></caption>
                                <colgroup>
                                    <col width="4%"/>
                                    <col width="4%"/>
                                    <col width="10%"/>
<!--                                    <col width="10%"/>-->
                                    <col width="*"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>EDIT</th>
                                    <th>이미지</th>
<!--                                    <th>호텔명</th>-->
                                    <th>룸명</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if ($nTotalCount == 0) {
                                    ?>
                                    <tr>
                                        <td colspan=5 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php
                                }
                                ?>



                                <?php
                                foreach ($result as $row) {
                                    ?>

                                    <tr>
                                        <td><input type="checkbox" name="idx[]" class="idx"
                                                   value="<?= $row['g_idx'] ?>"/>
                                        </td>
                                        <td><a href="write?g_idx=<?= $row['g_idx'] ?>"><span
                                                        class="edit_btn">EDIT</span></a></td>

                                        <td class="images">
                                            <?php if ($row["ufile1"]) {
                                                ?>
                                                <img src="/uploads/rooms/<?= $row["ufile1"] ?>" alt="제품 이미지">
                                            <?php } ?>
                                        </td>
<!--                                        <td class="product_name">-->
<!--                                            --><?php //= $row['hotelName'] ?>
<!--                                        </td>-->
                                        <td class="product_name">
                                            <?= $row['roomName'] ?>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div><!-- // listBottom -->

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_room/list') . "?hotel_code=" . $hotel_code . "&search_name=" . $search_name . "&pg=") ?>


                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">


                            <ul class="last">
                                <li><a href="write" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-pencil"></span> <span
                                                class="txt">상품 등록</span></a></li>
                            </ul>

                        </div>

                    </div><!-- // inner -->

                </div><!-- // headerContainer -->
            </div><!-- // listWrap -->

        </div><!-- // contents -->
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


        function change_it() {
            $.ajax({
                url: "change",
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
            if ($(".idx").is(":checked") === false) {
                alert_("삭제할 내용을 선택하셔야 합니다.");
                return;
            }
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") === false) {
                return;
            }

            $("#ajax_loader").removeClass("display-none");

            let url = '<?= route_to('admin.room.del') ?>';

            $.ajax({
                url: url,
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
                    alert_(response.message);
                    console.log(response)
                    location.reload();
                }
            });

        }
    </script>

<?= $this->endSection() ?>