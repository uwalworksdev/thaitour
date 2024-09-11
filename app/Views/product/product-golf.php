<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<style>
.swiper-container-ticket {
    position: relative;
    overflow: hidden;
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
    <div class="body_inner golf-custom-page">
        <div class="banner-ticket">
            <div class="swiper-container-ticket">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="img_box_re">
                            <img class="only_web" src="/images/sub/golf_slide_img1.png" alt="golf_slide_img1">
                            <img class="only_mo img_box_re_img"
                                src="<?= base_url('/uploads/products/spa-banner3_m.png') ?>" alt="">
                            <img class="only_web tag-red" src="/uploads/icons/tag-red.png" alt="">
                            <img class="only_mo tag-red" src="/uploads/icons/tag-red-m.png" alt="">
                            <p class="text_img_box_re">
                                스리아유타야 라이언 파크 &<br>
                                선셋 전일 투어
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box_re">
                            <img class="only_web" src="/images/sub/golf_slide_img2.png" alt="golf_slide_img2">
                            <img class="only_mo img_box_re_img"
                                src="<?= base_url('/uploads/products/spa-banner3_m.png') ?>" alt="">
                            <img class="only_mo tag-red" src="/uploads/icons/tag-g-m.png" alt="">
                            <img src="/uploads/icons/tag-g.png" alt="" class="tag-red only_web">
                            <p class="text_img_box_re">
                                한밤의 툭툭 드라이브 방콕<br>
                                야경 반일 투어
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box_re">
                            <img class="only_web" src="/images/sub/golf_slide_img3.png" alt="golf_slide_img3">
                            <img class="only_mo img_box_re_img"
                                src="<?= base_url('/uploads/products/spa-banner3_m.png') ?>" alt="">
                            <img src="/uploads/icons/tag-p.png" alt="" class="tag-red only_web">
                            <img src="/uploads/icons/tag-p-m.png" alt="" class="tag-red only_mo">
                            <p class="text_img_box_re">
                                차오프라야 오퓰런스 디너<br>
                                크루즈
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box_re">
                            <img class="only_web" src="/images/sub/golf_slide_img2.png" alt="golf_slide_img1">
                            <img class="only_mo img_box_re_img"
                                src="<?= base_url('/uploads/products/spa-banner3_m.png') ?>" alt="">
                            <img src="/uploads/icons/tag-p.png" alt="" class="tag-red only_web">
                            <img src="/uploads/icons/tag-p-m.png" alt="" class="tag-red only_mo">
                            <p class="text_img_box_re">
                                차오프라야 오퓰런스 디너<br>
                                크루즈
                            </p>
                        </div>
                    </div>




                    <!-- Add more slides as needed -->
                </div>
                <!-- Add Pagination -->
                <!-- <div class="swiper-pagination"></div> -->
                <!-- Add Navigation -->
                <div class="swiper-button-next-ticket only_web"><img src="/uploads/icons/next_s.png" alt=""></div>
                <div class="swiper-button-prev-ticket only_web"><img src="/uploads/icons/prev_s.png" alt=""></div>
            </div>


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
                <span class="main_current_slide">1</span>&nbsp;/&nbsp;<span class="main_total_slide"></span>
                <!-- get total slide from database -->
            </div>
        </div>
        <section class="sub_tour_section2">
            <div class="body_inner_custom_type_1">
                <div style="position: relative;">
                    <div class="swiper sub_swiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="/product-hotel/list-hotel/1324">
                                    <div class="img_box">
                                        <img src="/uploads/sub/tour_slide_1.png" alt="main">
                                    </div>
                                    <div class="sub_swiper2__text">
                                        방콕 <img src="/images/ico/ico_arrow_right_1.svg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/product-hotel/list-hotel/1324">
                                    <div class="img_box">
                                        <img src="/uploads/sub/tour_slide_2.png" alt="main">
                                    </div>
                                    <div class="sub_swiper2__text">
                                        파타야 <img src="/images/ico/ico_arrow_right_1.svg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/product-hotel/list-hotel/1324">
                                    <div class="img_box">
                                        <img src="/uploads/sub/tour_slide_3.png" alt="main">
                                    </div>
                                    <div class="sub_swiper2__text">
                                        푸켓 <img src="/images/ico/ico_arrow_right_1.svg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/product-hotel/list-hotel/1324">
                                    <div class="img_box">
                                        <img src="/uploads/sub/tour_slide_4.png" alt="main">
                                    </div>
                                    <div class="sub_swiper2__text">
                                        치앙마이 <img src="/images/ico/ico_arrow_right_1.svg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/product-hotel/list-hotel/1324">
                                    <div class="img_box">
                                        <img src="/uploads/sub/tour_slide_5.png" alt="main">
                                    </div>
                                    <div class="sub_swiper2__text">
                                        끄라비 <img src="/images/ico/ico_arrow_right_1.svg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/product-hotel/list-hotel/1324">
                                    <div class="img_box">
                                        <img src="/uploads/sub/tour_slide_6.png" alt="main">
                                    </div>
                                    <div class="sub_swiper2__text">
                                        카오락 <img src="/images/ico/ico_arrow_right_1.svg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="/product-hotel/list-hotel/1324">
                                    <div class="img_box">
                                        <img src="/uploads/sub/tour_slide_3.png" alt="main">
                                    </div>
                                    <div class="sub_swiper2__text">
                                        카오락 <img src="/images/ico/ico_arrow_right_1.svg" alt="">
                                    </div>
                                </a>
                            </div>
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
        <section class="banner-middle-tour">
            <div class="container-middle-tour">
                <h2 class="son-title">
                    내 일정에 딱 맞는 맞춤형 골프여행
                </h2>
                <p class="son-des">문의 주시면 빠르게 답변 드리겠습니다.</p>
            </div>
        </section>
        <section class="sub_section3 thailand_hotel_">
            <div class="body_inner">
                <div class="sub_section3__head">
                    <div class="sub_section3__head__ttl">
                        지금이 제일 저렴해요
                    </div>
                </div>
                <div>
                    <div class="thailand_hotel_swiper_ swiper">
                        <div class="swiper-wrapper">
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/golf_popular_1.png" alt="main loading=" lazy"">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                  윈저 파크 앤 골프 클럽
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원 </span>
                                    <span class="prd_price_ko_sub">6,000바트</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/golf_popular_2.png" alt="main loading=" lazy"">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                  카스카타 골프 클럽
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    81,785<span>원</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/golf_popular_3.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                  더 로얄 젬스 골프 클럽 (랑싯)
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    176,940<span>원 </span>
                                    <span class="prd_price_ko_sub ">4,500바트</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/golf_popular_4.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 스쿰빛(야속-프로퐁)</span>
                                </div>
                                <div class="prd_name">
                                  알파인 골프 앤 스포츠 클럽
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                  169,076<span>원</span>
                                  <span class="prd_price_ko_sub">1,550바트</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/golf_popular_5.png" alt="main" loading=" lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span>방콕></span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/golf_popular_6.png" alt="main " loading=" lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/golf_popular_7.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/golf_popular_8.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_5.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span>방콕></span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_6.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_7.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_8.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_5.png" alt="main" loading=" lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span>방콕></span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_6.png" alt="main" loading=" lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_7.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_8.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_5.png" alt="main" loading=" lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span>방콕></span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_2.png" alt="main" loading=" lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_3.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_2.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_5.png" alt="main" loading=" lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span>방콕></span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_2.png" alt="main" loading=" lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_3.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                            <a href="/product-hotel/list-hotel/1324" class="thailand_hotel_swiper_item_ swiper-slide">
                                <div class="img_box img_box_10">
                                    <img src="/uploads/sub/tour_popular_2.png" alt="main" loading="lazy">
                                </div>
                                <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">방콕
                                      <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                    </span>
                                    <span> 사뭇 쁘라칸</span>
                                </div>
                                <div class="prd_name">
                                    쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                                </div>
                                <div class="prd_info">
                                    <div class="prd_info__left">
                                        <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                        <span class="star_avg">4.7</span>
                                        <span class="star_review_cnt"></span>
                                    </div>
                                    <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                    <div class="prd_info__right">
                                        <span class="prd_info__right__ttl">생생리뷰</span>
                                        <span class="new_review_cnt">(0)</span>
                                    </div>
                                </div>
                                <div class="prd_price_ko">
                                    236,100<span>원~</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="thailand_hotel_swiper_pagination_next_"></div>
                    <div class="thailand_hotel_swiper_pagination_prev_"></div>
                    <div class="custom_pagination_ w_100">
                        <div class="pagination_show_">
                            <img src="/images/ico/reloadicon.png" alt="">
                            <p>다음상품</p>
                            <div class="thailand_hotel_swiper_pagination_"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sub_tour_section5">
        <div class="body_inner">
            <div class="sub_tour_section5__head">
                <div class="sub_tour_section5__head_ttl">
                    지역별 추천 상품
                </div>
                <div class="sub_tour_section5__head__tabs2 golf_custom_section5__head__tabs2">
                    <div class="tour__head__tabs2__tabs">
                        <a href="#!" class="tour__head__tabs2__tab active">
                            방콕
                        </a>
                        <a href="#!" class="tour__head__tabs2__tab">
                            파타야
                        </a>
                        <a href="#!" class="tour__head__tabs2__tab">
                            푸켓
                        </a>
                        <a href="#!" class="tour__head__tabs2__tab">
                            치앙마이
                        </a>
                        <a href="#!" class="tour__head__tabs2__tab">
                            치앙라이
                        </a>
                        <a href="#!" class="tour__head__tabs2__tab">
                            후아힌
                        </a>
                        <a href="#!" class="tour__head__tabs2__tab">
                            카오야이
                        </a>
                        <a href="#!" class="tour__head__tabs2__tab">
                            칸차나부리
                        </a>
                        <a href="#!" class="tour__head__tabs2__tab">
                            기타지역
                        </a>
                    </div>
                </div>
            </div>
            <div class="sub_tour_section5__prd_list">
                <a href="#!" class="sub_tour_section5_item">
                    <div class="img_box img_box_10">
                        <img src="/uploads/sub/tour_suggest_1.png" alt="main">
                    </div>
                    <div class="prd_name">
                        쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                    </div>


                    <div class="prd_price_ko">
                        236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>바트)</span></span>
                    </div>
                </a>
                <a href="#!" class="sub_tour_section5_item">
                    <div class="img_box img_box_10">
                        <img src="/uploads/sub/tour_suggest_2.png" alt="main">
                    </div>
                    <div class="prd_name">
                        쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                    </div>


                    <div class="prd_price_ko">
                        236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>바트)</span></span>
                    </div>
                </a>
                <a href="#!" class="sub_tour_section5_item">
                    <div class="img_box img_box_10">
                        <img src="/uploads/sub/tour_suggest_3.png" alt="main">
                    </div>
                    <div class="prd_name">
                        쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                    </div>


                    <div class="prd_price_ko">
                        236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>바트)</span></span>
                    </div>
                </a>
                <a href="#!" class="sub_tour_section5_item">
                    <div class="img_box img_box_10">
                        <img src="/uploads/sub/tour_suggest_4.png" alt="main">
                    </div>
                    <div class="prd_name">
                        쉐라톤 그랜드 수쿰윗, 럭셔리 컬렉션 호럭셔리 컬렉션 호...럭셔리 컬렉션 호
                    </div>


                    <div class="prd_price_ko">
                        236,100 <span>원</span> <span class="prd_price_thai">(6,000 <span>바트)</span></span>
                    </div>
                </a>
            </div>
        </div>
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

let thailand_hotel_swiper_ = new Swiper(".thailand_hotel_swiper_", {
    slidesPerView: 2,
    grid: {
        rows: 2,
    },
    breakpoints: {
        850: {
            slidesPerView: 4,
            spaceBetween: 20,
        }
    },
    spaceBetween: 20,
    pagination: {
        el: ".thailand_hotel_swiper_pagination_",
        type: "fraction",
        clickable: true,
    },
    navigation: {
        nextEl: ".thailand_hotel_swiper_pagination_next_",
        prevEl: ".thailand_hotel_swiper_pagination_prev_",
    },
});

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
</script>


<?php $this->endSection(); ?>