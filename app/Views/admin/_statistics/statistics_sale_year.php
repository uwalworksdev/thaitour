<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<script src="/js/admin/statistics.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">

<h1 class="mb-4 text-2xl font-bold">연도별 매출 통계</h1>

<form method="get" class="mb-6">
    <div class="flex gap-2 items-center">
        <label for="years_s">시작년도</label>
        <select name="years_s" id="years_s" class="border px-2 py-1">
            <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                <option value="<?= $i ?>" <?= $i == $years_s ? 'selected' : '' ?>><?= $i ?>년</option>
            <?php endfor; ?>
        </select>
        <span>~</span>
        <label for="years_e">종료년도</label>
        <select name="years_e" id="years_e" class="border px-2 py-1">
            <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                <option value="<?= $i ?>" <?= $i == $years_e ? 'selected' : '' ?>><?= $i ?>년</option>
            <?php endfor; ?>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">검색</button>
    </div>
</form>

<div id="curve_chart1" style="width:100%; height:400px;"></div>
<div id="curve_chart2" style="width:100%; height:400px;"></div>

<table class="w-full text-sm text-left mt-6 border border-gray-300">
    <thead class="bg-gray-100 border-b">
        <tr>
            <th class="p-2 border">구분</th>
            <?php for ($i = $years_s; $i <= $years_e; $i++): ?>
                <th class="p-2 border"><?= $i ?>년</th>
            <?php endfor; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $labels = ['매출', '상품', 'CP수수료', '배송비', '적립금', '쿠폰'];
        $arrays = [$price_arr, $cnt_arr, $cp_arr, $delivery_arr, $point_arr, $coupon_arr];
        foreach ($labels as $idx => $label): ?>
            <tr>
                <td class="p-2 border"><?= $label ?></td>
                <?php for ($i = $years_s; $i <= $years_e; $i++): ?>
                    <td class="p-2 border text-right"><?= number_format($arrays[$idx][$i]) ?></td>
                <?php endfor; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawAllCharts);

    function drawAllCharts() {
        drawRevenueChart();
        drawPointCouponChart();
    }

    function drawRevenueChart() {
        var data = google.visualization.arrayToDataTable([
            ['년도', '매출', { role: 'tooltip', p: { html: true } }],
            <?php for ($i = $years_s; $i <= $years_e; $i++): ?>
                ['<?= $i ?>', <?= $price_arr[$i] ?>, '매출: <?= number_format($price_arr[$i]) ?>원\nCP수수료: <?= number_format($cp_arr[$i]) ?>원\n상품: <?= number_format($cnt_arr[$i]) ?>개'],
            <?php endfor; ?>
        ]);

        var options = {
            title: '',
            legend: { position: 'bottom' },
            tooltip: { isHtml: true },
            hAxis: { title: '년도' },
            vAxis: { format: 'short' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));
        chart.draw(data, options);
    }

    function drawPointCouponChart() {
        var data = google.visualization.arrayToDataTable([
            ['년도', '적립금', '쿠폰'],
            <?php for ($i = $years_s; $i <= $years_e; $i++): ?>
                ['<?= $i ?>', <?= $point_arr[$i] ?>, <?= $coupon_arr[$i] ?>],
            <?php endfor; ?>
        ]);

        var options = {
            title: '',
            curveType: 'function',
            legend: { position: 'bottom' },
            hAxis: { title: '년도' },
            vAxis: { format: 'short' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));
        chart.draw(data, options);
    }
</script>

<?= $this->endSection() ?>
