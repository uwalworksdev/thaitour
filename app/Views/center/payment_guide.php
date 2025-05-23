<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<style>
    .point_system {
        background-color: #f0f2f5;
        padding-top: 1px;
        padding-bottom: 100px;
    }

    .point_system .wraper_content {
        background-color: #fff;
        border-radius: 10px;
        padding: 80px 30px;

    }

    .point_system .sec_title {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .point_system .sub_title {
        text-align: center;
        font-weight: 500;
        color: #757575;
        line-height: 1.5;

    }

    .point_system .sub_title+.sub_title {
        margin-top: 8px;
    }


    .point_system ._table {
        margin-top: 80px;
        border-top: 2px solid #dbdbdb;
        border-bottom: 2px solid #dbdbdb;
        width: 100%
    }

    .point_system ._table tr {
        border-bottom: 1px solid #dbdbdb;
    }

    .point_system ._table th {
        background-color: #fafafa;
        font-size: 18px;
        font-weight: 700;
        position: relative;
    }

    .point_system ._table th p {
        position: absolute;
        top: 20px;
        width: 100%;
        text-align: left;
        padding-left: 30px;
        font-size: 24px;
    }

    .point_system ._table td {
        padding: 20px 0 20px 45px;
        border-bottom: 1px solid #dbdbdb;
    }


    .point_system ._table .title_box {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .point_system ._table .content_box p {
        color: #757575;
        font-size: 17px;
        line-height: 1.4;
    }

    .point_system ._table .box_coin {
        display: flex;
        padding-left: 78px;
        padding-top: 128px;
        margin-bottom: 46px;
        gap: 40px;
    }


    .point_system ._table .box_coin .coin_item {
        position: relative;
        width: 180px;
        text-align: center;
    }

    .point_system ._table .box_coin .coin_item .coin_item_top {
        height: 140px;
        width: 100%;
        border-radius: 24px;
        background-color: #f6f6f8;
        position: relative;
        z-index: 2;
        padding: 13px;



    }

    .point_system ._table .box_coin .coin_item .coin_item_top p {
        font-size: 15px;
        padding-top: 14px;
    }

    .point_system ._table .box_coin .coin_item .coin_item_top p._ttl {
        color: #2a459f;
        font-size: 18px;
        font-weight: 800;
        padding-bottom: 8px;
        padding-top: 0;
        border-bottom: 1px solid #dbdbdb;
    }

    .point_system ._table .box_coin .coin_item .coin_item_img {
        position: absolute;
        top: -85px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
        width: 133px;
    }


    .point_system ._table .box_coin .coin_item .coin_item_bot {
        margin-top: 20px;
        font-size: 16px;
        font-weight: 500;
        line-height: 1.4;
    }

    .point_system .box_desc_detail {
        margin-top: 80px;
        padding: 35px 55px;
        border: 1px solid #dbdbdb;
        border-radius: 10px;
    }

    .point_system .box_desc_detail .desc_title h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 30px
    }

    .point_system .box_desc_detail .item {
        display: flex;
        color: #454545;
        gap: 4px;
        margin-bottom: 8px;
        line-height: 1.4;
    }
</style>


<div class="container point_system">
    <?php echo view("center/center_term", ['tab7' => 'on']) ?>
    <div class="inner wraper_content">
        <h2 class="sec_title">
            결제안내
        </h2>
        <p class="sub_title"><span style="color : #17469e">더투어랩의 모든 상품은 이용 전 결제를 완료해 주셔야하며, 현장결제는 불가능합니다. </span>
        </p>
        <p class="sub_title">
            계좌이체, 신용카드, 간편결제, 핸드폰결제 등 다양한 방법으로 결제가 가능합니다. 국내 업체 결제시스템을 이용하므로 예약시 <br>
            해외원화결제가 아닌 국내원화결제로 처리, 원화금액 그대로 결제되며 해외 결제 수수료가 추가되지 않습니다.
        </p>
        <table class="_table">
            <colgroup>
                <col width="26%">
                <col width="*">
            </colgroup>
            <tbody>
                <tr>
                    <th rowspan="5">
                        <p>결제방법</p>
                    </th>
                    <td>
                        <p class="title_box">1. 무통장 입금(원화)</p>
                        <div class="content_box">
                            <p>총 예약금액의 3~4%의 몽키 포인트 적립됩니다.</p>
                            <p>• 계좌입금 : 직접 은행계좌로 송금해주세요. <국민은행 636101-01-301315 (주) 토토부킹.</p>
                                    <p>• 가상계좌 : 원하는 은행의 가상계좌번호를 발급해드리며, 해당 계좌로 최종결제금액을 입금해주세요.</p>
                                    <p>• 실시간계좌이체 : 인터넷뱅킹에 가입된 경우에 이용 가능하며, 공인인증서가 필요합니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">2. 신용카드</p>
                        <div class="content_box">
                            <p>• 일반 : PC나 모바일로 신용(체크)카드 결제</p>
                            <p>• ARS : 휴대폰 ARS로 신용(체크)카드 결제</p>
                            <p>• 수기결제 : 결제가 잘 안될경우 1:1게시판에 카드번호와 유효기간을 알려주시면 수기결제대행이 가능합니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">3. 간편결제</p>
                        <div class="content_box">
                            <p>사용을 위해서는 각 서비스별로 사전 등록이 필요합니다.</p>
                            <p>• 네이버페이 : https://pay.naver.com</p>
                            <p>• 카카오페이 : 카카오톡 [더보기 > pay > (오른쪽 상단 설정 아이콘) > 나의 카카오페이 > 카드 ] 메뉴를 통해서 가입 및 카드등록</p>
                            <p>• 스마일페이 : https://www.mysmilepay.com</p>
                            <p>• 페이코 : https://www.payco.com</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">4. 휴대폰결제</p>
                        <div class="content_box">
                            <p>이동통신사의 익월취소 불가 정책에 따라 결제일 익월 취소시 3% 수수료 차감 후 환불됩니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">5. 바트입금</p>
                        <div class="content_box">
                            <p>포인트가 적립되지 않습니다..</p>
                            <p>• 입금계좌 : Kasikorn Bank 895-2-19850-6 (Totobooking)</p>
                            <p>• 바트 결제시에는 입금후 꼭 연락을 주셔야 입금확인됩니다.</p>
                            <p>• 현장 결제는 불가능하며 반드시 선결제해주셔야 예약확정됩니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p>결제기한</p>
                    </th>
                    <td>

                        <div class="content_box">
                            <p>결제기한은 따로 없습니다.</p>
                            <p>견적서는 발송 시점의 예약 가능 여부만 확인하여 보내드리는 것이며, 예약을 잡아두지는 않습니다.</p>
                            <p>따라서 결제가 늦어질 경우 예약이 불가능할 수 있으며, 결제 후 예약이 불발될 경우 전액 환불이 가능합니다.</p>
                            <p>견적서를 받으신 후에는 다른 사람이 먼저 예약하기 전에 서둘러 결제해 주시는 것이 몽키트래블 이용팁입니다.</p>
                            <br>
                            <p>※ 견적서 발행 후 장시간 결제가 되지 않거나, 예약처리 가능한 시간이 지날 경우 결제시한 만료로 상태가 바뀔수 있습니다.</p>
                            <p>※ 단, 일부 실시간 예약상품(다이나믹상품, 제휴상품 등)은 예약 후 30분 내 결제가 완료되어야하며, 미결제시 자동 취소됩니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th rowspan="5">
                        <p>신용카드 사용안내 </p>
                    </th>
                    <td>
                        <p class="title_box">1. 대상카드</p>
                        <div class="content_box">
                            <p>• 국내카드 : 국민, 신한, 비씨, 롯데, 현대, 삼성 등 대한민국에서 발행되는 모든 신용카드</p>
                            <p>• 해외카드 : VISA, MASTER, JCB (※ 결제방법 중 신용카드-일반-KCP 선택 후 결제 / PC에서만 가능, 모바일 불가)</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">2. 결제시스템</p>
                        <div class="content_box">
                            <p>• 개별 카드사와 계약을 맺는 방식이 아닌 우리나라 최대, 최고의 결제대행 업체들과 계약하여 안전하고 정확한 결제를 보장합니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">3. 대행 업체</p>
                        <div class="content_box">
                            <p>• 신용카드 : 이니시스, KCP</p>
                            <p>• 간편결제 : 네이버페이, 카카오페이, 스마일페이, 페이코</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">4. 카드결제 확인 및 영수증 출력</p>
                        <div class="content_box">
                            <p>• 각 결제대행사 사이트에 접속하시면 카드결제내역 확인 및 영수증 출력이 가능합니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">5. 주의사항</p>
                        <div class="content_box">
                            <p>• 신용카드결제와 송금 시 상품대금은 동일하지만 송금 시 몽키포인트 적립률이 더 높습니다. (신용카드/간편결제 1.5~2.5%, 원화송금 결제 3~4% 몽키포인트 적립)</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection(); ?>