<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<?php $setting = homeSetInfo(); ?>
<div class="content-sub-hotel-detail tours-detail">
    <div class="body_inner">
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
                    <a class="active short_link" data-target="product_info" href="#product_info">상품예약</a>
                    <a class="short_link" data-target="product_des" href="#product_des">상품설명</a>
                    <a href="/product-tours/location_info/1324">위치정보</a>
                    <a class="short_link" href="">더투어랩리뷰</a>
                    <a class="short_link" href="">생생리뷰(159개)</a>
                    <a class="short_link" href="">상품Q&A</a>
                </div>
            </div>

        </div>
        <div class="section2" id="product_info">
            <h2 class="title-sec2">
                상품예약
            </h2>
            <?php foreach ($productTourInfo as $info ): 
                    $days = [];
                    if($info['info']['yoil_0'] == 'Y') {
                        $days[] = '일요일';
                    } 
                    if ($info['info']['yoil_1'] == 'Y') {
                        $days[] = '월요일';
                    }
                    if ($info['info']['yoil_2'] == 'Y') {
                        $days[] = '화요일';
                    }
                    if ($info['info']['yoil_3'] == 'Y') {
                        $days[] = '수요일';
                    }
                    if ($info['info']['yoil_4'] == 'Y') {
                        $days[] = '목요일';
                    }
                    if ($info['info']['yoil_5'] == 'Y') {
                        $days[] = '금요일';
                    }
                    if ($info['info']['yoil_6'] == 'Y') {
                        $days[] = '토요일';
                    }
            ?>
                <h2 class="sec2-date-main" id="tour-date-<?= substr($info['info']['o_sdate'], 0, 10) ?>" 
                    data-start-date="<?= substr($info['info']['o_sdate'], 0, 10) ?>" 
                    data-end-date="<?= substr($info['info']['o_edate'], 0, 10) ?>">
                    <?= substr($info['info']['o_sdate'], 0, 10) ?> ~ <?= substr($info['info']['o_edate'], 0, 10) ?>
                </h2>
                <p class="sec2-date-sub text-grey">*부가세/봉사료 포함가격입니다. 현장 결제는 불가능하며 사전 결제 후 예약확인서를 받아야 이용이 가능합니다.</p>
                <?php foreach ($info['tours'] as $tour): ?>
                    <div class="sec2-item-card">
                        <div class="text-content-1">
                            <h3><?= $tour['tours_subject'] ?></h3>
                            <del class="text-grey"><?= $info['info']['tour_info_price']?>원</del>
                        </div>
                        <div class="text-content-2">
                            <?php if (!empty($days)) { ?>
                            <span class="text-grey">요일 : <?= implode(', ', $days) ?></span>
                            <?php } ?>
                            <div class="price-sub">
                                <span class="ps-left text-grey"><?= $tour['price_baht']?>바트</span>
                                <span class="ps-right"><?= $tour['tour_price'] ?></span> <span class="text-grey">원</span>
                            </div>
                        </div>
                        <div class="text-content-3">
                            <button type="button" class="btn-ct-3" data-tour-index="<?= $tour['tours_idx'] ?>">선택</button>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- <div class="sec2-item-card">
                    <div class="text-content-1">
                        <h3>[조인] 아유타야에서 즐기는 아트 뮤지엄 + 선셋 투어</h3>
                        <del class="text-grey">202,043원</del>
                    </div>
                    <div class="text-content-2">
                        <span class="text-grey">요일 : 일, 수, 목, 금, 토</span>
                        <div class="price-sub">
                            <span class="ps-left text-grey">1,801바트</span>
                            <span class="ps-right">160,430</span> <span class="text-grey">원</span>
                        </div>
                    </div>
                    <div class="text-content-3">
                        <button class="btn-ct-3">선택</button>
                    </div>
                </div>
                <div class="sec2-item-card">
                    <div class="text-content-1">
                        <h3>[8인 이상 단독투어] 아유타이에서 즐기는 아트 뮤지엄 + 선셋투어</h3>
                        <del class="text-grey">202,043원</del>
                    </div>
                    <div class="text-content-2">
                        <span class="text-grey">요일 : 일, 수, 목, 금, 토</span>
                        <div class="price-sub">
                            <span class="ps-left text-grey">1,801바트</span>
                            <span class="ps-right">160,430</span> <span class="text-grey">원</span>
                        </div>
                    </div>
                    <div class="text-content-3-last">
                        <button class="btn-ct-3">선택</button>
                    </div>
                </div> -->
            <?php endforeach;?>
            <div class="sec2-item-card">
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
                            <div class="note-container">
                                <div class="first-note">
                                    <div class="ball-red-n"></div>
                                    <span>예약마감</span>
                                </div>
                                <div class="first-note">
                                    <div class="ball-blue-n"></div>
                                    <span> 특별요금</span>
                                </div>
                            </div>
                            <div class="form-below-calendar">
                                <label class="lb-18" for="">예약시간</label>
                                <select class="select-time-c">
                                    <option value="01">07:50 ~ 13:30</option>
                                </select>
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
                                                <span class="price"><?= $tour['tour_price'] ?>원</span>
                                                <span class="currency"><?= $tour['price_baht']?>바트</span>
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
                                                <span class="price"><?= $tour['tour_price_kids'] ?>원</span>
                                                <span class="currency"><?= $tour['price_baht_kids']?>바트</span>
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
                                                <span class="price"><?= $tour['tour_price_baby'] ?>원</span>
                                                <span class="currency"><?= $tour['price_baht_baby']?>바트</span>
                                            </div>
                                        </div>
                                        <div class="quantity-selector">
                                            <button class="decrease" disabled>-</button>
                                            <span class="quantity">0</span>
                                            <button class="increase">+</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php endforeach;?>
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
                                            <input type="checkbox" id="html">
                                            <label for="html"><?=$option['option_name']?></label>
                                        </div>
                                        <div class="quantity-info">
                                            <span class="price"><?=$option['option_price']?>원</span>
                                            <span class="currency"><?= $price_baht_option?>바트</span>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="above">
                                            <input type="checkbox" id="css">
                                            <label for="css">돈므앙&수완나품 공항 미팅 또는 샌딩(편도)</label>
                                        </div>
                                        <div class="quantity-info">
                                            <span class="price">160,430원</span>
                                            <span class="currency">1,801바트</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="above">
                                            <input type="checkbox" id="javascript">
                                            <label for="javascript">돈므앙&수완나품 공항 미팅/샌딩(왕복) | 성인 : 800바트</label>
                                        </div>
                                        <div class="quantity-info">
                                            <span class="price">160,430원</span>
                                            <span class="currency">1,801바트</span>
                                        </div>
                                    </div> -->
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
                    <button class="primary-btn-calendar"
                        onclick="location.href='/product-tours/order-form/1'">견적/예약하기</button>
                </div>
            </div>
            <!-- <h2 class="title-sec2">
                상품설명
            </h2>
            <h3 class="title-right">
                상품 포인트
            </h3> -->

        </div>
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
        <!-- <h2 class="title-sec2">
            공지사항
        </h2>
        <p class="des-type">- 미팅장소는 MBK G층 안쪽 Meeting point 광장입니다.
            <br>- 방콕은 교통체증이 고객님들께서 생각하시는 것보다 훨씬 심한 도시 중 한 곳입니다.
            <br>- 예상보다 차가 많이 막히고, 간혹 택시 기사님이 다른 곳으로 데려다줄 수 있으니 차량 이동보다는 지상철(BTS) / 지하철(MRT)을 이용해 주시는 것이 좋습니다.
        </p>
        <h2 class="title-sec2">
            무슨 투어인가요?
        </h2>
        <p class="des-type">
            한국인 전용 투어로, 한국어가 가능한 태국인 가이드의 인솔로 태국 고대도시 아유타야로 떠나는 투어입니다.<br>
            박물관에서 태국의 예술품을 관람하고, 왓 마하탓 사원을 관광하러 떠납니다.<br>
            왓 마하탓 사원 관광 후에는, 왓 라차부라나 뷰의 카페에서 맛있는 태국식사를 즐길 수 있습니다.<br>
            식사 후 선착장으로 이동하여 선셋보트에 탑승합니다.<br>
            선셋 보트 위에서 멋진 사원들과 아유타야의 일몰을 감상하실 수 있습니다.<br>
            이후 왓 프라스리산펫 사원의 밤의 모습을 잠시 관람 후 방콕으로 출발합니다.
        </p>
        <h2 class="title-sec2">
            어떤 분들에게 추천하나요?
        </h2>
        <p class="des-type">
            태국의 예술품이 궁금하신 분!<br>
            아유타야는 가보고싶은데, 하루 종일 더위에 시달리긴 싫은 분!<br>
            고대도시 아유타야의 선셋 & 야경을 즐기고 싶은 분!
        </p>
        <h2 class="title-sec2">
            ARTS OF THE KINGDOM
        </h2>
        <p class="des-type">
            박물관 내부 사진촬영은 [절대 금지] 입니다.<br>
            입장료 불포함이며, 현장 구매하셔야합니다. (성인 150바트, 60세이상 & 학생 75바트)<br>
            구매한지 7일 이내의 왕궁 티켓이 있을 경우 무료입장 가능합니다.<br>
            예) 11월7일(월) 티켓으로 11월13일(일) 까지 입장가능<br>
            60세 이상 또는 학생(대학생 포함)의 경우 할인 티켓 구매 가능하니 여권과 학생증 같이 준비해 주세요. (여권 사본 가능)<br>
            120cm 미만 아동 무료 입장
        </p>
        <h2 class="title-sec2">
            프랑 뷰(PRANG VIEW)
        </h2>
        <p class="des-type">
            *Toto SET Menu!*<br>
            식사 : 새우 볶음밥, 닭 볶음밥, 닭 바질볶음, 새우 바질볶음, 팟타이꿍(새우) / 택 1<br>
            음료 : Peach Lemon Tea, Ice Lemon Tea, Rose Lemon Tea, Thai Tea, Green Tea, Americano, Signature Coffee / 택
            1<br>
            - 1인당 식사 메뉴 1개, 음료 1잔 제공됩니다.<br>
            - 추가 비용 지불 후 타 메뉴로 변경은 어렵습니다.<br>
            - 식사만 혹은 음료만 이용하셔도 따로 할인되는 금액은 없습니다.<br>
            - 현장에서 Toto set 이외의 메뉴를 주문하신다면, 현장에서 직접 비용을 지불해주시면 됩니다.
        </p>
        <h2 class="title-sec2">
            선셋 크루즈
        </h2>
        <p class="des-type">
            투어는 선셋 크루즈 배정을 기본으로 진행하나, 탑승 인원이 초과되는 경우 당일 상황에 따라 안정성의 이유로 일부 인원은 롱테일 보트로 진행될 수 있습니다. (투어 비용 동일)
        </p>
        <h2 class="title-sec2">
            8인 이상 단독 투어 관련
        </h2>
        <p class="des-type">
            단독 투어로 진행해도 선셋 요트는 다른 팀과 조인하여 탑승합니다.<br>
            총 인원 8인까지는 성인/ 아동에 관계없이 성인 요금으로 지불하셔야 하고 9번째 인원부터 성인/ 아동 요금이 적용됩니다.<br>
            예시 1) 성인 4 + 아동 4 >> 성인 8인 요금으로 지불<br>
            예시 2) 성인 4 + 아동 5 >> 성인 8인 요금과 아동 1인 금액으로 지불<br>
            수완나품 및 돈므앙 공항 또는 공항 주변으로 샌딩 하는 경우 1 팀/차량 당 500바트 추가 비용 발생됩니다. (편도)<br>
            수완나품 및 돈므앙 공항 또는 공항 주변으로 픽업&샌딩 이용하시는 경우 1팀/차량 당 추가 비용은 800바트입니다. (왕복)<br>
            수완나품 공항 미팅 장소: 도착층 3번과 4번 게이트 사이에서 고객님의 영문 성함 피켓명을 찾아주세요.<br>
            돈무앙 공항 미팅 장소: 도착층 3번 게이트 앞 고객님의 영문 성함 피켓명을 찾아주세요.<br>
            인원이 많아 차량이 2대가 나가야 하는 경우, 차량 추가 요금이 발생합니다.
        </p> -->
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
        <?php if($product['product_able']) {?>
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
            어린이정책
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

            $('.quantity-container').each(function() {
                var $container = $(this);
                var $quantityDisplay = $container.find('.quantity');
                var $increaseBtn = $container.find('.increase');
                var $decreaseBtn = $container.find('.decrease');
                var quantity = 0;

                $increaseBtn.click(function() {
                    quantity++;
                    $quantityDisplay.text(quantity);
                    $decreaseBtn.removeAttr('disabled');
                });

                $decreaseBtn.click(function() {
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

            $(document).ready(function() {
                const $calendarDays = $('.calendar-days');
                const $monthYear = $('#month-year');
                const $prevMonthBtn = $('#prev-month');
                const $nextMonthBtn = $('#next-month');
                
                let s_date = null;
                let e_date = null;
                let productPrice = null;
                const currentDate = new Date();
                let selectedDate = null;

                const setTourDatesAndPrice = (startDate, endDate, price) => {
                    s_date = new Date(startDate);
                    e_date = new Date(endDate);
                    productPrice = price;
                    renderCalendar();
                };

                const initializeDefaultTour = () => {
                    const firstTourButton = $('.btn-ct-3').first();
                    const tourIndex = firstTourButton.data('tour-index'); 
                    const startDateId = `#tour-date-${firstTourButton.closest('.sec2-item-card').data('tour-index')}`; // Chỉnh sửa để lấy đúng tour index

                    console.log('Start Date ID:', startDateId); // Kiểm tra ID đang được lấy
                    const tourStartDate = $(startDateId).data('start-date');
                    const tourEndDate = $(startDateId).data('end-date');
                    const tourPrice = parseFloat(firstTourButton.closest('.sec2-item-card').find('.ps-right').text());
                    
                    console.log('Tour Start Date:', tourStartDate); // Kiểm tra giá trị start date
                    console.log('Tour End Date:', tourEndDate); // Kiểm tra giá trị end date
                    console.log('Tour Price:', tourPrice); // Kiểm tra giá trị price

                    setTourDatesAndPrice(tourStartDate, tourEndDate, tourPrice);
                };

                const renderCalendar = () => {
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

                        if (date < s_date || date > e_date) {
                            $dayDiv.addClass('disabled').append("<p>불가</p>");
                        } else {
                            $dayDiv.addClass('selectable').html(`<p class="selectable-day">${dayString}<p class="price1">${productPrice}원</p></p>`);

                            $dayDiv.click(() => {
                                $('.day').removeClass('active');
                                $dayDiv.addClass('active');
                                selectedDate = date;
                            });
                        }

                        $dayDiv.appendTo($calendarDays);
                    }
                };

                $('.btn-ct-3').click(function() {
                    const tourIndex = $(this).data('tour-index'); 
                    const startDateId = `#tour-date-${tourIndex}`;
                    const tourStartDate = $(startDateId).data('start-date');
                    const tourEndDate = $(startDateId).data('end-date');
                    const tourPrice = parseFloat($(this).closest('.sec2-item-card').find('.ps-right').text());

                    setTourDatesAndPrice(tourStartDate, tourEndDate, tourPrice);
                });

                $prevMonthBtn.click(() => {
                    currentDate.setMonth(currentDate.getMonth() - 1);
                    renderCalendar();
                });

                $nextMonthBtn.click(() => {
                    currentDate.setMonth(currentDate.getMonth() + 1);
                    renderCalendar();
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

                $(".short_link").on('click', function(evt) {
                    evt.preventDefault();
                    var target = $(this).data('target');
                    // $(window).scrollTop($('#' + target).offset().top - 100, 300);
                    $('html, body').animate({
                        scrollTop: $('#' + target).offset().top - 100
                    }, 'slow');
                    return false;
                });

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
                document.querySelectorAll('.btn-ct-3').forEach((button, index) => {
                    button.addEventListener('click', function() {
                        const tourIndex = this.getAttribute('data-tour-index');

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
    </script>

            </script>

        <?php $this->endSection(); ?>