<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <link rel="stylesheet" type="text/css" href="/lib/daterangepicker/daterangepicker.css"/>
    <script type="text/javascript" src="/lib/momentjs/moment.min.js"></script>
    <script type="text/javascript" src="/lib/daterangepicker/daterangepicker.min.js"></script>
    <style>
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

        .main_page_01 .main_visual_content_ .form_element_ {
            justify-content: center;
        }

        .hotel_day_popup_ {
            top: 185px !important;
        }
    </style>
    <div class="main_page_01 page_share_ page_product_list_ content-sub-hotel-detail">
        <div class="body_inner">
            <section class="sub_top_visual">
                <div class="main_visual_content_">
                    <div class="form_search">
                        <div class="form_element_">
                            <!--div class="form_input_">
                                <label for="input_keyword_">여행지</label>
                                <input type="text" id="input_keyword_" class="input_keyword_" placeholder="호텔 지역을 입력해주세요!">
                            </div-->
                            <div class="form_input_multi_">
                                <div class="form_gr_">
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
                            <button type="button" onclick="search_list();" class="btn_search_">
                                확인
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

                        <!-- popup -->
                        <?php $is_check = 123 ?>
                        <?php echo view("/product/inc/hotel/init_day_popup_.php", ["is_check" => $is_check]); ?>
                    </div>
                </div>
            </section>
            <script>
                const prices = {
                    "2024-11-25": "11만",
                    "2024-11-26": "15만",
                    "2024-11-27": "20만",
                    "2024-11-28": "18만",
                    "2024-11-29": "12만"
                };

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
            <div style="margin-top: 200px" class="section1">
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
                    <span class="text-gray"> <?= $hotel['addrs'] ?> </span>
                </div>
                <div class="rating-container">
                    <img src="/uploads/icons/star_icon_mo.png" alt="star_icon_mo.png">
                    <span><strong> <?= $hotel['review_average'] ?></strong></span>
                    <span class="page_">생생리뷰 <strong style="color: #000;">(0)</strong></span>
                    <span class="page_"><?= $fresult9['code_name'] ?></span>
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
                        <p class="nav-item" onclick="scrollToEl('section6')" style="cursor: pointer">생생리뷰(159개)</p>
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
                    <?php foreach ($fresult8 as $row) : ?>
                        <div class="">
                            <img src="/data/code/<?= $row['ufile1'] ?>" alt="hotel_thumbnai_1">
                            <span><?php if ($row['type']) { ?> <?= $row['type'] ?>: <?php } ?> <?= $row['code_name'] ?>(<?= $row['distance'] ?>)</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="section3" id="section3">
                <h3 class="title-sec3">
                    객실을 선택하세요
                </h3>
                <div class="list-tag-sec3">
                    <div class="tag-item-sec3<?= $s_category_room === '' ? '--main' : '' ?>"
                         onclick="go_category_room('')"
                         style="cursor: pointer">
                        모두
                    </div>
                    <?php
                    foreach (
                    $room_categories

                    as $row
                    ) : ?>
                <?php if (isset($s_category_room) && $s_category_room === $row['code_no']) : ?>
                    <div class="tag-item-sec3--main">
                        <?php else : ?>
                        <div class="tag-item-sec3" onclick="go_category_room(<?= $row['code_no'] ?>)"
                             style="cursor: pointer">
                            <?php endif; ?>

                            <?= $row['code_name'] ?> (<?= $row['count'] ?>)
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <script>
                        function go_category_room(code) {
                            let currentUrl = new URL(window.location.href);
                            currentUrl.searchParams.set('s_category_room', code);
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
                        //                    if ($count_facil > 12) {
                        //                        $isValid = true;
                        //                        $room_op = 'room_option_long';
                        //                        $room_option_ = 'room_option_';
                        //                    }
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
                                                     onerror="this.src='/images/share/noimg.png"
                                                     alt="<?= $room['roomName'] ?>">
                                                <div class=""
                                                     style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%">
                                                    <img class="imageDetailOption_"
                                                         src="<?= isset($room['ufile2']) && $room['ufile2'] ? '/uploads/rooms/' . $room['ufile2'] : '/images/share/noimg.png' ?>"
                                                         onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                         onerror="this.src='/images/share/noimg.png"
                                                         alt="<?= $room['roomName'] ?>">

                                                    <img class="imageDetailOption_"
                                                         src="<?= isset($room['ufile3']) && $room['ufile3'] ? '/uploads/rooms/' . $room['ufile3'] : '/images/share/noimg.png' ?>"
                                                         onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                         onerror="this.src='/images/share/noimg.png"
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

                                    <table class="room-table only_web">
                                        <colgroup>
                                            <col width="35%">
                                            <col width="10%">
                                            <col width="10%">
                                            <col width="45%">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th>옵션 상세</th>
                                            <th>수량</th>
                                            <th>쿠폰</th>
                                            <th>객실 요금</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($room_options as $room_op) : ?>
                                            <tr class="room_op_" data-room="<?= $room_op["rop_idx"] ?>">
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
                                                            <button class="btnMinus">
                                                                -
                                                            </button>
                                                            <input type="text" class="input_room_qty onlynum" value="1"
                                                                   style="text-align: center"
                                                                   data-id="<?= $room_op['rop_idx'] ?>">
                                                            <button class="btnPlus">
                                                                +
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="day_qty">
                                                        <p>숙박일 </p>
                                                        <div class="day_activity">
                                                            <button class="btnMinus">
                                                                -
                                                            </button>
                                                            <input type="text" class="input_day_qty onlynum" value="1"
                                                                   style="text-align: center"
                                                                   data-id="<?= $room_op['rop_idx'] ?>">
                                                            <button class="btnPlus">
                                                                +
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="occupancy">
                                                        <span class="occupancy_button openPopupBtn">쿠폰적용</span>
                                                    </div>
                                                </td>
                                                <?php
                                                $isSale = true;
                                                if ($room_op['r_sale_price'] == $room_op['r_price']) {
                                                    $isSale = false;
                                                }
                                                if ($isSale) {
                                                    $percent = $room_op['r_sale_price'] / $room_op['r_price'] * 100;
                                                    $percent = 100 - $percent;
                                                    $percent = round($percent, 2);
                                                }
                                                ?>
                                                <td>
                                                    <div class="price-details">
                                                        <?php if ($isSale) { ?>
                                                            <div class="discount">
                                                                <span class="label">특별할인</span>
                                                                <span class="price_content"><?= $percent ?>%할인</span>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="price-strike-container">
                                                            <span class="price-strike"><?= number_format($room_op['r_price']) ?>원</span>
                                                            <span class="price"><?= number_format($room_op['r_sale_price']) ?></span>원
                                                        </div>
                                                        <span class="total">총금액: <?= number_format($room_op['r_sale_price'] + $item['goods_price1']) ?>원</span>
                                                        <span class="details">객실 <span
                                                                    class="count_room"
                                                                    id="<?= $room_op['rop_idx'] ?>">1</span>개 × <span
                                                                    class="count_day"
                                                                    id="<?= $room_op['rop_idx'] ?>">1</span>박 (세금 포함)</span>
                                                        <span class="details use_coupon_name"
                                                              style="color: #df0011"></span>
                                                        <p>
                                                                    <span class="price totalPrice"
                                                                          id="<?= $room_op['rop_idx'] ?>"
                                                                          data-price="<?= $room_op['r_sale_price'] + $item['goods_price1'] ?>">
                                                                        <?= number_format($room_op['r_sale_price'] + $item['goods_price1']) ?>
                                                                    </span> 원
                                                        </p>
                                                        <button type="button" class="book-button">
                                                            예약하기
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="only_mo">
                                        <div class="room-table table-price-info-mobile">
                                            <div class="room-table-item border-dashed">
                                                <div class="info-price-left">
                                                    <span class="label1 label-cus1">객실옵션 상세:</span>
                                                    <span class="label1"><strong>킹 침대 1개</strong></span>
                                                    <ul>
                                                        <li class="highlight">조식 2인 포함</li>
                                                        <li>환불 불가</li>

                                                    </ul>
                                                </div>
                                                <div class="info-price-right">
                                                    <span class="label-cus1">수량</span>
                                                    <div class="selector-container">
                                                        <div class="label">숙박일:</div>
                                                        <div class="number-selector">
                                                            <input type="text" id="numberDisplay" class="number-display"
                                                                   value="1" readonly>
                                                            <div class="buttons">
                                                                <div class="buttons-con-top" onclick="increment()">
                                                                    <img src="/uploads/icons/up-arrow_ht.png"
                                                                         alt="up_down_icon" class="button up"></img>
                                                                </div>
                                                                <div class="buttons-con-bottom" onclick="decrement()">
                                                                    <img src="/uploads/icons/down-arrow_ht.png"
                                                                         class="button down"></img>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="selector-container">
                                                        <div class="label">객실 수:</div>
                                                        <div class="number-selector">
                                                            <input type="text" id="numberDisplay" class="number-display"
                                                                   value="1" readonly>
                                                            <div class="buttons">
                                                                <div class="buttons-con-top">
                                                                    <img src="/uploads/icons/up-arrow_ht.png"
                                                                         alt="up_down_icon" class="button up"
                                                                         onclick="increment()"></img>
                                                                </div>
                                                                <div class="buttons-con-bottom">
                                                                    <img src="/uploads/icons/down-arrow_ht.png"
                                                                         class="button down"
                                                                         onclick="decrement()"></img>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="room-table-item-parent m-pt-32">
                                                <div class="room-table-item">
                                                    <div class="info-price-left">
                                                        <span class="label-cus1">쿠폰</span>
                                                        <button class="book-button openPopupBtn">쿠폰적용</button>
                                                    </div>
                                                    <div class="info-price-right">
                                                        <div class="price-details">
                                                            <span class="label1 label-cus1">투숙객 정원:</span>
                                                            <div class="discount">
                                                                <span class="label">특별할인</span>
                                                                <span class="price_content">30%할인</span>
                                                            </div>
                                                            <div class="price-strike-container">
                                                                <span class="price-strike">202,043원</span>
                                                                <span class="price">160,430</span>원
                                                            </div>
                                                            <div class="flex-total">
                                                                <span class="total">총금액: 5,091,454원</span>
                                                                <span class="details">객실 1개 × 36박 (세금 포함)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn-book-button">
                                                    예약하기
                                                </button>
                                            </div>
                                        </div>
                                        <div class="room-table table-price-info-mobile">
                                            <div class="room-table-item border-dashed">
                                                <div class="info-price-left">
                                                    <span class="label1 label-cus1">객실옵션 상세:</span>
                                                    <span class="label1"><strong>킹 침대 1개</strong></span>
                                                    <ul>
                                                        <li class="highlight">조식 2인 포함</li>
                                                        <li>환불 불가</li>

                                                    </ul>
                                                </div>
                                                <div class="info-price-right">
                                                    <span class="label-cus1">수량</span>
                                                    <div class="selector-container">
                                                        <div class="label">숙박일:</div>
                                                        <div class="number-selector">
                                                            <input type="text" id="numberDisplay" class="number-display"
                                                                   value="1" readonly>
                                                            <div class="buttons">
                                                                <div class="buttons-con-top">
                                                                    <img src="/uploads/icons/up-arrow_ht.png"
                                                                         alt="up_down_icon" class="button up"
                                                                         onclick="increment()"></img>
                                                                </div>
                                                                <div class="buttons-con-bottom">
                                                                    <img src="/uploads/icons/down-arrow_ht.png"
                                                                         class="button down"
                                                                         onclick="decrement()"></img>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="selector-container">
                                                        <div class="label">객실 수:</div>
                                                        <div class="number-selector">
                                                            <input type="text" id="numberDisplay" class="number-display"
                                                                   value="1" readonly>
                                                            <div class="buttons">
                                                                <div class="buttons-con-top">
                                                                    <img src="/uploads/icons/up-arrow_ht.png"
                                                                         alt="up_down_icon" class="button up"
                                                                         onclick="increment()"></img>
                                                                </div>
                                                                <div class="buttons-con-bottom">
                                                                    <img src="/uploads/icons/down-arrow_ht.png"
                                                                         class="button down"
                                                                         onclick="decrement()"></img>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="room-table-item-parent m-pt-32">
                                                <div class="room-table-item">
                                                    <div class="info-price-left">
                                                        <span class="label-cus1">쿠폰</span>
                                                        <button class="book-button openPopupBtn">쿠폰적용</button>
                                                    </div>
                                                    <div class="info-price-right">
                                                        <div class="price-details">
                                                            <span class="label1 label-cus1">투숙객 정원:</span>
                                                            <div class="discount">
                                                                <span class="label">특별할인</span>
                                                                <span class="price_content">30%할인</span>
                                                            </div>
                                                            <div class="price-strike-container">
                                                                <span class="price-strike">202,043원</span>
                                                                <span class="price">160,430</span>원
                                                            </div>
                                                            <div class="flex-total">
                                                                <span class="total">총금액: 5,091,454원</span>
                                                                <span class="details">객실 1개 × 36박 (세금 포함)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn-book-button">
                                                    예약하기
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
                                                             onerror="this.src='/images/share/noimg.png"
                                                             style="width: 285px; border: 1px solid #dbdbdb; height: 190px"
                                                             onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                             alt="<?= $room['roomName'] ?>">
                                                        <div class=""
                                                             style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%">

                                                            <img class="imageDetailOption_"
                                                                 src="<?= isset($room['ufile2']) && $room['ufile2'] ? '/uploads/rooms/' . $room['ufile2'] : '/images/share/noimg.png' ?>"
                                                                 onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                                 onerror="this.src='/images/share/noimg.png"
                                                                 alt="<?= $room['roomName'] ?>">

                                                            <img class="imageDetailOption_"
                                                                 src="<?= isset($room['ufile3']) && $room['ufile3'] ? '/uploads/rooms/' . $room['ufile3'] : '/images/share/noimg.png' ?>"
                                                                 onclick="fn_pops('<?= $room['g_idx'] ?>', '<?= $room['roomName'] ?>')"
                                                                 onerror="this.src='/images/share/noimg.png"
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

                                            <table class="room-table only_web">
                                                <colgroup>
                                                    <col width="35%">
                                                    <col width="20%">
                                                    <col width="10%">
                                                    <col width="35%">
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>옵션 상세</th>
                                                    <th>수량</th>
                                                    <th>쿠폰</th>
                                                    <th>객실 요금</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($room_options as $room_op) : ?>
                                                    <tr class="room_op_" data-room="<?= $room_op["rop_idx"] ?>">
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
                                                                    <button class="btnMinus">
                                                                        -
                                                                    </button>
                                                                    <input type="text" class="input_room_qty onlynum"
                                                                           value="1"
                                                                           style="text-align: center"
                                                                           data-id="<?= $room_op['rop_idx'] ?>">
                                                                    <button class="btnPlus">
                                                                        +
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="day_qty">
                                                                <p>숙박일 </p>
                                                                <div class="day_activity">
                                                                    <button class="btnMinus">
                                                                        -
                                                                    </button>
                                                                    <input type="text" class="input_day_qty onlynum"
                                                                           value="1"
                                                                           style="text-align: center"
                                                                           data-id="<?= $room_op['rop_idx'] ?>">
                                                                    <button class="btnPlus">
                                                                        +
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="occupancy">
                                                                <span class="occupancy_button openPopupBtn">쿠폰적용</span>
                                                            </div>
                                                        </td>
                                                        <?php
                                                        $isSale = true;
                                                        if ($room_op['r_sale_price'] == $room_op['r_price']) {
                                                            $isSale = false;
                                                        }
                                                        if ($isSale) {
                                                            $percent = $room_op['r_sale_price'] / $room_op['r_price'] * 100;
                                                            $percent = 100 - $percent;
                                                            $percent = round($percent, 2);
                                                        }
                                                        ?>
                                                        <td>
                                                            <div class="price-details">
                                                                <?php if ($isSale) { ?>
                                                                    <div class="discount">
                                                                        <span class="label">특별할인</span>
                                                                        <span class="price_content"><?= $percent ?>%할인</span>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="price-strike-container">
                                                                    <span class="price-strike"><?= number_format($room_op['r_price']) ?>원</span>
                                                                    <span class="price"><?= number_format($room_op['r_sale_price']) ?></span>원
                                                                </div>
                                                                <span class="total">총금액: <?= number_format($room_op['r_sale_price'] + $item['goods_price1']) ?>원</span>
                                                                <span class="details">객실 <span
                                                                            class="count_room"
                                                                            id="<?= $room_op['rop_idx'] ?>">1</span>개 × <span
                                                                            class="count_day"
                                                                            id="<?= $room_op['rop_idx'] ?>">1</span>박 (세금 포함)</span>
                                                                <!--                                                        <span class="details" style="color: #df0011">쿠폰 적용 10%할인</span>-->
                                                                <p>
                                                                            <span class="price totalPrice"
                                                                                  id="<?= $room_op['rop_idx'] ?>"
                                                                                  data-price="<?= $room_op['r_sale_price'] + $item['goods_price1'] ?>">
                                                                                <?= number_format($room_op['r_sale_price'] + $item['goods_price1']) ?>
                                                                            </span> 원
                                                                </p>
                                                                <button type="button" class="book-button">예약하기</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <div class="only_mo">
                                                <div class="room-table table-price-info-mobile">
                                                    <div class="info-price-left">
                                                        <span class="label1">객실옵션 상세:</span>
                                                        <span class="label1"><strong>킹 침대 1개</strong></span>
                                                        <ul>
                                                            <li class="highlight">조식 2인 포함</li>
                                                            <li>환불 불가</li>
                                                            <div class="info-price-left-sub">
                                                                <span class="label1">객실 요금:</span>
                                                                <div class="occupancy">
                                                                    <img src="/uploads/icons/double_person_icon.png"
                                                                         alt="double_person_icon">
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                    <div class="info-price-right">
                                                        <div class="price-details">
                                                            <span class="label1">투숙객 정원:</span>
                                                            <div class="discount">
                                                                <span class="label">특별할인</span>
                                                                <span class="price_content">30%할인</span>
                                                            </div>
                                                            <div class="price-strike-container">
                                                                <span class="price-strike">202,043원</span>
                                                                <span class="price">160,430</span>원
                                                            </div>
                                                            <div class="flex-total">
                                                                <span class="total">총금액: 5,091,454원</span>
                                                                <span class="details">객실 1개 × 36박 (세금 포함)</span>
                                                            </div>
                                                            <button class="book-button openPopupBtn">예약하기</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="room-table table-price-info-mobile">
                                                    <div class="info-price-left">
                                                        <span class="label1">객실옵션 상세:</span>
                                                        <span class="label1"><strong>킹 침대 1개</strong></span>
                                                        <ul>
                                                            <li class="">조식 20,895원 (선택 사항)</li>
                                                            <li>환불 불가</li>
                                                            <div class="info-price-left-sub">
                                                                <span class="label1">객실 요금:</span>
                                                                <div class="occupancy">
                                                                    <img src="/uploads/icons/double_person_icon.png"
                                                                         alt="double_person_icon">
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                    <div class="info-price-right">
                                                        <div class="price-details">
                                                            <span class="label1">투숙객 정원:</span>
                                                            <div class="discount">
                                                                <span class="label">특별할인</span>
                                                                <span class="price_content">40%할인</span>
                                                            </div>
                                                            <div class="price-strike-container">
                                                                <span class="price-strike">202,043원</span>
                                                                <span class="price">100,430</span>원
                                                            </div>
                                                            <div class="flex-total">
                                                                <span class="total">총금액: 5,091,454원</span>
                                                                <span class="details">객실 1개 × 36박 (세금 포함)</span>
                                                            </div>
                                                            <button class="book-button openPopupBtn">예약하기</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                            <div class="tag-container-item-sec4">
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
                $product_more = $hotel['product_more'];
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
                <div class="section6" id="section6">
                    <h2 class="title-sec6"><span>생생리뷰</span>(516)</h2>
                    <div class="rating-content">
                        <div class="rating-left">
                            <img src="/uploads/icons/start_big_icon.png" alt="start_big_icon">
                            <strong><?= $hotel['review_average'] ?>/5</strong>
                        </div>
                        <span class="rating-right text-gray"><?= $reviewCount ?>개 고객기준</span>
                    </div>
                    <div class="list-label-tag">
                        <?php foreach ($reviewCategories as $reviewCategory) : ?>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/<?= $reviewCategory['ufile1'] ?>"
                                     alt="<?= $reviewCategory['code_name'] ?>">
                                <div class="label-tag-item-text">
                                    <strong><?= $reviewCategory['code_name'] ?></strong>
                                    <p><strong><?= $reviewCategory['average'] ?></strong> 최고좋음</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <h2 class="sub-title-sec6">BEST 생생리뷰</h2>
                    <div class="card-list-flex">
                        <div class="card-list-recommemded">
                            <?php $i = 0;
                            function maskString($str)
                            {
                                $start = substr($str, 0, 3);
                                $masked = str_repeat('*', 6);
                                return $start . $masked;
                            }

                            foreach ($reviews as $review) : ?>
                                <?php if ($i < 3) : ?>
                                    <div class="recommemded-item" data-id="<?= $review['idx'] ?>">
                                        <div class="container-head" style="cursor: pointer;" onclick="goDetail('<?= $review['idx'] ?>');">
                                            <img src="<?= isset($review['avt']) && $review['avt'] ? '/data/user/' . $review['avt'] : '/images/profile/avatar.png' ?>"
                                                 alt="avatar_user_1">
                                            <div class="name">
                                                <span><?= maskString(sqlSecretConver($review['user_name'] ?? '', 'decode')); ?></span>
                                                <p><?= $formattedDate = (new DateTime($review['r_date']))->format('Y.m.d'); ?></p>
                                            </div>
                                        </div>
                                        <h2 style="cursor: pointer;" onclick="goDetail('<?= $review['idx'] ?>');"><?= $review['title']; ?></h2>
                                        <div class="custom_paragraph">
                                            <?= viewSQ($review['contents']); ?>
                                        </div>
                                        <button type="button" onclick="goList();">
                                            더보기
                                        </button>
                                    </div>
                                <?php endif;
                                $i++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <script>
                        function goList() {
                            window.location.href = '/review/review_list';
                        }

                        function goDetail(idx) {
                            window.location.href = '/review/review_detail?idx=' + idx;
                        }
                    </script>
                </div>
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
                                        <?= number_format($item['product_price']) ?> <span>원~</span> <span
                                                class="prd_price_thai">6,000 <span>바트~</span></span>
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
            <input type="hidden" name="use_coupon_idx" id="use_coupon_idx">
            <input type="hidden" name="number_room" id="number_room">
            <input type="hidden" name="number_day" id="number_day">
            <input type="hidden" name="product_idx" id="product_idx" value="<?= $hotel['product_idx'] ?>">

            <div id="popup" class="popup" data-roop="" data-price="">
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
                                    $discount = number_format($coupon["coupon_price"]) . "원";
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
                                    <span class="text-gray total_price" data-price="">160,430원</span>
                                </div>
                                <div class="item">
                                    <span class="text-gray">할인금액</span>
                                    <span class="text-gray discount" data-price="">16,040원</span>
                                </div>
                            </div>
                            <div class="des-below">
                                <div class="price-below">
                                    <span>최종결제금액</span>
                                    <p class="price-popup"><span class="last_price" data-price="">144,000</span><span
                                                class="text-gray">원</span></p>
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
                    let room_qty = $(this).closest("tr.room_op_").find(".room_qty .input_room_qty").val();
                    let day_qty = $(this).closest("tr.room_op_").find(".day_qty .input_day_qty").val();
                    let total_price = Number($(this).closest("tr.room_op_").find(".totalPrice").attr("data-price"));
                    let price = $(this).closest("tr.room_op_").find(".totalPrice").attr("data-price");

                    total_price = total_price * parseInt(room_qty) * parseInt(day_qty);

                    $("#popup").find(".total_price").text(total_price.toLocaleString('ko-KR') + "원");
                    $("#popup").find(".total_price").attr("data-price", total_price);
                    $("#popup").attr("data-price", price);
                    $("#popup").attr("data-roop", room_op_idx);

                    popup_coupon();

                    $popup.css('display', 'flex');
                });

                $(".item-price-popup").click(function () {
                    $(this).addClass("active").siblings().removeClass("active");
                    popup_coupon();
                });

                $(".btn_accept_popup").click(function () {
                    let room_op_idx = $("#popup").attr("data-roop");

                    let coupon_type = $("#popup").find(".item-price-popup.active").attr("data-type");
                    let coupon_discount = Number($("#popup").find(".item-price-popup.active").attr("data-discount"));
                    let coupon_idx = Number($("#popup").find(".item-price-popup.active").attr("data-idx"));
                    let coupon_name = $("#popup").find(".item-price-popup.active .item_coupon_name").text().trim();
                    $("#coupon_type").val(coupon_type);
                    $("#coupon_discount").val(coupon_discount);
                    $("#use_coupon_idx").val(coupon_idx);
                    $("#coupon_name").val(coupon_name);
                    $("#popup").hide();

                    if (room_op_idx) {
                        let price = Number($('.room_op_[data-room="' + room_op_idx + '"]').find(".totalPrice").attr("data-price"));
                        let room_qty = $('.room_op_[data-room="' + room_op_idx + '"]').find(".room_qty .input_room_qty").val();
                        let day_qty = $('.room_op_[data-room="' + room_op_idx + '"]').find(".day_qty .input_day_qty").val();

                        let total_price = price * parseInt(room_qty) * parseInt(day_qty);

                        if (coupon_type && coupon_discount) {
                            if (coupon_type == "P") {
                                total_price = Math.round(total_price - total_price * Number(coupon_discount) / 100);
                            } else {
                                total_price = total_price - coupon_discount;
                            }
                        }

                        $('.room_op_[data-room="' + room_op_idx + '"]').find(".totalPrice").text(total_price.toLocaleString('ko-KR'));
                        $("#total_last_price").val(total_price);
                        $("#use_coupon_room").val(room_op_idx);
                        if (coupon_idx) {
                            $('.room_op_[data-room="' + room_op_idx + '"]').find(".use_coupon_name").text("쿠폰 적용 " + coupon_name);
                        }
                        let rooms = $('.room_op_[data-room!="' + room_op_idx + '"]');

                        rooms.each(function () {
                            let price = Number($(this).find(".totalPrice").attr("data-price"));
                            let room_qty = $(this).find(".room_qty .input_room_qty").val();
                            let day_qty = $(this).find(".day_qty .input_day_qty").val();
                            let total_price = price * parseInt(room_qty) * parseInt(day_qty);
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

                    $("#popup").find(".discount").text(price_discount.toLocaleString('ko-KR') + "원");
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
                    alert("주문하시려면 로그인해주세요");
                    return false;
                    <?php
                    }
                    ?>

                    let coupon_discount = $("#coupon_discount").val();
                    let coupon_type = $("#coupon_type").val();
                    let use_coupon_room = $("#use_coupon_room").val();
                    let use_coupon_idx = $("#use_coupon_idx").val();
                    let room_op_idx = $(this).closest(".room_op_").data("room");
                    let number_room = $(this).closest(".room_op_").find(".room_qty .input_room_qty").val();
                    let number_day = $(this).closest(".room_op_").find(".day_qty .input_day_qty").val();
                    let last_price = $(this).closest(".room_op_").find(".totalPrice").text().trim().replace(/,/g, '');
                    let product_idx = $("#product_idx").val();
                    let inital_price = $(this).closest(".room_op_").find(".totalPrice").attr("data-price");

                    let used_coupon_money = 0;
                    let total_price = parseInt(number_room) * parseInt(number_day) * parseInt(inital_price);
                    if (coupon_type && coupon_discount) {
                        if (coupon_type == "P") {
                            used_coupon_money = Math.round(total_price * Number(coupon_discount) / 100);
                        } else {
                            used_coupon_money = coupon_discount;
                        }
                    }

                    let cart = {
                        product_idx: product_idx,
                        room_op_idx: room_op_idx,
                        use_coupon_idx: use_coupon_idx,
                        used_coupon_money: used_coupon_money,
                        use_coupon_room: use_coupon_room,
                        inital_price: inital_price,
                        coupon_discount: coupon_discount,
                        coupon_type: coupon_type,
                        last_price: last_price,
                        number_room: number_room,
                        number_day: number_day
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

                    changeDataOptionPrice(inp);
                });

                $('.btnPlus').click(function () {
                    let inp = $(this).prev();
                    let qty = inp.val();
                    qty = parseInt(qty);
                    qty++;
                    inp.val(qty);
                    changeDataOptionPrice(inp);
                });


                function changeDataOptionPrice(input) {
                    let item = $(input).closest('tr.room_op_');

                    let room_op_idx = item.attr('data-room');
                    let qty_room = item.find('input.input_room_qty').val();
                    let qty_day = item.find('input.input_day_qty').val();
                    let coupon_discount = Number($("#coupon_discount").val());
                    let coupon_type = $("#coupon_type").val();
                    let use_coupon_room = Number($("#use_coupon_room").val());

                    item.find('span.count_room').text(qty_room);
                    item.find('span.count_day').text(qty_day);
                    let main_price = item.find('span.totalPrice').attr('data-price');

                    let total_price = qty_room * qty_day * parseInt(main_price)
                    if (use_coupon_room == room_op_idx && coupon_type && coupon_discount) {
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


                const display = $("#numberDisplay");

                function increment() {
                    let currentValue = parseInt(display.val());
                    display.val(currentValue + 1);
                }

                function decrement() {
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
<?php $this->endSection(); ?>