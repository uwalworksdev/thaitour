<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>예약내역</h2>
                    <div class="menus">
                        <ul class="first">
                        </ul>

                        <ul class="last">
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

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
                        <tr>
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
                            </td>
                        </tr>
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

                                    <!--a href="javascript:search_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-search"></span> <span
                                                class="txt">검색하기</span></a-->
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
                <!--/form>

                <form name="search" id="search">
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable01" style="table-layout:fixed;">
                        <colgroup>
                            <col width="100">
                            <col width="*">
                            <col width="100">
                            <col width="*">
                        </colgroup>

                        <tbody>
                            <tr>
                                <td style="font-weight: bold;">상품명</td>
                                <td>
                                   <input type="text" name="product_name" value="" placeholder="상품명">
                                </td>
                                <td style="font-weight: bold;">결제수단</td>
                                <td>
                                    <select name="payment_chker" class="state_chker" style="width: 100%;">
                                        <option value="">결제수단 전체</option>
                                        <?php
                                            foreach ($_pg_Method as $key => $value) {
                                        ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">검색기간</td>
                                <td class="inbox">
                                    <div style="display: flex; gap: 5px;">
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
                                        <div style="display: flex; gap: 5px; align-items: center;">
                                            <input type="text" name="s_date" id="s_date" value="<?= $s_date ?>" class="date_form" placeholder="날짜 선택">
                                            <span>~</span>
                                            <input type="text" name="e_date" id="e_date" value="<?= $e_date ?>" class="date_form" placeholder="날짜 선택">
                                        </div>

                                        <div id="time_layer"
                                            style="display: <?= (trim($s_time) == "" && trim($e_time) == "" ? "none" : "flex") ?>; align-items: center; gap: 5px;">
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

                                </td>
                                <td style="font-weight: bold;">검색어</td>
                                <td class="inbox">
                                    <div class="r_box">
                                        <span>입점업체 미사용</span>
                                        <a href="#" style="color: #48A1E5; text-decoration: underline;  text-underline-offset: 3px;">신청하기</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table-->

                    <div style="display: flex; align-items: center; justify-content: center;">
                        <a href="javascript:search_it()" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span> 
                            <span class="txt">검색하기</span>
                        </a>
                    </div>
                    <?php
                    $db = \Config\Database::connect();
                            $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_PRODUCT_COUNT 
	                             FROM tbl_order_mst a 
	                             LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
							     WHERE b.product_code_1 IN ('1303','1302','1301','1325','1317','1320','1324') ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                                $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_HOTEL_COUNT 
	                             FROM tbl_order_mst a
	                             LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
								 WHERE b.product_code_1 = '1303' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_GOLF_COUNT 
                                                        FROM tbl_order_mst a
                                                        LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                                        WHERE b.product_code_1 = '1302' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_TOURS_COUNT 
                                                        FROM tbl_order_mst a
                                                        LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                                        WHERE b.product_code_1 = '1301' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_SPA_COUNT
                                                        FROM tbl_order_mst a
                                                        LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                                        WHERE b.product_code_1 = '1325' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_TICKET_COUNT 
                                                        FROM tbl_order_mst a
                                                        LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                                        WHERE b.product_code_1 = '1317' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_RESTAURANT_COUNT 
                                                        FROM tbl_order_mst a
                                                        LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                                        WHERE b.product_code_1 = '1320' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(a.order_idx) AS TOTAL_CARS_COUNT 
                                                        FROM tbl_order_mst a
                                                        LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                                                        WHERE b.product_code_1 = '1324' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(idx) AS TOTAL_CONTACT_COUNT 
                                                        FROM tbl_travel_contact 
                                                                ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(idx) AS TOTAL_QNA_COUNT 
                                                        FROM tbl_travel_qna 
                                                        WHERE isViewQna = 'N' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(idx) AS TOTAL_INQUIRY_COUNT 
                                                        FROM tbl_inquiry 
                                                        WHERE isViewInquiry = 'N' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                                ${$keys} = number_format($vals);
                            }

                            $infoSql_1        = " SELECT COUNT(bbs_idx) AS TOTAL_NOTICE_COUNT 
                                FROM tbl_bbs_list 
                                WHERE code = 'b2b_notice' ";
                            // write_log($infoSql_1);
                            $infoResult_1     = $db->query($infoSql_1);
                            $info_1           = $infoResult_1->getRowArray();
                            foreach($info_1 AS $keys => $vals) {
                            ${$keys} = number_format($vals);
                            }
                    ?>
                    <div style="border: 1px dashed #c6bebe; margin: 20px 0;"></div>
                    <div class="management_info">
                        <strong class="ico_ttl"><i></i>상품판매(<?=$TOTAL_PRODUCT_COUNT?>)</strong>
                        <ul class="management_list">
                        <li>
                            <a class="link_go" href="/AdmMaster/_reservation/list?product_code_1=1303">호텔<span><?=$TOTAL_HOTEL_COUNT?></span></a>
                        </li>
                        <li>
                            <a class="link_go" href="/AdmMaster/_reservation/list?product_code_1=1302">골프<span><?=$TOTAL_GOLF_COUNT?></span></a>
                        </li>
                        <li>
                            <a class="link_go" href="/AdmMaster/_reservation/list?product_code_1=1301">투어<span><?=$TOTAL_TOURS_COUNT?></span></a>
                        </li>
                        <li>
                            <a class="link_go" href="/AdmMaster/_reservation/list?product_code_1=1325">스파<span><?=$TOTAL_SPA_COUNT?></span></a>
                        </li>
                        <li>
                            <a class="link_go" href="/AdmMaster/_reservation/list?product_code_1=1317">쇼ㆍ입장권<span><?=$TOTAL_TICKET_COUNT?></span></a>
                        </li>
                        <li>
                            <a class="link_go" href="/AdmMaster/_reservation/list?product_code_1=1320">레스토랑<span><?=$TOTAL_RESTAURANT_COUNT?></span></a>
                        </li>
                        <li>
                            <a class="link_go" href="/AdmMaster/_reservation/list?product_code_1=1324">차량 . 가이드<span><?=$TOTAL_CARS_COUNT?></span></a>
                        </li>
                        </ul>
                    </div>
                    <div style="border: 1px dashed #c6bebe; margin: 20px 0;"></div>
                    <div class="management_info">
                        <strong class="ico_ttl"><i></i>문의 게시판(<span style="color: red;"><? echo $TOTAL_CONTACT_COUNT + $TOTAL_NOTICE_COUNT + $TOTAL_INQUIRY_COUNT?></span>)</strong>
                        <ul class="management_list">
                        <li>
                            <a class="link_go" href="/AdmMaster/_qna/list">1:1 여행상담<span><?=$TOTAL_INQUIRY_COUNT?></span></a>
                        </li>
                        <li>
                            <a class="link_go" href="/AdmMaster/_contact/list">고객의 소리<span><?=$TOTAL_CONTACT_COUNT?></span></a>
                        </li>
                        <li>
                            <a class="link_go" href="/AdmMaster/_bbs/board_list?code=b2b_notice">공지사항<span><?=$TOTAL_NOTICE_COUNT?></span></a>
                        </li>
                        </ul>
                    </div>
                    <div style="border: 1px dashed #c6bebe; margin: 20px 0;"></div>
                    <?php 
					   $tot_price1 =  $tot_price2 =  $tot_price3 =  $tot_price4 =  $tot_price5 =  $tot_price6 =  $tot_price7 = 0;
                       foreach ($fresult4 as $row4) {
						        if($row4['status_group'] == "예약접수") $tot_price1 = $row4['total_amount'];	
						        if($row4['status_group'] == "예약가능") $tot_price2 = $row4['total_amount'];	
						        if($row4['status_group'] == "결제완료") $tot_price3 = $row4['total_amount'];	
						        if($row4['status_group'] == "예약확정") $tot_price4 = $row4['total_amount'];	
						        if($row4['status_group'] == "예약취소") $tot_price5 = $row4['total_amount'];	
						        if($row4['status_group'] == "예약불가") $tot_price6 = $row4['total_amount'];	
						        if($row4['status_group'] == "이용완료") $tot_price7 = $row4['total_amount'];	
					   }
					?>   

                    <div class="settlement_wrap">
                        <h4>전체 예약내역 통계 <span style="margin-left: 30px; font-size: 13px; color: #c6bebe;">최근 1주일 이내</span></h4>
                        <div class="table_accounts new">
                            <dl>
                                <dt>
                                    <i class="img01"></i>
                                    <p>예약접수</p>
                                </dt>
                                <dd style="color: #ff7f27;"><?=number_format($tot_price1)?>원</dd>
                            </dl>
                            <dl>
                                <dt>
                                    <i class="img02"></i>
                                    <p>예약가능</p>
                                </dt>
                                <dd style="color: #1eb1cf;"><?=number_format($tot_price2)?>원</dd>
                            </dl>
                            <dl>
                                <dt>
                                    <i class="img03"></i>
                                    <p>
                                        결제완료
                                    </p>
                                </dt>
                                <dd style="color: #22b14c;"><?=number_format($tot_price3)?>원</dd>
                            </dl>
                            <dl>
                                <dt>
                                    <i class="img04"></i>
                                    <p>
                                        예약확정
                                    </p>
                                </dt>
                                <dd style="color: #0000ff;"><?=number_format($tot_price4)?>원</dd>
                            </dl>
                            <dl>
                                <dt>
                                    <i class="img05"></i>
                                    <p>
                                        예약취소
                                    </p>
                                </dt>
                                <dd style="color: #ff0000;"><?=number_format($tot_price5)?>원</dd>
                            </dl>
                            <dl>
                                <dt>
                                    <i class="img03"></i>
                                    <p>
                                        예약불가
                                    </p>
                                </dt>
                                <dd style="color: #ff0000;"><?=number_format($tot_price6)?>원</dd>
                            </dl>
                            <dl>
                                <dt>
                                    <i class="img04"></i>
                                    <p>이용완료</p>
                                </dt>
                                <dd style="color: #804040;"><?=number_format($tot_price7)?>원</dd>
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
                    // 엑셀 다운(상품예약)
                    // function get_excel() {
                    //     var frm = document.search;
                    //     frm.action = "./excel_down.php";
                    //     frm.submit();
                    // }

                    $('#btn-download-excel').on('click', function () {
                            var form = $('<form action="/excel/get_excel_main" method="get"></form>');
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
                                    <col width="130px"/>
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
                                    <?php
                                        if(session()->get('member')['id'] == 'admin') {
                                    ?>
                                    <col width="80px"/>
                                    <?php
                                        }
                                    ?>
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
                                    <?php
                                        if(session()->get('member')['id'] == 'admin') {
                                    ?>
                                    <th>관리</th>
                                    <?php
                                        }
                                    ?>
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
									
								$_deli_type = get_payment_type(); 	
								$_color_deli_type = get_color_payment_type(); 	

                                foreach ($result as $row) {
									
										 if (str_starts_with($row['user_id'], 'naver_')) {
											 $user_id = "naver_". substr($row['user_id'], 6, 10); // 6은 'naver_' 길이
										 } else	{ 
											 $user_id = $row['user_id'];
										 }
									
                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $num-- ?></td>
                                        <td class="tac">
                                            <?= $row["group_no"] ?>
                                        </td>
                                        <td class="tac">
                                            <?= $row["order_no"] ?>
                                        </td>
										<!--td class="tac">
                                           
                                            <?php if ($row['device_type'] == 'P') { ?>
                                                <span>(PC)</span>
                                            <?php }
                                            if ($row['device_type'] == 'M') { ?>
                                                <span>(Mobile)</span>
                                            <?php } ?>
                                        </td-->
                                        <td class="tac">
                                            <?php if ($row["is_modify"] == "Y") { ?>
                                                <font color="red">예약수정</font>
                                            <?php } else { ?>
                                                <?php
                                                    if($row["order_status"] == "")    
                                                ?>

                                                <font color="<?= $_color_deli_type[$row["order_status"]]?>"><?= $_deli_type[$row["order_status"]] ?></font>
                                            <?php } ?>
                                            
                                        </td>
										 <td class="tac">
                                            <?= $_isDelete ?>(<?= $row['code_name'] ?>)
                                        </td>
                                        <td class="tal"><a
                                                    href="/AdmMaster/_reservation/write/<?=$row['order_gubun']?>?search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>&order_idx=<?= $row['order_idx'] ?>"><?= viewSQ($row["product_name_new"]) ?>
                                                <?= $row["tours_subject"] ? "/ " . $row["tours_subject"] : "" ?></a></td>
                                        <td class="tac"><?= $row["order_r_date"] ?></td>
                                        <td class="tac"><?= $row["user_name"] ?><br><?= $user_id ?></td>
                                        <td class="tac"><?= $row["user_mobile"] ?><br><?= $row["user_email"] ?></td>
                                        <td class="tac"><?=number_format($row["real_price_won"])?></td>
                                        <td class="tac"><?=number_format($row["real_price_bath"])?></td>
                                        <td class="tac"></td>
                                        <?php
                                            if(session()->get('member')['id'] == 'admin') {
                                        ?>
                                        <td>
                                            <div class="flex_button">
                                                <button onclick="window.location.href='/AdmMaster/_reservation/write/<?=$row['order_gubun']?>?search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>&order_idx=<?= $row['order_idx'] ?>'"
                                                        type="button" class="btn_default btn btn-primary">
                                                    수정
                                                </button>
                                                <button onclick="del_it('<?= $row["order_idx"] ?>');" type="button"
                                                        class="btn_default btn btn-danger">
                                                    삭제
                                                </button>
                                            </div>
                                        </td>
                                        <?php
                                            }
                                        ?>
                                    </tr>

                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>
 
                    <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_reservation/list') . "?product_code_1=$product_code_1&s_status=$s_status&search_category=$search_category&g_list_rows=$g_list_rows&search_name=$search_name&pg=" . $arrays_paging) ?>
 

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

<?= $this->endSection() ?>