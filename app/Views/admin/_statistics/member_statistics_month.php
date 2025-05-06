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
                    <li class="contentMenuSub selected">
                        <a href="member_statistics">회원가입통계 </a>
                    </li>
                    <li class="contentMenuSub ">
                        <a href="member_statistics3">방문자수통계</a>
                    </li>
                    <li class="contentMenuSub ">
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
                <div class="listSelect size09">
                    <form name="modifyForm1" method="get" action="member_statistics_month" autocomplete="off">

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
                            <li class="contentMenuSub " data-mode="year" style="width: calc(20% - 2px);">
                                <a href="member_statistics_year">년별통계</a>
                            </li>
                            <li class="contentMenuSub selected" data-mode="month" style="width: calc(20% - 2px);">
                                <a href="member_statistics_month">월별통계</a>
                            </li>
                            <li class="contentMenuSub " data-mode="day" style="width: calc(20% - 2px);">
                                <a href="member_statistics_day">일별통계</a>
                            </li>
                            <li class="contentMenuSub " data-mode="week" style="width: calc(20% - 2px);">
                                <a href="member_statistics_yoil">요일별통계</a>
                            </li>
                            <li class="contentMenuSub " data-mode="time" style="width: calc(20% - 2px);">
                                <a href="member_statistics">시간별통계</a>
                            </li>
                        </ul>
                        <div class="contentBar left" style="left: 0px; display: none;"></div>
                        <div class="contentBar right" style="left: 115px; display: none;"></div>

                        <script>
                            var a = 100 / parseInt($(".content .listSelectR .contentMenu ul li").length);
                            $(".content .listSelectR .contentMenuSub").css({
                                'width': 'calc(' + a + '% - 2px)'
                            });
                        </script>
                    </div>
                </div>

                <div id="listArea">

                    <table class="listIn">
                        <colgroup>
                            <col width="50%"> <!-- 회원가입자수 -->
                            <col width="50%"> <!-- 회원탈퇴자수 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>회원가입자수</th>
                                <th>회원탈퇴자수</th>
                            </tr>
                        </thead>
                        <tbody class="statistics">
                            <tr>

                                <td>
                                    <span><i class="xi-desktop masterTooltip" title="PC"></i> <?= number_format($top_banner1_arr['P']) ?></span>
                                    <p><?= number_format($_total_cnt) ?></p>
                                    <span><i class="xi-tablet masterTooltip" title="모바일"></i> <?= number_format($top_banner1_arr['M']) ?></span>
                                </td>

                                <td>
                                    <p><?= number_format($_total_cnt2) ?></p>
                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <div class="empty10">&nbsp;</div>

                    <div id="chart-area">
                        <div id="curve_chart1"></div>
                    </div>

                    <div class="empty10">&nbsp;</div>

                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['월', '가입', '탈퇴'],

                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    $_tmp_date = str_pad($i, 2, "0", STR_PAD_LEFT);
                                ?>['<?= $_tmp_date ?>', <?= $hour_arr[$i] ?? 0 ?>, <?= $hour_arr2[$i] ?? 0 ?>],
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

                    <table class="listIn fixed-header">
                        <colgroup>
                            <col width="20%"> <!-- 닐자 -->
                            <col width="40%"> <!-- 회원가입자수 -->
                            <col width="40%"> <!-- 회원탈퇴자수 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>월</th>
                                <th>회원가입자수</th>
                                <th>회원탈퇴자수</th>
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $months = str_pad($i, 2, "0", STR_PAD_LEFT);
                            ?>
                                <tr>
                                    <td class="number"><?= $years ?>-<?= $months ?></td>
                                    <td class="number"><span><?= $hour_arr[$i] ?></span> <span><?= fn_avg($hour_arr[$i], $_total_cnt) ?>%</span></td>
                                    <td class="number"><span><?= $hour_arr2[$i] ?></span> <span><?= fn_avg($hour_arr2[$i], $_total_cnt2) ?>%</span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="listLineB"></div>
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