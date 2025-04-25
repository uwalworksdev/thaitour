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
                            <td style="font-weight: 700;"><?=$result->product_name_en?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?=$result->stay_address?></td>
                        </tr>
                        <tr>
                            <th>Tel</th>
                            <td><?=$result->tel_no?></td>
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
                            <td><?=$result->order_user_mobile?></td>
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
                            <td style="color : red" colspan="3">
							    <?=date('d-M-Y(D)', strtotime($result->start_date))?>
								<?=date('d-M-Y(D)', strtotime($result->end_date))?> / <?=$result->order_day_cnt?> night
							</td>

                        </tr>
                        <tr>
                            <th>Room Type</th>
                            <td><?=$result->room_type_eng?></td>
                            <th>Bed Type</th>
                            <td><?=$result->bed_type_eng?></td>
                        </tr>
                        <tr>
                            <th>Guest Name</th>
                            <td><?=$result->order_user_first_name_en?> <?=$result->order_user_last_name_en?></td>
                            <th>Number of rooms</th>
                            <td><?=$result->order_room_cnt?></td>
                        </tr>
                        <tr>
                            <th>Total Persons</th>
                            <td><?=$result->adult + $result->kids?> Adult(s)</td>
                            <th>Child Age</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Breakfast</th>
                            <td colspan="3">
							    <?php
								  if($result->breakfast == "N") {
							         echo "Include (No) Adult Breakfast";
						          } else {  	 
							         echo "Include (Yes) Adult Breakfast";
						          }
								?>	 
							</td>

                        </tr>
                        <tr>
                            <th>Guest Request</th>
                            <td colspan="3">
                                <p>Smoking Room</p>
                                <p>Extension Room </p>
                                <p>Room no: 390</p>
                            </td>

                        </tr>
                        <tr>
                            <th>Agent Memo</th>
                            <td colspan="3"><?=$result->order_memo?></td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td colspan="3">
                            </td>
                        </tr>
                        <tr>
                            <th>Option</th>
                            <td colspan="3">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="info_order_txt">
                    <p style="font-weight: 700">• Booked by: Totobooking</p>
                    <p>• Booked on: 27-Sep-2023(Wed)</p>
                </div>
                <div class="btns_download_print">
                    <button class="btn_download">다운로드</button>
                    <button type="button" class="btn_download" id="btn_pdf" data-order_idx="<?=$result->order_idx?>">PDF다운로드</button>
                    <button type="button" class="btn_download" id="btn_print">프린트</button>
                </div>
                <div class="invoice_note_">
                    <p  style="display: flex; align-items: center; margin-bottom: 13px;"><img style="opacity: 0.7; width : 20px;" src="/images/sub/warning-icon.png" alt=""><span style="margin-left: 10px;  font-size: 20px; font-weight: 600;">참고사항</span></p>
                    <!-- <p style="color: #eb4848;"><span>-</span><span>This voucher can be shown as captured picture with mobile phone.</span></p>
                    <p><span>-</span><span>호텔 체크인 시 프론트 데스크에 여권과 함께 바우처를 제시해 주세요.</span></p>
                    <p><span>-</span><span>이 객실 요금은 모두 지불되었으며 호텔의 디파짓 결제 요구는 부대시설 이용에 대한 보증금 목적이며, 을 요구합니다. 디파짓(보증금)은 해당국가 현금이나 신용카드 모두 가능하며 체크아웃시 환불 또는 신용카드 카드 승인 취소로 처리됩니다.</span></p>
                    <p><span>-</span><span>원칙적으로 어린이 조식비는 에이전시가 대납하지 않고, 투숙객이 호텔에 직접 지불합니다.</span></p>
                    <p><span>-</span><span>더블베드, 트윈베드의 베드타입과 고층배정, 허니문 특전, 인접한 객실 배정, 금연룸, 흡연룸 배정 등은호텔의 객실사정에 따라 달라집니다.<br> 즉, 확정사항이 아닌 요청사항일 뿐이므로 바우처에 기재해 드려도 확정되지 않는 경우가 간혹 발생합니다.
                            체크인시 다시 한번 호텔에 요청하시고, 기재된대로 요청사항이 이행되지 않더라도 여행사의 예약 잘못이 아닙니다.</span></p>
                    <p><span>-</span><span>예약에 문제가 발생하거나 추가 예약이 필요하시면 다음 비상연락처로 연락주세요. 신속히 조치해 드리겠습니다.
                            +66(0)80-709-0500 (KOREAN ONLY!!국제전화요금/취침시간에는 긴급건 ONLY)
                            태국내에서 로밍폰 사용시는 지역번호나 국가번호 없이 080-000-0000만 누르시면 됩니다</span></p> -->
                    <?= viewSQ($policy_1["policy_contents"]) ?>
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
        location.href='/pdf/voucher_hotel?order_idx='+order_idx;
    });
</script>