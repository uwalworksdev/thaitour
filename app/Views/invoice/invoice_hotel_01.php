<?php
    helper('setting_helper');
    $setting = homeSetInfo();
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">
<style>
        .ml-20 {
            margin-left: 20px !important;
        }

        .ml-40 {
            margin-left: 40px !important;
        }

        .table_custom {
            border-collapse: collapse !important;
            width: 100% !important;
            font-size: 14px;
            table-layout: fixed;
        }

        .table_custom tr td {
            border: none !important;
            padding-bottom: 0 !important;
            padding-left: 0 !important;
            padding-right: 5px !important;
            padding-top: 0 !important;
        }

        .table_custom tr td:first-child {
            padding-top: 0 !important;
        }
</style>
<div id="container_voice">
    <section class="golf_invoice hotel_invoice">
        <div class="inner">
            <div class="logo_voice">
                <img src="/uploads/setting/<?= $setting['logos'] ?>" alt="">
            </div>
            <div class="invoice_ttl">
                <p>고객님 예약이 가능하여 이메일로 견적서 발송해 드렸으며 홈페이지에 마이페이지에서도 확인이 가능합니다. <br> 견적서 내용을 꼼꼼하게 확인 후 결제 진행해 주시면 됩니다. </p>
                <p>요청하신 조건으로는 예약이 불가능하고, 예약 가능한 다른 조건으로 견적서가 발송되었습니다. <br> 반드시 예약 내용(객실타입, 시간 등)을 확인하여 이 조건으로 예약 원하신다면 결제 진행해 주시고, 다른 상품으로 이용원하실 경우 다시 예약을 넣어주시기 바랍니다.</p>
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
                        <tr>
                            <th>예약번호</th>
                            <td><?= esc($row->order_no) ?></td>
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
					<?php endforeach; ?>
                </table>
                <div class="top_flex flex_b_c">
                    <h2 class="tit_top">예약내역</h2>
                    <span>요청하신 티오프 시간 예약이 불가능하여 가능한 시간으로 변경되었습니다.</span>
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
                            <td colspan="3" style="color: red"><?=$row->room?></td>
                        </tr>
                        <tr>
                            <th>베드타입</th>
                            <td><?=$row->bed_type?></td>
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

									// $row->date_price가 존재하는지 확인
									if (!empty($row->date_price)) {
										$datePrice = explode("|", $row->date_price);

										foreach ($datePrice as $priceData) {
											$dayTot = 0;
											$price = explode(":", $priceData);

											// 배열 요소가 충분한지 확인 후 값 할당
											$p1 = isset($price[1]) ? (int)$price[1] : 0;
											$p2 = isset($price[2]) ? (int)$price[2] : 0;
											$p3 = isset($price[3]) ? (int)$price[3] : 0;

											$dayTot = $p2 + $p3;

											if($dayTot > 0) echo htmlspecialchars($price[0]) . " " . number_format($dayTot) . " 바트 Χ ". $row->order_room_cnt ."룸<br>";
										}
									} else {
										echo "가격 정보 없음";
									}
								?>
							</td>

                            <th>객실 금액</th>
                            <td>
                                <?= number_format($row->price) ?>바트 (<?=number_format((int)$row->price / $row->order_room_cnt)?>바트 Χ <?=$row->order_room_cnt?>룸)
                                <br>
                                + Extra: <?=$row->extra_bath?>바트
                            </td>
                        </tr>
                        <tr>
                            <th>추가내역</th>
                            <td>0바트</td>
                            <th>총금액</th>
                            <td><?= number_format((int)$row->price_won + (int)$row->extra_won) ?>원</td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice_golf_total flex_e_c">
                    <p>총 인보이스 금액 : <span><?= number_format((int)$row->price_won + (int)$row->extra_won) ?>원</span> (<?= number_format((int)$row->price + (int)$row->extra_bath) ?>바트)</p>
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
                                <p class="row_ttl">체크인 안내</p>
                                <p>채크인 15:00/체크아웃 정오</p>
                                <ul>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>추가 인원에 대한 요금이 부과될 수 있으며, 이는 숙박 시설 정책에 따라 다릅니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>체크인 시 부대 비용 발생에 대비해 정부에서 발급한 사진이 부착된 신분증과 신용카드, 직물카드 또는 현금으로 보증금이 필요할 수 있습니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>특별 요정 사항은 체크인 시 이용 상황에 따라 제공 여부가 달라질 수 있으며 추가 요금이 부 과될 수 있습니다. 또한, 반드시 보장되지는 않습니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>부대 비용 발생에 대비해 체크인 시 제시하는 신용카드상의 이름은 객실 예약 시 사용된 대표 예약자의 이름이어야 합니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>시설 내 주차 등을 예약하시려는 고객께서는 이 숙박 시설에 미리 연락해 주셔야 합니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>세금 ID-0105549106859</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>이 숙박 시설에서 사용 가능한 결제 수단은 신용카드, 직불카드, 모바일 결제 현금입니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>Alipay 등의 모바일 결제 옵션을 이용하실 수 있습니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>이 숙박 시설은 도착 전에 고객의 신용카드를 사전 승인할 수 있습니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>무소음 객실이 보장되지는 않습니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>이 숙박 시설은 안전을 위해 소화기, 보안 시스템, 구급상자, 방범창 등을 갖추고 있습니다.</p>
                                    </li>
                                    <li class="ml-20 flex-gap10"><span>•</span>
                                        <p>이 숙박 시설은 위생을 위한 노력(메리어트)의 노력(메리어트)의 청소 및 소독 지침을 준수합니다. 고객 정책과 문화적 기준이나 규범은 국가 및 숙박 시설에 따라 다를 수 있습니다. 명시된 정 책은 숙박 시설에서 제공했습니다.</p>
                                    </li>

                                </ul>
                                <p>이 숙박 시설은 공항에서 교통편을 제공합니다(별도의 요금이 적용될 수 있음). 픽업 서비스를 이용 하려면 예약 확인 메일에 나와 있는 연락처 정보로 도착 48시간 전 숙박 시설에 연락하여 도착 세부 사항을 알려주시기 바랍니다. 도착 48시간 전에 체크인 지침을 이메일로 보내드립니다. 도착 시에는 프런트 데스크 직원이 도와드립니다. 자세한 내용은 예약 확인 메일에 나와 있는 연락처 정보로 숙박 시설에 문의해 주시기 바랍니다.</p>

                                <p>요금</p>
                                <p style="padding : 4px 0">*숙박 시설에서 다음 요금을 결제하셔야 합니다.</p>
                                <p>[필수]</p>
                                <p style="margin-left: 20px;">체크인 또는 체크아웃 시 숙박 시설에서 다음 요금을 청구할 수 있습니다(요금에는 해당 세 급이 포함될 수 있음).</p>
                                <p style="margin-left: 40px">• 보증금: THB 2000(1박기준)</p>
                                <p style="margin-left : 20px">이 숙박 시설에서 제공한 모든 요금 정보가 포함되어 있습니다.</p>
                                <p>[선택]</p>
                                <p style="margin-left : 40px">• 뷔페아침 식사 요금: 성인 THB 883. 어린이 THB 482(대략적인 금액)</p>
                                <p style="margin-left : 40px">• 공항 셔틀 요금: 차량 1대당 THB 2500(편도, 정원 4명)</p>
                                <p style="margin-left : 40px">• 간이 최대 이용 요금: 1박 기준, THB 1700.0</p>
                                <p style="margin-left : 40px">• 시설 이용 요금은 다음 항목을 포함합니다: 스파</p>
                                <p style="margin-left : 20px">위 목록에 명시되지 않은 다른 항목이 있을 수 있습니다. 요금 및 보증금은 세전 금액일 수 있 으며 변경될 수 있습니다.</p>

                                <p class="row_ttl"> 출발 전 알아들 사항</p>
                                <ul>
                                    <li class="flex-gap10 ml-20"><span>•</span>
                                        <p>마사지 서비스 및 스파 트리트 및 스파 트리트먼트의 경우 사전 예약이 필요 합니다. 예약 확인 메일에 나와 있는 연락처 정보로 도착 전에 호텔에 연락하여 예약하실 수 있습니다.</p>
                                    </li>
                                    <li class="flex-gap10 ml-20"><span>•</span>
                                        <p>만 12세 이하 아동은 부모 또는 보호자와 같은 객실에서 침구를 추가하지 않고 이용할 경우 무료로 숙박할 수 있습니다(최대 2명).</p>
                                    </li>
                                    <li class="flex-gap10 ml-20"><span>•</span>
                                        <p>등록된 고객만 객실에 허용됩니다.</p>
                                    </li>
                                    <li class="flex-gap10 ml-20"><span>•</span>
                                        <p>이용 상황에 따라 객실 연결이 가능하며, 예약 확인 메일에 나와 있는 번호로 숙박 시설에 직 접 연락하여 요청하실 수 있습니다.</p>
                                    </li>
                                    <li class="flex-gap10 ml-20"><span>•</span>
                                        <p>비대면 체크인, 비대면 체크아웃 서비스를 이용하실 수 있습니다.</p>
                                    </li>
                                    <li class="flex-gap10 ml-20"><span>•</span>
                                        <p>이 숙박 시설에서는 고객의 모든 성적 지향과 성 정체성을 존중합니다(성소수자(LGBTQ+) 환영).</p>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table> -->

                <div class="policy_wrap_cont">
                    <?=viewSQ($policy_1["policy_contents"])?>
                </div>

                <div class="btns_download_print flex_c_c">
                    <button type="button" class="btn_download" id="btn_pdf" data-order_idx="<?=$row->order_idx?>">PDF다운로드</button>
                    <button type="button" class="btn_download" id="btn_print">프린트</button>
                </div>

            </div>
            <div class="inquiry_qna">
                <p class="ttl_qna">본 메일은 발신전용 메일입니다. 문의 사항은 <span>Q&A</span>를 이용해 주시기 바랍니다.</p>
                <div class="inquiry_info">
                    <p>태국 사업자번호 <?= $setting['comnum_thai']?> | 태국에서 걸 때 <?= $setting['custom_service_phone_thai']?>
                        (방콕) 로밍폰, 태국 유심폰 모두 <?= $setting['custom_service_phone_thai2']?> 
                        번호만 누르면 됩니다. | 이메일 : <?= $setting['qna_email']?><br>
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

                        .golf_invoice {
                            padding: 20px 0 0 !important;
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

                        .btns_download_print, .table_wrapper, .inquiry_qna {
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
        location.href='/pdf/invoice_hotel?order_idx='+order_idx;
    });
</script>