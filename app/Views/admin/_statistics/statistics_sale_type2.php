<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<link rel="stylesheet" href="/js/admin/statistics.js">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">

<style>
    .statistics_tab a.on {
        border: 1px solid #454545;
        border-bottom: 0;
        color: #252525;
        background: #fff;
        z-index: 00;
    }

    .graph_wrap .graph_area {
        padding: 0;
    }
</style>


<?php
    $s_date = $_GET['s_date'];
    $e_date = $_GET['e_date'];

    if ($s_date == "") {
        $s_date = date('Y-m-d');
    }

    if ($e_date == "") {
        $e_date = date('Y-m-d');
    }

    $goods_arr = array();

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
                    <li class="contentMenuSub ">
                        <a href="statistics_sale_sales">업체별 매출통계</a>
                    </li>

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_type">결제수단매출통계</a>
                    </li>

                    <li class="contentMenuSub selected">
                        <a href="statistics_sale_type2">상품분석</a>
                    </li>

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_type3"> 지역별매출톨계</a>
                    </li>

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_list">매출상세내역</a>
                    </li>
                </ul>
                <div class="contentBar left" style="left: 1215.55px; display: none;"></div>
                <div class="contentBar right" style="left: 1459px; display: none;"></div>
            </div>

            <!-- period_table -->
            <div class="period_table">
                <form action="statistics_sale_type2" method="GET" name="search">
                    <table cellpadding="0" cellspacing="0" summary="">
                        <colgroup>
                            <col style="width: 150px;">
                            <col style="width: auto;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>기간검색</th>
                                <td>
                                    <div class="period_search">
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d') ?>">
                                            <input type="radio" name="period" id="period01">
                                            <label for="period01">오늘</label>
                                        </div>
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d', strtotime('-1 week')); ?>">
                                            <input type="radio" name="period" id="period02">
                                            <label for="period02">1주일</label>
                                        </div>
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d', strtotime('-1 month')); ?>">
                                            <input type="radio" name="period" id="period03">
                                            <label for="period03">1개월</label>
                                        </div>
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d', strtotime('-6 month')); ?>">
                                            <input type="radio" name="period" id="period04">
                                            <label for="period04">6개월</label>
                                        </div>
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d', strtotime('-1 year')); ?>">
                                            <input type="radio" name="period" id="period05">
                                            <label for="period05">1년</label>
                                        </div>
                                        <div class="period_input">
                                            <input type="text" name="s_date" id="s_date" value="<?= $s_date ?>" readonly class="date_form">
                                            <span>~</span>
                                            <input type="text" name="e_date" id="e_date" value="<?= $e_date ?>" readonly class="date_form">
                                        </div>
                                        <button type="button" class="submit_btn" onclick="search_it()">검색</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- // period_table -->
            <!-- graph_wrap -->
            <div class="graph_wrap">
                <h3>통계 그래프</h3>
                <div class="graph_area" style="height: auto;">
                    <div id="curve_chart1"></div>

                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        <?php if (sizeof($goods_arr) > 0) { ?>
                            google.charts.setOnLoadCallback(drawChart);
                        <?php } ?>

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['상품명', '판매수량'],

                                <?php
                                    foreach ($goods_arr as $key => $arr_tmp) {
                                ?>["<?= $arr_tmp['goods_name'] ?>", <?= $arr_tmp['tcnt'] ?>],
                                <?php } ?>
                            ]);

                            var options = {
                                title: '',
                                curveType: '',
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart1'));

                            chart.draw(data, options);
                        }
                    </script>

                </div>
            </div>
            <!-- //graph_wrap -->

            <!-- statistics_table -->
            <div class="statistics_table">
                <div class="table_util">
                    <a href="#" class="excel_down" onclick="location.href='#';">
                        <span>엑셀 다운로드</span>
                    </a>
                </div>
                <form name="frm" id="frm">
                    <table cellpadding="0" cellspacing="0" summary="">
                        <caption></caption>
                        <colgroup>
                            <col style="width:10%;">
                            <col style="width:14%;">
                            <col style="width:auto;">
                            <col style="width:10%;">
                            <col style="width:14%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>순위</th>
                                <th>상품코드</th>
                                <th>상품명</th>
                                <th>판매수량</th>
                                <th>판매합계</th>
                            </tr>
                        </thead>
                        <tbody>    
                            <tr>
                                <td class="center">
                                    1
                                </td>
                                <td class="center">
                                    TD02130203
                                </td>
                                <td class="left">
                                    uwal
                                </td>
                                <td>
                                    0
                                </td>
                                <td>
                                    0
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>

            <?php echo ipageListing(1, 1, 10, $_SERVER["PHP_SELF"] . "?s_date=" . $s_date . "&e_date=" . $e_date . "&pg=") ?>
        </div>
    </span>
</div>

<?= $this->endSection() ?>
