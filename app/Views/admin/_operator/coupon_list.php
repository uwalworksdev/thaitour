<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<?

?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>쿠폰관리</h2>
                <div class="menus">
                    <ul class="first">
                        <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)"
                               class="btn btn-success">전체선택</a></li>
                        <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)"
                               class="btn btn-success">선택해체</a></li>
                        <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                    </ul>

                    <ul class="last">
                        <!-- <li><a href="coupon_write" class="btn btn-primary"><span
                                        class="glyphicon glyphicon-pencil"></span> <span class="txt">신규등록</span></a>
                        </li> -->
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">

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
                                <col width="60px"/>
                                <col width="60px"/>
                                <col width="130px"/>
                                <col width="*"/>
                                <col width="150px"/>
                                <col width="150px"/>
                                <col width="100px"/>
                                <col width="150px"/>
                                <col width="90px"/>
                                <col width="90px"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>선택</th>
                                <th>번호</th>
                                <th>쿠폰번호</th>
                                <th>쿠폰이름</th>
                                <th>등록일</th>
                                <th>사용기간</th>
                                <th>할인율</th>
                                <th>소유자</th>
                                <th>상태</th>
                                <th>삭제</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            if ($nTotalCount == 0) {
                                ?>
                                <tr>
                                    <td colspan="10" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                </tr>
                                <?php
                            }
                            foreach ($result as $row) {
                                $today = date('Y-m-d');
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="idx[]" class="idx code_idx"
                                               value="<?= $row['c_idx'] ?>"/></td>
                                    <td><?= $num-- ?></td>
                                    <td class="tac"><?= $row["coupon_num"] ?></td>
                                    <td class="tac">
                                        <?php
                                        if ($row['types'] == "N") {
                                            echo $row["coupon_name"];
                                        } else {
                                            echo $_set_coupon_type[$row['types']];
                                        }
                                        ?>
                                    </td>
                                    <td class="tac"><?= $row["regdate"] ?></td>
                                    <td class="tac"><?= $row["enddate"] ?></td>
                                    <td class="tac">
                                        <?php
                                        if ($row["dc_type"] == "P") {
                                            echo $row["coupon_pe"] . " %";
                                        } else if ($row["dc_type"] == "D") {
                                            echo number_format($row["coupon_price"]) . "  원";
                                        } else {
                                            echo "회원등급에 따름";
                                        }
                                        ?>
                                    </td>
                                    <td class="tac">
                                        <?php
                                        if ($row["user_id"] == "") {
                                            if ($row["enddate"] == $today || $row["enddate"] > $today) {
                                                echo "<button type='button' onclick='send_coupon(\"" . $row["coupon_num"] . "\");' >발급</button>";
                                            } else {
                                                echo "기한만료";
                                            }
                                        } else {
                                            echo maskNaverId(esc($row['user_id']));
                                        }
                                        ?>
                                    </td>
                                    <td class="tac">
                                        <?php
                                        if ($row["status"] == "D") {
                                            echo "대기";
                                        } elseif ($row["status"] == "N") {
                                            echo "발급";
                                        } elseif ($row["status"] == "E") {
                                            echo "사용";
                                        } elseif ($row["status"] == "C") {
                                            echo "취소";
                                        }
                                        ?>
                                    </td>
                                    <td class="tac"><a href="javascript:del_it('<?= $row['c_idx'] ?>');"><img
                                                    src="/images/admin/common/ico_error.png" alt="에러"/></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <<?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_operator/coupon_list') . "?ca_idx=$ca_idx&search_category=$search_category&search_name=$search_name&pg=") ?>


                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first">
                            </ul>

                            <ul class="last">

                                <li><a href="coupon_write" class="btn btn-primary"><span
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

<div class="coupon_pop">
    <div>
        <form action="find_user" onsubmit="return fn_chk_coupon();">
            <input type="hidden" name="coupon_nums" id="coupon_nums" value=""/>

            <div class="search_box">
                <h2>아이디찾기</h2>
                <input type="text" name="tmp_user_id" id="tmp_user_id" onkeyup="javascript:press_it()">
                <button type="button" onclick="fn_chk_coupon();" class="search">검색</button>
            </div>
            <div class="table_box">
                <table>
                    <caption>아이디찾기</caption>
                    <tbody id="id_contents">

                    </tbody>
                </table>
            </div>
            <div class="sel_box">
                <div>
                    <button type="button" class="close">취소</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {


        $('.coupon_pop').find('.close').on('click', function () {
            $("#coupon_nums").val("");
            $('.coupon_pop').css({'display': 'none'});
        });
    });
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

    function SELECT_DELETE() {
        if ($(".code_idx").is(":checked") === false) {
            alert_("삭제할 내용을 선택하셔야 합니다.");
            return;
        }
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") === false) {
            return;
        }

        $("#ajax_loader").removeClass("display-none");

        let uri = `<?= route_to('admin.operator.coupon_del') ?>`;

        $.ajax({
            url: uri,
            type: "POST",
            data: $("#frm").serialize(),
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
                window.location.href = '/AdmMaster/_operator/coupon_list';
            }
        });
    }

    function del_it(code_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") === false) {
            return;
        }


        $("#ajax_loader").removeClass("display-none");
        let uri = `<?= route_to('admin.operator.coupon_del') ?>`;

        $.ajax({
            url: uri,
            type: "POST",
            data: "idx[]=" + code_idx,
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
                window.location.href = '/AdmMaster/_operator/coupon_list';
            }
        });
    }

    function press_it() {
        if (event.keyCode == 13) {
            fn_chk_coupon();
        }
    }


    function send_coupon(coupon_num) {
        $("#coupon_nums").val(coupon_num);
        $("#tmp_user_id").val("");
        $(".coupon_pop").show();
        $("#tmp_user_id").focus();
    }


    function fn_chk_coupon() {

        var coupon_nums = $("#coupon_nums").val();

        if (coupon_nums.trim() == "") {
            alert("쿠폰 선택이 안되었습니다.");
            return false;
        }

        var user_id = $("#tmp_user_id").val();

        if (user_id.trim() == "") {
            alert("아이디를 입력해주세요.");
            $("#tmp_user_id").focus();
            return false;
        }

        user_id = escape(user_id);

        $.ajax({
            type: "GET"
            , url: "find_user"
            , dataType: "html" //전송받을 데이터의 타입
            , timeout: 30000 //제한시간 지정
            , cache: false  //true, false
            , data: "user_id=" + user_id //서버에 보낼 파라메터
            , error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            }
            , success: function (data) {
                $("#id_contents").html(data);

            }
        });

        return false;
    }

    function sel_user_id(user_id) {

        if (confirm("해당 회원에게 쿠폰을 발급하시겠습니까?")) {

            var coupon_nums = $("#coupon_nums").val();

            if (coupon_nums.trim() == "") {
                alert("쿠폰 선택이 안되었습니다.");
                return false;
            }

            $.ajax({
                type: "GET"
                , url: "/AdmMaster/_operator/send_coupon"
                // , dataType: "html" //전송받을 데이터의 타입
                , timeout: 30000 //제한시간 지정
                , cache: false  //true, false
                , data: "user_id=" + user_id + "&coupon_nums=" + coupon_nums //서버에 보낼 파라메터
                , error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (data) {
                    if (data.result == true) {
                        alert("처리되었습니다.");
                    } else {
                        alert(data.message);
                    }

                    location.reload();

                }
            });
        }
    }

</script>

<?= $this->endSection() ?>
