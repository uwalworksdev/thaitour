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
                            <td style="font-weight: 700;">[VCH] Sanctuary of Truth Museum</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>206 2 Soi Na Kluea 12, Muang Pattaya, Bang Lamung District, Chon Buri 20150</td>
                        </tr>
                        <tr>
                            <th>Tel</th>
                            <td>038 110 653</td>
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
                            <td>YANG HYUNGSUK</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>KR 01021004474</td>
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
                            <td colspan="3">145-564-957 (1)</td>

                        </tr>
                        <tr>
                            <th>Date</th>
                            <td style="color : red" colspan="3">20-Dec-2024(Fri)</td>

                        </tr>
                        <tr>
                            <th>Type</th>
                            <td colspan="3">Admission (08:00-16:30)</td>
                        </tr>
                        <tr>
                            <th>Persons</th>
                            <td>8.Adult(s)</td>
                            <th>Time</th>
                            <td>08:00-16:30</td>
                        </tr>

                        <tr>
                            <th>Remarks</th>
                            <td colspan="3">
                                <p>리리의 칭찬 종료 시간은 18:00이고, 마지막 입장시간은 </p>
                                <p>당일 예약은 예약확정서 발송 후 최소 2시간 뒤 매표소에서 교환장</p>
                            </td>

                        </tr>
                    </tbody>
                </table>

                <div class="info_order_txt">
                    <p style="font-weight: 700">• Booked by: Totobooking</p>
                </div>
                <div class="btns_download_print">
                    <button class="btn_download">다운로드</button>
                    <button class="btn_download">프린트</button>
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
</div>