<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
    <style>
        #input_file_ko {
            display: inline-block;
            width: 300px;
        }

        #input_file_ko button {
            margin-right: 5px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
    </style>

    <div id="container">
    <span id="print_this">
        <!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2><?= $config['board_name'] ?></h2>
                <div class="menus">
                    <ul class="last">
                        <li>
                            <a href="javascript:history.back();" class="btn btn-default">
                                <span class="glyphicon glyphicon-th-list"></span>
                                <span class="txt">리스트</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:send_it();" class="btn btn-default">
                                <span class="glyphicon glyphicon-cog"></span>
                                <span class="txt"><?=$bbs_idx ? "수정" : "등록"?></span>
                            </a>
                        </li>
                        <?php if ($bbs_idx): ?>
                            <li>
                                <a href="javascript:del_chk('<?= $bbs_idx ?>');" class="btn btn-default">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    <span class="txt">삭제</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">
            <div class="listWrap_noline">
                <form name=frm id=frm action="bbs_proc.ajax.php" method=post enctype="multipart/form-data">
                    <input type=hidden name="bbs_idx" value='<?= $bbs_idx ?>'>
                    <input type=hidden name="search_mode" value='<?= $search_mode ?>'>
                    <input type=hidden name="search_word" value='<?= $search_word ?>'>
                    <input type=hidden name="scategory" value='<?= $scategory ?>'>
                    <input type=hidden name="code" id="code" value='<?= $code ?>'>
                    <input type=hidden name="pg" value='<?= $pg ?>'>
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <caption></caption>
                            <colgroup>
                                <col width="150px"/>
                                <col width="*"/>
                            </colgroup>
                            <tbody>
                                <?php
								    $ii = 0;
                                    $titles = BBS_WRITE_CONFIG[$code]['titles'] ?? [];
                                    foreach ($titles as $key => $val): 
									      $ii++;
								?>
									
                                    <tr>
                                        <th id="subTit_<?=$ii?>"><?=$val?></th>
                                        <td>
                                            <?=view("admin/_board/input_field", [ "key" => $key ])?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <div id="headerContainer">
                    <div class="inner">
                        <div class="menus">
                            <ul class="last">
                                <li>
                                    <a href="javascript:history.back();" class="btn btn-default">
                                        <span class="glyphicon glyphicon-th-list"></span>
                                        <span class="txt">리스트</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:send_it();" class="btn btn-default">
                                        <span class="glyphicon glyphicon-cog"></span>
                                        <span class="txt"><?=$bbs_idx ? "수정" : "등록"?></span>
                                    </a>
                                </li>
                                <?php if ($bbs_idx): ?>
                                    <li>
                                        <a href="javascript:del_chk('<?= $bbs_idx ?>');" class="btn btn-default">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            <span class="txt">삭제</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>

                        </div>

                    </div><!-- // inner -->

                </div><!-- // headerContainer -->
            </div><!-- // listWrap -->

        </div><!-- // contents -->
        <?=view("admin/_board/comment_area")?>

    </span><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->


    <script type="text/javascript">
        function checkForNumber(str) {
            var key = event.keyCode;
            var frm = document.frm1;
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }


        $(function () {
            $.datepicker.regional['ko'] = {
                showButtonPanel: true,
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $(
                            '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                        );
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
                closeText: '닫기', // 닫기 버튼 패널
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['ko']);

            $(".datepicker").datepicker({
                showButtonPanel: true,
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $(
                            '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                        );
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                },
                dateFormat: 'yy-mm-dd',
                showOn: "both",
                yearRange: "c-100:c+10",
                buttonImage: "/images/admin/common/date.png",
                buttonImageOnly: true,
                closeText: '닫기',
                prevText: '이전',
                nextText: '다음'

            });
            $('img.ui-datepicker-trigger').css({
                'cursor': 'pointer'
            });
            $('input.hasDatepicker').css({
                'cursor': 'pointer'
            });
        });
    </script>


    <script>
        function send_it() {

            if(typeof oEditors != "undefined") {
                oEditors?.getById["contents_"]?.exec("UPDATE_CONTENTS_FIELD", []);
            }

            formData = new FormData(document.getElementById('frm'));
            $.ajax({
                url: "/AdmMaster/_bbs/write_ok" + "<?= $bbs_idx ? "/$bbs_idx" : '' ?>",
                type: "post",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
            }).done(function (obj) {
                alert(obj.message);

                if(formData.get("bbs_idx")) {
                    location.reload();
                } else {
                    history.back();
                }

            });

        }

        function del_chk(bbs_idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            var code = $("#code").val();

            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "<?= route_to('admin.api.bbs.bbs_del') ?>",
                type: "POST",
                data: "bbs_idx[]=" + bbs_idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                },
                complete: function (request, status, error) {
                    $("#ajax_loader").addClass("display-none");
                },
                success: function (response, status, request) {
                    if (response == "OK") {
                        alert("정상적으로 삭제되었습니다.");
                        history.back();
                        return;
                    } else {
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });


        }
    </script>

    <script>
        let first_select_all = true;
        $(".select_all").click(function () {
            if ($("#select_pick_frm .idx").is(":checked") && !first_select_all) {
                $("#select_pick_frm .idx").prop('checked', false);
                $(this).text("전체선택")
            } else {
                $("#select_pick_frm .idx").prop('checked', true);
                $(this).text("선택해체")
            }
            first_select_all = false;
        })

    </script>
    <script>
        function goods_del(idx) {
            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?"))
                return false;

            var message = "";
            $.ajax({

                url: "/AdmMaster/_bbs/event_dis_delete",
                type: "POST",
                data: {
                    "idx": idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }

            });
        }

        function fn_comment() {

            <?php
            if ($_SESSION["member"]["id"] != "") {
            ?>
            if ($("#comment").val() == "") {
                alert("댓글을 입력해주세요.");
                $("#comment").focus()
                return;
            }

            var queryString = $("form[name=com_form]").serialize();
            var message = "";
            $.ajax({

                url: "<?= route_to('admin.api.bbs.comment_proc')?>",
                type: "POST",
                data: queryString,
                async: true,
                cache: false,
                success: function (data, textStatus) {
                    // message = data.message;
                    // alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    console.log(request)
                    alert("code = " + request.status + " \n message = " + request.responseText + " \n error = " +
                        error); // 실패 시 처리
                }
            });
            <?php
            } else {
            ?>
            alert("로그인을 해주세요."); <?php
            } ?>
        }
    </script>
    <script src="./comment.js"></script>

<?= $this->endSection() ?>