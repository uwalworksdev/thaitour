<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<style>
    .swiper-container-ticket {
        position: relative;
        overflow: hidden;
    }

    .swiper-button-next, .swiper-button-prev {
        position: absolute;
        top: 50%; /* Canh giữa theo chiều dọc */
        transform: translateY(-50%);
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.5); /* Nền mờ */
        color: #fff;
        padding: 10px;
        border-radius: 50%;
    }

    .swiper-button-next-ticket {
        z-index: 999;
        right: 10px; /* Canh phải */
        position: absolute;
        top: 50%;
    }

    .swiper-button-prev-ticket {
        z-index: 999;
        position: absolute;
        top: 50%;
        left: 10px; /* Canh trái */
    }
</style>

<section>
    <div class="inner">
        <div class="banner-ticket">
            <div class="swiper-container-ticket">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner1.png') ?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner2.png')?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner3.png')?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner2.png') ?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner3.png')?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner3.png')?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner1.png') ?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner3.png')?>" alt=""></div>
                    <div class="swiper-slide"><img src="<?=base_url('/uploads/products/ticket-banner2.png')?>" alt=""></div>
                    <!-- Add more slides as needed -->
                </div>
                <!-- Add Pagination -->
                <!-- <div class="swiper-pagination"></div> -->
                <!-- Add Navigation -->
                <div class="swiper-button-next-ticket"></div>
                <div class="swiper-button-prev-ticket"></div>
            </div>
            
        </div>
        <div class="swiper-main-tools">
                <div class="play_pause" id="autoplay-button">
                    <svg id="pause-button" class="pause" width="6" height="10" viewBox="0 0 6 10" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="2" height="10" fill="#757575" />
                        <rect x="4" width="2" height="10" fill="#757575" />
                    </svg>
                    <svg id="play-button" style="display: none;" class="play" width="8" height="10" viewBox="0 0 8 10"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.71975 4.48357L0.935104 0.11106C0.532604 -0.105726 0.0715332 -0.0832222 0.0715332 0.694992V9.305C0.0715332 10.0164 0.566176 10.1286 0.935104 9.88894L7.71975 5.51642C7.99904 5.23106 7.99904 4.76893 7.71975 4.48357Z"
                            fill="#757575" />
                    </svg>
                </div>
                <div class="swiper-pagination-main">
                <span class="main_current_slide">1</span>&nbsp;/&nbsp;<span class="main_total_slide"></span>
                <!-- get total slide from database -->
            </div>
            </div>
    </div>
</section>

<script>
    var swiper = new Swiper('.swiper-container-ticket', {
        slidesPerView: 3, // Hiển thị 3 item mỗi lần
        loop: true, // Cho phép loop qua các item
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next-ticket',
            prevEl: '.swiper-button-prev-ticket',
        },
        autoplay: {
            delay: 3000, 
            disableOnInteraction: false,
        },
           on: {
            init: function () {
                updateSlideCounter(this);
            },
            slideChange: function () {
                updateSlideCounter(this);
            }
        }
    });
    function updateSlideCounter(swiper) {
        var currentIndex = swiper.realIndex + 1; 
        var totalSlides = swiper.slides.length - swiper.loopedSlides * 2; 
        document.querySelector('.main_current_slide').innerText = currentIndex;
        document.querySelector('.main_total_slide').innerText = totalSlides;
    }
    document.getElementById('autoplay-button').addEventListener('click', function () {
        var playButton = document.getElementById('play-button');
        var pauseButton = document.getElementById('pause-button');
        if (swiper.autoplay.running) {
            swiper.autoplay.stop();
            playButton.style.display = 'block';
            pauseButton.style.display = 'none';
        } else {
            swiper.autoplay.start();
            playButton.style.display = 'none';
            pauseButton.style.display = 'block';
        }
    });
</script>

<?php $this->endSection(); ?>
