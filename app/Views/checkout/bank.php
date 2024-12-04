<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<style>
    .customer_page_ {
        height: 50vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .customer_page_ .main_section_ {
        width: 75vw;
    }

    .customer_page_ .body_inner_ {

    }

    .customer_page_ .logo_area_ {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .customer_page_ .logo_image_ {

    }

    .customer_page_ .main_content_ {
        border-radius: 20px;
        margin-top: 30px;
        padding: 30px;
        width: 100%;
        background-color: rgba(219, 219, 219, 0.25);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 20px;
    }

    .customer_page_ .main_content_ .title_ {
        font-size: 24px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

    .customer_page_ .main_content_ .number_ {
        background-color: #FFFFFF;
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 32px;
        letter-spacing: 2px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

    .customer_page_ .main_content_ .sup_title_ {
        font-size: 24px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #252525;
    }

    .customer_page_ .main_content_ .content_ {
        font-size: 16px;
        letter-spacing: -1px;
        line-height: 51px;
        text-transform: uppercase;
        color: #2a459f;
    }
</style>

<div class="customer_page_">
    <div class="main_section_">
        <div class="body_inner_">
            <div class="logo_area_">
                <a href="/">
                    <img class="logo_image_" src="/images/sub/logo_w.png" alt="더투어랩 로고">
                </a>
            </div>
            <div class="main_content_">
                <div class="title_">우리은행</div>

                <div class="number_">
                    838689-79-686868
                </div>

                <div class="sup_title_">
                    (더투어랩)
                </div>

                <div class="content_">
                    ※ 예약 신청자와 결제자 이름이 다른 경우 1:1 게시판으로 결제 확인 요청을 꼭 해주세요.
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
