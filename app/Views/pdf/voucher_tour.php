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
            font-size: 18px ;
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
                                <td style="font-weight: bold;">Phi Phi-Khai-Pileh by Speed boat [Seastar]</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>112/151 Udomsuk Village, Paklok, Thalang, Phuket 83110 Thailand</td>
                            </tr>
                            <tr>
                                <th>Tel</th>
                                <td>+66-(66) 076-350-144</td>
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
                                <td>YANG HYUNGSUK</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>KR 01021004474</td>
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
                                <td colspan="3">144-395-444 (1)</td>

                            </tr>
                            <tr>
                                <th>Date</th>
                                <td colspan="3"><span style="color:red;">29-Sep-2023(Fri)</span></td>

                            </tr>
                            <tr>
                                <th>Type</th>
                                <td colspan="3">Phi Phi-Khal-Pileh by Speed boat [Seastar]</td>
                            </tr>
                            <tr>
                                <th>Persons</th>
                                <td>4 Adult(s)</td>
                                <th>Time</th>
                                <td>07:30~17:00</td>
                            </tr>
                            <tr>
                                <th>Pick up Place</th>
                                <td>Avani+ Mai Khao Phuket Suites & Villas</td>
                                <th>Pick up Time</th>
                                <td style="color: #252525; font-weight: bold;">7.00 - 7.15</td>
                            </tr>
                            <tr>
                                <th>Kakao Id</th>
                                <td>nickhwan</td>
                                
                            </tr>
                            <tr>
                                <th>Remarks</th>
                                <td colspan="3">
                                    <p>이 투어는 호텔 픽업이 포함되어 있어요.</p>
                                    <p>조인 픽업이라 앞팀이 늦어질 경우 픽업 시간 보다 조금 더 늦어 질수 있어</p>
                                    <p>원활한 픽업을 위해 정해진 시간에 꼭 호텔 로비에서 기다려주세요!</p>
                                    <p>빠톰, 카타카론 비치를 제외한 나머지 곳들은 추가 비용이 발생합니다. 지역별 추가요금은 홈페이지 를 참고해주세요.</p>
                                </td>

                            </tr>
                            <tr>
                                <th>Exclude</th>
                                <td colspan="3">
                                    <p>주류, 개인경비</p>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="info_order_txt">
                        <p style="font-weight: bold">• Booked by: Totobooking</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>