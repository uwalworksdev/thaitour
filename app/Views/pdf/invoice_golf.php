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

        ol, ul, li {
            padding: 0 !important;
        }

        p {
            margin: 0 !important;
        }
        .golf_invoice {
            padding: 20px 0 0;
        }

        .golf_invoice * {
            font-family: "Pretendard" !important;
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
            margin: 40px 0;
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
            font-size: 14px;
            padding: 5px 10px;
            background-color: #f4f4f4;
            border-top: 1px solid #dddddd;
            border-bottom: 1px solid #dddddd;
            text-align: left;
        }

        .golf_invoice .invoice_table .invoice_tbl tr td {
            height: 35px;
            border: 1px solid #dddddd;
            border-right: unset;
            border-left: unset;
            padding: 10px;
            font-size: 14px;
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

        .golf_invoice .invoice_golf_total {
            text-align: right !important;
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
        <section class="golf_invoice">
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
                    <p>요청하신 예약이 가능하여 인보이스가 발송되었습니다.</p>
                    <span>원하시는 날짜, 시간, 인원 등이 맞는지 예약 내용을 반드시 확인해 주신후 결제 진행해 주세요.</span>
                    <span>결제 하시면 예약 확정 후 바우처가 발송됩니다.</span>
                    <span>바우처 수령 후에도 바우처 상에 표시된 예약정보 최종 확인 부탁드립니다.</span>
                </div>
                <div class="invoice_table">
                    <h2 class="tit_top">예약자정보</h2>
                    <table class="invoice_tbl" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <tbody>
                        <?php 
                                $weekdays  = ["일", "월", "화", "수", "목", "금", "토"];
                                $timestamp = strtotime(substr($row['order_m_date'],0,10)); // 문자열 날짜를 타임스탬프로 변환
                                $weekday   = $weekdays[date("w", $timestamp)];

                            ?> 
                            <tr>
                                <th style="width:20%">예약번호</th>
                                <td style = "width:30%"><?= esc($row['order_no']) ?></td>
                                <th style="width:20%">예약날짜</th>
                                <td style = "width:30%"><?= esc(substr($row['order_date'],0,10)) ?>(<?=$weekday?>)</td>
                            </tr>
                            <tr>
                                <th style="width:20%">여행사(담당자)</th>
                                <td style = "width:30%"><?=$row["order_user_name"]?></td>
                                <th style="width:20%">이메일</th>
                                <td style = "width:30%"><?=$row["order_user_email"]?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="top_flex">
                        <table width="100%">
                            <tr>
                                <td style="width: 20%;"><p class="tit_top">예약내역</p></td>
                                <td style="width: 80%; text-align: right;"><span>요청하신 티오프 시간 예약이 불가능하여 가능한 시간으로 변경되었습니다.</span></td>
                            </tr>
                        </table>
                    </div>
                    <table class="invoice_tbl" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
                        <tbody>
                        <?php 
                            $order_info = order_info($row['order_gubun'], $row['order_no'], $row['order_idx']); 
                            $order_txt  = explode("|", $order_info);
                        ?>
                            <tr>
                            <th style="width: 20%">날짜</th>
                            <td style="width:30%"><?=$row['order_day']?>(<?=get_korean_day($row['order_day'])?>)</td>
                            <th style="width: 20%">바우처 이름</th>
                            <td style="width:30%"><?=$row['order_user_first_name_en']?> <?=$row['order_user_last_name_en']?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%">고객 연락처</th>
                                <td style="width:80%" colspan="3"><?=$row['order_user_mobile']?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%">예약상품</th>
                                <td style="width:80%" colspan="3"><?=$row['product_name']?>[ <?=$order_txt[0]?> <?=$order_txt[1]?> ]</td>
                            </tr>
                            <tr>
                                <th style="width: 20%">총인원</th>
                                <td style="width:80%" colspan="3"><?=$order_txt[3]?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%">티오프 요청시간</th>
                                <td style="width:30%"><?=$order_txt[2]?></td>
                                <th style="width: 20%">티오프 가능시간</th>
                                <td style="width:30%"><?=$order_txt[2]?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%">불포함</th>
                                <td style="width:80%" colspan="3"><?=viewSQ($not_included_product)?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%">안내사항</th>
                                <td style="width:80%" colspan="3"><?=viewSQ($guide_contents)?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h2 class="tit_top">금액내역</h2>
                    <table class="invoice_tbl">
                        
                        <tbody>
                            <tr>
                                <th style="width: 20%">에약항목</th>
                                <th style="width: 20%">단가(원)</th>
                                <th style="width: 20%">수량</th>
                                <th style="width: 20%">합계(원)</th>
                                <th style="width: 20%">합계(바트)</th>
                            </tr>					
                            <tr>
                                <th style="width: 20%">그린피</th>
                                <td style="width: 20%"><?=number_format($golf_info['option_price'])?></td>
                                <td style="width: 20%"><?=$golf_info['option_cnt']?></td>
                                <th style="width: 20%"><?=number_format($golf_info['option_tot'])?></th>
                                <td style="width: 20%"><?=number_format($golf_info['option_tot_bath'])?></td>
                            </tr>
                            <?php foreach ($golf_option as $data) { ?>
                            <tr>
                                <th style="width: 20%"><?=$data['option_name']?></th>
                                <td style="width: 20%"><?=number_format($data['option_price'])?></td>
                                <td style="width: 20%"><?=$data['option_cnt']?></td>
                                <th style="width: 20%"><?=number_format($data['option_tot'])?></th>
                                <td style="width: 20%"><?=number_format($data['option_tot_bath'])?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th style="width: 20%">총금액</th>
                                <td colspan="4"><?=number_format($row['real_price_bath'])?>바트</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="invoice_golf_total flex_e_c">
                        <p>총 인보이스 금액 : <span><?=number_format($row['real_price_won'])?>원</span> (<?=number_format($row['real_price_bath'])?>바트)</p>
                    </div>
                    <table class="invoice_tbl spe">
                        <colgroup>
                            <col width="250px">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th style=" width:250px">중요 공지사항</th>
                                <td style="width: *"><?=viewSQ($notice_contents)?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <?=viewSQ($cancle_contents)?>
                    <!-- <p class="cancle_txt">
                    </p> -->
                    <?=viewSQ($policy_1["policy_contents"])?>
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
            if($row['order_status'] == "C" || $row['order_status'] == "N"){
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