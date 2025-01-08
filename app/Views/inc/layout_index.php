<?php
try {
    helper("setting");
    $setting = homeSetInfo();
} catch (\Throwable $th) {
    die("Something went wrong!");
}
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php echo view('inc/header', ["setting" => $setting]); ?>
<style>
    .layout_loading {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .layout_loading.open {
        display: flex;
    }

    .load-container {
        position: absolute;
        margin: auto;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 100px;
    }

    .blocks {
        position: relative;
        z-index: 1000;
        width: 6px;
        height: 30px;
        margin-left: 6px;
        float: left;
        background-color: var(--bs-point);
        animation: spiner 1s infinite ease-in-out;
    }

    .blocks:first-child {
        margin-left: 0;
    }

    .b-one {
        animation-delay: -1s;
    }

    .b-two {
        animation-delay: -0.9s;
    }

    .b-three {
        animation-delay: -0.8s;
    }

    .b-four {
        animation-delay: -0.7s;
    }

    .b-five {
        animation-delay: -0.6s;
    }

    @keyframes spiner {
        0% {
            transform: scaleY(1);
        }
        50% {
            transform: scaleY(2);
        }
        100% {
            transform: scaleY(1);
        }
    }
</style>
<div class="layout_loading" id="layout_loading">
    <div class="load-container">
        <div class="blocks b-one"></div>
        <div class="blocks b-two"></div>
        <div class="blocks b-three"></div>
        <div class="blocks b-four"></div>
        <div class="blocks b-five"></div>
    </div>
</div>
<script>
    function LoadingPage() {
        let layout_loading = $('#layout_loading');

        if (layout_loading.hasClass('open')) {
            layout_loading.removeClass('open');
        } else {
            layout_loading.addClass('open');
        }
    }

    function convertNum(num) {
        // let number = Number(num);
        // return number.toLocaleString();
        let number = Number(num);
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
</script>

<main>
    <?php $banner_ = getLeftBottomBanner(); ?>

    <div class="main_sale_banner flex__c">
        <?php if ($banner_): ?>
            <a href="/time_sale/list">
                <img src="/data/bbs/<?= $banner_['ufile5'] ?? $banner_['ufile6'] ?>" alt="main_sale_img">
            </a>
        <?php endif; ?>
        <a href="/coupon/list">
            <?php echo getCouponList(); ?>
            <!-- <div class="coupon_sale">
                <img src="/images/main/coupon_sale_img.png" alt="">
                <div class="tit_cou">
                    <p>첫 예약 축하 5000
                    포인트 쿠폰</p>
                </div>
            </div> -->
        </a>
    </div>
    <?php echo $this->renderSection('content'); ?>
    <?php echo view("inc/sidebar_inc"); ?>
    <?php echo view("inc/popup_login"); ?>
</main>
<?php echo view('inc/footer', ["setting" => $setting]); ?>
<script>
    // $(document).ready(function () {
    //     let currentHeader = $('#currentHeader').text();
    //     if (currentHeader) {
    //         let number = parseInt(currentHeader);
    //         $('.flex_header_top_content_list').find('a').eq(number - 1).addClass('active_');
    //     }
    // })
</script>
