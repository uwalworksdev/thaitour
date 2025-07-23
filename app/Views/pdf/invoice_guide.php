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

        .hotel_invoice .table_wrapper {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #dbdbdb;
            color: #7d7d7d;
            font-size : 14px
        }
    </style>
</head>

<?php foreach ($result as $row): ?>
<?php endforeach; ?>

<div id="container_voice">
    <section class="golf_invoice hotel_invoice">
        <div class="inner">
            <div class="logo_voice">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="vertical-align: top;">
                            <img src="/uploads/setting/<?= $setting['logos']?>" alt="" style="width: 165px;">
                            <p class="addr" style="margin-top: 10px;">
                                <?= $setting['addr_thai']?><br>
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
                            <td><?= esc(substr($row->order_date,0,10)) ?>(<?=get_korean_day(substr($row->order_date,0,10));?>)</td>
                        </tr>
                        <tr>
                            <th>여행사(담당자)</th>
                            <td><?=$row->order_user_name?></td>
                            <th>이메일</th>
                            <td><?=$row->order_user_email?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="top_flex flex_b_c">
                    <h2 class="tit_top">예약내역</h2>
                </div>
                <?php
                    if($row->chk_notes_invoice == "Y"){
                ?>
                    <span style="color: red; line-height: 1.4;"><?=$row->notes_invoice?></span>
                <?php
                    }
                ?>
                <table class="invoice_tbl">
                    <colgroup>
                        <col width="150px">
                        <col width="35%">
                        <col width="150px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>날짜</th>
                            <td>
                                <?= date("Y.m.d", strtotime($row->start_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->start_date))) . ")"  ?>
                                ~
                                <?= date("Y.m.d", strtotime($row->end_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->end_date))) . ")";?>
                            </td>
                            <th>여행자 이름</th>
                            <td><?=$row->order_user_first_name_en?> <?=$row->order_user_last_name_en?></td>
                        </tr>
                        <tr>
                            <th>고객 연락처</th>
                            <td colspan="3"><?=$row->order_user_mobile?></td>
                        </tr>
                        <tr>
                            <th>예약상품</th>
                            <td colspan="3"><?=$row->product_name?></td>
                        </tr>
                        <tr>
                            <th>총인원</th>
                            <td colspan="3">성인 : <?= $row->people_adult_cnt ?>명</td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="tit_top">픽업포함여부</h2>
                <table class="invoice_tbl re_custom">
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th class="subject">가이드미팅시간</th>
                        <th class="subject">미팅 장소</th>
                        <th class="subject">예상일정</th>
                        <th class="subject">기타 요청</th>
                    </tr>

                    <?php foreach ($order_subs as $item): ?>
                        <tr>
                            <td class="content">
                                <span>
                                    <?= $item["guide_meeting_hour"] ?>:<?= $item["guide_meeting_min"] ?>
                                </span>
                            </td>

                            <td class="content">
                                <?= $item["guide_meeting_place"] ?>
                            </td>
                            <td class="content">
                                <?= nl2br($item["guide_schedule"]) ?>
                            </td>
                            <td class="content">
                                <?= nl2br($item["request_memo"]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

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
                        <!-- <tr>
                            <th>1인당 금액</th>
                            <td colspan="3">성인400바트</td>
                        </tr> -->
                        <tr>
                            <th>금액</th>
                            <td colspan = "3"><?=number_format($row->real_price_bath)?></td>
                        </tr>
                        <tr>
                            <th>추가내역</th>
                            <td>0바트</td>
                            <th>총금액</th>
                            <td><?=number_format($row->real_price_bath)?>바트</td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice_golf_total flex_e_c">
                    <p>총 견적서 금액 : <span><?=number_format($row->real_price_won)?>원</span> (<?=number_format($row->real_price_bath)?>바트)</p>
                </div>
                <table class="invoice_tbl spe">
                    <!-- <colgroup>
                        <col width="250px">
                        <col width="*">
                    </colgroup> -->
                    <tbody>     
                        <tr>
                            <th style="width: 20%">유의사항</th>
                            <td style="width: 80%"><?=viewSQ($notice_contents)?></td>
                        </tr>
                    </tbody>
                </table>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <tr>
                        <td style="width: 20px; vertical-align: top;">
                            <img style="width: 18px; opacity: 0.7;" src="<?= FCPATH . '/images/sub/forbidden-sign-icon.png' ?>" alt="">
                        </td>
                        <td style="padding-left: 5px;">
                            <!-- <span style="color: #7d7d7d; font-size: 14px;">
                                취소 규정: 결제 후 
                                <span style="color: #17469E;">24년 12월 18일 18시(한국시간)</span> 
                                이전에 취소하시면 무료취소가 가능합니다.
                            </span> -->
                            <?=viewSQ($cancle_contents)?>

                        </td>
                    </tr>
                </table>
                <div class="table_wrapper invoice_table">
                    <p style="margin : 20px 0 !important; line-height: 1.4;" class="">견적서는 발송 시점의 예약 가능 여부만 확인하여 보내드리는 것이며, 예약을 잡아두지는 않습니다.<br>
                        따라서 결제가 늦어질 경우 예약이 불가능할 수 있으며, 결제 후 예약이 불발될 경우 전액 환불이 가능합니다.<br>
                        견적서를 받으신 후에는 다른 사람이 먼저 예약하기 전에 서둘러 결제해 주시는 것이 윈윈트래블 이용립입니다.
                    </p>
                    <span style="box-sizing: border-box; color: inherit; font-size: 12px;">&nbsp;</span>
                    <table class="invoice_tbl">
                        <colgroup>
                            <col width="20%">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td style="color : #454545; background-color : #f2f2f2 !important; padding: 0 !important;" colspan="2">
                                    <table style="width: 100%; border: none; border-collapse: collapse; background-color: #f2f2f2;">
                                        <tr>
                                            <td style="width: 30px; vertical-align: middle; padding-top: 10px; border: none;">
                                                <img src="/images/sub/warning-icon.png" alt="" style="opacity: 0.7; width: 20px;">
                                            </td>
                                            <td style="vertical-align: middle; padding-left: 5px; font-weight: 500; border: none;">
                                                결제방법
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>가상계좌</td>
                                <td>윈윈트래블 사이트에서 고유통장번호를 받아 입금 포인트 3~4% 적립. 공인인증서 무조건 필요.</td>
                            </tr>
                            <tr>
                                <td>실시간계좌이체</td>
                                <td>공인인증서 무조건 필요.</td>
                            </tr>
                            <tr>
                                <td>무통장 원화 송금</td>
                                <td>
                                    <p>예약자, 입금자가 다를 경우 연락주시기 바랍니다. 포인트 3~4% 적립. 공인인증서 불필요.</p>
                                    <p>- 한국 계좌 : <b>국민은행 636101-01-301315 (주)도도부킹</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>바트화 송금</td>
                                <td>
                                    <p>태국계좌 입금의 경우 입금후 꼭~ 유선상으로 또는 게시판을 통해 알려주셔야 입금확인됩니다.</p>
                                    <p>- 태국 계좌:<b> Kasikorn Bank 895-2-19850-6 (Totobooking)</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>신용카드</td>
                                <td>공인인증서 30만원 이상시 필요.</td>
                            </tr>
                            <tr>
                                <td>ARS 카드</td>
                                <td>
                                    <p>마이페이지 예약확인/결제 창에서 결제 상품 선택 후 결제방법 신용카드-ARS 선택.</p>
                                    <p>이 후 결제자 정보에 결제자 휴대전화번호를 입력 후 결제하기를 클릭해주시면 SMS 인증번호가 발송 됩니다.</p>
                                    <p> 인증번호를 메모하시고, SMS 발송번호로 전화하셔서 결제를 진행하시기 바랍니다</p>
                                </td>
                            </tr>
                            <tr>
                                <td>수기결제</td>
                                <td>불가피한 경우 관리자에게 카드번호와 유효기간을 알려주시면 결제대행 해드립니다. 공인인증서 불 필요.</td>
                            </tr>
                            <tr>
                                <td>휴대폰</td>
                                <td>한도 30만원 기본 (사용자 신용도에 따라 한도가 달라집니다.) 공인인증서 불필요.</td>
                            </tr>
                            <tr>
                                <td>포인트</td>
                                <td>포인트로 금액 결제, 공인인증서 불필요.</td>
                            </tr>
                            <tr>

                                <td style="background-color: #f2f2f2;" colspan="2">
                                    <p>- 결제 전에는 예약이 확정된 상태가 아닙니다. 결제 후 예약 확정 절차가 진행됩니다.</p>
                                    <p>- 결제가 글 예약 확정이 아님을 주의하세요! 간혹 여러 가지 사유로 예약이 불발될 수 있습니다.</p>
                                    <p>- 예약자와 결제자가 동일하지 않아도 되며, 무통장 입금시 예약자와 입금자명이 다르거나, 바트화 입금 시에는 꼭 확인 요청해 주시기 바랍니다.</p>
                                    <p>- 결제 후 마이페이지 > 예약확인/결제에서 예약 상태와 결제 정보를 통해 결제가 정상적으로 되었는지 직접 확인 할 수 있습니다.</p>
                                    <p>- 결제 후 예약확정서를 받으셔야 예약이 최종 확정된 것입니다.</p>
                                    <p>- 견적서는 예약 또는 실제 이용 당사자에게 결제 점구용으로 발행된 문서로 해당 견적서를 다른 목적으로
                                    사용할 경우(호텔 또는 제3자에게 최저가 보장을 요구하기 위한 목적 등) 민/형사상의 불이익을 당할 수 있습니다.</p>
                                    <p style="margin-top : 10px ">※ 결재와 동시에 예약확정을 원하시면 윈윈트래블 실시간 예약을 이용하세요.</p>
                                </td>
                            </tr>
                        </tbody>

                    </table>
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
