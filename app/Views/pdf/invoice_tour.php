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
            /* padding-left: 50px; */
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

        .tit_top {
            color: red !important;
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

<?php foreach ($result as $row): ?>
<?php endforeach; ?>
<body>
    <div id="container_voice">
        <section class="golf_invoice hotel_invoice">
            <div class="inner">
                <div class="logo_voice">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="vertical-align: top;">
                                <img src="/uploads/setting/<?= $setting['logos']?>" alt="" style="width: 165px;">
                                <p class="addr" style="margin-top: 10px;">
                                    Sukhumvit 101 Bangchak Prakhanong Bangkok 10260<br>
                                    Thai - Registration No 010-5555-096-398<br>
                                    Tel: 001-66-(0)2-730-5690, 070-7010-8266
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
                    <h2 class="tit_top">예약자정보</h2>
                    <table class="invoice_tbl" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <th style="width:20%">예약번호</th>
                                <td style="width:30%"><?=$row->order_no?></td>
                                <th style="width:20%">예약날짜</th>
                                <td style="width:30%"><?= isset($row->order_r_date) ? date('Y-m-d', strtotime($row->order_r_date)) : "" ?></td>
                            </tr>
                            <tr>
                                <th style="width:20%">여행사(담당자)</th>
                                <td style="width:30%"><?=$row->order_user_name?></td>
                                <th style="width:20%">이메일</th>
                                <td style="width:30%"><?=$row->order_user_email?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="top_flex flex_b_c">
                        <h2 class="tit_top">예약내역</h2>
                    </div>
                    <table class="invoice_tbl" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <th style="width:20%">날짜</th>
                                <td style="width:30%"><?=$row->order_day?></td>
                                <th style="width:20%">여행자 이름</th>
                                <td style="width:30%"><?=$row->order_user_first_name_en?> <?=$row->order_user_last_name_en?></td>
                            </tr>
                            <tr>
                                <th style="width:20%">고객 연락처</th>
                                <td style="width:80%" colspan="3"><?=$row->order_user_mobile?></td>
                            </tr>
                            <tr>
                                <th style="width:20%">예약상품</th>
                                <td style="width:80%" colspan="3"><?=$row->product_name?></td>
                            </tr>
                            <tr>
                                <th  style="width:20%">시작시간</th>
                                <td style="width:30%"><?=$row->time_line ?? ""?></td>
                                <th  style="width:20%">총인원</th>
                                <td style="width:30%">
                                    <span style="margin-right: 10px">성인 : <?=$row->people_adult_cnt ?? 0?>명;</span>
                                    <span style="margin-right: 10px">아동 : <?=$row->people_kids_cnt ?? 0?>명;</span>
                                    <span style="margin-right: 10px">유아 : <?=$row->people_baby_cnt ?? 0?>명;</span>
                                </td>
                            </tr>
                            <tr>
                                <th style="width:20%">픽업포함여부</th>
                                <?php
                                    $have_data = true;
                                    if(empty($row->pickup_place) && empty($row->sanding_place) && empty($row->start_place)) $have_data = false;
                                ?>
                                <?php if(!$have_data):?>
                                    <td style="width:30%">불포함</td>
                                <?php else :?>
                                    <td style="width:30%">포함</td>
                                <?php endif;?>
                                <th style="width:20%">미팅 장소</th>
                                <td style="width:30%">
                                    <?php if(!empty($row->pickup_place)):?>
                                    <p>픽업장소: <?=$row->pickup_place?></p>
                                    <?php endif;?>
                                    <?php if(!empty($row->sanding_place)):?>
                                        <p>샌딩장소: <?=$row->sanding_place?></p>
                                    <?php endif;?>
                                    <?php if(!empty($row->start_place)):?>
                                        <p>미팅장소: <?=$row->start_place?></p>
                                    <?php endif;?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h2 class="tit_top" style="color: red;">금액내역</h2>
                    <table class="invoice_tbl" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <!-- <colgroup>
                            <col width=20%">
                            <col width="35%">
                            <col width=20%">
                            <col width="*">
                        </colgroup> -->
                        <tbody>
                            <!-- <tr>
                                <th>1인당 금액</th>
                                <td colspan="3">성인400바트</td>
                                
                            </tr>
                            <tr>
                                <th style="width:20%">금액</th>
                                <td style="width:80%" colspan = "3"><?=number_format($row->real_price_bath)?></td>
                                
                            </tr>
                            <tr>
                                <th>추가내역</th>
                                <td>0바트</td>
                                <th>총금액</th>
                                <td><?=number_format($row->real_price_bath)?>바트</td>
                            </tr> -->
                            <?php if($row->people_adult_cnt > 0): ?>
                        <tr>
                            <th style="width:20%">성인 금액</th>
                            <td style="width:30%"><?= number_format($row->adult_price_bath / $row->people_adult_cnt)?> 바트x <?=$row->people_adult_cnt?></td>
                            <th>금액</th>
                            <td style="width:30%"><?=number_format($row->adult_price_bath) ?> 바트</td>
                            
                        </tr>
                        <?php endif?>
                        <?php if($row->people_kids_cnt > 0): ?>
                        <tr>
                            <th style="width:20%">아동 금액</th>
                            <td style="width:30%"><?= number_format($row->kids_price_bath / $row->people_kids_cnt)?> 바트 x <?=$row->people_kids_cnt?></td>
                            <th style="width:20%">금액</th>
                            <td style="width:30%"><?=number_format($row->kids_price_bath)?> 바트</td>
                        </tr>
                        <?php endif?>
                         <?php if($row->people_baby_cnt > 0): ?>
                        <tr>
                            <th style="width:20%">유아 금액</th>
                            <td style="width:30%"><?= number_format($row->baby_price_bath / $row->people_baby_cnt)?> 바트 x <?=$row->people_baby_cnt?></td>
                            <th style="width:20%">금액</th>
                            <td style="width:30%"><?=number_format($row->baby_price_bath)?> 바트</td>
                        </tr>
                        <?php endif?>
                        
                        <?php 
                            if(count($row->options) > 0):
                                $total_option = 0;
                        ?>
                        <tr>
                           
                                <th style="width:20%">옵션</th>
                                <td style="width:30%">
                                    <?php foreach($row->options as $index => $option):
                                        $option_m =  $option->option_tot * $option->option_cnt;
                                        $total_option += $option_m;
                                    ?>
                                    <p><?=$option->option_name?>: <?=round(convertToBath($option->option_tot))?>바트 x <?=$option->option_cnt?></p>
                                    <?php endforeach;?>
                                    
                                </td>
                                <th style="width:20%">금액</th>
                                <td style="width:30%"><?=round(convertToBath($total_option))?>바트</td>
                        </tr>
                        <?php endif;?>
                        <?php
                            $total_bath = round($row->total_bath + convertToBath($total_option));
                            $total_won = convertToWon($total_bath);
                        ?>
                        <tr>
                            <th style="width:20%">총금액</th>
                            <td style="width:80%" colspan="3"><?=number_format($total_bath)?>바트</td>
                        </tr>

                        
                        
                        </tbody>
                    </table>
                    <div class="invoice_golf_total flex_e_c">
                        <p>총 견적서 금액 : <span><?=number_format($total_won)?>원</span> (<?=number_format($total_bath)?>바트)</p>
                    </div>
                    <table class="invoice_tbl spe" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <th style="width:20%">중요안내</th>
                                <td style="width:80%"><?=viewSQ($notice_contents)?></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php if(!empty($cancle_contents)):?>
                    <table class="invoice_tbl spe">
                        <tbody>
                            <tr>
                                <td><?=viewSQ($cancle_contents)?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php endif; ?>
                    <?php if(!empty($policy_1["policy_contents"])):?>
                     <table class="invoice_tbl spe">
                        <tbody>
                            <tr>
                                <td><?=viewSQ($policy_1["policy_contents"])?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php endif; ?>

                    
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
            if($row->order_status == "C" || $row->order_status == "N"){
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