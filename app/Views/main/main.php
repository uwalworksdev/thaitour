<!-- app/Views/main/home.php -->
<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?= view("inc/popup_main") ?>
<?php
$keyword = $_GET['keyword'] ?? '';

// 메인 배너
$Bbs = model("Bbs");
$bannerMain = $Bbs->List("banner", ["category" => "1"])->findAll();

// 메인 상단배너
$bannerTop = $Bbs->List("banner", ["category" => "40"])->findAll();

// 메인 중간 배너
$bannerMid = $Bbs->List("banner", ["category" => "16"])->findAll();

// 메인 하단배너
$bannerBottom = $Bbs->List("banner", ["category" => "124"])->findAll();

// 검색어
$SearchText = model("SearchText");
$searchTxt = $SearchText->List()->findAll();

?>
<!-- <link rel="stylesheet" href="/css/contents/main.css"> -->
<link rel="stylesheet" href="/lib/owl-carousel2/owl.carousel.min.css">
<link rel="stylesheet" href="/lib/owl-carousel2/owl.theme.default.min.css">
<script src="/lib/owl-carousel2/owl.carousel.min.js"></script>
<style>
    .side-bar-inc .side-center-card .banner-side-bar {
        display: none;
    }

    .main_sale_banner.new {
        top: 1%;
    }

    .main_sale_banner.visible {
        top: 1%;
    }

    .main_sale_banner {
        top: 75%;
    }

    .side-bar-inc.new {
        top: 1%;
    }

    .side-bar-inc.visible {
        top: 1%;
    }

    .side-bar-inc {
        top: 75%;
    }

    @media screen and (min-width: 1921px) {
        .side-bar-inc, .main_sale_banner {
            top: 73%;
        }
    }

    @media screen and (min-width: 2400px) {
        .side-bar-inc, .main_sale_banner {
            top: 70%;
        }
    }

    @media screen and (min-width: 2560px) {
        .side-bar-inc, .main_sale_banner {
            top: 69%;
        }
    }

    @media screen and (min-width: 2880px) {
        .side-bar-inc, .main_sale_banner {
            top: 66%;
        }
    }

    @media screen and (min-width: 3840px) {
        .side-bar-inc, .main_sale_banner{
            top: 62%;
        }
    }

    @media screen and (min-width: 5760px) {
        .side-bar-inc, .main_sale_banner {
            top: 57%;
        }

    }

    @media screen and (min-width: 7680px) {
        .side-bar-inc, .main_sale_banner {
            top: 55%;
        }
    }

    @media screen and (max-width: 850px) {
        .hot_product_list_swiper_pagination_2 .swiper-pagination-bullet {
            scale: 1;
        }

        .magazine_swiper__pagination .swiper-pagination-bullet {
            scale: 1;
        }
    }
</style>

<div class="body_container main_body_container main-page-cus-css-mobile">
    <section class="main_visual">
        <div class="relative">
            <div class="main_visual_slider only_web">
                <div class="swiper-wrapper">
                    <?php foreach ($bannerMain as $item): ?>
                        <div class="swiper-slide img_box img_box_1 only_web">
                            <img class="only_web" src="/data/bbs/<?= $item['ufile6'] ?>"
                                alt="<?= $item['rfile5'] ?>" onerror="this.src='/images/main/image.svg'">
                            <!--                        <div class="img_box_ttl_main">-->
                            <!--                            --><?php //= viewSQ($item['subject']) 
                                                                ?>
                            <!--                            <p class="img_box_txt_main2">-->
                            <?php //= viewSQ($item['describe']) 
                            ?><!--</p>-->
                            <!--                        </div>-->
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="main_visual_slider only_mo">
                <div class="swiper-wrapper">
                    <?php foreach ($bannerMain as $item): ?>
                        <div class="swiper-slide img_box img_box_1 ">
                            <img class="" src="/data/bbs/<?= $item['ufile5'] ?>"
                                alt="<?= $item['rfile5'] ?>" onerror="this.src='/images/main/image.svg'">
                            <!--                        <div class="img_box_ttl_main">-->
                            <!--                            --><?php //= viewSQ($item['subject']) 
                                                                ?>
                            <!--                            <p class="img_box_txt_main2">-->
                            <?php //= viewSQ($item['describe']) 
                            ?><!--</p>-->
                            <!--                        </div>-->
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-button swiper-button-next"></div>
            <div class="swiper-button swiper-button-prev"></div>
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
                <span class="main_current_slide" id="bnpageCurrent">1</span>&nbsp;/&nbsp;<span
                    class="main_total_slide"><?= count($bannerMain) ?></span>
                <!-- get total slide from database -->
            </div>
        </div>
    </section>

    <section class="main_section2">
        <div class="body_inner">
            <h1 class="ttl">태국여행, 왜 더투어랩이 답일까요?</h1>
            <div style="position: relative;">
                <div class="swiper main_swiper2">
                    <div class="swiper-wrapper">

                        <?php foreach ($bannerTop as $banner): ?>
                            <div class="swiper-slide">
                                <div class="img_box img_box_2 img_box_2_m">
                                    <img class="only_web" src="/data/bbs/<?= $banner['ufile6'] ?>"
                                        alt="<?= $banner['rfile6'] ?>">
                                    <img class="only_mo" src="/data/bbs/<?= $banner['ufile5'] ?>"
                                        alt="<?= $banner['rfile5'] ?>">
                                </div>
                                <div class="main_swiper2__text">
                                    <?= $banner['subject'] ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>
                <div class="swiper_pagination_main_swiper2_box">
                    <div class="swiper_pagination_main_swiper2"></div>
                </div>
                <div class="swiper-button-prev-main-2 swiper-button-main-2 main_swiper2_btn_prev">
                    <img src="/images/ico/ico_prev_slide.svg" alt="">
                </div>
                <div class="swiper-button-next-main-2 swiper-button-main-2 main_swiper2_btn_next">
                    <img src="/images/ico/ico_next_slide.svg" alt="">
                </div>
            </div>


        </div>
    </section>

    <section class="main_section3">
        <div class="body_inner">
            <div class="main_section3__head">
                <div class="main_section3__head__ttl">
                    취향저격 더투어랩 Best
                </div>
                <div class="main_section3__place">
                    <button class="main_section3__place_btn active" data-list="1">방콕</button>
                    <button class="main_section3__place_btn" data-list="2">파타야</button>
                    <button class="main_section3__place_btn" data-list="3">푸켓</button>
                    <button class="main_section3__place_btn" data-list="4">치양마이</button>
                </div>
                <div class="main_section3__type">
                    <button class="main_section3__type_btn active" data-code="">전체</button>
                    <button class="main_section3__type_btn" data-code="1">호텔</button>
                    <button class="main_section3__type_btn" data-code="2">골프</button>
                    <button class="main_section3__type_btn" data-code="3">투어</button>
                    <button class="main_section3__type_btn" data-code="4">스파</button>
                </div>
            </div>
            <div>
                <div class="best_list best_list_1" id="best_list_1">
                    <?php foreach ($list1_1 as $item1_1): ?>
                        <?php $img_dir = img_link($item1_1['product_code_1']); ?>
                        <?php $prog_link = prog_link($item1_1['product_code_1']); ?>
                        <a href="<?= $prog_link ?><?= $item1_1['product_idx'] ?>" class="best_list_item">
                            <div class="img_box img_box_3">
                                <img src="/data/<?= $img_dir ?>/<?= $item1_1['ufile1'] ?>" alt="main">
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb_item">방콕</li>
                                <li>
                                    <img class="only_web" src="/img/ico/ico_next_grey_.png" alt="ico_next_grey_">
                                    <img class="only_mo next-icon-m" src="/img/ico/ico_next_grey_mo.png" alt="ico_next_grey_mo">
                                </li>
                                <li class="breadcrumb_item">시암</li>
                            </ul>
                            <div class="prd_name mt-14">
                                <?= $item1_1['product_name'] ?>
                            </div>
                            <div class="prd_info">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <div class="d_flex justify_content_start align_items_end gap_10">
                                <?php 
                                    if($item1_1['is_won_bath'] == "W" || $item1_1['is_won_bath'] == "B"){
                                        if($item1_1['is_won_bath'] == "W"){
                                ?>
                                    <div class="prd_price_ko">
                                        <?= number_format($item1_1['product_price_won']) ?> <span>원</span>
                                    </div>
                                <?php
                                        }else if($item1_1['is_won_bath'] == "B"){
                                ?>    
                                    <div class="prd_price_ko">
                                        <?= number_format($item1_1['product_price']) ?> <span>바트</span>
                                    </div>     
                                <?php
                                        }
                                    }else{
                                ?>   
                                    <div class="prd_price_ko">
                                        <?= number_format($item1_1['product_price_won']) ?> <span>원</span>
                                    </div> 
                                    <div class="prd_price_thai">
                                        <?= number_format($item1_1['product_price']) ?> <span>바트</span>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="best_list best_list_2 hidden" id="best_list_2">
                    <?php foreach ($list1_2 as $item1_2): ?>
                        <?php $img_dir = img_link($item1_2['product_code_1']); ?>
                        <?php $prog_link = prog_link($item1_2['product_code_1']); ?>
                        <a href="<?= $prog_link ?><?= $item1_2['product_idx'] ?>" class="best_list_item">
                            <div class="img_box img_box_3">
                                <img src="/data/<?= $img_dir ?>/<?= $item1_2['ufile1'] ?>" alt="main">
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb_item">방콕</li>
                                <li>
                                    <img class="only_web" src="/img/ico/ico_next_grey_.png" alt="ico_next_grey_">
                                    <img class="only_mo next-icon-m" src="/img/ico/ico_next_grey_mo.png" alt="ico_next_grey_mo">
                                </li>
                                <li class="breadcrumb_item">시암</li>
                            </ul>
                            <div class="prd_name">
                                <?= $item1_2['product_name'] ?>
                            </div>
                            <div class="prd_info">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <div class="d_flex justify_content_start align_items_end gap_10">
                                <div class="prd_price_ko">
                                    <?= number_format($item1_2['product_price_won']) ?> <span>원</span>
                                </div>
                                <div class="prd_price_thai">
                                    <?= number_format($item1_2['product_price']) ?> <span>바트</span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="best_list best_list_3 hidden" id="best_list_3">
                    <?php foreach ($list1_3 as $item1_3): ?>
                        <?php $img_dir = img_link($item1_3['product_code_1']); ?>
                        <?php $prog_link = prog_link($item1_3['product_code_1']); ?>
                        <a href="<?= $prog_link ?><?= $item1_3['product_idx'] ?>" class="best_list_item">
                            <div class="img_box img_box_3">
                                <img src="/data/<?= $img_dir ?>/<?= $item1_3['ufile1'] ?>" alt="main">
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb_item">방콕</li>
                                <li>
                                    <img class="only_web" src="/img/ico/ico_next_grey_.png" alt="ico_next_grey_">
                                    <img class="only_mo next-icon-m" src="/img/ico/ico_next_grey_mo.png" alt="ico_next_grey_mo">
                                </li>
                                <li class="breadcrumb_item">시암</li>
                            </ul>
                            <div class="prd_name">
                                <?= $item1_3['product_name'] ?>
                            </div>
                            <div class="prd_info">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <div class="d_flex justify_content_start align_items_end gap_10">
                                <div class="prd_price_ko">
                                    <?= number_format($item1_3['product_price_won']) ?> <span>원</span>
                                </div>
                                <div class="prd_price_thai">
                                    <?= number_format($item1_3['product_price']) ?> <span>바트</span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="best_list best_list_4 hidden" id="best_list_4">
                    <?php foreach ($list1_4 as $item1_4): ?>
                        <?php $img_dir = img_link($item1_4['product_code_1']); ?>
                        <?php $prog_link = prog_link($item1_4['product_code_1']); ?>
                        <a href="<?= $prog_link ?><?= $item1_4['product_idx'] ?>" class="best_list_item">
                            <div class="img_box img_box_3">
                                <img src="/data/<?= $img_dir ?>/<?= $item1_4['ufile1'] ?>" alt="main">
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb_item">방콕</li>
                                <li>
                                    <img class="only_web" src="/img/ico/ico_next_grey_.png" alt="ico_next_grey_">
                                    <img class="only_mo next-icon-m" src="/img/ico/ico_next_grey_mo.png" alt="ico_next_grey_mo">
                                </li>
                                <li class="breadcrumb_item">시암</li>
                            </ul>
                            <div class="prd_name">
                                <?= $item1_4['product_name'] ?>
                            </div>
                            <div class="prd_info">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <div class="d_flex justify_content_start align_items_end gap_10">
                                <div class="prd_price_ko">
                                    <?= number_format($item1_4['product_price_won']) ?> <span>원</span>
                                </div>
                                <div class="prd_price_thai">
                                    <?= number_format($item1_4['product_price']) ?> <span>바트</span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </section>

    <section class="main_section4">
        <div class="body_inner">
            <div class="main_section4_community">
                <a href="/community/customer_center/list_notify" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_1.png" alt="" class="only_web">
                        <img src="/uploads/main/community_ico_1_m.png" alt="" class="only_mo">
                    </div>
                    <div class="community_item_name">
                        태국 뉴스
                    </div>
                    <i class="community_item_bread"></i>
                </a>
                <a href="/time_sale/list" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_2.png" alt="" class="only_web">
                        <img src="/uploads/main/community_ico_2_m.png" alt="" class="only_mo">

                    </div>
                    <div class="community_item_name">
                        타임세일
                    </div>
                    <i class="community_item_bread"></i>
                </a>
                <a href="#!" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_3.png" alt="" class="only_web">
                        <img src="/uploads/main/community_ico_3_m.png" alt="" class="only_mo">

                    </div>
                    <div class="community_item_name">
                        여행 일정표
                    </div>
                    <i class="community_item_bread"></i>
                </a>

                <!-- remove 매거진 -->
                <!-- <a href="#!" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_4.png" alt="" class="only_web">
                        <img src="/uploads/main/community_ico_4_m.png" alt="" class="only_mo">

                    </div>
                    <div class="community_item_name">
                        매거진
                    </div>
                    <i class="community_item_bread"></i>
                </a> -->
                <a href="/coupon/list" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_5.png" alt="" class="only_web">
                        <img src="/uploads/main/community_ico_5_m.png" alt="" class="only_mo">
                    </div>
                    <div class="community_item_name">
                        여행 쿠폰
                    </div>
                    <i class="community_item_bread"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="main_section5" id="main_section5">
        <div class="body_inner">
            <div class="main_section5__head">
                <div class="main_section5__head_ttl">
                    여행 hot keyword
                </div>
                <div class="main_section5__head__bar"></div>
            </div>
            <div class="main_section5__words_list" id="searchTxt">
                <?php foreach ($searchTxt as $item): ?>
                    <a href="#!" class="words_list_item ">#<?= $item['subject'] ?></a>
                <?php endforeach; ?>
            </div>

            <div class="main_hot__search">
                <div class="main-search-container">
                    <input id="searchInput" type="hidden" class="search-input" placeholder="검색어를 선택해 주세요" value="">
                    <!--i style="cursor: pointer" class="fa fa-search search-icon" id="iconSearchInp"></i-->
                    <button type="button" id="search_go">검색하기</button>
                </div>
            </div>
        </div>

        <div class="body_inner mt-80">
            <div class="main_hot__head">
                <div class="main_hot__head__left">
                    <div class="main_hot__head_ttl">
                        1주일간 예약순위 : <span>호텔</span>
                    </div>
                    <div class="main_hot__head__place only_web_flex">
                        <a href="#!" class="place_item_hotel active" data-id="290201">방콕</a>
                        <a href="#!" class="place_item_hotel" data-id="290202">파타야</a>
                        <a href="#!" class="place_item_hotel" data-id="290203">푸켓</a>
                        <a href="#!" class="place_item_hotel" data-id="290204">치앙마이</a>
                    </div>
                </div>
                <div class="main_hot__head__right">
                    <div class="hot_product_list_swiper_pagination_1"></div>
                </div>
            </div>
            <div class="main_hot__head__place only_mo_flex">
                <a href="#!" class="place_item active">방콕</a>
                <a href="#!" class="place_item">파타야</a>
                <a href="#!" class="place_item">푸켓</a>
                <a href="#!" class="place_item">치앙마이</a>
            </div>
            <div class="relative">
                <div class="hot_product_list hot_product_list_swiper_1 swiper">
                    <div class="swiper-wrapper" id="hotel_list">
                        <?php $seq = 0; ?>
                        <?php foreach ($list2 as $item2): ?>
                            <?php $seq++; ?>
                            <?php $img_dir = img_link($item2['product_code_1']); ?>
                            <div class="swiper-slide">
                                <a href="<?= getUrlFromProduct($item2) ?>" class="hot_product_list__item">
                                    <div class="img_box img_box_2">
                                        <img src="/data/<?= $img_dir ?>/<?= $item2['ufile1'] ?>" alt="main">
                                    </div>
                                    <div class="prd_name"><?= $item2['product_name'] ?></div>
                                    <div class="d_flex justify_content_start align_items_end gap_10">
                                    <?php 
									
										$arr   = product_price($item2["product_idx"]);
										$price = explode("|", $arr);
										$item2['product_price_won'] = $price[0];
										$item2['product_price']     = $price[1];
			
                                        if($item2['is_won_bath'] == "W" || $item2['is_won_bath'] == "B"){
                                            if($item2['is_won_bath'] == "W"){
                                    ?>
                                        <div class="prd_price_ko">
                                            <?= number_format($item2['product_price_won']) ?> <span>원</span>
                                        </div>
                                    <?php
                                            }else if($item2['is_won_bath'] == "B"){
                                    ?>    
                                        <div class="prd_price_ko">
                                            <?= number_format($item2['product_price']) ?> <span>바트</span>
                                        </div>     
                                    <?php
                                            }
                                        }else{
                                    ?>   
                                        <div class="prd_price_ko">
                                            <?= number_format($item2['product_price_won']) ?> <span>원</span>
                                        </div> 
                                        <div class="prd_price_thai">
                                            <?= number_format($item2['product_price']) ?> <span>바트</span>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-button-prev-main-2 swiper-button-main-2 hot_product_list_swiper_1_btn_prev">
                    <img src="/images/ico/ico_prev_slide.svg" alt="">
                </div>
                <div class="swiper-button-next-main-2 swiper-button-main-2 hot_product_list_swiper_1_btn_next">
                    <img src="/images/ico/ico_next_slide.svg" alt="">
                </div>
            </div>
            <div class="flex">
                <a href="/product-hotel/1303"
                    class="btn_more_hot_product btn_more_hot_product_1  flex justify-center items-center">
                    더보기 +
                </a>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $("#search_go").click(function() {
                location.href = '/product_search?search_name=' + $("#searchInput").val();
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            var list = "";
            var code = "";
            // 클래스가 'my-button'인 요소에 클릭 이벤트 추가
            $('.main_section3__place_btn').on('click', function() {
                list = $(this).data('list');

                $('.main_section3__type_btn').each(function(index) {
                    if ($(this).hasClass('active')) {
                        code = $(this).data('code');
                    }
                });

                set_best(list, code);
            });

            $('.main_section3__type_btn').on('click', function() {
                $('.main_section3__place_btn').each(function(index) {
                    if ($(this).hasClass('active')) {
                        list = $(this).data('list');
                    }
                });

                code = $(this).data('code');
                set_best(list, code);
            });

            $('.place_item_hotel').on('click', function() {
                var local = $(this).data('id');
                set_hotel_seq(local);
            });

            $('.place_item_golf').on('click', function() {
                var local = $(this).data('id');
                set_golf_seq(local);
            });

        });
    </script>

    <script>
        function set_best(list, code) {

            $.ajax({
                url: "/ajax/get_best",
                type: "POST",
                data: {
                    list: list,
                    code: code
                },
                dataType: "json",
                success: function(res) {
                    var message = res.message;
                    $("#best_list_" + list).html(message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // 서버 응답 내용 확인
                    alert('Error: ' + error);
                }
            });

        }

        function set_hotel_seq(local) {
            $.ajax({
                url: "/ajax/set_seq",
                type: "POST",
                data: {
                    type: "hotel",
                    local: local
                },
                dataType: "json",
                success: function(res) {
                    var message = res.message;
                    $("#hotel_list").html(message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // 서버 응답 내용 확인
                    alert('Error: ' + error);
                }
            });
        }

        function set_golf_seq(local) {
            $.ajax({
                url: "/ajax/set_seq",
                type: "POST",
                data: {
                    type: "golf",
                    local: local
                },
                dataType: "json",
                success: function(res) {
                    var message = res.message;
                    $("#golf_list").html(message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // 서버 응답 내용 확인
                    alert('Error: ' + error);
                }
            });
        }
    </script>

    <script>
        $('.words_list_item').click(function() {
            $(this).toggleClass('active');

            var hashTxt = "";
            var searhTxt = "";

            $('.words_list_item').each(function(index) {
                if ($(this).hasClass('active')) {
                    hashTxt += $(this).text().replace('#', '') + ',';
                    //searhTxt = $("#searchInput").val() + hashTxt;
                }
            });
            $("#searchInput").val(hashTxt);

            //window.location.href = '<?= base_url() ?>?keyword=' + $(this).text().replace('#', '');
        })

        $('#searchInput').on('keydown', function(event) {
            if (event.key === 'Enter' || event.which === 13) {
                searchData($(this).val());
            }
        });

        $('#iconSearchInp').click(function() {
            searchData($('#searchInput').val());
        });

        function searchData(keyword) {
            window.location.href = '<?= base_url() ?>?keyword=' + keyword;
        }
    </script>

    <section class="main_section7">
        <div class="body_inner">
            <div class="main_section7__banner">
                <?php foreach ($bannerMid as $banner): ?>
                    <div class="main_section7__banner__item">
                        <div class="img_box img_box_4">
                            <img src="/data/bbs/<?= $banner['ufile5'] ?>" alt="<?= $banner['rfile5'] ?>"
                                class="">
                        </div>
                        <div class="text-content ">
                            <h3><?= viewSQ($banner['subject']) ?></h3>
                            <!-- <span><?= $code['code_memo'] ?></span> -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="main_hot">
        <div class="body_inner">
            <div class="main_hot__head">
                <div class="main_hot__head__left">
                    <div class="main_hot__head_ttl">
                        1주일간 예약순위 : <span>골프</span>
                    </div>
                    <div class="main_hot__head__place only_web_flex">
                        <a href="#!" class="place_item_golf active" data-id="290101">방콕</a>
                        <a href="#!" class="place_item_golf" data-id="290102">파타야</a>
                        <a href="#!" class="place_item_golf" data-id="290103">푸켓</a>
                        <a href="#!" class="place_item_golf" data-id="290104">치앙마이</a>
                    </div>
                </div>
                <div class="main_hot__head__right">
                    <div class="hot_product_list_swiper_pagination_2"></div>
                </div>
            </div>
            <div class="main_hot__head__place only_mo_flex">
                <div class="place_item">방콕</div>
                <div class="place_item">파타야</div>
                <div class="place_item">푸켓</div>
                <div class="place_item active">치앙마이</div>
            </div>
            <div class="relative">
                <div class="hot_product_list hot_product_list_swiper_2 swiper">
                    <div class="swiper-wrapper" id="golf_list">
                        <?php $seq = 0; ?>
                        <?php foreach ($list3 as $item3): ?>
                            <?php $seq++; ?>
                            <?php $img_dir = img_link($item3['product_code_1']); ?>
                            <div class="swiper-slide">
                                <a href="<?= getUrlFromProduct($item3) ?>" class="hot_product_list__item">
                                    <div class="img_box img_box_2">
                                        <img src="/data/<?= $img_dir ?>/<?= $item3['ufile1'] ?>" alt="main">
                                    </div>
                                    <div class="prd_name"><?= $item3['product_name'] ?></div>
                                    <div class="d_flex justify_content_start align_items_end gap_10">
                                        <div class="prd_price_ko">
                                            <?= number_format($item3['product_price_won']) ?> <span>원</span>
                                        </div>
                                        <div class="prd_price_thai">
                                            <?= number_format($item3['product_price']) ?> <span>바트</span>
                                        </div>
                                    </div>
                                    <!--                                    <span class="number_item_label number_one">-->
                                    <?php //= $seq 
                                    ?><!--</span>-->
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="swiper-button-prev-main-2 swiper-button-main-2 hot_product_list_swiper_2_btn_prev">
                    <img src="/images/ico/ico_prev_slide.svg" alt="">
                </div>
                <div class="swiper-button-next-main-2 swiper-button-main-2 hot_product_list_swiper_2_btn_next">
                    <img src="/images/ico/ico_next_slide.svg" alt="">
                </div>
            </div>
            <div class="flex">
                <a href="/product-golf/1302/1"
                    class="btn_more_hot_product btn_more_hot_product_2  flex justify-center items-center">
                    더보기 +
                </a>
            </div>
        </div>
    </section>

    <section class="main_section8 only_web">
        <div class="body_inner">
            <div class="bar01"></div>
        </div>
    </section>

    <?php
    $seq = 0;
    foreach ($bannerBottom as $item_m):

        $seq++;
        if ($seq == 1) $banner_1 = "/data/bbs/" . $item_m['ufile5'];
        if ($seq == 2) $banner_2 = "/data/bbs/" . $item_m['ufile5'];

    endforeach;
    ?>

    <section class="main_section9">
        <div class="body_inner">
            <div class="main_section9__row">
                <div class="main_section9__col">
                    <div class="main_section9__head">
                        <div class="main_section9__head__ttl">태국에서 즐기는 5성급 호텔의 특별함</div>
                        <a href="/product-hotel/1303" class="btn_more">더보기 +</a>
                    </div>
                    <div class="main_section9__col__img img_box img_box_5">
                        <img src="<?= $banner_1 ?>" alt="">
                    </div>
                    <div class="main_section9__prd">

                        <?php foreach ($list4 as $item4): ?>
                            <a href="<?= getUrlFromProduct($item4) ?>" class="main_section9__prd__item">
                                <div class="prd__item__left">
                                    <div class="img_box img_box_6">
                                        <img src="/data/product/<?= $item4['ufile1'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="prd__item__right">
                                    <div class="prd__item__info">
                                        <div class="prd_name"><?= $item4['product_name'] ?></div>
                                        <div class="prd_description">
                                            연박 프로모션 "3박 이상시 룸 업그레이드...
                                        </div>
                                        <ul class="breadcrumb breadcrumb_location">
                                            <img src="/uploads/icons/icon-location-m.png" alt="" class="only_mo">
                                            <img src="/uploads/icons/icon-location.png" alt="" class="only_web">
                                            <li class="breadcrumb_item">방콕</li>
                                            <li>
                                                <img class="only_web" src="/img/ico/ico_next_grey_.png" alt="ico_next_grey_">
                                                <img class="only_mo next-icon-m" src="/img/ico/ico_next_grey_mo.png" alt="ico_next_grey_mo">
                                            </li>
                                            <li class="breadcrumb_item">시암</li>
                                        </ul>
                                        <div class="d_flex justify_content_start align_items_end gap_10">
                                            <?php 
                                                if($item4['is_won_bath'] == "W" || $item4['is_won_bath'] == "B"){
                                                    if($item4['is_won_bath'] == "W"){
                                            ?>
                                                <div class="prd_price_ko">
                                                    <?= number_format($item4['product_price_won']) ?> <span>원</span>
                                                </div>
                                            <?php
                                                    }else if($item4['is_won_bath'] == "B"){
                                            ?>    
                                                <div class="prd_price_ko">
                                                    <?= number_format($item4['product_price']) ?> <span>바트</span>
                                                </div>     
                                            <?php
                                                    }
                                                }else{
                                            ?>   
                                                <div class="prd_price_ko">
                                                    <?= number_format($item4['product_price_won']) ?> <span>원</span>
                                                </div> 
                                                <div class="prd_price_thai">
                                                    <?= number_format($item4['product_price']) ?> <span>바트</span>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="main_section9__col">
                    <div class="main_section9__head">
                        <div class="main_section9__head__ttl">태국에서 즐기는 골프의 특별함</div>
                        <a href="/product-golf/1302/1" class="btn_more">더보기 +</a>
                    </div>
                    <div class="main_section9__col__img img_box img_box_5">
                        <img src="<?= $banner_2 ?>" alt="">
                    </div>
                    <div class="main_section9__prd">

                        <?php foreach ($list5 as $item5): ?>
                            <a href="<?= getUrlFromProduct($item5) ?>" class="main_section9__prd__item">
                                <div class="prd__item__left">
                                    <div class="img_box img_box_6">
                                        <img src="/data/product/<?= $item5['ufile1'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="prd__item__right">
                                    <div class="prd__item__info">
                                        <div class="prd_name"><?= $item5['product_name'] ?></div>
                                        <div class="prd_description">
                                            3박 했습니다. 조식은 거의
                                            동일하고 과일 이랑 쌀국수 ...
                                        </div>
                                        <ul class="breadcrumb breadcrumb_location">
                                            <img src="/uploads/icons/icon-location-m.png" alt="" class="only_mo">
                                            <img src="/uploads/icons/icon-location.png" alt="" class="only_web">
                                            <li class="breadcrumb_item">방콕</li>
                                            <li>
                                                <img class="only_web" src="/img/ico/ico_next_grey_.png" alt="ico_next_grey_">
                                                <img class="only_mo next-icon-m" src="/img/ico/ico_next_grey_mo.png" alt="ico_next_grey_mo">
                                            </li>
                                            <li class="breadcrumb_item">시암</li>
                                        </ul>
                                        <div class="d_flex justify_content_start align_items_end gap_10">
                                            <div class="prd_price_ko">
                                                <?= number_format($item5['product_price_won']) ?> <span>원</span>
                                            </div>
                                            <div class="prd_price_thai">
                                                <?= number_format($item5['product_price']) ?> <span>바트</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>

                        <!--div class="main_section9__prd__item">
                            <div class="prd__item__left">
                                <div class="img_box img_box_6">
                                    <img src="/uploads/main/main_tour_4.png" alt="">
                                </div>
                            </div>
                            <div class="prd__item__right">
                                <div class="prd__item__info">
                                    <div class="prd_name">아난타라 시암 방콕 호텔</div>
                                    <div class="prd_description">
                                        로얄 방파인 골프 클럽에 관한 짧은 설명이... </div>
                                    <ul class="breadcrumb breadcrumb_location">
                                        <img src="/uploads/icons/icon-location-m.png" alt="" class="only_mo">
                                        <img src="/uploads/icons/icon-location.png" alt="" class="only_web">
                                        <li class="breadcrumb_item">방콕</li>
                                        <li class="breadcrumb_item">시암</li>
                                    </ul>
                                    <div class="prd_price_ko">236,100<span>원</span></div>
                                    <div class="prd_price_thai">6,000원</div>
                                </div>
                            </div>
                        </div-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main_section_review">
        <div class="body_inner">
            <div class="main_section_review__head">
                <div class="main_section_review__head_ttl">
                    여행을 다녀온 고객님들의 <span>솔직한 후기</span>
                </div>
                <a href="/review/review_list" class="main_section_review__head__more_review only_web">더보기 +</a>
            </div>
            <div class="only_mo_flex main_section_review_pagi_mo">
                <div>

                </div>
                <div>
                    <a href="/review/review_list" class="main_section_review__head__more_review only_mo">더보기 +</a>
                </div>
            </div>
            <div style="position: relative">
                <div class="main_section_review__list review__list_swiper swiper">
                    <div class="swiper-wrapper swiper-wrapper-cus-top">
                        <?php foreach ($best_reviews as $review): ?>
                            <div class="swiper-slide">
                                <a href="/review/review_detail?idx=<?= $review['idx'] ?>" class="review__list__item">
                                    <div class="img_box img_box_7">
                                        <img src="/uploads/review/<?= $review['ufile1'] ?>" alt="main">
                                    </div>
                                    <div class="review_list__item__body">
                                        <div class="review__list__item__type">
                                            <?= $review["code_name"] ?>
                                        </div>
                                        <div class="review__list__item__title"><?= $review['title'] ?></div>
                                        <div class="review__list__item__content text_truncate_">
                                            <?= viewSQ($review['contents']) ?>
                                        </div>
                                        <div class="review__list__item__extra">
                                            <div class="review__list__item__extra__star">
                                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                                <span class="star_avg"><?= $review['number_stars'] ?? 1 ?></span>
                                            </div>
                                            <div class="eye">
                                                <svg class="eye_icon" width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.01991 9.47178C1.33997 8.64363 1 8.22955 1 7C1 5.77045 1.33997 5.3564 2.01991 4.52825C3.37757 2.87467 5.65449 1 9 1C12.3455 1 14.6224 2.87467 15.9801 4.52825C16.66 5.3564 17 5.77045 17 7C17 8.22955 16.66 8.64363 15.9801 9.47178C14.6224 11.1253 12.3455 13 9 13C5.65449 13 3.37757 11.1253 2.01991 9.47178Z"
                                                        stroke="#ADADAD" stroke-width="1.5" />
                                                    <path
                                                        d="M11 7C11 8.1046 10.1046 9 9 9C7.8954 9 7 8.1046 7 7C7 5.8954 7.8954 5 9 5C10.1046 5 11 5.8954 11 7Z"
                                                        stroke="#ADADAD" stroke-width="1.5" />
                                                </svg>
                                                <span class="eye_cnt">1,248</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="swiper-button-prev-main-2 main_section_review_prev_btn_ swiper-button-main-2 review__list_swiper_btn_prev">
                    <img src="/images/ico/ico_prev_slide.svg" alt="" class="ico_prev_slide">
                </button>
                <button class="swiper-button-next-main-2 main_section_review_next_btn_ swiper-button-main-2 review__list_swiper_btn_next">
                    <img src="/images/ico/ico_next_slide.svg" alt="" class="ico_next_slide">
                </button>
            </div>
        </div>
    </section>

    <section class="main_section_magazine">
        <div class="body_inner">
            <div class="main_section_magazine__head">
                <div class="main_section_magazine__head__ttl">
                    더투어랩 <span>매거진</span>
                </div>
                <a href="/magazines/list" class="main_section_magazine__head__more">더보기 +</a>
            </div>
            <div class="magazine_swiper swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($magazines as $magazine): ?>
                        <div class="swiper-slide magazine_item_">
                            <a href="/magazines/detail?m_idx=<?= $magazine['bbs_idx'] ?>">
                                <div class="img_box img_box_8 ">
                                    <img src="/data/bbs/<?= $magazine['ufile1'] ?>" alt="main">
                                    <div class="img_box__shadow"></div>
                                </div>
                                <div class="magazine_content">
                                    <div class="magazine_content_txt">
                                        <?= $magazine['subject'] ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="magazine_swiper__pagination only_web"></div>
            </div>
        </div>
    </section>
</div>

<script src="/js/main.js"></script>
<?php if ($keyword) { ?>
    <script>
        $(document).ready(function() {
            scrollToEl('main_section5');
        });
    </script>
<?php } ?>
<script>
    function scrollToEl(elID) {
        const el = $('#' + elID);
        if (el.length) {
            $('html, body').animate({
                scrollTop: el.offset().top - 50
            }, 'slow');
        } else {
            console.warn('Element not found: ' + elID);
        }
    }
</script>
<script>
    $(document).ready(function() {
        var isAutoplaying = true;

        var swiperMainVisual = new Swiper(".main_visual_slider", {
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            speed: 800,
            navigation: {
                nextEl: ".main_visual .swiper-button-next",
                prevEl: ".main_visual .swiper-button-prev",
            },
            on: {
                slideChange: function() {
                    const currentIndex = this.realIndex + 1;
                    $('#bnpageCurrent').text(currentIndex);
                    if (!isAutoplaying) {
                        this.autoplay.stop();
                    } else {
                        this.autoplay.start();
                    }
                }
            }
        });

        $(document).on("click", "#autoplay-button", function(e, eSwiperMainVisual) {
            eSwiperMainVisual = swiperMainVisual;
            changeAutoPlay(e, eSwiperMainVisual, this);
        })

        function changeAutoPlay(e, eSwiperMainVisual, el) {
            if (!eSwiperMainVisual) {
                console.error("Swiper instance is not initialized!");
                return;
            }
            e.preventDefault();
            console.log(123);
            let $this = $(el);
            if ($this.hasClass("play")) {
                isAutoplaying = true;
                // eSwiperMainVisual.autoplay.stop();
                // isAutoplaying = true;
                $this.removeClass("play").addClass("stop");
                $("#pause-button").show();
                $("#play-button").hide();
            } else {
                isAutoplaying = false;
                // eSwiperMainVisual.autoplay.start();
                // isAutoplaying = false;
                $this.removeClass("stop").addClass("play");
                $("#pause-button").hide();
                $("#play-button").show();
            }
        }


        // $("#autoplay-button").click(function () {
        //     if (!swiperMainVisual) {
        //         console.error("Swiper instance is not initialized!");
        //         return;
        //     }
        //
        //     let $this = $(this);
        //     if ($this.hasClass("play")) {
        //         isAutoplaying = true;
        //         $this.removeClass("play").addClass("stop");
        //         $("#pause-button").show();
        //         $("#play-button").hide();
        //     } else {
        //         isAutoplaying = false;
        //         $this.removeClass("stop").addClass("play");
        //         $("#pause-button").hide();
        //         $("#play-button").show();
        //     }
        // });

        
    });
</script>
<?php $this->endSection(); ?>