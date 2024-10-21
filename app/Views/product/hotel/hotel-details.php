<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <div class="content-sub-hotel-detail">
    <div class="body_inner">
    <div class="section1">
        <div class="title-container">
            <h2><?= $hotel['product_name'] ?> </h2>
            <div class="list-icon">
                <img src="/uploads/icons/print_icon.png" alt="print_icon" class="only_web">
                <img src="/uploads/icons/print_icon_mo.png" alt="print_icon_mo" class="only_mo">
                <img src="/uploads/icons/heart_icon.png" alt="heart_icon" class="only_web">
                <img src="/uploads/icons/heart_icon_mo.png" alt="heart_icon_mo" class="only_mo">
                <img src="/uploads/icons/share_icon.png" alt="share_icon" class="only_web">
                <img src="/uploads/icons/share_icon_mo.png" alt="share_icon_mo" class="only_mo">
            </div>
        </div>
        <div class="location-container">
            <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
            <span class="text-gray"> <?= $hotel['addrs'] ?> </span>
        </div>
        <div class="rating-container">
            <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
            <span><strong> <?= $hotel['review_average'] ?></strong></span>
            <span class="text-gray">생생리뷰 <strong style="color: #000;">(0)</strong></span>
        </div>
        <div class="hotel-image-container">
            <div class="hotel-image-container-1">
                <img src="/data/hotel/<?= $hotel['ufile1'] ?>" alt="<?= $hotel['product_name'] ?>"
                     onerror="this.src='/images/share/noimg.png'">
            </div>
            <div class="grid_2_2">
                <?php for ($j = 2; $j < 5; $j++) { ?>
                    <img class="grid_2_2_size" src="/data/hotel/<?= $hotel['ufile' . $j] ?>"
                         alt="<?= $hotel['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                <?php } ?>
                <div class="grid_2_2_sub" style="position: relative; cursor: pointer;">
                    <img class="custom_button" src="/data/hotel/<?= $hotel['ufile5'] ?>"
                         alt="<?= $hotel['product_name'] ?>"
                         onerror="this.src='/images/share/noimg.png'">
                    <div class="button-show-detail-image">
                        <img class="only_web" src="/uploads/icons/image_detail_icon.png"
                             alt="image_detail_icon">
                        <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png"
                             alt="image_detail_icon_m">
                        <span>사진 모두 보기</span>
                        <span>(6장)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-header-hotel-detail">
            <div class="main nav-list">
                <p class="nav-item" onclick="scrollToEl('section2')" style="cursor: pointer">숙소개요</p>
                <p class="nav-item" onclick="scrollToEl('section3')" style="cursor: pointer">객실</p>
                <p class="nav-item" onclick="scrollToEl('section4')" style="cursor: pointer">시설&서비스</p>
                <p class="nav-item" onclick="scrollToEl('section5')" style="cursor: pointer">호텔 정책</p>
                <p class="nav-item" onclick="scrollToEl('section6')" style="cursor: pointer">생생리뷰(159개)</p>
            </div>
            <div class="btn-container">
                <button type="button" onclick="scrollToEl('section3')">
                    객실선택
                </button>
            </div>
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
        <div class="tag-list-icon" style="margin-top: 20px">
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
            <div class="tag-item-sec3<?= $s_category_room === '' ? '--main' : '' ?>" onclick="go_category_room('')"
                 style="cursor: pointer">
                모두
            </div>
            <?php
            foreach ($room_categories

                     as $row) : ?>
        <?php if (isset($s_category_room) && $s_category_room === $row['code_no']) : ?>
            <div class="tag-item-sec3--main">
                <?php else : ?>
                <div class="tag-item-sec3" onclick="go_category_room(<?= $row['code_no'] ?>)" style="cursor: pointer">
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
            <style>
                .room_option_ {
                    padding-bottom: 30px !important;
                }

                .room_option_long {
                    height: 620px;
                    overflow: hidden;
                    margin-top: 30px;
                }

                .btnReadLess {
                    display: none;
                }

                .btnReadLess,
                .btnReadMore {
                    border: 1px solid #dbdbdb;
                    border-radius: 3px;
                    padding: 5px 10px;
                }

                .cus_scroll {
                    overflow-y: auto;
                    overflow-x: hidden;
                    height: 400px;
                    padding-left: 20px;
                }

                .cus_scroll::-webkit-scrollbar {
                    width: 2px;
                    background-color: #F5F5F5;
                    display: block;
                }

                .cus_scroll::-webkit-scrollbar-thumb {
                    background-color: #cccccc;
                }
            </style>
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
                                             onerror="this.src='/images/share/noimg.png"
                                             alt="<?= $room['roomName'] ?>">
                                        <div class=""
                                             style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%">
                                            <?php if ($room['ufile2']) { ?>
                                                <img style="width: 50%" src="/uploads/rooms/<?= $room['ufile2'] ?>"
                                                     onerror="this.src='/images/share/noimg.png"
                                                     alt="<?= $room['roomName'] ?>">
                                            <?php } ?>

                                            <?php if ($room['ufile3']) { ?>
                                                <img style="width: 50%" src="/uploads/rooms/<?= $room['ufile3'] ?>"
                                                     onerror="this.src='/images/share/noimg.png"
                                                     alt="<?= $room['roomName'] ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid2_2_1_m only_mo">
                                    <img src="/uploads/sub/hotel_item_1_1.png" alt="hotel_item_1_1">
                                </div>
                                <h2 class="subtitle">초대형 더블침대 1개 또는 싱글침대 2개</h2>
                                <?php $room_facil = $room['room_facil']; ?>
                                <ul class="cus_scroll">
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
                                    <tr>
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
                                                <p>객실 수</p>
                                                <div class="room_activity">
                                                    <button class="btnMinus">
                                                        -
                                                    </button>
                                                    <input type="text" class="input_room_qty onlynum" value="1"
                                                           data-id="<?= $room_op['rop_idx'] ?>">
                                                    <button class="btnPlus">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="day_qty">
                                                <p>객실 수</p>
                                                <div class="day_activity">
                                                    <button class="btnMinus">
                                                        -
                                                    </button>
                                                    <input type="text" class="input_day_qty onlynum" value="1"
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
                                                            </span>원
                                                </p>
                                                <button class="book-button openPopupBtn" onclick="window.location.href='/product-hotel/reservation-form/2'">예약하기</button>
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
                                                     alt="<?= $room['roomName'] ?>">
                                                <div class=""
                                                     style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%">
                                                    <?php if ($room['ufile2']) { ?>
                                                        <img style="width: 50%"
                                                             src="/uploads/rooms/<?= $room['ufile2'] ?>"
                                                             onerror="this.src='/images/share/noimg.png"
                                                             alt="<?= $room['roomName'] ?>">
                                                    <?php } ?>

                                                    <?php if ($room['ufile3']) { ?>
                                                        <img style="width: 50%"
                                                             src="/uploads/rooms/<?= $room['ufile3'] ?>"
                                                             onerror="this.src='/images/share/noimg.png"
                                                             alt="<?= $room['roomName'] ?>">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid2_2_1_m only_mo">
                                            <img src="/uploads/sub/hotel_item_1_1.png" alt="hotel_item_1_1">
                                        </div>
                                        <h2 class="subtitle">초대형 더블침대 1개 또는 싱글침대 2개</h2>
                                        <ul class="cus_scroll">
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
                                            <tr>
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
                                                        <p>객실 수</p>
                                                        <div class="room_activity">
                                                            <button class="btnMinus">
                                                                -
                                                            </button>
                                                            <input type="text" class="input_room_qty onlynum" value="1"
                                                                   data-id="<?= $room_op['rop_idx'] ?>">
                                                            <button class="btnPlus">
                                                                +
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="day_qty">
                                                        <p>객실 수</p>
                                                        <div class="day_activity">
                                                            <button class="btnMinus">
                                                                -
                                                            </button>
                                                            <input type="text" class="input_day_qty onlynum" value="1"
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
                                                            </span>원
                                                        </p>
                                                        <button class="book-button openPopupBtn">예약하기</button>
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
            <div class="list-tag-sec4" style="flex-wrap: wrap; gap: 30px; justify-content: start; ">
                <?php foreach ($fresult5 as $row2): ?>
                    <div class="tag-container-item-sec4" style="width: calc((100% - 120px)/4); padding-right: 70px">
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
                        <p> <?= nl2br($age_restriction ?? '') ?>  </p>
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
                    <strong>4.5/5</strong>
                </div>
                <span class="rating-right text-gray">928개 고객기준</span>
            </div>
            <div class="list-label-tag">
                <div class="label-tag-item">
                    <img class="square" src="/uploads/sub/hotel_item_rated_1.png" alt="hotel_item_rated_1">
                    <div class="label-tag-item-text">
                        <strong>청결</strong>
                        <p><strong>4.2</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/uploads/sub/hotel_item_rated_2.png" alt="hotel_item_rated_1">
                    <div class="label-tag-item-text">
                        <strong>시설</strong>
                        <p><strong>4.2</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/uploads/sub/hotel_item_rated_3.png" alt="hotel_item_rated_1">
                    <div class="label-tag-item-text">
                        <strong>위치</strong>
                        <p><strong>4.2</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/uploads/sub/hotel_item_rated_4.png" alt="hotel_item_rated_1">
                    <div class="label-tag-item-text">
                        <strong>직원친절도</strong>
                        <p><strong>4.2</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/uploads/sub/hotel_item_rated_5.png" alt="hotel_item_rated_1">
                    <div class="label-tag-item-text">
                        <strong>가성비</strong>
                        <p><strong>4.2</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/uploads/sub/hotel_item_rated_6.png" alt="hotel_item_rated_1">
                    <div class="label-tag-item-text">
                        <strong>편안함</strong>
                        <p><strong>4.2</strong> 최고좋음</p>
                    </div>
                </div>
            </div>
            <h2 class="sub-title-sec6">BEST 생생리뷰</h2>
            <div class="card-list-flex">
                <div class="card-list-recommemded">
                    <div class="recommemded-item">
                        <div class="container-head">
                            <img src="/uploads/icons/avatar_default_icon.png" alt="avatar_default_icon">
                            <div class="name">
                                <span>woras******</span>
                                <p>2024.08.09</p>
                            </div>
                        </div>
                        <h2>깨끗하고 편안하며 BTS chidlom과 가깝습니다.</h2>
                        <p class="custom_paragraph">아침조식.. 가짓수는 좀 있으나 모든음식과 음료의 수준은 수준이하, 과일쥬스는 과일향 첨가한 물같고, 일본김밥은
                            밥이
                            떡같고 빵도
                            질감이 너무 떨어지고. 무엇보다 모든 돼지 고기요리에서 냄새가 심하게 나서 3일머무는동안 힘들었음</p>
                        <button>더보기</button>
                    </div>
                    <div class="recommemded-item">
                        <div class="container-head">
                            <img src="/uploads/icons/avatar_default_icon.png" alt="avatar_default_icon">
                            <div class="name">
                                <span>craz******</span>
                                <p>2024.08.09</p>
                            </div>
                        </div>
                        <h2>역시 신상호텔 답네요!</h2>
                        <p class="custom_paragraph">역시 신상호텔 답네요! 공항과 접근성이 가장 좋은 이점이고요 부대시설도 아주 마음에 들었어요! 호캉스하기에 정말
                            좋습니
                            다!
                            단점이라고 굳이 말하자면 호텔 주변이 조금 심심한거랑 조 식이 아주 조금 아쉬웠습니다! 그래도 다시 온다면 여기서</p>
                        <button>더보기</button>
                    </div>
                    <div class="recommemded-item">
                        <div class="container-head">
                            <img src="/uploads/icons/avatar_user_1.png" alt="avatar_user_1">
                            <div class="name">
                                <span>mh8******</span>
                                <p>2024.08.09</p>
                            </div>
                        </div>
                        <h2>I'M SO DAMN SLEEPY</h2>
                        <p class="custom_paragraph">직원분들도 모두 친절하고, 숙소 위생상태도 합격이었습니다~ 위치는 지하철역과도 가깝고 주변에 마사지샵이나 스타벅스
                            세븐일레븐도
                            있어서 너무 좋았어요</p>
                        <button>더보기</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="section7">
            <div class="d_flex justify_content_end">
                <h1 class="title-sec7">다른 추천 호텔도 확인해 보세요 : )</h1>
                <div class="swiper_product_list_pagination_ swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                        <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                              role="button" aria-label="Go to slide 1" aria-current="true"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button"
                          aria-label="Go to slide 2"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button"
                          aria-label="Go to slide 3"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button"
                          aria-label="Go to slide 4"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button"
                          aria-label="Go to slide 5"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button"
                          aria-label="Go to slide 6"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button"
                          aria-label="Go to slide 7"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button"
                          aria-label="Go to slide 8"></span>
                    <span class="swiper-pagination-bullet" tabindex="0" role="button"
                          aria-label="Go to slide 9"></span>
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
                                <img src="/data/hotel/<?= $item['ufile1'] ?>" alt="main"
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
                                    <?php $i++; endforeach; ?>
                            </div>
                            <div class="prd_name">
                                <?= $item['product_name'] ?>
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
            $popup.css('display', 'flex');
        });

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
            let item = $(input).closest('tr');

            let qty_room = item.find('input.input_room_qty').val();
            let qty_day = item.find('input.input_day_qty').val();

            item.find('span.count_room').text(qty_room);
            item.find('span.count_day').text(qty_day);
            let main_price = item.find('span.totalPrice').data('price');
            let total_price = qty_room * qty_day * parseInt(main_price);
            let formattedNumber = total_price.toLocaleString('en-US');
            item.find('span.totalPrice').text(formattedNumber);
        }
    </script>

<?php $this->endSection(); ?>