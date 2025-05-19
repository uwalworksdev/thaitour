<?php
helper('setting_helper');
$setting = homeSetInfo();
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">
<div id="container_voice">
    <section class="golf_invoice voucher">
        <div class="inner">
            <div class="logo_voice">
                <img src="/uploads/setting/<?= $setting['logos'] ?>" alt="">
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
                            <td style="font-weight: 700;">Phi Phi-Khai-Pileh by Speed boat [Seastar]</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?=$result->addrs?></td>
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
                            <td><?=$result->order_user_first_name_en?> <?=$result->order_user_last_name_en?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>KR <?=$result->order_user_mobile?></td>
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
                            <td colspan="3"><?=$result->order_no?></td>

                        </tr>
                        <tr>
                            <th>Date</th>
                            <td style="color : red" colspan="3"><?=$result->order_date?></td>

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
                            <td style="color: #252525; font-weight: 600;">7.00 - 7.15</td>
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

                <div class="info_order_txt">
                    <p style="font-weight: 700">• Booked by: <?= $setting['site_name_en'] ?></p>
                </div>
                <div class="btns_download_print">
                    <button type="button" class="btn_download" id="btn_pdf" data-order_idx="<?=$result->order_idx?>">PDF다운로드</button>
                    <button type="button" class="btn_download" id="btn_print">프린트</button>
                </div>
                <div class="invoice_note_">
                    <p style="display: flex; align-items: center; margin-bottom: 13px;"><img style="opacity: 0.7; width : 20px;" src="/images/sub/warning-icon.png" alt=""><span style="margin-left: 10px;  font-size: 20px; font-weight: 600;">참고사항</span></p>
                    <p style="color: #eb4848;"><span>-</span><span>This voucher can be shown as captured picture with mobile phone.</span></p>
                    <p><span>-</span><span>이예약확험서(바우처)를 가이드나 기사에게 제시한 후 해당 상품을 이용해 주세요.</span></p>
                    <p><span>-</span><span>픽업이 포함된 투어는 미리 픽업장소와 시각을 정확히 알아 두세요. 픽업장소가 호텔인 경우에는 그 호텔 로비입니다.
                            보비에 계시면 가이드나 기사가 예약확정서상의 성험으로 찾습니다.
                            호텔 포비가 여러 개 있 때에는 1층 로비입니다.</span></p>
                    <p><span>-</span><span>해양 스포츠 투어는 간혹 투어 당일 파도가 실해 신상위에서 안전사고가 발생할 수 있으니 안전요원의 지시사항을 각별히 준수하여 주시고, 만학의 안전사고에 대한 대비로 한국에서 미리 여행자 보험등에 가입하시기를 해드립니다. 안전 부주의로 인한 사고 발생시 여행사와 투어업체는 그 사고에 대한 책임이 있습니다.</span></p>
                    <p><span>-</span><span>더블베드, 트윈베드의 베드타입과 고층배정, 허니문 특전, 인접한 객실 배정, 금연룸, 흡연룸 배정 등은호텔의 객실사정에 따라 달라집니다.<br> 즉, 확정사항이 아닌 요청사항일 뿐이므로 바우처에 기재해 드려도 확정되지 않는 경우가 간혹 발생합니다.

                            체크인시 다시 한번 호텔에 요청하시고, 기재된대로 요청사항이 이행되지 않더라도 여행사의 예약 잘못이 아닙니다.</span></p>
                    <p><span>-</span><span>단독투어가 아닌 조인투어는 앞의 여름과 사랑에 따라 10~15분 정도 픽업에 늦어질 수도 있습니다.
                            픽업 등 문제가 발생하면 아래로 연락주세요. +66(0)80-709-0500 (KOREAN ONLY!!국제전화요금/취침시간에는 긴급건 ONLY)
                            태국내에서 포밍폰 사용시는 지역번호나 국가번호 없이 080-709-0500만 누르시면 됩니다.</span>
                    </p>

                </div>
            </div>
            <div class="inquiry_qna">
                <p class="ttl_qna">본 메일은 발신전용 메일입니다. 문의 사항은 <span>Q&A를</span> 이용해 주시기 바랍니다.</p>
                <div class="inquiry_info">
                    <p>태국 사업자번호 0105565060507 | 태국에서 걸 때 (0)2-730-5690 (방콕) 로밍폰, 태국 유심폰 | 이메일 : thetourlab@naver.com<br>
                        주소 : Sukhumvit 101 Bangjak Prakhanong Bangkok 10260</p>
                    <p>한국 사업자번호 214-19-20927 | 충청북도 청주시 상당구 용암북로6번길 51, 2층, 온잇공유오피스 201-A4호</p>
                </div>
                <div class="note_qna">※ 더투어랩 통신판매중개자이며 통신판매의 당사자가 아닙니다. 따라서 더투어랩 상품·거래정보 및 거래에 대하여 책임을 지지 않습니다.</div>
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

<script>
    $(document).on('click', '#btn_print', function () {
        const content = document.querySelector('#container_voice').innerHTML;

        let iframe = document.createElement('iframe');
        iframe.name = "printFrame";
        iframe.style.position = 'absolute';
        iframe.style.top = '-9999px';
        document.body.appendChild(iframe);

        let frameDoc = iframe.contentWindow || iframe.contentDocument;
        if (frameDoc.document) frameDoc = frameDoc.document;

        frameDoc.open();
        frameDoc.write(`
            <html>
            <head>
                <title>요청하신 예약이 가능하여 인보이스가 발송되었습니다</title>
                <link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">
                <style>
                    @media print {
                        body {
                            background: white !important;
                            margin: 0;
                            padding: 0;
                            color: #000;
                        }

                        .golf_invoice .invoice_ttl p {
                            font-size: 18px !important;
                        }

                        .golf_invoice .invoice_table .top_flex {
                            display: flex !important;
                            align-items: center !important;
                            justify-content: space-between !important;
                        }

                        .golf_invoice .invoice_table {
                            padding: 0 !important;
                            border: none !important;
                        }

                        .btns_download_print, .invoice_note_, .inquiry_qna {
                            display: none !important;
                        }

                        table {
                            border-collapse: collapse !important;
                        }

                        .golf_invoice .invoice_table .invoice_tbl tr th {
                            background-color: #f4f4f4 !important;
                            border-top: 1px solid #dddddd !important;
                            border-bottom: 1px solid #dddddd !important;
                        }

                        .golf_invoice .invoice_golf_total {
                            padding: 10px !important;
                            display: flex !important;
                            justify-content: flex-end !important;
                            align-items: center !important;
                        }

                        .ml-20 {
                            margin-left: 0 !important;
                        }

                        p {
                            margin-top: 0 !important;
                            margin-bottom: 0 !important;
                        }

                        .no-break {
                            page-break-inside: avoid !important;
                        }
                    }
                </style>
            </head>
            <body>
                ${content}
            </body>
            </html>
        `);
        frameDoc.close();

        setTimeout(function () {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
            document.body.removeChild(iframe); 
        }, 500);
    });

    
    // PDF 버튼 클릭 시
    $(document).on('click', '#btn_pdf', function () {
        var order_idx = $(this).data("order_idx"); 
        location.href='/pdf/voucher_tour?order_idx='+order_idx;
    });
</script>