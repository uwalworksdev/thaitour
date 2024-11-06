<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

    <link rel="stylesheet" type="text/css" href="/css/tour/spa.css">
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
                    </div>
                    <div class="list-icon only_mo">
                        <img src="/uploads/icons/print_icon.png" alt="print_icon">
                        <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                        <img src="/uploads/icons/share_icon.png" alt="share_icon">
                    </div>
                </div>
                <div class="hotel-image-container">
                    <div class="hotel-image-container-1">
                        <img class="imageDetailMain_"
                             onclick="img_pops('<?= $data_['product_idx'] ?>')"
                             src="/data/hotel/<?= $data_['ufile1'] ?>"
                             alt="<?= $data_['product_name'] ?>"
                             onerror="this.src='/images/share/noimg.png'">
                    </div>
                    <div class="grid_2_2">
                        <?php for ($j = 2; $j < 5; $j++) { ?>
                            <img onclick="img_pops('<?= $data_['product_idx'] ?>')" class="grid_2_2_size imageDetailSup_"
                                 src="/data/hotel/<?= $data_['ufile' . $j] ?>"
                                 alt="<?= $data_['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                        <?php } ?>
                        <div class="grid_2_2_sub" style="position: relative; cursor: pointer;">
                            <img onclick="img_pops('<?= $data_['product_idx'] ?>')" class="custom_button imageDetailSup_"
                                 src="/data/hotel/<?= $data_['ufile5'] ?>"
                                 alt="<?= $data_['product_name'] ?>"
                                 onerror="this.src='/images/share/noimg.png'">
                            <div class="button-show-detail-image">
                                <img class="only_web" src="/uploads/icons/image_detail_icon.png"
                                     alt="image_detail_icon">
                                <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png"
                                     alt="image_detail_icon_m">
                                <span>사진 모두 보기</span>
                                <span>(125장)</span>
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
                            <p class="nav-item" onclick="scrollToEl('section6')" style="cursor: pointer">생생리뷰(503)</p>
                            <p class="nav-item" onclick="scrollToEl('section8')" style="cursor: pointer">상품문의(FAQ)</p>
                        </div>
                    </div>

                    <div class="section2" id="section2">
                        <h2 class="title-sec2">
                            상품선택
                        </h2>

                        <table class="price-table" id="price-table" style="margin-bottom:30px;">
                            <colgroup>
                                <col width="*">
                                <col width="10%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th colspan="6">적용일자 : 2024-11-20</th>
                            </tr>
                            <tr>
                                <th>선택옵션</th>
                                <th>요일</th>
                                <th>성인(만 13세이상)</th>
                                <th>아름(만5세)</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>아로마 테라피 마사지(60분)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt2[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>아로마 테라피 마사지(90분)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">56,304원</span>(880바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt2[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>아로마 테라피 마사지 (220분)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">47,168원</span>(1,100바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt2[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>아로마 첫 오일 (60분)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt2[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>아로마 오일 (90분)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    이용불가
                                </td>
                            </tr>

                            <tr>
                                <td>아로마 첫 오일 (120)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    이용불가
                                </td>
                            </tr>

                            <tr>
                                <td>아로마 스크럽 (90분)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    이용불가
                                </td>
                            </tr>

                            <tr>
                                <td>아로마 스크럽 (120)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt2[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>아로마 오일 등 목& 어깨 (90분)</td>
                                <td>매일</td>
                                <td>
                                    <div class="d_flex align_items_center justify_content_start gap-10">
                                        <div class="price">
                                            <span class="text_primary">34,304원</span>(800바트)
                                        </div>
                                        <input type="text" name="mem_cnt1[]" class="price_in" size="4"
                                               onkeyup="chkNum(this)">
                                    </div>
                                </td>
                                <td>
                                    이용불가
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
                            <?= viewSQ($data_['product_contents']) ?>
                        </div>
                    </div>

                    <div class="section4" id="section4">
                        <h2 class="title-sec4">
                            위치안내
                        </h2>

                        <div id="section4_map" style="width: 800px; height: 500px;">

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

                    <!--                    <div class="section2" id="section2">-->
                    <!--                        <h2 class="title-sec2">-->
                    <!--                            숙소개요-->
                    <!--                        </h2>-->
                    <!--                        <h3 class="sub-title-sec2">-->
                    <!--                            추천 포인트-->
                    <!--                        </h3>-->
                    <!--                        <div class="">-->
                    <!--                            <p class="description-sec2" style="letter-spacing: 1px">-->
                    <!--                                --><?php //= viewSQ($data_['product_info']) ?>
                    <!--                            </p>-->
                    <!--                        </div>-->
                    <!--                        <div class="tag-list-icon mt-20">-->
                    <!--                            --><?php //foreach ($fresult4 as $row) : ?>
                    <!--                                <div class="item-tag">-->
                    <!--                                    <img src="/data/code/-->
                    <?php //= $row['ufile1'] ?><!--" alt="--><?php //= $row['code_name'] ?><!--">-->
                    <!--                                    <span>--><?php //= $row['code_name'] ?><!--</span>-->
                    <!--                                </div>-->
                    <!--                            --><?php //endforeach; ?>
                    <!--                        </div>-->
                    <!--                        <h2 class="sub-title-sec2">-->
                    <!--                            인기 시설 및 서비스-->
                    <!--                        </h2>-->
                    <!--                        <div class="tag_list_done">-->
                    <!--                            --><?php //foreach ($bresult4 as $row) : ?>
                    <!--                                <div class="item_done">-->
                    <!--                                    <img src="/uploads/icons/done_icon.png" alt="done_icon">-->
                    <!--                                    <span>--><?php //= $row['code_name'] ?><!--</span>-->
                    <!--                                </div>-->
                    <!--                            --><?php //endforeach; ?>
                    <!--                        </div>-->
                    <!--                        <h2 class="sub-title-sec2">-->
                    <!--                            스파주변 추천명소-->
                    <!--                        </h2>-->
                    <!--                        <div class="post-list-sec2">-->
                    <!--                            --><?php //foreach ($fresult8 as $row) : ?>
                    <!--                                <div class="">-->
                    <!--                                    <img src="/data/code/-->
                    <?php //= $row['ufile1'] ?><!--" alt="hotel_thumbnai_1">-->
                    <!--                                    <span>--><?php //if ($row['type']) { ?><!-- -->
                    <?php //= $row['type'] ?><!--: --><?php //} ?><!-- --><?php //= $row['code_name'] ?><!--(-->
                    <?php //= $row['distance'] ?><!--)</span>-->
                    <!--                                </div>-->
                    <!--                            --><?php //endforeach; ?>
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <div class="section4" id="section3">-->
                    <!--                        <h2 class="title-sec4">시설 &amp; 서비스</h2>-->
                    <!--                        <div class="list-tag-sec4" style="flex-wrap: wrap; gap: 30px; justify-content: start; ">-->
                    <!--                            --><?php //foreach ($fresult5 as $row2): ?>
                    <!--                                <div class="tag-container-item-sec4"-->
                    <!--                                     style="width: calc((100% - 120px)/3); padding-right: 70px">-->
                    <!--                                    <div class="tag-item-title"> -->
                    <?php //= $row2['code_name'] ?><!-- </div>-->
                    <!--                                    <ul class="tag-item-list">-->
                    <!--                                        --><?php //$child = $row2['child'];
                    //                                        foreach ($child as $item2): ?>
                    <!--                                            <li>--><?php //= $item2['code_name'] ?><!--</li>-->
                    <!--                                        --><?php //endforeach; ?>
                    <!--                                    </ul>-->
                    <!--                                </div>-->
                    <!--                            --><?php //endforeach; ?>
                    <!--                        </div>-->
                    <!--                    </div>-->

                    <?php
                    $product_more = $data_['product_more'];
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

                    <div class="section6" id="section6">
                        <h2 class="title-sec6"><span>생생리뷰</span>(516)</h2>
                        <div class="rating-content">
                            <div class="rating-left">
                                <img src="/uploads/icons/start_big_icon.png" alt="start_big_icon">
                                <strong>0/5</strong>
                            </div>
                            <span class="rating-right text-gray">0개 고객기준</span>
                        </div>
                        <div class="list-label-tag">
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571645_fb53d1d73b0b13dcf6c2.png" alt="청결">
                                <div class="label-tag-item-text">
                                    <strong>청결</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571657_b1cb8c4fb89a788c1351.png" alt="시설">
                                <div class="label-tag-item-text">
                                    <strong>시설</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571664_f42ea530f35c89161075.png" alt="위치">
                                <div class="label-tag-item-text">
                                    <strong>위치</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571671_ae94a9dbd753c419c162.png" alt="직원친절도">
                                <div class="label-tag-item-text">
                                    <strong>직원친절도</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571681_6b866f4a413112dac498.png" alt="가성비">
                                <div class="label-tag-item-text">
                                    <strong>가성비</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                            <div class="label-tag-item">
                                <img class="square" src="/data/code/1729571686_6eb5cc9b65925faeb2d7.png" alt="편안함">
                                <div class="label-tag-item-text">
                                    <strong>편안함</strong>
                                    <p><strong>0</strong> 최고좋음</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-list-flex">
                            <div class="card-list-recommemded">
                            </div>
                        </div>

                    </div>

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

                    <div class="section7" id="section7">
                        <div class="d_flex justify_content_end">
                            <h1 class="title-sec7">다른 추천 스파도 확인해 보세요 : )</h1>
                            <div class="swiper_product_list_pagination_ swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                                <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                                      role="button" aria-label="Go to slide 1" aria-current="true"></span><span
                                        class="swiper-pagination-bullet" tabindex="0" role="button"
                                        aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet"
                                                                                tabindex="0" role="button"
                                                                                aria-label="Go to slide 3"></span><span
                                        class="swiper-pagination-bullet" tabindex="0" role="button"
                                        aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet"
                                                                                tabindex="0" role="button"
                                                                                aria-label="Go to slide 5"></span><span
                                        class="swiper-pagination-bullet" tabindex="0" role="button"
                                        aria-label="Go to slide 6"></span><span class="swiper-pagination-bullet"
                                                                                tabindex="0" role="button"
                                                                                aria-label="Go to slide 7"></span><span
                                        class="swiper-pagination-bullet" tabindex="0" role="button"
                                        aria-label="Go to slide 8"></span><span class="swiper-pagination-bullet"
                                                                                tabindex="0" role="button"
                                                                                aria-label="Go to slide 9"></span></div>
                        </div>
                        <div class="sub_tour_section7_product_list swiper swiper_product_list_ swiper-initialized swiper-horizontal swiper-backface-hidden">
                            <div class="swiper-wrapper" id="swiper-wrapper-c2d811557361007f3" aria-live="polite">

                                <?php foreach ($suggestSpas as $suggestSpa) { ?>
                                    <a href="/product-hotel/hotel-detail/<?= $suggestSpa['product_idx'] ?>"
                                       class="sub_tour_section7_product_item swiper-slide swiper-slide-active"
                                       role="group"
                                       aria-label="1 / 9" data-swiper-slide-index="0"
                                       style="width: 292.5px; margin-right: 10px;">

                                        <div class="img_box img_box_12">
                                            <img src="/data/hotel/<?= $suggestSpa['ufile1'] ?>" alt="main"
                                                 onerror="this.src='/images/product/noimg.png'" loading="lazy">
                                        </div>
                                        <div class="prd_keywords">
                                    <span class="prd_keywords_cus_span">
                                        <?= $suggestSpa['product_type'] ?>
                                    </span>
                                        </div>
                                        <div class="prd_name">
                                            <?= $suggestSpa['product_name'] ?>
                                        </div>
                                        <div class="prd_info">
                                            <div class="prd_info__left">
                                                <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="">
                                                <span class="star_avg"> <?= $suggestSpa['review_average'] ?> </span>
                                            </div>
                                            <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
                                            <div class="prd_info__right">
                                                <span class="prd_info__right__ttl">생생리뷰</span>
                                                <span class="new_review_cnt">(<?= $suggestSpa['total_review'] ?>)</span>
                                            </div>
                                        </div>
                                        <div class="prd_price_ko">
                                            <?= number_format($suggestSpa['product_price']) ?> <span>원~</span> <span
                                                    class="prd_price_thai">6,000 <span>바트~</span></span>
                                        </div>
                                    </a>
                                <?php } ?>

                            </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                    </div>
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
        $(document).on('click', '.allowBtn', function () {

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
        });

        $(document).on('click', '.sel_date', function () {
            $('.sel_date').removeClass('active_');
            $(this).addClass('active_');
            let day_ = $(this).data('date');
            $('#day_').val(day_);
            let price = `<?= number_format($data_['product_price']) ?>`;
            let price_convert = price.toLocaleString();
            $('#total_sum').text(price_convert);
            calcTotal();
        });

        // const optCountBoxes = document.querySelectorAll('.opt_count_box');
        // optCountBoxes.forEach(box => {
        //     const minusButton = box.querySelector('.minus_btn');
        //     const plusButton = box.querySelector('.plus_btn');
        //     const inputField = box.querySelector('.input-qty');
        //
        //     minusButton.addEventListener('click', () => {
        //         let currentValue = parseInt(inputField.value, 10);
        //         if (currentValue > 0) {
        //             inputField.value = currentValue - 1;
        //         }
        //     });
        //
        //     plusButton.addEventListener('click', () => {
        //         let currentValue = parseInt(inputField.value, 10);
        //         inputField.value = currentValue + 1;
        //     });
        // });
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

        function chkNum(el) {
            let val = $(el).val();

            if (!$.isNumeric(val)) {
                val = val.replace(/\D/g, '');

                $(el).val(val);
            }
        }
    </script>
<?php $this->endSection(); ?>