<div class="side-bar-inc">
    <div class="side-bar-inc-main">
        <div class="top_cart flex_c_c">
            <h3 class="title-side-bar">장바구니</h3>
            <img src="/images/ico/select_ico_active.png" alt="" class="arrow-cart">
        </div>
        <div class="side-bar-cart">
            <p>총 예상견적</p>
            <h2>0원</h2>
            <span>(0바트)</span>
        </div>
        <div class="side-bar-slide flex_c_c">
            <h3 class="title-side-bar">최근본상품</h3>
            <img src="/uploads/icons/arrow_up_icon.png" alt="" class="arrow-slide">
        </div>
        <div class="card-side-bar">
            <div class="side-bar-above side_bar_swipper swiper-container">
                <div class="img-container swiper-wrapper">
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img1">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img2">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img4">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img5">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                    </div>
                    <div class="swiper-slide">
                        <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                        <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
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
    </div>
    <div class="side-center-card">
        <a class="banner-side-bar" href="#!"><img src="/images/sub/ban_lowest.png" alt=""></a>
        <img src="/images/main/side_img_r.png" alt="" class="map_img_n">
    </div>
</div>
<div class="side-bar-new">
    <!-- <a class="banner-side-bar" href="#!"><img src="../images/sub/ban_lowest.png" alt=""></a> -->
    <div class="icon-wrap-social">
        <div class="info_chat">
            <a class="btn_close" href="javascript:;">close</a>
            <div class="msg">태국여행,<br><em>무엇이든 물어보세요!!</em></div>
        </div>
        <div class="robot-container" onclick="go_link_fn_inc();">
            <img src="/images/sub/voi-sep-new.png" alt="Scroll to Top">
        </div>
        <div class="scroll-to-top">
            <img src="/images/ico/arrow_up_icon.png" alt="Scroll to Top">
        </div>
    </div>
</div>
<script>

    $(".btn_close").click(function() {
        $(".info_chat").hide();
    });

    $(".arrow-slide").click(function () {
        let card_slide_bar = $(this).closest(".side-bar-inc").find(".card-side-bar");

        if (card_slide_bar.css('display') !== 'none') {
            $(this).css('transform', 'rotate(180deg)');
            card_slide_bar.slideUp(300);
        } else {
            $(this).css('transform', 'rotate(0)');
            card_slide_bar.slideDown(300);
        }
    });

    $(".arrow-cart").click(function () {
        let cart_bar = $(this).closest(".side-bar-inc").find(".side-bar-cart");

        if (cart_bar.css('display') !== 'none') {
            $(this).css('transform', 'rotate(0)');
            cart_bar.slideUp(300);
        } else {
            $(this).css('transform', 'rotate(180deg)');
            cart_bar.slideDown(300);
        }
    });

    function go_link_fn_inc() {
        window.open("https://channel.io/ko", "_blank");
    }

    $(document).ready(function () {
        const $scrollTopBtn = $('.scroll-to-top');
        const $mainSale = $('.main_sale_banner');
        const $sideBar = $('.side-bar-inc');

        $(window).scroll(function () {
            
            if ($(this).scrollTop() > 650) {
                $sideBar.addClass('visible');
                $mainSale.addClass('visible');
            } else {
                $sideBar.removeClass('visible');
                $mainSale.removeClass('visible');
            }
            
            if ($(this).scrollTop() > 50) {
                $scrollTopBtn.addClass('visible');
                $sideBar.addClass('new');
                $mainSale.addClass('new');
            } else {
                $sideBar.removeClass('new');
                $mainSale.removeClass('new');
                $scrollTopBtn.removeClass('visible');
            }
        });

        $scrollTopBtn.on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });

        const totalSlides = 10;

        const swiper3 = new Swiper(".side_bar_swipper", {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                pagination: false,
            },
            navigation: {
                prevEl: ".side_bar_swipper_btn_prev",
                nextEl: ".side_bar_swipper_btn_next",
            },
            on: {
                init: function (swiper) {
                    updatePagination(swiper.realIndex);
                },
                slideChange: function (swiper) {
                    updatePagination(swiper.realIndex);
                },
            },
        });

        function updatePagination(index) {
            const currentSlide = index + 1;
            $('.pagination_sidebar .current-slide').text(currentSlide);
            $('.pagination_sidebar span.total-slides').text(totalSlides);
        }

    });
</script>