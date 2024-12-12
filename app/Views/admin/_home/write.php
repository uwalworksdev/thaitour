<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <link rel="stylesheet" href="/css/admin/sms_contents.css" type="text/css"/>

    <div id="wrap">

<?php
if ($m_idx) {
    $readonly = "readonly";
    $tit = "직원정보 수정";
} else {
    $readonly = "";
    $tit = "직원정보 추가";
}
?>

<?php if(session()->getFlashdata('success')): ?>
    <script>
        alert('<?php echo session()->getFlashdata('success'); ?>');
    </script>
<?php endif; ?>

    <script type="text/javascript">

        function send_it() {
            var frm = document.frm;
            if (frm.id_chk.value == "N") {
                frm.user_id.focus();
                alert("아이디 중복체크를 해주셔야 합니다.");
                return;
            }
            if (frm.user_name.value == "") {
                frm.user_name.focus();
                alert("이름을 입력해 주세요. ");
                return;

            }

            frm.submit();
        }
    </script>


    <div id="container" class="ad_write">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $tit ?></h2>
                    <div class="menus">
                        <ul>
                            <li><a href="/AdmMaster/_adminrator/store_config_admin" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt"><?= $m_idx ? "수정" : "등록" ?></span></a></li>

                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <form name="frm" action="write_admin_ok" method="post" enctype="multipart/form-data">
                <input type="hidden" name="m_idx" value="<?= $m_idx ?>">
                <input type="hidden" name="o_status" value="">

                <?php if ($m_idx) { ?>
                    <input type="hidden" name="id_chk" id="id_chk" value="Y">
                <?php } else { ?>
                    <input type="hidden" name="id_chk" id="id_chk" value="N">
                <?php } ?>
                <input type="hidden" name="agent_idx" id="agent_idx" value="">

                <div id="contents">
                    <div class="listWrap_noline">


                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%">
                                    <col width="40%">
                                    <col width="10%">
                                    <col width="40%">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>아이디</th>
                                    <td>
                                        <input type="text" name="user_id"
                                               value="<?= $user_id ?>" id="user_id"
                                               class="half frm_input" style="width:200px;height:30px;" maxlength="20"
                                               style="ime-mode:disabled" <?= $readonly ?> >

                                        <?php if ($readonly == "") { ?>
                                            <a href="javascript:id_check();" class="btn btn-default"><span
                                                        class="txt">중복확인</span></a>
                                        <?php } ?>
                                    </td>
                                    <th>비밀번호</th>
                                    <td><input type="password" name="user_pw" value="" class="bbs_inputbox_pixel"
                                               style="width:200px;height:30px;" maxlength="50/" autocomplete="new-password"></td>
                                </tr>
                                <tr>
                                    <th>이메일</th>
                                    <td><input type="text" name="user_email"
                                               value="<?= $user_email ?>"
                                               class="bbs_inputbox_pixel" style="width:200px;height:30px;"
                                               maxlength="50/"></td>
                                    <th>직급</th>
                                    <td><input type="text" name="user_post"
                                               value="<?= $user_post ?>"
                                               class="text"
                                               style="width:200px;height:30px;"></td>
                                </tr>

                                <tr>
                                    <th>이름</th>
                                    <td><input type="text" name="user_name"
                                               value="<?= $user_name ?>"
                                               class="bbs_inputbox_pixel" style="width:200px;height:30px;"
                                               maxlength="50/"></td>
                                    <th>휴대폰</th>
                                    <td><input type="text" name="user_mobile"
                                               value="<?= $user_mobile ?>"
                                               class="text"
                                               style="width:200px;height:30px;"></td>
                                </tr>

                                <tr>
                                    <th>현황</th>
                                    <td>
                                        <select name="status">
                                            <?php if ($status == "Y") { ?>
                                                <option value="Y" selected>이용중</option>
                                                <option value="N">정지중</option>
                                            <?php } else if ($status == "N") { ?>
                                                <option value="Y">이용중</option>
                                                <option value="N" selected>정지중</option>
                                            <?php } else { ?>
                                                <option value="Y" selected>이용중</option>
                                                <option value="N">정지중</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <th>직통번호</th>
                                    <td><input type="text" name="user_phone"
                                               value="<?= $user_phone ?>"
                                               class="text"
                                               style="width:200px;height:30px;"></td>
                                </tr>
                                <tr class="cls_out">
                                    <th>권한</th>
                                    <td colspan="3">
                                        <table style="width:100%">
                                            <tbody>
                                            <tr>
                                                <td colspan='2'>
                                                    <button type='button' style='width:10%' onclick='chk_sel();'
                                                            class="btn btn-success">전체선택
                                                    </button>
                                                    <button type='button' style='width:10%' onclick='chk_not_sel();'
                                                            class="btn btn-danger">선택취소
                                                    </button>
                                                </td>

                                            </tr>

                                            <?php

                                            foreach ($adminMenus as $keys1 => $vals1) {

                                                ?>
                                                <tr style="height:45px">
                                                    <td style="width:120px;text-align:center;background-color:#fafafa;font-weight:bold;color:#000000"><?= $vals1['name'] ?></td>
                                                    <td>
                                                        <?php

                                                        foreach ($vals1['submenus'] as $keys2 => $vals2) {
                                                            $checked = "";
                                                            if (strpos($auth, $vals2['code']) !== false) {
                                                                $checked = "checked=\"checked\"";
                                                            } ?>
                                                            <input type="checkbox" name="auth[]"
                                                                   value="<?= $vals2['code'] ?>"
                                                                   id="<?= $vals2['code'] ?>" <?= $checked; ?>>
                                                            <label for="<?= $vals2['code'] ?>"><?= $vals2['name'] ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <th>이미지첨부</th>
                                    <td colspan="3">
                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                               style="width:500px;"/>
                                        <br>
                                        <?php if ($ufile1 != "") { ?>
                                            <img src="../../data/member/<?= $ufile1 ?>" alt="<?= $rfile1 ?>"
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                            <br>
                                            파일삭제: <input type=checkbox name="del_1" value='Y'>
                                            <a href="/include/dn.php?mode=member&ufile=<?= $ufile1 ?>&rfile=<?= $rfile1 ?>"><?= $rfile1 ?></a>
                                        <?php } ?>
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

                                    <a href="/AdmMaster/_adminrator/store_config_admin" class="btn btn-default"><span
                                                class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>

                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt"><?= $m_idx ? "수정" : "등록" ?></span></a>
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


    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none;"></iframe>

    <script>


        function change_it(str) {
            if (str == "O") {
                $(".cls_out").show();
            } else {
                $(".cls_out").hide();
            }
        }

        function del_it() {
            if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
                $.ajax({
                    url: "./del.php",
                    type: "GET",
                    data: "m_idx[]=" + $("input[name='m_idx']").val(),
                    error: function (request, status, error) {
                        //통신 에러 발생시 처리
                        alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    }
                    , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                    }
                    , success: function (response, status, request) {
                        if (response == 'OK') {
                            alert_("정상적으로 삭제되었습니다.");
                            setTimeout(function () {
                                location.href = "board_list.php?code=<?=$code?>&scategory=<?=$scategory?>";
                            }, 1000);
                        } else {
                            alert(response);
                            alert_("오류가 발생하였습니다!!");
                            return;
                        }
                    }
                });
            }

        }


        function id_check() {
            if ($('#user_id').val().length < 6) {
                $('#user_id').focus();
                alert("아이디는 6자 이상 등록해주셔야 합니다.");
                return;
            }

            $.ajax({
                url: "/AdmMaster/_member/adminrator_id_chk_ajax",
                type: "GET",
                data: "userid=" + $("#user_id").val(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {

                    response = response.trim();

                    $("#id_chk").val("N");

                    if (parseInt(response) > 0) {
                        alert("이미 사용중인 아이디입니다.");
                        $("#user_id").focus();
                        return false;
                    } else {
                        $("#id_chk").val("Y");
                        $("#user_id").val($("#user_id").val());
                        alert("사용가능한 아이디입니다.");
                    }


                    $('#user_id').focus();
                }
            });
        }

        function chk_sel() {
            var chk_total = $('input[name="auth[]"]').length;
            for (var i = 0; i < chk_total; i++) {
                $('input[name="auth[]"]').eq(i).prop("checked", true);
            }
        }

        function chk_not_sel() {
            var chk_total = $('input[name="auth[]"]').length;
            for (var i = 0; i < chk_total; i++) {
                $('input[name="auth[]"]').eq(i).prop("checked", false);
            }
        }

    </script>

<?= $this->endSection() ?>