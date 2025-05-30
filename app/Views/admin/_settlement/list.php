<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>정산관리</h2>
                    <div class="menus">
                        <ul class="first">
                        </ul>

                        <ul class="last">
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->
            <?php
                // 전월 판매금액
                $last_ym = date("Y-m", strtotime("-1 month", time()));

                $area_1 = " AND SUBSTRING(ZIP,1,2) IN('01','02','03','04','05','06','07','08','09') "; // 서울
                $area_2 = " AND SUBSTRING(ZIP,1,2) IN('10','11','12','13','14','15','16','17','18','19','20') "; // 경기도
                $area_3 = " AND SUBSTRING(ZIP,1,2) IN('46','47','48','49') "; // 부산
                $area_4 = " AND SUBSTRING(ZIP,1,2) IN('21','22','23') "; // 인천
                $area_5 = " AND SUBSTRING(ZIP,1,2) IN('41','42','43') "; // 대구
                $area_6 = " AND SUBSTRING(ZIP,1,2) IN('50','51','52','53') "; // 경상도
                $area_7 = " AND SUBSTRING(ZIP,1,2) IN('27','28','29','31','32','33') "; // 충청도
                $area_8 = " AND SUBSTRING(ZIP,1,2) IN('54','55','56','57','58','59','61','62') "; // 전라도
                $area_9 = " AND SUBSTRING(ZIP,1,2) IN('63') "; // 제주도

                $todate         = date('Y-m-d');
                $curr_yymm      = date('Y-m');

                $currYear       = date('Y');
                $currMonth      = date('m');
                $currMonth      = $currMonth - 1;
                if($currMonth == 0) {
                $currMonth = "12";
                $currYear  = $currYear - 1; 
                }
                $last_yymm      = $currYear ."-". $currMonth;

                $timestr        = strtotime($todate);
                $week           = date('w', strtotime($todate));
                $weekfr         = $timestr - ($week * 86400);
                $weekla         = $weekfr + (6 * 86400);
                $prev_frdate    = date('Y-m-d', $weekfr - (86400 * 6)); // 지난주 시작일자
                $prev_todate    = date('Y-m-d', $weekla - (86400 * 6)); // 지난주 종료일자

                $infoSql        = " SELECT 

                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status != 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') = CURDATE()))        AS TODAY_CONFIRM_PAYMENT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status != 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') = CURDATE()))        AS TODAY_CONFIRM_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status IN('G','R')   AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') = CURDATE())) AS TODAY_PAYMENT_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') = CURDATE()))        AS TODAY_CANCLE_COUNT,

                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status != 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') = CURDATE() - INTERVAL 1 DAY))        AS YESTERDAY_CONFIRM_PAYMENT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status != 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') = CURDATE() - INTERVAL 1 DAY))        AS YESTERDAY_CONFIRM_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status IN('G','R')   AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') = CURDATE() - INTERVAL 1 DAY)) AS YESTERDAY_PAYMENT_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') = CURDATE() - INTERVAL 1 DAY))        AS YESTERDAY_CANCEL_COUNT,

                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status != 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN '$prev_frdate' AND '$prev_todate'))       AS LW_CONFIRM_PAYMENT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status != 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN '$prev_frdate' AND '$prev_todate'))       AS LW_CONFIRM_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status IN('G','R') AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN '$prev_frdate' AND '$prev_todate'))  AS LW_PAYMENT_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN '$prev_frdate' AND '$prev_todate'))       AS LW_CANCLE_COUNT,

                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status != 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m') = '$curr_yymm'))      AS CM_CONFIRM_PAYMENT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status != 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m') = '$curr_yymm'))      AS CM_CONFIRM_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status IN('G','R') AND (DATE_FORMAT(order_r_date, '%Y-%m') = '$curr_yymm')) AS CM_PAYMENT_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m') = '$curr_yymm'))      AS CM_CANCLE_COUNT,

                                        (SELECT COUNT(order_IDX)   FROM tbl_order_mst WHERE order_status != 'C'  AND SUBSTRING(order_r_date,1,7) = '$last_ym')  AS LAST_MONTH_CONFIRM_COUNT, 
                                        (SELECT SUM(deposit_price) FROM tbl_order_mst WHERE order_status  = 'G'  AND SUBSTRING(order_r_date,1,7) = '$last_ym')  AS LAST_MONTH_DEPOSIT_PAYMENT, 
                                        (SELECT SUM(order_price)   FROM tbl_order_mst WHERE order_status  = 'R'  AND SUBSTRING(order_r_date,1,7) = '$last_ym')  AS LAST_MONTH_CONFIRM_PAYMENT, 

                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'W' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_W_COUNT, 
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'G' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_G_COUNT, 
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'R' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_R_COUNT, 
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'Y' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_Y_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_C_COUNT,

                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_SUM, 
                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status  = 'W' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_W_SUM, 
                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status  = 'G' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_G_SUM, 
                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status  = 'R' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_R_SUM, 
                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status  = 'Y' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_Y_SUM,
                                        (SELECT SUM(order_price) FROM tbl_order_mst WHERE order_status  = 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE())) AS W_SALE_C_SUM,

                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'W' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE())) AS M_SALE_W_COUNT, 
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'G' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE())) AS M_SALE_G_COUNT, 
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'R' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE())) AS M_SALE_R_COUNT, 
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'Y' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE())) AS M_SALE_Y_COUNT,
                                        (SELECT COUNT(order_idx) FROM tbl_order_mst WHERE order_status  = 'C' AND (DATE_FORMAT(order_r_date, '%Y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE())) AS M_SALE_C_COUNT
                                        FROM tbl_order_mst 
                                    ";
                // write_log($infoSql);
                $db = \Config\Database::connect();
                $infoResult     = $db->query($infoSql);
                $info           = $infoResult->getRowArray();
                $info['LAST_MONTH_TOTAL_PAYMENT'] = $info['LAST_MONTH_DEPOSIT_PAYMENT'] + $info['LAST_MONTH_CONFIRM_PAYMENT'];
                foreach($info AS $key => $val) {
                    ${$key} = number_format($val);
                }
                                            
                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_PRODUCT_COUNT 
                                            FROM tbl_order_mst a 
                                            LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                            WHERE b.product_code_1 IN ('1303','1302','1301','1325','1317','1320','1324') ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_HOTEL_COUNT 
                                            FROM tbl_order_mst a
                                            LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                            WHERE b.product_code_1 = '1303' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_GOLF_COUNT 
                                            FROM tbl_order_mst a
                                            LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                            WHERE b.product_code_1 = '1302' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_TOURS_COUNT 
                                            FROM tbl_order_mst a
                                            LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                            WHERE b.product_code_1 = '1301' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_SPA_COUNT
                                            FROM tbl_order_mst a
                                            LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                            WHERE b.product_code_1 = '1325' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_TICKET_COUNT 
                                            FROM tbl_order_mst a
                                            LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                            WHERE b.product_code_1 = '1317' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_RESTAURANT_COUNT 
                                            FROM tbl_order_mst a
                                            LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                            WHERE b.product_code_1 = '1320' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_CARS_COUNT 
                                            FROM tbl_order_mst a
                                            LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                            WHERE b.product_code_1 = '1324' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(idx) AS TOTAL_CONTACT_COUNT 
                                            FROM tbl_travel_contact 
                                                    ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(idx) AS TOTAL_QNA_COUNT 
                                            FROM tbl_travel_qna 
                                            WHERE isViewQna = 'N' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(idx) AS TOTAL_INQUIRY_COUNT 
                                            FROM tbl_inquiry 
                                            WHERE isViewInquiry = 'N' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                    ${$key} = number_format($val);
                }

                $infoSql_1        = " SELECT COUNT(bbs_idx) AS TOTAL_NOTICE_COUNT 
                    FROM tbl_bbs_list 
                    WHERE code = 'b2b_notice' ";
                // write_log($infoSql_1);
                $infoResult_1     = $db->query($infoSql_1);
                $info_1           = $infoResult_1->getRowArray();
                foreach($info_1 AS $key => $val) {
                ${$key} = number_format($val);
                }
            ?>
                <div id="container" class="main" style="margin-top: 0;margin-left: 0;width: 100%; min-height: calc(87vh - 60px);">
                    <span id="print_this"><!-- 인쇄영역 시작 //-->
                    <div class="payment_info_sec main_cont">
                        <div class="w_80">
                        <ul class="payment_info_row">
                            <li>
                            <strong class="label">금일 매출액 <span>※현재기준</span></strong>
                            <p class="all_pay"><b><?=number_format($info['TODAY_CONFIRM_PAYMENT'])?></b>원</p>
                            <div class="pay_detail">
                                <dl>
                                <dt>예약</dt>
                                <dd><?=number_format($TODAY_CONFIRM_COUNT)?></dd>
                                </dl>
                                    <dl>
                                <dt>결제</dt>
                                <dd><?=number_format($TODAY_PAYMENT_COUNT)?></dd>
                                </dl>
                                <dl>
                                <dt>취소</dt>
                                <dd><?=number_format($TODAY_CANCLE_COUNT)?></dd>
                                </dl>
                            </div>
                            </li>
                            <li>
                            <strong class="label">전일 매출액</strong>
                            <p class="all_pay"><b><?=$YESTERDAY_CONFIRM_PAYMENT?></b>원</p>
                            <div class="pay_detail">
                                <dl>
                                <dt>예약</dt>
                                <dd><?=$YESTERDAY_CONFIRM_COUNT?></dd>
                                </dl>
                                    <dl>
                                <dt>결제</dt>
                                <dd><?=$YESTERDAY_PAYMENT_COUNT?></dd>
                                </dl>
                                <dl>
                                <dt>취소</dt>
                                <dd><?=$YESTERDAY_CANCEL_COUNT?></dd>
                                </dl>
                            </div>
                            </li>
                            <li>
                            <strong class="label">전주 매출액</strong>
                            <p class="all_pay"><b><?=$LW_CONFIRM_PAYMENT?></b>원</p>
                            <div class="pay_detail">
                                <dl>
                                <dt>예약</dt>
                                <dd><?=$LW_CONFIRM_COUNT?></dd>
                                </dl>
                                    <dl>
                                <dt>결제</dt>
                                <dd><?=$LW_PAYMENT_COUNT?></dd>
                                </dl>
                                <dl>
                                <dt>취소</dt>
                                <dd><?=$LW_CANCLE_COUNT?></dd>
                                </dl>
                            </div>
                            </li>
                            <li>
                            <strong class="label">당월 매출액</strong>
                            <p class="all_pay"><b><?=$CM_CONFIRM_PAYMENT?></b>원</p>
                            <div class="pay_detail">
                                <dl>
                                <dt>예약</dt>
                                <dd><?=$CM_CONFIRM_COUNT?></dd>
                                </dl>
                                    <dl>
                                <dt>결제</dt>
                                <dd><?=$CM_PAYMENT_COUNT?></dd>
                                </dl>
                                <dl>
                                <dt>취소</dt>
                                <dd><?=$CM_CANCLE_COUNT?></dd>
                                </dl>
                            </div>
                            </li>
                        </ul>
                        </div>
                        <div class="w_20">
                        <div class="color_cont top">
                            <div class="left">
                            <p>전월 판매금액</p>
                            <span>판매완료</span>
                            </div>
                            <div class="right"><b><?=$LAST_MONTH_CONFIRM_COUNT?></b>건</div>
                        </div>
                        <div class="color_cont bot">
                            <div class="left">
                            <p>전월 결제금액</p>
                            <span>결제완료</span>
                            </div>
                            <div class="right"><b><?=$LAST_MONTH_TOTAL_PAYMENT?></b>원</div>
                        </div>
                        </div>
                    </div>

                    <div class="calculate_sec main_cont">
                        <div class="w_80">
                        <div class="graph_cont">
                            <div>
                            <div id="chart"></div>
                        </div>
                        </div>
                        </div>

						<?php 
						   $order_sum = $tot_price1 =  $tot_price2 =  $tot_price3 =  $tot_price4 =  $tot_price5 =  $tot_price6 =  $tot_price7 = 0;
						   foreach ($fresult5 as $row5) {
									if($row5['status_group'] == "예약접수") $tot_price1 = $row5['total_amount'];	
									if($row5['status_group'] == "예약확인") $tot_price2 = $row5['total_amount'];	
									if($row5['status_group'] == "결제완료") $tot_price3 = $row5['total_amount'];	
									if($row5['status_group'] == "예약확정") $tot_price4 = $row5['total_amount'];	
									if($row5['status_group'] == "예약취소") $tot_price5 = $row5['total_amount'];	
									if($row5['status_group'] == "예약불가") $tot_price6 = $row5['total_amount'];	
									if($row5['status_group'] == "이용완료") $tot_price7 = $row5['total_amount'];	
						   }
						   
						   $order_sum = $tot_price1 + $tot_price2 + $tot_price3 + $tot_price4 + $tot_price5 + $tot_price6 + $tot_price7; 
						?> 
                        <div class="w_20">
                        <div class="cal_item">
                            <div class="top">
                            <p class="sub_ttl">판매상태 <span>최근 1주일 이내</span></p>
                            <p class="all_pay"><b><?=number_format($order_sum)?></b>원</p>
                            </div>
                            <ul class="bot_list">
								<li class="cont_01">
									<p><i></i>예약접수</p>
									<em><?=number_format($tot_price1)?></em>
								</li>
								<li class="cont_02">
									<p><i></i>예약확인</p>
									<em><?=number_format($tot_price2)?></em>
								</li>
								<li class="cont_03">
									<p><i></i>결제완료</p>
									<em><?=number_format($tot_price3)?></em>
								</li>
								<li class="cont_04">
									<p><i></i>예약확정</p>
									<em><?=number_format($tot_price4)?></em>
								</li>
								<li class="cont_05">
									<p><i></i>예약취소</p>
									<em><?=number_format($tot_price5)?></em>
								</li>
								<li class="cont_04">
									<p><i></i>예약불가</p>
									<em><?=number_format($tot_price6)?></em>
								</li>
								<li class="cont_05">
									<p><i></i>이용완료</p>
									<em><?=number_format($tot_price7)?></em>
								</li>
                            </ul>
                        </div>
                        </div>
                    </div>

                        <!-- // main -->
                    </span><!-- 인쇄 영역 끝 //-->
                </div><!-- // container -->

                <?php
                $now = strtotime("now");

                $start_yy = date('Y', strtotime("-11 months", $now));
                $start_mm = date('m', strtotime("-11 months", $now));

                $oYM = [];
                $mCnt = []; 
                $mTot = [];

                for ($i = 0; $i < 12; $i++) {
                    $_mm = $start_mm + $i;
                    $_yy = $start_yy;

                    if ($_mm > 12) { 
                        $_mm -= 12;
                        $_yy++;
                    }

                    $_mm = str_pad($_mm, 2, "0", STR_PAD_LEFT);
                    $order_ym = $_yy . "-" . $_mm;
                    $oYM[$i] = $order_ym;

                    $sql = "SELECT COUNT(*) AS cnt, SUM(order_price) AS total_payment 
                            FROM tbl_order_mst 
                            WHERE SUBSTRING(order_r_date, 1, 7) = '$order_ym'";

                    $result = $db->query($sql);
                    $row = $result->getRowArray();

                    $mCnt[$i] = (int)$row['cnt'];
                    $mTot[$i] = (int)$row['total_payment'];
                }
                ?>


                <div id="contents">
                <form name="search" id="search">
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable01" style="table-layout:fixed;">
                        <colgroup>
                            <col width="150">
                            <col width="*">
                        </colgroup>
                        <thead>
                        <tr>
                            <th colspan="2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="label">카테고리</td>
                            <td>
                                <select id="product_code_1" name="product_code_1" class="input_select"
                                        onchange="javascript:get_code(this.value, 3)">
                                    <option value="">1차분류</option>
                                    <?php

                                    foreach ($fresult as $frow) {
                                        $status_txt = "";
                                        if ($frow["status"] == "Y") {
                                            $status_txt = "";
                                        } elseif ($frow["status"] == "N") {
                                            $status_txt = "[삭제]";
                                        } elseif ($frow["status"] == "C") {
                                            $status_txt = "[마감]";
                                        }

                                        ?>
                                        <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_1) {
                                            echo "selected";
                                        } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                    <?php } ?>

                                </select>
                                <select id="product_code_2" name="product_code_2" class="input_select"
                                        onchange="javascript:get_code(this.value, 4)">
                                    <option value="">2차분류</option>
                                    <?php

                                    foreach ($fresult2 as $frow) {
                                        $status_txt = "";
                                        if ($frow["status"] == "Y") {
                                            $status_txt = "";
                                        } elseif ($frow["status"] == "N") {
                                            $status_txt = "[삭제]";
                                        } elseif ($frow["status"] == "C") {
                                            $status_txt = "[마감]";
                                        }

                                        ?>
                                        <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_2) {
                                            echo "selected";
                                        } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                    <?php } ?>
                                </select>
                                <select id="product_code_3" name="product_code_3" class="input_select">
                                    <option value="">3차분류</option>
                                    <?php

                                    foreach ($fresult3 as $frow) {
                                        $status_txt = "";
                                        if ($frow["status"] == "Y") {
                                            $status_txt = "";
                                        } elseif ($frow["status"] == "N") {
                                            $status_txt = "[삭제]";
                                        } elseif ($frow["status"] == "C") {
                                            $status_txt = "[마감]";
                                        }

                                        ?>
                                        <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_3) {
                                            echo "selected";
                                        } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">결제방법</td>
                            <td class="inbox">

                                <?php
                                foreach ($_pg_Method as $key => $value) {
                                    ?>
                                    <p>
                                        <input name="payment_chker[]" class="state_chker" type="checkbox"
                                               value="<?= $key ?>" > <?= $value ?>
                                        &nbsp;&nbsp;
                                    </p>
                                <?php } ?>
                            </td>
                        </tr>
                        <!--tr>
                            <td class="label">예약상품상태</td>
                            <td class="inbox">
                                <?php
                                foreach ($_deli_type as $key => $value) {
                                    ?>
                                    <p>
                                        <input name="state_chker[]" class="state_chker" type="checkbox"
                                               value="<?= $key ?>" <?php if (in_array($key, $state_chker)) echo "checked"; ?> > <?= $value ?>
                                        &nbsp;&nbsp;
                                    </p>
                                <?php } ?>
                                <!--p><input name="isDelete" class="state_chker" type="checkbox"
                                          value="Y" <?php if ($isDelete == "Y") echo "checked"; ?>> 예약자삭제&nbsp;&nbsp;
                                </p-->
                            <!--/td>
                        </tr-->
                        <tr>
                            <td class="label">기간검색</td>
                            <td class="inbox">

                                <p>
                                    <select name="date_chker" id="date_chker" class="select_02">
                                        <option value="order_r_date" <?php if ($date_chker == "order_r_date") echo "selected"; ?> >
                                            예약일
                                        </option>
                                        <option value="deposit_date" <?php if ($date_chker == "deposit_date") echo "selected"; ?> >
                                            선금결제일
                                        </option>
                                        <option value="confirm_date" <?php if ($date_chker == "confirm_date") echo "selected"; ?> >
                                            잔금결제일
                                        </option>
                                        <option value="order_c_date" <?php if ($date_chker == "order_c_date") echo "selected"; ?> >
                                            취소일
                                        </option>
                                    </select>&nbsp;
                                </p>

                                <div class="contact_btn_box">
                                    <div>
                                        <button type="button" rel="<?= date('Y-m-d') ?>" class="contact_btn"
                                                title="today">오늘
                                        </button>
                                        <button type="button" rel="<?= date('Y-m-d', strtotime('-1 week')); ?>"
                                                class="contact_btn" title="week">1주일
                                        </button>
                                        <button type="button" rel="<?= date('Y-m-d', strtotime('-1 month')); ?>"
                                                class="contact_btn" title="1month">1개월
                                        </button>
                                        <button type="button" rel="<?= date('Y-m-d', strtotime('-6 month')); ?>"
                                                class="contact_btn" title="6month">6개월
                                        </button>
                                        <button type="button" rel="<?= date('Y-m-d', strtotime('-1 year')); ?>"
                                                class="contact_btn" title="year">1년
                                        </button>
                                        <input type="text" name="s_date" id="s_date" value="<?= $s_date ?>"
                                               class="date_form"><span>~</span><input type="text" name="e_date"
                                                                                      id="e_date"
                                                                                      value="<?= $e_date ?>"
                                                                                      class="date_form">
                                        <div id="time_layer"
                                             style="float: left; display: <?= (trim($s_time) == "" && trim($e_time) == "" ? "none" : "") ?>;">
                                            <select id="s_time" name="s_time">
                                                <option value="">선택</option>
                                                <?php for ($t = 1; $t <= 23; $t++) { ?>
                                                    <option value="<?= $t ?>" <?= ((int)($s_time) == $t ? "selected" : "") ?> ><?= ((int)($t) < 10 ? "0" . (int)($t) : (int)($t)) ?></option>
                                                <?php } ?>
                                            </select> ~
                                            <select id="e_time" name="e_time">
                                                <option value="">선택</option>
                                                <?php for ($t = 1; $t <= 23; $t++) { ?>
                                                    <option value="<?= $t ?>" <?= ((int)($e_time) == $t ? "selected" : "") ?> ><?= ((int)($t) < 10 ? "0" . (int)($t) : (int)($t)) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">검색어</td>
                            <td class="inbox">
                                <div class="r_box">
                                    <select id="" name="search_category" class="input_select" style="width:112px">
                                        <option value="a.order_no" <?php if ($search_category == "a.order_no") {
                                            echo "selected";
                                        } ?>>예약번호
                                        </option>
                                        <option value="a.order_user_name" <?php if ($search_category == "a.order_user_name") {
                                            echo "selected";
                                        } ?>>예약자명
                                        </option>
                                        <option value="a.manager_name" <?php if ($search_category == "a.manager_name") {
                                            echo "selected";
                                        } ?>>담당자명
                                        </option>
                                        <option value="a.product_name" <?php if ($search_category == "a.product_name") {
                                            echo "selected";
                                        } ?>>상품명
                                        </option>
                                        <option value="a.order_user_mobile" <?php if ($search_category == "a.order_user_mobile") {
                                            echo "selected";
                                        } ?>>예약지휴대폰
                                        </option>
                                    </select>

                                    <input type="text" id="" name="search_name" value="<?= $search_name ?>"
                                           class="input_txt placeHolder" rel="검색어 입력" style="width:240px"/>

                                    <a href="javascript:search_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-search"></span> <span
                                                class="txt">검색하기</span></a>
                                </div>
                            </td>
                        </tr>

                        <!--tr>
                            <td class="label">엑셀받기</td>
                            <td class="inbox">
                                <a href="javascript:get_excel()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-search"></span> <span class="txt">다운로드</span></a>
                            </td>
                        </tr-->

                        </tbody>
                    </table>

                    <div style="display: flex; align-items: center; justify-content: center;">
                        <a href="javascript:search_it()" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span> 
                            <span class="txt">검색하기</span>
                        </a>
                    </div>

                    <div style="border: 1px dashed #c6bebe; margin: 20px 0;"></div>

                    <div class="settlement_wrap">
                        <h4>전체 정산대기 통계</h4>
                        <div class="table_accounts">
                            <dl>
                                <dt>판매금액</dt>
                                <dd><?=number_format($fresult4['price_tot'])?>원</dd>
                            </dl>
                            <dl>
                                <dt>지출금액</dt>
                                <dd class="t_green"><?=number_format($fresult4['exp_amt'])?>원</dd>
                            </dl>
                            <dl>
                                <dt>총수익</dt>
                                <dd class="t_orange"><?=number_format($fresult4['price_tot'] - $fresult4['exp_amt'])?>원</dd>
                            </dl>
                            <dl>
                                <dt>판매갯수</dt>
                                <dd class="t_sky"><?=$fresult4['order_cnt']?>건</dd>
                            </dl>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: end; margin-top: 10px;">
                        <button type="button" id="btn-download-excel" class="btn btn-default"> <img src="https://cdn-icons-png.flaticon.com/512/732/732220.png" alt="Excel Icon" width="24">
                        <span class="txt">다운로드</span></button>
                    </div>

                    <div style="border: 1px dashed #c6bebe; margin: 20px 0;"></div>

                </form>

                <script>
                    // function get_excel() {
                    //     var frm = document.search;
                    //     frm.action = "./excel_down.php";
                    //     frm.submit();
                    // }

                    $('#btn-download-excel').on('click', function () {
                            var form = $('<form action="/excel/get_excel" method="get"></form>');
                            form.appendTo('body');


                            form.submit();
                            form.remove();
                    });

                    function get_code(strs, depth) {
                        $.ajax({
                            url: "get_code",
                            type: "GET",
                            dataType: 'json',
                            data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth, //서버에 보낼 파라메터
                            error: function (request, status, error) {
                                //통신 에러 발생시 처리
                                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                            }
                            , success: function (json) {
                                
                                if (depth <= 3) {
                                    $("#product_code_2").find('option').each(function () {
                                        $(this).remove();
                                    });
                                    $("#product_code_2").append("<option value=''>2차분류</option>");
                                }
                                if (depth <= 4) {
                                    $("#product_code_3").find('option').each(function () {
                                        $(this).remove();
                                    });
                                    $("#product_code_3").append("<option value=''>3차분류</option>");
                                }
                                if (depth <= 4) {
                                    $("#product_code_4").find('option').each(function () {
                                        $(this).remove();
                                    });
                                    $("#product_code_4").append("<option value=''>4차분류</option>");
                                }
                                var list = json;
                                var listLen = list.length;
                                var contentStr = "";
                                for (var i = 0; i < listLen; i++) {
                                    contentStr = "";
                                    if (list[i].code_status == "C") {
                                        contentStr = "[마감]";
                                    } else if (list[i].code_status == "N") {
                                        contentStr = "[사용안함]";
                                    }
                                    $("#product_code_" + (parseInt(depth) - 1)).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                                }
                            }
                        });
                    }
                </script>

                <script>
                    function search_it() {
                        var frm = document.search;
                        // if (frm.search_name.value == "검색어 입력") {
                        //     frm.search_name.value = "";
                        // }
                        frm.submit();
                    }

                    $(function () {
                        $.datepicker.regional['ko'] = {
                            showButtonPanel: true,
                            beforeShow: function (input) {
                                setTimeout(function () {
                                    var buttonPane = $(input)
                                        .datepicker("widget")
                                        .find(".ui-datepicker-buttonpane");
                                    var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                    btn.unbind("click").bind("click", function () {
                                        $.datepicker._clearDate(input);
                                    });
                                    btn.appendTo(buttonPane);
                                }, 1);
                            },
                            closeText: '닫기',
                            prevText: '이전',
                            nextText: '다음',
                            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                            monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                            weekHeader: 'Wk',
                            dateFormat: 'yy-mm-dd',
                            firstDay: 0,
                            isRTL: false,
                            showMonthAfterYear: true,
                            changeMonth: true,
                            changeYear: true,
                            showMonthAfterYear: true,
                            closeText: '닫기',  // 닫기 버튼 패널
                            yearSuffix: ''
                        };
                        $.datepicker.setDefaults($.datepicker.regional['ko']);

                        $(".date_form").datepicker({
                            showButtonPanel: true
                            , beforeShow: function (input) {
                                setTimeout(function () {
                                    var buttonPane = $(input)
                                        .datepicker("widget")
                                        .find(".ui-datepicker-buttonpane");
                                    var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                    btn.unbind("click").bind("click", function () {
                                        $.datepicker._clearDate(input);
                                    });
                                    btn.appendTo(buttonPane);
                                }, 1);
                            }
                            , dateFormat: 'yy-mm-dd'
                            , showOn: "both"
                            , yearRange: "c-100:c+10"
                            , buttonImage: "/AdmMaster/_images/common/date.png"
                            , buttonImageOnly: true
                            , closeText: '닫기'
                            , prevText: '이전'
                            , nextText: '다음'

                        });
                    });
                    $(".contact_btn_box .contact_btn").click(function () {
                        resetClass();
                        $(this).addClass("active");


                        var date1 = $(this).attr("rel");
                        var date2 = $.datepicker.formatDate('yy-mm-dd', new Date());

                        $("#s_date").val(date1);
                        $("#e_date").val(date2);

                    });

                    function resetClass() {
                        $(".contact_btn_box .contact_btn").each(function () {
                            $(this).removeClass("active");
                        });
                    }
                </script>

                    <form name="frm" id="frm" method="GET">
                        <div class="listTop" style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="left">
                                <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 예약이 있습니다.</p>
                            </div>

                            <div class="right">
                                <select id="g_list_rows" name="g_list_rows" class="input_select" style="width: 80px" onchange="submitForm();">
                                    <option value="30"  <?= ($g_list_rows == 30)  ? 'selected' : '' ?>>30개</option>
                                    <option value="50"  <?= ($g_list_rows == 50)  ? 'selected' : '' ?>>50개</option>
                                    <option value="100" <?= ($g_list_rows == 100) ? 'selected' : '' ?>>100개</option>
                                    <option value="200" <?= ($g_list_rows == 200) ? 'selected' : '' ?>>200개</option>
                                </select>
                            </div>

                        </div>
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="60px"/>
                                    <col width="140px"/>
									<col width="140px"/>
                                    <col width="100px"/>
									<col width="100px"/>
                                    <col width="*"/>
                                    <col width="150px"/>
                                    <col width="150px"/>
                                    <col width="150px"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="80px"/>
                                    <col width="80px"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>그룹번호</th>
                                    <th>예약번호</th>
									<th>상태</th>
									<th>상품구분</th>
                                    <th>상품명</th>
                                    <th>예약일시</th>
                                    <th>예약자/아이디</th>
                                    <th>연락처/이메일</th>
                                    <th>상품금액(원)</th>
                                    <th>상품금액(바트)</th>
                                    <th>결제방법</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($nTotalCount == 0) {
                                    ?>
                                    <tr>
                                        <td colspan=14 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php
                                }
                                foreach ($result_new as $row_new) {
									
										 if (str_starts_with($row_new['user_id'], 'naver_')) {
											 $user_id = "naver_". substr($row_new['user_id'], 6, 10); // 6은 'naver_' 길이
										 } else	{ 
											 $user_id = $row_new['user_id'];
										 }
									
                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $num-- ?></td>
                                        <td class="tac">
                                            <?= $row_new["group_no"] ?>
                                        </td>
                                        <td class="tac">
                                            <?= $row_new["order_no"] ?>
                                        </td>
										<!--td class="tac">
                                           
                                            <?php if ($row_new['device_type'] == 'P') { ?>
                                                <span>(PC)</span>
                                            <?php }
                                            if ($row_new['device_type'] == 'M') { ?>
                                                <span>(Mobile)</span>
                                            <?php } ?>
                                        </td-->
                                        <td class="tac">
                                            <?php if ($row_new["is_modify"] == "Y") { ?>
                                                <font color="red">예약수정</font>
                                            <?php } else { ?>
                                                <font color="blue"><?= $_deli_type[$row_new["order_status"]] ?></font>
                                            <?php } ?>
                                            
                                        </td>
										 <td class="tac">
                                            <?= $_isDelete ?>(<?= $row_new['code_name'] ?>)123
                                        </td>
                                        <td class="tal"><a
                                                    href="/AdmMaster/_settlement/write?search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>&order_idx=<?= $row_new['order_idx'] ?>"><?= viewSQ($row_new["product_name_new"]) ?>
                                                <?= $row_new["tours_subject"] ? "/ " . $row_new["tours_subject"] : "" ?></a></td>
                                        <td class="tac"><?= $row_new["order_r_date"] ?></td>
                                        <td class="tac"><?= $row_new["user_name"] ?><br><?= $user_id ?></td>
                                        <td class="tac"><?= $row_new["user_mobile"] ?><br><?= $row_new["user_email"] ?></td>
                                        <td class="tac"><?=number_format($row_new["real_price_won"])?></td>
                                        <td class="tac"><?=number_format($row_new["real_price_bath"])?></td>
                                        <td class="tac">카드결제</td>
                                        <td>
                                            <a href="/AdmMaster/_settlement/write?search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>&order_idx=<?= $row_new['order_idx'] ?>"><img
                                                        src="/images/admin/common/ico_setting2.png"></a>
                                            <a href="javascript:del_it('<?= $row_new['order_idx'] ?>');"><img
                                                        src="/images/admin/common/ico_error.png" alt="에러"/></a>
                                        </td>
                                    </tr>

                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>
 
                    <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_settlement/list') . "?product_code_1=$product_code_1&s_status=$s_status&search_category=$search_category&g_list_rows=$g_list_rows&search_name=$search_name&pg=" . $arrays_paging) ?>
 

                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                </ul>

                                <ul class="last">
                                </ul>

                            </div>

                        </div><!-- // inner -->

                    </div><!-- // headerContainer -->
                </div><!-- // listWrap -->

            </div><!-- // contents -->


        </div><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->


    <script>
        function CheckAll(checkBoxes, checked) {
            var i;
            if (checkBoxes.length) {
                for (i = 0; i < checkBoxes.length; i++) {
                    checkBoxes[i].checked = checked;
                }
            } else {
                checkBoxes.checked = checked;
            }

        }

        function del_it(order_idx) {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "delete",
                type: "POST",
                data: "order_idx[]=" + order_idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response.result == true) {
                        alert("정상적으로 삭제되었습니다.");
                        location.href = "list";
                        return;
                    } else {
                        alert(response);
                        return;
                    }
                }
            });

        }
    </script>

    <script>
        function submitForm() {
            document.getElementById("frm").submit();
        }
    </script>

    <script src="/js/admin/apexcharts.js"></script>
    <script>
        

    // 차트에 넣을 기간
    let chart_caption = "";
    let today = new Date();
    var oneYearAgo = new Date(today.getFullYear() - 1, today.getMonth(), today.getDate());
    var oneYearAgoFormatted = oneYearAgo.getFullYear() + '.' + (oneYearAgo.getMonth() + 1).toString().padStart(2, '0');
    var nowFormatted = today.getFullYear() + '.' + (today.getMonth() + 1).toString().padStart(2, '0');
    chart_caption = oneYearAgoFormatted + "~" + nowFormatted;
    chart_caption = '<?=$oYM[0]?>' + "~" + '<?=$oYM[11]?>';

    
    // 차트 날짜 부분 구하기
    let chart_x = [];

    // 차트에 들어갈 월별 매출 배열
    let chart_price = [];

    // 차트에 들어갈 월별 건수 배열
    let chart_cnt = [];



        var options = {
                series: [{
                    name: '매출내역',
                    type: 'column',
                    data: ['<?=$mTot[0]?>',
                        '<?=$mTot[1]?>',
                        '<?=$mTot[2]?>',
                        '<?=$mTot[3]?>',
                        '<?=$mTot[4]?>',
                        '<?=$mTot[5]?>',
                        '<?=$mTot[6]?>',
                        '<?=$mTot[7]?>',
                        '<?=$mTot[8]?>',
                        '<?=$mTot[9]?>',
                        '<?=$mTot[10]?>',
                        '<?=$mTot[11]?>']
                    //data: chart_price
                }, {
                    name: '매출건수',
                    type: 'line',
                    data: ['<?=$mCnt[0]?>',
                        '<?=$mCnt[1]?>',
                        '<?=$mCnt[2]?>',
                        '<?=$mCnt[3]?>',
                        '<?=$mCnt[4]?>',
                        '<?=$mCnt[5]?>',
                        '<?=$mCnt[6]?>',
                        '<?=$mCnt[7]?>',
                        '<?=$mCnt[8]?>',
                        '<?=$mCnt[9]?>',
                        '<?=$mCnt[10]?>',
                        '<?=$mCnt[11]?>']                    //data: chart_cnt
                }],
                colors : ['#3a82f8', '#ff2c27'],
                chart: {
                    height: 460,
                    type: 'line',
                    stacked: false,
                },
                stroke: {
                    width: [0, 4],
                    curve: 'straight',
                    colors: ['#3a82f8', '#ff2c27'],
        
                },
                plotOptions: {
                    bar: {
                    borderRadius:12 ,
                    columnWidth: '30%'
                    }
                },
            
                dataLabels: {
                    style: {
                    colors: ['#3a82f8', '#ff2c27']
                    }
                },
        
                fill: {
                    opacity: [0.85, 0.25, 1],
                    colors: ['#3a82f8', '#ff2c27'],
                    
                    gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                    }
                },
                labels: chart_x,
            
                markers: {
                    size: 4,
                    colors: ["#ff2c27"],
                    showNullDataPoints: true,
                    hover: {
                        size: undefined,
                        sizeOffset: 3
                    }
        
                },
                xaxis: {
                    type: 'category',
                    labels: {
                        datetimeFormatter: {
                        year: 'yyyy',
                        month: 'yyyy \'MM'
                        }
                    },
                },
                yaxis: [
                    {
                        title: {
                        },
                        labels: {
                            formatter: function(value) {
                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            },
                        },
                    },
                    {
                    opposite: true,
                        title: {
                        },
                        labels: {
                            formatter: function(value) {
                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            },
                        },
                    }
                ],
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {

                        /*
                        formatter: function (y) {
                            
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " 원";
                            }

                            return y;
                    
                        }
                        */
                        formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                            //return value
                            if(seriesIndex === 0){
                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " 원";
                            }else{
                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " 건";
                            }
                            
                        }
                    }
                },
                subtitle: {
                    text: "월별 매출액 : 최근 12개월 ("+chart_caption+")",
                    align: 'left',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                    fontSize:  '18px',
                    fontWeight:  '500',
                    fontFamily: 'Spoqa Han Sans Neo',
                    color:  '#252525'
                    },
                },
                toolbar: {
                    show: false,
                    tools: {
                        download: false,
                        selection: false,
                        zoom: false,
                        zoomin: false,
                        zoomout: false,
                        pan: false,
                        reset: false,
                        customIcons: []
                    },

                }
        
            };



            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
    </script>

<?= $this->endSection() ?>