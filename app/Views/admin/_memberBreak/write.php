<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<?php
$status = "N";
$titleStr = "휴가설정";

$bl_gubun = $row["bl_gubun"] ?? '';
$m_idx = $row["m_idx"] ?? '';
$bl_date = $row["bl_date"] ?? '';
$bl_cnt = $row["bl_cnt"] ?? '';
$bl_memo = $row["bl_memo"] ?? '';
$status = $row["status"] ?? '';
if ($bl_idx) {
    $titleStr = "휴가수정";

}
?>


    <div id="container">
        <div id="print_this">
            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>
                            <li><a href="javascript:history.back();" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($bl_idx == "") { ?>
                                <a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            <?php } else { ?>
                                <?php if ($status == "N") { ?>
                                    <?php if ($m_idx == $_SESSION['member']['idx'] || $_SESSION['member']['id'] == "admin") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <a href="javascript:del_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php if ($_SESSION['member']['id'] == "admin") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <a href="javascript:del_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <form name=frm action="write_ok.php" method=post target="hiddenFrame">
                <input type=hidden name="bl_idx" value='<?= $bl_idx ?>'>
                <div id="contents">
                    <div class="listWrap_noline">


                        <div class="listBottom">
                            <div style="font-size:12pt;margin-bottom:10px">■ <?= $titleStr ?></div>
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
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
                                    <th>휴가사유</th>
                                    <td colspan="3"><input type="text" name="bl_memo" value="<?= $bl_memo ?>"
                                                           class="bbs_inputbox_pixel" style="width:90%"
                                                           maxlength="100"/></td>
                                </tr>
                                <?php if ($_SESSION['member']['id'] == "admin") { ?>
                                    <tr>
                                        <th>구분</th>
                                        <td>
                                            <select name="bl_gubun" onchange="javascript:change_it(this.value);">
                                                <option value="">선택</option>
                                                <option value="반차" <?php if ($bl_gubun == "반차") {
                                                    echo "selected";
                                                } ?>>반차
                                                </option>
                                                <option value="월차" <?php if ($bl_gubun == "월차") {
                                                    echo "selected";
                                                } ?>>월차
                                                </option>
                                                <option value="년차" <?php if ($bl_gubun == "년차") {
                                                    echo "selected";
                                                } ?>>년차
                                                </option>
                                            </select>
                                        </td>
                                        <th>결제</th>
                                        <td>
                                            <select name="status">
                                                <option value="N" <?php if ($status == "N") {
                                                    echo "selected";
                                                } ?>>대기
                                                </option>
                                                <option value="Y" <?php if ($status == "Y") {
                                                    echo "selected";
                                                } ?>>승인
                                                </option>
                                                <option value="C" <?php if ($status == "C") {
                                                    echo "selected";
                                                } ?>>반려
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <th>구분</th>
                                        <td colspan="3">
                                            <select name="bl_gubun" onchange="javascript:change_it(this.value);">
                                                <option value="">선택</option>
                                                <option value="반차" <?php if ($bl_gubun == "반차") {
                                                    echo "selected";
                                                } ?>>반차
                                                </option>
                                                <option value="월차" <?php if ($bl_gubun == "월차") {
                                                    echo "selected";
                                                } ?>>월차
                                                </option>
                                                <option value="년차" <?php if ($bl_gubun == "년차") {
                                                    echo "selected";
                                                } ?>>년차
                                                </option>
                                            </select>
                                            <input type="hidden" name="status" value="<?= $status ?>">
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th>휴가시작날짜</th>
                                    <td><input type="text" name="bl_date" value='<?= $bl_date ?>'
                                               class="date_pic bbs_inputbox_pixel" style="width:100px" readonly/></td>
                                    <th>기간</th>
                                    <td>
                                        <input type="text" name="bl_cnt" id="bl_cnt" value="<?= $bl_cnt ?>"
                                               class="bbs_inputbox_pixel" style="width:50px" numberOnly="true"
                                               maxlength="2"/>일간
                                    </td>
                                </tr>
                                </tbody>

                            </table>


                        </div>
                        <!-- // listBottom -->


                        <div class="tail_menu">
                            <ul>
                                <li class="left"></li>
                                <li class="right_sub">

                                    <a href="javascript:history.back();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                    <?php if ($bl_idx == "") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <?php } else { ?>
                                        <?php if ($status == "N") { ?>
                                            <?php if ($m_idx == $_SESSION['member']['idx'] || $_SESSION['member']['id'] == "admin") { ?>
                                                <a href="javascript:send_it()" class="btn btn-default"><span
                                                            class="glyphicon glyphicon-cog"></span><span
                                                            class="txt">수정</span></a>
                                                <a href="javascript:del_it()" class="btn btn-default"><span
                                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if ($_SESSION['member']['id'] == "admin") { ?>
                                                <a href="javascript:send_it()" class="btn btn-default"><span
                                                            class="glyphicon glyphicon-cog"></span><span
                                                            class="txt">수정</span></a>
                                                <a href="javascript:del_it()" class="btn btn-default"><span
                                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>


                    </div>
                    <!-- // listWrap -->

                </div>
                <!-- // contents -->
            </form>
        </div><!-- 인쇄 영역 끝 //-->
    </div>
    <!-- // container -->
    <script>
        function change_it(txt) {
            if (txt == "반차") {
                $("#bl_cnt").val("0.5");
                $("#bl_cnt").attr("readonly", true);
            } else {
                $("#bl_cnt").val("0");
                $("#bl_cnt").attr("readonly", false);
            }
        }

        function send_it() {
            var frm = document.frm;
            if (frm.bl_memo.value == "") {
                frm.bl_memo.focus();
                alert("휴가사유를 작성해주셔야 합니다.");
                return;
            }
            if (frm.bl_gubun.value == "") {
                frm.bl_gubun.focus();
                alert("구분을 선택해주셔야 합니다.");
                return;
            }
            if (frm.bl_date.value == "") {
                frm.bl_date.focus();
                alert("날짜를 입력해주셔야 합니다.");
                return;
            }
            if (frm.bl_cnt.value == "") {
                frm.bl_cnt.focus();
                alert("기간를 입력해주셔야 합니다.");
                return;
            }
            frm.submit();

        }

        function del_it() {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "del.php",
                type: "POST",
                data: "bl_idx[]=<?=$bl_idx?>",
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
                        location.href = "list.php";
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }

        function find_id() {
            if ($("#company_name").val() != "") {
                $("#ajax_loader").removeClass("display-none");
                $.ajax({
                    url: "id_check.php",
                    type: "POST",
                    data: "company_name=" + $("#company_name").val(),
                    error: function (request, status, error) {
                        //통신 에러 발생시 처리
                        alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        $("#ajax_loader").addClass("display-none");
                    }
                    , complete: function (request, status, error) {
                        $("#ajax_loader").addClass("display-none");
                    }
                    , success: function (response, status, request) {
                        if (response == "OK") {
                            alert("존해하지 않는 아이디 입니다.");
                            frm.bl_idx.value = "";
                        } else {
                            alert_("사용가능한 아이디입니다.");
                            frm.bl_idx.value = response;
                            return;
                        }
                    }
                });

            }
        }

        function id_check() {
            var err = 0;
            var str = frm.company_name.value;
            if (str.length < 1) {
                alert("업체명을 입력해야 합니다.");
                return;
            }
            $.ajax({
                url: "id_check.php",
                type: "POST",
                data: "company_name=" + $("#company_name").val(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    $("#id_chk").val("N");
                    if (response == "DL") {
                        alert("이미 사용중인 업체명 입니다.");
                        return;
                    } else if (response == "OK") {
                        alert("사용가능한 업체명 입니다.");
                        $("#id_chk").val("Y");
                        return;
                    } else {
                        alert(response);
                        alert("오류가 발생하였습니다!!");
                        return;
                    }
                    $('#user_email').focus();
                }
            });
        }

    </script>
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>