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
            padding: 20px 0 0 !important;
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
            padding-left: 0;
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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

        .golf_invoice .info_order_txt {
            margin: 10px 0 0 !important;
        }

        #container_voice *{
            font-family: "Pretendard" !important;
            line-height: 1.4 !important;
        }

        .golf_invoice .logo_voice {
            display: flex;
            justify-content: space-between;
            padding-bottom: 20px;
            border-bottom: 6px solid #1e73e7;
        }

        .golf_invoice .logo_voice img {
            width: 165px !important ;
            /* height: 76px; */
        }

        .golf_invoice .logo_voice h2 {
            font-size: 45px;
            margin-bottom: 5px;
            margin-top: 18%;
        }

        .golf_invoice .logo_voice .addr {
            font-size: 14px;
            color: #616161;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="container_voice">
        <section class="golf_invoice voucher">
            <div class="inner">
                <div class="logo_voice">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="vertical-align: top;">
                                <img src="/uploads/setting/<?= $setting['logos']?>" alt="" style="width: 165px;">
                                <p class="addr" style="margin-top: 10px;">
                                    <?= viewSQ(nl2br($setting['addr_thai']))?><br>
                                    Thai - Registration No <?= $setting['comnum_thai']?><br>
                                    Tel: <?= $setting['custom_service_phone_thai2']?>
                                </p>
                            </td>
                            <td style="text-align: right; vertical-align: middle;">
                                <h2 class="tit_top" style="margin: 0; font-size: 30px;">견적서</h2>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="invoice_ttl">
                </div>
                <div class="invoice_table">
                    <table class="invoice_tbl" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <th style="width: 150px">Name</th>
                                <td style="font-weight: 700;"><?=$result->product_name_en?></td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Address</th>
                                <td style="font-family: 'Pretendard' !important;"><?=$result->stay_address?></td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Tel</th>
                                <td><?=$result->tel_no?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="top_flex flex_b_c">
                        <h2 class="tit_top">Guest Information</h2>
                    </div>
                    <table class="invoice_tbl" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <th style="width: 150px">Name</th>
                                <td><?=$user_name?></td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Phone</th>
                                <td><?=$user_mobile?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h2 class="tit_top">Booking details</h2>
                    <table class="invoice_tbl" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <th style="width: 150px">Booking No</th>
                                <td colspan="3"><?=$result->order_no?></td>

                            </tr>
                            <tr>
                                <th style="width: 150px">Date</th>
                                <td style="color : red" colspan="3">
                                   <?=$order_date?>
                                </td>

                            </tr>
                            <tr>
                                <th style="width: 150px">Room Type</th>
                                <td><?=$room_type?></td>
                                <th style="width: 150px">Bed Type</th>
                                <td><?=$bed_type?></td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Guest Name</th>
                                <td><?=$user_name_en?></td>
                                <th style="width: 150px">Number of rooms</th>
                                <td><?=$order_room_cnt?></td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Total Adult</th>
                                <td><?=$order_adult?> </td>
                                <th style="width: 150px">Total Child</th>
                                <td><?=$order_child?></td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Breakfast</th>
                                <td colspan="3">
                                    <?php
                                        echo $breakfast;
                                    ?>
                                </td>

                            </tr>
                            <tr>
                                <th style="width: 150px">Guest Request</th>
                                <td colspan="3">
                                    <?=$guest_request?>
                                </td>

                            </tr>
                            <tr>
                                <th style="width: 150px">Agent Memo</th>
                                <td colspan="3"><?=$order_memo?></td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Remarks</th>
                                <td colspan="3">
                                    <?=$order_remark?>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>Option</th>
                                <td colspan="3">
                                    <?=$order_option?>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                    <br>
                    <div class="info_order_txt">
                        <p style="font-weight: bold;">• Booked by: <?= $setting['site_name_en'] ?></p>
                        <!-- <p>• Booked on: 27-Sep-2023(Wed)</p> -->
                    </div>
                    <div class="invoice_note_" style="font-family: 'Pretendard' !important; line-height: 1.6 !important; font-size: 16px !important;">
                        <p  style="display: flex; align-items: center; margin-bottom: 13px;"><img style="opacity: 0.7; width: 18px;" src="/images/sub/warning-icon.png" alt="">
                        <span style="box-sizing: border-box; color: inherit; font-size: 12px;">&nbsp;</span>
                        <span style="padding-left: 30px; padding-bottom: 10px; font-size: 18px; font-weight: 600;">참고사항</span></p>
                        <?= viewSQ($policy["policy_contents"]) ?>
                    </div>
                </div>
                <div class="inquiry_qna">
                    <p class="ttl_qna">본 메일은 발신전용 메일입니다. 문의 사항은 <span>Q&A</span>를 이용해 주시기 바랍니다.</p>
                    <div class="inquiry_info">
                        <p>태국 사업자번호 <?= $setting['comnum_thai']?> | 태국에서 걸 때 <?= $setting['custom_service_phone_thai']?>
                            (방콕) 로밍폰, 태국 유심폰 모두 <?= $setting['custom_service_phone_thai2']?> 
                            번호만 누르면 됩니다. 
                            <br>
                            이메일 : <?= $setting['qna_email']?>
                            <br>
                            주소 : </p>
                        <p>한국 사업자번호 <?= $setting['comnum']?> | <?= $setting['addr1']?>, <?= $setting['addr2']?></p>
                    </div>
                    <div class="note_qna">
                        <?=nl2br($setting['desc_cont'])?>
                    </div>
                </div>
            </div>
        </section>
        <?php
            if($result->order_status == "C" || $result->order_status == "N"){
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