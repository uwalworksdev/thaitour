<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<link href="/css/center/img_convert.css" rel="stylesheet" type="text/css" />
<section class="privacy">
    <?php
    echo view("center/center_term", ["tab5" => "on"]);
    ?>
    <div class="inner">
        <div class="contentArea">

            <div class="content_wrap">
                <?= viewSQ($policy['policy_contents']); ?>
                <!-- <div class="img_convert">
                    <div class="img_top">
                        <div class="logo_pos">
                            <img src="/images/sub/logo_bg.png" alt="">
                        </div>
                        <h1 class="title">
                            더투어랩은 취소 변경해도
                            <p> 수수료가 없어요!</p>
                        </h1>
                        <p class="sub_title">
                            더투어랩 예약변경 및 취소정책
                        </p>

                        <div class="desc">
                            <img src="/images/sub/elephant-ic_.png" alt="">
                            <p>
                                단, 상품판매체호텔, 두어 업체, 스파 등에서 패널티가 발생하는 경우에는 최대한 노력해서 패널티 없는 방향으로<br>
                                도와드리고 있습니다만 패널티가 나오는 경우에는 패널티 제외금액 환불 또는 전액 환불 불가할 수 있습니다.<br>
                                ※ 2016년 5월 20일부터 적용됩니다(예약남기준)
                                <br>
                                <br>
                                입금전 변경/취소 수수료가 없습니다.<br>
                                입금 후 몽키트래블에서는 따로 수수료를 부과하지 않으며, 상품판매처에서 부과하는 패널티만 부과합니다.<br>
                                ※ 일반적인 취소정책이며, 아래내용보다 병력한 취소정책을 가지고 있는 성룡은 그 기준을 따름니다. (상동별고지)
                            </p>
                        </div>
                    </div>

                    <div class="content_">
                        <p class="title_"><span style="color : #2a459f">예약변경 및 취소정책</span> <span style="font-size : 18px"> [일반적인 취소정책이며, 아래 내용보다 엄격한 취소정책을 가지고 있는 상품은 그 기준을 따릅니다(상품별고지)]</span></p>
                        <div class="table">
                            <p class="ttl_table">
                                <span style="color: #2a459f;">호텔</span> 예약 변경 및 취소 수수료
                            </p>
                            <table>
                                <colgroup>
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="tl">성수기 <img src="/images/sub/dolar-5-ic.png" alt=""></p>
                                            <span>11월 1일 ~다음해의 3월 31일</span>
                                        </td>
                                        <td>
                                            <p class="tl">체크인 15일 이전</p>
                                            <span> 전액 환혜</span>
                                        </td>
                                        <td>
                                            <p class="tl">체크인 14일~3일</p>
                                            <span>1개의 통당 1박 요금 패널티</span>
                                        </td>
                                        <td>
                                            <p class="tl">체크인 3일이내 및 <br> 당일 취소 또는 노쇼</p>
                                            <span>전액 환불 불가</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tl">비수기 <img src="/images/sub/dolar-2-ic.png" alt=""></p>
                                            <span>4월 1일~10월 31일</span>
                                        </td>
                                        <td>
                                            <p class="tl">체크인 8일 이전</p>
                                            <span> 전액 환불</span>
                                        </td>
                                        <td>
                                            <p class="tl">체크인 7일~2일</p>
                                            <span>1개의 불당 1박 요금 패널티</span>
                                        </td>
                                        <td>
                                            <p class="tl">체크인 전일, 당일 취소 <br> 또는 노쇼</p>
                                            <span>전액 환불 불가</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="last" colspan="4">
                                            <p>-성수기내 피크시즌(12월 20일~1월 10일)의 경우 호텔 취소 정책이 몽키트래블 정책보다 엄격할 수 있습니다.</p>
                                            <p>- 해당기간에는 뒤 정책과 별개로 예약 또는 취소를 보다 신중하게 하시는 것이좋으며, 특별한 사유가 있을 경우 최대한 고객님 안에서 측과 협의해드리겠습니다.</p>
                                            <p>-제휴상품의 취소규정은 옹기제상품과 별도 적용되며, 제휴상품 취소규정은 예약시/예약후 나의 예약현황에서 확인이 가능합니다.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table">
                            <p class="ttl_table">
                                <span style="color: #2a459f;">골프 </span> 예약 변경 및 취소 수수료
                            </p>
                            <table>
                                <colgroup>
                                    <col width="33.33%">
                                    <col width="33.33%">
                                    <col width="33.33%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="tl">이용일 8일 이전</p>
                                            <span>전액 환불</span>
                                        </td>
                                        <td>
                                            <p class="tl">이용일 7일~4일이내</p>
                                            <span>이용일 7일~4일이내</span>
                                        </td>
                                        <td>
                                            <p class="tl">이용일 3일-당일</p>
                                            <span>전액 환불 불가</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table">
                            <p class="ttl_table">
                                <span style="color: #2a459f;">일일투어, 쇼, 스파, 레스토랑, 입장권 </span> 예약 변경 및 취소 수수료
                            </p>
                            <table>
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="tl">이용일 2일 이전 </p>
                                            <span>전액 환불 </span>
                                        </td>
                                        <td>
                                            <p class="tl">전일 또는 당일 </p>
                                            <span>전액 환불 불가</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table">
                            <p class="ttl_table">
                                <span style="color: #2a459f;">차량 </span> 예약 변경 및 취소 수수료
                            </p>
                            <table>
                                <colgroup>
                                    <col width="33.33%">
                                    <col width="33.33%">
                                    <col width="33.33%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="tl">2일 이전 </p>
                                            <span>전액 환불 </span>
                                        </td>
                                        <td>
                                            <p class="tl">전일 </p>
                                            <span>예약한 총 금액의 50% </span>
                                        </td>
                                        <td>
                                            <p class="tl">당일 </p>
                                            <span>전액 환불 불가</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text_desc_box">
                            <p class="left">예약변경 및 취소 시 <br> 유의사항</p>
                            <div class="right">
                                <p>모든 기준일은 한국시간 18:00 기준이며, 18:00 이후 접수된 취소변경건은 다음날 접수로 간주됩니다. </p>
                                <p>체크인 날짜 계산은 토, 일, 태국의 공휴일을 제외한 업무일기준 </p>
                                <p>취소하시는 예약건의 상품판매처 취소규정이 몽키트래블과 다를경우, 해당 상품판매처 규정을 따릅니다. </p>
                                <p>미리 공지한 개런티 부킹(환불불가 조건예약 등)은 남은기간에 관계없이 전액 환불 불가 </p>
                                <p>호텔의 경우 체크인을 한 이후의 이른 체크아웃(Early check out)의 경우, 나머지 기간에 대한 금액은 환불 불가합니다. </p>
                                <p>호텔 예약건의 경우 한국인을 제외한 외국인(외국여권 소지자포함)의 경우, 별도 외국인 요금이 적용될 수 있습니다. </p>
                                <p>2회 이상 잦은 변경 및 취소의 경우 전액 환불 가능한 날짜라고 해도 해당상품판매처에서 페널티를 부과할 수 있으니 참고부탁드립니다. </p>
                                <p>취소는 반드시 몽키트래블로 요청해주셔야하며, 직접 호텔 및 해당업체에 취소요청을 하시어 발생되는 불이익은 책임지지 않습니다. </p>
                            </div>
                        </div>

                        <div class="sec2">
                            <div class="heading">
                                <div class="inner">
                                    <h4>환불 정책 </h4>
                                </div>
                            </div>
                            <div class="content">
                                <div class="inner">
                                    <p>가상계좌 또는 원화 무통장 송금으로 결제해 주셨을 경우 환불 계좌번호를 알려주셔야 환불처리가 가능합니다. </p>
                                    <p>변경 또는 취소 후 알려주신 계좌로 당일내로 환불해 드립니다.
                                        단, 실시간 계좌이체(전액취소시), 신용카드 결제 취소는 카드결제 승인취소 처리를 해드리며, 금액이 복구되는데까지는 업무일 기준
                                        <span style="color : #2a459f">5~7일 정도 소요</span>됩니다.
                                    </p>
                                    <p>핸드폰 결제 취소의 경우 결제해 주신 당월 취소만 가능하며, 익월 취소의 경우 수수료 3.5%를 제외한 금액을 계좌로 환불해드립니다. </p>
                                    <div class="nation d-flex gap-40">

                                        <div class="col">
                                            <p class="name">
                                                <img src="/img/sub/flag-korea.png" alt="">
                                                <span>한국 계좌 </span>
                                            </p>
                                            <div class="cont">국민은행 636101-01-301315(주) 토토부킹 </div>
                                        </div>
                                        <div class="col">
                                            <p class="name">
                                                <img src="/img/sub/flag-thailand.png" alt="">
                                                <span>태국 계좌 </span>
                                            </p>
                                            <div class="cont">KASIKORN BANK 895-2-19850-6 (тото BOOKING)</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sec3">
                            <div class="inner">
                                <div class="warning_box">
                                    <div class="left">
                                        <img style="width : 100px" src="/img/sub/warning.jpg" alt="">
                                    </div>
                                    <div class="right">
                                        <p>변경 및 취소는 마이페이지의 1:1 게시판 또는 전화로 문의를 주신 후의 시간과 태국사무실의 업무시간을 기준으로 합니다. 즉, 토요일 <br>18:00(태국시간)에 글을 쓰셨을 경우에는 토요일 업무시간이 이미 끝나 처리가 불가하므로 월요일에 접수된 걸로 간주해 날짜를 계산합니다. </p>
                                        <br>
                                        <p>몽키트래블은 여행상품 자체를 판매하는 것이 아니라 고객님이 선택한 상품의 예약대행만 하므로, 예약한 상품의 과장광고, 허위 또는 부실,<br> 디파짓 등 모든 분쟁은 고객님과 해당 상품을 판매한 회사간에 직접 해결을 하셔야 합니다. <br>
                                            몽키트래블은 이에 대한 책임을 지지 않는 것을 알려드립니다.
                                        </p>
                                        <br>
                                        <p>
                                            업무일은 몽키트래블 근무일이 아닌 토,일요일과 태국의 공휴일을 제외한 날입니다.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

        </div>
    </div>

</section>

<?php $this->endSection(); ?>