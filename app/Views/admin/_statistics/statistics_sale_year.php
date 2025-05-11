<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<link rel="stylesheet" href="/js/admin/statistics.js">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">

<?php
/*
    $years_s    = 2024;
    $years_e = date('Y');

    $s_date = date('Y-m-01', mktime(0, 0, 0, 1, 1, $years_s));
    $e_date = date('Y-m-d',  mktime(0, 0, 0, 12, 31, $years_e));

    $seller    = $_GET['seller'];
    $payin    = $_GET['payin'];

    $price_arr = array();

    for ($i = $years_s; $i <= $years_e; $i++) {
        $price_arr[$i] = 0;
    }

    $cnt_arr = array();

    for ($i = $years_s; $i <= $years_e; $i++) {
        $cnt_arr[$i] = 0;
    }

    $cp_arr = array();

    for ($i = $years_s; $i <= $years_e; $i++) {
        $cp_arr[$i] = 0;
    }
*/
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
                    <li class="contentMenuSub selected">
                        <a href="statistics_sale_yoil">매출통계</a>
                    </li>
                    <!-- <li class="contentMenuSub">
                        <a href="statistics_sale_sales">업체별 매출통계</a>
                    </li> -->
                    <li class="contentMenuSub ">
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
                <div class="listSelect size09">
                    <form name="modifyForm1" method="get" action="statistics_sale_year" autocomplete="off">
                        <div class="firstLine selectYear" style="padding-left:0">
                            <!--select name="seller" onchange="fn_search()">
                                <option value="">셀러전체</option>
                            </select-->

                            <select name="payin" onchange="fn_search()">
                                <option value="">통합</option>
                                <option value="P" <?php if($payin == "P") echo "selected";?> >PC</option>
                                <option value="M" <?php if($payin == "M") echo "selected";?> >모바일</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="listSelectR">
                    <div class="contentMenu">
                        <ul>
                            <li class="contentMenuSub selected" data-mode="year" style="width: calc(20% - 2px);"><a href="statistics_sale_year">년별통계</a></li>
                            <li class="contentMenuSub" data-mode="month" style="width: calc(20% - 2px);"><a href="statistics_sale_month">월별통계</a></li>
                            <li class="contentMenuSub" data-mode="day" style="width: calc(20% - 2px);"><a href="statistics_sale_day">일별통계</a></li>
                            <li class="contentMenuSub" data-mode="week" style="width: calc(20% - 2px);"><a href="statistics_sale_yoil">요일별통계</a></li>
                        </ul>
                        <div class="contentBar left" style="left: 345px; display: none;"></div>
                        <div class="contentBar right" style="left: 460px; display: none;"></div>
                    </div>
                </div>

                <?php
                    // 매출금액 배열
                    $top_banner1_arr = array();
                    $top_banner1_arr['P'] = array_sum($pc_price_arr);
                    $top_banner1_arr['M'] = array_sum($mobile_price_arr);

                    // 상품건수 배열
                    $top_banner2_arr = array();
                    $top_banner2_arr['P'] = array_sum($pc_cnt_arr);
                    $top_banner2_arr['M'] = array_sum($mobile_cny_arr);

                    // CP 배열
                    $top_banner3_arr = array();
                    $top_banner3_arr['P'] = array_sum($pc_price_arr);
                    $top_banner3_arr['M'] = array_sum($pc_price_arr);

                ?>

                <div id="listArea">

                    <table class="listIn">
                        <colgroup>
                            <col width="50%"> <!-- 총매출 -->
                            <col width="50%"> <!-- 상품 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>매출 <i class="xi-help xi-x colorDGary masterTooltip" title="매출은 상품 + 배송비 - 적립금 - 쿠폰 - 할인 - CP수수료 입니다"></i></th>
                                <th>상품</th>
                            </tr>
                        </thead>
                        <tbody class="statistics">
                            <tr>

                                <td>
                                    <div class="nums"><?=number_format($top_banner1_arr['P'] + $top_banner1_arr['M'])?></div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> <?=number_format($top_banner1_arr['P'])?></span><span><i class="xi-tablet masterTooltip" title="모바일"></i> <?=number_format($top_banner1_arr['M'])?></span>
                                    </div>
                                </td>


                                <td>
                                    <div class="nums"><?=number_format($top_banner2_arr['P'] + $top_banner2_arr['M'])?></div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> <?=number_format($top_banner2_arr['P'])?></span><span><i class="xi-tablet masterTooltip" title="모바일"></i> <?=number_format($top_banner2_arr['M'])?></span>
                                    </div>
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
                                ['년', '매출', {
                                    role: 'tooltip',
                                    p: {
                                        html: true
                                    }
                                }],

                                <?php
                                    for ($i = $years_s; $i <= $years_e; $i++) {
                                ?>[<?= $i ?>, <?= $pc_price_arr[$i] + $mobile_price_arr[$i] ?>, '매출 : <?= number_format($pc_price_arr[$i] + $mobile_price_arr[$i]) ?>원 <br/> CP수수료 : <?= number_format($cp_arr[$i]) ?>원 <br/> 상품 : <?= number_format($pc_cnt_arr[$i] + $mobile_cnt_arr[$i]) ?>개'],
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
                            <col width="30%"> <!-- 날짜 -->
                            <col width="*%"> <!-- 총매출 -->
                            <col width="35%"> <!-- 상품 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>년</th>
                                <th>매출</th>
                                <th>상품</th>
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all">
                            <?php
                            for ($i = $years_s; $i <= $years_e; $i++) {
                                $months = str_pad($i, 2, "0", STR_PAD_LEFT);
								
								$price_sum  = array_sum($pc_price_arr) + array_sum($mobile_price_arr);
								
								if($price_sum > 0) {
								   $price_rate = ($pc_price_arr[$i]  + $mobile_price_arr[$i]) * 100 / $price_sum;
								} else {  
								   $price_rate = 0;
								}   
								
								$cnt_sum  = array_sum($pc_cnt_arr) + array_sum($mobile_cnt_arr);
								
								if($cnt_sum > 0) {
								   $cnt_rate = ($pc_cnt_arr[$i]  + $mobile_cnt_arr[$i]) * 100 / $cnt_sum;
								} else {  
								   $cnt_rate = 0;
								}   								
                            ?>
                                <tr>
                                    <td class="number"><?= $i ?></td>
                                    <td class="number"><?= number_format($pc_price_arr[$i] + $mobile_price_arr[$i]) ?> <span><?= $price_rate ?>%</span></td>
                                    <td class="number"><?= number_format($pc_cnt_arr[$i]   + $mobile_cnt_arr[$i]) ?>   <span><?= $cnt_rate ?>%</span></td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <?php

                        $delivery_arr = array();

                        for ($i = $years_s; $i <= $years_e; $i++) {
                            $delivery_arr[$i] = 0;
                        }

                        $point_arr = array();

                        for ($i = $years_s; $i <= $years_e; $i++) {
                            $point_arr[$i] = 0;
                        }

                        $coupon_arr = array();

                        for ($i = $years_s; $i <= $years_e; $i++) {
                            $coupon_arr[$i] = 0;
                        }

                        // 배송비 배열
                        $top_banner4_arr = array();
                        $top_banner4_arr['P'] = 0;
                        $top_banner4_arr['M'] = 0;

                        // 적립금 배열
                        $top_banner5_arr = array();
                        $top_banner5_arr['P'] = array_sum($pc_point_arr);
                        $top_banner5_arr['M'] = array_sum($mobile_point_arr);

                        // 쿠폰 배열
                        $top_banner6_arr = array();
                        $top_banner6_arr['P'] = array_sum($pc_coupon_arr);
                        $top_banner6_arr['M'] = array_sum($mobile_coupon_arr);
                    ?>


                    <div class="empty10" style="margin: 50px 0 50px 0;"></div>

                    <table class="listIn">
                        <colgroup>
                            <col width="50%"> <!-- 적립금 -->
                            <col width="50%"> <!-- 쿠폰 -->

                        </colgroup>
                        <thead>
                            <tr>
                                <th>적립금</th>
                                <th>쿠폰</th>
                            </tr>
                        </thead>
                        <tbody class="statistics">
                            <tr>

                                <td>
                                    <div class="nums"><?=number_format($top_banner5_arr['P'] + $top_banner5_arr['M'])?></div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> <?=number_format($top_banner5_arr['P'])?></span><span><i class="xi-tablet masterTooltip" title="모바일"></i> <?=number_format($top_banner5_arr['M'])?></span>
                                    </div>
                                </td>

                                <td>
                                    <div class="nums"><?=number_format($top_banner6_arr['P'] + $top_banner6_arr['M'])?></div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> <?=number_format($top_banner6_arr['P'])?></span><span><i class="xi-tablet masterTooltip" title="모바일"></i> <?=number_format($top_banner6_arr['M'])?></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="empty10">&nbsp;</div>

                    <div id="chart-area">
                        <div id="curve_chart2"></div>
                    </div>
                    <div class="empty10">&nbsp;</div>

                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['년', '적립금', '쿠폰'],

                                <?php
                                    for ($i = $years_s; $i <= $years_e; $i++) {
                                ?>
                                    [<?= $i ?>, <?= $pc_point_arr[$i] + $mobile_point_arr[$i] ?>, <?= $pc_coupon_arr[$i] + $mobile_coupon_arr[$i] ?>],

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

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

                            chart.draw(data, options);
                        }
                    </script>

                    <table class="listIn fixed-header">
                        <colgroup>
                            <col width="20%"> <!-- 날짜 -->
                            <col width="*%"> <!-- 배송비 -->
                            <col width="35%"> <!-- 적립금 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>년</th>
                                <th>적립금</th>
                                <th>쿠폰</th>
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all">
                            <?php
                            for ($i = $years_s; $i <= $years_e; $i++) {
                                $months = str_pad($i, 2, "0", STR_PAD_LEFT);
								
								$point_sum  = array_sum($pc_point_arr) + array_sum($mobile_point_arr);
								
								if($point_sum > 0) {
								   $point_rate = ($pc_point_arr[$i]  + $mobile_point_arr[$i]) * 100 / $point_sum;
								} else {  
								   $point_rate = 0;
								}   
								
								$coupon_sum  = array_sum($pc_coupon_arr) + array_sum($mobile_coupon_arr);
								
								if($coupon_sum > 0) {
								   $coupon_rate = ($pc_coupon_arr[$i]  + $mobile_coupon_arr[$i]) * 100 / $coupon_sum;
								} else {  
								   $coupon_rate = 0;
								}   
                            ?>
                                <tr>
                                    <td class="number"><?= $i ?>-<?= $months ?></td>
                                    <td class="number"><?= number_format($pc_point_arr[$i]  + $mobile_point_arr[$i]) ?>  <span><?= $point_rate ?>%</span></td>
                                    <td class="number"><?= number_format($pc_coupon_arr[$i] + $mobile_coupon_arr[$i]) ?> <span><?= $coupon_rate ?>%</span></td>
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
	document.modifyForm1.submit();
}
</script>

<?= $this->endSection() ?>

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

    $(".content .contentMenu > ul > li").click(function () {
        $(".content .contentMenu > ul > li").removeClass("selected")
        //console.log("KKK")
        $(this).addClass("selected");
    })

    $(function() {
        $( ".date_form" ).datepicker({
            showOn: "both",
            dateFormat: 'yy-mm-dd',
            buttonImageOnly: false,
            showButtonPanel: false,
            changeMonth: false, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
            changeYear: false, // 년을 바꿀수 있는 셀렉트 박스를 표시한다.
            dayNames: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
            dayNamesMin: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT']
        });
    });
</script>
