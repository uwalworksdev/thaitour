<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<main id="container" class="sub item_list item_list_main pt0">
    <!-- <section class="sub_visual tours">
        <div class="visual_slider half_slider slick-slider">
            <?php if (!empty($banners) && count($banners) == 2) { ?>
                <section class="list_top_banner">
                    <a href="<?= $banners[0]['url'] ?>" id="myLink">
                        <picture>
                            <source media="(max-width: 850px)"
                                srcset="<?= "https://hihojoonew.cafe24.com/data/catebanner/" . $banners[1]['ufile1'] ?>">
                            <img src="<?= "https://hihojoonew.cafe24.com/data/catebanner/" . $banners[0]['ufile1'] ?>"
                                alt="패키지 탑 배너">
                        </picture>
                    </a>
                    <h3 class="sub_visual_ttl">호주 자유여행</h3>
                </section>
            <?php } ?>
        </div>
    </section> -->
    <div class="inner main_tours">
        <nav class="snb">
        </nav>
        <?php $tab1 = "on"; ?>
        <!-- Hiển thị banner -->
        <section class="list_mid_banner">
            <div class="list_box_slider">
                <div class="slick-container-mid2 visual_slider half_slider">
                    <?php foreach ($codeBanners as $banner) { ?>
                        <div class="slide_item2">
                            <a href="<?= $banner['url'] ?>">
                                <picture>
                                    <img src="<?= "https://hihojoonew.cafe24.com/data/banner/" . $banner['ufile'] ?>"
                                        alt="배너1 이름 넣어주세요">
                                </picture>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <div class="sub_sec_ttl flex_b_c">
            <h2 class="ttl">하이호주 에서만 즐기는 <b class="color_point">단독투어</b></h2>
        </div>
        <!-- Hiển thị danh sách sản phẩm -->
        <section class="one_txt_slider_sec item_list">
            <div class="one_txt_slider one_slider slick-slidero">
                <?php foreach ($products as $product): ?>
                    <?php
                    $img = "https://hihojoonew.cafe24.com/data/product/thum_500_300/" . $product['ufile1'];
                    $yoil_names = ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'];
                    ?>

                    <div class="slide_item">
                        <a href="/tours/item_view/<?= $product['product_idx'] ?>" class="flex__c">
                            <div class="list_prd_img flex">
                                <figure class="cover_img">
                                    <img src="<?= $img ?>" alt="Product Thumbnail">
                                </figure>
                                <div class="tag_box">
                                    <?php if ($product['product_best'] == "Y"): ?>
                                        <picture class="best_ico">
                                            <source media="(max-width: 768px)"
                                                srcset="https://hihojoonew.cafe24.com/assets/img/ico/tag_best_m.png">
                                            <img src="https://hihojoonew.cafe24.com/assets/img/ico/tag_best.png"
                                                alt="Best Product">
                                        </picture>
                                    <?php endif; ?>
                                    <?php if ($product['special_price'] == "Y"): ?>
                                        <picture class="sale_ico">
                                            <source media="(max-width: 850px)"
                                                srcset="https://hihojoonew.cafe24.com/assets/img/ico/tag_sale_m.png">
                                            <img src="https://hihojoonew.cafe24.com/assets/img/ico/tag_sale.png"
                                                alt="Special Price">
                                        </picture>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="list_prd_info">
                                <strong class="prd_tit"><?= $product['product_name'] ?></strong>
                                <div class="amount flex__e">
                                    <p class="discount">
                                        <strong><?= 100 - ((int) ($product['product_price'] / $product['original_price'] * 100)) ?></strong>%
                                    </p>
                                    <p class="price">
                                        <strong><?= number_format($product['product_price']) ?></strong>원($<?= number_format($product['product_price']) ?>)
                                    </p>
                                    <p class="cost">~
                                        <?= number_format($product['original_price']) ?>원($<?= number_format($product['original_price']) ?>)
                                    </p>
                                </div>
                                <div class="detail_box">
                                    <dl>
                                        <dt>가이드/언어</dt>
                                        <dd><?= htmlspecialchars_decode($product['guide_lang']) ?></dd>
                                    </dl>
                                    <dl>
                                        <dt>출발요일</dt>
                                        <dd>
                                            <?php foreach ($product['yoil_values'] as $index => $value): ?>
                                                <?php if ($value == 'Y'): ?>
                                                    <span class="yoil_txt"><?= $yoil_names[$index] ?></span><span
                                                        class="slash">/</span>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </dd>
                                    </dl>
                                </div>
                                <?php if ($product['product_info'] != ""): ?>
                                    <div class="point_list">
                                        <strong>Trip Point</strong>
                                        <ul>
                                            <li><?= htmlspecialchars_decode($product['product_info']) ?></li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="daytour_sec">
            <div class="sub_sec_ttl tac">
                <h2 class="ttl">하루동안 즐기는, <b class="color_point">하이호주 데이투어</b> <span class="font_emoji">🌞</span></h2>
            </div>
            <ul class="line_tab line_tab_recommend flex flex_w">
                <?php foreach ($dayTourCodes as $code): ?>
                    <li class="<?= $suggest_code == $code['code_no'] ? 'active' : '' ?>">
                        <button type="button" class="sel_guide"
                            value="<?= $code['code_no'] ?>"><?= $code['code_name'] ?></button>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="item_list_wrap">
                <ul class="w100 item_list img_big" style="--mg-x:14px; --mg-t:40px" id="line_add">
                    <?php foreach ($dayTourProducts as $product): ?>
                        <?php
                        $img = "https://hihojoonew.cafe24.com/data/product/thum_300_218/" . $product['ufile1'];
                        $yoil = $product['yoil_0'] . "|" . $product['yoil_1'] . "|" . $product['yoil_2'] . "|" . $product['yoil_3'] . "|" . $product['yoil_4'] . "|" . $product['yoil_5'] . "|" . $product['yoil_6'];
                        $yoil_values = explode('|', $yoil);
                        $yoil_names = ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'];
                        $product_price = round(($product['product_price'] * _US_DOLLAR) / 10) * 10;
                        $original_price = round(($product['original_price'] * _US_DOLLAR) / 10) * 10;
                        ?>
                        <li>
                            <a href="/product-tours/item_view/product_idx=<?= $product['product_idx'] ?>">
                                <div class="list_prd_img">
                                    <figure class="cover_img">
                                        <img src="<?= $img ?>" alt="상품썸네일">
                                    </figure>
                                    <div class="tag_box">
                                        <?php if ($product['product_best'] == 'Y'): ?>
                                            <picture class="best_ico">
                                                <source media="(max-width: 768px)"
                                                    srcset="<?= base_url("images/thumb_product/tag_best.png") ?>">
                                                <img src="<?= base_url("images/thumb_product/tag_best.png") ?>" alt="베스트상품">
                                            </picture>
                                        <?php endif; ?>
                                        <?php if ($product['special_price'] == 'Y'): ?>
                                            <picture class="sale_ico">
                                                <source media="(max-width: 850px)"
                                                    srcset="<?= base_url("images/thumb_product/tag_sale.png") ?>">
                                                <img src="<?= base_url("images/thumb_product/tag_sale.png") ?>" alt="특가상품">
                                            </picture>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="list_prd_info">
                                    <strong class="prd_tit"><?= $product['product_name'] ?></strong>
                                    <span class="prd_desc only_web"><?= $product['product_info'] ?></span>
                                    <div class="only_web">
                                        <div class="detail_box">
                                            <dl>
                                                <dt>가이드/언어</dt>
                                                <dd><?= htmlspecialchars_decode($product['guide_lang']) ?></dd>
                                            </dl>
                                            <dl>
                                                <dt>출발요일</dt>
                                                <dd>
                                                    <?php foreach ($yoil_values as $index => $value): ?>
                                                        <?php if ($value == 'Y'): ?>
                                                            <span class="yoil_txt"><?= $yoil_names[$index] ?></span><span
                                                                class="slash">/</span>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="amount flex__e">
                                        <?php
                                        $percent = 100 - ((int) ($product_price / $original_price * 100));
                                        if ($percent != 0):
                                            ?>
                                            <p class="discount"><strong><?= $percent ?></strong>%</p>
                                        <?php endif; ?>
                                        <p class="price">
                                            <strong><?= number_format($product_price) ?></strong>원($<?= number_format($product['product_price']) ?>)
                                        </p>
                                        <?php if ($percent != 0): ?>
                                            <p class="cost">~
                                                <?= number_format($original_price) ?>원($<?= number_format($product['original_price']) ?>)
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <?php if ($totalDayTourProducts > $perCnt): ?>
                    <div class="btn_box" id="list_more">
                        <button class="more_list btn-outline-dark">
                            더보기 <i></i>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <section class="line_banner">
    <?php if ($lineBanners): ?>
        <a href="<?= $lineBanners['url'] ?>">
            <picture>
                <source media="(max-width: 768px)" srcset="https://hihojoonew.cafe24.com/data/bbs/<?= $lineBanners['ufile5'] ?>">
                <img src="https://hihojoonew.cafe24.com/data/bbs/<?= $lineBanners['ufile6'] ?>" alt="쉽고 빠른 골프 예약! 하이호주에서 배너">
            </picture>
        </a>
    <?php endif; ?>
</section>

    </div>

</main>


<script>
    $(document).ready(function () {
        $('.slick-slidero').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            nextArrow: '<button type="button" class="slick-next2 slick-arrow slidero-r"></button>',
            prevArrow: '<button type="button" class="slick-prev2 slick-arrow slidero-l"></button>',
            // autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

    $(document).ready(function () {
        $('.slick-container-mid2').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            //   autoplay: true,
            autoplaySpeed: 2000,
            dots: false,
            arrows: true,
            nextArrow: '<button type="button" class="slick-next2 slick-arrow"></button>',
            prevArrow: '<button type="button" class="slick-prev2 slick-arrow"></button>',
            responsive: [
                {
                    breakpoint: 850,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>




<script>
    $('.line_tab li').on('click', function () {
        addRemove(this)
    })

    function addRemove(el) {
        $(el).siblings('li').removeClass("active");
        $(el).addClass("active");
    }
</script>

<?php $this->endSection(); ?>