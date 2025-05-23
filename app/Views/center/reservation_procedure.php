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
    }

    .list_steps .step {
        width: calc((100% - 43px * 2) / 3);
        border: 2px solid #2a459f;
        border-radius: 43px;
        padding: 20px 30px 35px;
    }

    .list_steps .step .heading {
        background-color: #2a459f;
        font-size: 22px ;
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
        margin-bottom: 17px ;
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
                    <img src="/img/btn/arrow-right-blue.png" alt="">
                </a>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>