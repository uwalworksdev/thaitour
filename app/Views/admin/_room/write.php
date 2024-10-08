<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>

<?php

if ($g_idx && $row) {
    foreach ($row as $keys => $vals) {
        //echo $keys . " => " . $vals . "<br/>";
        ${$keys} = $vals;

    }
}
$idx = $g_idx;
$titleStr = "룸 수정";
$links = "list";

?>


    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>

                            <li><a href="/AdmMaster/_room/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($idx) { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <li><a href="javascript:del_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
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
                    <!--  target="hiddenFrame22"  -->
                    <form name="frm" id="frm" action="write_ok" method="post" enctype="multipart/form-data"
                          target="hiddenFrame22"> <!--  -->
                        <!-- 상품 고유 번호 -->
                        <input type="hidden" name="g_idx" id="g_idx" value='<?= $g_idx ?>'/>
                        <input type=hidden name="room_facil" id="room_facil" value='<?= $room_facil ?>'>
                        <input type=hidden name="room_category" id="room_category" value='<?= $category ?>'>

                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="table-layout:fixed;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        기본정보
                                    </td>
                                </tr>
                                <tr>
                                    <th>룸 이름</th>
                                    <td colspan="3">
                                        <input type="text" name="roomName" value="<?= $roomName ?? '' ?>" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>객실시설</th>
                                    <td colspan="3">
                                        <?php
                                        $_arr = explode("|", $room_facil);
                                        foreach ($fresult as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="room_facil_<?= $row_r['code_no'] ?>"
                                                   name="_room_facil"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> /><?= $row_r['code_name'] ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>장면</th>
                                    <td colspan="3">
                                        <input type="text" name="scenery" value="<?= $scenery ?? '' ?>" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>범주</th>
                                    <td colspan="3">
                                        <?php
                                        $_arr = explode("|", $category);
                                        foreach ($fresult2 as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="room_category_<?= $row_r['code_no'] ?>"
                                                   name="_room_category"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> /><?= $row_r['code_name'] ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>

                                <tr>
                                    <td colspan="2">
                                        이미지 등록
                                    </td>
                                </tr>


                                <?php for ($i = 1; $i <= 3; $i++) { ?>
                                    <tr>
                                        <th>이미지<?= $i ?>(600X400)</th>
                                        <td colspan="3">

                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                   style="width:500px;margin-bottom:10px"/>
                                            <?php if (isset(${"ufile" . $i}) && ${"ufile" . $i} != "") { ?><br>파일삭제:
                                                <input type=checkbox
                                                       name="del_<?= $i ?>"
                                                       value='Y'><a
                                                        href="/uploads/rooms/<?= ${"ufile" . $i} ?>"
                                                        class="imgpop"><?= ${"rfile" . $i} ?></a><br><br>
                                                <img src="/uploads/rooms/<?= ${"ufile" . $i} ?>" width="200"
                                                     height="200"/>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </form>


                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">
                                <a href="/AdmMaster/_room/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <a href="javascript:del_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>


                </div>
                <!-- // listWrap -->

            </div>
            <!-- // contents -->

        </div><!-- 인쇄 영역 끝 //-->
    </div>


    <iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
    <script>
        function send_it() {
            var frm = document.frm;


            if (frm.roomName.value == "") {
                alert("룸 이름을 등록해주세요.");
                frm.roomName.focus();
                return;
            }

            let room_facil = "", room_category = "";
            $("input[name=_room_facil]:checked").each(function () {
                room_facil += $(this).val() + '|';
            })

            $("#room_facil").val(room_facil);

            $("input[name=_room_category]:checked").each(function () {
                room_category += $(this).val() + '|';
            })

            $("#room_category").val(room_category);


            frm.submit();
        }

        function del_it() {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");

            let url = '<?= route_to('admin.room.del') ?>';

            $.ajax({
                url: url,
                type: "POST",
                data: "idx[]=" + "<?= $idx ?>",
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
                    window.location.href = '<?= route_to('admin.room.list') ?>';
                }
            });

        }

    </script>
<?= $this->endSection() ?>