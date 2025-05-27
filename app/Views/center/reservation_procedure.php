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
        padding: 80px 60px;

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

    .list_steps {
        display: flex;
        gap: 43px;
        margin-top: 60px;
        flex-wrap: wrap;
    }

    .list_steps .step {
        width: calc((100% - 43px * 2) / 3);
        border: 2px solid #2a459f;
        border-radius: 43px;
        padding: 20px 30px 35px;
        position: relative;
    }

    .list_steps .step::before {
        content: '';
        position: absolute;
        width: 14px;
        height: 21px;
        top: 195px;
        right: -32px;
        background: url(/img/sub/arrow-right-blue_2.png);
    }

    .list_steps .step:nth-child(3)::before,
    .list_steps .step:nth-child(6)::before ,
    .list_steps .step:last-child::before {
        content: '';
        display: none;

    }

    .list_steps .step .heading {
        background-color: #2a459f;
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        border-radius: 22px;
        width: 150px;
        height: 42px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 25px;

    }

    .list_steps .step .title {
        font-size: 22px;
        font-weight: 700;
        color: #2a459f;
        margin-bottom: 17px;
    }

    .list_steps .step .desc {
        font-size: 18px;
        color: #757575;
        line-height: 1.4;
    }

    .list_steps .step .btn_go {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        background-color: #f5f7fa;
        border-radius: 21px;
        border: 1px solid #2a459f;
        margin-top: 23px;
        width: 190px;
        height: 42px;
        font-size: 18px;
        color: #2a459f;
    }
    @media screen and (max-width: 850px) {
.point_system .sec_title {
    text-align: center;
    font-size: 4.2rem;
    font-weight: 700;
    margin-bottom: 1.8rem;
}
.point_system .sub_title {
          font-size: 2.3rem;
}
.point_system .sub_title+.sub_title{
    margin-top: 0.8rem;
}
.list_steps {
    display: flex;
    flex-direction: column;
    gap: 7.5rem;
    margin-top: 6rem;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}
.list_steps .step{
    width: calc((100% - 1.5rem * 2) / 1);
    border: 2px solid #2a459f;
    border-radius: 6rem;
    padding: 2rem 3rem 3.5rem;
    position: relative;
}
.list_steps .step::before{
    content: '';
    position: absolute;
    width: 14px;
    height: 21px;
    top: unset;
    right: unset;
    left: 50%;
    bottom: -6rem;
    transform: translateX(-50%) rotate(90deg);
    background: url(/img/sub/arrow-right-blue_2.png);
}
.list_steps .step .heading {
    background-color: #2a459f;
    font-size: 3.2rem;
    font-weight: 700;
    color: #fff;
    border-radius: 3.2rem;
    width: 19rem;
    height: 5.2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    margin-bottom: 2.5rem;
}
.list_steps .step .title {
    font-size: 3.2rem;
    font-weight: 700;
    margin-bottom: 1.7rem;
}
.list_steps .step .desc {
    font-size: 2.8rem;
}
.list_steps .step .btn_go {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.8rem;
    background-color: #f5f7fa;
    border-radius: 3rem;
    border: 1px solid #2a459f;
    margin-top: 2.3rem;
    width: 30.1rem;
    height: 6rem;
    font-size: 2.8rem;
    color: #2a459f;
    margin-left: auto;
    margin-right: auto;
}
.list_steps .step .btn_go img{
          width: 3.1rem;
}
    .list_steps .step:nth-child(3)::before,
    .list_steps .step:nth-child(6)::before {
        display: block;
        content: ''; 
    }
    .list_steps .step:last-child::before {
        display: none;
        content: '';
    }
    }
</style>


<div class="container point_system">
    <?php echo view("center/center_term", ['tab8' => 'on']) ?>
    <div class="inner wraper_content">
        <h2 class="sec_title">
            예약절차
        </h2>
        <p class="sub_title">더투어랩은 자유여행을 위해 호텔이나 골프, 투어 등의 상품을 자유롭고도 간단하게<br>
            예상 견적을 산출해보며 여행 계획을 세울 수 있도록 설계되어 있습니다.</p>
        <p class="sub_title">원하시는 대로 상품을 선택하고 견적을 산출해보며, 자유여행의 참맛을 만끽해보시기 바랍니다.</p>
        <div class="list_steps">
            <div class="step">
                <p class="heading">STEP 01</p>
                <p class="title">간단한 회원가입</p>
                <p class="desc">몽키트래블[(주) 토토부킹] 회원가입은
                    최소한의 절차로 간단하고 안전하게
                    이루어집니다. 비회원도 검색과 상품 보기,
                    예약 등을 자유롭게 하실 수는 있지만,
                    포인트 적립은 이루어지지 않습니다.
                </p>
                <a href="#!" class="btn_go">
                    <span>회원가입하러 가기</span>
                    <img class="only_web" src="/img/btn/arrow-right-blue.png" alt="">
                    <img class="only_mo" src="/img/btn/arrow-right-blue_mo.png" alt="">
                </a>
            </div>
            <div class="step">
                <p class="heading">STEP 02</p>
                <p class="title">원하는 상품 선택</p>
                <p class="desc">홈페이지 상단의 메뉴를 클릭하신 후
                    원하는 상품을 찾아보시거나 상단의
                    메뉴바를 통해 직접 상품명을 검색후
                    찾아보실 수 있습니다.
                </p>
            </div>
            <div class="step">
                <p class="heading">STEP 03</p>
                <p class="title">원하는 상품 선택</p>
                <p class="desc">원하는 상품페이지에서 “예약 또는
                    견적산출하기”버튼을 클릭, 나오는 
                    예약신청서를 작성하신 후 예약을
                    진행합니다.<br>
                    동일한 상품은 중복 추가가 가능하지만, 
                    다른 상품을 추가하시려면 진행했던 
                    과정을 마치고, 다시 원하시는 상품을
                    선택, 예약하는 과정을 반복하셔야 합니다.
                    결제는 나중에 한 번에 하셔도 됩니다.
                </p>
            </div>
            <div class="step">
                <p class="heading">STEP 04</p>
                <p class="title">신청처리중</p>
                <p class="desc">예약이 접수되면 해당 업체에 예약가
                    능여부를 확인합니다.<br>
                    (예약 가능 여부 확인은 현지 업무시간에만
                    가능합니다. 단, 즉시확정 상품은 예약 가능
                    여부 즉시 확인이 가능합니다.)
                </p>
            </div>
            <div class="step">
                <p class="heading">STEP 05</p>
                <p class="title">견적서 수령</p>
                <p class="desc">예약 가능 시 이메일로 견적서
                    (결제청구서)를 발송해 드리며, 나의 예약 
                    현황 메뉴에서도 확인이 가능합니다.<br>
                    견적서 내역을 꼼꼼하게 확인하신 후 
                    결제해주시면 됩니다. 상품의 금액은 
                    한국외환은행에서 고시하는 바트화
                    현금 매도환율을 적용하여 원화금액으로 
                    계산됩니다.
                </p>
            </div>
            <div class="step">
                <p class="heading">STEP 06</p>
                <p class="title">결제하기</p>
                <p class="desc">결제수단은 계좌이체(가상계좌, 실시간
                    계좌이체, 무통장 원화송금), 신용카드,
                    휴대폰결제, 간편결제, 바트 송금이
                    있습니다. 회원 등급 및 결제수단에 따라
                    총 결제금액의 무려 1.5%~4% 포인트를
                    적립해드립니다. (단, 바트 송금 제외).
                    포인트는 다음 예약 시 현금과 똑같이
                    사용할 수 있습니다.견적서 발송 시점에
                    예약 가능 여부만 확인했을 뿐 룸(스파,
                    투어 등등)을 홀딩 해 놓지는 않기 때문에,
                    최대한 빨리 입금(결제) 해주시는 것을
                    권장합니다. 가격이 저렴한 대신 일일이
                    가능 여부를 확인해야 하는 예약 방식의
                    불가피한 상황임을 감안해주시기 바랍니다.
                </p>
            </div>
            <div class="step">
                <p class="heading">STEP 07</p>
                <p class="title">예약확정서 수령</p>
                <p class="desc">결제를 확인한 후 관리자는 해당 업체에
                    최종 예약을 요청합니다. 예약이 확정되면
                    업체로부터 예약확정서(Voucher) 확인을
                    받아 예약하신 회원님께 보내드립니다.<br>
                    <span style="color : #2a459f">견적서 :</span> 요청하신 대로 예약 가능하므로
                    결제하여 예약을 확정하라는 청구서<br>
                    <span style="color : #2a459f">예약확정서 :</span> 숙박권 또는 이용권. 예약이
                    확정되고 지불되었음을 알려주는
                    증명서로 체크인 시 제시돼야 합니다.
                </p>
            </div>
            <div class="step">
                <p class="heading">STEP 08</p>
                <p class="title">예약상품 이용</p>
                <p class="desc">예약 가능 시 이메일로 견적서
                    (결제청구서)를 발송해 드리며, 나의 예약
                    현황 메뉴에서도 확인이 가능합니다.
                    견적서 내역을 꼼꼼하게 확인하신 후
                    결제해주시면 됩니다. 상품의 금액은
                    한국외환은행에서 고시하는 바트화
                    현금 매도환율을 적용하여 원화금액으로
                    계산됩니다.
                </p>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>