<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<link rel="stylesheet" href="/js/admin/statistics.js">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">

<?php

    $years	= $_GET['years'];
    $months = $_GET['months'];
    $seller	= $_GET['seller'];
    $payin	= $_GET['payin'];

    if($years == ""){
        $years = date('Y');
    }
    
    if($months == ""){
        $months = date('m');
    }
    
    $s_date = date('Y-m-01', mktime(0, 0, 0, $months, 1, $years));
    $e_date = date('Y-m-d', mktime(0, 0, 0, $months, date('t', mktime(0, 0, 0, $months, 1, $years)) , $years));

    if ($s_date == "") {
        $date = new DateTime();
        $date->modify('-30 days');
        $s_date = $date->format('Y-m-d');
    }

    if ($e_date == "") {
        $e_date = date('Y-m-d');
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

    $cnt_arr = array();

    $cnt_arr[1] = 0;  // 일
    $cnt_arr[2] = 0;  // 월
    $cnt_arr[3] = 0;  // 화
    $cnt_arr[4] = 0;  // 수
    $cnt_arr[5] = 0;  // 목
    $cnt_arr[6] = 0;  // 금
    $cnt_arr[7] = 0;  // 토

    $cp_arr = array();

    $cp_arr[1] = 0;  // 일
    $cp_arr[2] = 0;  // 월
    $cp_arr[3] = 0;  // 화
    $cp_arr[4] = 0;  // 수
    $cp_arr[5] = 0;  // 목
    $cp_arr[6] = 0;  // 금
    $cp_arr[7] = 0;  // 토

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
                    <form name="modifyForm1" method="get" action="statistics_sale_yoil" autocomplete="off">
                        <div class="firstLine selectYear" style="padding-left:0">
                            <select name="years" onchange="fn_search()">
                                <?php
                                    for ($ys = 2024; $ys <= date('Y'); $ys++) {
                                ?>
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
                            </select>

                            <!--select name="seller" onchange="fn_search()">
                                <option value="">셀러전체</option>
                            </select-->

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
                            <li class="contentMenuSub " data-mode="year" style="width: calc(20% - 2px);"><a href="statistics_sale_year">년별통계</a></li>
                            <li class="contentMenuSub " data-mode="month" style="width: calc(20% - 2px);"><a href="statistics_sale_month">월별통계</a></li>
                            <li class="contentMenuSub " data-mode="day" style="width: calc(20% - 2px);"><a href="statistics_sale_day">일별통계</a></li>
                            <li class="contentMenuSub selected" data-mode="week" style="width: calc(20% - 2px);"><a href="statistics_sale_yoil">요일별통계</a></li>
                        </ul>
                        <div class="contentBar left" style="left: 345px; display: none;"></div>
                        <div class="contentBar right" style="left: 460px; display: none;"></div>
                    </div>
                </div>

                <?php
                    // 매출 배열
                    $top_banner1_arr = array();
                    $top_banner1_arr['P'] = 0;
                    $top_banner1_arr['M'] = 0;

                    // 상품 배열
                    $top_banner2_arr = array();
                    $top_banner2_arr['P'] = 0;
                    $top_banner2_arr['M'] = 0;

                    // CP 배열
                    $top_banner3_arr = array();
                    $top_banner3_arr['P'] = 0;
                    $top_banner3_arr['M'] = 0;

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
                                <!-- <th>CP수수료 <i class="xi-help xi-x colorDGary masterTooltip" title="CP사 수수료에 대한 집계입니다."></i></th> -->
                            </tr>
                        </thead>
                        <tbody class="statistics">
                            <tr>
                                <td>
                                    <div class="nums">1000</div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> 1000</span><span><i class="xi-tablet masterTooltip" title="모바일"></i> 1000</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="nums">2000</div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> 2000</span><span><i class="xi-tablet masterTooltip" title="모바일"></i> 2000</span>
                                    </div>
                                </td>
                                <!-- <td>
                                    <div class="nums">0</div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> 0</span><span><i class="xi-tablet masterTooltip" title="모바일"></i> 0</span>
                                    </div>
                                </td> -->
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
                                ['요일', '매출', {
                                    role: 'tooltip',
                                    p: {
                                        html: true
                                    }
                                }],
                                ['일', <?= $price_arr[1] ?>, '매출 : <?= number_format($price_arr[1]) ?>원 <br/> <!--CP수수료 : <?= number_format($cp_arr[1]) ?>원 <br/--> 상품 : <?= number_format($cnt_arr[1]) ?>개'],
                                ['월', <?= $price_arr[2] ?>, '매출 : <?= number_format($price_arr[2]) ?>원 <br/> <!--CP수수료 : <?= number_format($cp_arr[2]) ?>원 <br/--> 상품 : <?= number_format($cnt_arr[2]) ?>개'],
                                ['화', <?= $price_arr[3] ?>, '매출 : <?= number_format($price_arr[3]) ?>원 <br/> <!--CP수수료 : <?= number_format($cp_arr[3]) ?>원 <br/--> 상품 : <?= number_format($cnt_arr[3]) ?>개'],
                                ['수', <?= $price_arr[4] ?>, '매출 : <?= number_format($price_arr[4]) ?>원 <br/> <!--CP수수료 : <?= number_format($cp_arr[4]) ?>원 <br/--> 상품 : <?= number_format($cnt_arr[4]) ?>개'],
                                ['목', <?= $price_arr[5] ?>, '매출 : <?= number_format($price_arr[5]) ?>원 <br/> <!--CP수수료 : <?= number_format($cp_arr[5]) ?>원 <br/--> 상품 : <?= number_format($cnt_arr[5]) ?>개'],
                                ['금', <?= $price_arr[6] ?>, '매출 : <?= number_format($price_arr[6]) ?>원 <br/> <!--CP수수료 : <?= number_format($cp_arr[6]) ?>원 <br/--> 상품 : <?= number_format($cnt_arr[6]) ?>개'],
                                ['토', <?= $price_arr[7] ?>, '매출 : <?= number_format($price_arr[7]) ?>원 <br/> <!--CP수수료 : <?= number_format($cp_arr[7]) ?>원 <br/--> 상품 : <?= number_format($cnt_arr[7]) ?>개']
                            ]);

                            var options = {
                                title: '',
                                curveType: '',
                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    isHtml: true
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
                                <th>요일</th>
                                <th>매출</th>
                                <th>상품</th>
                                <!-- <th>CP수수료</th> -->
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all">
                            <?php for ($i = 1; $i <= 7; $i++) { ?>
                                <tr>
                                    <td class="number"><?= $yoil_arr[$i] ?></td>
                                    <td class="number"><?= number_format($price_arr[$i]) ?> <span><?= $price_arr[$i] ?>%</span></td>
                                    <td class="number"><?= number_format($cnt_arr[$i]) ?> <span><?= $cnt_arr[$i] ?>%</span></td>
                                    <!-- <td class="number"><?= number_format($cp_arr[$i]) ?> <span><?= $cp_arr[$i] ?>%</span></td> -->
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <?php

                        $delivery_arr = array();

                        $delivery_arr[1] = 0;  // 일
                        $delivery_arr[2] = 0;  // 월
                        $delivery_arr[3] = 0;  // 화
                        $delivery_arr[4] = 0;  // 수
                        $delivery_arr[5] = 0;  // 목
                        $delivery_arr[6] = 0;  // 금
                        $delivery_arr[7] = 0;  // 토

                        $point_arr = array();

                        $point_arr[1] = 0;  // 일
                        $point_arr[2] = 0;  // 월
                        $point_arr[3] = 0;  // 화
                        $point_arr[4] = 0;  // 수
                        $point_arr[5] = 0;  // 목
                        $point_arr[6] = 0;  // 금
                        $point_arr[7] = 0;  // 토

                        $coupon_arr = array();

                        $coupon_arr[1] = 0;  // 일
                        $coupon_arr[2] = 0;  // 월
                        $coupon_arr[3] = 0;  // 화
                        $coupon_arr[4] = 0;  // 수
                        $coupon_arr[5] = 0;  // 목
                        $coupon_arr[6] = 0;  // 금
                        $coupon_arr[7] = 0;  // 토

                        // 배송비 배열
                        $top_banner4_arr = array();
                        $top_banner4_arr['P'] = 0;
                        $top_banner4_arr['M'] = 0;

                        // 적립금 배열
                        $top_banner5_arr = array();
                        $top_banner5_arr['P'] = 0;
                        $top_banner5_arr['M'] = 0;
                        // 쿠폰 배열
                        $top_banner6_arr = array();
                        $top_banner6_arr['P'] = 0;
                        $top_banner6_arr['M'] = 0;

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
                                    <div class="nums">0</div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> 0</span><span><i class="xi-tablet masterTooltip" title="모바일"></i> 0</span>
                                    </div>
                                </td>

                                <td>
                                    <div class="nums">0</div>
                                    <div>
                                        <span><i class="xi-desktop masterTooltip" title="PC"></i> 0</span><span><i class="xi-tablet masterTooltip" title="모바일"></i> 0</span>
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
                                ['요일', '적립금', '쿠폰'],
                                ['일', <?= $point_arr[1] ?>, <?= $coupon_arr[1] ?>],
                                ['월', <?= $point_arr[2] ?>, <?= $coupon_arr[2] ?>],
                                ['화', <?= $point_arr[3] ?>, <?= $coupon_arr[3] ?>],
                                ['수', <?= $point_arr[4] ?>, <?= $coupon_arr[4] ?>],
                                ['목', <?= $point_arr[5] ?>, <?= $coupon_arr[5] ?>],
                                ['금', <?= $point_arr[6] ?>, <?= $coupon_arr[6] ?>],
                                ['토', <?= $point_arr[7] ?>, <?= $coupon_arr[7] ?>]
                            ]);

                            var options = {
                                title: '',
                                curveType: '',
                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    isHtml: true
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
                                <th>날짜</th>
                                <th>적립금</th>
                                <th>쿠폰</th>
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all">
                            <?php for ($i = 1; $i <= 7; $i++) { ?>
                                <tr>
                                    <td class="number"><?= $yoil_arr[$i] ?></td>
                                    <td class="number"><?= number_format($point_arr[$i]) ?> <span><?= $point_arr[$i] ?>%</span></td>
                                    <td class="number"><?= number_format($coupon_arr[$i]) ?> <span><?= $coupon_arr[$i] ?>%</span></td>
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

    // 검색하기
    function fn_search(){
        let frm = document.modifyForm1;
        frm.submit();
    }
</script>