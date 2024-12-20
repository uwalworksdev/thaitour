<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<style>
    @media screen and (max-width : 850px) {
        
    }
</style>
<div class="completed-order-page">
    <div class="body_inner">
        <div class="container-card">
            <div class="img-con">
                <img src="/img/sub/confirm_order.png" alt="completed_order">
            </div>
            <h3 class="title-main-o">
                결제이 성공적으로<br>
                완료되었습니다.
            </h3>
            <p class="sub-title-o text-gray">
                결제이 완료되었습니다.<br>
                등록하신 메일 주소로 확인 메일을 보냈습니다.
            </p>
            <button class="btb-back-order" onclick="location.href='<?= $return_url ?? '' ?>'">메인으로 가기</button>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>