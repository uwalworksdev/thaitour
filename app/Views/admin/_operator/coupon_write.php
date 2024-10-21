<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<?php
$titleStr = "생성";
?>
<script type="text/javascript">

    function send_it() {
        var frm = document.frm;

        if (frm.coupon_cnt.value == "") {
            frm.coupon_cnt.focus();
            alert("발행 매수를 입력해주세요.");
            return;
        }


        frm.submit();
    }

</script>


<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>쿠폰 <?= $titleStr ?> </h2>
                <div class="menus">
                    <ul>
                        <li><a href="javascript:history.back();" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>

                        <?php if ($idx) { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>

                            <li><a href="javascript:del_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
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
                <div class="listBottom">
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                        <caption>
                        </caption>
                        <colgroup>
                            <col width="10%"/>
                            <col width="90%"/>
                        </colgroup>
                        <tbody>


                        <form name="frm" action="coupon_write_ok" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idx" value='<?= $idx ?>'>
                            <tr>
                                <th>쿠폰타입</th>
                                <td>
                                    <select name="coupon_type" id="coupon_type">
                                        <option value="">선택</option>
                                        <?php

                                        foreach ($result_c as $row_c) {
                                            ?>
                                            <option value="<?= $row_c['idx'] ?>"><?= $row_c['coupon_name'] ?></option>
                                        <?php } ?>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>발행방식</th>
                                <td>
                                    <input type="radio" name="send_type" id="send_direct" onclick="sel_type();"
                                           class="type_sel" value="D" checked/>직접입력
                                    <input type="radio" name="send_type" id="send_excel" onclick="sel_type();"
                                           class="type_sel" value="E"/>엑셀전송
                                </td>
                            </tr>

                            <tr id="direct" style="display:;">
                                <th>발행매수</th>
                                <td>
                                    <input type="text" name="coupon_cnt" id="coupon_cnt" class="onlynum"
                                           style="width:100px;text-align:right;" value="" maxlength="3"/>
                                    <a href="#!" onclick="send_it();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                </td>
                            </tr>
                        </form>

                        <form name="excelForm" id="excelForm" method="post" action="./excel_coupon_upload.php"
                              onsubmit="return chkUpload(this);" enctype="multipart/form-data">
                            <tr id="excel" style="display:none;">
                                <th>엑셀양식</th>
                                <td>
                                    <input type="hidden" name="coupon_type_e" id="coupon_type_e" value="">
                                    <input type="file" name="xls_file" id="xls_file" value=""/>
                                    <a href="#!" onclick="send_excel();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">전송</span></a>
                                    <a href="https://<?= $_SERVER["HTTP_HOST"] ?>/excel/coupon.xlsx"
                                       class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span
                                                class="txt">양식 다운로드</span></a>
                                </td>
                            </tr>
                        </form>


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
<!-- // container -->

<script>
    // 전송 버튼 눌렀을 때에...
    function sel_type() {
        var send_type = $("input[name='send_type']:checked").val();

        if (send_type == "D") {
            $("#direct").css('display', '');
            $("#excel").css('display', 'none');
        } else if (send_type == "E") {
            $("#direct").css('display', 'none');
            $("#excel").css('display', '');
        }

    }
</script>

<script src='//code.jquery.com/jquery.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js'></script>

<script>
    function chkUpload() {


        return true;
    }

    function send_excel() {
        $("#ajax_loader").removeClass("display-none");

        if ($("#coupon_type").val() == "") {
            alert("쿠폰타입을 선탁하세요!");
            return false;
        }

        var f = document.excelForm;

        if ($("#xls_file").val() == "") {
            alert("업로드할 엑셀을 선탁하세요!");
            return false;
        }

        //$("#excelForm").submit();

        $("#coupon_type_e").val($("#coupon_type").val());
        var excelForm = document.getElementById('excelForm');
        formData = new FormData(excelForm);
        $.ajax({
            url: "./excel_coupon_upload.php",
            type: "post",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
        }).done(function (data) {
            save_result = data;
            var obj = jQuery.parseJSON(save_result);
            var message = obj.message;
            alert('업로드 완료 ' + message + '건');
            location.href = '/AdmMaster/_operator/coupon_list.php';
        });


    }

    $(document).ready(function () {
        $("#types").change(function () {

            if ($("#types").val() == "N") {
                $("#coupon_type").prop("disabled", false);
            } else {
                $("#coupon_type").val("");
                $("#coupon_type").prop("disabled", true);
            }
        });


    });
</script>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none;"></iframe>
<?= $this->endSection() ?>
