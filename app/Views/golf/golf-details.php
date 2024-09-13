<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<div class="content-sub-hotel-detail custom-golf-detail">
    <div class="body_inner">
        <div class="section1">
            <div class="title-container">
                <h2>피닉스 골드 골프 방콕 (구. 수완나품 컨트리클럽)</h2>
                <div class="list-icon only_web">
                    <img src="/uploads/icons/print_icon.png" alt="print_icon">
                    <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                    <img src="/uploads/icons/share_icon.png" alt="share_icon">
                </div>
            </div>
            <div class="location-container">
                <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                <span>19 Moo.14, Bang Krasan, Bangpain,Phra Nakhon Si Ayutthaya 13160</span>
            </div>
            <div class="rating-container">
                <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                <span><strong> 4.7</strong></span>
                <span>생생리뷰 <strong>(124)</strong></span>
            </div>
            <div class="list-icon only_mo">
                <img src="/uploads/icons/print_icon.png" alt="print_icon">
                <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                <img src="/uploads/icons/share_icon.png" alt="share_icon">
            </div>
            <div class="hotel-image-container">
                <div class="hotel-image-container-1">
                    <img src="/uploads/sub/golf_details_1.png" alt="golf_details_1">
                </div>
                <div class="grid_2_2">
                    <img class="grid_2_2_size" src="/uploads/sub/golf_details_2.png" alt="golf_details_2">
                    <img class="grid_2_2_size" src="/uploads/sub/golf_details_3.png" alt="golf_details_3">
                    <img class="grid_2_2_size" src="/uploads/sub/golf_details_4.png" alt="golf_details_4">
                    <div class="grid_2_2_sub" style="position: relative; cursor: pointer;">
                        <img class="custom_button" src="/uploads/sub/golf_details_5.png" alt="golf_details_5">
                        <div class="button-show-detail-image">
                            <img class="only_web" src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                            <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png" alt="image_detail_icon_m">
                            <span>사진 모두 보기</span>
                            <span>(125장)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-header-hotel-detail">
                <div class="main">
                    <a class="active" href="">숙소개요</a>
                    <a href="">객실</a>
                    <a href="">시설&서비스</a>
                    <a href="">호텔 정책</a>
                    <a href="">생생리뷰(159개)</a>
                </div>
                <div class="btn-container">
                    <button>
                        객실선택
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
    let swiper = new Swiper(".swiper_product_list_", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: ".swiper_product_list_pagination_",
            clickable: true,
        },
        breakpoints: {
            850: {
                slidesPerView: 4,
                spaceBetween: 10,
            }
        }
    });

    // Get the popup, open button, close button elements
    const $popup = $('#popup');
    const $openPopupBtns = $('.openPopupBtn');
    const $closePopupBtn = $('.close-btn');
    const $closePopupBtn2 = $('#closePopupBtn');

    // Show popup when the "Open Popup" button is clicked
    $openPopupBtns.on('click', function() {
        $popup.css('display', 'flex');
    });

    $('.list-icon img[alt="heart_icon"]').click(function() {
        if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
            $(this).attr('src', '/uploads/icons/heart_on_icon.png');
        } else {
            $(this).attr('src', '/uploads/icons/heart_icon.png');
        }
    });

    // Close the popup when the "Close" button or the "x" is clicked
    $closePopupBtn.on('click', function() {
        $popup.css('display', 'none');
    });

    $closePopupBtn2.on('click', function() {
        $popup.css('display', 'none');
    });

    // Close popup if clicked outside of content area
    $(window).on('click', function(event) {
        if ($(event.target).is($popup)) {
            $popup.css('display', 'none');
        }
    });
    </script>

    <?php $this->endSection(); ?>