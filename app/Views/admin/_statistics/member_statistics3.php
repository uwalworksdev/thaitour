<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<link rel="stylesheet" href="/js/admin/statistics.js">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">

<?php
    $years  = $_GET['years'];
    $months = $_GET['months'];
    $weeks  = $_GET['weeks'];

    if ($years == "") {
        $years = date('Y');
    }

    if ($months == "") {
        $months = date('m');
    }

    if ($weeks == "") {
        $s_date = date('Y-m-01', mktime(0, 0, 0, $months, 1, $years));
        $e_date = date('Y-m-d', mktime(0, 0, 0, $months, date('t', mktime(0, 0, 0, $months, 1, $years)), $years));
    } else {

        $week_tmp = getWeeksOfMonth($years, $months);
        foreach ($week_tmp as $index => $week_tmp) {

            if (($index + 1) == $weeks) {
                $s_date = $week_tmp['start'];
                $e_date = $week_tmp['end'];
            }
        }
    }

    $yoil_arr = array();
    $yoil_arr[1] = "일";
    $yoil_arr[2] = "월";
    $yoil_arr[3] = "화";
    $yoil_arr[4] = "수";
    $yoil_arr[5] = "목";
    $yoil_arr[6] = "금";
    $yoil_arr[7] = "토";

    $price_arr = array();

    $price_arr[1] = 0;  // 일
    $price_arr[2] = 0;  // 월
    $price_arr[3] = 0;  // 화
    $price_arr[4] = 0;  // 수
    $price_arr[5] = 0;  // 목
    $price_arr[6] = 0;  // 금
    $price_arr[7] = 0;  // 토

?>

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
                    <form name="modifyForm1" method="get" action="member_statistics3" autocomplete="off">
                        <input type="hidden" name="mode" value="time">

                        <div class="firstLine selectYear" style="padding-left:0">
                            <select name="years" onchange="fn_search()">
                                <?php for ($ys = 2024; $ys <= date('Y'); $ys++) { ?>
                                    <option value="<?= $ys ?>" <?php if ($ys == $years) echo "selected"; ?>><?= $ys ?>년</option>
                                <?php } ?>
                            </select>

                            <select name="months" onchange="fn_search()">
                                <?php for ($ms = 1; $ms <= 12; $ms++) { ?>
                                    <option value="<?= $ms ?>" <?php if ($ms == $months) echo "selected"; ?>><?= $ms ?>월</option>
                                <?php } ?>
                            </select>

                            <select name="weeks" onchange="fn_search()">
                                <option value="">전체</option>
                                <?php
                                    $week_arr = getWeeksOfMonth($years, $months);
                                    foreach ($week_arr as $index => $week) {
                                ?>
                                    <option value="<?= $index + 1 ?>" <?php if ($weeks == ($index + 1)) echo "selected"; ?>><?= $index + 1 ?>주 (<?= $week['start'] ?>~<?= $week['end'] ?>)</option>
                                <?php } ?>
                            </select>

                            <select name="payin" onchange="fn_search()">
                                <option value="">통합</option>
                                <option value="P">PC</option>
                                <option value="M">모바일</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="listSelectR">
                    <div class="contentMenu">
                        <ul>
                            <li class="contentMenuSub " data-mode="year" style="width: calc(20% - 2px);">
                                <a href="member_statistics3_year">년별통계</a>
                            </li>
                            <li class="contentMenuSub " data-mode="month" style="width: calc(20% - 2px);">
                                <a href="member_statistics3_month">월별통계</a>
                            </li>
                            <li class="contentMenuSub " data-mode="day" style="width: calc(20% - 2px);">
                                <a href="member_statistics3_day">일별통계</a>
                            </li>
                            <li class="contentMenuSub selected" data-mode="week" style="width: calc(20% - 2px);">
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
                                ['요일', '명'],
                                ['일', <?= $price_arr[1] ?>],
                                ['월', <?= $price_arr[2] ?>],
                                ['화', <?= $price_arr[3] ?>],
                                ['수', <?= $price_arr[4] ?>],
                                ['목', <?= $price_arr[5] ?>],
                                ['금', <?= $price_arr[6] ?>],
                                ['토', <?= $price_arr[7] ?>]
                            ]);


                            var options = {
                                title: '',
                                curveType: '',
                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    isHtml: true
                                } // HTML 툴팁 사용
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
                                <th>시간대</th>
                                <th>방문자수</th>
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all">
                            <?php for ($i = 1; $i <= 7; $i++) { ?>
                                <tr>
                                    <td class="number"><?= $yoil_arr[$i] ?></td>
                                    <td class="number"><?= number_format($price_arr[$i]) ?> <span><?= $price_arr[$i] ?>%</span></td>
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
</script>

<?= $this->endSection() ?>