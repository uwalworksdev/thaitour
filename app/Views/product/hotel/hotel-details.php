<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <div class="content-sub-hotel-detail">
    <div class="body_inner">
        <div class="section1">
            <div class="title-container">
                <h2><?= $hotel['goods_name_front'] ?> </h2>
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
                <span class="text-gray"> <?= $hotel['locations'] ?> </span>
            </div>
            <div class="rating-container">
                <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                <span><strong> <?= $hotel['review_average'] ?></strong></span>
                <span class="text-gray">생생리뷰 <strong style="color: #000;">(0)</strong></span>
            </div>
            <div class="hotel-image-container">
                <div class="hotel-image-container-1">
                    <img src="/uploads/hotel/<?= $hotel['ufile1'] ?>" alt="hotel_details_1">
                </div>
                <div class="grid_2_2">
                    <?php for ($j = 2; $j < 7; $j++) { ?>

                    <?php } ?>
                    <!--                    <img class="grid_2_2_size" src="/uploads/hotel/hotel_details_2.png" alt="hotel_details_2">-->
                    <!--                    <img class="grid_2_2_size" src="/uploads/hotel/hotel_details_3.png" alt="hotel_details_3">-->
                    <!--                    <img class="grid_2_2_size" src="/uploads/hotel/hotel_details_4.png" alt="hotel_details_4">-->
                    <!--                    <div class="grid_2_2_sub" style="position: relative; cursor: pointer;">-->
                    <!--                        <img class="custom_button" src="/uploads/sub/hotel_details_5.png" alt="hotel_details_5">-->
                    <!--                        <div class="button-show-detail-image">-->
                    <!--                            <img class="only_web" src="/uploads/icons/image_detail_icon.png"-->
                    <!--                                 alt="image_detail_icon">-->
                    <!--                            <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png"-->
                    <!--                                 alt="image_detail_icon_m">-->
                    <!--                            <span>사진 모두 보기</span>-->
                    <!--                            <span>(125장)</span>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                </div>
            </div>
            <div class="sub-header-hotel-detail">
                <div class="main nav-list">
                    <a class="nav-item active">숙소개요</a>
                    <a class="nav-item">객실</a>
                    <a class="nav-item">시설&서비스</a>
                    <a class="nav-item">호텔 정책</a>
                    <a class="nav-item">생생리뷰(159개)</a>
                </div>
                <div class="btn-container">
                    <button>
                        객실선택
                    </button>
                </div>
            </div>
        </div>
        <div class="section2">
            <h2 class="title-sec2">
                숙소개요
            </h2>
            <h3 class="sub-title-sec2">
                추천 포인트
            </h3>
            <p class="description-sec2">
                <?= viewSQ($hotel['content']) ?>
            </p>
            <div class="tag-list-icon" style="margin-top: 20px">
                <?php foreach ($fresult4 as $row) : ?>
                    <div class="item-tag">
                        <img src="/uploads/icons/<?= $row['ufile1'] ?>" alt="<?= $row['code_name'] ?>">
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
        <div class="section3">
            <h3 class="title-sec3">
                객실을 선택하세요
            </h3>
            <div class="list-tag-sec3">
                <div class="tag-item-sec3--main">
                    조식 포함 (5)
                </div>
                <div class="tag-item-sec3--active">
                    침대 2개 (3)
                </div>
                <div class="tag-item-sec3">
                    침대 여러개(0)
                </div>
                <div class="tag-item-sec3">
                    오션 뷰 (2)
                </div>
            </div>
            <div class="card-item-sec3">
                <div class="card-title-sec3-container">
                    <h2>그랜드 디럭스 스튜디오 - 트윈침대</h2>
                    <div class="label">시티 뷰</div>
                </div>
                <div class="card-item-container">
                    <div class="card-item-left">
                        <div class="only_web">
                            <div class="grid2_2_1">
                                <img src="/uploads/sub/hotel_item_1_1.png" alt="hotel_item_1_1">
                                <img src="/uploads/sub/hotel_item_1_2.png" alt="hotel_item_1_2">
                                <div class="" style="position: relative;">
                                    <img class="custom_button" src="/uploads/sub/hotel_item_1_3.png"
                                         alt="hotel_item_1_3">
                                    <div class="button-show-detail-image">
                                        <img src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                                        <span>22</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid2_2_1_m only_mo">
                            <img src="/uploads/sub/hotel_item_1_1.png" alt="hotel_item_1_1">
                            <div class="">
                                <img class="img-top" src="/uploads/sub/hotel_item_1_2.png" alt="hotel_item_1_2">
                                <div class="grid2_2_1_sub" style="position: relative;">
                                    <img class="custom_button" src="/uploads/sub/hotel_item_1_3.png"
                                         alt="hotel_item_1_3">
                                    <div class="button-show-detail-image">
                                        <img src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                                        <span>125</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="subtitle">초대형 더블침대 1개 또는 싱글침대 2개</h2>
                        <ul>
                            <li>시티 뷰</li>
                            <li>금연객실</li>
                            <li>45㎡ / 13-16층</li>
                            <li>무료 Wi-Fi</li>
                            <li>발코니</li>
                        </ul>
                    </div>

                    <table class="room-table only_web">
                        <thead>
                        <tr>
                            <th>옵션 상세</th>
                            <th>쿠폰</th>
                            <th>객실 요금</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="room-details">
                                    <p class="room-p-cus-1">객실 상세</p>
                                    <p>초대형 더블침대 1개</p>
                                    <ul>
                                        <li class="highlight">조식 2인 포함</li>
                                        <li>환불 불가</li>
                                    </ul>
                                    <p class="room-p-cus-2">투숙객 정원</p>
                                    <p>성인 2명</p>
                                </div>
                            </td>
                            <td>
                                <div class="occupancy">
                                    <span class="occupancy_button openPopupBtn">쿠폰적용</span>
                                </div>
                            </td>
                            <td>
                                <div class="price-details">
                                    <div class="discount">
                                        <span class="label">특별할인</span>
                                        <span class="price_content">30%할인</span>
                                    </div>
                                    <div class="price-strike-container">
                                        <span class="price-strike">202,043원</span>
                                        <span class="price">160,430</span>원
                                    </div>
                                    <span class="total">총금액: 5,091,454원</span>
                                    <span class="details">객실 1개 × 3박 (세금 포함)</span>
                                    <span class="details" style="color: #df0011">쿠폰 적용 10%할인</span>
                                    <p><span class="price">481,290</span>원</p>
                                    <button class="book-button openPopupBtn">예약하기</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="room-details">
                                    <p>객실 상세</p>
                                    <p>싱글침대 2개</p>
                                    <ul>
                                        <li>조식 20,895원 (선택 사항)</li>
                                        <li>환불 불가</li>
                                    </ul>
                                    <p class="text-details-2">투숙객 정원</p>
                                    <p>성인 2명</p>
                                </div>
                            </td>
                            <td>
                                <div class="occupancy">
                                    <span class="occupancy_button openPopupBtn">쿠폰적용</span>
                                </div>
                            </td>
                            <td>
                                <div class="price-details">
                                    <div class="discount">
                                        <span class="label">특별할인</span>
                                        <span class="price_content">40%할인</span>
                                    </div>
                                    <div class="price-strike-container">
                                        <span class="price-strike">202,043원</span>
                                        <span class="price">160,430</span>원
                                    </div>
                                    <span class="details">객실 1개 × 36박 (세금 포함)</span>
                                    <p><span class="price">481,290</span>원</p>
                                    <button class="book-button-sub openPopupBtn">예약하기</button>
                                </div>
                            </td>
                        </tr>
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
            </div>
            <div class="card-item-sec3">
                <div class="card-title-sec3-container">
                    <h2>디럭스룸 (침실 1개, 킹 침대 )</h2>
                </div>
                <div class="card-item-container">
                    <div class="card-item-left">
                        <div class="only_web">
                            <div class="grid2_2_1">
                                <img src="/uploads/sub/hotel_item_2_1.png" alt="hotel_item_1_1">
                                <img src="/uploads/sub/hotel_item_2_2.png" alt="hotel_item_1_2">
                                <div class="" style="position: relative;">
                                    <img class="custom_button" src="/uploads/sub/hotel_item_2_3.png"
                                         alt="hotel_item_1_3">
                                    <div class="button-show-detail-image">
                                        <img src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                                        <span>22</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid2_2_1_m only_mo">
                            <img src="/uploads/sub/hotel_item_2_1.png" alt="hotel_item_1_1">
                            <div class="">
                                <img class="img-top" src="/uploads/sub/hotel_item_2_2.png" alt="hotel_item_1_2">
                                <div class="grid2_2_1_sub" style="position: relative;">
                                    <img class="custom_button" src="/uploads/sub/hotel_item_2_3.png"
                                         alt="hotel_item_1_3">
                                    <div class="button-show-detail-image">
                                        <img src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                                        <span>22</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="subtitle">킹 침대 1개</h2>
                        <ul>
                            <li>시티 뷰</li>
                            <li>금연객실</li>
                            <li>45㎡ / 13-16층</li>
                            <li>무료 Wi-Fi</li>
                            <li>발코니</li>
                        </ul>
                    </div>

                    <table class="room-table only_web">
                        <thead>
                        <tr>
                            <th>옵션 상세</th>
                            <th>쿠폰</th>
                            <th>객실 요금</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="room-details">
                                    <p class="room-p-cus-1">객실 상세</p>
                                    <p>초대형 더블침대 1개</p>
                                    <ul>
                                        <li class="highlight">조식 2인 포함</li>
                                        <li>환불 불가</li>
                                    </ul>
                                    <p class="room-p-cus-2">투숙객 정원</p>
                                    <p>성인 2명</p>
                                </div>
                            </td>
                            <td>
                                <div class="occupancy">
                                    <span class="occupancy_button openPopupBtn">쿠폰적용</span>
                                </div>
                            </td>
                            <td>
                                <div class="price-details">
                                    <div class="discount">
                                        <span class="label">특별할인</span>
                                        <span class="price_content">30%할인</span>
                                    </div>
                                    <div class="price-strike-container">
                                        <span class="price-strike">202,043원</span>
                                        <span class="price">160,430</span>원
                                    </div>
                                    <span class="total">총금액: 5,091,454원</span>
                                    <span class="details">객실 1개 × 3박 (세금 포함)</span>
                                    <span class="details" style="color: #df0011">쿠폰 적용 10%할인</span>
                                    <p><span class="price">481,290</span>원</p>
                                    <button class="book-button-sub openPopupBtn">예약하기</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="room-details">
                                    <p>객실 상세</p>
                                    <p>싱글침대 2개</p>
                                    <ul>
                                        <li>조식 20,895원 (선택 사항)</li>
                                        <li>환불 불가</li>
                                    </ul>
                                    <p class="text-details-2">투숙객 정원</p>
                                    <p>성인 2명</p>
                                </div>
                            </td>
                            <td>
                                <div class="occupancy">
                                    <span class="occupancy_button openPopupBtn">쿠폰적용</span>
                                </div>
                            </td>
                            <td>
                                <div class="price-details">
                                    <div class="discount">
                                        <span class="label">특별할인</span>
                                        <span class="price_content">30%할인</span>
                                    </div>
                                    <div class="price-strike-container">
                                        <span class="price-strike">202,043원</span>
                                        <span class="price">160,430</span>원
                                    </div>
                                    <span class="details">객실 1개 × 36박 (세금 포함)</span>
                                    <p><span class="price">481,290</span>원</p>
                                    <button class="book-button-sub openPopupBtn">예약하기</button>
                                </div>
                            </td>
                        </tr>
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
            </div>
            <div class="card-item-sec3">
                <div class="card-title-sec3-container">
                    <h2>그랜드 디럭스 1-베드룸 트윈</h2>
                </div>
                <div class="card-item-container">
                    <div class="card-item-left">
                        <div class="only_web">
                            <div class="grid2_2_1">
                                <img src="/uploads/sub/hotel_item_2_1.png" alt="hotel_item_1_1">
                                <img src="/uploads/sub/hotel_item_2_2.png" alt="hotel_item_1_2">
                                <div class="" style="position: relative;">
                                    <img class="custom_button" src="/uploads/sub/hotel_item_2_3.png"
                                         alt="hotel_item_1_3">
                                    <div class="button-show-detail-image">
                                        <img src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                                        <span>22</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid2_2_1_m only_mo">
                            <img src="/uploads/sub/hotel_item_2_1.png" alt="hotel_item_1_1">
                            <div class="">
                                <img class="img-top" src="/uploads/sub/hotel_item_2_2.png" alt="hotel_item_1_2">
                                <div class="grid2_2_1_sub" style="position: relative;">
                                    <img class="custom_button" src="/uploads/sub/hotel_item_2_3.png"
                                         alt="hotel_item_1_3">
                                    <div class="button-show-detail-image">
                                        <img src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                                        <span>22</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="subtitle">싱글 침대 2개</h2>
                        <ul>
                            <li>시티 뷰</li>
                            <li>금연객실</li>
                            <li>45㎡ / 13-16층</li>
                            <li>무료 Wi-Fi</li>
                            <li>발코니</li>
                        </ul>
                    </div>

                    <table class="room-table only_web">
                        <thead>
                        <tr>
                            <th>옵션 상세</th>
                            <th>쿠폰</th>
                            <th>객실 요금</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="room-details">
                                    <p class="room-p-cus-1">객실 상세</p>
                                    <p>초대형 더블침대 1개</p>
                                    <ul>
                                        <li class="highlight">조식 2인 포함</li>
                                        <li>환불 불가</li>
                                    </ul>
                                    <p class="room-p-cus-2">투숙객 정원</p>
                                    <p>성인 2명</p>
                                </div>
                            </td>
                            <td>
                                <div class="occupancy">
                                    <span class="occupancy_button openPopupBtn">쿠폰적용</span>
                                </div>
                            </td>
                            <td>
                                <div class="price-details">
                                    <div class="discount">
                                        <span class="label">특별할인</span>
                                        <span class="price_content">30%할인</span>
                                    </div>
                                    <div class="price-strike-container">
                                        <span class="price-strike">202,043원</span>
                                        <span class="price">160,430</span>원
                                    </div>
                                    <span class="total">총금액: 5,091,454원</span>
                                    <span class="details">객실 1개 × 3박 (세금 포함)</span>
                                    <span class="details" style="color: #df0011">쿠폰 적용 10%할인</span>
                                    <p><span class="price">481,290</span>원</p>
                                    <button class="book-button-sub openPopupBtn">예약하기</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="room-details">
                                    <p>객실 상세</p>
                                    <p>싱글침대 2개</p>
                                    <ul>
                                        <li>조식 20,895원 (선택 사항)</li>
                                        <li>환불 불가</li>
                                    </ul>
                                    <p class="text-details-2">투숙객 정원</p>
                                    <p>성인 2명</p>
                                </div>
                            </td>
                            <td>
                                <div class="occupancy">
                                    <span class="occupancy_button openPopupBtn">쿠폰적용</span>
                                </div>
                            </td>
                            <td>
                                <div class="price-details">
                                    <div class="discount">
                                        <span class="label">특별할인</span>
                                        <span class="price_content">30%할인</span>
                                    </div>
                                    <div class="price-strike-container">
                                        <span class="price-strike">202,043원</span>
                                        <span class="price">160,430</span>원
                                    </div>
                                    <span class="details">객실 1개 × 36박 (세금 포함)</span>
                                    <p><span class="price">481,290</span>원</p>
                                    <button class="book-button-sub openPopupBtn">예약하기</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <img src="/images/ico/close_icon_popup.png" alt="close_icon" class="close-btn"></img>
                            <h2 class="title-popup">적용가능한 쿠폰 확인</h2>
                            <div class="order-popup">
                                <p class="count-info">사용 가능 쿠폰 <span>2장</span></p>
                                <div class="description-above">
                                    <div class="item-price-popup">
                                        <div class="img-container">
                                            <img src="/images/sub/popup_cash_icon.png" alt="popup_cash_icon">
                                        </div>
                                        <div class="text-con">
                                            <span>신규회원가입 웰컴 쿠폰</span>
                                            <span class="text-gray">10% 할인쿠폰</span>
                                        </div>
                                        <span class="date-sub">~2024.10.05</span>
                                    </div>
                                    <div class="item-price-popup">
                                        <div class="img-container">
                                            <img src="/images/sub/popup_cash_icon.png" alt="popup_cash_icon">
                                        </div>
                                        <div class="text-con">
                                            <span>추가 즉시할인쿠폰</span>
                                            <span class="text-gray">5,000원 할인쿠폰</span>
                                        </div>
                                        <span class="date-sub">~2024.10.05</span>
                                    </div>
                                    <div class="item-price-popup item-price-popup--button">
                                        <span>적용안함</span>
                                    </div>
                                </div>
                                <div class="line-gray"></div>
                                <div class="footer-popup">
                                    <div class="des-above">
                                        <div class="item">
                                            <span class="text-gray">총 주문금액</span>
                                            <span class="text-gray">160,430원</span>
                                        </div>
                                        <div class="item">
                                            <span class="text-gray">할인금액</span>
                                            <span class="text-gray">16,040원</span>
                                        </div>
                                    </div>
                                    <div class="des-below">
                                        <div class="price-below">
                                            <span>최종결제금액</span>
                                            <p class="price-popup">144,000<span class="text-gray">원</span></p>
                                        </div>
                                    </div>
                                    <button class="btn_accept_popup"
                                            onclick="location.href='/product-hotel/customer-form'">
                                        쿠폰적용
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
            </div>
        </div>
        <div class="section4">
            <h2 class="title-sec4">시설 & 서비스</h2>
            <div class="list-tag-sec4" style="flex-wrap: wrap; gap: 100px">
                <?php foreach ($fresult5 as $row2): ?>
                    <div class="tag-container-item-sec4" style="width: calc((100% - 400px)/4)">
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
        <div class="section5">
            <h1 class="title-sec5">호텔정책</h1>
            <div class="content-container-sec5">
                <div class="content-item">
                    <span class="label">체크인 &<br class="only_mo">
                        체크아웃 시간
                    </span>
                    <div class="description">
                        <p>체크인 : <strong>14:00</strong> 이전 <br>체크아웃 : <strong>12:00</strong> 이후<br>프런트 데스크 운영시간 :
                            연중무휴
                            24시간</p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        어린이 정책
                    </span>
                    <div class="description">
                        <p>본 객실 유행은 어린이 투숙이 불가합니다.</p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        유아용 침대 및 엑스트라 베드
                    </span>
                    <div class="description">
                        <p>객실 유형에 따라 침대 추가 및 유아용 침대 추가 정책이 다를 수 있습니다. 자세한 사항은 객실유형 정보를 참조하세요.</p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        조식
                    </span>
                    <div class="description">
                        <p>제공방식 : 뷔페<br>운영시간 : [월요일-금요일] 06:00~10:00 운영(토요일 ~일요일) 06:00~11:00</p>
                        <div class="table-container">
                            <table>
                                <thead>
                                <tr>
                                    <th>나이</th>
                                    <th>요금</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>성인</td>
                                    <td>1인당 THB 550.00(약 20,950원)</td>
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
                        <p>숙소 부과 보증금 없음</p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        반려동물
                    </span>
                    <div class="description">
                        <p>반려동물 동반 불가</p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        연령 제한
                    </span>
                    <div class="description">
                        <p>체크인하는 대표 투숙객의연령은 반드시 18세 이상이어야 합니다.</p>
                    </div>
                </div>
                <div class="content-item">
                    <span class="label">
                        흡연 정책
                    </span>
                    <div class="description">
                        <p>숙소에서 흡연이 불가능합니다.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="section6">
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
                        <a href="/product-hotel/hotel-detail/<?= $item['g_idx'] ?>"
                           class="sub_tour_section7_product_item swiper-slide swiper-slide-active" role="group"
                           aria-label="1 / 9" data-swiper-slide-index="0"
                           style="width: 393.333px; margin-right: 10px;">

                            <div class="img_box img_box_12">
                                <img src="/uploads/hotel/<?= $item['ufile1'] ?>" alt="main"
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
                                <?= $item['goods_name_front'] ?>
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
                                <?= number_format($item['price_se']) ?> <span>원~</span> <span
                                        class="prd_price_thai">6,000 <span>바트~</span></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
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
    </script>

<?php $this->endSection(); ?>