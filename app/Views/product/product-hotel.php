<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

    <style>
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
    </style>
    <link rel="stylesheet" type="text/css" href="/lib/daterangepicker/daterangepicker.css"/>
    <script type="text/javascript" src="/lib/momentjs/moment.min.js"></script>
    <script type="text/javascript" src="/lib/daterangepicker/daterangepicker.min.js"></script>
    <div class="main_page_01 page_share_ page_product_list_">
        <section class="sub_top_visual">
            <img class="only_web" src="/images/banner/main_visual_banner.png" alt="">
            <img class="only_mo" src="/images/banner/main_visual_banner_m.png" alt="">
            <div class="main_visual_content_">
                <div class="text_title">지금, 바로 떠날 수 있는 이유</div>
                <div class="form_search">
                    <div class="form_element_">
                        <div class="form_input_">
                            <label for="input_day">체크인/체크아웃 날짜</label>
                            <input type="text" id="input_day" class="input_custom_" placeholder="날짜를 선택해주세요." readonly>
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
                </div>
            </div>
        </section>
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
                            if (is_file(ROOTPATH . "/public/data/hotel/" . $theme_product['ufile1'])) {
                                $src = "/data/hotel/" . $theme_product['ufile1'];
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
        <section class="banner_section_main_page">
            <div class="body_inner">
                <div class="banner_section_image" style="position: relative;">
                    <div class="box-text">
                        <h3 class="title-box">여름휴가쿠폰대잔치</h3>
                        <p class="des-box">다운로드 기간 : 2024. 05. 22 ~ 07. 31</p>
                    </div>
                </div>
            </div>
        </section>
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
                        if (is_file(ROOTPATH . "/public/data/hotel/" . $product['ufile1'])) {
                            $src = "/data/hotel/" . $product['ufile1'];
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
                        <div class="img_box img_box_13 ">
                            <img src="/uploads/sub/banner_tour_2.png" alt="">
                        </div>
                    </div>
                    <div class="sub_tour_section8__banner">
                        <div class="img_box img_box_13">
                            <img src="/uploads/sub/banner_tour_3.png" alt="">
                        </div>
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
        $(function () {
            $('#input_day').daterangepicker({
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
            });

            $('#input_day').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' -> ' + picker.endDate.format('YYYY-MM-DD'));
            });
        });
    </script>
<?php $this->endSection(); ?>