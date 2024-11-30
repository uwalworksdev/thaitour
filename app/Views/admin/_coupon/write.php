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

        <form name="frm" action="<?= route_to('admin.coupon.write_ok') ?>" method="post" enctype="multipart/form-data" target="hiddenFrame">
            <input type="hidden" name="idx" value='<?= $idx ?>'>
            <input type="hidden" name="publish_type" value='N'>
            <input type="hidden" name="coupon_type" id="coupon_type" value="both">

            <div id="contents">
                <div class="listWrap_noline">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <colgroup>
                                <col width="10%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                                <tr>
                                    <th>쿠폰명</th>
                                    <td>
                                        <input type="text" id="coupon_name" name="coupon_name"
                                                value="<?= isset($coupon_name) ? $coupon_name : '' ?>"
                                                class="input_txt" style="width:30%"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인방법</th>
                                    <td>
                                        <select name="dc_type" id="dc_type">
                                            <option value="P" <?php if (isset($dc_type) && $dc_type == "P") echo "selected"; ?> >
                                                할인율
                                            </option>
                                            <option value="D" <?php if (isset($dc_type) && $dc_type == "D") echo "selected"; ?> >
                                                가격할인
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인율 설정</th>
                                    <td>
                                        <input type="text" id="coupon_pe" name="coupon_pe"
                                                value="<?= isset($coupon_pe) ? $coupon_pe : '' ?>"
                                                style="width:100px;" class="input_txt onlynum" maxlength="3"/> %
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인가격</th>
                                    <td>
                                        <input type="text" id="coupon_price" name="coupon_price"
                                                value="<?= isset($coupon_price) ? $coupon_price : '' ?>"
                                                style="width:100px;" class="input_txt onlynum"/> 원
                                    </td>
                                </tr>

                                <tr>
                                    <th>발행일수</th>
                                    <td>
                                        <div style="text-align:left;">
											<input type="text" name="exp_start_day" id="exp_start_day" value="<?=isset($exp_start_day) ? date("Y-m-d", strtotime($exp_start_day)) : ''?>" style="text-align: center;background: white; width: 120px;" readonly> ~
											<input type="text" name="exp_end_day" id="exp_end_day" value="<?=isset($exp_end_day) ? date("Y-m-d", strtotime($exp_end_day)) : ''?>" style="text-align: center;background: white; width: 120px;" readonly>
										</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>쿠폰설명</th>
                                    <td>
                                <textarea name="etc_memo" id="etc_memo" rows="10" cols="100" class="input_txt"
                                            style="width:100%; height:100px;"><?= viewSQ(isset($etc_memo) ? $etc_memo : ''); ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상태설정</th>
                                    <td>
                                        <select name="state" id="state">
                                            <option value="Y" <?php if (isset($state) && $state == "Y") echo "selected"; ?> >
                                                사용
                                            </option>
                                            <option value="N" <?php if (isset($state) && $state == "N") echo "selected"; ?> >
                                                중지
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:50px;">
                            
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

                                <tr>
                                    <th>대표이미지(600X400)</th>
                                    <td colspan="3">

                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                                style="width:500px;margin-bottom:10px"/>
                                        <?php if (isset($ufile1) && $ufile1 !== "") { ?>
                                            <br>파일삭제:<input type="checkbox" name="del_1" value='Y'>
                                            <a href="/data/coupon/<?= $ufile1 ?>"
                                                class="imgpop"><?= $rfile1 ?></a>
                                                <br>
                                                <br>
                                            <img src="/data/coupon/<?= $ufile1 ?>" width="200px"/>
                                        <?php } ?>

                                    </td>
                                </tr>

                                <?php for ($i = 2; $i <= 7; $i++) { ?>
                                    <tr>
                                        <th>서브이미지<?= $i - 1 ?>(600X400)</th>
                                        <td colspan="3">

                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                    style="width:500px;margin-bottom:10px"/>
                                            <?php if (isset(${"ufile" . $i}) && ${"ufile" . $i} !== "") { ?>
                                                <br>파일삭제: <input type=checkbox name="del_<?= $i ?>" value='Y'>
                                                <a href="/data/coupon/<?= ${"ufile" . $i} ?>" class="imgpop"><?= ${"rfile" . $i} ?></a>
                                                <br>
                                                <br>
                                                <img src="/data/coupon/<?= ${"ufile" . $i} ?>" width="200px"/>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
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
    $(function () {

        $("#exp_start_day").datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "both",
            buttonImage: "/images/admin/common/date.png",
            buttonImageOnly: true,
            closeText: '닫기',
            currentText: '오늘',
            prevText: '이전',
            nextText: '다음',
            yearRange: "c:c+10",
            minDate: new Date(),
            maxDate: "+99Y",
            onClose: function (selectedDate) {
                $("#exp_end_day").datepicker("option", "minDate", selectedDate);
            },
            beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $('<button class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            }
        });


        $("#exp_end_day").datepicker({
            showButtonPanel: true
            , onClose: function (selectedDate) {
                // To 날짜 선택기의 최소 날짜를 설정
                $("#exp_start_day").datepicker("option", "maxDate", selectedDate);
            }
            , beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            }
            , dateFormat: 'yy-mm-dd'
            , showOn: "both"
            , yearRange: "c:c+30"
            , buttonImage: "/images/admin/common/date.png"
            , buttonImageOnly: true
            , closeText: '닫기'
            , currentText: '오늘' // 오늘 버튼 텍스트 설정
            , prevText: '이전'
            , nextText: '다음'
            , minDate: new Date() 
            , maxDate: "+99Y"
        });
    });
    
</script>
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

        if (frm.exp_start_day.value == "") {
            frm.exp_start_day.focus();
            alert("발행일수를 입력하셔야 합니다.");
            return;
        }

        if (frm.exp_end_day.value == "") {
            frm.exp_end_day.focus();
            alert("발행일수를 입력하셔야 합니다.");
            return;
        }

        frm.submit();
    }

    function del_it() {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            handleDel();
        }
    }

    function handleDel() {
        let uri = `<?= route_to('admin.coupon.delete') ?>`;

        $("#ajax_loader").removeClass("display-none");

        $.ajax({
            url: uri,
            type: "POST",
            data: "idx[]=" + `<?= $idx ?? ''?>`,
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
                window.location.href = '/AdmMaster/_coupon/list';
                return;
            }
        });
    }

</script>
    
<iframe width="0" height="0" name="hiddenFrame" id="hiddenFrame" src="" style="display:none;"></iframe>
<?= $this->endSection() ?>