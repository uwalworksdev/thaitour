<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

    <link rel="stylesheet" type="text/css" href="/css/tour/spa.css">
    <div class="content-sub-hotel-detail tours-detail spa-detail">
        <div class="body_inner">
            <div class="section1">
                <div class="title-container">
                    <h2><?= $spa['product_name'] ?></h2>
                    <div class="only_web">
                        <div class="list-icon">
                            <img src="/uploads/icons/print_icon.png" alt="print_icon">
                            <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                            <img src="/uploads/icons/share_icon.png" alt="share_icon">
                        </div>
                    </div>
                </div>
                <div class="location-container">
                    <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                    <span><?= $spa['addrs'] ?></span>
                </div>
                <div class="above-cus-content">
                    <div class="rating-container">
                        <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                        <span><strong> <?= $spa['review_average'] ?></strong></span>
                        <span>생생리뷰 <strong>(<?= $spa['total_review'] ?>)</strong></span>
                    </div>
                    <div class="list-icon only_mo">
                        <img src="/uploads/icons/print_icon.png" alt="print_icon">
                        <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                        <img src="/uploads/icons/share_icon.png" alt="share_icon">
                    </div>
                </div>
                <div class="hotel-image-container">
                    <div class="hotel-image-container-1">
                        <img class="imageDetailMain_"
                             onclick="img_pops('<?= $spa['product_idx'] ?>')"
                             src="/data/hotel/<?= $spa['ufile1'] ?>"
                             alt="<?= $spa['product_name'] ?>"
                             onerror="this.src='/images/share/noimg.png'">
                    </div>
                    <div class="grid_2_2">
                        <?php for ($j = 2; $j < 5; $j++) { ?>
                            <img onclick="img_pops('<?= $spa['product_idx'] ?>')" class="grid_2_2_size imageDetailSup_"
                                 src="/data/hotel/<?= $spa['ufile' . $j] ?>"
                                 alt="<?= $spa['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                        <?php } ?>
                        <div class="grid_2_2_sub" style="position: relative; cursor: pointer;">
                            <img onclick="img_pops('<?= $spa['product_idx'] ?>')" class="custom_button imageDetailSup_"
                                 src="/data/hotel/<?= $spa['ufile5'] ?>"
                                 alt="<?= $spa['product_name'] ?>"
                                 onerror="this.src='/images/share/noimg.png'">
                            <div class="button-show-detail-image">
                                <img class="only_web" src="/uploads/icons/image_detail_icon.png"
                                     alt="image_detail_icon">
                                <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png"
                                     alt="image_detail_icon_m">
                                <span>사진 모두 보기</span>
                                <span>(125장)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="_wrap-info-payment">
                <div class="_wrap-info">

                    <div class="calendar-con">
                        <div class="calendar">
                            <div class="header">
                                <img onclick="fn_click_be();" style="cursor: pointer;"
                                     src="/uploads/icons/icon_prev_1.png" alt="icon_prev_1" id="prev_icon"
                                     class="btn-pre only_web">
                                <img onclick="fn_click_be();" style="cursor: pointer;"
                                     src="/uploads/icons/icon_prev_1.png" alt="" id="prev_icon_mo"
                                     class="btn-pre only_mo">
                                <p><span id="s_yy"></span>년 <span id="s_mm"></span>월</p>
                                <img onclick="fn_click_ne();" style="cursor: pointer;"
                                     src="/uploads/icons/icon_next_1.png" alt="" id="next_icon"
                                     class="btn-next only_web">
                                <img onclick="fn_click_ne();" style="cursor: pointer;"
                                     src="/uploads/icons/icon_next_1.png" alt="" id="next_icon_mo"
                                     class="btn-next only_mo">
                            </div>
                            <div class="canl_tabel">
                                <div class="heading">
                                    <p><span style="color : #e5001c">일</span></p>
                                    <p><span>월</span></p>
                                    <p><span>화</span></p>
                                    <p><span>수</span></p>
                                    <p><span>목</span></p>
                                    <p><span>금</span></p>
                                    <p><span style="color : #e5001c">토</span></p>
                                </div>
                                <div class="body" id="option_cal">

                                </div>
                            </div>
                            <div class="label-container mt-20">
                                <div class="label-item">
                                    <span class="allow-text">예약가능</span>
                                    <span class="label-text">예약이 가능한 일자입니다.</span>
                                </div>
                                <div class="label-item">
                                    <span class="sold-out-text">예약마강</span>
                                    <span class="label-text">예약이 마감된 상태로 예약이 불가합니다.</span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="sub-header-hotel-detail">
                        <div class="main nav-list">
                            <p class="nav-item active" onclick="scrollToEl('section2')" style="cursor: pointer">숙소개요</p>
                            <p class="nav-item" onclick="scrollToEl('section3')" style="cursor: pointer">시설&서비스</p>
                            <p class="nav-item" onclick="scrollToEl('section4')" style="cursor: pointer">호텔 정책</p>
                            <p class="nav-item" onclick="scrollToEl('section5')" style="cursor: pointer">생생리뷰(159개)</p>
                        </div>
                    </div>
                    <div class="section2" id="section2">
                        <h2 class="title-sec2">
                            숙소개요
                        </h2>
                        <h3 class="sub-title-sec2">
                            추천 포인트
                        </h3>
                        <div class="">
                            <p class="description-sec2" style="letter-spacing: 1px">
                                <?= viewSQ($spa['product_info']) ?>
                            </p>
                        </div>
                        <div class="tag-list-icon mt-20">
                            <?php foreach ($fresult4 as $row) : ?>
                                <div class="item-tag">
                                    <img src="/data/code/<?= $row['ufile1'] ?>" alt="<?= $row['code_name'] ?>">
                                    <span><?= $row['code_name'] ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <h2 class="sub-title-sec2">
                            인기 시설 및 서비스
                        </h2>
                        <div class="tag_list_done">
                            <?php foreach ($bresult4 as $row) : ?>
                                <div class="item_done">
                                    <img src="/uploads/icons/done_icon.png" alt="done_icon">
                                    <span><?= $row['code_name'] ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <h2 class="sub-title-sec2">
                            호텔주변 추천명소
                        </h2>
                        <div class="post-list-sec2">
                            <?php foreach ($fresult8 as $row) : ?>
                                <div class="">
                                    <img src="/data/code/<?= $row['ufile1'] ?>" alt="hotel_thumbnai_1">
                                    <span><?php if ($row['type']) { ?> <?= $row['type'] ?>: <?php } ?> <?= $row['code_name'] ?>(<?= $row['distance'] ?>)</span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="section4" id="section4">
                        <h2 class="title-sec4">시설 &amp; 서비스</h2>
                        <div class="list-tag-sec4" style="flex-wrap: wrap; gap: 30px; justify-content: start; ">
                            <?php foreach ($fresult5 as $row2): ?>
                                <div class="tag-container-item-sec4"
                                     style="width: calc((100% - 120px)/4); padding-right: 70px">
                                    <div class="tag-item-title"> <?= $row2['code_name'] ?> </div>
                                    <ul class="tag-item-list">
                                        <?php $child = $row2['child'];
                                        foreach ($child as $item2): ?>
                                            <li><?= $item2['code_name'] ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php
                    $product_more = $spa['product_more'];
                    $breakfast_data_arr2 = [];
                    if ($product_more) {
                        $productMoreData = json_decode($product_more, true);

                        if (json_last_error() !== JSON_ERROR_NONE) {
                            die("Lỗi giải mã JSON: " . json_last_error_msg());
                        }
                        $breakfast_data = '';
                        if ($productMoreData) {
                            $meet_out_time = $productMoreData['meet_out_time'];
                            $children_policy = $productMoreData['children_policy'];
                            $baby_beds = $productMoreData['baby_beds'];
                            $deposit_regulations = $productMoreData['deposit_regulations'];
                            $pets = $productMoreData['pets'];
                            $age_restriction = $productMoreData['age_restriction'];
                            $smoking_policy = $productMoreData['smoking_policy'];
                            $breakfast = $productMoreData['breakfast'];
                            $breakfast_data = $productMoreData['breakfast_data'];
                        }

                        $breakfast_data_arr = explode('||||', $breakfast_data);
                        $breakfast_data_arr = array_filter($breakfast_data_arr);


                        foreach ($breakfast_data_arr as $dataBreakfast) {
                            $dataBreakfastArr = explode('::::', $dataBreakfast);
                            $breakfast_data_arr2[$dataBreakfastArr[0]] = $dataBreakfastArr[1];
                        }
                    }
                    ?>

                    <div class="section5" id="section5">
                        <h1 class="title-sec5">호텔정책</h1>
                        <div class="content-container-sec5">
                            <div class="content-item">
                        <span class="label">서비스 정책
                        </span>
                                <div class="description">
                                    <p><?= nl2br($meet_out_time ?? '') ?></p>
                                </div>
                            </div>
                            <div class="content-item">
                        <span class="label">
                            결제 정책
                        </span>
                                <div class="description">
                                    <p><?= nl2br($children_policy ?? '') ?></p>
                                </div>
                            </div>
                            <div class="content-item">
                        <span class="label">
                            할인 정책
                        </span>
                                <div class="description">
                                    <p><?= nl2br($baby_beds ?? '') ?></p>
                                </div>
                            </div>
                            <div class="content-item">
                        <span class="label">
                            개인청보 보안 정책
                        </span>
                                <div class="description">
                                    <p><?= nl2br($breakfast ?? '') ?></p>
                                </div>
                            </div>
                            <div class="content-item">
                        <span class="label">
                            보증금 규정
                        </span>
                                <div class="description">
                                    <p> <?= nl2br($deposit_regulations ?? '') ?> </p>
                                </div>
                            </div>
                            <div class="content-item">
                        <span class="label">
                            반려동물
                        </span>
                                <div class="description">
                                    <p> <?= nl2br($pets ?? '') ?> </p>
                                </div>
                            </div>
                            <div class="content-item">
                        <span class="label">
                            연령 제한
                        </span>
                                <div class="description">
                                    <p> <?= nl2br($age_restriction ?? '') ?> </p>
                                </div>
                            </div>
                            <div class="content-item">
                        <span class="label">
                            흡연 정책
                        </span>
                                <div class="description">
                                    <p> <?= nl2br($smoking_policy ?? '') ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section6" id="section6">
                        <h2 class="title-sec6"><span>생생리뷰</span>(516)</h2>
                        <div class="rating-content">
                            <div class="rating-left">
                                <img src="/uploads/icons/start_big_icon.png" alt="start_big_icon">
                                <strong>0/5</strong>
                            </div>
                            <span class="rating-right text-gray">0개 고객기준</span>
                        </div>
                        <div class="list-label-tag">
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571645_fb53d1d73b0b13dcf6c2.png" alt="청결">
                                <div class="label-tag-item-text">
                                    <strong>청결</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571657_b1cb8c4fb89a788c1351.png" alt="시설">
                                <div class="label-tag-item-text">
                                    <strong>시설</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571664_f42ea530f35c89161075.png" alt="위치">
                                <div class="label-tag-item-text">
                                    <strong>위치</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571671_ae94a9dbd753c419c162.png" alt="직원친절도">
                                <div class="label-tag-item-text">
                                    <strong>직원친절도</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571681_6b866f4a413112dac498.png" alt="가성비">
                                <div class="label-tag-item-text">
                                    <strong>가성비</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571686_6eb5cc9b65925faeb2d7.png" alt="편안함">
                                <div class="label-tag-item-text">
                                    <strong>편안함</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-list-flex">
                            <div class="card-list-recommemded">
                            </div>
                        </div>

                    </div>
                    <div class="section7">
                        <div class="d_flex justify_content_end">
                            <h1 class="title-sec7">다른 추천 호텔도 확인해 보세요 : )</h1>
                            <div class="swiper_product_list_pagination_ swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                                <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                                      role="button" aria-label="Go to slide 1" aria-current="true"></span><span
                                        class="swiper-pagination-bullet" tabindex="0" role="button"
                                        aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet"
                                                                                tabindex="0" role="button"
                                                                                aria-label="Go to slide 3"></span><span
                                        class="swiper-pagination-bullet" tabindex="0" role="button"
                                        aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet"
                                                                                tabindex="0" role="button"
                                                                                aria-label="Go to slide 5"></span><span
                                        class="swiper-pagination-bullet" tabindex="0" role="button"
                                        aria-label="Go to slide 6"></span><span class="swiper-pagination-bullet"
                                                                                tabindex="0" role="button"
                                                                                aria-label="Go to slide 7"></span><span
                                        class="swiper-pagination-bullet" tabindex="0" role="button"
                                        aria-label="Go to slide 8"></span><span class="swiper-pagination-bullet"
                                                                                tabindex="0" role="button"
                                                                                aria-label="Go to slide 9"></span></div>
                        </div>
                        <div class="sub_tour_section7_product_list swiper swiper_product_list_ swiper-initialized swiper-horizontal swiper-backface-hidden">
                            <div class="swiper-wrapper" id="swiper-wrapper-c2d811557361007f3" aria-live="polite">
                                <a href="/product-hotel/hotel-detail/1903"
                                   class="sub_tour_section7_product_item swiper-slide swiper-slide-active" role="group"
                                   aria-label="1 / 9" data-swiper-slide-index="0"
                                   style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729148402_57621970b7c154b4133b.png" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        앤린 브라운초코TEST
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">0 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        2,490,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                                <a href="/product-hotel/hotel-detail/1904"
                                   class="sub_tour_section7_product_item swiper-slide swiper-slide-next" role="group"
                                   aria-label="2 / 9" data-swiper-slide-index="1"
                                   style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729149866_75b2d3c7243db130bc83.png" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        앤린 브라운초코dcxf
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">0 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        2,490,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                                <a href="/product-hotel/hotel-detail/1906"
                                   class="sub_tour_section7_product_item swiper-slide" role="group" aria-label="3 / 9"
                                   data-swiper-slide-index="2" style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729155757_13e9d124be865ed9c3f1.jpg" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        Le Resort and Villas
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">0 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        250,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                                <a href="/product-hotel/hotel-detail/1907"
                                   class="sub_tour_section7_product_item swiper-slide" role="group" aria-label="4 / 9"
                                   data-swiper-slide-index="3" style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729156828_c7ab80490d62feae7cfc.jpg" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        Phuket Meet Holiday Hotel 普吉岛相遇花园度假酒店
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">0 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        180,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                                <a href="/product-hotel/hotel-detail/1908"
                                   class="sub_tour_section7_product_item swiper-slide" role="group" aria-label="5 / 9"
                                   data-swiper-slide-index="4" style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729216984_38c590485764c8393d9f.jpg" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        두짓타니 방콕
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">0 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        215,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                                <a href="/product-hotel/hotel-detail/1909"
                                   class="sub_tour_section7_product_item swiper-slide" role="group" aria-label="6 / 9"
                                   data-swiper-slide-index="5" style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729218390_4e294aa87b7121d33db1.jpg" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        아난타라 시암 방콕 호텔
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">4.5 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        235,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                                <a href="/product-hotel/hotel-detail/1910"
                                   class="sub_tour_section7_product_item swiper-slide" role="group" aria-label="7 / 9"
                                   data-swiper-slide-index="6" style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729236201_c186b2b44a7bc9843938.jpg" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        The Fig Lobby
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">0 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        160,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                                <a href="/product-hotel/hotel-detail/1911"
                                   class="sub_tour_section7_product_item swiper-slide" role="group" aria-label="8 / 9"
                                   data-swiper-slide-index="7" style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729237315_8e77976ccb66ee6de3d6.jpg" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        르 드텔 방콕
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">0 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        120,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                                <a href="/product-hotel/hotel-detail/1912"
                                   class="sub_tour_section7_product_item swiper-slide" role="group" aria-label="9 / 9"
                                   data-swiper-slide-index="8" style="width: 292.5px; margin-right: 10px;">

                                    <div class="img_box img_box_12">
                                        <img src="/data/hotel/1729498392_26fc8b1964767785461b.png" alt="main"
                                             onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                    </div>
                                    <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                    </div>
                                    <div class="prd_name">
                                        테스트 상품
                                    </div>
                                    <div class="prd_info">
                                        <div class="prd_info__left">
                                            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                            <span class="star_avg">0 </span>
                                        </div>
                                        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                        <div class="prd_info__right">
                                            <span class="prd_info__right__ttl">생생리뷰</span>
                                            <span class="new_review_cnt">(0)</span>
                                        </div>
                                    </div>
                                    <div class="prd_price_ko">
                                        180,000 <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
                                    </div>
                                </a>
                            </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                    </div>
                </div>
                <div class="vertical-line"></div>

                <div class="_wrap-payment">
                    <div class="price-right-c">
                        <div class="view_nav" id="sticky" style="position: sticky; top: 30px;">
                            <div class="scroll_box">

                                <div class="cho_nav">
                                    <p class="date_label">
                                        <i></i> <span>출발일 <span id="select_date">2024-10-30</span></span>
                                    </p>

                                    <p class="label item_label">예약인원을 확인해주세요.</p>

                                    <ul class="select_peo">
                                        <li class="flex_b_c cus-count-input">
                                            <div class="payment">
                                                <p class="ped_label">성인 </p>
                                                <p class="money adult">
                                                    <span id="adult_msg">담당자에게 문의해주세요</span>
                                                    <!-- <strong>0</strong> 원 -->
                                                </p>
                                            </div>
                                            <div class="opt_count_box count_box flex__c">
                                                <button type="button" class="minus_btn" id="minusAdult"></button>
                                                <input type="text" class="input-qty" name="qty" id="adultQty" value="2"
                                                       readonly="">
                                                <button type="button" class="plus_btn" id="addAdult"></button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="item_option">
                                    <!-- opt_list -->
                                    <div class="opt_list">
                                        <strong class="label">옵션선택</strong>

                                        <div class="opt_select_wrap">
                                            <!-- opt_select -->
                                            <div class="opt_select disabled">
                                                <!--button type="button" class="now_txt "><em>선택</em> <i></i></button-->
                                                <select name="moption" id="moption" onchange="sel_moption(this.value);">
                                                    <option value="">선택</option>

                                                    1
                                                    <option value="3">1111</option>
                                                </select>
                                                <!--li>
                                      <button type="button" class="view_txt">[멜버른] 툴라마린 공항 고속버스 시내이동 서비스 예약 (편도/왕복 티켓)</button>
                                    </li>
                                    <li>
                                      <button type="button" class="view_txt">[호주] 골드코스트 드림월드 입장권 티켓 (오픈티켓)</button>
                                    </li>
                                    <li>
                                      <button type="button" class="view_txt">[호주/골드코스트] 파라다이스 컨트리팜 입장권 티켓</button>
                                    </li-->

                                            </div>
                                            <!-- // opt_select // -->
                                            <!-- opt_select -->
                                            <div class="opt_select disabled sel_option" id="sel_option">
                                                <!--button type="button" class="now_txt"><em>선택</em> <i></i></button-->
                                                <select name="option" id="option" onchange="sel_option(this.value);">";
                                                    <option value="">옵션 선택</option>

                                                    <!--ul class="scroll_box" id="sel_option">
                                          li>
                                            <button type="button">
                                              <div class="payment">
                                                <p class="ped_label view_txt">성인 (만 12세이상) </p>
                                                <p class="money "><strong>170,000</strong> 원</p>
                                              </div>
                                            </button>
                                          </li>
                                          <li>
                                            <button type="button">
                                              <div class="payment">
                                                <p class="ped_label view_txt">아동 (만 12세 미만)  </p>
                                                <p class="money "><strong>150,000</strong> 원</p>
                                              </div>
                                            </button>
                                          </li
                                        </ul-->
                                                </select>
                                            </div>
                                            <!-- // opt_select // -->
                                        </div>


                                        <!-- opt_result_wrap -->
                                        <div class="opt_result_wrap option_item" id="option_item">
                                            <!--div class="opt_result_box">
                                      <div class="flex_b">
                                      <div class="opt_name">선택2 - [시드니] 호주 블루마운틴 + 페더데일 동물원 일일투어 # 킹스테이블랜드 성인 (만 12세 이상)</div>
                                        <button type="button" class="opt_del_btn"></button>
                                      </div>
                                      <div class="opt_count_box">
                                        <button type="button" class="minus_btn"></button>
                                        <input type="number" name="" id="" value="1">
                                        <button type="button" class="plus_btn"></button>
                                      </div>
                                      <div class="opt_total_price"><strong>68,900</strong>원</div>
                                    </div-->
                                        </div>
                                        <!-- //opt_result_wrap -->

                                    </div>
                                    <!-- // opt_list -->
                                </div>
                            </div>


                            <div class="total_paymemt payment">
                                <!--p class="ped_label">총 예약금액</p-->
                                <p class="money"><span
                                            style="margin-right:50px;"><strong>합계</strong></span><strong><span
                                                id="total_sum" class="total_sum">0</span> 원</strong></p>
                            </div>
                            <h3 class="title-r label">약관동의</h3>
                            <div class="item-info-check-first">
                                <span>전체동의</span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <div class="item-info-check">
                                <span>이용약관 동의(필수)</span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <div class="item-info-check">
                                <span>개인정보 처리방침(필수)</span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <div class="item-info-check">
                            <span>개인정보 제3자 제공 및 국외 이전 동의(필수)
                            </span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <div class="item-info-check">
                                <span>여행안전수칙 동의(필수)</span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <div class="nav_btn_wrap">
                                <a href="/product-spa/product-booking/8386">
                                    <button type="button" class="btn-point" onclick="order_it();">상품 예약하기</button>
                                </a>
                                <div class="flex">
                                    <button type="button" class="btn-default"
                                            onclick="location='/inquiry/inquiry_write.php?product_idx=1219'">상담 문의하기
                                    </button>

                                    <!-- delete  -->
                                    <!-- <button type="button" class="btn-default wish_btn "
                            onclick="javascript:wish_it('1219')"><i></i></button> -->

                                </div>
                            </div>
                        </div>
                    </div>
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

        $('.list-icon img[alt="heart_icon"]').click(function () {
            if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
                $(this).attr('src', '/uploads/icons/heart_on_icon.png');
            } else {
                $(this).attr('src', '/uploads/icons/heart_icon.png');
            }
        });

        $('.quantity-container').each(function () {
            var $container = $(this);
            var $quantityDisplay = $container.find('.quantity');
            var $increaseBtn = $container.find('.increase');
            var $decreaseBtn = $container.find('.decrease');
            var quantity = 0;

            $increaseBtn.click(function () {
                quantity++;
                $quantityDisplay.text(quantity);
                $decreaseBtn.removeAttr('disabled');
            });

            $decreaseBtn.click(function () {
                if (quantity > 0) {
                    quantity--;
                    $quantityDisplay.text(quantity);
                }
                if (quantity === 0) {
                    $decreaseBtn.attr('disabled', true);
                }
            });
        });

        const swiper_content = new Swiper(".swiper-container_tour_content", {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 100,
            pagination: {
                el: ".swiper-tour_content-pagination",
            },
        });

        viewCal();

        function fn_click_be() {
            var s_yy = parseInt($("#s_yy").text().trim());
            var s_mm = parseInt($("#s_mm").text().trim());

            var s_yy2 = s_yy;
            var s_mm2 = s_mm;

            if (s_mm === 1) {
                s_mm = 12;
                s_yy = s_yy - 1;
            } else {
                s_mm = s_mm - 1;
            }

            s_mm = s_mm < 10 ? "0" + s_mm : s_mm;

            $("#s_yy").text(s_yy);
            $("#s_mm").text(s_mm);

            if (parseInt($("#s_yy").text().trim()) !== s_yy) {
                $("#s_yy").text(s_yy2);
                $("#s_mm").text(s_mm2);
                return false;
            }

            $("#select_date").text('');
            $("#sel_date").val('');

            viewCal();
        }

        // 다음달
        function fn_click_ne() {
            var s_yy = parseInt($("#s_yy").text().trim());
            var s_mm = parseInt($("#s_mm").text().trim());

            var s_yy2 = s_yy;
            var s_mm2 = s_mm;

            if (s_mm === 12) {
                s_mm = 1;
                s_yy = s_yy + 1;
            } else {
                s_mm = s_mm + 1;
            }

            s_mm = s_mm < 10 ? "0" + s_mm : s_mm;

            $("#s_yy").text(s_yy);
            $("#s_mm").text(s_mm);

            if (parseInt($("#s_yy").text().trim()) !== s_yy) {
                $("#s_yy").text(s_yy2);
                $("#s_mm").text(s_mm2);
                return false;
            }

            $("#select_date").text('');
            $("#sel_date").val('');

            viewCal();
        }

        function viewCal_sel(dateY, dateM) {
            $("#s_yy").text(dateY);
            $("#s_mm").text(dateM);

            viewCal();
        }

        function viewCal() {
            var today = new Date();
            var defaultYear = today.getFullYear();
            var defaultMonth = today.getMonth() + 1;

            var s_yy = parseInt($("#s_yy").text().trim());
            var s_mm = parseInt($("#s_mm").text().trim());
            s_yy = isNaN(s_yy) ? defaultYear : s_yy;
            s_mm = isNaN(s_mm) ? defaultMonth : s_mm;

            $("#s_yy").text(s_yy);
            $("#s_mm").text(s_mm);

            var currentDay = today.getDate();
            var currentMonth = today.getMonth() + 1;
            var currentYear = today.getFullYear();

            var firstDayOfMonth = new Date(s_yy, s_mm - 1, 1);
            var lastDayOfMonth = new Date(s_yy, s_mm, 0).getDate();
            var startDay = firstDayOfMonth.getDay();

            var daysHTML = "<div class='week'>";

            for (var i = 0; i < startDay; i++) {
                daysHTML += "<p class='day'><span>&nbsp;</span></p>";
            }

            var currDate = `${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(currentDay).padStart(2, '0')}`;

            for (var day = 1; day <= lastDayOfMonth; day++) {
                var priceLabel;
                var isToday = "";
                var isDeadline = "";
                var checkDate = `${s_yy}-${String(s_mm).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

                if (checkDate < currDate) {
                    priceLabel = '<span class="label sold-out-text">예약마감</span>';
                    isDeadline = " deadline";
                } else {
                    isToday = (day === currentDay && s_mm === currentMonth && s_yy === currentYear) ? " current-day" : "";
                    priceLabel = '<span class="label allow-text">예약가능</span>';
                }

                var s_dd = day < 10 ? "0" + day : day;
                var selDate = `${s_yy}-${String(s_mm).padStart(2, '0')}-${s_dd}`;

                if ($("#sel_date").val() != "" && $("#sel_date").val() == selDate) {
                    daysHTML += `<p class='day${isToday}${isDeadline}' style='background-color: #FFCB08;cursor: none;'><span class='date_number sel_date' data-date='${selDate}'>${day}</span><br><span class='label sel_date' data-date='${selDate}'>${priceLabel}</span></p>`;
                } else if (isDeadline) {
                    daysHTML += `<p class='day deadline sel_date' data-date='${selDate}' style='cursor: none;'><span class='date_number sel_date' data-date='${selDate}'>${day}</span><br><span class='label sel_date' data-date='${selDate}'>${priceLabel}</span></p>`;
                } else {
                    daysHTML += `<p class='day${isToday} sel_date' data-date='${selDate}'><span class='date_number sel_date' data-date='${selDate}'>${day}</span><br><span class='label sel_date' data-date='${selDate}'>${priceLabel}</span></p>`;
                }

                if ((startDay + day) % 7 === 0) {
                    daysHTML += "</div><div class='week'>";
                }
            }

            var remainingDays = 7 - ((startDay + lastDayOfMonth) % 7);
            if (remainingDays < 7) {
                for (var j = 0; j < remainingDays; j++) {
                    daysHTML += "<p class='day sel_date'><span>&nbsp;</span></p>";
                }
            }

            daysHTML += "</div>";

            $("#option_cal").html(daysHTML);
        }


        function getPriceLabel(status) {
            if (status === "예약가능") return '<span class="label allow-text">예약가능</span>';
            if (status === "예약마감") return '<span class="label sold-out-text">예약마감</span>';
            return '<span></span>';
        }

        // 버튼이 동적으로 생성된 경우에도 클릭 이벤트 적용
        $(document).on('click', '.sel_date', function () {

            var order_no = $("#order_no").val();

            $.ajax({

                url: "/ajax/ajax.order_delete.php",
                type: "POST",
                data: {
                    "order_no": order_no
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    var cnts = data.cnts;
                    var message = data.message;
                    //alert(message);
                    if (cnts > 0) alert(message);
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

            var product_idx = $("#product_idx").val(); // "example"을 반환
            var sel_date = $(this).data('date'); // "example"을 반환
            if (sel_date) {
                $("#select_date").text(sel_date);
                $("#sel_date").val(sel_date);
                $("#order_date").val(sel_date);
                //location.href='/t-package/item_view.php?product_idx='+product_idx+'&order_date='+sel_date+'&sel_date='+sel_date+'#flex';
                $("#frmOrder").attr("action", "/t-package/item_view.php#flex").submit();

            }
        });

        const optCountBoxes = document.querySelectorAll('.opt_count_box');
        optCountBoxes.forEach(box => {
            const minusButton = box.querySelector('.minus_btn');
            const plusButton = box.querySelector('.plus_btn');
            const inputField = box.querySelector('.input-qty');

            minusButton.addEventListener('click', () => {
                let currentValue = parseInt(inputField.value, 10);
                if (currentValue > 0) {
                    inputField.value = currentValue - 1;
                }
            });

            plusButton.addEventListener('click', () => {
                let currentValue = parseInt(inputField.value, 10);
                inputField.value = currentValue + 1;
            });
        });
    </script>

    <div id="dim"></div>
    <div id="popupRoom" class="on">
        <strong id="pop_roomName"></strong>
        <div>
            <ul class="multiple-items">
            </ul>
        </div>
        <a class="closed_btn" href=""><img src="/images/ico/close_ico_w.png" alt="close"/></a>
    </div>

    <div id="popup_img" class="on">
        <strong id="pop_roomName"></strong>
        <div>
            <ul class="multiple-items">
            </ul>
        </div>
        <a class="closed_btn" href=""><img src="/images/ico/close_ico_w.png" alt="close"/></a>
    </div>
    <script>
        /* hotel_view popup */
        jQuery(document).ready(function () {
            var dim = $('#dim');
            var popup = $('#popupRoom');
            var closedBtn = $('#popupRoom .closed_btn');

            var popup2 = $('#popup_img');
            var closedBtn2 = $('#popup_img .closed_btn');

            /* closed btn*/
            closedBtn.click(function () {
                popup.hide();
                dim.fadeOut();
                $('.multiple-items').slick('unslick'); // slick 삭제
                return false;
            });

            closedBtn2.click(function () {
                popup2.hide();
                dim.fadeOut();
                $('.multiple-items').slick('unslick'); // slick 삭제
                return false;
            });
        });

        function fn_pops(ridx, roomName) {
            var dim = $('#dim');
            var popup = $('#popupRoom');

            $("#pop_roomName").text(roomName);

            $.ajax({
                url: "/api/products/roomPhoto",
                type: "POST",
                data: 'ridx=' + ridx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                },
                success: function (response, status, request) {

                    $(".multiple-items").html(response.data);

                    popup.show();
                    dim.fadeIn();

                    $('.multiple-items').slick({
                        slidesToShow: 1,
                        initialSlide: 0,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        dots: true,
                        focusOnSelect: true
                    });

                    return false;

                }
            });
        }

        function img_pops(idx) {
            var dim = $('#dim');
            var popup = $('#popup_img');

            $.ajax({
                url: "/api/products/hotelPhoto",
                type: "POST",
                data: 'idx=' + idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                },
                success: function (response, status, request) {

                    $(".multiple-items").html(response.data);

                    popup.show();
                    dim.fadeIn();

                    $('.multiple-items').slick({
                        slidesToShow: 1,
                        initialSlide: 0,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        dots: true,
                        focusOnSelect: true
                    });

                    return false;

                }
            });
        }
    </script>
<?php $this->endSection(); ?>