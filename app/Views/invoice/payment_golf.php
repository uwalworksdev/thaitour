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
            <div class="logo_voice">
                <img src="/uploads/setting/<?= $setting['logos']?>" alt="">
            </div>
            <div class="invoice_ttl">
                <p>신청하신 예약 건, 결제 가능하여 견적서가 발송되었습니다.</p>
                <span>원하시는 날짜, 시간, 인원 등이 맞는지 예약 내용을 반드시 확인해 주신 후 결제 진행해 주세요. <br>
                        결제하시면 예약 확정 후 예약확정서가 발송됩니다. <br>
                        예약확정서 수령 후에도 예약확정서 상에 표시된 예약 정보 최종 확인을 부탁드립니다.</span>
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
                            <td>145-523-691</td>
                            <th>예약날짜</th>
                            <td>2024-12-03(화)</td>
                        </tr>
                        <tr>
                            <th>회원이름</th>
                            <td>김평진</td>
                            <th>이메일</th>
                            <td>lifeess@naver.com</td>
                        </tr>
                        <tr>
                            <th>전화번호</th>
                            <td colspan="3">KR 01022951902</td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="tit_top">예약내역</h2>
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
                            <td>2024-12-19(목)</td>
                            <th>여행자 이름</th>
                            <td>KIM PYOUNG JIN</td>
                        </tr>
                        <tr>
                            <th>여행자 연락처</th>
                            <td>KR 01022951902</td>
                            <th>여행자 이메일</th>
                            <td>lifeess@naver.com</td>
                        </tr>
                        <tr>
                            <th>예약상품</th>
                            <td colspan="3">섬밋 윈드밀 골프 클럽</td>
                        </tr>
                        <tr>
                            <th>예약옵션</th>
                            <td colspan="3">18홀 프로모션</td>
                        </tr>
                        <tr>
                            <th>총인원</th>
                            <td colspan="3">성인 : 2 명</td>
                        </tr>
                        <tr>
                            <th>티오프요청시간</th>
                            <td>06:00</td>
                            <th>티오프 가능시간</th>
                            <td>추후확정</td>
                        </tr>
                        <tr>
                            <th>불포함</th>
                            <td colspan="3" style="font-weight: bold">카트피, 캐디팁</td>
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
                            <th>
                            그린피</th>
                            <td>3,900 바트(1,950 바트Χ2명)</td>
                            <th>카트피</th>
                            <td>불포함</td>
                        </tr>
                        <tr>
                            <th>캐디피</th>
                            <td>900바트</td>
                            <th>추가내역</th>
                            <td>0바트</td>
                        </tr>
                        <tr>
                            <th>총금액</th>
                            <td colspan="3">4,800바트</td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice_golf_total flex_e_c">
                    <p>총 견적서 금액 : <span>205,776원</span> (4,800바트)</p>
                </div>
                <p class="cancle_txt">
                취소 규정 : 결제 후 <span>24년12월11일 18시(한국시간)</span> 이전에 취소하시면 무료취소가 가능합니다.
                </p>
                <div class="btn_wrap_member flex_c_c">
                    <button type="button" class="invoice_member">결제하러
                    가기</button>
                </div>
                <div class="invoice_note">
                    <p>- 예약을 잡아둔 상태가 아니므로 결제가 늦어질 경우 예약이 불가할 수 있습니다.</p>
                    <p>- 견적서 발송 시점의 예약 가능 여부만 확인되었을 뿐 아직 예약이 확정된 것이 아닙니다.</p>
                    <p>- 결제가 곧 예약 확정이 아님을 주의하세요. 확정 진행 단계에서 여러 가지 사유로 예약이 불발 될 수 있습니다.</p>
                    <p>- 결제 후 바우처를 받으셔야 예약이 최종 확정된 것입니다.</p>
                    <p>- 예약을 원치 않으실 경우 결제하지 않고 그대로 두시면 자동으로 취소됩니다.</p>
                    <p>- 결제 전 예약은 일정 시간이 지나면 결제 시한 만료 상태로 전환됩니다. 결제 시한 만료 후에는 다시 예약을 신청해 주세요.</p>
                    <p>- 마이페이지>예약확인/결제 에서는 이 예약을 포함하여 모든 예약목록이 확인 가능합니다.</p>
                    <p>- 기타 문의사항은 로그인 후 마이페이지 > 1:1 게시판을 이용해 주세요.</p>
                </div>
                <div class="invoice_info">
                    <h2>결제안내</h2>
                    <div class="txt">
                        <p>ㆍ<a href="/invoice/bank_info">한국계좌번호보기</a></p>
                        <p>ㆍ<a href="/invoice/bank_info_account">태국계좌번호 보기</a>
                        </p>
                        <p>ㆍ신용카드/간편결제 : 홈페이지에서 결제 진행. 결제 진행시 원하는 결제수단을 선택할 수 있습니다.</p>
                    </div>
                </div>
                <div class="tit_note">
                    ※ 견적서는 예약 또는 실제 이용 당사자에게 결제 청구용으로 발행된 문서로, 해당 견적서를 다른 목적으로 사용 할 경우(호텔 또는 제 3자에게 최저가 보장을 위한 목적 등) 민/형사상의 불이익을 당할 수 있습니다.
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
