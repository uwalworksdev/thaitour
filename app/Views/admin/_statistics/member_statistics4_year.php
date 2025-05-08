<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<link rel="stylesheet" href="/js/admin/statistics.js">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">


<div id="container">
    <span id="print_this">
        <header id="headerContainer">

            <div class="inner">
                <h2>회원및 방문분석</h2>
            </div><!-- // inner -->

        </header>
        <div id="contents">
            <div id="mainContentMenu" class="contentMenu">
                <ul>
                    <li class="contentMenuSub">
                        <a href="member_statistics">회원가입통계 </a>
                    </li>
                    <li class="contentMenuSub ">
                        <a href="member_statistics3">방문자수통계</a>
                    </li>
                    <li class="contentMenuSub selected">
                        <a href="member_statistics4">검색어통계</a>
                    </li>
                    <li class="contentMenuSub ">
                        <a href="member_statistics5"> 접속경로관리</a>
                    </li>
                </ul>
                <div class="contentBar left" style="left: 1215.55px; display: none;"></div>
                <div class="contentBar right" style="left: 1459px; display: none;"></div>
            </div>
            <div class="content">
                <div class="listLine"></div>
                <div class="listSelect size09" style="position:relative">
                    <form name="modifyForm1" method="get" action="member_statistics4_year" autocomplete="off">
                        <div class="firstLine selectYear" style="padding-left:0">
                            <select name="years" onchange="fn_search()">
                                <?php for ($ys = 2024; $ys <= date('Y'); $ys++) { ?>
                                    <option value="<?= $ys ?>" <?php if ($ys == $years) echo "selected"; ?>><?= $ys ?>년</option>
                                <?php } ?>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="listSelectR">
                    <div class="contentMenu">
                        <ul>
                            <li class="contentMenuSub selected" data-mode="year" style="width: calc(20% - 2px);"><a href="member_statistics4_year">년간통계</a></li>
                            <li class="contentMenuSub" data-mode="month" style="width: calc(20% - 2px);"><a href="member_statistics4_month">월간통계</a></li>
                            <li class="contentMenuSub" data-mode="week" style="width: calc(20% - 2px);"><a href="member_statistics4_week">주간통계</a></li>
                            <li class="contentMenuSub" data-mode="day" style="width: calc(20% - 2px);"><a href="member_statistics4_day">일간통계</a></li>
                            <li class="contentMenuSub" data-mode="detail" style="width: calc(20% - 2px);"><a href="member_statistics4">특정기간통계</a></li>
                        </ul>
                        <div class="contentBar left" style="left: 460px; display: none;"></div>
                        <div class="contentBar right" style="left: 575px; display: none;"></div>
                    </div>
                </div>

                <div id="listArea">

                    <script>
                        google.charts.load('current', {
                            packages: ['corechart', 'bar']
                        });
                        google.charts.setOnLoadCallback(drawCharts);

                        function drawCharts() {
                            <?php foreach ($data_arr as $i => $row):
                                $keyword = htmlspecialchars($row['keyword'], ENT_QUOTES);
                                $percent = fn_avg($row['tcnt'], $total_cnt);
                            ?>
                                drawSingleChart("<?= $keyword ?>", <?= $percent ?>, "chart_div_<?= $i ?>");
                            <?php endforeach; ?>
                        }

                        function drawSingleChart(keyword, percent, elementId) {
                            var data = google.visualization.arrayToDataTable([
                                ['Keyword', '%', {
                                    role: 'style'
                                }],
                                [keyword, percent, '#4285F4']
                            ]);

                            var options = {
                                legend: {
                                    position: 'none'
                                },
                                hAxis: {
                                    viewWindow: {
                                        min: 0,
                                        max: 100
                                    },
                                    gridlines: {
                                        count: 0
                                    },
                                    ticks: [],
                                    baselineColor: 'transparent'
                                },
                                vAxis: {
                                    baselineColor: 'transparent',
                                    textPosition: 'none',
                                    gridlines: {
                                        color: 'transparent'
                                    }
                                },
                                height: 30,
                                width: '100%',
                                chartArea: {
                                    left: 0,
                                    top: 0,
                                    width: '100%',
                                    height: '100%'
                                },
                                tooltip: {
                                    trigger: 'none'
                                },
                                backgroundColor: 'transparent'
                            };

                            var chart = new google.visualization.BarChart(document.getElementById(elementId));
                            chart.draw(data, options);
                        }
                    </script>
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
                                <th>검색어</th>
                                <th>검색수</th>
                                <th>점유률</th>
                            </tr>
                        </thead>
                        <tbody id="list_all">
                            
                            <?php
                                $tr_index = 0;
                                foreach ($data_arr as $i => $row) {
                                    $percent = fn_avg($row['tcnt'], $total_cnt);
                                    $tr_index++;
                            ?>

                                <tr>
                                    <td class="number"><?= $tr_index ?></td>
                                    <td style="text-align:left;"><?= $row['keyword'] ?></td>
                                    <td class="number"><?= number_format($row['tcnt']) ?></td>
                                    <td>
                                        <div style="display: flex; gap: 30px; align-items: center; width: 100%;">
                                            <div class="per_line" id="chart_div_<?= $i ?>">
                                                <!-- <div class="per_line_bar" data-per="<?= fn_avg($meth, $_total_price) ?>" style="width: <?= fn_avg($row['tcnt'], $total_cnt) ?>%;">&nbsp;</div> -->
                                            </div>
                                            <div class="floatRight size10 fontMontserrat"><?= fn_avg($row['tcnt'], $total_cnt) ?>%</div>
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

<script>
    // 검색하기
    function fn_search() {
        let frm = document.modifyForm1;
        frm.submit();

    }
</script>

<?= $this->endSection() ?>