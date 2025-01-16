<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<?php $setting = homeSetInfo(); ?>
<input type="hidden" name="product_idx" id="product_idxs" value="<?= $product['product_idx']?>">
<div class="content-sub-hotel-detail tours-detail">
    <div class="body_inner">
        <form name="frm" id="frm" action="/product-tours/confirm-info" class="">
            <input type="hidden" name="product_idx" value="<?= $product['product_idx'] ?>">
            <input type="hidden" name="order_date" id="order_date" value="">
            <input type="hidden" name="tours_idx" id="tours_idx" value="">
            <input type="hidden" name="idx" id="idx" value="">
            <input type="hidden" id="total_price" value="">
            <input type="hidden" id="total_price_baht" value="">
            <input type="hidden" name="people_adult_cnt" id="people_adult_cnt" value="">
            <input type="hidden" name="people_kids_cnt" id="people_kids_cnt" value="">
            <input type="hidden" name="people_baby_cnt" id="people_baby_cnt" value="">
            <input type="hidden" name="people_adult_price" id="people_adult_price" value="">
            <input type="hidden" name="people_kids_price" id="people_kids_price" value="">
            <input type="hidden" name="people_baby_price" id="people_baby_price" value="">
            <input type="hidden" name="time_line" id="time_line" value="">
            <input type="hidden" name="total_pay" id="total_pay" value="">
            <input type="hidden" name="use_coupon_idx" id="use_coupon_idx" value="">
            <input type="hidden" name="final_discount" id="final_discount" value="">
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
                        <span><strong> <?= $product['review_average'] ?></strong></span>
                        <span>생생리뷰 <strong>(<?= $product['total_review'] ?>)</strong></span>
                        <?php
                        $_arr = explode("|", $product['mbti']);

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
                        <a class="short_link" href="/product-tours/location_info/<?= $product['product_idx']?>#section6">생생리뷰(<?= $product['total_review'] ?>개)</a>
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
                                <del class="text-grey"><?= number_format($info['info']['tour_info_price'] * $setting['baht_thai'])?>원</del>
                            </div>
                            <div class="text-content-2">
                                    <span class="text-grey">요일 : <?= implode(', ', $days) ?></span>
                                <div class="price-sub">
                                    <span class="ps-left text-grey"><?= number_format($tour['tour_price'])?> 바트</span>
                                    <span class="ps-right"><?= number_format($tour['price_won']) ?></span> <span class="text-grey">원</span>
                                </div>
                            </div>
                            <div class="text-content-3">
                                <button type="button" class="btn-ct-3" data-tour-index="<?= $tour['tours_idx'] ?>" data-valid-days="<?= implode(',', $validDays) ?>">선택</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach;?>
                <div class="sec2-item-card tour_calendar" id="tour_calendar">
                    <div class="container-calendar tour">
                        <div class="calendar-left">
                            <h3 class="title-left calendar_txt">
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
                            <div class="des-below text-gray spe">
                                <p>
                                    ※ 본 상품은 1인 이상 예약 가능합니다.
                                </p>
                                <p>
                                    ※ 최소 4인 이상 모객시 출발 가능한 상품입니다. 출발 하루전까지 최소 인원 미달시
                                </p>
                                <p>취소될 수 있습니다. 출발이 불가능할 경우 개별 연락을 통해 일정 변경/취소 안내드립니다.</p>
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
                                                    <span class="des">성인, Adult (키 120cm 이상1)</span>
                                                    <div class="quantity-info">
                                                        <span class="price" data-price="<?= $tour['price_won'] ?>"><?= number_format($tour['price_won']) ?>원</span>
                                                        <span class="currency" data-price-baht="<?= $tour['tour_price'] ?>"><?= number_format($tour['tour_price']) ?>바트</span>
                                                    </div>
                                                </div>
                                                <div class="quantity-selector">
                                                    <button type="button" class="decrease" disabled>-</button>
                                                    <span class="quantity">0</span>
                                                    <button type="button" class="increase">+</button>
                                                </div>
                                            </div>
                                            <div class="quantity-container">
                                                <div class="quantity-info-con">
                                                    <span class="des">아동, Child (키 91~119cm)</span>
                                                    <div class="quantity-info">
                                                        <span class="price" data-price="<?= $tour['price_won_kids'] ?>"><?= number_format($tour['price_won_kids']) ?>원</span>
                                                        <span class="currency" data-price-baht="<?= $tour['tour_price_kids'] ?>"><?= number_format($tour['tour_price_kids']) ?> 바트</span>
                                                    </div>
                                                </div>
                                                <div class="quantity-selector">
                                                    <button type="button" class="decrease" disabled>-</button>
                                                    <span class="quantity">0</span>
                                                    <button type="button" class="increase">+</button>
                                                </div>
                                            </div>
                                            <div class="quantity-container">
                                                <div class="quantity-info-con">
                                                    <span class="des">유아, baby (키 90cm 이하)</span>
                                                    <div class="quantity-info">
                                                        <span class="price" data-price="<?= $tour['price_won_baby'] ?>"><?= number_format($tour['price_won_baby']) ?> 원</span>
                                                        <span class="currency" data-price-baht="<?= $tour['tour_price_baby'] ?>"><?= number_format($tour['tour_price_baby']) ?> 바트 </span>
                                                    </div>
                                                </div>
                                                <div class="quantity-selector">
                                                    <button type="button" class="decrease" disabled>-</button>
                                                    <span class="quantity">0</span>
                                                    <button type="button" class="increase">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                            <?php endforeach; ?>

                            <h3 class="title-second">선택옵션</h3>
                                <form>
                                        <!-- <div class="form-group">
                                            <div class="above">
                                                <input type="checkbox" id="<?=$option['idx']?>">
                                                <label for="<?=$option['idx']?>"><?=$option['option_name']?></label>
                                            </div>
                                            <div class="quantity-info">
                                                <span class="price"><?=$option['option_price']?>원</span>
                                                <span class="currency"><?= $price_baht_option?>바트</span>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <select name="moption" id="moption" onchange="sel_moption(this.value);">
                                                <option value="">옵션선택</option>
                                                    <?php foreach ($options as $row_option): ?>
                                                        <?php 
                                                        // foreach ($row_option['additional_options'] as $option): 
                                                        //                 $baht_thai = (float)($setting['baht_thai'] ?? 0);
                                                        //                 $option_price = (float)$option['option_price'];
                                                        //                 $price_baht_option = round($option_price / $baht_thai);
                                                        ?>
                                                        <option value="<?=$row_option['code_idx']?>">
                                                            <?=$row_option['moption_name'] ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    <?php 
                                                        // endforeach; 
                                                    ?>
                                            </select>
                                            <div class="opt_select disabled sel_option" id="sel_option">
                                                <select name="option" id="option" onchange="sel_option(this.value);">";
                                                    <option value="">옵션 선택</option>
                                                </select>
                                            </div>
                                        <div class="list_schedule_" id="option_list_">
                                            <?php
                                            if (isset($data['option_idx'])) {
                                                $num = count($data['option_idx']);
                                                for ($i = 0; $i < $num; $i++) {
                                                    $item = $data['option_idx'][$i];
                                                    ?>
                                                    <div class="schedule cus-count-input" id="schedule_<?= $item ?>">
                                                        <div class="wrap-text">
                                                            <span>옵션</span>
                                                            <p><?= $data['option_name'][$i] ?></p>
                                                        </div>
                                                        <div class="wrap-btn opt_count_box count_box flex__c">
                                                            <img onclick="minusQty(this)" class="minusQty"
                                                                src="/images/sub/minus-ic.png"
                                                                alt="">
                                                            <span>
                                                            <input style="text-align: center;" type="text"
                                                                class="form-control input_qty" name="option_qty[]"
                                                                data-price="<?= $data['option_price'][$i] ?>"
                                                                id="input_qty" readonly value="<?= $data['option_qty'][$i] ?>">
                                                            </span>
                                                            <img onclick="plusQty(this)" class="plusQty"
                                                                src="/images/sub/plus-ic.png"
                                                                alt="">
                                                        </div>
                                                        <div class="" style="display: none">
                                                            <input type="hidden" name="option_idx[]" value="<?= $item ?>">
                                                            <input type="hidden" name="option_name[]"
                                                                value="<?= $data['option_name'][$i] ?>">
                                                            <input type="hidden" name="option_price[]"
                                                                value="<?= $data['option_price'][$i] ?>">
                                                            <input type="hidden" name="option_tot[]" value="0">
                                                            <input type="hidden" name="option_cnt[]" value="0">
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </form>
                            <div class="form-below-calendar">
                                <label class="lb-18" for="">예약시간</label>
                                <select class="select-time-c">
                                    <?php foreach ($timeSegments as $time): ?>
                                        <option value="<?= htmlspecialchars($time); ?>">
                                            <?= htmlspecialchars($time); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>  
                        </div>
                    </div>
                    <?php if ($product['product_status'] == 'sale'): ?>
                        <button type="button" class="primary-btn-calendar tour" onclick="handleSubmit()">견적/예약하기</button>
                    <?php endif; ?>
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
            <div class="des-type">
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

        <div class="popup_wrap place_pop policy_pop">
            <div class="pop_box">
                <button type="button" class="close" onclick="closePopup()"></button>
                <div class="pop_body">
                    <div class="padding">
                        <div class="popup_place__head">
                            <div class="popup_place__head__ttl">
                                <h2>취소 규정</h2>
                            </div>
                        </div>
                        <div class="popup_place__body">
                            <?=viewSQ(getPolicy(19))?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dim"></div>
        </div>

        <div id="popup_coupon" class="popup" data-price="">
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
                                data-discount="<?= $dis ?>" data-discount_baht="<?= $coupon["coupon_price_baht"] ?>">
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
                        <div class="item-price-popup item-price-popup--button active"
                            data-idx="" data-type="" data-discount="0" data-discount_baht="0">
                            <span>적용안함</span>
                        </div>
                    </div>
                    <div class="line-gray"></div>
                    <div class="footer-popup">
                        <div class="des-above">
                            <div class="item">
                                <span class="text-gray">총 주문금액</span>
                                <span class="text-gray total_price" id="total_price_popup" data-price="">0원</span>
                            </div>
                            <div class="item">
                                <span class="text-gray">할인금액</span>
                                <span class="text-gray discount" data-price="">0원</span>
                            </div>
                        </div>
                        <div class="des-below">
                            <div class="price-below">
                                <span>최종결제금액</span>
                                <p class="price-popup">
                                    <span id="last_price_popup">0</span><span
                                            class="text-gray">원</span>
                                </p>
                            </div>
                        </div>
                        <button type="button" class="btn_accept_popup btn_accept_coupon">
                            쿠폰적용
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function closePopup() {
                $(".popup_wrap").hide();
                $(".dim").hide();
            }

            $("#policy_show").on("click", function() {
                $(".policy_pop, .policy_pop .dim").show();
            });
        </script>
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

                function sel_moption(code_idx) {
                        let url = `<?= route_to('api.product.sel_moption') ?>`;

                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                "product_idx": '<?= $product['product_idx'] ?>',
                                "code_idx": code_idx
                            },
                            async: false,
                            cache: false,
                            success: function (data, textStatus) {
                                $("#sel_option").html(data);
                            },
                            error: function (request, status, error) {
                                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                            }
                        });
                    }

                    function sel_option(code_idx) {
                            let url = `<?= route_to('api.product.sel_option') ?>`;
                            let idx = code_idx.split("|")[0];

                            let moption = $("#moption").val();

                            $.ajax({
                                url: url,
                                type: "POST",
                                data: {
                                    "idx": idx,
                                    "moption": moption
                                },
                                async: false,
                                cache: false,
                                success: function (data, textStatus) {
                                    let parent_name = data.parent_name;

                                    let option_name = data.option_name;
                                    let option_price = data.option_price;
                                    let option_price_won = data.option_price_won;
                                    let idx = data.idx;
                                    let option_tot = data.option_tot ?? 0;
                                    let option_cnt = data.option_cnt;

                                    let htm_ = `<div class="schedule cus-count-input flex_b_c" id="schedule_${idx}" data-idx="${idx}" style="margin-top: 20px">
                                                        <div class="wrap-text">
                                                            <span>${parent_name}</span>
                                                            <p>${option_name + " +" + option_price_won.toLocaleString('en-US') + "원" + "(" + option_price.toLocaleString('en-US') + "바트" + ")"}</p>
                                                        </div>
                                                        <div class="wrap-btn opt_count_box count_box flex__c">
                                                            <button type="button" onclick="minusQty(this);" class="minus_btn" id="minusAdult"></button>
                                                            <input style="text-align: center; display: block; width: 56px" data-price="${option_price}" readonly type="text" class="input-qty input_qty"
                                                                        name="option_qty[]" id="input_qty" value="1">
                                                            <button type="button" onclick="plusQty(this);" class="plus_btn" id="addAdult"></button>
                                                        </div>
                                                    </div>

                                                <div class="" style="display: none">
                                                        <input type="hidden" name="option_name[]" value="${option_name}">
                                                        <input type="hidden" name="option_idx[]" value="${idx}">
                                                        <input type="hidden" name="option_tot[]" value="${option_tot}">
                                                        <input type="hidden" name="option_price[]" value="${option_price}">
                                                        <input type="hidden" name="option_cnt[]" value="${option_cnt}">
                                                </div>
                                            </li>`;

                                    let sel_option_ = $('#schedule_' + idx);
                                    if (!sel_option_.length > 0) {
                                        $("#option_list_").append(htm_);
                                    }
                                },
                                error: function (request, status, error) {
                                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                }
                            });
                            updateProductOption();
                        }

                    function minusQty(el) {
                        let inp = $(el).parent().find('input.input_qty');
                        let num = inp.val();
                        if (Number(num) > 1) {
                            num = Number(num) - 1;
                            inp.val(num);
                        } else {
                            if (confirm('선택 항목을 지우시겠습니까?')) {
                                $(el).closest('.schedule').remove();
                            }
                        }
                        updateProductOption(); 
                    }

                    function plusQty(el) {
                        let inp = $(el).parent().find('input.input_qty');
                        let num = inp.val();
                        num = Number(num) + 1;
                        inp.val(num);
                        updateProductOption();
                    }

                    var selectedOption = [];
                    var selectedTourIds = [];
                    var totalCost = 0;
                    var selectedTourQuantities = {};
                    function updateProductOption() {
                        selectedOption = [];
                        totalCost = 0;
                        selectedTourQuantities = {};
                        $('input.input_qty').each(function() {
                            let qty = parseInt($(this).val());
                            let price = parseFloat($(this).data('price')); 
                            let optionName = $(this).closest('.schedule').find('p').text(); 
                            let idx = $(this).closest('.schedule').data('idx');
                            
                            if (qty > 0) {
                                let totalPrice = qty * price;
                                totalCost += totalPrice;
                                if (!selectedTourIds.includes(idx)) {
                                    selectedTourIds.push(idx);
                                }
                                selectedTourQuantities[idx] = qty;
                                selectedOption.push(`<div class='flex_op flex'>${optionName} <p class='product_option_pay'>${totalPrice.toLocaleString()}원</p></div>`);
                            }
                        });

                        if (selectedOption.length > 0) {
                            $('#product_options').html(
                                selectedOption.join('<br>')
                            );
                        } else {
                            $('#product_options').html("선택된 옵션이 없습니다.");
                        }
                    }


                    let currentToursIdx = null;
                    const allContainers = document.querySelectorAll('.calendar-right .quantity-container-fa');
                    const sec2Items = document.querySelectorAll('.sec2-item-card');
                    
                    allContainers.forEach(container => {
                        container.style.display = 'none';
                    });

                    const firstContainer = document.querySelector('.calendar-right .quantity-container-fa');
                    if (firstContainer) {
                        const dataTourIndex = firstContainer.getAttribute('data-tour-index');
                        if (dataTourIndex) { 
                            firstContainer.style.display = 'block';
                            currentToursIdx = dataTourIndex;
                        }
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
                                currentToursIdx = selectedContainer.getAttribute('data-tour-index');
                            }
                        });
                    });
                    
                    var adultQuantity = 1;
                    var childQuantity = 0;
                    var babyQuantity = 0;

                    var adultTotalPrice = 0;
                    var childTotalPrice = 0;
                    var babyTotalPrice = 0;

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
                            adultTotalPrice = adultQuantity * pricePerUnit;
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
                                adultTotalPrice = adultQuantity * pricePerUnit;
                            } else if ($container.find('.des').text().includes('아동')) {
                                childQuantity = quantity;
                                childTotalPrice = childQuantity * pricePerUnit;
                            } else if ($container.find('.des').text().includes('유아')) {
                                babyQuantity = quantity;
                                babyTotalPrice = babyQuantity * pricePerUnit;
                            }
                            updateTotalPeopleDisplay();
                        }

                        function updatePrice() {
                            var totalPrice = quantity * pricePerUnit;
                            var totalPriceBaht = quantity * priceBahtPerUnit;

                            $price.text(number_format(totalPrice) + '원');
                            $currency.text(number_format(totalPriceBaht) + ' 바트');
                        }
                    });

                    function number_format(number) {
                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }

                    updateTotalPeopleDisplay();

                    // var selectedTourIds = [];
                    // $('input[type="checkbox"]').change(function() {
                    //     updateOptionText();
                    // });

                    // selectedPrice = [];

                    // function updateOptionText() {
                    //     var selectedOptions = [];
                    //     selectedTourIds = [];
                    //     selectedPrice = [];

                    //     $('input[type="checkbox"]:checked').each(function() {
                    //         var optionContainer = $(this).closest('.form-group');
                    //         var optionName = optionContainer.find('label').text();
                    //         var optionPrice = parseFloat(optionContainer.find('.price').text().replace('원', '').replace(',', ''));
                    //         var optionBaht = parseFloat(optionContainer.find('.currency').text().replace('바트', '').replace(',', ''));

                    //         var tourIdx = $(this).attr('id');
                            
                    //         selectedTourIds.push(tourIdx); 
                    //         selectedOptions.push(`${optionName} ${number_format(optionPrice)}원 (${number_format(optionBaht)}바트)`);
                    //         selectedPrice.push(optionPrice);
                    //     });

                    //     var optionText = selectedOptions.length > 0 ? selectedOptions.join(' + ') : "선택된 옵션이 없습니다.";
                    //     $('td.option').text(optionText);
                        
                    // }

                    function number_format(number) {
                        return number.toLocaleString('ko-KR');
                    }

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
                    currentDate.setHours(0, 0, 0, 0);
                    let selectedDate = null;
                    let validDays = []

                    const setTourDatesAndPrice = (startDate, endDate, price, priceBaht, validDaysParam) => {
                        s_date = new Date(startDate);
                        e_date = new Date(endDate);
                        productPrice = price;
                        productPriceBaht = priceBaht;
                        validDays = validDaysParam; 
                        renderCalendar(validDays); 
                    };

                    const initializeDefaultTour = () => {
                        const firstTourDateElement = $('.sec2-date-main').first();
                        const tourStartDate = firstTourDateElement.data('start-date');
                        const tourEndDate = firstTourDateElement.data('end-date');
                        
                        const firstTourCard = $('.sec2-item-card').first();
                        const tourPriceText = firstTourCard.find('.ps-right').text().trim().replace(/,/g, ''); 
                        adultTotalPrice = parseFloat(tourPriceText);
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

                        const today = new Date();
                        today.setHours(0, 0, 0, 0); 

                        const currentMonthDate = new Date(year, month, today.getDate());
                        currentMonthDate.setHours(0, 0, 0, 0);

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
                            let date = new Date(year, month, day);

                            date = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                            const isWithinDateRange = date >= s_date && date <= e_date;
                            const isValidDay = validDays.includes(date.getDay());
                            const isPastDate = date < today; 

                            if (isPastDate) {
                                $dayDiv.addClass('disabled').append(`<p>예약마감</p>`);
                            } else if (!isWithinDateRange || !isValidDay) {
                                $dayDiv.addClass('disabled').append("<p>예약마감</p>");
                            } else {
                                $dayDiv.addClass('selectable').html(`
                                    <p class="selectable-day">
                                        ${dayString}
                                        <p class="price1">${number_format(productPrice)}만원</p>
                                        <p class="price2">(${number_format(productPriceBaht)}바트)</p>
                                    </p>
                                `);

                                $dayDiv.click(() => {
                                    $('.day').removeClass('active');
                                    $dayDiv.addClass('active');
                                    selectedDate = date;

                                    const formattedDate = formatSelectedDate(date);
                                    $('.days_choose').text(formattedDate);
                                    $('.calendar_txt').text(formattedDate);
                                    $('#order_date').val(formattedDate);
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
                        adultTotalPrice = parseFloat(tourPriceText);
                        const tourPrices = parseFloat(tourPriceText) / 10000;
                        const tourPrice = parseFloat(tourPrices.toFixed(1));

                        const tourPriceTextBaht = tourCard.find('.ps-left').text().trim().replace(/,/g, '');
                        const tourPriceBaht = parseFloat(tourPriceTextBaht);

                        const validDaysParam = $(this).data('valid-days').split(',').map(Number);
                        setTourDatesAndPrice(tourStartDate, tourEndDate, tourPrice, tourPriceBaht, validDaysParam);
                        $('html, body').animate({
                            scrollTop: $('#tour_calendar').offset().top
                        }, 500);
                    });

                    $prevMonthBtn.click(() => {
                        currentDate.setMonth(currentDate.getMonth() - 1);
                        currentDate.setDate(1); 
                        renderCalendar(validDays);
                    });

                    $nextMonthBtn.click(() => {
                        currentDate.setMonth(currentDate.getMonth() + 1);
                        currentDate.setDate(1); 
                        renderCalendar(validDays);
                    });

                    const getValidDaysForMonth = (date) => {

                        return validDays; 
                    };

                    function checkDateSelected() {
                        if (!selectedDate) {
                            alert('달력 선택해주세요!');
                            return false;
                        }
                        return true;
                    }

                    // $('.primary-btn-calendar.tour').click(function() {
                    //     if (checkDateSelected()) {
                    //         $('.sec2-item-card, .section2 .title-sec2, .section2 .sec2-date-main, .section2 .sec2-date-sub').hide();
                    //         $('.section1').hide();
                    //         $('.sec2-item-card.order-form-page, .sec2-item-card.card-left2').show();

                    //         var selectedDateText = $('#days_choose').text();
                    //         var dateParts = selectedDateText.split('(')[0].trim();
                    //         var formattedDate = dateParts.replace(/\./g, '-');
                    //         var adultCnt = adultQuantity;
                    //         var childCnt = childQuantity;
                    //         var babyCnt = babyQuantity;
                    //         var adultTotalPrices = adultTotalPrice;
                    //         var childTotalPrices = childTotalPrice;
                    //         var babyTotalPrices = babyTotalPrice;
                    //         var priceOptionTotal = totalCost;
                    //         var last_price = adultTotalPrices + childTotalPrices + babyTotalPrices + priceOptionTotal;
                    //         var selectedTime = $('.select-time-c').val();
                    //         if (!selectedTime) {
                    //             selectedTime = $('.select-time-c option:first').val();
                    //         }
                    //         const idxWithQuantities = selectedTourIds.map(idx => `${idx}:${selectedTourQuantities[idx]}`).join(',');


                    //     }
                    // });

                    function handleSubmit() {
                        const frm = document.frm;

                        <?php
                        if (empty(session()->get("member")["id"])) {
                        ?>
                        showOrHideLoginItem();
                        return false;
                        <?php
                        }
                        ?>

                        if (checkDateSelected()) {
                            var selectedDateText = $('#days_choose').text();
                            var dateParts = selectedDateText.split('(')[0].trim();
                            var formattedDate = dateParts.replace(/\./g, '-');
                            var adultCnt = adultQuantity;
                            var childCnt = childQuantity;
                            var babyCnt = babyQuantity;
                            var adultTotalPrices = adultTotalPrice;
                            var childTotalPrices = childTotalPrice;
                            var babyTotalPrices = babyTotalPrice;
                            const selectedTourCard = $('.sec2-item-card.active');
                            var priceOptionTotal = totalCost;
                            var last_price = adultTotalPrices + childTotalPrices + babyTotalPrices + priceOptionTotal;
                            var selectedTime = $('.select-time-c').val();
                            if (!selectedTime) {
                                selectedTime = $('.select-time-c option:first').val();
                            }
                            const idxWithQuantities = selectedTourIds.map(idx => `${idx}:${selectedTourQuantities[idx]}`).join(',');


                            //$('#order_date').val(formattedDate);
                            $('#people_adult_cnt').val(adultCnt);
                            $('#people_kids_cnt').val(childCnt);
                            $('#people_baby_cnt').val(babyCnt);
                            $('#people_adult_price').val(adultTotalPrices);
                            $('#people_kids_price').val(childTotalPrices);
                            $('#people_baby_price').val(babyTotalPrices);
                            $('#tours_idx').val(currentToursIdx);
                            $('#idx').val(idxWithQuantities);
                            $('#time_line').val(selectedTime);
                            $('.time_lines').text(selectedTime);
                            $("#total_price_popup").text(number_format(last_price) + " 바트");
                            $("#total_price").val(last_price);
                            $("#total_pay").text(number_format(last_price) + " 바트");
                            console.log(selectedTourIds.join(','));
                            console.log(currentToursIdx);
                            console.log(adultTotalPrices);
                            console.log(selectedTime);
                            console.log(priceOptionTotal);
                            var productIdx = document.querySelector('input[name="product_idx"]').value;
                            $("#frm").submit();
                        }
                    }
                    function setCouponArea(isAcceptBtn = false) {
                        const couponActive = $(".item-price-popup.active");
                        let total_price = $("#total_price").val() || 0;
                        let total_price_baht = $("#total_price_baht").val() || 0;
                        const idx = couponActive.data("idx") || 0;
                        const discount = couponActive.data("discount") || 0;
                        let discount_baht = couponActive.data("discount_baht") || 0;
                        const type = couponActive.data("type") || 0;

                        let discount_price = 0;
                        let discount_price_baht = 0;
                        if (type === "D") {
                            discount_price = discount;
                            discount_price_baht = discount_baht;
                        } else if (type === "P") {
                            discount_price = Math.round(total_price * discount / 100);
                            discount_price_baht = Math.round(total_price_baht * discount / 100);
                        }

                        total_price -= discount_price;
                        total_price_baht -= discount_price_baht;

                        $(".discount").text(number_format(discount_price) + "원");
                        $("#last_price_popup").text(number_format(total_price));

                        if (isAcceptBtn) {
                            $("#final_discount").val(discount_price);
                            $(".final_discount").val(number_format(discount_price));
                            $("#final_discount_baht").text(number_format(discount_price_baht));
                            $("#use_coupon_idx").val(idx);
                        }

                        return {
                            discount_price,
                            discount_price_baht
                        };
                    }

                    function calculatePrice() {
                        var last_price = adultTotalPrices + childTotalPrices + babyTotalPrices + priceOptionTotal;
                        const discount_price = $("#final_discount").text().replace(/[^0-9]/g, '');
                        const discount_price_baht = $("#final_discount_baht").text().replace(/[^0-9]/g, '');

                        last_price -= discount_price;

                        $("#last_price").text(number_format(last_price));
                    }

                    $(".item-price-popup").click(function () {
                        $(this).addClass("active").siblings().removeClass("active");
                        setCouponArea();
                    })

                    $(".btn_accept_coupon").click(function () {
                        setCouponArea(true);
                        calculatePrice();
                        $("#popup_coupon").css('display', 'none');
                    })

                    initializeDefaultTour();


                function showCouponPop() {
                    $("#popup_coupon").css('display', 'flex');
                }

                const $closePopupBtn = $('.close-btn');
                $closePopupBtn.on('click', function() {
                    $("#popup_coupon").css('display', 'none');
                });


            $('.btn_back').click(function() {
                $('.sec2-item-card, .section2 .title-sec2, .section2 .sec2-date-main, .section2 .sec2-date-sub').show();
                $('.section1').show();
                $('.sec2-item-card.order-form-page, .sec2-item-card.card-left2').hide();
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
             $(".phone").on("input", function () {
                $(this).val($(this).val().replace(/[^0-9]/g, ""));
            });

            $("input[name='radio_phone'").change(function () {
                if ($(this).val() == 'kor') {
                    $(".phone_kor").attr("disabled", false).eq(0).focus();
                    $(".phone_thai").attr("disabled", true);
                } else {
                    $(".phone_thai").attr("disabled", false).focus();
                    $(".phone_kor").attr("disabled", true);
                }
            })

            function handleEmail(email) {
            if (email == '1') {
                $("#email_2").val('').prop('readonly', false).focus();
            } else {
                $("#email_2").val(email).prop('readonly', true);
            }
        }
            // document.addEventListener('DOMContentLoaded', function() {
            //     const allContainers = document.querySelectorAll('.calendar-right .quantity-container-fa');
            //     const sec2Items = document.querySelectorAll('.sec2-item-card');
                
            //     allContainers.forEach(container => {
            //         container.style.display = 'none';
            //     });

            //     const firstContainer = document.querySelector('.calendar-right .quantity-container-fa');
            //     if (firstContainer) {
            //         firstContainer.style.display = 'block';
            //         const initialToursIdx = firstContainer.getAttribute('data-tour-index');
            //         console.log("Initial tours_idx:", initialToursIdx);
            //     }

            //     if (sec2Items.length > 0) {
            //         sec2Items[0].classList.add('active');
            //     }

            //     document.querySelectorAll('.btn-ct-3').forEach((button) => {
            //         button.addEventListener('click', function() {
            //             const tourIndex = this.getAttribute('data-tour-index');

            //             sec2Items.forEach(sec2Item => {
            //                 sec2Item.classList.remove('active');
            //             });

            //             const selectedSec2Item = document.querySelector(`.section2 .sec2-item-card[data-tour-index="${tourIndex}"]`);
            //             if (selectedSec2Item) {
            //                 selectedSec2Item.classList.add('active');
            //             }


            //             document.querySelectorAll('.calendar-right .quantity-container-fa').forEach(container => {
            //                 container.style.display = 'none';
            //             });

            //             const selectedContainer = document.querySelector(`.calendar-right .quantity-container-fa[data-tour-index="${tourIndex}"]`);
            //             if (selectedContainer) {
            //                 selectedContainer.style.display = 'block';
            //                 const toursIdx = selectedContainer.getAttribute('data-tour-index');
            //                 console.log("tours_idx:", toursIdx);
            //             }
            //         });
            //     });
            // });

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
            name: "<?= addslashes($product['product_name']) ?>",
            link: "<?= '/product-tours/item_view/' . $product['product_idx']?>",
            image: "<?= '/data/product/' . $product['ufile1'] ?>",
            ...(<?= isset($product['ufile2']) && $product['ufile2'] ? 'true' : 'false' ?> && { image2: "<?= '/data/product/' . $product['ufile2'] ?>" })
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