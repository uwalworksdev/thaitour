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
    $pay_method['Card']     = "카드결제..";
    $pay_method['VBank']    = "무통장(가상계좌)";
    $pay_method['DBank']    = "실시간계좌이체";
    $pay_method['MBank']    = "통장입금";

    $range  = $_GET['range'];
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
.contact_btn.active {
    background-color: #3d6cab !important;
    color: white !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.date-range-btn');
    const sDateInput = document.getElementById('s_date');
    const eDateInput = document.getElementById('e_date');

    buttons.forEach(btn => {
        btn.addEventListener('click', function () {
            const today = new Date();
            let sDate = new Date(); // 기본: 오늘
            const range = this.dataset.range;

            // 날짜 계산
            if (range === '3day') {
                sDate.setDate(today.getDate() - 3);
            } else if (range === '7day') {
                sDate.setDate(today.getDate() - 7);
            } else if (range === '1month') {
                sDate.setMonth(today.getMonth() - 1);
            }

            // yyyy-mm-dd 포맷
            const formatDate = (d) => {
                const yyyy = d.getFullYear();
                const mm = ('0' + (d.getMonth() + 1)).slice(-2);
                const dd = ('0' + d.getDate()).slice(-2);
                return `${yyyy}-${mm}-${dd}`;
            };

            sDateInput.value = formatDate(sDate);
            eDateInput.value = formatDate(today);

            // 버튼 스타일 처리
            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>

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
                    <form name="modifyForm1" method="get" action="statistics_sale_type" autocomplete="off">
					<input type="text" name="range" id="range" value="<?=$range?>" >
                        <div class="period_search">
						<div class="period_input">
							<input type="text" name="s_date" id="s_date" value="<?= $s_date ?>" readonly class="date_form"> 
							<span>~</span>
							<input type="text" name="e_date" id="e_date" value="<?= $e_date ?>" readonly class="date_form">
						</div>

						<!-- 날짜 버튼들 -->
						<button type="button" class="contact_btn date-range-btn" data-start="<?= date('Y-m-d'); ?>" data-range="today">오늘</button>
						<button type="button" class="contact_btn date-range-btn" data-start="<?= date('Y-m-d', strtotime('-3 day')); ?>" data-range="3day">3일</button>
						<button type="button" class="contact_btn date-range-btn" data-start="<?= date('Y-m-d', strtotime('-7 day')); ?>" data-range="7day">7일</button>
						<button type="button" class="contact_btn date-range-btn" data-start="<?= date('Y-m-d', strtotime('-1 month')); ?>" data-range="1month">1개월</button>
						
						<!--button type="button" class="contact_btn date-range-btn" rel="<?= date('Y-m-d'); ?>" data-range="today">오늘</button>
						<button type="button" class="contact_btn date-range-btn" rel="<?= date('Y-m-d', strtotime('-3 day')); ?>" data-range="3day">3일</button>
						<button type="button" class="contact_btn date-range-btn" rel="<?= date('Y-m-d', strtotime('-7 day')); ?>" data-range="7day">7일</button>
						<button type="button" class="contact_btn date-range-btn" rel="<?= date('Y-m-d', strtotime('-1 month')); ?>" data-range="1month">1개월</button-->

                            <select name="payin" onchange="submit()">
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
                            <li class="contentMenuSub " data-mode="year"  style="width: calc(20% - 2px);"><a href="statistics_sale_type_year">년간통계</a></li>
                            <li class="contentMenuSub " data-mode="month" style="width: calc(20% - 2px);"><a href="statistics_sale_type_month">월간통계</a></li>
                            <li class="contentMenuSub " data-mode="week"  style="width: calc(20% - 2px);"><a href="statistics_sale_type_week">주간통계</a></li>
                            <li class="contentMenuSub"  data-mode="day"   style="width: calc(20% - 2px);"><a href="statistics_sale_type_day">일간통계</a></li>
                            <li class="contentMenuSub selected" data-mode="detail" style="width: calc(20% - 2px);"><a href="statistics_sale_type">특정기간통계</a></li>
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
                            <col width="8%">  <!-- 순위 -->
                            <col width="20%"> <!-- 결제수단 -->
                            <col width="20%"> <!-- 총매출 -->
                            <col width="52%"> <!-- 점유률 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>순위</th>
                                <th>결제수단</th>
                                <th>매출(원)</th>
                                <th>점유률(%)</th>
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

	$(document).on('click', '.contact_btn', function() {
		$(".contact_btn").removeClass("active");
		$(this).addClass("active");

		var range = $(this).data("range");  // 여기서 undefined가 아니라면 data-range가 잘 들어있다는 뜻
		var date1 = $(this).data("start");
		var date2 = $.datepicker.formatDate('yy-mm-dd', new Date());

		$("#range").val(range);
		$("#s_date").val(date1);
		$("#e_date").val(date2);
	});
</script>