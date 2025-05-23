<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<link rel="stylesheet" href="/js/admin/statistics.js">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">

<?php
    $years_s    = 2024;
    $years_e = date('Y');

    $s_date = date('Y-m-01', mktime(0, 0, 0, 1, 1, $years_s));
    $e_date = date('Y-m-d',  mktime(0, 0, 0, 12, 31, $years_e));

    $payin    = $_GET['payin'];

    $price_arr = array();
    $cnt_arr = array();
    $cp_arr = array();

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
                    <li class="contentMenuSub">
                        <a href="statistics_sale_yoil">매출통계</a>
                    </li>
                    <!-- <li class="contentMenuSub selected">
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

                    <!--li class="contentMenuSub ">
                        <a href="statistics_sale_list">매출상세내역</a>
                    </li-->
                </ul>
                <div class="contentBar left" style="left: 1215.55px; display: none;"></div>
                <div class="contentBar right" style="left: 1459px; display: none;"></div>

            </div>
            <div class="content">

                <div class="listLine"></div>

                <div class="listSelect size09">
                    <form name="modifyForm1" method="get" action="statistics_sale_sales" autocomplete="off">
                        <div class="firstLine selectYear" style="padding-left:0">
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
                            <col width="34%"> <!-- 총매출 -->
                            <col width="33%"> <!-- 상품 -->
                            <col width="33%"> <!-- CP수수료 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>매출 <i class="xi-help xi-x colorDGary masterTooltip" title="매출은 상품 + 배송비 - 적립금 - 쿠폰 - 할인 - CP수수료 입니다"></i></th>
                                <th>상품</th>
                                <th>CP수수료 <i class="xi-help xi-x colorDGary masterTooltip" title="CP사 수수료에 대한 집계입니다."></i></th>
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

                    <table class="listIn fixed-header">
                        <colgroup>
                            <col width="16%"> <!-- 월 -->
                            <col width="28%"> <!-- 총매출 -->
                            <col width="28%"> <!-- 상품 -->
                            <col width="28%"> <!-- CP수수료 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>셀러</th>
                                <th>매출</th>
                                <th>상품</th>
                                <th>CP수수료</th>
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all">
                            <tr>
                                <td class="number">uwal (uwal)</td>
                                <td class="number"><?= number_format($price_arr[0]) ?> <span><?= $price_arr[0] ?>%</span></td>
                                <td class="number"><?= number_format($cnt_arr[0]) ?> <span><?= $cnt_arr[0] ?>%</span></td>
                                <td class="number"><?= number_format($cp_arr[0]) ?> <span><?= $cp_arr[0] ?>%</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php
                        // 배송비 배열
                        $delivery_arr = array();

                        $point_arr = array();
                    
                        $coupon_arr = array();
        
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
                            <col width="34%"> <!-- 배송비 -->
                            <col width="33%"> <!-- 적립금 -->
                            <col width="33%"> <!-- 쿠폰 -->

                        </colgroup>
                        <thead>
                            <tr>
                                <th>배송비</th>
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

                    <table class="listIn fixed-header">
                        <colgroup>
                            <col width="16%"> <!-- 월 -->
                            <col width="28%"> <!-- 배송비 -->
                            <col width="28%"> <!-- 적립금 -->
                            <col width="28%"> <!-- 쿠폰 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <th>셀러</th>
                                <th>배송비</th>
                                <th>적립금</th>
                                <th>쿠폰</th>
                            </tr>
                        </thead>
                        <tbody class="count_per" id="count_all"> 
                            <tr>
                                <td class="number">uwal (uwal)</td>
                                <td class="number"><?= number_format($delivery_arr[0]) ?> <span><?= $delivery_arr[0] ?>%</span></td>
                                <td class="number"><?= number_format($point_arr[0]) ?> <span><?= $point_arr[0] ?>%</span></td>
                                <td class="number"><?= number_format($coupon_arr[0]) ?> <span><?= $coupon_arr[0] ?>%</span></td>
                            </tr>
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