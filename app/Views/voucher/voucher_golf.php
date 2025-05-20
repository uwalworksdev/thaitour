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
            <form action="" method="post" name="frm" id="frm">
                <input type="hidden" name="order_idx" value="<?=$result->order_idx?>">
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
                                <td><?=$result->addrs?></td>
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
                                <td>
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <?=$user_name?>
                                        <?php
                                            if($type == "admin"){
                                        ?>    
                                            <input type="text" style="width: 300px;" name="order_user_name_new" value="<?=$result->order_user_name_new?>">    
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
    
                                        <?=$user_mobile?>
                                        <?php
                                            if($type == "admin"){
                                        ?>    
                                            <input type="text" style="width: 300px;" name="order_user_mobile_new" id="order_user_mobile_new" value="<?=$result->order_user_mobile_new?>">    
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </td>
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
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <?=$order_date?>
                                        <?php
                                            if($type == "admin"){
                                        ?>    
                                            <input type="text" style="width: 300px;" name="order_date_new" value="<?=$result->order_date_new?>">    
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Persons</th>
                                <td colspan="3">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <?=$order_people?>
                                        <?php
                                            if($type == "admin"){
                                        ?>    
                                            <input type="text" style="width: 300px;" name="order_people_new" value="<?=$result->order_people_new?>">    
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>T-off Time</th>
                                <td>
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <?=$order_tee_time?>
                                        <?php
                                            if($type == "admin"){
                                        ?>    
                                            <input type="text" style="width: 150px;" name="t_times_en" value="<?=$result->t_times_en?>">    
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </td>
                                <th>Hole</th>
                                <td>
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <?=$order_hole?>
                                        <?php
                                            if($type == "admin"){
                                        ?>    
                                            <input type="text" style="width: 150px;" name="hole_en" value="<?=$result->hole_en?>">    
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <th>Fee</th>
                                <td colspan="3">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <?=$order_fee?>
                                        <?php
                                            if($type == "admin"){
                                        ?>    
                                            <input type="text" style="width: 300px;" name="fee_en" value="<?=$result->fee_en?>">    
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </td>
    
                            </tr>
                            <tr>
                                <th>Agent Memo</th>
                                <td colspan="3">
                                    <?=$order_memo?>
                                    <?php
                                        if($type == "admin"){
                                    ?>    
                                        <textarea name="order_memo_new" id="order_memo_new" style="width: 100%; height: 100px;"><?=$result->order_memo_new?></textarea>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Remarks</th>
                                <td colspan="3">
                                    <?=$order_remark?>
                                    <?php
                                        if($type == "admin"){
                                    ?>    
                                        <textarea name="order_remark_new" id="order_remark_new" style="width: 100%; height: 100px;"><?=$result->order_remark_new?></textarea>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Option</th>
                                <td colspan="3">
                                    <?php foreach ($option as $key => $item): ?>
                                        <?= $item['option_name'] ?> x <?= $item['option_cnt'] ?>대 = 
                                        금액 (<?= number_format($item['option_tot'])?>원) / (<?= number_format($item['option_tot'] / $item['baht_thai'])?>TH)</span>
                                        <?= $key == count($option) - 1 ? "" : "<br>" ?>										
                                    <?php endforeach; ?>
                                    <?php
                                        if($type == "admin"){
                                    ?>    
                                        <textarea name="order_option_new" id="order_option_new" style="width: 100%; height: 100px;"><?=$result->order_option_new?></textarea>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
    
                    <div class="info_order_txt">
                        <p style="font-weight: 700">• Booked by: <?= $setting['site_name_en'] ?></p>
                    </div>
    
                    <div class="box_notifi no-break">
                        <!-- <p class="tit">주요공지</p>
                        <span style="color : #7d7d7d; margin-bottom: 8px">2018년10월01일~2020년 12월31일</span>
                        <div style="background-color: #eee;" class="desc">
                            <p style = "margin-bottom: 4px">30분전 골프장 도착하신후 확정된 티오프시간전에 티오프 준비를 마치셔야 합니다.</p>
                            <p>늦으시는 경우 라운딩이 불가능하거나 장시간 대기할수 있으므로 꼭 시간내 엄수해주기 바랍니다.</p>
                        </div> -->
                        <?=viewSQ($policy_1["policy_contents"])?>
                    </div>
    
                    <div class="btns_download_print">
                        <button type="button" class="btn_download" id="btn_pdf" data-order_idx="<?=$result->order_idx?>">PDF다운로드</button>
                        <button type="button" class="btn_download" id="btn_print">프린트</button>
                        <?php
                            if($type == "admin"){
                        ?>    
                            <button type="button" style="background-color: #000000; color: #fff;" class="btn_download" id="btn_save">수정하기</button>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="invoice_note_">
                        <p  style="display: flex; align-items: center; margin-bottom: 13px;"><img style="opacity: 0.7; width : 20px;" src="/images/sub/warning-icon.png" alt=""><span style="margin-left: 10px;  font-size: 20px; font-weight: 600;">참고사항</span></p>
                        <p style="color: #eb4848;"><span>-</span><span>This voucher can be shown as captured picture with mobile phone.</span></p>
                        <p><span>-</span><span>티오프 시간이 날짜로 표시된 경우 해당날짜에 티오프 시간 확정하여 바우처 재발송해드립니다.</span></p>
                        <p><span>-</span><span>티오프 시간 확정전까지는 확정된 예약이 아니므로 예약이 불가능할 수도 있습니다.</span></p>
                        <p><span>-</span><span>이 바우처를 골프장 프론트에 제시한 후 해당 상품을 이용해 주세요. 단, 다른 연락처가 기재된 경우에는 그 곳과 통화하셔서 도움받으세요.</span></p>
                        <p><span>-</span><span>우천으로 라운딩을 중단해야 할 경우, 태국 골프장은 환불이 매우 어려우므로 반드시 위 연락처 또는 여행사에 연락한 뒤 중단여부를 결정하셔야 합니다.</span></p>
                        <p><span>-</span><span>1,2인 라운딩은 당일 골프장 예약현황에 따라 조인될 수도 있습니다. 특히 성수기 때에는 대부분 조인됩니다. 따라서 티오프 시각을 받으셨어도 조인될 때까지 기다리실 수도 있습니다.</span></p>
                        <p><span>-</span><span>골프장 내에서 다치거나, 동물이나 곤충에 의한 피해를 골프장에서 보상해주지 않으므로 라운딩 시 주의해주세요.</span></p>
                        <p><span>-</span><span>예약에 문제가 발생하거나 추가 예약이 필요하시면 다음 비상연락처로 연락주세요. 신속히 조치해 드리겠습니다. +66(0)80-709-0500 (KOREAN ONLY!!국제전화요금/취침시간에는 긴급건 ONLY)</span></p>
    
                    </div>
                </div>
            </form>
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
    $("#btn_save").click(function () {
        $.ajax({
            url: "/voucher/golf/save",
            type: "POST",
            data: $("#frm").serialize(),
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            },
            success: function (response, status, request) {
                alert(response.message);
                if(response.result == true){
                    location.reload();
                }
                return;
            }
        });
    });
</script>

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
        location.href='/pdf/voucher_golf?order_idx='+order_idx;
    });
</script>