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
            font-size: 14px !important;
            padding: 5px 10px;
            background-color: #f4f4f4;
            border-top: 1px solid #dddddd !important;
            border-bottom: 1px solid #dddddd !important;
            text-align: left;
        }

        .golf_invoice .invoice_table .invoice_tbl tr td {
            height: 35px !important;
            border: 1px solid #dddddd !important;
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
        
    </style>
</head>
<body>
    <div id="container_voice">
        <section class="golf_invoice hotel_invoice">
            <div class="inner">
                <div class="logo_voice">
                    <img src="<?= FCPATH . 'uploads/setting/' . $setting['logos'] ?>" alt="">
                </div>
                <div class="invoice_ttl">
                    <p>고객님 예약이 가능하여 이메일로 견적서 발송해 드렸으며 <br> 홈페이지에 마이페이지에서도 확인이 가능합니다. 견적서 내용을 꼼꼼하게 확인 후 결제 진행해 주시면 됩니다. </p>
                    <p>요청하신 조건으로는 예약이 불가능하고, 예약 가능한 다른 조건으로 <br> 견적서가 발송되었습니다. 반드시 예약 내용(객실타입, 시간 등)을 <br> 확인하여 이 조건으로 예약 원하신다면 결제 진행해 주시고, <br> 다른 상품으로 이용원하실 경우 다시 예약을 넣어주시기 바랍니다.</p>
                </div>
                <div class="invoice_table">
                    <h2 class="tit_top">예약자정보<?=$idx?></h2>
                    <table class="invoice_tbl">
                        <colgroup>
                            <col width="150px">
                            <col width="35%">
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        <?php foreach ($result as $row) : ?>
                        <tbody>
                        <?php 
                                $weekdays  = ["일", "월", "화", "수", "목", "금", "토"];
                                $timestamp = strtotime(substr($row->order_m_date,0,10)); // 문자열 날짜를 타임스탬프로 변환
                                $weekday   = $weekdays[date("w", $timestamp)];

                            ?> 
                            <tr>
                                <th>예약번호</th>
                                <td><?= esc($row->order_no) ?></td>
                                <th>예약날짜</th>
                                <td><?= esc(substr($row->order_date,0,10)) ?>(<?=$weekday?>)</td>
                            </tr>
                            <tr>
                                <th>여행사(담당자)</th>
                                <td>Pattaya Adventure Co.,Ltd. (파타야 어드벤처 투어)</td>
                                <th>이메일</th>
                                <td>thaitouradventure@gmail.com</td>
                            </tr>
                        </tbody>
                        <?php endforeach; ?>
                    </table>
                    <div class="top_flex">
                        <table width="100%">
                            <tr>
                                <td style="width: 20%;"><p class="tit_top">예약내역</p></td>
                                <td style="width: 80%; text-align: right;"><span>요청하신 티오프 시간 예약이 불가능하여 가능한 시간으로 변경되었습니다.</span></td>
                            </tr>
                        </table>
                    </div>
                    <table class="invoice_tbl">
                        <colgroup>
                            <col width="150px">
                            <col width="35%">
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        
                        <?php foreach ($result as $row) : ?>
                        <tbody>
                            <tr>
                                <th>날짜</th>
                                <td>
                                    <?=$row->start_date?>(<?=get_korean_day($row->start_date)?>) ~ <?=$row->end_date?>(<?=get_korean_day($row->end_date)?>) / <?= $row->order_day_cnt ?>일
                                </td>
                                <th>바우처 이름</th>
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
                                <th>예약가능 룸타입</th>
                                <td colspan="3" style="color: red">클래식 오션 뷰 일반 더블</td>
                            </tr>
                            <tr>
                                <th>베드타입</th>
                                <td><?=$row->room?>[<?=$row->room_type?>]]</td>
                                <th>객실수</th>
                                <td><?= $row->order_room_cnt ?> Room</td>
                            </tr>
                            <tr>
                                <th>성인조식포함여부</th>
                                <td>
                                    <?php
                                    if($row->breakfast == "N") {
                                        echo "조식미포함";  
                                    } else { 
                                        echo "조식포함";  
                                    }
                                    ?>  								
                                </td>
                                <th>총인원</th>
                                <td>성인 <?=$row->adult?>명 아동 <?=$row->kids?>명</td>
                            </tr>
                        </tbody>
                        <?php endforeach; ?>
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
                            <tr>
                                <th>객실당 단가</th>
                                <td>
                                    <?php
                                        $roomTot = 0;

                                        // $row->date_price가 존재하는지 확인
                                        if (!empty($row->date_price)) {
                                            $datePrice = explode("|", $row->date_price);

                                            foreach ($datePrice as $priceData) {
                                                $dayTot = 0;
                                                $price = explode(",", $priceData);

                                                // 배열 요소가 충분한지 확인 후 값 할당
                                                $p1 = isset($price[1]) ? (int)$price[1] : 0;
                                                $p2 = isset($price[2]) ? (int)$price[2] : 0;
                                                $p3 = isset($price[3]) ? (int)$price[3] : 0;

                                                $dayTot = $p1 + $p2 + $p3;
                                                $roomTot += $dayTot;

                                                if($dayTot > 0) echo htmlspecialchars($price[0]) . " " . number_format($dayTot) . " 바트<br>";
                                            }
                                        } else {
                                            echo "가격 정보 없음";
                                        }
                                    ?>
                                </td>

                                <th>객실 금액</th>
                                <td><?= number_format($roomTot * $row->order_room_cnt) ?>바트 (<?=number_format($roomTot)?>바트 x <?=$row->order_room_cnt?>룸)</td>
                            </tr>
                            <tr>
                                <th>추가내역</th>
                                <td>0바트</td>
                                <th>총금액</th>
                                <td><?= number_format($roomTot * $row->order_room_cnt * $row->baht_thai) ?>원</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="invoice_golf_total">
                        <p style="margin-bottom: 0 !important;">총 인보이스 금액 : <span><?= number_format($roomTot * $row->order_room_cnt * $row->baht_thai) ?>원</span> (<?= number_format($roomTot * $row->order_room_cnt) ?>바트)</p>
                    </div>
                    <!-- <table class="invoice_tbl spe">
                        <tbody>
                            <tr>
                                <th style="width: 150px;">
                                    취소규정</th>
                                <td>날짜 및 시간(한국시간)</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">무료 취소</th>
                                <td>23년09월05일(화) 18시 이전</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">1박 취소수수료</th>
                                <td>23년09월05일(화) 18시 ~ 23년09월09일(토) 18시</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">50 % 취소수수료</th>
                                <td>23년09월09일(토) 18시 ~ 23년09월10일(일) 18시</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">환불 불가</th>
                                <td>23년09월10일(일) 18시 이후 취소 또는 노쇼(No show)</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">중요안내</th>
                                <td>
                                    <p class="row_ttl" style="font-weight: bold !important; color: #454545 !important; font-size: 15px !important;">체크인 안내</p>
                                    <br>
                                    <p>채크인 15:00/체크아웃 정오</p>
                                    <table class="table_custom ml-20">
                                        <colgroup>
                                            <col width="10px">
                                            <col width="auto">
                                        </colgroup>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>추가 인원에 대한 요금이 부과될 수 있으며, 이는 숙박 시설 정책에 따라 다릅니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>체크인 시 부대 비용 발생에 대비해 정부에서 발급한 사진이 부착된 신분증과 신용카드, 직물카드 또는 현금으로 보증금이 필요할 수 있습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>특별 요정 사항은 체크인 시 이용 상황에 따라 제공 여부가 달라질 수 있으며 추가 요금이 부 과될 수 있습니다. 또한, 반드시 보장되지는 않습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>부대 비용 발생에 대비해 체크인 시 제시하는 신용카드상의 이름은 객실 예약 시 사용된 대표 예약자의 이름이어야 합니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>시설 내 주차 등을 예약하시려는 고객께서는 이 숙박 시설에 미리 연락해 주셔야 합니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>세금 ID-0105549106859</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>이 숙박 시설에서 사용 가능한 결제 수단은 신용카드, 직불카드, 모바일 결제 현금입니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>Alipay 등의 모바일 결제 옵션을 이용하실 수 있습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>이 숙박 시설은 도착 전에 고객의 신용카드를 사전 승인할 수 있습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>무소음 객실이 보장되지는 않습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>이 숙박 시설은 안전을 위해 소화기, 보안 시스템, 구급상자, 방범창 등을 갖추고 있습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>이 숙박 시설은 위생을 위한 노력(메리어트)의 노력(메리어트)의 청소 및 소독 지침을 준수합니다. 고객 정책과 문화적 기준이나 규범은 국가 및 숙박 시설에 따라 다를 수 있습니다. 명시된 정 책은 숙박 시설에서 제공했습니다.</td>
                                        </tr>
                                    </table>
                                    <p>이 숙박 시설은 공항에서 교통편을 제공합니다(별도의 요금이 적용될 수 있음). 픽업 서비스를 이용 하려면 예약 확인 메일에 나와 있는 연락처 정보로 도착 48시간 전 숙박 시설에 연락하여 도착 세부 사항을 알려주시기 바랍니다. 도착 48시간 전에 체크인 지침을 이메일로 보내드립니다. 도착 시에는 프런트 데스크 직원이 도와드립니다. 자세한 내용은 예약 확인 메일에 나와 있는 연락처 정보로 숙박 시설에 문의해 주시기 바랍니다.</p>
                                    <br>
                                    <p>요금</p>
                                    <p style="padding : 4px 0 !important;">*숙박 시설에서 다음 요금을 결제하셔야 합니다.</p>
                                    <br>
                                    <p>[필수]</p>
                                    <table class="table_custom ml-20">
                                        <tr>
                                            <td>체크인 또는 체크아웃 시 숙박 시설에서 다음 요금을 청구할 수 있습니다(요금에는 해당 세 급이 포함될 수 있음).</td>
                                        </tr>
                                    </table>
                                    <table class="table_custom ml-40">
                                        <colgroup>
                                            <col width="10px">
                                            <col width="auto">
                                        </colgroup>
                                        <tr>
                                            <td style="vertical-align: top; width: 10px;">•</td>
                                            <td>보증금: THB 2000(1박기준)</td>
                                        </tr>
                                    </table>

                                    <table class="table_custom ml-20">
                                        <tr>
                                            <td>이 숙박 시설에서 제공한 모든 요금 정보가 포함되어 있습니다.</td>
                                        </tr>
                                    </table>
                                    <br>
                                    <p>[선택]</p>
                                    <table class="table_custom ml-40">
                                        <tr>
                                            <td style="vertical-align: top; width: 10px;">•</td>
                                            <td>뷔페아침 식사 요금: 성인 THB 883. 어린이 THB 482(대략적인 금액)</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top; width: 10px;">•</td>
                                            <td>공항 셔틀 요금: 차량 1대당 THB 2500(편도, 정원 4명)</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top; width: 10px;">•</td>
                                            <td>간이 최대 이용 요금: 1박 기준, THB 1700.0</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top; width: 10px;">•</td>
                                            <td>시설 이용 요금은 다음 항목을 포함합니다: 스파</td>
                                        </tr>
                                    </table>
                                    <table class="table_custom ml-20">
                                        <tr>
                                            <td>위 목록에 명시되지 않은 다른 항목이 있을 수 있습니다. 요금 및 보증금은 세전 금액일 수 있 으며 변경될 수 있습니다.</td>
                                        </tr>
                                    </table>

                                    <p class="row_ttl" style=" font-weight: bold !important; font-size: 15px !important; color: #454545 !important;">출발 전 알아들 사항</p>
                                    <table class="table_custom ml-20">
                                        <colgroup>
                                            <col width="10px">
                                            <col width="auto">
                                        </colgroup>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>마사지 서비스 및 스파 트리트 및 스파 트리트먼트의 경우 사전 예약이 필요 합니다. 예약 확인 메일에 나와 있는 연락처 정보로 도착 전에 호텔에 연락하여 예약하실 수 있습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>만 12세 이하 아동은 부모 또는 보호자와 같은 객실에서 침구를 추가하지 않고 이용할 경우 무료로 숙박할 수 있습니다(최대 2명).</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>등록된 고객만 객실에 허용됩니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>이용 상황에 따라 객실 연결이 가능하며, 예약 확인 메일에 나와 있는 번호로 숙박 시설에 직 접 연락하여 요청하실 수 있습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>비대면 체크인, 비대면 체크아웃 서비스를 이용하실 수 있습니다.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">•</td>
                                            <td>이 숙박 시설에서는 고객의 모든 성적 지향과 성 정체성을 존중합니다(성소수자(LGBTQ+) 환영).</td>
                                        </tr> 
                                    </table>  
                                </td>
                            </tr>
                        </tbody>
                    </table> -->
                    
                    <?=viewSQ($policy_1["policy_contents"])?>
                                        
                </div>
            </div>
        </section>     
    </div>
</body>
</html>