<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<div id="container">
<span id="print_this">
    <header id="headerContainer">
        <div class="inner">
            <h2>자동메일관리</h2>
            <div class="menus">
                <ul class="first">
                    <li>
                        <a href="email_view" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil"></span> 
                            <span class="txt">상품 등록</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div id="contents">
        <div class="listWrap">
            <div class="listTop">
                <div class="left">
                    <p class="schTxt">■ 총 <?= $total_count ?>개의 목록이 있습니다.</p>
                </div>
            </div>

            <form name="frm" id="frm">
                <div class="listBottom">
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                        <colgroup>
                            <col width="15%" />
                            <col width="*%" />
                            <col width="15%" />
                            <col width="15%" />
                            <col width="7%" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th>메일코드</th>
                                <th>메일명</th>
                                <th>미리보기</th>
                                <th>자동발송여부</th>
                                <th>관리</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($emails)) : ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($emails as $row) : ?>
                                    <tr>
                                        <td><?= esc($row['code']) ?></td>
                                        <td><a href="/AdmMaster/_member/email_view?idx=<?= esc($row['idx']) ?>"><?= esc($row['title']) ?></a></td>
                                        <td><a href="javascript:void(0)" class="btn_preview" rel="<?= esc($row['idx']) ?>">미리보기</a></td>
                                        <td>
                                            <?= ($row['autosend'] == "Y") ? "자동발송" : "사용안함" ?>
                                        </td>
                                        <td>
                                            <a href="/AdmMaster/_member/email_view?idx=<?= esc($row['idx']) ?>">
                                                <img src="/images/admin/common/ico_setting2.png" alt="설정"/>
                                            </a>
                                            <a href="javascript:del_it('<?= $row['idx'] ?>');">
                                                <img src="/images/admin/common/ico_error.png" alt="에러"/>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>

            <div id="headerContainer">
                <div class="">
                    <div class="menus">
                        <ul class="first">
                            <!-- Thêm menu nếu cần -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </span>
</div>

<div class="preview_popup">
    <div class="popup_box">
        <div style="height:500px;">
            <iframe style="width:100%;height:100%;" name="previews" id="previews" src=""></iframe>
        </div>
        <a href="javascript:void(0)" class="close_popup">CLOSE</a>
    </div>
</div>

<script>
    function del_it(idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            handleDel(idx);
        }
    }

    async function handleDel(idx) {
        let uri = '/AdmMaster/_member/email_delete';

        $("#ajax_loader").removeClass("display-none");

        $.ajax({
            url: uri,
            type: "POST",
            data: "idx[]=" + idx,
            async: false,
            cache: false,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert("정상적으로 삭제되었습니다.");
                location.reload();
                return;
            }
        });
    }
</script>

<script>
    $(document).ready(function(){
        $('.btn_preview').on('click',function(){
            var tmp_idx = $(this).attr("rel");
            $("#previews").prop("src", "/AdmMaster/_member/pre_viw_mail?idx=" + tmp_idx);
            $('.preview_popup').css({'display':'block'});
        });

        $('.close_popup').on('click',function(){
            $("#previews").prop("src", "");
            $('.preview_popup').css({'display':'none'});
        });

        $('.preview_popup').click(function(e){
            if ($(e.target).hasClass('preview_popup')) {
                $("#previews").prop("src", "");
                $('.preview_popup').css({'display':'none'});
            }
        });
    });
</script>

<script>
    function CheckAll(checkBoxes, checked) {
        if (checkBoxes.length) {
            for (var i = 0; i < checkBoxes.length; i++) {
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
            url: "del_deal.php",
            type: "POST",
            data: $("#frm").serialize(),
            error: function(request, status, error) {
                alert_("code : " + request.status + "\r\nmessage : " + request.responseText);
                $("#ajax_loader").addClass("display-none");
            },
            complete: function(request, status, error) {
                // $("#ajax_loader").addClass("display-none");
            },
            success: function(response, status, request) {
                if (response == "OK") {
                    alert_("정상적으로 삭제되었습니다.");
                    location.reload();
                } else {
                    alert(response);
                    alert_("오류가 발생하였습니다!!");
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
            url: "del_deal.php",
            type: "POST",
            data: "idx[]=" + idx,
            error: function(request, status, error) {
                alert_("code : " + request.status + "\r\nmessage : " + request.responseText);
                $("#ajax_loader").addClass("display-none");
            },
            complete: function(request, status, error) {
                // $("#ajax_loader").addClass("display-none");
            },
            success: function(response, status, request) {
                if (response == "OK") {
                    alert_("정상적으로 삭제되었습니다.");
                    location.reload();
                } else {
                    alert(response);
                    alert_("오류가 발생하였습니다!!");
                }
            }
        });
    }

    function chg_it(idx, vals) {
        $("#ajax_loader").removeClass("display-none");
        $.ajax({
            url: "chg_deal.php",
            type: "POST",
            data: "idx=" + idx + "&vals=" + vals,
            error: function(request, status, error) {
                alert_("code : " + request.status + "\r\nmessage : " + request.responseText);
                $("#ajax_loader").addClass("display-none");
            },
            complete: function(request, status, error) {
                // $("#ajax_loader").addClass("display-none");
            },
            success: function(response, status, request) {
                if (response == "OK") {
                    alert_("정상적으로 변경되었습니다.");
                    location.reload();
                } else {
                    alert(response);
                    alert_("오류가 발생하였습니다!!");
                }
            }
        });
    }
</script>

<?= $this->endSection() ?>
