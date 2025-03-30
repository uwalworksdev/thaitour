<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
    $connect = db_connect();
    $private_key = private_key();

    if ($_SESSION["member"]["mIdx"] == "") {
        alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }

?>
<link href="/css/invoice/invoice.css" rel="stylesheet" type="text/css"/>
<link href="/css/invoice/invoice_responsive.css" rel="stylesheet" type="text/css"/>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new02.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive.css" rel="stylesheet" type="text/css"/>

<style>
    .mypage_container .content .details_table tbody tr .date {
        width: fit-content;
        padding: 0 15px;
    }

    .mypage_container .content .details_table tbody tr .date:after {
        right: -0.9615rem;
    }

    .mypage_container .content .details_table tbody tr .date:nth-child(2) {
        padding: 0 15px;
    }

    .mypage_container .content .details_table tbody tr .ttl {
        padding: 0 15px;
    }

</style>

<section class="invoice_paid">
    <div class="inner">
        <div class="ttl_box">
            <h1>
                <?= (html_entity_decode($row['product_name'])) ?>
            </h1>
            <span class="stt_2">
				<?= get_status_name($row["order_status"]) ?>
			</span>
        </div>
        <p class="ttl_date">
            <?= $row["order_r_date"] ?>
        </p>
        <!-- 웹 -->
        <div class="invoice_table invoice_table_new only_web">
            <h2>예약 정보</h2>
            <table>
                <colgroup>
                    <col width="15%">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <td class="subject">예약번호</td>
                    <td col width="*%" class="subject">성인</td>
                    <td col width="15%" class="subject">소아</td>
                    <td col width="15%" class="subject">상품 예약금액</td>
                    <td col width="15%" class="subject">쿠폰</td>
                    <td col width="15%" class="subject">실예약금액</td>

                </tr>
                <tr>

                    <td col width="15%" class="content">
							<span>
								<?= $row["order_no"] ?>
							</span>
                    </td>

                    <td class="content">
                        <span><?= $row["people_adult_cnt"] ?></span>
                    </td>

                    <td class="content">
                        <p>
                            <?= $row["people_kids_cnt"] ?>
                        </p>
                    </td>
                    <td class="content">
                        <p>
                            <strong>
                                <span id="price_tot">
									<?= number_format($row['order_price']) ?>
								</span>
                            </strong> 원
                        </p>
                    </td>
                    <td class="content">
                        <?php if ($row['used_coupon_money'] > 0) { ?>
                            <p><strong style="color:red">쿠폰 <span id="coupon_amt">
											<?= number_format($row['used_coupon_money']) ?> 원
										</span></strong></p>
                        <?php } ?>

                        <?php if ($row['used_mileage_money'] > 0) { ?>
                            <p><strong style="color:red">포인트 <span id="point_amt">
											<?= number_format($row['used_mileage_money']) ?> 원
										</span></strong></p>
                        <?php } ?>
                    </td>
                    <td class="content">
                        <p><strong><span id="price_tot">
                                <?= number_format($order_price - $used_mileage_money) ?></strong>
                            </span> 원</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- 예약정보 모바일 -->

        <div class="invoice_table invoice_table_new only_mo">
            <h2>예약 정보</h2>
            <table>
                <colgroup>
                    <col width="15%">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <td class="subject">예약번호</td>
                    <td class="content">
							<span>
                                <?= $row["order_no"] ?>
							</span>
                    </td>
                </tr>
                <tr>
                    <td class="subject">성인</td>
                    <td class="content">
                        <span><?= $row["people_adult_cnt"] ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="subject">소아</td>

                    <td class="content">
                        <p>
                            <?= $row["people_kids_cnt"] ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="subject">상품 예약금액</td>

                    <td class="content">
                        <p><strong><span id="price_tot">
										<?= number_format($row['order_price']) ?>
									</span></strong> 원</p>
                    </td>
                </tr>
                <tr>
                    <td class="subject">쿠폰</td>

                    <td class="content">
                        <?php if ($row['used_coupon_money'] > 0) { ?>
                            <p><strong style="color:red">쿠폰 <span id="coupon_amt">
											<?= number_format($row['used_coupon_money']) ?> 원
										</span></strong></p>
                        <?php } ?>

                        <?php if ($row['used_mileage_money'] > 0) { ?>
                            <p><strong style="color:red">포인트 <span id="point_amt">
											<?= number_format($row['used_mileage_money']) ?> 원
										</span></strong></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td class="subject">실예약금액</td>

                    <td class="content">
                        <p><strong><span id="price_tot">
                            <?= number_format($order_price - $used_mileage_money) ?></strong>
                        </span> 원</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- 예약자 정보 웹 -->

        <div class="invoice_table invoice_table_new only_web">
            <h2>예약 정보</h2>
            <table>
                <colgroup>
                    <col width="15%">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <td class="subject">출발지역</td>
                    <td col width="15%" class="subject">도착지역</td>
                    <td col width="*%" class="subject">범주</td>
                    <td col width="15%" class="subject">미팅날짜</td>
                </tr>
                <tr>

                    <td col width="15%" class="content">
                        <span>
                            <?= $departure_name ?>
                        </span>
                    </td>

                    <td class="content">
                        <span><?= $destination_name ?></span>
                    </td>

                    <td class="content">
                        <p>
                            <?php
                                $category_text_arr = [];
                                foreach($category_arr as $category){
                                    array_push($category_text_arr, $category["code_name"]);
                                }

                                echo implode(", ", $category_text_arr);
                            ?>
                        </p>
                    </td>
                    <td class="content">
                        <p>
                            <?php
                                if($code_no_first == "5403"){
                            ?>      
                                <?php echo date("Y-m-d", strtotime($meeting_date)) . "~" . date("Y-m-d", strtotime($return_date))?>
                            <?php
                                }else{
                            ?>
                                <?php echo date("Y-m-d", strtotime($meeting_date))?>
                            <?php
                                }
                            ?>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- 예약정보 모바일 -->

        <div class="invoice_table invoice_table_new only_mo">
            <h2>예약 정보</h2>
            <table>
                <colgroup>
                    <col width="15%">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <td class="subject">출발지역</td>
                    <td class="content">
                        <span>
                            <?= $departure_name ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="subject">도착지역</td>
                    <td class="content">
                        <span><?= $destination_name ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="subject">범주</td>

                    <td class="content">
                        <p>
                            <?php
                                $category_text_arr = [];
                                foreach($category_arr as $category){
                                    array_push($category_text_arr, $category["code_name"]);
                                }

                                echo implode(", ", $category_text_arr);
                            ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="subject">미팅날짜</td>

                    <td class="content">
                        <p>
                            <?php
                                if($code_no_first == "5403"){
                            ?>      
                                <?php echo date("Y-m-d", strtotime($meeting_date)) . "~" . date("Y-m-d", strtotime($return_date))?>
                            <?php
                                }else{
                            ?>
                                <?php echo date("Y-m-d", strtotime($meeting_date))?>
                            <?php
                                }
                            ?>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- 예약자 정보 웹 -->

        <div class="invoice_table invoice_table_new only_web">
            <h2>예약자 정보</h2>
            <table>
                <colgroup>
                    <col width="8%">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <td class="subject">이름</td>
                    <td col width="8%" class="subject">영문 이름(First Name)</td>
                    <td col width="8%" class="subject">영문 성(Last Name)</td>
                    <td col width="12%" class="subject">휴대번호</td>
                    <td col width="12%" class="subject">이메일</td>
                    <td col width="12%" class="subject">여행시 현지 연락처</td>

                </tr>
                <tr>

                    <td col width="8%" class="content">
                        <?= $row_d['order_user_name'] ?>
                    </td>

                    <td class="content">
                        <?= $row_d['order_user_first_name_en'] ?>
                    </td>

                    <td class="content">
                        <?= $row_d['order_user_last_name_en'] ?>
                    </td>

                    <td class="content">
                        <?= $row_d['order_user_phone'] ?>
                    </td>

                    <td class="content">
                        <?= $row_d['order_user_email'] ?>
                    </td>

                    <td class="content">
                        <?= $local_phone ?>
                    </td>

                </tbody>
            </table>
        </div>

        <!-- 예약자 정보 모바일 -->

        <div class="invoice_table invoice_table_new only_mo">
            <h2>예약자 정보</h2>
            <table>
                <colgroup>
                    <col width="10%">
                    <col width="*">
                </colgroup>
                <tbody>

                <tr>
                    <td class="subject">이름</td>
                    <td class="content">
                        <?= $row_d['order_user_name'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="subject">영문 이름(First Name)</td>

                    <td class="content">
                        <?= $row_d['order_user_first_name_en'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="subject">영문 성(Last Name)</td>
                    <td class="content">
                        <?= $row_d['order_user_last_name_en'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="subject">휴대번호</td>
                    <td class="content">
                        <?= $row_d['order_user_phone'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="subject">이메일</td>
                    <td class="content">
                        <?= $row_d['order_user_email'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="subject">여행시 현지 연락처</td>
                    <td class="content">
                        <?= $local_phone ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice_table invoice_table_new reservation only_web">
            <h2>예약금액 결제</h2>
            <table>
                <colgroup>
                    <col width="*">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                    <col width="10%">
                    <col width="20%">
                </colgroup>
                <tbody>
                <tr>
                    <td class="subject">예약상태</td>
                    <td class="subject">결제상태</td>
                    <td class="subject">결제방법</td>
                    <td class="subject">결제금액</td>
                    <td class="subject">결제</td>
                    <td class="subject">결제일</td>
                </tr>

                <?php if ($row["order_status"] == "W") { ?>
                    <tr>
                        <td class="content" colspan="7">예약 준비중</td>
                    </tr>
                <?php } ?>

                <?php if ($row["order_status"] == "C") { ?>
                    <tr>
                        <td class="content" colspan="6">예약 취소</td>
                    </tr>
                <?php } ?>

                <?php if ($row["order_status"] == "G" || $row["order_status"] == "J") { ?>
                    <tr>
                        <td col width="8%" class="content">
                            결제금액
                        </td>

                        <td class="content">
							<?php 
								if($row["order_status"] == "G") {
								   echo "결제대기";
								} else {
								   echo "입금대기";
								}   
							?>	
                        </td>

                        <td class="content">
                            <?= $row['deposit_method'] ?>
                        </td>

                        <td class="content">
                            <?= number_format($row['order_price']) ?>
                        </td>

                        <td class="content">
								<?php if ($row["order_status"] == "G") { ?>
								<button type="button" id="deposit" class="btn my-button" value="<?= $row["order_no"] ?>">결제하기</button>
								<?php } ?>
                        </td>
                    </tr>
                <?php } ?>

                <?php if ($row["order_status"] == "R") { ?>
                    <tr>
                        <td col width="8%" class="content">
                            선금
                        </td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                결제완료
                            <?php } else { ?>
                                <?= $row['ResultMsg_1'] ?>
                            <?php } ?>
                        </td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= $row['deposit_method'] ?>
                            <?php } else { ?>
                                신용카드
                            <?php } ?>
                        </td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= number_format($row['deposit_price']) ?> 원
                            <?php } else { ?>
                                <?= number_format($row['deposit_price']) ?> 원
                            <?php }
                            ?>
                        </td>

                        <td class="content link">
                        </td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= $row['deposit_date'] ?>
                            <?php } else { ?>
                                <?= date($row['order_confirm_date']); ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td col width="8%" class="content">
                            잔금
                        </td>

                        <td class="content">
                            잔금 입금 대기
                        </td>

                        <td class="content">
                            <?= $row['confirm_method'] ?>
                        </td>

                        <td class="content">
                            <?= number_format($row['order_confirm_price']) ?> 원
                        </td>

                        <td class="content">
                        </td>
                    </tr>
                <?php } ?>

                <?php if ($row["order_status"] == "Y") { ?>
                    <tr>
                        <td col width="8%" class="content">
                            선금
                        </td>
                        <td class="content">
                            결제완료
                        </td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                결제완료
                            <?php } else { ?>
                                신용카드
                            <?php } ?>
                        </td>
                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= number_format($row['deposit_price']) ?> 원
                            <?php } else { ?>
                                <!-- <?= number_format($row['Amt_1']) ?> 원 -->
                                <?= number_format($row['order_price']) ?> 원
                            <?php } ?>
                        </td>

                        <td class="content link">
                        </td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= date($row['order_confirm_date']); ?>
                            <?php } else { ?>
                                <?= date($row['order_confirm_date']); ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td col width="8%" class="content">
                            잔금
                        </td>
                        <td class="content">
                            잔금입금완료
                        </td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= $row['deposit_method'] ?>
                            <?php } else { ?>
                                신용카드
                            <?php } ?>
                        </td>

                        <td class="content">
                            <?php if ($row['confirm_method'] == "무통장입금") { ?>
                                <?= number_format($row['order_confirm_price']) ?> 원
                            <?php } else { ?>
                                <!-- <?= number_format($row['Amt_2']) ?> 원 -->
                                <?= number_format($row['order_confirm_price']) ?> 원
                            <?php } ?>
                        </td>

                        <td class="content link">
                        </td>

                        <td class="content">

                            <?php if ($row['confirm_method'] == "무통장입금") { ?>
                                <!-- <?= $row['order_confirm_date'] ?> -->
                                <?= date($row['order_c_date']); ?>
                            <?php } else { ?>
                                <!-- <?= date("Y-m-d", strtotime("20" . $row['AuthDate_2'])); ?> -->
                                <?= date($row['order_c_date']); ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

        <div class="invoice_table invoice_table_new only_mo">
            <h2>예약금액 결제</h2>
            <table>
                <colgroup>
                    <col width="15%">
                    <col width="*">
                </colgroup>
                <tbody>
                <?php if ($row["order_status"] == "W") { ?>
                    <tr>
                        <td class="content" colspan="2">예약 준비중</td>
                    </tr>
                <?php } ?>

                <?php if ($row["order_status"] == "C") { ?>
                    <tr>
                        <td class="content" colspan="2">예약 취소</td>
                    </tr>
                <?php } ?>
                <?php if ($row["order_status"] == "G" || $row["order_status"] == "J") { ?>
                    <tr>
                        <td class="subject">예약상태</td>
                        <td class="content">
                            <span>
                                결제금액
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제상태</td>
                        <td class="content">
                            <?php 
								if($row["order_status"] == "G") {
								   echo "결제대기";
								} else {
								   echo "입금대기";
								}   
							?>	
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제방법</td>

                        <td class="content">
                            <?= $row['deposit_method'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제금액</td>

                        <td class="content">
                            <?= number_format($row['order_price']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제</td>

                        <td class="content">
                            <?php if ($row["order_status"] == "G") { ?>
                            <button type="button" id="deposit" class="btn my-button" value="<?= $row["order_no"] ?>">결제하기</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                <?php if ($row["order_status"] == "R") { ?>
                    <tr>
                        <td class="subject">예약상태</td>
                        <td class="content">
                            <span>
                            선금
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제상태</td>
                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                결제완료
                            <?php } else { ?>
                                <?= $row['ResultMsg_1'] ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제방법</td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= $row['deposit_method'] ?>
                            <?php } else { ?>
                                신용카드
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제금액</td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= number_format($row['deposit_price']) ?> 원
                            <?php } else { ?>
                                <?= number_format($row['deposit_price']) ?> 원
                            <?php }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제</td>

                        <td class="content">

                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제일</td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= $row['deposit_date'] ?>
                            <?php } else { ?>
                                <?= date($row['order_confirm_date']); ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">예약상태</td>
                        <td class="content">
                            <span>
                            잔금
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제상태</td>
                        <td class="content">
                            잔금 입금 대기
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제방법</td>
                        <td class="content">
                            <?= $row['confirm_method'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제방법</td>

                        <td class="content">
                            <?= number_format($row['order_confirm_price']) ?> 원
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제</td>

                        <td class="content">
                        </td>
                    </tr>
                <?php }?>
                <?php if ($row["order_status"] == "Y") { ?>
                    <tr>
                        <td class="subject">예약상태</td>
                        <td class="content">
                            <span>
                            선금
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제상태</td>
                        <td class="content">
                            결제완료
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제방법</td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                결제완료
                            <?php } else { ?>
                                신용카드
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제금액</td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= number_format($row['deposit_price']) ?> 원
                            <?php } else { ?>
                                <?= number_format($row['order_price']) ?> 원
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제</td>

                        <td class="content">
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제일</td>

                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= date($row['order_confirm_date']); ?>
                            <?php } else { ?>
                                <?= date($row['order_confirm_date']); ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">예약상태</td>
                        <td class="content">
                            <span>
                            잔금
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제상태</td>
                        <td class="content">
                            잔금입금완료
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제방법</td>
                        <td class="content">
                            <?php if ($row['deposit_method'] == "무통장입금") { ?>
                                <?= $row['deposit_method'] ?>
                            <?php } else { ?>
                                신용카드
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제방법</td>

                        <td class="content">
                            <?php if ($row['confirm_method'] == "무통장입금") { ?>
                                <?= number_format($row['order_confirm_price']) ?> 원
                            <?php } else { ?>
                                <?= number_format($row['order_confirm_price']) ?> 원
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">결제</td>

                        <td class="content">
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">결제일</td>

                        <td class="content">
                            <?php if ($row['confirm_method'] == "무통장입금") { ?>
                                <?= date($row['order_c_date']); ?>
                            <?php } else { ?>
                                <?= date($row['order_c_date']); ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>

        <?php
            if($code_no_first == "5401"){
        ?>  

        <div class="invoice_table invoice_table_new only_web">
            <h2>가는 편</h2>
            <table>
                <colgroup>
                    <col width="10%">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <td class="subject">항공편 명</td>
                    <td col width="15%" class="subject">항공 도착 날짜</td>
                    <td col width="8%" class="subject">항공 도착 시간</td>
                    <td col width="20%" class="subject">목적지</td>
                    <td col width="*%" class="subject">기타요철</td>
                </tr>
                <tr>
                    <td col width="8%" class="content">
                        <?= $order_cars_detail[0]["air_code"] ?>
                    </td>

                    <td class="content">
                        <?=$order_cars_detail[0]["date_trip"]?>
                    </td>

                    <td class="content">
                        <?=$order_cars_detail[0]["hours"]?> 시 <?=$order_cars_detail[0]["minutes"]?> 분
                    </td>

                    <td class="content">
                        <?=$order_cars_detail[0]["destination_name"]?>
                    </td>

                    <td class="content">
                        <?=nl2br($order_cars_detail[0]["order_memo"])?>
                    </td>
                </tbody>
            </table>
        </div>

        <!-- 예약자 정보 모바일 -->

        <div class="invoice_table invoice_table_new only_mo">
            <h2>가는 편</h2>
            <table>
                <colgroup>
                    <col width="10%">
                    <col width="*">
                </colgroup>
                <tbody>

                <tr>
                    <td class="subject">항공편 명</td>
                    <td class="content">
                        <?= $order_cars_detail[0]["air_code"] ?>
                    </td>
                </tr>

                <tr>
                    <td class="subject">항공 도착 날짜</td>

                    <td class="content">
                        <?=$order_cars_detail[0]["date_trip"]?>
                    </td>
                </tr>

                <tr>
                    <td class="subject">항공 도착 시간</td>
                    <td class="content">
                        <?=$order_cars_detail[0]["hours"]?> 시 <?=$order_cars_detail[0]["minutes"]?> 분
                    </td>
                </tr>

                <tr>
                    <td class="subject">목적지</td>
                    <td class="content">
                        <?=$order_cars_detail[0]["destination_name"]?>
                    </td>
                </tr>
                <tr>
                    <td class="subject">기타요철</td>
                    <td class="content">
                        <?=nl2br($order_cars_detail[0]["order_memo"])?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <?php 
            if(count($order_cars_detail) > 1){
        ?>
            <div class="invoice_table invoice_table_new only_web">
                <h2>오는 편</h2>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="subject">항공편 명</td>
                        <td col width="15%" class="subject">항공 도착 날짜</td>
                        <td col width="8%" class="subject">항공 도착 시간</td>
                        <td col width="20%" class="subject">미팅 장소</td>
                        <td col width="*%" class="subject">기타요철</td>
                    </tr>
                    <tr>
                        <td col width="8%" class="content">
                            <?= $order_cars_detail[1]["air_code"] ?>
                        </td>

                        <td class="content">
                            <?=$order_cars_detail[1]["date_trip"]?>
                        </td>

                        <td class="content">
                            <?=$order_cars_detail[1]["hours"]?> 시 <?=$order_cars_detail[1]["minutes"]?> 분
                        </td>

                        <td class="content">
                            <?=$order_cars_detail[1]["departure_name"]?>
                        </td>

                        <td class="content">
                            <?=nl2br($order_cars_detail[1]["order_memo"])?>
                        </td>
                    </tbody>
                </table>
            </div>

            <!-- 예약자 정보 모바일 -->

            <div class="invoice_table invoice_table_new only_mo">
                <h2>오는 편</h2>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                    </colgroup>
                    <tbody>

                    <tr>
                        <td class="subject">항공편 명</td>
                        <td class="content">
                            <?= $order_cars_detail[1]["air_code"] ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">항공 도착 날짜</td>

                        <td class="content">
                            <?=$order_cars_detail[1]["date_trip"]?>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">항공 도착 시간</td>
                        <td class="content">
                            <?=$order_cars_detail[1]["hours"]?> 시 <?=$order_cars_detail[1]["minutes"]?> 분
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">미팅 장소</td>
                        <td class="content">
                            <?=$order_cars_detail[1]["departure_name"]?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">기타요철</td>
                        <td class="content">
                            <?=nl2br($order_cars_detail[1]["order_memo"])?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php
            }
        ?>
        <?php
            }else if($code_no_first == "5402"){
        ?>
            <div class="invoice_table invoice_table_new only_web">
                <h2>예약 정보</h2>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="subject">항공편 명</td>
                        <td col width="15%" class="subject">항공 도착 날짜</td>
                        <td col width="8%" class="subject">항공 도착 시간</td>
                        <td col width="20%" class="subject">미팅 장소</td>
                        <td col width="*%" class="subject">기타요철</td>
                    </tr>
                    <?php
                        foreach($order_cars_detail as $row){
                    ?>
                    <tr>
                        <td col width="8%" class="content">
                            <?= $row["air_code"] ?>
                        </td>

                        <td class="content">
                            <?=$row["date_trip"]?>
                        </td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>

                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>

                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="invoice_table invoice_table_new only_mo">
                <h2>예약 정보</h2>
                <?php
                    foreach($order_cars_detail as $row){
                ?>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                    </colgroup>
                    <tbody>

                    <tr>
                        <td class="subject">항공편 명</td>
                        <td class="content">
                            <?= $row["air_code"] ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">항공 도착 날짜</td>

                        <td class="content">
                            <?=$row["date_trip"]?>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">항공 도착 시간</td>
                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">목적지</td>
                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">기타요철</td>
                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php
                    }
                ?>
            </div>
        <?php
            }else if($code_no_first == "5403"){
        ?>
            <div class="invoice_table invoice_table_new only_web">
                <h2>예약 정보</h2>
                <table>
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="subject">항공 도착 날짜</td>
                        <td col width="8%" class="subject">항공 도착 시간</td>
                        <td col width="20%" class="subject">출발지</td>
                        <td col width="30%" class="subject">이동루트</td>
                        <td col width="*%" class="subject">기타요철</td>
                    </tr>
                    <?php
                        foreach($order_cars_detail as $row){
                    ?>
                    <tr>
                        <td col width="8%" class="content">
                            <?=$row["date_trip"]?>
                        </td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>

                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>

                        <td class="content">
                            <?=nl2br($row["schedule_content"])?>
                        </td>

                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="invoice_table invoice_table_new only_mo">
                <h2>예약 정보</h2>
                <?php
                    foreach($order_cars_detail as $row){
                ?>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                    </colgroup>
                    <tbody>

                    <tr>
                        <td class="subject">항공 도착 날짜</td>
                        <td class="content">
                            <?=$row["date_trip"]?>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">항공 도착 시간</td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">목적지</td>
                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">이동루트</td>
                        <td class="content">
                            <?=nl2br($row["schedule_content"])?>    
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">기타요철</td>
                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php
                    }
                ?>
            </div>

        <?php
            }else if($code_no_first == "5404"){
        ?>
            <div class="invoice_table invoice_table_new only_web">
                <h2>예약 정보</h2>
                <table>
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="subject">항공 도착 날짜</td>
                        <td col width="8%" class="subject">항공 도착 시간</td>
                        <td col width="15%" class="subject">출발지(픽업호텔)</td>
                        <td col width="15%" class="subject">경유지</td>
                        <td col width="15%" class="subject">목적지</td>
                        <td col width="*%" class="subject">기타요철</td>
                    </tr>
                    <?php
                        foreach($order_cars_detail as $row){
                    ?>
                    <tr>
                        <td col width="8%" class="content">
                            <?=$row["date_trip"]?>
                        </td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>

                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>

                        <td class="content">
                            <?=$row["rest_name"]?>
                        </td>

                        <td class="content">
                            <?=$row["destination_name"]?>
                        </td>

                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="invoice_table invoice_table_new only_mo">
                <h2>예약 정보</h2>
                <?php
                    foreach($order_cars_detail as $row){
                ?>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                    </colgroup>
                    <tbody>

                    <tr>
                        <td class="subject">항공 도착 날짜</td>
                        <td class="content">
                            <?=$row["date_trip"]?>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">항공 도착 시간</td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">목적지</td>
                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">목적지</td>
                        <td class="content">
                            <?=$row["destination_name"]?>    
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">기타요철</td>
                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php
                    }
                ?>
            </div>
        <?php
            }else if($code_no_first == "5405"){
        ?>
            <div class="invoice_table invoice_table_new only_web">
                <h2>예약 정보</h2>
                <table>
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="subject">항공 도착 날짜</td>
                        <td col width="8%" class="subject">항공 도착 시간</td>
                        <td col width="15%" class="subject">출발지(픽업호텔)</td>
                        <td col width="15%" class="subject">목적지</td>
                        <td col width="15%" class="subject">기타요철</td>
                    </tr>
                    <?php
                        foreach($order_cars_detail as $row){
                    ?>
                    <tr>
                        <td col width="8%" class="content">
                            <?=$row["date_trip"]?>
                        </td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>

                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>

                        <td class="content">
                            <?=$row["destination_name"]?>
                        </td>

                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="invoice_table invoice_table_new only_mo">
                <h2>예약 정보</h2>
                <?php
                    foreach($order_cars_detail as $row){
                ?>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                    </colgroup>
                    <tbody>

                    <tr>
                        <td class="subject">항공 도착 날짜</td>
                        <td class="content">
                            <?=$row["date_trip"]?>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">항공 도착 시간</td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">목적지</td>
                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">목적지</td>
                        <td class="content">
                            <?=$row["destination_name"]?>    
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">기타요철</td>
                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php
                    }
                ?>
            </div>
        <?php
            }else{
        ?>
            <div class="invoice_table invoice_table_new only_web">
                <h2>예약 정보</h2>
                <table>
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="subject">항공 도착 날짜</td>
                        <td col width="8%" class="subject">항공 도착 시간</td>
                        <td col width="15%" class="subject">출발지(픽업호텔)</td>
                        <td col width="15%" class="subject">목적지(골프장명)</td>
                        <td col width="*%" class="subject">기타요철</td>
                    </tr>
                    <?php
                        foreach($order_cars_detail as $row){
                    ?>
                    <tr>
                        <td col width="8%" class="content">
                            <?=$row["date_trip"]?>
                        </td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>

                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>

                        <td class="content">
                            <?=$row["destination_name"]?>
                        </td>

                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="invoice_table invoice_table_new only_mo">
                <h2>예약 정보</h2>
                <?php
                    foreach($order_cars_detail as $row){
                ?>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                    </colgroup>
                    <tbody>

                    <tr>
                        <td class="subject">항공 도착 날짜</td>
                        <td class="content">
                            <?=$row["date_trip"]?>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">항공 도착 시간</td>

                        <td class="content">
                            <?=$row["hours"]?> 시 <?=$row["minutes"]?> 분
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">출발지(픽업호텔)</td>
                        <td class="content">
                            <?=$row["departure_name"]?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">목적지(골프장명)</td>
                        <td class="content">
                            <?=$row["destination_name"]?>    
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">기타요철</td>
                        <td class="content">
                            <?=nl2br($row["order_memo"])?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php
                    }
                ?>
            </div>
        <?php
            }
        ?>

        <section class="earn_pops my_pops" style="display:none;">
            <div class="pay_pops_inner pay_count02" style="display:none;">
                <div class="pay_h">
                    <h2>무통장입금</h2>
                </div><!-- pay_h -->
                <div class="account">
                    <h3>국민은행 예금주(주식회사 블루스카이투어) <br>535501-04-141688</h3>
                    <p>
                        김철수님! 무통장입금을 신청하셨습니다. <br>
                        입금후 담당자에게 연락부탁드립니다. <br>
                        감사합니다.
                    </p>
                </div>
                <div class="pay_pop_btn">
                    <a href="#!" class="btn pops_btn cancel close_btn">닫기</a>
                </div>
            </div><!-- pay_pops_inner  --> <!-- 무통장입금 팝업 종료 -->
        </section>

        <div class="invoice_comment">
            <div class="invoice_comment-top">
                <div class="invoice_comment-count">
                    <span>댓글</span>
                    <span id="comment_count">(0)</span>
                </div>
                <form action="" id="frm" class="frm" name="com_form">
                    <input type="hidden" name="code" id="code" value="order">
                    <input type="hidden" name="r_code" id="r_code" value="order">
                    <input type="hidden" name="r_idx" id="r_idx" value="<?= $order_idx ?>">
                    <div class="invoice_comment-input">
                        <textarea style="resize:none" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
                        <button type="button" onclick="fn_comment(<?= session('member.idx') ?>)">등록</button>
                    </div>
                </form>
            </div>
            <div class="invoice_comment-details" id="comment_list">
                <?php
                    $r_code = "order";
                    $r_idx = $order_idx;
                ?>
            </div>
        </div>

        <div class="invoice_button">
            <button onclick="go_list('<?= $pg ?>');">목록으로</button>
        </div>
    </div>
</section>
<div class="modal_common img_pop">
    <div class="pop_item">
        <div class="pop_top">
            <button type="button" class="btn_close no_txt" onclick="PopCloseBtn('.img_pop')">
                닫기
            </button>
        </div>
        <div class="pop_content">
            <img style="margin:auto;max-height: 100%;" id="img_showing" src="" alt="">
        </div>
    </div>
    <div class="pop_dim" onclick="PopCloseBtn('.img_pop')"></div>
</div>
<?php

    $_paymod = "nicepay";

    if ($_paymod == "lg") {
        if (device_chk() == "MO") {
            $urlStr = "travel_cash.m.inc_bak_LG.php";
        } else {
            $urlStr = "travel_cash.inc_bak_LG.php";
        }
    } else if ($_paymod == "nicepay") {
        if (device_chk() == "MO") {
            $urlStr = "travel_cash.m.inc_nicepay.php";
        } else {
            $urlStr = "travel_cash.inc_nicepay.php";
        }
    } else if ($_paymod == "ini") {
        if (device_chk() == "MO") {
            $urlStr = "travel_cash.m.inc.php";
        } else {
            $urlStr = "travel_cash.inc.php";
        }
    }
?>

<form id="checkOut" action="/checkout/show" method="post">
<input type="hidden" name="dataValue" id="dataValue" value="" >
</form>

<style>
.my-button {
    background-color: #007BFF; /* Button background color */
    color: white; /* Text color */
    border: none; /* Remove border */
    padding: 10px 20px; /* Add padding */
    font-size: 16px; /* Text size */
    font-weight: bold; /* Text weight */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth hover effect */
}
</style>

<script>
$(document).ready(function() {
    $('#deposit').click(function() {
		$("#dataValue").val($(this).val());
	    $("#checkOut").submit();
    });
});
</script>

<script type="text/javascript">
    function handlleShowPassport(img) {
        $("#img_showing").attr("src", img);
        $(".img_pop").show();
    }

    $(document).ready(function () {
        //못알창

        $('.btn_cash').click(function () {

            $.ajax({
                url: "<?= $urlStr ?>",
                type: "POST",
                data: "order_idx=" + $(this).attr("data_order_idx") + "&order_gubun=" + $(this).attr("data_order_gubun"),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                },
                success: function (response, status, request) {
                    $(".earn_pops").html(response);
                    $('.my_pops').fadeIn('fast');
                }
            });

        });
        //faq
        $('.faq_box ul li h5 a').click(function () {
            $(this).parent().next('.faq_text').slideToggle();
        });
    });

    function pay_btn() { // 결제하기 작동버튼 임시 작성
        $(".pay_count01").hide();
        $(".pay_count02").fadeIn();
    }

    function search_it() {
        var frm = document.search;
        frm.submit();
    }
</script>

<script>
    $('.show_popup').on('click', function () {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function () {
        $(".popup_wrap").hide();
    });
</script>

<script>
    function go_list(pg) {
        location.href = '/mypage/details?pg=' + pg
    }

    $(".change_passport").change(function (evt) {
        if (evt.target.files?.[0]) {
            if (confirm("정말 업로드하시겠습니까?")) {
                const formData = new FormData();
                formData.append("passport_file", evt.target.files[0]);
                formData.append("gl_idx", $(evt.target).data("gl_idx"))
                $.ajax({
                    type: "POST",
                    url: "./ajax.change_passport_file.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response, textStatus, jqXHR) {
                        if (response.trim() == "OK") {
                            alert("등록되었습니다");
                            location.reload();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.table(jqXHR)
                    }
                });
            }
            evt.target.value = "";
        }
    })

    function handlleDelPassport(gl_idx) {
        if (confirm("정말 삭제하시겠습니까?")) {
            const formData = new FormData();
            formData.append("gl_idx", gl_idx);
            formData.append("del_it", "Y");
            $.ajax({
                type: "POST",
                url: "./ajax.change_passport_file.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response, textStatus, jqXHR) {
                    if (response.trim() == "OK") {
                        alert("삭제되었습니다");
                        location.reload();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.table(jqXHR)
                }
            });
        }
    }
</script>
<script>
    const r_code = "order";
    const r_idx = "<?= $order_idx ?>";
</script>
<script src="/js/comment.js"></script>
<?php $this->endSection(); ?>
