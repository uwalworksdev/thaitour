<?php

use App\Controllers\Admin\AdminController;

?>
<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<?php if(session()->getFlashdata('success')): ?>
    <script>
        alert('<?php echo session()->getFlashdata('success'); ?>');
    </script>
<?php endif; ?>
    <link rel="stylesheet" href="/css/admin/sms_contents.css" type="text/css"/>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>운영자 계정관리</h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), true)"
                                   class="btn btn-success">전체선택</a></li>
                            <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), false)"
                                   class="btn btn-success">선택해체</a></li>
                            <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                        </ul>

                        <ul class="last">
                            <li><a href="write" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span
                                            class="txt">직원 등록</span></a></li>
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">
                <form name="search" id="search">
                    <input type="hidden" name="gubun" value="">
                    <header id="headerContents">
                        <select id="" name="search_category" class="input_select">
                            <option value="user_name" <?php if ($search_category == "user_name") {
                                echo "selected";
                            } ?>>직원성명
                            </option>
                            <option value="user_mobile" <?php if ($search_category == "user_mobile") {
                                echo "selected";
                            } ?>>연락처
                            </option>
                        </select>


                        <input type="text" id="" name="search_name" value="<?= $search_name ?>"
                               class="input_txt placeHolder" rel="검색어 입력" style="width:240px;height:30px;">

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
                            <p class="schTxt">■ 총 <?= number_format($nTotalCount) ?>개의 목록이 있습니다.</p>
                        </div>

                    </div><!-- // listTop -->


                    <form name="frm" id="frm">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="70px">
                                    <col width="100px">
                                    <col width="100px">
                                    <col width="*">
                                    <col width="200px">
                                    <col width="170px">
                                    <col width="170px">
                                    <col width="170px">
                                    <col width="170px">
                                    <col width="100px">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>번호</th>
                                    <th>현황</th>
                                    <th>아이디</th>
                                    <th>직원명</th>
                                    <th>직급</th>
                                    <th>이메일</th>
                                    <th>연락처</th>
                                    <th>가입일시</th>
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
                                foreach ($items as $row) {
                                    $statusStr = "";
                                    if ($row["status"] == "Y") {
                                        $statusStr = "이용중";
                                    } elseif ($row["status"] == "N") {
                                        $statusStr = "정지중";
                                    } ?>
                                    <tr>
                                        <td><input type="checkbox" name="m_idx[]" class="m_idx" value="<?= $row['m_idx'] ?>"></td>
                                        <td><?= $row['m_idx'] ?></td>
                                        <td class="tac"><?= $statusStr ?></td>
                                        <td class="tac"><a
                                                    href="write?m_idx=<?= $row['m_idx'] ?>"><?= $row['user_id'] ?></a>
                                        </td>
                                        <td class="tac"><a
                                                    href="write?m_idx=<?= $row['m_idx'] ?>"><?= $row['user_name'] ?></a>
                                        </td>
                                        <td class="tac"><?= $row['user_post'] ?></td>
                                        <td class="tac"><?= $row['user_email'] ?></td>
                                        <td class="tac"><?= $row['user_mobile'] ?></td>
                                        <td class="tac"><?= $row['r_date'] ?></td>
                                        <td>
                                            <a href="write?m_idx=<?= $row['m_idx'] ?>"><img
                                                        src="/images/admin/common/ico_setting2.png"></a>
                                            <a href="javascript:del_it('<?= $row['m_idx'] ?>');"><img
                                                        src="/images/admin/common/ico_error.png" alt="에러"></a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_adminrator/block_ip_list') . "?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=") ?>

                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                    <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), true)"
                                           class="btn btn-success">전체선택</a></li>
                                    <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), false)"
                                           class="btn btn-success">선택해체</a></li>
                                    <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                                </ul>

                                <ul class="last">
                                    <li><a href="write" class="btn btn-primary"><span
                                                    class="glyphicon glyphicon-pencil"></span> <span
                                                    class="txt">직원 등록</span></a></li>
                                </ul>

                            </div>

                        </div><!-- // inner -->

                    </div><!-- // headerContainer -->
                </div><!-- // listWrap -->

            </div><!-- // contents -->


        </div><!-- 인쇄 영역 끝 //-->
    </div>

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
            if ($(".m_idx").is(":checked") == false) {
                alert_("삭제할 내용을 선택하셔야 합니다.");
                return;
            }
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            $("#ajax_loader").removeClass("display-none");

            $.ajax({
                url: "del",
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
                        setTimeout(function () {
                            location.reload();
                            return;
                        }, 1200);
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }

        function del_it(m_idx) {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "del",
                type: "POST",
                data: "m_idx[]=" + m_idx,
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
                            return;
                        }, 1200);
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