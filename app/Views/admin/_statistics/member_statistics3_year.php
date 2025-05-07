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
                    <li class="contentMenuSub selected">
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
                    <form name="modifyForm1" method="get" action="member_statistics3_year" autocomplete="off">
                        <input type="hidden" name="mode" value="time">

                        <div class="firstLine selectYear" style="padding-left:0">
                            <select name="payin" onchange="fn_search()">
                                <option value="">통합</option>
                                <option value="P" <?php if ($payin == "P") echo "selected"; ?>>PC</option>
                                <option value="M" <?php if ($payin == "M") echo "selected"; ?>>모바일</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="listSelectR">
                    <div class="contentMenu">
                        <ul>
                            <li class="contentMenuSub selected" data-mode="year" style="width: calc(20% - 2px);">
                                <a href="member_statistics3_year">년별통계</a>
                            </li>
                            <li class="contentMenuSub " data-mode="month" style="width: calc(20% - 2px);">
                                <a href="member_statistics3_month">월별통계</a>
                            </li>
                            <li class="contentMenuSub " data-mode="day" style="width: calc(20% - 2px);">
                                <a href="member_statistics3_day">일별통계</a>
                            </li>
                            <li class="contentMenuSub " data-mode="week" style="width: calc(20% - 2px);">
                                <a href="member_statistics3">요일별통계</a>
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
                                ['년', '명'],

                                <?php
                                for ($i = $years_s; $i <= $years_e; $i++) {
                                ?>[<?= $i ?>, <?= $price_arr[$i] ?>],
                                <?php } ?>
                            ]);

                            var options = {
                                title: '',
                                curveType: '',
                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    isHtml: true
                                }, // HTML 툴팁 사용
                                hAxis: {
                                    format: '####' // 년도 형식 설정
                                }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

                            chart.draw(data, options);
                        }
                    </script>

                    <table class="listIn fixed-header">
                        <colgroup>
                            <col width="20%">
                            <col width="80%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>년</th>
                                <th>방문자수</th>
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all">
                            <?php
                            for ($i = $years_s; $i <= $years_e; $i++) {
                                $months = str_pad($i, 2, "0", STR_PAD_LEFT);
                            ?>
                                <tr>
                                    <td class="number"><?= $i ?></td>
                                    <td class="number"><?= number_format($price_arr[$i]) ?> <span><?= fn_avg($price_arr[$i], $_total_price) ?>%</span></td>
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
    $(document).click(function(event) {
        var heapBox = event.target.closest(".heapBox.heapBoxBo");

        if (heapBox) {
            $(".heap").hide();
            var heap = $(heapBox).find(".heap");
            heap.toggle();
        } else {
            $(".heap").hide();
        }
    });

    function fn_search() {
        let frm = document.modifyForm1;
        frm.submit();

    }
</script>

<?= $this->endSection() ?>