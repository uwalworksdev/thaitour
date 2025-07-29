<?php
helper('setting_helper');
$setting = homeSetInfo();
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">

<?php foreach ($result as $row): ?>
<?php endforeach; ?>

<div id="container_voice"> 
    <section class="golf_invoice hotel_invoice">
        <div class="inner">
             <!-- <div class="logo_voice only_web">
                <img src="/uploads/setting/<?= $setting['logos']?>" alt="">
            </div> -->
            <div class="only_mo">
                <div class="logo_voice">
                    <h2 class="tit_top">견적서</h2>
                    <img src="/uploads/setting/<?= $setting['logos']?>" alt="">
                    <p class="addr"><?= viewSQ(nl2br($setting['addr_thai']))?><br>
                        Thai - Registration No <?= $setting['comnum_thai']?><br>
                        Tel: <?= $setting['custom_service_phone_thai2']?>
                    </p>
                </div>
            </div>
            <div class="only_web">
                <div class="logo_voice">
                    <div class="logo_addr">
                        <img src="/uploads/setting/<?= $setting['logos']?>" alt="">
                        <p class="addr"><?= viewSQ(nl2br($setting['addr_thai']))?><br>
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
                        <tr>
                            <th>예약번호</th>
                            <td><?=$row->order_no?></td>
                            <th>예약날짜</th>
                            <td><?= esc(substr($row->order_date,0,10)) ?>(<?=get_korean_day(date("Y.m.d", strtotime($row->order_date)));?>)</td>
                        </tr>
                        <tr>
                            <th>예약자</th>
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
                        <tr>
                            <th>날짜</th>
                            <td>
                                <?= date("Y.m.d", strtotime($row->meeting_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->meeting_date))) . ")"  ?>
								<?php
									if($row->code_parent_category == "5403"){
								?>
									~
									<?= date("Y.m.d", strtotime($row->return_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->return_date))) . ")";?>
								<?php
									}
								?>
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
                            <th>출발지/도착지</th>
                            <td><?= !empty($row->departure_name_) ? $row->departure_name_ : $departure_name ?></span> / <span><?= !empty($row->destination_name_) ? $row->destination_name_ : $destination_name ?></td>
                            <th>총인원</th>
                            <td>성인 : <?= $row->people_adult_cnt ?? 0 ?>명, 소아: <?= $row->people_kids_cnt ?? 0 ?>명</td>
                        </tr>
                        <!-- <tr>
                            <th>픽업포함여부</th>
                            <td>불포함</td>
                            <th>미팅 장소</th>
                            <td>개별이동</td>
                        </tr> -->
                    </tbody>
                </table>
                <h2 class="tit_top">픽업포함여부</h2>
                <?php
                    if($row->code_parent_category == "5401"){
                ?>     
                    <div style="font-size:12pt;margin-top:20px;margin-bottom:10px">■ 가는 편</div>
                    <table cellpadding="0" cellspacing="0" summary="" class="invoice_tbl re_custom" style="table-layout:fixed">
                        <caption>
                        </caption>
                        <colgroup>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="20%"/>
                            <col width="*%"/>
                        </colgroup>
                        <tbody>
                        <tr>
                            <th style="text-align:center">항공편 명</th>
                            <th style="text-align:center">항공 도착 날짜</th>
                            <th style="text-align:center">항공 도착 시간</th>
                            <th style="text-align:center">목적지</th>
                            <th style="text-align:center">기타요청</th>
                        </tr>
                            <tr>
                                <td style="text-align:center">
                                    <input type="hidden" name="idx[]" value="<?= $order_cars_detail[0]["idx"] ?>">
                                    <?=$order_cars_detail[0]["air_code"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$order_cars_detail[0]["date_trip"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$order_cars_detail[0]["hours"]?> 시 <?=$order_cars_detail[0]["minutes"]?> 분
                                </td>
                                <td style="text-align:center">
                                    <?=$order_cars_detail[0]["destination_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=nl2br($order_cars_detail[0]["order_memo"])?>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    <?php 
                        if(count($order_cars_detail) > 1){
                    ?>
                        <div style="font-size:12pt;margin-top:20px;margin-bottom:10px">■ 오는 편</div>
                        <table cellpadding="0" cellspacing="0" summary="" class="invoice_tbl re_custom" style="table-layout:fixed">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="15%"/>
                                <col width="15%"/>
                                <col width="15%"/>
                                <col width="20%"/>
                                <col width="*%"/>
                            </colgroup>
                            <tbody>
                            <tr>
                                <th style="text-align:center">항공편 명</th>
                                <th style="text-align:center">항공 도착 날짜</th>
                                <th style="text-align:center">항공 도착 시간</th>
                                <th style="text-align:center">미팅 장소</th>
                                <th style="text-align:center">기타요청</th>
                            </tr>
                                <tr>
                                    <td style="text-align:center">
                                        <input type="hidden" name="idx[]" value="<?= $order_cars_detail[1]["idx"] ?>">
                                        <?=$order_cars_detail[1]["air_code"]?>
                                    </td>
                                    <td style="text-align:center">
                                        <?=$order_cars_detail[1]["date_trip"]?>
                                    </td>
                                    <td style="text-align:center">
                                        <?=$order_cars_detail[1]["hours"]?> 시 <?=$order_cars_detail[1]["minutes"]?> 분
                                    </td>
                                    <td style="text-align:center">
                                        <?=$order_cars_detail[1]["departure_name"]?>
                                    </td>
                                    <td style="text-align:center">
                                        <?=nl2br($order_cars_detail[1]["order_memo"])?>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    <?php } ?>
                <?php
                    }else if($row->code_parent_category == "5402"){
                ?>   
                    <table cellpadding="0" cellspacing="0" summary="" class="invoice_tbl re_custom" style="table-layout:fixed">
                        <caption>
                        </caption>
                        <colgroup>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="20%"/>
                            <col width="*%"/>
                        </colgroup>
                        <tbody>
                        <tr>
                            <th style="text-align:center">항공편 명</th>
                            <th style="text-align:center">항공 도착 날짜</th>
                            <th style="text-align:center">항공 도착 시간</th>
                            <th style="text-align:center">미팅 장소</th>
                            <th style="text-align:center">기타요철</th>
                        </tr>
                            <?php
                                foreach($order_cars_detail as $row_c){
                            ?>
                            <tr>
                                <td style="text-align:center">
                                    <input type="hidden" name="idx[]" value="<?= $row_c["idx"] ?>">
                                    <?=$row_c["air_code"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["date_trip"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["hours"]?> 시 <?=$row_c["minutes"]?> 분
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["departure_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=nl2br($row_c["order_memo"])?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>      
                    <?php
                        }else if($row->code_parent_category == "5403"){
                    ?>   
                    <table cellpadding="0" cellspacing="0" summary="" class="invoice_tbl re_custom" style="table-layout:fixed">
                        <caption>
                        </caption>
                        <colgroup>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="20%"/>
                            <col width="*%"/>
                        </colgroup>
                        <tbody>
                        <tr>
                            <th style="text-align:center">항공 도착 날짜</th>
                            <th style="text-align:center">항공 도착 시간</th>
                            <th style="text-align:center">출발지</th>
                            <th style="text-align:center">이동루트</th>
                            <th style="text-align:center">기타요철</th>
                        </tr>
                            <?php
                                foreach($order_cars_detail as $row_c){
                            ?>
                            <tr>
                                <input type="hidden" name="idx[]" value="<?= $row_c["idx"] ?>">
                                <td style="text-align:center">
                                    <?=$row_c["date_trip"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["hours"]?> 시 <?=$row_c["minutes"]?> 분
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["departure_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=nl2br($row_c["schedule_content"])?>
                                </td>
                                <td style="text-align:center">
                                    <?=nl2br($row_c["order_memo"])?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>      
                    <?php
                        }else if($row->code_parent_category == "5404"){
                    ?>   
                    <table cellpadding="0" cellspacing="0" summary="" class="invoice_tbl re_custom" style="table-layout:fixed">
                        <caption>
                        </caption>
                        <colgroup>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="*%"/>
                        </colgroup>
                        <tbody>
                        <tr>
                            <th style="text-align:center">항공 도착 날짜</th>
                            <th style="text-align:center">항공 도착 시간</th>
                            <th style="text-align:center">출발지(픽업호텔)</th>
                            <th style="text-align:center">경유지</th>
                            <th style="text-align:center">목적지</th>
                            <th style="text-align:center">기타요철</th>
                        </tr>
                            <?php
                                foreach($order_cars_detail as $row_c){
                            ?>
                            <tr>
                                <input type="hidden" name="idx[]" value="<?= $row_c["idx"] ?>">
                                <td style="text-align:center">
                                    <?=$row_c["date_trip"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["hours"]?> 시 <?=$row_c["minutes"]?> 분
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["departure_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["rest_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["destination_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=nl2br($row_c["order_memo"])?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>      
                    <?php
                        }else if($row->code_parent_category == "5405"){
                    ?>   
                    <table cellpadding="0" cellspacing="0" summary="" class="invoice_tbl re_custom" style="table-layout:fixed">
                        <caption>
                        </caption>
                        <colgroup>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="20%"/>
                            <col width="*%"/>
                        </colgroup>
                        <tbody>
                        <tr>
                            <th style="text-align:center">항공 도착 날짜</th>
                            <th style="text-align:center">항공 도착 시간</th>
                            <th style="text-align:center">출발지(픽업호텔)</th>
                            <th style="text-align:center">목적지</th>
                            <th style="text-align:center">기타요철</th>
                        </tr>
                            <?php
                                foreach($order_cars_detail as $row_c){
                            ?>
                            <tr>
                                <input type="hidden" name="idx[]" value="<?= $row_c["idx"] ?>">
                                <td style="text-align:center">
                                    <?=$row_c["date_trip"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["hours"]?> 시 <?=$row_c["minutes"]?> 분
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["departure_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["destination_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=nl2br($row_c["order_memo"])?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>      
                    <?php
                        }else {
                    ?>   
                    <table cellpadding="0" cellspacing="0" summary="" class="invoice_tbl re_custom" style="table-layout:fixed">
                        <caption>
                        </caption>
                        <colgroup>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="15%"/>
                            <col width="20%"/>
                            <col width="*%"/>
                        </colgroup>
                        <tbody>
                        <tr>
                            <th style="text-align:center">항공 도착 날짜</th>
                            <th style="text-align:center">항공 도착 시간</th>
                            <th style="text-align:center">출발지(픽업호텔)</th>
                            <th style="text-align:center">목적지(골프장명)</th>
                            <th style="text-align:center">기타요철</th>
                        </tr>
                            <?php
                                foreach($order_cars_detail as $row_c){
                            ?>
                            <tr>
                                <input type="hidden" name="idx[]" value="<?= $row_c["idx"] ?>">
                                <td style="text-align:center">
                                    <?=$row_c["date_trip"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["hours"]?> 시 <?=$row_c["minutes"]?> 분
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["departure_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=$row_c["destination_name"]?>
                                </td>
                                <td style="text-align:center">
                                    <?=nl2br($row_c["order_memo"])?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>      
                <?php
                    }
                ?>
                <h2 class="tit_top">금액내역</h2>
                <table class="invoice_tbl re_custom">
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
                            <td colspan="3"><?=number_format($row->real_price_bath)?></td>
                            
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
                    <colgroup>
                        <col width="150px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        
                        <tr>
                            <th>유의사항</th>
                            <td><?=viewSQ($notice_contents)?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="note_no_entry"> 
                    <!-- <img style="width: 18px; opacity:0.7" src="/images/sub/forbidden-sign-icon.png" alt="">  -->
                    <!-- <p style="color: #7d7d7d; font-size: 14px;">취소 규정: 결제 후 <span style="color : #17469E">24년 12월 18일 18시(한국시간)</span> 이전에 취소하시면 무료취소가 가능합니다.</p> -->
                    <?=viewSQ($cancle_contents)?>

                </div>
                <div class="btns_download_print">

                    <button type="button" class="btn_download" id="btn_pdf" data-order_idx="<?=$row->order_idx?>">PDF다운로드</button>
                    <button type="button" class="btn_download" id="btn_print">프린트</button>
                </div>
                <div class="table_wrapper invoice_table">
                    <?=viewSQ($policy_1["policy_contents"])?>
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

                        .golf_invoice {
                            padding: 20px 0 0 !important;
                        }

                        .golf_invoice .invoice_ttl {
                            margin-bottom: 0px !important;
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

                        .btns_download_print {
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
                            margin-bottom: 0 !important
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
        location.href='/pdf/invoice_car?order_idx='+order_idx;
    });
</script>