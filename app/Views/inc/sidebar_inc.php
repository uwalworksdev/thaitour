<?php
    $setting = homeSetInfo();
?>

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
        <div class="btn_area">
            <a href="javascript:void(0);" class="b_yellow" onclick="">담은상품 보기</a>
            <a href="javascript:void(0);" class="b_orange" onclick="">예약하기</a>
            <?php $review_cart = getCartItemList() ?>
            <div class="popup_review_cart">
                <div class="popups">
                    <div class="top flex_e_c">
                        <button type="button" class="close"></button>
                    </div>
                    <div class="pop_contents">
                        <h2 class="ttl">
                            장바구니
                        </h2>
                        <div class="cart_product">
                            <?php if($review_cart['tours_cnt'] > 0) { ?>
                                <?php foreach ($review_cart['tours_result'] as $item): ?>
                                    <?php $i++;?>
                                    <div class="product_tit">
                                        <div class="bs-input-checks">
                                            <input type="checkbox" id="product01_<?= $i?>" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="product01_<?= $i?>">[투어] <?=$item['product_name']?></label>
                                        </div>
                                        <div class="product_details">
                                            <div class="name_flex flex">
                                                <p class="name"><?=$item['order_date']?></p> 
                                                <p class="des-p">
                                                    <?php 
                                                        if (!empty($item['options'])) {
                                                            $options = explode('|', $item['options']);
                                                            foreach ($options as $option) {
                                                                $option_r = explode(":", esc($option));
                                                                echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
                                                            }
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                            <p class="price"><?=number_format($item['order_price'])?>원</p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php } ?>
                            <?php if($review_cart['golf_cnt'] > 0) { ?>
                                <?php foreach ($review_cart['golf_result'] as $item): ?>
                                    <?php $i++;?>
                                    <div class="product_tit">
                                        <div class="bs-input-checks">
                                            <input type="checkbox" id="product02_<?= $i?>" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="product02_<?= $i?>">[골프] <?=$item['product_name']?></label>
                                        </div>
                                        <div class="product_details">
                                            <div class="name_flex flex">
                                                <p class="name"><?=$item['order_date']?></p> 
                                                <p class="des-p">
                                                    <?php 
                                                        if (!empty($item['options'])) {
                                                            $options = explode('|', $item['options']);
                                                            foreach ($options as $option) {
                                                                $option_r = explode(":", esc($option));
                                                                echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원 - ";
                                                            }
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                            <p class="price"><?=number_format($item['order_price'])?>원</p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php } ?>
                            <!-- <div class="product_tit">
                                <div class="bs-input-checks">
                                    <input type="checkbox" id="product02" name="product02" value="Y">
                                    <label for="product02">[투어] 바와 스파 온 더 8 (나나)</label>
                                </div>
                                <div class="product_details">
                                    <p class="name">2025-03-21(금) | BHAWA Aromatherapy Deep Relaxation Massage 75 Mins</p>
                                    <p class="price">39,000원</p>
                                </div>
                            </div> -->
                            <div class="total_price flex_e">
                                <h2>합계금액 :</h2>
                                <p>176,940 <span>원~</span></p>
                            </div>
                            <div class="product_policy">
                                <p>상품 예약시 카트에 상품이 담긴 시점이 아닌 예약시 환율기준에 따라 금액이 재계산되오니 착오가 없 으시길 바랍니다.</p>
                                <p>즉시 확정 상품은 결제완료해주시면 바로 예약이 확정됩니다.</p>
                                <p>30분내 회신 상품은 예약가능여부를 조치 후 견적서를 발송해드리오니, 예약현황페이지나 이메일로 말송된 견적서를 확인하신 후 결제해주시기 바랍니다</p>
                            </div>
                            <div class="review_porduct_btn">
                                <button type="button" class="blue">선택상품예약</button>
                                <button type="button">선택상품삭제</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-bar-slide flex_c_c">
            <h3 class="title-side-bar">최근본상품</h3>
            <img src="/uploads/icons/arrow_up_icon.png" alt="" class="arrow-slide">
        </div>
        <div class="card-side-bar">
            <div class="side-bar-above side_bar_swipper swiper-container">
                <div class="img-container swiper-wrapper">
                </div>
                <p class="pagination_sidebar">
                    <span class="current-slide">1</span>/<span class="total-slides"></span>
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

        <?php

        $main_right_banner = getBannerByCategory(131);
        $main_right_banner_sub = getBannerByCategory(129);
        $sup_right_banner = getBannerByCategory(130);

        ?>
        <!-- <a class="banner-side-bar" href="<?= $sup_right_banner['url'] ?? '#!' ?>">
            <img class="only_m" src="<?= '/data/bbs/' . $main_right_banner['ufile5'] ?>"
                 alt="<?= $main_right_banner['subject'] ?>">
            <img class="only_w" src="<?= '/data/bbs/' . $main_right_banner['ufile6'] ?>"
                 alt="<?= $main_right_banner['subject'] ?>">
        </a> -->
        <?php if (isset($main) && $main): ?>
            <a class="banner-side-bar" href="<?= $main_right_banner['url'] ?? '#!' ?>">
                <img class="only_m" src="<?= '/data/bbs/' . $main_right_banner['ufile5'] ?>"
                    alt="<?= $main_right_banner['subject'] ?>">
                <img class="only_w" src="<?= '/data/bbs/' . $main_right_banner['ufile6'] ?>"
                    alt="<?= $main_right_banner['subject'] ?>">
            </a>
        <?php else: ?>
            <a class="banner-side-bar" href="<?= $main_right_banner_sub['url'] ?? '#!' ?>">
                <img class="only_m" src="<?= '/data/bbs/' . $main_right_banner_sub['ufile5'] ?>"
                    alt="<?= $main_right_banner_sub['subject'] ?>">
                <img class="only_w" src="<?= '/data/bbs/' . $main_right_banner_sub['ufile6'] ?>"
                    alt="<?= $main_right_banner_sub['subject'] ?>">
            </a>
        <?php endif; ?>
        <a href="<?= $sup_right_banner['url'] ?? '#!' ?>">
            <img src="<?= '/data/bbs/' . $sup_right_banner['ufile5'] ?>" alt="<?= $sup_right_banner['subject'] ?>"
                 class="map_img_n only_m">
            <img src="<?= '/data/bbs/' . $sup_right_banner['ufile6'] ?>" alt="<?= $sup_right_banner['subject'] ?>"
                 class="map_img_n only_w">
        </a>
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
            <!-- <img src="/images/sub/voi-sep-new.png" alt="Scroll to Top"> -->
            <img src="/uploads/setting/<?= $setting['logos_consult']?>" alt="Scroll to Top">
        </div>
        <div class="scroll-to-top">
            <img src="/images/ico/arrow_up_icon.png" alt="Scroll to Top">
        </div>
    </div>
</div>
<script>

    $(".btn_close").click(function () {
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
                // $mainSale.addClass('new');
            } else {
                $sideBar.removeClass('new');
                // $mainSale.removeClass('new');
                $scrollTopBtn.removeClass('visible');
            }
        });

        $scrollTopBtn.on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });

        const swiper3 = new Swiper(".side_bar_swipper", {
            loop: false,
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                prevEl: ".side_bar_swipper_btn_prev",
                nextEl: ".side_bar_swipper_btn_next",
            },
            on: {
                init: function (swiper) {
                    updatePagination(swiper.realIndex, swiper.slides.length);
                },
                slideChange: function (swiper) {
                    updatePagination(swiper.realIndex, swiper.slides.length);
                },
            },
        });

        function updatePagination(index, total) {
            const currentSlide = index + 1;
            document.querySelector('.pagination_sidebar .current-slide').textContent = currentSlide;
            document.querySelector('.pagination_sidebar .total-slides').textContent = total || 0;
        }

        function getCookie(name) {
            let cookies = document.cookie.split('; ');
            for (let i = 0; i < cookies.length; i++) {
                let parts = cookies[i].split('=');
                if (parts[0] === name) {
                    return decodeURIComponent(parts[1]);
                }
            }
            return null;
        }

        const viewedProducts = getCookie('viewedProducts');
        if (viewedProducts) {
            try {
                const products = JSON.parse(viewedProducts);
                const container = document.querySelector('.side-bar-above .swiper-wrapper');

                if (products.length > 0) {
                    products.forEach(product => {
                        const slide = document.createElement('div');
                        slide.classList.add('swiper-slide');
                        slide.innerHTML = `
                            <a href="${product.link}">
                                <img class="img-sidebar" src="${product.image}" alt="${product.name}">
                                ${product.image2 ? `<img class="img-sidebar" src="${product.image2}" alt="${product.name}">` : ''}
                            </a>
                        `;
                        container.appendChild(slide);
                    });

                    document.querySelector('.pagination_sidebar').style.display = "flex";
                    updatePagination(0, products.length);
                    swiper3.update();
                } else {
                    document.querySelector('.pagination_sidebar').style.display = "none";
                }
            } catch (error) {
                console.error("fail cookie:", error);
            }
        } else {
            document.querySelector('.pagination_sidebar').style.display = "none";
        }

    });

    $('.b_yellow').on('click', function () {
        $('.popup_review_cart').show();
    })

    $('.popup_review_cart .close').on('click', function () {
        $('.popup_review_cart').hide();
    });
</script>