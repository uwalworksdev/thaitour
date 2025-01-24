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
                            <td>112/151 Udomsuk Village, Paklok, Thalang, Phuket 83110 Thailand</td>
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
                            <td colspan="3">144-395-444 (1)</td>

                        </tr>
                        <tr>
                            <th>Date</th>
                            <td style="color : red" colspan="3">29-Sep-2023(Fri)</td>

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
                            <td>7.00 - 7.15</td>
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
                    <p style="font-weight: 700">• Booked by: Totobooking</p>
                </div>
                <div class="btns_download_print">
                    <button class="btn_download">다운로드</button>
                    <button class="btn_download">프린트</button>
                </div>
                <div class="invoice_note_">
                    <p  style="display: flex; align-items: center; margin-bottom: 13px;"><img style="opacity: 0.7; width : 20px;" src="/images/sub/info-icon-01.png" alt=""><span style="margin-left: 10px;  font-size: 20px; font-weight: 600;">참고사항</span></p>
                    <p style="color: #eb4848;"><span>-</span><span>This voucher can be shown as captured picture with mobile phone.</span></p>
                    <p><span>-</span><span>This voucher can be shown as captured picture with mobile phone.</span></p>
                    <p><span>-</span><span>호텔 체크인 시 프론트 데스크에 여권과 함께 바우처를 제시해 주세요.</span></p>
                    <p><span>-</span><span>이 객실 요금은 모두 지불되었으며 호텔의 디파짓 결제 요구는 부대시설 이용에 대한 보증금 목적이며, 을 요구합니다. 디파짓(보증금)은 해당국가 현금이나 신용카드 모두 가능하며 체크아웃시 환불 또는 신용카드 카드 승인 취소로 처리됩니다.</span></p>
                    <p><span>-</span><span>원칙적으로 어린이 조식비는 에이전시가 대납하지 않고, 투숙객이 호텔에 직접 지불합니다.</span></p>
                    <p><span>-</span><span>더블베드, 트윈베드의 베드타입과 고층배정, 허니문 특전, 인접한 객실 배정, 금연룸, 흡연룸 배정 등은호텔의 객실사정에 따라 달라집니다.<br> 즉, 확정사항이 아닌 요청사항일 뿐이므로 바우처에 기재해 드려도 확정되지 않는 경우가 간혹 발생합니다.
                            체크인시 다시 한번 호텔에 요청하시고, 기재된대로 요청사항이 이행되지 않더라도 여행사의 예약 잘못이 아닙니다.</span></p>
                    <p><span>-</span><span>예약에 문제가 발생하거나 추가 예약이 필요하시면 다음 비상연락처로 연락주세요. 신속히 조치해 드리겠습니다.
                            +66(0)80-709-0500 (KOREAN ONLY!!국제전화요금/취침시간에는 긴급건 ONLY)
                            태국내에서 로밍폰 사용시는 지역번호나 국가번호 없이 080-000-0000만 누르시면 됩니다</span></p>

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