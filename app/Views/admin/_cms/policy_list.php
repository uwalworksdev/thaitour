<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<?php
$policy = "회원약관|개인정보처리방침|위치정보 수집|마케팅 정보 수신 동의|쇼핑시 유의사항|교환/환불 안내|";
$policy .= "해외여행자보험|마일리지사용안내|보험안내|서비스이용약관|취소수수료특약|이용약관|여행약관";

$_policy = explode("|", $policy);
?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>
                    약관 및 정책
                </h2>
                <div class="menus">
                    <ul class="first">
                    </ul>

                    <ul class="last">
                        <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                        <li><a href="policy_write" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-pencil"></span> <span class="txt">신규등록</span></a>
                        </li>
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">

            <div class="listWrap">
                <!-- 안내 문구 필요시 구성 //-->

                <div class="listTop">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= count($_policy) ?>개의 목록이 있습니다.</p>
                    </div>

                </div><!-- // listTop -->
                <form name="frm" id="frm">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="120px" />
                                <col width="*" />
                                <col width="120px" />
                                <col width="160px" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>약관명</th>
                                    <th>우선순위</th>
                                    <th>관리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $order = ['reservation', 'voucher', 'invoice'];
                                $shown = [];

                                foreach ($result as $row) {
                                    $code = $row['policy_code'];

                                    if (in_array($code, $order)) {
                                        if (in_array($code, $shown)) {
                                            continue;
                                        }
                                        $shown[] = $code;
                                    }

                                    $is_cancel = ($row["p_idx"] == '19');
                                    $title = null;

                                    if ($code == 'reservation') {
                                        $title = '예약내역 설명';
                                    } elseif ($code == 'voucher') {
                                        $title = '바우처 약관및 규정 관리';
                                    } elseif ($code == 'invoice') {
                                        $title = '인보이스 약관및 규정 관리';
                                    } else {
                                        $title = $row['policy_type'];
                                    }

                                    $link = $is_cancel ? "policy_cancel_list" : "policy_write?p_idx={$row['p_idx']}&r_code=onfo";
                                    $icon_link = $is_cancel ? "policy_cancel_list" : "policy_write?p_idx={$row['p_idx']}";
                                ?>
                                    <tr style="height:50px">
                                        <td><?= $row['p_idx'] ?></td>
                                        <td class="tal">
                                            <a href="<?= $link ?>"><?= $title ?></a>
                                        </td>
                                        <td class="tac">
                                            <input type="text" name="onum[]" value="<?= $row['onum'] ?>" class="input_txt" style="width:50px; text-align: center;">
                                            <input type="hidden" name="p_idx[]" value="<?= $row['p_idx'] ?>" class="input_txt">
                                        </td>
                                        <td class="td_control">
                                            <a href="<?= $icon_link ?>">
                                                <img src="/images/admin/common/ico_setting2.png" class="btn_mod" alt="관리">
                                            </a>
                                            <a href="#!" onclick="del_it('<?= $row['p_idx'] ?>');">
                                                <img src="/images/admin/common/ico_error.png" class="btn_del" alt="삭제">
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_tourLevel/list') . "?ca_idx=$ca_idx&search_category=$search_category&search_name=$search_name&pg=") ?>


                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first">
                            </ul>

                            <ul class="last">
                                <!-- <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li> -->
                                <li><a href="policy_write" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span
                                            class="txt">신규 등록</span></a></li>
                            </ul>

                        </div>

                    </div><!-- // inner -->

                </div><!-- // headerContainer -->
            </div><!-- // listWrap -->

        </div><!-- // contents -->


    </div><!-- 인쇄 영역 끝 //-->
</div><!-- // container -->


<script>
    function del_it(idx) {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
            return false;

        var message = "";
        $.ajax({

            url: "policy_delete",
            type: "POST",
            data: "p_idx[]=" + idx,
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                message = data.message;
                alert(message);
                location.reload();
            },
            error: function(request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }
</script>

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
            url: "policy_change",
            type: "POST",
            data: $("#frm").serialize(),
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                alert(response.message);
                if (response.result == true) {
                    location.reload();
                    return;
                } 
            }
        });
    }
</script>

<?= $this->endSection() ?>