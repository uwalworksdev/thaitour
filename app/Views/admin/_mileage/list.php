<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>마일리지리스트</h2>
                    <div class="menus">
                        <ul class="first">
                            <li>
                                <a href="write_point" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil"></span> 
                                    <span class="txt">항목별지급</span>
                                </a>
                            </li>
                        </ul>

                        <ul class="last">
                            <li>
                                <a href="write" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil"></span> 
                                    <span class="txt">마일리지부여</span>
                                </a>
                            </li>
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">
                <form name="search" id="search">
                    <header id="headerContents">
                        <select id="" name="search_category" class="input_select" style="width:112px">
                            <option value="user_name" <?php if ($search_category == "user_name") {
                                echo "selected";
                            } ?>>회원명
                            </option>
                            <option value="user_id" <?php if ($search_category == "user_id") {
                                echo "selected";
                            } ?>>아이디
                            </option>
                        </select>


                        <input type="text" id="" name="search_name" value="<?= $search_name ?>"
                               class="input_txt placeHolder" rel="검색어 입력" style="width:240px"/>

                        <a href="javascript:search_it()" class="btn btn-default"><span
                                    class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                    </header><!-- // headerContents -->
                </form>
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
                    <!-- 안내 문구 필요시 구성 //-->


                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                        </div>

                    </div><!-- // listTop -->


                    <form name="frm" id="frm">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="80px"/>
                                    <col width="160px"/>
                                    <col width="160px"/>
                                    <col width="*"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="100px"/>
                                    <col width="160px"/>
                                    <col width="100px"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>적립</th>
                                    <th>사용</th>
                                    <th>내역</th>
                                    <th>회원명</th>
                                    <th>거래구분</th>
                                    <th>마일리지</th>
                                    <th>예약코드</th>
                                    <th>상품코드</th>
                                    <th>적립일자</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if ($nTotalCount == 0) {
                                    ?>
                                    <tr>
                                        <td colspan=11 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php
                                }
                                foreach ($result as $row) {
                                    $order_gubun = get_mileage_name($row["order_gubun"]);
                                    $order_mileage_str = "";
                                    if ($row["order_mileage"] < 0) {
                                        $order_mileage_str = "사용";
                                    } else {
                                        $order_mileage_str = "적립";
                                    }
                                    
                                    $text_use_point = "";
                                    $text_point = "";

                                    if($row["order_gubun"] == "통합결제"){
                                        $text_use_point = "상품결제";
                                    }else{
                                        if($row["point_type"] == "member"){
                                            $text_point = "회원가입";
                                        }else if($row["point_type"] == "comment"){
                                            $text_point = "댓글작성";
                                        }else if($row["point_type"] == "review"){
                                            $text_point = "후기작성";
                                        }else {
                                            $text_point = "상품결제";
                                        }
                                    }

                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $num-- ?></td>
                                        <td><?= $text_point ?></td>
                                        <td><?= $text_use_point ?></td>
                                        <td class="tal"><?= $row["mi_title"] ?></td>
                                        <td class="tac"><?=$row["user_name"]?></td>
                                        <td><?= $order_mileage_str ?></td>
                                        <td><?= number_format($row["order_mileage"]) ?></td>
                                        <td><?= $row["order_no"] ?></td>
                                        <td><?= $row["product_code"] ?></td>
                                        <td><?= $row["mi_r_date"] ?></td>
                                        <td>
                                            <a href="javascript:del_it('<?= $row["m_idx"] ?>','<?= $row["mi_idx"] ?>');"><img
                                                        src="/images/admin/common/ico_error.png" alt="에러"/></a>
                                        </td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <? echo ipageListing($pg, $nPage, $g_list_rows, $_SERVER["PHP_SELF"] . "?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=") ?>


                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                </ul>

                                <ul class="last">
                                    <li><a href="write" class="btn btn-primary"><span
                                                    class="glyphicon glyphicon-pencil"></span> <span
                                                    class="txt">마일리지부여</span></a></li>
                                </ul>

                            </div>

                        </div><!-- // inner -->

                    </div><!-- // headerContainer -->
                </div><!-- // listWrap -->

            </div><!-- // contents -->

        </div><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->


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
            if ($(".mi_idx").is(":checked") == false) {
                alert_("삭제할 내용을 선택하셔야 합니다.");
                return;
            }
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            $("#ajax_loader").removeClass("display-none");

            $.ajax({
                url: "delete",
                type: "POST",
                data: $("#frm").serialize(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response == "OK") {
                        alert("정상적으로 삭제되었습니다.");
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }

        function del_it(m_idx, mi_idx) {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "delete",
                type: "POST",
                data: "m_idx=" + m_idx + "&mi_idx[]=" + mi_idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response.message == "OK") {
                        alert("정상적으로 삭제되었습니다.");
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }


    </script>

<?= $this->endSection() ?>