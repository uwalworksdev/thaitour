<div class="flex">
    <div class="view_air_info inner" id="view_air_info">
        <div class="calendar">
            <div class="year">
                <img src="/img/sub/icon_prev_1.png" alt="" srcset="" id="prev_icon" class="only_web">
                <img src="/img/sub/icon_prev_1_mo.png" alt="" srcset="" id="prev_icon_mo" class="only_mo">
                <span><span id="year"></span>년 <span id="month"></span>월</span>
                <img src="/img/sub/icon_next_1.png" alt="" srcset="" id="next_icon" class="only_web">
                <img src="/img/sub/icon_next_1_mo.png" alt="" srcset="" id="next_icon_mo" class="only_mo">
            </div>
            <div class="dates">
                <div class="swiper-button-next2 swiper-button"></div>
                <div class="swiper-button-prev2 swiper-button"></div>
                <div class="calendar-swiper-container swiper-container">
                    <div class="calendar-swiper-wrapper swiper-wrapper"></div>
                </div>
            </div>
        </div>

        <script>

            const daysOfWeek = ['일', '월', '화', '수', '목', '금', '토'];
            function getMonthDatesWithWeekdays(month, year) {
                const monthDatesWithWeekdays = [];
                const daysInMonth = new Date(year, month, 0).getDate(); // Số ngày trong tháng

                for (let day = 1; day <= daysInMonth; day++) {
                    const date = new Date(year, month - 1, day);
                    const weekday = date.getDay();

                    const dateInfo = {
                        dayOfMonth: day,
                        weekday: weekday
                    };

                    monthDatesWithWeekdays.push(dateInfo);
                }

                return monthDatesWithWeekdays;
            }

            let currentDate = new Date();
            let currentMonth = currentDate.getMonth() + 1;
            let currentYear = currentDate.getFullYear();
            let swiper01 = new Swiper('.calendar-swiper-container', {
                slidesPerView: 13,
                spaceBetween: 20,
                loop: false,
                navigation: {
                    nextEl: '.swiper-button-next2',
                    prevEl: '.swiper-button-prev2',
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 5,
                        spaceBetween: 20,
                    },
                    850: {
                        slidesPerView: 5,
                        spaceBetween: 20,
                    },
                },
                observer: true,
                observeParents: true,
            });



            function setSlide(currentMonth, currentYear) {
                if (parseInt(currentMonth) < 10) {
                    currentMonth = '0' + parseInt(currentMonth);
                }

                $("#year").text(currentYear);
                $("#month").text(currentMonth);
                swiper01.destroy();
                const daysInCurrentMonth = getMonthDatesWithWeekdays(currentMonth, currentYear);
                $(".calendar-swiper-wrapper").empty();
                daysInCurrentMonth.forEach(e => {
                    var yy = currentYear;
                    var mm = currentMonth;
                    var dd = e.dayOfMonth;
                    if (parseInt(dd) < 10) dd = "0" + dd;
                    var calDate = yy + '-' + mm + '-' + dd;

                    var min_amt = '<?= $min_amt ?>';
                    var sel_Date = '<?= implode("|", array_column($air_info, "get_date")) ?>';
                    var sel_Price = '<?= implode("|", array_column($air_info, "tour_price")) ?>';
                    const arrDate = sel_Date.split("|");
                    const arrPrice = sel_Price.split("|");

                    var idx = -1;
                    for (var i = 0; i < arrDate.length; i++) {
                        if (arrDate[i] == calDate) {
                            idx = i;
                        }
                    }

                    if (idx == -1) {
                        var selAmt = "-";
                    } else {
                        if (arrPrice[idx] == min_amt) {
                            var selAmt = arrPrice[idx] + '만<br>(최소)';
                        } else {
                            var selAmt = arrPrice[idx] + '만';
                        }
                    }

                    var to_Day = '<?= date("Y-m-d", strtotime("+2 day", strtotime(date("Y-m-d")))) ?>';
                    var yy = $("#year").text();
                    var mm = $("#month").text();
                    var dd = e.dayOfMonth;
                    if (parseInt(dd) < 10) dd = "0" + dd;
                    var selDate = yy + '-' + mm + '-' + dd;
                    if (selDate < to_Day || selAmt == "-") {
                        $(".calendar-swiper-wrapper").append(`
                    <div class="swiper-slide">
                      <div style="color:${e.weekday === 6 || e.weekday === 0 ? "red" : "black"}">${daysOfWeek[e.weekday]}</div>
                      <div class="day">${e.dayOfMonth}</div>
                      <div class="txt"><span style="color:#252525; font-size:14px">-</div>
                    </div>
                `);
                    } else {
                        $(".calendar-swiper-wrapper").append(`
                    <div class="swiper-slide">
                      <div style="color:${e.weekday === 6 || e.weekday === 0 ? "red" : "black"}">${daysOfWeek[e.weekday]}</div>
                      <div class="day">
                        <a class="${selDate === '<?= $start_date_in ?>' ? 'on' : ''}" style="color:#252525" href='#!' onclick='sel_date(${e.dayOfMonth});'>
                        ${e.dayOfMonth}</a></div>
                      <div class="txt"><span style="color:#252525; font-size:14px">${selAmt}</div>
                    </div>
                `);
                    }
                });

                swiper01 = new Swiper('.calendar-swiper-container', {
                    slidesPerView: 13,
                    spaceBetween: 20,
                    loop: false,
                    navigation: {
                        nextEl: '.swiper-button-next2',
                        prevEl: '.swiper-button-prev2',
                    },
                    breakpoints: {
                        1024: {
                            slidesPerView: 5,
                            spaceBetween: 10,
                        },
                        850: {
                            slidesPerView: 5,
                            spaceBetween: 10,
                        },
                    },
                    observer: true,
                    observeParents: true,
                });

                var today = new Date();
                let date = "<?= $_start_dd ?>";
                swiper01.slideTo(date - 2);
            }

            setSlide('<?= date("m") ?>', '<?= date("Y") ?>');

            function nextMonth() {
                var yy = $("#year").text();
                var mm = $("#month").text();
                if (mm.length < 2) {
                    mm = "0" + mm;
                    $("#month").text(mm);
                }

                var dd = "1";
                currentDate.setMonth(currentDate.getMonth() + 1);
                currentMonth = parseInt(mm) + 1;
                currentYear = yy;
                if (currentMonth > 12) {
                    currentMonth = 1;
                    currentYear = parseInt(currentYear) + 1;
                }

                if (currentMonth.length < 2) currentMonth = '0' + currentMonth;
                setSlide(currentMonth, currentYear)
            }

            function prevMonth() {
                var yy = $("#year").text();
                var mm = $("#month").text();
                if (mm.length < 2) {
                    mm = "0" + mm;
                    $("#month").text(mm);
                }
                currentDate.setMonth(currentDate.getMonth() - 1);
                currentMonth = parseInt(mm) - 1;
                if (currentMonth < 1) {
                    currentMonth = 12;
                    currentYear = parseInt(currentYear) - 1;
                }
                if (currentMonth.length < 2) currentMonth = '0' + currentMonth;
                setSlide(currentMonth, currentYear)
            }

            $("#prev_icon").on("click", prevMonth)
            $("#next_icon").on("click", nextMonth)
            $("#prev_icon_mo").on("click", prevMonth)
            $("#next_icon_mo").on("click", nextMonth)
        </script>

        <div class="air_radio_wrap">
            <ul class="air_radio_list" id="info_ticket">
                <?php foreach ($air_info as $index => $info): ?>
                    <li style="position: relative;">
                        <?php if (isset($info['get_date']) && isset($info['deadline_date']) && isDateInRange($info['get_date'], $info['deadline_date'])): ?>
                            <div class="text-red deadline_date">
                                <?= $info['deadline_date'] ?>
                            </div>
                        <?php endif; ?>
                        <input hidden type="radio" name="air" id="airYes_<?= $info['yoil_idx'] ?>"
                            value="<?= $info['air_code_1'] ?>" <?= isset($air_idx) && $info['air_code_1'] == $air_idx ? 'checked' : ($index === 0 ? 'checked' : '') ?>>
                        <label for="airYes_<?= $info['yoil_idx'] ?>">
                            <div class="flex_b">
                                <div class="info_txt">
                                    <p class='air_name'>
                                        <?php if ($info['sale'] == "N" || (isset($info['get_date']) && isset($info['deadline_date']) && isDateInRange($info['get_date'], $info['deadline_date']))): ?>
                                            <em class="red">예약마감</em>
                                        <?php else: ?>
                                            <em>예약가능</em>
                                        <?php endif; ?>
                                        <strong class='ke'>
                                            <?php if (isset($info['ufile1'])): ?>
                                                <i
                                                    style="background: url('/data/code/<?= $info['ufile1'] ?>') center top no-repeat;"></i>
                                            <?php endif; ?>
                                            <?= $info['code_name'] ?>
                                        </strong>
                                    </p>
                                    <span class="chk_date">
                                        <i></i> <?= date('Y-m-d', strtotime($info['s_date'])) ?> ~
                                        <?= date('Y-m-d', strtotime($info['e_date'])) ?>
                                    </span>
                                    <a href="#itinerary" class="go_timetable">여행일정 <i></i></a>
                                </div>
                                <div class="payment">
                                    <b>성인가격</b>
                                    <p class="money">
                                        <strong><?= number_format($info['tour_price'] + $info['oil_price']) ?></strong> 원
                                    </p>
                                    <span>기본료 <?= number_format($info['tour_price']) ?> 원</span>
                                    <span>유류할증료 <?= number_format($info['oil_price']) ?> 원</span>
                                </div>
                            </div>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="reservation_info">
            <p class="sub_label content">예약전 확인하세요!</p>
            <div class="txt_box"><?= viewSQ($product_confirm) ?>

            </div>

            <div class="reservation_info ">
                <p class="label content">포함/불포함 사항</p>

                <div class="include_box chk_info">
                    <p class="sub_label"> <i></i> 포함사항</p>
                    <div class="txt_box"><?= viewSQ($product_able); ?></div>
                </div>
                <div class="no_include_box chk_info">
                    <p class="sub_label"> <i></i> 불포함사항</p>
                    <div class="txt_box"><?= viewSQ($product_unable); ?></div>
                </div>
            </div>
            
        </div>
      
    </div>
    <div class="view_nav_wrap only_web" id="parent">
        <div class="view_nav" id="sticky">
            <div class="scroll_box">
                <p class="label">인원선택 [출발일: <?= $start_date_in ?>]</p>
                <ul class="select_peo">
                    <li class="flex_b_c">
                        <div class="payment">
                            <p class="ped_label">성인 (만 12세이상) </p>
                            <p class="money"><strong><?= number_format($tour_price + $oil_price) ?></strong> 원</p>
                        </div>
                        <div class="opt_count_box count_box flex__c">
                            <button type="button" class="minus_btn" onclick="set_minus.bind(this)('1');"></button>
                            <input type="text" class="input-qty" name="qty" id="adult_qty" value="1">
                            <button type="button" class="plus_btn" onclick="set_plus.bind(this)('1');"></button>
                        </div>
                    </li>
                    <li class="flex_b_c">
                        <div class="payment">
                            <p class="ped_label">소아 (만 12세미만) </p>
                            <p class="money"><strong><?= number_format($tour_price_kids + $oil_price) ?></strong> 원</p>
                        </div>
                        <div class="opt_count_box count_box flex__c">
                            <button type="button" class="minus_btn" onclick="set_minus.bind(this)('2');"></button>
                            <input type="text" class="input-qty" name="qty" id="kids_qty" value="0">
                            <button type="button" class="plus_btn" onclick="set_plus.bind(this)('2');"></button>
                        </div>
                    </li>
                    <li class="flex_b_c">
                        <div class="payment">
                            <p class="ped_label">유아 (만 2세 미만) </p>
                            <p class="money"><strong><?= number_format($tour_price_baby) ?></strong> 원</p>
                        </div>
                        <div class="opt_count_box count_box flex__c">
                            <button type="button" class="minus_btn" onclick="set_minus.bind(this)('3');"></button>
                            <input type="text" class="input-qty" name="qty" id="baby_qty" value="0">
                            <button type="button" class="plus_btn" onclick="set_plus.bind(this)('3');"></button>
                        </div>
                    </li>
                </ul>
                <div class="txt_box">
                    <p><i>※ </i>1인 유류할증료: <?= number_format($oil_price) ?>원</p>
                    <p><i>※ </i>상품가는 가장 저렴한 항공 좌석 기준으로 좌석 상황에 따라 요금 변동될 수 있습니다.</p>
                    <p><i>※ </i>유류할증료는 유가와 환률에 따라 변동 될 수 있습니다.</p>
                    <p><i>※ </i>일정기간 연장 및 호텔 업그레이드/변경은 예약하기 창에서 개별적으로 요청 남겨주세요.</p>
                </div>
            </div>

            <div class="total_paymemt payment">
                <p class="ped_label">총 상품금액(M)</p>
                <p class="money"><strong id="total_txt"
                        class="total_txt"><?= number_format($tour_price + $oil_price) ?></strong> 원</p>
            </div>
            <div class="nav_btn_wrap">
                <button type="button " class="btn-point" onclick="order_it();">상품 예약하기</button>
                <div class="flex">
                    <button type="button " class="btn-default"
                        onclick="location='/inquiry/inquiry_write.php?product_idx=<?= $product_idx ?>'">상담 문의하기</button>
                    <button type="button " class="btn-default wish_btn"
                        onclick="javascript:wish_it('<?= $product_idx ?>')"><i></i></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="view_nav_wrap only_mo" id="parent">
    <div class="view_nav" id="sticky">
        <div class="scroll_box">
            <p class="label">인원선택 [출발일: <?= $start_date_in ?>]</p>
            <ul class="select_peo">
                <li class="flex_b_c">
                    <div class="payment">
                        <p class="ped_label">성인 (만 12세이상) </p>
                        <p class="money"><strong><?= number_format($tour_price + $oil_price) ?></strong> 원</p>
                    </div>
                    <div class="opt_count_box count_box flex__c">
                        <button type="button" class="minus_btn" onclick="set_minus.bind(this)('1');"></button>
                        <input type="text" class="input-qty" name="qty" id="adult_qty" value="1">
                        <button type="button" class="plus_btn" onclick="set_plus.bind(this)('1');"></button>
                    </div>
                </li>
                <li class="flex_b_c">
                    <div class="payment">
                        <p class="ped_label">소아 (만 12세미만) </p>
                        <p class="money"><strong><?= number_format($tour_price_kids + $oil_price) ?></strong> 원</p>
                    </div>
                    <div class="opt_count_box count_box flex__c">
                        <button type="button" class="minus_btn" onclick="set_minus.bind(this)('2');"></button>
                        <input type="text" class="input-qty" name="qty" id="kids_qty" value="0">
                        <button type="button" class="plus_btn" onclick="set_plus.bind(this)('2');"></button>
                    </div>
                </li>
                <li class="flex_b_c">
                    <div class="payment">
                        <p class="ped_label">유아 (만 2세 미만) </p>
                        <p class="money"><strong><?= number_format($tour_price_baby) ?></strong> 원</p>
                    </div>
                    <div class="opt_count_box count_box flex__c">
                        <button type="button" class="minus_btn" onclick="set_minus.bind(this)('3');"></button>
                        <input type="text" class="input-qty" name="qty" id="baby_qty" value="0">
                        <button type="button" class="plus_btn" onclick="set_plus.bind(this)('3');"></button>
                    </div>
                </li>
            </ul>
            <div class="txt_box">
                <p><i>※ </i>1인 유류할증료: <?= number_format($oil_price) ?>원</p>
                <p><i>※ </i>상품가는 가장 저렴한 항공 좌석 기준으로 좌석 상황에 따라 요금 변동될 수 있습니다.</p>
                <p><i>※ </i>유류할증료는 유가와 환률에 따라 변동 될 수 있습니다.</p>
                <p><i>※ </i>일정기간 연장 및 호텔 업그레이드/변경은 예약하기 창에서 개별적으로 요청 남겨주세요.</p>
            </div>
        </div>

        <div class="total_paymemt payment">
            <p class="ped_label">총 상품금액(M)</p>
            <p class="money"><strong id="total_txt"
                    class="total_txt"><?= number_format($tour_price + $oil_price) ?></strong> 원</p>
        </div>
        <div class="nav_btn_wrap">
            <button type="button " class="btn-point" onclick="order_it();">상품 예약하기</button>
            <div class="flex">
                <button type="button " class="btn-default"
                    onclick="location='/inquiry/inquiry_write.php?product_idx=<?= $product_idx ?>'">상담 문의하기</button>
                <button type="button " class="btn-default wish_btn"
                    onclick="javascript:wish_it('<?= $product_idx ?>')"><i></i></button>
            </div>
        </div>
    </div>
</div>
</div>