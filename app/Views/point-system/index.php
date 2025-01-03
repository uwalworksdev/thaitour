<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<style>
    .point_system {
        background-color: #f0f2f5;
        padding-top: 30px;
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
    }

    .point_system ._table td {
        padding: 20px 45px;
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
    <div class="inner wraper_content">
        <h2 class="sec_title">
            더투어랩 포인트 제도
        </h2>
        <p class="sub_title">더투어랩에서는 크게 2가지 방법으로 포인트를 적립할 수 있습니다.</p>
        <table class="_table">
            <colgroup>
                <col width="26%">
                <col width="*">
            </colgroup>
            <tbody>
                <tr>
                    <th rowspan="4">
                        <p>1. 상품 예약에 따른 적립</p>
                    </th>
                    <td>
                        <p class="title_box">적립대상</p>
                        <div class="content_box">
                            <p>더투어랩의 모든 상품을 예약 후 상품 이용하시면 포인트가 적립됩니다.</p>
                            <p>단, 현지 통화 결제 시에는 포인트 적립이 되지 않습니다.</p>
                            <p> * 항공권, 에어텔은 포인트 적립 대상이 아닙니다.</p>
                            <p> 바트화 결제 시에는 포인트가 적립되지 않습니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">등급별 혜택</p>
                        <div class="content_box">
                            <p>회원등급에 따른 포인트가 차등 지급됩니다.</p>

                            <div class="box_coin">
                                <div class="coin_item">
                                    <div class="coin_item_top">
                                        <p class="_ttl">실버회원</p>
                                        <p>회원 가입 후 확정 예약 건이 1건도 없는 회원님</p>
                                    </div>
                                    <div class="coin_item_bot">
                                        포인트 적립 없음
                                    </div>
                                    <div class="coin_item_img">
                                        <img src="/images/sub/poin-coin1.png" alt="">
                                    </div>
                                </div>
                                <div class="coin_item">
                                    <div class="coin_item_top">
                                        <p class="_ttl">골드회원</p>
                                        <p>확정된 예약 건이 1건 이상 되는 회원님</p>
                                    </div>
                                    <div class="coin_item_bot">
                                        현금결제 3% 적립, 신용카드, 간편결제 1.5% 적립
                                    </div>
                                    <div class="coin_item_img">
                                        <img src="/images/sub/poin-coin2.png" alt="">
                                    </div>
                                </div>
                                <div class="coin_item">
                                    <div class="coin_item_top">
                                        <p class="_ttl">VIP회원</p>
                                        <p>최근 5년 동안 결제 금액이 300만원 이상인 회원님</p>
                                    </div>
                                    <div class="coin_item_bot">
                                        현금결제 4% 적립, 신용카드, 간편결제 2.5% 적립
                                    </div>
                                    <div class="coin_item_img">
                                        <img src="/images/sub/poin-coin3.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <p>현금결제는 한화 무통장입금, 가상계좌, 실시간 계좌이체입니다.</p>
                            <p>• 여행사 회원의 등급은 별도의 기준이 적용됩니다.</p>
                            <p>여행사 회원 가입 후 더투어랩 승인을 받아 로그인하시면 포인트 적립에 대한 내용을 확인하실 수 있습니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">적립시점</p>
                        <div class="content_box">
                            <p>예약 → 결제 (바트화 결제 제외) → 예약 확정 → 예약 상품 사용 후 다음날(호텔은 체크아웃일 다음날) 이후 생생리뷰
                                또는 여행 후기 작성 시 적립</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">주의사항</p>
                        <div class="content_box">
                            <p>• 포인트가 적립되는 예약 건에 해당 포인트를 사용할 수는 없습니다.</p>
                            <p>• 바트화 결제 시에는 포인트 적립이 되지 않고, 기존 적립된 포인트를 사용할 수 없으며, 회원 등급에도 영향을 주지 않습니다.</p>
                            <p>• 포인트를 사용하는 예약 건에 대해서도 포인트를 차감한 결제금액에 대해서 다시 포인트를 적립해 드립니다.</p>
                            <p>
                                • 더투어랩 월드 (태국,베트남,대만,필리핀,괌을 제외한 전 세계 호텔)의 포인트 제도는 별도로 적용됩니다.
                                실버회원 1%, 골드회원 1%, VIP 회원 1.5%
                            </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th rowspan="4">
                        <p>2. 게시글 작성에 따른 적립</p>
                    </th>
                    <td>
                        <p class="title_box">적립대상</p>
                        <div class="content_box">
                            <p>각 게시판에 댓글, 더투어랩나침반 장소리뷰, 생생리뷰, 여행후기 작성에 참여하시는 모든 더투어랩 회원님께 포인트가
                                적립됩니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">적립 포인트</p>
                        <div class="content_box">
                            <p>• 댓 글 : 50 포인트 (최소 15자 이상) - 댓글 등록 적립은 하루 최대 3건에 한하여 적립됩니다.</p>
                            <p>• 몽키나침반 장소리뷰 : 100 포인트 (최소 50자 이상) - 하루 최대 10건에 한하여 적립됩니다.</p>
                            <p>• 생생리뷰 : 200 포인트 (최소 50자 이상) - 포인트는 해당상품 예약 건이 있는 경우에만 적립됩니다.</p>
                            <p>• 여행후기 : 1000 포인트 (최소 500자 이상) - 포인트는 예약 건이 있는 경우에만 적립됩니다.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">적립시점</p>
                        <div class="content_box">
                            <p>글을 올리는 즉시 포인트가 적립됩니다. (올린 글을 다시 삭제할 때에는 지급된 포인트도 차감됩니다.)</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="title_box">주의사항</p>
                        <div class="content_box">
                            <p>• 예약에 관련된 게시판 글이나 마이페이지 글은 포인트와 관계없습니다.</p>
                            <p>• 글 작성으로 적립되는 포인트는 회원 등급에 영향을 주지 않습니다.</p>
                            <p>
                                • 동일한 내용의 생생리뷰, 여행후기, 댓글 등을 반복적으로 붙여넣기하거나 관련 없는 내용 기재 등 '포인트 파밍'을 목적으로 한
                                게시물은 커뮤니티를 저해하는 행위로 간주하여 포인트가 삭감되며 해당 포인트로 결제된 예약은 취소될 수 있습니다.
                            </p>
                            <p>• 포인트는 해당 상품을 예약했을 경우에만 적립됩니다.</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="box_desc_detail">
            <div class="desc_title">
                <h3>포인트 상세안내</h3>
            </div>
            <div class="desc_content">
                <div class="item">
                    <span>1.</span>
                    <p>가치 : 1 포인트는 현금 1원과 동일한 가치를 갖습니다.</p>
                </div>
                <div class="item">
                    <span>2. </span>
                    <p>최소기준 : 1만원 이상 결제 시 5000포인트 이상 사용이 가능합니다.</p>
                </div>
                <div class="item">
                    <span>3.</span>
                    <p>포인트의 사용 : 모든 상품 예약을 자유롭게 현금처럼 사용 (바트화로 결제 시에는 사용 불가) 포인트를 이용한 예약 건에 대해서도 사용한 포인트 외 결제한 금액만큼
                        포인트 적립이 가능합니다.</p>
                </div>
                <div class="item">
                    <span>4.</span>
                    <p>유효기간 : 10년 (유효기간이 지나도록 사용되지 않은 포인트는 기한이 마감되면 자동 소멸됩니다.)</p>
                </div>
                <div class="item">
                    <span>5.</span>
                    <p>권한의 소유 : 본인 예약 및 본인 이름으로 예약확정서 발행될 때만 사용 가능합니다. 본인 사망이나 개인 사정, 법 집행 기타 어떤 이유로도 타인에게 양도, 매매, 교환
                        불가합니다. 몽키트래블 회원 탈퇴 시 모든 포인트가 소멸되며, 재사용은 불가합니다.</p>
                </div>
                <div class="item">
                    <span>6.</span>
                    <p>용도 : 적립된 포인트는 어떠한 경우에도 현금으로 반환되지 않고, 몽키트래블 상품을 예약할 때만 사용할 수 있습니다.</p>
                </div>
                <div class="item">
                    <span>7.</span>
                    <p>기타 : 포인트 제도는 몽키트래블에서 고객에게 제공해주는 혜택으로 몽키트래블 정책 변경 시 포인트 제도의 일부 또는 전체를 변경, 철회, 취소할 수 있습니다. 이로
                        인하여 이미 적립된 포인트의 가치에 영향을 줄 수도 있습니다. 또한 제도의 운영 시 몽키트래블 운영 방침에 따라 임의로 해석, 적용할 수 있습니다.</p>
                </div>


            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>