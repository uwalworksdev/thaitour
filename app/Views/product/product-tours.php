<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<style>
    .side-bar-inc {
        top: 71%;
    }

    .main_sale_banner {
        top: 71%;
    }

    @media screen and (min-width: 1921px) {
        .side-bar-inc {
            top: 64%;
        }

        .main_sale_banner {
            top: 64%;
        }
    }

    @media screen and (min-width: 2400px) {
        .side-bar-inc {
            top: 57%;
        }

        .main_sale_banner {
            top: 57%;
        }
    }

    @media screen and (min-width: 2560px) {
        .side-bar-inc {
            top: 53%;
        }

        .main_sale_banner {
            top: 53%;
        }
    }

    @media screen and (min-width: 2880px) {
        .side-bar-inc {
            top: 48%;
        }

        .main_sale_banner {
            top: 48%;
        }
    }

    @media screen and (min-width: 3840px) {
        .side-bar-inc{
            top: 36%;
        }

        .main_sale_banner {
            top: 36%;
        }
    }

    @media screen and (min-width: 5760px) {
        .side-bar-inc {
            top: 24%;
        }

        .main_sale_banner {
            top: 24%;
        }

    }

    @media screen and (min-width: 7680px) {
        .side-bar-inc {
            top: 18%;
        }

        .main_sale_banner {
            top: 18%;
        }
    }
</style>
<div class="body_container tour-main-page">
    <section class="sub_top_visual">
        <div class="body_inner">
            <div style="position: relative">
                <div class="sub_tour__left__bottom">
                    <div class="sub_tour__slide__scroll"></div>
                    <div class="sub_tour__slide__paging">
                        <img class="sub_tour__slide__paging__prev" src="/images/ico/ico_prev_slide_1.svg"
                            alt="">
                        <span class="sub_tour__slide__paging__divider"></span>
                        <img class="sub_tour__slide__paging__next" src="/images/ico/ico_next_slide_1.svg"
                            alt="">
                    </div>
                </div>
                <div class="swiper sub_swiper1">
                    <div class="swiper-wrapper">
                        <?php foreach ($bannerTop as $banner) : ?>
                            <div class="swiper-slide">
                                <div class="sub_tour">
                                    <div class="sub_tour_left">
                                        <div class="sub_tour_left__top">
                                            <svg width="110" height="37" viewBox="0 0 110 37" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M96 28H28C0.774 27.973 0 37 0 37V14C0 6.268 6.268 0 14 0H96C103.732 0 110 6.268 110 14C110 21.732 103.732 28 96 28Z"
                                                    fill="#4B4B4B" />
                                            </svg>
                                            <h4 class="sub_tour_left__top__text">주목! 이 상품</h4>
                                        </div>
                                        <div class="sub_tour_left__ttl">
                                                <?= $banner['title'] ?>
                                        </div>
                                        <a href="<?= $banner['url'] ?>" class="sub_tour__left__more">
                                            자세히 보기 >
                                        </a>
                                    </div>
                                    <div class="sub_tour_right">
                                        <div class="swiper sub_swiper1">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="img_box img_box_9">
                                                        <img src="/data/cate_banner/<?= $banner['ufile1'] ?>" alt="main">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sub_tour_section2">
        <div class="body_inner">
            <div style="position: relative;">
                <div class="swiper sub_swiper2">
                    <div class="swiper-wrapper">
                        <?php foreach ($sub_codes as $item): ?>
                            <div class="swiper-slide">
                                <a href="/product-tours/tours-list/<?= $item['code_no'] ?>">
                                    <div class="img_box">
                                        <img src="/data/code/<?= $item['ufile1'] ?>" alt="main">
                                    </div>
                                    <div class="sub_swiper2__text">
                                        <?= $item['code_name'] ?> <img src="/images/ico/ico_arrow_right_1.svg" alt="">
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
    <section class="sub_section3">
        <div class="body_inner">
            <div class="sub_section3__head">
                <div class="sub_section3__head__ttl">
                    제일 저렴한 최저가 인기 상품!
                </div>
            </div>
            <div>
                <div class="sub_section3_swiper swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($products['items'] as $row):
                            if (is_file(ROOTPATH . "/public/data/product/" . $row['ufile1'])) {
                                $src = "/data/product/" . $row['ufile1'];
                            } else {
                                $src = "/images/product/noimg.png";
                            }
                        ?>
                            <a href="/product-tours/item_view/<?= $row['product_idx'] ?>"
                                class="sub_section3_swiper_item swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="<?= $src ?>" alt="<?= $row['ufile1'] ?>">
                                </div>
                                <div class="prd_name">
                                    <?= viewSQ($row["product_name"]) ?>
                                </div>
                                <?php
                                $arr_keyword = explode(",", $row['keyword']);
                                $arr_keyword = array_filter($arr_keyword);
                                ?>
                                <div class="prd_keywords">
                                    <?php foreach ($arr_keyword as $keyword): ?>
                                        <span>#<?= $keyword ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                        <span class="star_avg"><?= $row['review_average'] ?></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(<?= $row['total_review'] ?>)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    <?= number_format($row['product_price_won']) ?> <span> 원 ~</span> <span class="prd_price_thai">
                                        <?= number_format($row['product_price']) ?>
                                        <span>바트</span></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="sub_section3_swiper_pagination"></div>
            </div>
        </div>
    </section>
    <?php if ($bannerMiddle) : ?>
        <style>
            .tour-main-page .banner_section_main_page .banner_section_image {
                background-image: url('/data/cate_banner/<?= $bannerMiddle['ufile1'] ?>');
            }

            @media screen and (max-width: 850px) {
                .tour-main-page .banner_section_main_page .banner_section_image {
                    background-image: url('/data/cate_banner/<?= $bannerMiddle['ufile2'] ?>');
                }
            }
        </style>
        <section class="banner_section_main_page">
            <div class="body_inner">
                <a href="<?= $bannerMiddle['url'] ?>" class="banner_section_image" style="position: relative;">
                    <div class="box-text">
                        <h3 class="title-box"><?= viewSQ($bannerMiddle['title']) ?></h3>
                        <p class="des-box"><?= viewSQ($bannerMiddle['subtitle']) ?></p>
                    </div>
                </a>
            </div>
        </section>
    <?php endif; ?>
    <section class="sub_tour_section5">
        <div class="body_inner">
            <div class="sub_tour_section5__head">
                <div class="sub_tour_section5__head_ttl">
                    지역별 추천 상품
                </div>
                <div class="sub_tour_section5__head__tabs1">
                    <div class="tour__head__tabs1__tabs">
                        <?php foreach ($code_new as $code) : ?>
                            <a href="javascript:void(0);" onclick="handleLoadRecommendedProductStep2(<?= $code['code_no'] ?>);" class="tour__head__tabs1__tab <?= $codeRecommendedActive == $code['code_no'] ? 'active' : '' ?>">
                                <?= viewSQ($code['code_name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="sub_tour_section5__head__tabs2">
                    <div class="tour__head__tabs2__tabs" id="tab2-content">
                        <?php foreach ($code_step2 as $code) : ?>
                            <a href="javascript:void(0);" onclick="handleLoadRecommendedProduct(<?= $code['code_no'] ?>);" class="tour__head__tabs2__tab <?= $codeStep2RecommendedActive == $code['code_no'] ? 'active' : '' ?>">
                                <?= viewSQ($code['code_name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="sub_tour_section5__prd_list" id="product_list_recommended">
                <?php foreach ($productStep2ByRecommended['items'] as $item) :
                    echo view("product/tour/product_item_by_recommended", ["item" => $item]);
                endforeach; ?>
            </div>

            <div class="prd_list_pagination" id="product_list_recommended_pagination">
                <div class="prd_list_pagination__btn" onclick="handleClickPaginationMD('<?= $productStep2ByRecommended['code_no'] ?>')">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.00001 10C2.00001 10.2589 1.89465 10.5073 1.70712 10.6904C1.51958 10.8735 1.26523 10.9764 1.00001 10.9764C0.734797 10.9764 0.480443 10.8735 0.292907 10.6904C0.105371 10.5073 1.41207e-05 10.2589 1.41207e-05 10C-0.00315467 8.16016 0.527064 6.35702 1.52937 4.79904C2.53167 3.24106 3.96513 1.99188 5.66401 1.1959C7.36289 0.399924 9.25782 0.08967 11.1297 0.301007C13.0016 0.512343 14.774 1.23664 16.242 2.39016V0.976372C16.242 0.717422 16.3473 0.469078 16.5349 0.285973C16.7224 0.102868 16.9768 0 17.242 0C17.5072 0 17.7616 0.102868 17.9491 0.285973C18.1366 0.469078 18.242 0.717422 18.242 0.976372V4.88186C18.242 5.14081 18.1366 5.38915 17.9491 5.57226C17.7616 5.75536 17.5072 5.85823 17.242 5.85823H13.242C12.9768 5.85823 12.7224 5.75536 12.5349 5.57226C12.3474 5.38915 12.242 5.14081 12.242 4.88186C12.242 4.62291 12.3474 4.37457 12.5349 4.19146C12.7224 4.00835 12.9768 3.90549 13.242 3.90549H14.985C13.8101 2.98468 12.3923 2.40715 10.8955 2.23961C9.39874 2.07207 7.88392 2.32136 6.52606 2.95867C5.16819 3.59599 4.02267 4.59534 3.22179 5.84129C2.42091 7.08725 1.99734 8.52899 2.00001 10ZM19 9.02363C18.7348 9.02363 18.4804 9.1265 18.2929 9.3096C18.1053 9.49271 18 9.74105 18 10C18.0027 11.471 17.5791 12.9127 16.7782 14.1587C15.9773 15.4047 14.8318 16.404 13.4739 17.0413C12.1161 17.6786 10.6013 17.9279 9.10446 17.7604C7.60766 17.5928 6.18993 17.0153 5.01501 16.0945H6.75701C7.02222 16.0945 7.27657 15.9916 7.46411 15.8085C7.65165 15.6254 7.757 15.3771 7.757 15.1181C7.757 14.8592 7.65165 14.6108 7.46411 14.4277C7.27657 14.2446 7.02222 14.1418 6.75701 14.1418H2.75701C2.49179 14.1418 2.23744 14.2446 2.0499 14.4277C1.86237 14.6108 1.75701 14.8592 1.75701 15.1181V19.0236C1.75701 19.2826 1.86237 19.5309 2.0499 19.714C2.23744 19.8971 2.49179 20 2.75701 20C3.02223 20 3.27658 19.8971 3.46412 19.714C3.65165 19.5309 3.75701 19.2826 3.75701 19.0236V17.6098C5.22511 18.7633 6.99756 19.4875 8.86946 19.6987C10.7414 19.91 12.6363 19.5998 14.3352 18.8038C16.0341 18.0079 17.4676 16.7588 18.4701 15.2009C19.4725 13.6429 20.0029 11.8398 20 10C20 9.74105 19.8946 9.49271 19.7071 9.3096C19.5196 9.1265 19.2652 9.02363 19 9.02363Z"
                            fill="black" />
                    </svg>
                    <span class="prd_list_pagination__btn__text">다음상품</span>
                    <div class="prd_list_pagination__btn__pages">
                        <span class="prd_list_pagination__btn__current">1</span> /
                        <span class="prd_list_pagination__btn__total"><?= $productStep2ByRecommended['nPage'] ?></span>
                    </div>
                </div>
            </div>
            <!-- <div class="prd_list_pagination">
                    <div class="prd_list_pagination__btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M2.00001 10C2.00001 10.2589 1.89465 10.5073 1.70712 10.6904C1.51958 10.8735 1.26523 10.9764 1.00001 10.9764C0.734797 10.9764 0.480443 10.8735 0.292907 10.6904C0.105371 10.5073 1.41207e-05 10.2589 1.41207e-05 10C-0.00315467 8.16016 0.527064 6.35702 1.52937 4.79904C2.53167 3.24106 3.96513 1.99188 5.66401 1.1959C7.36289 0.399924 9.25782 0.08967 11.1297 0.301007C13.0016 0.512343 14.774 1.23664 16.242 2.39016V0.976372C16.242 0.717422 16.3473 0.469078 16.5349 0.285973C16.7224 0.102868 16.9768 0 17.242 0C17.5072 0 17.7616 0.102868 17.9491 0.285973C18.1366 0.469078 18.242 0.717422 18.242 0.976372V4.88186C18.242 5.14081 18.1366 5.38915 17.9491 5.57226C17.7616 5.75536 17.5072 5.85823 17.242 5.85823H13.242C12.9768 5.85823 12.7224 5.75536 12.5349 5.57226C12.3474 5.38915 12.242 5.14081 12.242 4.88186C12.242 4.62291 12.3474 4.37457 12.5349 4.19146C12.7224 4.00835 12.9768 3.90549 13.242 3.90549H14.985C13.8101 2.98468 12.3923 2.40715 10.8955 2.23961C9.39874 2.07207 7.88392 2.32136 6.52606 2.95867C5.16819 3.59599 4.02267 4.59534 3.22179 5.84129C2.42091 7.08725 1.99734 8.52899 2.00001 10ZM19 9.02363C18.7348 9.02363 18.4804 9.1265 18.2929 9.3096C18.1053 9.49271 18 9.74105 18 10C18.0027 11.471 17.5791 12.9127 16.7782 14.1587C15.9773 15.4047 14.8318 16.404 13.4739 17.0413C12.1161 17.6786 10.6013 17.9279 9.10446 17.7604C7.60766 17.5928 6.18993 17.0153 5.01501 16.0945H6.75701C7.02222 16.0945 7.27657 15.9916 7.46411 15.8085C7.65165 15.6254 7.757 15.3771 7.757 15.1181C7.757 14.8592 7.65165 14.6108 7.46411 14.4277C7.27657 14.2446 7.02222 14.1418 6.75701 14.1418H2.75701C2.49179 14.1418 2.23744 14.2446 2.0499 14.4277C1.86237 14.6108 1.75701 14.8592 1.75701 15.1181V19.0236C1.75701 19.2826 1.86237 19.5309 2.0499 19.714C2.23744 19.8971 2.49179 20 2.75701 20C3.02223 20 3.27658 19.8971 3.46412 19.714C3.65165 19.5309 3.75701 19.2826 3.75701 19.0236V17.6098C5.22511 18.7633 6.99756 19.4875 8.86946 19.6987C10.7414 19.91 12.6363 19.5998 14.3352 18.8038C16.0341 18.0079 17.4676 16.7588 18.4701 15.2009C19.4725 13.6429 20.0029 11.8398 20 10C20 9.74105 19.8946 9.49271 19.7071 9.3096C19.5196 9.1265 19.2652 9.02363 19 9.02363Z"
                                    fill="black"/>
                        </svg>
                        <span class="prd_list_pagination__btn__text">다음상품</span>
                        <div class="prd_list_pagination__btn__pages">
                            <span class="prd_list_pagination__btn__current">1</span>
                            /
                            <span class="prd_list_pagination__btn__total">2</span>
                        </div>
                    </div>
                </div> -->
        </div>
    </section>
    <section class="sub_tour_section6">
        <div class="body_inner">
            <div class="sub_tour_section6__head">
                <div class="sub_tour_section6__head_ttl ttl">
                    인기 최고! 테마별 추천 상품
                </div>
                <div class="sub_tour_section6__head__tabs">
                    <?php foreach ($code_popular as $code) : ?>
                        <a href="javascript:void(0);" onclick="handleLoadPopularProduct(<?= $code['code_no'] ?>);" class="sub_tour_section6__head__tabs__tab <?= $codePopularActive == $code['code_no'] ? 'active' : '' ?>">
                            <?= viewSQ($code['code_name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="sub_tour_section6_product_list" id="product_list_popular">
                <?php foreach ($productByPopular['items'] as $item) :
                    echo view("product/tour/product_item_by_recommended", ["item" => $item]);
                endforeach; ?>
                <!-- <a href="#!" class="sub_tour_section6_item">
                        <div class="img_box img_box_10">
                            <img src="/uploads/sub/tour_theme_1.png" alt="main">
                        </div>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_keywords">
                            <span>#조인</span>
                            <span>#한국거 기이드</span>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info__left">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                            <div class="prd_info__right">
                                <span class="prd_info__right__ttl">생생리뷰</span>
                                <span class="new_review_cnt">(0)</span>
                            </div>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>원)</span></span>
                        </div>
                    </a>
                    <a href="#!" class="sub_tour_section6_item">
                        <div class="img_box img_box_10">
                            <img src="/uploads/sub/tour_theme_2.png" alt="main">
                        </div>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_keywords">
                            <span>#조인</span>
                            <span>#한국거 기이드</span>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info__left">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                            <div class="prd_info__right">
                                <span class="prd_info__right__ttl">생생리뷰</span>
                                <span class="new_review_cnt">(0)</span>
                            </div>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>원)</span></span>
                        </div>
                    </a>
                    <a href="#!" class="sub_tour_section6_item">
                        <div class="img_box img_box_10">
                            <img src="/uploads/sub/tour_theme_3.png" alt="main">
                        </div>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_keywords">
                            <span>#조인</span>
                            <span>#한국거 기이드</span>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info__left">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                            <div class="prd_info__right">
                                <span class="prd_info__right__ttl">생생리뷰</span>
                                <span class="new_review_cnt">(0)</span>
                            </div>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>원)</span></span>
                        </div>
                    </a>
                    <a href="#!" class="sub_tour_section6_item">
                        <div class="img_box img_box_10">
                            <img src="/uploads/sub/tour_theme_4.png" alt="main">
                        </div>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_keywords">
                            <span>#조인</span>
                            <span>#한국거 기이드</span>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info__left">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                            <div class="prd_info__right">
                                <span class="prd_info__right__ttl">생생리뷰</span>
                                <span class="new_review_cnt">(0)</span>
                            </div>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>원)</span></span>
                        </div>
                    </a>
                    <a href="#!" class="sub_tour_section6_item">
                        <div class="img_box img_box_10">
                            <img src="/uploads/sub/tour_theme_5.png" alt="main">
                        </div>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_keywords">
                            <span>#조인</span>
                            <span>#한국거 기이드</span>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info__left">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                            <div class="prd_info__right">
                                <span class="prd_info__right__ttl">생생리뷰</span>
                                <span class="new_review_cnt">(0)</span>
                            </div>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>원)</span></span>
                        </div>
                    </a>
                    <a href="#!" class="sub_tour_section6_item">
                        <div class="img_box img_box_10">
                            <img src="/uploads/sub/tour_theme_6.png" alt="main">
                        </div>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_keywords">
                            <span>#조인</span>
                            <span>#한국거 기이드</span>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info__left">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                            <div class="prd_info__right">
                                <span class="prd_info__right__ttl">생생리뷰</span>
                                <span class="new_review_cnt">(0)</span>
                            </div>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>원)</span></span>
                        </div>
                    </a>
                    <a href="#!" class="sub_tour_section6_item">
                        <div class="img_box img_box_10">
                            <img src="/uploads/sub/tour_theme_7.png" alt="main">
                        </div>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_keywords">
                            <span>#조인</span>
                            <span>#한국거 기이드</span>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info__left">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                            <div class="prd_info__right">
                                <span class="prd_info__right__ttl">생생리뷰</span>
                                <span class="new_review_cnt">(0)</span>
                            </div>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>원)</span></span>
                        </div>
                    </a>
                    <a href="#!" class="sub_tour_section6_item">
                        <div class="img_box img_box_10">
                            <img src="/uploads/sub/tour_theme_8.png" alt="main">
                        </div>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_keywords">
                            <span>#조인</span>
                            <span>#한국거 기이드</span>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info__left">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                            <div class="prd_info__right">
                                <span class="prd_info__right__ttl">생생리뷰</span>
                                <span class="new_review_cnt">(0)</span>
                            </div>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>원)</span></span>
                        </div>
                    </a> -->
            </div>
        </div>
    </section>
    <section class="sub_tour_section7">
        <div class="body_inner">
            <div class="sub_tour_section7__head">
                <div class="sub_tour_section7__head_ttl ttl">
                    놓치기 아쉬운 특가
                </div>
            </div>
            <div class="swiper sub_tour_section7_product_list" style="margin-bottom: 0">
                <div class="swiper-wrapper">
                    <?php foreach ($product_popular['items'] as $item) :
                        if (is_file(ROOTPATH . "/public/data/product/" . $item['ufile1'])) {
                            $src = "/data/product/" . $item['ufile1'];
                        } else {
                            $src = "/images/product/noimg.png";
                        }
                    ?>
                        <div class="swiper-slide">
                            <div class="sub_tour_section7_product_item spe">
                                <a href="/product-tours/item_view/<?= $item['product_idx'] ?>">
                                    <img class="ico_special_prd" src="/images/ico/ico_special_prd.png" alt="">
                                    <div class="img_box img_box_12">
                                        <img src="<?= $src ?>" alt="">
                                    </div>
                                    <div class="sub_tour_section7_product_item__name"> <?= viewSQ($item["product_name"]) ?></div>
                                    <?php
                                    $arr_keyword = explode(",", $item['keyword']);
                                    $arr_keyword = array_filter($arr_keyword);
                                    ?>
                                    <div class="sub_tour_section7_product_item__keywords">
                                        <?php foreach ($arr_keyword as $keyword): ?>
                                            <span>#<?= $keyword ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- <div class="sub_tour_section7_product_item">
                            <img class="ico_special_prd" src="/images/ico/ico_special_prd.png" alt="">
                            <div class="img_box img_box_12">
                                <img src="/uploads/sub/tour_special_2.png" alt="">
                            </div>
                            <div class="sub_tour_section7_product_item__name">놓치기 아쉬운 특가</div>
                            <div class="sub_tour_section7_product_item__keywords">
                                <span>#연꽃정원</span>
                                <span>#치앙마이</span>
                            </div>
                        </div>
                        <div class="sub_tour_section7_product_item">
                            <img class="ico_special_prd" src="/images/ico/ico_special_prd.png" alt="">
                            <div class="img_box img_box_12">
                                <img src="/uploads/sub/tour_special_3.png" alt="">
                            </div>
                            <div class="sub_tour_section7_product_item__name">놓치기 아쉬운 특가</div>
                            <div class="sub_tour_section7_product_item__keywords">
                                <span>#연꽃정원</span>
                                <span>#치앙마이</span>
                            </div>
                        </div> -->
        </div>
    </section>
    <section class="sub_tour_section8">
        <div class="body_inner">
            <div class="sub_tour_section8__banners">
                <div class="sub_tour_section8__banner">
                    <a href="<?= $bannerBottom[0]['url'] ?>" target="_blank" class="img_box img_box_13 ">
                        <img src="/data/cate_banner/<?= $bannerBottom[0]['ufile1'] ?>" alt="">
                    </a>
                </div>
                <div class="sub_tour_section8__banner">
                    <a href="<?= $bannerBottom[1]['url'] ?>" target="_blank" class="img_box img_box_13">
                        <img src="/data/cate_banner/<?= $bannerBottom[1]['ufile1'] ?>" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>


<script>

    function handleLoadRecommendedProductStep2(code_no) {
        pageMD = 1;
        $.ajax({
            type: "GET",
            url: "/product/get-step2-by-code-no",
            data: {
                code_no: code_no,
            },
            dataType: "json",
            success: function(data) {
                $("#tab2-content").html(data.html);
                handleLoadRecommendedProduct(data.codeStep2RecommendedActive);
            }
        });
    }

    function handleLoadRecommendedProduct(code_no) {
        $.ajax({
            type: "GET",
            url: "/product/get-by-sub-code-tour",
            data: {
                code_no: code_no,
            },
            dataType: "json",
            success: function(data) {
                $("#product_list_recommended").html(data.html);
                totalPageMD = Number(data.nPage);
                $(".prd_list_pagination__btn__current").text(pageMD);

                if (totalPageMD > 1) {
                    $('#product_list_recommended_pagination').show();
                } else {
                    $('#product_list_recommended_pagination').hide();
                }

                $('.tour__head__tabs2__tab').on('click', function(event) {
                    event.preventDefault();


                    $('.tour__head__tabs2__tab').removeClass('active');


                    $(this).addClass('active');
                });
            }
        });
    }

    function handleLoadPopularProduct(code_no) {
        $.ajax({
            type: "GET",
            url: "/product/get-by-sub-code-tour",
            data: {
                code_no: code_no,
            },
            dataType: "json",
            success: function(data) {
                $("#product_list_popular").html(data.html);
            }
        });
    }

    let pageMD = 1;
    let totalPageMD = <?= $productStep2ByRecommended['nPage'] ?? 1 ?>;

    function handleClickPaginationMD(code_no) {

        if (pageMD < totalPageMD) {
            pageMD += 1;

            $.ajax({
                type: "GET",
                url: "/product/get-by-sub-code-tour",
                data: {
                    page: pageMD,
                    code_no: code_no
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    totalPageMD = Number(data.nPage);
                    $("#product_list_recommended").append(data.html);
                    $(".prd_list_pagination__btn__current").text(pageMD);

                    if (pageMD >= totalPageMD) {
                        $('#product_list_recommended_pagination').hide();
                    } else {
                        $('#product_list_recommended_pagination').show();
                    }
                }
            })
        }
    }

    $(document).ready(function () {
        if (totalPageMD <= 1) {
            $('#product_list_recommended_pagination').hide();
        }
    });
</script>
<script>
    $(document).ready(function() {

        let swiper1; 

        function initSwiper() {
            swiper1 = new Swiper(".sub_swiper1", {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                // autoplay: {
                //     delay: 2500,
                //     disableOnInteraction: false,
                // },
                navigation: {
                    nextEl: ".sub_tour__slide__paging__next",
                    prevEl: ".sub_tour__slide__paging__prev",
                },
                scrollbar: {
                    el: ".sub_tour__slide__scroll",
                    draggable: true,
                },
                on: {
                    init: function () {
                        updateScrollbarWidth();
                    },
                    slideChange: function () {
                        updateScrollbarWidth();
                    }
                }
            });
        }

        function updateScrollbarWidth() {
            if (!swiper1 || !swiper1.realIndex) return;
            
            let realSlides = document.querySelectorAll(".sub_top_visual .sub_swiper1 .swiper-wrapper > .swiper-slide").length;
            let scrollbar = document.querySelector(".sub_top_visual .sub_tour__slide__scroll .swiper-scrollbar-drag"); 

            if (scrollbar) {
                let activeIndex = swiper1.realIndex; 
                let percentage = ((activeIndex + 1) / realSlides) * 100; 
                scrollbar.style.width = `${percentage}%`; 
            }
        }

        initSwiper();

        window.addEventListener("resize", updateScrollbarWidth);




        // $(window).resize(function() {
        //     if (swiper1.navigation && swiper1.navigation.update) {
        //         swiper1.navigation.update();
        //     }
        //     if (swiper1.scrollbar && swiper1.scrollbar.updateSize) {
        //         swiper1.scrollbar.updateSize();
        //     }
        //     updateScrollbarWidth();
        // });
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
        let swiper13 = undefined;

        function initSwiper13() {
            swiper13 = new Swiper(".sub_section3_swiper", {
                // loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                breakpoints: {
                    851: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                },
                navigation: {
                    nextEl: ".sub_section3_swiper_btn_next",
                    prevEl: ".sub_section3_swiper_btn_prev",
                },
                pagination: {
                    el: ".sub_section3_swiper_pagination",
                },
            });
        }

        initSwiper13();
        // $(window).resize(function() {
        //     if (swiper1.navigation && swiper1.navigation.update) {
        //         swiper1.navigation.update();
        //     }
        //     if (swiper1.scrollbar && swiper1.scrollbar.updateSize) {
        //         swiper1.scrollbar.updateSize();
        //     }
        // });
        $('.tour__head__tabs1__tab').click(function(event) {
            event.preventDefault();

            $('.tour__head__tabs1__tab').removeClass('active');
            $(this).addClass('active');
        });

        $('.tour__head__tabs2__tab').on('click', function(event) {
            event.preventDefault();


            $('.tour__head__tabs2__tab').removeClass('active');


            $(this).addClass('active');
        });

        $('.sub_tour_section6__head__tabs__tab').click(function(e) {
            e.preventDefault();

            $('.sub_tour_section6__head__tabs__tab').removeClass('active');

            $(this).addClass('active');
        });

        const swiperlist = new Swiper(".sub_tour_section7_product_list", {
            // loop: true,
            spaceBetween: 20,
            breakpoints: {
                851: {
                    slidesPerView: 3,
                },
                300: {
                    slidesPerView: 1,
                },
            }

        });

    });
</script>

<script>
    // $(document).ready(function () {
    //     setTimeout(() => {
    //         location.reload();
    //     }, 2000);
    // });
</script>
<?php $this->endSection(); ?>