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

<style>
.contact_btn.active {
    background-color: #3d6cab !important;
    color: white !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons    = document.querySelectorAll('.date-range-btn');
    const sDateInput = document.getElementById('s_date');
    const eDateInput = document.getElementById('e_date');

    buttons.forEach(btn => {
        btn.addEventListener('click', function () {
            const today = new Date();
            let sDate   = new Date(); // 기본: 오늘
            const range = this.dataset.range;
            
			$("#range").val(range);
			
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

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_type">결제수단매출통계</a>
                    </li>

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_type2">상품분석</a>
                    </li>

                    <li class="contentMenuSub selected">
                        <a href="statistics_sale_type3"> 지역별매출톨계</a>
                    </li>

                    <!--li class="contentMenuSub ">
                        <a href="statistics_sale_list">매출상세내역</a>
                    </li-->
                </ul>
                <div class="contentBar left" style="left: 1215.55px; display: none;"></div>
                <div class="contentBar right" style="left: 1459px; display: none;"></div>
            </div>

            <div class="content">
                <div class="listLine"></div>
                <div class="listSelect size09" style="position:relative">
                    <form name="modifyForm1" method="get" action="statistics_sale_type3" autocomplete="off">
					<input type="hidden" name="range" id="range" value="<?=$range?>" >
                        <div class="period_search">
                            <div class="period_input">
                                <input type="text" name="s_date" id="s_date" value="<?= $s_date ?>" readonly class="date_form">
                                <span>~</span>
                                <input type="text" name="e_date" id="e_date" value="<?= $e_date ?>" readonly class="date_form">
                            </div>

							<!-- 날짜 버튼들 -->
							<button type="button" class="contact_btn date-range-btn <?php if($range == "today")  echo "active";?> " data-start="<?= date('Y-m-d'); ?>" data-range="today">오늘</button>
							<button type="button" class="contact_btn date-range-btn <?php if($range == "3day")   echo "active";?> " data-start="<?= date('Y-m-d', strtotime('-3 day')); ?>" data-range="3day">3일</button>
							<button type="button" class="contact_btn date-range-btn <?php if($range == "7day")   echo "active";?> " data-start="<?= date('Y-m-d', strtotime('-7 day')); ?>" data-range="7day">7일</button>
							<button type="button" class="contact_btn date-range-btn <?php if($range == "1month") echo "active";?> " data-start="<?= date('Y-m-d', strtotime('-1 month')); ?>" data-range="1month">1개월</button>

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
                            <li class="contentMenuSub " data-mode="year"  style="width: calc(20% - 2px);"><a href="statistics_sale_type3_year">년간통계</a></li>
                            <li class="contentMenuSub " data-mode="month" style="width: calc(20% - 2px);"><a href="statistics_sale_type3_month">월간통계</a></li>
                            <li class="contentMenuSub " data-mode="week"  style="width: calc(20% - 2px);"><a href="statistics_sale_type3_week">주간통계</a></li>
                            <li class="contentMenuSub"  data-mode="day"   style="width: calc(20% - 2px);"><a href="statistics_sale_type3_day">일간통계</a></li>
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
							google.charts.load('current', { packages: ['corechart'] });

							const chartData = <?= json_encode($result) ?>;
							const total = chartData.reduce((sum, row) => sum + row[1], 0);
							const color = '#4285F4';

							google.charts.setOnLoadCallback(drawPieChart);
							google.charts.setOnLoadCallback(drawBarChart);

							function drawPieChart() {
								const data = google.visualization.arrayToDataTable([
									['지역', '매출'],
									...chartData
								]);

								const options = {
									title: '',
									legend: { position: 'bottom' },
									tooltip: { isHtml: true },
								};

								const chart = new google.visualization.PieChart(document.getElementById('curve_chart1'));
								chart.draw(data, options);
							}

							function drawBarChart() {
								chartData.forEach((row, index) => {
									const [region, value] = row;
									const percentage = Math.round((value / total) * 100);
									const container = document.createElement('div');
									container.classList.add('bar-container');

									const target = document.querySelectorAll('.per_line')[index];
									if (target) target.appendChild(container);

									if (percentage > 0) {
										const bar = document.createElement('div');
										bar.classList.add('bar');
										bar.style.width = percentage + '%';
										bar.style.height = '20px';
										bar.style.backgroundColor = color;
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

                            $order_tot = 0;
                            foreach ($result as $row) {
                                     $order_tot = $order_tot + $row[1];  
							}

							$tr_index = 0;
                            foreach ($result as $row) {
                                $tr_index++;
                            ?>
                                <tr>
                                    <td class="number"><?= $tr_index ?></td>
                                    <td style="text-align:left;"><?= $row[0]?></td>
                                    <td class="number"><?= number_format($row[1]) ?></td>
                                    <td>
                                        <div style="display: flex; gap: 30px; align-items: center; width: 100%;">
                                            <div class="per_line">
                                            </div>
                                            <div class="floatRight size10 fontMontserrat"><?= (round)($row[1] * 100 / $order_tot) ?>%</div>
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

	$(document).ready(function() {
		$(".date-range-btn").click(function() {
			// 모든 버튼에서 active 클래스 제거 후 클릭한 버튼에 추가
			$(".date-range-btn").removeClass("active");
			$(this).addClass("active");

			// 데이터 가져오기
			var date1 = $(this).data("start");   // ex) "2025-05-19"
			var date2 = $.datepicker.formatDate('yy-mm-dd', new Date());  // 오늘

			// 값 설정
			$("#s_date").val(date1);
			$("#e_date").val(date2);

		});
	});
</script>