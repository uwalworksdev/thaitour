<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<link rel="stylesheet" href="/item/item_style.css">
<link rel="stylesheet" href="/item/item_style_responsive.css">

<div class="completed-order-page">
    <div class="body_inner">
        <div class="container-card">
            <div class="img-con">
                <img src="/images/mypage/mypage_member_out.png" alt="completed_order">
            </div>
            <h3 class="title-main-o">
                회원탈퇴가 완료되었습니다
            </h3>
            <div class="sub-title-o text-gray">
                <p class="result_inner_txt">그 동안 <span><?= _IT_SITE_NAME ?? '' ?></span>를 </p>
                <p class="result_inner_txt">사랑해주셔서 감사합니다.</p>
            </div>
            <button class="btb-back-order" onclick="location.href='/'">메인으로 가기</button>
        </div>
    </div>
</div>

<!-- //container End -->
<?php $this->endSection(); ?>
