<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<style>
    .swiper-container-ticket {
        position: relative;
        overflow: hidden;
        max-width: 1200px;
        /* Giới hạn chiều rộng tối đa là 1200px */
        margin: 0 auto;
        /* Căn giữa container trên trang */
    }

    .swiper-button-next,
    .swiper-button-prev {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        padding: 10px;
        border-radius: 50%;
    }

    .swiper-button-next-ticket {
        z-index: 999;
        right: 0px;
        position: absolute;
        top: 40%;
    }

    .swiper-button-prev-ticket {
        z-index: 999;
        position: absolute;
        top: 40%;
        left: 0px;
    }
</style>

<section>
    <div class="banner-vehicle">
        <div class="swiper-container-ticket">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="<?= base_url('/uploads/products/car_banner.png') ?>" alt="">
                </div>
                <div class="swiper-slide"><img src="<?= base_url('/uploads/products/car_banner.png') ?>" alt="">
                </div>
                <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <!-- <div class="swiper-pagination"></div> -->
            <!-- Add Navigation -->
            <div class="swiper-button-next-ticket"><img src="/uploads/icons/next_s.png" alt=""></div>
            <div class="swiper-button-prev-ticket"><img src="/uploads/icons/prev_s.png" alt=""></div>
        </div>
    </div>
    <div class="inner guide_inner">
      <section class="section_guide_1">
        
      </section>
    </div>

</section>

<script>
    var swiper = new Swiper('.swiper-container-ticket', {
        slidesPerView: 1, // Hiển thị 3 item mỗi lần
        loop: true, // Cho phép loop qua các item
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        spaceBetween: 22,
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
        var totalSlides = swiper.slides.length
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