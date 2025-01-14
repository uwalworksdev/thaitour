<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<?php
  error_reporting(E_ALL & ~E_WARNING);
  ini_set('display_errors', 1); 
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
								  WHERE isViewAdmin = 'N' ";
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
?>
	<div id="container" class="main">
		<span id="print_this"><!-- 인쇄영역 시작 //-->
  <div class="payment_info_sec main_cont">
    <div class="w_80">
      <ul class="payment_info_row">
        <li>
          <strong class="label">금일 매출액 <span>※현재기준</span></strong>
          <p class="all_pay"><b><?=$TODAY_CONFIRM_PAYMENT?></b>원</p>
          <div class="pay_detail">
            <dl>
              <dt>예약</dt>
              <dd><?=$TODAY_CONFIRM_COUNT?></dd>
            </dl>
			      <dl>
              <dt>결제</dt>
              <dd><?=$TODAY_PAYMENT_COUNT?></dd>
            </dl>
            <dl>
              <dt>취소</dt>
              <dd><?=$TODAY_CANCLE_COUNT?></dd>
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
      <div class="management_info">
        <strong class="ico_ttl"><i></i>상품판매(<?=$TOTAL_PRODUCT_COUNT?>)</strong>
        <ul class="management_list">
          <li>
            <a class="link_go" href="/AdmMaster/_reservation/list?product_code_1=1303">호텔<span><?=$TOTAL_HOTEL_COUNT?></span></a>
          </li>
          <li>
            <a class="link_go" href="#!">골프<span><?=$TOTAL_GOLF_COUNT?></span></a>
          </li>
          <li>
            <a class="link_go" href="#!">투어<span><?=$TOTAL_TOURS_COUNT?></span></a>
          </li>
          <li>
            <a class="link_go" href="#!">스파<span><?=$TOTAL_SPA_COUNT?></span></a>
          </li>
          <li>
            <a class="link_go" href="#!">쇼ㆍ입장권<span><?=$TOTAL_TICKET_COUNT?></span></a>
          </li>
          <li>
            <a class="link_go" href="#!">레스토랑<span><?=$TOTAL_RESTAURANT_COUNT?></span></a>
          </li>
          <li>
            <a class="link_go" href="#!">차량 . 가이드<span><?=$TOTAL_CARS_COUNT?></span></a>
          </li>
        </ul>
      </div>
      <div class="management_info">
        <strong class="ico_ttl"><i></i>문의 게시판(<span style="color: red;"><? echo $TOTAL_CONTACT_COUNT + $TOTAL_QNA_COUNT + $TOTAL_INQUIRY_COUNT?></span>)</strong>
        <ul class="management_list">
          <li>
            <a class="link_go" href="/AdmMaster/_contact/list.php">여행문의<span><?=$TOTAL_CONTACT_COUNT?></span></a>
          </li>
          <li>
            <a class="link_go" href="/AdmMaster/_qna/list.php">1:1 여행상담<span><?=$TOTAL_QNA_COUNT?></span></a>
          </li>
          <li>
            <a class="link_go" href="/AdmMaster/_inquiry/list.php">맞춤문의<span><?=$TOTAL_INQUIRY_COUNT?></span></a>
          </li>
        </ul>
      </div>
      <div class="graph_cont">
        <div>
        <div id="chart"></div>
      </div>
      </div>
    </div>

    <div class="w_20">
      <div class="cal_item">
        <div class="top">
          <p class="sub_ttl">판매상태 <span>최근 1주일 이내</span></p>
          <p class="all_pay"><b><?=$W_SALE_SUM?></b>원</p>
        </div>
        <ul class="bot_list">
          <li class="cont_01">
            <p><i></i>예약접수</p>
            <em><?=$W_SALE_W_COUNT?></em>
          </li>
          <li class="cont_02">
            <p><i></i>선금대기</p>
            <em><?=$W_SALE_G_COUNT?></em>
          </li>
          <li class="cont_03">
            <p><i></i>잔금대기</p>
            <em><?=$W_SALE_R_COUNT?></em>
          </li>
          <li class="cont_04">
            <p><i></i>결제완료</p>
            <em><?=$W_SALE_Y_COUNT?></em>
          </li>
          <li class="cont_05">
            <p><i></i>예약취소</p>
            <em><?=$W_SALE_C_COUNT?></em>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="bod_list_cont main_cont">
    <ul class="bod_list_wrap">
      <li>
        <div class="ttl">
          <strong>공지사항</strong
          ><a href="/AdmMaster/_bbs/board_list?code=b2b_notice">더보기 <i> &gt;</i></a>
        </div>
        <ul class="bod_list">
		<?php
			  $sql = "  select * from tbl_bbs_list  where code = 'b2b_notice' and status = '' order by notice_yn desc, r_date desc limit 0,3 ";
			  $result = $db->query($sql)->getResultArray();
			  foreach($result as $row)
			  {
        ?>
          <li>
            <a href="/AdmMaster/_bbs/board_write?scategory=&search_mode=&search_word=&code=b2b_notice&bbs_idx=<?=$row['bbs_idx']?>&pg=1"><span class="sb_ttl"><?= $row['subject'] ?> </span><em class="date"><?= substr($row['r_date'], 0, 10) ?></em></a>
          </li>
        <?php 
			  }
		?>
          <!--li>
            <a href="#!"
              ><span class="sb_ttl">123</span
              ><em class="date">2023-02-09</em></a
            >
          </li-->
        </ul>
      </li>
      <li>
        <div class="ttl">
          <strong>자주묻는 질문</strong
          ><a href="/AdmMaster/_bbs/index.php?r_code=faq">더보기 <i> &gt;</i></a>
        </div>
        <ul class="bod_list">
		<?php
              $sql = " SELECT * FROM tbl_bbs
			                    WHERE r_code = 'faq' AND r_status = 'Y' 
								ORDER BY r_date desc limit 0, 3 ";
			  $result = $db->query($sql)->getResultArray();
			  foreach ($result as $row)
			  {
        ?>
			  <li>
				<a href="/AdmMaster/_bbs/view?cmd=view&r_idx=<?=$row['r_idx']?>&page=1&r_code=faq"><span class="sb_ttl"><?=$row['r_title']?></span><em class="date"><?=date("Y.m.d", strtotime($row['r_date']))?></em></a>
			  </li>
        <?php
              }
        ?>
          <!--li>
            <a href="#!"
              ><span class="sb_ttl">질문02</span
              ><em class="date">2023-05-24</em></a
            >
          </li-->
        </ul>
      </li>
      <li>
        <div class="ttl">
          <strong>1대1 여행상담</strong
          ><a href="/AdmMaster/_qna/list.php">더보기 <i> &gt;</i></a>
        </div>
        <ul class="bod_list">
		<?php
              $sql = " SELECT A.*, COUNT(B.r_idx) AS cmt_cnt
                                FROM tbl_travel_qna A
                                LEFT JOIN tbl_bbs_cmt B ON A.idx = B.r_idx AND B.r_code = 'qna'
                                GROUP BY A.idx
								ORDER BY A.idx desc limit 0, 3 ";
			  $result = $db->query($sql)->getResultArray();
			  foreach ($result as $row)
			  {
        ?>
          <li>
            <a href="/AdmMaster/_qna/detail.php?idx=<?=$row['idx']?>"><span class="sb_ttl"><?= $row['title'] ?></span><em class="date"><?=date("Y.m.d", strtotime($row['r_date']))?></em></a
            >
          </li>
        <?php
              }
        ?>
          <!--li>
            <a href="#!"
              ><span class="sb_ttl">ㅇㅇㅇ</span
              ><em class="date">2023-03-06</em></a
            >
          </li-->
        </ul>
      </li>
    </ul>
  </div>

            <!-- // main -->
		</span><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->

    <?php
    $now = strtotime(date("Y-m-d H:i:s"));
		$yy = date('Y',strtotime($now."-12 month"));     // -1년
		$mm = date('m',strtotime($now."-12 month"));     // -1년

		//echo $yy ."-". $mm ."<br>";   
		 
		for($i = 1; $i < 13; $i++)
		{

			// $ii = $mm + $i;
      $ii = ++$mm;
			if($ii > 12) {
			   $_mm = 1;
			   $mm  = 1;
			   $_yy = $yy + 1;
			   $yy  = $yy + 1;
			} else {
			   $_mm = $ii;
			   $_yy = $yy;
			}

			if($_mm < 10) $_mm = "0". $_mm;

			$order_ym = $_yy ."-". $_mm;

			$sql    = "select count(*) as cnt, sum(order_price) as total_payment from tbl_order_mst where substring(order_r_date,1,7) = '$order_ym' ";
			//echo $i." - ".$sql ."<br>";
			$result = $db->query($sql);
			$row    = $result->getRowArray();

			$oYM[$i]   = $order_ym;
			$mCnt[$i]  = (int)$row['cnt'];
			$mTot[$i]  = (int)$row['total_payment'];
		}
    ?>

    <script src="/js/admin/apexcharts.js"></script>
    <script>
        

    // 차트에 넣을 기간
    let chart_caption = "";
    let today = new Date();
    var oneYearAgo = new Date(today.getFullYear() - 1, today.getMonth(), today.getDate());
    var oneYearAgoFormatted = oneYearAgo.getFullYear() + '.' + (oneYearAgo.getMonth() + 1).toString().padStart(2, '0');
    var nowFormatted = today.getFullYear() + '.' + (today.getMonth() + 1).toString().padStart(2, '0');
    chart_caption = oneYearAgoFormatted + "~" + nowFormatted;
    chart_caption = '<?=$oYM[1]?>' + "~" + '<?=$oYM[12]?>';

    
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
                    data: ['<?=$mTot[1]?>',
					       '<?=$mTot[2]?>',
					       '<?=$mTot[3]?>',
					       '<?=$mTot[4]?>',
					       '<?=$mTot[5]?>',
					       '<?=$mTot[6]?>',
					       '<?=$mTot[7]?>',
					       '<?=$mTot[8]?>',
					       '<?=$mTot[9]?>',
					       '<?=$mTot[10]?>',
					       '<?=$mTot[11]?>',
					       '<?=$mTot[12]?>']
                    //data: chart_price
                }, {
                    name: '매출건수',
                    type: 'line',
                    data: ['<?=$mCnt[1]?>',
					       '<?=$mCnt[2]?>',
					       '<?=$mCnt[3]?>',
					       '<?=$mCnt[4]?>',
					       '<?=$mCnt[5]?>',
					       '<?=$mCnt[6]?>',
					       '<?=$mCnt[7]?>',
					       '<?=$mCnt[8]?>',
					       '<?=$mCnt[9]?>',
					       '<?=$mCnt[10]?>',
					       '<?=$mCnt[11]?>',
					       '<?=$mCnt[12]?>']                    //data: chart_cnt
                }],
                colors : ['#3a82f8', '#ff2c27'],
                chart: {
                    height: 390,
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

