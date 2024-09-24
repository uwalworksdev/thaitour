<?php

use App\Controllers\Admin\AdminStatisticsController;

?>
<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2>예약통계</h2>
                    <div class="menus">
                        <ul class="first">
                        </ul>
                    </div>
                </div><!-- // inner -->
            </header><!-- // headerContainer -->
            <div id="contents">
                <div class="listWrap statis01">
                    <form name="frm1" id="frm1">
                        <div class="listBottom" style="margin-top:-10px;">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable statisTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="40px"/>
                                    <col width="40px"/>
                                    <col width="40px"/>
                                    <col width="40px"/>
                                    <col width="40px"/>
                                    <col width="40px"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>예약건수</th>
                                    <th>지난주</th>
                                    <th>지난달</th>
                                    <th>이번달</th>
                                    <th>오늘</th>
                                    <th>어제</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>합계</td>
                                    <td><?= number_format($week_count) ?>건</td>
                                    <td><?= number_format($month_count) ?>건</td>
                                    <td><?= number_format($nmonth_count) ?>건</td>
                                    <td><?= number_format($now_count) ?>건</td>
                                    <td><?= number_format($y_count) ?>건</td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>
                    <form name="search" id="search">
                        <input type="hidden" name="gubun" value="<?= $gubun ?>">

                        <header id="headerContents" class="statis_floatR">

                            <select name="sYear" id="sYear">
                                <?php
                                $inDate = date("Y");
                                for ($i = $inDate; $i >= 2015; $i--) {
                                    ?>
                                    <option value="<?= $i ?>" <?php if ($sYear == $i) {
                                        echo "selected";
                                    } ?>><?= $i ?>년
                                    </option>
                                    <?php
                                }

                                ?>

                            </select>
                            <select name="sMonth" id="sMonth">
                                <option value="1" <?php if ($sMonth == "1") {
                                    echo "selected";
                                } ?>>01월
                                </option>
                                <option value="2" <?php if ($sMonth == "2") {
                                    echo "selected";
                                } ?>>02월
                                </option>
                                <option value="3" <?php if ($sMonth == "3") {
                                    echo "selected";
                                } ?>>03월
                                </option>
                                <option value="4" <?php if ($sMonth == "4") {
                                    echo "selected";
                                } ?>>04월
                                </option>
                                <option value="5" <?php if ($sMonth == "5") {
                                    echo "selected";
                                } ?>>05월
                                </option>
                                <option value="6" <?php if ($sMonth == "6") {
                                    echo "selected";
                                } ?>>06월
                                </option>
                                <option value="7" <?php if ($sMonth == "7") {
                                    echo "selected";
                                } ?>>07월
                                </option>
                                <option value="8" <?php if ($sMonth == "8") {
                                    echo "selected";
                                } ?>>08월
                                </option>
                                <option value="9" <?php if ($sMonth == "9") {
                                    echo "selected";
                                } ?>>09월
                                </option>
                                <option value="10" <?php if ($sMonth == "10") {
                                    echo "selected";
                                } ?>>10월
                                </option>
                                <option value="11" <?php if ($sMonth == "11") {
                                    echo "selected";
                                } ?>>11월
                                </option>
                                <option value="12" <?php if ($sMonth == "12") {
                                    echo "selected";
                                } ?>>12월
                                </option>
                            </select>
                            <a href="javascript:search_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                        </header><!-- // headerContents -->
                    </form>
                    <script>
                        function search_it() {
                            var frm = document.search;
                            frm.submit();
                        }
                    </script>
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
                                    <th>일자</th>
                                    <th>예약건수</th>
                                    <th>예약금액</th>
                                    <th>선금</th>
                                    <th>잔금</th>
                                    <th>예약률(합계)</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>합계</td>
                                    <td id="or_c_cnt"></td>
                                    <td id="rd_c_sum"></td>
                                    <td id="rd_d_sum"></td>
                                    <td id="rd_e_sum"></td>
                                    <td id="rd_total_sum"></td>
                                </tr>
                                <?php

                                foreach ($result2 as $row) {
                                    $newController = new AdminStatisticsController();

                                    $row_week = $newController->getData($row);
                                    $or_c = $row["order_cnt"];
                                    $rd_c = $row["order_price"];
                                    $rd_d = $row["deposit_price"];
                                    $rd_e = $row["order_confirm_price"];
                                    $total = $row['deposit_price'] * 100 / $row['order_price'];

                                    ?>
                                    <tr>
                                        <td><?= substr($row["date"], 0, 10) ?>(<?= $dow[$row_week["week"]] ?>)</td>
                                        <td><?= number_format($or_c) ?></td>
                                        <td><?= number_format($rd_c) ?></td>
                                        <td><?= number_format($rd_d) ?></td>
                                        <td><?= number_format($rd_e) ?></td>
                                        <td>
                                            <div data-percent="<?= round($total, 3) ?>%" class="graph01"></div>
                                            <span><?= round($total, 2) ?>%</span>
                                        </td>
                                    </tr>
                                    <?php
                                    $or_c_cnt = $or_c_cnt + $or_c;
                                    $rd_c_sum = $rd_c_sum + $rd_c;
                                    $rd_d_sum = $rd_d_sum + $rd_d;
                                    $rd_e_sum = $rd_e_sum + $rd_e;
                                    $rd_total_sum = $rd_c_sum + $rd_d_sum + $rd_e_sum;
                                }
                                ?>
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
                </div><!-- // listWrap -->
            </div><!-- // contents -->
        </div><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->
    <script>
        $("#or_c_cnt").html("<?=number_format($or_c_cnt)?>");
        $("#rd_c_sum").html("<?=number_format($rd_c_sum)?>");
        $("#rd_d_sum").html("<?=number_format($rd_d_sum)?>");
        $("#rd_e_sum").html("<?=number_format($rd_e_sum)?>");
        $("#rd_total_sum").html("<?=number_format($rd_total_sum)?>");
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