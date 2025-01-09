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
    <?php 
        $banner_ = getLeftBottomBanner(); 
        $time_sale_list = getTimeSale()->findAll();

        $currentDateTime = new DateTime();
    ?>

    <div class="main_sale_banner flex__c">
        <div class="time_sale_banner flex__c">
            <?php 
                if(count($time_sale_list) <= 0){
            ?>
                <?php if ($banner_): ?>
                    <a href="/time_sale/list">
                        <img src="/data/bbs/<?= $banner_['ufile5'] ?? $banner_['ufile6'] ?>" alt="main_sale_img">
                    </a>
                <?php endif; ?>
            <?php
                }else {
                    $i = 1;
                    foreach($time_sale_list as $time_sale){
                        $url = "#";
                        if(!empty($time_sale["url"])){
                            $url = $time_sale["url"];
                        }

                        if(!empty($time_sale["ufile1"])){
                            $img = "/data/bbs/" . $time_sale["ufile1"];
                        }else{
                            $img = "";
                        }

                        $product_idx = getProductIdFromUrl($url);

                        $product_price = getViewProduct($product_idx)["product_price"];

                        if(!empty($time_sale["e_date"]) && !empty($time_sale["e_time"])){
                            $endDateTime = $time_sale["e_date"] . " " . $time_sale["e_time"];
                            $endDateTimeObj = new DateTime($endDateTime);
                            $interval = $currentDateTime->diff($endDateTimeObj);

                            $hour = ($interval->d * 24) + $interval->h;
                            $hour = str_pad($hour, 2, '0', STR_PAD_LEFT);;
                            $minute = str_pad($interval->i, 2, '0', STR_PAD_LEFT);
                            $second = str_pad($interval->s, 2, '0', STR_PAD_LEFT);
                        }
            ?>
                <a href="<?=$url?>">
                    <div class="time_sale_wrap <?php echo $i == 1 ? "active" : ""?>">
                        <div class="time_sale_clock flex_c_c">
                            <i></i>
                            <span>타임세일</span>
                        </div>
                        <div class="time_sale_product">
                            <img src="<?=$img?>" alt="<?=$time_sale["rfile1"]?>">
                            <div class="time_sale_ttl">
                                <p class="subject"><?=$time_sale["subject"]?></p>
                                <p class="price"><?=number_format($product_price)?> 바트</p>
                            </div>
                        </div>
                        <div class="time_remaining flex_c_c">
                            <p class="ttl">이벤트 남은 시간</p>
                            <div class="time">
                                <span class="hours"><?=$hour?></span> : <span class="minutes"><?=$minute?></span> : <span class="seconds"><?=$second?></span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php
                    $i++;
                    }
                }
            ?>
        </div>
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
    $(document).ready(function() {
        const items = $('.time_sale_wrap');
        const totalItems = items.length;
        let currentIndex = 0;

        if (totalItems <= 1) return;

        $(items[currentIndex]).addClass('active');

        function changeItem() {
            $(items[currentIndex]).removeClass('active');

            currentIndex = (currentIndex + 1) % totalItems;

            $(items[currentIndex]).addClass('active');
        }

        setInterval(changeItem, 5000);

        //decrease time
        $('.time_sale_wrap').each(function() {
            let hours = parseInt($(this).find('.hours').text());
            let minutes = parseInt($(this).find('.minutes').text());
            let seconds = parseInt($(this).find('.seconds').text());

            function decreaseTime() {
                if (seconds > 0) {
                    seconds--;
                } 
                else if (minutes > 0) {
                    minutes--;
                    seconds = 59;
                } 
                else if (hours > 0) {
                    hours--;
                    minutes = 59;
                    seconds = 59;
                }

                $(this).find('.hours').text(str_pad(hours));
                $(this).find('.minutes').text(str_pad(minutes));
                $(this).find('.seconds').text(str_pad(seconds));
            }

            function str_pad(value) {
                return value < 10 ? '0' + value : value;
            }

            setInterval(decreaseTime.bind(this), 1000);

        });
    });
    
</script>
