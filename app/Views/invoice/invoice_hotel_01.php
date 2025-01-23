<?php
helper('setting_helper');
$setting = homeSetInfo();
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">
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
                            <td>144-361-971</td>
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
                    <span>요청하신 티오프 시간 예약이 불가능하여 가능한 시간으로 변경되었습니다.</span>
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
                            <td>2023-09-13(수) ~ 2023-09-15(금) / 2박</td>
                            <th>바우처 이름</th>
                            <td>KIM YOUNGHWAN</td>
                        </tr>
                        <tr>
                            <th>고객 연락처</th>
                            <td colspan="3">TH 0840731020 | TH 084-073-1020</td>
                        </tr>
                        <tr>
                            <th>예약상품</th>
                            <td colspan="3">인터컨티넨탈 파타야 리조트 (구. 쉐라톤 파타야)</td>
                        </tr>
                        <tr>
                            <th>예약가능 룸타입</th>
                            <td colspan="3" style="color: red">클래식 오션 뷰 일반 더블</td>
                        </tr>
                        <tr>
                            <th>베드타입</th>
                            <td>DBL</td>
                            <th>객실수</th>
                            <td>12 룸</td>
                        </tr>
                        <tr>
                            <th>성인조식포함여부</th>
                            <td>포함</td>
                            <th>총인원</th>
                            <td>성인 : 4 명</td>
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
                                객실당 단가</th>
                            <td>6,100바트</td>
                            <th>객실 금액</th>
                            <td>24,400바트(6,100바트 Χ 2박 Χ 2룸)</td>
                        </tr>
                        <tr>
                            <th>추가내역</th>
                            <td>0바트</td>
                            <th>총금액</th>
                            <td>24,400바트</td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice_golf_total flex_e_c">
                    <p>총 인보이스 금액 : <span>954,284원</span> (24,400바트)</p>
                </div>
                <table class="invoice_tbl spe">
                    <colgroup>
                        <col width="250px">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>
                                취소규정</th>
                            <td>날짜 및 시간(한국시간)</td>
                        </tr>
                        <tr>
                            <th>무료 취소</th>
                            <td>23년09월05일(화) 18시 이전</td>
                        </tr>
                        <tr>
                            <th>1박 취소수수료</th>
                            <td>23년09월05일(화) 18시 ~ 23년09월09일(토) 18시</td>
                        </tr>
                        <tr>
                            <th>50 % 취소수수료</th>
                            <td>23년09월09일(토) 18시 ~ 23년09월10일(일) 18시</td>
                        </tr>
                        <tr>
                            <th>환불 불가</th>
                            <td>23년09월10일(일) 18시 이후 취소 또는 노쇼(No show)</td>
                        </tr>
                        <tr>
                            <th>중요안내</th>
                            <td>
                                <p class="row_ttl">체크인 안내</p>
                                <p>채크인 15:00/체크아웃 정오</p>
                                <ul>
                                    <li>• 추가 인원에 대한 요금이 부과될 수 있으며, 이는 숙박 시설 정책에 따라 다릅니다.</li>
                                    <li>• 체크인 시 부대 비용 발생에 대비해 정부에서 발급한 사진이 부착된 신분증과 신용카드, 직물카드 또는 현금으로 보증금이 필요할 수 있습니다.</li>
                                    <li>• 특별 요정 사항은 체크인 시 이용 상황에 따라 제공 여부가 달라질 수 있으며 추가 요금이 부
                                        과될 수 있습니다. 또한, 반드시 보장되지는 않습니다.</li>
                                    <li>• 부대 비용 발생에 대비해 체크인 시 제시하는 신용카드상의 이름은 객실 예약 시 사용된 대표 예약자의 이름이어야 합니다.</li>
                                    <li>• 시설 내 주차 등을 예약하시려는 고객께서는 이 숙박 시설에 미리 연락해 주셔야 합니다.</li>
                                    <li>• 세금 ID-0105549106859</li>
                                    <li>• 이 숙박 시설에서 사용 가능한 결제 수단은 신용카드, 직불카드, 모바일 결제 현금입니다.</li>
                                    <li>• Alipay 등의 모바일 결제 옵션을 이용하실 수 있습니다.</li>
                                    <li>• 이 숙박 시설은 도착 전에 고객의 신용카드를 사전 승인할 수 있습니다.</li>
                                    <li>• 무소음 객실이 보장되지는 않습니다.</li>
                                    <li>• 이 숙박 시설은 안전을 위해 소화기, 보안 시스템, 구급상자, 방범창 등을 갖추고 있습니다.</li>
                                    <li>• 이 숙박 시설은 위생을 위한 노력(메리어트)의 노력(메리어트)의 청소 및 소독 지침을 준수합니다. 고객 정책과 문화적 기준이나 규범은 국가 및 숙박 시설에 따라 다를 수 있습니다. 명시된 정 책은 숙박 시설에서 제공했습니다.</li>

                                </ul>
                                <p>• 이 숙박 시설은 위생을 위한 노력(메리어트)의 노력(메리어트)의 청소 및 소독 지침을 준수합니다.
                                    고객 정책과 문화적 기준이나 규범은 국가 및 숙박 시설에 따라 다를 수 있습니다. 명시된 정 책은 숙박 시설에서 제공했습니다.</p>
                                <p>*숙박 시설에서 다음 요금을 결제하셔야 합니다.</p>
                                <p>[필수]</p>
                                <p>체크인 또는 체크아웃 시 숙박 시설에서 다음 요금을 청구할 수 있습니다(요금에는 해당 세 급이 포함될 수 있음).</p>
                                <p>• 보증금: THB 2000(1박기준)</p>
                                <p>이 숙박 시설에서 제공한 모든 요금 정보가 포함되어 있습니다.</p>
                                <p>[선택]</p>
                                <p>• 뷔페아침 식사 요금: 성인 THB 883. 어린이 THB 482(대략적인 금액)</p>
                                <p>• 공항 셔틀 요금: 차량 1대당 THB 2500(편도, 정원 4명)</p>
                                <p>• 간이 최대 이용 요금: 1박 기준, THB 1700.0</p>
                                <p>• 시설 이용 요금은 다음 항목을 포함합니다: 스파</p>
                                <p>위 목록에 명시되지 않은 다른 항목이 있을 수 있습니다. 요금 및 보증금은 세전 금액일 수 있 으며 변경될 수 있습니다.</p>

                               <p class="row_ttl"> 출발 전 알아들 사항</p>
<p>• 마사지 서비스 및 스파 트리트 및 스파 트리트먼트의 경우 사전 예약이 필요 합니다. 예약 확인 메일에 나와 있는 연락처 정보로 도착 전에 호텔에 연락하여 예약하실 수 있습니다.</p>
<p>• 만 12세 이하 아동은 부모 또는 보호자와 같은 객실에서 침구를 추가하지 않고 이용할 경우 무료로 숙박할 수 있습니다(최대 2명).</p>
<p>• 등록된 고객만 객실에 허용됩니다.</p>
<p>• 이용 상황에 따라 객실 연결이 가능하며, 예약 확인 메일에 나와 있는 번호로 숙박 시설에 직 접 연락하여 요청하실 수 있습니다.</p>
<p>• 비대면 체크인, 비대면 체크아웃 서비스를 이용하실 수 있습니다.</p>
<p>• 이 숙박 시설에서는 고객의 모든 성적 지향과 성 정체성을 존중합니다(성소수자(LGBTQ+) 환영).</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="cancle_txt">
                    ※ 무료 취소가 불가능한 기간이라도 서류로 증명 가능한 특별한 사유가 있는 경우 문의주시면 최대한 무료로 받을 수 있도록 해드립니다.
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
                        <p>ㆍ한국 계좌 : 국민은행 636101-01-301315 (주) 토토부킹</p>
                        <p>ㆍ태국 계좌 : Kasikorn Bank 895-2-19850-6 (Totobooking)</p>
                        <p>ㆍ신용카드/간편결제 : 홈페이지에서 결제 진행. 결제 진행시 원하는 결제수단 선택할수있습니다.</p>
                    </div>
                </div>
                <div class="tit_note">
                    ※ 견적서는 예약 또는 실제 이용 당사자에게 결제 청구용으로 발행된 문서로, 해당 견적서를 다른 목적으로 사용 할 경우
                    (호텔 또는 제 3자에게 최저가 보장을 위한 목적 등) 민/형사상의 불이익을 당할 수 있습니다.
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