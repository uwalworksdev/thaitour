<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<div class="content-sub-hotel-detail custom-golf-detail">
    <div class="body_inner">
        <div class="section1">
            <div class="title-container">
                <h2><?= viewSQ($product['product_name']) ?></h2>
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
                <span><?=$product['addrs']?></span>
            </div>
            <div class="rating-container">
                <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                <span><strong><?= $product['review_average'] ?></strong></span>
                <span>생생리뷰 <strong>(<?= $product['total_review'] ?>)</strong></span>
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
                    <a class="short_link active" data-target="product_info" href="#product_info">상품 정보</a>
                    <a class="short_link" data-target="pickup" href="#pickup">상품예약</a>
                    <a class="short_link" data-target="product_des" href="#product_des">상품설명</a>
                    <a class="short_link" data-target="location" href="#location">위치정보</a>
                    <a class="short_link" data-target="review" href="#review">생생리뷰(159개)</a>
                    <a class="short_link" data-target="qna" href="#qna">상품 Q&A</a>
                </div>
                <div class="btn-container">
                    <a class="w-100" href="/product-golf/customer-form/1324">
                        <button>
                            상품예약
                        </button>
                    </a>
                </div>
            </div>
            <h3 class="title-size-24" id="product_info">상품 정보</h3>
            <table class="golf-table">
                <thead>
                    <tr>
                        <th>더투어랩 평가 등급</th>
                        <th>
                            <div class="rating-list">
                                <?php if($info['star_level'] > 0) { ?><img src="/uploads/icons/star_icon.png" alt="star_icon"><?php } ?>
                                <?php if($info['star_level'] > 1) { ?><img src="/uploads/icons/star_icon.png" alt="star_icon"><?php } ?>
                                <?php if($info['star_level'] > 2) { ?><img src="/uploads/icons/star_icon.png" alt="star_icon"><?php } ?>
                                <?php if($info['star_level'] > 3) { ?><img src="/uploads/icons/star_icon.png" alt="star_icon"><?php } ?>
                                <?php if($info['star_level'] > 4) { ?><img src="/uploads/icons/star_icon.png" alt="star_icon"><?php } ?>
                            </div>
                        </th>
                        <th>총홀수</th>
                        <th><?=$info['holes_number']?></th>
                        <th>휴무일</th>
                        <th><?=$info['holidays']?></th>
                    </tr>
                </thead>
                <tbody class="text-gray">
                    <tr>
                        <td>시내에서 거리 및 이동기간</td>
                        <td><?=$info['distance_from_center']?></td>
                        <td>공항에서 거리 및 이동시간</td>
                        <td><?=$info['distance_from_airport']?></td>
                        <td>팀당 라운딩 인원</td>
                        <td><?=$info['num_of_players']?></td>
                    </tr>
                    <tr>
                        <td>전동카트</td>
                        <td colspan="5"><?=$info['electric_car']?></td>
                    </tr>
                    <tr>
                        <td>갤러리피</td>
                        <td colspan="5"><?=$info['caddy']?></td>
                    </tr>
                    <tr>
                        <td>장비렌탈</td>
                        <td colspan="5"><?=$info['equipment_rent']?></td>
                    </tr>
                    <tr>
                        <td>스포츠데이</td>
                        <td colspan="5"><?=$info['sports_day']?></td>
                    </tr>
                </tbody>
            </table>
            <h3 id="pickup" class="title-size-24 text-parent">상품 예약<span>날짜 · 홀수 ·인원 ·시간대를 먼저 선택해 주세요.</span></h3>
            <div class="calendar">
                <div class="year">
                    <img src="/uploads/icons/year_prev_icon.png" alt="year_prev_icon" srcset="" id="prev_icon"
                        class="only_web">
                    <img src="/uploads/icons/year_prev_icon_mo.png" alt="year_prev_icon" srcset="" id="prev_icon"
                        class="only_mo">
                    <span><span id="year"></span>년 <span id="month"></span>월</span>
                    <img src="/uploads/icons/year_next_icon.png" alt="next_icon" srcset="" id="next_icon"
                        class="only_web">
                    <img src="/uploads/icons/year_next_icon_mo.png" alt="next_icon" srcset="" id="next_icon"
                        class="only_mo">
                </div>
                <div class="dates">
                    <div class="swiper-button-next swiper-button swiper-button-custom">
                        <img src="/uploads/icons/next_day_icon.png" alt="year_next_icon" class="only_web">
                    </div>
                    <div class="swiper-button-prev swiper-button swiper-button-custom">
                        <img src="/uploads/icons/prev_day_icon.png" alt="prev_day_icon" class="only_web">
                    </div>
                    <div class="swiper-button-prev swiper-button swiper-button-custom only_mo">
                        <img src="/uploads/icons/prev_day_icon_mo.png" alt="prev_day_icon">
                    </div>
                    <div class="swiper-button-next swiper-button swiper-button-custom only_mo">
                        <img src="/uploads/icons/next_day_icon_mo.png" alt="next_day_icon">
                    </div>
                    <div class="calendar-swiper-container swiper-container">
                        <div class="calendar-swiper-wrapper swiper-wrapper"></div>
                    </div>
                </div>
            </div>
            <div class="tag-con-below-calendar">
                <div class="item-tag">
                    <span class="label">홀수</span>
                    <div class="tag-list">
                        <span class="tag tag-js active" data-tab="18">18홀</span>
                        <span class="tag tag-js " data-tab="27">27홀</span>
                        <span class="tag tag-js " data-tab="36">36홀</span>
                        <span class="tag tag-js " data-tab="45">45홀</span>
                    </div>
                </div>
                <div class="item-tag">
                    <span class="label">인원</span>
                    <select class="select_custom_ active_ cus-width" name="" id="">
                        <option value="">선택해주세요.</option>
                        <option value="">선택해주세요.</option>
                    </select>
                </div>
                <div class="item-tag item-tag-mo-cus">
                    <span class="label">시간대</span>
                    <div class="tag-list">
                        <span class="tag tag-js2 active">
                            06시
                        </span>
                        <span class="tag tag-js2">
                            07시
                        </span>
                        <span class="tag tag-js2">
                            08시
                        </span>
                        <span class="tag tag-js2">
                            09시
                        </span>
                        <span class="tag tag-js2">
                            10시
                        </span>
                        <span class="tag tag-js2">
                            11시
                        </span>
                        <span class="tag tag-js2">
                            12시
                        </span>
                        <span class="tag tag-js2">
                            13시
                        </span>
                        <span class="tag tag-js2">
                            14시
                        </span>
                        <span class="tag tag-js2">
                            15시
                        </span>
                        <span class="tag tag-js2">
                            16시
                        </span>
                        <span class="tag tag-js2">
                            17시
                        </span>
                        <span class="tag tag-js2">
                            18시
                        </span>
                        <span class="tag tag-js2">
                            19시
                        </span>
                    </div>
                </div>

            </div>
            <div class="date-text-2">
                <p>2024.10.10 (목) / 36<span>홀수</span> / 06<span>시</span> / 5<span>인</span></p>
                <p>※ 아래 요금은 1인당 가격입니다.</p>
            </div>
            <div class="card-content">
                <div class="card-item">
                    <div class="header">
                        <div class="header-con">
                            <img class="only_web" src="/uploads/icons/timer_gray_icon.png" alt="timer_gray_icon">
                            <img class="only_mo" src="/uploads/icons/timer_gray_icon_mo.png" alt="timer_gray_icon_mo">
                            <p>06:00</p>
                        </div>
                        <p class="text-gray">캐디피 : 그린피에 포함</p>
                        <p class="text-gray">카트피 : 그린피에 포함</p>
                        <p class="text-gray">그린피 : <span class="font-bold">268,290원(6,600바트)</span></p>
                    </div>
                </div>
                <div class="card-item active_1">
                    <div class="header">
                        <div class="header-con">
                            <img class="only_web" src="/uploads/icons/timer_blue_icon.png" alt="timer_gray_icon">
                            <img class="only_mo" src="/uploads/icons/timer_blue_icon_mo.png" alt="timer_gray_icon">
                            <p>06:12</p>
                        </div>
                        <p class="text-gray">캐디피 : 그린피에 포함</p>
                        <p class="text-gray">카트피 : 그린피에 포함</p>
                        <p class="text-gray">그린피 : <span class="font-bold">449,460원(11,000바트)</span></p>
                    </div>
                </div>
                <div class="card-item active_2">
                    <div class="header">
                        <div class="header-con">
                            <img class="only_web" src="/uploads/icons/timer_gray_icon.png" alt="timer_gray_icon">
                            <img class="only_mo" src="/uploads/icons/timer_gray_icon_mo.png" alt="timer_gray_icon_mo">
                            <p>06:24</p>
                        </div>
                        <p class="cus-text">캐디피 : 그린피에 포함</p>
                        <p class="cus-text">카트피 : 그린피에 포함</p>
                        <div class="cus-text_div">
                            <p class="cus-text">그린피 : </p><span class="font-bold">268,290원(6,600바트)</span>
                        </div>
                    </div>
                </div>
                <div class="card-item">
                    <div class="header">
                        <div class="header-con">
                            <img class="only_web" src="/uploads/icons/timer_gray_icon.png" alt="timer_gray_icon">
                            <img class="only_mo" src="/uploads/icons/timer_gray_icon_mo.png" alt="timer_gray_icon">
                            <p>06:36</p>
                        </div>
                        <p class="text-gray">캐디피 : 그린피에 포함</p>
                        <p class="text-gray">카트피 : 그린피에 포함</p>
                        <p class="text-gray">그린피 : <span class="font-bold">268,290원(6,600바트)</span></p>
                    </div>
                </div>
                <div class="card-item">
                    <div class="header">
                        <div class="header-con">
                            <img class="only_web" src="/uploads/icons/timer_gray_icon.png" alt="timer_gray_icon">
                            <img class="only_mo" src="/uploads/icons/timer_gray_icon_mo.png" alt="timer_gray_icon_mo">
                            <p>06:48</p>
                        </div>
                        <p class="text-gray">캐디피 : 그린피에 포함</p>
                        <p class="text-gray">카트피 : 그린피에 포함</p>
                        <p class="text-gray">그린피 : <span class="font-bold">268,290원(6,600바트)</span></p>
                    </div>
                </div>
            </div>
            <div class="section1-sub">
                <h3 class="title-size-24 text-parent">골프장 왕복 픽업 차량<span>※선택 옵션입니다. 추가 원하시면 선택해 주세요.</span></h3>
            </div>
            <div class="list-select-element">
                <div class="item-select">
                    <span class="label">승용차</span>
                    <select class="select_custom_ active_ cus-width" name="" id="">
                        <option value="">3</option>
                        <option value="">3</option>
                    </select>
                </div>
                <div class="item-select">
                    <span class="label">SUV</span>
                    <select class="select_custom_ active_ cus-width" name="" id="">
                        <option value="">선택해주세요.</option>
                        <option value="">선택해주세요.</option>
                    </select>
                </div>
                <div class="item-select">
                    <span class="label">밴 (승합차)</span>
                    <select class="select_custom_ active_ cus-width" name="" id="">
                        <option value="">선택해주세요.</option>
                        <option value="">선택해주세요.</option>
                    </select>
                </div>
            </div>
            <div class="section2-sub">
                <div class="left-main">
                    <h3 class="tit-left">피닉스 골드 골프 방콕 (구 · 수완나품 컨트리클럽) </h3>
                    <p>
                        <span class="l-label">일정</span>
                        <span class="l-label2">2024.09.05(목)</span>
                    </p>
                    <p>
                        <span class="l-label">홀수</span>
                        <span class="l-label2">18홀</span>
                    </p>
                    <p>
                        <span class="l-label">티오프시간</span>
                        <span class="l-label2">06시 30분</span>
                    </p>
                    <p>
                        <span class="l-label">인원</span>
                        <span class="l-label2">2명</span>
                    </p>
                    <button class="btn-price-content-normal"
                        onclick="location.href='/product-golf/customer-form/1324'">예약하기</button>
                </div>
                <div class="right-main">
                    <div class="item-right">
                        <div class="list-text">
                            <p><span class="text-gray">그린피 : </span>268,290원(1인 5,500바트 X 2인)</p>
                            <p><span class="text-gray">그린피 : </span>그린피에 포함</p>
                            <p><span class="text-gray">그린피 : </span>그린피에 포함</p>
                        </div>
                        <span class="price-text text-gray">681,615원 (16,500바트)</span>
                    </div>
                    <div class="item-right">
                        <p><span class="text-gray">골프장 왕복 픽업 차량 - </span>승용차 x 2대</p>
                        <span class="price-text text-gray">214,812원 (5,200바트)</span>
                    </div>
                    <div class="item-right">
                        <p><span class="text-gray">골프장 왕복 픽업 차량 - </span>SUV x 1대</p>
                        <span class="price-text text-gray">115,668원 (2,800바트)</span>
                    </div>
                    <div class="item-right cus-border">
                        <p><span class="">쿠폰 적용</span></p>
                        <span class="price-text">- 11,566원 (280바트)</span>
                    </div>
                    <div class="item-last-right">
                        <p>합계</p>
                        <p class="price-text">1,012,095<span>원(24,500바트)</span></p>
                    </div>
                    <button class="btn-price-content"
                        onclick="location.href='/product-golf/customer-form/1324'">예약하기</button>
                </div>
            </div>
            <h3 class="title-size-24" id="product_des">상품설명</h3>
            <div class="container-big-text">
                <?= $product['tour_info'] ?>
            </div>
            <h3 class="title-size-24" id="location">위치정보</h3>
            <img class="topic-immg only_web" src="/uploads/sub/map-golf-detail.png" alt=""></img>
            <img class="topic-immg only_mo" src="/uploads/sub/map-golf-detail_mo.png" alt=""></img>
            <div class="location-container">
                <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                <span class="text-gray">19 Moo.14, Bang Krasan, Bangpain,Phra Nakhon Si Ayutthaya 13160</span>
            </div>
            <div class="section6">
                <h2 class="title-sec6" id="review"><span>생생리뷰</span>(516)</h2>
                <div class="rating-content">
                    <div class="rating-left">
                        <img src="/uploads/icons/start_big_icon.png" alt="start_big_icon">
                        <strong>4.5/5</strong>
                    </div>
                    <span class="rating-right">928개 고객기준</span>
                </div>
                <div class="list-label-tag">
                    <div class="label-tag-item">
                        <img class="square only_web" src="/uploads/sub/golf_item_rated_1.png" alt="golf_item_rated_1">
                        <img class="square only_mo" src="/uploads/sub/golf_item_rated_1_mo.png" alt="golf_item_rated_1">
                        <div class="label-tag-item-text">
                            <strong>페어웨이/그린</strong>
                            <p><strong>4.2</strong> 최고좋음</p>
                        </div>
                    </div>
                    <div class="label-tag-item">
                        <img class="square only_web" src="/uploads/sub/golf_item_rated_2.png" alt="golf_item_rated_1">
                        <img class="square only_mo" src="/uploads/sub/golf_item_rated_2_mo.png" alt="golf_item_rated_1">
                        <div class="label-tag-item-text">
                            <strong>플레이속도</strong>
                            <p><strong>4.2</strong> 최고좋음</p>
                        </div>
                    </div>
                    <div class="label-tag-item">
                        <img class="square only_web" src="/uploads/sub/golf_item_rated_3.png" alt="golf_item_rated_1">
                        <img class="square only_mo" src="/uploads/sub/golf_item_rated_3_mo.png" alt="golf_item_rated_1">
                        <div class="label-tag-item-text">
                            <strong>캐디</strong>
                            <p><strong>4.2</strong> 최고좋음</p>
                        </div>
                    </div>
                    <div class="label-tag-item">
                        <img class="square only_web" src="/uploads/sub/golf_item_rated_4.png" alt="golf_item_rated_1">
                        <img class="square only_mo" src="/uploads/sub/golf_item_rated_4_mo.png" alt="golf_item_rated_1">
                        <div class="label-tag-item-text">
                            <strong>부대시설</strong>
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
                <h2 class="title-sec6" id="qna"><span>상품 Q&A</span>(516)</h2>
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
                        <li class="qa-item">
                            <div class="qa-question">
                                <span class="qa-number">124</span>
                                <span class="qa-tag normal-style">답변대기중</span>
                                <div class="con-cus-mo-qa">
                                    <p class="qa-text">티켓은 어떻게 예약할 수 있나요?</p>
                                    <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                </div>
                            </div>
                            <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                        </li>
                        <li class="qa-item">
                            <div class="qa-question">
                                <span class="qa-number">123</span>
                                <span class="qa-tag">답변대기중</span>
                                <div class="con-cus-mo-qa">
                                    <p class="qa-text">결제 시점은 언제인가요?</p>
                                    <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                </div>
                            </div>
                            <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                        </li>
                        <li class="qa-item">
                            <div class="qa-question">
                                <span class="qa-number">122</span>
                                <span class="qa-tag normal-style">답변대기중</span>
                                <div class="con-cus-mo-qa">
                                    <p class="qa-text">2월23일 성인 8명, 어린이 2명으로 예약하면 10명인데요. 통로역 근처인 저희 호텔로 외주실수...</p>
                                    <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                </div>
                            </div>
                            <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                        </li>
                        <li class="qa-item">
                            <div class="qa-question">
                                <span class="qa-number">121</span>
                                <span class="qa-tag normal-style">답변대기중</span>
                                <div class="con-cus-mo-qa">
                                    <p class="qa-text">오늘 투어인데 아유타야에 있어서요. 혹시 아유타야에서 도중에 만나서 일정만 소화하고 아유타야에서...</p>
                                    <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                </div>
                            </div>
                            <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                        </li>
                        <li class="qa-item">
                            <div class="qa-question">
                                <span class="qa-number">120</span>
                                <span class="qa-tag">답변대기중</span>
                                <div class="con-cus-mo-qa">
                                    <p class="qa-text">입금 했습니다. 아직 확정 전이라고 떠서 확인부탁드려요.</p>
                                    <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                </div>
                            </div>
                            <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                        </li>
                    </ul>
                    <div class="additional-info">
                        <span class="load-more">더투어랩</span>
                        <p>조인투어로 전환 시 정해진 미팅장소에서 가이드님과 만나실 수 있습니다.<br>아유타야는 넓기 때문에 다른 장소에서 미팅은 어려운 점 예약 시 참고해주시기 바랍니다.
                        </p>
                        <p class="mt-36">만약 투어 종료 후 개별 이동을 원하시면 당일 가이드님께 말씀해주시면 됩니다.</p>
                    </div>
                </div>
                <div class="pagination">
                    <a href="#" class="page-link">
                        <img class="only_web" src="/uploads/icons/arrow_prev_step.png" alt="arrow_prev_step">
                        <img class="only_mo" src="/uploads/icons/arrow_prev_step_mo.png" alt="arrow_prev_step_mo">
                    </a>
                    <a href="#" class="page-link cus-padding mr">
                        <img class="only_web" src="/uploads/icons/arrow_prev_all.png" alt="arrow_prev_all">
                        <img class="only_mo" src="/uploads/icons/arrow_prev_all_mo.png" alt="arrow_prev_all_mo">
                    </a>
                    <a href="#" class="page-link active">1</a>
                    <a href="#" class="page-link">2</a>
                    <a href="#" class="page-link">3</a>
                    <a href="#" class="page-link cus-padding ml">
                        <img class="only_web" src="/uploads/icons/arrow_next_all.png" alt="arrow_next_step">
                        <img class="only_mo" src="/uploads/icons/arrow_next_all_mo.png" alt="arrow_next_step_mo">
                    </a>
                    <a href="#" class="page-link">
                        <img class="only_web" src="/uploads/icons/arrow_next_step.png" alt="arrow_next_step">
                        <img class="only_mo" src="/uploads/icons/arrow_next_step_mo.png" alt="arrow_next_step">
                    </a>
                </div>
            </div>
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
        $('.tag-list .tag-js').on('click', function() {
            $('.tag-list .tag-js').removeClass('active');
            $(this).addClass('active');
        });

        $('.tag-list .tag-js2').on('click', function() {
            $('.tag-list .tag-js2').removeClass('active');
            $(this).addClass('active');
        });

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

        // Get the popup, open button, close button elements
        const $popup = $('#popup');
        const $openPopupBtns = $('.openPopupBtn');
        const $closePopupBtn = $('.close-btn');
        const $closePopupBtn2 = $('#closePopupBtn');

        // Show popup when the "Open Popup" button is clicked
        $openPopupBtns.on('click', function() {
            $popup.css('display', 'flex');
        });

        $('.list-icon img[alt="heart_icon"]').click(function() {
            if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
                $(this).attr('src', '/uploads/icons/heart_on_icon.png');
            } else {
                $(this).attr('src', '/uploads/icons/heart_icon.png');
            }
        });

        // Close the popup when the "Close" button or the "x" is clicked
        $closePopupBtn.on('click', function() {
            $popup.css('display', 'none');
        });

        $closePopupBtn2.on('click', function() {
            $popup.css('display', 'none');
        });

        // Close popup if clicked outside of content area
        $(window).on('click', function(event) {
            if ($(event.target).is($popup)) {
                $popup.css('display', 'none');
            }
        });


        const daysOfWeek = ['일', '월', '화', '수', '목', '금', '토'];

        function getMonthDatesWithWeekdays(month, year) {
            const monthDatesWithWeekdays = [];
            const daysInMonth = new Date(year, month, 0).getDate();

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
            slidesPerView: 22,
            spaceBetween: 2,
            loop: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
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
            // 
            daysInCurrentMonth.forEach(e => {

                var selDay = currentYear + '-' + currentMonth + '-' + e.dayOfMonth;
                var yy = currentYear;
                var mm = currentMonth;
                var dd = e.dayOfMonth;
                //if(parseInt(mm) < 10) mm = "0"+mm;
                if (parseInt(dd) < 10) dd = "0" + dd;
                var calDate = yy + '-' + mm + '-' + dd;
                //alert(calDate);
                var selDate = '2024-09-13';
                //alert('date- '+selDate);

                var sel_Date = '';
                var sel_Price = '';
                //alert(sel_Price);
                const arrDate = sel_Date.split("|");
                const arrPrice = sel_Price.split("|");

                var idx = -1;
                for (var i = 0; i < arrDate.length; i++) {
                    if (arrDate[i] == calDate) {
                        idx = i;
                    }
                }

                var min_amt = '0';
                if (idx == -1) {
                    var selAmt = "-";
                } else {
                    if (arrPrice[idx] == min_amt) {
                        var selAmt = arrPrice[idx] + '만<br>(최소)';
                    } else {
                        var selAmt = arrPrice[idx] + '만';
                    }
                }

                //var selAmt = "100만";
                //var to_Day = '2024-09-13';
                var to_Day = '2024-09-15';
                var yy = $("#year").text();
                var mm = $("#month").text();
                var dd = e.dayOfMonth;
                //if(parseInt(mm) < 10) mm = "0"+mm;
                if (parseInt(dd) < 10) dd = "0" + dd;
                var selDate = yy + '-' + mm + '-' + dd;
                $(".calendar-swiper-wrapper").append(`
                <div class="swiper-slide">
                    <div style="color:${e.weekday === 6 || e.weekday === 0 ? "red" : "black"}">${daysOfWeek[e.weekday]}</div>
                    <div class="day">
                                        <a class="${selDate === '2024-09-13' ? 'on' : ''}" style="color:#999999" href='#!' onclick='sel_date(${e.dayOfMonth});'>
                                        ${e.dayOfMonth}</a></div>
                </div>
            `);
            });

            swiper01 = new Swiper('.calendar-swiper-container', {
                slidesPerView: 22,
                spaceBetween: 2,
                // slidesPerGroup: 13,
                loop: false,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                observer: true,
                observeParents: true,
                breakpoints: {
                    850: {
                        slidesPerView: 22,
                        spaceBetween: 2,
                    },
                    350: {
                        slidesPerView: 5,
                        spaceBetween: 2,
                    }
                },
            });
            var today = new Date();

            //let date = today.getDate();

            let date = "13";
            swiper01.slideTo(date - 2);
            //swiper01.slideTo(0);
        }

        setSlide('09', '2024');

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
            //currentYear  = currentDate.getFullYear();
            if (currentMonth.length < 2) currentMonth = '0' + currentMonth;
            setSlide(currentMonth, currentYear)
        }
        $("#prev_icon").on("click", prevMonth)
        $("#next_icon").on("click", nextMonth)
        $("#prev_icon_mo").on("click", prevMonth)
        $("#next_icon_mo").on("click", nextMonth)

        $(function() {
            $('.calendar .dates .day a').on('click', function() {
                $('.day a').removeClass("on");
                $(this).addClass("on");
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

    <?php $this->endSection(); ?>