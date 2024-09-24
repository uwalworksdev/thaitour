<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>주문분석</h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="statistics01_01" class="btn btn_email01">카테고리(소분류별)</a></li>
                            <li><a href="statistics01_02" class="btn btn_email01">카테고리(중분류별)</a></li>
                            <li><a href="statistics01_03" class="btn btn_email01">브랜드별 통계</a></li>
                            <li><a href="statistics01_05" class="btn btn_email01">시간대별 주문통계</a></li>
                            <li><a href="statistics01_06" class="btn btn_email01">요일별 주문통계</a></li>
                            <li><a href="statistics01_07" class="btn btn_email01">성별/연령대별 통계</a></li>
                            <li class="mr_10"><a href="statistics01_08" class="btn btn_email01">지역별 주문통계</a></li>
                        </ul>
                    </div>
                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">
                <form name="search" id="search">
                    <input type="hidden" name="gubun" value="<?= $gubun ?>">
                    <div class="statis_floatL">
                        <select name="" id="">

                            <option value="">신발</option>
                            <option value="">남성의류</option>
                            <option value="">남성의류 > 자켓</option>
                            <option value="">남성의류 > 바지</option>
                            <option value="">여성의류</option>
                            <option value="">용품</option>
                        </select>
                        <select name="" id="">
                            <option value="">아웃도어</option>
                        </select>
                    </div>
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

                <div class="listWrap statis01">
                    <!-- 안내 문구 필요시 구성 //-->

                    <form name="frm" id="frm">
                        <div class="listBottom" style="margin-top:-10px;">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable statisTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="*"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>카테고리</th>
                                    <th>최초가</th>
                                    <th>판매가</th>
                                    <th>결제가</th>
                                    <th>상품수량</th>
                                    <th>그래프</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>합계</td>
                                    <td>25,408,000원</td>
                                    <td>25,408,000원</td>
                                    <td>25,408,000원</td>
                                    <td>130개</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>신상품/베스트</td>
                                    <td>25,408,000원</td>
                                    <td>25,408,000원</td>
                                    <td>25,408,000원</td>
                                    <td>16개</td>
                                    <td>
                                        <div data-percent="5%" class="graph01"></div>
                                        <span>5%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>중등산화/전문가용</td>
                                    <td>25,408,000원</td>
                                    <td>25,408,000원</td>
                                    <td>25,408,000원</td>
                                    <td>16개</td>
                                    <td>
                                        <div data-percent="5%" class="graph01"></div>
                                        <span>5%</span>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>
                    <script>
                        $(document).ready(function () {
                            $('.graph01').each(function () {

                                var $Width = $(this).attr('data-percent')
                                //alert($Width)
                                $(this).css({'width': $Width});
                            });
                        });
                    </script>
                    <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_statistics/statistics02_01') . "?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=") ?>


                    <div id="headerContainer">

                        <div class="">
                            <div class="menus">

                            </div>

                        </div><!-- // inner -->

                    </div><!-- // headerContainer -->
                </div><!-- // listWrap -->

            </div><!-- // contents -->


        </div><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->

    <script>
        $(document).ready(function () {
            $('.btn_preview').on('click', function () {
                $('.preview_popup').css({'display': 'block'});
            });

            $('.close_popup').on('click', function () {
                $('.preview_popup').css({'display': 'none'});
            });

            $('.preview_popup').click(function (e) {
                if ($(e.target).hasClass('preview_popup')) {
                    //alert(33);
                    $('.preview_popup').css({'display': 'none'});
                }
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
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
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
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
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
                        alert_("정상적으로 변경되었습니다.");
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }


    </script>
    <script>
        $(function () {
            $(".date_form").datepicker({
                showOn: "both",
                dateFormat: 'yy-mm-dd',
                buttonImageOnly: false,
                showButtonPanel: false,
                changeMonth: false, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
                changeYear: false, // 년을 바꿀수 있는 셀렉트 박스를 표시한다.
                dayNames: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
                dayNamesMin: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT']
            });
        });


    </script>

<?= $this->endSection() ?>