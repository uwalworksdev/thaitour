<?php
helper('setting_helper');
$setting = homeSetInfo();
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <style>
        .invoice_cancle img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

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
            padding: 20px 0 0;
        }

        .golf_invoice .logo_voice {
            padding-bottom: 20px;
            border-bottom: 6px solid #1e73e7;
        }

        .golf_invoice .logo_voice img {
            width: 165px;
        }

        .golf_invoice .invoice_ttl {
            margin: 20px 0;
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
            border: 5px solid #eee;
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
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 600;
            color: #252525;
            margin-top: 20px;
        }

        .golf_invoice.voucher .invoice_table .tit_top {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 600;
            color: #7d7d7d;
            margin-top: 20px;
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

        .golf_invoice .invoice_note p+p {
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

        table.spe {
            font-size: 14px !important;
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

        .golf_invoice.voucher .invoice_table .tit_top {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 600;
            color: #7d7d7d;
            margin-top: 20px;
        }

        .golf_invoice .box_notifi {
            border: 3px solid #ff6a00;
            padding: 30px 10px 20px;
            text-align: center;
            gap: 5px;
            margin-top: -20px;
        }

        .golf_invoice .box_notifi .tit {
            font-size: 18px;
            color: #ff6a00;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .golf_invoice .box_notifi .desc {
            background-color: #f4f4f4;
            width: 100%;
            text-align: center;
            padding: 9px;
            color: #7d7d7d;
        }

        .golf_invoice .info_order_txt {
            margin: 10px 0 0 !important;
        }

        #container_voice * {
            font-family: "Pretendard" !important;
            line-height: 1.4 !important;
        }
    </style>
</head>

<body>
    <div id="container_voice">
        <section class="golf_invoice voucher">
            <div class="inner">
                <div class="logo_voice">
                    <img src="<?= FCPATH . 'uploads/setting/' . $setting['logos'] ?>" alt="">
                </div>
                <div class="invoice_ttl">
                </div>
                <div class="invoice_table">
                    <table class="invoice_tbl">
                        <colgroup>
                            <col width="150px">
                            <col width="*">

                        </colgroup>
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td style="font-weight: 700;"><?= $result->product_name_en ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?= $result->addrs ?></td>
                            </tr>
                            <tr>
                                <th>Tel</th>
                                <td><?= $result->tel_no ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="top_flex flex_b_c">
                        <h2 class="tit_top">Guest Information</h2>
                    </div>
                    <table class="invoice_tbl">
                        <colgroup>
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td><?= $user_name ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?= $user_mobile ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h2 class="tit_top">Booking details</h2>
                    <table class="invoice_tbl">
                        <colgroup>
                            <col width="150px">
                            <col width="35%">
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>Booking No</th>
                                <td colspan="3"><?= $result->order_no ?></td>

                            </tr>
                            <tr>
                                <th>Date</th>
                                <td style="color : red" colspan="3">
                                    <p><?= $order_date ?></p>
                                </td>

                            </tr>
                            <tr>
                                <th>Persons</th>
                                <td colspan="3"><?= $order_people ?></td>
                            </tr>
                            <tr>
                                <th>T-off Time</th>
                                <td><?= $order_tee_time ?></td>
                                <th>Hole</th>
                                <td><?= $order_hole ?></td>
                            </tr>

                            <tr>
                                <th>Fee</th>
                                <td colspan="3">
                                    <p><?= $order_fee ?></p>
                                </td>

                            </tr>
                            <tr>
                                <th>Agent Memo</th>
                                <td colspan="3">
                                    <?= $order_memo ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Remarks</th>
                                <td colspan="3">
                                    <?= $order_remark ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Option</th>
                                <td colspan="3">
                                    <?php
                                    if (!empty($result->order_option_new)) {
                                        echo $result->order_option_new;
                                    } else {
                                    ?>
                                        <?php foreach ($option as $key => $item): ?>
                                            <?= $item['option_name'] ?> x <?= $item['option_cnt'] ?>대 =
                                            금액 (<?= number_format($item['option_tot']) ?>원) / (<?= number_format($item['option_tot'] / $item['baht_thai']) ?>TH)</span>
                                            <?= $key == count($option) - 1 ? "" : "<br>" ?>
                                        <?php endforeach; ?>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="info_order_txt" style="margin-bottom: 10pt;">
                        <p style="font-weight: bold">• Booked by: <?= $setting['site_name_en'] ?></p>
                    </div>
                    <br>

                    <div class="box_notifi">
                        <?= viewSQ($policy_1["policy_contents"]) ?>
                    </div>

                    <div class="invoice_note_">
                        <p style="display: flex; align-items: center; margin-bottom: 13px;"><img style="opacity: 0.7; width : 20px;" src="<?= FCPATH . '/images/sub/warning-icon.png' ?>" alt=""><span style="margin-left: 10px;  font-size: 20px; font-weight: 600;">참고사항</span></p>
                        <p style="color: #eb4848;"><span>-</span><span>This voucher can be shown as captured picture with mobile phone.</span></p>
                        <p><span>-</span><span>티오프 시간이 날짜로 표시된 경우 해당날짜에 티오프 시간 확정하여 바우처 재발송해드립니다.</span></p>
                        <p><span>-</span><span>티오프 시간 확정전까지는 확정된 예약이 아니므로 예약이 불가능할 수도 있습니다.</span></p>
                        <p><span>-</span><span>이 바우처를 골프장 프론트에 제시한 후 해당 상품을 이용해 주세요. 단, 다른 연락처가 기재된 경우에는 그 곳과 통화하셔서 도움받으세요.</span></p>
                        <p><span>-</span><span>우천으로 라운딩을 중단해야 할 경우, 태국 골프장은 환불이 매우 어려우므로 반드시 위 연락처 또는 여행사에 연락한 뒤 중단여부를 결정하셔야 합니다.</span></p>
                        <p><span>-</span><span>1,2인 라운딩은 당일 골프장 예약현황에 따라 조인될 수도 있습니다. 특히 성수기 때에는 대부분 조인됩니다. 따라서 티오프 시각을 받으셨어도 조인될 때까지 기다리실 수도 있습니다.</span></p>
                        <p><span>-</span><span>골프장 내에서 다치거나, 동물이나 곤충에 의한 피해를 골프장에서 보상해주지 않으므로 라운딩 시 주의해주세요.</span></p>
                        <p><span>-</span><span>예약에 문제가 발생하거나 추가 예약이 필요하시면 다음 비상연락처로 연락주세요. 신속히 조치해 드리겠습니다. +66(0)80-709-0500 (KOREAN ONLY!!국제전화요금/취침시간에는 긴급건 ONLY)</span></p>

                    </div>
                </div>
                <div class="inquiry_qna">
                    <p class="ttl_qna">본 메일은 발신전용 메일입니다. 문의 사항은 <span>Q&A</span>를 이용해 주시기 바랍니다.</p>
                    <div class="inquiry_info">
                        <p>태국 사업자번호 <?= $setting['comnum_thai'] ?> | 태국에서 걸 때 <?= $setting['custom_service_phone_thai'] ?>
                            (방콕) 로밍폰, 태국 유심폰 모두 <?= $setting['custom_service_phone_thai2'] ?>
                            번호만 누르면 됩니다.
                            <br>
                            이메일 : <?= $setting['qna_email'] ?>
                            <br>
                            주소 :
                        </p>
                        <p>한국 사업자번호 <?= $setting['comnum'] ?> | <?= $setting['addr1'] ?>, <?= $setting['addr2'] ?></p>
                    </div>
                    <div class="note_qna">
                        <?= nl2br($setting['desc_cont']) ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        if ($result->order_status == "C" || $result->order_status == "N") {
        ?>
            <div class="invoice_cancle">
                <img src="/images/invoice/image-removebg-preview.png" alt="img_cancle">
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>