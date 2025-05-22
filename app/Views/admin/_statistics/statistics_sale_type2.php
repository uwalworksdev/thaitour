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
    $range  = $_GET['range'];

    if ($s_date == "") {
        $s_date = date('Y-m-d');
    }

    if ($e_date == "") {
        $e_date = date('Y-m-d');
    }

    if ($range == "") {
        $range = "today";
    }

    $goods_arr = array();

?>

<style>
.pagination a {
    margin: 0 5px;
    color: #333;
    text-decoration: none;
}

.pagination a:hover {
    text-decoration: underline;
}
</style>

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
				<input type="text" name="range" id="range" value="<?=$rangr?>" >
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
                                        <div class="input_radio contact_btn active" rel="<?= date('Y-m-d') ?>" data-range="today">
                                            <input type="radio" name="period" id="period01">
                                            <label for="period01">오늘</label>
                                        </div>
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d', strtotime('-1 week')); ?>" data-range="week">
                                            <input type="radio" name="period" id="period02">
                                            <label for="period02">1주일</label>
                                        </div>
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d', strtotime('-1 month')); ?>" data-range="month">
                                            <input type="radio" name="period" id="period03">
                                            <label for="period03">1개월</label>
                                        </div>
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d', strtotime('-6 month')); ?>"  data-range="6month">
                                            <input type="radio" name="period" id="period04">
                                            <label for="period04">6개월</label>
                                        </div>
                                        <div class="input_radio contact_btn" rel="<?= date('Y-m-d', strtotime('-1 year')); ?>" data-range="year">
                                            <input type="radio" name="period" id="period05">
                                            <label for="period05">1년</label>
                                        </div>
                                        <div class="period_input">
                                            <input type="text" name="s_date" id="s_date" value="<?= $s_date ?>" readonly class="date_form">
                                            <span>~</span>
                                            <input type="text" name="e_date" id="e_date" value="<?= $e_date ?>" readonly class="date_form">
                                        </div>
										<button type="submit">검색</button>
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
						<?php if (!empty($result)) { ?>
							google.charts.setOnLoadCallback(drawChart);
						<?php } ?>

						function drawChart() {
							var data = google.visualization.arrayToDataTable([
								['상품명', '판매수량'],
								<?php
									$chartData = [];
									foreach ($result as $arr_tmp) {
										$name = addslashes($arr_tmp->product_name ?? '');
										$cnt  = (int) ($arr_tmp->order_cnt ?? 0);
										$chartData[] = "['{$name}', {$cnt}]";
									}
									echo implode(",\n", $chartData);
								?>
							]);

							var options = {
								title: '',
								legend: { position: 'bottom' },
								height: 400
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
                                <th>판매합계(원)</th>
                            </tr>
                        </thead>
                        <tbody>  
						<?php if (!empty($result)): ?>
							<?php foreach ($result as $row): ?>						
                            <tr>
                                <td class="center">
                                    <?= esc($row->order_rank) ?>
                                </td>
                                <td class="center">
                                    <?= esc($row->product_code) ?>
                                </td>
                                <td class="left">
                                    <?= esc($row->product_name) ?>
                                </td>
                                <td>
                                    <?= esc($row->order_cnt) ?>
                                </td>
                                <td>
                                    <?= number_format($row->order_amt) ?>
                                </td>
                            </tr>
                           <?php endforeach; ?>
                        <?php else: ?>
							<tr>
								<td colspan="5" style="text-align:center;">조회된 데이터가 없습니다.</td>
							</tr>
						<?php endif; ?>							
                        </tbody>
                    </table>
                </form>
            </div>

			<div class="pagination" style="margin-top: 20px; text-align: center;">
				<?php if ($totalPages > 1): ?>
					<?php
					// 이전 페이지 번호
					$prev = max(1, $page - 1);
					$next = min($totalPages, $page + 1);
					$baseUrl = current_url(); // 현재 URL (쿼리 스트링 제외)
					?>

					<!-- 이전 버튼 -->
					<?php if ($page > 1): ?>
						<a href="<?= $baseUrl ?>?s_date=<?= $s_date ?>&e_date=<?= $e_date ?>&page=<?= $prev ?>">« 이전</a>
					<?php endif; ?>

					<!-- 페이지 숫자 -->
					<?php for ($i = 1; $i <= $totalPages; $i++): ?>
						<a href="<?= $baseUrl ?>?s_date=<?= $s_date ?>&e_date=<?= $e_date ?>&page=<?= $i ?>"
						   <?= ($i == $page) ? 'style="font-weight: bold; text-decoration: underline;"' : '' ?>>
							<?= $i ?>
						</a>
					<?php endfor; ?>

					<!-- 다음 버튼 -->
					<?php if ($page < $totalPages): ?>
						<a href="<?= $baseUrl ?>?s_date=<?= $s_date ?>&e_date=<?= $e_date ?>&page=<?= $next ?>">다음 »</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>

            <?php //echo ipageListing(1, 1, 10, $_SERVER["PHP_SELF"] . "?s_date=" . $s_date . "&e_date=" . $e_date . "&pg=") ?>
        </div>
    </span>
</div>

<script>
$(document).ready(function () {
    $(".input_radio.contact_btn").click(function () {
        // 모든 라디오 비선택 처리
		var range = $(this).data('range');
		$("#range").val(range);
		
        $(".input_radio input[type=radio]").prop("checked", false);

        // 현재 div 하위의 라디오 버튼 체크
        $(this).find("input[type=radio]").prop("checked", true);

        // 시작일 가져오기
        var startDate = $(this).attr("rel");

        // 종료일은 오늘
        var endDate = $.datepicker.formatDate('yy-mm-dd', new Date());

        // input 박스에 날짜 설정
        $("#s_date").val(startDate);
        $("#e_date").val(endDate);
    });
});
</script>

<?= $this->endSection() ?>
