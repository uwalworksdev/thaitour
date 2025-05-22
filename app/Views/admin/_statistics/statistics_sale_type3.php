<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<link rel="stylesheet" href="/js/admin/statistics.js">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">

<style>
    .bar-container {
        width: 352px;
    }
</style>


<?php
    $pay_method['Card']     = "카드결제";
    $pay_method['VBank']    = "무통장(가상계좌)";
    $pay_method['DBank']    = "실시간계좌이체	";

    $addr_group = $code_names;

    $s_date = $_GET['s_date'];
    $e_date = $_GET['e_date'];
    $payin  = $_GET['payin'];


    if ($s_date == "") {
        $s_date = date('Y-m-d');
    }

    if ($e_date == "") {
        $e_date = date('Y-m-d');
    }


    $price_arr = array();


    foreach ($addr_group as $key => $vals) {
        $price_arr[$vals] = 0;
    }


?>

<div id="container">
    <span id="print_this">
        <header id="headerContainer">
            <div class="inner">
                <h2>매출분석</h2>
            </div>
        </header>
        <div id="contents">
            <div id="mainContentMenu" class="contentMenu">
                <ul>
                    <li class="contentMenuSub">
                        <a href="statistics_sale_yoil">매출통계</a>
                    </li>
                    <!-- <li class="contentMenuSub ">
                        <a href="statistics_sale_sales">업체별 매출통계</a>
                    </li> -->

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_type">결제수단매출통계</a>
                    </li>

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_type2">상품분석</a>
                    </li>

                    <li class="contentMenuSub selected">
                        <a href="statistics_sale_type3"> 지역별매출톨계</a>
                    </li>

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_list">매출상세내역</a>
                    </li>
                </ul>
                <div class="contentBar left" style="left: 1215.55px; display: none;"></div>
                <div class="contentBar right" style="left: 1459px; display: none;"></div>
            </div>

            <div class="content">
                <div class="listLine"></div>
                <div class="listSelect size09" style="position:relative">
                    <form name="modifyForm1" method="get" action="statistics_sale_type3" autocomplete="off">
                        <div class="period_search">
                            <div class="period_input">
                                <input type="text" name="s_date" id="s_date" value="<?= $s_date ?>" readonly class="date_form">
                                <span>~</span>
                                <input type="text" name="e_date" id="e_date" value="<?= $e_date ?>" readonly class="date_form">
                            </div>
                            <button type="button" class="contact_btn" rel="<?= date('Y-m-d'); ?>">오늘</button>
                            <button type="button" class="contact_btn" rel="<?= date('Y-m-d', strtotime('-3 day')); ?>">3일</button>
                            <button type="button" class="contact_btn" rel="<?= date('Y-m-d', strtotime('-7 day')); ?>">7일</button>
                            <button type="button" class="contact_btn" rel="<?= date('Y-m-d', strtotime('-1 month')); ?>">1개월</button>

                            <select name="payin" onchange="submit()">
                                <option value="">통합</option>
                                <option value="P">PC</option>
                                <option value="M">모바일</option>
                            </select>
                            <button type="submit">검색</button>
                        </div>

                    </form>
                </div>
                <div class="listSelectR">
                    <div class="contentMenu">
                        <ul>
                            <li class="contentMenuSub " data-mode="year" style="width: calc(20% - 2px);"><a href="statistics_sale_type3_year">년간통계</a></li>
                            <li class="contentMenuSub " data-mode="month" style="width: calc(20% - 2px);"><a href="statistics_sale_type3_month">월간통계</a></li>
                            <li class="contentMenuSub " data-mode="week" style="width: calc(20% - 2px);"><a href="statistics_sale_type3_week">주간통계</a></li>
                            <li class="contentMenuSub" data-mode="day" style="width: calc(20% - 2px);"><a href="statistics_sale_type3_day">일간통계</a></li>
                            <li class="contentMenuSub selected" data-mode="detail" style="width: calc(20% - 2px);"><a href="statistics_sale_type3">특정기간통계</a></li>
                        </ul>
                        <div class="contentBar left" style="left: 460px; display: none;"></div>
                        <div class="contentBar right" style="left: 575px; display: none;"></div>
                    </div>
                </div>

                <div id="listArea">
                    <div class="empty10">&nbsp;</div>
                    <div class="alignLeft">
                        <form name="deviceForm" autocomplete="off">

                        </form>
                    </div>
                    <div class="empty10">&nbsp;</div>
                    <div style="display: flex;">
                        <div id="chart-area" style="width: 100%;">
                            <div id="curve_chart1" style="height:500px;"></div>
                        </div>

                        <script type="text/javascript">
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });

                            var regions = <?=json_encode($code_names)?>

                            const dataMap = {};

                            const dataRows = regions.map(name => [name, dataMap[name] || 10]);
                            
                            google.charts.setOnLoadCallback(drawPieChart);
                            google.charts.setOnLoadCallback(drawBarChart);

                            function drawPieChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['수단', '매출'],
                                    ...dataRows
                                ]);

                                var options = {
                                    title: '',
                                    curveType: '',
                                    legend: {
                                        position: 'bottom'
                                    },
                                    tooltip: {
                                        isHtml: true
                                    },
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('curve_chart1'));
                                chart.draw(data, options);
                            }

                            function drawBarChart() {
                                var total = dataRows.reduce((sum, row) => sum + row[1], 0);
                                var rows = [
                                    ["강원", 10, "#4285F4"],
                                    ["경기", 10, "#4285F4"],
                                    ["경남", 10, "#4285F4"],

                                    ["경북", 10, "#4285F4"],
                                    ["광주", 10, "#4285F4"],
                                    ["대구", 10, "#4285F4"],

                                    ["대전", 10, "#4285F4"],
                                    ["부산", 10, "#4285F4"],
                                    ["서울", 10, "#4285F4"],

                                    ["세종", 10, "#4285F4"],
                                    ["울산", 10, "#4285F4"],
                                    ["인천", 10, "#4285F4"],

                                    ["전남", 10, "#4285F4"],
                                    ["전북", 10, "#4285F4"],
                                    ["제주", 10, "#4285F4"],

                                    ["충남", 10, "#4285F4"],
                                    ["충북", 10, "#4285F4"],
                                ];

                                rows.forEach((row, index) => {
                                    var percentage = (row[1] / total) * 100;
                                    var container = document.createElement('div');
                                    container.classList.add('bar-container');

                                    document.querySelectorAll('.per_line')[index].appendChild(container);

                                    if (percentage > 0) {
                                        var bar = document.createElement('div');
                                        bar.classList.add('bar');
                                        bar.style.width = percentage + '%';
                                        bar.style.height = '20px';
                                        bar.style.backgroundColor = row[2];
                                        container.appendChild(bar);
                                    }
                                });
                            }
                        </script>


                    </div>

                    <div class="empty10">&nbsp;</div>

                    <table class="listIn fixed-header">
                        <colgroup>
                            <col width="8%"> <!-- 순위 -->
                            <col width="20%"> <!-- 결제수단 -->
                            <col width="20%"> <!-- 총매출 -->
                            <col width="52%"> <!-- 점유률 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>순위</th>
                                <th>지역별</th>
                                <th>매출</th>
                                <th>점유률</th>
                            </tr>
                        </thead>
                        <tbody id="list_all">

                            <?php

                            $ordered_methods = $code_names;
                            $sorted_price_arr = [];

                            foreach ($ordered_methods as $method) {
                                if (isset($price_arr[$method])) {
                                    $sorted_price_arr[$method] = $price_arr[$method];
                                }
                            }
                            $tr_index = 0;
                            foreach ($sorted_price_arr as $key => $addrs) {
                                $tr_index++;
                            ?>
                                <tr>
                                    <td class="number"><?= $tr_index ?></td>
                                    <td style="text-align:left;"><?= $key ?></td>
                                    <td class="number"><?= number_format($addrs) ?></td>
                                    <td>
                                        <div style="display: flex; gap: 30px; align-items: center; width: 100%;">
                                            <div class="per_line">
                                            </div>
                                            <div class="floatRight size10 fontMontserrat"><?= $addrs ?>%</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </span>
</div>

<?= $this->endSection() ?>

<script>
    $(".date_form").datepicker({
        showButtonPanel: true,
        beforeShow: function(input) {
            setTimeout(function() {
                var buttonPane = $(input)
                    .datepicker("widget")
                    .find(".ui-datepicker-buttonpane");
                var btn = $(
                    '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                );
                btn.unbind("click").bind("click", function() {
                    $.datepicker._clearDate(input);
                });
                btn.appendTo(buttonPane);
            }, 1);
        },
        dateFormat: 'yy-mm-dd',
        showOn: "both",
        yearRange: "c-100:c+10",
        buttonImage: "/AdmMaster/_images/common/date.png",
        buttonImageOnly: true,
        closeText: '닫기',
        prevText: '이전',
        nextText: '다음'

    });


    $(".contact_btn").click(function() {

        var date1 = $(this).attr("rel");
        var date2 = $.datepicker.formatDate('yy-mm-dd', new Date());

        $("#s_date").val(date1);
        $("#e_date").val(date2);

    });
</script>