<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<?php


$titleStr = "생성";

if ($idx) {
    foreach ($row as $keys => $vals) {
        ${$keys} = $vals;
    }

    $titleStr = "수정";
}


?>
    <script type="text/javascript">

        function send_it() {

            $("#ajax_loader").removeClass("display-none");

            var frm = document.frm;

            if (frm.coupon_name.value == "") {
                frm.coupon_name.focus();
                alert("쿠폰명을 입력하셔야 합니다.");
                return;
            }

            if ($("#dc_type").val() == "P") {
                if (frm.coupon_pe.value == "") {
                    frm.coupon_pe.focus();
                    alert("할인율 설정을 입력하셔야 합니다.");
                    return;
                }
            } else {
                if (frm.coupon_price.value == "") {
                    frm.coupon_price.focus();
                    alert("할인가격 설정을 입력하셔야 합니다.");
                    return;
                }
            }
            /*
            if (frm.dex_price_pe.value == "")
            {
                frm.dex_price_pe.focus();
                alert("할인율 상한선을 입력하셔야 합니다.");
                return;
            }
            */

            if (frm.exp_days.value == "") {
                frm.exp_days.focus();
                alert("발행일수를 입력하셔야 합니다.");
                return;
            }

            frm.submit();
        }

    </script>


    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2>쿠폰설정 <?= $titleStr ?> </h2>
                    <div class="menus">
                        <ul>
                            <li><a href="javascript:history.back();" class="btn btn-default"><span
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

            <form name="frm" action="<?= route_to('admin.operator.coupon_setting_write_ok') ?>" method="post"
                  enctype="multipart/form-data"
                  target="hiddenFrame">
                <input type="hidden" name="idx" value='<?= $idx ?>'>
                <input type="hidden" name="publish_type" value='N'> <!-- 일반 쿠폰만 사용 -->


                <div id="contents">
                    <div class="listWrap_noline">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>


                                <tr>
                                    <th>쿠폰명</th>
                                    <td>
                                        <input type="text" id="coupon_name" name="coupon_name"
                                               value="<?= isset($row) ? $row['coupon_name'] : '' ?>"
                                               class="input_txt" style="width:30%"/>
                                    </td>
                                </tr>
                                <input type="hidden" name="coupon_type" id="coupon_type" value="both">

                                <tr>
                                    <th>할인방법</th>
                                    <td>
                                        <select name="dc_type" id="dc_type">
                                            <option value="P" <?php if (isset($row['dc_type']) && $row['dc_type'] == "P") echo "selected"; ?> >
                                                할인율
                                            </option>
                                            <option value="D" <?php if (isset($row['dc_type']) && $row['dc_type'] == "D") echo "selected"; ?> >
                                                가격할인
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인율 설정</th>
                                    <td>
                                        <input type="text" id="coupon_pe" name="coupon_pe"
                                               value="<?= isset($row) ? $row['coupon_pe'] : '' ?>"
                                               style="width:100px;" class="input_txt onlynum" maxlength="3"/> %
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인가격</th>
                                    <td>
                                        <input type="text" id="coupon_price" name="coupon_price"
                                               value="<?= isset($row) ? $row['coupon_price'] : '' ?>"
                                               style="width:100px;" class="input_txt onlynum"/> 원
                                    </td>
                                </tr>

                                <tr>
                                    <th>발행일수</th>
                                    <td>
                                        <input type="text" id="exp_days" name="exp_days"
                                               value="<?= isset($row) ? $row['exp_days'] : '' ?>"
                                               style="width:100px;" class="input_txt onlynum" maxlength="4"/> 일 <span
                                                style="color:red;margin-left:10px;">발행일수를 기준으로 사용 유효기간 설정.</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>쿠폰설명</th>
                                    <td>
								<textarea name="etc_memo" id="etc_memo" rows="10" cols="100" class="input_txt"
                                          style="width:100%; height:100px;"><?= viewSQ(isset($row) ? $row['etc_memo'] : ''); ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상태설정</th>
                                    <td>
                                        <select name="state" id="state">
                                            <option value="Y" <?php if (isset($row['state']) && $row['state'] == "Y") echo "selected"; ?> >
                                                사용
                                            </option>
                                            <option value="N" <?php if (isset($row['state']) && $row['state'] == "N") echo "selected"; ?> >
                                                중지
                                            </option>
                                        </select>
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
                                    <?php if ($idx == "") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <?php } else { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>

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
            </form>
        </div><!-- 인쇄 영역 끝 //-->
    </div>
    <!-- // container -->
    <script>

        function del_it() {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
                handleDel();
            }
        }

        function handleDel() {
            let uri = `<?= route_to('admin.operator.coupon_setting_del') ?>`;

            $("#ajax_loader").removeClass("display-none");

            $.ajax({
                url: uri,
                type: "POST",
                data: "idx[]=" + `<?= $idx ?? ''?>`,
                async: false,
                cache: false,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    $("#ajax_loader").addClass("display-none");
                    alert_("정상적으로 삭제되었습니다.");
                    window.location.href = '/AdmMaster/_operator/coupon_setting';
                    return;
                }
            });
        }

    </script>
    <iframe width="0" height="0" name="hiddenFrame" id="hiddenFrame" src="" style="display:none;"></iframe>
<?= $this->endSection() ?>