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
                <p>요청하신 조건으로는 예약이 불가능하고, 예약 가능한 다른 조건으로 견적서가 발송되었습니다. 반드시 예약 내용(객실타입, 시간 등)을 확인하여 이 조건으로 예약 원하신다면 결제 진행해 주시고, 다른 상품으로 이용원하실 경우 다시 예약을 넣어주시기 바랍니다.</p>
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
					   <?php 
							$weekdays  = ["일", "월", "화", "수", "목", "금", "토"];
							$timestamp = strtotime(substr($row->order_m_date,0,10)); // 문자열 날짜를 타임스탬프로 변환
							$weekday   = $weekdays[date("w", $timestamp)];

                        ?> 
                        <tr>
                            <th>예약번호</th>
                            <td><?= esc($row->order_no) ?></td>
                            <th>예약날짜</th>
                            <td><?= esc(substr($row->order_date,0,10)) ?>(<?=$weekday?>)</td>
                        </tr>
                        <tr>
                            <th>여행사(담당자)</th>
                            <td>Pattaya Adventure Co.,Ltd. (파타야 어드벤처 투어)</td>
                            <th>이메일</th>
                            <td>thaitouradventure@gmail.com</td>
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
                            <td>KIM YOUNGHWAN</td>
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
                            <td colspan="3" style="color: red">클래식 오션 뷰 일반 더블</td>
                        </tr>
                        <tr>
                            <th>베드타입</th>
                            <td>DBL</td>
                            <th>객실수</th>
                            <td><?= $row->order_room_cnt ?> Room</td>
                        </tr>
                        <tr>
                            <th>성인조식포함여부</th>
                            <td>
								 <?php
								   if($breakfast == "N") {
									  echo "조식미포함";  
								   } else { 
									  echo "조식포함";  
								   }
								 ?>  								
                            </td>
                            <th>총인원</th>
                            <td>성인 <?=$adult?>명 아동 <?=$kids?>명</td>
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
                            <td><?= number_format($row->inital_price) ?>원</td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice_golf_total flex_e_c">
                    <p>총 인보이스 금액 : <span><?= number_format($row->inital_price) ?>원</span> (24,400바트)</p>
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
                </table>

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
                                    <p>- 견적서는 예약 또는 실제 이용 당사자에게 결제 점구용으로 발행된 문서로 해당 견적서를 다른 목적으로</p>
                                    <p>사용할 경우(호텔 또는 제3자에게 최저가 보장을 요구하기 위한 목적 등) 민/형사상의 불이익을 당할 수 있습니다.</p>
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