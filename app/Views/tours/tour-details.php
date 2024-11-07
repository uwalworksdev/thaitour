<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<?php $setting = homeSetInfo(); ?>

<div class="content-sub-hotel-detail tours-detail">
    <div class="body_inner">
        <form name="frm" id="frm" action="/product-tours/customer-form" class="section1">
            <input type="hidden" name="product_idx" value="<?= $product['product_idx'] ?>">
            <input type="hidden" name="order_date" id="order_date" value="">
            <input type="hidden" name="option_idx" id="option_idx" value="">
            <input type="hidden" id="total_price" value="">
            <input type="hidden" id="total_price_baht" value="">
            <div class="section1">
                <div class="title-container">
                    <h2><?= viewSQ($product['product_name']) ?></h2>
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
                    <span><?=$product['addrs']?></span>
                </div>
                <div class="above-cus-content">
                    <div class="rating-container">
                        <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                        <span><strong> 4.7</strong></span>
                        <span>생생리뷰 <strong>(124)</strong></span>
                    </div>
                    <div class="list-icon only_mo">
                        <img src="/uploads/icons/print_icon.png" alt="print_icon">
                        <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                        <img src="/uploads/icons/share_icon.png" alt="share_icon">
                    </div>
                </div>
                <div class="hotel-image-container">
                    <div class="hotel-image-container-1" style="<?= $imgs[0] == '' ? 'visibility: hidden' : '' ?>">
                        <img src="<?= $imgs[0] ?>" alt="<?= $img_names[0] ?>">
                    </div>
                    <div class="grid_2_2">
                        <img class="grid_2_2_size" src="<?= $imgs[1] ?>" alt="<?= $img_names[1] ?>" style="<?= $imgs[1] == '' ? 'visibility: hidden' : '' ?>">
                        <img class="grid_2_2_size" src="<?= $imgs[2] ?>" alt="<?= $img_names[2] ?>" style="<?= $imgs[2] == '' ? 'visibility: hidden' : '' ?>">
                        <img class="grid_2_2_size" src="<?= $imgs[3] ?>" alt="<?= $img_names[3] ?>" style="<?= $imgs[3] == '' ? 'visibility: hidden' : '' ?>">
                        <div class="grid_2_2_sub" style="position: relative; cursor: pointer;<?= $imgs[4] == '' ? 'visibility: hidden;' : '' ?>" onclick="img_pops('<?= $product['product_idx'] ?>')">
                            <img class="custom_button" src="<?= $imgs[4] ?>" alt="<?= $img_names[4] ?>">
                            <div class="button-show-detail-image" style="<?= $imgs[5] == '' ? 'visibility: hidden' : '' ?>">
                                <img class="only_web" src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                                <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png" alt="image_detail_icon_m">
                                <span>사진 모두 보기</span>
                                <span>(<?= count($imgs) - 5 ?>장)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sub-header-hotel-detail">
                    <div class="main">
                        <a class="active short_link" data-target="product_info" href="/product-tours/item_view/<?= $product['product_idx']?>#product_info">상품예약</a>
                        <a class="short_link" data-target="product_des" href="/product-tours/item_view/<?= $product['product_idx']?>#product_des">상품설명</a>
                        <a href="/product-tours/location_info/<?= $product['product_idx']?>#section2">위치정보</a>
                        <!-- <a class="short_link" href="/product-tours/item_view/<?= $product['product_idx']?>">더투어랩리뷰</a> -->
                        <a class="short_link" href="/product-tours/location_info/<?= $product['product_idx']?>#section6">생생리뷰(159개)</a>
                        <a class="short_link" href="/product-tours/location_info/<?= $product['product_idx']?>#qa-section">상품Q&A</a>
                    </div>
                </div>

            </div>
            <div class="section2" id="product_info">
                <h2 class="title-sec2">
                    상품예약
                </h2>
                <?php foreach ($productTourInfo as $info ): 
                        $days = [];
                        $validDays = [];
                    
                        if($info['info']['yoil_0'] == 'Y') {
                            $days[] = '일요일';
                            $validDays[] = 0;
                        }
                        if ($info['info']['yoil_1'] == 'Y') {
                            $days[] = '월요일';
                            $validDays[] = 1;
                        }
                        if ($info['info']['yoil_2'] == 'Y') {
                            $days[] = '화요일';
                            $validDays[] = 2;
                        }
                        if ($info['info']['yoil_3'] == 'Y') {
                            $days[] = '수요일';
                            $validDays[] = 3;
                        }
                        if ($info['info']['yoil_4'] == 'Y') {
                            $days[] = '목요일';
                            $validDays[] = 4;
                        }
                        if ($info['info']['yoil_5'] == 'Y') {
                            $days[] = '금요일';
                            $validDays[] = 5;
                        }
                        if ($info['info']['yoil_6'] == 'Y') {
                            $days[] = '토요일';
                            $validDays[] = 6;
                        }
                ?>
                    <h2 class="sec2-date-main" id="tour-date-<?= substr($info['info']['o_sdate'], 0, 10) ?>" 
                        data-start-date="<?= substr($info['info']['o_sdate'], 0, 10) ?>" 
                        data-end-date="<?= substr($info['info']['o_edate'], 0, 10) ?>">
                        <?= substr($info['info']['o_sdate'], 0, 10) ?> ~ <?= substr($info['info']['o_edate'], 0, 10) ?>
                    </h2>
                    <p class="sec2-date-sub text-grey">*부가세/봉사료 포함가격입니다. 현장 결제는 불가능하며 사전 결제 후 예약확인서를 받아야 이용이 가능합니다.</p>
                    <?php foreach ($info['tours'] as $tour): ?>
                        <div class="sec2-item-card" data-tour-index="<?= $tour['tours_idx'] ?>">
                            <div class="text-content-1">
                                <h3><?= $tour['tours_subject'] ?></h3>
                                <del class="text-grey"><?= $info['info']['tour_info_price']?>원</del>
                            </div>
                            <div class="text-content-2">
                                    <span class="text-grey">요일 : <?= implode(', ', $days) ?></span>
                                <div class="price-sub">
                                    <span class="ps-left text-grey"><?= $tour['price_baht']?>바트</span>
                                    <span class="ps-right"><?= number_format($tour['tour_price']) ?></span> <span class="text-grey">원</span>
                                </div>
                            </div>
                            <div class="text-content-3">
                                <button type="button" class="btn-ct-3" data-tour-index="<?= $tour['tours_idx'] ?>" data-valid-days="<?= implode(',', $validDays) ?>">선택</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach;?>
                <div class="sec2-item-card tour_calendar">
                    <div class="container-calendar tour">
                        <div class="calendar-left">
                            <h3 class="title-left">
                                이용일자 선택
                            </h3>
                            <div class="calendar-container">
                                <div class="calendar-header">
                                    <div id="prev-month" class="btn-action-calendar">
                                        <img src="/uploads/icons/tour-left_icon.png" alt="tour-left_icon">
                                    </div>
                                    <span id="month-year"></span>
                                    <div id="next-month" class="btn-action-calendar">
                                        <img src="/uploads/icons/tour-right_icon.png" alt="tour-right_icon">
                                    </div>
                                </div>
                                <div class="calendar-body">
                                    <div class="calendar-weekdays">
                                        <div class="text-red-cus">일</div>
                                        <div>월</div>
                                        <div>화</div>
                                        <div>수</div>
                                        <div>목</div>
                                        <div>금</div>
                                        <div class="text-blue-cus">토</div>
                                    </div>
                                    <div class="calendar-days"></div>
                                </div>
                            </div>
        
                        </div>
        
                        <div class="calendar-right">
                            <h3 class="title-right">
                                인원 선택
                            </h3>
                            <?php foreach ($productTourInfo as $infoIndex => $info): ?>
                                    <?php foreach ($info['tours'] as $tourIndex => $tour): ?>
                                        <div class="quantity-container-fa" data-tour-index="<?= $tour['tours_idx'] ?>" style="<?= $tourIndex === 0 ? 'display: block;' : 'display: none;' ?>">
                                            <div class="quantity-container">
                                                <div class="quantity-info-con">
                                                    <span class="des">성인, Adult (키 120cm 이상)</span>
                                                    <div class="quantity-info">
                                                        <span class="price" data-price="<?= $tour['tour_price'] ?>"><?= number_format($tour['tour_price']) ?>원</span>
                                                        <span class="currency" data-price-baht="<?= $tour['price_baht'] ?>"><?= number_format($tour['price_baht']) ?>바트</span>
                                                    </div>
                                                </div>
                                                <div class="quantity-selector">
                                                    <button class="decrease" disabled>-</button>
                                                    <span class="quantity">0</span>
                                                    <button class="increase">+</button>
                                                </div>
                                            </div>
                                            <div class="quantity-container">
                                                <div class="quantity-info-con">
                                                    <span class="des">아동, Child (키 91~119cm)</span>
                                                    <div class="quantity-info">
                                                        <span class="price" data-price="<?= $tour['tour_price_kids'] ?>"><?= number_format($tour['tour_price_kids']) ?>원</span>
                                                        <span class="currency" data-price-baht="<?= $tour['price_baht_kids'] ?>"><?= number_format($tour['price_baht_kids']) ?>바트</span>
                                                    </div>
                                                </div>
                                                <div class="quantity-selector">
                                                    <button class="decrease" disabled>-</button>
                                                    <span class="quantity">0</span>
                                                    <button class="increase">+</button>
                                                </div>
                                            </div>
                                            <div class="quantity-container">
                                                <div class="quantity-info-con">
                                                    <span class="des">유아, baby (키 90cm 이하)</span>
                                                    <div class="quantity-info">
                                                        <span class="price" data-price="<?= $tour['tour_price_baby'] ?>"><?= number_format($tour['tour_price_baby']) ?>원</span>
                                                        <span class="currency" data-price-baht="<?= $tour['price_baht_baby'] ?>"><?= number_format($tour['price_baht_baby']) ?>바트</span>
                                                    </div>
                                                </div>
                                                <div class="quantity-selector">
                                                    <button class="decrease" disabled>-</button>
                                                    <span class="quantity">0</span>
                                                    <button class="increase">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>

                            <h3 class="title-second">선택옵션</h3>
                            <form>
                                <?php foreach ($options as $row_option): ?>
                                    <?php foreach ($row_option['additional_options'] as $option): 
                                                    $baht_thai = (float)($setting['baht_thai'] ?? 0);
                                                    $option_price = (float)$option['option_price'];
                                                    $price_baht_option = round($option_price / $baht_thai);
                                    ?>
                                        <div class="form-group">
                                            <div class="above">
                                                <input type="checkbox" id="<?=$option['idx']?>">
                                                <label for="<?=$option['idx']?>"><?=$option['option_name']?></label>
                                            </div>
                                            <div class="quantity-info">
                                                <span class="price"><?=$option['option_price']?>원</span>
                                                <span class="currency"><?= $price_baht_option?>바트</span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </form>
                            <div class="des-below text-gray">
                                <p>
                                    ※ 본 상품은 1인 이상 예약 가능합니다.
                                </p>
                                <p>
                                    ※ 최소 4인 이상 모객시 출발 가능한 상품입니다. 출발 하루전까지 최소 인원 미달시
                                </p>
                                <p>취소될 수 있습니다. 출발이 불가능할 경우 개별 연락을 통해 일정 변경/취소 안내드립니다.</p>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="primary-btn-calendar tour">견적/예약하기</button>
                </div>
                <div class="sec2-item-card order-form-page" style="display: none">
                    <div class="container-calendar">
                        <div class="main-order-form">
                            <div class="main-order-form-container">
                                <h1>선택하신 날짜에 즉시확정 예약이 가능합니다.</h1>
                                <p class="text-grey">예약 즉시 결제가 가능하며, 엄격하게 관련 예약정책이 발생됩니다.</p>
                            </div>

                            <h2 class="title-above-tb">예약정보</h2>
                            <div class="two-table-tb">
                                <table class="info-table-order">
                                    <tr>
                                        <th>이용일</th>
                                        <td class="days_choose" id="days_choose"></td>
                                    </tr>
                                    <tr>
                                        <th>상품명</th>
                                        <td class="name_product" id="name_product"><?= $product['product_name']?></td>
                                    </tr>
                                    <tr>
                                        <th>선택옵션</th>
                                        <td class="option" id="product_option"></td>
                                    </tr>
                                    <tr>
                                        <th>총인원</th>
                                        <td class="num_people" id="num_people"></td>
                                    </tr>
                                    <tr>
                                        <th>회원등급 할인</th>
                                        <td>없음</td>
                                    </tr>
                                    <!-- <tr>
                                        <th>예약시간</th>
                                        <td>15:00 ~ 18:30</td>
                                    </tr> -->
                                    <!-- <tr>
                                        <th>픽업</th>
                                        <td>포함 (왕복)</td>
                                    </tr> -->
                                </table>
                                <div class="">
                                    <table class="info-table-order info-table-cus-padding">
                                        <tr>
                                            <th>미팅장소</th>
                                            <td>
                                                <input type="text" placeholder="호텔명을 영어로 적어주세요(주소불가)" name="start_place" id="start_place">
                                                <span class="note">*일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요.</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>미팅 시간</th>
                                            <td><input type="text" name="metting_time" id="metting_time"></td>
                                        </tr>
                                        <tr>
                                            <th>종료 후 내리실 곳</th>
                                            <td><input type="text" placeholder="종료 후 내리실 곳 항목은 필수입력입니다." name="end_place" id="end_place"></td>
                                        </tr>
                                        <tr>
                                            <th>카카오톡 아이디</th>
                                            <td>
                                                <input type="text" placeholder="카카오톡 아이디 항목은 선택 입력입니다." name="id_kakao" id="id_kakao">
                                                <span class="note">*입력하시면 투어진행업체에서 보다 원활하게 연락을 드릴 수 있습니다.</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>기타 요청</th>
                                            <td>
                                                <span class="lb-tb-cus">원하는 미팅 시간을 적어주세요(15:30분 이후)</span>
                                                <textarea class="textarea-tb" rows="5" placeholder="" name="id_kakao" id="id_kakao">
                                            </textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    <p class="summary-tb">*취소규정: 결제 후 취소하시려면 결제하신 금액의 50% 요금이 부과됩니다.</p>
                                    <p class="summary-tb2">본 예약건 취소규정 자세히보기</p>
                                </div>
                            </div>
                        </div>
                        <div class="container-below-tb">
                            <button type="button" class="primary-btn-sub" onclick="location.href=''">이 상품만 예약하기</button>
                            <button type="button" class="primary-btn-calendar" onclick="location.href=''">견적/예약하기</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <h2 class="title-sec3" id="product_des">
            상품설명
        </h2>
        <?php if($product['tours_guide'] == 'Y' || $product['tours_ko'] == 'Y' || $product['tours_join'] == 'Y' || $product['tours_total_hour'] == 'Y') {?>
            <h3 class="title-sec2">
                상품 포인트
            </h3>
            <div class="list-tag-item">
                <?php if($product['tours_guide'] == 'Y') {?>
                <div class="tag-item">
                    <div class="picture">
                        <img src="/uploads/sub/tour_item_1.png" alt="tour_item_1">
                    </div>
                    <span class="label-tag">가이드 유</span>
                </div>
                <?php } if($product['tours_ko'] == 'Y') { ?>
                <div class="tag-item">
                    <div class="picture">
                        <img src="/uploads/sub/tour_item_2.png" alt="tour_item_2">
                    </div>
                    <span class="label-tag">한국어</span>
                </div>
                <?php } if($product['tours_join'] == 'Y') { ?>
                <div class="tag-item">
                    <div class="picture">
                        <img src="/uploads/sub/tour_item_3.png" alt="tour_item_3">
                    </div>
                    <span class="label-tag">조인투어</span>
                </div>
                <?php } if($product['tours_total_hour'] == 'Y') { ?>
                    <div class="tag-item">
                        <div class="picture">
                            <img src="/uploads/sub/tour_item_4.png" alt="tour_item_4">
                        </div>
                        <span class="label-tag">총 <?= $product['tours_hour']?>시간</span>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if($product['tour_info']) {?>
            <div>
                <?= viewSQ($product['tour_info']) ?>
            </div>
        <?php }?>
        <?php if (!empty($imgs_tour)): ?>
            <h2 class="title-sec2 tit-swip-pic">
                투어 사진
            </h2>
            <div class="container-pic-slider">
                <div class="swiper-container_tour_content">
                    <div class="swiper-wrapper">
                        <?php foreach ($imgs_tour as $index => $img_tour): ?>
                            <div class="swiper-slide">
                                <img src="<?= $img_tour ?>" alt="tour_details_<?= $index + 1 ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-tour_content-pagination"></div>
                </div>
            </div>
        <?php endif; ?>
        <?php if($product['product_confirm']) { ?>
            <h2 class="title-sec2">
                미팅/픽업장소 안내
            </h2>
            <div class="des-type-1">
                <p>
                    <?= viewSQ($product['product_confirm'])?>
                </p>
            </div>
        <?php } ?>
        <?php if($totalDays) {?>
            <h2 class="title-sec2">
                투어 일정표
            </h2>
            <?php for ($dd = 1; $dd <= $totalDays; $dd++): ?>
                <?php
                    $schedule = $schedules[$dd] ?? null;
                ?>
                <span class="tit-blue"><?= $schedule['detail_title']?></span>
                <ul class="timeline-con">
                    <?php
                    $groups = $subSchedules[$dd] ?? [];
                    foreach ($groups as $groupKey => $group):
                    ?>
                        <?php foreach ($group as $row_ds): ?>
                        <li class="timeline-item">
                            <span class="time-l"><?= viewSQ($row_ds['detail_hour']) ?></span>
                            <span class="des-l"><?= viewSQ($row_ds['detail_summary']) ?></span>
                        </li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endfor; ?>
        <?php } ?>
        <h2 class="title-sec2">
            포함/불포함 사항
        </h2>
        <?php if($product['product_able'] && $product['product_able'] != "&lt;p&gt;&nbsp;&lt;/p&gt;") {?>
        <div class="tit-blue-type-2">
            <span class="tit-blue">포함사항</span>
        </div>
        <div class="des-type">
            <?= viewSQ($product['product_able'])?>
        </div>
        <?php } ?>
        <?php if($product['product_unable']) {?>
        <div class="tit-blue-type-2">
            <span class="tit-blue">불포함 사항</span>
        </div>
        <div class="des-type">
            <?= viewSQ($product['product_unable'])?>
        </div>
        <?php } ?>
        <?php if($product['mobile_able']) {?>
        <h2 class="title-sec2">
            추가정보 및 참고사항
        </h2>
        <div class="des-type">
            <?= viewSQ($product['mobile_able'])?>
        </div>
        <?php } ?>
        <?php if($product['special_benefit']) {?>
        <h2 class="title-sec2">
            어린이정책
        </h2>
        <div class="des-type">
            <?= viewSQ($product['special_benefit'])?>
        </div>
        <?php } ?>
        <?php if($product['notice_comment']) {?>
        <h2 class="title-sec2">
            유의사항
        </h2>
        <div class="des-type">
            <?= viewSQ($product['notice_comment'])?>
        </div>
        <?php } ?>
        <?php if($product['etc_comment']) {?>
        <h2 class="title-sec2">
            더투어랩 이용방법
        </h2>
        <div class="des-type">
            <?= viewSQ($product['etc_comment'])?>
        </div>
        <?php } ?>
        <div class="steps-type">
            <div class="step-type">
                <div class="con-step">
                    <img src="/uploads/sub/step_img1.png" alt="step_img1">
                </div>
                <span class="step-label">예약신청</span>
                <span class="number-step">1</span>
                <div class="cus-step-note">
                    <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                    <span class="txt-step-note">기능유무조회</span>
                </div>
            </div>
            <div class="step-type">
                <div class="con-step">
                    <img src="/uploads/sub/step_img2.png" alt="step_img2">
                </div>
                <span class="step-label">예약신청</span>
                <span class="number-step">2</span>
                <div class="cus-step-note">
                    <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                    <span class="txt-step-note">결제</span>
                </div>
            </div>

            <div class="step-type">
                <div class="con-step">
                    <img src="/uploads/sub/step_img3.png" alt="step_img2">
                </div>
                <span class="step-label">예약신청</span>
                <span class="number-step">3</span>
                <div class="cus-step-note">
                    <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                    <span class="txt-step-note">확정 후</span>
                </div>
            </div>
            <div class="step-type">
                <div class="con-step">
                    <img src="/uploads/sub/step_img4.png" alt="step_img2">
                </div>
                <span class="step-label">예약신청</span>
                <span class="number-step">4</span>
            </div>
        </div>
        <div id="dim"></div>
        <div id="popup_img" class="on">
            <strong id="pop_roomName"></strong>
            <div>
                <ul class="multiple-items">
                    <?php foreach ($imgs as $img) {
                        echo "<li><img src='" . $img . "' alt='' /></li>";
                    } ?>
                </ul>
            </div>
            <a class="closed_btn" href="javaScript:void(0)"><img src="/images/ico/close_ico_w.png" alt="close"/></a>
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

            $('.list-icon img[alt="heart_icon"]').click(function() {
                if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
                    $(this).attr('src', '/uploads/icons/heart_on_icon.png');
                } else {
                    $(this).attr('src', '/uploads/icons/heart_icon.png');
                }
            });

            const swiper_content = new Swiper(".swiper-container_tour_content", {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 100,
                pagination: {
                    el: ".swiper-tour_content-pagination",
                },
            });

            $(document).ready(function() {
                var adultQuantity = 1;
                var childQuantity = 0;
                var babyQuantity = 0;

                function updateTotalPeopleDisplay() {
                    var totalPeople = adultQuantity + childQuantity + babyQuantity;
                    var numText = `${totalPeople}명 (성인: ${adultQuantity}, 아이: ${childQuantity}, 아기: ${babyQuantity})`;
                    $('.num_people').text(numText);
                }

                $('.quantity-container').each(function() {
                    var $container = $(this);
                    var $quantityDisplay = $container.find('.quantity');
                    var $increaseBtn = $container.find('.increase');
                    var $decreaseBtn = $container.find('.decrease');
                    var pricePerUnit = parseFloat($container.find('.price').data('price'));
                    var priceBahtPerUnit = parseFloat($container.find('.currency').data('price-baht'));

                    var quantity = parseInt($quantityDisplay.text());
                    var $price = $container.find('.price');
                    var $currency = $container.find('.currency');

                    if ($container.find('.des').text().includes('성인') && quantity === 0) {
                        quantity = 1; 
                        adultQuantity = quantity;
                        $quantityDisplay.text(quantity);
                        $decreaseBtn.removeAttr('disabled');
                    }

                    updatePrice();

                    $increaseBtn.click(function() {
                        quantity++;
                        $quantityDisplay.text(quantity);
                        $decreaseBtn.removeAttr('disabled');
                        updateQuantity($container, quantity);
                        updatePrice();
                    });

                    $decreaseBtn.click(function() {
                        if (quantity > 0) {
                            quantity--;
                            $quantityDisplay.text(quantity);
                        }
                        if (quantity === 0) {
                            $decreaseBtn.attr('disabled', true);
                        }
                        updateQuantity($container, quantity);
                        updatePrice();
                    });

                    function updateQuantity($container, quantity) {
                        if ($container.find('.des').text().includes('성인')) {
                            adultQuantity = quantity;
                        } else if ($container.find('.des').text().includes('아동')) {
                            childQuantity = quantity;
                        } else if ($container.find('.des').text().includes('유아')) {
                            babyQuantity = quantity;
                        }
                        updateTotalPeopleDisplay();
                    }

                    function updatePrice() {
                        var totalPrice = quantity * pricePerUnit;
                        var totalPriceBaht = quantity * priceBahtPerUnit;

                        $price.text(number_format(totalPrice) + '원');
                        $currency.text(number_format(totalPriceBaht) + '바트');
                    }
                });

                function number_format(number) {
                    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }

                updateTotalPeopleDisplay();

                $('input[type="checkbox"]').change(function() {
                    updateOptionText();
                });

                function updateOptionText() {
                    var selectedOptions = [];

                    $('input[type="checkbox"]:checked').each(function() {
                        var optionContainer = $(this).closest('.form-group');
                        var optionName = optionContainer.find('label').text();
                        var optionPrice = parseFloat(optionContainer.find('.price').text().replace('원', '').replace(',', ''));
                        var optionBaht = parseFloat(optionContainer.find('.currency').text().replace('바트', '').replace(',', ''));

                        selectedOptions.push(`${optionName} ${number_format(optionPrice)}원 (${number_format(optionBaht)}바트)`);
                    });

                    var optionText = selectedOptions.length > 0 ? selectedOptions.join(' + ') : "선택된 옵션이 없습니다.";
                    $('td.option').text(optionText);
                }

                function number_format(number) {
                    return number.toLocaleString('ko-KR');
                }
            });

            $(document).ready(function() {
                const $calendarDays = $('.calendar-days');
                const $monthYear = $('#month-year');
                const $prevMonthBtn = $('#prev-month');
                const $nextMonthBtn = $('#next-month');
                const $selectedDayElement = $('.days');
                
                let s_date = null;
                let e_date = null;
                let productPrice = null;
                let productPriceBaht = null;
                const currentDate = new Date();
                let selectedDate = null;

                const setTourDatesAndPrice = (startDate, endDate, price, priceBaht, validDays) => {
                    s_date = new Date(startDate);
                    e_date = new Date(endDate);
                    productPrice = price;
                    productPriceBaht = priceBaht;
                    renderCalendar(validDays);
                };

                const initializeDefaultTour = () => {
                    const firstTourDateElement = $('.sec2-date-main').first();
                    const tourStartDate = firstTourDateElement.data('start-date');
                    const tourEndDate = firstTourDateElement.data('end-date');
                    
                    const firstTourCard = $('.sec2-item-card').first();
                    const tourPriceText = firstTourCard.find('.ps-right').text().trim().replace(/,/g, ''); 
                    const tourPrices = parseFloat(tourPriceText) / 10000;
                    const tourPrice = parseFloat(tourPrices.toFixed(1));

                    const tourPriceTextBath = firstTourCard.find('.ps-left').text().trim().replace(/,/g, '');
                    const tourPriceBaht = parseFloat(tourPriceTextBath);

                    const validDays = firstTourCard.find('.btn-ct-3').data('valid-days').split(',').map(Number);
                    setTourDatesAndPrice(tourStartDate, tourEndDate, tourPrice, tourPriceBaht, validDays);
                };

                const renderCalendar = (validDays) => {
                    $calendarDays.empty();
                    const month = currentDate.getMonth();
                    const year = currentDate.getFullYear();

                    const monthNames = ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"];
                    $monthYear.text(`${year}년 ${monthNames[month]}`);

                    const firstDay = new Date(year, month, 1).getDay();
                    const lastDate = new Date(year, month + 1, 0).getDate();

                    for (let i = 0; i < firstDay; i++) {
                        $('<div/>').appendTo($calendarDays);
                    }

                    for (let day = 1; day <= lastDate; day++) {
                        const dayString = day.toString().padStart(2, '0');
                        const $dayDiv = $('<div/>').text(dayString).addClass('day');
                        const date = new Date(year, month, day);

                        if (date < s_date || date > e_date || !validDays.includes(date.getDay())) {
                            $dayDiv.addClass('disabled').append("<p>예약마감</p>");
                        } else {
                            $dayDiv.addClass('selectable').html(`<p class="selectable-day">${dayString}<p class="price1">${number_format(productPrice)}만원</p><p class="price2">(${number_format(productPriceBaht)}바트)</p></p>`);

                            $dayDiv.click(() => {
                                $('.day').removeClass('active');
                                $dayDiv.addClass('active');
                                selectedDate = date;

                                const formattedDate = formatSelectedDate(date);
                                $('td.days_choose').text(formattedDate);
                            });
                        }

                        $dayDiv.appendTo($calendarDays);
                    }
                };

                function formatSelectedDate(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    const dayOfWeek = ["일", "월", "화", "수", "목", "금", "토"][date.getDay()];
                    return `${year}.${month}.${day}(${dayOfWeek})`;
                }

                $('.btn-ct-3').click(function() {
                    const tourCard = $(this).closest('.sec2-item-card');
                    const tourDateElement = tourCard.prevAll('.sec2-date-main').first();
                    const tourStartDate = tourDateElement.data('start-date');
                    const tourEndDate = tourDateElement.data('end-date');

                    const tourPriceText = tourCard.find('.ps-right').text().trim().replace(/,/g, '');
                    const tourPrices = parseFloat(tourPriceText) / 10000;
                    const tourPrice = parseFloat(tourPrices.toFixed(1));

                    const tourPriceTextBaht = tourCard.find('.ps-left').text().trim().replace(/,/g, ''); 
                    const tourPriceBaht = parseFloat(tourPriceTextBaht);

                    const validDays = $(this).data('valid-days').split(',').map(Number);
                    setTourDatesAndPrice(tourStartDate, tourEndDate, tourPrice, tourPriceBaht, validDays);
                });

                $prevMonthBtn.click(() => {
                    currentDate.setMonth(currentDate.getMonth() - 1);
                    renderCalendar();
                });

                $nextMonthBtn.click(() => {
                    currentDate.setMonth(currentDate.getMonth() + 1);
                    renderCalendar();
                });

                function checkDateSelected() {
                    if (!selectedDate) {
                        alert('달력 선택해주세요!');
                        return false;
                    }
                    return true;
                }

                $('.primary-btn-calendar.tour').click(function() {
                    if (checkDateSelected()) {
                        $('.sec2-item-card.tour_calendar').hide();
                        $('.sec2-item-card.order-form-page').show();
                    }
                });

                initializeDefaultTour();
            });

        </script>
        <script>
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

                // $(".short_link").on('click', function(evt) {
                //     evt.preventDefault();
                //     var target = $(this).data('target');
                //     // $(window).scrollTop($('#' + target).offset().top - 100, 300);
                //     $('html, body').animate({
                //         scrollTop: $('#' + target).offset().top - 100
                //     }, 'slow');
                //     return false;
                // });

            });

            function img_pops(idx) {
            var dim = $('#dim');
            var popup = $('#popup_img');

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
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const allContainers = document.querySelectorAll('.calendar-right .quantity-container-fa');
                const sec2Items = document.querySelectorAll('.sec2-item-card');
                
                allContainers.forEach(container => {
                    container.style.display = 'none';
                });

                const firstContainer = document.querySelector('.calendar-right .quantity-container-fa');
                if (firstContainer) {
                    firstContainer.style.display = 'block';
                }

                if (sec2Items.length > 0) {
                    sec2Items[0].classList.add('active');
                }

                document.querySelectorAll('.btn-ct-3').forEach((button) => {
                    button.addEventListener('click', function() {
                        const tourIndex = this.getAttribute('data-tour-index');

                        sec2Items.forEach(sec2Item => {
                            sec2Item.classList.remove('active');
                        });

                        const selectedSec2Item = document.querySelector(`.section2 .sec2-item-card[data-tour-index="${tourIndex}"]`);
                        if (selectedSec2Item) {
                            selectedSec2Item.classList.add('active');
                        }


                        document.querySelectorAll('.calendar-right .quantity-container-fa').forEach(container => {
                            container.style.display = 'none';
                        });

                        const selectedContainer = document.querySelector(`.calendar-right .quantity-container-fa[data-tour-index="${tourIndex}"]`);
                        if (selectedContainer) {
                            selectedContainer.style.display = 'block';
                        }
                    });
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.short_link');

                links.forEach(link => {
                    link.addEventListener('click', function() {
                        links.forEach(link => link.classList.remove('active'));
                        this.classList.add('active');
                    });
                });
            });
        </script>

        <?php $this->endSection(); ?>