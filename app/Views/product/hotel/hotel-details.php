<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <link rel="stylesheet" type="text/css" href="/lib/daterangepicker/daterangepicker_custom.css"/>
    <script type="text/javascript" src="/lib/momentjs/moment.min.js"></script>
    <script type="text/javascript" src="/lib/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw3G5DUAOaV9CFr3Pft_X-949-64zXaBg&libraries=geometry"
            async defer></script>
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
            display: flex;
            flex-direction: column;
            height: 100%;
            border: none;
        }

        .content-sub-hotel-detail .room-table td:nth-child(1) {
            padding-bottom: 270px;
        }

        .price_bath {
            color: #888;
            font-size: 20px;
            font-weight: 500;
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

        </style>
        <pre><?php print_r($viewedProducts); ?></pre>
    <div class="main_page_01 page_share_ page_product_list_ content-sub-hotel-detail">
        <div class="body_inner">
            <div class="section1">
                <div class="title-container">
                    <h2><?= $hotel['product_name'] ?> </h2>
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
                $i3 = count(array_filter(range(1, 7), fn($t) => !empty($hotel["ufile$t"])));
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
                        <?php for ($j = 2; $j < 5; $j++) {
                            ?>
                            <img onclick="img_pops('<?= $hotel['product_idx'] ?>')"
                                 class="grid_2_2_size imageDetailSup_"
                                 src="/data/product/<?= $hotel['ufile' . $j] ?>"
                                 alt="<?= $hotel['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                        <?php } ?>
                        <div class="grid_2_2_sub"
                             onclick="img_pops('<?= $hotel['product_idx'] ?>')"
                             style="position: relative; cursor: pointer;">
                            <img class="custom_button imageDetailSup_"
                                 src="/data/product/<?= $hotel['ufile5'] ?>"
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
                        <p class="nav-item active" onclick="scrollToEl('section2')" style="cursor: pointer">숙소개요</p>
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
                                    class="daterange_hotel_detail"/>
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
                $(document).ready(function () {

                    const res = $.ajax({
                        url: `<?= route_to('api.hotel_.get_data') ?>?product_idx=<?= $hotel['product_idx'] ?>`,
                        type: 'GET',
                        dataType: 'json',
                        async: false,
                        success: function (response) {
                            return response;
                        },
                        error: function (xhr, status, error) {
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
                            isInvalidDate: function (date) {
                                // const formattedDate = date.format('YYYY-MM-DD');
                                // return !enabled_dates.includes(formattedDate);
                            },
                            parentEl: ".date_hotel_detail",
                            linkedCalendars: true,
                            autoApply: true,
                            minDate: moment().add(1, 'days'),
                            opens: "center"
                        },
                        function (start, end) {

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

                            getPriceHotel(startDate.format('YYYY-MM-DD'), endDate.subtract(1, 'days').format('YYYY-MM-DD'));

                        });

                    $('#openDateRangePicker').click(function () {
                        $('#daterange_hotel_detail').click();
                    });

                    const observer = new MutationObserver((mutations) => {
                        mutations.forEach((mutation) => {
                            if (mutation.type === 'childList' && $(mutation.target).hasClass('calendar-table')) {
                                $(mutation.target)
                                    .find('td.off.disabled')
                                    .each(function () {
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
                                    .each(function () {
                                        const $cell = $(this);
                                        const text = $cell.text().trim();
                                        if (!$cell.find('.custom-info').length) {
                                            $cell.html(`<div class="custom-info">
                                        <span>${text}</span>
                                        <span class="label allow-text">예약</span>
                                        </div>`);
                                        }
                                    });
                                const filteredRows = $("tr").filter(function () {
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
                            is_disabled
                        } = item;

                        if (is_disabled) {
                            $(`.book_btn_${idx}`).attr('disabled', true).text("마감");
                        } else {
                            $(`.book_btn_${idx}`).attr('disabled', false).text("예약하기");
                        }

                        if (day > 0 && price_won > 0) {
                            $(`.input_day_qty_${idx}`).each(function () {
                                let inputElem = $(this);
                                <?php
                                    if($hotel['is_won_bath'] == 'B'){
                                ?>      
                                    inputElem.closest(".room_op_").find(".hotel_price_day").text(price.toLocaleString('en-US') + " 바트");
                                    inputElem.closest(".room_op_").find(".hotel_price_day").attr("data-price", price);
                                    inputElem.closest(".room_op_").find(".hotel_price_day_sale").text(sale_price.toLocaleString('en-US'));
                                    inputElem.closest(".room_op_").find(".totalPrice").attr('data-price', sale_price);
                                    inputElem.val(day).attr('data-price', price).attr('data-sale_price', sale_price);  
                                <?php
                                    }else{
                                ?>
                                    inputElem.closest(".room_op_").find(".hotel_price_day").text(price_won.toLocaleString('en-US') + " 원");
                                    inputElem.closest(".room_op_").find(".hotel_price_day").attr("data-price", price_won);
                                    inputElem.closest(".room_op_").find(".hotel_price_day_sale").text(sale_price_won.toLocaleString('en-US'));
                                    inputElem.closest(".room_op_").find(".totalPrice").attr('data-price', sale_price_won);
                                    inputElem.val(day).attr('data-price', price_won).attr('data-sale_price', sale_price_won);
                                <?php
                                    }
                                ?>
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

                $(document).ready(function () {
                    $('.list_popup_item_').click(function () {
                        let ttl = $(this).text();
                        $('#input_keyword_').val(ttl);
                        $('.hotel_popup_').removeClass('show');
                    })

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

                <script>
                    function go_category_room(code) {
                        let currentUrl = new URL(window.location.href);
                        currentUrl.searchParams.set('s_category_room', code);
                        currentUrl.hash = 'sub_top_visual';
                        window.location.href = currentUrl.toString();
                    }
                </script>
                <?php foreach ($hotel_options as $item) : ?>
                    <?php $room = $item['room']; ?>
                    <?php $room_options = $room['room_option']; ?>
                    <?php $room_facil = $room['room_facil']; ?>
                    <?php
                    $_arr = explode("|", $room_facil);
                    $count_facil = count($_arr);
                    $isValid = false;
                    $room_op = '';
                    $room_option_ = '';
                    ?>

                    <?php if ($s_category_room === '' || !isset($s_category_room)) : ?>
                        <div class="card-item-sec3 <?= $room_option_ ?>">
                            <div class="card-title-sec3-container">
                                <h2><?= $room['roomName'] ?></h2>
                                <div class="label"><?= $room['scenery'] ?></div>
                            </div>
                            <div class="card-item-container <?= $room_op ?>">
                                <div class="card-item-left">
                                    <div class="only_web">
                                        <div class="grid2_2_1">
                                            <img src="/uploads/rooms/<?= $room['ufile1'] ?>"
                                                 style="width: 285px; border: 1px solid #dbdbdb; height: 190px"
                                                 onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                 onerror="this.src='/images/share/noimg.png'"
                                                 alt="<?= $room['roomName'] ?>">
                                            <div class=""
                                                 style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%">
                                                <img class="imageDetailOption_"
                                                     src="<?= isset($room['ufile2']) && $room['ufile2'] ? '/uploads/rooms/' . $room['ufile2'] : '/images/share/noimg.png' ?>"
                                                     onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                     onerror="this.src='/images/share/noimg.png'"
                                                     alt="<?= $room['roomName'] ?>">

                                                <img class="imageDetailOption_"
                                                     src="<?= isset($room['ufile3']) && $room['ufile3'] ? '/uploads/rooms/' . $room['ufile3'] : '/images/share/noimg.png' ?>"
                                                     onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                     onerror="this.src='/images/share/noimg.png'"
                                                     alt="<?= $room['roomName'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid2_2_1_m only_mo">
                                        <img src="/uploads/sub/hotel_item_1_1.png" alt="hotel_item_1_1">
                                    </div>
                                    <h2 class="subtitle">초대형 더블침대 1개 또는 싱글침대 2개</h2>
                                    <?php $room_facil = $room['room_facil']; ?>
                                    <div class="cus_scroll">
                                        <ul class="cus_scroll_li">
                                            <?php
                                            $_arr = explode("|", $room_facil);
                                            foreach ($rresult as $row_r) :
                                                for ($i = 0; $i < count($_arr); $i++) {
                                                    if ($_arr[$i]) {
                                                        if ($_arr[$i] == $row_r['code_no']) {
                                                            ?>
                                                            <li><?= $row_r['code_name'] ?></li>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                                <?php
                                if (count($room_options) > 0) {
                                    ?>
                                    <table class="room-table">
                                        <colgroup>
                                            <col class="only_mo" width="25%">
                                            <col class="only_mo" width="15%">
                                            <col class="only_web" width="35%">
                                            <col class="only_web" width="10%">
                                            <!--                                                <col width="10%">-->
                                            <col width="x">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th>옵션 상세</th>
                                            <th>수량</th>
                                            <!--                                                <th>쿠폰</th>-->
                                            <th>객실 요금</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($room_options as $room_op) : ?>
                                            <?php

                                            $o_upprice_bath = $room_op['r_price'] + $room_op['r_price_3'];
                                            $o_downprice_bath = $room_op['r_price'] + $room_op['r_price_3'];

                                            $o_upprice = $room_op['r_price_won'] + $room_op['r_price_3_won'];
                                            $o_downprice = $room_op['r_price_2_won'] + $room_op['r_price_3_won'];

                                            $upprice = $room_op['r_price_won'] + $room_op['r_price_3_won'] + $item['goods_price1_won'] + $item['goods_price3_won'];
                                            $downprice = $room_op['r_price_2_won'] + $room_op['r_price_3_won'] + $item['goods_price2_won'] + $item['goods_price3_won'];

                                            $upprice_bath = $room_op['r_price'] + $room_op['r_price_3'] + $item['goods_price1'] + $item['goods_price3'];
                                            $downprice_bath = $room_op['r_price_2'] + $room_op['r_price_3'] + $item['goods_price2'] + $item['goods_price3'];
                                            ?>
                                            <tr class="room_op_" data-room="<?= "S_" . $room_op["rop_idx"] ?>"
                                                data-opId="<?= $room_op["rop_idx"] ?>" data-opType="S" data-ho_idx="<?= $item['idx'] ?>">
                                                <td>
                                                    <div class="room-details">
                                                        <p class="room-p-cus-1">객실 상세</p>
                                                        <p><?= $room_op['r_key'] ?></p>
                                                        <?php
                                                        $room_op_arr = explode("|", $room_op['r_val']);
                                                        ?>
                                                        <ul>
                                                            <?php for ($i = 0; $i < count($room_op_arr); $i++) { ?>
                                                                <li><?= $room_op_arr[$i] ?></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="room_qty">
                                                        <p>객실 수 </p>
                                                        <div class="room_activity">
                                                            <button type="button" class="btnMinus">
                                                                -
                                                            </button>
                                                            <input type="text" class="input_room_qty onlynum"
                                                                   value="1"
                                                                   style="text-align: center" readonly
                                                                   id="input_room_qty_<?= $item['idx'] ?>"
                                                                   data-op="<?= $item['idx'] ?>"
                                                                   data-id="<?= $room_op['rop_idx'] ?>">
                                                            <button type="button" class="btnPlus">
                                                                +
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="day_qty">
                                                        <p>숙박일 </p>
                                                        <div class="day_activity">
                                                            <input type="text"
                                                                   class="input_day_qty onlynum input_day_qty_<?= $item['idx'] ?>"
                                                                   value="1"
                                                                   style="text-align: center; width: 100%; border: 1px solid #dbdbdb"
                                                                   readonly
                                                                   data-op="<?= $item['idx'] ?>"
                                                                   data-price="<?= $hotel['is_won_bath'] == "B" ? $o_upprice_bath : $o_upprice ?>"
                                                                   data-sale_price="<?= $hotel['is_won_bath'] == "B" ? $o_downprice_bath : $o_downprice ?>"
                                                                   data-id="<?= $room_op['rop_idx'] ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                $isSale = true;
                                                if ($downprice == $upprice) {
                                                    $isSale = false;
                                                }
                                                if ($isSale) {
                                                    $percent = ($downprice) / ($upprice) * 100;
                                                    $percent = 100 - $percent;
                                                    $percent = round($percent, 2);
                                                }
                                                
                                                ?>
                                                <td>
                                                    <div class="price-details">
                                                        <span class="total" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                            객실금액: <span class="price-strike hotel_price_day"
                                                                        data-price="<?= $hotel['is_won_bath'] == "B" ? $upprice_bath : $upprice ?>"> <?php echo $hotel['is_won_bath'] == "B" ? number_format($upprice_bath) . " 바트" : number_format($upprice) . " 원" ?></span>
                                                            <span class="hotel_price_day_sale"><?= $hotel['is_won_bath'] == "B" ? number_format($downprice_bath) : number_format($downprice) ?></span> <?php echo $hotel['is_won_bath'] == "B" ? " 바트" : " 원" ?>
                                                        </span>
                                                        <?php if ($isSale) { ?>
                                                            <div class="discount" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                                <span class="label">특별할인</span>
                                                                <span class="price_content"><i
                                                                            class="hotel_price_percent"><?= $percent ?></i>%할인</span>
                                                            </div>
                                                        <?php } ?>
                                                        <span class="details">객실 <span
                                                                    class="count_room"
                                                                    id="<?= $room_op['rop_idx'] ?>">1</span>개 × <span
                                                                    class="count_day"
                                                                    id="<?= $room_op['rop_idx'] ?>">1</span>박 (세금 포함)</span>
                                                        <p style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                            <?php 
                                                                if($hotel['is_won_bath'] == "W" || $hotel['is_won_bath'] == "B"){
                                                                    if($hotel['is_won_bath'] == "W"){
                                                            ?>
                                                                <span class="price totalPrice"
                                                                    id="<?= $room_op['rop_idx'] ?>"
                                                                    data-price="<?= $downprice ?>">
                                                                    <?= number_format($downprice) ?>
                                                                    <span>원</span>
                                                                </span>
                                                            <?php
                                                                    }else if($hotel['is_won_bath'] == "B"){
                                                            ?>    
                                                                <span class="price totalPrice"
                                                                    id="<?= $room_op['rop_idx'] ?>"
                                                                    data-price="<?= $downprice_bath ?>">
                                                                    <?= number_format($downprice_bath) ?>
                                                                    <span>바트</span>
                                                                </span>    
                                                            <?php
                                                                    }
                                                                }else{
                                                            ?>   
                                                                <span class="price totalPrice"
                                                                    id="<?= $room_op['rop_idx'] ?>"
                                                                    data-price="<?= $downprice ?>">
                                                                    <?= number_format($downprice) ?>
                                                                    <span>원</span>
                                                                    <span class="price_bath">( <?= number_format($downprice_bath) ?>바트)</span>
                                                                </span>
                                                            <?php
                                                                }
                                                            ?>
                                                        </p>
                                                        <?php
                                                            if($item["price_secret"] == "Y"){
                                                        ?>
                                                            <div class="price_secret_wrap">
                                                                <p>비밀특가</p>
                                                                <i></i>
                                                                <div class="price_secret_notes">
                                                                    호텔 정책에 의해 가격 공시가 불가능합니다.
                                                                    <br>
                                                                    룸타입을 선택하시고 체크인/아웃, 객실수, 인원 선택 후 가격 확인 요청을 누르시면 나의 1:1 게시판에서 금액 확인이 가능합니다.
                                                                </div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php if ($hotel['product_status'] == 'sale'): ?>
                                                            <button type="button"
                                                                    class="book-button book_btn_<?= $item['idx'] ?>">
                                                                예약하기
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    $upprice = $item['goods_price1_won'] + $item['goods_price3_won'];
                                    $downprice = $item['goods_price2_won'] + $item['goods_price3_won'];

                                    $upprice_bath = $item['goods_price1'] + $item['goods_price3'];
                                    $downprice_bath = $item['goods_price2'] + $item['goods_price3'];
                                    ?>
                                    <table class="room-table">
                                        <colgroup>
                                            <col width="10%">
                                            <col width="*%">
                                            <!--                                                <col width="45%">-->
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th>수량</th>
                                            <!--                                                <th>쿠폰</th>-->
                                            <th>객실 요금</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="room_op_" data-room="<?= "M_" . $item["idx"] ?>"
                                            data-opId="<?= $item["idx"] ?>" data-opType="M" data-ho_idx="<?= $item['idx'] ?>">

                                            <td>
                                                <div class="room_qty">
                                                    <p>객실 수 </p>
                                                    <div class="room_activity">
                                                        <button type="button" class="btnMinus">
                                                            -
                                                        </button>
                                                        <input type="text" class="input_room_qty onlynum" value="1"
                                                               style="text-align: center" readonly
                                                               id="input_room_qty_<?= $item['idx'] ?>"
                                                               data-op="<?= $item['idx'] ?>"
                                                               data-id="<?= $item["idx"] ?>">
                                                        <button type="button" class="btnPlus">
                                                            +
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="day_qty">
                                                    <p>숙박일 </p>
                                                    <div class="day_activity">
                                                        <input type="text"
                                                               class="input_day_qty onlynum input_day_qty_<?= $item['idx'] ?>"
                                                               value="1"
                                                               style="text-align: center; width: 100%; border: 1px solid #dbdbdb"
                                                               readonly
                                                               data-op="<?= $item['idx'] ?>"
                                                               data-price="<?= $hotel['is_won_bath'] == "B" ? $upprice_bath : $upprice ?>"
                                                               data-sale_price="<?=  $hotel['is_won_bath'] == "B" ? $downprice_bath : $downprice ?>"
                                                               data-id="<?= $item["idx"] ?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <?php
                                            $isSale = true;

                                            if ($item['goods_price1_won'] == $item['goods_price2_won']) {
                                                $isSale = false;
                                            }
                                            if ($isSale) {
                                                $percent = ($downprice) / ($upprice) * 100;
                                                $percent = 100 - $percent;
                                                $percent = round($percent, 2);
                                            }
                                            ?>
                                            <td>
                                                <div class="price-details">

                                                    <span class="total" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                        객실금액: <span class="price-strike hotel_price_day"
                                                                    data-price="<?= $hotel['is_won_bath'] == "B" ? $upprice_bath : $upprice ?>"><?= $hotel['is_won_bath'] == "B" ? number_format($upprice_bath) . " 바트" : number_format($upprice) . " 원" ?></span>
                                                        <span class="hotel_price_day_sale"><?= $hotel['is_won_bath'] == "B" ? number_format($downprice_bath) : number_format($downprice) ?></span> <?php echo $hotel['is_won_bath'] == "B" ? " 바트" : " 원" ?>
                                                    </span>
                                                    <?php if ($isSale) { ?>
                                                        <div class="discount" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                            <span class="label">특별할인</span>
                                                            <span class="price_content"><i
                                                                        class="hotel_price_percent"><?= $percent ?></i>%할인</span>
                                                        </div>
                                                    <?php } ?>
                                                    <span class="details">객실 <span
                                                                class="count_room"
                                                                id="<?= $item['idx'] ?>">1</span>개 × <span
                                                                class="count_day"
                                                                id="<?= $item['idx'] ?>">1</span>박 (세금 포함)</span>
                                                    <?php 
                                                        if($hotel['is_won_bath'] == "W" || $hotel['is_won_bath'] == "B"){
                                                            if($hotel['is_won_bath'] == "W"){
                                                    ?>
                                                        <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                            id="<?= $item['idx'] ?>"
                                                            data-price="<?= $downprice ?>">
                                                            <?= number_format($downprice) ?>
                                                            <span>원</span>
                                                        </span>
                                                    <?php
                                                            }else if($hotel['is_won_bath'] == "B"){
                                                    ?>    
                                                        <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                            id="<?= $item['idx'] ?>"
                                                            data-price="<?= $downprice_bath ?>">
                                                            <?= number_format($downprice_bath) ?>
                                                            <span>바트</span>
                                                        </span>   
                                                    <?php
                                                            }
                                                        }else{
                                                    ?>   
                                                        <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                            id="<?= $item['idx'] ?>"
                                                            data-price="<?= $downprice ?>">
                                                            <?= number_format($downprice) ?>
                                                            <span>원</span>
                                                            <span class="price_bath">( <?= number_format($downprice_bath) ?>바트)</span>
                                                        </span>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if($item["price_secret"] == "Y"){
                                                    ?>
                                                        <div class="price_secret_wrap">
                                                            <p>비밀특가</p>
                                                            <i></i>
                                                            <div class="price_secret_notes">
                                                                호텔 정책에 의해 가격 공시가 불가능합니다.
                                                                <br>
                                                                룸타입을 선택하시고 체크인/아웃, 객실수, 인원 선택 후 가격 확인 요청을 누르시면 나의 1:1 게시판에서 금액 확인이 가능합니다.
                                                            </div>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>

                                                    <?php if ($hotel['product_status'] == 'sale'): ?>
                                                        <button type="button"
                                                                class="book-button book_btn_<?= $item['idx'] ?>">
                                                            예약하기
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php if ($isValid) : ?>
                                <div class="d-flex" style="margin-top: 30px; gap: 10px;">
                                    <button class="btnReadMore">자세히 보기</button>
                                    <button class="btnReadLess">덜 숨기기</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <?php
                        $_arr = explode("|", $room['category']);

                        for ($j = 0; $j < count($_arr); $j++) {
                            if ($_arr[$j] === $s_category_room) {
                                ?>
                                <div class="card-item-sec3 <?= $room_option_ ?>">
                                    <div class="card-title-sec3-container">
                                        <h2><?= $room['roomName'] ?></h2>
                                        <div class="label"><?= $room['scenery'] ?></div>
                                    </div>
                                    <div class="card-item-container <?= $room_op ?>">
                                        <div class="card-item-left">
                                            <div class="only_web">
                                                <div class="grid2_2_1">
                                                    <img src="/uploads/rooms/<?= $room['ufile1'] ?>"
                                                         onerror="this.src='/images/share/noimg.png'"
                                                         style="width: 285px; border: 1px solid #dbdbdb; height: 190px"
                                                         onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                         alt="<?= $room['roomName'] ?>">
                                                    <div class=""
                                                         style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%">

                                                        <img class="imageDetailOption_"
                                                             src="<?= isset($room['ufile2']) && $room['ufile2'] ? '/uploads/rooms/' . $room['ufile2'] : '/images/share/noimg.png' ?>"
                                                             onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                             onerror="this.src='/images/share/noimg.png'"
                                                             alt="<?= $room['roomName'] ?>">

                                                        <img class="imageDetailOption_"
                                                             src="<?= isset($room['ufile3']) && $room['ufile3'] ? '/uploads/rooms/' . $room['ufile3'] : '/images/share/noimg.png' ?>"
                                                             onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                             onerror="this.src='/images/share/noimg.png'"
                                                             alt="<?= $room['roomName'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid2_2_1_m only_mo">
                                                <img src="/uploads/sub/hotel_item_1_1.png" alt="hotel_item_1_1">
                                            </div>
                                            <h2 class="subtitle">초대형 더블침대 1개 또는 싱글침대 2개</h2>
                                            <div class="cus_scroll">
                                                <ul class="cus_scroll_li">
                                                    <?php
                                                    $_arr = explode("|", $room_facil);
                                                    foreach ($rresult as $row_r) :
                                                        for ($i = 0; $i < count($_arr); $i++) {
                                                            if ($_arr[$i]) {
                                                                if ($_arr[$i] == $row_r['code_no']) {
                                                                    ?>
                                                                    <li><?= $row_r['code_name'] ?></li>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                        if (count($room_options) > 0) {
                                            ?>
                                            <table class="room-table">
                                                <colgroup>
                                                    <col width="35%">
                                                    <col width="20%">
                                                    <!--                                                        <col width="10%">-->
                                                    <col width="x">
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>옵션 상세</th>
                                                    <th>수량</th>
                                                    <!--                                                        <th>쿠폰</th>-->
                                                    <th>객실 요금</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php foreach ($room_options as $room_op) : ?>
                                                    <?php
                                                    $o_upprice = $room_op['r_price_won'] + $room_op['r_price_3_won'];
                                                    $o_downprice = $room_op['r_price_2_won'] + $room_op['r_price_3_won'];

                                                    $o_upprice_bath = $room_op['r_price'] + $room_op['r_price_3'];
                                                    $o_downprice_bath = $room_op['r_price'] + $room_op['r_price_3'];

                                                    $upprice = $room_op['r_price_won'] + $room_op['r_price_3_won'] + $item['goods_price1_won'] + $item['goods_price3_won'];
                                                    $downprice = $room_op['r_price_2_won'] + $room_op['r_price_3_won'] + $item['goods_price2_won'] + $item['goods_price3_won'];

                                                    $upprice_bath = $room_op['r_price'] + $room_op['r_price_3'] + $item['goods_price1'] + $item['goods_price3'];
                                                    $downprice_bath = $room_op['r_price_2'] + $room_op['r_price_3'] + $item['goods_price2'] + $item['goods_price3'];
                                                    ?>
                                                    <tr class="room_op_"
                                                        data-room="<?= "S_" . $room_op["rop_idx"] ?>"
                                                        data-opId="<?= $room_op["rop_idx"] ?>" data-opType="S" data-ho_idx="<?= $item['idx'] ?>">
                                                        <td>
                                                            <div class="room-details">
                                                                <p class="room-p-cus-1">객실 상세</p>
                                                                <p><?= $room_op['r_key'] ?></p>
                                                                <?php
                                                                $room_op_arr = explode("|", $room_op['r_val']);
                                                                ?>
                                                                <ul>
                                                                    <?php for ($i = 0; $i < count($room_op_arr); $i++) { ?>
                                                                        <li><?= $room_op_arr[$i] ?></li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="room_qty">
                                                                <p>객실 수 </p>
                                                                <div class="room_activity">
                                                                    <button type="button" class="btnMinus">
                                                                        -
                                                                    </button>
                                                                    <input type="text"
                                                                           class="input_room_qty onlynum"
                                                                           value="1"
                                                                           style="text-align: center"
                                                                           id="input_room_qty_<?= $item['idx'] ?>"
                                                                           data-op="<?= $item['idx'] ?>"
                                                                           data-id="<?= $room_op['rop_idx'] ?>">
                                                                    <button type="button" class="btnPlus">
                                                                        +
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="day_qty">
                                                                <p>숙박일 </p>
                                                                <div class="day_activity">
                                                                    <input type="text"
                                                                           class="input_day_qty onlynum input_day_qty_<?= $item['idx'] ?>"
                                                                           value="1"
                                                                           data-op="<?= $item['idx'] ?>"
                                                                           data-price="<?= $hotel['is_won_bath'] == "B" ? $o_upprice_bath : $o_upprice ?>"
                                                                           data-sale_price="<?= $hotel['is_won_bath'] == "B" ? $o_downprice_bath : $o_downprice ?>"
                                                                           style="text-align: center; width: 100%; border: 1px solid #dbdbdb"
                                                                           readonly
                                                                           data-id="<?= $room_op['rop_idx'] ?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <?php
                                                        $isSale = true;
                                                        if ($upprice == $downprice) {
                                                            $isSale = false;
                                                        }
                                                        if ($isSale) {
                                                            $percent = ($downprice) / ($upprice) * 100;
                                                            $percent = 100 - $percent;
                                                            $percent = round($percent, 2);
                                                        }
                                                        ?>
                                                        <td>
                                                            <div class="price-details">

                                                                <div class="price-strike-container" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                                    옵션금액: <span class="price-strike room_price_day"
                                                                                data-price="<?= $hotel['is_won_bath'] == "B" ? $o_upprice_bath : $o_upprice ?>"><?= $hotel['is_won_bath'] == "B" ? number_format($o_upprice_bath) . " 바트" : number_format($o_upprice) . " 원" ?></span>
                                                                    <span class="room_price_day_sale"
                                                                          data-price="<?= $hotel['is_won_bath'] == "B" ? $o_downprice_bath : $o_downprice ?>"><?= $hotel['is_won_bath'] == "B" ? number_format($o_downprice_bath) : number_format($o_downprice) ?></span> <?php echo $hotel['is_won_bath'] == "B" ? " 바트" : " 원" ?>
                                                                </div>
                                                                <span class="total" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                                    객실금액: <span
                                                                            class="price-strike hotel_price_day"
                                                                            data-price="<?= $hotel['is_won_bath'] == "B" ? $upprice_bath : $upprice ?>"><?= number_format($upprice) ?> 원</span>
                                                                    <span class="hotel_price_day_sale"><?= $hotel['is_won_bath'] == "B" ? number_format($downprice_bath) : number_format($downprice) ?></span> <?php echo $hotel['is_won_bath'] == "B" ? " 바트" : " 원" ?>
                                                                </span>
                                                                <?php if ($isSale) { ?>
                                                                    <div class="discount" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                                        <span class="label">특별할인</span>
                                                                        <span class="price_content"><i
                                                                                    class="hotel_price_percent"><?= $percent ?></i>%할인</span>
                                                                    </div>
                                                                <?php } ?>
                                                                <span class="details">객실 <span
                                                                            class="count_room"
                                                                            id="<?= $room_op['rop_idx'] ?>">1</span>개 × <span
                                                                            class="count_day"
                                                                            id="<?= $room_op['rop_idx'] ?>">1</span>박 (세금 포함)</span>
                                                                <p>
                                                                <?php 
                                                                    if($hotel['is_won_bath'] == "W" || $hotel['is_won_bath'] == "B"){
                                                                        if($hotel['is_won_bath'] == "W"){
                                                                ?>
                                                                    <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                                        id="<?= $item['idx'] ?>"
                                                                        data-price="<?= $downprice ?>">
                                                                        <?= number_format($downprice) ?>
                                                                        <span>원</span>
                                                                    </span>
                                                                <?php
                                                                        }else if($hotel['is_won_bath'] == "B"){
                                                                ?>    
                                                                    <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                                          id="<?= $room_op['rop_idx'] ?>"
                                                                          data-price="<?= $downprice_bath ?>">
                                                                        <?= number_format($downprice_bath) ?>
                                                                        <span>바트</span>
                                                                    </span>  
                                                                <?php
                                                                        }
                                                                    }else{
                                                                ?>   
                                                                    <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                                          id="<?= $room_op['rop_idx'] ?>"
                                                                          data-price="<?= $downprice ?>">
                                                                        <?= number_format($downprice) ?>
                                                                        <span>원</span>
                                                                         <span class="price_bath">( <?= number_format($downprice_bath) ?>바트)</span>
                                                                    </span>
                                                                <?php
                                                                    }
                                                                ?>
                                                                </p>
                                                                <?php
                                                                    if($item["price_secret"] == "Y"){
                                                                ?>
                                                                    <div class="price_secret_wrap">
                                                                        <p>비밀특가</p>
                                                                        <i></i>
                                                                        <div class="price_secret_notes">
                                                                            호텔 정책에 의해 가격 공시가 불가능합니다.
                                                                            <br>
                                                                            룸타입을 선택하시고 체크인/아웃, 객실수, 인원 선택 후 가격 확인 요청을 누르시면 나의 1:1 게시판에서 금액 확인이 가능합니다.
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                    }
                                                                ?>
                                                                <?php if ($hotel['product_status'] == 'sale'): ?>
                                                                    <button type="button"
                                                                            class="book-button book_btn_<?= $item['idx'] ?>">
                                                                        예약하기
                                                                    </button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <?php
                                        } else {
                                            $upprice = $item['goods_price1_won'] + $item['goods_price3_won'];
                                            $downprice = $item['goods_price2_won'] + $item['goods_price3_won'];

                                            $upprice_bath = $item['goods_price1'] + $item['goods_price3'];
                                            $downprice_bath = $item['goods_price2'] + $item['goods_price3'];
                                            ?>
                                            <table class="room-table">
                                                <colgroup>
                                                    <col width="10%">
                                                    <col width="*%">
                                                    <!-- <col width="35%">-->
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>수량</th>
                                                    <!-- <th>쿠폰</th>-->
                                                    <th>객실 요금</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="room_op_" data-room="<?= "M_" . $item["idx"] ?>"
                                                    data-opId="<?= $item["idx"] ?>" data-opType="M" data-ho_idx="<?= $item['idx'] ?>">
                                                    <td>
                                                        <div class="room_qty">
                                                            <p>객실 수 </p>
                                                            <div class="room_activity">
                                                                <button type="button" class="btnMinus">
                                                                    -
                                                                </button>
                                                                <input type="text" class="input_room_qty onlynum"
                                                                       value="1"
                                                                       style="text-align: center"
                                                                       id="input_room_qty_<?= $item['idx'] ?>"
                                                                       data-op="<?= $item['idx'] ?>"
                                                                       data-id="<?= $item["idx"] ?>">
                                                                <button type="button" class="btnPlus">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="day_qty">
                                                            <p>숙박일 </p>
                                                            <div class="day_activity">
                                                                <input type="text"
                                                                       class="input_day_qty onlynum input_day_qty_<?= $item['idx'] ?>"
                                                                       value="1"
                                                                       data-op="<?= $item['idx'] ?>"
                                                                       data-price="<?= $hotel["is_won_bath"] == "B" ? $upprice_bath : $upprice ?>"
                                                                       data-sale_price="<?= $hotel["is_won_bath"] == "B" ? $downprice_bath : $downprice ?>"
                                                                       style="text-align: center; width: 100%; border: 1px solid #dbdbdb"
                                                                       readonly
                                                                       data-id="<?= $item["idx"] ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    $isSale = true;
                                                    if ($upprice == $downprice) {
                                                        $isSale = false;
                                                    }
                                                    if ($isSale) {
                                                        $percent = $downprice / $upprice * 100;
                                                        $percent = 100 - $percent;
                                                        $percent = round($percent, 2);
                                                    }
                                                    ?>
                                                    <td>
                                                        <div class="price-details">

                                                            <span class="total" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                                객실금액: <span class="price-strike hotel_price_day"
                                                                            data-price="<?= $hotel['is_won_bath'] == "B" ? $upprice_bath : $upprice ?>"><?= $hotel['is_won_bath'] == "B" ? number_format($upprice_bath) . " 바트" : number_format($upprice) . " 원" ?> </span>
                                                                <span class="hotel_price_day_sale"><?= $hotel['is_won_bath'] == "B" ? number_format($downprice_bath) : number_format($downprice) ?></span> <?php echo $hotel['is_won_bath'] == "B" ? " 바트" : " 원" ?>
                                                            </span>
                                                            <?php if ($isSale) { ?>
                                                                <div class="discount" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>">
                                                                    <span class="label">특별할인</span>
                                                                    <span class="price_content"><i
                                                                                class="hotel_price_percent"><?= $percent ?></i>%할인</span>
                                                                </div>
                                                            <?php } ?>
                                                            <span class="details">객실 <span
                                                                        class="count_room"
                                                                        id="<?= $item['idx'] ?>">1</span>개 × <span
                                                                        class="count_day"
                                                                        id="<?= $item['idx'] ?>">1</span>박 (세금 포함)</span>
                                                            <span class="details use_coupon_name"
                                                                  style="color: #df0011"></span>
                                                            <p>
                                                                <?php 
                                                                    if($hotel['is_won_bath'] == "W" || $hotel['is_won_bath'] == "B"){
                                                                        if($hotel['is_won_bath'] == "W"){
                                                                ?>
                                                                    <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                                        id="<?= $item['idx'] ?>"
                                                                        data-price="<?= $downprice ?>">
                                                                        <?= number_format($downprice) ?>
                                                                        <span>원</span>
                                                                    </span>
                                                                <?php
                                                                        }else if($hotel['is_won_bath'] == "B"){
                                                                ?>    
                                                                    <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                                        id="<?= $item['idx'] ?>"
                                                                        data-price="<?= $downprice_bath ?>">
                                                                        <?= number_format($downprice_bath) ?>
                                                                        <span>바트</span>
                                                                    </span>
                                                                <?php
                                                                        }
                                                                    }else{
                                                                ?>   
                                                                    <span class="price totalPrice" style="<?= $item["price_secret"] == "Y" ? "display: none;" : "" ?>"
                                                                        id="<?= $item['idx'] ?>"
                                                                        data-price="<?= $downprice ?>">
                                                                        <?= number_format($downprice) ?>
                                                                        <span>원</span>
                                                                        <span class="price_bath"> ( <?= number_format($downprice_bath) ?>바트)</span>
                                                                    </span>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </p>
                                                            <?php
                                                                if($item["price_secret"] == "Y"){
                                                            ?>
                                                                <div class="price_secret_wrap">
                                                                    <p>비밀특가</p>
                                                                    <i></i>
                                                                    <div class="price_secret_notes">
                                                                        호텔 정책에 의해 가격 공시가 불가능합니다.
                                                                        <br>
                                                                        룸타입을 선택하시고 체크인/아웃, 객실수, 인원 선택 후 가격 확인 요청을 누르시면 나의 1:1 게시판에서 금액 확인이 가능합니다.
                                                                    </div>
                                                                </div>
                                                            <?php
                                                                }
                                                            ?>
                                                            <?php if ($hotel['product_status'] == 'sale'): ?>
                                                                <button type="button"
                                                                        class="book-button book_btn_<?= $item['idx'] ?></button>">
                                                                    예약하기
                                                                </button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <?php if ($isValid) : ?>
                                        <div class="d-flex" style="margin-top: 30px; gap: 10px;">
                                            <button class="btnReadMore">자세히 보기</button>
                                            <button class="btnReadLess">덜 숨기기</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    <?php endif; ?>
                <?php endforeach; ?>

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
                                        if($item['is_won_bath'] == "W" || $item['is_won_bath'] == "B"){
                                            if($item['is_won_bath'] == "W"){
                                    ?>
                                        <?= number_format($item['product_price_won']) ?> <span> 원</span> 
                                    <?php
                                            }else if($item['is_won_bath'] == "B"){
                                    ?>  
                                        <?= number_format($item['product_price']) ?> <span> 바트</span>       
                                    <?php
                                            }
                                        }else{
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
                            success: function (data, textStatus) {
                                message = data.message;
                                alert(message);
                                location.reload();
                            },
                            error: function (request, status, error) {
                                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                            }
                        });
                    }
                }
            </script>

            <script>
                $('.btnReadMore').click(function () {
                    let room_option_ = $(this).parent().prev();
                    room_option_.css('height', 'auto');
                    $(this).css('display', 'none');
                    $(this).parent().find('.btnReadLess').css('display', 'inline');
                });

                $('.btnReadLess').click(function () {
                    let room_option_ = $(this).parent().prev();
                    room_option_.css('height', '620px');
                    $(this).css('display', 'none');
                    $(this).parent().find('.btnReadMore').css('display', 'inline');
                });
            </script>
        </div>
        <input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
        <input type="hidden" name="coupon_name" id="coupon_name">
        <input type="hidden" name="coupon_type" id="coupon_type">
        <input type="hidden" name="total_last_price" id="total_last_price">
        <input type="hidden" name="use_coupon_room" id="use_coupon_room">
        <input type="hidden" name="use_op_type" id="use_op_type">
        <input type="hidden" name="use_coupon_idx" id="use_coupon_idx">
        <input type="hidden" name="number_room" id="number_room">
        <input type="hidden" name="number_day" id="number_day">
        <input type="hidden" name="product_idx" id="product_idx" value="<?= $hotel['product_idx'] ?>">

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
            $openPopupBtns.on('click', function () {
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

            $(".item-price-popup").click(function () {
                $(this).addClass("active").siblings().removeClass("active");
                popup_coupon();
            });

            $(".btn_accept_popup").click(function () {
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

                    rooms.each(function () {
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

            $('.list-icon img[alt="heart_icon"], .list-icon img[alt="heart_icon_mo"]').click(function () {
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

            $(".book-button").click(function () {
                <?php
                if (empty(session()->get("member")["id"])) {
                ?>
                // alert("주문하시려면 로그인해주세요!");
                showOrHideLoginItem();
                return false;
                <?php
                }
                ?>

                let date_check_in = $("#input_day_start_").val();
                let date_check_out = $("#input_day_end_").val();

                if (!date_check_in && !date_check_out) {
                    alert("체크인 날짜와 체크아웃 날짜를 선택해주세요!");
                    return false;
                }

                let coupon_discount = $("#coupon_discount").val();
                let coupon_type = $("#coupon_type").val();
                let use_coupon_room = $("#use_coupon_room").val();
                let used_op_type = $("#use_op_type").val();
                let use_coupon_idx = $("#use_coupon_idx").val();
                let room_op_idx = $(this).closest(".room_op_").data("opid");
                let ho_idx = $(this).closest(".room_op_").data("ho_idx");
                let optype = $(this).closest(".room_op_").data("optype");
                let number_room = $(this).closest(".room_op_").find(".room_qty .input_room_qty").val();
                let number_day = $(this).closest(".room_op_").find(".day_qty .input_day_qty").val();
                let last_price = $(this).closest(".room_op_").find(".totalPrice").text().trim().replace(/,/g, '');
                let product_idx = $("#product_idx").val();
                let inital_price = $(this).closest(".room_op_").find(".totalPrice").attr("data-price");

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

                let start_day = $('#input_day_start_').val();
                let end_day = $('#input_day_end_').val();

                let cart = {
                    product_idx: product_idx,
                    room_op_idx: room_op_idx,
                    ho_idx: ho_idx,
                    optype: optype,
                    use_coupon_idx: use_coupon_idx,
                    used_coupon_money: used_coupon_money,
                    use_coupon_room: use_coupon_room,
                    use_op_type: use_op_type,
                    room_op_price_sale: room_op_price_sale,
                    inital_price: inital_price,
                    coupon_discount: coupon_discount,
                    coupon_type: coupon_type,
                    last_price: last_price,
                    number_room: number_room,
                    number_day: number_day,
                    start_day: start_day,
                    end_day: end_day,
                };

                setCookie("cart-hotel", JSON.stringify(cart), 1);
                window.location.href = '/product-hotel/reservation-form';
            });

            // Close the popup when the "Close" button or the "x" is clicked
            $closePopupBtn.on('click', function () {
                $popup.css('display', 'none');
            });

            $closePopupBtn2.on('click', function () {
                $popup.css('display', 'none');
            });

            // Close popup if clicked outside of content area
            $(window).on('click', function (event) {
                if ($(event.target).is($popup)) {
                    $popup.css('display', 'none');
                }
            });

            $('.nav-item').on('click', function () {
                $('.nav-item').removeClass('active');
                $(this).addClass('active');
            });

            function scrollToEl(elID) {
                $('html, body').animate({
                    scrollTop: $('#' + elID).offset().top - 250
                }, 'slow');
            }

            $(".onlynum").keyup(function () {
                $(this).val($(this).val().replace(/[^0-9]/g, ""));
            });

            $('.btnMinus').click(function () {
                let inp = $(this).next();

                let qty = inp.val();
                qty = parseInt(qty);
                if (qty > 1) {
                    qty--;
                }
                inp.val(qty);

                changeDataOptionPriceBk(inp);
            });

            $('.btnPlus').click(function () {
                let inp = $(this).prev();
                let qty = inp.val();
                qty = parseInt(qty);
                qty++;
                inp.val(qty);
                changeDataOptionPriceBk(inp);
            });

            function changeDataOptionPriceBk(input) {
                let item = $(input).closest('tr.room_op_');

                let room_op_idx = item.attr('data-room');
                let qty_room = item.find('input.input_room_qty').val();
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

                let total_price = room_op_price_sale + qty_room * parseInt(main_price);

                let total_init_price = room_op_price + qty_room * parseInt(initPrice);

                let percent_price = 100 - (total_price / total_init_price) * 100;

                item.find(".hotel_price_percent").text(percent_price.toFixed(2));

                if (use_coupon_idx == room_op_idx && coupon_type && coupon_discount) {
                    if (coupon_type == "P") {
                        total_price = Math.round(total_price - total_price * Number(coupon_discount) / 100);
                    } else {
                        total_price = total_price - coupon_discount;
                    }
                }
                let formattedNumber = total_price.toLocaleString('en-US');
                item.find('span.totalPrice').text(formattedNumber);

                $("#total_last_price").val(total_price);
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
            link: "<?= '/product-hotel/hotel-detail/' . $hotel['product_idx']?>",
            image: "<?= '/data/product/' . $hotel['ufile1'] ?>",
            ...(<?= isset($hotel['ufile2']) && $hotel['ufile2'] ? 'true' : 'false' ?> && { image2: "<?= '/data/product/' . $hotel['ufile2'] ?>" })
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
<?php $this->endSection(); ?>