<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

    <style>
        .main_page_01 .main_visual_content_ {
            z-index: 5;
        }

        .daterangepicker {
            width: 800px !important;
            top: 512px !important;
            left: 605px !important;
            right: auto;
        }

        .daterangepicker .drp-calendar {
            width: 50%;
            max-width: unset !important;
        }

        @media screen and (max-width: 850px) {

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

        .price-tag {
            color: #999999;
        }

        .drp-calendar td.has-price {
            position: relative;
            padding-bottom: 20px;
        }

        .drp-calendar td.has-price::after {
            content: attr(data-price);
            display: block;
            font-size: 12px;
            color: #007bff;
            margin-top: 5px;
            position: absolute;
            bottom: 5px;
            left: 0;
            right: 0;
            text-align: center;
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
    </style>
    <link rel="stylesheet" type="text/css" href="/lib/daterangepicker/daterangepicker.css"/>
    <script type="text/javascript" src="/lib/momentjs/moment.min.js"></script>
    <script type="text/javascript" src="/lib/daterangepicker/daterangepicker.min.js"></script>
    <div class="main_page_01 page_share_ page_product_list_">
        <section class="sub_top_visual">
            <img class="only_web" src="/data/cate_banner/<?= $bannerTop['ufile1'] ?>" alt="">
            <img class="only_mo" src="/data/cate_banner/<?= $bannerTop['ufile2'] ?>" alt="">
            <div class="main_visual_content_">
                <div class="text_title">지금, 바로 떠날 수 있는 이유</div>
                <div class="form_search">
                    <div class="form_element_">
                        <div class="form_input_">
                            <label for="input_keyword_">여행지</label>
                            <input type="text" id="input_keyword_" class="input_keyword_" placeholder="호텔 지역을 입력해주세요!">
                        </div>
                        <div class="form_input_multi_">
                            <div class="form_gr_">
                                <div class="form_input_ form_gr_item_">
                                    <label for="input_day">체크인</label>
                                    <input type="text" id="input_day_start_" class="input_custom_ input_ranger_date_"
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
                        <div class="form_input_">
                            <label for="input_hotel">호텔명(미입력 시 전체)</label>
                            <input type="text" style="text-transform: none;" id="input_hotel" class="input_custom_"
                                   placeholder="호텔명을 입력해주세요.">
                        </div>
                        <button type="button" onclick="search_list();" class="btn_search_">
                            검색
                        </button>
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
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function () {
                $('.list_popup_item_').click(function () {
                    let ttl = $(this).text();
                    $('#input_keyword_').val(ttl);
                    $('.hotel_popup_').removeClass('show');
                })
            })

            $('#input_day_start_, #input_day_end_').daterangepicker({
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
            });

            function renderPriceData(picker) {
                $('.drp-calendar td.available').each(function () {
                    let day = $(this).text().trim();
                    if (!day) return;

                    let currentYear = picker.startDate.year();
                    let currentMonth = (picker.startDate.month() + 1).toString().padStart(2, '0');
                    let fullDate = `${currentYear}-${currentMonth}-${day.padStart(2, '0')}`;

                    let price = prices[fullDate] || "0만";

                    if (!$(this).find('.price-tag').length) {
                        $(this).append(`<div class="price-tag">${price}</div>`);
                    }
                });
            }

            function calcDistanceDay() {
                let input_day_start_ = $('#input_day_start_').val();
                let input_day_end_ = $('#input_day_end_').val();

                let start = new Date(input_day_start_);
                let end = new Date(input_day_end_);

                let diffInMilliseconds = end - start;
                let diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);

                $('#countDay').text(diffInDays);
            }
        </script>
        <section class="sub_tour_section2">
            <div class="body_inner">
                <div style="position: relative;">
                    <div class="swiper sub_swiper2 hotel_category_list">
                        <div class="swiper-wrapper">
                            <?php foreach ($sub_codes as $code_item) :
                                if (is_file(ROOTPATH . "/public/data/code/" . $code_item['ufile1'])) {
                                    $src = "/data/code/" . $code_item['ufile1'];
                                } else {
                                    $src = "/images/product/noimg.png";
                                }
                                ?>
                                <div class="swiper-slide">
                                    <a href="/product-hotel/list-hotel/<?= $code_item['code_no'] ?>">
                                        <div class="img_box">
                                            <img src="<?= $src ?>" loading="lazy" alt="main">
                                        </div>
                                        <div class="sub_swiper2__text">
                                            <?= $code_item['code_name'] ?> <img src="/images/ico/ico_arrow_right_1.svg"
                                                                                loading="lazy" alt="">
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
                    beforeResize: function () {
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
        </script>
        <section class="sub_section3 thailand_hotel_ thailand_hotel_custom_margin custom-hotel-mo">
            <div class="body_inner">
                <div class="sub_section3__head">
                    <div class="sub_section3__head__ttl">
                        태국 갈 때는 <span class="text_active_17469E">이 호텔 꼭 가야해요!</span>
                    </div>
                </div>
                <div>
                    <div class="thailand_hotel_list_top_" id="product_list_top">
                        <?php foreach ($products['items'] as $item):
                            echo view('product/hotel/product_item_by_top', ['item' => $item]);
                        endforeach; ?>
                    </div>
                    <!-- <div class="thailand_hotel_swiper_pagination_next_"></div>
                        <div class="thailand_hotel_swiper_pagination_prev_"></div> -->
                    <div class="custom_pagination_ w_100"
                         style="<?= $products['pg'] >= $products['nPage'] ? 'display: none;' : '' ?>"
                         id="product_list_top_pagination">
                        <div class="pagination_show_" onclick="handleClickPaginationTop()">
                            <img src="/images/ico/reloadicon.png" alt="">
                            <p>다음상품</p>
                            <div class="thailand_hotel_swiper_pagination_">
                                <span class="swiper-pagination-current"
                                      id="product_list_top_pagination_current">1</span> /
                                <span><?= $products['nPage'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sub_section3 sub_tour_section7">
            <div class="body_inner">
                <div class="sub_tour_section7__head">
                    <div class="sub_tour_section7__head_ttl ttl">
                        테마로 즐기는 태국여행
                    </div>
                </div>
                <div class="d_flex justify_content_end">
                    <div class="swiper_product_list_pagination_"></div>
                </div>
                <div class="sub_tour_section7_product_list sub_tour_section7_product_list_custom swiper swiper_product_list_">
                    <div class="swiper-wrapper">
                        <?php foreach ($theme_products['items'] as $theme_product):
                            if (is_file(ROOTPATH . "/public/data/product/" . $theme_product['ufile1'])) {
                                $src = "/data/product/" . $theme_product['ufile1'];
                            } else {
                                $src = "/images/product/noimg.png";
                            }
                            ?>
                            <a href="/product-hotel/hotel-detail/<?= $theme_product['product_idx'] ?>"
                               class="sub_tour_section7_product_item swiper-slide">
                                <img class="ico_special_prd" src="/images/ico/ico_special_prd_success.png" alt="">
                                <div class="img_box img_box_12">
                                    <img src="<?= $src ?>" alt="">
                                </div>
                                <div class="sub_tour_section7_product_item__name"><?= $theme_product['product_name'] ?></div>
                                <?php
                                $arr_keyword = explode(",", $theme_product['keyword']);
                                $arr_keyword = array_filter($arr_keyword);
                                ?>
                                <div class="sub_tour_section7_product_item__keywords">
                                    <?php foreach ($arr_keyword as $keyword): ?>
                                        <span>#<?= $keyword ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php if ($bannerMiddle) : ?>
            <style>
                .main_page_01 .banner_section_main_page .banner_section_image {
                    background-image: url('/data/cate_banner/<?=$bannerMiddle['ufile1']?>');
                }

                @media screen and (max-width: 850px) {
                    .main_page_01 .banner_section_main_page .banner_section_image {
                        background-image: url('/data/cate_banner/<?=$bannerMiddle['ufile2']?>');
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
        <style>
            .best_tour_section5__hotel {
                height: 100%;
                max-height: 740px;
                overflow: hidden;
            }

            .best_tour_section5__hotel.full_ {
                height: auto;
                max-height: unset;
                overflow: unset;
            }
        </style>
        <section class="sub_section3 thailand_hotel_ sub_section5_ custom-hotel-mo">
            <div class="body_inner">
                <div class="sub_section3__head">
                    <div class="sub_section3__head__ttl">
                        더투어랩에서 만나는 <span class="text_active_17469E">역대급 호텔 초특가</span>
                    </div>
                </div>
                <div class="best_tour_section5_ best_tour_section5__hotel">
                    <?php $i2 = 1;
                    foreach ($bestValueProduct as $product):
                        if (is_file(ROOTPATH . "/public/data/product/" . $product['ufile1'])) {
                            $src = "/data/product/" . $product['ufile1'];
                        } else {
                            $src = "/images/product/noimg.png";
                        }
                        $i2++;
                        ?>
                        <a href="/product-hotel/hotel-detail/<?= $product['product_idx'] ?>"
                           class="sub_tour_section5_item">
                            <div class="img_box img_box_10">
                                <img src="<?= $src ?>" alt="main" loading="lazy">
                            </div>
                            <div class="prd_keywords">
                                <!-- <span>조인<img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon"></span>
                                        <span> 한국거 기이드</span> -->
                                <?php foreach ($product['codeTree'] as $key => $code): ?>
                                    <span class="prd_keywords_cus_span">
                                    <?= $code['code_name'] ?>
                                        <?php if ($key < count($product['codeTree']) - 1): ?>
                                            <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                                        <?php endif; ?>
                                </span>
                                <?php endforeach; ?>
                            </div>
                            <div class="prd_name">
                                <?= viewSQ($product['product_name']) ?>
                            </div>
                            <div class="prd_info">
                                <div class="prd_info__left">
                                    <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                    <span class="star_avg"><?= $product['review_average'] ?></span>
                                </div>
                                <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                <div class="prd_info__right">
                                    <span class="prd_info__right__ttl">생생리뷰</span>
                                    <span class="new_review_cnt">(<?= $product['total_review'] ?>)</span>
                                </div>
                                <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                <div class="prd_info__right">
                                    <span class="prd_info__right__ttl"><?= $product['level_name'] ?></span>
                                </div>
                            </div>
                            <div class="prd_price_ko">
                                <?= number_format($product['product_price']) ?> <span>원 ~</span> <span
                                        class="prd_price_thai">
                                <?= number_format($product['product_price_baht']) ?>
                                <span>바트</span></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php if ($i2 > 8) { ?>
                    <div class="custom_pagination_ w_100">
                        <div class="s_item_show_" onclick="handleClickPaginationBestValue(this)">
                            <p>더보기 +</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <script>
                function handleClickPaginationBestValue(el) {
                    $(el).remove();
                    $('.best_tour_section5__hotel').addClass('full_');
                }
            </script>
        </section>
        <section class="sub_tour_section6 most_searched_">
            <div class="body_inner">
                <div class="sub_tour_section6__head">
                    <div class="sub_tour_section6__head_ttl ttl text_center">
                        가장 많이 검색되는 #키워드
                    </div>
                    <div class="tab_box_area_ w_100 d_flex justify_content_center align_items_center">
                        <ul class="tab_box_show_ tab_box_show__hotel d_flex justify_content_center align_items_center">
                            <?php foreach ($keyWordAll as $key => $item) { ?>
                                <li class="tab_box_element_ p--20 border <?= $item == $keyWordActive ? 'tab_active_' : '' ?>"
                                    data-keyword="<?= $item ?>">#<?= $item ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- tab1 last slide section -->
            <div class="body_inner">
                <div class="sub_hotel_section6_product_list tab_box_content_">
                    <div class="most_searched_tab_2__prd_list" id="product_list_keyword">
                        <?php foreach ($productByKeyword['items'] as $item) {
                            echo view('product/hotel/product_item_by_keyword', ['item' => $item]);
                        } ?>
                    </div>
                    <div class="custom_pagination_ w_100"
                         style="<?= $productByKeyword['pg'] >= $productByKeyword['nPage'] ? 'display: none;' : '' ?>"
                         id="custom_pagination_keyword">
                        <div class="pagination_show_" onclick="handleClickPaginationKeyword()">
                            <img src="/images/ico/reloadicon.png" alt="">
                            <p>다음상품</p>
                            <div class="most_searched_tab_2_pagination_ sub_tour_section6_swiper_pagination_">
                                <span class="swiper-pagination-current" id="product_list_keyword_current">1</span> /
                                <span><?= $productByKeyword['nPage'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
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
        function search_list() {
            let dates = $("#input_day").val().split(' -> ') ?? [];
            const checkin = dates[0] ? dates[0].trim() : '';
            const checkout = dates[1] ? dates[1].trim() : '';
            let hotel_name = $("#input_hotel").val();
            window.location.href = '/product-hotel/list-hotel/<?= $code_no ?>?checkin=' + checkin + '&checkout=' + checkout + '&search_product_name=' + hotel_name;
        }

        let page = 1;
        let totalPage = Number('<?= $productByKeyword['nPage'] ?>');
        let keywordCurrent = '<?= $keyWordActive ?>';

        function handleClickPaginationKeyword(keyword) {
            if (page >= totalPage && !keyword) return;
            if (keyword) keywordCurrent = keyword;
            if (!keyword) page += 1;
            $.ajax({
                type: "GET",
                url: "/product/get-by-keyword",
                data: {
                    keyword: keywordCurrent,
                    page: page,
                    code_no: 1303
                },
                dataType: "json",
                success: function (data) {
                    totalPage = Number(data.nPage);
                    if (keyword) {
                        $("#product_list_keyword").html(data.html);
                    } else {
                        $("#product_list_keyword").append(data.html);
                    }
                    $("#product_list_keyword_current").text(page);
                    if (page >= totalPage) {
                        $('#custom_pagination_keyword').hide();
                    } else {
                        $('#custom_pagination_keyword').show();
                    }
                }
            })
        }

        let pageTop = 1;
        let totalPageTop = Number('<?= $products['nPage'] ?>');

        function handleClickPaginationTop() {
            pageTop += 1;
            $.ajax({
                type: "GET",
                url: "/product/get-by-top",
                data: {
                    page: pageTop,
                    code_no: 1303
                },
                dataType: "json",
                success: function (data) {
                    totalPageTop = Number(data.nPage);
                    $("#product_list_top").append(data.html);
                    $("#product_list_top_pagination_current").text(pageTop);
                    if (pageTop >= totalPageTop) {
                        $('#product_list_top_pagination').hide();
                    } else {
                        $('#product_list_top_pagination').show();
                    }
                }
            })
        }

        $(document).ready(function () {
            $('.pagination_show_').on('click', function () {
                let pagination = $(this).parent().prev().prev();
                if (!$(pagination).hasClass('swiper-button-disabled')) {
                    $(pagination).trigger('click');
                }
            });

            $('.tab_box_element_').on('click', function () {
                $('.tab_box_element_').removeClass('tab_active_');
                $(this).addClass('tab_active_');
                page = 1;
                handleClickPaginationKeyword($(this).data('keyword'));
            })
        });

        let swiper = new Swiper(".swiper_product_list_", {
            slidesPerView: "auto",
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: ".swiper_product_list_pagination_",
                clickable: true,
            },
            breakpoints: {
                300: {
                    slidesPerView: "auto",
                    spaceBetween: 20,
                    pagination: false,
                },
                850: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
            }
        });

        function loadMultipleSlider() {
            for (let i = 0; i < 6; i++) {
                new Swiper(`.most_searched_tab_${i}`, {
                    loop: true,
                    pagination: {
                        el: `.most_searched_tab_${i}_pagination_`,
                        clickable: true,
                        type: "fraction",
                    },
                    navigation: {
                        nextEl: `.most_searched_tab_${i}_pagination_next_`,
                        prevEl: `.most_searched_tab_${i}_pagination_prev_`,
                    },
                    breakpoints: {
                        300: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        850: {
                            slidesPerView: 4,
                            grid: {
                                rows: 1,
                            },
                            spaceBetween: 20,
                            pagination: {
                                el: `.most_searched_tab_${i}_pagination_`,
                                clickable: true,
                                type: "fraction",
                            },
                        }
                    }
                });
            }
        }

        // Initial load
        loadMultipleSlider();
    </script>
    <script>
        $(document).ready(function () {
            const swiper1 = new Swiper(".sub_swiper1", {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 20,
                autoplay: true,
                navigation: {
                    nextEl: ".sub_tour__slide__paging__next",
                    prevEl: ".sub_tour__slide__paging__prev",
                },
                scrollbar: {
                    el: '.sub_tour__slide__scroll',
                    draggable: true,
                },
            });

            let swiper13 = undefined;

            function initSwiper13() {
                swiper13 = new Swiper(".sub_section3_swiper", {
                    loop: true,
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
            $(window).resize(function () {
                if (swiper1.navigation && swiper1.navigation.update) {
                    swiper1.navigation.update();
                }
                if (swiper1.scrollbar && swiper1.scrollbar.updateSize) {
                    swiper1.scrollbar.updateSize();
                }
            });
        });
    </script>
    <script>
        let thailand_hotel_swiper_ = new Swiper(".thailand_hotel_swiper_", {
            slidesPerView: 2,
            grid: {
                rows: 2,
            },
            breakpoints: {
                300: {
                    slidesPerView: 2,
                    grid: {
                        rows: 4,
                    },
                    pagination: false,
                },
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
        // let swipertest = new Swiper(".last_slide_swiper_", {
        //     slidesPerView: 2,
        //     grid: {
        //         rows: 2,
        //     },
        //     breakpoints: {
        //         851: {
        //             slidesPerView: 4,
        //             grid: {
        //                 rows: 1,
        //             },
        //             spaceBetween: 20,
        //         }
        //     },
        //     spaceBetween: 20,
        //     pagination: {
        //         el: ".last_slide_swiper_pagination_",
        //         type: "fraction",
        //         clickable: true,
        //     },
        //     navigation: {
        //         nextEl: ".last_slide_swiper_pagination_next_",
        //         prevEl: ".last_slide_swiper_pagination_prev_",
        //     },
        // });
    </script>
    <script>
        // $(document).ready(function () {
        //     setTimeout(() => {
        //         location.reload();
        //     }, 2000);
        // });
        const prices = {
            "2024-11-25": "10만",
            "2024-11-26": "15만",
            "2024-11-27": "20만",
            "2024-11-28": "18만",
            "2024-11-29": "12만"
        };

        $(function () {
            $('#input_day2').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' -> ',
                    applyLabel: "적용",
                    cancelLabel: "취소",
                    fromLabel: "시작일",
                    toLabel: "종료일",
                    customRangeLabel: "사용자 정의",
                    weekLabel: "주",
                    daysOfWeek: ["일", "월", "화", "수", "목", "금", "토"],
                    monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
                    firstDay: 1
                }
            }).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' -> ' + picker.endDate.format('YYYY-MM-DD'));
                renderPrice(picker);
            }).on('show.daterangepicker', function (ev, picker) {
                renderPrice(picker);
            }).on('callback.daterangepicker', function (ev, picker) {
                renderPrice(picker);
            });
        });

        function renderPrice(picker) {
            $('.drp-calendar td.available').each(function () {
                const day = $(this).text().trim();
                if (!day) return;

                const currentYear = picker.startDate.year();
                const currentMonth = (picker.startDate.month() + 1).toString().padStart(2, '0');
                const fullDate = `${currentYear}-${currentMonth}-${day.padStart(2, '0')}`;

                const price = prices[fullDate] || "0만";

                if (!$(this).find('.price-tag').length) {
                    $(this).append(`<div class="price-tag">${price}</div>`);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#input_keyword_').on('click', function () {
                $('.hotel_popup_').addClass('show');
            });
        })

        $(document).on('click', function (event) {
            const $popup = $('.hotel_popup_');
            const $input_keyword_ = $('#input_keyword_');
            if ($input_keyword_.has(event.target).length > 0 || $input_keyword_.is(event.target)) {
                $popup.addClass('show');
            } else {
                $popup.removeClass('show');
            }
        });

    </script>
<?php $this->endSection(); ?>