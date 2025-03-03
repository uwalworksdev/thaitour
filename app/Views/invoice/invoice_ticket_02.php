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
            <div class="logo_voice">
                <img src="/uploads/setting/<?= $setting['logos'] ?>" alt="">
            </div>
            <div class="invoice_ttl">
            </div>
            <div class="invoice_table">
                <h2 class="tit_top">예약자정보</h2>
                <table class="invoice_tbl">
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
                            <td>2023-09-13(수)</td>
                        </tr>
                        <tr>
                            <th>여행사(담당자)</th>
                            <td>Pattaya Adventure Co.,Ltd. (파타야 어드벤처 투어)</td>
                            <th>이메일</th>
                            <td>thaitouradventure@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
                <div class="top_flex flex_b_c">
                    <h2 class="tit_top">예약내역</h2>
                </div>
                <table class="invoice_tbl">
                    <colgroup>
                        <col width="150px">
                        <col width="35%">
                        <col width="150px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>날짜</th>
                            <td>2024-12-20(금)</td>
                            <th>여행자 이름</th>
                            <td>YANG HYUNGSUK</td>
                        </tr>
                        <tr>
                            <th>고객 연락처</th>
                            <td colspan="3">KR 01021004474 | TH 084-073-1020 | KR 0840731020</td>
                        </tr>
                        <tr>
                            <th>예약상품</th>
                            <td colspan="3">진리의 성전 입장권 | 주간 입장권 (08:00~16:30)</td>
                        </tr>
                        <tr>
                            <th>시작시간</th>
                            <td>08:00~16:30</td>
                            <th>총인원</th>
                            <td>성인 : 8명</td>
                        </tr>
                        <tr>
                            <th>픽업포함여부</th>
                            <td>불포함</td>
                            <th>미팅 장소</th>
                            <td>개별이동</td>
                        </tr>
                    </tbody>
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
                            <th>1인당 금액</th>
                            <td colspan="3">성인400바트</td>
                            
                        </tr>
                        <tr>
                            <th>금액</th>
                            <td colspan = "3">3,200바트 (성인400바트X8명)</td>
                            
                        </tr>
                        <tr>
                            <th>추가내역</th>
                            <td>0바트</td>
                            <th>총금액</th>
                            <td>3,200바트</td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice_golf_total flex_e_c">
                    <p>총 견적서 금액 : <span>954,284원</span> (24,400바트)</p>
                </div>
                <table class="invoice_tbl spe">
                    <colgroup>
                        <col width="250px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        
                        <tr>
                            <th>중요안내</th>
                            <td>상품등록 페이지에서 중요안내 연동해주세요</td>
                        </tr>
                    </tbody>
                </table>
                <div class = "note_no_entry"> <img style="width: 18px; opacity:0.7" src="/images/sub/forbidden-sign-icon.png" alt=""> <p style="color: #7d7d7d; font-size: 14px;">취소 규정: 결제 후 <span style="color : #17469E">24년 12월 18일 18시(한국시간)</span> 이전에 취소하시면 무료취소가 가능합니다.</p></div>
                <div class="btns_download_print">
                    <button class="btn_download">다운로드</button>
                    <button class="btn_download">프린트</button>
                </div>
                <div class="table_wrapper invoice_table">
                    <p style="margin : 20px 0; line-height: 1.4;" class="">견적서는 발송 시점의 예약 가능 여부만 확인하여 보내드리는 것이며, 예약을 잡아두지는 않습니다.<br>
                        따라서 결제가 늦어질 경우 예약이 불가능할 수 있으며, 결제 후 예약이 불발될 경우 전액 환불이 가능합니다.<br>
                        견적서를 받으신 후에는 다른 사람이 먼저 예약하기 전에 서둘러 결제해 주시는 것이 윈윈트래블 이용립입니다.
                    </p>
                    <table class="invoice_tbl">
                        <colgroup>
                            <col width="20%">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td style="color : #454545; background-color : #f2f2f2" colspan="2">
                                    <p style="display: flex; align-items: center;"><img style="opacity: 0.7;" src="/images/sub/warning-icon.png" alt=""><span style="margin-left: 10px; font-weight: 500;">결제방법</span></p>
                                </td>

                            </tr>
                            <tr>
                                <td>가상계좌</td>
                                <td>윈윈트래블 사이트에서 고유통장번호를 받아 입금 포인트 3~4% 적립. 공인인증서 무조건 필요.</td>
                            </tr>
                            <tr>
                                <td>실시간계좌이체</td>
                                <td>공인인증서 무조건 필요.</td>
                            </tr>
                            <tr>
                                <td>무통장 원화 송금</td>
                                <td>
                                    <p>예약자, 입금자가 다를 경우 연락주시기 바랍니다. 포인트 3~4% 적립. 공인인증서 불필요.</p>
                                    <p>- 한국 계좌 : <b>국민은행 636101-01-301315 (주)도도부킹</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>바트화 송금</td>
                                <td>
                                    <p>태국계좌 입금의 경우 입금후 꼭~ 유선상으로 또는 게시판을 통해 알려주셔야 입금확인됩니다.</p>
                                    <p>- 태국 계좌:<b> Kasikorn Bank 895-2-19850-6 (Totobooking)</b></p>
                                </td>
                            </tr>
                            <tr>
                                <td>신용카드</td>
                                <td>공인인증서 30만원 이상시 필요.</td>
                            </tr>
                            <tr>
                                <td>ARS 카드</td>
                                <td>
                                    <p>마이페이지 예약확인/결제 창에서 결제 상품 선택 후 결제방법 신용카드-ARS 선택.</p>
                                    <p>이 후 결제자 정보에 결제자 휴대전화번호를 입력 후 결제하기를 클릭해주시면 SMS 인증번호가 발송 됩니다.</p>
                                    <p> 인증번호를 메모하시고, SMS 발송번호로 전화하셔서 결제를 진행하시기 바랍니다</p>
                                </td>
                            </tr>
                            <tr>
                                <td>수기결제</td>
                                <td>불가피한 경우 관리자에게 카드번호와 유효기간을 알려주시면 결제대행 해드립니다. 공인인증서 불 필요.</td>
                            </tr>
                            <tr>
                                <td>휴대폰</td>
                                <td>한도 30만원 기본 (사용자 신용도에 따라 한도가 달라집니다.) 공인인증서 불필요.</td>
                            </tr>
                            <tr>
                                <td>포인트</td>
                                <td>포인트로 금액 결제, 공인인증서 불필요.</td>
                            </tr>
                            <tr>

                                <td style="background-color: #f2f2f2;" colspan="2">
                                    <p>- 결제 전에는 예약이 확정된 상태가 아닙니다. 결제 후 예약 확정 절차가 진행됩니다.</p>
                                    <p>- 결제가 글 예약 확정이 아님을 주의하세요! 간혹 여러 가지 사유로 예약이 불발될 수 있습니다.</p>
                                    <p>- 예약자와 결제자가 동일하지 않아도 되며, 무통장 입금시 예약자와 입금자명이 다르거나, 바트화 입금 시에는 꼭 확인 요청해 주시기 바랍니다.</p>
                                    <p>- 결제 후 마이페이지 > 예약확인/결제에서 예약 상태와 결제 정보를 통해 결제가 정상적으로 되었는지 직접 확인 할 수 있습니다.</p>
                                    <p>- 결제 후 예약확정서를 받으셔야 예약이 최종 확정된 것입니다.</p>
                                    <p>- 견적서는 예약 또는 실제 이용 당사자에게 결제 점구용으로 발행된 문서로 해당 견적서를 다른 목적으로
                                    사용할 경우(호텔 또는 제3자에게 최저가 보장을 요구하기 위한 목적 등) 민/형사상의 불이익을 당할 수 있습니다.</p>
                                    <p style="margin-top : 10px ">※ 결재와 동시에 예약확정을 원하시면 윈윈트래블 실시간 예약을 이용하세요.</p>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
            <div class="inquiry_qna">
                <p class="ttl_qna">본 메일은 발신전용 메일입니다. 문의 사항은 <span>Q&A</span>를 이용해 주시기 바랍니다.</p>
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