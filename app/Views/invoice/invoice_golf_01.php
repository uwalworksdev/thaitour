<?php
     helper('setting_helper');
     $setting = homeSetInfo();
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">
<div id="container_voice">
    <section class="golf_invoice">
        <div class="inner">
            <!-- <div class="logo_voice only_web">
                <img src="/uploads/setting/<?= $setting['logos']?>" alt="">
            </div> -->
            <!-- <div class="logo_voice">
                <h2 class="tit_top">견적서</h2>
                <img src="/uploads/setting/<?= $setting['logos']?>" alt="">
                <p class="addr">Sukhumvit 101 Bangchak Prakhanong Bangkok 10260<br>
                    Thai - Registration No 010-5555-096-398<br>
                    Tel: 001-66-(0)2-730-5690, 070-7010-8266
                </p>
            </div> -->
            <div class="only_mo">
                <div class="logo_voice">
                    <h2 class="tit_top">견적서</h2>
                    <img src="/uploads/setting/<?= $setting['logos']?>" alt="">
                    <p class="addr"><?= $setting['addr_thai']?><br>
                        Thai - Registration No <?= $setting['comnum_thai']?><br>
                        Tel: <?= $setting['custom_service_phone_thai2']?>
                    </p>
                </div>
            </div>
            <div class="only_web">
                <div class="logo_voice">
                    <div class="logo_addr">
                        <img src="/uploads/setting/<?= $setting['logos']?>" alt="">
                        <p class="addr"><?= $setting['addr_thai']?><br>
                        Thai - Registration No <?= $setting['comnum_thai']?><br>
                        Tel: <?= $setting['custom_service_phone_thai2']?>
                        </p>
                    </div>
                    <div class="ttl_right">
                        <h2 class="tit_top">견적서</h2>
                    </div>
                </div>
            </div>
            <div class="invoice_ttl">
                <p>요청하신 예약이 가능하여 인보이스가 발송되었습니다.</p>
                <span>원하시는 날짜, 시간, 인원 등이 맞는지 예약 내용을 반드시 확인해 주신후 결제 진행해 주세요.</span>
                <span>결제 하시면 예약 확정 후 바우처가 발송됩니다.</span>
                <span>바우처 수령 후에도 바우처 상에 표시된 예약정보 최종 확인 부탁드립니다.</span>
            </div>
            <div class="invoice_table">
                <h2 class="tit_top">예약자정보</h2>
                <table class="invoice_tbl re_custom">
                    <colgroup>
                        <col width="150px">
                        <col width="35%">
                        <col width="150px">  
                        <col width="*">
                    </colgroup>
                    <tbody>
					   <?php 
							$weekdays  = ["일", "월", "화", "수", "목", "금", "토"];
							$timestamp = strtotime(substr($row['order_m_date'],0,10)); // 문자열 날짜를 타임스탬프로 변환
							$weekday   = $weekdays[date("w", $timestamp)];

                        ?> 
                        <tr>
                            <th>예약번호</th>
                            <td><?= esc($row['order_no']) ?></td>
                            <th>예약날짜</th>
                            <td><?= esc(substr($row['order_date'],0,10)) ?>(<?=$weekday?>)</td>
                        </tr>
                        <tr>
                            <th>예약자</th>
                            <td><?=$row["order_user_name"]?></td>
                            <th>이메일</th>
                            <td><?=$row["order_user_email"]?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="top_flex flex_b_c">
                    <h2 class="tit_top">예약내역</h2>
                    <span>요청하신 티오프 시간 예약이 불가능하여 가능한 시간으로 변경되었습니다.</span>
                </div>
                <?php
                    if($row->chk_notes_invoice == "Y"){
                ?>
                    <span style="color: red; line-height: 1.4;"><?=viewSQ($row->notes_invoice)?></span>
                <?php
                    }
                ?>
                <table class="invoice_tbl re_custom">
                    <colgroup>
                        <col width="150px">
                        <col width="35%">
                        <col width="150px">  
                        <col width="*">
                    </colgroup>
					
                    <tbody>
					<?php 
					       $order_info = order_info($row['order_gubun'], $row['order_no'], $row['order_idx']); 
						   $order_txt  = explode("|", $order_info);
					?>
                        <tr>
                            <th>날짜</th>
                            <td><?=$row['order_day']?>(<?=get_korean_day($row['order_day'])?>)</td>
                            <th>바우처 이름</th>
                            <td><?=$row['order_user_first_name_en']?> <?=$row['order_user_last_name_en']?></td>
                        </tr>
                        <tr>
                            <th>고객 연락처</th>
                            <td colspan="3"><?=$row['order_user_mobile']?></td>
                        </tr>
                        <tr>
                            <th>예약상품</th>
                            <td colspan="3"><?=$row['product_name']?>[ <?=$order_txt[0]?> <?=$order_txt[1]?> ]</td>
                        </tr>
                        <tr>
                            <th>총인원</th>
                            <td colspan="3"><?=$order_txt[3]?></td>
                        </tr>
                        <tr>
                            <th>티오프 요청시간</th>
                            <td><?=$order_txt[2]?></td>
                            <th>티오프 가능시간</th>
                            <td><?=$order_txt[2]?></td>
                        </tr>
                        <tr>
                            <th>불포함</th>
                            <td colspan="3"><?=viewSQ($not_included_product)?></td>
                        </tr>
                        <tr>
                            <th>안내사항</th>
                            <td colspan="3"><?=viewSQ($guide_contents)?></td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="tit_top">금액내역</h2>
                <table class="invoice_tbl table_row">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>에약항목</th>
                            <th>단가(원)</th>
                            <th>수량</th>
                            <th>합계(원)</th>
                            <th>합계(바트)</th>
                        </tr>					
                        <tr>
                            <th>그린피</th>
                            <td><?=number_format($golf_info['option_price'])?></td>
                            <td><?=$golf_info['option_cnt']?></td>
                            <th><?=number_format($golf_info['option_tot'])?></th>
                            <td><?=number_format($golf_info['option_tot_bath'])?></td>
                        </tr>
						<?php foreach ($golf_option as $data) { ?>
                        <tr>
                            <th>
                                <?php
                                    if($data['option_type'] == "vehicle"){
                                        if(!empty($data['option_name_new'])){
                                            echo $data['option_name_new'];
                                        }else {
                                            echo $data['option_name'];
                                        }
                                    }else {
                                        echo $data['option_name'];
                                    }
                                ?>
                            </th>
                            <td><?=number_format($data['option_price'])?></td>
                            <td><?=$data['option_cnt']?></td>
                            <th><?=number_format($data['option_tot'])?></th>
                            <td><?=number_format($data['option_tot_bath'])?></td>
                        </tr>
						<?php } ?>
                        <tr>
                            <th>총금액</th>
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
                            <th>중요 공지사항</th>
                            <td><?=viewSQ($notice_contents)?></td>
                        </tr>
                    </tbody>
                </table>

                <?=viewSQ($cancle_contents)?>
                
                <!-- <p class="cancle_txt">
                    취소 규정 : 결제 후 <span>19년11월09일 18시(한국시간)</span> 이전에 취소하시면 무료취소가 가능합니다.
                </p> -->
                <div class="btn_wrap_member flex_c_c">
                    <button type="button" class="invoice_member" id="btn_print">프린트</button>
                    <button type="button" class="invoice_member" id="btn_pdf" data-order_idx="<?=$row['order_idx']?>">PDF다운로드</button>
                    <button type="button" class="invoice_member">결제하러 가기</button>
                </div>
                <!-- <div class="invoice_note">
                    <p>- 인보이스를 보내드릴 때 룸 또는 좌석을 홀딩하지는 않으므로 결제가 늦어질 경우 예약이 불가할 수 있습니다.</p>
                    <p>- 인보이스가 발송될 때는 예약가능여부만 확인했을 뿐 예약이 확정된 것이 아닙니다.</p>
                    <p>- 결제가 곧 예약확정이 아님을 주의하세요. 간혹 여러가지 사유로 예약이 불가할 수 있습니다.</p>
                    <p>- 입금기한이 지나면 다시 예약을 접수시켜주셔야 합니다.</p>
                    <p>- 반드시 바우처를 받으셔야 예약이 확정된 것입니다.</p>
                    <p>- 나의 예약현황에서는 이 예약을 포함하여 모든 예약목록이 확인 가능합니다.</p>
                    <p>- 기타 문의사항은 로그인 후 나의 페이지 > 나의 1:1 게시판을 이용해주세요.</p>
                </div>
                <div class="invoice_info">
                    <h2>결제안내</h2>
                    <div class="txt">
                        <p>ㆍ한국 계좌 : 국민은행 636101-01-301315 (주) 토토부킹</p>
                        <p>ㆍ태국 계좌 : Kasikorn Bank 895-2-19850-6 (TOTO Booking Co., Ltd.)</p>
                        <p>ㆍ신용카드/간편결제 : 홈페이지에서 결제 진행. 결제 진행시 원하는 결제수단 선택할수있습니다.</p>
                    </div>
                </div>
                <div class="tit_note">
                    ※ 인보이스는 예약 또는 실제 이용 당사자에게 결제 청구용으로 발행된 문서로, 해당 인보이스를 다른 목적으로 사용 할 경우
                    (호텔 또는 제 3자에게 최저가 보장을 위한 목적 등) 민/형사상의 불이익을 당할 수 있습니다.
                </div> -->
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
        if($row["order_status"] == "C" || $row["order_status"] == "N"){
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
                <title>더투어랩</title>
                <link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">
                <style>
                    @media print {
                        body {
                            background: white !important;
                            margin: 0;
                            padding: 0;
                            color: #000;
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

                        .btn_wrap_member {
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

                        p {
                            margin: 0 !important;
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
        location.href='/pdf/invoice_golf?order_idx='+order_idx;
    });
</script>
