<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<section class="privacy">
    <?php
    echo view("center/center_term", ["tab5" => "on"]);
    ?>
    <div class="inner">
        <div class="contentArea">

            <div class="content_wrap">
                <!-- <?= viewSQ($policy['policy_contents']) ?> -->
            </div>

        </div>
    </div>
</section>
<style>
    .img_convert {
        width: 100%;

    }

    .img_convert .img_top {
        width: 100%;
        height: 678px;
        background: url("/images/sub/bg-conv.jpg") no-repeat center / cover;
        position: relative;
    }

    .img_convert .img_top .logo_pos {
        position: absolute;
        top: 44px;
        right: 55px;

    }

    .img_convert .img_top .title {
        font-size: 80px;
        letter-spacing: -3px;
        line-height: 1.1;
        color: #2a459f;
        font-weight: bold;
        font-family: "Pretendard";
        text-align: center;
        filter: drop-shadow(0px 15px 6.5px rgba(42, 69, 159, 0.14));
        padding: 95px 0 10px;
    }

    .img_convert .img_top .title p {
        font-size: 130px;
        color: #fff;
    }

    .img_convert .img_top .sub_title {
        font-size: 42px;
        letter-spacing: -2px;
        text-transform: uppercase;
        color: #ffffff;
        font-weight: bold;
        font-family: "Pretendard";
        filter: drop-shadow(0px 15px 6.5px rgba(76, 86, 173, 0.14));
        margin-bottom: 53px;
        text-align: center;
        line-height: 1.3;
    }

    .img_convert .img_top .desc {
        display: flex;
        gap: 20px;
        align-items: center;
        padding: 0 80px;
    }

    .img_convert .img_top .desc p {
        font-size: 18px;
        font-weight: 500;
        color: #fff;
        line-height: 1.4;
        letter-spacing: 0.3px;
    }

    .img_convert .title_ {
        padding: 56px 0 30px;
        font-size: 28px;
        font-weight: 700;
        border-bottom: 1px solid #dbdbdb;
    }

    .img_convert .ttl_table {
        margin-top: 26px;
        margin-bottom: 30px;
        font-size: 24px;
        font-weight: bold;

    }

    .img_convert table {
        border: 1px solid #dbdbdb;
        width: 100%;
    }

    .img_convert table td {
        border: 1px solid #dbdbdb;
        height: 158px;
        text-align: center;

    }

    .img_convert table td .tl {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 7px;
        justify-content: center;
        line-height: 1.3;
    }

    .img_convert table td span {
        font-size: 20px;
        font-weight: 400;
        color: #454545;
    }

    .img_convert table tr td.last {
        font-size: 16px;
        text-align: left;
        padding-left: 20px;
        line-height: 1.5;
        color: #454545;
    }

    .img_convert table {
        margin-bottom: 48px;
    }
</style>
<?php $this->endSection(); ?>