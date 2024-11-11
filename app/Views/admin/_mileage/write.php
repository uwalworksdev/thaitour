<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<?php
$titleStr = "마일리지 생성";

$mi_title = $row["mi_title"] ?? '';
$order_idx = $row["order_idx"] ?? '';
$order_mileage = $row["order_mileage"] ?? '';
$order_gubun = $row["order_gubun"] ?? '';
$m_idx = $row["m_idx"] ?? '';
$product_idx = $row["product_idx"] ?? '';
$mi_r_date = $row["mi_r_date"] ?? '';
if ($m_idx) {
    $titleStr = "마일리지 정보수정";
}

?>
    <script type="text/javascript">
        function checkForNumber(str) {
            var key = event.keyCode;
            var frm = document.frm1;
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }

        function send_it() {
            var frm = document.frm;

            frm.submit();
        }

        $(function () {
            $.datepicker.regional['ko'] = {
                showButtonPanel: true,
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                },
                closeText: '닫기',
                prevText: '이전',
                nextText: '다음',
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                weekHeader: 'Wk',
                dateFormat: 'yy-mm-dd',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: true,
                changeMonth: true,
                changeYear: true,
                showMonthAfterYear: true,
                closeText: '닫기',  // 닫기 버튼 패널
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['ko']);

            $(".datepicker").datepicker({
                showButtonPanel: true
                , beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                }
                , dateFormat: 'yy-mm-dd'
                , showOn: "both"
                , yearRange: "c-100:c+10"
                , buttonImage: "/images/admin/common/date.png"
                , buttonImageOnly: true
                , closeText: '닫기'
                , prevText: '이전'
                , nextText: '다음'

            });
            $('img.ui-datepicker-trigger').css({'cursor': 'pointer'});
            $('input.hasDatepicker').css({'cursor': 'pointer'});
        });

    </script>


    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>
                            <li><a href="javascript:history.back();" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <form name=frm action="write_ok.php" method=post>
                <input type=hidden name="coupon_idx" value='<?= $coupon_idx ?>'>
                <input type="hidden" name="id_chk" value='N'>
                <div id="contents">
                    <div class="listWrap_noline">


                        <div class="listBottom">
                            <div style="font-size:12pt;margin-bottom:10px">■ 마일리지</div>
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
                                    <th>제목</th>
                                    <td colspan="3">
                                        <input type="text" id="mi_title" name="mi_title" value="<?= $mi_title ?>"
                                               class="input_txt" style="width:90%"/>
                                        <input type="hidden" id="m_idx" name="m_idx" value="<?= $m_idx ?>"
                                               class="input_txt"
                                               style="width:150px;ime-mode:disabled"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>회원아이디</th>
                                    <td>
                                        <input type="text" id="user_id" name="user_id" value="<?= $user_id ?>"
                                               class="input_txt"
                                               style="width:150px;ime-mode:disabled"/>
                                        <input type="button" value="아이디검증" onclick="javascript:find_id()">
                                    </td>
                                    <th>부여할마일리지</th>
                                    <td>
                                        <input type="text" id="order_mileage" name="order_mileage"
                                               value="<?= $order_mileage ?>"
                                               class="input_txt" style="width:100px" numberOnly="true" maxlength="7"/>
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
                                    <?php if ($coupon_idx == "") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <?php } else { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <?php if ($coupon_status == "N") { ?>
                                            <a href="javascript:del_it()" class="btn btn-default"><span
                                                        class="glyphicon glyphicon-trash"></span><span
                                                        class="txt">삭제</span></a>
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
        function send_it() {
            var frm = document.frm;
            if (frm.mi_title.value == "") {
                frm.mi_title.focus();
                alert("마일리지명을 입력해주셔야 합니다.");
                return;
            }
            if (frm.user_id.value == "") {
                frm.user_id.focus();
                alert("아이디를 입력해 주셔야 합니다.");
                return;
            }
            if (frm.m_idx.value == "") {
                frm.m_idx.focus();
                alert("아이디를 검증해주셔야 합니다.");
                return;
            }
            if (frm.order_mileage.value == "") {
                frm.order_mileage.focus();
                alert("마일리지를 입력해주셔야 합니다.");
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
                data: "coupon_idx[]=<?=$coupon_idx?>",
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
            /*
                if ($("#user_id").val() != "")
                {
                    $("#ajax_loader").removeClass("display-none");
                    $.ajax({
                        url: "id_check.php",
                        type: "POST",
                        data: "user_id="+$("#user_id").val(),
                        error : function(request, status, error) {
                         //통신 에러 발생시 처리
                            alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                            $("#ajax_loader").addClass("display-none");
                        }
                        ,complete: function(request, status, error) {
                            $("#ajax_loader").addClass("display-none");
                        }
                        , success : function(response, status, request) {
                            if (response == "OK")
                            {
                                alert("존해하지 않는 아이디 입니다.");
                                frm.m_idx.value = "";
                            } else {
                                alert_("사용가능한 아이디입니다.");
                                frm.m_idx.value = response;
                                return;
                            }
                        }
                    });

                }
        */
            var message = "";
            $.ajax({

                url: "./ajax.id_check.php",
                type: "POST",
                data: {
                    "user_id": $("#user_id").val()
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    if (message == "OK") {
                        alert("존해하지 않는 아이디 입니다.");
                        frm.m_idx.value = "";
                    } else {
                        alert("사용가능한 아이디입니다.");
                        frm.m_idx.value = message;
                        //return;
                    }

                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

    </script>
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>