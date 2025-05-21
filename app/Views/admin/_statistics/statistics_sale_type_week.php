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
	$pay_method['MBank']    = "통장입금";


	$years    = $_GET['years'];
	$months   = $_GET['months'];
	$weeks    = $_GET['weeks'];
	$payin    = $_GET['payin'];

	if ($years == "") {
		$years = date('Y');
	}

	if ($months == "") {
		$months = date('m');
	}

    $price_arr = array();

	$price_arr['Card']   = 0;
	$price_arr['VBank']  = 0;
	$price_arr['DBank']  = 0;
	$price_arr['MBank']  = 0;

    $payment_tot = 0;
    foreach ($converted_result as $row) {
		     $payment_tot = $payment_tot + $row['total'];
			 if($row['method'] == "Card")  $price_arr['Card']  = $row['total'];
			 if($row['method'] == "VBank") $price_arr['VBank'] = $row['total'];
    }	

?>

<style>
button[type="submit"] {
    height: 30px;
    padding: 0 10px;
    margin: 0 1.5px;
    background-color: #55a0ff;
    color: #fff;
}

button[type="submit"]:hover {
    background-color: #2f5c98;   /* 호버 시 색상 변경 */
}
</style>

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

                    <li class="contentMenuSub selected">
                        <a href="statistics_sale_type">결제수단매출통계</a>
                    </li>

                    <li class="contentMenuSub ">
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
            <div class="content">
                <div class="listLine"></div>
                <div class="listSelect size09" style="position:relative">
                    <form name="modifyForm1" method="get" action="statistics_sale_type_week" autocomplete="off">
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
                                <option value="1" <?php if($weeks == "1") echo "selected";?> >1</option>
                                <option value="2" <?php if($weeks == "2") echo "selected";?> >2</option>
                                <option value="3" <?php if($weeks == "3") echo "selected";?> >3</option>
                                <option value="4" <?php if($weeks == "4") echo "selected";?> >4</option>
                                <option value="5" <?php if($weeks == "5") echo "selected";?> >5</option>
                            </select>

                            <select name="payin" onchange="fn_search()">
                                <option value="">통합</option>
                                <option value="P" <?php if($payin == "P") echo "selected";?> >PC</option>
                                <option value="M" <?php if($payin == "M") echo "selected";?> >모바일</option>
                            </select>
       	    			    <button type="submit">검색</button>
                        </div>
                    </form>
                </div>
                <div class="listSelectR">
                    <div class="contentMenu">
                        <ul>
                            <li class="contentMenuSub " data-mode="year" style="width: calc(20% - 2px);"><a href="statistics_sale_type_year">년간통계</a></li>
                            <li class="contentMenuSub " data-mode="month" style="width: calc(20% - 2px);"><a href="statistics_sale_type_month">월간통계</a></li>
                            <li class="contentMenuSub selected" data-mode="week" style="width: calc(20% - 2px);"><a href="statistics_sale_type_week">주간통계</a></li>
                            <li class="contentMenuSub " data-mode="day" style="width: calc(20% - 2px);"><a href="statistics_sale_type_day">일간통계</a></li>
                            <li class="contentMenuSub " data-mode="detail" style="width: calc(20% - 2px);"><a href="statistics_sale_type">특정기간통계</a></li>
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
                            google.charts.setOnLoadCallback(drawPieChart);
                            google.charts.setOnLoadCallback(drawBarChart);

                            function drawPieChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['수단', '매출'],
                                    ["카드결제", <?=$price_arr['Card']?> ],
                                    ["무통장",  <?=$price_arr['VBank']?> ],
                                    ["실시간계좌이체", <?=$price_arr['DBank']?>],
                                    ["통장입금", <?=$price_arr['MBank']?>],
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
                                var total = <?= $payment_tot ?>;
                                var rows = [
                                    ["카드결제", <?=$price_arr['Card']?>, "#4285F4"],
                                    ["무통장", <?=$price_arr['VBank']?>, "#4285F4"],
                                    ["실시간계좌이체", <?=$price_arr['DBank']?>, "#4285F4"],
                                    ["통장입금", <?=$price_arr['MBank']?>, "#4285F4"]
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
                                <th>결제수단</th>
                                <th>매출</th>
                                <th>점유률</th>
                            </tr>
                        </thead>
                        <tbody id="list_all">
                            <?php
                                $ordered_methods = ['Card', 'VBank', 'DBank', 'MBank'];
                                $sorted_price_arr = [];

                                foreach ($ordered_methods as $method) {
                                    if (isset($price_arr[$method])) {
                                        $sorted_price_arr[$method] = $price_arr[$method];
                                    }
                                }
                                $tr_index = 0;
                                foreach ($sorted_price_arr as $key => $meth) {
                                    $tr_index++;
                            ?>

                                <tr>
                                    <td class="number"><?= $tr_index ?></td>
                                    <td style="text-align:left;"><?= $pay_method[$key] ?></td>
                                    <td class="number"><?= number_format($meth) ?></td>
                                    <td>
                                        <div style="display: flex; gap: 30px; align-items: center; width: 100%;">
                                            <div class="per_line">
                                            </div>
                                            <div class="floatRight size10 fontMontserrat"><?= (int)($meth * 100 / $payment_tot) ?></div>
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
    // 검색하기
    function fn_search() {
        let frm = document.modifyForm1;
        frm.submit();
    }
</script>