<?php
    helper('setting_helper');
    $setting = homeSetInfo();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <style>
        .ml-20 {
            margin-left: 20px !important;
        }

        .ml-40 {
            margin-left: 40px !important;
        }

        p {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .golf_invoice {
            padding: 20px 0 100px;
        }

        .golf_invoice .logo_voice {
            padding-bottom: 20px;
            border-bottom: 6px solid #1e73e7;
        }

        .golf_invoice .logo_voice img {
            width: 165px;
            /* height: 76px; */
        }

        .golf_invoice .invoice_ttl {
            margin: 20px 0 !important;
            text-align: center;
        }

        .golf_invoice .invoice_ttl p {
            font-size: 20px;
            color: #000;
            text-align: center;
            line-height: 1.4;
            margin: 0 0 15px;
            font-weight: bold;
        }

        .golf_invoice .invoice_ttl span {
            font-size: 18px;
            text-align: center;
            display: block;
            line-height: 1.5;
            color: #333;
        }

        .golf_invoice .invoice_table {
            padding: 20px 13px;
            border:5px solid #eee;
            margin-bottom: 30px;
        }

        .golf_invoice .invoice_table .top_flex {
            margin: 20px 0 10px;
        }

        .golf_invoice .invoice_table .top_flex .tit_top {
            margin: 0;
        }

        .golf_invoice .invoice_table .top_flex span {
            font-size: 14px;
            color: #ef4337;
        }
        
        .golf_invoice .tit_top {
            margin-bottom: 10px !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            color: #252525 !important;
            margin-top: 20px !important;
        }

        .golf_invoice.voucher .invoice_table .tit_top {
            margin-bottom: 10px !important;
            font-size: 20px !important;
            font-weight: 600 !important;
            color: #7d7d7d !important;
            margin-top: 20px !important;
        }

        .golf_invoice .invoice_table .invoice_tbl {
            width: 100%;
        }

        .golf_invoice .invoice_table .invoice_tbl tr {
            max-height: 50px;
        }

        .golf_invoice .invoice_table .invoice_tbl.spe {
            margin-top: 20px;
        }

        .golf_invoice .invoice_table .invoice_tbl.spe tr th {
            font-weight: bold;
        }

        .golf_invoice .invoice_table .invoice_tbl tr th {
            font-weight: 400;
            color: #333;
            font-size: 14px !important;
            padding: 5px 10px;
            background-color: #f4f4f4;
            border-top: 1px solid #dddddd;
            border-bottom: 1px solid #dddddd;
            text-align: left;
        }

        .golf_invoice .invoice_table .invoice_tbl tr td {
            height: 35px !important;
            border: 1px solid #dddddd;
            border-right: unset;
            border-left: unset;
            padding: 10px;
            font-size: 14px !important;
            line-height: 1.4;
            color: #7d7d7d;
            text-align: left;
            letter-spacing: -0.2px;
        }

        .golf_invoice .invoice_golf_total {
            padding: 10px;
            background-color: #f6f6f6;
            margin-top: 30px;
        }

        .golf_invoice .invoice_golf_total p {
            font-size: 14px;
            line-height: 1.4;
        }

        .golf_invoice .invoice_golf_total p span {
            color: #17469E;
            font-weight: 700;
        }

        .golf_invoice .cancle_txt {
            margin: 15px 0 25px;
            font-size: 12px;
            font-weight: 400;
            color: #252525;
        }

        .golf_invoice .cancle_txt span {
            color: #ef4337;
        }

        .golf_invoice .btn_wrap_member .invoice_member {
            padding: 15px 30px;
            color: #fff;
            background: #17469E;
            display: inline-block;
            outline: none;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            border: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .golf_invoice .invoice_note {
            margin: 30px 0 15px;
        }

        .golf_invoice .invoice_note_ {
            margin: 30px 0 15px;
        }

        .golf_invoice .invoice_note_ p {
            font-size: 16px;
            font-weight: 500;
            color: #7d7d7d;
            line-height: 1.3;
            display: flex;
            gap: 3px;
            line-height: 1.3;
        }

        .golf_invoice .invoice_note p {
            font-size: 16px;
            font-weight: 500;
            color: #252525;
            line-height: 1.3;
        }

        .golf_invoice .invoice_note p + p {
            margin-top: 6px;
        }

        .golf_invoice .invoice_info {
            padding: 15px;
            background-color: #eee;
        }

        .golf_invoice .invoice_info h2 {
            font-size: 16px;
            font-weight: 700;
            color: #252525;
            margin-bottom: 10px;
        }

        .golf_invoice .invoice_info .txt p {
            font-size: 14px;
            line-height: 1.4;
            color: #252525;
        }

        .golf_invoice .invoice_info a {
            padding: 5px;
            background-color: #f3fffe;
            border: 1px solid #2ab6ad;
            color: #2ab6ad;
            font-size: 14px;
            margin: 5px 0;
            display: inline-block;
        }

        .golf_invoice .tit_note {
            margin-top: 20px;
            font-size: 14px;
            line-height: 1.4;
            color: #252525;
        }

        .golf_invoice .inquiry_qna {
            padding-top: 30px;
            border-top: 2px solid #333;
        }

        .golf_invoice .inquiry_qna .ttl_qna {
            font-size: 18px;
            font-weight: 700;
            color: #252525;
            line-height: 1.3;
        }

        .golf_invoice .inquiry_qna .ttl_qna span {
            color: #ef4337;
        }

        .golf_invoice .inquiry_qna .inquiry_info {
            margin: 20px 0 10px;
            padding-left: 50px;
        }

        .golf_invoice .inquiry_qna .inquiry_info p {
            font-size: 14px;
            color: #252525;
            font-weight: 500;
            line-height: 1.3;
        }

        .golf_invoice .invoice_table {
            padding: 0 !important;
            border: none !important;
        }

        table {
            border-collapse: collapse !important;
        }

        .golf_invoice .invoice_golf_total {
            text-align: right !important;
        }

        .table_custom {
            border-collapse: collapse !important;
            width: 100%;
            font-size: 14px;
            table-layout: fixed;
        }

        .table_custom tr td {
            border: none !important;
            padding-bottom: 0 !important;
            padding-left: 0 !important;
            padding-right: 5px !important;
        }

        .table_custom tr td:first-child {
            padding-top: 0 !important;
        }

        .hotel_invoice .row_ttl {
            font-weight: bold !important;
            font-size: 15px !important;
            margin-bottom: 4px !important;
            margin-top: 7px !important;
            color: #454545 !important;
        }
        
    </style>
</head>

<?php foreach ($result as $row): ?>
      <?php foreach ($row->options as $option): ?>
      <?php endforeach; ?>
<?php endforeach; ?>

<div id="container_voice">
    <section class="golf_invoice hotel_invoice">
        <div class="inner">
            <div class="logo_voice">
                <img src="<?= FCPATH . 'uploads/setting/' . $setting['logos'] ?>" alt="">
            </div>
            <div class="invoice_ttl">
            </div>
            <div class="invoice_table">
                <h2 class="tit_top">예약자정보</h2>
                <table class="invoice_tbl">
                    <colgroup>
                        <col width="150px">
                        <col width="35%">
                        <col width="150px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>예약번호</th>
                            <td><?=$row->order_no?></td>
                            <th>예약날짜</th>
                            <td><?=substr($row->order_date,0,10)?>(<?=dateToYoil(substr($row->order_date,0,10))?>)</td>
                        </tr>
                        <tr>
                            <th>여행사(담당자)</th>
                            <td>Pattaya Adventure Co.,Ltd. (파타야 어드벤처 투어)</td>
                            <th>이메일</th>
                            <td><?=$row->order_user_email?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="top_flex flex_b_c">
                    <h2 class="tit_top">예약내역</h2>
                </div>
                <table class="invoice_tbl">
                    <colgroup>
                        <col width="150px">
                        <col width="35%">
                        <col width="150px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>상품명</th>
                            <td colspan="3"><?=$row->product_name?></td>
                        </tr>
                        <tr>
                            <th>날짜</th>
                            <td><?= $option->option_date ?>(<?=dateToYoil($option->option_date)?>)</td>
                            <th>여행자 이름</th>
                            <td><?=$row->order_user_name?></td>
                        </tr>
                        <tr>
                            <th>고객 연락처</th>
                            <td><?=$row->order_user_mobile?></td>
                            <th>고객 이메일</th>
                            <td><?=$row->order_user_email?></td>
                        </tr>
                        <tr>
                            <th>예약 선택상품</th>
                            <td colspan="3"><?=$option->option_name?></td>
                        </tr>
                        <tr>
                            <th>예약시간</th>
                            <td><?=$row->order_day?>(<?=dateToYoil($row->order_day)?>) <?=$row->time_line?></td>
                            <th>총인원</th>
                            <td>성인 : <?= $row->people_adult_cnt ?>명 / 아동 : <?= $row->people_kids_cnt ?>명</td>
                        </tr>
                        <tr>
                            <th>픽업포함여부</th>
                            <td>불포함</td>
                            <th>미팅 장소</th>
                            <td>개별이동</td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="tit_top">금액내역</h2>
                <table class="invoice_tbl">
                    <colgroup>
                        <col width="150px">
                        <col width="35%">
                        <col width="150px">
                        <col width="*">
                    </colgroup>
                    <tbody>
					    <?php 
						      $person_cnt = 0;
						      $order_amt  = 0;
						      foreach ($row->options as $option) 
							  { 
						?>
                        <tr>
                            <th>1인당 금액</th>
                            <td colspan="3"><?=$option->option_name?>: <?=number_format($option->option_tot / $option->option_qty)?>바트</td>
                        </tr>
                        <tr>
                            <th>금액</th>
                            <td colspan = "3"><?=number_format($option->option_tot)?>원 (<?=$option->option_qty?>명)</td>
                        </tr>
                        <?php 
							  } 
						?>
                        
						<tr>
                            <th>추가내역</th>
                            <td>0바트</td>
                            <th>총금액</th>
                            <td><?= number_format($row->order_price) ?>원 <?= number_format($row->order_price / $row->baht_thai) ?>바트</td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice_golf_total flex_e_c">
                    <p>총 견적서 금액 : <span><?= number_format($row->order_price) ?>원</span> (<?= number_format($row->order_price / $row->baht_thai) ?>바트)</p>
                </div>
                <table class="invoice_tbl spe">
                    <colgroup>
                        <col width="250px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>중요안내</th>
                            <td>상품등록 페이지에서 중요안내 연동해주세요</td>
                        </tr>
                    </tbody>
                </table>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <tr>
                        <td style="width: 20px; vertical-align: top;">
                            <img style="width: 18px; opacity: 0.7;" src="<?= FCPATH . '/images/sub/forbidden-sign-icon.png' ?>" alt="">
                        </td>
                        <td style="padding-left: 5px;">
                            <span style="color: #7d7d7d; font-size: 14px;">
                                취소 규정: 결제 후 
                                <span style="color: #17469E;">24년 12월 18일 18시(한국시간)</span> 
                                이전에 취소하시면 무료취소가 가능합니다.
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</div>
</body>
</html>
