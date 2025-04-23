<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<div id="container">
    <span id="print_this">
        <header id="headerContainer">
            <div class="inner">
                <h2>회원등급관리</h2>
            </div>
        </header>

        <div id="contents">

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
                <div class="listTop">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= esc($nTotalCount) ?>개의 목록이 있습니다.</p>
                    </div>
                </div>

                <form name="frm" id="frm">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="50px" />
                                <col width="60px" />
                                <col width="70px" />
                                <col width="150px" />
                                <col width="150px" />
                                <?php if ($s_status == 'Y') { ?>
                                    <col width="100px" />
                                    <col width="*" />
                                <?php }
                                if ($s_status == 'N') { ?>
                                    <col width="*" />
                                    <col width="150px" />
                                <?php } ?>
                                <col width="150px" />
                                <col width="150px" />
                                <?php if ($s_status == 'Y') { ?>
                                    <col width="150px" />
                                    <col width="200px" />
                                <?php } ?>
                                <col width="100px" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>번호</th>
                                    <th>현황</th>
                                    <th>아이디</th>
                                    <th>이름</th>
                                    <?php if ($s_status == 'Y') { ?>
                                        <th>회원등급</th>
                                    <?php }
                                    if ($s_status == 'N') { ?>
                                        <th>탈퇴사유</th>
                                    <?php } ?>
                                    <?php if ($s_status == 'Y') { ?>
                                        <th>이메일</th>
                                    <?php }
                                    if ($s_status == 'N') { ?>
                                        <th>기타이유</th>
                                    <?php } ?>
                                    <?php if ($s_status == 'Y') { ?>
                                        <th>모바일</th>
                                    <?php }
                                    if ($s_status == 'N') { ?>
                                        <th>탈퇴일</th>
                                    <?php } ?>
                                    <?php if ($s_status == 'Y') { ?>
                                        <th>연락처</th>
                                    <?php } ?>
                                    <?php if ($s_status == 'Y') { ?>
                                        <th>마일리지</th>
                                    <?php } ?>
                                    <th>가입일시</th>
                                    <th>관리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($members as $i => $row) { ?>
                                    <tr>
                                        <td><input type="checkbox" class="m_idx" name="m_idx[]" value="<?= $row['m_idx'] ?>" /></td>
                                        <td><?= $nTotalCount - (($pg - 1) * $g_list_rows + $i) ?></td>
                                        <td><?= $row['status'] == 'Y' ? '정상' : '탈퇴' ?></td>
                                        <td><?=maskNaverId(esc($row['user_id']))?></td>
                                        <td><?= esc($row['user_name']) ?></td>
                                        <?php if ($s_status == 'Y') { ?>
										<td>
										   <?php
											  if($row['user_level'] == "10") echo "일반";
											  if($row['user_level'] == "9")  echo "실버";
											  if($row['user_level'] == "8")  echo "골드";
											  if($row['user_level'] == "7")  echo "VIP";
											  if($row['user_level'] == "6")  echo "VVIP";
										   ?>
									    </td>
                                        <?php } ?>
                                        <?php if ($s_status == 'N') { ?>
                                            <td class="tac"><?= $row["out_reason"] ?></td>
                                            <td class="tac"><?= $row["out_etc"] ?></td>
                                            <td class="tac"><?= $row["out_date"] ?></td>
                                        <?php } ?>
                                        <?php if ($s_status == 'Y') { ?>
                                            <td><?= esc($row['user_email']) ?></td>
                                            <td><?= esc($row['user_mobile']) ?></td>
                                            <td><?= esc($row['user_phone']) ?></td>
                                            <td><?= esc($row['mileage']) ?></td>
                                        <?php }
                                        if ($s_status == 'N') { ?>
                                            <!-- <td><?= esc($row['r_date']) ?></td> -->
                                        <?php } ?>
                                        <td><?= esc($row['r_date']) ?></td>
                                        <td>
                                            <a href="write?idx=<?= $row['m_idx'] ?>&s_status=<?= $s_status ?>"><img
                                                    src="/images/admin/common/ico_setting2.png"></a>
                                            <a href="javascript:del_it('<?= $row['m_idx'] ?>');"><img
                                                    src="/images/admin/common/ico_error.png" alt="삭제" /></a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>

                <!-- 페이지네이션 -->
                <div class="pagination">
                    <?= ipageListing($pg, $nPage, $g_list_rows, $_SERVER['PHP_SELF'] . "?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=") ?>
                </div>
            </div>
        </div>
    </span>
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

        let url = "";

        <?php 
            if($s_status == "Y"){
        ?>   
            url = "member_out";     
        <?php
            }else{
        ?>     
            url = "del";     
        <?php
            }
        ?>

        $.ajax({
            url: url,
            type: "POST",
            data: $("#frm").serialize(),
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                alert_("정상적으로 삭제되었습니다.");
                location.reload();
                return;
            }
        });
    }

    function del_it(m_idx) {

        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        let url = "";

        <?php 
            if($s_status == "Y"){
        ?>   
            url = "member_out";     
        <?php
            }else{
        ?>     
            url = "del";     
        <?php
            }
        ?>

        $("#ajax_loader").removeClass("display-none");
        $.ajax({
            url: url,
            type: "POST",
            data: "m_idx[]=" + m_idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                alert("삭제되었습니다.");
                location.reload();
            }
        });
    }
</script>
<?= $this->endSection() ?>