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
                <form name="frm" id="frm">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="*" />
                                <col width="20%" />
                                <col width="10%" />
                                <col width="10%" />
                                <col width="20%" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>회원등급</th>
                                    <th>할인율</th>
                                    <th>등록일</th>
                                    <th>수정일</th>
                                    <th>관리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fresult as $row) { ?>
                                    <tr>
                                        <td><?= esc($row['grade_name']) ?></td>
                                        <td>
										    <input type="text" name="discount_rate" id="discount_rate_<?= esc($row['g_idx']) ?>" value="<?= esc($row['discount_rate']) ?>" style="width:100px;text-align:right;">
										</td>
                                        <td><?= esc($row['upd_date']) ?></td>
                                        <td><?= esc($row['reg_date']) ?></td>
                                        <td>
                                            <button type="button" id="geade_upd" value="<?= esc($row['g_idx']) ?>">등급수정</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                                    <tr>
                                        <td>
										    <input type="text" name="grade_name" id="grade_name" value="" style="width:100px;text-align:left;">
										</td>
                                        <td>
										    <input type="text" name="discount_rate" id="discount_rate" value="<?= esc($row['discount_rate']) ?>" style="width:100px;text-align:right;">
										</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="button" id="geade_add">등급추가</button>
                                        </td>
                                    </tr>
												
                            </tbody>
                        </table>
                    </div>
                </form>

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