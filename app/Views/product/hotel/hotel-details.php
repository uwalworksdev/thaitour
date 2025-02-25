<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<link rel="stylesheet" type="text/css" href="/lib/daterangepicker/daterangepicker_custom.css" />
<script type="text/javascript" src="/lib/momentjs/moment.min.js"></script>
<script type="text/javascript" src="/lib/daterangepicker/daterangepicker.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw3G5DUAOaV9CFr3Pft_X-949-64zXaBg&libraries=geometry"
    async defer></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<style>
    .text_truncate_ {
        /*display: -webkit-box !important;*/
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: nowrap;
        max-height: 4rem;
        text-overflow: ellipsis;
        position: relative;
    }

    .main_page_01 .main_visual_content_ {
        z-index: 5;
    }

    .form_gr_ {
        width: 500px;
        gap: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #dbdbdb;
        border-radius: 6px;
    }

    .main_page_01 .main_visual_content_ .form_element_ .form_gr_item_ {
        max-width: unset;
        max-height: 75px;
        overflow: hidden;
    }

    .main_page_01 .main_visual_content_ .form_element_ .form_gr_item_ input {
        border: hidden;
    }

    .main_page_01 .main_visual_content_ .form_element_ .form_gr_item_flex_ label {
        left: unset;
        right: 20px;
    }

    .main_page_01 .main_visual_content_ .form_element_ .form_gr_item_flex_ input {
        text-align: end;
    }

    .content-sub-hotel-detail .room-table td:nth-child(2) {
        /* display: flex;
            flex-direction: column;
            height: 100%;
            border: none; */
    }

    .content-sub-hotel-detail .room-details {
        height: auto;
    }

    .content-sub-hotel-detail .room-table td:nth-child(1) {
        /* padding-bottom: 270px; */
    }

    .price_bath {
        color: #888;
        font-size: 19px;
        font-weight: 500;
    }

    .view_promotion {
        position: relative;
    }

    .content-sub-hotel-detail .room-details ul li {
        list-style-type: disc;
        line-height: 1.5rem;
        display: flex;
        gap: 5px;
    }

    .view_promotion1:hover .layer_promotion1 {
        display: block;
    }

    .view_promotion2:hover .layer_promotion2 {
        display: block;
    }
    .layer_promotion {
        position: absolute;
        height: auto;
        background: #183153;
        color: #fff;
        border: none;
        top: 25px;
        left: 50%;
        transform: translateX(-50%);
        transition: all .2s;
        overflow: initial;
        padding: 10px;
        display: none;
        z-index: 10;
        min-width: 200px;
        text-align: center;
    }

    .layer_promotion p {
        margin-bottom: 0 !important;
    }

    .layer_promotion:before {
        content: '';
        border-bottom: 6px solid #183153;
        border-right: 6px solid transparent;
        border-left: 6px solid transparent;
        position: absolute;
        top: -5px;
        left: 50%;
        transform: translateX(-50%);
    }

    /* swipper */

    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper {
        width: 100%;
        height: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        background-size: cover;
        background-position: center;
    }

    .mySwiper2 {
        /* height: 80%; */
        width: 100%;
    }

    .mySwiper {
        height: 64px;
        box-sizing: border-box;
        padding: 2px 0;
    }

    .mySwiper .swiper-slide {
        width: 64px;
        height: 100%;
        opacity: 0.4;
    }

    .mySwiper .swiper-slide-thumb-active {
        opacity: 1;  
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media screen and (max-width: 850px) {
        .text_truncate_ {
            margin-top: 2rem;
        }

        .sub_tour_section5_item {
            width: calc((100% - 2rem) / 2);
        }

        .thailand_hotel_ .prd_keywords {
            flex-wrap: nowrap;
        }

        .prd_keywords .prd_keywords_cus_span {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .prd_keywords .prd_keywords_cus_span:last-child {
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            margin-left: 0.3846rem;
        }

        .form_gr_ {
            width: unset;
            gap: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: none;
            border-radius: 6px;
        }

        .main_page_01 .main_visual_content_ label {
            top: 1rem;
        }

        .main_page_01 .sub_tour_section7_product_list {
            margin-bottom: 2rem;
        }

        .content-sub-hotel-detail .room-table td:nth-child(1) {
            padding-bottom: 27rem;
        }

        .price_bath {
            color: #888;
            font-size: 3rem;
            font-weight: 500;
        }

    }

    .hotel_popup_ {
        display: none;
        position: absolute;
        top: 215px;
        left: 20px;
        z-index: 10;
    }

    .hotel_popup_.show {
        display: block;
    }

    .hotel_popup_content_ {
        background: #fff;
        border: 1px solid #dadfe6;
        border-radius: 8px;
        width: 420px;
        padding: 5px;
    }

    .hotel_popup_ttl_ {
        background: #f7f7fb;
        color: #666;
        font-size: 14px;
        font-weight: 700;
        height: 32px;
        line-height: 32px;
    }

    .list_popup_list_ {
        align-items: flex-start;
        display: flex;
        flex-wrap: wrap;
        padding: 8px;
    }

    .list_popup_item_ {
        box-sizing: border-box;
        cursor: pointer;
        font-size: 14px;
        overflow: hidden;
        padding: 10px 16px;
        text-overflow: ellipsis;
        width: 20%;
        -webkit-box-orient: vertical;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        border-radius: 4px;
        word-break: break-word;
    }

    .main_page_01 .main_visual_content_ .form_element_ {
        justify-content: center;
    }

    .hotel_day_popup_ {
        top: 185px !important;
    }

    .section3 .grid2_2_1 img {
        cursor: pointer;
    }

    .content-sub-hotel-detail .price-details {
        align-items: flex-start;
    }

    .content-sub-hotel-detail ._wrap_qty {
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dbdbdb;
        border-radius: 6px;
        padding: 0 18px;
        height: 75px;
    }

    .content-sub-hotel-detail ._wrap_qty .room_activity {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px;
    }


    .content-sub-hotel-detail ._wrap_qty input.room_qty {
        width: 72px;
        height: 40px;
        border: 1px solid #dbdbdb;
        border-radius: 0;
        padding: 0;
        font-size: 16px;
        color: #353535;
        font-weight: normal;
        font-family: "Pretendard";
        text-align: center;
    }

    .content-sub-hotel-detail ._wrap_qty input.day_qty {
        width: 60px;
        height: 40px;
        border: 1px solid #dbdbdb;
        border-radius: 0;
        padding: 0;
        font-size: 16px;
        color: #353535;
        font-weight: normal;
        font-family: "Pretendard";
        text-align: center;
    }

    .content-sub-hotel-detail ._wrap_qty button {
        background-color: #fff;
        font-size: 22px;
        letter-spacing: -1px;
        line-height: 26px;
        text-align: center;
        padding: 24px;
        width: 40px;
        height: 40px;
        margin-left: 0;
        border: 1px solid #dbdbdb;
        border-radius: 0;
        padding: 0;
        color: #000;
    }

    .content-sub-hotel-detail ._wrap_qty span {
        margin-right: 15px;
        font-weight: 600;

    }


    .content-sub-hotel-detail .people_qty {
        text-align: center;
    }

    .content-sub-hotel-detail .people_qty img {
        margin-bottom: 10px;
        width: 20px;
    }

    .content-sub-hotel-detail .people_qty p {
        font-size: 16px;
        line-height: 1.5
    }

    .content-sub-hotel-detail .people_qty>a {
        padding-top: 16px;
        font-size: 16px;
        display: block;
        font-weight: 500;
    }

    .content-sub-hotel-detail .col_wrap_room_rates {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 20px;
        border-bottom: 1px solid #dbdbdb;
    }

    .content-sub-hotel-detail .wrap_btn_book {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;

    }

    .content-sub-hotel-detail .wrap_btn_book .wrap_btn_book_note {
        color: #757575;
        font-size : 14px;
    }

    .content-sub-hotel-detail .wrap_bed_type {
        padding-top : 26px;
    }

    .content-sub-hotel-detail .wrap_bed_type .tit {
        margin-bottom: 10px;
    }

    .content-sub-hotel-detail .wrap_bed_type .wrap_input_radio label {
        display: block;
        margin-bottom: 5px;
        font-size: 16px;
        color: #353535;
        padding-left: 20px;
        position: relative
    }

    .content-sub-hotel-detail .wrap_bed_type .wrap_input_radio label::before {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        top: 50%;
        left: 0px;
        transform: translateY(-50%);
        background-color: #fff;
        border: 1px solid #dbdbdb;
    }

    .content-sub-hotel-detail .wrap_bed_type .wrap_input_radio input:checked+label::before {
        border: 1px solid #0075ff;

    }

    .content-sub-hotel-detail .wrap_bed_type .wrap_input_radio input:checked+label::after {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: #0075ff;
        top: 50%;
        left: 3px;
        transform: translateY(-50%);
        border-radius: 50%;
    }

    .wrap_sec3_title {
        display: flex;
        align-items: center;
        gap : 20px;
        margin-bottom: 32px;
    }

    .content-sub-hotel-detail .title-sec3 {
        font-size: 24px;
        margin: 0;
    }

    .content-sub-hotel-detail .list-tag-sec3 {
        display: flex;
        gap: 10px;
        margin-bottom: 0;
        /* overflow: scroll hidden; */
        padding-bottom: 0;
    }

    .content-sub-hotel-detail .wrap_bed_type .tit {
        display: flex;
        align-items: center;
        gap: 5px
    }

</style>
<pre><?php print_r($viewedProducts); ?></pre>
<div class="main_page_01 page_share_ page_product_list_ content-sub-hotel-detail">
    <div class="body_inner">
        <div class="section1">
            <div class="title-container">
                <h2><?= $hotel['product_name'] ?> <span style="margin-left: 15px;"><?= $hotel['product_name_en'] ?></span> </h2>
                <div class="list-icon">
                    <img src="/uploads/icons/print_icon.png" alt="print_icon" class="only_web">
                    <img src="/uploads/icons/print_icon_mo.png" alt="print_icon_mo" class="only_mo">
                    <img src="/uploads/icons/heart_icon.png" alt="heart_icon" class="only_web"
                        onclick="wish_it('<?= $hotel['product_idx'] ?>')">
                    <img src="/uploads/icons/heart_icon_mo.png" alt="heart_icon_mo" class="only_mo"
                        onclick="wish_it('<?= $hotel['product_idx'] ?>')">
                    <img src="/uploads/icons/share_icon.png" alt="share_icon" class="only_web">
                    <img src="/uploads/icons/share_icon_mo.png" alt="share_icon_mo" class="only_mo">
                </div>
            </div>
            <div class="location-container">
                <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                <span class="text-gray"> <?= $product_stay['stay_address'] ?> </span>
            </div>
            <div class="rating-container">
                <img src="/uploads/icons/star_icon_mo.png" alt="star_icon_mo.png">
                <span><strong> <?= $hotel['review_average'] ?></strong></span>
                <span class="page_">생생리뷰 <strong
                        style="color: #000;">(<?= $hotel['total_review'] ?>)</strong></span>
                <span class="page_"><?= $fresult9['code_name'] ?></span>
                <?php
                $_arr = explode("|", $hotel['mbti']);

                $code_n0 = [];

                foreach ($mcodes as $mcode) {
                    if (in_array($mcode['code_no'], $_arr)) {
                        $code_n0[] = $mcode['code_name'];
                    }
                }
                ?>

                <span>추천 MBTI: <?= implode(', ', $code_n0) ?></span>

            </div>
            <?php
                // $i3 = count(array_filter(range(1, 7), fn($t) => !empty($hotel["ufile$t"])));

                if(!empty($hotel['ufile1'])) {
                    $i3 = 1;
                }else{
                    $i3 = 0;
                }
                $i3 += count($img_list);
            ?>

            <div class="hotel-image-container">
                <div class="hotel-image-container-1">
                    <img class="imageDetailMain_"
                        onclick="img_pops('<?= $hotel['product_idx'] ?>')"
                        src="/data/product/<?= $hotel['ufile1'] ?>"
                        alt="<?= $hotel['product_name'] ?>"
                        onerror="this.src='/images/share/noimg.png'">
                </div>
                <div class="grid_2_2">
                    <?php 
                        for ($j = 2; $j < 5; $j++) {
                    ?>
                        <img onclick="img_pops('<?= $hotel['product_idx'] ?>')"
                            class="grid_2_2_size imageDetailSup_"
                            src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>"
                            alt="<?= $hotel['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                    <?php } ?>
                    <div class="grid_2_2_sub"
                        onclick="img_pops('<?= $hotel['product_idx'] ?>')"
                        style="position: relative; cursor: pointer;">
                        <img class="custom_button imageDetailSup_"
                            src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>"
                            alt="<?= $hotel['product_name'] ?>"
                            onerror="this.src='/images/share/noimg.png'">
                        <div class="button-show-detail-image">
                            <img class="only_web" src="/uploads/icons/image_detail_icon.png"
                                alt="image_detail_icon">
                            <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png"
                                alt="image_detail_icon_m">
                            <span>사진 모두 보기</span>
                            <span>(<?= $i3 ?>장)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-header-hotel-detail">
                <div class="main nav-list">
                    <p class="nav-item active" onclick="scrollToEl('section1')" style="cursor: pointer">호텔소개</p>
                    <p class="nav-item" onclick="scrollToEl('section2')" style="cursor: pointer">숙소개요</p>
                    <p class="nav-item" onclick="scrollToEl('section3')" style="cursor: pointer">객실</p>
                    <p class="nav-item" onclick="scrollToEl('section4')" style="cursor: pointer">시설&서비스</p>
                    <p class="nav-item" onclick="scrollToEl('section5')" style="cursor: pointer">호텔 정책</p>
                    <p class="nav-item" onclick="scrollToEl('section6')" style="cursor: pointer">
                        생생리뷰(<?= $hotel['total_review'] ?>개)</p>
                </div>
                <div class="btn-container only_web">
                    <button type="button" onclick="scrollToEl('section3')">
                        객실선택
                    </button>
                </div>
            </div>
            <div class="btn-container cus-mb only_mo">
                <button type="button" onclick="scrollToEl('section3')">
                    객실선택
                </button>
            </div>
        </div>
		
        <div class="section1">
            <h2 class="title-sec2">
                호텔소개
            </h2>
            <div class="description-sec2" style="letter-spacing: 1px">
                <?= viewSQ($hotel['product_notes']) ?>
            </div>
        </div>

        <div class="section1">
            <h2 class="title-sec2">
                객실 안내
            </h2>
            <div class="description-sec2" style="letter-spacing: 1px">
                <?= viewSQ($hotel['room_guides']) ?>
            </div>
        </div>

        <!-- <div class="section1">
            <h2 class="title-sec2">
                중요 사항
            </h2>
            <div class="description-sec2" style="letter-spacing: 1px">
                <?= viewSQ($hotel['important_notes']) ?>
            </div>
        </div> -->
			
        <?php if ($hotel['product_video'] != ""): ?>
            <div class="section2">
                <h2 class="title-sec2">
                    동영상
                </h2>
                <div class="content-container-sec5" style="margin: 20px 0; width: 100%; height: 500px"
                    id="productVideo">

                </div>
            </div>
            <script>
                function generateIframe(youtubeLink) {
                    let videoId = youtubeLink.split("v=")[1];
                    let iframe = `<iframe width="100%" height="100%"
                                src="https://www.youtube.com/embed/${videoId}"
                                title="<?= $hotel['product_name'] ?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>`;

                    $('#productVideo').empty().append(iframe);
                }

                generateIframe('<?= $hotel['product_video'] ?>');
            </script>
        <?php endif; ?>

        <?php if ($hotel['latitude'] != "" && $hotel['longitude'] != ""): ?>
            <div class="section4">
                <h2 class="title-sec4">
                    위치안내
                </h2>

                <div class="section4_map" id="section4_map" style="width: 100%; height: 500px;">

                </div>
            </div>
            <script>
                const latitude = Number(`<?= $product_stay['latitude'] ?>`);
                const longitude = Number(`<?= $product_stay['longitude'] ?>`);

                function initMap() {
                    const location = {
                        lat: latitude,
                        lng: longitude
                    };
                    const map = new google.maps.Map(document.getElementById("section4_map"), {
                        zoom: 16,
                        center: location,
                    });

                    new google.maps.Marker({
                        position: location,
                        map: map,
                    });
                }

                window.onload = initMap;
            </script>
        <?php endif; ?>

        <div class="section2" id="section2">
            <h2 class="title-sec2">
                숙소개요
            </h2>
            <h3 class="sub-title-sec2">
                추천 포인트
            </h3>
            <p class="description-sec2" style="letter-spacing: 1px">
                <?= viewSQ($hotel['product_info']) ?>
            </p>
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
                <?php foreach ($places as $row) : ?>
                    <div class="">
                        <a class="" href="<?= $row['url'] ?>" target="_blank">
                            <img src="/data/code/<?= $row['ufile'] ?>" alt="hotel_thumbnai_1">
                        </a>
                        <a class="" href="<?= $row['url'] ?>" target="_blank">
                            <p class="text_truncate_"><?php if ($row['type']) { ?> <?= $row['type'] ?>: <?php } ?> <?= $row['name'] ?></p>
                        </a>
                        <p>(<?= $row['distance'] ?>)</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <section class="sub_top_visual" id="sub_top_visual">
            <div class="main_visual_content_">
                <div class="form_search">
                    <div class="form_element_">
                        <!--div class="form_input_">
                                        <label for="input_keyword_">여행지</label>
                                        <input type="text" id="input_keyword_" class="input_keyword_" placeholder="호텔 지역을 입력해주세요!">
                                    </div-->
                        <div class="form_input_multi_">
                            <div class="form_gr_" id="openDateRangePicker">
                                <div class="form_input_ form_gr_item_">
                                    <label for="input_day">체크인</label>
                                    <input type="text" id="input_day_start_"
                                        class="input_custom_ input_ranger_date_"
                                        placeholder="체크인 선택해주세요." readonly>
                                </div>
                                <p>
                                    <span id="countDay" class="count">0</span>박
                                </p>
                                <div class="form_input_ form_gr_item_ form_gr_item_flex_">
                                    <label for="input_day">체크아웃</label>
                                    <input type="text" id="input_day_end_" class="input_custom_ input_ranger_date_"
                                        placeholder="체크아웃 선택해주세요." readonly>
                                </div>
                            </div>

                        </div>

                        <div class="_wrap_qty">
                            <span>객실수 </span>
                            <div class="room_activity">
                                <button type="button" class="btnMinus">
                                    -
                                </button>
                                <input type="text" class="room_qty" id="room_qty" value="1">
                                <button type="button" class="btnPlus">
                                    +
                                </button>
                            </div>
                            <span>숙박일 </span>
                            <div class="day_activity">
                                <input type="text" class="day_qty" id="day_qty" value="1" readonly>
                            </div>

                        </div>
                        <div class="btn_search">
                            <button type="button" id="room_search">검색</button>
                        </div>

                        <!--div class="form_input_">
                                        <label for="input_hotel">호텔명(미입력 시 전체)</label>
                                        <input type="text" style="text-transform: none;" id="input_hotel" class="input_custom_"
                                               placeholder="호텔명을 입력해주세요.">
                                    </div-->
                        <!-- <button type="button" onclick="search_list();" class="btn_search_">
                                        확인
                                    </button> -->
                    </div>
                    <div class="date_hotel_detail" style="position: relative;">
                        <input
                            type="text"
                            id="daterange_hotel_detail"
                            class="daterange_hotel_detail" />
                    </div>
                    <div class="hotel_popup_">
                        <div class="hotel_popup_content_">
                            <div class="hotel_popup_ttl_">인기 여행지</div>
                            <div class="list_popup_list_">
                                <?php foreach ($sub_codes as $code_item) : ?>
                                    <div class="list_popup_item_"><?= $code_item['code_name'] ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- popup -->
                    <?php // $is_check = 123
                    ?>
                    <?php // echo view("/product/inc/hotel/init_day_popup_.php", ["is_check" => $is_check]);
                    ?>
                </div>
            </div>
        </section>
		
		<script>
			$(document).ready(function(){
				$("#room_search").click(function(){
						let date_check_in  = $("#input_day_start_").val();
						let date_check_out = $("#input_day_end_").val();

						if (!date_check_in && !date_check_out) {
							alert("체크인 날짜와 체크아웃 날짜를 선택해주세요!");
							return false;
						}				
						
						if (date_check_in == date_check_out) {
							alert("체크인 날짜와 체크아웃 날짜를 확인해주세요!");
							return false;
						}				
						
						var message = "";
						$.ajax({

							url: "/ajax/hotel_room_search",
							type: "POST",
							data: {
									"product_idx"   : $("#product_idx").val(),
									"date_check_in" : date_check_in,
									"date_check_out": date_check_out,
									"days"          : $("#day_qty").val()
							},
							dataType: "json",
							async: false,
							cache: false,
							success: function (data, textStatus) {
								message = data.message;
								$("#room_main").html(message);
								$("input[type=radio]").prop("disabled", false);
								$("#searchOk").val('Y');
							},
							error: function (request, status, error) {
								alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
							}
						});						
			    });
				
                $(document).on('click', 'input[name="bed_type_"]', function() {					
					let selectedValue = $('input[name="bed_type_"]:checked').val();
					var room_op_idx   = $(this).val();
					var bed_type      = $(this).data('type');
					var price         = parseInt($(this).data('won'));
					var room_qty      = parseInt($("#room_qty").val());
					var day_qty       = parseInt($("#day_qty").val());
					var total_last_price = price * room_qty;

					var data_won      = $(this).data('won'); 
					var data_bath     = $(this).data('bath'); 
					var bed_type      = $(this).data('type');
					var rooms_idx     = $(this).val();
					var room          = $(this).data('room');
					var room_type     = $(this).data('roomtype');
					var date_price    = $(this).data('price');
					var breakfast     = $(this).data('breakfast');
					var adult         = $(this).data('adult');
					var kids          = $(this).data('kids');
					
					//alert(date_price+'-'+data_won+'-'+data_bath+'-'+bed_type+'-'+rooms_idx+'-'+room_name);
					
					$("#bed_type").val(bed_type);
					$("#price").val(data_bath);
					$("#price_won").val(data_won);
					$("#rooms_idx").val(rooms_idx);
					$("#room").val(room);
					$("#room_type").val(room_type);
			        $("#date_price").val(date_price);
			        $("#breakfast").val(breakfast);
			        $("#adult").val(adult);
			        $("#kids").val(kids);
			
					$("#room_op_idx").val(room_op_idx);
					$("#total_last_price").val(total_last_price);
					//$(".reservation").prop('disabled', true);
					//$("#reserv_"+selectedValue).prop('disabled', false);
				});				
				
			});
		</script>
	
        <script>
            $(document).ready(function() {

                //$('.reservation').prop('disabled', true);
                //$("input[type=radio]").prop("disabled", true);

                const res = $.ajax({
                    url: `<?= route_to('api.hotel_.get_data') ?>?product_idx=<?= $hotel['product_idx'] ?>`,
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    success: function(response) {
                        return response;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching hotel data:', error);
                    }
                });

                const {
                    enabled_dates,
                    reject_days
                } = res.responseJSON.data;

                $('#daterange_hotel_detail').daterangepicker({
                        locale: {
                            format: 'YYYY-MM-DD',
                            separator: ' ~ ',
                            applyLabel: '적용',
                            cancelLabel: '취소',
                            fromLabel: '시작일',
                            toLabel: '종료일',
                            customRangeLabel: '사용자 정의',
                            daysOfWeek: ['일', '월', '화', '수', '목', '금', '토'],
                            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                            firstDay: 0
                        },
                        isInvalidDate: function(date) {
                            // const formattedDate = date.format('YYYY-MM-DD');
                            // return !enabled_dates.includes(formattedDate);
                        },
                        parentEl: ".date_hotel_detail",
                        linkedCalendars: true,
                        autoApply: true,
                        minDate: moment().add(1, 'days'),
                        opens: "center"
                    },
                    function(start, end) {

                        const startDate = moment(start.format('YYYY-MM-DD'));
                        const endDate = moment(end.format('YYYY-MM-DD'));

                        $('#input_day_start_').val(startDate.format('YYYY-MM-DD'));
                        $('#input_day_end_').val(endDate.format('YYYY-MM-DD'));

                        const duration = moment.duration(endDate.diff(startDate));

                        const days = Math.round(duration.asDays());

                        const disabledDates = reject_days.filter(date => {
                            const newDate = moment(date);
                            return newDate.isBetween(startDate, endDate, 'day', '[]');
                        })

                        $("#countDay").text(days - disabledDates.length);
                        $("#day_qty").val(days - disabledDates.length);

                        getPriceHotel(startDate.format('YYYY-MM-DD'), endDate.subtract(1, 'days').format('YYYY-MM-DD'));

                    });

                $('#openDateRangePicker').click(function() {
                    $('#daterange_hotel_detail').click();
                });

                const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        if (mutation.type === 'childList' && $(mutation.target).hasClass('calendar-table')) {
                            $(mutation.target)
                                .find('td.off.disabled')
                                .each(function() {
                                    const $cell = $(this);
                                    const text = $cell.text().trim();
                                    if (!$cell.find('.custom-info').length) {
                                        $cell.html(`<div class="custom-info">
                                            <span>${text}</span>
                                            <span class="label sold-out-text">마감</span>
                                            </div>`);
                                    }
                                });
                            $(mutation.target)
                                .find('td.available')
                                .each(function() {
                                    const $cell = $(this);
                                    const text = $cell.text().trim();
                                    if (!$cell.find('.custom-info').length) {
                                        $cell.html(`<div class="custom-info">
                                        <span>${text}</span>
                                        <span class="label allow-text">예약</span>
                                        </div>`);
                                    }
                                });
                            const filteredRows = $("tr").filter(function() {
                                const tds = $(this).find("td");
                                return tds.length > 0 && tds.toArray().every(td => $(td).hasClass("ends"));
                            }).hide();
                        }
                    });
                });
                observer.observe(document.querySelector('.date_hotel_detail .daterangepicker'), {
                    childList: true,
                    subtree: true,
                });

            });

            async function getPriceHotel(start_day, end_day) {
                let apiUrl = `<?= route_to('api.hotel_.get_price') ?>?product_idx=<?= $hotel['product_idx'] ?>&start_day=${start_day}&end_day=${end_day}`;
                try {
                    let response = await fetch(apiUrl);
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

                    let res = await response.json();
                    renderInputDay(res.data.data);
                } catch (error) {
                    console.error('Error fetching hotel data:', error);
                }
            }

            function renderInputDay(result) {
                result.forEach(item => {
                    const {
                        idx,
                        day,
                        price,
                        price_won,
                        sale_price,
                        sale_price_won,
                        op_won_bath,
                        is_disabled
                    } = item;

                    if (is_disabled) {
                        $(`.book_btn_${idx}`).attr('disabled', true).text("마감");
                    } else {
                        $(`.book_btn_${idx}`).attr('disabled', false).text("예약하기");
                    }

                    if (day > 0 && price_won > 0) {
                        $(`.input_day_qty_${idx}`).each(function() {
                            let inputElem = $(this);
                            if (op_won_bath == 'B') {
                                inputElem.closest(".room_op_").find(".hotel_price_day").text(price.toLocaleString('en-US') + " 바트");
                                inputElem.closest(".room_op_").find(".hotel_price_day").attr("data-price", price);
                                inputElem.closest(".room_op_").find(".hotel_price_day_sale").text(sale_price.toLocaleString('en-US'));
                                inputElem.closest(".room_op_").find(".totalPrice").attr('data-price', sale_price);
                                inputElem.val(day).attr('data-price', price).attr('data-sale_price', sale_price);
                            } else {
                                inputElem.closest(".room_op_").find(".hotel_price_day").text(price_won.toLocaleString('en-US') + " 원");
                                inputElem.closest(".room_op_").find(".hotel_price_day").attr("data-price", price_won);
                                inputElem.closest(".room_op_").find(".hotel_price_day_sale").text(sale_price_won.toLocaleString('en-US'));
                                inputElem.closest(".room_op_").find(".totalPrice").attr('data-price', sale_price_won);
                                inputElem.closest(".room_op_").find(".totalPrice").attr('data-price_bath', sale_price);
                                inputElem.val(day).attr('data-price', price_won).attr('data-sale_price', sale_price_won);
                            }
                            changeDataOptionPriceBk(inputElem);
                        });
                    }
                });
            }

            // const prices = {
            //     "2024-11-25": "11만",
            //     "2024-11-26": "15만",
            //     "2024-11-27": "20만",
            //     "2024-11-28": "18만",
            //     "2024-11-29": "12만"
            // };

            $(document).ready(function() {
                $('.list_popup_item_').click(function() {
                    let ttl = $(this).text();
                    $('#input_keyword_').val(ttl);
                    $('.hotel_popup_').removeClass('show');
                })

                $('#input_keyword_').on('click', function() {
                    $('.hotel_popup_').addClass('show');
                });
            })

            $(document).on('click', function(event) {
                const $popup = $('.hotel_popup_');
                const $input_keyword_ = $('#input_keyword_');
                if ($input_keyword_.has(event.target).length > 0 || $input_keyword_.is(event.target)) {
                    $popup.addClass('show');
                } else {
                    $popup.removeClass('show');
                }
            });

            /*$('#input_day_start_, #input_day_end_').daterangepicker({
                autoUpdateInput: false,
                opens: "center",
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' - ',
                    applyLabel: "적용",
                    cancelLabel: "취소",
                    fromLabel: "시작일",
                    toLabel: "종료일",
                    customRangeLabel: "사용자 정의",
                    weekLabel: "주",
                    daysOfWeek: ["일", "월", "화", "수", "목", "금", "토"],
                    monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
                    firstDay: 1
                },
                linkedCalendars: false
            }).on('apply.daterangepicker', function (ev, picker) {
                $('#input_day_start_').val(picker.startDate.format('YYYY-MM-DD'));
                $('#input_day_end_').val(picker.endDate.format('YYYY-MM-DD'));
                calcDistanceDay();
                // renderPriceData(picker);
            }).on('show.daterangepicker', function (ev, picker) {
                // renderPriceData(picker);
            }).on('showCalendar.daterangepicker', function (ev, picker) {
                // renderPriceData(picker);
            });*/

            // function renderPriceData(picker) {
            //     $('.drp-calendar td.available').each(function () {
            //         let day = $(this).text().trim();
            //         if (!day) return;

            //         let currentYear = picker.startDate.year();
            //         let currentMonth = (picker.startDate.month() + 1).toString().padStart(2, '0');
            //         let fullDate = `${currentYear}-${currentMonth}-${day.padStart(2, '0')}`;

            //         let price = prices[fullDate] || "0만";

            //         if (!$(this).find('.price-tag').length) {
            //             $(this).append(`<div class="price-tag">${price}</div>`);
            //         }
            //     });
            // }

            // function calcDistanceDay() {
            //     let input_day_start_ = $('#input_day_start_').val();
            //     let input_day_end_ = $('#input_day_end_').val();

            //     let start = new Date(input_day_start_);
            //     let end = new Date(input_day_end_);

            //     let diffInMilliseconds = end - start;
            //     let diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);

            //     $('#countDay').text(diffInDays);
            // }
        </script>

        <div class="section3" id="section3">
            <div class="flex wrap_sec3_title">
                <h3 class="title-sec3">
                    객실을 선택하세요
                </h3>
                <div class="list-tag-sec3">
                    <?php if (count($room_categories) > 0): ?>
                        <div class="tag-item-sec3<?= $s_category_room === '' ? '--main' : '' ?>"
                            onclick="go_category_room('')"
                            style="cursor: pointer">
                            모두
                        </div>
                    <?php endif; ?>
                    <?php
                    foreach ($room_categories as $row) : ?>
                        <?php if (isset($s_category_room) && $s_category_room === $row['code_no']) : ?>
                            <div class="tag-item-sec3--main">
                                <?= $row['code_name'] ?> (<?= $row['count'] ?>)
                            </div>
                        <?php else : ?>
                            <div class="tag-item-sec3" onclick="go_category_room(<?= $row['code_no'] ?>)"
                                style="cursor: pointer">
                                <?= $row['code_name'] ?> (<?= $row['count'] ?>)
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <script>
                function go_category_room(code) {
                    let currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.set('s_category_room', code);
                    currentUrl.hash = 'sub_top_visual';
                    window.location.href = currentUrl.toString();
                }
            </script>
			<div id="room_main">

			<?php foreach ($roomTypes as $type): ?>

			<div class="card-item-sec3">

                <div class="card-item-container">
                    <div class="card-item-left">
                        <div class="card-title-sec3-container">
                            <h2><?=$type['roomName']?> </h2>
                            <div class="label"><?=$type['scenery']?></div>
                        </div>
                        <div class="only_web">
                            <div class="grid2_2_1">
                                <img src="/uploads/rooms/<?=$type['img_list'][0]["ufile"]?>"
                                    style="width: 285px; border: 1px solid #dbdbdb; height: 190px"
                                    onclick="fn_pops('<?= $type['g_idx'] ?>', '<?= $type['roomName'] ?>')"
                                    onerror="this.src='/images/share/noimg.png'"
                                    alt="<?= $type['roomName'] ?>">
                                <div class=""
                                    style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%">
                                    <img class="imageDetailOption_"
                                        src="<?= isset($type['img_list'][1]["ufile"]) && $type['img_list'][1]["ufile"] ? '/uploads/rooms/' . $type['img_list'][1]["ufile"] : '/images/share/noimg.png' ?>"
                                        onclick="fn_pops('<?= $type['g_idx'] ?>', '<?= $type['roomName'] ?>')"
                                        onerror="this.src='/images/share/noimg.png'"
                                        alt="<?= $type['roomName'] ?>">

                                    <img class="imageDetailOption_"
                                        src="<?= isset($type['img_list'][2]["ufile"]) && $type['img_list'][2]["ufile"] ? '/uploads/rooms/' . $type['img_list'][2]["ufile"] : '/images/share/noimg.png' ?>"
                                        onclick="fn_pops('<?= $type['g_idx'] ?>', '<?= $type['roomName'] ?>')"
                                        onerror="this.src='/images/share/noimg.png'"
                                        alt="<?= $type['roomName'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="grid2_2_1_m only_mo">
                            <img src="/uploads/sub/hotel_item_1_1.png" alt="hotel_item_1_1">
                        </div>

                        <div class="wrap_btn_detail">
                            <a href="javascript:showPopupRoom('<?=$type['g_idx']?>');">객실 상세정보 및 사진 ></a>
                        </div>

                        <!-- <h2 class="subtitle">초대형 더블침대 1개 또는 싱글침대 2개</h2> -->

                        <!-- <div class="cus_scroll">
                            <ul class="cus_scroll_li">
								<?php
								$_arr = explode("|", $type['room_facil']);
								foreach ($fresult10 as $row_r) :
									$find = "";
									for ($i = 0; $i < count($_arr); $i++) {
										if ($_arr[$i]) {
											if ($_arr[$i] == $row_r['code_no']) $find = "Y";
										}
									}
									?>
									<?php if($find == "Y") { ?>
	                                <li><?=$row_r['code_name']?></li>
									<?php } ?>

								<?php endforeach; ?> -->
									
                                <!--li>책상</li>
                                <li>커피포트</li>
                                <li>전화</li>
                                <li>유료영화</li-->
                            <!-- </ul>
                        </div> -->

                        <?php
                            $arr_type_room = explode("|", $type['category']);
                            $arr_text_type = [];
                            foreach($fresult11 as $category){
                                if(in_array($category["code_no"], $arr_type_room)){
                                    $arr_text_type[] = $category["code_name"];
                                }
                            }
                        ?>
                        <div class="area_info">
                            <div class="pallet child">
                                <div class="icon">
                                    <i></i>
                                    <img src="/images/sub/question-icon.png" alt="" style = "width : 14px; margin-top : 4px ; opacity: 0.6;">
                                </div>
                                <div class="content">
                                    <?php echo implode(" · ", $arr_text_type); ?>
                                </div>
                            </div>   
                               
                            <div class="extent child">
                                <div class="icon">
                                    <i></i>
                                </div>
                                <div class="content">
                                    <?=$type['extent']?>
                                    <span class="unit">m</span>
                                </div>
                            </div>

                            <div class="floor child">
                                <div class="icon">
                                    <i></i>
                                </div>
                                <div class="content">
                                    <?=$type['floor']?>
                                    <span> 층</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="room-table">
                        <colgroup>
                            <col width="30%">
                            <col width="15%">
                            <col width="*">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>옵션 상세</th>
                                <th>정원</th>
                                <th>객실 요금</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
							$target_g_idx  = $type['g_idx']; // 원하는 g_idx 값 (예: 1번 그룹만 표시)
							$filteredRooms = array_filter($roomsByType, function($room) use ($target_g_idx) {
								return $room['g_idx'] == $target_g_idx;
							});
						?>						
						    <?php foreach ($filteredRooms as $room): ?>
                            <tr class="room_op_" data-room="<?=$room['rooms_idx']?>" data-opid="149" data-optype="S" data-ho_idx="<?=$row['goods_code']?>">
                                <input type="hidden" class="r_contents2" value="<?=$room['r_contents2']?>">
                                <input type="hidden" class="r_contents3" value="<?=$room['r_contents3']?>">
                                <td>
                                    <div class="room-details">
                                        <p class="room-p-cus-1"><?=$room['room_name']?></p>
										<?php
										    if($room['breakfast'] != "N") {
											   $breakfast = "조식 포함";
						                    } else {
											   $breakfast = "조식 비포함";	
						                    }   
											
											$option_val = explode(",", $room['option_val']);
										?>	
                                        <ul>
                                            <li>
                                                <span><?=$breakfast?></span>
                                                <div class="view_promotion view_promotion1">
                                                    <img src="/images/sub/question-icon.png" alt="" style = "width : 14px; margin-top : 4px ; opacity: 0.6;">
                                                    <?php 
                                                        if(!empty(trim($room['r_contents1']))) {
                                                    ?>    
                                                        <div class="layer_promotion layer_promotion1">
                                                            <p style="white-space: pre-line"><?=$room['r_contents1']?></p>
                                                        </div>   
                                                    <?php
                                                        }
                                                    ?>                                                    
                                                </div> 
                                            </li>
											<?php for($i=0;$i<count($option_val);$i++) { ?>
                                            <li><?= htmlspecialchars_decode($option_val[$i]) ?></li>
											<?php } ?>
                                            <!--li>온라인 사전결제</li-->
                                            <!--li><span style="color:red">환불 불가</span></li-->
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="people_qty">
                                        <img src="/images/sub/user-iconn.png" alt="">
                                        <p>성인 : <?=$room['adult']?>명</p>
                                        <p>아동 : <?=$room['kids']?>명</p>
                                        <a href="javascript:viewBenefitPopup(<?=$room['rooms_idx']?>);" style="color : #104aa8">혜택보기 &gt;</a> 
                                    </div>
                                </td>
								
								<?php
								       $basic_won  =  (int)($room['goods_price1'] * $room['baht_thai']);
								       $basic_bath =  $room['goods_price1'];
									   
								       $price_won  =  (int)(($room['goods_price2'] + $room['goods_price3']) * $room['baht_thai']);
								       $price_bath =  $room['goods_price2'] + $room['goods_price3'];
									   
								?>
                                <td>
                                    <div class="col_wrap_room_rates">
                                        <?php if($room['secret_price'] == "Y"){?>
                                            <div class="price-secret">
                                                <span>비밀특가</span>
                                                <img src="/images/sub/question-icon.png" alt="" style="width : 14px ; opacity: 0.6;">
                                                <div class="layer_secret">
                                                    <b style="color: #ef4337 ;">회원 전용 특가상품</b> 
                                                    <br>  
                                                    로그인 하시고 특가요금 확인하세요!
                                                </div>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="price-details">
                                                <p>
                                                    <span class="price totalPrice" id="149" data-price="<?=$price_won?>" data-price_bath="<?=$price_bath?>">
                                                        
                                                        <?php if($room['price_view'] == "") { ?>
                                                        <span class="op_price"><?=number_format($price_won)?></span><span>원</span>
                                                        <span class="price_bath">(<?=number_format($price_bath)?>바트)</span>
                                                        <?php } ?>
                                                        
                                                        <?php if($room['price_view'] == "W") { ?>
                                                        <span class="op_price"><?=number_format($price_won)?></span><span>원</span>
                                                        <?php } ?>

                                                        <?php if($room['price_view'] == "B") { ?>
                                                        <span class="op_price"><?=number_format($price_bath)?>바트</span>
                                                        <?php } ?>
                                                    </span>
                                                </p>
                                                <span class="total" style="">
                                                    객실금액: <span class="price-strike hotel_price_sale" data-price="<?=$basic_won?>"><?=number_format($basic_won)?>원</span>
                                                    <span class="price-strike hotel_price_day_sale" data-price="<?=$basic_bath?>">(<?=number_format($basic_bath)?>바트)</span> 
                                                </span>
                                                <?php if($room['special_discount'] == "Y") { ?>	
                                                <div class="discount" style="">
                                                    <span class="label">특별할인</span>
                                                    <span class="price_content"><i class="hotel_price_percent"><?=$room['discount_rate']?></i>%할인</span>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                        <div class="wrap_btn_book">
                                            <button type="button" id="reserv_<?=$room['rooms_idx']?>" class="reservation book-button book_btn_217">
                                                예약하기
                                            </button>
                                            <p class="wrap_btn_book_note">세금서비스비용 포함</p>
                                        </div>
                                    </div>
                                    <div class="wrap_bed_type">
                                        <div class="tit ">
                                            <span>침대타입(요청사항)</span> 
                                            <div class="view_promotion view_promotion2">
                                                <img src="/images/sub/question-icon.png" alt="" style="width : 14px ; opacity: 0.6;">
                                                <?php 
                                                    if(!empty(trim($room['r_contents3']))) {
                                                ?>    
                                                    <div class="layer_promotion layer_promotion2">
                                                        <p style="white-space: pre-line"><?=$room['r_contents3']?></p>
                                                    </div>   
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
										
                                        <div class="wrap_input_radio">
											<?php
                                                  $bed_type  = explode(",", $room['bed_type']);											
                                                  $bed_price = explode(",", $room['bed_price']);											
											
											?>
											
											<?php for($i=0;$i<count($bed_type);$i++) { ?>
											<?php $real_won   = (int)($price_won  + ((int)$bed_price[$i]*(int)$room['baht_thai'])); ?>
									        <?php $real_bath  = (int)$price_bath + (int)$bed_price[$i];?>

                                            <div class="wrap_input">
                                                <input type="radio" name="bed_type_" id="bed_type_<?=$room['g_idx']?><?=$room['rooms_idx']?><?=$i?>" 
												 data-name="<?=$room['room_name']?>" data-won="<?=$real_won?>" data-bath="<?=$real_bath?>" data-type="<?=$bed_type[$i]?>" value="<?=$room['rooms_idx']?>" >
                                                <label for="bed_type_<?=$room['g_idx']?><?=$room['rooms_idx']?><?=$i?>"><?=$bed_type[$i]?>: 
                                                    <?php if($room['secret_price'] == "Y"){?>
                                                        <span>비밀특가</span>
                                                    <?php }else{ ?>
                                                        <span style="color :coral"><?=number_format($real_won)?>원 (<?=number_format($real_bath)?>바트)</span>
                                                    <?php } ?>
                                                </label>
                                            </div>
											<?php } ?>
												
                                            <!--div class="wrap_input">
                                                <input type="radio" name="bed_type" id="bed_type_2">
                                                <label for="bed_type_2">트리플(3인): <span style="color :coral">678,832원 (15,200바트)</span></label>
                                            </div-->
                                        </div>
										
                                    </div>
                                </td>
                            </tr>
							<?php endforeach; ?>
							
                            <!--tr class="room_op_" data-room="S_149" data-opid="149" data-optype="S" data-ho_idx="217">
                                <td>
                                    <div class="room-details">
                                        <p class="room-p-cus-1">킹사이즈침대 1개 무료 아침 식사, 무료 주차 대행 무료 셀프 주차</p>
                                        <ul>
                                            <li><span>조식포함</span> <img src="/images/sub/question-icon.png" alt="" style = "width : 14px; margin-top : 4px ; opacity: 0.6;"></li>
                                            <li>대기없이 바로 확정!</li>
                                            <li>온라인 사전결제</li>
                                            <li style="color : red">환불 불가</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="people_qty">
                                        <img src="/images/sub/user-iconn.png" alt="">
                                        <p>정원 : 2명</p>
                                        <p>아동: 1명</p>
                                        <a href="#!" style="color : #104aa8">혜택보기 &gt;</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col_wrap_room_rates">
                                        <div class="price-details">
                                            <p style="">
                                                <span class="price totalPrice" id="149" data-price="67940.82" data-price_bath="1602">
                                                    <span class="op_price">1,560,000</span>
                                                    <span>원</span>
                                                    <span class="price_bath">(3700바트)</span>
                                                </span>
                                            </p>
                                            <span class="total" style="">
                                                객실금액: <span class="price-strike hotel_price_day" data-price="131598.23">254 원</span>
                                                <span class="hotel_price_day_sale">170</span> 원 </span>
                                            <div class="discount" style="">
                                                <span class="label">특별할인</span>
                                                <span class="price_content"><i class="hotel_price_percent">33.33</i>%할인</span>
                                            </div>
                                        </div>
                                        <div class="wrap_btn_book">
                                            <button type="button" class="book-button book_btn_217">
                                                예약하기
                                            </button>
                                            <p class="wrap_btn_book_note">세금서비스비용 포함</p>
                                        </div>
                                    </div>
                                    <div class="wrap_bed_type">
                                        <p class="tit"><span>침대타입(요청사항)</span> <img src="/images/sub/question-icon.png" alt="" style="width : 14px ; opacity: 0.6;"></p>
                                        <div class="wrap_input_radio">
                                            <div class="wrap_input">
                                                <input type="radio" name="bed_type_3" id="bed_type_3" checked="">
                                                <label for="bed_type_3">트윈(요청): <span style="color :coral">544,852원 (12,200바트)</span></label>
                                            </div>
                                            <div class="wrap_input">
                                                <input type="radio" name="bed_type_3" id="bed_type_4">
                                                <label for="bed_type_4">트리플(3인): <span style="color :coral">678,832원 (15,200바트)</span></label>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr-->
                        </tbody>
                    </table>
                </div>
											
            </div>
			<?php endforeach; ?>
        </div>
        </div>
        <div class="section4" id="section4">
            <h2 class="title-sec4">시설 & 서비스</h2>
            <div class="list-tag-sec4">
                <?php foreach ($fresult5 as $row2): ?>
                    <?php
                    $child = $row2['child'];
                    $count = count($child);
                    ?>
                    <?php if ($count > 0): ?>
                        <div class="tag-container-item-sec4">
                            <div class="tag-item-title"> <?= $row2['code_name'] ?> </div>
                            <ul class="tag-item-list">
                                <?php foreach ($child as $item2): ?>
                                    <li><?= $item2['code_name'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        $product_more = $hotel['product_more'];
        $breakfast_data_arr2 = [];
        if ($product_more) {
            //                    $productMoreData = json_decode($product_more, true);
            //
            //                    if (json_last_error() !== JSON_ERROR_NONE) {
            //                        die("Lỗi giải mã JSON: " . json_last_error_msg());
            //                    }
            //                    $breakfast_data = '';
            //                    if ($productMoreData) {
            //                        $meet_out_time = $productMoreData['meet_out_time'];
            //                        $children_policy = $productMoreData['children_policy'];
            //                        $baby_beds = $productMoreData['baby_beds'];
            //                        $deposit_regulations = $productMoreData['deposit_regulations'];
            //                        $pets = $productMoreData['pets'];
            //                        $age_restriction = $productMoreData['age_restriction'];
            //                        $smoking_policy = $productMoreData['smoking_policy'];
            //                        $breakfast = $productMoreData['breakfast'];
            //                        $breakfast_data = $productMoreData['breakfast_data'];
            //                    }
            $productMoreData = explode('$$$$', $product_more);
            $meet_out_time = $productMoreData[0];
            $children_policy = $productMoreData[1];
            $baby_beds = $productMoreData[2];
            $deposit_regulations = $productMoreData[3];
            $pets = $productMoreData[4];
            $age_restriction = $productMoreData[5];
            $smoking_policy = $productMoreData[6];
            $breakfast = $productMoreData[7];
            $breakfast_data = $productMoreData[8];

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
                    <span class="label">체크인 &<br class="only_mo">
                        체크아웃 시간
                    </span>
                    <div class="description">
                        <p><?= nl2br($meet_out_time ?? '') ?></p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        어린이 정책
                    </span>
                    <div class="description">
                        <p><?= nl2br($children_policy ?? '') ?></p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        유아용 침대 및 엑스트라 베드
                    </span>
                    <div class="description">
                        <p><?= nl2br($baby_beds ?? '') ?></p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        조식
                    </span>
                    <div class="description">
                        <p><?= nl2br($breakfast ?? '') ?></p>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <?php foreach ($breakfast_data_arr2 as $key => $value) : ?>
                                            <th><?= $key ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($breakfast_data_arr2 as $key => $value) : ?>
                                            <td><?= $value ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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

        <div class="section4">
            <h2 class="title-sec4">유의사항</h2>
            <div class="content-container-sec5">
                <div class="only_w">
                    <?= viewSQ($hotel['product_important_notice']) ?>
                </div>
                <div class="only_m">
                    <?= viewSQ($hotel['product_important_notice_m']) ?>
                </div>
            </div>
        </div>

		<input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
		<input type="hidden" name="coupon_name" id="coupon_name">
		<input type="hidden" name="coupon_type" id="coupon_type">
		<input type="hidden" name="total_last_price" id="total_last_price" value="0">
		<input type="hidden" name="use_coupon_room" id="use_coupon_room">
		<input type="hidden" name="use_op_type" id="use_op_type">
		<input type="hidden" name="use_coupon_idx" id="use_coupon_idx">
		<input type="hidden" name="number_room" id="number_room">
		<input type="hidden" name="number_day" id="number_day">
		<input type="hidden" name="product_idx" id="product_idx" value="<?= $hotel['product_idx'] ?>">
		<input type="hidden" name="room_op_idx" id="room_op_idx" value="">
		<input type="hidden" name="bed_type" id="bed_type" value="">
		<input type="hidden" name="price" id="price" value="">
		<input type="hidden" name="price_won" id="price_won" value="">
		<input type="hidden" name="room"      id="room" value="">
		<input type="hidden" name="room_type" id="room_type" value="">
		<input type="hidden" name="rooms_idx" id="rooms_idx" value="">
		<input type="hidden" name="date_price" id="date_price" value="">
		<input type="hidden" name="breakfast"  id="breakfast" value="">
		<input type="hidden" name="adult"      id="adult" value="">
		<input type="hidden" name="kids"     id="kids" value="">
		<input type="hidden" name="searchOk" id="searchOk" value="">

        <?php echo view("/product/inc/review_product", ['product' => $hotel]); ?> 

        <div class="section7">
            <div class="d_flex justify_content_end">
                <h1 class="title-sec7">다른 추천 호텔도 확인해 보세요 : )</h1>
                <div class="swiper_product_list_pagination_">
                </div>
            </div>
            <div class="sub_tour_section7_product_list swiper swiper_product_list_ swiper-initialized swiper-horizontal swiper-backface-hidden">
                <div class="swiper-wrapper" id="swiper-wrapper-c2d811557361007f3" aria-live="polite">
                    <?php foreach ($suggestHotel as $item) : ?>
                        <a href="/product-hotel/hotel-detail/<?= $item['product_idx'] ?>"
                            class="sub_tour_section7_product_item swiper-slide swiper-slide-active" role="group"
                            aria-label="1 / 9" data-swiper-slide-index="0"
                            style="width: 393.333px; margin-right: 10px;">

                            <div class="img_box img_box_12">
                                <img src="/data/product/<?= $item['ufile1'] ?>" alt="main"
                                    onerror="this.src='/images/product/noimg.png'" loading="lazy">
                            </div>
                            <?php
                            $hotel_code_name = $item['array_hotel_code_name'];

                            $num = count($hotel_code_name);
                            ?>
                            <div class="prd_keywords">
                                <?php if ($num === 0): ?>
                                    <span class="prd_keywords_cus_span">
                                        호텔
                                    </span>
                                <?php endif; ?>
                                <?php $i = 0;
                                foreach ($hotel_code_name as $itemName): ?>
                                    <span class="prd_keywords_cus_span"> <?= $itemName ?>
                                        <?php if ($i < $num - 1): ?>
                                            <img src="/images/ico/arrow_right_icon.png"
                                                alt="arrow_right_icon">
                                        <?php endif; ?>
                                    </span>
                                <?php $i++;
                                endforeach; ?>
                            </div>
                            <div class="prd_name">
                                <?= viewSQ($item['product_name']) ?>
                            </div>
                            <div class="prd_info">
                                <div class="prd_info__left">
                                    <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                    <span class="star_avg"><?= $item['review_average'] ?> </span>
                                </div>
                                <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                <div class="prd_info__right">
                                    <span class="prd_info__right__ttl">생생리뷰</span>
                                    <span class="new_review_cnt">(0)</span>
                                </div>
                            </div>
                            <div class="prd_price_ko">
                                <?php
                                if ($item['is_won_bath'] == "W" || $item['is_won_bath'] == "B") {
                                    if ($item['is_won_bath'] == "W") {
                                ?>
                                        <?= number_format($item['product_price_won']) ?> <span> 원</span>
                                    <?php
                                    } else if ($item['is_won_bath'] == "B") {
                                    ?>
                                        <?= number_format($item['product_price']) ?> <span> 바트</span>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <?= number_format($item['product_price_won']) ?> <span> 원 ~</span> <span
                                        class="prd_price_ko_sub">
                                        <?= number_format($item['product_price']) ?>
                                        <span>바트</span></span>
                                <?php
                                }
                                ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>

		<script>
		$('input[name="bed_type_"]').on('click', function() {
			let selectedValue = $('input[name="bed_type_"]:checked').val();
			$(".reservation").prop('disabled', true);
			$("#reserv_"+selectedValue).prop('disabled', false);
			
			var data_won  = $(this).data('won'); 
			var data_bath = $(this).data('bath'); 
			var bed_type  = $(this).data('type');
			var rooms_idx = $(this).val();
			var room_name = $(this).data('name');
			
			$("#bed_type").val(bed_type);
			$("#price").val(data_bath);
			$("#price_won").val(data_won);
			$("#rooms_idx").val(rooms_idx);
			$("#room_name").val(room_name);
		 	
		});
		</script>

        <script>
            function wish_it() {

                if ($("#member_Id").val() == "") {
                    alert("로그인 하셔야 합니다.");
                    location.href = '/member/login.php?returnUrl=' + $("#req_url").val();
                } else {

                    var message = "";
                    $.ajax({

                        url: "/item/ajax.wish_set.php",
                        type: "POST",
                        data: {
                            "product_idx": '<?= $product_idx ?>'
                        },
                        dataType: "json",
                        async: false,
                        cache: false,
                        success: function(data, textStatus) {
                            message = data.message;
                            alert(message);
                            location.reload();
                        },
                        error: function(request, status, error) {
                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                        }
                    });
                }
            }
        </script>

        <script>
            $('.btnReadMore').click(function() {
                let room_option_ = $(this).parent().prev();
                room_option_.css('height', 'auto');
                $(this).css('display', 'none');
                $(this).parent().find('.btnReadLess').css('display', 'inline');
            });

            $('.btnReadLess').click(function() {
                let room_option_ = $(this).parent().prev();
                room_option_.css('height', '620px');
                $(this).css('display', 'none');
                $(this).parent().find('.btnReadMore').css('display', 'inline');
            });
        </script>
    </div>

    <div id="popup" class="popup" data-roop="" data-opId="" data-opType="" data-price="">
        <div class="popup-content">
            <img src="/images/ico/close_icon_popup.png" alt="close_icon" class="close-btn"></img>
            <h2 class="title-popup">적용가능한 쿠폰 확인</h2>
            <div class="order-popup">
                <?php
                $nums_coupon = count($coupons);
                ?>
                <p class="count-info">사용 가능 쿠폰 <span><?= $nums_coupon ?>장</span></p>
                <div class="description-above">
                    <?php
                    foreach ($coupons as $coupon) {
                        if ($coupon["dc_type"] == "P") {
                            $discount = $coupon["coupon_pe"] . "%";
                            $dis = $coupon["coupon_pe"];
                        } else if ($coupon["dc_type"] == "D") {
                            $discount = number_format($coupon["coupon_price"]) . " 원";
                            $dis = $coupon["coupon_price"];
                        } else {
                            $discount = "회원등급에 따름";
                            $dis = 0;
                        }
                    ?>
                        <div class="item-price-popup" style="cursor: pointer;"
                            data-idx="<?= $coupon["c_idx"] ?>" data-type="<?= $coupon["dc_type"] ?>"
                            data-discount="<?= $dis ?>">
                            <div class="img-container">
                                <img src="/images/sub/popup_cash_icon.png" alt="popup_cash_icon">
                            </div>
                            <div class="text-con">
                                <span class="item_coupon_name"><?= $coupon["coupon_name"] ?></span>
                                <span class="text-gray"><?= $discount ?> 할인쿠폰</span>
                            </div>
                            <span class="date-sub">~<?= date("Y.m.d", strtotime($coupon["enddate"])) ?></span>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- <div class="item-price-popup">
                                <div class="img-container">
                                    <img src="/images/sub/popup_cash_icon.png" alt="popup_cash_icon">
                                </div>
                                <div class="text-con">
                                    <span>추가 즉시할인쿠폰</span>
                                    <span class="text-gray">5,000원 할인쿠폰</span>
                                </div>
                                <span class="date-sub">~2024.10.05</span>
                            </div> -->
                    <div class="item-price-popup item-price-popup--button active"
                        data-idx="" data-type="" data-discount="0">
                        <span>적용안함</span>
                    </div>
                </div>
                <div class="line-gray"></div>
                <div class="footer-popup">
                    <div class="des-above">
                        <div class="item">
                            <span class="text-gray">총 주문금액</span>
                            <span class="text-gray total_price" data-price="">160,430 원</span>
                        </div>
                        <div class="item">
                            <span class="text-gray">할인금액</span>
                            <span class="text-gray discount" data-price="">16,040 원</span>
                        </div>
                    </div>
                    <div class="des-below">
                        <div class="price-below">
                            <span>최종결제금액</span>
                            <p class="price-popup"><span class="last_price" data-price="">144,000</span><span
                                    class="text-gray"> 원</span></p>
                        </div>
                    </div>
                    <button type="button" class="btn_accept_popup">
                        쿠폰적용
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="popup_wrap benefit_pop policy_pop">
        <div class="pop_box">
            <button type="button" class="close" onclick="closeBenefitPopup()"></button>
            <div class="pop_body">
                <div class="padding">
                    <div class="popup_place__head">
                        <div class="popup_place__head__ttl">
                            <h2>프로모션 혜택</h2>
                        </div>
                    </div>
                    <div class="popup_place__body">
                        <div class="content" style="white-space: pre-line;"></div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>

    <div class="popup_wrap popup_view_room">
        <div class="pop_box">
            <button type="button" class="close" onclick="closePopupRoom()"></button>
            <div class="pop_body">
                <div class="list_room_img">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            
                        </div>
                    </div>
                </div>
                <div class="room_content">
                    <h4 class="room_name">디럭스 트윈</h4>
                    <div class="room_info">
                        <span class="info_tit">기본정보</span>
                        <div class="info_txt">
                            <p>ㆍ면적 : <span id="info_extent"></span> ㎡</p>   
                            <p>ㆍ객실 층 : <span id="info_floor"></span> 층</p>
                            <!-- <p>ㆍ객실수 : <span id="info_num_room"></span></p>    -->
                        </div>
                    </div>
                    <div class="room_info">
                        <span class="info_tit">투숙객 규정</span>
                        <div class="info_txt">
                            <p id="info_rules">
                                ㆍ나이 : 성인 12세~아동 6~11세유아 5세 이하
                                <br>
                                ㆍ최대투숙인원 : 성인 2 또는 성인 2 + 아동 1
                            </p>   
                        </div>
                    </div>
                    <div class="room_info">
                        <span class="info_tit">객실 내 시설 정보</span>
                        <div class="info_detail" id="info_facil">
                            금연, 디지털 TV 서비스, 방음 객실, 스마트 TV, 냉장고, 별도의 욕조 및 샤워, 미니바, 옷장, 매일 하우스키핑, 무료 WiFi, 비데, 타월 제공됨, 에너지 절약 스위치, 침대 시트 제공됨, 비누, 칫솔/치약 제공, 화장지, 무선 인터넷 사용, 샴푸, TV 크기 단위: 인치, 슬리퍼, 전용 욕실, 목욕가운, 무료 세면용품, 휠체어로 이용 가능, 헤어드라이어, 에어컨, TV 크기: 55, 간이/추가 침대(요금 별도), 객실 금고, 무료 생수, 무료 유아용 침대, 식사 배달 서비스 이용 가능  
                        </div>
                    </div>
                    <p class="ptxt01">호텔 관련 정보는 호텔에서 제공받은 것으로, 차후 변경 혹은 호텔 직원 실수 등의 이유로 간혹 내용이 부정확할 수도 있습니다. 참고부탁드립니다.</p>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>

    <script>  
        function nl2br(str) {
            return str.replace(/\n/g, "<br>").replace(/ /g, "&nbsp;");
        }
    
        function closePopupRoom() {
            $(".popup_view_room").hide();
        }

        async function showPopupRoom(idx) {

            if(idx){
                
                let apiUrl = `/ajax/ajax_room_detail?idx=${idx}`;
                try {
                    let response = await fetch(apiUrl);
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

                    let data = await response.json();                    

                    let html = ``;
                    data.img_list.forEach(img => {
                        if(img.ufile){
                            html += `
                                <div class="swiper-slide">
                                    <img src="/uploads/rooms/${img.ufile}" alt="${img.rfile}"/>
                                </div>
                            `;
                        }
                    });

                    $(".mySwiper2 .swiper-wrapper").html(html);
                    $(".mySwiper .swiper-wrapper").html(html);

                    $(".popup_view_room").find(".room_name").text(data.room.roomName);
                    $(".popup_view_room").find("#info_extent").text(data.room.extent);
                    $(".popup_view_room").find("#info_floor").html(data.room.floor);
                    $(".popup_view_room").find("#info_rules").html(nl2br(data.room.policy_customer));
                    $(".popup_view_room").find("#info_facil").html(data.room.facil_text);

                    initSwiper();
                    $(".popup_view_room").show();
                } catch (error) {
                    console.error('Error fetching hotel data:', error);
                }
            }

        }
    </script>

    <script>
        function closeBenefitPopup() {
            $(".benefit_pop").hide();
        }

        function viewBenefitPopup(id) {
            $(".benefit_pop").find(".popup_place__body .content").text("");

            let content = $(`tr[data-room='${id}']`).find(".r_contents2").val();
            

            $(".benefit_pop").find(".popup_place__body .content").html(content);

            $(".benefit_pop").show();
        }
    </script>

    <script>
        let swiper = new Swiper(".swiper_product_list_", {
            slidesPerView: 2,
            grid: {
                rows: 1,
            },
            loop: true,
            spaceBetween: 20,
            breakpoints: {
                300: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    pagination: false,
                    pagination: {
                        el: ".swiper_product_list_pagination_",
                        clickable: true,
                    },
                },
                850: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                    pagination: {
                        el: ".swiper_product_list_pagination_",
                        clickable: true,
                    },
                },
            },
        });
        // Get the popup, open button, close button elements
        const $popup = $('#popup');
        const $openPopupBtns = $('.openPopupBtn');
        const $closePopupBtn = $('.close-btn');
        const $closePopupBtn2 = $('#closePopupBtn');

        // Show popup when the "Open Popup" button is clicked
        $openPopupBtns.on('click', function() {
            let room_op_idx = $(this).closest("tr.room_op_").attr("data-room");
            let use_op_idx = $(this).closest("tr.room_op_").attr("data-opId");
            let room_type = $(this).closest("tr.room_op_").attr("data-opType");
            let room_qty = $(this).closest("tr.room_op_").find(".room_qty .input_room_qty").val();
            let day_qty = $(this).closest("tr.room_op_").find(".day_qty .input_day_qty").val();
            let total_price = Number($(this).closest("tr.room_op_").find(".totalPrice").attr("data-price"));
            let price = $(this).closest("tr.room_op_").find(".totalPrice").attr("data-price");
            let room_op_price_sale = 0;
            if ($(this).closest("tr.room_op_").find(".room_price_day_sale").length > 0) {
                room_op_price_sale = Number($(this).closest("tr.room_op_").find(".room_price_day_sale").attr("data-price"));
            }

            total_price = room_op_price_sale + total_price * parseInt(room_qty);

            $("#popup").find(".total_price").text(total_price.toLocaleString('ko-KR') + " 원");
            $("#popup").find(".total_price").attr("data-price", total_price);
            $("#popup").attr("data-price", price);
            $("#popup").attr("data-roop", room_op_idx);
            $("#popup").attr("data-opType", room_type);
            $("#popup").attr("data-opId", use_op_idx);

            popup_coupon();

            $popup.css('display', 'flex');
        });

        $(".item-price-popup").click(function() {
            $(this).addClass("active").siblings().removeClass("active");
            popup_coupon();
        });

        $(".btn_accept_popup").click(function() {
            let room_op_idx = $("#popup").attr("data-roop");
            let use_op_idx = $("#popup").attr("data-opId");
            let room_type = $("#popup").attr("data-opType");

            let coupon_type = $("#popup").find(".item-price-popup.active").attr("data-type");
            let coupon_discount = Number($("#popup").find(".item-price-popup.active").attr("data-discount"));
            let coupon_idx = Number($("#popup").find(".item-price-popup.active").attr("data-idx"));
            let coupon_name = $("#popup").find(".item-price-popup.active .item_coupon_name").text().trim();
            $("#coupon_type").val(coupon_type);
            $("#coupon_discount").val(coupon_discount);
            $("#use_coupon_idx").val(coupon_idx);

            if (coupon_idx != 0 || coupon_idx) {
                $("#coupon_name").val(coupon_name);
            } else {
                $("#coupon_name").val("");
            }
            $("#popup").hide();

            if (room_op_idx) {
                let price = Number($('.room_op_[data-room="' + room_op_idx + '"]').find(".totalPrice").attr("data-price"));
                let room_qty = $('.room_op_[data-room="' + room_op_idx + '"]').find(".room_qty .input_room_qty").val();
                let day_qty = $('.room_op_[data-room="' + room_op_idx + '"]').find(".day_qty .input_day_qty").val();
                let room_op_price_sale = 0;
                if ($('.room_op_[data-room="' + room_op_idx + '"]').find(".room_price_day_sale").length > 0) {
                    room_op_price_sale = Number($('.room_op_[data-room="' + room_op_idx + '"]').find(".room_price_day_sale").attr("data-price"));
                }

                let total_price = room_op_price_sale + price * parseInt(room_qty);

                if (coupon_type && coupon_discount) {
                    if (coupon_type == "P") {
                        total_price = Math.round(total_price - total_price * Number(coupon_discount) / 100);
                    } else {
                        total_price = total_price - coupon_discount;
                    }
                }

                $('.room_op_[data-room="' + room_op_idx + '"]').find(".totalPrice").text(total_price.toLocaleString('ko-KR'));
                $("#total_last_price").val(total_price);
                $("#use_coupon_room").val(use_op_idx);
                $("#use_op_type").val(room_type);
                if (coupon_idx) {
                    $('.room_op_[data-room="' + room_op_idx + '"]').find(".use_coupon_name").text("쿠폰 적용 " + coupon_name);
                }
                let rooms = $('.room_op_[data-room!="' + room_op_idx + '"]');

                rooms.each(function() {
                    let price = Number($(this).find(".totalPrice").attr("data-price"));
                    let room_op_price_sale = 0;
                    if ($(this).find(".room_price_day_sale").length > 0) {
                        room_op_price_sale = Number($(this).find(".room_price_day_sale").attr("data-price"));
                    }
                    let room_qty = $(this).find(".room_qty .input_room_qty").val();
                    let day_qty = $(this).find(".day_qty .input_day_qty").val();
                    let total_price = room_op_price_sale + price * parseInt(room_qty);
                    $(this).find(".use_coupon_name").text("");
                    $(this).find(".totalPrice").text(total_price.toLocaleString('ko-KR'));

                });
            }
        });

        function popup_coupon() {
            let total_price = Number($("#popup").find(".total_price").attr("data-price"));

            let price_discount = 0;
            let last_price = total_price;

            let type = $("#popup").find(".item-price-popup.active").attr("data-type");

            let discount = Number($("#popup").find(".item-price-popup.active").attr("data-discount"));

            if (type && discount) {
                if (type == "P") {
                    price_discount = Math.round(total_price * Number(discount) / 100);
                    last_price = total_price - price_discount;
                } else {
                    price_discount = discount;
                    last_price = total_price - price_discount;
                }
            }

            $("#popup").find(".discount").text(price_discount.toLocaleString('ko-KR') + " 원");
            $("#popup").find(".last_price").text(last_price.toLocaleString('ko-KR'));
            $("#popup").find(".discount").attr("data-price", price_discount);
            $("#popup").find(".last_price").attr("data-price", last_price);

        }

        $('.list-icon img[alt="heart_icon"], .list-icon img[alt="heart_icon_mo"]').click(function() {
            if ($(this).attr('src').includes('_mo')) {
                if ($(this).attr('src') === '/uploads/icons/heart_icon_mo.png') {
                    $(this).attr('src', '/uploads/icons/heart_on_icon_mo.png');
                } else {
                    $(this).attr('src', '/uploads/icons/heart_icon_mo.png');
                }
            } else {
                if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
                    $(this).attr('src', '/uploads/icons/heart_on_icon.png');
                } else {
                    $(this).attr('src', '/uploads/icons/heart_icon.png');
                }
            }
        });

        //$(".book-button").click(function() {
        $(document).on("click", ".book-button", function() {			
            <?php
            if (empty(session()->get("member")["id"])) {
            ?>
                // alert("주문하시려면 로그인해주세요!");
                showOrHideLoginItem();
                return false;
            <?php
            }
            ?>

            let date_check_in  = $("#input_day_start_").val();
            let date_check_out = $("#input_day_end_").val();

            if (!date_check_in && !date_check_out) {
                alert("체크인 날짜와 체크아웃 날짜를 선택해주세요!");
                return false;
            }

            if ($("#searchOk").val() != "Y") {
                alert("일자검색 후 예약해주세요!");
                return false;
            }

            var idx = $(this).data('idx');
            let checkedValue = $(".sel_"+idx+":checked").val();
			if (checkedValue === undefined) {
                alert("침대타입 선택 후 예약해주세요!");
                return false;
            }

			let coupon_discount = $("#coupon_discount").val();
            let coupon_type     = $("#coupon_type").val();
            let use_coupon_room = $("#use_coupon_room").val();
            let used_op_type    = $("#use_op_type").val();
            let use_coupon_idx  = $("#use_coupon_idx").val();
            let room_op_idx     = $("#room_op_idx").val();
            let ho_idx          = $(this).closest(".room_op_").data("ho_idx");
            let optype          = $(this).closest(".room_op_").data("optype");
            let number_room     = $("#room_qty").val();
            let number_day      = $("#day_qty").val();
            let last_price      = $("#total_last_price").val();
            let product_idx     = $("#product_idx").val();
            let inital_price    = $(this).closest(".room_op_").find(".totalPrice").attr("data-price");

			let price           = $("#price").val();
			let price_won       = $("#price_won").val();
			let rooms_idx       = $("#rooms_idx").val();
            let room            = $("#room").val();

			let room_type       = $("#room_type").val();
            let bed_type        = $("#bed_type").val();
			let date_price      = $("#date_price").val();
			let breakfast       = $("#breakfast").val();
			let adult           = $("#adult").val();
			let kids            = $("#kids").val();

            let room_op_price_sale = 0;

            if ($(this).closest(".room_op_").find(".room_price_day_sale").length > 0) {
                room_op_price_sale = Number($(this).closest(".room_op_").find(".room_price_day_sale").attr("data-price"));
            }

            let used_coupon_money = 0;
            let total_price = room_op_price_sale + parseInt(number_room) * parseInt(inital_price);
            if (coupon_type && coupon_discount) {
                if (coupon_type == "P") {
                    used_coupon_money = Math.round(total_price * Number(coupon_discount) / 100);
                } else {
                    used_coupon_money = coupon_discount;
                }
            }

            let start_day          = $('#input_day_start_').val();
            let end_day            = $('#input_day_end_').val();
            let total_last_price   = $("#total_last_price").val();
			
            let cart = {
                product_idx       : product_idx,
                room_op_idx       : room_op_idx,
			    price             : price,
			    price_won         : price_won,
			    rooms_idx         : rooms_idx,
				room              : room,	
			    room_type         : room_type,
                bed_type          : bed_type,
				date_price        : date_price,
				breakfast         : breakfast,	
				adult             : adult,	
				kids              : kids,	
				total_last_price  : total_last_price,	
					
                ho_idx            : ho_idx,
                optype            : optype,
                use_coupon_idx    : use_coupon_idx,
                used_coupon_money : used_coupon_money,
                use_coupon_room   : use_coupon_room,
                use_op_type       : use_op_type,
                room_op_price_sale: room_op_price_sale,
                inital_price      : inital_price,
                coupon_discount   : coupon_discount,
                coupon_type       : coupon_type,
                last_price        : last_price,
                number_room       : number_room,
                number_day        : number_day,
                start_day         : start_day,
                end_day           : end_day,
            };

            setCookie("cart-hotel", JSON.stringify(cart), 1);
            window.location.href = '/product-hotel/reservation-form';
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

        $('.nav-item').on('click', function() {
            $('.nav-item').removeClass('active');
            $(this).addClass('active');
        });

        function scrollToEl(elID) {
            $('html, body').animate({
                scrollTop: $('#' + elID).offset().top - 250
            }, 'slow');
        }

        $(".onlynum").keyup(function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        });

        $('.btnMinus').click(function() {
            let inp = $(this).next();

            let qty = inp.val();
            qty = parseInt(qty);
            if (qty > 1) {
                qty--;
            }
            inp.val(qty);

            changeDataOptionPriceBk(inp);
        });

        $('.btnPlus').click(function() {
            let inp = $(this).prev();
            let qty = inp.val();
            qty = parseInt(qty);
            qty++;
            inp.val(qty);
            changeDataOptionPriceBk(inp);
        });

        function changeDataOptionPriceBk(input) {

			var checkedVal  = $("input[name='bed_type_']:checked"); // ✅ 체크된 라디오 버튼 찾기
			var roomPrice   = checkedVal.data("won"); // ✅ data-info 속성 값 가져오기
            let item        = $(input).closest('tr.room_op_');

            let room_op_idx = item.attr('data-room');
            let qty_room    = $("#room_qty").val();
			let total_price = parseInt(roomPrice * qty_room);


            $("#total_last_price").val(total_price);
/*
            let qty_day = item.find('input.input_day_qty').val();
            let coupon_discount = Number($("#coupon_discount").val());
            let coupon_type = $("#coupon_type").val();
            let use_coupon_room = Number($("#use_coupon_room").val());
            let use_op_type = $("#use_op_type").val();
            let use_coupon_idx = use_op_type + "_" + use_coupon_room;
            let room_op_price = 0;
            let room_op_price_sale = 0;

            let initPrice = item.find(".hotel_price_day").attr('data-price');
            if (item.find(".room_price_day").length > 0) {
                room_op_price = Number(item.find(".room_price_day").attr("data-price"));
            }
            if (item.find(".room_price_day_sale").length > 0) {
                room_op_price_sale = Number(item.find(".room_price_day_sale").attr("data-price"));
            }
            item.find('span.count_room').text(qty_room);
            item.find('span.count_day').text(qty_day);
            let main_price = item.find('span.totalPrice').attr('data-price');
            let main_price_bath = item.find('span.totalPrice').attr('data-price_bath');

            let total_price = room_op_price_sale + qty_room * parseInt(main_price);
            let total_price_bath = room_op_price_sale + qty_room * parseInt(main_price_bath);

            let total_init_price = room_op_price + qty_room * parseInt(initPrice);

            let percent_price = 100 - (total_price / total_init_price) * 100;

            item.find(".hotel_price_percent").text(percent_price.toFixed(2));

            if (use_coupon_idx == room_op_idx && coupon_type && coupon_discount) {
                if (coupon_type == "P") {
                    total_price = Math.round(total_price - total_price * Number(coupon_discount) / 100);
                    total_price_bath = Math.round(total_price_bath - total_price_bath * Number(coupon_discount) / 100);
                } else {
                    total_price = total_price - coupon_discount;
                    total_price_bath = total_price_bath - coupon_discount;
                }
            }
            let formattedNumber = total_price.toLocaleString('en-US');
            item.find('span.totalPrice .op_price').text(formattedNumber);
            item.find('span.totalPrice .price_bath').text("(" + total_price_bath.toLocaleString('en-US') + "바트)");
*/
        }

        // function changeDataOptionPrice(input) {
        //     let item = $(input).closest('tr.room_op_');

        //     let room_op_idx = item.attr('data-room');
        //     let qty_room = item.find('input.input_room_qty').val();
        //     let qty_day = item.find('input.input_day_qty').val();
        //     let coupon_discount = Number($("#coupon_discount").val());
        //     let coupon_type = $("#coupon_type").val();
        //     let use_coupon_room = Number($("#use_coupon_room").val());

        //     item.find('span.count_room').text(qty_room);
        //     item.find('span.count_day').text(qty_day);
        //     let main_price = item.find('span.totalPrice').attr('data-price');

        //     let total_price = qty_room * qty_day * parseInt(main_price)
        //     if (use_coupon_room == room_op_idx && coupon_type && coupon_discount) {
        //         if (coupon_type == "P") {
        //             total_price = Math.round(total_price - total_price * Number(coupon_discount) / 100);
        //         } else {
        //             total_price = total_price - coupon_discount;
        //         }
        //     }
        //     let formattedNumber = total_price.toLocaleString('en-US');
        //     item.find('span.totalPrice').text(formattedNumber);

        //     $("#total_last_price").val(total_price);
        // }


        function increment(selecter) {
            const display = $(selecter);
            let currentValue = parseInt(display.val());
            display.val(currentValue + 1);
            // let inp = $(el).parent().prev();
            // let qty =inp.val();
            // qty = Number(qty)+1;
            // inp.val(qty);
        }

        function decrement(selecter) {
            const display = $(selecter);
            let currentValue = parseInt(display.val());
            if (currentValue > 1) {
                display.val(currentValue - 1);
            }
        }
    </script>

    <div id="dim"></div>
    <div id="popupRoom" class="on">
        <strong id="pop_roomName"></strong>
        <div>
            <ul class="multiple-items">
            </ul>
        </div>
        <a class="closed_btn" href=""><img src="/images/ico/close_ico_w.png" alt="close" /></a>
    </div>

    <div id="popup_img" class="on">
        <strong id="pop_roomName"></strong>
        <div>
            <ul class="multiple-items">
            </ul>
        </div>
        <a class="closed_btn" href=""><img src="/images/ico/close_ico_w.png" alt="close" /></a>
    </div>

    <script>
        /* hotel_view popup */
        jQuery(document).ready(function() {
            var dim = $('#dim');
            var popup = $('#popupRoom');
            var closedBtn = $('#popupRoom .closed_btn');

            var popup2 = $('#popup_img');
            var closedBtn2 = $('#popup_img .closed_btn');

            /* closed btn*/
            closedBtn.click(function() {
                popup.hide();
                dim.fadeOut();
                $('.multiple-items').slick('unslick'); // slick 삭제
                return false;
            });

            closedBtn2.click(function() {
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
                error: function(request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                },
                success: function(response, status, request) {

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
                error: function(request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                },
                success: function(response, status, request) {

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
</div>
</div>
<script>
    async function listPlace() {
        let apiUrl = `<?= route_to('api._product_place.list') ?>?product_idx=<?= $hotel['product_idx'] ?>`;
        try {
            let response = await fetch(apiUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            let data = await response.json();
            renderPlace(data.data);
        } catch (error) {
            console.error('Error fetching hotel data:', error);
        }
    }

    function renderPlace(data) {
        console.log(data)
    }
</script>
<script>
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

    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    const product = {
        name: "<?= addslashes($hotel['product_name']) ?>",
        link: "<?= '/product-hotel/hotel-detail/' . $hotel['product_idx'] ?>",
        image: "<?= '/data/product/' . $hotel['ufile1'] ?>",
        ...(<?= isset($hotel['ufile2']) && $hotel['ufile2'] ? 'true' : 'false' ?> && {
            image2: "<?= '/data/product/' . $hotel['ufile2'] ?>"
        })
    };

    let viewedProducts = getCookie('viewedProducts');
    if (viewedProducts) {
        viewedProducts = JSON.parse(viewedProducts);
    } else {
        viewedProducts = [];
    }

    if (!viewedProducts.some(p => p.name === product.name)) {
        viewedProducts.push(product);
        if (viewedProducts.length > 10) {
            viewedProducts.shift();
        }
        setCookie('viewedProducts', JSON.stringify(viewedProducts), 1);
    }
</script>

<script>
    var swiper_room;
    var swiper_room2;

    function initSwiper() {
        if (swiper_room instanceof Swiper) {
            swiper_room.destroy(true, true);
        }
        if (swiper_room2 instanceof Swiper) {
            swiper_room2.destroy(true, true);
            document.querySelector(".swiper-button-next").classList.remove("swiper-button-disabled");
            document.querySelector(".swiper-button-prev").classList.remove("swiper-button-disabled");
        }

        swiper_room = new Swiper(".mySwiper", {
            spaceBetween: 2,
            slidesPerView: "auto",
            freeMode: true,
            watchSlidesProgress: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

        swiper_room2 = new Swiper(".mySwiper2", {
            spaceBetween: 2,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper_room,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            on: {
                init: function () {
                    document.documentElement.style.setProperty("--swiper-navigation-color", "#ffffff");
                },
            },
        });
    }

</script>
<?php $this->endSection(); ?>