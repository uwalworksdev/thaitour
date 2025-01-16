<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<style>
    @media screen and (max-width : 850px) {
        .thailand_golf_list_item_ {
            width: calc((100% - 2rem) / 2);
        }
        .sub_tour_section5_item {
        width: calc((100% - 2rem) / 2);
        }
        .best_tour_section5_ .swiper-wrapper {
            gap: 2rem;
            row-gap: 5rem;
        }

    }
</style>
<section>
    <div class="body_inner golf-custom-page">
        <div class="banner-ticket golf-cus-css-mobile">
            <div class="swiper-container-ticket">
                <div class="swiper-wrapper">
                    <?php foreach ($bestProducts as $product) : ?>
                        <div class="swiper-slide">
                            <a href="/product-golf/golf-detail/<?= $product['product_idx'] ?>">
                                <div class="img_box_re">
                                    <img class="only_web" src="<?= getImage("/data/product/{$product['ufile1']}") ?>" alt="<?= strip_tags(viewSQ($product['product_name'])) ?>">
                                    <img class="only_mo img_box_re_img"
                                        src="<?= getImage("/data/product/{$product['ufile1']}") ?>" alt="<?= strip_tags(viewSQ($product['product_name'])) ?>">
                                    <?php if ($product['is_best_value']): ?>
                                        <img class="only_web tag-red" src="/uploads/icons/tag-red.png" alt="<?= strip_tags(viewSQ($product['product_name'])) ?>">
                                        <img class="only_mo tag-red" src="/uploads/icons/tag-red-m.png" alt="<?= strip_tags(viewSQ($product['product_name'])) ?>">
                                    <?php endif; ?>
                                    <p class="text_img_box_re">
                                        <?= viewSQ($product['product_name']) ?>
                                    </p>
                                    <p class="text_img_box_re_sub">
                                        <?php
                                        $arr_keyword = explode(',', $product['keyword']);
                                        foreach ($arr_keyword as $key => $value) {
                                            echo "#$value ";
                                        } ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next-ticket only_web"><img src="/uploads/icons/next_s.png" alt=""></div>
                <div class="swiper-button-prev-ticket only_web"><img src="/uploads/icons/prev_s.png" alt=""></div>
            </div>
            <div class="swiper-main-tools">
                <div class="play_pause" id="autoplay-button">
                    <svg id="pause-button" class="pause" width="6" height="10" viewBox="0 0 6 10" fill="#252525"
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
        <section class="sub_tour_section2">
            <div class="body_inner_custom_type_1">
                <div style="position: relative;">
                    <div class="swiper sub_swiper2">
                        <div class="swiper-wrapper">
                            <?php foreach ($categories as $category) : ?>
                                <div class="swiper-slide">
                                    <a href="/product-golf/list-golf/<?= $category['code_no'] ?>">
                                        <div class="img_box">
                                            <img src="<?= getImage("/data/code/{$category['ufile1']}") ?>" alt="main">
                                        </div>
                                        <div class="sub_swiper2__text">
                                            <?= viewSQ($category['code_name']) ?> <img src="/images/ico/ico_arrow_right_1.svg" alt="">
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-button-prev-sub-2 swiper-button-sub-2 sub_swiper2_btn_prev">
                        <img src="/images/ico/ico_prev_slide.svg" alt="">
                    </div>
                    <div class="swiper-button-next-sub-2 swiper-button-sub-2 sub_swiper2_btn_next">
                        <img src="/images/ico/ico_next_slide.svg" alt="">
                    </div>
                    <div class="sub_swiper2_pagination"></div>
                </div>
            </div>
        </section>
        <?php if($bannerTop): ?>
        <section class="banner-middle-tour">
            <div class="container-middle-tour">
                <h2 class="son-title">
                    <?=viewSQ($bannerTop['title'])?>
                </h2>
                <p class="son-des"><?=viewSQ($bannerTop['subtitle'])?></p>
            </div>
        </section>
        <?php endif; ?>
        <section class="sub_section3 thailand_hotel_">
            <div class="sub_section3__head">
                <div class="sub_section3__head__ttl">
                    지금이 제일 저렴해요
                </div>
            </div>
            <div>
                <div class="thailand_golf_list_" id="product_list_cheep">
                    <?php foreach ($cheepProducts['items'] as $item) {
                        echo view("product/golf/product_item_by_cheep", ["item" => $item]);
                    } ?>
                </div>
                <!-- <div class="thailand_hotel_swiper_pagination_next_"></div>
                <div class="thailand_hotel_swiper_pagination_prev_"></div> -->
                <div class="custom_pagination_ w_100" style="<?= $cheepProducts['pg'] >= $cheepProducts['nPage'] ? 'display: none;' : '' ?>" id="product_list_cheep_pagination">
                    <div class="pagination_show_" onclick="handleClickPaginationCheep()">
                        <img src="/images/ico/reloadicon.png" alt="">
                        <p>다음상품</p>
                        <div class="thailand_hotel_swiper_pagination_">
                            <span class="swiper-pagination-current" id="product_list_cheep_pagination_current">1</span> /
                            <span><?= $cheepProducts['nPage'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sub_tour_section5">
            <div class="sub_tour_section5__head">
                <div class="sub_tour_section5__head_ttl">
                    지역별 추천 상품
                </div>
                <div class="sub_tour_section5__head__tabs2 golf_custom_section5__head__tabs2">
                    <div class="tour__head__tabs2__tabs">
                        <?php foreach ($codes as $code) : ?>
                            <a href="javascript:void(0);" onclick="handleLoadRecommendedProduct(<?= $code['code_no'] ?>);" class="tour__head__tabs2__tab <?= $codeRecommendedActive == $code['code_no'] ? 'active' : '' ?>">
                                <?= viewSQ($code['code_name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="sub_tour_section5__prd_list" id="product_list_recommended">
                <?php foreach ($productByRecommended['items'] as $item) :
                    echo view("product/golf/product_item_by_recommended", ["item" => $item]);
                endforeach; ?>
            </div>
        </section>
        <section class="sub_tour_section7">
            <div class="sub_tour_section7__head">
                <div class="sub_tour_section7__head_ttl ttl">
                    놓치기 아쉬운 특가
                </div>
            </div>
            <div class="scroll-con-sec7">
                <div class="sub_tour_section7_product_list">
                    <?php foreach ($productSpecialPrice['items'] as $item) : ?>
                        <div class="sub_tour_section7_product_item">
                            <a href="/product-golf/golf-detail/<?= $item['product_idx'] ?>" class="sub_gold_item">
                                <img class="ico_special_prd only_web" src="/images/ico/ico_special_prd.png" alt="">
                                <img class="ico_special_prd only_mo" src="/images/ico/ico_special_prd_mo.png" alt="">
                                <div class="img_box img_box_12">
                                    <img src="<?= getImage("/data/product/{$item['ufile1']}") ?>" alt="<?= $item['rfile1'] ?>">
                                </div>
                                <div class="sub_tour_section7_product_item__name"><?= viewSQ($item['product_name']) ?></div>
                                <div class="sub_tour_section7_product_item__keywords">
                                    <?php
                                    $keywords = explode(',', $item['keyword']);
                                    $keywords = array_filter($keywords);
                                    foreach ($keywords as $item) : ?>
                                        <span>#<?= viewSQ($item) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="sub_section3 thailand_hotel_ sub_section5_">
            <div class="sub_section3__head">
                <div class="sub_section3__head__ttl">
                    MD추천 골프투어
                </div>
            </div>
            <div class="best_tour_section5_ swiper best_golf_section5_">
                <div class="swiper-wrapper" id="product_list_md_recommended">
                    <?php foreach ($productMDRecommended['items'] as $item) :
                        echo view("product/golf/product_item_by_md_recommended", ["item" => $item]);
                    endforeach; ?>
                </div>
            </div>
            <?php if ($productMDRecommended['nPage'] > 1) : ?>
                <div class="custom_pagination_ w_100" id="product_list_md_recommended_pagination">
                    <div class="s_item_show_" onclick="handleClickPaginationMD('<?= $productMDRecommended['code_no'] ?>')">
                        <p>더보기 +</p>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    </div>


</section>
<script>
    const swiper12 = new Swiper(".sub_swiper2", {
        loop: false,
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 20,
        grid: {
            rows: 2,
            fill: 'row'
        },
        navigation: {
            nextEl: ".sub_swiper2_btn_next",
            prevEl: ".sub_swiper2_btn_prev",
        },
        pagination: {
            el: ".sub_swiper2_pagination",
        },
        breakpoints: {
            851: {
                loop: true,
                slidesPerView: 6,
                slidesPerGroup: 1,
                grid: {
                    rows: 1,
                    fill: 'column'
                },
            },
        },
        on: {
            beforeResize: function() {
                this.update();
                if (this.pagination && this.pagination.render && this.pagination.init) {
                    this.pagination.render();
                    this.pagination.init();
                }
                if (this.navigation && this.navigation.update) {
                    this.navigation.update();
                }
            },
        },
    });

    var swiper = new Swiper('.swiper-container-ticket', {
        // Default setting
        // slidesPerView: 3,
        loop: true,
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
        // Responsive breakpoints
        breakpoints: {
            // When window width is >= 850px
            850: {
                slidesPerView: 3
            },
            // When window width is < 850px
            849: {
                slidesPerView: 1
            }
        },
        on: {
            init: function() {
                updateSlideCounter(this);
            },
            slideChange: function() {
                updateSlideCounter(this);
            }
        }
    });

    $('.tour__head__tabs2__tab').on('click', function(event) {
        event.preventDefault();


        $('.tour__head__tabs2__tab').removeClass('active');


        $(this).addClass('active');
    });

    // let thailand_hotel_swiper_ = new Swiper(".thailand_hotel_swiper_", {
    //     slidesPerView: 2,
    //     grid: {
    //         rows: 2,
    //     },
    //     breakpoints: {
    //         850: {
    //             slidesPerView: 4,
    //             spaceBetween: 20,
    //         }
    //     },
    //     spaceBetween: 20,
    //     pagination: {
    //         el: ".thailand_hotel_swiper_pagination_",
    //         type: "fraction",
    //         clickable: true,
    //     },
    //     navigation: {
    //         nextEl: ".thailand_hotel_swiper_pagination_next_",
    //         prevEl: ".thailand_hotel_swiper_pagination_prev_",
    //     },
    // });

    function updateSlideCounter(swiper) {
        var currentIndex = swiper.realIndex + 1;
        var totalSlides = swiper.slides.length;
        document.querySelector('.main_current_slide').innerText = currentIndex;
        document.querySelector('.main_total_slide').innerText = totalSlides;
    }

    document.getElementById('autoplay-button').addEventListener('click', function() {
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

    let pageCheep = 1;
    let totalPageCheep = Number('<?= $products['nPage'] ?>');

    function handleClickPaginationCheep() {
        pageCheep += 1;
        $.ajax({
            type: "GET",
            url: "/product/get-by-cheep",
            data: {
                page: pageCheep,
                code_no: 1302
            },
            dataType: "json",
            success: function(data) {
                totalPageCheep = Number(data.nPage);
                $("#product_list_cheep").append(data.html);
                $("#product_list_cheep_pagination_current").text(pageCheep);
                if (pageCheep >= totalPageCheep) {
                    $('#product_list_cheep_pagination').hide();
                } else {
                    $('#product_list_cheep_pagination').show();
                }
            }
        })
    }

    function handleLoadRecommendedProduct(code_no) {
        console.log(code_no);

        $.ajax({
            type: "GET",
            url: "/product/get-by-sub-code",
            data: {
                code_no: code_no
            },
            dataType: "json",
            success: function(data) {
                $("#product_list_recommended").html(data.html);
            }
        })
    }

    let pageMD = 1;
    let totalPageMD = 1;

    function handleClickPaginationMD(code_no) {
        pageMD += 1;
        $.ajax({
            type: "GET",
            url: "/product/get-by-sub-code",
            data: {
                page: pageMD,
                code_no: code_no
            },
            dataType: "json",
            success: function(data) {
                totalPageMD = Number(data.nPage);
                $("#product_list_md_recommended").append(data.html);
                $("#product_list_md_recommended_pagination_current").text(pageMD);
                if (pageMD >= totalPageMD) {
                    $('#product_list_md_recommended_pagination').hide();
                } else {
                    $('#product_list_md_recommended_pagination').show();
                }
            }
        })
    }
</script>


<?php $this->endSection(); ?>