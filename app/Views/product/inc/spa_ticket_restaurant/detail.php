<link rel="stylesheet" type="text/css" href="/css/tour/spa.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw3G5DUAOaV9CFr3Pft_X-949-64zXaBg&libraries=geometry"
        async defer></script>
<div class="content-sub-hotel-detail tours-detail spa-detail">
    <div class="body_inner">
        <div class="section1">
            <div class="title-container">
                <h2><?= $data_['product_name'] ?></h2>
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
                <span><?= $data_['addrs'] ?></span>
            </div>
            <div class="above-cus-content">
                <div class="rating-container">
                    <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                    <span><strong> <?= $data_['review_average'] ?></strong></span>
                    <span>생생리뷰 <strong>(<?= $data_['total_review'] ?>)</strong></span>

                    <?php
                    $_arr = explode("|", $data_['mbti']);

                    $code_n0 = [];

                    foreach ($mcodes as $mcode) {
                        if (in_array($mcode['code_no'], $_arr)) {
                            $code_n0[] = $mcode['code_name'];
                        }
                    }
                    ?>

                    <span>추천 MBTI: <?= implode(', ', $code_n0) ?></span>
                </div>
                <div class="list-icon only_mo">
                    <img src="/uploads/icons/print_icon.png" alt="print_icon">
                    <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                    <img src="/uploads/icons/share_icon.png" alt="share_icon">
                </div>
            </div>
            <?php
            $i3 = 0;
            for ($t = 1; $t < 8; $t++) {
                if (!empty($data_['ufile' . $t]) && $data_['ufile' . $t] != '') {
                    $i3++;
                }
            }
            ?>
            <div class="hotel-image-container">
                <div class="hotel-image-container-1">
                    <img class="imageDetailMain_"
                         onclick="img_pops('<?= $data_['product_idx'] ?>')"
                         src="/data/product/<?= $data_['ufile1'] ?>"
                         alt="<?= $data_['product_name'] ?>"
                         onerror="this.src='/images/share/noimg.png'">
                </div>
                <div class="grid_2_2">
                    <?php for ($j = 2; $j < 5; $j++) { ?>
                        <img onclick="img_pops('<?= $data_['product_idx'] ?>')"
                             class="grid_2_2_size imageDetailSup_"
                             src="/data/product/<?= $data_['ufile' . $j] ?>"
                             alt="<?= $data_['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                    <?php } ?>
                    <div class="grid_2_2_sub" onclick="img_pops('<?= $data_['product_idx'] ?>')"
                         style="position: relative; cursor: pointer;">
                        <img class="custom_button imageDetailSup_"
                             src="/data/product/<?= $data_['ufile5'] ?>"
                             alt="<?= $data_['product_name'] ?>"
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
        </div>
        <div class="_wrap-info-payment">
            <div class="_wrap-info">

                <div class="calendar-con">
                    <?php echo view("/product/reservation_inc.php"); ?>
                </div>
                <div class="sub-header-hotel-detail">
                    <div class="main nav-list">
                        <p class="nav-item active" onclick="scrollToEl('section2')" style="cursor: pointer">상품선택</p>
                        <p class="nav-item" onclick="scrollToEl('section3')" style="cursor: pointer">소개&시설</p>
                        <p class="nav-item" onclick="scrollToEl('section5')" style="cursor: pointer">스파정책</p>
                        <p class="nav-item" onclick="scrollToEl('section6')" style="cursor: pointer">
                            생생리뷰(<?= $data_['total_review'] ?>)</p>
                        <p class="nav-item" onclick="scrollToEl('section8')" style="cursor: pointer">상품문의(FAQ)</p>
                    </div>
                </div>

                <div class="section2" id="section2">
                    <h2 class="title-sec2">
                        상품선택
                    </h2>

                    <table class="price-table" id="price_table_" style="margin-bottom:30px;">
                        <colgroup>
                            <col width="*">
                            <col width="28%">
                            <col width="28%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th colspan="3">적용일자 : <span id="day_select_">...</span></th>
                        </tr>
                        <tr>
                            <th>선택옵션</th>
                            <th>성인(만 13세이상)</th>
                            <th>아동(만 5세~12세)</th>
                        </tr>
                        </thead>
                        <tbody id="price_body_">

                        <tr>
                            <td colspan="6">
                                날짜 선택해주세요!
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="section3" id="section3">
                    <h2 class="title-sec3">
                        소개&시설
                    </h2>

                    <div class="container-big-text">
                        <div class="only_w">
                            <?= viewSQ($data_['product_contents']) ?>
                        </div>
                        <div class="only_m">
                            <?= viewSQ($data_['product_contents_m']) ?>
                        </div>
                    </div>
                </div>

                <div class="section4" id="section4">
                    <h2 class="title-sec4">
                        위치안내
                    </h2>

                    <div class="section4_map" id="section4_map" style="">

                    </div>
                </div>
                <script>
                    const latitude = Number(`<?= $data_['latitude'] ?>`);
                    const longitude = Number(`<?= $data_['longitude'] ?>`);

                    function initMap() {
                        const location = {lat: latitude, lng: longitude};
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

                <?php
                $product_more = $data_['product_more'];
                $breakfast_data_arr2 = [];
                if ($product_more) {
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
                    <h1 class="title-sec5">스파정책</h1>
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

                <?php echo view("/product/inc/review_product", ['product' => $data_]); ?>

                <div class="custom-golf-detail">
                    <div class="section6" id="section8">
                        <h2 class="title-sec6">상품문의(FAQ)</h2>

                        <div class="qa-section">
                            <div class="custom-area-text">
                                <label class="custom-label" for="qa-comment">
                                    <textarea name="qa-comment" id="qa-comment"
                                              class="custom-main-input-style textarea autoExpand"
                                              placeholder="상품에 대해 궁금한 점을 물어보세요."></textarea>
                                </label>
                                <div type="submit" class="qa-submit-btn">등록</div>
                            </div>

                            <ul class="qa-list">
                                <li class="">
                                    <div class="qa-item qa_item_">
                                        <div class="qa-question">
                                            <span class="qa-number">124</span>
                                            <span class="qa-tag normal-style">답변대기중</span>
                                            <div class="con-cus-mo-qa">
                                                <p class="qa-text">티켓은 어떻게 예약할 수 있나요?</p>
                                                <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                            </div>
                                        </div>
                                        <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="qa-item qa_item_">
                                        <div class="qa-question">
                                            <span class="qa-number">123</span>
                                            <span class="qa-tag">답변완료</span>
                                            <div class="con-cus-mo-qa">
                                                <p class="qa-text">결제 시점은 언제인가요?</p>
                                                <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                            </div>
                                        </div>
                                        <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                    </div>
                                    <div class="additional-info d_none additional_info_">
                                        <span class="load-more">더투어랩</span>
                                        <p>조인투어로 전환 시 정해진 미팅장소에서 가이드님과 만나실 수 있습니다.<br>아유타야는 넓기 때문에 다른 장소에서 미팅은 어려운 점
                                            예약 시
                                            참고해주시기
                                            바랍니다.
                                        </p>
                                        <p class="mt-36">만약 투어 종료 후 개별 이동을 원하시면 당일 가이드님께 말씀해주시면 됩니다.</p>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="qa-item qa_item_">
                                        <div class="qa-question">
                                            <span class="qa-number">122</span>
                                            <span class="qa-tag normal-style">답변대기중</span>
                                            <div class="con-cus-mo-qa">
                                                <p class="qa-text">2월23일 성인 8명, 어린이 2명으로 예약하면 10명인데요. 통로역 근처인 저희 호텔로
                                                    외주실수...</p>
                                                <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                            </div>
                                        </div>
                                        <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="qa-item qa_item_">
                                        <div class="qa-question">
                                            <span class="qa-number">121</span>
                                            <span class="qa-tag normal-style">답변대기중</span>
                                            <div class="con-cus-mo-qa">
                                                <p class="qa-text">오늘 투어인데 아유타야에 있어서요. 혹시 아유타야에서 도중에 만나서 일정만 소화하고
                                                    아유타야에서...</p>
                                                <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                            </div>
                                        </div>
                                        <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="qa-item qa_item_">
                                        <div class="qa-question">
                                            <span class="qa-number">120</span>
                                            <span class="qa-tag">답변완료</span>
                                            <div class="con-cus-mo-qa">
                                                <p class="qa-text">입금 했습니다. 아직 확정 전이라고 떠서 확인부탁드려요.</p>
                                                <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                            </div>
                                        </div>
                                        <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                    </div>
                                    <div class="additional-info d_none additional_info_">
                                        <span class="load-more">더투어랩</span>
                                        <p>조인투어로 전환 시 정해진 미팅장소에서 가이드님과 만나실 수 있습니다.<br>아유타야는 넓기 때문에 다른 장소에서 미팅은 어려운 점
                                            예약 시
                                            참고해주시기
                                            바랍니다.
                                        </p>
                                        <p class="mt-36">만약 투어 종료 후 개별 이동을 원하시면 당일 가이드님께 말씀해주시면 됩니다.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="pagination">
                            <a href="#" class="page-link">
                                <img class="only_web" src="/uploads/icons/arrow_prev_step.png"
                                     alt="arrow_prev_step">
                                <img class="only_mo" src="/uploads/icons/arrow_prev_step_mo.png"
                                     alt="arrow_prev_step_mo">
                            </a>
                            <a href="#" class="page-link cus-padding mr">
                                <img class="only_web" src="/uploads/icons/arrow_prev_all.png" alt="arrow_prev_all">
                                <img class="only_mo" src="/uploads/icons/arrow_prev_all_mo.png"
                                     alt="arrow_prev_all_mo">
                            </a>
                            <a href="#" class="page-link active">1</a>
                            <a href="#" class="page-link">2</a>
                            <a href="#" class="page-link">3</a>
                            <a href="#" class="page-link cus-padding ml">
                                <img class="only_web" src="/uploads/icons/arrow_next_all.png" alt="arrow_next_step">
                                <img class="only_mo" src="/uploads/icons/arrow_next_all_mo.png"
                                     alt="arrow_next_step_mo">
                            </a>
                            <a href="#" class="page-link">
                                <img class="only_web" src="/uploads/icons/arrow_next_step.png"
                                     alt="arrow_next_step">
                                <img class="only_mo" src="/uploads/icons/arrow_next_step_mo.png"
                                     alt="arrow_next_step">
                            </a>
                        </div>
                    </div>
                </div>
                <style>
                    .d_none {
                        display: none;
                        transition: all 0.3s ease;
                    }
                </style>
                <script>
                    $('.qa_item_').on('click keypress', function (e) {
                        if (e.type === 'click' || e.key === 'Enter') {
                            $('.additional_info_').addClass('d_none').attr('aria-hidden', 'true');
                            if ($(this).next('.additional-info').hasClass('d_none')) {
                                $(this).attr('aria-expanded', 'true').next().removeClass('d_none').attr('aria-hidden', 'false');
                            } else {
                                $(this).attr('aria-expanded', 'false').next().addClass('d_none').attr('aria-hidden', 'true');
                            }
                        }
                    });
                </script>
            </div>

            <div class="vertical-line"></div>

            <div class="_wrap-payment">
                <?php echo view("/product/composition_inc.php"); ?>
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

    function getPriceLabel(status) {
        if (status === "예약가능") return '<span class="label allow-text">예약가능</span>';
        if (status === "예약마감") return '<span class="label sold-out-text">예약마감</span>';
        return '<span></span>';
    }

    // 버튼이 동적으로 생성된 경우에도 클릭 이벤트 적용
    // $(document).on('click', '.allowBtn', function () {
    // let order_no = $("#order_no").val();
    // console.log(order_no);
    // $.ajax({
    //
    //     url: "/ajax/ajax.order_delete.php",
    //     type: "POST",
    //     data: {
    //         "order_no": order_no
    //     },
    //     dataType: "json",
    //     async: false,
    //     cache: false,
    //     success: function (data, textStatus) {
    //         console.log(data)
    //     },
    //     error: function (request, status, error) {
    //         alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
    //     }
    // });
    // });

    $(document).on('click', '.allowDate', function () {
        $('.sel_date').removeClass('active_');
        $(this).addClass('active_');
        let day_ = $(this).data('date');
        //alert(day_);
        spaCharge(day_);
        var activeData = $('.day.allowDate.sel_date.active_').data('date');
        $("#select_date").text(activeData);

    });

    async function spaCharge(day_) {
        await LoadingPage();
        $('#day_').val(day_)
        $('#day_select_').text(day_);
        await loadDay(day_);
        //alert('111111111');
    }

    function getYoil(day) {
        const yoilArray = ['yoil_0', 'yoil_1', 'yoil_2', 'yoil_3', 'yoil_4', 'yoil_5', 'yoil_6'];
        const date = new Date(day);
        const dayIndex = date.getUTCDay();
        return yoilArray[dayIndex];
    }

    function loadDay(day_) {
        let yoil = getYoil(day_);
        let url = `<?= route_to('api.spa_.charge_list') ?>?product_idx=<?= $data_['product_idx'] ?>&day_=${day_}&yoil=${yoil}`;
        $.ajax({
            url: url,
            type: "GET",
            async: false,
            error: function (request, status, error) {
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                LoadingPage();
            },
            success: function (response, status, request) {
                let day = response.data.day;
                renderData(response.data);
                LoadingPage();
            }
        });
    }

    function renderData(rs) {
        let html = ``;
        for (let i = 0; i < rs.length; i++) {
            let data = rs[i].data;

            let full_ = data.full_;

            for (let i = 0; i < data.length; i++) {
                let item_ = data[i];

                let txt = '매일'
                if (full_ && full_ == false) {
                    txt = '';
                }

                html += `<tr>
                    <td>${item_.s_station}</td>
                    <td>
                        <div class="d_flex align_items_center justify_content_between gap-10 price_sl_">
                            <div class="price" style="    display: flex;
    justify-content: start;
    align-items: start;
    flex-direction: column;
    gap: 5px;
}">
                                <span class="text_primary">${convertNum(item_.tour_price_baht)} 원</span>
                                <span style="">(${convertNum(item_.tour_price)} 바트)</span>
                            </div>
                            <p class="" style="display: flex; align-items: center; gap: 5px">
                                <input type="text" value="0" name="mem_cnt2[]" data-price="${item_.tour_price_baht}" class="price_in qty_adults_select_" size="4"
                                       data-idx="${item_.charge_idx}" data-s_station="${item_.s_station}" data-type="adults" onkeyup="chkNum(this)">
                                <span>명</span>
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="d_flex align_items_center justify_content_between gap-10 price_sl_">
                            <div class="price" style="    display: flex;
    justify-content: start;
    align-items: start;
    flex-direction: column;
    gap: 5px;
}">
                                <span class="text_primary">${convertNum(item_.tour_price_kids_baht)} 원</span>
                                <span style="">(${convertNum(item_.tour_price_kids)} 바트)</span>
                            </div>
                            <p class="" style="display: flex; align-items: center; gap: 5px">
                                <input type="text" value="0" name="mem_cnt2[]" data-price="${item_.tour_price_kids_baht}" class="price_in qty_children_select_" size="4"
                                       data-idx="${item_.charge_idx}" data-s_station="${item_.s_station}" data-type="kids" onkeyup="chkNum(this)">
                                <span>명</span>
                            </p>
                        </div>
                    </td>
                </tr>`;
            }
        }

        if (rs.length === 0) {
            html = `<tr>
                                <td colspan="6">
                                    날짜 선택해주세요!
                                </td>
                            </tr>`;
        }

        $('#price_body_').html(html);
    }

    function chkNum(el) {
        let val = $(el).val();

        if (!$.isNumeric(val)) {
            val = val.replace(/\D/g, '');

            $(el).val(val);
        }

        showTotalPrice();

        renderItemPrice();
    }

    function renderItemPrice() {
        let html_adults = ``;
        let html_kids = ``;

        let i = 0;
        $('.qty_adults_select_').each(function () {
            let price = $(this).data('price');
            let idx = $(this).data('idx');
            let type = $(this).data('type');
            let s_station = $(this).data('s_station');
            let num = $(this).val();
            if (num > 0) {
                if (type === 'adults') {
                    i++;
                    html_adults += `<div class="flex_b_c cus-count-input" id="children_adults_${idx}">
                                <div class="payment">
                                    <p class="ped_label ped_label__booking">성인 ${i}</p>
                                </div>
                                <div class="opt_count_box count_box flex__c">
                                    <input type="hidden" name="s_station[]" id="s_station${idx}" value="${s_station}">
                                    <input type="text" class="input-qty adultQty" name="adultQty[]" id="adultQty${idx}"
                                           value="${num}" readonly="" style="padding: 0; width: 30px">
                                    <span>명</span>
                                    <input type="hidden" name="adultPrice[]" id="adultPrice${idx}" value="${price}">
                                </div>
                            </div>`;
                }
            }
        })

        let j = 0;
        $('.qty_children_select_').each(function () {
            let price = $(this).data('price');
            let idx = $(this).data('idx');
            let type = $(this).data('type');
            let num = $(this).val();
            if (num > 0) {
                if (type === 'kids') {
                    j++;
                    html_kids += `<div class="flex_b_c cus-count-input" id="children_kids_${idx}">
                                <div class="payment">
                                    <p class="ped_label ped_label__booking">아동 ${j}</p>
                                </div>
                                <div class="opt_count_box count_box flex__c">
                                    <input type="text" class="input-qty childrenQty" name="childrenQty[]"
                                           id="childrenQty${idx}" value="${num}"
                                           readonly="" style="padding: 0; width: 30px">
                                    <span>명</span>
                                    <input type="hidden" name="childrenPrice[]" id="childrenPrice${idx}" value="${price}">
                                </div>
                            </div>`;
                }
            }
        })

        if (html_kids === ``) {
            html_kids = `<div class="flex_b_c cus-count-input">
                                <div class="payment">
                                    <p class="ped_label ped_label__booking">아동</p>
                                </div>
                                <div class="opt_count_box count_box flex__c">
                                    <input type="text" class="input-qty childrenQty" name="childrenQty[]"
                                           id="childrenQty" value="0"
                                           readonly="" style="padding: 0; width: 30px">
                                    <span>명</span>
                                    <input type="hidden" name="childrenPrice[]" id="childrenPrice">
                                </div>
                            </div>`;
        }

        if (html_adults === ``) {
            html_adults = `<div class="flex_b_c cus-count-input">
                                <div class="payment">
                                    <p class="ped_label ped_label__booking">성인 </p>
                                </div>
                                <div class="opt_count_box count_box flex__c">
                                    <input type="text" class="input-qty adultQty" name="adultQty[]" id="adultQty"
                                           value="0"
                                           readonly="" style="padding: 0; width: 30px">
                                    <span>명</span>
                                    <input type="hidden" name="adultPrice[]" id="adultPrice">
                                </div>
                            </div>`;
        }

        $('#list_number_child_').html(html_kids);
        $('#list_number_adult_').html(html_adults);
    }

    function calcTotalPrice() {
        let qty_children = 0;
        let qty_adults = 0;
        let price_total = 0;

        $('.qty_adults_select_').each(function () {
            let q = $(this).val() ?? 0;
            let p = $(this).data('price');

            qty_adults += parseInt(q);
            let pT = parseInt(p) * parseInt(q)

            price_total += pT;
        })

        $('.qty_children_select_').each(function () {
            let q = $(this).val() ?? 0;
            let p = $(this).data('price');

            qty_children += parseInt(q);
            let pT = parseInt(p) * parseInt(q)

            price_total += pT;
        })

        price_total = convertNum(price_total);

        return data = {
            qty_adults: qty_adults,
            qty_children: qty_children,
            price_total: price_total
        }
    }

    function showTotalPrice() {
        let data = calcTotalPrice();

        let qty_adults = data.qty_adults;
        let qty_children = data.qty_children;
        let price_total = data.price_total;

        renderTotalPrice(price_total, qty_adults, qty_children);
    }

    function renderTotalPrice(price_total, qty_adults, qty_children) {
        price_total = data.price_total.replaceAll(',', '');
        price_total = mainCalc(price_total);
        $('#total_sum').text(price_total);
        $('#adultQty').val(qty_adults);
        $('#childrenQty').val(qty_children);
    }

    function mainCalc(price_total) {
        let option_list_ = $("#option_list_").find('li.cus-count-input');

        let total_price = 0;
        for (let i = 0; i < option_list_.length; i++) {
            let inp = $(option_list_[i]).find('input.input-qty');
            let price = inp.attr('data-price');
            let cnt = inp.val();
            total_price += parseInt(price) * parseInt(cnt);
        }

        total_price += parseInt(price_total);

        $('#totalPrice').val(total_price);

        total_price = total_price.toLocaleString();
        return total_price;
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

    function scrollToEl(elID) {
        $('html, body').animate({
            scrollTop: $('#' + elID).offset().top - 230
        }, 'slow');
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
            name: "<?= addslashes($data_['product_name']) ?>",
            image: "<?= '/data/product/' . $data_['ufile1'] ?>",
            ...(<?= isset($data_['ufile2']) && $data_['ufile2'] ? 'true' : 'false' ?> && { image2: "<?= '/data/product/' . $data_['ufile2'] ?>" })
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