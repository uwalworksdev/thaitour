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
                            <td style="font-weight: 700;">Lam Lukka Country Club</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>29 Moo 7 Lamsal, Lam Luk Ka Klong 11, Pathumthani</td>
                        </tr>
                        <tr>
                            <th>Tel</th>
                            <td>+66 (0)2 995 2300~1</td>
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
                            <td>JEONG HEEYONG</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>KR 01045799679</td>
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
                            <td colspan="3">143-421-991 (1)</td>

                        </tr>
                        <tr>
                            <th>Date</th>
                            <td style="color : red" colspan="3">14-Feb-2020(Fri) </td>

                        </tr>
                        <tr>
                            <th>Persons</th>
                            <td colspan="3">3 Adult(s)</td>
                        </tr>
                        <tr>
                            <th>T-off Time</th>
                            <td>08:14</td>
                            <th>Hole</th>
                            <td>18 Holes Morning</td>
                        </tr>
                        
                        <tr>
                            <th>Fee</th>
                            <td colspan="3">
                                <p>Green (Yes)/Caddy (Yes)/Cart (Yes)</p>
                            </td>

                        </tr>
                        <tr>
                            <th>Agent Memo</th>
                            <td colspan="3">
                                <p></p>
                            </td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td colspan="3">
                                <p></p>
                            </td>
                        </tr>
                        <tr>
                            <th>Option</th>
                            <td colspan="3">
                                <p></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="info_order_txt">
                    <p style="font-weight: 700">• Booked by: Totobooking</p>
                </div>

                <div class="box_notifi">
                    <p class="tit">주요공지</p>
                    <span style="color : #7d7d7d; margin-bottom: 8px">2018년10월01일~2020년 12월31일</span>
                    <div style="background-color: #eee;" class="desc">
                        <p style = "margin-bottom: 4px">30분전 골프장 도착하신후 확정된 티오프시간전에 티오프 준비를 마치셔야 합니다.</p>
                        <p>늦으시는 경우 라운딩이 불가능하거나 장시간 대기할수 있으므로 꼭 시간내 엄수해주기 바랍니다.</p>
                    </div>
                </div>

                <div class="btns_download_print">
                    <button class="btn_download">다운로드</button>
                    <button class="btn_download">프린트</button>
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