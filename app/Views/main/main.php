<!-- app/Views/main/home.php -->
<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
$Bbs = model("Bbs");
$list = $Bbs->List("banner", ["category" => "1"])->findAll();
?>

<link rel="stylesheet" href="/css/contents/main.css">
<div class="body_container">
    <section class="main_visual">
        <div class="body_inner">
            <div class="relative">
                <div class="main_visual_slider">
                    <?php foreach ($list as $item): ?>
                        <div class="slide_item">
                            <div class="img_box img_box_1">
                                <img src="/uploads/bbs/<?= $item['ufile5'] ?>" alt="<?= $item['rfile5'] ?>"
                                    onerror="this.src='/images/main/image.svg'">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="swiper-button-prev-main swiper-button-main">
                    <svg width="17" height="27" viewBox="0 0 17 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.4827 1.09832C14.0952 0.724604 13.4815 0.724612 13.0941 1.09834L0.88889 12.8725C0.481262 13.2658 0.481269 13.9187 0.888907 14.3119L12.7555 25.7589C13.1429 26.1326 13.7566 26.1326 14.144 25.7589L16.058 23.9125C16.4657 23.5193 16.4657 22.8663 16.058 22.4731L7.59657 14.312C7.18887 13.9188 7.18886 13.2657 7.59654 12.8725L16.3967 4.38412C16.8043 3.9909 16.8043 3.3379 16.3967 2.94466L14.4827 1.09832Z"
                            fill="white" />
                    </svg>
                </button>
                <button class="swiper-button-next-main swiper-button-main">
                    <svg width="17" height="27" viewBox="0 0 17 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.51733 1.09832C2.90475 0.724604 3.51848 0.724612 3.90588 1.09834L16.1111 12.8725C16.5187 13.2658 16.5187 13.9187 16.1111 14.3119L4.24452 25.7589C3.85711 26.1326 3.2434 26.1326 2.85599 25.7589L0.941972 23.9125C0.534308 23.5193 0.53433 22.8663 0.942021 22.4731L9.40343 14.312C9.81113 13.9188 9.81114 13.2657 9.40346 12.8725L0.603329 4.38412C0.195662 3.9909 0.195651 3.3379 0.603305 2.94466L2.51733 1.09832Z"
                            fill="white" />
                    </svg>
                </button>
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
                    <span class="main_current_slide">1</span>&nbsp;/&nbsp;<span class="main_total_slide">3</span>
                    <!-- get total slide from database -->
                </div>
            </div>
        </div>
    </section>
    <section class="main_section2">
        <div class="body_inner">
            <h1 class="ttl">태국여행, 왜 더투어랩이 답일까요?</h1>
            <div style="position: relative;">
                <div class="swiper main_swiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="img_box img_box_2">
                                <img src="/uploads/main/main_banner_1.png" alt="main_1">
                            </div>
                            <div class="main_swiper2__text">
                                # 왜 더투어랩이 답일까요?
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_box img_box_2">
                                <img src="/uploads/main/main_banner_2.png" alt="main_1">
                            </div>
                            <div class="main_swiper2__text"> # 더투어랩의 <br> 신용도는 <br> AAA</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_box img_box_2">
                                <img src="/uploads/main/main_banner_3.png" alt="main_1">
                            </div>
                            <div class="main_swiper2__text">#무조건 <br> 최저가 보장</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_box img_box_2">
                                <img src="/uploads/main/main_banner_4.png" alt="main_1">
                            </div>
                            <div class="main_swiper2__text">#무려 4% <br> 포인트 적립</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_box img_box_2">
                                <img src="/uploads/main/main_banner_5.png" alt="main_1">
                            </div>
                            <div class="main_swiper2__text">#예약이 <br> 정말 쉬워요! </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_box img_box_2">
                                <img src="/uploads/main/main_banner_3.png" alt="main_1">
                            </div>
                            <div class="main_swiper2__text">#무조건 <br> 최저가 보장</div>
                        </div>
                    </div>
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
                    <button class="main_section3__place_btn active">방콕</button>
                    <button class="main_section3__place_btn">파타야</button>
                    <button class="main_section3__place_btn">푸켓</button>
                    <button class="main_section3__place_btn">치양마이</button>
                </div>
                <div class="main_section3__type">
                    <button class="main_section3__type_btn active">호텔</button>
                    <button class="main_section3__type_btn">골프</button>
                    <button class="main_section3__type_btn">투어</button>
                </div>
            </div>
            <div>
                <div class="best_list">
                    <a href="#!" class="best_list_item">
                        <div class="img_box img_box_3">
                            <img src="/images/main/image.svg" alt="main_1">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb_item">방콕</li>
                            <li class="breadcrumb_item">시암</li>
                        </ul>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_info">
                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                            <span class="star_avg">4.7</span>
                            <span class="star_review_cnt">(954)</span>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span>
                        </div>
                        <div class="prd_price_thai">
                            6,000 <span>바트</span>
                        </div>
                    </a>
                    <a href="#!" class="best_list_item">
                        <div class="img_box img_box_3">
                            <img src="/images/main/image.svg" alt="main_1">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb_item">방콕</li>
                            <li class="breadcrumb_item">시암</li>
                        </ul>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_info">
                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                            <span class="star_avg">4.7</span>
                            <span class="star_review_cnt">(954)</span>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span>
                        </div>
                        <div class="prd_price_thai">
                            6,000 <span>바트</span>
                        </div>
                    </a>
                    <a href="#!" class="best_list_item">
                        <div class="img_box img_box_3">
                            <img src="/images/main/image.svg" alt="main_1">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb_item">방콕</li>
                            <li class="breadcrumb_item">시암</li>
                        </ul>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_info">
                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                            <span class="star_avg">4.7</span>
                            <span class="star_review_cnt">(954)</span>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span>
                        </div>
                        <div class="prd_price_thai">
                            6,000 <span>바트</span>
                        </div>
                    </a>
                    <a href="#!" class="best_list_item">
                        <div class="img_box img_box_3">
                            <img src="/images/main/image.svg" alt="main_1">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb_item">방콕</li>
                            <li class="breadcrumb_item">시암</li>
                        </ul>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_info">
                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                            <span class="star_avg">4.7</span>
                            <span class="star_review_cnt">(954)</span>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span>
                        </div>
                        <div class="prd_price_thai">
                            6,000 <span>바트</span>
                        </div>
                    </a>
                    <a href="#!" class="best_list_item">
                        <div class="img_box img_box_3">
                            <img src="/images/main/image.svg" alt="main_1">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb_item">방콕</li>
                            <li class="breadcrumb_item">시암</li>
                        </ul>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_info">
                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                            <span class="star_avg">4.7</span>
                            <span class="star_review_cnt">(954)</span>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span>
                        </div>
                        <div class="prd_price_thai">
                            6,000 <span>바트</span>
                        </div>
                    </a>
                    <a href="#!" class="best_list_item">
                        <div class="img_box img_box_3">
                            <img src="/images/main/image.svg" alt="main_1">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb_item">방콕</li>
                            <li class="breadcrumb_item">시암</li>
                        </ul>
                        <div class="prd_name">
                            쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                        </div>
                        <div class="prd_info">
                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                            <span class="star_avg">4.7</span>
                            <span class="star_review_cnt">(954)</span>
                        </div>
                        <div class="prd_price_ko">
                            236,100 <span>원</span>
                        </div>
                        <div class="prd_price_thai">
                            6,000 <span>바트</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="main_section4">
        <div class="body_inner">
            <div class="main_section4_community">
                <a href="#!" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_1.png" alt="">
                    </div>
                    <div class="community_item_name">
                        태국 뉴스
                    </div>
                    <i class="community_item_bread"></i>
                </a>
                <a href="#!" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_2.png" alt="">
                    </div>
                    <div class="community_item_name">
                        태국 뉴스
                    </div>
                    <i class="community_item_bread"></i>
                </a>
                <a href="#!" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_3.png" alt="">
                    </div>
                    <div class="community_item_name">
                        태국 뉴스
                    </div>
                    <i class="community_item_bread"></i>
                </a>
                <a href="#!" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_4.png" alt="">
                    </div>
                    <div class="community_item_name">
                        태국 뉴스
                    </div>
                    <i class="community_item_bread"></i>
                </a>
                <a href="#!" class="community_item">
                    <div class="community_item_img">
                        <img src="/images/main/community_ico_5.png" alt="">
                    </div>
                    <div class="community_item_name">
                        태국 뉴스
                    </div>
                    <i class="community_item_bread"></i>
                </a>
            </div>
        </div>
    </section>
    <section class="main_section5">
        <div class="body_inner">
            <div class="main_section5__head">
                <div class="main_section5__head_ttl">
                    여행 hot keyword
                </div>
                <div class="main_section5__head__bar"></div>
            </div>
            <div class="main_section5__words_list">
                <a href="#!" class="words_list_item">#5성급호텔</a>
                <a href="#!" class="words_list_item">#호텔투어</a>
                <a href="#!" class="words_list_item active">#5성급호텔</a>
                <a href="#!" class="words_list_item">#호텔투어</a>
                <a href="#!" class="words_list_item">#5성급호텔</a>
                <a href="#!" class="words_list_item">#호텔투어</a>
                <a href="#!" class="words_list_item">#5성급호텔</a>
                <a href="#!" class="words_list_item">#호텔투어</a>
                <a href="#!" class="words_list_item">#5성급호텔</a>
                <a href="#!" class="words_list_item">#호텔투어</a>
                <a href="#!" class="words_list_item">#5성급호텔</a>
                <a href="#!" class="words_list_item">#호텔투어</a>
            </div>
        </div>
    </section>
    <section class="main_hot">
        <div class="body_inner">
            <div class="main_hot__head">
                <div class="main_hot__head__left">
                    <div class="main_hot__head_ttl">
                        1주일간 예약순위 : <span>호텔</span>
                    </div>
                    <div class="main_hot__head__place">
                        <a href="#!" class="place_item active">방콕</a>
                        <a href="#!" class="place_item">파타야</a>
                        <a href="#!" class="place_item">방콕</a>
                        <a href="#!" class="place_item">파타야</a>
                    </div>
                </div>
                <div class="main_hot__head__right">
                    <div class="hot_product_list_swiper_pagination_1"></div>
                </div>
            </div>
            <div class="relative">
                <div class="hot_product_list hot_product_list_swiper_1 swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
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
                <a href="#!" class="btn_more_hot_product btn_more_hot_product_1 flex justify-center items-center">더보기
                    +</a>
            </div>
        </div>
    </section>
    <section class="main_section7">
        <div class="body_inner">
            <div class="main_section7__banner">
                <div class="main_section7__banner__item">
                    <div class="img_box img_box_4">
                        <img src="/images/main/image.svg" alt="">
                    </div>
                </div>
                <div class="main_section7__banner__item">
                    <div class="img_box img_box_4">
                        <img src="/images/main/image.svg" alt="">
                    </div>
                </div>
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
                    <div class="main_hot__head__place">
                        <div class="place_item">방콕</div>
                        <div class="place_item">파타야</div>
                        <div class="place_item">방콕</div>
                        <div class="place_item active">파타야</div>
                    </div>
                </div>
                <div class="main_hot__head__right">
                    <div class="hot_product_list_swiper_pagination_2"></div>
                </div>
            </div>
            <div class="relative">
                <div class="hot_product_list hot_product_list_swiper_2 swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="hot_product_list__item">
                                <div class="img_box img_box_2">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                <div class="prd_price_ko">236,100 <span>원</span></div>
                                <div class="prd_price_thai">6,000 <span>바트</span></div>
                            </div>
                        </div>
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
                <a href="#!" class="btn_more_hot_product btn_more_hot_product_2  flex justify-center items-center">더보기
                    +</a>
            </div>
        </div>
    </section>
    <section class="main_section8">
        <div class="body_inner">
            <div class="bar01"></div>
        </div>
    </section>
    <section class="main_section9">
        <div class="body_inner">
            <div class="main_section9__row">
                <div class="main_section9__col">
                    <div class="main_section9__head">
                        <div class="main_section9__head__ttl">태국에서 즐기는 <br> 5성급 호텔의 특별함 </div>
                        <a href="#!" class="btn_more">더보기 +</a>
                    </div>
                    <div class="main_section9__col__img img_box img_box_5">
                        <img src="/images/main/image.svg" alt="">
                    </div>
                    <div class="main_section9__prd">
                        <div class="main_section9__prd__item">
                            <div class="prd__item__left">
                                <div class="img_box img_box_6">
                                    <img src="/images/main/image.svg" alt="">
                                </div>
                            </div>
                            <div class="prd__item__right">
                                <div class="prd__item__info">
                                    <div class="prd_name">아난타라 시암 방콕 호텔</div>
                                    <div class="prd_description">
                                        연박 프로모션 "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb_item">방콕</li>
                                        <li class="breadcrumb_item">시암</li>
                                    </ul>
                                    <div class="prd_price_ko">236,100<span>원</span></div>
                                    <div class="prd_price_thai">6,000바트</div>
                                </div>
                            </div>
                        </div>
                        <div class="main_section9__prd__item">
                            <div class="prd__item__left">
                                <div class="img_box img_box_6">
                                    <img src="/images/main/image.svg" alt="">
                                </div>
                            </div>
                            <div class="prd__item__right">
                                <div class="prd__item__info">
                                    <div class="prd_name">아난타라 시암 방콕 호텔</div>
                                    <div class="prd_description">
                                        연박 프로모션 "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb_item">방콕</li>
                                        <li class="breadcrumb_item">시암</li>
                                    </ul>
                                    <div class="prd_price_ko">236,100<span>원</span></div>
                                    <div class="prd_price_thai">6,000바트</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main_section9__col">
                    <div class="main_section9__head">
                        <div class="main_section9__head__ttl">태국에서 즐기는 <br> 5성급 호텔의 특별함 </div>
                        <a href="#!" class="btn_more">더보기 +</a>
                    </div>
                    <div class="main_section9__col__img img_box img_box_5">
                        <img src="/images/main/image.svg" alt="">
                    </div>
                    <div class="main_section9__prd">
                        <div class="main_section9__prd__item">
                            <div class="prd__item__left">
                                <div class="img_box img_box_6">
                                    <img src="/images/main/image.svg" alt="">
                                </div>
                            </div>
                            <div class="prd__item__right">
                                <div class="prd__item__info">
                                    <div class="prd_name">아난타라 시암 방콕 호텔</div>
                                    <div class="prd_description">
                                        연박 프로모션 "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb_item">방콕</li>
                                        <li class="breadcrumb_item">시암</li>
                                    </ul>
                                    <div class="prd_price_ko">236,100<span>원</span></div>
                                    <div class="prd_price_thai">6,000바트</div>
                                </div>
                            </div>
                        </div>
                        <div class="main_section9__prd__item">
                            <div class="prd__item__left">
                                <div class="img_box img_box_6">
                                    <img src="/images/main/image.svg" alt="">
                                </div>
                            </div>
                            <div class="prd__item__right">
                                <div class="prd__item__info">
                                    <div class="prd_name">아난타라 시암 방콕 호텔</div>
                                    <div class="prd_description">
                                        연박 프로모션 "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb_item">방콕</li>
                                        <li class="breadcrumb_item">시암</li>
                                    </ul>
                                    <div class="prd_price_ko">236,100<span>원</span></div>
                                    <div class="prd_price_thai">6,000바트</div>
                                </div>
                            </div>
                        </div>
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
                <a href="#!" class="main_section_review__head__more_review">더보기 +</a>
            </div>
            <div style="position: relative">
                <div class="main_section_review__list review__list_swiper swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="review__list__item">
                                <div class="img_box img_box_7">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="review_list__item__body">
                                    <div class="review__list__item__type">골프</div>
                                    <div class="review__list__item__title">파타야 컨트리 클럽</div>
                                    <div class="review__list__item__content">파타야에서 가깝고 페어웨이 그린 모두 적 당히 괞찮습니다. 가격우
                                        말할것도...</div>
                                    <div class="review__list__item__extra">
                                        <div class="review__list__item__extra__star">
                                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                            <span class="star_avg">4.7</span>
                                            <span class="star_review_cnt">(954)</span>
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
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="review__list__item">
                                <div class="img_box img_box_7">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="review_list__item__body">
                                    <div class="review__list__item__type">골프</div>
                                    <div class="review__list__item__title">파타야 컨트리 클럽</div>
                                    <div class="review__list__item__content">파타야에서 가깝고 페어웨이 그린 모두 적 당히 괞찮습니다. 가격우
                                        말할것도...</div>
                                    <div class="review__list__item__extra">
                                        <div class="review__list__item__extra__star">
                                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                            <span class="star_avg">4.7</span>
                                            <span class="star_review_cnt">(954)</span>
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
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="review__list__item">
                                <div class="img_box img_box_7">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="review_list__item__body">
                                    <div class="review__list__item__type">골프</div>
                                    <div class="review__list__item__title">파타야 컨트리 클럽</div>
                                    <div class="review__list__item__content">파타야에서 가깝고 페어웨이 그린 모두 적 당히 괞찮습니다. 가격우
                                        말할것도...</div>
                                    <div class="review__list__item__extra">
                                        <div class="review__list__item__extra__star">
                                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                            <span class="star_avg">4.7</span>
                                            <span class="star_review_cnt">(954)</span>
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
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="review__list__item">
                                <div class="img_box img_box_7">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="review_list__item__body">
                                    <div class="review__list__item__type">골프</div>
                                    <div class="review__list__item__title">파타야 컨트리 클럽</div>
                                    <div class="review__list__item__content">파타야에서 가깝고 페어웨이 그린 모두 적 당히 괞찮습니다. 가격우
                                        말할것도...</div>
                                    <div class="review__list__item__extra">
                                        <div class="review__list__item__extra__star">
                                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                            <span class="star_avg">4.7</span>
                                            <span class="star_review_cnt">(954)</span>
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
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="review__list__item">
                                <div class="img_box img_box_7">
                                    <img src="/images/main/image.svg" alt="main_1">
                                </div>
                                <div class="review_list__item__body">
                                    <div class="review__list__item__type">골프</div>
                                    <div class="review__list__item__title">파타야 컨트리 클럽</div>
                                    <div class="review__list__item__content">파타야에서 가깝고 페어웨이 그린 모두 적 당히 괞찮습니다. 가격우
                                        말할것도...</div>
                                    <div class="review__list__item__extra">
                                        <div class="review__list__item__extra__star">
                                            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                            <span class="star_avg">4.7</span>
                                            <span class="star_review_cnt">(954)</span>
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
                            </div>
                        </div>
                    </div>
                </div>
                <button class="swiper-button-prev-main-2 swiper-button-main-2 review__list_swiper_btn_prev">
                    <img src="/images/ico/ico_prev_slide.svg" alt="">
                </button>
                <button class="swiper-button-next-main-2 swiper-button-main-2 review__list_swiper_btn_next">
                    <img src="/images/ico/ico_next_slide.svg" alt="">
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
                <a href="#!" class="main_section_magazine__head__more">더보기 +</a>
            </div>
            <div class="magazine_swiper swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="img_box img_box_8 ">
                            <img src="/images/main/image.svg" alt="main_1">
                            <div class="img_box__shadow"></div>
                        </div>
                        <div class="magazine_content">
                            <div class="magazine_content_txt">
                                여름휴가 준비할 때가 왔다. 에이스 오브 후아힌 리조트
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box img_box_8 ">
                            <img src="/images/main/image.svg" alt="main_1">
                            <div class="img_box__shadow"></div>
                        </div>
                        <div class="magazine_content">
                            <div class="magazine_content_txt">
                                여름휴가 준비할 때가 왔다. 에이스 오브 후아힌 리조트
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box img_box_8 ">
                            <img src="/images/main/image.svg" alt="main_1">
                            <div class="img_box__shadow"></div>
                        </div>
                        <div class="magazine_content">
                            <div class="magazine_content_txt">
                                여름휴가 준비할 때가 왔다. 에이스 오브 후아힌 리조트
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box img_box_8 ">
                            <img src="/images/main/image.svg" alt="main_1">
                            <div class="img_box__shadow"></div>
                        </div>
                        <div class="magazine_content">
                            <div class="magazine_content_txt">
                                여름휴가 준비할 때가 왔다. 에이스 오브 후아힌 리조트
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box img_box_8 ">
                            <img src="/images/main/image.svg" alt="main_1">
                            <div class="img_box__shadow"></div>
                        </div>
                        <div class="magazine_content">
                            <div class="magazine_content_txt">
                                여름휴가 준비할 때가 왔다. 에이스 오브 후아힌 리조트
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box img_box_8 ">
                            <img src="/images/main/image.svg" alt="main_1">
                            <div class="img_box__shadow"></div>
                        </div>
                        <div class="magazine_content">
                            <div class="magazine_content_txt">
                                여름휴가 준비할 때가 왔다. 에이스 오브 후아힌 리조트
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box img_box_8 ">
                            <img src="/images/main/image.svg" alt="main_1">
                            <div class="img_box__shadow"></div>
                        </div>
                        <div class="magazine_content">
                            <div class="magazine_content_txt">
                                여름휴가 준비할 때가 왔다. 에이스 오브 후아힌 리조트
                            </div>
                        </div>
                    </div>
                </div>
                <div class="magazine_swiper__pagination"></div>
            </div>
        </div>
    </section>
    <section class="main_section_notice">
        <div class="body_inner">
            <div class="main_section_notice__body">
                <div class="notice__ttl">공지사항</div>
                <div class="notice_list notice_swiper swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="notice_item">
                                <div class="notice_item__left">
                                    <div class="notice_item__icon">공지</div>
                                    <div class="notice_item__title">(여행소식) 수완나폼 공항내 그랩 택시 서비스 개시 </div>
                                </div>
                                <div class="notice_item__date">2022.05.23</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="notice_item">
                                <div class="notice_item__left">
                                    <div class="notice_item__icon">공지</div>
                                    <div class="notice_item__title">(여행소식) 수완나폼 공항내 그랩 택시 서비스 개시 </div>
                                </div>
                                <div class="notice_item__date">2022.05.23</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#!" class="main_section_notice__more">
                    <img class="ico_plus" src="/images/ico/ico_plus.svg" alt="">
                </a>
                <div class="swiper-button-box">
                    <button class="notice_swiper_btn_prev notice_swiper_btn">
                        <img src="/images/ico/ico_prev_slide.svg" alt="">
                    </button>
                    <button class="notice_swiper_btn_next notice_swiper_btn">
                        <img src="/images/ico/ico_next_slide.svg" alt="">
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="/js/main.js"></script>


<?php $this->endSection(); ?>