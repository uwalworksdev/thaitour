<div class="side-bar only_web">
    <div class="card-side-bar">
        <div class="side-bar-above side_bar_swipper swiper">
            <h3 class="title-side-bar">최근본상품</h3>
            <div class="img-container swiper-wrapper">
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img1">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img2">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img3">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img4">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img5">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img6">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                </div>
                <div class="swiper-slide">
                    <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                    <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                </div>
            </div>
            <p class="pagination_sidebar">
                <span class="current-slide">1</span>/<span class="total-slides">3</span>
            </p>
        </div>
        <div class="side-bar-below">
            <div class="left side_bar_swipper_btn_prev">
                <img src="/images/main/arrow_prev_icon.png" alt="arrow_prev_icon">
            </div>
            <div class="right side_bar_swipper_btn_next">
                <img src="/images/main/arrow_next_icon.png" alt="arrow_next_icon">
            </div>
        </div>
    </div>
    <div class="icon-wrap-social">
        <div class="robot-container">
            <img src="/images/ico/robot_icon.png" alt="Scroll to Top">
        </div>
        <div class="scroll-to-top">
            <img src="/images/ico/arrow_up_icon.png" alt="Scroll to Top">
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    const $scrollTopBtn = $('.scroll-to-top');

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $scrollTopBtn.addClass('visible');
        } else {
            $scrollTopBtn.removeClass('visible');
        }
    });

    $scrollTopBtn.on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    });

    const totalSlides = 10; 

    const swiper3 = new Swiper(".side_bar_swipper", {
        loop: true,
        slidesPerView: 1,
        pagination: {
            pagination: false, 
        },
        navigation: {
            prevEl: ".side_bar_swipper_btn_prev",
            nextEl: ".side_bar_swipper_btn_next",
        },
        on: {
            init: function(swiper) {
                updatePagination(swiper.realIndex);
                setButtonPosition(swiper.el);
            },
            slideChange: function(swiper) {
                updatePagination(swiper.realIndex);
            },
            // resize: function(swiper) {
            //     setButtonPosition(swiper.el);
            // },
        },
    });

    function updatePagination(index) {
        const currentSlide = index + 1; 
        $('.pagination_sidebar .current-slide').text(currentSlide);
        $('.pagination_sidebar span.total-slides').text(totalSlides);
    }

});
</script>