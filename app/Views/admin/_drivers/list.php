<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>가이드 소개 리스트</h2>
                    <div class="menus">
                        <ul class="last">
                            <li><a href="javascript:change_it()" class="btn btn-success btn_change">순위변경</a></li>
                            <li><a href="/AdmMaster/_drivers/write" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span
                                            class="txt">상품 등록</span></a></li>
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
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable"
                                   style="table-layout:fixed;">
                                <caption></caption>
                                <colgroup>
                                    <col width="4%"/>
                                    <col width="10%"/>
                                    <col width="x"/>
                                    <col width="6%"/>
                                    <col width="6%"/>
                                    <col width="8%"/>
                                    <col width="6%"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>이미지</th>
                                    <th>닉네임</th>
                                    <th>판매상태결정</th>
                                    <th>순위</th>
                                    <th>등록일</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if ($nTotalCount == 0) {
                                    ?>
                                    <tr>
                                        <td colspan="7" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                <?php
                                $i = 0;
                                foreach ($drivers as $row) {
                                    $i++;
                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i ?>
                                        </td>

                                        <td class="images">
                                            <div class=""
                                                 style="display: flex; justify-content: center; align-items: center; padding: 10px">
                                                <?php if ($row["avatar"]) {
                                                    ?>
                                                    <img src="/uploads/drivers/<?= $row["avatar"] ?>"
                                                         style="height: 100px"
                                                         alt="제품 이미지">
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="/AdmMaster/_drivers/write?search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&d_idx=<?= $row["d_idx"] ?>">
                                                <?= $row['special_name'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <select name="is_show[]" id="is_show_<?= $row["d_idx"] ?>">
                                                <option value="A" <?php if (isset($row["is_show"]) && $row["is_show"] === "A") {
                                                    echo "selected";
                                                } ?>>판매중
                                                </option>
                                                <option value="S" <?php if (isset($row["is_show"]) && $row["is_show"] === "S") {
                                                    echo "selected";
                                                } ?>>판매중지
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="onum[]" id="onum_<?= $row["d_idx"] ?>"
                                                   value="<?= $row['onum'] ?>" style="width:66px;">
                                            <input type="hidden" name="d_idx[]"
                                                   id="d_idx_<?= $row["d_idx"] ?>"
                                                   value="<?= $row["d_idx"] ?>">
                                        </td>
                                        <td>
                                            <?= $row["created_at"] ?>
                                        </td>
                                        <td>
                                            <a href="#!" onclick="change_it('<?= $row['d_idx'] ?>');"><img
                                                        src="/images/admin/common/ico_setting2.png"></a>&nbsp;
                                            <a href="javascript:del_it('<?= $row['d_idx'] ?>');"><img
                                                        src="/images/admin/common/ico_error.png" alt="삭제"/></a>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div><!-- // listBottom -->

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_drivers/list') . "?search_name=" . $search_name . "&pg=") ?>


                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">


                            <ul class="last">
                                <li><a href="/AdmMaster/_drivers/write" class="btn btn-primary"><span
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
        function change_it() {
            let formData = new FormData($('#frm')[0]);

            $("#ajax_loader").removeClass("display-none");
            let url = '<?= route_to('admin._drivers.change') ?>';

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    alert(response.message);
                    console.log(response)
                    window.location.reload();
                }
            });
        }

        function del_it(d_idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") === false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            let url = '<?= route_to('admin._drivers.delete') ?>';

            let data = {
                d_idx: d_idx
            };

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    alert(response.message);
                    console.log(response)
                    window.location.reload();
                }
            });
        }
    </script>

<?= $this->endSection() ?>