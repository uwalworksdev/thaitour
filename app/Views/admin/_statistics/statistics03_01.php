<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<div id="container" class="gnb_statistics">
    <span id="print_this">
        <!-- 인쇄영역 시작 //-->
        <header id="headerContainer">
            <div class="inner">
                <h2>방문분석</h2>

				<div class="menus">
					<ul class="first">
						<li><a href="statistics03_05.php" class="btn btn_email01">요일별</a></li>	
						<li><a href="statistics03_04.php" class="btn btn_email01">IP별 검색</a></li>	
						<li><a href="statistics03_01.php" class="btn btn_email01">접속통계</a></li>	
						<li class="mr_10"><a href="statistics03_02.php" class="btn btn_email01">방문경로 순위</a></li>					
					</ul>
				</div>
            </div><!-- // inner -->
        </header><!-- // headerContainer -->

        <div id="contents">
            <div class="statistics_tab">
                <a href="statistics03_01.php" class="on">날짜별</a>
                <a href="statistics03_02_new.php">시간별</a>
            </div>

            <!-- period_table -->
            <div class="period_table">
                <form name="search" id="search">
                    <input type="hidden" name="limits" id="limits" />
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
                                        <div class="input_radio contact_btn" rel="<?=date('Y-m-d')?>">
                                            <input type="radio" name="period" id="period01">
                                            <label for="period01">오늘</label>
                                        </div>
                                        <div class="input_radio contact_btn"
                                             rel="<?=date('Y-m-d', strtotime('-1 week'));?>">
                                            <input type="radio" name="period" id="period02">
                                            <label for="period02">1주일</label>
                                        </div>
                                        <div class="input_radio contact_btn"
                                             rel="<?=date('Y-m-d', strtotime('-1 month'));?>">
                                            <input type="radio" name="period" id="period03">
                                            <label for="period03">1개월</label>
                                        </div>
                                        <div class="input_radio contact_btn"
                                             rel="<?=date('Y-m-d', strtotime('-3 month'));?>">
                                            <input type="radio" name="period" id="period04">
                                            <label for="period04">3개월</label>
                                        </div>
                                        <div class="period_input">
                                            <input type="text" name="s_date" id="s_date" value="<?=$s_date?>" readonly
                                                   class="date_form">
                                            <span>~</span>
                                            <input type="text" name="e_date" id="e_date" value="<?=$e_date?>" readonly
                                                   class="date_form">
                                        </div>
                                        <button type="button" class="submit_btn" onclick="search_it()">검색</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- // period_table -->
            <script>
                function search_it() {
                    var fom = document.search;
                    fom.action = "statistics03_01.php";
                    fom.submit();
                }
            </script>
            <!-- graph_wrap -->
            <div class="graph_wrap">
                <h3>통계 그래프</h3>
                <div class="graph_area" id="chart_div" style="width: 100%; height: 500px;">

                </div>
        </div>

<script>
    $(document).ready(function () {
        $('.graph02').each(function () {

            var $Height = $(this).attr('data-percent')
            //alert($Width)
            $(this).css({
                'height': $Height
            });
        });
    });
</script>
<!-- //graph_wrap -->

<!-- statistics_table -->
<div class="statistics_table">
    <form name="frm" id="frm">
        <table cellpadding="0" cellspacing="0" summary="">
            <caption></caption>
            <colgroup>
                <col width="25%;">
                <col width="25%;">
                <col width="25%;">
                <col width="25%;">
            </colgroup>
            <thead style="position: sticky; top: 59px">
            <tr>
                <th>일자</th>
                <th>접속 계산 (PC)</th>
                <th>접속 계산 (Mobile)</th>
                <th>합계</th>
            </tr>
            </thead>
            <tbody>

            <?php
                $pcnt_tot = 0;
                $mcnt_tot = 0;
                while($row=mysqli_fetch_array($result)){

                    $pcnt_tot += $row['itemCnt_P'];
                    $mcnt_tot += $row['itemCnt_M'];
            ?>
                <tr>
                    <td class="date">
                        <?=$row['regdate']?>(<?=$row['week']?>)
                    </td>
                    <td><?=number_format($row['itemCnt_P'])?></td>
                    <td><?=number_format($row['itemCnt_M'])?></td>
                    <td><?=number_format($row['itemCnt_P'] + $row['itemCnt_M'])?></td>
                </tr>
            <?php
                }
            ?>

            </tbody>
            <tfoot>
                <tr>
                    <td class="tfoot_label">합계</td>
                    <td><?=number_format($pcnt_tot)?></td>
                    <td><?=number_format($mcnt_tot)?></td>
                    <td><?=number_format($pcnt_tot + $mcnt_tot)?></td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>
<!-- //statistics_table -->
</div><!-- // contents -->

</span><!-- 인쇄 영역 끝 //-->
</div>

<script>
    $("#login_type_P_Sum").html("<?=number_format($login_type_P_Sum)?>");
    $("#login_type_M_Sum").html("<?=number_format($login_type_M_Sum)?>");
    $("#login_type_PM_Sum").html("<?=number_format($login_type_M_Sum + $login_type_P_Sum)?>");
    $("#itemCnt_P_Sum").html("<?=number_format($itemCnt_P_Sum)?>");
    $("#itemCnt_M_Sum").html("<?=number_format($itemCnt_M_Sum)?>");
    $("#itemCnt_PM_Sum").html("<?=number_format($itemCnt_P_Sum + $itemCnt_M_Sum)?>");
</script>

<script>
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

    $(document).ready(function () {
        $(".period_search .contact_btn").click(function () {
            var date1 = $(this).attr("rel");
            var date2 = $.datepicker.formatDate('yy-mm-dd', new Date());

            $("#s_date").val(date1);
            $("#e_date").val(date2);

        });
    })

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['날짜', 'PC', 'MOBILE'],
            ...visitData
        ]);

        var options = {
            chart: {
                title: '날짜별 접속 통계'
            }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

<?= $this->endSection() ?>